<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends CI_Controller {

	function __construct() {
     
    parent::__construct();

    $this->load->model('model');
    $this->load->model('common_socialviralposts');
    $this->load->library('form_validation');
    $this->load->library("pagination");
    $this->load->helper('file');
    $this->load->helper('custom_helper');
    $this->load->library('Ajax_pagination');


    
  }

  public function cmspage(){

    $data['segment']= $this->uri->segment(1);
    $data['basesegment']= $this->uri->segment(1);
    $data["pageDetail"] = $this->model->get_data('*', 'tbl_cms_pages', array('slag' => $data['basesegment'])); 
    if(isset($data["pageDetail"][0]->page_name)){
      $data['pagetitle'] = $data["pageDetail"][0]->page_name;
    }
   
    $this->load->view('frontend/page', $data);
  }
 

}//class close