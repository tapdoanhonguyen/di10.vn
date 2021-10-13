<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Aug 2018 04:51:26 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

$row = array();
$error = array();
//unset($_SESSION['print_bacode']);
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if($row['id']>0 && empty($_SESSION['print_bacode'][$row['id']])){
	$row = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_products WHERE id=' . $row['id'])->fetch();
	$_SESSION['print_bacode'][$row['id']]= (object) $row;
	if(count($_SESSION['print_bacode'])>1){
		nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=products_print');
	}
}
	

//print_r(count($_SESSION['print_bacode']));
$xtpl = new XTemplate('products_print.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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

foreach ($_SESSION['print_bacode'] as $productid=>$product){
	$product->quantity=storehouse_number_format($product->quantity,0);
	$xtpl->assign('PRODUCT', $product);
	$xtpl->parse('main.product');
}
$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['print_barcode'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
