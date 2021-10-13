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
$sid = $nv_Request->get_int('sid', 'post,get', 0);

if ($row['id'] > 0) {
    $lang_module['scenario_add'] = $lang_module['scenario_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_smsconfig WHERE id=' . $row['id'] )->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
        die();
    }
} else {
    $row['id'] = 0;
    $row['content'] = '';
    $row['hoursend'] = 0;
    $row['sendtype'] = 1;
    $row['daysend'] = 0;
}

$row['redirect'] = $nv_Request->get_title('redirect', 'get', '');

if ($nv_Request->isset_request('submit', 'post') or $nv_Request->isset_request('draft', 'post') ) {
    $row['content'] = $nv_Request->get_textarea('content', '', 'br', 1);
    $row['sendtype'] = $nv_Request->get_int('sendtype', 'post', 0);
    $row['daysend'] = $nv_Request->get_int('daysend', 'post', 0);
    $row['hoursend'] = $nv_Request->get_int('hoursend', 'post', 0);
    if ($nv_Request->isset_request('draft', 'post')) {
        if (empty($row['content'])) {
            $error[] = $lang_module['error_required_content'];
        }
        $row['status'] = 0;
    } else {
        $row['status'] = 1;
    }

    if (empty($error)) {
        try {
            $new_id = $insert= 0;

            if (empty($row['id'])) {
                $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_smsconfig ( content, daysend, hoursend, addtime, sendtype, status) VALUES (:content, :daysend, :hoursend, ' . NV_CURRENTTIME . ', :sendtype, :status)';
                $data_insert = array();
                $data_insert['content'] = $row['content'];
                $data_insert['daysend'] = $row['daysend'];
                $data_insert['hoursend'] = $row['hoursend'];
                $data_insert['sendtype'] = $row['sendtype'];
                $data_insert['status'] = $row['status'];
                $new_id = $db->insert_id($_sql, 'id', $data_insert);
                $insert = 1;
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_smsconfig SET content = :content, daysend = :daysend, hoursend = :hoursend, sendtype = :sendtype, status = :status WHERE id=' . $row['id']);
                $stmt->bindParam(':content', $row['content'], PDO::PARAM_STR, strlen($row['content']));
                $stmt->bindParam(':daysend', $row['daysend'], PDO::PARAM_INT);
                $stmt->bindParam(':hoursend', $row['hoursend'], PDO::PARAM_INT);
                $stmt->bindParam(':sendtype', $row['sendtype'], PDO::PARAM_INT);
                $stmt->bindParam(':status', $row['status'], PDO::PARAM_INT);
                if ($stmt->execute()) {
                    $new_id = $row['id'];
                }
            }

            if ($new_id > 0) {
               // nvUpdatemsQueueByDetail( $new_id, $row['status'], $insert, $row['sid'] );

                $nv_Cache->delMod($module_name);
                Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=list-sms');
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
            $error[] = $e->getMessage();

        }
    }
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('sid', $sid);
$array_typesend = array(
    1 => $lang_module['sendtype_1'],
    2 => $lang_module['sendtype_2']
);

foreach ($array_typesend as $index => $value) {
    $ck = $index == $row['sendtype'] ? 'checked="checked"' : '';
    $xtpl->assign('TYPESEND', array(
        'index' => $index,
        'value' => $value,
        'checked' => $ck
    ));
    $xtpl->parse('main.sendtype');
}

for ($i = 0; $i <= 23; $i++) {
    $sl = $i == $row['hoursend'] ? 'selected="selected"' : '';
    $xtpl->assign('HOUR', array(
        'index' => $i,
        'selected' => $sl
    ));
    $xtpl->parse('main.hour');
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

$page_title = $lang_module['scenario_add'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';