<?php

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function view($page = 'home') {
        if ( !file_exists(APPPATH.'views/pages/'.$page.'.php')) {
            show_404();    
        };

        $this->load->view('templates/header');
        $this->load->view('pages/'.$page);
        $this->load->view('templates/footer');
    }
}