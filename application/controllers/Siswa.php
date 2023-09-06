<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends MY_Controller
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
  }

  public function index()
  {
    $data['content'] = $this->siswa->get();
    $data['page'] = 'pages/siswa/index';
    $this->view($data);
  }

  public function create()
  {
    $addRules = [
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'trim|required'
    ];

    if (!$_POST) {
      $input = (object) $this->siswa->getDefaultValues();
    } else {
      $input = (object) $this->input->post(null, true);
      $input->nama_siswa = strtoupper($input->nama_siswa);
      $input->tempat_lahir = strtoupper($input->tempat_lahir);
      $input->alamat = strtoupper($input->alamat);
      $input->password = hashEncrypt($input->password);
    }

    if (!$this->siswa->validate($addRules)) {
      $data['title'] = 'Tambah Data';
      $data['input'] = $input;
      $data['form_action'] = base_url('siswa/create');
      $data['page'] = 'pages/siswa/form';
      $this->view($data);
      return;
    }

    if ($this->siswa->create($input)) {
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
    }
    redirect(base_url('siswa'));
  }

  public function edit($id)
  {
    $data['content'] = $this->siswa->where('id_siswa', $id)->first();
    if (!$data['content']) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
      redirect(base_url('siswa'));
    }
    if (!$_POST) {
      $data['input'] = $data['content'];
    } else {
      $data['input'] = (object) $this->input->post(null, true);
      $data['input']->nama_siswa = strtoupper($data['input']->nama_siswa);
      $data['input']->tempat_lahir = strtoupper($data['input']->tempat_lahir);
      $data['input']->alamat = strtoupper($data['input']->alamat);
      if ($data['input']->password !== '') {
        $data['input']->password = hashEncrypt($data['input']->password);
      } else {
        $data['input']->password = $data['content']->password;
      }
    }

    if (!$this->siswa->validate()) {
      $data['title'] = 'Edit Data';
      $data['form_action'] = base_url("siswa/edit/$id");
      $data['page'] = 'pages/siswa/form';
      $this->view($data);
      return;
    }
    if ($this->siswa->where('id_siswa', $id)->update($data['input'])) {
      $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('siswa'));
  }

  public function delete($id)
  {
    if (!$_POST) {
      redirect(base_url('siswa'));
    }
    $content = $this->siswa->where('id_siswa', $id)->first();
    if (!$content) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
      redirect(base_url('siswa'));
    }
    if ($this->siswa->where('id_siswa', $id)->delete()) {
      $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('siswa'));
  }

  public function unique_nisn()
  {
    $nisn = $this->input->post('nisn');
    $id = $this->input->post('id_siswa');
    $siswa = $this->siswa->where('nisn', $nisn)->first();
    if ($siswa) {
      if ($id == $siswa->id_siswa) {
        return true;
      }
      $this->load->library('form_validation');
      $this->form_validation->set_message('unique_nisn', '%s sudah digunakan!');
      return false;
    }
    return true;
  }

  public function unique_nipd()
  {
    $nipd = $this->input->post('nipd');
    $id = $this->input->post('id_siswa');
    $siswa = $this->siswa->where('nipd', $nipd)->first();
    if ($siswa) {
      if ($id == $siswa->id_siswa) {
        return true;
      }
      $this->load->library('form_validation');
      $this->form_validation->set_message('unique_nipd', '%s sudah digunakan!');
      return false;
    }
    return true;
  }
}

/* End of file Siswa.php */
