<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends MY_Model
{
  public $table = 'tb_siswa';
  public function getDefaultValues()
  {
    return [
      'alamat' => '',
      'password' => '',
    ];
  }
  public function getValidationRules()
  {
    $validationRules = [
      [
        'field' => 'alamat',
        'label' => 'Alamat Rumah',
        'rules' => 'trim'
      ]
    ];
    return $validationRules;
  }
}
/* End of file Profile_model.php */
