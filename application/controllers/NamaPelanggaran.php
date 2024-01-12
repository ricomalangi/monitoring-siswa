<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Namapelanggaran extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$is_login = $this->session->userdata('is_login');
		if (!$is_login) {
			$this->session->set_flashdata('error', 'Login terlebih dahulu');
			redirect(base_url('auth/login'));
			return;
		}
		//Do your magic here
	}

	public function index()
	{
		$data['content'] = $this->namapelanggaran->get();
		$data['page'] = 'pages/namapelanggaran/index';
		$this->view($data);
	}
	public function create()
	{
		if (!$_POST) {
			$input = (object) $this->namapelanggaran->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
			$input->nama_pelanggaran = strtoupper($input->nama_pelanggaran);
		}

		if (!$this->namapelanggaran->validate()) {
			$data['title'] = 'Tambah Data';
			$data['input'] = $input;
			$data['form_action'] = base_url('namapelanggaran/create');
			$data['page'] = 'pages/namapelanggaran/form';
			$this->view($data);
			return;
		}
		if ($this->namapelanggaran->create($input)) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
		}
		redirect(base_url('namapelanggaran'));
	}

	public function edit($id)
	{
		$data['content'] = $this->namapelanggaran->where('id_nama_pelanggaran', $id)->first();
		if (!$data['content']) {
			$this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan!');
			redirect(base_url('namapelanggaran'));
		}
		if (!$_POST) {
			$data['input'] = $data['content'];
		} else {
			$data['input'] = (object) $this->input->post(null, true);
			$data['input']->nama_pelanggaran = strtoupper($data['input']->nama_pelanggaran);
		}

		if (!$this->namapelanggaran->validate()) {
			$data['title'] = 'Edit Data';
			$data['form_action'] = base_url("namapelanggaran/edit/$id");
			$data['page'] = 'pages/namapelanggaran/form';
			$this->view($data);
			return;
		}
		if ($this->namapelanggaran->where('id_nama_pelanggaran', $id)->update($data['input'])) {
			$this->session->set_flashdata('success', 'Data berhasil diperbaharui');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
		}
		redirect(base_url('namapelanggaran'));
	}
	public function delete($id)
	{
		if (!$_POST) {
			redirect(base_url('namapelanggaran'));
		}
		$content = $this->namapelanggaran->where('id_nama_pelanggaran', $id)->first();
		if (!$content) {
			$this->session->set_flashdata('warning', 'Maaf! Data tidak ditemukan.');
			redirect(base_url('namapelanggaran'));
		}
		if ($this->namapelanggaran->where('id_nama_pelanggaran', $id)->delete()) {
			$this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
		}
		redirect(base_url('namapelanggaran'));
	}

	public function unique_nama_pelanggaran()
	{
		$nama_pelanggaran = $this->input->post('nama_pelanggaran');
		$id = $this->input->post('id_nama_pelanggaran');
		$pelanggaran = $this->namapelanggaran->where('nama_pelanggaran', $nama_pelanggaran)->first();
		if ($pelanggaran) {
			if ($id == $pelanggaran->id_nama_pelanggaran) {
				return true;
			}
			$this->load->library('form_validation');
			$this->form_validation->set_message('unique_nama_pelanggaran', '%s sudah ada!');
			return false;
		}
		return true;
	}
}

/* End of file Pelanggaran.php */
