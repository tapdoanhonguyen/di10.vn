<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */

if( !defined( 'NV_IS_MOD_PHOTO' ) )
	die( 'Stop!!!' );

$contents = '';
$date_added = 0;
$per_page = $module_config[$module_name]['per_page_photo'];

// kiem tra tu cach xem album
if( nv_user_in_groups( $global_photo_cat[$category_id]['groups_view'] ) )
{
	// truy van lay thong tin album
	$query = $db->query( 'SELECT a.*, r.file, r.thumb FROM ' . TABLE_PHOTO_NAME . '_album a
						LEFT JOIN  ' . TABLE_PHOTO_NAME . '_rows r ON ( a.album_id = r.album_id )
						WHERE a.status= 1 AND r.defaults = 1 AND a.album_id = ' . $album_id );

	$album = $query->fetch( );

	if( $album['album_id'] > 0 )
	{
		if( defined( 'NV_IS_MODADMIN' ) or $album['status'] == 1 ) // cap nhat luot xem
		{
			$time_set = $nv_Request->get_int( $module_data . '_' . $op . '_' . $album['album_id'], 'session' );
			if( empty( $time_set ) )
			{
				$nv_Request->set_Session( $module_data . '_' . $op . '_' . $album['album_id'], NV_CURRENTTIME );
				$db->query( 'UPDATE ' . TABLE_PHOTO_NAME . '_album SET viewed=viewed+1 WHERE album_id=' . $album['album_id'] );
			}
		}

		if( $alias_url == $album['alias'] )
		{
			$date_added = intval( $album['date_added'] );
		}
	}
	// xac thuc lien ket co dung chuan khong
	if( $date_added == 0 )
	{
		$redirect = '<meta http-equiv="Refresh" content="3;URL=' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name, true ) . '" />';
		nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] . $redirect );
	}

	// rewrite link
	$base_url_rewrite = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_photo_cat[$album['category_id']]['alias'] . '/' . $album['alias'] . '-' . $album['album_id'];
	if( $page > 1 )
	{
		$base_url_rewrite .= '/page-' . $page;
	}
	$base_url_rewrite = nv_url_rewrite( $base_url_rewrite, true );
	if( $_SERVER['REQUEST_URI'] != $base_url_rewrite and NV_MAIN_DOMAIN . $_SERVER['REQUEST_URI'] != $base_url_rewrite )
	{
		Header( 'Location: ' . $base_url_rewrite );
		die( );
	}

	$base_url = $global_photo_album[$album_id]['link'];

	$canonicalUrl = NV_MAIN_DOMAIN . $base_url_rewrite;
	// Dem so anh trong album
	$db->sqlreset( )->select( 'COUNT(*)' )->from( TABLE_PHOTO_NAME . '_rows' )->where( 'status=1 AND album_id =' . $album_id );
	$num_items = $db->query( $db->sql( ) )->fetchColumn( );
	if( $module_config[$module_name]['album_view'] == 'album_view_grid' )
	{
		// anh trong album
		$array_photo = array( );
		$db->select( '*' )->from( TABLE_PHOTO_NAME . '_rows' )->where( 'status=1 AND album_id=' . $album_id )->order( 'date_added ASC' )->limit( $per_page )->offset( ($page - 1) * $per_page );
	}
	else
	{
		// anh trong album
		$array_photo = array( );
		$db->select( '*' )->from( TABLE_PHOTO_NAME . '_rows' )->where( 'status=1 AND album_id=' . $album_id )->order( 'date_added ASC' );
	}

	$photo = $db->query( $db->sql( ) );

	while( $row = $photo->fetch( ) )
	{
		$array_photo[] = $row;
	}
	$photo->closeCursor( );

	// album cung chu de
	$sql = 'SELECT a.album_id, a.category_id, a.name, a.alias, a.capturelocal, a.description, a.num_photo, a.date_added, a.viewed, r.file, r.thumb FROM ' . TABLE_PHOTO_NAME . '_album a
		LEFT JOIN  ' . TABLE_PHOTO_NAME . '_rows r ON ( a.album_id = r.album_id )
		WHERE a.status= 1 AND a.category_id=' . $album['category_id'] . ' AND r.defaults = 1 AND a.album_id <> ' . $album['album_id'] . '
		ORDER BY a.date_added DESC
		LIMIT 0, 6';
	$result = $db->query( $sql );
	$other_category_album = array( );
	while( $item = $result->fetch( ) )
	{
		$item['link'] = $global_photo_cat[$album['category_id']]['link'] . '/' . $item['alias'] . '-' . $item['album_id'];
		$other_category_album[] = $item;
	}
	$result->closeCursor( );

	// comment
	if( isset( $site_mods['comment'] ) and isset( $module_config[$module_name]['activecomm'] ) )
	{
		define( 'NV_COMM_ID', $album_id );
		//ID bài viết
		define( 'NV_COMM_AREA', $module_info['funcs'][$op]['func_id'] );
		//để đáp ứng comment ở bất cứ đâu không cứ là bài viết
		//check allow comemnt
		$allowed = $module_config[$module_name]['allowed_comm'];
		//tuy vào module để lấy cấu hình. Nếu là module news thì có cấu hình theo bài viết
		if( $allowed == '-1' )
		{
			$allowed = $album['allow_comment'];
		}
		define( 'NV_PER_PAGE_COMMENT', 5 );
		//Số bản ghi hiển thị bình luận
		require_once NV_ROOTDIR . '/modules/comment/comment.php';
		$area = ( defined( 'NV_COMM_AREA' )) ? NV_COMM_AREA : 0;
		$checkss = md5( $module_name . '-' . $area . '-' . NV_COMM_ID . '-' . $allowed . '-' . NV_CACHE_PREFIX );

		//get url comment
		$url_info = parse_url( $client_info['selfurl'] );
		$content_comment = nv_comment_module( $module_name, $checkss, $area, NV_COMM_ID, $allowed, 1 );
	}
	else
	{
		$content_comment = '';
	}
	// truyen bien sang module block detail
	global $data_album;
	$data_album = $album;

	// truyen thong tin seo
	$page_title = !empty( $album['meta_title'] ) ? $album['meta_title'] : $album['name'];
	$key_words = !empty( $album['meta_keyword'] ) ? $album['meta_keyword'] : $album['name'];
	$description = !empty( $album['meta_description'] ) ? $album['meta_description'] : strip_tags( $album['description'] );
	$src = photos_thumbs( $album['album_id'], $album['file'], $module_upload, $module_config[$module_name]['cr_thumb_width'], $module_config[$module_name]['cr_thumb_height'], $module_config[$module_name]['cr_thumb_quality'] );
	$meta_property['og:image'] = (preg_match( '/^(http|https|ftp|gopher)\:\/\//', $src )) ? $src : NV_MY_DOMAIN . $src;

	// Phan trang
	$generate_page = nv_alias_page( $page_title, $base_url, $num_items, $per_page, $page );

	$sql = 'SELECT userid, username, first_name, last_name, photo FROM ' . NV_USERS_GLOBALTABLE . ' WHERE active=1 AND userid= ' . $album['author'];
	$array_user = $nv_Cache->db( $sql, 'userid', $module_name );
	if( !empty( $array_user ) )
	{
		foreach( $array_user as $array_user_i )
		{
			if( !empty( $array_user_i['first_name'] ) && !empty( $array_user_i['last_name'] ) )
			{
				$album['author_upload'] = $array_user_i['first_name'] . ' ' . $array_user_i['last_name'];
			}
			else
			{
				$album['author_upload'] = $array_user_i['username'];
			}
			if( !empty( $array_user_i['photo'] ) )
			{
				$album['author_image'] = $array_user_i['photo'];
			}
			else
			{
				$album['author_image'] = 'themes/default/images/users/no_avatar.png';
			}
		}
	}
	if( $module_config[$module_name]['album_view'] == 'album_view_grid' )
	{
		$contents = detail_album( $album, $array_photo, $other_category_album, $content_comment, $generate_page, $page );
	}
	else
	{
		$contents = detail_album( $album, $array_photo, $other_category_album, $content_comment );
	}
}
else
{
	// khong co quyen xem album
	$contents = no_permission( $lang_module['no_permission_album'] );
}

if( $page > 1 )
{
	$page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['page'] . ' ' . $page;
	$description .= ' ' . $page;
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
