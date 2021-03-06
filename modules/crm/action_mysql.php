<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if ( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data;
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_eventtype";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_events";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_measure";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_from";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_emailmarketting";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_emailqueue";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_smsconfig";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_sms_queue";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_sms_history";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district";

$sql_create_module = $sql_drop_module;

//bang thong tin khach hang
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . " (
 id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 adminid mediumint(8) unsigned NULL,
 provinceid mediumint(8) unsigned NOT NULL,
 districtid mediumint(8) unsigned NOT NULL,
 first_name varchar(150) NOT NULL,
 last_name varchar(150) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
 full_name varchar(150) NOT NULL,
 birthday int(11) NOT NULL DEFAULT '0' COMMENT 'Ng??y sinh',
 sex tinyint(1) unsigned NOT NULL DEFAULT '0',
 address varchar(250) NOT NULL COMMENT '?????a ch???',
 email varchar(100) NOT NULL COMMENT 'Email',
 mobile varchar(20) NOT NULL COMMENT 'S??T di ?????ng',
 facebook varchar(100) NOT NULL COMMENT 'Facebook',
 from_by tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'D??? li???u t??? k??nh',
 gmap_lat float DEFAULT '0' COMMENT 'V?? ?????',
 gmap_lng float DEFAULT '0' COMMENT 'Kinh ?????',
 add_time int(11) NOT NULL DEFAULT '0',
 edit_time int(11) NOT NULL DEFAULT '0',
 mkt_time int(11) NULL DEFAULT '0',
 status tinyint(1) unsigned NOT NULL DEFAULT '0',
 note varchar(250) NULL DEFAULT NULL,
 PRIMARY KEY (id),
 UNIQUE KEY full_name (full_name, mobile)
) ENGINE=MyISAM";

//bang du c??c s??? ki???n
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_eventtype (
 eventtype_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 eventtype_name VARCHAR(150) NOT NULL,
 color VARCHAR(15) NOT NULL DEFAULT '',
 weight smallint(4) NOT NULL DEFAULT '0' COMMENT 'STT',
 status tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 : Hi???n th???, 0 ???n',
 PRIMARY KEY (eventtype_id)
) ENGINE=MyISAM";

//bang ghi thong tin c??c h??nh d???ng c???a h???c sinh
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_events (
 eventid int(10) unsigned NOT NULL AUTO_INCREMENT,
 customerid mediumint(8) unsigned NOT NULL,
 measureid smallint(5) unsigned NOT NULL,
 adminid mediumint(8) unsigned NOT NULL,
 addtime int(11) NOT NULL DEFAULT '0',
 eventtype tinyint(1) unsigned NOT NULL DEFAULT '0',
 content text COMMENT 'N???i dung',
 remkt_time int(11) NULL DEFAULT '0',
 PRIMARY KEY (eventid)
) ENGINE=MyISAM";

//bang thang do tiem nang khi MKT
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_measure (
 measure_id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
 measure_name VARCHAR(150) NOT NULL,
 weight smallint(4) NOT NULL DEFAULT '0' COMMENT 'STT',
 status tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 : Hi???n th???, 0 ???n',
 PRIMARY KEY (measure_id)
) ENGINE=MyISAM";

//bang du lieu tu kenh nao
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_from (
 from_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 from_name VARCHAR(150) NOT NULL,
 weight smallint(4) NOT NULL DEFAULT '0' COMMENT 'STT',
 status tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 : Hi???n th???, 0 ???n',
 PRIMARY KEY (from_id)
) ENGINE=MyISAM";

//kich ban cham soc chi tiet
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_emailmarketting (
 id int(10) unsigned NOT NULL auto_increment,
 title varchar(250) NULL,
 content TEXT NOT NULL,
 addtime int(10) unsigned NOT NULL default '0',
 status tinyint(1) NOT NULL,
 PRIMARY KEY (id)
 ) ENGINE=MyISAM";

//Email Queue
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_emailqueue (
 id int(10) unsigned NOT NULL auto_increment,
 title varchar(250) NOT NULL,
 receiver varchar(250) NOT NULL COMMENT 'Enail ng?????i nh???n',
 content TEXT NOT NULL,
 active tinyint(1) NOT NULL COMMENT '1: k??ch ho???t, 0 kh??ng',
 PRIMARY KEY (id),
 KEY active (active)
) ENGINE=MyISAM";

//kich ban cham soc kh qua sms
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_smsconfig (
 id int(10) unsigned NOT NULL auto_increment,
 content TEXT NOT NULL,
 daysend smallint(4) unsigned NOT NULL default '0' COMMENT 'G???i v??o ng??y th??? m???y k??? t??? khi co action',
 hoursend tinyint(1) unsigned NOT NULL default '0' COMMENT 'Gi??? s??? g???i tin',
 addtime int(10) unsigned NOT NULL default '0',
 sendtype tinyint(1) NOT NULL COMMENT '1: khi gui mail don hang, 2: khi xac nhan don',
 status tinyint(1) NOT NULL,
 PRIMARY KEY (id),
 KEY sendtype (sendtype)
) ENGINE=MyISAM";

//Message Queue
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_sms_queue (
 id int(10) unsigned NOT NULL auto_increment,
 order_id int(10) unsigned NOT NULL,
 proid int(10) unsigned NOT NULL,
 smsconfigid int(10) unsigned NOT NULL COMMENT 'ID bang smsconfig',
 mobile varchar(20) NOT NULL COMMENT 'S??T nguoi nhan',
 content TEXT NOT NULL,
 timesend int(10) unsigned NOT NULL default '0',
 active tinyint(1) NOT NULL COMMENT '1: k??ch ho???t, 0 kh??ng',
 PRIMARY KEY (id),
 KEY timesend (timesend),
 KEY active (active)
) ENGINE=MyISAM";

