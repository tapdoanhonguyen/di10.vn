<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 13 Aug 2018 15:07:10 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
	$id = $nv_Request->get_int('delete_id', 'get');
	$delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
	if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
		$db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_warehouses  WHERE id = ' . $db->quote($id));
		$nv_Cache->delMod($module_name);
		nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Warehouses', 'ID: ' . $id, $admin_info['userid']);
		nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	}
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if ($nv_Request->isset_request('submit', 'post')) {
	$row['code'] = $nv_Request->get_title('code', 'post', '');
	$row['name'] = $nv_Request->get_title('name', 'post', '');
	$row['parentid'] = $site_parent;
	$row['address'] = $nv_Request->get_title('address', 'post', '');
	$row['map'] = $nv_Request->get_title('map', 'post', '');
	if (is_file(NV_DOCUMENT_ROOT . $row['map']))     {
		$row['map'] = substr($row['map'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'));
	} else {
		$row['map'] = '';
	}
	$row['phone'] = $nv_Request->get_title('phone', 'post', '');
	$row['email'] = $nv_Request->get_title('email', 'post', '');
	$row['price_group_id'] = $nv_Request->get_int('price_group_id', 'post', 1);
/* 	if(IDSITE != $parentid)
		$row['store_id'] = IDSITE;
	else {
		$row['store_id'] = 0;
	} */
	$row['store_id'] = $global_config['idsite'];
	if (empty($row['code'])) {
		$error[] = $lang_module['error_required_code'];
	} elseif (empty($row['name'])) {
		$error[] = $lang_module['error_required_name'];
	} elseif (empty($row['address'])) {
		$error[] = $lang_module['error_required_address'];
	}/* elseif($row['store_id'] ==0){
		$error[] = $lang_module['error_required_store'];
	} */

	if (empty($error)) {
		try {
			if (empty($row['id'])) {
				$stmt = $db->prepare('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_warehouses (code, name, parentid, address, map, phone, email, price_group_id, store_id, whidsite, whparentid) VALUES (:code, :name, :parentid, :address, :map, :phone, :email, :price_group_id, :store_id, :whidsite, :whparentid)');
				$stmt->bindParam(':whidsite', $global_config['idsite'], PDO::PARAM_INT);
				$stmt->bindParam(':whparentid', $site_parent, PDO::PARAM_INT);
			} else {
				$stmt = $db->prepare('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_warehouses SET code = :code, name = :name, parentid = :parentid, address = :address, map = :map, phone = :phone, email = :email, price_group_id = :price_group_id, store_id = :store_id WHERE id=' . $row['id']);
			}
			$stmt->bindParam(':code', $row['code'], PDO::PARAM_STR);
			$stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
			$stmt->bindParam(':parentid', $row['parentid'], PDO::PARAM_INT);
			$stmt->bindParam(':address', $row['address'], PDO::PARAM_STR);
			$stmt->bindParam(':map', $row['map'], PDO::PARAM_STR);
			$stmt->bindParam(':phone', $row['phone'], PDO::PARAM_STR);
			$stmt->bindParam(':email', $row['email'], PDO::PARAM_STR);
			$stmt->bindParam(':price_group_id', $row['price_group_id'], PDO::PARAM_INT);
			$stmt->bindParam(':store_id', $row['store_id'], PDO::PARAM_INT);

			$exc = $stmt->execute();
			if ($exc) {
				$nv_Cache->delMod($module_name);
				if (empty($row['id'])) {
					nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Warehouses', ' ', $admin_info['userid']);
				} else {
					nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Warehouses', 'ID: ' . $row['id'], $admin_info['userid']);
				}
				nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
			}
		} catch(PDOException $e) {
			trigger_error($e->getMessage());
			die($e->getMessage()); //Remove this line after checks finished
		}
	}
} elseif ($row['id'] > 0) {
	$row = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_warehouses WHERE id=' . $row['id'])->fetch();
	if (empty($row)) {
		nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	}
} else {
	$row['id'] = 0;
	$row['code'] = '';
	$row['name'] = '';
	$row['parentid'] = 0;
	$row['address'] = '';
	$row['map'] = '';
	$row['phone'] = '';
	$row['email'] = '';
	$row['price_group_id'] = 1;
	$row['store_id'] = IDSITE;
}
if (!empty($row['map']) and is_file(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['map'])) {
	$row['map'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['map'];
}



$q = $nv_Request->get_title('q', 'post,get');

// Fetch Limit
$show_view = false;
$array_store_tmp = $array_store = array();
/* foreach ($array_store_storehouse as $storeid => $stores) {
	if($stores['parentid'] == $parentid ){
		$array_store_tmp[] = $stores['store_id'];
	}
}
if(IDSITE != $parentid )
{
	foreach ($array_store_tmp as $store_id) {
		if(IDSITE==$store_id)
			$array_store[] =  $store_id;
	}
} */
if (!$nv_Request->isset_request('id', 'post,get')) {
	$show_view = true;
	$per_page = 20;
	$page = $nv_Request->get_int('page', 'post,get', 1);
	
	$where = 'whidsite = ' . $global_config['idsite'] . '';
	$db->sqlreset()
		->select('COUNT(*)')
		->from($db_config['dbsystem'] . '.' . '' . $db_config['prefix'] . '_' . $module_data . '_warehouses')
		->where($where);

	if (!empty($q)) {
		$db->where($where . ' AND (code LIKE :q_code OR name LIKE :q_name OR address LIKE :q_address OR map LIKE :q_map OR phone LIKE :q_phone OR email LIKE :q_email OR price_group_id LIKE :q_price_group_id) ');
	}
	$sth = $db->prepare($db->sql());

	if (!empty($q)) {
		$sth->bindValue(':q_code', '%' . $q . '%');
		$sth->bindValue(':q_name', '%' . $q . '%');
		$sth->bindValue(':q_address', '%' . $q . '%');
		$sth->bindValue(':q_map', '%' . $q . '%');
		$sth->bindValue(':q_phone', '%' . $q . '%');
		$sth->bindValue(':q_email', '%' . $q . '%');
		$sth->bindValue(':q_price_group_id', '%' . $q . '%');
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
		$sth->bindValue(':q_address', '%' . $q . '%');
		$sth->bindValue(':q_map', '%' . $q . '%');
		$sth->bindValue(':q_phone', '%' . $q . '%');
		$sth->bindValue(':q_email', '%' . $q . '%');
		$sth->bindValue(':q_price_group_id', '%' . $q . '%');
	}
	$sth->execute();
}

$xtpl = new XTemplate('warehouses.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
$xtpl->assign('STORE_SESSION', IDSITE);


foreach ($array_price_group_id_storehouse as $value) {
	$xtpl->assign('OPTION', array(
		'key' => $value['id'],
		'title' => $value['name'],
		'selected' => ($value['id'] == $row['price_group_id']) ? ' selected="selected"' : ''
	));
	$xtpl->parse('main.select_price_group_id');
}
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
	while ($view = $sth->fetch()) {
		$view['purcheck'] = ($view['purchases'] == 1) ? 'checked="checked"' : '' ;
		$view['salecheck'] = ($view['sales'] == 1) ? 'checked="checked"' : '' ;
		$view['number'] = $number++;
		if($view['price_group_id'] != 0)
			$view['price_group_id'] = $array_price_group_id_storehouse[$view['price_group_id']]['name'];
		$view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $view['id'];
		$view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
		$xtpl->assign('VIEW', $view);
		$xtpl->parse('main.view.loop');
	}
	$xtpl->parse('main.view');
}
/* if($parentid == IDSITE){
	foreach ($array_store_storehouse as $storeid => $store) {
		if($store['parentid'] == $parentid ){
			$store['selected'] = ($store['store_id'] ==$row['parentid'])? 'selected="selected"' : ''; 
			$xtpl->assign('STORE', $store);
			$xtpl->parse('main.add.admin_store.select_store');
		}
	}
	$xtpl->parse('main.add.admin_store');
}else{
	$xtpl->parse('main.add.store');
} */
$xtpl->parse('main.add');

if (!empty($error)) {
	$xtpl->assign('ERROR', implode('<br />', $error));
	$xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');



$page_title = ''  ;

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
