<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV SYSTEMS LTD <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 NV SYSTEMS LTD. All rights reserved
 * @License: Not free read more http://nukeviet.systems/
 * @Createdate Wed, 22 Aug 2018 01:12:50 GMT
 */

if (!defined('NV_ADMIN'))
    die('Stop!!!');

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_categories (id, code, name, image, parent_id, alias, description) VALUES('1', 'C1', 'Category 1', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_companies (id, group_id, group_name, customer_group_id, customer_group_name, name, company, vat_no, address, city, state, postal_code, country, phone, email, cf1, cf2, cf3, cf4, cf5, cf6, invoice_footer, payment_term, logo, award_points, deposit_amount, price_group_id, price_group_name, gst_no) VALUES('1', '3', 'customer', '1', '', 'Walk-in Customer', 'Walk-in Customer', '', 'Customer Address', 'Petaling Jaya', 'Selangor', '46000', 'Malaysia', '0123456789', 'customer@tecdiary.com', '', '', '', '', '', '', '', '0', 'logo.png', '0', '', '0', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_companies (id, group_id, group_name, customer_group_id, customer_group_name, name, company, vat_no, address, city, state, postal_code, country, phone, email, cf1, cf2, cf3, cf4, cf5, cf6, invoice_footer, payment_term, logo, award_points, deposit_amount, price_group_id, price_group_name, gst_no) VALUES('2', '4', 'supplier', '', '', 'Test Supplier', 'Supplier Company Name', '', 'Supplier Address', 'Petaling Jaya', 'Selangor', '46050', 'Malaysia', '0123456789', 'supplier@tecdiary.com', '-', '-', '-', '-', '-', '-', '', '0', 'logo.png', '0', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_companies (id, group_id, group_name, customer_group_id, customer_group_name, name, company, vat_no, address, city, state, postal_code, country, phone, email, cf1, cf2, cf3, cf4, cf5, cf6, invoice_footer, payment_term, logo, award_points, deposit_amount, price_group_id, price_group_name, gst_no) VALUES('3', '', 'biller', '', '', 'Mian Saleem', 'Test Biller', '5555', 'Biller adddress', 'City', '', '', 'Country', '012345678', 'saleem@tecdiary.com', '', '', '', '', '', '', ' Thank you for shopping with us. Please come again', '0', 'logo1.png', '0', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_companies (id, group_id, group_name, customer_group_id, customer_group_name, name, company, vat_no, address, city, state, postal_code, country, phone, email, cf1, cf2, cf3, cf4, cf5, cf6, invoice_footer, payment_term, logo, award_points, deposit_amount, price_group_id, price_group_name, gst_no) VALUES('4', '0', '', '1', '', 'Nguyễn Thanh Hoàng', 'Công ty TNHH NVSystems', '', '12/3D Đường 06, Linh Xuân, Thủ Đức', 'Ho Chi Minh', 'Hồ Chí Minh', '700000', 'Vietnam', '0988455066', 'hoangnt@nguyenvan.vn', '', '', '', '', '', '', '', '0', 'logo.png', '0', '0.0000', '0', '', '0314683413')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_currencies (id, code, name, rate, auto_update, symbol) VALUES('1', 'USD', 'US Dollar', '1.0000', '0', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_currencies (id, code, name, rate, auto_update, symbol) VALUES('2', 'EUR', 'EURO', '0.7340', '0', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_currencies (id, code, name, rate, auto_update, symbol) VALUES('3', 'VND', 'Việt Nam Đồng', '23000.0000', '0', 'VND')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_customer_groups (id, name, percent) VALUES('1', 'General', '0')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_customer_groups (id, name, percent) VALUES('2', 'Reseller', '-5')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_customer_groups (id, name, percent) VALUES('3', 'Distributor', '-15')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_customer_groups (id, name, percent) VALUES('4', 'New Customer (+10)', '10')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_date_format (id, js, php, sql) VALUES('1', 'mm-dd-yyyy', 'm-d-Y', '%m-%d-%Y')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_date_format (id, js, php, sql) VALUES('2', 'mm/dd/yyyy', 'm/d/Y', '%m/%d/%Y')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_date_format (id, js, php, sql) VALUES('3', 'mm.dd.yyyy', 'm.d.Y', '%m.%d.%Y')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_date_format (id, js, php, sql) VALUES('4', 'dd-mm-yyyy', 'd-m-Y', '%d-%m-%Y')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_date_format (id, js, php, sql) VALUES('5', 'dd/mm/yyyy', 'd/m/Y', '%d/%m/%Y')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_date_format (id, js, php, sql) VALUES('6', 'dd.mm.yyyy', 'd.m.Y', '%d.%m.%Y')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_groups (id, name, description) VALUES('1', 'owner', 'Owner')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_groups (id, name, description) VALUES('2', 'admin', 'Administrator')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_groups (id, name, description) VALUES('3', 'customer', 'Customer')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_groups (id, name, description) VALUES('4', 'supplier', 'Supplier')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_groups (id, name, description) VALUES('5', 'sales', 'Sales Staff')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_login_attempts (id, ip_address, login, time) VALUES('3', '127.0.0.1', 'owner@tecdiary.com', '1533889897')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_login_attempts (id, ip_address, login, time) VALUES('4', '127.0.0.1', 'owner@tecdiary.com', '1533889968')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_login_attempts (id, ip_address, login, time) VALUES('6', '127.0.0.1', 'henho.top@gmail.com', '1533890103')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_login_attempts (id, ip_address, login, time) VALUES('7', '127.0.0.1', 'owner@tecdiary.com', '1533891345')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_login_attempts (id, ip_address, login, time) VALUES('10', '127.0.0.1', 'owner@tecdiary.com', '1533894355')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_login_attempts (id, ip_address, login, time) VALUES('11', '127.0.0.1', 'owner@tecdiary.com', '1533896765')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_migrations (version) VALUES('315')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_notifications (id, comment, date, from_date, till_date, scope) VALUES('1', '<p>Thank you for purchasing Stock Manager Advance. Please don't forget to check the documentation in help folder. If you find any error/bug, please email to support@tecdiary.com with details. You can send us your valued suggestions/feedback too.</p><p>Please rate Stock Manager Advance on your download page of codecanyon.net</p>', '2014-08-15 06:00:57', '2015-01-01 00:00:00', '2017-01-01 00:00:00', '3')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_order_ref (ref_id, date, so, qu, po, to, pos, do, pay, re, rep, ex, ppay, qa) VALUES('1', '2015-03-01', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_paypal (id, active, account_email, paypal_currency, fixed_charges, extra_charges_my, extra_charges_other) VALUES('1', '1', 'mypaypal@paypal.com', 'USD', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_permissions (id, group_id, products-index, products-add, products-edit, products-delete, products-cost, products-price, quotes-index, quotes-add, quotes-edit, quotes-pdf, quotes-email, quotes-delete, sales-index, sales-add, sales-edit, sales-pdf, sales-email, sales-delete, purchases-index, purchases-add, purchases-edit, purchases-pdf, purchases-email, purchases-delete, transfers-index, transfers-add, transfers-edit, transfers-pdf, transfers-email, transfers-delete, customers-index, customers-add, customers-edit, customers-delete, suppliers-index, suppliers-add, suppliers-edit, suppliers-delete, sales-deliveries, sales-add_delivery, sales-edit_delivery, sales-delete_delivery, sales-email_delivery, sales-pdf_delivery, sales-gift_cards, sales-add_gift_card, sales-edit_gift_card, sales-delete_gift_card, pos-index, sales-return_sales, reports-index, reports-warehouse_stock, reports-quantity_alerts, reports-expiry_alerts, reports-products, reports-daily_sales, reports-monthly_sales, reports-sales, reports-payments, reports-purchases, reports-profit_loss, reports-customers, reports-suppliers, reports-staff, reports-register, sales-payments, purchases-payments, purchases-expenses, products-adjustments, bulk_actions, customers-deposits, customers-delete_deposit, products-barcode, purchases-return_purchases, reports-expenses, reports-daily_purchases, reports-monthly_purchases, products-stock_count, edit_price, returns-index, returns-add, returns-edit, returns-delete, returns-email, returns-pdf, reports-tax) VALUES('1', '5', '1', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '0', '1', '1', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '1', '0', '0', '0', '0', '0', '1', '1', '1', '0', '0', '1', '1', '1', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_pos_settings (pos_id, cat_limit, pro_limit, default_category, default_customer, default_biller, display_time, cf_title1, cf_title2, cf_value1, cf_value2, receipt_printer, cash_drawer_codes, focus_add_item, add_manual_product, customer_selection, add_customer, toggle_category_slider, toggle_subcategory_slider, cancel_sale, suspend_sale, print_items_list, finalize_sale, today_sale, open_hold_bills, close_register, keyboard, pos_printers, java_applet, product_button_color, tooltips, paypal_pro, stripe, rounding, char_per_line, pin_code, purchase_code, envato_username, version, after_sale_page, item_order, authorize, toggle_brands_slider, remote_printing, printer, order_printers, auto_print, customer_details, local_printers) VALUES('1', '22', '20', '1', '1', '3', '1', 'GST Reg', 'VAT Reg', '123456789', '987654321', 'BIXOLON SRP-350II', 'x1C', 'Ctrl+F3', 'Ctrl+Shift+M', 'Ctrl+Shift+C', 'Ctrl+Shift+A', 'Ctrl+F11', 'Ctrl+F12', 'F4', 'F7', 'F9', 'F8', 'Ctrl+F1', 'Ctrl+F2', 'Ctrl+F10', '1', 'BIXOLON SRP-350II, BIXOLON SRP-350II', '0', 'default', '1', '0', '0', '0', '42', '', 'purchase_code', 'envato_username', '3.4.5', '0', '0', '0', '', '1', '', '', '0', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_price_groups (id, name) VALUES('1', 'Default')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_products (id, code, name, unit, cost, price, alert_quantity, image, category_id, subcategory_id, cf1, cf2, cf3, cf4, cf5, cf6, quantity, tax_rate, track_quantity, details, warehouse, barcode_symbology, file, product_details, tax_method, type, supplier1, supplier1price, supplier2, supplier2price, supplier3, supplier3price, supplier4, supplier4price, supplier5, supplier5price, promotion, promo_price, start_date, end_date, supplier1_part_no, supplier2_part_no, supplier3_part_no, supplier4_part_no, supplier5_part_no, sale_unit, purchase_unit, brand, alias, featured, weight, hsn_code, views, hide, second_name) VALUES('2', 'BIA', 'nvsystems', '3', '100000.0000', '0.0000', '1.0000', '', '1', '0', '', '', '', '', '', '', '1.0000', '2', '0', 'sađâsda', '0', 'code128', '', 'áđâsd', '1', 'standard', '0', '0.0000', '0', '0.0000', '0', '0.0000', '0', '0.0000', '0', '0.0000', '0', '0.0000', '0000-00-00', '0000-00-00', '', '', '', '', '', '3', '3', '0', 'nvsystems', '0', '0', '0', '0', '0', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_products (id, code, name, unit, cost, price, alert_quantity, image, category_id, subcategory_id, cf1, cf2, cf3, cf4, cf5, cf6, quantity, tax_rate, track_quantity, details, warehouse, barcode_symbology, file, product_details, tax_method, type, supplier1, supplier1price, supplier2, supplier2price, supplier3, supplier3price, supplier4, supplier4price, supplier5, supplier5price, promotion, promo_price, start_date, end_date, supplier1_part_no, supplier2_part_no, supplier3_part_no, supplier4_part_no, supplier5_part_no, sale_unit, purchase_unit, brand, alias, featured, weight, hsn_code, views, hide, second_name) VALUES('3', 'TIGER', 'tiger', '3', '100000.0000', '0.0000', '1.0000', '', '1', '0', '', '', '', '', '', '', '0.0000', '2', '0', 'áđasadá', '0', 'code128', '', 'ádsadsad', '1', 'standard', '0', '0.0000', '0', '0.0000', '0', '0.0000', '0', '0.0000', '0', '0.0000', '0', '0.0000', '0000-00-00', '0000-00-00', '', '', '', '', '', '3', '3', '0', 'tiger', '0', '0', '0', '0', '0', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('1', '0', '0', '2', '', '', '0', '0.0000', '10000.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '0000-00-00', '1', '0.0000', '0.0000', '10000.0000', '', '0', '0', '', '0.0000', '', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('2', '0', '0', '2', '', '', '0', '0.0000', '1000.0000', '1', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '0000-00-00', '1', '0.0000', '0.0000', '1000.0000', '', '0', '0', '', '0.0000', '', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('3', '0', '0', '2', '', '', '0', '0.0000', '10000.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '0000-00-00', '1', '0.0000', '0.0000', '10000.0000', '', '0', '0', '', '0.0000', '', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('4', '8', '0', '2', '', '', '0', '0.0000', '100.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '0000-00-00', '1', '0.0000', '0.0000', '100.0000', '', '0', '0', '', '0.0000', '', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('5', '8', '0', '3', '', '', '0', '0.0000', '1000.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '0000-00-00', '1', '0.0000', '0.0000', '1000.0000', '', '0', '0', '', '0.0000', '', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('6', '8', '0', '2', '', '', '0', '0.0000', '10000.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '0000-00-00', '1', '0.0000', '0.0000', '10000.0000', '', '0', '0', '', '0.0000', '', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('7', '10', '0', '2', '100000.0000', '100000.0000', '0', '0.0000', '11.0000', '3', '100000.0000', '100000', '100000.0000', '100000.0000', '100000.0000', '2010-00-00', '100000.0000', '100000.0000', '2010-00-00', '1', '0.0000', '0.0000', '11.0000', '', '0', '0', '', '0.0000', '', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('8', '11', '0', '2', '100000.0000', '100000.0000', '0', '0.0000', '1000.0000', '3', '100000.0000', '100000', '100000.0000', '100000.0000', '100000.0000', '2010-00-00', '100000.0000', '100000.0000', '2010-00-00', '1', '0.0000', '0.0000', '1000.0000', '', '0', '0', '', '0.0000', '', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('9', '12', '0', '2', '100000.0000', '100000.0000', '0', '0.0000', '1.0000', '3', '100000.0000', '100000', '100000.0000', '100000.0000', '100000.0000', '2010-00-00', '100000.0000', '100000.0000', '2010-00-00', '1', '0.0000', '0.0000', '1.0000', '', '0', '0', '', '0.0000', '', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('10', '13', '0', '2', '100000.0000', '100000.0000', '0', '0.0000', '1.0000', '3', '100000.0000', '100000', '100000.0000', '100000.0000', '100000.0000', '2010-00-00', '100000.0000', '100000.0000', '2010-00-00', '1', '0.0000', '0.0000', '1.0000', '', '0', '0', '', '0.0000', '', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('11', '35', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '0', '', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('12', '36', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '0', '', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('13', '37', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '0', '', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('14', '38', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '0', '', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('15', '39', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '0', '', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('16', '40', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '0', '', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('17', '42', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('18', '43', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('19', '44', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('20', '45', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('21', '46', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('22', '47', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('23', '48', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('24', '49', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('25', '50', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('26', '51', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('27', '52', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('28', '53', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('29', '54', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('30', '55', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('31', '56', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('32', '57', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('33', '58', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('34', '59', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('35', '60', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('36', '61', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('37', '62', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('38', '63', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('39', '64', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('40', '65', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('41', '68', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '1970-01-01', '1', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('42', '69', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '1970-01-01', '4', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '2.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('43', '70', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '1970-01-01', '4', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '2.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('44', '71', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '1970-01-01', '', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchase_items (id, purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES('45', '72', '', '2', 'BIA', 'nvsystems', '', '0.0000', '0.0000', '3', '0.0000', '0', '', '', '0.0000', '0000-00-00', '0.0000', '0.0000', '1970-01-01', '', '0.0000', '0.0000', '0.0000', '', '', '3', 'CAI', '1.0000', '', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('1', '', '0', '4', '1', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0', 'pending', '2', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('2', '', '1534525200', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('3', '', '1534494300', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '4', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('4', '', '1534580700', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('5', '', '1535703900', '4', '1', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('6', '', '1535444700', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('7', '', '1535271900', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('8', '', '1535271900', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('9', '', '1535185500', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('10', '', '1535185500', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('11', '', '1535729100', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('12', '', '1535642700', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('13', '', '1534865100', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '0', '0', '0000-00-00 00:00:00', '', '0', '0000-00-00', '0', '0.0000', '', '0', '0.0000', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('14', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('15', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('16', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('17', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('18', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('19', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('20', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('21', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('22', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('23', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('24', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('25', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('26', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('27', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('28', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('29', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('30', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('31', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('32', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('33', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('34', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('35', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('36', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('37', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('38', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('39', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('40', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('41', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('42', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('43', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('44', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('45', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('46', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('47', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('48', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('49', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('50', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('51', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('52', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('53', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('54', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('55', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('56', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('57', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('58', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('59', '', '0', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('60', '', '1534951500', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('61', '', '1534951500', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('62', '', '1534951500', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('63', '', '1534951500', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('64', '', '1535124300', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('65', '', '1535124300', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('66', '', '1535124300', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('67', '', '1535124300', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('68', '', '1535037900', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('69', '', '1534951500', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '4', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('70', '', '1534951500', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '4', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('71', '', '1534865100', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_purchases (id, reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES('72', '', '1535037900', '4', '3', '', '0.0000', '0.0000', '', '0.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0', '', '', '', '', '', '0', '0000-00-00', '0', '0.0000', '', '', '0.0000', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_settings (setting_id, logo, logo2, site_name, language, default_warehouse, accounting_method, default_currency, default_tax_rate, rows_per_page, version, default_tax_rate2, dateformat, sales_prefix, quote_prefix, purchase_prefix, transfer_prefix, delivery_prefix, payment_prefix, return_prefix, returnp_prefix, expense_prefix, item_addition, theme, product_serial, default_discount, product_discount, discount_method, tax1, tax2, overselling, restrict_user, restrict_calendar, timezone, iwidth, iheight, twidth, theight, watermark, reg_ver, allow_reg, reg_notification, auto_reg, protocol, mailpath, smtp_host, smtp_user, smtp_pass, smtp_port, smtp_crypto, corn, customer_group, default_email, mmode, bc_fix, auto_detect_barcode, captcha, reference_format, racks, attributes, product_expiry, decimals, qty_decimals, decimals_sep, thousands_sep, invoice_view, default_biller, envato_username, purchase_code, rtl, each_spent, ca_point, each_sale, sa_point, update, sac, display_all_products, display_symbol, symbol, remove_expired, barcode_separator, set_focus, price_group, barcode_img, ppayment_prefix, disable_editing, qa_prefix, update_cost, apis, state, pdf_lib) VALUES('1', 'logo2.png', 'logo3.png', 'Quản lý bán hàng - VIC', 'vietnamese', '1', '0', 'USD', '1', '10', '3.4.5', '1', '5', 'SALE', 'QUOTE', 'PO', 'TR', 'DO', 'IPAY', 'SR', 'PR', '', '0', 'default', '1', '1', '1', '1', '1', '1', '0', '1', '0', 'Asia/Ho_Chi_Minh', '800', '800', '150', '150', '0', '0', '0', '0', '', 'mail', '/usr/sbin/sendmail', 'pop.gmail.com', 'contact@sma.tecdiary.org', 'jEFTM4T63AiQ9dsidxhPKt9CIg4HQjCN58n/RW9vmdC/UDXCzRLR469ziZ0jjpFlbOg43LyoSmpJLBkcAHh0Yw==', '25', '', '', '1', 'contact@tecdiary.com', '0', '4', '1', '0', '2', '1', '1', '0', '2', '2', '.', ',', '0', '3', 'nguyenthanhhoang', '12345678', '0', '', '', '', '', '0', '0', '0', '0', '', '0', '-', '0', '1', '1', 'POP', '90', '', '0', '0', 'AN', 'dompdf')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_skrill (id, active, account_email, secret_word, skrill_currency, fixed_charges, extra_charges_my, extra_charges_other) VALUES('1', '1', 'testaccount2@moneybookers.com', 'mbtest', 'USD', '0.0000', '0.0000', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_stores (store_id, name, url, sort_order) VALUES('1', 'NV Tools', 'http://nvtool.nv', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_tax_rates (id, name, code, rate, type) VALUES('1', 'No Tax', 'NT', '0.0000', '2')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_tax_rates (id, name, code, rate, type) VALUES('2', 'VAT @10%', 'VAT10', '10.0000', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_tax_rates (id, name, code, rate, type) VALUES('3', 'GST @6%', 'GST', '6.0000', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_tax_rates (id, name, code, rate, type) VALUES('4', 'VAT @20%', 'VT20', '20.0000', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_units (id, code, name, base_unit, operator, unit_value, operation_value) VALUES('1', 'KG', 'Kg', '0', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_units (id, code, name, base_unit, operator, unit_value, operation_value) VALUES('2', 'GRAM', 'Gram', '1', '/', '', '1000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_units (id, code, name, base_unit, operator, unit_value, operation_value) VALUES('3', 'CAI', 'Cái', '0', '', '', '')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_warehouses (id, code, name, address, map, phone, email, price_group_id, store_id) VALUES('1', 'WHI', 'Warehouse 1', '<p>Address, City</p>', '', '012345678', 'whi@tecdiary.com', '', '0')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_warehouses (id, code, name, address, map, phone, email, price_group_id, store_id) VALUES('2', 'WHII', 'Warehouse 2', '<p>Warehouse 2, Jalan Sultan Ismail, 54000, Kuala Lumpur</p>', '', '0105292122', 'whii@tecdiary.com', '', '0')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_warehouses (id, code, name, address, map, phone, email, price_group_id, store_id) VALUES('3', 'NVTPHCM', 'Kho NV Systems TPHCM', '12/3D Đường 06, Linh Xuân, Thủ Đức', '', '988455066', 'adminwmt@gmail.com', '1', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_warehouses_products (id, product_id, warehouse_id, quantity, rack, avg_cost) VALUES('1', '2', '3', '0.0000', '', '0.0000')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
