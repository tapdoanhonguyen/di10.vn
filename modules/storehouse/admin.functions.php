<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN'))
    die('Stop!!!');
$groups =0;
define('NV_IS_FILE_ADMIN', true);
define('MULTICOMPANY', 0);
 if(!defined('IDSITE')) define('IDSITE', 0);
define("NV_TABLE_SHOPS", $db_config['prefix'] . '_san_pham');
define("NV_TABLE_SHOPS_PRODUCT", $db_config['prefix'] . '_san_pham_rows');
if(defined("NV_IS_USER")){
	$user_info['affiliate_groups'] = $db->query("SELECT group_id FROM " .$db_config['dbsystem'] . '.' . NV_IS_TABLE_SHOPS . "_affiliate_user WHERE userid = " . $user_info['userid'])->fetch(5);
}else{
	if (!empty($user_info)) {
		$user_info['affiliate_groups'] = array();
	}
}
$_SESSION[$module_data . '_user_id'] = $admin_info['userid'];
 $array_store_storehouse[IDSITE]['parentid'] = 0; 
 //session on class StoreHouse
 //print_r($admin_info);die;
/* 
$_SESSION[$module_data . '_group_id'] = $admin_info['group_id'];
if(IDSITE> 0 ){
	$_SESSION[$module_data . '_store_id']=IDSITE;
	if (!isset($_SESSION[$module_data . '_store_warehouse_id'])) {
	    $_SESSION[$module_data . '_store_warehouse_id'] = 0;
	
	}
}else{
	if (!isset($_SESSION[$module_data . '_store_id'])) {
	    $_SESSION[$module_data . '_store_id'] = 0;
	
	}
	if (!isset($_SESSION[$module_data . '_store_id'])) {
    $_SESSION[$module_data . '_remove_posls'] = '0';

	}
	if (!isset($_SESSION[$module_data . '_store_warehouse_id'])) {
	    $_SESSION[$module_data . '_store_warehouse_id'] = 0;
	
	}
} */
$_SESSION[$module_data . '_store_id'] = 0;
require NV_ROOTDIR . '/modules/' . $module_file . '/global.catalogy.php';
require NV_ROOTDIR . '/modules/' . $module_file . '/global.datadefault.php'; 




$info_module = array(
	'mod_data' => $module_data,
	'mod_data_sales' => $module_data,
	'mod_upload' => $module_upload,
	'mod_name' => $module_name,
	'mod_file' => $module_file,
	'mod_lang' => $lang_module,
	'lang_data' => NV_LANG_DATA,
	);
	
//$StoreGeneral = new NukeViet\StoreHouse\General( $StoreRegistry );



require_once NV_ROOTDIR . '/modules/' . $module_file . '/storehouse.class.php';
$permission = new NukeViet\StoreHouse\StoreHouse;
$admin_permission = $permission->checkpermission($admin_info['userid']);
$groups = $permission->check_user_group($admin_info['userid']);
require_once NV_ROOTDIR . '/modules/' . $module_file . '/site.functions.php';
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
$allow_func = array();
/* if($groups ==0  && $op != 'permissions' ||  defined("NV_IS_GODADMIN")){
	$allow_func[] = 'permissions';
	$allow_func[] = 'permissions_groups';
	$allow_func[] = 'getuserid';
	nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=permissions' );
} */

if($admin_permission->main->main_index == '1'){
	$allow_func[] = 'main';
}

if($admin_permission->other->ajax == '1'){
	$allow_func[] = 'ajax';
}

if($admin_permission->config->config_index == '1'){
	
	
	$allow_func[] = 'config';
	if(IDSITE>0){
		if(IDSITE > 0  || defined('NV_IS_GODADMIN') || $groups == 1){
			$allow_func[] = 'price_groups';
			$allow_func[] = 'topicajax';
			$allow_func[] = 'settings';
		}
	}else{
		if($_SESSION[$module_data . '_store_id'] > 0  || defined('NV_IS_GODADMIN') || $groups == 1){
			$allow_func[] = 'price_groups';
			$allow_func[] = 'topicajax';
			$allow_func[] = 'settings';
		}
	}
	
	
}
if( defined('NV_IS_GODADMIN') || $groups == 1){
	
	$allow_func[] = 'store';
	$allow_func[] = 'users';
	$allow_func[] = 'users_add';
	$allow_func[] = 'users_edit';
}
	
