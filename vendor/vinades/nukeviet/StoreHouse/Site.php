<?php 
 use NukeViet\StoreHouse\Tec_barcode;
class Site extends Model
{

    public function __construct() {
        parent::__construct();
		
    }

    public function get_total_qty_alerts() {
        $where = 'WHERE quantity < alert_quantity AND track_quantity = 1';
		
        return $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_products ' . $where)->rowCount(); 
    }

    public function get_expiring_qty_alerts() {
        $date = date('Y-m-d', strtotime('+3 months'));
        $this->db->sqlreset()->select('SUM(quantity_balance) as alert_num')
        ->where('expiry != NULL AND expiry != "0000-00-00" AND expiry < '. $date);
        $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items');
        if ($q->rowCount() > 0) {
            $res = $q->fetch(PDO::FETCH_OBJ);
            return (INT) $res->alert_num;
        }
        return FALSE; 
    }

    public function get_shop_sale_alerts() {
       /*  $this->db->join('deliveries', 'deliveries.sale_id=sales.id', 'left')
        ->where('sales.shop', 1)->where('sales.sale_status', 'completed')->where('sales.payment_status', 'paid')
        ->group_start()->where('deliveries.status !=', 'delivered')->or_where('deliveries.status IS NULL', NULL)->group_end();
        return $this->db->count_all_results('sales'); */
    }

    public function get_shop_payment_alerts() {
      /*   $this->db->where('shop', 1)->where('attachment !=', NULL)->where('payment_status !=', 'paid');
        return $this->db->count_all_results('sales'); */
    }

