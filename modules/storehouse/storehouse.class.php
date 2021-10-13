<?php

if (!defined('NV_MAINFILE')) {
	die('Stop!!!');
}

$timezone = "Asia/Ho_Chi_Minh";
if (function_exists('date_default_timezone_set'))
	date_default_timezone_set($timezone);
define('TIMEZONE', $timezone);

define("DEMO", 1);
define("UTF8_ENABLED", 1);

define('ENVIRONMENT', 'production');

switch (ENVIRONMENT) {
	case 'development' :
		error_reporting(-1);
		ini_set('display_errors', 1);
		break;

	case 'testing' :
	case 'production' :
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>=')) {
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		} else {
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
		break;

	default :
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1);
	// EXIT_ERROR
}

$system_path = NV_ROOTDIR . '/vendor/vinades/nukeviet/StoreHouse';

$application_folder = NV_ROOTDIR . '/vendor/vinades/nukeviet/StoreHouse/app';

$view_folder = NV_ROOTDIR . '/vendor/vinades/nukeviet/StoreHouse/themes';

if (defined('STDIN')) {
	chdir(dirname(__FILE__));
}

if (($_temp = realpath($system_path)) !== FALSE) {
	$system_path = $_temp . DIRECTORY_SEPARATOR;
} else {
	// Ensure there's a trailing slash
	$system_path = strtr(rtrim($system_path, '/\\'), '/\\', DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
}

// Is the system path correct?
if (!is_dir($system_path)) {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: ' . pathinfo(__FILE__, PATHINFO_BASENAME);
	exit(3);
	// EXIT_CONFIG
}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the system directory
define('BASEPATH', $system_path);

// Path to the front controller (this file) directory
define('FCPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

// Name of the "system" directory
define('SYSDIR', basename(BASEPATH));

// The path to the "application" directory
if (is_dir($application_folder)) {
	if (($_temp = realpath($application_folder)) !== FALSE) {
		$application_folder = $_temp;
	} else {
		$application_folder = strtr(rtrim($application_folder, '/\\'), '/\\', DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR);
	}
} elseif (is_dir(BASEPATH . $application_folder . DIRECTORY_SEPARATOR)) {
	$application_folder = BASEPATH . strtr(trim($application_folder, '/\\'), '/\\', DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR);
} else {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
	exit(3);
	// EXIT_CONFIG
}

define('APPPATH', $application_folder . DIRECTORY_SEPARATOR);

// The path to the "views" directory
if (!isset($view_folder[0]) && is_dir(APPPATH . 'views' . DIRECTORY_SEPARATOR)) {
	$view_folder = APPPATH . 'views';
} elseif (is_dir($view_folder)) {
	if (($_temp = realpath($view_folder)) !== FALSE) {
		$view_folder = $_temp;
	} else {
		$view_folder = strtr(rtrim($view_folder, '/\\'), '/\\', DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR);
	}
} elseif (is_dir(APPPATH . $view_folder . DIRECTORY_SEPARATOR)) {
	$view_folder = APPPATH . strtr(trim($view_folder, '/\\'), '/\\', DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR);
} else {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
	exit(3);
	// EXIT_CONFIG
}

define('VIEWPATH', $view_folder . DIRECTORY_SEPARATOR);

if (!function_exists('is_php')) {
	/**
	 * Determines if the current version of PHP is equal to or greater than the supplied value
	 *
	 * @param	string
	 * @return	bool	TRUE if the current version is $version or higher
	 */
	function is_php($version) {
		static $_is_php;
		$version = (string)$version;

		if (!isset($_is_php[$version])) {
			$_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
		}

		return $_is_php[$version];
	}

}

// ------------------------------------------------------------------------

if (!function_exists('is_really_writable')) {
	/**
	 * Tests for file writability
	 *
	 * is_writable() returns TRUE on Windows servers when you really can't write to
	 * the file, based on the read-only attribute. is_writable() is also unreliable
	 * on Unix servers if safe_mode is on.
	 *
	 * @link	https://bugs.php.net/bug.php?id=54709
	 * @param	string
	 * @return	bool
	 */
	function is_really_writable($file) {
		// If we're on a Unix server with safe_mode off we call is_writable
		if (DIRECTORY_SEPARATOR === '/' && (is_php('5.4') OR !ini_get('safe_mode'))) {
			return is_writable($file);
		}

		/* For Windows servers and safe_mode "on" installations we'll actually
		 * write a file then read it. Bah...
		 */
		if (is_dir($file)) {
			$file = rtrim($file, '/') . '/' . md5(mt_rand());
			if (($fp = @fopen($file, 'ab')) === FALSE) {
				return FALSE;
			}

			fclose($fp);
			@chmod($file, 0777);
			@unlink($file);
			return TRUE;
		} elseif (!is_file($file) OR ($fp = @fopen($file, 'ab')) === FALSE) {
			return FALSE;
		}

		fclose($fp);
		return TRUE;
	}

}

// ------------------------------------------------------------------------

if (!function_exists('load_class')) {
	/**
	 * Class registry
	 *
	 * This function acts as a singleton. If the requested class does not
	 * exist it is instantiated and set to a static variable. If it has
	 * previously been instantiated the variable is returned.
	 *
	 * @param	string	the class name being requested
	 * @param	string	the directory where the class should be found
	 * @param	mixed	an optional argument to pass to the class constructor
	 * @return	object
	 */
	function & load_class($class, $namespace = '', $param = NULL) {
		static $_classes = array();

		// Does the class exist? If so, we're done...
		if (isset($_classes[$class])) {
			return $_classes[$class];
		}

		$name = FALSE;

		// Look for the class first in the local application/libraries folder
		// then in the native system/libraries folder

		if (file_exists(BASEPATH . '' . $class . '.php')) {
			$name = '' . $class;
			require_once (BASEPATH . '' . $class . '.php');
		}
		// Did we find the class?
		if ($name === FALSE) {
			// Note: We use exit() rather than show_error() in order to avoid a
			// self-referencing loop with the Exceptions class
			set_status_header(503);
			echo 'Unable to locate the specified class: ' . $class . '.php';
			exit(5);
			// EXIT_UNK_CLASS
		}

		// Keep track of what we just loaded
		is_loaded($class);

		$_classes[$class] = isset($param) ? new $name($param) : new $name;
		return $_classes[$class];
	}

}

// --------------------------------------------------------------------

if (!function_exists('is_loaded')) {
	/**
	 * Keeps track of which libraries have been loaded. This function is
	 * called by the load_class() function above
	 *
	 * @param	string
	 * @return	array
	 */
	function & is_loaded($class = '') {
		static $_is_loaded = array();

		if ($class !== '') {
			$_is_loaded[strtolower($class)] = $class;
		}

		return $_is_loaded;
	}

}

// ------------------------------------------------------------------------

if (!function_exists('get_config')) {
	/**
	 * Loads the main config.php file
	 *
	 * This function lets us grab the config file even if the Config class
	 * hasn't been instantiated yet
	 *
	 * @param	array
	 * @return	array
	 */
	function & get_config(Array $replace = array()) {
		static $config;

		if (empty($config)) {
			$file_path = APPPATH . 'config/config.php';
			$found = FALSE;
			if (file_exists($file_path)) {
				$found = TRUE;
				require ($file_path);
			}

			// Is the config file in the environment folder?
			if (file_exists($file_path = APPPATH . 'config/' . ENVIRONMENT . '/config.php')) {
				require ($file_path);
			} elseif (!$found) {
				set_status_header(503);
				echo 'The configuration file does not exist.';
				exit(3);
				// EXIT_CONFIG
			}

			// Does the $config array exist in the file?
			if (!isset($config) OR !is_array($config)) {
				set_status_header(503);
				echo 'Your config file does not appear to be formatted correctly.';
				exit(3);
				// EXIT_CONFIG
			}
		}

		// Are any values being dynamically added or replaced?
		foreach ($replace as $key => $val) {
			$config[$key] = $val;
		}

		return $config;
	}

}

// ------------------------------------------------------------------------

if (!function_exists('config_item')) {
	/**
	 * Returns the specified config item
	 *
	 * @param	string
	 * @return	mixed
	 */
	function config_item($item) {
		static $_config;

		if (empty($_config)) {
			// references cannot be directly assigned to static variables, so we use an array
			$_config[0] = &get_config();
		}

		return isset($_config[0][$item]) ? $_config[0][$item] : NULL;
	}

}

// ------------------------------------------------------------------------

if (!function_exists('get_mimes')) {
	/**
	 * Returns the MIME types array from config/mimes.php
	 *
	 * @return	array
	 */
	function & get_mimes() {
		static $_mimes;

		if (empty($_mimes)) {
			$_mimes = file_exists(APPPATH . 'config/mimes.php') ?
			include (APPPATH . 'config/mimes.php') : array();

			if (file_exists(APPPATH . 'config/' . ENVIRONMENT . '/mimes.php')) {
				$_mimes = array_merge($_mimes,
				include (APPPATH . 'config/' . ENVIRONMENT . '/mimes.php'));
			}
		}

		return $_mimes;
	}

}

// ------------------------------------------------------------------------

if (!function_exists('is_https')) {
	/**
	 * Is HTTPS?
	 *
	 * Determines if the application is accessed via an encrypted
	 * (HTTPS) connection.
	 *
	 * @return	bool
	 */
	function is_https() {
		if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
			return TRUE;
		} elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
			return TRUE;
		} elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
			return TRUE;
		}

		return FALSE;
	}

}

