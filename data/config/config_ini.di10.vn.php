<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

$sys_info['disable_classes'] = [];
$sys_info['disable_functions'] = ['exec', 'system', 'passthru', 'shell_exec', 'proc_close', 'proc_open', 'dl', 'popen', 'show_source', 'posix_kill', 'posix_mkfifo', 'posix_getpwuid', 'posix_setpgid', 'posix_setsid', 'posix_setuid', 'posix_setgid', 'posix_seteuid', 'posix_setegid', 'posix_uname'];
$sys_info['ini_set_support'] = true;
$sys_info['supports_rewrite'] = 'rewrite_mode_apache';
$sys_info['zlib_support'] = true;
$sys_info['mb_support'] = true;
$sys_info['iconv_support'] = true;
$sys_info['allowed_set_time_limit'] = true;
$sys_info['os'] = 'LINUX';
$sys_info['fileuploads_support'] = true;
$sys_info['curl_support'] = true;
$sys_info['ftp_support'] = true;
$sys_info['string_handler'] = 'mb';
$sys_info['support_cache'] = [];
$sys_info['php_compress_methods'] = ['deflate' => 'gzdeflate', 'gzip' => 'gzencode', 'x-gzip' => 'gzencode', 'compress' => 'gzcompress', 'x-compress' => 'gzcompress'];
$sys_info['server_headers'] = [];
$sys_info['http_only'] = true;
$sys_info['https_only'] = false;
$sys_info['ip6_support'] = true;

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '0');
ini_set('session.cookie_httponly', '1');
ini_set('session.gc_maxlifetime', '3600');
ini_set('track_errors', '1');
ini_set('user_agent', 'NV4');

$iniSaveTime = 1633847753;
