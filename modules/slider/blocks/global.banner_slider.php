<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if (!defined('NV_MAINFILE'))
    die('Stop!!!');

if (!nv_function_exists('nv_block_banner_slider')) {
    /**
     * nv_block_config_banner_slider()
     *
     * @param mixed $module
     * @param mixed $data_block
     * @param mixed $lang_block
     * @return
     */
    function nv_block_config_banner_slider($module, $data_block, $lang_block)
    {
        global $nv_Cache, $site_mods;

        $html = '';

        $html .= '<tr>';
        $html .= '<td>' . $lang_block['size_w'] . '</td>';
        $html .= '<td><input type="text" class="form-control w200" name="config_size_w" value="' . $data_block['size_w'] . '"/></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>' . $lang_block['size_h'] . '</td>';
        $html .= '<td><input type="text" class="form-control w200" name="config_size_h" value="' . $data_block['size_h'] . '"/></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>&nbsp;</td>';
        $html .= '<td><label><input type="checkbox" name="config_responsive" value="1"' . (empty($data_block['responsive']) ? '' : ' checked="checked"') . '/></label> ' . $lang_block['responsive'] . '</td>';
        $html .= '</tr>';

        return $html;
    }

    /**
     * nv_block_config_banner_slider_submit()
     *
     * @param mixed $module
     * @param mixed $lang_block
     * @return
     */
    function nv_block_config_banner_slider_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['size_w'] = $nv_Request->get_int('config_size_w', 'post', 0);
        $return['config']['size_h'] = $nv_Request->get_int('config_size_h', 'post', 0);
        $return['config']['responsive'] = $nv_Request->get_int('config_responsive', 'post', 0);
        return $return;
    }

    /**
     * nv_block_banner_slider()
     *
     * @param mixed $block_config
     * @return
     */
    function nv_block_banner_slider($block_config)
    {
        global $module_info, $site_mods, $module_config, $global_config, $db, $nv_Cache;

        $module = $block_config['module'];
        $module_file = $site_mods[$module]['module_file'];
        $module_upload = $site_mods[$module]['module_upload'];

        $db->sqlreset()->select('*')->from(NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_rows')->where('status= 1')->order('weight ASC');

        $list = $nv_Cache->db($db->sql(), '', $module);

        if (!empty($list)) {
            if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file . '/block.banner_slider.tpl')) {
                $block_theme = $global_config['module_theme'];
            } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $module_file . '/block.banner_slider.tpl')) {
                $block_theme = $global_config['site_theme'];
            } else {
                $block_theme = 'default';
            }

            $xtpl = new XTemplate('block.banner_slider.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $module_file);
            $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
            $xtpl->assign('TEMPLATE', $block_theme);
            $xtpl->assign('MODULE_FILE', $module_file);
            $xtpl->assign('CONFIG', $block_config);

            if (!empty($block_config['responsive'])) {
                $xtpl->parse('main.scaleslider');
            }

            foreach ($list as $l) {
                $l['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $l['image'];
                $l['image_alt'] = empty($l['title']) ? basename($l['image']) : $l['title'] . ' ' . $l['title1'] . ' ' . $l['title2'];
                $l['link_target'] = $l['link_target'] ? ' target="_blank"' : '';

                $xtpl->assign('ROW', $l);

                if (!empty($l['link_href'])) {
                    $xtpl->parse('main.loop.image_linked');
                } else {
                    $xtpl->parse('main.loop.image_only');
                }

                if (!empty($l['title'])) {
                    $xtpl->parse('main.loop.title');
                }
                if (!empty($l['title1'])) {
                    $xtpl->parse('main.loop.title1');
                }
                if (!empty($l['title2'])) {
                    $xtpl->parse('main.loop.title2');
                }
                if (!empty($l['link_href'])) {
                    $xtpl->parse('main.loop.more');
                }

                $xtpl->parse('main.loop');
            }

            $xtpl->parse('main');
            return $xtpl->text('main');
        }
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_banner_slider($block_config);
}
