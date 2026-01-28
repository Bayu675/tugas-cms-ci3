<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Artikel_model');
        
        if(!$this->session->userdata('is_login')){
            redirect('login'); 
        }
    }

    public function index() {
        $data['artikel'] = $this->Artikel_model->get_semua();
        $this->load->view('admin/dashboard', $data);
    }

    public function tambah() {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/tambah_artikel');
        } else {
            $data = [
                'judul' => $this->input->post('judul'),
                'slug'  => url_title($this->input->post('judul'), 'dash', TRUE),
                'konten'=> $this->input->post('konten')
            ];
            $this->Artikel_model->simpan($data);
            redirect('admin');
        }
    }

    public function edit($id) {
        $data['artikel'] = $this->Artikel_model->get_by_id($id);
        
        if (empty($data['artikel'])) show_404();

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/edit_artikel', $data);
        } else {
            $update_data = [
                'judul' => $this->input->post('judul'),
                'konten'=> $this->input->post('konten')
            ];
            $this->Artikel_model->update($id, $update_data);
            redirect('admin');
        }
    }

    public function hapus($id) {
        $this->Artikel_model->hapus($id);
        redirect('admin');
    }
}