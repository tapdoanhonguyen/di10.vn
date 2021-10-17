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

/**
 * home_view_grid_by_cat()
 *
 * @param mixed $array_data
 * @return
 *
 */
function home_view_grid_by_cat( $array_cate )
{
	global $global_config, $global_photo_cat, $module_name, $module_upload, $op_file, $lang_module, $module_config, $module_info, $op;

	$xtpl = new XTemplate( 'home_view_grid.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_file'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'MODULE_FILE', $module_info['module_file'] );	$xtpl->assign('MODULE_NAME', $lang_module['photo']);
	$xtpl->assign( 'OP', $op );
	$per_line = 24 / $module_config[$module_name]['per_line'];
	$xtpl->assign( 'PER_LINE', $per_line );

	if( isset( $module_config[$module_name]['home_layout'] ) && !empty( $module_config[$module_name]['home_layout'] ) )
	{
		$module_info['layout_funcs'][$op_file] = $module_config[$module_name]['home_layout'];
	}

	if( !empty( $array_cate ) )
	{
		foreach( $array_cate as $array_cat_i )
		{
			foreach( $array_cat_i['data'] as $album )
			{
				if( isset( $module_config[$module_name]['home_title_cut'] ) && !empty( $module_config[$module_name]['home_title_cut'] ) )
				{
					$album['name'] = nv_clean60( $album['name'], $module_config[$module_name]['home_title_cut'] );
				}
				$album['description'] = nv_clean60( $album['description'], 100 );
				$album['date_added'] = nv_date( 'd/m/Y', $album['date_added'] );
				$album['thumb'] = photos_thumbs( $album['album_id'], $album['file'], $module_upload, $module_config[$module_name]['cr_thumb_width'], $module_config[$module_name]['cr_thumb_height'], $module_config[$module_name]['cr_thumb_quality'] );
				$album['file'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/images/' . $album['file'];

				$xtpl->assign( 'ALBUM', $album );
				$xtpl->parse( 'main.loop_catalog.loop_album' );
				$xtpl->set_autoreset( );
			}

			if( !empty( $array_cat_i['subcatid'] ) )
			{
				$array_cat_i['subcatid'] = explode( ',', $array_cat_i['subcatid'] );
				foreach( $array_cat_i['subcatid'] as $subcatid )
				{
					$items = $global_photo_cat[$subcatid];
					if( $items['inhome'] )
					{
						$xtpl->assign( 'SUBCAT', $global_photo_cat[$subcatid] );
						$xtpl->parse( 'main.loop_catalog.subcatloop' );
					}
				}
			}
			$xtpl->assign( 'CATALOG', $array_cat_i );
			if( $array_cat_i['num_album'] > 0 )
			{
				$xtpl->parse( 'main.loop_catalog' );
			}
		}
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * home_view_grid_by_album()
 *
 * @param mixed $array_data
 * @return
 *
 */
function home_view_grid_by_album( $array_album, $generate_page )
{
	global $global_config, $global_photo_cat, $module_name, $module_upload, $op_file, $lang_module, $module_config, $module_info, $op;

	$xtpl = new XTemplate( 'home_view_grid.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_file'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'MODULE_FILE', $module_info['module_file'] );	$xtpl->assign('MODULE_NAME', $lang_module['photo']);
	$xtpl->assign( 'OP', $op );
	$per_line = 24 / $module_config[$module_name]['per_line'];
	$xtpl->assign( 'PER_LINE', $per_line );

	if( isset( $module_config[$module_name]['home_layout'] ) && !empty( $module_config[$module_name]['home_layout'] ) )
	{
		$module_info['layout_funcs'][$op_file] = $module_config[$module_name]['home_layout'];
	}

	if( !empty( $array_album ) )
	{
		foreach( $array_album as $album )
		{
			if( isset( $module_config[$module_name]['home_title_cut'] ) && !empty( $module_config[$module_name]['home_title_cut'] ) )
			{
				$album['name'] = nv_clean60( $album['name'], $module_config[$module_name]['home_title_cut'] );
			}
			$album['description'] = nv_clean60( $album['description'], 100 );
			$album['date_added'] = nv_date( 'd/m/Y', $album['date_added'] );
			$album['thumb'] = photos_thumbs( $album['album_id'], $album['file'], $module_upload, $module_config[$module_name]['cr_thumb_width'], $module_config[$module_name]['cr_thumb_height'], $module_config[$module_name]['cr_thumb_quality'] );
			$album['file'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/images/' . $album['file'];
			$xtpl->assign( 'ALBUM', $album );
			$xtpl->parse( 'main.grid_album.loop_album' );
			$xtpl->set_autoreset( );
		}
		$xtpl->parse( 'main.grid_album' );
	}

	if( !empty( $generate_page ) )
	{
		$xtpl->assign( 'GENERATE_PAGE', $generate_page );
		$xtpl->parse( 'main.generate_page' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * viewcat_grid()
 *
 * @param mixed $array_data
 * @return
 *
 */
function viewcat_grid( $array_catpage, $generate_page )
{
	global $global_config, $category_id, $global_photo_cat, $client_info, $module_name, $module_upload, $op_file, $lang_module, $module_config, $module_info, $op;

	$xtpl = new XTemplate( 'viewcat_grid.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_file'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'MODULE_FILE', $module_info['module_file'] );	$xtpl->assign('MODULE_NAME', $lang_module['photo']);
	$xtpl->assign( 'OP', $op );
	$xtpl->assign( 'CATALOG', $global_photo_cat[$category_id] );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$per_line = 24 / $module_config[$module_name]['per_line'];
	$xtpl->assign( 'PER_LINE', $per_line );
	if( !empty( $array_catpage ) )
	{
		if( isset( $global_photo_cat[$category_id]['layout'] ) && !empty( $global_photo_cat[$category_id]['layout'] ) )
		{
			$module_info['layout_funcs'][$op_file] = $global_photo_cat[$category_id]['layout'];
		}

		foreach( $array_catpage as $album )
		{
			$album['description'] = nv_clean60( $album['description'], 100 );
			$album['date_added'] = nv_date( 'd/m/Y', $album['date_added'] );
			$album['thumb'] = photos_thumbs( $album['album_id'], $album['file'], $module_upload, $module_config[$module_name]['cr_thumb_width'], $module_config[$module_name]['cr_thumb_height'], $module_config[$module_name]['cr_thumb_quality'] );
			$album['file'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/images/' . $album['file'];

			$xtpl->assign( 'ALBUM', $album );
			$xtpl->parse( 'main.loop_album' );
		}
	}

	if( !empty( $generate_page ) )
	{
		$xtpl->assign( 'GENERATE_PAGE', $generate_page );
		$xtpl->parse( 'main.generate_page' );
	}

	if( $module_config[$module_name]['social_tool'] > 0 )
	{
		$xtpl->parse( 'main.social_tool' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * detail_album()
 *
 * @param mixed $album
 * @return
 *
 */
function detail_album( $album, $array_photo, $other_category_album, $content_comment, $generate_page = '', $page = 1 )
{
	global $global_config, $category_id, $client_info, $global_photo_cat, $module_name, $module_upload, $lang_module, $op_file, $module_config, $module_info, $op;
	$xtpl = new XTemplate( 'detail_album.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_file'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'MODULE_FILE', $module_info['module_file'] );	$xtpl->assign('MODULE_NAME', $lang_module['photo']);
	$xtpl->assign( 'OP', $op );
	$xtpl->assign( 'CATALOG', $global_photo_cat[$category_id] );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
	$per_line = 24 / $module_config[$module_name]['per_line'];
	$xtpl->assign( 'PER_LINE', $per_line );

	if( !empty( $album ) )
	{
		if( isset( $album['layout'] ) && !empty( $album['layout'] ) )
		{
			$module_info['layout_funcs'][$op_file] = $album['layout'];
		}
		// $album['description'] = nv_clean60( $album['description'], 100 );
		$album['date_added'] = nv_date( 'd/m/Y', $album['date_added'] );
		$xtpl->assign( 'ALBUM', $album );

		$per_page = $module_config[$module_name]['per_page_photo'];
		$num = 1;
		if( $page > 1 )
			$num = 1 + (($page - 1) * $per_page);
		if( !empty( $array_photo ) )
		{
			foreach( $array_photo as $photo )
			{
				$photo['thumb'] = photos_thumbs( $photo['row_id'], $photo['file'], $module_upload, $module_config[$module_name]['cr_thumb_width'], $module_config[$module_name]['cr_thumb_height'], $module_config[$module_name]['cr_thumb_quality'] );
				$photo['file'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/images/' . $photo['file'];
				$photo['description'] = !empty( $photo['description'] ) ? $photo['description'] : $photo['name'];
				$photo['num'] = $num;
				$photo['link_img'] = $global_photo_cat[$category_id]['link'] . '/' . $album['alias'] . '-' . $photo['album_id'] . '/' . $photo['row_id'] . $global_config['rewrite_exturl'];
				$xtpl->assign( 'PHOTO', $photo );
				$xtpl->parse( 'main.view_grid.loop_img' );
				$xtpl->parse( 'main.slider.loop_slide' );
				++$num;
			}
		}
	}
	if( $module_config[$module_name]['social_tool'] > 0 )
	{
		$xtpl->parse( 'main.social_tool' );
	}

	if( !empty( $content_comment ) )
	{
		$xtpl->assign( 'CONTENT_COMMENT', $content_comment );
		$xtpl->parse( 'main.comment' );
	}

	if( !empty( $generate_page ) )
	{
		$xtpl->assign( 'GENERATE_PAGE', $generate_page );
		$xtpl->parse( 'main.generate_page' );
	}

	if( $module_config[$module_name]['album_view'] == 'album_view_grid' )
	{
		if( !empty( $album['description'] ) )
		{
			$xtpl->parse( 'main.view_grid.description' );
		}

		$xtpl->parse( 'main.view_grid' );
	}
	elseif( $module_config[$module_name]['album_view'] == 'album_view_slider' )
	{
		if( !empty( $album['description'] ) )
		{
			$xtpl->parse( 'main.slider.description' );
		}

		$xtpl->parse( 'main.slider' );
	}

	if( !empty( $other_category_album ) )
	{
		$key = 1;
		foreach( $other_category_album as $other )
		{
			$other['description'] = nv_clean60( $other['description'], 100 );
			$other['date_added'] = nv_date( 'd/m/Y', $other['date_added'] );
			$other['thumb'] = photos_thumbs( $other['album_id'], $other['file'], $module_upload, $module_config[$module_name]['cr_thumb_width'], $module_config[$module_name]['cr_thumb_height'], $module_config[$module_name]['cr_thumb_quality'] );
			$other['file'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/images/' . $other['file'];
			$other['key'] = $key;
			$xtpl->assign( 'OTHER', $other );
			++$key;
			$xtpl->parse( 'main.other_album.loop_album' );
		}
		$xtpl->parse( 'main.other_album' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function detail( $row, $next_photo, $previous_photo )
{
	global $global_config, $category_id, $client_info, $global_photo_cat, $global_photo_album, $module_name, $module_upload, $op_file, $lang_module, $module_config, $module_info, $op;

	$xtpl = new XTemplate( 'detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_file'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
	$xtpl->assign( 'MODULE_FILE', $module_info['module_file'] );	$xtpl->assign('MODULE_NAME', $lang_module['photo']);
	$xtpl->assign( 'OP', $op );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );

	if( !empty( $row ) )
	{
		if( isset( $global_photo_album[$row['album_id']]['layout'] ) && !empty( $global_photo_album[$row['album_id']]['layout'] ) )
		{
			$module_info['layout_funcs'][$op_file] = $global_photo_album[$row['album_id']]['layout'];
		}

		$row['file'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/images/' . $row['file'];
		$xtpl->assign( 'PHOTO', $row );
	}

	if( $module_config[$module_name]['social_tool'] > 0 )
	{
		$xtpl->parse( 'main.social_tool' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function no_permission( $no_permission )
{
	global $module_info, $lang_module;

	$xtpl = new XTemplate( 'no_permission.tpl', NV_ROOTDIR . '/themes/default/modules/' . $module_info['module_file'] );

	$xtpl->assign( 'NO_PERMISSION', $no_permission );
	$xtpl->parse( 'no_permission' );
	return $xtpl->text( 'no_permission' );
}

// Search
function search_theme( $key, $date_array, $array_cat_search )
{
	global $module_name, $module_info, $lang_module, $module_name;

	$xtpl = new XTemplate( 'search.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_file'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
	$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
	$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
	$xtpl->assign( 'MODULE_NAME', $module_name );
	$xtpl->assign( 'BASE_URL_SITE', NV_BASE_SITEURL . 'index.php' );
	$xtpl->assign( 'TO_DATE', $date_array['to_date'] );
	$xtpl->assign( 'FROM_DATE', $date_array['from_date'] );
	$xtpl->assign( 'KEY', $key );
	$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
	$xtpl->assign( 'OP_NAME', 'search' );

	foreach( $array_cat_search as $search_cat )
	{
		$xtpl->assign( 'SEARCH_CAT', $search_cat );
		$xtpl->parse( 'main.search_cat' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

function search_result_theme( $key, $numRecord, $per_pages, $page, $array_content, $catid )
{
	global $module_info, $lang_module, $module_name, $module_upload, $global_photo_cat, $module_config, $global_config;

	$xtpl = new XTemplate( 'search.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_file'] );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'KEY', $key );
	$xtpl->assign( 'TITLE_MOD', $lang_module['search_module_title'] );

	if( !empty( $array_content ) )
	{
		foreach( $array_content as $value )
		{
			$xtpl->assign( 'LINK', $global_photo_cat[$value['category_id']]['link'] . '/' . $value['alias'] . "-" . $value['album_id'] . $global_config['rewrite_exturl'] );
			$xtpl->assign( 'TITLEROW', strip_tags( BoldKeywordInStr( $value['name'], $key ) ) );
			if( !empty( $value['description'] ) )
			{
				$xtpl->assign( 'CONTENT', BoldKeywordInStr( $value['description'], $key ) . "..." );
			}
			$xtpl->assign( 'TIME', nv_date( 'H:i d/m/Y', $value['date_added'] ) );
			$value['src'] = photos_thumbs( $value['album_id'], $value['file'], $module_upload, $module_config[$module_name]['cr_thumb_width'], $module_config[$module_name]['cr_thumb_height'], $module_config[$module_name]['cr_thumb_quality'] );
			if( !empty( $value['src'] ) )
			{
				$xtpl->assign( 'IMG_SRC', $value['src'] );
				$xtpl->parse( 'results.result.result_img' );
			}

			$xtpl->parse( 'results.result' );
		}
	}

	if( $numRecord == 0 )
	{
		$xtpl->assign( 'KEY', $key );
		$xtpl->assign( 'INMOD', $lang_module['search_modul_title'] );
		$xtpl->parse( 'results.noneresult' );
	}

	if( $numRecord > $per_pages )// show pages
	{
		$url_link = $_SERVER['REQUEST_URI'];
		if( strpos( $url_link, '&page=' ) > 0 )
		{
			$url_link = substr( $url_link, 0, strpos( $url_link, '&page=' ) );
		}
		elseif( strpos( $url_link, '?page=' ) > 0 )
		{
			$url_link = substr( $url_link, 0, strpos( $url_link, '?page=' ) );
		}
		$_array_url = array(
			'link' => $url_link,
			'amp' => '&page='
		);
		$generate_page = nv_generate_page( $_array_url, $numRecord, $per_pages, $page );

		$xtpl->assign( 'VIEW_PAGES', $generate_page );
		$xtpl->parse( 'results.pages_result' );
	}

	$xtpl->assign( 'NUMRECORD', $numRecord );
	$xtpl->assign( 'MY_DOMAIN', NV_MY_DOMAIN );

	$xtpl->parse( 'results' );
	return $xtpl->text( 'results' );
}
