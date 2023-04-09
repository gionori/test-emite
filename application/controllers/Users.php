<?php

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('MY_protect_route');
        $this->load->helper('download');
    }


    public function index() {
        $this->view();
    }

    
    public function view($count = 10, $page_number = 0) {
        if (is_logued_route()) {
            $keywords = $this->input->post('keywords');
            
            $data['result'] = $this->user_model->get_users($count, $page_number, $keywords);            
            $data['base_url'] = docker_url() . '/users/view';
            $data['keywords'] = $keywords;
            
            $this->load->view('templates/header');
            $this->load->view('pages/users', $data);
            $this->load->view('templates/paginator', $data);
            $this->load->view('templates/footer');
        }
    }


    public function create() {    
        if (is_logued_route()) {
            $this->form_validation->set_rules('first_name', 'Nombre (s)', 'required');
            $this->form_validation->set_rules('last_name', 'Apellidos', 'required');
            $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
            $this->form_validation->set_rules('password', 'Contraseña', 'required');
            
            if ($this->form_validation->run() === FALSE) {
                $data['title'] = 'Nuevo usuario';
                $data ['breadcrumb'] = array(
                    array('label' => 'Usuarios', 'path' => docker_url().'/users', 'is_active' => FALSE),
                    array('label' => $data['title'], 'path' => docker_url().'/users/create', 'is_active' => TRUE),
                );
    
                $this->load->view('templates/header');
                $this->load->view('templates/breadcrumb', $data);
                $this->load->view('pages/form_user', $data);
                $this->load->view('templates/footer');
            } else {
                $this->user_model->set_user();
                redirect(docker_url() . '/users');
            }
        }    
    }

    function xml($id) {
        $user = $this->user_model->get_user($id);

        $xml = '<user>';
        $xml .=     '<id type="string">' . $user->id . '</id>';
        $xml .=     '<first_name type="string">' . $user->first_name . '</first_name>';
        $xml .=     '<last_name type="string">' . $user->last_name . '</last_name>';
        $xml .=     '<email type="string">' . $user->email . '</email>';
        $xml .= '</user>';

        force_download('user.xml', $xml);
    }

}