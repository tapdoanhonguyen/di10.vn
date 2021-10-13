<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 12/31/2009 0:51
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}
$array_supplier_id_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies WHERE group_id = 2';
$_query = $db_slave->query($_sql);
while ($_row = $_query->fetch()) {
    $array_supplier_id_storehouse[$_row['id']] = $_row;
}
$array_customer_id_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies WHERE group_id = 1';
$_query = $db_slave->query($_sql);
while ($_row = $_query->fetch()) {
    $array_customer_id_storehouse[$_row['id']] = $_row;
}

//$array_customer_id_storehouse  = $array_supplier_id_storehouse;

$array_warehouse_id_storehouse = array();
$_sql = 'SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_warehouses';
$_query  = $db_slave->query($_sql);
$array_warehouses_storehouse = array();
$array_warehouses_storehouse[0] = array('id' => '0', 'name' => $lang_module['systems_warehouse']);
while ($_row = $_query->fetch()) {
    $array_warehouses_storehouse[$_row['id']] = $_row;
}

function nv_groups_storehouse_list($mod_data = 'users')
{
    global $nv_Cache;
    $cache_file = NV_LANG_DATA . '_groups_list_' . NV_CACHE_PREFIX . '_' . $mod_data . '.cache';
    if (($cache = $nv_Cache->getItem($mod_data, $cache_file)) != false) {
        return unserialize($cache);
    } else {
        global $db, $db_config, $global_config, $lang_global;

        $groups = array();
        $_mod_table = ($mod_data == 'users') ? NV_USERS_GLOBALTABLE : $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $mod_data;
        $result = $db->query('SELECT id, ' . NV_LANG_DATA . '_title title, idsite FROM ' . $_mod_table . '_groups WHERE (idsite = ' . $global_config['idsite'] . ' OR (idsite =0 AND siteus = 1)) ORDER BY idsite, weight');
        while ($row = $result->fetch()) {
            if ($row['id'] < 2) {
                $row['title'] = $lang_global['level' . $row['id']];
            }
            $groups[$row['id']] = ($global_config['idsite'] > 0 and empty($row['idsite'])) ? '<strong>' . $row['title'] . '</strong>' : $row['title'];
        }
        $nv_Cache->setItem($mod_data, $cache_file, serialize($groups));

        return $groups;
    }
}

