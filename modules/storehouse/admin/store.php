<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */
require NV_ROOTDIR . '/modules/' . $module_file . '/global.catalogy.php';
if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
	$row = array();
	$row['stores_id'] = $nv_Request->get_int('stores_id', 'post,get', 0);
	if(IDSITE>0)
		$stores_info = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores WHERE store_id = ' . IDSITE)->fetch(5);
	elseif($_SESSION[$module_data . '_store_id'] > 0)
		$stores_info = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores WHERE store_id = ' . $_SESSION[$module_data . '_store_id'])->fetch(5);
	elseif($_SESSION[$module_data . '_store_id'] == 0 && $row['stores_id']>0)
		$stores_info = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores WHERE store_id = ' . $row['stores_id'])->fetch(5);
	else
		$stores_info = new NukeViet\StoreHouse\Myclass;
	if ($nv_Request->isset_request('ajax_action', 'post')) {
	    $store_id = $nv_Request->get_int('store_id', 'post', 0);
	    $new_vid = $nv_Request->get_int('new_vid', 'post', 0);
	    $content = 'NO_' . $store_id;
	    if ($new_vid > 0)     {
	        $sql = 'SELECT store_id FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores WHERE store_id!=' . $store_id . ' ORDER BY sort_order ASC';
	        $result = $db->query($sql);
	        $sort_order = 0;
	        while ($row = $result->fetch())
	        {
	            ++$sort_order;
	            if ($sort_order == $new_vid) ++$sort_order;             $sql = 'UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores SET sort_order=' . $sort_order . ' WHERE store_id=' . $row['store_id'];
	            $db->query($sql);
	        }
	        $sql = 'UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores SET sort_order=' . $new_vid . ' WHERE store_id=' . $store_id;
	        $db->query($sql);
	        $content = 'OK_' . $store_id;
	    }
	    $nv_Cache->delMod($module_name);
	    include NV_ROOTDIR . '/includes/header.php';
	    echo $content;
	    include NV_ROOTDIR . '/includes/footer.php';
	}
	
	if ($nv_Request->isset_request('delete_store_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
	    $store_id = $nv_Request->get_int('delete_store_id', 'get');
	    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
	    if ($store_id > 0 and $delete_checkss == md5($store_id . NV_CACHE_PREFIX . $client_info['session_id'])) {
	        $sort_order=0;
	        $sql = 'SELECT sort_order FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores WHERE store_id =' . $db->quote($store_id);
	        $result = $db->query($sql);
	        list($sort_order) = $result->fetch(3);
	        $db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_store_of_category  WHERE store_id = ' . $db->quote($store_id));
	        $db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_users  WHERE storeid = ' . $db->quote($store_id));
	        $db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_users_stores  WHERE storeid = ' . $db->quote($store_id));
	        $db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores  WHERE store_id = ' . $db->quote($store_id));
	        if ($sort_order > 0)         {
	            $sql = 'SELECT store_id, sort_order FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores WHERE sort_order >' . $sort_order;
	            $result = $db->query($sql);
	            while (list($store_id, $sort_order) = $result->fetch(3))
	            {
	                $sort_order--;
	                $db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores SET sort_order=' . $sort_order . ' WHERE store_id=' . intval($store_id));
	            }
	        }
	        $nv_Cache->delMod($module_name);
	        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Stores', 'ID: ' . $store_id, $admin_info['userid']);
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }
	}
	
	
	$error = array();
	$row['store_id'] = $nv_Request->get_int('store_id', 'post,get', 0);
	
	if ($nv_Request->isset_request('submit', 'post')) {
	    $row['name'] = $nv_Request->get_title('name', 'post', '');
	    $row['url'] = $nv_Request->get_title('url', 'post', '');
	    $row['uid'] = $nv_Request->get_title('uid', 'post', '');
		$row['category'] = $nv_Request->get_array('category_id', 'post', array());
	    $row['category_id'] = implode(",",$row['category']);
	    if (empty($row['name'])) {
	        $error[] = $lang_module['error_required_name'];
	    }
		//print_r($row['store_id']);die;
	    if (empty($error)) {
	        try {
	            if (empty($row['store_id']) ) {
	                $stmt = $db->prepare('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores (name, category_id, parentid, url, userid, sort_order) VALUES (:name, :category_id, :parentid, :url, :uid, :sort_order)');
					
	                $weight = $db->query('SELECT max(sort_order) FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores')->fetchColumn();
	                $weight = intval($weight) + 1;
	                $stmt->bindParam(':sort_order', $weight, PDO::PARAM_INT);
					if($stores_info->parentid != 0){
						if(IDSITE>0)
							$parentid = $array_store_storehouse[$array_store_storehouse[IDSITE]['parentid']]['store_id'];
						else
							$parentid = $array_store_storehouse[$array_store_storehouse[$_SESSION[$module_data . '_store_id']]['parentid']]['store_id'];
					}elseif( $row['stores_id'] > 0){
						$parentid = $row['stores_id'];
					}else{
						if(IDSITE>0)
							$parentid = IDSITE;
						else
							$parentid = $_SESSION[$module_data . '_store_id'];
					}
	                $stmt->bindParam(':parentid',$parentid , PDO::PARAM_INT);
	                $stmt->bindParam(':uid', $stores_info->userid, PDO::PARAM_INT);
	
	
	            } else {
	                $stmt = $db->prepare('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores SET name = :name, url = :url, category_id= :category_id WHERE store_id=' . $row['store_id']);
	            }
	            $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
	            $stmt->bindParam(':url', $row['url'], PDO::PARAM_STR);
				$stmt->bindParam(':category_id', $row['category_id'], PDO::PARAM_STR);
	            $exc = $stmt->execute();
	            if ($exc) {
	            	if (empty($row['store_id'])) {
	            		$storeid=$db->Lastinsertid();
					}else{
						$storeid=$row['store_id'];
					}
	            	nv_fix_store_order();
					$db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_store_of_category WHERE category_id NOT IN (' . $row['category_id'] . ') and store_id = ' .  $storeid );
					foreach($row['category'] as $cate){
						$store_of_cat = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_store_of_category WHERE category_id = ' . $cate . ' AND store_id=' . $storeid)->fetch();
						if (empty($store_of_cat)) {
							
							$db->query('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_store_of_category(store_id, category_id) VALUES (' . $storeid . ',' . $cate . ')');
						}
					}
					$id=$db->query('SELECT setting_id FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_settings WHERE setting_id = ' . $storeid);
	            	if ($id->rowCount() == 0 && $storeid > 0) {
	            		$row['logo'] = '';
					    $row['logo2'] = '';
					    $row['site_name'] = '';
					    $row['language'] = '';
					    $row['default_warehouse'] = 0;
					    $row['accounting_method'] = 0;
					    $row['default_currency'] = '';
					    $row['default_tax_rate'] = 0;
					    $row['rows_per_page'] = 0;
					    $row['version'] = '1.0';
					    $row['default_tax_rate2'] = 0;
					    $row['dateformat'] = 0;
					    $row['sales_prefix'] = '';
					    $row['quote_prefix'] = '';
					    $row['purchase_prefix'] = '';
					    $row['transfer_prefix'] = '';
					    $row['delivery_prefix'] = '';
					    $row['payment_prefix'] = '';
					    $row['return_prefix'] = '';
					    $row['returnp_prefix'] = '';
					    $row['expense_prefix'] = '';
					    $row['item_addition'] = 0;
					    $row['theme'] = '';
					    $row['product_serial'] = 0;
					    $row['default_discount'] = 0;
					    $row['product_discount'] = 0;
					    $row['discount_method'] = 0;
					    $row['tax1'] = 0;
					    $row['tax2'] = 0;
					    $row['overselling'] = 0;
					    $row['restrict_user'] = 0;
					    $row['restrict_calendar'] = 0;
					    $row['timezone'] = '';
					    $row['iwidth'] = 0;
					    $row['iheight'] = 0;
					    $row['twidth'] = 0;
					    $row['theight'] = 0;
					    $row['watermark'] = 0;
					    $row['reg_ver'] = 0;
					    $row['allow_reg'] = 0;
					    $row['reg_notification'] = 0;
					    $row['auto_reg'] = 0;
					    $row['protocol'] = 'mail';
					    $row['mailpath'] = '/usr/sbin/sendmail';
					    $row['smtp_host'] = '';
					    $row['smtp_user'] = '';
					    $row['smtp_pass'] = '';
					    $row['smtp_port'] = '25';
					    $row['smtp_crypto'] = '';
					    $row['corn'] = '';
					    $row['customer_group'] = 0;
					    $row['default_email'] = '';
					    $row['mmode'] = 0;
					    $row['bc_fix'] = 0;
					    $row['auto_detect_barcode'] = 0;
					    $row['captcha'] = 1;
					    $row['reference_format'] = 1;
					    $row['racks'] = 0;
					    $row['attributes'] = 0;
					    $row['product_expiry'] = 0;
					    $row['decimals'] = 2;
					    $row['qty_decimals'] = 2;
					    $row['decimals_sep'] = '.';
					    $row['thousands_sep'] = ',';
					    $row['invoice_view'] = 0;
					    $row['default_biller'] = 0;
					    $row['envato_username'] = '';
					    $row['purchase_code'] = '';
					    $row['rtl'] = 0;
					    $row['each_spent'] = '';
					    $row['ca_point'] = 0;
					    $row['each_sale'] = '';
					    $row['sa_point'] = 0;
					    $row['update'] = 0;
					    $row['sac'] = 0;
					    $row['display_all_products'] = 0;
					    $row['display_symbol'] = 0;
					    $row['symbol'] = '';
					    $row['remove_expired'] = 0;
					    $row['barcode_separator'] = '-';
					    $row['set_focus'] = 0;
					    $row['price_group'] = 0;
					    $row['barcode_img'] = 1;
					    $row['ppayment_prefix'] = 'POP';
					    $row['disable_editing'] = 90;
					    $row['qa_prefix'] = '';
					    $row['update_cost'] = 0;
					    $row['apis'] = 0;
					    $row['state'] = '';
					    $row['pdf_lib'] = 'dompdf';
		                $stmt = $db->prepare('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_settings (setting_id, logo, logo2, site_name, language, default_warehouse, accounting_method, default_currency, default_tax_rate, rows_per_page, version, default_tax_rate2, dateformat, sales_prefix, quote_prefix, purchase_prefix, transfer_prefix, delivery_prefix, payment_prefix, return_prefix, returnp_prefix, expense_prefix, item_addition, theme, product_serial, default_discount, product_discount, discount_method, tax1, tax2, overselling, restrict_user, restrict_calendar, timezone, iwidth, iheight, twidth, theight, watermark, reg_ver, allow_reg, reg_notification, auto_reg, protocol, mailpath, smtp_host, smtp_user, smtp_pass, smtp_port, smtp_crypto, corn, customer_group, default_email, mmode, bc_fix, auto_detect_barcode, captcha, reference_format, racks, attributes, product_expiry, decimals, qty_decimals, decimals_sep, thousands_sep, invoice_view, default_biller, envato_username, purchase_code, rtl, each_spent, ca_point, each_sale, sa_point, supdate, sac, display_all_products, display_symbol, symbol, remove_expired, barcode_separator, set_focus, price_group, barcode_img, ppayment_prefix, disable_editing, qa_prefix, update_cost, apis, state, pdf_lib) VALUES (' . $storeid . ', :logo, :logo2, :site_name, :language, :default_warehouse, :accounting_method, :default_currency, :default_tax_rate, :rows_per_page, :version, :default_tax_rate2, :dateformat, :sales_prefix, :quote_prefix, :purchase_prefix, :transfer_prefix, :delivery_prefix, :payment_prefix, :return_prefix, :returnp_prefix, :expense_prefix, :item_addition, :theme, :product_serial, :default_discount, :product_discount, :discount_method, :tax1, :tax2, :overselling, :restrict_user, :restrict_calendar, :timezone, :iwidth, :iheight, :twidth, :theight, :watermark, :reg_ver, :allow_reg, :reg_notification, :auto_reg, :protocol, :mailpath, :smtp_host, :smtp_user, :smtp_pass, :smtp_port, :smtp_crypto, :corn, :customer_group, :default_email, :mmode, :bc_fix, :auto_detect_barcode, :captcha, :reference_format, :racks, :attributes, :product_expiry, :decimals, :qty_decimals, :decimals_sep, :thousands_sep, :invoice_view, :default_biller, :envato_username, :purchase_code, :rtl, :each_spent, :ca_point, :each_sale, :sa_point, :update, :sac, :display_all_products, :display_symbol, :symbol, :remove_expired, :barcode_separator, :set_focus, :price_group, :barcode_img, :ppayment_prefix, :disable_editing, :qa_prefix, :update_cost, :apis, :state, :pdf_lib)');
						$stmt->bindParam(':logo', $row['logo'], PDO::PARAM_STR);
			            $stmt->bindParam(':logo2', $row['logo2'], PDO::PARAM_STR);
			            $stmt->bindParam(':site_name', $row['site_name'], PDO::PARAM_STR);
			            $stmt->bindParam(':language', $row['language'], PDO::PARAM_STR);
			            $stmt->bindParam(':default_warehouse', $row['default_warehouse'], PDO::PARAM_INT);
			            $stmt->bindParam(':accounting_method', $row['accounting_method'], PDO::PARAM_INT);
			            $stmt->bindParam(':default_currency', $row['default_currency'], PDO::PARAM_STR);
			            $stmt->bindParam(':default_tax_rate', $row['default_tax_rate'], PDO::PARAM_INT);
			            $stmt->bindParam(':rows_per_page', $row['rows_per_page'], PDO::PARAM_INT);
			            $stmt->bindParam(':version', $row['version'], PDO::PARAM_STR);
			            $stmt->bindParam(':default_tax_rate2', $row['default_tax_rate2'], PDO::PARAM_INT);
			            $stmt->bindParam(':dateformat', $row['dateformat'], PDO::PARAM_INT);
			            $stmt->bindParam(':sales_prefix', $row['sales_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':quote_prefix', $row['quote_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':purchase_prefix', $row['purchase_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':transfer_prefix', $row['transfer_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':delivery_prefix', $row['delivery_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':payment_prefix', $row['payment_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':return_prefix', $row['return_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':returnp_prefix', $row['returnp_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':expense_prefix', $row['expense_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':item_addition', $row['item_addition'], PDO::PARAM_INT);
			            $stmt->bindParam(':theme', $row['theme'], PDO::PARAM_STR);
			            $stmt->bindParam(':product_serial', $row['product_serial'], PDO::PARAM_INT);
			            $stmt->bindParam(':default_discount', $row['default_discount'], PDO::PARAM_INT);
			            $stmt->bindParam(':product_discount', $row['product_discount'], PDO::PARAM_INT);
			            $stmt->bindParam(':discount_method', $row['discount_method'], PDO::PARAM_INT);
			            $stmt->bindParam(':tax1', $row['tax1'], PDO::PARAM_INT);
			            $stmt->bindParam(':tax2', $row['tax2'], PDO::PARAM_INT);
			            $stmt->bindParam(':overselling', $row['overselling'], PDO::PARAM_INT);
			            $stmt->bindParam(':restrict_user', $row['restrict_user'], PDO::PARAM_INT);
			            $stmt->bindParam(':restrict_calendar', $row['restrict_calendar'], PDO::PARAM_INT);
			            $stmt->bindParam(':timezone', $row['timezone'], PDO::PARAM_STR);
			            $stmt->bindParam(':iwidth', $row['iwidth'], PDO::PARAM_INT);
			            $stmt->bindParam(':iheight', $row['iheight'], PDO::PARAM_INT);
			            $stmt->bindParam(':twidth', $row['twidth'], PDO::PARAM_INT);
			            $stmt->bindParam(':theight', $row['theight'], PDO::PARAM_INT);
			            $stmt->bindParam(':watermark', $row['watermark'], PDO::PARAM_INT);
			            $stmt->bindParam(':reg_ver', $row['reg_ver'], PDO::PARAM_INT);
			            $stmt->bindParam(':allow_reg', $row['allow_reg'], PDO::PARAM_INT);
			            $stmt->bindParam(':reg_notification', $row['reg_notification'], PDO::PARAM_INT);
			            $stmt->bindParam(':auto_reg', $row['auto_reg'], PDO::PARAM_INT);
			            $stmt->bindParam(':protocol', $row['protocol'], PDO::PARAM_STR);
			            $stmt->bindParam(':mailpath', $row['mailpath'], PDO::PARAM_STR);
			            $stmt->bindParam(':smtp_host', $row['smtp_host'], PDO::PARAM_STR);
			            $stmt->bindParam(':smtp_user', $row['smtp_user'], PDO::PARAM_STR);
			            $stmt->bindParam(':smtp_pass', $row['smtp_pass'], PDO::PARAM_STR);
			            $stmt->bindParam(':smtp_port', $row['smtp_port'], PDO::PARAM_STR);
			            $stmt->bindParam(':smtp_crypto', $row['smtp_crypto'], PDO::PARAM_STR);
			            $stmt->bindParam(':corn', $row['corn'], PDO::PARAM_STR);
			            $stmt->bindParam(':customer_group', $row['customer_group'], PDO::PARAM_INT);
			            $stmt->bindParam(':default_email', $row['default_email'], PDO::PARAM_STR);
			            $stmt->bindParam(':mmode', $row['mmode'], PDO::PARAM_INT);
			            $stmt->bindParam(':bc_fix', $row['bc_fix'], PDO::PARAM_INT);
			            $stmt->bindParam(':auto_detect_barcode', $row['auto_detect_barcode'], PDO::PARAM_INT);
			            $stmt->bindParam(':captcha', $row['captcha'], PDO::PARAM_INT);
			            $stmt->bindParam(':reference_format', $row['reference_format'], PDO::PARAM_INT);
			            $stmt->bindParam(':racks', $row['racks'], PDO::PARAM_INT);
			            $stmt->bindParam(':attributes', $row['attributes'], PDO::PARAM_INT);
			            $stmt->bindParam(':product_expiry', $row['product_expiry'], PDO::PARAM_INT);
			            $stmt->bindParam(':decimals', $row['decimals'], PDO::PARAM_INT);
			            $stmt->bindParam(':qty_decimals', $row['qty_decimals'], PDO::PARAM_INT);
			            $stmt->bindParam(':decimals_sep', $row['decimals_sep'], PDO::PARAM_STR);
			            $stmt->bindParam(':thousands_sep', $row['thousands_sep'], PDO::PARAM_STR);
			            $stmt->bindParam(':invoice_view', $row['invoice_view'], PDO::PARAM_INT);
			            $stmt->bindParam(':default_biller', $row['default_biller'], PDO::PARAM_INT);
			            $stmt->bindParam(':envato_username', $row['envato_username'], PDO::PARAM_STR);
			            $stmt->bindParam(':purchase_code', $row['purchase_code'], PDO::PARAM_STR);
			            $stmt->bindParam(':rtl', $row['rtl'], PDO::PARAM_INT);
			            $stmt->bindParam(':each_spent', $row['each_spent'], PDO::PARAM_STR);
			            $stmt->bindParam(':ca_point', $row['ca_point'], PDO::PARAM_INT);
			            $stmt->bindParam(':each_sale', $row['each_sale'], PDO::PARAM_STR);
			            $stmt->bindParam(':sa_point', $row['sa_point'], PDO::PARAM_INT);
			            $stmt->bindParam(':update', $row['update'], PDO::PARAM_INT);
			            $stmt->bindParam(':sac', $row['sac'], PDO::PARAM_INT);
			            $stmt->bindParam(':display_all_products', $row['display_all_products'], PDO::PARAM_INT);
			            $stmt->bindParam(':display_symbol', $row['display_symbol'], PDO::PARAM_INT);
			            $stmt->bindParam(':symbol', $row['symbol'], PDO::PARAM_STR);
			            $stmt->bindParam(':remove_expired', $row['remove_expired'], PDO::PARAM_INT);
			            $stmt->bindParam(':barcode_separator', $row['barcode_separator'], PDO::PARAM_STR);
			            $stmt->bindParam(':set_focus', $row['set_focus'], PDO::PARAM_INT);
			            $stmt->bindParam(':price_group', $row['price_group'], PDO::PARAM_INT);
			            $stmt->bindParam(':barcode_img', $row['barcode_img'], PDO::PARAM_INT);
			            $stmt->bindParam(':ppayment_prefix', $row['ppayment_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':disable_editing', $row['disable_editing'], PDO::PARAM_INT);
			            $stmt->bindParam(':qa_prefix', $row['qa_prefix'], PDO::PARAM_STR);
			            $stmt->bindParam(':update_cost', $row['update_cost'], PDO::PARAM_INT);
			            $stmt->bindParam(':apis', $row['apis'], PDO::PARAM_INT);
			            $stmt->bindParam(':state', $row['state'], PDO::PARAM_STR);
			            $stmt->bindParam(':pdf_lib', $row['pdf_lib'], PDO::PARAM_STR);
						$exc = $stmt->execute();
		            }
					//print_r($storeid);die;
					$user_store=$db->query('SELECT userid FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_users_stores WHERE storeid = ' . $storeid . ' AND chain=1')->fetch(5)->userid; 
	                if($user_store == 0 && $storeid > 0){ 
	                	$db->query('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_users_stores (userid,storeid,chain)  VALUE (' . $stores_info->userid . ',' . $storeid . ' ,1) '); 
	                	//$db->query('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_users (userid,storeid,is_staff)  VALUE (' . $stores_info->userid . ',' . $storeid . ' ,1) '); 
	                }else{
	                	if(IDSITE>0){
	                		if(IDSITE > 0)
								$db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_users_stores SET userid = ' . $stores_info->userid . ' WHERE storeid=' . $storeid); 
							else
								$db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_users_stores SET userid = ' . $user_store . ' WHERE storeid=' . $storeid); 
		                	
	                	}else{
	                		if($_SESSION[$module_data . '_store_id'] > 0)
								$db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_users_stores SET userid = ' . $stores_info->userid . ' WHERE storeid=' . $storeid); 
							else
								$db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_users_stores SET userid = ' . $user_store . ' WHERE storeid=' . $storeid); 
		                	
	                	}
	                	
	                	//$db->query('UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_users SET storeid = ' . $storeid . ' WHERE userid =' . $stores_info->userid ); 
	                }
	                $nv_Cache->delMod($module_name);
	                if (empty($row['store_id'])) {
	                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Stores', ' ', $admin_info['userid']);
	                } else {
	                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Stores', 'ID: ' . $row['store_id'], $admin_info['userid']);
	                }
	                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	            }
	        } catch(PDOException $e) {
	            trigger_error($e->getMessage());
	            die($e->getMessage()); //Remove this line after checks finished
	        }
	    }
	} elseif ($row['store_id'] > 0) {
	    $row = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stores WHERE store_id=' . $row['store_id'])->fetch();
	    if (empty($row)) {
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }
	} else {
	    $row['store_id'] = 0;
	    $row['name'] = '';
	    $row['url'] = '';
		$row['category_id']=0;
		$row['parentid']=0;
	}
	
	$q = $nv_Request->get_title('q', 'post,get');
	// Fetch Limit
	$show_view = false;
	if (!$nv_Request->isset_request('id', 'post,get')) {
		if(IDSITE>0)
			$parentid = IDSITE;
			
		else{
			$parentid = $_SESSION[$module_data . '_store_id'];
		
			if(count($array_store_storehouse_user) > 1 ){
				foreach ($array_store_storehouse_user as $stores_id => $stores) {
					foreach ($array_store_storehouse as $store_id => $store) {
						if ($store['store_id'] == $_SESSION[$module_data . '_store_id'] && $store['parentid'] ==$stores_id){
							$parentid = $store['parentid'];
						}
					}
				}
			}elseif($_SESSION[$module_data . '_store_id']>0 && defined('NV_IS_GODADMIN')){
				foreach ($array_store_storehouse as $store_id => $store) {
					if ($store['store_id'] == $_SESSION[$module_data . '_store_id'] && $store['parentid'] != 0){
						$parentid = $store['parentid'];
					}
				}
				
			}
		}
		
	    $show_view = true;
	    $per_page = 20;
	    $page = $nv_Request->get_int('page', 'post,get', 1);
		if(MULTICOMPANY == true){
			if(IDSITE>0){
				$where = 'parentid='. $parentid;
			}else{
				if($_SESSION[$module_data . '_store_id']>0)
					$where = 'parentid='. $parentid;
				else{
					$where = "parentid!=0";
				}
			}
		}else{
			$row['parentid'] = $nv_Request->get_int('parentid', 'get', 0);
			$where = "parentid =" . $row['parentid'];
		}
		
		
	    $db->sqlreset()
	        ->select('COUNT(*)')
	        ->from($db_config['dbsystem'] . '.' . '' . $db_config['prefix'] . '_' . $module_data . '_stores')
			->where($where);
	
	    if (!empty($q)) {
	        $db->where('name LIKE :q_name OR url LIKE :q_url');
	    }
	    $sth = $db->prepare($db->sql());
	
	    if (!empty($q)) {
	        $sth->bindValue(':q_name', '%' . $q . '%');
	        $sth->bindValue(':q_url', '%' . $q . '%');
	    }
	    $sth->execute();
	    $num_items = $sth->fetchColumn();
	
	    $db->select('*')
	        ->order('sort_order ASC')
	        ->limit($per_page)
	        ->offset(($page - 1) * $per_page);
	    $sth = $db->prepare($db->sql());
	
	    if (!empty($q)) {
	        $sth->bindValue(':q_name', '%' . $q . '%');
	        $sth->bindValue(':q_url', '%' . $q . '%');
	    }
	    $sth->execute();
	}
	if(IDSITE>0){
		if($row['store_id'] > 0 && $row['parentid'] >0 )
			$array_category_parent=explode(",",$array_store_storehouse[$row['parentid']]['category_id']);
		elseif(($row['store_id'] == 0 && count($array_store_storehouse_user) == 1) || (IDSITE > 0 && (defined('NV_IS_GODADMIN') || defined('NV_IS_SPADMIN'))))
		{
			if(IDSITE == $parentid)
				$array_category_parent=explode(",",$array_store_storehouse[IDSITE]['category_id']);
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
		
	}else{
		if($row['store_id'] > 0 && $row['parentid'] >0 )
			$array_category_parent=explode(",",$array_store_storehouse[$row['parentid']]['category_id']);
		elseif(($row['store_id'] == 0 && count($array_store_storehouse_user) == 1) || ($_SESSION[$module_data . '_store_id'] > 0 && (defined('NV_IS_GODADMIN') || defined('NV_IS_SPADMIN'))))
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
	}
	
	$array_category_id_storehouse_of_category=array();
	foreach ($array_category_id_storehouse as $value) {
		if(IDSITE>0){
			if(in_array($value['id'], $array_category_parent) && $row['store_id']>0){
				$array_category_id_storehouse_of_category[$value['id']] = $value;
			}elseif(in_array($value['id'], $array_category_parent)  && count($array_store_storehouse_user) == 1){
				$array_category_id_storehouse_of_category[$value['id']] = $value;
			}elseif(IDSITE == 0 && (defined('NV_IS_GODADMIN') || defined('NV_IS_SPADMIN'))){
				$array_category_id_storehouse_of_category[$value['id']] = $value;
			}elseif(in_array($value['id'], $array_category_parent)  && IDSITE > 0 && (defined('NV_IS_GODADMIN') || defined('NV_IS_SPADMIN'))){
				$array_category_id_storehouse_of_category[$value['id']] = $value;
			}
		}else{
			if(in_array($value['id'], $array_category_parent) && $row['store_id']>0){
				$array_category_id_storehouse_of_category[$value['id']] = $value;
			}elseif(in_array($value['id'], $array_category_parent)  && count($array_store_storehouse_user) == 1){
				$array_category_id_storehouse_of_category[$value['id']] = $value;
			}elseif($_SESSION[$module_data . '_store_id'] == 0 && (defined('NV_IS_GODADMIN') || defined('NV_IS_SPADMIN'))){
				$array_category_id_storehouse_of_category[$value['id']] = $value;
			}elseif(in_array($value['id'], $array_category_parent)  && $_SESSION[$module_data . '_store_id'] > 0 && (defined('NV_IS_GODADMIN') || defined('NV_IS_SPADMIN'))){
				$array_category_id_storehouse_of_category[$value['id']] = $value;
			}
		}
		
	}
	$xtpl = new XTemplate('store.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
	$xtpl->assign('LANG', $lang_module);
	$xtpl->assign('GLANG', $lang_global);
	$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
	$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
	$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
	$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
	$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
	$xtpl->assign('MODULE_NAME', $module_name);
	$xtpl->assign('MODULE_UPLOAD', $module_upload);
	$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
	$xtpl->assign('OP', $op);
	$xtpl->assign('MODULE_URL', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE);
	$xtpl->assign('ROW', $row);
	if(MULTICOMPANY == true){
		if(IDSITE>0){
			if(IDSITE==0)
			{
				foreach ($array_store_storehouse as $storeid => $stores) {
					if($stores['parentid'] == 0){
						$stores['selected'] = ($stores['store_id'] ==$row['parentid'])? 'selected="selected"' : ''; 
						$xtpl->assign('STORES', $stores);
						$xtpl->parse('main.admin_stores.select_stores');
					}
				}
				$xtpl->parse('main.admin_stores');
			}else{
				$xtpl->assign('STORES_ID', $parentid);
				$xtpl->parse('main.stores');
			}
		}else{
			if($_SESSION[$module_data . '_store_id']==0)
			{
				foreach ($array_store_storehouse as $storeid => $stores) {
					if($stores['parentid'] == 0){
						$stores['selected'] = ($stores['store_id'] ==$row['parentid'])? 'selected="selected"' : ''; 
						$xtpl->assign('STORES', $stores);
						$xtpl->parse('main.admin_stores.select_stores');
					}
				}
				$xtpl->parse('main.admin_stores');
			}else{
				$xtpl->assign('STORES_ID', $parentid);
				$xtpl->parse('main.stores');
			}
		}
	}elseif(defined('NV_IS_GODADMIN') && $row['parentid'] != 0){
		foreach ($array_store_storehouse as $storeid => $stores) {
			$lev_i = $store['lev'];
			$xtitle_i = '';
			if ($lev_i > 0) {
				$xtitle_i .= '&nbsp;&nbsp;&nbsp;|';
				for ($i = 1; $i <= $lev_i; ++$i) {
					$xtitle_i .= '---';
				}
				$xtitle_i .= '>&nbsp;';
			}
			$xtitle_i .= $store['name'];
			$sl = '';
			$stores['selected'] = ($stores['store_id'] ==$row['parentid'])? 'selected="selected"' : ''; 
			$xtpl->assign('STORES', $stores);
			$xtpl->parse('main.admin_stores.select_stores');
		}
		$xtpl->parse('main.admin_stores');
	}
	
		
	$xtpl->assign('Q', $q);
	
	if ($show_view) {
	    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
	    if (!empty($q)) {
	        $base_url .= '&q=' . $q;
	    }
	    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
	    if (!empty($generate_page)) {
	        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
	        $xtpl->parse('main.view.generate_page');
	    }
	    $number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
	    while ($view = $sth->fetch()) {
	        for($i = 1; $i <= $num_items; ++$i) {
	            $xtpl->assign('WEIGHT', array(
	                'key' => $i,
	                'title' => $i,
	                'selected' => ($i == $view['sort_order']) ? ' selected="selected"' : ''));
	            $xtpl->parse('main.view.loop.sort_order_loop');
	        }
	        $view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;parentid=' . $view['parentid'] . '&amp;store_id=' . $view['store_id'];
	        $view['link_view'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;parentid=' . $view['store_id'];
	        $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_store_id=' . $view['store_id'] . '&amp;delete_checkss=' . md5($view['store_id'] . NV_CACHE_PREFIX . $client_info['session_id']);
	        $xtpl->assign('VIEW', $view);
	        $xtpl->parse('main.view.loop');
	    }
	    $xtpl->parse('main.view');
	}
	
	
	if (!empty($error)) {
	    $xtpl->assign('ERROR', implode('<br />', $error));
	    $xtpl->parse('main.error');
	}
	if($row['store_id']>0 && $row['parentid']>0){
		$row['category'] = explode(",",$array_store_storehouse[$row['parentid']]['category_id']);
	}else{
		$row['category'] = array();
	}
	
	
	foreach ($array_category_id_storehouse_of_category as $value) {
		
		if(in_array($value['id'], $row['category'])){
			$sl = ' selected="selected"';
		} else {
			$sl = '';
		}  
	    $xtpl->assign('OPTION', array(
	        'key' => $value['id'],
	        'title' => $value['name'],
	        'selected' => $sl
	    ));
	    $xtpl->parse('main.select_category_id');
	}
	$xtpl->parse('main');
	$contents = $xtpl->text('main');
	
	$page_title = $title_manager_store;
	
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme($contents);
	include NV_ROOTDIR . '/includes/footer.php';
