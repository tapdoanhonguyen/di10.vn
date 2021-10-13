<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Aug 2018 03:21:03 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
$row = array();
$row['customerid'] = $nv_Request->get_int('customerid', 'post,get', 0);


	if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
	    $id = $nv_Request->get_int('delete_id', 'get');
	    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
	    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
	        $db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_project  WHERE projectid = ' . $db->quote($id));
	        $nv_Cache->delMod($module_name);
	        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Project', 'ID: ' . $id, $admin_info['userid']);
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }
	}
	
	$error = array();
	$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
	
	if ($nv_Request->isset_request('submit', 'post')) {
	    $row['title'] = $nv_Request->get_string('title', 'post', '');
	    $row['customer_id'] = $nv_Request->get_int('customer_id', 'post', 0);
	    //print_r($row);die;
	
	    if (empty($row['title'])) {
	        $error[] = $lang_module['error_required_project'];
	    } 
	    if (empty($error)) {
	        try {
	            if (empty($row['id'])) {
	                $stmt = $db->prepare('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_project (title, customerid) VALUES (:title, ' .$row['customer_id'] . ')');
	
	            } else {
	                $stmt = $db->prepare('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_project SET title = :title WHERE projectid=' . $row['id']);
	            }
	            $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
	            $exc = $stmt->execute();
	            if ($exc) {
	                $nv_Cache->delMod($module_name);
	                if (empty($row['id'])) {
	                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Supply', ' ', $admin_info['userid']);
	                } else {
	                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Supply', 'ID: ' . $row['id'], $admin_info['userid']);
	                }
	                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=project&customerid='. $row['customer_id']);
	            }
	        } catch(PDOException $e) {
	            trigger_error($e->getMessage());
	            die($e->getMessage()); //Remove this line after checks finished
	        }
	    }
	} elseif ($row['id'] > 0) {
		
	    $row = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_project WHERE projectid=' . $row['id'])->fetch();
	    if (empty($row)) {
	        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
	    }
	} else {
	    $row['id'] = 0;
	    $row['title'] = '';
	}
	if (!$nv_Request->isset_request('id', 'post,get')) {
	    $show_view = true;
	    $per_page = 20;
	    $page = $nv_Request->get_int('page', 'post,get', 1);
		if($row['customerid'] > 0 )
			$where = "customerid = " . $row['customerid'];
	    $db->sqlreset()
	        ->select('COUNT(*)')
	        ->from($db_config['dbsystem'] . '.' . $db_config['prefix']  . '_' . $module_data . '_project')
			->where($where);
	
	    $sth = $db->prepare($db->sql());
	
	    $sth->execute();
	    $num_items = $sth->fetchColumn();
	
	    $db->select('*')
	        ->order('projectid ASC') 
	        ->limit($per_page)
	        ->offset(($page - 1) * $per_page);
	    $sth = $db->prepare($db->sql());
	    $sth->execute();
	}

	$xtpl = new XTemplate('project.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
	//print_r($row);die;
	if ($show_view) {
    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.view.generate_page');
    }
	$number = 1;
    while ($view = $sth->fetch()) {
        for ($i = 1; $i <= $num_items; ++$i) {
            $xtpl->assign('WEIGHT', array(
                'key' => $i,
                'title' => $i,
                'selected' => ($i == $view['weight']) ? ' selected="selected"' : ''
            ));
            $xtpl->parse('main.view.loop.weight_loop');
        }
        if ($view['status'] == 1) {
            $check = 'checked';
        } else {
            $check = '';
        }
        $xtpl->assign('CHECK', $check);
		
        $view['link_view'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;parentid=' . $view['projectid'];
        $view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $view['projectid'];
        $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['projectid'] . '&amp;delete_checkss=' . md5($view['projectid'] . NV_CACHE_PREFIX . $client_info['session_id']);
        $view['customer'] = !empty($array_customer_id_storehouse[$view['customerid']]['company'])?$array_customer_id_storehouse[$view['customerid']]['company']:$array_customer_id_storehouse[$view['customer_id']]['name'];
        $view['number'] = $number;
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.view.loop');
		$number++; 
    }
    $xtpl->parse('main.view');
}
	
	if (!empty($error)) {
	    $xtpl->assign('ERROR', implode('<br />', $error));
	    $xtpl->parse('main.error');
	}
	foreach ($array_customer_id_storehouse as $value) {
		//print_r($value);
		    $xtpl->assign('CUSTOMER', array(
		        'key' => $value['id'],
		        'title' => $value['company'],
		        'selected' => ($value['id'] == $row['customerid']) ? ' selected="selected"' : ''
		    ));
			
		    	$xtpl->parse('main.customer.select_customer_id');
			
		}
	if($row['customerid'] <=0 ) 
		$xtpl->parse('main.customer');
	else
		$xtpl->parse('main.customerinput');
	$xtpl->parse('main');
	$contents = $xtpl->text('main');
	
	$page_title = $title_manager_store;
	
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme($contents);
	include NV_ROOTDIR . '/includes/footer.php';


