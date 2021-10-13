<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */
if (!defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        list( $id ) = $db->query( 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_emailmarketting WHERE id=' . $id )->fetch(3);
        if( $id > 0 ){
            $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_emailmarketting WHERE id =' . $id);
            if ($count) {
                $nv_Cache->delMod($module_name);
                Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
                die();
            }
        }
        die();
    }
} elseif ($nv_Request->isset_request('delete_list', 'post')) {
    $listall = $nv_Request->get_title('listall', 'post', '');
    $array_id = explode(',', $listall);

    if (!empty($array_id)) {
        foreach ($array_id as $id) {
            $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_emailmarketting WHERE id =' . $id);
        }
        $nv_Cache->delMod($module_name);
        die('OK');
    }
    die('NO');
}

$row = array();
$error = array();
$per_page = 20;
$page = $nv_Request->get_int('page', 'post,get', 1);

$array_search = array(
    'q' => $nv_Request->get_title('q', 'get'),
    'status' => $nv_Request->get_int('status', 'get', '-1')
);
$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=';
$where = '1=1';
if (!empty($array_search['q'])) {
    $base_url .= '&q=' . $array_search['q'];
    $where .= ' AND (title LIKE "%' . $array_search['q'] . '%" OR content LIKE "%' . $array_search['q'] . '%")';
}

if (!empty( $array_search['status'] ) && $array_search['status'] >= 0) {
    $base_url .= '&status=' . $array_search['status'];
    $where .= ' AND status=' . $array_search['status'];
}

$db->sqlreset()
    ->select('COUNT(*)')
    ->from('' . NV_PREFIXLANG . '_' . $module_data . '_emailmarketting')
    ->where( $where);

$sth = $db->prepare($db->sql());

$sth->execute();
$num_items = $sth->fetchColumn();

$db->select('*')
    ->order('addtime DESC')
    ->limit($per_page)
    ->offset(($page - 1) * $per_page);
$sth = $db->prepare($db->sql());
$sth->execute();

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('SEARCH', $array_search);
$xtpl->assign('BASE_URL', $base_url);
$xtpl->assign('add_scenario_detail', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=configemail');

$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
if (!empty($generate_page)) {
    $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
    $xtpl->parse('main.generate_page');
}
while ($view = $sth->fetch()) {
    $view['addtime'] = nv_date('H:i d/m/Y', $view['addtime']);
    $view['status'] = $lang_module['status_' . $view['status']];
    $view['content'] = nv_clean60( strip_tags( $view['content'] ), 300 );
    $view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=configemail&amp;id=' . $view['id'];
    $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);

    $xtpl->assign('VIEW', $view);
    $xtpl->parse('main.loop');
}

$array_status = array(
    $lang_module['status_0'],
    $lang_module['status_1']
);
foreach ($array_status as $index => $value) {
    $sl = $index == $array_search['status'] ? 'selected="selected"' : '';
    $xtpl->assign('STATUS', array(
        'index' => $index,
        'value' => $value,
        'selected' => $sl
    ));
    $xtpl->parse('main.status');
}

$array_action = array(
    'delete_list_id' => $lang_global['delete']
);
foreach ($array_action as $key => $value) {
    $xtpl->assign('ACTION', array(
        'key' => $key,
        'value' => $value
    ));
    $xtpl->parse('main.action');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['list_email'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';