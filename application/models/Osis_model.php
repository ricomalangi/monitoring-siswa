<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Osis_model extends MY_Model {
    public $table = 'tb_osis';
    public function getDefaultValues(){
        return [
          'id' => '',
          'username' => '',
          'password' => '',
          'nama_osis' => ''
        ];
      }
    public function getValidationRules($add_rules = null){
    $validationRules = [
        [
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'trim|required'
        ],
        [
        'field' => 'nama_osis',
        'label' => 'Nama Osis',
        'rules' => 'trim|required'
        ],
    ];
    if($add_rules){
        array_push($validationRules, $add_rules);
    }

    return $validationRules;
    }
}

/* End of file Siswa_model.php */
