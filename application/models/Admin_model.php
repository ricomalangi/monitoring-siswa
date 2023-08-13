<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends MY_Model {
    public $table = 'tb_admin';
    public function getDefaultValues(){
        return [
          'nama_admin' => '',
          'role_admin' => '',
          'username' => '',
          'password' => ''
        ];
      }
    public function getValidationRules($add_rules = null){
        $validationRules = [
            [
                'field' => 'nama_admin',
                'label' => 'Nama Admin',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'role_admin',
                'label' => 'Role',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|callback_unique_username'
            ]
        ];
        if($add_rules){
            array_push($validationRules, $add_rules);
        }

        return $validationRules;
    }
}

/* End of file Prestasi_model.php */
