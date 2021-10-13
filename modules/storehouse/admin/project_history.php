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
$projectid = $nv_Request->get_int('projectid', 'get', 0);

	
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 20;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()
        ->select('COUNT(*)')
        ->from($db_config['dbsystem'] . '.' . $db_config['prefix']  . '_' . $module_data . '_project p')
		->join('LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_companies c on p.customerid = c.id');
		

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
if($projectid>0){
	 $db->sqlreset()
	        ->select('COUNT(*)')
	        ->from($db_config['dbsystem']. '.'  . $db_config['prefix'] . '_' . $module_data . '_sales s')
	        ->join('LEFT JOIN ' . $db_config['dbsystem']. '.' . $db_config['prefix'] . '_' . $module_data . '_project p on s.projectid = p.projectid')
	        ->where('s.projectid = '. $projectid);
	
	  
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
$xtpl = new XTemplate('project_history.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
if ($show_view && empty($projectid)) {
    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.view.generate_page');
    }
	$number = 1;
    while ($view = $sth->fetch()) {
    	//print_r($view);
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

        $view['link_view_history'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;projectid=' . $view['projectid'];
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
if($projectid>0 ){
	$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.project.generate_page');
    }
	$i =1;
    while ($view = $sth->fetch()) {
        $view['number'] = $i;
        $view['warehouse'] = $array_warehouse_id_storehouse[$view['warehouse_id']]['name'];
        $view['total'] = storehouse_number_format($view['total'],0);
        $view['paid'] = storehouse_number_format($view['paid'],0);
		$view['status'] = $array_sales_status[$view['sale_status']];
		$view['payment_status'] = $array_payment_status[$view['payment_status']];
        $view['link_history_detail'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=project_history_detail&amp;projectid=' . $view['projectid'].'&amp;saleid='.$view['id'];
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.project.loop');
		$i++;
    }
	$xtpl->parse('main.project');
}else{
	$xtpl->parse('main.no_project');
}
$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $title_manager_store;

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';


