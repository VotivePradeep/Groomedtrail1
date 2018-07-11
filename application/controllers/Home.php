<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
     
    parent::__construct();

    $this->load->library('session');
    $info=$this->session->all_userdata();
     if(empty($info['user_id'])){
           redirect(base_url());
    }
    $this->load->model('model');
     $this->load->model('common_socialviralposts');
    $this->load->library('form_validation');
    $this->load->library("pagination");
    $this->load->helper('file');
    $this->load->helper('custom_helper');
    $this->load->library('Ajax_pagination');

    if(isset($info['siterole']))
    {
    
      if( ($info['siterole']==2) )
      {
        $this->userId = $info['user_id'];
        if(isset($info['social_id'])){
           $this->social_id = $info['social_id'];
        }
            
      }else if($info['siterole']==3){
        $this->userId = $info['user_id'];
        if(isset($info['social_id'])){
           $this->social_id = $info['social_id'];
        }

      }else if($info['siterole']==1){
        $info = $this->session->all_userdata();
        $this->session->sess_destroy($info);
        redirect(base_url());
      }else{
        redirect(base_url());
      }
      
    }
    
  }

  public function index(){

  	$data['pagetitle'] = 'Home';
    $data['segment']= $this->uri->segment(1);
    if(isset($this->userId)){
    	 $data['user_id'] = $this->userId;
    }
   $data['POIList'] = $this->model->get_data_order_by('*', 'tbl_trail_type_master
         ',array('trail_status' =>1),'trail_id','ASC');

    $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>1),'seo_setting.meta_id','desc'); 
    
    $where = array('user_id' =>$data['user_id']);
    $data['routeList'] = $this->model->get_data_order_by('*', 'tbl_user_route_planning
         ',$where,'URP_ID','DESC');
    
    $data['routelatlang'] = $this->model->get_row('tbl_user_route_planning',array('URP_ID' => base64_decode($_GET['id'])));

   $query=$this->db->query("SELECT tbl_kml_data_trail.*, tbl_trail_master.* FROM `tbl_trail_master` Join tbl_kml_data_trail on tbl_trail_master.trail_type_id = tbl_kml_data_trail.trail_id WHERE tbl_trail_master.`trail_kml_upload_by` = ".$data['user_id']." group by description ORDER BY tbl_trail_master.`trail_type_id` DESC");
    $data['boondockingTrails']=$query->result();
    $this->load->view('frontend/homepage', $data);
	}
   public function mymap(){
   $data['pagetitle'] = 'my map';
   
   $data['segment']= $this->uri->segment(1);
    if(isset($this->userId)){
       $data['user_id'] = $this->userId;
    }
   $data['mapdata'] = $this->model->get_all('*','tbl_kml_data_trail');
  
  // print_r($data['mapdata']);
   $this->load->view('map', $data);

  }
  
  public function cmspage(){

    $data['segment']= $this->uri->segment(1);
    $data['basesegment']= $this->uri->segment(2);
    $data["pageDetail"] = $this->model->get_data('*', 'tbl_cms_pages', array('slag' => $data['basesegment'])); 
    if(isset($data["pageDetail"][0]->page_name)){
      $data['pagetitle'] = $data["pageDetail"][0]->page_name;
    }
    
    if(isset($this->userId)){
       $data['user_id'] = $this->userId;
    }
    $this->load->view('frontend/page', $data);
  }
 
