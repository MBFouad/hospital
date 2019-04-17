<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists('MX_Loader', false)) {
    require APPPATH.'third_party/MX/Loader.php';
}
class MY_Loader extends MX_Loader {

    public function __construct() {

        parent::__construct();
    }

}
