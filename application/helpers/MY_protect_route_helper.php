<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

function is_logued_route() {
    $ci =& get_instance();

    if (!$ci->session->has_userdata('email')) {
        $ci->load->view('templates/header');
        $ci->load->view('pages/unauthorized');
        $ci->load->view('templates/footer');

        return FALSE;
    } else {
        return TRUE;
    }
}