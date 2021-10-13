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
$saleid = $nv_Request->get_int('saleid', 'get', 0);

	

if($projectid>0 && $saleid >0){
	 $db->sqlreset()
	        ->select('COUNT(*)')
	        ->from($db_config['dbsystem']. '.'  . $db_config['prefix'] . '_' . $module_data . '_project_log')
	        ->where('projectid = '. $projectid . ' AND saleid = ' . $saleid);
	
	  
	    $sth = $db->prepare($db->sql());
	    $sth->execute();
	    $num_items = $sth->fetchColumn();
	
	    $db->select('*')
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
if($projectid>0 && $saleid >0){
	while ($view = $sth->fetch()) {
		
	    $view['timemodify'] = (empty($view['timemodify'])) ? '' : nv_date('H:i d/m/Y', $view['timemodify']);
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.project_log.loop');
		$i++;
    }
	$xtpl->parse('main.project_log');
}else{
	$xtpl->parse('main.no_project');
}
$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $title_manager_store;

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';


