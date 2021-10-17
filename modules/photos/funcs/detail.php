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
// kiem tra tu cach xem album
if( nv_user_in_groups( $global_photo_cat[$category_id]['groups_view'] ) && nv_user_in_groups( $global_photo_album[$album_id]['groups_view'] ) )
{
	// anh trong album
	$db->sqlreset( )->select( '*' )->from( TABLE_PHOTO_NAME . '_rows' )->where( 'status=1 AND row_id=' . $row_id )->order( 'date_added ASC' );

	$photo = $db->query( $db->sql( ) );
	$row = $photo->fetch( );
	$row['description'] = !empty( $row['description'] ) ? $row['description'] : $row['name'];
	if( $row['row_id'] > 0 )
	{
		if( defined( 'NV_IS_MODADMIN' ) or ($row['status'] == 1) )
		{
			// cap nhat luot xem
			$time_set = $nv_Request->get_int( $module_data . '_' . $op . '_' . $row['row_id'], 'session' );
			if( empty( $time_set ) )
			{
				$nv_Request->set_Session( $module_data . '_' . $op . '_' . $row['row_id'], NV_CURRENTTIME );
				$db->query( 'UPDATE ' . TABLE_PHOTO_NAME . '_rows SET viewed=viewed+1 WHERE row_id=' . $row['row_id'] );
			}
		}
	}

	$album_id = $row['album_id'];

	$next_photo = $previous_photo = '';
	//Next Photo
	$sql = 'SELECT row_id, album_id, name, status, description FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE row_id > ' . $row['row_id'] . ' AND album_id=' . $row['album_id'] . ' ORDER BY row_id ASC LIMIT 1';
	$list = $nv_Cache->db( $sql, 'row_id', $module_name );
	foreach( $list as $next_photo )
	{
		$next_photo['link'] = $global_photo_album[$next_photo['album_id']]['link'] . '/' . $next_photo['row_id'] . $global_config['rewrite_exturl'];
	}
	unset( $sql, $list );

	//Previous Photo
	$sql = 'SELECT row_id, album_id, name, status, description FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE row_id < ' . $row['row_id'] . ' AND album_id=' . $row['album_id'] . ' ORDER BY row_id DESC LIMIT 1';
	$list = $nv_Cache->db( $sql, 'row_id', $module_name );
	foreach( $list as $previous_photo )
	{
		$previous_photo['link'] = $global_photo_album[$previous_photo['album_id']]['link'] . '/' . $previous_photo['row_id'] . $global_config['rewrite_exturl'];
	}
	unset( $sql, $list );

	// rewrite link
	$base_url_rewrite = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_photo_cat[$category_id]['alias'] . '/' . $global_photo_album[$row['album_id']]['alias'] . '-' . $row['album_id'] . '/' . $row['row_id'] . $global_config['rewrite_exturl'], true );
	if( $_SERVER['REQUEST_URI'] != $base_url_rewrite and NV_MAIN_DOMAIN . $_SERVER['REQUEST_URI'] != $base_url_rewrite )
	{
		Header( 'Location: ' . $base_url_rewrite );
		die( );
	}
	// truyen bien ra module block
	global $data_detail;
	$data_detail = $row;

	// truyen thong tin seo
	$page_title = !empty( $row['name'] ) ? $row['name'] : $global_photo_album[$row['album_id']]['name'];
	$key_words = !empty( $global_photo_album[$row['album_id']]['meta_keyword'] ) ? $global_photo_album[$row['album_id']]['meta_keyword'] : $global_photo_album[$row['album_id']]['name'];
	$description = !empty( $row['description'] ) ? $row['description'] : strip_tags( $global_photo_album[$row['album_id']]['description'] );
	$src = photos_thumbs( $row['row_id'], $row['file'], $module_upload, $module_config[$module_name]['cr_thumb_width'], $module_config[$module_name]['cr_thumb_height'], $module_config[$module_name]['cr_thumb_quality'] );
	;
	$meta_property['og:image'] = (preg_match( '/^(http|https|ftp|gopher)\:\/\//', $src )) ? $src : NV_MY_DOMAIN . $src;

	// goi ham xu ly giao dien
	$contents = detail( $row, $next_photo, $previous_photo );
}
else
{
	$contents = no_permission( $lang_module['no_permission_detailed'] );
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
