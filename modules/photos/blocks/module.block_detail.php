<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */

if( !defined( 'NV_MAINFILE' ) )
	die( 'Stop!!!' );

if( !nv_function_exists( 'block_photo_detail' ) )
{

	function block_photo_detail( $block_config )
	{
		global $module_photo_cat, $module_name, $lang_module, $op, $client_info, $site_mods, $module_info, $db, $module_config, $global_config, $blockID, $nv_Request;
		$module = $block_config['module'];
		$mod_data = $site_mods[$module]['module_data'];
		$mod_file = $site_mods[$module]['module_file'];

		if( file_exists( NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $mod_file . '/module.block_detail.tpl' ) )
		{
			$block_theme = $module_info['template'];
		}
		else
		{
			$block_theme = 'default';
		}
		$xtpl = new XTemplate( 'module.block_detail.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file . '/' );
		$xtpl->assign( 'LANG', $lang_module );
		$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
		$xtpl->assign( 'TEMPLATE', $module_info['template'] );
		$xtpl->assign( 'MODULE_FILE', $mod_file );
		$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
		$xtpl->assign( 'BLOCK_ID', $blockID );

		if( $op == 'detail_album' )
		{
			global $data_album;
			$data_album['image'] = NV_MY_DOMAIN . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/images/' . $data_album['file'];
			$data_album['thumb'] = NV_MY_DOMAIN . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/thumbs/' . $data_album['thumb'];
			if( $data_album['allow_rating'] > 0 )
			{
				$time_set_rating = $nv_Request->get_int( $module_name . '_' . $op . '_' . $data_album['album_id'], 'cookie', 0 );
				if( $time_set_rating > 0 )
				{
					$data_album['disablerating'] = 1;
				}
				else
				{
					$data_album['disablerating'] = 0;
				}

				$ratingwidth = ($data_album['total_rating'] > 0) ? ($data_album['total_rating'] * 100 / ($data_album['click_rating'] * 5)) * 0.01 : 0;

				$data_album['langstar'] = array(
					'note' => $lang_module['star_note'],
					'verypoor' => $lang_module['star_verypoor'],
					'poor' => $lang_module['star_poor'],
					'ok' => $lang_module['star_ok'],
					'good' => $lang_module['star_good}'],
					'verygood' => $lang_module['star_verygood']
				);
			}

			$xtpl->assign( 'RATINGVALUE', ($data_album['total_rating'] > 0) ? round( $data_album['total_rating'] / $data_album['click_rating'], 1 ) : 0 );
			$xtpl->assign( 'RATINGCOUNT', $data_album['click_rating'] );
			$xtpl->assign( 'REVIEWCOUNT', $data_album['total_rating'] );
			$xtpl->assign( 'RATINGWIDTH', round( $ratingwidth, 2 ) );
			$xtpl->assign( 'ALBUM_ID', $data_album['album_id'] );
			$xtpl->assign( 'LANGSTAR', $data_album['langstar'] );

			$checkss = md5( $data_album['album_id'] . session_id( ) . $global_config['sitekey'] );
			$xtpl->assign( 'CHECKSS', $checkss );
			$xtpl->assign( 'LINK_RATE', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module . '&' . NV_OP_VARIABLE . '=rating&album_id=' . $data_album['album_id'] );

			$data_album['capturedate'] = nv_date( 'd-m-Y', $data_album['capturedate'] );
			$xtpl->assign( 'DATA', $data_album );
			if( $data_album['model'] )
			{
				$xtpl->parse( 'album.model' );
			}
			if( $data_album['capturelocal'] )
			{
				$xtpl->parse( 'album.capturelocal' );
			}
			if( $data_album['capturedate'] )
			{
				$xtpl->parse( 'album.capturedate' );
			}
			if( $data_album['total_rating'] > 0 )
			{
				$xtpl->parse( 'album.allowed_rating.data_rating' );
			}

			if( $data_album['disablerating'] > 0 )
			{
				$xtpl->parse( 'album.allowed_rating.disablerating' );
			}

			if( $data_album['allow_rating'] > 0 )
			{
				$xtpl->parse( 'album.allowed_rating' );
			}
			$xtpl->parse( 'album' );
			return $xtpl->text( 'album' );
		}
		elseif( $op == 'detail' )
		{
			global $data_detail;
			// truy van lay thong tin album
			$query = $db->query( 'SELECT a.*, r.file, r.thumb FROM ' . TABLE_PHOTO_NAME . '_album a 
			LEFT JOIN  ' . TABLE_PHOTO_NAME . '_rows r ON ( a.album_id = r.album_id )
			WHERE a.status= 1 AND r.defaults = 1 AND a.album_id = ' . $data_detail['album_id'] );

			$album = $query->fetch( );
			if( $album['album_id'] > 0 )
			{
				$album['image'] = NV_MY_DOMAIN . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/images/' . $album['file'];
				$album['thumb'] = NV_MY_DOMAIN . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/thumbs/' . $album['thumb'];
				if( $album['allow_rating'] > 0 )
				{
					$time_set_rating = $nv_Request->get_int( $module_name . '_' . $op . '_' . $album['album_id'], 'cookie', 0 );
					if( $time_set_rating > 0 )
					{
						$album['disablerating'] = 1;
					}
					else
					{
						$album['disablerating'] = 0;
					}

					$ratingwidth = ($album['total_rating'] > 0) ? ($album['total_rating'] * 100 / ($album['click_rating'] * 5)) * 0.01 : 0;

					$album['langstar'] = array(
						'note' => $lang_module['star_note'],
						'verypoor' => $lang_module['star_verypoor'],
						'poor' => $lang_module['star_poor'],
						'ok' => $lang_module['star_ok'],
						'good' => $lang_module['star_good}'],
						'verygood' => $lang_module['star_verygood']
					);
				}

				$xtpl->assign( 'RATINGVALUE', ($album['total_rating'] > 0) ? round( $album['total_rating'] / $album['click_rating'], 1 ) : 0 );
				$xtpl->assign( 'RATINGCOUNT', $album['click_rating'] );
				$xtpl->assign( 'REVIEWCOUNT', $album['total_rating'] );
				$xtpl->assign( 'RATINGWIDTH', round( $ratingwidth, 2 ) );
				$xtpl->assign( 'ALBUM_ID', $album['album_id'] );
				$xtpl->assign( 'LANGSTAR', $album['langstar'] );

				$checkss = md5( $album['album_id'] . session_id( ) . $global_config['sitekey'] );
				$xtpl->assign( 'CHECKSS', $checkss );
				$xtpl->assign( 'LINK_RATE', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module . '&' . NV_OP_VARIABLE . '=rating&album_id=' . $album['album_id'] );

				$album['capturedate'] = nv_date( 'd-m-Y', $album['capturedate'] );
				$xtpl->assign( 'DATA', $album );
				if( $album['model'] )
				{
					$xtpl->parse( 'detail.model' );
				}
				if( $album['capturelocal'] )
				{
					$xtpl->parse( 'detail.capturelocal' );
				}
				if( $album['capturedate'] )
				{
					$xtpl->parse( 'detail.capturedate' );
				}
				if( $album['total_rating'] > 0 )
				{
					$xtpl->parse( 'detail.allowed_rating.data_rating' );
				}

				if( $album['disablerating'] > 0 )
				{
					$xtpl->parse( 'detail.allowed_rating.disablerating' );
				}

				if( $album['allow_rating'] > 0 )
				{
					$xtpl->parse( 'detail.allowed_rating' );
				}
				$xtpl->parse( 'detail' );
				return $xtpl->text( 'detail' );
			}
		}
		elseif( $op == 'viewcat' )
		{
			global $category_id, $global_photo_cat;
			$db->sqlreset( )->select( 'COUNT(*)' )->from( TABLE_PHOTO_NAME . '_album' )->where( 'status=1 and category_id=' . $category_id );
			$num_albums = $db->query( $db->sql( ) )->fetchColumn( );

			$db->select( 'album_id, category_id, name, alias' )->order( 'viewed DESC' )->limit( 1 );
			$_top_view_album = $db->query( $db->sql( ) );
			while( $data = $_top_view_album->fetch( ) )
			{
				$data['link'] = $global_photo_cat[$data['category_id']]['link'] . '/' . $data['alias'] . '-' . $data['album_id'];
				$xtpl->assign( 'DATA', $data );
			}

			$xtpl->assign( 'NUM_ALBUMS', $num_albums );

			$xtpl->parse( 'viewcat' );
			return $xtpl->text( 'viewcat' );
		}
		elseif( $op == 'main' )
		{
			$db->sqlreset( )->select( 'COUNT(*)' )->from( TABLE_PHOTO_NAME . '_album' )->where( 'status =1' );
			$num_albums = $db->query( $db->sql( ) )->fetchColumn( );

			$db->sqlreset( )->select( 'COUNT(*)' )->from( TABLE_PHOTO_NAME . '_category' )->where( 'status =1' );
			$num_cats = $db->query( $db->sql( ) )->fetchColumn( );

			$db->sqlreset( )->select( 'COUNT(*)' )->from( TABLE_PHOTO_NAME . '_rows' )->where( 'status =1' );
			$num_photos = $db->query( $db->sql( ) )->fetchColumn( );

			$xtpl->assign( 'NUM_ALBUMS', $num_albums );
			$xtpl->assign( 'NUM_CATS', $num_cats );
			$xtpl->assign( 'NUM_PHOTOS', $num_photos );

			$xtpl->parse( 'main' );
			return $xtpl->text( 'main' );
		}
	}

}

if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name, $global_photo_cat, $module_photo_cat;
	$module = $block_config['module'];
	if( isset( $site_mods[$module] ) )
	{

		if( $module == $module_name )
		{
			$module_photo_cat = $global_photo_cat;
			unset( $module_photo_cat[0] );
		}
		else
		{
			$module_photo_cat = array( );
			$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_category ORDER BY sort_order ASC';
			$list = $nv_Cache->db( $sql, 'category_id', $module );
			foreach( $list as $l )
			{
				$module_photo_cat[$l['category_id']] = $l;
				$module_photo_cat[$l['category_id']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];

			}
		}
		$content = block_photo_detail( $block_config );
	}
}
