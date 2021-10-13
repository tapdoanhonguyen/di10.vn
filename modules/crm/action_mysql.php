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
 birthday int(11) NOT NULL DEFAULT '0' COMMENT 'Ngày sinh',
 sex tinyint(1) unsigned NOT NULL DEFAULT '0',
 address varchar(250) NOT NULL COMMENT 'Địa chỉ',
 email varchar(100) NOT NULL COMMENT 'Email',
 mobile varchar(20) NOT NULL COMMENT 'SĐT di động',
 facebook varchar(100) NOT NULL COMMENT 'Facebook',
 from_by tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Dữ liệu từ kênh',
 gmap_lat float DEFAULT '0' COMMENT 'Vĩ độ',
 gmap_lng float DEFAULT '0' COMMENT 'Kinh độ',
 add_time int(11) NOT NULL DEFAULT '0',
 edit_time int(11) NOT NULL DEFAULT '0',
 mkt_time int(11) NULL DEFAULT '0',
 status tinyint(1) unsigned NOT NULL DEFAULT '0',
 note varchar(250) NULL DEFAULT NULL,
 PRIMARY KEY (id),
 UNIQUE KEY full_name (full_name, mobile)
) ENGINE=MyISAM";

//bang du các sự kiện
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_eventtype (
 eventtype_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 eventtype_name VARCHAR(150) NOT NULL,
 color VARCHAR(15) NOT NULL DEFAULT '',
 weight smallint(4) NOT NULL DEFAULT '0' COMMENT 'STT',
 status tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 : Hiển thị, 0 Ẩn',
 PRIMARY KEY (eventtype_id)
) ENGINE=MyISAM";

//bang ghi thong tin các hành dộng của học sinh
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_events (
 eventid int(10) unsigned NOT NULL AUTO_INCREMENT,
 customerid mediumint(8) unsigned NOT NULL,
 measureid smallint(5) unsigned NOT NULL,
 adminid mediumint(8) unsigned NOT NULL,
 addtime int(11) NOT NULL DEFAULT '0',
 eventtype tinyint(1) unsigned NOT NULL DEFAULT '0',
 content text COMMENT 'Nội dung',
 remkt_time int(11) NULL DEFAULT '0',
 PRIMARY KEY (eventid)
) ENGINE=MyISAM";

//bang thang do tiem nang khi MKT
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_measure (
 measure_id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
 measure_name VARCHAR(150) NOT NULL,
 weight smallint(4) NOT NULL DEFAULT '0' COMMENT 'STT',
 status tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 : Hiển thị, 0 Ẩn',
 PRIMARY KEY (measure_id)
) ENGINE=MyISAM";

//bang du lieu tu kenh nao
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_from (
 from_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 from_name VARCHAR(150) NOT NULL,
 weight smallint(4) NOT NULL DEFAULT '0' COMMENT 'STT',
 status tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 : Hiển thị, 0 Ẩn',
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
 receiver varchar(250) NOT NULL COMMENT 'Enail người nhận',
 content TEXT NOT NULL,
 active tinyint(1) NOT NULL COMMENT '1: kích hoạt, 0 không',
 PRIMARY KEY (id),
 KEY active (active)
) ENGINE=MyISAM";

//kich ban cham soc kh qua sms
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_smsconfig (
 id int(10) unsigned NOT NULL auto_increment,
 content TEXT NOT NULL,
 daysend smallint(4) unsigned NOT NULL default '0' COMMENT 'Gửi vào ngày thứ mấy kể từ khi co action',
 hoursend tinyint(1) unsigned NOT NULL default '0' COMMENT 'Giờ sẽ gửi tin',
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
 mobile varchar(20) NOT NULL COMMENT 'SĐT nguoi nhan',
 content TEXT NOT NULL,
 timesend int(10) unsigned NOT NULL default '0',
 active tinyint(1) NOT NULL COMMENT '1: kích hoạt, 0 không',
 PRIMARY KEY (id),
 KEY timesend (timesend),
 KEY active (active)
) ENGINE=MyISAM";