// ------------------------------------------------------------------------

if (!function_exists('is_cli')) {

	/**
	 * Is CLI?
	 *
	 * Test to see if a request was made from the command line.
	 *
	 * @return 	bool
	 */
	function is_cli() {
		return (PHP_SAPI === 'cli' OR defined('STDIN'));
	}

}

// ------------------------------------------------------------------------

if (!function_exists('show_error')) {
	/**
	 * Error Handler
	 *
	 * This function lets us invoke the exception class and
	 * display errors using the standard error template located
	 * in application/views/errors/error_general.php
	 * This function will send the error page directly to the
	 * browser and exit.
	 *
	 * @param	string
	 * @param	int
	 * @param	string
	 * @return	void
	 */
	function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered') {
		$status_code = abs($status_code);
		if ($status_code < 100) {
			$exit_status = $status_code + 9;
			// 9 is EXIT__AUTO_MIN
			$status_code = 500;
		} else {
			$exit_status = 1;
			// EXIT_ERROR
		}

		$_error = new NukeViet\StoreHouse\Exceptions;
		echo $_error -> show_error($heading, $message, 'error_general', $status_code);
		exit($exit_status);
	}

}

// ------------------------------------------------------------------------

if (!function_exists('show_404')) {
	/**
	 * 404 Page Handler
	 *
	 * This function is similar to the show_error() function above
	 * However, instead of the standard error template it displays
	 * 404 errors.
	 *
	 * @param	string
	 * @param	bool
	 * @return	void
	 */
	function show_404($page = '', $log_error = TRUE) {
		$_error = new Exceptions;
		$_error -> show_404($page, $log_error);
		exit(4);
		// EXIT_UNKNOWN_FILE
	}

}

