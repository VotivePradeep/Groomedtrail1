<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends CI_Controller {
function __construct()// no spaces around parenthesis in function declarations 
{
    parent::__construct();
    $this->load->library('session');
    $info=$this->session->all_userdata();
    $this->load->model('model');
    $this->load->library('email');
    $this->load->library('form_validation');
    $this->load->helper(array('form', 'url'));  
        $this->load->model('Common_model1');
    $this->load->helper('utility_helper'); 
	}

	public function logout(){
      $info = $this->session->all_userdata();
	    $this->session->sess_destroy($info);
	    redirect(base_url());
	}
/////////////////////////////////facebook login/////////////////////////////////////////////

function fblogin(){
		$email = '';
    $lastst_name = $this->input->post('lastst_name');
    $first_name = $this->input->post('first_name');
    
		$id= $this->input->post('id');
		$email=  $this->input->post('email');
		$data=array('social_id'=>$id);
		$check_email=array('email'=>$email);
		$verfiy = $this->model->get_data('*','tbl_user_master',$data);
		if(count($verfiy)>0)
			{
				$session_id =session_id();
				$logininfo= array(
					'session_id'=>session_id(),
					'email'=>$email,
					'siterole'=>2,
					'user_id'=>$verfiy[0]->user_id,
					'logged_in'=>TRUE,
					'social_id'=>$verfiy[0]->social_id,
					'login_type'=>'FB',
					'status'=>$verfiy[0]->status
					);
        $fbdata['social_id'] = $id;
        $fbdata['login_type'] = 'FB';
        $fbdata['fname'] = $first_name;
        $fbdata['lname'] = $lastst_name;
        $where = array('user_id' => $verfiy[0]->user_id);
        $update = $this->model->update('tbl_user_master',$fbdata,$where);
				$this->session->set_userdata($logininfo); 
				$info = $this->session->all_userdata();
      /*  $link = base_url().'logincheck/forgot_verification_link/'.$verfiy[0]->user_id; 
        //$password=  base64_decode($result->password);

        $row =  $this->model->get_row('email_templates',array('title'=>'forgotpassword'));
        $subject = $row->subject;
        $content= $row->content;
        $content= str_replace("{link}",$link,$content);
        $content= str_replace("{username}",$first_name,$content);
        $content= str_replace("{user_email_address}",$email,$content);
        $this->sendingMail($email, $subject, $content);*/
				echo json_encode(array('flag'=>1,'usertype'=>'old user','user_id'=>$verfiy[0]->user_id));
				die;
			  }
			  else
			  {
				   $fullname = $this->input->post('name');

           $photo = 'https://graph.facebook.com/'.$id.'/picture?type=large';
				  // $photo = $this->input->post('picture');
				   $gender = $this->input->post('gender');
				   $originalDate = $this->input->post('birthday');
				   $dob = date("d-m-Y", strtotime($originalDate));     
           $post_data=array('social_id'=>$id,'email'=>$email,'status'=>1,'siterole_id'=>2,'login_type'=>'FB','status'=>1, 'gender'=> $gender,'fname' =>$first_name,'lname' =>$lastst_name, 'profile_picture'=>$photo, 'dob'=>$dob);
					$this->db->insert('tbl_user_master', $post_data); 
					$userid = $this->db->insert_id();
					$getuserdate = $this->model->get_data('*','tbl_user_master',array('user_id' => $userid));
					$session_id= session_id();
					$logininfo= array(
						'session_id'=>session_id(),
						'email'=>$email,
						'user_id'=>$userid,
						'siterole'=>2,
						'logged_in'=>TRUE,
						'social_id'=>$id,
						'login_type'=>'FB',
						'status'=>$getuserdate[0]->status
						);
				    $info = $this->session->set_userdata($logininfo); 
            $link = base_url().'logincheck/forgot_verification_link/'.$userid; 
            //$password=  base64_decode($result->password);

            $row =  $this->model->get_row('email_templates',array('title'=>'forgotpassword'));
            $subject = $row->subject;
            $content= $row->content;
            $content= str_replace("{link}",$link,$content);
            $content= str_replace("{username}",$first_name,$content);
            $content= str_replace("{user_email_address}",$email,$content);
            $this->sendingMail($email, $subject, $content);
					  echo json_encode(array('flag'=>1,'usertype'=>'new user', 'user_id'=>$userid));
				die;
			}
	}
////////////////////////////////google Login//////////////////////////////////////////////
  function googlelogin() {

    $id= $this->input->post('id');
    $email= $this->input->post('email');
    $name= $this->input->post('name');
    $fname= $this->input->post('fname');
    $lname= $this->input->post('lname');
    $data=array('social_id'=>$id);
	  $check_email=array('email'=>$email);
	  $verfiy = $this->model->get_data('*','tbl_user_master',$data);
      if(count($verfiy)>0)
      {
        $session_id =session_id();    
        $logininfo= array(
          'session_id'=>session_id(),
          'email'=>$email,
          'user_id'=>$verfiy[0]->user_id,
          'siterole'=>2,
          'social_id'=>$verfiy[0]->social_id, 
          'login_type'=>'GP',
          'status'=>$verfiy[0]->status          
          );
        $gpdata['fname'] = $fname;
        $gpdata['lname'] = $lname;
        $where = array('user_id' => $verfiy[0]->user_id);
        $update = $this->model->update('tbl_user_master',$gpdata,$where);
        $this->session->set_userdata($logininfo); 
        $info = $this->session->all_userdata();

       /* $link = base_url().'logincheck/forgot_verification_link/'.$verfiy[0]->user_id; 
        //$password=  base64_decode($result->password);
       
        $row =  $this->model->get_row('email_templates',array('title'=>'forgotpassword'));
        $subject = $row->subject;
        $content= $row->content;
        $content= str_replace("{link}",$link,$content);
        $content= str_replace("{username}",$fname,$content);
        $content= str_replace("{user_email_address}",$email,$content);
        $this->sendingMail($email, $subject, $content);*/


        echo json_encode(array('flag'=>$verfiy[0]->status,'usertype'=>'old user','user_id'=>$verfiy[0]->user_id));
        die;
      }
      else
      {
         $photo= $this->input->post('picture');
         $post_data=array('social_id'=>$id,'email'=>$email,'siterole_id'=>2,'status'=>1,'login_type'=>'GP','profile_picture'=>$photo,'username'=>$name,'fname'=>$fname,'lname'=>$lname);
          $this->db->insert('tbl_user_master', $post_data); 
		     $userid = $this->db->insert_id();
         $getuserdate = $this->model->get_data('*','tbl_user_master',array('user_id' => $userid));
         $session_id= session_id();
         $logininfo= array(
            'session_id'=>session_id(),
            'email'=>$email,
            'user_id'=>$userid,
            'social_id'=>$id,
            'siterole'=>2,             
            'login_type'=>'GP',
            'verification_status'=>$getuserdate[0]->status 
            );
        $info = $this->session->set_userdata($logininfo);
        $link = base_url().'logincheck/forgot_verification_link/'.$userid; 
        //$password=  base64_decode($result->password);
        $row =  $this->model->get_row('email_templates',array('title'=>'forgotpassword'));
        $subject = $row->subject;
        $content= $row->content;
        $content= str_replace("{link}",$link,$content);
        $content= str_replace("{username}",$fname,$content);
        $content= str_replace("{user_email_address}",$email,$content);
        $this->sendingMail($email, $subject, $content);




          echo json_encode(array('flag'=>$getuserdate[0]->status,'usertype'=>'new user','user_id'=>$userid));
          die;
      }
  }
 //////////////////////////////////////////////////////////////////////////////
  public function enquiry() 

  { 
      $data['page_name'] = $this->uri->segment(2);
      $enquiry['name'] = $this->input->post('name');
      $enquiry['email'] = $this->input->post('email');
      $enquiry['mobile'] = $this->input->post('mobileNO');
      $enquiry['message'] = $this->input->post('msg_contact');
      $inserted = $this->model->insert_data('tbl_enquiry',$enquiry);
      if($inserted){
       $responce = array('msg_status'=>'msg_success','msg_message'=>'Your message was sent successfully.  One of our customer service representatives will be responding shortly.');

        $query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=32");
        $subAdminEmail = $query->result();
        if(isset( $subAdminEmail)){
            foreach ($subAdminEmail as $semail) {
            $row1 =  $this->model->get_row('email_templates',array('title'=>'Messaging'));
            $subject = $row1->subject;
            $message = $row1->content;
            $message = str_replace("{username}",ucfirst($semail->fname),$message);
            $message = str_replace("{user_email_address}",$semail->email,$message);
            $message = str_replace("{subject}","Enquiry Details<br/> User Email Address: ".$enquiry['email'],$message);
            $message = str_replace("{message}",$enquiry['message'],$message);
            $this->sendingMail($semail->email,$subject, $message);
            }
        }
        $query = $this->db->query("SELECT fname,email,user_id from tbl_user_master WHERE siterole_id =1 AND user_id=1");
        $adminEmail = $query->row();
        $row1 =  $this->model->get_row('email_templates',array('title'=>'Messaging'));
        $subject = $row1->subject;
        $message = $row1->content;
        $message = str_replace("{username}",ucfirst($adminEmail->fname),$message);
        $message = str_replace("{user_email_address}",$adminEmail->email,$message);
        $message = str_replace("{subject}","Enquiry Details<br/> User Email Address: ".$enquiry['email'],$message);
        $message = str_replace("{message}",$enquiry['message'],$message);
        $this->sendingMail($adminEmail->email ,$subject, $message);

        $u_message = $row1->content;
        $u_message = str_replace("{username}",ucfirst($enquiry['name']),$u_message);
        $u_message = str_replace("{user_email_address}",$enquiry['email'],$u_message);
        $u_message = str_replace("{subject}","Your message was sent successfully.  One of our customer service representatives will be responding shortly",$u_message);
        $u_message = str_replace("{message}",$enquiry['message'],$u_message);
        $this->sendingMail($enquiry['email'],$subject, $u_message);

        print_r(json_encode($responce ));
      }else{
        $responce = array('msg_status'=>'msg_error','msg_message'=>'Something goind wrong.');
        print_r(json_encode($responce ));         
      }
      die;
  }

/////////////////////Weather Report/////////////////////////////
 function weatherInfo(){
    
     $lat = $this->input->post('lat');
     $lang = $this->input->post('lang');

      $url = "http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lang&appid=0fe84ad577e0d18b086b9bf4c00be983";
       $json=file_get_contents($url);
       $data1=json_decode($json,true);
       $celcius = $data1['main']['temp'] - 273.15;
       $icon = $data1['weather'][0]['icon'];
       $rain = $data1['weather'][0]['main'];
       $rainDetail = $data1['weather'][0]['description'];
       $temperature = $data1['main']['temp'] - 273.15;
       $wind = $data1['wind']['speed'];
       
       if(empty($icon)){
          $data['weather']= base_url('assest/images/weatherdefaul.png') ;
       }else{
          $data['weather']="http://openweathermap.org/img/w/$icon.png";
       }
       $responce = array('w_image'=>$data['weather'],'w_rain'=>$rain,'w_rainDetail'=>$rainDetail,'w_temperature'=>$temperature,'w_wind'=>$wind);
       print_r(json_encode($responce ));  
  }
 function getCountyInfo(){
    $CountryID = $this->input->post('CountryID');
    $country_name = $this->input->post('country_name');
    $region_name = $this->input->post('region_name');
    $trailCountyDetail = $this->model->get_data('*', 'county_trail_report', array('region_name' =>$region_name ,'county_name' => $country_name));
    // $trailCountyDetail =$query->result();
    $detail = '';
    $county_name = '';
    $cities = '';
    $trail_conditions  = '';
    $maintainedBy= '';
    $submitted_by= '';

     if(isset($trailCountyDetail[0]->county_detail)){
      $detail = $trailCountyDetail[0]->county_detail;
    }
     if(isset($trailCountyDetail[0]->county_name)){
      $county_name = $trailCountyDetail[0]->county_name;
    }
    
     if(isset($trailCountyDetail[0]->cities)){
      $cities = $trailCountyDetail[0]->cities;
    }
    
     if(isset($trailCountyDetail[0]->trail_conditions)){
      $trail_conditions  = $trailCountyDetail[0]->trail_conditions;
    }
    
     if(isset($trailCountyDetail[0]->maintainedBy)){
       $maintainedBy= $trailCountyDetail[0]->maintainedBy;
    }
    if(isset($trailCountyDetail[0]->submitted_by)){
       $submitted_by= $trailCountyDetail[0]->submitted_by;
    }


    $responce = array('county_detail'=>'<b>Description: </b>'.$detail,'county_name'=>$county_name,'maintainedBy'=>'<b>Maintained by: </b>'.$maintainedBy,'cities'=>'<b>Cities:</b> '.$cities,'trail_conditions'=>'<b>Trail conditions: </b>'.$trail_conditions,'submitted_by'=>'<b>Trail report submitted by: </b>'.$submitted_by);
    print_r(json_encode($responce ));  

}
function userSubc(){
  $userID = $this->input->post('userID');
  $trail_name = $this->input->post('trail_name');
  $trail_type = $this->input->post('trail_type');
  $userDetail = $this->model->get_row('tbl_user_master', array('user_id' =>$userID));
  $subcData['subc_user_email'] = $userDetail->email;
  $subcData['subc_user_id'] = $userID;
  $subcData['trail_name'] = $trail_name;
  $subcData['trail_type'] = $trail_type;
  $where = array('trail_name' => $trail_name,'subc_user_id' => $userID);
  $subcDetail = $this->model->get_row('tbl_subscribe_user', $where);
  if (count($subcDetail) != 0) {
        echo "<span>You have already subscribed to this Trail for this email (<b id='subcEmailID'>".$subcDetail->subc_user_email."</b>)</span>
        <a  href='javascript:void(0)' id='updateSubc' onclick ='showFormUpdateSubc();'>Click here for change your email ID</a><a href='javascript:void(0)' onclick ='Unsubscribe(\"".$subcDetail->subc_user_email."\",\"".$subcDetail->trail_name."\");'>Unsubscribe email for this trail</a>";

     
  } else {
      $inserted = $this->model->insert_data('tbl_subscribe_user',$subcData);
      if($inserted){

      echo "<h5>Your email address has been successfully added to this trail.You will now receive updates on the latest news.
        </h5>";
    
      $row1 =  $this->model->get_row('email_templates',array('title'=>'UserSubcription'));
      $subject = $row1->subject;
      $message = $row1->content;
      $userName = $userDetail->fname;
      $message = str_replace("{username}",ucfirst($userName),$message);
      $message = str_replace("{user_email_address}",$userDetail->email,$message);
      $message = str_replace("{trail_name}",ucfirst($subcData['trail_name']),$message);
      $this->sendingMail($userDetail->email,$subject, $message);
      }
  }
}

function updateSubc(){

      $userID = $this->input->post('userID');
      $subEmail = $this->input->post('subEmail');
      $userDetail = $this->model->get_row('tbl_user_master', array('user_id' =>$userID));
      $subcData['subc_user_email'] = $subEmail;
      $subcData['subc_user_id'] = $userID;
      $where = array('subc_user_id' => $userID);
      $update = $this->model->update('tbl_subscribe_user',$subcData,$where);
      if($update){
        echo '<h5>Your email address has been successfully update.You will now receive updates on the latest news.</h5>';

     } 
  } 

function unsubscribe(){

      $trail_name = $this->input->post('trail_name');
      $where = array('trail_name' => $trail_name);
      $delete = $this->db->delete('tbl_subscribe_user', $where);   
       if($delete){
        echo '<h5>Your email address has been successfully unsubscribe for this trail.</h5>';
     } 
  } 
function updateTrailReport(){

   $report['userID'] = $this->input->post('userID');
   $report['CountyID'] = $this->input->post('updateTrailCountryID');
   $report['state_name'] = $this->input->post('state_name_trail_report');
   $report['trail_report_conditions'] = $this->input->post('updateTrailReportTxtar');
   $where = array('userID'=>$report['userID'],'state_name'=>$report['state_name'],'CountyID'=>$report['CountyID'], 'trail_report_status'=>0); 
   $updatePading = $this->model->get_row('trail_report_user_update',$where);   
    if(isset($updatePading->CountyID) && !empty($updatePading->CountyID) && isset($updatePading->state_name) && !empty($updatePading->state_name)){
      $where = array('userID'=>$report['userID'],'CountyID'=> $report['CountyID'], 'state_name'=>$report['state_name'], 'trail_report_status'=>0);    
      $update = $this->model->update('trail_report_user_update',$report,$where);
      if($update){
        $query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=5");
        $subAdminEmail = $query->result();
        if(isset( $subAdminEmail)){
            foreach ($subAdminEmail as $semail) {
            $row1 =  $this->model->get_row('email_templates',array('title'=>'TrailReportPendingApproval'));
            $subject = $row1->subject;
            $message = $row1->content;
            $message = str_replace("{username}",ucfirst($semail->fname),$message);
            $message = str_replace("{user_email_address}",$semail->email,$message);
            $message = str_replace("{trail_type}","Trail Report",$message);
            $message = str_replace("{trail_name}",$report['CountyID'],$message);
            $message = str_replace("{trail_report_details}",$report['trail_report_conditions'],$message);
            $this->sendingMail($semail->email ,$subject, $message);
            }
        }
        $query = $this->db->query("SELECT fname,email,user_id from tbl_user_master WHERE siterole_id =1 AND user_id=1");
        $adminEmail = $query->row();
        $row1 =  $this->model->get_row('email_templates',array('title'=>'TrailReportPendingApproval'));
        $subject = $row1->subject;
        $message = $row1->content;
        $message = str_replace("{username}",ucfirst($semail->fname),$message);
        $message = str_replace("{user_email_address}",$semail->email,$message);
        $message = str_replace("{trail_type}","Trail Report",$message);
        $message = str_replace("{trail_name}",$report['CountyID'],$message);
        $message = str_replace("{trail_report_details}",$report['trail_report_conditions'],$message);
        $this->sendingMail($semail->email ,$subject, $message);
  
        echo 2;
      }
    }else{
    $inserted = $this->model->insert_data('trail_report_user_update',$report);
    if($inserted){
        $query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=5");
        $subAdminEmail = $query->result();
        if(isset( $subAdminEmail)){
            foreach ($subAdminEmail as $semail) {
            $row1 =  $this->model->get_row('email_templates',array('title'=>'TrailReportPendingApproval'));
            $subject = $row1->subject;
            $message = $row1->content;
            $message = str_replace("{username}",ucfirst($semail->fname),$message);
            $message = str_replace("{user_email_address}",$semail->email,$message);
            $message = str_replace("{trail_type}","Trail Report",$message);
            $message = str_replace("{trail_name}",$report['CountyID'],$message);
            $message = str_replace("{trail_report_details}",$report['trail_report_conditions'],$message);
            $this->sendingMail($semail->email ,$subject, $message);
            }
        }
        $query = $this->db->query("SELECT fname,email,user_id from tbl_user_master WHERE siterole_id =1 AND user_id=1");
        $adminEmail = $query->row();
        $row1 =  $this->model->get_row('email_templates',array('title'=>'TrailReportPendingApproval'));
        $subject = $row1->subject;
        $message = $row1->content;
        $message = str_replace("{username}",ucfirst($semail->fname),$message);
        $message = str_replace("{user_email_address}",$semail->email,$message);
        $message = str_replace("{trail_type}","Trail Report",$message);
        $message = str_replace("{trail_name}",$report['CountyID'],$message);
        $message = str_replace("{trail_report_details}",$report['trail_report_conditions'],$message);
        $this->sendingMail($semail->email ,$subject, $message);
         echo 1;
      }
    }
}
function showUpdatePendingTrailReport(){
  $update['userID'] = $this->input->post('userID');
  $update['CountyID'] = $this->input->post('CountyName');
  $update['state_name'] = $this->input->post('state_name'); 
  $where = array('userID'=>$update['userID'],'CountyID'=>$update['CountyID'],'state_name'=>$update['state_name'],'trail_report_status'=>0); 
    $updatePading = $this->model->get_row('trail_report_user_update',$where);
  if($updatePading){
    if(isset($updatePading) && !empty($updatePading)){
      $countyname = json_encode($updatePading);
        print_r($countyname);
    }
  }
}

public function GetCountryName(){
      $keyword=$this->input->post('keyword');
      //$data=$this->model->GetRow($keyword);   
       $query = $this->db->query("SELECT `county_name` FROM `county_trail_report` WHERE `county_name` LIKE '%".$keyword."%'  GROUP BY `county_name`  ORDER BY `id` ASC limit 0,5");  
       $data = $query->result_array();
       echo json_encode($data);
  }
function lodging_poi(){
  $statename = $this->input->post('statename');
  $query = $this->db->query("SELECT *, (SELECT AVG(rating) FROM tbl_review WHERE  bus_ID = tbl_vacation_list.vac_id and status=1) as `totalrating` FROM `tbl_vacation_list` where vac_status=1 and vac_expiry_date >= CURDATE() and tbl_vacation_list.state_name='".$statename."'");

  $result = $query->result();

 $data_marker ='';
 foreach ($result as $marker) {
  

 if($marker->trail_id == 'Lodging' || $marker->trail_id == 'lodging'){
      $markerMap= 'assets/images/map_icon/Lodging.png';
  }else{
      $markerMap= 'assets/images/location.png';
   }
   $data_marker[] = array("vac_slag"=>$marker->vac_slag,"kml_data_name"=>$marker->vac_name, "kml_data_lat"=>$marker->vac_lat,  "kml_data_lang"=>$marker->vac_lang, "markerImage"=>$markerMap, "vacID"=>$marker->vac_id,"vac_address"=>$marker->vac_address,"vac_id"=>$marker->vac_id,"totalrating"=>$marker->totalrating,"vac_sleep"=>$marker->vac_sleep,"vac_no_of_bedroom"=>$marker->vac_no_of_bedroom,"vac_bathroom"=>$marker->vac_bathroom,);
 }

 $poiObject = json_encode(array('markers_detail1'=>$data_marker));
 print_r($poiObject);

}  
//for getting kml data using trail id
function getKmlByPoi(){
 
   $trail_id = $this->input->post('trail_ID');
   $seseionvalue = $this->input->post('seseionvalue');
   $statename = $this->input->post('statename');
  $strIds = '';
  if($seseionvalue == 'main'){
     if(isset($trail_id)){
       $strIds=implode("','", $trail_id);
     }
 $sql = "SELECT tbl_kml_data.*,tbl_trail_type_master.* FROM tbl_kml_data  join tbl_trail_type_master on
tbl_trail_type_master.trail_name=tbl_kml_data.poi_type

  where tbl_trail_type_master.trail_status =1 and tbl_kml_data.region_name='".$statename."' and tbl_kml_data.poi_type in ('".$strIds."') GROUP BY kml_data_id";
  }
  if($seseionvalue == 'sessionData'){
  $strIds=implode("','", $trail_id);
 $sql = "SELECT tbl_kml_data.*,tbl_trail_type_master.* FROM tbl_kml_data join tbl_trail_type_master on
tbl_trail_type_master.trail_name=tbl_kml_data.poi_type where tbl_trail_type_master.trail_status =1 and tbl_kml_data.region_name='".$statename."' and tbl_kml_data.poi_type in ('".$strIds."') GROUP BY kml_data_id";
  }
$query = $this->db->query($sql);
//echo $this->db->last_query();
 $result = $query->result();

 $lat = '';
 $lang = '';


 $data_marker ='';
 $tmp ='';
 foreach ($result as $marker) {
  $tmp = explode(',', $marker->lat_lang);
  $lat =  $tmp[1];
  $lang =  $tmp[0];

/* if($marker->poi_type == 'Lodging'){
      $markerMap= 'assets/images/map_icon/Lodging.png';
    }
    else if($marker->poi_type == 'Snowmobile Clubs'){
      $markerMap= 'assets/images/map_icon/snowmobile.png';
    }
    else if($marker->poi_type == 'Fuel'){
      $markerMap= 'assets/images/map_icon/Gas.png';
    }
    else if($marker->poi_type == 'Parking'){
      $markerMap= 'assets/images/map_icon/parking(Y).png';
    }else if($marker->poi_type == 'Restaurants'){
      $markerMap= 'assets/images/map_icon/Restaurant.png';
    }else{
      $markerMap= 'assets/images/location.png';
   }*/
    if(isset($marker->trail_marker) && !empty($marker->trail_marker)){
      $markerMap= $marker->trail_marker;
  }else{
      $markerMap= 'assets/images/location.png';
   }
   $data_marker[] = array("kml_data_name"=>$marker->kml_data_name, "kml_data_lat"=>$lat,  "kml_data_lang"=>$lang, "markerImage"=>$markerMap);
 }

 $poiObject = json_encode(array('markers_detail'=>$data_marker));
 print_r($poiObject);

 }
  function poiLodgingImage(){
 
    $vacID = $this->input->post('vacID');
    $query = $this->db->query("SELECT * FROM tbl_vacation_list_images where vac_id = ".$vacID." GROUP by vac_id"); 
    $result = $query->result_array();
    $data_image ='';
    foreach ($result as $img) {
     // print_r($img);
       if(isset($img['vac_imag']) && !empty($img['vac_imag'])){
        $data_image.=base_url().$img['vac_imag'];
      }else{
        $data_image.=base_url().'assets/images/no-image.jpg';
      }
    }
     $poiObject = json_encode($data_image);
     print_r($poiObject);

 
 }
  public function saverouteplanning(){
  
   $myrouteName = $_POST['my_route_name'];
   $routeName = implode(",",$_POST['route']['routeName']);
   $rtN = explode(',',$routeName);
   //echo $rtN[0];

   $routeDistance = implode(",",$_POST['route']['routeDistance']);
   $res = explode(',',$routeDistance);
   $tresult = array_sum($res);

   $statename = $_POST['statenameroute'];
   $URP_ID = $_POST['URP_ID'];
   $userID = $_POST['user_id'];
   $userDetail=$this->model->get_data('*','tbl_user_master',array('user_id'=>$userID));
   if(!empty($URP_ID)){
    $updateRoute['route_name']=implode(",",$_POST['route']['routeName']);
    $updateRoute['route_dist']=implode(",",$_POST['route']['routeDistance']);
    $ures = explode(',',$updateRoute['route_dist']);
    $u_result = array_sum($ures);
    $updateRoute['my_route_name']=$_POST['my_route_name'];
    $where = array('URP_ID' => $URP_ID);
    $update = $this->model->update('tbl_user_route_planning',$updateRoute,$where);
    $row1 =  $this->model->get_row('email_templates',array('title'=>'SaveRoutePlan'));
    $subject = $row1->subject;
    $message = $row1->content;
    $userName = $userDetail[0]->fname;
    $message = str_replace("{username}",ucfirst($userName),$message);
    $message = str_replace("{user_email_address}",$userDetail[0]->email,$message);
    $message = str_replace("{my_route_plan_name}",ucfirst($updateRoute['my_route_name']),$message);
    $message = str_replace("{route_plan_name}",ucfirst($updateRoute['route_name']),$message);
    $message = str_replace("{route_distance}",$updateRoute['route_dist'],$message);
    $message = str_replace("{total_distance}",$u_result.' Miles',$message);
    $message = str_replace("{save_update}",'update',$message);
    $message = str_replace("{saved_updated}",'Updated',$message);   
    $this->sendingMail($userDetail[0]->email,$subject, $message);
    
    $sharDetails=$this->model->join_where('*', 'tbl_share_my_trails','tbl_user_master','u_id','user_id',array('t_id'=>$URP_ID),'s_t_id','desc');
    //print_r($sharDetails);
    if(isset($sharDetails)){
      foreach ($sharDetails as $sdetail) {
        $shareRoute['view_status']=0;
        $update = $this->model->update('tbl_share_my_trails',$shareRoute, array('t_id'=>$URP_ID));
        $row1 =  $this->model->get_row('email_templates',array('title'=>'SaveRoutePlan'));
        $subject = $row1->subject;
        $message = $row1->content;
        $userName = $sdetail->fname;
        $message = str_replace("{username}",ucfirst($userName),$message);
        $message = str_replace("{user_email_address}",$sdetail->email,$message);
        $message = str_replace("{my_route_plan_name}",ucfirst($updateRoute['my_route_name']),$message);
        $message = str_replace("{route_plan_name}",ucfirst($updateRoute['route_name']),$message);
        $message = str_replace("{route_distance}",$updateRoute['route_dist'],$message);
        $message = str_replace("{total_distance}",$u_result.' Miles',$message);
        $message = str_replace("{save_update}",'update',$message);
        $message = str_replace("{saved_updated}",'Updated',$message);   
        $this->sendingMail($sdetail->email,$subject, $message);
        
      }
    }
    echo 1;
   }else{
     // for($i=0 ;$i < count($_POST['route']['routeName']); $i++) {
      $query = $this->db->query('INSERT INTO tbl_user_route_planning (route_name, route_dist,user_id, my_route_name,state_name) VALUES ("' . $routeName . '","' . $routeDistance . '","' . $userID. '","' .$myrouteName . '","' .$statename . '")');  
      $insert_id = $this->db->insert_id();


      $route_result = $this->model->get_row('tbl_kml_data_trail',array('klm_trail_name'=>$rtN[0]));
      $arr_lat_lang = explode(",",$route_result->lat_lang);
     // echo $arr_lat_lang[0].' '.$arr_lat_lang[1];
      $this->model->update('tbl_user_route_planning',array('route_lat'=>preg_replace('/\s+/', '', $arr_lat_lang[1]),'route_lang'=>preg_replace('/\s+/', '', $arr_lat_lang[0])), array('URP_ID'=>$insert_id));

      $row1 =  $this->model->get_row('email_templates',array('title'=>'SaveRoutePlan'));
      $subject = $row1->subject;
      $message = $row1->content;
      $userName = $userDetail[0]->fname;
      $message = str_replace("{username}",ucfirst($userName),$message);
      $message = str_replace("{user_email_address}",$userDetail[0]->email,$message);
      $message = str_replace("{my_route_plan_name}",ucfirst($myrouteName),$message);
      $message = str_replace("{route_plan_name}",ucfirst($routeName),$message);
      $message = str_replace("{route_distance}",$routeDistance,$message);
      $message = str_replace("{total_distance}",$tresult.' Miles',$message);
      $message = str_replace("{save_update}",'save',$message);
      $message = str_replace("{saved_updated}",'Saved',$message);
      $this->sendingMail($userDetail[0]->email,$subject, $message);
      echo 1;

  }
}
public function updatetrailsts(){
 
   $user_id = $_POST['user_id'];
   $trail_name = $_POST['trail_name'];
   $trail_disc = $_POST['trail_disc'];
   $update_status = $_POST['update_status'];

   if($update_status == 0){
    $status_name = 'Open';
   }else if($update_status == 1){
    $status_name = 'Closed';
  }else if($update_status == 2){
    $status_name = 'Caution';
   }
   
   $trail_description = $_POST['trail_description'];
   $insert = $this->db->query('INSERT INTO tbl_trail_report (trail_description, trail_disc, trail_name, user_id,trail_status) VALUES ("' . $trail_description . '","' . $trail_disc . '","' . $trail_name. '","' .$user_id . '","' .$update_status . '")');
   if($insert){

      $query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=4");
      $subAdminEmail = $query->result();
      if(isset( $subAdminEmail)){
          foreach ($subAdminEmail as $semail) {
          $row1 =  $this->model->get_row('email_templates',array('title'=>'TrailUpdatePendingApproval'));
          $subject = $row1->subject;
          $message = $row1->content;
          $message = str_replace("{username}",ucfirst($semail->fname),$message);
          $message = str_replace("{user_email_address}",$semail->email,$message);
          $message = str_replace("{trail_type}","Trail",$message);
          $message = str_replace("{trail_name}",$trail_name,$message);
          $message = str_replace("{trail_distance}",$trail_disc.' Miles',$message);
          $message = str_replace("{update_status}",$status_name,$message);
          $message = str_replace("{trail_update_details}",$trail_description,$message);
          $this->sendingMail($semail->email ,$subject, $message);
          }
      }
      $query = $this->db->query("SELECT fname,email,user_id from tbl_user_master WHERE siterole_id =1 AND user_id=1");
      $adminEmail = $query->row();
      $row1 =  $this->model->get_row('email_templates',array('title'=>'TrailUpdatePendingApproval'));
      $subject = $row1->subject;
      $message = $row1->content;
      $message = str_replace("{username}",ucfirst($adminEmail->fname),$message);
      $message = str_replace("{user_email_address}",$adminEmail->email,$message);
      $message = str_replace("{trail_type}","Trail",$message);
      $message = str_replace("{trail_name}",$trail_name,$message);
      $message = str_replace("{trail_distance}",$trail_disc.' Miles',$message);
      $message = str_replace("{update_status}",$status_name,$message);
      $message = str_replace("{trail_update_details}",$trail_description,$message);
      $this->sendingMail($adminEmail->email ,$subject, $message);
       echo 1;
   }
    
}
function county_name_drop(){
    $countyName = $this->input->post('countyName');
    $where = array(1 =>1, 'county_name'=>$countyName); 
    $trailObject= $this->model->get_data('*', 'county_trail_report',$where);
    
    $trail = json_encode($trailObject);
    print_r($trail);
}
function AllCountyTrail(){
    $statename = $this->input->post('region_name');
    $where = array('status'=>1,'region_name'=> $statename); 
    $trailObject= $this->model->get_data('*', 'county_trail_report',$where);
    $trail = json_encode($trailObject);
    print_r($trail);
}
function region_name_drop(){
    $region_name = $this->input->post('region_name');
    $where = array('tbl_kml_data_trail.region_name'=>$region_name, 'tbl_kml_data_trail.upload_by_id'=>1, 'tbl_kml_data_trail.status'=>1);  
    $trailObject= $this->model->get_data_rl_join('tbl_kml_data_trail.*,tbl_trail_report.`trail_report_id`,tbl_trail_report.`user_id`,tbl_trail_report.`trail_name`,tbl_trail_report.`trail_disc`,tbl_trail_report.`trail_description`,tbl_trail_report.`trail_lat_lang`,tbl_trail_report.`trail_status`,tbl_trail_report.`status` as new_status,tbl_trail_report.`created_date`,tbl_trail_report.`update_date`', 'tbl_trail_report','tbl_kml_data_trail','trail_name','klm_trail_name',$where,'tbl_kml_data_trail.id','desc','right');

    $trail = json_encode($trailObject);
    print_r($trail);
}
function mymap(){
    $trailDet = $this->input->post('trailDet');
    $userID = $this->input->post('upload_by_id');
    $where = array('tbl_kml_data_trail.upload_by_id'=>$userID,'tbl_kml_data_trail.trail_id'=>$trailDet);  
    $trailObject= $this->model->get_data_rl_join('tbl_kml_data_trail.*,tbl_trail_report.*', 'tbl_trail_report','tbl_kml_data_trail','trail_name','klm_trail_name',$where,'tbl_kml_data_trail.id','desc','right');
    $trail = json_encode($trailObject);
    print_r($trail);
}
function shareDatatrail(){
    $region_name = $this->input->post('region_name');
    $userID = base64_decode($this->input->post('id'));
    $trail = str_replace("%27","'",$this->input->post('trail1'));
    $where = array('tbl_kml_data_trail.upload_by_id'=>$userID,'tbl_kml_data_trail.klm_trail_name'=>$trail); 
    $trailObject= $this->model->get_data_rl_join('tbl_kml_data_trail.*,tbl_trail_report.*', 'tbl_trail_report','tbl_kml_data_trail','trail_name','klm_trail_name',$where,'tbl_kml_data_trail.id','desc','right');
    //echo $this->db->last_query();
    $trail = json_encode($trailObject);
    print_r($trail);
}


function routePlanningData(){
   $region_name = $this->input->post('region_name');
    $id = $this->input->post('id');
    $trail_name = $this->model->get_row('tbl_user_route_planning', array('URP_ID' =>base64_decode($id)));
     if(isset($trail_name) && !empty($trail_name)){
    //$query = $this->db->query('SELECT `tbl_kml_data_trail`.*, `tbl_trail_report`.* FROM `tbl_trail_report` RIGHT JOIN `tbl_kml_data_trail` ON `tbl_trail_report`.`trail_name`=`tbl_kml_data_trail`.`klm_trail_name` WHERE `region_name` = "'.$region_name.'" and upload_by_id=1 ORDER BY `tbl_kml_data_trail`.`id` DESC');
    //$trailObject = $query->result();
      $where = array('tbl_kml_data_trail.region_name'=>$region_name, 'tbl_kml_data_trail.upload_by_id'=>1);  
    $trailObject= $this->model->get_data_rl_join('tbl_kml_data_trail.*,tbl_trail_report.`trail_report_id`,tbl_trail_report.`user_id`,tbl_trail_report.`trail_name`,tbl_trail_report.`trail_disc`,tbl_trail_report.`trail_description`,tbl_trail_report.`trail_lat_lang`,tbl_trail_report.`trail_status`,tbl_trail_report.`status` as new_status,tbl_trail_report.`created_date`,tbl_trail_report.`update_date`', 'tbl_trail_report','tbl_kml_data_trail','trail_name','klm_trail_name',$where,'tbl_kml_data_trail.id','desc','right');
     $trail = json_encode($trailObject);
    print_r($trail);
    }else{
       echo 1;
    }
}
function mysaveroute(){
   $info= $this->session->all_userdata();

   $user_id =  $info['user_id'];
  
   $region_name = $this->input->post('region_name');
   $id = base64_decode($this->input->post('id'));
    $query = $this->db->query('SELECT * FROM `tbl_kml_data_trail` WHERE `region_name` = "'.$region_name.'" and `trail_id` = "'.$id.'" and upload_by_id ='.$user_id.'');
    $trailObject = $query->result();

     $query1 = $this->db->query('SELECT `tbl_kml_data_trail`.*, `tbl_trail_report`.*
FROM `tbl_trail_report`
RIGHT JOIN `tbl_kml_data_trail` ON `tbl_trail_report`.`trail_name`=`tbl_kml_data_trail`.`klm_trail_name`
WHERE `region_name` = "'.$region_name.'" and upload_by_id =1');
    $trailObject1 = $query1->result();

    $trail = json_encode(array_merge($trailObject,$trailObject1));
    print_r($trail);
}

public function vacationrentals() 
 {
       
  $data['pagetitle'] = 'Vacational Rentals Search';
  $data['segment']= $this->uri->segment(1);
  $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1));
  if(isset($this->userId)){
     $data['user_id'] = $this->userId;
  }
  $data["advanceFilter"] = $this->model->get_lodging();
  $strQuery1 = "SELECT *, (SELECT AVG(rating) FROM tbl_review WHERE  bus_ID = tbl_vacation_list.vac_id) as `totalrating` FROM  `tbl_vacation_list` WHERE 1 = 1 and vac_status =1 and vac_expiry_date >= CURDATE()";

  if(isset($_POST['businessSearch'])){
      if($_POST['businessSearch'] != ''){
      $strQuery1 = $strQuery1.' AND  (vac_address LIKE "%'.$_POST['businessSearch'].'%" OR vac_city LIKE "%'.$_POST['businessSearch'].'%")';
    }
   }if($_POST['hotel-min-price'] != '' ){
      $strQuery1 = $strQuery1.' AND  vac_price >= '.$_POST['hotel-min-price'].' ';
    }
  if(isset($_POST['hotel-max-price'])){
      if($_POST['hotel-max-price'] != ''){
      $strQuery1 = $strQuery1.' AND  vac_price <= '.$_POST['hotel-max-price'].'';
    }
  }if(isset($_POST['hotel-max-price'])){
      if($_POST['hotel-max-price'] != ''){
      $strQuery1 = $strQuery1.' AND  vac_price <= '.$_POST['hotel-max-price'].'';
    }
  }if(isset($_POST['bedrooms_min'])){
      if($_POST['bedrooms_min'] != ''){
      $strQuery1 = $strQuery1.' AND  vac_no_of_bedroom >= '.$_POST['bedrooms_min'].' ';
     }
  }

   if(isset($_POST['bedrooms_max'])){
      if($_POST['bedrooms_max'] != ''){
      $strQuery1 = $strQuery1.'  AND vac_no_of_bedroom <= '.$_POST['bedrooms_max'].'';
     }
   }
   if(isset($_POST['advfilterpro'])){
      if($_POST['advfilterpro'] != ''){
        $advfilterpro = implode(",", $_POST['advfilterpro']);
        $strQuery1 = $strQuery1.'  AND adv_filter_fields in ('.$advfilterpro.')';
     }
   }
   if(isset($_POST['vac_type'])){
      if($_POST['vac_type'] != ''){

        $vac_type = implode(",", $_POST['vac_type']);
        $strQuery1 = $strQuery1.'  AND FIND_IN_SET(vac_type, "'.$vac_type.'")';
     }
   }

   if(isset($_POST['vac_location_type'])){
      if($_POST['vac_location_type'] != ''){
        $vac_location_type = implode(",", $_POST['vac_location_type']);
        $strQuery1 = $strQuery1.'  AND FIND_IN_SET(vac_location_type, "'.$vac_location_type.'")';
     }
   }
         
  $query = $this->db->query($strQuery1.' ORDER BY rand()');
  $data['businessList'] = $query->result();
  $this->load->view('frontend/vacation/vac_list_main', $data);
} 

