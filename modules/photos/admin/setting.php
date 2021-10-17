<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */

if( !defined( 'NV_IS_FILE_ADMIN' ) )
	die( 'Stop!!!' );

$page_title = $lang_module['setting'];

$savesetting = $nv_Request->get_int( 'savesetting', 'post', 0 );
if( !empty( $savesetting ) )
{
	$photo_setting = array( );
	$photo_setting['origin_size_width'] = $nv_Request->get_int( 'origin_size_width', 'post', 0 );
	$photo_setting['origin_size_height'] = $nv_Request->get_int( 'origin_size_height', 'post', 0 );
	$photo_setting['cr_thumb_width'] = $nv_Request->get_int( 'cr_thumb_width', 'post', 0 );
	$photo_setting['cr_thumb_height'] = $nv_Request->get_int( 'cr_thumb_height', 'post', 0 );
	$photo_setting['cr_thumb_quality'] = $nv_Request->get_int( 'cr_thumb_quality', 'post', 0 );
	$photo_setting['per_line'] = $nv_Request->get_int( 'per_line', 'post', 0 );
	$photo_setting['per_page_album'] = $nv_Request->get_int( 'per_page_album', 'post', 0 );
	$photo_setting['per_page_photo'] = $nv_Request->get_int( 'per_page_photo', 'post', 20 );
	$photo_setting['home_title_cut'] = $nv_Request->get_int( 'home_title_cut', 'post', 20 );
	$photo_setting['home_view'] = $nv_Request->get_title( 'home_view', 'post', '', 0 );
	$photo_setting['home_layout'] = nv_substr( $nv_Request->get_title( 'home_layout', 'post', '', '' ), 0, 255 );
	$photo_setting['album_view'] = $nv_Request->get_title( 'album_view', 'post', '', 0 );
	$photo_setting['module_logo'] = $nv_Request->get_title( 'module_logo', 'post', '', 0 );
	$photo_setting['social_tool'] = $nv_Request->get_int( 'social_tool', 'post', 0 );
	$photo_setting['fbappid'] = $nv_Request->get_int( 'fbappid', 'post', 0 );
	$photo_setting['active_logo'] = $nv_Request->get_int( 'active_logo', 'post', 0 );
	$photo_setting['autologosize1'] = $nv_Request->get_int( 'autologosize1', 'post', 50 );
	$photo_setting['autologosize2'] = $nv_Request->get_int( 'autologosize2', 'post', 40 );
	$photo_setting['autologosize3'] = $nv_Request->get_int( 'autologosize3', 'post', 30 );
	$photo_setting['logo_position'] = $nv_Request->get_title( 'logo_position', 'post', 'bottom_right' );
	$photo_setting['structure_upload'] = $nv_Request->get_title( 'structure_upload', 'post', '', 0 );
	$photo_setting['maxupload'] = $nv_Request->get_int( 'maxupload', 'post', 0 );
	$photo_setting['maxupload'] = min( nv_converttoBytes( ini_get( 'upload_max_filesize' ) ), nv_converttoBytes( ini_get( 'post_max_size' ) ), $photo_setting['maxupload'] );

	if( !nv_is_url( $photo_setting['module_logo'] ) and file_exists( NV_DOCUMENT_ROOT . $photo_setting['module_logo'] ) )
	{
		$lu = strlen( NV_BASE_SITEURL );
		$photo_setting['module_logo'] = substr( $photo_setting['module_logo'], $lu );
	}
	elseif( !nv_is_url( $photo_setting['module_logo'] ) )
	{
		$photo_setting['module_logo'] = $global_config['site_logo'];
	}

	$sth = $db->prepare( "UPDATE " . NV_CONFIG_GLOBALTABLE . " SET config_value = :config_value WHERE lang = '" . NV_LANG_DATA . "' AND module = :module_name AND config_name = :config_name" );
	$sth->bindParam( ':module_name', $module_name, PDO::PARAM_STR );
	foreach( $photo_setting as $config_name => $config_value )
	{
		$sth->bindParam( ':config_name', $config_name, PDO::PARAM_STR );
		$sth->bindParam( ':config_value', $config_value, PDO::PARAM_STR );
		$sth->execute( );
	}
	$sth->closeCursor( );

	$nv_Cache->delMod( 'settings' );
	$nv_Cache->delMod( $module_name );
	$nv_Request->set_Session( $module_data . '_success', $lang_module['setting_update_success'] );
	Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&rand=' . nv_genpass( ) );
	die( );
}

