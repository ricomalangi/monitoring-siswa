<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Osis extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function index()
    {
        $data['content'] = $this->osis->join('tb_user', 'id_user')->where("tb_osis.id_user !=", Null)->select("tb_user.username, tb_osis.*")->get();
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
        }

        if (!$this->osis->validate($addRules)) {
            $data['title'] = 'Tambah osis';
            $data['input'] = $input;
            $data['form_action'] = base_url('osis/create');
            $data['page'] = 'pages/osis/form';
            $this->view($data);
            return;
        }
        $this->osis->table = 'tb_user';

        $data_tb_user = [
            'username' => $input->username,
            'password' => password_hash($input->password, PASSWORD_DEFAULT),
            'role' => 'osis'
        ];
        unset($input->username);
        unset($input->password);
        unset($input->role);
        $id_user = $this->osis->create($data_tb_user);
        $input->id_user = $id_user;

        $this->osis->table = 'tb_osis';

        if ($this->osis->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
        }
        redirect(base_url('osis'));
    }

    public function edit($id)
    {
        $data['content'] = $this->osis->where('id_osis', $id)->join('tb_user', 'id_user')->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
            redirect(base_url('osis'));
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

        if (!$this->osis->validate()) {
            $data['title'] = 'Ubah osis';
            $data['form_action'] = base_url("osis/edit/$id");
            $data['page'] = 'pages/osis/form';
            $this->view($data);
            return;
        }

        $this->osis->table = 'tb_user';
        $data_tb_user = [
            'username' => $data['input']->username,
            'password' => $data['input']->password
        ];

        $this->osis->where('id_user', $data['content']->id_user)->update($data_tb_user);
        $this->osis->table = 'tb_osis';
        unset($data['input']->username);
        unset($data['input']->password);

        if ($this->osis->where('id_osis', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
        }
        redirect(base_url('osis'));
    }

    public function delete($id)
    {
        if(!$_POST){
            redirect(base_url('osis'));
        }
        $this->osis->table = 'tb_user';
        $content = $this->osis->where('id_user', $id)->first();
        if(!$content){
          $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
          redirect(base_url('osis'));
        }
        if($this->osis->where('id_user', $id)->delete()){
            $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
          } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
          }
        redirect(base_url('osis'));
    }
}

/* End of file osis.php */
