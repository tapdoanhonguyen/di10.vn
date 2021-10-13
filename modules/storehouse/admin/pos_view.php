<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 04 Sep 2018 04:16:41 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
/*
	echo "<table>";
    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        print_r($value);
        echo "</td>";
        echo "</tr>";
    }
	echo "</table>";
	*/
$id = $nv_Request->get_int('id', 'get', 0);
$pos = new NukeViet\StoreHouse\Pos;
$data=$pos->index($id);
//print_r($data);die;
$xtpl = new XTemplate('pos_view.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
$xtpl->assign('ORDER_BILL', $data['inv']->reference_no);
$xtpl->assign('ORDER_DATE', date("d/m/Y H:i",$data['inv']->date));
$xtpl->assign('SALES_NAME', $data['inv']->biller);
$xtpl->assign('CUSTOMER', $data['inv']->customer);
$xtpl->assign('AMOUNT', storehouse_number_format($data['inv']->total,0));
$xtpl->assign('PAYMENT_TYPE', storehouse_number_format($data['inv']->total,0));
$store= new NukeViet\StoreHouse\StoreHouse;
$store_detail=$store->storehouse_model->getStoreByID($store_id);
$xtpl->assign('LOGO', $global_config['site_logo']);
$xtpl->assign('TITLE_SHOP', $store_detail['name']);
$xtpl->assign('ADDRESS', $store_detail['address']);
$xtpl->assign('MOBILE', $store_detail['mobile']);
foreach($data['rows'] as $product){
	$product->real_total = storehouse_number_format($product->subtotal,0);
	$product->real_unit_price = storehouse_number_format($product->real_unit_price,0);
	$product->quantity = storehouse_number_format($product->quantity,0);
	$xtpl->assign('PRODUCT', $product);
	$xtpl->parse('main.product');
}
$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['pos'];

include NV_ROOTDIR . '/includes/header.php';
echo $contents;
//echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';