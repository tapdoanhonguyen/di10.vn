<?php 

class Reports_model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    
	public function getInventory($start_date, $end_date, $type = 0)
    {
		global $global_config;
    	$date_begin_period_start =0;
        if (empty($start_date)) {
        	$start_date = date("d",NV_CURRENTTIME)."/".date("m",NV_CURRENTTIME)."/".date("Y",NV_CURRENTTIME);
        }elseif($type == 1){
        	$start_date = "01/".date("m",NV_CURRENTTIME)."/".date("Y",NV_CURRENTTIME);
        }elseif($type == 2){
        	$start_date = "01/".date("m",NV_CURRENTTIME)."/".date("Y",NV_CURRENTTIME);
        }
    	unset($m);
    	preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $start_date, $m);
    	$date_in_period_start=mktime(0, 0, 0, $m[2], $m[1], $m[3]);
    	$date_format_begin_peroid = $m[3]."-".$m[2]."-".$m[1];
       	$date=date_create($date_format_begin_peroid);
		date_modify($date, "-1 day");//-1 days , -3 months
		unset($m);
		preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', date_format($date, "d/m/Y"), $m);
		$date_begin_period_end = mktime(23, 59, 59, $m[2], $m[1], $m[3]);	
		if (empty($end_date)) {
		    $date_in_period_end = NV_CURRENTTIME;
		} else {
		    unset($m);
		    preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $end_date, $m);
		    $date_in_period_end = mktime(23, 59, 0, $m[2], $m[1], $m[3]);	
		}
		
		
		
		
    	if(!empty($date_begin_period_end)){
    		$begin_period_sales = "AND s.date > " . $date_begin_period_start . " AND s.date < " . $date_begin_period_end;
    		$begin_period_purchases = "AND p.date > " . $date_begin_period_start . " AND p.date < " . $date_begin_period_end;
    	}else{
    		$begin_period_sales = "";
    		$begin_period_purchases = "";
    	} 
		if(!empty($date_begin_period_end)){
    		$in_period_sales = "AND s2.date >= " . $date_begin_period_end . " AND s2.date <= " . $date_in_period_end;
    		$in_period_purchases = "AND p2.date >= " . $date_begin_period_end . "-1 AND p2.date <= " . $date_in_period_end;
    	}else{
    		$in_period_sales = "";
    		$in_period_purchases = "";
    	} 
		//print_r($date_begin_period_start . '/' . $date_begin_period_end . '/' . $date_in_period_start . '/' . $date_in_period_end);
		//print_r($begin_period_sales . '/' . $in_period_sales );
		
    	$rpproduct=$this->db->sqlreset()->select ('products.id,products.product_code code, products.' . NV_LANG_DATA . '_title name,COALESCE( PCosts.purchasedQty, 0 ) as PurchasedQty, COALESCE( PSales.soldQty, 0 ) as SoldQty,COALESCE( PCosts.balacneQty, 0 ) as BalacneQty,  (COALESCE( PSales.totalSale, 0 ) - COALESCE( PCosts.totalPurchase, 0 )) as ProfitBg,  (COALESCE( PurchasedQty, 0 ) - COALESCE( SoldQty, 0 )) as BeginPeriod, COALESCE( PCosts2.PurchasedQty2, 0 ) as PurchasedQtyIn, COALESCE( PSales2.SoldQty2, 0 ) as SoldQtyIn, COALESCE( PSales2.totalSale2, 0 ) as totalSaleIn, (0 - COALESCE( PCosts2.totalPurchase2, 0 )) as totalPurchaseIn, (COALESCE( PSales2.totalSale2, 0 ) - COALESCE( PCosts2.totalPurchase2, 0 )) as ProfitIn,  (COALESCE( PCosts2.purchasedQty2, 0 ) - COALESCE( PSales2.soldQty2, 0 )) as InPeriod, ((COALESCE( (COALESCE( PSales.totalSale, 0 ) - COALESCE( PCosts.totalPurchase, 0 )), 0 ) +  COALESCE( PSales2.totalSale2, 0 ) - COALESCE( PCosts2.totalPurchase2, 0 ) )) as ProfitEnd, ((COALESCE( (COALESCE( PurchasedQty, 0 ) - COALESCE( SoldQty, 0 )), 0 ) - COALESCE( (COALESCE( PSales2.soldQty2, 0 ) - COALESCE( PCosts2.purchasedQty2, 0 )), 0 ))) as EndPeroid')
    	->from($this->db_systems . '.' . $this->db_prefix . '_san_pham_rows products')
    	->join('LEFT JOIN ( SELECT si.product_id, SUM( si.quantity ) soldQty, SUM( si.subtotal ) totalSale FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales s JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sale_items si on s.id = si.sale_id AND s.saidsite = ' .$global_config['idsite']. ' '. $begin_period_sales . ' GROUP BY si.product_id) PSales ON products.id = PSales.product_id 
				LEFT JOIN (SELECT product_id, SUM(CASE WHEN pi.purchase_id IS NOT NULL THEN quantity ELSE 0 END) as purchasedQty, SUM(quantity_balance) as balacneQty, SUM( unit_cost * quantity_balance ) balacneValue, SUM( (CASE WHEN pi.purchase_id IS NOT NULL THEN (pi.subtotal) ELSE 0 END) ) totalPurchase FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items pi LEFT JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchases p on p.id = pi.purchase_id WHERE p.status != 2 AND p.status != 3 AND pi.puiidsite = ' .$global_config['idsite']. ' ' . $begin_period_purchases . ' GROUP BY pi.product_id ) PCosts ON products.id = PCosts.product_id
				LEFT JOIN ( SELECT si2.product_id, SUM( si2.quantity ) soldQty2, SUM( si2.subtotal ) totalSale2 FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales s2 JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sale_items si2 on s2.id = si2.sale_id AND si2.saiidsite = ' .$global_config['idsite']. ' ' . $in_period_sales . ' GROUP BY si2.product_id) PSales2 ON products.id = PSales2.product_id 
				LEFT JOIN (SELECT product_id, SUM(CASE WHEN pi2.purchase_id IS NOT NULL THEN quantity ELSE 0 END) as purchasedQty2, SUM(quantity_balance) as balacneQty2, SUM( unit_cost * quantity_balance ) balacneValue2, SUM( (CASE WHEN pi2.purchase_id IS NOT NULL THEN (pi2.subtotal) ELSE 0 END) ) totalPurchase2 FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items pi2 LEFT JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchases p2 on p2.id = pi2.purchase_id WHERE p2.status != 2 AND p2.status != 3 AND p2.puidsite = ' .$global_config['idsite']. ' ' . $in_period_purchases . ' GROUP BY pi2.product_id ) PCosts2 ON products.id = PCosts2.product_id') 
 		->group('products.product_code, PSales.soldQty, PSales.totalSale, PCosts.purchasedQty, PCosts.totalPurchase, PCosts.balacneQty, PCosts.balacneValue, PCosts2.purchasedQty2,PSales2.soldQty2')
		->where('type = "material"');
		/* die($this->db->sql()); */
		$q = $this->db->query($this->db->sql());
		if ($q->rowCount() > 0) {
			$data_list=array();
			$datas=$q->fetchAll();
			foreach($datas as $data){
				$this->db->sqlreset()->select ('product_id,quantity')
					->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_material_items')
					->where('item_id=' . $data['id']);
				$products_material=$this->db->query($this->db->sql())->fetchAll(5);
				foreach($products_material as $product){
					$inventory_export=$this->getInventoryExportInPeriod( $product->product_id, $date_begin_period_start, $date_begin_period_end, $date_in_period_start, $date_in_period_end);
					//print_r($inventory_export);
					$data['soldqty'] = $data['soldqty'] + $inventory_export['soldqty'];
					$data['beginperiod'] = (float) $data['beginperiod'] + (float) $inventory_export['beginperiod'] * (float) ($product->quantity);
					$data['inperiod'] = $data['inperiod'] + $inventory_export['inperiod'];
					$data['soldqtyin'] =  (float) ($data['soldqtyin']) +  (float) ($inventory_export['soldqtyin']) * (float) ($product->quantity);
					$data['endperoid'] = (float) $data['endperoid'] + (float) $inventory_export['endperoid'] * (float) ($product->quantity);
					
				}
				$data_list[]=$data;
			}
            return $data_list;
        }
		return FALSE;
    }
	public function getInventoryExportInPeriod( $product_id, $date_begin_period_start, $date_begin_period_end, $date_in_period_start, $date_in_period_end )
    { 
    	if(!empty($date_begin_period_end)){
    		$begin_period_sales = "AND s.date > " . $date_begin_period_start . " AND s.date < " . $date_begin_period_end;
    		$begin_period_purchases = "AND p.date > " . $date_begin_period_start . " AND p.date < " . $date_begin_period_end;
    	}else{
    		$begin_period_sales = "";
    		$begin_period_purchases = "";
    	} 
		if(!empty($date_begin_period_end)){
    		$in_period_sales = "AND s2.date >= " . $date_begin_period_end . " AND s2.date <= " . $date_in_period_end;
    		$in_period_purchases = "AND p2.date >= " . $date_begin_period_end . "-1 AND p2.date <= " . $date_in_period_end;
    	}else{
    		$in_period_sales = "";
    		$in_period_purchases = "";
    	} 
    	$rpproduct=$this->db->sqlreset()->select ('products.id,products.code, products.name,COALESCE( PCosts.purchasedQty, 0 ) as PurchasedQty, COALESCE( PSales.soldQty, 0 ) as SoldQty,COALESCE( PCosts.balacneQty, 0 ) as BalacneQty,  (COALESCE( PSales.totalSale, 0 ) - COALESCE( PCosts.totalPurchase, 0 )) as ProfitBg,  (COALESCE( PurchasedQty, 0 ) - COALESCE( SoldQty, 0 )) as BeginPeriod, COALESCE( PCosts2.PurchasedQty2, 0 ) as PurchasedQtyIn, COALESCE( PSales2.SoldQty2, 0 ) as SoldQtyIn, COALESCE( PSales2.totalSale2, 0 ) as totalSaleIn, (0 - COALESCE( PCosts2.totalPurchase2, 0 )) as totalPurchaseIn, (COALESCE( PSales2.totalSale2, 0 ) - COALESCE( PCosts2.totalPurchase2, 0 )) as ProfitIn,  (COALESCE( PCosts2.purchasedQty2, 0 ) - COALESCE( PSales2.soldQty2, 0 )) as InPeriod, ((COALESCE( (COALESCE( PSales.totalSale, 0 ) - COALESCE( PCosts.totalPurchase, 0 )), 0 ) +  COALESCE( PSales2.totalSale2, 0 ) - COALESCE( PCosts2.totalPurchase2, 0 ) )) as ProfitEnd, ((COALESCE( (COALESCE( PurchasedQty, 0 ) - COALESCE( SoldQty, 0 )), 0 ) - COALESCE( (COALESCE( PSales2.soldQty2, 0 ) - COALESCE( PCosts2.purchasedQty2, 0 )), 0 ))) as EndPeroid')
    	->from($this->db_systems . '.' . $this->db_prefix . '_san_pham_rows products')
    	->join('LEFT JOIN ( SELECT si.product_id, SUM( si.quantity ) soldQty, SUM( si.subtotal ) totalSale FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales s JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sale_items si on s.id = si.sale_id ' . $begin_period_sales . ' AND si.product_id = ' . $product_id . ' GROUP BY si.product_id) PSales ON products.id = PSales.product_id 
				LEFT JOIN (SELECT product_id, SUM(CASE WHEN pi.purchase_id IS NOT NULL THEN quantity ELSE 0 END) as purchasedQty, SUM(quantity_balance) as balacneQty, SUM( unit_cost * quantity_balance ) balacneValue, SUM( (CASE WHEN pi.purchase_id IS NOT NULL THEN (pi.subtotal) ELSE 0 END) ) totalPurchase FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items pi LEFT JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchases p on p.id = pi.purchase_id WHERE p.status != 2 AND p.status != 3 ' . $begin_period_purchases . ' AND pi.product_id  = ' . $product_id . ' GROUP BY pi.product_id ) PCosts ON products.id = PCosts.product_id
				LEFT JOIN ( SELECT si2.product_id, SUM( si2.quantity ) soldQty2, SUM( si2.subtotal ) totalSale2 FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales s2 JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sale_items si2 on s2.id = si2.sale_id ' . $in_period_sales . ' AND si2.product_id = ' . $product_id . ' GROUP BY si2.product_id) PSales2 ON products.id = PSales2.product_id 
				LEFT JOIN (SELECT product_id, SUM(CASE WHEN pi2.purchase_id IS NOT NULL THEN quantity ELSE 0 END) as purchasedQty2, SUM(quantity_balance) as balacneQty2, SUM( unit_cost * quantity_balance ) balacneValue2, SUM( (CASE WHEN pi2.purchase_id IS NOT NULL THEN (pi2.subtotal) ELSE 0 END) ) totalPurchase2 FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items pi2 LEFT JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchases p2 on p2.id = pi2.purchase_id WHERE p2.status != 2 AND p2.status != 3 ' . $in_period_purchases . ' AND pi2.product_id = ' . $product_id . ' GROUP BY pi2.product_id ) PCosts2 ON products.id = PCosts2.product_id') 
 		->group('products.code, PSales.soldQty, PSales.totalSale, PCosts.purchasedQty, PCosts.totalPurchase, PCosts.balacneQty, PCosts.balacneValue, PCosts2.purchasedQty2,PSales2.soldQty2')
		->where('products.id = ' . $product_id);
		//die($this->db->sql());
		$q = $this->db->query($this->db->sql());
		if ($q->rowCount() > 0) {
            return $q->fetch();
        }
		return FALSE;
    }
	function getEndPeriod()
    { 
    	$rpproduct=$this->db->sqlreset()->select ('products.id,products.code, products.name,COALESCE( PCosts.purchasedQty, 0 ) as PurchasedQty, COALESCE( PSales.soldQty, 0 ) as SoldQty,COALESCE( PCosts.balacneQty, 0 ) as BalacneQty, COALESCE( PCosts.totalPurchase, 0 ) as TotalPurchase, COALESCE( PCosts.balacneValue, 0 ) as TotalBalance, COALESCE( PSales.totalSale, 0 ) as TotalSales,  (COALESCE( PSales.totalSale, 0 ) - COALESCE( PCosts.totalPurchase, 0 )) as Profit')
    	->from($this->db_systems . '.' . $this->db_prefix . '_san_pham_rows products')
    	->join('left Join ( SELECT si.product_id, SUM( si.quantity ) soldQty, SUM( si.subtotal ) totalSale FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales s JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sale_items si on s.id = si.sale_id GROUP BY si.product_id) PSales ON products.id = PSales.product_id 
				LEFT JOIN (SELECT product_id, SUM(CASE WHEN pi.purchase_id IS NOT NULL THEN quantity ELSE 0 END) as purchasedQty, SUM(quantity_balance) as balacneQty, SUM( unit_cost * quantity_balance ) balacneValue, SUM( (CASE WHEN pi.purchase_id IS NOT NULL THEN (pi.subtotal) ELSE 0 END) ) totalPurchase FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items pi LEFT JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchases p on p.id = pi.purchase_id WHERE p.status != 2 AND p.status != 3 GROUP BY pi.product_id ) PCosts ON products.id = PCosts.product_id') 
 		->group('products.code, PSales.soldQty, PSales.totalSale, PCosts.purchasedQty, PCosts.totalPurchase, PCosts.balacneQty, PCosts.balacneValue');
		//die($this->db->sql());
		$q = $this->db->query($this->db->sql());
		if ($q->rowCount() > 0) {
            return $q->fetchAll();
        }
		return FALSE;
    }
	public function getWarehouseStockValue($id)
    {
        $q = $this->db->query("SELECT SUM(by_price) as stock_by_price, SUM(by_cost) as stock_by_cost FROM ( Select sum(COALESCE(" . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products.quantity, 0))*price as by_price, sum(COALESCE(" 
        	. $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products.quantity, 0))*cost as by_cost FROM " . $this->db_prefix . "_" . $this->mod_data . "_san_pham_rows 
        	JOIN " . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products ON 
        	" . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products.product_id=" . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_san_pham_rows.id 
        	WHERE " . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products.warehouse_id = " . $id . " GROUP BY " . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_san_pham_rows.id )a "  );
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getStockValue($store_id= NULL)
    {
		global $global_config;
    	$all_warehouse=array();
    	if($store_id > 0) {
    		$all_warehouse = $this->site->getAllWarehouses($store_id);
			
			if($all_warehouse != FALSE){
	    		foreach ( $all_warehouse as $key => $value) {
					$list_warehouse_store[]=$value->id;
				};
			}else{
				$list_warehouse_store[]=0;
			}
    		
    	}else{
			if(!empty($this->site->getAllWarehouses(0)))
    		foreach ($this->site->getAllWarehouses(0) as $key => $value) {
				$list_warehouse_store[]=$value->id;
			};
    	}
		if(!empty($list_warehouse_store))
			$list_wh_id = implode(',',$list_warehouse_store);
		else
			$list_wh_id = '';
    	if($list_wh_id !=''){
			$where = " " . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products.warehouse_id IN ( " . $list_wh_id . ")";
    	}else{
			$where = "1";
		}
    	//print_r($store_id);
        $q = $this->db->query("SELECT SUM(by_price) as stock_by_price, SUM(by_cost) as stock_by_cost FROM ( Select sum(COALESCE(" . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products.quantity, 0))*price as by_price, sum(COALESCE(" 
        	. $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products.quantity, 0))*cost as by_cost FROM " . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_san_pham_rows 
        	JOIN " . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products ON 
        	" . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products.product_id=" . $this->db_systems . '.' . $this->db_prefix . "_san_pham_rows.id 
        	WHERE " . $where . " GROUP BY " . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_san_pham_rows.id ) a " );
        
        
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getWarehouseTotals($store_id = NULL)
    {
		global $global_config;
    	$all_warehouse=array();
    	if($store_id > 0) {
    		$all_warehouse = $this->site->getAllWarehouses( $store_id);
			
			if($all_warehouse != FALSE){
	    		foreach ( $all_warehouse as $key => $value) {
					$list_warehouse_store[]=$value->id;
				};
			}else{
				$list_warehouse_store[]=0;
			}
    		
    	}else{
			if(!empty($this->site->getAllWarehouses(0)))
    		foreach ($this->site->getAllWarehouses(0) as $key => $value) {
				$list_warehouse_store[]=$value->id;
			};
    	}
    	if(!empty($list_warehouse_store))
			$list_wh_id = implode(',',$list_warehouse_store);
		else
			$list_wh_id = '';
		if($list_wh_id !=''){
			$where = 'AND warehouse_id IN (' . $list_wh_id . ')';
    	}else{
			$where = "";
		}
		
        $this->db->sqlreset()->select('sum(quantity) as total_quantity, count(id) as total_items')
		->from($this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products")
		->where('quantity != 0 ' . $where);
		//die($this->db->sql());
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getBestSeller($start_date, $end_date, $store_id = NULL, $warehouse_id = NULL)
    {
    	if( $store_id > 0 && $warehouse_id > 0){
    		$list_wh_id = $warehouse_id;
    	}else{
    		$all_warehouse=array();
	    	if($store_id > 0) {
	    		$all_warehouse = $this->site->getAllWarehouses($store_id);
				
				if($all_warehouse != FALSE){
		    		foreach ( $all_warehouse as $key => $value) {
						$list_warehouse_store[]=$value->id;
					};
				}else{
					$list_warehouse_store[]=0;
				}
	    		
	    	}else{
				if(!empty($this->site->getAllWarehouses(0)))
	    		foreach ($this->site->getAllWarehouses(0) as $key => $value) {
					$list_warehouse_store[]=$value->id;
				};
	    	}
			if(!empty($list_warehouse_store))
				$list_wh_id = implode(',',$list_warehouse_store);
			else
				$list_wh_id = '';
    	}
    	if($list_wh_id != '')
			$where= ' AND ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sale_items.warehouse_id IN (' . $list_wh_id . ')';
		else
			$where= '';
		//print_r($where);
        $this->db->sqlreset()
            ->select("" . $this->db_systems . '.' . $this->db_prefix . "_san_pham_rows." . NV_LANG_DATA . "_title as product_name, " . $this->db_systems . '.' . $this->db_prefix . "_san_pham_rows.product_code as product_code, sum(" . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_sale_items.quantity) as total_quantity")
			->from($this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_sale_items")
            ->join('LEFT JOIN ' . $this->db_systems . '.' .  $this->db_prefix . '_' . $this->mod_data . '_sales ON ' . $this->db_prefix . '_' . $this->mod_data . '_sales.id = ' . $this->db_systems . '.' .  $this->db_prefix . '_' . $this->mod_data . '_sale_items.sale_id LEFT JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_san_pham_rows ON ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sale_items.product_id = ' . $this->db_systems . '.' . $this->db_prefix . '_san_pham_rows.id ')
            ->where('date >= '. $start_date . ' AND date <= 1541063634 ' . $where)
            ->group('product_name, product_code')
            ->order('total_quantity desc')
            ->limit(10);
        /* print_r($this->db->sql()); */
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }else{
        	$data[]=array();
			return $data;
        }
        return FALSE;
    }
	public function getStaffDailySales($user_id, $year, $month, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
            FROM " . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_sales WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id = " . $warehouse_id . " AND ";
        }
        $myQuery .= " created_by = " .  $user_id . " AND DATE_FORMAT( date,  '%Y-%m' ) =  '" . $year . "-" . $month . "'
            GROUP BY DATE_FORMAT( date,  '%e' )";
        $q = $this->db->query($myQuery);
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	public function getDailySales($year, $month, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( FROM_UNIXTIME(date),  '%e' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
            FROM " . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_sales WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id IN ( " .$warehouse_id. ") AND ";
        }
        $myQuery .= " DATE_FORMAT( FROM_UNIXTIME(date),  '%Y-%m' ) =  '" .$year. "-" .$month. "'
            GROUP BY DATE_FORMAT( FROM_UNIXTIME(date),  '%e' )";
			//die($myQuery);
        $q = $this->db->query($myQuery);
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	public function getMonthlySales($year, $warehouse_id = NULL)
    {
        $myQuery = "SELECT DATE_FORMAT( FROM_UNIXTIME(date),  '%c' ) AS date, SUM( COALESCE( product_tax, 0 ) ) AS tax1, SUM( COALESCE( order_tax, 0 ) ) AS tax2, SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( total_discount, 0 ) ) AS discount, SUM( COALESCE( shipping, 0 ) ) AS shipping
            FROM " . $this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_sales WHERE ";
        if ($warehouse_id) {
            $myQuery .= " warehouse_id IN ( " .$warehouse_id. ") AND ";
        }
        $myQuery .= " DATE_FORMAT( FROM_UNIXTIME(date),  '%Y' ) =  '" . $year . "'
            GROUP BY date_format( FROM_UNIXTIME(date), '%c' ) ORDER BY date_format( FROM_UNIXTIME(date), '%c' ) ASC";
			//die($myQuery);
		$q = $this->db->query($myQuery);	
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	public function getPurchasesTotals($supplier_id)
    {
        $this->db->sqlreset()->select('SUM(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid')
        	->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchases')
            ->where('supplier_id = ' . $supplier_id);
            //print_r($this->db->sql());die;
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
        	
            return $q->fetch();
        }
        return FALSE;
    }
	public function getSupplierPurchases($supplier_id)
    {
        $this->db->sqlreset()->select("*")
        	->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchases')
        	->where('supplier_id = ' . $supplier_id);
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->rowCount();
        }
        return FALSE;
    }
	 public function getStaff()
    {
        if ($this->Admin) {
            $this->db->where('group_id !=', 1);
        }
        $this->db->where('group_id !=', 3)->where('group_id !=', 4);
        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	public function getSalesTotals($customer_id)
    {

       $this->db->sqlreset()->select('SUM(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid', FALSE)
	   		->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales')
            ->where('customer_id =' . $customer_id);
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->fetch();
        }
        return FALSE;
    }
	public function getCustomerSales($customer_id)
    {
    	$this->db->sqlreset()->select("*")
        	->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales')
        	->where('customer_id = ' . $customer_id);
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->rowCount();
        }
        return FALSE;
    }
	public function getCustomerProject($customer_id)
    {
    	$this->db->sqlreset()->select("*")
        	->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_project')
        	->where('customerid = ' . $customer_id);
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	public function getCustomerQuotes($customer_id)
    {
    	$this->db->sqlreset()->select("*")
        	->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_quotes')
        	->where('customer_id = ' . $customer_id);
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->rowCount();
        }
        return FALSE;
    }
	public function getCustomerReturns($customer_id)
    {
    	$this->db->sqlreset()->select("*")
        	->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales')
        	->where('customer_id = ' . $customer_id . ' AND sale_status = 4');
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->rowCount();
        }
        return FALSE;
    }
	public function getProductItemsBySupplier($supplier_id) {
		$this -> db ->sqlreset() -> select('  pi.product_id,pr.name, sum(pi.quantity) as quantity, sum(pi.quantity_balance) as balance, pr.purchase_unit, u.name as purchase_unit_name')
		->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items as pi')
		-> join('LEFT JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchases p on pi.purchase_id = p.id LEFT JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_san_pham_rows pr on pi.product_id = pr.id LEFT JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_units u on pr.purchase_unit = u.id')
		->where('p.supplier_id = ' . $supplier_id)
		->group('pi.product_id');
		//print_r($this->db->sql()); die;
		$q = $this -> db -> query($this->db->sql());
		if ($q -> rowCount() > 0) {
			foreach (($q->fetchAll(5)) as $row) {
				$row->balance_format = storehouse_number_format($row->balance,0);
				$row->quantity_format = storehouse_number_format($row->quantity,0);
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}
	public function getTotalPurchases($start, $end, $warehouse_id = NULL)
    {
    	if ($warehouse_id) {
            $where = ' AND warehouse_id = ' . $warehouse_id;
        }else
			$where = '';
        $this->db->sqlreset()->select('count(id) as total, COALESCE(sum(grand_total), 0) as total_amount, COALESCE(SUM(paid), 0) as paid, COALESCE(SUM(total_tax), 0) as tax')
        	->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchases')
            ->where('status !=3 AND date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
        $q = $this->db->query($this->db->sql());
		//print_r($this->db->sql());die;
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getTotalSales($start, $end, $warehouse_id = NULL)
    {
    	if ($warehouse_id) {
            $where = ' AND warehouse_id = ' . $warehouse_id;
        }else
			$where = '';
        $this->db->select('count(id) as total, COALESCE(sum(grand_total), 0) as total_amount, COALESCE(SUM(paid), 0) as paid, COALESCE(SUM(total_tax), 0) as tax')
			->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales')
            ->where('sale_status !=3 AND date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
        if ($warehouse_id) {
            $this->db->where('warehouse_id', $warehouse_id);
        }
        $q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getTotalReturnSales($start, $end, $warehouse_id = NULL)
    {
    	if ($warehouse_id) {
            $where = ' AND warehouse_id = ' . $warehouse_id;
        }else
			$where = '';
        $this->db->select('count(id) as total, sum(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid, SUM(COALESCE(total_tax, 0)) as tax')
            ->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_returns')
            ->where('date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
        $q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getTotalExpenses($start, $end, $warehouse_id = NULL)
    {
    	if ($warehouse_id) {
            $where = ' AND warehouse_id = ' . $warehouse_id;
        }else
			$where = '';
        $this->db->select('count(id) as total, sum(COALESCE(amount, 0)) as total_amount')
			->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_expenses')
            ->where('date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
		$q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getTotalPaidAmount($start, $end)
    {
		$where = '';
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount')
			->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_payments')
            ->where('type = "sent" AND  date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
        $q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getTotalReceivedAmount($start, $end)
    {
		$where = '';
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount')
			->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_payments')
            ->where('type = "received" AND  date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
		$q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getTotalReceivedCashAmount($start, $end)
    {
		$where = '';
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount')
			->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_payments')
            ->where('type = "received" AND paid_by = "cash" AND date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
        $q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }

    public function getTotalReceivedCCAmount($start, $end)
    {
		$where = '';
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
			->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_payments')
            ->where('type = "received" AND paid_by = "CC" AND date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
        $q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }

    public function getTotalReceivedChequeAmount($start, $end)
    {
		$where = '';
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
			->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_payments')
            ->where('type = "received" AND paid_by = "Cheque" AND date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
        $q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }

    public function getTotalReceivedPPPAmount($start, $end)
    {
		$where = '';
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
			->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_payments')
            ->where('type = "received" AND paid_by = "ppp" AND date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
        $q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }

    public function getTotalReceivedStripeAmount($start, $end)
    {
		$where = '';
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
			->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_payments')
            ->where('type = "received" AND paid_by = "stripe" AND date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
        $q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }

    public function getTotalReturnedAmount($start, $end)
    {
		$where = '';
        $this->db->select('count(id) as total, SUM(COALESCE(amount, 0)) as total_amount', FALSE)
			->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_payments')
            ->where('type = "returned"  AND date BETWEEN ' . $start . ' and ' . $end . ' ' . $where);
        $q = $this->db->query($this->db->sql());
        if ($q -> rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function export_excel($start, $end)
	{
		global $array_customer_id_storehouse,$array_warehouse_id_storehouse;
		$where = '1 ';
		if (!empty($start)) {
	        $where .=' AND date >= ' . $start;
	    }
		 if (!empty($end)) {
	        $where .=' AND date < ' . $end;
	    }
		$this->db->select('*')
			->from('' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales')
	        ->order('id DESC')
			->where($where);
	    $sth = $this->db->prepare($this->db->sql());
		$sth->execute();
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);
		$excel->getActiveSheet()->setTitle($this->lang['sales'] . ' ' . date("d-m-Y", $start) . '-' .  date("d-m-Y", $end));
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
		$excel->getActiveSheet()->setCellValue('A1', 'Number');
		$excel->getActiveSheet()->setCellValue('B1', $this->lang['reference_no']);
		$excel->getActiveSheet()->setCellValue('C1', $this->lang['date']);
		$excel->getActiveSheet()->setCellValue('D1', $this->lang['customer_id']);
		$excel->getActiveSheet()->setCellValue('E1', $this->lang['warehouse_id']);
		$excel->getActiveSheet()->setCellValue('F1', $this->lang['total']);
		$excel->getActiveSheet()->setCellValue('G1', $this->lang['paid']);
		$number = 1;
		$numRow = 2;
		while( $view = $sth->fetch() )
		{
			$view['date'] = (empty($view['date'])) ? '' : nv_date('H:i d/m/Y', $view['date']);
			$view['money_nofomart'] = storehouse_number_format( (($view['grand_total'] -  $view['paid']) > 0) ? ($view['grand_total'] -  $view['paid']) : 0 ,0,'','');
			$view['grand_total_fomart'] = storehouse_number_format( $view['grand_total'],0,'','');
			$view['customer_id'] = $array_customer_id_storehouse[$view['customer_id']]['company'];
			$view['warehouse_id'] = $array_warehouse_id_storehouse[$view['warehouse_id']]['name'];
			$view['status'] = $array_sales_status[$view['sale_status']];
			$view['payment_status'] = $array_payment_status[$view['payment_status']];
			$view['total'] = storehouse_number_format( $view['total'] ,0,'','');
			$view['paid'] = storehouse_number_format( $view['paid'] ,0,'','');
							
			$excel->getActiveSheet()->setCellValue('A'.$numRow, $number);
			$excel->getActiveSheet()->setCellValue('B'.$numRow, $view['reference_no']);
			$excel->getActiveSheet()->setCellValue('C'.$numRow, $view['date']);
			$excel->getActiveSheet()->setCellValue('D'.$numRow, $view['customer_id']);
			$excel->getActiveSheet()->setCellValue('E'.$numRow, $view['warehouse_id']);
			$excel->getActiveSheet()->setCellValue('F'.$numRow, $view['grand_total_fomart'] );
			$excel->getActiveSheet()->setCellValue('G'.$numRow, $view['paid']);
			
			
			$numRow++;
			$number++;
		
		}
			
			
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Data_Report_Sales_' . date("d_m_Y", $start) . '-' .  date("d_m_Y", $end) . '.xls"');
		PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
		
	}
	public function export_product_excel($start, $end)
	{
		$products=$this->getInventory($start, $end, 0);
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);
		$excel->getActiveSheet()->setTitle($this->lang['sales'] . ' ' . date("d-m-Y", $start) . '-' .  date("d-m-Y", $end));
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
		$excel->getActiveSheet()->setCellValue('A1', 'Number');
		$excel->getActiveSheet()->setCellValue('B1', $this->lang['product_code']);
		$excel->getActiveSheet()->setCellValue('C1', $this->lang['product_name']);
		$excel->getActiveSheet()->setCellValue('D1', $this->lang['peroidbg']);
		$excel->getActiveSheet()->setCellValue('E1', $this->lang['purchasesin']);
		$excel->getActiveSheet()->setCellValue('F1', $this->lang['salessin']);
		$excel->getActiveSheet()->setCellValue('G1', $this->lang['peroidend']);
		$number = 1;
		$numRow = 2;
		foreach ($products as $product){	
			$excel->getActiveSheet()->setCellValue('A'.$numRow, $number);
			$excel->getActiveSheet()->setCellValue('B'.$numRow, $product['code']);
			$excel->getActiveSheet()->setCellValue('C'.$numRow, $product['name']);
			$excel->getActiveSheet()->setCellValue('D'.$numRow, $product['beginperiod']);
			$excel->getActiveSheet()->setCellValue('E'.$numRow, $product['purchasedqtyin']);
			$excel->getActiveSheet()->setCellValue('F'.$numRow, $product['soldqtyin'] );
			$excel->getActiveSheet()->setCellValue('G'.$numRow, $product['endperoid']);
			
			
			$numRow++;
			$number++;
		
		}
			
			
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Data_Report_Product_' . str_replace('/', '_', $start) . '-' .  str_replace('/', '_', $end) . '.xls"');
		PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
		
	}
}
