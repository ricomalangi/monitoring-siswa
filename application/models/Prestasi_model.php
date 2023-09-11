<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi_model extends MY_Model
{
  public $table = 'tb_prestasi';
  public function getDefaultValues()
  {
    return [
      'id_prestasi' => '',
      'id_siswa' => '',
      'jenis_prestasi' => '',
      'keterangan_prestasi' => '',
      'sertifikat' => ''
    ];
  }
  public function getValidationRules($add_rules = null)
  {
    $validationRules = [
      [
        'field' => 'jenis_prestasi',
        'label' => 'Jenis Prestasi',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'keterangan_prestasi',
        'label' => 'Keterangan Prestasi',
        'rules' => 'trim|required'
      ],
    ];
    if ($add_rules) {
      array_push($validationRules, $add_rules);
    }

    return $validationRules;
  }

  public function uploadSertifikat($fieldName, $fileName)
  {
    $config = [
      'upload_path' => './sertifikat',
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
      $this->session->set_flashdata('serti_error', $this->upload->display_errors('', ''));
      return false;
    }
  }

  public function deleteSertifikat($fileName)
  {
    if (file_exists("./sertifikat/$fileName")) {
      unlink("./sertifikat/$fileName");
    }
  }
}

/* End of file Prestasi_model.php */