/***************************** my news ***************************/
  public function mynews(){

    $data['pagetitle'] = 'My News';
    $data['segment']= $this->uri->segment(1);
    
    if(isset($this->userId)){
       $data['user_id'] = $this->userId;
    }

    $data['latestNewsList'] = $this->model->get_all_limit('*', 'tbl_news',array('news_status'=>1),'news_id','DESC', 3);
    /*$where1 = array(1=>1);
    $data['popularforumQuestion'] =  $this->common_socialviralposts->jointhreetable('forum_question','forum_cat_id','forum_category','forum_cat_id','tbl_user_master','user_id','user_id',$where1,'forum_question.date','desc','forum_question.*,forum_category.forum_cat_name,forum_category.forum_cat_url,tbl_user_master.*',0,8);*/
     $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>6),'seo_setting.meta_id','desc'); 
    
    $this->load->view('frontend/mynews',$data);
  }


  /***************************** my news Detail ***************************/

   public function newdetail(){

    $data['pagetitle'] = 'News Details';
    $data['segment']= $this->uri->segment(1);
    if(isset($this->userId)){
       $data['user_id'] = $this->userId;
    }
    $data['newsId']= $this->uri->segment(2);
     $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>6),'seo_setting.meta_id','desc'); 
    $data['newDetail'] = $this->model->join_where('tbl_news.*,tbl_user_master.user_id as userID,tbl_user_master.fname,tbl_user_master.lname', 'tbl_news','tbl_user_master','user_id','user_id',array('news_id'=>$data['newsId']),'news_id','desc');
    
    $data['latestNewsList'] = $this->model->get_all_limit('*', 'tbl_news',array('news_status'=>1),'news_id','DESC', 3);
    $Query = $this->db->query("SELECT DISTINCT(tbl_classified_images.`cls_id`), tbl_classified_images.cls_imag, tbl_classified_list.* FROM `tbl_classified_list` 
      LEFT JOIN tbl_classified_images ON tbl_classified_list.classified_id = tbl_classified_images.cls_id
      WHERE tbl_classified_list.`classified_status` = 1 GROUP BY tbl_classified_images.`cls_id` ORDER BY tbl_classified_list.classified_id DESC LIMIT 3") ;
    $data['latestClsList'] = $Query->result();
    $query1 = $this->db->query("SELECT `forum_question`.*, `forum_category`.`forum_cat_name`, `forum_category`.`forum_cat_url`, `tbl_user_master`.* FROM `forum_question` JOIN `forum_category` ON `forum_category`.`forum_cat_id` = `forum_question`.`forum_cat_id` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_question`.`user_id` ORDER BY `forum_question`.`date` DESC LIMIT 5");
    $data['popularforumQuestion'] = $query1->result();
//print_r($data['popularforumQuestion']);
    $this->load->view('frontend/news_detail',$data);
  }
 
  /***************************** Contact Us ***************************/

  public function contact(){

    $data['pagetitle'] = 'Contact us';
    $data['segment']= $this->uri->segment(1);
    if(isset($this->userId)){
       $data['user_id'] = $this->userId;
    }
    $data['contactUs'] = $this->model->get_row('tbl_cms_contact',array('id' => 1));
    $data['pageDetail'] = $this->model->get_data('*','tbl_cms_pages',array('id' => 12));
    $this->load->view('frontend/contact',$data);
  }

 
 
 /***************************** forums ***************************/
  
  public function forums(){

    $data['pagetitle'] = 'Forums';
    $data['segment']= $this->uri->segment(1);
    
    if(isset($this->userId)){
    	 $data['user_id'] = $this->userId;
    }
    $this->load->view('frontend/forums',$data);
  }
  /***************************** forums Details***************************/
  
  public function forumdetail(){

    $data['pagetitle'] = 'Forum Detail';
    $data['segment']= $this->uri->segment(1);
    if(isset($this->userId)){
    	 $data['user_id'] = $this->userId;
    }
    $this->load->view('frontend/forumdetail',$data);
  }

 /***************************** Vacational Business List***************************/
  public function vacationallist(){

  $data['pagetitle'] = 'Lodging';
  $data['segment']= $this->uri->segment(1);
  if(isset($this->userId)){
  $data['user_id'] = $this->userId;
  }
  $data["advanceFilter"] = $this->model->get_lodging();
  $query = $this->db->query("SELECT *, (SELECT AVG(rating) FROM tbl_review WHERE  bus_ID = tbl_vacation_list.vac_id and status=1) as `totalrating` FROM `tbl_vacation_list` where vac_status=1 and vac_expiry_date >= CURDATE() ORDER BY rand()");
  $data['businessList'] = $query->result();
  $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>8),'seo_setting.meta_id','desc'); 

  ////////////////////////pagination////////////////////////////////////////

  $this->load->view('frontend/vacation/vacationalbuslist.php',$data);
  }
   public function vacationalbusiness(){

    
    $data['segment']= $this->uri->segment(1);
    if(isset($this->userId)){
       $data['user_id'] = $this->userId;
    }
    $data['userDetailR']= $this->model->get_row('tbl_user_master',array('user_id' =>$data['user_id']));
    $segment = $this->uri->segment(2);
    $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>8),'seo_setting.meta_id','desc'); 
    
    $getID = $this->model->get_row('tbl_vacation_list', array('vac_slag'=>$segment));
    $data['busID'] = $getID->vac_id;
    
    $where = array('vac_id' =>$data['busID'] );
    $data['businessDetail'] = $this->model->join_where('tbl_vacation_list.*, tbl_user_master.*','tbl_vacation_list' ,'tbl_user_master','user_id','user_id',$where,'vac_id','DESC');

    if(isset($data['businessDetail'][0]->vac_name)){
       $data['pagetitle'] = $data['businessDetail'][0]->vac_name.'Vacation Rentals-Groomedtrail';
    }else{
     $data['pagetitle'] = 'Vacation Rentals-Groomedtrail';
    }
    
     /*$query = $this->db->query("SELECT tbl_user_master.fname,tbl_user_master.lname,tbl_user_master.profile_picture, tbl_review.* FROM tbl_review INNER JOIN tbl_user_master ON tbl_review.user_ID = tbl_user_master.user_id where tbl_review.bus_ID = ".$data['busID']." and tbl_review.status=1 order by review_ID DESC");
    $data['totalReview'] = $query->result();*/
    $query = $this->db->query("SELECT AVG(rating) as total FROM tbl_review WHERE bus_ID=".$data['busID']." and status=1");
    $data['avgReview'] = $query->result();

    $data['businessImage'] = $this->model->get_data('*','tbl_vacation_list_images', array('vac_id'=>$data['busID']));
    $this->load->view('frontend/vacation/vac_detail',$data);
  }
  public function login(){
    
     $data['pagetitle'] = 'Login';
     $this->load->view('frontend/login.php', $data);

  }

  /***************************** my events ***************************/
   public function event(){

    $data['pagetitle'] = 'Events';
    $data['segment']= $this->uri->segment(1);
   
    if(isset($this->userId)){
       $data['user_id'] = $this->userId;
    }
    $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>15),'seo_setting.meta_id','desc'); 
     // $data['eventList'] = $this->model->get_data('*',"tbl_event",array('event_status' => 1 ) );
     // $data['latestEventsList'] = $this->model->get_all_limit('*', 'tbl_event',array('event_status'=>1,'event_type'=>1),'event_id','DESC', 10);
    $query = $this->db->query("SELECT * FROM `tbl_event` WHERE `event_status` = 1 AND `event_type` = 1 and event_date > CURDATE() ORDER BY `event_id` DESC LIMIT 10");
    $data['latestEventsList'] = $query->result();

     $this->load->view('frontend/event/event',$data);
     }
    public function pastevents(){

    $data['pagetitle'] = 'Events';
    $data['segment']= $this->uri->segment(1);
    $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>15),'seo_setting.meta_id','desc'); 
    if(isset($this->userId)){
       $data['user_id'] = $this->userId;
    }

     $query = $this->db->query("SELECT * FROM `tbl_event` WHERE `event_status` = 1 AND `event_type` = 1 and event_date < CURDATE() ORDER BY `event_id` DESC LIMIT 10");
     $data['latestEventsList'] = $query->result();

     $this->load->view('frontend/event/event',$data);
     }


    function ajaxEventPaginationData()
    {
        $page = $this->input->post('page');
        $data['perPage'] = 3;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = count($this->model->paginationEvent());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'home/ajaxEventPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $data['perPage'];
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['eventList'] = $this->model->paginationEvent(array('start'=>$offset,'limit'=>$data['perPage']));
        
        //load the view
        $this->load->view('frontend/event/ajax_event_pagination', $data, false);
    }

  /***************************** my events Detail ***************************/

   public function eventdetail(){

    $data['pagetitle'] = 'Event Detail';
    $data['segment']= $this->uri->segment(1);
    $data['latestNewsList'] = $this->model->get_all_limit('*', 'tbl_news',array('news_status'=>1),'news_id','DESC', 4);
    if(isset($this->userId)){
       $data['user_id'] = $this->userId;
    }
    $data['eventId']= $this->uri->segment(2);
    $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>15),'seo_setting.meta_id','desc'); 
    $data['eventDetail'] = $this->model->get_data('*', 'tbl_event', array('event_id'=>$data['eventId']));
     $data['latestEventList'] = $this->model->get_all_limit('*', 'tbl_event',array('event_status'=>1),'event_id','DESC', 3);

     $data['eventsImage'] = $this->model->get_data('*','tbl_event_image', array('event_id'=>$data['eventId']));

    $this->load->view('frontend/event/events_detail',$data);
  }
  function classified(){
  $data['pagetitle'] = 'Classified';
  $data['segment']= $this->uri->segment(1);
  $data['segment2']= $this->uri->segment(2);
  $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>2),'seo_setting.meta_id','desc'); 
  if(isset($this->userId)){
       $data['user_id'] = $this->userId;
    }
  $data["classifiedList"] = $this->model->get_categories(); 
 // echo $this->db->last_query();
  $data['latestNewsList'] = $this->model->get_all_limit('*', 'tbl_news',array('news_status'=>1),'news_id','DESC', 4);
  $data['latestclassifiedList'] = $this->model->get_all_limit('*', 'tbl_classified_list',array('classified_status'=>1),'classified_id','DESC', 4);
  $this->load->view('frontend/classified/classified',$data); 
}
function classifiedcategory1(){
   $data['pagetitle'] = 'Classified Category';
   $data['segment']= $this->uri->segment(1);
   $data['segment2']= $this->uri->segment(2);
   $data['basesegment']= str_replace("-"," ",$this->uri->segment(2));
   if(isset($this->userId)){
      $data['user_id'] = $this->userId;
    }
    $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>2),'seo_setting.meta_id','desc'); 
   $this->load->view('frontend/classified/classified_category',$data); 
} 

