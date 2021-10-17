<?php

/**
 * @Project NUKEVIET 4.x
* @Author VINADES.,JSC (contact@vinades.vn)
* @Copyright (C) 2014 VINADES., JSC. All rights reserved
* @License GNU/GPL version 2 or any later version
* @Createdate 3/9/2010 23:25
*/
if (! defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (! nv_function_exists('nv_cat_tab')) {

    /**
     * nv_block_config_relates_blocks()
     *
     * @param mixed $module
     * @param mixed $data_block
     * @param mixed $lang_block
     * @return
     *
     */
    function nv_block_config_cat_tab($module, $data_block, $lang_block)
    {
        global $nv_Cache, $db_config, $site_mods;

        $html = "<tr>";
        $html .= "	<td>Loại danh mục</td>";
        $html .= "	<td>";
        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_cat ORDER BY sort ASC';
		
        $list = $nv_Cache->db($sql, 'catid', $module);
		
        foreach ($list as $l) {
           
			 $html .= '<label><input type="checkbox" name="config_catid[]" value="' . $l['catid'] . '" ' . ((in_array($l['catid'], $data_block['catid'])) ? ' checked="checked"' : '') . '</input>' . $l['title'] . '</label><br />';
			
        }
		
        $html .= "</td>\n";
        $html .= '<script type="text/javascript">';
        $html .= '	$("select[name=config_blockid]").change(function() {';
        $html .= '		$("input[name=title]").val($("select[name=config_blockid] option:selected").text());';
        $html .= '	});';
        $html .= '</script>';
        $html .= "</tr>";

        $html .= "<tr>";
        $html .= "	<td>" . $lang_block['numrow'] . "</td>";
        $html .= "	<td><input class=\"form-control w100\" type=\"text\" name=\"config_numrow\" size=\"5\" value=\"" . $data_block['numrow'] . "\"/></td>";
        $html .= "</tr>";

        $html .= "<tr>";
        $html .= "	<td>" . $lang_block['cut_num'] . "</td>";
        $html .= "	<td><input class=\"form-control w100\" type=\"text\" name=\"config_cut_num\" size=\"5\" value=\"" . $data_block['cut_num'] . "\"/></td>";
        $html .= "</tr>";

        return $html;
    }

    /**
     * nv_block_config_relates_blocks_submit()
     *
     * @param mixed $module
     * @param mixed $lang_block
     * @return
     *
     */
    function nv_block_config_cat_tab_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
		$return['config']['catid'] = $nv_Request->get_array('config_catid', 'post', array());
        $return['config']['numrow'] = $nv_Request->get_int('config_numrow', 'post', 0);
        $return['config']['cut_num'] = $nv_Request->get_int('config_cut_num', 'post', 0);
        return $return;
    }

   
    

    /**
     * nv_relates_product()
     *
     * @param mixed $block_config
     * @return
     *
     */
    function nv_cat_tab($block_config)
    {
        global $nv_Cache, $nv_Cache, $site_mods, $global_config, $lang_module, $module_config, $module_config, $module_name, $module_info, $global_array_shops_cat, $db_config, $my_head, $db, $pro_config, $money_config, $array_wishlist_id;

        $module = $block_config['module'];
        $mod_data = $site_mods[$module]['module_data'];
        $mod_file = $site_mods[$module]['module_file'];

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $mod_file . '/block.cat_tab.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        if ($module != $module_name) {
		
		
            $sql = 'SELECT catid, parentid, lev, title AS title, alias AS alias, viewcat, numsubcat, subcatid, numlinks, description, descriptionhtml, keywords AS keywords, groups_view, image FROM ' . NV_PREFIXLANG . '_' . $mod_data . '_cat ORDER BY sort ASC';
            $list = $nv_Cache->db($sql, 'catid', $module);
            foreach ($list as $row) {
                $global_array_cat[$row['catid']] = array(
                    'catid' => $row['catid'],
                    'parentid' => $row['parentid'],
                    'title' => $row['title'],
                    'alias' => $row['alias'],
                    'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $row['alias'],
                    'viewcat' => $row['viewcat'],
                    'numsubcat' => $row['numsubcat'],
                    'subcatid' => $row['subcatid'],
                    'numlinks' => $row['numlinks'],
                    'description' => $row['description'],
                    'image' => NV_MY_DOMAIN . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $site_mods[$module]['module_upload'] . '/' . $row['image'],
                    'descriptionhtml' => $row['descriptionhtml'],
                    'keywords' => $row['keywords'],
                    'groups_view' => $row['groups_view'],
                    'lev' => $row['lev'],
                    'typeprice' => $row['typeprice']
                );
            }
            unset($list, $row);

            // Css
            if (file_exists(NV_ROOTDIR . '/themes/' . $block_theme . '/css/' . $mod_file . '.css')) {
                $my_head .= '<link rel="StyleSheet" href="' . NV_BASE_SITEURL . 'themes/' . $block_theme . '/css/' . $mod_file . '.css" type="text/css" />';
            }

            // js
            if (file_exists(NV_ROOTDIR . '/themes/' . $block_theme . '/js/' . $mod_file . '.js')) {
                $my_head .= '<script src="' . NV_BASE_SITEURL . 'themes/' . $block_theme . '/js/' . $mod_file . '.js"></script>';
            }

            // Language
            if (file_exists(NV_ROOTDIR . '/modules/' . $mod_file . '/language/' . NV_LANG_DATA . '.php')) {
                require_once NV_ROOTDIR . '/modules/' . $mod_file . '/language/' . NV_LANG_DATA . '.php';
            }

            $pro_config = $module_config[$module];

       
        }

        $link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=';

        $xtpl = new XTemplate('block.cat_tab.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file);
        $xtpl->assign('LANG', $lang_module);
		$stt = 0;
		if(!empty($block_config['catid']))
		{
			foreach($block_config['catid'] as $bid)
			{
			
				//print_r($list);die();
				$i = 1;
				$cut_num = $block_config['cut_num'];
				
				$xtpl->assign('data', $global_array_cat[$bid]);
				$xtpl->assign('img_src', NV_MY_DOMAIN . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $mod_file . '/' . $global_array_cat[$bid]['image']);
				if($stt == 0){
					
					$xtpl->assign('ACTIVE', '="trang_hientai"');
				}
				else{
					
					$xtpl->assign('ACTIVE', ' ');
				}
				$xtpl->assign('STT', $stt);
				
				
				
				
				$xtpl->parse('main.loopcatid1');
				$stt++;
			}
			$stt =0;
			foreach($block_config['catid'] as $bid)
			{
				
				$xtpl->assign('data1', $global_array_cat[$bid]);
				
				if($stt == 0)
					$xtpl->assign('ACTIVE1', 'swiper-slide-active');
				else
					$xtpl->assign('ACTIVE1', ' ');
				$xtpl->assign('STT', $stt);
				$xtpl->parse('main.loopcatid');
				$stt++;
			}
		}
        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_cat_tab($block_config);
}
