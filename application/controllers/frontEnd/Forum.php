<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class forum extends CI_Controller {
//class forum extends Base_Controller {
	
	//public $layout_view = 'layout/main';
	      
		function __construct(){

		parent::__construct();

		$this->load->library('session');
		$info=$this->session->all_userdata();
		
		if(empty($info['user_id'])){
		   redirect(base_url());
		}

		$this->load->model('common_socialviralposts');
		$this->load->model('model');
		$this->load->model('Common_model1');
		$this->load->helper('url');
		$this->load->helper('ckeditor');
		$this->load->helper('message_alert_helper');
		$this->load->helper('utility_helper');
		$this->load->library('Ajax_pagination');
		$this->load->helper('custom_helper');
		$this->load->library('layout');
		$this->load->library('pagination');
		$this->load->library('messages');

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
		  protected $extensionsAllowed;
		  
		  public function forum_comm_order(){
			  
	   $mainarry= $this->Common_model1->get_ff();

		// echo "<pre>";
		arsort($mainarry);
       foreach($mainarry AS $key=>$value){
		   echo "Key=" . $key . ", Value=" . $value;
		    echo "<br>";
	   }
		 die;
		  }
	public function index($cate , $url)
		{
       //  $rst=$this->Common_model1->get_ff();
		if(isset($this->userId)){
		   $data['user_id'] = $this->userId;
		}
			$data['pagetitle'] = 'Forum';
		$table1='forum_question';
		$table2='tbl_user_master';
		$select='forum_question.* ,tbl_user_master.*';
		$equeal='forum_question.user_id = tbl_user_master.user_id';
		$where1 =array('forum_question.forum_ques_url'=>$url);
        $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>4),'seo_setting.meta_id','desc'); 

		$data['single'] = $this->Common_model1->get_join_match_single_table($select,$table1,$table2,$equeal,$where1);
         
		 $where=array(
		 'forum_question.forum_ques_status'=>'Aproved',
		 'forum_question.forum_cat_id'=>$data['single']->forum_cat_id,
		 'forum_question.forum_ques_url !='=>$url
		 ); 
		  $where2=array(
		  //forum_question.forum_ques_status'=>'Aproved',
		  	1=>1
		 );
		 // view topic add record
		 $checklist=$this->Common_model1->get_single_data('forum_view',array('forum_cat_id'=>$data['single']->forum_cat_id,'forum_ques_id'=>$data['single']->forum_ques_id));
		    if($checklist){
				$forum_view_id=$checklist->forum_view_id;
				$forum_view_count=$checklist->forum_view_count;
				$forum_view_count= $forum_view_count+1;
				
				$this->Common_model1->update('forum_view',array('forum_view_count'=>$forum_view_count), array('forum_view_id'=>$forum_view_id) );
				
			} else{
				$this->Common_model1->insertdata('forum_view', array('forum_cat_id'=>$data['single']->forum_cat_id,'forum_ques_id'=>$data['single']->forum_ques_id, 'forum_view_count'=>'1', 'date'=>get_current_datetime()));
			}
	
		  $data['popularforumQuestion'] =  $this->common_socialviralposts->jointhreetable('forum_question','forum_cat_id','forum_category','forum_cat_id','tbl_user_master','user_id','user_id',$where2,'forum_question.date','desc','forum_question.*,forum_category.forum_cat_name,forum_category.forum_cat_url,tbl_user_master.*',0,5);

		   $queryPT = $this->db->query("SELECT COUNT(forum_comment.forum_ques_id) as total,forum_comment.forum_ques_id ,forum_question.forum_ques_status,forum_question.forum_ques_title, forum_question.forum_ques_id ,forum_category.forum_cat_url,forum_question.forum_ques_url FROM forum_question JOIN `forum_comment` on forum_question.forum_ques_id =forum_comment.forum_ques_id JOIN `forum_category` on forum_question. forum_cat_id =forum_category.forum_cat_id WHERE forum_question.forum_ques_status ='Aproved' GROUP by forum_comment.forum_ques_id ORDER by total DESC LIMIT 5");
		     $data['popularTopics']= $queryPT->result();
		 
		 
		 $data['latestpost'] =  $this->common_socialviralposts->jointhreetable('forum_question','forum_cat_id','forum_category','forum_cat_id','tbl_user_master','user_id','user_id',$where1,'forum_question.date','desc','forum_question.*,forum_category.forum_cat_name,forum_category.forum_cat_url,tbl_user_master.fname',0,3);
		 
		
		 $data['similarpost'] =  $this->common_socialviralposts->jointhreetable('forum_question','forum_cat_id','forum_category','forum_cat_id','tbl_user_master','user_id','user_id',$where,'forum_question.date','desc','forum_question.*,forum_category.forum_cat_name,forum_category.forum_cat_url,tbl_user_master.fname',0,3);
		 
		 $where1=array(
		 'forum_question.forum_ques_status'=>'Aproved',
		 );
		 $data['popularpost'] =  $this->common_socialviralposts->jointhreetable('forum_question','forum_cat_id','forum_category','forum_cat_id','tbl_user_master','user_id','user_id',$where1,'forum_question.date','desc','forum_question.*,forum_category.forum_cat_name,forum_category.forum_cat_url,tbl_user_master.fname',0,3);
		 
		
		$where = array(
		'forum_ques_id'=>$data['single']->forum_ques_id
		);

		// view topic add record

		$where_sub = array(
		'forum_ques_id'=>$data['single']->forum_ques_id, 'status'=>'1' );	

		$data['totalsubscribe'] = $this->common_socialviralposts->countwhereuser('forum_subscribe',$where_sub);
		$forum_topic_like = $this->common_socialviralposts->countwhereuser('forum_topic_like',$where);	  
		$forum_like = $this->common_socialviralposts->countwhereuser('forum_like',$where);
		$data['totallike'] = ($forum_topic_like + $forum_like);
		$data['likeusers'] = $this->common_socialviralposts->jointwotable('forum_like','user_id','tbl_user_master','user_id',$where,'tbl_user_master.*');

		$data['totalcomment'] = $this->common_socialviralposts->countwhereuser('forum_comment',$where);


		$where_sub_user = array(
		'forum_ques_id'=>$data['single']->forum_ques_id, 'user_id'=>$this->session->userdata('user_id') );	

		$data['user_subscribe'] = $this->Common_model1->get_single_data('forum_subscribe',$where_sub_user);

		$checklist=$this->Common_model1->get_single_data('forum_view',array('forum_cat_id'=>$data['single']->forum_cat_id,'forum_ques_id'=>$data['single']->forum_ques_id));

		$data['total_view'] = $checklist->forum_view_count;	

		// comment 
		
		$config['base_url'] = site_url('forum/'.$cate.'/'.$url);
        $config['total_rows'] =$this->Common_model1->get_forum_comment_count($data['single']->forum_ques_id); //$this->db->count_all('tbl_books');
        $config['per_page'] = "10";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
        // get books list
        $data['commentusers'] = $this->Common_model1->get_forum_comment($config["per_page"], $data['page'],$data['single']->forum_ques_id);
        
        $data['pagination'] = $this->pagination->create_links();
		
		$this->load->view('forum_questions_single',$data);
		 
		}		
		public function categoryList(){
			if(isset($this->userId)){
    	       $data['user_id'] = $this->userId;
            }	
             $data['pagetitle'] = 'Forum';
			 $where=array('forum_cat_status'=>'Aproved');			
			 $data['categories']=$this->Common_model1->get_all_where_category('forum_category',$where);	
			 $data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>4),'seo_setting.meta_id','desc'); 

			 $where1 = array(1 =>1);
			 $data['popularforumQuestion'] =  $this->common_socialviralposts->jointhreetable('forum_question','forum_cat_id','forum_category','forum_cat_id','tbl_user_master','user_id','user_id',$where1,'forum_question.date','desc','forum_question.*,forum_category.forum_cat_name,forum_category.forum_cat_url,tbl_user_master.*',0,5);
			  $queryPT = $this->db->query("SELECT COUNT(forum_comment.forum_ques_id) as total,forum_comment.forum_ques_id ,forum_question.forum_ques_status,forum_question.forum_ques_title, forum_question.forum_ques_id ,forum_category.forum_cat_url,forum_question.forum_ques_url FROM forum_question JOIN `forum_comment` on forum_question.forum_ques_id =forum_comment.forum_ques_id JOIN `forum_category` on forum_question. forum_cat_id =forum_category.forum_cat_id WHERE forum_question.forum_ques_status ='Aproved' GROUP by forum_comment.forum_ques_id ORDER by total DESC LIMIT 5");
		     $data['popularTopics']= $queryPT->result();
             $data['forum_heading']=$this->model->get_data('*','forum_heading',array('id'=>1));	
           // print_r($data['forum_heading']);
			//echo $this->db->last_query();
	        $this->load->view('forum_category', $data);	
		
		}
		
	 public function categoryPost($url){	

		if(isset($this->userId)){
		$data['user_id'] = $this->userId;
		}
		$data['pagetitle'] = 'Forums';
	      $where_q=array('forum_cat_url'=>$url);
			$table_q="forum_category";		
			$data['category']=$this->Common_model1->get_single_data($table_q,$where_q);			
	     // question list
		 $where=array(
		 'forum_question.forum_ques_status'=>'Aproved',
		 'forum_category.forum_cat_url'=>$url,
		 );
		$data['meta_setting'] = $this->model->join_where('*', 'seo_setting','page_list','page_id','page_id',array('seo_setting.page_id'=>4),'seo_setting.meta_id','desc'); 
		/*
		 $data['forumQuestions'] =  $this->common_socialviralposts->jointhreetableforum('forum_question','forum_cat_id','forum_category','forum_cat_id','tbl_user_master','user_id','user_id',$where,'forum_question.forum_ques_id','desc','forum_question.*,forum_category.forum_cat_name,forum_category.forum_cat_url,tbl_user_master.*',0,8);
		*/
	
		 $where1=array(
		 //'forum_question.forum_ques_status'=>'Aproved',
		 	1=>1
		 );
		 $data['popularforumQuestion'] =  $this->common_socialviralposts->jointhreetable('forum_question','forum_cat_id','forum_category','forum_cat_id','tbl_user_master','user_id','user_id',$where1,'forum_question.date','desc','forum_question.*,forum_category.forum_cat_name,forum_category.forum_cat_url,tbl_user_master.*',0,5);

		  $queryPT = $this->db->query("SELECT COUNT(forum_comment.forum_ques_id) as total,forum_comment.forum_ques_id ,forum_question.forum_ques_status,forum_question.forum_ques_title, forum_question.forum_ques_id ,forum_category.forum_cat_url,forum_question.forum_ques_url FROM forum_question JOIN `forum_comment` on forum_question.forum_ques_id =forum_comment.forum_ques_id JOIN `forum_category` on forum_question. forum_cat_id =forum_category.forum_cat_id WHERE forum_question.forum_ques_status ='Aproved' GROUP by forum_comment.forum_ques_id ORDER by total DESC LIMIT 5");
		     $data['popularTopics']= $queryPT->result();
		 
		  $data['latestforumQuestion'] =  $this->common_socialviralposts->jointhreetable('forum_question','forum_cat_id','forum_category','forum_cat_id','tbl_user_master','user_id','user_id',$where1,'forum_question.date','desc','forum_question.*,forum_category.forum_cat_name,tbl_user_master.fname,forum_category.forum_cat_url',0,3);
	 
	     // for category image 
		 	$where2=array('forum_cat_url' => $url);
			$table2="forum_category";
			
			$data['category']=$this->Common_model1->get_single_data($table2,$where2);
						
		 // Count article
	         $data['latestpostcount'] = $this->latestpost_count($url);
			 
			 
			 
			        // comment 
	
		$config['base_url'] = site_url('forum/'.$url);
        $config['total_rows'] =$this->Common_model1->get_forum_topic_count($url); //$this->db->count_all('tbl_books');
        $config['per_page'] = "5";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // get books list
        $data['forumQuestions'] = $this->Common_model1->get_forum_topic_12($config["per_page"], $data['page'],$url);
        
        $data['pagination'] = $this->pagination->create_links();
		 	 
	    $this->load->view('forum_category_single',$data);	 
	 
	 }
	 
	 function latestpost_count($forum_cat_id=null){
		
		 if($forum_cat_id == 0) {
			  $where1 = array(
		 'forum_question.forum_ques_status'=>'Aproved'
		 );
			 
		 } else{
			 $where1 = array(
		 'forum_question.forum_ques_status'=>'Aproved', 'forum_question.forum_cat_id'=>$forum_cat_id ); 
		 }
		 
	 	
         $latestpost_count=$this->common_socialviralposts->jointhreetable(' forum_question','forum_cat_id',' forum_category','forum_cat_id',' tbl_user_master','user_id','user_id',$where1,' forum_question.forum_ques_id','desc','*');
		  
		 return count($latestpost_count);
	 }
	 
 public function like(){
		 
	     if($this->session->userdata('user_id')){
	     $forum_ques_id = $_POST['forum_ques_id'];
	     $forum_cat_id = $_POST['forum_cat_id'];
	     $forum_comment_id = $_POST['forum_comment_id'];
		
		 $where = array('user_id'=>$this->session->userdata('user_id'),
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id,
		          'forum_comment_id'=>$forum_comment_id);
				
		 $total = $this->common_socialviralposts->countwhereuser('forum_like',$where);
		 
		 if($total==0){
		     $insert = array(
			      'user_id'=>$this->session->userdata('user_id'),
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id,
		          'forum_comment_id'=>$forum_comment_id,
		          'forum_like_status'=>'Aproved',
			      'date'=>get_current_datetime()
			 );
			 $this->common_socialviralposts->insertData('forum_like',$insert);
			 
			 $where1 = array(
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id,
		          'forum_comment_id'=>$forum_comment_id);
				  
			 $totalcommentlike=$this->common_socialviralposts->countwhereuser('forum_like',$where1);
	 
			 $where2 = array(
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id);
				  
			  $forum_like=$this->common_socialviralposts->countwhereuser('forum_like',$where2);
			 $forum_topic_like=$this->common_socialviralposts->countwhereuser('forum_topic_like',$where2);
			 $totallike = $forum_like + $forum_topic_like;
		 	 $return = array ('code' => '200','commlike'=>$totalcommentlike,'total'=>$totallike,'msg'=>$forum_ques_id );
		    
			}else{			 
			$this->db->query(" DELETE FROM forum_like where forum_ques_id =".$forum_ques_id." AND forum_cat_id=".$forum_cat_id." AND forum_comment_id=".$forum_comment_id." AND user_id=".$this->session->userdata('user_id')."");

			 $where1 = array(
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id,
		          'forum_comment_id'=>$forum_comment_id);
				  
			 $totalcommentlike=$this->common_socialviralposts->countwhereuser('forum_like',$where1);
	 
			 $where2 = array(
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id);
				  
			 $forum_like=$this->common_socialviralposts->countwhereuser('forum_like',$where2);
			 $forum_topic_like=$this->common_socialviralposts->countwhereuser('forum_topic_like',$where2);
			 $totallike =  $forum_like + $forum_topic_like;

			 $return = array ('code' => '300','commlike'=>$totalcommentlike,'total'=>$totallike,'msg'=>$forum_ques_id );
				 
			 }

	     }else{ 
		      $return = array ('code' => '400',
		       'msg'=>'Please login first' 
		       );
		
		 }   
	     echo json_encode($return);
	 }	 
	 	 

	 	 public function forum_topic_like(){
		 
	     if($this->session->userdata('user_id')){
	     $forum_ques_id = $_POST['forum_ques_id'];
	     $forum_cat_id = $_POST['forum_cat_id'];
	   
		 $where = array('user_id'=>$this->session->userdata('user_id'),
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id);
				
		 $total = $this->common_socialviralposts->countwhereuser('forum_topic_like',$where);
		 
		 if($total==0){
		     $insert = array(
			      'user_id'=>$this->session->userdata('user_id'),
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id,
		          'forum_like_status'=>'Aproved',
			      'date'=>get_current_datetime()
			 );
			 $this->common_socialviralposts->insertData('forum_topic_like',$insert);
			 
			 $where1 = array(
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id);
				  
			 $totalcommentlike=$this->common_socialviralposts->countwhereuser('forum_topic_like',$where1);
	 
			 $where2 = array(
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id);
				  
			 $forum_topic_like=$this->common_socialviralposts->countwhereuser('forum_topic_like',$where2);
			 $forum_like=$this->common_socialviralposts->countwhereuser('forum_like',$where2);
			 $totallike = $forum_topic_like + $forum_like;
		 	 $return = array ('code' => '200','commlike'=>$totalcommentlike,'total'=>$totallike,'msg'=>$forum_ques_id );
		    
			}else{			 
			$this->db->query(" DELETE FROM forum_topic_like where forum_ques_id =".$forum_ques_id." AND forum_cat_id=".$forum_cat_id." AND user_id=".$this->session->userdata('user_id')."");

			 $where1 = array(
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id);
				  
			 $totalcommentlike=$this->common_socialviralposts->countwhereuser('forum_topic_like',$where1);
	 
			 $where2 = array(
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id);
				  
			 $forum_topic_like=$this->common_socialviralposts->countwhereuser('forum_topic_like',$where2);
             $forum_like=$this->common_socialviralposts->countwhereuser('forum_like',$where2);
             $totallike = ($forum_topic_like + $forum_like);
			 $return = array ('code' => '300','commlike'=>$totalcommentlike,'total'=>$totallike,'msg'=>$forum_ques_id );
			 /*$return = array ('code' => '300',
						'msg'=>$forum_ques_id 
						);*/
			 
			 }

	     }else{ 
		      $return = array ('code' => '400',
		       'msg'=>'Please login first' 
		       );
		
		 }   
	     echo json_encode($return);
	 }

	 
	 public function comment(){
		  
		 $forum_cat_id = $_POST['forum_cat_id'];
	     $forum_comment_description = $_POST['forum_comment_description'];
	     $forum_ques_id = $_POST['forum_ques_id'];	
	    	
           $url=$this->input->post('url');		
          
		  if(empty($forum_comment_description)){
			  $this->session->set_flashdata('msg_error','Faild: Comment is empty!'); 
					redirect($url); 
			  
		  }
		  
		 if($this->session->userdata('user_id')){
        $insert = array(
			 'user_id'=>$this->session->userdata('user_id'),
		     'forum_comment_description'=>$forum_comment_description,
		     'forum_ques_id'=>$forum_ques_id,
		     'forum_cat_id'=>$forum_cat_id,
		     'forum_comment_status'=>'Aproved',
			 'date'=>get_current_datetime()
			 );
			
			
			// for child comments
               if(isset($_POST['forum_comment_id']) && !empty($_POST['forum_comment_id'])){
				     $insert['forum_comment_parent_id'] = $_POST['forum_comment_id']; 
				     $insert['comment_type'] = "child"; 
					
			   }else{
				$insert['comment_type'] = "parent";    
			   }	
			   
				if(isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name'])){

					$post_name_img_name=$time='forum_comment_'.$forum_ques_id.'_'.time();

					$path_parts = pathinfo($_FILES["upload"]["name"]);
					$image_path = $post_name_img_name.'.'.$path_parts['extension'];
					
					$config['file_name'] = $image_path;
					$config['upload_path']  = './assets/editor_images/';

					$config['allowed_types']  = 'gif|jpg|jpeg|png|pdf|bmp|GIF|JPG|PNG|JPEG|PDF|mp4|docx|doc|DOC|DOCX|txt';          ///3gp|flv|mp3|wma|wmv
					$this->load->library('upload', $config);
					 $data=$this->upload->do_upload('upload');	
							
					// $insert['forum_comment_file']=$image_path;

					if($this->upload->do_upload('upload')){
					    $uploadData = $this->upload->data();
					    $insert['forum_comment_file'] = $uploadData['file_name'];
					    
					  
					}else{
					  $error_msg= $this->upload->display_errors();
					    $this->session->set_flashdata('msg_error',$error_msg); 
						redirect($url);
					}

				}

				$result=$this->common_socialviralposts->insertData('forum_comment',$insert);
				$lastID = $this->db->insert_id();
				$forumQuesCreatUser=$this->Common_model1->get_single_data('forum_question',array('forum_ques_id' => $forum_ques_id));

				$frmnotify['notificate_type_id'] = $lastID;
				$frmnotify['notificate_type'] = 'forum';
				$frmnotify['n_cat_type'] = 'forum';
				$frmnotify['user_id'] = $forumQuesCreatUser->user_id;
				$frmnotify['notification_update_date'] = get_current_datetime();
                $this->common_socialviralposts->insertData('notification',$frmnotify);

				if($result){
					$where45=array('user_id' => $this->session->userdata('user_id'));
					$table45="tbl_user_master";
					$user=$this->Common_model1->get_single_data($table45,$where45);
					$date=get_current_datetime();
					$date=date_format(date_create($date), 'd F, Y H:i:s'); 				
					 $this->session->set_flashdata('msg_success', "Your comment has been successfully posted");

				// redirect($url,'refresh');	
				}
				// notification mail for all subscriber people one by one
				$selects="tbl_user_master.email,tbl_user_master.fname,tbl_user_master.user_id as id";
				$table1s="tbl_user_master";
				$table2s="forum_subscribe";
				$equeals="tbl_user_master.user_id=forum_subscribe.user_id";
				$wheres=array('forum_subscribe.forum_ques_id'=>$forum_ques_id, "forum_subscribe.status"=>'1');
				$subscribe = $this->Common_model1->get_join_match_table($selects,$table1s,$table2s,$equeals,$wheres);
                if(isset($subscribe) && !empty($subscribe)){
                   foreach ($subscribe as $s) {
						$frmnotify['notificate_type_id'] = $lastID;
						$frmnotify['notificate_type'] = 'forum';
						$frmnotify['user_id'] = $s->id;
						$frmnotify['n_cat_type'] = 'forum';
						$frmnotify['notification_update_date'] = get_current_datetime();
		                $this->common_socialviralposts->insertData('notification',$frmnotify);
	                }
                }

                $row11 =  $this->Common_model1->get_single_data('tbl_user_master',array('user_id'=>$forum_ques->user_id));
                $forum_ques=$this->Common_model1->get_single_data('forum_question',array('forum_cat_id'=>$forum_cat_id,'forum_ques_id'=>$forum_ques_id));
				$forum_ques_title=$forum_ques->forum_ques_title;
	           
				//Form Reply comment email
				$row =  $this->Common_model1->get_single_data('email_templates',array('title'=>'ReplyForumComment'));
				$row11 =  $this->Common_model1->get_single_data('tbl_user_master',array('user_id'=>$forum_ques->user_id));
				$subject = $row->subject;
				$content= $row->content;

               /* $cat_url = $this->Common_model1->get_single_data('forum_category',array('forum_cat_id'=>$forum_ques->forum_cat_id));
				$link12 = base_url().'forum/'.$cat_url->forum_cat_url.'/'.$forum_ques->forum_ques_url;*/

				 // for subscriber send mail
				$this->subscribe_user_list($subscribe , $url, $forum_ques_title, $_POST['forum_comment_description'], $row11->email);


				$content= str_replace("{topic_name}", $forum_ques_title,$content);
				$content= str_replace("{page_link}", $url,$content);
				$content= str_replace("{reply_msg}", $_POST['forum_comment_description'],$content);
				$content= str_replace("{username}",$row11->fname,$content);
				$content= str_replace("{user_email_address}",$row11->email,$content);
				$this->sendingMail($row11->email, $subject, $content);

				
	 
		 redirect($url);
	     }else{
			  
			 $this->session->set_flashdata('msg_error', "Faild! Post"); 
		
		 }
		
		redirect($url);
		
	
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
	  public function comment_update(){
		
		 $forum_comment_description=$this->input->post('returnComment');
		  $forum_comment_id=$this->input->post('forum_comment_id');
		  $url=$this->input->post('url');
		 if(!empty($forum_comment_description)) {
			
			
			$insert=array('forum_comment_description'=>$forum_comment_description, "date"=>get_current_datetime());
			
			if(isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name'])){

			$post_name_img_name=$time='forum_comment_'.$forum_ques_id.'_'.time();

			$path_parts = pathinfo($_FILES["upload"]["name"]);
			$image_path = $post_name_img_name.'.'.$path_parts['extension'];
			$config['file_name'] = $image_path;
			$config['upload_path']  = './assets/editor_images/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|bmp|GIF|JPG|PNG|JPEG|PDF|mp4|docx|doc|DOC|DOCX|txt';          ///3gp|flv|mp3|wma|wmv
			$this->load->library('upload', $config);
			$data=$this->upload->do_upload('upload');				
			// $insert['forum_comment_file']=$image_path;

			if($this->upload->do_upload('upload')){
			        $uploadData = $this->upload->data();
			        $insert['forum_comment_file'] = $uploadData['file_name'];
			        
			      
			    }else{
			      $error_msg= $this->upload->display_errors();
					 $this->session->set_flashdata('msg_error',$error_msg); 
					redirect($url);
			    }

			}
		
		 $result=$this->Common_model1->update('forum_comment',$insert, array('forum_comment_id'=>$forum_comment_id) );
		 if($result){
		  $this->session->set_flashdata('msg_success', "Your comment has been successfully updated");
		 } else{
			  $this->session->set_flashdata('msg_error', "Faild! Post"); 
		 }
		 } else{
			 $this->session->set_flashdata('msg_error', "Faild! Post"); 
            redirect($url);
		 }
		 redirect($url);
		 
	 }
  function getmorepost(){
	
		$forum_cat_id=$_POST['forum_cat_id'];
		
	    if($forum_cat_id == 0) {
			  $where1 = array(
		 'forum_question.forum_ques_status'=>'Aproved' );
			 
		 } else{
			 $where1 = array(
		 'forum_question.forum_ques_status'=>'Aproved', 'forum_question.forum_cat_id'=>$forum_cat_id ); 
		 }
		 
	     $start =$this->input->post('offset');
	     $latestpostcount = $this->latestpost_count($forum_cat_id);
	     if($latestpostcount > $start ){
		 
		     $data['latestpost'] =  $this->common_socialviralposts->jointhreetable(' forum_question','forum_cat_id',' forum_category','forum_cat_id',' tbl_user_master','user_id','user_id',$where1,' forum_question.forum_ques_id','desc',' forum_question.*, tbl_user_master.fname, forum_category.forum_cat_url',$start,6);
			
		     $this->load->view('latestpost_category_ajax',$data);
			 
		 }else{
		   echo 'false';
		 
		 }
	 
	 }
	  public function topiccheckAlready(){
		 $forum_ques_title=$_POST['forum_ques_title'];
		$forum_ques_url=$this->clean_string($forum_ques_title);		
		$result=$this->Common_model1->get_all_data_count('forum_question',array('forum_ques_url'=>$forum_ques_url));

		   $campaign_all_count=count($result);
			
			if($campaign_all_count >0){
			echo "false";
                die;			
			} else{
			echo "true";
                die;			
			}			
	  }
	  
	  
	public function addnewTopic(){

		if($_POST){
			if(empty($_POST['forum_ques_id'])){
				$forum_ques_url=$this->clean_string($this->input->post('forum_ques_title'));
		        $data = array(
				  "forum_ques_title"=>$this->input->post('forum_ques_title'),
				  "forum_cat_id"=>$this->input->post('forum_cat_id'),
				  "forum_ques_url"=>$forum_ques_url,				 
				  "forum_ques_description"=>$this->input->post('forum_ques_description'),				 
				  "user_id"=>$this->session->userdata('user_id'),				 
				  "forum_ques_status"=>'Panding',				 
				  "date"=>get_current_datetime()
				  );

				///////////image Upload //////////////
				/*if(isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name'])){

				$post_name_img_name=$time='forum_topic_'.time();

				$path_parts = pathinfo($_FILES["upload"]["name"]);
				$image_path = $post_name_img_name.'.'.$path_parts['extension'];
				$config['file_name'] = $image_path;
				$config['upload_path']  = './assets/editor_images/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|bmp|GIF|JPG|PNG|JPEG|PDF|mp4|docx|doc|DOC|DOCX|txt';          ///3gp|flv|mp3|wma|wmv
				$this->load->library('upload', $config);
				$data=$this->upload->do_upload('upload');				
				// $insert['forum_comment_file']=$image_path;

				if($this->upload->do_upload('upload')){
				        $uploadData = $this->upload->data();
				        $data['forum_topic_file'] = $uploadData['file_name'];
				        
				      
				    }else{
				      $error_msg= $this->upload->display_errors();
						 $this->session->set_flashdata('msg_error',$error_msg); 
						redirect($url);
				    }

				}*/
				if((!empty($_FILES["upload"])) && isset($_FILES['upload']['name']))  					   
			    {
				if($_FILES['upload']['error']==0)
				{
					$filename  = basename($_FILES['upload']['name']);
					$extension = pathinfo($filename, PATHINFO_EXTENSION);
					$image_name     = time().'.'.$extension;
					$image_path = 'upload/Forum_topic/'.$image_name;
					$data['forum_topic_file'] =$image_path;
					move_uploaded_file($_FILES['upload']['tmp_name'] ,$image_path);
				 }
				}



				///////////image Upload //////////////

				  
		        $result = $this->Common_model1->insertdata('forum_question',$data);
				
				if($result){
					 $this->session->set_flashdata('msg_success', messages::TOPIC_CREATED);
					 $query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=17");
					$subAdminEmail = $query->result();
                    
					if(isset( $subAdminEmail)){
                    	foreach ($subAdminEmail as $semail) {

		                    $row1 =  $this->model->get_row('email_templates',array('title'=>'AddNewForumTopic'));
							$subject = $row1->subject;
							$content = $row1->content;
							$content= str_replace("{topic_name}", $this->input->post('forum_ques_title'),$content);
							$content= str_replace("{description}", $this->input->post('forum_ques_description'),$content);
							$content= str_replace("{username}",ucfirst($semail->fname),$content);
							$content= str_replace("{user_email_address}",$semail->email,$content);
							$this->sendingMail($semail->email, $subject, $content);

                        }
                    }
                    $query = $this->db->query("SELECT fname,email,user_id from tbl_user_master WHERE siterole_id =1 AND user_id=1");
                    $adminEmail = $query->result();
                    $row1 =  $this->model->get_row('email_templates',array('title'=>'AddNewForumTopic'));
					$subject = $row1->subject;
					$content = $row1->content;
					$content= str_replace("{topic_name}", $this->input->post('forum_ques_title'),$content);
					$content= str_replace("{description}", $this->input->post('forum_ques_description'),$content);
					$content= str_replace("{username}",ucfirst($adminEmail->fname),$content);
					$content= str_replace("{user_email_address}",$adminEmail->email,$content);
					$this->sendingMail($adminEmail->email, $subject, $content);
				    $this->session->set_flashdata('msg_success', "Your comment has been successfully posted");
				 }else{
					$this->session->set_flashdata('msg_error', messages::TOPIC_CREATED_ERROR); 
				 }
				
	        }else{
				$image_path = '';
			if((!empty($_FILES["upload"])) && isset($_FILES['upload']['name']))  					   
		    {
			if($_FILES['upload']['error']==0)
			{
				$filename  = basename($_FILES['upload']['name']);
				$extension = pathinfo($filename, PATHINFO_EXTENSION);
				$image_name     = time().'.'.$extension;
				$image_path = 'upload/Forum_topic/'.$image_name;
				move_uploaded_file($_FILES['upload']['tmp_name'] ,$image_path);
			 }
			}
				
			$forum_ques_url=$this->clean_string($this->input->post('forum_ques_title'));
			
			$res = $this->Common_model1->update('forum_question', array("forum_topic_file"=>$image_path,"forum_ques_url"=>$forum_ques_url,"forum_ques_title"=>$this->input->post('forum_ques_title'),"forum_ques_description"=>$this->input->post('forum_ques_description')), array('forum_ques_id' => $_POST['forum_ques_id']));
              
			   if($res){
					 $this->session->set_flashdata('msg_success', messages::TOPIC_UPDATE);
				 }else{
					$this->session->set_flashdata('msg_error', messages::TOPIC_UPDATE_ERROR); 
				 }
				
			}
			$url=base_url().'forum/'.$this->input->post('forum_cat_url');
				 redirect($url);
		}
		 
			die;
	}
	
	public function subscribe(){
		
		 if($this->session->userdata('user_id')){
			$userId=$this->session->userdata('user_id');
		if($_POST['subcribe'] == 1)
		{
			 $countemail = $this->common_socialviralposts->countwhereuser('forum_subscribe',array('forum_ques_id'=>$_POST['forum_ques_id'],'forum_cat_id'=>$_POST['forum_cat_id'],'user_id'=>$userId));
	
	if($countemail>0)
	  {
				$data=array('status'=>'1','date'=>get_current_datetime());
				$where=array('forum_ques_id'=>$_POST['forum_ques_id'],'forum_cat_id'=>$_POST['forum_cat_id'],'user_id'=>$userId);	

				$result=$this->Common_model1->update('forum_subscribe',$data, $where);	
				if($result){
				$result=$this->Common_model1->get_all_data_count('forum_subscribe',array('forum_ques_id'=>$_POST['forum_ques_id'],'status'=>'1'));
				echo count($result);
						
				} 
	  } else{
				$data=array('forum_ques_id'=>$_POST['forum_ques_id'],'forum_cat_id'=>$_POST['forum_cat_id'],'user_id'=>$userId,'status'=>'1','date'=>get_current_datetime());	
				$result=$this->common_socialviralposts->insertData('forum_subscribe',$data);	
				if($result){
				$result=$this->Common_model1->get_all_data_count('forum_subscribe',array('forum_ques_id'=>$_POST['forum_ques_id'],'status'=>'1'));
				echo count($result);
			}		
			} 
		
		} else{
			$data=array('status'=>'0','date'=>get_current_datetime());
			$where=array('forum_ques_id'=>$_POST['forum_ques_id'],'forum_cat_id'=>$_POST['forum_cat_id'],'user_id'=>$userId);	
		    
			$result=$this->Common_model1->update('forum_subscribe',$data, $where);	
			if($result){
				$result=$this->Common_model1->get_all_data_count('forum_subscribe',array('forum_ques_id'=>$_POST['forum_ques_id'],'status'=>'1'));
			  echo count($result);
						
			} 
		}
		 } else{
			 echo 'not';
		 }
	}
	
	public function editorfile(){
		if(isset($_FILES['upload'])){
				// ------ Process your file upload code -------
				$filen = $_FILES['upload']['tmp_name']; 
				$con_images = base_url()."assets/editor_images/".$_FILES['upload']['name'];
				
				// move_uploaded_file($filen, $con_images );

				$config['upload_path']          = './assets/editor_images/';
				$config['allowed_types']        = 'gif|jpg|png';          
				$this->load->library('upload', $config);
				$this->upload->do_upload('upload');
				$url = $con_images;

				$funcNum = $_GET['CKEditorFuncNum'] ;
				// Optional: instance name (might be used to load a specific configuration file or anything else).
				$CKEditor = $_GET['CKEditor'] ;
				// Optional: might be used to provide localized messages.
				$langCode = $_GET['langCode'] ;

				// Usually you will only assign something here if the file could not be uploaded.
				$message = '';
				echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
		}
		
	}
	/* public function unsubscribe_newsletter(){
	 	if(isset($this->userId)){
    	 $data['user_id'] = $this->userId;
    }
	 
	   $subscribe_id=$_GET['id'];
	   $where = array('subscribe_id'=> $subscribe_id); 	  
	  $countemail = $this->common_socialviralposts->countwhereuser_detials('healthcare_newsletter',$where);
	
	if($countemail)
	  { 
              $result=$this->Common_model1->update('healthcare_newsletter',array("status"=>'0'), $where);
			  if($result){
			$this->session->set_flashdata('msg_success', "Successfully unsubscribe your email!");	  
			  }else{
			$this->session->set_flashdata('msg_error', "failed! please try again!"); 

			  }
         
       } else{
		   $this->session->set_flashdata('msg_error', "failed! please try again!"); 
	   }
	   $this->load->view("unsubscribe");
	 }*/
	
 /*  public function newsletter(){
	 
	   $email=$_POST['newsletter'];
	   $where = array('newsletter_email'=> $email); 	  
	  $countemail = $this->common_socialviralposts->countwhereuser_detials('healthcare_newsletter',$where);
	
	if(empty($countemail))
	  { 
		  $uniqid=uniqid();
		  $result=$this->common_socialviralposts->insertData('healthcare_newsletter',array("newsletter_email"=>$email,'subscribe_id'=>$uniqid, "status"=>1,"date"=>date('Y-m-d h:m:s')));
	       
		    if( $result){
				$return = array ('code' => '200', 'msg'=>messages::NEWSLETTER_CREATED);
				
				$subject="Thanks for subscribing to the Health Mettle";
				$email_user=$email;
				$url=base_url().'unsubscribe?id='.$uniqid;
				$this->support_email_newsletter($subject,$email_user,$url);
			
			}else{
				$return = array ('code' => '300', 'msg'=>'Please try again');
			}
	
	 }else{
		       
			$this->Common_model1->update('healthcare_newsletter',array('status'=>'1'), array('subscribe_id'=>$countemail->subscribe_id));  
			   
			   $subject="Thanks for subscribing to the Health Mettle you already Subscribed";
				$email_user=$email;
				$url=base_url().'unsubscribe?id='.$countemail->subscribe_id;
				$this->support_email_newsletter($subject,$email_user,$url);
		       
			 $return = array ('code' => '300', 'msg'=>"This email already exist!");
		 
		 }
		 
		 echo json_encode($return);		
   }*/
   
     public function delete_comment()
    {   
   	$category_image_id=$_POST['image_id'];
             $table="forum_comment";	
			$id=array('forum_comment_id'=>$category_image_id);
            $this->Common_model1->delete($table,$id);
          
		        $id2=array('forum_comment_parent_id'=>$category_image_id);
            $user_delete = $this->Common_model1->delete($table,$id2);
			  if ($user_delete)
                {					
                   echo '1';
                }
                else
                {
                  echo '0'; 
                }
              die;
    }
	
public function delete_topic()
{   
	$category_image_id=$_POST['image_id'];
	$table="forum_question";				
	$id2=array('forum_ques_id'=>$category_image_id);
	$user_delete = $this->Common_model1->delete($table,$id2);
	if ($user_delete)
	{					
		echo '1';
	}
	else
	{
		echo '0'; 
	}

	die;
}

public function cat_aproved_panding()
{   
	$id=$_POST['id'];
	$forum_ques_status=$_POST['forum_ques_status'];
	$table="forum_question";				
	$where=array('forum_ques_id'=>$id);
	$updateDate=array('forum_ques_status'=>$forum_ques_status);
	$update = $this->Common_model1->update($table,$updateDate,$where);
	echo $this->db->last_query();
	if ($update)
	{					
		echo '1';
	}
	else
	{
		echo '0'; 
	}

	die;
}


	function subscribe_user_list($subscribe , $url, $forum_ques_title,$forum_comment_description,$f_q_u_emailid){

		foreach($subscribe AS $item){	
           		
            $email_user=$item->email;				  
            $fname=$item->fname;
			$row =  $this->Common_model1->get_single_data('email_templates',array('title'=>'ReplyForumComment'));		
			$subject = $row->subject;
			$content= $row->content;
			$content= str_replace("{topic_name}", $forum_ques_title,$content);
			$content= str_replace("{page_link}", $url, $content);
			$content= str_replace("{reply_msg}", $forum_comment_description,$content);
			$content= str_replace("{username}",$fname,$content);
			$content= str_replace("{user_email_address}",$email_user,$content);
			if($email_user != $f_q_u_emailid){
				$this->sendingMail($email_user, $subject, $content);	
			}
			
		} 
	}

	
	public  function support_email($subject,$email_user,$fname,$url)
    {
		
	$message="<div style='box-sizing:border-box;font-family:Arial!important;font-size:16px;background-color:#ebeef0'>
<div class='m_4206956286208370236preheader' style='font-size:1px;display:none!important'></div>

<table align='center' style='box-sizing:border-box;margin-left:auto;margin-right:auto'>
  <tbody><tr style='box-sizing:border-box'>
    <td style='box-sizing:border-box;padding-top:7px;padding-bottom:7px;padding-right:7px;padding-left:7px;text-align:center'><a href=''".base_url()."' style='box-sizing:border-box' target='_blank' data-saferedirecturl='".base_url()."'><img src='".base_url()."assets/images/logo.png' width='150' style='box-sizing:border-box;border-width:0px!important' class='CToWUd'></a></td>
  </tr>
</tbody></table>
 
<table id='m_4206956286208370236bodyTable' cellspacing='0' align='center' style='box-sizing:border-box;margin-left:auto;margin-right:auto;background-color:#fff;max-width:600px;border-width:1px;border-style:solid;border-color:#dddddd;border-radius:2px;border-spacing:0px'>
  <tbody><tr style='box-sizing:border-box'>
    <td style='box-sizing:border-box;text-align:center;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px'>     
      <table align='center' width='100%' style='box-sizing:border-box;border-collapse:collapse;margin-left:auto;margin-right:auto'>
        <tbody><tr style='box-sizing:border-box'>
          <td class='m_4206956286208370236background' style='box-sizing:border-box;padding-top:20px;padding-bottom:20px;padding-right:20px;padding-left:20px;text-align:center;background-color:#fafbfc'><h1 style='box-sizing:border-box;font-size:22px;font-weight:normal;color:#767676'>Latest Comment get in GroomedTrail! </h1></td>
        </tr>
      </tbody></table>     
      <table align='center' width='90%' style='box-sizing:border-box;max-width:450px;margin-left:auto;margin-right:auto'>
        <tbody><tr style='box-sizing:border-box'>
          <td class='m_4206956286208370236bodyContent' style='box-sizing:border-box;text-align:left;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;font-family:Helvetica,Arial;color:#767676;font-size:14px;font-weight:100;letter-spacing:0.3px;line-height:20px'><p style='box-sizing:border-box'><br style='box-sizing:border-box'>
             Hi ".$fname.",</p>
<p style='box-sizing:border-box'>Latest comment on this topic<br>
Thank you and have a great day!</p>
</td>
        </tr>
      
      </tbody></table>
       <table class='m_4206956286208370236btnLargeGreen' align='center' style='box-sizing:border-box;margin-left:auto;margin-right:auto;border-radius:3px;background-color:#79b657;display:inline-block;border-width:0px;border-style:solid;border-color:#2a74a0;padding-top:10px;padding-bottom:10px;padding-right:20px;padding-left:20px'>
        <tbody><tr style='box-sizing:border-box'>
          <td style='box-sizing:border-box;text-align:center;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px'><a class='m_4206956286208370236largeMobileText' href='".$url."' style='box-sizing:border-box;color:#ffffff;font-size:120%!important;text-decoration:none;display:inline-block' target='_blank' data-saferedirecturl=''>Topic Link</a></td>
        </tr>
      </tbody></table>
     
      <table align='center' class='m_4206956286208370236contentTable' border='0' cellpadding='0' cellspacing='0' style='box-sizing:border-box;margin-left:auto;margin-right:auto;width:100%!important'>
        <tbody><tr style='box-sizing:border-box'>
          <td align='center' valign='top' class='m_4206956286208370236flexibleContainerCell' style='box-sizing:border-box;padding-top:25px;padding-bottom:20px;text-align:center;padding-right:14px;padding-left:14px'><hr style='box-sizing:border-box;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;border-style:none;height:1px;background-color:#e5e5e5;background-image:none;background-repeat:repeat;background-position:top left'></td>
        </tr>
      </tbody></table>
      <table align='center' class='m_4206956286208370236advisor' border='0' style='box-sizing:border-box;margin-left:auto;margin-right:auto;border-collapse:collapse!important'>
       
          <tbody><tr style='box-sizing:border-box'>
          <td style='box-sizing:border-box;text-align:center;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px'><h4 style='box-sizing:border-box;font-size:16px;font-weight:400;letter-spacing:0.4px;color:#767676;margin-top:0px;margin-bottom:0px;margin-right:0px;margin-left:0px'>Thank you and have a great day!</h4></td></tr>
          <tr style='box-sizing:border-box'><td style='box-sizing:border-box;text-align:center;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px'><span class='m_4206956286208370236bodyContent' style='box-sizing:border-box;font-family:Helvetica,Arial;color:#767676;font-size:14px;font-weight:100;letter-spacing:0.3px;line-height:20px'>Our support line is open 24/7 to help you get started</span></td></tr>
    <tr style='box-sizing:border-box'><td style='box-sizing:border-box;padding-top:7px;padding-bottom:7px;padding-right:0px;padding-left:0px;text-align:center'>

<span class='m_4206956286208370236bodyContent' style='box-sizing:border-box;font-family:Helvetica,Arial;color:#767676;font-size:14px;font-weight:100;letter-spacing:0.3px;line-height:20px'></span><br style='box-sizing:border-box'><br style='box-sizing:border-box'> </td></tr>
       
      </tbody></table>
      
      </td>
  </tr>
</tbody></table>

<table align='center' class='m_4206956286208370236footer' width='100%' style='box-sizing:border-box;margin-left:auto;margin-right:auto;padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0'>
  <tbody>
   <tr style='box-sizing:border-box'>
    <td class='m_4206956286208370236links' style='box-sizing:border-box;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;text-align:left'>
      <p style='box-sizing:border-box;padding-top:15px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;clear:both;text-align:center;line-height:24px;font-size:12px;color:#aaa;text-decoration:none'> © <a href='#' class='m_4206956286208370236links' style='box-sizing:border-box;padding-top:15px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;clear:both;text-align:center;line-height:24px;font-size:12px;color:#aaa;text-decoration:none' target='_blank' data-saferedirecturl='#'>GroomedTrail</a> </p></td>
  </tr>
</tbody></table>
</div>";
		
	
		
	            $this->load->library('email');
				$email_setting  = array('mailtype'=>'html');
                $this->email->initialize($email_setting);
				$this->email->from('info@groomedtrail.com', 'GroomedTrail');
				$this->email->to($email_user); 	
				//$this->email->to('votive.lalu12@gmail.com'); 	
				$this->email->subject($subject);											
				$this->email->message($message);	
				$this->email->send();
				
}
	
 
	 	 public  function support_email_newsletter($subject,$email_user,$url)
    {
		
 $message="<div style='box-sizing:border-box;font-family:Arial!important;font-size:16px;background-color:#ebeef0'>
<div class='m_4206956286208370236preheader' style='font-size:1px;display:none!important'></div>

<table align='center' style='box-sizing:border-box;margin-left:auto;margin-right:auto'>
  <tbody><tr style='box-sizing:border-box'>
    <td style='box-sizing:border-box;padding-top:7px;padding-bottom:7px;padding-right:7px;padding-left:7px;text-align:center'>
    <a href=''".base_url()."' style='box-sizing:border-box' target='_blank' data-saferedirecturl='".base_url()."'><img src='".base_url()."assets/images/logo.png' width='150' style='box-sizing:border-box;border-width:0px!important' class='CToWUd'></a>

    </td>
  </tr>
</tbody></table>
 
<table id='m_4206956286208370236bodyTable' cellspacing='0' align='center' style='box-sizing:border-box;margin-left:auto;margin-right:auto;background-color:#fff;max-width:600px;border-width:1px;border-style:solid;border-color:#dddddd;border-radius:2px;border-spacing:0px'>
  <tbody><tr style='box-sizing:border-box'>
    <td style='box-sizing:border-box;text-align:center;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px'>     
      <table align='center' width='100%' style='box-sizing:border-box;border-collapse:collapse;margin-left:auto;margin-right:auto'>
        <tbody><tr style='box-sizing:border-box'>
          <td class='m_4206956286208370236background' style='box-sizing:border-box;padding-top:20px;padding-bottom:20px;padding-right:20px;padding-left:20px;text-align:center;background-color:#fafbfc'><h1 style='box-sizing:border-box;font-size:22px;font-weight:normal;color:#767676'>Thanks for subscribing to the GroomedTrail </h1></td>
        </tr>
      </tbody></table>     
      <table align='center' width='90%' style='box-sizing:border-box;max-width:450px;margin-left:auto;margin-right:auto'>
        <tbody><tr style='box-sizing:border-box'>
          <td class='m_4206956286208370236bodyContent' style='box-sizing:border-box;text-align:left;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;font-family:Helvetica,Arial;color:#767676;font-size:14px;font-weight:100;letter-spacing:0.3px;line-height:20px'><p style='box-sizing:border-box'><br style='box-sizing:border-box'>
             Dear,</p>
<p style='box-sizing:border-box'>if you want to unsubscribe this email click here<br>

</td>
        </tr>
      
      </tbody></table>
       <table class='m_4206956286208370236btnLargeGreen' align='center' style='box-sizing:border-box;margin-left:auto;margin-right:auto;border-radius:3px;background-color:#79b657;display:inline-block;border-width:0px;border-style:solid;border-color:#2a74a0;padding-top:10px;padding-bottom:10px;padding-right:20px;padding-left:20px'>
        <tbody><tr style='box-sizing:border-box'>
          <td style='box-sizing:border-box;text-align:center;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px'><a class='m_4206956286208370236largeMobileText' href='".$url."' style='box-sizing:border-box;color:#ffffff;font-size:120%!important;text-decoration:none;display:inline-block' target='_blank' data-saferedirecturl=''>Unsubscribe Link</a></td>
        </tr>
      </tbody></table>
     
      <table align='center' class='m_4206956286208370236contentTable' border='0' cellpadding='0' cellspacing='0' style='box-sizing:border-box;margin-left:auto;margin-right:auto;width:100%!important'>
        <tbody><tr style='box-sizing:border-box'>
          <td align='center' valign='top' class='m_4206956286208370236flexibleContainerCell' style='box-sizing:border-box;padding-top:25px;padding-bottom:20px;text-align:center;padding-right:14px;padding-left:14px'><hr style='box-sizing:border-box;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;border-style:none;height:1px;background-color:#e5e5e5;background-image:none;background-repeat:repeat;background-position:top left'></td>
        </tr>
      </tbody></table>
      <table align='center' class='m_4206956286208370236advisor' border='0' style='box-sizing:border-box;margin-left:auto;margin-right:auto;border-collapse:collapse!important'>
       
          <tbody><tr style='box-sizing:border-box'>
          <td style='box-sizing:border-box;text-align:center;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px'><h4 style='box-sizing:border-box;font-size:16px;font-weight:400;letter-spacing:0.4px;color:#767676;margin-top:0px;margin-bottom:0px;margin-right:0px;margin-left:0px'>Thank you and have a great day!</h4></td></tr>
          <tr style='box-sizing:border-box'><td style='box-sizing:border-box;text-align:center;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px'><span class='m_4206956286208370236bodyContent' style='box-sizing:border-box;font-family:Helvetica,Arial;color:#767676;font-size:14px;font-weight:100;letter-spacing:0.3px;line-height:20px'>Our support line is open 24/7 to help you get started</span></td></tr>
    <tr style='box-sizing:border-box'><td style='box-sizing:border-box;padding-top:7px;padding-bottom:7px;padding-right:0px;padding-left:0px;text-align:center'>

<span class='m_4206956286208370236bodyContent' style='box-sizing:border-box;font-family:Helvetica,Arial;color:#767676;font-size:14px;font-weight:100;letter-spacing:0.3px;line-height:20px'></span><br style='box-sizing:border-box'><br style='box-sizing:border-box'> </td></tr>
       
      </tbody></table>
      
      </td>
  </tr>
</tbody></table>

<table align='center' class='m_4206956286208370236footer' width='100%' style='box-sizing:border-box;margin-left:auto;margin-right:auto;padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0'>
  <tbody>
   <tr style='box-sizing:border-box'>
    <td class='m_4206956286208370236links' style='box-sizing:border-box;padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;text-align:left'>
      <p style='box-sizing:border-box;padding-top:15px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;clear:both;text-align:center;line-height:24px;font-size:12px;color:#aaa;text-decoration:none'> © <a href='#' class='m_4206956286208370236links' style='box-sizing:border-box;padding-top:15px;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;clear:both;text-align:center;line-height:24px;font-size:12px;color:#aaa;text-decoration:none' target='_blank' data-saferedirecturl='#'>GroomedTrail</a> </p></td>
  </tr>
</tbody></table>
</div>";
	
	
		
	            $this->load->library('email');
				$email_setting  = array('mailtype'=>'html');
                $this->email->initialize($email_setting);
				$this->email->from('info@groomedtrail.com', 'GroomedTrail');
				$this->email->to($email_user); 	
				//$this->email->to('votive.lalu12@gmail.com'); 	
				$this->email->subject($subject);											
				$this->email->message($message);	
				$this->email->send();
				
}
	
public function Already_exit_post_title(){

	$title=$_POST['title'];
	$id=$_POST['id'];
	$title = $this->clean_string($title);

	$table='forum_question';
	if(empty($id) or $id ==''){
	       $where=array('forum_ques_url'=>$title);
	}else{

	       $where=array('forum_ques_id !='=>$id,'forum_ques_url'=>$title);
	}
	$post=$this->Common_model1->get_single_data($table,$where);
	if($post){
	       echo '1';
	}else{
	echo '0';
	}

}
public function abuse_forum()
{   
	$id=$_POST['f_que_id']; 
	$forum_type=$_POST['forum_type']; 
	$abuse['user_id'] = $this->session->userdata('user_id');
	$name=$this->Common_model1->get_single_data('tbl_user_master',array('user_id' =>$abuse['user_id']));
	$abuse['forum_type'] =$forum_type;
	$abuse['page_url'] = $_POST['forum_url']; 
	$url = $_POST['url']; 
	$abuse['abuse_message'] = $_POST['abuse_message'];
	$abuse['date'] =get_current_datetime();
    if($forum_type == "Topic"){
		$table="forum_question";				
		$where=array('forum_ques_id'=>$id);
		$updateDate=array('abuse_forum'=>1);
		$forumTopic=$this->Common_model1->get_single_data($table,$where);
		$topic_name=$forumTopic->forum_ques_title; 
		$description=$forumTopic->forum_ques_description; 
        $abuse['forum_table_name'] = $table;
		$abuse['forum_title'] =$topic_name;
		$abuse['forum_topic_comm_id'] = $id;

		$this->common_socialviralposts->insertData('tbl_abuse',$abuse);

		$update = $this->Common_model1->update($table,$updateDate,$where);
    }else{
    	$table="forum_comment";		
    	$topic_name=$_POST['topic_name']; 
	    $where=array('forum_comment_id'=>$id);
		$updateDate=array('abuse_forum'=>1);
		$forumTopic=$this->Common_model1->get_single_data($table,$where);
		$description=$forumTopic->forum_comment_description; 

		$update = $this->Common_model1->update($table,$updateDate,$where);
    }
	if ($update)
	{					
		$query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=17");
			$subAdminEmail = $query->result();
			if(isset( $subAdminEmail)){
            	foreach ($subAdminEmail as $semail) {

                    $row1 =  $this->model->get_row('email_templates',array('title'=>'abuseForumTopicandReplay'));
					$subject = $row1->subject;
					$content = $row1->content;
					$content= str_replace("{topic_name}", $topic_name,$content);
					$content= str_replace("{forum_type}", $forum_type,$content);
					$content= str_replace("{page_link}", base_url().$abuse['page_url'],$content);
					$content= str_replace("{description}",$description,$content);
					$content= str_replace("{message}",$abuse['abuse_message'],$content);
					$content= str_replace("{username}",ucfirst($semail->fname),$content);
					$content= str_replace("{full_name}",$name->fname.' '.$name->lname,$content);
					$content= str_replace("{user_email_address}",$semail->email,$content);
					$this->sendingMail($semail->email, $subject, $content);
					//$this->sendingMail('votive.reena@gmail.com', $subject, $content);

                }
            }
            $query = $this->db->query("SELECT fname,email,user_id from tbl_user_master WHERE siterole_id =1 AND user_id=1");
            $adminEmail = $query->result();
            $row1 =  $this->model->get_row('email_templates',array('title'=>'abuseForumTopicandReplay'));
			$subject = $row1->subject;
			$content = $row1->content;
			$content= str_replace("{topic_name}", $topic_name,$content);
			$content= str_replace("{forum_type}", $forum_type,$content);
			$content= str_replace("{page_link}", base_url().$abuse['page_url'],$content);
			$content= str_replace("{description}",$description,$content);
			$content= str_replace("{full_name}",$name->fname.' '.$name->lname,$content);
			$content= str_replace("{message}",$abuse['abuse_message'],$content);
			$content= str_replace("{username}",ucfirst($adminEmail->fname),$content);
			$content= str_replace("{user_email_address}",$adminEmail->email,$content);
			$this->sendingMail($adminEmail->email, $subject, $content);
			//$this->sendingMail('votive.reena@gmail.com', $subject, $content);
			$this->session->set_flashdata('msg_success', "Abuse Topic");
			redirect($url);
	}
	else
	{
		echo '0'; 
	}

	
}
	function clean_string($str){
	    $string=trim($str);
	    $string=preg_replace('/\s\s+/', ' ',$string);
	    $string = str_replace(' ', '-',$string); // Replaces all spaces with hyphens.
        $string=preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.		
	    return   strtolower($string);	
    }  
}
