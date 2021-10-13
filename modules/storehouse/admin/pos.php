<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 04 Sep 2018 04:16:41 GMT
 */
if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
if($parentid != $_SESSION[$module_data . '_store_id'] && $_SESSION[$module_data . '_store_id'] > 0){
	if ($nv_Request->isset_request('delete_setting_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
	    $setting_id = $nv_Request->get_int('delete_setting_id', 'get');
	    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
	    if ($setting_id > 0 and $delete_checkss == md5($setting_id . NV_CACHE_PREFIX . $client_info['session_id'])) {
	        $db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_settings  WHERE setting_id = ' . $db->quote($setting_id));
	        $nv_Cache->delMod($module_name);
	        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Config', 'ID: ' . $setting_id, $admin_info['userid']);
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }
	}
	if($nv_Request->get_int('total_items', 'post') > 0)
	{
		
		$products_id=$nv_Request->get_array('product_id', 'post', array());
		$products_name=$nv_Request->get_array('product_name', 'post', array());
		$products_quantity=$nv_Request->get_array('quantity', 'post', array());
		$products_real_price=$nv_Request->get_array('real_unit_price', 'post', array());
		$amount = $nv_Request->get_array('amount', 'post', array());
		$store_id = $nv_Request->get_int('store_id', 'post', 0);
		$customer_id = $nv_Request->get_int('customer', 'post', 0);
		
		$pos = new NukeViet\StoreHouse\Pos;
		$order_bill=$pos->index();
		
		//print_r($order_bill);
		$store= new NukeViet\StoreHouse\StoreHouse;
		$store_detail=$store->storehouse_model->getStoreByID($store_id);
		$customer_details = $store->site->getCompanyByID($customer_id);
		if($customer_id > 0 ) $customer = $customer_details->company != ''  ? $customer_details->company : $customer_details->name;
		
		$xtpl = new XTemplate('pos_view.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
		$xtpl->assign('LOGO', $global_config['site_logo']);
		$xtpl->assign('TITLE_SHOP', $store_detail['name']);
		$xtpl->assign('ADDRESS', $store_detail['address']);
		$xtpl->assign('MOBILE', $store_detail['mobile']);
		$xtpl->assign('GST', $store_detail['tax_code']);
		$xtpl->assign('ORDER_DATE', $order_bill['date']);
		$xtpl->assign('ORDER_BILL', $order_bill['order_code']);
		$xtpl->assign('CUSTOMER', $customer);
		$xtpl->assign('SALES_NAME', $admin_info['username']);
		$xtpl->assign('MY_DOMAIN', $_SERVER['SERVER_NAME']);
		
		$r=0;
		
		foreach($products_id as $product_id){
			$product=array();
			$product['product_id'] = $product_id;
			if(!empty($product['image'])){
				$product['image'] = $product['image'];
			} else{
				$product['image'] = 'no-image.png';
			}
			$product['product_name'] = $products_name[$r];
			$product['quantity'] = storehouse_number_format($products_quantity[$r]);
			$product['real_unit_price'] = storehouse_number_format($products_real_price[$r]);
			$product['real_total'] = storehouse_number_format($products_quantity[$r] * $products_real_price[$r]);
			
			$xtpl->assign('PRODUCT', $product);
			$xtpl->parse('main.product');
		}
		$xtpl->assign('AMOUNT', storehouse_number_format($amount[0]));
		$xtpl->parse('main');
		$contents = $xtpl->text('main');
		
		$page_title = $lang_module['pos'];
		
		include NV_ROOTDIR . '/includes/header.php';
		echo $contents;
		
		//echo nv_admin_theme($contents);
		include NV_ROOTDIR . '/includes/footer.php';
	}else{
		
		$storehouse_product = new NukeViet\StoreHouse\Product;
		$list_product = $storehouse_product->products_model->getAllProducts(implode(",",$array_category_of_store));
		$xtpl = new XTemplate('pos.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
		$xtpl->assign('SHOP_TITLE', 'TMS SHOP');
		$xtpl->assign('NOW', date("d-m-y H:i",NV_CURRENTTIME));
		$xtpl->assign('STORE_SESSION', $_SESSION[$module_data . '_store_id']);
		$xtpl->assign('SALES_NAME', $admin_info['username']);
		$xtpl->assign('MY_DOMAIN', $_SERVER['SERVER_NAME']);
		if($row['id']==0){
			foreach ($array_store_storehouse as $value) {
			    $xtpl->assign('STORE', array(
			        'key' => $value['store_id'],
			        'title' => $value['name'],
			        'selected' => ($value['store_id'] == $_SESSION[$module_data . '_store_id']) ? ' selected="selected"' : ''
			    ));
			    $xtpl->parse('main.select_store_id.sloop');
			}
			 $xtpl->parse('main.select_store_id');	
			 foreach ($array_warehouses_storehouse as $value) {
			 	if($value['store_id'] == $_SESSION[$module_data . '_store_id']){
			 		$xtpl->assign('WAREHOUSE', array(
				        'key' => $value['id'],
				        'title' => $value['name']
				    ));
				    $xtpl->parse('main.select_warehouse_id');
			 	}
			    
			}
		}
		$c_i =0;
		
		foreach ($array_subcategory_id_storehouse as $key => $cat){
			if($cat['parent_id'] == 0 && in_array($cat['id'], $array_category_of_store)){
				$c_i++;
				$cat['no'] = $c_i;
				$cat['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $cat['image'];
				$xtpl->assign('CAT', $cat);
				$xtpl->parse('main.cat');
			}
			
		}
		foreach ($list_product as $key => $product) {
			
			if(!empty($product->image)){
				$product->image = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $product->image;
			} else{
				$product->image = NV_BASE_SITEURL . NV_ASSETS_DIR . '/images/no_image.png';
			}
			$xtpl->assign('PRODUCT', $product);
			$xtpl->parse('main.products');
		}
		
		if (!empty($error)) {
		    $xtpl->assign('ERROR', implode('<br />', $error));
		    $xtpl->parse('main.error');
		}
		if($_SESSION[$module_data . '_remove_posls'] == '1'){
			$xtpl->parse('main.remove_pos_payment_old');
			
		}
		$xtpl->parse('main');
		$contents = $xtpl->text('main');
		
		$page_title = $lang_module['pos'];
		
		include NV_ROOTDIR . '/includes/header.php';
		echo $contents;
		//echo nv_admin_theme($contents);
		include NV_ROOTDIR . '/includes/footer.php';
	}
}else{
	$xtpl = new XTemplate('pos.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
		$error = array();
		$error[] = $lang_module['no_pos_store'];
		
		if (!empty($error)) {
		    $xtpl->assign('ERROR', implode('<br />', $error));
		    $xtpl->parse('no_pos.error');
		}
		$xtpl->parse('no_pos');
		$contents = $xtpl->text('no_pos');
		
		$page_title = $title_manager_store;
		
		include NV_ROOTDIR . '/includes/header.php';
		//echo $contents;
		echo nv_admin_theme($contents);
		include NV_ROOTDIR . '/includes/footer.php';
}
