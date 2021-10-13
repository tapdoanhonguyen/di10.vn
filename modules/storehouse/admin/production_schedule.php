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
$projectid = $nv_Request->get_int('projectid', 'get', 0);
$saleid = $nv_Request->get_int('saleid', 'get', 0);
if($parentid != $_SESSION[$module_data . '_store_id'] && $_SESSION[$module_data . '_store_id'] > 0 || $groups == 1){
	
	if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
	    $id = $nv_Request->get_int('delete_id', 'get');
	    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
	    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
	        $db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_purchases  WHERE id = ' . $db->quote($id));
	        $nv_Cache->delMod($module_name);
	        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Purchases', 'ID: ' . $id, $admin_info['userid']);
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }
	}
	
	$row = array();
	$error = array();
	
	$q = $nv_Request->get_title('q', 'post,get');
	
	// Fetch Limit
	$show_view = false;
	if (!$nv_Request->isset_request('id', 'post,get')) {
	    $show_view = true;
	    $per_page = 20;
	    $page = $nv_Request->get_int('page', 'post,get', 1);
	    $db->sqlreset()
	        ->select('COUNT(*)')
	        ->from($db_config['dbsystem']. '.'  . $db_config['prefix'] . '_' . $module_data . '_sales s')
	        ->join('LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_project p on s.projectid = p.projectid')
	        ->where('sale_status = 1');
	
	  
	    $sth = $db->prepare($db->sql());
	    $sth->execute();
	    $num_items = $sth->fetchColumn();
	
	    $db->select('s.*, p.title')
	        ->order('id DESC')
	        ->limit($per_page)
	        ->offset(($page - 1) * $per_page);
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
	if($projectid>0 && $saleid >0 ){
		//print_r('SELECT * FROM ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_project WHERE projectid=' . $projectid);die;
		$project = $db->query('SELECT * FROM ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_project WHERE projectid=' . $projectid)->fetch();
		$sale = $db->query('SELECT * FROM ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_sales WHERE id=' . $saleid)->fetch();
		$sale_item = $db->query('SELECT * FROM ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_sale_items WHERE sale_id=' . $saleid);
		if (empty($project)) {
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
	    }
		$add_pro_sche =0; 
		$product_plan = $db->query('SELECT * FROM ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_production_plan WHERE saleid = ' . $saleid . ' AND projectid=' . $projectid)->fetch();
		if (empty($product_plan)) {
	        $add_pro_sche = 1;
	    } 
	}
		
	$xtpl = new XTemplate('production_schedule.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
	
	if ($show_view && empty($projectid)) {
		//print_r($projectid);
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
	        $view['number'] = $number++;
	        $view['date'] = (empty($view['date'])) ? '' : nv_date('H:i d/m/Y', $view['date']);
			$view['money_nofomart'] = storehouse_number_format( (($view['total'] -  $view['paid']) > 0) ? ($view['total'] -  $view['paid']) : 0 ,0,'','');
			$view['customer_id'] = $array_customer_id_storehouse[$view['customer_id']]['company'];
			$view['warehouse_id'] = $array_warehouse_id_storehouse[$view['warehouse_id']]['name'];
			$view['status'] = $array_sales_status[$view['sale_status']];
			$view['payment_status'] = $array_payment_status[$view['payment_status']];
			$view['total'] = storehouse_number_format( $view['total'] ,0);
			$view['paid'] = storehouse_number_format( $view['paid'] ,0);
	        $view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=export&amp;id=' . $view['id'];
	        $view['link_view_pro_sche'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=production_schedule&amp;saleid=' . $view['id'] . '&amp;projectid=' . $view['projectid'];
	        $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
	        if($view['pos'] < 1 ){
	        	$xtpl->assign('link_edit', $view['link_edit']);
	        	$xtpl->assign('link_delete', $view['link_delete']);
	        	$xtpl->parse('main.view.loop.action');
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
	if($projectid>0 && $saleid >0){
		$xtpl->assign('projectid', $projectid);
		$xtpl->assign('saleid', $saleid);
		if(!empty($project)){
			if($groups ==1 || $groups == 5 ){
				if($add_pro_sche){
					$xtpl->parse('main.project.add_pro_sche_button');
					$xtpl->parse('main.project.add_pro_sche_content');
					$xtpl->parse('main.project.add_pro_sche_script');
					
				}else{
					if($product_plan['status'] !=4 && $product_plan['status'] !=3){
						$xtpl->parse('main.project.edit_pro_sche_button');
						$xtpl->parse('main.project.edit_pro_sche_content');
						$xtpl->parse('main.project.edit_pro_sche_script');	
						
					}
					$xtpl->parse('main.project.show_view_pro_sche');
				}
				
				
				$xtpl->parse('main.project.view_pro_sche_content');
				$xtpl->parse('main.project.view_pro_sche_script');
				if($product_plan['status'] !=4){
					$xtpl->parse('main.project.view_pro_sche_button');
				}
				if($product_plan['status'] ==3){
					$xtpl->parse('main.project.tran_pro_sche_button');
					$xtpl->parse('main.project.tran_pro_sche_content');
					$xtpl->parse('main.project.tran_pro_sche_script');
				}
				
				$xtpl->parse('main.project.process_pro_sche_script');
			}elseif($groups ==1 || $groups == 24){
				$xtpl->parse('main.project.view_pro_sche_button');
				$xtpl->parse('main.project.view_pro_sche_content');
				$xtpl->parse('main.project.view_pro_sche_script');
			}
			while ($item = $sale_item->fetch()){
				$item['unit'] = $array_unit_storehouse[$item['product_unit_id']]['name'];
				$item['quantity_dec'] = storehouse_number_format($item['quantity'],0);
				$xtpl->assign('ITEMS', $item);
				$xtpl->parse('main.project.items');
			}
			
			$xtpl->parse('main.project');
		}else{
			$xtpl->parse('main.no_project');
		}
		
	}
		
	$xtpl->parse('main');
	$contents = $xtpl->text('main');
	
	$page_title = $title_manager_store;
	
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme($contents);
	include NV_ROOTDIR . '/includes/footer.php';
}else{
	$xtpl = new XTemplate('production_schedule.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
		$error = array();
		$error[] = $lang_module['no_pos_store'];
		
		if (!empty($error)) {
		    $xtpl->assign('ERROR', implode('<br />', $error));
		    $xtpl->parse('no_pos.error');
		}
		$xtpl->parse('no_pos');
		$contents = $xtpl->text('no_pos');
		
		$page_title = $title_manager_store;
		
		include NV_ROOTDIR . '/includes/header.php';
		//echo $contents;
		echo nv_admin_theme($contents);
		include NV_ROOTDIR . '/includes/footer.php';
}