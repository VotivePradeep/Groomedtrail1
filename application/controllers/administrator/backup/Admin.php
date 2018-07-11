<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct(){


		parent::__construct();
		/* Load the libraries and helpers */        
		$this->load->model('model');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper('custom_helper');
		$this->load->library('excel');
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
	 * Index Page for this controller.
	 */
	public function dashboard(){

	$info=$this->session->all_userdata();
	$data['basesegment']= $this->uri->segment(2);
	$data['userinfo']=$info;
	$data['u_id'] = $this->data['user_id'];
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	//print_r($data['checkpers']);
	//$data['checkpers'] = $this->model->get_data('*', 'tbl_role_permission', array('user_id'=>$data['u_id']));
	$query = $this->db->query("SELECT `siterole_id`, DATE_FORMAT(created_date, '%d/%m/%Y') AS created_date FROM `tbl_user_master` WHERE `siterole_id` = 2 AND `created_date` >= CURDATE()");
	$data['userCountNowDate'] = $query->result();

	$data['userCount'] = $this->model->get_data('*', 'tbl_user_master', array('siterole_id'=>2));

	$data['pandingTrailReport'] = $this->model->get_data('*', 'trail_report_user_update', array('trail_report_status'=>0));
	$data['ApproveTrailReport'] = $this->model->get_data('*', 'trail_report_user_update', array('trail_report_status'=>1));
	$data['TrailReport'] = $this->model->get_all('*', 'trail_report_user_update');
	$data['TrailStatus'] = $this->model->get_all('*', 'tbl_trail_report');
	$data['pandingTrailStatus'] = $this->model->get_data('*', 'tbl_trail_report', array('status'=>0));
	$data['ApproveTrailStatus'] = $this->model->get_data('*', 'tbl_trail_report', array('status'=>1));
	$data['enquiry'] = $this->model->get_all('*', 'tbl_enquiry');
    $data['enquiryUnresponded'] = $this->model->get_data('*', 'tbl_enquiry', array('status'=>0));
    $data['enquiryunread'] = $this->model->get_data('*', 'tbl_enquiry', array('read_status'=>0));
    $data['rentalList'] = $this->model->get_all('*', 'tbl_vacation_list');
    $data['newRental'] = $this->model->get_data('*', 'tbl_vacation_list',array('admin_view_review'=>0));
    $data['newReview'] = $this->model->get_data('*', 'tbl_review', array('admin_view_review'=>0));
    $data['classifiedCount'] = $this->model->get_all('*', 'tbl_classified_list');
    $data['newclassifiedCount'] = $this->model->get_data('*', 'tbl_classified_list',array('admin_view_review'=>0));
	$data['NewsCount'] = $this->model->get_all('*', 'tbl_news');
	$data['newNews'] = $this->model->get_data('*', 'tbl_news',array('admin_view_review'=>0));
    $data['forumCount'] = $this->model->get_all('*', 'forum_question');
    $data['Newforum'] = $this->model->get_all('*', 'forum_question',array('admin_view_review'=>0));
    $data['EventCount'] = $this->model->get_all('*', 'tbl_event');
    $data['NewEventCount'] = $this->model->get_data('*', 'tbl_event',array('event_status'=>0));
	$data['title'] = 'Dashboard';
	$data['active_tab_dashboard'] = 'active';
	$data['role'] = $this->data['siterole_id'];

	////////////////////////total user////////

	$this->load->view('administrator/include/inner_header',$data);
	$this->load->view('administrator/dashboard',$data);
	$this->load->view('administrator/include/inner_footer');	

}
/**
	 * Access Denied Page for this controller.
	 */
	public function access_denied(){
		$data['title'] = 'ACCESS DENIED';
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/access_denied',$data);
		$this->load->view('administrator/include/inner_footer');	

	}

/**
	 * User List Page for this controller.
	 */
public function users(){

		$info=$this->session->all_userdata();
		$data['userinfo']=$info;
		//print_r($data['userinfo']);
		$data['u_id'] = $this->data['user_id'];
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],1);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['active_tab_user'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment']= $this->uri->segment(3);   
	    $data['userList'] = $this->model->get_all_order_by('*', 'tbl_user_master','user_id','DESC');
	  
	  if($data['basesegment'] == 'subadmins'){
	  		////////////////////////total user////////
		  $data['title'] = 'Sub Admin';
		  $data['userList'] = $this->model->get_all_order_grop_by('*', 'tbl_user_master',array('siterole_id' => 3),'user_id','user_id','DESC');
		  $this->load->view('administrator/include/inner_header',$data);
		  $this->load->view('administrator/usermanagement/subadminlist',$data);
		  $this->load->view('administrator/include/inner_footer');	
	  }else if($data['basesegment'] == 'userdetails'){
   
		  $data['title'] = 'User Details';
		  if (isset($result)) {
		  	if($result[0]->permission_id == 1){
		  		if($result[0]->view_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		  }
		  $data['userID'] =$this->uri->segment(3);
		  $data['userDetail'] = $this->model->get_row('tbl_user_master',array('user_id'=>$data['userID']));
		  $this->load->view('administrator/include/inner_header',$data);
		  $this->load->view('administrator/usermanagement/view_user_detail',$data);
		  $this->load->view('administrator/include/inner_footer');	
	  }else if($data['basesegment'] == 'adduser'){
	  	
			$data['title'] = 'Add User';
			if (isset($result)) {
			  	if($result[0]->permission_id == 1){
			  		if($result[0]->add_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
		    }
			$data['userID'] =$this->uri->segment(3);
			$data['segment'] =$this->uri->segment(2);
			$data['permissionList'] = $this->model->get_all('*', 'tbl_permission');
			$data['roleList'] = $this->model->get_data('*','tbl_user_role', array('role_status' => 1));
			//print_r($data['userDetail']);
			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/usermanagement/edituser',$data);
			$this->load->view('administrator/include/inner_footer');	
	  }else if($data['basesegment'] == 'useredit'){
			$data['title'] = 'Edit User';
			if (isset($result)) {
			  	if($result[0]->permission_id == 1){
			  		if($result[0]->edit_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
		    }
			$data['userID'] =$this->uri->segment(3);
			$data['segment'] =$this->uri->segment(2);
			$data['userDetail'] = $this->model->get_row('tbl_user_master',array('user_id' => $data['userID']));
			$data['permissionList'] = $this->model->get_all('*', 'tbl_permission');
			$data['roleList'] = $this->model->get_data('*','tbl_user_role', array('role_status' => 1));
			//print_r($data['userDetail']);
			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/usermanagement/edituser',$data);
			$this->load->view('administrator/include/inner_footer');	
	  }else{
	  	////////////////////////total user////////
	  $data['title'] = 'User List';
	 // $data['userList'] = $this->model->get_all_order_by('*', 'tbl_user_master','user_id','DESC');
	  $this->load->view('administrator/include/inner_header',$data);
	  $this->load->view('administrator/usermanagement/userlist',$data);
	  $this->load->view('administrator/include/inner_footer');	

	  }
		
}

function roles() 
 {
 	    $data['title'] = 'Admin | Roles';
		$data['active_tab_user'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],25);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['basesegment'] = $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');		
		$data['roleList'] = $this->model->get_data('*','tbl_user_role', array('role_id!='=>1));
		if($data['segment'] == 'add') {
			if (isset($result)) {
			  	if($result[0]->permission_id == 1){
			  		if($result[0]->add_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
		    }
			if($this->form_validation->run('role_add') == FALSE) {

				  $this->load->view('administrator/include/inner_header',$data);
				  $this->load->view('administrator/rolemanagement/role_add',$data);
				  $this->load->view('administrator/include/inner_footer');

			} else {
				$add['role_name'] = $this->input->post('role_name');
				$add['role_created_date'] = date('Y-m-d');
				$inserted = $this->model->insert_data('tbl_user_role',$add);
				if($inserted){
					$this->session->set_flashdata('success', 'Add role successfully');
					redirect(base_url().'administrator/roles');
				}
				
			}
		}else if($data['segment'] == 'edit') {
		if (isset($result)) {
		  	if($result[0]->permission_id == 1){
		  		if($result[0]->edit_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		}  
		$data['roleID']= $this->uri->segment(4);
        $where = array('role_id' => $data['roleID']);
	    $data['roleDetail'] = $this->model->get_row('tbl_user_role', $where);
	    
		if($this->form_validation->run('role_add') == FALSE) {
		

	      $this->load->view('administrator/include/inner_header',$data);
		  $this->load->view('administrator/rolemanagement/role_add',$data);
		  $this->load->view('administrator/include/inner_footer');
	
		}else{
			
			$add['role_name'] = $this->input->post('role_name');
			$add['role_update_date'] = date('Y-m-d');
			$where = array('role_id' => $data['roleID']);
			$inserted = $this->model->update('tbl_user_role', $add, $where);
				if($inserted){
					$this->session->set_flashdata('success', 'Update role successfully');
					redirect(base_url().'administrator/roles');
				}
        }
     }else{
     	  $this->load->view('administrator/include/inner_header',$data);
		  $this->load->view('administrator/rolemanagement/roles',$data);
		  $this->load->view('administrator/include/inner_footer');
     }
}

function permissions() 
 {
 	    $data['title'] = 'Admin | Permissions';
		$data['active_tab_user'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],26);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['basesegment'] = $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['roleList'] = $this->model->get_data('*','tbl_user_role', array('role_id!='=>1));

		if($data['segment'] == 'add'){
	  	
         $data['title'] = 'Admin | Add Permissions';
         $data['permissionList'] = $this->model->get_all('*', 'tbl_permission');
        
        if($this->form_validation->run('addpermission') == FALSE) {
		
			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/usermanagement/addpermision',$data);
			$this->load->view('administrator/include/inner_footer');
		
		} else {

			$perRole = $this->model->get_data('*','tbl_role_permission', array('role_id' => $this->input->post('roles')));
			if(count($perRole)!=0){
                $this->session->set_flashdata('error', 'Already permission has been assigned to this module');
				redirect(base_url().'administrator/permissions/add');
			}else{

		    $permission_id = $this->input->post('permission_id');

			if(isset($permission_id) && !empty($permission_id)){
			foreach ($permission_id as $permission) {
				
				$permission_tye['role_id'] = $this->input->post('roles');
				$permission_tye['permission_id'] = $permission;
				// $permission_tye['user_id'] = $lastInsertID;
				$permission_type = $this->input->post('permission_type_'.$permission.'');
				//print_r($permission_type);
				$permission_tye['add_permission'] = 0;
				$permission_tye['edit_permission'] = 0;
				$permission_tye['view_permission'] = 0;
				$permission_tye['delete_permission'] = 0;
				$permission_tye['status_change_permission'] = 0;
				if(isset($permission_type)){
					foreach ($permission_type as $ptype) {
				if ($ptype == 1) {$permission_tye['add_permission'] = 1;}		     		   	
				if ($ptype == 2) { $permission_tye['edit_permission'] = 1;}
				if ($ptype == 3) {$permission_tye['view_permission'] = 1;}
				if ($ptype == 4) {$permission_tye['delete_permission'] = 1;}
				if ($ptype == 5) {$permission_tye['status_change_permission'] = 1;}
					
				}
				$inserted = $this->model->insert_data('tbl_role_permission',$permission_tye);
				}else{
				  $this->session->set_flashdata('error', 'Please Select Permission type');
				  redirect(base_url().'administrator/permissions/add');
				}
				
				}
		    }else{
		    	$this->session->set_flashdata('error', 'Please Select Permission');
				redirect(base_url().'administrator/permissions/add');
		    }
			if($inserted){
				$this->session->set_flashdata('success', 'Add Permission Successfully');
				redirect(base_url().'administrator/roles');
			}

			}
		} 
	  }
	  else if($data['segment'] == 'edit'){
   
	  $data['title'] = 'Edit Sub Admin';
	  $data['roleID'] =$this->uri->segment(4);
	 // $data['userDetail'] = $this->model->get_row('tbl_user_master',array('user_id'=>$data['roleID']));
	  $data['permissionList'] = $this->model->get_all('*', 'tbl_permission');
	

	  /*if($this->form_validation->run('addpermission') == FALSE) {
		
			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/usermanagement/addpermision',$data);
			$this->load->view('administrator/include/inner_footer');
		
		} else */if(isset($_POST['submit'])){

			$permission_id = $this->input->post('permission_id');	
			if(isset($permission_id) && !empty($permission_id)){
				
			foreach ($permission_id as $permission) {
				//echo $permission;
			   $permission_tye['permission_id'] = $permission;
			   $permission_tye['role_id'] = $data['roleID'];
			   $permission_type = $this->input->post('permission_type_'.$permission.'');
			   $permission_tye['add_permission'] = 0;
			   $permission_tye['edit_permission'] = 0;
			   $permission_tye['view_permission'] = 0;
			   $permission_tye['delete_permission'] = 0;
			   $permission_tye['status_change_permission'] = 0;
               if(isset($permission_type)){
               $condition2 = array('role_id' =>$data['roleID']);
			   $this->db->delete('tbl_role_permission', $condition2);	
	            foreach ($permission_type as $ptype) {
					if ($ptype == 1) {$permission_tye['add_permission'] = 1;}		     		   	
					if ($ptype == 2) { $permission_tye['edit_permission'] = 1;}
					if ($ptype == 3) {$permission_tye['view_permission'] = 1;}
					if ($ptype == 4) {$permission_tye['delete_permission'] = 1;}
					if ($ptype == 5) {$permission_tye['status_change_permission'] = 1;}
			    		
				}
                $update = $this->model->insert_data('tbl_role_permission',$permission_tye);
              }else{
				  $this->session->set_flashdata('error', 'Please Select Permission type');
				  redirect(base_url().'administrator/permissions/edit/'.$data['roleID']);
				}
            
			}
			if($update){
				$this->session->set_flashdata('success', 'Update Permission');
				redirect(base_url().'administrator/roles');
			}
		  }else{
              $this->session->set_flashdata('error', 'Please Select Permission');
              redirect(base_url().'administrator/permissions/edit/'.$data['roleID']);
		  }
		} 
		   $this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/usermanagement/addpermision',$data);
			$this->load->view('administrator/include/inner_footer');

	  }


}

public function updateprofile(){
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;
		//print_r($data['userinfo']);
		$data['u_id'] = $this->data['user_id'];
		$data['userID'] = $data['u_id'];
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		 
		$data['title']= "Admin | Profile";
		$data['active_profile_page'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment']= $this->uri->segment(3);
		
		$data['userDetail'] = $this->model->get_row('tbl_user_master',array('user_id' => $data['u_id']));
		//print_r($data['userDetail']);
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/usermanagement/edituser',$data);
		$this->load->view('administrator/include/inner_footer');
    }
    	public function addPersonalDatail()
	{
        $assign_permission['role_id'] =  $this->input->post('roles');
		if($assign_permission['role_id'] != 1){
		  $personalDetail['siterole_id'] = 3;
		}else{
		  $personalDetail['siterole_id'] = 2;
		}
		//$data['segment']= $this->uri->segment(1);
		$personalDetail['username'] = $this->input->post('username');
		$personalDetail['fname'] = $this->input->post('fname');
		$personalDetail['lname'] = $this->input->post('lname');
		$personalDetail['email'] = $this->input->post('email');
		$personalDetail['password'] = '';
		if(!empty($this->input->post('password'))){
			$personalDetail['password'] = base64_encode($this->input->post('password'));
		}else{
			$personalDetail['password'] = base64_encode('123456');
		}
		$personalDetail['address'] = $this->input->post('address');
		$personalDetail['gender'] = $this->input->post('gender');
		$personalDetail['dob'] = $this->input->post('dob');
		$personalDetail['contact_no'] = $this->input->post('contact_no');
		$personalDetail['occupation'] = $this->input->post('occupation');
		$personalDetail['login_type'] = 'NM';
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
		 $insert = $this->model->insert_data('tbl_user_master',$personalDetail);
		 $lastInsertID = $this->db->insert_id();
         $assign_permission['user_id'] = $lastInsertID;
		 $this->model->insert_data('tbl_user_assign_permission',$assign_permission);
		
		if($insert){
      	        $row =  $this->model->get_row('email_templates',array('title'=>'RegistrationByAdmin'));
				$subject = $row->subject;
				$content= $row->content;
				$link = base_url().'verify/'.$lastInsertID; 
				$content= str_replace("{varifyLink}",$link,$content);
				$content= str_replace("{username}",$personalDetail['fname'],$content);
				$content= str_replace("{email}",$personalDetail['email'],$content);
				$content= str_replace("{password}",base64_decode($personalDetail['password']),$content);
				$content= str_replace("{user_email_address}",$personalDetail['email'],$content);
				$this->sendingMail($personalDetail['email'], $subject, $content); ## Mail sent
	        echo 1;	
	    }else{
			echo 0;
		}

	} 
	public function editPersonalDatail()
	{
      
		$data['user_id'] =  $this->input->post('user_id');
		$assign_permission['role_id'] =  $this->input->post('roles');
		if($assign_permission['role_id'] == 1){
		    $personalDetail['siterole_id'] = 2;
		}else if($assign_permission['role_id'] == 0){
			$personalDetail['siterole_id'] = 1;
		}else{
			$personalDetail['siterole_id'] = 3;
		}

		$assign_permission['user_id'] =  $data['user_id'];
		$data['role'] =  $this->input->post('role');
		$data['roleupdate'] =  $this->input->post('roleupdate');
		//$data['segment']= $this->uri->segment(1);
		$personalDetail['login_type'] = 'NM';
		$personalDetail['username'] = $this->input->post('username');
		$personalDetail['fname'] = $this->input->post('fname');
		$personalDetail['lname'] = $this->input->post('lname');
		$personalDetail['email'] = $this->input->post('email');
		$personalDetail['address'] = $this->input->post('address');
		$personalDetail['gender'] = $this->input->post('gender');
		$personalDetail['dob'] = $this->input->post('dob');
		$personalDetail['contact_no'] = $this->input->post('contact_no');
		$personalDetail['occupation'] = $this->input->post('occupation');
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
		
		if($update){

                $role_prm = $this->model->get_row('tbl_user_assign_permission',array('user_id'=>$data['user_id']));
                if(isset($role_prm->role_id)){
                  if($role_prm->role_id !=$assign_permission['role_id']){
						$old_role =  $this->model->get_row('tbl_user_role',array('role_id'=>$role_prm->role_id));
						$new_role = $this->model->get_row('tbl_user_role',array('role_id'=>$assign_permission['role_id']));
                        $row =  $this->model->get_row('email_templates',array('title'=>'AdminUpdateRole'));
						$subject = $row->subject;
						$content= $row->content;
						$content= str_replace("{username}",$personalDetail['fname'],$content);
						$content= str_replace("{user_email_address}",$personalDetail['email'],$content);
						$content= str_replace("{old_role}",$old_role->role_name,$content);
						$content= str_replace("{new_role}",$new_role->role_name,$content);
						$this->sendingMail($personalDetail['email'], $subject, $content); ## Mail sent

                  }else{
                  	    $row =  $this->model->get_row('email_templates',array('title'=>'ProfileUpdate'));
						$subject = $row->subject;
						$content= $row->content;
						$content= str_replace("{username}",$personalDetail['fname'],$content);
						$content= str_replace("{user_email_address}",$personalDetail['email'],$content);
						$this->sendingMail($personalDetail['email'], $subject, $content); ## Mail sent
                  }
                }
				$rolep= $this->model->get_row('tbl_user_assign_permission', array('user_id'=>$data['user_id']));
				if(isset($rolep->user_id) && !empty($rolep->user_id)){
				   $this->model->update('tbl_user_assign_permission',$assign_permission,$condition);
				}else{
					if($data['user_id'] !=1){
						$this->model->insert_data('tbl_user_assign_permission',$assign_permission);
					}
				}

	      echo 1;	
	    }else{
			echo 0;
		}

	} 

	public function Editprofile()
	{
      
		$data['user_id'] =  $this->input->post('user_id');
		$data['role'] =  $this->input->post('role');
		$data['roleupdate'] =  $this->input->post('roleupdate');
		//$data['segment']= $this->uri->segment(1);
		$personalDetail['username'] = $this->input->post('username');
		$personalDetail['fname'] = $this->input->post('fname');
		$personalDetail['lname'] = $this->input->post('lname');
		$personalDetail['email'] = $this->input->post('email');
		$personalDetail['address'] = $this->input->post('address');
		$personalDetail['gender'] = $this->input->post('gender');
		$personalDetail['dob'] = $this->input->post('dob');
		$personalDetail['contact_no'] = $this->input->post('contact_no');
		$personalDetail['occupation'] = $this->input->post('occupation');
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
		
		if($update){
	      echo 1;	
	    }else{
			echo 0;
		}

	} 
//---------------------------------
// EMAIL EXISTS (true or false)
//---------------------------------
private function email_exists($email)
{
  $this->db->where('email', $email);
  $query = $this->db->get('tbl_user_master');
  if( $query->num_rows() > 0 ){ 
  	return TRUE; 
  } else { 
  	return FALSE; 
  }
}

//---------------------------------
// AJAX REQUEST, IF EMAIL EXISTS
//---------------------------------
function register_email_exists()
{
 
  if (array_key_exists('email',$_POST)) {
    if ( $this->email_exists($this->input->post('email')) == TRUE ) {
      echo json_encode(FALSE);
    } else {
      echo json_encode(TRUE);
    }
  }
}



/**
	 * cmspage Page for this controller.
	 */

function cmspage(){

		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],29);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		 
		$data['title']= "Admin | CMS Managment";
		$data['active_cms_page'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment']= $this->uri->segment(3);
		$data['cmsPageList'] = $this->model->get_all_order_by('*', 'tbl_cms_pages','id','DESC');
		
		 if($data['segment'] == 'addcmspage') {

		 if($this->form_validation->run('addcmspage') == FALSE) {
		 	if (isset($result)) {
			  	if($result[0]->permission_id == 29){
			  		if($result[0]->add_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}

			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/cms/add_cms_page',$data);;
			$this->load->view('administrator/include/inner_footer');	
		
		 } else {

		 	$cmspage['page_name'] = $this->input->post('title');
		 	$cmspage['menu_name'] = $this->input->post('menu_name');
            $cmspage['slag'] = str_replace(" ", "-", preg_replace('/[^A-Za-z0-9\-]/','-',strtolower($cmspage['menu_name']))); 
		 	$cmspage['content'] = $this->input->post('content');
		 	$cmspage['mata_description'] = $this->input->post('mata_description');
		 	$cmspage['mata_keywords'] = $this->input->post('mata_keywords');
		 	$cmspage['mata_author'] = $this->input->post('mata_author');
		 	$cmspage['mata_viewport'] = $this->input->post('mata_viewport');
		 	
		 	
		 	//Insert into tbl_trail_master table
			$inserted = $this->model->insert_data('tbl_cms_pages',$cmspage);
			if($inserted){
				$this->session->set_flashdata('success', 'The page is Successfully inserted');
				redirect(base_url().'administrator/cmspage');
			}
		 	
		 }
		
		}
		
		else if($data['segment'] == 'editcmspage') {
            if (isset($result)) {
			  	if($result[0]->permission_id == 29){
			  		if($result[0]->edit_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
		   $data['pageID']= $this->uri->segment(4);
		   $data['aboutus'] = $this->model->get_row('tbl_cms_pages',array('id' => $data['pageID']));	
		

		 if($this->form_validation->run('editcmspage') == FALSE) {

			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/cms/add_cms_page',$data);;
			$this->load->view('administrator/include/inner_footer');	
		
		 } else {

		 	$cmspage['page_name'] = $this->input->post('title');
		 	$cmspage['menu_name'] = $this->input->post('menu_name');
		 	$cmspage['slag'] = str_replace(" ", "-", preg_replace('/[^A-Za-z0-9\-]/','-',strtolower($cmspage['menu_name']))); 
		 	$cmspage['content'] = $this->input->post('content');
		 	$cmspage['mata_description'] = $this->input->post('mata_description');
		 	$cmspage['mata_keywords'] = $this->input->post('mata_keywords');
		 	$cmspage['mata_author'] = $this->input->post('mata_author');
		 	$cmspage['mata_viewport'] = $this->input->post('mata_viewport');
		 	
		 	$where = array('id' => $data['pageID']);
		 	$inserted = $this->model->update('tbl_cms_pages', $cmspage, $where);
		 	
		 	if($inserted){
				$this->session->set_flashdata('success', 'The page is Successfully update');
				redirect('administrator/cmspage');
			}
		 }
		
		}
		else if($data['basesegment'] == 'contact') {
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],29);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		 $data['aboutus'] = $this->model->get_row('tbl_cms_pages',array('id' => 12));
		 $data['contactUsContent'] = $this->model->get_row('tbl_cms_contact',array('status' => 1));	
			
		 if($this->form_validation->run('contactUs') == FALSE) {
		
				$this->load->view('administrator/include/inner_header',$data);
				$this->load->view('administrator/cms/contact',$data);
				$this->load->view('administrator/include/inner_footer');
		
		  } else {
		
			$cmspage['title'] = $this->input->post('title');
			$cmspage['address'] = $this->input->post('address');
			$cmspage['phone'] = $this->input->post('phone');
			$cmspage['email'] = $this->input->post('email');
			$cmspage['content'] = $this->input->post('content');
			$cmspagemeta['page_name'] = $cmspage['title'] ;
            $cmspagemeta['slag'] = str_replace(" ", "", strtolower($cmspagemeta['page_name'])); 
			$cmspagemeta['mata_description'] = $this->input->post('mata_description');
		 	$cmspagemeta['mata_keywords'] = $this->input->post('mata_keywords');
		 	$cmspagemeta['mata_author'] = $this->input->post('mata_author');
		 	$cmspagemeta['mata_viewport'] = $this->input->post('mata_viewport');			
			
			$where=array('id'=>1);
			$inserted = $this->model->update('tbl_cms_contact', $cmspage,$where);

			$where=array('id'=>12);
			$inserted = $this->model->update('tbl_cms_pages', $cmspagemeta,$where);

			if($inserted){
					$this->session->set_flashdata('success', 'Contact details change succussfully.');
					
			}		
			redirect(base_url().'administrator/contact');


		
		}		
		}  
		else {

			$this->load->view('administrator/include/inner_header',$data);
	        $this->load->view('administrator/cms/cms_page',$data);
	        $this->load->view('administrator/include/inner_footer');

		
		}
	}
	/**
	 * menu for this controller.
	 */

function addmenu(){

		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],30);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');	

	    $data['title']= "Admin | Menu Managment";
		$data['active_tab_menu'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment']= $this->uri->segment(3);
		$where = array('status' => 1);
		$data['cmsPageList'] = $this->model->get_data_order_by('*', 'tbl_cms_pages',$where,'id','DESC');

		$this->load->view('administrator/include/inner_header',$data);
	    $this->load->view('administrator/cms/addmenu',$data);
	    $this->load->view('administrator/include/inner_footer');
}
function changeMenuStatus(){
		//print_r($_POST);die;
	  
	    $id = $this->input->post('id');
		$status = $this->input->post('status');	
		$tablename = $this->input->post('tablename');
		
		/****************** tbl_cms_pages********************/

		if($tablename == 'tbl_cms_pages'){
			$data=array('show_in_menu'=>$status);
			$where=array('id'=> $id);
		}
		
       	$this->model->update($tablename, $data,$where); 
       	//echo $this->db->last_query();
		echo $i = $this->db->affected_rows();
        
    }
      /**
	 * rentalplan management Page for this controller.
	 */
function rentalplan() 
 {
 	    $data['title'] = 'Admin | Rental Plan';
		$data['active_tab_vacation'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],16);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['basesegment'] = $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['PlanList'] = $this->model->get_all('*','plan_master');
		if($data['segment'] == 'add') {
			if (isset($result)) {
			  	if($result[0]->permission_id == 1){
			  		if($result[0]->add_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
			if($this->form_validation->run('plan_add') == FALSE) {

				  $this->load->view('administrator/include/inner_header',$data);
				  $this->load->view('administrator/planmanagement/plan_add',$data);
				  $this->load->view('administrator/include/inner_footer');

			} else {
				$add['pl_name'] = $this->input->post('pl_name');
				$add['pl_description'] = $this->input->post('pl_description');
				$add['pl_days'] = $this->input->post('pl_days');
				$add['pl_months'] = $this->input->post('pl_months');
				$add['pl_year'] = $this->input->post('pl_year');
				$add['pl_price'] = $this->input->post('pl_price');
				$inserted = $this->model->insert_data('plan_master',$add);
				if($inserted){
					$this->session->set_flashdata('success', 'Add plan successfully');
					redirect(base_url().'administrator/rentalplan');
				}
				
			}
		}else if($data['segment'] == 'edit') {
		if (isset($result)) {
		  	if($result[0]->permission_id == 1){
		  		if($result[0]->add_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		}
	   
		$data['planID']= $this->uri->segment(4);
        $where = array('pl_id' => $data['planID']);
	    $data['pl_name'] = $this->model->get_row('plan_master', $where);
	    
		if($this->form_validation->run('plan_add') == FALSE) {
		

	      $this->load->view('administrator/include/inner_header',$data);
		  $this->load->view('administrator/planmanagement/plan_add',$data);
		  $this->load->view('administrator/include/inner_footer');
	
		}else{
			
				$add['pl_name'] = $this->input->post('pl_name');
				$add['pl_description'] = $this->input->post('pl_description');
				$add['pl_days'] = $this->input->post('pl_days');
				$add['pl_months'] = $this->input->post('pl_months');
				$add['pl_year'] = $this->input->post('pl_year');
				$add['pl_price'] = $this->input->post('pl_price');
			$where = array('pl_id' => $data['planID']);
			$inserted = $this->model->update('plan_master', $add, $where);
				if($inserted){
					$this->session->set_flashdata('success', 'Edit plan successfully');
					redirect(base_url().'administrator/rentalplan');
				}
        }
     }else{
     	  $this->load->view('administrator/include/inner_header',$data);
		  $this->load->view('administrator/planmanagement/plan',$data);
		  $this->load->view('administrator/include/inner_footer');
     }
}
    /**
	 * State management Page for this controller.
	 */
function state() 
 {
 	    $data['title'] = 'Admin | State';
		$data['active_tab_state'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],6);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['basesegment'] = $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['stateList'] = $this->model->get_all('*','tbl_state');
		if($data['segment'] == 'add') {
			if (isset($result)) {
			  	if($result[0]->permission_id == 6){
			  		if($result[0]->add_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
			if($this->form_validation->run('state_add') == FALSE) {

				  $this->load->view('administrator/include/inner_header',$data);
				  $this->load->view('administrator/statemanagement/state_add',$data);
				  $this->load->view('administrator/include/inner_footer');

			} else {
				$add['user_id'] = $data['u_id'];
				$add['state_name'] = $this->input->post('state_name');
				$inserted = $this->model->insert_data('tbl_state',$add);
				if($inserted){
					$this->session->set_flashdata('success', 'Add State successfully');
					redirect(base_url().'administrator/state');
				}
				
			}
		}else if($data['segment'] == 'edit') {
			if (isset($result)) {
			  	if($result[0]->permission_id == 6){
			  		if($result[0]->edit_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
		   
		$data['stateID']= $this->uri->segment(4);
        $where = array('state_id' => $data['stateID']);
	    $data['stateDetail'] = $this->model->get_row('tbl_state', $where);
	    
		if($this->form_validation->run('state_add') == FALSE) {
		

	      $this->load->view('administrator/include/inner_header',$data);
		  $this->load->view('administrator/statemanagement/state_add',$data);
		  $this->load->view('administrator/include/inner_footer');
	
		}else{
			
			$add['state_name'] = $this->input->post('state_name');
			$add['last_modify_user_id'] = $data['u_id'];
            $add['last_modify_date'] = date("Y-m-d");
			$where = array('state_id' => $data['stateID']);
			$inserted = $this->model->update('tbl_state', $add, $where);
				if($inserted){
					$this->session->set_flashdata('success', 'Edit State successfully');
					redirect(base_url().'administrator/state');
				}
        }
     }else{
     	  $this->load->view('administrator/include/inner_header',$data);
		  $this->load->view('administrator/statemanagement/state',$data);
		  $this->load->view('administrator/include/inner_footer');
     }
}
	/**
	 * KML Page for this controller.
	 */
function kmlmanagement() 
	 {

		$data['title'] = 'Admin | Trail';
		$data['active_tab_kml'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],2);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['basesegment']= $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$data['trailList'] = $this->model->get_data('*', 'tbl_trail_type_master', array('trail_status' =>0));
		$data['kmlList'] = $this->model->get_data_order_by('*', 'tbl_trail_master', array(1 =>1),'trail_type_id','DESC');
		//$data['kmlList'] = $this->model->get_data_order_by('*', 'tbl_trail_master', array('trail_kml_upload_by' =>1),'trail_type_id','DESC');
        $data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
        $data['getState'] = $this->model->get_data('*', 'tbl_state', array('state_status'=>1));
       
		if($data['segment'] == 'uploadkml') {
			if (isset($result)) {
			  	if($result[0]->permission_id == 2){
			  		if($result[0]->edit_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}

		if($this->form_validation->run('addtrail') == FALSE) {

			  $this->load->view('administrator/include/inner_header',$data);
			  $this->load->view('administrator/kmlmanagement/trail_type_add',$data);
			  $this->load->view('administrator/include/inner_footer');
		
		} else {
			$addkml['trail_type_name'] = $this->input->post('trail_name');
			$addkml['description'] = $this->input->post('description');
			$addkml['region_name'] = $this->input->post('region_name');
			$addkml['trail_kml_upload_by'] = $data['u_id'];
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
					    $addkml['trail_kml_path']= $file_path;
					
						move_uploaded_file($_FILES['trail_kml_path']['tmp_name'] ,$file_path);
	                }else{
	                	$this->session->set_flashdata('error', 'Please Upload only kml file');

	                    redirect(base_url().'administrator/kmlmanagement/uploadkml');
	                }
				}
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
					if(isset($point)){
						 for($j = 0; $j < sizeof($point); $j++){

							  $coordinates = $point[$j]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark1[$i]->name;
							  $kmldata['upload_by_id'] = 1;
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);
						}

					}
					if(isset($point1)){

							 for($j = 0; $j < sizeof($point1); $j++){
							  $coordinates = $point1[$j]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark1[$i]->name;
							  $kmldata['upload_by_id'] = 1;
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);

						}
					}
				}

			    }else if(isset($Placemark)  && !empty($Placemark)){
			    	for ($i = 0; $i < sizeof($Placemark); $i++) {
					$point = $Placemark[$i]->MultiGeometry->LineString;
					$point1 = $Placemark[$i]->LineString;
					if(isset($point)){
						 for($j = 0; $j < sizeof($point); $j++){

							  $coordinates = $point[$j]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark[$i]->name;
							  $kmldata['upload_by_id'] = 1;
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);
						}

					}
					if(isset($point1)){

							 for($j = 0; $j < sizeof($point1); $j++){
							  $coordinates = $point1[$j]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark[$i]->name;
							  $kmldata['upload_by_id'] = 1;
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);

						}
					}
					
				}

			    }else  if(isset($Placemark2) && !empty($Placemark2)){  

                 	for ($iii = 0; $iii < sizeof($Placemark2); $iii++) {
					$point = $Placemark2[$iii]->MultiGeometry->LineString;
					//$kmldata['trail_dscrptn'] = $Placemark2[$i]->description;
					$point1 = $Placemark2[$iii]->LineString;
					if(isset($point)){
						 for($jjj = 0; $jjj < sizeof($point); $jjj++){

							  $coordinates = $point[$jjj]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark2[$iii]->name;
							  $kmldata['upload_by_id'] = 1;
							  $inserted = $this->model->insert_data('tbl_kml_data_trail',$kmldata);
						}

					}
					if(isset($point1)){

							 for($jjj = 0; $jjj < sizeof($point1); $jjj++){
							  $coordinates = $point1[$jjj]->coordinates;
							  $kmldata['lat_lang'] =$coordinates;
							  $kmldata['klm_trail_name'] = $Placemark2[$iii]->name;
							  $kmldata['upload_by_id'] = 1;
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
							  $kmldata1['zipcode'] = $Placemark[$ii]->ZipCode;
							  $kmldata1['county_detail'] = $Placemark[$ii]->description;
							  $kmldata1['upload_by_id'] = 1;
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
									$kmldata1['zipcode'] = $Placemark[$ii]->ZipCode;
									$kmldata1['county_detail'] = $Placemark[$ii]->description;
									$kmldata1['upload_by_id'] = 1;
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
					  $kmldata['upload_by_id'] = 1;
	                  $inserted = $this->model->insert_data('tbl_kml_data',$kmldata);

				  }
			}
		}
			if($inserted){
				$this->session->set_flashdata('success', 'Upload KML file successfully');
				
				redirect(base_url().'administrator/kmlmanagement');
			}
		
		} 
	}else { 
			$this->load->view('administrator/include/inner_header',$data);
	        $this->load->view('administrator/kmlmanagement/trail_type',$data);
	        $this->load->view('administrator/include/inner_footer');

		
		}
	}

	/**
	 * POI Page for this controller.
	 */

	function poilist() 
	 {

	 	$info=$this->session->all_userdata();
		$data['userinfo']=$info;
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],3);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['title'] = 'Admin | POIs';
		$data['active_tab_poi'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$data['trailList'] = $this->model->get_data('*', 'tbl_trail_type_master', array('trail_status' =>0));
		$data['stateList'] = $this->model->get_data('*', 'tbl_state', array('state_status' =>1));
		//print_r($data['trailList']);
        $where = array(1 => 1 );
        $data['kmlList'] = $this->model->get_data_order_by('*','tbl_kml_data', $where, 'kml_data_id','DESC');
		//$data['kmlList'] = $this->model->get_data_rl_join('tbl_trail_master.*, tbl_kml_data.*', 'tbl_trail_master','tbl_kml_data','trail_type_id','trail_fk_id', $where, 'kml_data_id', 'DESC','LEFT');
		
       if($data['segment'] == 'editpoi') {
       	if (isset($result)) {
		  	if($result[0]->permission_id == 3){
		  		if($result[0]->edit_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		}
		   
		$data['poiID']= $this->uri->segment(4);
        $where = array('kml_data_id' => $data['poiID']);
        $data['poiDetail'] = $this->model->get_data('tbl_kml_data.*', 'tbl_kml_data',$where);
	    //$data['poiDetail'] = $this->model->join_where('tbl_trail_master.*, tbl_kml_data.*', 'tbl_trail_master','tbl_kml_data','trail_type_id','trail_fk_id',$where, 'kml_data_id', 'DESC');


	  	if($this->form_validation->run('editpoi') == FALSE) {
		
		
			$this->load->view('administrator/include/inner_header',$data);
		    $this->load->view('administrator/POI/poi_add',$data);
		    $this->load->view('administrator/include/inner_footer');
	
		} else {
			
			$addpoi['kml_data_name'] = $this->input->post('kml_data_name');
			$addpoi['region_name'] = $this->input->post('region_name');
			$addpoi['poi_type'] = $this->input->post('trail_type_id');
			$addpoi['last_modify_user_id'] = $data['u_id'];
            $addpoi['last_modify_date'] = date("Y-m-d");
			//$addpoi['upload_by_id'] = 1;
			
			/***********GET LAT LONG************/

            $latlong = $this->get_lat_long($this->input->post('kml_data_name'));
			//$addpoi['kml_data_lat'] = $latlong['lat'];
			//$addpoi['kml_data_lang'] = $latlong['lng'];
			$addpoi['lat_lang']=$latlong['lng'].','.$latlong['lat'].',0';

			/***********GET LAT LONG************/

			$where= array('kml_data_id'=>$data['poiID']);

			$update = $this->model->update('tbl_kml_data',$addpoi,$where);
			//echo $this->db->last_query();
			if($update){
				$this->session->set_flashdata('success', 'The POIs is Successfully update');
				redirect(base_url().'administrator/poilist');
			}
		
		}
		
		
	   }else if($data['segment'] == 'addpoi'){
		   	if (isset($result)) {
			  	if($result[0]->permission_id == 3){
			  		if($result[0]->add_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
		   if($this->form_validation->run('editpoi') == FALSE) {
				$this->load->view('administrator/include/inner_header',$data);
			    $this->load->view('administrator/POI/poi_add',$data);
			    $this->load->view('administrator/include/inner_footer');
		   }else{

			   	$addpoi['kml_data_name'] = $this->input->post('kml_data_name');
				$addpoi['region_name'] = $this->input->post('region_name');
				//$addpoi['trail_fk_id'] = $this->input->post('trail_type_id');
				$addpoi['poi_type'] = $this->input->post('trail_type_id');
				$addpoi['upload_by_id'] = $data['u_id'];
				
				/***********GET LAT LONG************/

	            $latlong = $this->get_lat_long($this->input->post('kml_data_name'));
				//$addpoi['kml_data_lat'] = $latlong['lat'];
				//$addpoi['kml_data_lang'] = $latlong['lng'];
				$addpoi['lat_lang']=$latlong['lng'].','.$latlong['lat'].',0';

					

				/***********GET LAT LONG************/
				$update = $this->model->insert_data('tbl_kml_data',$addpoi);
				//echo $this->db->last_query();
				if($update){
					$this->session->set_flashdata('success', 'The POIs is Successfully Added');
					redirect(base_url().'administrator/poilist');
				}

		   }


	   }else { 
			$this->load->view('administrator/include/inner_header',$data);
	        $this->load->view('administrator/POI/pois',$data);
	        $this->load->view('administrator/include/inner_footer');

		
		}
	}

	/**
	 * trail list Page for this controller.

	 */
	public function TrailReportApprove(){
		$tablename= $this->input->post('tablename');
		$ID= $this->input->post('ID');
		$userUpdateTrail = $this->model->get_row('trail_report_user_update', array('ID'=>$ID));
		$state_name = $userUpdateTrail->state_name;
		$countyName = $userUpdateTrail->CountyID;
		$trail_report_conditions =$userUpdateTrail->trail_report_conditions;
		$username = $this->model->get_row('tbl_user_master', array('user_id'=>$userUpdateTrail->userID));
		
		$this->model->update($tablename, array('trail_report_status' => 1), array('ID' =>$ID));
		$update = $this->model->update('county_trail_report',array('submitted_by' => $username->fname.' '.$username->lname, 'trail_conditions'=>$trail_report_conditions),array('region_name' =>$state_name, 'county_name' =>$countyName));
		if($update){
			echo 1;

			$row1 =  $this->model->get_row('email_templates',array('title'=>'TrailAndTrailReportUpdate'));
			$subject = $row1->subject;
			$message = $row1->content;
			$message = str_replace("{username}",ucfirst($username->fname),$message);
			$message = str_replace("{trail_type}",'Trail Report',$message);
			$message = str_replace("{user_email_address}",$username->email,$message);
			$message = str_replace("{trail_name}",ucfirst($countyName),$message);
			$message = str_replace("{trail_update_details}",ucfirst($trail_report_conditions),$message);
			$this->sendingMail($username->email,$subject, $message);
            
            $subUser = $this->model->get_data('*','tbl_subscribe_user',array('trail_type'=>'trail_report', 'trail_name'=>$countyName));
            if(isset($subUser)){
	            foreach ($subUser as $su) {
	            $subUserName = $this->model->get_row('tbl_user_master',array('user_id'=>$su->subc_user_id));
	            $row1 =  $this->model->get_row('email_templates',array('title'=>'TrailAndTrailReportUpdate'));
				$subject = $row1->subject;
				$message = $row1->content;
				$userName = $userDetail->fname;
				$message = str_replace("{username}",ucfirst($subUserName->fname),$message);
				$message = str_replace("{trail_type}",'Trail Report',$message);
				$message = str_replace("{user_email_address}",$su->subc_user_email,$message);
				$message = str_replace("{trail_name}",ucfirst($countyName),$message);
				$message = str_replace("{trail_update_details}",ucfirst($trail_report_conditions),$message);
				$this->sendingMail($su->subc_user_email,$subject, $message);

	            }
            } 
		}

	}
	public function changeTrailReportStatus(){

		$field = $_POST['field'];
		$value = $_POST['value'];
		$wherefield = $_POST['wherefield'];
		$wherevalue = $_POST['wherevalue'];
		$table = $_POST['table'];

		$array = array(
		     $field=>$value	 
		);
		$where = array(
		      $wherefield=>$wherevalue
		);
       
		$this->model->update($table,$array,$where);
        echo $value;
	}
public function changeTrailStatusChange(){

	$field = $_POST['field'];
	$value = $_POST['value'];
	$wherefield = $_POST['wherefield'];
	$wherevalue = $_POST['wherevalue'];
	$table = $_POST['table'];

	$field2 = $_POST['field2'];
	$value2 = $_POST['value2'];
	$wherefield2 = $_POST['wherefield2'];
	$wherevalue2 = $_POST['wherevalue2'];

	$wherefield3 = $_POST['wherefield3'];
	$wherevalue3 = $_POST['wherevalue3'];

	$wherefield4 = $_POST['wherefield4'];
	$wherevalue4 = $_POST['wherevalue4'];

	$table2 = $_POST['table2'];

	$array = array(
	     $field=>$value	 
	);
	$where = array(
	      $wherefield=>$wherevalue
	);
	$array2 = array(
	     $field2=>$value2,$wherevalue3=>$wherefield3,$wherevalue4=>$wherefield4	 
	);
	$where2 = array(
	      $wherefield2=>$wherevalue2
	);
   
	$this->model->update($table,$array,$where);
	$this->model->update($table2,$array2,$where2);
	echo $value;
		$ID= $wherevalue;
		$userUpdateTrail = $this->model->get_row('tbl_trail_report', array('trail_report_id'=>$ID));

		$username = $this->model->get_row('tbl_user_master', array('user_id'=>$userUpdateTrail->user_id));
		$row1 =  $this->model->get_row('email_templates',array('title'=>'TrailAndTrailReportUpdate'));
		$subject = $row1->subject;
		$message = $row1->content;
		$message = str_replace("{username}",ucfirst($username->fname),$message);
		$message = str_replace("{trail_type}",'Trail',$message);
		$message = str_replace("{user_email_address}",$username->email,$message);
		$message = str_replace("{trail_name}",ucfirst($wherevalue2),$message);
		$message = str_replace("{trail_update_details}",ucfirst($wherefield3),$message);
		$this->sendingMail($username->email,$subject, $message);
    
    $subUser = $this->model->get_data('*','tbl_subscribe_user',array('trail_type'=>'trail', 'trail_name'=>$wherevalue2));
    if(isset($subUser)){
        foreach ($subUser as $su) {
        $subUserName = $this->model->get_row('tbl_user_master',array('user_id'=>$su->subc_user_id));
        $row1 =  $this->model->get_row('email_templates',array('title'=>'TrailAndTrailReportUpdate'));
		$subject = $row1->subject;
		$message = $row1->content;
		$message = str_replace("{username}",ucfirst($subUserName->fname),$message);
		$message = str_replace("{trail_type}",'Trail',$message);
		$message = str_replace("{user_email_address}",$subUserName->email,$message);
		$message = str_replace("{trail_name}",ucfirst($wherevalue2),$message);
		$message = str_replace("{trail_update_details}",ucfirst($wherefield3),$message);
		$this->sendingMail($subUserName->email,$subject, $message);

        }
    } 

}

public function changeTrailStatus(){

		$field = $_POST['field'];
		$value = $_POST['value'];
		$wherefield = $_POST['wherefield'];
		$wherevalue = $_POST['wherevalue'];
		$table = $_POST['table'];

		$field2 = $_POST['field2'];
		$value2 = $_POST['value2'];
		$wherefield2 = $_POST['wherefield2'];
		$wherevalue2 = $_POST['wherevalue2'];
		$table2 = $_POST['table2'];

		$array = array(
		     $field=>$value	 
		);
		$where = array(
		      $wherefield=>$wherevalue
		);
		$array2 = array(
		     $field2=>$value2	 
		);
		$where2 = array(
		      $wherefield2=>$wherevalue2
		);
       
		$this->model->update($table,$array,$where);
		
		$this->model->update($table2,$array2,$where2);
		echo 	$value;
	}
	function traillist() 
	 {
		 	$info=$this->session->all_userdata();
			$data['userinfo']=$info;
			$data['u_id'] = $this->data['user_id'];
			if($data['u_id'] !=1){
			$result = role_permission($data['u_id'],4);
				if (empty($result)) {
					 redirect(base_url().'access_denied');
				}
		    }
			$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
			$data['title'] = 'Admin | Trail';
			$data['active_tab_trail'] = 'active';
			$data['role'] = $this->data['siterole_id'];
			$data['basesegment']= $this->uri->segment(2);
			$data['segment'] = $this->uri->segment(4);
			$data['trailList'] = $this->model->get_all('*', 'tbl_trail_type_master');
			$query = $this->db->query('SELECT * FROM tbl_kml_data_trail group by klm_trail_name ORDER BY `id` ASC');
            $data['stateList'] = $query->result();

		    $query = $this->db->query('SELECT tbl_kml_data_trail.*, `tbl_trail_report`.* FROM `tbl_trail_report` RIGHT JOIN `tbl_kml_data_trail` ON `tbl_trail_report`.`trail_name`=`tbl_kml_data_trail`.`klm_trail_name` WHERE 1 = 1  group by klm_trail_name ORDER BY `id` DESC');
			$data['kmlList'] = $query->result();

$query1 = $this->db->query('SELECT tbl_kml_data_trail_view.*, `tbl_trail_report`.* FROM `tbl_trail_report` JOIN `tbl_kml_data_trail_view` ON `tbl_trail_report`.`trail_name`=`tbl_kml_data_trail_view`.`klm_trail_name` WHERE `tbl_trail_report`.`status`=0');
            $data['ViewPendingUpdates'] = $query1->result();

		    $this->load->view('administrator/include/inner_header',$data);
	        $this->load->view('administrator/traillist/traillist',$data);
	        $this->load->view('administrator/include/inner_footer');

	 }
	  function trails(){
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
			$result = role_permission($data['u_id'],4);
				if (empty($result)) {
					 redirect(base_url().'access_denied');
				}
		    }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['title'] = 'Admin | Trail';
		$data['active_tab_trail'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['segment'] = $this->uri->segment(2);
		$data['trailList'] = $this->model->get_all('*', 'tbl_trail_type_master');
		$query = $this->db->query('SELECT * FROM tbl_kml_data_trail group by klm_trail_name ORDER BY `id` DESC' );
        $data['stateList'] = $query->result();
	 	if (isset($_GET['state'])) {
	 	//	$query = $this->db->query('SELECT tbl_kml_data_trail.*, `tbl_trail_report`.* FROM `tbl_trail_report` RIGHT JOIN `tbl_kml_data_trail` ON `tbl_trail_report`.`trail_name`=`tbl_kml_data_trail`.`klm_trail_name` WHERE trail_id = "'.$_GET['state'].'" group by klm_trail_name');
            $query = $this->db->query('SELECT tbl_kml_data_trail.*, `tbl_trail_report`.* FROM `tbl_trail_report` RIGHT JOIN `tbl_kml_data_trail` ON `tbl_trail_report`.`trail_name`=`tbl_kml_data_trail`.`klm_trail_name` WHERE  region_name = "'.$_GET['state'].'" group by klm_trail_name');

		    $data['kmlList'] = $query->result();
			$where1 = array('tbl_trail_report.status' => 0,'region_name' => $_GET['state']); 
			$data['ViewPendingUpdates'] = $this->model->get_data_rl_join('tbl_kml_data_trail.*,tbl_trail_report.*', 'tbl_trail_report','tbl_kml_data_trail','trail_name','klm_trail_name',$where1,'tbl_kml_data_trail.id','desc','right');
	 	}
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/traillist/traillist',$data);
		$this->load->view('administrator/include/inner_footer');
	 }
	 function trailDetailEdit(){

        $trail['klm_trail_name'] = $this->input->post('trailName');   
        $oldtrail = $this->input->post('oldtrail');   

		$trail['trail_dscrptn']=$this->input->post('trailDesc');
		$trail['last_updated_date']= date("Y-m-d,h:m:s");
		$where= array('klm_trail_name'=>$oldtrail);
	    $update = $this->model->update('tbl_kml_data_trail',$trail,$where);
	     if($update){
            echo 1;
	    }
		
	}
	public function trail_acitities()
	{
		$inbox_ids = $this->input->post('inbox_ids');   
		$inbox_action=$this->input->post('inbox_action');

		if($inbox_action == 'CloseALLTrails'){
			$set_value = 'previous_trail_status= 1';
	        $sql = 'UPDATE `tbl_kml_data_trail` SET '.$set_value.' WHERE klm_trail_name IN ('.$inbox_ids.')';
            $marks_as_read = $this->db->query($sql);
		}

		if($inbox_action == 'seletAllClose'){
			$set_value = 'previous_trail_status= 1, flag=1';
	        $sql = 'UPDATE `tbl_kml_data_trail` SET '.$set_value.'';
            $marks_as_read = $this->db->query($sql);
		}
		if($inbox_action == 'seletAllOpen'){
			$set_value = 'previous_trail_status= 0, flag=1';
	        $sql = 'UPDATE `tbl_kml_data_trail` SET '.$set_value.'';
            $marks_as_read = $this->db->query($sql);
		}
		if($inbox_action == 'OpenALLTrails'){
			$set_value = 'previous_trail_status= 0';
	        $sql = 'UPDATE `tbl_kml_data_trail` SET '.$set_value.' WHERE klm_trail_name IN ('.$inbox_ids.')';
            $marks_as_read = $this->db->query($sql);
		}
		echo 1;
		die;
	}
	/**
	 * trail Report Page for this controller.

	 */
	public function membershipFeaturePlan()
	{
		$this->db->query('UPDATE `trail_report_user_update` SET `trail_report_status` = 0');
        // SET CONDITIONAL FLAG
		$membership_id= $this->input->post('trailID');

		$basic['trail_report_status'] = 1;

		$condition =  array('ID' => $membership_id);
		$update = $this->model->update('trail_report_user_update',$basic,$condition);
      
		if($update)
		{
			echo 1;
		}
		else{
			echo 0;
		}

	}
	function trailreport() 
	 {
		 	$info=$this->session->all_userdata();
			$data['userinfo']=$info;
			$data['u_id'] = $this->data['user_id'];
			if($data['u_id'] !=1){
			$result = role_permission($data['u_id'],5);
				if (empty($result)) {
					 redirect(base_url().'access_denied');
				}
		    }
			$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
			$data['title'] = 'Admin | Trail Reporting';
			$data['active_tab_trail_report'] = 'active';
			$data['role'] = $this->data['siterole_id'];
	
			$query =$this->db->query('SELECT * FROM county_trail_report WHERE 1 = 1 group by `county_trail_report`.`region_name`,`county_trail_report`.`county_name`');
			$data['trailList']= $query->result();

            $query1 =$this->db->query('SELECT `trail_report_user_update`.*, `tbl_user_master`.`fname`,`tbl_user_master`.`lname`,`tbl_user_master`.`username` from trail_report_user_update LEFT JOIN `tbl_user_master` ON `tbl_user_master`.`user_id`=`trail_report_user_update`.`userID` WHERE `trail_report_user_update`.`trail_report_status`=0');

            $data['ViewPendingUpdates']= $query1->result();
			//echo $this->db->last_query();
			$data['segment'] = $this->uri->segment(2);
			$trailID = str_replace('-', ' ', $this->uri->segment(4));
			$state = str_replace('-', ' ', $this->uri->segment(3));
			if($data['segment'] == 'trailreportedit'){
				if (isset($result)) {
				  	if($result[0]->permission_id == 5){
				  		if($result[0]->edit_permission !=1){
				  		 	redirect(base_url().'access_denied');
				  		}
				  	}
				}
				$query =$this->db->query('SELECT county_trail_report.* FROM `county_trail_report` WHERE county_name = "'.$trailID.'" and region_name = "'.$state.'"');
                $data['trailEdit'] = $query->result();              
				if($this->form_validation->run('trailreportedit') == FALSE) {

				$this->load->view('administrator/include/inner_header',$data);
				$this->load->view('administrator/traillist/trail_report_edit',$data);
				$this->load->view('administrator/include/inner_footer');

				} else {
					$report['region_name'] = $this->input->post('region_name');
					$report['zipcode'] = $this->input->post('zipcode');
	                $report['county_name'] = $this->input->post('county_name');
	                $report['cities'] = $this->input->post('cities');
	                $report['trail_conditions'] = $this->input->post('trail_conditions');
	                $report['submitted_by'] = $this->input->post('submitted_by');
	                $report['county_detail'] = $this->input->post('county_detail');
	                $report['maintainedBy'] = $this->input->post('maintainedBy');
	                $report['update_date'] = date("Y-m-d,h:m:s");
	                $report['last_modify_user_id'] = $data['u_id'];
                    $report['last_modify_date'] = date("Y-m-d");
					$where= array('county_name'=>$trailID, 'region_name'=>$report['region_name']);
				    $update = $this->model->update('county_trail_report',$report,$where);
				    $user_report['trail_report_conditions'] = $this->input->post('trail_conditions');

				     $where1= array('CountyID'=>$trailID, 'state_name' => $state);
				    $update1 = $this->model->update('trail_report_user_update',$user_report,$where1);				  
				    if($update){
				       $this->session->set_flashdata('success', 'The Trail report is Successfully update');
				       redirect(base_url().'administrator/trailreport');
			        }				   
				}
			}else{
			    $this->load->view('administrator/include/inner_header',$data);
		        $this->load->view('administrator/traillist/trailreport',$data);
		        $this->load->view('administrator/include/inner_footer');

			}

		   
	 }

	 public function trail_report_acitities()
	{
		$inbox_ids = $this->input->post('inbox_ids');   
		$inbox_action=$this->input->post('inbox_action');

		if($inbox_action == 'CloseALLTrails'){
			$set_value = 'trail_report_status= 2';
	        $sql = 'UPDATE `trail_report_user_update` SET '.$set_value.' WHERE 	CountyID IN ('.$inbox_ids.')';
            $marks_as_read = $this->db->query($sql);
		}
		if($inbox_action == 'OpenALLTrails'){
			$set_value = 'trail_report_status= 1';
	        $sql = 'UPDATE `trail_report_user_update` SET '.$set_value.' WHERE 	CountyID IN ('.$inbox_ids.')';
            $marks_as_read = $this->db->query($sql);
           // echo $this->db->last_query();
		}
		


		echo 1;
		die;
	}


	/**
	 * news Page for this controller.
	 */
function news() 
	 {

	 	$info=$this->session->all_userdata();
		$data['userinfo']=$info;
		//print_r($data['userinfo']);
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],7);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }

		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		 
		$data['title'] = 'Admin | News';
		$data['active_tab_news'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$data['newList'] = $this->model->get_data_join("*", 'tbl_news','tbl_user_master','user_id','user_id', 'news_id', 'desc');
		//get_all_order_by('*', 'tbl_news','news_id','DESC');
		
		if($data['segment'] == 'addnews') {
			if (isset($result)) {
		  	if($result[0]->permission_id == 7){
		  		if($result[0]->add_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		}
		
		if($this->form_validation->run('addnews') == FALSE) {
		
			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/news/news_add',$data);
			$this->load->view('administrator/include/inner_footer');
		
		} else {
		    if($data['role'] == 3){
             $news['user_id'] = $data['u_id'];
             $news['news_created_by'] = 'sub admin';
		    }else{
		     $news['news_created_by'] = 'admin';
		    }
			$news['news_title'] = $this->input->post('news_title');
			$news['news_description'] = $this->input->post('news_description');			
			$news['news_update_date'] = date("Y-m-d,h:m:s");

			$image_path='';
			  if(!empty($_FILES['news_image']['name'])){
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
	                }/*else{
	                	$this->session->set_flashdata('error', 'Please Upload only image');
	                    redirect(base_url().'administrator/news/addnews');
	                }*/
				
				 }
				}
			}else{
				$this->session->set_flashdata('error', 'Please Upload image');
	            redirect(base_url().'administrator/news/addnews');
			}
			
			//Insert into tbl_trail_cat_master table
			$inserted = $this->model->insert_data('tbl_news',$news);
			if($inserted){
				$this->session->set_flashdata('success', 'The News is Successfully Added');
				redirect(base_url().'administrator/newslist');
			}
		
		} 
	 } 
	 else if($data['segment'] == 'editnews') {
	 	if (isset($result)) {
		  	if($result[0]->permission_id == 7){
		  		if($result[0]->edit_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		}
		   
		$data['newsId']= $this->uri->segment(4);
	    $data['newDetail'] = $this->model->get_data('*', 'tbl_news', array('news_id'=>$data['newsId']));

	   if($this->form_validation->run('editnews') == FALSE) {
		    
		    $this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/news/news_add',$data);
			$this->load->view('administrator/include/inner_footer');
	
		} else {
			
			$news['news_title'] = $this->input->post('news_title');
			$news['news_description'] = $this->input->post('news_description');
			//$news['news_created_by'] = 'admin';
            $news['news_update_date'] = date("Y-m-d,h:m:s");
            $news['last_modify_user_id'] = $data['u_id'];
            $news['last_modify_date'] = date("Y-m-d");
			
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
	                    redirect(base_url().'administrator/news/editnews/'.$data['newsId']);
	                }
				
				 }
				}

			/***********GET Image************/

			$where= array('news_id'=>$data['newsId']);

			$update = $this->model->update('tbl_news',$news,$where);
			if($update){
				$this->session->set_flashdata('success', 'The news is Successfully update');
				redirect(base_url().'administrator/newslist');
			}
		
		}
		
		
	   }else if($data['segment'] == 'viewnews'){
	   	if (isset($result)) {
			  	if($result[0]->permission_id == 7){
			  		if($result[0]->view_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
	      	$data['newsId']= $this->uri->segment(4);
	        $data['newDetail'] = $this->model->get_data('*', 'tbl_news', array('news_id'=>$data['newsId']));
	        $this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/news/news_view',$data);
			$this->load->view('administrator/include/inner_footer');
	   }
	 else { 
			$this->load->view('administrator/include/inner_header',$data);
	        $this->load->view('administrator/news/news',$data);
	        $this->load->view('administrator/include/inner_footer');

		
		}
	}


	/**
	 * Event Page for this controller.
	 */
function events() 
	 {
	 	$info=$this->session->all_userdata();
		$data['userinfo']=$info;
		//print_r($data['userinfo']);
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],8);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['title'] = 'Admin | Events';
		$data['active_tab_event'] = 'active';
		$data['user_id'] = $this->data['user_id'];
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$data['eventList'] = $this->model->get_all_order_by('*', 'tbl_event','event_id','DESC');
		
		if($data['segment'] == 'addevent') {
			if (isset($result)) {
			  	if($result[0]->permission_id == 8){
			  		if($result[0]->add_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
		
		if($this->form_validation->run('addevent') == FALSE) {
		
			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/events/event_add',$data);
			$this->load->view('administrator/include/inner_footer');
		
		} else {
		        $data['pagetitle'] = 'Add Event';
		        $eventadd['user_id'] = $data['user_id'];
			    $eventadd['event_title'] = $this->input->post('event_title');
				$eventadd['event_venue'] = $this->input->post('event_venue');
				$eventadd['venue_address'] = $this->input->post('venue_address');
				$eventadd['event_description'] = $this->input->post('event_description');
				$eventadd['event_date'] = $this->input->post('event_date');
				$eventadd['event_start_time'] = $this->input->post('event_start_time');				
				$eventadd['event_contact_person_name'] = $this->input->post('event_contact_person_name');
				$eventadd['event_contact_no'] = $this->input->post('event_contact_no');
				$eventadd['event_email_id'] = $this->input->post('event_email_id');
				$eventadd['event_wed_site'] = $this->input->post('event_wed_site');
				//$eventadd['event_type'] = $this->input->post('event_type');
				$all_day_event = $this->input->post('all_day_event');
				if($all_day_event !='' || $all_day_event !=0){
					$eventadd['all_day_event'] = $this->input->post('all_day_event');
				}else{
					$eventadd['all_day_event'] = 0;
				}
				//$all_day_event = $this->input->post('all_day_event')
				if($all_day_event == 1){
					$eventadd['event_end_time'] = '';
				}else{
					$eventadd['event_end_time'] = $this->input->post('event_end_time');
				}
				$event_type = $this->input->post('event_type');
				if($event_type != 1 && $event_type == ''){
					$eventadd['event_type'] = 0;
				}else{
					$eventadd['event_type'] = $this->input->post('event_type');
				}
				if($data['role'] == 3){
				    $eventadd['user_id'] = $data['u_id'];
				$eventadd['event_created_by'] = 'sub admin';
				}else{
				    $eventadd['event_created_by'] = 'admin';
				}
				//$eventadd['event_created_by'] = 'admin';
				/***********GET LAT LONG************/

				$latlong = $this->get_lat_long($eventadd['venue_address']);
				$eventadd['event_lat'] = $latlong['lat'];
				$eventadd['event_lang'] = $latlong['lng'];


				//Insert into tbl_business_master table
				$inserted = $this->model->insert_data('tbl_event',$eventadd);
				$eventID = $this->db->insert_id();
				
				if(isset($_FILES)){
					 $eventImage = $this->insertMultipleImage('event_image', 'upload/event_images/');
							
					if(isset($eventImage) && !empty($eventImage))
					 {   
					   foreach($eventImage as $imagesG)
						{
							$vacbusadd['event_id'] = $eventID;
							$vacbusadd['event_image_path']= $imagesG;
							$this->model->insert_data('tbl_event_image',$vacbusadd);
						}
					 }

					}
				if($inserted){
					$this->session->set_flashdata('success', 'The Event is Successfully Added');
					 redirect(base_url().'administrator/eventslist');
				}
		
		
		} 
	 } 
	 else if($data['segment'] == 'editevent') {
	 	if (isset($result)) {
			  	if($result[0]->permission_id == 8){
			  		if($result[0]->edit_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
		   
		$data['eventId']= $this->uri->segment(4);
	    $data['eventDetail'] = $this->model->get_data('*', 'tbl_event', array('event_id'=>$data['eventId']));
	    $data['eventPhotos'] = $this->model->get_data('*','tbl_event_image', array('event_id'=>$data['eventId']));
	
	   // print_r($data['eventDetail']);

	   if($this->form_validation->run('editevent') == FALSE) {
		    
		    $this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/events/event_add',$data);
			$this->load->view('administrator/include/inner_footer');
	
		} else {
			
			$data['pagetitle'] = 'Edit Event';
			$eventadd['user_id'] = $data['user_id'];
			$eventadd['event_title'] = $this->input->post('event_title');
			$eventadd['event_venue'] = $this->input->post('event_venue');
			$eventadd['venue_address'] = $this->input->post('venue_address');
			$eventadd['event_description'] = $this->input->post('event_description');
			$eventadd['event_date'] = $this->input->post('event_date');
			$eventadd['event_start_time'] = $this->input->post('event_start_time');
			$eventadd['event_contact_person_name'] = $this->input->post('event_contact_person_name');
			$eventadd['event_contact_no'] = $this->input->post('event_contact_no');
			$eventadd['event_email_id'] = $this->input->post('event_email_id');
			$eventadd['event_wed_site'] = $this->input->post('event_wed_site');
			//$eventadd['event_type'] = $this->input->post('event_type');
			$all_day_event = $this->input->post('all_day_event');
			if($all_day_event !='' || $all_day_event !=0){
					$eventadd['all_day_event'] = $this->input->post('all_day_event');
				}else{
					$eventadd['all_day_event'] = 0;
				}
			//$eventadd['event_created_by'] = 'admin';
			if($all_day_event == 1){
				$eventadd['event_end_time'] = '';
			}else{
				$eventadd['event_end_time'] = $this->input->post('event_end_time');
		    }
		    $event_type = $this->input->post('event_type');
			if($event_type != 1 && $event_type == ''){
				$eventadd['event_type'] = 0;
			}else{
				$eventadd['event_type'] = $this->input->post('event_type');
			}
			$eventadd['last_modify_user_id'] = $data['u_id'];
            $eventadd['last_modify_date'] = date("Y-m-d");


			/***********GET LAT LONG************/

			$latlong = $this->get_lat_long($eventadd['venue_address']);
			$eventadd['event_lat'] = $latlong['lat'];
			$eventadd['event_lang'] = $latlong['lng'];


			/***********GET LAT LONG************/


			if(isset($_FILES) && !empty($_FILES)){

				$eventImage = $this->insertMultipleImage('event_image', 'upload/event_images/');

				if(isset($eventImage) && !empty($eventImage))
				{   
					foreach($eventImage as $imagesG)
					{
						$vacbusadd['event_id'] =  $data['eventId'];
						$vacbusadd['event_image_path']= $imagesG;
						$this->model->insert_data('tbl_event_image',$vacbusadd);
					}
				}
			}

			   //update into tbl_business_master table
			$where = array('event_id' => $data['eventId']);
			$update = $this->model->update('tbl_event', $eventadd, $where);
			if($update){
				$eventnot['notificate_type'] = 'event';
                $eventnot['notificate_type_id'] = $data['eventId'];
                $eventnot['notification_status'] = 1;
                $eventnot['notification_update_date'] = date("Y-m-d H:i:s");
                $inserted = $this->model->insert_data('notification',$eventnot);
				$this->session->set_flashdata('success', 'The Event is Successfully update');
				redirect(base_url().'administrator/eventslist');
			}

		
		}
		
		
	   }
	   else if(($data['segment'] == 'view')){
	   	if (isset($result)) {
			  	if($result[0]->permission_id == 8){
			  		if($result[0]->view_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
                 $data['pagetitle'] = 'View Event';
	             $data['eventID'] = $this->uri->segment(4);
	             $data['eventDetail'] = $this->model->get_row('tbl_event', array('event_id'=>$data['eventID']));
	             $data['eventImage'] = $this->model->get_data('*','tbl_event_image', array('event_id'=>$data['eventID']));

				 
				$this->load->view('administrator/include/inner_header',$data);
				$this->load->view('administrator/events/view_event',$data);
				$this->load->view('administrator/include/inner_footer');

			}
	 else { 
			$this->load->view('administrator/include/inner_header',$data);
	        $this->load->view('administrator/events/events',$data);
	        $this->load->view('administrator/include/inner_footer');

		
		}
	}

	/**
	 * FAQ for this controller.
	 */
function faq(){
		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],31);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		 
		$data['title']= "Admin | FAQ Managment";
		$data['active_cms_page'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment']= $this->uri->segment(3);
		$data['faqList'] = $this->model->get_all_order_by('*', 'tbl_faq','faq_id','DESC');
		if($data['segment'] == 'add') {
			if (isset($result)) {
			  	if($result[0]->permission_id == 31){
			  		if($result[0]->add_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
			if($this->form_validation->run('faqadd') == FALSE) {
				$this->load->view('administrator/include/inner_header',$data);
				$this->load->view('administrator/cms/add_faq_page',$data);
				$this->load->view('administrator/include/inner_footer');	
            } else {
			 	$faq['faq_que'] = $this->input->post('faq_que');
			 	$faq['faq_ans'] = $this->input->post('faq_ans');
			 	//Insert into tbl_faq table
				$inserted = $this->model->insert_data('tbl_faq',$faq);
				if($inserted){
					$this->session->set_flashdata('success', 'The FAQ is Successfully inserted');
					redirect(base_url().'administrator/faq');
				}
			 	
			 }

		}else if($data['segment'] == 'edit') {
           if (isset($result)) {
			  	if($result[0]->permission_id == 31){
			  		if($result[0]->edit_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
		   $data['pageID']= $this->uri->segment(4);
		   $data['faqlist'] = $this->model->get_row('tbl_faq',array('faq_id' => $data['pageID']));	
		 if($this->form_validation->run('editfaq') == FALSE) {
			    $this->load->view('administrator/include/inner_header',$data);
				$this->load->view('administrator/cms/add_faq_page',$data);;
				$this->load->view('administrator/include/inner_footer');	
		 } else {
				$faq['faq_que'] = $this->input->post('faq_que');
				$faq['faq_ans'] = $this->input->post('faq_ans');
				$where = array('faq_id' => $data['pageID']);
				$inserted = $this->model->update('tbl_faq', $faq, $where);
		 	if($inserted){
				$this->session->set_flashdata('success', 'The FAQ is Successfully update');
				redirect('administrator/faq');
			}
		 }
		}
		else{
			    $this->load->view('administrator/include/inner_header',$data);
				$this->load->view('administrator/cms/faq_list',$data);;
				$this->load->view('administrator/include/inner_footer');	
		}

}





	/**
	 * Change Password for this controller.
	 */
   function changepassword(){

   		$info=$this->session->all_userdata();
		$data['userinfo']=$info;
		//print_r($data['userinfo']);
		$data['role'] = $this->data['siterole_id'];
		$data['u_id'] = $this->data['user_id'];
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	
		$data['title']= "Admin | Change Password";
		$data['active_tab_password'] = 'active';
		$data['ID'] = $this->data['user_id'];
		$data['basesegment']= $this->uri->segment(2);
		
	if($this->form_validation->run('changepassword') == FALSE) {
		
			$this->load->view('administrator/include/inner_header',$data);
	        $this->load->view('administrator/admin_setting/changepassword',$data);
	        $this->load->view('administrator/include/inner_footer');
		
		} else {
			
		    $accountsetting['password'] = base64_encode($this->input->post('first_password'));
			$where=array('user_id'=>$data['ID']);
			$inserted = $this->model->update('tbl_user_master', $accountsetting,$where);
			$this->session->set_flashdata('success', 'Password changed successfully!');
			 redirect(base_url().'administrator/changepassword');
			//redirect(base_url().'admin/changepassword');
		
		}		
		
	}
	public function oldpassword_check(){

		$old_password = base64_encode($this->input->post('current_password'));
		$admin_id = $this->input->post('admin_id');

		$old_password_db_hash =$this->model->get_data('*','tbl_user_master',array('password'=>$old_password, 'user_id'=>$admin_id));
		//echo $this->db->last_query();
		if($old_password_db_hash)
		{
			echo 1;
		}else{
			echo 0;   
		} 
		die;

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
	 * Change Table Status for this controller.
	 */
	function changeMemberShipStatus(){

		$id = $this->input->post('id');
		$status = $this->input->post('status');	
		$tablename = $this->input->post('tablename');
	    $tabCount = count($this->model->get_data('*','plan_master', array('pl_status'=>1)));
	    if($tabCount)
	    {	
			$data=array('pl_status'=>$status);
			$where=array('pl_id'=> $id);
	       	$this->model->update($tablename, $data,$where); 
			$i = $this->db->affected_rows();
			echo 'TRUE';

	    }elseif($status==0)
	    {
			$data=array('pl_status'=>$status);
			$where=array('pl_id'=> $id);
	       	$this->model->update($tablename, $data,$where); 
			$i = $this->db->affected_rows();
			echo 'TRUE';
	    }
	    else{
           	echo 'FALSE';
	    }
    }
    function sort_order(){
    	$id = $this->input->post('id');
		$value = $this->input->post('value');	
		$tablename = $this->input->post('tablename');
		/****************** Classified********************/

		if($tablename == 'tbl_classified_list'){
			$data=array('classified_sort_order'=>$value);
			$where=array('classified_id'=> $id);
		}
		/****************** Classified********************/

		if($tablename == 'tbl_classified_cat_master'){
			$data=array('classified_sort_order'=>$value);
			$where=array('classified_cat_id'=> $id);
		}
		/****************** Classified********************/

		if($tablename == 'forum_category'){
			$data=array('forum_sort_order'=>$value);
			$where=array('forum_cat_id'=> $id);
		}

	    $this->model->update($tablename, $data,$where); 
       	//echo $this->db->last_query();
		echo $i = $this->db->affected_rows();
    }
    function rentalExpired(){
		//print_r($_POST);die;
	  
	    $id = $this->input->post('id');
		$vac_message = $this->input->post('vac_message');	
		$tablename = $this->input->post('tablename');
		/****************** trail********************/

		if($tablename == 'tbl_vacation_list'){

			$vacDetails = $this->model->join_where("*", 'tbl_vacation_list','tbl_user_master','user_id','user_id',array('vac_id'=>$id),'vac_id','desc');
            
            $msg = $vacDetails[0]->fname.'<br/>'.$vacDetails[0]->email.'<br/>'.$vacDetails[0]->vac_name.'<br/>'.$vac_message;

			$row1 =  $this->model->get_row('email_templates',array('title'=>'AdminSendEmailRentalExpired'));
			$message = $row1->content;
			$message12 = $vac_message;
			$subject = $row1->subject;
			 $pageLike = base_url().'lodging/'.$vacDetails[0]->vac_slag;
			$message = str_replace("{username}",ucfirst($vacDetails[0]->fname),$message);
			$message = str_replace("{rental_property_name}",ucfirst($vacDetails[0]->vac_name),$message);
			$message = str_replace("{page_link}",$pageLike,$message);
			$message = str_replace("{message}",$vac_message,$message);
			$message = str_replace("{user_email_address}",$vacDetails[0]->email,$message);
			$this->sendingMail($vacDetails[0]->email ,$subject, $message);
		}



	}
	function changeStatus(){
		//print_r($_POST);die;
	  
	    $id = $this->input->post('id');
		$status = $this->input->post('status');	
		$tablename = $this->input->post('tablename');
		

       /****************** seo_setting********************/

		if($tablename == 'seo_setting'){
			$data=array('meta_status'=>$status);
			$where=array('meta_id'=> $id);
		}

		/****************** trail********************/

		if($tablename == 'tbl_trail_cat_master'){
			$data=array('trail_status'=>$status);
			$where=array('trail_id'=> $id);
		}
		/****************** State********************/

		if($tablename == 'tbl_state'){
			$data=array('state_status'=>$status);
			$where=array('state_id'=> $id);
		}
		/****************** USER********************/

		if($tablename == 'tbl_user_master'){
			$getUserEmail = $this->model->get_row('tbl_user_master',  array('user_id' => $id));
			$username = '';
			if(isset($getUserEmail->fname) && !empty($getUserEmail->fname)){
              $username = $getUserEmail->fname;
			}else{
			  $username = $getUserEmail->username;
			}
           if($status == 1){

                  $row1 =  $this->model->get_row('email_templates',array('title'=>'UserActivatedAccount'));
					$message = $row1->content;
					$subject = $row1->subject;
					$message = str_replace("{username}",ucfirst($username),$message);
					$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);
                  
           }else{
           	       $row1 =  $this->model->get_row('email_templates',array('title'=>'userAccountDeactivated'));
					$message = $row1->content;
					$subject = $row1->subject;
					$message = str_replace("{username}",ucfirst($username),$message);
					$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);
           }
			$data=array('status'=>$status);
			$where=array('user_id'=> $id);
		}
		/****************** NEWS********************/

		if($tablename == 'tbl_news'){
			$data=array('news_status'=>$status);
			$where=array('news_id'=> $id);
		}
		/****************** Business********************/

		if($tablename == 'tbl_business_list'){
			$data=array('business_status'=>$status);
			$where=array('business_id'=> $id);
		}
		/****************** tbl_cms_pages********************/

		if($tablename == 'tbl_cms_pages'){
			$data=array('status'=>$status);
			$where=array('id'=> $id);
		}
		/****************** tbl_faq********************/

		if($tablename == 'tbl_faq'){
			$data=array('faq_status'=>$status);
			$where=array('faq_id'=> $id);
		}

		/****************** tbl_trail_master********************/

		if($tablename == 'tbl_trail_master'){
			$data=array('trail_type_status'=>$status);
			$where=array('trail_type_id'=> $id);
			$query=$this->db->query("select * from tbl_trail_master where trail_type_id= ".$id."");
			$result=$query->result();
			//echo $result[0]->trail_type_name;
			if($result[0]->trail_type_name == 'Trail'){
               $result[0]->region_name;
               $tablename1 = 'tbl_kml_data_trail';
               $data1=array('status'=>$status);
			   $where1=array('trail_id'=> $result[0]->trail_type_id); 
			   $this->model->update($tablename1, $data1,$where1); 
        
			}
			if($result[0]->trail_type_name == 'Trail Report'){
               $result[0]->region_name;
               $tablename1 = 'county_trail_report';
               $data1=array('status'=>$status);
			   $where1=array('trail_report_id'=> $result[0]->trail_type_id); 
			   $this->model->update($tablename1, $data1,$where1); 
        
			}
			if(($result[0]->trail_type_name == 'Parking') || ($result[0]->trail_type_name == 'Fuel') || ($result[0]->trail_type_name == 'Lodging') || ($result[0]->trail_type_name == 'Snowmobile Clubs') || ($result[0]->trail_type_name == 'Restaurants')){
               $result[0]->region_name;
               $tablename1 = 'tbl_kml_data';
               $data1=array('status'=>$status);
			   $where1=array('trail_fk_id'=> $result[0]->trail_type_id); 
			   $this->model->update($tablename1, $data1,$where1); 
        
			}
		}
      /****************** forum_category********************/

		if($tablename == 'forum_category'){
			$data=array('forum_cat_status'=>$status);
			$where=array('forum_cat_id'=> $id);
		}
		
		/****************** tbl_classified_cat_master********************/

		if($tablename == 'tbl_classified_cat_master'){
			$data=array('classified_cat_status'=>$status);
			$where=array('classified_cat_id'=> $id);
		}

		/****************** Classified********************/

		if($tablename == 'tbl_classified_list'){
            $statusChange = $this->input->post('statusChange');
            $vac_message = $this->input->post('vac_message');
			if($statusChange == 'Approved'){
					$data['classifiedDuration'] = $this->model->get_data('*', 'tbl_classified_ex_duration', array('cl_ex_id'=>1));
				    $cl_ex = $data['classifiedDuration'][0]->cl_ex_time;
				   
					$date1 = date('Y-m-d', strtotime("+".$cl_ex." days"));	
					$date2 = date('Y-m-d');					
					$data=array('classified_status'=>1, 'classified_expired'=>$date1, 'classified_approve'=>$date2);
					$where=array('classified_id'=> $id);
					$getUserId = $this->model->get_row('tbl_classified_list', array('classified_id' => $id));
					$userID = $getUserId->user_ID;
					$anotify['n_type_id'] = $id;
					$anotify['user_id'] = $userID;
					$anotify['n_type'] = 'classified_approved';
					$anotify['n_date'] = date('Y-m-d h:i:s');
					$this->model->insert_data('tbl_notification',$anotify);
					$classified_approve = $getUserId->classified_approve;
					//$classified_expired = $getUserId->classified_expired;
					$classified_expired = date('d M Y',strtotime($date1));
					$getUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $userID));
					$status= 1;
					$userName = '';
					if(isset($getUserEmail->fname)){
						$userName = $getUserEmail->fname;
					}else{
						$userName = $getUserEmail->username;
					}
					$row1 =  $this->model->get_row('email_templates',array('title'=>'classifiedApproved'));
					//$subject = $row1->subject;
					$message = $row1->content;
					$message12 = $vac_message;
					$subject = $row1->subject;
					$description = $classified_expired;
					$message = str_replace("{username}",ucfirst($userName),$message);
					$message = str_replace("{days_expire}",$description,$message);
					$message = str_replace("{approval_classified_message}",$message12,$message);
					$message = str_replace("{emailId}",$getUserEmail->email,$message);
					//$this->sendingMail('votive.reena@gmail.com' ,$subject, $message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);
			}
			if($statusChange == 'Rejected'){
					$data=array('classified_status'=>2);
					$where=array('classified_id'=> $id);
					$getUserId = $this->model->get_row('tbl_classified_list', array('classified_id' => $id));
					$userID = $getUserId->user_ID;
					$anotify['n_type_id'] = $id;
					$anotify['user_id'] = $userID;
					$anotify['n_type'] = 'classified_rejected';
					$anotify['n_date'] = date('Y-m-d h:i:s');
					$this->model->insert_data('tbl_notification',$anotify);
					$getUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $userID));
					$status= 1;
					$userName = '';
					if(isset($getUserEmail->fname)){
						$userName = $getUserEmail->fname;
					}else{
						$userName = $getUserEmail->username;
					}
					$row1 =  $this->model->get_row('email_templates',array('title'=>'classifiedRejected'));
					//$subject = $row1->subject;
					$message = $row1->content;
					$message12 = $vac_message;
					$subject = $row1->subject;
				    //$description = '<strong> Sorry! </strong>Your classified ad has been rejected';
				 	$message = str_replace("{username}",ucfirst($userName),$message);
					//$message = str_replace("{description}",$description,$message);
					$message = str_replace("{rejection_classified_message}",$vac_message,$message);
					$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
					//$this->sendingMail('votive.reena@gmail.com' ,$subject, $message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);
			}
		}

		/****************** Vacationlist ********************/

		if($tablename == 'tbl_vacation_list'){
			 $vac_subject = $this->input->post('vac_subject');	
		     $vac_message = $this->input->post('vac_message');
		     $needcorrection = $this->input->post('needcorrection');
			
			if($status == 1){
				    $getUserId = $this->model->get_row('tbl_vacation_list', array('vac_id' => $id));
					$userID = $getUserId->user_id;
					$anotify['n_type_id'] = $id;
					$anotify['user_id'] = $userID;
					$anotify['n_type'] = 'rental_rejected';
					$anotify['n_date'] = date('Y-m-d h:i:s');
					$this->model->insert_data('tbl_notification',$anotify);
					$pl_id = $getUserId->pl_id;
					$plan_price = $this->model->get_row('plan_master', array('pl_id' => $pl_id));
					
					//if($plan_price->pl_price == 0){
                       if(isset($plan_price->pl_days) && !empty($plan_price->pl_days)){
                       	$pl_days = $plan_price->pl_days;
                       }else{
                       	$pl_days = 0;
                       }

                       if(isset($plan_price->pl_months) && !empty($plan_price->pl_months)){
                       	$pl_months = $plan_price->pl_months * 30;
                       }else{
                       	$pl_months = 0;
                       }

                       if(isset($plan_price->pl_year) && !empty($plan_price->pl_year)){
                       	$pl_year = $plan_price->pl_year * 365;
                       }else{
                       	$pl_year = 0;
                       }
                   // }
                    $ppdays = $pl_days + $pl_months + $pl_year;
                    $vac_expiry_date = date('Y-m-d', strtotime("+".$ppdays ."days"));
                  
                    $this->model->update('tbl_vacation_list', array('vac_expiry_date' =>  $vac_expiry_date),array('vac_id' =>$id ));
					$getUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $userID));
					$status= 0;
					$userName = $getUserEmail->fname;
					$row1 =  $this->model->get_row('email_templates',array('title'=>'rentalRejected'));
					$subject = $row1->subject;
					$message = $row1->content;
					$vac_message = $this->input->post('vac_message');
					$description = $vac_message;
					$pageLike = base_url().'lodging/'.$getUserId->vac_slag;
					$message = str_replace("{username}",ucfirst($userName),$message);
					$message = str_replace("{rental_name}",ucfirst($getUserId->vac_name),$message);
					$message = str_replace("{page_link}",$pageLike,$message);
					$message = str_replace("{description}",$description,$message);
					$message = str_replace("{days_expire}",date_format(date_create($vac_expiry_date ), 'd M Y'),$message);
					$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);
			}
			else if($needcorrection == 'needcorrection'){

				$statusChange = $this->input->post('statusChange');
				if($statusChange == 'Approved'){
					$getUserId = $this->model->get_row('tbl_vacation_list', array('vac_id' => $id));
					$userID = $getUserId->user_id;
					$pl_id = $getUserId->pl_id;
					$plan_price = $this->model->get_row('plan_master', array('pl_id' => $pl_id));
					
					//if($plan_price->pl_price == 0){
                       if(isset($plan_price->pl_days) && !empty($plan_price->pl_days)){
                       	$pl_days = $plan_price->pl_days;
                       }else{
                       	$pl_days = 0;
                       }

                       if(isset($plan_price->pl_months) && !empty($plan_price->pl_months)){
                       	$pl_months = $plan_price->pl_months * 30;
                       }else{
                       	$pl_months = 0;
                       }

                       if(isset($plan_price->pl_year) && !empty($plan_price->pl_year)){
                       	$pl_year = $plan_price->pl_year * 365;
                       }else{
                       	$pl_year = 0;
                       }
                        $ppdays = $pl_days + $pl_months + $pl_year;
                        $vac_expiry_date = date('Y-m-d', strtotime("+".$ppdays ."days"));

                        $this->model->update('tbl_vacation_list', array('vac_expiry_date' =>  $vac_expiry_date),array('vac_id' =>$id )); 

					//}
					$getUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $userID));
					$status= 1;

					$userName = $getUserEmail->fname;
					$anotify['n_type_id'] = $id;
					$anotify['user_id'] = $userID;
					$anotify['n_type'] = 'rental_approved';
					$anotify['n_date'] = date('Y-m-d h:i:s');
					$this->model->insert_data('tbl_notification',$anotify);
					$row1 =  $this->model->get_row('email_templates',array('title'=>'RentalApproved'));
					$subject = $row1->subject;
					$message = $row1->content;
					$description = $vac_message;
					$pageLike = base_url().'lodging/'.$getUserId->vac_slag;
					$message = str_replace("{username}",ucfirst($userName),$message);
					$message = str_replace("{description}",$description,$message);
					$message = str_replace("{rental_name}",ucfirst($getUserId->vac_name),$message);
					$message = str_replace("{page_link}",$pageLike,$message);
					$message = str_replace("{days_expire}",date_format(date_create($vac_expiry_date ), 'd M Y'),$message);
					$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);

				}if($statusChange == 'Rejected'){
					$getUserId = $this->model->get_row('tbl_vacation_list', array('vac_id' => $id));
					$userID = $getUserId->user_id;
					$anotify['n_type_id'] = $id;
					$anotify['user_id'] = $userID;
					$anotify['n_type'] = 'rental_rejected';
					$anotify['n_date'] = date('Y-m-d h:i:s');
					$this->model->insert_data('tbl_notification',$anotify);
					$getUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $userID));
					$status= 0;
					$userName = $getUserEmail->fname;
					$row1 =  $this->model->get_row('email_templates',array('title'=>'rentalRejected'));
					$subject = $row1->subject;
					$message = $row1->content;
					$description = $vac_message;
					$pageLike = base_url().'lodging/'.$getUserId->vac_slag;
					$pageLike = base_url().'lodging/'.$getUserId->vac_slag;
					$message = str_replace("{username}",ucfirst($userName),$message);
					$message = str_replace("{rental_name}",ucfirst($getUserId->vac_name),$message);
					$message = str_replace("{page_link}",$pageLike,$message);
					$message = str_replace("{description}",$description,$message);
					$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);

				}if($statusChange == 'Correction'){
					$getUserId = $this->model->get_row('tbl_vacation_list', array('vac_id' => $id));
					$userID = $getUserId->user_id;
					$anotify['n_type_id'] = $id;
					$anotify['user_id'] = $userID;
					$anotify['n_type'] = 'rental_rejected';
					$anotify['n_date'] = date('Y-m-d h:i:s');
					$this->model->insert_data('tbl_notification',$anotify);
	                $getUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $userID));
	                $status= 0;
	                $userName = $getUserEmail->fname;
					$row1 =  $this->model->get_row('email_templates',array('title'=>'RentalCoreectionNeed'));
					$subject = $row1->subject;
					$message = $row1->content;
					$description = $vac_message;
					$pageLike = base_url().'lodging/'.$getUserId->vac_slag;
					$message = str_replace("{username}",ucfirst($userName),$message);
					$message = str_replace("{description}",$description,$message);
					$message = str_replace("{rental_name}",ucfirst($getUserId->vac_name),$message);
					$message = str_replace("{page_link}",$pageLike,$message);
					$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);

				}
			}
			else{
				    $getUserId = $this->model->get_row('tbl_vacation_list', array('vac_id' => $id));
					$userID = $getUserId->user_id;					
					$anotify['n_type_id'] = $id;
					$anotify['user_id'] = $userID;
					$anotify['n_type'] = 'rental_approved';
					$anotify['n_date'] = date('Y-m-d h:i:s');
					$this->model->insert_data('tbl_notification',$anotify);
					$pl_id = $getUserId->pl_id;
					$plan_price = $this->model->get_row('plan_master', array('pl_id' => $pl_id));
					
					//if($plan_price->pl_price == 0){
                       if(isset($plan_price->pl_days) && !empty($plan_price->pl_days)){
                       	$pl_days = $plan_price->pl_days;
                       }else{
                       	$pl_days = 0;
                       }

                       if(isset($plan_price->pl_months) && !empty($plan_price->pl_months)){
                       	$pl_months = $plan_price->pl_months * 30;
                       }else{
                       	$pl_months = 0;
                       }

                       if(isset($plan_price->pl_year) && !empty($plan_price->pl_year)){
                       	$pl_year = $plan_price->pl_year * 365;
                       }else{
                       	$pl_year = 0;
                       }
                   // }
                    $ppdays = $pl_days + $pl_months + $pl_year;
                    $vac_expiry_date = date('Y-m-d', strtotime("+".$ppdays ."days"));
                  
                    $this->model->update('tbl_vacation_list', array('vac_expiry_date' =>  $vac_expiry_date),array('vac_id' =>$id ));
					$getUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $userID));
					$status= 1;

					$userName = $getUserEmail->fname;
					$row1 =  $this->model->get_row('email_templates',array('title'=>'RentalApproved'));
					$subject = $row1->subject;
					$message = $row1->content;
					$vac_message = $this->input->post('vac_message');
					$description = $vac_message;
					$pageLike = base_url().'lodging/'.$getUserId->vac_slag;
					$message = str_replace("{username}",ucfirst($userName),$message);
					$message = str_replace("{rental_name}",ucfirst($getUserId->vac_name),$message);
					$message = str_replace("{page_link}",$pageLike,$message);
					$message = str_replace("{description}",$description,$message);
					$message = str_replace("{days_expire}",date_format(date_create($vac_expiry_date ), 'd M Y'),$message);
					$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);
					/*$row1 =  $this->model->get_row('email_templates',array('title'=>'RentalApproved'));
					$subject = $row1->subject;
					$message = $row1->content;
					$vac_message = $this->input->post('vac_message');
					$description = $vac_message;
					$pageLike = base_url().'lodging/'.str_replace(' ', '-', $getUserId->vac_name);
					$message = str_replace("{rental_name}",ucfirst($getUserId->vac_name),$message);
					$message = str_replace("{page_link}",$pageLike,$message);
					$message = str_replace("{username}",ucfirst($userName),$message);
					$message = str_replace("{description}",$description,$message);
					$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);*/
			}
			

			$data=array('vac_status'=>$status);
			$where=array('vac_id'=> $id);
		}

		/****************** Eventlist ********************/

		if($tablename == 'tbl_event'){
			$data=array('event_status'=>$status);
			$where=array('event_id'=> $id);
		}	
		/****************** plan_master********************/


		if($tablename == 'plan_master'){
			$order = $this->input->post('order_id');
			$data=array('order'=>$order);
			$where=array('pl_id'=> $id);
		}	

		/******************Delete message********************/

 		if($tablename == 'tbl_enquiry'){
 		    $data=array('delete_enquiry'=>1);
			$where=array('id'=> $id);
		}

		/****************** plan_master********************/


		if($tablename == 'tbl_user_role'){
			$data=array('role_status'=>$status);
			$where=array('role_id'=> $id);
		}	


		/****************** tbl_review********************/

		if($tablename == 'tbl_review'){
			
			$r_status = $this->input->post('r_status');
			$r_msg = $this->input->post('r_msg');
			if($r_status == 'Approved'){
            $status= 1;
            $data=array('status'=>$status);
			$where=array('review_ID'=> $id);

			$query = $this->db->query("SELECT tbl_review.*, tbl_vacation_list.vac_id,tbl_vacation_list.vac_name, tbl_user_master.user_id,tbl_user_master.fname as b_user_name, tbl_user_master.email as b_user_email, user_review.fname as r_user_name, user_review.email as r_user_email FROM tbl_review LEFT JOIN tbl_vacation_list ON tbl_review.bus_ID=tbl_vacation_list.vac_id LEFT JOIN tbl_user_master ON tbl_user_master.user_id=tbl_vacation_list.user_id LEFT JOIN tbl_user_master as user_review ON user_review.user_id=tbl_review.user_ID where tbl_review.review_ID =".$id."");
			$getDetails = $query->result();

			$r_notifydata['notificate_type']= 'review';
            $r_notifydata['notificate_type_id']= $id;
            $r_notifydata['user_id']= $getDetails[0]->user_ID;
            $r_notifydata['notification_update_date'] = date('Y-m-d h:i:s');
			$this->db->insert('notification', $r_notifydata); 

			$b_notifydata['notificate_type']= 'review';
            $b_notifydata['notificate_type_id']= $id;
            $b_notifydata['user_id']= $getDetails[0]->user_id;
            $b_notifydata['notification_update_date'] = date('Y-m-d h:i:s');
			$this->db->insert('notification', $b_notifydata); 

			$row1 =  $this->model->get_row('email_templates',array('title'=>'ReviewApproved'));
			$r_subject = $row1->subject;
			$r_message = $row1->content;
			$description = $r_msg;
			$r_message = str_replace("{username}",ucfirst($getDetails[0]->r_user_name),$r_message);
			$r_message = str_replace("{description}",$description,$r_message);
			$r_message = str_replace("{user_email_address}",$getDetails[0]->r_user_email,$r_message);
			$r_message = str_replace("{review_title}",$getDetails[0]->review_title,$r_message);
			$r_message = str_replace("{review_rating}",$getDetails[0]->rating,$r_message);
			$r_message = str_replace("{review_body}",$getDetails[0]->comment,$r_message);
            $this->sendingMail($getDetails[0]->r_user_email,$r_subject, $r_message);

            $row1 =  $this->model->get_row('email_templates',array('title'=>'ReviewReceived'));
			$b_subject = $row1->subject;
			$b_message = $row1->content;
			$description = $r_msg;
			$pageLike = base_url().'lodging/'.$getDetails[0]->vac_slag;
			$b_message = str_replace("{username}",ucfirst($getDetails[0]->b_user_name),$b_message);
			$b_message = str_replace("{description}",$description,$b_message);
			$b_message = str_replace("{user_email_address}",$getDetails[0]->b_user_email,$b_message);
			$b_message = str_replace("{review_title}",$getDetails[0]->review_title,$b_message);
			$b_message = str_replace("{review_body}",$getDetails[0]->comment,$b_message);
			$b_message = str_replace("{property_page_link}",$pageLike,$b_message);
			$b_message = str_replace("{property_name}",$getDetails[0]->vac_name,$b_message);
			$b_message = str_replace("{review_rating}",$getDetails[0]->rating,$b_message);
            $this->sendingMail($getDetails[0]->b_user_email,$b_subject, $b_message);

			}
			if($r_status == 'Rejected'){
            $status= 2;
            $data=array('status'=>$status);
			$where=array('review_ID'=> $id);

			$query = $this->db->query("SELECT tbl_review.*, tbl_vacation_list.vac_id,tbl_vacation_list.vac_name, tbl_user_master.user_id,tbl_user_master.fname as b_user_name, tbl_user_master.email as b_user_email, user_review.fname as r_user_name, user_review.email as r_user_email FROM tbl_review LEFT JOIN tbl_vacation_list ON tbl_review.bus_ID=tbl_vacation_list.vac_id LEFT JOIN tbl_user_master ON tbl_user_master.user_id=tbl_vacation_list.user_id LEFT JOIN tbl_user_master as user_review ON user_review.user_id=tbl_review.user_ID where tbl_review.review_ID =".$id."");
			$getDetails = $query->result();

			//$r_message="Review Approved";
			//$r_message="<p> Your review has been rejected</p>";

            $row1 =  $this->model->get_row('email_templates',array('title'=>'ReviewRejected'));
			$r_subject = $row1->subject;
			$r_message = $row1->content;
			$description = $r_msg;
			$r_message = str_replace("{username}",ucfirst($getDetails[0]->r_user_name),$r_message);
			$r_message = str_replace("{description}",$description,$r_message);
			$r_message = str_replace("{user_email_address}",$getDetails[0]->r_user_email,$r_message);
            $this->sendingMail($getDetails[0]->r_user_email ,$r_subject, $r_message);

			}
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
 		$classimg = $this->input->post('classimg');
 		$tablename = $this->input->post('tablename');

 		/******************Delete trail********************/

 		if($tablename == 'tbl_user_role'){
			$where=array('role_id'=> $id);
			$condition2 = array('role_id' =>$id);
			$this->db->delete('tbl_role_permission', $condition2);
			$this->db->delete('tbl_user_assign_permission', $condition2);
		}
		/******************Delete seo_setting********************/

 		if($tablename == 'seo_setting'){
			$where=array('meta_id'=> $id);
		}
        /******************Delete trail********************/

 		if($tablename == 'tbl_trail_cat_master'){
			$where=array('trail_id'=> $id);
		}
		/******************Delete trail********************/

 		if($tablename == 'tbl_state'){
			$where=array('state_id'=> $id);
		}
		
        /******************User List********************/
		if($tablename == 'tbl_user_master'){
			$where=array('user_id'=> $id);
			$this->db->delete('tbl_user_assign_permission', $where);
		}
		/******************news List********************/
		if($tablename == 'tbl_news'){
			$where=array('news_id'=> $id);
		}
		/******************business List********************/
		if($tablename == 'tbl_business_list'){
			$where=array('business_id'=> $id);
		}
		/****************** tbl_cms_pages********************/

		if($tablename == 'tbl_cms_pages'){
			$where=array('id'=> $id);
		}
		/****************** tbl_faq********************/

		if($tablename == 'tbl_faq'){
			$where=array('faq_id'=> $id);
		}
		/****************** plan_master********************/

		if($tablename == 'plan_master'){
			$where=array('pl_id'=> $id);
		}
		/******************business List********************/
		if($tablename == 'tbl_review'){
			$where=array('review_ID'=> $id);
		}

		/****************** tbl_trail_master********************/

		if($tablename == 'tbl_trail_master'){
			$where=array('trail_type_id'=> $id);
			$condition=array('trail_fk_id'=> $id);
		    $this->db->delete('tbl_kml_data', $condition);
		    $condition1=array('trail_report_id'=> $id); 
		    $this->db->delete('county_trail_report', $condition1);


		    $query=$this->db->query("select * from tbl_trail_master where trail_type_id= ".$id."");
			$result=$query->result();
			$arr = explode("/", $result[0]->trail_kml_path);
            unlink($result[0]->trail_kml_path);
			rmdir($arr[0].'/'.$arr[1]);

			if($result[0]->trail_type_name == 'Trail'){
               $condition2=array('trail_id'=>$result[0]->trail_type_id);
               $this->db->delete('tbl_kml_data_trail', $condition2);
        
			}
			if($result[0]->trail_type_name == 'Trail Report'){
        	   $condition2=array('trail_report_id'=>$result[0]->trail_type_id);
               $this->db->delete('county_trail_report', $condition2);
        
			}
			if(($result[0]->trail_type_name == 'Parking') || ($result[0]->trail_type_name == 'Fuel') || ($result[0]->trail_type_name == 'Lodging') || ($result[0]->trail_type_name == 'Snowmobile Clubs') || ($result[0]->trail_type_name == 'Restaurants')){
                $condition2=array('trail_fk_id'=> $result[0]->trail_type_id); 
			    $this->db->delete('tbl_kml_data', $condition2);
        
			}
		}

		/****************** tbl_trail_master********************/

		if($tablename == 'tbl_classified_list'){
			//unlink($classimg);
			$where=array('classified_id'=> $id);
		}		

		/****************** tbl_classified_master********************/

		if($tablename == 'tbl_classified_cat_master'){
		$where=array('classified_cat_id'=> $id);
		$catName = $this->model->get_row('tbl_classified_cat_master', array('classified_cat_id'=>$id));
		$classified_cat_name = $catName->classified_cat_name;
		$this->db->delete('tbl_classified_list', array('classified_type'=>$classified_cat_name)); 

		}

		/****************** Vacation List ********************/

		if($tablename == 'tbl_vacation_list'){
			$where=array('vac_id'=> $id);
		}

		/****************** Eventlist ********************/

		if($tablename == 'tbl_event'){
			$where=array('event_id'=> $id);
		}					
		/****************** tbl_kml_data ********************/

		if($tablename == 'tbl_kml_data'){
			$where=array('kml_data_id'=> $id);
		}
		/****************** tbl_kml_data ********************/

		if($tablename == 'tbl_kml_data_trail'){
			$where=array('klm_trail_name'=> $id);
		}



       	$this->db->delete($tablename, $where); 
       	//echo $this->db->last_query(); 
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
function googleads(){

	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;	
	$data['title'] = 'Google Ads Credential';
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],18);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }
	$data['active_tab_google_ads'] = 'active';
	$data['basesegment']= $this->uri->segment(2);
	$data['gid']= $this->uri->segment(3);
	
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	$data['role'] = $this->data['siterole_id'];

	$data['googleads'] = $this->model->get_data('*','tbl_google_ads',array('status' => 1));
    if($data['basesegment'] == 'googleads'){

    	$data['googleads'] = $this->model->get_data('*','tbl_google_ads',array('status' => 1));
    	//print_r($data['googleads']);
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/google_ads/googleadslist',$data);
		$this->load->view('administrator/include/inner_footer');

    }else if($data['basesegment'] == 'googleads_edit'){

        $data['googleads'] = $this->model->get_row('tbl_google_ads',array('script_id' => $data['gid']));


		if($this->form_validation->run('googleads') == FALSE)
		{
			
			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/google_ads/googleads',$data);
			$this->load->view('administrator/include/inner_footer');

		} else {

			$tbl_google_ads['pagename'] = $this->input->post('pagename');
			$tbl_google_ads['google_ad_client'] = $this->input->post('client_id');
			$tbl_google_ads['script_url'] = $this->input->post('script_url');
			$tbl_google_ads['slot_id'] = $this->input->post('slot_id');
			$where = array('script_id'=>$data['gid']);

			$inserted = $this->model->update('tbl_google_ads', $tbl_google_ads,$where);
			
			if($inserted){
			  $this->session->set_flashdata('success', 'Added succussfully.');
			}	
			redirect(base_url().'administrator/googleads');	
		}

    }


}
function gmapkey(){

	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;	
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],21);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }	
	$data['active_tab_google_ads'] = 'active';
	$data['basesegment']= $this->uri->segment(2);
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	$data['role'] = $this->data['siterole_id'];
    $data['title'] = 'Google Map Key';
	$data['googlemap'] = $this->model->get_row('tbl_google_mapkey',array('map_id' => 1));
	if($this->form_validation->run('googlemapkey') == FALSE)
	{

		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/google_ads/googlemapkey',$data);
		$this->load->view('administrator/include/inner_footer');

	} else {

		$tbl_google_mapkey['google_key'] = $this->input->post('google_key');
		$where=array('map_id'=>1);
		$inserted = $this->model->update('tbl_google_mapkey', $tbl_google_mapkey,$where);

		if($inserted){

		  $this->session->set_flashdata('success', 'Updated succussfully.');
		}	
		redirect(base_url().'administrator/gmapkey');	
	}
}
function facebookcredential(){

	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;	
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],19);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }
	$data['active_tab_google_ads'] = 'active';
	$data['basesegment']= $this->uri->segment(2);
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	$data['role'] = $this->data['siterole_id'];
	$data['title'] = 'Facebook Credential';

	$data['facebook_credential'] = $this->model->get_row(' tbl_gmail_facebook_credential',array('id' => 1));
	if($this->form_validation->run('facebookcredential') == FALSE)
	{

		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/google_ads/addfacebookcredential',$data);
		$this->load->view('administrator/include/inner_footer');

	} else {

		$oauth_key['oauth_key'] = $this->input->post('facebook_oauth_key');
		$oauth_key['update_date'] = date('Y-m-d h:i:s');
		$where=array('id'=>1);
		$inserted = $this->model->update(' tbl_gmail_facebook_credential', $oauth_key,$where);

		if($inserted){

		  $this->session->set_flashdata('success', 'Updated succussfully.');
		}	
		redirect(base_url().'administrator/facebookcredential');	
	}
}

function googlecredential(){

	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;	
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],20);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }
	$data['active_tab_google_ads'] = 'active';
	$data['basesegment']= $this->uri->segment(2);
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	$data['role'] = $this->data['siterole_id'];
	$data['title'] = 'Google Credential';

	$data['googlecredential'] = $this->model->get_row(' tbl_gmail_facebook_credential',array('id' => 2));
	if($this->form_validation->run('googlecredential') == FALSE)
	{

		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/google_ads/addgmailcredential',$data);
		$this->load->view('administrator/include/inner_footer');

	} else {

		$oauth_key['oauth_key'] = $this->input->post('gm_oauth_key');
		$oauth_key['update_date'] = date('Y-m-d h:i:s');
		$where=array('id'=>2);
		$inserted = $this->model->update(' tbl_gmail_facebook_credential', $oauth_key,$where);

		if($inserted){

		  $this->session->set_flashdata('success', 'Updated succussfully.');
		}	
		redirect(base_url().'administrator/googlecredential');	
	}
}
function paymentcredential(){

	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;	
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],22);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }
	$data['paymentcredential'] = 'active';
	$data['basesegment']= $this->uri->segment(2);
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	$data['role'] = $this->data['siterole_id'];

	$data['paypal_credential'] = $this->model->get_row('paypal_credential',array('id' => 1));
	if($this->form_validation->run('paymentcredential') == FALSE)
	{

		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/google_ads/paymentcredential',$data);
		$this->load->view('administrator/include/inner_footer');

	} else {
        $paypal_email['config_type'] = $this->input->post('config_type');
		$paypal_email['paypal_email'] = $this->input->post('paypal_email');
		$where=array('id'=>1);
		$inserted = $this->model->update('paypal_credential', $paypal_email,$where);

		if($inserted){

		  $this->session->set_flashdata('success', 'Updated succussfully.');
		}	
		redirect(base_url().'administrator/paymentcredential');	
	}
}

