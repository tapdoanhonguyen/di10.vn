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
print_r($global_config);
if($_SESSION[$module_data . '_store_id'] > 0){
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
	if ($nv_Request->isset_request('delete_setting_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
	    $setting_id = $nv_Request->get_int('delete_setting_id', 'get');
	    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
	    if ($setting_id > 0 and $delete_checkss == md5($setting_id . NV_CACHE_PREFIX . $client_info['session_id'])) {
	        $db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_settings  WHERE setting_id = ' . $db->quote($setting_id));
	        $nv_Cache->delMod($module_name);
	        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Config', 'ID: ' . $setting_id, $admin_info['userid']);
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }
	}
	
	$row = array();
	$error = array();
	$row['setting_id'] = $_SESSION[$module_data . '_store_id'];
	if ($nv_Request->isset_request('submit', 'post')) {
	    $row['logo'] = $nv_Request->get_title('logo', 'post', '');
	    $row['logo2'] = $nv_Request->get_title('logo2', 'post', '');
	    $row['site_name'] = $nv_Request->get_title('site_name', 'post', '');
	    $row['language'] = $nv_Request->get_title('language', 'post', '');
	    $row['default_warehouse'] = $nv_Request->get_int('default_warehouse', 'post', 0);
	    $row['accounting_method'] = $nv_Request->get_int('accounting_method', 'post', 0);
	    $row['default_currency'] = $nv_Request->get_title('default_currency', 'post', '');
	    $row['default_tax_rate'] = $nv_Request->get_int('default_tax_rate', 'post', 0);
	    $row['rows_per_page'] = $nv_Request->get_int('rows_per_page', 'post', 0);
	    $row['version'] = $nv_Request->get_title('version', 'post', '');
	    $row['default_tax_rate2'] = $nv_Request->get_int('default_tax_rate2', 'post', 0);
	    $row['dateformat'] = $nv_Request->get_int('dateformat', 'post', 0);
	    $row['product_prefix'] = $nv_Request->get_title('product_prefix', 'post', '');
	    $row['sales_prefix'] = $nv_Request->get_title('sales_prefix', 'post', '');
	    $row['quote_prefix'] = $nv_Request->get_title('quote_prefix', 'post', '');
	    $row['purchase_prefix'] = $nv_Request->get_title('purchase_prefix', 'post', '');
	    $row['transfer_prefix'] = $nv_Request->get_title('transfer_prefix', 'post', '');
	    $row['delivery_prefix'] = $nv_Request->get_title('delivery_prefix', 'post', '');
	    $row['payment_prefix'] = $nv_Request->get_title('payment_prefix', 'post', '');
	    $row['return_prefix'] = $nv_Request->get_title('return_prefix', 'post', '');
	    $row['returnp_prefix'] = $nv_Request->get_title('returnp_prefix', 'post', '');
	    $row['expense_prefix'] = $nv_Request->get_title('expense_prefix', 'post', '');
	    $row['item_addition'] = $nv_Request->get_int('item_addition', 'post', 0);
	    $row['theme'] = $nv_Request->get_title('theme', 'post', '');
	    $row['product_serial'] = $nv_Request->get_int('product_serial', 'post', 0);
	    $row['default_discount'] = $nv_Request->get_int('default_discount', 'post', 0);
	    $row['product_discount'] = $nv_Request->get_int('product_discount', 'post', 0);
	    $row['discount_method'] = $nv_Request->get_int('discount_method', 'post', 0);
	    $row['tax1'] = $nv_Request->get_int('tax1', 'post', 0);
	    $row['tax2'] = $nv_Request->get_int('tax2', 'post', 0);
	    $row['overselling'] = $nv_Request->get_int('overselling', 'post', 0);
	    $row['restrict_user'] = $nv_Request->get_int('restrict_user', 'post', 0);
	    $row['restrict_calendar'] = $nv_Request->get_int('restrict_calendar', 'post', 0);
	    $row['timezone'] = $nv_Request->get_title('timezone', 'post', '');
	    $row['iwidth'] = $nv_Request->get_int('iwidth', 'post', 0);
	    $row['iheight'] = $nv_Request->get_int('iheight', 'post', 0);
	    $row['twidth'] = $nv_Request->get_int('twidth', 'post', 0);
	    $row['theight'] = $nv_Request->get_int('theight', 'post', 0);
	    $row['watermark'] = $nv_Request->get_int('watermark', 'post', 0);
	    $row['reg_ver'] = $nv_Request->get_int('reg_ver', 'post', 0);
	    $row['allow_reg'] = $nv_Request->get_int('allow_reg', 'post', 0);
	    $row['reg_notification'] = $nv_Request->get_int('reg_notification', 'post', 0);
	    $row['auto_reg'] = $nv_Request->get_int('auto_reg', 'post', 0);
	    $row['protocol'] = $nv_Request->get_title('protocol', 'post', '');
	    $row['mailpath'] = $nv_Request->get_title('mailpath', 'post', '');
	    $row['smtp_host'] = $nv_Request->get_title('smtp_host', 'post', '');
	    $row['smtp_user'] = $nv_Request->get_title('smtp_user', 'post', '');
	    $row['smtp_pass'] = $nv_Request->get_title('smtp_pass', 'post', '');
	    $row['smtp_port'] = $nv_Request->get_title('smtp_port', 'post', '');
	    $row['smtp_crypto'] = $nv_Request->get_title('smtp_crypto', 'post', '');
	    $row['corn'] = $nv_Request->get_title('corn', 'post', '');
	    $row['customer_group'] = $nv_Request->get_int('customer_group', 'post', 0);
	    $row['default_email'] = $nv_Request->get_title('default_email', 'post', '');
	    $row['mmode'] = $nv_Request->get_int('mmode', 'post', 0);
	    $row['bc_fix'] = $nv_Request->get_int('bc_fix', 'post', 0);
	    $row['auto_detect_barcode'] = $nv_Request->get_int('auto_detect_barcode', 'post', 0);
	    $row['captcha'] = $nv_Request->get_int('captcha', 'post', 0);
	    $row['reference_format'] = $nv_Request->get_int('reference_format', 'post', 0);
	    $row['racks'] = $nv_Request->get_int('racks', 'post', 0);
	    $row['attributes'] = $nv_Request->get_int('attributes', 'post', 0);
	    $row['product_expiry'] = $nv_Request->get_int('product_expiry', 'post', 0);
	    $row['decimals'] = $nv_Request->get_int('decimals', 'post', 0);
	    $row['qty_decimals'] = $nv_Request->get_int('qty_decimals', 'post', 0);
	    $row['decimals_sep'] = $nv_Request->get_title('decimals_sep', 'post', '');
	    $row['thousands_sep'] = $nv_Request->get_title('thousands_sep', 'post', '');
	    $row['invoice_view'] = $nv_Request->get_int('invoice_view', 'post', 0);
	    $row['default_biller'] = $nv_Request->get_int('default_biller', 'post', 0);
	    $row['envato_username'] = $nv_Request->get_title('envato_username', 'post', '');
	    $row['purchase_code'] = $nv_Request->get_title('purchase_code', 'post', '');
	    $row['rtl'] = $nv_Request->get_int('rtl', 'post', 0);
	    $row['each_spent'] = $nv_Request->get_title('each_spent', 'post', '');
	    $row['ca_point'] = $nv_Request->get_int('ca_point', 'post', 0);
	    $row['each_sale'] = $nv_Request->get_title('each_sale', 'post', '');
	    $row['sa_point'] = $nv_Request->get_int('sa_point', 'post', 0);
	    $row['update'] = $nv_Request->get_int('update', 'post', 0);
	    $row['sac'] = $nv_Request->get_int('sac', 'post', 0);
	    $row['display_all_products'] = $nv_Request->get_int('display_all_products', 'post', 0);
	    $row['display_symbol'] = $nv_Request->get_int('display_symbol', 'post', 0);
	    $row['symbol'] = $nv_Request->get_title('symbol', 'post', '');
	    $row['remove_expired'] = $nv_Request->get_int('remove_expired', 'post', 0);
	    $row['barcode_separator'] = $nv_Request->get_title('barcode_separator', 'post', '');
	    $row['set_focus'] = $nv_Request->get_int('set_focus', 'post', 0);
	    $row['price_group'] = $nv_Request->get_int('price_group', 'post', 0);
	    $row['barcode_img'] = $nv_Request->get_int('barcode_img', 'post', 0);
	    $row['ppayment_prefix'] = $nv_Request->get_title('ppayment_prefix', 'post', '');
	    $row['disable_editing'] = $nv_Request->get_int('disable_editing', 'post', 0);
	    $row['qa_prefix'] = $nv_Request->get_title('qa_prefix', 'post', '');
	    $row['update_cost'] = $nv_Request->get_int('update_cost', 'post', 0);
	    $row['apis'] = $nv_Request->get_int('apis', 'post', 0);
	    $row['state'] = $nv_Request->get_title('state', 'post', '');
	    $row['pdf_lib'] = $nv_Request->get_title('pdf_lib', 'post', '');
	
	    if (empty($error)) {
	        try {
	            if ($row['setting_id']<0) {
	                $stmt = $db->prepare('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_settings (setting_id, logo, logo2, site_name, language, default_warehouse, accounting_method, default_currency, default_tax_rate, rows_per_page, version, default_tax_rate2, dateformat, product_prefix, sales_prefix, quote_prefix, purchase_prefix, transfer_prefix, delivery_prefix, payment_prefix, return_prefix, returnp_prefix, expense_prefix, item_addition, theme, product_serial, default_discount, product_discount, discount_method, tax1, tax2, overselling, restrict_user, restrict_calendar, timezone, iwidth, iheight, twidth, theight, watermark, reg_ver, allow_reg, reg_notification, auto_reg, protocol, mailpath, smtp_host, smtp_user, smtp_pass, smtp_port, smtp_crypto, corn, customer_group, default_email, mmode, bc_fix, auto_detect_barcode, captcha, reference_format, racks, attributes, product_expiry, decimals, qty_decimals, decimals_sep, thousands_sep, invoice_view, default_biller, envato_username, purchase_code, rtl, each_spent, ca_point, each_sale, sa_point, supdate, sac, display_all_products, display_symbol, symbol, remove_expired, barcode_separator, set_focus, price_group, barcode_img, ppayment_prefix, disable_editing, qa_prefix, update_cost, apis, state, pdf_lib) VALUES (:logo, :logo2, :site_name, :language, :default_warehouse, :accounting_method, :default_currency, :default_tax_rate, :rows_per_page, :version, :default_tax_rate2, :dateformat, :product_prefix, :sales_prefix, :quote_prefix, :purchase_prefix, :transfer_prefix, :delivery_prefix, :payment_prefix, :return_prefix, :returnp_prefix, :expense_prefix, :item_addition, :theme, :product_serial, :default_discount, :product_discount, :discount_method, :tax1, :tax2, :overselling, :restrict_user, :restrict_calendar, :timezone, :iwidth, :iheight, :twidth, :theight, :watermark, :reg_ver, :allow_reg, :reg_notification, :auto_reg, :protocol, :mailpath, :smtp_host, :smtp_user, :smtp_pass, :smtp_port, :smtp_crypto, :corn, :customer_group, :default_email, :mmode, :bc_fix, :auto_detect_barcode, :captcha, :reference_format, :racks, :attributes, :product_expiry, :decimals, :qty_decimals, :decimals_sep, :thousands_sep, :invoice_view, :default_biller, :envato_username, :purchase_code, :rtl, :each_spent, :ca_point, :each_sale, :sa_point, :update, :sac, :display_all_products, :display_symbol, :symbol, :remove_expired, :barcode_separator, :set_focus, :price_group, :barcode_img, :ppayment_prefix, :disable_editing, :qa_prefix, :update_cost, :apis, :state, :pdf_lib)');
	            } else {
	                $stmt = $db->prepare('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_settings SET logo = :logo, logo2 = :logo2, site_name = :site_name, language = :language, default_warehouse = :default_warehouse, accounting_method = :accounting_method, default_currency = :default_currency, default_tax_rate = :default_tax_rate, rows_per_page = :rows_per_page, version = :version, default_tax_rate2 = :default_tax_rate2, dateformat = :dateformat, product_prefix = :product_prefix, sales_prefix = :sales_prefix, quote_prefix = :quote_prefix, purchase_prefix = :purchase_prefix, transfer_prefix = :transfer_prefix, delivery_prefix = :delivery_prefix, payment_prefix = :payment_prefix, return_prefix = :return_prefix, returnp_prefix = :returnp_prefix, expense_prefix = :expense_prefix, item_addition = :item_addition, theme = :theme, product_serial = :product_serial, default_discount = :default_discount, product_discount = :product_discount, discount_method = :discount_method, tax1 = :tax1, tax2 = :tax2, overselling = :overselling, restrict_user = :restrict_user, restrict_calendar = :restrict_calendar, timezone = :timezone, iwidth = :iwidth, iheight = :iheight, twidth = :twidth, theight = :theight, watermark = :watermark, reg_ver = :reg_ver, allow_reg = :allow_reg, reg_notification = :reg_notification, auto_reg = :auto_reg, protocol = :protocol, mailpath = :mailpath, smtp_host = :smtp_host, smtp_user = :smtp_user, smtp_pass = :smtp_pass, smtp_port = :smtp_port, smtp_crypto = :smtp_crypto, corn = :corn, customer_group = :customer_group, default_email = :default_email, mmode = :mmode, bc_fix = :bc_fix, auto_detect_barcode = :auto_detect_barcode, captcha = :captcha, reference_format = :reference_format, racks = :racks, attributes = :attributes, product_expiry = :product_expiry, decimals = :decimals, qty_decimals = :qty_decimals, decimals_sep = :decimals_sep, thousands_sep = :thousands_sep, invoice_view = :invoice_view, default_biller = :default_biller, envato_username = :envato_username, purchase_code = :purchase_code, rtl = :rtl, each_spent = :each_spent, ca_point = :ca_point, each_sale = :each_sale, sa_point = :sa_point, supdate = :update, sac = :sac, display_all_products = :display_all_products, display_symbol = :display_symbol, symbol = :symbol, remove_expired = :remove_expired, barcode_separator = :barcode_separator, set_focus = :set_focus, price_group = :price_group, barcode_img = :barcode_img, ppayment_prefix = :ppayment_prefix, disable_editing = :disable_editing, qa_prefix = :qa_prefix, update_cost = :update_cost, apis = :apis, state = :state, pdf_lib = :pdf_lib WHERE setting_id=' . $row['setting_id']);
	            }
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
	            $stmt->bindParam(':product_prefix', $row['product_prefix'], PDO::PARAM_STR);
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
	            if ($exc) {
	                $nv_Cache->delMod($module_name);
	                if (empty($row['setting_id'])) {
	                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Config', ' ', $admin_info['userid']);
	                } else {
	                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Config', 'ID: ' . $row['setting_id'], $admin_info['userid']);
	                }
	                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	            }
	        } catch(PDOException $e) {
	            trigger_error($e->getMessage());
	            die($e->getMessage()); //Remove this line after checks finished
	        }
	    }
	} elseif ($row['setting_id'] > 0) {
		//print_r('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_settings WHERE setting_id=' . $row['setting_id']);
	    $row = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_settings WHERE setting_id=' . $row['setting_id'])->fetch();
	   //print_r($row);
	    if (empty($row)) {
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }
	} else {
	    $row['setting_id'] = $_SESSION[$module_data . '_store_id'];
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
	    $row['product_prefix'] = 'SH';
	    $row['sales_prefix'] = 'SALES';
	    $row['quote_prefix'] = 'QUOTE';
	    $row['purchase_prefix'] = 'PC';
	    $row['transfer_prefix'] = 'TS';
	    $row['delivery_prefix'] = 'DV';
	    $row['payment_prefix'] = 'PM';
	    $row['return_prefix'] = 'RT';
	    $row['returnp_prefix'] = 'RTP';
	    $row['expense_prefix'] = 'EP';
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
	}
	//print_r($row);
	$array_language_storehouse = array();
	
	
	$array_default_warehouse_storehouse = array();
	$_sql = 'SELECT id,name,store_id FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_warehouses';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_default_warehouse_storehouse[$_row['id']] = $_row;
	}
	
	$array_accounting_method_storehouse = array();
	$_sql = 'SELECT id,product_id FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_costing';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_accounting_method_storehouse[$_row['id']] = $_row;
	}
	
	$array_default_currency_storehouse = array();
	$_sql = 'SELECT id,name FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_currencies';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_default_currency_storehouse[$_row['id']] = $_row;
	}
	
	$array_default_tax_rate_storehouse = array();
	$_sql = 'SELECT id,name FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_tax_rates';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_default_tax_rate_storehouse[$_row['id']] = $_row;
	}
	
	$array_default_tax_rate2_storehouse = array();
	$_sql = 'SELECT id,name FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_tax_rates';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_default_tax_rate2_storehouse[$_row['id']] = $_row;
	}
	
	$array_dateformat_storehouse = array();
	$_sql = 'SELECT id,php FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_date_format';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_dateformat_storehouse[$_row['id']] = $_row;
	}
	
	$array_theme_storehouse = array();
	
	
	$array_default_discount_storehouse = array();
	
	
	$array_tax1_storehouse = array();
	$_sql = 'SELECT id,name FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_tax_rates';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_tax1_storehouse[$_row['id']] = $_row;
	}
	
	$array_tax2_storehouse = array();
	$_sql = 'SELECT id,name FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_tax_rates';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_tax2_storehouse[$_row['id']] = $_row;
	}
	
	$array_timezone_storehouse = array();
	
	
	$array_racks_storehouse = array();
	$_sql = 'SELECT id,category_names FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_stock_counts';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_racks_storehouse[$_row['id']] = $_row;
	}
	
	$array_attributes_storehouse = array();
	$_sql = 'SELECT id,reference_no FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_adjustments';
	$_query = $db->query($_sql);
	while ($_row = $_query->fetch()) {
	    $array_attributes_storehouse[$_row['id']] = $_row;
	}
	
	$array_pdf_lib_storehouse = array();
	
	
	
	$array_language = array();
	$array_language['vi'] = 'Vietnamese';
	$array_language['en'] = 'English';
	
	$array_theme = array();
	$array_theme['default'] = 'Default';
	
	$array_timezone = array();
	$array_timezone['GMS7'] = 'GMT +7';
	
	$array_pdf_lib = array();
	$array_pdf_lib[1] = '1';
	
	$config_store = (array) $permission->getConfigSetting($_SESSION[$module_data . '_store_id']);
	//print_r($config_store);die;
	
	$xtpl = new XTemplate('config.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
	$xtpl->assign('ROW', $config_store);
	
	$xtpl->assign('STORE_SESSION', $_SESSION[$module_data . '_store_id']);
	$xtpl->assign('OP', $op);
	foreach ($array_store_storehouse as $value) {
	    $xtpl->assign('STORE', array(
	        'key' => $value['store_id'],
	        'title' => $value['name'],
	        'selected' => ($value['store_id'] == $_SESSION[$module_data . '_store_id']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_store_id');
	}
	foreach ($array_language_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value[''],
	        'title' => $value[''],
	        'selected' => ($value[''] == $row['language']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_language');
	}
	//print_r($array_default_warehouse_storehouse);
	foreach ($array_default_warehouse_storehouse as $value) {
		if($value['store_id'] ==  $_SESSION[$module_data . '_store_id']){
			$xtpl->assign('OPTION', array(
		        'key' => $value['id'],
		        'title' => $value['name'],
		        'selected' => ($value['id'] == $row['default_warehouse']) ? ' selected="selected"' : ''
		    ));
		    $xtpl->parse('main.config.select_default_warehouse');
		}
	    
	}
	foreach ($array_accounting_method_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value['id'],
	        'title' => $value['product_id'],
	        'selected' => ($value['id'] == $row['accounting_method']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_accounting_method');
	}
	foreach ($array_default_currency_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value['id'],
	        'title' => $value['name'],
	        'selected' => ($value['id'] == $row['default_currency']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_default_currency');
	}
	foreach ($array_default_tax_rate_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value['id'],
	        'title' => $value['name'],
	        'selected' => ($value['id'] == $row['default_tax_rate']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_default_tax_rate');
	}
	foreach ($array_default_tax_rate2_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value['id'],
	        'title' => $value['name'],
	        'selected' => ($value['id'] == $row['default_tax_rate2']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_default_tax_rate2');
	}
	foreach ($array_dateformat_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value['id'],
	        'title' => $value['php'],
	        'selected' => ($value['id'] == $row['dateformat']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_dateformat');
	}
	foreach ($array_theme_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value[''],
	        'title' => $value[''],
	        'selected' => ($value[''] == $row['theme']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_theme');
	}
	foreach ($array_default_discount_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value[''],
	        'title' => $value[''],
	        'selected' => ($value[''] == $row['default_discount']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_default_discount');
	}
	foreach ($array_tax1_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value['id'],
	        'title' => $value['name'],
	        'selected' => ($value['id'] == $row['tax1']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_tax1');
	}
	foreach ($array_tax2_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value['id'],
	        'title' => $value['name'],
	        'selected' => ($value['id'] == $row['tax2']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_tax2');
	}
	foreach ($array_timezone_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value[''],
	        'title' => $value[''],
	        'selected' => ($value[''] == $row['timezone']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_timezone');
	}
	foreach ($array_racks_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value['id'],
	        'title' => $value['category_names'],
	        'selected' => ($value['id'] == $row['racks']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_racks');
	}
	foreach ($array_attributes_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value['id'],
	        'title' => $value['reference_no'],
	        'selected' => ($value['id'] == $row['attributes']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_attributes');
	}
	foreach ($array_pdf_lib_storehouse as $value) {
	    $xtpl->assign('OPTION', array(
	        'key' => $value[''],
	        'title' => $value[''],
	        'selected' => ($value[''] == $row['pdf_lib']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_pdf_lib');
	}
	
	foreach ($array_language as $key => $title) {
	    $xtpl->assign('OPTION', array(
	        'key' => $key,
	        'title' => $title,
	        'selected' => ($key == $row['language']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_language');
	}
	
	foreach ($array_theme as $key => $title) {
	    $xtpl->assign('OPTION', array(
	        'key' => $key,
	        'title' => $title,
	        'selected' => ($key == $row['theme']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_theme');
	}
	
	foreach ($array_timezone as $key => $title) {
	    $xtpl->assign('OPTION', array(
	        'key' => $key,
	        'title' => $title,
	        'selected' => ($key == $row['timezone']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_timezone');
	}
	
	foreach ($array_pdf_lib as $key => $title) {
	    $xtpl->assign('OPTION', array(
	        'key' => $key,
	        'title' => $title,
	        'selected' => ($key == $row['pdf_lib']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_pdf_lib');
	}
	foreach ($array_barcode as $key => $title) {
	    $xtpl->assign('OPTION', array(
	        'key' => $key,
	        'title' => $title,
	        'selected' => ($key == $row['auto_detect_barcode']) ? ' selected="selected"' : ''
	    ));
	    $xtpl->parse('main.config.select_barcode');
	}
	
	
	if (!empty($error)) {
	    $xtpl->assign('ERROR', implode('<br />', $error));
	    $xtpl->parse('main.error');
	}else{
		$xtpl->parse('main.config');
	}
	
	$xtpl->parse('main');
	$contents = $xtpl->text('main');
	

}else{
	$xtpl = new XTemplate('settings.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
	$error[] = $lang_module['no_config_store'];
	
	if (!empty($error)) {
	    $xtpl->assign('ERROR', implode('<br />', $error));
	    $xtpl->parse('main.error');
	}
	$xtpl->parse('main');
	$contents = $xtpl->text('main');
}
	$page_title = $title_manager_store;
	
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme($contents);
	include NV_ROOTDIR . '/includes/footer.php';