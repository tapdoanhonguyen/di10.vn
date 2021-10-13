<?php

/**
 * @Project NUKEVIET 4.x
 * @Author DANGDINHTU (dlinhvan@gmail.com)
 * @Copyright (C) 2013 Webdep24.com. All rights reserved
 * @Blog http://dangdinhtu.com
 * @Developers http://developers.dangdinhtu.com/
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Mon, 20 Oct 2014 14:00:59 GMT
 */
 

namespace NukeViet\StoreHouse;

class StoreHouse extends MY_Controller

{
	
	public $lang_data = '';
	public $mod_data = '';
	public $mod_name = '';
	public $mod_file = '';
	
	public $mod_lang = '';
	public $db_prefix = '';
	public $table = '';
	public $lang = '';

	public function __construct( $purchaesRegistry = array() )
	{

		global $db_config, $db, $nv_Request, $nv_Request;
 
		parent::__construct($purchaesRegistry);

		$this->storehouse_model = &load_class('StoreHouse_model');
		//$this->config = $this->getSetting( 'config', $this->store_id );
 	 
		//$this->array_lang_code = $this->getLangMod( 'code' );
		//$this->current_language_id = $this->array_lang_code[$this->lang_data]['language_id'];
	}

	public function deleteCache( $part )
	{
		//array('cat', setting)

		if( is_array( $part ) )
		{
			foreach( $part as $_part )
			{
				$files = glob( NV_ROOTDIR . '/' . NV_CACHEDIR . '/' . $this->mod_name . '/' . NV_CACHE_PREFIX . '.' . preg_replace( '/[^A-Z0-9\._-]/i', '', $_part ) . '.*.cache' );
				if( $files )
				{
					foreach( $files as $file )
					{
						if( file_exists( $file ) )
						{
							unlink( $file );
						}
					}
				}
			}
		}
		else
		{
			$files = glob( NV_ROOTDIR . '/' . NV_CACHEDIR . '/' . $this->mod_name . '/' . NV_CACHE_PREFIX . '.' . preg_replace( '/[^A-Z0-9\._-]/i', '', $part ) . '.*.cache' );
			if( $files )
			{
				foreach( $files as $file )
				{
					if( file_exists( $file ) )
					{
						unlink( $file );
					}
				}
			}
		}

		return true;
	}

	public function getdbCache( $sql, $part, $key = '' )
	{
		global $nv_Cache, $db;
		$data = array();
		$cache_file = NV_CACHE_PREFIX . '.' . $part . '.' . $this->lang_data . '.cache';
		if( ( $cache = $nv_Cache->getItem( $this->mod_name, $cache_file ) ) != false )
		{
			$data = unserialize( $cache );
		}
		else
		{
			
			if( ( $result = $db->query( $sql ) ) !== false )
			{
				$a = 0;
				while( $row = $result->fetch() )
				{
					$key2 = ( ! empty( $key ) and isset( $row[$key] ) ) ? $row[$key] : $a;
					
					$data[$key2] = $row;
					
					++$a;
				}
				$result->closeCursor();

				$cache = serialize( $data );
				$nv_Cache->setItem( $this->mod_name, $cache_file, $cache );
			}
		}
		 
		return $data;
		 
	}

	public function getStoreId()
	{
		global $nv_Cache, $db;
		
		$domain = str_replace( 'http://', '', NV_MY_DOMAIN );
		
		$sql= 'SELECT store_id FROM ' . $this->table . '_stores WHERE url = ' . $db->quote( $domain );	
		
		$result = $this->getdbCache( $sql, md5( $domain ) . '.store', '' );
		
		return isset( $result[0] ) ? $result[0]['store_id'] : 0;

	}
	
	public function lang( $key )
	{
		return isset( $this->mod_lang[$key] ) ? $this->mod_lang[$key] : $key;
	}

	public function getLangMod( $by = 'language_id' )
	{
		global $nv_Cache, $db;
		
		$data = array();
		return $data;
	}

