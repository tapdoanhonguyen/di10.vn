<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );


$q = $nv_Request->get_title( 'term', 'get', '', 1 );
if( empty( $q ) ) return;

$db->sqlreset()->select( 'id, product_code, ' . NV_LANG_INTERFACE . '_title AS title' )->from( $db_config['prefix'] . '_shops_rows' )->where( NV_LANG_INTERFACE . '_title LIKE :title OR product_code LIKE :product_code' )->limit( 20 );

$sth = $db->prepare( $db->sql() );
$sth->bindValue( ':title', '%' . $q . '%', PDO::PARAM_STR );
$sth->bindValue( ':product_code', '%' . $q . '%', PDO::PARAM_STR );
$sth->execute();

$array_data = array();
while( list( $id, $code, $title ) = $sth->fetch( 3 ) )
{
    $array_data[] = array(
        'key' => $id,
        'value' => $code . ' - ' . $title,
    );
}

header( 'Cache-Control: no-cache, must-revalidate' );
header( 'Content-type: application/json' );

ob_start( 'ob_gzhandler' );
echo json_encode( $array_data );
exit();
