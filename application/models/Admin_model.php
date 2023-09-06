<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends MY_Model
{
  public $table = 'tb_admin';
  public function getDefaultValues()
  {
    return [
      'username' => '',
      'password' => ''
    ];
  }
  public function getValidationRules($add_rules = null)
  {
    $validationRules = [
      [
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'trim|required|callback_unique_username'
      ]
    ];
    if ($add_rules) {
      $validationRules[] = $add_rules;
    }
    return $validationRules;
  }
}

/* End of file Prestasi_model.php */
