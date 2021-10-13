<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}
if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->exec("DELETE FROM " . NV_PREFIXLANG . "_" . $module_data . "_sms_queue WHERE id=" . $id);
        $nv_Cache->delMod($module_name);
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
        die();
    }
}

$productid = 0;
$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
// Fetch Limit
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {

    $show_view = true;
    $per_page = 10;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()->select('COUNT(*)')->from('' . NV_PREFIXLANG . '_' . $module_data . '_sms_queue');
    $sth = $db->prepare($db->sql());
    $sth->execute();
    $num_items = $sth->fetchColumn();

    $db->select('*')->order('timesend')->limit($per_page)->offset(($page - 1) * $per_page);
    $sth = $db->prepare($db->sql());
    $sth->execute();
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('CAPTION', ($row['id']) ? $lang_module['scenario_edit'] : $lang_module['scenario_add']);

if ($show_view) {
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.generate_page');
    }

    while ($view = $sth->fetch()) {
        $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
        $view['timesend'] = date('d/m/Y H', $view['timesend'] ) . 'h00';
        $view['active'] = $lang_module['active_' . $view['active']];
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.loop');
    }
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['message_queue'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
