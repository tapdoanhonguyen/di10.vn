<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */
if (!defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
$draft = $nv_Request->isset_request('draft', 'post');

if ($row['id'] > 0) {
    $lang_module['campaign_add'] = $lang_module['campaign_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_smsrows WHERE id=' . $row['id'] . ' AND sendstatus != 1')->fetch();
    if (empty($row) or $row['sendstatus'] == 1) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
        die();
    }
    $row['linkmd5'] = $row['linkmd5_old'] = array();
    $result = $db->query('SELECT linkmd5 FROM ' . NV_PREFIXLANG . '_' . $module_data . '_smsrows_link WHERE rowsid=' . $row['id']);
    while (list ($linkmd5) = $result->fetch(3)) {
        $row['linkmd5'][] = $linkmd5;
    }
    $row['linkmd5_old'] = $row['linkmd5'];
} else {
    $row['id'] = 0;
    $row['content'] = '';
    $row['usergroup'] = array();
    $row['customergroup'] = array();
    $row['phonelist'] = '';
    $row['typetime'] = 0;
    $row['begintime'] = 0;
    $row['endtime'] = 0;
    $row['linkstatics'] = 1;
    $row['openstatics'] = 1;
    $row['linkmd5'] = $row['linkmd5_old'] = array();
}

$row['redirect'] = $nv_Request->get_title('redirect', 'get', '');

if ($nv_Request->isset_request('submit', 'post') or $draft) {
    $row['content'] = $nv_Request->get_textarea('content', '', 'br', 1);
    $row['phonelist'] = $nv_Request->get_textarea('phonelist', '', 0, 1);
    $row['typetime'] = $nv_Request->get_int('typetime', 'post', 0);
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('begintime', 'post'), $m)) {
        $_hour = $nv_Request->get_int('begintime_hour', 'post');
        $_min = $nv_Request->get_int('begintime_min', 'post');
        $row['begintime'] = mktime($_hour, $_min, 59, $m[2], $m[1], $m[3]);
    } else {
        $row['begintime'] = NV_CURRENTTIME;
    }
    if( $row['typetime'] == 0 ){
        $row['begintime'] = NV_CURRENTTIME;
    }
    $row['endtime'] = $nv_Request->get_int('endtime', 'post', 0);
    if (empty($row['content'])) {
        $error[] = $lang_module['error_required_contentsms'];
    }
    $is_vaild = 0;
    if (!empty($row['phonelist'])) {
        $is_vaild = 1;
        $row['phonelist'] = explode('<br />', $row['phonelist']);
        foreach ($row['phonelist'] as $index => $phone) {
            if (!empty($phone)) {
                if (!check_phone_avaible($phone)) {
                    $error[] = 'SĐT <strong>[' . $phone . ']</strong> không đúng';
                }
            } else {
                unset($row['phonelist'][$index]);
            }
        }
    }

    if (!$is_vaild) {
        $error[] = $lang_module['error_required_phone'];
    }

    if (empty($error)) {
        try {
            $content = nv_unhtmlspecialchars($row['content']);

            foreach ( $row['phonelist'] as $mobile ){
                $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE mobile=' . $db->quote($mobile );
                $customer_info = $db->query( $sql )->fetch();
                if( !empty( $customer_info )){
                    // Thay the bien noi dung
                    $array_replace = array(
                        '[FULLNAME]' => !empty($customer_info['full_name']) ? $customer_info['full_name'] : $lang_module['customers'],
                        '[MOBILE]' => $customer_info['phone'],
                        '[EMAIL]' => $customer_info['email'],
                        '[ADDRESS]' => $customer_info['address'],
                        '[ALIAS]' => $lang_module['alias_' . $customer_info['sex']],
                        '[SITE_NAME]' => $global_config['site_name'],
                        '[SITE_DOMAIN]' => NV_MY_DOMAIN
                    );

                }else{
                    // Thay the bien noi dung
                    $array_replace = array(
                        '[FULLNAME]' => $lang_module['customers'],
                        '[MOBILE]' => $mobile,
                        '[EMAIL]' => '',
                        '[ADDRESS]' => '',
                        '[ALIAS]' => '',
                        '[SITE_NAME]' => $global_config['site_name'],
                        '[SITE_DOMAIN]' => NV_MY_DOMAIN
                    );
                }
                foreach ($array_replace as $index => $value) {
                    $content = str_replace($index, $value, $content);
                }
                $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_sms_queue( order_id, proid, smsconfigid, mobile, content, timesend, active ) 
                VALUES ( 0, 0, 0, ' . $db->quote( $mobile ) . ', ' . $db->quote( $content ) . ', ' . $row['begintime'] . ', 1)';
                $db->query($sql);
            }
            $nv_Cache->delMod($module_name);
            Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name  . '&' . NV_OP_VARIABLE . '=sms-queue');
            die();

        } catch (PDOException $e) {
            trigger_error($e->getMessage());
            die($e->getMessage()); // Remove this line after checks finished
        }
    }
}

if (empty($row['begintime'])) {
    $row['begintimef'] = '';
} else {
    $row['begintimef'] = date('d/m/Y', $row['begintime']);
}

if (!empty($row['phonelist'])) {
    $row['phonelist'] = nv_br2nl($row['phonelist']);
}

$row['style_begintime'] = $row['typetime'] == 0 ? 'style="display: none"' : '';

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

$array_typetime = array(
    0 => $lang_module['typetime_0']
);

$array_typetime += array(
        1 => $lang_module['typetime_1']
    );


foreach ($array_typetime as $index => $value) {
    $ck = $index == $row['typetime'] ? 'checked="checked"' : '';
    $xtpl->assign('TYPETIME', array(
        'index' => $index,
        'value' => $value,
        'checked' => $ck
    ));
    $xtpl->parse('main.typetime');
}

$hour = !empty($row['begintime']) ? date('H', $row['begintime']) : 0;
for ($i = 0; $i <= 23; $i++) {
    $sl = $i == $hour ? 'selected="selected"' : '';
    $xtpl->assign('HOUR', array(
        'index' => $i,
        'selected' => $sl
    ));
    $xtpl->parse('main.hour');
}

$min = !empty($row['begintime']) ? date('i', $row['begintime']) : 0;
for ($i = 0; $i <= 59; $i++) {
    $sl = $i == $min ? 'selected="selected"' : '';
    $xtpl->assign('MIN', array(
        'index' => $i,
        'selected' => $sl
    ));
    $xtpl->parse('main.min');
}

if (!empty($array_personal_sms)) {
    foreach ($array_personal_sms as $index => $value) {
        $xtpl->assign('PERSONAL', array(
            'index' => $index,
            'value' => $value
        ));
        $xtpl->parse('main.personal');
    }
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['contentsms'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';