<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
$proviceList = nv_Province();

$post['idprovince'] = $nv_Request->get_int( 'idprovince', 'get' );

$link_dis = "<a href=\"" . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=province\">" . $lang_module['province'] . " </a>";
$page_title = $link_dis;

$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_district WHERE status=1 AND idprovince= " . $post['idprovince'] . " ORDER BY weight ASC";

$result = $db->query( $sql );
$districtList = array();
while( $row = $result->fetch() )
{
	$districtList[$row['id']] = array( //
		'idprovince' => $row['idprovince'], //
		'title' => $row['title'], //
		'weight' => ( int )$row['weight'] //
			);
}

if( empty( $districtList ) and ! $nv_Request->isset_request( 'add', 'get' ) )
{
	Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=district&idprovince=" . $post['idprovince'] . "&add" );
	die();
}

if( $nv_Request->isset_request( 'cWeight, id', 'post' ) )
{
	$id = $nv_Request->get_int( 'id', 'post' );
	$cWeight = $nv_Request->get_int( 'cWeight', 'post' );
	if( ! isset( $districtList[$id] ) ) die( "ERROR" );

	if( $cWeight > ( $count = count( $districtList ) ) ) $cWeight = $count;

	$sql = "SELECT id FROM " . NV_PREFIXLANG . "_" . $module_data . "_district WHERE id!=" . $id . " AND idprovince= " . $post['idprovince'] . " ORDER BY weight ASC";
	$result = $db->query( $sql );
	$weight = 0;
	while( $row = $result->fetch() )
	{
		$weight++;
		if( $weight == $cWeight ) $weight++;
		$query = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_district SET weight=" . $weight . " WHERE id=" . $row['id'];
		$db->query( $query );
	}
	$query = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_district SET weight=" . $cWeight . " WHERE id=" . $id;
	$db->query( $query );
    $nv_Cache->delMod( $module_name );
	nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['logChangeWeight'], "Id: " . $id, $admin_info['userid'] );
	die( 'OK' );
}

