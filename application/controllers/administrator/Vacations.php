<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacations extends CI_Controller {
    public function __construct(){


		parent::__construct();
		/* Load the libraries and helpers */        
		$this->load->model('model');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper('resize');
		$this->load->helper('custom_helper');
		$info=$this->session->all_userdata();

	//	print_r($info);
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
	 * Rental List Page for this controller.
	 */
public function vacationlist(){


	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;	
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],14);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');	$data['role'] = $this->data['siterole_id'];	
		
	$data['active_tab_vacation'] = 'active'; 
	$data['title'] = 'Rentals Listings';
	$data['segment']= $this->uri->segment(1);
    $data['basesegment'] = $this->uri->segment(2);
	$data['segment'] = $this->uri->segment(3);
	if($data['segment'] == 'pendingapprovals'){
     $query = $this->db->query("SELECT  `plan_master` . * ,  `tbl_vacation_list` . * ,  `tbl_user_master`.`lname` ,  `tbl_user_master`.`fname` FROM  `tbl_vacation_list` LEFT JOIN  `tbl_user_master` ON  `tbl_vacation_list`.`user_id` =  `tbl_user_master`.`user_id` LEFT JOIN  `plan_master` ON  `plan_master`.`pl_id` =  `tbl_vacation_list`.`pl_id` WHERE  `tbl_vacation_list`.`vac_status` =0  ORDER BY  `vac_id` DESC ");
          $data['businessList'] = $query->result();  

		////////////////////////total user////////
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/vacations/Vacpendingapprovals',$data);
		$this->load->view('administrator/include/inner_footer');
	}
	else if($data['segment'] == 'expired'){
     $query = $this->db->query("SELECT  `plan_master` . * ,  `tbl_vacation_list` . * ,  `tbl_user_master`.`lname` ,  `tbl_user_master`.`fname` FROM  `tbl_vacation_list` LEFT JOIN  `tbl_user_master` ON  `tbl_vacation_list`.`user_id` =  `tbl_user_master`.`user_id` LEFT JOIN  `plan_master` ON  `plan_master`.`pl_id` =  `tbl_vacation_list`.`pl_id` WHERE  `tbl_vacation_list`.`vac_status` =0  ORDER BY  `vac_id` DESC ");
          $data['businessList'] = $query->result();    

		////////////////////////total user////////
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/vacations/VacExpired',$data);
		$this->load->view('administrator/include/inner_footer');
	}
	else if($data['segment'] == 'paid'){
     $query = $this->db->query("SELECT  `plan_master` . * ,  `tbl_vacation_list` . * ,  `tbl_user_master`.`lname` ,  `tbl_user_master`.`fname` FROM  `tbl_vacation_list` LEFT JOIN  `tbl_user_master` ON  `tbl_vacation_list`.`user_id` =  `tbl_user_master`.`user_id` LEFT JOIN  `plan_master` ON  `plan_master`.`pl_id` =  `tbl_vacation_list`.`pl_id` WHERE  `tbl_vacation_list`.`vac_status` =0 AND  `tbl_vacation_list`.`vac_payment_status` =1 AND  `plan_master`.`pl_price` !=0 ORDER BY  `vac_id` DESC ");
          $data['businessList'] = $query->result();

		////////////////////////total user////////
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/vacations/VacPaid',$data);
		$this->load->view('administrator/include/inner_footer');
	}
	else if($data['segment'] == 'updatedlist'){
       $query=$this->db->query("SELECT * FROM `tbl_update_vacation_list` inner join tbl_user_master
        on tbl_update_vacation_list.user_id = tbl_user_master.user_id  ORDER BY `vac_id` DESC ");

        $data['businessList'] = $query->result();

		////////////////////////total user////////
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/vacations/vacationUpdatedlist',$data);
		$this->load->view('administrator/include/inner_footer');
	}
	else if($data['segment'] == 'free_trial_pending'){
     $query = $this->db->query("SELECT  `plan_master` . * ,  `tbl_vacation_list` . * ,  `tbl_user_master`.`lname` ,  `tbl_user_master`.`fname` FROM  `tbl_vacation_list` LEFT JOIN  `tbl_user_master` ON  `tbl_vacation_list`.`user_id` =  `tbl_user_master`.`user_id` LEFT JOIN  `plan_master` ON  `plan_master`.`pl_id` =  `tbl_vacation_list`.`pl_id` WHERE  `tbl_vacation_list`.`vac_status` =0 AND  `plan_master`.`pl_price` =0 ORDER BY  `vac_id` DESC ");
          $data['businessList'] = $query->result();

		////////////////////////total user////////
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/vacations/VacFreeTrialPending',$data);
		$this->load->view('administrator/include/inner_footer');
	}
	else if($data['segment'] == 'paymentpending'){
			  
	  $query = $this->db->query("SELECT  `plan_master` . * ,  `tbl_vacation_list` . * ,  `tbl_user_master`.`lname` ,  `tbl_user_master`.`fname` FROM  `tbl_vacation_list` LEFT JOIN  `tbl_user_master` ON  `tbl_vacation_list`.`user_id` =  `tbl_user_master`.`user_id` LEFT JOIN  `plan_master` ON  `plan_master`.`pl_id` =  `tbl_vacation_list`.`pl_id` WHERE  `tbl_vacation_list`.`vac_status` =0 AND  `tbl_vacation_list`.`vac_payment_status` =0 AND  (`tbl_vacation_list`.`vac_expiry_date` >= '".date('Y-m-d')."' OR `tbl_vacation_list`.`vac_expiry_date` = '0000-00-00') AND  `plan_master`.`pl_price` !=0 ORDER BY  `vac_id` DESC ");
          $data['businessList'] = $query->result();
         
		////////////////////////total user////////
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/vacations/VacPaymentPending',$data);
		$this->load->view('administrator/include/inner_footer');
	}else if($data['segment'] == 'publish'){
		$where=array('vac_status'=>1);
	    $data['businessList'] =$this->model->get_data_rl_join('tbl_vacation_list.*,tbl_user_master.lname, tbl_user_master.fname', 'tbl_vacation_list','tbl_user_master','user_id','user_id', $where,'vac_id','DESC','left');	  
		////////////////////////total user////////
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/vacations/VacPublish',$data);
		$this->load->view('administrator/include/inner_footer');
	}
	else{

	 //$data['businessList'] =$this->model->get_data_join('tbl_vacation_list.*,tbl_user_master.lname, tbl_user_master.fname', 'tbl_vacation_list','tbl_user_master','user_id','user_id', 'vac_id','DESC');
		$query=$this->db->query("SELECT *, (SELECT AVG(rating) FROM tbl_review WHERE  bus_ID = tbl_vacation_list.vac_id) as `totalrating` FROM `tbl_vacation_list` inner join tbl_user_master
        on tbl_vacation_list.user_id = tbl_user_master.user_id  ORDER BY `vac_id` DESC ");

        $data['businessList'] = $query->result();
		////////////////////////total user////////
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/vacations/vacationlist',$data);
		$this->load->view('administrator/include/inner_footer');	
	}	
		
}
/**
	 * Rental Add Page for this controller.
	 */
public function addvacationpage(){

		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],14);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
	    if (isset($result)) {
	  	if($result[0]->permission_id == 14){
	  		if($result[0]->add_permission !=1){
	  		 	redirect(base_url().'access_denied');
	  		}
	  	}
	  }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['role'] = $this->data['siterole_id'];
		$data['active_tab_vacation'] = 'active';
	  	$data['title'] = 'Add New Rentals';
		$data['basesegment'] = $this->uri->segment(2);
		$data['businessList'] = $this->model->get_all_order_by('*', 'tbl_vacation_list','vac_id','DESC');
		$data["propertyList"] = $this->model->get_data('*', 'advance_filter_fields', array('status' => 1));
      	$data['stateList'] = $this->model->get_all('*', 'tbl_state');  
	
		if($this->form_validation->run('addvacbusin') == FALSE) {
		
			$this->load->view('administrator/include/inner_header',$data);
			$this->load->view('administrator/vacations/vacation',$data);
			$this->load->view('administrator/include/inner_footer');
		
		} else {
		        /*$businessadd['pl_id'] = $this->input->post('plan_id');
	  	        $businessadd['user_id'] = $data['user_id'];
		        $businessadd['trail_id'] = 'Lodging';
			    $businessadd['vac_name'] = $this->input->post('vac_name');
			    $slug = create_unique_slug( $classifiedpage['vac_slag'],'tbl_vacation_list','vac_slag');
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
				$businessadd['vac_created_by'] = 'Admin';
				$businessadd['vac_update_date'] = date('Y-m-d H:i:s');
				$monthnew = 12;
				$datetime = new DateTime();
				$datetime->modify('+'.$monthnew.' months');
				$expiry_date = $datetime->format('Y-m-d H:i:s');
				$businessadd['vac_expiry_date'] = $expiry_date;
				

				$businessadd['vac_lat'] = $this->input->post('pro_add_lat');
				$businessadd['vac_lang'] = $this->input->post('pro_add_lng');
                $businessadd['vac_status'] = 1;
				$inserted = $this->model->insert_data('tbl_vacation_list',$businessadd);
				$vacID = $this->db->insert_id();
				$this->image_upload_rental($businessadd['vac_name'],$vacID);
				if($inserted){
					$query = $this->db->query("SELECT DISTINCT tbl_vacation_list.user_id, tbl_user_master.email, tbl_user_master.fname FROM  `tbl_vacation_list` LEFT JOIN tbl_user_master ON tbl_vacation_list.user_id = tbl_user_master.user_id WHERE tbl_vacation_list.user_id !=1");
					$rentalLst = $query->result();

					foreach ($rentalLst as $rentalLst) {
					$row1 =  $this->model->get_row('email_templates',array('title'=>'AdminNewRentalSubmission'));
						$message = $row1->content;
						$subject = $row1->subject;

						$pageLike = base_url().'lodging/'.$businessadd['vac_slag'];
						$message = str_replace("{username}",ucfirst($rentalLst->fname),$message);
						$message = str_replace("{user_email_address}",$rentalLst->email,$message);
						$message = str_replace("{rental_property_name}",$businessadd['vac_name'],$message);
						$message = str_replace("{rental_page_link}",$pageLike,$message);
						$this->sendingMail($rentalLst->email,$subject, $message);

					}
                    $this->session->set_flashdata('success', 'The vacational Business is Successfully Added');
					redirect(base_url().'administrator/rentalslist');
				}*/
		
		} 	  
		
}
public function rental_submit(){

$data['u_id'] = $this->data['user_id'];
$businessadd['pl_id'] = $this->input->post('plan_id');
$businessadd['user_id'] = $data['u_id'];
$businessadd['trail_id'] = 'Lodging';
$businessadd['vac_name'] = $this->input->post('vac_name');
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
$businessadd['vac_created_by'] = 'Admin';
$businessadd['vac_update_date'] = date('Y-m-d H:i:s');
$monthnew = 12;
$datetime = new DateTime();
$datetime->modify('+'.$monthnew.' months');
$expiry_date = $datetime->format('Y-m-d H:i:s');
$businessadd['vac_expiry_date'] = $expiry_date;
/***********GET LAT LONG************/

$businessadd['vac_lat'] = $this->input->post('pro_add_lat');
$businessadd['vac_lang'] = $this->input->post('pro_add_lng');
$businessadd['vac_status'] = 1;
$inserted = $this->model->insert_data('tbl_vacation_list',$businessadd);
$vacID = $this->db->insert_id();
$this->image_upload_rental($businessadd['vac_name'],$vacID);

if($inserted){
	$query = $this->db->query("SELECT DISTINCT tbl_vacation_list.user_id, tbl_user_master.email, tbl_user_master.fname FROM  `tbl_vacation_list` LEFT JOIN tbl_user_master ON tbl_vacation_list.user_id = tbl_user_master.user_id WHERE tbl_vacation_list.user_id !=1");
	$rentalLst = $query->result();

	foreach ($rentalLst as $rentalLst) {
	$row1 =  $this->model->get_row('email_templates',array('title'=>'AdminNewRentalSubmission'));
		$message = $row1->content;
		$subject = $row1->subject;

		$pageLike = base_url().'lodging/'.$businessadd['vac_slag'];
		$message = str_replace("{username}",ucfirst($rentalLst->fname),$message);
		$message = str_replace("{user_email_address}",$rentalLst->email,$message);
		$message = str_replace("{rental_property_name}",$businessadd['vac_name'],$message);
		$message = str_replace("{rental_page_link}",$pageLike,$message);
		$this->sendingMail($rentalLst->email,$subject, $message);

	}
    $this->session->set_flashdata('success', 'The vacational Business is Successfully Added');
    echo json_encode(array('page_url'=>base_url()));
	//redirect(base_url().'administrator/rentalslist');
}



}

