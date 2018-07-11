<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() 
	{
		
		parent::__construct();
		$this->load->library('session');
		$info=$this->session->all_userdata();
		$this->load->library('session');
        $info=$this->session->all_userdata();
	    if(empty($info['user_id'])){
	           redirect(base_url());
	    }


        if(isset($info['siterole']))
		{
		
			if( ($info['siterole']==2))
			{
				$this->userId = $info['user_id'];
        	    if(isset($info['social_id'])){

        		$this->social_id = $info['social_id'];
        	   }
		        
			}else{
				redirect(base_url());
			}
			
		}

		
	    $this->load->library('email');
	    $this->load->library('form_validation');
	    $this->load->helper('url');
	    $this->load->helper('file');
		$this->load->model('model');
		//print_r($info);
        
		
	}

/*
   Show user dashboard page
 **/
	public function dashboard() 
	{
	    $data['user_id'] = $this->userId;
	    $data['basesegment']= $this->uri->segment(2);
	    $data['segment']= $this->uri->segment(1);
	    $data['pagetitle'] = 'User Dashboard';
	    $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));
	     $where = array('user_id'=>$data['user_id']);
	     $data['businessList'] = $this->model->get_data_order_by('*', 'tbl_vacation_list', $where,'vac_id','DESC');
	   
		$this->load->view('user/userdashboar', $data);
	}
/*
   Show user Profile page
 **/
	public function profile() 
	{
	    $data['user_id'] = $this->userId;
	    $data['basesegment']= $this->uri->segment(2);
	    $data['segment']= $this->uri->segment(1);
	    $data['userDetail'] = $this->model->get_row('tbl_user_master',array('user_id'=>$data['user_id']));
	   
	    $data['pagetitle'] = 'Profile';
	    $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));

		$this->load->view('user/profile', $data);
	}
   public function profile_img_upload()
   {
    
    $data['user_id'] = $this->userId;
    $data['userDetail'] = $this->model->get_row('tbl_user_master',array('user_id'=>$data['user_id']));
    $oldImagePath = $data['userDetail']->profile_picture;

    if((!empty($_FILES["pro_image"])) && isset($_FILES['pro_image']['name']))  					   
	    {
			if($_FILES['pro_image']['error']==0)
			{
				$filename  = basename($_FILES['pro_image']['name']);
				$extension = pathinfo($filename, PATHINFO_EXTENSION);
				$image_name     = time().'.'.$extension;
				$image_path = 'upload/profile_image/'.$image_name;
				$personalDetail['profile_picture']=$image_path;
				if(isset($oldImagePath)){
					unlink($oldImagePath);
				}
				move_uploaded_file($_FILES['pro_image']['tmp_name'] ,$image_path);
			}
		}
		
        $condition =  array('user_id' => $data['user_id']);
		$update = $this->model->update('tbl_user_master',$personalDetail,$condition);
		//if($update)
		if($update)
		{
			if(!empty($personalDetail['profile_picture'])){
				$responce = array('profile_picture'=>base_url($personalDetail['profile_picture']));
			}
			print_r(json_encode($responce ));

		}
		else{
			echo 0;
		}
    }
/*
   Edit Personal detail for Profile Page
 **/
	public function editPersonalDatail()
	{
      
		$data['user_id'] = $this->userId;
		$data['segment']= $this->uri->segment(1);
		$personalDetail['fname'] = $this->input->post('fname');
		$personalDetail['lname'] = $this->input->post('lname');
		$personalDetail['address'] = $this->input->post('address');
		$personalDetail['gender'] = $this->input->post('gender');
		$personalDetail['dob'] = $this->input->post('dob');
		$personalDetail['contact_no'] = $this->input->post('contact_no');
		$personalDetail['occupation'] = $this->input->post('occupation');
		

		/*if((!empty($_FILES["pro_image"])) && isset($_FILES['pro_image']['name']))  					   
	    {
			if($_FILES['pro_image']['error']==0)
			{
				$filename  = basename($_FILES['pro_image']['name']);
				$extension = pathinfo($filename, PATHINFO_EXTENSION);
				$image_name     = time().'.'.$extension;
				$image_path = 'upload/profile_image/'.$image_name;
				$personalDetail['profile_picture']=$image_path;
				if(isset($oldImagePath)){
					unlink($oldImagePath);
				}
				move_uploaded_file($_FILES['pro_image']['tmp_name'] ,$image_path);
			}
		} */
			
		$condition =  array('user_id' => $data['user_id']);

		$update = $this->model->update('tbl_user_master',$personalDetail,$condition);
		if($update){
			/*if(!empty($personalDetail['profile_picture'])){
				$responce = array('fname'=>$personalDetail['fname'],'lname'=>$personalDetail['lname'], 'address'=>$personalDetail['address'], 'profile_picture'=>base_url($personalDetail['profile_picture']));
			}else{*/

				$responce = array('fname'=>$personalDetail['fname'],'lname'=>$personalDetail['lname'], 'address'=>$personalDetail['address']);

			//}
			

     	    print_r(json_encode($responce ));

		}
		else{
			echo 0;
		}

	} 
