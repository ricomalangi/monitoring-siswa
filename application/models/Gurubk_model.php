<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gurubk_model extends MY_Model
{
  public $table = 'tb_bk';
  public function getDefaultValues()
  {
    return [
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
  public function getValidationRules($add_rules = null)
  {
    $validationRules = [
      [
        'field' => 'nama_bk',
        'label' => 'Nama Guru Bk',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'nip',
        'label' => 'NIP',
        'rules' => 'trim|required|callback_unique_nip'
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
        'field' => 'alamat',
        'label' => 'Alamat',
        'rules' => 'trim|required'
      ],
    ];
    if ($add_rules) {
      array_push($validationRules, $add_rules);
    }

    return $validationRules;
  }
}

/* End of file Siswa_model.php */
