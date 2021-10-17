<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */

if( !defined( 'NV_IS_MOD_SEARCH' ) )
	die( 'Stop!!!' );
$db->sqlreset( )->select( 'COUNT(*)' )->from( NV_PREFIXLANG . '_' . $m_values['module_data'] . '_album a ' )->join( 'LEFT JOIN ' . NV_PREFIXLANG . '_' . $m_values['module_data'] . '_category c ON (c.category_id=a.category_id)' )->where( '(' . nv_like_logic( 'a.name', $dbkeyword, $logic ) . ' OR ' . nv_like_logic( 'a.description', $dbkeyword, $logic ) . ')	AND a.status=1' );

$num_items = $db->query( $db->sql( ) )->fetchColumn( );
if( $num_items )
{
	$array_cat_alias = array( );
	$array_cat_alias[0] = 'other';

	$db->select( 'c.category_id, c.alias ' );

	$re_cat = $db->query( $db->sql( ) );

	while( list( $category_id, $alias ) = $re_cat->fetch( 3 ) )
	{
		$array_cat_alias[$category_id] = $alias;
	}

	$link = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $m_values['module_name'] . '&amp;' . NV_OP_VARIABLE . '=';

	$db->select( 'a.album_id, a.name, a.category_id, a.alias, a.description' )->order( 'a.date_added DESC' )->limit( $limit )->offset( ($page - 1) * $limit );
	$result = $db->query( $db->sql( ) );
	while( list( $album_id, $tilterow, $category_id, $alias, $description ) = $result->fetch( 3 ) )
	{
		$content = $description;
		$url = $link . $array_cat_alias[$category_id] . '/' . $alias . "-" . $album_id . $global_config['rewrite_exturl'];

		$result_array[] = array(
			'link' => $url,
			'title' => BoldKeywordInStr( $tilterow, $key, $logic ),
			'content' => BoldKeywordInStr( $content, $key, $logic )
		);
	}
}
