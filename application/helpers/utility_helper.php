<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function get_current_datetime() {
        $CI = & get_instance(); //get instance, access the CI superobject
        $data = $CI->db->where(array('id'=>1))->get('tbl_timezone')->row();
        if(isset($data) && !empty($data)){
          date_default_timezone_set($data->country);
        }else{
           date_default_timezone_set("Asia/Kolkata");
         }
        return $date=date('Y-m-d G:i:s');
    }


/*if (!function_exists('getCurrentDateTime')) {
   date_default_timezone_set("Asia/Kolkata");
    $date=date('Y-m-d G:i:s');
    function get_current_datetime($date) {
        return $date;
    }
}*/
if (!function_exists('getNotificationTypeId')) {

    function getNotificationTypeId($booking_type='') {
        $CI = & get_instance(); //get instance, access the CI superobject
        $data = $CI->db->where(array('notification_name'=>$booking_type))->get('master_notification_type')->row();
       
        if ($data) {           
            return $data->notification_type_id;
        }
        return '';
    }
}
if (!function_exists('calculate_time_span'))
{
    function calculate_time_span($date) {
       $seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($date);
       $months = floor($seconds / (3600 * 24 * 30));
       $day = floor($seconds / (3600 * 24));
       $hours = floor($seconds / 3600);
       $mins = floor(($seconds - ($hours * 3600)) / 60);
       $secs = floor($seconds % 60);

       if ($seconds < 60)
           $time = $secs . " secs ago";
       else if ($seconds < 60 * 60) {
           $time = $mins . " min ago"; 
           if($mins > 1) {
               $time = $mins . " mins ago"; 
           }
       }
       else if ($seconds < 24 * 60 * 60) {
           $time = $hours . " hour ago"; 
           if($hours > 1) {
                 $time = $hours . " hours ago"; 
           }
       }
       else if ($day > cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'))) {
           $time = $months . " month ago";
           if($months > 1) {
                $time = $months . " months ago";
           }
       }  
       else {
           $time = $day . " day ago";
           if($day > 1) {
              $time = $day . " days ago"; 
           }

       }
       return $time;
    }
}