/* 
For Change Passwod  Method
  **/

	public function changepassword()

	{
		
        $data['user_id'] = $this->userId;
        $data['segment']= $this->uri->segment(1);
		$data['old_pswd'] = base64_encode($this->input->post('current_password'));

		$data['new_pswd'] = base64_encode($this->input->post('first_password'));
			

			$array = array('user_id' => $data['user_id'], 'password' => $data['old_pswd'] );

			$check_old_pswd = $this->model->getMultiple('tbl_user_master',$array);
			
             if(empty($check_old_pswd)){
	           
				$this->session->set_flashdata('msg_error', 'Incorrect old password !!');

				redirect(base_url().'user/profile');

		    }

			
			if($this->model->edit('tbl_user_master','user_id',array('password' => $data['new_pswd']),$data['user_id'])){
	    
	    	$this->session->set_flashdata('msg_success', 'Your password has been successfully changed');

			}else{

				$this->session->set_flashdata('msg_error', 'You didn`t have any changes !!');

			}

			redirect(base_url().'user/profile');

		
	}
/*
   Show user Add Business page
 **/
	public function businesslist() 
	{
	    $data['user_id'] = $this->userId;
	    $data['segment']= $this->uri->segment(1);
	    $data['dasesegment'] = $this->uri->segment(2);
	    $data['routeList'] = $this->model->get_data('*', 'tbl_route_master', array('route_status'=>1));
	    $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));
   	
	    if($data['dasesegment'] == 'addbusiness'){

           $data['pagetitle'] = 'Add Business';

           if($this->input->is_ajax_request()){

				$businessadd['user_id'] = $this->userId;
				$businessadd['route_id'] = $this->input->post('route_id');
				$business_id = $this->input->post('business_id');
				//$data['business_id'] = $this->uri->segment(3);
				$businessadd['business_name'] = $this->input->post('business_name');
				$businessadd['business_type'] = $this->input->post('business_type');
				$businessadd['business_description'] = $this->input->post('business_description');
				$businessadd['business_contant_no'] = $this->input->post('business_contant_no');
				$businessadd['business_address'] = $this->input->post('business_address');
				$businessadd['business_created_by'] = 'user';
				/***********GET LAT LONG************/

				$latlong = $this->get_lat_long($businessadd['business_address']);
				$businessadd['business_lat'] = $latlong['lat'];
				$businessadd['business_lang'] = $latlong['lng'];

				/***********GET LAT LONG************/

				/********Uplaod Business Image******/
				if((!empty($_FILES["bus_image"])) && isset($_FILES['bus_image']['name']))  					   
			    {
					if($_FILES['bus_image']['error']==0)
					{
						$filename  = basename($_FILES['bus_image']['name']);
						$extension = pathinfo($filename, PATHINFO_EXTENSION);
						$image_name     = time().'.'.$extension;
						$image_path = 'upload/business_image/'.$image_name;
						$businessadd['business_image']=$image_path;
						move_uploaded_file($_FILES['bus_image']['tmp_name'] ,$image_path);
					}
				}
				/********Uplaod Business Image******/

				//Insert into tbl_business_master table
				$inserted = $this->model->insert_data('tbl_business_list',$businessadd);

				if($inserted){
				echo 1;
				}
				die;
				//redirect(base_url('product'));*/
				redirect(base_url().'user/businesslist');

			}
		    $this->load->view('user/businessListing/add_business', $data);

	    }else if($data['dasesegment'] == 'businesslist'){
	    	$data['pagetitle'] = ' Business List';

	    	$where= array('user_id' => $data['user_id'] );

	    	$data['businessList'] = $this->model->get_data_order_by('*', 'tbl_business_list',$where,'business_id','DESC');
	    	//print_r($data['businessList']);

		   $this->load->view('user/businessListing/businesslist', $data);

	    }
		//edit product
	    if($data['dasesegment'] == 'editbusiness') {
			
			$data['pagetitle'] = "Edit Business";
			$data['business_id'] = $this->uri->segment(3);
			
			$data['businessDetail'] = $this->model->get_row('tbl_business_list', array('business_id'=>$data['business_id']));	

			if($this->input->is_ajax_request()){
				$businessadd['route_id'] = $this->input->post('route_id');
				$business_id = $this->input->post('business_id');
				//$data['business_id'] = $this->uri->segment(3);
				$businessadd['business_name'] = $this->input->post('business_name');
				$businessadd['business_type'] = $this->input->post('business_type');
				$businessadd['business_description'] = $this->input->post('business_description');
				$businessadd['business_contant_no'] = $this->input->post('business_contant_no');
				$businessadd['business_address'] = $this->input->post('business_address');
				$businessadd['business_created_by'] = 'user';
				/***********GET LAT LONG************/

				$latlong = $this->get_lat_long($businessadd['business_address']);
				$businessadd['business_lat'] = $latlong['lat'];
				$businessadd['business_lang'] = $latlong['lng'];

				/***********GET LAT LONG************/

				//update into tbl_business_master table
				$inserted = $this->model->update('tbl_business_list', $businessadd, array('business_id'=>$business_id));

				if($inserted){
				echo 1;
				}
				die;
   
				redirect(base_url().'user/businesslist');
				   
			
			}
			$this->load->view('user/businessListing/add_business', $data);

		} else if($data['dasesegment'] == 'business'){

			$data['pagetitle'] = "Business Details";
			$data['business_id'] = $this->uri->segment(3);
			$data['businessDetail'] = $this->model->get_row('tbl_business_list', array('business_id'=>$data['business_id']));
			//print_r($data['businessDetail']);
			$data['routeDetail'] = $this->model->get_row('tbl_route_master', array('route_id'=>$data['businessDetail']->route_id));
			//print_r($data['routeDetail']);

			$this->load->view('user/businessListing/view_business', $data);
		}
	    
	    
	    
	}
	public function businessadd(){

		$businessadd['user_id'] = $this->userId;
		$data['segment']= $this->uri->segment(1);
		$data['dasesegment'] = $this->uri->segment(2);
		$businessadd['business_name'] = $this->input->post('business_name');
		$businessadd['business_type'] = $this->input->post('business_type');
		$businessadd['business_description'] = $this->input->post('business_description');
		$businessadd['business_contant_no'] = $this->input->post('business_contant_no');
		$businessadd['business_address'] = $this->input->post('business_address');
		$businessadd['business_created_by'] = 'user';
		/***********GET LAT LONG************/

        $latlong = $this->get_lat_long($businessadd['business_address']);
		$businessadd['business_lat'] = $latlong['lat'];
		$businessadd['business_lang'] = $latlong['lng'];

		/***********GET LAT LONG************/
		//Insert into tbl_business_master table
		$inserted = $this->model->insert_data('tbl_business_list',$businessadd);
		if($inserted){
			echo 1;
		}

	}


	/**
	 * Vacation Business for this controller.
	 */
