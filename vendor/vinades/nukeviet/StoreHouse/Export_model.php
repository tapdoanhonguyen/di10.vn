<?php

class Export_model extends Model {

	public function __construct() {
		parent::__construct();
	}

	public function getProductNames($term, $limit = 5) {
		$this -> db -> where("type = 'standard' AND (name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR supplier1_part_no LIKE '%" . $term . "%' OR supplier2_part_no LIKE '%" . $term . "%' OR supplier3_part_no LIKE '%" . $term . "%' OR supplier4_part_no LIKE '%" . $term . "%' OR supplier5_part_no LIKE '%" . $term . "%' OR  concat(name, ' (', code, ')') LIKE '%" . $term . "%')");
		$this -> db -> limit($limit);
		$q = $this -> db -> get('products');
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function getAllProducts() {
		$q = $this -> db -> get('products');
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function getProductByID($id) {
		$q = $this -> db -> get_where('products', array('id' => $id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function getProductsByCode($code) {
		$this -> db ->sqlreset() -> select('*') -> from('products') -> like('code', $code, 'both');
		$q = $this -> db -> get();
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function getProductByCode($code) {
		$q = $this -> db -> query('SELECT * FROM ' . $this -> db_prefix . '_' . $this -> mod_data . '_products WHERE code = "' . $code . '"');
		if ($q -> rowCount() > 0) {
			return $q -> fetch(PDO::FETCH_OBJ);
		}
		return FALSE;
	}

	public function getProductByName($name) {
		$q = $this -> db -> query('SELECT * FROM ' . $this -> db_prefix . '_' . $this -> mod_data . '_products WHERE name = "' . $name . '"');
		if ($q -> rowCount() > 0) {
			return $q -> fetch(PDO::FETCH_OBJ);
		}
		return FALSE;
	}

	public function getAllPurchases() {
		$q = $this -> db -> get('purchases');
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function getAllPurchaseItems($purchase_id) {
		$this -> db ->sqlreset() -> select('purchase_items.*, tax_rates.code as tax_code, tax_rates.name as tax_name, tax_rates.rate as tax_rate, products.unit, products.details as details, product_variants.name as variant, products.hsn_code as hsn_code, products.second_name as second_name')
		->from($this->db_prefix . '_' . $this->mod_data . '_purchase_items as purchase_items')
		-> join('LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_products as products ON products.id=purchase_items.product_id LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_product_variants as product_variants  ON product_variants.id=purchase_items.option_id LEFT JOIN ' . $this->db_prefix . '_' . $this->mod_data . '_tax_rates as tax_rates ON tax_rates.id=purchase_items.tax_rate_id')
		->where('purchase_id =' . $purchase_id)
		-> group('purchase_items.id') -> order('id asc');
		$q = $this -> db -> query($this->db->sql());
		if ($q -> rowCount() > 0) {
			foreach (($q->fetchAll()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function getItemByID($id) {
		$q = $this -> db -> get_where('purchase_items', array('id' => $id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function getTaxRateByName($name) {
		$q = $this -> db -> get_where('tax_rates', array('name' => $name), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function getPurchaseByID($id) {
		$q = $this -> db -> query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_purchases WHERE id = ' . $id);
		if ($q -> rowCount() > 0) {
			return $q -> fetch(5);
		}
		return FALSE;
	}

	public function getProductOptionByID($id) {
		$q = $this -> db -> get_where('product_variants', array('id' => $id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function getProductWarehouseOptionQty($option_id, $warehouse_id) {
		$q = $this -> db -> get_where('warehouses_products_variants', array('option_id' => $option_id, 'warehouse_id' => $warehouse_id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function addProductOptionQuantity($option_id, $warehouse_id, $quantity, $product_id) {
		if ($option = $this -> getProductWarehouseOptionQty($option_id, $warehouse_id)) {
			$nq = $option -> quantity + $quantity;
			if ($this -> db -> update('warehouses_products_variants', array('quantity' => $nq), array('option_id' => $option_id, 'warehouse_id' => $warehouse_id))) {
				return TRUE;
			}
		} else {
			if ($this -> db -> insert('warehouses_products_variants', array('option_id' => $option_id, 'product_id' => $product_id, 'warehouse_id' => $warehouse_id, 'quantity' => $quantity))) {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function resetProductOptionQuantity($option_id, $warehouse_id, $quantity, $product_id) {
		if ($option = $this -> getProductWarehouseOptionQty($option_id, $warehouse_id)) {
			$nq = $option -> quantity - $quantity;
			if ($this -> db -> update('warehouses_products_variants', array('quantity' => $nq), array('option_id' => $option_id, 'warehouse_id' => $warehouse_id))) {
				return TRUE;
			}
		} else {
			$nq = 0 - $quantity;
			if ($this -> db -> insert('warehouses_products_variants', array('option_id' => $option_id, 'product_id' => $product_id, 'warehouse_id' => $warehouse_id, 'quantity' => $nq))) {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function getOverSoldCosting($product_id) {
		$q = $this -> db -> get_where('costing', array('overselling' => 1));
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function addExport($data, $items) {
		$stmt = $this -> db -> prepare('INSERT INTO ' . $this -> db_prefix . '_' . $this -> mod_data . '_sales (reference_no, date, customer_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, sale_status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_sale_ref,  cgst, sgst, igst, module) VALUES (:reference_no, :date, :customer_id, :warehouse_id, :note, :total, :product_discount, :order_discount_id, :order_discount, :total_discount, :product_tax, :order_tax_id, :order_tax, :total_tax, :shipping, "", "", :sale_status, :payment_status, :created_by, :updated_by, :updated_at, :attachment, :payment_term, :due_date, 0, "", :return_sale_ref, :cgst, :sgst, :igst , "' . $this->mod_data . '")');

		$stmt -> bindParam(':order_discount', $data['order_discount'], PDO::PARAM_STR);
		$stmt -> bindParam(':created_by', $data['created_by'], PDO::PARAM_INT);
		$stmt -> bindParam(':updated_by', $data['updated_by'], PDO::PARAM_INT);
		$stmt -> bindParam(':updated_at', $data['updated_at'], PDO::PARAM_STR);
		$stmt -> bindParam(':due_date', $data['due_date'], PDO::PARAM_STR);
		$stmt -> bindParam(':return_sale_ref', $data['return_purchase_ref'], PDO::PARAM_STR);
		$stmt -> bindParam(':cgst', $data['cgst'], PDO::PARAM_STR);
		$stmt -> bindParam(':sgst', $data['sgst'], PDO::PARAM_STR);
		$stmt -> bindParam(':igst', $data['igst'], PDO::PARAM_STR);
		$stmt -> bindParam(':reference_no', $data['reference_no'], PDO::PARAM_STR);
		$stmt -> bindParam(':date', $data['date'], PDO::PARAM_INT);
		$stmt -> bindParam(':customer_id', $data['supplier_id'], PDO::PARAM_INT);
		$stmt -> bindParam(':warehouse_id', $data['warehouse_id'], PDO::PARAM_INT);
		$stmt -> bindParam(':note', $data['note'], PDO::PARAM_STR);
		$stmt -> bindParam(':total', $data['total'], PDO::PARAM_STR);
		$stmt -> bindParam(':product_discount', $data['product_discount'], PDO::PARAM_STR);
		$stmt -> bindParam(':order_discount_id', $data['order_discount_id'], PDO::PARAM_STR);
		$stmt -> bindParam(':total_discount', $data['total_discount'], PDO::PARAM_STR);
		$stmt -> bindParam(':product_tax', $data['product_tax'], PDO::PARAM_STR);
		$stmt -> bindParam(':order_tax_id', $data['order_tax_id'], PDO::PARAM_INT);
		$stmt -> bindParam(':order_tax', $data['order_tax'], PDO::PARAM_STR);
		$stmt -> bindParam(':total_tax', $data['total_tax'], PDO::PARAM_STR);
		$stmt -> bindParam(':shipping', $data['shipping'], PDO::PARAM_STR);
		$stmt -> bindParam(':sale_status', $data['status'], PDO::PARAM_INT);
		$stmt -> bindParam(':payment_status', $data['payment_status'], PDO::PARAM_STR);
		$stmt -> bindParam(':attachment', $data['attachment'], PDO::PARAM_STR);
		$stmt -> bindParam(':payment_term', $data['payment_term'], PDO::PARAM_INT);
		if ($stmt -> execute()) {
			$sale_id = $this -> db -> lastInsertId();
			if ($this -> site -> getReference('po') == $data['reference_no']) {
				$this -> site -> updateReference('po');
			}
			foreach ($items as $item) {
				$item['sale_id'] = $sale_id;
				$item['option_id'] = !empty($item['option_id']) && is_numeric($item['option_id']) ? $item['option_id'] : NULL;
				try {
					if (empty($item['id'])) {
						$stmt = $this -> db -> prepare('INSERT INTO ' . $this -> db_prefix . '_' . $this -> mod_data . '_sale_items (sale_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst, module) VALUES (:sale_id, :transfer_id, :product_id, :product_code, :product_name, :option_id, :net_unit_cost, :quantity, :warehouse_id, :item_tax, :tax_rate_id, :tax, :discount, :item_discount, :expiry, :subtotal, :quantity_balance, :date, :status, :unit_cost, :real_unit_cost, :quantity_received, :supplier_part_no, :purchase_item_id, :product_unit_id, :product_unit_code, :unit_quantity, :gst, :cgst, :sgst, :igst, "' . $this->mod_data . '")');
					} else {
						$stmt = $this -> db -> prepare('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_sale_items SET sale_id = :sale_id, transfer_id = :transfer_id, product_id = :product_id, product_code = :product_code, product_name = :product_name, option_id = :option_id, net_unit_cost = :net_unit_cost, quantity = :quantity, warehouse_id = :warehouse_id, item_tax = :item_tax, tax_rate_id = :tax_rate_id, tax = :tax, discount = :discount, item_discount = :item_discount, expiry = :expiry, subtotal = :subtotal, quantity_balance = :quantity_balance, date = :date, status = :status, unit_cost = :unit_cost, real_unit_cost = :real_unit_cost, quantity_received = :quantity_received, supplier_part_no = :supplier_part_no, purchase_item_id = :purchase_item_id, product_unit_id = :product_unit_id, product_unit_code = :product_unit_code, unit_quantity = :unit_quantity, gst = :gst, cgst = :cgst, sgst = :sgst, igst = :igst WHERE id=' . $row['id']);
					}
					$stmt -> bindParam(':sale_id', $item['sale_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':transfer_id', $item['transfer_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_code', $item['product_code'], PDO::PARAM_STR);
					$stmt -> bindParam(':product_name', $item['product_name'], PDO::PARAM_STR);
					$stmt -> bindParam(':option_id', $item['option_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':net_unit_cost', $item['net_unit_cost'], PDO::PARAM_STR);
					$stmt -> bindParam(':quantity', $item['quantity'], PDO::PARAM_STR);
					$stmt -> bindParam(':warehouse_id', $item['warehouse_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':item_tax', $item['item_tax'], PDO::PARAM_STR);
					$stmt -> bindParam(':tax_rate_id', $item['tax_rate_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':tax', $item['tax'], PDO::PARAM_STR);
					$stmt -> bindParam(':discount', $item['discount'], PDO::PARAM_STR);
					$stmt -> bindParam(':item_discount', $item['item_discount'], PDO::PARAM_STR);
					$stmt -> bindParam(':expiry', $item['expiry'], PDO::PARAM_STR);
					$stmt -> bindParam(':subtotal', $item['subtotal'], PDO::PARAM_STR);
					$stmt -> bindParam(':quantity_balance', $item['quantity_balance'], PDO::PARAM_STR);
					$stmt -> bindParam(':date', $item['date'], PDO::PARAM_STR);
					$stmt -> bindParam(':status', $item['status'], PDO::PARAM_STR);
					$stmt -> bindParam(':unit_cost', $item['unit_cost'], PDO::PARAM_STR);
					$stmt -> bindParam(':real_unit_cost', $item['real_unit_cost'], PDO::PARAM_STR);
					$stmt -> bindParam(':quantity_received', $item['quantity_received'], PDO::PARAM_STR);
					$stmt -> bindParam(':supplier_part_no', $item['supplier_part_no'], PDO::PARAM_STR);
					$stmt -> bindParam(':purchase_item_id', $item['purchase_item_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_unit_id', $item['product_unit_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_unit_code', $item['product_unit_code'], PDO::PARAM_STR);
					$stmt -> bindParam(':unit_quantity', $item['unit_quantity'], PDO::PARAM_STR);
					$stmt -> bindParam(':gst', $item['gst'], PDO::PARAM_STR);
					$stmt -> bindParam(':cgst', $item['cgst'], PDO::PARAM_STR);
					$stmt -> bindParam(':sgst', $item['sgst'], PDO::PARAM_STR);
					$stmt -> bindParam(':igst', $item['igst'], PDO::PARAM_STR);
					$exc = $stmt -> execute();

				} catch(PDOException $e) {
					trigger_error($e -> getMessage());
					die($e -> getMessage());
					//Remove this line after checks finished
				}

				if ($this -> Settings -> update_cost) {
					$this -> db -> query('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_products SET cost =' . $item['real_unit_cost'] . 'WHERE id = ' . $item['product_id']);
				}
				if ($item['option_id']) {
					$this -> db -> query('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_product_variants SET cost =' . $item['real_unit_cost'] . 'WHERE id = ' . $item['option_id'] . ' AND product_id = ' . $item['product_id']);
				}

				if ($data['status'] == '4' || $data['status'] == '5') {
					$this -> updateAVCO(array('product_id' => $item['product_id'], 'warehouse_id' => $item['warehouse_id'], 'quantity' => $item['quantity'], 'cost' => $item['real_unit_cost']));
				}
			}

			if ($data['status'] == '5') {
				$this -> db -> update('purchases', array('return_purchase_ref' => $data['return_purchase_ref'], 'surcharge' => $data['surcharge'], 'return_purchase_total' => $data['grand_total'], 'return_id' => $purchase_id), array('id' => $data['purchase_id']));
			}

			if ($data['status'] == '4' || $data['status'] == '5') {
				$this -> site -> syncQuantity(NULL, $purchase_id);
			}

			return true;
		}
		return false;
	}

	public function updatePurchase($id, $data, $items = array()) {
		$opurchase = $this -> getPurchaseByID($id);
		$oitems = $this -> getAllPurchaseItems($id);
		$stmt = $this -> db -> prepare('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_purchases SET reference_no = :reference_no, date = :date, supplier_id = :supplier_id, warehouse_id = :warehouse_id, note = :note, total = :total, product_discount = :product_discount, order_discount_id = :order_discount_id, total_discount = :total_discount, product_tax = :product_tax, order_tax_id = :order_tax_id, order_tax = :order_tax, total_tax = :total_tax, shipping = :shipping, grand_total = :grand_total, status = :status, payment_status = :payment_status, attachment = :attachment, payment_term = :payment_term WHERE id=' . $id);
        $stmt -> bindParam(':reference_no', $data['reference_no'], PDO::PARAM_STR);
        $stmt -> bindParam(':date', $data['date'], PDO::PARAM_INT);
        $stmt -> bindParam(':supplier_id', $data['supplier_id'], PDO::PARAM_INT);
        $stmt -> bindParam(':warehouse_id', $data['warehouse_id'], PDO::PARAM_INT);
        $stmt -> bindParam(':note', $data['note'], PDO::PARAM_STR);
        $stmt -> bindParam(':total', $data['total'], PDO::PARAM_STR);
        $stmt -> bindParam(':product_discount', $data['product_discount'], PDO::PARAM_STR);
        $stmt -> bindParam(':order_discount_id', $data['order_discount_id'], PDO::PARAM_STR);
        $stmt -> bindParam(':total_discount', $data['total_discount'], PDO::PARAM_STR);
        $stmt -> bindParam(':product_tax', $data['product_tax'], PDO::PARAM_STR);
        $stmt -> bindParam(':order_tax_id', $data['order_tax_id'], PDO::PARAM_INT);
        $stmt -> bindParam(':order_tax', $data['order_tax'], PDO::PARAM_STR);
        $stmt -> bindParam(':total_tax', $data['total_tax'], PDO::PARAM_STR);
        $stmt -> bindParam(':shipping', $data['shipping'], PDO::PARAM_STR);
        $stmt -> bindParam(':grand_total', $data['grand_total'], PDO::PARAM_STR);
        $stmt -> bindParam(':status', $data['status'], PDO::PARAM_STR);
        $stmt -> bindParam(':payment_status', $data['payment_status'], PDO::PARAM_STR);
        $stmt -> bindParam(':attachment', $data['attachment'], PDO::PARAM_STR);
        $stmt -> bindParam(':payment_term', $data['payment_term'], PDO::PARAM_INT);
        $exc = $stmt -> execute();
		
		if ($exc && $this -> db -> query('DELETE FROM ' . $this->db_prefix . '_' . $this->mod_data . '_purchase_items WHERE purchase_id = ' . $id)) {
			$purchase_id = $id;
			foreach ($items as $item) {
				$item['purchase_id'] = $id;
				$item['option_id'] = !empty($item['option_id']) && is_numeric($item['option_id']) ? $item['option_id'] : NULL;
				try {
					if (empty($item['id'])) {
						$stmt = $this -> db -> prepare('INSERT INTO ' . $this -> db_prefix . '_' . $this -> mod_data . '_purchase_items (purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES (:purchase_id, :transfer_id, :product_id, :product_code, :product_name, :option_id, :net_unit_cost, :quantity, :warehouse_id, :item_tax, :tax_rate_id, :tax, :discount, :item_discount, :expiry, :subtotal, :quantity_balance, :date, :status, :unit_cost, :real_unit_cost, :quantity_received, :supplier_part_no, :purchase_item_id, :product_unit_id, :product_unit_code, :unit_quantity, :gst, :cgst, :sgst, :igst)');
					} else {
						$stmt = $this -> db -> prepare('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_purchase_items SET purchase_id = :purchase_id, transfer_id = :transfer_id, product_id = :product_id, product_code = :product_code, product_name = :product_name, option_id = :option_id, net_unit_cost = :net_unit_cost, quantity = :quantity, warehouse_id = :warehouse_id, item_tax = :item_tax, tax_rate_id = :tax_rate_id, tax = :tax, discount = :discount, item_discount = :item_discount, expiry = :expiry, subtotal = :subtotal, quantity_balance = :quantity_balance, date = :date, status = :status, unit_cost = :unit_cost, real_unit_cost = :real_unit_cost, quantity_received = :quantity_received, supplier_part_no = :supplier_part_no, purchase_item_id = :purchase_item_id, product_unit_id = :product_unit_id, product_unit_code = :product_unit_code, unit_quantity = :unit_quantity, gst = :gst, cgst = :cgst, sgst = :sgst, igst = :igst WHERE id=' . $row['id']);
					}
					$stmt -> bindParam(':purchase_id', $item['purchase_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':transfer_id', $item['transfer_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_code', $item['product_code'], PDO::PARAM_STR);
					$stmt -> bindParam(':product_name', $item['product_name'], PDO::PARAM_STR);
					$stmt -> bindParam(':option_id', $item['option_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':net_unit_cost', $item['net_unit_cost'], PDO::PARAM_STR);
					$stmt -> bindParam(':quantity', $item['quantity'], PDO::PARAM_STR);
					$stmt -> bindParam(':warehouse_id', $item['warehouse_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':item_tax', $item['item_tax'], PDO::PARAM_STR);
					$stmt -> bindParam(':tax_rate_id', $item['tax_rate_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':tax', $item['tax'], PDO::PARAM_STR);
					$stmt -> bindParam(':discount', $item['discount'], PDO::PARAM_STR);
					$stmt -> bindParam(':item_discount', $item['item_discount'], PDO::PARAM_STR);
					$stmt -> bindParam(':expiry', $item['expiry'], PDO::PARAM_STR);
					$stmt -> bindParam(':subtotal', $item['subtotal'], PDO::PARAM_STR);
					$stmt -> bindParam(':quantity_balance', $item['quantity_balance'], PDO::PARAM_STR);
					$stmt -> bindParam(':date', $item['date'], PDO::PARAM_STR);
					$stmt -> bindParam(':status', $item['status'], PDO::PARAM_STR);
					$stmt -> bindParam(':unit_cost', $item['unit_cost'], PDO::PARAM_STR);
					$stmt -> bindParam(':real_unit_cost', $item['real_unit_cost'], PDO::PARAM_STR);
					$stmt -> bindParam(':quantity_received', $item['quantity_received'], PDO::PARAM_STR);
					$stmt -> bindParam(':supplier_part_no', $item['supplier_part_no'], PDO::PARAM_STR);
					$stmt -> bindParam(':purchase_item_id', $item['purchase_item_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_unit_id', $item['product_unit_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_unit_code', $item['product_unit_code'], PDO::PARAM_STR);
					$stmt -> bindParam(':unit_quantity', $item['unit_quantity'], PDO::PARAM_STR);
					$stmt -> bindParam(':gst', $item['gst'], PDO::PARAM_STR);
					$stmt -> bindParam(':cgst', $item['cgst'], PDO::PARAM_STR);
					$stmt -> bindParam(':sgst', $item['sgst'], PDO::PARAM_STR);
					$stmt -> bindParam(':igst', $item['igst'], PDO::PARAM_STR);
					$exc = $stmt -> execute();

				} catch(PDOException $e) {
					trigger_error($e -> getMessage());
					die($e -> getMessage());
					//Remove this line after checks finished
				}

				if ($this -> Settings -> update_cost) {
					$this -> db -> query('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_products SET cost =' . $item['real_unit_cost'] . 'WHERE id = ' . $item['product_id']);
				}
				if ($item['option_id']) {
					$this -> db -> query('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_product_variants SET cost =' . $item['real_unit_cost'] . 'WHERE id = ' . $item['option_id'] . ' AND product_id = ' . $item['product_id']);
				}

				if ($data['status'] == '4' || $data['status'] == '5') {
					$this -> updateAVCO(array('product_id' => $item['product_id'], 'warehouse_id' => $item['warehouse_id'], 'quantity' => $item['quantity'], 'cost' => $item['real_unit_cost']));
				}
			}
			$this -> site -> syncQuantity(NULL, NULL, $oitems);
			if ($data['status'] == '4' || $data['status'] == '5') {
				$this -> site -> syncQuantity(NULL, $id);
				foreach ($oitems as $oitem) {
					$this -> updateAVCO(array('product_id' => $oitem['product_id'], 'warehouse_id' => $oitem['warehouse_id'], 'quantity' => (0 - $oitem['quantity']), 'cost' => $oitem['real_unit_cost']));
				}
			}
			$this -> site -> syncPurchasePayments($id);
			return true;
		}

		return false;
	}

	public function updateStatus($id, $status, $note) {
		$purchase = $this -> getPurchaseByID($id);
		$items = $this -> site -> getAllPurchaseItems($id);

		if ($this -> db -> update('purchases', array('status' => $status, 'note' => $note), array('id' => $id))) {
			if (($purchase -> status != 'received' || $purchase -> status != 'partial') && ($status == 'received' || $status == 'partial')) {
				foreach ($items as $item) {
					$qb = $status == 'received' ? ($item -> quantity_balance + ($item -> quantity - $item -> quantity_received)) : $item -> quantity_balance;
					$qr = $status == 'received' ? $item -> quantity : $item -> quantity_received;
					$this -> db -> update('purchase_items', array('status' => $status, 'quantity_balance' => $qb, 'quantity_received' => $qr), array('id' => $item -> id));
					$this -> updateAVCO(array('product_id' => $item -> product_id, 'warehouse_id' => $item -> warehouse_id, 'quantity' => $item -> quantity, 'cost' => $item -> real_unit_cost));
				}
				$this -> site -> syncQuantity(NULL, NULL, $items);
			}
			return true;
		}
		return false;
	}

	public function deletePurchase($id) {
		$purchase = $this -> getPurchaseByID($id);
		$purchase_items = $this -> site -> getAllPurchaseItems($id);
		if ($this -> db -> delete('purchase_items', array('purchase_id' => $id)) && $this -> db -> delete('purchases', array('id' => $id))) {
			$this -> db -> delete('payments', array('purchase_id' => $id));
			if ($purchase -> status == 'received' || $purchase -> status == 'partial') {
				foreach ($purchase_items as $oitem) {
					$this -> updateAVCO(array('product_id' => $oitem -> product_id, 'warehouse_id' => $oitem -> warehouse_id, 'quantity' => (0 - $oitem -> quantity), 'cost' => $oitem -> real_unit_cost));
					$received = $oitem -> quantity_received ? $oitem -> quantity_received : $oitem -> quantity;
					if ($oitem -> quantity_balance < $received) {
						$clause = array('purchase_id' => NULL, 'transfer_id' => NULL, 'product_id' => $oitem -> product_id, 'warehouse_id' => $oitem -> warehouse_id, 'option_id' => $oitem -> option_id);
						$this -> site -> setPurchaseItem($clause, ($oitem -> quantity_balance - $received));
					}
				}
			}
			$this -> site -> syncQuantity(NULL, NULL, $purchase_items);
			return true;
		}
		return FALSE;
	}

	public function getWarehouseProductQuantity($warehouse_id, $product_id) {

		$q = $this -> db -> query('SELECT * FROM ' . $this -> db_prefix . '_' . $this -> mod_data . '_warehouses_products WHERE warehouse_id = ' . $warehouse_id . ' AND product_id = ' . $product_id);
		if ($q -> rowCount() > 0) {
			return $q -> fetch(PDO::FETCH_OBJ);
		}
		return FALSE;
	}

	public function getPurchasePayments($purchase_id) {
		$this -> db -> order_by('id', 'asc');
		$q = $this -> db -> get_where('payments', array('purchase_id' => $purchase_id));
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function getPaymentByID($id) {
		$q = $this -> db -> get_where('payments', array('id' => $id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}

		return FALSE;
	}

	public function getPaymentsForPurchase($purchase_id) {
		$this -> db ->sqlreset() -> select('payments.date, payments.paid_by, payments.amount, payments.reference_no, users.first_name, users.last_name, type') -> join('users', 'users.id=payments.created_by', 'left');
		$q = $this -> db -> get_where('payments', array('purchase_id' => $purchase_id));
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function addPayment($data = array()) {
		if ($this -> db -> insert('payments', $data)) {
			if ($this -> site -> getReference('ppay') == $data['reference_no']) {
				$this -> site -> updateReference('ppay');
			}
			$this -> site -> syncPurchasePayments($data['purchase_id']);
			return true;
		}
		return false;
	}

	public function updatePayment($id, $data = array()) {
		if ($this -> db -> update('payments', $data, array('id' => $id))) {
			$this -> site -> syncPurchasePayments($data['purchase_id']);
			return true;
		}
		return false;
	}

	public function deletePayment($id) {
		$opay = $this -> getPaymentByID($id);
		if ($this -> db -> delete('payments', array('id' => $id))) {
			$this -> site -> syncPurchasePayments($opay -> purchase_id);
			return true;
		}
		return FALSE;
	}

	public function getProductOptions($product_id) {
		$q = $this -> db -> get_where('product_variants', array('product_id' => $product_id));
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function getProductVariantByName($name, $product_id) {
		$q = $this -> db -> get_where('product_variants', array('name' => $name, 'product_id' => $product_id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function getExpenseByID($id) {
		$q = $this -> db -> get_where('expenses', array('id' => $id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function addExpense($data = array()) {
		if ($this -> db -> insert('expenses', $data)) {
			if ($this -> site -> getReference('ex') == $data['reference']) {
				$this -> site -> updateReference('ex');
			}
			return true;
		}
		return false;
	}

	public function updateExpense($id, $data = array()) {
		if ($this -> db -> update('expenses', $data, array('id' => $id))) {
			return true;
		}
		return false;
	}

	public function deleteExpense($id) {
		if ($this -> db -> delete('expenses', array('id' => $id))) {
			return true;
		}
		return FALSE;
	}

	public function getQuoteByID($id) {
		$q = $this -> db -> get_where('quotes', array('id' => $id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function getAllQuoteItems($quote_id) {
		$q = $this -> db -> get_where('quote_items', array('quote_id' => $quote_id));
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function getReturnByID($id) {
		$q = $this -> db -> get_where('return_purchases', array('id' => $id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function getAllReturnItems($return_id) {
		$this -> db ->sqlreset() -> select('return_purchase_items.*, products.details as details, product_variants.name as variant, products.hsn_code as hsn_code, products.second_name as second_name') -> join('products', 'products.id=return_purchase_items.product_id', 'left') -> join('product_variants', 'product_variants.id=return_purchase_items.option_id', 'left') -> group_by('return_purchase_items.id') -> order_by('id', 'asc');
		$q = $this -> db -> get_where('return_purchase_items', array('return_id' => $return_id));
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function getPurcahseItemByID($id) {
		$q = $this -> db -> get_where('purchase_items', array('id' => $id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function returnPurchase($data = array(), $items = array()) {

		$purchase_items = $this -> site -> getAllPurchaseItems($data['purchase_id']);

		if ($this -> db -> insert('return_purchases', $data)) {
			$return_id = $this -> db -> insert_id();
			if ($this -> site -> getReference('rep') == $data['reference_no']) {
				$this -> site -> updateReference('rep');
			}
			foreach ($items as $item) {
				$item['return_id'] = $return_id;
				$this -> db -> insert('return_purchase_items', $item);

				if ($purchase_item = $this -> getPurcahseItemByID($item['purchase_item_id'])) {
					if ($purchase_item -> quantity == $item['quantity']) {
						$this -> db -> delete('purchase_items', array('id' => $item['purchase_item_id']));
					} else {
						$nqty = $purchase_item -> quantity - $item['quantity'];
						$bqty = $purchase_item -> quantity_balance - $item['quantity'];
						$rqty = $purchase_item -> quantity_received - $item['quantity'];
						$tax = $purchase_item -> unit_cost - $purchase_item -> net_unit_cost;
						$discount = $purchase_item -> item_discount / $purchase_item -> quantity;
						$item_tax = $tax * $nqty;
						$item_discount = $discount * $nqty;
						$subtotal = $purchase_item -> unit_cost * $nqty;
						$this -> db -> update('purchase_items', array('quantity' => $nqty, 'quantity_balance' => $bqty, 'quantity_received' => $rqty, 'item_tax' => $item_tax, 'item_discount' => $item_discount, 'subtotal' => $subtotal), array('id' => $item['purchase_item_id']));
					}

				}
			}
			$this -> calculatePurchaseTotals($data['purchase_id'], $return_id, $data['surcharge']);
			$this -> site -> syncQuantity(NULL, NULL, $purchase_items);
			$this -> site -> syncQuantity(NULL, $data['purchase_id']);
			return true;
		}
		return false;
	}

	public function calculatePurchaseTotals($id, $return_id, $surcharge) {
		$purchase = $this -> getPurchaseByID($id);
		$items = $this -> getAllPurchaseItems($id);
		if (!empty($items)) {
			$total = 0;
			$product_tax = 0;
			$order_tax = 0;
			$product_discount = 0;
			$order_discount = 0;
			foreach ($items as $item) {
				$product_tax += $item -> item_tax;
				$product_discount += $item -> item_discount;
				$total += $item -> net_unit_cost * $item -> quantity;
			}
			if ($purchase -> order_discount_id) {
				$percentage = '%';
				$order_discount_id = $purchase -> order_discount_id;
				$opos = strpos($order_discount_id, $percentage);
				if ($opos !== false) {
					$ods = explode("%", $order_discount_id);
					$order_discount = (($total + $product_tax) * (Float)($ods[0])) / 100;
				} else {
					$order_discount = $order_discount_id;
				}
			}
			if ($purchase -> order_tax_id) {
				$order_tax_id = $purchase -> order_tax_id;
				if ($order_tax_details = $this -> site -> getTaxRateByID($order_tax_id)) {
					if ($order_tax_details -> type == 2) {
						$order_tax = $order_tax_details -> rate;
					}
					if ($order_tax_details -> type == 1) {
						$order_tax = (($total + $product_tax - $order_discount) * $order_tax_details -> rate) / 100;
					}
				}
			}
			$total_discount = $order_discount + $product_discount;
			$total_tax = $product_tax + $order_tax;
			$grand_total = $total + $total_tax + $purchase -> shipping - $order_discount + $surcharge;
			$data = array('total' => $total, 'product_discount' => $product_discount, 'order_discount' => $order_discount, 'total_discount' => $total_discount, 'product_tax' => $product_tax, 'order_tax' => $order_tax, 'total_tax' => $total_tax, 'grand_total' => $grand_total, 'return_id' => $return_id, 'surcharge' => $surcharge);

			if ($this -> db -> update('purchases', $data, array('id' => $id))) {
				return true;
			}
		} else {
			$this -> db -> delete('purchases', array('id' => $id));
		}
		return FALSE;
	}

	public function getExpenseCategories() {
		$q = $this -> db -> get('expense_categories');
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function getExpenseCategoryByID($id) {
		$q = $this -> db -> get_where("expense_categories", array('id' => $id), 1);
		if ($q -> num_rows() > 0) {
			return $q -> row();
		}
		return FALSE;
	}

	public function updateAVCO($data) {
		
		if ($wp_details = $this -> getWarehouseProductQuantity($data['warehouse_id'], $data['product_id'])) {
			$total_cost = (($wp_details -> quantity * $wp_details -> avg_cost) + ($data['quantity'] * $data['cost']));
			$total_quantity = $wp_details -> quantity + $data['quantity'];
			if (!empty($total_quantity)) {
				$avg_cost = ($total_cost / $total_quantity);

				$this -> db -> query('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_warehouses_products SET avg_cost =' . $avg_cost . ' WHERE product_id = ' . $data['product_id'] . ' AND warehouse_id = ' . $data['warehouse_id']);

			}
		} else {
			$this -> db -> query('INSERT INTO ' . $this -> db_prefix . '_' . $this -> mod_data . '_warehouses_products (product_id, warehouse_id, avg_cost, quantity) VALUES(' . $data['product_id'] . ', ' . $data['warehouse_id'] . ',' . $data['cost'] . ',0)');
		}
	}

}
