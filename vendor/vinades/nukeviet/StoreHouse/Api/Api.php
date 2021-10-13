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
use PDO;

 
class SHApi implements IApi
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

        // Get Config Module
        $page_config = [];
        
		$title = $nv_Request->get_title('title', 'post', '');
		$alias = change_alias($title);
		    $alias = strtolower($alias);
		
		$id = $nv_Request->get_int('id', 'get,post', 0);
		$mod = $nv_Request->get_string('mod', 'get,post', '');
		$amod = $nv_Request->get_string('amod', 'get', '');
		$content = '';
		if ($mod == 'apicheck') {
			$apikey = $nv_Request->get_string('apikey', 'get,post', '');
			$apisecret = $nv_Request->get_string('apisecret', 'get,post', '');
		    $stmt = $db->prepare('SELECT COUNT(*) FROM ' . $db_config['prefix'] . '_' . $module_data . '_api_credential WHERE credential_ident=:apikey AND credential_secret= :apisecret');
		    $stmt->bindParam(':apikey', $apikey, PDO::PARAM_STR);
		    $stmt->bindParam(':apisecret', $apisecret, PDO::PARAM_STR);
		    $stmt->execute();
		    $nb = $stmt->fetchColumn();
		    if (!empty($nb)) {
		       $content='OKE';
		    }else{
		    	$content='NO';
		    }
			
		}
		
        $this->result->setMessage($content);
        $this->result->setSuccess();

        return $this->result->getResult();
    }
}