function rentals() 
	 {
		 
		$data['pagetitle'] = 'Rentals Listing';
		$data['user_id'] = $this->userId;
		//$data['segment']= $this->uri->segment(1);
		$data['basesegment'] = $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
        //$data['businessList'] = $this->model->get_all_order_by('*', 'tbl_vacation_list','vac_id','DESC');
        $where = array('user_id'=>$data['user_id']);
        $data['businessList'] = $this->model->get_data_order_by('*', 'tbl_vacation_list', $where,'vac_id','DESC');
        $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));
      	if(($data['segment'] == 'add')){

			if($this->form_validation->run('addvacbusin') == FALSE) {
			$this->load->view('user/vacationListing/add_vac_business',$data);
			
		} else {
		
		        $businessadd['user_id'] = $data['user_id'];
			    $businessadd['vac_name'] = $this->input->post('vac_name');
				$businessadd['vac_type'] = $this->input->post('vac_type');
				$businessadd['vac_contact'] = $this->input->post('vac_contact');
				$businessadd['vac_email'] = $this->input->post('vac_email');
				$businessadd['vac_address'] = $this->input->post('vac_address');
				$businessadd['vac_description'] = $this->input->post('vac_description');
				$businessadd['vac_wedsite_url'] = $this->input->post('vac_wedsite_url');
				$businessadd['vac_price'] = $this->input->post('vac_price');
				$businessadd['vac_no_of_bedroom'] = $this->input->post('vac_no_of_bedroom');
				$businessadd['vac_bathroom'] = $this->input->post('vac_bathroom');
				$businessadd['vac_sleep'] = $this->input->post('vac_sleep');
				$businessadd['vac_created_by'] = 'user';
				
				$monthnew = 12;
				$datetime = new DateTime();
				$datetime->modify('+'.$monthnew.' months');
				$expiry_date = $datetime->format('Y-m-d H:i:s');
				$businessadd['vac_expiry_date'] = $expiry_date;
				/***********GET LAT LONG************/

				$latlong = $this->get_lat_long($businessadd['vac_address']);
				$businessadd['vac_lat'] = $latlong['lat'];
				$businessadd['vac_lang'] = $latlong['lng'];

				/***********GET LAT LONG************/
				 $image_path1='';
				 if((!empty($_FILES["vac_bus_logo"])) && isset($_FILES['vac_bus_logo']['name'])){
				  if($_FILES['vac_bus_logo']['error']==0)
				  {
				    $filename1  = basename($_FILES['vac_bus_logo']['name']);
				    $extension1 = pathinfo($filename1, PATHINFO_EXTENSION);

				     if($extension1 == 'gif' || $extension1 == 'jpg' || $extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'BMP' || $extension1 == 'TIFF' || $extension1 == 'GIF' || $extension1 == 'JPG' || $extension1 == 'PNG' || $extension1 == 'JPEG' || $extension1 == 'bnp' || $extension1 == 'tiff'){
				          $image_name1     = time().'.'.$extension1;
				    
				    $image_path1 = 'upload/business_image/vacational/logo/'.$image_name1;
				    $businessadd['vac_bus_logo']=$image_path1;
				    move_uploaded_file($_FILES['vac_bus_logo']['tmp_name'] ,$image_path1);
				            }else{
				              $this->session->set_flashdata('error', 'Please Upload only image');
				                redirect(base_url().'administrator/rentals');
				            }
				  
				   }
				  } 

				//Insert into tbl_business_master table
				$inserted = $this->model->insert_data('tbl_vacation_list',$businessadd);
				$vacID = $this->db->insert_id();
				
				if(isset($_FILES)){
					 $garageImage = $this->insertMultipleImage('vac_imag', 'upload/business_image/vacational/');
							
						if(isset($garageImage))
						{   
						   foreach($garageImage as $imagesG)
							{
								$vacbusadd['vac_id'] = $vacID;
								$vacbusadd['vac_imag']= $imagesG;
								$this->model->insert_data('tbl_vacation_list_images',$vacbusadd);
							}
						}


					}
				if($inserted){
					$this->session->set_flashdata('success', 'The Rental Business is Successfully Added');
					 redirect(base_url().'user/rentals');
				}
		
		      } 

			}else if(($data['segment'] == 'edit')){
			  $data['busID'] = $this->uri->segment(4);
			  $data['businessDetail'] = $this->model->get_row('tbl_vacation_list', array('vac_id'=>$data['busID']));
			  $data['busPhotos'] = $this->model->get_data('*','tbl_vacation_list_images', array('vac_id'=>$data['busID']));
	
			  if($this->form_validation->run('editvacbusin') == FALSE) {

			    $this->load->view('user/vacationListing/add_vac_business',$data);
			
		     } else {
		
		        $businessadd['user_id'] = $data['user_id'];
			    $businessadd['vac_name'] = $this->input->post('vac_name');
				$businessadd['vac_type'] = $this->input->post('vac_type');
				$businessadd['vac_contact'] = $this->input->post('vac_contact');
				$businessadd['vac_email'] = $this->input->post('vac_email');
				$businessadd['vac_address'] = $this->input->post('vac_address');
				$businessadd['vac_description'] = $this->input->post('vac_description');
				$businessadd['vac_wedsite_url'] = $this->input->post('vac_wedsite_url');
				$businessadd['vac_price'] = $this->input->post('vac_price');
				$businessadd['vac_no_of_bedroom'] = $this->input->post('vac_no_of_bedroom');
				$businessadd['vac_bathroom'] = $this->input->post('vac_bathroom');
				$businessadd['vac_sleep'] = $this->input->post('vac_sleep');
				$businessadd['vac_created_by'] = 'user';
				$businessadd['vac_update_date'] = date('Y-m-d H:i:s');
				$monthnew = 12;
				$datetime = new DateTime();
				$datetime->modify('+'.$monthnew.' months');
				$expiry_date = $datetime->format('Y-m-d H:i:s');
				$businessadd['vac_expiry_date'] = $expiry_date;
				/***********GET LAT LONG************/

				$latlong = $this->get_lat_long($businessadd['vac_address']);
				$businessadd['vac_lat'] = $latlong['lat'];
				$businessadd['vac_lang'] = $latlong['lng'];

				/***********GET LAT LONG************/
				 $image_path1='';
				 if((!empty($_FILES["vac_bus_logo"])) && isset($_FILES['vac_bus_logo']['name'])){
				  if($_FILES['vac_bus_logo']['error']==0)
				  {
				    $filename1  = basename($_FILES['vac_bus_logo']['name']);
				    $extension1 = pathinfo($filename1, PATHINFO_EXTENSION);

				     if($extension1 == 'gif' || $extension1 == 'jpg' || $extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'BMP' || $extension1 == 'TIFF' || $extension1 == 'GIF' || $extension1 == 'JPG' || $extension1 == 'PNG' || $extension1 == 'JPEG' || $extension1 == 'bnp' || $extension1 == 'tiff'){
				          $image_name1     = time().'.'.$extension1;
				    
				    $image_path1 = 'upload/business_image/vacational/logo/'.$image_name1;
				    $businessadd['vac_bus_logo']=$image_path1;
				    move_uploaded_file($_FILES['vac_bus_logo']['tmp_name'] ,$image_path1);
		            }else{
		              $this->session->set_flashdata('error', 'Please Upload only image');
		                redirect(base_url().'administrator/rentals');
		            }
				   }
				  } 

				  if(isset($_FILES)){
					 $garageImage = $this->insertMultipleImage('vac_imag', 'upload/business_image/vacational/');
							
						if(isset($garageImage))
						{   
						   foreach($garageImage as $imagesG)
							{
								$vacbusadd['vac_id'] =  $data['busID'];
								$vacbusadd['vac_imag']= $imagesG;
								$this->model->insert_data('tbl_vacation_list_images',$vacbusadd);
							}
						}
					}

			   //update into tbl_business_master table
				$where = array('vac_id' => $data['busID']);
		 	    $update = $this->model->update('tbl_vacation_list', $businessadd, $where);
				if($update){
					$this->session->set_flashdata('success', 'The Rental Business is Successfully update');
					 redirect(base_url().'user/rentals');
				}
		
		      } 


			}else if(($data['segment'] == 'view')){

	             $data['busID'] = $this->uri->segment(4);
	             $data['businessDetail'] = $this->model->get_row('tbl_vacation_list', array('vac_id'=>$data['busID']));
	             $data['businessImage'] = $this->model->get_data('*','tbl_vacation_list_images', array('vac_id'=>$data['busID']));

				 $this->load->view('user/vacationListing/view_vac_business',$data);

			}else{

				 $this->load->view('user/vacationListing/vac_businesslist',$data);
			}



	}

