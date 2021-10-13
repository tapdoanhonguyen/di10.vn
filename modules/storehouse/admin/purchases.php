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

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.catalogy.php';
/* if(empty($list_warehouse_of_store)){
	nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=warehouses' );
} */

	$row = array();
	$error = array();
	$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
	//$purchaes = new NukeViet\StoreHouse\app\controllers\admin\Purchases;
	
	
	
	$purchaes = new NukeViet\StoreHouse\Purchases;
	$row['store_id'] = $_SESSION[$module_data . '_store_id'];
	
	 if ($nv_Request->isset_request('submit', 'post')) {
	    $row['reference_no'] = $nv_Request->get_title('reference_no', 'post', '');
	    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('date', 'post'), $m))     {
	        $_hour = $nv_Request->get_int('date_hour', 'post');
	        $_min = $nv_Request->get_int('date_min', 'post');
	        $row['date'] = mktime($_hour, $_min, 0, $m[2], $m[1], $m[3]);
	    }
	    else
	    {
	        $row['date'] = 0;
	    }
	    $row['supplier_id'] = $nv_Request->get_int('supplier_id', 'post', 0);
	    $row['warehouse_id'] = $nv_Request->get_int('warehouse_id', 'post', 0);
	    $row['note'] = $nv_Request->get_title('note', 'post', '');
	    $row['total'] = $nv_Request->get_title('total', 'post', '');
	    $row['product_discount'] = $nv_Request->get_title('product_discount', 'post', '');
	    $row['order_discount_id'] = $nv_Request->get_title('order_discount_id', 'post', '');
	    $row['total_discount'] = $nv_Request->get_title('total_discount', 'post', '');
	    $row['product_tax'] = $nv_Request->get_title('product_tax', 'post', '');
	    $row['order_tax_id'] = $nv_Request->get_int('order_tax_id', 'post', 0);
	    $row['order_tax'] = $nv_Request->get_title('order_tax', 'post', '');
	    $row['total_tax'] = $nv_Request->get_title('total_tax', 'post', '');
	    $row['shipping'] = $nv_Request->get_title('shipping', 'post', '');
	    $row['status'] = $nv_Request->get_title('status', 'post', '');
	    $row['payment_status'] = $nv_Request->get_int('payment_status', 'post', 0);
	    $row['attachment'] = $nv_Request->get_title('attachment', 'post', '');
	    $row['payment_term'] = $nv_Request->get_int('payment_term', 'post', 0);
	    $row['product_id'] = $nv_Request->get_array('product_id', 'post', 0);
	    $row['product_quantity'] = $nv_Request->get_array('product_quantity', 'post', 0);
	    $row['product_option'] = $nv_Request->get_array('product_option', 'post', 0);
	    $row['product_expried'] = $nv_Request->get_array('product_expried', 'post', 0);
	    $row['product_discount'] = $nv_Request->get_array('product_discount', 'post', 0);
	    $row['product_tax_rate'] = $nv_Request->get_array('product_tax_rate', 'post', 0);
	    $row['product_tax'] = $nv_Request->get_array('product_tax', 'post', 0);
	    $row['product_cost_tax'] = $nv_Request->get_array('product_cost_tax', 'post', 0);
	    $row['product_total'] = $nv_Request->get_array('product_total', 'post', 0);
	    $row['product_code'] = $nv_Request->get_array('product_code', 'post', 0);
	    $row['product_name'] = $nv_Request->get_array('product_name', 'post', 0);
	    $row['product_unit'] = $nv_Request->get_array('product_unit', 'post', 0);
	    $row['product_quantity_received'] = $nv_Request->get_array('product_quantity_received', 'post', 0);
	    $row['product_base_quantity'] = $nv_Request->get_array('product_base_quantity', 'post', 0);
	    $row['quantity_balance'] = $nv_Request->get_array('quantity_balance', 'post', 0);
	    $row['product_real_unit_cost'] = $nv_Request->get_array('product_real_unit_cost', 'post', 0);
	    $row['product_net_cost'] = $nv_Request->get_array('product_net_cost', 'post', 0);
	    $row['product_unit_cost'] = $nv_Request->get_array('product_unit_cost', 'post', 0);
	    $row['ordered_quantity'] = $nv_Request->get_array('ordered_quantity', 'post', 0);
	    $row['part_no'] = $nv_Request->get_array('part_no', 'post', 0);
	    $row['idsite'] = $global_config['idsite'];
	    $row['parentid'] = $site_parent;
	    if (empty($row['date'])) {
	        $error[] = $lang_module['error_required_date'];
	    } elseif (empty($row['supplier_id'])) {
	        $error[] = $lang_module['error_required_supplier_id'];
	    } elseif (empty($row['warehouse_id'])) {
	        $error[] = $lang_module['error_required_warehouse_id'];
	    }
		
	     if (empty($error)) {
	            if (empty($row['id'])) {
	                $row['order_discount'] = '';
	                $row['paid'] = '0.0000';
	                $row['created_by'] = 0;
	                $row['updated_by'] = 0;
	                $row['updated_at'] = '';
	                $row['due_date'] = '';
	                $row['return_id'] = 0;
	                $row['surcharge'] = '0.0000';
	                $row['return_purchase_ref'] = '';
	                $row['purchase_id'] = 0;
	                $row['return_purchase_total'] = '0.0000';
	                $row['cgst'] = '';
	                $row['sgst'] = '';
	                $row['igst'] = '';
					//print_r($row);
					$purchaes->getPurchases($row);
					$exc=$purchaes->add();
	
	            } else {
					$purchaes->getPurchases($row);
					//print_r($row['product_id']); 
					$exc=$purchaes->edit($row['id']);
	            }
	            if ($exc) {
	                $nv_Cache->delMod($module_name);
	                if (empty($row['id'])) {
	                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Purchases', ' ', $admin_info['userid']);
	                } else {
	                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Purchases', 'ID: ' . $row['id'], $admin_info['userid']);
	                }
	                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=purchases_list' );
	            }
			
	    }
		$page_title = ''; 
	} elseif ($row['id'] > 0) {
		//if(empty($list_warehouse_of_store)) $list_warehouse[] = 0; else $list_warehouse = $list_warehouse_of_store;
	    $row = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_purchases WHERE id=' . $row['id'] )->fetch();
	    //$purchases_items = $db->query('SELECT product_id FROM ' . $db_config['prefix'] . '_' . $module_data . '_purchases_items WHERE purchase_id=' . $row['id'] )->fetch();
		//$row['product_id'] = $purchases_items;
		//$store_id= $db->query('SELECT store_id FROM ' . $db_config['prefix'] . '_' . $module_data . '_warehouses WHERE id = ' . $row['warehouse_id'])->fetch();
	    if (empty($row)) {
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=purchases_list' );
	    }
		/* if(!in_array($row['warehouse_id'], $list_warehouse_of_store))
			nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=purchases_list' ); */
		$page_title = $lang_module['purchase_edit'];
	} else {
		$page_title = '';
	    $row['id'] = 0;
	    $row['reference_no'] = '';
	    $row['date'] = 0;
	    $row['supplier_id'] = 0;
	    $row['warehouse_id'] = 0;
	    $row['note'] = '';
	    $row['total'] = '';
	    $row['product_discount'] = '';
	    $row['order_discount_id'] = '';
	    $row['total_discount'] = '';
	    $row['ordered_quantity'] = 0;
	    $row['product_tax'] = '';
	    $row['order_tax_id'] = 0;
	    $row['order_tax'] = '';
	    $row['total_tax'] = '0.0000';
	    $row['shipping'] = '0.0000';
	    $row['grand_total'] = '';
	    $row['status'] = 1;
	    $row['payment_status'] = 0;
	    $row['attachment'] = '';
	    $row['payment_term'] = 0;
	    $row['product_id'] = array();
	}
	
	if (empty($row['date'])) {
	    $row['date'] = '';
	}
	else
	{
	    $row['date'] = date('d/m/Y', $row['date']);
	}
	
	if (!empty($row['attachment']) and is_file(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['attachment'])) {
	    $row['attachment'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['attachment'];
	}
	if (defined('NV_EDITOR'))
	    require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
	
	$row['note'] = nv_htmlspecialchars(nv_editor_br2nl($row['note']));
	if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
	    $row['note'] = nv_aleditor('note', '100%', '300px', $row['note']);
	} else {
	    $row['note'] = '<textarea style="width:100%;height:300px" name="note">' . $row['note'] . '</textarea>';
	}
	
	
	$xtpl = new XTemplate('purchases.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
	
		$storehouse_product = new NukeViet\StoreHouse\Product;
		
		$list_product = $storehouse_product->products_model->getAllProducts();
		
		$items = $purchaes->purchases_model->getAllPurchaseItems($row['id']);
		$i = 0;
		if($items != array()){
			
			foreach($items as $item)
			{
				$item->ordered_quantity = $item->quantity;
				$received = $item->quantity_received ? $item->quantity_received : $item->quantity;
				$item->quantity_balance = $item->quantity_balance + ($item->quantity-$received);
				/* print_r($item); die; */
				$i++;
				if($item->tax_method ==1) {
					if($item->tax_rate_id == 2){
						$tax_per = $array_tax_rate_storehouse[$item->tax_rate_id]['rate']/100;
						$tax = 1 + $tax_per;
					}
				}else{
					$tax = 1;
					$tax_per = 0;
				}
				foreach($list_product as $products_sh)
				{ 
					if($item->product_id == $products_sh->id){
						//print_r($products_sh->id);
					}
					
				}
				/* print_r($item); */
				$xtpl->assign('product', array(
							'i' => $i,
					        'id' => $item->product_id,
					        'code' => $item->product_code,
					        'title' => $item->product_name,
					        'cost' => storehouse_number_format($item->real_unit_cost,0),
					        'quantity' => storehouse_number_format($item->quantity,0),
					        'purchase_unit' => $item->product_unit_id,
					        'quantity_received' => storehouse_number_format($item->quantity_received,0),
					        'ordered_quantity' => storehouse_number_format($item->ordered_quantity,0),
					        'quantity_balance' => storehouse_number_format($item->quantity_balance,0),
					        'discount' => 0,
					        'tax_id' => $item->tax_rate,
					        'tax' => $tax_per*100,
					        'cost_tax' => $item->real_unit_cost-$item->real_unit_cost/$tax,
					        'total' => storehouse_number_format($item->real_unit_cost*$item->quantity,0),
					        'date' => $item->date
					        
					    ));
						$xtpl->assign('products_id', $item->product_id);
						$xtpl->assign('products_code', $item->product_code);
						if(!empty($row['id']) && ($row['status'] == 4 || $row['status'] == 5)){
							$xtpl->parse('main.store.products.received');
						}
						$xtpl->parse('main.store.products');
			}
		}
		
		$num = $i;
		$xtpl->assign('products_purchases_total', $num);
	
		$xtpl->assign('ROW', $row);
		/*
		foreach ($array_purchase_id_storehouse as $value) {
					$xtpl->assign('PRODUCT', array(
						'key' => $value['id'],
						'title' => $value['name'],
						'selected' => ($value['id'] == $row['product_id']) ? ' selected="selected"' : ''
					));
					$xtpl->parse('main.store.select_products_id');
				}*/
		
		foreach ($array_status as $key => $title) {
			if(in_array($key, array(2,3,4,5))){
			    $xtpl->assign('STATUS', array(
			        'key' => $key,
			        'title' => $title,
			        'selected' => ($key == $row['status']) ? ' selected="selected"' : ''
			    ));
			    $xtpl->parse('main.store.select_status');
			}
		}
		//print_r($array_supplier_id_storehouse);
		foreach ($array_supplier_id_storehouse as $value) {
			if( in_array($value['idsite'],$array_site) && $value['idsite']!=$global_config['idsite'] || $global_config['idsite'] == 0 && $value['idsite'] == 0){
				 $xtpl->assign('SUPPLIER', array(
			        'key' => $value['id'],
			        'title' => $value['company'],
			        'selected' => ($value['id'] == $row['supplier_id']) ? ' selected="selected"' : ''
			    ));
			    $xtpl->parse('main.store.select_supplier_id');
			}
		}
		
		foreach ($array_tax_rate_storehouse as $value) {
		    $xtpl->assign('TAX_RATE', array(
		        'key' => $value['id'],
		        'title' => $value['name'],
		        'selected' => ($value['id'] == $row['order_tax_id']) ? ' selected="selected"' : ''
		    ));
		    $xtpl->parse('main.store.select_order_tax_id');
		}
		
		
		foreach ($list_warehouse_of_store as $w_id => $warehouse) {
			if($warehouse->id == $row['warehouse_id']){
				$array_warehouses_storehouse[$warehouse->id]['selected'] = 'selected="selected"';
			}else{
				$array_warehouses_storehouse[$warehouse->id]['selected'] = '';
			}
			$xtpl->assign('WAREHOUSE', $array_warehouses_storehouse[$warehouse->id]);
			$xtpl->parse('main.store.select_warehouse_id');
		}
		
	if (!empty($error)) {
	    $xtpl->assign('ERROR', implode('<br />', $error));
	    $xtpl->parse('main.error');
	}else{
		if(!empty( $row['id']))
			$xtpl->parse('main.store.edit');
		$xtpl->parse('main.store');
	}
	$xtpl->parse('main');
	$contents = $xtpl->text('main');
	
	
	 
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme($contents);
	/* echo nv_admin_theme($purchaes->index()); */
	include NV_ROOTDIR . '/includes/footer.php';
