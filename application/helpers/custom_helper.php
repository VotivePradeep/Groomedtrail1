<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$this->ci =& get_instance();
$this->ci->load->database();
$this->ci->load->model('model');

if (!function_exists('paypal_credential'))
{

    function paypal_credential()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = " SELECT * FROM paypal_credential ";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();              
        return $array;    
        
    }

}
if (!function_exists('create_unique_slug'))
{
function create_unique_slug($string,$table,$field='slug',$key=NULL,$value=NULL)
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
}

}

if (!function_exists('subcription_datail'))
{

    function subcription_datail()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = " SELECT * FROM tbl_mailchimp_credentiall where id=1";
        $result = $ci->db->query($sql);     
        $array = $result->row();              
        return $array;    
        
    }

}
 if (!function_exists('google_mapkey'))
{

    function google_mapkey()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql ='SELECT * From tbl_google_mapkey where map_id = 1';
        $result = $ci->db->query($sql);     
        $array = $result->result();              
        return $array;    
        
    }

}
if (!function_exists('facebook_credential'))
{

    function facebook_credential()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql ='SELECT * From tbl_gmail_facebook_credential where id = 1';
        $result = $ci->db->query($sql);     
        $array = $result->result();              
        return $array;    
        
    }

}
if (!function_exists('google_credential'))
{

    function google_credential()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql ='SELECT * From tbl_gmail_facebook_credential where id = 2';
        $result = $ci->db->query($sql);     
        $array = $result->result();              
        return $array;    
        
    }

}
if (!function_exists('my_social_footer'))
{

    function my_social_footer()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = " SELECT * FROM `social_media_setting` ";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();              
        return $array;    
        
    }

}
if (!function_exists('footer_menu'))
{

    function footer_menu()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT slag,page_name,id,menu_name FROM `tbl_cms_pages` where show_in_menu = 1 and status = 1 ";
        $result = $ci->db->query($sql);     
        $array = $result->result();              
        return $array;    
        
    }

}
if (!function_exists('trailNotification'))
{

    function trailNotification($user_id)
    {
        $ci =& get_instance();
        $ci->load->database();


        $sql = "SELECT `tbl_share_my_trails`.`s_t_id`,`tbl_share_my_trails`.`saveroute`,`tbl_share_my_trails`.`region_name`,`tbl_share_my_trails`.`t_id`,`tbl_share_my_trails`.`t_name`,`tbl_share_my_trails`.`shared_u_id`,`tbl_share_my_trails`.`u_id`,`tbl_share_my_trails`.`url`,`tbl_share_my_trails`.`status`,`tbl_share_my_trails`.`view_status`,`tbl_share_my_trails`.`created_date` as n_date, `tbl_user_master`.* FROM `tbl_share_my_trails` LEFT JOIN `tbl_user_master` ON `tbl_share_my_trails`.`shared_u_id`=`tbl_user_master`.`user_id` WHERE `u_id` = ".$user_id." AND `view_status` =0 ORDER BY `s_t_id` DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();
        return $array;    
        
    }

}

if (!function_exists('home_trailNotification'))
{

    function home_trailNotification($user_id)
    {
        $ci =& get_instance();
        $ci->load->database();


        $sql = "SELECT `tbl_share_my_trails`.`s_t_id`,`tbl_share_my_trails`.`saveroute`,`tbl_share_my_trails`.`region_name`,`tbl_share_my_trails`.`t_id`,`tbl_share_my_trails`.`t_name`,`tbl_share_my_trails`.`shared_u_id`,`tbl_share_my_trails`.`u_id`,`tbl_share_my_trails`.`url`,`tbl_share_my_trails`.`status`,`tbl_share_my_trails`.`view_status`,`tbl_share_my_trails`.`created_date` as n_date, `tbl_user_master`.* FROM `tbl_share_my_trails`  LEFT JOIN `tbl_user_master` ON `tbl_share_my_trails`.`shared_u_id`=`tbl_user_master`.`user_id` WHERE `u_id` = ".$user_id." AND `view_status` !=4 ORDER BY `s_t_id` DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();
        return $array;    
        
    }

}