/**
	 * Selecte Packages.
	 */
	public function packages() 
	{
	    $data['user_id'] = $this->userId;
	    $data['segment']= $this->uri->segment(3);
	    $data['pagetitle'] = 'packages';
	    $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));
	    $data["packagesPlan"] = $this->model->get_all('*', 'plan_master');

	  
		 $this->load->view('user/vacationListing/selete_package',$data);
	}
/**
	 * Classifieds Add Page for this controller.
	 */
public function addclassified(){


	   $data['pagetitle'] = 'Add Classifieds';	
	   $data['catList'] = $this->model->get_all('*', 'tbl_classified_cat_master');
	   $data['segment']= $this->uri->segment(2);
	   $data['user_id'] = $this->userId;
	   $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));

		if($this->form_validation->run('classifiedsadd') == FALSE) {
		
		  $this->load->view('user/classifieds/add_classified',$data);	

		} else {

				$classifiedpage['classified_type'] = $this->input->post('classified_type');
			  	$classifiedpage['classified_description'] = $this->input->post('classified_description');
			  	$classifiedpage['classified_description'] = $this->input->post('classified_description');
			  	$classifiedpage['classified_created_by'] = $this->input->post('classified_created_by');
			  	$classifiedpage['classified_end_date'] = $this->input->post('classified_end_date');
			  	$classifiedpage['classified_start_date'] = $this->input->post('classified_start_date');
			  	$classifiedpage['user_ID'] =  $data['user_id'];
			  	$classifiedpage['classified_created_user'] = 'user';


			  	//$monthnew = 12;
				//$datetime = new DateTime();
				//$datetime->modify('+'.$monthnew.' months');
				//$expiry_date = $datetime->format('Y-m-d H:i:s');
				//$classifiedpage['classified_expire'] = $expiry_date;

				 $image_path='';
				 if((!empty($_FILES["classified_image"])) && isset($_FILES['classified_image']['name'])){
					if($_FILES['classified_image']['error']==0)
					{
						$filename  = basename($_FILES['classified_image']['name']);
						$extension = pathinfo($filename, PATHINFO_EXTENSION);

						 if($extension == 'gif' || $extension == 'jpg' || $extension == 'png' || $extension == 'jpeg' || $extension == 'BMP' || $extension == 'TIFF' || $extension == 'GIF' || $extension == 'JPG' || $extension == 'PNG' || $extension == 'JPEG' || $extension == 'bnp' || $extension == 'tiff'){
		            	$image_name     = time().'.'.$extension;
						
						$image_path = 'upload/classified_image/'.$image_name;
						$classifiedpage['classified_image']=$image_path;
						move_uploaded_file($_FILES['classified_image']['tmp_name'] ,$image_path);
		                }else{
		                	$this->session->set_flashdata('error', 'Please Upload only image');
		                    redirect(base_url().'user/addclassified');
		                }
					
					 }
					}

			
			//Insert into tbl_business_master table
				$inserted = $this->model->insert_data('tbl_classified_list',$classifiedpage);
				if($inserted){
					$this->session->set_flashdata('success', 'The Classified is Successfully Added');
					 redirect(base_url().'user/addclassified');
				}
		
		} 	  
		
}
/**
	 * Classifieds Edit Page for this controller.
	 */
