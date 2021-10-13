<?php 


class StoreHouse_model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

     public function getAllStore($store_id = 0)
    {
    	$where = '';
    	if($store_id > 0){
    		$where = " store_id = " . $store_id;
    	}
		$this->db->sqlreset()->select('*')
							 ->from($this->db_prefix . '_' . $this->mod_data . '_stores')
							 ->where($where);
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->fetchAll();
        }
        return FALSE;
    }
	public function getStoreByID($store_id = 0)
    {
    	$where = '';
    	if($store_id > 0){
    		$where = " store_id = " . $store_id;
    	}
		$this->db->sqlreset()->select('*')
							 ->from($this->db_prefix . '_' . $this->mod_data . '_stores')
							 ->where($where);
        $q = $this->db->query($this->db->sql());
        if ($q->rowCount() > 0) {
            return $q->fetch();
        }
        return FALSE;
    }
	public function getAllWareHouseOfStore($store = 0)
    {
    	$where = '';
    	if($store > 0) $where .= 'WHERE store_id = ' . $store;
        $q = $this->db->query('SELECT * FROM ' . $this->db_prefix . '_' . $this->mod_data . '_warehouses ' . $where);
        if ($q->rowCount() > 0) {
            return $q->fetchAll();
        }
        return FALSE;
    }
	
	
	
	

}
