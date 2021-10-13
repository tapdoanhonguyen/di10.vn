<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2013 Webdep24.com. All rights reserved
 * @Blog http://dangdinhtu.com
 * @Developers http://developers.dangdinhtu.com/
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Mon, 20 Oct 2014 14:00:59 GMT
 */
 

namespace NukeViet\StoreHouse;
use PDO;

use PDOException;
use NukeViet\StoreHouse\Sales;
class Stores extends General

{
	
	public $lang_data = '';
	public $mod_data = '';
	public $mod_name = '';
	public $mod_file = '';
	
	public $mod_lang = '';
	public $db_prefix = '';
	public $table = '';
	public $lang = '';

	public function __construct( $storehouseRegistry = array() )
	{

		global $db_config, $db, $nv_Request, $nv_Request;
 
		parent::__construct($storehouseRegistry);

		//$this->storehouse_model = &load_class('StoreHouse_model');
		//$this->config = $this->getSetting( 'config', $this->store_id );
 	 
		//$this->array_lang_code = $this->getLangMod( 'code' );
		//$this->current_language_id = $this->array_lang_code[$this->lang_data]['language_id'];
	}

	public function deleteCache( $part )
	{
		//array('cat', setting)

		if( is_array( $part ) )
		{
			foreach( $part as $_part )
			{
				$files = glob( NV_ROOTDIR . '/' . NV_CACHEDIR . '/' . $this->mod_name . '/' . NV_CACHE_PREFIX . '.' . preg_replace( '/[^A-Z0-9\._-]/i', '', $_part ) . '.*.cache' );
				if( $files )
				{
					foreach( $files as $file )
					{
						if( file_exists( $file ) )
						{
							unlink( $file );
						}
					}
				}
			}
		}
		else
		{
			$files = glob( NV_ROOTDIR . '/' . NV_CACHEDIR . '/' . $this->mod_name . '/' . NV_CACHE_PREFIX . '.' . preg_replace( '/[^A-Z0-9\._-]/i', '', $part ) . '.*.cache' );
			if( $files )
			{
				foreach( $files as $file )
				{
					if( file_exists( $file ) )
					{
						unlink( $file );
					}
				}
			}
		}

		return true;
	}

	public function getdbCache( $sql, $part, $key = '' )
	{
		global $nv_Cache, $db;
		$data = array();
		$cache_file = NV_CACHE_PREFIX . '.' . $part . '.' . $this->lang_data . '.cache';
		if( ( $cache = $nv_Cache->getItem( $this->mod_name, $cache_file ) ) != false )
		{
			$data = unserialize( $cache );
		}
		else
		{
			
			if( ( $result = $db->query( $sql ) ) !== false )
			{
				$a = 0;
				while( $row = $result->fetch() )
				{
					$key2 = ( ! empty( $key ) and isset( $row[$key] ) ) ? $row[$key] : $a;
					
					$data[$key2] = $row;
					
					++$a;
				}
				$result->closeCursor();

				$cache = serialize( $data );
				$nv_Cache->setItem( $this->mod_name, $cache_file, $cache );
			}
		}
		 
		return $data;
		 
	}

