<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct() {
     
    parent::__construct();
    $this->load->model('model');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->helper('file');
    $this->load->helper('custom_helper');
    $info=$this->session->all_userdata();
    //print_r($info);
   
    if(isset($info['user_id']) && !empty($info['user_id'])){
      
      redirect(base_url().'home');
    }
    
  }

  public function index(){

    $data['pagetitle'] = 'Login';
     $this->load->view('frontend/login.php', $data);
  }
  public function change_password(){

    $data['pagetitle'] = 'Change Password';
    echo $user_id = $this->uri->segment(3);
     $this->load->view('frontend/change_password', $data);
  }
  }//class close