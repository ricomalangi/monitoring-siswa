<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
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
  }
  
  public function index()
  {
    // admin
    if($this->role === 'admin')
    {
      $this->profile->table = 'tb_admin';
      $data['content'] = $this->profile->where('id_admin', $this->session->userdata('id_admin'))->first();
      if (!$data['content']) {
        $data['page'] = 'layouts/_forbidden';
        return $this->view($data);
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
  
      if (!$this->profile->validate()) {
        $data['page'] = 'pages/profile/index_admin';
        $data['data'] = $this->profile->get();
        $data['form_action'] = base_url('profile');
        return $this->view($data);
      }
      
      if ($this->profile->where('id_admin', $this->session->userdata('id_admin'))->update($data['input'])) {
        $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
      } else {
        $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
      }
      redirect(base_url('profile'));
    } 
    // walikelas
    else if($this->role === 'walikelas')
    {
      $this->profile->table = 'tb_walikelas';
      $data['content'] = $this->profile->where('id_walikelas', $this->session->userdata('id_walikelas'))->first();
      if (!$data['content']) {
        $data['page'] = 'layouts/_forbidden';
        return $this->view($data);
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
  
      if (!$this->profile->validate()) {
        $data['page'] = 'pages/profile/index_walikelas';
        $data['data'] = $this->profile->get();
        $data['form_action'] = base_url('profile');
        return $this->view($data);
      }
      
      if ($this->profile->where('id_walikelas', $this->session->userdata('id_walikelas'))->update($data['input'])) {
        $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
      } else {
        $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
      }
      redirect(base_url('profile'));
    } 
    // gurubk
    else if($this->role === 'gurubk')
    {
      $this->profile->table = 'tb_bk';
      $data['content'] = $this->profile->where('id_bk', $this->session->userdata('id_bk'))->first();
      if (!$data['content']) {
        $data['page'] = 'layouts/_forbidden';
        return $this->view($data);
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
  
      if (!$this->profile->validate()) {
        $data['page'] = 'pages/profile/index_gurubk';
        $data['data'] = $this->profile->get();
        $data['form_action'] = base_url('profile');
        return $this->view($data);
      }
      
      if ($this->profile->where('id_bk', $this->session->userdata('id_bk'))->update($data['input'])) {
        $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
      } else {
        $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
      }
      redirect(base_url('profile'));
    } 
    // osis
    else if($this->role === 'osis')
    {
      $this->profile->table = 'tb_petugas_piket';
      $data['content'] = $this->profile->where('id_petugas_piket', $this->session->userdata('id_petugas_piket'))->first();
      if (!$data['content']) {
        $data['page'] = 'layouts/_forbidden';
        return $this->view($data);
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
  
      if (!$this->profile->validate()) {
        $data['page'] = 'pages/profile/index_osis';
        $data['data'] = $this->profile->get();
        $data['nama_petugas'] = $this->session->userdata('username');
        $data['form_action'] = base_url('profile');
        return $this->view($data);
      }
      
      if ($this->profile->where('id_petugas_piket', $this->session->userdata('id_petugas_piket'))->update($data['input'])) {
        $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
      } else {
        $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
      }
      redirect(base_url('profile'));
    } 
    // siswa
    else if($this->role === 'siswa')
    {
      $this->profile->table = 'tb_siswa';
      $data['content'] = $this->profile->where('id_siswa', $this->session->userdata('id_siswa'))->first();
      if (!$data['content']) {
        $data['page'] = 'layouts/_forbidden';
        return $this->view($data);
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
  
      if (!$this->profile->validate()) {
        $data['page'] = 'pages/profile/index_siswa';
        $data['data'] = $this->profile->get();
        $data['form_action'] = base_url('profile');
        return $this->view($data);
      }
      
      if ($this->profile->where('id_siswa', $this->session->userdata('id_siswa'))->update($data['input'])) {
        $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
      } else {
        $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
      }
      redirect(base_url('profile'));
    } else {
      $data['page'] = 'layouts/_forbidden';
      return $this->view($data);
    }
  }

  public function create()
  {
    if (!$_POST) {
      $input = (object) $this->kelas->getDefaultValues();
    } else {
      $input = (object) $this->input->post(null, true);
    }

    if (!$this->kelas->validate()) {
      $this->kelas->table = 'tb_kelas';
      $data['title'] = 'Tambah Data';
      $data['addon_css'] = base_url('assets/vendor/select2/css/select2.min.css');
      $data['addon_js'] = base_url('assets/vendor/select2/js/select2.full.min.js');
      $data['input'] = $input;
      $data['siswa'] = $this->siswa->select('id_siswa,nama_siswa')->get();
      $data['nama_kelas'] = $this->kelas->select('id_kelas,nama_kelas')->get();
      $data['nama_walikelas'] = $this->walikelas->select('id_walikelas,nama_walikelas')->get();
      $data['form_action'] = base_url('kelas/create');
      $data['page'] = 'pages/kelas/form';
      $this->kelas->table = 'tb_kelas_siswa';
      $this->view($data);
      return;
    }
    
    if ($this->kelas->create($input)) {
      $this->session->set_flashdata('success', 'Data berhasil disimpan');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
    }
    redirect(base_url('kelas'));
  }
  
  public function edit($id)
  {
    $data['content'] = $this->kelas->where('id_kelas_siswa', $id)->first();
    if (!$data['content']) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
      redirect(base_url('kelas'));
    }
    if (!$_POST) {
      $data['input'] = $data['content'];
    } else {
      $data['input'] = (object) $this->input->post(null, true);
    }

    if (!$this->kelas->validate()) {
      $this->kelas->table = 'tb_kelas';
      $data['title'] = 'Edit Data';
      $data['form_action'] = base_url("kelas/edit/$id");
      $data['page'] = 'pages/kelas/form';
      $data['addon_css'] = base_url('assets/vendor/select2/css/select2.min.css');
      $data['addon_js'] = base_url('assets/vendor/select2/js/select2.full.min.js');
      $data['siswa'] = $this->siswa->select('id_siswa,nama_siswa')->get();
      $data['nama_kelas'] = $this->kelas->select('id_kelas,nama_kelas')->get();
      $data['nama_walikelas'] = $this->walikelas->select('id_walikelas,nama_walikelas')->get();
      $this->kelas->table = 'tb_kelas_siswa';
      $this->view($data);
      return;
    }
    if ($this->kelas->where('id_kelas_siswa', $id)->update($data['input'])) {
      $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('kelas'));
  }

  public function delete($id)
  {
    if (!$_POST) {
      redirect(base_url('kelas'));
    }
    $content = $this->kelas->where('id_kelas_siswa', $id)->first();
    if (!$content) {
      $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
      redirect(base_url('kelas'));
    }
    if ($this->kelas->where('id_kelas_siswa', $id)->delete()) {
      $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
    } else {
      $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
    }
    redirect(base_url('kelas'));
  }
  public function unique_nama_siswa()
  {
    $siswa = $this->input->post('id_siswa');
    $id = $this->input->post('id_kelas_siswa');
    $kelas = $this->kelas->where('id_siswa', $siswa)->first();
    if ($kelas) {
      if ($id == $kelas->id_kelas_siswa) {
        return true;
      }
      $this->load->library('form_validation');
      $this->form_validation->set_message('unique_nama_siswa', '%s sudah terdaftar kelas');
      return false;
    }
    return true;
  }
}

/* End of file Cart.php */
