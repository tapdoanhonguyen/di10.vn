<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */

if (!defined('NV_MAINFILE'))
    die('Stop!!!');

$module_version = array(
    'name' => 'Storehouse',
    'modfuncs' => 'main,detail,search,ajax,store-list,pos,production-plan,working,customer,supplier,avatar',
    'change_alias' => 'main,detail,search,ajax,store-list',
    'submenu' => 'detail,pos,production-plan,working,customer,supplier',
    'is_sysmod' => 0,
    'virtual' => 1,
    'version' => '4.3.03',
    'date' => 'Fri, 10 Aug 2018 07:54:46 GMT',
    'author' => 'Thuong Mai So (hoangnt@nguyenvan.vn)',
    'uploads_dir' => array($module_name, $module_name.'/company', $module_name.'/products'),
    'note' => 'Module Quản lý kho hàng'
);
