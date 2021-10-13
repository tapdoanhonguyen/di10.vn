<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 15 Aug 2018 07:06:43 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if ($nv_Request->isset_request('submit', 'post')) {
    $row['purchase_id'] = $nv_Request->get_int('purchase_id', 'post', 0);
    $row['transfer_id'] = $nv_Request->get_int('transfer_id', 'post', 0);
    $row['product_id'] = $nv_Request->get_int('product_id', 'post', 0);
    $row['product_code'] = $nv_Request->get_title('product_code', 'post', '');
    $row['product_name'] = $nv_Request->get_title('product_name', 'post', '');
    $row['option_id'] = $nv_Request->get_int('option_id', 'post', 0);
    $row['net_unit_cost'] = $nv_Request->get_title('net_unit_cost', 'post', '');
    $row['quantity'] = $nv_Request->get_title('quantity', 'post', '');
    $row['warehouse_id'] = $nv_Request->get_int('warehouse_id', 'post', 0);
    $row['item_tax'] = $nv_Request->get_title('item_tax', 'post', '');
    $row['tax_rate_id'] = $nv_Request->get_int('tax_rate_id', 'post', 0);
    $row['tax'] = $nv_Request->get_title('tax', 'post', '');
    $row['discount'] = $nv_Request->get_title('discount', 'post', '');
    $row['item_discount'] = $nv_Request->get_title('item_discount', 'post', '');
    $row['expiry'] = $nv_Request->get_title('expiry', 'post', '');
    $row['subtotal'] = $nv_Request->get_title('subtotal', 'post', '');
    $row['quantity_balance'] = $nv_Request->get_title('quantity_balance', 'post', '');
    $row['date'] = $nv_Request->get_title('date', 'post', '');
    $row['status'] = $nv_Request->get_title('status', 'post', '');
    $row['unit_cost'] = $nv_Request->get_title('unit_cost', 'post', '');
    $row['real_unit_cost'] = $nv_Request->get_title('real_unit_cost', 'post', '');
    $row['quantity_received'] = $nv_Request->get_title('quantity_received', 'post', '');
    $row['supplier_part_no'] = $nv_Request->get_title('supplier_part_no', 'post', '');
    $row['purchase_item_id'] = $nv_Request->get_int('purchase_item_id', 'post', 0);
    $row['product_unit_id'] = $nv_Request->get_int('product_unit_id', 'post', 0);
    $row['product_unit_code'] = $nv_Request->get_title('product_unit_code', 'post', '');
    $row['unit_quantity'] = $nv_Request->get_title('unit_quantity', 'post', '');
    $row['gst'] = $nv_Request->get_title('gst', 'post', '');
    $row['cgst'] = $nv_Request->get_title('cgst', 'post', '');
    $row['sgst'] = $nv_Request->get_title('sgst', 'post', '');
    $row['igst'] = $nv_Request->get_title('igst', 'post', '');

    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                $stmt = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_purchase_items (purchase_id, transfer_id, product_id, product_code, product_name, option_id, net_unit_cost, quantity, warehouse_id, item_tax, tax_rate_id, tax, discount, item_discount, expiry, subtotal, quantity_balance, date, status, unit_cost, real_unit_cost, quantity_received, supplier_part_no, purchase_item_id, product_unit_id, product_unit_code, unit_quantity, gst, cgst, sgst, igst) VALUES (:purchase_id, :transfer_id, :product_id, :product_code, :product_name, :option_id, :net_unit_cost, :quantity, :warehouse_id, :item_tax, :tax_rate_id, :tax, :discount, :item_discount, :expiry, :subtotal, :quantity_balance, :date, :status, :unit_cost, :real_unit_cost, :quantity_received, :supplier_part_no, :purchase_item_id, :product_unit_id, :product_unit_code, :unit_quantity, :gst, :cgst, :sgst, :igst)');
            } else {
                $stmt = $db->prepare('UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_purchase_items SET purchase_id = :purchase_id, transfer_id = :transfer_id, product_id = :product_id, product_code = :product_code, product_name = :product_name, option_id = :option_id, net_unit_cost = :net_unit_cost, quantity = :quantity, warehouse_id = :warehouse_id, item_tax = :item_tax, tax_rate_id = :tax_rate_id, tax = :tax, discount = :discount, item_discount = :item_discount, expiry = :expiry, subtotal = :subtotal, quantity_balance = :quantity_balance, date = :date, status = :status, unit_cost = :unit_cost, real_unit_cost = :real_unit_cost, quantity_received = :quantity_received, supplier_part_no = :supplier_part_no, purchase_item_id = :purchase_item_id, product_unit_id = :product_unit_id, product_unit_code = :product_unit_code, unit_quantity = :unit_quantity, gst = :gst, cgst = :cgst, sgst = :sgst, igst = :igst WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':purchase_id', $row['purchase_id'], PDO::PARAM_INT);
            $stmt->bindParam(':transfer_id', $row['transfer_id'], PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $row['product_id'], PDO::PARAM_INT);
            $stmt->bindParam(':product_code', $row['product_code'], PDO::PARAM_STR);
            $stmt->bindParam(':product_name', $row['product_name'], PDO::PARAM_STR);
            $stmt->bindParam(':option_id', $row['option_id'], PDO::PARAM_INT);
            $stmt->bindParam(':net_unit_cost', $row['net_unit_cost'], PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $row['quantity'], PDO::PARAM_STR);
            $stmt->bindParam(':warehouse_id', $row['warehouse_id'], PDO::PARAM_INT);
            $stmt->bindParam(':item_tax', $row['item_tax'], PDO::PARAM_STR);
            $stmt->bindParam(':tax_rate_id', $row['tax_rate_id'], PDO::PARAM_INT);
            $stmt->bindParam(':tax', $row['tax'], PDO::PARAM_STR);
            $stmt->bindParam(':discount', $row['discount'], PDO::PARAM_STR);
            $stmt->bindParam(':item_discount', $row['item_discount'], PDO::PARAM_STR);
            $stmt->bindParam(':expiry', $row['expiry'], PDO::PARAM_STR);
            $stmt->bindParam(':subtotal', $row['subtotal'], PDO::PARAM_STR);
            $stmt->bindParam(':quantity_balance', $row['quantity_balance'], PDO::PARAM_STR);
            $stmt->bindParam(':date', $row['date'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $row['status'], PDO::PARAM_STR);
            $stmt->bindParam(':unit_cost', $row['unit_cost'], PDO::PARAM_STR);
            $stmt->bindParam(':real_unit_cost', $row['real_unit_cost'], PDO::PARAM_STR);
            $stmt->bindParam(':quantity_received', $row['quantity_received'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier_part_no', $row['supplier_part_no'], PDO::PARAM_STR);
            $stmt->bindParam(':purchase_item_id', $row['purchase_item_id'], PDO::PARAM_INT);
            $stmt->bindParam(':product_unit_id', $row['product_unit_id'], PDO::PARAM_INT);
            $stmt->bindParam(':product_unit_code', $row['product_unit_code'], PDO::PARAM_STR);
            $stmt->bindParam(':unit_quantity', $row['unit_quantity'], PDO::PARAM_STR);
            $stmt->bindParam(':gst', $row['gst'], PDO::PARAM_STR);
            $stmt->bindParam(':cgst', $row['cgst'], PDO::PARAM_STR);
            $stmt->bindParam(':sgst', $row['sgst'], PDO::PARAM_STR);
            $stmt->bindParam(':igst', $row['igst'], PDO::PARAM_STR);

            $exc = $stmt->execute();
            if ($exc) {
                $nv_Cache->delMod($module_name);
                if (empty($row['id'])) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Items_test', ' ', $admin_info['userid']);
                } else {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Items_test', 'ID: ' . $row['id'], $admin_info['userid']);
                }
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
            }
        } catch(PDOException $e) {
            trigger_error($e->getMessage());
            die($e->getMessage()); //Remove this line after checks finished
        }
    }
} elseif ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_purchase_items WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
} else {
    $row['id'] = 0;
    $row['purchase_id'] = 0;
    $row['transfer_id'] = 0;
    $row['product_id'] = 0;
    $row['product_code'] = '';
    $row['product_name'] = '';
    $row['option_id'] = 0;
    $row['net_unit_cost'] = '';
    $row['quantity'] = '';
    $row['warehouse_id'] = 0;
    $row['item_tax'] = '';
    $row['tax_rate_id'] = 0;
    $row['tax'] = '';
    $row['discount'] = '';
    $row['item_discount'] = '';
    $row['expiry'] = '';
    $row['subtotal'] = '';
    $row['quantity_balance'] = '0.0000';
    $row['date'] = '';
    $row['status'] = '';
    $row['unit_cost'] = '';
    $row['real_unit_cost'] = '';
    $row['quantity_received'] = '';
    $row['supplier_part_no'] = '';
    $row['purchase_item_id'] = 0;
    $row['product_unit_id'] = 0;
    $row['product_unit_code'] = '';
    $row['unit_quantity'] = '';
    $row['gst'] = '';
    $row['cgst'] = '';
    $row['sgst'] = '';
    $row['igst'] = '';
}
$xtpl = new XTemplate('items_test.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);


if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $title_manager_store;

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
