<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . '../vendor/autoload.php';

use ReallySimpleJWT\Token;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class Users extends REST_Controller {

    private $secret = 'sec!ReT423*&';
    private $expiration;
    private $issuer = 'localhost'; 
    private $key_name;

    public function __construct() {
        parent::__construct();

        $this->expiration = time() + 3600;
        $this->key_name = $this->config->item('rest_key_name');

        $this->load->model('user_model');

        $this->load->library('form_validation');

        $this->load->helper('form');
    }


    public function index_get() {
        $token = $this->_args[$this->key_name];
        if (Token::validate($token, $this->secret)) {
            $data = $this->user_model->get_users();
            return $this->response($data, REST_Controller::HTTP_OK);
        }

        $this->response([
            'ok' => FALSE,
            'message' => 'El token de acceso es incorrecto o la sesion ha expirado'
        ], REST_Controller::HTTP_UNAUTHORIZED);
    }


    public function register_post() {    
        $this->form_validation->set_rules('first_name', 'Nombre (s)', 'required');
        $this->form_validation->set_rules('last_name', 'Apellidos', 'required');
        $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
        $this->form_validation->set_rules('password', 'Contraseña', 'required');

        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        ];            
        
        $this->form_validation->set_data($data);
        
        if ($this->form_validation->run()) {

            try {
                $this->user_model->set_user($data);
                
                $this->response([
                    'ok' => TRUE,
                ], REST_Controller::HTTP_OK);

            } catch (\Throwable $th) {
                $this->response([
                    'ok' => FALSE,
                    'message' => $th->getMessage()
                ], REST_Controller::HTTP_BAD_REQUEST);
            }

        } else {
            $this->response([
                'ok' => FALSE,
                'message' => 'Los datos de registro son incorrectos'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function login_post() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        try {            
            $user = $this->user_model->get_user_by_email($email);    

            if ($user === NULL)  {
                return $this->response([
                    'ok' => FALSE,
                    'message' => 'email/password incorrectos'
                ], REST_Controller::HTTP_UNAUTHORIZED);
            }

            if ($password !== $user->password) {
                return $this->response([
                    'ok' => FALSE,
                    'message' => 'email/password incorrectos'
                ], REST_Controller::HTTP_UNAUTHORIZED);
            }

            $user->password = NULL;
            
            $this->response([
                'ok' => TRUE,
                'user' => $user,
                'token' => Token::create($user, $this->secret, $this->expiration, $this->expiration),
            ], REST_Controller::HTTP_OK);

        } catch (\Throwable $th) {            
            $this->response([
                'ok' => FALSE,
                'errors' => $th,
                'message' => $th->message
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

    }

}
        