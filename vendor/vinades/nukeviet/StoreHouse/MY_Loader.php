<?php 
use NukeViet\StoreHouse\Loader;
class MY_Loader extends Loader {

    function __construct() {
        parent::__construct();
    }

    public function view($view, $vars = array(), $return = FALSE) {
        $nv = $view;
        $path = explode('/', $view);
        if($path[0] != 'default') {
            $file = str_replace('/', DIRECTORY_SEPARATOR, $view).'.php';
            if(! file_exists(VIEWPATH.$file)) {
                $len = count($path); $i = 0;
                $path[0] = 'default';  $nv = '';
                foreach($path as $p) {
                    if($i == $len - 1) {
                        $nv .= $p;
                    } else {
                        $nv .= $p.'/';
                    }
                    $i++;
                }
            }
        }

        return $this->_ci_load(array('_ci_view' => $nv, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }

	public function admin_model($model, $name = '', $db_conn = FALSE) {
		$this->my_model($model, $name, $db_conn, 'admin');
	}

	public function api_model($model, $name = '', $db_conn = FALSE) {
        $this->my_model($model, $name, $db_conn, 'api');
    }

    public function shop_model($model, $name = '', $db_conn = FALSE) {
		$this->my_model($model, $name, $db_conn, 'shop');
	}

	public function my_model($model, $name = '', $db_conn = FALSE, $dist = '') {
		if (empty($model)) {
			return $this;
		} elseif (is_array($model)) {
			foreach ($model as $key => $value) {
				/* is_int($key) ? $this->model($value, '', $db_conn) : $this->model($key, $value, $db_conn); */
			}
			return $this;
		}

		$path = '';
		if (($last_slash = strrpos($model, '/')) !== FALSE) {
			$path = substr($model, 0, ++$last_slash);
			$model = substr($model, $last_slash);
		}

		if (empty($name)) {
			$name = $model;
		}

		if (in_array($name, $this->_ci_models, TRUE)) {
			return $this;
		}

		 $CI =& get_instance(); 
		/* if (isset($CI->$name)) {
			throw new RuntimeException('The model name you are loading is the name of a resource that is already being used: '.$name);
		} */

		$model = ucfirst($model);
			
		/* if ( ! class_exists($model, FALSE)) {
			foreach ($this->_ci_model_paths as $mod_path) {
				if ( ! file_exists($mod_path.'/'.$model.'.php')) {
					continue;
				}

				if ( ! class_exists($model, FALSE)) {
					throw new RuntimeException($mod_path."models/".($dist ? $dist.'/' : '').$path.$model.".php exists, but doesn't declare class ".$model);
				}
				break;
			}

			if ( ! class_exists($model, FALSE)) {
				throw new RuntimeException('Unable to locate the model you have specified: '.$model);
			}
		} elseif ( ! is_subclass_of($model, 'Model')) {
			throw new RuntimeException("Class ".$model." already exists and doesn't extend Model");
		} */

		$this->_ci_models[] = $name;
		/* $CI->$name = new $model(); */
		return $this;
	}

}