	public function getLangSite( $name, $dir )
	{
		if( ! file_exists( NV_ROOTDIR . '/modules/' . $this->mod_file . '/language/' . $dir . '/' . $name . '_' . NV_LANG_DATA . '.php' ) )
		{
			trigger_error( 'Error! Language variables ' . $name . ' is empty!', 256 );
		}
		require ( NV_ROOTDIR . '/modules/' . $this->mod_file . '/language/' . $dir . '/' . $name . '_' . NV_LANG_DATA . '.php' );

		return $lang_module;
	}

	/* public function getSetting( $group, $store_id = 0 )
	{
		global $nv_Cache, $db;
		
		$data = array();

		$sql = 'SELECT * FROM ' . $this->table . '_setting WHERE store_id = ' . intval( $store_id ) . ' AND groups = ' . $db->quote( $group );

		$cache_file = NV_CACHE_PREFIX . '.setting.' . $store_id . '.' . $group . '.' . $this->lang_data . '.cache';
		
		if( ( $cache = $nv_Cache->getItem( $this->mod_name, $cache_file ) ) != false )
		{
			$data = unserialize( $cache );
		}
		else
		{
			if( ( $result = $db->query( $sql ) ) !== false )
			{
				$a = 0;
				while( $row = $result->fetch() )
				{
					if( ! $row['serialized'] )
					{
						$data[$row['code']] = $row['value'];
					}
					else
					{
						$data[$row['code']] = unserialize( $row['value'] );
					}
					++$a;
				}
				$result->closeCursor();

				$cache = serialize( $data );
				$nv_Cache->setItem( $this->mod_name, $cache_file, $cache );
			}
		}
		$sql = null;
		return $data;
	} */

	public function __destruct()
	{
		foreach( $this as $key => $value )
		{
			unset( $this->$key );
		}
	}

	public function clear()
	{
		$this->__destruct();
	}
	public function getAllWarehouses()
    {
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_warehouses');
        if ($q->rowCount() > 0) {
            foreach (($q->fetchAll(5)) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	public function getProductQuantity($product_id, $warehouse=0)
    {
    	$where='';
    	if($warehouse > 0){
    		$where .= 'AND warehouse_id = ' . $warehouse;
    	}
		
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_warehouses_products WHERE product_id = ' . $product_id . ' ' . $where);
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function getUnitByProIdSale($product_id)
    {
    	$product = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_products WHERE id = ' . $product_id)->fetch(5);
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_units WHERE id = ' . $product->sale_unit);
        if ($q->rowCount() > 0) {
            return $q->fetch(5);
        }
        return FALSE;
    }
	public function checkpermission($user_id = 1)
    {
    	$group_id = $this->check_user_group($user_id);
		$permission = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix. '_' . $this->mod_data . '_permissions WHERE group_id = ' . $group_id )->fetch(5);
        //die('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix. '_' . $this->mod_data . '_permissions WHERE group_id = ' . $group_id );
        return json_decode($permission->per_access);
    }
	public function check_user_group($user_id = 0)
    {
    	$group = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix. '_' . $this->mod_data . '_groups_user WHERE userid = ' . $user_id . ' AND approved=1');
        if ($group->rowCount() > 0) {
            return $group->fetch(5)->group_id;
        }
        return 0;
    }
	public function check_user_group_leader($user_id = 0, $group_id = 0)
    {
    	$group = $this->db->query('SELECT * FROM ' . $this->db_systems . '.' . $this->db_prefix. '_' . $this->mod_data . '_groups_user WHERE userid = ' . $user_id . ' AND approved=1 AND group_id = ' . $group_id . ' AND is_leader = 1');
        if ($group->rowCount() > 0) {
            return 1;
        }
        return 0;
    }
	public function getConfigSetting($store_id)
    {
    	if($store_id == ''){$store_id =0;}
		//print_r('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_settings WHERE setting_id = ' . $store_id . ' ');die;
    	$q = $this->db->query('SELECT * FROM ' . $this->db_prefix. '_' . $this->mod_data . '_settings WHERE setting_id = ' . $store_id . ' ');
        //if ($q->rowCount() > 0) {
           // return $q->fetch(5);
       // }
        return 0;
    }
}
 
if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );