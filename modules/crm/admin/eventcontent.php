<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

if( $nv_Request->isset_request( 'save', 'post' ) )
{
	$note = $nv_Request->get_string( 'note', 'post', '' );
    $customerid = $nv_Request->get_int( 'customerid', 'post', '' );
	$measureid = $nv_Request->get_int( 'measureid', 'post', '' );
	$eventtype = $nv_Request->get_int( 'eventtype', 'post', '' );
    $remkt_time = $nv_Request->get_title( 'remkt_time', 'post', '' );
    if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $remkt_time, $m ) )
    {
        $remkt_time = mktime( 0, 0, 0, $m[2], $m[1], $m[3] );
    }
    else
    {
        $remkt_time = 0;
    }
	$res = 'NO';
	try
	{
		$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_events (customerid, measureid, adminid, addtime, eventtype, content, remkt_time) VALUES ( :customerid, :measureid, :adminid, :addtime, :eventtype, :content, :remkt_time)' );

		$addtime = NV_CURRENTTIME;
		$stmt->bindParam( ':addtime', $addtime, PDO::PARAM_INT );
		$stmt->bindParam( ':customerid', $customerid, PDO::PARAM_STR );
		$stmt->bindParam( ':measureid', $measureid, PDO::PARAM_STR );
		$stmt->bindParam( ':adminid', $admin_info['userid'], PDO::PARAM_INT );
		$stmt->bindParam( ':eventtype', $eventtype, PDO::PARAM_INT );
		$stmt->bindParam( ':content', $note, PDO::PARAM_STR, strlen( $note ) );
        $stmt->bindParam( ':remkt_time', $remkt_time, PDO::PARAM_INT );

		$exc = $stmt->execute();
		if( $exc )
		{
            $db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET mkt_time=' . NV_CURRENTTIME . ' WHERE id=' . $customerid );
			$res = 'OK';
		}

	}
	catch ( PDOException $e )
	{
		$res = $e->getMessage();
	}
	exit( $res );
}

// Page title collum
$page = $nv_Request->get_int( 'page', 'get', 1 );
$per_page = 30;
$array = array();

$id = $nv_Request->get_int( 'id', 'get', 0 );
if( $id > 0 )
{
	$sql = "SELECT * FROM " . NV_PREFIXLANG . '_' . $module_data . " WHERE id=" . $id;
	$result = $db->query( $sql );
	$data_info = $result->fetch();
	if( empty( $data_info ) )
	{
		Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=customer" );
		exit();
	}
	if( $data_info['birthday'] > 0 )
	{
		$data_info['birthday'] = date( 'd/m/Y', $data_info['birthday'] );
	}
	else
	{
		$data_info['birthday'] = '';
	}
	$data_info['sex'] = $lang_module['sex_' . $data_info['sex']];
	$page_title = $lang_module['history_student_pagetitle'] . ' ' . $data_info['full_name'];

	$list_from = nv_From();
	$data_info['from_by'] = $list_from[$data_info['from_by']]['title'];
	$data_info['status_text'] = $array_customer_status[$data_info['status']];
	$sql = NV_PREFIXLANG . '_' . $module_data . "_events WHERE customerid=" . $id;
}
else
{

	Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=customer" );
	exit();
}

$sql_mod = "SELECT userid, username, email, first_name, last_name FROM " . NV_USERS_GLOBALTABLE;

$result = $db->query( $sql_mod );
while( $row = $result->fetch() )
{
	$row['full_name'] = nv_show_name_user( $row['first_name'], $row['last_name']);
	$array_mods[$row['userid']] = $row;
}

$list_event = nv_Eventtype();
$list_measure = nv_measure();

// Base data
$base_url = NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $op;

// Get num row
$db->sqlreset()->select( 'COUNT(*)' )->from( $sql );

$sth = $db->prepare( $db->sql() );
$sth->execute();
$num_items = $sth->fetchColumn();

// Build data
$db->select( '*' )->order( 'addtime DESC' )->limit( $per_page )->offset( ( $page - 1 ) * $per_page );
$sth = $db->prepare( $db->sql() );

$sth->execute();
while( $row = $sth->fetch() )
{
	$row['adminid'] = isset( $array_mods[$row['adminid']] ) ? $array_mods[$row['adminid']]['full_name'] : 'System';
	$row['addtime'] = date( 'd.m.Y H:i', $row['addtime'] );
    $row['color'] = isset( $list_event[$row['eventtype']] ) ? $list_event[$row['eventtype']]['color'] : '';
	$row['eventtype'] = isset( $list_event[$row['eventtype']] ) ? $list_event[$row['eventtype']]['title'] : 'N/A';
	$row['measureid'] = isset( $list_measure[$row['measureid']] ) ? $list_measure[$row['measureid']]['title'] : 'N/A';
	if( $row['customerid'] > 0 )
	{
		$row['link_users'] = NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=eventcontent&id=" . $row['customerid'];
	}
	$array[] = $row;
}

$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );

$xtpl = new XTemplate( $op . ".tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'module_file', $module_file );
$xtpl->assign( 'FORM_ACTION', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'id', $id );
$xtpl->assign( 'CHECKSESS', md5( "course_" . $admin_info['userid'] . "_" . session_id() ) );
$xtpl->assign( 'ROW', $data_info );

foreach( $list_event as $event )
{
	$xtpl->assign( 'EVENT', $event );
	$xtpl->parse( 'main.eventtype' );
}
foreach( $list_measure as $measure )
{
	$xtpl->assign( 'MEASURE', $measure );
	$xtpl->parse( 'main.measure' );
}
foreach( $array as $data )
{
    //$data['full_name'] = $data_info['full_name'];
    $data['remkt_time'] = ( $data['remkt_time'] > 0)? date('d/m/Y', $data['remkt_time'] ) : '';
	$xtpl->assign( 'VIEW', $data );
	$xtpl->parse( 'main.loop' );
}
if( ! empty( $generate_page ) )
{
	$xtpl->assign( 'GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.generate_page' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );
