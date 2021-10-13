<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if (!defined('NV_IS_MOD_CRM')) die('Stop!!!');

/**
 * nv_theme_crm_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_crm_main($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_crm_detail()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_crm_detail($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_crm_search()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_crm_search($array_data)
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);

    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_theme_crm_label($array, $label = 'warning')
{
    $html = '';
    foreach ($array as $value) {
        $html .= '<span class="label label-' . $label . '">' . $value . '</span>&nbsp;';
    }
    return $html;
}