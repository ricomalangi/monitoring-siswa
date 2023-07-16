<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends MY_Model {
    public $table = 'tb_siswa';
    public function getDefaultValues(){
        return [
          'id' => '',
          'username' => '',
          'password' => '',
          'nama_siswa' => '',
          'nisn' => '',
          'tempat_lahir' => '',
          'tanggal_lahir' => '',
          'agama' => '',
          'alamat' => '',
          'jenis_kelamin' => '',
          'status' => '',
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
            'field' => 'nama_siswa',
            'label' => 'Nama Siswa',
            'rules' => 'trim|required'
          ],
          [
            'field' => 'nisn',
            'label' => 'NISN',
            'rules' => 'trim|required'
          ],
          [
            'field' => 'tempat_lahir',
            'label' => 'Tempat Lahir',
            'rules' => 'trim|required'
          ],
          [
            'field' => 'tanggal_lahir',
            'label' => 'Tanggal Lahir',
            'rules' => 'trim|required'
          ],
          [
            'field' => 'agama',
            'label' => 'Agama',
            'rules' => 'trim|required'
          ],
          [
            'field' => 'alamat',
            'label' => 'Alamat',
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
        // echo("<pre>");print_r($validationRules);echo("<pre>");
        // die();
        return $validationRules;
      }
}

/* End of file Siswa_model.php */
