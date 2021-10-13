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
$page_title = $lang_module['config'];
$array_config = array();
$error = array();

if ($nv_Request->isset_request('submit', 'post')) {
   
    $array_config['product_prefix'] = $nv_Request->get_title('product_prefix', 'post', '');
    $array_config['sales_prefix'] = $nv_Request->get_title('sales_prefix', 'post', '');
    $array_config['quote_prefix'] = $nv_Request->get_title('quote_prefix', 'post', '');
    $array_config['purchase_prefix'] = $nv_Request->get_title('purchase_prefix', 'post', '');
    $array_config['transfer_prefix'] = $nv_Request->get_title('transfer_prefix', 'post', '');
    $array_config['delivery_prefix'] = $nv_Request->get_title('delivery_prefix', 'post', '');
    $array_config['payment_prefix'] = $nv_Request->get_title('payment_prefix', 'post', '');
    $array_config['return_prefix'] = $nv_Request->get_title('return_prefix', 'post', '');
    $array_config['returnp_prefix'] = $nv_Request->get_title('returnp_prefix', 'post', '');
    $array_config['expense_prefix'] = $nv_Request->get_title('expense_prefix', 'post', '');
    

    if (empty($error)) {
       $sth = $db->prepare('UPDATE ' . NV_CONFIG_GLOBALTABLE . ' SET config_value = :config_value WHERE config_name = :config_name');
	    foreach ($array_config as $config_name => $config_value) {
	        $sth->bindParam(':config_name', $config_name, PDO::PARAM_STR);
	        $sth->bindParam(':config_value', $config_value, PDO::PARAM_STR);
	        $sth->execute();
	    }
	
	    $nv_Cache->delMod($module_name);
    }
} 
	

    
    $row['product_prefix'] = 'SH';
    $row['sales_prefix'] = 'SALES';
    $row['quote_prefix'] = 'QUOTE';
    $row['purchase_prefix'] = 'PC';
    $row['transfer_prefix'] = 'TS';
    $row['delivery_prefix'] = 'DV';
    $row['payment_prefix'] = 'PM';
    $row['return_prefix'] = 'RT';
    $row['returnp_prefix'] = 'RTP';
    $row['expense_prefix'] = 'EP';
    

//print_r('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_settings WHERE setting_id=' . $row['setting_id']);
    $sql = 'SELECT config_name, config_value FROM ' . NV_CONFIG_GLOBALTABLE . ' WHERE module = "storehouse" && lang ="sys"';//print_r($sql);
	$result = $db->query($sql);
	while (list ($c_config_name, $c_config_value) = $result->fetch(3)) {
	    $array_config[$c_config_name] = $c_config_value;
	}

$xtpl = new XTemplate('config.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
$xtpl->assign('ROW', $array_config);



if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}else{
	$xtpl->parse('main.config');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';