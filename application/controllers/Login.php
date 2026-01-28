<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
    }

    public function index()
    {
        if ($this->session->userdata('is_login')) {
            redirect('admin');
        }
        $this->load->view('login');
    }

    public function cek()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if(empty($email) || empty($password)){
            $this->session->set_flashdata('error', 'Email dan Password wajib diisi!');
            redirect('login','refresh');
        } else {
            $user = $this->Login_model->login($email, $password);
            
            if($user){
                $session_data = array(
                    'id'       => $user['id'],
                    'nama'     => $user['nama'],
                    'email'    => $user['username'],
                    'is_login' => TRUE
                );
                $this->session->set_userdata($session_data);
                redirect('admin');
            } else {
                $this->session->set_flashdata('error', 'Email atau Password salah!');
                redirect('login','refresh');
            }
        }
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}