/**
 * news Page for this controller.
 */
function emailsetting() 
	 {

	 	$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],23);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		 
		$data['title'] = 'Admin | Emails Setting';
		$data['active_tab_password'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment'] = $this->uri->segment(3);
		$data['emailList'] = $this->model->get_all_order_by('*', 'email_templates','id','DESC');
		
		 if($data['segment'] == 'edit') {
		   
		$data['Id']= $this->uri->segment(4);
	    $data['emailTemplatesDetail'] = $this->model->get_data('*', 'email_templates', array('id'=>$data['Id']));

	   if($this->form_validation->run('editEmailTemplate') == FALSE) {
		    
		    $this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/emailtemplate/templates_edit',$data);
			$this->load->view('administrator/include/inner_footer');
	
		} else {
			
			$email['title'] = $this->input->post('title');
			$email['subject'] = $this->input->post('subject');
			$email['content'] = $this->input->post('content');
		    $email['updated_date'] = date("Y-m-d,h:m:s");

			$where= array('id'=>$data['Id']);

			$update = $this->model->update('email_templates',$email,$where);
			if($update){
				$this->session->set_flashdata('success', 'The email setting update successfully');
				redirect(base_url().'administrator/emailsetting');
			}
		
		}
		
		
	   }else if($data['segment'] == 'view'){
	      	$data['Id']= $this->uri->segment(4);
	        $data['emailTemplatesDetail'] = $this->model->get_data('*', 'email_templates', array('id'=>$data['Id']));
	        $this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/emailtemplate/templates_view',$data);
			$this->load->view('administrator/include/inner_footer');
	   }
	 else { 
			$this->load->view('administrator/include/inner_header',$data);
	        $this->load->view('administrator/emailtemplate/templates',$data);
	        $this->load->view('administrator/include/inner_footer');

		
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
	if(isset($_FILES[''.$imgName.'']['name']) && !empty($_FILES[''.$imgName.'']['name'])){
	
		for($k = 0; $k < count($_FILES[''.$imgName.'']['name']); $k++)
		{
			$filename  = basename($_FILES[''.$imgName.'']['name'][$k]);
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			if($extension == 'gif' || $extension == 'jpg' || $extension == 'png' || $extension == 'jpeg' || $extension == 'BMP' || $extension == 'TIFF' || $extension == 'GIF' || $extension == 'JPG' || $extension == 'PNG' || $extension == 'JPEG' || $extension == 'bnp' || $extension == 'tiff'){

			if($_FILES[''.$imgName.'']['error'][$k] == 0)
			{
				$string = str_replace(' ', '-',$filename); // Replaces all spaces with hyphens.

				$nameFile = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
				$image_name     = time().$nameFile.'.'.$extension;
				$image_path = ''.$fld.''.$image_name;
				
				if(move_uploaded_file($_FILES[''.$imgName.'']['tmp_name'][$k] ,$image_path))
				{
				 $imgpth[] = $image_path;
				}
				
			}

		}else{
			return false;
		}
	// $inserted2 = $this->model->insert_data(''.$table.'',$profile);
	  }
	
	}
	return $imgpth;
}

public function export_users(){
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('Users List');
    $this->excel->getActiveSheet()->setCellValue('A2', 'S. No.');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Name');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Last Name');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Gender');
    $this->excel->getActiveSheet()->setCellValue('E2', 'DOB');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Contact no');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Email');
	$this->excel->getActiveSheet()->setCellValue('H2', 'Occupation');
	$this->excel->getActiveSheet()->setCellValue('I2', 'Status');
	$this->excel->getActiveSheet()->setCellValue('J2', 'User Registration Date');
    //set aligment to center for that merged cell (A1 to C1)
    $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      for($col = ord('A'); $col <= ord('C'); $col++){ //set column dimension $this->excel->getActiveSheet()->	}
    $getUsersList = $this->model->get_data('*','tbl_user_master', array('siterole_id' =>2));
	$userList = "";
	if($getUsersList){
		$i= 1;
		foreach($getUsersList as $user)
	    {
		  
		    $userList[] = array($i, $user->fname,$user->lname,$user->gender,$user->dob,$user->contact_no,$user->email,$user->occupation,$user->status,$user->created_date);
	        $i++;
	   }
	}
    $this->excel->getActiveSheet()->fromArray($userList, null, 'A3');
     
    $filename='usersList.xls'; 
    header('Content-type: application/ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0'); 
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
    $objWriter->save('php://output');
 }
}

