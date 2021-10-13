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

// Change status
if ($nv_Request->isset_request('change_status', 'post, get')) {
    $id = $nv_Request->get_int('id', 'post, get', 0);
    $content = 'NO_' . $id;

    $query = 'SELECT hide FROM ' . $db_config['prefix'] . '_' . $module_data . '_products WHERE id=' . $id;
    $row = $db->query($query)->fetch();
    if (isset($row['hide']))     {
        $hide = ($row['hide']) ? 0 : 1;
        $query = 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_products SET hide=' . intval($hide) . ' WHERE id=' . $id;
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
        $db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_products  WHERE id = ' . $db->quote($id));
        $nv_Cache->delMod($module_name);
        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Products_list', 'ID: ' . $id, $admin_info['userid']);
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
}

$row = array();
$error = array();
$array_unit_storehouse = array();
$_sql = 'SELECT id,name FROM ' . $db_config['prefix'] . '_' . $module_data . '_units';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_unit_storehouse[$_row['id']] = $_row;
}



$date_from = $nv_Request->get_title('date_from', 'post', '');
$date_from = $nv_Request->get_title('date_from', 'post,get', '');
	if($date_from == '') {
		$date_from = "01/".date("m",NV_CURRENTTIME)."/".date("Y",NV_CURRENTTIME);
	}
	if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $date_from, $m)) {
        $phour = $nv_Request->get_int('phour', 'post', 0);
        $pmin = $nv_Request->get_int('pmin', 'post', 0);
        $date_from = mktime($phour, $pmin, 0, $m[2], $m[1], $m[3]);
    } else {
        $date_from = NV_CURRENTTIME;
    }
	$date_to = $nv_Request->get_title('date_to', 'post,get', '');
	if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $date_to, $m)) {
        $phour = $nv_Request->get_int('phour', 'post', 0);
        $pmin = $nv_Request->get_int('pmin', 'post', 0);
        $date_to = mktime($phour, $pmin, 0, $m[2], $m[1], $m[3]);
    } else {
        $date_to = NV_CURRENTTIME;
    }
$warehhouse_id = $nv_Request->get_int('warehhouse_id', 'post', 0);
// Fetch Limit
$rp = new NukeViet\StoreHouse\Reports;
$form_action = $nv_Request->get_title('form_action', 'post,get', '');
	if($form_action == 'export_excel'){
		require_once NV_ROOTDIR . '/modules/'. $module_file .'/Classes/PHPExcel.php';
		$rp->reports_model->export_excel($date_from,$date_to);
		die;
	}
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 20;
}

$start_date = $date_from;
$end_date = $date_to;



$sales=$rp->getSalesReport($start_date,$end_date);
//quantity of sales
$xtpl = new XTemplate('reports_sales.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
$xtpl->assign('date_from', date("d/m/Y" , $date_from));
$xtpl->assign('date_to', date("d/m/Y" , $date_to));
//print_r($sales);die;
$number=1;
if ($show_view) {
    if(!empty($sales)){
		foreach ($sales as $key => $sale) {
			//print_r($sale);
			 //$sale['date'] = (empty($sale['date'])) ? '' : nv_date('H:i d/m/Y', $sale['date']);
				$sale['money_nofomart'] = storehouse_number_format( (($sale['grand_total'] -  $sale['paid']) > 0) ? ($sale['grand_total'] -  $sale['paid']) : 0 ,0,'','');
				$sale['grand_total_fomart'] = storehouse_number_format( $sale['grand_total'],0);
				$sale['customer_id'] = $array_customer_id_storehouse[$sale['customer_id']]['company'];
				$sale['warehouse_id'] = $array_warehouse_id_storehouse[$sale['warehouse_id']]['name'];
				$sale['status'] = $array_sales_status[$sale['sale_status']];
				$sale['payment_status'] = $array_payment_status[$sale['payment_status']];
				$sale['total_format'] = storehouse_number_format( $sale['total'] ,0);
				$sale['paid_format'] = storehouse_number_format( $sale['paid'] ,0);
				$sale['balance_format'] = storehouse_number_format( $sale['balance'] ,0);
				$sale['no'] = $number;
			$xtpl->assign('SALES', $sale);
			$xtpl->parse('main.view.sales');
			$number++;
		}
	}
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
