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


$year = $nv_Request->get_int('year', 'get', date("Y",NV_CURRENTTIME));
if($year=='' OR $year == 0) $year = date("Y",NV_CURRENTTIME);
$date_from = $nv_Request->get_title('date_from', 'post', '');
if($date_from == '') {
	$date_from = "01/".date("m",NV_CURRENTTIME)."/".date("Y",NV_CURRENTTIME);
}
$date_to = $nv_Request->get_title('date_to', 'post', '');
if($date_to == '') {
	$date_to = date("d",NV_CURRENTTIME)."/".date("m",NV_CURRENTTIME)."/".date("Y",NV_CURRENTTIME);
}
$warehhouse_id = $nv_Request->get_int('warehhouse_id', 'post', 0);
// Fetch Limit
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 20;
}

$start_date = $date_from;
$end_date = $date_to;
$rp = new NukeViet\StoreHouse\Reports;


$products=$rp->Products_period($start_date, $end_date);
$db->sqlreset()
        ->select('id, code, name')
        ->from($db_config['prefix'] . '_' . $module_data . '_warehouses')
        ->where('store_id = :store_id')
        ->order('id ASC')
        ->limit(20);

    $sth = $db->prepare($db->sql());
    $sth->bindValue(':store_id', $_SESSION[$module_data . '_store_id'], PDO::PARAM_INT);
    $sth->execute();
	$array_store_warehouse_store = array();
    while (list ($id, $code, $name) = $sth->fetch(3)) {
        $array_store_warehouse_store[] = array(
            'id' => $id,
            'title' => $name
        );
    }
	$q=$nv_Request->get_title('q', 'get', '/' . date('Y').'/'.date('m'));
	//list($w,$year,$month) = explode('/',$q); 
	
$daily_sales =  $rp->monthly_sales($_SESSION[$module_data . '_store_id'], $_SESSION[$module_data . '_store_warehouse_id'],$year);
if(!empty($daily_sales->sales)){
	foreach ($daily_sales->sales as $value) {
	
		$sales[$value->date] = "<table class='table table-bordered table-hover table-striped table-condensed data' style='margin:0;'>
			<tbody>
				<tr>
					<td>" . $lang_module["voucher_total_fomart"] . "</td>
				</tr>
				<tr>
					<td>" . storehouse_number_format($value->discount,0) . "</td>
				</tr>
				<tr>
					<td>" . $lang_module["shipping"] . "</td>
				</tr>
				<tr>
					<td>" . storehouse_number_format($value->shipping,0) . "</td>
				</tr>
				<tr>
					<td>" . $lang_module["product_tax"] . "</td>
				</tr>
				<tr>
					<td>" . storehouse_number_format($value->tax1,0) . "</td>
				</tr>
				<tr>
					<td>" . $lang_module["order_tax"] . "</td>
				</tr>
				<tr>
					<td>" .  storehouse_number_format($value->tax2,0) . "</td>
				</tr>
				<tr>
					<td>" . $lang_module["total"] . "</td>
				</tr>
				<tr>
					<td>" .  storehouse_number_format($value->total,0) . "</td>
				</tr>
			</tbody>
		</table>";
	
	}
}

//print_r($sales);
//quantity of sales
$xtpl = new XTemplate($op.'.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
$xtpl->assign('STORE_SESSION', $_SESSION[$module_data . '_store_id']);
$xtpl->assign('WAREHOUSE_SESSION', $_SESSION[$module_data . '_store_warehouse_id']);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $products);
$xtpl->assign('date_from', $date_from);
$xtpl->assign('date_to', $date_to);
$xtpl->assign('year', $year); 
$year_pre= $year-1;
$year_next= $year+1;
$xtpl->assign('link_year_old', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=reports_monthly_sales&year=' . $year_pre); 
$xtpl->assign('link_year_new', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=reports_monthly_sales&year=' . $year_next); 
//die($year);
foreach ($array_store_storehouse as $value) {
	if(!empty($value['store_id'])){
		$xtpl->assign('STORE', array(
			'key' => $value['store_id'],
			'title' => $value['name'],
			'selected' => ($value['store_id'] == $_SESSION[$module_data . '_store_id']) ? ' selected="selected"' : ''
		));
		$xtpl->parse('main.select_store_id.sloop');
    }
}
$xtpl->parse('main.select_store_id');
foreach ($array_store_warehouse_store as $value) {
    $xtpl->assign('WAREHOUSE', array(
        'key' => $value['id'],
        'title' => $value['title'],
        'selected' => ($value['id'] == $_SESSION[$module_data . '_store_warehouse_id']) ? ' selected="selected"' : ''
    ));
	$xtpl->parse('main.wloop');
    
}
//print_r($daily_sales->sales);die;
for ($i=1;$i<=12;$i++) {
	if (isset($sales[$i])) {
		
			$xtpl->assign('sales', $sales[$i]);
			$xtpl->parse('main.report.sale');
		} else {
			$xtpl->assign('nosales', '<strong>0</strong>');
			$xtpl->parse('main.report.no_sales');
		} 
		$xtpl->parse('main.report'); 
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
