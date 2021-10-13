<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Aug 2018 04:51:26 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');
require NV_ROOTDIR . '/modules/' . $module_file . '/global.catalogy.php';
require NV_ROOTDIR . '/modules/' . $module_file . '/global.datadefault.php';

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if ($nv_Request->isset_request('submit', 'post')) {
    $row['code'] = $nv_Request->get_title('code', 'post', '');
    $row['name'] = $nv_Request->get_title('name', 'post', '');
    $row['unit'] = $nv_Request->get_int('unit', 'post', 0);
    $row['cost'] = $nv_Request->get_title('cost', 'post', '');
    $row['price'] = $nv_Request->get_title('price', 'post', '');
    $row['alert_quantity'] = $nv_Request->get_title('alert_quantity', 'post', '');
    $row['image'] = $nv_Request->get_title('image', 'post', '');
    if (is_file(NV_DOCUMENT_ROOT . $row['image']))     {
        $row['image'] = substr($row['image'], strlen(NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/'));
    } else {
        $row['image'] = '';
    }
    //$row['category'] = $nv_Request->get_array('category_id', 'post', array());
    $row['category_id'] = implode(",", $array_category_of_store);//$array_store_storehouse[$_SESSION[$module_data . '_store_id']]['category_id'];//implode(",",$row['category']);
    $row['subcategory_id'] = $nv_Request->get_int('subcategory_id', 'post', 0);
    $row['second_category_id'] = $nv_Request->get_int('second_category_id', 'post', 0);
    $row['cf4'] = $nv_Request->get_title('cf4', 'post', '');
    $row['cf5'] = $nv_Request->get_title('cf5', 'post', '');
    $row['cf6'] = $nv_Request->get_title('cf6', 'post', '');
    $row['quantity'] = $nv_Request->get_title('quantity', 'post', '');
    $row['tax_rate'] = $nv_Request->get_int('tax_rate', 'post', 0);
    $row['track_quantity'] = $nv_Request->get_int('track_quantity', 'post', 0);
    $row['details'] = $nv_Request->get_editor('details', '', NV_ALLOWED_HTML_TAGS);
    $row['warehouse'] = $nv_Request->get_int('warehouse', 'post', 0);
    $row['barcode_symbology'] = $nv_Request->get_title('barcode_symbology', 'post', '');
    $row['file'] = $nv_Request->get_title('file', 'post', '');
    $row['product_details'] = $nv_Request->get_editor('prodetails', '', NV_ALLOWED_HTML_TAGS);
    $row['tax_method'] = $nv_Request->get_int('tax_method', 'post', 0);
    $row['type'] = $nv_Request->get_title('type', 'post', '');
    $row['supplier1'] = $nv_Request->get_int('supplier1', 'post', 0);
    $row['supplier1price'] = $nv_Request->get_title('supplier1price', 'post', '');
    $row['supplier2'] = $nv_Request->get_int('supplier2', 'post', 0);
    $row['supplier2price'] = $nv_Request->get_title('supplier2price', 'post', '');
    $row['supplier3'] = $nv_Request->get_int('supplier3', 'post', 0);
    $row['supplier3price'] = $nv_Request->get_title('supplier3price', 'post', '');
    $row['supplier4'] = $nv_Request->get_int('supplier4', 'post', 0);
    $row['supplier4price'] = $nv_Request->get_title('supplier4price', 'post', '');
    $row['supplier5'] = $nv_Request->get_int('supplier5', 'post', 0);
    $row['supplier5price'] = $nv_Request->get_title('supplier5price', 'post', '');
    $row['promotion'] = $nv_Request->get_int('promotion', 'post', 0);
    $row['promo_price'] = $nv_Request->get_title('promo_price', 'post', '');
    $row['start_date'] = $nv_Request->get_title('start_date', 'post', '');
    $row['end_date'] = $nv_Request->get_title('end_date', 'post', '');
    $row['supplier1_part_no'] = $nv_Request->get_title('supplier1_part_no', 'post', '');
    $row['supplier2_part_no'] = $nv_Request->get_title('supplier2_part_no', 'post', '');
    $row['supplier3_part_no'] = $nv_Request->get_title('supplier3_part_no', 'post', '');
    $row['supplier4_part_no'] = $nv_Request->get_title('supplier4_part_no', 'post', '');
    $row['supplier5_part_no'] = $nv_Request->get_title('supplier5_part_no', 'post', '');
    $row['sale_unit'] = $nv_Request->get_int('sale_unit', 'post', 0);
    $row['purchase_unit'] = $nv_Request->get_int('purchase_unit', 'post', 0);
    $row['brand'] = $nv_Request->get_int('brand', 'post', 0);
    $row['featured'] = $nv_Request->get_int('featured', 'post', 0);
    $row['weight'] = $nv_Request->get_int('weight', 'post', 0);
    $row['hsn_code'] = $nv_Request->get_int('hsn_code', 'post', 0);
    $row['second_name'] = $nv_Request->get_title('second_name', 'post', '');
	$row['cf1'] = '';
	$row['cf2'] = '';
	$row['cf3'] = '';
	$row['views'] = 0;
	$row['hide'] = 0;
	$row['products'] = $nv_Request->get_array('products_id', 'post', array());
	$row['products_code'] = $nv_Request->get_array('products_code', 'post', array());
	$row['number_product'] = $nv_Request->get_array('number_product', 'post', array());
	$alias = nv_substr($nv_Request->get_title('alias', 'post', '', 1), 0, 255);
    $row['alias'] = ($alias == '') ? change_alias($row['title']) : change_alias($alias);
    if (empty($row['name'])) {
        $error[] = $lang_module['error_required_name'];
    } elseif (empty($row['unit'])) {
        $error[] = $lang_module['error_required_unit'];
    } elseif (empty($row['cost'])) {
        $error[] = $lang_module['error_required_cost'];
    } elseif (empty($row['alert_quantity'])) {
        $error[] = $lang_module['error_required_alert_quantity'];
    } elseif (empty($row['second_category_id'])) {
        $error[] = $lang_module['error_required_category_id'];
    } elseif (empty($row['details'])) {
        $error[] = $lang_module['error_required_details'];
    } elseif (empty($row['barcode_symbology'])) {
        $error[] = $lang_module['error_required_barcode_symbology'];
    }
    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                $stmt = $db->prepare('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_products (code, name, unit, cost, price, alert_quantity, image, category_id, subcategory_id, second_category_id, cf1, cf2, cf3, cf4, cf5, cf6, quantity, tax_rate, track_quantity, details, warehouse, barcode_symbology, file, product_details, tax_method, type, supplier1, supplier1price, supplier2, supplier2price, supplier3, supplier3price, supplier4, supplier4price, supplier5, supplier5price, promotion, promo_price, start_date, end_date, supplier1_part_no, supplier2_part_no, supplier3_part_no, supplier4_part_no, supplier5_part_no, sale_unit, purchase_unit, brand, alias, featured, weight, hsn_code, views, hide, second_name) VALUES (:code, :name, :unit, :cost, :price, :alert_quantity, :image, :category_id, :subcategory_id, :second_category_id, :cf1, :cf2, :cf3, :cf4, :cf5, :cf6, "", :tax_rate, :track_quantity, :details, :warehouse, :barcode_symbology, :file, :product_details, :tax_method, :type, :supplier1, :supplier1price, :supplier2, :supplier2price, :supplier3, :supplier3price, :supplier4, :supplier4price, :supplier5, :supplier5price, :promotion, :promo_price, :start_date, :end_date, :supplier1_part_no, :supplier2_part_no, :supplier3_part_no, :supplier4_part_no, :supplier5_part_no, :sale_unit, :purchase_unit, :brand, :alias, :featured, :weight, :hsn_code, :views, :hide, :second_name)');

				$stmt->bindParam(':views', $row['views'], PDO::PARAM_INT);
				$stmt->bindParam(':hide', $row['hide'], PDO::PARAM_INT);

            } else {
                $stmt = $db->prepare('UPDATE ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_products SET code = :code, name = :name, unit = :unit, cost = :cost, price = :price, alert_quantity = :alert_quantity, image = :image, category_id = :category_id, subcategory_id = :subcategory_id, second_category_id = :second_category_id, cf1 = :cf1, cf2 = :cf2, cf3 = :cf3, cf4 = :cf4, cf5 = :cf5, cf6 = :cf6, tax_rate = :tax_rate, track_quantity = :track_quantity, details = :details, warehouse = :warehouse, barcode_symbology = :barcode_symbology, file = :file, product_details = :product_details, tax_method = :tax_method, type = :type, supplier1 = :supplier1, supplier1price = :supplier1price, supplier2 = :supplier2, supplier2price = :supplier2price, supplier3 = :supplier3, supplier3price = :supplier3price, supplier4 = :supplier4, supplier4price = :supplier4price, supplier5 = :supplier5, supplier5price = :supplier5price, promotion = :promotion, promo_price = :promo_price, start_date = :start_date, end_date = :end_date, supplier1_part_no = :supplier1_part_no, supplier2_part_no = :supplier2_part_no, supplier3_part_no = :supplier3_part_no, supplier4_part_no = :supplier4_part_no, supplier5_part_no = :supplier5_part_no, sale_unit = :sale_unit, purchase_unit = :purchase_unit, brand = :brand, alias = :alias, featured = :featured, weight = :weight, hsn_code = :hsn_code, second_name = :second_name WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':code', $row['code'], PDO::PARAM_STR);
            $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
            $stmt->bindParam(':unit', $row['unit'], PDO::PARAM_INT);
            $stmt->bindParam(':cost', $row['cost'], PDO::PARAM_INT);
            $stmt->bindParam(':price', $row['price'], PDO::PARAM_INT);
            $stmt->bindParam(':alert_quantity', $row['alert_quantity'], PDO::PARAM_INT);
            $stmt->bindParam(':image', $row['image'], PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $row['category_id'], PDO::PARAM_STR);
            $stmt->bindParam(':subcategory_id', $row['subcategory_id'], PDO::PARAM_INT);
            $stmt->bindParam(':second_category_id', $row['second_category_id'], PDO::PARAM_INT);
            $stmt->bindParam(':cf4', $row['cf4'], PDO::PARAM_STR);
            $stmt->bindParam(':cf5', $row['cf5'], PDO::PARAM_STR);
            $stmt->bindParam(':cf6', $row['cf6'], PDO::PARAM_STR);
			$stmt->bindParam(':cf1', $row['cf1'], PDO::PARAM_STR);
			$stmt->bindParam(':cf2', $row['cf2'], PDO::PARAM_STR);
			$stmt->bindParam(':cf3', $row['cf3'], PDO::PARAM_STR);
            $stmt->bindParam(':tax_rate', $row['tax_rate'], PDO::PARAM_INT);
            $stmt->bindParam(':track_quantity', $row['track_quantity'], PDO::PARAM_INT);
            $stmt->bindParam(':details', $row['details'], PDO::PARAM_STR, strlen($row['details']));
            $stmt->bindParam(':warehouse', $row['warehouse'], PDO::PARAM_INT);
            $stmt->bindParam(':barcode_symbology', $row['barcode_symbology'], PDO::PARAM_STR);
            $stmt->bindParam(':file', $row['file'], PDO::PARAM_STR);
            $stmt->bindParam(':product_details', $row['product_details'], PDO::PARAM_STR, strlen($row['product_details']));
            $stmt->bindParam(':tax_method', $row['tax_method'], PDO::PARAM_INT);
            $stmt->bindParam(':type', $row['type'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier1', $row['supplier1'], PDO::PARAM_INT);
            $stmt->bindParam(':supplier1price', $row['supplier1price'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier2', $row['supplier2'], PDO::PARAM_INT);
            $stmt->bindParam(':supplier2price', $row['supplier2price'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier3', $row['supplier3'], PDO::PARAM_INT);
            $stmt->bindParam(':supplier3price', $row['supplier3price'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier4', $row['supplier4'], PDO::PARAM_INT);
            $stmt->bindParam(':supplier4price', $row['supplier4price'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier5', $row['supplier5'], PDO::PARAM_INT);
            $stmt->bindParam(':supplier5price', $row['supplier5price'], PDO::PARAM_STR);
            $stmt->bindParam(':promotion', $row['promotion'], PDO::PARAM_INT);
            $stmt->bindParam(':promo_price', $row['promo_price'], PDO::PARAM_STR);
            $stmt->bindParam(':start_date', $row['start_date'], PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $row['end_date'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier1_part_no', $row['supplier1_part_no'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier2_part_no', $row['supplier2_part_no'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier3_part_no', $row['supplier3_part_no'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier4_part_no', $row['supplier4_part_no'], PDO::PARAM_STR);
            $stmt->bindParam(':supplier5_part_no', $row['supplier5_part_no'], PDO::PARAM_STR);
            $stmt->bindParam(':sale_unit', $row['sale_unit'], PDO::PARAM_INT);
            $stmt->bindParam(':purchase_unit', $row['purchase_unit'], PDO::PARAM_INT);
            $stmt->bindParam(':brand', $row['brand'], PDO::PARAM_INT);
            $stmt->bindParam(':alias', $row['alias'], PDO::PARAM_STR);
            $stmt->bindParam(':featured', $row['featured'], PDO::PARAM_INT);
            $stmt->bindParam(':weight', $row['weight'], PDO::PARAM_INT);
            $stmt->bindParam(':hsn_code', $row['hsn_code'], PDO::PARAM_INT);
            $stmt->bindParam(':second_name', $row['second_name'], PDO::PARAM_STR);
            $exc = $stmt->execute();
            if ($exc) {
            	
				if (empty($row['id'])) {
					$product_id = $db -> lastInsertId();
		        } else {
		            $product_id = $row['id'];
		        }
				$db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_product_of_category WHERE category_id NOT IN (' . $row['second_category_id'] . ') and product_id = ' .  $product_id );
				//foreach($row['second_category_id'] as $cate){
					$product_of_cat = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_product_of_category WHERE category_id = ' . $row['second_category_id'] . ' AND product_id=' . $product_id)->fetch();
					if (empty($product_of_cat)) {
						$db->query('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_product_of_category(product_id, category_id) VALUES (' . $product_id . ',' . $row['second_category_id']. ')');
						if(IDSITE>0)
							$db->query('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_product_of_store(product_id, store_id) VALUES (' . $product_id . ',' . IDSITE . ')');
						elseif($_SESSION[$module_data . '_store_id']>0)
							$db->query('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_product_of_store(product_id, store_id) VALUES (' . $product_id . ',' . $_SESSION[$module_data . '_store_id'] . ')');
					}
				//}
            }
        } catch(PDOException $e) {
            trigger_error($e->getMessage());
            die($e->getMessage()); //Remove this line after checks finished
        }
		$db->query('DELETE FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_material_items WHERE product_id = ' .  $product_id );
		$r=0;
		foreach($row['products'] as $pro_material){
			
			if($pro_material != 0 || $pro_material != ''){
				$stmt = $db->prepare('INSERT INTO ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_material_items (product_id, item_code, item_id, quantity, unit_price) VALUES (:product_id, :item_code, :item_id, :quantity, 0)');
				$stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
				$stmt->bindParam(':quantity', $row['number_product'][$r], PDO::PARAM_STR);
				$stmt->bindParam(':item_id', $row['products'][$r], PDO::PARAM_INT);
	    		$stmt->bindParam(':item_code', $row['products_code'][$r], PDO::PARAM_STR);
	    		$excr = $stmt->execute();
				
			}
			$r++;
		}//die;
        $nv_Cache->delMod($module_name);
        if (empty($row['id'])) {
        	
			
            nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Products', ' ', $admin_info['userid']);
        } else {
            nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Products', 'ID: ' . $row['id'], $admin_info['userid']);
        }
		//die;
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=products_list');
    }
} elseif ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_products WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=products_list');
    }
} else {
    $row['id'] = 0;
    $row['code'] = '';
    $row['name'] = '';
    $row['unit'] = 0;
    $row['cost'] = '';
    $row['price'] = '';
    $row['alert_quantity'] = '1';
    $row['image'] = 'no_image.png';
    $row['category_id'] = 0;
    $row['subcategory_id'] = 0;
    $row['cf4'] = '';
    $row['cf5'] = '';
    $row['cf6'] = '';
    $row['tax_rate'] = 0;
    $row['track_quantity'] = 1;
    $row['details'] = '';
    $row['warehouse'] = 0;
    $row['barcode_symbology'] = 'code128';
    $row['file'] = '';
    $row['product_details'] = '';
    $row['tax_method'] = 0;
    $row['type'] = 'standard';
    $row['supplier1'] = 0;
    $row['supplier1price'] = '';
    $row['supplier2'] = 0;
    $row['supplier2price'] = '';
    $row['supplier3'] = 0;
    $row['supplier3price'] = '';
    $row['supplier4'] = 0;
    $row['supplier4price'] = '';
    $row['supplier5'] = 0;
    $row['supplier5price'] = '';
    $row['promotion'] = 0;
    $row['promo_price'] = '';
    $row['start_date'] = '';
    $row['end_date'] = '';
    $row['supplier1_part_no'] = '';
    $row['supplier2_part_no'] = '';
    $row['supplier3_part_no'] = '';
    $row['supplier4_part_no'] = '';
    $row['supplier5_part_no'] = '';
    $row['sale_unit'] = 0;
    $row['purchase_unit'] = 0;
    $row['brand'] = '';
    $row['alias'] = '';
    $row['featured'] = 0;
    $row['weight'] = '';
    $row['hsn_code'] = 0;
    $row['second_name'] = '';
    $row['second_category_id'] = 0;
}

if($row['id']>0)
	$row['disable'] = "disabled";
else {
	$row['disable'] = "";
}
if (!empty($row['image']) and is_file(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['image'])) {
    $row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['image'];
}

if (defined('NV_EDITOR'))
    require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';

$row['details'] = nv_htmlspecialchars(nv_editor_br2nl($row['details']));
if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $row['details'] = nv_aleditor('details', '100%', '300px', $row['details']);
} else {
    $row['details'] = '<textarea style="width:100%;height:300px" name="details">' . $row['details'] . '</textarea>';
}

$row['product_details'] = nv_htmlspecialchars(nv_editor_br2nl($row['product_details']));
if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $row['product_details'] = nv_aleditor('prodetails', '100%', '300px', $row['product_details']);
} else {
    $row['product_details'] = '<textarea style="width:100%;height:300px" name="product_details">' . $row['product_details'] . '</textarea>';
}
$sql = 'SELECT id, code, name, lev, parent_id, description FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_subcategories WHERE id in(' . implode(',',$array_category_of_store) . ') ORDER BY sort ASC';
$result = $db->query($sql);
$array_secondcat_list = array();

while (list ($catid_i, $code_i, $title_i, $lev_i, $parentid_i) = $result->fetch(3)) {
    $xtitle_i = '';
    if ($lev_i > 0) {
        $xtitle_i .= '&nbsp;';
        for ($i = 1; $i <= $lev_i; $i++) {
            $xtitle_i .= '---';
        }
    }
    $xtitle_i .= $title_i;
    $array_secondcat_list[] = array(
        $catid_i,
        $xtitle_i,
        $parentid_i
    );
}

$xtpl = new XTemplate('products.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
$xtpl->assign('PRODUCT_PREFIX', $store_setting->product_prefix);
$xtpl->assign('ROW', $row);

	$xtpl->parse('main.code');
if (empty($row['alias'])) {
    $xtpl->parse('main.getalias');
    
}

foreach ($array_secondcat_list as $rows_i) {
	if($rows_i[2] == 0){
		$sl = ($rows_i[0] == $row['second_category_id']) ? " selected=\"selected\"" : "";
	    $xtpl->assign('pcatid_i', $rows_i[0]);
	    $xtpl->assign('ptitle_i', $rows_i[1]);
	    $xtpl->assign('pselect', $sl);
	    $xtpl->parse('main.select_secondcategory_id');
	}
    
}
foreach ($array_unit_storehouse as $value) {
	if($value['base_unit'] == 0){
		$xtpl->assign('OPTION', array(
			'key' => $value['id'],
			'title' => $value['name'],
			'selected' => ($value['id'] == $row['unit']) ? ' selected="selected"' : ''
		));
	
		$xtpl->parse('main.select_unit');
	}
}
foreach ($array_tax_rate_storehouse as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['id'],
        'title' => $value['name'],
        'selected' => ($value['id'] == $row['tax_rate']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_tax_rate');
}
foreach ($array_unit_storehouse as $value) {
	if($value['base_unit'] == 0){
		$xtpl->assign('OPTION', array(
			'key' => $value['id'],
			'title' => $value['name'],
			'selected' => ($value['id'] == $row['sale_unit']) ? ' selected="selected"' : ''
		));
	
		$xtpl->parse('main.select_sale_unit');
	}
}
foreach ($array_unit_storehouse as $value) {
	if($value['base_unit'] == 0){
		$xtpl->assign('OPTION', array(
			'key' => $value['id'],
			'title' => $value['name'],
			'selected' => ($value['id'] == $row['purchase_unit']) ? ' selected="selected"' : ''
		));
	
		$xtpl->parse('main.select_purchase_unit');
	}
}
foreach ($array_type as $key => $title) {
    $xtpl->assign('OPTION', array(
        'key' => $key,
        'title' => $title,
        'selected' => ($key == $row['type']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_type');
}
if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}
foreach ($array_brand_storehouse as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['id'],
        'title' => $value['name'],
        'selected' => ($value['id'] == $row['brand']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_brand');
}

foreach ($array_tax_method as $key => $title) {
    $xtpl->assign('OPTION', array(
        'key' => $key,
        'title' => $title,
        'selected' => ($key == $row['tax_method']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_tax_method');
}
foreach ($array_barcode as $key => $title) {
    $xtpl->assign('OPTION', array(
        'key' => $key,
        'title' => $title,
        'selected' => ($key == $row['barcode_symbology']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_barcode');
}
$array_product=$db->query('SELECT * FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_material_items WHERE product_id = ' .  $row['id'])->fetchAll(5);
$i=0;
foreach($array_product as $products_sh)
{
	$i++;
	$xtpl->assign('product_stt', $i);
	$xtpl->assign('products_id', $products_sh->item_id);
	$xtpl->assign('products_code', $products_sh->item_code);
	$xtpl->assign('products_number', storehouse_number_format($products_sh->quantity,0,'',''));
	$xtpl->parse('main.products');
}
$num = $i;
$xtpl->assign('products_material_total', $num);
$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $title_manager_store;

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