function classifiedcategory(){
   $data['pagetitle'] = 'Classified Category';
   $data['segment']= $this->uri->segment(1);
   $data['segment2']= $this->uri->segment(2);
   $data['basesegment']= str_replace("-"," ",$this->uri->segment(2));
   if(isset($this->userId)){
      $data['user_id'] = $this->userId;
    }
  $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>2),'seo_setting.meta_id','desc'); 
  $this->load->view('frontend/classified/classified_category',$data); 
}
function classifiedetails(){
   $data['pagetitle'] = 'Classified Details';
   $data['segment']= $this->uri->segment(1);
   $data['segment2']= $this->uri->segment(2);
   $data['basesegment']= $this->uri->segment(3);
  // echo str_replace("-"," ",$data['basesegment']);
   if(isset($this->userId)){
     $data['user_id'] = $this->userId;
    }
   $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>2),'seo_setting.meta_id','desc'); 
   $data['userDetailR']= $this->model->get_row('tbl_user_master',array('user_id' =>$data['user_id']));
   $data['classified'] = $this->model->get_row('tbl_classified_list', array('url_slag'=>$data['basesegment']));
 
  $this->load->view('frontend/classified/classified_details',$data); 
}
function faq(){
   $data['pagetitle'] = 'FAQ';
   $data['segment']= $this->uri->segment(1);
   if(isset($this->userId)){
      $data['user_id'] = $this->userId;
    }
  $data['faqList'] = $this->model->get_data_order_by('*', 'tbl_faq', array('faq_status'=>1),'faq_id', 'desc');
  //$data["faqList"] = $this->model->get_data('*', 'tbl_faq', array('faq_status'=>1));
  $this->load->view('frontend/FAQ/faq',$data);

}


public function news_feed_details(){
   $data['pagetitle'] = 'Details';
   $data['segment']= $this->uri->segment(1);
   $sub_id= base64_decode($this->uri->segment(2));
   $user_id= base64_decode($this->uri->segment(3));
   if(isset($this->userId)){
      $data['user_id'] = $this->userId;
   }
   // $this->model->get_data_rl_join('tbl_user_master.*,tbl_trail_report.*', 'tbl_trail_report','tbl_user_master','user_id','user_id', array('tbl_trail_report.status' => 1,'tbl_trail_report.user_id'=>$data['user']),'  tbl_trail_report.trail_report_id','desc','LEFT');
    //$data["trailReportDetail"] =  //$this->model->get_data('*','trail_report_user_update', array('userID' => $data['user'],'trail_report_status' => 1));
   $data["trailDetail"] = array_merge(home_trailNewsFeed($user_id,$sub_id),
                                       home_trailReportNewsFeed($user_id,$sub_id) );
   //print_r($data["trailDetail"]);

   $this->load->view('frontend/news_feed_details/news_feed_details',$data);
}
}//class close