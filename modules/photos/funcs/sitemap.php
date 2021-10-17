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

$url = array( );
$cacheFile = NV_LANG_DATA . '_sitemap_' . NV_CACHE_PREFIX . '.cache';
$cacheTTL = 7200;

if( ($cache = $nv_Cache->getItem( $module_name, $cacheFile, $cacheTTL )) != false )
{
	$url = unserialize( $cache );
}
else
{
	$sql = 'SELECT a.album_id, a.category_id, a.date_added, a.alias FROM ' . TABLE_PHOTO_NAME . '_album a 
						LEFT JOIN  ' . TABLE_PHOTO_NAME . '_rows r ON ( a.album_id = r.album_id )
						WHERE a.status= 1 AND r.defaults = 1 
						ORDER BY a.date_added DESC';
	$result = $db->query( $sql );
	while( list( $album_id, $category_id, $date_added, $alias ) = $result->fetch( 3 ) )
	{
		$catalias = $global_photo_cat[$category_id]['alias'];
		$url[] = array( //
			'link' => NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $catalias . '/' . $alias . '-' . $album_id, //
			'publtime' => $date_added //
		);
	}

	$cache = serialize( $url );
	$nv_Cache->setItem( $module_name, $cacheFile, $cache, $cacheTTL );
}

nv_xmlSitemap_generate( $url );
die( );
