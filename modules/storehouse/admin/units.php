<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 13 Aug 2018 03:16:17 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_units  WHERE id = ' . $db->quote($id));
        $nv_Cache->delMod($module_name);
        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Units', 'ID: ' . $id, $admin_info['userid']);
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if ($nv_Request->isset_request('submit', 'post')) {
    $row['code'] = $nv_Request->get_title('code', 'post', '');
    $row['name'] = $nv_Request->get_title('name', 'post', '');
    $row['base_unit'] = $nv_Request->get_int('base_unit', 'post', 0);
    $row['operator'] = $nv_Request->get_title('operator', 'post', '');
    $row['operation_value'] = $nv_Request->get_title('operation_value', 'post', '');

    if (empty($row['code'])) {
        $error[] = $lang_module['error_required_code'];
    } elseif (empty($row['name'])) {
        $error[] = $lang_module['error_required_name'];
    }

    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                $row['unit_value'] = '';

                $stmt = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_units (code, name, base_unit, operator, unit_value, operation_value) VALUES (:code, :name, :base_unit, :operator, :unit_value, :operation_value)');

                $stmt->bindParam(':unit_value', $row['unit_value'], PDO::PARAM_STR);

            } else {
                $stmt = $db->prepare('UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_units SET code = :code, name = :name, base_unit = :base_unit, operator = :operator, operation_value = :operation_value WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':code', $row['code'], PDO::PARAM_STR);
            $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
            $stmt->bindParam(':base_unit', $row['base_unit'], PDO::PARAM_INT);
            $stmt->bindParam(':operator', $row['operator'], PDO::PARAM_STR);
            $stmt->bindParam(':operation_value', $row['operation_value'], PDO::PARAM_STR);

            $exc = $stmt->execute();
            if ($exc) {
                $nv_Cache->delMod($module_name);
                if (empty($row['id'])) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Units', ' ', $admin_info['userid']);
                } else {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Units', 'ID: ' . $row['id'], $admin_info['userid']);
                }
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
            }
        } catch(PDOException $e) {
            trigger_error($e->getMessage());
            die($e->getMessage()); //Remove this line after checks finished
        }
    }
} elseif ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_units WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
} else {
    $row['id'] = 0;
    $row['code'] = '';
    $row['name'] = '';
    $row['base_unit'] = 0;
    $row['operator'] = '';
    $row['operation_value'] = '';
}


$array_operator = array();
$array_operator['*'] = '*';
$array_operator['/'] = '/';
$array_operator['+'] = '+';
$array_operator['-'] = '-';

$q = $nv_Request->get_title('q', 'post,get');

// Fetch Limit
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 20;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()
        ->select('COUNT(*)')
        ->from('' . $db_config['prefix'] . '_' . $module_data . '_units');

    if (!empty($q)) {
        $db->where('code LIKE :q_code OR name LIKE :q_name OR base_unit LIKE :q_base_unit OR operator LIKE :q_operator OR operation_value LIKE :q_operation_value');
    }
    $sth = $db->prepare($db->sql());

    if (!empty($q)) {
        $sth->bindValue(':q_code', '%' . $q . '%');
        $sth->bindValue(':q_name', '%' . $q . '%');
        $sth->bindValue(':q_base_unit', '%' . $q . '%');
        $sth->bindValue(':q_operator', '%' . $q . '%');
        $sth->bindValue(':q_operation_value', '%' . $q . '%');
    }
    $sth->execute();
    $num_items = $sth->fetchColumn();

    $db->select('*')
        ->order('id DESC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    $sth = $db->prepare($db->sql());

    if (!empty($q)) {
        $sth->bindValue(':q_code', '%' . $q . '%');
        $sth->bindValue(':q_name', '%' . $q . '%');
        $sth->bindValue(':q_base_unit', '%' . $q . '%');
        $sth->bindValue(':q_operator', '%' . $q . '%');
        $sth->bindValue(':q_operation_value', '%' . $q . '%');
    }
    $sth->execute();
}

$xtpl = new XTemplate('units.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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

foreach ($array_unit_storehouse as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['id'],
        'title' => $value['name'],
        'selected' => ($value['id'] == $row['base_unit']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_base_unit');
}

foreach ($array_operator as $key => $title) {
    $xtpl->assign('OPTION', array(
        'key' => $key,
        'title' => $title,
        'selected' => ($key == $row['operator']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_operator');
}
$xtpl->assign('Q', $q);

if ($show_view) {
    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    if (!empty($q)) {
        $base_url .= '&q=' . $q;
    }
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.view.generate_page');
    }
    $number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
    while ($view = $sth->fetch()) {
        $view['number'] = $number++;
		if( $view['base_unit'] != 0)
			$view['base_unit'] = $array_unit_storehouse[$view['base_unit']]['name'];
		else
			$view['base_unit'] = '';
		if( $view['operator'] != '')
			$view['operator'] = $array_operator[$view['operator']];
        $view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $view['id'];
        $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.view.loop');
    }
    $xtpl->parse('main.view');
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
