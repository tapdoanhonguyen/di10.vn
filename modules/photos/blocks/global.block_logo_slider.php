<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com) 
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS 
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_logo_slider' ) )
{
	function nv_block_config_logo_slider( $module, $data_block, $lang_block )
	{
		global $nv_Cache, $site_mods;
		$html = '';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['album_id'] . ':</label>';

        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_album ORDER BY album_id ASC';
        $list = $nv_Cache->db($sql, '', $module);
        if (!is_array($data_block['album_id'])) {
            $data_block['album_id'] = array($data_block['album_id']);
        }

        $html .= '<div class="col-sm-18">';
        foreach ($list as $l) {
            if ($l['status'] == 1 or $l['status'] == 2) {
                $xtitle_i = '';

                if ($l['lev'] > 0) {
                    for ($i = 1; $i <= $l['lev']; ++$i) {
                        $xtitle_i .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    }
                }
                $html .= $xtitle_i . '<label><input type="checkbox" name="config_album_id[]" value="' . $l['album_id'] . '" ' . ((in_array($l['album_id'], $data_block['album_id'])) ? ' checked="checked"' : '') . '</input>' . $l['name'] . '</label><br />';
            }
        }
        $html .= '</div>';
        $html .= '</div>';		
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['numrow'] . ':</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_numrow" size="5" value="' . $data_block['numrow'] . '"/></div>';
        $html .= '</div>';
		return $html;
	}

	function nv_block_config_logo_slider_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config'] = array();
		$return['config']['album_id'] = $nv_Request->get_array( 'config_album_id', 'post', array() );
		$return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post', 0 );
		return $return;
	}

	function nv_block_logo_slider( $block_config )
	{
		global $nv_Cache, $module_photo_category, $module_info, $site_mods, $module_config, $lang_module, $global_config, $db, $blockID;
		
		$module = $block_config['module'];
		$mod_data = $site_mods[$module]['module_data'];
		$mod_file = $site_mods[$module]['module_file'];
 
		if( empty( $block_config['album_id'] ) ) return '';

		$album_id = implode( ',', $block_config['album_id'] );
 
		$db->sqlreset()
			->select( 'row_id, album_id, name, description, file' )
			->from( NV_PREFIXLANG . '_' . $mod_data . '_rows' )
			->where( 'album_id IN(' . $album_id . ') ' )
			->limit( $block_config['numrow'] );
		$list = $nv_Cache->db( $db->sql(), 'row_id', $module );
        
		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme']  . '/modules/' . $mod_file . '/block_logo_slider.tpl' ) )
		{
			$block_theme = $global_config['module_theme'] ;
		}
		else
		{
			$block_theme = 'default';
		}

		$xtpl = new XTemplate( 'block_logo_slider.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file );

		foreach( $list as $album )
		{
			$album['description'] =  nv_clean60( $album['description'] ) ;
			$album['file'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/images/' . $album['file'];
			$xtpl->assign( 'ALBUM', $album );
			$xtpl->parse( 'main.loop' );
		}
		$xtpl->parse('main');
		return $xtpl->text('main');
	}
}
if( defined( 'NV_SYSTEM' ) )
{
	global $nv_Cache, $site_mods, $module_name, $global_photo_cat, $module_photo_category;
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
			$module_photo_category = array();
			$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_album ORDER BY album_id ASC';
			$list = $nv_Cache->db( $sql, 'album_id', $module );
			foreach( $list as $l )
			{
				$module_photo_category[$l['album_id']] = $l;
				$module_photo_category[$l['album_id']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];
			}
		}
		$content = nv_block_logo_slider( $block_config );
	}
}
