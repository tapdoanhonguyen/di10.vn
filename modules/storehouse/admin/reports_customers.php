<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Aug 2018 06:02:24 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

// Change status
if ($nv_Request->isset_request('change_status', 'post, get')) {
    $id = $nv_Request->get_int('id', 'post, get', 0);
    $content = 'NO_' . $id;

    $query = 'SELECT hide FROM ' . $db_config['prefix'] . '_' . $module_data . '_products WHERE id=' . $id;
    $row = $db->query($query)->fetch();
    if (isset($row['hide']))     {
        $hide = ($row['hide']) ? 0 : 1;
        $query = 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_products SET hide=' . intval($hide) . ' WHERE id=' . $id;
        $db->query($query);
        $content = 'OK_' . $id;
    }
    $nv_Cache->delMod($module_name);
    include NV_ROOTDIR . '/includes/header.php';
    echo $content;
    include NV_ROOTDIR . '/includes/footer.php';
}

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_products  WHERE id = ' . $db->quote($id));
        $nv_Cache->delMod($module_name);
        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Products_list', 'ID: ' . $id, $admin_info['userid']);
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
}

$row = array();
$error = array();
$array_unit_storehouse = array();
$_sql = 'SELECT id,name FROM ' . $db_config['prefix'] . '_' . $module_data . '_units';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_unit_storehouse[$_row['id']] = $_row;
}



$date_from = $nv_Request->get_title('date_from', 'post', '');
if($date_from == '') {
	$date_from = "01/".date("m",NV_CURRENTTIME)."/".date("Y",NV_CURRENTTIME);
}
$date_to = $nv_Request->get_title('date_to', 'post', '');
if($date_to == '') {
	$date_to = date("d",NV_CURRENTTIME)."/".date("m",NV_CURRENTTIME)."/".date("Y",NV_CURRENTTIME);
}
$warehhouse_id = $nv_Request->get_int('warehhouse_id', 'post', 0);
// Fetch Limit
$show_view = false;
$start_date = $date_from;
$end_date = $date_to;
$rpproduct = new NukeViet\StoreHouse\Reports;
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 20;
	$customers=$rpproduct->getCustomers($start_date, $end_date);
}else{
	$id = $nv_Request->get_int('id', 'post, get', 0);
	$customer_view=$rpproduct->customer_report($id);
}

//quantity of sales
$xtpl = new XTemplate('reports_customers.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
$xtpl->assign('OP', $op);
$xtpl->assign('date_from', $date_from);
$xtpl->assign('date_to', $date_to);
$xtpl->assign('CUSTOMER_ID', $id );
$xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
$xtpl->assign('THEMES_NEWS_JS', 'themes/' . $global_config['module_theme'] . '/js' );
$xtpl->assign('THEMES_NEWS_CSS', 'themes/' . $global_config['module_theme'] . '/css' );
$xtpl->assign('SUPPLIER_ID', $id );
//print_r($customers);die;
$number=0;
if ($show_view) {
    
    foreach ($customers as $key => $customer) {
    	$customer['link_view'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=reports_customers&id=' .  $customer['id'];
		$customer['total_format'] = storehouse_number_format( $customer['total'] ,0);
		$customer['paid_format'] = storehouse_number_format( $customer['paid'] ,0);
		$customer['balance_format'] = storehouse_number_format( $customer['balance'] ,0);
		$customer['grand_total_fomart'] = storehouse_number_format( $customer['grand_total'],0);
        $xtpl->assign('CUSTOMER', $customer);
        $xtpl->parse('main.view.customer');
    }
    $xtpl->parse('main.view');
}else{
	//print_r($supplier_view);die;
	$xtpl->assign('total_amount', storehouse_number_format($customer_view['sales']['total_amount'],0));
	$xtpl->assign('paid', storehouse_number_format($customer_view['sales']['paid'],0));
	$xtpl->assign('total_paid', storehouse_number_format($customer_view['sales']['total_amount']-$customer_view['sales']['paid'],0));
	$xtpl->assign('total_sales', storehouse_number_format($customer_view['total_sales'],0));
	
	
	$xtpl->parse('main.customers_view');
}


if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = '';

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