if((defined('NV_IS_GODADMIN') || $groups == 1) && IDSITE == 0)
	$allow_func[] = 'stores';
if($admin_permission->customers->customers_index == '1'){
	if($admin_permission->customers->customers_add == '1' or $admin_permission->customers->customers_edit == '1'){
		$allow_func[] = 'customers';
		$allow_func[] = 'project';
		$allow_func[] = 'project_history';
		$allow_func[] = 'project_history_detail';
	}
	$allow_func[] = 'customers_list';
}
if($admin_permission->suppliers->suppliers_index == '1'){
	$allow_func[] = 'supply';
	$allow_func[] = 'supply_list';
}
if($admin_permission->products->products_index == '1' && IDSITE == 0){
	$allow_func[] = 'products';
	$allow_func[] = 'products_list';
	$allow_func[] = 'products_detail';
	$allow_func[] = 'products_print';
}
if($admin_permission->warehouse->warehouse_index == '1'){
	$allow_func[] = 'warehouses';
}
if($admin_permission->purchases->purchases_index == '1' || IDSITE>0 || $groups == 1){
	$allow_func[] = 'purchases_list';
	$allow_func[] = 'purchases_subsite';
	$allow_func[] = 'purchases_subsite_view';
	$allow_func[] = 'purchases_print';
	$allow_func[] = 'purchases';
}
//print_r($groups);die;	
if($admin_permission->reports->reports_index == '1' || IDSITE>0){	
	$allow_func[] = 'reports';
	if($admin_permission->reports->reports_products == '1'){
		$allow_func[] = 'reports_products';
	}
	if($admin_permission->reports->reports_warehouse_stock == '1'){
		$allow_func[] = 'reports_warehouse_stock';
	}
	if($admin_permission->reports->reports_best_sellers == '1'){
		$allow_func[] = 'reports_best_sellers';
	}
	if($admin_permission->reports->reports_quantity_alerts == '1'){
		$allow_func[] = 'reports_quantity_alerts';
	}
	if($admin_permission->reports->reports_expiry_alerts == '1'){
		$allow_func[] = 'reports_expiry_alerts';
	}
	if($admin_permission->reports->reports_daily_sales == '1'){
		$allow_func[] = 'reports_daily_sales';
	}
	if($admin_permission->reports->reports_monthly_sales == '1'){
		$allow_func[] = 'reports_monthly_sales';
	}
	if($admin_permission->reports->reports_sales == '1'){
		$allow_func[] = 'reports_sales';
	}
	if($admin_permission->reports->reports_payments == '1'){
		$allow_func[] = 'reports_payments';
	}
	if($admin_permission->reports->reports_profit_loss == '1'){
		$allow_func[] = 'reports_profit_loss';
	}
	if($admin_permission->reports->reports_purchases == '1'){
		$allow_func[] = 'reports_purchases';
	}
	if($admin_permission->reports->reports_customers == '1'){
		$allow_func[] = 'reports_customers';
		$allow_func[] = 'reports_customers_view';
	}
	if($admin_permission->reports->reports_suppliers == '1'){
		$allow_func[] = 'reports_suppliers';
		$allow_func[] = 'reports_suppliers_view';
	}
	if($admin_permission->reports->reports_staff == '1'){
		$allow_func[] = 'reports_staff';
	}
}
if($admin_permission->sales->sales_index == '1' || IDSITE>0 || $groups == 1){
	if(IDSITE>0){
		if(IDSITE > 0 OR defined('NV_IS_GODADMIN')  || $groups == 1){
				$allow_func[] = 'sales_list';
				$allow_func[] = 'export';
				$allow_func[] = 'production_schedule';
				$allow_func[] = 'vehicle';
				$allow_func[] = 'project_history_detail';
				$allow_func[] = 'sales_print';
		}
	}else{
		if($_SESSION[$module_data . '_store_id'] > 0  OR defined('NV_IS_GODADMIN')  || $groups == 1){
				$allow_func[] = 'sales_list';
				$allow_func[] = 'export';
				$allow_func[] = 'production_schedule';
				$allow_func[] = 'project_history_detail';
				$allow_func[] = 'vehicle';
				$allow_func[] = 'sales_print';
		}
	}
	
}
if($admin_permission->pos->pos_index == '1' AND $admin_permission->sales->sales_index == '1' || IDSITE>0 ){
	if(IDSITE>0){
		if(IDSITE > 0 OR defined('NV_IS_GODADMIN') || $groups == 1){	
				$allow_func[] = 'pos';
				$allow_func[] = 'pos_view';
				$allow_func[] = 'pos_edit';
		}
	}else{
		if($_SESSION[$module_data . '_store_id'] > 0 OR defined('NV_IS_GODADMIN') || $groups == 1){	
				$allow_func[] = 'pos';
				$allow_func[] = 'pos_view';
				$allow_func[] = 'pos_edit';
		}
	}
}
if($admin_permission->transfers->transfers_index == '1' || $groups == 1 ){
	if(IDSITE>0){
		if(IDSITE > 0  OR defined('NV_IS_GODADMIN') || $groups == 1){
				$allow_func[] = 'transfer';
				$allow_func[] = 'transfer_list';
		}
	}else{
		if($_SESSION[$module_data . '_store_id'] > 0 OR defined('NV_IS_GODADMIN') || $groups == 1){
				$allow_func[] = 'transfer';
				$allow_func[] = 'transfer_list';
		}
	}
}
if($admin_permission->permission->permission_index == '1'){
	$allow_func[] = 'permissions';
	$allow_func[] = 'permissions_groups';
	$allow_func[] = 'getuserid';
}
if(defined('NV_IS_GODADMIN') || $groups == 1){
	$allow_func[] = 'api_credentials';
	$allow_func[] = 'api_roles';
}
if( $groups == 1){
	$allow_func[] = 'companies_groups';
}
// $CI = new NukeViet\StoreHouse\Main;
 // $CI->index();
 
 /**
 * nv_groups_add_user()
 *
 * @param int $group_id
 * @param int $userid
 * @return
 */
