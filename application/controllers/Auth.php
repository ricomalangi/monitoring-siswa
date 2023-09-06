<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
 
    $this->load->model('Gurubk_model', 'gurubk');
    $this->load->model('Siswa_model', 'siswa');
    $this->load->model('Walikelas_model', 'walikelas');
    $this->load->model('Osis_model', 'osis');
    $this->load->model('Admin_model', 'admin');
  }

  public function login()
  {
    $is_login = $this->session->userdata('is_login');
    if($is_login){
      redirect(base_url('dashboard'));
    }
    $data['title'] = 'login';
    $data['form_action'] = base_url("auth/check");
    $this->load->view('pages/auth/login', $data);
  }

  public function check()
  {
    $is_login = $this->session->userdata('is_login');
    if($is_login){
      redirect(base_url('dashboard'));
    }
    $akun = $this->input->post('akun');
    $password = $this->input->post('password');

    // check admin
    $data['admin'] = $this->admin->where('username', $akun)->first();
    if (!empty($data['admin']) && hashEncryptVerify($password, $data['admin']->password)) {
      $sess_data = [
        'id_admin' => $data['admin']->id_admin,
        'username' => $data['admin']->username,
        'role' => 'admin',
        'is_login' => 1
      ];
      $this->session->set_userdata($sess_data);
      redirect(base_url('dashboard'));
    } 

    // check osis
    $data['petugas_piket'] = $this->osis->where('nama_petugas', $akun)->first();
    var_dump($data['petugas_piket']);
    if (!empty($data['petugas_piket']) && hashEncryptVerify($password, $data['petugas_piket']->password)) {
      $sess_data = [
        'id_petugas_piket' => $data['petugas_piket']->id_petugas_piket,
        'username' => $data['petugas_piket']->nama_petugas,
        'role' => 'osis',
        'is_login' => 1
      ];
      $this->session->set_userdata($sess_data);
      redirect(base_url('dashboard/osis'));
    }

    // check Walikelas
    $data['walikelas'] = $this->walikelas->where('nip', $akun)->first();
    if (!empty($data['walikelas']) && hashEncryptVerify($password, $data['walikelas']->password)) {
      $sess_data = [
        'id_walikelas' => $data['walikelas']->id_walikelas,
        'nama_walikelas' => $data['walikelas']->nama_walikelas,
        'nip' => $data['walikelas']->nip,
        'tempat_lahir' => $data['walikelas']->tempat_lahir,
        'tanggal_lahir' => $data['walikelas']->tanggal_lahir,
        'agama' => $data['walikelas']->agama,
        'alamat' => $data['walikelas']->alamat,
        'jenis_kelamin' => $data['walikelas']->jenis_kelamin,
        'role' => 'walikelas',
        'is_login' => 1
      ];
      $this->session->set_userdata($sess_data);
      redirect(base_url('dashboard/walikelas'));
    }

    // check bk
    $data['gurubk'] = $this->gurubk->where('nip', $akun)->first();
    if (!empty($data['gurubk']) && hashEncryptVerify($password, $data['gurubk']->password)) {
      $sess_data = [
        'id_bk' => $data['gurubk']->id_bk,
        'nama_bk' => $data['gurubk']->nama_bk,
        'nip' => $data['gurubk']->nip,
        'role' => 'gurubk',
        'is_login' => 1
      ];
      $this->session->set_userdata($sess_data);
      redirect(base_url('dashboard/gurubk'));
    } 

    // check siswa
    $data['siswa'] = $this->siswa->where('nipd', $akun)->first();
    if (!empty($data['siswa']) && hashEncryptVerify($password, $data['siswa']->password)) {
      $sess_data = [
        'id_siswa' => $data['siswa']->id_siswa,
        'nama_siswa' => $data['siswa']->nama_siswa,
        'nisn' => $data['siswa']->nisn,
        'nipd' => $data['siswa']->nipd,
        'tempat_lahir' => $data['siswa']->tempat_lahir,
        'tanggal_lahir' => $data['siswa']->tanggal_lahir,
        'agama' => $data['siswa']->agama,
        'alamat' => $data['siswa']->alamat,
        'jenis_kelamin' => $data['siswa']->jenis_kelamin,
        'role' => 'siswa',
        'is_login' => 1
      ];
      $this->session->set_userdata($sess_data);
      redirect(base_url('dashboard/siswa'));
    }

    $this->session->set_flashdata('warning', 'Maaf! username/password salah');
    redirect(base_url('auth/login'));
  }

  public function logout()
  {
    $role = $this->session->userdata('role');
    $sess_data = [];
    if($role === 'admin'){
      $sess_data = [
        'id_admin','username','role','is_login'
      ];
    } elseif($role === 'osis'){
      $sess_data = [
        'id_petugas_piket','username','role','is_login'
      ];
    } elseif($role === 'gurubk'){
      $sess_data = [
        'id_bk','nama_bk','nip','role','is_login'
      ];
    } elseif($role === 'walikelas'){
      $sess_data = [
        'id_walikelas','nama_walikelas','nip','role','is_login'
      ];
    } elseif($role === 'siswa'){
      $sess_data = [
        'id_siswa','nama_siswa','nisn','nipd','role','is_login'
      ];
    }
    $this->session->unset_userdata($sess_data);
    $this->session->sess_destroy();
    redirect(base_url('auth/login'));
  }
}

/* End of file Login.php */
