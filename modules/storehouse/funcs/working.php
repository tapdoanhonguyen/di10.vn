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
 		$per_page = 20;
	    $page = $nv_Request->get_int('page', 'post,get', 1);
	    $db->sqlreset()
	        ->select('COUNT(s.id)')
	        ->from($db_config['dbsystem']. '.'  . $db_config['prefix'] . '_' . $module_data . '_sales s')
	        ->join('LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_project p on s.projectid = p.projectid LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_production_plan_user plu on s.projectid = plu.projectid AND s.id = plu.saleid LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_production_plan pl on p.projectid = plu.projectid AND pl.saleid = plu.saleid ')
	        ->where('plu.userid = ' . $user_info['userid'] . ' AND pl.status IS NOT NULL ');

	    $project_sales = $db->prepare($db->sql());
		
	    $project_sales->execute();
	    $num_items = $project_sales->fetchColumn();
	
	    $db->select('s.id,s.reference_no,s.date, s.customer,s.projectid,s.sale_status, p.title, pl.status')
	        ->order('id DESC')
	        ->limit($per_page)
	        ->offset(($page - 1) * $per_page);
	    $project_sales = $db->prepare($db->sql());
		//print_r($db->sql());die;
		$project_sales->execute();
		$db->sqlreset()
	        ->select('COUNT(s.id)')
	        ->from($db_config['dbsystem']. '.'  . $db_config['prefix'] . '_' . $module_data . '_sales s')
	        ->join('LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_project p on s.projectid = p.projectid LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle_user vu on s.projectid = vu.projectid AND s.id = vu.saleid LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle v on v.projectid = vu.projectid AND v.saleid = vu.saleid ')
	        ->where('vu.userid = ' . $user_info['userid'] . ' AND v.status IS NOT NULL' );

	    $vehicle = $db->prepare($db->sql());
		
	    $vehicle->execute();
	    $num_items = $vehicle->fetchColumn();
	
	    $db->select('s.id,s.reference_no,s.date, s.customer,s.projectid,s.sale_status, p.title, v.status, vu.quantity as total')
	        ->order('id DESC')
	        ->limit($per_page)
	        ->offset(($page - 1) * $per_page);
	    $vehicle = $db->prepare($db->sql());
		//print_r($db->sql());die;
		$vehicle->execute();
	$contents = nv_theme_storehouse_project_sales($project_sales,$vehicle);
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
