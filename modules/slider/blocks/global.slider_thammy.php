<?php

/**
 * @Project NUKEVIET 4.x
 * @Author 
 * @Copyright (C) 2017 
 * @License GNU/GPL version 2 or any later version
 * @Createdate 08/06/2017 18:00
 */

if (! defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (! nv_function_exists('nv_block_slider_thammy')) {
    /**
     * nv_block_config_slider()
     *
     * @param mixed $module
     * @param mixed $data_block
     * @param mixed $lang_block
     * @return
     */
    function nv_block_config_slider_thammy($module, $data_block, $lang_block)
    {
        global $site_mods, $nv_Cache;
		if( defined( 'NV_EDITOR' ) )
		    {
			require NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
		    }
			$gioithieu = htmlspecialchars( nv_editor_br2nl( $data_block['gioithieu'] ) );
		    if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
		    {
			$gioithieu = nv_aleditor( 'config_gioithieu', '100%', '150px', $gioithieu, 'Basic' );
		    }
		    else
		    {
			$gioithieu = '<textarea class=\"form-control w500\" name="config_gioithieu" id="config_gioithieu" cols="20" rows="8">' . $gioithieu . '</textarea>';
		    }

        $html = '';

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['blockid'] . '</label>';
        $html .= '<div class="col-sm-18">';
        $html .= '<select name="config_blockid" class="w300 form-control">';

        $sql = 'SELECT bid, title FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_blocks ORDER BY title ASC';
        $list = $nv_Cache->db($sql, '', $module);

        foreach ($list as $row) {
            $html .= '	<option value="' . $row['bid'] . '"' . ($row['bid'] == $data_block['blockid'] ? ' selected="selected"' : '') . '>' . $row['title'] . '</option>';
        }

        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['numrows'] . '</label>';
        $html .= '<div class="col-sm-18">';
        $html .= '<select name="config_numrows" class="w300 form-control">';

        for ($i = 1; $i <= 10; $i ++) {
            $html .= '	<option value="' . $i . '"' . ($i == $data_block['numrows'] ? ' selected="selected"' : '') . '>' . $i . '</option>';
        }

        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';
		
		$html .= '<div class="form-group">';
	        $html .= '<label class="control-label col-sm-6">Content</label>';
	        $html .= '<div class="col-sm-18">' . $gioithieu . '</div>';
	        $html .= '</div>';
		
        return $html;
    }

    /**
     * nv_block_config_slider_submit()
     *
     * @param mixed $module
     * @param mixed $lang_block
     * @return
     */
    function nv_block_config_slider_thammy_submit($module, $lang_block)
    {
        global $nv_Request;
		$gioithieu = $nv_Request->get_editor( 'config_gioithieu', '', NV_ALLOWED_HTML_TAGS );
		$gioithieu = strtr( $gioithieu, array(
			"\r\n" => '',
			"\r" => '',
			"\n" => '' ) );
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['blockid'] = $nv_Request->get_int('config_blockid', 'post', 0);
        $return['config']['numrows'] = $nv_Request->get_int('config_numrows', 'post', 3);
		$return['config']['gioithieu'] = $gioithieu;
		
        return $return;
    }

    /**
     * nv_block_slider()
     *
     * @return
     */
    function nv_block_slider_thammy($block_config)
    {
        global $global_config, $site_mods, $module_config, $nv_Cache, $db;
        $module = $block_config['module'];
		
        // Set content status
        if (! empty($module_config[$module]['next_execute']) and $module_config[$module]['next_execute'] <= NV_CURRENTTIME) {
            $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_rows SET status = 2 WHERE end_time > 0 AND end_time < ' . NV_CURRENTTIME;
            $db->query($sql);

            // Get next execute
            $sql = 'SELECT MIN(end_time) next_execute FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_rows WHERE end_time > 0 AND status = 1';
            $result = $db->query($sql);
            $next_execute = intval($result->fetchColumn());
            $sth = $db->prepare("UPDATE " . NV_CONFIG_GLOBALTABLE . " SET config_value = :config_value WHERE lang = '" . NV_LANG_DATA . "' AND module = :module_name AND config_name = 'next_execute'");
            $sth->bindParam(':module_name', $module, PDO::PARAM_STR);
            $sth->bindParam(':config_value', $next_execute, PDO::PARAM_STR);
            $sth->execute();

            $nv_Cache->delMod('settings');
            $nv_Cache->delMod($module);

            unset($next_execute);
        }

        if (! isset($site_mods[$module]) or empty($block_config['blockid'])) {
            return '';
        }

        $sql = 'SELECT id, title, description, image, link, target FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_rows WHERE status = 1 AND bid = ' . $block_config['blockid']. ' ORDER BY id ASC';
        $list = $nv_Cache->db($sql, 'id', $module);

        if (! empty($list)) {
            if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $site_mods[$module]['module_file'] . '/block.slider_thammy.tpl')) {
                $block_theme = $global_config['module_theme'];
            } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $site_mods[$module]['module_file'] . '/block.slider_thammy.tpl')) {
                $block_theme = $global_config['site_theme'];
            } else {
                $block_theme = 'default';
            }

            $xtpl = new XTemplate('block.slider_thammy.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $site_mods[$module]['module_file']);
			
			$xtpl->assign('TEMPLATE', $block_theme);						
			$xtpl->assign('BLOCK_TITLE', $block_config['title']); 			
			$xtpl->assign('numrow', $block_config['numrows']);
			$gioithieu = strip_tags($block_config['gioithieu']);
            $gioithieu = nv_clean60($gioithieu, 300);
			$xtpl->assign( 'GIOITHIEU', $gioithieu );
			
            foreach ($list as $row) {
                if (! empty($row['image'])) {
                    $row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $site_mods[$module]['module_upload'] . '/' . $row['image'];
                }
                $xtpl->assign('ROW', $row);
                $xtpl->parse('main.loop');
				$xtpl->parse('main.item');
            }

            $xtpl->parse('main');
            return $xtpl->text('main');
        }

        return '';
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_slider_thammy($block_config);
}
