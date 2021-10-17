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

$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $mod_data . "_category ORDER BY sort_order ASC";
$result = $db->query( $sql );
while( $row = $result->fetch( ) )
{
	$array_item[$row['category_id']] = array(
		'parentid' => $row['parent_id'],
		'groups_view' => $row['groups_view'],
		'key' => $row['category_id'],
		'title' => $row['name'],
		'alias' => $row['alias']
	);
}
