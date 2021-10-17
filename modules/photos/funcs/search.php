<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Mon, 21 Sep 2015 11:18:59 GMT
 */

if( !defined( 'NV_IS_MOD_PHOTO' ) )
	die( 'Stop!!!' );

$per_page = 20;
function GetSourceNews( $sourceid )
{
	global $db, $module_data;

	if( $sourceid > 0 )
	{
		$sql = 'SELECT title FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sources WHERE sourceid = ' . $sourceid;
		$re = $db->query( $sql );

		if( list( $title ) = $re->fetch( 3 ) )
		{
			return $title;
		}
	}
	return '-/-';
}

function BoldKeywordInStr( $str, $keyword )
{
	$str = nv_clean60( $str, 300 );
	if( !empty( $keyword ) )
	{
		$tmp = explode( ' ', $keyword );
		foreach( $tmp as $k )
		{
			$tp = strtolower( $k );
			$str = str_replace( $tp, '<span class="keyword">' . $tp . '</span>', $str );
			$tp = strtoupper( $k );
			$str = str_replace( $tp, '<span class="keyword">' . $tp . '</span>', $str );
			$k[0] = strtoupper( $k[0] );
			$str = str_replace( $k, '<span class="keyword">' . $k . '</span>', $str );
		}
	}
	return $str;
}

$key = $nv_Request->get_title( 'q', 'get', '' );
$key = str_replace( '+', ' ', $key );
$key = trim( nv_substr( $key, 0, NV_MAX_SEARCH_LENGTH ) );
$keyhtml = nv_htmlspecialchars( $key );

$base_url_rewrite = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op;
if( !empty( $key ) )
{
	$base_url_rewrite .= '&q=' . $key;
}

$catid = $nv_Request->get_int( 'catid', 'get', 0 );
if( !empty( $catid ) )
{
	$base_url_rewrite .= '&catid=' . $catid;
}
$from_date = $nv_Request->get_title( 'from_date', 'get', '', 0 );
$date_array['from_date'] = preg_replace( '/[^0-9]/', '.', urldecode( $from_date ) );
if( preg_match( '/^([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})$/', $date_array['from_date'] ) )
{
	$base_url_rewrite .= '&from_date=' . $date_array['from_date'];
}

$to_date = $nv_Request->get_title( 'to_date', 'get', '', 0 );
$date_array['to_date'] = preg_replace( '/[^0-9]/', '.', urldecode( $to_date ) );
if( preg_match( '/^([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})$/', $date_array['to_date'] ) )
{
	$base_url_rewrite .= '&to_date=' . $date_array['to_date'];
}

$page = $nv_Request->get_int( 'page', 'get', 1 );
if( !empty( $page ) )
{
	$base_url_rewrite .= '&page=' . $page;
}
$base_url_rewrite = nv_url_rewrite( $base_url_rewrite, true );

$request_uri = urldecode( $_SERVER['REQUEST_URI'] );
if( $request_uri != $base_url_rewrite and NV_MAIN_DOMAIN . $request_uri != $base_url_rewrite )
{
	header( 'Location: ' . $base_url_rewrite );
	die( );
}

$array_cat_search = array( );
foreach( $global_photo_cat as $arr_cat_i )
{
	$array_cat_search[$arr_cat_i['category_id']] = array(
		'catid' => $arr_cat_i['category_id'],
		'title' => $arr_cat_i['name'],
		'select' => ($arr_cat_i['category_id'] == $catid) ? 'selected' : ''
	);
}

$array_cat_search[0]['title'] = $lang_module['search_all'];

$contents = call_user_func( 'search_theme', $key, $date_array, $array_cat_search );
$where = '';
$tbl_src = '';
if( empty( $key ) and ($catid == 0) and empty( $from_date ) and empty( $to_date ) )
{
	$contents .= '<div class="alert alert-danger">' . $lang_module['empty_data_search'] . '</div>';
}
else
{
	$canonicalUrl = NV_MY_DOMAIN . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=search&amp;q=' . $key, true );

	$dbkey = $db->dblikeescape( $key );
	$dbkeyhtml = $db->dblikeescape( $keyhtml );
	$where = " AND ( a.name LIKE '%" . $dbkey . "%' OR a.description LIKE '%" . $dbkey . "%' )";

	if( preg_match( '/^([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})$/', $to_date, $m ) )
	{
		$where .= ' AND a.date_added <=' . mktime( 23, 59, 59, $m[2], $m[1], $m[3] );
	}
	if( preg_match( '/^([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})$/', $from_date, $m ) )
	{
		$where .= ' AND a.date_added >=' . mktime( 0, 0, 0, $m[2], $m[1], $m[3] );
	}

	if( $catid > 0 )
	{
		$where .= ' AND a.category_id =' . $catid;
	}

	$table_search = NV_PREFIXLANG . '_' . $module_data . '_album a';

	$db->sqlreset( )->select( 'COUNT(*)' )->from( $table_search )->join( 'LEFT JOIN  ' . TABLE_PHOTO_NAME . '_rows r ON ( a.album_id = r.album_id )' )->where( 'a.status=1 AND r.defaults = 1 ' . $where );

	$numRecord = $db->query( $db->sql( ) )->fetchColumn( );

	$db->select( 'a.album_id,a.name,a.alias,a.category_id,a.description,a.status,a.date_added, r.file' )->order( 'a.date_added DESC' )->limit( $per_page )->offset( ($page - 1) * $per_page );

	$result = $db->query( $db->sql( ) );

	$array_content = array( );

	while( list( $album_id, $name, $alias, $category_id, $description, $status, $date_added, $cover_file ) = $result->fetch( 3 ) )
	{
		$array_content[] = array(
			'album_id' => $album_id,
			'name' => $name,
			'alias' => $alias,
			'category_id' => $category_id,
			'description' => $description,
			'status' => $status,
			'date_added' => $date_added,
			'file' => $cover_file
		);
	}

	$contents .= search_result_theme( $key, $numRecord, $per_page, $page, $array_content, $catid );
}

if( empty( $key ) )
{
	$page_title = $lang_module['search_title'] . ' ' . NV_TITLEBAR_DEFIS . ' ' . $module_info['custom_title'];
}
else
{
	$page_title = $key . ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_module['search_title'];
	if( $page > 2 )
	{
		$page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['page'] . ' ' . $page;
	}
	$page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $module_info['custom_title'];
}

$key_words = $description = 'no';
$mod_title = isset( $lang_module['main_title'] ) ? $lang_module['main_title'] : $module_info['custom_title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
