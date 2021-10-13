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
class Transfer extends MY_Controller {
	public $warehouse_id = '';
	public $purchases_id = '';
	public $status = '';
	public function __construct() {
		global $db_config, $db, $nv_Request, $nv_Request;
		parent::__construct();
		//$this->lang->admin_load('purchases', 'vi');
		$this -> transfer_model = &load_class('Transfer_model');
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
	}
	function add()    {
		global $global_config;
    	if ($this->form_validation->run()) {
    		$transfer_no = $this->input->get_title('reference_no','post','') ? $this->input->get_title('reference_no') : $this->site->getReference('orto');
			if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $this->input->get_string('date', 'post', 0), $m))     {
		        $_hour = $this->input->get_int('date_hour', 'post');		        $_min = $this->input->get_int('date_min', 'post');
		        $date = mktime($_hour, $_min, 0, $m[2], $m[1], $m[3]);
			}else{
		        $date = 0;
			}			
			$to_warehouse = $this->input->get_int('warehouse_id_new');            
			$from_warehouse = $this->input->get_int('warehouse_id');			
			$from_warehouse_details = $this->site->getWarehouseByID($from_warehouse);            
			$from_warehouse_code = $from_warehouse_details->code;            
			$from_warehouse_name = $from_warehouse_details->name;			
			$to_warehouse_details = $this->site->getWarehouseByID($to_warehouse);            
			$to_warehouse_code = $to_warehouse_details->code;            
			$to_warehouse_name = $to_warehouse_details->name;			
			$note = $this->sma->clear_tags($this->input->get_title('note','post',''));            
			$shipping = $this->input->get_title('shipping','post','') ? $this->input->get_title('shipping','post','') : 0;            
			$status = $this->input->get_int('status','post',0);		
			$total = 0;            
			$product_tax = 0;            
			$gst_data = array();            
			$total_cgst = $total_sgst = $total_igst = 0;            
			$i = sizeof($this->input->get_array('product_code','post', 0));			
			$product_id = $this->input->get_array('product_id', 'post', 0);		    
			$product_quantity = $this->input->get_array('product_quantity', 'post', 0);		    
			$product_option = $this->input->get_array('product_option', 'post', 0);		    
			$product_expried = $this->input->get_array('product_expried', 'post', 0);		    
			$product_discount_array = $this->input->get_array('product_discount', 'post', 0);		    
			$product_tax_rate = $this->input->get_array('product_tax_rate', 'post', 0);		    
			$product_tax_array = $this->input->get_array('product_tax', 'post', 0);		    
			$product_cost_tax = $this->input->get_array('product_cost_tax', 'post', 0);		    
			$product_total = $this->input->get_array('product_total', 'post', 0);		    
			$product_code = $this->input->get_array('product_code', 'post', 0);		    
			$product_name = $this->input->get_array('product_name', 'post', 0);		    
			$product_unit = $this->input->get_array('product_unit', 'post', 0);		    
			$product_base_quantity = $this->input->get_array('product_base_quantity', 'post', 0);		    
			$product_real_unit_cost = $this->input->get_array('product_real_unit_cost', 'post', 0);		    
			$product_net_cost = $this->input->get_array('product_net_cost', 'post', 0);		    
			$product_unit_cost = $this->input->get_array('product_unit_cost', 'post', 0);		    
			$part_no = $this->input->get_array('part_no', 'post', 0);			
			$product_tax = 0;			
			$product_discount = 0;			
			for ($r = 0; $r < $i; $r++) {				
				$item_code = $product_code[$r];				
				$item_net_cost = $this -> sma -> formatDecimal($product_net_cost[$r]);				
				$unit_cost = $this -> sma -> formatDecimal($product_unit_cost[$r]);				
				$real_unit_cost = $this -> sma -> formatDecimal($product_real_unit_cost[$r]);				
				$item_unit_quantity = $product_base_quantity[$r];				
				$item_option = isset($product_option[$r]) && $product_option[$r] != 'false' ? $product_option[$r] : null;				
				$item_tax_rate = isset($product_tax_array[$r]) ? $product_tax_array[$r] : null;				
				$item_discount = isset($product_discount_array[$r]) ? $product_discount_array[$r] : null;				
				$item_expiry = (isset($product_expried[$r]) && !empty($product_expried[$r])) ? $product_expried[$r] : '';				
				$supplier_part_no = (isset($part_no[$r]) && !empty($part_no[$r])) ? $part_no[$r] : null;				
				$item_unit = $product_unit[$r];				
				$item_quantity = $product_base_quantity[$r];				
				if (isset($item_code) && isset($real_unit_cost)  && isset($item_quantity)) {					
					$product_details = $this -> site -> getProductByCode($item_code);					
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
					$product = array(                        
						'product_id' => $product_details->id,                        
						'product_code' => $item_code,                        
						'product_name' => $product_details->name,                        
						'option_id' => $item_option,                        
						'net_unit_cost' => $item_net_cost,                        
						'unit_cost' => $this->sma->formatDecimal($item_net_cost + $item_tax, 4),                        
						'quantity' => $item_quantity,                        
						'product_unit_id' => $item_unit,                        
						'product_unit_code' => $unit->code,                        
						'unit_quantity' => $item_unit_quantity,                        
						'quantity_received' => $item_quantity,                        
						'quantity_balance' => $item_quantity,                        
						'warehouse_id' => $to_warehouse,                        
						'item_tax' => $pr_item_tax,                        
						'tax_rate_id' => $item_tax_rate,                        
						'tax' => $tax,                        
						'subtotal' => $this->sma->formatDecimal($subtotal),                        
						'expiry' => $item_expiry,                        
						'real_unit_cost' => $real_unit_cost,                        
						'date' => $date                    
					);					
					$products[] = ($product + $gst_data);					
					$total += $this -> sma -> formatDecimal(($item_net_cost * $item_unit_quantity), 4);				
				}			
			}			
			$grand_total = $this->sma->formatDecimal(($total + $shipping + $product_tax), 4);			
			$data = array('transfer_no' => $transfer_no,                
				'date' => $date,                
				'from_warehouse_id' => $from_warehouse,                
				'from_warehouse_code' => $from_warehouse_code,                
				'from_warehouse_name' => $from_warehouse_name,                
				'to_warehouse_id' => $to_warehouse,                
				'to_warehouse_code' => $to_warehouse_code,                
				'to_warehouse_name' => $to_warehouse_name,                
				'note' => $note,                
				'total_tax' => $product_tax,                
				'total' => $total,                
				'grand_total' => $grand_total,                
				'created_by' => $this->session->userdata('user_id'),                
				'status' => $status,                
				'shipping' => $shipping,            
				'idsite' => $global_config['idsite'],            
				'parentid' => $global_config['parentid']            
			);            
			if ($this->Settings->indian_gst) {                
				$data['cgst'] = $total_cgst;                
				$data['sgst'] = $total_sgst;                
				$data['igst'] = $total_igst;            
			}		
		}		
		if ($this->form_validation->run() == true && $this->transfer_model->addTransfer($data, $products)) {
			return true;		
		}	
	}	
	public function AddItems($row = array()) {
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
	}
	function delete($id = NULL)
    {

        $id=$this->input->get_int('delete_id','post',0);	

        if ($this->transfers_model->deleteTransfer($id)) {
			return true;
        }
    }
}