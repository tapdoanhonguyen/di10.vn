<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */

if (!defined('NV_IS_FILE_SITEINFO'))
    die('Stop!!!');

$lang_siteinfo = nv_get_lang_module($mod);

/*
// Tổng số bài viết
$number = $db->query('SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $mod_data . '_rows where status= 1 AND publtime < ' . NV_CURRENTTIME . ' AND (exptime=0 OR exptime>' . NV_CURRENTTIME . ')')->fetchColumn();
if ($number > 0) {
    $siteinfo[] = array(
        'key' => $lang_siteinfo['siteinfo_publtime'],
        'value' => $number
    );
}
*/