public function editclassified(){


	   $data['pagetitle'] = 'Edit Classifieds';	
	   $data['segment']= $this->uri->segment(2);
	   $data['pageID']= $this->uri->segment(3);
	   $data['catList'] =  $this->model->get_all('*', 'tbl_classified_cat_master');
	   $data['classified'] = $this->model->get_row('tbl_classified_list',array('classified_id' => $data['pageID']));
	   $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));
	   $data['user_id'] = $this->userId;

		if($this->form_validation->run('classifiedsedit') == FALSE) {
		
		  $this->load->view('user/classifieds/add_classified',$data);	

		} else {

				$classifiedpage['classified_type'] = $this->input->post('classified_type');
			  	$classifiedpage['classified_description'] = $this->input->post('classified_description');
			  	$classifiedpage['classified_description'] = $this->input->post('classified_description');
			  	$classifiedpage['classified_created_by'] = $this->input->post('classified_created_by');
			  	$classifiedpage['classified_end_date'] = $this->input->post('classified_end_date');
			  	$classifiedpage['classified_start_date'] = $this->input->post('classified_start_date');
			  	$classifiedpage['user_ID'] =  $data['user_id'];
			  	$classifiedpage['classified_created_user'] = 'user';

				 $image_path='';
				 if((!empty($_FILES["classified_image"])) && isset($_FILES['classified_image']['name'])){
					if($_FILES['classified_image']['error']==0)
					{
						$filename  = basename($_FILES['classified_image']['name']);
						$extension = pathinfo($filename, PATHINFO_EXTENSION);

						 if($extension == 'gif' || $extension == 'jpg' || $extension == 'png' || $extension == 'jpeg' || $extension == 'BMP' || $extension == 'TIFF' || $extension == 'GIF' || $extension == 'JPG' || $extension == 'PNG' || $extension == 'JPEG' || $extension == 'bnp' || $extension == 'tiff'){
		            	$image_name     = time().'.'.$extension;
						
						$image_path = 'upload/classified_image/'.$image_name;
						$classifiedpage['classified_image']=$image_path;
						move_uploaded_file($_FILES['classified_image']['tmp_name'] ,$image_path);
		                }else{
		                	$this->session->set_flashdata('error', 'Please Upload only image');
		                    redirect(base_url().'user/editclassified/'.$data['pageID']);
		                }
					
					 }
					}

			
			$where = array('classified_id' => $data['pageID']);
	  	    $inserted = $this->model->update('tbl_classified_list', $classifiedpage, $where);
				if($inserted){
					$this->session->set_flashdata('success', 'The Classified is Successfully Added');
					 redirect(base_url().'user/editclassified/'.$data['pageID']);
				}
		
		} 	  
		
}


