<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggaran_model extends MY_Model
{
  public $table = 'tb_pelanggaran';
  public function getDefaultValues()
  {
    return [
      'id_siswa' => '',
      'id_nama_pelanggaran' => '',
      'id_walikelas' => '',
      'kategori_pelanggaran' => '',
      'poin_pelanggaran' => '',
      'status' => '',
      'keterangan' => ''
    ];
  }
  public function getValidationRules($add_rules = null)
  {
    $validationRules = [
      [
        'field' => 'id_nama_pelanggaran',
        'label' => 'Nama Pelanggaran',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'id_siswa',
        'label' => 'Nama Siswa',
        'rules' => 'trim|required'
      ]
    ];
    
    if ($add_rules) {
      foreach($add_rules as $item){
        $validationRules[] = $item;
      }
    }
    return $validationRules;
  }
}

/* End of file Pelanggaran_model.php */
