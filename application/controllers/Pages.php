<?php

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('user_model');
    }

    public function view($page = 'home') {
        if ( !file_exists(APPPATH.'views/pages/'.$page.'.php')) {
            show_404();    
        };

        $this->load->view('templates/header');
        $this->load->view('pages/'.$page);
        $this->load->view('templates/footer');
    }


    public function login() {
        $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
        $this->form_validation->set_rules('password', 'Contraseña', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('pages/login');
            $this->load->view('templates/footer');

        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->user_model->get_user_by_email($email);
            if ($user->password === $password) {
                $this->session->set_userdata(array(
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                ));
    
                redirect(docker_url() . '/users');
                
            } else {
                // Implementar error de contraseña
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata(['first_name', 'last_name', 'email']);
        redirect(docker_url());

    }
}