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
if (!defined('NV_IS_USER')) {
	if($op == 'main'){
		Header('Location: ' . nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&amp;nv_redirect=' . nv_redirect_encrypt(nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true)), true));
	}else {
		Header('Location: ' . nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&amp;nv_redirect=' . nv_redirect_encrypt(nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' .$op, true)), true));
	}
    die();
}
if($groups==13 || $groups==1){
	$page =1;
	$per_page_sales = 5;
	$per_page_project = 5;
	if(!empty($array_op[1])){
		$view = $array_op[1];
	}else{
		$view = 'info';
	}
	
	$db->sqlreset()
        ->select('c.*')
        ->from($db_config['dbsystem']. '.'  . $db_config['prefix'] . '_' . $module_data . '_companies c')
        ->join('LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_companies_user cu on c.id = cu.company_id')
        ->where('cu.userid = ' . $user_info['userid'] . ' AND group_id='.$groups)
		->order('id DESC');

  
    $sth = $db->prepare($db->sql());
    $sth->execute();
	$supplier = $sth->fetch(5);
	$rpproduct = new NukeViet\StoreHouse\Reports;
	$date_from = $nv_Request->get_title('date_from', 'post', '');
	$date_from = $nv_Request->get_title('date_from', 'post,get', '');
	if($date_from == '') {
		$date_from = "01/".date("m",NV_CURRENTTIME)."/".date("Y",NV_CURRENTTIME);
	}
	if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $date_from, $m)) {
        $phour = $nv_Request->get_int('phour', 'post', 0);
        $pmin = $nv_Request->get_int('pmin', 'post', 0);
        $date_from = mktime($phour, $pmin, 0, $m[2], $m[1], $m[3]);
    } else {
        $date_from = mktime($phour, $pmin, 0, date("m",NV_CURRENTTIME), 01, date("Y",NV_CURRENTTIME));
    }
	$date_to = $nv_Request->get_title('date_to', 'post,get', '');
	if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $date_to, $m)) {
        $phour = $nv_Request->get_int('phour', 'post', 0);
        $pmin = $nv_Request->get_int('pmin', 'post', 0);
        $date_to = mktime($phour, $pmin, 0, $m[2], $m[1], $m[3]);
    } else {
        $date_to = NV_CURRENTTIME;
    }
	if(!empty($supplier)){
		if($view == 'project'){
			$contents = nv_theme_storehouse_supplier_project($supplier,$project_sales,$date_from,$date_to);
		}elseif($view == 'sales' ){
			$contents = nv_theme_storehouse_supplier_purchase($supplier,$project_sales,$date_from,$date_to);
		}else{
			$contents = nv_theme_storehouse_supplier_info($supplier,$rpproduct,$date_from,$date_to);
		} 
	}else{
		$contents = nv_theme_storehouse_no_permission();
	}
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_site_theme($contents);
	include NV_ROOTDIR . '/includes/footer.php';
}

