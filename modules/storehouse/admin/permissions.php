<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 04 Sep 2018 05:42:08 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!'); 

//die("oks");
 NV_ROOTDIR . '/modules/' . $module_file . '/global.catalogy.php';
require NV_ROOTDIR . '/modules/' . $module_file . '/global.datadefault.php';
if($admin_permission->permission->permission_index == '1' || defined("NV_IS_GODADMIN")){
	if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
	    $id = $nv_Request->get_int('delete_id', 'get');
	    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
	    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
	        $db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_permissions  WHERE id = ' . $db->quote($id));
	        $nv_Cache->delMod($module_name);
	        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Permissions', 'ID: ' . $id, $admin_info['userid']);
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }
	}
	 
	$row = array();
	$error = array();
	$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
	if ($nv_Request->isset_request('submit', 'post')) {
		
	    $row['group_id'] = $nv_Request->get_int('group_id', 'post', 0);
	    $row['products_index'] = $nv_Request->get_int('products_index', 'post', 0);
	    $row['products_add'] = $nv_Request->get_int('products_add', 'post', 0);
	    $row['products_edit'] = $nv_Request->get_int('products_edit', 'post', 0);
	    $row['products_delete'] = $nv_Request->get_int('products_delete', 'post', 0);
	    $row['products_cost'] = $nv_Request->get_int('products_cost', 'post', 0);
	    $row['products_price'] = $nv_Request->get_int('products_price', 'post', 0);
	    $row['quotes_index'] = $nv_Request->get_int('quotes_index', 'post', 0);
	    $row['quotes_add'] = $nv_Request->get_int('quotes_add', 'post', 0);
	    $row['quotes_edit'] = $nv_Request->get_int('quotes_edit', 'post', 0);
	    $row['quotes_pdf'] = $nv_Request->get_int('quotes_pdf', 'post', 0);
	    $row['quotes_email'] = $nv_Request->get_int('quotes_email', 'post', 0);
	    $row['quotes_delete'] = $nv_Request->get_int('quotes_delete', 'post', 0);
	    $row['sales_index'] = $nv_Request->get_int('sales_index', 'post', 0);
	    $row['sales_add'] = $nv_Request->get_int('sales_add', 'post', 0);
	    $row['sales_edit'] = $nv_Request->get_int('sales_edit', 'post', 0);
	    $row['sales_pdf'] = $nv_Request->get_int('sales_pdf', 'post', 0);
	    $row['sales_email'] = $nv_Request->get_int('sales_email', 'post', 0);
	    $row['sales_delete'] = $nv_Request->get_int('sales_delete', 'post', 0);
	    $row['purchases_index'] = $nv_Request->get_int('purchases_index', 'post', 0);
	    $row['purchases_add'] = $nv_Request->get_int('purchases_add', 'post', 0);
	    $row['purchases_edit'] = $nv_Request->get_int('purchases_edit', 'post', 0);
	    $row['purchases_pdf'] = $nv_Request->get_int('purchases_pdf', 'post', 0);
	    $row['purchases_email'] = $nv_Request->get_int('purchases_email', 'post', 0);
	    $row['purchases_delete'] = $nv_Request->get_int('purchases_delete', 'post', 0);
	    $row['transfers_index'] = $nv_Request->get_int('transfers_index', 'post', 0);
	    $row['transfers_add'] = $nv_Request->get_int('transfers_add', 'post', 0);
	    $row['transfers_edit'] = $nv_Request->get_int('transfers_edit', 'post', 0);
	    $row['transfers_pdf'] = $nv_Request->get_int('transfers_pdf', 'post', 0);
	    $row['transfers_email'] = $nv_Request->get_int('transfers_email', 'post', 0);
	    $row['transfers_delete'] = $nv_Request->get_int('transfers_delete', 'post', 0);
	    $row['customers_index'] = $nv_Request->get_int('customers_index', 'post', 0);
	    $row['customers_add'] = $nv_Request->get_int('customers_add', 'post', 0);
	    $row['customers_edit'] = $nv_Request->get_int('customers_edit', 'post', 0);
	    $row['customers_delete'] = $nv_Request->get_int('customers_delete', 'post', 0);
	    $row['suppliers_index'] = $nv_Request->get_int('suppliers_index', 'post', 0);
	    $row['suppliers_add'] = $nv_Request->get_int('suppliers_add', 'post', 0);
	    $row['suppliers_edit'] = $nv_Request->get_int('suppliers_edit', 'post', 0);
	    $row['suppliers_delete'] = $nv_Request->get_int('suppliers_delete', 'post', 0);
	    $row['sales_deliveries'] = $nv_Request->get_int('sales_deliveries', 'post', 0);
	    $row['sales_add_delivery'] = $nv_Request->get_int('sales_add_delivery', 'post', 0);
	    $row['sales_edit_delivery'] = $nv_Request->get_int('sales_edit_delivery', 'post', 0);
	    $row['sales_delete_delivery'] = $nv_Request->get_int('sales_delete_delivery', 'post', 0);
	    $row['sales_email_delivery'] = $nv_Request->get_int('sales_email_delivery', 'post', 0);
	    $row['sales_pdf_delivery'] = $nv_Request->get_int('sales_pdf_delivery', 'post', 0);
	    $row['sales_return_sales '] = $nv_Request->get_int('sales_return_sales ', 'post', 0);
	    $row['sales_return_sales '] = $nv_Request->get_int('sales_return_sales ', 'post', 0);
	    $row['gift_index'] = $nv_Request->get_int('gift_index', 'post', 0);
	    $row['gift_add'] = $nv_Request->get_int('gift_add', 'post', 0);
	    $row['gift_edit'] = $nv_Request->get_int('gift_edit', 'post', 0);
	    $row['gift_delete'] = $nv_Request->get_int('gift_delete', 'post', 0);
	    $row['pos_index'] = $nv_Request->get_int('pos_index', 'post', 0);
	    $row['sales_return_sales'] = $nv_Request->get_int('sales_return_sales', 'post', 0);
	    $row['reports_index'] = $nv_Request->get_int('reports_index', 'post', 0);
	    $row['reports_warehouse_stock'] = $nv_Request->get_int('reports_warehouse_stock', 'post', 0);
	    $row['reports_best_sellers'] = $nv_Request->get_int('reports_best_sellers', 'post', 0);
	    $row['reports_quantity_alerts'] = $nv_Request->get_int('reports_quantity_alerts', 'post', 0);
	    $row['reports_expiry_alerts'] = $nv_Request->get_int('reports_expiry_alerts', 'post', 0);
	    $row['reports_products'] = $nv_Request->get_int('reports_products', 'post', 0);
	    $row['reports_daily_sales'] = $nv_Request->get_int('reports_daily_sales', 'post', 0);
	    $row['reports_monthly_sales'] = $nv_Request->get_int('reports_monthly_sales', 'post', 0);
	    $row['reports_sales'] = $nv_Request->get_int('reports_sales', 'post', 0);
	    $row['reports_payments'] = $nv_Request->get_int('reports_payments', 'post', 0);
	    $row['reports_purchases'] = $nv_Request->get_int('reports_purchases', 'post', 0);
	    $row['reports_profit_loss'] = $nv_Request->get_int('reports_profit_loss', 'post', 0);
	    $row['reports_customers'] = $nv_Request->get_int('reports_customers', 'post', 0);
	    $row['reports_suppliers'] = $nv_Request->get_int('reports_suppliers', 'post', 0);
	    $row['reports_staff'] = $nv_Request->get_int('reports_staff', 'post', 0);
	    $row['reports_register'] = $nv_Request->get_int('reports_register', 'post', 0);
	    $row['sales_payments'] = $nv_Request->get_int('sales_payments', 'post', 0);
	    $row['purchases_payments'] = $nv_Request->get_int('purchases_payments', 'post', 0);
	    $row['purchases_expenses'] = $nv_Request->get_int('purchases_expenses', 'post', 0);
	    $row['products_adjustments'] = $nv_Request->get_int('products_adjustments', 'post', 0);
	    $row['bulk_actions'] = $nv_Request->get_int('bulk_actions', 'post', 0);
	    $row['customers_deposits'] = $nv_Request->get_int('customers_deposits', 'post', 0);
	    $row['customers_delete_deposit'] = $nv_Request->get_int('customers_delete_deposit', 'post', 0);
	    $row['products_barcode'] = $nv_Request->get_int('products_barcode', 'post', 0);
	    $row['purchases_return_purchases'] = $nv_Request->get_int('purchases_return_purchases', 'post', 0);
	    $row['reports_expenses'] = $nv_Request->get_int('reports_expenses', 'post', 0);
	    $row['reports_daily_purchases'] = $nv_Request->get_int('reports_daily_purchases', 'post', 0);
	    $row['reports_monthly_purchases'] = $nv_Request->get_int('reports_monthly_purchases', 'post', 0);
	    $row['products_stock_count'] = $nv_Request->get_int('products_stock_count', 'post', 0);
	    $row['edit_price'] = $nv_Request->get_int('edit_price', 'post', 0);
	    $row['returns_index'] = $nv_Request->get_int('returns_index', 'post', 0);
	    $row['returns_add'] = $nv_Request->get_int('returns_add', 'post', 0);
	    $row['returns_edit'] = $nv_Request->get_int('returns_edit', 'post', 0);
	    $row['returns_delete'] = $nv_Request->get_int('returns_delete', 'post', 0);
	    $row['returns_email'] = $nv_Request->get_int('returns_email', 'post', 0);
	    $row['returns_pdf'] = $nv_Request->get_int('returns_pdf', 'post', 0);
	    $row['reports_tax'] = $nv_Request->get_int('reports_tax', 'post', 0);
	    $row['pos_index'] = $nv_Request->get_int('pos_index', 'post', 0);
	    $row['ajax'] = $nv_Request->get_int('ajax', 'post', 0);
	    $row['config_index'] = $nv_Request->get_int('config_index', 'post', 0);
	    $row['store_index'] = $nv_Request->get_int('store_index', 'post', 0);
	    $row['store_add'] = $nv_Request->get_int('store_add', 'post', 0);
	    $row['store_edit'] = $nv_Request->get_int('store_edit', 'post', 0);
	    $row['store_delete'] = $nv_Request->get_int('store_delete', 'post', 0);
	    $row['warehouse_index'] = $nv_Request->get_int('warehouse_index', 'post', 0);
	    $row['warehouse_add'] = $nv_Request->get_int('warehouse_add', 'post', 0);
	    $row['warehouse_edit'] = $nv_Request->get_int('warehouse_edit', 'post', 0);
	    $row['warehouse_delete'] = $nv_Request->get_int('warehouse_delete', 'post', 0);
	    $row['cat_index'] = $nv_Request->get_int('cat_index', 'post', 0);
	    $row['cat_add'] = $nv_Request->get_int('cat_add', 'post', 0);
	    $row['cat_edit'] = $nv_Request->get_int('cat_edit', 'post', 0);
	    $row['cat_delete'] = $nv_Request->get_int('cat_delete', 'post', 0);
		if($row['group_id'] == 1){
			$per=array(
				"permission_index" => 1,
				"add"=>1,
				"edit" => 1,
				"delete" => 1
			);
		}else{
			$per=array(
				"permission_index" => 0,
				"add"=>0,
				"edit" => 0,
				"delete" => 0
			);
		}
		$per_access=array(
			"main" => array("main_index" => 1),
			"permission" => array("permission_index" => $per['permission_index'],"add"=>$per['add'],
								 "edit" => $per['edit'], "delete" => $per['delete']),
			"products" => array("products_index" => $row['products_index'],"products_add"=>$row['products_add'], "products_edit" => $row['products_edit'], "products_delete" => $row['products_delete'],
								"products_cost" =>  $row['products_cost'],"products_price" => $row['products_price'], "edit_price" => $row['edit_price'], "products_barcode" => $row['products_barcode'], "products_adjustments" => $row['products_adjustments']),
			"sales" => array("sales_index" => $row['sales_index'],"sales_add"=>$row['sales_add'], "sales_edit" => $row['sales_edit'], "sales_delete" => $row['sales_delete'],"sales_pdf" =>  $row['sales_pdf'],
								 "sales_email" => $row['sales_email'],"sales_return_sales" => $row['sales_return_sales'],"sales_payments" => $row['sales_payments']),
			"gift" => array("gift_index" => $row['gift_index'],"gift_add"=>$row['gift_add'], "gift_edit" => $row['gift_edit'],
							"gift_delete" => $row['gift_delete']),
			"purchases" => array("purchases_index" => $row['purchases_index'],"purchases_add"=>$row['purchases_add'], "purchases_edit" => $row['purchases_edit'], "purchases_delete" => $row['purchases_delete'],
								 "purchases_pdf" =>  $row['purchases_pdf'], "purchases_email" => $row['purchases_email'], "purchases_payments" => $row['purchases_payments'], "purchases_expenses" => $row['purchases_expenses'],
								 "purchases_return_purchases" => $row['purchases_return_purchases']),
			"transfers" => array("transfers_index" => $row['transfers_index'],"transfers_add"=>$row['transfers_add'], "transfers_edit" => $row['transfers_edit'], "transfers_delete" => $row['transfers_delete'],
								"transfers_pdf" =>  $row['transfers_pdf'], "transfers_email" => $row['transfers_email']),
			"returns" => array( "returns_index" => $row['returns_index'],"returns_add"=>$row['returns_add'], "returns_edit" => $row['returns_edit'], "returns_delete" => $row['returns_delete'],
								"returns_pdf" =>  $row['returns_pdf'],"returns_email" => $row['returns_email']),
			"customers" => array("customers_index" => $row['customers_index'],"customers_add"=>$row['customers_add'], "customers_edit" => $row['customers_edit'], "customers_delete" => $row['customers_delete'],
								"customers_deposits" =>  $row['customers_deposits'], "customers_delete_deposit" => $row['customers_delete_deposit']),
			"suppliers" => array("suppliers_index" => $row['suppliers_index'],"suppliers_add"=>$row['suppliers_add'], "suppliers_edit" => $row['suppliers_edit'],
								 "suppliers_delete" => $row['suppliers_delete']),
			"reports" => array("reports_index" => $row['reports_index'],"reports_warehouse_stock"=>$row['reports_warehouse_stock'], "reports_quantity_alerts" => $row['reports_quantity_alerts'],
								 "reports_expiry_alerts" => $row['reports_expiry_alerts'],"reports_products" => $row['reports_products'], "reports_daily_sales" => $row['reports_daily_sales'], "reports_monthly_sales" => $row['reports_monthly_sales'], "reports_sales" => $row['reports_sales'],
								 "reports_purchases" => $row['reports_purchases'], "reports_profit_loss" => $row['reports_profit_loss'], "reports_customers" => $row['reports_customers'], "reports_suppliers" => $row['reports_suppliers'],
								 "reports_staff" => $row['reports_staff'], "reports_register" => $row['reports_register'], "reports_expenses" => $row['reports_expenses'], "reports_daily_purchases" => $row['reports_daily_purchases'],
								 "reports_monthly_purchases" => $row['reports_monthly_purchases'], "reports_tax" => $row['reports_tax'], "reports_best_sellers" => $row['reports_best_sellers'], "reports_payments" => $row['reports_payments'],
								 "products_stock_count" => $row['products_stock_count']),
			"warehouses" => array("warehouses_index" => $row['warehouses_index'],"warehouses_add"=>$row['warehouses_add'],
								  "warehouses_edit" => $row['warehouses_edit'], "warehouses_delete" => $row['warehouses_delete']),
			"config" => array("config_index" => $row['config_index'],"config_edit" => $row['warehouses_edit']),
			"pos" => array("pos_index" => $row['pos_index']),
			"cat" => array("cat_index" => $row['cat_index'],"cat_add"=>$row['cat_add'],
								 "cat_edit" => $row['cat_edit'], "cat_delete" => $row['cat_delete']),
			"warehouse" => array("warehouse_index" => $row['warehouse_index'],"warehouse_add"=>$row['warehouse_add'],
								 "warehouse_edit" => $row['warehouse_edit'], "warehouse_delete" => $row['warehouse_delete']),
			"store" => array("store_index" => $row['store_index'],"store_add"=>$row['store_add'],
								 "store_edit" => $row['store_edit'], "store_delete" => $row['store_delete']),
			"other" => array("bulk_actions" => $row['bulk_actions'], "ajax" => $row['ajax'])
			
		);
		$row['per_access'] = json_encode($per_access);
	    if (empty($row['group_id'])) {
	        $error[] = $lang_module['error_required_group_id'];
	    }
	
	    if (empty($error)) {
	        try {
	            if (empty($row['id'])) {
	            	if($admin_permission->permission->permission_index == '1' AND $admin_permission->permission->add == '1'){
	                	$stmt = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_permissions (group_id, per_access) VALUES (:group_id, :per_access)');
						$stmt->bindParam(':group_id', $row['group_id'], PDO::PARAM_INT);
	                }
	            } else {
	            	if($admin_permission->permission->permission_index == '1' AND $admin_permission->permission->edit == '1'){
	                	$stmt = $db->prepare('UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_permissions SET  per_access = :per_access WHERE id=' . $row['id']);
	                }
	            }
				if($admin_permission->permission->add == '1' OR $admin_permission->permission->edit == '1'){
		            
		            $stmt->bindParam(':per_access', $row['per_access'], PDO::PARAM_STR, strlen($row['per_access']));
		            $exc = $stmt->execute();
					
		            if ($exc) {
		                $nv_Cache->delMod($module_name);
		                if (empty($row['id'])) {
		                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Permissions', ' ', $admin_info['userid']);
		                } else {
		                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Permissions', 'ID: ' . $row['id'], $admin_info['userid']);
		                }
		                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
		            }
		        }else{
					$contents = $lang_module['no_permission'];
					
					$page_title = $lang_module['permissions'];
					
					include NV_ROOTDIR . '/includes/header.php';
					echo nv_admin_theme($contents);
					include NV_ROOTDIR . '/includes/footer.php';
				}
	        } catch(PDOException $e) {
	            trigger_error($e->getMessage());
	            print_r($e->getMessage()); die;//Remove this line after checks finished
	        }
	    }
	} elseif ($row['id'] > 0) {
	    $row = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_permissions WHERE id=' . $row['id'])->fetch();
	    if (empty($row)) {
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }else{
	    	$per_access = json_decode($row['per_access']);
	    	$row['products_index'] = $per_access->products->products_index;
		    $row['products_add'] = $per_access->products->products_add;
		    $row['products_edit'] = $per_access->products->products_edit;
		    $row['products_delete'] = $per_access->products->products_delete;
		    $row['products_cost'] = $per_access->products->products_cost;
		    $row['products_price'] = $per_access->products->products_price;
			$row['products_adjustments'] = $per_access->products->products_adjustments;
			$row['products_barcode'] = $per_access->products->products_barcode;
			
			$row['edit_price'] = $per_access->products->edit_price;
			$row['edit_price'] = 0;
		    $row['quotes_index'] = 0;
		    $row['quotes_add'] = 0;
		    $row['quotes_edit'] = 0;
		    $row['quotes_pdf'] = 0;
		    $row['quotes_email'] = 0;
		    $row['quotes_delete'] = 0;
		    $row['sales_index'] = $per_access->sales->sales_index;
		    $row['sales_add'] = $per_access->sales->sales_add;
		    $row['sales_edit'] = $per_access->sales->sales_edit;
		    $row['sales_pdf'] = $per_access->sales->sales_pdf;
		    $row['sales_email'] = $per_access->sales->sales_email;
		    $row['sales_delete'] = $per_access->sales->sales_delete;
			$row['sales_deliveries'] = 0;
		    $row['sales_add_delivery'] = 0;
		    $row['sales_edit_delivery'] = 0;
		    $row['sales_delete_delivery'] = 0;
		    $row['sales_email_delivery'] = 0;
		    $row['sales_pdf_delivery'] = 0;
		    $row['gift_index'] = $per_access->gift->gift_index;
		    $row['gift_add'] = $per_access->gift->gift_add;
		    $row['gift_edit'] = $per_access->gift->gift_edit;
		    $row['gift_delete'] = $per_access->gift->gift_delete;
			$row['sales_return_sales'] = $per_access->sales->sales_return_sales;
			$row['sales_payments'] = $per_access->sales->sales_payments;
		    $row['purchases_index'] = $per_access->purchases->purchases_index;
		    $row['purchases_add'] = $per_access->purchases->purchases_add;
		    $row['purchases_edit'] = $per_access->purchases->purchases_edit;
		    $row['purchases_pdf'] = $per_access->purchases->purchases_pdf;
		    $row['purchases_email'] = $per_access->purchases->purchases_email;
		    $row['purchases_delete'] = $per_access->purchases->purchases_delete;
			$row['purchases_payments'] = $per_access->purchases->purchases_payments;
		    $row['purchases_expenses'] = $per_access->purchases->purchases_expenses;
			$row['purchases_return_purchases'] = $per_access->purchases->purchases_return_purchases;
		    $row['transfers_index'] = $per_access->transfers->transfers_index;
		    $row['transfers_add'] = $per_access->transfers->transfers_add;
		    $row['transfers_edit'] = $per_access->transfers->transfers_edit;
		    $row['transfers_pdf'] = $per_access->transfers->transfers_pdf;
		    $row['transfers_email'] = $per_access->transfers->transfers_email;
		    $row['transfers_delete'] = $per_access->transfers->transfers_delete;
		    $row['customers_index'] = $per_access->customers->customers_index;
		    $row['customers_add'] = $per_access->customers->customers_add;
		    $row['customers_edit'] = $per_access->customers->customers_edit;
		    $row['customers_delete'] = $per_access->customers->customers_delete;
			$row['customers_delete_deposit'] = $per_access->customers->customers_delete_deposit;
			$row['customers_deposits'] = $per_access->customers->customers_deposits;
		    $row['suppliers_index'] = $per_access->suppliers->suppliers_index;
		    $row['suppliers_add'] = $per_access->suppliers->suppliers_add;
		    $row['suppliers_edit'] = $per_access->suppliers->suppliers_edit;
		    $row['suppliers_delete'] = $per_access->suppliers->suppliers_delete;
		    $row['pos_index'] = $per_access->pos->pos_index;
		    $row['reports_index'] = $per_access->reports->reports_index;
		    $row['reports_warehouse_stock'] = $per_access->reports->reports_warehouse_stock;
		    $row['reports_best_sellers'] = $per_access->reports->reports_best_sellers;
		    $row['reports_quantity_alerts'] = $per_access->reports->reports_quantity_alerts;
		    $row['reports_expiry_alerts'] = $per_access->reports->reports_expiry_alerts;
		    $row['reports_products'] = $per_access->reports->reports_products;
		    $row['reports_daily_sales'] = $per_access->reports->reports_daily_sales;
		    $row['reports_monthly_sales'] = $per_access->reports->reports_monthly_sales;
		    $row['reports_sales'] = $per_access->reports->reports_sales;
		    $row['reports_payments'] = $per_access->reports->reports_payments;
		    $row['reports_purchases'] = $per_access->reports->reports_purchases;
		    $row['reports_profit_loss'] = $per_access->reports->reports_profit_loss;
		    $row['reports_customers'] = $per_access->reports->reports_customers;
		    $row['reports_suppliers'] = $per_access->reports->reports_suppliers;
		    $row['reports_staff'] = $per_access->reports->reports_staff;
		    $row['reports_register'] = $per_access->reports->reports_register;
		    $row['reports_expenses'] = $per_access->reports->reports_expenses;
		    $row['reports_daily_purchases'] = $per_access->reports->reports_daily_purchases;
		    $row['reports_monthly_purchases'] = $per_access->reports->reports_monthly_purchases;
			$row['reports_tax'] = $per_access->reports->reports_tax; 
			$row['products_stock_count'] = $per_access->reports->products_stock_count;
		    $row['returns_index'] = $per_access->returns->returns_index;
		    $row['returns_add'] = $per_access->returns->returns_add;
		    $row['returns_edit'] = $per_access->returns->returns_edit;
		    $row['returns_delete'] = $per_access->returns->returns_delete;
		    $row['returns_email'] = $per_access->returns->returns_email;
		    $row['returns_pdf'] = $per_access->returns->returns_pdf;
		    $row['bulk_actions'] = $per_access->other->bulk_actions;
		    $row['ajax'] = $per_access->other->ajax;
		    $row['pos_index'] = $per_access->pos->pos_index;
		    $row['cat_index'] = $per_access->cat->cat_index;
		    $row['cat_add'] = $per_access->cat->cat_add;
		    $row['cat_edit'] = $per_access->cat->cat_edit;
		    $row['cat_delete'] = $per_access->cat->cat_delete;
		    $row['store_index'] = $per_access->store->store_index;
		    $row['store_add'] = $per_access->store->store_add;
		    $row['store_edit'] = $per_access->store->store_edit;
		    $row['store_delete'] = $per_access->store->store_delete;
			$row['warehouse_index'] = $per_access->warehouse->warehouse_index;
		    $row['warehouse_add'] = $per_access->warehouse->warehouse_add;
		    $row['warehouse_edit'] = $per_access->warehouse->warehouse_edit;
		    $row['warehouse_delete'] = $per_access->warehouse->warehouse_delete;
		    $row['config_index'] = $per_access->config->config_index;
	    }
	} else {
	    $row['id'] = 0;
	    $row['group_id'] = 0;
	    $row['products_index'] = 1;
	    $row['products_add'] = 0;
	    $row['products_edit'] = 0;
	    $row['products_delete'] = 0;
	    $row['products_cost'] = 0;
	    $row['products_price'] = 0;
	    $row['quotes_index'] = 0;
	    $row['quotes_add'] = 0;
	    $row['quotes_edit'] = 0;
	    $row['quotes_pdf'] = 0;
	    $row['quotes_email'] = 0;
	    $row['quotes_delete'] = 0;
	    $row['sales_index'] = 0;
	    $row['sales_add'] = 0;
	    $row['sales_edit'] = 0;
	    $row['sales_pdf'] = 0;
	    $row['sales_email'] = 0;
	    $row['sales_delete'] = 0;
	    $row['purchases_index'] = 1;
	    $row['purchases_add'] = 0;
	    $row['purchases_edit'] = 0;
	    $row['purchases_pdf'] = 0;
	    $row['purchases_email'] = 0;
	    $row['purchases_delete'] = 0;
	    $row['transfers_index'] = 1;
	    $row['transfers_add'] = 0;
	    $row['transfers_edit'] = 0;
	    $row['transfers_pdf'] = 0;
	    $row['transfers_email'] = 0;
	    $row['transfers_delete'] = 0;
	    $row['customers_index'] = 1;
	    $row['customers_add'] = 0;
	    $row['customers_edit'] = 0;
	    $row['customers_delete'] = 0;
	    $row['suppliers_index'] = 1;
	    $row['customers_delete_deposit'] = 0;
	    $row['suppliers_add'] = 0;
	    $row['suppliers_edit'] = 0;
	    $row['suppliers_delete'] = 0;
	    $row['sales_deliveries'] = 0;
	    $row['sales_add_delivery'] = 0;
	    $row['sales_edit_delivery'] = 0;
	    $row['sales_delete_delivery'] = 0;
	    $row['sales_email_delivery'] = 0;
	    $row['sales_pdf_delivery'] = 0;
	    $row['gift_index'] = 0;
	    $row['gift_add'] = 0;
	    $row['gift_edit'] = 0;
	    $row['gift_delete'] = 0;
	    $row['pos_index'] = 0;
	    $row['sales_return_sales'] = 0;
	    $row['reports_index'] = 0;
	    $row['reports_warehouse_stock'] = 0;
	    $row['reports_best_sellers'] = 0;
	    $row['reports_quantity_alerts'] = 0;
	    $row['reports_expiry_alerts'] = 0;
	    $row['reports_products'] = 0;
	    $row['reports_daily_sales'] = 0;
	    $row['reports_monthly_sales'] = 0;
	    $row['reports_sales'] = 0;
	    $row['reports_payments'] = 0;
	    $row['reports_purchases'] = 0;
	    $row['reports_profit_loss'] = 0;
	    $row['reports_customers'] = 0;
	    $row['reports_suppliers'] = 0;
	    $row['reports_staff'] = 0;
	    $row['reports_register'] = 0;
	    $row['sales_payments'] = 0;
	    $row['purchases_payments'] = 0;
	    $row['purchases_expenses'] = 0;
	    $row['products_adjustments'] = 0;
	    $row['bulk_actions'] = 0;
	    $row['customers_deposits'] = 0;
	    $row['products_barcode'] = 0;
	    $row['purchases_return_purchases'] = 0;
	    $row['reports_expenses'] = 0;
	    $row['reports_daily_purchases'] = 0;
	    $row['reports_monthly_purchases'] = 0;
	    $row['products_stock_count'] = 0;
	    $row['edit_price'] = 0;
	    $row['returns_index'] = 0;
	    $row['returns_add'] = 0;
	    $row['returns_edit'] = 0;
	    $row['returns_delete'] = 0;
		
	    $row['returns_email'] = 0;
	    $row['returns_pdf'] = 0;
	    $row['reports_tax'] = 0;
	    $row['pos_index'] = 0;
	    $row['ajax'] = 1;
		$row['cat_index'] = 1;
	    $row['cat_add'] = 0;
	    $row['cat_edit'] = 0;
	    $row['cat_delete'] = 0;
		$row['store_index'] = 1;
	    $row['store_add'] = 0;
	    $row['store_edit'] = 0;
	    $row['store_delete'] = 0;
		$row['warehouse_index'] = 1;
	    $row['warehouse_add'] = 0;
	    $row['warehouse_edit'] = 0;
	    $row['warehouse_delete'] = 0;
	    $row['config_index'] = 1;
	}
	    if($row['products_index'] == 1) $row['products_index'] = 'checked="checked"';
	    if($row['products_add']  == 1) $row['products_add']  = 'checked="checked"';
	    if($row['products_edit']  == 1) $row['products_edit'] = 'checked="checked"';
	    if($row['products_delete']  == 1) $row['products_delete'] = 'checked="checked"';
	    if($row['products_cost']  == 1)  $row['products_cost'] = 'checked="checked"';
	    if($row['products_price']  == 1) $row['products_price'] = 'checked="checked"';
	    if($row['purchases_index'] == 1)$row['purchases_index'] = 'checked="checked"';
	    if($row['purchases_add']  == 1) $row['purchases_add']  = 'checked="checked"';
	    if($row['purchases_edit']  == 1) $row['purchases_edit']  = 'checked="checked"';
	    if($row['purchases_pdf']  == 1) $row['purchases_pdf']  = 'checked="checked"';
	    if($row['purchases_email']  == 1)$row['purchases_email']  = 'checked="checked"';
	    if($row['purchases_delete']  == 1) $row['purchases_delete']  = 'checked="checked"';
	    if($row['transfers_index']  == 1)$row['transfers_index']   = 'checked="checked"';
	    if($row['transfers_add']  == 1) $row['transfers_add']   = 'checked="checked"';
	    if($row['transfers_edit']  == 1) $row['transfers_edit']   = 'checked="checked"';
	    if($row['transfers_pdf']  == 1) $row['transfers_pdf']   = 'checked="checked"';
	    if($row['transfers_email']  == 1) $row['transfers_email']   = 'checked="checked"';
	    if($row['transfers_delete']  == 1) $row['transfers_delete']   = 'checked="checked"';
	    if($row['customers_index']  == 1)$row['customers_index']   = 'checked="checked"';
	    if($row['customers_add']  == 1) $row['customers_add']   = 'checked="checked"';
	    if($row['customers_edit']  == 1) $row['customers_edit']   = 'checked="checked"';
	    if($row['customers_delete']  == 1) $row['customers_delete']   = 'checked="checked"'; 
	    if($row['customers_deposits']  == 1) $row['customers_deposits']   = 'checked="checked"'; 
	    if($row['customers_delete_deposit']  == 1) $row['customers_delete_deposit']   = 'checked="checked"'; 
	    if($row['suppliers_index']  == 1) $row['suppliers_index']   = 'checked="checked"';
	    if($row['suppliers_add']  == 1) $row['suppliers_add']   = 'checked="checked"';
	    if($row['suppliers_edit']  == 1) $row['suppliers_edit']   = 'checked="checked"';
	    if($row['suppliers_delete']  == 1) $row['suppliers_delete']   = 'checked="checked"';
	    if($row['pos_index']  == 1) $row['pos_index']   = 'checked="checked"';
	    if($row['sales_return_sales']  == 1) $row['sales_return_sales']   = 'checked="checked"';
	    if($row['reports_index']  == 1) $row['reports_index']   = 'checked="checked"';
	    if($row['reports_warehouse_stock']  == 1) $row['reports_warehouse_stock']   = 'checked="checked"'; 
	    if($row['reports_best_sellers']  == 1) $row['reports_best_sellers']   = 'checked="checked"'; 
	    if($row['reports_quantity_alerts']  == 1)$row['reports_quantity_alerts']   = 'checked="checked"';
	    if($row['reports_expiry_alerts']  == 1) $row['reports_expiry_alerts']   = 'checked="checked"';
	    if($row['reports_products']  == 1) $row['reports_products']   = 'checked="checked"';
	    if($row['reports_daily_sales']  == 1) $row['reports_daily_sales']   = 'checked="checked"';
	    if($row['reports_monthly_sales']  == 1) $row['reports_monthly_sales']   = 'checked="checked"';
	    if($row['reports_sales']  == 1) $row['reports_sales']   = 'checked="checked"'; 
	    if($row['reports_payments']  == 1) $row['reports_payments']   = 'checked="checked"'; 
	    if($row['reports_purchases']  == 1) $row['reports_purchases']   = 'checked="checked"';
	    if($row['reports_profit_loss']  == 1) $row['reports_profit_loss']   = 'checked="checked"';
	    if($row['reports_customers']  == 1) $row['reports_customers']   = 'checked="checked"';
	    if($row['reports_suppliers']  == 1) $row['reports_suppliers']  = 'checked="checked"';
	    if($row['reports_staff']  == 1) $row['reports_staff']  = 'checked="checked"';
	    if($row['reports_register']  == 1) $row['reports_register']  = 'checked="checked"'; 
	    if($row['sales_payments']  == 1) $row['sales_payments']  = 'checked="checked"';
	    if($row['purchases_payments']  == 1) $row['purchases_payments'] = 'checked="checked"';
	    if($row['purchases_expenses']  == 1) $row['purchases_expenses']  = 'checked="checked"';
	    if($row['products_adjustments']  == 1) $row['products_adjustments']  = 'checked="checked"';
	    if($row['bulk_actions']  == 1) $row['bulk_actions']  = 'checked="checked"';
	    if($row['customers_deposits']  == 1) $row['customers_deposits']  = 'checked="checked"';
	    if($row['products_barcode']  == 1) $row['products_barcode']  = 'checked="checked"';
	    if($row['purchases_return_purchases']  == 1) $row['purchases_return_purchases']  = 'checked="checked"';
	    if($row['reports_expenses']  == 1) $row['reports_expenses']  = 'checked="checked"';
	    if($row['reports_daily_purchases']  == 1) $row['reports_daily_purchases']  = 'checked="checked"';
	    if($row['reports_monthly_purchases']  == 1) $row['reports_monthly_purchases']  = 'checked="checked"';
	    if($row['products_stock_count']  == 1) $row['products_stock_count']  = 'checked="checked"';
	    if($row['edit_price']  == 1) $row['edit_price']  = 'checked="checked"';
	    if($row['returns_index']  == 1) $row['returns_index']  = 'checked="checked"';
	    if($row['returns_add']  == 1) $row['returns_add']  = 'checked="checked"';
	    if($row['returns_edit']  == 1) $row['returns_edit']  = 'checked="checked"';
	    if($row['returns_delete']  == 1) $row['returns_delete']  = 'checked="checked"';
	    if($row['returns_email']  == 1) $row['returns_email']  = 'checked="checked"';
	    if($row['returns_pdf']  == 1) $row['returns_pdf']  = 'checked="checked"';
	    if($row['reports_tax']  == 1) $row['reports_tax']  = 'checked="checked"';
	    if($row['pos_index']  == 1) $row['pos_index']  = 'checked="checked"';
	    if($row['ajax']  == 1) $row['ajax']  = 'checked="checked"';
		if($row['cat_index']  == 1) $row['cat_index']  = 'checked="checked"';
	    if($row['cat_add']  == 1) $row['cat_add']  = 'checked="checked"';
	    if($row['cat_edit']  == 1) $row['cat_edit']  = 'checked="checked"';
	    if($row['cat_delete']  == 1) $row['cat_delete']  = 'checked="checked"';
		if($row['store_index']  == 1) $row['store_index']  = 'checked="checked"';
	    if($row['store_add']  == 1) $row['store_add']  = 'checked="checked"';
	    if($row['store_edit']  == 1) $row['store_edit']  = 'checked="checked"';
	    if($row['store_delete']  == 1) $row['store_delete']  = 'checked="checked"';
		if($row['warehouse_index']  == 1) $row['warehouse_index']  = 'checked="checked"';
	    if($row['warehouse_add']  == 1) $row['warehouse_add']  = 'checked="checked"';
	    if($row['warehouse_edit']  == 1) $row['warehouse_edit']  = 'checked="checked"';
	    if($row['warehouse_delete']  == 1) $row['warehouse_delete']  = 'checked="checked"';
	    if($row['config_index']  == 1) $row['config_index']  = 'checked="checked"';
		if($row['sales_index']  == 1) $row['sales_index']  = 'checked="checked"';
	    if($row['sales_add']  == 1) $row['sales_add']  = 'checked="checked"';
	    if($row['sales_edit']  == 1) $row['sales_edit']  = 'checked="checked"';
	    if($row['sales_delete']  == 1) $row['sales_delete']  = 'checked="checked"';
	    if($row['sales_email']  == 1) $row['sales_email']  = 'checked="checked"';
	    if($row['sales_pdf']  == 1) $row['sales_pdf']  = 'checked="checked"';
		if($row['gift_index']  == 1) $row['gift_index']  = 'checked="checked"';
	    if($row['gift_add']  == 1) $row['gift_add']  = 'checked="checked"';
	    if($row['gift_edit']  == 1) $row['gift_edit']  = 'checked="checked"';
	    if($row['gift_delete']  == 1) $row['gift_delete']  = 'checked="checked"';
	
	$array_group_storehouse_active = $array_group_id_users = array();
	$_sql = 'SELECT * FROM '.$db_config['prefix'] . '_' . $module_data . '_groups WHERE act =1';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
			$_row['title'] = $_row[NV_LANG_DATA.'_title'];
			$_row['hometext'] = $_row[NV_LANG_DATA.'_description'];
			$array_group_storehouse[$_row['id']] = $_row;
			$array_group_storehouse_active[]= $_row['id'];
	}
	$db->sqlreset()
        ->select('COUNT(*)')
        ->from('' . $db_config['prefix'] . '_' . $module_data . '_permissions');
    $sth = $db->prepare($db->sql());
	$sth->execute();
    $num_items = $sth->fetchColumn();

    $db->select('*')
        ->order('group_id DESC');
    $sth = $db->prepare($db->sql());
	$sth->execute();
	$xtpl = new XTemplate('permissions.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
	$xtpl->assign('ROW', $row);
	if($row['group_id']>0){
		$xtpl->assign('GROUPS_ID', $row['group_id']);
		$xtpl->assign('GROUPS_TITLE', $array_group_storehouse[$row['group_id']]['title']);
	}
	
	
	foreach ($array_group_storehouse as $value) {
		if($value['id'] != 1 OR defined('NV_IS_GODADMIN')){
		    $xtpl->assign('OPTION', array(
		        'key' => $value['id'],
		        'title' => $value['title'],
		        'selected' => ($value['id'] == $row['group_id']) ? ' selected="selected"' : ''
		    ));
		    $xtpl->parse('main.select_group_id');
		}
	}
	if ($admin_permission->permission->permission_index == 1) {
	    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
		$number = 1;
	    while ($view = $sth->fetch()) {
	    	if(in_array($view['group_id'], $array_group_storehouse_active)){
		        $view['number'] = $number++;
		        $view['group_title'] = $array_group_storehouse[$view['group_id']]['title'];
		        $view['group_hometext'] = $array_group_storehouse[$view['group_id']]['hometext'];
				if($view['group_id']!=1 OR defined('NV_IS_GODADMIN')){
					$view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $view['id'];
		        	$view['link_view'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=permissions_groups&amp;userlist=' . $view['group_id'] . '';
					$xtpl->assign('ACTION', $view);
					$xtpl->parse('main.view.loop.action');
				}
			   
		    	$xtpl->assign('VIEW', $view);
	        	$xtpl->parse('main.view.loop');
			}
	    }
	    $xtpl->parse('main.view');
	}
	
	
	if (!empty($error)) {
	    $xtpl->assign('ERROR', implode('<br />', $error));
	    $xtpl->parse('main.error');
	}
	
	$xtpl->parse('main');
	$contents = $xtpl->text('main');
	
	$page_title = $lang_module['permissions'];
	
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme($contents);
	include NV_ROOTDIR . '/includes/footer.php';
}else{
	$contents = $lang_module['no_permission'];
	
	$page_title = $lang_module['permissions'];
	
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme($contents);
	include NV_ROOTDIR . '/includes/footer.php';
}
