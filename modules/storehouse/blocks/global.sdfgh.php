<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Mon, 13 Aug 2018 02:01:22 GMT
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!nv_function_exists('nvb_storehouse_global_sdfgh')) {
    /**
     * @param string $module
     * @param array $data_block
     * @param array $lang_block
     * @return string
     */
    function nvb_config_storehouse_global_sdfgh($module, $data_block, $lang_block)
    {
        global $nv_Cache, $site_mods, $nv_Request;

        $html = '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['number_item'] . ':</label>';
        $html .= '<div class="col-sm-9"><select name="config_number_item" class="form-control">';
        for ($i = 0; $i < 20; ++$i) {
            $html .= '<option value="' . $i . '"' . ($data_block['number_item'] == $i ? ' selected="selected"' : '') . '> ' . $i . ' </option>';
        }
        $html .= "</select></div>";
        $html .= '</div>';
        $html . '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['title_length'] . ':</label>';
        $html .= '<div class="col-sm-9"><input type="text" class="form-control" name="config_title_length" value="' . $data_block['title_length'] . '"/></div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * @param string $module
     * @param array $lang_block
     * @return number
     */
    function nvb_config_storehouse_global_sdfgh_submit($module, $lang_block)
    {
        global $nv_Request;

        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['number_item'] = $nv_Request->get_int('config_number_item', 'post', 0);
        $return['config']['title_length'] = $nv_Request->get_int('config_title_length', 'post', 0);
        return $return;
    }

    /**
     * @param array $block_config
     * @return string
     */
    function nvb_storehouse_global_sdfgh($block_config)
    {
        global $global_config, $db, $site_mods, $nv_Cache;

        $mod_name = $block_config['module'];
        if (isset($site_mods[$mod_name])) {
            $mod_file = $site_mods[$mod_name]['module_file'];
            $mod_upload = $site_mods[$mod_name]['module_upload'];
            $mod_data = $site_mods[$mod_name]['module_data'];

            $list = array();

            if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $mod_file . '/global.sdfgh.tpl')) {
                $block_theme = $global_config['module_theme'];
            } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $mod_file . '/global.sdfgh.tpl')) {
                $block_theme = $global_config['site_theme'];
            } else {
                $block_theme = 'default';
            }

            $xtpl = new XTemplate('global.sdfgh.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file);
            $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
            $xtpl->assign('TEMPLATE', $block_theme);
            foreach ($list as $row) {
                $xtpl->assign('ROW', $row);
                $xtpl->parse('main.loop');
            }
            $xtpl->parse('main');
            return $xtpl->text('main');
        }
    }
}

if (defined('NV_SYSTEM')) {
    $content = nvb_storehouse_global_sdfgh($block_config);
}
