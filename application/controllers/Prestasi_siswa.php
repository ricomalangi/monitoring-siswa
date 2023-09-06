<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi_siswa extends MY_Controller
{

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
    $this->load->model('prestasi_model', 'prestasi');
  }


  public function index()
  {
    $id_siswa = $this->session->userdata('id_siswa');
    $data['content'] = $this->prestasi->where("id_siswa", $id_siswa)->select("jenis_prestasi, keterangan_prestasi, sertifikat")->get();
    $data['page'] = 'pages/prestasi/siswa';
    $this->view($data);
  }
}

/* End of file guru.php */
