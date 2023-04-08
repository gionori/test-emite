<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 


function docker_url() {
    if (ENVIRONMENT !== 'production') {
        return "http://localhost/index.php";
    }
    
    $ci =& get_instance();
    $ci->load->helper('url');
    return base_url();
}