public function export_subadmin(){
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('Sub Admin List');
    $this->excel->getActiveSheet()->setCellValue('A2', 'S. No.');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Name');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Last Name');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Gender');
    $this->excel->getActiveSheet()->setCellValue('E2', 'DOB');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Contact no');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Email');
	$this->excel->getActiveSheet()->setCellValue('H2', 'Occupation');
	$this->excel->getActiveSheet()->setCellValue('I2', 'Status');
	$this->excel->getActiveSheet()->setCellValue('J2', 'User Registration Date');
    //set aligment to center for that merged cell (A1 to C1)
    $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      for($col = ord('A'); $col <= ord('C'); $col++){ //set column dimension $this->excel->getActiveSheet()->	}
    $getUsersList = $this->model->get_data('*','tbl_user_master', array('siterole_id' =>3));
	$userList = "";
	if($getUsersList){
		foreach($getUsersList as $user)
	    {
		  
		    $userList[] = array($user->fname,$user->lname,$user->gender,$user->dob,$user->contact_no,$user->email,$user->occupation,$user->status,$user->created_date);
	   }
	}
    $this->excel->getActiveSheet()->fromArray($userList, null, 'A3');
     
    $filename='subadminList.xls'; 
    header('Content-type: application/ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0'); 
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
    $objWriter->save('php://output');
 }
}

	function socialmedia(){		
		 
		$data['title']= "Admin | Social Media Managment";
		$data['basesegment']= $this->uri->segment(2);
		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],24);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['active_tab_password'] = 'active';
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['role'] = $this->data['siterole_id'];
		$data['socialmedia'] = $this->model->get_row('social_media_setting',array('status' => 1));	
		
		if($this->form_validation->run('mediaSetting') == FALSE) {
	        $this->load->view('administrator/include/inner_header',$data);
		    $this->load->view('administrator/socialmedia/mediaSetting',$data);
		    $this->load->view('administrator/include/inner_footer');
		} else {
			$social['facebook'] = $this->input->post('facebook');
			$social['google'] = $this->input->post('google');
			$social['linkedin'] = $this->input->post('linkedin');
			$social['twitter'] = $this->input->post('twitter');
			$where=array('id'=>1);
			$inserted = $this->model->update('social_media_setting', $social,$where);
			$this->session->set_flashdata('success', 'Updated succussfully!');
			redirect('administrator/socialmedia');
		}		
		
    }
    function contactus() // Maps to the info controller default method 
	{   
		$data['title'] = 'Contact Us';
		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],32);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['active_tab_contact'] = 'active';
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['role'] = $this->data['siterole_id'];
		$data['segment'] = $this->uri->segment(2);	
		$data['enquiry'] = $this->model->get_data('*','tbl_enquiry', array('move_enquiry'=>0,'delete_enquiry'=>0, 'store_enquiry'=>0));
		
		$this->load->view('administrator/include/inner_header',$data);
	    $this->load->view('administrator/contactus/contactus',$data);	
	    $this->load->view('administrator/include/inner_footer');	
	}

	function contactus_store() // Maps to the info controller default method 
	{
		$data['title'] = 'Contact Us';
		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],32);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['active_tab_contact'] = 'active';
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['role'] = $this->data['siterole_id'];
		$data['segment'] = $this->uri->segment(2);		
		$data['enquiry'] = $this->model->get_data('*','tbl_enquiry', array('move_enquiry'=>0,'delete_enquiry'=>0, 'store_enquiry'=>1));
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/contactus/store',$data);	
		$this->load->view('administrator/include/inner_footer');			
	}

	function contactus_move() // Maps to the info controller default method 
	{
		$data['title'] = 'Contact Us';
		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],32);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['active_tab_contact'] = 'active';
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['role'] = $this->data['siterole_id'];
		$data['segment'] = $this->uri->segment(2);		
		$data['enquiry'] = $this->model->get_data('*','tbl_enquiry', array('move_enquiry'=>1, 'delete_enquiry'=>0));
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/contactus/move',$data);	
		$this->load->view('administrator/include/inner_footer');		
	}
 function view_enquiry(){
    	$data['title'] = 'Message Details';
		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],32);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['active_tab_contact'] = 'active';
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['role'] = $this->data['siterole_id'];
    	$id = $this->uri->segment(3);
        $data['enquiryDetails'] = $this->model->get_row('tbl_enquiry', array('id' =>$id  ));
    	$data['replyDetails'] = $this->model->get_data('*', 'tbl_reply_enquiry', array('enquiry_id' =>$id  ));

    	
    	$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/contactus/reply_enquiry',$data);	
		$this->load->view('administrator/include/inner_footer');
    }
	function contactus_reply() // Maps to the info controller default method 
	{
        $e_name = $this->input->post('e_name'); 
		$email = $this->input->post('email');   
		$inbox_ids = $this->input->post('Id');
		$subject=$this->input->post('subject');
		$enquiryid=$this->input->post('enquiry_id');
		$message = $this->input->post('msg_contact'); 
		$inbox_action = $this->input->post('inbox_action');
		
        $enquiryData['enquiry_id'] = $enquiryid;
		$enquiryData['msg'] = $message;
		$enquiryData['date'] = date('Y-m-d h:i:s');

		$this->model->insert_data('tbl_reply_enquiry',$enquiryData);
		//group mail 
		if($inbox_action == 'mail_multiple'){
			$sql = " SELECT name,email,id FROM `tbl_enquiry` WHERE `id` IN ($email)  ";
			$res= $this->db->query($sql);
			$result = $res->result_array();
			foreach ($result as $result) {
				$row1 =  $this->model->get_row('email_templates',array('title'=>'Messaging'));
				$r_subject = $row1->subject;
				$r_message = $row1->content;
				$description = $r_msg;
				//$string = explode("@", $result['email']);
				//$username = $string[0];
				$r_message = str_replace("{username}",ucfirst($result['name']),$r_message);
				$r_message = str_replace("{subject}",ucfirst($subject),$r_message);
				$r_message = str_replace("{message}",ucfirst($message),$r_message);
				$r_message = str_replace("{user_email_address}",$result['email'],$r_message);
				$this->sendingMail($result['email'] ,$r_subject, $r_message);
				//12-02 $this->sendingMail($result['email'], $subject, $message);
				//12-02 $set_value = '`status`= 1';
				//12-02 $query = $this->db->query('update tbl_enquiry set `status`= 0' );
			}			
		}
		//single mail 
		if($inbox_action == 'mail_single'){
			    $row1 =  $this->model->get_row('email_templates',array('title'=>'Messaging'));
				$r_subject = $row1->subject;
				$r_message = $row1->content;
				$description = $r_msg;
				//$string = explode("@", $email);
				//$username = $string[0];
				$r_message = str_replace("{username}",ucfirst($e_name),$r_message);
				$r_message = str_replace("{subject}",ucfirst($subject),$r_message);
				$r_message = str_replace("{message}",ucfirst($message),$r_message);
				$r_message = str_replace("{user_email_address}",$email,$r_message);
				$this->sendingMail($email,$r_subject, $r_message);
			//12-02 $this->sendingMail($email, $subject, $message);
			$set_value = '`status`= 1';
			$marks_as_read = $this->model->update_enquiry($set_value, $inbox_ids);	
		}			

		$responce = array('msg_status'=>'msg_success','msg_message'=>'Mail sent successfully.');
     	print_r(json_encode($responce ));
     	die;		
	}



	public function contactus_acitities()
	{
		$inbox_ids = $this->input->post('inbox_ids');   
		$inbox_action=$this->input->post('inbox_action');

		if($inbox_action == 'move_enquiry'){
			$set_value = '`move_enquiry`= 0,`store_enquiry`= 0';
			$marks_as_read = $this->model->update_enquiry($set_value, $inbox_ids);
			//echo $this->db->last_query();			
		}
		if($inbox_action == 'move_to_trash'){
			$set_value = '`move_enquiry`= 1,`store_enquiry`= 0';
			$marks_as_read = $this->model->update_enquiry($set_value, $inbox_ids);
			//echo $this->db->last_query();			
		}




		if($inbox_action == 'store_enquiry'){
			$set_value = '`store_enquiry`= 1';
			$marks_as_read = $this->model->update_enquiry($set_value, $inbox_ids);			
		}
		if($inbox_action == 'delete_enquiry'){
			$set_value = '`delete_enquiry`= 1';
			$marks_as_read = $this->model->update_enquiry($set_value, $inbox_ids);			
		}
		if($inbox_action == 'restore_enquiry'){
			$set_value = '`move_enquiry`= 0';
			$marks_as_read = $this->model->update_enquiry($set_value, $inbox_ids);	
				
		}
		if($inbox_action == 'equiry_read'){
			$set_value = '`read_status`= 1';
			$marks_as_read = $this->model->update_enquiry($set_value, $inbox_ids);	
				
		}
		echo 1;
		die;
		
        //$item_category_sub = $result->result();
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

/*********notification View************/
function viewnot()
{
	$tablename = $this->input->post('tablename');
	$id = $this->input->post('id');
	
	if($tablename == 'tbl_notification'){
		$view['n_view_user'] = 1;
	    $where= array('n_id'=>$id);
	}
	
	$update = $this->model->update($tablename,$view,$where);
    echo 1;
}
function view_notification()
{
	$tablename = $this->input->post('tablename');
	if($tablename == 'tbl_review'){
		$view['admin_view_review'] = 1;
	    $where= array(1=>1);
	}
	if($tablename == 'tbl_vacation_list'){
		$view['admin_view_review'] = 1;
	    $where= array(1=>1);
	}
	if($tablename == 'tbl_classified_list'){
		$view['admin_view_review'] = 1;
	    $where= array(1=>1);
	}
	if($tablename == 'tbl_news'){
		$view['admin_view_review'] = 1;
	    $where= array(1=>1);
	}
	if($tablename == 'forum_question'){
		$view['admin_view_review'] = 1;
	    $where= array(1=>1);
	}
	$update = $this->model->update($tablename,$view,$where);
    echo 1;
}

function forum_heading(){

	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;	
	if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],27);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
	$data['title'] = 'Forum Heading';
	$data['active_tab_forum'] = 'active';
	$data['basesegment']= $this->uri->segment(2);
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	$data['role'] = $this->data['siterole_id'];

	$data['forum_heading'] = $this->model->get_row('forum_heading',array('id' => 1));
	if($this->form_validation->run('forum_heading') == FALSE)
	{

		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/forum/forum_heading',$data);
		$this->load->view('administrator/include/inner_footer');

	} else {

		$forum_heading['title'] = $this->input->post('title');
		$forum_heading['description'] = $this->input->post('description');
		$forum_heading['update_date'] = date('Y-m-d h:i:s');
		$where=array('id'=>1);
		$inserted = $this->model->update('forum_heading', $forum_heading,$where);
		if($inserted){

		  $this->session->set_flashdata('success', 'Updated succussfully.');
		}	

		redirect(base_url().'administrator/forum_heading');	
	}
}
function subcription_form(){

	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;
	$data['title'] = 'Subcription Form';
	$data['active_tab_forum'] = 'active';
	$data['basesegment']= $this->uri->segment(2);
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	$data['role'] = $this->data['siterole_id'];

	$data['subcription_form'] = $this->model->get_row('tbl_mailchimp_credentiall',array('id' => 1));
	if($this->form_validation->run('subcription_form') == FALSE)
	{

		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/subcription/subcription_form',$data);
		$this->load->view('administrator/include/inner_footer');

	} else {

		$subcription['html'] = $this->input->post('html');
		$subcription['date'] = date('Y-m-d h:i:s');
		$where=array('id'=>1);
		$inserted = $this->model->update('tbl_mailchimp_credentiall', $subcription,$where);
		if($inserted){

		  $this->session->set_flashdata('success', 'Updated succussfully.');
		}	

		redirect(base_url().'administrator/subcription_form');	
	}
}
public function change_password(){
         
      $userid = $this->input->post('userid');
      $password = base64_encode($this->input->post('password'));
      $update = $this->model->update('tbl_user_master',array('password'=>$password),array('user_id'=>$userid));
           
      if($update){
           $getUserEmail = $this->model->get_row('tbl_user_master',  array('user_id' => $userid));
			$username = '';
			if(isset($getUserEmail->fname) && !empty($getUserEmail->fname)){
              $username = $getUserEmail->fname;
			}else{
			  $username = $getUserEmail->username;
			}

      	           $row1 =  $this->model->get_row('email_templates',array('title'=>'changePassword'));
					$message = $row1->content;
					$subject = $row1->subject;
					$message = str_replace("{username}",ucfirst($username),$message);
					$message = str_replace("{user_email_address}",$getUserEmail->email,$message);
					$message = str_replace("{new_password}",$this->input->post('password'),$message);
					$this->sendingMail($getUserEmail->email ,$subject, $message);
      	
        echo 1;
        //e10adc3949ba59abbe56e057f20f883e
      }
    }
    /**
	 * seo setting Page for this controller.
	 */