if (!function_exists('notification_all_ty'))
{

    function notification_all_ty($user_id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $query="SELECT tbl_vacation_list_images.*,tbl_vacation_list.*,tbl_review.*,notification.notification_update_date as n_date,notification.user_id, notification.notification_status,notification.notificate_type,notification.notificate_type_id,notification.notification_id 
             FROM tbl_review 
              LEFT JOIN notification on notification.notificate_type_id = tbl_review.review_ID 
              LEFT JOIN tbl_vacation_list on tbl_review.bus_ID = tbl_vacation_list.vac_id 
              JOIN tbl_vacation_list_images on tbl_vacation_list_images.vac_id = tbl_vacation_list.vac_id 
              where notification.user_id = ".$user_id." and notification.n_cat_type = 'rental' and notification.notification_status= 0 GROUP BY notificate_type_id, tbl_vacation_list_images.vac_id order by notification.notification_id DESC";
                                 
        $result = $ci->db->query($query);     
        $array = $result->result_array();

         $sql1    = "SELECT forum_comment.*,tbl_user_master.*,forum_question.*,forum_category.*, notification.notification_update_date as n_date,notification.user_id, notification.notification_status,notification.notificate_type,notification.notificate_type_id,notification.notification_id From notification 
        JOIN forum_comment on notification.notificate_type_id = forum_comment.forum_comment_id 
        JOIN tbl_user_master on forum_comment.user_id = tbl_user_master.user_id 
        JOIN forum_question on  forum_question.forum_ques_id = forum_comment.forum_ques_id  
        JOIN forum_category on  forum_category.forum_cat_id = forum_comment.forum_cat_id    
        WHERE notification.user_id =".$user_id." and  notification.notification_status = 0 and notification.n_cat_type = 'forum' ORDER BY notification.notification_id DESC";
        $result1 = $ci->db->query($sql1);     
        $array1 = $result1->result_array(); 
        
        return array_merge($array, $array1); 
        
    }

}




if (!function_exists('view_review_admin'))
{

    function view_review_admin()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT * FROM tbl_review where admin_view_review=0";
        $result = $ci->db->query($sql);     
        $array = $result->result();              
        return $array;    
        
    }

}

if (!function_exists('view_vaction_admin'))
{

    function view_vaction_admin()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT * FROM tbl_vacation_list where admin_view_review=0 and user_id !=1";
        $result = $ci->db->query($sql);     
        $array = $result->result();              
        return $array;    
        
    }

}
if (!function_exists('view_classified_admin'))
{

    function view_classified_admin()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT * FROM tbl_classified_list where admin_view_review=0 and user_ID !=1";
        $result = $ci->db->query($sql);     
        $array = $result->result();              
        return $array;    
        
    }

}
if (!function_exists('view_news_admin'))
{

    function view_news_admin()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT * FROM tbl_news where admin_view_review=0 and user_id !=1";
        $result = $ci->db->query($sql);     
        $array = $result->result();              
        return $array;    
        
    }

}
if (!function_exists('view_forum_admin'))
{

    function view_forum_admin()
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT * FROM forum_question where admin_view_review=0 and user_id !=1";
        $result = $ci->db->query($sql);     
        $array = $result->result();              
        return $array;    
        
    }

}
if (!function_exists('role_permission'))
{

    function role_permission($user_id, $permission_id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT *
FROM `tbl_role_permission`
LEFT JOIN `tbl_user_assign_permission` ON `tbl_role_permission`.`role_id`=`tbl_user_assign_permission`.`role_id`
WHERE `tbl_user_assign_permission`.`user_id` = ".$user_id." AND `tbl_role_permission`.`permission_id`= ".$permission_id."
ORDER BY `tbl_user_assign_permission`.`p_id` DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result();              
        return $array;    
        
    }

}