//Message history
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_sms_history (
 id int(10) unsigned NOT NULL auto_increment,
 order_id int(10) unsigned NOT NULL,
 smsconfigid int(10) unsigned NOT NULL COMMENT 'ID bang smsconfig',
 mobile varchar(20) NOT NULL COMMENT 'SĐT nguoi nhan',
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



$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (2, 'Hà Nội', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (1, 'Hồ Chí Minh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (3, 'An Giang', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (4, 'Bà Rịa - Vũng Tàu', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (5, 'Bắc Cạn', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (6, 'Bắc Giang', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (7, 'Bạc Liêu', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (8, 'Bắc Ninh', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (9, 'Bến Tre', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (10, 'Bình Định', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (11, 'Bình Dương', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (12, 'Bình Phước', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (13, 'Bình Thuận', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (14, 'Cà Mau', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (15, 'Cần Thơ', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (16, 'Cao Bằng', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (17, 'Đà Nẵng', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (18, 'Đắc Lắc', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (19, 'Đắk Nông', 19, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (20, 'Điện Biên', 20, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (21, 'Đồng Nai', 21, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (22, 'Đồng Tháp', 22, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (23, 'Gia Lai', 23, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (24, 'Hà Giang', 24, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (25, 'Hà Nam', 25, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (26, 'Hà Tĩnh', 26, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (27, 'Hải Dương', 27, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (28, 'Hải Phòng', 28, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (29, 'Hậu Giang', 29, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (30, 'Hòa Bình', 30, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (31, 'Hưng Yên', 31, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (32, 'Khánh Hòa', 32, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (33, 'Kiên Giang', 33, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (34, 'Kon Tum', 34, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (35, 'Lai Châu', 35, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (36, 'Lâm Đồng', 36, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (37, 'Lạng Sơn', 37, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (38, 'Lào Cai', 38, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (39, 'Long An', 39, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (40, 'Nam Định', 40, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (41, 'Nghệ An', 41, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (42, 'Ninh Bình', 42, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (43, 'Ninh Thuận', 43, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (44, 'Phú Thọ', 44, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (45, 'Phú Yên', 45, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (46, 'Quảng Bình', 46, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (47, 'Quảng Nam', 47, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (48, 'Quảng Ngãi', 48, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (49, 'Quảng Ninh', 49, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (50, 'Quảng Trị', 50, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (51, 'Sóc Trăng', 51, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (52, 'Sơn La', 52, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (53, 'Tây Ninh', 53, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (54, 'Thái Bình', 54, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (55, 'Thái Nguyên', 55, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (56, 'Thanh Hoá', 56, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (57, 'Thừa Thiên - Huế', 57, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (58, 'Tiền Giang', 58, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (59, 'Trà Vinh', 59, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (60, 'Tuyên Quang', 60, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (61, 'Vĩnh Long', 61, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (62, 'Vĩnh Phúc', 62, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (id, title, weight, status) VALUES (63, 'Yên Bái', 63, 1)";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (1, 2, 'Quận Ba Đình', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (2, 2, 'Quận Hoàn Kiếm', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (3, 2, 'Quận Hai Bà Trưng', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (4, 2, 'Quận Đống Đa', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (5, 2, 'Quận Tây Hồ', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (6, 2, 'Quận Cầu Giấy', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (7, 2, 'Quận Thanh Xuân', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (8, 2, 'Quận Hoàng Mai', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (9, 2, 'Quận Long Biên', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (10, 2, 'Huyện Từ Liêm', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (11, 2, 'Huyện Thanh Trì', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (12, 2, 'Huyện Gia Lâm', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (13, 2, 'Huyện Đông Anh', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (14, 2, 'Huyện Sóc Sơn', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (15, 2, 'Thành phố Hà Đông', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (16, 2, 'Thành phố Sơn Tây', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (17, 2, 'Huyện Ba Vì', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (18, 2, 'Huyện Phúc Thọ', 19, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (19, 2, 'Huyện Thạch Thất', 23, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (20, 2, 'Huyện Quốc Oai', 22, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (21, 2, 'Huyện Chương Mỹ', 24, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (22, 2, 'Huyện Đan Phượng', 20, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (23, 2, 'Huyện Hoài Đức', 21, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (24, 2, 'Huyện Thanh Oai', 25, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (25, 2, 'Huyện Mỹ Đức', 29, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (26, 2, 'Huyện Ứng Hòa', 28, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (27, 2, 'Huyện Thường Tín', 26, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (28, 2, 'Huyện Phú Xuyên', 27, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (29, 2, 'Huyện Mê Linh', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (30, 1, 'Quận 1', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (31, 1, 'Quận 2', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (32, 1, 'Quận 3', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (33, 1, 'Quận 4', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (34, 1, 'Quận 5', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (35, 1, 'Quận 6', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (36, 1, 'Quận 7', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (37, 1, 'Quận 8', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (38, 1, 'Quận 9', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (39, 1, 'Quận 10', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (40, 1, 'Quận 11', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (41, 1, 'Quận 12', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (42, 1, 'Quận Gò Vấp', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (43, 1, 'Quận Tân Bình', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (44, 1, 'Quận Tân Phú', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (45, 1, 'Quận Bình Thạnh', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (46, 1, 'Quận Phú Nhuận', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (47, 1, 'Quận Thủ Đức', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (48, 1, 'Quận Bình Tân', 19, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (49, 1, 'Huyện Bình Chánh', 20, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (50, 1, 'Huyện Củ Chi', 21, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (51, 1, 'Huyện Hóc Môn', 22, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (52, 1, 'Huyện Nhà Bè', 23, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (53, 1, 'Huyện Cần Giờ', 24, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (55, 28, 'Quận Hồng Bàng', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (56, 28, 'Quận Lê Chân', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (57, 28, 'Quận Ngô Quyền', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (58, 28, 'Quận Kiến An', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (59, 28, 'Quận Hải An', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (60, 28, 'Quận Đồ Sơn', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (61, 28, 'Huyện An Lão', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (62, 28, 'Huyện Kiến Thụy', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (63, 28, 'Huyện Thủy Nguyên', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (64, 28, 'Huyện An Dương', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (65, 28, 'Huyện Tiên Lãng', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (66, 28, 'Huyện Vĩnh Bảo', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (67, 28, 'Huyện Cát Hải', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (68, 28, 'Huyện Bạch Long Vĩ', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (69, 28, 'Quận Dương Kinh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (70, 17, 'Quận Hải Châu', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (71, 17, 'Quận Thanh Khê', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (72, 17, 'Quận Sơn Trà', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (73, 17, 'Quận Ngũ Hành Sơn', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (74, 17, 'Quận Liên Chiểu', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (75, 17, 'Huyện Hoà Vang', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (76, 17, 'Quận Cẩm Lệ', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (77, 24, 'Thị xã Hà Giang', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (78, 24, 'Huyện Đồng Văn', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (79, 24, 'Huyện Mèo Vạc', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (80, 24, 'Huyện Yên Minh', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (81, 24, 'Huyện Quản Bạ', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (82, 24, 'Huyện Vị Xuyên', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (83, 24, 'Huyện Bắc Mê', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (84, 24, 'Huyện Hoàng Su Phì', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (85, 24, 'Huyện Xín Mần', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (86, 24, 'Huyện Bắc Quang', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (87, 24, 'Huyện Quang Bình', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (88, 16, 'Thị xã Cao Bằng', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (89, 16, 'Huyện Bảo Lạc', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (90, 16, 'Huyện Thông Nông', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (91, 16, 'Huyện Hà Quảng', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (92, 16, 'Huyện Trà Lĩnh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (93, 16, 'Huyện Trùng Khánh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (94, 16, 'Huyện Nguyên Bình', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (95, 16, 'Huyện Hoà An', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (96, 16, 'Huyện Quảng Uyên', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (97, 16, 'Huyện Thạch An', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (98, 16, 'Huyện Hạ Lang', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (99, 16, 'Huyện Bảo Lâm', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (100, 16, 'Huyện Phục Hoà', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (101, 35, 'Thị xã Lai Châu', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (102, 35, 'Huyện Tam Đường', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (103, 35, 'Huyện Phong Thổ', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (104, 35, 'Huyện Sìn Hồ', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (105, 35, 'Huyện Mường Tè', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (106, 35, 'Huyện Than Uyên', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (107, 35, 'Huyện Tân Uyên', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (108, 38, 'Thành phố Lào Cai', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (109, 38, 'Huyện Xi Ma Cai', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (110, 38, 'Huyện Bát Xát', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (111, 38, 'Huyện Bảo Thắng', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (112, 38, 'Huyện Sa Pa', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (113, 38, 'Huyện Văn Bàn', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (114, 38, 'Huyện Bảo Yên', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (115, 38, 'Huyện Bắc Hà', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (116, 38, 'Huyện Mường Khương', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (117, 60, 'Thị xã Tuyên Quang', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (118, 60, 'Huyện Na Hang', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (119, 60, 'Huyện Chiêm Hóa', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (120, 60, 'Huyện Hàm Yên', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (121, 60, 'Huyện Yên Sơn', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (122, 60, 'Huyện Sơn Dương', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (123, 37, 'Thành phố Lạng Sơn', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (124, 37, 'Huyện Văn Lãng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (125, 37, 'Huyện Bắc Sơn', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (126, 37, 'Huyện Lộc Bình', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (127, 37, 'Huyện Chi Lăng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (128, 37, 'Huyện Tràng Định', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (129, 37, 'Huyện Bình Gia', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (130, 37, 'Huyện Văn Quan', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (131, 37, 'Huyện Cao Lộc', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (132, 37, 'Huyện Đình Lập', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (133, 37, 'Huyện Hữu Lũng', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (134, 3, 'Thành phố Long Xuyên', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (135, 3, 'Thị xã Châu Đốc', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (136, 3, 'Huyện An Phú', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (137, 3, 'Huyện Tân Châu', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (138, 3, 'Huyện Phú Tân', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (139, 3, 'Huyện Tịnh Biên', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (140, 3, 'Huyện Tri Tôn', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (141, 3, 'Huyện Châu Phú', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (142, 3, 'Huyện Chợ Mới', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (143, 3, 'Huyện Châu Thành', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (144, 3, 'Huyện Thoại Sơn', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (145, 4, 'Thành phố Vũng Tàu', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (146, 4, 'Thị xã Bà Rịa', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (147, 4, 'Huyện Xuyên Mộc', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (148, 4, 'Huyện Long Điền', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (149, 4, 'Huyện Côn Đảo', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (150, 4, 'Huyện Tân Thành', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (151, 4, 'Huyện Châu Đức', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (152, 4, 'Huyện Đất Đỏ', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (153, 58, 'Thành phố Mỹ Tho', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (154, 58, 'Thị xã Gò Công', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (155, 58, 'Huyện Cái Bè', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (156, 58, 'Huyện Cai Lậy', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (157, 58, 'Huyện Châu Thành', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (158, 58, 'Huyện Chợ Gạo', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (159, 58, 'Huyện Gò Công Tây', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (160, 58, 'Huyện Gò Công Đông', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (161, 58, 'Huyện Tân Phước', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (162, 58, 'Huyện Tân Phú Đông', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (163, 33, 'Thành phố Rạch Giá', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (164, 33, 'Thị xã Hà Tiên', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (165, 33, 'Huyện Kiên Lương', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (166, 33, 'Huyện Hòn Đất', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (167, 33, 'Huyện Tân Hiệp', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (168, 33, 'Huyện Châu Thành', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (169, 33, 'Huyện Giồng Riềng', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (170, 33, 'Huyện Gò Quao', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (171, 33, 'Huyện An Biên', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (172, 33, 'Huyện An Minh', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (173, 33, 'Huyện Vĩnh Thuận', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (174, 33, 'Huyện Phú Quốc', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (175, 33, 'Huyện Kiên Hải', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (176, 33, 'Huyện U minh Thượng', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (177, 15, 'Quận Ninh Kiều', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (178, 15, 'Quận Bình Thuỷ', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (179, 15, 'Quận Cái Răng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (180, 15, 'Quận Ô Môn', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (181, 15, 'Huyện Phong Điền', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (182, 15, 'Huyện Cờ Đỏ', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (183, 15, 'Huyện Vĩnh Thạnh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (184, 15, 'Huỵện Thốt Nốt', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (185, 9, 'Thị xã Bến Tre', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (186, 9, 'Huyện Châu Thành', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (187, 9, 'Huyện Chợ Lách', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (188, 9, 'Huyện Mỏ Cày', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (189, 9, 'Huyện Giồng Trôm', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (190, 9, 'Huyện Bình Đại', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (191, 9, 'Huyện Ba Tri', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (192, 9, 'Huyện Thạnh Phú', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (193, 61, 'Thị xã Vĩnh Long', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (194, 61, 'Huyện Long Hồ', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (195, 61, 'Huyện Mang Thít', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (196, 61, 'Huyện Bình Minh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (197, 61, 'Huyện Tam Bình', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (198, 61, 'Huyện Trà Ôn', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (199, 61, 'Huyện Vũng Liêm', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (200, 61, 'Huyện Bình Tân', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (201, 59, 'Thị xã Trà Vinh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (202, 59, 'Huyện Càng Long', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (203, 59, 'Huyện Cầu Kè', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (204, 59, 'Huyện Tiểu Cần', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (205, 59, 'Huyện Châu Thành', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (206, 59, 'Huyện Trà Cú', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (207, 59, 'Huyện Cầu Ngang', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (208, 59, 'Huyện Duyên Hải', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (209, 51, 'Thành phố Sóc Trăng', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (210, 51, 'Huyện Kế Sách', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (211, 51, 'Huyện Mỹ Tú', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (212, 51, 'Huyện Mỹ Xuyên', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (213, 51, 'Huyện Thạnh Trị', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (214, 51, 'Huyện Long Phú', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (215, 51, 'Huyện Vĩnh Châu', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (216, 51, 'Huyện Cù Lao Dung', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (217, 51, 'Huyện Ngã Năm', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (218, 51, 'Huyện Châu Thành', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (219, 7, 'Thị xã Bạc Liêu', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (220, 7, 'Huyện Vĩnh Lợi', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (221, 7, 'Huyện Hồng Dân', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (222, 7, 'Huyện Giá Rai', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (223, 7, 'Huyện Phước Long', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (224, 7, 'Huyện Đông Hải', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (225, 7, 'Huyện Hoà Bình', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (226, 14, 'Thành phố Cà Mau', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (227, 14, 'Huyện Thới Bình', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (228, 14, 'Huyện U Minh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (229, 14, 'Huyện Trần Văn Thời', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (230, 14, 'Huyện Cái Nước', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (231, 14, 'Huyện Đầm Dơi', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (232, 14, 'Huyện Ngọc Hiển', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (233, 14, 'Huyện Năm Căn', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (234, 14, 'Huyện Phú Tân', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (235, 20, 'TP. Điện Biên Phủ', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (236, 20, 'Thị xã Mường Lay', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (237, 20, 'Huyện Điện Biên', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (238, 20, 'Huyện Tuần Giáo', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (239, 20, 'Huyện Mường Chà', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (240, 20, 'Huyện Tủa Chùa', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (241, 20, 'Huyện Điện Biên Đông', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (242, 20, 'Huyện Mường Nhé', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (243, 20, 'Huyện Mường Ảng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (244, 19, 'Thị xã Gia Nghĩa', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (245, 19, 'Huyện Đắk R&#039;Lấp', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (246, 19, 'Huyện Đắk Mil', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (247, 19, 'Huyện Cư Jút', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (248, 19, 'Huyện Đắk Song', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (249, 19, 'Huyện Krông Nô', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (250, 19, 'Huyện Dăk GLong', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (251, 19, 'Huyện Tuy Đức', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (252, 29, 'Thị xã Vị Thanh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (253, 29, 'Huyện Vị Thuỷ', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (254, 29, 'Huyện Long Mỹ', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (255, 29, 'Huyện Phụng Hiệp', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (256, 29, 'Huyện Châu Thành', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (257, 29, 'Huyện Châu Thành A', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (258, 29, 'Thị xã Ngã Bảy', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (259, 5, 'Thị xã Bắc Kạn', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (260, 5, 'Huyện Chợ Đồn', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (261, 5, 'Huyện Bạch Thông', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (262, 5, 'Huyện Na Rì', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (263, 5, 'Huyện Ngân Sơn', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (264, 5, 'Huyện Ba Bể', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (265, 5, 'Huyện Chợ Mới', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (266, 5, 'Huyện Pác Nặm', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (267, 55, 'Thành phố Thái Nguyên', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (268, 55, 'Thị xã Sông Công', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (269, 55, 'Huyện Định Hoá', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (270, 55, 'Huyện Phú Lương', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (271, 55, 'Huyện Võ Nhai', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (272, 55, 'Huyện Đại Từ', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (273, 55, 'Huyện Đồng Hỷ', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (274, 55, 'Huyện Phú Bình', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (275, 55, 'Huyện Phổ Yên', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (276, 63, 'Thành phố Yên Bái', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (277, 63, 'Thị xã Nghĩa Lộ', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (278, 63, 'Huyện Văn Yên', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (279, 63, 'Huyện Yên Bình', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (280, 63, 'Huyện Mù Cang Chải', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (281, 63, 'Huyện Văn Chấn', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (282, 63, 'Huyện Trấn Yên', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (283, 63, 'Huyện Trạm Tấu', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (284, 63, 'Huyện Lục Yên', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (285, 52, 'Thị xã Sơn La', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (286, 52, 'Huyện Quỳnh Nhai', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (287, 52, 'Huyện Mường La', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (288, 52, 'Huyện Thuận Châu', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (289, 52, 'Huyện Bắc Yên', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (290, 52, 'Huyện Phù Yên', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (291, 52, 'Huyện Mai Sơn', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (292, 52, 'Huyện Yên Châu', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (293, 52, 'Huyện Sông Mã', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (294, 52, 'Huyện Mộc Châu', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (295, 52, 'Huyện Sốp Cộp', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (296, 44, 'Thành phố Việt Trì', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (297, 44, 'Thị xã Phú Thọ', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (298, 44, 'Huyện Đoan Hùng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (299, 44, 'Huyện Thanh Ba', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (300, 44, 'Huyện Hạ Hoà', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (301, 44, 'Huyện Cẩm Khê', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (302, 44, 'Huyện Yên Lập', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (303, 44, 'Huyện Thanh Sơn', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (304, 44, 'Huyện Phù Ninh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (305, 44, 'Huyện Lâm Thao', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (306, 44, 'Huyện Tam Nông', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (307, 44, 'Huyện Thanh Thủy', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (308, 44, 'Huyện Tân Sơn', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (309, 62, 'Thành phố Vĩnh Yên', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (310, 62, 'Huyện Tam Dương', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (311, 62, 'Huyện Lập Thạch', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (312, 62, 'Huyện Vĩnh Tường', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (313, 62, 'Huyện Yên Lạc', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (314, 62, 'Huyện Bình Xuyên', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (315, 62, 'Thị xã Phúc Yên', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (316, 62, 'Huyện Tam Đảo', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (317, 49, 'Thành phố Hạ Long', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (318, 49, 'Thị xã Cẩm Phả', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (319, 49, 'Thị xã Uông Bí', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (320, 49, 'Thị xã Móng Cái', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (321, 49, 'Huyện Bình Liêu', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (322, 49, 'Huyện Đầm Hà', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (323, 49, 'Huyện Hải Hà', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (324, 49, 'Huyện Tiên Yên', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (325, 49, 'Huyện Ba Chẽ', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (326, 49, 'Huyện Đông Triều', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (327, 49, 'Huyện Yên Hưng', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (328, 49, 'Huyện Hoành Bồ', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (329, 49, 'Huyện Vân Đồn', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (330, 49, 'Huyện Cô Tô', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (331, 6, 'Thành phố Bắc Giang', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (332, 6, 'Huyện Yên Thế', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (333, 6, 'Huyện Lục Ngạn', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (334, 6, 'Huyện Sơn Động', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (335, 6, 'Huyện Lục Nam', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (336, 6, 'Huyện Tân Yên', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (337, 6, 'Huyện Hiệp Hoà', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (338, 6, 'Huyện Lạng Giang', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (339, 6, 'Huyện Việt Yên', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (340, 6, 'Huyện Yên Dũng', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (341, 8, 'Thành phố Bắc Ninh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (342, 8, 'Huyện Yên Phong', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (343, 8, 'Huyện Quế Võ', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (344, 8, 'Huyện Tiên Du', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (345, 8, 'Huyện Từ Sơn', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (346, 8, 'Huyện Thuận Thành', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (347, 8, 'Huyện Gia Bình', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (348, 8, 'Huyện Lương Tài', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (349, 27, 'Thành phố Hải Dương', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (350, 27, 'Huyện Chí Linh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (351, 27, 'Huyện Nam Sách', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (352, 27, 'Huyện Kinh Môn', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (353, 27, 'Huyện Gia Lộc', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (354, 27, 'Huyện Tứ Kỳ', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (355, 27, 'Huyện Thanh Miện', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (356, 27, 'Huyện Ninh Giang', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (357, 27, 'Huyện Cẩm Giàng', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (358, 27, 'Huyện Thanh Hà', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (359, 27, 'Huyện Kim Thành', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (360, 27, 'Huyện Bình Giang', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (361, 31, 'Thị xã Hưng Yên', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (362, 31, 'Huyện Kim Động', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (363, 31, 'Huyện Ân Thi', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (364, 31, 'Huyện Khoái Châu', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (365, 31, 'Huyện Yên Mỹ', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (366, 31, 'Huyện Tiên Lữ', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (367, 31, 'Huyện Phù Cừ', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (368, 31, 'Huyện Mỹ Hào', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (369, 31, 'Huyện Văn Lâm', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (370, 31, 'Huyện Văn Giang', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (371, 30, 'Thành phố Hoà Bình', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (372, 30, 'Huyện Đà Bắc', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (373, 30, 'Huyện Mai Châu', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (374, 30, 'Huyện Tân Lạc', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (375, 30, 'Huyện Lạc Sơn', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (376, 30, 'Huyện Kỳ Sơn', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (377, 30, 'Huyện Lương Sơn', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (378, 30, 'Huyện Kim Bôi', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (379, 30, 'Huyện Lạc Thuỷ', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (380, 30, 'Huyện Yên Thuỷ', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (381, 30, 'Huyện Cao Phong', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (382, 25, 'Thành phố Phủ Lý', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (383, 25, 'Huyện Duy Tiên', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (384, 25, 'Huyện Kim Bảng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (385, 25, 'Huyện Lý Nhân', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (386, 25, 'Huỵện Thanh Liêm', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (387, 25, 'Huyện Bình Lục', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (388, 40, 'Thành phố Nam Định', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (389, 40, 'Huyện Mỹ Lộc', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (390, 40, 'Huyện Xuân Trường', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (391, 40, 'Huyện Giao Thủy', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (392, 40, 'Huyện Ý Yên', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (393, 40, 'Huyện Vụ Bản', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (394, 40, 'Huyện Nam Trực', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (395, 40, 'Huyện Trực Ninh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (396, 40, 'Huyện Nghĩa Hưng', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (397, 40, 'Huyện Hải Hậu', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (398, 54, 'Thành phố Thái Bình', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (399, 54, 'Huyện Quỳnh Phụ', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (400, 54, 'Huyện Hưng Hà', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (401, 54, 'Huyện Đông Hưng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (402, 54, 'Huyện Vũ Thư', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (403, 54, 'Huyện Kiến Xương', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (404, 54, 'Huyện Tiền Hải', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (405, 54, 'Huyện Thái Thuỵ', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (406, 42, 'Thành phố Ninh Bình', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (407, 42, 'Thị xã Tam Điệp', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (408, 42, 'Huyện Nho Quan', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (409, 42, 'Huyện Gia Viễn', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (410, 42, 'Huyện Hoa Lư', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (411, 42, 'Huyện Yên Mô', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (412, 42, 'Huyện Kim Sơn', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (413, 42, 'Huyện Yên Khánh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (414, 56, 'Thành phố Thanh Hoá', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (415, 56, 'Thị xã Bỉm Sơn', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (416, 56, 'Thị xã Sầm Sơn', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (417, 56, 'Huyện Quan Hoá', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (418, 56, 'Huyện Quan Sơn', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (419, 56, 'Huyện Mường Lát', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (420, 56, 'Huyện Bá Thước', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (421, 56, 'Huyện Thường Xuân', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (422, 56, 'Huyện Như Xuân', 22, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (423, 56, 'Huyện Như Thanh', 23, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (424, 56, 'Huyện Lang Chánh', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (425, 56, 'Huyện Ngọc Lặc', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (426, 56, 'Huyện Thạch Thành', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (427, 56, 'Huyện Cẩm Thủy', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (428, 56, 'Huyện Thọ Xuân', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (429, 56, 'Huyện Vĩnh Lộc', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (430, 56, 'Huyện Thiệu Hoá', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (431, 56, 'Huyện Triệu Sơn', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (432, 56, 'Huyện Nông Cống', 24, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (433, 56, 'Huyện Đông Sơn', 25, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (434, 56, 'Huyện Hà Trung', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (435, 56, 'Huyện Hoằng Hoá', 19, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (436, 56, 'Huyện Nga Sơn', 21, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (437, 56, 'Huyện Hậu Lộc', 20, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (438, 56, 'Huyện Quảng Xương', 26, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (439, 56, 'Huyện Tĩnh Gia', 27, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (440, 56, 'Huyện Yên Định', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (441, 41, 'Thành phố Vinh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (442, 41, 'Thị xã Cửa Lò', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (443, 41, 'Huyện Quỳ Châu', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (444, 41, 'Huyện Quỳ Hợp', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (445, 41, 'Huyện Nghĩa Đàn', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (446, 41, 'Huyện Quỳnh Lưu', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (447, 41, 'Huyện Kỳ Sơn', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (448, 41, 'Huyện Tương Dương', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (449, 41, 'Huyện Con Cuông', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (450, 41, 'Huyện Tân Kỳ', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (451, 41, 'Huyện Yên Thành', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (452, 41, 'Huyện Diễn Châu', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (453, 41, 'Huyện Anh Sơn', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (454, 41, 'Huyện Đô Lương', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (455, 41, 'Huyện Thanh Chương', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (456, 41, 'Huyện Nghi Lộc', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (457, 41, 'Huyện Nam Đàn', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (458, 41, 'Huyện Hưng Nguyên', 19, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (459, 41, 'Huyện Quế Phong', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (460, 26, 'Thành phố Hà Tĩnh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (461, 26, 'Thị xã Hồng Lĩnh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (462, 26, 'Huyện Hương Sơn', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (463, 26, 'Huyện Đức Thọ', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (464, 26, 'Huyện Nghi Xuân', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (465, 26, 'Huyện Can Lộc', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (466, 26, 'Huyện Hương Khê', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (467, 26, 'Huyện Thạch Hà', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (468, 26, 'Huyện Cẩm Xuyên', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (469, 26, 'Huyện Kỳ Anh', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (470, 26, 'Huyện Vũ Quang', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (471, 26, 'Huyện Lộc Hà', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (472, 46, 'Thành phố Đồng Hới', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (473, 46, 'Huyện Tuyên Hoá', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (474, 46, 'Huyện Minh Hoá', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (475, 46, 'Huyện Quảng Trạch', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (476, 46, 'Huyện Bố Trạch', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (477, 46, 'Huyện Quảng Ninh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (478, 46, 'Huyện Lệ Thuỷ', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (479, 50, 'Thị xã Đông Hà', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (480, 50, 'Thị xã Quảng Trị', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (481, 50, 'Huyện Vĩnh Linh', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (482, 50, 'Huyện Gio Linh', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (483, 50, 'Huyện Cam Lộ', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (484, 50, 'Huyện Triệu Phong', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (485, 50, 'Huyện Hải Lăng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (486, 50, 'Huyện Hướng Hoá', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (487, 50, 'Huyện Đăk Rông', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (488, 50, 'Huyện đảo Cồn cỏ', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (489, 57, 'Thành phố Huế', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (490, 57, 'Huyện Phong Điền', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (491, 57, 'Huyện Hương Trà', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (492, 57, 'Huyện Phú Vang', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (493, 57, 'Huyện Hương Thuỷ', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (494, 57, 'Huyện Nam Đông', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (495, 57, 'Huyện A Lưới', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (496, 57, 'Huyện Quảng Điền', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (497, 57, 'Huyện Phú Lộc', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (498, 47, 'Thành phố Tam Kỳ', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (499, 47, 'Thành phố Hội An', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (500, 47, 'Huyện Duy Xuyên', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (501, 47, 'Huyện Điện Bàn', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (502, 47, 'Huyện Đại Lộc', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (503, 47, 'Huyện Quế Sơn', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (504, 47, 'Huyện Hiệp Đức', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (505, 47, 'Huyện Thăng Bình', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (506, 47, 'Huyện Núi Thành', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (507, 47, 'Huyện Tiên Phước', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (508, 47, 'Huyện Bắc Trà My', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (509, 47, 'Huyện Đông Giang', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (510, 47, 'Huyện Nam Giang', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (511, 47, 'Huyện Phước Sơn', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (512, 47, 'Huyện Nam Trà My', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (513, 47, 'Huyện Tây Giang', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (514, 47, 'Huyện Phú Ninh', 17, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (515, 47, 'Huyện Nông Sơn', 18, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (516, 48, 'Thành phố Quảng Ngãi', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (517, 48, 'Huyện Lý Sơn', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (518, 48, 'Huyện Bình Sơn', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (519, 48, 'Huyện Trà Bồng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (520, 48, 'Huyện Sơn Tịnh', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (521, 48, 'Huyện Sơn Hà', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (522, 48, 'Huyện Tư Nghĩa', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (523, 48, 'Huyện Nghĩa Hành', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (524, 48, 'Huyện Minh Long', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (525, 48, 'Huyện Mộ Đức', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (526, 48, 'Huyện Đức Phổ', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (527, 48, 'Huyện Ba Tơ', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (528, 48, 'Huyện Sơn Tây', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (529, 48, 'Huyện Tây Trà', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (530, 34, 'Thị xã KonTum', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (531, 34, 'Huyện Đăk Glei', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (532, 34, 'Huyện Ngọc Hồi', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (533, 34, 'Huyện Đăk Tô', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (534, 34, 'Huyện Sa Thầy', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (535, 34, 'Huyện Kon Plong', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (536, 34, 'Huyện Đăk Hà', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (537, 34, 'Huyện Kon Rẫy', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (538, 34, 'Huyện Tu Mơ Rông', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (539, 10, 'Thành phố Quy Nhơn', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (540, 10, 'Huyện An Lão', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (541, 10, 'Huyện Hoài Ân', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (542, 10, 'Huyện Hoài Nhơn', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (543, 10, 'Huyện Phù Mỹ', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (544, 10, 'Huyện Phù Cát', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (545, 10, 'Huyện Vĩnh Thạnh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (546, 10, 'Huyện Tây Sơn', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (547, 10, 'Huyện Vân Canh', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (548, 10, 'Huyện An Nhơn', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (549, 10, 'Huyện Tuy Phước', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (550, 53, 'Thị xã Tây Ninh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (551, 53, 'Huyện Tân Biên', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (552, 53, 'Huyện Tân Châu', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (553, 53, 'Huyện Dương Minh Châu', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (554, 53, 'Huyện Châu Thành', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (555, 53, 'Huyện Hoà Thành', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (556, 53, 'Huyện Bến Cầu', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (557, 53, 'Huyện Gò Dầu', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (558, 53, 'Huyện Trảng Bàng', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (559, 45, 'Thành phố Tuy Hoà', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (560, 45, 'Huyện Đồng Xuân', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (561, 45, 'Huyện Sông Cầu', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (562, 45, 'Huyện Tuy An', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (563, 45, 'Huyện Sơn Hoà', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (564, 45, 'Huyện Sông Hinh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (565, 45, 'Huyện Đông Hoà', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (566, 45, 'Huyện Phú Hoà', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (567, 45, 'Huyện Tây Hoà', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (568, 13, 'Thành phố Phan Thiết', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (569, 13, 'Huyện Tuy Phong', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (570, 13, 'Huyện Bắc Bình', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (571, 13, 'Huyện Hàm Thuận Bắc', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (572, 13, 'Huyện Hàm Thuận Nam', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (573, 13, 'Huyện Hàm Tân', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (574, 13, 'Huyện Đức Linh', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (575, 13, 'Huyện Tánh Linh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (576, 13, 'Huyện đảo Phú Quý', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (577, 13, 'Thị xã LaGi', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (578, 21, 'Thành phố Biên Hoà', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (579, 21, 'Huyện Vĩnh Cửu', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (580, 21, 'Huyện Tân Phú', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (581, 21, 'Huyện Định Quán', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (582, 21, 'Huyện Thống Nhất', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (583, 21, 'Thị xã Long Khánh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (584, 21, 'Huyện Xuân Lộc', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (585, 21, 'Huyện Long Thành', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (586, 21, 'Huyện Nhơn Trạch', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (587, 21, 'Huyện Trảng Bom', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (588, 21, 'Huyện Cẩm Mỹ', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (589, 39, 'Thị xã Tân An', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (590, 39, 'Huyện Vĩnh Hưng', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (591, 39, 'Huyện Mộc Hoá', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (592, 39, 'Huyện Tân Thạnh', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (593, 39, 'Huyện Thạnh Hoá', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (594, 39, 'Huyện Đức Huệ', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (595, 39, 'Huyện Đức Hoà', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (596, 39, 'Huyện Bến Lức', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (597, 39, 'Huyện Thủ Thừa', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (598, 39, 'Huyện Châu Thành', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (599, 39, 'Huyện Tân Trụ', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (600, 39, 'Huyện Cần Đước', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (601, 39, 'Huyện Cần Giuộc', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (602, 39, 'Huyện Tân Hưng', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (603, 22, 'Thành phố Cao Lãnh', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (604, 22, 'Thị xã Sa Đéc', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (605, 22, 'Huyện Tân Hồng', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (606, 22, 'Huyện Hồng Ngự', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (607, 22, 'Huyện Tam Nông', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (608, 22, 'Huyện Thanh Bình', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (609, 22, 'Huyện Cao Lãnh', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (610, 22, 'Huyện Lấp Vò', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (611, 22, 'Huyện Tháp Mười', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (612, 22, 'Huyện Lai Vung', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (613, 22, 'Huyện Châu Thành', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (614, 11, 'Thị xã Thủ Dầu Một', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (615, 11, 'Huyện Bến Cát', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (616, 11, 'Huyện Tân Uyên', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (617, 11, 'Huyện Thuận An', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (618, 11, 'Huyện Dĩ An', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (619, 11, 'Huyện Phú Giáo', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (620, 11, 'Huyện Dầu Tiếng', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (621, 12, 'Thị xã Đồng Xoài', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (622, 12, 'Huyện Đồng Phú', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (623, 12, 'Huyện Chơn Thành', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (624, 12, 'Huyện Bình Long', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (625, 12, 'Huyện Lộc Ninh', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (626, 12, 'Huyện Bù Đốp', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (627, 12, 'Huyện Phước Long', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (628, 12, 'Huyện Bù Đăng', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (630, 43, 'TP.Phan Rang - Tháp Chàm', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (631, 43, 'Huyện Ninh Sơn', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (632, 43, 'Huyện Ninh Hải', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (633, 43, 'Huyện Ninh Phước', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (634, 43, 'Huyện Bác ái', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (635, 43, 'Huyện Thuận Bắc', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (636, 23, 'Thành phố Pleiku', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (637, 23, 'Huyện Chư Păh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (638, 23, 'Huyện Mang Yang', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (639, 23, 'Huyện Kbang', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (640, 23, 'Thị xã An Khê', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (641, 23, 'Huyện Kông Chro', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (642, 23, 'Huyện Đức Cơ', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (643, 23, 'Huyện Chưprông', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (644, 23, 'Huyện Chư Sê', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (646, 23, 'Huyện Krông Pa', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (647, 23, 'Huyện Ia Grai', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (648, 23, 'Huyện Đăk Đoa', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (649, 23, 'Huyện Ia Pa', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (650, 23, 'Huyện Đăk Pơ', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (651, 23, 'Huyện Phú Thiện', 16, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (652, 32, 'Thành phố Nha Trang', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (653, 32, 'Huyện Vạn Ninh', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (654, 32, 'Huyện Ninh Hoà', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (655, 32, 'Huyện Diên Khánh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (656, 32, 'Huyện Khánh Vĩnh', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (657, 32, 'Thị xã Cam Ranh', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (658, 32, 'Huyện Khánh Sơn', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (659, 32, 'Huyện Trường Sa', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (660, 32, 'Huyện Cam Lâm', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (661, 36, 'Thành phố Đà Lạt', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (662, 36, 'Thị xã Bảo Lộc', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (663, 36, 'Huyện Đức Trọng', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (664, 36, 'Huyện Di Linh', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (665, 36, 'Huyện Đơn Dương', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (666, 36, 'Huyện Lạc Dương', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (667, 36, 'Huyện Đạ Huoai', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (668, 36, 'Huyện Đạ Tẻh', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (669, 36, 'Huyện Cát Tiên', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (670, 36, 'Huyện Lâm Hà', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (671, 36, 'Huyện Bảo Lâm', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (672, 36, 'Huyện Đam Rông', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (675, 18, 'Thành phố Buôn Ma Thuột', 1, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (676, 18, 'Huyện Ea H Leo', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (677, 18, 'Huyện Krông Búk', 7, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (678, 18, 'Huyện Krông Năng', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (679, 18, 'Huyện Ea Súp', 4, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (680, 18, 'Huyện Cư M&#039;gar', 6, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (681, 18, 'Huyện Krông Pắc', 12, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (682, 18, 'Huyện Ea Kar', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (683, 18, 'Huyện M&#039;Đrắk', 10, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (684, 18, 'Huyện Krông Ana', 13, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (685, 18, 'Huyện Krông Bông', 11, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (686, 18, 'Huyện Lắk', 14, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (687, 18, 'Huyện Buôn Đôn', 5, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (688, 18, 'Huyện Cư Kuin', 15, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (692, 62, 'Huyện Sông Lô', 9, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (693, 17, 'Huyện Hoàng Sa', 8, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (694, 23, 'Thị xã Ayun Pa', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (695, 18, 'Thị xã Buôn Hồ', 2, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (696, 22, 'Thị xã Hồng Ngự', 3, 1)";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district (id, idprovince, title, weight, status) VALUES (697, 15, 'Huyện Thới Lai', 9, 1)";