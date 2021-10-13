<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Thuong Mai So <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2018 Thuong Mai So. All rights reserved
 * @License: Not free read more http://nukeviet.systems
 * @Createdate Fri, 10 Aug 2018 07:54:45 GMT
 */

if (!defined('NV_IS_MOD_STOREHOUSE'))
    die('Stop!!!');

/**
 * nv_theme_storehouse_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_storehouse_main($array_data)
{
    global $module_info, $lang_module, $lang_global, $op, $user_info;

    $xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	$xtpl->assign( 'name', $user_info['full_name'] );
	$xtpl->assign( 'total_my_producttion_plan', $array_data['total_my_producttion_plan'] );
	$xtpl->assign( 'total_my_producttion_plan_0', $array_data['total_my_producttion_plan_0'] );
	$xtpl->assign( 'total_my_producttion_plan_1', $array_data['total_my_producttion_plan_1'] );
	$xtpl->assign( 'total_my_producttion_plan_2', $array_data['total_my_producttion_plan_2'] );
	$xtpl->assign( 'total_my_producttion_plan_3', $array_data['total_my_producttion_plan_3'] );

	foreach ($array_data as $view) {
		$xtpl->assign('VIEW', $view);
	    $xtpl->parse('main.view.loop');
	}
	$xtpl->parse('main.view');
    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_storehouse_detail()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_storehouse_project_sales($project_sales,$vehicle)
{
    global $module_info, $lang_module, $lang_global, $op,$array_sales_status,$global_array_status_pro_sche, $array_customer_id_storehouse, $array_warehouse_id_storehouse;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	if($project_sales->rowCount()){
		$number = 0;
		while($pl = $project_sales->fetch()){
			if($pl['status'] != ''){
				$pl['number'] = $number++;
		        $pl['date'] = (empty($pl['date'])) ? '' : nv_date('H:i d/m/Y', $pl['date']);
				$pl['sales_status'] = $array_sales_status[$pl['sale_status']];
				$pl['working_status'] = $global_array_status_pro_sche[$pl['status']];
				
				$xtpl->assign('PLAN', $pl);
				$xtpl->parse('main.production_plan.loop.actionpl');
					
				$xtpl->parse('main.production_plan.loop');
			}
			
		}
		$xtpl->parse('main.production_plan');
	}
	if($vehicle->rowCount()){
		while($v = $vehicle->fetch()){
			$v['number'] = $number++;
	        $v['date'] = (empty($v['date'])) ? '' : nv_date('H:i d/m/Y', $v['date']);
			$v['customer_id'] = $array_customer_id_storehouse[$v['customer_id']]['company'];
			$v['warehouse_id'] = $array_warehouse_id_storehouse[$v['warehouse_id']]['name'];
			$v['status'] = $array_sales_status[$v['sale_status']];
			
			$xtpl->assign('VEHICLE', $v);
			$xtpl->parse('main.vehicle.loop.actionv');
			$xtpl->parse('main.vehicle.loop');
		}
		$xtpl->parse('main.vehicle');
	}

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_storehouse_search()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_storehouse_search($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_storehouse_ajax()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_storehouse_ajax($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_storehouse_store_list()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_storehouse_store_list($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}
function nv_theme_storehouse_customer_project($customer,$rpproduct,$start,$end)
{
    global $module_info, $lang_module, $lang_global, $op;
	$customer_view=$rpproduct->customer_report($customer->id);
	$list_project=$rpproduct->getProjectReport($customer->id);
    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	$xtpl->assign( 'name', $customer->company );
	//print_r($customer_view);die;
	$xtpl->assign('total_amount', storehouse_number_format($customer_view['sales']['total_amount'],0));
	$xtpl->assign('paid', storehouse_number_format($customer_view['sales']['paid'],0));
	$xtpl->assign('total_paid', storehouse_number_format($customer_view['sales']['total_amount']-$customer_view['sales']['paid'],0));
	$xtpl->assign('total_sales', storehouse_number_format($customer_view['total_sales'],0));
    $i=1;
	if(!empty($list_project)){
		foreach($list_project as $project){
			if($project->customerid == $customer->id && $i<=5){
				$xtpl->assign('number', $i);
				$xtpl->assign('PROJECT', $project);
				$xtpl->parse('main.project.loop');
			}
			$i++;
			
		}
	}
	$xtpl->parse('main.project');
    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_theme_storehouse_customer_sales($customer,$rpproduct,$start,$end)
{
    global $module_info, $lang_module, $lang_global, $op, $array_payment_status;
	$list_sales=$rpproduct->getSalesReport();
    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	$i=1;
	if(!empty($list_sales)){
		foreach($list_sales as $sale){
			if($sale['customer_id'] == $customer->id){
				$sale['number'] = $i;
				$sale['payment_status_text'] = $array_payment_status[$sale['payment_status']];
				$xtpl->assign('SALES', $sale);
				$xtpl->parse('main.sale.items');
			}
			$i++;
			
		}
	}
    $xtpl->parse('main.sale');
    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_theme_storehouse_customer_info($customer,$rpproduct,$start,$end)
{
    global $module_info, $lang_module, $lang_global, $op, $user_info, $array_payment_status,$global_config;
	$customer_view=$rpproduct->customer_report($customer->id);
	
	$list_sales=$rpproduct->getSalesReport($start,$end);
	$list_project=$rpproduct->getProjectReport($customer->id);
    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('MYDOMAIN', $global_config['site_url']);
	
    $xtpl->assign('TEMPLATE', $global_config['site_theme']);
	//print_r($global_config);die;
	$xtpl->assign( 'name', $customer->company );
	//print_r($customer_view);die;
	$xtpl->assign('total_amount', storehouse_number_format($customer_view['sales']['total_amount'],0));
	$xtpl->assign('paid', storehouse_number_format($customer_view['sales']['paid'],0));
	$xtpl->assign('total_paid', storehouse_number_format($customer_view['sales']['total_amount']-$customer_view['sales']['paid'],0));
	$xtpl->assign('total_sales', storehouse_number_format($customer_view['total_sales'],0));
	$i=1;
	if(!empty($list_sales)){
		foreach($list_sales as $sale){
			if($sale['customer_id'] == $customer->id && $i<=5){
				$sale['number'] = $i;
				$sale['payment_status_text'] = $array_payment_status[$sale['payment_status']];
				$xtpl->assign('SALES', $sale);
				$xtpl->parse('main.info.sales');
			}
			$i++;
			
		}
	}
	if(!empty($list_project)){
		$i=1;
		foreach($list_project as $project){
			if($project->customerid == $customer->id && $i<=5){
				$xtpl->assign('number', $i);
				$xtpl->assign('PROJECT', $project);
				$xtpl->parse('main.info.project');
			}
			$i++;
			
		}
	}
	$xtpl->parse('main.info');
    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_theme_storehouse_supplier_info($supply,$rpproduct,$start,$end)
{
    global $module_info, $lang_module, $lang_global, $op, $user_info,$global_config, $array_status, $array_payment_status, $module_name;
	
	
	$suppliers_purchase=$rpproduct->supplier_report($supply->id);
	$list_purchases=$rpproduct->getPurchasesReport();
	$list_product_items=$rpproduct->getProductBySupplier($supply->id);
	//print_r($list_purchases_items);die;
    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global); 
    $xtpl->assign('MYDOMAIN', $global_config['site_url']);
    $xtpl->assign('TEMPLATE', $global_config['site_url']);
	$xtpl->assign( 'name', $supply->company );
	$xtpl->assign('total_amount', storehouse_number_format($suppliers_purchase['purchases']['total_amount'],0));
	$xtpl->assign('paid', storehouse_number_format($suppliers_purchase['purchases']['paid'],0));
	$xtpl->assign('total_paid', storehouse_number_format($suppliers_purchase['purchases']['total_amount']-$suppliers_purchase['purchases']['paid'],0));
	$xtpl->assign('total_purchases', storehouse_number_format($suppliers_purchase['total_purchases'],0));
	$i=1;
	$total_num_row = 0;
	$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;
	//$base_url_rewrite = nv_url_rewrite(str_replace('&amp;', '&', $base_url) . '&' . NV_OP_VARIABLE . '=' . $rowdetail['alias'] . $global_config['rewrite_exturl'], true);
	if(!empty($list_product_items)){
		foreach($list_product_items as $product){
				$product->number = $i;
				//$report_product=$rpproduct->getProductsReportBySupply($product,$supply->id);
				$xtpl->assign('PRODUCT', $product);
				$xtpl->parse('main.info.product');
				$i++;
		}
	}
	if(!empty($list_purchases)){
		$i=1;
		foreach($list_purchases as $purchase){
			if($purchase['supplier_id'] == $supply->id){
				$purchase['number'] = $i;
				$purchase['payment_status_text'] = $array_payment_status[$purchase['payment_status']];
				$purchase['status_text'] = $array_payment_status[$purchase['status']];
				$purchase['link_view_purchases'] = $base_url . '&amp;' . NV_OP_VARIABLE . '=ajax&mod=supplier_view_purchases&purchaseid=' . $purchase['id'];
				$xtpl->assign('PURCHASE', $purchase);
				$xtpl->parse('main.info.purchases');
				$total_num_row++;
			}
			$i++;
			
		}
	}
	$xtpl->parse('main.info');
    $xtpl->parse('main');
    return $xtpl->text('main');
}
function nv_theme_storehouse_no_permission()
{
    global $module_info, $lang_module, $lang_global, $op, $user_info,$global_config, $array_status, $array_payment_status, $module_name;
	
	
    $xtpl = new XTemplate('no_permission.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global); 
    $xtpl->assign('MYDOMAIN', $global_config['site_url']);
    $xtpl->assign('TEMPLATE', $global_config['site_url']);
    $xtpl->parse('main');
    return $xtpl->text('main');
}
/**
 * nv_avatar()
 *
 * @param mixed $array
 * @return void
 */