$selectthemes = (!empty( $site_mods[$module_name]['theme'] )) ? $site_mods[$module_name]['theme'] : $global_config['site_theme'];
$layout_array = nv_scandir( NV_ROOTDIR . '/themes/' . $selectthemes . '/layout', $global_config['check_op_layout'] );

$module_logo = ( isset( $module_config[$module_name]['module_logo'] )) ? $module_config[$module_name]['module_logo'] : '';
$module_logo = (!nv_is_url( $module_logo ) && !empty( $module_config[$module_name]['module_logo'] )) ? NV_BASE_SITEURL . $module_logo : $module_logo;

$module_config[$module_name]['social_tool'] = ($module_config[$module_name]['social_tool'] == 1) ? 'checked="checked"' : '';
$module_config[$module_name]['active_logo'] = ($module_config[$module_name]['active_logo'] == 1) ? 'checked="checked"' : '';

$xtpl = new XTemplate( 'setting.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_FILE', $module_file );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'DATA', $module_config[$module_name] );
$xtpl->assign( 'MODULE_LOGO', $module_logo );
$xtpl->assign( 'PATH', defined( 'NV_IS_SPADMIN' ) ? '' : NV_UPLOADS_DIR . '/' . $module_upload );
$xtpl->assign( 'CURRENTPATH', defined( 'NV_IS_SPADMIN' ) ? 'images' : NV_UPLOADS_DIR . '/' . $module_upload );
$xtpl->assign( 'CANCEL', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name );

if( $nv_Request->get_string( $module_data . '_success', 'session' ) )
{
	$xtpl->assign( 'SUCCESS', $nv_Request->get_string( $module_data . '_success', 'session' ) );
	$xtpl->parse( 'main.success' );
	$nv_Request->unset_request( $module_data . '_success', 'session' );
}

foreach( $array_home_view as $key => $title )
{
	$xtpl->assign( 'HOME_VIEW', array(
		'key' => $key,
		'title' => $title,
		'selected' => $key == $module_config[$module_name]['home_view'] ? ' selected="selected"' : ''
	) );
	$xtpl->parse( 'main.home_view' );
}

//Set home_layout
foreach( $layout_array as $value )
{
	$value = preg_replace( $global_config['check_op_layout'], '\\1', $value );
	$xtpl->assign( 'LAYOUT', array(
		'key' => $value,
		'selected' => ($module_config[$module_name]['home_layout'] == $value) ? ' selected="selected"' : ''
	) );
	$xtpl->parse( 'main.home_layout' );
}

foreach( $array_album_view as $key => $title )
{
	$xtpl->assign( 'ALBUM_VIEW', array(
		'key' => $key,
		'title' => $title,
		'selected' => $key == $module_config[$module_name]['album_view'] ? ' selected="selected"' : ''
	) );
	$xtpl->parse( 'main.album_view' );

}
// Hien thi tren mot dong
for( $ln = 2; $ln <= 4; ++$ln )
{
	$xtpl->assign( 'PER_LINE', array(
		'key' => $ln,
		'title' => $ln,
		'selected' => $module_config[$module_name]['per_line'] == $ln ? 'selected="selected"' : ''
	) );
	$xtpl->parse( 'main.per_line' );
}
// So bai viet tren mot trang
for( $i = 2; $i <= 60; ++$i )
{
	$xtpl->assign( 'PER_PAGE_ALBUM', array(
		'key' => $i,
		'title' => $i,
		'selected' => $i == $module_config[$module_name]['per_page_album'] ? ' selected="selected"' : ''
	) );
	$xtpl->parse( 'main.per_page_album' );
}
for( $i = 2; $i <= 60; ++$i )
{
	$xtpl->assign( 'PER_PAGE_PHOTO', array(
		'key' => $i,
		'title' => $i,
		'selected' => $i == $module_config[$module_name]['per_page_photo'] ? ' selected="selected"' : ''
	) );
	$xtpl->parse( 'main.per_page_photo' );
}

