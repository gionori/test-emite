<?php
class User_model extends CI_Model {

    private $table = 'users';

    public function __construct() {
        $this->load->database();
        $this->load->helper('xml');
        //$this->load->library('encrypt');

    }


    public function get_users($count = 10, $page_number = 0, $keywords = '') {
        $count = intval($count);
        $count = $count < 1 ? 10 : $count;

        $page_number = intval($page_number);
        $page_number = $page_number < 0 ? 0 : $page_number;
        $offset = $page_number * $count;

        $this->db->select('id, first_name, last_name, email');
        $this->db->like('first_name', $keywords);
        $this->db->or_like('last_name', $keywords);
        $this->db->or_like('email', $keywords);
        $query = $this->db->get($this->table, $count, $offset);

        return array(
            'data' => $query->result(),
            'count' => $this->db->count_all_results($this->table),
            'page_size' => $count,
            'page_number' => $page_number,
            'keywords' => $keywords
        );
    }


    public function get_user($id) {
        $id = intval($id);

        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->result()[0];
    }


    public function get_user_by_email($email) {
        $query = $this->db->get_where($this->table, array('email' => $email));
        return $query->result()[0];
    }


    public function set_user() {        
        $password = $this->input->post('password');

        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => $password,
        );

        return $this->db->insert($this->table, $data);
    }


}