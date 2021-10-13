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
if($parentid != $_SESSION[$module_data . '_store_id'] && $_SESSION[$module_data . '_store_id'] > 0|| $groups == 1){
	$row = array();
	$error = array();
	$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
	
	
	$export = new NukeViet\StoreHouse\Sales;
	
	    $row = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_purchases WHERE id=' . $row['id'])->fetch();
		$supplier_details = $export->site->getCompanyByID($row['supplier_id']);
		$row['store_id'] = $_SESSION[$module_data . '_store_id'];
		$row['shop'] = $_SESSION[$module_data . '_store_id'];
		$strore_details = $export->site->getStoreByID($row['store_id']);
		//print_r($strore_details);
		$row['product_id'] = 0;
		$row['customer_address'] = $supplier_details->address;
		$row['customer_phone'] = $supplier_details->phone;
		$row['customer_email'] = $supplier_details->email;
		$row['shop_name'] = $strore_details->name;
		$row['shop_address'] = $strore_details->address;
		$row['shop_phone'] = $strore_details->mobile;
		$row['shop_email'] = $strore_details->email;
		$row['status'] = $array_purchases_status[$row['status'] ];
		$row['payment'] = $array_payment_status[$row['payment_status'] ];
		
		$row['barecode'] = $export->site->barcode($row['reference_no'],'Code128', 74, 1, false, false);
		$row['qrcode'] = $array_payment_status[$row['payment_status'] ];
		$store_id= $db->query('SELECT store_id FROM ' . $db_config['prefix'] . '_' . $module_data . '_warehouses WHERE id = ' . $row['warehouse_id'])->fetch();
		$_SESSION[$module_data . '_store_id'] = $store_id['store_id'];
	    if (empty($row)) {
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=purchases_list' );
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

	
	
	$xtpl = new XTemplate('purchases_print.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
		$storehouse_product = new NukeViet\StoreHouse\Product;
		
		$list_product = $storehouse_product->products_model->getAllProducts(implode(",", $array_category_of_store));
		
		$items = $storehouse_product->site->getAllPurchaseItems($row['id']);
		$i = 0;
		if($items != array()){
			foreach($list_product as $products_sh)
			{
				
				foreach($items as $item)
				{
					
					if($item->product_id == $products_sh->id){
						$i++;
						if($products_sh->tax_method ==1) {
							if($products_sh->tax_rate == 2){
								$tax_per = $array_tax_rate_storehouse[$products_sh->tax_rate]['rate']/100;
								$tax = 1 + $tax_per;
							}
						}else{
							$tax = 1;
							$tax_per = 0;
						}
						$xtpl->assign('product', array(
					        'i' => $i,
					        'id' => $products_sh->id,
					        'code' => $products_sh->code,
					        'title' => $products_sh->name,
					        'price' => storehouse_number_format($item->real_unit_price,0),
					        'quantity' => storehouse_number_format($item->quantity,0),
					        'sale_unit' => $products_sh->sale_unit,
					        'discount' => 0,
					        'tax_id' => $products_sh->tax_rate,
					        'tax' => $tax_per*100,
					        'price_tax' => $item->real_unit_price-$item->real_unit_price/$tax,
					        'total' => storehouse_number_format($item->real_unit_price*$item->quantity,0)
					        
					    ));
						$xtpl->assign('products_id', $products_sh->id);
						$xtpl->assign('products_code', $products_sh->code);
						$xtpl->parse('main.store.products');
					}
					
				}
			}
		}
		$num = $i;
		$xtpl->assign('products_sales_total', $num);
		$row['total_fomart'] = storehouse_number_format($row['total'],0);
		$row['voucher_total_fomart'] = storehouse_number_format($row['product_discount'],0);
		$row['tax_total_fomart'] = storehouse_number_format($row['tax_total'],0);
		$row['shipping_fomart'] = storehouse_number_format($row['shipping'],0);
		$row['grand_total_fomart'] = storehouse_number_format($row['grand_total'],0);
		$row['paid_total_fomart'] = storehouse_number_format($row['paid'],0);
		$row['debt_total_fomart'] = storehouse_number_format($row['grand_total'] - $row['paid'],0);
		//print_r($row);
		$xtpl->assign('ROW', $row);
		
		$xtpl->parse('main.store');
	
	$xtpl->parse('main');
	$contents = $xtpl->text('main');
	
	$page_title = $lang_module['print_sales'];
	 
	include NV_ROOTDIR . '/includes/header.php';
	//echo nv_admin_theme($contents);
	echo $contents;
	/* echo nv_admin_theme($export->index()); */
	include NV_ROOTDIR . '/includes/footer.php';
}else{
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