/**
	 * Classifieds List Page for this controller.
	 */
public function classifiedslist(){
		
	  $data['pagetitle'] = 'Classifieds List';
	  $data['user_id'] = $this->userId;
      $data['basesegment']= $this->uri->segment(2);
	  $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));

	  $where = array('user_ID' =>$data['user_id']);
	  $data['classifiedList'] = $this->model->get_data_order_by('*', 'tbl_classified_list',$where,'classified_id','DESC');
	  $this->load->view('user/classifieds/classified_list',$data);
}

/**
	 * Event for this controller.
	 */
function event() 
	 {
		 
		$data['pagetitle'] = 'Event ';
		$data['user_id'] = $this->userId;
		$data['basesegment']= $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
        $where = array('user_id' =>$data['user_id']);
        $data['eventList'] = $this->model->get_data_order_by('*', 'tbl_event',$where,'event_id','DESC');
        $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));
      	if(($data['segment'] == 'add')){

			if($this->form_validation->run('addevent') == FALSE) {
			$this->load->view('user/event/add_event',$data);
			
		} else {
		        $data['pagetitle'] = 'Add Event';
		        $eventadd['user_id'] = $data['user_id'];
			    $eventadd['event_title'] = $this->input->post('event_title');
				$eventadd['event_venue'] = $this->input->post('event_venue');
				$eventadd['venue_address'] = $this->input->post('venue_address');
				$eventadd['event_description'] = $this->input->post('event_description');
				$eventadd['event_date'] = $this->input->post('event_date');
				$eventadd['event_start_time'] = $this->input->post('event_start_time');
				$eventadd['event_end_time'] = $this->input->post('event_end_time');
				$eventadd['event_created_by'] = 'user';
				
				
				/***********GET LAT LONG************/

				$latlong = $this->get_lat_long($eventadd['venue_address']);
				$eventadd['event_lat'] = $latlong['lat'];
				$eventadd['event_lang'] = $latlong['lng'];


				//Insert into tbl_business_master table
				$inserted = $this->model->insert_data('tbl_event',$eventadd);
				$eventID = $this->db->insert_id();
				
				if(isset($_FILES)){
					 $garageImage = $this->insertMultipleImage('event_image', 'upload/event_images/');
							
						if(isset($garageImage))
						{   
						   foreach($garageImage as $imagesG)
							{
								$vacbusadd['event_id'] = $eventID;
								$vacbusadd['event_image_path']= $imagesG;
								$this->model->insert_data('tbl_event_image',$vacbusadd);
							}
						}


					}
				if($inserted){
					$this->session->set_flashdata('success', 'The Event is Successfully Added');
					 redirect(base_url().'user/event');
				}
		
		      } 

			}else if(($data['segment'] == 'edit')){
			  $data['eventID'] = $this->uri->segment(4);
			  $data['eventDetail'] = $this->model->get_row('tbl_event', array('event_id'=>$data['eventID']));
			  $data['eventPhotos'] = $this->model->get_data('*','tbl_event_image', array('event_id'=>$data['eventID']));
	
			  if($this->form_validation->run('editevent') == FALSE) {

			    $this->load->view('user/event/add_event',$data);
			
		     } else {
		        $data['pagetitle'] = 'Edit Event';
		        $eventadd['user_id'] = $data['user_id'];
			    $eventadd['event_title'] = $this->input->post('event_title');
				$eventadd['event_venue'] = $this->input->post('event_venue');
				$eventadd['venue_address'] = $this->input->post('venue_address');
				$eventadd['event_description'] = $this->input->post('event_description');
				$eventadd['event_date'] = $this->input->post('event_date');
				$eventadd['event_start_time'] = $this->input->post('event_start_time');
				$eventadd['event_end_time'] = $this->input->post('event_end_time');
				$eventadd['event_created_by'] = 'user';
				
				
				/***********GET LAT LONG************/

				$latlong = $this->get_lat_long($eventadd['venue_address']);
				$eventadd['event_lat'] = $latlong['lat'];
				$eventadd['event_lang'] = $latlong['lng'];


				/***********GET LAT LONG************/
				

				  if(isset($_FILES)){
					 $garageImage = $this->insertMultipleImage('vac_imag', 'upload/event_images/');
							
						if(isset($garageImage))
						{   
						   foreach($garageImage as $imagesG)
							{
								$vacbusadd['event_id'] =  $data['eventID'];
								$vacbusadd['event_image_path']= $imagesG;
								$this->model->insert_data('tbl_event_image',$vacbusadd);
							}
						}
					}

			   //update into tbl_business_master table
				$where = array('event_id' => $data['eventID']);
		 	    $update = $this->model->update('tbl_event', $eventadd, $where);
				if($update){
					$this->session->set_flashdata('success', 'The Event is Successfully update');
					 redirect(base_url().'user/event');
				}
		
		      } 


			}else if(($data['segment'] == 'view')){
                 $data['pagetitle'] = 'View Event';
	             $data['eventID'] = $this->uri->segment(4);
	             $data['eventDetail'] = $this->model->get_row('tbl_event', array('event_id'=>$data['eventID']));
	             $data['eventImage'] = $this->model->get_data('*','tbl_event_image', array('event_id'=>$data['eventID']));

				 $this->load->view('user/event/view_event',$data);

			}else{

				 $this->load->view('user/event/list_event',$data);
			}



	}
	/**
	 * news Page for this controller.
	 */
