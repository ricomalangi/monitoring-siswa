<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Osis_model extends MY_Model
{
  public $table = 'tb_petugas_piket';
  public function getDefaultValues()
  {
    return [
      'nama_petugas' => '',
      'password' => '',
    ];
  }
  public function getValidationRules($add_rules = null)
  {
    $validationRules = [
      [
        'field' => 'nama_petugas',
        'label' => 'Username',
        'rules' => 'trim|required'
      ],
    ];
    if ($add_rules) {
      $validationRules[] = $add_rules;
    }
    return $validationRules;
  }
}
/* End of file Siswa_model.php */
