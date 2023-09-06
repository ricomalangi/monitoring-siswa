<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
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
    $this->load->model('Gurubk_model', 'gurubk');
    $this->load->model('Siswa_model', 'siswa');
    $this->load->model('Prestasi_model', 'prestasi');
    $this->load->model('Walikelas_model', 'walikelas');
    $this->load->model('Osis_model', 'osis');
    $this->load->model('Pelanggaran_model', 'pelanggaran');
    
  }
  
  public function index(){
    if($this->role != 'admin'){
      $data['page'] = 'layouts/_forbidden';
      return $this->view($data);
    }
    $data['page'] = 'pages/dashboard/index';
    $data['total_siswa'] = $this->gurubk->count();
    $data['total_walikelas'] = $this->walikelas->count();
    $data['total_gurubk'] = $this->gurubk->count();
    $data['total_prestasi_siswa'] = $this->prestasi->count();
    $data['total_petugas_piket'] = $this->osis->count();
    return $this->view($data);
  }

  public function siswa()
  {
    if($this->role != 'siswa'){
      $data['page'] = 'layouts/_forbidden';
      return $this->view($data);
    }
    $data['page'] = 'pages/dashboard/siswa';
    $data['nama_siswa'] = $this->session->userdata('nama_siswa');
    $data['nisn'] = $this->session->userdata('nisn');
    $data['nipd'] = $this->session->userdata('nipd');
    $data['agama'] = $this->session->userdata('agama');
    $data['alamat'] = $this->session->userdata('alamat');
    $data['jenis_kelamin'] = $this->session->userdata('jenis_kelamin');
    $data['tempat_lahir'] = $this->session->userdata('tempat_lahir');
    $data['tanggal_lahir'] = $this->session->userdata('tanggal_lahir');
    $data['total_prestasi_siswa'] = $this->prestasi->where('id_siswa', $this->session->userdata('id_siswa'))->count();
    $data['total_pelanggaran'] = $this->prestasi->where('id_siswa', $this->session->userdata('id_siswa'))->count();
    return $this->view($data);
  }

  public function walikelas()
  {
    if($this->role != 'walikelas'){
      $data['page'] = 'layouts/_forbidden';
      return $this->view($data);
    }
    $data['page'] = 'pages/dashboard/walikelas';
    $data['nama_walikelas'] = $this->session->userdata('nama_walikelas');
    $data['nip'] = $this->session->userdata('nip');
    $data['agama'] = $this->session->userdata('agama');
    $data['alamat'] = $this->session->userdata('alamat');
    $data['jenis_kelamin'] = $this->session->userdata('jenis_kelamin');
    $data['tempat_lahir'] = $this->session->userdata('tempat_lahir');
    $data['tanggal_lahir'] = $this->session->userdata('tanggal_lahir');
    $data['total_prestasi_siswa'] = $this->prestasi->where('id_walikelas', $this->session->userdata('id_walikelas'))->count();
    $data['total_pelanggaran_siswa'] = $this->pelanggaran->where('id_walikelas', $this->session->userdata('id_walikelas'))->count();
    return $this->view($data);
  }

  public function osis()
  {
    if($this->role != 'osis'){
      $data['page'] = 'layouts/_forbidden';
      return $this->view($data);
    }
    $data['page'] = 'pages/dashboard/osis';
    $data['username'] = $this->session->userdata('username');
    $data['total_pelanggaran'] = $this->pelanggaran->where('id_petugas_piket', $this->session->userdata('id_petugas_piket'))->count();
    return $this->view($data);
  }

  public function gurubk()
  {
    if($this->role != 'gurubk'){
      $data['page'] = 'layouts/_forbidden';
      return $this->view($data);
    }
    $data['page'] = 'pages/dashboard/gurubk';
    $data['nama_bk'] = $this->session->userdata('nama_bk');
    $data['nip'] = $this->session->userdata('nip');
    $data['agama'] = $this->session->userdata('agama');
    $data['alamat'] = $this->session->userdata('alamat');
    $data['jenis_kelamin'] = $this->session->userdata('jenis_kelamin');
    $data['tempat_lahir'] = $this->session->userdata('tempat_lahir');
    $data['tanggal_lahir'] = $this->session->userdata('tanggal_lahir');
    $data['total_prestasi_siswa'] = $this->prestasi->where('id_walikelas', $this->session->userdata('id_walikelas'))->count();
    return $this->view($data);
  }
}

/* End of file Cart.php */
