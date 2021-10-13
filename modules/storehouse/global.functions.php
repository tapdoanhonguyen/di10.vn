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
$global_config['remote_api_access'] = 1;

$global_array_genders = array(
    'N' => array(
        'key' => 'N',
        'title' => $lang_module['na'],
        'selected' => ''
    ),
    'M' => array(
        'key' => 'M',
        'title' => $lang_module['male'],
        'selected' => ''
    ),
    'F' => array(
        'key' => 'F',
        'title' => $lang_module['female'],
        'selected' => ''
    )
);
	$global_array_status_vehicle = array();
	$global_array_status_vehicle[0] = $lang_module['vehicle_status_0'];
	$global_array_status_vehicle[1] = $lang_module['vehicle_status_1'];
	$global_array_status_vehicle[2] = $lang_module['vehicle_status_2'];
	
	$global_array_status_pro_sche = array();
	$global_array_status_pro_sche[0] = $lang_module['pro_sche_status_0'];
	$global_array_status_pro_sche[1] = $lang_module['pro_sche_status_1'];
	$global_array_status_pro_sche[2] = $lang_module['pro_sche_status_2'];
	$global_array_status_pro_sche[3] = $lang_module['pro_sche_status_3'];
	$global_array_status_pro_sche[4] = $lang_module['pro_sche_status_4'];
	$array_status = array();
$array_status[1] = 'Đang báo hàng';
$array_status[2] = 'Đang xử lý';
$array_status[3] = 'Đang đặt hàng';
$array_status[4] = 'Đã nhận hàng';
$array_status[5] = 'Đang giao hàng';
$array_status[6] = 'Đã trả hàng';

$array_sales_status = array();
$array_sales_status[0] = 'Chưa giao hàng';
$array_sales_status[1] = 'Đang báo hàng';
$array_sales_status[2] = 'Đang xử lý';
$array_sales_status[3] = 'Đang đặt hàng';
$array_sales_status[4] = 'Đang giao hàng';
$array_sales_status[5] = 'Đã giao hàng';
$array_sales_status[6] = 'Đã trả hàng';


$array_payment_status = array();
$array_payment_status[0] = 'Chưa thanh toán';
$array_payment_status[1] = 'Đang báo hàng';
$array_payment_status[2] = 'Đang xử lý';
$array_payment_status[3] = 'Chờ thanh toán'; 
$array_payment_status[4] = 'Đã thanh toán';
$array_payment_status[5] = 'Đang thanh toán';
	
function log_project($lang = '', $module_name ='', $proejectid = '', $saleid = '', $name_key = '', $note_action = '', $userid = 0, $status = 0)
{
    global $db_config, $db;
    $sth = $db->prepare('INSERT INTO ' . $db_config['dbsystem']. '.' .$db_config['prefix'] . '_' . $module_name . '_project_log
        (lang, projectid, saleid, name_key, note, userid, timemodify, status) VALUES
        (:lang, :projectid, :saleid, :name_key, :note, :userid, ' . NV_CURRENTTIME . ', :status)');
    $sth->bindParam(':lang', $lang, PDO::PARAM_STR);
    $sth->bindParam(':projectid', $proejectid, PDO::PARAM_STR);
    $sth->bindParam(':saleid', $saleid, PDO::PARAM_STR);
    $sth->bindParam(':name_key', $name_key, PDO::PARAM_STR);
    $sth->bindParam(':note', $note_action, PDO::PARAM_STR, strlen($note_action));
    $sth->bindParam(':userid', $userid, PDO::PARAM_INT);
    $sth->bindParam(':status', $status, PDO::PARAM_INT);
    if ($sth->execute()) {
        return true;
    }
    return false;
}
