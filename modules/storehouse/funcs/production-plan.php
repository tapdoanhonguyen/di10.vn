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
    Header('Location: ' . nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users', true));
    die();
}

if( $groups ==5){
	
	Header('Location: ' . nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE.'', true));
    die();
	$per_page = 20;
	    $page = $nv_Request->get_int('page', 'post,get', 1);
	
	$db->sqlreset()
        ->select('COUNT(*)')
        ->from($db_config['dbsystem']. '.'  . $db_config['prefix'] . '_' . $module_data . '_sales s')
        ->join('LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_project p on s.projectid = p.projectid')
        ->where('sale_status = 1');

  
    $sth = $db->prepare($db->sql());
    $sth->execute();
	$num_items = $sth->fetchColumn();
	
    $db->select('s.*, p.title')
        ->order('id DESC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    $sth = $db_slave->query($db->sql());
	$array_data=array();
	while ($view = $sth->fetch()) {
		$array_data[] = $view;
		}
	
	$contents = nv_theme_storehouse_product_plan($array_data);
}elseif( $groups ==23){
	$contents = nv_theme_storehouse_vehicle($array_data);
}



include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
