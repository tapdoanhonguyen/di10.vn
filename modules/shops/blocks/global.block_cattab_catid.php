<?php

/**
 * @Project NUKEVIET 4.x
 * @Author MINHTHANH (khanhthanhtdbd@gmail.com)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if (!defined('NV_MAINFILE'))
    die('Stop!!!');

if (!nv_function_exists('getParentSub')) {
    function getParentSub($catid)
    {
        global $global_array_shops_cat;
        $array_cat   = array();
        $array_cat[] = $catid;
        $subcatid    = explode(',', $global_array_shops_cat[$catid]['subcatid']);
        if (!empty($subcatid)) {
            foreach ($subcatid as $id) {
                if ($id > 0) {
                    if ($global_array_shops_cat[$id]['subcatid'] == 0) {
                        $array_cat[] = $id;
                    } else {
                        $array_cat_temp = getParentSub($id);
                        foreach ($array_cat_temp as $catid_i) {
                            $array_cat[] = $catid_i;
                        }
                    }
                }
            }
        }
        return array_unique($array_cat);
    }
}
if (!nv_function_exists('nv_cattab_catid')) {
    function nv_block_config_cattab_catid($module, $data_block, $lang_block)
    {
        global $nv_Cache, $db, $db_config, $site_mods, $nv_Request;

        if ($nv_Request->isset_request('loadajaxdata', 'get')) {
        $module = $nv_Request->get_title('loadajaxdata', 'get', '');
        $html = '';
        
		$html .= '<div class="form-group">';
		$html .= '<label class="control-label col-sm-6">' . $lang_block['config_numsub'] . ':</label>';
		$html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_numsub" size="5" value="' . $data_block['config_numsub'] . '"/></div>';
		$html .= '</div>';
		
		$html .= '<div class="form-group">';
		$html .= '<label class="control-label col-sm-6">' . $lang_block['config_numrow'] . ':</label>';
		$html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_numrow" size="5" value="' . $data_block['config_numrow'] . '"/></div>';
		$html .= '</div>';
		
		$html .= '<div class="form-group">';
		$html .= '<label class="control-label col-sm-6">' . $lang_block['config_numcut'] . ':</label>';
		$html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_numcut" size="5" value="' . $data_block['config_numcut'] . '"/></div>';
		$html .= '</div>';

		nv_htmlOutput($html);
        }
			
        $html = '';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['selectmod'] . '</label>';
        $html .= '<div class="col-sm-18">';
        $html .= '<select name="config_selectmod" class="form-control w300">';
        $html .= '<option value="">--</option>';

        foreach ($site_mods as $title => $mod) {
            if ($mod['module_file'] == 'shops') {
                $html .= '<option value="' . $title . '"' . ($title == $data_block['selectmod'] ? ' selected="selected"' : '') . '>' . $mod['custom_title'] . '</option>';
            }
        }

        $html .= '</select>';

        $html .= '
        <script type="text/javascript">
        $(\'[name="config_selectmod"]\').change(function() {
            var mod = $(this).val();
            var file_name = $("select[name=file_name]").val();
            var module_type = $("select[name=module_type]").val();
            var blok_file_name = "";
            if (file_name != "") {
                var arr_file = file_name.split("|");
                if (parseInt(arr_file[1]) == 1) {
                    blok_file_name = arr_file[0];
                }
            }
            if (mod != "") {
                $.get(script_name + "?" + nv_name_variable + "=" + nv_module_name + \'&\' + nv_lang_variable + "=" + nv_lang_data + "&" + nv_fc_variable + "=block_config&bid=" + bid + "&module=" + module_type + "&selectthemes=" + selectthemes + "&file_name=" + blok_file_name + "&loadajaxdata=" + mod + "&nocache=" + new Date().getTime(), function(theResponse) {
        			$("#block_config").append(theResponse);
        		});
            }
        });
        $(function() {
            $(\'[name="config_selectmod"]\').change();
        });
        </script>
        ';

        $html .= '</div';
        $html .= '</div>';
        return $html;
    }
    
    function nv_block_config_cattab_catid_submit($module, $lang_block)
    {
        global $nv_Request;
        $return                            = array();
        $return['error']                   = array();
        $return['config']                  = array();
		$return['config']['selectmod'] = $nv_Request->get_title('config_selectmod', 'post', '');
		$return['config']['config_numsub'] = $nv_Request->get_int('config_numsub', 'post', 0);
        $return['config']['config_numrow'] = $nv_Request->get_int('config_numrow', 'post', 0);
        $return['config']['config_numcut'] = $nv_Request->get_int('config_numcut', 'post', 0);
        
        return $return;
    }
    if (!nv_function_exists('nv_get_price_tmp')) {
        function nv_get_price_tmp($module_name, $module_data, $module_file, $pro_id)
        {
            global $nv_Cache, $db, $db_config, $module_config, $discounts_config;
            
            $price      = array();
            $pro_config = $module_config[$module_name];
            
            require_once NV_ROOTDIR . '/modules/' . $module_file . '/site.functions.php';
            $price = nv_get_price($pro_id, $pro_config['money_unit'], 1, false, $module_name);
            
            return $price;
        }
    }
    
    function nv_cattab_catid($block_config)
    {
        global $site_mods, $nv_Cache, $global_config, $lang_module, $module_config, $module_config, $module_name, $module_info, $global_array_shops_cat, $db_config, $my_head, $db, $global_array_group, $pro_config, $money_config;
        $block_config['module'] = $block_config['selectmod'];
        $module = $block_config['module'];
        $mod_data = $site_mods[$module]['module_data'];
        $mod_file = $site_mods[$module]['module_file'];
        
			if (file_exists(NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file .'/global.block_cattab_catid.tpl')) {
            $block_theme = $global_config['module_theme'];
            } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $mod_file .'/global.block_cattab_catid.tpl')) {
            $block_theme = $global_config['site_theme'];
            } else {
            $block_theme = 'default';
            }
            if ($module != $module_name) {
                $sql  = 'SELECT catid, parentid, image, lev, ' . NV_LANG_DATA . '_title AS title, ' . NV_LANG_DATA . '_alias AS alias, viewcat, numsubcat, subcatid, numlinks, ' . NV_LANG_DATA . '_description AS description, inhome, ' . NV_LANG_DATA . '_keywords AS keywords, groups_view, typeprice FROM ' . $db_config['prefix'] . '_' . $mod_data . '_catalogs ORDER BY sort ASC';
                $list = $nv_Cache->db($sql, 'catid', $module);
                foreach ($list as $row) {
                    $global_array_shops_cat[$row['catid']] = array(
                        'catid' => $row['catid'],
                        'parentid' => $row['parentid'],
						'image' => $row['image'],
                        'title' => $row['title'],
                        'alias' => $row['alias'],
                        'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $row['alias'],
                        'viewcat' => $row['viewcat'],
                        'numsubcat' => $row['numsubcat'],
                        'subcatid' => $row['subcatid'],
                        'numlinks' => $row['numlinks'],
                        'description' => $row['description'],
                        'inhome' => $row['inhome'],
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
                // Language
                if (file_exists(NV_ROOTDIR . '/modules/' . $mod_file . '/language/' . NV_LANG_DATA . '.php')) {
                    require_once NV_ROOTDIR . '/modules/' . $mod_file . '/language/' . NV_LANG_DATA . '.php';
                }
                $pro_config = $module_config[$module];
                // Lay ty gia ngoai te
                $sql        = 'SELECT code, currency, symbol, exchange, round, number_format FROM ' . $db_config['prefix'] . '_' . $mod_data . '_money_' . NV_LANG_DATA;
                $cache_file = NV_LANG_DATA . '_' . md5($sql) . '_' . NV_CACHE_PREFIX . '.cache';
                if (($cache = $nv_Cache->getItem($module, $cache_file)) != false) {
                    $money_config = unserialize($cache);
                } else {
                    $money_config = array();
                    $result       = $db->query($sql);
                    while ($row = $result->fetch()) {
                        $money_config[$row['code']] = array(
                            'code' => $row['code'],
                            'currency' => $row['currency'],
							'symbol' => $row['symbol'],
                            'exchange' => $row['exchange'],
                            'round' => $row['round'],
                            'number_format' => $row['number_format'],
                            'decimals' => $row['round'] > 1 ? $row['round'] : strlen($row['round']) - 2,
                            'is_config' => ($row['code'] == $pro_config['money_unit']) ? 1 : 0
                        );
                    }
                    $result->closeCursor();
                    $cache = serialize($money_config);
                    $nv_Cache->setItem($module, $cache_file, $cache);
                }
            }
            $link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=';
			$xtpl = new XTemplate('global.block_cattab_catid.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file);
            $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
            $xtpl->assign('TEMPLATE', $block_theme);
            $xtpl->assign('LANG', $lang_module);
            $xtpl->assign('BLOCK_TITLE', $block_config['title']);
			
			foreach ($global_array_shops_cat as $_catid => $array_info_i) 
			{
                 if ($array_info_i['parentid'] == 0 and $array_info_i['inhome'] != 0) 
			     {
                 $array_cat = array();
                 $array_cat = getParentSub($_catid, true);

                    $db->sqlreset()->select('COUNT(*)')->from($db_config['prefix'] . '_' . $mod_data . '_rows t1')->where('t1.listcatid IN (' . implode(',', $array_cat) . ') AND t1.status =1');
                    $num_pro = $db->query($db->sql())->fetchColumn();
                    
                    $db->select('id, listcatid, publtime, ' . NV_LANG_DATA . '_title, ' . NV_LANG_DATA . '_alias, ' . NV_LANG_DATA . '_hometext, homeimgalt, homeimgfile, homeimgthumb, otherimage, product_code, product_number, product_price, money_unit, discount_id, showprice, ' . NV_LANG_DATA . '_gift_content, gift_from, gift_to')
                    ->order('id DESC')
                    ->limit($block_config['config_numrow']);
					
					$result   = $db->query($db->sql());
                    $data_pro = array();
                    while (list($id, $listcatid, $publtime, $title, $alias, $hometext, $homeimgalt, $homeimgfile, $homeimgthumb, $otherimage, $product_code, $product_number, $product_price, $money_unit, $discount_id, $showprice, $gift_content, $gift_from, $gift_to) = $result->fetch(3)) {
                        
                        if ($homeimgthumb == 1) {
                            $thumb = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module . '/' . $homeimgfile;
                        } elseif ($homeimgthumb == 2) {
                            $thumb = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/' . $homeimgfile;
                        } elseif ($homeimgthumb == 3) {
                            $thumb = $homeimgfile;
                        } else {
                            $thumb = NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/no-image.jpg';
                        }
                        $data_pro[] = array(
                            'id' => $id,
                            'listcatid' => $listcatid,
                            'publtime' => $publtime,
                            'title' => $title,
                            'alias' => $alias,
                            'hometext' => $hometext,
                            'homeimgalt' => $homeimgalt,
                            'homeimgthumb' => $thumb,
							'otherimage' => $otherimage,
                            'product_code' => $product_code,
                            'product_number' => $product_number,
                            'product_price' => $product_price,
                            'discount_id' => $discount_id,
                            'money_unit' => $money_unit,
                            'showprice' => $showprice,
                            'gift_content' => $gift_content,
                            'gift_from' => $gift_from,
                            'gift_to' => $gift_to,
                            'link_pro' => $link . $global_array_shops_cat[$_catid]['alias'] . '/' . $alias . $global_config['rewrite_exturl'],
                            'link_order' => $link . 'setcart&amp;id=' . $id
                        );
                    }
                    $data_content[] = array(
					    'catid' => $_catid,
                        'subcatid' => $array_info_i['subcatid'],
						'image' => NV_BASE_SITEURL.NV_FILES_DIR."/".$module."/".$array_info_i['image'],
                        'title' => $array_info_i['title'],
                        'alias' => $array_info_i['alias'],
						'num_pro' => $num_pro,
                        'content' => $data_pro
                    );
                }
            }
            
            if (!empty($data_content)) {
                $exl = 0;
                $n   = 0;
                foreach ($data_content as $data) {
                    $n++;
                    if ($n == 1) {
                        $data['active'] = 'current';
                    }
					$xtpl->assign('LINK', $global_array_shops_cat[$array_cat[0]]['link']);
                    $xtpl->assign('BLOCK_INFO', $data);
                    if ($exl < $block_config['config_numsub'] and $data['num_pro'] > 0) {
                        $xtpl->parse('main.group_info');
                    }
                    foreach ($data['content'] as $loop) {
                        $loop['link']   = $link . $global_array_shops_cat[$loop['listcatid']]['alias'] . '/' . $loop['alias'] . $global_config['rewrite_exturl'];
						$loop['linkcat']   = $link . $global_array_shops_cat[$loop['listcatid']]['alias'];
                        $loop['title0'] = nv_clean60($loop['title'], $block_config['config_numcut'], true);
                            $xtpl->assign('LOOP', $loop);
                            /////////////////////////////////////////
		// Hien thi hinh anh khac cua san pham
		if (!empty($loop['otherimage'])) 
		{
			$otherimage = explode('|', $loop['otherimage']);
			foreach ($otherimage as $otherimage_i) 
			{
				if (!empty($otherimage_i) and file_exists(NV_UPLOADS_REAL_DIR . '/' . $module . '/' . $otherimage_i)) 
				{
					$thumb = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module . '/' . $otherimage_i;
					$xtpl->assign('IMG_THUMB', $thumb);
				    $xtpl->parse('main.loop.loopcontent.othersimg.img');
				}
			}
			$xtpl->parse('main.loop.loopcontent.othersimg');
		}
							// Hien thi bieu tuong giam gia
                            $price = nv_get_price_tmp($module, $mod_data, $mod_file, $loop['id']);
                            if ($pro_config['active_price'] == '1') {
                                if ($loop['showprice'] == '1') {
                                    $price = nv_get_price_tmp($module, $mod_data, $mod_file, $loop['id']);
                                    $xtpl->assign('PRICE', $price);
                                    if ($loop['discount_id'] and $price['discount_percent'] > 0) {
                                        $xtpl->parse('main.loop.loopcontent.price.discounts');
										 $xtpl->parse('main.loop.loopcontent.discounts');
                                    } else {
                                        $xtpl->parse('main.loop.loopcontent.price.no_discounts');
                                    }
                                    $xtpl->parse('main.loop.loopcontent.price');
                                } else {
                                    $xtpl->parse('main.loop.loopcontent.contact');
                                }
                            }
                            /////////////////////
                            if ($pro_config['active_order'] == '1' and $pro_config['active_order_non_detail'] == '1') {
                                if ($loop['showprice'] == '1') {
                                    if ($loop['product_number'] > 0) {
                                        // Kiem tra nhom bat buoc chon khi dat hang
										$listgroupid = GetGroupID($loop['id']);
                                        $group_requie = 0;
                                        if (!empty($listgroupid) and !empty($global_array_group)) {
                                            foreach ($global_array_group as $groupinfo) {
                                                if ($groupinfo['in_order']) {
                                                    $group_requie = 1;
                                                    break;
                                                }
                                            }
                                        }
                                        $group_requie = $pro_config['active_order_popup'] ? 1 : $group_requie;
                                        $xtpl->assign('GROUP_REQUIE', $group_requie);
                                        $xtpl->parse('main.loop.loopcontent.order');
                                    } else {
                                        $xtpl->parse('main.loop.loopcontent.product_empty');
                                    }
                                }
                            }
                            if (!empty($pro_config['show_product_code']) and !empty($loop['product_code'])) {
                                $xtpl->parse('main.loop.loopcontent.product_code');
                            }
                            /////////////////////////////////////
                            // San pham yeu thich
                            if ($pro_config['active_wishlist']) {
                                if (!empty($array_wishlist_id)) {
                                    if (in_array($loop['id'], $array_wishlist_id)) {
                                        $xtpl->parse('main.loop.loopcontent.wishlist.disabled');
                                    }
                                }
                                $xtpl->parse('main.loop.loopcontent.wishlist');
                            }
                            $xtpl->parse('main.loop.loopcontent');
                    }
					///// CAU HINH SO LUONG HIEN THI TAB /////
					if ($exl < $block_config['config_numsub'] and $data['num_pro'] > 0) {
                    $xtpl->parse('main.loop');
					}
					++$exl;
               }
         }
        if (!defined('MODAL_LOADEDPK')) {
            $xtpl->parse('main.modal_loadedpk');
            define('MODAL_LOADEDPK', true);
        }
        $xtpl->parse('main');
        return $xtpl->text('main');
	
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_cattab_catid($block_config);
}