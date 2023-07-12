<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
  }
  
  public function index(){
    $data['page'] = 'pages/dashboard/index';
    
    return $this->view($data);
  }

}

/* End of file Cart.php */
