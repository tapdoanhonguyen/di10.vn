<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */

if (!defined('NV_IS_MOD_STOREHOUSE'))
    die('Stop!!!');

$title = $nv_Request->get_title('title', 'post', '');
$alias = change_alias($title);
    $alias = strtolower($alias);

$id = $nv_Request->get_int('id', 'get,post', 0);
$mod = $nv_Request->get_string('mod', 'get,post', '');
$amod = $nv_Request->get_string('amod', 'get', '');
$pos = new NukeViet\StoreHouse\Pos;
$sales = new NukeViet\StoreHouse\Sales;
$storehouse = new NukeViet\StoreHouse\StoreHouse;
$report = new NukeViet\StoreHouse\Reports;
$purchases = new NukeViet\StoreHouse\Purchases;
$projects = new NukeViet\StoreHouse\Project;
if ($mod == 'products') {
    $stmt = $db->prepare('SELECT COUNT(*) FROM ' . $db_config['prefix'] . '_' . $module_data . '_products WHERE id!=' . $id . ' AND alias= :alias');
    $stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
    $stmt->execute();
    $nb = $stmt->fetchColumn();
    if (!empty($nb)) {
        if ($id) {
            $alias .= '-' . $id;
        } else {
            $nb = $db->query('SELECT MAX(id) FROM ' . $db_config['prefix'] . '_' . $module_data . '_products')->fetchColumn();
            $alias .= '-' . (intval($nb) + 1);
        }
    }
	$content=$alias;
}
if ($mod == 'warehouse_list') {
    $store_id = $nv_Request->get_title('store_id', 'post, get', '');
	
    $db->sqlreset()
        ->select('id, code, name')
        ->from($db_config['prefix'] . '_' . $module_data . '_warehouses')
        ->where('store_id = :store_id')
        ->order('id ASC')
        ->limit(20);

    $sth = $db->prepare($db->sql());
    $sth->bindValue(':store_id', $store_id, PDO::PARAM_INT);
    $sth->execute();

    $array_data = array();
    while (list ($id, $code, $name) = $sth->fetch(3)) {
        $array_data[] = array(
            'id' => $id,
            'title' => $name
        );
    }

    nv_jsonOutput($array_data);
}
if ($mod == 'products_list') {
    $q = $nv_Request->get_title('q', 'post, get', '');

    $db->sqlreset()
        ->select('id, code, name')
        ->from($db_config['prefix'] . '_' . $module_data . '_products')
        ->where('name LIKE :q_title')
        ->order('id ASC')
        ->limit(20);

    $sth = $db->prepare($db->sql());
    $sth->bindValue(':q_title', '%' . $q . '%', PDO::PARAM_STR);
    $sth->execute();

    $array_data = array();
    while (list ($id, $code, $name) = $sth->fetch(3)) {
        $array_data[] = array(
            'id' => $id,
            'title' => $code . '-' . $name
        );
    }

    nv_jsonOutput($array_data);
}
if ($mod == 'products_shop_list') {
    $q = $nv_Request->get_title('q', 'post, get', '');
    $pro_sh_id = $nv_Request->get_int('pro_sh_id', 'post, get', 0);
    $id_product_select = $nv_Request->get_int('id_product_select', 'post, get', 0);
	if($q!='') $where = '(code LIKE :q_code OR name LIKE :q_title ) ';
	
    $db->sqlreset()
        ->select('id, code, name, quantity, purchase_unit')
        ->from($db_config['prefix'] . '_' . $module_data . '_products')
        ->where($where)
        ->order('id ASC')
        ->limit(20);

    $sth = $db->prepare($db->sql());
	if($q!='') $sth->bindValue(':q_title', '%' . $q . '%', PDO::PARAM_STR);
	if($q!='') $sth->bindValue(':q_code', '%' . $q . '%', PDO::PARAM_STR);
    $sth->execute();

    $array_data = array();
    while (list ($id, $code, $name, $quantity, $purchase_unit) = $sth->fetch(3)) {
    	$db->sqlreset()
        ->select('name')
        ->from($db_config['prefix'] . '_' . $module_data . '_units')
        ->where('id = ' . $purchase_unit);
		$sth1 = $db->prepare($db->sql());
	    $sth1->execute();
		list ($unit_name) = $sth1->fetch(3);
        $array_data[] = array(
            'id' => $id,
            'title' => $code,
            'name' => $name,
            'unit_name' => $unit_name,
            'unit_id' => $purchase_unit,
            'pro_sh_id' => $pro_sh_id,
            'id_product_select' => $id_product_select
        );
    }

    nv_jsonOutput($array_data);
}
if ($mod == 'products_items') {

    $db->sqlreset()
        ->select(' code, name, cost, tax_method, tax_rate, purchase_unit')
        ->from($db_config['prefix'] . '_' . $module_data . '_products')
        ->where('id="'.$id.'"');

    $sth = $db->prepare($db->sql());
    $sth->execute();

    $array_data = array();
    while (list ( $code, $name, $cost, $tax_method, $tax_rate, $purchase_unit) = $sth->fetch(3)) {
		if($tax_method ==1) {
			if($tax_rate == 2){
				$tax_per = $array_tax_rate_storehouse[$tax_rate]['rate']/100;
				$tax = 1 + $tax_per;
			}
		}else{
			$tax = 1;
			$tax_per = 0;
		}
        $array_data = array(
            'id' => $id,
            'title' =>  $name,
            'code' =>  $code,
			'cost' => $cost/$tax,
			'discount' => 0,
			'tax' => $tax_per*100,
			'tax_id' => $tax_rate,
			'cost_tax' => $cost-$cost/$tax,
			'quantity' => 1,
			'purchase_unit' => $purchase_unit,
			'total' => $cost
			
        );
    }

    nv_jsonOutput($array_data);
}
if ($mod == 'set_session_store_id') {
	$session_store_id = $nv_Request->get_title('session_store_id', 'post, get', '');
    $_SESSION[$module_data . '_store_id'] = $session_store_id;
	$array_data = array(
            'session_store_id' => $session_store_id
        );
    nv_jsonOutput($array_data);
}
if ($mod == 'set_session_store_remove_posls') {
	$session_remove_posls = $nv_Request->get_title('session_store_id', 'post, get', '');
    $_SESSION[$module_data . '_remove_posls'] = $session_remove_posls;
	die('OKE');
}

