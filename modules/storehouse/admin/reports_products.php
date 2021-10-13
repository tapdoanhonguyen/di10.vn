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

$array_category_id_storehouse = array();
$_sql = 'SELECT id,name FROM ' . $db_config['prefix'] . '_' . $module_data . '_categories';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_category_id_storehouse[$_row['id']] = $_row;
}

$array_warehouse_storehouse = array();
$_sql = 'SELECT id,name FROM ' . $db_config['prefix'] . '_' . $module_data . '_warehouses';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_warehouse_storehouse[$_row['id']] = $_row;
}

$array_brand_storehouse = array();
$_sql = 'SELECT id,name FROM ' . $db_config['prefix'] . '_' . $module_data . '_brands';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_brand_storehouse[$_row['id']] = $_row;
}


$q = $nv_Request->get_title('q', 'post,get');

// Fetch Limit
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 3;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()
        ->select('COUNT(*)')
        ->from('' . $db_config['prefix'] . '_' . $module_data . '_products');

    if (!empty($q)) {
        $db->where('code LIKE :q_code OR name LIKE :q_name OR unit LIKE :q_unit OR cost LIKE :q_cost OR image LIKE :q_image OR category_id LIKE :q_category_id OR quantity LIKE :q_quantity OR warehouse LIKE :q_warehouse OR start_date LIKE :q_start_date OR end_date LIKE :q_end_date OR brand LIKE :q_brand OR views LIKE :q_views OR hide LIKE :q_hide');
    }
    $sth = $db->prepare($db->sql());

    if (!empty($q)) {
        $sth->bindValue(':q_code', '%' . $q . '%');
        $sth->bindValue(':q_name', '%' . $q . '%');
        $sth->bindValue(':q_unit', '%' . $q . '%');
        $sth->bindValue(':q_cost', '%' . $q . '%');
        $sth->bindValue(':q_image', '%' . $q . '%');
        $sth->bindValue(':q_category_id', '%' . $q . '%');
        $sth->bindValue(':q_quantity', '%' . $q . '%');
        $sth->bindValue(':q_warehouse', '%' . $q . '%');
        $sth->bindValue(':q_start_date', '%' . $q . '%');
        $sth->bindValue(':q_end_date', '%' . $q . '%');
        $sth->bindValue(':q_brand', '%' . $q . '%');
        $sth->bindValue(':q_views', '%' . $q . '%');
        $sth->bindValue(':q_hide', '%' . $q . '%');
    }
    $sth->execute();
    $num_items = $sth->fetchColumn();

    $db->select('*')
        ->order('id DESC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    $sth = $db->prepare($db->sql());

    if (!empty($q)) {
        $sth->bindValue(':q_code', '%' . $q . '%');
        $sth->bindValue(':q_name', '%' . $q . '%');
        $sth->bindValue(':q_unit', '%' . $q . '%');
        $sth->bindValue(':q_cost', '%' . $q . '%');
        $sth->bindValue(':q_image', '%' . $q . '%');
        $sth->bindValue(':q_category_id', '%' . $q . '%');
        $sth->bindValue(':q_quantity', '%' . $q . '%');
        $sth->bindValue(':q_warehouse', '%' . $q . '%');
        $sth->bindValue(':q_start_date', '%' . $q . '%');
        $sth->bindValue(':q_end_date', '%' . $q . '%');
        $sth->bindValue(':q_brand', '%' . $q . '%');
        $sth->bindValue(':q_views', '%' . $q . '%');
        $sth->bindValue(':q_hide', '%' . $q . '%');
    }
    $sth->execute();
}
//quantity of purechases
$views = array();
while ($view = $sth->fetch()) {
	$view['purechases_quantity'] = 0;
	$view['sales_quantity'] = 0;
	$view['profit'] = 0;
	$views[] = $view;
}
$rpproduct = new NukeViet\StoreHouse\Reports;
$products=$rpproduct->Products($per_page, $page);
//quantity of sales
$xtpl = new XTemplate('reports_products.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
$xtpl->assign('ROW', $products);

$xtpl->assign('Q', $q);

if ($show_view) {
    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    if (!empty($q)) {
        $base_url .= '&q=' . $q;
    }
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.view.generate_page');
    }
    $number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
	if(!empty($products))
    foreach ($products as $key => $product) {
        $product['number'] = $number++;
		$product['purchasedqty'] = storehouse_number_format( $product['purchasedqty'],0);
		$product['soldqty'] = storehouse_number_format( $product['soldqty'],0);
		$product['profit'] = storehouse_number_format( $product['profit'],0);
		$product['totalpurchase'] = storehouse_number_format( $product['totalpurchase'],0);
		$product['totalbalance'] = storehouse_number_format( $product['totalbalance'],0);
		$product['balacneqty'] = storehouse_number_format( $product['balacneqty'],0);
		$product['totalsales'] = storehouse_number_format( $product['totalsales'],0);
		$product['link_detail'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=products_detail&amp;id=' . $product['id'];
        $xtpl->assign('VIEW', $product);
        $xtpl->parse('main.view.loop');
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
