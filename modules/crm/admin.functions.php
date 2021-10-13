<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN')) die('Stop!!!');

define('NV_IS_FILE_ADMIN', true);

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

$allow_func = array(
    'main',
    'config',
    'configemail',
    'list-email',
    'contentsms',
    'statistics',
    'statisticspro',
    'statisticsuser',
    'order_seller',
    'customer',
    'eventtype',
    'eventcontent',
    'measure',
    'province',
    'district',
    'from',
    'list-sms',
    'smsconfig',
    'sms-queue',
    'sms-sent',
    'productajax',
    'hoahong'
);



//update noi dung cham soc khach hang
function nvUpdatemsQueueByDetail( $sid_detail, $active, $insert, $scenarioid )
{
    global $db, $module_data;

    //tao kich ban khi them ban ghi moi
    if( $insert == 1 ){
        //lay thong tin bang header
        $data_scenario_header = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_scenario_header WHERE id=' . $scenarioid )->fetch();

        $result = $db->query('SELECT order_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_orders_id WHERE proid=' . $data_scenario_header['proid']);
        while( list( $order_id ) = $result->fetch(3)){
            $data_order = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_orders WHERE order_id=' . $order_id )->fetch();
            if(!empty( $data_order )) {
                $day_received = ($data_order['order_shipcod'] == 1) ? NV_DEFINE_DAY_RECEIVED : 0;
                $booktime = $data_order['order_time'];

                $customer['phone'] = $data_order['order_phone'];
                $customer['fullname'] = $data_order['order_name'];
                $customer['email'] = $data_order['order_email'];
                $customer['address'] = $data_order['order_address'];
                $customer['gender'] = 2;
                $receiver = '';

                $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_scenario_detail WHERE id =' . $sid_detail;
                $row = $db->query($sql)->fetch();

                if ($row['sendtype'] == 1 || $row['sendtype'] == 3) {
                    $receiver = $data_order['order_phone'];
                } elseif ($row['sendtype'] == 2) {
                    $receiver = $data_order['order_email'];
                }

                //co nguoi nhan thi moi tao noi dung cham soc
                if (!empty($receiver)) {

                    $title = nv_build_content_customer($row['sendtype'], $row['title'], $customer);
                    $content = nv_build_content_customer($row['sendtype'], $row['content'], $customer);

                    //neu mua hang nhan ngay thi chinh lai thoi gian gui sms ngay sau thoi diem mua hang 1h
                    $timesend = 0;
                    if ($day_received == 0 && $row['daysend'] == 0) {
                        $timesend = $booktime + 3600;
                    } else {
                        $timesend = $booktime + (($day_received + $row['daysend']) * 86400);
                    }

                    //neu thoi gian gui sms thoa man dk lon hon thoi diem hien tai
                    if ($timesend > NV_CURRENTTIME) {
                        $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_message_queue( order_id, proid, sid, sid_detail, title, receiver, content, timesend, sendtype, active ) 
                        VALUES (  ' . intval($order_id) . ', ' . intval($data_scenario_header['proid']) . ', ' . intval($row['scenarioid']) . ', ' . intval($row['id']) . ', ' . $db->quote($title) . ', ' . $db->quote($receiver) . ', ' . $db->quote($content) . ', ' . $timesend . ', ' . intval($row['sendtype']) . ', ' . intval($active) . ')';
                        $db->query($sql);
                    }
                }
            }
        }
    }else{
        $result = $db->query('SELECT id, order_id, proid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_message_queue WHERE sid_detail=' . $sid_detail );

        while ( list( $id, $order_id, $proid ) = $result->fetch(3)){
            //lay thong tin don hang dat cua kh
            $data_order = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_orders WHERE order_id=' . $order_id )->fetch();
            if(!empty( $data_order )){
                $day_received = ($data_order['order_shipcod'] == 1) ? NV_DEFINE_DAY_RECEIVED : 0;
                $booktime = $data_order['order_time'];

                $customer['phone'] = $data_order['order_phone'];
                $customer['fullname'] = $data_order['order_name'];
                $customer['email'] = $data_order['order_email'];
                $customer['address'] = $data_order['order_address'];
                $customer['gender'] = 2;

                $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_scenario_detail WHERE id =' . $sid_detail;
                $row = $db->query($sql)->fetch();

                $receiver = '';
                if( $row['sendtype'] == 1 || $row['sendtype'] == 3 ){
                    $receiver = $data_order['order_phone'];
                }elseif( $row['sendtype'] == 2 ){
                    $receiver = $data_order['order_email'];
                }
                //co nguoi nhan thi moi tao noi dung cham soc
                if( !empty( $receiver )){
                    $title = nv_build_content_customer($row['sendtype'], $row['title'], $customer);
                    $content = nv_build_content_customer($row['sendtype'], $row['content'], $customer);

                    //neu mua hang nhan ngay thi chinh lai thoi gian gui sms ngay sau thoi diem mua hang 1h
                    $timesend = 0;
                    if( $day_received == 0 && $row['daysend'] == 0){
                        $timesend = $booktime + 3600;
                    }
                    else{
                        $timesend = $booktime + (( $day_received + $row['daysend']) * 86400 );
                    }

                    $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_message_queue SET 
                    order_id=' . intval( $order_id ) . ', proid=' . intval( $proid ) . ', 
                    sid=' . intval( $row['scenarioid'] ) . ', 
                    sid_detail=' . intval( $row['id'] ) . ', 
                    title=' . $db->quote( $title ) . ', 
                    receiver=' . $db->quote( $receiver ) . ', 
                    content=' . $db->quote( $content ) . ', 
                    timesend=' . $timesend . ', 
                    sendtype=' . intval( $row['sendtype'] ) . ', active=' . $active . ' WHERE id=' . $id;
                    $db->query($sql);

                }
            }
        }
    }

}