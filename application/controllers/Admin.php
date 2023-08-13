<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    
    public function index()
    {
        $data['content'] = $this->admin->join('tb_user', 'id_user')->where("tb_admin.id_user !=", Null)->select("tb_user.username, tb_admin.*")->get();
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
        }

        if (!$this->admin->validate($addRules)) {
            $data['title'] = 'Tambah Admin';
            $data['input'] = $input;
            $data['form_action'] = base_url('admin/create');
            $data['page'] = 'pages/admin/form';
            $this->view($data);
            return;
        }
        $this->admin->table = 'tb_user';

        $data_tb_user = [
            'username' => $input->username,
            'password' => password_hash($input->password, PASSWORD_DEFAULT),
            'role' => 'admin'
        ];
        unset($input->username);
        unset($input->password);
        $id_user = $this->admin->create($data_tb_user);
        $input->id_user = $id_user;

        $this->admin->table = 'tb_admin';

        if ($this->admin->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
        }
        redirect(base_url('admin'));
        
    }

    public function edit($id)
    {
        $data['content'] = $this->admin->where('id_admin', $id)->join('tb_user', 'id_user')->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
            redirect(base_url('admin'));
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

        if (!$this->admin->validate()) {
            $data['title'] = 'Ubah admin';
            $data['form_action'] = base_url("admin/edit/$id");
            $data['page'] = 'pages/admin/form';
            $this->view($data);
            return;
        }

        $this->admin->table = 'tb_user';
        $data_tb_user = [
            'username' => $data['input']->username,
            'password' => $data['input']->password
        ];

        $this->admin->where('id_user', $data['content']->id_user)->update($data_tb_user);
        $this->admin->table = 'tb_admin';
        unset($data['input']->username);
        unset($data['input']->password);

        if ($this->admin->where('id_admin', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
        }
        redirect(base_url('admin'));
    }

    public function unique_username()
    {
        $this->admin->table = 'tb_user';
        $username = $this->input->post('username');
        $id = $this->input->post('id_user');
        $user = $this->admin->where('username', $username)->first();
        if ($user) {
            if ($id == $user->id_user) {
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
