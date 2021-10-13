<?php 

$array_tax_rate_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_tax_rates';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_tax_rate_storehouse[$_row['id']] = $_row;
}
$array_customer= array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies WHERE group_id IN (1,3)';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_customer[$_row['id']] = $_row;
}
$array_tax_method = array();
$array_tax_method[0] = $lang_module['tax_mode_0'];
$array_tax_method[1] = $lang_module['tax_mode_1'];

$array_barcode = array();
$array_barcode[1] = $lang_module['barcode_25'];
$array_barcode[2] = $lang_module['barcode_39'];
$array_barcode[3] = $lang_module['barcode_128'];

$array_type = array();
$array_type["material"] = $lang_module['material'];
$array_type["standard"] = $lang_module['standard'];
/*
$array_type["combo"] = $lang_module['combo'];
$array_type["digital"] = $lang_module['digital'];
$array_type["service"] = $lang_module['service'];*/


$array_brand_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_brands';
$result_brand = $db_slave->query($_sql);
while ($_row = $result_brand->fetch()) {
    $array_brand_storehouse[$_row['id']] = $_row;
}

$array_unit_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . NV_TABLE_SHOPS . '_units ';
$result_unit = $db_slave->query($_sql);
if ($result_unit->rowCount() != 0) {
	while ($_row = $result_unit->fetch()) {
		$array_unit_storehouse[$_row['id']] = $_row;
	}
}
$array_price_group_id_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_price_groups';
$_query = $db_slave->query($_sql);
while ($_row = $_query->fetch()) {
    $array_price_group_id_storehouse[$_row['id']] = $_row;
} 
$list_warehouse_of_store = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_warehouses WHERE  whidsite = ' . $global_config['idsite'];
$list_warehouse_of_store = $db_slave->query($_sql)->fetchAll(5);
if(MULTICOMPANY==0){
	if(IDSITE>0){
		$stores_id = reset($array_store_storehouse_user);
		//print_r($stores_id);die;
		$parentid = '';
		$array_category_of_store=array();
		if(!empty($array_store_storehouse[IDSITE]['category_id'])){
			$where ='WHERE  category_id IN (' . $array_store_storehouse[IDSITE]['category_id'] . ')';
			$array_category_of_store_tmp = $second_of_cat = $db->query('SELECT secondcat_id FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_cat_of_secondcategory ' . $where )->fetchall();
			foreach ($array_category_of_store_tmp as $key => $value) {
				$array_category_of_store[]= $value['secondcat_id'];
			}
		}
		
	}else{
		/* $stores_id = reset($array_store_storehouse_user);
		if(count($array_store_storehouse_user > 0) && $_SESSION[$module_data . '_store_id'] == 0)
			$_SESSION[$module_data . '_store_id'] = $stores_id['store_id'];
		if ($_SESSION[$module_data . '_store_id']== '') {
			$_SESSION[$module_data . '_store_id'] = 0;
		
		}
		$parentid = $_SESSION[$module_data . '_store_id'];
		if(count($array_store_storehouse_user) > 1 ){
			foreach ($array_store_storehouse_user as $stores_id => $stores) {
				foreach ($array_store_storehouse as $store_id => $store) {
					if ($store['store_id'] == $_SESSION[$module_data . '_store_id'] && $store['parentid'] ==$stores_id){
						$parentid = $store['parentid'];
					}
				}
			}
		}elseif($_SESSION[$module_data . '_store_id']>0 && defined('NV_IS_GODADMIN') || $_SESSION[$module_data . '_store_id']>0 && $groups == 1){
			foreach ($array_store_storehouse as $store_id => $store) {
				if ($store['store_id'] == $_SESSION[$module_data . '_store_id'] && $store['parentid'] != 0){
					$parentid = $store['parentid'];
				}
			}
			
		}
		 if($parentid >0 )
			$array_category_parent=explode(",",$array_store_storehouse[$parentid]['category_id']); 
		elseif(($_SESSION[$module_data . '_store_id'] > 0 && (defined('NV_IS_GODADMIN') || defined('NV_IS_SPADMIN') || $_SESSION[$module_data . '_store_id'] > 0 && $groups == 1)))
		{
			//$array_category_parent=array();
			if($_SESSION[$module_data . '_store_id'] == $parentid)
				$array_category_parent=explode(",",$array_store_storehouse[$_SESSION[$module_data . '_store_id']]['category_id']);
			else
				$array_category_parent=explode(",",$array_store_storehouse[$parentid]['category_id']);
		}elseif($row['store_id'] == 0 && count($array_store_storehouse_user) > 1)
		{
			$array_category_parent=array();
		}elseif($row['store_id'] == 0 )
		{
			$array_category_parent=array();
			foreach($array_category_id_storehouse as $catid => $cat){
				$array_category_parent[] = $catid;
			}
			
		}
		if($_SESSION[$module_data . '_store_id'] > 0){
			$cat_of_product = array();
			$category=explode(",",$array_store_storehouse[$_SESSION[$module_data . '_store_id']]['category_id']);
			foreach($array_category_parent as $cat_id){
				if(in_array($cat_id, $category))
					$cat_of_product[]=$cat_id;
			}
			$array_category_of_store=array();
			if(!empty($_SESSION[$module_data . '_store_id']) && !empty($array_store_storehouse[$_SESSION[$module_data . '_store_id']]['category_id']))
				$array_category_of_store_tmp = $second_of_cat = $db->query('SELECT secondcat_id FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_cat_of_secondcategory WHERE  category_id IN (' . $array_store_storehouse[$_SESSION[$module_data . '_store_id']]['category_id'] . ')')->fetchall();
			else{
				$array_category_of_store_tmp = $second_of_cat = array();
			}
			foreach ($array_category_of_store_tmp as $key => $value) {
				$array_category_of_store[]= $value['secondcat_id'];
			}
		}
 */

			
	}
	if(empty($array_category_of_store)){
		$array_category_of_store = array(0);
	}
	$store_setting = new NukeViet\StoreHouse\Myclass;
	$store_setting->product_prefix = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . NV_CONFIG_GLOBALTABLE . ' WHERE config_name="product_prefix" && module = "storehouse" && lang ="sys"')->fetch(5)->config_value;


	$option_store = '';
	


	$submenu_reports =array();
	$submenu_reports['reports_products'] = $lang_module['reports_products'];
	$submenu_reports['reports_warehouse_stock'] = $lang_module['reports_warehouse_stock'];
	$submenu_reports['reports_best_sellers'] = $lang_module['reports_best_sellers'];
	$submenu_reports['reports_quantity_alerts'] = $lang_module['reports_quantity_alerts'];
	//$submenu_reports['reports_expiry_alerts'] = $lang_module['reports_expiry_alerts'];
	$submenu_reports['reports_daily_sales'] = $lang_module['reports_daily_sales'];
	$submenu_reports['reports_monthly_sales'] = $lang_module['reports_monthly_sales'];
	$submenu_reports['reports_sales'] = $lang_module['reports_sales'];
	//$submenu_reports['reports_payments'] = $lang_module['reports_payments'];
	$submenu_reports['reports_profit_loss'] = $lang_module['reports_profit_loss'];
	$submenu_reports['reports_purchases'] = $lang_module['reports_purchases'];
	$submenu_reports['reports_customers'] = $lang_module['reports_customers'];
	$submenu_reports['reports_suppliers'] = $lang_module['reports_suppliers'];
	$submenu_reports['reports_staff_report'] = $lang_module['reports_staff_report'];

	$submenu['reports'] = array('title'=>$lang_module['reports'], 'submenu' => $submenu_reports);
	$submenu_customers =array();
	$submenu_customers['customers'] = $lang_module['customers'];
	$submenu_customers['companies_groups'] = $lang_module['companies_groups'];
	$submenu_production_schedule['project'] = $lang_module['project_add'];
	$submenu['production_schedule'] = array('title'=>$lang_module['production_schedule'], 'submenu' => $submenu_production_schedule);
	$submenu['project_history'] = $lang_module['project_history'];
	$submenu_vehicle =array();
	$submenu['vehicle'] = array('title'=>$lang_module['vehicle'], 'submenu' => $submenu_vehicle);

	/* if(IDSITE>0){ */
		//print_r($array_store_storehouse);die;
		/* if( defined('NV_IS_GODADMIN') || $groups == 1){
			//die;
			if( $groups == 1){ */
				$submenu_purchases=array();
				$submenu_purchases['purchases'] = $lang_module['purchases'];
				$submenu['purchases_list'] = array('title'=>$lang_module['purchases_list'], 'submenu' => $submenu_purchases);
				$submenu_export=array();
				$submenu_export['export'] = $lang_module['export'];
				$submenu_export['transfer_list'] = $lang_module['transfer_list'];
				$submenu_export['pos'] = $lang_module['pos'];
				$submenu_export['purchases_subsite'] = $lang_module['purchases_subsite'];
				$submenu['sales_list'] = array('title'=>$lang_module['sales_list'], 'submenu' => $submenu_export);
				/*
				$submenu_transfer=array();
							$submenu_transfer['transfer'] = $lang_module['transfer'];
							$submenu['transfer_list'] = array('title'=>$lang_module['transfer_list'], 'submenu' => $submenu_transfer);*/
				
		/* 	}	
			
		} */
	/* }else{
		if($_SESSION[$module_data . '_store_id'] > 0 && $array_store_storehouse[$_SESSION[$module_data . '_store_id']]['parentid'] !=0 OR defined('NV_IS_GODADMIN') || $groups == 1){
			
			if($parentid != $_SESSION[$module_data . '_store_id'] && $_SESSION[$module_data . '_store_id'] > 0 || $groups == 1){
				
				$submenu_purchases=array();
				$submenu_purchases['purchases'] = $lang_module['purchases'];
				$submenu['purchases_list'] = array('title'=>$lang_module['purchases_list'], 'submenu' => $submenu_purchases);
				$submenu_export=array();
				$submenu_export['export'] = $lang_module['export'];
				$submenu_export['pos'] = $lang_module['pos'];
				$submenu['sales_list'] = array('title'=>$lang_module['sales_list'], 'submenu' => $submenu_export);
	
				$submenu_transfer=array();
				$submenu_transfer['transfer'] = $lang_module['transfer'];
				$submenu['transfer_list'] = array('title'=>$lang_module['transfer_list'], 'submenu' => $submenu_transfer);
				

				$submenu_products =array();

				$submenu_products['products'] = $lang_module['products']; 
				$submenu['products_list'] = array('title'=>$lang_module['products_list'], 'submenu' => $submenu_products);
			}	
			
		}
	} */

	if(defined('NV_IS_GODADMIN') OR defined('NV_IS_SPADMIN') || $groups == 1){
		$submenu_supply =array();
		$submenu_supply['supply'] = $lang_module['supply'];
		$submenu['supply_list'] = array('title'=>$lang_module['supply_list'], 'submenu' => $submenu_supply);

	}
	$submenu['customers_list'] = array('title'=>$lang_module['customers_list'], 'submenu' => $submenu_customers);


	$submenu_config =array();
	if(defined('NV_IS_GODADMIN') OR defined('NV_IS_SPADMIN') || $groups == 1){
		//$submenu_config['settings'] = $lang_module['settings'];
		/* $submenu_config['units'] = $lang_module['units']; */
		//$submenu_config['warehouses'] = $lang_module['warehouses'];
		$submenu_config['price_groups'] = $lang_module['price_groups'];
	/* 	$submenu_config['currencies'] = $lang_module['currencies'];
		$submenu_config['categories'] = $lang_module['categories'];
		$submenu_config['subcategories'] = $lang_module['subcategories'];
		$submenu_config['stores'] = $lang_module['stores']; */
		$submenu_config['api_credentials'] = $lang_module['api_cr'];
		$submenu_config['api_roles'] = $lang_module['api_roles'];
	}elseif(defined('NV_IS_ADMIN')){
		//$submenu_config['settings'] = $lang_module['settings'];
		if($_SESSION[$module_data . '_store_id'] > 0 &&  $array_store_storehouse[$_SESSION[$module_data . '_store_id']]['parentid'] !=0){
			$submenu_config['units'] = $lang_module['units'];
			
			$submenu_config['price_groups'] = $lang_module['price_groups'];
			$submenu_config['currencies'] = $lang_module['currencies'];
			
			//$submenu_config['subcategories'] = $lang_module['subcategories'];
		}
	}

	$submenu_store =array();
	if((defined('NV_IS_GODADMIN') || $groups == 1) && IDSITE == 0){
		$submenu_store['stores'] = $lang_module['stores'];
	}
	$submenu_store['warehouses'] = $lang_module['warehouses'];
	$submenu_store['users'] = $lang_module['users'];
	$submenu_store['users_add'] = $lang_module['user_add'];

	$submenu['store'] = array('title'=>$lang_module['store'], 'submenu' => $submenu_store);



	$submenu_permissions =array();
	if(defined('NV_IS_GODADMIN') || $groups == 1){
		$submenu_permissions['permissions_groups'] = $lang_module['permissions_groups'];
		//$submenu_permissions['permissions_users'] = $lang_module['permissions_users'];
		$submenu['permissions'] = array('title'=>$lang_module['permissions'], 'submenu' => $submenu_permissions);
	}
	$submenu['config'] = array('title'=>$lang_module['config'], 'submenu' => $submenu_config);
}