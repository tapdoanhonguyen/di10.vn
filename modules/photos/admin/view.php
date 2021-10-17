<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */

if( !defined( 'NV_IS_FILE_ADMIN' ) )
	die( 'Stop!!!' );

$rowcontent['album_id'] = $nv_Request->get_int( 'id', 'get,post', 0 );
if( $rowcontent['album_id'] > 0 )
{
	$album = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_album where album_id=' . $rowcontent['album_id'] )->fetch( );
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $global_photo_cat[$album['category_id']]['alias'] . '/' . $l['alias'] . '-' . $l['album_id'], true ) );
	die( );
}