function nv_avatar($array)
{
    global $module_info, $module_name, $lang_module, $lang_global, $global_config;

    $xtpl = new XTemplate('avatar.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
    $xtpl->assign('TEMPLATE', $global_config['module_theme']);
    $xtpl->assign('MODULE_FILE', $module_info['module_file']);
	//print_r($global_config);
    $xtpl->assign('NV_AVATAR_WIDTH', 80);
    $xtpl->assign('NV_AVATAR_HEIGHT', 80);
    $xtpl->assign('NV_MAX_WIDTH', NV_MAX_WIDTH);
    $xtpl->assign('NV_MAX_HEIGHT', NV_MAX_HEIGHT);
    $xtpl->assign('NV_UPLOAD_MAX_FILESIZE', NV_UPLOAD_MAX_FILESIZE);

    $form_action = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=avatar';
    if (!empty($array['u'])) {
        $form_action .= '/' . $array['u'];
    }
    $xtpl->assign('NV_AVATAR_UPLOAD', $form_action);

    $lang_module['avatar_bigfile'] = sprintf($lang_module['avatar_bigfile'], nv_convertfromBytes(NV_UPLOAD_MAX_FILESIZE));
    $lang_module['avatar_bigsize'] = sprintf($lang_module['avatar_bigsize'], NV_MAX_WIDTH, NV_MAX_HEIGHT);
    $lang_module['avatar_smallsize'] = sprintf($lang_module['avatar_smallsize'], $global_config['avatar_width'], $global_config['avatar_height']);

    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    if ($array['error']) {
        $xtpl->assign('ERROR', $array['error']);
        $xtpl->parse('main.error');
    }
    if ($array['success'] == 1) {
        $xtpl->assign('FILENAME', $array['filename']);
        $xtpl->parse('main.complete');
    } elseif ($array['success'] == 2) {
        $xtpl->parse('main.complete2');
    } elseif ($array['success'] == 3) {
        $xtpl->assign('FILENAME', $array['filename']);
        $xtpl->parse('main.complete3');
    } else {
        $xtpl->parse('main.init');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}
