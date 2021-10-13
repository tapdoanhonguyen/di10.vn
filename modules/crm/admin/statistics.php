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
    $search['order_code'] = $nv_Request->get_string('order_code', 'get', '');
    $search['date_from'] = $nv_Request->get_string('from', 'get', '');
    $search['date_to'] = $nv_Request->get_string('to', 'get', '');
    $search['userid'] = $nv_Request->get_string('userid', 'get', '');
    $search['order_payment'] = $nv_Request->get_string('order_payment', 'get', '');

    if (!empty($search['order_code'])) {
        $where .= ' AND order_code like "%' . $search['order_code'] . '%"';
    }

    if (!empty($search['date_from'])) {
        if (!empty($search['date_from']) and preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $search['date_from'], $m)) {
            $search['date_from'] = mktime(0, 0, 0, $m[2], $m[1], $m[3]);
        } else {
            $search['date_from'] = NV_CURRENTTIME;
        }

        $where .= ' AND order_time >= ' . $search['date_from'] . '';
    }

    if (!empty($search['date_to'])) {
        if (!empty($search['date_to']) and preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $search['date_to'], $m)) {
            $search['date_to'] = mktime(23, 59, 59, $m[2], $m[1], $m[3]);
        } else {
            $search['date_to'] = NV_CURRENTTIME;
        }
        $where .= ' AND order_time <= ' . $search['date_to'] . '';
    }

    if ($search['userid'] > 0 ) {
        $where .= ' AND user_id =' . $search['userid'];
    }

    if ($search['order_payment'] != '') {
        $where .= ' AND transaction_status  = ' . $search['order_payment'] . '';
    }
}

$transaction_status = array(
    '4' => $lang_module['history_payment_yes'],
    '0' => $lang_module['history_payment_no']
);

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
$order_info = array(
    'num_items' => 0,
    'sum_price' => 0,
    'sum_unit' => ''
);

$sql = 'SELECT user_id, COUNT(order_id) AS total_order, count(case when transaction_status = 0 then transaction_status end) as transaction_status_0, count(case when transaction_status = 4 then transaction_status end) as transaction_status_4 FROM ' . $table_name . ' WHERE 1=1' . $where . ' GROUP BY user_id';

$query = $db->query($sql);

$array_data = array( );
$aray_khachhang = array( );
while ($row = $query->fetch()) {
    $array_data[] = $row;
}

$xtpl->assign('URL_CHECK_PAYMENT', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=checkpayment");
$xtpl->assign('URL_DEL', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=or_del");
$xtpl->assign('URL_DEL_BACK', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op);

// Nh�n vi�n kinh doanh
$array_saller = $list_user = array();
$sql = "SELECT * FROM " . NV_USERS_GLOBALTABLE;
$result = $db->query($sql);
while ($row = $result->fetch()) {
    $array_saller[$row['userid']] = nv_show_name_user($row['first_name'], $row['last_name']);
    $list_user[$row['userid']] = array( 'userid' => $row['userid'], 'username' => $row['last_name'] . " " . $row['first_name'] );
    
}

// DANH SÁCH NHÂN VIÊN
foreach( $list_user as $u )
{
    if(!empty($search['userid'])){
		$u['sl'] = ( $search['userid'] == $u['userid'] )? ' selected=selected' : '';
	}else{
		$u['sl'] = '';
	}
    $xtpl->assign( 'LISTUSER', $u );
    $xtpl->parse( 'main.user' );
}

foreach ($array_data as $data) {
    $data['saller_name'] =  isset($array_saller[$data['user_id']])? $array_saller[$data['user_id']] : 'N/A';
    $data['order_list_url'] = NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=shops&" . NV_OP_VARIABLE . "=order&checkss=" . md5(session_id()) . '&order_nhanvien=' . $data['user_id'];
    $xtpl->assign('DATA', $data);
    $xtpl->parse('main.data.row');
    $xtpl->parse('main.highcharts.user');
}
if( !empty( $array_data )){
    $xtpl->parse('main.highcharts');
    $xtpl->parse('main.data');
}


foreach ($transaction_status as $key => $lang_status) {
    $xtpl->assign('TRAN_STATUS', array(
        'key' => $key,
        'title' => $lang_status,
        'selected' => (isset($search['order_payment']) and $key == $search['order_payment']) ? 'selected="selected"' : ''
    ));
    $xtpl->parse('main.transaction_status');
}

if (!empty($search['date_from'])) {
    $search['date_from'] = nv_date('d/m/Y', $search['date_from']);
}

if (!empty($search['date_to'])) {
    $search['date_to'] = nv_date('d/m/Y', $search['date_to']);
}
$xtpl->assign('CHECKSESS', md5(session_id()));
$xtpl->assign('SEARCH', $search);

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
