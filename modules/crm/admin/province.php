<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
$proviceList = nv_Province();
$page_title = $lang_module['main'];

if( empty( $proviceList ) and ! $nv_Request->isset_request( 'add', 'get' ) )
{
	Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op . "&add" );
	die();
}

if( $nv_Request->isset_request( 'cWeight, id', 'post' ) )
{
	$id = $nv_Request->get_int( 'id', 'post' );
	$cWeight = $nv_Request->get_int( 'cWeight', 'post' );
	if( ! isset( $proviceList[$id] ) ) die( "ERROR" );

	if( $cWeight > ( $count = count( $proviceList ) ) ) $cWeight = $count;

	$sql = "SELECT id FROM " . NV_PREFIXLANG . "_" . $module_data . "_province WHERE id!=" . $id . " ORDER BY weight ASC";
	$result = $db->query( $sql );
	$weight = 0;
	while( $row = $result->fetch() )
	{
		$weight++;
		if( $weight == $cWeight ) $weight++;
		$query = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_province SET weight=" . $weight . " WHERE id=" . $row['id'];
		$db->query( $query );
	}
	$query = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_province SET weight=" . $cWeight . " WHERE id=" . $id;
	$db->query( $query );
    $nv_Cache->delMod( $module_name );
	nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['logChangeWeight'], "Id: " . $id, $admin_info['userid'] );
	die( 'OK' );
}

if( $nv_Request->isset_request( 'del', 'post' ) )
{
	$id = $nv_Request->get_int( 'del', 'post', 0 );
	if( ! isset( $proviceList[$id] ) ) die( $lang_module['errorCatNotExists'] );
	$sql = "SELECT COUNT(*) FROM " . NV_PREFIXLANG . "_" . $module_data . "_district WHERE idprovince=" . $id;
	$result = $db->query( $sql );
	$count = $result->fetchColumn();
	if( $count > 0 ) die( $lang_module['errorCatYesRow'] );

	$query = "DELETE FROM " . NV_PREFIXLANG . "_" . $module_data . "_province WHERE id = " . $id;
	$db->query( $query );
	fix_catWeight();
    $nv_Cache->delMod( $module_name );
	nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['logDelCat'], "Id: " . $id, $admin_info['userid'] );
	die( 'OK' );
}

$xtpl = new XTemplate( "province.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'MODULE_URL', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE );
$xtpl->assign( 'UPLOADS_DIR_USER', NV_UPLOADS_DIR . '/' . $module_name );
$xtpl->assign( 'UPLOAD_CURRENT', NV_UPLOADS_DIR . '/' . $module_name );

$xtpl->assign( 'add', $lang_module['addprovince'] );
$xtpl->assign( 'op', 'province' );

if( $nv_Request->isset_request( 'add', 'get' ) or $nv_Request->isset_request( 'edit, id', 'get' ) )
{
	$post = array();
	if( $nv_Request->isset_request( 'edit', 'get' ) )
	{
		$post['id'] = $nv_Request->get_int( 'id', 'get' );
		if( empty( $post['id'] ) or ! isset( $proviceList[$post['id']] ) )
		{
			Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=province" );
			die();
		}

		$xtpl->assign( 'PTITLE', $lang_module['editprovince'] );
		$xtpl->assign( 'ACTION_URL', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=province&edit&id=" . $post['id'] );
		$log_title = $lang_module['editprovince'];
	}
	else
	{
		$xtpl->assign( 'PTITLE', $lang_module['addprovince'] );
		$xtpl->assign( 'ACTION_URL', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=province&add" );
		$log_title = $lang_module['addprovince'];
	}

	if( $nv_Request->isset_request( 'save', 'post' ) )
	{
		$post['title'] = $nv_Request->get_title( 'title', 'post', '', 1 );

		if( empty( $post['title'] ) )
		{
			die( $lang_module['errorIsEmpty'] . ": " . $lang_module['title'] );
		}

		$alias = change_alias( $post['title'] );

		if( isset( $post['id'] ) )
		{
			$query = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_province SET title=" . $db->quote( $post['title'] ) . " WHERE id=" . $post['id'];
			$db->query( $query );
		}
		else
		{
			$weight = count( $proviceList );
			$weight++;

			$query = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_province VALUES (NULL, " . $db->quote( $post['title'] ) . "," . $weight . ",1)";

			$db->query( $query );
		}

        $nv_Cache->delMod( $module_name );
		nv_insert_logs( NV_LANG_DATA, $module_name, $log_title, "Id: " . $post['id'], $admin_info['userid'] );
		die( 'OK' );
	}

	$post['title'] = ( $nv_Request->isset_request( 'edit', 'get' ) ) ? $proviceList[$post['id']]['title'] : "";

	$xtpl->assign( 'CAT', $post );
	$xtpl->parse( 'action' );
	$contents = $xtpl->text( 'action' );

	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme( $contents );
	include NV_ROOTDIR . '/includes/footer.php';
	exit;
}

if( $nv_Request->isset_request( 'list', 'get' ) )
{

	$a = 0;

	$count = count( $proviceList );
	foreach( $proviceList as $id => $values )
	{
		$values['id'] = $id;
		$values['alink1'] = "<a href=" . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=district&idprovince=" . $id . ">";
		$values['alink2'] = "</a>";
		$xtpl->assign( 'LOOP', $values );

		$xtpl->assign( 'CLASS', $a % 2 ? " class=\"second\"" : "" );


        for( $i = 1; $i <= $count; $i++ )
        {
            $opt = array( 'value' => $i, 'selected' => $i == $values['weight'] ? " selected=\"selected\"" : "" );
            $xtpl->assign( 'NEWWEIGHT', $opt );
            $xtpl->parse( 'list.loop.sort_weight.option' );
        }
        $xtpl->parse( 'list.loop.sort_weight' );
        $xtpl->parse( 'list.loop.allow_edit' );
        $xtpl->parse( 'list.loop.allow_del' );

		$xtpl->parse( 'list.loop' );
		$a++;
	}
	$xtpl->parse( 'list' );
	$xtpl->out( 'list' );
	exit;
}

$xtpl->parse( 'main.allow_link_add' );
$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

?>