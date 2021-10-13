<?php 


class Project_model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
	public function getCompanyIdByEmail($email)
    {
        $q = $this->db->query('SELECT id FROM ' . $this->db_prefix . '_' . $this->mod_data . '_companies WHERE email = "' . $email . '"');
        if ($q->rowCount() > 0) {
        	$company_id = $q->fetch(5)->id;
            return $company_id;
        }
        return FALSE;
    }
	public function addCompanyIdByEmail($email,$name,$phone,$address)
    {
    	
    	$row = array();
    	$row['group_id'] = 1;
	    $row['group_name'] = 'customer';
	    $row['customer_group_id'] = $this->input->get_int('customer_group_id', 'post', 0);
	    $row['name'] = $name;
	    $row['company'] = $name;
	    $row['vat_no'] = $this->input->get_title('vat_no', 'post', '');
	    $row['address'] = $address;
	    $row['city'] = $this->input->get_title('city', 'post', '');
	    $row['state'] = $this->input->get_title('state', 'post', '');
	    $row['postal_code'] = $this->input->get_title('postal_code', 'post', '');
	    $row['country'] = $this->input->get_title('country', 'post', '');
	    $row['phone'] = $phone;
	    $row['email'] = $email;
	    $row['cf1'] = $this->input->get_title('cf1', 'post', '');
	    $row['cf2'] = $this->input->get_title('cf2', 'post', '');
	    $row['cf3'] = $this->input->get_title('cf3', 'post', '');
	    $row['cf4'] = $this->input->get_title('cf4', 'post', '');
	    $row['cf5'] = $this->input->get_title('cf5', 'post', '');
	    $row['cf6'] = $this->input->get_title('cf6', 'post', '');
	    $row['invoice_footer'] = $this->input->get_textarea('invoice_footer', '', NV_ALLOWED_HTML_TAGS);
	    $row['payment_term'] = $this->input->get_int('payment_term', 'post', 0);
	    $row['logo'] = $this->input->get_title('logo', 'post', '');
	    if (is_file(NV_DOCUMENT_ROOT . $row['logo']))     {
	        $row['logo'] = substr($row['logo'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'));
	    } else {
	        $row['logo'] = '';
	    }
	    $row['award_points'] = $this->input->get_int('award_points', 'post', 0);
	    $row['deposit_amount'] = $this->input->get_title('deposit_amount', 'post', '');
	    $row['price_group_id'] = $this->input->get_int('price_group_id', 'post', 0);
	    $row['price_group_name'] = $this->input->get_title('price_group_name', 'post', '');
	    $row['gst_no'] = $this->input->get_title('gst_no', 'post', '');
		$stmt = $this->db->prepare('INSERT INTO ' . $this->db_prefix . '_' . $this->mod_data . '_companies (group_id, group_name, customer_group_id, customer_group_name, name, company, vat_no, address, city, state, postal_code, country, phone, email, cf1, cf2, cf3, cf4, cf5, cf6, invoice_footer, payment_term, logo, award_points, deposit_amount, price_group_id, price_group_name, gst_no) VALUES (:group_id, :group_name, :customer_group_id, :customer_group_name, :name, :company, :vat_no, :address, :city, :state, :postal_code, :country, :phone, :email, :cf1, :cf2, :cf3, :cf4, :cf5, :cf6, :invoice_footer, :payment_term, :logo, :award_points, :deposit_amount, :price_group_id, :price_group_name, :gst_no)');
		$stmt->bindParam(':customer_group_name', $row['customer_group_name'], PDO::PARAM_STR);
		$stmt->bindParam(':group_id', $row['group_id'], PDO::PARAM_INT);
            $stmt->bindParam(':group_name', $row['group_name'], PDO::PARAM_STR);
            $stmt->bindParam(':customer_group_id', $row['customer_group_id'], PDO::PARAM_INT);
            $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
            $stmt->bindParam(':company', $row['company'], PDO::PARAM_STR);
            $stmt->bindParam(':vat_no', $row['vat_no'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $row['address'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $row['city'], PDO::PARAM_STR);
            $stmt->bindParam(':state', $row['state'], PDO::PARAM_STR);
            $stmt->bindParam(':postal_code', $row['postal_code'], PDO::PARAM_STR);
            $stmt->bindParam(':country', $row['country'], PDO::PARAM_STR);
            $stmt->bindParam(':phone', $row['phone'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $row['email'], PDO::PARAM_STR);
            $stmt->bindParam(':cf1', $row['cf1'], PDO::PARAM_STR);
            $stmt->bindParam(':cf2', $row['cf2'], PDO::PARAM_STR);
            $stmt->bindParam(':cf3', $row['cf3'], PDO::PARAM_STR);
            $stmt->bindParam(':cf4', $row['cf4'], PDO::PARAM_STR);
            $stmt->bindParam(':cf5', $row['cf5'], PDO::PARAM_STR);
            $stmt->bindParam(':cf6', $row['cf6'], PDO::PARAM_STR);
            $stmt->bindParam(':invoice_footer', $row['invoice_footer'], PDO::PARAM_STR, strlen($row['invoice_footer']));
            $stmt->bindParam(':payment_term', $row['payment_term'], PDO::PARAM_INT);
            $stmt->bindParam(':logo', $row['logo'], PDO::PARAM_STR);
            $stmt->bindParam(':award_points', $row['award_points'], PDO::PARAM_INT);
            $stmt->bindParam(':deposit_amount', $row['deposit_amount'], PDO::PARAM_STR);
            $stmt->bindParam(':price_group_id', $row['price_group_id'], PDO::PARAM_INT);
            $stmt->bindParam(':price_group_name', $row['price_group_name'], PDO::PARAM_STR);
            $stmt->bindParam(':gst_no', $row['gst_no'], PDO::PARAM_STR);

            $exc = $stmt->execute();
			if ($exc) {
				$company_id = $this -> db -> lastInsertId();
				return $company_id;
			}	
        return FALSE;
    }
     public function getAllProducts()
    {
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_products');
        if ($q->rowCount() > 0) {
            return $q->fetchAll(5);
        }
        return FALSE;
    }
	public function getAllSaleItems($sale_id)
    {
        $this->db->select('sale_items.*, tax_rates.code as tax_code, tax_rates.name as tax_name, tax_rates.rate as tax_rate, products.unit, products.details as details, product_variants.name as variant, products.hsn_code as hsn_code, products.second_name as second_name')
            ->from($this->db_prefix . '_' . $this->mod_data . '_sale_items as sale_items')
            ->join('LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_products as products ON products.id=sale_items.product_id 
            	LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_product_variants as product_variants ON product_variants.id=sale_items.option_id
                LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_tax_rates as tax_rates ON tax_rates.id=sale_items.tax_rate_id')
			->where('sale_id = ' . $sale_id)
            ->group('sale_items.id')
            ->order('id asc');
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
            	$row->total_fomart = storehouse_number_format($row->total,0);
				$row->subtotal_formart = storehouse_number_format($row->subtotal,0);
				$row->grand_total_fomart = storehouse_number_format($row->grand_total,0);
				$row->paid_fomart = storehouse_number_format($row->paid,0);
				$row->quantity_fomart = storehouse_number_format($row->quantity,0);
				$row->real_unit_price_fomart = storehouse_number_format($row->real_unit_price,0);
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	public function addSales($data = array(), $items = array(), $payment = array(), $si_return = array())
    {
    	if (empty($si_return)) {
            $cost = $this->site->costing($items);
            // $this->sma->print_arrays($cost);
        }
		if ($this->site->getReference('orso') == $data['reference_no']) {
            $this->site->updateReference('orso');
        }
		//print_r($data);die;
        $stmt = $this -> db -> prepare('INSERT INTO ' . $this -> db_prefix . '_' . $this -> mod_data . '_sales (date, reference_no, customer_id, customer, projectid, biller_id, biller, warehouse_id, note, staff_note, total, product_discount, order_discount_id, total_discount, order_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, sale_status, payment_status, payment_term, due_date, created_by, updated_by, updated_at, total_items, paid, return_id, attachment, return_sale_ref, sale_id, rounding, suspend_note, api, shop, address_id, reserve_id, hash, manual_payment, cgst, sgst, igst, payment_method, module) VALUES (:date, :reference_no, :customer_id, :customer, :projectid, :biller_id, :biller, :warehouse_id, :note, :staff_note, :total, :product_discount, :order_discount_id, :total_discount, :order_discount, :product_tax, :order_tax_id, :order_tax, :total_tax, :shipping, :grand_total, :sale_status, :payment_status, :payment_term, :due_date, :created_by, :updated_by, :updated_at, :total_items, :paid, :return_id, :attachment, :return_sale_ref, :sale_id, :rounding, :suspend_note, :api, :shop, :address_id, :reserve_id, :hash, :manual_payment, :cgst, :sgst, :igst, :payment_method, :module)');
        $stmt->bindParam(':date', $data['date'], PDO::PARAM_STR);
            $stmt->bindParam(':reference_no', $data['reference_no'], PDO::PARAM_STR);
            $stmt->bindParam(':customer_id', $data['customer_id'], PDO::PARAM_INT);
            $stmt->bindParam(':projectid', $data['projectid'], PDO::PARAM_INT);
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
	            return $sale_id;
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
	public function getProductNames($term, $warehouse_id, $limit = 5)
    {
    	$wp = "( SELECT product_id, warehouse_id, quantity as quantity from " . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products ) FWP";

        $this->db->select('products.*, FWP.quantity as quantity, categories.id as category_id, categories.name as category_name', FALSE)
            ->from($this->db_prefix . '_' . $this->mod_data . '_products as products')
            ->join('LEFT JOIN ' . $wp . ' ON FWP.product_id=products.id
            		LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_categories as categories ON categories.id=products.category_id')
            ->group('products.id');
        
        $this->db->where("(products.track_quantity = 0 OR FWP.quantity > 0) AND FWP.warehouse_id = '" . $warehouse_id . "' AND "
                . "(products.name LIKE '%" . $term . "%' OR products.code LIKE '%" . $term . "%' OR  concat(products.name, ' (', products.code, ')') LIKE '%" . $term . "%')");
        
        // $this->db->order_by('products.name ASC');
        $this->db->limit($limit);
       // die($this->db->sql());
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }
	}
	public function getProductOptions($product_id, $warehouse_id, $all = NULL)
    {
        $wpv = "( SELECT option_id, warehouse_id, quantity from " . $this->db_prefix . "_" . $this->mod_data . "_warehouses_products_variants WHERE product_id = " . $product_id . ") FWPV";
        $this->db->sqlreset()->select('product_variants.id as id, product_variants.name as name, product_variants.price as price, product_variants.quantity as total_quantity, FWPV.quantity as quantity')
            ->from($this->db_prefix . '_' . $this->mod_data . '_product_variants as product_variants')
            ->join( 'LEFT JOIN ' . $wpv . ' ON FWPV.option_id=product_variants.id')
            //->join('warehouses', 'warehouses.id=product_variants.warehouse_id', 'left')
            ->where('product_variants.product_id = ' . $product_id)
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
     public function addGiftCard($data = array(), $ca_data = array(), $sa_data = array())
    {
    	$data['date'] = NV_CURRENTTIME;
    	$stmt = $this->db->prepare('INSERT INTO ' . $this->db_prefix . '_' . $this->mod_data . '_gift_cards (date, card_no, value, customer_id, customer, balance, expiry, created_by) VALUES (:date, :card_no, :value, :customer_id, :customer, :balance, :expiry, :created_by)');
		$stmt->bindParam(':date', $data['date'], PDO::PARAM_INT);
        $stmt->bindParam(':card_no', $data['card_no'], PDO::PARAM_STR);
        $stmt->bindParam(':value', $data['value'], PDO::PARAM_STR);
        $stmt->bindParam(':customer_id', $data['customer_id'], PDO::PARAM_INT);
        $stmt->bindParam(':customer', $data['customer'], PDO::PARAM_STR);
        $stmt->bindParam(':balance', $data['balance'], PDO::PARAM_STR);
        $stmt->bindParam(':expiry', $data['expiry'], PDO::PARAM_STR);
        $stmt->bindParam(':created_by', $data['created_by'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateGiftCard($id, $data = array())
    {
        $this->db->where('id', $id);
        if ($this->db->update('gift_cards', $data)) {
            return true;
        }
        return false;
    }

    public function deleteGiftCard($id)
    {
        if ($this->db->delete('gift_cards', array('id' => $id))) {
            return true;
        }
        return FALSE;
    }
	public function addPayment($data = array(), $customer_id = null)
    {
    	
    	$stmt = $this -> db -> prepare('INSERT INTO ' . $this -> db_prefix . '_' . $this -> mod_data . '_payments (reference_no, date, sale_id, amount, paid_by, cheque_no, cc_no, cc_holder, cc_month, cc_year, cc_type, note, created_by, type) VALUES (:reference_no, :date, :sale_id, :amount, :paid_by, :cheque_no, :cc_no, :cc_holder, :cc_month, :cc_year, :cc_type, :note, :created_by, :type)');

		$stmt -> bindParam(':reference_no', $data['reference_no'], PDO::PARAM_STR);
		$stmt -> bindParam(':date', $data['date'], PDO::PARAM_INT);
		$stmt -> bindParam(':sale_id', $data['sale_id'], PDO::PARAM_INT);
		$stmt -> bindParam(':amount', $data['amount'], PDO::PARAM_INT);
		$stmt -> bindParam(':paid_by', $data['paid_by'], PDO::PARAM_STR);
		$stmt -> bindParam(':paid_by', $data['paid_by'], PDO::PARAM_STR);
		$stmt -> bindParam(':cheque_no', $data['cheque_no'], PDO::PARAM_STR);
		$stmt -> bindParam(':cc_no', $data['cc_no'], PDO::PARAM_STR);
		$stmt -> bindParam(':cc_holder', $data['cc_holder'], PDO::PARAM_STR);
		$stmt -> bindParam(':cc_month', $data['cc_month'], PDO::PARAM_STR);
		$stmt -> bindParam(':cc_year', $data['cc_year'], PDO::PARAM_STR);
		$stmt -> bindParam(':cc_type', $data['cc_type'], PDO::PARAM_STR);
		$stmt -> bindParam(':note', $data['note'], PDO::PARAM_STR);
		$stmt -> bindParam(':created_by', $data['created_by'], PDO::PARAM_INT);
		$stmt -> bindParam(':type', $data['type'], PDO::PARAM_STR);
		if ($stmt -> execute()) {
			if ($this -> site -> getReference('ppay') == $data['reference_no']) {
				$this -> site -> updateReference('ppay');
			}
			$this->site->syncSalePayments($data['sale_id']);
            if ($data['paid_by'] == 'gift_card') {
                $gc = $this->site->getGiftCardByNO($data['cc_no']);
                $this->db->query('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_gift_cards SET balance= ' . ($gc->balance - $data['amount']) .' WHERE card_no = ' . $data['cc_no']);
            } elseif ($customer_id && $data['paid_by'] == 'deposit') {
                $customer = $this->site->getCompanyByID($customer_id);
                $this->db->query('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_companies SET deposit_amount = ' . ($customer->deposit_amount-$data['amount']) . ' WHERE id = ' . $customer_id);
            }
            return true;
		}
		
        return false;
    }
	 public function getInvoiceByID($id)
    {
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_sales WHERE id = ' . $id);
        if ($q -> rowCount() > 0) {
			$row = $q -> fetch(5);
			
			$row->total_fomart = storehouse_number_format($row->total,0);
			$row->subtotal_formart = storehouse_number_format($row->subtotal,0);
			$row->grand_total_fomart = storehouse_number_format($row->grand_total,0);
			$row->paid_fomart = storehouse_number_format($row->paid,0);
			$row->quantity_fomart = storehouse_number_format($row->quantity,0);
			$row->real_unit_cost_fomart = storehouse_number_format($row->real_unit_cost,0);
			return $row;
		}
        return FALSE;
    }
	public function getAllSales() {
		$q = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_sales' );
		if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
            	$row->total_fomart = storehouse_number_format($row->total,0);
				$row->subtotal_formart = storehouse_number_format($row->subtotal,0);
				$row->grand_total_fomart = storehouse_number_format($row->grand_total,0);
				$row->paid_fomart = storehouse_number_format($row->paid,0);
				$row->quantity_fomart = storehouse_number_format($row->quantity,0);
				$row->real_unit_cost_fomart = storehouse_number_format($row->real_unit_cost,0);
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
	}
	public function getCustomerByProject($projectid)
    {
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_companies c LEFT JOIN  ' . $this->db_prefix . '_' . $this->mod_data . '_project p ON c.id = p.customerid WHERE p.projectid = ' . $projectid . '');
        if ($q->rowCount() > 0) {
        	$data = $q->fetch(5);
            return $data;
        }
        return FALSE;
    }
	
	
}