function news() 
	 {
		 
		$data['pagetitle'] = 'News';
		$data['user_id'] = $this->userId;
		$data['basesegment']= $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$where = array('user_id' => $data['user_id']);
		$data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));
		$data['newList'] = $this->model->get_data_order_by('*', 'tbl_news',$where,'news_id','DESC');
		
		if($data['segment'] == 'addnews') {
		
		if($this->form_validation->run('addnews') == FALSE) {
		
			$this->load->view('user/news/news_add',$data);

		} else {
		   
		    $news['user_id'] = $data['user_id'];
			$news['news_title'] = $this->input->post('news_title');
			$news['news_description'] = $this->input->post('news_description');
			$news['news_created_by'] = 'user';

			$image_path='';
			 if((!empty($_FILES["news_image"])) && isset($_FILES['news_image']['name']))  					             {
				if($_FILES['news_image']['error']==0)
				{
					$filename  = basename($_FILES['news_image']['name']);
					$extension = pathinfo($filename, PATHINFO_EXTENSION);

					 if($extension == 'gif' || $extension == 'jpg' || $extension == 'png' || $extension == 'jpeg' || $extension == 'BMP' || $extension == 'TIFF' || $extension == 'GIF' || $extension == 'JPG' || $extension == 'PNG' || $extension == 'JPEG' || $extension == 'bnp' || $extension == 'tiff'){
                	$image_name     = time().'.'.$extension;
					
					$image_path = 'upload/news_image/'.$image_name;
					$news['news_image']=$image_path;
					move_uploaded_file($_FILES['news_image']['tmp_name'] ,$image_path);
	                }else{
	                	$this->session->set_flashdata('error', 'Please Upload only image');
	                    redirect(base_url().'user/news/addnews');
	                }
				
				 }
				}

			
			//Insert into tbl_trail_cat_master table
			$inserted = $this->model->insert_data('tbl_news',$news);
			if($inserted){
				$this->session->set_flashdata('success', 'The News is Successfully Added');
				redirect(base_url().'user/news/newslist');
			}
		
		} 
	 } 
	 else if($data['segment'] == 'editnews') {
		   
		$data['newsId']= $this->uri->segment(4);
	    $data['newDetail'] = $this->model->get_data('*', 'tbl_news', array('news_id'=>$data['newsId']));

	   if($this->form_validation->run('editnews') == FALSE) {
		    
			$this->load->view('user/news/news_add',$data);
	
		} else {
			$news['user_id'] = $data['user_id'];
			$news['news_title'] = $this->input->post('news_title');
			$news['news_description'] = $this->input->post('news_description');
			$news['news_created_by'] = 'user';
            $news['news_update_date'] = date("Y-m-d,h:m:s");
			
			/***********GET Image************/

           $image_path='';
			 if((!empty($_FILES["news_image"])) && isset($_FILES['news_image']['name']))  					             {
				if($_FILES['news_image']['error']==0)
				{
					$filename  = basename($_FILES['news_image']['name']);
					$extension = pathinfo($filename, PATHINFO_EXTENSION);

					 if($extension == 'gif' || $extension == 'jpg' || $extension == 'png' || $extension == 'jpeg' || $extension == 'BMP' || $extension == 'TIFF' || $extension == 'GIF' || $extension == 'JPG' || $extension == 'PNG' || $extension == 'JPEG' || $extension == 'bnp' || $extension == 'tiff'){
                	$image_name     = time().'.'.$extension;
					
					$image_path = 'upload/news_image/'.$image_name;
					$news['news_image']=$image_path;
					move_uploaded_file($_FILES['news_image']['tmp_name'] ,$image_path);
	                }else{
	                	$this->session->set_flashdata('error', 'Please Upload only image');
	                    redirect(base_url().'user/news/addnews');
	                }
				
				 }
				}

			/***********GET Image************/

			$where= array('news_id'=>$data['newsId']);

			$update = $this->model->update('tbl_news',$news,$where);
			if($update){
				$this->session->set_flashdata('success', 'The news is Successfully update');
				redirect(base_url().'user/news/newslist');
			}
		
		}
		
		
	   }else if($data['segment'] == 'viewnews'){
        
        $data['newsId']= $this->uri->segment(4);
	    $data['newDetail'] = $this->model->get_data('*', 'tbl_news', array('news_id'=>$data['newsId']));
	    $this->load->view('user/news/view_news',$data);
	   }
	 else { 
			
	        $this->load->view('user/news/news',$data);
	       
		}
	}