if (!function_exists('notification_a'))
{

    function notification_a($user_id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT * From tbl_notification 
       
        join tbl_user_master on tbl_notification.user_id = tbl_user_master.user_id 
        join tbl_vacation_list on tbl_notification.n_type_id = tbl_vacation_list.vac_id 
        join tbl_vacation_list_images on tbl_vacation_list_images.vac_id = tbl_vacation_list.vac_id 
        WHERE tbl_notification.user_id =".$user_id." and  tbl_notification.n_view_user = 0 and tbl_notification.n_cat_type = 'rental'  GROUP BY tbl_vacation_list_images.vac_id ORDER BY n_id DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();              
        return $array;    
        
    }

}
if (!function_exists('notification_cls'))
{

    function notification_cls($user_id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT * From tbl_notification 
       
         join tbl_user_master on tbl_notification.user_id = tbl_user_master.user_id 
        RIGHT join tbl_classified_list on tbl_notification.n_type_id = tbl_classified_list.classified_id 
         join tbl_classified_images on tbl_classified_images.cls_id = tbl_classified_list.classified_id  
        WHERE tbl_user_master.user_id =".$user_id." and  tbl_notification.n_view_user = 0 and tbl_notification.n_cat_type = 'classified' GROUP BY  tbl_classified_images.cls_id ORDER BY n_id DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();              
        return $array;    
        
    }

}
if (!function_exists('notification_c'))
{

    function notification_c($user_id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT user_ID,classified_view,url_slag,classified_expired as n_date,classified_status,classified_id,classified_created_by FROM tbl_classified_list where user_ID = ".$user_id." and classified_view= 0 order by classified_expired DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();              
        return $array;    
        
    }

}



if (!function_exists('notification_e'))
{

    function notification_e($user_id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT tbl_event_subscribe.*,tbl_event.*,tbl_event_image.*,tbl_notification.n_date,tbl_notification.user_id, tbl_notification.n_view_user,tbl_notification.n_type,tbl_notification.n_type_id,tbl_notification.n_id  FROM tbl_event_subscribe 
              RIGHT JOIN tbl_notification on tbl_notification.n_type_id = tbl_event_subscribe.eve_id 
              LEFT JOIN tbl_event on tbl_event_subscribe.eve_id = tbl_event.event_id 
              LEFT JOIN tbl_event_image on tbl_event_image.event_id = tbl_event.event_id 
              where tbl_event_subscribe.eve_sub_user_id = ".$user_id." and tbl_notification.n_view_user= 0 and tbl_notification.n_cat_type = 'event' GROUP BY n_type_id,tbl_event_image.event_id order by tbl_notification.n_id DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();              
        return $array;    
        
    }

}

if (!function_exists('home_trailReportNewsFeed'))
{

    function home_trailReportNewsFeed($user_id,$subc_id)
    {
        $ci =& get_instance();
        $ci->load->database();
         $subcid ='';
        if(!empty($subc_id)){
            $subcid = "and tbl_subscribe_user.subc_id =".$subc_id.""; 
        }else{
           $subcid = ''; 
        }
        $sql = "SELECT `tbl_user_master`.profile_picture,`tbl_user_master`.address,`tbl_user_master`.fname,`tbl_user_master`.lname,`tbl_user_master`.user_id,`tbl_user_master`.email, `trail_report_user_update`.trail_report_created_date as `n_date`, `trail_report_user_update`.trail_report_status, `trail_report_user_update`.trail_report_conditions, `trail_report_user_update`.CountyID,`trail_report_user_update`.state_name,`trail_report_user_update`.userID,`tbl_subscribe_user`.`subc_id`,`tbl_subscribe_user`.`subc_user_id`,`tbl_subscribe_user`.`trail_type`,`tbl_subscribe_user`.`trail_name`,`tbl_subscribe_user`.`subc_user_email`,`tbl_subscribe_user`.`subc_date`,`tbl_subscribe_user`.`subc_status`,`tbl_subscribe_user`.`view_status` FROM `trail_report_user_update` LEFT JOIN `tbl_user_master` ON `trail_report_user_update`.`userID`=`tbl_user_master`.`user_id` LEFT JOIN `tbl_subscribe_user` ON `trail_report_user_update`.`CountyID`=`tbl_subscribe_user`.`trail_name` LEFT JOIN trail_report_user_update m2 ON (trail_report_user_update.`CountyID` = m2.`CountyID` AND trail_report_user_update.`trail_report_created_date` < m2.`trail_report_created_date`) WHERE trail_report_user_update.`trail_report_status` = 1 and tbl_subscribe_user.trail_type = 'trail_report' and tbl_subscribe_user.subc_user_id = ".$user_id." ".$subcid." and tbl_subscribe_user.view_status != 4 and m2.`trail_report_created_date` IS NULL ORDER BY `trail_report_user_update`.`ID` DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();              
        return $array;    
        
    }

}

