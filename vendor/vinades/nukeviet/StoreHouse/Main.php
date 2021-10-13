<?php 
namespace NukeViet\StoreHouse;
class Main extends MY_Shop_Controller
{

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->page_construct('index', $this->data);
    }

    function profile($act = NULL) {
        return '';
    }

    function login($m = NULL) {
         return '';
    }

    function logout($m = NULL) {
         return '';
    }

    function register() {

         return '';
    }

    function activate($id, $code) {
         return '';
    }

    function forgot_password() {
         return '';
    }

    function reset_password($code = NULL) {
         return '';
    }

    function captcha_check($cap) {
         return '';
    }

    function hide($id = NULL) {
        return '';
    }

    function language($lang) {
         return '';
    }

    function currency($currency) {
         return '';
    }

    function cookie($val) {
         return '';
    }

}
