<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2017 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 04/18/2017 09:47
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!nv_function_exists('nv_hot_group_product')) {

    /**
     * nv_block_config_hot_hutkhach_blocks()
     *
     * @param mixed $module
     * @param mixed $data_block
     * @param mixed $lang_block
     * @return
     *
     */
    function nv_block_config_hot_group_blocks($module, $data_block, $lang_block)
    {
        global $nv_Cache, $db_config, $site_mods, $nv_Request;
		
		if ($nv_Request->isset_request('loadajaxdata', 'get')) {
        $module = $nv_Request->get_title('loadajaxdata', 'get', '');
        $html = "<div class=\"form-group\">";
        $html .= "	<label class=\"control-label col-sm-6\">" . $lang_block['blockid'] . "</label>";
        $html .= "	<td><select name=\"config_blockid\" class=\"form-control w200\">\n";
        $sql = "SELECT bid, " . NV_LANG_DATA . "_title," . NV_LANG_DATA . "_alias FROM " . $db_config['prefix'] . "_" . $site_mods[$module]['module_data'] . "_block_cat ORDER BY weight ASC";
        $list = $nv_Cache->db($sql, 'catid', $module);
        foreach ($list as $l) {
            $sel = ($data_block['blockid'] == $l['bid']) ? ' selected' : '';
            $html .= "<option value=\"" . $l['bid'] . "\" " . $sel . ">" . $l[NV_LANG_DATA . '_title'] . "</option>\n";
        }
        $html .= "	</select></div>\n";
        $html .= '<script type="text/javascript">';
        $html .= '	$("select[name=config_blockid]").change(function() {';
        $html .= '		$("input[name=title]").val($("select[name=config_blockid] option:selected").text());';
        $html .= '	});';
        $html .= '</script>';
        $html .= "</div>";

        $html .= "<div class=\"form-group\">";
        $html .= "	<label class=\"control-label col-sm-6\">" . $lang_block['numrow'] . "</label>";
        $html .= "	<div class=\"col-sm-18\"><input class=\"form-control w100\" type=\"text\" name=\"config_numrow\" size=\"5\" value=\"" . $data_block['numrow'] . "\"/></div>";
        $html .= "</div>";

        $html .= "<div class=\"form-group\">";
        $html .= "	<label class=\"control-label col-sm-6\">" . $lang_block['cut_num'] . "</label>";
        $html .= "	<div class=\"col-sm-18\"><input class=\"form-control w100\" type=\"text\" name=\"config_cut_num\" size=\"5\" value=\"" . $data_block['cut_num'] . "\"/></div>";
        $html .= "</div>";
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

    /**
     * nv_block_config_hot_hutkhach_blocks_submit()
     *
     * @param mixed $module
     * @param mixed $lang_block
     * @return
     *
     */
    function nv_block_config_hot_group_blocks_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
		$return['config']['selectmod'] = $nv_Request->get_title('config_selectmod', 'post', '');
        $return['config']['blockid'] = $nv_Request->get_int('config_blockid', 'post', 0);
        $return['config']['numrow'] = $nv_Request->get_int('config_numrow', 'post', 0);
        $return['config']['cut_num'] = $nv_Request->get_int('config_cut_num', 'post', 0);
        return $return;
    }

    if (!nv_function_exists('nv_get_price_tmp')) {

        function nv_get_price_tmp($module_name, $module_data, $module_file, $pro_id)
        {
            global $nv_Cache, $db, $db_config, $module_config, $discounts_config;

            $price = array();
            $pro_config = $module_config[$module_name];

            require_once NV_ROOTDIR . '/modules/' . $module_file . '/site.functions.php';
            $price = nv_get_price($pro_id, $pro_config['money_unit'], 1, false, $module_name);

            return $price;
        }
    }

    /**
     * nv_kuteshop_product()
     *
     * @param mixed $block_config
     * @return
     *
     */
    function nv_hot_group_product($block_config)
    {
        global $nv_Cache, $nv_Cache, $site_mods, $global_config, $lang_module, $module_config, $module_config, $module_name, $module_info, $global_array_shops_cat, $db_config, $my_head, $db, $pro_config, $money_config, $array_wishlist_id;
        $block_config['module'] = $block_config['selectmod'];
        $module = $block_config['module'];
        $mod_data = $site_mods[$module]['module_data'];
        $mod_file = $site_mods[$module]['module_file'];

		if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.block_hot_group.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.block_hot_group.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        if ($module != $module_name) {
            $sql = 'SELECT catid, parentid, lev, ' . NV_LANG_DATA . '_title AS title, ' . NV_LANG_DATA . '_alias AS alias, viewcat, numsubcat, subcatid, numlinks, ' . NV_LANG_DATA . '_description AS description, inhome, ' . NV_LANG_DATA . '_keywords AS keywords, groups_view, typeprice FROM ' . $db_config['prefix'] . '_' . $mod_data . '_catalogs ORDER BY sort ASC';
            $list = $nv_Cache->db($sql, 'catid', $module);
            foreach ($list as $row) {
                $global_array_shops_cat[$row['catid']] = array(
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
                    'inhome' => $row['inhome'],
                    'keywords' => $row['keywords'],
                    'groups_view' => $row['groups_view'],
                    'lev' => $row['lev'],
                    'typeprice' => $row['typeprice']
                );
            }
            unset($list, $row);

            $pro_config = $module_config[$module];

            // Lay ty gia ngoai te
            $sql = 'SELECT code, currency, symbol, exchange, round, number_format FROM ' . $db_config['prefix'] . '_' . $mod_data . '_money_' . NV_LANG_DATA;
            $cache_file = NV_LANG_DATA . '_' . md5($sql) . '_' . NV_CACHE_PREFIX . '.cache';
            if (($cache = $nv_Cache->getItem($module, $cache_file)) != false) {
                $money_config = unserialize($cache);
            } else {
                $money_config = array();
                $result = $db->query($sql);
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

		$xtpl = new XTemplate('global.block_hot_group.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');
        $xtpl->assign('LANG', $lang_module);
		$xtpl->assign('BLOCK_TITLE', $block_config['title']);
		$xtpl->assign('TEMPLATE', $block_theme);

        $db->sqlreset()
            ->select('t1.id, t1.listcatid, t1.' . NV_LANG_DATA . '_title AS title, t1.' . NV_LANG_DATA . '_alias AS alias, t1.' . NV_LANG_DATA . '_hometext AS hometext, t1.addtime, t1.homeimgfile, t1.homeimgthumb, t1.product_price, t1.money_unit, t1.discount_id, t1.showprice, t1.product_number')
            ->from($db_config['prefix'] . '_' . $mod_data . '_rows t1')
            ->join('INNER JOIN ' . $db_config['prefix'] . '_' . $mod_data . '_block t2 ON t1.id = t2.id')
            ->where('t2.bid= ' . $block_config['blockid'] . ' AND t1.status =1')
            ->order('t1.addtime DESC, t2.weight ASC')
            ->limit($block_config['numrow']);

        $list = $nv_Cache->db($db->sql(), 'id', $module);

        $i = 1;
        $cut_num = $block_config['cut_num'];
        foreach ($list as $row) {
            if ($row['homeimgthumb'] == 1) {
                // image thumb
                $src_img = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $site_mods[$module]['module_upload'] . '/' . $row['homeimgfile'];
            } elseif ($row['homeimgthumb'] == 2) {
                // image file
                $src_img = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $site_mods[$module]['module_upload'] . '/' . $row['homeimgfile'];
            } elseif ($row['homeimgthumb'] == 3) {
                // image url
                $src_img = $row['homeimgfile'];
            } else {
                // no image
                $src_img = NV_BASE_SITEURL . 'themes/' . $block_theme . '/images/shops/no-image.jpg';
            }

            $xtpl->assign('id', $row['id']);
            $xtpl->assign('link', $link . $global_array_shops_cat[$row['listcatid']]['alias'] . '/' . $row['alias'] . $global_config['rewrite_exturl']);
            $xtpl->assign('title', nv_clean60($row['title'], $cut_num));
			$xtpl->assign('hometext', nv_clean60($row['hometext'], 150));
            $xtpl->assign('src_img', $src_img);
            $xtpl->assign('time', nv_date('d-m-Y h:i:s A', $row['addtime']));
			
            if ($pro_config['active_order'] == '1' and $pro_config['active_order_non_detail'] == '1') {
                if ($row['showprice'] == '1') {
                    if ($row['product_number'] > 0) {
                        $xtpl->parse('main.loop.order');
                    } else {
                        $xtpl->parse('main.loop.product_empty');
                    }
                }
            }
            if ($pro_config['active_price'] == '1') {
                if ($row['showprice'] == '1') {
                    $price = nv_get_price_tmp($module, $mod_data, $mod_file, $row['id']);
                    // var_dump($price); die;
                    $xtpl->assign('PRICE', $price);
                    if ($row['discount_id'] and $price['discount_percent'] > 0) {
                        $xtpl->parse('main.loop.price.discounts');
						$xtpl->parse('main.loop.discounts');
                    } else {
                        $xtpl->parse('main.loop.price.no_discounts');
                    }
                    $xtpl->parse('main.loop.price');
                } else {
                    $xtpl->parse('main.loop.contact');
                }
            }
            $xtpl->parse('main.loop');
            ++$i;
        }

        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_hot_group_product($block_config);
}
