<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Aug 2018 02:25:02 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
$sales = new NukeViet\StoreHouse\Sales;
	if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
	    $id = $nv_Request->get_int('delete_id', 'get');
	    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
	    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
	        $sales->delete($id);
	        $nv_Cache->delMod($module_name);
	        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Sales', 'ID: ' . $id, $admin_info['userid']);
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }
	}
	
	$row = array();
	$error = array();
	
	$q = $nv_Request->get_title('q', 'post,get');
	$page = $nv_Request->get_title('page', 'post,get', 0);
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
	// Fetch Limit
	$form_action = $nv_Request->get_title('form_action', 'post,get', '');
	if($form_action == 'export_excel'){
		require_once NV_ROOTDIR . '/modules/'. $module_file .'/Classes/PHPExcel.php';
		$sales->sales_model->export_excel($date_from,$date_to);
		die;
	}
	$show_view = false;
	if (!$nv_Request->isset_request('id', 'post,get')) {
	    $show_view = true;
	    $per_page = 10;
	    $page = $nv_Request->get_int('page', 'post,get', 1);
		$where = '';
		if (!empty($date_from)) {
	        $where .=' AND date >= ' . $date_from;
	    }
		 if (!empty($date_to)) {
	        $where .=' AND date < ' . $date_to;
	    }
	    $db->sqlreset()
	        ->select('COUNT(*)')
	        ->from('' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_sales');
		/* if($_SESSION[$module_data . '_store_id']>0 && !empty($list_warehouse_of_store))
			$db->where('warehouse_id IN (' . implode(",", $list_warehouse_of_store) . ')' . $where);
		elseif($_SESSION[$module_data . '_store_id']==0) {
			$db->where('warehouse_id IN (' . implode(",", $list_warehouse_of_store) . ')' . $where);
		}else{
			$db->where('warehouse_id IN (0)' .$where);
		} */
	    if (!empty($q)) {
	        $where .='reference_no LIKE :q_reference_no OR supplier_id LIKE :q_supplier_id OR warehouse_id LIKE :q_warehouse_id OR total LIKE :q_total OR grand_total LIKE :q_grand_total OR paid LIKE :q_paid OR status LIKE :q_status OR payment_status LIKE :q_payment_status';
	    }
		 
		 
	    $sth = $db->prepare($db->sql());
	
	    if (!empty($q)) {
	        $sth->bindValue(':q_reference_no', '%' . $q . '%');
	        $sth->bindValue(':q_supplier_id', '%' . $q . '%');
	        $sth->bindValue(':q_warehouse_id', '%' . $q . '%');
	        $sth->bindValue(':q_total', '%' . $q . '%');
	        $sth->bindValue(':q_grand_total', '%' . $q . '%');
	        $sth->bindValue(':q_paid', '%' . $q . '%');
	        $sth->bindValue(':q_status', '%' . $q . '%');
	        $sth->bindValue(':q_payment_status', '%' . $q . '%');
	    }
	    $sth->execute();
	    $num_items = $sth->fetchColumn();
	
	    $db->select('*')
	        ->order('id DESC')
	        ->limit($per_page)
	        ->offset(($page - 1) * $per_page);
		//print_r($db->sql());
	    $sth = $db->prepare($db->sql());
	
	    if (!empty($q)) {
	        $sth->bindValue(':q_reference_no', '%' . $q . '%');
	        $sth->bindValue(':q_date', '%' . $q . '%');
	        $sth->bindValue(':q_supplier_id', '%' . $q . '%');
	        $sth->bindValue(':q_warehouse_id', '%' . $q . '%');
	        $sth->bindValue(':q_total', '%' . $q . '%');
	        $sth->bindValue(':q_grand_total', '%' . $q . '%');
	        $sth->bindValue(':q_paid', '%' . $q . '%');
	        $sth->bindValue(':q_status', '%' . $q . '%');
	        $sth->bindValue(':q_payment_status', '%' . $q . '%');
	    }
	    $sth->execute();
	}
	
	$xtpl = new XTemplate('sales_list.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
	$xtpl->assign('page', $page);
	$xtpl->assign('date_from', date("d/m/Y" , $date_from));
	$xtpl->assign('date_to', date("d/m/Y" , $date_to));
	$xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
	$xtpl->assign('THEMES_NEWS_JS', 'themes/' . $global_config['module_theme'] . '/js' );
	$xtpl->assign('THEMES_NEWS_CSS', 'themes/' . $global_config['module_theme'] . '/css' );
	$xtpl->assign('Q', $q);
	$xtpl->assign('link_add', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=export');
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
	    	//print_r($view);
	        $view['number'] = $number++;
	        $view['date'] = (empty($view['date'])) ? '' : nv_date('H:i d/m/Y', $view['date']);
			$view['money_nofomart'] = storehouse_number_format( (($view['grand_total'] -  $view['paid']) > 0) ? ($view['grand_total'] -  $view['paid']) : 0 ,0,'','');
			$view['grand_total_fomart'] = storehouse_number_format( $view['grand_total'],0);
			$view['customer_id'] = $array_customer_id_storehouse[$view['customer_id']]['company'];
			$view['warehouse_id'] = $array_warehouses_storehouse[$view['warehouse_id']]['name'];
			$view['status'] = $array_sales_status[$view['sale_status']];
			$view['payment_status'] = $array_payment_status[$view['payment_status']];
			$view['total'] = storehouse_number_format( $view['total'] ,0);
			$view['paid'] = storehouse_number_format( $view['paid'] ,0);
	        $view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=export&amp;id=' . $view['id'];
	        $view['link_print'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=sales_print&amp;id=' . $view['id'];
	        $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
	        if($view['pos'] < 1 ){
	        	$xtpl->assign('link_edit', $view['link_edit']);
	        	$xtpl->assign('link_delete', $view['link_delete']);
	        	$xtpl->assign('link_print', $view['link_print']);
	        	$xtpl->parse('main.view.loop.action');
	        }else{
	        	$view['link_pos_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=pos_edit&amp;id=' . $view['id'];
	        	$view['link_pos_print'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=pos_view&amp;id=' . $view['id'];
	        	$xtpl->assign('link_edit', $view['link_pos_edit']);
	        	$xtpl->assign('link_delete', $view['link_delete']);
	        	$xtpl->assign('link_print', $view['link_pos_print']);
	        	$xtpl->parse('main.view.loop.posaction');
	        }
	        
	        $xtpl->assign('VIEW', $view);
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
