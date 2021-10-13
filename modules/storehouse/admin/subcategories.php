<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 NV Systems,LTD. All rights reserved
 * @License: GNU/GPL version 2 or any later version
 * @Createdate Fri, 12 Oct 2018 02:53:25 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}
require NV_ROOTDIR . '/modules/' . $module_file . '/global.catalogy.php';
if ($nv_Request->isset_request('get_alias_title', 'post')) {
    $alias = $nv_Request->get_title('get_alias_title', 'post', '');
    $alias = change_alias($alias);
    die($alias);
}
if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
	
    $id = $nv_Request->get_int('delete_id', 'get');
	list ($catid, $parentid, $title) = $db->query('SELECT id, parent_id, name FROM ' . $db_config['prefix'] . '_' . $module_data . '_subcategories WHERE id=' . $id)->fetch(3);
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_subcategories  WHERE id = ' . $db->quote($id));
		storehouse_fix_subcat_order();
        $nv_Cache->delMod($module_name);
        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Categories', 'ID: ' . $id, $admin_info['userid']);
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&parentid=' . $parentid);
    }
}

//$page_title = //$title_manager_store;

$table_name =  $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_subcategories';
$error = $admins = '';
$savecat = 0;
$groups_list = nv_groups_list();

if (defined('NV_EDITOR')) {
    require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
}

$currentpath = NV_UPLOADS_DIR . '/' . $module_upload . '/catalogs' ;
if (!file_exists($currentpath)) {
    nv_mkdir(NV_UPLOADS_REAL_DIR . '/' . $module_upload, 'catalogs', true);
}
$data = array();
$data['id'] = 0;
$data['parent_id'] = 0;
$data['title'] = '';
$data['alias'] = '';
$data['image'] = '';
$data['parent_title'] = '';
$data['description'] = '';
$data['code'] = '';

$savecat = $nv_Request->get_int('savecat', 'post', 0);

$cat_form_exit = array();
if (is_dir(NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/' . $module_upload . '/files_tpl')) {
    $_form_exit = scandir(NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/' . $module_upload . '/files_tpl');
    foreach ($_form_exit as $_form) {
        if (preg_match('/^cat\_form\_([a-zA-Z0-9\-\_]+)\.tpl$/', $_form, $m)) {
            $cat_form_exit[] = $m[1];
        }
    }
}

if (!empty($savecat)) {

    $data['id'] = $nv_Request->get_int('id', 'post', 0);
    $data['parentid_old'] = $nv_Request->get_int('parentid_old', 'post', 0);
    $data['parent_id'] = $nv_Request->get_int('parentid', 'post', 0);
    $data['title'] = nv_substr($nv_Request->get_title('title', 'post', '', 1), 0, 255);
    $data['code'] = nv_substr($nv_Request->get_title('code', 'post', '', 1), 0, 255);
    $data['alias'] = nv_substr($nv_Request->get_title('alias', 'post', '', 1), 0, 255);
    $data['description'] = $nv_Request->get_string('description', 'post', '');
    $data['description'] = nv_nl2br(nv_htmlspecialchars(strip_tags($data['description'])), '<br />');

    $data['alias'] = ($data['alias'] == '') ? change_alias($data['title']) : change_alias($data['alias']);
    // Cat mo ta cho chinh xac
    if (strlen($data['description']) > 255) {
        $data['description'] = nv_clean60($data['description'], 250);
    }

    if ($data['title'] == '') {
        $error = $lang_module['error_cat_name'];
    }

    $image = $nv_Request->get_string('image', 'post', '');
    if (is_file(NV_DOCUMENT_ROOT . $image)) {
        $lu = strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/');
        $data['image'] = substr($image, $lu);
    } else {
        $data['image'] = '';
    }




    $stmt = $db->prepare('SELECT count(id) FROM ' . $table_name . ' WHERE id!=' . $data['id'] . ' AND alias= :alias');
    $stmt->bindParam(':alias', $data['alias'], PDO::PARAM_STR);
    $stmt->execute();
    $check_alias_cata = $stmt->fetchColumn();

    if ($check_alias_cata) {
			$error = 'alias bị trùng';
    }
	//print_r($data);die;
    if ($data['id'] == 0 and $data['title'] != '' and $error == '') {
		//die(oke);
        $w = 'SELECT max(weight) FROM ' . $table_name . ' WHERE parent_id=' . $data['parent_id'];
        $rw = $db->query($w);
        $weight = $rw->fetchColumn();
        $weight = intval($weight) + 1;

        $sql = "INSERT INTO " . $table_name . " (id, name, code, alias, parent_id, image, weight, sort, lev, subcatid, add_time, edit_time)
 			VALUES (NULL, :name , :code, :alias, :parentid, :image," . $weight . ", '0', '0',  :subcatid, " . NV_CURRENTTIME . ", " . NV_CURRENTTIME . ")";
        $data_insert = array();
        $data_insert['name'] = $data['title'];
        $data_insert['alias'] = $data['alias'];
        $data_insert['code'] = $data['code'];
        $data_insert['parentid'] = $data['parent_id'];
        $data_insert['image'] = $data['image'];
        $data_insert['subcatid'] = '';


        $newcatid = intval($db->insert_id($sql, 'id', $data_insert));
        if ($newcatid > 0) {

			
            nv_insert_logs(NV_LANG_DATA, $module_name, 'log_add_catalog', 'id ' . $newcatid, $admin_info['userid']);
            storehouse_fix_subcat_order();
            $nv_Cache->delMod($module_name);
            nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&parentid=' . $data['parent_id']);
        } else {
            $error = $lang_module['errorsave'];
        }
    } elseif ($data['id'] > 0 and $data['title'] != '' and $error == '') {
            if ($error == '') {
                $stmt = $db->prepare("UPDATE " . $table_name . " SET parent_id = :parentid, image = :image,  name= :title, code=:code, alias = :alias,  edit_time=" . NV_CURRENTTIME . " WHERE id =" . $data['id']);
                $stmt->bindParam(':parentid', $data['parent_id'], PDO::PARAM_INT);
                $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
                $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
                $stmt->bindParam(':alias', $data['alias'], PDO::PARAM_STR);
                $stmt->bindParam(':code', $data['code'], PDO::PARAM_STR);

                if ($stmt->execute()) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'log_edit_catalog', 'id ' . $data['catid'], $admin_info['userid']);
					
				
                    if ($data['parent_id'] != $data['parentid_old']) {
                        $w = 'SELECT max(weight) FROM ' . $table_name . ' WHERE parent_id=' . $data['parent_id'];
                        $rw = $db->query($w);
                        $weight = $rw->fetchColumn();
                        $weight = intval($weight) + 1;
                        $sql = 'UPDATE ' . $table_name . ' SET weight=' . $weight . ' WHERE id=' . intval($data['id']);
                        $db->query($sql);
                        storehouse_fix_subcat_order();
                    }

                    

                    $nv_Cache->delMod($module_name);

                    nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&parentid=' . $data['parent_id']);
                }

            }
    }
} else {
    $data['parent_id'] = $nv_Request->get_int('parentid', 'get,post', 0);
    //$data['parent_old'] = $nv_Request->get_int('parentid', 'get,post', 0);

    $data['id'] = $nv_Request->get_int('id', 'get', 0);
    if ($data['id'] > 0) {
        $data = $db->query('SELECT * FROM ' . $table_name . ' where id=' . $data['id'])->fetch();
        if (empty($data)) {
            nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        }
        $data['title'] = $data['name'];
    }
    if ($data['parent_id']) {
        list ($parent_title) = $db->query('SELECT name FROM ' . $table_name . ' where id=' . $data['parent_id'])->fetch(3);
        $data['parent_title'] = $parent_title;
    }
}