if (!function_exists('trailReportNewsFeed'))
{

    function trailReportNewsFeed($user_id,$subc_id)
    {
        $ci =& get_instance();
        $ci->load->database();
         $subcid ='';
        if(!empty($subc_id)){
            $subcid = "and tbl_subscribe_user.subc_id =".$subc_id.""; 
        }else{
           $subcid = ''; 
        }
        $sql = "SELECT `tbl_user_master`.profile_picture,`tbl_user_master`.address,`tbl_user_master`.fname,`tbl_user_master`.lname,`tbl_user_master`.user_id,`tbl_user_master`.email, `trail_report_user_update`.trail_report_created_date as `n_date`, `trail_report_user_update`.trail_report_status, `trail_report_user_update`.trail_report_conditions, `trail_report_user_update`.CountyID,`trail_report_user_update`.state_name,`trail_report_user_update`.userID,`tbl_subscribe_user`.`subc_id`,`tbl_subscribe_user`.`subc_user_id`,`tbl_subscribe_user`.`trail_type`,`tbl_subscribe_user`.`trail_name`,`tbl_subscribe_user`.`subc_user_email`,`tbl_subscribe_user`.`subc_date`,`tbl_subscribe_user`.`subc_status`,`tbl_subscribe_user`.`view_status` FROM `trail_report_user_update` LEFT JOIN `tbl_user_master` ON `trail_report_user_update`.`userID`=`tbl_user_master`.`user_id` LEFT JOIN `tbl_subscribe_user` ON `trail_report_user_update`.`CountyID`=`tbl_subscribe_user`.`trail_name` LEFT JOIN trail_report_user_update m2 ON (trail_report_user_update.`CountyID` = m2.`CountyID` AND trail_report_user_update.`trail_report_created_date` < m2.`trail_report_created_date`) WHERE trail_report_user_update.`trail_report_status` = 1 and tbl_subscribe_user.trail_type = 'trail_report' and tbl_subscribe_user.subc_user_id = ".$user_id." ".$subcid." and tbl_subscribe_user.view_status = 0 and m2.`trail_report_created_date` IS NULL ORDER BY `trail_report_user_update`.`ID` DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();              
        return $array;    
        
    }

}

if (!function_exists('home_trailNewsFeed'))
{

    function home_trailNewsFeed($user_id,$subc_id)
    {
        $ci =& get_instance();
        $ci->load->database();
         $subcid ='';
        if(!empty($subc_id)){
            $subcid = "and tbl_subscribe_user.subc_id =".$subc_id.""; 
        }else{
           $subcid = ''; 
        }
        $sql = "SELECT `tbl_user_master`.profile_picture,`tbl_user_master`.address,`tbl_user_master`.fname,`tbl_user_master`.lname,`tbl_user_master`.user_id,`tbl_user_master`.email,`tbl_trail_report`.created_date as `n_date`,`tbl_trail_report`.status,`tbl_trail_report`.trail_status,`tbl_trail_report`.trail_description,`tbl_trail_report`. trail_name,`tbl_trail_report`. user_id,`tbl_subscribe_user`.`subc_id`,`tbl_subscribe_user`.`subc_user_id`,`tbl_subscribe_user`.`trail_type`,`tbl_subscribe_user`.`trail_name`,`tbl_subscribe_user`.`subc_user_email`,`tbl_subscribe_user`.`subc_date`,`tbl_subscribe_user`.`subc_status`,`tbl_subscribe_user`.`view_status` 
    FROM `tbl_trail_report`
    LEFT JOIN `tbl_user_master` ON `tbl_trail_report`.`user_id`=`tbl_user_master`.`user_id`
    LEFT JOIN `tbl_subscribe_user` ON `tbl_trail_report`.`trail_name`=`tbl_subscribe_user`.`trail_name` 
    LEFT JOIN tbl_trail_report m2 ON (tbl_trail_report.`trail_name` = m2.`trail_name` AND tbl_trail_report.`created_date` < m2.`created_date`)

    WHERE `tbl_trail_report`.`status` = 1 and tbl_subscribe_user.trail_type = 'trail' and tbl_subscribe_user.subc_user_id = ".$user_id." ".$subcid." and tbl_subscribe_user.view_status != 4  and m2.`created_date` IS NULL
    ORDER BY `tbl_trail_report`.`trail_report_id` DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array(); 
       
        return $array;    
        
    }

}

