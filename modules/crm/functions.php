<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_CRM', true);
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

$array_gender = array(
    1 => $lang_module['male'],
    0 => $lang_module['female']
);

function nv_customer_delete($customerid)
{
    global $db, $module_data;

    $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer WHERE id = ' . $customerid);
    if ($count) {
        // xóa dữ liệu bảng khách hàng - dịch vụ
        $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer_products WHERE id_customer = ' . $customerid);

        // xóa dữ liệu bảng khách hàng - sản phẩm
        //$db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_customer_services WHERE id_customer = ' . $customerid);
    }
}

function nv_workforce_delete($id)
{
    global $db, $module_data;

    $count = $db->exec('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_workforce WHERE id = ' . $id);
    if ($count) {
        //
    }
}

function nv_workforce_check_premission()
{
    global $array_config, $user_info;

    if (empty($array_config['groups_manage'])) {
        return false;
    } elseif (!empty(array_intersect(explode(',', $array_config['groups_manage']), $user_info['in_groups']))) {
        return true;
    }
    return false;
}


/**
 * nv_jsonOutput()
 *
 * @param array $array_data
 * @return void
 */
function nv_jsonOutput($array_data)
{
    Header('Cache-Control: no-cache, must-revalidate');
    Header('Content-type: application/json');

    if (defined('NV_ADMIN') or NV_ANTI_IFRAME != 0) {
        Header('X-Frame-Options: SAMEORIGIN');
    }

    Header('X-Content-Type-Options: nosniff');
    Header('X-XSS-Protection: 1; mode=block');

    ob_start('ob_gzhandler');
    echo json_encode($array_data);
    exit(0);
}

function sendsms($content, $mobile ){
    global $module_config;
    $apikey = $module_config['sm']['apikey'];
    $secretkey = $module_config['sm']['secretkey'];
    $sms_type = $module_config['sm']['sms_type'];
    $url = '';
    if( $sms_type == 2 ){
        $url = '&Brandname=' . $module_config['sm']['brandname'];
    }

    $content = urlencode($content);

    $data = 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=' . $mobile . '&ApiKey=' . $apikey . '&SecretKey=' . $secretkey . '&Content=' . $content . '&SmsType=' . $sms_type . $url;

    $curl = curl_init($data);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($curl);
    $obj = json_decode($result, true);

    if ($obj['CodeResult'] == '100') {
        //gui thanh cong
    }else{
        //gui loi
    }
}