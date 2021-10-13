<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES ., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Jun 20, 2010 8:59:32 PM
 */

namespace NukeViet\StoreHouse\Api;

use NukeViet\Api\Api;
use NukeViet\Api\ApiResult;
use NukeViet\Api\IApi;
use NukeViet\StoreHouse\Pos;
use NukeViet\StoreHouse\Stores;
use PDO;

 
class Product implements IApi
{
    private $result;

    /**
     * @return number
     */
    public static function getAdminLev()
    {
        return Api::ADMIN_LEV_MOD;
    }

    /**
     * @return string
     */
    public static function getCat()
    {
        return '';
    }

    /**
     * {@inheritDoc}
     * @see \NukeViet\Api\IApi::setResultHander()
     */
    public function setResultHander(ApiResult $result)
    {
        $this->result = $result;
    }

    /**
     * {@inheritDoc}
     * @see \NukeViet\Api\IApi::execute()
     */
    public function execute()
    {
        global $nv_Lang, $nv_Request, $db, $nv_Cache, $db_config;

        $module_name = Api::getModuleName();
        $module_info = Api::getModuleInfo();
        $module_data = $module_info['module_data'];
        $admin_id = Api::getAdminId();
		$storehouseRegistry = array(
			'mod_data' => $module_data,
			'mod_name' => $module_name,
			'mod_file' => $module_data,
			'mod_lang' => $nv_Lang,
			'lang_data' => NV_LANG_DATA,
		);
		$sh = new Stores($storehouseRegistry);
        // Get Config Module
        $page_config = [];
        
		$title = $nv_Request->get_title('title', 'post', '');
		$alias = change_alias($title);
		    $alias = strtolower($alias);
		$mod_allow=array();
		$mod_allow[] = 'getProductList';
		$mod_allow[] = 'getAllQuantityProduct';
		$mod_allow[] = 'Sale';
		//$mod_allow[] = 'getProductList';
		$id = $nv_Request->get_int('id', 'get,post', 0);
		$mod = $nv_Request->get_string('mod', 'get,post', '');
		$amod = $nv_Request->get_string('amod', 'get', '');
		$content = '';
		if(in_array($mod, $mod_allow)){
			if ($mod == 'products') {
			    $stmt = $db->prepare('SELECT COUNT(*) FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_products WHERE id!=' . $id . ' AND alias= :alias');
			    $stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
			    $stmt->execute();
			    $nb = $stmt->fetchColumn();
			    if (!empty($nb)) {
			        if ($id) {
			            $alias .= '-' . $id;
			        } else {
			            $nb = $db->query('SELECT MAX(id) FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_products')->fetchColumn();
			            $alias .= '-' . (intval($nb) + 1);
			        }
			    }
				$content=$alias;
			}
			
			if ($mod == 'Sale') {
				$idsite = $nv_Request->get_int('idsite', 'get,post', 0);
				$product_json = $nv_Request->get_string('product', 'get,post', 0);
				$product = json_decode($product_json);
				$content = json_encode($sh->Sale($idsite,$product));
			}
			if ($mod == 'getProductList') {
				$idsite = $nv_Request->get_int('idsite', 'get,post', 0);
				$content = json_encode($sh->productListIdSite($idsite));
			}
			if ($mod == 'getAllQuantityProduct') {
				$idsite = $nv_Request->get_int('idsite', 'get,post', 0);
				$product_id = $nv_Request->get_int('product_id', 'get,post', 0);
			    $content = json_encode($sh->getAllQuantityProduct($idsite,$product_id));
			}
			
		}else{
			$content = '0';
		}
        $this->result->setMessage($content);
        $this->result->setSuccess();

        return $this->result->getResult();
    }
}