<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
$show_view = false;
$array_store=array();
if(IDSITE>0){
	$array_store[] = $store_main_option=$array_store_storehouse[IDSITE]['parentid'];
	foreach ($array_store_storehouse as $store_id => $store) {
			if ($store['parentid'] == $store_main_option){
				if($store['store_id'] == IDSITE)
					$array_store[] = $store['store_id'];
				elseif($store_main_option == IDSITE)
					$array_store[] = $store['store_id'];
				$array_store_storehouse_sub[$store_id] = $store;
			}
		 	
		}
	$list_users = $db->query('SELECT su.userid,u.username, g.id, g.' . NV_LANG_DATA . '_title title, su.storeid store FROM ' . NV_USERS_GLOBALTABLE . ' u LEFT JOIN ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_users_stores su ON u.userid=su.userid LEFT JOIN 
									' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data  . '_groups_user gu ON u.userid = gu.userid LEFT JOIN ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_groups g ON g.id = gu.group_id  WHERE su.storeid IN (' . implode(',', $array_store) . ')')->fetchAll(5);
			$show_view = true;
}else{
	if(defined('NV_IS_GODADMIN') && $_SESSION[$module_data . '_store_id'] > 0){
		if($array_store_storehouse[$_SESSION[$module_data . '_store_id']]['parentid'] ==0)
			$store_main_option = $_SESSION[$module_data . '_store_id'] ;
		else{
			$store_main_option = $array_store_storehouse[$_SESSION[$module_data . '_store_id']]['parentid'];
		}
		$array_store[] = $store_main_option;
		foreach ($array_store_storehouse as $store_id => $store) {
			if ($store['parentid'] == $store_main_option){
				if($store['store_id'] == $_SESSION[$module_data . '_store_id'])
					$array_store[] = $store['store_id'];
				elseif($store_main_option == $_SESSION[$module_data . '_store_id'])
					$array_store[] = $store['store_id'];
				$array_store_storehouse_sub[$store_id] = $store;
			}
		 	
		}
	}elseif(count($array_store_storehouse_user) == 1){
		$store_main_option = 0;
		$store_sub_option = 0;
		foreach ($array_store_storehouse_user as $stores_id => $stores) {
			$store_main_option=$stores_id;
		}
		$array_store[] = $store_main_option;
		foreach ($array_store_storehouse as $store_id => $store) {
			if ($store['parentid'] == $store_main_option){
				if($store['store_id'] == $_SESSION[$module_data . '_store_id'])
					$array_store[] = $store['store_id'];
				elseif($store_main_option == $_SESSION[$module_data . '_store_id'])
					$array_store[] = $store['store_id'];
				$array_store_storehouse_sub[$store_id] = $store;
			}
		 	
		}
		
			
	}elseif(count($array_store_storehouse_user) > 1){
		$sl='';
		foreach ($array_store_storehouse_user as $stores_id => $stores) {
			$sl='';
			if ($stores_id == $_SESSION[$module_data . '_store_id']) {
	            $sl = ' selected="selected"';
	        }
			$option_store .= '<option value="' . $stores['store_id'] . '" ' . $sl . '>' . $stores['name'] . '</option>';
			foreach ($array_store_storehouse as $store_id => $store) {
				if ($store['parentid'] == $stores_id){
					$lev_i = $store['lev'];
			        $xtitle_i = '';
			        if ($lev_i > 0) {
			            $xtitle_i .= '&nbsp;&nbsp;&nbsp;|';
			            for ($i = 1; $i <= $lev_i; ++$i) {
			                $xtitle_i .= '---';
			            }
			            $xtitle_i .= '>&nbsp;';
			        }
			        $xtitle_i .= $store['name'];
			        $sl = '';
			        if ($store['store_id'] == $_SESSION[$module_data . '_store_id']) {
			            $sl = ' selected="selected"';
			        }
					$option_store .= '<option value="' . $store['store_id'] . '" ' . $sl . '>' . $xtitle_i . '</option>';
				}
			 	
			}
		}
	
	}
	
	if($_SESSION[$module_data . '_store_id'] ==0 && defined('NV_IS_GODADMIN')){
		$list_users= new NukeViet\StoreHouse\Myclass;
		$error[] = $lang_module['no_member_on_store'];
	}else{
			$list_users = $db->query('SELECT su.userid,u.username, g.id, g.' . NV_LANG_DATA . '_title title, su.storeid store FROM ' . NV_USERS_GLOBALTABLE . ' u LEFT JOIN ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_users_stores su ON u.userid=su.userid LEFT JOIN 
									' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data  . '_groups_user gu ON u.userid = gu.userid LEFT JOIN ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_groups g ON g.id = gu.group_id  WHERE su.storeid IN (' . implode(',', $array_store) . ')')->fetchAll(5);
			$show_view = true;
	}
}

$xtpl = new XTemplate('users.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
$xtpl->assign('OP', $op); 
if ($show_view) {
	foreach ($list_users as $user) {
		$user->store = $array_store_storehouse[$user->store]['name'];
		$user->link_edit = NV_MY_DOMAIN . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&op=users_edit&userid='.$user->userid;
		$xtpl->assign('USER', $user);
		$xtpl->parse('main.view.loop');
	}
	$xtpl->parse('main.view');
}  
if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}else{
	$xtpl->parse('main.adduser');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');    
$page_title = $title_manager_store;

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';