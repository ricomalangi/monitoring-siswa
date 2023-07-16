<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function index()
    {
        $data['content'] = $this->siswa->join('tb_user', 'id_user')->where("tb_siswa.id_user !=", Null)->select("tb_user.username, tb_siswa.*")->get();
        $data['page'] = 'pages/siswa/index';
        $this->view($data);
    }

    public function detail($id)
    {
        $data['content'] = $this->siswa->where('id_siswa', $id)->join('tb_user', 'id_user')->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
            redirect(base_url('siswa'));
        }
        $data['input'] = $data['content'];
        $data['title'] = 'View Siswa';
        $data['page'] = 'pages/siswa/form_view';
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
            $input = (object) $this->siswa->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->siswa->validate($addRules)) {
            $data['title'] = 'Tambah Siswa';
            $data['input'] = $input;
            $data['form_action'] = base_url('siswa/create');
            $data['page'] = 'pages/siswa/form';
            $this->view($data);
            return;
        }
        $this->siswa->table = 'tb_user';

        $data_tb_user = [
            'username' => $input->username,
            'password' => password_hash($input->password, PASSWORD_DEFAULT),
            'role' => 'siswa'
        ];
        unset($input->username);
        unset($input->password);
        unset($input->role);
        $id_user = $this->siswa->create($data_tb_user);
        $input->id_user = $id_user;

        $this->siswa->table = 'tb_siswa';

        if ($this->siswa->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
        }
        redirect(base_url('siswa'));
    }

    public function edit($id)
    {
        $data['content'] = $this->siswa->where('id_siswa', $id)->join('tb_user', 'id_user')->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
            redirect(base_url('siswa'));
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

        if (!$this->siswa->validate()) {
            $data['title'] = 'Ubah Siswa';
            $data['form_action'] = base_url("siswa/edit/$id");
            $data['page'] = 'pages/siswa/form';
            $this->view($data);
            return;
        }

        $this->siswa->table = 'tb_user';
        $data_tb_user = [
            'username' => $data['input']->username,
            'password' => $data['input']->password
        ];

        $this->siswa->where('id_user', $data['content']->id_user)->update($data_tb_user);
        $this->siswa->table = 'tb_siswa';
        unset($data['input']->username);
        unset($data['input']->password);

        if ($this->siswa->where('id_siswa', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
        }
        redirect(base_url('siswa'));
    }

    public function delete($id)
    {
        if(!$_POST){
            redirect(base_url('siswa'));
        }
        $this->siswa->table = 'tb_user';
        $content = $this->siswa->where('id_user', $id)->first();
        if(!$content){
          $this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
          redirect(base_url('siswa'));
        }
        if($this->siswa->where('id_user', $id)->delete()){
            $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
          } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
          }
        redirect(base_url('siswa'));
    }
}

/* End of file Siswa.php */
