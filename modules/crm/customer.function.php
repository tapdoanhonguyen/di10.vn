<?php
/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */
$function_module['error_required_full_name']  = 'Tên khách hàng không bỏ trống';
$function_module['error_number_phone_format'] = 'Số điện thoại không đúng chuẩn';

function check_phone_avaible( $string ){
    $string = str_replace(array('-', '.', ' '), '', $string);

    if (!preg_match('/^(01[2689]|03|05|07|08|09)[0-9]{8}$/', $string)){
        return 0;
    }
    return $string;

}

//update cham soc khach hang
function actionCustomerData( $full_name, $mobile, $email, $address, $userid = 0 )
{
    global $db, $user_info, $function_module;

    $pos = strrpos( $full_name, ' ' );
    if( $pos === false )
    {
        $first_name = '';
        $last_name = $full_name;
    }
    else
    {
        $first_name = substr( $full_name, 0, $pos + 1 );
        $last_name = substr( $full_name, $pos );
    }


    if( empty( $full_name ) )
    {
        $error['order_name'] = $function_module['error_required_full_name'];
    }
    $check_phone = check_phone_avaible($mobile);
    if( $check_phone == 0 )
    {
        $error['order_phone'] = $function_module['error_number_phone_format'];
    }

    if( empty( $error )){

        //$sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_crm WHERE full_name=' . $db->quote($full_name ) . ' AND mobile=' . $db->quote($mobile );
        $sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_crm WHERE mobile=' . $db->quote($mobile );
        list( $customerid ) = $db->query( $sql )->fetch(3);
        if( $customerid == 0 ){
            $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_crm ( adminid, provinceid, districtid, first_name, last_name, full_name, birthday, sex, address, email, mobile, gmap_lat, gmap_lng, from_by, add_time, edit_time, status) 
        VALUES (:adminid, 0, 0, :first_name, :last_name, :full_name, 0, 0, :address, :email, :mobile, 0, 0, 0, ' . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', 1)';
            $data_insert = array();
            $data_insert['adminid'] = isset( $user_info['userid'] )? $user_info['userid'] : $userid;
            $data_insert['first_name'] = $first_name;
            $data_insert['last_name'] = $last_name;
            $data_insert['full_name'] = $full_name;
            $data_insert['address'] = $address;
            $data_insert['email'] = $email;
            $data_insert['mobile'] = $mobile;
            $new_id = $db->insert_id($_sql, 'id', $data_insert);
            if( $new_id > 0 ){
                return array('customerid' => $new_id);
            }
        }else{
            return array('customerid' => $customerid);
        }
    }else{
        return array('customerid' => 0, 'message' => $error);
    }
}


//tao noi dung cham soc khach hang
function nvInsertSmsQueue( $data_content, $sendtype )
{
    global $db;

    $customer['phone'] = $data_content['order_phone'];
    $customer['fullname'] = $data_content['order_name'];
    $customer['email'] = $data_content['order_email'];
    $customer['address'] = $data_content['order_address'];
    $customer['order_quotation'] = $data_content['order_quotation'];
    $customer['gender'] = 0;
    if( $data_content['customerid'] > 0 ){
        $sql = 'SELECT sex FROM ' . NV_PREFIXLANG . '_crm WHERE id=' . $data_content['customerid'];
        list( $customer['gender'] ) = $db->query( $sql )->fetch(3);
    }

    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_crm_smsconfig WHERE status=1 AND sendtype=' . $sendtype;
    $result = $db->query($sql);
    while ( $row = $result->fetch()){

        //co nguoi nhan thi moi tao noi dung cham soc
        if( !empty( $customer['phone'] )){
            $content = nv_build_content_customer( $row['content'], $customer);

            //neu mua hang nhan ngay thi chinh lai thoi gian gui sms ngay sau thoi diem mua hang 1h
           $timesend = NV_CURRENTTIME + ( $row['daysend'] * 86400 ) + ($row['hoursend'] * 3600);

            $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_crm_sms_queue( order_id, proid, smsconfigid, mobile, content, timesend, active ) 
            VALUES (  ' . intval( $data_content['order_id'] ) . ', 0, ' . intval( $row['id'] ) . ', ' . $db->quote( $customer['phone'] ) . ', ' . $db->quote( $content ) . ', ' . $timesend . ', 1)';
            $db->query($sql);
        }
    }
}


function nv_build_content_customer($content, $customer)
{
    global $global_config, $lang_module;

    $content = nv_unhtmlspecialchars($content);
    // Thay the bien noi dung
    $array_replace = array(
        '[FULLNAME]' => !empty($customer['fullname']) ? $customer['fullname'] : $lang_module['customers'],
        '[MOBILE]' => $customer['phone'],
        '[EMAIL]' => $customer['email'],
        '[TENBAOGIA]' => $customer['order_quotation'],
        '[ADDRESS]' => $customer['address'],
        '[ALIAS]' => $lang_module['alias_' . $customer['gender']],
        '[SITE_NAME]' => $global_config['site_name'],
        '[SITE_DOMAIN]' => NV_MY_DOMAIN
    );
    foreach ($array_replace as $index => $value) {
        $content = str_replace($index, $value, $content);
    }
    return $content;
}
