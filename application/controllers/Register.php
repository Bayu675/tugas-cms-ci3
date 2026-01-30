<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
    }

    public function index(){
        if ($this->session->userdata('is_login')) { redirect('admin'); }
        $this->load->view('register');
    }

    public function proses(){
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

        if($this->form_validation->run() == FALSE){
            $this->load->view('register');
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('email'), 
                'password' => md5($this->input->post('password'))
            ];
            
            $this->db->insert('user', $data);
            $this->session->set_flashdata('success', 'Pendaftaran berhasil! Silakan login.');
            redirect('login');
        }
    }
}