/**
	 * Rental Edit Page for this controller.
	 */
public function rental_edit_submit(){
  
	$businessadd['pl_id'] = $this->input->post('plan_id');
	$businessadd['trail_id'] = 'Lodging';
	$businessadd['vac_name'] = $this->input->post('vac_name');
	$slug = create_unique_slug( $businessadd['vac_name'],'tbl_vacation_list','vac_slag');
	$businessadd['vac_slag'] = $slug;
	$businessadd['vac_type'] = $this->input->post('vac_type');
	$businessadd['vac_contact'] = $this->input->post('vac_contact');
	$businessadd['vac_email'] = $this->input->post('vac_email');
	$businessadd['vac_address'] = $this->input->post('vac_address');
	$businessadd['state_name'] = $this->input->post('vac_state');
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
	$businessadd['vac_update_date'] = date('Y-m-d H:i:s');
	$latlong = $this->get_lat_long($businessadd['vac_address']);
	$businessadd['vac_lat'] = $this->input->post('pro_add_lat');
	$businessadd['vac_lang'] = $this->input->post('pro_add_lng');
	$this->image_upload_rental($businessadd['vac_name'],$this->input->post('vac_id'));
	$where = array('vac_id' => $this->input->post('vac_id'));
	$update = $this->model->update('tbl_vacation_list', $businessadd, $where);
	if($update){

	$this->session->set_flashdata('success', 'You have successfully updated your listing.');
	//redirect(base_url().'administrator/rentalslist');
	echo json_encode(array('page_url'=>base_url()));
	}

		 

}
public function editvacationpage(){

		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],14);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
	    if (isset($result)) {
	  	if($result[0]->permission_id == 14){
	  		if($result[0]->edit_permission !=1){
	  		 	redirect(base_url().'access_denied');
	  		}
	  	}
	  }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['role'] = $this->data['siterole_id'];
		$data['active_tab_vacation'] = 'active'; 
		$data['user_id'] = $this->data['user_id'];
	  	$data['title'] = 'Edit New Rentals';
	  	$data["propertyList"] = $this->model->get_data('*', 'advance_filter_fields', array('status' => 1));
        $data['stateList'] = $this->model->get_all('*', 'tbl_state');
		$data['basesegment'] = $this->uri->segment(2);
		$data['businessList'] = $this->model->get_all_order_by('*', 'tbl_vacation_list','vac_id','DESC');
      
		$data['busID'] = $this->uri->segment(3);

		$data['updateList']= $this->model->get_row('tbl_vacation_list', array('vac_id'=>$data['busID']));
		if($data['updateList']->update_status == 1){
			
	        $data['businessDetail'] = $this->model->get_row('tbl_update_vacation_list', array('vac_id'=>$data['busID']));
		}else{
	        $data['businessDetail'] = $this->model->get_row('tbl_vacation_list', array('vac_id'=>$data['busID']));
		}


		//$data['businessDetail'] = $this->model->get_row('tbl_vacation_list', array('vac_id'=>$data['busID']));


		$data['busPhotos'] = $this->model->get_data('*','tbl_vacation_list_images', array('vac_id'=>$data['busID']));
	  
	  if($this->form_validation->run('editvacbusin') == FALSE) {

	  	$this->load->view('administrator/include/inner_header',$data);
	  	$this->load->view('administrator/vacations/vacation',$data);;
	  	$this->load->view('administrator/include/inner_footer');	

	  } else {
               /* $businessadd['pl_id'] = $this->input->post('plan_id');
		        $businessadd['trail_id'] = 'Lodging';
			    $businessadd['vac_name'] = $this->input->post('vac_name');
			    $$slug = create_unique_slug( $classifiedpage['vac_slag'],'tbl_vacation_list','vac_slag');
				$businessadd['vac_slag'] = $slug;
				$businessadd['vac_type'] = $this->input->post('vac_type');
				$businessadd['vac_contact'] = $this->input->post('vac_contact');
				$businessadd['vac_email'] = $this->input->post('vac_email');
				$businessadd['vac_address'] = $this->input->post('vac_address');
				$businessadd['state_name'] = $this->input->post('vac_state');
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
				$businessadd['vac_update_date'] = date('Y-m-d H:i:s');
				$latlong = $this->get_lat_long($businessadd['vac_address']);
				$businessadd['vac_lat'] = $this->input->post('pro_add_lat');
				$businessadd['vac_lang'] = $this->input->post('pro_add_lng');
	         $this->image_upload_rental($businessadd['vac_name'],$data['busID']);
	  	$where = array('vac_id' => $data['busID']);
	  	$update = $this->model->update('tbl_vacation_list', $businessadd, $where);
	  	if($update){
	  		
	  		$this->session->set_flashdata('success', 'You have successfully updated your listing.');
	  		redirect(base_url().'administrator/rentalslist');
	  	}

	  }	 */ 
		
}
}
public function viewvacationpage(){

		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],14);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
	    }
	    if (isset($result)) {
	  	if($result[0]->permission_id == 14){
	  		if($result[0]->view_permission !=1){
	  		 	redirect(base_url().'access_denied');
	  		}
	  	}
	  }
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['role'] = $this->data['siterole_id'];
		$data['active_tab_vacation'] = 'active'; 
		$data['user_id'] = $this->data['user_id'];
	  	$data['title'] = 'View New Rentals';
	  	$data["propertyList"] = $this->model->get_data('*', 'advance_filter_fields', array('status' => 1));
        $data['stateList'] = $this->model->get_all('*', 'tbl_state');
		$data['basesegment'] = $this->uri->segment(2);
		$data['businessList'] = $this->model->get_all_order_by('*', 'tbl_vacation_list','vac_id','DESC');
      
		$data['busID'] = $this->uri->segment(3);
		$data['businessDetail'] = $this->model->get_row('tbl_vacation_list', array('vac_id'=>$data['busID']));
		$data['busPhotos'] = $this->model->get_data('*','tbl_vacation_list_images', array('vac_id'=>$data['busID']));
		$data['PaymentDetails'] = $this->model->get_data('*','payments', array('product_id'=>$data['busID']));
		$this->load->view('administrator/include/inner_header',$data);
	  	$this->load->view('administrator/vacations/vacationview',$data);;
	  	$this->load->view('administrator/include/inner_footer');	


}
/**
	 * reviews List Page for this controller.
	 */