if (!function_exists('trailNewsFeed'))
{

    function trailNewsFeed($user_id,$subc_id)
    {
        $ci =& get_instance();
        $ci->load->database();
         $subcid ='';
        if(!empty($subc_id)){
            $subcid = "and tbl_subscribe_user.subc_id =".$subc_id.""; 
        }else{
           $subcid = ''; 
        }
        $sql = "SELECT `tbl_user_master`.profile_picture,`tbl_user_master`.address,`tbl_user_master`.fname,`tbl_user_master`.lname,`tbl_user_master`.user_id,`tbl_user_master`.email,`tbl_trail_report`.created_date as `n_date`,`tbl_trail_report`.status,`tbl_trail_report`.trail_status,`tbl_trail_report`.trail_description,`tbl_trail_report`. trail_name,`tbl_trail_report`. user_id,`tbl_subscribe_user`.`subc_id`,`tbl_subscribe_user`.`subc_user_id`,`tbl_subscribe_user`.`trail_type`,`tbl_subscribe_user`.`trail_name`,`tbl_subscribe_user`.`subc_user_email`,`tbl_subscribe_user`.`subc_date`,`tbl_subscribe_user`.`subc_status`,`tbl_subscribe_user`.`view_status` 
    FROM `tbl_trail_report`
    LEFT JOIN `tbl_user_master` ON `tbl_trail_report`.`user_id`=`tbl_user_master`.`user_id`
    LEFT JOIN `tbl_subscribe_user` ON `tbl_trail_report`.`trail_name`=`tbl_subscribe_user`.`trail_name` 
    LEFT JOIN tbl_trail_report m2 ON (tbl_trail_report.`trail_name` = m2.`trail_name` AND tbl_trail_report.`created_date` < m2.`created_date`)

    WHERE `tbl_trail_report`.`status` = 1 and tbl_subscribe_user.trail_type = 'trail' and tbl_subscribe_user.subc_user_id = ".$user_id." ".$subcid." and tbl_subscribe_user.view_status = 0  and m2.`created_date` IS NULL
    ORDER BY `tbl_trail_report`.`trail_report_id` DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array(); 
       
        return $array;    
        
    }

}

if (!function_exists('notification_forum'))
{

    function notification_forum($user_id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $sql = "SELECT forum_comment.*,tbl_user_master.*,forum_question.*,forum_category.*, notification.notification_update_date as n_date,notification.user_id, notification.notification_status,notification.notificate_type,notification.notificate_type_id,notification.notification_id From notification 
        JOIN forum_comment on notification.notificate_type_id = forum_comment.forum_comment_id 
        JOIN tbl_user_master on forum_comment.user_id = tbl_user_master.user_id 
        JOIN forum_question on  forum_question.forum_ques_id = forum_comment.forum_ques_id  
        JOIN forum_category on  forum_category.forum_cat_id = forum_comment.forum_cat_id    
        WHERE notification.user_id =".$user_id." and  notification.notification_status = 0 and notification.n_cat_type = 'forum' ORDER BY notification.notification_id DESC";
        $result = $ci->db->query($sql);     
        $array = $result->result_array();   
         return array_reverse($array);    
        
    }

}



if (!function_exists('sendingMail'))
{
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
}
?>