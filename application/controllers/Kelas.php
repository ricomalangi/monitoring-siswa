<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends MY_Controller {
  private $role;
  public function __construct()
  {
    parent::__construct();
    $this->role = $this->session->userdata('role');
    $is_login = $this->session->userdata('is_login');
    if(!$is_login){
      $this->session->set_flashdata('error', 'Login terlebih dahulu');
      redirect(base_url('auth/login'));
      return;
    }
    $this->load->model('Siswa_model', 'siswa');
    $this->load->model('Walikelas_model', 'walikelas');
  }
  
  public function index()
  {
    $data['content'] = $this->kelas->join('tb_siswa', 'id_siswa')->join('tb_kelas', 'id_kelas')->join('tb_walikelas', 'id_walikelas')->orderBy('tb_kelas.id_kelas', 'ASC')->get();
    $data['page'] = 'pages/kelas/index';
    $this->view($data);
  }

  public function create()
  {
    if (!$_POST) {
      $input = (object) $this->kelas->getDefaultValues();
    } else {
      $input = (object) $this->input->post(null, true);
    }

    if (!$this->kelas->validate()) {
      $this->kelas->table = 'tb_kelas';
      $data['title'] = 'Tambah Data';
      $data['addon_css'] = base_url('assets/vendor/select2/css/select2.min.css');
      $data['addon_js'] = base_url('assets/vendor/select2/js/select2.full.min.js');
      $data['input'] = $input;
      $data['siswa'] = $this->siswa->select('id_siswa,nama_siswa')->get();
      $data['nama_kelas'] = $this->kelas->select('id_kelas,nama_kelas')->get();
      $data['nama_walikelas'] = $this->walikelas->select('id_walikelas,nama_walikelas')->get();
      $data['form_action'] = base_url('kelas/create');
      $data['page'] = 'pages/kelas/form';
      $this->kelas->table = 'tb_kelas_siswa';
      $this->view($data);
      return;
    }
    
    if ($this->kelas->create($input)) {
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
    }
    redirect(base_url('kelas'));
  }
  
  public function edit($id)
  {
    $data['content'] = $this->kelas->where('id_kelas_siswa', $id)->first();
    if (!$data['content']) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
      redirect(base_url('kelas'));
    }
    if (!$_POST) {
      $data['input'] = $data['content'];
    } else {
      $data['input'] = (object) $this->input->post(null, true);
    }

    if (!$this->kelas->validate()) {
      $this->kelas->table = 'tb_kelas';
      $data['title'] = 'Edit Data';
      $data['form_action'] = base_url("kelas/edit/$id");
      $data['page'] = 'pages/kelas/form';
      $data['addon_css'] = base_url('assets/vendor/select2/css/select2.min.css');
      $data['addon_js'] = base_url('assets/vendor/select2/js/select2.full.min.js');
      $data['siswa'] = $this->siswa->select('id_siswa,nama_siswa')->get();
      $data['nama_kelas'] = $this->kelas->select('id_kelas,nama_kelas')->get();
      $data['nama_walikelas'] = $this->walikelas->select('id_walikelas,nama_walikelas')->get();
      $this->kelas->table = 'tb_kelas_siswa';
      $this->view($data);
      return;
    }
    if ($this->kelas->where('id_kelas_siswa', $id)->update($data['input'])) {
      $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('kelas'));
  }

  public function delete($id)
  {
    if (!$_POST) {
      redirect(base_url('kelas'));
    }
    $content = $this->kelas->where('id_kelas_siswa', $id)->first();
    if (!$content) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
      redirect(base_url('kelas'));
    }
    if ($this->kelas->where('id_kelas_siswa', $id)->delete()) {
      $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('kelas'));
  }
  public function unique_nama_siswa()
  {
    $siswa = $this->input->post('id_siswa');
    $id = $this->input->post('id_kelas_siswa');
    $kelas = $this->kelas->where('id_siswa', $siswa)->first();
    if ($kelas) {
      if ($id == $kelas->id_kelas_siswa) {
        return true;
      }
      $this->load->library('form_validation');
      $this->form_validation->set_message('unique_nama_siswa', '%s sudah terdaftar kelas');
      return false;
    }
    return true;
  }
}

/* End of file Cart.php */
