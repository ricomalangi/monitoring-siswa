<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gurubk_model extends MY_Model {
    public $table = 'tb_bk';
    public function getDefaultValues(){
        return [
          'id' => '',
          'username' => '',
          'password' => '',
          'nama_bk' => '',
          'nip' => '',
          'tempat_lahir' => '',
          'tanggal_lahir' => '',
          'agama' => '',
          'alamat' => '',
          'jenis_kelamin' => '',
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
            'field' => 'nama_bk',
            'label' => 'Nama Guru Bk',
            'rules' => 'trim|required'
          ],
          [
            'field' => 'nip',
            'label' => 'NIP',
            'rules' => 'trim|required'
          ],
          [
            'field' => 'agama',
            'label' => 'Agama',
            'rules' => 'trim|required'
          ],
          [
            'field' => 'jenis_kelamin',
            'label' => 'Jenis Kelamin',
            'rules' => 'trim|required|in_list[L,P]'
          ],
        ];
        if($add_rules){
            array_push($validationRules, $add_rules);
        }

        return $validationRules;
      }
}

/* End of file Siswa_model.php */
