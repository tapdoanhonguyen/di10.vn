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

if ($row['id'] > 0) {
    $lang_module['email_add'] = $lang_module['email_edit'];
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_emailmarketting WHERE id=' . $row['id'] )->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
        die();
    }
} else {
    $row['id'] = 0;
    $row['content'] = '';
}

if ($nv_Request->isset_request('submit', 'post') or $nv_Request->isset_request('draft', 'post') ) {
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['content'] = $nv_Request->get_editor('content', '', NV_ALLOWED_HTML_TAGS);
    if ($nv_Request->isset_request('draft', 'post')) {
        if( $row['sendtype'] != 1 && empty($row['title']) ){
            $error[] = $lang_module['error_required_title'];
        }
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
                $_sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_emailmarketting ( title, content, addtime, status) VALUES (:title, :content, ' . NV_CURRENTTIME . ', :status)';
                $data_insert = array();
                $data_insert['title'] = $row['title'];
                $data_insert['content'] = $row['content'];
                $data_insert['status'] = $row['status'];
                $new_id = $db->insert_id($_sql, 'id', $data_insert);
                $insert = 1;
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_emailmarketting SET title=:title, content = :content, status = :status WHERE id=' . $row['id']);
                $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR, strlen($row['title']));
                $stmt->bindParam(':content', $row['content'], PDO::PARAM_STR, strlen($row['content']));
                $stmt->bindParam(':status', $row['status'], PDO::PARAM_INT);
                if ($stmt->execute()) {
                    $new_id = $row['id'];
                }
            }

            if ($new_id > 0) {
                $nv_Cache->delMod($module_name);
                Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=list-email');
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
            $error[] = $e->getMessage();

        }
    }
}

if (defined('NV_EDITOR')) require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
$row['content'] = htmlspecialchars(nv_editor_br2nl($row['content']));
if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $row['content'] = nv_aleditor('content', '100%', '300px', $row['content']);
} else {
    $row['content'] = '<textarea style="width:100%;height:300px" name="content">' . $row['description'] . '</textarea>';
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

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

$page_title = $lang_module['email_add'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';