if ($mod == 'set_session_store_id_new') {
	$session_store_id = $nv_Request->get_title('session_store_id', 'post, get', '');
    $_SESSION[$module_data . '_store_id_new'] = $session_store_id;
	$array_data = array(
            'session_store_id' => $session_store_id
        );
    nv_jsonOutput($array_data);
}
if ($mod == 'ProductDataByCode') {
	$code = $nv_Request->get_title('code', 'get', '');
	$warehouse_id = $nv_Request->get_title('warehouse_id', 'get', '');
	$customer_id = $nv_Request->get_title('customer_id', 'get', '');
	$pos = new NukeViet\StoreHouse\Pos;
	$product_detail = $pos->getProductDataByCode($code,$warehouse_id,$customer_id);
    die($product_detail);
}
if ($mod == 'sales_suggestions') {
	$term= $nv_Request->get_title('term', 'get', '');
	$warehouse_id = $nv_Request->get_int('warehouse_id', 'get', 0);
	$customer_id = $nv_Request->get_int('customer_id', 'get', 0);
	$pos = new NukeViet\StoreHouse\Sales;
	$product_detail = $pos->suggestions($term,$warehouse_id,$customer_id);
    die($product_detail);
}
if ($mod == 'customers_suggestions') {
	
	$term= $nv_Request->get_title('term', 'get', '');
	if($term != ''){
		$rows =array();
		$db->select("id, (CASE WHEN company = '-' THEN name ELSE CONCAT(company, ' (', name, ')') END) as text, (CASE WHEN company = '-' THEN name ELSE CONCAT(company, ' (', name, ')') END) as value, phone")
		->from($db_config['prefix'] . '_' . $module_data . '_companies')
        ->where("group_id IN (1,3) AND (id LIKE '%" . $term . "%' OR name LIKE '%" . $term . "%' OR company LIKE '%" . $term . "%' OR email LIKE '%" . $term . "%' OR phone LIKE '%" . $term . "%') ");
		
        $q = $db->query($db->sql());
        if($q->rowCount() > 0){
        	foreach($q->fetchALL() as $cs_rows){
        		$rows[] = $cs_rows;
        	}
        	$drows['results'] = $rows;
			nv_jsonOutput($drows);
        }
		
	}else{
		die();
	}
    
}
if ($mod == 'supplier_view_purchases') {
	$purchaseid = $nv_Request->get_int('purchaseid', 'get', 0);
	$purchase = $purchases->purchases_model->getPurchaseByID($purchaseid);
	$purchase->date = date('d/m/Y H:i', $purchase->date);
	$purchase->debt = $purchase->grand_total -  $purchase->paid;
	$purchase->debt_fomart = storehouse_number_format($purchase->grand_total -  $purchase->paid,0);
	$purchase_items=$purchases->purchases_model->getAllPurchaseItems($purchaseid);
	$xtpl = new XTemplate('ajax.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		$xtpl->assign('LANG', $lang_module);
		$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
		$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
		$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
		$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
		$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
		$xtpl->assign('MODULE_NAME', $module_name);
		$xtpl->assign('MODULE_UPLOAD', $module_upload);
		$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
		$xtpl->assign('OP', $op);
		$xtpl->assign('ROW', $purchase);
		foreach ($purchase_items as $item){
			$xtpl->assign('ITEM', $item);
			$xtpl->parse('ajax_purchases_view.items');
		}
		
	    $xtpl->parse('ajax_purchases_view');
		$contents = $xtpl->text('ajax_purchases_view');
		//print_r(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		include NV_ROOTDIR . '/includes/header.php';
		echo $contents;
		include NV_ROOTDIR . '/includes/footer.php';
		die;
}
if ($mod == 'customer_view_sales') {
	$saleid = $nv_Request->get_int('saleid', 'get', 0);
	$sale = $sales->sales_model->getInvoiceByID($saleid);
	$sale->date = date('d/m/Y H:i', $sale->date);
	$sale->sale_status_name = $array_sales_status[$sale->sale_status];
	$sale->payment_status_name = $array_payment_status[$sale->payment_status];
	$sale->debt = $sale->grand_total -  $sale->paid;
	$sale->debt_fomart = storehouse_number_format($sale->grand_total -  $sale->paid,0);
	$sale_items=$sales->sales_model->getAllSaleItems($saleid);
	$xtpl = new XTemplate('ajax.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		$xtpl->assign('LANG', $lang_module);
		$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
		$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
		$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
		$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
		$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
		$xtpl->assign('MODULE_NAME', $module_name);
		$xtpl->assign('MODULE_UPLOAD', $module_upload);
		$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
		$xtpl->assign('OP', $op);
		$xtpl->assign('ROW', $sale);
		foreach ($sale_items as $item){
			$xtpl->assign('ITEM', $item);
			$xtpl->parse('ajax_sales_view.items');
		}
		
	    $xtpl->parse('ajax_sales_view');
		$contents = $xtpl->text('ajax_sales_view');
		//print_r(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		include NV_ROOTDIR . '/includes/header.php';
		echo $contents;
		include NV_ROOTDIR . '/includes/footer.php';
		die;
}
if ($mod == 'customer_view_project') {
	$projectid = $nv_Request->get_int('projectid', 'get', 0);
	$project = $projects->get_Customer_Project($projectid);
	
	$sale = $sales->sales_model->getAllSales();
	$xtpl = new XTemplate('ajax.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		$xtpl->assign('LANG', $lang_module);
		$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
		$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
		$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
		$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
		$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
		$xtpl->assign('MODULE_NAME', $module_name);
		$xtpl->assign('MODULE_UPLOAD', $module_upload);
		$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
		$xtpl->assign('OP', $op);
		$xtpl->assign('ROW', $sale);
		$i=1;
		foreach ($sale as $item){
			if($item->projectid==$projectid && $item->customer_id == $project -> customerid){
				//print_r($item);
				$item->number =$i;
				$item->date = date('d/m/Y H:i', $item->date);
				$item->sale_status_name = $array_sales_status[$item->sale_status];
				$item->payment_status_name = $array_payment_status[$item->payment_status];
				$item->debt = $item->grand_total -  $item->paid;
				$item->debt_fomart = storehouse_number_format($item->grand_total -  $item->paid,0);
				$xtpl->assign('ITEM', $item);
				$xtpl->parse('ajax_project_view.items');
				$i++;
			}
			
		}
		
	    $xtpl->parse('ajax_project_view');
		$contents = $xtpl->text('ajax_project_view');
		//print_r(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		include NV_ROOTDIR . '/includes/header.php';
		echo $contents;
		include NV_ROOTDIR . '/includes/footer.php';
		die;
}
if ($mod == 'customers_getCustomer') {
	$customer_id = $nv_Request->get_int('customer_id', 'get', 0);
	$customer = array();
	$db->sqlreset()
            ->select("id,name,company")
            ->from($db_config['prefix'] . '_' . $module_data . '_companies')
            ->where(' id = ' . $customer_id);
	$q = $db->query($db->sql())->fetch();
	$customer['id'] = $q['id'];
	if($q['company']=='')
		$customer['text'] = $q['name'];
	else
		$customer['text'] = $q['company'];
    nv_jsonOutput($customer);
}
if ($mod == 'pos_ajaxcategorydata') {
	$category_id = $nv_Request->get_title('category_id', 'get', '');
	$pos = new NukeViet\StoreHouse\Pos;
	$product_cat = $pos->ajaxcategorydata($category_id);
    die($product_cat);
}


if ($mod == 'log_pro_sche') {
	$projectid = $nv_Request->get_string('projectid', 'get', 0);
	$saleid = $nv_Request->get_string('saleid', 'get', 0);
	$sql=$db->query("SELECT * FROM " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_production_plan pl LEFT JOIN " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_project p ON pl.projectid = p.projectid WHERE pl.saleid = " . $saleid . " AND pl.projectid = " . $projectid);
	$sql_user=$db->query("SELECT * FROM " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . "_users u LEFT JOIN " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_groups_user gu on u.userid = gu.userid WHERE  gu.group_id = 25 ORDER BY u.username ASC");
	$json=array();
	$content=array();
	$list_user=array();
	$list_employer=array();
	$user=array();
	foreach($sql_user as $user){
		$users[] = $user['userid'];	
		$list_user[$user['userid']] = $user['username'];
	}

	foreach($sql as $value){
		$user_list=explode(',',$value['userid']);
		foreach($user_list as $user){
			if(in_array($user, $users)){
				$list_employer[]= $list_user[$user];
				$process=false;
				$checkproduct=false;
				$checkproduct=false;
				$checkproductsu=false;
				if( $value['status'] == 0 ){
					$process=true;
					$action = '1';
				}elseif( $value['status'] == 1){
					$checkproduct=true;
					$action = '2';
				}elseif( ($value['status'] == 2 && $is_leader ==1 AND $groups ==25) || ($value['status'] == 2 && $groups ==1) ){
					$checkproductsu=true;
					$action = '3';
				}elseif( $value['status'] == 3){
					$complete=true;
					$action = '4';
				}else{
					$process=false;
				}
				$content = ['id'=>$value['id'], 'projectid'=>$projectid , 'saleid'=>$saleid , 'projectname'=>$value['title'], 'day_start'=> date('d/m/Y',$value['timestart']), 'day_end'=>date('d/m/Y',$value['timeend']), 'employees' => implode(',', $list_employer), 'employeesid' => $value['userid'], 'status' => $global_array_status_pro_sche[$value['status']], 'process' => $process, 'checkpro' => $checkproduct, 'checkprosu' => $checkproductsu, 'complete' => $complete, 'action' => $action];	
			}
		}
		
		
	}
	$json = ['status' => "OKE", 'content'=> $content];
	echo json_encode($json);die;
}
if ($mod == 'process_pro_sche') {
	$projectid = $nv_Request->get_string('projectid', 'post', 0);
	$saleid = $nv_Request->get_string('saleid', 'post', 0);
	$planid = $nv_Request->get_string('id', 'post', 0);
	$process = $nv_Request->get_string('process', 'get', 0);
	$checkpro = $nv_Request->get_string('checkpro', 'get', 0);
	$checkprosu = $nv_Request->get_string('checkprosu', 'get', 0);
	$status = $nv_Request->get_string('status', 'post', 0);
	$error = array();
	if($process == true && $status !=1)
		$error[] = $lang_module['process_pro_sche_error_status'];
	if($checkpro == true && $status !=2)
		$error[] = $lang_module['checkpro_pro_sche_error_status'];
	if($checkprosu == true && $status !=3)
		$error[] = $lang_module['checkpro_pro_sche_error_status'];
	if(empty($projectid)){
		$error[] =$lang_module['no_project'];
	}
	if($process||$checkpro||$checkprosu){
		$ok = $db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_production_plan SET status=' . $status . ' WHERE id = ' . $planid . ' AND projectid = '. $projectid);
		if($ok==0){
			$error[] = $lang_module['process_pro_sche_error'];
		}
	}
	if(empty($error)){
		if($status == 1){
			log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'process_pro_sche', $lang_module['pro_sche_status_1'] , $user_info['userid'], $status);
		}elseif($status == 2){
			log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'process_pro_sche_success', $lang_module['pro_sche_status_2'] , $user_info['userid'], $status);
		}elseif($status == 3){
			log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'check_pro_sche_success', $lang_module['pro_sche_status_3'] , $user_info['userid'], $status);
		}elseif($status == 4){
			log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'add_vehicle', $lang_module['pro_sche_status_4'] , $user_info['userid'], $status);
		}   
		
		$json=array("status" => "OKE", "text" => $lang_module['process_pro_sche_success'], "project"=>$projectid, "sale"=>$saleid);
	}else{
		$json=array("status" => "NO", "text" => implode('|',$error), "project"=>$projectid, "sale"=>$saleid);
	}
	echo json_encode($json);
}

