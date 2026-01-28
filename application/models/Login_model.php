<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function login($email, $pass){
        $this->db->where('username', $email);
        $query = $this->db->get('user');
        $user = $query->row_array(); 

        if($user){
            if(md5($pass) === $user['password']){
                return $user;
            }
        }
        return FALSE;
    }
}