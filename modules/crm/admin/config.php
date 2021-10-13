<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */
if (!defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

$groups_list = nv_groups_list();

if ($nv_Request->isset_request('submit', 'post')) {
    $array_config = array();

    $array_config['bonus'] = $nv_Request->get_int('percent_book_one', 'post', 0);

    $array_config['sms_on'] = $nv_Request->get_int('sms_on', 'post', 0);
    $array_config['sms_type'] = $nv_Request->get_int('sms_type', 'post', 0);
    $array_config['apikey'] = $nv_Request->get_title('apikey', 'post', '');
    $array_config['secretkey'] = $nv_Request->get_title('secretkey', 'post', '');
    $array_config['email_notify'] = $nv_Request->get_title('email_notify', 'post', '');
    $array_config['brandname'] = $nv_Request->get_title('brandname', 'post', '');
    $array_config['module'] = $nv_Request->get_title('module', 'post', '');

    $sth = $db->prepare("UPDATE " . NV_CONFIG_GLOBALTABLE . " SET config_value = :config_value WHERE lang = '" . NV_LANG_DATA . "' AND module = :module_name AND config_name = :config_name");
    $sth->bindParam(':module_name', $module_name, PDO::PARAM_STR);
    foreach ($array_config as $config_name => $config_value) {
        $sth->bindParam(':config_name', $config_name, PDO::PARAM_STR);
        $sth->bindParam(':config_value', $config_value, PDO::PARAM_STR);
        $sth->execute();
    }
    $nv_Cache->delMod('settings');
    $nv_Cache->delMod($module_name);
    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&rand=' . nv_genpass());
    die();

}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
foreach($site_mods as $mod)
{
	//print_r($mod);die;
	if($mod['module_file'] == 'shops'  )
	{
		if($mod['module_data'] == $array_config['module']){
			$mod['check'] = ' selected="selected"';
		}else{
			$mod['check'] = '';
		}
		$xtpl->assign( 'mod', $mod );
		$xtpl->parse( 'main.mod' );
	}
}
$sql = "SELECT t1.userid, t1.username, t1.email, t1.first_name, t1.last_name FROM " . NV_USERS_GLOBALTABLE . " AS t1 INNER JOIN " . NV_AUTHORS_GLOBALTABLE . " AS t2 ON t1.userid=t2.admin_id WHERE t1.active=1 AND t2.lev=3";
$result = $db->query( $sql );
$array_mods = $result->fetchAll();

$xtpl->assign('SMS_ON', $array_config['sms_on'] ? ' checked="checked"' : '');
// Cau hinh hien thi nguon tin
$array_config_sms_type = array(
    2 => $lang_module['config_sms_type_2'],
    4 => $lang_module['config_sms_type_4'],
    6 => $lang_module['config_sms_type_6'],
    8 => $lang_module['config_sms_type_8']
);
foreach ($array_config_sms_type as $key => $val) {
    $xtpl->assign('SMS_TYPE', array(
        'key' => $key,
        'title' => $val,
        'selected' => $key == $array_config['sms_type'] ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.sms_type');
}


$xtpl->assign('DATA_CONFIG', $array_config);
$xtpl->parse('main');
$contents = $xtpl->text('main');
$page_title = $lang_module['config'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';