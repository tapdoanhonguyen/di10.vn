<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
$page_title = '';
$welcome = New NukeViet\StoreHouse\Welcome;
/* $data['sales'] = $welcome->db_model->getLatestSales();
$data['quotes'] = $welcome->db_model->getLastestQuotes();
$data['purchases'] = $welcome->db_model->getLatestPurchases();
$data['transfers'] = $welcome->db_model->getLatestTransfers();
$data['customers'] = $welcome->db_model->getLatestCustomers();
$data['suppliers'] = $welcome->db_model->getLatestSuppliers(); */
//print_r($data);
$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('IP', $client_info['ip']);
if(IDSITE>0){ 
	$xtpl->assign('NAME_STORE', $lang_module['store_main']);
}else{
	
	/* if($_SESSION[$module_data . '_store_id'] == 0){ 
		$xtpl->assign('NAME_STORE', $lang_module['store_main']);
	}else{
		$xtpl->assign('NAME_STORE', $array_store_storehouse[$_SESSION[$module_data . '_store_id']]['name']);
	} */
}
$i=1;
if(!empty($data['sales']))
foreach ($data['sales'] as $sale){
	
	$sale->number=$i;
	$sale->customer=$welcome->site->getCompanyByID($sale->customer_id);
	$sale->date_formart=date("d/m/Y H:i",$sale->date);
	$sale->grand_total_format=storehouse_number_format($sale->grand_total,0);
	$sale->paid_format=storehouse_number_format($sale->paid,0);
	$sale->sale_status_formart=$array_sales_status[$sale->sale_status];
	$sale->payment_formart=$array_payment_status[$sale->payment_status];
	$xtpl->assign('SALES', $sale);
	$xtpl->parse('main.sales');
	$i++;
}
$i=1;
if(!empty($data['purchases']))
foreach ($data['purchases'] as $purchase){
	$purchase->number=$i;
	$purchase->date_formart=date("d/m/Y H:i",$purchase->date);
	$purchase->grand_total_format=storehouse_number_format($purchase->grand_total,0);
	$purchase->paid_format=storehouse_number_format($purchase->paid,0);
	$purchase->status_formart=$array_status[$purchase->status];
	$purchase->payment_formart=$array_payment_status[$purchase->payment_status];
	$purchase->supplier=$welcome->site->getCompanyByID($purchase->supplier_id);
	$xtpl->assign('PURCHASES', $purchase);
	$xtpl->parse('main.purchases');
	$i++;
}
$i=1;
if(!empty($data['customers']))
foreach ($data['customers'] as $customer){
	$xtpl->assign('CUSTOMER', $customer);
	$xtpl->parse('main.customer');
}
$i=1;
if(!empty($data['suppliers']))
foreach ($data['suppliers'] as $supplier){
	$xtpl->assign('SUPPLIER', $supplier);
	$xtpl->parse('main.supplier');
}

if(IDSITE == 0){
	$xtpl->parse('main.button_product');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
