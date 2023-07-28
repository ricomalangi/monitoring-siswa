<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function index()
    {
        $data['content'] = $this->prestasi->join('tb_siswa', 'id_siswa')->where("tb_prestasi.id_siswa !=", Null)->select("tb_siswa.nama_siswa, tb_prestasi.*")->get();
        $data['page'] = 'pages/prestasi/index';
        $this->view($data);
    }

    public function create()
    {
        $addRules = [
            'field' => 'sertifikat',
            'label' => 'Sertifikat',
            'rules' => 'trim|required'
        ];

        if (!$_POST) {
            $input = (object) $this->prestasi->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->prestasi->validate($addRules)) {
            $data['title'] = 'Tambah prestasi';
            $data['input'] = $input;
            $data['form_action'] = base_url('prestasi/create');
            $data['page'] = 'pages/prestasi/form';
            $this->view($data);
            return;
        }
        $this->prestasi->table = 'tb_user';

        $data_tb_user = [
            'username' => $input->username,
            'password' => password_hash($input->password, PASSWORD_DEFAULT),
            'role' => 'prestasi'
        ];
        unset($input->username);
        unset($input->password);
        unset($input->role);
        $id_user = $this->prestasi->create($data_tb_user);
        $input->id_user = $id_user;

        $this->prestasi->table = 'tb_bk';

        if ($this->prestasi->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
        }
        redirect(base_url('prestasi'));
    }

    public function edit($id)
    {
        $data['content'] = $this->prestasi->where('id_bk', $id)->join('tb_user', 'id_user')->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
            redirect(base_url('prestasi'));
        }
        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
            if ($data['input']->password !== '') {
                $data['input']->password = password_hash(
                    $data['input']->password,
                    PASSWORD_DEFAULT
                );
            } else {
                $data['input']->password = $data['content']->password;
            }
        }

        if (!$this->prestasi->validate()) {
            $data['title'] = 'Ubah prestasi';
            $data['form_action'] = base_url("prestasi/edit/$id");
            $data['page'] = 'pages/prestasi/form';
            $this->view($data);
            return;
        }

        $this->prestasi->table = 'tb_user';
        $data_tb_user = [
            'username' => $data['input']->username,
            'password' => $data['input']->password
        ];

        $this->prestasi->where('id_user', $data['content']->id_user)->update($data_tb_user);
        $this->prestasi->table = 'tb_bk';
        unset($data['input']->username);
        unset($data['input']->password);

        if ($this->prestasi->where('id_bk', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
        }
        redirect(base_url('prestasi'));
    }

    public function delete($id)
    {
        if(!$_POST){
            redirect(base_url('prestasi'));
        }
        $content = $this->prestasi->where('id_bk', $id)->first();
        if(!$content){
          $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
          redirect(base_url('prestasi'));
        }
        
        $this->prestasi->table = 'tb_user';

        if($this->prestasi->where('id_user', $content->id_user)->delete()){
            $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
        }
        redirect(base_url('prestasi'));
    }
}

/* End of file guru.php */
