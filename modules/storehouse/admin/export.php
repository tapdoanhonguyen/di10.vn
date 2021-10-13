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


	$row = array();
	$error = array();
	$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
	
	
	$export = new NukeViet\StoreHouse\Sales;
	$storehouse_product = new NukeViet\StoreHouse\Product;
	$items = new NukeViet\StoreHouse\Myclass;
	$list_product = new NukeViet\StoreHouse\Myclass;
	$list_product = $storehouse_product->products_model->getAllProducts(implode(",", $array_category_of_store));
	$row['store_id'] = $_SESSION[$module_data . '_store_id'];
	$row['shop'] = $_SESSION[$module_data . '_store_id'];
	
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
	    $row['customer_id'] = $nv_Request->get_int('customer_id', 'post', 0);
	    $row['project_id'] = $nv_Request->get_int('project_id', 'post', 0);
	    $row['warehouse_id'] = $nv_Request->get_int('warehouse_id', 'post', 0);
	    $row['note'] = $nv_Request->get_title('note', 'post', '');
	    $row['product_discount'] = $nv_Request->get_title('product_discount', 'post', '');
	    $row['order_discount_id'] = $nv_Request->get_title('order_discount_id', 'post', '');
	    $row['order_tax_id'] = $nv_Request->get_int('order_tax_id', 'post', 0);
	    
	    $row['sale_status'] = $nv_Request->get_title('status', 'post', '');
	    $row['payment_status'] = $nv_Request->get_title('payment_status', 'post', '');
	    $row['attachment'] = $nv_Request->get_title('attachment', 'post', '');
	    $row['payment_term'] = $nv_Request->get_int('payment_term', 'post', 0);
	    $row['product_id'] = $nv_Request->get_array('product_id', 'post', 0);
	    $row['product_quantity'] = $nv_Request->get_array('product_quantity', 'post', 0);
	    $row['product_option'] = $nv_Request->get_array('product_option', 'post', 0);
	    $row['product_expried'] = $nv_Request->get_array('product_expried', 'post', 0);
	    $row['product_discount'] = $nv_Request->get_array('product_discount', 'post', 0);
	    $row['product_tax_rate'] = $nv_Request->get_array('product_tax_rate', 'post', 0);
	    $row['product_tax_items'] = $nv_Request->get_array('product_tax_items', 'post', 0);
	    $row['product_cost_tax'] = $nv_Request->get_array('product_cost_tax', 'post', 0);
	    $row['product_total'] = $nv_Request->get_array('product_total', 'post', 0);
	    $row['product_code'] = $nv_Request->get_array('product_code', 'post', 0);
	    $row['product_name'] = $nv_Request->get_array('product_name', 'post', 0);
	    $row['product_unit'] = $nv_Request->get_array('product_unit', 'post', 0);
	    $row['product_base_quantity'] = $nv_Request->get_array('product_base_quantity', 'post', 0);
	    $row['product_real_unit_price'] = $nv_Request->get_array('product_real_unit_price', 'post', 0);
	    $row['product_net_price'] = $nv_Request->get_array('product_net_price', 'post', 0);
	    $row['product_unit_price'] = $nv_Request->get_array('product_unit_price', 'post', 0);
	    $row['part_no'] = $nv_Request->get_array('part_no', 'post', 0);
	    $row['idsite'] = $global_config['idsite'];
	    $row['parentid'] = $site_parent;
		//print_r($row);die;
	    if (empty($row['date'])) {
	        $error[] = $lang_module['error_required_date'];
	    } elseif (empty($row['customer_id'])) {
	        $error[] = $lang_module['error_required_customer_id'];
	    } elseif (empty($row['warehouse_id'])) {
	        $error[] = $lang_module['error_required_warehouse_id'];
	    }/* elseif (empty($row['project_id'])) {
	        $error[] = $lang_module['error_required_project_id'];
	    }  */
	     if (empty($error)) {
	            if (empty($row['id'])) {
	                $row['order_discount'] = '';
	                $row['paid'] = '0';
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
	                
					$customer=$export->site->getCompanyByID($row['customer_id']);
					$row['order_email'] = $customer->email;
					$row['order_time'] = $row['date'];
					$row['product_tax']= '';
					//$export->getPurchases($row);
					$sh_items =array();
					$i=0;
					$total = 0;
					foreach ($row['product_id'] as $product){
						$pro_storehouse_list = '[{"id_product":"' . $product . '","number_product":"' . $row['product_base_quantity'][$i] . '","product_code":"' . $row['product_code'][$i] . '","product_unit":"' . $row['product_unit'][$i] . '"}]';
						$sh_items[$product] = array(
							"pro_storehouse_list" => $pro_storehouse_list,
							"price" => storehouse_number_format(str_replace( ',', '', $row['product_real_unit_price'][$i]),0,'','')
						);
						$total += intval(storehouse_number_format(str_replace( ',', '', $row['product_base_quantity'][$i]),0,'','')) * intval(storehouse_number_format(str_replace( ',', '', $row['product_real_unit_price'][$i]),0,'',''));
						$i++;
					}
					
	    			$row['total'] = $total;
				    $row['order_tax'] = $nv_Request->get_title('order_tax', 'post', '');
				    $row['shipping'] = $nv_Request->get_title('shipping', 'post', '');
					
	    			$row['product_tax'] = $nv_Request->get_title('product_tax', 'post', '');
	    			$row['total_tax'] = $row['product_tax'] + $row['order_tax'];
					/* print_r($row);die; */
					$exc=$export->shopadd($row, $sh_items);
	
	            } else {
					//$export->getSales($row);
					$exc=$export->edit($row['id']);
	            }
	            if ($exc) {
	                $nv_Cache->delMod($module_name);
	                if (empty($row['id'])) {
	                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Sales', ' ', $admin_info['userid']);
	                } else {
	                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Sales', 'ID: ' . $row['id'], $admin_info['userid']);
	                }/* die; */ 
	                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=sales_list' );
	            }
	    }
		$array_item = array();
		$i=0;
		foreach ($row['product_id'] as $product){
			$array_item[] = (object) array(
	            "product_id" => $product,
	            "product_code" => $row['product_code'][$i],
	            "product_name" => str_replace( ',', '',$row['product_base_quantity'][$i]),
	            "product_type" => 'standard',
	            "option_id" => 0,
	            "net_unit_price" => str_replace( ',', '',$row['product_net_price'][$i]),
	            "unit_price" => str_replace( ',', '',$row['product_unit_price'][$i]),
	            "quantity" => str_replace( ',', '',$row['product_base_quantity'][$i]),
	            "warehouse_id" => 1,
	            "item_tax" => 0,
	            "tax_rate_id" => str_replace( ',', '',$row['product_base_quantity'][$i]),
	            "tax" => "",
	            "discount" => 0,
	            "item_discount" => 0,
	            "subtotal" => str_replace( ',', '',$row['product_base_quantity'][$i]),
	            "serial_no" => "",
	            "real_unit_price" => str_replace( ',', '',$row['product_real_unit_price'][$i]),
	            "sale_item_id" => "",
	            "product_unit_id" => str_replace( ',', '',$row['product_unit'][$i]),
	            "product_unit_code" => str_replace( ',', '',$row['product_unit_code'][$i]),
	            "unit_quantity" => str_replace( ',', '',$row['product_base_quantity'][$i]),
	            "comment" => "",
	            "gst" => "",
	            "cgst" => "",
	            "sgst" => "",
	            "igst" => "",
	            "module" => $module_name
			
			);
			$i++;
		}
		$items = (object) $array_item;

		 
	} elseif ($row['id'] > 0) {
	    $row = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_sales WHERE id=' . $row['id'])->fetch();
	    //$row['project_title'] = $db->query('SELECT title FROM ' . $db_config['prefix'] . '_' . $module_data . '_project WHERE projectid=' . $row['projectid'])->fetch(5)->title;
		$row['product_id'] = 0;
		$row['project_id'] = $row['projectid'];
		$store_id= $db->query('SELECT store_id FROM ' . $db_config['prefix'] . '_' . $module_data . '_warehouses WHERE id = ' . $row['warehouse_id'])->fetch();
		$_SESSION[$module_data . '_store_id'] = $store_id['store_id'];
	    if (empty($row)) {
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=purchases_list' );
	    } 

		$items = $storehouse_product->site->getAllSaleItems($row['id']);
	} else {
	    $row['id'] = 0;
	    $row['project_id'] = 0;
	    $row['reference_no'] = '';
	    $row['date'] = 0;
	    $row['customer_id'] = 0;
	    $row['warehouse_id'] = 0;
	    $row['note'] = '';
	    $row['product_discount'] = '';
	    $row['order_discount_id'] = '';
	    $row['total_discount'] = '';
	    $row['product_tax'] = '';
	    $row['order_tax_id'] = 0;
	    $row['order_tax'] = '';
	    $row['total_tax'] = '0';
	    $row['shipping'] = '0';
	    $row['sale_status'] = 1;
	    $row['payment_status'] = 'pending';
	    $row['attachment'] = '';
	    $row['payment_term'] = 0;
	    $row['product_id'] = 0;
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
	
	
	$xtpl = new XTemplate('export.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
	$xtpl->parse('main.store_id');
		
		$i = 0;
		if($items != array()){
			foreach($items as $item)
			{
				/* print_r($item);  */
				$i++;
				 if($item->tax_method ==1) {
					if($item->tax_rate == 2){
						$tax_per = $array_tax_rate_storehouse[$item->tax_rate]['rate']/100;
						$tax = 1 + $tax_per;
					}
				}else{
					$tax = 1;
					$tax_per = 0;
				} 
				$xtpl->assign('product', array(
					'i' => $i,
					'id' => $item->product_id,
					'code' => $item->product_code,
					'title' => $item->product_name,
					'price' => storehouse_number_format($item->real_unit_price,0),
					'quantity' => storehouse_number_format($item->quantity,0),
					'sale_unit' => $item->sale_unit,
					'discount' => 0,
					'tax_id' => $item->tax_rate,
					'tax' => $tax_per*100,
					'price_tax' => $item->real_unit_price-$item->real_unit_price/$tax,
					'total' => storehouse_number_format($item->real_unit_price*$item->quantity,0)
					
				));
				$xtpl->assign('products_id', $item->product_id);
				$xtpl->assign('products_code', $item->product_code);
				$xtpl->parse('main.store.products');
				
			}
		}
		$num = $i;
		$xtpl->assign('products_sales_total', $num);
		$row['shipping_fomart'] = storehouse_number_format($row['shipping'],0);
		$xtpl->assign('ROW', $row);
		foreach ($array_purchase_id_storehouse as $value) {
		    $xtpl->assign('PRODUCT', array(
		        'key' => $value['id'],
		        'title' => $value['name'],
		        'selected' => ($value['id'] == $row['product_id']) ? ' selected="selected"' : ''
		    ));
		    $xtpl->parse('main.store.select_products_id');
		}
		foreach ($array_sales_status as $key => $title) {
			if(in_array($key, array(2,5))){
				$xtpl->assign('STATUS', array(
			        'key' => $key,
			        'title' => $title,
			        'selected' => ($key == $row['sale_status']) ? ' selected="selected"' : ''
			    ));
			    $xtpl->parse('main.store.select_status');
			}
		    
		}
		foreach ($array_customer_id_storehouse as $value) {
			//print_r($row['customer_id']);die;
		    $xtpl->assign('CUSTOMER', array(
		        'key' => $value['id'],
		        'title' => $value['company'],
		        'selected' => ($value['id'] == $row['customer_id']) ? ' selected="selected"' : ''
		    ));
		    $xtpl->parse('main.store.select_customer_id');
		}
		
		foreach ($array_tax_rate_storehouse as $value) {
		    $xtpl->assign('TAX_RATE', array(
		        'key' => $value['id'],
		        'title' => $value['name'],
		        'selected' => ($value['id'] == $row['order_tax_id']) ? ' selected="selected"' : ''
		    ));
		    $xtpl->parse('main.store.select_order_tax_id');
		}
		
		if (!empty($error)) {
		    $xtpl->assign('ERROR', implode('<br />', $error));
		    $xtpl->parse('main.store.error');
		}
		foreach ($list_warehouse_of_store as $warehouse) {
			if($warehouse->sales ==1){
				if($warehouse->id == $row['warehouse_id']){
					$array_warehouses_storehouse[$warehouse->id]['selected'] = 'selected="selected"';
				}else{
					$array_warehouses_storehouse[$warehouse->id]['selected'] = '';
				}
				$xtpl->assign('WAREHOUSE', $array_warehouses_storehouse[$warehouse->id]);
				$xtpl->parse('main.store.select_warehouse_id');
			}
		}
		if(!empty($row['id']))
			$xtpl->parse('main.store.project_value');
		$xtpl->parse('main.store');
	
	$xtpl->parse('main');
	$contents = $xtpl->text('main');
	
	$page_title = '';
	 
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme($contents);
	/* echo nv_admin_theme($export->index()); */
	include NV_ROOTDIR . '/includes/footer.php';
