<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */

if( !defined( 'NV_IS_FILE_MODULES' ) )
	die( 'Stop!!!' );

$sql_drop_module = array( );
$array_table = array(
	'category',
	'album',
	'rows',
	'rating',
	'setting',
	'favorite'
);
$table = $db_config['prefix'] . '_' . $lang . '_' . $module_data;
$result = $db->query( 'SHOW TABLE STATUS LIKE ' . $db->quote( $table . '_%' ) );
while( $item = $result->fetch( ) )
{
	$name = substr( $item['name'], strlen( $table ) + 1 );
	if( preg_match( '/^' . $db_config['prefix'] . '\_' . $lang . '\_' . $module_data . '\_/', $item['name'] ) and (preg_match( '/^([0-9]+)$/', $name ) or in_array( $name, $array_table )) )
	{
		$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $item['name'];
	}
}

$result = $db->query( "SHOW TABLE STATUS LIKE '" . $db_config['prefix'] . "\_" . $lang . "\_comment'" );
$rows = $result->fetchAll( );
if( sizeof( $rows ) )
{
	$sql_drop_module[] = "DELETE FROM " . $db_config['prefix'] . "_" . $lang . "_comment WHERE module='" . $module_name . "'";
}

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_album (
	album_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	category_id mediumint(8) unsigned NOT NULL default '0',
	name varchar(250) NOT NULL default '',
	alias varchar(250) NOT NULL default '',
	description mediumtext NOT NULL,
	meta_title varchar(250) NOT NULL,
	meta_description varchar(250) NOT NULL,
	meta_keyword varchar(250) NOT NULL,
	tag varchar(250) NOT NULL default '',
	model varchar(250) NOT NULL default '',
	capturedate varchar(250) NOT NULL default '0',
	capturelocal varchar(250) NOT NULL default '',
	folder varchar( 250 ) NOT NULL default '',
	layout varchar( 50 ) NOT NULL default '',
	num_photo mediumint(3) unsigned NOT NULL default '0',
	viewed mediumint(8) unsigned NOT NULL default '0',
	weight smallint(4) unsigned NOT NULL default '0',
	sort mediumint(8) NOT NULL default '0',
	allow_rating int(11) unsigned NOT NULL default '1',
	total_rating int(11) NOT NULL default '0',
	click_rating int(11) NOT NULL default '0',
	favorite int(11) UNSIGNED NOT NULL DEFAULT '0',
	status tinyint(1) NOT NULL default '1',
	groups_view varchar(250) default '',
	author int(11) UNSIGNED NOT NULL DEFAULT '0',
	author_modify int(11) UNSIGNED NOT NULL DEFAULT '0',
	allow_comment varchar(250) default '',
	hitscm mediumint(8) unsigned NOT NULL default '0',
	date_added int(11) unsigned NOT NULL default '0',
	date_modified int(11) unsigned NOT NULL default '0',
	PRIMARY KEY (album_id),
	KEY category_id (category_id),
	KEY alias (alias)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_category (
	category_id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
	parent_id smallint(5) unsigned NOT NULL default '0',
	name varchar(250) NOT NULL,
	alias varchar(250) NOT NULL default '',
	description text,
	meta_title varchar(250) NOT NULL,
	meta_description varchar(250) NOT NULL,
	meta_keyword varchar(250) NOT NULL,
	weight smallint(5) unsigned NOT NULL default '0',
	sort_order smallint(5) NOT NULL default '0',
	lev smallint(5) NOT NULL default '0',
	layout varchar(50) NOT NULL default '',
	viewcat varchar(50) NOT NULL default 'viewcat_page_new',
	numsubcat smallint(5) NOT NULL default '0',
	subcatid varchar(250) default '',
	inhome tinyint(1) unsigned NOT NULL default '0',
	status tinyint(1) unsigned NOT NULL default '0',
	numlinks tinyint(2) unsigned NOT NULL default '3',
	num_album mediumint(8) unsigned NOT NULL default '0',
	groups_view varchar(250) default '',
	date_added int(11) unsigned NOT NULL default '0',
	date_modified int(11) unsigned NOT NULL default '0',
	PRIMARY KEY (category_id),
	UNIQUE KEY alias (alias),
	KEY parent_id (parent_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (
  row_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  album_id mediumint(8) unsigned NOT NULL DEFAULT '0',
  name varchar(250) NOT NULL DEFAULT '',
  description varchar(250) NOT NULL DEFAULT '',
  defaults tinyint(1) unsigned NOT NULL DEFAULT '0',
  size int(11) unsigned NOT NULL DEFAULT '0',
  width mediumint(8) unsigned NOT NULL DEFAULT '0',
  height mediumint(8) unsigned NOT NULL DEFAULT '0',
  mime varchar(100) NOT NULL DEFAULT '',
  file varchar(250) NOT NULL,
  thumb varchar(250) NOT NULL,
  favorite int(11) NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL DEFAULT '1',
  viewed mediumint(8) unsigned NOT NULL default '0',
  date_added int(11) unsigned NOT NULL DEFAULT '0',
  date_modified int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (row_id)
) ENGINE=MyISAM";

// Module sidplay setting
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'origin_size_width', '1500')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'origin_size_height', '1500')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'cr_thumb_width', '270')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'cr_thumb_height', '210')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'cr_thumb_quality', '90')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'per_line', '3')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'home_view', 'home_view_grid_by_album')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'home_layout', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'album_view', 'album_view_grid')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'home_title_cut', '60')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'per_page_album', '30')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'per_page_photo', '30')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'social_tool', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'fbappid', '')";

$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'structure_upload', 'Y_m')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'maxupload', '2684354')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'active_logo', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'autologosize1', '50')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'autologosize2', '40')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'autologosize3', '30')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'module_logo', 'images/logo.png')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'logo_position', 'bottom_right')";

// Nukeviet Comments
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'auto_postcomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowed_comm', '-1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'view_comm', '6')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'setcomm', '4')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'activecomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'emailcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'adminscomm', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'sortcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'captcha', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'perpagecomm', '5')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'timeoutcomm', '360')";