function seo_setting(){

		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],33);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		 
		$data['title']= "Admin | SEO Settings";
		$data['active_cms_page'] = 'active';
		$data['role'] = $this->data['siterole_id'];
		$data['basesegment']= $this->uri->segment(2);
		$data['segment']= $this->uri->segment(3);
		$data['pageList'] = $this->model->get_data('*','page_list',array(1=>1));

		//$data['seoSettingList'] = $this->model->get_all_order_by('*', 'seo_setting','meta_id','DESC');

		$data['seoSettingList'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array(1=>1),'seo_setting.meta_id','desc');
		
		 if($data['segment'] == 'add') {

		 	
		 if($this->form_validation->run('addseo') == FALSE) {
		 	if (isset($result)) {
			  	if($result[0]->permission_id == 33){
			  		if($result[0]->add_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}

			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/seo/add_seo_page',$data);;
			$this->load->view('administrator/include/inner_footer');	
		
		 } else {

		 	$cmspage['page_id'] = $this->input->post('page_name');
		 	$cmspage['meta_title'] = $this->input->post('meta_title');
		 	$cmspage['meta_keyword'] = $this->input->post('mata_keywords');
		 	$cmspage['meta_author'] = $this->input->post('mata_author');
		 	$cmspage['meta_viewport'] = $this->input->post('mata_viewport');
		 	$cmspage['meta_description'] = $this->input->post('meta_description');
		 	$cmspage['date'] = date('Y-m-d h:i:s');
		    $dat = $this->model->get_row('seo_setting',array('page_id' => $data['pageID']));	
		 	$condition2 = array('page_id' =>$dat->page_id);
		    $this->db->delete('seo_setting', $condition2);
		 	//Insert into tbl_trail_master table
			$inserted = $this->model->insert_data('seo_setting',$cmspage);
			if($inserted){
				$this->session->set_flashdata('success', 'The SEO settings is Successfully inserted');
				redirect(base_url().'administrator/seo_setting');
			}
		 	
		 }
		
		}
		
		else if($data['segment'] == 'edit') {
            if (isset($result)) {
			  	if($result[0]->permission_id == 33){
			  		if($result[0]->edit_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			}
		   $data['pageID']= $this->uri->segment(4);
		   $data['aboutus'] = $this->model->get_row('seo_setting',array('meta_id' => $data['pageID']));	
		   $condition2 = array('page_id' =>$data['aboutus']->page_id);
		   $this->db->delete('seo_setting', $condition2);
  
		 if($this->form_validation->run('addseo') == FALSE) {

			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/seo/add_seo_page',$data);;
			$this->load->view('administrator/include/inner_footer');	
		
		 } else {
            $condition2 = array('page_id' =>$data['aboutus']->page_id);
		    $this->db->delete('seo_setting', $condition2);
		 	$cmspage['page_id'] = $this->input->post('title');
		 	$cmspage['meta_title'] = $this->input->post('meta_title');
		 	$cmspage['meta_keyword'] = $this->input->post('mata_keywords');
		 	$cmspage['meta_author'] = $this->input->post('mata_author');
		 	$cmspage['meta_viewport'] = $this->input->post('mata_viewport');
		 	$cmspage['meta_description'] = $this->input->post('meta_description');
		 	$cmspage['date'] = date('Y-m-d h:i:s');
		 	
		 	$where = array('meta_id' => $data['pageID']);
		 	$inserted = $this->model->update('seo_setting', $cmspage, $where);
		 	
		 	if($inserted){
				$this->session->set_flashdata('success', 'The SEO settings is Successfully update');
				redirect('administrator/seo_setting');
			}
		 }
		
		}
		else {

			$this->load->view('administrator/include/inner_header',$data);
	        $this->load->view('administrator/seo/seo_setting',$data);
	        $this->load->view('administrator/include/inner_footer');

		
		}
	}

}// class close