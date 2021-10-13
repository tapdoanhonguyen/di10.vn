<?php 
namespace NukeViet\StoreHouse;
use Controller;
class MY_Controller extends Controller {
	public $Settings = "";
    function __construct()
    {
        parent::__construct();
		$this->Settings = $this->site->get_setting();
		$this->settings_model = &load_class('Settings_model');
		if($this->Settings->invoice_view == 2)
			$this->Settings->indian_gst = true;
		else
			$this->Settings->indian_gst = false;
    }

    function page_construct($page, $data = array()) {
        return '';
    }

}