$array_structure_image = array( );
$array_structure_image[''] = NV_UPLOADS_DIR . '/' . $module_upload;
$array_structure_image['Y'] = NV_UPLOADS_DIR . '/' . $module_upload . '/' . date( 'Y' );
$array_structure_image['Ym'] = NV_UPLOADS_DIR . '/' . $module_upload . '/' . date( 'Y_m' );
$array_structure_image['Y_m'] = NV_UPLOADS_DIR . '/' . $module_upload . '/' . date( 'Y/m' );
$array_structure_image['Ym_d'] = NV_UPLOADS_DIR . '/' . $module_upload . '/' . date( 'Y_m/d' );
$array_structure_image['Y_m_d'] = NV_UPLOADS_DIR . '/' . $module_upload . '/' . date( 'Y/m/d' );

$structure_image_upload = isset( $module_config[$module_name]['structure_upload'] ) ? $module_config[$module_name]['structure_upload'] : "Ym";

// Thu muc uploads
foreach( $array_structure_image as $type => $dir )
{
	$xtpl->assign( 'STRUCTURE_UPLOAD', array(
		'key' => $type,
		'title' => $dir . '/' . $lang_module['setting_dir_album'],
		'selected' => $type == $structure_image_upload ? ' selected="selected"' : ''
	) );
	$xtpl->parse( 'main.structure_upload' );
}

$array_logoposition = array(
	'' => $lang_module['upload_logo_pos'],
	'bottom_right' => $lang_module['logoposbottomright'],
	'bottom_left' => $lang_module['logoposbottomleft'],
	'bottom_center' => $lang_module['logoposbottomcenter'],
	'center_right' => $lang_module['logoposcenterright'],
	'center_left' => $lang_module['logoposcenterleft'],
	'center_center' => $lang_module['logoposcentercenter'],
	'top_right' => $lang_module['logopostopright'],
	'top_left' => $lang_module['logopostopleft'],
	'top_center' => $lang_module['logopostopcenter']
);

// Vi tri Logo

foreach ($array_logoposition as $key => $val) {
    $xtpl->assign('logopos', array(
        'key' => $key,
        'title' => $val,
        'selected' => $key == $module_config[$module_name]['logo_position'] ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.logopos');
}


$sys_max_size = min( nv_converttoBytes( ini_get( 'upload_max_filesize' ) ), nv_converttoBytes( ini_get( 'post_max_size' ) ) );
$p_size = $sys_max_size / 100;

$xtpl->assign( 'SYS_MAX_SIZE', nv_convertfromBytes( $sys_max_size ) );

$data_maxupload = min( nv_converttoBytes( ini_get( 'upload_max_filesize' ) ), nv_converttoBytes( ini_get( 'post_max_size' ) ), $module_config[$module_name]['maxupload'] );
for( $index = 100; $index > 0; --$index )
{
	$size1 = floor( $index * $p_size );

	$xtpl->assign( 'SIZE1', array(
		'key' => $size1,
		'title' => nv_convertfromBytes( $size1 ),
		'selected' => ($data_maxupload == $size1) ? ' selected=\'selected\'' : ''
	) );

	$xtpl->parse( 'main.size1' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
