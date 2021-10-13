<?php 
namespace NukeViet\StoreHouse;

use PDO;

use PDOException;
 
class Project extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

		$this -> project_model = &load_class('Project_model');
        $this->load->library('form_validation');
        //$this->load->admin_model('sales_model');
        $this->digital_upload_path = 'files/';
        $this->upload_path = 'assets/uploads/';
        $this->thumbs_path = 'assets/uploads/thumbs/';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
        $this->allowed_file_size = '1024';
        $this->data['logo'] = true;
    }

    public function index($warehouse_id = null)
    {
		return FALSE;
    }

	public function get_Customer_Project($project = null)
    {
        return $this -> project_model -> getCustomerByProject($project);
    }
    public function view($id = null)
    {
        		return FALSE;
    }

    public function pdf($id = null, $view = null, $save_bufffer = null)
    {
       		return FALSE;
    }

    public function combine_pdf($sales_id)
    {
    			return FALSE;
    }

    public function email($id = null)
    {
        		return FALSE;
    }

    /* ------------------------------------------------------------------ */

    public function add($data_order = array())
    {
		
        		return FALSE;
    }

    /* ------------------------------------------------------------------------ */

    public function edit($id = null)
    {
       		return FALSE;
    }

    /* ------------------------------- */
    public function delete($id = null)
    {
        		return FALSE;
    }
    public function update_status($id)
    {
		return FALSE;
    }
    public function packaging($id)
    {
		return FALSE;
    }
	
}
