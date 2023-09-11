<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends MY_Model {
  public $table = 'tb_kelas_siswa';
  public function getDefaultValues()
  {
    return [
      'id_kelas' => '',
      'id_siswa' => ''
    ];
  }
  public function getValidationRules()
  {
    $validationRules = [
      [
        'field' => 'id_kelas',
        'label' => 'Kelas',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'id_siswa',
        'label' => 'Siswa',
        'rules' => 'trim|required'
      ],
    ];

    return $validationRules;
  }
  

}

/* End of file Notifikasi_model.php */
