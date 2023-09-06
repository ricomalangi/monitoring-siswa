<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends MY_Model {
  public $table = 'tb_notifikasi';
  public function getDefaultValues()
  {
    return [
      'keterangan' => '',
      'surat' => ''
    ];
  }
  public function getValidationRules($add_rules = null)
  {
    $validationRules = [
      [
        'field' => 'keterangan',
        'label' => 'Keterangan',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'surat',
        'label' => 'Surat',
        'rules' => 'trim|required|callback_unique_nip'
      ],
    ];
    if ($add_rules) {
      array_push($validationRules, $add_rules);
    }

    return $validationRules;
  }
  

}

/* End of file Notifikasi_model.php */
