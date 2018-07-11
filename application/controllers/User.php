<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() 
	{
		
		parent::__construct();
		$this->load->library('session');
		$info=$this->session->all_userdata();
		$this->load->helper('custom_helper');
		$this->load->helper('resize');
		    if(empty($info['user_id'])){
	           redirect(base_url());
	    }


        if(isset($info['siterole']))
		{
		
			if( ($info['siterole']==2) || ($info['siterole']==3))
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
		$where = array('user_id'=>$data['user_id']);
		$data['businessList'] = $this->model->get_data_order_by('*', 'tbl_vacation_list', $where,'vac_id','DESC');
		$data['routeList'] = $this->model->get_data_order_by('*', 'tbl_user_route_planning
		',$where,'URP_ID','DESC');
		$data['trailList'] = $this->model->get_data_order_by('*', 'tbl_trail_report',$where,'trail_report_id','DESC');
		$data['classifiedCount'] = $this->model->get_data_order_by('*', 'tbl_classified_list',array('user_ID'=>$data['user_id']),'classified_id','DESC');
		$where1 = array('userID' =>$data['user_id']);
		$data['trailReportList'] = $this->model->get_data_order_by('*', 'trail_report_user_update',$where1,'ID','DESC');

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

		$this->load->view('user/profile', $data);
	}
   public function profile_img_upload()
   {
    
    $data['user_id'] = $this->userId;
    $data['userDetail'] = $this->model->get_row('tbl_user_master',array('user_id'=>$data['user_id']));
    //$oldImagePath = $data['userDetail']->profile_picture;

    if((!empty($_FILES["pro_image"])) && isset($_FILES['pro_image']['name']))  					   
	    {
			if($_FILES['pro_image']['error']==0)
			{
				$filename  = basename($_FILES['pro_image']['name']);
				$extension = pathinfo($filename, PATHINFO_EXTENSION);
				$image_name     = time().'.'.$extension;
				$image_path = 'upload/profile_image/'.$image_name;
				$personalDetail['profile_picture']=$image_path;
				
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
		$condition =  array('user_id' => $data['user_id']);
		$update = $this->model->update('tbl_user_master',$personalDetail,$condition);
		if($update){
	
				$responce = array('fname'=>$personalDetail['fname'],'lname'=>$personalDetail['lname'], 'address'=>$personalDetail['address']);
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
        $data['packagesPlan'] = $this->model->get_data_order_by('*', 'plan_master',array('pl_status' => 1),'order, pl_name','ASC');
        $where = array('user_id'=>$data['user_id']);
        $data['businessList'] = $this->model->get_data_order_by('*', 'tbl_vacation_list', $where,'vac_id','DESC');
        $data['stateList'] = $this->model->get_all('*', 'tbl_state');
        $data["propertyList"] = $this->model->get_data('*', 'advance_filter_fields', array('status' => 1));
      	if(($data['segment'] == 'add')){
      		$data['pagetitle'] = 'Add Rentals';
        	if($this->form_validation->run('addvacbusin') == FALSE) {
			$this->load->view('user/vacationListing/add_vac_business',$data);
			
		} else {
		
		        /*$businessadd['user_id'] = $data['user_id'];
		        $businessadd['trail_id'] = 'Lodging';
			    $businessadd['vac_name'] = $this->input->post('vac_name');
			    $slug = create_unique_slug( $businessadd['vac_name'],'tbl_vacation_list','vac_slag');
				$businessadd['vac_slag'] = $slug;
			    $businessadd['pl_id'] = $this->input->post('plan_id');
				$businessadd['vac_type'] = $this->input->post('vac_type');
				$businessadd['vac_contact'] = $this->input->post('vac_contact');
				$businessadd['vac_email'] = $this->input->post('vac_email');
				$businessadd['vac_address'] = $this->input->post('vac_address');
				$businessadd['vac_weekly_rate'] = $this->input->post('vac_weekly_rate');
				$businessadd['vac_zip_code'] = $this->input->post('vac_zip_code');
				$businessadd['vac_city'] = $this->input->post('vac_city');
				$businessadd['vac_wedsite_url'] = $this->input->post('vac_wedsite_url');
				$businessadd['vac_no_of_bedroom'] = $this->input->post('vac_no_of_bedroom');
				$businessadd['vac_bathroom'] = $this->input->post('vac_bathroom');
				$businessadd['vac_sleep'] = $this->input->post('vac_sleep');
				$businessadd['vac_price'] = $this->input->post('vac_price');
				$businessadd['vac_location_type'] = $this->input->post('vac_location_type');
			    $businessadd['vac_floor_area'] = $this->input->post('vac_floor_area');
				$businessadd['vac_description'] = $this->input->post('vac_description');
				$amenities = $this->input->post('vac_amenities');
                $businessadd['adv_filter_fields']=implode(",", $amenities);
				$businessadd['vac_created_by'] = 'user';
				
				$businessadd['vac_lat'] = $this->input->post('pro_add_lat');
				$businessadd['vac_lang'] = $this->input->post('pro_add_lng');
				//Insert into tbl_business_master table
				$inserted = $this->model->insert_data('tbl_vacation_list',$businessadd);
				$vacID = $this->db->insert_id();
				$this->image_upload_rental($businessadd['vac_name'],$vacID);
				
				if($inserted){
					$this->session->set_flashdata('success', 'The Rental Business is Successfully Added');

					$getUserId = $this->model->get_row('tbl_vacation_list', array('vac_id' => $vacID));
					$userID = $getUserId->user_id;
					$plan_ID = $getUserId->pl_id;
					$planDetail = $this->model->get_row('plan_master', array('pl_id' => $plan_ID));
					$planDetail->pl_price;
					if($planDetail->pl_price !=0){

						$getUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $userID));
						$userName = $getUserEmail->fname;
					    $row1 =  $this->model->get_row('email_templates',array('title'=>'RentalListingSubmission'));
						$subject = $row1->subject;
						$message = $row1->content;
						$pageLike = base_url().'lodging/'.$businessadd['vac_slag'];
						$message = str_replace("{username}",ucfirst($userName),$message);
						$message = str_replace("{rental_property_name}",ucfirst($businessadd['vac_name']),$message);
			            $message = str_replace("{page_link}",$pageLike,$message);
						$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
						$this->sendingMail($getUserEmail->email ,$subject, $message);
						

					}
					$anotify['n_type_id'] = $vacID;
					$anotify['user_id'] = $data['user_id'];
					$anotify['n_type'] = 'add_rental';
					$anotify['n_date'] = date('Y-m-d h:i:s');
					$this->model->insert_data('tbl_notification',$anotify);
					if(isset($businessadd['pl_id'])){
                    	$result = $this->model->get_row('plan_master',array('pl_id' => $businessadd['pl_id']));
                    	if($result->pl_price != 0){
                    		redirect(base_url().'user/rentals/preview/'.$vacID);
                    	}else{
                    		redirect(base_url().'user/rentals/view/'.$vacID);
                    	}
                    }
					
				}
		
		      } */

			}
		}else if(($data['segment'] == 'edit')){
				//echo phpinfo();
				//die;
			  $data['busID'] = $this->uri->segment(4);
			  $data['updateList']= $this->model->get_row('tbl_vacation_list', array('vac_id'=>$data['busID']));
			  if($data['updateList']->update_status == 1){

                 $data['businessDetail'] = $this->model->get_row('tbl_update_vacation_list', array('vac_id'=>$data['busID']));
			  }else{
                 $data['businessDetail'] = $this->model->get_row('tbl_vacation_list', array('vac_id'=>$data['busID']));
			  }

			  $data['busPhotos'] = $this->model->get_data('*','tbl_vacation_list_images', array('vac_id'=>$data['busID']));
	
			  if($this->form_validation->run('editvacbusin') == FALSE) {

			    $this->load->view('user/vacationListing/add_vac_business',$data);
			
		     } else {
		
		       /* $businessadd['user_id'] = $data['user_id'];
		        $businessadd['trail_id'] = 'Lodging';
		        $businessadd['pl_id'] = $this->input->post('plan_id');
			    $businessadd['vac_name'] = $this->input->post('vac_name');
			   // $businessadd['vac_slag'] = preg_replace('/[^A-Za-z0-9\-]/', '-', str_replace('', '-', $this->input->post('vac_name')));

			    $slug = create_unique_slug( $businessadd['vac_name'],'tbl_vacation_list','vac_slag');
				$businessadd['vac_slag'] = $slug;

				$businessadd['vac_type'] = $this->input->post('vac_type');
				$businessadd['vac_contact'] = $this->input->post('vac_contact');
				$businessadd['vac_email'] = $this->input->post('vac_email');
				$businessadd['vac_address'] = $this->input->post('vac_address');
				$businessadd['vac_weekly_rate'] = $this->input->post('vac_weekly_rate');
				$businessadd['vac_zip_code'] = $this->input->post('vac_zip_code');
				$businessadd['vac_city'] = $this->input->post('vac_city');
				//$businessadd['state_name'] = $this->input->post('vac_state');
				$businessadd['vac_wedsite_url'] = $this->input->post('vac_wedsite_url');
				$businessadd['vac_no_of_bedroom'] = $this->input->post('vac_no_of_bedroom');
				$businessadd['vac_bathroom'] = $this->input->post('vac_bathroom');
				$businessadd['vac_sleep'] = $this->input->post('vac_sleep');
				$businessadd['vac_price'] = $this->input->post('vac_price');
				$businessadd['vac_location_type'] = $this->input->post('vac_location_type');
			    $businessadd['vac_floor_area'] = $this->input->post('vac_floor_area');
				$businessadd['vac_description'] = $this->input->post('vac_description');
				$amenities = $this->input->post('vac_amenities');
                $businessadd['adv_filter_fields']=implode(",", $amenities);
				$businessadd['vac_created_by'] = 'user';
				$businessadd['vac_update_date'] = date('Y-m-d H:i:s');
				$businessadd['vac_lat'] = $this->input->post('pro_add_lat');
				$businessadd['vac_lang'] = $this->input->post('pro_add_lng');
				

				
				$this->image_upload_rental($businessadd['vac_name'],$data['busID']);
			
				// 26-05-2018  $where = array('vac_id' => $data['busID']);
		 	    // 26-05-2018  $update = $this->model->update('tbl_vacation_list', $businessadd, $where);
                $checkstatus = $this->model->get_row('tbl_vacation_list', array('vac_id' => $data['busID']));
                if($checkstatus->vac_status == 1){
		 	    $getclonedata = $this->model->get_row('tbl_update_vacation_list', array('vac_id' => $data['busID']));
		 	    $businessadd['vac_id'] = $data['busID'];
		 	    if(!empty($getclonedata)){
		 	      $this->model->delete('tbl_update_vacation_list', array('vac_id' => $data['busID']));
		 	    }
		 	    $update = $this->model->insert_data('tbl_update_vacation_list',$businessadd);
		 	    $update = $this->model->update('tbl_vacation_list', array('update_status' => 1), array('vac_id' => $data['busID']));

		 	     $query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=14");
					$subAdminEmail = $query->result();
                    
					if(isset( $subAdminEmail)){
                    	foreach ($subAdminEmail as $semail) {

		                    $row1 =  $this->model->get_row('email_templates',array('title'=>'UpdatedRentalSubmission'));
							$subject = $row1->subject;
							$message = $row1->content;
							$message = str_replace("{username}",ucfirst($semail->fname),$message);
							$message = str_replace("{user_email_address}",$semail->email,$message);
							$message = str_replace("{rental_property_name}",$businessadd['vac_name'],$message);
							$this->sendingMail($semail->email,$subject, $message);

                        }
                    }
                    $query = $this->db->query("SELECT fname,email,user_id from tbl_user_master WHERE siterole_id =1 AND user_id=1");
                    $adminEmail = $query->result();
                    $row1 =  $this->model->get_row('email_templates',array('title'=>'UpdatedRentalSubmission'));
					$subject = $row1->subject;
					$message = $row1->content;
					$message = str_replace("{username}",ucfirst($adminEmail->fname),$message);
					$message = str_replace("{user_email_address}",$adminEmail->email,$message);
					$message = str_replace("{rental_property_name}",$businessadd['vac_name'],$message);
					$this->sendingMail($adminEmail->email, $subject, $message);

		 	   
                }else{
                	$where = array('vac_id' => $data['busID']);
		 	        $update = $this->model->update('tbl_vacation_list', $businessadd, $where);
                }

				if($update){
					 if(isset($businessadd['pl_id'])){
                    	$result = $this->model->get_row('plan_master',array('pl_id' => $businessadd['pl_id']));
                    	if($result->pl_price != 0){
                    		redirect(base_url().'user/rentals/preview/'.$data['busID']);
                    	}else{
                    		
                    		$this->session->set_flashdata('success', 'You have successfully updated your listing.');
					        redirect(base_url().'user/rentals');
                    	}
                    }
				}*/
		
		      } 


			}else if(($data['segment'] == 'view')){

	             $data['busID'] = $this->uri->segment(4);
	             $data['businessDetail'] = $this->model->get_row('tbl_vacation_list', array('vac_id'=>$data['busID']));
	             $data['businessImage'] = $this->model->get_data('*','tbl_vacation_list_images', array('vac_id'=>$data['busID']));

				 $this->load->view('user/vacationListing/view_vac_business',$data);

			}
			else if(($data['segment'] == 'preview')){

	             $data['busID'] = $this->uri->segment(4);
	             $data['businessDetail'] = $this->model->get_row('tbl_vacation_list', array('vac_id'=>$data['busID']));
	             $data['businessImage'] = $this->model->get_data('*','tbl_vacation_list_images', array('vac_id'=>$data['busID']));

				 $this->load->view('user/vacationListing/preview_vac_business',$data);

			}

			else{

				 $this->load->view('user/vacationListing/vac_businesslist',$data);
			}



	}


	function rental_submit(){

		        $data['user_id'] = $this->userId;
		        $businessadd['user_id'] = $data['user_id'];
		        $businessadd['trail_id'] = 'Lodging';
			    $businessadd['vac_name'] = $this->input->post('vac_name');
			    $slug = create_unique_slug( $businessadd['vac_name'],'tbl_vacation_list','vac_slag');
				$businessadd['vac_slag'] = $slug;
			    $businessadd['pl_id'] = $this->input->post('plan_id');
				$businessadd['vac_type'] = $this->input->post('vac_type');
				$businessadd['vac_contact'] = $this->input->post('vac_contact');
				$businessadd['vac_email'] = $this->input->post('vac_email');
				$businessadd['vac_address'] = $this->input->post('vac_address');
				$businessadd['vac_weekly_rate'] = $this->input->post('vac_weekly_rate');
				$businessadd['vac_zip_code'] = $this->input->post('vac_zip_code');
				$businessadd['vac_city'] = $this->input->post('vac_city');
				$businessadd['state_name'] = $this->input->post('vac_state');
				$businessadd['vac_wedsite_url'] = $this->input->post('vac_wedsite_url');
				$businessadd['vac_no_of_bedroom'] = $this->input->post('vac_no_of_bedroom');
				$businessadd['vac_bathroom'] = $this->input->post('vac_bathroom');
				$businessadd['vac_sleep'] = $this->input->post('vac_sleep');
				$businessadd['vac_price'] = $this->input->post('vac_price');
				$businessadd['vac_location_type'] = $this->input->post('vac_location_type');
			    $businessadd['vac_floor_area'] = $this->input->post('vac_floor_area');
				$businessadd['vac_description'] = $this->input->post('vac_description');
				$amenities = $this->input->post('vac_amenities');
                $businessadd['adv_filter_fields']=implode(",", $amenities);
				$businessadd['vac_created_by'] = 'user';
				
				$businessadd['vac_lat'] = $this->input->post('pro_add_lat');
				$businessadd['vac_lang'] = $this->input->post('pro_add_lng');
				//Insert into tbl_business_master table
				$inserted = $this->model->insert_data('tbl_vacation_list',$businessadd);
				$vacID = $this->db->insert_id();
				$this->image_upload_rental($businessadd['vac_name'],$vacID);
				
				if($inserted){
					$this->session->set_flashdata('success', 'The Rental Business is Successfully Added');

					$getUserId = $this->model->get_row('tbl_vacation_list', array('vac_id' => $vacID));
					$userID = $getUserId->user_id;
					$plan_ID = $getUserId->pl_id;
					$planDetail = $this->model->get_row('plan_master', array('pl_id' => $plan_ID));
					$planDetail->pl_price;
					if($planDetail->pl_price !=0){

						$getUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $userID));
						$userName = $getUserEmail->fname;
					    $row1 =  $this->model->get_row('email_templates',array('title'=>'RentalListingSubmission'));
						$subject = $row1->subject;
						$message = $row1->content;
						$pageLike = base_url().'lodging/'.$businessadd['vac_slag'];
						$message = str_replace("{username}",ucfirst($userName),$message);
						$message = str_replace("{rental_property_name}",ucfirst($businessadd['vac_name']),$message);
			            $message = str_replace("{page_link}",$pageLike,$message);
						$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
						$this->sendingMail($getUserEmail->email ,$subject, $message);
						

					}
					/*$anotify['n_type_id'] = $vacID;
					$anotify['user_id'] = $data['user_id'];
					$anotify['n_type'] = 'add_rental';
					$anotify['n_date'] = date('Y-m-d h:i:s');
					$this->model->insert_data('tbl_notification',$anotify);*/
					if(isset($businessadd['pl_id'])){
                    	$result = $this->model->get_row('plan_master',array('pl_id' => $businessadd['pl_id']));
                    	if($result->pl_price != 0){
                    		echo json_encode(array('vac_id'=>$vacID, 'vac_type'=>'paid','page_url'=>base_url()));
                    		//redirect(base_url().'user/rentals/preview/'.$vacID);
                    	}else{
                    		echo json_encode(array('vac_id'=>$vacID, 'vac_type'=>'free','page_url'=>base_url()));
                    		//redirect(base_url().'user/rentals/view/'.$vacID);
                    	}
                    }
					
				}
		

	}

	function rental_edit_submit(){
                $data['user_id'] = $this->userId;
		        $businessadd['user_id'] = $data['user_id'];
		        $businessadd['trail_id'] = 'Lodging';
		        $businessadd['pl_id'] = $this->input->post('plan_id');
			    $businessadd['vac_name'] = $this->input->post('vac_name');
			   // $businessadd['vac_slag'] = preg_replace('/[^A-Za-z0-9\-]/', '-', str_replace('', '-', $this->input->post('vac_name')));

			    $slug = create_unique_slug( $businessadd['vac_name'],'tbl_vacation_list','vac_slag');
				$businessadd['vac_slag'] = $slug;

				$businessadd['vac_type'] = $this->input->post('vac_type');
				$businessadd['vac_contact'] = $this->input->post('vac_contact');
				$businessadd['vac_email'] = $this->input->post('vac_email');
				$businessadd['vac_address'] = $this->input->post('vac_address');
				$businessadd['vac_weekly_rate'] = $this->input->post('vac_weekly_rate');
				$businessadd['vac_zip_code'] = $this->input->post('vac_zip_code');
				$businessadd['vac_city'] = $this->input->post('vac_city');
				$businessadd['state_name'] = $this->input->post('vac_state');
				$businessadd['vac_wedsite_url'] = $this->input->post('vac_wedsite_url');
				$businessadd['vac_no_of_bedroom'] = $this->input->post('vac_no_of_bedroom');
				$businessadd['vac_bathroom'] = $this->input->post('vac_bathroom');
				$businessadd['vac_sleep'] = $this->input->post('vac_sleep');
				$businessadd['vac_price'] = $this->input->post('vac_price');
				$businessadd['vac_location_type'] = $this->input->post('vac_location_type');
			    $businessadd['vac_floor_area'] = $this->input->post('vac_floor_area');
				$businessadd['vac_description'] = $this->input->post('vac_description');
				$amenities = $this->input->post('vac_amenities');
                $businessadd['adv_filter_fields']=implode(",", $amenities);
				$businessadd['vac_created_by'] = 'user';
				$businessadd['vac_update_date'] = date('Y-m-d H:i:s');
				$businessadd['vac_lat'] = $this->input->post('pro_add_lat');
				$businessadd['vac_lang'] = $this->input->post('pro_add_lng');
				
				
				$this->image_upload_rental($businessadd['vac_name'],$this->input->post('vac_id'));
			
				// 26-05-2018  $where = array('vac_id' => $data['busID']);
		 	    // 26-05-2018  $update = $this->model->update('tbl_vacation_list', $businessadd, $where);
                $checkstatus = $this->model->get_row('tbl_vacation_list', array('vac_id' => $this->input->post('vac_id')));
                if($checkstatus->vac_status == 1){
		 	    $getclonedata = $this->model->get_row('tbl_update_vacation_list', array('vac_id' => $this->input->post('vac_id')));
		 	    $businessadd['vac_id'] = $this->input->post('vac_id');
		 	    if(!empty($getclonedata)){
		 	      $this->model->delete('tbl_update_vacation_list', array('vac_id' => $this->input->post('vac_id')));
		 	    }
		 	    $update = $this->model->insert_data('tbl_update_vacation_list',$businessadd);
		 	    $update = $this->model->update('tbl_vacation_list', array('update_status' => 1), array('vac_id' => $this->input->post('vac_id')));

		 	     $query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=14");
					$subAdminEmail = $query->result();
                    
					if(isset( $subAdminEmail)){
                    	foreach ($subAdminEmail as $semail) {

		                    $row1 =  $this->model->get_row('email_templates',array('title'=>'UpdatedRentalSubmission'));
							$subject = $row1->subject;
							$message = $row1->content;
							$message = str_replace("{username}",ucfirst($semail->fname),$message);
							$message = str_replace("{user_email_address}",$semail->email,$message);
							$message = str_replace("{rental_property_name}",$businessadd['vac_name'],$message);
							$this->sendingMail($semail->email,$subject, $message);

                        }
                    }
                    $query = $this->db->query("SELECT fname,email,user_id from tbl_user_master WHERE siterole_id =1 AND user_id=1");
                    $adminEmail = $query->result();
                    $row1 =  $this->model->get_row('email_templates',array('title'=>'UpdatedRentalSubmission'));
					$subject = $row1->subject;
					$message = $row1->content;
					$message = str_replace("{username}",ucfirst($adminEmail->fname),$message);
					$message = str_replace("{user_email_address}",$adminEmail->email,$message);
					$message = str_replace("{rental_property_name}",$businessadd['vac_name'],$message);
					$this->sendingMail($adminEmail->email, $subject, $message);

		 	   
                }else{
                	$where = array('vac_id' => $this->input->post('vac_id'));
		 	        $update = $this->model->update('tbl_vacation_list', $businessadd, $where);
                }

				if($update){
					$this->session->set_flashdata('success', 'You have successfully updated your listing.');
					 if(isset($businessadd['pl_id'])){
                    	$result = $this->model->get_row('plan_master',array('pl_id' => $businessadd['pl_id']));
                    	/*if($result->pl_price != 0){
                    		redirect(base_url().'user/rentals/preview/'.$data['busID']);
                    	}else{
                    		
                    		$this->session->set_flashdata('success', 'You have successfully updated your listing.');
					        redirect(base_url().'user/rentals');
                    	}*/
                    	if($result->pl_price != 0){
                    		echo json_encode(array('vac_id'=>$this->input->post('vac_id'), 'vac_type'=>'paid','page_url'=>base_url()));
                    		//redirect(base_url().'user/rentals/preview/'.$vacID);
                    	}else{

                    		echo json_encode(array('vac_id'=>$this->input->post('vac_id'), 'vac_type'=>'list','page_url'=>base_url()));
                    		//redirect(base_url().'user/rentals');
                    	}
                    }
				}
	}
	/**
	 * KML Page for this controller.
	 */
function mymap() 
	 {
		$data['pagetitle'] = 'Uploaded KML';
		$data['active_tab_kml'] = 'active';
		$data['user_id'] = $this->userId;
		$data['basesegment'] = $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$data['trailList'] = $this->model->get_data('*', 'tbl_trail_type_master', array('trail_status' =>0));
		$data['kmlList'] = $this->model->get_data('*', 'tbl_trail_master', array('trail_kml_upload_by'=>$data['user_id']));
		//$data['kmlList'] = $this->model->get_all_order_by('*', 'tbl_trail_master','trail_type_id','DESC');
        $data['getState'] = $this->model->get_data('*', 'tbl_state', array('state_status'=>1));
       
		if($data['segment'] == 'uploadkml') {

		if($this->form_validation->run('addtrail') == FALSE) {

			  $this->load->view('user/kmlmanagement/trail_type_add',$data);
			} else {
			$addkml['trail_type_name'] = $this->input->post('trail_name');
			$addkml['title'] = $this->input->post('title');
			/*$addkml['description'] = $this->input->post('description');*/
			$addkml['region_name'] = $this->input->post('region_name');
			$addkml['trail_kml_upload_by'] = $data['user_id'];
			if(!empty($_FILES['trail_kml_path']['name'])){
				if((!empty($_FILES["trail_kml_path"])) && isset($_FILES['trail_kml_path']['name']))
			    {
					if($_FILES['trail_kml_path']['error']==0)
					{
		                
						$filename  = basename($_FILES['trail_kml_path']['name']);
						$string = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
						$withoutExtFilename = str_replace(' ', '', $string);
						$extension = pathinfo($filename, PATHINFO_EXTENSION);
		                if($extension == 'kml'){
		                	$file_name     = time().'.'.$extension;
							$dir_name = 'upload/'.$withoutExtFilename.time();
							$this->create_dir($dir_name);
							$file_path = $dir_name.'/'.$file_name;
						    $addkml['trail_kml_path']= base_url().$file_path;
						
							move_uploaded_file($_FILES['trail_kml_path']['tmp_name'] ,$file_path);
		                }else{
		                	$this->session->set_flashdata('error', 'Please Upload only kml file');
		                    redirect(base_url().'user/mymap/uploadkml');
		                }
					}
			   }

			}else{
				$this->session->set_flashdata('error', 'Please Upload kml file');
		         redirect(base_url().'user/mymap/uploadkml');
			}
			$inserted = $this->model->insert_data('tbl_trail_master',$addkml);
            $trail_fk_id = $this->db->insert_id();
			$Placemark='';
			$Placemark1='';
			$Placemark2='';

			$completeurl = $file_path;
			$xml = simplexml_load_file($completeurl);
			if (isset($xml->Document->Placemark)) {
				$Placemark = $xml->Document->Placemark;
			}
			if (isset($xml->Document->Folder->Folder->Placemark)) {
				$Placemark1 = $xml->Document->Folder->Folder->Placemark;
			}
			if (isset($xml->Document->Folder->Placemark)) {
				$Placemark2 = $xml->Document->Folder->Placemark;
			}
             $region_name = $xml->Document->name;
             $region_name_post = $this->input->post('region_name');
			
			if($addkml['trail_type_name'] == "Trail") {  

			  //  if(isset($region_name_post) && !empty($region_name_post)){
			  	    $kmldata['trail_id'] = $trail_fk_id;
                    $kmldata['region_name'] = $region_name_post;
			  // }else{
			  // 	$kmldata['region_name'] = $region_name;
			  //  }
				 if(isset($Placemark1) && !empty($Placemark1)){
			    	for ($i = 0; $i < sizeof($Placemark1); $i++) {
					$point = $Placemark1[$i]->MultiGeometry->LineString;
					$point1 = $Placemark1[$i]->LineString;
					$point2 = $Placemark[$i]->Point;
					if(isset($point)){
						 for($j = 0; $j < sizeof($point); $j++){

							  $coordinates = $point[$j]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark1[$i]->name;
							  $kmldata['trail_dscrptn'] = $Placemark1[$i]->description;
							  $kmldata['upload_by_id'] = $data['user_id'];
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);
						}

					}
					if(isset($point1)){

							 for($j = 0; $j < sizeof($point1); $j++){
							  $coordinates = $point1[$j]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark1[$i]->name;
							  $kmldata['trail_dscrptn'] = $Placemark1[$i]->description;
							  $kmldata['upload_by_id'] = $data['user_id'];
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);

						}
					}
					if(isset($point2)){
						 for($jk = 0; $jk < sizeof($point2); $jk++){
							  $coordinates = $point2[$jk]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark1[$i]->name;
							  $kmldata['trail_dscrptn'] = $Placemark1[$i]->description;
							  $kmldata['upload_by_id'] = $data['user_id'];
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);

						}

					}
				}

			    }else if(isset($Placemark)  && !empty($Placemark)){
			    	for ($i = 0; $i < sizeof($Placemark); $i++) {
					$point = $Placemark[$i]->MultiGeometry->LineString;
					$point1 = $Placemark[$i]->LineString;
					$point2 = $Placemark[$i]->Point;
					if(isset($point)){
						 for($j = 0; $j < sizeof($point); $j++){

							  $coordinates = $point[$j]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark[$i]->name;
							  $kmldata['trail_dscrptn'] = $Placemark[$i]->description;
							  $kmldata['upload_by_id'] = $data['user_id'];
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);
						}

					}
					if(isset($point1)){

							 for($j = 0; $j < sizeof($point1); $j++){
							  $coordinates = $point1[$j]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark[$i]->name;                                                
							  $kmldata['trail_dscrptn'] = $Placemark[$i]->description;
							  $kmldata['upload_by_id'] = $data['user_id'];
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);

						}
					}
					if(isset($point2)){
						 for($jk = 0; $jk < sizeof($point2); $jk++){
							  $coordinates = $point2[$jk]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark[$i]->name;
							  $kmldata['trail_dscrptn'] = $Placemark[$i]->description;
							  $kmldata['upload_by_id'] = $data['user_id'];
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);

						}

					}


				}

			    }else  if(isset($Placemark2) && !empty($Placemark2)){  

                 	for ($iii = 0; $iii < sizeof($Placemark2); $iii++) {
					$point = $Placemark2[$iii]->MultiGeometry->LineString;
					$point1 = $Placemark2[$iii]->LineString;
					$point2 = $Placemark2[$iii]->Point;
					if(isset($point)){
						 for($jjj = 0; $jjj < sizeof($point); $jjj++){

							  $coordinates = $point[$jjj]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  if(isset($Placemark2[$iii]->name) && !empty($Placemark2[$iii]->name)){
							  	$kmldata['klm_trail_name'] = $Placemark2[$iii]->name;
							  }else{
							  	$kmldata['klm_trail_name'] =$xml->Document->Folder->name;
							  }
							  $kmldata['trail_dscrptn'] = $Placemark2[$iii]->description;
							  $kmldata['upload_by_id'] = $data['user_id'];
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);
						}

					}
					if(isset($point1)){

							 for($jjj = 0; $jjj < sizeof($point1); $jjj++){
							  $coordinates = $point1[$jjj]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark2[$iii]->name;
							  $kmldata['trail_dscrptn'] = $Placemark2[$iii]->description;
							  $kmldata['upload_by_id'] = $data['user_id'];
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);

						}
					}
					if(isset($point2)){
						 for($jk = 0; $jk < sizeof($point2); $jk++){
							  $coordinates = $point2[$jk]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark2[$iii]->name;
							  $kmldata['trail_dscrptn'] = $Placemark2[$iii]->description;
							  $kmldata['upload_by_id'] = $data['user_id'];
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);

						}

					}
				}

			   }

			}else if($addkml['trail_type_name'] == "Trail Report")
			{
			  if(isset($Placemark)  && !empty($Placemark)){
			    $kmldata1['region_name'] = $region_name_post;
				for ($ii = 0; $ii < sizeof($Placemark); $ii++) {
			    $kmldata1['trail_report_id'] = $trail_fk_id;
				if(isset($Placemark[$ii]->Polygon->outerBoundaryIs->LinearRing)){
					$LinearRing =$Placemark[$ii]->Polygon->outerBoundaryIs->LinearRing ;
					if(isset($LinearRing)){
						 for($jj = 0; $jj < sizeof($LinearRing); $jj++){

							  $coordinates1 = $LinearRing[$jj]->coordinates;
							  $kmldata1['lat_lang'] =$coordinates1;
							  $kmldata1['county_name'] = $Placemark[$ii]->name;
							  $kmldata1['county_detail'] = $Placemark[$ii]->description;
							  $kmldata['upload_by_id'] = $data['user_id'];
							  $inserted = $this->model->insert_data('county_trail_report',$kmldata1);
						}
					}
				}
				if(isset($Placemark[$ii]->MultiGeometry)){
					$Polygon =$Placemark[$ii]->MultiGeometry->Polygon ;
					if(isset($Polygon)){
						 for($kk = 0; $kk < sizeof($Polygon); $kk++){
							  $LinearRing1 = $Polygon[$kk]->outerBoundaryIs->LinearRing;
							   for($hh = 0; $hh < sizeof($LinearRing1); $hh++){
									$coordinates1 = $LinearRing1[$hh]->coordinates;
									$kmldata1['lat_lang'] =$coordinates1;
									$kmldata1['county_name'] = $Placemark[$ii]->name;
									$kmldata1['county_detail'] = $Placemark[$ii]->description;
									$kmldata['upload_by_id'] = $data['user_id'];
									$inserted = $this->model->insert_data('county_trail_report',$kmldata1);
							   }
						}
					}
				}

			  }
			 }
			}
			else
			{
			for ($i = 0; $i < sizeof($Placemark); $i++) {

			  $point = $Placemark[$i]->Point;
			  $kmldata['trail_fk_id'] = $trail_fk_id;

				  for($j = 0; $j < sizeof($point); $j++){

	                  $coordinates = $point[$j]->coordinates;
	                  $kmldata['lat_lang'] =$coordinates;
	                  $kmldata['lat_lang'] =$coordinates;
					  $kmldata['kml_data_name'] = $Placemark[$i]->name;
					  $kmldata['region_name'] = $region_name_post;
					  $kmldata['upload_by_id'] = $data['user_id'];
	                  $inserted = $this->model->insert_data('tbl_kml_data',$kmldata);

				  }
			}
		}
			if($inserted){
				$this->session->set_flashdata('success', 'Upload KML file successfully');
				
				redirect(base_url().'user/traillist');
			}
		
		} 
	}else { 
		   $this->load->view('user/kmlmanagement/trail_type',$data);
		}
	}

	/**
	 * trail list Page for this controller.

	 */
	function traillist() 
	 {
			$data['pagetitle'] = 'Trail List';
			$data['active_tab_kml'] = 'active';
			$data['user_id'] = $this->userId;
			$data['basesegment'] = $this->uri->segment(2);
			$data['segment'] = $this->uri->segment(3);			
		    $query = $this->db->query('SELECT * FROM `tbl_kml_data_trail` WHERE `upload_by_id` = '.$data['user_id'].' group by `tbl_kml_data_trail`.`klm_trail_name` ORDER BY `id` ASC');
			$data['kmlList'] = $query->result();
			$data['userList'] = $this->model->get_data('user_id,fname,lname,email,profile_picture', 'tbl_user_master',array('status' => 1, 'user_id !=' => $data['user_id'],'user_id !=' => 1));
			//print_r($data['userList']);
		   $this->load->view('user/traillist/traillist',$data);
	     
	 }

