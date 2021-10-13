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
// Change status
if ($nv_Request -> isset_request('change_status', 'post, get')) {
	$id = $nv_Request -> get_int('id', 'post, get', 0);
	$content = 'NO_' . $id;

	$query = 'SELECT hide FROM ' . $db_config['prefix'] . '_san_pham_rows WHERE id=' . $id;
	$row = $db -> query($query) -> fetch();
	if (isset($row['hide'])) {
		$hide = ($row['hide']) ? 0 : 1;
		$query = 'UPDATE ' . $db_config['prefix'] . '_san_pham_rows SET hide=' . intval($hide) . ' WHERE id=' . $id;
		$db -> query($query);
		$content = 'OK_' . $id;
	}
	$nv_Cache -> delMod($module_name);
	include NV_ROOTDIR . '/includes/header.php';
	echo $content;
	include NV_ROOTDIR . '/includes/footer.php';
}

if ($nv_Request -> isset_request('delete_id', 'get') and $nv_Request -> isset_request('delete_checkss', 'get')) {
	$id = $nv_Request -> get_int('delete_id', 'get');
	$delete_checkss = $nv_Request -> get_string('delete_checkss', 'get');
	if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
		$db -> query('DELETE FROM ' . $db_config['prefix'] . '_san_pham_rows  WHERE id = ' . $db -> quote($id));
		$nv_Cache -> delMod($module_name);
		nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Products_list', 'ID: ' . $id, $admin_info['userid']);
		nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	}
}

$row = array();
$error = array();

$id = $nv_Request -> get_title('id', 'post,get');

// Fetch Limit
$show_view = false;
if (!$nv_Request -> isset_request('id', 'post,get')) {
	$show_view = true;
	$per_page = 20;
	$page = $nv_Request -> get_int('page', 'post,get', 1);
	$db -> sqlreset() -> select('COUNT(*)') -> from('' . $db_config['prefix'] . '_san_pham_rows');

	if (!empty($id)) {
		$db -> where('id = ' . $id);
	}
	$sth = $db -> prepare($db -> sql());
	$sth -> execute();
	$num_items = $sth -> fetchColumn();

	$db -> select('*') -> order('id DESC') -> limit($per_page) -> offset(($page - 1) * $per_page);
	$sth = $db -> prepare($db -> sql());
	$sth -> execute();
} else {
	$db -> sqlreset() -> select('COUNT(*)') -> from('' . $db_config['prefix'] . '_san_pham_rows');

	if (!empty($id)) {
		$db -> where('id = ' . $id);
	}
	$sth = $db -> prepare($db -> sql());
	$sth -> execute();
	$num_items = $sth -> fetchColumn();

	$db -> select('*') -> order('id DESC');
	$sth = $db -> prepare($db -> sql());
	$sth -> execute();
	$row = $sth -> fetch();
}
$product = new NukeViet\StoreHouse\Product;
$report = new NukeViet\StoreHouse\Reports;
$purchases_list = $report -> getPurchasesReport($global_config['idsite'],$global_config['parentid']);

