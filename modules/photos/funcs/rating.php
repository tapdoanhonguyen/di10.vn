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
if( !defined( 'NV_IS_AJAX' ) )
	die( 'Wrong URL' );

$contents = '';
$array_point = array(
	1,
	2,
	3,
	4,
	5
);

$album_id = $nv_Request->get_int( 'album_id', 'post', 0 );
$point = $nv_Request->get_int( 'point', 'post', 0 );
$checkss = $nv_Request->get_title( 'checkss', 'post' );

$time_set = $nv_Request->get_int( $module_name . '_' . $op . '_' . $album_id, 'session', 0 );

if( $album_id > 0 and in_array( $point, $array_point ) and $checkss == md5( $album_id . $client_info['session_id'] . $global_config['sitekey'] ) )
{
	if( !empty( $time_set ) )
	{
		die( $lang_module['rating_error2'] );
	}

	$nv_Request->set_Session( $module_name . '_' . $op . '_' . $album_id, NV_CURRENTTIME );
	$query = $db->query( "SELECT  total_rating, click_rating FROM " . NV_PREFIXLANG . "_" . $module_data . "_album WHERE album_id = " . $album_id . " AND status=1" );
	$row = $query->fetch( );
	$query = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_album SET total_rating=total_rating+" . $point . ", click_rating=click_rating+1 WHERE album_id=" . $album_id;
	$db->query( $query );
	$contents = sprintf( $lang_module['stringrating'], $row['total_rating'] + $point, $row['click_rating'] + 1 );
	die( $contents );
}

die( $lang_module['rating_error1'] );