$sql = 'SELECT id, code, name, lev, description FROM ' . $table_name . ' WHERE id !=' . $data['id'] . ' ORDER BY sort ASC';
$result = $db->query($sql);
$array_cat_list = array();
$array_cat_list[0] = array(
    '0',
    $lang_module['cat_sub_sl']
);

while (list ($catid_i, $code_i, $title_i, $lev_i) = $result->fetch(3)) {
    $xtitle_i = '';
    if ($lev_i > 0) {
        $xtitle_i .= '&nbsp;';
        for ($i = 1; $i <= $lev_i; $i++) {
            $xtitle_i .= '---';
        }
    }
    $xtitle_i .= $title_i;
    $array_cat_list[] = array(
        $catid_i,
        $xtitle_i
    );
}

$lang_global['title_suggest_max'] = sprintf($lang_global['length_suggest_max'], 65);
$lang_global['description_suggest_max'] = sprintf($lang_global['length_suggest_max'], 160);

if (!empty($data['image']) and file_exists(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $data['image'])) {
    $data['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $data['image'];
    $currentpath = dirname($data['image']);
}



$xtpl = new XTemplate('subcategories.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('CAPTION', ($data['id'] > 0) ? $lang_module['edit_cat'] : $lang_module['add_cat']);
$xtpl->assign('DATA', $data);
$xtpl->assign('UPLOAD_CURRENT', $currentpath);
$xtpl->assign('FORM_ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $data['id'] . '&amp;parentid=' . $data['parent_id']);

if ($error != '') {
    $xtpl->assign('CAT_LIST', storehouse_show_secondcat_list($data['parentid_old']));
    $xtpl->assign('error', $error);
    $xtpl->parse('main.error');
} else {
    $xtpl->assign('CAT_LIST', storehouse_show_secondcat_list($data['parent_id']));
}

if (empty($data['alias'])) {
    $xtpl->parse('main.getalias');
}

foreach ($array_cat_list as $rows_i) {
    $sl = ($rows_i[0] == $data['parent_id']) ? " selected=\"selected\"" : "";
    $xtpl->assign('pcatid_i', $rows_i[0]);
    $xtpl->assign('ptitle_i', $rows_i[1]);
    $xtpl->assign('pselect', $sl);
    $xtpl->parse('main.parent_loop');
}




if (!empty($cat_form_exit)) {
    foreach ($cat_form_exit as $_form) {
        $xtpl->assign('CAT_FORM', array(
            'value' => $_form,
            'selected' => ($data['form'] == $_form) ? ' selected="selected"' : '',
            'title' => $_form
        ));
        $xtpl->parse('main.cat_form.loop');
    }
    $xtpl->parse('main.cat_form');
}

$description = nv_htmlspecialchars(nv_editor_br2nl($data['description']));
if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $description = nv_aleditor('description', '100%', '200px', $description, 'Basic');
} else {
    $description = "<textarea style=\"width: 100%\" name=\"description\" id=\"descriptionhtml\" cols=\"20\" rows=\"15\">" . $description . "</textarea>";
}
$xtpl->assign('DESCRIPTION', $description);


$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';

