<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */

if( !defined( 'NV_IS_MOD_RSS' ) )
	die( 'Stop!!!' );

$rssarray = array( );

$sql = "SELECT category_id AS catid, parent_id AS parentid, name AS title, alias  FROM " . NV_PREFIXLANG . "_" . $mod_data . "_category ORDER BY sort_order";
$list = $nv_Cache->db( $sql, '', $mod_name );

foreach( $list as $value )
{
	$value['link'] = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $mod_name . "&amp;" . NV_OP_VARIABLE . "=" . $mod_info['alias']['rss'] . "/" . $value['alias'];
	$rssarray[] = $value;
}
