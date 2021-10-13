<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Aug 2018 04:18:48 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
require NV_ROOTDIR . '/modules/' . $module_file . '/global.catalogy.php';
require NV_ROOTDIR . '/modules/' . $module_file . '/global.datadefault.php';
$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if($global_config['idsite']>0){
	$idsite = $global_config['idsite'];
}else{
	$idsite =0;
}
if ($nv_Request->isset_request('submit', 'post')) {
    $row['group_id'] = $nv_Request->get_int('group_id', 'post', 0);
    $row['group_name'] = $nv_Request->get_title('group_name', 'post', '');
    $row['customer_group_id'] = $nv_Request->get_int('customer_group_id', 'post', 0);
    $row['name'] = $nv_Request->get_title('name', 'post', '');
    $row['company'] = $nv_Request->get_title('company', 'post', '');
    $row['vat_no'] = $nv_Request->get_title('vat_no', 'post', '');
    $row['address'] = $nv_Request->get_title('address', 'post', '');
    $row['city'] = $nv_Request->get_title('city', 'post', '');
    $row['state'] = $nv_Request->get_title('state', 'post', '');
    $row['postal_code'] = $nv_Request->get_title('postal_code', 'post', '');
    $row['country'] = $nv_Request->get_title('country', 'post', '');
    $row['phone'] = $nv_Request->get_title('phone', 'post', '');
    $row['email'] = $nv_Request->get_title('email', 'post', '');
    $row['cf1'] = $nv_Request->get_title('cf1', 'post', '');
    $row['cf2'] = $nv_Request->get_title('cf2', 'post', '');
    $row['cf3'] = $nv_Request->get_title('cf3', 'post', '');
    $row['cf4'] = $nv_Request->get_title('cf4', 'post', '');
    $row['cf5'] = $nv_Request->get_title('cf5', 'post', '');
    $row['cf6'] = $nv_Request->get_title('cf6', 'post', '');
    $row['invoice_footer'] = $nv_Request->get_textarea('invoice_footer', '', NV_ALLOWED_HTML_TAGS);
    $row['payment_term'] = $nv_Request->get_int('payment_term', 'post', 0);
    $row['logo'] = $nv_Request->get_title('logo', 'post', '');
    if (is_file(NV_DOCUMENT_ROOT . $row['logo']))     {
        $row['logo'] = substr($row['logo'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'));
    } else {
        $row['logo'] = '';
    }
    $row['award_points'] = $nv_Request->get_int('award_points', 'post', 0);
    $row['deposit_amount'] = $nv_Request->get_title('deposit_amount', 'post', '');
    $row['price_group_id'] = $nv_Request->get_int('price_group_id', 'post', 0);
    $row['price_group_name'] = $nv_Request->get_title('price_group_name', 'post', '');
    $row['gst_no'] = $nv_Request->get_title('gst_no', 'post', '');

    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                $row['customer_group_name'] = '';
				die('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies (group_id, group_name, customer_group_id, customer_group_name, name, company, vat_no, address, city, state, postal_code, country, phone, email, cf1, cf2, cf3, cf4, cf5, cf6, invoice_footer, payment_term, logo, award_points, deposit_amount, price_group_id, price_group_name, gst_no, idsite) VALUES (:group_id, :group_name, :customer_group_id, :customer_group_name, :name, :company, :vat_no, :address, :city, :state, :postal_code, :country, :phone, :email, :cf1, :cf2, :cf3, :cf4, :cf5, :cf6, :invoice_footer, :payment_term, :logo, :award_points, :deposit_amount, :price_group_id, :price_group_name, :gst_no, ' .$idsite . ')');
                $stmt = $db->prepare('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies (group_id, group_name, customer_group_id, customer_group_name, name, company, vat_no, address, city, state, postal_code, country, phone, email, cf1, cf2, cf3, cf4, cf5, cf6, invoice_footer, payment_term, logo, award_points, deposit_amount, price_group_id, price_group_name, gst_no, idsite) VALUES (:group_id, :group_name, :customer_group_id, :customer_group_name, :name, :company, :vat_no, :address, :city, :state, :postal_code, :country, :phone, :email, :cf1, :cf2, :cf3, :cf4, :cf5, :cf6, :invoice_footer, :payment_term, :logo, :award_points, :deposit_amount, :price_group_id, :price_group_name, :gst_no, ' .$idsite . ')');

                $stmt->bindParam(':customer_group_name', $row['customer_group_name'], PDO::PARAM_STR);

            } else {
                $stmt = $db->prepare('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies SET group_id = :group_id, group_name = :group_name, customer_group_id = :customer_group_id, name = :name, company = :company, vat_no = :vat_no, address = :address, city = :city, state = :state, postal_code = :postal_code, country = :country, phone = :phone, email = :email, cf1 = :cf1, cf2 = :cf2, cf3 = :cf3, cf4 = :cf4, cf5 = :cf5, cf6 = :cf6, invoice_footer = :invoice_footer, payment_term = :payment_term, logo = :logo, award_points = :award_points, deposit_amount = :deposit_amount, price_group_id = :price_group_id, price_group_name = :price_group_name, gst_no = :gst_no WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':group_id', $row['group_id'], PDO::PARAM_INT);
            $stmt->bindParam(':group_name', $row['group_name'], PDO::PARAM_STR);
            $stmt->bindParam(':customer_group_id', $row['customer_group_id'], PDO::PARAM_INT);
            $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
            $stmt->bindParam(':company', $row['company'], PDO::PARAM_STR);
            $stmt->bindParam(':vat_no', $row['vat_no'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $row['address'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $row['city'], PDO::PARAM_STR);
            $stmt->bindParam(':state', $row['state'], PDO::PARAM_STR);
            $stmt->bindParam(':postal_code', $row['postal_code'], PDO::PARAM_STR);
            $stmt->bindParam(':country', $row['country'], PDO::PARAM_STR);
            $stmt->bindParam(':phone', $row['phone'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $row['email'], PDO::PARAM_STR);
            $stmt->bindParam(':cf1', $row['cf1'], PDO::PARAM_STR);
            $stmt->bindParam(':cf2', $row['cf2'], PDO::PARAM_STR);
            $stmt->bindParam(':cf3', $row['cf3'], PDO::PARAM_STR);
            $stmt->bindParam(':cf4', $row['cf4'], PDO::PARAM_STR);
            $stmt->bindParam(':cf5', $row['cf5'], PDO::PARAM_STR);
            $stmt->bindParam(':cf6', $row['cf6'], PDO::PARAM_STR);
            $stmt->bindParam(':invoice_footer', $row['invoice_footer'], PDO::PARAM_STR, strlen($row['invoice_footer']));
            $stmt->bindParam(':payment_term', $row['payment_term'], PDO::PARAM_INT);
            $stmt->bindParam(':logo', $row['logo'], PDO::PARAM_STR);
            $stmt->bindParam(':award_points', $row['award_points'], PDO::PARAM_INT);
            $stmt->bindParam(':deposit_amount', $row['deposit_amount'], PDO::PARAM_STR);
            $stmt->bindParam(':price_group_id', $row['price_group_id'], PDO::PARAM_INT);
            $stmt->bindParam(':price_group_name', $row['price_group_name'], PDO::PARAM_STR);
            $stmt->bindParam(':gst_no', $row['gst_no'], PDO::PARAM_STR);

            $exc = $stmt->execute();
            if ($exc) {
                $nv_Cache->delMod($module_name);
                if (empty($row['id'])) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Companies', ' ', $admin_info['userid']);
                } else {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Companies', 'ID: ' . $row['id'], $admin_info['userid']);
                }
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
            }
        } catch(PDOException $e) {
            trigger_error($e->getMessage());
            die($e->getMessage()); //Remove this line after checks finished
        }
    }
} elseif ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_companies WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
} else {
    $row['id'] = 0;
    $row['group_id'] = 0;
    $row['group_name'] = '';
    $row['customer_group_id'] = 0;
    $row['name'] = '';
    $row['company'] = '';
    $row['vat_no'] = '';
    $row['address'] = '';
    $row['city'] = '';
    $row['state'] = '';
    $row['postal_code'] = '';
    $row['country'] = '';
    $row['phone'] = '';
    $row['email'] = '';
    $row['cf1'] = '';
    $row['cf2'] = '';
    $row['cf3'] = '';
    $row['cf4'] = '';
    $row['cf5'] = '';
    $row['cf6'] = '';
    $row['invoice_footer'] = '';
    $row['payment_term'] = 0;
    $row['logo'] = 'logo.png';
    $row['award_points'] = 0;
    $row['deposit_amount'] = '';
    $row['price_group_id'] = 0;
    $row['price_group_name'] = '';
    $row['gst_no'] = '';
}
if (!empty($row['logo']) and is_file(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['logo'])) {
    $row['logo'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['logo'];
}

$row['invoice_footer'] = nv_htmlspecialchars(nv_br2nl($row['invoice_footer']));

$xtpl = new XTemplate('companies.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
