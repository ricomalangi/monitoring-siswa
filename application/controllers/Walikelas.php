<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas extends MY_Controller {
  
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
    $data['content'] = $this->walikelas->get();
    $data['page'] = 'pages/walikelas/index';
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
      $input = (object) $this->walikelas->getDefaultValues();
    } else {
      $input = (object) $this->input->post(null, true);
      $input->nama_walikelas = strtoupper($input->nama_walikelas);
      $input->tempat_lahir = strtoupper($input->tempat_lahir);
      $input->alamat = strtoupper($input->alamat);
      $input->password = hashEncrypt($input->password);
    }

    if (!$this->walikelas->validate($addRules)) {
      $data['title'] = 'Tambah Data';
      $data['input'] = $input;
      $data['form_action'] = base_url('walikelas/create');
      $data['page'] = 'pages/walikelas/form';
      $this->view($data);
      return;
    }
    if ($this->walikelas->create($input)) {
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
    }
    redirect(base_url('walikelas'));
  }

  public function edit($id)
  {
    $data['content'] = $this->walikelas->where('id_walikelas', $id)->first();
    if (!$data['content']) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
      redirect(base_url('walikelas'));
    }
    if (!$_POST) {
      $data['input'] = $data['content'];
    } else {
      $data['input'] = (object) $this->input->post(null, true);
      $data['input']->nama_walikelas = strtoupper($data['input']->nama_walikelas);
      $data['input']->tempat_lahir = strtoupper($data['input']->tempat_lahir);
      $data['input']->alamat = strtoupper($data['input']->alamat);
      if ($data['input']->password !== '') {
        $data['input']->password = hashEncrypt($data['input']->password);
      } else {
        $data['input']->password = $data['content']->password;
      }
    }

    if (!$this->walikelas->validate()) {
      $data['title'] = 'Ubah walikelas';
      $data['form_action'] = base_url("walikelas/edit/$id");
      $data['page'] = 'pages/walikelas/form';
      $this->view($data);
      return;
    }
    if ($this->walikelas->where('id_walikelas', $id)->update($data['input'])) {
      $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('walikelas'));
  }

  public function delete($id)
  {
    if (!$_POST) {
      redirect(base_url('walikelas'));
    }
    $content = $this->walikelas->where('id_walikelas', $id)->first();
    if (!$content) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
      redirect(base_url('walikelas'));
    }
    if ($this->walikelas->where('id_walikelas', $id)->delete()) {
      $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('walikelas'));
  }

  public function unique_nip()
  {
    $nip = $this->input->post('nip');
    $id = $this->input->post('id_walikelas');
    $walikelas = $this->walikelas->where('nip', $nip)->first();
    if ($walikelas) {
      if ($id == $walikelas->id_walikelas) {
        return true;
      }
      $this->load->library('form_validation');
      $this->form_validation->set_message('unique_nip', '%s sudah digunakan!');
      return false;
    }
    return true;
  }

}

/* End of file Walikelas.php */
