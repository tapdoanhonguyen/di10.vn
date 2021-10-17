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

if( !nv_function_exists( 'photos_thumbs' ) )
{
	function photos_thumbs( $id, $file, $module_upload, $width = 270, $height = 210, $quality = 90 )
	{
		if( $width >= $height )
			$rate = $width / $height;
		else
			$rate = $height / $width;

		$image = NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/images/' . $file;

		if( $file != '' and file_exists( $image ) )
		{
			$imgsource = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/images/' . $file;
			$imginfo = nv_is_image( $image );

			$basename = $module_upload . '_' . $width . 'x' . $height . '-' . $id . '-' . md5_file( $image ) . '.' . $imginfo['ext'];

			if( file_exists( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/thumbs/' . $basename ) )
			{
				$imgsource = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/thumbs/' . $basename;
			}
			else
			{

				$_image = new NukeViet\Files\Image( $image, NV_MAX_WIDTH, NV_MAX_HEIGHT );

				if( $imginfo['width'] <= $imginfo['height'] )
				{
					$_image->resizeXY( $width, 0 );

				}
				elseif( ($imginfo['width'] / $imginfo['height']) < $rate )
				{
					$_image->resizeXY( $width, 0 );
				}
				elseif( ($imginfo['width'] / $imginfo['height']) >= $rate )
				{
					$_image->resizeXY( 0, $height );
				}

				$_image->cropFromCenter( $width, $height );

				$_image->save( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/thumbs/', $basename, $quality );

				if( file_exists( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/thumbs/' . $basename ) )
				{
					$imgsource = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/thumbs/' . $basename;
				}
			}
		}
		elseif( nv_is_url( $file ) )
		{
			$imgsource = $file;
		}
		else
		{
			$imgsource = '';
		}
		return $imgsource;
	}

}

if( !nv_function_exists( 'nv_block_album_new' ) )
{
	function nv_block_config_album_new( $module, $data_block, $lang_block )
	{
		global $site_mods;

		$html = '<tr>';
		$html .= '<td>' . $lang_block['numrow'] . '</td>';
		$html .= '<td><input type="text" class="form-control w200" name="config_numrow" size="5" value="' . $data_block['numrow'] . '"/></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>' . $lang_block['title_length'] . '</td>';
		$html .= '<td><input type="text" class="form-control w200" name="config_title_length" size="5" value="' . $data_block['title_length'] . '"/></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>' . $lang_block['des_length'] . '</td>';
		$html .= '<td><input type="text" class="form-control w200" name="config_des_length" size="5" value="' . $data_block['des_length'] . '"/></td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td>' . $lang_block['grid_mode'] . '</td>';
		$html .= '<td><input type="checkbox" value="1" name="config_grid_mode" ' . ($data_block['grid_mode'] == 1 ? 'checked="checked"' : '') . ' /></td>';
		$html .= '</tr>';

		return $html;
	}

	function nv_block_config_album_new_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array( );
		$return['error'] = array( );
		$return['config'] = array( );
		$return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post', 0 );
		$return['config']['title_length'] = $nv_Request->get_int( 'config_title_length', 'post', 0 );
		$return['config']['des_length'] = $nv_Request->get_int( 'config_des_length', 'post', 0 );
		$return['config']['grid_mode'] = $nv_Request->get_int( 'config_grid_mode', 'post', 0 );
		return $return;
	}

	function nv_block_album_new( $block_config )
	{
		global $nv_Cache, $module_photo_category, $module_info, $site_mods, $module_config, $global_config, $db, $blockID;

		$module = $block_config['module'];

		$thumb_width = $module_config[$module]['cr_thumb_width'];
		$thumb_height = $module_config[$module]['cr_thumb_height'];
		$thumb_quality = $module_config[$module]['cr_thumb_quality'];

		$mod_data = $site_mods[$module]['module_data'];
		$mod_file = $site_mods[$module]['module_file'];

		$db->sqlreset( )->select( 'a.album_id, a.category_id, a.name, a.alias, a.capturelocal, a.description, a.num_photo, a.date_added, a.capturedate, r.file, r.thumb' )->from( NV_PREFIXLANG . '_' . $mod_data . '_album a LEFT JOIN  ' . NV_PREFIXLANG . '_' . $mod_data . '_rows r ON ( a.album_id = r.album_id )' )->where( 'a.status= 1 AND r.defaults = 1' )->order( 'a.date_added DESC' )->limit( $block_config['numrow'] );

		$list = $nv_Cache->db( $db->sql( ), 'album_id', $module );

		if( !empty( $list ) )
		{
			if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $mod_file . '/block_album_new.tpl' ) )
			{
				$block_theme = $global_config['module_theme'];
			}
			else
			{
				$block_theme = 'default';
			}

			$xtpl = new XTemplate( 'block_album_new.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file );
			$xtpl->assign( 'BLOCK_ID', $blockID );
			foreach( $list as $album )
			{
				$album['name'] = nv_clean60( $album['name'], $block_config['title_length'] );
				$album['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $module_photo_category[$album['category_id']]['alias'] . '/' . $album['alias'] . '-' . $album['album_id'];
				$album['description'] = strip_tags( nv_clean60( $album['description'], $block_config['des_length'] ) );
				$album['date_added'] = nv_date( 'd/m/Y', $album['date_added'] );
				$album['capturedate'] = nv_date( 'd/m/Y', $album['capturedate'] );
				$album['thumb'] = photos_thumbs( $album['album_id'], $album['file'], $module, $thumb_width, $thumb_height, $thumb_quality );
				$album['file'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/images/' . $album['file'];

				$xtpl->assign( 'ALBUM', $album );
				if( $block_config['grid_mode'] == 1 )
				{
					$xtpl->parse( 'grid.loop_album' );
				}
				else
				{
					$xtpl->parse( 'main.loop_album' );
				}
			}

			if( $block_config['grid_mode'] == 1 )
			{
				$xtpl->parse( 'grid' );
				return $xtpl->text( 'grid' );
			}
			$xtpl->parse( 'main' );
			return $xtpl->text( 'main' );
		}
	}

}
if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name, $global_photo_cat, $module_photo_category;
	$module = $block_config['module'];
	if( isset( $site_mods[$module] ) )
	{
		if( $module == $module_name )
		{
			$module_photo_category = $global_photo_cat;
			unset( $module_photo_category[0] );
		}
		else
		{
			$module_photo_category = array( );
			$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_category ORDER BY sort_order ASC';
			$list = $nv_Cache->db( $sql, 'category_id', $module );
			foreach( $list as $l )
			{
				$module_photo_category[$l['category_id']] = $l;
				$module_photo_category[$l['category_id']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];
			}
		}
		$content = nv_block_album_new( $block_config );
	}
}