function nv_permission_groups_add_user($group_id, $userid, $approved = 1, $mod_data = 'users')
{
    global $db, $db_config, $global_config;
    $_mod_table =  $db_config['prefix'] . '_' . $mod_data;
    $query = $db->query('SELECT COUNT(*) FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $userid);
    if ($query->fetchColumn()) {
        try {
            $db->query("INSERT INTO " . $_mod_table . "_groups_user (group_id, userid, approved, data) VALUES (" . $group_id . ", " . $userid . ", " . $approved . ", '" . $global_config['idsite'] . "')");
            $db->query('UPDATE ' . $_mod_table . '_groups SET numbers = numbers+1 WHERE id=' . $group_id);
            return true;
        } catch (PDOException $e) {
            if ($group_id <= 1) {
                $data = $db->query('SELECT data FROM ' . $_mod_table . '_groups_user WHERE group_id=' . $group_id . ' AND userid=' . $userid)->fetchColumn();
                $data = ($data != '') ? explode(',', $data) : array();
                $data[] = $global_config['idsite'];
                $data = implode(',', array_unique(array_map('intval', $data)));
                $db->query("UPDATE " . $_mod_table . "_groups_user SET data = '" . $data . "' WHERE group_id=" . $group_id . " AND userid=" . $userid);
                return true;
            }
        }
    }
    return false;
}

function nv_get_api_actions()
{
    global $lang_module,$lang_global, $sys_mods, $module_file, $module_name;

    $array_apis = [];
    $array_keys = $array_cats = $array_apis;

    
    // Lấy các API
    $files=nv_scandir(NV_ROOTDIR . '/vendor/vinades/nukeviet/StoreHouse/Api', '/^([A-Za-z0-9]+)\.php$/');
    //$files[] = "Product.php";
    foreach ($files as $file) {
        if (preg_match('/^([^0-9]+[a-z0-9\_]{0,})\.php$/', $file, $m)) {
            $class_name = $m[1];
            $class_namespaces = 'NukeViet\\StoreHouse\\Api\\' . $class_name;
            if (nv_class_exists($class_namespaces)) {
                $class_cat = $class_namespaces::getCat();
                $cat_title = $class_cat ? $lang_module['api_' . $class_cat] : '';
                $api_title = $class_cat ? $lang_module['api_' . $class_cat . '_' . $class_name] : $lang_module['api_' . $class_name];

                // Xác định key
                if (!isset($array_keys[$module_name])) {
                    $array_keys[$module_name] = [];
                }
                $array_keys[$module_name][$class_name] = $class_name;

                // Xác định cây thư mục
                if (!isset($array_apis[$module_name])) {
                    $array_apis[$module_name] = [];
                }
                if (!isset($array_apis[$module_name][$class_cat])) {
                    $array_apis[$module_name][$class_cat] = [
                        'title' => $cat_title,
                        'apis' => []
                    ];
                }
                $array_apis[$module_name][$class_cat]['apis'][$class_name] = [
                    'title' => $api_title,
                    'cmd' => $class_name
                ];

                // Phân theo cat
                if (!isset($array_cats[$module_name])) {
                    $array_cats[$module_name] = [];
                }
                $array_cats[$module_name][$class_name] = [
                    'key' => $class_cat,
                    'title' => $cat_title,
                    'api_title' => $api_title
                ];
            }
        }
    }


    return [$array_apis, $array_keys, $array_cats];
}


function nv_fix_store_order($parentid = 0, $order = 0, $lev = 0)
{
    global $db, $db_config, $module_data;

    $sql = 'SELECT store_id, parentid FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores WHERE parentid=' . $parentid . ' ORDER BY weight ASC';
    $result = $db->query($sql);
    $array_store_order = array();
    while ($row = $result->fetch()) {
        $array_store_order[] = $row['store_id'];
    }
    $result->closeCursor();
    $weight = 0;

    if ($parentid > 0) {
        ++$lev;
    } else {
        $lev = 0;
    }

    foreach ($array_store_order as $storeid_i) {
        ++$order;
        ++$weight;
        $sql = 'UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores SET weight=' . $weight . ', sort_order=' . $order . ', lev=' . $lev . ' WHERE store_id=' . $storeid_i;
        $db->query($sql);
        $order = nv_fix_store_order($storeid_i, $order, $lev);
    }

    $numsubstore = $weight;
    if ($parentid > 0) {
        
        $sql = 'UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores SET numstore=' . $numsubstore;
        if ($numsubstore == 0 ) {
            $sql .= ", substoreid=''";
        } else {
            $sql .= ", substoreid='" . implode(",", $array_store_order) . "'";
        }
        $sql .= ' WHERE store_id=' . $parentid;
        $db->query($sql);
    }
    return $order;
}
function nv_storehouse_groups_del_user($group_id, $userid, $mod_data = 'users')
{
    global $db, $db_config, $global_config;
    $_mod_table = ($mod_data == 'users') ? NV_USERS_GLOBALTABLE : $db_config['prefix'] . '_' . $mod_data;
    $row = $db->query('SELECT data FROM ' . $_mod_table . '_groups_user WHERE group_id=' . $group_id . ' AND userid=' . $userid)->fetch();
    if (!empty($row)) {
        $set_number = false;
        if ($group_id > 3) {
            $set_number = true;
        } else {
            $data = str_replace(',' . $global_config['idsite'] . ',', '', ',' . $row['data'] . ',');
            $data = trim($data, ',');
            if ($data == '') {
                $set_number = true;
            } else {
                $db->query("UPDATE " . $_mod_table . "_groups_user SET data = '" . $data . "' WHERE group_id=" . $group_id . " AND userid=" . $userid);
            }
        }
        if ($set_number) {
            $db->query('DELETE FROM ' . $_mod_table . '_groups_user WHERE group_id = ' . $group_id . ' AND userid = ' . $userid);
            // Chỗ này chỉ xóa những thành viên đã được xét duyệt vào nhóm nên sẽ cập nhật luôn số thành viên, không cần kiểm tra approved = 1 hay không
            $db->query('UPDATE ' . $_mod_table . '_groups SET numbers = numbers-1 WHERE id=' . $group_id);
        }
        return true;
    } else {
        return false;
    }
}