// ------------------------------------------------------------------------

if (!function_exists('log_message')) {
	/**
	 * Error Logging Interface
	 *
	 * We use this as a simple mechanism to access the logging
	 * class and send messages to be logged.
	 *
	 * @param	string	the error level: 'error', 'debug' or 'info'
	 * @param	string	the error message
	 * @return	void
	 */
	function log_message($level, $message) {
		static $_log;

		if ($_log === NULL) {
			// references cannot be directly assigned to static variables, so we use an array
			$_log[0] = new NukeViet\StoreHouse\Log;
		}

		$_log[0] -> write_log($level, $message);
	}

}

// ------------------------------------------------------------------------

if (!function_exists('set_status_header')) {
	/**
	 * Set HTTP Status Header
	 *
	 * @param	int	the status code
	 * @param	string
	 * @return	void
	 */
	function set_status_header($code = 200, $text = '') {
		if (is_cli()) {
			return;
		}

		if (empty($code) OR !is_numeric($code)) {
			show_error('Status codes must be numeric', 500);
		}

		if (empty($text)) {
			is_int($code) OR $code = (int)$code;
			$stati = array(100 => 'Continue', 101 => 'Switching Protocols', 200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information', 204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content', 300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other', 304 => 'Not Modified', 305 => 'Use Proxy', 307 => 'Temporary Redirect', 400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required', 403 => 'Forbidden', 404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable', 407 => 'Proxy Authentication Required', 408 => 'Request Timeout', 409 => 'Conflict', 410 => 'Gone', 411 => 'Length Required', 412 => 'Precondition Failed', 413 => 'Request Entity Too Large', 414 => 'Request-URI Too Long', 415 => 'Unsupported Media Type', 416 => 'Requested Range Not Satisfiable', 417 => 'Expectation Failed', 422 => 'Unprocessable Entity', 426 => 'Upgrade Required', 428 => 'Precondition Required', 429 => 'Too Many Requests', 431 => 'Request Header Fields Too Large', 500 => 'Internal Server Error', 501 => 'Not Implemented', 502 => 'Bad Gateway', 503 => 'Service Unavailable', 504 => 'Gateway Timeout', 505 => 'HTTP Version Not Supported', 511 => 'Network Authentication Required', );

			if (isset($stati[$code])) {
				$text = $stati[$code];
			} else {
				show_error('No status text available. Please check your status code number or supply your own message text.', 500);
			}
		}

		if (strpos(PHP_SAPI, 'cgi') === 0) {
			header('Status: ' . $code . ' ' . $text, TRUE);
			return;
		}

		$server_protocol = (isset($_SERVER['SERVER_PROTOCOL']) && in_array($_SERVER['SERVER_PROTOCOL'], array('HTTP/1.0', 'HTTP/1.1', 'HTTP/2'), TRUE)) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
		header($server_protocol . ' ' . $code . ' ' . $text, TRUE, $code);
	}

}

// --------------------------------------------------------------------

if (!function_exists('_error_handler')) {

	function _error_handler($severity, $message, $filepath, $line) {
		$is_error = (((E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR | E_USER_ERROR) & $severity) === $severity);

		// When an error occurred, set the status header to '500 Internal Server Error'
		// to indicate to the client something went wrong.
		// This can't be done within the $_error->show_php_error method because
		// it is only called when the display_errors flag is set (which isn't usually
		// the case in a production environment) or when errors are ignored because
		// they are above the error_reporting threshold.
		if ($is_error) {
			set_status_header(500);
		}

		// Should we ignore the error? We'll get the current error_reporting
		// level and add its bits with the severity bits to find out.
		if (($severity & error_reporting()) !== $severity) {
			return;
		}

		$_error = new Exceptions;
		$_error -> log_exception($severity, $message, $filepath, $line);

		// Should we display the error?
		if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors'))) {
			$_error -> show_php_error($severity, $message, $filepath, $line);
		}

		// If the error is fatal, the execution of the script should be stopped because
		// errors can't be recovered from. Halting the script conforms with PHP's
		// default error handling. See http://www.php.net/manual/en/errorfunc.constants.php
		if ($is_error) {
			exit(1);
			// EXIT_ERROR
		}
	}

}

