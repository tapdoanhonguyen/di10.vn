<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Aug 2018 06:02:24 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
require NV_ROOTDIR . '/modules/' . $module_file . '/global.catalogy.php';
require NV_ROOTDIR . '/modules/' . $module_file . '/global.datadefault.php';
//define("NV_TABLE_SHOP_PRODUCT",$module_data . '_products');
define("NV_TABLE_SHOP_PRODUCT",$db_config['prefix'] . '_' . 'san_pham_rows');
define("NV_TABLE_SHOP_CAT",$db_config['prefix'] . '_' . 'san_pham_catalogs');
// Loại sản phẩm
$sql = 'SELECT catid, parentid, lev, ' . NV_LANG_DATA . '_title AS title, ' . NV_LANG_DATA . '_title_custom AS title_custom, ' . NV_LANG_DATA . '_alias AS alias, viewcat, numsubcat, subcatid, newday, typeprice, form, group_price, viewdescriptionhtml, numlinks, ' . NV_LANG_DATA . '_description AS description, ' . NV_LANG_DATA . '_descriptionhtml AS descriptionhtml, inhome, ' . NV_LANG_DATA . '_keywords AS keywords, ' . NV_LANG_DATA . '_tag_description AS tag_description, groups_view, cat_allow_point, cat_number_point, cat_number_product, image FROM ' . $db_config['dbsystem'] . '.' . NV_TABLE_SHOP_CAT . ' ORDER BY sort ASC';
$global_array_shops_cat = $nv_Cache->db($sql, 'catid', $module_name);
$products = new NukeViet\StoreHouse\Product;
// Change status
if ($nv_Request->isset_request('change_status', 'post, get')) {
    $id = $nv_Request->get_int('id', 'post, get', 0);
    $content = 'NO_' . $id;

    $query = 'SELECT hide FROM ' . $db_config['dbsystem'] . '.' . NV_TABLE_SHOP_PRODUCT . ' WHERE id=' . $id;
    $row = $db->query($query)->fetch();
    if (isset($row['hide']))     {
        $hide = ($row['hide']) ? 0 : 1;
        $query = 'UPDATE ' . $db_config['dbsystem'] . '.' . NV_TABLE_SHOP_PRODUCT . ' SET hide=' . intval($hide) . ' WHERE id=' . $id;
        $db->query($query);
        $content = 'OK_' . $id;
    }
    $nv_Cache->delMod($module_name);
    include NV_ROOTDIR . '/includes/header.php';
    echo $content;
    include NV_ROOTDIR . '/includes/footer.php';
}

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . NV_TABLE_SHOP_PRODUCT . '  WHERE id = ' . $db->quote($id));
        $nv_Cache->delMod($module_name);
        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Products_list', 'ID: ' . $id, $admin_info['userid']);
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
}

$row = array();
$error = array();

//print_r($array_category_of_store);

$q = $nv_Request->get_title('q', 'post,get');
//print_r($_SESSION[$module_data . '_store_id']);die;
// Fetch Limit
$show_view = false;

if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 100;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()
        ->select('COUNT(*)')
        ->from($db_config['dbsystem'] . '.' . '' . NV_TABLE_SHOP_PRODUCT .' p')
		->join('LEFT JOIN ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_san_pham_product_quantity pq ON p.id=pq.pid');
	/* if(IDSITE>0){
		if(IDSITE>0) 
	    	$db->where('poc.category_id IN(' . implode(",", $array_category_of_store) . ') AND pos.store_id = '. IDSITE);
	}else
		if($_SESSION[$module_data . '_store_id']>0) 
	    	$db->where('poc.category_id IN(' . implode(",", $array_category_of_store) . ') AND pos.store_id = ' . $_SESSION[$module_data . '_store_id']);
	$db->group('p.id'); */
	//print_r($db->sql());die;
    $sth = $db->prepare($db->sql());

    
    $sth->execute();
    $num_items = $sth->rowCount();

    $db->select('p.*, pq.quantity')
        ->order('p.id DESC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    $sth = $db->prepare($db->sql());

    
    $sth->execute();
}

$xtpl = new XTemplate('products_list.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
$xtpl->assign('ROW', $row);

$xtpl->assign('Q', $q);

if ($show_view) {
    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    if (!empty($q)) {
        $base_url .= '&q=' . $q;
    }
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
	//print_r($num_items);//die;
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.view.generate_page');
    }
    $number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
	
    while ($view = $sth->fetch()) {
    	//print_r($view);
        $view['number'] = $number++;
        $xtpl->assign('CHECK', $view['hide'] == 1 ? 'checked' : '');
        $view['unit'] = $array_unit_storehouse[$view['product_unit']][NV_LANG_DATA . '_title'];
		$view['category_id'] = '';
		$view['second_category_id'] = $global_array_shops_cat[$view['listcatid']]['title'];
		$view['name'] = $view[NV_LANG_DATA . '_title'];
		$view['code'] = $view['product_code'];
	
	
		/* $view['quantity'] = 0; */
		$quantity =0;
		foreach ($list_warehouse_of_store as $w_id=>$w){
			if($products->getProductQuantity($view['id'],$w->id) != FALSE){
				$quantity += $products->getProductQuantity($view['id'],$w->id)->quantity;
			}
			//print_r($permission->getProductQuantity($view['id'],$w_id)->quantity);
			
			
		}
		$view['quantity_balance'] = $quantity;
		$view['quantity_return'] = $db->query('SELECT sum(quantity- quantity_received) as quantity_return FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_purchase_items WHERE product_id =' . $view['id'] . ' AND puiidsite =' . $global_config['idsite'] )->fetch(5)->quantity_return;
		$view['quantity_export'] = $db->query('SELECT sum(si.quantity) as quantity_export FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_sale_items si LEFT JOIN ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_sales s ON si.sale_id = s.id WHERE si.product_id =' . $view['id'] . ' AND s.sale_status = "4"' . ' AND s.saidsite =' . $global_config['idsite'])->fetch(5)->quantity_export;
		
		$view['quantity'] = storehouse_number_format( $view['quantity'] ,0);
		$view['quantity_return'] = storehouse_number_format( $view['quantity_return'] ,0);
		$view['quantity_export'] = storehouse_number_format( $view['quantity_export'] ,0);
		$view['cost'] = ($global_config['idsite'] ==0) ? storehouse_number_format( $view['cost'] ,0) : 0;
		$view['price'] = storehouse_number_format( $view['product_price'] ,0);
		$view['alert_quantity'] = storehouse_number_format( $view['alert_quantity'] ,0);/* 
		if($view['warehouse'] != 0)
			$view['warehouse'] = $array_warehouse_storehouse[$view['warehouse']]['name'];
		else
			$view['warehouse'] = "";
		if($view['brand'] != 0)
			$view['brand'] = $array_brand_storehouse[$view['brand']]['name'];
		else
			$view['brand'] = ""; */
		$view['link_detail'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=products_detail&amp;id=' . $view['id'];
        $view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=products&amp;id=' . $view['id'];
        $view['link_print'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=products_print&amp;id=' . $view['id'];
        $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.view.loop');
    }//die;
    $xtpl->parse('main.view');
}


if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = '';

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
