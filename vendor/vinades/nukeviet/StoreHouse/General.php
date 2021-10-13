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

class General
{
	
	public $lang_data = '';
	public $mod_data = '';
	public $mod_name = '';
	public $mod_file = '';
	
	public $mod_lang = '';
	public $db_prefix = '';
	public $table = '';
	public $lang = '';
	public $db = '';

	public function __construct( $storehouseRegistry = array() )
	{

		global $db_config, $db, $nv_Request, $nv_Request;
 
		$this->mod_data = $storehouseRegistry['mod_data'];
		$this->mod_name = $storehouseRegistry['mod_name'];
		$this->mod_file = $storehouseRegistry['mod_file'];
		$this->mod_lang = $storehouseRegistry['mod_lang'];
		$this->lang_data = $storehouseRegistry['lang_data'];
		$this->db_prefix = $db_config['prefix'];
		$this->table = $this->db_prefix . '_' . $this->mod_data;
		$this->db = $db;
		//$this->store_id = $this->getStoreId();
		//$this->config = $this->getSetting( 'config', $this->store_id );
 	 
		$this->array_lang_code = $this->getLangMod( 'code' );
		$this->current_language_id = $this->array_lang_code[$this->lang_data]['language_id'];
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
		
		$sql= 'SELECT store_id FROM ' . $this->table . '_store WHERE url = ' . $db->quote( $domain );	
		
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
		
		$sql = 'SELECT language_id, code, name, image FROM ' . $this->table . '_language ORDER BY language_id ASC';

		$list = $this->getdbCache( $sql, 'language', 'language_id' );
 
		$data = array();
		if( $by == 'language_id' )
		{
			foreach( $list as $l )
			{

				$data[$l['language_id']] = $l;
			}
		}
		elseif( $by == 'code' )
		{
			foreach( $list as $l )
			{

				$data[$l['code']] = $l;
			}
		}
		$list = $sql = null;
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

	public function getSetting( $group, $store_id = 0 )
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
	}

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
}
 
if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );