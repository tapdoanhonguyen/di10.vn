<?php 


class Pos_model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProducts($cat_id = 0)
    {
    	if($cat_id > 0){
    		$where= "WHERE category_id = " . $cat_id;
    	}else{
    		$where= "";
    	};
		
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_products ' .$where );
        if ($q->rowCount() > 0) {
            return $q->fetchAll(5);
        }
        return FALSE;
    }
	public function getWHProduct($code, $warehouse_id)
    {
    	$this->db->sqlreset()->select('type')
			->from($this->db_prefix . '_' . $this->mod_data . '_products')
			->where('code = "' . $code . '"');
		$product=$this->db->query($this->db->sql())->fetch(5);
		if($product->type=="material"){
			$this->db->sqlreset()->select('products.*, warehouses_products.quantity, categories.id as category_id, categories.name as category_name')
			->from($this->db_prefix . '_' . $this->mod_data . '_products as products')
            ->join('LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_warehouses_products as warehouses_products ON warehouses_products.product_id=products.id
            		LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_categories as categories ON categories.id=products.category_id')
            ->group('products.id')
			->where('products.code = "' . $code . '"');
		}else{
			$this->db->sqlreset()->select('products.*,  categories.id as category_id, categories.name as category_name')
			->from($this->db_prefix . '_' . $this->mod_data . '_products as products')
            ->join('LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_categories as categories ON categories.id=products.category_id')
            ->group('products.id')
			->where('products.code = "' . $code . '"');
		}
        
			//die($this->db->sql());
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
        	if($product->type=="material"){
            	return $q->fetch(5);
			}else{
				$data = $q->fetch();
				
				$data['quantity'] = 1000000;
				
				$datas = (object) $data;
				//print_r($datas);die;
				return $datas;
			}
        }

        return FALSE;
    }
	public function getProductOptions($product_id, $warehouse_id, $all = NULL)
    {
        $wpv = "( SELECT option_id, warehouse_id, quantity from " . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products_variants WHERE product_id = " . $product_id . ") FWPV";
        $this->db->select('product_variants.id as id, product_variants.name as name, product_variants.price as price, product_variants.quantity as total_quantity, FWPV.quantity as quantity', FALSE)
            ->from($this->db_prefix . '_' . $this->mod_data . '_product_variants as product_variants')
		    ->join('LEFT JOIN ' . $wpv . ' ON FWPV.option_id=product_variants.id')
            //->join('warehouses', 'warehouses.id=product_variants.warehouse_id', 'left')
            ->where('product_variants.product_id =' . $product_id)
            ->group('product_variants.id');

        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    public function products_count($category_id, $subcategory_id = NULL, $brand_id = NULL)
    {
        
        $this->db->sqlreset()->select('*')->from($this->db_prefix . '_' . $this->mod_data . '_products');
		if ($category_id) {
            $this->db->where('category_id = '. $category_id);
        }
        return $this->db->query($this->db->sql())->fetchAll(5);
    }
	public function fetch_products($category_id, $limit, $start, $subcategory_id = NULL, $brand_id = NULL)
    {
    	
        if ($brand_id) {
            $where = 'brand = '. $brand_id;
        } elseif ($category_id) {
            $where = 'category_id = ' . $category_id;
        }
		
		$this->db->sqlreset()->select('*')->from($this->db_prefix . "_" . $this->mod_data . "_products");
        $this->db->limit($limit, $start);
		$this->db->where($where);
        $this->db->order("name asc");

        $query = $this->db->query($this->db->sql());
	
        if ($query->rowCount() > 0) {
            foreach ($query->fetchAll(5) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	public function fetch_products_second($category_id, $limit, $start, $subcategory_id = NULL, $brand_id = NULL)
    {
    	
        if ($brand_id) {
            $where = 'brand = '. $brand_id;
        } elseif ($category_id) {
            $where = 'subsecond_category_id = ' . $category_id;
        }
		
		$this->db->sqlreset()->select('*')->from($this->db_prefix . "_" . $this->mod_data . "_products");
        $this->db->limit($limit, $start);
		$this->db->where($where);
        $this->db->order("name asc");

        $query = $this->db->query($this->db->sql());
	
        if ($query->rowCount() > 0) {
            foreach ($query->fetchAll(5) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	public function addSales($data = array(), $items = array(), $payment = array(), $si_return = array())
    {
    	if (empty($si_return)) {
            $cost = $this->site->costing($items);
            // $this->sma->print_arrays($cost);
        }
		
        $stmt = $this -> db -> prepare('INSERT INTO ' . $this -> db_prefix . '_' . $this -> mod_data . '_sales (date, reference_no, customer_id, customer, biller_id, biller, warehouse_id, note, staff_note, total, product_discount, order_discount_id, total_discount, order_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, sale_status, payment_status, payment_term, due_date, created_by, updated_by, updated_at, total_items, paid, return_id, attachment, return_sale_ref, sale_id, rounding, suspend_note, api, shop, address_id, reserve_id, hash, manual_payment, cgst, sgst, igst, payment_method, module,pos) VALUES (:date, :reference_no, :customer_id, :customer, :biller_id, :biller, :warehouse_id, :note, :staff_note, :total, :product_discount, :order_discount_id, :total_discount, :order_discount, :product_tax, :order_tax_id, :order_tax, :total_tax, :shipping, :grand_total, :sale_status, :payment_status, :payment_term, :due_date, :created_by, :updated_by, :updated_at, :total_items, :paid, :return_id, :attachment, :return_sale_ref, :sale_id, :rounding, :suspend_note, :api, :shop, :address_id, :reserve_id, :hash, :manual_payment, :cgst, :sgst, :igst, :payment_method, :module, 1)');
        $stmt->bindParam(':date', $data['date'], PDO::PARAM_STR);
            $stmt->bindParam(':reference_no', $data['reference_no'], PDO::PARAM_STR);
            $stmt->bindParam(':customer_id', $data['customer_id'], PDO::PARAM_INT);
            $stmt->bindParam(':customer', $data['customer'], PDO::PARAM_STR);
            $stmt->bindParam(':biller_id', $data['biller_id'], PDO::PARAM_INT);
            $stmt->bindParam(':biller', $data['biller'], PDO::PARAM_STR);
            $stmt->bindParam(':warehouse_id', $data['warehouse_id'], PDO::PARAM_INT);
            $stmt->bindParam(':note', $data['note'], PDO::PARAM_STR);
            $stmt->bindParam(':staff_note', $data['staff_note'], PDO::PARAM_STR);
            $stmt->bindParam(':total', $data['total'], PDO::PARAM_STR);
            $stmt->bindParam(':product_discount', $data['product_discount'], PDO::PARAM_STR);
            $stmt->bindParam(':order_discount_id', $data['order_discount_id'], PDO::PARAM_STR);
            $stmt->bindParam(':total_discount', $data['total_discount'], PDO::PARAM_STR);
            $stmt->bindParam(':order_discount', $data['order_discount'], PDO::PARAM_STR);
            $stmt->bindParam(':product_tax', $data['product_tax'], PDO::PARAM_STR);
            $stmt->bindParam(':order_tax_id', $data['order_tax_id'], PDO::PARAM_INT);
            $stmt->bindParam(':order_tax', $data['order_tax'], PDO::PARAM_STR);
            $stmt->bindParam(':total_tax', $data['total_tax'], PDO::PARAM_STR);
            $stmt->bindParam(':shipping', $data['shipping'], PDO::PARAM_STR);
            $stmt->bindParam(':grand_total', $data['grand_total'], PDO::PARAM_STR);
            $stmt->bindParam(':sale_status', $data['sale_status'], PDO::PARAM_INT);
            $stmt->bindParam(':payment_status', $data['payment_status'], PDO::PARAM_INT);
            $stmt->bindParam(':payment_term', $data['payment_term'], PDO::PARAM_INT);
            $stmt->bindParam(':due_date', $data['due_date'], PDO::PARAM_STR);
            $stmt->bindParam(':created_by', $data['customer_id'], PDO::PARAM_INT);
            $stmt->bindParam(':updated_by', $data['customer_id'], PDO::PARAM_INT);
            $stmt->bindParam(':updated_at', $data['updated_at'], PDO::PARAM_STR);
            $stmt->bindParam(':total_items', $data['total_items'], PDO::PARAM_INT);
            $stmt->bindParam(':paid', $data['paid'], PDO::PARAM_INT);
            $stmt->bindParam(':return_id', $data['return_id'], PDO::PARAM_INT);
            $stmt->bindParam(':attachment', $data['attachment'], PDO::PARAM_STR);
            $stmt->bindParam(':return_sale_ref', $data['return_sale_ref'], PDO::PARAM_STR);
            $stmt->bindParam(':sale_id', $data['sale_id'], PDO::PARAM_INT);
            $stmt->bindParam(':rounding', $data['rounding'], PDO::PARAM_STR);
            $stmt->bindParam(':suspend_note', $data['suspend_note'], PDO::PARAM_STR);
            $stmt->bindParam(':api', $data['api'], PDO::PARAM_INT);
            $stmt->bindParam(':shop', $data['shop'], PDO::PARAM_INT);
            $stmt->bindParam(':address_id', $data['address_id'], PDO::PARAM_INT);
            $stmt->bindParam(':reserve_id', $data['reserve_id'], PDO::PARAM_INT);
            $stmt->bindParam(':hash', $data['hash'], PDO::PARAM_STR);
            $stmt->bindParam(':manual_payment', $data['manual_payment'], PDO::PARAM_STR);
            $stmt->bindParam(':cgst', $data['cgst'], PDO::PARAM_STR);
            $stmt->bindParam(':sgst', $data['sgst'], PDO::PARAM_STR);
            $stmt->bindParam(':igst', $data['igst'], PDO::PARAM_STR);
            $stmt->bindParam(':payment_method', $data['payment_method'], PDO::PARAM_STR);
			$stmt->bindParam(':module', $this->mod_data_sales, PDO::PARAM_STR);

            if ($stmt -> execute()) {
            	 $sale_id = $this -> db -> lastInsertId();
	            if ($this->site->getReference('so') == $data['reference_no']) {
	                $this->site->updateReference('so');
	            }
				foreach ($items as $pro_id => $item) {
					
					$item['sale_id'] = $sale_id;
					$stmt = $this -> db -> prepare('INSERT INTO ' . $this->db_prefix . '_' . $this->mod_data . '_sale_items (sale_id, product_id, product_code, product_name, product_type, option_id, net_unit_price, unit_price, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, subtotal, serial_no, real_unit_price, sale_item_id, product_unit_id, product_unit_code, unit_quantity, comment, gst, cgst, sgst, igst, module) VALUES (:sale_id, :product_id, :product_code, :product_name, :product_type, :option_id, :net_unit_price, :unit_price, :quantity, :warehouse_id, :item_tax, :tax_rate_id, :tax, :discount, :item_discount, :subtotal, :serial_no, :real_unit_price, :sale_item_id, :product_unit_id, :product_unit_code, :unit_quantity, :comment, :gst, :cgst, :sgst, :igst, :module)');
					$stmt->bindParam(':sale_id', $item['sale_id'], PDO::PARAM_INT);
		            $stmt->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
		            $stmt->bindParam(':product_code', $item['product_code'], PDO::PARAM_STR);
		            $stmt->bindParam(':product_name', $item['product_name'], PDO::PARAM_STR);
		            $stmt->bindParam(':product_type', $item['product_type'], PDO::PARAM_STR);
		            $stmt->bindParam(':option_id', $item['option_id'], PDO::PARAM_INT);
		            $stmt->bindParam(':net_unit_price', $item['net_unit_price'], PDO::PARAM_STR);
		            $stmt->bindParam(':unit_price', $item['unit_price'], PDO::PARAM_STR);
		            $stmt->bindParam(':quantity', $item['quantity'], PDO::PARAM_STR);
		            $stmt->bindParam(':warehouse_id', $item['warehouse_id'], PDO::PARAM_INT);
		            $stmt->bindParam(':item_tax', $item['item_tax'], PDO::PARAM_STR);
		            $stmt->bindParam(':tax_rate_id', $item['tax_rate_id'], PDO::PARAM_INT);
		            $stmt->bindParam(':tax', $item['tax'], PDO::PARAM_STR);
		            $stmt->bindParam(':discount', $item['discount'], PDO::PARAM_STR);
		            $stmt->bindParam(':item_discount', $item['item_discount'], PDO::PARAM_STR);
		            $stmt->bindParam(':subtotal', $item['subtotal'], PDO::PARAM_STR);
		            $stmt->bindParam(':serial_no', $item['serial_no'], PDO::PARAM_STR);
		            $stmt->bindParam(':real_unit_price', $item['real_unit_price'], PDO::PARAM_STR);
		            $stmt->bindParam(':sale_item_id', $item['sale_item_id'], PDO::PARAM_INT);
		            $stmt->bindParam(':product_unit_id', $item['product_unit_id'], PDO::PARAM_INT);
		            $stmt->bindParam(':product_unit_code', $item['product_unit_code'], PDO::PARAM_STR);
		            $stmt->bindParam(':unit_quantity', $item['unit_quantity'], PDO::PARAM_STR);
		            $stmt->bindParam(':comment', $item['comment'], PDO::PARAM_STR);
		            $stmt->bindParam(':gst', $item['gst'], PDO::PARAM_STR);
		            $stmt->bindParam(':cgst', $item['cgst'], PDO::PARAM_STR);
		            $stmt->bindParam(':sgst', $item['sgst'], PDO::PARAM_STR);
		            $stmt->bindParam(':igst', $item['igst'], PDO::PARAM_STR);
		            $stmt->bindParam(':module', $this->mod_data_sales, PDO::PARAM_STR);
		            $exc = $stmt->execute();
					$sale_item_id = $this -> db -> lastInsertId();
					
					if ($data['sale_status'] == 4 && empty($si_return)) {
						$item_costs = $this->site->item_costing($item);
						//print_r($item_costs);
						foreach ($item_costs as $item_cost) {
							if (isset($item_cost['date']) || isset($item_cost['pi_overselling'])) {
								$item_cost['sale_item_id'] = $sale_item_id;
								$item_cost['sale_id'] = $sale_id;
								$item_cost['date'] = date('Y-m-d', strtotime($data['date']));
								if(! isset($item_cost['pi_overselling'])) {
									//$this->db->insert('costing', $item_cost);
									$row = $item_cost;
								}
							} else {
								foreach ($item_cost as $ic) {
									$ic['sale_item_id'] = $sale_item_id;
									$ic['sale_id'] = $sale_id;
									$ic['date'] = date('Y-m-d', strtotime($data['date']));
									if(! isset($ic['pi_overselling'])) {
										//$this->db->insert('costing', $ic);
										$row = $ic;
									}
								}
							}
							$stmt = $this -> db ->prepare('INSERT INTO ' . $this->db_prefix . '_' . $this->mod_data . '_costing (date, product_id, sale_item_id, sale_id, purchase_item_id, quantity, purchase_net_unit_cost, purchase_unit_cost, quantity_balance, inventory, overselling, option_id) VALUES (:date, :product_id, :sale_item_id, :sale_id, :purchase_item_id, :quantity, :purchase_net_unit_cost, :purchase_unit_cost, :quantity_balance, :inventory, :overselling, :option_id)');
							$stmt->bindParam(':date', $row['date'], PDO::PARAM_STR);
							$stmt->bindParam(':product_id', $row['product_id'], PDO::PARAM_INT);
							$stmt->bindParam(':sale_item_id', $row['sale_item_id'], PDO::PARAM_INT);
							$stmt->bindParam(':sale_id', $row['sale_id'], PDO::PARAM_INT);
							$stmt->bindParam(':purchase_item_id', $row['purchase_item_id'], PDO::PARAM_INT);
							$stmt->bindParam(':quantity', $row['quantity'], PDO::PARAM_STR);
							$stmt->bindParam(':purchase_net_unit_cost', $row['purchase_net_unit_cost'], PDO::PARAM_STR);
							$stmt->bindParam(':purchase_unit_cost', $row['purchase_unit_cost'], PDO::PARAM_STR);
							$stmt->bindParam(':quantity_balance', $row['quantity_balance'], PDO::PARAM_STR);
							$stmt->bindParam(':inventory', $row['inventory'], PDO::PARAM_INT);
							$stmt->bindParam(':overselling', $row['overselling'], PDO::PARAM_INT);
							$stmt->bindParam(':option_id', $row['option_id'], PDO::PARAM_INT);
							$exc = $stmt->execute();
						}
					}
					
				}
				
				if ($data['sale_status'] == 4) {
					$this->site->syncPurchaseItems($cost);
				}
				if (!empty($si_return)) {
					foreach ($si_return as $return_item) {
						$product = $this->site->getProductByID($return_item['product_id']);
					}
				}
				if ($data['payment_status'] == 8 || $data['payment_status'] == 9 && !empty($payment)) {
					if (empty($payment['reference_no'])) {
						$payment['reference_no'] = $this->site->getReference('pay');
					}
					$payment['sale_id'] = $sale_id;
					if ($payment['paid_by'] == 'gift_card') {
						$this->db->update('gift_cards', array('balance' => $payment['gc_balance']), array('card_no' => $payment['cc_no']));
						unset($payment['gc_balance']);
						$this->db->insert('payments', $payment);
					} else {
						if ($payment['paid_by'] == 'deposit') {
							$customer = $this->site->getCompanyByID($data['customer_id']);
							$this->db->update('companies', array('deposit_amount' => ($customer->deposit_amount-$payment['amount'])), array('id' => $customer->id));
						}
						$this->db->insert('payments', $payment);
					}
					if ($this->site->getReference('pay') == $payment['reference_no']) {
						$this->site->updateReference('pay');
					}
					$this->site->syncSalePayments($sale_id);
					
				}
				
				$this->site->syncQuantity($sale_id);
	            //$this->sma->update_award_points($data['grand_total'], $data['customer_id'], $data['created_by']);
				$order_bill=array(
					'oder_bill'=>$sale_id,
					'date' => date('d/m/Y H:i',$data['date']),
					'order_code' => $data['reference_no']
				);
				$this->site->updateReference('orpos');
	            return $order_bill;
			} 
			
        return FALSE;
    }
	public function getProductByCode($code)
    {
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_products WHERE code = "' . $code . '"');
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getOpenBillByID($id)
    {
		$q = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_suspended_bills WHERE id = "' . $id . '"');
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getPrinterByID($id) {
		$q = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_printers WHERE id = "' . $id . '"');
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getInvoiceByID($id)
    {
		$q = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_sales WHERE id = "' . $id . '"');
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getAllInvoiceItems($sale_id)
    {
        if ($this->pos_settings->item_order == 0) {
            $this->db->sqlreset()->select('sale_items.*, tax_rates.code as tax_code, tax_rates.name as tax_name, tax_rates.rate as tax_rate, product_variants.name as variant, products.details as details, products.hsn_code as hsn_code, products.second_name as second_name')
			->from($this->db_prefix . '_' . $this->mod_data . '_sale_items sale_items')
            ->join('LEFT JOIN  ' . $this->db_prefix . '_' . $this->mod_data . '_products products ON products.id=sale_items.product_id LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_tax_rates tax_rates ON tax_rates.id=sale_items.tax_rate_id LEFT JOIN  ' . $this->db_prefix . '_' . $this->mod_data . '_product_variants product_variants ON product_variants.id=sale_items.option_id')
            ->group('sale_items.id')
            ->order('id asc');
        } elseif ($this->pos_settings->item_order == 1) {
            $this->db->sqlreset()->select('sale_items.*, tax_rates.code as tax_code, tax_rates.name as tax_name, tax_rates.rate as tax_rate, product_variants.name as variant, categories.id as category_id, categories.name as category_name, products.details as details, products.hsn_code as hsn_code, products.second_name as second_name')
			->from($this->db_prefix . '_' . $this->mod_data . '_sale_items ')
            ->join('LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_tax_rates tax_rates ON tax_rates.id=sale_items.tax_rate_id LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_product_variants product_variants ON product_variants.id=sale_items.option_id LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_products products ON products.id=sale_items.product_id LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_categories categories ON categories.id=products.category_id')
            ->group('sale_items.id')
            ->order('categories.id asc');
        }
		$this->db->where('sale_id = ' . $sale_id);
		$query = $this->db->query($this->db->sql());
        if ($query->rowCount() > 0) {
            foreach ($query->fetchAll(5) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	public function getInvoicePayments($sale_id)
    {
        $query = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_payments WHERE sale_id = "' . $sale_id . '"');
        if ($query->rowCount() > 0) {
            foreach ($query->fetchAll(5) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
}
