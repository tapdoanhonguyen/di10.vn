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

$page_title = $lang_module['hoahong'];
$table_name = NV_IS_TABLE_SHOPS . "_orders";

$checkss = $nv_Request->get_string('checkss', 'get', '');
$where = ' transaction_status =4';
$search = array( );

$time_month  = NV_CURRENTTIME - (86400 * 30);
$search['date_from'] = $nv_Request->get_string('from', 'get', date('d/m/Y', $time_month) );
$search['date_to'] = $nv_Request->get_string('to', 'get', date('d/m/Y', NV_CURRENTTIME) );
$search['order_nhanvien'] = $nv_Request->get_int('order_nhanvien', 'get', 0 );

if (!empty($search['date_from'])) {
    if (!empty($search['date_from']) and preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $search['date_from'], $m)) {
        $search['date_from'] = mktime(0, 0, 0, $m[2], $m[1], $m[3]);
    } else {
        $search['date_from'] = NV_CURRENTTIME;
    }

    $where .= ' AND t1.time_payment >= ' . $search['date_from'] . '';
}

if (!empty($search['date_to'])) {
    if (!empty($search['date_to']) and preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $search['date_to'], $m)) {
        $search['date_to'] = mktime(23, 59, 59, $m[2], $m[1], $m[3]);
    } else {
        $search['date_to'] = NV_CURRENTTIME;
    }
    $where .= ' AND t1.time_payment <= ' . $search['date_to'] . '';
}

if( $search['order_nhanvien'] > 0 )
{
    $where .= ' AND t1.user_id = ' . $search['order_nhanvien'];
}

$transaction_status = array(
    '4' => $lang_module['history_payment_yes'],
    '0' => $lang_module['history_payment_no'],
    '-1' => $lang_module['history_payment_wait']
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

$order_list_url = NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=shops&" . NV_OP_VARIABLE . '=order&from=' . $search['date_from'] . '&to=' . $search['date_to'] . '&checkss=' . md5( session_id() ) . '&customerid=';

$sql = 'SELECT t1.*, t2.full_name, t2.mobile, t2.email, t2.adminid FROM ' . $table_name . ' AS t1 INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . ' AS t2 ON t1.customerid=t2.id WHERE ' . $where;
$query = $db->query($sql);

$array_data = array( );
$array_orderid = array( );
while ($row = $query->fetch()) {
    $row['saller_name'] =  isset($array_saller[$row['user_id']])? $array_saller[$row['user_id']] : 'N/A';
    $row['order_total'] = number_format( $row['order_total'], 0, '.', ',');
    $array_data[] = $row;
    $array_orderid[] = $row['order_id'];
}
if( !empty( $array_orderid )){
    $sql = 'SELECT t2.order_id, t2.num, t2.price, t1.id, t1.product_price, t1.gia_von FROM ' . NV_IS_TABLE_SHOPS . '_rows AS t1 INNER JOIN ' . NV_IS_TABLE_SHOPS . '_orders_id AS t2 ON t1.id=t2.proid WHERE t2.order_id IN(' . implode(',', $array_orderid ) . ')';
    $query = $db->query($sql);

    $array_data_hoahong = array( );
    while ($row = $query->fetch()) {
        $price_sale = $row['price'] - $row['gia_von'];
        $row['hoahong'] = $price_sale * $row['num'];
        if( isset( $array_data_hoahong[$row['order_id']] )){
            $array_data_hoahong[$row['order_id']] += $row['hoahong'];
        }else{
            $array_data_hoahong[$row['order_id']] = $row['hoahong'];
        }
    }
}

// SELECT DANH SÁCH  NHÂN VIÊN
$list_user = array();
$db->select( '*' )->from( NV_USERS_GLOBALTABLE );
$s = $db->query( $db->sql() );
while( $row_u_i = $s->fetch() )
{
    $sl = ( $search['order_nhanvien'] == $row_u_i['userid'] )? ' selected=selected' : '';
    $list_user[$row_u_i['userid']] = array( 'userid' => $row_u_i['userid'], 'username' => $row_u_i['last_name'] . " " . $row_u_i['first_name'], 'sl' => $sl );
}

// DANH SÁCH NHÂN VIÊN
foreach( $list_user as $u )
{
    $xtpl->assign( 'LISTUSER', $u );
    $xtpl->parse( 'main.user' );
}

$link_shops = NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=shops&" . NV_OP_VARIABLE . '=';
foreach ( $array_data as $data ){
    $data['hoahong'] = $array_data_hoahong[$data['order_id']];
    $data['hoahong'] = number_format( $data['hoahong'], 0, '.', ',');
    $data['detail_order'] = $link_shops . 'or_view&order_id=' . $data['order_id'];
    $data['time_payment'] = date( 'H:i d/m/Y', $data['time_payment']);
    $xtpl->assign('DATA', $data);
    $xtpl->parse('main.data.row');
}
$xtpl->parse('main.data');


$xtpl->assign('CHECKSESS', md5(session_id()));
$xtpl->assign('SEARCH', $search);

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
