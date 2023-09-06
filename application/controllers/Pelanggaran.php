<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggaran extends MY_Controller {
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
    $this->load->model('NamaPelanggaran_model', 'namapelanggaran');
    $this->load->model('Walikelas_model', 'walikelas');
  }
  
  public function index()
  {
    $data['content'] = $this->pelanggaran->join('tb_nama_pelanggaran', 'id_nama_pelanggaran')->join('tb_siswa', 'id_siswa')->join('tb_walikelas', 'id_walikelas')->join('tb_petugas_piket', 'id_petugas_piket')->select('tb_nama_pelanggaran.nama_pelanggaran, tb_walikelas.nama_walikelas, tb_siswa.nama_siswa, tb_pelanggaran.*, tb_petugas_piket.nama_petugas')->get();
    $data['page'] = 'pages/pelanggaran/index';
    if($this->role === 'walikelas'){
      $data['content'] = $this->pelanggaran->join('tb_nama_pelanggaran', 'id_nama_pelanggaran')->join('tb_siswa', 'id_siswa')->join('tb_walikelas', 'id_walikelas')->join('tb_petugas_piket', 'id_petugas_piket')->select('tb_nama_pelanggaran.nama_pelanggaran, tb_walikelas.nama_walikelas, tb_siswa.nama_siswa, tb_pelanggaran.*, tb_petugas_piket.nama_petugas')->where('tb_pelanggaran.status', 'approve')->get();
    }
    //echo('<pre>');print_r($this->role);echo('</pre>');die();
    $this->view($data);
  }

  public function create()
  {

    if (!$_POST) {
      $input = (object) $this->pelanggaran->getDefaultValues();
    } else {
      $input = (object) $this->input->post(null, true);
      $input->id_petugas_piket = $this->session->userdata('id_petugas_piket');
      $input->status = 'waiting';
      $input->date_created = date('Y-m-d H:i:s');
    }

    if (!$this->pelanggaran->validate()) {
      $data['title'] = 'Tambah Pelanggaran';
      $data['addon_css'] = base_url('assets/vendor/select2/css/select2.min.css');
      $data['addon_js'] = base_url('assets/vendor/select2/js/select2.full.min.js');
      $data['input'] = $input;
      $data['siswa'] = $this->siswa->select('id_siswa,nama_siswa')->get();
      $data['nama_pelanggaran'] = $this->namapelanggaran->select('id_nama_pelanggaran,nama_pelanggaran')->get();
      $data['form_action'] = base_url('pelanggaran/create');
      $data['page'] = 'pages/pelanggaran/form';
      $this->view($data);
      return;
    }
    
    if ($this->pelanggaran->create($input)) {
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
    }
    redirect(base_url('pelanggaran'));
  }

  public function edit($id)
  {
    $addRules = [
      [
        'field' => 'kategori_pelanggaran',
        'label' => 'Kategori Pelanggaran',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'poin_pelanggaran',
        'label' => 'Poin Pelanggaran',
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
    $data['content'] = $this->pelanggaran->where('id_pelanggaran', $id)->first();
    if (!$data['content']) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
      redirect(base_url('pelanggaran'));
    }
    if (!$_POST) {
      $data['input'] = $data['content'];
    } else {
      $data['input'] = (object) $this->input->post(null, true);
      $data['input']->date_updated = date('Y-m-d H:i:s');
    }

    if (!$this->pelanggaran->validate(null, $addRules)) {
      $data['title'] = 'Edit Data';
      $data['form_action'] = base_url("pelanggaran/edit/$id");
      $data['page'] = 'pages/pelanggaran/form';
      $data['addon_css'] = base_url('assets/vendor/select2/css/select2.min.css');
      $data['addon_js'] = base_url('assets/vendor/select2/js/select2.full.min.js');
      $data['siswa'] = $this->siswa->select('id_siswa,nama_siswa')->get();
      $data['walikelas'] = $this->walikelas->select('id_walikelas,nama_walikelas')->get();
      $data['nama_pelanggaran'] = $this->namapelanggaran->select('id_nama_pelanggaran,nama_pelanggaran')->get();
      $this->view($data);
      return;
    }
    if ($this->pelanggaran->where('id_pelanggaran', $id)->update($data['input'])) {
      $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('pelanggaran'));
  }
}

/* End of file Pelanggaran_siswa.php */
