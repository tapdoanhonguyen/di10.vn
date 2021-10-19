<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

if (!nv_function_exists('nv_icon_home')) {
    /**
     * nv_icon_home_config()
     *
     * @param string $module
     * @param array  $data_block
     * @param array  $lang_block
     * @return string
     */
    function nv_icon_home_config($module, $data_block, $lang_block)
    {
        global $lang_global, $selectthemes;

        // Find language file
        if (file_exists(NV_ROOTDIR . '/themes/' . $selectthemes . '/language/' . NV_LANG_INTERFACE . '.php')) {
            include NV_ROOTDIR . '/themes/' . $selectthemes . '/language/' . NV_LANG_INTERFACE . '.php';
        }

        $html = '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['icon1'] . ':</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_icon1" value="' . $data_block['icon1'] . '"></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['icon2'] . ':</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_icon2" value="' . $data_block['icon2'] . '"></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['icon3'] . ':</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_icon3" value="' . $data_block['icon3'] . '"></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['icon4'] . ':</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_icon4" value="' . $data_block['icon4'] . '"></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">' . $lang_block['icon5'] . ':</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_icon5" value="' . $data_block['icon5'] . '"></div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * nv_icon_home_submit()
     *
     * @return array
     */
    function nv_icon_home_submit()
    {
        global $nv_Request;

        $return = [];
        $return['error'] = [];
        $return['config']['icon1'] = $nv_Request->get_title('config_icon1', 'post');
        $return['config']['icon2'] = $nv_Request->get_title('config_icon2', 'post');
        $return['config']['icon3'] = $nv_Request->get_title('config_icon3', 'post');
        $return['config']['icon4'] = $nv_Request->get_title('config_icon4', 'post');
        $return['config']['icon5'] = $nv_Request->get_title('config_icon5', 'post');

        return $return;
    }

    /**
     * nv_icon_home()
     *
     * @param array $block_config
     * @return string
     */
    function nv_icon_home($block_config)
    {
        global $global_config, $lang_global;

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.icon_home.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.icon_home.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate('global.icon_home.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');
        $xtpl->assign('LANG', $lang_global);
        $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
        $xtpl->assign('DATA', $block_config);

        if (!empty($block_config['icon1'])) {
			$xtpl->assign('icon1', $block_config['icon1']);
            $xtpl->parse('main.icon1');
        }
		if (!empty($block_config['icon2'])) {
			$xtpl->assign('icon2', $block_config['icon2']);
            $xtpl->parse('main.icon2');
        }
		if (!empty($block_config['icon3'])) {
			$xtpl->assign('icon3', $block_config['icon3']);
            $xtpl->parse('main.icon3');
        }
		if (!empty($block_config['icon4'])) {
			$xtpl->assign('icon4', $block_config['icon4']);
            $xtpl->parse('main.icon4');
        }
		if (!empty($block_config['icon5'])) {
			$xtpl->assign('icon5', $block_config['icon5']);
            $xtpl->parse('main.icon5');
        }
        $xtpl->parse('main');

        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_icon_home($block_config);
}
