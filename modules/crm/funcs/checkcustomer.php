<?php
/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */
if( !defined('NV_IS_USER') ){
    nv_jsonOutput(array('status' => 0));
    exit();
}
if( $nv_Request->isset_request( 'check', 'post' ) )
{
    $mobile = $nv_Request->get_title( 'mobile', 'post', '' );

    if( defined('NV_IS_ADMIN') ){
        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE mobile=' . $db->quote( $mobile ) ;
    }else{
        //$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE adminid=' . $user_info['userid'] . ' AND mobile=' . $db->quote( $mobile ) ;
        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE mobile=' . $db->quote( $mobile ) ;
    }
    $data_content = $db->query($sql)->fetch();
    if( !empty( $data_content )){
        nv_jsonOutput( $data_content );
    }else{
        nv_jsonOutput(array('status' => 0));
    }
    exit();
}