public function reviews(){

	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;	
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],15);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
	}
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	$data['role'] = $this->data['siterole_id'];	
		
	$data['active_tab_vacation'] = 'active'; 
	$data['title'] = 'Reviews Listings';
	$data['segment']= $this->uri->segment(1);
    $data['basesegment'] = $this->uri->segment(2);
	$data['segment'] = $this->uri->segment(3);

	$query=$this->db->query("SELECT tbl_vacation_list.*,tbl_review.* FROM `tbl_vacation_list` inner join tbl_review
        on tbl_vacation_list.vac_id = tbl_review.bus_ID WHERE review_ID IN (
    SELECT MAX(review_ID) FROM tbl_review GROUP BY bus_ID) ORDER BY tbl_review.`created_date` DESC");
    $data['businessList'] = $query->result();
	////////////////////////total user////////
	$this->load->view('administrator/include/inner_header',$data);
	$this->load->view('administrator/vacations/reviewlist',$data);
	$this->load->view('administrator/include/inner_footer');	

}
/**
* Rental Review Details 
*/

public function rental_review_details(){

		$data['u_id'] = $this->data['user_id'];
		$info=$this->session->all_userdata();
		$data['userinfo']=$info;	
		if($data['u_id'] !=1){
		$result = role_permission($data['u_id'],15);
			if (empty($result)) {
			 redirect(base_url().'access_denied');
			}
		}
		$data['basesegment'] = $this->uri->segment(2);
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');		$data['role'] = $this->data['siterole_id'];
		$data['active_tab_vacation'] = 'active'; 
		$data['user_id'] = $this->data['user_id'];
	  	$data['title'] = 'Rental Review Details';
	  	$data['reviewID'] = $this->uri->segment(3);
	  	$data['busID'] = $this->uri->segment(4);
	  	
        if($data['busID'] == 'edit'){
        	 if (isset($result)) {
			  	if($result[0]->permission_id == 15){
			  		if($result[0]->view_permission !=1){
			  		 	redirect(base_url().'access_denied');
			  		}
			  	}
			  }
        	$data['ID'] = $this->uri->segment(5);
	  	
        	$query = $this->db->query(" SELECT tbl_vacation_list.vac_name,tbl_vacation_list.vac_id, tbl_review.*, tbl_user_master.fname, tbl_user_master.lname, tbl_user_master.username FROM 
	  		tbl_review  INNER JOIN tbl_user_master ON tbl_review.user_ID=tbl_user_master.user_id
	  		INNER JOIN tbl_vacation_list ON tbl_review.bus_ID=tbl_vacation_list.vac_id
	  		 WHERE review_ID = ".$data['ID']." ORDER BY tbl_review.`created_date` DESC");
            $data['reviewEdit'] = $query->result();
			if($this->form_validation->run('review') == FALSE) {

				$this->load->view('administrator/include/inner_header',$data);
				$this->load->view('administrator/vacations/review_add',$data);;
				$this->load->view('administrator/include/inner_footer');	

			}else{
				$reviewEdit['review_title'] = $this->input->post('review_title');
				$reviewEdit['comment'] = $this->input->post('comment');
				$where = array('review_ID' => $data['ID']);
				$update = $this->model->update('tbl_review', $reviewEdit, $where);
				if($update){
					$this->session->set_flashdata('success', 'Review Update Successfully');
					redirect(base_url().'administrator/rental/review/'.$data['reviewEdit'][0]->bus_ID);
				}

			}

        }else if($data['busID'] == 'publish'){

        	$query = $this->db->query("SELECT tbl_vacation_list.vac_name,tbl_vacation_list.vac_id, tbl_review.*, tbl_user_master.fname, tbl_user_master.lname, tbl_user_master.username FROM 
	  		tbl_review  INNER JOIN tbl_user_master ON tbl_review.user_ID=tbl_user_master.user_id
	  		 INNER JOIN tbl_vacation_list ON tbl_review.bus_ID=tbl_vacation_list.vac_id where tbl_review.status =1");
            $data['review'] = $query->result();
			$this->load->view('administrator/include/inner_header',$data);
		  	$this->load->view('administrator/vacations/review',$data);
		  	$this->load->view('administrator/include/inner_footer');	


        }else if($data['busID'] == 'pendingapprovals'){
        	$query = $this->db->query("SELECT tbl_vacation_list.vac_name,tbl_vacation_list.vac_id, tbl_review.*, tbl_user_master.fname, tbl_user_master.lname, tbl_user_master.username FROM 
	  		tbl_review  INNER JOIN tbl_user_master ON tbl_review.user_ID=tbl_user_master.user_id
	  		 INNER JOIN tbl_vacation_list ON tbl_review.bus_ID=tbl_vacation_list.vac_id where tbl_review.status =0");
            $data['review'] = $query->result();
			$this->load->view('administrator/include/inner_header',$data);
		  	$this->load->view('administrator/vacations/review',$data);
		  	$this->load->view('administrator/include/inner_footer');	


        }else if($data['busID'] == 'rejected'){
        	$query = $this->db->query("SELECT tbl_vacation_list.vac_name,tbl_vacation_list.vac_id, tbl_review.*, tbl_user_master.fname, tbl_user_master.lname, tbl_user_master.username FROM 
	  		tbl_review  INNER JOIN tbl_user_master ON tbl_review.user_ID=tbl_user_master.user_id
	  		 INNER JOIN tbl_vacation_list ON tbl_review.bus_ID=tbl_vacation_list.vac_id where tbl_review.status =2");
            $data['review'] = $query->result();
			$this->load->view('administrator/include/inner_header',$data);
		  	$this->load->view('administrator/vacations/review',$data);
		  	$this->load->view('administrator/include/inner_footer');	


        }
        else{
        	$query = $this->db->query("SELECT tbl_vacation_list.vac_name,tbl_vacation_list.vac_id, tbl_review.*, tbl_user_master.fname, tbl_user_master.lname, tbl_user_master.username FROM 
	  		tbl_review  INNER JOIN tbl_user_master ON tbl_review.user_ID=tbl_user_master.user_id
	  		 INNER JOIN tbl_vacation_list ON tbl_review.bus_ID=tbl_vacation_list.vac_id");
        	//$query = $this->db->query(" SELECT tbl_vacation_list.vac_name,tbl_vacation_list.vac_id, tbl_review.*, tbl_user_master.fname, tbl_user_master.lname, tbl_user_master.username FROM 
	  		//tbl_review  INNER JOIN tbl_user_master ON tbl_review.user_ID=tbl_user_master.user_id
	  		// INNER JOIN tbl_vacation_list ON tbl_review.bus_ID=tbl_vacation_list.vac_id
	  		// WHERE bus_ID = ".$data['busID']."");
            $data['review'] = $query->result();

			$this->load->view('administrator/include/inner_header',$data);
		  	$this->load->view('administrator/vacations/review',$data);
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
		//$config['max_size'] = '15000000';
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



}