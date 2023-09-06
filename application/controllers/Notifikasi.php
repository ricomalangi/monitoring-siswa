<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends MY_Controller {
  
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $is_login = $this->session->userdata('is_login');
    if(!$is_login){
      $this->session->set_flashdata('error', 'Login terlebih dahulu');
      redirect(base_url('auth/login'));
      return;
    }
  }
  

  public function index()
  {
    
  }

}

/* End of file Notifikasi.php */
