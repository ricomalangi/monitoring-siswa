<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gurubk extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $is_login = $this->session->userdata('is_login');
    if(!$is_login){
      $this->session->set_flashdata('error', 'Login terlebih dahulu');
      redirect(base_url('auth/login'));
      return;
    }
    //Do your magic here
  }


  public function index()
  {
    $data['content'] = $this->gurubk->get();
    $data['page'] = 'pages/gurubk/index';
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
      $input = (object) $this->gurubk->getDefaultValues();
    } else {
      $input = (object) $this->input->post(null, true);
      $input->nama_bk = strtoupper($input->nama_bk);
      $input->tempat_lahir = strtoupper($input->tempat_lahir);
      $input->alamat = strtoupper($input->alamat);
      $input->password = hashEncrypt($input->password);
    }

    if (!$this->gurubk->validate($addRules)) {
      $data['title'] = 'Tambah Data';
      $data['input'] = $input;
      $data['form_action'] = base_url('gurubk/create');
      $data['page'] = 'pages/gurubk/form';
      $this->view($data);
      return;
    }
    if ($this->gurubk->create($input)) {
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
    }
    redirect(base_url('gurubk'));
  }

  public function edit($id)
  {
    $data['content'] = $this->gurubk->where('id_bk', $id)->first();
    if (!$data['content']) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
      redirect(base_url('gurubk'));
    }
    if (!$_POST) {
      $data['input'] = $data['content'];
    } else {
      $data['input'] = (object) $this->input->post(null, true);
      $data['input']->nama_bk = strtoupper($data['input']->nama_bk);
      $data['input']->tempat_lahir = strtoupper($data['input']->tempat_lahir);
      $data['input']->alamat = strtoupper($data['input']->alamat);
      if ($data['input']->password !== '') {
        $data['input']->password = hashEncrypt($data['input']->password);
      } else {
        $data['input']->password = $data['content']->password;
      }
    }

    if (!$this->gurubk->validate()) {
      $data['title'] = 'Ubah gurubk';
      $data['form_action'] = base_url("gurubk/edit/$id");
      $data['page'] = 'pages/gurubk/form';
      $this->view($data);
      return;
    }
    if ($this->gurubk->where('id_bk', $id)->update($data['input'])) {
      $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('gurubk'));
  }

  public function delete($id)
  {
    if (!$_POST) {
      redirect(base_url('gurubk'));
    }
    $content = $this->gurubk->where('id_bk', $id)->first();
    if (!$content) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
      redirect(base_url('gurubk'));
    }
    if ($this->gurubk->where('id_bk', $id)->delete()) {
      $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('gurubk'));
  }

  public function unique_nip()
  {
    $nip = $this->input->post('nip');
    $id = $this->input->post('id_bk');
    $gurubk = $this->gurubk->where('nip', $nip)->first();
    if ($gurubk) {
      if ($id == $gurubk->id_bk) {
        return true;
      }
      $this->load->library('form_validation');
      $this->form_validation->set_message('unique_nip', '%s sudah digunakan!');
      return false;
    }
    return true;
  }
}

/* End of file guru.php */
