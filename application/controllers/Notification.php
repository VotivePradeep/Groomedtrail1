<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Notification extends CI_Controller {
    function __construct()// no spaces around parenthesis in function declarations 
    {
      parent::__construct();
      $this->load->model('model');
      $this->load->library('email');
    }

    function classified_expired(){
        //echo 'reena';
        //$this->sendingMail('votive.reena@gmail.com', 'test function', 'my first clon job setting in ci');
        // die();
        $select = 'tbl_classified_list.*, tbl_user_master.email,tbl_user_master.fname,tbl_user_master.lname';
        $where = array(1=>1);
        $class_exp = $this->model->get_data_rl_join($select, 'tbl_classified_list','tbl_user_master','user_ID','user_id',$where, 'classified_id', 'desc','left');

        if(isset($class_exp)){
            foreach ($class_exp as $class_exp) {
                if($class_exp->classified_expired <= date("Y-m-d")){
                    $cls_ex['classified_status'] = 0;
                    $cls_ex['renew_status'] = 0;
                    $where = array('classified_id' => $class_exp->classified_id);
                    $anotify['n_type_id'] = $class_exp->classified_id;
                    $anotify['user_id'] = $class_exp->user_id;
                    $anotify['n_cat_type'] = 'classified';
                    $anotify['n_type'] = 'classified_expired';
                    $anotify['n_date'] = date('Y-m-d h:i:s');
                 //   $this->model->insert_data('tbl_notification',$anotify);
                    $update = $this->model->update('tbl_classified_list',$cls_ex,$where);
                    if($update){
                       //echo '<h5>classified expired</h5>';
                        $row1 =  $this->model->get_row('email_templates',array('title'=>'ClassifiedExpired'));
                        $subject = $row1->subject;
                        $message = $row1->content;
                        $message = str_replace("{username}",ucfirst($class_exp->fname),$message);
                        $message = str_replace("{user_email_address}",$class_exp->email,$message);
                        $message = str_replace("{page_link}",base_url().'classified/details/'.$class_exp->url_slag,$message);
                        $message = str_replace("{classified_name}",$class_exp->classified_created_by,$message);
                        $message = str_replace("{days_expire}",date_format(date_create($class_exp->classified_expired), 'd M Y'),$message);
                        $this->sendingMail($class_exp->email ,$subject, $message);
                        //$this->sendingMail($class_exp->email, 'Classified Expired ', 'Your classified listing submission has been expired.please renew classified list');
                    } 
                }
            }
        }
    } 

     function rental_expired(){
       echo date('Y-m-d').'</br>';
        $select = 'tbl_vacation_list.*, tbl_user_master.email,tbl_user_master.fname,tbl_user_master.lname';
        $where = array(1=>1);
        $rental_expired = $this->model->get_data_rl_join($select, 'tbl_vacation_list','tbl_user_master','user_id','user_id',$where, 'vac_id', 'desc','left');
        if(isset($rental_expired)){

            foreach ($rental_expired as $r_expired) {
                if($r_expired->vac_expiry_date <= date('Y-m-d')){
                    if($r_expired->vac_expiry_date != '0000-00-00'){
                        if($r_expired->vac_expiry_date == date('Y-m-d')){
                        	//echo $r_expired->vac_expiry_date.'</br>';
                            $row1 =  $this->model->get_row('email_templates',array('title'=>'rentalExpired'));
                            $subject = $row1->subject;
                            $message = $row1->content;
                            $pageLike = base_url().'lodging/'.$r_expired->vac_slag;
                            $message = str_replace("{username}",ucfirst($r_expired->fname),$message);
                            $message = str_replace("{rental_name}",ucfirst($r_expired->vac_name),$message);
                            $message = str_replace("{page_link}",$pageLike,$message);
                            $message = str_replace("{user_email_address}",$r_expired->email,$message);
                            $message = str_replace("{days_expire}",date_format(date_create($r_expired->vac_expiry_date), 'd M Y'),$message);
                            $this->sendingMail($r_expired->email,$subject, $message);
                        }
                    }
                    $r_ex['vac_status'] = 0;
                    $r_ex['renew_status'] = 0;
                    $r_ex['vac_payment_status'] = 0;
                    $r_ex['admin_view_review'] = 0;
                    $r_ex['mail_status'] = 1;
                    $where1 = array('vac_id' => $r_expired->vac_id);
                    $anotify['n_type_id'] = $r_expired->vac_id;
                    $anotify['user_id'] = $r_expired->user_id;
                    $anotify['n_type'] = 'rental_expired';
                    $anotify['n_date'] = date('Y-m-d h:i:s');
                    $anotify['n_cat_type'] = 'rental';
                    $this->model->insert_data('tbl_notification',$anotify);
                    $update = $this->model->update('tbl_vacation_list',$r_ex,$where1);
                    if($update){

                        //$this->sendingMail($r_expired->email, 'Rental Expired ', 'Your lodging listing submission has been expired.please renew lodging list');
                    } 
                }
            }
        }
    } 


  function trail_notification(){
     $query = $this->db->query("SELECT `tbl_user_master`.profile_picture,`tbl_user_master`.fname,`tbl_user_master`.lname,`tbl_user_master`.user_id,`tbl_user_master`.email,`tbl_trail_report`.created_date as n_date,`tbl_trail_report`.status,`tbl_trail_report`.trail_status,`tbl_trail_report`.trail_description,`tbl_trail_report`. trail_name,`tbl_trail_report`. user_id,`tbl_subscribe_user`.`subc_id`,`tbl_subscribe_user`.`subc_user_id`,`tbl_subscribe_user`.`trail_type`,`tbl_subscribe_user`.`trail_name`,`tbl_subscribe_user`.`subc_user_email`,`tbl_subscribe_user`.`subc_date` as `n_date`,`tbl_subscribe_user`.`subc_status`,`tbl_subscribe_user`.`view_status` 
    FROM `tbl_trail_report`
    LEFT JOIN `tbl_user_master` ON `tbl_trail_report`.`user_id`=`tbl_user_master`.`user_id`
    LEFT JOIN `tbl_subscribe_user` ON `tbl_trail_report`.`trail_name`=`tbl_subscribe_user`.`trail_name` 
    LEFT JOIN tbl_trail_report m2 ON (tbl_trail_report.`trail_name` = m2.`trail_name` AND tbl_trail_report.`created_date` < m2.`created_date`)

    WHERE `tbl_trail_report`.`status` = 1 and tbl_subscribe_user.trail_type = 'trail' and tbl_subscribe_user.view_status = 0  and m2.`created_date` IS NULL
    ORDER BY `tbl_trail_report`.`trail_report_id` DESC");
         
       $result =  $query->result_array(); 
       foreach ($result as $value) {
            $row1 =  $this->model->get_row('email_templates',array('title'=>'UpdateTrail'));
            $subject = $row1->subject;
            $message = $row1->content;
            $message = str_replace("{username}",ucfirst($value['fname']),$message);
            $message = str_replace("{user_email_address}",$value['email'],$message);
            $message = str_replace("{trail_update_date}",date_format(date_create($value['n_date']), 'd M Y'),$message);
            $message = str_replace("{trail}","Trail Update",$message);
            $message = str_replace("{trail_name}",$value['trail_name'],$message);
            $message = str_replace("{trail_description}",$value['trail_description'],$message);
            $this->sendingMail($value['email'] ,$subject, $message);
       }
  } 

    function trail_report_notification(){
     $query = $this->db->query("SELECT `tbl_user_master`.profile_picture,`tbl_user_master`.fname,`tbl_user_master`.lname,`tbl_user_master`.user_id,`tbl_user_master`.email, `trail_report_user_update`.trail_report_created_date as `n_date`, `trail_report_user_update`.trail_report_status, `trail_report_user_update`.trail_report_conditions, `trail_report_user_update`.CountyID,`trail_report_user_update`.state_name,`trail_report_user_update`.userID,`tbl_subscribe_user`.`subc_id`,`tbl_subscribe_user`.`subc_user_id`,`tbl_subscribe_user`.`trail_type`,`tbl_subscribe_user`.`trail_name`,`tbl_subscribe_user`.`subc_user_email`,`tbl_subscribe_user`.`subc_date` ,`tbl_subscribe_user`.`subc_status`,`tbl_subscribe_user`.`view_status` FROM `trail_report_user_update` LEFT JOIN `tbl_user_master` ON `trail_report_user_update`.`userID`=`tbl_user_master`.`user_id` LEFT JOIN `tbl_subscribe_user` ON `trail_report_user_update`.`CountyID`=`tbl_subscribe_user`.`trail_name` LEFT JOIN trail_report_user_update m2 ON (trail_report_user_update.`CountyID` = m2.`CountyID` AND trail_report_user_update.`trail_report_created_date` < m2.`trail_report_created_date`) WHERE trail_report_user_update.`trail_report_status` = 1 and tbl_subscribe_user.trail_type = 'trail_report' and tbl_subscribe_user.view_status = 0 and m2.`trail_report_created_date` IS NULL ORDER BY `trail_report_user_update`.`ID` DESC");
         
       $result =  $query->result_array(); 
       foreach ($result as $value) {
            $row1 =  $this->model->get_row('email_templates',array('title'=>'UpdateTrail'));
            $subject = $row1->subject;
            $message = $row1->content;
            $message = str_replace("{username}",ucfirst($value['fname']),$message);
            $message = str_replace("{user_email_address}",$value['email'],$message);
            $message = str_replace("{trail_update_date}",date_format(date_create($value['n_date']), 'd M Y'),$message);
            $message = str_replace("{trail}","Trail Report Update",$message);
            $message = str_replace("{trail_name}",$value['trail_name'],$message);
            $message = str_replace("{trail_description}",$value['trail_report_conditions'],$message);
            $this->sendingMail($value['email'] ,$subject, $message);
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
}//class Close