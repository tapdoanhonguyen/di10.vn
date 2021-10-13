<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 NV Systems,LTD. All rights reserved
 * @License: GNU/GPL version 2 or any later version
 * @Createdate Fri, 12 Oct 2018 02:53:25 GMT
 */

if (!defined('NV_IS_FILE_MODULES'))
    die('Stop!!!');

$sql_drop_module = array();
if($global_config['idsite'] == 0){
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_addresses";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_adjustment_items";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_adjustments";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_brands";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_calendar";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_captcha";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_categories";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_subcategories";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_cat_of_secondcategory";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_combo_items";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_companies";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_companies_user";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_companies_groups";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_costing";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_currencies";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_customer_groups";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_date_format";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_deliveries";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_deposits";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_expense_categories";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_expenses";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_gift_card_topups";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_gift_cards";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_groups";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_groups_user";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_ingredient_groups";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_login_attempts";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_migrations";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_notifications";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_order_ref";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_payments";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_paypal";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_permissions";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_pos_register";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_pos_settings";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_price_groups";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_printers";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_product_photos";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_product_prices";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_product_variants";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_product_of_category";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_products";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_purchase_items";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_purchases";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_quote_items";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_quotes";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_return_items";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_returns";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_sale_items";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_sales";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_settings";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_skrill";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_stock_count_items";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_stock_counts";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_stores";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_store_of_category";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_supply";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_supply_groups";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_suspended_bills";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_suspended_items";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_tax_rates";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_transfer_items";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_transfers";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_units";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_variants";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_warehouses";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_warehouses_products";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_warehouses_products_variants";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_users";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_production_plan";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_production_plan_users";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_vehicle_users";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_vehicle";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_project";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_project_log";
	$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_material_items";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='product_prefix'";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='customer_prefix'";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='sales_prefix'";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='quote_prefix'";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='purchase_prefix'";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='transfer_prefix'";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='delivery_prefix'";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='payment_prefix'";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='return_prefix'";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='returnp_prefix'";
	$sql_drop_module[] = "DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE config_name='expense_prefix'";
	$sql_create_module = $sql_drop_module;
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_addresses(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  company_id int(11) NOT NULL,
	  line1 varchar(50) NOT NULL,
	  line2 varchar(50) DEFAULT NULL,
	  city varchar(25) NOT NULL,
	  postal_code varchar(20) DEFAULT NULL,
	  state varchar(25) NOT NULL,
	  country varchar(50) NOT NULL,
	  phone varchar(50) DEFAULT NULL,
	  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (id),
	  KEY company_id (company_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_adjustment_items(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  adjustment_id int(11) NOT NULL,
	  product_id int(11) NOT NULL,
	  option_id int(11) DEFAULT NULL,
	  quantity decimal(15,4) NOT NULL,
	  warehouse_id int(11) NOT NULL,
	  serial_no varchar(255) DEFAULT NULL,
	  type varchar(20) NOT NULL,
	  PRIMARY KEY (id),
	  KEY adjustment_id (adjustment_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_adjustments(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  reference_no varchar(55) NOT NULL,
	  warehouse_id int(11) NOT NULL,
	  note text,
	  attachment varchar(55) DEFAULT NULL,
	  created_by int(11) NOT NULL,
	  updated_by int(11) DEFAULT NULL,
	  updated_at datetime DEFAULT NULL,
	  count_id int(11) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY warehouse_id (warehouse_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_brands(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  code varchar(20) DEFAULT NULL,
	  name varchar(50) NOT NULL,
	  image varchar(50) DEFAULT NULL,
	  slug varchar(55) DEFAULT NULL,
	  description varchar(255) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY name (name)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_calendar(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  title varchar(55) NOT NULL,
	  description varchar(255) DEFAULT NULL,
	  start datetime NOT NULL,
	  end datetime DEFAULT NULL,
	  color varchar(7) NOT NULL,
	  user_id int(11) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_captcha(
	  captcha_id bigint(13) unsigned NOT NULL AUTO_INCREMENT,
	  captcha_time int(10) unsigned NOT NULL,
	  ip_address varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
	  word varchar(20) CHARACTER SET latin1 NOT NULL,
	  PRIMARY KEY (captcha_id),
	  KEY word (word)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_categories(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  code varchar(55) NOT NULL,
	  name varchar(55) NOT NULL,
	  image varchar(55) DEFAULT NULL,
	  parent_id int(11) DEFAULT NULL,
	  alias varchar(250) DEFAULT NULL,
	  description varchar(255) DEFAULT NULL,
	  sort int(11) NOT NULL DEFAULT '0',
	  lev smallint(4) NOT NULL DEFAULT '0',
	  subcatid varchar(250) NOT NULL DEFAULT '',
	  secondcatid text,
	  secondcatid_main text,
	  weight smallint(4) NOT NULL DEFAULT '0',
	  add_time int(11) NOT NULL DEFAULT '0',
	  edit_time int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (id),
	  KEY id (id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_categories(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  code varchar(55) NOT NULL,
	  name varchar(55) NOT NULL,
	  image varchar(55) DEFAULT NULL,
	  parent_id int(11) DEFAULT NULL,
	  alias varchar(250) DEFAULT NULL,
	  description varchar(255) DEFAULT NULL,
	  sort int(11) NOT NULL DEFAULT '0',
	  lev smallint(4) NOT NULL DEFAULT '0',
	  subcatid varchar(250) NOT NULL DEFAULT '',
	  weight smallint(4) NOT NULL DEFAULT '0',
	  add_time int(11) NOT NULL DEFAULT '0',
	  edit_time int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (id),
	  KEY id (id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_subcategories(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  code varchar(55) NOT NULL,
	  name varchar(55) NOT NULL,
	  image varchar(55) DEFAULT NULL,
	  parent_id int(11) DEFAULT NULL,
	  alias varchar(250) DEFAULT NULL,
	  description varchar(255) DEFAULT NULL,
	  sort int(11) NOT NULL DEFAULT '0',
	  lev smallint(4) NOT NULL DEFAULT '0',
	  subcatid varchar(250) NOT NULL DEFAULT '',
	  weight smallint(4) NOT NULL DEFAULT '0',
	  add_time int(11) NOT NULL DEFAULT '0',
	  edit_time int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (id),
	  KEY id (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_combo_items(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  product_id int(11) NOT NULL,
	  item_code varchar(20) NOT NULL,
	  quantity decimal(12,4) NOT NULL,
	  unit_price decimal(25,4) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_companies(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  group_id int(10) unsigned DEFAULT NULL,
	  group_name varchar(20) NOT NULL,
	  customer_group_id int(11) DEFAULT NULL,
	  customer_group_name varchar(100) DEFAULT NULL,
	  name varchar(55) NOT NULL,
	  code varchar(250) NOT NULL,
	  company varchar(250) NOT NULL,
	  vat_no varchar(100) DEFAULT NULL,
	  address varchar(255) DEFAULT NULL,
	  city varchar(55) DEFAULT NULL,
	  state varchar(55) DEFAULT NULL,
	  postal_code varchar(8) DEFAULT NULL,
	  country varchar(100) DEFAULT NULL,
	  phone varchar(20) DEFAULT NULL,
	  email varchar(100) NOT NULL,
	  cf1 varchar(100) DEFAULT NULL,
	  cf2 varchar(100) DEFAULT NULL,
	  cf3 varchar(100) DEFAULT NULL,
	  cf4 varchar(100) DEFAULT NULL,
	  cf5 varchar(100) DEFAULT NULL,
	  cf6 varchar(100) DEFAULT NULL,
	  invoice_footer text,
	  payment_term int(11) DEFAULT '0',
	  logo varchar(250) DEFAULT 'logo.png',
	  award_points int(11) DEFAULT '0',
	  deposit_amount decimal(25,4) DEFAULT NULL,
	  price_group_id int(11) DEFAULT NULL,
	  price_group_name varchar(50) DEFAULT NULL,
	  gst_no varchar(100) DEFAULT NULL,
	  idsite int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (id),
	  KEY group_id (group_id),
	  KEY group_id_2 (group_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_costing(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date date NOT NULL,
	  product_id int(11) DEFAULT NULL,
	  sale_item_id int(11) NOT NULL,
	  sale_id int(11) DEFAULT NULL,
	  purchase_item_id int(11) DEFAULT NULL,
	  quantity decimal(15,4) NOT NULL,
	  purchase_net_unit_cost decimal(25,4) DEFAULT NULL,
	  purchase_unit_cost decimal(25,4) DEFAULT NULL,
	  sale_net_unit_price decimal(25,4) NOT NULL,
	  sale_unit_price decimal(25,4) NOT NULL,
	  quantity_balance decimal(15,4) DEFAULT NULL,
	  inventory tinyint(1) DEFAULT '0',
	  overselling tinyint(1) DEFAULT '0',
	  option_id int(11) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_currencies(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  code varchar(5) NOT NULL,
	  name varchar(55) NOT NULL,
	  rate decimal(12,4) NOT NULL,
	  auto_update tinyint(1) NOT NULL DEFAULT '0',
	  symbol varchar(50) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_customer_groups(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  name varchar(100) NOT NULL,
	  percent int(11) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_date_format(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  js varchar(20) NOT NULL,
	  php varchar(20) NOT NULL,
	  msql varchar(20) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_deliveries(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  sale_id int(11) NOT NULL,
	  do_reference_no varchar(50) NOT NULL,
	  sale_reference_no varchar(50) NOT NULL,
	  customer varchar(55) NOT NULL,
	  address varchar(1000) NOT NULL,
	  note varchar(1000) DEFAULT NULL,
	  status varchar(15) DEFAULT NULL,
	  attachment varchar(50) DEFAULT NULL,
	  delivered_by varchar(50) DEFAULT NULL,
	  received_by varchar(50) DEFAULT NULL,
	  created_by int(11) DEFAULT NULL,
	  updated_by int(11) DEFAULT NULL,
	  updated_at timestamp NULL DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_deposits(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  company_id int(11) NOT NULL,
	  amount decimal(25,4) NOT NULL,
	  paid_by varchar(50) DEFAULT NULL,
	  note varchar(255) DEFAULT NULL,
	  created_by int(11) NOT NULL,
	  updated_by int(11) NOT NULL,
	  updated_at datetime DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_expense_categories(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  code varchar(55) NOT NULL,
	  name varchar(55) NOT NULL,
	  PRIMARY KEY (id),
	  KEY id (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_expenses(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  reference varchar(50) NOT NULL,
	  amount decimal(25,4) NOT NULL,
	  note varchar(1000) DEFAULT NULL,
	  created_by varchar(55) NOT NULL,
	  attachment varchar(55) DEFAULT NULL,
	  category_id int(11) DEFAULT NULL,
	  warehouse_id int(11) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_gift_card_topups(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  card_id int(11) NOT NULL,
	  amount decimal(15,4) NOT NULL,
	  created_by int(11) NOT NULL,
	  PRIMARY KEY (id),
	  KEY card_id (card_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_gift_cards(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  card_no varchar(20) NOT NULL,
	  value decimal(25,4) NOT NULL,
	  customer_id int(11) DEFAULT NULL,
	  customer varchar(255) DEFAULT NULL,
	  balance decimal(25,4) NOT NULL,
	  expiry date DEFAULT NULL,
	  created_by varchar(55) NOT NULL,
	  PRIMARY KEY (id),
	  UNIQUE KEY card_no (card_no)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_groups(
	  id mediumint(8) UNSIGNED NOT NULL,
	  vi_title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
	  vi_description varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
	  idsite int(11) NOT NULL DEFAULT '0',
	  siteus int(11) NOT NULL DEFAULT '0',
	  weight int(11) NOT NULL,
	  email varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
	  content text COLLATE utf8mb4_unicode_ci NOT NULL,
	  group_type tinyint(4) NOT NULL,
	  group_color varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
	  group_avatar varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
	  require_2step_admin tinyint(1) NOT NULL,
	  require_2step_site tinyint(1) NOT NULL,
	  is_default tinyint(1) NOT NULL,
	  add_time int(11) NOT NULL,
	  exp_time int(11) NOT NULL,
	  act tinyint(1) NOT NULL,
	  numbers mediumint(9) NOT NULL,
	  config varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
	  siteid int(11) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_ingredient_groups(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  vi_title varchar(250) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_login_attempts(
	  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	  ip_address varbinary(16) NOT NULL,
	  login varchar(100) NOT NULL,
	  time int(11) unsigned DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_migrations(
	  version bigint(20) NOT NULL
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_notifications(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  comment text NOT NULL,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  from_date datetime DEFAULT NULL,
	  till_date datetime DEFAULT NULL,
	  scope tinyint(1) NOT NULL DEFAULT '3',
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_order_ref(
	  ref_id int(11) NOT NULL AUTO_INCREMENT,
	  date date NOT NULL,
	  orso int(11) NOT NULL DEFAULT '1',
	  orqu int(11) NOT NULL DEFAULT '1',
	  orpo int(11) NOT NULL DEFAULT '1',
	  orto int(11) NOT NULL DEFAULT '1',
	  orpos int(11) NOT NULL DEFAULT '1',
	  ordo int(11) NOT NULL DEFAULT '1',
	  pay int(11) NOT NULL DEFAULT '1',
	  orre int(11) NOT NULL DEFAULT '1',
	  rep int(11) NOT NULL DEFAULT '1',
	  orex int(11) NOT NULL DEFAULT '1',
	  ppay int(11) NOT NULL DEFAULT '1',
	  orqa int(11) DEFAULT '1',
	  PRIMARY KEY (ref_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_payments(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	  sale_id int(11) DEFAULT NULL,
	  return_id int(11) DEFAULT NULL,
	  purchase_id int(11) DEFAULT NULL,
	  reference_no varchar(50) NOT NULL,
	  transaction_id varchar(50) DEFAULT NULL,
	  paid_by varchar(20) NOT NULL,
	  cheque_no varchar(20) DEFAULT NULL,
	  cc_no varchar(20) DEFAULT NULL,
	  cc_holder varchar(25) DEFAULT NULL,
	  cc_month varchar(2) DEFAULT NULL,
	  cc_year varchar(4) DEFAULT NULL,
	  cc_type varchar(20) DEFAULT NULL,
	  amount decimal(25,4) NOT NULL,
	  currency varchar(3) DEFAULT NULL,
	  created_by int(11) NOT NULL,
	  attachment varchar(55) DEFAULT NULL,
	  type varchar(20) NOT NULL,
	  note varchar(1000) DEFAULT NULL,
	  pos_paid decimal(25,4) DEFAULT '0.0000',
	  pos_balance decimal(25,4) DEFAULT '0.0000',
	  approval_code varchar(50) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_paypal(
	  id int(11) NOT NULL,
	  active tinyint(4) NOT NULL,
	  account_email varchar(255) NOT NULL,
	  paypal_currency varchar(3) NOT NULL DEFAULT 'USD',
	  fixed_charges decimal(25,4) NOT NULL DEFAULT '2.0000',
	  extra_charges_my decimal(25,4) NOT NULL DEFAULT '3.9000',
	  extra_charges_other decimal(25,4) NOT NULL DEFAULT '4.4000',
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_permissions(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  group_id int(11) NOT NULL DEFAULT '0',
	  per_access text COLLATE utf8mb4_unicode_ci NOT NULL,
	  PRIMARY KEY (id) USING BTREE
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_pos_register(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  user_id int(11) NOT NULL,
	  cash_in_hand decimal(25,4) NOT NULL,
	  status varchar(10) NOT NULL,
	  total_cash decimal(25,4) DEFAULT NULL,
	  total_cheques int(11) DEFAULT NULL,
	  total_cc_slips int(11) DEFAULT NULL,
	  total_cash_submitted decimal(25,4) DEFAULT NULL,
	  total_cheques_submitted int(11) DEFAULT NULL,
	  total_cc_slips_submitted int(11) DEFAULT NULL,
	  note text,
	  closed_at timestamp NULL DEFAULT NULL,
	  transfer_opened_bills varchar(50) DEFAULT NULL,
	  closed_by int(11) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_pos_settings(
	  pos_id int(1) NOT NULL,
	  cat_limit int(11) NOT NULL,
	  pro_limit int(11) NOT NULL,
	  default_category int(11) NOT NULL,
	  default_customer int(11) NOT NULL,
	  default_biller int(11) NOT NULL,
	  display_time varchar(3) NOT NULL DEFAULT 'yes',
	  cf_title1 varchar(255) DEFAULT NULL,
	  cf_title2 varchar(255) DEFAULT NULL,
	  cf_value1 varchar(255) DEFAULT NULL,
	  cf_value2 varchar(255) DEFAULT NULL,
	  receipt_printer varchar(55) DEFAULT NULL,
	  cash_drawer_codes varchar(55) DEFAULT NULL,
	  focus_add_item varchar(55) DEFAULT NULL,
	  add_manual_product varchar(55) DEFAULT NULL,
	  customer_selection varchar(55) DEFAULT NULL,
	  add_customer varchar(55) DEFAULT NULL,
	  toggle_category_slider varchar(55) DEFAULT NULL,
	  toggle_subcategory_slider varchar(55) DEFAULT NULL,
	  cancel_sale varchar(55) DEFAULT NULL,
	  suspend_sale varchar(55) DEFAULT NULL,
	  print_items_list varchar(55) DEFAULT NULL,
	  finalize_sale varchar(55) DEFAULT NULL,
	  today_sale varchar(55) DEFAULT NULL,
	  open_hold_bills varchar(55) DEFAULT NULL,
	  close_register varchar(55) DEFAULT NULL,
	  keyboard tinyint(1) NOT NULL,
	  pos_printers varchar(255) DEFAULT NULL,
	  java_applet tinyint(1) NOT NULL,
	  product_button_color varchar(20) NOT NULL DEFAULT 'default',
	  tooltips tinyint(1) DEFAULT '1',
	  paypal_pro tinyint(1) DEFAULT '0',
	  stripe tinyint(1) DEFAULT '0',
	  rounding tinyint(1) DEFAULT '0',
	  char_per_line tinyint(4) DEFAULT '42',
	  pin_code varchar(20) DEFAULT NULL,
	  purchase_code varchar(100) DEFAULT 'purchase_code',
	  envato_username varchar(50) DEFAULT 'envato_username',
	  version varchar(10) DEFAULT '3.4.5',
	  after_sale_page tinyint(1) DEFAULT '0',
	  item_order tinyint(1) DEFAULT '0',
	  authorize tinyint(1) DEFAULT '0',
	  toggle_brands_slider varchar(55) DEFAULT NULL,
	  remote_printing tinyint(1) DEFAULT '1',
	  printer int(11) DEFAULT NULL,
	  order_printers varchar(55) DEFAULT NULL,
	  auto_print tinyint(1) DEFAULT '0',
	  customer_details tinyint(1) DEFAULT NULL,
	  local_printers tinyint(1) DEFAULT NULL,
	  PRIMARY KEY (pos_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_price_groups(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  name varchar(50) NOT NULL,
	  PRIMARY KEY (id),
	  KEY name (name)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_printers(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  title varchar(55) NOT NULL,
	  type varchar(25) NOT NULL,
	  profile varchar(25) NOT NULL,
	  char_per_line tinyint(3) unsigned DEFAULT NULL,
	  path varchar(255) DEFAULT NULL,
	  ip_address varbinary(45) DEFAULT NULL,
	  port varchar(10) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_product_photos(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  product_id int(11) NOT NULL,
	  photo varchar(100) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_product_prices(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  product_id int(11) NOT NULL,
	  price_group_id int(11) NOT NULL,
	  price decimal(25,4) NOT NULL,
	  PRIMARY KEY (id),
	  KEY product_id (product_id),
	  KEY price_group_id (price_group_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_product_variants(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  product_id int(11) NOT NULL,
	  name varchar(55) NOT NULL,
	  cost decimal(25,4) DEFAULT NULL,
	  price decimal(25,4) DEFAULT NULL,
	  quantity decimal(15,4) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_products(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  code varchar(50) NOT NULL,
	  name varchar(255) NOT NULL,
	  unit int(11) DEFAULT NULL,
	  cost decimal(25,4) DEFAULT NULL,
	  price decimal(25,4) NOT NULL,
	  alert_quantity decimal(15,4) DEFAULT '20.0000',
	  image varchar(255) DEFAULT 'no_image.png',
	  category_id varchar(250) NOT NULL,
	  subcategory_id int(11) DEFAULT NULL,
	  second_category_id int(11) DEFAULT NULL,
	  cf1 varchar(255) DEFAULT NULL,
	  cf2 varchar(255) DEFAULT NULL,
	  cf3 varchar(255) DEFAULT NULL,
	  cf4 varchar(255) DEFAULT NULL,
	  cf5 varchar(255) DEFAULT NULL,
	  cf6 varchar(255) DEFAULT NULL,
	  quantity decimal(15,4) DEFAULT '0.0000',
	  tax_rate int(11) DEFAULT NULL,
	  track_quantity tinyint(1) DEFAULT '1',
	  details text,
	  warehouse int(11) DEFAULT NULL,
	  barcode_symbology varchar(55) NOT NULL DEFAULT 'code128',
	  file varchar(100) DEFAULT NULL,
	  product_details text,
	  tax_method tinyint(1) DEFAULT '0',
	  type varchar(55) NOT NULL DEFAULT 'standard',
	  supplier1 int(11) DEFAULT NULL,
	  supplier1price decimal(25,4) DEFAULT NULL,
	  supplier2 int(11) DEFAULT NULL,
	  supplier2price decimal(25,4) DEFAULT NULL,
	  supplier3 int(11) DEFAULT NULL,
	  supplier3price decimal(25,4) DEFAULT NULL,
	  supplier4 int(11) DEFAULT NULL,
	  supplier4price decimal(25,4) DEFAULT NULL,
	  supplier5 int(11) DEFAULT NULL,
	  supplier5price decimal(25,4) DEFAULT NULL,
	  promotion tinyint(1) DEFAULT '0',
	  promo_price decimal(25,4) DEFAULT NULL,
	  start_date date DEFAULT NULL,
	  end_date date DEFAULT NULL,
	  supplier1_part_no varchar(50) DEFAULT NULL,
	  supplier2_part_no varchar(50) DEFAULT NULL,
	  supplier3_part_no varchar(50) DEFAULT NULL,
	  supplier4_part_no varchar(50) DEFAULT NULL,
	  supplier5_part_no varchar(50) DEFAULT NULL,
	  sale_unit int(11) DEFAULT NULL,
	  purchase_unit int(11) DEFAULT NULL,
	  brand int(11) DEFAULT NULL,
	  alias varchar(250) DEFAULT NULL,
	  featured tinyint(1) DEFAULT NULL,
	  weight smallint(4) DEFAULT NULL,
	  hsn_code int(11) DEFAULT NULL,
	  views int(11) NOT NULL DEFAULT '0',
	  hide tinyint(1) NOT NULL DEFAULT '0',
	  second_name varchar(255) DEFAULT NULL,
	  PRIMARY KEY (id),
	  UNIQUE KEY code (code),
	  KEY category_id (category_id),
	  KEY id (id),
	  KEY id_2 (id),
	  KEY category_id_2 (category_id),
	  KEY unit (unit),
	  KEY brand (brand)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_product_of_category (
	  product_id int(11) NOT NULL DEFAULT '0',
	  category_id int(11) NOT NULL DEFAULT '0',
	  UNIQUE KEY product_id (product_id,category_id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_purchase_items(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  purchase_id int(11) DEFAULT NULL,
	  transfer_id int(11) DEFAULT NULL,
	  product_id int(11) NOT NULL,
	  product_code varchar(50) NOT NULL,
	  product_name varchar(255) NOT NULL,
	  option_id int(11) DEFAULT NULL,
	  net_unit_cost decimal(25,4) NOT NULL,
	  quantity decimal(15,4) NOT NULL,
	  warehouse_id int(11) NOT NULL,
	  item_tax decimal(25,4) DEFAULT NULL,
	  tax_rate_id int(11) DEFAULT NULL,
	  tax varchar(20) DEFAULT NULL,
	  discount varchar(20) DEFAULT NULL,
	  item_discount decimal(25,4) DEFAULT NULL,
	  expiry date DEFAULT NULL,
	  subtotal decimal(25,4) NOT NULL,
	  quantity_balance decimal(15,4) DEFAULT '0.0000',
	  date int(11) NOT NULL,
	  status varchar(50) NOT NULL,
	  unit_cost decimal(25,4) DEFAULT NULL,
	  real_unit_cost decimal(25,4) DEFAULT NULL,
	  quantity_received decimal(15,4) DEFAULT NULL,
	  supplier_part_no varchar(50) DEFAULT NULL,
	  purchase_item_id int(11) DEFAULT NULL,
	  product_unit_id int(11) DEFAULT NULL,
	  product_unit_code varchar(10) DEFAULT NULL,
	  unit_quantity decimal(15,4) NOT NULL,
	  gst varchar(20) DEFAULT NULL,
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  puiidsite int(11) NOT NULL DEFAULT 0,
	  puiparentid int(11) NOT NULL DEFAULT 0,
	  PRIMARY KEY (id),
	  KEY purchase_id (purchase_id),
	  KEY product_id (product_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_purchases(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  reference_no varchar(55) NOT NULL,
	  date int(11) NOT NULL,
	  supplier_id int(11) NOT NULL,
	  warehouse_id int(11) NOT NULL,
	  note text NOT NULL,
	  total decimal(25,4) DEFAULT NULL,
	  product_discount decimal(25,4) DEFAULT NULL,
	  order_discount_id varchar(20) DEFAULT NULL,
	  order_discount decimal(25,4) DEFAULT NULL,
	  total_discount decimal(25,4) DEFAULT NULL,
	  product_tax decimal(25,4) DEFAULT NULL,
	  order_tax_id int(11) DEFAULT NULL,
	  order_tax decimal(25,4) DEFAULT NULL,
	  total_tax decimal(25,4) DEFAULT '0.0000',
	  shipping decimal(25,4) DEFAULT '0.0000',
	  grand_total decimal(25,4) NOT NULL,
	  paid decimal(25,4) NOT NULL DEFAULT '0.0000',
	  status int(3) DEFAULT NULL,
	  payment_status int(11) NOT NULL DEFAULT 0,
	  created_by int(11) DEFAULT NULL,
	  updated_by int(11) DEFAULT NULL,
	  updated_at timestamp NULL DEFAULT NULL,
	  attachment varchar(55) DEFAULT NULL,
	  payment_term tinyint(4) DEFAULT NULL,
	  due_date date DEFAULT NULL,
	  return_id int(11) DEFAULT NULL,
	  surcharge decimal(25,4) NOT NULL DEFAULT '0.0000',
	  return_purchase_ref varchar(55) DEFAULT NULL,
	  purchase_id int(11) DEFAULT NULL,
	  return_purchase_total decimal(25,4) NOT NULL DEFAULT '0.0000',
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  puidsite int(11) NOT NULL DEFAULT 0,
	  puparentid int(11) NOT NULL DEFAULT 0,
	  PRIMARY KEY (id),
	  KEY id (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_quote_items(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  quote_id int(11) NOT NULL,
	  product_id int(11) NOT NULL,
	  product_code varchar(55) NOT NULL,
	  product_name varchar(255) NOT NULL,
	  product_type varchar(20) DEFAULT NULL,
	  option_id int(11) DEFAULT NULL,
	  net_unit_price decimal(25,4) NOT NULL,
	  unit_price decimal(25,4) DEFAULT NULL,
	  quantity decimal(15,4) NOT NULL,
	  warehouse_id int(11) DEFAULT NULL,
	  item_tax decimal(25,4) DEFAULT NULL,
	  tax_rate_id int(11) DEFAULT NULL,
	  tax varchar(55) DEFAULT NULL,
	  discount varchar(55) DEFAULT NULL,
	  item_discount decimal(25,4) DEFAULT NULL,
	  subtotal decimal(25,4) NOT NULL,
	  serial_no varchar(255) DEFAULT NULL,
	  real_unit_price decimal(25,4) DEFAULT NULL,
	  product_unit_id int(11) DEFAULT NULL,
	  product_unit_code varchar(10) DEFAULT NULL,
	  unit_quantity decimal(15,4) NOT NULL,
	  gst varchar(20) DEFAULT NULL,
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY quote_id (quote_id),
	  KEY product_id (product_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_quotes(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  reference_no varchar(55) NOT NULL,
	  customer_id int(11) NOT NULL,
	  customer varchar(55) NOT NULL,
	  warehouse_id int(11) DEFAULT NULL,
	  biller_id int(11) NOT NULL,
	  biller varchar(55) NOT NULL,
	  note varchar(1000) DEFAULT NULL,
	  internal_note varchar(1000) DEFAULT NULL,
	  total decimal(25,4) NOT NULL,
	  product_discount decimal(25,4) DEFAULT '0.0000',
	  order_discount decimal(25,4) DEFAULT NULL,
	  order_discount_id varchar(20) DEFAULT NULL,
	  total_discount decimal(25,4) DEFAULT '0.0000',
	  product_tax decimal(25,4) DEFAULT '0.0000',
	  order_tax_id int(11) DEFAULT NULL,
	  order_tax decimal(25,4) DEFAULT NULL,
	  total_tax decimal(25,4) DEFAULT NULL,
	  shipping decimal(25,4) DEFAULT '0.0000',
	  grand_total decimal(25,4) NOT NULL,
	  status varchar(20) DEFAULT NULL,
	  created_by int(11) DEFAULT NULL,
	  updated_by int(11) DEFAULT NULL,
	  updated_at timestamp NULL DEFAULT NULL,
	  attachment varchar(55) DEFAULT NULL,
	  supplier_id int(11) DEFAULT NULL,
	  supplier varchar(55) DEFAULT NULL,
	  hash varchar(255) DEFAULT NULL,
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY id (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_return_items(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  return_id int(11) unsigned NOT NULL,
	  product_id int(11) unsigned NOT NULL,
	  product_code varchar(55) NOT NULL,
	  product_name varchar(255) NOT NULL,
	  product_type varchar(20) DEFAULT NULL,
	  option_id int(11) DEFAULT NULL,
	  net_unit_price decimal(25,4) NOT NULL,
	  unit_price decimal(25,4) DEFAULT NULL,
	  quantity decimal(15,4) NOT NULL,
	  warehouse_id int(11) DEFAULT NULL,
	  item_tax decimal(25,4) DEFAULT NULL,
	  tax_rate_id int(11) DEFAULT NULL,
	  tax varchar(55) DEFAULT NULL,
	  discount varchar(55) DEFAULT NULL,
	  item_discount decimal(25,4) DEFAULT NULL,
	  subtotal decimal(25,4) NOT NULL,
	  serial_no varchar(255) DEFAULT NULL,
	  real_unit_price decimal(25,4) DEFAULT NULL,
	  product_unit_id int(11) DEFAULT NULL,
	  product_unit_code varchar(10) DEFAULT NULL,
	  unit_quantity decimal(15,4) NOT NULL,
	  comment varchar(255) DEFAULT NULL,
	  gst varchar(20) DEFAULT NULL,
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY return_id (return_id),
	  KEY product_id (product_id),
	  KEY product_id_2 (product_id,return_id),
	  KEY return_id_2 (return_id,product_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_returns(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  reference_no varchar(55) NOT NULL,
	  customer_id int(11) NOT NULL,
	  customer varchar(55) NOT NULL,
	  biller_id int(11) NOT NULL,
	  biller varchar(55) NOT NULL,
	  warehouse_id int(11) DEFAULT NULL,
	  note varchar(1000) DEFAULT NULL,
	  staff_note varchar(1000) DEFAULT NULL,
	  total decimal(25,4) NOT NULL,
	  product_discount decimal(25,4) DEFAULT '0.0000',
	  order_discount_id varchar(20) DEFAULT NULL,
	  total_discount decimal(25,4) DEFAULT '0.0000',
	  order_discount decimal(25,4) DEFAULT '0.0000',
	  product_tax decimal(25,4) DEFAULT '0.0000',
	  order_tax_id int(11) DEFAULT NULL,
	  order_tax decimal(25,4) DEFAULT '0.0000',
	  total_tax decimal(25,4) DEFAULT '0.0000',
	  grand_total decimal(25,4) NOT NULL,
	  created_by int(11) DEFAULT NULL,
	  updated_by int(11) DEFAULT NULL,
	  updated_at timestamp NULL DEFAULT NULL,
	  total_items smallint(6) DEFAULT NULL,
	  paid decimal(25,4) DEFAULT '0.0000',
	  surcharge decimal(25,4) NOT NULL DEFAULT '0.0000',
	  attachment varchar(55) DEFAULT NULL,
	  hash varchar(255) DEFAULT NULL,
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY id (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_sale_items(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  sale_id int(11) unsigned NOT NULL,
	  product_id int(11) unsigned NOT NULL,
	  product_code varchar(55) NOT NULL,
	  product_name varchar(255) NOT NULL,
	  product_type varchar(20) DEFAULT NULL,
	  option_id int(11) DEFAULT NULL,
	  net_unit_price decimal(25,4) NOT NULL,
	  unit_price decimal(25,4) DEFAULT NULL,
	  quantity decimal(15,4) NOT NULL,
	  warehouse_id int(11) DEFAULT NULL,
	  item_tax decimal(25,4) DEFAULT NULL,
	  tax_rate_id int(11) DEFAULT NULL,
	  tax varchar(55) DEFAULT NULL,
	  discount varchar(55) DEFAULT NULL,
	  item_discount decimal(25,4) DEFAULT NULL,
	  subtotal decimal(25,4) NOT NULL,
	  serial_no varchar(255) DEFAULT NULL,
	  real_unit_price decimal(25,4) DEFAULT NULL,
	  sale_item_id int(11) DEFAULT NULL,
	  product_unit_id int(11) DEFAULT NULL,
	  product_unit_code varchar(10) DEFAULT NULL,
	  unit_quantity decimal(15,4) NOT NULL,
	  comment varchar(255) DEFAULT NULL,
	  gst varchar(20) DEFAULT NULL,
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  module varchar(250) NOT NULL,
	  PRIMARY KEY (id),
	  KEY sale_id (sale_id),
	  KEY product_id (product_id),
	  KEY product_id_2 (product_id,sale_id),
	  KEY sale_id_2 (sale_id,product_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_sales(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date int(11) NOT NULL DEFAULT '0',
	  reference_no varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
	  customer_id int(11) NOT NULL,
	  customer varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
	  projectid int(11) NOT NULL,
	  biller_id int(11) NOT NULL,
	  biller varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
	  warehouse_id int(11) DEFAULT NULL,
	  note varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  staff_note varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  total decimal(25,4) NOT NULL,
	  product_discount decimal(25,4) DEFAULT '0.0000',
	  order_discount_id varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  total_discount decimal(25,4) DEFAULT '0.0000',
	  order_discount decimal(25,4) DEFAULT '0.0000',
	  product_tax decimal(25,4) DEFAULT '0.0000',
	  order_tax_id int(11) DEFAULT NULL,
	  order_tax decimal(25,4) DEFAULT '0.0000',
	  total_tax decimal(25,4) DEFAULT '0.0000',
	  shipping decimal(25,4) DEFAULT '0.0000',
	  grand_total decimal(25,4) NOT NULL,
	  sale_status int(11) DEFAULT '0',
	  payment_status int(11) DEFAULT '0',
	  payment_term tinyint(4) DEFAULT NULL,
	  due_date date DEFAULT NULL,
	  created_by int(11) DEFAULT NULL,
	  updated_by int(11) DEFAULT NULL,
	  updated_at timestamp NULL DEFAULT NULL,
	  total_items smallint(6) DEFAULT NULL,
	  pos tinyint(1) NOT NULL DEFAULT '0',
	  paid decimal(25,4) DEFAULT '0.0000',
	  return_id int(11) DEFAULT NULL,
	  surcharge decimal(25,4) NOT NULL DEFAULT '0.0000',
	  attachment varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  return_sale_ref varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  sale_id int(11) DEFAULT NULL,
	  return_sale_total decimal(25,4) NOT NULL DEFAULT '0.0000',
	  rounding decimal(10,4) DEFAULT NULL,
	  suspend_note varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  api tinyint(1) DEFAULT '0',
	  shop tinyint(1) DEFAULT '0',
	  address_id int(11) DEFAULT NULL,
	  reserve_id int(11) DEFAULT NULL,
	  hash varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  manual_payment varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  payment_method varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  module varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
	  PRIMARY KEY (id),
	  KEY id (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_settings(
	  setting_id int(1) NOT NULL,
	  logo varchar(255) NOT NULL,
	  logo2 varchar(255) NOT NULL,
	  site_name varchar(55) NOT NULL,
	  language varchar(20) NOT NULL,
	  default_warehouse int(2) NOT NULL,
	  accounting_method tinyint(4) NOT NULL DEFAULT '0',
	  default_currency varchar(3) NOT NULL,
	  default_tax_rate int(2) NOT NULL,
	  rows_per_page int(2) NOT NULL,
	  version varchar(10) NOT NULL DEFAULT '1.0',
	  default_tax_rate2 int(11) NOT NULL DEFAULT '0',
	  dateformat int(11) NOT NULL,
	  product_prefix varchar(20) DEFAULT NULL,
	  sales_prefix varchar(20) DEFAULT NULL,
	  quote_prefix varchar(20) DEFAULT NULL,
	  purchase_prefix varchar(20) DEFAULT NULL,
	  transfer_prefix varchar(20) DEFAULT NULL,
	  delivery_prefix varchar(20) DEFAULT NULL,
	  payment_prefix varchar(20) DEFAULT NULL,
	  return_prefix varchar(20) DEFAULT NULL,
	  returnp_prefix varchar(20) DEFAULT NULL,
	  expense_prefix varchar(20) DEFAULT NULL,
	  item_addition tinyint(1) NOT NULL DEFAULT '0',
	  theme varchar(20) NOT NULL,
	  product_serial tinyint(4) NOT NULL,
	  default_discount int(11) NOT NULL,
	  product_discount tinyint(1) NOT NULL DEFAULT '0',
	  discount_method tinyint(4) NOT NULL,
	  tax1 tinyint(4) NOT NULL,
	  tax2 tinyint(4) NOT NULL,
	  overselling tinyint(1) NOT NULL DEFAULT '0',
	  restrict_user tinyint(4) NOT NULL DEFAULT '0',
	  restrict_calendar tinyint(4) NOT NULL DEFAULT '0',
	  timezone varchar(100) DEFAULT NULL,
	  iwidth int(11) NOT NULL DEFAULT '0',
	  iheight int(11) NOT NULL,
	  twidth int(11) NOT NULL,
	  theight int(11) NOT NULL,
	  watermark tinyint(1) DEFAULT NULL,
	  reg_ver tinyint(1) DEFAULT NULL,
	  allow_reg tinyint(1) DEFAULT NULL,
	  reg_notification tinyint(1) DEFAULT NULL,
	  auto_reg tinyint(1) DEFAULT NULL,
	  protocol varchar(20) NOT NULL DEFAULT 'mail',
	  mailpath varchar(55) DEFAULT '/usr/sbin/sendmail',
	  smtp_host varchar(100) DEFAULT NULL,
	  smtp_user varchar(100) DEFAULT NULL,
	  smtp_pass varchar(255) DEFAULT NULL,
	  smtp_port varchar(10) DEFAULT '25',
	  smtp_crypto varchar(10) DEFAULT NULL,
	  corn datetime DEFAULT NULL,
	  customer_group int(11) NOT NULL,
	  default_email varchar(100) NOT NULL,
	  mmode tinyint(1) NOT NULL,
	  bc_fix tinyint(4) NOT NULL DEFAULT '0',
	  auto_detect_barcode tinyint(1) NOT NULL DEFAULT '0',
	  captcha tinyint(1) NOT NULL DEFAULT '1',
	  reference_format tinyint(1) NOT NULL DEFAULT '1',
	  racks tinyint(1) DEFAULT '0',
	  attributes tinyint(1) NOT NULL DEFAULT '0',
	  product_expiry tinyint(1) NOT NULL DEFAULT '0',
	  decimals tinyint(2) NOT NULL DEFAULT '2',
	  qty_decimals tinyint(2) NOT NULL DEFAULT '2',
	  decimals_sep varchar(2) NOT NULL DEFAULT '.',
	  thousands_sep varchar(2) NOT NULL DEFAULT ',',
	  invoice_view tinyint(1) DEFAULT '0',
	  default_biller int(11) DEFAULT NULL,
	  envato_username varchar(50) DEFAULT NULL,
	  purchase_code varchar(100) DEFAULT NULL,
	  rtl tinyint(1) DEFAULT '0',
	  each_spent decimal(15,4) DEFAULT NULL,
	  ca_point tinyint(4) DEFAULT NULL,
	  each_sale decimal(15,4) DEFAULT NULL,
	  sa_point tinyint(4) DEFAULT NULL,
	  supdate tinyint(1) DEFAULT '0',
	  sac tinyint(1) DEFAULT '0',
	  display_all_products tinyint(1) DEFAULT '0',
	  display_symbol tinyint(1) DEFAULT NULL,
	  symbol varchar(50) DEFAULT NULL,
	  remove_expired tinyint(1) DEFAULT '0',
	  barcode_separator varchar(2) NOT NULL DEFAULT '-',
	  set_focus tinyint(1) NOT NULL DEFAULT '0',
	  price_group int(11) DEFAULT NULL,
	  barcode_img tinyint(1) NOT NULL DEFAULT '1',
	  ppayment_prefix varchar(20) DEFAULT 'POP',
	  disable_editing smallint(6) DEFAULT '90',
	  qa_prefix varchar(55) DEFAULT NULL,
	  update_cost tinyint(1) DEFAULT NULL,
	  apis tinyint(1) NOT NULL DEFAULT '0',
	  state varchar(100) DEFAULT NULL,
	  pdf_lib varchar(20) DEFAULT 'dompdf',
	  idsite int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (setting_id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_settings (setting_id, logo, logo2, site_name, language, default_warehouse, accounting_method, default_currency, default_tax_rate, rows_per_page, version, default_tax_rate2, dateformat, product_prefix, sales_prefix, quote_prefix, purchase_prefix, transfer_prefix, delivery_prefix, payment_prefix, return_prefix, returnp_prefix, expense_prefix, item_addition, theme, product_serial, default_discount, product_discount, discount_method, tax1, tax2, overselling, restrict_user, restrict_calendar, timezone, iwidth, iheight, twidth, theight, watermark, reg_ver, allow_reg, reg_notification, auto_reg, protocol, mailpath, smtp_host, smtp_user, smtp_pass, smtp_port, smtp_crypto, corn, customer_group, default_email, mmode, bc_fix, auto_detect_barcode, captcha, reference_format, racks, attributes, product_expiry, decimals, qty_decimals, decimals_sep, thousands_sep, invoice_view, default_biller, envato_username, purchase_code, rtl, each_spent, ca_point, each_sale, sa_point, supdate, sac, display_all_products, display_symbol, symbol, remove_expired, barcode_separator, set_focus, price_group, barcode_img, ppayment_prefix, disable_editing, qa_prefix, update_cost, apis, state, pdf_lib) VALUES
	(0, '', '', '', '', 0, 0, '', 0, 10, '3.4.5', 0, 0, 'SH', 'SALE', 'QUOTE', 'PO', 'TR', 'DO', 'IPAY', 'SR', 'PR', '', 0, '', 1, 0, 1, 1, 0, 0, 0, 1, 0, '', 800, 800, 150, 150, 0, 0, 0, 0, 0, 'mail', '/usr/sbin/sendmail', 'pop.gmail.com', 'contact@sma.tecdiary.org', 'jEFTM4T63AiQ9dsidxhPKt9CIg4HQjCN58n/RW9vmdC/UDXCzRLR469ziZ0jjpFlbOg43LyoSmpJLBkcAHh0Yw==', '25', '', '0000-00-00 00:00:00', 1, 'hoangnt@nguyenvan.vn', 0, 4, 1, 0, 2, 0, 0, 0, 2, 2, '.', ',', 0, 3, 'hoangtms', '12345678', 0, '0.0000', 0, '0.0000', 0, 0, 0, 0, 0, '', 0, '-', 0, 1, 1, 'POP', 90, '', 0, 0, '', '')";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_skrill(
	  id int(11) NOT NULL,
	  active tinyint(4) NOT NULL,
	  account_email varchar(255) NOT NULL DEFAULT 'testaccount2@moneybookers.com',
	  secret_word varchar(20) NOT NULL DEFAULT 'mbtest',
	  skrill_currency varchar(3) NOT NULL DEFAULT 'USD',
	  fixed_charges decimal(25,4) NOT NULL DEFAULT '0.0000',
	  extra_charges_my decimal(25,4) NOT NULL DEFAULT '0.0000',
	  extra_charges_other decimal(25,4) NOT NULL DEFAULT '0.0000',
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_stock_count_items(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  stock_count_id int(11) NOT NULL,
	  product_id int(11) NOT NULL,
	  product_code varchar(50) DEFAULT NULL,
	  product_name varchar(255) DEFAULT NULL,
	  product_variant varchar(55) DEFAULT NULL,
	  product_variant_id int(11) DEFAULT NULL,
	  expected decimal(15,4) NOT NULL,
	  counted decimal(15,4) NOT NULL,
	  cost decimal(25,4) NOT NULL,
	  PRIMARY KEY (id),
	  KEY stock_count_id (stock_count_id),
	  KEY product_id (product_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_stock_counts(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  reference_no varchar(55) NOT NULL,
	  warehouse_id int(11) NOT NULL,
	  type varchar(10) NOT NULL,
	  initial_file varchar(50) NOT NULL,
	  final_file varchar(50) DEFAULT NULL,
	  brands varchar(50) DEFAULT NULL,
	  brand_names varchar(100) DEFAULT NULL,
	  categories varchar(50) DEFAULT NULL,
	  category_names varchar(100) DEFAULT NULL,
	  note text,
	  products int(11) DEFAULT NULL,
	  rows int(11) DEFAULT NULL,
	  differences int(11) DEFAULT NULL,
	  matches int(11) DEFAULT NULL,
	  missing int(11) DEFAULT NULL,
	  created_by int(11) NOT NULL,
	  updated_by int(11) DEFAULT NULL,
	  updated_at datetime DEFAULT NULL,
	  finalized tinyint(1) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY warehouse_id (warehouse_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_stores(
	  store_id int(11) NOT NULL AUTO_INCREMENT,
	  parentid int(11) NOT NULL DEFAULT '0',
	  category_id varchar(250) NOT NULL DEFAULT '',
	  name varchar(64)  NOT NULL,
	  address varchar(250)  NOT NULL,
	  mobile varchar(250)  NOT NULL,
	  email varchar(250)  NOT NULL,
	  tax_code varchar(250)  NOT NULL,
	  contryid int(11) NOT NULL DEFAULT '0',
	  provinceid int(11) NOT NULL DEFAULT '0',
	  districtid int(11) NOT NULL DEFAULT '0',
	  wardid int(11) NOT NULL DEFAULT '0',
	  logo varchar(250)  NOT NULL,
	  url varchar(250)  NOT NULL,
	  userid int(11) NOT NULL DEFAULT '0',
	  sort_order int(3) NOT NULL,
	  lev int(11) NOT NULL DEFAULT '0',
	  weight int(11) NOT NULL DEFAULT '0',
	  numstore int(11) NOT NULL DEFAULT '0',
	  substoreid varchar(250) NOT NULL DEFAULT '',
	  PRIMARY KEY (store_id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_store_of_category (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  store_id int(11) NOT NULL DEFAULT '0',
	  category_id int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_product_of_store (
	  product_id int(11) NOT NULL,
	  store_id int(11) NOT NULL DEFAULT '0',
	  UNIQUE KEY product_id (product_id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_supply(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  vi_title varchar(250) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_supply_groups(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  vi_title varchar(250) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_groups_user (
	  group_id int(11) NOT NULL DEFAULT '0',
	  userid int(11) NOT NULL DEFAULT '0',
	  is_leader tinyint(1) NOT NULL,
	  approved tinyint(1) NOT NULL,
	  data text COLLATE utf8mb4_unicode_ci NOT NULL,
	  PRIMARY KEY (group_id,userid),
	  KEY userid (userid),
	  KEY group_id (group_id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_suspended_bills(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  customer_id int(11) NOT NULL,
	  customer varchar(55) DEFAULT NULL,
	  count int(11) NOT NULL,
	  order_discount_id varchar(20) DEFAULT NULL,
	  order_tax_id int(11) DEFAULT NULL,
	  total decimal(25,4) NOT NULL,
	  biller_id int(11) DEFAULT NULL,
	  warehouse_id int(11) DEFAULT NULL,
	  created_by int(11) NOT NULL,
	  suspend_note varchar(255) DEFAULT NULL,
	  shipping decimal(15,4) DEFAULT '0.0000',
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_suspended_items(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  suspend_id int(11) unsigned NOT NULL,
	  product_id int(11) unsigned NOT NULL,
	  product_code varchar(55) NOT NULL,
	  product_name varchar(255) NOT NULL,
	  net_unit_price decimal(25,4) NOT NULL,
	  unit_price decimal(25,4) NOT NULL,
	  quantity decimal(15,4) DEFAULT '0.0000',
	  warehouse_id int(11) DEFAULT NULL,
	  item_tax decimal(25,4) DEFAULT NULL,
	  tax_rate_id int(11) DEFAULT NULL,
	  tax varchar(55) DEFAULT NULL,
	  discount varchar(55) DEFAULT NULL,
	  item_discount decimal(25,4) DEFAULT NULL,
	  subtotal decimal(25,4) NOT NULL,
	  serial_no varchar(255) DEFAULT NULL,
	  option_id int(11) DEFAULT NULL,
	  product_type varchar(20) DEFAULT NULL,
	  real_unit_price decimal(25,4) DEFAULT NULL,
	  product_unit_id int(11) DEFAULT NULL,
	  product_unit_code varchar(10) DEFAULT NULL,
	  unit_quantity decimal(15,4) NOT NULL,
	  comment varchar(255) DEFAULT NULL,
	  gst varchar(20) DEFAULT NULL,
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_tax_rates(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  name varchar(55) NOT NULL,
	  code varchar(10) DEFAULT NULL,
	  rate decimal(12,4) NOT NULL,
	  type varchar(50) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_transfer_items(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  transfer_id int(11) NOT NULL,
	  product_id int(11) NOT NULL,
	  product_code varchar(55) NOT NULL,
	  product_name varchar(255) NOT NULL,
	  option_id int(11) DEFAULT NULL,
	  expiry date DEFAULT NULL,
	  quantity decimal(15,4) NOT NULL,
	  tax_rate_id int(11) DEFAULT NULL,
	  tax varchar(55) DEFAULT NULL,
	  item_tax decimal(25,4) DEFAULT NULL,
	  net_unit_cost decimal(25,4) DEFAULT NULL,
	  subtotal decimal(25,4) DEFAULT NULL,
	  quantity_balance decimal(15,4) NOT NULL,
	  unit_cost decimal(25,4) DEFAULT NULL,
	  real_unit_cost decimal(25,4) DEFAULT NULL,
	  date int(11) DEFAULT '0',
	  warehouse_id int(11) DEFAULT NULL,
	  product_unit_id int(11) DEFAULT NULL,
	  product_unit_code varchar(10) DEFAULT NULL,
	  unit_quantity decimal(15,4) NOT NULL,
	  gst varchar(20) DEFAULT NULL,
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY transfer_id (transfer_id),
	  KEY product_id (product_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_transfers(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  transfer_no varchar(55) NOT NULL,
	  date int(11) NOT NULL DEFAULT '0',
	  from_warehouse_id int(11) NOT NULL,
	  from_warehouse_code varchar(55) NOT NULL,
	  from_warehouse_name varchar(55) NOT NULL,
	  to_warehouse_id int(11) NOT NULL,
	  to_warehouse_code varchar(55) NOT NULL,
	  to_warehouse_name varchar(55) NOT NULL,
	  note varchar(1000) DEFAULT NULL,
	  total decimal(25,4) DEFAULT NULL,
	  total_tax decimal(25,4) DEFAULT NULL,
	  grand_total decimal(25,4) DEFAULT NULL,
	  created_by varchar(255) DEFAULT NULL,
	  status int(11) NOT NULL DEFAULT '0',
	  shipping decimal(25,4) NOT NULL DEFAULT '0.0000',
	  attachment varchar(55) DEFAULT NULL,
	  cgst decimal(25,4) DEFAULT NULL,
	  sgst decimal(25,4) DEFAULT NULL,
	  igst decimal(25,4) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY id (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_units(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  code varchar(10) NOT NULL,
	  name varchar(55) NOT NULL,
	  base_unit int(11) DEFAULT NULL,
	  operator varchar(1) DEFAULT NULL,
	  unit_value varchar(55) DEFAULT NULL,
	  operation_value varchar(55) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY base_unit (base_unit)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_variants(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  name varchar(55) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_warehouses(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  parentid int(11) NOT NULL DEFAULT '0',
	  code varchar(50) NOT NULL,
	  name varchar(255) NOT NULL,
	  address varchar(255) NOT NULL,
	  map varchar(255) DEFAULT NULL,
	  phone varchar(55) DEFAULT NULL,
	  email varchar(55) DEFAULT NULL,
	  price_group_id int(11) DEFAULT NULL,
	  store_id int(11) NOT NULL DEFAULT '0',
	  idsite int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (id),
	  KEY id (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_warehouses_products(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  product_id int(11) NOT NULL,
	  warehouse_id int(11) NOT NULL,
	  quantity decimal(15,4) NOT NULL,
	  rack varchar(55) DEFAULT NULL,
	  avg_cost decimal(25,4) NOT NULL,
	  PRIMARY KEY (id),
	  KEY product_id (product_id),
	  KEY warehouse_id (warehouse_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_warehouses_products_variants(
	  id int(11) NOT NULL AUTO_INCREMENT,
	  option_id int(11) NOT NULL,
	  product_id int(11) NOT NULL,
	  warehouse_id int(11) NOT NULL,
	  quantity decimal(15,4) NOT NULL,
	  rack varchar(55) DEFAULT NULL,
	  PRIMARY KEY (id),
	  KEY option_id (option_id),
	  KEY product_id (product_id),
	  KEY warehouse_id (warehouse_id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_api_role (
	  role_id smallint(4) NOT NULL AUTO_INCREMENT,
	  role_title varchar(250) NOT NULL DEFAULT '',
	  role_description text NOT NULL,
	  role_data text NOT NULL,
	  addtime int(11) NOT NULL DEFAULT '0',
	  edittime int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (role_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_api_credential (
	  admin_id int(11) unsigned NOT NULL,
	  credential_title varchar(255) NOT NULL DEFAULT '',
	  credential_ident varchar(50) NOT NULL DEFAULT '',
	  credential_secret varchar(250) NOT NULL DEFAULT '',
	  api_roles varchar(255) NOT NULL DEFAULT '',
	  addtime int(11) NOT NULL DEFAULT '0',
	  edittime int(11) NOT NULL DEFAULT '0',
	  last_access int(11) NOT NULL DEFAULT '0',
	  UNIQUE KEY credential_ident (credential_ident),
	  UNIQUE KEY credential_secret (credential_secret(191)),
	  KEY admin_id (admin_id)
	) ENGINE=InnoDB";


	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_users_stores (
	  userid int(11) NOT NULL DEFAULT '0',
	  storeid int(11) NOT NULL DEFAULT '0',
	  chain TINYINT(4) NOT NULL DEFAULT '0',
	  KEY (userid,storeid)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_users (
	  userid int(11) NOT NULL DEFAULT '0',
	  storeid int(11) NOT NULL DEFAULT '0',
	  is_admin tinyint(5) NOT NULL DEFAULT '0',
	  is_banned tinyint(5) NOT NULL DEFAULT '0',
	  is_staff tinyint(5) NOT NULL DEFAULT '0',
	  PRIMARY KEY (userid)
	) ENGINE=InnoDB";
	$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_users_stores (userid, storeid) VALUES
	('1', '0')";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_authors (
	  admin_id mediumint(8) unsigned NOT NULL,
	  editor varchar(100) DEFAULT '',
	  lev tinyint(1) unsigned NOT NULL DEFAULT '0',
	  files_level varchar(255) DEFAULT '',
	  position varchar(255) NOT NULL,
	  main_module varchar(50) NOT NULL DEFAULT 'siteinfo',
	  admin_theme varchar(100) NOT NULL DEFAULT '',
	  addtime int(11) NOT NULL DEFAULT '0',
	  edittime int(11) NOT NULL DEFAULT '0',
	  is_suspend tinyint(1) unsigned NOT NULL DEFAULT '0',
	  susp_reason text,
	  check_num varchar(40) NOT NULL,
	  last_login int(11) unsigned NOT NULL DEFAULT '0',
	  last_ip varchar(45) DEFAULT '',
	  last_agent varchar(255) DEFAULT '',
	   PRIMARY KEY (admin_id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_production_plan (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  projectid int(11) NOT NULL DEFAULT '0',
	  saleid int(11) NOT NULL,
	  timestart int(11) NOT NULL,
	  timeend int(11) NOT NULL,
	  userid varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
	  status tinyint(4) NOT NULL DEFAULT '0',
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_production_plan_user (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  projectid int(11) NOT NULL DEFAULT '0',
	  saleid int(11) NOT NULL,
	  planid int(11) NOT NULL,
	  userid int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_vehicle (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  projectid int(11) NOT NULL,
	  saleid int(11) NOT NULL,
	  timedelivery int(11) NOT NULL,
	  timereceipt int(11) NOT NULL,
	  listuser varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
	  status int(11) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_vehicle_user (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  projectid int(11) NOT NULL DEFAULT '0',
	  saleid int(11) NOT NULL,
	  vehicleid int(11) NOT NULL,
	  userid int(11) NOT NULL DEFAULT '0',
	  quantity int(11) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_project (
	  projectid int(11) NOT NULL,
	  title varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	  customerid int(11) NOT NULL DEFAULT '0'
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_project_log (
	  id int(11) NOT NULL,
	  lang varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
	  projectid int(11) NOT NULL,
	  saleid int(11) NOT NULL,
	  name_key varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
	  timemodify int(11) NOT NULL,
	  note varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
	  status int(11) NOT NULL,
	  userid int(11) NOT NULL
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_cat_of_secondcategory (
	  secondcat_id int(11) NOT NULL DEFAULT '0',
	  category_id int(11) NOT NULL DEFAULT '0',
	  UNIQUE KEY store_id (secondcat_id,category_id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_material_items (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  product_id int(11) NOT NULL,
	  item_code varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL,
	  item_id int(11) NOT NULL,
	  quantity decimal(12,4) NOT NULL,
	  unit_price decimal(25,4) DEFAULT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";

	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_companies_user (
	  id int(11) NOT NULL AUTO_INCREMENT,
	  company_id int(11) NOT NULL,
	  userid int(11) NOT NULL,
	  PRIMARY KEY (id)
	) ENGINE=InnoDB";
	$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_companies_groups (
	  groupid int(11) NOT NULL AUTO_INCREMENT,
	  vi_title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	  weight int(11) NOT NULL DEFAULT '0',
	  discount int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (groupid)
	) ENGINE=InnoDB" ;


	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_tax_rates (id, name, code, rate, type) VALUES
	(1, 'No Tax', 'NT', '0.0000', '2'),
	(2, 'VAT @10%', 'VAT10', '10.0000', '1'),
	(3, 'GST @6%', 'GST', '6.0000', '1'),
	(4, 'VAT @20%', 'VT20', '20.0000', '1')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 1, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 2, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 3, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 4, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 5, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 6, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 7, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 8, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 9, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 10, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 11, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 12, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 13, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 14, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 15, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 16, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 17, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 18, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 19, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 20, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 21, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 22, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 23, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 24, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions ( group_id, per_access) VALUES
	( 25, '{\"main\":{\"main_index\":1},\"permission\":{\"permission_index\":1,\"add\":1,\"edit\":1,\"delete\":1},\"products\":{\"products_index\":1,\"products_add\":1,\"products_edit\":1,\"products_delete\":1,\"products_cost\":1,\"products_price\":1,\"edit_price\":0,\"products_barcode\":1,\"products_adjustments\":1},\"sales\":{\"sales_index\":1,\"sales_add\":1,\"sales_edit\":1,\"sales_delete\":1,\"sales_pdf\":1,\"sales_email\":1,\"sales_return_sales\":1,\"sales_payments\":1},\"gift\":{\"gift_index\":1,\"gift_add\":1,\"gift_edit\":1,\"gift_delete\":1},\"purchases\":{\"purchases_index\":1,\"purchases_add\":1,\"purchases_edit\":1,\"purchases_delete\":1,\"purchases_pdf\":1,\"purchases_email\":1,\"purchases_payments\":1,\"purchases_expenses\":1,\"purchases_return_purchases\":1},\"transfers\":{\"transfers_index\":1,\"transfers_add\":1,\"transfers_edit\":1,\"transfers_delete\":1,\"transfers_pdf\":1,\"transfers_email\":1},\"returns\":{\"returns_index\":1,\"returns_add\":1,\"returns_edit\":1,\"returns_delete\":1,\"returns_pdf\":1,\"returns_email\":1},\"customers\":{\"customers_index\":1,\"customers_add\":1,\"customers_edit\":1,\"customers_delete\":1,\"customers_deposits\":1,\"customers_delete_deposit\":1},\"suppliers\":{\"suppliers_index\":1,\"suppliers_add\":1,\"suppliers_edit\":1,\"suppliers_delete\":1},\"reports\":{\"reports_index\":1,\"reports_warehouse_stock\":1,\"reports_quantity_alerts\":1,\"reports_expiry_alerts\":0,\"reports_products\":1,\"reports_daily_sales\":1,\"reports_monthly_sales\":1,\"reports_sales\":1,\"reports_purchases\":1,\"reports_profit_loss\":1,\"reports_customers\":1,\"reports_suppliers\":1,\"reports_staff\":1,\"reports_register\":0,\"reports_expenses\":1,\"reports_daily_purchases\":1,\"reports_monthly_purchases\":1,\"reports_tax\":1,\"reports_best_sellers\":1,\"reports_payments\":1,\"products_stock_count\":1},\"warehouses\":{\"warehouses_index\":null,\"warehouses_add\":null,\"warehouses_edit\":null,\"warehouses_delete\":null},\"config\":{\"config_index\":1,\"config_edit\":null},\"pos\":{\"pos_index\":1},\"cat\":{\"cat_index\":1,\"cat_add\":1,\"cat_edit\":1,\"cat_delete\":1},\"warehouse\":{\"warehouse_index\":1,\"warehouse_add\":1,\"warehouse_edit\":1,\"warehouse_delete\":1},\"store\":{\"store_index\":1,\"store_add\":1,\"store_edit\":1,\"store_delete\":1},\"other\":{\"bulk_actions\":1,\"ajax\":1}}')";
	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_order_ref (ref_id, date, orso, orqu, orpo, orto, orpos, ordo, pay, orre, rep, orex, ppay, orqa) VALUES
	(1, '1987-10-08', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'product_prefix', 'SH')";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'customer_prefix', 'C')";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'sales_prefix', 'SALES')";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'quote_prefix', 'QT')";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'purchase_prefix', 'PC')";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'transfer_prefix', 'TS')";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'delivery_prefix', 'DL')";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'payment_prefix', 'PM')";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'return_prefix', 'RT')";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'returnp_prefix', 'RTP')";
	$sql_create_module[] = "INSERT IGNORE INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('sys', '" . $module_name . "', 'expense_prefix', 'EP')";
	$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_groups (id, vi_title, vi_description, idsite, siteus, weight, email, content, group_type, group_color, group_avatar, require_2step_admin, require_2step_site, is_default, add_time, exp_time, act, numbers, config, siteid) VALUES
	(1, 'Quản trị hệ thống', '', 0, 0, 1, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(2, 'Quản trị chuỗi', '', 0, 0, 2, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 3, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(3, 'Quản lý hệ thống', '', 0, 0, 3, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(4, 'Tổng quản lý', '', 0, 0, 4, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, '', 0),
	(5, 'Kế toán', '', 0, 0, 5, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, '', 0),
	(6, 'Quản lý nhà hàng', '', 0, 0, 6, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, '', 0),
	(7, 'Quản lý giảm giá', '', 0, 0, 7, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, '', 0),
	(8, 'Quản lý tiền gửi', '', 0, 0, 8, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, '', 0),
	(9, 'Quản lý tiền mặt', '', 0, 0, 9, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, '', 0),
	(10, 'Quản lý kho', '', 0, 0, 10, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(11, 'Quản lý nhập hàng', '', 0, 0, 11, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(12, 'Quản lý khách hàng', '', 0, 0, 12, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(13, 'Quản lý nhà cung cấp', '', 0, 0, 13, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(14, 'Quản lý chi phí', '', 0, 0, 14, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(15, 'Quản lý sản phẩm', '', 0, 0, 15, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(16, 'Bán hàng', '', 0, 0, 18, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(17, 'Pha chế', '', 0, 0, 19, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(18, 'Bếp', '', 0, 0, 20, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(19, 'Phục vụ', '', 0, 0, 21, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(20, 'Thu ngân', '', 0, 0, 22, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(21, 'Phục vụ kiêm thu ngân', '', 0, 0, 23, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(22, 'Phục vụ', '', 0, 0, 24, '', '', 0, '', '', 0, 0, 0, 0, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(23, 'Đội xe', '', 0, 0, 16, '', '', 0, '', '', 0, 0, 0, 1568625181, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(24, 'Quản lý đội xe', '', 0, 0, 17, '', '', 0, '', '', 0, 0, 0, 1568625256, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0),
	(25, 'Đội sản xuất', '', 0, 0, 25, '', '', 0, '', '', 0, 0, 0, 1568773014, 0, 1, 0, 'a:7:{s:17:\"access_groups_add\";i:1;s:17:\"access_groups_del\";i:1;s:12:\"access_addus\";i:0;s:14:\"access_waiting\";i:0;s:13:\"access_editus\";i:0;s:12:\"access_delus\";i:0;s:13:\"access_passus\";i:0;}', 0)";

	$listuser = $db->query("select admin_id FROM " . NV_AUTHORS_GLOBALTABLE . " WHERE lev = 1" )->fetchAll();

	foreach ($listuser as $user){

	$sql_create_module[] = "INSERT IGNORE INTO " . $db_config['prefix'] . "_" . $module_data . "_groups_user (group_id, userid	, is_leader, approved, data) VALUES
	(1, " . $user['admin_id'] . ", 0, 1, '')";

	}
}
