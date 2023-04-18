<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

include APPPATH . '../vendor/autoload.php';

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->helper('file');
        $this->load->helper('MY_protect_route');
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

            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            );

            $this->form_validation->set_data($data);            
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
                $this->user_model->set_user($data);
                redirect(docker_url() . '/users');
            }
        }    
    }


    function download($format = 'pdf') {
        if (is_logued_route()) {
            try {
                $jasper = new JasperPHP\JasperPHP;
                
                // Descomentar cuando no exista el archivo .jasper
                // Solo se ejecuta una vez                
                //$file = APPPATH . 'reports/UsersList.jrxml';
                // $jasper->compile($file)
                //     ->execute();                
                // Fin del comentario
                
                $source = APPPATH . "reports/UsersList.jasper";                

                $download_filename = rand(1, 10000);
                $target = APPPATH . "tmp/$download_filename";
                $download_filename .= ".$format";
               
                $res = $jasper->process(
                    $source,
                    $target,
                    [$format],
                    [],
                    [
                        'driver' => 'mysql',
                        'username' => $this->db->username,
                        'password' => $this->db->password,
                        'host' => $this->db->hostname,
                        'database' => $this->db->database,
                        'port' => $this->db->port === NULL ? '3306' : $this->db->port,
                    ]
                )->execute();

                $source = "$target.$format";
        
                $data = read_file($source);
                if ($data) {
                    force_download($download_filename, $data);

                    unlink($download_filename);
                } else {
                    throw new \Exception("No se encontro archivo '$download_filename'.");
                }        
                
            } catch (\Throwable $th) {
                // Informe del error
                echo $th;
            }
        } // Falta error 404
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