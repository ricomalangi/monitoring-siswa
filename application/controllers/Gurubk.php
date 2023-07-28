<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gurubk extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function index()
    {
        $data['content'] = $this->gurubk->join('tb_user', 'id_user')->where("tb_bk.id_user !=", Null)->select("tb_user.username, tb_bk.*")->get();
        $data['page'] = 'pages/gurubk/index';
        $this->view($data);
    }

    public function detail($id)
    {
        $data['content'] = $this->gurubk->where('id_bk', $id)->join('tb_user', 'id_user')->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
            redirect(base_url('gurubk'));
        }
        $data['input'] = $data['content'];
        $data['title'] = 'View gurubk';
        $data['page'] = 'pages/gurubk/form_view';
        $this->view($data);
        return;
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
        }

        if (!$this->gurubk->validate($addRules)) {
            $data['title'] = 'Tambah gurubk';
            $data['input'] = $input;
            $data['form_action'] = base_url('gurubk/create');
            $data['page'] = 'pages/gurubk/form';
            $this->view($data);
            return;
        }
        $this->gurubk->table = 'tb_user';

        $data_tb_user = [
            'username' => $input->username,
            'password' => password_hash($input->password, PASSWORD_DEFAULT),
            'role' => 'gurubk'
        ];
        unset($input->username);
        unset($input->password);
        unset($input->role);
        $id_user = $this->gurubk->create($data_tb_user);
        $input->id_user = $id_user;

        $this->gurubk->table = 'tb_bk';

        if ($this->gurubk->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
        }
        redirect(base_url('gurubk'));
    }

    public function edit($id)
    {
        $data['content'] = $this->gurubk->where('id_bk', $id)->join('tb_user', 'id_user')->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
            redirect(base_url('gurubk'));
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

        if (!$this->gurubk->validate()) {
            $data['title'] = 'Ubah gurubk';
            $data['form_action'] = base_url("gurubk/edit/$id");
            $data['page'] = 'pages/gurubk/form';
            $this->view($data);
            return;
        }

        $this->gurubk->table = 'tb_user';
        $data_tb_user = [
            'username' => $data['input']->username,
            'password' => $data['input']->password
        ];

        $this->gurubk->where('id_user', $data['content']->id_user)->update($data_tb_user);
        $this->gurubk->table = 'tb_bk';
        unset($data['input']->username);
        unset($data['input']->password);

        if ($this->gurubk->where('id_bk', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
        }
        redirect(base_url('gurubk'));
    }

    public function delete($id)
    {
        if(!$_POST){
            redirect(base_url('gurubk'));
        }
        $content = $this->gurubk->where('id_bk', $id)->first();
        if(!$content){
          $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
          redirect(base_url('gurubk'));
        }
        
        $this->gurubk->table = 'tb_user';

        if($this->gurubk->where('id_user', $content->id_user)->delete()){
            $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
        }
        redirect(base_url('gurubk'));
    }
}

/* End of file guru.php */