//Message history
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_sms_history (
 id int(10) unsigned NOT NULL auto_increment,
 order_id int(10) unsigned NOT NULL,
 smsconfigid int(10) unsigned NOT NULL COMMENT 'ID bang smsconfig',
 mobile varchar(20) NOT NULL COMMENT 'S??T nguoi nhan',
 content TEXT NOT NULL,
 timesend int(10) unsigned NOT NULL default '0',
 sendtype tinyint(1) NOT NULL COMMENT '1: khi gui mail don hang, 2: khi xac nhan don',
 timesent int(10) unsigned NOT NULL default '0',
 smsid varchar(50) NOT NULL default '',
 status tinyint(1) NOT NULL,
 PRIMARY KEY (id),
 KEY timesend (timesend)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (
id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
title varchar(50) NOT NULL DEFAULT '',
weight smallint(4) unsigned NOT NULL DEFAULT '0',
status tinyint(1) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (
id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
idprovince mediumint(8) unsigned NOT NULL DEFAULT '0',
title varchar(50) NOT NULL DEFAULT '',
weight smallint(4) unsigned NOT NULL DEFAULT '0',
status tinyint(1) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (id)
) ENGINE=MyISAM";

$data = array();
$data['sms_on'] = 1;
$data['sms_type'] = 2;
$data['apikey'] = '';
$data['secretkey'] = '';
$data['brandname'] = '';
$data['bonus'] = '10';//thuong cho NVKD khi ban hang co lai
$data['permissions_users'] = '';
foreach ($data as $config_name => $config_value) {
    $sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote($module_name) . ", " . $db->quote($config_name) . ", " . $db->quote($config_value) . ")";
}



$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (2, 'H?? N???i', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (1, 'H??? Ch?? Minh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (3, 'An Giang', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (4, 'B?? R???a - V??ng T??u', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (5, 'B???c C???n', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (6, 'B???c Giang', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (7, 'B???c Li??u', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (8, 'B???c Ninh', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (9, 'B???n Tre', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (10, 'B??nh ?????nh', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (11, 'B??nh D????ng', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (12, 'B??nh Ph?????c', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (13, 'B??nh Thu???n', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (14, 'C?? Mau', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (15, 'C???n Th??', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (16, 'Cao B???ng', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (17, '???? N???ng', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (18, '?????c L???c', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (19, '?????k N??ng', 19, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (20, '??i???n Bi??n', 20, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (21, '?????ng Nai', 21, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (22, '?????ng Th??p', 22, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (23, 'Gia Lai', 23, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (24, 'H?? Giang', 24, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (25, 'H?? Nam', 25, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (26, 'H?? T??nh', 26, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (27, 'H???i D????ng', 27, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (28, 'H???i Ph??ng', 28, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (29, 'H???u Giang', 29, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (30, 'H??a B??nh', 30, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (31, 'H??ng Y??n', 31, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (32, 'Kh??nh H??a', 32, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (33, 'Ki??n Giang', 33, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (34, 'Kon Tum', 34, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (35, 'Lai Ch??u', 35, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (36, 'L??m ?????ng', 36, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (37, 'L???ng S??n', 37, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (38, 'L??o Cai', 38, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (39, 'Long An', 39, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (40, 'Nam ?????nh', 40, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (41, 'Ngh??? An', 41, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (42, 'Ninh B??nh', 42, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (43, 'Ninh Thu???n', 43, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (44, 'Ph?? Th???', 44, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (45, 'Ph?? Y??n', 45, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (46, 'Qu???ng B??nh', 46, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (47, 'Qu???ng Nam', 47, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (48, 'Qu???ng Ng??i', 48, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (49, 'Qu???ng Ninh', 49, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (50, 'Qu???ng Tr???', 50, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (51, 'S??c Tr??ng', 51, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (52, 'S??n La', 52, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (53, 'T??y Ninh', 53, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (54, 'Th??i B??nh', 54, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (55, 'Th??i Nguy??n', 55, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (56, 'Thanh Ho??', 56, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (57, 'Th???a Thi??n - Hu???', 57, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (58, 'Ti???n Giang', 58, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (59, 'Tr?? Vinh', 59, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (60, 'Tuy??n Quang', 60, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (61, 'V??nh Long', 61, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (62, 'V??nh Ph??c', 62, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (63, 'Y??n B??i', 63, 1)";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (1, 2, 'Qu???n Ba ????nh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (2, 2, 'Qu???n Ho??n Ki???m', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (3, 2, 'Qu???n Hai B?? Tr??ng', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (4, 2, 'Qu???n ?????ng ??a', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (5, 2, 'Qu???n T??y H???', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (6, 2, 'Qu???n C???u Gi???y', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (7, 2, 'Qu???n Thanh Xu??n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (8, 2, 'Qu???n Ho??ng Mai', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (9, 2, 'Qu???n Long Bi??n', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (10, 2, 'Huy???n T??? Li??m', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (11, 2, 'Huy???n Thanh Tr??', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (12, 2, 'Huy???n Gia L??m', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (13, 2, 'Huy???n ????ng Anh', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (14, 2, 'Huy???n S??c S??n', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (15, 2, 'Th??nh ph??? H?? ????ng', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (16, 2, 'Th??nh ph??? S??n T??y', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (17, 2, 'Huy???n Ba V??', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (18, 2, 'Huy???n Ph??c Th???', 19, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (19, 2, 'Huy???n Th???ch Th???t', 23, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (20, 2, 'Huy???n Qu???c Oai', 22, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (21, 2, 'Huy???n Ch????ng M???', 24, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (22, 2, 'Huy???n ??an Ph?????ng', 20, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (23, 2, 'Huy???n Ho??i ?????c', 21, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (24, 2, 'Huy???n Thanh Oai', 25, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (25, 2, 'Huy???n M??? ?????c', 29, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (26, 2, 'Huy???n ???ng H??a', 28, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (27, 2, 'Huy???n Th?????ng T??n', 26, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (28, 2, 'Huy???n Ph?? Xuy??n', 27, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (29, 2, 'Huy???n M?? Linh', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (30, 1, 'Qu???n 1', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (31, 1, 'Qu???n 2', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (32, 1, 'Qu???n 3', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (33, 1, 'Qu???n 4', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (34, 1, 'Qu???n 5', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (35, 1, 'Qu???n 6', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (36, 1, 'Qu???n 7', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (37, 1, 'Qu???n 8', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (38, 1, 'Qu???n 9', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (39, 1, 'Qu???n 10', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (40, 1, 'Qu???n 11', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (41, 1, 'Qu???n 12', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (42, 1, 'Qu???n G?? V???p', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (43, 1, 'Qu???n T??n B??nh', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (44, 1, 'Qu???n T??n Ph??', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (45, 1, 'Qu???n B??nh Th???nh', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (46, 1, 'Qu???n Ph?? Nhu???n', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (47, 1, 'Qu???n Th??? ?????c', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (48, 1, 'Qu???n B??nh T??n', 19, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (49, 1, 'Huy???n B??nh Ch??nh', 20, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (50, 1, 'Huy???n C??? Chi', 21, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (51, 1, 'Huy???n H??c M??n', 22, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (52, 1, 'Huy???n Nh?? B??', 23, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (53, 1, 'Huy???n C???n Gi???', 24, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (55, 28, 'Qu???n H???ng B??ng', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (56, 28, 'Qu???n L?? Ch??n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (57, 28, 'Qu???n Ng?? Quy???n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (58, 28, 'Qu???n Ki???n An', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (59, 28, 'Qu???n H???i An', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (60, 28, 'Qu???n ????? S??n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (61, 28, 'Huy???n An L??o', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (62, 28, 'Huy???n Ki???n Th???y', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (63, 28, 'Huy???n Th???y Nguy??n', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (64, 28, 'Huy???n An D????ng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (65, 28, 'Huy???n Ti??n L??ng', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (66, 28, 'Huy???n V??nh B???o', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (67, 28, 'Huy???n C??t H???i', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (68, 28, 'Huy???n B???ch Long V??', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (69, 28, 'Qu???n D????ng Kinh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (70, 17, 'Qu???n H???i Ch??u', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (71, 17, 'Qu???n Thanh Kh??', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (72, 17, 'Qu???n S??n Tr??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (73, 17, 'Qu???n Ng?? H??nh S??n', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (74, 17, 'Qu???n Li??n Chi???u', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (75, 17, 'Huy???n Ho?? Vang', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (76, 17, 'Qu???n C???m L???', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (77, 24, 'Th??? x?? H?? Giang', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (78, 24, 'Huy???n ?????ng V??n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (79, 24, 'Huy???n M??o V???c', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (80, 24, 'Huy???n Y??n Minh', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (81, 24, 'Huy???n Qu???n B???', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (82, 24, 'Huy???n V??? Xuy??n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (83, 24, 'Huy???n B???c M??', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (84, 24, 'Huy???n Ho??ng Su Ph??', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (85, 24, 'Huy???n X??n M???n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (86, 24, 'Huy???n B???c Quang', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (87, 24, 'Huy???n Quang B??nh', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (88, 16, 'Th??? x?? Cao B???ng', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (89, 16, 'Huy???n B???o L???c', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (90, 16, 'Huy???n Th??ng N??ng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (91, 16, 'Huy???n H?? Qu???ng', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (92, 16, 'Huy???n Tr?? L??nh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (93, 16, 'Huy???n Tr??ng Kh??nh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (94, 16, 'Huy???n Nguy??n B??nh', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (95, 16, 'Huy???n Ho?? An', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (96, 16, 'Huy???n Qu???ng Uy??n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (97, 16, 'Huy???n Th???ch An', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (98, 16, 'Huy???n H??? Lang', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (99, 16, 'Huy???n B???o L??m', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (100, 16, 'Huy???n Ph???c Ho??', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (101, 35, 'Th??? x?? Lai Ch??u', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (102, 35, 'Huy???n Tam ???????ng', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (103, 35, 'Huy???n Phong Th???', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (104, 35, 'Huy???n S??n H???', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (105, 35, 'Huy???n M?????ng T??', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (106, 35, 'Huy???n Than Uy??n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (107, 35, 'Huy???n T??n Uy??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (108, 38, 'Th??nh ph??? L??o Cai', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (109, 38, 'Huy???n Xi Ma Cai', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (110, 38, 'Huy???n B??t X??t', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (111, 38, 'Huy???n B???o Th???ng', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (112, 38, 'Huy???n Sa Pa', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (113, 38, 'Huy???n V??n B??n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (114, 38, 'Huy???n B???o Y??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (115, 38, 'Huy???n B???c H??', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (116, 38, 'Huy???n M?????ng Kh????ng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (117, 60, 'Th??? x?? Tuy??n Quang', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (118, 60, 'Huy???n Na Hang', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (119, 60, 'Huy???n Chi??m H??a', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (120, 60, 'Huy???n H??m Y??n', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (121, 60, 'Huy???n Y??n S??n', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (122, 60, 'Huy???n S??n D????ng', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (123, 37, 'Th??nh ph??? L???ng S??n', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (124, 37, 'Huy???n V??n L??ng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (125, 37, 'Huy???n B???c S??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (126, 37, 'Huy???n L???c B??nh', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (127, 37, 'Huy???n Chi L??ng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (128, 37, 'Huy???n Tr??ng ?????nh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (129, 37, 'Huy???n B??nh Gia', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (130, 37, 'Huy???n V??n Quan', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (131, 37, 'Huy???n Cao L???c', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (132, 37, 'Huy???n ????nh L???p', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (133, 37, 'Huy???n H???u L??ng', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (134, 3, 'Th??nh ph??? Long Xuy??n', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (135, 3, 'Th??? x?? Ch??u ?????c', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (136, 3, 'Huy???n An Ph??', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (137, 3, 'Huy???n T??n Ch??u', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (138, 3, 'Huy???n Ph?? T??n', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (139, 3, 'Huy???n T???nh Bi??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (140, 3, 'Huy???n Tri T??n', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (141, 3, 'Huy???n Ch??u Ph??', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (142, 3, 'Huy???n Ch??? M???i', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (143, 3, 'Huy???n Ch??u Th??nh', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (144, 3, 'Huy???n Tho???i S??n', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (145, 4, 'Th??nh ph??? V??ng T??u', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (146, 4, 'Th??? x?? B?? R???a', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (147, 4, 'Huy???n Xuy??n M???c', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (148, 4, 'Huy???n Long ??i???n', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (149, 4, 'Huy???n C??n ?????o', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (150, 4, 'Huy???n T??n Th??nh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (151, 4, 'Huy???n Ch??u ?????c', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (152, 4, 'Huy???n ?????t ?????', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (153, 58, 'Th??nh ph??? M??? Tho', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (154, 58, 'Th??? x?? G?? C??ng', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (155, 58, 'Huy???n C??i B??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (156, 58, 'Huy???n Cai L???y', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (157, 58, 'Huy???n Ch??u Th??nh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (158, 58, 'Huy???n Ch??? G???o', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (159, 58, 'Huy???n G?? C??ng T??y', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (160, 58, 'Huy???n G?? C??ng ????ng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (161, 58, 'Huy???n T??n Ph?????c', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (162, 58, 'Huy???n T??n Ph?? ????ng', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (163, 33, 'Th??nh ph??? R???ch Gi??', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (164, 33, 'Th??? x?? H?? Ti??n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (165, 33, 'Huy???n Ki??n L????ng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (166, 33, 'Huy???n H??n ?????t', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (167, 33, 'Huy???n T??n Hi???p', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (168, 33, 'Huy???n Ch??u Th??nh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (169, 33, 'Huy???n Gi???ng Ri???ng', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (170, 33, 'Huy???n G?? Quao', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (171, 33, 'Huy???n An Bi??n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (172, 33, 'Huy???n An Minh', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (173, 33, 'Huy???n V??nh Thu???n', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (174, 33, 'Huy???n Ph?? Qu???c', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (175, 33, 'Huy???n Ki??n H???i', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (176, 33, 'Huy???n U minh Th?????ng', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (177, 15, 'Qu???n Ninh Ki???u', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (178, 15, 'Qu???n B??nh Thu???', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (179, 15, 'Qu???n C??i R??ng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (180, 15, 'Qu???n ?? M??n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (181, 15, 'Huy???n Phong ??i???n', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (182, 15, 'Huy???n C??? ?????', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (183, 15, 'Huy???n V??nh Th???nh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (184, 15, 'Hu??????n Th???t N???t', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (185, 9, 'Th??? x?? B???n Tre', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (186, 9, 'Huy???n Ch??u Th??nh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (187, 9, 'Huy???n Ch??? L??ch', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (188, 9, 'Huy???n M??? C??y', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (189, 9, 'Huy???n Gi???ng Tr??m', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (190, 9, 'Huy???n B??nh ?????i', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (191, 9, 'Huy???n Ba Tri', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (192, 9, 'Huy???n Th???nh Ph??', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (193, 61, 'Th??? x?? V??nh Long', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (194, 61, 'Huy???n Long H???', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (195, 61, 'Huy???n Mang Th??t', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (196, 61, 'Huy???n B??nh Minh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (197, 61, 'Huy???n Tam B??nh', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (198, 61, 'Huy???n Tr?? ??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (199, 61, 'Huy???n V??ng Li??m', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (200, 61, 'Huy???n B??nh T??n', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (201, 59, 'Th??? x?? Tr?? Vinh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (202, 59, 'Huy???n C??ng Long', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (203, 59, 'Huy???n C???u K??', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (204, 59, 'Huy???n Ti???u C???n', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (205, 59, 'Huy???n Ch??u Th??nh', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (206, 59, 'Huy???n Tr?? C??', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (207, 59, 'Huy???n C???u Ngang', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (208, 59, 'Huy???n Duy??n H???i', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (209, 51, 'Th??nh ph??? S??c Tr??ng', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (210, 51, 'Huy???n K??? S??ch', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (211, 51, 'Huy???n M??? T??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (212, 51, 'Huy???n M??? Xuy??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (213, 51, 'Huy???n Th???nh Tr???', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (214, 51, 'Huy???n Long Ph??', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (215, 51, 'Huy???n V??nh Ch??u', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (216, 51, 'Huy???n C?? Lao Dung', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (217, 51, 'Huy???n Ng?? N??m', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (218, 51, 'Huy???n Ch??u Th??nh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (219, 7, 'Th??? x?? B???c Li??u', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (220, 7, 'Huy???n V??nh L???i', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (221, 7, 'Huy???n H???ng D??n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (222, 7, 'Huy???n Gi?? Rai', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (223, 7, 'Huy???n Ph?????c Long', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (224, 7, 'Huy???n ????ng H???i', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (225, 7, 'Huy???n Ho?? B??nh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (226, 14, 'Th??nh ph??? C?? Mau', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (227, 14, 'Huy???n Th???i B??nh', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (228, 14, 'Huy???n U Minh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (229, 14, 'Huy???n Tr???n V??n Th???i', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (230, 14, 'Huy???n C??i N?????c', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (231, 14, 'Huy???n ?????m D??i', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (232, 14, 'Huy???n Ng???c Hi???n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (233, 14, 'Huy???n N??m C??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (234, 14, 'Huy???n Ph?? T??n', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (235, 20, 'TP. ??i???n Bi??n Ph???', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (236, 20, 'Th??? x?? M?????ng Lay', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (237, 20, 'Huy???n ??i???n Bi??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (238, 20, 'Huy???n Tu???n Gi??o', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (239, 20, 'Huy???n M?????ng Ch??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (240, 20, 'Huy???n T???a Ch??a', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (241, 20, 'Huy???n ??i???n Bi??n ????ng', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (242, 20, 'Huy???n M?????ng Nh??', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (243, 20, 'Huy???n M?????ng ???ng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (244, 19, 'Th??? x?? Gia Ngh??a', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (245, 19, 'Huy???n ?????k R&#039;L???p', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (246, 19, 'Huy???n ?????k Mil', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (247, 19, 'Huy???n C?? J??t', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (248, 19, 'Huy???n ?????k Song', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (249, 19, 'Huy???n Kr??ng N??', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (250, 19, 'Huy???n D??k GLong', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (251, 19, 'Huy???n Tuy ?????c', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (252, 29, 'Th??? x?? V??? Thanh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (253, 29, 'Huy???n V??? Thu???', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (254, 29, 'Huy???n Long M???', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (255, 29, 'Huy???n Ph???ng Hi???p', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (256, 29, 'Huy???n Ch??u Th??nh', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (257, 29, 'Huy???n Ch??u Th??nh A', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (258, 29, 'Th??? x?? Ng?? B???y', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (259, 5, 'Th??? x?? B???c K???n', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (260, 5, 'Huy???n Ch??? ?????n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (261, 5, 'Huy???n B???ch Th??ng', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (262, 5, 'Huy???n Na R??', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (263, 5, 'Huy???n Ng??n S??n', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (264, 5, 'Huy???n Ba B???', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (265, 5, 'Huy???n Ch??? M???i', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (266, 5, 'Huy???n P??c N???m', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (267, 55, 'Th??nh ph??? Th??i Nguy??n', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (268, 55, 'Th??? x?? S??ng C??ng', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (269, 55, 'Huy???n ?????nh Ho??', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (270, 55, 'Huy???n Ph?? L????ng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (271, 55, 'Huy???n V?? Nhai', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (272, 55, 'Huy???n ?????i T???', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (273, 55, 'Huy???n ?????ng H???', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (274, 55, 'Huy???n Ph?? B??nh', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (275, 55, 'Huy???n Ph??? Y??n', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (276, 63, 'Th??nh ph??? Y??n B??i', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (277, 63, 'Th??? x?? Ngh??a L???', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (278, 63, 'Huy???n V??n Y??n', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (279, 63, 'Huy???n Y??n B??nh', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (280, 63, 'Huy???n M?? Cang Ch???i', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (281, 63, 'Huy???n V??n Ch???n', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (282, 63, 'Huy???n Tr???n Y??n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (283, 63, 'Huy???n Tr???m T???u', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (284, 63, 'Huy???n L???c Y??n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (285, 52, 'Th??? x?? S??n La', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (286, 52, 'Huy???n Qu???nh Nhai', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (287, 52, 'Huy???n M?????ng La', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (288, 52, 'Huy???n Thu???n Ch??u', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (289, 52, 'Huy???n B???c Y??n', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (290, 52, 'Huy???n Ph?? Y??n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (291, 52, 'Huy???n Mai S??n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (292, 52, 'Huy???n Y??n Ch??u', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (293, 52, 'Huy???n S??ng M??', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (294, 52, 'Huy???n M???c Ch??u', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (295, 52, 'Huy???n S???p C???p', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (296, 44, 'Th??nh ph??? Vi???t Tr??', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (297, 44, 'Th??? x?? Ph?? Th???', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (298, 44, 'Huy???n ??oan H??ng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (299, 44, 'Huy???n Thanh Ba', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (300, 44, 'Huy???n H??? Ho??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (301, 44, 'Huy???n C???m Kh??', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (302, 44, 'Huy???n Y??n L???p', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (303, 44, 'Huy???n Thanh S??n', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (304, 44, 'Huy???n Ph?? Ninh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (305, 44, 'Huy???n L??m Thao', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (306, 44, 'Huy???n Tam N??ng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (307, 44, 'Huy???n Thanh Th???y', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (308, 44, 'Huy???n T??n S??n', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (309, 62, 'Th??nh ph??? V??nh Y??n', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (310, 62, 'Huy???n Tam D????ng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (311, 62, 'Huy???n L???p Th???ch', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (312, 62, 'Huy???n V??nh T?????ng', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (313, 62, 'Huy???n Y??n L???c', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (314, 62, 'Huy???n B??nh Xuy??n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (315, 62, 'Th??? x?? Ph??c Y??n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (316, 62, 'Huy???n Tam ?????o', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (317, 49, 'Th??nh ph??? H??? Long', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (318, 49, 'Th??? x?? C???m Ph???', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (319, 49, 'Th??? x?? U??ng B??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (320, 49, 'Th??? x?? M??ng C??i', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (321, 49, 'Huy???n B??nh Li??u', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (322, 49, 'Huy???n ?????m H??', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (323, 49, 'Huy???n H???i H??', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (324, 49, 'Huy???n Ti??n Y??n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (325, 49, 'Huy???n Ba Ch???', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (326, 49, 'Huy???n ????ng Tri???u', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (327, 49, 'Huy???n Y??n H??ng', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (328, 49, 'Huy???n Ho??nh B???', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (329, 49, 'Huy???n V??n ?????n', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (330, 49, 'Huy???n C?? T??', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (331, 6, 'Th??nh ph??? B???c Giang', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (332, 6, 'Huy???n Y??n Th???', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (333, 6, 'Huy???n L???c Ng???n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (334, 6, 'Huy???n S??n ?????ng', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (335, 6, 'Huy???n L???c Nam', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (336, 6, 'Huy???n T??n Y??n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (337, 6, 'Huy???n Hi???p Ho??', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (338, 6, 'Huy???n L???ng Giang', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (339, 6, 'Huy???n Vi???t Y??n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (340, 6, 'Huy???n Y??n D??ng', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (341, 8, 'Th??nh ph??? B???c Ninh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (342, 8, 'Huy???n Y??n Phong', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (343, 8, 'Huy???n Qu??? V??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (344, 8, 'Huy???n Ti??n Du', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (345, 8, 'Huy???n T??? S??n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (346, 8, 'Huy???n Thu???n Th??nh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (347, 8, 'Huy???n Gia B??nh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (348, 8, 'Huy???n L????ng T??i', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (349, 27, 'Th??nh ph??? H???i D????ng', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (350, 27, 'Huy???n Ch?? Linh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (351, 27, 'Huy???n Nam S??ch', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (352, 27, 'Huy???n Kinh M??n', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (353, 27, 'Huy???n Gia L???c', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (354, 27, 'Huy???n T??? K???', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (355, 27, 'Huy???n Thanh Mi???n', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (356, 27, 'Huy???n Ninh Giang', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (357, 27, 'Huy???n C???m Gi??ng', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (358, 27, 'Huy???n Thanh H??', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (359, 27, 'Huy???n Kim Th??nh', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (360, 27, 'Huy???n B??nh Giang', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (361, 31, 'Th??? x?? H??ng Y??n', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (362, 31, 'Huy???n Kim ?????ng', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (363, 31, 'Huy???n ??n Thi', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (364, 31, 'Huy???n Kho??i Ch??u', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (365, 31, 'Huy???n Y??n M???', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (366, 31, 'Huy???n Ti??n L???', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (367, 31, 'Huy???n Ph?? C???', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (368, 31, 'Huy???n M??? H??o', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (369, 31, 'Huy???n V??n L??m', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (370, 31, 'Huy???n V??n Giang', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (371, 30, 'Th??nh ph??? Ho?? B??nh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (372, 30, 'Huy???n ???? B???c', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (373, 30, 'Huy???n Mai Ch??u', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (374, 30, 'Huy???n T??n L???c', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (375, 30, 'Huy???n L???c S??n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (376, 30, 'Huy???n K??? S??n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (377, 30, 'Huy???n L????ng S??n', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (378, 30, 'Huy???n Kim B??i', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (379, 30, 'Huy???n L???c Thu???', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (380, 30, 'Huy???n Y??n Thu???', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (381, 30, 'Huy???n Cao Phong', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (382, 25, 'Th??nh ph??? Ph??? L??', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (383, 25, 'Huy???n Duy Ti??n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (384, 25, 'Huy???n Kim B???ng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (385, 25, 'Huy???n L?? Nh??n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (386, 25, 'Hu??????n Thanh Li??m', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (387, 25, 'Huy???n B??nh L???c', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (388, 40, 'Th??nh ph??? Nam ?????nh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (389, 40, 'Huy???n M??? L???c', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (390, 40, 'Huy???n Xu??n Tr?????ng', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (391, 40, 'Huy???n Giao Th???y', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (392, 40, 'Huy???n ?? Y??n', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (393, 40, 'Huy???n V??? B???n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (394, 40, 'Huy???n Nam Tr???c', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (395, 40, 'Huy???n Tr???c Ninh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (396, 40, 'Huy???n Ngh??a H??ng', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (397, 40, 'Huy???n H???i H???u', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (398, 54, 'Th??nh ph??? Th??i B??nh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (399, 54, 'Huy???n Qu???nh Ph???', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (400, 54, 'Huy???n H??ng H??', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (401, 54, 'Huy???n ????ng H??ng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (402, 54, 'Huy???n V?? Th??', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (403, 54, 'Huy???n Ki???n X????ng', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (404, 54, 'Huy???n Ti???n H???i', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (405, 54, 'Huy???n Th??i Thu???', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (406, 42, 'Th??nh ph??? Ninh B??nh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (407, 42, 'Th??? x?? Tam ??i???p', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (408, 42, 'Huy???n Nho Quan', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (409, 42, 'Huy???n Gia Vi???n', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (410, 42, 'Huy???n Hoa L??', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (411, 42, 'Huy???n Y??n M??', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (412, 42, 'Huy???n Kim S??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (413, 42, 'Huy???n Y??n Kh??nh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (414, 56, 'Th??nh ph??? Thanh Ho??', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (415, 56, 'Th??? x?? B???m S??n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (416, 56, 'Th??? x?? S???m S??n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (417, 56, 'Huy???n Quan Ho??', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (418, 56, 'Huy???n Quan S??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (419, 56, 'Huy???n M?????ng L??t', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (420, 56, 'Huy???n B?? Th?????c', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (421, 56, 'Huy???n Th?????ng Xu??n', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (422, 56, 'Huy???n Nh?? Xu??n', 22, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (423, 56, 'Huy???n Nh?? Thanh', 23, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (424, 56, 'Huy???n Lang Ch??nh', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (425, 56, 'Huy???n Ng???c L???c', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (426, 56, 'Huy???n Th???ch Th??nh', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (427, 56, 'Huy???n C???m Th???y', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (428, 56, 'Huy???n Th??? Xu??n', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (429, 56, 'Huy???n V??nh L???c', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (430, 56, 'Huy???n Thi???u Ho??', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (431, 56, 'Huy???n Tri???u S??n', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (432, 56, 'Huy???n N??ng C???ng', 24, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (433, 56, 'Huy???n ????ng S??n', 25, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (434, 56, 'Huy???n H?? Trung', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (435, 56, 'Huy???n Ho???ng Ho??', 19, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (436, 56, 'Huy???n Nga S??n', 21, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (437, 56, 'Huy???n H???u L???c', 20, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (438, 56, 'Huy???n Qu???ng X????ng', 26, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (439, 56, 'Huy???n T??nh Gia', 27, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (440, 56, 'Huy???n Y??n ?????nh', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (441, 41, 'Th??nh ph??? Vinh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (442, 41, 'Th??? x?? C???a L??', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (443, 41, 'Huy???n Qu??? Ch??u', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (444, 41, 'Huy???n Qu??? H???p', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (445, 41, 'Huy???n Ngh??a ????n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (446, 41, 'Huy???n Qu???nh L??u', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (447, 41, 'Huy???n K??? S??n', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (448, 41, 'Huy???n T????ng D????ng', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (449, 41, 'Huy???n Con Cu??ng', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (450, 41, 'Huy???n T??n K???', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (451, 41, 'Huy???n Y??n Th??nh', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (452, 41, 'Huy???n Di???n Ch??u', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (453, 41, 'Huy???n Anh S??n', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (454, 41, 'Huy???n ???? L????ng', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (455, 41, 'Huy???n Thanh Ch????ng', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (456, 41, 'Huy???n Nghi L???c', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (457, 41, 'Huy???n Nam ????n', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (458, 41, 'Huy???n H??ng Nguy??n', 19, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (459, 41, 'Huy???n Qu??? Phong', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (460, 26, 'Th??nh ph??? H?? T??nh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (461, 26, 'Th??? x?? H???ng L??nh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (462, 26, 'Huy???n H????ng S??n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (463, 26, 'Huy???n ?????c Th???', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (464, 26, 'Huy???n Nghi Xu??n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (465, 26, 'Huy???n Can L???c', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (466, 26, 'Huy???n H????ng Kh??', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (467, 26, 'Huy???n Th???ch H??', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (468, 26, 'Huy???n C???m Xuy??n', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (469, 26, 'Huy???n K??? Anh', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (470, 26, 'Huy???n V?? Quang', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (471, 26, 'Huy???n L???c H??', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (472, 46, 'Th??nh ph??? ?????ng H???i', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (473, 46, 'Huy???n Tuy??n Ho??', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (474, 46, 'Huy???n Minh Ho??', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (475, 46, 'Huy???n Qu???ng Tr???ch', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (476, 46, 'Huy???n B??? Tr???ch', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (477, 46, 'Huy???n Qu???ng Ninh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (478, 46, 'Huy???n L??? Thu???', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (479, 50, 'Th??? x?? ????ng H??', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (480, 50, 'Th??? x?? Qu???ng Tr???', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (481, 50, 'Huy???n V??nh Linh', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (482, 50, 'Huy???n Gio Linh', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (483, 50, 'Huy???n Cam L???', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (484, 50, 'Huy???n Tri???u Phong', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (485, 50, 'Huy???n H???i L??ng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (486, 50, 'Huy???n H?????ng Ho??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (487, 50, 'Huy???n ????k R??ng', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (488, 50, 'Huy???n ?????o C???n c???', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (489, 57, 'Th??nh ph??? Hu???', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (490, 57, 'Huy???n Phong ??i???n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (491, 57, 'Huy???n H????ng Tr??', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (492, 57, 'Huy???n Ph?? Vang', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (493, 57, 'Huy???n H????ng Thu???', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (494, 57, 'Huy???n Nam ????ng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (495, 57, 'Huy???n A L?????i', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (496, 57, 'Huy???n Qu???ng ??i???n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (497, 57, 'Huy???n Ph?? L???c', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (498, 47, 'Th??nh ph??? Tam K???', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (499, 47, 'Th??nh ph??? H???i An', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (500, 47, 'Huy???n Duy Xuy??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (501, 47, 'Huy???n ??i???n B??n', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (502, 47, 'Huy???n ?????i L???c', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (503, 47, 'Huy???n Qu??? S??n', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (504, 47, 'Huy???n Hi???p ?????c', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (505, 47, 'Huy???n Th??ng B??nh', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (506, 47, 'Huy???n N??i Th??nh', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (507, 47, 'Huy???n Ti??n Ph?????c', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (508, 47, 'Huy???n B???c Tr?? My', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (509, 47, 'Huy???n ????ng Giang', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (510, 47, 'Huy???n Nam Giang', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (511, 47, 'Huy???n Ph?????c S??n', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (512, 47, 'Huy???n Nam Tr?? My', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (513, 47, 'Huy???n T??y Giang', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (514, 47, 'Huy???n Ph?? Ninh', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (515, 47, 'Huy???n N??ng S??n', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (516, 48, 'Th??nh ph??? Qu???ng Ng??i', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (517, 48, 'Huy???n L?? S??n', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (518, 48, 'Huy???n B??nh S??n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (519, 48, 'Huy???n Tr?? B???ng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (520, 48, 'Huy???n S??n T???nh', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (521, 48, 'Huy???n S??n H??', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (522, 48, 'Huy???n T?? Ngh??a', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (523, 48, 'Huy???n Ngh??a H??nh', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (524, 48, 'Huy???n Minh Long', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (525, 48, 'Huy???n M??? ?????c', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (526, 48, 'Huy???n ?????c Ph???', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (527, 48, 'Huy???n Ba T??', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (528, 48, 'Huy???n S??n T??y', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (529, 48, 'Huy???n T??y Tr??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (530, 34, 'Th??? x?? KonTum', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (531, 34, 'Huy???n ????k Glei', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (532, 34, 'Huy???n Ng???c H???i', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (533, 34, 'Huy???n ????k T??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (534, 34, 'Huy???n Sa Th???y', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (535, 34, 'Huy???n Kon Plong', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (536, 34, 'Huy???n ????k H??', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (537, 34, 'Huy???n Kon R???y', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (538, 34, 'Huy???n Tu M?? R??ng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (539, 10, 'Th??nh ph??? Quy Nh??n', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (540, 10, 'Huy???n An L??o', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (541, 10, 'Huy???n Ho??i ??n', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (542, 10, 'Huy???n Ho??i Nh??n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (543, 10, 'Huy???n Ph?? M???', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (544, 10, 'Huy???n Ph?? C??t', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (545, 10, 'Huy???n V??nh Th???nh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (546, 10, 'Huy???n T??y S??n', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (547, 10, 'Huy???n V??n Canh', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (548, 10, 'Huy???n An Nh??n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (549, 10, 'Huy???n Tuy Ph?????c', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (550, 53, 'Th??? x?? T??y Ninh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (551, 53, 'Huy???n T??n Bi??n', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (552, 53, 'Huy???n T??n Ch??u', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (553, 53, 'Huy???n D????ng Minh Ch??u', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (554, 53, 'Huy???n Ch??u Th??nh', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (555, 53, 'Huy???n Ho?? Th??nh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (556, 53, 'Huy???n B???n C???u', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (557, 53, 'Huy???n G?? D???u', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (558, 53, 'Huy???n Tr???ng B??ng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (559, 45, 'Th??nh ph??? Tuy Ho??', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (560, 45, 'Huy???n ?????ng Xu??n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (561, 45, 'Huy???n S??ng C???u', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (562, 45, 'Huy???n Tuy An', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (563, 45, 'Huy???n S??n Ho??', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (564, 45, 'Huy???n S??ng Hinh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (565, 45, 'Huy???n ????ng Ho??', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (566, 45, 'Huy???n Ph?? Ho??', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (567, 45, 'Huy???n T??y Ho??', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (568, 13, 'Th??nh ph??? Phan Thi???t', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (569, 13, 'Huy???n Tuy Phong', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (570, 13, 'Huy???n B???c B??nh', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (571, 13, 'Huy???n H??m Thu???n B???c', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (572, 13, 'Huy???n H??m Thu???n Nam', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (573, 13, 'Huy???n H??m T??n', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (574, 13, 'Huy???n ?????c Linh', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (575, 13, 'Huy???n T??nh Linh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (576, 13, 'Huy???n ?????o Ph?? Qu??', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (577, 13, 'Th??? x?? LaGi', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (578, 21, 'Th??nh ph??? Bi??n Ho??', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (579, 21, 'Huy???n V??nh C???u', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (580, 21, 'Huy???n T??n Ph??', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (581, 21, 'Huy???n ?????nh Qu??n', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (582, 21, 'Huy???n Th???ng Nh???t', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (583, 21, 'Th??? x?? Long Kh??nh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (584, 21, 'Huy???n Xu??n L???c', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (585, 21, 'Huy???n Long Th??nh', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (586, 21, 'Huy???n Nh??n Tr???ch', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (587, 21, 'Huy???n Tr???ng Bom', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (588, 21, 'Huy???n C???m M???', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (589, 39, 'Th??? x?? T??n An', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (590, 39, 'Huy???n V??nh H??ng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (591, 39, 'Huy???n M???c Ho??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (592, 39, 'Huy???n T??n Th???nh', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (593, 39, 'Huy???n Th???nh Ho??', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (594, 39, 'Huy???n ?????c Hu???', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (595, 39, 'Huy???n ?????c Ho??', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (596, 39, 'Huy???n B???n L???c', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (597, 39, 'Huy???n Th??? Th???a', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (598, 39, 'Huy???n Ch??u Th??nh', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (599, 39, 'Huy???n T??n Tr???', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (600, 39, 'Huy???n C???n ???????c', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (601, 39, 'Huy???n C???n Giu???c', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (602, 39, 'Huy???n T??n H??ng', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (603, 22, 'Th??nh ph??? Cao L??nh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (604, 22, 'Th??? x?? Sa ????c', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (605, 22, 'Huy???n T??n H???ng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (606, 22, 'Huy???n H???ng Ng???', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (607, 22, 'Huy???n Tam N??ng', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (608, 22, 'Huy???n Thanh B??nh', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (609, 22, 'Huy???n Cao L??nh', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (610, 22, 'Huy???n L???p V??', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (611, 22, 'Huy???n Th??p M?????i', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (612, 22, 'Huy???n Lai Vung', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (613, 22, 'Huy???n Ch??u Th??nh', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (614, 11, 'Th??? x?? Th??? D???u M???t', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (615, 11, 'Huy???n B???n C??t', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (616, 11, 'Huy???n T??n Uy??n', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (617, 11, 'Huy???n Thu???n An', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (618, 11, 'Huy???n D?? An', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (619, 11, 'Huy???n Ph?? Gi??o', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (620, 11, 'Huy???n D???u Ti???ng', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (621, 12, 'Th??? x?? ?????ng Xo??i', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (622, 12, 'Huy???n ?????ng Ph??', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (623, 12, 'Huy???n Ch??n Th??nh', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (624, 12, 'Huy???n B??nh Long', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (625, 12, 'Huy???n L???c Ninh', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (626, 12, 'Huy???n B?? ?????p', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (627, 12, 'Huy???n Ph?????c Long', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (628, 12, 'Huy???n B?? ????ng', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (630, 43, 'TP.Phan Rang - Th??p Ch??m', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (631, 43, 'Huy???n Ninh S??n', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (632, 43, 'Huy???n Ninh H???i', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (633, 43, 'Huy???n Ninh Ph?????c', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (634, 43, 'Huy???n B??c ??i', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (635, 43, 'Huy???n Thu???n B???c', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (636, 23, 'Th??nh ph??? Pleiku', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (637, 23, 'Huy???n Ch?? P??h', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (638, 23, 'Huy???n Mang Yang', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (639, 23, 'Huy???n Kbang', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (640, 23, 'Th??? x?? An Kh??', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (641, 23, 'Huy???n K??ng Chro', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (642, 23, 'Huy???n ?????c C??', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (643, 23, 'Huy???n Ch??pr??ng', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (644, 23, 'Huy???n Ch?? S??', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (646, 23, 'Huy???n Kr??ng Pa', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (647, 23, 'Huy???n Ia Grai', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (648, 23, 'Huy???n ????k ??oa', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (649, 23, 'Huy???n Ia Pa', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (650, 23, 'Huy???n ????k P??', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (651, 23, 'Huy???n Ph?? Thi???n', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (652, 32, 'Th??nh ph??? Nha Trang', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (653, 32, 'Huy???n V???n Ninh', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (654, 32, 'Huy???n Ninh Ho??', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (655, 32, 'Huy???n Di??n Kh??nh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (656, 32, 'Huy???n Kh??nh V??nh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (657, 32, 'Th??? x?? Cam Ranh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (658, 32, 'Huy???n Kh??nh S??n', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (659, 32, 'Huy???n Tr?????ng Sa', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (660, 32, 'Huy???n Cam L??m', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (661, 36, 'Th??nh ph??? ???? L???t', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (662, 36, 'Th??? x?? B???o L???c', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (663, 36, 'Huy???n ?????c Tr???ng', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (664, 36, 'Huy???n Di Linh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (665, 36, 'Huy???n ????n D????ng', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (666, 36, 'Huy???n L???c D????ng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (667, 36, 'Huy???n ????? Huoai', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (668, 36, 'Huy???n ????? T???h', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (669, 36, 'Huy???n C??t Ti??n', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (670, 36, 'Huy???n L??m H??', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (671, 36, 'Huy???n B???o L??m', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (672, 36, 'Huy???n ??am R??ng', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (675, 18, 'Th??nh ph??? Bu??n Ma Thu???t', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (676, 18, 'Huy???n Ea H Leo', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (677, 18, 'Huy???n Kr??ng B??k', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (678, 18, 'Huy???n Kr??ng N??ng', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (679, 18, 'Huy???n Ea S??p', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (680, 18, 'Huy???n C?? M&#039;gar', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (681, 18, 'Huy???n Kr??ng P???c', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (682, 18, 'Huy???n Ea Kar', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (683, 18, 'Huy???n M&#039;??r???k', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (684, 18, 'Huy???n Kr??ng Ana', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (685, 18, 'Huy???n Kr??ng B??ng', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (686, 18, 'Huy???n L???k', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (687, 18, 'Huy???n Bu??n ????n', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (688, 18, 'Huy???n C?? Kuin', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (692, 62, 'Huy???n S??ng L??', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (693, 17, 'Huy???n Ho??ng Sa', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (694, 23, 'Th??? x?? Ayun Pa', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (695, 18, 'Th??? x?? Bu??n H???', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (696, 22, 'Th??? x?? H???ng Ng???', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (697, 15, 'Huy???n Th???i Lai', 9, 1)";