function changeStatus(){
		//print_r($_POST);die;
	  
	    $id = $this->input->post('id');
		$status = $this->input->post('status');	
		$tablename = $this->input->post('tablename');

		/****************** tbl_trail_master********************/

		if($tablename == 'tbl_news'){
			$data=array('news_status'=>$status);
			$where=array('news_id'=> $id);
		}

       	$this->model->update($tablename, $data,$where); 
       	//echo $this->db->last_query();
		echo $i = $this->db->affected_rows();
        
    }


 /**
	 * Delete Table value for this controller.
	 */
    function deletefun()
 	{    
 		$id = $this->input->post('del_id');
 		$tablename = $this->input->post('tablename');
        /******************Delete business********************/

 		if($tablename == 'tbl_business_list'){
			$where=array('business_id'=> $id);
		}
		/******************Delete vacational business********************/

 		if($tablename == 'tbl_vacation_list'){
			$where=array('vac_id'=> $id);
			//$this->db->delete(' tbl_vacation_list_images',array('vac_id' =>$id));
		}
		/******************Delete classified********************/

 		if($tablename == 'tbl_classified_list'){
			$where=array('classified_id'=> $id);
		}

		/******************Delete news********************/

 		if($tablename == 'tbl_news'){
			$where=array('news_id'=> $id);
		}

		/******************Delete tbl_event********************/

 		if($tablename == 'tbl_event'){
			$where=array('event_id'=> $id);
			$where1=array('event_id'=> $id);
	        $this->db->delete('tbl_event_image', $where1); 

		}
		
		

       	$this->db->delete($tablename, $where); 
        echo $i = $this->db->affected_rows();
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


/* For business image unlink */

	function businessImgUnlink()
	{
	//	print_r($_REQUEST);
		if(isset($_REQUEST['business_img']))
		{
			$business_img = $_REQUEST['business_img'];
			$img_id = $_REQUEST['img_id'];
			$return =  $this->deleteImage($img_id, $business_img);

			$arr=array('a'=>$return);
			print_r(json_encode($arr));

		}

	} 

	function deleteImage($id,$path) {

    $this->db->delete('tbl_vacation_list_images', array('vac_img_id' => $id));

    if($this->db->affected_rows() >= 1){
        if(unlink($path))
        return 1;
    } else {
        return 0;
    }

}



/* For event image unlink */

	function eventImgUnlink()
	{
	//	print_r($_REQUEST);
		if(isset($_REQUEST['event_img']))
		{
			$event_img = $_REQUEST['event_img'];
			$event_id = $_REQUEST['event_id'];
			$return =  $this->eventdeleteImage($event_id, $event_img);

			$arr=array('a'=>$return);
			print_r(json_encode($arr));

		}

	} 

	function eventdeleteImage($id,$path) {

    $this->db->delete('tbl_event_image', array('event_img_id' => $id));

    if($this->db->affected_rows() >= 1){
        if(unlink($path))
        return 1;
    } else {
        return 0;
    }

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
				$image_path = ''.$fld.''.$filename;
				
				if(move_uploaded_file($_FILES[''.$imgName.'']['tmp_name'][$k] ,$image_path))
				{
				 $imgpth[] = $image_path;
				}
				
			}
	// $inserted2 = $this->model->insert_data(''.$table.'',$profile);
	  }
	
	}
	return $imgpth;
}

}// class close