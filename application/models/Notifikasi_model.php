<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends MY_Model {
  public $table = 'tb_notifikasi';
  public function getDefaultValues()
  {
    return [
      'id_siswa' => '',
      'id_walikelas' => '',
      'keterangan' => '',
      'surat' => ''
    ];
  }
  public function getValidationRules($add_rules = null)
  {
    $validationRules = [
      [
        'field' => 'id_siswa',
        'label' => 'Siswa',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'id_walikelas',
        'label' => 'Walikelas',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'keterangan',
        'label' => 'Keterangan',
        'rules' => 'trim|required'
      ]
    ];

    return $validationRules;
  }
  
  public function uploadSurat($fieldName, $fileName)
  {
    $config = [
      'upload_path' => './surat',
      'file_name' => $fileName,
      'allowed_types' => 'pdf',
      'max_size' => 2048,
      'max_width' => 0,
      'max_height' => 0,
      'overwrite' => true,
      'file_ext_tolower' => true
    ];
    $this->load->library('upload', $config);

    if ($this->upload->do_upload($fieldName)) {
      return $this->upload->data();
    } else {
      $this->session->set_flashdata('surat_error', $this->upload->display_errors('', ''));
      return false;
    }
  }

  public function deleteSurat($fileName)
  {
    if (file_exists("./surat/$fileName")) {
      unlink("./surat/$fileName");
    }
  }
}

/* End of file Notifikasi_model.php */
