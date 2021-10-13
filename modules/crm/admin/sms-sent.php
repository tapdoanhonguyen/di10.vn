<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV Systems (hoangnt@nguyenvan.vn)
 * @Copyright (C) 2019 NV Branding. All rights reserved
 * @Createdate Wed, 3 Apr 2019 08:34:29 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}
if($nv_Request->isset_request('checkstatus', 'post'))
{
    $id = $nv_Request->get_int('id', 'post');
    $smsid = $nv_Request->get_title('smsid', 'post');
    $data_item = $nv_Request->get_int('data_item', 'post', 0);

    $apikey = $module_config[$module_name]['apikey'];
    $secretkey = $module_config[$module_name]['secretkey'];
    $smsid = urlencode($smsid);
    $data = 'http://rest.esms.vn/MainService.svc/json/GetSendStatus?RefId=' . $smsid . '&ApiKey=' . $apikey . '&Secretkey=' . $secretkey;

    $curl = curl_init($data);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($curl);
    $obj = json_decode($result, true);
    if( $obj['CodeResponse'] == '100'){
        $status = $lang_module['status_sms_' . $obj['SendStatus']];
        if( $obj['SendStatus'] == 5 ){
            $status = '<b class="blue">' . $status . '</b>';
        }else{
            $status = '<b class="red">' . $status . '</b>';
        }
        $db->query('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_sms_history SET status = ' . intval( $obj['SendStatus'] ) . ' WHERE id =' . $id );
    }
    die($status. '_' . ++$data_item);
}

$productid = 0;
$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
// Fetch Limit
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {

    $show_view = true;
    $per_page = 10;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()->select('COUNT(*)')->from('' . NV_PREFIXLANG . '_' . $module_data . '_sms_history');

    $sth = $db->prepare($db->sql());
    $sth->execute();
    $num_items = $sth->fetchColumn();

    $db->select('*')->order('timesend DESC')->limit($per_page)->offset(($page - 1) * $per_page);
    $sth = $db->prepare($db->sql());
    $sth->execute();
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
$xtpl->assign('ROW', $row);

if ($show_view) {
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.generate_page');
    }

    $data_item = 1;
    $xtpl->assign('data_item', $data_item);

    while ($view = $sth->fetch()) {
        $view['stt'] = $data_item++;
        $view['timesend'] = date('d/m/Y H', $view['timesend'] ) . 'h00';
        $view['timesent'] = date('d/m/Y H:i', $view['timesent'] );
        $view['sendtype'] = $lang_module['sendtype_' . $view['sendtype']];
        $view['status_text'] = $lang_module['status_sms_' . $view['status']];
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.loop');
    }
    $xtpl->parse('main.view');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['message_sent'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
