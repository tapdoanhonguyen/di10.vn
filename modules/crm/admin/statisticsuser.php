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


$page_title = $lang_module['order_seller'];
$table_name = NV_IS_TABLE_SHOPS . "_orders";

$checkss = $nv_Request->get_string('checkss', 'get', '');
$where = '';
$search = array( );
if ($checkss == md5(session_id())) {
    $search['num_sell_from'] = $nv_Request->get_int('num_sell_from', 'get', 0);
    $search['num_sell_to'] = $nv_Request->get_int('num_sell_to', 'get', 0);


    if ($search['num_sell_from'] > 0 ) {
        $where .= ' AND num_sell >= ' . $search['num_sell_from'];
    }
    if ($search['num_sell_to'] > 0 ) {
        $where .= ' AND num_sell <= ' . $search['num_sell_to'];
    }
}


$xtpl = new XTemplate($op . ".tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$per_page = 20;
$page = $nv_Request->get_int('page', 'get', 1);
$base_url = NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op;
$count = 0;

$sql = 'SELECT t1.user_id, COUNT(proid) AS total FROM ' . $table_name . ' t1, ' . $table_name . '_id t2 WHERE t1.transaction_status=4 AND t2.order_id=t2.order_id GROUP BY t1.user_id';
//die($sql);
$query = $db->query($sql);

$array_data = array( );
while ($row = $query->fetch()) {
    $array_data[$row['proid']] = $row['total'];
}

$array_saller = array();
$sql = "SELECT * FROM " . NV_USERS_GLOBALTABLE;
$result = $db->query($sql);
while ($row = $result->fetch()) {
    $array_saller[$row['userid']] = nv_show_name_user($row['first_name'], $row['last_name']);
}


foreach ($array_saller as $data) {
    $data['luotmua'] = isset( $array_data[$data['id']] )? $array_data[$data['id']] : 0;
    $xtpl->assign('DATA', $data);
    $xtpl->parse('main.data.row');
    $xtpl->parse('main.highcharts.user');
}
if( !empty( $array_saller )){
    $xtpl->parse('main.highcharts');
    $xtpl->parse('main.data');
}

$xtpl->assign('CHECKSESS', md5(session_id()));
$xtpl->assign('SEARCH', $search);

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
