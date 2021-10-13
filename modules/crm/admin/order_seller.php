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

$time_month  = NV_CURRENTTIME - (86400 * 90);
$search['date_from'] = $nv_Request->get_string('from', 'get', date('d/m/Y', $time_month) );
$search['date_to'] = $nv_Request->get_string('to', 'get', date('d/m/Y', NV_CURRENTTIME) );
$search['order_phone'] = $nv_Request->get_string('order_phone', 'get', '');
$search['order_payment'] = $nv_Request->get_title('order_payment', 'get', '');

if (!empty($search['date_from'])) {
    if (!empty($search['date_from']) and preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $search['date_from'], $m)) {
        $search['date_from'] = mktime(0, 0, 0, $m[2], $m[1], $m[3]);
    } else {
        $search['date_from'] = NV_CURRENTTIME;
    }

    $where .= ' AND t1.order_time >= ' . $search['date_from'] . '';
}

if (!empty($search['date_to'])) {
    if (!empty($search['date_to']) and preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $search['date_to'], $m)) {
        $search['date_to'] = mktime(23, 59, 59, $m[2], $m[1], $m[3]);
    } else {
        $search['date_to'] = NV_CURRENTTIME;
    }
    $where .= ' AND t1.order_time <= ' . $search['date_to'] . '';
}

if (!empty($search['order_phone'])) {
    $where .= ' AND t2.mobile like ' . $db->quote( $search['order_phone'] );
}

if ($search['order_payment'] != '') {
    $where .= ' AND t1.transaction_status  = ' . $search['order_payment'] . '';
}


$transaction_status = array(
    '4' => $lang_module['history_payment_yes'],
    '0' => $lang_module['history_payment_no'],
    '-1' => $lang_module['history_payment_wait']
);

$xtpl = new XTemplate("order_seller.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file);
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
$order_info = array(
    'num_items' => 0,
    'sum_price' => 0,
    'sum_unit' => ''
);

$sql = 'SELECT t1.*, t2.full_name, t2.mobile, t2.email, t2.adminid FROM ' . $table_name . ' t1, ' . NV_PREFIXLANG . '_' . $module_data . ' AS t2 WHERE t1.customerid=t2.id' . $where;
$nv_Request->set_Session( $module_data . '_order_seller', $sql);

$query = $db->query($sql);

$array_data = array( );
$aray_khachhang = array( );
while ($row = $query->fetch()) {
    $array_data[$row['customerid']]['info'] = array(
        'customerid' => $row['customerid'],
        'full_name' => $row['full_name'],
        'mobile' => $row['mobile'],
        'email' => $row['email'],
        'adminid' => $row['adminid'],
    );

    if( isset( $array_data[$row['customerid']]['data'][$row['transaction_status']] )){
        $array_data[$row['customerid']]['data'][$row['transaction_status']]['total_order']++;
        $array_data[$row['customerid']]['data'][$row['transaction_status']]['total_price'] += $row['order_total'];
    }else{
        $array_data[$row['customerid']]['data'][$row['transaction_status']]['total_price'] = $row['order_total'];
        $array_data[$row['customerid']]['data'][$row['transaction_status']]['total_order'] = 1;
    }
}



$xtpl->assign('URL_CHECK_PAYMENT', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=checkpayment");
$xtpl->assign('URL_DEL', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=or_del");
$xtpl->assign('URL_DEL_BACK', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op);

if (!empty($search['date_from'])) {
    $search['date_from'] = nv_date('d/m/Y', $search['date_from']);
}

if (!empty($search['date_to'])) {
    $search['date_to'] = nv_date('d/m/Y', $search['date_to']);
}

//nv kd
$array_saller = array();
$sql = "SELECT * FROM " . NV_USERS_GLOBALTABLE;
$result = $db->query($sql);
while ($row = $result->fetch()) {
    $array_saller[$row['userid']] = nv_show_name_user($row['first_name'], $row['last_name']);
}

foreach ($transaction_status as $key => $status ) {
    $xtpl->assign('title_status', $status);
    $xtpl->parse('main.data.title_status');
    $xtpl->parse('main.data.title_status_2');
}
$order_list_url = NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=shops&" . NV_OP_VARIABLE . '=order&from=' . $search['date_from'] . '&to=' . $search['date_to'] . '&checkss=' . md5( session_id() ) . '&customerid=';
foreach ($array_data as $data_customer ) {
    $customer = $data_customer['info'];
    $customer['saller_name'] =  isset($array_saller[$customer['adminid']])? $array_saller[$customer['adminid']] : 'N/A';
    $xtpl->assign('CUSTOMER', $customer);
    foreach ($transaction_status as $key => $status ) {
        if( isset( $data_customer['data'][$key] )){
            $data = $data_customer['data'][$key];
            $data['total_price'] = number_format( $data['total_price'], 0, '.', ',');
            $data['link'] = $order_list_url . $customer['customerid'] . '&order_payment=' . $key;
            $xtpl->assign('STATUS', $data);
            $xtpl->parse('main.data.row.value_status.link');
        }else{
            $xtpl->assign('STATUS', array());
        }
        $xtpl->parse('main.data.row.value_status');
    }
    $xtpl->parse('main.data.row');
}

$xtpl->parse('main.data');

foreach ($transaction_status as $key => $lang_status) {
    $xtpl->assign('TRAN_STATUS', array(
        'key' => $key,
        'title' => $lang_status,
        'selected' => ( $search['order_payment'] != '' and $key == $search['order_payment']) ? 'selected="selected"' : ''
    ));
    $xtpl->parse('main.transaction_status');
}

$xtpl->assign('CHECKSESS', md5(session_id()));
$xtpl->assign('SEARCH', $search);

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
