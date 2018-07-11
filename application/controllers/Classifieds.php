<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classifieds extends CI_Controller {
    public function __construct(){


		parent::__construct();
		/* Load the libraries and helpers */        
		$this->load->model('model');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper('resize');
		$this->load->helper('custom_helper');
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;
	    if(isset($info['admin_siterole']))
		{
		
			if( ($info['admin_siterole']==1) || ($info['admin_siterole']==3))
			{
				$this->data['siterole_id'] = $info['admin_siterole'];
		        $this->data['user_id'] = $info['admin_id'];	
		        
			}else{
				redirect(base_url()."administrator");
			}
			
		}
		if(isset($data['userinfo']['admin_id'])=='')
		{
			redirect(base_url()."administrator");
		} 
		
	 }

/**
	 * Classifieds List Page for this controller.
	 */
public function classifiedslist(){

	$info=$this->session->all_userdata();
	$data['userinfo']=$info;
	//print_r($data['userinfo']);
	$data['u_id'] = $this->data['user_id'];
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],11);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');	$data['active_tab_classifieds'] = 'active';
	$data['role'] = $this->data['siterole_id'];
	$data['basesegment']= $this->uri->segment(2);
	$data['segment']= $this->uri->segment(3);
    $data['title'] = 'Classifieds List';

    if($data['segment'] == 'approve'){

        $data['classifiedList'] = $this->model->get_data_order_by('*', 'tbl_classified_list', array('classified_status' => 1 ),'classified_id','DESC');
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/classifieds/approve_classifiedslist',$data);
		$this->load->view('administrator/include/inner_footer');

    }else if($data['segment'] == 'reject'){

    	$data['classifiedList'] = $this->model->get_data_order_by('*', 'tbl_classified_list', array('classified_status' => 2 ),'classified_id','DESC');
    	$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/classifieds/reject_classifiedslist',$data);
		$this->load->view('administrator/include/inner_footer');

    }else if($data['segment'] == 'pending'){
       $data['classifiedList'] = $this->model->get_data_order_by('*', 'tbl_classified_list', array('classified_status' => 0 ),'classified_id','DESC');
    	$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/classifieds/pending_classifiedslist',$data);
		$this->load->view('administrator/include/inner_footer');

    }else{

    	$data['classifiedList'] = $this->model->get_all_order_by('*', 'tbl_classified_list','classified_id','DESC');
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/classifieds/classifiedslist',$data);
		$this->load->view('administrator/include/inner_footer');

    }
		
}

/**
	 * Classifieds View Page for this controller.
	 */
public function classifiedsview(){

	$info=$this->session->all_userdata();
	$data['userinfo']=$info;
	//print_r($data['userinfo']);
	$data['u_id'] = $this->data['user_id'];
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],11);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }
	if (isset($result)) {
	  	if($result[0]->permission_id == 11){
	  		if($result[0]->view_permission !=1){
	  		 	redirect(base_url().'access_denied');
	  		}
	  	}
	  }
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');

	$data['active_tab_classifieds'] = 'active';
	$data['role'] = $this->data['siterole_id'];
	$data['basesegment']= $this->uri->segment(2);
	$data['segment']= $this->uri->segment(4);

	$data['classifiedList'] = $this->model->get_row('tbl_classified_list', array('classified_id' =>$data['segment'] ));
	$data['clsImg'] = $this->model->get_data('*','tbl_classified_images',array('cls_id' =>$data['segment']));

	////////////////////////total user////////
	$data['title'] = 'Classifieds View';
	// $data['userList'] = $this->model->get_all_order_by('*', 'tbl_user_master','user_id','DESC');
	$this->load->view('administrator/include/inner_header',$data);
	$this->load->view('administrator/classifieds/classified_view',$data);
	$this->load->view('administrator/include/inner_footer');	
		
}


/**
	 * Classifieds Edit Page for this controller.
	 */

