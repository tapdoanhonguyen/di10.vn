<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */
if (!defined('NV_IS_MOD_CRM')) die('Stop!!!');

$mod = $nv_Request->get_title('mod', 'get', '');
if ($mod == 'queue' && $module_config[$module_name]['sms_on'] == 1) {
    
    set_time_limit(0);
    $apikey = $module_config[$module_name]['apikey'];
    $secretkey = $module_config[$module_name]['secretkey'];
    $sms_type = $module_config[$module_name]['sms_type'];
    $url = '';
    if( $sms_type == 2 ){
        $url = '&Brandname=' . $module_config[$module_name]['brandname'];
    }
    $result = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sms_queue WHERE active=1 AND timesend<=' . NV_CURRENTTIME );
    while ($row = $result->fetch()) {
        
        $content = urlencode($row['content']);
        $row['mobile'] = str_replace(array(' ', '.', '-'), array('','',''), $row['mobile']);
        $data = 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=' . $row['mobile'] . '&ApiKey=' . $apikey . '&SecretKey=' . $secretkey . '&Content=' . $content . '&SmsType=' . $sms_type . $url;
        $curl = curl_init($data);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result_i = curl_exec($curl);
        $obj = json_decode($result_i, true);
        
        if ($obj['CodeResult'] == '100') {
            $db->query( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_sms_history( order_id, smsconfigid, mobile, content, timesend, sendtype, timesent, smsid, status ) 
                VALUES (  ' . intval( $row['order_id'] ) . ', ' . intval( $row['smsconfigid'] ) . ', ' . $db->quote( $row['mobile'] ) . ', ' . $db->quote( $row['content'] ) . ', ' . $row['timesend'] . ',0, ' .  NV_CURRENTTIME . ', ' . $db->quote( $obj['SMSID'] ) . ', 0)');

            $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_sms_queue WHERE id=' . $row['id']);
        }else{
            if( $obj['CodeResult'] == '99'){
                //sdt khong dung
                $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_sms_queue SET active=0 WHERE id=' . $row['id']);
            }
            print_r($obj);die;
            //ghi lai loi
        }

    }
	file_put_contents( NV_ROOTDIR . '/a.txt', date('d/m/Y H:i', NV_CURRENTTIME ) );
    exit('1');
}else{
    file_put_contents( NV_ROOTDIR . '/b.txt', date('d/m/Y H:i', NV_CURRENTTIME ) );
}
exit('No query');