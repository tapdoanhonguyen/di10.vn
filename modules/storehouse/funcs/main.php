<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */

if (!defined('NV_IS_MOD_STOREHOUSE'))
    die('Stop!!!');

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

$array_data = array();

if (!defined('NV_IS_USER')) {
	if($op == 'main'){
		Header('Location: ' . nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&amp;nv_redirect=' . nv_redirect_encrypt(nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true)), true));
	}else {
		Header('Location: ' . nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&amp;nv_redirect=' . nv_redirect_encrypt(nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' .$op, true)), true));
	}
    die();
}

$product_plan=$db->query('SELECT *, pl.status as status FROM '.$db_config['prefix'] . '_' . $module_data . '_production_plan_user plu LEFT JOIN '.$db_config['prefix'] . '_' . $module_data . '_production_plan pl on plu.planid = pl.id WHERE plu.userid ='. $user_info['userid'] . ' AND pl.status !=4');
$array_data['total_my_producttion_plan'] = $product_plan->rowCount();
$pl_i_4 = $pl_i_0 = $pl_i_1 = $pl_i_2 = $pl_i_3 = 0;
while($pl=$product_plan->fetch()){
	if($pl['status'] == 4 ){
		$pl_i_4++;
	}
	if($pl['status'] == 3 ){
		$pl_i_3++;
	}
	if($pl['status'] == 2 ){
		$pl_i_2++;
	}
	if($pl['status'] == 1 ){
		$pl_i_1++;
	}
	if($pl['status'] == 0 ){
		$pl_i_0++;
	}
}
$array_data['total_my_producttion_plan_0'] = $pl_i_0;
$array_data['total_my_producttion_plan_1'] = $pl_i_1;
$array_data['total_my_producttion_plan_2'] = $pl_i_2;
$array_data['total_my_producttion_plan_3'] = $pl_i_3;
$array_data['total_my_producttion_plan_4'] = $pl_i_4;
$contents = nv_theme_storehouse_main($array_data);
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
