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

 
class Warehouse implements IApi
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
		$mod_allow[] = 'AddWareHouse';
		//$mod_allow[] = 'AddSubStore';
		$id = $nv_Request->get_int('id', 'get,post', 0);
		$mod = $nv_Request->get_string('mod', 'get,post', '');
		$amod = $nv_Request->get_string('amod', 'get', '');
		$content = '';
		if(in_array($mod, $mod_allow)){
			if ($mod == 'AddWareHouse') {
				$idsite = $nv_Request->get_int('idsite', 'get,post', 0);
				$wh_name = $nv_Request->get_title( 'warehouse_name', 'get,post', '' );
				$storeid = $nv_Request->get_title( 'storeid', 'get,post', '' );
				$domain = $nv_Request->get_title( 'domain', 'get,post', '' );
				$content = json_encode($sh->AddWareHouse($storeid,$wh_name,$domain));
			}
			/*
			if ($mod == 'AddSubStore') {
							$idsite = $nv_Request->get_int('idsite', 'get,post', 0);
							$store_name = $nv_Request->get_title( 'store_name', 'get,post', '' );
							$store_url = $nv_Request->get_title( 'store_url', 'get,post', '' );
							$content = json_encode($sh->storeAddSubStoreIdSite($idsite,$store_name,$store_url));
							
						}*/
			
		}else{
			$content = '0';
		}
        $this->result->setMessage($content);
        $this->result->setSuccess();

        return $this->result->getResult();
    }
}