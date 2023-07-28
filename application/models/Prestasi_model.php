<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi_model extends MY_Model {
    public $table = 'tb_prestasi';
    public function getDefaultValues(){
        return [
          'id_prestasi' => '',
          'jenis_prestasi' => '',
          'keterangan_prestasi' => '',
        ];
      }
    public function getValidationRules($add_rules = null){
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
        if($add_rules){
            array_push($validationRules, $add_rules);
        }

        return $validationRules;
    }
    

}

/* End of file Prestasi_model.php */
