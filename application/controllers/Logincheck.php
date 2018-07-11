<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Logincheck extends CI_Controller { 
    public function __construct(){
    parent::__construct();
    $this->load->model('model');
    $this->load->library('pagination');
    $this->load->library('session');
   }
  /**
   * Index Page for this controller.
   */
  public function index(){

      $data['title'] = 'Admin Login';
      $this->load->view('administrator/include/home_header',$data);
    $this->load->view('administrator/index');
    $this->load->view('administrator/include/home_footer',$data);
    }
    
function login(){
  $error="";
  $siterole="";
  $success = "";
    if(isset($_REQUEST['email']))
    {
      $useremail= $_REQUEST['email'];
      $password= base64_encode($_REQUEST['password']);
      $value = $this->model->login_check($useremail,$password);

    if(!empty($value))
    {
       if($value['status'] == 0){
         
      $success='error';
      $error="Your account is currently disabled. If this account has been recently created, it must first be verified. Please check your email for verification instructions. Otherwise, contact a GroomedTrail administrator for assistance.";
      }else{
           
      $userid=$value['user_id'];
      //$user_type=$value['user_type'];
      $login_type=$value['login_type'];
      $siterole=$value['siterole_id'];
      
      $logininfo= array('session_id'=>session_id(),'useremail'=>$useremail,'user_id'=>$userid,'siterole'=>$siterole,'logged_in'=>TRUE, 'login_type'=>$login_type);
      
      $this->session->set_userdata($logininfo);
      $info = $this->session->all_userdata();
      $success=1;
      $siterole = $siterole;
      
      }
    
    }
    else
    {   
      $success='error';
      $error="Invalid Login OR (Please check your email id)";
    }


}
 
   $arr=array('a'=>$error,'b'=>$success,'c'=>$siterole);
   print_r(json_encode($arr));

} 


  /**
   * sign in as a Admin action function Starts Here
   */ 
  public function sign_in(){

     $error="";
     $siterole="";
     if(isset($_REQUEST['username']))
     {
       $useremail=$_REQUEST['username'];
       $password= base64_encode($_REQUEST['password']);
       $value = $this->model->admin_login_check($useremail,$password);
        if($value['siterole_id'] != 2){
           if(!empty($value))
           {
               $userid=$value['user_id'];
               $siterole=$value['siterole_id'];
               $logininfo= array('admin_session_id'=>session_id(),'admin_email'=>$useremail,'admin_id'=>$userid,'admin_siterole'=>$siterole,'logged_in'=>TRUE);
               $this->session->set_userdata($logininfo);
               $error='';
           }
           else
           {
              $error="The email address and password you entered do not match.";
            
           }

       }else{

            $access_denied = 4;
       }
      
       
     }
     
     $arr=array('a'=>$error,'b'=>$siterole, 'c'=>$access_denied);
     print_r(json_encode($arr));
     
  }
/**
   * Access Denied Page for this controller.
   */
  public function access_denied(){
    $data['title'] = 'ACCESS DENIED';
    $this->load->view('administrator/access_denied1',$data);

  }


/**
   * sign in as a Admin action function Starts Here
   */ 

function signup()
{   
  //$arr = '';
   if(isset($_REQUEST['email'])){
    
      $insert['username'] = $_REQUEST['username'];
      $insert['fname'] = $_REQUEST['fname'];
      $insert['lname'] = $_REQUEST['lname'];
      $insert['email'] = $_REQUEST['email'];
      $insert['password'] = base64_encode($_REQUEST['password']);
      $insert['siterole_id'] = $_REQUEST['loginType'];
      //$insert['user_type'] = $_REQUEST['user_type'];
      $insert['login_type'] = 'NM';
      $return = $this->model->insert_data('tbl_user_master',$insert);
      $lastid = $this->db->insert_id(); 
      if($return){
             echo 1;
      $link = base_url().'verification_link/'.$lastid; 
      ## Registration successful
      $email = $_REQUEST['email'];
      $username = $_REQUEST['username'];
            $row =  $this->model->get_row('email_templates',array('title'=>'registration'));
            $subject = $row->subject;
            $content= $row->content;
            $content= str_replace("{varifyLink}",$link,$content);
            $content= str_replace("{username}",$username,$content);
            $content= str_replace("{user_email_address}",$email,$content);
            $this->send_mail($email, $subject, $content); ## Mail sent
    
      }else{
        echo 0;
      }
      }
}




public function verification_link(){

      $userid = $this->uri->segment(2);
      $data1['heading']='User verification !';
      $data1['message']='This link has been expired.';
      $data['login'] =  $this->model->get_row('tbl_user_master',array('user_id'=>$userid));
      if($data['login']->status == 0)
        {   
          $this->model->update('tbl_user_master',array('status'=>1),array('user_id'=>$userid));
          $permission_tye['user_id']=$userid;
          $permission_tye['role_id']=1;
          $this->model->insert_data('tbl_user_assign_permission',$permission_tye);
          $this->load->view('after_registration_notification.php', $data1);
        }else{
          $this->load->view('verification_404.php', $data1);
        }
        
    }

    public function verification_user(){
      $userid = $this->uri->segment(2);
      $info=$this->session->all_userdata();
      $this->session->sess_destroy();
      $data1['heading']='User verification !';
      $data1['message']='This link has been expired.';
      $data['login'] =  $this->model->get_row('tbl_user_master',array('user_id'=>$userid));
      if($data['login']->status == 0)
        {   
          $this->model->update('tbl_user_master',array('status'=>1),array('user_id'=>$userid));
          if(isset($data['login']->siterole_id)){
            if($data['login']->siterole_id == 2){
              //$this->load->view('after_registration_notification.php');
              redirect(base_url());
            }else if($data['login']->siterole_id == 3) {
              redirect(base_url().'administrator');
            }else{
              redirect(base_url().'administrator');
            }
            
          }
        }else{
          $this->load->view('verification_404.php', $data1);
        }
        
    }



/*public function request_verify(){
  
    if($this->input->is_ajax_request()){

      $email  = $_REQUEST['forgot_emailid'];
            $result = $this->model->get_row('tbl_user_master',array('email' => $email));
      if(empty($result)){

        echo 2; die;
      }
      else if($result->status != 1){

        echo 3; die;
      }     
      else{
        $userid=  $result->user_id;
        $password=  base64_decode($result->password);
        $username=  $result->username;

        $row =  $this->model->get_row('email_templates',array('title'=>'forgotpassword'));
        $subject = $row->subject;
        $content= $row->content;
        $content= str_replace("{passwod}",$password,$content);
        $content= str_replace("{username}",$username,$content);
        $content= str_replace("{user_email_address}",$email,$content);
        $this->send_mail($email, $subject, $content); ## Mail sent
        ## Session Set
         echo 1; die;   
         }
       }
  
  }*/

  public function forgot_password(){
    if($this->input->is_ajax_request()){
      $email  = $_REQUEST['forgot_emailid'];
      $result = $this->model->get_row('tbl_user_master',array('email' => $email));
      if(empty($result)){
        echo 2; die;
      }
      else if($result->status != 1){
        echo 3; die;
      }     
      else{
        $userid= $result->user_id;
        $link = base_url().'logincheck/forgot_verification_link/'.$userid; 
        //$password=  base64_decode($result->password);
        $email_id=  $result->email;    
        $username=  $result->fname;
        $row =  $this->model->get_row('email_templates',array('title'=>'forgotpassword'));
        $subject = $row->subject;
        $content= $row->content;
        $content= str_replace("{link}",$link,$content);
        $content= str_replace("{username}",$username,$content);
        $content= str_replace("{user_email_address}",$email,$content);
        $this->send_mail($email, $subject, $content);
        ## Mail sent
        ## Session Set
         echo 1; die;   
        }
       }
  }
  public function forgot_verification_link(){
$this->session->unset_userdata('user_id');
      $userid = $this->uri->segment(3);
      $data1['heading']='User verification !';
      $data1['message']='This link has been expired.';
      $data['login'] =  $this->model->get_row('tbl_user_master',array('user_id'=>$userid));
      if($data['login']->status == 1)
        {   
          $this->model->update('tbl_user_master',array('status'=>1),array('user_id'=>$userid));
           redirect(base_url().'change_password/'.$userid);
        }else{
          $this->load->view('errors/cli/error_404.php', $data1);
        }
        
    }
     public function change_password(){
         
      $userid = $this->input->post('userid');
      $password = base64_encode($this->input->post('password'));
      $data['login'] =  $this->model->get_row('tbl_user_master',array('user_id'=>$userid));  
      if($data['login']->status == 1)
        {   
          $update = $this->model->update('tbl_user_master',array('password'=>$password),array('user_id'=>$userid));
          if($update){
            echo 1;
            //e10adc3949ba59abbe56e057f20f883e
          }
           //redirect(base_url().'login');

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


function send_mail($email, $subject, $msg){
  
   
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



  /**
   * signout function Starts Here
   */
  public function signout(){
    $info=$this->session->all_userdata();

    //$data['userinfo']=$info;
   // $this->session->unset_userdata($info);
    $this->session->sess_destroy();
    redirect(base_url().'administrator');
    echo 1;
  }
  public function logout(){

    $info=$this->session->all_userdata();
    $this->session->sess_destroy();
    redirect(base_url());
    echo 1;
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

/* function getKmlByPoi(){
 
    $kml_data_id = $this->input->post('kml_data_id');
    $trail_type_id = $this->input->post('trail_type_id');
   
    $query = $this->db->query("SELECT * FROM tbl_trail_master INNER JOIN tbl_kml_data ON tbl_trail_master.trail_type_id = tbl_kml_data.trail_fk_id where tbl_kml_data.trail_fk_id =".$trail_type_id." and  kml_data_id= ".$kml_data_id.""); 
    $result = $query->result_array();

    $poiObject = json_encode($result);
    print_r($poiObject);
 
 }*/ 

  function encryptionId($string,$key)
  {
     
      $result = "";
        for($i=0; $i<strlen($string); $i++){
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key))-1, 1);
                $char = chr(ord($char)+ord($keychar));
                $result.=$char;
        }
    
        $salt_string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxys0123456789~!@$^&()_`-={}|:<>?[]\;',";
    $length = rand(1, 15);
        $salt = "";
        for($i=0; $i<=$length; $i++){
                $salt .= substr($salt_string, rand(0, strlen($salt_string)), 1);
        }
        $salt_length = strlen($salt);
        $end_length = strlen(strval($salt_length));
    return str_replace(array('/'), array('-'), base64_encode($result.$salt.$salt_length.$end_length));
        //return  base64_encode($result.$salt.$salt_length.$end_length);  
  }

   function decryptId($string,$key)
  {
      $result = "";
        $string = base64_decode($string);
        $end_length = intval(substr($string, -1, 1));
        $string = substr($string, 0, -1);
        $salt_length = intval(substr($string, $end_length*-1, $end_length));
        $string = substr($string, 0, $end_length*-1+$salt_length*-1);
        for($i=0; $i<strlen($string); $i++){
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key))-1, 1);
                $char = chr(ord($char)-ord($keychar));
                $result.=$char;
        }
    return $result; 
  }



} // class close
