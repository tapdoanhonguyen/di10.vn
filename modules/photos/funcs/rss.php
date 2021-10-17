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

$channel = array( );
$items = array( );

$channel['title'] = $module_info['custom_title'];
$channel['link'] = NV_MY_DOMAIN . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name;
$channel['atomlink'] = NV_MY_DOMAIN . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=rss";
$channel['description'] = !empty( $module_info['description'] ) ? $module_info['description'] : $global_config['site_description'];

$category_id = 0;
if( isset( $array_op[1] ) )
{
	$alias_cat_url = $array_op[1];
	$cattitle = "";
	foreach( $global_photo_cat as $catid_i => $array_cat_i )
	{
		if( $alias_cat_url == $array_cat_i['alias'] )
		{
			$category_id = $catid_i;
			break;
		}
	}
}
if( !empty( $category_id ) )
{
	$channel['title'] = $module_info['custom_title'] . ' - ' . $global_photo_cat[$category_id]['name'];
	$channel['link'] = NV_MY_DOMAIN . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=rss/" . $alias_cat_url;
	$channel['description'] = $global_photo_cat[$category_id]['description'];

	$sql = 'SELECT a.album_id, a.category_id, a.date_added, a.name, a.alias, a.description, r.thumb FROM ' . TABLE_PHOTO_NAME . '_album a 
						LEFT JOIN  ' . TABLE_PHOTO_NAME . '_rows r ON ( a.album_id = r.album_id )
						WHERE a.status= 1 AND a.category_id=' . $category_id . ' AND r.defaults = 1 
						ORDER BY a.date_added DESC 
						LIMIT 0 , 30';
}
else
{
	$sql = 'SELECT a.album_id, a.category_id, a.date_added, a.name, a.alias, a.description, r.thumb FROM ' . TABLE_PHOTO_NAME . '_album a 
						LEFT JOIN  ' . TABLE_PHOTO_NAME . '_rows r ON ( a.album_id = r.album_id )
						WHERE a.status= 1 AND r.defaults = 1 
						ORDER BY a.date_added DESC 
						LIMIT 0 , 30';
}

if( $module_info['rss'] )
{
	$result = $db->query( $sql );
	while( list( $album_id, $category_id, $date_added, $title, $alias, $hometext, $homeimgfile ) = $result->fetch( 3 ) )
	{
		$catalias = $global_photo_cat[$category_id]['alias'];
		$rimages = (!empty( $homeimgfile )) ? "<img src=\"" . NV_MY_DOMAIN . NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/thumbs" . $homeimgfile . "\" width=\"100\" align=\"left\" border=\"0\">" : "";
		$items[] = array( //
			'title' => $title, //
			'link' => NV_MY_DOMAIN . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $catalias . '/' . $alias . '-' . $album_id, //
			'guid' => $module_name . '_' . $album_id, //
			'description' => $rimages . $hometext, //
			'pubdate' => $date_added //
		);
	}
}

nv_rss_generate( $channel, $items );
die( );