function delete_trail(){
	
	$this->model->delete('tbl_trail_master', array('trail_type_id' =>  $this->input->post('trail_id') ));
	
	$delete = $this->model->delete('tbl_kml_data_trail', array('trail_id' =>  $this->input->post('trail_id') ));
	if($delete){
		echo 1;
	}

}
	 

	 /**
	 * POI Page for this controller.
	 */

	function poilist() 
	 {

		$data['pagetitle'] = 'Uploaded KML';
		$data['active_tab_kml'] = 'active';
		$data['user_id'] = $this->userId;
		$data['basesegment'] = $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);	

		$where = array("`tbl_kml_data`.`upload_by_id`"=>$data['user_id']);

		$data['kmlList'] = $this->model->get_data_rl_join('tbl_trail_master.*, tbl_kml_data.*', 'tbl_trail_master','tbl_kml_data','trail_type_id','trail_fk_id', $where, 'trail_type_id', 'DESC','RIGHT');

        $this->load->view('user/POI/pois',$data);
	
	
	}

 /**
	 * trailreport Page for this controller.
	 */
	function trailreport() 
	 {
	    $data['pagetitle'] = 'Uploaded KML';
		$data['active_tab_kml'] = 'active';
		$data['user_id'] = $this->userId;
		$data['basesegment'] = $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);	
		$query =$this->db->query('SELECT county_trail_report.* FROM `county_trail_report` WHERE `county_trail_report`.`upload_by_id` = '.$data['user_id'].' group by `county_trail_report`.`county_name`');
		$data['trailList']= $query->result();
		
		$this->load->view('user/traillist/trailreport',$data);
	}

