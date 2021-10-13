<?php

$array_site=array();
$array_site[] = $global_config['idsite'];
if($global_config['idsite']>0){
	$site_parent = $db_slave->query('SELECT siteus FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_site WHERE idsite = ' . $global_config['idsite'])->fetch(5)->siteus;
	$array_site[] = $site_parent;
}else{
	$site_parent = 0;
}

$array_category_id_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_categories';
$_query = $db_slave->query($_sql);
while ($_row = $_query->fetch()) {
    $array_category_id_storehouse[$_row['id']] = $_row;
}
$array_secondcategory_id_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_subcategories';
$_query = $db_slave->query($_sql);
while ($_row = $_query->fetch()) {
    $array_secondcategory_id_storehouse[$_row['id']] = $_row;
}


$array_store_storehouse = array();
$_sql = 'SELECT s.*  FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores s ORDER BY s.sort_order ASC';

$_query = $db_slave->query($_sql);
while ($_row = $_query->fetch()) {
    $array_store_storehouse[$_row['store_id']] = $_row;
}
$array_store_storehouse_user=array();

foreach ($array_store_storehouse as $store_id => $store) {
	if($store['userid'] == $admin_info['admin_id'] && $store['parentid'] ==0){
		$array_store_storehouse_user[$store_id]=$store;
	}
}


$array_supplier_id_storehouse = array();

$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies WHERE group_id = 2 AND idsite IN (' . implode(',',$array_site) . ') ';

$_query = $db_slave->query($_sql);
while ($_row = $_query->fetch()) {
    $array_supplier_id_storehouse[$_row['id']] = $_row;
}
//print_r($array_supplier_id_storehouse);
$array_customer_id_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies WHERE group_id = 1';
$_query = $db_slave->query($_sql);
while ($_row = $_query->fetch()) {
    $array_customer_id_storehouse[$_row['id']] = $_row;
}

//$array_customer_id_storehouse  = $array_supplier_id_storehouse;

$array_warehouse_id_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_warehouses';
$_query  = $db_slave->query($_sql);
$array_warehouses_storehouse = array();
$array_warehouses_storehouse[0] = array('id' => '0', 'name' => $lang_module['systems_warehouse']);
while ($_row = $_query->fetch()) {
    $array_warehouses_storehouse[$_row['id']] = $_row;
}
//$array_warehouse_id_storehouse = $array_warehouses_storehouse;
$list_warehouse_of_store=array();
if(IDSITE > 0){
	$list_sub_store=array();
	foreach ($array_store_storehouse as $store_id => $store) {
		if($store['parentid'] == IDSITE){
			$list_sub_store[]=$store_id;
		}
	}
	
	while ($_row = $_query->fetch()) {
	    $array_warehouses_storehouse[$_row['id']] = $_row;
		if(count($list_sub_store)==1 && in_array($_row['store_id'], $list_sub_store)){
			$list_warehouse_of_store[] = $_row['id'];
		}   	
	}
}else{
	$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_warehouses';
	$_query  = $db_slave->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_warehouse_id_storehouse[$_row['id']] = $_row;
		if(defined("NV_IS_GODADMIN") && $_SESSION[$module_data . '_store_id'] == 0){
			$list_warehouse_of_store[] = $_row['id'];
		}elseif($_row['store_id'] == $_SESSION[$module_data . '_store_id']){
			$list_warehouse_of_store[] = $_row['id'];
		}elseif(count($array_store_storehouse)>1 && $_SESSION[$module_data . '_store_id'] == 0){
			foreach($array_store_storehouse as $store){
				if($_row['store_id'] == $store['store_id']){
					$list_warehouse_of_store[] = $_row['id'];
				}
			}
		}
	    	
	}
	//print_r($list_warehouse_of_store);die;
}



$array_purchase_id_storehouse = array();
$_sql = 'SELECT id,name FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_products';
$_query = $db_slave->query($_sql);
while ($_row = $_query->fetch()) {
    $array_purchase_id_storehouse[$_row['id']] = $_row;
}

