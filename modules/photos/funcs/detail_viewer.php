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

$xtpl = new XTemplate( 'detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
$row_id = $nv_Request->get_int( 'row_id', 'get', 0 );
$ajax = $nv_Request->get_int( 'ajax', 'get', 0 );

$contents = '';
$date_added = 0;

if( $ajax )
{
	// anh trong album
	$db->sqlreset( )->select( '*' )->from( TABLE_PHOTO_NAME . '_rows' )->where( 'status=1 AND row_id=' . $row_id )->order( 'date_added ASC' );

	$photo = $db->query( $db->sql( ) );
	$row = $photo->fetch( );

	if( $row['row_id'] > 0 )
	{
		if( defined( 'NV_IS_MODADMIN' ) or $row['status'] == 1 )
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

	$xtpl->assign( 'ALBUM', $global_photo_album[$row['album_id']] );

	$row['thumb'] = photos_thumbs( $row['row_id'], $row['file'], $module_upload, $module_config[$module_name]['cr_thumb_width'], $module_config[$module_name]['cr_thumb_height'], $module_config[$module_name]['cr_thumb_quality'] );
	$row['file'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/images/' . $row['file'];
	$row['album_title'] = !empty( $global_photo_album[$row['album_id']]['meta_title'] ) ? $global_photo_album[$row['album_id']]['meta_title'] : $global_photo_album[$row['album_id']]['name'];
	$row['title'] = !empty( $row['name'] ) ? $row['name'] : $row['album_title'];
	$row['description'] = !empty( $row['description'] ) ? $row['description'] : $row['name'];

	$album_id = $row['album_id'];
	$view_url = NV_MY_DOMAIN . nv_url_rewrite( $global_photo_album[$row['album_id']]['link'] . '/' . $row['row_id'] . $global_config['rewrite_exturl'], true );
	$xtpl->assign( 'PHOTO', $row );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'VIEW_URL', $view_url );

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

	// truyen bien ra module block
	global $data_detail;
	$data_detail = $row;

	// truyen thong tin seo
	$page_title = !empty( $row['name'] ) ? $row['name'] : $global_photo_album[$row['album_id']]['name'];
	$key_words = !empty( $global_photo_album[$row['album_id']]['meta_keyword'] ) ? $global_photo_album[$row['album_id']]['meta_keyword'] : $global_photo_album[$row['album_id']]['name'];
	$description = !empty( $row['description'] ) ? $row['description'] : strip_tags( $global_photo_album[$row['album_id']]['description'] );
	$src = photos_thumbs( $row['row_id'], $row['file'], $module_upload, $module_config[$module_name]['cr_thumb_width'], $module_config[$module_name]['cr_thumb_height'], $module_config[$module_name]['cr_thumb_quality'] ); ;
	$meta_property['og:image'] = (preg_match( '/^(http|https|ftp|gopher)\:\/\//', $src )) ? $src : NV_MY_DOMAIN . $src;
	if( !empty( $next_photo ) )
	{
		$xtpl->assign( 'NEXT', $next_photo );
		$xtpl->parse( 'detail_viewer.next' );
	}
	if( !empty( $previous_photo ) )
	{
		$xtpl->assign( 'PREV', $previous_photo );
		$xtpl->parse( 'detail_viewer.pre' );
	}

	if( $module_config[$module_name]['social_tool'] > 0 )
	{
		$xtpl->parse( 'detail_viewer.social_tool' );
	}

	$xtpl->parse( 'detail_viewer' );
	$contents = $xtpl->text( 'detail_viewer' );

	include NV_ROOTDIR . '/includes/header.php';
	echo $contents;
	include NV_ROOTDIR . '/includes/footer.php';
	die( );
}
