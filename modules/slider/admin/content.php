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

$currentpath = $module_upload . '/' . date('Y');

// Xử lý thư mục upload
if (file_exists(NV_UPLOADS_REAL_DIR . '/' . $currentpath)) {
    $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $currentpath;
} else {
    $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $module_upload;
    $e = explode('/', $currentpath);
    if (!empty($e)) {
        $cp = '';
        foreach ($e as $p) {
            if (!empty($p) and !is_dir(NV_UPLOADS_REAL_DIR . '/' . $cp . $p)) {
                $mk = nv_mkdir(NV_UPLOADS_REAL_DIR . '/' . $cp, $p);
                if ($mk[0] > 0) {
                    $upload_real_dir_page = $mk[2];
                    $db->query("INSERT INTO " . NV_UPLOAD_GLOBALTABLE . "_dir (dirname, time) VALUES ('" . NV_UPLOADS_DIR . "/" . $cp . $p . "', 0)");
                }
            } elseif (!empty($p)) {
                $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $cp . $p;
            }
            $cp .= $p . '/';
        }
    }
    $upload_real_dir_page = str_replace('\\', '/', $upload_real_dir_page);
}

$currentpath = str_replace(NV_ROOTDIR . '/', '', $upload_real_dir_page);

$id = $nv_Request->get_int('id', 'post,get', 0);
$error = '';

if (!empty($id)) {
    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id = ' . $id;
    $result = $db->query($sql);
    $array = $result->fetch();

    if (empty($array)) {
        nv_info_die($lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content']);
    }

    $page_title = $lang_module['edit'];
} else {
    $array = array(
        'id' => 0,
        'title' => '',
        'title1' => '',
        'title2' => '',
        'more' => '',
        'link_href' => '',
        'link_target' => 0,
        'image' => '',
        'status' => 1);

    $page_title = $lang_module['add'];
}

$accept = $nv_Request->get_int('accept', 'post', 0);

if ($nv_Request->isset_request('submit', 'post')) {
    $array['title'] = $nv_Request->get_title('title', 'post', '', true);
    $array['title1'] = $nv_Request->get_title('title1', 'post', '', true);
    $array['title2'] = $nv_Request->get_title('title2', 'post', '', true);
    $array['more'] = $nv_Request->get_title('more', 'post', '', true);
    $array['link_href'] = $nv_Request->get_title('link_href', 'post', '', true);
    $array['link_target'] = $nv_Request->get_int('link_target', 'post', 0);
    $array['image'] = $nv_Request->get_string('image', 'post', '', true);
    $array['status'] = $nv_Request->get_int('status', 'post', 0);

    if (!empty($array['image'])) {
        $array['image'] = substr($array['image'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'));
    }

    $array['link_target'] = $array['link_target'] ? 1 : 0;
    $array['status'] = $array['status'] ? 1 : 0;

    if (empty($array['image'])) {
        $error = $lang_module['content_error_image'];
    } else {
        if (!$array['id']) {
            $sql = 'SELECT MAX(weight) weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows';
            $result = $db->query($sql);
            $weight = $result->fetch();
            $weight = $weight['weight'] + 1;

            $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_rows (title, title1, title2, more, link_href, link_target, image, addtime, edittime, weight, status) VALUES (
				:title, :title1, :title2, :more, :link_href, :link_target, :image, ' . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', ' . $weight . ', :status
			)';
        } else {
            $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_rows SET 
				title = :title, title1 = :title1, title2 = :title2, more = :more, link_href = :link_href, link_target = :link_target, image = :image, edittime = ' . NV_CURRENTTIME . ', status = :status 
				WHERE id = ' . $array['id'];
        }

        try {
            $sth = $db->prepare($sql);
            $sth->bindParam(':title', $array['title'], PDO::PARAM_STR);
            $sth->bindParam(':title1', $array['title1'], PDO::PARAM_STR);
            $sth->bindParam(':title2', $array['title2'], PDO::PARAM_STR);
            $sth->bindParam(':more', $array['more'], PDO::PARAM_STR);
            $sth->bindParam(':link_href', $array['link_href'], PDO::PARAM_STR);
            $sth->bindParam(':link_target', $array['link_target'], PDO::PARAM_INT);
            $sth->bindParam(':image', $array['image'], PDO::PARAM_STR);
            $sth->bindParam(':status', $array['status'], PDO::PARAM_INT);
            $sth->execute();

            if ($sth->rowCount()) {
                if ($array['id']) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit', 'ID: ' . $array['id'], $admin_info['userid']);
                } else {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add', ' ', $admin_info['userid']);
                }

                $nv_Cache->delMod($module_name);
                Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
                die();
            } else {
                $error = $lang_module['errorsave'];
            }
        }
        catch (PDOException $e) {
            $error = $lang_module['errorsave'];
        }
    }
}

$array['status'] = $array['status'] ? ' checked="checked"' : '';

if (!empty($array['image'])) {
    $array['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $array['image'];
}

if (!empty($array['image']))
    $array['image'] = nv_htmlspecialchars($array['image']);

$xtpl = new XTemplate('content.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
$xtpl->assign('FORM_ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op);
$xtpl->assign('DATA', $array);
$xtpl->assign('UPLOADS_DIR', NV_UPLOADS_DIR . '/' . $module_upload);
$xtpl->assign('UPLOADS_DIR_CURRENT', $currentpath);

for ($i = 0; $i <= 1; $i++) {
    $link_target = array(
        'key' => $i,
        'title' => $lang_module['content_link_target_' . $i],
        'selected' => $i == $array['link_target'] ? ' selected="selected"' : '');

    $xtpl->assign('LINK_TARGET', $link_target);
    $xtpl->parse('main.link_target');
}

if (!empty($error)) {
    $xtpl->assign('ERROR', $error);
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