if ($mod == 'log_vehicle') {
	$projectid = $nv_Request->get_string('projectid', 'get', 0);
	$saleid = $nv_Request->get_string('saleid', 'get', 0);
	$sql=$db->query("SELECT * FROM " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_vehicle v LEFT JOIN " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_project p ON v.projectid = p.projectid WHERE v.saleid = " . $saleid . " AND v.projectid = " . $projectid);
	$sql_user=$db->query("SELECT * FROM " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . "_users u LEFT JOIN " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_groups_user gu on u.userid = gu.userid WHERE  gu.group_id = 23 ORDER BY u.username ASC");
	$quantity_current = $db->query('SELECT COUNT(id) FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle_user_history WHERE projectid = '. $projectid .' AND saleid = ' . $saleid . ' AND userid = ' . $user_info['userid'] )->fetchColumn();
	$total = $db->query('SELECT quantity FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle_user WHERE projectid = '. $projectid .' AND saleid = ' . $saleid . ' AND userid = ' . $user_info['userid'] )->fetch(2);
	
	$json=array();
	$content=array();
	$list_user=array();
	$list_employer=array();
	$user=array();
	foreach($sql_user as $user){
		$users[] = $user['userid'];	
		$list_user[$user['userid']] = $user['username'];
	}

	foreach($sql as $value){
		$user_list=explode(',',$value['listuser']);
		foreach($user_list as $user){
			if(in_array($user, $users)){
				$list_employer[]= $list_user[$user];
				$process=false;
				$checkproduct=false;
				$checkproductsu=false;
				if( $value['status'] == 1 AND $quantity_current <= $total['quantity']){
					$process=true;
					$action = '2';
				}else{
					$process=false;
				}
				if($value['timereceipt'] !=0){
					$timereceipt = date('d/m/Y',$value['timereceipt']);
				}else{
					$timereceipt='';
				}
				$content = ['id'=>$value['id'], 'projectid'=>$projectid , 'saleid'=>$saleid , 'projectname'=>$value['title'], 'day_start'=> date('d/m/Y',$value['timedelivery']), 'day_end'=>$timereceipt, 'employees' => implode(',', $list_employer), 'employeesid' => $user_info['userid'], 'status' => $global_array_status_vehicle[$value['status']], 'process' => $process, 'checkpro' => $checkproduct, 'checkprosu' => $checkproductsu, 'action' => $action, 'quantity' => $quantity_current, 'totalv' => $total['quantity']];	
			}
		}
		
		
	}
	$json = ['status' => "OKE", 'content'=> $content];
	echo json_encode($json);die;
}
if ($mod == 'process_vehicle') {
	$projectid = $nv_Request->get_string('projectid', 'post', 0);
	$saleid = $nv_Request->get_string('saleid', 'post', 0);
	$vehicleid = $nv_Request->get_string('id', 'post', 0);
	$process = $nv_Request->get_string('process', 'get', 0);
	$checkpro = $nv_Request->get_string('checkpro', 'get', 0);
	$checkprosu = $nv_Request->get_string('checkprosu', 'get', 0);
	$status = $nv_Request->get_string('status', 'post', 0);
	$quantity = $nv_Request->get_int('quantity', 'post', 0);
	$totals = $nv_Request->get_int('total', 'post', 0);
	
	$total = $db->query('SELECT quantity FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle_user WHERE projectid = '. $projectid .' AND saleid = ' . $saleid . ' AND userid = ' . $user_info['userid'] )->fetch(2);
	
	$error = array();
	if($process == true && $status !=2)
		$error[] = $lang_module['process_vehicle_error_status'];
	if(empty($projectid)){
		$error[] =$lang_module['no_project'];
	}
	if($process||$checkpro||$checkprosu){
		if($quantity<$total['quantity'] && $quantity<$totals){
			$_sql = 'INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle_user_history (projectid, saleid, userid, timereceipt ) VALUE (:projectid, :saleid, :userid, ' . NV_CURRENTTIME . ')';
			$data_insert = array();
		    $data_insert['projectid'] = $projectid;
		    $data_insert['saleid'] = $saleid;
		    $data_insert['userid'] = $user_info['userid'];
		
		    $ok3 = $db->insert_id($_sql, 'id', $data_insert);
			if($ok3){
				$quantity++;
			}
		}
		$quantity_current = $db->query('SELECT COUNT(id) FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle_user_history WHERE projectid = '. $projectid .' AND saleid = ' . $saleid . ' AND userid = ' . $user_info['userid'] )->fetchColumn();
		if($quantity>=$total['quantity'] && $quantity_current == $total['quantity']){
			//print_r($total['quantity']);die;
			$ok3=1;
			$ok = $db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle SET status=' . $status . ', timereceipt=' . NV_CURRENTTIME . ' WHERE id = ' . $vehicleid . ' AND projectid = '. $projectid);
			$ok2 = $db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_sales SET sale_status=5 WHERE id = ' . $saleid . ' AND projectid = '. $projectid);
		}else{
			$ok=1;
			$ok2=1;
			
			
		}
		
		
		if($ok==0 ){
			$error[] = $lang_module['process_vehicle_error'];
		}
		if($ok2==0 ){
			$error[] = $lang_module['process_vehicle_error'];
		}
		if($ok3==0 ){
			$error[] = $lang_module['process_vehicle_error'];
		}
		
	}
	if(empty($error)){ 
		log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'process_vehicle', $lang_module['process_vehicle_success']. ' (' . $quantity . '/' . $total['quantity'] .')', $user_info['userid'], $status);
		$json=array("status" => "OKE", "text" => $lang_module['process_vehicle_success'] . '('. $quantity.'/' . $total['quantity'] .')', "project"=>$projectid, "sale"=>$saleid);
	}else{
		$json=array("status" => "NO", "text" => implode('|',$error), "project"=>$projectid, "sale"=>$saleid);
	}
	echo json_encode($json);
}


include NV_ROOTDIR . '/includes/header.php';
echo $content;
include NV_ROOTDIR . '/includes/footer.php';

