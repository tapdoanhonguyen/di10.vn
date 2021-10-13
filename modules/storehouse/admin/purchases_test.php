<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Aug 2018 07:37:29 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_purchases  WHERE id = ' . $db->quote($id));
        $nv_Cache->delMod($module_name);
        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Purchases_test', 'ID: ' . $id, $admin_info['userid']);
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if ($nv_Request->isset_request('submit', 'post')) {
    $row['reference_no'] = $nv_Request->get_title('reference_no', 'post', '');
    $row['date'] = $nv_Request->get_int('date', 'post', 0);
    $row['supplier_id'] = $nv_Request->get_int('supplier_id', 'post', 0);
    $row['warehouse_id'] = $nv_Request->get_int('warehouse_id', 'post', 0);
    $row['note'] = $nv_Request->get_editor('note', '', NV_ALLOWED_HTML_TAGS);
    $row['total'] = $nv_Request->get_title('total', 'post', '');
    $row['product_discount'] = $nv_Request->get_title('product_discount', 'post', '');
    $row['order_discount_id'] = $nv_Request->get_title('order_discount_id', 'post', '');
    $row['order_discount'] = $nv_Request->get_title('order_discount', 'post', '');
    $row['total_discount'] = $nv_Request->get_title('total_discount', 'post', '');
    $row['product_tax'] = $nv_Request->get_title('product_tax', 'post', '');
    $row['order_tax_id'] = $nv_Request->get_int('order_tax_id', 'post', 0);
    $row['order_tax'] = $nv_Request->get_title('order_tax', 'post', '');
    $row['total_tax'] = $nv_Request->get_title('total_tax', 'post', '');
    $row['shipping'] = $nv_Request->get_title('shipping', 'post', '');
    $row['grand_total'] = $nv_Request->get_title('grand_total', 'post', '');
    $row['paid'] = $nv_Request->get_title('paid', 'post', '');
    $row['status'] = $nv_Request->get_title('status', 'post', '');
    $row['payment_status'] = $nv_Request->get_title('payment_status', 'post', '');
    $row['created_by'] = $nv_Request->get_int('created_by', 'post', 0);
    $row['updated_by'] = $nv_Request->get_int('updated_by', 'post', 0);
    $row['updated_at'] = $nv_Request->get_title('updated_at', 'post', '');
    $row['attachment'] = $nv_Request->get_title('attachment', 'post', '');
    if (is_file(NV_DOCUMENT_ROOT . $row['attachment']))     {
        $row['attachment'] = substr($row['attachment'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'));
    } else {
        $row['attachment'] = '';
    }
    $row['payment_term'] = $nv_Request->get_int('payment_term', 'post', 0);
    $row['due_date'] = $nv_Request->get_title('due_date', 'post', '');
    $row['return_id'] = $nv_Request->get_int('return_id', 'post', 0);
    $row['surcharge'] = $nv_Request->get_title('surcharge', 'post', '');
    $row['return_purchase_ref'] = $nv_Request->get_title('return_purchase_ref', 'post', '');
    $row['purchase_id'] = $nv_Request->get_int('purchase_id', 'post', 0);
    $row['return_purchase_total'] = $nv_Request->get_title('return_purchase_total', 'post', '');
    $row['cgst'] = $nv_Request->get_title('cgst', 'post', '');
    $row['sgst'] = $nv_Request->get_title('sgst', 'post', '');
    $row['igst'] = $nv_Request->get_title('igst', 'post', '');

    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                $stmt = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_purchases (reference_no, date, supplier_id, warehouse_id, note, total, product_discount, order_discount_id, order_discount, total_discount, product_tax, order_tax_id, order_tax, total_tax, shipping, grand_total, paid, status, payment_status, created_by, updated_by, updated_at, attachment, payment_term, due_date, return_id, surcharge, return_purchase_ref, purchase_id, return_purchase_total, cgst, sgst, igst) VALUES (:reference_no, :date, :supplier_id, :warehouse_id, :note, :total, :product_discount, :order_discount_id, :order_discount, :total_discount, :product_tax, :order_tax_id, :order_tax, :total_tax, :shipping, :grand_total, :paid, :status, :payment_status, :created_by, :updated_by, :updated_at, :attachment, :payment_term, :due_date, :return_id, :surcharge, :return_purchase_ref, :purchase_id, :return_purchase_total, :cgst, :sgst, :igst)');
            } else {
                $stmt = $db->prepare('UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_purchases SET reference_no = :reference_no, date = :date, supplier_id = :supplier_id, warehouse_id = :warehouse_id, note = :note, total = :total, product_discount = :product_discount, order_discount_id = :order_discount_id, order_discount = :order_discount, total_discount = :total_discount, product_tax = :product_tax, order_tax_id = :order_tax_id, order_tax = :order_tax, total_tax = :total_tax, shipping = :shipping, grand_total = :grand_total, paid = :paid, status = :status, payment_status = :payment_status, created_by = :created_by, updated_by = :updated_by, updated_at = :updated_at, attachment = :attachment, payment_term = :payment_term, due_date = :due_date, return_id = :return_id, surcharge = :surcharge, return_purchase_ref = :return_purchase_ref, purchase_id = :purchase_id, return_purchase_total = :return_purchase_total, cgst = :cgst, sgst = :sgst, igst = :igst WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':reference_no', $row['reference_no'], PDO::PARAM_STR);
            $stmt->bindParam(':date', $row['date'], PDO::PARAM_INT);
            $stmt->bindParam(':supplier_id', $row['supplier_id'], PDO::PARAM_INT);
            $stmt->bindParam(':warehouse_id', $row['warehouse_id'], PDO::PARAM_INT);
            $stmt->bindParam(':note', $row['note'], PDO::PARAM_STR, strlen($row['note']));
            $stmt->bindParam(':total', $row['total'], PDO::PARAM_STR);
            $stmt->bindParam(':product_discount', $row['product_discount'], PDO::PARAM_STR);
            $stmt->bindParam(':order_discount_id', $row['order_discount_id'], PDO::PARAM_STR);
            $stmt->bindParam(':order_discount', $row['order_discount'], PDO::PARAM_STR);
            $stmt->bindParam(':total_discount', $row['total_discount'], PDO::PARAM_STR);
            $stmt->bindParam(':product_tax', $row['product_tax'], PDO::PARAM_STR);
            $stmt->bindParam(':order_tax_id', $row['order_tax_id'], PDO::PARAM_INT);
            $stmt->bindParam(':order_tax', $row['order_tax'], PDO::PARAM_STR);
            $stmt->bindParam(':total_tax', $row['total_tax'], PDO::PARAM_STR);
            $stmt->bindParam(':shipping', $row['shipping'], PDO::PARAM_STR);
            $stmt->bindParam(':grand_total', $row['grand_total'], PDO::PARAM_STR);
            $stmt->bindParam(':paid', $row['paid'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $row['status'], PDO::PARAM_STR);
            $stmt->bindParam(':payment_status', $row['payment_status'], PDO::PARAM_STR);
            $stmt->bindParam(':created_by', $row['created_by'], PDO::PARAM_INT);
            $stmt->bindParam(':updated_by', $row['updated_by'], PDO::PARAM_INT);
            $stmt->bindParam(':updated_at', $row['updated_at'], PDO::PARAM_STR);
            $stmt->bindParam(':attachment', $row['attachment'], PDO::PARAM_STR);
            $stmt->bindParam(':payment_term', $row['payment_term'], PDO::PARAM_INT);
            $stmt->bindParam(':due_date', $row['due_date'], PDO::PARAM_STR);
            $stmt->bindParam(':return_id', $row['return_id'], PDO::PARAM_INT);
            $stmt->bindParam(':surcharge', $row['surcharge'], PDO::PARAM_STR);
            $stmt->bindParam(':return_purchase_ref', $row['return_purchase_ref'], PDO::PARAM_STR);
            $stmt->bindParam(':purchase_id', $row['purchase_id'], PDO::PARAM_INT);
            $stmt->bindParam(':return_purchase_total', $row['return_purchase_total'], PDO::PARAM_STR);
            $stmt->bindParam(':cgst', $row['cgst'], PDO::PARAM_STR);
            $stmt->bindParam(':sgst', $row['sgst'], PDO::PARAM_STR);
            $stmt->bindParam(':igst', $row['igst'], PDO::PARAM_STR);

            $exc = $stmt->execute();
            if ($exc) {
                $nv_Cache->delMod($module_name);
                if (empty($row['id'])) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Purchases_test', ' ', $admin_info['userid']);
                } else {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Purchases_test', 'ID: ' . $row['id'], $admin_info['userid']);
                }
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
            }
        } catch(PDOException $e) {
            trigger_error($e->getMessage());
            die($e->getMessage()); //Remove this line after checks finished
        }
    }
} elseif ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_purchases WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
} else {
    $row['id'] = 0;
    $row['reference_no'] = '';
    $row['date'] = 0;
    $row['supplier_id'] = 0;
    $row['warehouse_id'] = 0;
    $row['note'] = '';
    $row['total'] = '';
    $row['product_discount'] = '';
    $row['order_discount_id'] = '';
    $row['order_discount'] = '';
    $row['total_discount'] = '';
    $row['product_tax'] = '';
    $row['order_tax_id'] = 0;
    $row['order_tax'] = '';
    $row['total_tax'] = '0.0000';
    $row['shipping'] = '0.0000';
    $row['grand_total'] = '';
    $row['paid'] = '0.0000';
    $row['status'] = '';
    $row['payment_status'] = 'pending';
    $row['created_by'] = 0;
    $row['updated_by'] = 0;
    $row['updated_at'] = '';
    $row['attachment'] = '';
    $row['payment_term'] = 0;
    $row['due_date'] = '';
    $row['return_id'] = 0;
    $row['surcharge'] = '0.0000';
    $row['return_purchase_ref'] = '';
    $row['purchase_id'] = 0;
    $row['return_purchase_total'] = '0.0000';
    $row['cgst'] = '';
    $row['sgst'] = '';
    $row['igst'] = '';
}
if (!empty($row['attachment']) and is_file(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['attachment'])) {
    $row['attachment'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['attachment'];
}
if (defined('NV_EDITOR'))
    require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';

$row['note'] = nv_htmlspecialchars(nv_editor_br2nl($row['note']));
if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $row['note'] = nv_aleditor('note', '100%', '300px', $row['note']);
} else {
    $row['note'] = '<textarea style="width:100%;height:300px" name="note">' . $row['note'] . '</textarea>';
}

$array_purchase_id_storehouse = array();
$_sql = 'SELECT id,name FROM tms_storehouse_products';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_purchase_id_storehouse[$_row['id']] = $_row;
}

$xtpl = new XTemplate('purchases_test.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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

foreach ($array_purchase_id_storehouse as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['id'],
        'title' => $value['name'],
        'selected' => ($value['id'] == $row['purchase_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_purchase_id');
}

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
