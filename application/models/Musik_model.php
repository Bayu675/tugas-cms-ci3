<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Musik_model extends CI_Model {
    
    public function get_data_pagination($limit, $start) {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('musik', $limit, $start)->result_array();
    }

    public function count_all_data() {
        return $this->db->count_all_results('musik');
    }

    public function simpan($data) {
        return $this->db->insert('musik', $data);
    }

    public function get_by_id($id) {
        return $this->db->get_where('musik', ['id' => $id])->row_array();
    }

    public function hapus($id) {
        $this->db->where('id', $id);
        return $this->db->delete('musik');
    }
}