	public function getStoreId()
	{
		global $nv_Cache, $db;
		
		$domain = str_replace( 'http://', '', NV_MY_DOMAIN );
		
		$sql= 'SELECT store_id FROM ' . $this->table . '_stores WHERE url = ' . $db->quote( $domain );	
		
		$result = $this->getdbCache( $sql, md5( $domain ) . '.store', '' );
		
		return isset( $result[0] ) ? $result[0]['store_id'] : 0;

	}
	public function storeSubListIdSite($idsite)
	{
		global $nv_Cache, $db;
		if($idsite > 0)
			$sql= 'SELECT * FROM ' . $this->table . '_stores WHERE parentid = ' . $this->db->quote( $idsite ) . ' OR store_id = ' . $db->quote( $idsite );	
		else {
			$sql= 'SELECT * FROM ' . $this->table . '_stores ';
		}
		$q = $this->db->query( $sql );
		
		if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;

	}
	public function getStoreByID($idsite=0)
	{
		if($idsite>0){
			$sql= 'SELECT * FROM ' . $this->table . '_stores WHERE store_id = ' . $this->db->quote( $idsite );	
			$q = $this->db->query( $sql );
			if ($q->rowCount() > 0) {
	            return $q->fetch(5);
	        }else{
	        	return FALSE;
	        }
		}else{
			return FALSE;
		}	
	}
	public function getWareHouseByID($whid=0)
	{
		if($idsite>0){
			$sql= 'SELECT * FROM ' . $this->table . '_warehouses WHERE id = ' . $this->db->quote( $whid );	
			$q = $this->db->query( $sql );
			if ($q->rowCount() > 0) {
	            return $q->fetch(5);
	        }else{
	        	return FALSE;
	        }
		}else{
			return FALSE;
		}	
	}
	public function storeAddSubStoreIdSite($idsite=0,$store_name,$store_url){
		if($idsite>0){
			$main_store=$this->getStoreByID($idsite);
			$sql="INSERT INTO " . $this->table . "_stores(name,url,parentid,category_id,userid) VALUES (:name,:url, " . $idsite . ", " . $main_store->category_id . ", " . $main_store->userid . ")";
			$data_insert=array();
			$data_insert['name']=$store_name;
			$data_insert['url']=$store_url;
			
			$storeid = $this->db->insert_id($sql,'store_id', $data_insert);
			if($storeid>0){
				$this->nv_fix_store_order();
				$this->updateStoreToCat($storeid,$main_store->category_id,$main_store->userid);
				return $this->getStoreByID($storeid);
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	public function AddWareHouse($storeid,$wh_name,$store_url){
		$sql="INSERT INTO " . $this->table . "_warehouses(name,url,parentid,store_id) VALUES (:name,:url, 0," . $storeid . ")";
		$data_insert=array();
		$data_insert['name']=$wh_name;
		$data_insert['url']=$store_url;
		
		$whid = $this->db->insert_id($sql,'id', $data_insert);
		if($storeid>0){
			return $this->getWareHouseByID($whid);
		}else{
			return FALSE;
		}
	}
	public function nv_fix_store_order($parentid = 0, $order = 0, $lev = 0){
		$sql = 'SELECT store_id, parentid FROM ' . $this->table . '_stores WHERE parentid=' . $parentid . ' ORDER BY weight ASC';
	    $result = $this->db->query($sql);
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
	        $sql = 'UPDATE ' . $this->table . '_stores SET weight=' . $weight . ', sort_order=' . $order . ', lev=' . $lev . ' WHERE store_id=' . $storeid_i;
	        $this->db->query($sql);
	        $order = $this->nv_fix_store_order($storeid_i, $order, $lev);
	    }
	
	    $numsubstore = $weight;
	    if ($parentid > 0) {
	        
	        $sql = 'UPDATE ' . $this->table . '_stores SET numstore=' . $numsubstore;
	        if ($numsubstore == 0 ) {
	            $sql .= ", substoreid=''";
	        } else {
	            $sql .= ", substoreid='" . implode(",", $array_store_order) . "'";
	        }
	        $sql .= ' WHERE store_id=' . $parentid;
	        $this->db->query($sql);
	    }
	    return $order;
	}
	public function updateStoreToCat($storeid,$category_id,$userid){
		if($storeid>0 && $category_id>0){
			$this->db->query('DELETE FROM ' . $this->table . '_store_of_category WHERE category_id NOT IN (' . $category_id . ') and store_id = ' .  $storeid );
			foreach($category_id as $cate){
				$store_of_cat = $this->db->query('SELECT * FROM ' . $this->table . '_store_of_category WHERE category_id = ' . $cate . ' AND store_id=' . $storeid)->fetch();
				if (empty($store_of_cat)) {
					
					$this->db->query('INSERT INTO ' . $this->table . '_store_of_category(store_id, category_id) VALUES (' . $storeid . ',' . $cate . ')');
				}
			}
			$id=$this->db->query('SELECT setting_id FROM ' . $this->table . '_settings WHERE setting_id = ' . $storeid);
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
                $stmt = $this->db->prepare('INSERT INTO ' . $this->table . '_settings (setting_id, logo, logo2, site_name, language, default_warehouse, accounting_method, default_currency, default_tax_rate, rows_per_page, version, default_tax_rate2, dateformat, sales_prefix, quote_prefix, purchase_prefix, transfer_prefix, delivery_prefix, payment_prefix, return_prefix, returnp_prefix, expense_prefix, item_addition, theme, product_serial, default_discount, product_discount, discount_method, tax1, tax2, overselling, restrict_user, restrict_calendar, timezone, iwidth, iheight, twidth, theight, watermark, reg_ver, allow_reg, reg_notification, auto_reg, protocol, mailpath, smtp_host, smtp_user, smtp_pass, smtp_port, smtp_crypto, corn, customer_group, default_email, mmode, bc_fix, auto_detect_barcode, captcha, reference_format, racks, attributes, product_expiry, decimals, qty_decimals, decimals_sep, thousands_sep, invoice_view, default_biller, envato_username, purchase_code, rtl, each_spent, ca_point, each_sale, sa_point, supdate, sac, display_all_products, display_symbol, symbol, remove_expired, barcode_separator, set_focus, price_group, barcode_img, ppayment_prefix, disable_editing, qa_prefix, update_cost, apis, state, pdf_lib) VALUES (' . $storeid . ', :logo, :logo2, :site_name, :language, :default_warehouse, :accounting_method, :default_currency, :default_tax_rate, :rows_per_page, :version, :default_tax_rate2, :dateformat, :sales_prefix, :quote_prefix, :purchase_prefix, :transfer_prefix, :delivery_prefix, :payment_prefix, :return_prefix, :returnp_prefix, :expense_prefix, :item_addition, :theme, :product_serial, :default_discount, :product_discount, :discount_method, :tax1, :tax2, :overselling, :restrict_user, :restrict_calendar, :timezone, :iwidth, :iheight, :twidth, :theight, :watermark, :reg_ver, :allow_reg, :reg_notification, :auto_reg, :protocol, :mailpath, :smtp_host, :smtp_user, :smtp_pass, :smtp_port, :smtp_crypto, :corn, :customer_group, :default_email, :mmode, :bc_fix, :auto_detect_barcode, :captcha, :reference_format, :racks, :attributes, :product_expiry, :decimals, :qty_decimals, :decimals_sep, :thousands_sep, :invoice_view, :default_biller, :envato_username, :purchase_code, :rtl, :each_spent, :ca_point, :each_sale, :sa_point, :update, :sac, :display_all_products, :display_symbol, :symbol, :remove_expired, :barcode_separator, :set_focus, :price_group, :barcode_img, :ppayment_prefix, :disable_editing, :qa_prefix, :update_cost, :apis, :state, :pdf_lib)');
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
			$user_store=$this->db->query('SELECT userid FROM ' . $this->table . '_users_stores WHERE storeid = ' . $storeid . ' AND chain=1')->fetch(5)->userid; 
            if($user_store == 0 && $storeid > 0){ 
            	$this->db->query('INSERT INTO ' . $this->table . '_users_stores (userid,storeid,chain)  VALUE (' . $userid . ',' . $storeid . ' ,1) '); 
            	//$db->query('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_users (userid,storeid,is_staff)  VALUE (' . $stores_info->userid . ',' . $storeid . ' ,1) '); 
            }else{
            	if($_SESSION[$module_data . '_store_id'] > 0)
					$this->db->query('UPDATE ' . $this->table . '_users_stores SET userid = ' . $stores_info->userid . ' WHERE storeid=' . $storeid); 
				else
					$this->db->query('UPDATE ' . $this->table . '_users_stores SET userid = ' . $user_store . ' WHERE storeid=' . $storeid); 
            	
            	//$db->query('UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_users SET storeid = ' . $storeid . ' WHERE userid =' . $stores_info->userid ); 
            }
		}else{
			return false;
		}
	}
	public function lang( $key )
	{
		return isset( $this->mod_lang[$key] ) ? $this->mod_lang[$key] : $key;
	}

	public function getLangMod( $by = 'language_id' )
	{
		global $nv_Cache, $db;
		
		$data = array();
		return $data;
	}

	public function getLangSite( $name, $dir )
	{
		if( ! file_exists( NV_ROOTDIR . '/modules/' . $this->mod_file . '/language/' . $dir . '/' . $name . '_' . NV_LANG_DATA . '.php' ) )
		{
			trigger_error( 'Error! Language variables ' . $name . ' is empty!', 256 );
		}
		require ( NV_ROOTDIR . '/modules/' . $this->mod_file . '/language/' . $dir . '/' . $name . '_' . NV_LANG_DATA . '.php' );

		return $lang_module;
	}

	/* public function getSetting( $group, $store_id = 0 )
	{
		global $nv_Cache, $db;
		
		$data = array();

		$sql = 'SELECT * FROM ' . $this->table . '_setting WHERE store_id = ' . intval( $store_id ) . ' AND groups = ' . $db->quote( $group );

		$cache_file = NV_CACHE_PREFIX . '.setting.' . $store_id . '.' . $group . '.' . $this->lang_data . '.cache';
		
		if( ( $cache = $nv_Cache->getItem( $this->mod_name, $cache_file ) ) != false )
		{
			$data = unserialize( $cache );
		}
		else
		{
			if( ( $result = $db->query( $sql ) ) !== false )
			{
				$a = 0;
				while( $row = $result->fetch() )
				{
					if( ! $row['serialized'] )
					{
						$data[$row['code']] = $row['value'];
					}
					else
					{
						$data[$row['code']] = unserialize( $row['value'] );
					}
					++$a;
				}
				$result->closeCursor();

				$cache = serialize( $data );
				$nv_Cache->setItem( $this->mod_name, $cache_file, $cache );
			}
		}
		$sql = null;
		return $data;
	} */

	public function __destruct()
	{
		foreach( $this as $key => $value )
		{
			unset( $this->$key );
		}
	}

	public function clear()
	{
		$this->__destruct();
	}
	public function getAllWarehousesByIdSite($idsite=0)
    {
    	if($idsite>0){
    		$liststore_tmp = $this->storeSubListIdSite($idsite);
			$liststore = array();
			foreach ($liststore_tmp as $store_id => $value) {
				$liststore[] = $value->store_id;
			}
    		$q = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_warehouses WHERE store_id IN (' . implode(",", $liststore) . ')');
	        if ($q->rowCount() > 0) {
	            foreach (($q->fetchAll(5)) as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        }else{
	        	return FALSE;
	        }
    	}else{
        	return FALSE;
        }
        
        
    }
	public function getProductQuantity($product_id, $warehouse=0)
    {
    	$where='';
    	if($warehouse > 0){
    		$where .= 'AND warehouse_id = ' . $warehouse;
    	}
		
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_warehouses_products WHERE product_id = ' . $product_id . ' ' . $where);
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getUnitByProIdSale($product_id)
    {
    	$product = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_products WHERE id = ' . $product_id)->fetch(5);
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_units WHERE id = ' . $product->sale_unit);
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function checkpermission($user_id = 1)
    {
    	$group_id = $this->check_user_group($user_id);
		$permission = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_permissions WHERE group_id = ' . $group_id )->fetch(5);
        return json_decode($permission->per_access);
    }
	public function check_user_group($user_id = 0)
    {
    	$group = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_groups_user WHERE userid = ' . $user_id . ' AND approved=1');
        if ($group->rowCount() > 0) {
            return $group->fetch(5)->group_id;
        }
        return 0;
    }
	public function getConfigSetting($store_id)
    {
    	if($store_id == ''){$store_id =0;}
		//print_r('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_settings WHERE setting_id = ' . $store_id . ' ');die;
    	$q = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_settings WHERE setting_id = ' . $store_id . ' ');
        //if ($q->rowCount() > 0) {
           // return $q->fetch(5);
       // }
        return 0;
    }
	public function productListIdSite($idsite=0){
		if($idsite>0){
			$main_store=$this->getStoreByID($idsite);
			$listsubcatid=array();
			$q=$this->db->query('SELECT secondcat_id FROM ' . $this->table . '_cat_of_secondcategory WHERE  category_id IN (' . $main_store->category_id . ')')->fetchall();
			foreach ($q as $key => $value) {
				$listsubcatid[]= $value['secondcat_id'];
			}
			$q = $this->db->query('SELECT * FROM ' . $this->table  . '_products p LEFT JOIN ' . $this->table . '_product_of_category pc ON p.id=pc.product_id LEFT JOIN ' . $this->table . '_product_of_store pos ON p.id=pos.product_id WHERE pc.category_id IN (' . implode(',',$listsubcatid) . ')  AND pos.store_id = ' . $idsite);
			
			if($q->rowCount() > 0){
				return $q->fetchAll(5);
			}else{
				return FALSE;
			}
			
		}else{
			return FALSE;
		}
	}
	public function getCatList($idsite=0){
		if($idsite>0){
			$main_store=$this->getStoreByID($idsite);
			$listsubcatid=array();
			$q=$this->db->query('SELECT secondcat_id FROM ' . $this->table . '_cat_of_secondcategory WHERE  category_id IN (' . $main_store->category_id . ')')->fetchall();
			foreach ($q as $key => $value) {
				$listsubcatid[]= $value['secondcat_id'];
			}
			$q = $this->db->query('SELECT * FROM ' . $this->table  . '_subcategories  WHERE id IN (' . implode(',',$listsubcatid) . ') ');
			
			if($q->rowCount() > 0){
				return $q->fetchAll(5);
			}else{
				return FALSE;
			}
			
		}else{
			return FALSE;
		}
	}
	public function getAllQuantityProduct($idsite=0, $productid = 0){
		if($idsite>0){
			$list_warehouse_tmp = $this->getAllWarehousesByIdSite($idsite);
			$list_warehouse =array();
			foreach ($list_warehouse_tmp as $warehouse => $value) {
				$list_warehouse[] = $value->id;
			}
			$q = $this->db->query('SELECT COALESCE(sum(quantity), 0) as quantity_total FROM ' . $this->table  . '_warehouses_products WHERE warehouse_id IN (' . implode(',',$list_warehouse) . ') AND product_id = ' . $productid);
			if($q->rowCount() > 0){
				return $q->fetch(5)->quantity_total;
			}else{
				return 0;
			}
			
		}else{
			return 0;
		}
	}
	public function Sale($idsite,$listproduct,$customer=0)
	{
		$$data_order = array();
		$data_order['reference_no'] = '';
		$data_order['order_email'] = '';
		$data_order['order_name'] = '';
		$data_order['order_phone'] = '';
		$data_order['order_address'] = '';
		$data_order['order_time'] = '';
		$data_order['warehouse_id'] = '';
		$data_order['order_note'] = '';
		$data_order['order_discount_id'] = '';
		$data_order['total_discount'] = '';
		$data_order['order_discount'] = '';
		$data_order['product_tax'] = '';
		$data_order['order_tax_id'] = '';
		$data_order['order_tax'] = '';
		$data_order['total_tax'] = '';
		$data_order['shippings'] = '';
		$data_order['sale_status'] = '';
		$data_order['payment_status'] = '';
		$data_order['payment_term'] = '';
		$data_order['due_date'] = '';
		$data_order['created_by'] = '';
		$data_order['updated_by'] = '';
		$data_order['total_items'] = '';
		$data_order['updated_at'] = '';
		$data_order['pos'] = '';
		$data_order['paid'] = '';
		$data_order['return_id'] = '';
		$data_order['surcharge'] = '';
		$data_order['attachment'] = '';
		$data_order['return_sale_ref'] = '';
		$data_order['sale_id'] = '';
		$data_order['return_sale_total'] = '';
		$data_order['rounding'] = '';
		$data_order['suspend_note'] = '';
		$data_order['api'] = '';
		$data_order['shop'] = '';
		$data_order['address_id'] = '';
		$data_order['reserve_id'] = '';
		$data_order['hash'] = '';
		$data_order['manual_payment'] = '';
		$data_order['payment_method'] = '';
		$
		Sales::shopadd($data_order);
	}
}
 
if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );