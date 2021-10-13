<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 29 Aug 2018 21:51:54 GMT
 */


if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}
if ($nv_Request->isset_request('get_alias_title', 'post')) {
    $alias = $nv_Request->get_title('get_alias_title', 'post', '');
    $alias = change_alias($alias);
    die($alias);
}
if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_categories  WHERE id = ' . $db->quote($id));
		storehouse_fix_cat_order();
        $nv_Cache->delMod($module_name);
        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Categories', 'ID: ' . $id, $admin_info['userid']);
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
}

//$page_title = $title_manager_store;

$table_name =  $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_categories';
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
$data['secondcatid_main'] = '0';

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
	$data['secondcatid'] = $nv_Request->get_array('secondcatid', 'post', array());
	$data['secondcatid_main_temp'] = $nv_Request->get_array('secondcatid', 'post', array());
	$data['secondcatid_main'] = implode(',', $data['secondcatid_main_temp']);
	$data['secondcat_id'] = $nv_Request->get_array('secondcat_id', 'post', array());
	foreach ($data['secondcat_id'] as $secondcat_id){
		$data['secondcatid'][] = $secondcat_id;
	}
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




    $stmt = $db->prepare('SELECT count(*) FROM ' . $table_name . ' WHERE id!=' . $data['id'] . ' AND alias= :alias');
    $stmt->bindParam(':alias', $data['alias'], PDO::PARAM_STR);
    $stmt->execute();
    $check_alias_cata = $stmt->fetchColumn();

    if ($check_alias_cata and $data['parentid'] > 0) {
        $parentid_alias = $db->query('SELECT alias FROM ' . $table_name . ' WHERE id=' . $data['parent_id'])->fetchColumn();
        $data['alias'] = $parentid_alias . '-' . $data['alias'];
    }
	//print_r($data);die;
    if ($data['id'] == 0 and $data['title'] != '' and $error == '') {
		//die(oke);
        $w = 'SELECT max(weight) FROM ' . $table_name . ' WHERE parent_id=' . $data['parent_id'];
        $rw = $db->query($w);
        $weight = $rw->fetchColumn();
        $weight = intval($weight) + 1;

        $sql = "INSERT INTO " . $table_name . " (id, name, code, alias, parent_id, image, weight, sort, lev, subcatid, secondcatid, secondcatid_main, add_time, edit_time)
 			VALUES (NULL, :name , :code, :alias, :parent_id, :image," . $weight . ", '0', '0',  :subcatid, :secondcatid, :secondcatid_main, " . NV_CURRENTTIME . ", " . NV_CURRENTTIME . ")";
        $data_insert = array();
        $data_insert['name'] = $data['title'];
        $data_insert['alias'] = $data['alias'];
        $data_insert['code'] = $data['code'];
        $data_insert['parent_id'] = $data['parent_id'];
        $data_insert['image'] = $data['image'];
        $data_insert['subcatid'] = '';
        $data_insert['secondcatid'] = implode(",",$data['secondcatid']);
        $data_insert['secondcatid_main'] = implode(",",$data['secondcatid_main_temp']);
		//print_r($data_insert);die;

        $newcatid = intval($db->insert_id($sql, 'id', $data_insert));
        if ($newcatid > 0) {

			$db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_cat_of_secondcategory WHERE secondcat_id NOT IN (' . implode(",",$data['secondcatid']) . ') and category_id = ' .  $newcatid );
			foreach($data['secondcatid'] as $cate){
				$second_of_cat = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_cat_of_secondcategory WHERE secondcat_id = ' . $cate . ' AND category_id=' . $newcatid)->fetch();
				if (empty($second_of_cat)) {
					
					$db->query('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_cat_of_secondcategory(secondcat_id, category_id) VALUES (' . $cate . ',' . $newcatid . ')');
				}
			}
            nv_insert_logs(NV_LANG_DATA, $module_name, 'log_add_catalog', 'id ' . $newcatid, $admin_info['userid']);
            storehouse_fix_cat_order();
            $nv_Cache->delMod($module_name);
            nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&parentid=' . $data['parentid']);
        } else {
            $error = $lang_module['errorsave'];
        }
    } elseif ($data['id'] > 0 and $data['title'] != '' and $error == '') {
    	
        try {

            if ($data['parent_id'] != $data['parentid_old']) {
                //Khi loại sản phẩm đó đã có sản phẩm chọn thì mọi cấu hình của loại sản phẩm đó cần được giữ nguyên.
                $count_cat_items = $db->query('SELECT COUNT(*) FROM ' . $db_config['prefix'] . '_' . $module_data . '_rows WHERE listcatid =' . $data['id'])->fetchcolumn();
                if ($count_cat_items > 0) {
                    //cập nhật nhóm khi chuyển cat con thành cat cha hoặc từ con của cha này chuyển thành con của cha khác
                    //Nếu hiện tại nó là cha thì copy chính nó, nếu là con thì copy thằng cha cũ
                    $parentid = ($data['parentid_old'] != 0) ? $data['parentid_old'] : $data['id'];
                    //Kiểm tra nếu từ con sang cha thì cần insert cho chính nó, nếu từ cha thành con thì insertcho cha hiện tại
                    $catid_insert = ($data['parentid_old'] != 0) ? $data['id'] : $data['parent_id'];
                   
                }
            }
			
            if ($error == '') {
                $stmt = $db->prepare("UPDATE " . $table_name . " SET parent_id = :parentid, image = :image,  name= :title, code=:code, alias = :alias,  edit_time=" . NV_CURRENTTIME . ", secondcatid = :secondcatid, secondcatid_main = :secondcatid_main WHERE id =" . $data['id']);
                $stmt->bindParam(':parentid', $data['parent_id'], PDO::PARAM_INT);
                $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
                $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
                $stmt->bindParam(':alias', $data['alias'], PDO::PARAM_STR);
                $stmt->bindParam(':code', $data['code'], PDO::PARAM_STR);
                $stmt->bindParam(':secondcatid', implode(",",$data['secondcatid']), PDO::PARAM_STR);
                $stmt->bindParam(':secondcatid_main', implode(",",$data['secondcatid_main_temp']), PDO::PARAM_STR);

                if ($stmt->execute()) {
                	
                	$db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_cat_of_secondcategory WHERE secondcat_id NOT IN (' . implode(",",$data['secondcatid']) . ') and category_id = ' .  $data['id'] );
					foreach($data['secondcatid'] as $cate){
						//print_r($cate);
						$second_of_cat = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_cat_of_secondcategory WHERE secondcat_id = ' . $cate . ' AND category_id=' . $data['id'])->fetch();
						if (empty($second_of_cat)) {
							//print_r('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_cat_of_secondcategory(secondcat_id, category_id) VALUES (' . $cate . ',' . $data['id'] . ')');
							$db->query('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_cat_of_secondcategory(secondcat_id, category_id) VALUES (' . $cate . ',' . $data['id'] . ')');
						}
					}
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'log_edit_catalog', 'id ' . $data['catid'], $admin_info['userid']);
					
				
                    if ($data['parent_id'] != $data['parentid_old']) {
                        $w = 'SELECT max(weight) FROM ' . $table_name . ' WHERE parent_id=' . $data['parent_id'];
                        $rw = $db->query($w);
                        $weight = $rw->fetchColumn();
                        $weight = intval($weight) + 1;
                        $sql = 'UPDATE ' . $table_name . ' SET weight=' . $weight . ' WHERE id=' . intval($data['id']);
                        $db->query($sql);
                        storehouse_fix_cat_order();
                    }

                    

                    $nv_Cache->delMod($module_name);
                    nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&parentid=' . $data['parent_id']);
                }

            }
        } catch (PDOException $e) {
            $error = $lang_module['errorsave'];
        }
    }
} else {
    $data['parent_id'] = $nv_Request->get_int('parentid', 'get,post', 0);

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
$sql = 'SELECT id, code, name, parent_id, lev, description FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_subcategories' . ' ORDER BY sort ASC';
$result = $db->query($sql);
$array_subcat_list = array();

while (list ($catid_i, $code_i, $title_i, $parent_id, $lev_i) = $result->fetch(3)) {
    $xtitle_i = '';
    if ($lev_i > 0) {
        $xtitle_i .= '&nbsp;';
        for ($i = 1; $i <= $lev_i; $i++) {
            $xtitle_i .= '---';
        }
    }
    $xtitle_i .= $title_i;
    $array_subcat_list[] = array(
        $catid_i,
        $xtitle_i,
        $parent_id
    );
}
$lang_global['title_suggest_max'] = sprintf($lang_global['length_suggest_max'], 65);
$lang_global['description_suggest_max'] = sprintf($lang_global['length_suggest_max'], 160);

if (!empty($data['image']) and file_exists(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $data['image'])) {
    $data['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $data['image'];
    $currentpath = dirname($data['image']);
}



$xtpl = new XTemplate('categories.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('CAPTION', ($data['id'] > 0) ? $lang_module['edit_cat'] : $lang_module['add_cat']);
$xtpl->assign('DATA', $data);
$xtpl->assign('UPLOAD_CURRENT', $currentpath);
$xtpl->assign('FORM_ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $data['id'] . '&amp;parentid=' . $data['parent_id']);

if ($error != '') {
    $xtpl->assign('CAT_LIST', storehouse_show_cat_list($data['parentid_old']));
    $xtpl->assign('error', $error);
    $xtpl->parse('main.error');
} else {
    $xtpl->assign('CAT_LIST', storehouse_show_cat_list($data['parent_id']));
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
$array_secondcatid_main = explode(",",$data['secondcatid_main']);
foreach ($array_subcat_list as $rows_i) {
	if($rows_i[2] == 0){
		$sl = in_array($rows_i[0],$array_secondcatid_main) ? " selected=\"selected\"" : "";
	    $xtpl->assign('pcatid_i', $rows_i[0]);
	    $xtpl->assign('ptitle_i', $rows_i[1]);
	    $xtpl->assign('pselect', $sl);
	    $xtpl->parse('main.secondcat');
	}
    
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