public function forumSearch() 
 {
       
  
  $data['segment']= $this->uri->segment(1);
  $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1));
  if(isset($this->userId)){
     $data['user_id'] = $this->userId;
  }
  
  if(isset($_POST['searchKey'])){
      if($_POST['searchKey'] != ''){
      $where=array('forum_cat_status'=>'Aproved');     
      $data['categories']=$this->Common_model1->get_all_where_search_category('forum_category',$where,$_POST['searchKey']); 
      
    }
   }

 

   $this->load->view('forum_category_list', $data);
}
public function review(){
  
  $review['user_ID'] =$this->input->post('user_ID'); 
  $review['bus_ID'] =$this->input->post('bus_ID');
  $review['rating'] =$this->input->post('rating');
  $review['review_title'] =$this->input->post('review_title'); 
  $review['comment'] = $this->input->post('comment');   
  
    $insert =  $this->model->insert_data('tbl_review',$review);
    if($insert){
      echo 1;
    }
  }
  public function requestbooking(){
  
    $reqbooking['user_id'] =$this->input->post('user_ID'); 
    $reqbooking['rental_id'] =$this->input->post('bus_ID');
    $req_user =$this->input->post('req_user');
    $req_email =$this->input->post('req_email');
    $req_phone =$this->input->post('req_phone');
    $reqbooking['req_description'] =$this->input->post('request_description'); 
    $insert =  $this->model->insert_data('rental_request_booking',$reqbooking);
    if($insert){
       
       $fromUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $reqbooking['user_id']));
       $MySessEmailId = $fromUserEmail->email;
       $MySessUsername = $fromUserEmail->fname;
   
       $row1 =  $this->model->get_row('email_templates',array('title'=>'FromBookingRequest'));
       $MySessSubject = $row1->subject;
       $MySessMessage= $row1->content;
       $MySessMessage= str_replace("{username}",ucfirst($MySessUsername),$MySessMessage);
       $MySessMessage= str_replace("{user_email_address}",$MySessEmailId,$MySessMessage);

      // $this->sendingMail("votive.reena@gmail.com" ,$MySessSubject, $MySessMessage);
       $this->sendingMail($MySessEmailId ,$MySessSubject, $MySessMessage);
      
       $where = array('vac_id' => $reqbooking['rental_id'] );
       $ToUserEmail= $this->model->join_where('tbl_vacation_list.*, tbl_user_master.*','tbl_vacation_list' ,'tbl_user_master','user_id','user_id',$where,'vac_id','DESC');
      
       $row =  $this->model->get_row('email_templates',array('title'=>'ToBookingRequest'));
       $ToSubject = $row->subject;
       $ToMessage= $row->content;
      
       $hotelEmailId = $ToUserEmail[0]->vac_email;
       $rentalEmailId = $ToUserEmail[0]->user_id;
       $rentalEmail1 = $this->model->get_row('tbl_user_master', array('user_id' =>  $rentalEmailId));
       $rentalEmail = $rentalEmail1->email;
       $rentalfname = $rentalEmail1->fname;
       $ToMessage= str_replace("{username}",ucfirst($req_user),$ToMessage);
       $ToMessage= str_replace("{requester_email_address}",$req_email,$ToMessage);
       $ToMessage= str_replace("{requester_phone}",$req_phone,$ToMessage);
       $ToMessage= str_replace("{requester_message}",$reqbooking['req_description'],$ToMessage);
       $ToMessage= str_replace("{user_email_address}", $rentalEmail,$ToMessage);
       $ToMessage= str_replace("{seller}", $rentalfname,$ToMessage);
      
       //$this->sendingMail("votive.reena@gmail.com" ,$ToSubject, $ToMessage);
       $this->sendingMail($rentalEmail ,$ToSubject, $ToMessage);

      // $this->requestsendingMail($MySessEmailId, $rentalEmail, $ToSubject, $ToMessage);
     //  $this->requestsendingMail($MySessEmailId, $hotelEmailId, $ToSubject, $ToMessage);     
       echo 1;
    }
  }

    public function contactseller(){
  
    $reqbooking['user_id'] =$this->input->post('user_ID'); 
    $reqbooking['cl_id'] =$this->input->post('bus_ID');
    $req_user =$this->input->post('req_user');
    $req_email =$this->input->post('req_email');
    $req_phone =$this->input->post('req_phone');
    $reqbooking['cl_description'] =$this->input->post('request_description'); 
    $insert =  $this->model->insert_data('classified_contact_seller',$reqbooking);
    if($insert){
       $where = array('classified_id' => $reqbooking['cl_id'] );
       $ToUserEmail= $this->model->join_where('tbl_classified_list.*, tbl_user_master.*','tbl_classified_list' ,'tbl_user_master','user_id','user_id',$where,'classified_id','DESC');
       $page_link = base_url().'classified/details/'.$ToUserEmail[0]->url_slag;
       $fromUserEmail = $this->model->get_row('tbl_user_master', array('user_id' => $reqbooking['user_id']));
       $MySessEmailId = $fromUserEmail->email;
       $MySessUsername = $fromUserEmail->fname;
       $row1 =  $this->model->get_row('email_templates',array('title'=>'FromClassified'));
       $MySessSubject = $row1->subject;
       $MySessMessage= $row1->content;
       $MySessMessage= str_replace("{username}",ucfirst($MySessUsername),$MySessMessage);
       $MySessMessage= str_replace("{classified_name}",ucfirst($ToUserEmail[0]->classified_created_by),$MySessMessage);
      /* $MySessMessage= str_replace("{requester_message}",$reqbooking['cl_description'],$MySessMessage);*/
       $MySessMessage= str_replace("{page_link}",$page_link,$MySessMessage);
       $MySessMessage= str_replace("{user_email_address}",$MySessEmailId,$MySessMessage);
       
       $this->sendingMail($MySessEmailId ,$MySessSubject, $MySessMessage);
       //$this->sendingMail('votive.reena@gmail.com' ,$MySessSubject, $MySessMessage);

       $where = array('classified_id' => $reqbooking['cl_id'] );
     
    
       $row =  $this->model->get_row('email_templates',array('title'=>'ToClassified'));
       $ToSubject = $row->subject;
       $ToMessage= $row->content;
       $rentalEmailId = $ToUserEmail[0]->user_id;
       $rentalEmail1 = $this->model->get_row('tbl_user_master', array('user_id' =>  $rentalEmailId));
       $rentalEmail = $rentalEmail1->email;
       $rentalName = $rentalEmail1->fname;
       $ToMessage= str_replace("{seller}",ucfirst($rentalName),$ToMessage);
       $ToMessage= str_replace("{username}",ucfirst($req_user),$ToMessage);
       $ToMessage= str_replace("{requester_email_address}",$req_email,$ToMessage);
       $ToMessage= str_replace("{requester_phone}",$req_phone,$ToMessage);
       $ToMessage= str_replace("{classified_name}",ucfirst($ToUserEmail[0]->classified_created_by),$ToMessage);
      /* $MySessMessage= str_replace("{requester_message}",$reqbooking['cl_description'],$MySessMessage);*/
       $ToMessage= str_replace("{page_link}",$page_link,$ToMessage);
       $ToMessage= str_replace("{requester_message}",$reqbooking['cl_description'],$ToMessage);
       $ToMessage= str_replace("{user_email_address}",$rentalEmail,$ToMessage);
       
       $this->sendingMail($rentalEmail ,$ToSubject, $ToMessage);
       //$this->sendingMail('votive.reena@gmail.com' ,$ToSubject, $ToMessage);
       echo 1;
    }
  }

 function purchaseSelect(){

  $plan['pl_id'] =$this->input->post('pl_id'); 
  $bus_ID =$this->input->post('bus_id');
 
  $where = array('vac_id' => $bus_ID);
  $update = $this->model->update('tbl_vacation_list',$plan,$where);

    if($update){
    echo 1;
    }
  }
 function sharePrivateTrail(){
   $saveroute= $this->input->post('saveroute');
   $trail_id= $this->input->post('u_id');
  
   if($saveroute == 'saveroute'){
    foreach ($trail_id as $user_id) {
     
     $routeid= $this->input->post('routeid');
     $add['t_id'] = $routeid;
     $add['t_name'] = $this->input->post('trail_name');
     $add['shared_u_id'] = $this->input->post('shared_u_id');
     $add['region_name'] = $this->input->post('trail_region_name');
     $add['saveroute'] = $this->input->post('saveroute');
     $add['url'] =base_url().'home?id='.base64_encode($routeid).'&'.'state_name='.$add['region_name'].'&'.'saveroute=mysaveroute';
     $add['u_id']  = $user_id;
     $Insert = $this->model->insert_data('tbl_share_my_trails',$add);

     if($Insert){ 
        $share = $this->model->get_data('*','tbl_user_master', array('user_id' =>$user_id));
        $row1 =  $this->model->get_row('email_templates',array('title'=>'MyRoutePlan'));
        $subject = $row1->subject;
        $message = $row1->content;

        $userName = $share[0]->fname;
        $message = str_replace("{username}",ucfirst($userName),$message);
        $message = str_replace("{link}",$add['url'],$message);
        $message = str_replace("{user_email_address}",$share[0]->email,$message);
        $this->sendingMail($share[0]->email ,$subject, $message);
        /*$subject = 'Trail';
        $message = 'Please click on link and show trail on the map <br />'.$add['url'];
        $this->sendingMail($share[0]->email, $subject, $message);*/
          
      }
  }


   }else{
      foreach ($trail_id as $user_id) {
        $add['t_id'] = $this->input->post('trail_id');
       $add['t_name'] = $this->input->post('trail_name');
       $add['shared_u_id'] = $this->input->post('shared_u_id');
       $add['region_name'] = $this->input->post('trail_region_name');
       $add['saveroute'] = $this->input->post('saveroute');
       $add['url'] =base_url().'home?uid='.base64_encode($add['shared_u_id']).'&'.'state_name='.$add['region_name'].'&trail='.str_replace(' ', '-', str_replace("'","",$add['t_name']));
       $add['u_id']  = $user_id;
       $Insert = $this->model->insert_data('tbl_share_my_trails',$add);

       if($Insert){ 
          $share = $this->model->get_data('*','tbl_user_master', array('user_id' =>$user_id));
          $row1 =  $this->model->get_row('email_templates',array('title'=>'MyRoutePlan'));
          $subject = $row1->subject;
          $message = $row1->content;

          $userName = $share[0]->fname;
          $message = str_replace("{username}",ucfirst($userName),$message);
          $message = str_replace("{link}",$add['url'],$message);
          $message = str_replace("{user_email_address}",$share[0]->email,$message);
          $this->sendingMail($share[0]->email ,$subject, $message);

           /* $subject = 'Trail';
            $message = 'Please click on link and show trail on the map <br />'.$add['url'];
            $this->sendingMail($share[0]->email, $subject, $message);*/
            
        }
    }

   }
   
  echo 1;
}
public function removeShareFriend(){

  $u_id = $this->input->post('u_id');
  $ses_u_id = $this->input->post('ses_u_id');
  $saveroute = $this->input->post('saveroute');
  $t_name = $this->input->post('t_name');
  $data=array('status'=>1);
  $where=array('u_id'=> $u_id, 'shared_u_id'=>$ses_u_id, 'saveroute'=>$saveroute,'t_name'=>$t_name);
  $this->model->update('tbl_share_my_trails', $data,$where); 
  echo $i = $this->db->affected_rows();
}
public function shareFriendListPrivateTrail(){
  $t_name = $this->input->post('t_name');
  $ses_u_id = $this->input->post('ses_u_id');
  $select ='tbl_user_master.fname,tbl_user_master.email,tbl_user_master.address,tbl_user_master.profile_picture, tbl_user_master.user_id, tbl_share_my_trails.shared_u_id,tbl_share_my_trails.t_id,tbl_share_my_trails.s_t_id,tbl_share_my_trails.status ,tbl_share_my_trails.t_name,tbl_share_my_trails.saveroute,tbl_share_my_trails.u_id';
  $where = array('shared_u_id' =>$ses_u_id,'t_name' =>$t_name, 'saveroute'=>'privatetrail','tbl_share_my_trails.status' =>0);
  $userList = $this->model->get_data_rl_join_groupby($select, 'tbl_share_my_trails','tbl_user_master','u_id','user_id', $where,'user_id', 's_t_id', 'desc','left');
  //print_r($userList);
  $i=1;
  foreach ($userList as $users) {

       $img='';
      if(isset($users->profile_picture) && !empty($users->profile_picture)){
        if(strpos($users->profile_picture, "http://") !== false OR strpos($users->profile_picture, "https://") !== false){
           $img = $users->profile_picture;
        }else
        {
           $img = base_url().$users->profile_picture;
        }
      }
      else
      {
      $img =  base_url().'assets/images/default.png';
      }
      
      
      $final = '<span class="bold">'.ucfirst($users->fname).'</span>';
    
     echo '<li id="usrmain'.$users->user_id.$i.'"><div class="main-chk-new popup-option"><input type="checkbox" name="s_user" id="userTrail'.$users->user_id.$i.'" value="'.$users->user_id.'" class="check_my_trail"></div> <span class="profile"> <img src="'.$img.'"> </span> <span class="p-name"> <h4><a href=\'javascript:void(0);\'>'.$final.'</a></h4> 
     
      </span>
     <a type="button" class="btn removeuser" data-toggle="modal" data-target="#deleteuser" id="rmv_'.$users->user_id.$i.'" onclick="removeuser('.$users->user_id.$i.','.$users->u_id.','.$ses_u_id.',\''.$users->t_name.'\')"><i class="fa fa-times"></i></a></li>';
   
  
$i++; }
}