/**
	 * Selecte Packages.
	 */
	public function packages() 
	{
	    $data['user_id'] = $this->userId;
	    $data['segment']= $this->uri->segment(3);
	    $data['pagetitle'] = 'packages';
	    $data["packagesPlan"] = $this->model->get_all('*', 'plan_master');
		 $this->load->view('user/vacationListing/selete_package',$data);
	}
/*public function create_unique_slug($string,$table,$field='slug',$key=NULL,$value=NULL)
{
    $t =& get_instance();
    $slug = url_title($string);
    $slug = strtolower($slug);
    $i = 0;
    $params = array ();
    $params[$field] = $slug;
 
    if($key)$params["$key !="] = $value; 
 
    while ($t->db->where($params)->get($table)->num_rows())
    {   
        if (!preg_match ('/-{1}[0-9]+$/', $slug ))
            $slug .= '-' . ++$i;
        else
            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
         
        $params [$field] = $slug;
    }   
    return $slug;   
}*/



/**
	 * Classifieds Add Page for this controller.
	 */

public function submit_classified(){
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
		$slug = create_unique_slug($classifiedpage['classified_created_by'],'tbl_classified_list','url_slag') ;
		$classifiedpage['url_slag'] = $slug;
		$classifiedpage['user_ID'] =   $this->userId;
		$classifiedpage['classified_created_user'] = 'user';


		 $image_path='';
		 $inserted = $this->model->insert_data('tbl_classified_list',$classifiedpage);
		 $clsID = $this->db->insert_id();
		  $this->image_upload($classifiedpage['classified_created_by'],$clsID);

		if($inserted){
			  $this->session->set_flashdata('success', 'The classified has been successfully Added.');
			  $query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=11");
			  $subAdminEmail = $query->result();
		      $page_link = base_url().'classified/details/'.$classifiedpage['url_slag'];
		      if(isset( $subAdminEmail)){
		          foreach ($subAdminEmail as $semail) {
		          $row1 =  $this->model->get_row('email_templates',array('title'=>'NewClassified'));
		          $subject = $row1->subject;
		          $message = $row1->content;
		          $message = str_replace("{username}",ucfirst($semail->fname),$message);
		          $message = str_replace("{user_email_address}",$semail->email,$message);
		          $message = str_replace("{classified_name}",$classifiedpage['classified_created_by'],$message);
		          $message = str_replace("{page_link}",$page_link,$message);
		          $message = str_replace("{classified_details}",$classifiedpage['classified_description'],$message);
		          $this->sendingMail($semail->email ,$subject, $message);
		          }
		      }
		      $query = $this->db->query("SELECT fname,email,user_id from tbl_user_master WHERE siterole_id =1 AND user_id=1");
		      $adminEmail = $query->row();
		      $row1 =  $this->model->get_row('email_templates',array('title'=>'NewClassified'));
		      $subject = $row1->subject;
		      $message = $row1->content;
		      $message = str_replace("{username}",ucfirst($adminEmail->fname),$message);
		      $message = str_replace("{user_email_address}",$adminEmail->email,$message);
		      $message = str_replace("{classified_name}",$classifiedpage['classified_created_by'],$message);
		      $message = str_replace("{page_link}",$page_link,$message);
		      $message = str_replace("{classified_details}",$classifiedpage['classified_description'],$message);
		      $this->sendingMail($adminEmail->email ,$subject, $message);
			  //redirect(base_url().'user/classifiedslist');
			  echo 1;
		}

}


