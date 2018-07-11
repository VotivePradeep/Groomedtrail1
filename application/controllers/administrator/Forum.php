<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller {
    public function __construct(){


		parent::__construct();
		/* Load the libraries and helpers */        
		//$this->load->model('model');
		//$this->load->model('Common_model1');
		$this->load->library('pagination');		
		$this->load->helper('resize');
		$this->load->library(array('layout', 'form_validation','messages')); // Load layout library
        $this->load->helper(array('url','utility','message_alert'));
		$this->load->model(array('model','Common_model1','common_socialviralposts')); // Load models
		$this->load->helper('ckeditor');
		$this->load->library('Ajax_pagination');
		$this->load->helper('custom_helper');
		$this->load->library('session');
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
			
    $info=$this->session->all_userdata();
	$data['basesegment']= $this->uri->segment(2);
	$data['userinfo']=$info;
	$data['u_id'] = $this->data['user_id'];
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],17);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }
	$data['role'] = $this->data['siterole_id'];
    $data['title'] = 'Admin | '.ucfirst(str_replace('-', ' ', $this->uri->segment(4)));
    $data['active_tab_forum'] = 'active';

	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		
		$table1='forum_question';
		$table2='tbl_user_master';
		$select='forum_question.* ,tbl_user_master.*';
		$equeal='forum_question.user_id = tbl_user_master.user_id';
		$where1 =array('forum_question.forum_ques_url'=>$url);


		 $data['single'] = $this->Common_model1->get_join_match_single_table($select,$table1,$table2,$equeal,$where1);
         
		 $where=array(
		 'forum_question.forum_ques_status'=>'Aproved',
		 'forum_question.forum_cat_id'=>$data['single']->forum_cat_id,
		 'forum_question.forum_ques_url !='=>$url
		 ); 
		  $where2=array(
		 'forum_question.forum_ques_status'=>'Aproved',
		 );
		 
		 // view topic add record
		
	/*	 $checklist=$this->Common_model1->get_single_data('forum_view',array('forum_cat_id'=>$data['single']->forum_cat_id,'forum_ques_id'=>$data['single']->forum_ques_id));
	
		    if($checklist){
				$forum_view_id=$checklist->forum_view_id;
				$forum_view_count=$checklist->forum_view_count;
				$forum_view_count= $forum_view_count+1;
				
				$this->Common_model1->update('forum_view',array('forum_view_count'=>$forum_view_count), array('forum_view_id'=>$forum_view_id) );
				
			} else{
				$this->Common_model1->insertdata('forum_view', array('forum_cat_id'=>$data['single']->forum_cat_id,'forum_ques_id'=>$data['single']->forum_ques_id, 'forum_view_count'=>'1', 'date'=>get_current_datetime()));
			}
	*/
		  $data['popularforumQuestion'] =  $this->common_socialviralposts->jointhreetable('forum_question','forum_cat_id','forum_category','forum_cat_id','tbl_user_master','user_id','user_id',$where2,'forum_question.date','desc','forum_question.*,forum_category.forum_cat_name,forum_category.forum_cat_url,tbl_user_master.*',0,8);
		 
		 
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
		   $data['totallike'] = $this->common_socialviralposts->countwhereuser('forum_like',$where);
	  
		  $data['likeusers'] = $this->common_socialviralposts->jointwotable('forum_like','user_id','tbl_user_master','user_id',$where,'tbl_user_master.*');
		  
		   $data['totalcomment'] = $this->common_socialviralposts->countwhereuser('forum_comment',$where);
		 
		  /* $data['commentusers'] = $this->Common_model1->jointwotableloop('forum_comment','user_id','tbl_user_master','user_id',$where,'tbl_user_master.*,forum_comment.date AS cmdate,forum_comment.forum_comment_description,forum_comment.forum_comment_id,forum_comment.forum_ques_id, forum_comment.forum_comment_file, forum_comment.comment_type ,forum_comment.forum_comment_parent_id');
		 */
		 
		 // check user subcribe
			
		 $where_sub_user = array(
		          'forum_ques_id'=>$data['single']->forum_ques_id );	
			
			$data['user_subscribe'] = $this->Common_model1->get_single_data('forum_subscribe',$where_sub_user);
		
		 $checklist=$this->Common_model1->get_single_data('forum_view',array('forum_cat_id'=>$data['single']->forum_cat_id,'forum_ques_id'=>$data['single']->forum_ques_id));
		 if(isset($checklist->forum_view_count)){
		 	$data['total_view'] = $checklist->forum_view_count;	
		 }else{
		 	      $data['total_view'] = 0;	
		 }
		// comment 
		
		$config['base_url'] = site_url('administrator/forum/'.$cate.'/'.$url);
        $config['total_rows'] =$this->Common_model1->get_forum_comment_count($data['single']->forum_ques_id); //$this->db->count_all('tbl_books');
        $config['per_page'] = "10";
        $config["uri_segment"] = 5;
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

        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        
        // get books list
        $data['commentusers'] = $this->Common_model1->get_forum_comment_admin($config["per_page"], $data['page'],$data['single']->forum_ques_id);
         // arsort($data['commentusers']);
		//  echo "<pre>";
	//	print_r($data['commentusers']);
		//die;
        $data['pagination'] = $this->pagination->create_links();
		 
		
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/forum_questions_single', $data);	 
		$this->load->view('administrator/include/inner_footer');

		// $this->layout->view('administrator/forum_questions_single',$data);
		 
		}		
	

	/**
	 * Index Page for this controller.
	 */
	 public function categoryPost($url){	  
		$info=$this->session->all_userdata();
		$data['basesegment']= $this->uri->segment(2);
		$data['userinfo']=$info;
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
			$result = role_permission($data['u_id'],17);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
		}
		$data['role'] = $this->data['siterole_id'];
		$data['title'] = 'Admin | '.ucfirst(str_replace('-', ' ', $this->uri->segment(3)));
		$data['active_tab_forum'] = 'active';
		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	 	
	      $where_q=array('forum_cat_url'=>$url);
			$table_q="forum_category";		
			$data['category']=$this->Common_model1->get_single_data($table_q,$where_q);			
	     // question list
		 $where=array(
		 'forum_question.forum_ques_status'=>'Aproved',
		 'forum_category.forum_cat_url'=>$url,
		 );
		
	
		 $where1=array(
		 'forum_question.forum_ques_status'=>'Aproved',
		 );
		
	     // for category image 
		 	$where2=array('forum_cat_url' => $url);
			$table2="forum_category";
			
			$data['category']=$this->Common_model1->get_single_data($table2,$where2);
						
		 // Count article
	         $data['latestpostcount'] = $this->latestpost_count($url);
			 
			 
			 
			        // comment 
	
		$config['base_url'] = site_url('administrator/forum/'.$url);
        $config['total_rows'] =$this->Common_model1->get_forum_topic_count($url); //$this->db->count_all('tbl_books');
        $config['per_page'] = "20";
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
        $data['forumQuestions'] = $this->Common_model1->get_forum_topic_12($config["per_page"], $data['page'],$url);
        
        $data['pagination'] = $this->pagination->create_links();
		 
		 
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/forum_category_single', $data);	 
		$this->load->view('administrator/include/inner_footer');

	 
	 }
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
		  $info=$this->session->all_userdata();

		 if($info['admin_id']){
	    // if($this->session->userdata('userId')){
	     $forum_ques_id = $_POST['forum_ques_id'];
	     $forum_cat_id = $_POST['forum_cat_id'];
	     $forum_comment_id = $_POST['forum_comment_id'];
		
		 $where = array('user_id'=>$info['admin_id'],
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id,
		          'forum_comment_id'=>$forum_comment_id);
				
		 $total = $this->common_socialviralposts->countwhereuser('forum_like',$where);
		 
		 if($total==0){
		     $insert = array(
			      'user_id'=>$info['admin_id'],
		          'forum_ques_id'=>$forum_ques_id,
		          'forum_cat_id'=>$forum_cat_id,
		          'forum_comment_id'=>$forum_comment_id,
		          'forum_like_status'=>'Aproved',
			      'date'=>date('y-m-d h:m:s')
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
				  
			 $totallike=$this->common_socialviralposts->countwhereuser('forum_like',$where2);
			 	 
		 	 $return = array ('code' => '200','commlike'=>$totalcommentlike,'total'=>$totallike,'msg'=>$forum_ques_id );
		    
			}else{	

				$this->db->query(" DELETE FROM forum_like where forum_ques_id =".$forum_ques_id." AND forum_cat_id=".$forum_cat_id." AND forum_comment_id=".$forum_comment_id." AND user_id=".$info['admin_id']."");

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
		 $info=$this->session->all_userdata();
		 $forum_cat_id = $_POST['forum_cat_id'];
	     $forum_comment_description = $_POST['forum_comment_description'];
	     $forum_ques_id = $_POST['forum_ques_id'];	
	    	
         $url=$this->input->post('url');		
          
		 if(empty($forum_comment_description)){
			  $this->session->set_flashdata('msg_error','Faild: Comment is empty!'); 
					redirect($url); 
			  
		 }
		 if($info['admin_id']){
         $insert = array(
			 'user_id'=>$info['admin_id'],
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
		        $config['upload_path']          = './assets/editor_images/';
			  $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|bmp|GIF|JPG|PNG|JPEG|PDF|mp4|docx|doc|DOC|DOCX|txt';          ///3gp|flv|mp3|wma|wmv
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
			 if($result){
			$where45=array('user_id' => $info['admin_id']);
			$table45="tbl_user_master";
			$user=$this->Common_model1->get_single_data($table45,$where45);
				$date=get_current_datetime();
              $date=date_format(date_create($date), 'd F, Y H:i:s'); 				
				 $this->session->set_flashdata('msg_success', "Your comment has been successfully posted");
         
		// redirect($url,'refresh');	
			 }
			      // notification mail for all subscriber people one by one
				  $selects="tbl_user_master.email,tbl_user_master.fname";
				  $table1s="tbl_user_master";
				  $table2s="forum_subscribe";
				  $equeals="tbl_user_master.user_id=forum_subscribe.user_id";
				  $wheres=array('forum_subscribe.forum_ques_id'=>$forum_ques_id, "forum_subscribe.status"=>'1');
			
			$subscribe=$this->Common_model1->get_join_match_table($selects,$table1s,$table2s,$equeals,$wheres);
		
			$forum_ques=$this->Common_model1->get_single_data('forum_question',array('forum_cat_id'=>$forum_cat_id,'forum_ques_id'=>$forum_ques_id));
			$forum_ques_title=$forum_ques->forum_ques_title;
			 
		 $this->session->set_flashdata('msg_success', "Your comment has been successfully posted");
               // for subscriber send mail
	          //rr $this->subscribe_user_list($subscribe , $url, $forum_ques_title);
	 
		 redirect($url);
	     }else{
			  
			 $this->session->set_flashdata('msg_error', "Faild! Post"); 
		
		 }
		
		redirect($url);
		
	
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
		        $config['upload_path']          = './assets/editor_images/';
			  $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|bmp|GIF|JPG|PNG|JPEG|PDF|mp4|docx|doc|DOC|DOCX|txt';          ///3gp|flv|mp3|wma|wmv
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
/* rr
	 function subscribe_user_list($subscribe , $url, $forum_ques_title){
			foreach($subscribe AS $item){	
                  $subject="New comment of This topic: ".$forum_ques_title;		
                  $email_user=$item->email;				  
                  $fname=$item->fname;				  
				  $this->support_email($subject,$email_user,$fname,$url);
			     } 
	} rr */


	 	public function addnewTopic(){

		if($_POST){
			if(empty($_POST['forum_ques_id'])){
				$forum_ques_url=$this->clean_string($this->input->post('forum_ques_title'));
		$data = array(
				  "forum_ques_title"=>$this->input->post('forum_ques_title'),
				  "forum_cat_id"=>$this->input->post('forum_cat_id'),
				  "forum_ques_url"=>$forum_ques_url,				 
				  "forum_ques_description"=>$this->input->post('forum_ques_description'),				 
				  "user_id"=>1,				 
				  "forum_ques_status"=>'Aproved',				 
				  "date"=>get_current_datetime()
				  );
				  
		        $result = $this->Common_model1->insertdata('forum_question',$data);
				
				if($result){
					 $this->session->set_flashdata('msg_success', messages::TOPIC_CREATED);
				 }else{
					$this->session->set_flashdata('msg_error', messages::TOPIC_CREATED_ERROR); 
				 }
				
	        }else{
				
				
			$forum_ques_url=$this->clean_string($this->input->post('forum_ques_title'));
			
			$res = $this->Common_model1->update('forum_question', array("forum_ques_url"=>$forum_ques_url,"forum_ques_title"=>$this->input->post('forum_ques_title'),"forum_ques_description"=>$this->input->post('forum_ques_description')), array('forum_ques_id' => $_POST['forum_ques_id']));
              
			   if($res){
					 $this->session->set_flashdata('msg_success', messages::TOPIC_UPDATE);
				 }else{
					$this->session->set_flashdata('msg_error', messages::TOPIC_UPDATE_ERROR); 
				 }
				
			}
			$url=base_url().'administrator/forum/'.$this->input->post('forum_cat_url');
				 redirect($url);
		}
		 
			die;
	}
public function categoryList(){
		$info=$this->session->all_userdata();
		$data['basesegment']= $this->uri->segment(2);
		$data['userinfo']=$info;
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
			$result = role_permission($data['u_id'],9);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
		}
		$data['role'] = $this->data['siterole_id'];

		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');


		$where=array('forum_cat_status'=>'Aproved');			
		$data['categories']=$this->Common_model1->get_all_where_category('forum_category',$where);		
		//  $this->layout->view('forum_category', $data);	
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/forum_category', $data);	 
		$this->load->view('administrator/include/inner_footer');	

		}
	function clean_string($str){
	    $string=trim($str);
	    $string=preg_replace('/\s\s+/', ' ',$string);
	    $string = str_replace(' ', '-',$string); // Replaces all spaces with hyphens.
        $string=preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.		
	    return   strtolower($string);	
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





    

	}