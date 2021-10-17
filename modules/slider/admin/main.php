<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 - 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 08 Apr 2012 00:00:00 GMT GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

// Change status
if ($nv_Request->isset_request('changestatus', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);

    if (empty($id))
        die("NO");

    $sql = "SELECT title, status FROM " . NV_PREFIXLANG . "_" . $module_data . "_rows WHERE id=" . $id;
    $result = $db->query($sql);
    list($title, $status) = $result->fetch(3);

    if (empty($title))
        die('NO');
    $status = $status == 1 ? 0 : 1;

    $sql = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_rows SET status = " . $status . " WHERE id = " . $id;
    $db->query($sql);

    $nv_Cache->delMod($module_name);

    die("OK");
}

// Delete row
if ($nv_Request->isset_request('delete', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);

    $sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $id;
    $id = $db->query($sql)->fetchColumn();

    if (empty($id))
        die('NO_' . $id);

    $sql = 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id = ' . $id;
    $db->query($sql);
    
    $sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows ORDER BY weight ASC';
    $result = $db->query($sql);

    $weight = 0;
    while ($row = $result->fetch()) {
        ++$weight;
        $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_rows SET weight=' . $weight . ' WHERE id=' . $row['id'];
        $db->query($sql);
    }

    $nv_Cache->delMod($module_name);

    include NV_ROOTDIR . '/includes/header.php';
    echo 'OK_' . $id;
    include NV_ROOTDIR . '/includes/footer.php';
}

// Change row weight
if ($nv_Request->isset_request('changeweight', 'post')) {
    $id = $nv_Request->get_int('id', 'post', 0);

    $sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $id;
    $id = $db->query($sql)->fetchColumn();
    if (empty($id))
        die('NO_' . $id);

    $new_weight = $nv_Request->get_int('new_weight', 'post', 0);
    if (empty($new_weight))
        die('NO_' . $module_name);

    $sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id!=' . $id . ' ORDER BY weight ASC';
    $result = $db->query($sql);

    $weight = 0;
    while ($row = $result->fetch()) {
        ++$weight;
        if ($weight == $new_weight)
            ++$weight;

        $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_rows SET weight=' . $weight . ' WHERE id=' . $row['id'];
        $db->query($sql);
    }

    $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_rows SET weight=' . $new_weight . ' WHERE id=' . $id;
    $db->query($sql);

    $nv_Cache->delMod($module_name);

    include NV_ROOTDIR . '/includes/header.php';
    echo 'OK_' . $id;
    include NV_ROOTDIR . '/includes/footer.php';
}

$page_title = $lang_module['list'];

$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows ORDER BY weight ASC';
$array = $db->query($sql)->fetchAll();
$num = sizeof($array);

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);

foreach ($array as $row) {
    for ($i = 1; $i <= $num; ++$i) {
        $xtpl->assign('WEIGHT', array('w' => $i, 'selected' => ($i == $row['weight']) ? ' selected="selected"' : ''));

        $xtpl->parse('main.loop.weight');
    }

    $row['url_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $row['id'];
    $row['status_render'] = $row['status'] ? ' checked="checked"' : '';

    $row['image_thumb'] = NV_BASE_SITEURL . 'themes/default/images/users/no_avatar.jpg';

    if (!empty($row['image'])) {
        if (file_exists(NV_ROOTDIR . '/' . NV_FILES_DIR . '/' . $module_upload . '/' . $row['image'])) {
            $row['image_thumb'] = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $row['image'];
        } else {
            $row['image_thumb'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['image'];
        }

        $row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['image'];
    } else {
        $row['image'] = $row['image_thumb'];
    }

    $row['link_icon'] = empty($row['link_href']) ? 'chain-broken' : ($row['link_target'] == 1 ? 'external-link' : 'link');
    $row['link_href'] = empty($row['link_href']) ? $lang_module['content_link_href_no'] : '<a href="' . $row['link_href'] . '"' . ($row['link_target'] == 1 ? ' target="_blank"' : '') . '>' . $row['link_href'] . '</a>';

    $xtpl->assign('ROW', $row);
    $xtpl->parse('main.loop');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
