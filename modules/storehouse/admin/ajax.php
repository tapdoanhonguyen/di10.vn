<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
require NV_ROOTDIR . '/modules/' . $module_file . '/global.catalogy.php';
require NV_ROOTDIR . '/modules/' . $module_file . '/global.datadefault.php';
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
if ($mod == 'wpurstatus') {
	$purid = $nv_Request->get_int('purid', 'get,post', 0);
	$sql = 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_warehouses WHERE id=' . $purid . ' AND purchases IN (0,1)';
	$row = $db->query($sql)->fetch();
	if (empty($row)) {
		nv_htmlOutput('NO|act_pur_' . $purid);
	}
	$act = intval($row['purchases']);
	
	if ($act == 0) {
		$act = 1;
	} elseif ($act == 1) {
		$act = 0;
		
	}
	$return = ($db->exec('UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_warehouses SET purchases = ' . $act . ' WHERE id = ' . $purid)) ? 'OK' : 'NO';
	nv_htmlOutput($return . '|act_pur_' . $purid);
}
if ($mod == 'wsalestatus') {
	$saleid = $nv_Request->get_int('saleid', 'get,post', 0);
	$sql = 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_warehouses WHERE id=' . $saleid . ' AND sales IN (0,1)';
	$row = $db->query($sql)->fetch();
	if (empty($row)) {
		nv_htmlOutput('NO|act_sale_' . $purid);
	}
	$act = intval($row['sales']);
	
	if ($act == 0) {
		$act = 1;
	} elseif ($act == 1) {
		$act = 0;
		
	}
	$return = ($db->exec('UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_warehouses SET sales = ' . $act . ' WHERE id = ' . $saleid)) ? 'OK' : 'NO';
	nv_htmlOutput($return . '|act_sale_' . $saleid);
}
if ($mod == 'products') {
    $stmt = $db->prepare('SELECT COUNT(*) FROM ' . $db_config['dbsystem'] . '.'  . NV_TABLE_SHOPS . '_rows WHERE id!=' . $id . ' AND alias= :alias');
    $stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
    $stmt->execute();
    $nb = $stmt->fetchColumn();
    if (!empty($nb)) {
        if ($id) {
            $alias .= '-' . $id;
        } else {
            $nb = $db->query('SELECT MAX(id) FROM ' . $db_config['dbsystem'] . '.' . NV_TABLE_SHOPS . '_rows')->fetchColumn();
            $alias .= '-' . (intval($nb) + 1);
        }
    }
	$content=$alias;
}
if ($mod == 'warehouse_list') {
    $store_id = $nv_Request->get_title('store_id', 'post, get', '');
	
    $db->sqlreset()
        ->select('id, code, name')
        ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_warehouses')
        ->where('store_id = :store_id')
        ->order('id ASC');

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
        ->from($db_config['dbsystem'] . '.' . NV_TABLE_SHOPS . '_rows')
        ->where('name LIKE :q_title AND type != "material"')
        ->order('id ASC');

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
if ($mod == 'products_list_material') {
    $q = $nv_Request->get_title('q', 'post, get', '');

    $db->sqlreset()
        ->select('id, code, name')
        ->from($db_config['dbsystem'] . '.' . NV_TABLE_SHOPS . '_rows')
        ->where('name LIKE :q_title AND type = "material"')
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
	if($q!='') $where = '(code LIKE :q_code OR name LIKE :q_title ) AND type != "material"';
	
    $db->sqlreset()
        ->select('id, code, name, quantity, purchase_unit')
        ->from($db_config['dbsystem'] . '.' . $module_data . '_rows')
        ->where($where)
        ->order('id ASC');

    $sth = $db->prepare($db->sql());
	if($q!='') $sth->bindValue(':q_title', '%' . $q . '%', PDO::PARAM_STR);
	if($q!='') $sth->bindValue(':q_code', '%' . $q . '%', PDO::PARAM_STR);
    $sth->execute();

    $array_data = array();
    while (list ($id, $code, $name, $quantity, $purchase_unit) = $sth->fetch(3)) {
    	$db->sqlreset()
        ->select('name')
        ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_units')
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
if ($mod == 'products_project_list') {
    $q = $nv_Request->get_title('q', 'post, get', '');
    $customerid = $nv_Request->get_int('customerid', 'post, get', 0);
    $projectid = $nv_Request->get_int('projectid', 'post, get', 0);
	$where = 'customerid = '. $customerid;
	$array_data = array();
	if($customerid){
		if($q!='') $where = ' AND (title LIKE :q_title ) ';
		
	    $db->sqlreset()
	        ->select('projectid, title')
	        ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_project')
	        ->where($where)
	        ->order('projectid ASC');
	
	    $sth = $db->prepare($db->sql());
		if($q!='') $sth->bindValue(':q_title', '%' . $q . '%', PDO::PARAM_STR);
	    $sth->execute();
	
	    
	    while (list ($id, $title) = $sth->fetch(3)) {
	        $array_data[] = array(
	            'id' => $id,
	            'title' => $title,
	            'name' => $title,
	            'text' => $title,
	            'unit_name' => $unit_name,
	            'unit_id' => $purchase_unit,
	            'customerid' => $customerid,
	            'projectid' => $projectid
	        );
	    }
	}
    nv_jsonOutput($array_data);
}
if ($mod == 'products_material_list') {
    $q = $nv_Request->get_title('q', 'post, get', '');
    $pro_sh_id = $nv_Request->get_int('pro_sh_id', 'post, get', 0);
    $id_product_select = $nv_Request->get_int('id_product_select', 'post, get', 0);
	
	$no_pro = $nv_Request->get_array('no_pro', 'post, get', array());
	if($q!='') $where = '(code LIKE :q_code OR name LIKE :q_title ) AND type = "material" ';
	else $where = ' type = "material" ';
	//print_r($no_pro);die;
	if($no_pro != array()){
		$list_no_pro = implode(',', $no_pro);
		$where .= ' AND id NOT IN (' . $list_no_pro . ')';
	}
	if($id_product_select > 0){
		//$where = ' AND p.id =' . $id_product_select;
	}
    $db->sqlreset()
        ->select('id, code, name, quantity, purchase_unit')
        ->from($db_config['dbsystem'] . '.' . NV_TABLE_SHOPS . '_rows')
        ->where($where)
        ->order('id ASC');

    $sth = $db->prepare($db->sql());
	if($q!='') $sth->bindValue(':q_title', '%' . $q . '%', PDO::PARAM_STR);
	if($q!='') $sth->bindValue(':q_code', '%' . $q . '%', PDO::PARAM_STR);
    $sth->execute();

    $array_data = array();
    while (list ($id, $code, $name, $quantity, $purchase_unit) = $sth->fetch(3)) {
    	$db->sqlreset()
        ->select('name')
        ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_units')
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
if ($mod == 'products_purchases_list') {
    $q = $nv_Request->get_title('q', 'post, get', '');
    $pro_sh_id = $nv_Request->get_int('pro_sh_id', 'post, get', 0);
    $id_product_select = $nv_Request->get_int('id_product_select', 'post, get', 0);
	$no_pro = $nv_Request->get_array('no_pro', 'post, get', array());
	//print_r($no_pro);die;
	$where = '1 ';
	if($no_pro != array()){
		$list_no_pro = implode(',', $no_pro);
		$where .= ' AND p.id NOT IN (' . $list_no_pro . ')';
	}
	if($id_product_select > 0){
		//$where = ' AND p.id =' . $id_product_select;
	}
	if($q!='') $where .= ' AND (p.' . NV_LANG_DATA .'_title like ":q_title" OR p.product_code like ":q_code") ';
    $db->sqlreset()
        ->select('p.id, p.product_code, p.' . NV_LANG_DATA .'_title name, p.product_number quantity, p.purchase_unit, p.cost, p.price_config, p.product_price')
        ->from($db_config['dbsystem'] . '.' . NV_TABLE_SHOPS . '_rows p');
	    $db->where($where); 
		$db->group('p.id')
        ->order('p.id ASC');
    $sth = $db->prepare($db->sql());
	if($q!='') $sth->bindValue(':q_title', '%' . $q . '%', PDO::PARAM_STR);
	if($q!='') $sth->bindValue(':q_code', '%' . $q . '%', PDO::PARAM_STR);
    $sth->execute();
	
    $array_data = array();
    while (list ($id, $code, $name, $quantity, $purchase_unit, $cost, $price_config, $product_price) = $sth->fetch(3)) {
    	$db->sqlreset()
        ->select('name')
        ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_units')
        ->where('id = ' . $purchase_unit);
		$sth1 = $db->prepare($db->sql());
	    $sth1->execute();
		list ($unit_name) = $sth1->fetch(3);
		if($global_config['idsite'] == 0 && $cost > 0)
			$price = $cost;
		else
			$price = $product_price;
		$price_cost = unserialize($price_config);
         if (!empty($price_cost)) {
            foreach ($price_cost as $_p) {
				if (!empty($user_info)) {
					if ($user_info['affiliate_groups']->group_id == $_p['number_to']) {
						$price = $_p['price'] * (!$per_pro ? $number : 1);
						break;
					}
				}
            }
        }
        $array_data[] = array(
            'id' => $id,
            'title' => $code,
            'name' => $name,
            'cost' => storehouse_number_format($price,0,'',''),
            'unit_name' => $unit_name,
            'unit_id' => $purchase_unit,
            'pro_sh_id' => $pro_sh_id,
            'id_product_select' => $id_product_select
        );
    }

    nv_jsonOutput($array_data);
}
if ($mod == 'products_transfer_list') {
    $q = $nv_Request->get_title('q', 'post, get', '');
    $pro_sh_id = $nv_Request->get_int('pro_sh_id', 'post, get', 0);
    $id_product_select = $nv_Request->get_int('id_product_select', 'post, get', 0);
	$no_pro = $nv_Request->get_array('no_pro', 'post, get', array());
	//print_r($no_pro);die;
	if($no_pro != array()){
		$list_no_pro = implode(',', $no_pro);
		$where .= ' AND p.id NOT IN (' . $list_no_pro . ')';
	}
	if($id_product_select > 0){
		//$where = ' AND p.id =' . $id_product_select;
	}
	if($q!='') $where .= 'AND p.name like ":q_title"';
    $db->sqlreset()
        ->select('p.id, p.product_code code, p.' . NV_LANG_DATA .'_title name, p.product_number quantity, p.purchase_unit, p.cost, p.price_config, p.product_price')
        ->from($db_config['dbsystem'] . '.' . NV_TABLE_SHOPS . '_rows p');
		/* ->join('LEFT JOIN ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_product_of_category poc ON p.id=poc.product_id');
		if($_SESSION[$module_data . '_store_id']>0) 
	    	$db->where('poc.category_id IN(' . implode(",", $array_category_of_store) . ') ' . $where); */
		$db->group('p.id')
        ->order('p.id ASC');
    $sth = $db->prepare($db->sql());
	if($q!='') $sth->bindValue(':q_title', '%' . $q . '%', PDO::PARAM_STR);
	//if($q!='') $sth->bindValue(':q_code', '%' . $q . '%', PDO::PARAM_STR);
    $sth->execute();
	
    $array_data = array();
    while (list ($id, $code, $name, $quantity, $purchase_unit, $cost, $price_config, $product_price) = $sth->fetch(3)) {
    	$db->sqlreset()
        ->select('name')
        ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_units')
        ->where('id = ' . $purchase_unit);
		$sth1 = $db->prepare($db->sql());
	    $sth1->execute();
		list ($unit_name) = $sth1->fetch(3);
		if($global_config['idsite'] == 0 && $cost > 0)
			$price = $cost;
		else
			$price = $product_price;
		$price_cost = unserialize($price_config);
         if (!empty($price_cost)) {
            foreach ($price_cost as $_p) {
				if (!empty($user_info)) {
					if ($user_info['affiliate_groups']->group_id == $_p['number_to']) {
						$price = $_p['price'] * (!$per_pro ? $number : 1);
						break;
					}
				}
            }
        }
        $array_data[] = array(
            'id' => $id,
            'title' => $code,
            'name' => $name,
            'cost' => storehouse_number_format($price,0,'',''),
            'unit_name' => $unit_name,
            'unit_id' => $purchase_unit,
            'pro_sh_id' => $pro_sh_id,
            'id_product_select' => $id_product_select
        );
    }

    nv_jsonOutput($array_data);
}
if ($mod == 'products_of_warehouse') {
    $pro_sh_id = $nv_Request->get_int('pro_sh_id', 'post, get', 0);
    $wh_sh_id = $nv_Request->get_int('wh_sh_id', 'post, get', 0);
	$db->sqlreset()
        ->select('quantity')
		->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_warehouses_products')
		->where('product_id = '. $pro_sh_id . ' AND warehouse_id = ' . $wh_sh_id);
	$quantity = $db->query($db->sql())
		->fetch(5)
		->quantity;
	if($quantity == 0) $lang_status = $lang_module['no_quantity']; else $lang_status = "";
	$array_data = array(
            'id' => $pro_sh_id,
            'wh' => $wh_sh_id,
            'quantity' => storehouse_number_format($quantity,0,'',''),
            'status_error' => $lang_status
        );
    nv_jsonOutput($array_data);
}
if ($mod == 'products_sales_list') {
    $q = $nv_Request->get_title('q', 'post, get', '');
    $pro_sh_id = $nv_Request->get_int('pro_sh_id', 'post, get', 0);
    $id_product_select = $nv_Request->get_int('id_product_select', 'post, get', 0);
	$no_pro = $nv_Request->get_array('no_pro', 'post, get', array());
	//print_r($no_pro);die;
	$where = '';
	if($no_pro != array()){
		$list_no_pro = implode(',', $no_pro);
		$where .= ' AND p.id NOT IN (' . $list_no_pro . ')';
	}
	if($id_product_select > 0){
		//$where = ' AND p.id =' . $id_product_select;
	}
	if($q!='') $where .= ' AND p.product_code like "%' . $q . '%" ';
    $db->sqlreset()
        ->select('p.id, p.product_code code, p.' . NV_LANG_DATA . '_title name, p.product_number quantity, p.sale_unit, p.price_config, p.product_price')
        ->from($db_config['dbsystem'] . '.' . NV_TABLE_SHOPS . '_rows p');
		/* ->join('LEFT JOIN ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_product_of_category poc ON p.id=poc.product_id');
		if($_SESSION[$module_data . '_store_id']>0 && !empty($array_category_of_store))
			$where .= ' AND poc.category_id IN(' . implode(",", $array_category_of_store) . ')'; */
	    $db->where('p.type !=0 '. $where);
		/* $db->group('p.id') */
        $db->order('p.id ASC');
	/* print_r($db->sql());die;  */
    $sth = $db->prepare($db->sql());
    $sth->execute();
    $array_data = array();
    while (list ($id, $code, $name, $quantity, $sale_unit, $price_config, $price) = $sth->fetch(3)) {
    	$db->sqlreset()
        ->select('name')
        ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_units')
        ->where('id = ' . $sale_unit);
		$sth1 = $db->prepare($db->sql());
	    $sth1->execute();
		list ($unit_name) = $sth1->fetch(3);
        $array_data[] = array(
            'id' => $id,
            'title' => $code,
            'name' => $name,
            'price' => storehouse_number_format($price,0,'',''),
            'unit_name' => $unit_name,
            'unit_sales_id' => $sale_unit,
            'pro_sh_id' => $pro_sh_id,
            'id_product_select' => $id_product_select
        );
    }

    nv_jsonOutput($array_data);
}
if ($mod == 'products_items') {

    $db->sqlreset()
        ->select(' code, name, cost, tax_method, tax_rate, purchase_unit')
        ->from($db_config['dbsystem'] . '.' . NV_TABLE_SHOPS . '_rows')
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
    $_SESSION[$module_data . '_store_warehouse_id'] = 0;
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
	$product_detail = $pos->getProductDataByCode($code,$warehouse_id,$customer_id);
    die($product_detail);
}
if ($mod == 'sales_suggestions') {
	$term= $nv_Request->get_title('term', 'get', '');
	$warehouse_id = $nv_Request->get_int('warehouse_id', 'get', 0);
	$customer_id = $nv_Request->get_int('customer_id', 'get', 0);

	$product_detail = $sales->suggestions($term,$warehouse_id,$customer_id);
    die($product_detail);
}
if ($mod == 'customers_suggestions') {
	
	$term= $nv_Request->get_title('term', 'get', '');
	if($term != ''){
		$rows =array();
		$db->select("id, (CASE WHEN company = '-' THEN name ELSE CONCAT(company, '') END) as text, (CASE WHEN company = '-' THEN name ELSE CONCAT(company, '') END) as value, phone")
		->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies')
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
if ($mod == 'customers_getCustomer') {
	$customer_id = $nv_Request->get_int('customer_id', 'get', 0);
	$customers = array();
	$db->sqlreset()
            ->select("id,name,company")
            ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies')
            ->where(' id = ' . $customer_id);
	$q = $db->query($db->sql());
	if($q->rowCount()>0){
		foreach ($q->fetchAll() as $row)
		{
			$customer = array();
			$customer['id'] = $row['id'];
			if($row['company']=='')
				$customer['text'] = $row['name'];
			else
				$customer['text'] = $row['company'];
			$customers[] = $customer;
		}
			
	}
    nv_jsonOutput($customers);
}
if ($mod == 'pos_ajaxcategorydata') {
	$category_id = $nv_Request->get_title('category_id', 'get', '');
	$pos = new NukeViet\StoreHouse\Pos;
	$product_cat = $pos->ajaxcategorydata($category_id);
    die($product_cat);
}
if ($mod == 'pos_ajaxsecondcategorydata') {
	$category_id = $nv_Request->get_title('category_id', 'get', '');
	$pos = new NukeViet\StoreHouse\Pos;
	$product_cat = $pos->ajaxsecondcategorydata($category_id);
    die($product_cat);
}
if ($mod == 'sales_sell_gift_card') {
	$product_cat = $sales->sell_gift_card();
    die($product_cat);
}
if ($mod == 'customers_view') {
	$customer_id = $nv_Request->get_int('customer_id', 'get', 0);
	if($customer_id > 0){
		$customer = array();
		$db->sqlreset()
	            ->select("*")
	            ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies')
	            ->where(' id = ' . $customer_id);
		$q = $db->query($db->sql())->fetch();
		$customer = $q;
		if($q['company']=='')
			$customer['text'] = $q['name'];
		else
			$customer['text'] = $q['company'];
			
		$xtpl = new XTemplate('ajax_customer_view.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
		$xtpl->assign('ROW', $customer);
	    $xtpl->parse('main');
		$contents = $xtpl->text('main');
		//print_r(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		include NV_ROOTDIR . '/includes/header.php';
		echo $contents;
		include NV_ROOTDIR . '/includes/footer.php';
		die;
	}
		
}
if ($mod == 'customers_edit') {
	$customer_id = $nv_Request->get_int('customer_id', 'get', 0);
	if($customer_id > 0){
		$customer = array();
		$db->sqlreset()
	            ->select("*")
	            ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies')
	            ->where(' id = ' . $customer_id);
		$q = $db->query($db->sql())->fetch();
		$customer = $q;
		if($q['company']=='')
			$customer['text'] = $q['name'];
		else
			$customer['text'] = $q['company'];
			
		$xtpl = new XTemplate('ajax_customer_edit.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
		$xtpl->assign('ROW', $customer);
	    $xtpl->parse('main');
		$contents = $xtpl->text('main');
		//print_r(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		include NV_ROOTDIR . '/includes/header.php';
		echo $contents;
		include NV_ROOTDIR . '/includes/footer.php';
		die;
	}
		
}
if ($mod == 'customers_save') {
	$customer_id = $nv_Request->get_int('edcustomer_id', 'get', 0);
	$data_save=array();
	$data_save['result'] = 'success';
	$data_save['message'] = 'Cập nhật thành công.';
	nv_jsonOutput($data_save);
}
if ($mod == 'unit_list') {
	$base_unit = $nv_Request->get_title('unit_id', 'get', '');
	$db->sqlreset()
            ->select("id, code, name ")
            ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_units')
            ->where(' base_unit = ' . $base_unit . ' or id = ' . $base_unit);
	$q = $db->query($db->sql());
	if($q->rowCount()>0){
		$unit = array();
	    while (list ($id, $code, $name) = $q->fetch(3)) {
	        $unit[] = array(
	            'id' => $id,
	            'code' => $code,
	            'title' => $name
	        );
	    }
			
	}
    nv_jsonOutput($unit);
}
if ($mod == 'report_warehouse_chart') {
	$w_id= $nv_Request->get_int('w_id', 'get', 0);
    $_SESSION[$module_data . '_store_warehouse_id'] = $w_id;
	$array_data = array(
            'session_store_warehouse_id' => $w_id
        );
    nv_jsonOutput($array_data);
		
}

if ($mod == 'reports_getPurchasesReport') {
	$list=$report->getPurchasesReport();
	//nv_jsonOutput($content);
	$supplier_id = $nv_Request->get_int('supplier', 'get', 0);
	$supplier = array();
	$db->sqlreset()
            ->select("id,name,company")
            ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies')
            ->where(' id = ' . $supplier_id);
	$q = $db->query($db->sql());
	if($q->rowCount()>0){
		$supplier = $q->fetch();
			
	}
	foreach($list as $l){
		if($supplier['company'] == '' ){
			$supplier['company']  = $supplier['name'] ;
		}
		$db->sqlreset()
            ->select("id,name,company")
            ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies')
            ->where(' id = ' . $l['warehouse_id']);
		$q = $db->query($db->sql());
		if($q->rowCount()>0){
			$customer = $q->fetch();
			if($customer['company'] == '' ){
				$customer['company']  = $customer['name'] ;
			}	
		}
		$l['status'] =  $array_status[$l['status']]; 
        $l['grand_total'] = storehouse_number_format($l['grand_total'],0);
        $l['paid'] = storehouse_number_format($l['paid'],0);
		
		$content['data'][] = array($l['date'],$l['reference_no'],$customer['company'],$supplier['company'],$l['iname'],$l['grand_total'],$l['paid'],$l['status']);
	}
	die(json_encode($content));
}
if ($mod == 'reports_getSalesReport') {
	$list=$report->getSalesReport();
	//nv_jsonOutput($content);
	$customer_id = $nv_Request->get_int('customer', 'get', 0);
	$customer = array();
	$db->sqlreset()
            ->select("id,name,company")
            ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies')
            ->where(' id = ' . $customer_id);
	$q = $db->query($db->sql());
	if($q->rowCount()>0){
		$customer = $q->fetch();
			
	}
	foreach($list as $l){
		if($customer['company'] == '' ){
			$customer['company']  = $customer['name'] ;
		}
		$db->sqlreset()
            ->select("id,name,company")
            ->from($db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies')
            ->where(' id = ' . $l['warehouse_id']);
		$q = $db->query($db->sql());
		if($q->rowCount()>0){
			$customer = $q->fetch();
			if($customer['company'] == '' ){
				$customer['company']  = $customer['name'] ;
			}	
		}
		$l['status'] =  $array_status[$l['status']]; 
        $l['grand_total'] = storehouse_number_format($l['grand_total'],0);
        $l['paid'] = storehouse_number_format($l['paid'],0);
		
		$content['data'][] = array($l['date'],$l['reference_no'],$customer['company'],$customer['company'],$l['iname'],$l['grand_total'],$l['paid'],$l['status']);
	}
	die(json_encode($content));
}
if ($mod == 'AddPaymentPurchases') {
	$p_id= $nv_Request->get_int('purchasesid', 'get', 0);
	$content = $purchases->add_payment($p_id);	
}
if ($mod == 'AddPaymentSales') {
	$p_id= $nv_Request->get_int('salesid', 'get', 0);
	$content = $sales->add_payment($p_id);	
}

if ($mod == 'load_secondcatid') {
	$secondcat_id= $nv_Request->get_string('secondcatid', 'get', 0);
	$secondcat_sub_id= $nv_Request->get_string('secondcat_id', 'get', 0);
	$array_secondcatid = explode(",", $secondcat_sub_id);
	if($subcat_id != "")
		$list_cat=$db->query('SELECT id,code,name FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_subcategories WHERE parent_id IN (' . $secondcat_id . ')')->fetchAll(5);
	else
		$list_cat=$db->query('SELECT id,code,name FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_subcategories WHERE parent_id !=0')->fetchAll(5);
	$xtpl = new XTemplate('categories.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
		foreach ($list_cat as $rows_i) {
		    $sl = in_array($rows_i->id,$array_secondcatid) ? " selected=\"selected\"" : "";
		    $xtpl->assign('pcatid_i', $rows_i->id);
		    $xtpl->assign('ptitle_i', $rows_i->name);
		    $xtpl->assign('pselect', $sl);
		    $xtpl->parse('list_subcat.subcat');
		}
	    $xtpl->parse('list_subcat');
		$contents = $xtpl->text('list_subcat');
		//print_r(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		include NV_ROOTDIR . '/includes/header.php';
		echo $contents;
		include NV_ROOTDIR . '/includes/footer.php';
		die;	
}
if ($mod == 'list_user') {
	$u_groups= $nv_Request->get_int('groups', 'get', 0);
	$sql=$db->query("SELECT * FROM " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . "_users u LEFT JOIN " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_groups_user gu on u.userid = gu.userid WHERE u.username LIKE '%".$_GET['q']."%' AND gu.group_id = " . $u_groups . " ORDER BY u.username ASC");
	$json=array();
	foreach($sql as $value){
		$json[] = ['id'=>$value['userid'], 'text'=>$value['username']];	
	}
	echo json_encode($json);
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
				if(($groups==1 || $groups==5) AND $value['status'] == 0 ){
					$process=true;
					$action = '1';
				}elseif(($groups==1 || $groups==24) AND $value['status'] == 1){
					$checkproduct=true;
					$action = '2';
				}elseif(($groups==1 || $groups==24) AND $value['status'] == 2){
					$checkproductsu=true;
					$action = '3';
				}else{
					$process=false;
				}
				$content = ['id'=>$value['id'], 'projectid'=>$projectid , 'saleid'=>$saleid , 'projectname'=>$value['title'], 'day_start'=> date('d/m/Y',$value['timestart']), 'day_end'=>date('d/m/Y',$value['timeend']), 'employees' => implode(',', $list_employer), 'employeesid' => $value['userid'], 'status' => $global_array_status_pro_sche[$value['status']], 'process' => $process, 'checkpro' => $checkproduct, 'checkprosu' => $checkproductsu, 'action' => $action];	
			}
		}
		
		
	}
	if(!empty($content))
		$json = ['status' => "OKE", 'content'=> $content];
	else
		$json = ['status' => "NO", 'content'=> $content];
	echo json_encode($json);die;
}

if ($mod == 'add_pro_sche') {
	$projectid = $nv_Request->get_string('projectid', 'post', 0);
	$saleid = $nv_Request->get_string('saleid', 'post', 0);
	$daystart = $nv_Request->get_string('daystart', 'post', 0);
	if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $daystart, $m)) {
        $ehour = $nv_Request->get_int('ehour', 'post', 0);
        $emin = $nv_Request->get_int('emin', 'post', 0);
        $daystart = mktime($ehour, $emin, 0, $m[2], $m[1], $m[3]);
    } else {
        $daystart = 0;
    }
	$dayend = $nv_Request->get_string('dayend', 'post', 0);
	if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $dayend, $m)) {
        $ehour = $nv_Request->get_int('ehour', 'post', 0);
        $emin = $nv_Request->get_int('emin', 'post', 0);
        $dayend = mktime($ehour, $emin, 0, $m[2], $m[1], $m[3]);
    } else {
        $dayend = 0;
    }
	$users= $nv_Request->get_typed_array( 'users', 'post', 'array', array() );
	foreach($users as $ku=>$user){
		$l_u[] = $user[0];
	}
	
	$list_user = implode(',', $l_u);
	//print_r($list_user);die;
	$error = array();
	if(empty($projectid)){
		$error[] =$lang_module['no_project'];
	}
	if(empty($users)){
		$error[] =$lang_module['no_staff'];
	}
	$_sql = 'INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_production_plan (projectid,saleid, timestart,timeend,userid,status) VALUE (:projectid, :saleid, :daystart, :dayend, :userid, 0)';
		$data_insert = array();
	    $data_insert['projectid'] = $projectid;
	    $data_insert['saleid'] = $saleid;
	    $data_insert['daystart'] = $daystart;
	    $data_insert['dayend'] = $dayend;
	    $data_insert['userid'] = $list_user;
	
	    $ok = $db->insert_id($_sql, 'id', $data_insert);
		if($ok){
			foreach($l_u as $user){
				$_sql = 'INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_production_plan_user (projectid,saleid, planid,userid) VALUE (:projectid, :saleid, :planid, :userid)';
				$data_insert = array();
			    $data_insert['projectid'] = $projectid;
			    $data_insert['saleid'] = $saleid;
			    $data_insert['planid'] = $ok;
			    $data_insert['userid'] = $user;
			
			    $oks = $db->insert_id($_sql, 'id', $data_insert);
			}
			
		}else{
			$error[] = $lang_module['insert_pro_sche_error'];
		}
	
	if(empty($error)){
		log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'add_pro_sche', $lang_module['insert_pro_sche_success'] , $admin_info['userid'], 0);
		$json=array("status" => "OKE", "text" => $lang_module['insert_pro_sche_success'], "project"=>$projectid, "sale"=>$saleid);
	}else{
		$json=array("status" => "NO", "text" => implode(',',$error), "project"=>$projectid, "sale"=>$saleid);
	}
	echo json_encode($json);
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
			log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'process_pro_sche', $lang_module['pro_sche_status_1'] , $admin_info['userid'], $status);
		}elseif($status == 2){
			log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'process_pro_sche_success', $lang_module['pro_sche_status_2'] , $admin_info['userid'], $status);
		}elseif($status == 3){
			log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'check_pro_sche_success', $lang_module['pro_sche_status_3'] , $admin_info['userid'], $status);
		}elseif($status == 4){
			log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'add_vehicle', $lang_module['pro_sche_status_4'] , $admin_info['userid'], $status);
		}   
		
		$json=array("status" => "OKE", "text" => $lang_module['process_pro_sche_success'], "project"=>$projectid, "sale"=>$saleid);
	}else{
		$json=array("status" => "NO", "text" => implode('|',$error), "project"=>$projectid, "sale"=>$saleid);
	}
	echo json_encode($json);
}
if ($mod == 'tran_pro_sche') {
	$projectid = $nv_Request->get_string('projectid', 'post', 0);
	$saleid = $nv_Request->get_string('saleid', 'post', 0);
	$planid = $nv_Request->get_string('id', 'post', 0);
	$users= $nv_Request->get_typed_array( 'tran_users', 'post', 'array', array() );
	foreach($users as $ku=>$user){
		$l_u[] = $user[0];
	}
	
	$list_user = implode(',', $l_u);
	$error = array();
	if(empty($projectid)){
		$error[] =$lang_module['no_project'];
	}
	$_sql = 'INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle (projectid,saleid, timedelivery, listuser,status) VALUE (:projectid, :saleid, ' . NV_CURRENTTIME . ', :userid, 1)';
		$data_insert = array();
	    $data_insert['projectid'] = $projectid;
	    $data_insert['saleid'] = $saleid;
	    $data_insert['userid'] = $list_user;
	
	    $ok = $db->insert_id($_sql, 'id', $data_insert);
		if($ok){
			$db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_production_plan SET status=4 WHERE saleid = ' . $saleid . ' AND projectid = '. $projectid);
			$db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_sales SET sale_status=4 WHERE id = ' . $saleid . ' AND projectid = '. $projectid);
			foreach($l_u as $user){
				$vehicle_user_quantity = $nv_Request->get_int( 'vehicle_user_'.$user, 'post', 0);
				$_sql = 'INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle_user (projectid, saleid,  vehicleid, userid, quantity) VALUE (:projectid, :saleid, :vehicleid, :userid, :quantity)';
				$data_insert = array();
			    $data_insert['projectid'] = $projectid;
			    $data_insert['saleid'] = $saleid;
			    $data_insert['vehicleid'] = $ok;
			    $data_insert['userid'] = $user;
			    $data_insert['quantity'] = $vehicle_user_quantity;
			
			    $oks = $db->insert_id($_sql, 'id', $data_insert);
			}
			
		}else{
			$error[] = $lang_module['insert_vehicle_error'];
		}
	
	if(empty($error)){
		log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'tran_pro_sche', $lang_module['insert_vehicle_success'] , $admin_info['userid'], 4);
		$json=array("status" => "OKE", "text" => $lang_module['insert_vehicle_success'], "project"=>$projectid, "sale"=>$saleid);
	}else{
		$json=array("status" => "NO", "text" => implode(',',$error), "project"=>$projectid, "sale"=>$saleid);
	}
	echo json_encode($json);
}
if ($mod == 'log_vehicle') {
	$projectid = $nv_Request->get_string('projectid', 'get', 0);
	$saleid = $nv_Request->get_string('saleid', 'get', 0);
	$sql=$db->query("SELECT * FROM " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_vehicle v LEFT JOIN " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_project p ON v.projectid = p.projectid WHERE v.saleid = " . $saleid . " AND v.projectid = " . $projectid);
	$sql_user=$db->query("SELECT * FROM " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . "_users u LEFT JOIN " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_groups_user gu on u.userid = gu.userid WHERE  gu.group_id = 23 ORDER BY u.username ASC");
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
				if(($groups==1 || $groups==23) AND $value['status'] == 1 ){
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
				$content = ['id'=>$value['id'], 'projectid'=>$projectid , 'saleid'=>$saleid , 'projectname'=>$value['title'], 'day_start'=> date('d/m/Y',$value['timedelivery']), 'day_end'=>$timereceipt, 'employees' => implode(',', $list_employer), 'employeesid' => $value['userid'], 'status' => $global_array_status_vehicle[$value['status']], 'process' => $process, 'checkpro' => $checkproduct, 'checkprosu' => $checkproductsu, 'action' => $action];	
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
	$error = array();
	if($process == true && $status !=2)
		$error[] = $lang_module['process_vehicle_error_status'];
	if(empty($projectid)){
		$error[] =$lang_module['no_project'];
	}
	if($process||$checkpro||$checkprosu){
		$ok = $db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_vehicle SET status=' . $status . ', timereceipt=' . NV_CURRENTTIME . ' WHERE id = ' . $vehicleid . ' AND projectid = '. $projectid);
		$ok2 = $db->query('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_sales SET sale_status=5 WHERE id = ' . $saleid . ' AND projectid = '. $projectid);
		if($ok==0 ){
			$error[] = $lang_module['process_vehicle_error'];
		}
		if($ok2==0 ){
			$error[] = $lang_module['process_vehicle_error'];
		}
		
	}
	if(empty($error)){ 
		log_project(NV_LANG_DATA, $module_data, $projectid, $saleid, 'process_vehicle', $lang_module['process_vehicle_success'] , $admin_info['userid'], $status);
		$json=array("status" => "OKE", "text" => $lang_module['process_vehicle_success'], "project"=>$projectid, "sale"=>$saleid);
	}else{
		$json=array("status" => "NO", "text" => implode('|',$error), "project"=>$projectid, "sale"=>$saleid);
	}
	echo json_encode($json);
}
if ($mod == 'customer_add') {
	$xtpl = new XTemplate('customers.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
		foreach ($list_cat as $rows_i) {
		    $sl = in_array($rows_i->id,$array_secondcatid) ? " selected=\"selected\"" : "";
		    $xtpl->assign('pcatid_i', $rows_i->id);
		    $xtpl->assign('ptitle_i', $rows_i->name);
		    $xtpl->assign('pselect', $sl);
		    $xtpl->parse('customer_add.subcat');
		}
	    $xtpl->parse('customer_add');
		$contents = $xtpl->text('customer_add');
		//print_r(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		include NV_ROOTDIR . '/includes/header.php';
		echo $contents;
		include NV_ROOTDIR . '/includes/footer.php';
		die;	
}
if ($mod == 'list_user') {
	$u_groups= $nv_Request->get_int('groups', 'get', 0);
	$sql=$db->query("SELECT * FROM " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . "_users u LEFT JOIN " . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . "_groups_user gu on u.userid = gu.userid WHERE u.username LIKE '%".$_GET['q']."%' AND gu.group_id = " . $u_groups . " ORDER BY u.username ASC");
	$json=array();
	foreach($sql as $value){
		$json[] = ['id'=>$value['userid'], 'text'=>$value['username']];	
	}
	echo json_encode($json);
}
if ($mod == 'customer_add') {
	$xtpl = new XTemplate('customers.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
		foreach ($list_cat as $rows_i) {
		    $sl = in_array($rows_i->id,$array_secondcatid) ? " selected=\"selected\"" : "";
		    $xtpl->assign('pcatid_i', $rows_i->id);
		    $xtpl->assign('ptitle_i', $rows_i->name);
		    $xtpl->assign('pselect', $sl);
		    $xtpl->parse('customer_add.subcat');
		}
	    $xtpl->parse('customer_add');
		$contents = $xtpl->text('customer_add');
		//print_r(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
		include NV_ROOTDIR . '/includes/header.php';
		echo $contents;
		include NV_ROOTDIR . '/includes/footer.php';
		die;	
}
if ($mod == 'customers_add_save') {
	$row = array();
	$error = array();
    $row['customer_group_id'] = $nv_Request->get_int('customer_group', 'post', 0);
    $row['customer_group_name'] = $nv_Request->get_title('customer_group_name', 'post', '');
    $row['name'] = $nv_Request->get_title('name', 'post', '');
    $row['company'] = $nv_Request->get_title('company', 'post', '');
    $row['vat_no'] = $nv_Request->get_title('vat_no', 'post', '');
    $row['address'] = $nv_Request->get_title('address', 'post', '');
    $row['city'] = $nv_Request->get_title('city', 'post', '');
    $row['state'] = $nv_Request->get_title('state', 'post', '');
    $row['postal_code'] = $nv_Request->get_title('postal_code', 'post', '');
    $row['country'] = $nv_Request->get_title('country', 'post', '');
    $row['phone'] = $nv_Request->get_title('phone', 'post', '');
    $row['email'] = $nv_Request->get_title('email', 'post', '');
    $row['invoice_footer'] = $nv_Request->get_textarea('invoice_footer', '', NV_ALLOWED_HTML_TAGS);
    $row['logo'] = $nv_Request->get_title('logo', 'post', '');
    $row['price_group_id'] = $nv_Request->get_int('price_group_id', 'post', 0);
    $row['price_group_name'] = $nv_Request->get_title('price_group_name', 'post', '');
    $row['gst_no'] = $nv_Request->get_title('gst_no', 'post', '');

    if (empty($row['company'])) {
        $error[] = $lang_module['error_required_company'];
    } elseif (empty($row['address'])) {
        $error[] = $lang_module['error_required_address'];
    } elseif (empty($row['city'])) {
        $error[] = $lang_module['error_required_city'];
    } elseif (empty($row['state'])) {
        $error[] = $lang_module['error_required_state'];
    } elseif (empty($row['country'])) {
        $error[] = $lang_module['error_required_country'];
    } elseif (empty($row['phone'])) {
        $error[] = $lang_module['error_required_phone'];
    } elseif (empty($row['email'])) {
        $error[] = $lang_module['error_required_email'];
    }
	$data_save=array();
    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                $row['group_id'] = 1;
                $row['group_name'] = 'customer';
                $row['cf1'] = '';
                $row['cf2'] = '';
                $row['cf3'] = '';
                $row['cf4'] = '';
                $row['cf5'] = '';
                $row['cf6'] = '';
                $row['payment_term'] = 0;
                $row['award_points'] = 0;
                $row['deposit_amount'] = '';

                $stmt = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_companies (group_id, group_name, customer_group_id, customer_group_name, name, company, vat_no, address, city, state, postal_code, country, phone, email, cf1, cf2, cf3, cf4, cf5, cf6, invoice_footer, payment_term, logo, award_points, deposit_amount, price_group_id, price_group_name, gst_no) VALUES (:group_id, :group_name, :customer_group_id, :customer_group_name, :name, :company, :vat_no, :address, :city, :state, :postal_code, :country, :phone, :email, :cf1, :cf2, :cf3, :cf4, :cf5, :cf6, :invoice_footer, :payment_term, :logo, :award_points, :deposit_amount, :price_group_id, :price_group_name, :gst_no)');

                $stmt->bindParam(':group_id', $row['group_id'], PDO::PARAM_INT);
                $stmt->bindParam(':group_name', $row['group_name'], PDO::PARAM_STR);
                $stmt->bindParam(':cf1', $row['cf1'], PDO::PARAM_STR);
                $stmt->bindParam(':cf2', $row['cf2'], PDO::PARAM_STR);
                $stmt->bindParam(':cf3', $row['cf3'], PDO::PARAM_STR);
                $stmt->bindParam(':cf4', $row['cf4'], PDO::PARAM_STR);
                $stmt->bindParam(':cf5', $row['cf5'], PDO::PARAM_STR);
                $stmt->bindParam(':cf6', $row['cf6'], PDO::PARAM_STR);
                $stmt->bindParam(':payment_term', $row['payment_term'], PDO::PARAM_INT);
                $stmt->bindParam(':award_points', $row['award_points'], PDO::PARAM_INT);
                $stmt->bindParam(':deposit_amount', $row['deposit_amount'], PDO::PARAM_STR);

            }
            $stmt->bindParam(':customer_group_id', $row['customer_group_id'], PDO::PARAM_INT);
            $stmt->bindParam(':customer_group_name', $row['customer_group_name'], PDO::PARAM_STR);
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
            $stmt->bindParam(':invoice_footer', $row['invoice_footer'], PDO::PARAM_STR, strlen($row['invoice_footer']));
            $stmt->bindParam(':logo', $row['logo'], PDO::PARAM_STR);
            $stmt->bindParam(':price_group_id', $row['price_group_id'], PDO::PARAM_INT);
            $stmt->bindParam(':price_group_name', $row['price_group_name'], PDO::PARAM_STR);
            $stmt->bindParam(':gst_no', $row['gst_no'], PDO::PARAM_STR);

            $exc = $stmt->execute();
            if ($exc) {
            	$cusid=$db->lastInsertId();
                $nv_Cache->delMod($module_name);
                if (empty($row['id'])) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Customers', ' ', $admin_info['userid']);
					
					$data_save['result'] = 'success';
					$data_save['message'] = 'Thêm khách hàng thành công.';
					$data_save['id'] = $cusid;
                } 
            }
        } catch(PDOException $e) {
            trigger_error($e->getMessage());
			$data_save['result'] = 'error';
			$data_save['message'] = $e->getMessage();
			$data_save['id'] = 0;
        }
    }else{
		$data_save['result'] = 'error';
		$data_save['message'] = $error[0];
		$data_save['id'] = 0;
	}
	nv_jsonOutput($data_save);
}

include NV_ROOTDIR . '/includes/header.php';
echo $content;
include NV_ROOTDIR . '/includes/footer.php';

