<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Aug 2018 02:41:08 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
$purchaes = New NukeViet\StoreHouse\Purchases;
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.catalogy.php';
$id = $nv_Request->get_int('id', 'get', 0);
$row = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_purchases WHERE id=' . $id )->fetch(5);

$row->customer = $purchaes->site->getCompanyByID($row->supplier_id);
print_r($row);
if (empty($row)) {
	nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=purchases_list' );
}
$row_items = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_purchase_items WHERE purchase_id=' . $id )->fetch(5);


$xtpl = new XTemplate('purchases_subsite_view.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
$xtpl->assign('STORE_SESSION', $_SESSION[$module_data . '_store_id']);
$xtpl->assign('OP', $op);
$xtpl->assign('DATA', $row);
foreach($row_items as $items){
	
	$xtpl->parse('main.loop');
}
$xtpl->parse('main');
$contents = $xtpl->text('main');


 
include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
/* echo nv_admin_theme($purchaes->index()); */
include NV_ROOTDIR . '/includes/footer.php';
