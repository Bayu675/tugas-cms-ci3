<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Musik_model');
        
        if(!$this->session->userdata('is_login')){
            redirect('login'); 
        }
    }

    public function index() {
        $this->load->library('pagination');

        $config['base_url'] = base_url('index.php/admin/index');
        $config['total_rows'] = $this->Musik_model->count_all_data();
        $config['per_page'] = 6;
        
        $config['full_tag_open']    = '<nav><ul class="pagination justify-content-center mt-5">';
        $config['full_tag_close']   = '</ul></nav>';
        
        $config['first_link']       = 'First';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        
        $config['last_link']        = 'Last';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        
        $config['next_link']        = '&raquo;';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        
        $config['prev_link']        = '&laquo;';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        
        $config['attributes']       = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $start = $this->uri->segment(3);
        $data['musik'] = $this->Musik_model->get_data_pagination($config['per_page'], $start);
        
        $this->load->view('admin/dashboard', $data);
    }

    public function tambah() {
        $this->form_validation->set_rules('judul', 'Judul Lagu', 'required');
        $this->form_validation->set_rules('penyanyi', 'Penyanyi', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/tambah_musik');
        } else {
            $config['upload_path']   = './assets/uploads/'; 
            $config['encrypt_name']  = TRUE;

            $config['allowed_types'] = 'mp3|wav|m4a|mpeg|mpg';
            $config['max_size']      = 10240;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file_mp3')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Upload Lagu Gagal: ' . $error);
                $this->load->view('admin/tambah_musik');
            } else {
                $mp3_data = $this->upload->data();
                $nama_mp3 = $mp3_data['file_name'];
                $nama_cover = 'default.jpg';

                if (!empty($_FILES['cover_image']['name'])) {
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size']      = 2048; 
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('cover_image')) {
                        $img_data = $this->upload->data();
                        $nama_cover = $img_data['file_name'];
                    }
                }

                $data = [
                    'judul'     => $this->input->post('judul'),
                    'penyanyi'  => $this->input->post('penyanyi'),
                    'genre'     => $this->input->post('genre'),
                    'file_name' => $nama_mp3,
                    'cover_image' => $nama_cover,
                    'uploader'  => $this->session->userdata('nama')
                ];

                $this->Musik_model->simpan($data);
                $this->session->set_flashdata('success', 'Lagu berhasil diupload!');
                redirect('admin');
            }
        }
    }

    public function hapus($id) {
        $lagu = $this->Musik_model->get_by_id($id);

        if($lagu) {
            $path_mp3 = './assets/uploads/' . $lagu['file_name'];
            if(file_exists($path_mp3)) unlink($path_mp3);

            if($lagu['cover_image'] != 'default.jpg'){
                $path_cover = './assets/uploads/' . $lagu['cover_image'];
                if(file_exists($path_cover)) unlink($path_cover);
            }

            $this->Musik_model->hapus($id);
            $this->session->set_flashdata('success', 'Lagu berhasil dihapus!');
        }
        redirect('admin');
    }
}