public function classified_edit_submit(){
	    $classifiedpage['classified_id'] = $this->input->post('classified_id');
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
	  	$slug = create_unique_slug($classifiedpage['classified_created_by'],'tbl_classified_list','url_slag') ;
		$classifiedpage['url_slag'] = $slug;

	    $classifiedpage['user_ID'] =  $this->userId;
	  	$classifiedpage['classified_created_user'] = 'user';
	  //	$classifiedpage['classified_status'] = 0;
       $this->image_upload($classifiedpage['classified_created_by'],$classifiedpage['classified_id']);
		$where = array('classified_id' => $classifiedpage['classified_id']);
  	    $inserted = $this->model->update('tbl_classified_list', $classifiedpage, $where);
		if($inserted){
			$this->session->set_flashdata('success', 'The classified has been successfully updated.');
			echo 1;
			//redirect(base_url().'user/classifiedslist');
		}
}

public function addclassified(){


	   $data['pagetitle'] = 'Add Classifieds';	
	   $data['catList'] =  $this->model->get_data_order_by('*', 'tbl_classified_cat_master', array('classified_cat_status' => 1), 'classified_sort_order, classified_cat_name','ASC');
	   $data['stateList'] = $this->model->get_data('*', 'tbl_state', array('state_status' => 1));
	   $data['segment']= $this->uri->segment(2);
	   $data['user_id'] = $this->userId;	
		if($this->form_validation->run('classifiedsadd') == FALSE) {
		
		  $this->load->view('user/classifieds/add_classified',$data);	

		} else {
                /*$classifiedpage['classified_ads'] = $this->input->post('classified_ads');
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
				$slug = create_unique_slug($classifiedpage['classified_created_by'],'tbl_classified_list','url_slag') ;
				$classifiedpage['url_slag'] = $slug;
			  
			  	$classifiedpage['user_ID'] =  $data['user_id'];
			  	$classifiedpage['classified_created_user'] = 'user';


				 $image_path='';
				 $inserted = $this->model->insert_data('tbl_classified_list',$classifiedpage);
				 $clsID = $this->db->insert_id();
				  $this->image_upload($classifiedpage['classified_created_by'],$clsID);
				
				if($inserted){
					  $this->session->set_flashdata('success', 'The classified has been successfully Added.');
					  $query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=11");
					  $subAdminEmail = $query->result();
				      $page_link = base_url().'classified/details/'.$classifiedpage['url_slag'];
				      if(isset( $subAdminEmail)){
				          foreach ($subAdminEmail as $semail) {
				          $row1 =  $this->model->get_row('email_templates',array('title'=>'NewClassified'));
				          $subject = $row1->subject;
				          $message = $row1->content;
				          $message = str_replace("{username}",ucfirst($semail->fname),$message);
				          $message = str_replace("{user_email_address}",$semail->email,$message);
				          $message = str_replace("{classified_name}",$classifiedpage['classified_created_by'],$message);
				          $message = str_replace("{page_link}",$page_link,$message);
				          $message = str_replace("{classified_details}",$classifiedpage['classified_description'],$message);
				          $this->sendingMail($semail->email ,$subject, $message);
				          }
				      }
				      $query = $this->db->query("SELECT fname,email,user_id from tbl_user_master WHERE siterole_id =1 AND user_id=1");
				      $adminEmail = $query->row();
				      $row1 =  $this->model->get_row('email_templates',array('title'=>'NewClassified'));
				      $subject = $row1->subject;
				      $message = $row1->content;
				      $message = str_replace("{username}",ucfirst($adminEmail->fname),$message);
				      $message = str_replace("{user_email_address}",$adminEmail->email,$message);
				      $message = str_replace("{classified_name}",$classifiedpage['classified_created_by'],$message);
				      $message = str_replace("{page_link}",$page_link,$message);
				      $message = str_replace("{classified_details}",$classifiedpage['classified_description'],$message);
				      $this->sendingMail($adminEmail->email ,$subject, $message);
					  redirect(base_url().'user/classifiedslist');

				}*/
		
		} 	  
		
}
/**
	 * Classifieds Edit Page for this controller.
	 */