// ------------------------------------------------------------------------

if (!function_exists('_exception_handler')) {

	function _exception_handler($exception) {
		$_error = new Exceptions;
		$_error -> log_exception('error', 'Exception: ' . $exception -> getMessage(), $exception -> getFile(), $exception -> getLine());

		is_cli() OR set_status_header(500);
		// Should we display the error?
		if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors'))) {
			$_error -> show_exception($exception);
		}

		exit(1);
		// EXIT_ERROR
	}

}

// ------------------------------------------------------------------------

if (!function_exists('_shutdown_handler')) {

	function _shutdown_handler() {
		$last_error = error_get_last();
		if (isset($last_error) && ($last_error['type'] & (E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING))) {
			_error_handler($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
		}
	}

}

// --------------------------------------------------------------------

if (!function_exists('remove_invisible_characters')) {

	function remove_invisible_characters($str, $url_encoded = TRUE) {
		$non_displayables = array();

		// every control character except newline (dec 10),
		// carriage return (dec 13) and horizontal tab (dec 09)
		if ($url_encoded) {
			$non_displayables[] = '/%0[0-8bcef]/i';
			// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/i';
			// url encoded 16-31
			$non_displayables[] = '/%7f/i';
			// url encoded 127
		}

		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';
		// 00-08, 11, 12, 14-31, 127

		do {
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		} while ($count);

		return $str;
	}

}

// ------------------------------------------------------------------------

if (!function_exists('html_escape')) {

	function html_escape($var, $double_encode = TRUE) {
		if (empty($var)) {
			return $var;
		}

		if (is_array($var)) {
			foreach (array_keys($var) as $key) {
				$var[$key] = html_escape($var[$key], $double_encode);
			}

			return $var;
		}

		return htmlspecialchars($var, ENT_QUOTES, config_item('charset'), $double_encode);
	}

}

// ------------------------------------------------------------------------

if (!function_exists('_stringify_attributes')) {

	function _stringify_attributes($attributes, $js = FALSE) {
		$atts = NULL;

		if (empty($attributes)) {
			return $atts;
		}

		if (is_string($attributes)) {
			return ' ' . $attributes;
		}

		$attributes = (array)$attributes;

		foreach ($attributes as $key => $val) {
			$atts .= ($js) ? $key . '=' . $val . ',' : ' ' . $key . '="' . $val . '"';
		}

		return rtrim($atts, ',');
	}

}

// ------------------------------------------------------------------------

if (!function_exists('function_usable')) {

	function function_usable($function_name) {
		static $_suhosin_func_blacklist;

		if (function_exists($function_name)) {
			if (!isset($_suhosin_func_blacklist)) {
				$_suhosin_func_blacklist = extension_loaded('suhosin') ? explode(',', trim(ini_get('suhosin.executor.func.blacklist'))) : array();
			}

			return !in_array($function_name, $_suhosin_func_blacklist, TRUE);
		}

		return FALSE;
	}

}

/**
 * nv_number_format()
 *
 * @param mixed $number
 * @param integer $decimals
 * @return
 */

if (!nv_function_exists('storehouse_number_format')) {
	function storehouse_number_format($number, $decimals = 0, $number_format_0 = '.', $number_format_1 = ',') {
		$str = number_format($number, $decimals, $number_format_0, $number_format_1);
		return $str;
	}

}

/**
 * nv_get_decimals()
 *
 * @param mixed $currency_convert
 * @return
 */
if (!nv_function_exists('storehouse_get_decimals')) {
	function store_get_decimals($currency_convert) {
		$decimals = 0;
		return $decimals;
	}

}
/**
 * shops_show_cat_list()
 *
 * @param integer $parentid
 * @return
 */
function storehouse_show_cat_list($parentid = 0) {
	global $db, $db_config, $lang_module, $lang_global, $module_name, $module_data, $op, $array_viewcat_full, $array_viewcat_nosub, $global_config, $module_file, $client_info;

	$xtpl = new XTemplate('cat_lists.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
	$xtpl -> assign('LANG', $lang_module);
	$xtpl -> assign('GLANG', $lang_global);
	$xtpl -> assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
	$xtpl -> assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
	$xtpl -> assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
	$xtpl -> assign('MODULE_NAME', $module_name);
	$xtpl -> assign('OP', $op);

	if ($parentid > 0) {
		$parentid_i = $parentid;
		$array_cat_title = array();
		$a = 0;

		while ($parentid_i > 0) {
			list($catid_i, $parentid_i, $title_i) = $db -> query('SELECT id, parent_id, name FROM ' . $db_config['prefix'] . '_' . $module_data . '_categories WHERE id=' . intval($parentid_i)) -> fetch(3);

			$array_cat_title[] = "<a href=\"" . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=categories&amp;parentid=" . $catid_i . "\"><strong>" . $title_i . "</strong></a>";

			++$a;
		}

		for ($i = $a - 1; $i >= 0; $i--) {
			$xtpl -> assign('CAT_NAV', $array_cat_title[$i] . ($i > 0 ? " &raquo; " : ""));
			$xtpl -> parse('main.catnav.loop');
		}

		$xtpl -> parse('main.catnav');
	}

	$sql = 'SELECT id, parent_id, name, weight FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_categories WHERE parent_id=' . $parentid . ' ORDER BY weight ASC';
	$result = $db -> query($sql);
	$num = $result -> rowCount();

	if ($num > 0) {
		$a = 0;
		$array_inhome = array($lang_global['no'], $lang_global['yes']);

		while (list($catid, $parentid, $title, $weight) = $result -> fetch(3)) {

			$xtpl -> assign('ROW', array('catid' => $catid, 'cat_link' => NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=categories&amp;parentid=' . $catid, 'title' => $title, 'cat_link_delete' => NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=categories&amp;delete_id=' . $catid . '&amp;delete_checkss=' . md5($catid . NV_CACHE_PREFIX . $client_info['session_id']), 'parentid' => $parentid));

			for ($i = 1; $i <= $num; $i++) {
				$xtpl -> assign('WEIGHT', array('key' => $i, 'title' => $i, 'selected' => $i == $weight ? ' selected=\'selected\'' : ''));
				$xtpl -> parse('main.data.loop.weight');
			}

			$xtpl -> parse('main.data.loop');
			++$a;
		}

		$xtpl -> parse('main.data');
	}

	$result -> closeCursor();
	unset($sql, $result);

	$xtpl -> parse('main');
	return $xtpl -> text('main');
}

function storehouse_show_secondcat_list($parentid = 0) {
	global $db, $db_config, $lang_module, $lang_global, $module_name, $module_data, $op, $array_viewcat_full, $array_viewcat_nosub, $global_config, $module_file, $client_info;

	$xtpl = new XTemplate('secondcat_lists.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
	$xtpl -> assign('LANG', $lang_module);
	$xtpl -> assign('GLANG', $lang_global);
	$xtpl -> assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
	$xtpl -> assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
	$xtpl -> assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
	$xtpl -> assign('MODULE_NAME', $module_name);
	$xtpl -> assign('OP', $op);

	if ($parentid > 0) {
		$parentid_i = $parentid;
		$array_cat_title = array();
		$a = 0;

		while ($parentid_i > 0) {
			list($catid_i, $parentid_i, $title_i) = $db -> query('SELECT id, parent_id, name FROM ' . $db_config['prefix'] . '_' . $module_data . '_subcategories WHERE id=' . intval($parentid_i)) -> fetch(3);

			$array_cat_title[] = "<a href=\"" . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=subcategories&amp;parentid=" . $catid_i . "\"><strong>" . $title_i . "</strong></a>";

			++$a;
		}

		for ($i = $a - 1; $i >= 0; $i--) {
			$xtpl -> assign('CAT_NAV', $array_cat_title[$i] . ($i > 0 ? " &raquo; " : ""));
			$xtpl -> parse('main.catnav.loop');
		}

		$xtpl -> parse('main.catnav');
	}

	$sql = 'SELECT id, parent_id, name, weight FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_' . $module_data . '_subcategories WHERE parent_id=' . $parentid . ' ORDER BY weight ASC';
	$result = $db -> query($sql);
	$num = $result -> rowCount();

	if ($num > 0) {
		$a = 0;
		$array_inhome = array($lang_global['no'], $lang_global['yes']);

		while (list($catid, $parentid, $title, $weight) = $result -> fetch(3)) {

			$xtpl -> assign('ROW', array('catid' => $catid, 'cat_link' => NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=subcategories&amp;parentid=' . $catid, 'title' => $title, 'cat_link_delete' => NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=subcategories&amp;delete_id=' . $catid . '&amp;delete_checkss=' . md5($catid . NV_CACHE_PREFIX . $client_info['session_id']), 'parentid' => $parentid));

			for ($i = 1; $i <= $num; $i++) {
				$xtpl -> assign('WEIGHT', array('key' => $i, 'title' => $i, 'selected' => $i == $weight ? ' selected=\'selected\'' : ''));
				$xtpl -> parse('main.data.loop.weight');
			}

			$xtpl -> parse('main.data.loop');
			++$a;
		}

		$xtpl -> parse('main.data');
	}

	$result -> closeCursor();
	unset($sql, $result);

	$xtpl -> parse('main');
	return $xtpl -> text('main');
}

/**
 * storehouse_fix_cat_order()
 *
 * @param integer $parentid
 * @param integer $order
 * @param integer $lev
 * @return
 */
function storehouse_fix_cat_order($parentid = 0, $order = 0, $lev = 0) {
	global $db, $db_config, $module_data;

	$sql = 'SELECT id, parent_id FROM ' . $db_config['prefix'] . '_' . $module_data . '_categories WHERE parent_id=' . $parentid . ' ORDER BY weight ASC';
	$result = $db -> query($sql);
	$array_cat_order = array();
	while ($row = $result -> fetch()) {
		$array_cat_order[] = $row['id'];
	}
	$result -> closeCursor();
	$weight = 0;

	if ($parentid > 0) {
		++$lev;
	} else {
		$lev = 0;
	}

	foreach ($array_cat_order as $catid_i) {
		++$order;
		++$weight;
		$sql = 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_categories SET weight=' . $weight . ', sort=' . $order . ', lev=' . $lev . ' WHERE id=' . $catid_i;
		$db -> query($sql);
		$order = storehouse_fix_cat_order($catid_i, $order, $lev);
	}

	if ($parentid > 0) {

		$sql = 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_categories SET ';
		if (!empty($array_cat_order)) {
			$sql .= " subcatid=''";
		} else {
			$sql .= " subcatid='" . implode(",", $array_cat_order) . "'";
		}
		$sql .= ' WHERE id=' . $parentid;
		$db -> query($sql);
	}
	return $order;
}

function storehouse_fix_subcat_order($parentid = 0, $order = 0, $lev = 0) {
	global $db, $db_config, $module_data;

	$sql = 'SELECT id, parent_id FROM ' . $db_config['prefix'] . '_' . $module_data . '_subcategories WHERE parent_id=' . $parentid . ' ORDER BY weight ASC';
	$result = $db -> query($sql);
	$array_cat_order = array();
	while ($row = $result -> fetch()) {
		$array_cat_order[] = $row['id'];
	}
	$result -> closeCursor();
	$weight = 0;

	if ($parentid > 0) {
		++$lev;
	} else {
		$lev = 0;
	}

	foreach ($array_cat_order as $catid_i) {
		++$order;
		++$weight;
		$sql = 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_subcategories SET weight=' . $weight . ', sort=' . $order . ', lev=' . $lev . ' WHERE id=' . $catid_i;
		$db -> query($sql);
		$order = storehouse_fix_subcat_order($catid_i, $order, $lev);
	}

	if ($parentid > 0) {

		$sql = 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_subcategories SET ';
		if (!empty($array_cat_order)) {
			$sql .= " subcatid=''";
		} else {
			$sql .= " subcatid='" . implode(",", $array_cat_order) . "'";
		}
		$sql .= ' WHERE id=' . $parentid;
		$db -> query($sql);
	}
	return $order;
}

$info_module = array('mod_data' => 'storehouse', 'mod_data_sales' => $module_data, 'mod_upload' => 'storehouse', 'mod_name' => 'storehouse', 'mod_file' => 'storehouse', 'mod_lang' => $lang_module, 'lang_data' => NV_LANG_DATA, );
$CFG = &load_class('Config', 'NukeViet\\StoreHouse');
$RTR = &load_class('Router', 'NukeViet\\StoreHouse');
$class = ucfirst($RTR -> class);
$method = $RTR -> method;

if (!class_exists('Controller', TRUE)) {
	require_once BASEPATH . '/Controller.php';
}

function & get_instance() {
	global $info_module;
	return Controller::get_instance($info_module);
}

function days_in_month($month = 0, $year = '') {
	if ($month < 1 OR $month > 12) {
		return 0;
	} elseif (!is_numeric($year) OR strlen($year) !== 4) {
		$year = date('Y');
	}

	if (defined('CAL_GREGORIAN')) {
		return cal_days_in_month(CAL_GREGORIAN, $month, $year);
	}

	if ($year >= 1970) {
		return (int) date('t', mktime(12, 0, 0, $month, 1, $year));
	}

	if ($month == 2) {
		if ($year % 400 === 0 OR ($year % 4 === 0 && $year % 100 !== 0)) {
			return 29;
		}
	}

	$days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	return $days_in_month[$month - 1];
}
