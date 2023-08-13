<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggaran extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    
    public function index()
    {
        $data['content'] = $this->pelanggaran->join('tb_siswa', 'id_siswa')->where("tb_pelanggaran.id_siswa !=", Null)->select("tb_siswa.nama_siswa, tb_pelanggaran.*")->get();
        $data['page'] = 'pages/pelanggaran/index';
        $this->view($data);
    }

}

/* End of file Pelanggaran.php */
