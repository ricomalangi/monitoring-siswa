<?php

defined('BASEPATH') or exit('No direct script access allowed');

class NamaPelanggaran_model extends MY_Model
{
  public $table = 'tb_nama_pelanggaran';
  public function getDefaultValues()
  {
    return [
      'nama_pelanggaran' => ''
    ];
  }
  public function getValidationRules($add_rules = null)
  {
    $validationRules = [
      [
        'field' => 'nama_pelanggaran',
        'label' => 'Nama Pelanggaran',
        'rules' => 'trim|required|callback_unique_nama_pelanggaran'
      ]
    ];
    if ($add_rules) {
      $validationRules[] = $add_rules;
    }
    return $validationRules;
  }
}

/* End of file Prestasi_model.php */
