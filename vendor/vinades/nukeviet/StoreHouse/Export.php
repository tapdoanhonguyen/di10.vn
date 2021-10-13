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
class Export extends MY_Controller {
	public $warehouse_id = '';
	public $purchases_id = '';
	public $status = '';
	public function __construct() {
		global $db_config, $db, $nv_Request, $nv_Request;
		parent::__construct();
		//$this->lang->admin_load('purchases', 'vi');
		$this -> export_model = &load_class('Export_model');
		$this -> load -> library('form_validation');
		$this -> digital_upload_path = 'uploads/storehouse/files';
		$this -> upload_path = 'uploads/storehouse';
		$this -> thumbs_path = 'assets/storehouse/thumbs/';
		$this -> image_types = 'gif|jpg|jpeg|png|tif';
		$this -> digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
		$this -> allowed_file_size = '1024';
		$this -> data['logo'] = true;
	}	/* ------------------------------------------------------------------------- */
	public function index($warehouse_id = null) {
		return '';
	}	public function getPurchases($row = array()) {
		$this -> getPurchases = $row;
	}	/* ----------------------------------------------------------------------------- */
	public function add() {
		$this -> session -> unset_userdata('csrf_token');
		if ($this -> form_validation -> run() == true) {
			$reference = $this -> getPurchases['reference_no'] ? $this -> getPurchases['reference_no'] : $this -> site -> getReference('po');
			$date = $this -> getPurchases['date'];
			$warehouse_id = $this -> getPurchases['warehouse_id'];
			$supplier_id = $this -> getPurchases['supplier_id'];
			$status = $this -> getPurchases['status'];
			$shipping = $this -> getPurchases['shipping'] ? $this -> getPurchases['shipping'] : 0;
			$supplier_details = $this -> site -> getCompanyByID($supplier_id);
			$supplier = $supplier_details -> company != '-' ? $supplier_details -> company : $supplier_details -> name;
			$note = $this -> sma -> clear_tags($this -> getPurchases['note']);
			$payment_term = $this -> getPurchases['payment_term'];
			$due_date = $this -> getPurchases['due_date'];
			$total = 0;
			$product_tax = 0;
			$product_discount = 0;
			$i = sizeof($this -> getPurchases['product_id']);
			$gst_data = array();
			$total_cgst = $total_sgst = $total_igst = 0;
			for ($r = 0; $r < $i; $r++) {
				$item_code = $this -> getPurchases['product_code'][$r];
				$item_net_cost = $this -> sma -> formatDecimal($this -> getPurchases['product_net_cost'][$r]);
				$unit_cost = $this -> sma -> formatDecimal($this -> getPurchases['product_unit_cost'][$r]);
				$real_unit_cost = $this -> sma -> formatDecimal($this -> getPurchases['product_real_unit_cost'][$r]);
				$item_unit_quantity = $this -> getPurchases['product_base_quantity'][$r];
				$item_option = isset($this -> getPurchases['product_option'][$r]) && $this -> getPurchases['product_option'][$r] != 'false' ? $this -> getPurchases['product_option'][$r] : null;
				$item_tax_rate = isset($this -> getPurchases['product_tax'][$r]) ? $this -> getPurchases['product_tax'][$r] : null;
				$item_discount = isset($this -> getPurchases['product_discount'][$r]) ? $this -> getPurchases['product_discount'][$r] : null;
				$item_expiry = (isset($this -> getPurchases['product_expried'][$r]) && !empty($this -> getPurchases['product_expried'][$r])) ? $this -> getPurchases['product_expried'][$r] : '';
				$supplier_part_no = (isset($this -> getPurchases['part_no'][$r]) && !empty($this -> getPurchases['part_no'][$r])) ? $this -> getPurchases['part_no'][$r] : null;
				$item_unit = $this -> getPurchases['product_unit'][$r];
				$item_quantity = $this -> getPurchases['product_base_quantity'][$r];
				if (isset($item_code) && isset($real_unit_cost) && isset($unit_cost) && isset($item_quantity)) {
					$product_details = $this -> export_model -> getProductByCode($item_code);
					/* if ($item_expiry) {
					 $today = date('Y-m-d');
					 if ($item_expiry <= $today) {
					 $this->session->set_flashdata('error', $this->lang['product_expiry_date_issue'] . ' (' . $product_details->name . ')');
					 redirect($_SERVER["HTTP_REFERER"]);
					 }
					 } */
					// $unit_cost = $real_unit_cost;
					$pr_discount = $this -> site -> calculateDiscount($item_discount, $unit_cost);
					$unit_cost = $this -> sma -> formatDecimal($unit_cost - $pr_discount);
					$item_net_cost = $unit_cost;
					$pr_item_discount = $this -> sma -> formatDecimal($pr_discount * $item_unit_quantity);
					$product_discount += $pr_item_discount;
					$pr_item_tax = $item_tax = 0;
					$tax = "";
					if (isset($item_tax_rate) && $item_tax_rate != 0) {
						$tax_details = $this -> site -> getTaxRateByID($item_tax_rate);
						$ctax = $this -> site -> calculateTax($product_details, $tax_details, $unit_cost);
						$item_tax = $ctax['amount'];
						$tax = $ctax['tax'];
						if ($product_details -> tax_method != 1) {
							$item_net_cost = $unit_cost - $item_tax;
						}
						$pr_item_tax = $this -> sma -> formatDecimal($item_tax * $item_unit_quantity, 4);
						if ($this -> Settings -> indian_gst && $gst_data = $this -> gst -> calculteIndianGST($pr_item_tax, ($this -> Settings -> state == $supplier_details -> state), $tax_details)) {
							$total_cgst += $gst_data['cgst'];
							$total_sgst += $gst_data['sgst'];
							$total_igst += $gst_data['igst'];
						}
					}
					$product_tax += $pr_item_tax;
					$subtotal = (($item_net_cost * $item_unit_quantity) + $pr_item_tax);
					$unit = $this -> site -> getUnitByID($item_unit);
					$product = array('product_id' => $product_details -> id, 'product_code' => $item_code, 'product_name' => $product_details -> name, 'option_id' => $item_option, 'net_unit_cost' => $item_net_cost, 'unit_cost' => $this -> sma -> formatDecimal($item_net_cost + $item_tax), 'quantity' => $item_quantity, 'product_unit_id' => $item_unit, 'product_unit_code' => $unit -> code, 'unit_quantity' => $item_unit_quantity, 'quantity_balance' => $item_quantity, 'quantity_received' => $status == '4' ? $item_quantity : 0, 'warehouse_id' => $warehouse_id, 'item_tax' => $pr_item_tax, 'tax_rate_id' => $item_tax_rate, 'tax' => $tax, 'discount' => $item_discount, 'item_discount' => $pr_item_discount, 'subtotal' => $this -> sma -> formatDecimal($subtotal), 'expiry' => $item_expiry, 'real_unit_cost' => $real_unit_cost, 'date' => date('Y-m-d', strtotime($date)), 'status' => $status, 'supplier_part_no' => $supplier_part_no, );
					$products[] = ($product + $gst_data);
					$total += $this -> sma -> formatDecimal(($item_net_cost * $item_unit_quantity), 4);
				}
			}			/*        if (empty($products)) {
			 $this->form_validation->set_rules('product', lang("order_items"), 'required');
			 } else {
			 krsort($products);
			 } */
			$order_discount = $this -> site -> calculateDiscount($this -> getPurchases['order_discount'], ($total + $product_tax));
			$total_discount = $this -> sma -> formatDecimal(($order_discount + $product_discount), 4);
			$order_tax = $this -> site -> calculateOrderTax($this -> getPurchases['order_tax'], ($total + $product_tax - $order_discount));
			$total_tax = $this -> sma -> formatDecimal(($product_tax + $order_tax), 4);
			$grand_total = $this -> sma -> formatDecimal(($total + $total_tax + $this -> sma -> formatDecimal($shipping) - $order_discount), 4);
			$data = array('reference_no' => $reference, 'date' => $date, 'supplier_id' => $supplier_id, 'supplier' => $supplier, 'warehouse_id' => $warehouse_id, 'note' => $note, 'total' => $total, 'product_discount' => $product_discount, 'order_discount_id' => $this -> getPurchases['order_discount_id'], 'order_discount' => $order_discount, 'total_discount' => $total_discount, 'product_tax' => $product_tax, 'order_tax_id' => $this -> getPurchases['order_tax'], 'order_tax' => $order_tax, 'total_tax' => $total_tax, 'shipping' => $this -> sma -> formatDecimal($shipping), 'grand_total' => $grand_total, 'status' => $status, 'created_by' => $this -> session -> userdata($this -> mod_data . '_user_id'), 'payment_term' => $payment_term, 'due_date' => $due_date, );
			if ($this -> Settings -> indian_gst) {
				$data['cgst'] = $total_cgst;
				$data['sgst'] = $total_sgst;
				$data['igst'] = $total_igst;
			}
			if (!nv_is_url($this -> getPurchases['attachment']) and nv_is_file($this -> getPurchases['attachment'], NV_UPLOADS_DIR . '/' . $this -> mod_upload) === true) {
				$photo = $this -> getPurchases['attachment'];
				$data['attachment'] = $photo;
			}			//print_r($products);die;
			// $this->sma->print_arrays($data, $products);
			if ($this -> form_validation -> run() == true && $this -> export_model -> addExport($data, $products)) {
				$this -> session -> set_userdata('remove_pols', 1);
				$this -> session -> set_flashdata('message', $this -> lang["purchases"]);
				return true;
			} else {
				if ($quote_id) {
					$this -> data['quote'] = $this -> export_model -> getQuoteByID($quote_id);
					$supplier_id = $this -> data['quote'] -> supplier_id;
					$items = $this -> export_model -> getAllQuoteItems($quote_id);
					krsort($items);
					$c = rand(100000, 9999999);
					foreach ($items as $item) {
						$row = $this -> site -> getProductByID($item -> product_id);
						if ($row -> type == 'combo') {
							$combo_items = $this -> site -> getProductComboItems($row -> id, $item -> warehouse_id);
							foreach ($combo_items as $citem) {
								$crow = $this -> site -> getProductByID($citem -> id);
								if (!$crow) {
									$crow = json_decode('{}');
									$crow -> qty = $item -> quantity;
								} else {
									unset($crow -> details, $crow -> product_details, $crow -> price);
									$crow -> qty = $citem -> qty * $item -> quantity;
								}
								$crow -> base_quantity = $item -> quantity;
								$crow -> base_unit = $crow -> unit ? $crow -> unit : $item -> product_unit_id;
								$crow -> base_unit_cost = $crow -> cost ? $crow -> cost : $item -> unit_cost;
								$crow -> unit = $item -> product_unit_id;
								$crow -> discount = $item -> discount ? $item -> discount : '0';
								$supplier_cost = $supplier_id ? $this -> getSupplierCost($supplier_id, $crow) : $crow -> cost;
								$crow -> cost = $supplier_cost ? $supplier_cost : 0;
								$crow -> tax_rate = $item -> tax_rate_id;
								$crow -> real_unit_cost = $crow -> cost ? $crow -> cost : 0;
								$crow -> expiry = '';
								$options = $this -> export_model -> getProductOptions($crow -> id);
								$units = $this -> site -> getUnitsByBUID($row -> base_unit);
								$tax_rate = $this -> site -> getTaxRateByID($crow -> tax_rate);
								$ri = $this -> Settings -> item_addition ? $crow -> id : $c;
								$pr[$ri] = array('id' => $c, 'item_id' => $crow -> id, 'label' => $crow -> name . " (" . $crow -> code . ")", 'row' => $crow, 'tax_rate' => $tax_rate, 'units' => $units, 'options' => $options);
								$c++;
							}
						} elseif ($row -> type == 'standard') {
							if (!$row) {
								$row = json_decode('{}');
								$row -> quantity = 0;
							} else {
								unset($row -> details, $row -> product_details);
							}
							$row -> id = $item -> product_id;
							$row -> code = $item -> product_code;
							$row -> name = $item -> product_name;
							$row -> base_quantity = $item -> quantity;
							$row -> base_unit = $row -> unit ? $row -> unit : $item -> product_unit_id;
							$row -> base_unit_cost = $row -> cost ? $row -> cost : $item -> unit_cost;
							$row -> unit = $item -> product_unit_id;
							$row -> qty = $item -> unit_quantity;
							$row -> option = $item -> option_id;
							$row -> discount = $item -> discount ? $item -> discount : '0';
							$supplier_cost = $supplier_id ? $this -> getSupplierCost($supplier_id, $row) : $row -> cost;
							$row -> cost = $supplier_cost ? $supplier_cost : 0;
							$row -> tax_rate = $item -> tax_rate_id;
							$row -> expiry = '';
							$row -> real_unit_cost = $row -> cost ? $row -> cost : 0;
							$options = $this -> export_model -> getProductOptions($row -> id);
							$units = $this -> site -> getUnitsByBUID($row -> base_unit);
							$tax_rate = $this -> site -> getTaxRateByID($row -> tax_rate);
							$ri = $this -> Settings -> item_addition ? $row -> id : $c;
							$pr[$ri] = array('id' => $c, 'item_id' => $row -> id, 'label' => $row -> name . " (" . $row -> code . ")", 'row' => $row, 'tax_rate' => $tax_rate, 'units' => $units, 'options' => $options);
							$c++;
						}
					}
					$this -> data['quote_items'] = json_encode($pr);
				}
				$this -> data['error'] = (validation_errors() ? validation_errors() : $this -> session -> flashdata('error'));
				$this -> data['quote_id'] = $quote_id;
				$this -> data['suppliers'] = $this -> site -> getAllCompanies('supplier');
				$this -> data['categories'] = $this -> site -> getAllCategories();
				$this -> data['tax_rates'] = $this -> site -> getAllTaxRates();
				$this -> data['warehouses'] = $this -> site -> getAllWarehouses();
				$this -> data['ponumber'] = '';				//$this->site->getReference('po');
				$this -> load -> helper('string');
				$value = random_string('alnum', 20);
				$this -> session -> set_userdata('user_csrf', $value);
				$this -> data['csrf'] = $this -> session -> userdata('user_csrf');
				$bc = array( array('link' => base_url(), 'page' => $this -> lang['home']), array('link' => admin_url('purchases'), 'page' => $this -> lang['purchases']), array('link' => '#', 'page' => $this -> lang['add_purchase']));
				$meta = array('page_title' => $this -> lang['add_purchase'], 'bc' => $bc);
				$this -> page_construct('purchases/add', $meta, $this -> data);
			}
		}
		return false;
	}	/* ----------------------------------------------------------------------------- */
	 public function edit($id = null)    {        $id = $this -> getPurchases['id'];	 	$inv = $this->export_model->getPurchaseByID($id);		if ($this->form_validation->run() == true) {			$reference = $this -> getPurchases['reference_no'] ? $this -> getPurchases['reference_no'] : $this -> site -> getReference('po');			$date = $this -> getPurchases['date'];			$warehouse_id = $this -> getPurchases['warehouse_id'];			$supplier_id = $this -> getPurchases['supplier_id'];			$status = $this -> getPurchases['status'];			$shipping = $this -> getPurchases['shipping'] ? $this -> getPurchases['shipping'] : 0;			$supplier_details = $this -> site -> getCompanyByID($supplier_id);			$supplier = $supplier_details -> company != '-' ? $supplier_details -> company : $supplier_details -> name;			$note = $this -> sma -> clear_tags($this -> getPurchases['note']);			$payment_term = $this -> getPurchases['payment_term'];			$due_date = $this -> getPurchases['due_date'];			$total = 0;			$product_tax = 0;			$product_discount = 0;			$i = sizeof($this -> getPurchases['product_id']);			$gst_data = array();			$total_cgst = $total_sgst = $total_igst = 0;			for ($r = 0; $r < $i; $r++) {				$item_code = $this -> getPurchases['product_code'][$r];				$item_net_cost = $this -> sma -> formatDecimal($this -> getPurchases['product_net_cost'][$r]);				$unit_cost = $this -> sma -> formatDecimal($this -> getPurchases['product_unit_cost'][$r]);				$real_unit_cost = $this -> sma -> formatDecimal($this -> getPurchases['product_real_unit_cost'][$r]);				$item_unit_quantity = $this -> getPurchases['product_base_quantity'][$r];				$item_option = isset($this -> getPurchases['product_option'][$r]) && $this -> getPurchases['product_option'][$r] != 'false' ? $this -> getPurchases['product_option'][$r] : null;				$item_tax_rate = isset($this -> getPurchases['product_tax'][$r]) ? $this -> getPurchases['product_tax'][$r] : null;				$item_discount = isset($this -> getPurchases['product_discount'][$r]) ? $this -> getPurchases['product_discount'][$r] : null;				$item_expiry = (isset($this -> getPurchases['product_expried'][$r]) && !empty($this -> getPurchases['product_expried'][$r])) ? $this -> getPurchases['product_expried'][$r] : '';				$supplier_part_no = (isset($this -> getPurchases['part_no'][$r]) && !empty($this -> getPurchases['part_no'][$r])) ? $this -> getPurchases['part_no'][$r] : null;				$item_unit = $this -> getPurchases['product_unit'][$r];				$item_quantity = $this -> getPurchases['product_base_quantity'][$r];				if (isset($item_code) && isset($real_unit_cost)  && isset($item_quantity)) {					$product_details = $this -> export_model -> getProductByCode($item_code);					/* if ($item_expiry) {					 $today = date('Y-m-d');					 if ($item_expiry <= $today) {					 $this->session->set_flashdata('error', $this->lang['product_expiry_date_issue'] . ' (' . $product_details->name . ')');					 redirect($_SERVER["HTTP_REFERER"]);					 }					 } */					// $unit_cost = $real_unit_cost;					$pr_discount = $this -> site -> calculateDiscount($item_discount, $unit_cost);					$unit_cost = $this -> sma -> formatDecimal($unit_cost - $pr_discount);					$item_net_cost = $unit_cost;					$pr_item_discount = $this -> sma -> formatDecimal($pr_discount * $item_unit_quantity);					$product_discount += $pr_item_discount;					$pr_item_tax = $item_tax = 0;					$tax = "";					if (isset($item_tax_rate) && $item_tax_rate != 0) {						$tax_details = $this -> site -> getTaxRateByID($item_tax_rate);						$ctax = $this -> site -> calculateTax($product_details, $tax_details, $unit_cost);						$item_tax = $ctax['amount'];						$tax = $ctax['tax'];						if ($product_details -> tax_method != 1) {							$item_net_cost = $unit_cost - $item_tax;						}						$pr_item_tax = $this -> sma -> formatDecimal($item_tax * $item_unit_quantity, 4);						if ($this -> Settings -> indian_gst && $gst_data = $this -> gst -> calculteIndianGST($pr_item_tax, ($this -> Settings -> state == $supplier_details -> state), $tax_details)) {							$total_cgst += $gst_data['cgst'];							$total_sgst += $gst_data['sgst'];							$total_igst += $gst_data['igst'];						}					}					$product_tax += $pr_item_tax;					$subtotal = (($item_net_cost * $item_unit_quantity) + $pr_item_tax);					$unit = $this -> site -> getUnitByID($item_unit);					$product = array('product_id' => $product_details -> id, 'product_code' => $item_code, 'product_name' => $product_details -> name, 'option_id' => $item_option, 'net_unit_cost' => $item_net_cost, 'unit_cost' => $this -> sma -> formatDecimal($item_net_cost + $item_tax), 'quantity' => $item_quantity, 'product_unit_id' => $item_unit, 'product_unit_code' => $unit -> code, 'unit_quantity' => $item_unit_quantity, 'quantity_balance' => $item_quantity, 'quantity_received' => $status == '4' ? $item_quantity : 0, 'warehouse_id' => $warehouse_id, 'item_tax' => $pr_item_tax, 'tax_rate_id' => $item_tax_rate, 'tax' => $tax, 'discount' => $item_discount, 'item_discount' => $pr_item_discount, 'subtotal' => $this -> sma -> formatDecimal($subtotal), 'expiry' => $item_expiry, 'real_unit_cost' => $real_unit_cost, 'date' => date('Y-m-d', strtotime($date)), 'status' => $status, 'supplier_part_no' => $supplier_part_no, );					$products[] = ($product + $gst_data);					$total += $this -> sma -> formatDecimal(($item_net_cost * $item_unit_quantity), 4);				}			}			$order_discount = $this -> site -> calculateDiscount($this -> getPurchases['order_discount'], ($total + $product_tax));			$total_discount = $this -> sma -> formatDecimal(($order_discount + $product_discount), 4);				$order_tax = $this -> site -> calculateOrderTax($this -> getPurchases['order_tax'], ($total + $product_tax - $order_discount));				$total_tax = $this -> sma -> formatDecimal(($product_tax + $order_tax), 4);				$grand_total = $this -> sma -> formatDecimal(($total + $total_tax + $this -> sma -> formatDecimal($shipping) - $order_discount), 4);				$data = array('reference_no' => $reference, 'date' => $date, 'supplier_id' => $supplier_id, 'supplier' => $supplier, 'warehouse_id' => $warehouse_id, 'note' => $note, 'total' => $total, 'product_discount' => $product_discount, 'order_discount_id' => $this -> getPurchases['order_discount_id'], 'order_discount' => $order_discount, 'total_discount' => $total_discount, 'product_tax' => $product_tax, 'order_tax_id' => $this -> getPurchases['order_tax'], 'order_tax' => $order_tax, 'total_tax' => $total_tax, 'shipping' => $this -> sma -> formatDecimal($shipping), 'grand_total' => $grand_total, 'status' => $status, 'created_by' => $this -> session -> userdata($this -> mod_data . '_user_id'), 'payment_term' => $payment_term, 'due_date' => $due_date );				if ($this -> Settings -> indian_gst) {					$data['cgst'] = $total_cgst;					$data['sgst'] = $total_sgst;					$data['igst'] = $total_igst;				}				if (!nv_is_url($this -> getPurchases['attachment']) and nv_is_file($this -> getPurchases['attachment'], NV_UPLOADS_DIR . '/' . $this -> mod_upload) === true) {					$photo = $this -> getPurchases['attachment'];					$data['attachment'] = $photo;				}							if ($this->form_validation->run() == true && $this->export_model->updateSale($id, $data, $products)) {									$this -> session -> set_userdata('remove_pols', 1);				$this -> session -> set_flashdata('message', $this -> lang["purchases"]);				return true;			} else {				$this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));	            $this->data['inv'] = $inv;	            if ($this->Settings->disable_editing) {	                if ($this->data['inv']->date <= date('Y-m-d', strtotime('-'.$this->Settings->disable_editing.' days'))) {	                    $this->session->set_flashdata('error', sprintf(lang("purchase_x_edited_older_than_x_days"), $this->Settings->disable_editing));	                    redirect($_SERVER["HTTP_REFERER"]);	                }	            }	            $inv_items = $this->export_model->getAllPurchaseItems($id);	            // krsort($inv_items);	            $c = rand(100000, 9999999);	            foreach ($inv_items as $item) {	                $row = $this->site->getProductByID($item->product_id);	                $row->expiry = (($item->expiry && $item->expiry != '0000-00-00') ? $this->sma->hrsd($item->expiry) : '');	                $row->base_quantity = $item->quantity;	                $row->base_unit = $row->unit ? $row->unit : $item->product_unit_id;	                $row->base_unit_cost = $row->cost ? $row->cost : $item->unit_cost;	                $row->unit = $item->product_unit_id;	                $row->qty = $item->unit_quantity;	                $row->oqty = $item->quantity;	                $row->supplier_part_no = $item->supplier_part_no;	                $row->received = $item->quantity_received ? $item->quantity_received : $item->quantity;	                $row->quantity_balance = $item->quantity_balance + ($item->quantity-$row->received);	                $row->discount = $item->discount ? $item->discount : '0';	                $options = $this->export_model->getProductOptions($row->id);	                $row->option = $item->option_id;	                $row->real_unit_cost = $item->real_unit_cost;	                $row->cost = $this->sma->formatDecimal($item->net_unit_cost + ($item->item_discount / $item->quantity));	                $row->tax_rate = $item->tax_rate_id;	                unset($row->details, $row->product_details, $row->price, $row->file, $row->product_group_id);	                $units = $this->site->getUnitsByBUID($row->base_unit);	                $tax_rate = $this->site->getTaxRateByID($row->tax_rate);	                $ri = $this->Settings->item_addition ? $row->id : $c;		                $pr[$ri] = array('id' => $c, 'item_id' => $row->id, 'label' => $row->name . " (" . $row->code . ")",	                    'row' => $row, 'tax_rate' => $tax_rate, 'units' => $units, 'options' => $options);	                $c++;				}				$this->data['inv_items'] = json_encode($pr);	            $this->data['id'] = $id;	            $this->data['suppliers'] = $this->site->getAllCompanies('supplier');	            $this->data['purchase'] = $this->export_model->getPurchaseByID($id);	            $this->data['categories'] = $this->site->getAllCategories();	            $this->data['tax_rates'] = $this->site->getAllTaxRates();	            $this->data['warehouses'] = $this->site->getAllWarehouses();	            $this->load->helper('string');	            $value = random_string('alnum', 20);	            $this->session->set_userdata('user_csrf', $value);	            $this->session->set_userdata('remove_pols', 1);	            $this->data['csrf'] = $this->session->userdata('user_csrf');	            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('purchases'), 'page' => lang('purchases')), array('link' => '#', 'page' => lang('edit_purchase')));	            $meta = array('page_title' => lang('edit_purchase'), 'bc' => $bc);	            $this->page_construct('purchases/edit', $meta, $this->data);			}		}			 	return false;	 /*
                        $stmt = $this -> db -> prepare('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_purchases SET reference_no = :reference_no, date = :date, supplier_id = :supplier_id, warehouse_id = :warehouse_id, note = :note, total = :total, product_discount = :product_discount, order_discount_id = :order_discount_id, total_discount = :total_discount, product_tax = :product_tax, order_tax_id = :order_tax_id, order_tax = :order_tax, total_tax = :total_tax, shipping = :shipping, grand_total = :grand_total, status = :status, payment_status = :payment_status, attachment = :attachment, payment_term = :payment_term WHERE id=' . $this -> getPurchases['id']);                        $stmt -> bindParam(':reference_no', $this -> getPurchases['reference_no'], PDO::PARAM_STR);                        $stmt -> bindParam(':date', $this -> getPurchases['date'], PDO::PARAM_INT);                        $stmt -> bindParam(':supplier_id', $this -> getPurchases['supplier_id'], PDO::PARAM_INT);                        $stmt -> bindParam(':warehouse_id', $this -> getPurchases['warehouse_id'], PDO::PARAM_INT);                        $stmt -> bindParam(':note', $this -> getPurchases['note'], PDO::PARAM_STR);                        $stmt -> bindParam(':total', $this -> getPurchases['total'], PDO::PARAM_STR);                        $stmt -> bindParam(':product_discount', $this -> getPurchases['product_discount'], PDO::PARAM_STR);                        $stmt -> bindParam(':order_discount_id', $this -> getPurchases['order_discount_id'], PDO::PARAM_STR);                        $stmt -> bindParam(':total_discount', $this -> getPurchases['total_discount'], PDO::PARAM_STR);                        $stmt -> bindParam(':product_tax', $this -> getPurchases['product_tax'], PDO::PARAM_STR);                        $stmt -> bindParam(':order_tax_id', $this -> getPurchases['order_tax_id'], PDO::PARAM_INT);                        $stmt -> bindParam(':order_tax', $this -> getPurchases['order_tax'], PDO::PARAM_STR);                        $stmt -> bindParam(':total_tax', $this -> getPurchases['total_tax'], PDO::PARAM_STR);                        $stmt -> bindParam(':shipping', $this -> getPurchases['shipping'], PDO::PARAM_STR);                        $stmt -> bindParam(':grand_total', $this -> getPurchases['grand_total'], PDO::PARAM_STR);                        $stmt -> bindParam(':status', $this -> getPurchases['status'], PDO::PARAM_STR);                        $stmt -> bindParam(':payment_status', $this -> getPurchases['payment_status'], PDO::PARAM_STR);                        $stmt -> bindParam(':attachment', $this -> getPurchases['attachment'], PDO::PARAM_STR);                        $stmt -> bindParam(':payment_term', $this -> getPurchases['payment_term'], PDO::PARAM_INT);                        $exc = $stmt -> execute();                        $this -> purchases_id = $this -> getPurchases['id'];                        $this -> warehouse_id = $this -> getPurchases['warehouse_id'];                        return $exc;*/
    
	}	public function AddItems($row = array()) {
		global $db, $nv_Request;
		$i = sizeof($row['product_id']);
		for ($r = 0; $r < $i; $r++) {
			$item_quantity = $row['product_quantity'][$r];
			$product['id'] = 0;
			if (isset($item_quantity)) {
				$product['purchase_id'] = $this -> purchases_id;
				$product['transfer_id'] = $nv_Request -> get_int('transfer_id', 'post', 0);
				$product['product_id'] = $row['product_id'][$r];
				$product['product_code'] = $row['product_code'][$r];
				$product['product_name'] = $row['product_name'][$r];
				$product['option_id'] = $nv_Request -> get_int('option_id', 'post', 0);
				$product['net_unit_cost'] = $nv_Request -> get_title('net_unit_cost', 'post', '');
				$product['quantity'] = $item_quantity;
				$product['warehouse_id'] = $this -> warehouse_id;
				$product['item_tax'] = $row['product_name'][$r];
				$product['tax_rate_id'] = $row['product_name'][$r];
				$product['tax'] = $row['product_name'][$r];
				$product['discount'] = $row['product_name'][$r];
				$product['item_discount'] = $row['product_name'][$r];
				$product['expiry'] = $row['product_name'][$r];
				$product['subtotal'] = $row['product_name'][$r];
				$product['quantity_balance'] = $row['product_name'][$r];
				$product['date'] = $row['product_name'][$r];
				$product['status'] = $this -> status;
				$product['unit_cost'] = $nv_Request -> get_title('unit_cost', 'post', '');
				$product['real_unit_cost'] = $nv_Request -> get_title('real_unit_cost', 'post', '');
				$product['quantity_received'] = $item_quantity;
				$product['supplier_part_no'] = $nv_Request -> get_title('supplier_part_no', 'post', '');
				$product['purchase_item_id'] = $nv_Request -> get_int('purchase_item_id', 'post', 0);
				$product['product_unit_id'] = $nv_Request -> get_int('product_unit_id', 'post', 0);
				$product['product_unit_code'] = $nv_Request -> get_title('product_unit_code', 'post', '');
				$product['unit_quantity'] = $nv_Request -> get_title('unit_quantity', 'post', '');
				$product['gst'] = $nv_Request -> get_title('gst', 'post', '');
				$product['cgst'] = $nv_Request -> get_title('cgst', 'post', '');
				$product['sgst'] = $nv_Request -> get_title('sgst', 'post', '');
				$product['igst'] = $nv_Request -> get_title('igst', 'post', '');
				try {
					if (empty($product['id'])) {
						$stmt = $db -> prepare('INSERT INTO ' . $this -> db_prefix . '_' . $this -> mod_data . '_purchase_items (purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES (:purchase_id, :transfer_id, :product_id, :product_code, :product_name, :option_id, :net_unit_cost, :quantity, :warehouse_id, :item_tax, :tax_rate_id, :tax, :discount, :item_discount, :expiry, :subtotal, :quantity_balance, :date, :status, :unit_cost, :real_unit_cost, :quantity_received, :supplier_part_no, :purchase_item_id, :product_unit_id, :product_unit_code, :unit_quantity, :gst, :cgst, :sgst, :igst)');
					} else {
						$stmt = $db -> prepare('UPDATE ' . $this -> db_prefix . '_' . $this -> mod_data . '_purchase_items SET purchase_id = :purchase_id, transfer_id = :transfer_id, product_id = :product_id, product_code = :product_code, product_name = :product_name, option_id = :option_id, net_unit_cost = :net_unit_cost, quantity = :quantity, warehouse_id = :warehouse_id, item_tax = :item_tax, tax_rate_id = :tax_rate_id, tax = :tax, discount = :discount, item_discount = :item_discount, expiry = :expiry, subtotal = :subtotal, quantity_balance = :quantity_balance, date = :date, status = :status, unit_cost = :unit_cost, real_unit_cost = :real_unit_cost, quantity_received = :quantity_received, supplier_part_no = :supplier_part_no, purchase_item_id = :purchase_item_id, product_unit_id = :product_unit_id, product_unit_code = :product_unit_code, unit_quantity = :unit_quantity, gst = :gst, cgst = :cgst, sgst = :sgst, igst = :igst WHERE id=' . $row['id']);
					}
					$stmt -> bindParam(':purchase_id', $product['purchase_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':transfer_id', $product['transfer_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_id', $product['product_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_code', $product['product_code'], PDO::PARAM_STR);
					$stmt -> bindParam(':product_name', $product['product_name'], PDO::PARAM_STR);
					$stmt -> bindParam(':option_id', $product['option_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':net_unit_cost', $product['net_unit_cost'], PDO::PARAM_STR);
					$stmt -> bindParam(':quantity', $product['quantity'], PDO::PARAM_STR);
					$stmt -> bindParam(':warehouse_id', $product['warehouse_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':item_tax', $product['item_tax'], PDO::PARAM_STR);
					$stmt -> bindParam(':tax_rate_id', $product['tax_rate_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':tax', $product['tax'], PDO::PARAM_STR);
					$stmt -> bindParam(':discount', $product['discount'], PDO::PARAM_STR);
					$stmt -> bindParam(':item_discount', $product['item_discount'], PDO::PARAM_STR);
					$stmt -> bindParam(':expiry', $product['expiry'], PDO::PARAM_STR);
					$stmt -> bindParam(':subtotal', $product['subtotal'], PDO::PARAM_STR);
					$stmt -> bindParam(':quantity_balance', $product['quantity_balance'], PDO::PARAM_STR);
					$stmt -> bindParam(':date', $product['date'], PDO::PARAM_STR);
					$stmt -> bindParam(':status', $product['status'], PDO::PARAM_STR);
					$stmt -> bindParam(':unit_cost', $product['unit_cost'], PDO::PARAM_STR);
					$stmt -> bindParam(':real_unit_cost', $product['real_unit_cost'], PDO::PARAM_STR);
					$stmt -> bindParam(':quantity_received', $product['quantity_received'], PDO::PARAM_STR);
					$stmt -> bindParam(':supplier_part_no', $product['supplier_part_no'], PDO::PARAM_STR);
					$stmt -> bindParam(':purchase_item_id', $product['purchase_item_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_unit_id', $product['product_unit_id'], PDO::PARAM_INT);
					$stmt -> bindParam(':product_unit_code', $product['product_unit_code'], PDO::PARAM_STR);
					$stmt -> bindParam(':unit_quantity', $product['unit_quantity'], PDO::PARAM_STR);
					$stmt -> bindParam(':gst', $product['gst'], PDO::PARAM_STR);
					$stmt -> bindParam(':cgst', $product['cgst'], PDO::PARAM_STR);
					$stmt -> bindParam(':sgst', $product['sgst'], PDO::PARAM_STR);
					$stmt -> bindParam(':igst', $product['igst'], PDO::PARAM_STR);
					$exc = $stmt -> execute();
				} catch(PDOException $e) {
					trigger_error($e -> getMessage());
					die($e -> getMessage());					//Remove this line after checks finished
				}
			}
		}
	}}