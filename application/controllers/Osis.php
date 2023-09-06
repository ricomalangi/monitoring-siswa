<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Osis extends MY_Controller
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
    $data['content'] = $this->osis->get();
    $data['page'] = 'pages/osis/index';
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
      $input = (object) $this->osis->getDefaultValues();
    } else {
      $input = (object) $this->input->post(null, true);
      $input->password = hashEncrypt($input->password);
    }

    if (!$this->osis->validate($addRules)) {
      $data['title'] = 'Tambah osis';
      $data['input'] = $input;
      $data['form_action'] = base_url('osis/create');
      $data['page'] = 'pages/osis/form';
      $this->view($data);
      return;
    }
    if ($this->osis->create($input)) {
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
    }
    redirect(base_url('osis'));
  }

  public function edit($id)
  {
    $data['content'] = $this->osis->where('id_petugas_piket', $id)->first();
    if (!$data['content']) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
      redirect(base_url('osis'));
    }
    if (!$_POST) {
      $data['input'] = $data['content'];
    } else {
      $data['input'] = (object) $this->input->post(null, true);
      if ($data['input']->password !== '') {
        $data['input']->password = hashEncrypt($data['input']->password);
      } else {
        $data['input']->password = $data['content']->password;
      }
    }

    if (!$this->osis->validate()) {
      $data['title'] = 'Edit Data';
      $data['form_action'] = base_url("osis/edit/$id");
      $data['page'] = 'pages/osis/form';
      $this->view($data);
      return;
    }
    if ($this->osis->where('id_petugas_piket', $id)->update($data['input'])) {
      $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('osis'));
  }

  public function delete($id)
  {
    if (!$_POST) {
      redirect(base_url('osis'));
    }
    $content = $this->osis->where('id_petugas_piket', $id)->first();
    if (!$content) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
      redirect(base_url('osis'));
    }
    if ($this->osis->where('id_petugas_piket', $id)->delete()) {
      $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('osis'));
  }
}

/* End of file osis.php */