$sales_list = $report -> getSalesReport($global_config['idsite'],$global_config['parentid']);
$transfers_list = $report -> getTransfersReport($global_config['idsite'],$global_config['parentid']);
$purchases_chart_list = $product -> products_model -> getPurchasedQty($row['id']);
$sales_chart_list = $product -> products_model -> getSoldQty($row['id']);
$warehouses = $product -> site -> getAllWarehouses($global_config['idsite'],$global_config['parentid']);
$warehouses_products = $product -> products_model -> getAllWarehousesWithPQ($row['id'],$global_config['idsite'],$global_config['parentid']);
$xtpl = new XTemplate('products_detail.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl -> assign('LANG', $lang_module);
$xtpl -> assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl -> assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl -> assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl -> assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl -> assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl -> assign('MODULE_NAME', $module_name);
$xtpl -> assign('MODULE_UPLOAD', $module_upload);
$xtpl -> assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
$xtpl -> assign('OP', $op);
$row['cost'] = storehouse_number_format($row['cost'], 0);
$row['price'] = storehouse_number_format($row['product_price'], 0);
$row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['homeimgfile'];
$xtpl -> assign('ROW', $row);

if ($show_view) {
	$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
	if (!empty($id)) {
		$base_url .= '&id=' . $id;
	}
	$generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
	if (!empty($generate_page)) {
		$xtpl -> assign('NV_GENERATE_PAGE', $generate_page);
		$xtpl -> parse('main.view.generate_page');
	}
	$number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
	while ($view = $sth -> fetch()) {
		$view['number'] = $number++;
		$xtpl -> assign('CHECK', $view['hide'] == 1 ? 'checked' : '');
		$view['unit'] = $array_unit_storehouse[$view['unit']]['name'];
		$view['category_id'] = $array_category_id_storehouse[$view['category_id']]['name'];
		if ($view['warehouse'] != 0)
			$view['warehouse'] = $array_warehouse_storehouse[$view['warehouse']]['name'];
		else
			$view['warehouse'] = "";
		if ($view['brand'] != 0)
			$view['brand'] = $array_brand_storehouse[$view['brand']]['name'];
		else
			$view['brand'] = "";
		$view['link_detail'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=products_detail&amp;id=' . $view['id'];
		$view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=products&amp;id=' . $view['id'];
		$view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
		$xtpl -> assign('VIEW', $view);
		$xtpl -> parse('main.view.loop');
	}
	$xtpl -> parse('main.view');
} else {
	if($warehouses_products != FALSE){
		foreach ($warehouses_products as $key => $w_p) {
			$xtpl -> assign('WAREHOUSE', $w_p);
			$w_p -> quantity = storehouse_number_format($w_p -> quantity, 0);
			$xtpl -> parse('main.products.warehouse');
		}
	}
	if($sales_chart_list != FALSE){
		foreach ($sales_chart_list as $key => $sales_chart) {
			$sales_chart['sold'] = storehouse_number_format($sales_chart['sold'], 0, '.', '');
			$sales_chart['amount'] = storehouse_number_format($sales_chart['amount'], 0, '.', '');
			$xtpl -> assign('SMONTH', $sales_chart['month']);
			$xtpl -> assign('SQUANTITY', $sales_chart['sold']);
			$xtpl -> assign('SAMOUNT', $sales_chart['amount']);
			$xtpl -> parse('main.products.chart.csales');
			$xtpl -> parse('main.products.chart.csales2');
			$xtpl -> parse('main.products.chart.csales3');
		}
	}
	if($purchases_chart_list != FALSE){
		foreach ($purchases_chart_list as $key => $purchases_chart) {
			$purchases_chart['purchases'] = storehouse_number_format($purchases_chart['purchases'], 0, '.', '');
			$purchases_chart['amount'] = storehouse_number_format($purchases_chart['amount'], 0, '.', '');
			$xtpl -> assign('PMONTH', $purchases_chart['month']);
			$xtpl -> assign('PQUANTITY', $purchases_chart['purchases']);
			$xtpl -> assign('PAMOUNT', $purchases_chart['amount']);
			$xtpl -> parse('main.products.chart.cpurchases');
			$xtpl -> parse('main.products.chart.cpurchases2');
			$xtpl -> parse('main.products.chart.cpurchases3');
		}
	
		$xtpl -> parse('main.products.chart');
	}
	$s_i = 0;
	if($sales_list != FALSE){
		foreach ($sales_list as $sales) {
			$s_i++;
			$sales['number'] = $s_i;
			$sales['warehouse'] = $array_warehouses_storehouse[$sales['warehouse_id']]['name'];
			$sales['balance'] = storehouse_number_format($sales['balance'], 0);
			$sales['total'] = storehouse_number_format($sales['grand_total'], 0);
			$sales['paid'] = storehouse_number_format($sales['paid'], 0);
			if ($sales['biller_id'] == 0)
				$sales['biller'] = $lang_module['sys_bill'];
			$xtpl -> assign('SALES', $sales);
			$xtpl -> parse('main.products.sales');
		}
	}
	$p_i = 0;
	if($purchases_list != FALSE){
		foreach ($purchases_list as $purchase) {
			$p_i++;
			$purchase['number'] = $p_i;
			$purchase['warehouse'] = $array_warehouses_storehouse[$purchase['warehouse_id']]['name'];
			$purchase['supplier'] = ($array_supplier_id_storehouse[$purchase['supplier_id']]['company'] == '') ? $array_supplier_id_storehouse[$purchase['supplier_id']]['name'] : $array_supplier_id_storehouse[$purchase['supplier_id']]['company'];
			$purchase['balance'] = storehouse_number_format($purchase['balance'] , 0);
			$purchase['total'] = storehouse_number_format($purchase['grand_total'], 0);
			$purchase['paid'] = storehouse_number_format($purchase['paid'], 0);
			//$purechase['date'] = 1;
			$xtpl -> assign('PURCHASES', $purchase);
			$xtpl -> parse('main.products.purchases');
		}
	}
	$t_i = 0;
	if($transfers_list != FALSE){
		foreach ($transfers_list as $transfer) {
			$t_i++;
			$transfer['number'] = $t_i;
			$temp_pro_name=explode('__', $transfer['iname']);
			$transfer['product_name'] = $temp_pro_name[0];
			$transfer['quantity'] = storehouse_number_format($temp_pro_name[1], 0);
			$transfer['number'] = $t_i;
			$transfer['warehouse'] = $array_warehouses_storehouse[$transfer['fw_id']]['name'];
			$transfer['warehouse_new'] = $array_warehouses_storehouse[$transfer['tw_id']]['name'];
			$transfer['total'] = storehouse_number_format($transfer['grand_total'], 0);
			//$purechase['date'] = 1;
			$xtpl -> assign('TRANSFER', $transfer);
			$xtpl -> parse('main.products.transfer');
		}
	}
	$xtpl -> assign('ROW', $row);
	$xtpl -> parse('main.products');
}

if (!empty($error)) {
	$xtpl -> assign('ERROR', implode('<br />', $error));
	$xtpl -> parse('main.error');
}

$xtpl -> parse('main');
$contents = $xtpl -> text('main');

$page_title = '';

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
