<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi_walikelas extends MY_Controller
{
  private $id_walikelas;
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $is_login = $this->session->userdata('is_login');
    if(!$is_login){
      $this->session->set_flashdata('error', 'Login terlebih dahulu');
      redirect(base_url('auth/login'));
      return;
    }
    $this->id_walikelas = $this->session->userdata('id_walikelas');
    $this->load->model('prestasi_model', 'prestasi');
    $this->load->model('siswa_model', 'siswa');
  }


  public function index()
  {
    $data['content'] = $this->prestasi->join('tb_siswa', 'id_siswa')->select("tb_prestasi.*, tb_siswa.nama_siswa")->where("tb_prestasi.id_walikelas", $this->id_walikelas)->get();
    $data['create_url'] = base_url('prestasi_walikelas/create');
    $data['page'] = 'pages/prestasi/walikelas';
    $this->view($data);
  }

  public function create()
  {

    if (!$_POST) {
      $input = (object) $this->prestasi->getDefaultValues();
    } else {
      $input = (object) $this->input->post(null, true);
      $input->id_walikelas = $this->id_walikelas;
    }

    if (!empty($_FILES) && $_FILES['sertifikat']['name'] !== '') {
      $sertiName = url_title($input->jenis_prestasi, '-', true) . '-' . date('YmdHis');
      $upload = $this->prestasi->uploadSertifikat('sertifikat', $sertiName);
      if ($upload) {
        $input->sertifikat = $upload['file_name'];
      } else {
        redirect(base_url('prestasi_walikelas/create'));
      }
    }

    if (!$this->prestasi->validate()) {
      $this->prestasi->table = 'tb_siswa';
      $data['title'] = 'Tambah prestasi';
      $data['addon_css'] = base_url('assets/vendor/select2/css/select2.min.css');
      $data['addon_js'] = base_url('assets/vendor/select2/js/select2.full.min.js');
      $data['input'] = $input;
      $data['siswa'] = $this->prestasi->select('id_siswa,nama_siswa')->get();
      $data['form_action'] = base_url('prestasi_walikelas/create');
      $data['page'] = 'pages/prestasi/form';
      $this->view($data);
      return;
    }
    $this->prestasi->table = 'tb_prestasi';

    if ($this->prestasi->create($input)) {
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
    }
    redirect(base_url('prestasi_walikelas'));
  }

  public function edit($id)
  {
    $data['content'] = $this->prestasi->where('id_prestasi', $id)->first();
    if (!$data['content']) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
      redirect(base_url('prestasi_walikelas'));
    }
    if (!$_POST) {
      $data['input'] = $data['content'];
    } else {
      $data['input'] = (object) $this->input->post(null, true);
    }

    if (!empty($_FILES) && $_FILES['sertifikat']['name'] !== '') {
      $sertiName = url_title($data['input']->jenis_prestasi, '-', true) . '-' . date('YmdHis');
      $upload = $this->prestasi->uploadSertifikat('sertifikat', $sertiName);
      if ($upload) {
        if ($data['content']->sertifikat !== '') {
          $this->prestasi->deleteSertifikat($data['content']->sertifikat);
        }
        $data['input']->sertifikat = $upload['file_name'];
      } else {
        redirect(base_url("prestasi_walikelas/edit/$id"));
      }
    }

    if (!$this->prestasi->validate()) {
      $this->prestasi->table = 'tb_siswa';
      $data['title'] = 'Edit prestasi';
      $data['addon_css'] = base_url('assets/vendor/select2/css/select2.min.css');
      $data['addon_js'] = base_url('assets/vendor/select2/js/select2.full.min.js');
      $data['form_action'] = base_url("prestasi_walikelas/edit/$id");
      $data['siswa'] = $this->prestasi->select('id_siswa,nama_siswa')->get();
      $data['page'] = 'pages/prestasi/form';
      // echo('<pre>');print_r($data);echo('</pre>');die();
      $this->view($data);
      return;
    }

    if ($this->prestasi->where('id_prestasi', $id)->update($data['input'])) {
      $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('prestasi_walikelas'));
  }

  public function delete($id)
  {
    if (!$_POST) {
      redirect(base_url('prestasi_walikelas'));
    }
    $content = $this->prestasi->where('id_bk', $id)->first();
    if (!$content) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
      redirect(base_url('prestasi_walikelas'));
    }

    $this->prestasi->table = 'tb_user';

    if ($this->prestasi->where('id_user', $content->id_user)->delete()) {
      $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('prestasi_walikelas'));
  }
}

/* End of file guru.php */
