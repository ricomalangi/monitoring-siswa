<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends MY_Controller {
  private $role;
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $is_login = $this->session->userdata('is_login');
    $this->role = $this->session->userdata('role');
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
    $data['content'] = $this->notifikasi->join('tb_bk', 'id_bk')->join('tb_siswa', 'id_siswa')->join('tb_walikelas', 'id_walikelas')->select('tb_bk.nama_bk, tb_walikelas.nama_walikelas, tb_siswa.nama_siswa, tb_notifikasi.*')->orderBy('id_notifikasi', 'DESC')->get();
    $data['page'] = 'pages/notifikasi/index';
    if($this->role === 'walikelas'){
      $data['page'] = 'pages/notifikasi/index_walikelas';
      $data['content'] = $this->notifikasi->join('tb_bk', 'id_bk')->join('tb_siswa', 'id_siswa')->select('tb_bk.nama_bk, tb_siswa.nama_siswa, tb_notifikasi.*')->where('tb_notifikasi.id_walikelas', $this->session->userdata('id_walikelas'))->orderBy('id_notifikasi', 'DESC')->get();
    }
    if($this->role === 'siswa'){
      $data['page'] = 'pages/notifikasi/index_siswa';
      $data['content'] = $this->notifikasi->join('tb_bk', 'id_bk')->join('tb_siswa', 'id_siswa')->select('tb_bk.nama_bk, tb_siswa.nama_siswa, tb_notifikasi.*')->where('tb_notifikasi.id_siswa', $this->session->userdata('id_siswa'))->orderBy('id_notifikasi', 'DESC')->get();
    }
    $this->view($data);
  }

  public function create()
  {
    if($this->role !== 'gurubk'){
      $data['page'] = 'layouts/_forbidden';
      return $this->view($data);
    }
    if (!$_POST) {
      $input = (object) $this->notifikasi->getDefaultValues();
    } else {
      $input = (object) $this->input->post(null, true);
      $input->id_bk = $this->session->userdata('id_bk');
      $input->date_created = date('Y-m-d H:i:s');
    }

    if (!empty($_FILES) && $_FILES['surat']['name'] !== '') {
      $namaSurat = url_title($input->id_siswa, '-', true) . '-' . date('YmdHis');
      $upload = $this->notifikasi->uploadSurat('surat', $namaSurat);
      if ($upload) {
        $input->surat = $upload['file_name'];
      } else {
        redirect(base_url('notifikasi/create'));
      }
    }

    if (!$this->notifikasi->validate()) {
      $data['title'] = 'Tambah notifikasi';
      $data['addon_css'] = base_url('assets/vendor/select2/css/select2.min.css');
      $data['addon_js'] = base_url('assets/vendor/select2/js/select2.full.min.js');
      $data['input'] = $input;
      $data['siswa'] = $this->siswa->select('id_siswa,nama_siswa')->get();
      $data['walikelas'] = $this->walikelas->select('id_walikelas,nama_walikelas')->get();
      $data['form_action'] = base_url('notifikasi/create');
      $data['page'] = 'pages/notifikasi/form';
      $this->view($data);
      return;
    }
    
    if ($this->notifikasi->create($input)) {
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
    }
    redirect(base_url('notifikasi'));
  }

  public function edit($id)
  {
    if($this->role !== 'gurubk'){
      $data['page'] = 'layouts/_forbidden';
      return $this->view($data);
    }
    $addRules = [
      [
        'field' => 'kategori_notifikasi',
        'label' => 'Kategori notifikasi',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'poin_notifikasi',
        'label' => 'Poin notifikasi',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'status',
        'label' => 'Status',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'keterangan',
        'label' => 'Keterangan',
        'rules' => 'trim|required'
      ],
    ];
    $data['content'] = $this->notifikasi->where('id_notifikasi', $id)->first();
    if (!$data['content']) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
      redirect(base_url('notifikasi'));
    }
    if (!$_POST) {
      $data['input'] = $data['content'];
    } else {
      $data['input'] = (object) $this->input->post(null, true);
      $data['input']->date_updated = date('Y-m-d H:i:s');
    }

    if (!$this->notifikasi->validate(null, $addRules)) {
      $data['title'] = 'Edit Data';
      $data['form_action'] = base_url("notifikasi/edit/$id");
      $data['page'] = 'pages/notifikasi/form';
      $data['addon_css'] = base_url('assets/vendor/select2/css/select2.min.css');
      $data['addon_js'] = base_url('assets/vendor/select2/js/select2.full.min.js');
      $data['siswa'] = $this->siswa->select('id_siswa,nama_siswa')->get();
      $data['walikelas'] = $this->walikelas->select('id_walikelas,nama_walikelas')->get();
      $data['nama_notifikasi'] = $this->namanotifikasi->select('id_nama_notifikasi,nama_notifikasi')->get();
      $this->view($data);
      return;
    }
    if ($this->notifikasi->where('id_notifikasi', $id)->update($data['input'])) {
      $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('notifikasi'));
  }
}

/* End of file notifikasi_siswa.php */