    public function get_setting() {
    	//print_r('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_products ' . $where);die;
		$q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_settings ');
		 
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        } 
        return FALSE;
    }

    public function getDateFormat($id) {
        $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_date_format WHERE id =' . $id);
        if ($q->rowCount() > 0) {
            return $q->fetch(PDO::FETCH_OBJ);
        } 
        return FALSE;
    }

    public function getAllCompanies($group_name) {
/*         $q = $this->db->get_where('companies', array('group_name' => $group_name));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }

    public function getCompanyByID($id) {
        $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_companies WHERE id = ' . $id);
		 
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        } 
        return FALSE;
    }
	public function getUserByID($id) {
        $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_users WHERE userid = ' . $id);
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        } 
        return FALSE;
    }
	public function getStoreByID($id) {
        $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_stores WHERE store_id = ' . $id);
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        } 
        return FALSE;
    }
    public function getCustomerGroupByID($id) {
  /*       $q = $this->db->get_where('customer_groups', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function getUser($id = NULL) {
/*         if (!$id) {
            $id = $this->session->userdata('user_id');
        }
        $q = $this->db->get_where('users', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function getProductByID($id) {
         $q = $this->db->query('SELECT *, ' . NV_LANG_DATA . '_title name FROM ' . $this->db_systems . '.' . $this->db_prefix . '_san_pham_rows WHERE id = ' . $id);
        if ($q->rowCount() > 0) {
            return $q->fetch(PDO::FETCH_OBJ);
        } 
        return FALSE;
    }

    public function getAllCurrencies() {
/*         $q = $this->db->get('currencies');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }

    public function getCurrencyByCode($code) {
    /*     $q = $this->db->get_where('currencies', array('code' => $code), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function getAllTaxRates() {
/*         $q = $this->db->get('tax_rates');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }

    public function getTaxRateByID($id) {
         $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_tax_rates WHERE id=' . $id);
        if ($q->rowCount() > 0) {
            return $q->fetch(PDO::FETCH_OBJ);
        }
        return FALSE;
    }

     public function getAllWarehouses( $store_id = 0) {
		 global $global_config;
		$where = ' WHERE whidsite = ' . $global_config['idsite'] . ' AND whparentid = ' . $global_config['parentid'];
    	if($store_id > 0) {
    		$where .= ' AND store_id=' . $store_id;
    	}
        $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_warehouses ' . $where);
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getWarehouseByID($id) {
        $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_warehouses WHERE id=' . $id);
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        } 
        return FALSE;
    }

    public function getAllCategories() {
/*         $this->db->where('parent_id', NULL)->or_where('parent_id', 0)->order_by('name');
        $q = $this->db->get("categories");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }

    public function getSubCategories($parent_id) {
/*         $this->db->where('parent_id', $parent_id)->order_by('name');
        $q = $this->db->get("categories");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }
	 public function getSubSecondCategories($parent_id) {
/*         $this->db->where('parent_id', $parent_id)->order_by('name');
        $q = $this->db->get("categories");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }

    public function getCategoryByID($id) {
 /*        $q = $this->db->get_where('categories', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function getGiftCardByID($id) {
/*         $q = $this->db->get_where('gift_cards', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function getGiftCardByNO($no) {
        $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_gift_cards WHERE card_no = "' . $no .'"');
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        } 
        return FALSE;
    }

    public function updateInvoiceStatus() {
/*         $date = date('Y-m-d');
        $q = $this->db->get_where('invoices', array('status' => 'unpaid'));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                if ($row->due_date < $date) {
                    $this->db->update('invoices', array('status' => 'due'), array('id' => $row->id));
                }
            }
            $this->db->update('settings', array('update' => $date), array('setting_id' => '1'));
            return true;
        } */
    }

    public function modal_js() {
        return '<script type="text/javascript">' . file_get_contents($this->data['assets'] . 'js/modal.js') . '</script>';
    }

    public function getReference($field) {
		
    	$this->db->sqlreset()->select('*')->from($this->db_systems . '.' . $this->db_prefix . "_" . $this->mod_data . "_order_ref");
		$this->db->where('ref_id = 1');
		
         $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            $ref = $q->fetch(5);
            switch ($field) {
                case 'orso':
                    $prefix = $this->Settings->sales_prefix;
                    break;
                case 'orpos':
                    $prefix = isset($this->Settings->sales_prefix) ? $this->Settings->sales_prefix . '/POS' : '';
                    break;
                case 'orqu':
                    $prefix = $this->Settings->quote_prefix;
                    break;
                case 'orpo':
                    $prefix = $this->Settings->purchase_prefix;
                    break;
                case 'orto':
                    $prefix = $this->Settings->transfer_prefix;
                    break;
                case 'ordo':
                    $prefix = $this->Settings->delivery_prefix;
                    break;
                case 'pay':
                    $prefix = $this->Settings->payment_prefix;
                    break;
                case 'ppay':
                    $prefix = $this->Settings->ppayment_prefix;
                    break;
                case 'ex':
                    $prefix = $this->Settings->expense_prefix;
                    break;
                case 're':
                    $prefix = $this->Settings->return_prefix;
                    break;
                case 'rep':
                    $prefix = $this->Settings->returnp_prefix;
                    break;
                case 'qa':
                    $prefix = $this->Settings->qa_prefix;
                    break;
                default:
                    $prefix = '';
            }
			
            $ref_no = $prefix;
			
            if ($this->Settings->reference_format == 1) {
                $ref_no .= date('Y') . "/" . sprintf("%04s", $ref->{$field});
            } elseif ($this->Settings->reference_format == 2) {
                $ref_no .= date('Y') . "/" . date('m') . "/" . sprintf("%04s", $ref->{$field});
            } elseif ($this->Settings->reference_format == 3) {
                $ref_no .= sprintf("%04s", $ref->{$field});
            } else {
                $ref_no .= $this->getRandomReference();
            }
			
            return $ref_no;
        } 
        return FALSE;
    }

    public function getRandomReference($len = 12) {
         $result = '';
        for ($i = 0; $i < $len; $i++) {
            $result .= mt_rand(0, 9);
        }

        if ($this->getSaleByReference($result)) {
            $this->getRandomReference();
        } 

        return $result;
    }

    public function getSaleByReference($ref) {
    	$this->db->sqlreset()->select('*')->from($this->db_systems . "." . $this->db_prefix . "_" . $this->mod_data . "_sales");
		$this->db->where('reference_no like "%' . $ref . '%"');
         $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->fetch();
        } 
        return FALSE;
    }

    public function updateReference($field) {
        $this->db->sqlreset()->select('*')->from($this->db_systems . "." . $this->db_prefix . "_" . $this->mod_data . "_order_ref");
		$this->db->where('ref_id = 1');
		
         $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            $ref = $q->fetch(5);
			$num_field = $ref->{$field} + 1;
            $this->db->query ('UPDATE ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_order_ref SET ' . $field . ' = ' .   $num_field  . '  WHERE ref_id = 1');
            return TRUE;
        } 
        return FALSE;
    }

    public function checkPermissions() {
        $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_permissions WHERE group_id =' . $this->session->userdata($this->mod_data .'_group_id'));
        if ($q->rowCount() > 0) {
            return $q->fetch(PDO::FETCH_OBJ);
        } 
        return FALSE;
    }

    public function getNotifications() {
/*         $date = date('Y-m-d H:i:s', time());
        $this->db->where("from_date <=", $date);
        $this->db->where("till_date >=", $date);
        if (!$this->Owner) {
            if ($this->Supplier) {
                $this->db->where('scope', 4);
            } elseif ($this->Customer) {
                $this->db->where('scope', 1)->or_where('scope', 3);
            } elseif (!$this->Customer && !$this->Supplier) {
                $this->db->where('scope', 2)->or_where('scope', 3);
            }
        }
        $q = $this->db->get("notifications");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
    }

    public function getUpcomingEvents() {
/*         $dt = date('Y-m-d');
        $this->db->where('start >=', $dt)->order_by('start')->limit(5);
        if ($this->Settings->restrict_calendar) {
            $this->db->where('user_id', $this->session->userdata('user_id'));
        }

        $q = $this->db->get('calendar');

        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }

    public function getUserGroup($user_id = false) {
/*         if (!$user_id) {
            $user_id = $this->session->userdata('user_id');
        }
        $group_id = $this->getUserGroupID($user_id);
        $q = $this->db->get_where('groups', array('id' => $group_id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function getUserGroupID($user_id = false) {
    /*     $user = $this->getUser($user_id); */
        return $user->group_id;
    }

    public function getWarehouseProductsVariants($option_id, $warehouse_id = NULL) {
   /*      if ($warehouse_id) {
            $this->db->where('warehouse_id', $warehouse_id);
        }
        $q = $this->db->get_where('warehouses_products_variants', array('option_id' => $option_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }

    public function getPurchasedItem($clause) {
		global $global_config;
         $orderby = ($this->Settings->accounting_method == 1) ? 'asc' : 'desc';
		 $this->db->sqlreset()->select("*")
		 ->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items');
        $this->db->order('date '. $orderby . ', purchase_id ' . $orderby);
		$where = 'product_id = '. $clause['product_id'] . ' AND puiidsite = ' . $global_config['idsite'] . ' AND puiparentid = ' . $global_config['parentid'];
		
		$this->db->where($where);/* print_r($this->db->sql()); die; */
		
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        } 
        return FALSE;
    }

    public function setPurchaseItem($clause, $qty) {
		global $global_config;
         if ($product = $this->getProductByID($clause['product_id'])) {
            if ($pi = $this->getPurchasedItem($clause)) {
                $quantity_balance = $pi->quantity_balance+$qty;
                return $this->db->query('UPDATE ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items SET quantity_balance = ' . $quantity_balance. ' WHERE id =' . $pi->id );
            } else {
                $unit = $this->getUnitByID($product->product_unit);
                $clause['product_unit_id'] = $product->product_unit;
                $clause['product_unit_code'] = $unit->code;
                $clause['product_code'] = $product->product_code;
                $clause['product_name'] = $product->name;
                $clause['purchase_id'] = $clause['transfer_id'] = $clause['item_tax'] = NULL;
                $clause['net_unit_cost'] = $clause['real_unit_cost'] = $clause['unit_cost'] = $product->cost;
                $clause['quantity_balance'] = $clause['quantity'] = $clause['unit_quantity'] = $clause['quantity_received'] = $qty;
                $clause['subtotal'] = ($product->cost * $qty);
                if (isset($product->tax_rate) && $product->tax_rate != 0) {
                    $tax_details = $this->site->getTaxRateByID($product->tax_rate);
                    $ctax = $this->calculateTax($product, $tax_details, $product->cost);
                    $item_tax = $clause['item_tax'] = $ctax['amount'];
                    $tax = $clause['tax'] = $ctax['tax'];
                    $clause['tax_rate_id'] = $tax_details->id;
                    if ($product->tax_method != 1) {
                        $clause['net_unit_cost'] = $product->cost - $item_tax;
                        $clause['unit_cost'] = $product->cost;
                    } else {
                        $clause['net_unit_cost'] = $product->cost;
                        $clause['unit_cost'] = $product->cost + $item_tax;
                    }
                    $pr_item_tax = $this->sma->formatDecimal($item_tax * $clause['unit_quantity'], 4);
                    if ($this->Settings->indian_gst && $gst_data = $this->gst->calculteIndianGST($pr_item_tax, ($this->Settings->state == $supplier_details->state), $tax_details)) {
                        $clause['gst'] = $gst_data['gst'];
                        $clause['cgst'] = $gst_data['cgst'];
                        $clause['sgst'] = $gst_data['sgst'];
                        $clause['igst'] = $gst_data['igst'];
                    }
                    $clause['subtotal'] = (($clause['net_unit_cost'] * $clause['unit_quantity']) + $pr_item_tax);
                }
                $clause['status'] = 4;
                $clause['date'] = date('Y-m-d');
                $clause['option_id'] = !empty($clause['option_id']) && is_numeric($clause['option_id']) ? $clause['option_id'] : NULL;
				$stmt = $this -> db -> prepare('INSERT INTO ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items (purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst, puiidsite, puiparentid ) VALUES (:purchase_id, :transfer_id, :product_id, :product_code, :product_name, :option_id, :net_unit_cost, :quantity, 0, :item_tax, :tax_rate_id, :tax, :discount, :item_discount, :expiry, :subtotal, :quantity_balance, :date, :status, :unit_cost, :real_unit_cost, :quantity_received, :supplier_part_no, :purchase_item_id, :product_unit_id, :product_unit_code, :unit_quantity, :gst, :cgst, :sgst, :igst, :puiidsite, :puiparentid)');
				$stmt -> bindParam(':purchase_id', $clause['purchase_id'], PDO::PARAM_INT);
				$stmt -> bindParam(':transfer_id', $clause['transfer_id'], PDO::PARAM_INT);
				$stmt -> bindParam(':product_id', $clause['product_id'], PDO::PARAM_INT);
				$stmt -> bindParam(':product_code', $clause['product_code'], PDO::PARAM_STR);
				$stmt -> bindParam(':product_name', $clause['product_name'], PDO::PARAM_STR);
				$stmt -> bindParam(':option_id', $clause['option_id'], PDO::PARAM_INT);
				$stmt -> bindParam(':net_unit_cost', $clause['net_unit_cost'], PDO::PARAM_STR);
				$stmt -> bindParam(':quantity', $clause['quantity'], PDO::PARAM_STR);
				$stmt -> bindParam(':item_tax', $clause['item_tax'], PDO::PARAM_STR);
				$stmt -> bindParam(':tax_rate_id', $clause['tax_rate_id'], PDO::PARAM_INT);
				$stmt -> bindParam(':tax', $clause['tax'], PDO::PARAM_STR);
				$stmt -> bindParam(':discount', $clause['discount'], PDO::PARAM_STR);
				$stmt -> bindParam(':item_discount', $clause['item_discount'], PDO::PARAM_STR);
				$stmt -> bindParam(':expiry', $clause['expiry'], PDO::PARAM_STR);
				$stmt -> bindParam(':subtotal', $clause['subtotal'], PDO::PARAM_STR);
				$stmt -> bindParam(':quantity_balance', $clause['quantity_balance'], PDO::PARAM_STR);
				$stmt -> bindParam(':date', $clause['date'], PDO::PARAM_STR);
				$stmt -> bindParam(':status', $clause['status'], PDO::PARAM_STR);
				$stmt -> bindParam(':unit_cost', $clause['unit_cost'], PDO::PARAM_STR);
				$stmt -> bindParam(':real_unit_cost', $clause['real_unit_cost'], PDO::PARAM_STR);
				$stmt -> bindParam(':quantity_received', $clause['quantity_received'], PDO::PARAM_STR);
				$stmt -> bindParam(':supplier_part_no', $clause['supplier_part_no'], PDO::PARAM_STR);
				$stmt -> bindParam(':purchase_item_id', $clause['purchase_item_id'], PDO::PARAM_INT);
				$stmt -> bindParam(':product_unit_id', $clause['product_unit_id'], PDO::PARAM_INT);
				$stmt -> bindParam(':product_unit_code', $clause['product_unit_code'], PDO::PARAM_STR);
				$stmt -> bindParam(':unit_quantity', $clause['unit_quantity'], PDO::PARAM_STR);
				$stmt -> bindParam(':gst', $clause['gst'], PDO::PARAM_STR);
				$stmt -> bindParam(':cgst', $clause['cgst'], PDO::PARAM_STR);
				$stmt -> bindParam(':sgst', $clause['sgst'], PDO::PARAM_STR);
				$stmt -> bindParam(':igst', $clause['igst'], PDO::PARAM_STR);
				$stmt -> bindParam(':puiidsite', $global_config['idsite'], PDO::PARAM_STR);
				$stmt -> bindParam(':puiparentid', $global_config['parentid'], PDO::PARAM_STR);
				$exc = $stmt -> execute();
				if($exc_){
					return $exc;
				}else{
					return FALSE;
				}
            }
        } 
        return FALSE;
    }

    public function syncVariantQty($variant_id, $warehouse_id, $product_id = NULL) {
        $balance_qty = $this->getBalanceVariantQuantity($variant_id);
        $wh_balance_qty = $this->getBalanceVariantQuantity($variant_id, $warehouse_id);
        if ($this->db->update('product_variants', array('quantity' => $balance_qty), array('id' => $variant_id))) {
            if ($this->getWarehouseProductsVariants($variant_id, $warehouse_id)) {
                $this->db->update('warehouses_products_variants', array('quantity' => $wh_balance_qty), array('option_id' => $variant_id, 'warehouse_id' => $warehouse_id));
            } else {
                if($wh_balance_qty) {
                    $this->db->insert('warehouses_products_variants', array('quantity' => $wh_balance_qty, 'option_id' => $variant_id, 'warehouse_id' => $warehouse_id, 'product_id' => $product_id));
                }
            }
            return TRUE;
        }
        return FALSE;
    }

    public function getWarehouseProducts($product_id, $warehouse_id = NULL) {
         if ($warehouse_id) {
            $where = ' AND warehouse_id = '. $warehouse_id;
        }
        $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_warehouses_products WHERE product_id =' . $product_id . ' ' . $where);
        if ($q->rowCount() > 0) {
            $row = $q->fetch();  
            return $row;
        } 
        return FALSE;
    }

    public function syncProductQty($product_id, $warehouse_id) {
		global $global_config;
        $balance_qty = $this->getBalanceQuantity($product_id);
        $wh_balance_qty = $this->getBalanceQuantity($product_id,  $warehouse_id);
		/*  print_r($balance_qty);print_r('/'.$wh_balance_qty);print_r('/'.$warehouse_id);  */
        if ($this->db->query('UPDATE ' . $this->db_systems . '.' . $this->db_prefix . '_san_pham_product_quantity SET quantity = ' . $balance_qty . ' WHERE pid =' . $product_id . ' AND idsite = ' . $global_config['idsite'] . ' AND parentid = ' . $global_config['parentid'] )) {
            if ($this->getWarehouseProducts($product_id, $warehouse_id)) {/* print_r($wh_balance_qty."//"); */
                $this->db->query('UPDATE ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_warehouses_products SET quantity = ' . $wh_balance_qty. ' WHERE product_id =' . $product_id . ' AND warehouse_id = ' . $warehouse_id);
            } else {
                if( ! $wh_balance_qty) { $wh_balance_qty = 0; }
                $product = $this->site->getProductByID($product_id);
                $this->db->query('INSERT INTO ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_warehouses_products SET quantity = ' . $wh_balance_qty . ', product_id = ' . $product_id . ', warehouse_id = ' . $warehouse_id . ', avg_cost = ' . $product->cost);
            }
            return TRUE;
        } 
        return FALSE;
    }

    public function getSaleByID($id) {
		$this->db->sqlreset()->select('*')
		 ->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales')
		 ->where('id =' . $id);
		 $q = $this->db->query($this->db->sql());
       /*  $q = $this->db->get_where('sales', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function getSalePayments($sale_id) {
    	 $this->db->sqlreset()->select('*')
		 ->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_payments')
		 ->where('sale_id =' . $sale_id);
		 $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        } 
        return FALSE;
        
    }

    public function syncSalePayments($id) {
        $sale = $this->getSaleByID($id);
        if ($payments = $this->getSalePayments($id)) {
            $paid = 0;
            $grand_total = $sale->grand_total+$sale->rounding;
            foreach ($payments as $payment) {
                $paid += $payment->amount;
            }
            $payment_status = $paid == 0 ? 3 : $sale->payment_status;
            if ($grand_total == $paid) {
                $payment_status = 5;
            } elseif ($sale->due_date <= date('Y-m-d') && !$sale->sale_id) {
                $payment_status = 2;
            } elseif ($paid != 0) {
                $payment_status = 4;
            }
			
            if ($this->db->query('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_sales SET paid = ' . $paid . ', payment_status = ' . $payment_status . ' WHERE id = ' . $id)) {
                return true;
            }
        } else {
            $payment_status = ($sale->due_date <= date('Y-m-d')) ? 2 : 3;
            if ($this->db->query('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_sales SET paid = 0, payment_status = ' . $payment_status . ' WHERE id = ' . $id)) {
                return true;
            }
        }
 
        return FALSE;
    }

    public function getPurchaseByID($id) {
       /*  $q = $this->db->get_where('purchases', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function getPurchasePayments($purchase_id) {
         $this->db->sqlreset()->select('*')
		 ->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_payments')
		 ->where('purchase_id =' . $purchase_id);
		 $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        } 
        return FALSE;
    }

    public function syncPurchasePayments($id) {
         $purchase = $this->getPurchaseByID($id);
        $paid = 0;
        if ($payments = $this->getPurchasePayments($id)) {
            foreach ($payments as $payment) {
                $paid += $payment->amount;
            }
        }

        $payment_status = $paid <= 0 ? 3 : $purchase->payment_status;
        if (storehouse_number_format($purchase->grand_total) > storehouse_number_format($paid) && $paid > 0) {
            $payment_status = 5;
        } elseif (storehouse_number_format($purchase->grand_total) <= storehouse_number_format($paid)) {
            $payment_status = 4;
        }
		//print_r($payment_status);die;
        
        if ($this->db->query('UPDATE  ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchases SET paid = ' . $paid. ' , payment_status = ' . $payment_status . ' WHERE id = ' . $id)) {
            return true;
        } 
        
        
        return FALSE;
    }

    private function getBalanceQuantity($product_id,  $warehouse_id = NULL) {
        global $global_config;
        $where = 'product_id = '. $product_id .' AND quantity_balance !=0 AND puiidsite = ' . $global_config['idsite'] . ' AND puiparentid = ' . $global_config['parentid'];
        if ($warehouse_id) {
            $where .= ' AND warehouse_id = ' . $warehouse_id;
        }
		$where .= ' AND (status =4 OR status =5)';
		$this->db->sqlreset()->select('SUM(COALESCE(quantity_balance, 0)) as stock')
					->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items')
					->where($where); /* print_r($this->db->sql());  */
        $q = $this->db->query($this->db->sql());
		if ($q->rowCount() > 0) {
			$data = $q->fetch(PDO::FETCH_OBJ);
			if($data->stock == NULL ) return 0;
            return $data->stock;
        }  
        return 0;
    }

    private function getBalanceVariantQuantity($variant_id, $warehouse_id = NULL) {
         $this->db->sqlreset()->select('SUM(COALESCE(quantity_balance, 0)) as stock', False)
		 		->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data .'_purchase_items');
        $where = 'option_id = ' . $variant_id .'AND quantity_balance !=0' ;
        if ($warehouse_id) {
            $where .= ' AND warehouse_id='. $warehouse_id;
        }
        $where.= 'AND status = 4 or status = 5';
		$this->db->where($where);
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            $data = $q->fetch(PDO::FETCH_OBJ);
            return $data->stock;
        } 
        return 0;
    }

    public function calculateAVCost($product_id, $warehouse_id, $net_unit_price, $unit_price, $quantity, $product_name, $option_id, $item_quantity) {/* print_r($item_quantity); */
        $product = $this->getProductByID($product_id);
        $real_item_qty = $quantity;
        $wp_details = $this->getWarehouseProduct($warehouse_id, $product_id);
        $con = $wp_details ? $wp_details->avg_cost : $product->cost;
        $tax_rate = $this->getTaxRateByID($product->tax_rate);
        $ctax = $this->calculateTax($product, $tax_rate, $con);
        if ($product->tax_method) {
            $avg_net_unit_cost = $con;
            $avg_unit_cost = ($con + $ctax['amount']);
        } else {
            $avg_unit_cost = $con;
            $avg_net_unit_cost = ($con - $ctax['amount']);
        }

        if ($pis = $this->getPurchasedItems($product_id, $warehouse_id, $option_id)) {/* print_r($pis); */
            $cost_row = array();
            $quantity = $item_quantity;
            $balance_qty = $quantity;
            foreach ($pis as $pi) {
                if (!empty($pi) && $pi->quantity > 0 && $balance_qty <= $quantity && $quantity != 0) {
					
                    if ($pi->quantity_balance >= $quantity && $quantity != 0) {
                        $balance_qty = $pi->quantity_balance - $quantity;
                        $cost_row = array('date' => date('Y-m-d'), 'product_id' => $product_id, 'sale_item_id' => 'sale_items.id', 'purchase_item_id' => $pi->id, 'quantity' => $quantity, 'purchase_net_unit_cost' => $avg_net_unit_cost, 'purchase_unit_cost' => $avg_unit_cost, 'sale_net_unit_price' => $net_unit_price, 'sale_unit_price' => $unit_price, 'quantity_balance' => $balance_qty, 'inventory' => 1, 'option_id' => $option_id);
                        $quantity = 0;
						/* print_r($pi); */
                    } elseif ($quantity != 0) {/* print_r($cost); */
                        $quantity = $quantity - $pi->quantity_balance;
                        $balance_qty = $quantity;
                        $cost_row = array('date' => date('Y-m-d'), 'product_id' => $product_id, 'sale_item_id' => 'sale_items.id', 'purchase_item_id' => $pi->id, 'quantity' => $pi->quantity_balance, 'purchase_net_unit_cost' => $avg_net_unit_cost, 'purchase_unit_cost' => $avg_unit_cost, 'sale_net_unit_price' => $net_unit_price, 'sale_unit_price' => $unit_price, 'quantity_balance' => 0, 'inventory' => 1, 'option_id' => $option_id);
                    }
                }
                if (empty($cost_row)) {
                    break;
                }
                $cost[] = $cost_row;
                if ($quantity == 0) {
                    break;
                }
            }
        }
        if ($quantity > 0 && !$this->Settings->overselling) {
            $this->session->set_flashdata('error', sprintf(lang("quantity_out_of_stock_for_%s"), ($pi->product_name ? $pi->product_name : $product_name)));
            redirect($_SERVER["HTTP_REFERER"]);
        } elseif ($quantity != 0) {
            $cost[] = array('date' => date('Y-m-d'), 'product_id' => $product_id, 'sale_item_id' => 'sale_items.id', 'purchase_item_id' => NULL, 'quantity' => $real_item_qty, 'purchase_net_unit_cost' => $avg_net_unit_cost, 'purchase_unit_cost' => $avg_unit_cost, 'sale_net_unit_price' => $net_unit_price, 'sale_unit_price' => $unit_price, 'quantity_balance' => NULL, 'overselling' => 1, 'inventory' => 1);
            $cost[] = array('pi_overselling' => 1, 'product_id' => $product_id, 'quantity_balance' => (0 - $quantity), 'warehouse_id' => $warehouse_id, 'option_id' => $option_id);
        } 
		/* print_r($cost); */
        return $cost;
    }

    public function calculateCost($product_id, $warehouse_id, $net_unit_price, $unit_price, $quantity, $product_name, $option_id, $item_quantity) {
        $pis = $this->getPurchasedItems($product_id, $warehouse_id, $option_id);
        $real_item_qty = $quantity;
        $quantity = $item_quantity;
        $balance_qty = $quantity;
		//$cost = $this->calculateCost($item['product_id'], $item['warehouse_id'], $item['net_unit_price'], $item['unit_price'], $item['quantity'], $item['product_name'], $item['option_id'], $item_quantity);
        foreach ($pis as $pi) {
            $cost_row = NULL;
            if (!empty($pi) && $balance_qty <= $quantity && $quantity != 0) {
                $purchase_unit_cost = $pi->unit_cost ? $pi->unit_cost : ($pi->net_unit_cost + ($pi->item_tax / $pi->quantity));
                if ($pi->quantity_balance >= $quantity && $quantity != 0) {
                    $balance_qty = $pi->quantity_balance - $quantity; 
                    $cost_row = array('date' => date('Y-m-d'), 'product_id' => $product_id, 'sale_item_id' => 'sale_items.id', 'purchase_item_id' => $pi->id, 'quantity' => $quantity, 'purchase_net_unit_cost' => $pi->net_unit_cost, 'purchase_unit_cost' => $purchase_unit_cost, 'sale_net_unit_price' => $net_unit_price, 'sale_unit_price' => $unit_price, 'quantity_balance' => $balance_qty, 'inventory' => 1, 'option_id' => $option_id);
                    $quantity = 0;
                } elseif ($quantity != 0) {
                    $quantity = $quantity - $pi->quantity_balance;
                    $balance_qty = $quantity;
                    $cost_row = array('date' => date('Y-m-d'), 'product_id' => $product_id, 'sale_item_id' => 'sale_items.id', 'purchase_item_id' => $pi->id, 'quantity' => $pi->quantity_balance, 'purchase_net_unit_cost' => $pi->net_unit_cost, 'purchase_unit_cost' => $purchase_unit_cost, 'sale_net_unit_price' => $net_unit_price, 'sale_unit_price' => $unit_price, 'quantity_balance' => 0, 'inventory' => 1, 'option_id' => $option_id);
                }
            }
            $cost[] = $cost_row;
            if ($quantity == 0) {
                break;
            }
        }
        /*
        if ($quantity > 0) {
                    $this->session->set_flashdata('error', sprintf(lang("quantity_out_of_stock_for_%s"), (isset($pi->product_name) ? $pi->product_name : $product_name)));
                    redirect($_SERVER["HTTP_REFERER"]);
                } */
        
        return $cost;
    }
	// Co dinh khong thay doi class getPurchasedItems
    public function getPurchasedItems($product_id, $warehouse_id = NULL, $option_id = NULL) {
        $orderby = ($this->Settings->accounting_method == 1) ? 'asc' : 'desc';
        $this->db->sqlreset()->select('id, quantity, quantity_balance, net_unit_cost, unit_cost, item_tax');
		$this->db->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items');
        $where = 'product_id =' . $product_id;
		if($warehouse_id != NULL)
			$where .=  ' AND warehouse_id = '. $warehouse_id;
		$where .=  ' AND quantity_balance !=0';
        if (!isset($option_id) || empty($option_id)) {
            $where .=' AND ( option_id IS NULL OR option_id = 0)';
        } else {
            $where .=' AND option_id = '. $option_id;
        }
		
        $where .=' AND (status = 4 OR status  = 3)';
		$this->db->where($where);
        $this->db->group('id');
        $this->db->order('date ' . $orderby . ', purchase_id ' . $orderby);
        $q = $this->db->query($this->db->sql());/* print_r($this->db->sql()); */
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        } 
        return FALSE;
    }

    public function getProductComboItems($pid, $warehouse_id = NULL) {
         $this->db->sqlreset()->select('products.id as id, combo_items.item_code as code, combo_items.quantity as qty, products.name as name, products.type as type, combo_items.unit_price as unit_price, warehouses_products.quantity as quantity')
            ->join('products', 'products.code=combo_items.item_code', 'left')
            ->join('warehouses_products', 'warehouses_products.product_id=products.id', 'left')
            ->group_by('combo_items.id');
        if($warehouse_id) {
            $this->db->where('warehouses_products.warehouse_id = ', $warehouse_id);
        }
        /*
        $q = $this->db->query('combo_items', array('combo_items.product_id' => $pid));
                if ($q->num_rows() > 0) {
                    foreach (($q->result()) as $row) {
                        $data[] = $row;
                    }
        
                    return $data;
                } */
        
        return FALSE;
    }

    public function item_costing($item, $pi = NULL) {
    	/* print_r($item);print_r($pi); */
         $item_quantity = $pi ? $item['aquantity'] : $item['quantity'];/* print_r($item_quantity); */
        if (!isset($item['option_id']) || empty($item['option_id']) || $item['option_id'] == 'null') {
            $item['option_id'] = NULL;
        }
		/* print_r($this->Settings); */
        if ($this->Settings->accounting_method != 2 && !$this->Settings->overselling) {
			/* print_r($item);  */
            if ($this->getProductByID($item['product_id'])) {
                if ($item['product_type'] == 1) {
                    $unit = $this->getUnitByID($item['product_unit_id']);
                    $item['net_unit_price'] = $this->convertToBase($unit, $item['net_unit_price']);
                    $item['unit_price'] = $this->convertToBase($unit, $item['unit_price']);
                    $cost = $this->calculateCost($item['product_id'], $item['warehouse_id'], $item['net_unit_price'], $item['unit_price'], $item['quantity'], $item['product_name'], $item['option_id'], $item_quantity);
                	/* print_r($cost) */;/* die; */
				} elseif ($item['product_type'] == 2) {
                    $combo_items = $this->getProductComboItems($item['product_id'], $item['warehouse_id']);
                    foreach ($combo_items as $combo_item) {
                        $pr = $this->getProductByCode($combo_item->code);
                        if ($pr->tax_rate) {
                            $pr_tax = $this->getTaxRateByID($pr->tax_rate);
                            if ($pr->tax_method) {
                                $item_tax = $this->sma->formatDecimal((($combo_item->unit_price) * $pr_tax->rate) / (100 + $pr_tax->rate));
                                $net_unit_price = $combo_item->unit_price - $item_tax;
                                $unit_price = $combo_item->unit_price;
                            } else {
                                $item_tax = $this->sma->formatDecimal((($combo_item->unit_price) * $pr_tax->rate) / 100);
                                $net_unit_price = $combo_item->unit_price;
                                $unit_price = $combo_item->unit_price + $item_tax;
                            }
                        } else {
                            $net_unit_price = $combo_item->unit_price;
                            $unit_price = $combo_item->unit_price;
                        }
                        if ($pr->type == 1) {
                            $cost[] = $this->calculateCost($pr->id, $item['warehouse_id'], $net_unit_price, $unit_price, ($combo_item->qty * $item['quantity']), $pr->name, NULL, $item_quantity);
                        } else {
                            $cost[] = array(array('date' => date('Y-m-d'), 'product_id' => $pr->id, 'sale_item_id' => 'sale_items.id', 'purchase_item_id' => NULL, 'quantity' => ($combo_item->qty * $item['quantity']), 'purchase_net_unit_cost' => 0, 'purchase_unit_cost' => 0, 'sale_net_unit_price' => $combo_item->unit_price, 'sale_unit_price' => $combo_item->unit_price, 'quantity_balance' => NULL, 'inventory' => NULL));
                        }
                    }
                } else {
                    $cost = array(array('date' => date('Y-m-d'), 'product_id' => $item['product_id'], 'sale_item_id' => 'sale_items.id', 'purchase_item_id' => NULL, 'quantity' => $item['quantity'], 'purchase_net_unit_cost' => 0, 'purchase_unit_cost' => 0, 'sale_net_unit_price' => $item['net_unit_price'], 'sale_unit_price' => $item['unit_price'], 'quantity_balance' => NULL, 'inventory' => NULL));
                }
            } elseif ($item['product_type'] == 'manual') {
                $cost = array(array('date' => date('Y-m-d'), 'product_id' => $item['product_id'], 'sale_item_id' => 'sale_items.id', 'purchase_item_id' => NULL, 'quantity' => $item['quantity'], 'purchase_net_unit_cost' => 0, 'purchase_unit_cost' => 0, 'sale_net_unit_price' => $item['net_unit_price'], 'sale_unit_price' => $item['unit_price'], 'quantity_balance' => NULL, 'inventory' => NULL));
            }

        } else {
			 /* print_r($item); */
            if ($this->getProductByID($item['product_id'])) {
                if ($item['product_type'] == 1) {
                    $cost = $this->calculateAVCost($item['product_id'], $item['warehouse_id'], $item['net_unit_price'], $item['unit_price'], $item['quantity'], $item['product_name'], $item['option_id'], $item_quantity);
                } elseif ($item['product_type'] == 2) {
                    $combo_items = $this->getProductComboItems($item['product_id'], $item['warehouse_id']);
                    foreach ($combo_items as $combo_item) {
                        $pr = $this->getProductByCode($combo_item->code);
                        if ($pr->tax_rate) {
                            $pr_tax = $this->getTaxRateByID($pr->tax_rate);
                            if ($pr->tax_method) {
                                $item_tax = $this->sma->formatDecimal((($combo_item->unit_price) * $pr_tax->rate) / (100 + $pr_tax->rate));
                                $net_unit_price = $combo_item->unit_price - $item_tax;
                                $unit_price = $combo_item->unit_price;
                            } else {
                                $item_tax = $this->sma->formatDecimal((($combo_item->unit_price) * $pr_tax->rate) / 100);
                                $net_unit_price = $combo_item->unit_price;
                                $unit_price = $combo_item->unit_price + $item_tax;
                            }
                        } else {
                            $net_unit_price = $combo_item->unit_price;
                            $unit_price = $combo_item->unit_price;
                        }
                        $cost[] = $this->calculateAVCost($combo_item->id, $item['warehouse_id'], $net_unit_price, $unit_price, ($combo_item->qty * $item['quantity']), $item['product_name'], $item['option_id'], $item_quantity);
                    }
                } else {
                    $cost = array(array('date' => date('Y-m-d'), 'product_id' => $item['product_id'], 'sale_item_id' => 'sale_items.id', 'purchase_item_id' => NULL, 'quantity' => $item['quantity'], 'purchase_net_unit_cost' => 0, 'purchase_unit_cost' => 0, 'sale_net_unit_price' => $item['net_unit_price'], 'sale_unit_price' => $item['unit_price'], 'quantity_balance' => NULL, 'inventory' => NULL));
                }
            } elseif ($item['product_type'] == 0) {
                $cost = array(array('date' => date('Y-m-d'), 'product_id' => $item['product_id'], 'sale_item_id' => 'sale_items.id', 'purchase_item_id' => NULL, 'quantity' => $item['quantity'], 'purchase_net_unit_cost' => 0, 'purchase_unit_cost' => 0, 'sale_net_unit_price' => $item['net_unit_price'], 'sale_unit_price' => $item['unit_price'], 'quantity_balance' => NULL, 'inventory' => NULL));
            }
		/* print_r($cost); */ 
        }/* print_r($cost); */
        return $cost;
    }

    public function costing($items) {  /* print_r($items);  */
         $citems = array();
        foreach ($items as $item) {
            $option = (isset($item['option_id']) && !empty($item['option_id']) && $item['option_id'] != 'null' && $item['option_id'] != 'false') ? $item['option_id'] : '';
            $pr = $this->getProductByID($item['product_id']);/* print_r($pr); */
            $item['option_id'] = $option;
            if ($pr && $pr->type == 1) {
                if (isset($citems['p' . $item['product_id'] . 'o' . $item['option_id']])) {
                    $citems['p' . $item['product_id'] . 'o' . $item['option_id']]['aquantity'] += $item['quantity'];
                } else {
                    $citems['p' . $item['product_id'] . 'o' . $item['option_id']] = $item;
                    $citems['p' . $item['product_id'] . 'o' . $item['option_id']]['aquantity'] = $item['quantity'];
                }
            } elseif ($pr && $pr->type == 2) {
                $wh = $this->Settings->overselling ? NULL : $item['warehouse_id'];
                $combo_items = $this->getProductComboItems($item['product_id'], $wh);
                foreach ($combo_items as $combo_item) {
                    if ($combo_item->type == 1) {
                        if (isset($citems['p' . $combo_item->id . 'o' . $item['option_id']])) {
                            $citems['p' . $combo_item->id . 'o' . $item['option_id']]['aquantity'] += ($combo_item->qty*$item['quantity']);
                        } else {
                            $cpr = $this->getProductByID($combo_item->id);
                            if ($cpr->tax_rate) {
                                $cpr_tax = $this->getTaxRateByID($cpr->tax_rate);
                                if ($cpr->tax_method) {
                                    $item_tax = $this->sma->formatDecimal((($combo_item->unit_price) * $cpr_tax->rate) / (100 + $cpr_tax->rate));
                                    $net_unit_price = $combo_item->unit_price - $item_tax;
                                    $unit_price = $combo_item->unit_price;
                                } else {
                                    $item_tax = $this->sma->formatDecimal((($combo_item->unit_price) * $cpr_tax->rate) / 100);
                                    $net_unit_price = $combo_item->unit_price;
                                    $unit_price = $combo_item->unit_price + $item_tax;
                                }
                            } else {
                                $net_unit_price = $combo_item->unit_price;
                                $unit_price = $combo_item->unit_price;
                            }
                            $cproduct = array('product_id' => $combo_item->id, 'product_name' => $cpr->name, 'product_type' => $combo_item->type, 'quantity' => ($combo_item->qty*$item['quantity']), 'net_unit_price' => $net_unit_price, 'unit_price' => $unit_price, 'warehouse_id' => $item['warehouse_id'], 'item_tax' => $item_tax, 'tax_rate_id' => $cpr->tax_rate, 'tax' => ($cpr_tax->type == 1 ? $cpr_tax->rate.'%' : $cpr_tax->rate), 'option_id' => NULL, 'product_unit_id' => $cpr->unit);
                            $citems['p' . $combo_item->id . 'o' . $item['option_id']] = $cproduct;
                            $citems['p' . $combo_item->id . 'o' . $item['option_id']]['aquantity'] = ($combo_item->qty*$item['quantity']);
                        }
                    }
                }
            }
        }
        // $this->sma->print_arrays($combo_items, $citems);
        $cost = array();/* print_r($citems);  */
        foreach ($citems as $item) { 
            $item['aquantity'] = $citems['p' . $item['product_id'] . 'o' . $item['option_id']]['aquantity'];
            /* print_r($item); */ 
			$cost[] = $this->item_costing($item, TRUE);
        } 
        return $cost;
    }

    public function syncQuantity($sale_id = NULL, $purchase_id = NULL, $oitems = NULL, $product_id = NULL) {
		global $global_config;
    	if ($sale_id) {
    		$sale_items = $this->getAllSaleItems($sale_id);
            foreach ($sale_items as $item) {
                if ($item->type == 1) {/* print_r($item); */
                    $this->syncProductQty($item->product_id, $item->warehouse_id);
                    if (isset($item->option_id) && !empty($item->option_id)) {
                        $this->syncVariantQty($item->option_id, $item->warehouse_id, $item->product_id);
                    }
                } elseif ($item->type == 2) {
                    $wh = $this->Settings->overselling ? NULL : $item->warehouse_id;
                    $combo_items = $this->getProductComboItems($item->product_id, $wh);
                    foreach ($combo_items as $combo_item) {
                        if($combo_item->type == 1) {
                            $this->syncProductQty($combo_item->id, $item->warehouse_id);
                        }
                    }
                }
            }
    	}elseif ($purchase_id) {
    		$purchase_items = $this->getAllPurchaseItems($purchase_id);
            foreach ($purchase_items as $item) {
                
                $this->syncProductQty($item->product_id, $item->warehouse_id);
                if (isset($item->option_id) && !empty($item->option_id)) {
                    $this->syncVariantQty($item->option_id, $item->warehouse_id, $item->product_id);
                }
                
            }
            
    	} elseif ($oitems) {
    		foreach ($oitems as $item) {
    			if (isset($item->product_type)) {
    				if ($item->type == 0) {
    					$this->syncProductQty($item->product_id, $item->warehouse_id);
                        if (isset($item->option_id) && !empty($item->option_id)) {
                            $this->syncVariantQty($item->option_id, $item->warehouse_id, $item->product_id);
                        }
					}elseif ($item->type == 1) {
						$this->syncProductQty($item->product_id, $item->warehouse_id);
                        if (isset($item->option_id) && !empty($item->option_id)) {
                            $this->syncVariantQty($item->option_id, $item->warehouse_id, $item->product_id);
                        }
					}elseif ($item->type == 2) {
					}
					
				}else{
					$this->syncProductQty($item->product_id, $item->warehouse_id);
                    if (isset($item->option_id) && !empty($item->option_id)) {
                        $this->syncVariantQty($item->option_id, $item->warehouse_id, $item->product_id);
                    }
				}
			}
		} elseif ($product_id) {
			$warehouses = $this->getAllWarehouses();
            foreach ($warehouses as $warehouse) {
                $this->syncProductQty($product_id, $warehouse->id);
                if ($product_variants = $this->getProductVariants($product_id)) {
                    foreach ($product_variants as $pv) {
                        $this->syncVariantQty($pv->id, $warehouse->id, $product_id);
                    }
                }
            }
		}
       /*  if ($sale_id) {

          
        } elseif ($purchase_id) {

           
        } elseif ($oitems) {

            foreach ($oitems as $item) {
                if (isset($item->product_type)) {
                    if ($item->product_type == 'standard') {
                        $this->syncProductQty($item->product_id, $item->warehouse_id);
                        if (isset($item->option_id) && !empty($item->option_id)) {
                            $this->syncVariantQty($item->option_id, $item->warehouse_id, $item->product_id);
                        }
                    } elseif ($item->product_type == 'combo') {
                        $combo_items = $this->getProductComboItems($item->product_id, $item->warehouse_id);
                        foreach ($combo_items as $combo_item) {
                            if($combo_item->type == 'standard') {
                                $this->syncProductQty($combo_item->id, $item->warehouse_id);
                            }
                        }
                    }
                } else {
                    $this->syncProductQty($item->product_id, $item->warehouse_id);
                    if (isset($item->option_id) && !empty($item->option_id)) {
                        $this->syncVariantQty($item->option_id, $item->warehouse_id, $item->product_id);
                    }
                }
            }

        } elseif ($product_id) {
            $warehouses = $this->getAllWarehouses();
            foreach ($warehouses as $warehouse) {
                $this->syncProductQty($product_id, $warehouse->id);
                if ($product_variants = $this->getProductVariants($product_id)) {
                    foreach ($product_variants as $pv) {
                        $this->syncVariantQty($pv->id, $warehouse->id, $product_id);
                    }
                }
            }
        } */
    }

    public function getProductVariants($product_id) {
       /*  $q = $this->db->get_where('product_variants', array('product_id' => $product_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }

    public function getAllSaleItems($sale_id) {
         $q = $this->db->query('SELECT *, p.type FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sale_items si LEFT JOIN  ' . $this->db_systems . '.' . $this->db_prefix . '_san_pham_rows p ON si.product_id = p.id WHERE si.sale_id = ' . $sale_id);
        if ($q->rowCount() > 0) {
            return $q->fetchAll(5);
		}
        return FALSE;
    }

    public function getAllPurchaseItems($purchase_id) {
         $q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items pi LEFT JOIN  ' . $this->db_systems . '.' . $this->db_prefix . '_san_pham_rows p ON pi.product_id = p.id WHERE pi.purchase_id = ' . $purchase_id);
        if ($q->rowCount() > 0) {
            return $q->fetchAll(5);
        } 
        return FALSE;
    }

    public function syncPurchaseItems($data = array()) {
         if (!empty($data)) {
            foreach ($data as $items) {
                foreach ($items as $item) {
                    if (isset($item['pi_overselling'])) {
                        unset($item['pi_overselling']);
                        $option_id = (isset($item['option_id']) && !empty($item['option_id'])) ? $item['option_id'] : NULL;
                        $clause = array('purchase_id' => NULL, 'transfer_id' => NULL, 'product_id' => $item['product_id'], 'warehouse_id' => $item['warehouse_id'], 'option_id' => $option_id);
                        if ($pi = $this->getPurchasedItem($clause)) {
                            $quantity_balance = $pi->quantity_balance + $item['quantity_balance'];
                            $this->db->query('UPDATE ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items SET quantity_balance =' . $quantity_balance .' WHERE id=' . $pi->id);
                        } else {
                            $clause['quantity'] = 0;
                            $clause['item_tax'] = 0;
                            $clause['quantity_balance'] = $item['quantity_balance'];
                            $clause['status'] = 4;
                            $clause['option_id'] = !empty($clause['option_id']) && is_numeric($clause['option_id']) ? $clause['option_id'] : NULL;
                            $this->db->query('INSERT INTTO ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items (quantity, item_tax, quantity_balance, status, option_id) VALUES ( '. $clause['quantity'] . ',' . $clause['item_tax'] . ',' . $clause['quantity_balance'] . ',' . $clause['status'] . ',' . $clause['option_id'] . ')');
                        }
                    } else {
                        if ($item['inventory']) {
                            $this->db->query('UPDATE ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items SET quantity_balance =' . $item['quantity_balance'] .' WHERE id=' . $item['purchase_item_id']);
                        }
                    }
                }
            }
            return TRUE;
        } 
        return FALSE;
    }

    public function getProductByCode($code)
    {
        $q = $this->db->query('SELECT *, ' . NV_LANG_DATA .'_title name FROM ' . $this->db_systems . '.' . $this->db_prefix . '_san_pham_rows WHERE product_code = "' . $code . '"');
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }

    public function check_customer_deposit($customer_id, $amount) {
        /* $customer = $this->getCompanyByID($customer_id);
        return $customer->deposit_amount >= $amount; */
    }

    public function getWarehouseProduct($warehouse_id, $product_id) {
		$q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_warehouses_products WHERE product_id = ' . $product_id . ' AND warehouse_id = ' . $warehouse_id);
		 
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        } 
        return FALSE;
    }

    public function getAllBaseUnits() {
       /*  $q = $this->db->get_where("units", array('base_unit' => NULL));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }

    public function getUnitsByBUID($base_unit) {
         $this->db->sqlreset()->select('*')
		 					->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_units')
         					->where('id = '. $base_unit . ' OR base_unit ='. $base_unit)
        					->group('id')
        					->order('id asc');
							//print_r($this->db->sql());die;
        $q = $this->db->query($this->db->sql());
		if ($q->rowCount() > 0) {
            while ($row = $q->fetch(5)) {
                $data[] = $row;
            }
            return $data;
		} 
        return FALSE;
    }

    public function getUnitByID($id) {
		$q = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix . '_san_pham_units WHERE id = ' . $id);
		 
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        } 
        return FALSE;
    }

    public function getPriceGroupByID($id) {
      /*   $q = $this->db->get_where('price_groups', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function getProductGroupPrice($product_id, $group_id) {
       /*  $q = $this->db->get_where('product_prices', array('price_group_id' => $group_id, 'product_id' => $product_id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function getAllBrands() {
        /* $q = $this->db->get("brands");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        } */
        return FALSE;
    }

    public function getBrandByID($id) {
        /* $q = $this->db->get_where('brands', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }

    public function convertToBase($unit, $value) {
         switch($unit->operator) {
            case '*':
                return $value / $unit->operation_value;
                break;
            case '/':
                return $value * $unit->operation_value;
                break;
            case '+':
                return $value - $unit->operation_value;
                break;
            case '-':
                return $value + $unit->operation_value;
                break;
            default:
                return $value;
        } 
    }

    function calculateTax($product_details = NULL, $tax_details, $custom_value = NULL, $c_on = NULL) {
        /* $value = $custom_value ? $custom_value : (($c_on == 'cost') ? $product_details->cost : $product_details->price);
        $tax_amount = 0; $tax = 0;
        if ($tax_details && $tax_details->type == 1 && $tax_details->rate != 0) {
            if ($product_details && $product_details->tax_method == 1) {
                $tax_amount = $this->sma->formatDecimal((($value) * $tax_details->rate) / 100, 4);
                $tax = $this->sma->formatDecimal($tax_details->rate, 0) . "%";
            } else {
                $tax_amount = $this->sma->formatDecimal((($value) * $tax_details->rate) / (100 + $tax_details->rate), 4);
                $tax = $this->sma->formatDecimal($tax_details->rate, 0) . "%";
            }
        } elseif ($tax_details && $tax_details->type == 2) {
            $tax_amount = $this->sma->formatDecimal($tax_details->rate);
            $tax = $this->sma->formatDecimal($tax_details->rate, 0);
        }
        return array('id' => $tax_details->id, 'tax' => $tax, 'amount' => $tax_amount); */
    }

    public function getAddressByID($id) {
       /*  return $this->db->get_where('addresses', ['id' => $id], 1)->row(); */
    }

    public function checkSlug($slug, $type = NULL) {
        /* if (!$type) {
            return $this->db->get_where('products', ['slug' => $slug], 1)->row();
        } elseif ($type == 'category') {
            return $this->db->get_where('categories', ['slug' => $slug], 1)->row();
        } elseif ($type == 'brand') {
            return $this->db->get_where('brands', ['slug' => $slug], 1)->row();
        } */
        return FALSE;
    }

    public function calculateDiscount($discount = NULL, $amount) {
         if ($discount && $this->Settings->product_discount) {
            $dpos = strpos($discount, '%');
            if ($dpos !== false) {
                $pds = explode("%", $discount);
                return $this->sma->formatDecimal(((($this->sma->formatDecimal($amount)) * (Float) ($pds[0])) / 100), 4);
            } else {
                return $this->sma->formatDecimal($discount, 4);
            }
        } 
        return 0;
    }

    public function calculateOrderTax($order_tax_id = NULL, $amount) {
         if ($this->Settings->tax2 != 0 && $order_tax_id) {
            if ($order_tax_details = $this->site->getTaxRateByID($order_tax_id)) {
                if ($order_tax_details->type == 1) {
                    return $this->sma->formatDecimal((($amount * $order_tax_details->rate) / 100), 4);
                } else {
                    return $this->sma->formatDecimal($order_tax_details->rate, 4);
                }
            }
        } 
        return 0;
    }

    public function getSmsSettings() {
        /* $q = $this->db->get('sms_settings');
        if ($q->num_rows() > 0) {
            return $q->row();
        } */
        return FALSE;
    }
	public function getSalesItems($product_id, $warehouse_id= NULL, $option_id = NULL) {
		$orderby = ($this->Settings->accounting_method == 1) ? 'asc' : 'desc';
		$this->db->sqlreset()->select('t1.*,t2.*');
		$this->db->from($this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sale_items t1')
		->join('LEFT JOIN ' . $this->db_systems . '.' . $this->db_prefix . '_' . $this->mod_data . '_sales t2 ON t1.sale_id = t2.id');
		$where = 'product_id =' . $product_id . ' AND quantity !=0';
		if($warehouse_id != NULL)
			$where .=  ' AND warehouse_id = '. $warehouse_id;
		if (!isset($option_id) || empty($option_id)) {
			$where .=' AND ( option_id IS NULL OR option_id = 0)';
		} else {
			$where .=' AND option_id = '. $option_id;
		}
		
		$this->db->where($where);
		$this->db->group('t1.id');
		$this->db->order('t2.date ' . $orderby . ', t1.sale_id ' . $orderby);
		$q = $this->db->query($this->db->sql());
		if ($q->rowCount() > 0) {
			return $q->fetchAll(5);
		} 
		return FALSE;
	}
	public function barcode($text = null, $bcs = 'code128', $height = 74, $stext = 1, $get_be = false, $re = false)
    {
    	
        $drawText = ($stext != 1) ? false : true;
        $this->tec_barcode = New Tec_barcode;
        return $this->tec_barcode->generate($text, $bcs, $height, $drawText, $get_be, $re);
    }

}