if( $nv_Request->isset_request( 'del', 'post' ) )
{
	$id = $nv_Request->get_int( 'del', 'post', 0 );
	if( ! isset( $districtList[$id] ) ) die( $lang_module['errorDisNotExists'] );
	/*
	$sql = "SELECT COUNT(*) as count FROM " . NV_PREFIXLANG . "_" . $module_data . "_ward WHERE iddistrict=" . $id;
	$result = $db->query( $sql );
	$row = $result->fetch();
	if ( $row['count'] ) die( $lang_module['errorCatYesRow'] );
	*/
	$query = "DELETE FROM " . NV_PREFIXLANG . "_" . $module_data . "_district WHERE id = " . $id;

	$db->query( $query );
	fix_DisWeight( $post['idprovince'] );
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

$xtpl->assign( 'add', $lang_module['adddistrict'] . ' ' . $lang_module['thuoc'] . ' ' . $proviceList[$post['idprovince']]['title'] );
$xtpl->assign( 'op', 'district&idprovince=' );
$xtpl->assign( 'op1', $post['idprovince'] );

if( $nv_Request->isset_request( 'add', 'get' ) or $nv_Request->isset_request( 'edit, id', 'get' ) )
{
	$post = array();
	$post['idprovince'] = $nv_Request->get_int( 'idprovince', 'get' );
	if( $nv_Request->isset_request( 'edit', 'get' ) )
	{
		$post['id'] = $nv_Request->get_int( 'id', 'get' );
		$sql = "SELECT idprovince FROM " . NV_PREFIXLANG . "_" . $module_data . "_district WHERE status=1 AND id=" . $post['id'];
		$result = $db->query( $sql );

		list( $post['idprovince'] ) = $result->fetch( 3 );

		if( empty( $post['id'] ) or ! isset( $districtList[$post['id']] ) )
		{
			Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=district&idprovince=" . $post['idprovince'] );
			die();
		}

		$xtpl->assign( 'PTITLE', $lang_module['editdistrict'] . ' ' . $lang_module['thuoc'] . ' ' . $proviceList[$post['idprovince']]['title'] );
		$xtpl->assign( 'ACTION_URL', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=district&idprovince=" . $post['idprovince'] . "&edit&id=" . $post['id'] );
		$log_title = $lang_module['editdistrict'];
	}
	else
	{
		$xtpl->assign( 'PTITLE', $lang_module['adddistrict'] . $lang_module['thuoc'] . $proviceList[$post['idprovince']]['title'] );
		$xtpl->assign( 'ACTION_URL', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=district&idprovince=" . $post['idprovince'] . "&add" );
		$log_title = $lang_module['adddistrict'];
	}

	if( $nv_Request->isset_request( 'save', 'post' ) )
	{
		$post['title'] = $nv_Request->get_title( 'title', 'post', '', 1 );
		$post['idprovince'] = $nv_Request->get_int( 'pro', 'post' );
		if( empty( $post['title'] ) )
		{
			die( $lang_module['errorIsEmpty'] . ": " . $lang_module['title'] );
		}
		elseif( $post['idprovince'] == 0 )
		{
			die( $lang_module['no_province'] );
		}

		$alias = change_alias( $post['title'] );

		if( isset( $post['id'] ) )
		{
			$query = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_district SET idprovince= " . $post['idprovince'] . ", title=" . $db->quote( $post['title'] ) . " WHERE id=" . $post['id'];
			$db->query( $query );
		}
		else
		{
			$sql = "SELECT id FROM " . NV_PREFIXLANG . "_" . $module_data . "_district WHERE status=1 AND idprovince= " . $post['idprovince'] . " ORDER BY weight ASC";
			$result = $db->query( $sql );
			$List = array();
			while( $row = $result->fetch() )
			{
				$List[$row['id']] = array( //
						'id' => $row['id'] //
						);
			}

			$weight = count( $List );
			$weight++;

			$query = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_district VALUES (NULL, " . $post['idprovince'] . "," . $db->quote( $post['title'] ) . "," . $weight . ",1)";
			$db->insert_id( $query );

		}

        $nv_Cache->delMod( $module_name );
		nv_insert_logs( NV_LANG_DATA, $module_name, $log_title, "Id: " . $post['id'], $admin_info['userid'] );
		die( "OK_" . $post['idprovince'] );
	}

	$post['title'] = ( $nv_Request->isset_request( 'edit', 'get' ) ) ? $districtList[$post['id']]['title'] : "";

	$xtpl->assign( 'CAT', $post );
	if( $nv_Request->isset_request( 'edit', 'get' ) )
	{
		$xtpl->assign( 'province', $proviceList[$post['idprovince']]['title'] );
		$xtpl->parse( 'action.province.edit_province' );
	}

	elseif( $nv_Request->isset_request( 'add', 'get' ) )
	{
		if( ! empty( $proviceList ) )
		{
			foreach( $proviceList as $k => $p )
			{
				$p['selected'] = ( $k == $post['idprovince'] ) ? 'selected="selected"' : '';
				$p['id'] = $k;
				$xtpl->assign( 'NEWWEIGHT', $p );
				$xtpl->parse( 'action.province.add_province.option' );
			}
			$xtpl->parse( 'action.province.add_province' );
		}
	}

	$xtpl->parse( 'action.province' );
	$xtpl->parse( 'action' );
	$contents = $xtpl->text( 'action' );

	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme( $contents );
	include NV_ROOTDIR . '/includes/footer.php';
	exit();
}

if( $nv_Request->isset_request( 'list', 'get' ) )
{

	$a = 0;
	$count = count( $districtList );

	foreach( $districtList as $id => $values )
	{

		$values['id'] = $id;
		$values['alink1'] = '';
		$values['alink2'] = '';
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
	exit();
}

$xtpl->parse( 'main.allow_link_add' );

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

?>