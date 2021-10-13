<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */

if (!defined('NV_SYSTEM'))
    die('Stop!!!');

define('NV_IS_MOD_STOREHOUSE', true);
 if(!defined('IDSITE')) define('IDSITE', 0);
require_once NV_ROOTDIR . '/modules/' . $module_file . '/site.functions.php';
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
require_once NV_ROOTDIR . '/modules/' . $module_file . '/storehouse.class.php';
if(!empty($user_info['userid'])){
	$userid =  $user_info['userid'];
}else{
	$userid = 0;
}
$permission = new NukeViet\StoreHouse\StoreHouse;
$admin_permission = $permission->checkpermission($userid);
//print_r($admin_permission);die;
$groups = $permission->check_user_group($userid);
$is_leader = $permission->check_user_group_leader($userid,$groups);
//print_r($groups);die;