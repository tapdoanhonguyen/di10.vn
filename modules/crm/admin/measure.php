<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

if( $nv_Request->isset_request( 'get_alias_title', 'post' ) )
{
	$alias = $nv_Request->get_title( 'get_alias_title', 'post', '' );
	$alias = change_alias( $alias );
	die( $alias );
}

if( $nv_Request->isset_request( 'ajax_action', 'post' ) )
{
	$measure_id = $nv_Request->get_int( 'measure_id', 'post', 0 );
	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );
	$content = 'NO_' . $measure_id;
	if( $new_vid > 0 )
	{
		$sql = 'SELECT measure_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_measure WHERE measure_id!=' . $measure_id . ' ORDER BY weight ASC';
		$result = $db->query( $sql );
		$weight = 0;
		while( $row = $result->fetch() )
		{
			++$weight;
			if( $weight == $new_vid ) ++$weight;
			$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_measure SET weight=' . $weight . ' WHERE measure_id=' . $row['measure_id'];
			$db->query( $sql );
		}
		$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_measure SET weight=' . $new_vid . ' WHERE measure_id=' . $measure_id;
		$db->query( $sql );
		$content = 'OK_' . $measure_id;
	}
	$nv_Cache->delMod( $module_name );
	include NV_ROOTDIR . '/includes/header.php';
	echo $content;
	include NV_ROOTDIR . '/includes/footer.php';
	exit();
}
if( $nv_Request->isset_request( 'delete_measure_id', 'get' ) and $nv_Request->isset_request( 'delete_checkss', 'get' ) )
{
	$measure_id = $nv_Request->get_int( 'delete_measure_id', 'get' );
	$delete_checkss = $nv_Request->get_string( 'delete_checkss', 'get' );
	if( $measure_id > 0 and $delete_checkss == md5( $measure_id . NV_CACHE_PREFIX . $client_info['session_id'] ) )
	{
		$weight = 0;
		$sql = 'SELECT weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_measure WHERE measure_id =' . $db->quote( $measure_id );
		$result = $db->query( $sql );
		list( $weight ) = $result->fetch( 3 );

		$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_measure  WHERE measure_id = ' . $db->quote( $measure_id ) );
		if( $weight > 0 )
		{
			$sql = 'SELECT measure_id, weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_measure WHERE weight >' . $weight;
			$result = $db->query( $sql );
			while( list( $measure_id, $weight ) = $result->fetch( 3 ) )
			{
				$weight--;
				$db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_measure SET weight=' . $weight . ' WHERE measure_id=' . intval( $measure_id ) );
			}
		}
        $nv_Cache->delMod( $module_name );
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}

$row = array();
$error = array();
$row['measure_id'] = $nv_Request->get_int( 'measure_id', 'post,get', 0 );
if( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['measure_name'] = $nv_Request->get_title( 'measure_name', 'post', '' );
	$row['status'] = $nv_Request->get_int( 'status', 'post', 0 );

	if( empty( $row['measure_name'] ) )
	{
		$error[] = $lang_module['error_required_measure_name'];
	}

	if( empty( $error ) )
	{
		try
		{
			if( empty( $row['measure_id'] ) )
			{
				$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_measure (measure_name, weight, status) VALUES (:measure_name, :weight, :status)' );

				$weight = $db->query( 'SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_measure' )->fetchColumn();
				$weight = intval( $weight ) + 1;
				$stmt->bindParam( ':weight', $weight, PDO::PARAM_INT );

			}
			else
			{
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_measure SET measure_name = :measure_name, status = :status WHERE measure_id=' . $row['measure_id'] );
			}
			$stmt->bindParam( ':measure_name', $row['measure_name'], PDO::PARAM_STR );
			$stmt->bindParam( ':status', $row['status'], PDO::PARAM_INT );

			$exc = $stmt->execute();
			if( $exc )
			{
				$nv_Cache->delMod( $module_name );
				Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
				die();
			}
		}
		catch ( PDOException $e )
		{
			trigger_error( $e->getMessage() );
			die( $e->getMessage() ); //Remove this line after checks finished
		}
	}
}
elseif( $row['measure_id'] > 0 )
{
	$row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_measure WHERE measure_id=' . $row['measure_id'] )->fetch();
	if( empty( $row ) )
	{
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}
else
{
	$row['measure_id'] = 0;
	$row['measure_name'] = '';
	$row['status'] = 1;
}

// Fetch Limit
$show_view = false;
if( ! $nv_Request->isset_request( 'id', 'post,get' ) )
{
	$show_view = true;
	$page = $nv_Request->get_int( 'page', 'post,get', 1 );
	$db->sqlreset()->select( 'COUNT(*)' )->from( '' . NV_PREFIXLANG . '_' . $module_data . '_measure' );
	$sth = $db->prepare( $db->sql() );
	$sth->execute();
	$num_items = $sth->fetchColumn();

	$db->select( '*' )->order( 'weight ASC' );
	$sth = $db->prepare( $db->sql() );
	$sth->execute();
}

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );

if( $show_view )
{
	while( $view = $sth->fetch() )
	{
		$view['status'] = $lang_module['status_' . $view['status']];
		$view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;measure_id=' . $view['measure_id'];
		$view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_measure_id=' . $view['measure_id'] . '&amp;delete_checkss=' . md5( $view['measure_id'] . NV_CACHE_PREFIX . $client_info['session_id'] );
		$xtpl->assign( 'VIEW', $view );

        for( $i = 1; $i <= $num_items; ++$i )
        {
            $xtpl->assign( 'WEIGHT', array(
                'key' => $i,
                'title' => $i,
                'selected' => ( $i == $view['weight'] ) ? ' selected="selected"' : '' ) );
            $xtpl->parse( 'main.view.loop.weight_loop' );
        }
		$xtpl->parse( 'main.view.loop' );
	}
	$xtpl->parse( 'main.view' );
}

if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', implode( '<br />', $error ) );
	$xtpl->parse( 'main.error' );
}

$array_select_status = array();

$array_select_status[0] = $lang_module['status_0'];
$array_select_status[1] = $lang_module['status_1'];
foreach( $array_select_status as $key => $title )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $key,
		'title' => $title,
		'selected' => ( $key == $row['status'] ) ? ' selected="selected"' : '' ) );
	$xtpl->parse( 'main.select_status' );
}
if( empty( $row['measure_id'] ) )
{
	$xtpl->parse( 'main.auto_get_alias' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['measure'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
