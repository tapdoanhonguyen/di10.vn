<?php

class Controller {
	public $lang_data = '';
	public $mod_data = '';
	public $mod_data_sales = '';
	public $mod_name = '';
	public $mod_file = '';
	
	public $mod_lang = '';
	public $db_prefix = '';
	public $db_systems = '';
	public $table = '';
	public $lang = '';
	public $db = '';
	public $store_id = '';
	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;
		global $db_config, $db, $nv_Request, $lang_module, $info_module, $global_config, $admin_info;
 
		$this->mod_data = $info_module['mod_data'];
		$this->mod_data_sales = $info_module['mod_data_sales'];
		$this->mod_upload = $info_module['mod_upload'];
		$this->mod_name = $info_module['mod_name'];
		$this->mod_file = $info_module['mod_file'];
		$this->mod_lang = $info_module['mod_lang'];
		$this->lang_data = $info_module['lang_data'];
		$this->db_prefix = $db_config['prefix'];
		$this->db_systems = $db_config['dbsystem'];
		$this->table = $this->db_prefix . '_' . $this->mod_data;
		$this->input = $nv_Request;
		$this->lang = $lang_module;
		$this->db = $db;
		$this->store_id = $global_config['idsite'];
		$this->user_id = (object) $admin_info;
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var = new $class();
			
		}
		$this->load = &load_class('Loader','');;
		$this->load->initialize();
		//print_r($this->session->userdata);die;
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}
