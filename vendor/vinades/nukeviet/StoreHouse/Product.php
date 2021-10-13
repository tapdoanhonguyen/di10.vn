<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV SYSTEMS (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2013 NV SYSTEMS. All rights reserved
 * @Blog http://nguyenvan.vn
 * @Developers http://nukeviet.systems
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Mon, 20 Oct 2014 14:00:59 GMT
 */
 
namespace NukeViet\StoreHouse;
use PDO;
use PDOException;

class Product extends MY_Controller
{
	public $warehouse_id = '';
	public $purchases_id = '';
	public $status = '';
    public function __construct($purchaesRegistry = array())
    {
		global $db_config, $db, $nv_Request;
		parent::__construct($purchaesRegistry);
		$this->products_model = &load_class('Products_model');		$this->load->library('form_validation');
    }	/*public function getPurchasedItems($product_id, $warehouse_id= NULL, $option_id = NULL) {			$orderby = ($this->Settings->accounting_method == 1) ? 'asc' : 'desc';			$this->db->sqlreset()->select('t1.*, t2.*');			$this->db->from($this->db_prefix . '_' . $this->mod_data . '_purchase_items t1')			->join('LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_purchases t2 ON t1.purchase_id = t2.id');			$where = 'product_id =' . $product_id . ' AND quantity_balance !=0';			if (!isset($option_id) || empty($option_id)) {				$where .=' AND ( option_id IS NULL OR option_id = 0)';			} else {				$where .=' AND option_id = '. $option_id;			}						$this->db->where($where);			$this->db->group('t1.id');			$this->db->order('t2.date ' . $orderby . ', t1.purchase_id ' . $orderby);						 $q = $this->db->query($this->db->sql());			if ($q->rowCount() > 0) {				return $q->fetchAll(5);			} 			return FALSE;		}*/	/*public function getSalesItems($product_id, $warehouse_id= NULL, $option_id = NULL) {			$orderby = ($this->Settings->accounting_method == 1) ? 'asc' : 'desc';			$this->db->sqlreset()->select('t1.*,t2.*');			$this->db->from($this->db_prefix . '_' . $this->mod_data . '_sale_items t1')			->join('LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_sales t2 ON t1.sale_id = t2.id');			$where = 'product_id =' . $product_id . ' AND quantity !=0';			if (!isset($option_id) || empty($option_id)) {				$where .=' AND ( option_id IS NULL OR option_id = 0)';			} else {				$where .=' AND option_id = '. $option_id;			}						$this->db->where($where);			$this->db->group('t1.id');			$this->db->order('t2.date ' . $orderby . ', t1.sale_id ' . $orderby);			$q = $this->db->query($this->db->sql());			if ($q->rowCount() > 0) {				return $q->fetchAll();			} 			return FALSE;		}*/
	public function getPurchasesChart($product_id, $warehouse_id= NULL, $option_id = NULL) {
		$q = $this->db->query('SELECT date_format(FROM_UNIXTIME(t1.date), "%Y-%M") month, SUM( t2.quantity ) as purchases, SUM( t2.subtotal ) as amount FROM ' . $this->db_prefix . '_' . $this->mod_data . '_purchases t1 LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items t2 ON t1.id=t2.purchase_id WHERE t2.product_id = ' . $product_id . ' AND DATE_ADD(curdate(), INTERVAL 1 MONTH) GROUP BY date_format(FROM_UNIXTIME(t1.date), "%Y-%m") ORDER BY date_format(FROM_UNIXTIME(t1.date), "%Y-%m") desc LIMIT 3');        if ($q->rowCount() > 0) {            return $q->fetchAll();        }         return FALSE;    }	public function getSalesChart($product_id, $warehouse_id= NULL, $option_id = NULL) {                $q = $this->db->sqlreset()->query('SELECT date_format(FROM_UNIXTIME(t1.date), "%Y-%M") month, SUM( t2.quantity ) as sold, SUM( t2.subtotal ) as amount FROM ' . $this->db_prefix . '_' . $this->mod_data . '_sales t1 LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_sale_items t2 ON t1.id=t2.sale_id WHERE t2.product_id = ' . $product_id . ' AND DATE_ADD(curdate(), INTERVAL 1 MONTH) GROUP BY date_format(FROM_UNIXTIME(t1.date), "%Y-%m") ORDER BY date_format(FROM_UNIXTIME(t1.date), "%Y-%m") asc LIMIT 3');		        if ($q->rowCount() > 0) {            return $q->fetchAll();        }         return FALSE;    }		
	public function getProductQuantity($product_id, $warehouse=0)    {
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
		
	}

