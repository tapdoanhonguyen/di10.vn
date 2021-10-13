<?php 


class Products_model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProducts($cat_id = '')
    {
    	$where= "";
    	if($cat_id != ''){
    		$where = "WHERE poc.category_id IN (" . $cat_id . ")";
    	}
		//print_r('SELECT p.* FROM ' . $this->db_prefix . '_san_pham_rows p LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_product_of_category poc ON p.id = poc.product_id ' .$where . ' GROUP BY p.id');
		//die('SELECT * FROM ' . $this->db_prefix . '_san_pham_rows ' .$where);
        $q = $this->db->query('SELECT p.*, p.product_code code, p.' . NV_LANG_DATA . '_title name FROM ' . $this->db_systems . '.' . $this->db_prefix . '_san_pham_rows p ');
        //print_r('SELECT p.* FROM ' . $this->db_prefix . '_san_pham_rows p LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_product_of_category poc ON p.id = poc.product_id ' .$where . ' GROUP BY p.id');
        if ($q->rowCount() > 0) {
            return $q->fetchAll(5);
        }
        return FALSE;
    }
	public function getAllPurchaseItems($purchase_id)
    {
        $this->db->select('purchase_items.*, tax_rates.code as tax_code, tax_rates.name as tax_name, tax_rates.rate as tax_rate, products.product_unit, products.' . NV_LANG_DATA . '_bodytext as details, product_variants.name as variant, products.hsn_code as hsn_code, products.second_name as second_name')
            ->from($this->db_prefix . '_' . $this->mod_data . '_purchase_items as purchase_items')
            ->join('LEFT JOIN ' . $this->db_prefix . '_san_pham_rows as products ON products.id=purchase_items.product_id 
            	LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_product_variants as product_variants ON product_variants.id=purchase_items.option_id
                LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_tax_rates as tax_rates ON tax_rates.id=purchase_items.tax_rate_id')
			->where('purchase_id = ' . $purchase_id)
            ->group('purchase_items.id')
            ->order('id asc');
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	public function getTransferItems($transfer_id)
    {
        $this->db->select('purchase_items.*, tax_rates.code as tax_code, tax_rates.name as tax_name, tax_rates.rate as tax_rate, products.product_unit, products.' . NV_LANG_DATA . '_bodytext as details, product_variants.name as variant, products.hsn_code as hsn_code, products.second_name as second_name')
            ->from($this->db_prefix . '_' . $this->mod_data . '_purchase_items as purchase_items')
            ->join('LEFT JOIN ' . $this->db_prefix . '_san_pham_rows as products ON products.id=purchase_items.product_id 
            	LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_product_variants as product_variants ON product_variants.id=purchase_items.option_id
                LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_tax_rates as tax_rates ON tax_rates.id=purchase_items.tax_rate_id')
			->where('transfer_id = ' . $transfer_id)
            ->group('purchase_items.id')
            ->order('id asc');
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	public function getPurchasedQty($id)
    {
        $q = $this->db->query('SELECT date_format(FROM_UNIXTIME(t1.date), "%Y-%M") month, SUM( t2.quantity ) as purchases, SUM( t2.subtotal ) as amount FROM ' . $this->db_prefix . '_' . $this->mod_data . '_purchases t1 LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items t2 ON t1.id=t2.purchase_id WHERE t2.product_id = ' . $id . ' AND DATE_ADD(curdate(), INTERVAL 1 MONTH) GROUP BY date_format(FROM_UNIXTIME(t1.date), "%Y-%m") ORDER BY date_format(FROM_UNIXTIME(t1.date), "%Y-%m") desc LIMIT 3');
        if ($q->rowCount() > 0) {
            return $q->fetchAll();
        } 
        return FALSE;
    }
	 public function getSoldQty($id)
    {
    	$q = $this->db->sqlreset()->query('SELECT date_format(FROM_UNIXTIME(t1.date), "%Y-%M") month, SUM( t2.quantity ) as sold, SUM( t2.subtotal ) as amount FROM ' . $this->db_prefix . '_' . $this->mod_data . '_sales t1 LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_sale_items t2 ON t1.id=t2.sale_id WHERE t2.product_id = ' . $id . ' AND DATE_ADD(curdate(), INTERVAL 1 MONTH) GROUP BY date_format(FROM_UNIXTIME(t1.date), "%Y-%m") ORDER BY date_format(FROM_UNIXTIME(t1.date), "%Y-%m") asc LIMIT 3');
		
        if ($q->rowCount() > 0) {
            return $q->fetchAll();
        } 
        return FALSE;
    }
	public function getAllWarehousesWithPQ($product_id)
    {
        $this->db->select('warehouses.*, warehouses_products.quantity, warehouses_products.rack')
			->from($this->db_prefix . '_' . $this->mod_data . '_warehouses as warehouses')
            ->join('LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_warehouses_products as warehouses_products ON warehouses_products.warehouse_id=warehouses.id')
            ->where('warehouses_products.product_id = ' . $product_id)
            ->group('warehouses.id');
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

}
