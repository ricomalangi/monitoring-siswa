<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
  protected $table = '';

  public function __construct()
  {
    parent::__construct();
    if(!$this->table){
      $this->table = strtolower(
        str_replace('_model', '', get_class($this))
      );
    }
  }
  // fungsi validasi Input
  // Rules: Dideklarasikan dalam masinag-masing model
  public function validate($options = null)
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters(
      '<smal class="form-text text-danger">', '</small>'
    );
    $validationRules = $this->getValidationRules();
    if($options){
        array_push($validationRules, $options);
    }
    $this->form_validation->set_rules($validationRules);
    return $this->form_validation->run();
  }

  public function select($columns)
  {
    $this->db->select($columns);
    return $this;
  }

  public function where($column, $condition)
  {
    $this->db->where($column, $condition);
    return $this;
  }

  public function like($column, $search){
    $this->db->like($column, $search);
    return $this;
  }

  public function orLike($column, $condition){
    $this->db->or_like($column, $condition);
    return $this;
  }

  public function join($table, $column ,$type = 'left'){
    $this->db->join($table, "$this->table.$column = $table.$column", $type);
    // example $this->db->join('tb_user', "tb_siswa.id_user = tb_user.id_user")
    return $this;
  }

  public function orderBy($column, $order = 'ASC'){
    $this->db->order_by($column, $order);
    return $this;
  }

  public function first(){
    return $this->db->get($this->table)->row();
  }

  public function get(){
    return $this->db->get($this->table)->result();
  }

  public function count(){
    return $this->db->count_all_results($this->table);
  }

  public function create($data){
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function update($data){
    return $this->db->update($this->table, $data);
  }

  public function delete(){
    $this->db->delete($this->table);
    return $this->db->affected_rows();
  }

}

/* End of file ModelName.php */