public function editclassifiedpage(){


	    $info=$this->session->all_userdata();
		$data['userinfo']=$info;
		//print_r($data['userinfo']);
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],11);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		if (isset($result)) {
		  	if($result[0]->permission_id == 11){
		  		if($result[0]->edit_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		}
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['active_tab_classifieds'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment']= $this->uri->segment(3);
		$data['user_id'] = $this->data['user_id'];
		$data['pageID']= $this->uri->segment(4);
		$data['catList'] =  $this->model->get_data_order_by('*', 'tbl_classified_cat_master', array('classified_cat_status' => 1), 'classified_sort_order, classified_cat_name','ASC');
		$data['classified'] = $this->model->get_row('tbl_classified_list',array('classified_id' => $data['pageID']));
		 $data['clsImg'] = $this->model->get_data('*','tbl_classified_images',array('cls_id' => $data['pageID']));
		$data['title'] = 'Edit Classified';	
		if($this->form_validation->run('classifiedsedit') == FALSE) {

	  	$this->load->view('administrator/include/inner_header',$data);
	  	$this->load->view('administrator/classifieds/classified',$data);;
	  	$this->load->view('administrator/include/inner_footer');	

	  }else {

				$classifiedpage['classified_ads'] = $this->input->post('classified_ads');
				$classifiedpage['classified_type'] = $this->input->post('classified_type');
			  	$classifiedpage['classified_description'] = $this->input->post('classified_description');
                $classified_state = $this->input->post('classified_state');
			  	if(isset($classified_state) && !empty($classified_state)){
                        $classifiedpage['classified_state'] = $this->input->post('classified_state');
						$latlong = $this->get_lat_long($classifiedpage['classified_state']);
						$classifiedpage['classified_lat'] = $latlong['lat'];
						$classifiedpage['classified_lang'] = $latlong['lng'];
			  	}
			  	$classifiedpage['classified_price']= $this->input->post('classified_price');
			  	$classifiedpage['last_modify_user_id'] = $data['u_id'];
                $classifiedpage['last_modify_date'] = date("Y-m-d");
			  	$classified_created_by = $this->input->post('classified_created_by');
				$is_exist = $this->model->isclassifiedExist($data['pageID'],$classified_created_by);
				if ($is_exist) {
				$this->session->set_flashdata('error_classified_created_by', 'The Classified Title field must contain a unique value.');
				redirect(base_url().'administrator/classifieds/editclassifiedpage/'.$data['pageID']);
				// return false;
				} else {
				   $classifiedpage['classified_created_by'] = $this->input->post('classified_created_by');
				}
                $slug = create_unique_slug( $classifiedpage['url_slag'],'tbl_classified_list','url_slag');
				$businessadd['url_slag'] = $slug;
			  	//$classifiedpage['url_slag'] = preg_replace('/[^A-Za-z0-9\-]/', '-', str_replace('', '-', $this->input->post('classified_created_by'))); // Removes special chars. 

                 $this->image_upload($classifiedpage['classified_created_by'],$data['pageID']);
				
				$where = array('classified_id' => $data['pageID']);
		  	    $inserted = $this->model->update('tbl_classified_list', $classifiedpage, $where);
				if($inserted){
			  		$this->session->set_flashdata('success', 'The classified has been successfully updated');
			  		redirect('administrator/classifiedslist');
			  	}
			
		} 	  
		
}

/**
	 * Classifieds Add Page for this controller.
	 */

public function addclassifiedpage(){
	   $info=$this->session->all_userdata();
		$data['userinfo']=$info;
		//print_r($data['userinfo']);
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],11);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		if (isset($result)) {
		  	if($result[0]->permission_id == 11){
		  		if($result[0]->add_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		}
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');	 
		$data['active_tab_classifieds'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['catList'] =  $this->model->get_data_order_by('*', 'tbl_classified_cat_master', array('classified_cat_status' => 1), 'classified_sort_order, classified_cat_name','ASC');
		
		$data['basesegment']= $this->uri->segment(2);
		$data['segment']= $this->uri->segment(3);
		$data['user_id'] = $this->data['user_id'];	  
		$data['title'] = 'Add Classifieds';	
		if($this->form_validation->run('classifiedsadd') == FALSE) {
		
			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/classifieds/classified',$data);
			$this->load->view('administrator/include/inner_footer');	

		} else {
                $classifiedpage['classified_ads'] = $this->input->post('classified_ads');
				$classifiedpage['classified_type'] = $this->input->post('classified_type');
			  	$classifiedpage['classified_description'] = $this->input->post('classified_description');
			  	$classified_state = $this->input->post('classified_state');
			  	if(isset($classified_state) && !empty($classified_state)){
                        $classifiedpage['classified_state'] = $this->input->post('classified_state');
						$latlong = $this->get_lat_long($classifiedpage['classified_state']);
						$classifiedpage['classified_lat'] = $latlong['lat'];
						$classifiedpage['classified_lang'] = $latlong['lng'];
			  	}
			  	$classifiedpage['classified_price']= $this->input->post('classified_price');
			  	$classifiedpage['classified_created_by'] = $this->input->post('classified_created_by');
		       // $classifiedpage['url_slag'] = preg_replace('/[^A-Za-z0-9\-]/', '-', str_replace('', '-', $this->input->post('classified_created_by'))); // Removes special chars.
			  	$slug = create_unique_slug( $classifiedpage['url_slag'],'tbl_classified_list','url_slag');
				$businessadd['url_slag'] = $slug;
			  	
				if($data['role'] == 3){
					$classifiedpage['user_ID'] = $data['u_id'];
					$classifiedpage['classified_created_user'] = 'sub admin';
				}else{
					$classifiedpage['user_ID'] =  $data['u_id'];
					$classifiedpage['classified_created_user'] = 'admin';
				}
			  	//$classifiedpage['classified_created_user'] = 'admin';

				 $image_path='';
				 $inserted = $this->model->insert_data('tbl_classified_list',$classifiedpage);
				 $clsID = $this->db->insert_id();
				 $this->image_upload($classifiedpage['classified_created_by'],$clsID);
				/*if(isset($_FILES)){
					$clsImage = $this->insertMultipleImage('classified_image', 'upload/classified_image/');
					if(isset($clsImage) && !empty($clsImage))
					{   
					   foreach($clsImage as $imagesG)
						{
							$clsadd['cls_id'] = $clsID;
							$clsadd['cls_imag']= $imagesG;
							$this->model->insert_data('tbl_classified_images',$clsadd);
						}
					}else{
                            $this->db->delete('tbl_classified_list', array('classified_id'=>$clsID));
					}
				}*/
			//Insert into tbl_business_master table
				
				if($inserted){
					$this->session->set_flashdata('success', 'The Classified is Successfully Added');
					 redirect(base_url().'administrator/classifiedslist');
				}
		
		} 	  
		
}

/**
	 * Classified expiration  Duration Page for this controller.
	 */
function classified_expiration_duration() 
{
	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;	
	if($data['u_id'] != 1){	
		if(isset($data['userinfo']['admin_siterole'])){
			if($data['userinfo']['admin_siterole'] == 3){
				redirect(base_url().'access_denied');
		    }
	    }
	}
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	$data['title'] = 'Admin | Classified category';
	$data['active_tab_classifieds'] = 'active';
	$data['role'] = $this->data['siterole_id'];
	$data['segment'] = $this->uri->segment(4);
	$data['classifiedDetail'] = $this->model->get_data('*', 'tbl_classified_ex_duration', array('cl_ex_id'=>1));
	if($data['segment'] == 'duration') {
		if($this->form_validation->run('classified_expiration') == FALSE) {

			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/classifieds/classified_expiration',$data);
			$this->load->view('administrator/include/inner_footer');

		} else {			
			$classifiedex['cl_ex_time'] = $this->input->post('cl_ex_time');
			$classifiedex['cl_ex_update_date'] =date("Y-m-d h:i:s");
			$where= array('cl_ex_id'=>1);			
			$update = $this->model->update('tbl_classified_ex_duration',$classifiedex,$where);
			if($update){
				$this->session->set_flashdata('success', 'The classified expiration duration update successfully');
				redirect(base_url().'administrator/classifieds/expiration/duration');
			}
		} 
	} 	
}





/**
	 * Classified Cat Page for this controller.
	 */
function classifiedcat() 
{
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;
	//print_r($data['userinfo']);
	$data['u_id'] = $this->data['user_id'];
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],10);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');

	$data['title'] = 'Admin | Classified category';
	$data['active_tab_classifieds'] = 'active';
	$data['role'] = $this->data['siterole_id'];
	$data['segment'] = $this->uri->segment(3);
	

	if($data['segment'] == 'addclassifiedscat') {
		 if (isset($result)) {
		  	if($result[0]->permission_id == 10){
		  		if($result[0]->add_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		 }
		if($this->form_validation->run('addclassifiedscat') == FALSE) {

			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/classifieds_cat/classifieds_add_category',$data);
			$this->load->view('administrator/include/inner_footer');

		} else {
			
			$classifiedcat['classified_cat_name'] = $this->input->post('classified_cat_name');
			if($data['role'] == 3){
				$classifiedcat['user_ID'] = $data['u_id'];
				$classifiedcat['classified_created_user'] = 'sub admin';
			}else{
				$classifiedcat['user_ID'] =  $data['u_id'];
				$classifiedcat['classified_created_user'] = 'admin';
			}
			
			//Insert into tbl_trail_master table
			$inserted = $this->model->insert_data('tbl_classified_cat_master',$classifiedcat);
			if($inserted){
				$this->session->set_flashdata('success', 'The classified category is Successfully add');
				redirect(base_url().'administrator/classifieds/classifiedcatlist');
			}

		} 
	} else if($data['segment'] == 'editclassifiedscat') {
		 if (isset($result)) {
		  	if($result[0]->permission_id == 10){
		  		if($result[0]->edit_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		 }
		$data['classifiedscatID']= $this->uri->segment(4);
	    $data['classifiedDetail'] = $this->model->get_data('*', 'tbl_classified_cat_master', array('classified_cat_id'=>$data['classifiedscatID']));
	    $classified_cat_name = $data['classifiedDetail'][0]->classified_cat_name;
		if($this->form_validation->run('editclassifiedscat') == FALSE) {


			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/classifieds_cat/classifieds_add_category',$data);
			$this->load->view('administrator/include/inner_footer');

		} else {
			
			$edittrail['classified_cat_name'] = $this->input->post('classified_cat_name');
			$edittrail['last_modify_user_id'] = $data['u_id'];
            $edittrail['last_modify_date'] = date("Y-m-d");

			$where= array('classified_cat_id'=>$data['classifiedscatID']);
			
			$update = $this->model->update('tbl_classified_cat_master',$edittrail,$where); 
			
			$edittrail1['classified_type'] = $this->input->post('classified_cat_name');

			$where1= array('classified_type'=>$classified_cat_name);
			
			$update = $this->model->update('tbl_classified_list',$edittrail1,$where1); 
			if($update){
				$this->session->set_flashdata('success', 'The classified category has been successfully updated');
				redirect(base_url().'administrator/classifieds/classifiedcatlist');
			}

		}
		
		
	}
	else if($data['segment'] == 'classifiedcatlist'){
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],10);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['classifiedcatlist'] = $this->model->get_all_order_by('*', 'tbl_classified_cat_master','classified_cat_created_date','DESC');
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/classifieds_cat/classifieds_category',$data);
		$this->load->view('administrator/include/inner_footer');

	}

}

/**
	 *  GET LAT & LONG FROM ADDRESS
	 */
   function get_lat_long($address){

    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
    $json = json_decode($json);

    if((isset($json)) && ($json->{'status'} == "OK")){


     $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}; 
     $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}; 
    
    }else{
      $lat = -25.274398; 
      $long = 133.775136; 
    }
    
    $response = array('lat'=>$lat,'lng'=>$long);
    return $response;

}



/********************multiple image upload**********************************/

function insertMultipleImage($imgName, $fld)
{
	$imgpth = array();

	if(isset($_FILES[''.$imgName.'']['name'])){
	
		for($k = 0; $k < count($_FILES[''.$imgName.'']['name']); $k++)
		{
			if($_FILES[''.$imgName.'']['error'][$k] == 0)
			{
				$filename  = basename($_FILES[''.$imgName.'']['name'][$k]);

				$extension = pathinfo($filename, PATHINFO_EXTENSION);
				$string = str_replace(' ', '-',$filename); // Replaces all spaces with hyphens.

				$nameFile = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
				$image_name     = time().$nameFile.'.'.$extension;
				$image_path = ''.$fld.''.$image_name;

				if($extension == 'gif' || $extension == 'jpg' || $extension == 'png' || $extension == 'jpeg' || $extension == 'BMP' || $extension == 'TIFF' || $extension == 'GIF' || $extension == 'JPG' || $extension == 'PNG' || $extension == 'JPEG' || $extension == 'bnp' || $extension == 'tiff'){
				
					if(move_uploaded_file($_FILES[''.$imgName.'']['tmp_name'][$k] ,$image_path))
					{
					 $imgpth[] = $image_path;
					}
			    }
				
			}
	// $inserted2 = $this->model->insert_data(''.$table.'',$profile);
	  }
	
	}
	return $imgpth;
}


/* For classified image unlink */
	function classifiedImgUnlink()
	{
	//	print_r($_REQUEST);
		if(isset($_REQUEST['cls_img']))
		{
			$business_img = $_REQUEST['cls_img'];
			$img_id = $_REQUEST['cls_img_id'];
			$cls_id = $_REQUEST['cls_id'];
			$return =  $this->classifieddeleteImage($img_id, $business_img);
			$countcls = $this->model->get_data('*','tbl_classified_images', array('cls_id' =>  $cls_id));
			echo count($countcls);
		}
	} 
	function classifieddeleteImage($id,$path) {
   $this->db->delete('tbl_classified_images', array('cls_img_id' => $id));
    if($this->db->affected_rows() >= 1){
        if(unlink($path))
        return 1;
    } else {
        return 0;
    }
}

private function set_upload_options($image_path,$name)
{           $Path='./upload/classified_image/large/';
	    $Path_icon='./upload/classified_image/icon/';
	    $Path_thumb='./upload/classified_image/thumbnail/';   
//upload an image options
        $config = array();
	        $config['upload_path']    = $Path;
		$config['file_name'] = $image_path;
        $config['file_path'] = $Path.$image_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPEG';	
       // $config['max_size'] = '15000000';
       // $config['max_width'] = '3000'; /* max width of the image file */
       // $config['max_height'] = '2000'; /* max height of the image file */			
      return $config;
}


private function image_upload($category_name,$category_id){
if(!empty($_FILES['userfile']['name']) && strlen($_FILES['userfile']['name'][0])>0){
		$this->load->library('upload');

		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		for($i=0; $i<$cpt; $i++)
		{           
			$_FILES['userfile']['name']= $files['userfile']['name'][$i];
			$_FILES['userfile']['type']= $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']= $files['userfile']['size'][$i];    
           $image_num=$i+1;
			$category_name_img_name =str_replace(' ', '-', $category_name);
			$category_name_img_name=$time=$category_name_img_name.'-'.$image_num.'-'.time();
		   
			$path_parts = pathinfo($files['userfile']['name'][$i]);
			
			
			      $allowed =  array('jpg','gif','jpg','jpeg','png','JPEG');
				
					if(!in_array($path_parts['extension'],$allowed) ) {
					 return 'error';
					
					}
			
			$image_path = $category_name_img_name.'.'.$path_parts['extension'];
			
			$this->upload->initialize($this->set_upload_options($image_path,'userfile'));
			$this->upload->do_upload();
			$data1 =$this->upload->data();
			if($data1){
				 $Path='./upload/classified_image/large/';
                 $Path_icon='./upload/classified_image/icon/';
                 $Path_thumb='./upload/classified_image/thumbnail/';

				 $icon = $Path_icon.$data1['file_name'];
				resize_image($data1,$icon,60,60);
				
				$thumb = $Path_thumb.$data1['file_name'];
				resize_image($data1,$thumb,900,350);
				    $uploadData[$i]['cls_imag'] = 'upload/classified_image/thumbnail/'.$data1['file_name'];
					//$uploadData[$i]['date'] = date("Y-m-d H:i:s");
				    $uploadData[$i]['cls_id'] = $category_id;
				//die;
			}
			
		} 
		if(!empty($uploadData)){
         	//Insert file information into the database
			 $this->model->insertImage("tbl_classified_images", $uploadData);
			 
			}
	
		
}   
} 


	public function delete_cat()
    {


    	   $id1 = $this->input->post('del_id');
 		   $tablename = $this->input->post('tablename');
		
			$id=array('classified_id'=>$id1);
			$table='tbl_classified_images';
			$table1=$tablename;
			$dataunlikns = $this->model->get_all_where($table,array('cls_id'=>$id1));
            $Cat_delete = $this->model->delete($table1,$id);
           
			  if ($Cat_delete)
                {
					
					foreach($dataunlikns AS $dataunlikn)
					{

					$Path='./upload/classified_image/large/';
					$Path_icon='./upload/classified_image/icon/';
					
                    $icon = str_replace('upload/classified_image/thumbnail/','',$dataunlikn ->cls_imag);

					$Path=$Path.$icon;
					$Path_icon=$Path_icon.$icon;
					$Path_thumb=$dataunlikn ->cls_imag;
					unlink($Path);
					unlink($Path_icon);
					unlink($Path_thumb);
					}
					$this->model->delete($table,array('cls_id'=>$id1));
                   // $this->session->set_flashdata('msg_success', messages::DELETE_ITEM);
  
                }
                
             echo $i = 1;
           // return redirect('user/classifiedslist');

    }

}