public function editclassified(){


	   $data['pagetitle'] = 'Edit Classifieds';	
	   $data['segment']= $this->uri->segment(2);
	   $data['pageID']= $this->uri->segment(3);
	  $data['catList'] =  $this->model->get_data_order_by('*', 'tbl_classified_cat_master', array('classified_cat_status' => 1), 'classified_sort_order, classified_cat_name','ASC');
	   $data['stateList'] = $this->model->get_data('*', 'tbl_state', array('state_status' => 1));
	   $data['classified'] = $this->model->get_row('tbl_classified_list',array('classified_id' => $data['pageID']));
	   $data['clsImg'] = $this->model->get_data('*','tbl_classified_images',array('cls_id' => $data['pageID']));
	   $data['user_id'] = $this->userId;

		if($this->form_validation->run('classifiedsedit') == FALSE) {
		
		  $this->load->view('user/classifieds/add_classified',$data);	

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
			  	$slug = create_unique_slug($classifiedpage['classified_created_by'],'tbl_classified_list','url_slag') ;
				$classifiedpage['url_slag'] = $slug;

			    $classifiedpage['user_ID'] =  $data['user_id'];
			  	$classifiedpage['classified_created_user'] = 'user';
			  	$classifiedpage['classified_status'] = 0;
               $this->image_upload($classifiedpage['classified_created_by'],$data['pageID']);
				$where = array('classified_id' => $data['pageID']);
		  	    $inserted = $this->model->update('tbl_classified_list', $classifiedpage, $where);
				if($inserted){
					$this->session->set_flashdata('success', 'The classified has been successfully updated.');
					redirect(base_url().'user/classifiedslist');
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
	  $where = array('user_ID' =>$data['user_id']);
	  $data['classifiedList'] = $this->model->get_data_order_by('*', 'tbl_classified_list',$where,'classified_id','DESC');
	  $this->load->view('user/classifieds/classified_list',$data);
}

public function classifiedview(){
		
	  $data['pagetitle'] = 'Classifieds List';
	  $data['user_id'] = $this->userId;
      $data['basesegment']= $this->uri->segment(2);
      $data['pageID']= $this->uri->segment(3);
	  $where = array('user_ID' =>$data['user_id'],'classified_id' => $data['pageID'] );
	  $data['classifiedList'] = $this->model->get_row('tbl_classified_list',$where);
	  $this->load->view('user/classifieds/classified_view',$data);
}


	/**
	 * news Page for this controller.
	 */
/*function news() 
	 {
		 
		$data['pagetitle'] = 'News';
		$data['user_id'] = $this->userId;
		$data['basesegment']= $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$where = array('user_id' => $data['user_id']);
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

			if (!empty($_FILES['news_image']['name'])){
				 	 if((!empty($_FILES["news_image"])) && isset($_FILES['news_image']['name'])){
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

				 }else{
				 	$this->session->set_flashdata('error', 'Please Upload image');
		             redirect(base_url().'user/news/addnews');
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
	}*/

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
			$this->db->delete(' tbl_vacation_list_images',array('vac_id' =>$id));
			$this->db->delete(' tbl_update_vacation_list',array('vac_id' =>$id));
		}
		/******************Delete classified********************/

 		if($tablename == 'tbl_classified_list'){
			$where=array('classified_id'=> $id);
			$this->db->delete(' tbl_classified_images',array('cls_id' =>$id));
		}

		/******************Delete news********************/

 		if($tablename == 'tbl_news'){
			$where=array('news_id'=> $id);
		}

		/******************tbl_user_route_planning********************/

 		
 		if($tablename == 'tbl_user_route_planning'){
			$where=array('URP_ID'=> $id);
			$where1=array('t_id'=> $id,'saveroute'=> "saveroute");
	        $this->db->delete('tbl_share_my_trails', $where1);

		}
		/******************Delete tbl_trail_master********************/

 		if($tablename == 'tbl_trail_master'){
			$where=array('trail_type_id'=> $id);
			$where1=array('trail_id'=> $id);
			 $resultData = $this->model->get_data('*','tbl_kml_data_trail', array('trail_id'=> $id));
			 foreach ($resultData as $rdata) {
			 $where2=array('t_id'=> $rdata->id,'saveroute'=>'privatetrail');
			  $this->db->delete('tbl_share_my_trails', $where2);
			 }
 		    //print_r($resultData);
	        $this->db->delete('tbl_kml_data_trail', $where1);
	       
		}
		/******************Delete tbl_kml_data_trail********************/
        if($tablename == 'tbl_kml_data_trail'){
 			
 			$arr = explode("_", $id);
 			$where=array('klm_trail_name'=>$arr[0], 'upload_by_id'=> $arr[1]);
 			$where1 = array('t_id' =>  $arr[2],'saveroute'=>'privatetrail');
 			$this->db->delete('tbl_share_my_trails', $where1);

		}
		/******************Delete tbl_trail_report********************/

 		if($tablename == 'tbl_trail_report'){
 			$where=array('trail_report_id'=>$id);
		}
		/******************Delete tbl_trail_report********************/

 		if($tablename == 'trail_report_user_update'){
 			$where=array('ID'=>$id);
		}
		/******************Delete tbl_subscribe_user********************/

 		if($tablename == 'tbl_subscribe_user'){
 			$where=array('subc_id'=>$id);
		}
		/******************Delete tbl_share_my_trails********************/

 		if($tablename == 'tbl_share_my_trails'){
 			$where=array('s_t_id'=>$id);
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
      $lat = 44.314844; 
      $long = -85.602364; 
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
			$vac_id = $_REQUEST['vac_id'];
			$return =  $this->deleteImage($img_id, $business_img);
			$countcls = $this->model->get_data('*','tbl_vacation_list_images', array('vac_id' =>  $vac_id));
			echo count($countcls);
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
			$arr=array('a'=>$return);
			print_r(json_encode($arr));
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
				$image_name     = time().'.'.$extension;
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

/**
	 * Selected Route List Page for this controller.
	 */
public function savedroutes(){
		
	  $data['pagetitle'] = 'Selected Route';
	  $data['user_id'] = $this->userId;
      $data['basesegment']= $this->uri->segment(2);
      $data['segment']= $this->uri->segment(3);
	  $where = array('user_id' =>$data['user_id']);
	  $data['routeList'] = $this->model->get_data_order_by('*', 'tbl_user_route_planning
         ',$where,'URP_ID','DESC');
	  $query =$this->db->query('SELECT m1.* FROM tbl_share_my_trails m1 LEFT JOIN tbl_share_my_trails m2 ON (m1.`t_name` = m2.`t_name` AND m1.`created_date` < m2.`created_date`) WHERE m1.saveroute="saveroute" and m1.u_id="'.$data['user_id'].'" and m2.`created_date` IS NULL');

     $data['shared_trail_list'] =$query->result();
	  $this->load->view('user/selectedroute/selected_route_list',$data);
	  if($data['segment'] == 'delete'){

	  }
}
/**
 * Create Folder for this controller.
 */
function create_dir( $dir_name ){

	$filename = $dir_name . "/";
	if (!file_exists($filename)) {
	mkdir( $dir_name,0777,TRUE );
	}
}
/**
 * shared trail for this controller.
 */
function sharedtrail(){
      $data['pagetitle'] = 'Shared Trail';
	  $data['user_id'] = $this->userId;
	  $data['basesegment']= $this->uri->segment(2);
	 // $where = array('u_id' =>$data['user_id'],'saveroute'=>'privatetrail');
	 // $data['shared_trail_list'] = $this->model->get_data_order_by('*', 'tbl_share_my_trails',$where,'s_t_id','DESC');	

	  $query =$this->db->query('SELECT m1.* FROM tbl_share_my_trails m1 LEFT JOIN tbl_share_my_trails m2 ON (m1.`t_name` = m2.`t_name` AND m1.`created_date` < m2.`created_date`) WHERE m1.saveroute="privatetrail" and m1.u_id="'.$data['user_id'].'" and m2.`created_date` IS NULL');
	  $data['shared_trail_list'] =$query->result();

	  $this->load->view('user/traillist/shared_trail',$data);
	
}
/**
 * shared route for this controller.
 */
function sharedroute(){
      $data['pagetitle'] = 'Shared Route';
	  $data['user_id'] = $this->userId;
	  $data['basesegment']= $this->uri->segment(2);
	  $where = array('u_id' =>$data['user_id'],'saveroute'=>'saveroute');
	  $data['shared_trail_list'] = $this->model->get_data_order_by('*', 'tbl_share_my_trails',$where,'s_t_id','DESC');	  
	  $this->load->view('user/traillist/shared_trail',$data);
	
}


/**
 * update trail status for this controller.
 */
function updatetrail() 
 {
	$data['pagetitle'] = 'Update Trail Status';
	$data['user_id'] = $this->userId;
	$data['basesegment']= $this->uri->segment(2);
	$data['segment'] = $this->uri->segment(3);
    $where = array('user_id' =>$data['user_id']);
    $data['trailList'] = $this->model->get_data_order_by('*', 'tbl_trail_report',$where,'trail_report_id','DESC');
	$where1 = array('userID' =>$data['user_id']);
	$data['trailReportList'] = $this->model->get_data_order_by('*', 'trail_report_user_update',$where1,'ID','DESC');
    $data['subscriptionsList'] = $this->model->get_data_order_by('*', 'tbl_subscribe_user',array('subc_user_id'=> $data['user_id']),'subc_id','DESC');	
    $query = $this->db->query("SELECT tbl_user_master.fname,tbl_user_master.lname, tbl_user_master.user_id,tbl_event.event_title,tbl_event.event_id,tbl_event.event_date, tbl_event_subscribe.* FROM `tbl_event_subscribe` LEFT JOIN tbl_event  ON tbl_event_subscribe.`eve_id` = tbl_event.`event_id` LEFT JOIN tbl_user_master  ON tbl_event_subscribe.`eve_sub_user_id` = tbl_user_master.`user_id` WHERE `eve_sub_user_id` = ".$data['user_id']." ORDER BY `event_sub_id` DESC");
    $data['eventSubscribeList'] = $query->result();	


     $query = $this->db->query("SELECT tbl_user_master.fname,tbl_user_master.lname, tbl_user_master.user_id,forum_question.forum_ques_id,forum_question.forum_ques_title, forum_subscribe.*, forum_category.forum_cat_id , forum_category.forum_cat_name FROM `forum_subscribe` 
     	LEFT JOIN forum_question  ON forum_subscribe.`forum_ques_id` = forum_question.`forum_ques_id`
     	LEFT JOIN forum_category  ON forum_subscribe.`forum_cat_id` = forum_category.`forum_cat_id` 
     	LEFT JOIN tbl_user_master  ON forum_subscribe.`user_id` = tbl_user_master.`user_id` WHERE forum_subscribe.`user_id` = ".$data['user_id']." ORDER BY `forum_subscribe_id` DESC");
    $data['ForumSubscribeList'] = $query->result();	




  	if(($data['segment'] == 'edit')){
  		$data['trailID'] = $this->uri->segment(4);
  		$data["trailDetail"] = $this->model->get_data('*', 'tbl_trail_report', array('trail_report_id' => $data['trailID']));

		 if($this->form_validation->run('updatetrail') == FALSE) {
		    $this->load->view('user/updateTrail&TrailReport/update_trail',$data);
	     } else {
	        $data['pagetitle'] = 'Edit Trail Status';
	        $trail_status['trail_status'] = $this->input->post('trail_status');
			$trail_status['trail_description'] = $this->input->post('trail_description');
		   //update into tbl_business_master table
			$where = array('trail_report_id' => $data['trailID']);
	 	    $update = $this->model->update('tbl_trail_report', $trail_status, $where);
			if($update){
				$this->session->set_flashdata('success', 'Update Trail status is Successfully');
				 redirect(base_url().'user/updatetrail');
			}
	
	      } 
		}else{

			 $this->load->view('user/updateTrail&TrailReport/update_trail_list',$data);
		}
}
	/**
	 * update trail report status for this controller.
	 */
function updatetrailreport() 
	 {
		$data['pagetitle'] = 'Update Trail Report';
		$data['user_id'] = $this->userId;
		$data['basesegment']= $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
      	if(($data['segment'] == 'edit')){
      		$data['trailID'] = $this->uri->segment(4);
      		$data["trailDetail"] = $this->model->get_data('*', 'trail_report_user_update', array('ID' => $data['trailID']));

			 if($this->form_validation->run('updatetrailreport') == FALSE) {
			    $this->load->view('user/updateTrail&TrailReport/update_trail_report',$data);
		     } else {
		        $data['pagetitle'] = 'Edit Trail Report';
		     	$trail_status['CountyID'] = $this->input->post('CountyID');
		     	$trail_status['trail_report_conditions'] = $this->input->post('trail_report_conditions');
			   //update into tbl_business_master table
				$where = array('ID' => $data['trailID']);
		 	    $update = $this->model->update('trail_report_user_update', $trail_status, $where);
				if($update){
					$this->session->set_flashdata('success', 'Update Trail Report is Successfully');
					 redirect(base_url().'user/updatetrail');
				}
		
		      } 
			}else{

				 $this->load->view('user/updateTrail&TrailReport/update_trail_list',$data);
			}
	}
	function sendingMail($email, $subject, $msg){
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        $email  = $email;
        $this->email->from(FROM_EMAIL, FROM_NAME);
        
        $this->email->to($email);
        $this->email->subject($subject);       
        $this->email->message($msg);  
        $return = $this->email->send();
        if($return){
            return true;
        }else{
           return false;
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
        $config['max_size'] = '15000000000000';
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

private function set_upload_options1($image_path,$name)
{				
		$Path='./upload/business_image/large/';
		$Path_icon='./upload/business_image/icon/';
		$Path_thumb='./upload/business_image/thumbnail/';

		//upload an image options
		$config = array();
		$config['upload_path']    = $Path;
		$config['file_name'] = $image_path;
		$config['file_path'] = $Path.$image_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|JPEG';	
		$config['max_size'] = '15000000000000';
		// $config['max_width'] = '3000'; /* max width of the image file */
		// $config['max_height'] = '2000'; /* max height of the image file */			
		return $config;
}

private function image_upload_rental($category_name,$category_id){
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
			
			$this->upload->initialize($this->set_upload_options1($image_path,'userfile'));
			$this->upload->do_upload();
			$data1 =$this->upload->data();
			if($data1){
				$Path='./upload/business_image/large/';
				$Path_icon='./upload/business_image/icon/';
				$Path_thumb='./upload/business_image/thumbnail/';
   

				$icon = $Path_icon.$data1['file_name'];
				resize_image($data1,$icon,60,60);
				
				$thumb = $Path_thumb.$data1['file_name'];
				resize_image($data1,$thumb,900,350);
				      $uploadData[$i]['vac_imag'] = 'upload/business_image/thumbnail/'.$data1['file_name'];
					//$uploadData[$i]['date'] = date("Y-m-d H:i:s");
				     $uploadData[$i]['vac_id'] = $category_id;
				//die;
			}
			
		} 
		if(!empty($uploadData)){
         	//Insert file information into the database
			 $this->model->insertImage("tbl_vacation_list_images", $uploadData);
			 
	   }
	
		
}   
} 




}// class close