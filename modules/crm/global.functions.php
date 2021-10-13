<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if (!defined('NV_MAINFILE')) die('Stop!!!');

$array_config = $module_config[$module_name];
define('NV_IS_TABLE_SHOPS', $db_config['prefix'] . "_".$array_config['module']);
function nv_get_user_info($user_id)
{
    global $module_name, $db;
    $_sql = 'SELECT * FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $user_id;
    $array_users = $db->query($_sql)->fetch();
    $array_users['fullname'] = nv_show_name_user($array_users['first_name'], $array_users['last_name'], $array_users['username']);
    return $array_users;
}


$array_personal_sms = array(
    '[FULLNAME]' => $lang_module['content_note_fullname'],
    '[MOBILE]' => $lang_module['content_note_phone'],
    '[TENBAOGIA]' => $lang_module['content_tenbaogia'],
    '[EMAIL]' => $lang_module['content_note_email'],
    '[ADDRESS]' => $lang_module['content_note_address'],
    '[ALIAS]' => $lang_module['content_note_alias'],
    '[SITE_NAME]' => sprintf($lang_module['content_note_site_name'], $global_config['site_name']),
    '[SITE_DOMAIN]' => sprintf($lang_module['content_note_site_domain'], NV_MY_DOMAIN)
);

$array_customer_status = array(
    '0' => $lang_module['customer_status_0'],
    '1' => $lang_module['customer_status_1'],
    '2' => $lang_module['customer_status_2']);

function nv_Province()
{
    global $db, $module_data;

    $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_province WHERE status=1 ORDER BY weight ASC";
    $result = $db->query( $sql );
    $list = array();
    while( $row = $result->fetch() )
    {
        $list[$row['id']] = array( //
            'id' => $row['id'], //
            'title' => $row['title'], //
            'weight' => ( int )$row['weight'] //
        );
    }

    return $list;
}


function nv_District( $provinceid = 0 )
{
    global $db, $module_data;

    if( $provinceid == 0 ){
        $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_district WHERE status=1 ORDER BY weight ASC";
    }else{
        $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_district WHERE status=1 AND idprovince= " . $provinceid . " ORDER BY weight ASC";
    }

    $result = $db->query( $sql );
    $list = array();
    while( $row = $result->fetch() )
    {
        $list[$row['id']] = array( //
            'id' => $row['id'], //
            'idprovince' => $row['idprovince'], //
            'title' => $row['title'], //
            'weight' => ( int )$row['weight'] //
        );
    }
    return $list;
}


function nv_From()
{
    global $db, $module_data;

    $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_from WHERE status=1 ORDER BY weight ASC";
    $result = $db->query( $sql );
    $list = array();
    while( $row = $result->fetch() )
    {
        $list[$row['from_id']] = array( //
            'id' => $row['from_id'], //
            'title' => $row['from_name'], //
            'weight' => ( int )$row['weight'] //
        );
    }
    return $list;
}


function nv_Eventtype()
{
    global $db, $module_data;

    $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_eventtype WHERE status=1 ORDER BY weight ASC";
    $result = $db->query( $sql );
    $list = array();
    while( $row = $result->fetch() )
    {
        $list[$row['eventtype_id']] = array( //
            'id' => $row['eventtype_id'], //
            'title' => $row['eventtype_name'], //
            'color' => $row['color'], //
            'weight' => ( int )$row['weight'] //
        );
    }
    return $list;
}
function nv_measure()
{
    global $db, $module_data;

    $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_measure WHERE status=1 ORDER BY weight ASC";
    $result = $db->query( $sql );
    $list = array();
    while( $row = $result->fetch() )
    {
        $list[$row['measure_id']] = array( //
            'id' => $row['measure_id'], //
            'title' => $row['measure_name'], //
            'weight' => ( int )$row['weight'] //
        );
    }
    return $list;
}

function save_eventcontent( $customerid, $measureid, $eventtype, $note )
{
    global $db, $user_info, $module_data;
    if( $customerid > 0 && ! empty( $note ) )
    {
        try
        {
            $stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . "_" . $module_data . '_events (customerid, measureid, adminid, addtime, eventtype, content) VALUES ( :customerid, :measureid, :adminid, :addtime, :eventtype, :content)' );

            $addtime = NV_CURRENTTIME;
            $stmt->bindParam( ':addtime', $addtime, PDO::PARAM_INT );
            $stmt->bindParam( ':customerid', $customerid, PDO::PARAM_STR );
            $stmt->bindParam( ':measureid', $measureid, PDO::PARAM_STR );
            $stmt->bindParam( ':adminid', intval( $user_info['userid'] ), PDO::PARAM_INT );
            $stmt->bindParam( ':eventtype', $eventtype, PDO::PARAM_INT );
            $stmt->bindParam( ':content', $note, PDO::PARAM_STR, strlen( $note ) );

            $exc = $stmt->execute();
            if( $exc )
            {
                return 1;
            }

        }
        catch ( PDOException $e )
        {
            die($e->getMessage());
        }
        return 0;
    }
    return 0;
}

function check_phone_avaible( $string ){
    $string = str_replace(array('-', '.', ' '), '', $string);

    if (!preg_match('/^(01[2689]|03|05|07|08|09)[0-9]{8}$/', $string)){
        return 0;
    }
    return $string;

}