public function shareFriendList(){
  $id = $this->input->post('id');

  $ses_u_id = $this->input->post('ses_u_id');
  $select ='tbl_user_master.fname, tbl_user_master.email, tbl_user_master.address, tbl_user_master.profile_picture, tbl_user_master.user_id, tbl_share_my_trails.shared_u_id, tbl_share_my_trails.t_id, tbl_share_my_trails.s_t_id, tbl_share_my_trails.status ,tbl_share_my_trails.t_name, tbl_share_my_trails.saveroute, tbl_share_my_trails.u_id';


  $where = array('shared_u_id' =>$ses_u_id,'t_id' =>$id, 'saveroute'=>'saveroute','tbl_share_my_trails.status' =>0);
  $userList = $this->model->get_data_rl_join_groupby($select, 'tbl_share_my_trails','tbl_user_master','u_id','user_id', $where,'user_id', 's_t_id', 'desc','left');
  $i=1;
  foreach ($userList as $users) {

       $img='';
      if(isset($users->profile_picture) && !empty($users->profile_picture)){
        if(strpos($users->profile_picture, "http://") !== false OR strpos($users->profile_picture, "https://") !== false){
           $img = $users->profile_picture;
        }else
        {
           $img = base_url().$users->profile_picture;
        }
      }
      else
      {
      $img =  base_url().'assets/images/default.png';
      }
       
      $final = '<span class="bold">'.ucfirst($users->fname).'</span>';
    
      //echo '<li><a href=\'javascript:void(0);\'>'.$final.'</a></li>';
      echo '<li id="usrmain'.$users->user_id.$i.'"><div class="main-chk-new popup-option"><input type="checkbox" name="s_user" id="userTrail'.$users->user_id.$i.'" value="'.$users->user_id.'" class="check_my_trail"></div> <span class="profile"> <img src="'.$img.'"> </span> <span class="p-name"> <h4><a href=\'javascript:void(0);\'>'.$final.'</a></h4>  </span><a type="button" class="btn removeuser" data-toggle="modal" data-target="#deleteuser" id="rmv_'.$users->user_id.$i.'" onclick="removeuser('.$users->user_id.$i.','.$users->u_id.','.$ses_u_id.',\''.$users->t_name.'\')"><i class="fa fa-times"></i></a>';
   
  
$i++; }
}
public function GetUserList(){
    
  $info = $this->session->all_userdata();
  $info['user_id'];
  $keyword = $_POST['data'];
  $query = $this->db->query("select * from tbl_user_master where fname like '".$keyword."%' and user_id!= 1 limit 0,10");
  $result = $query->result();
  if(isset($result)){
  echo '<div class="invite-friend mCustomScrollbar"><ul class="list">';
  $i=1;
  if(!empty($result)){
     foreach ($result as $users) {
     if($users->user_id != $info['user_id']){
       $img='';
       
      if(isset($users->profile_picture) && !empty($users->profile_picture)){
        if(strpos($users->profile_picture, "http://") !== false OR strpos($users->profile_picture, "https://") !== false){
           $img = $users->profile_picture;
        }else
        {
           $img = base_url().$users->profile_picture;
        }
      }
      else
      {
        $img =  base_url().'assets/images/default.png';
      }
      /*$str = strtolower($users->fname);
      $start = strpos($str,$keyword); 
      $end   = similar_text($str,$keyword); 
      $last = substr($str,$end,strlen($str));
      $first = substr($str,$start,$end);*/
      
      $final = '<span class="bold">'.ucfirst($users->fname).' '.ucfirst($users->lname).'</span>';
    
      //echo '<li><a href=\'javascript:void(0);\'>'.$final.'</a></li>';
      echo '<li><div class="main-chk-new popup-option"><input type="checkbox" name="s_user" id="userTrail'.$users->user_id.$i.'" value="'.$users->user_id.'" class="check_my_trail"></div> <span class="profile"> <img src="'.$img.'"> </span> <span class="p-name"> <h4><a href=\'javascript:void(0);\'>'.$final.'</a></h4>  </span> </li>';
    }

  }

  }else{
     echo '<li><span class="p-name"> <h4><a href=\'javascript:void(0);\'>No Record found.</a></h4> </span> </li>';
  }
 
  echo "</ul></div>";

  }else{
    echo 0;
  }
}
public function classifiedsearch() 
 {
  if(isset($this->userId)){
     $data['user_id'] = $this->userId;
  }
  $strQuery1 = "SELECT * FROM  `tbl_classified_list` WHERE 1 = 1 and classified_status =1";
   if(isset($_POST['searchclassified'])){
      if($_POST['searchclassified'] != ''){
       $strQuery1 = $strQuery1.' AND  classified_created_by LIKE "%'.$_POST['searchclassified'].'%" OR classified_type LIKE "%'.$_POST['searchclassified'].'%" OR classified_description LIKE "%'.$_POST['searchclassified'].'%"';
    }
  } 
  $query = $this->db->query($strQuery1.' ORDER BY `classified_id` DESC');
  $data['classified_list'] = $query->result();
  $this->load->view('frontend/classified/classified_category_main', $data);
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
 function requestsendingMail($fromemail, $toemail, $subject, $msg){
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        $this->email->from($fromemail);        
        $this->email->to($toemail);
        $this->email->cc(FROM_EMAIL, FROM_NAME); 
        $this->email->subject($subject);       
        $this->email->message($msg);  
        $return = $this->email->send();
        if($return){
            return true;
        }else{
           return false;
        }
} 
function trail_notification(){
  $s_t_id =$this->input->post('s_t_id');
  $status['view_status']= 2;
  $where = array('s_t_id' =>$s_t_id);
  $update = $this->model->update('tbl_share_my_trails',$status,$where);
  if($update){
    echo 1;
   }
}
function newsfeed_trail_notification(){
  $s_t_id =$this->input->post('s_t_id');
  $status['view_status']= 4;
  $where = array('s_t_id' =>$s_t_id);
  $update = $this->model->update('tbl_share_my_trails',$status,$where);
  if($update){
    echo 1;
   }
}
function all_notification(){
  $notification_id =$this->input->post('notification_id');
  $status['notification_status']= 1;
  $where = array('notification_id' =>$notification_id);
  //$update = $this->model->update('notification',$status,$where);
  $delete = $this->db->delete('notification', $where); 
  if($delete){
    echo 1;
   }
}
 function classified_renew(){
  $cl_id =$this->input->post('cl_id');
  $date = date("Y-m-d");// current date
  $status['renew_date'] = date("Y-m-d");
 // $status['classified_expired'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime($date)) . " +30 days"));
  $status['classified_expired'] = '';
  $status['renew_status']= 1;
  $where = array('classified_id' =>$cl_id);
  $update = $this->model->update('tbl_classified_list',$status,$where);
  if($update){
    $select = 'tbl_classified_list.*, tbl_user_master.email,tbl_user_master.fname,tbl_user_master.lname';
    $where1 = array('classified_id' =>$cl_id);
    $class_exp = $this->model->get_data_rl_join($select, 'tbl_classified_list','tbl_user_master','user_ID','user_id',$where1, 'classified_id', 'desc','left');
    if(isset($class_exp)){
      foreach ($class_exp as $class_exp) {
          $this->sendingMail($class_exp->email, 'Classified Renew ', 'Classified has been renewed successfully');
      }
    }
   }
}
function viewClassified(){
  $id =$this->input->post('id');
  $status['classified_view']= 1;
  $where = array('classified_id' =>$id);
  $update = $this->model->update('tbl_classified_list',$status,$where);
  if($update){
    echo 1;
   }
}
function viewEvent(){
  $id =$this->input->post('id');
  $status['n_view_user']= 1;
  $where = array('n_id' =>$id);
  $update = $this->model->update('tbl_notification',$status,$where);
  //$update = $this->db->delete('tbl_notification', $where); 
  if($update){
    echo 1;
   }
}
function viewTrail(){
  $trail_name =$this->input->post('trail_name');
  $status['view_status']= 1;
  $info = $this->session->all_userdata();
  $where = array('trail_name' =>$trail_name,'subc_user_id' =>$info['user_id']);
  $update = $this->model->update('tbl_subscribe_user',$status,$where);
  if($update){
    echo 1;
   }
}

function newsfeed_viewTrail(){
  $trail_name =$this->input->post('trail_name');
  $status['view_status']= 4;
  $info = $this->session->all_userdata();
  $where = array('trail_name' =>$trail_name,'subc_user_id' =>$info['user_id']);
  $update = $this->model->update('tbl_subscribe_user',$status,$where);
  if($update){
    echo 1;
   }
}

function event_sub_fun(){
  $sub['eve_id'] =$this->input->post('event_id');
  $sub['eve_sub_user_id'] =$this->input->post('user_id');
  $userEventSub = $this->model->get_row('tbl_event_subscribe', array('eve_id' =>$sub['eve_id'],'eve_sub_user_id' =>$sub['eve_sub_user_id']));
  if(count($userEventSub) > 0)
  {
    $update = $this->db->delete('tbl_event_subscribe', array('eve_id' =>$sub['eve_id'],'eve_sub_user_id' =>$sub['eve_sub_user_id']));
    if($update){
      echo 0;
    }
  }else{
    $insert = $this->model->insert_data('tbl_event_subscribe',$sub);
    if($insert){
        echo 1;
    }
  }
}


function forum_sub_fun(){
  $sub['forum_subscribe_id'] =$this->input->post('forum_subscribe_id');
  $sub['user_id'] =$this->input->post('user_id');
  $userEventSub = $this->model->get_row('forum_subscribe', array('forum_subscribe_id' =>$sub['forum_subscribe_id'],'user_id' =>$sub['user_id']));
  if(count($userEventSub) > 0)
  {
    $update = $this->db->delete('forum_subscribe', array('forum_subscribe_id' =>$sub['forum_subscribe_id'],'user_id' =>$sub['user_id']));
    if($update){
      echo 0;
    }
  }else{
    $insert = $this->model->insert_data('forum_subscribe',$sub);
    if($insert){
        echo 1;
    }
  }
}



public function classified_pagination(){
 

$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 4;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;
$classified_type = $_GET['classified_type'];
$pageName = $_GET['pageName'];

if($pageName == 'classifiedcategory'){
  $query = $this->db->query('SELECT * FROM `tbl_classified_list` WHERE classified_expired >= CURDATE() AND  `classified_type` =  "'.$classified_type.'" AND `classified_status` = 1 ORDER BY `classified_id` DESC LIMIT '.$limit.' OFFSET '.$offset.'');
}else{
  $query = $this->db->query('SELECT * FROM `tbl_classified_list` WHERE classified_expired >= CURDATE() AND `url_slag` LIKE  "%'.$classified_type.'%" OR `classified_type` LIKE  "%'.$classified_type.'%" OR `classified_description` LIKE  "%'.$classified_type.'%" AND `classified_status` = 1 ORDER BY `classified_id` DESC LIMIT '.$limit.' OFFSET '.$offset.'');
}

$data['classified_list'] = $query->result();
if (count($data['classified_list']) > 0) {
   $this->load->view('frontend/classified/classified_category_main',$data); 
}

}

public function load_more_pagination(){
 

$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 4;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;
$pageName = $_GET['pageName'];

if($pageName == 'events'){
  $query = $this->db->query('SELECT * FROM `tbl_event` WHERE  `event_status` =  1 and event_date >= CURDATE()  ORDER BY `event_id` DESC LIMIT '.$limit.' OFFSET '.$offset.'');
  $data['eventList'] = $query->result();
  if (count($data['eventList']) > 0) {
   $this->load->view('frontend/event/event_data',$data); 
  }
}
if($pageName == 'pastevents'){
  $query = $this->db->query('SELECT * FROM `tbl_event` WHERE  `event_status` =  1 and  event_date < CURDATE() ORDER BY `event_id` DESC LIMIT '.$limit.' OFFSET '.$offset.'');
  $data['eventList'] = $query->result();
  if (count($data['eventList']) > 0) {
   $this->load->view('frontend/event/event_data',$data); 
  }
}
if($pageName == 'news'){
  $query = $this->db->query('SELECT * FROM `tbl_news` WHERE  `news_status` =  1  ORDER BY `news_id` DESC LIMIT '.$limit.' OFFSET '.$offset.'');
  $data['newList'] = $query->result();
  if (count($data['newList']) > 0) {
   $this->load->view('frontend/ajax_mynews_pagination',$data); 
  }
}

}


function permission_chk(){
  $roleID = $this->input->post('roles');
  $permission_id = $this->input->post('perm_ID');
  $where = array('role_id'=>$roleID,'permission_id'=>$permission_id);
  $role_permission = $this->model->get_row('tbl_role_permission', $where);
  if (count($role_permission) != 0) {
        echo 1;
  } 
}
function viewnot()
{
  $tablename = $this->input->post('tablename');
  $id = $this->input->post('id');
  
  if($tablename == 'tbl_notification'){
    $view['n_view_user'] = 1;
      $where= array('n_id'=>$id);
  }
  
  $update = $this->model->update($tablename,$view,$where);
   // $update = $this->db->delete($tablename, $where); 
    echo 1;
}
function notifiupdate()
{
  $tablename = $this->input->post('tablename');
  $n_type_id = $this->input->post('n_type_id');
  $n_view_user = $this->input->post('user_id');
  
  if($tablename == 'tbl_notification'){
    $view['n_view_user'] = 1;
      $where= array('n_type_id'=>$n_type_id,'user_id'=>$n_view_user);
    }
  
  $update = $this->model->update($tablename,$view,$where);
  //$update = $this->db->delete($tablename, $where); 

  
    echo 1;
}

   public function getReview(){
        $page =  $_GET['page'];
        $busID =  $_GET['busID'];
       // $this->load->model('welcome_model');
         $data['totalReview']= $this->model->getReview($page, $busID);
         if(isset($data['totalReview']) && !empty($data['totalReview'])){
 $this->load->view('frontend/vacation/reviewpage',$data);
         }else{
          echo 1;
         }
     
       
    }

}// class Close



	?>