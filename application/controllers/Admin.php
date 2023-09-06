<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
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
    $data['content'] = $this->admin->get();
    $data['page'] = 'pages/admin/index';
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
      $input = (object) $this->admin->getDefaultValues();
    } else {
      $input = (object) $this->input->post(null, true);
      $input->password = hashEncrypt($input->password);
    }

    if (!$this->admin->validate($addRules)) {
      $data['title'] = 'Tambah Data';
      $data['input'] = $input;
      $data['form_action'] = base_url('admin/create');
      $data['page'] = 'pages/admin/form';
      $this->view($data);
      return;
    }
    if ($this->admin->create($input)) {
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
    }
    redirect(base_url('admin'));
  }

  public function edit($id)
  {
    $data['content'] = $this->admin->where('id_admin', $id)->first();
    if (!$data['content']) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
      redirect(base_url('admin'));
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

    if (!$this->admin->validate()) {
      $data['title'] = 'Edit Data';
      $data['form_action'] = base_url("admin/edit/$id");
      $data['page'] = 'pages/admin/form';
      $this->view($data);
      return;
    }
    if ($this->admin->where('id_admin', $id)->update($data['input'])) {
      $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('admin'));
  }

  public function delete($id)
  {
    if (!$_POST) {
      redirect(base_url('admin'));
    }
    $content = $this->admin->where('id_admin', $id)->first();
    if (!$content) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
      redirect(base_url('admin'));
    }
    if ($this->admin->where('id_admin', $id)->delete()) {
      $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('admin'));
  }
  public function unique_username()
  {
    $username = $this->input->post('username');
    $id = $this->input->post('id_admin');
    $user = $this->admin->where('username', $username)->first();
    if ($user) {
      if ($id == $user->id_admin) {
        return true;
      }
      $this->load->library('form_validation');
      $this->form_validation->set_message('unique_username', '%s sudah digunakan!');
      return false;
    }
    return true;
  }
}

/* End of file Admin.php */
