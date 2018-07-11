<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 	
class Common_model1 extends CI_Model
{ 


	function __construct()
    {
        parent::__construct();
        //$this->load->helper(array('utility')); //Load helper
    }

  function getAll($table)
	    {
			
			$data = $this->db->get($table);
			//$get = $data->result_array();
		
			$get = $data->result();
			$num=$data->result();
			if($num){
				return $get;
			}
			else
			{
				return false;
			}
	   }
	   
	   public function getAllwhere($table,$order_by=null,$order=null)
    {
        $this->db->select('*');
      
        $this->db->order_by($order_by,$order);
        $result = $this->db->get($table)->result();
        return $result;
    }
	   
	   
	   public function insertImage($table,$data){
		$insert = $this->db->insert_batch($table,$data);
		return $insert?true:false;
	}
	   
	   
	     public function insertdata($table, $data)
    {
		
	
        $query = $this->db->insert($table, $data);
        if ($query){
            return $this->db->insert_id();
		}
        else {
            return FALSE;
		}
    }
	   
	   
	   public function insertloop($table, $data)
    {
		
        $query = $this->db->insert_batch($table, $data);
        if ($query){
            return $this->db->insert_id();
		}
        else {
            return FALSE;
		}
    }
	   
	   
	    public function delete($table_name = '', $id_array = '')
    {
         $query=$this->db->delete($table_name, $id_array);
		
		
		if ($query){
            return TRUE;
		}
        else {
            return FALSE;
		}
		
    }

	   
	   public function update($table_name = '', $data = '', $id_array = '')
    {
       $this->db->where($id_array);
        $query=$this->db->update($table_name, $data);
	
	if ($query){
				return true;
			}
			else {
				
				return FALSE;
			}
			
			
	}
	
	   public function login($table,$where) {
			
			$this->db->where($where);						
	     	$res = $this->db->get($table)->row();
			if($res)
			{
			  return $res;
			}
			  else
			  {
			  return FALSE;
			  }
		}
	
	     public function get_single_data($table,$where)
    {
       
	   $this->db->select('*');
       $this->db->where($where);
       $result = $this->db->get($table)->row();
        return $result;
    }
	
	
	 public function get_all_where_data($table,$where,$order_by=null,$order=null)
    {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->order_by($order_by,$order);
        $result = $this->db->get($table)->result();
        return $result;
    }
	
	 public function get_all_where($table,$where)
    {
        $this->db->select('*');
        $this->db->where($where);   
        $result = $this->db->get($table)->result();
        return $result;
    }
	
	     public function recent_entry_view($table,$orderby)
    {
        $this->db->select('*');
        $this->db->order_by($orderby,'DESC');  
		$this->db->limit(5);
        $result = $this->db->get($table)->result();
        return $result;
    }	
	
		function get_join_table($group,$select,$table1,$table2,$equeal,$where){			     
				$this->db->select($select);
				$this->db->from($table1);
				$this->db->join($table2,$equeal);
				$this->db->where($where);
				$this->db->group_by($group); 
				$query=$this->db->get();
				$data= $query->result();
				$num = $query->num_rows();
				if($num> 0)
				{ 
				return $data;
				} else{
					 return false;
					}					
		}
					
		function get_join_match_table($select,$table1,$table2,$equeal,$where){
			     
				$this->db->select($select);
				$this->db->from($table1);
				$this->db->join($table2,$equeal);
				$this->db->where($where);
				$query=$this->db->get();
				$data= $query->result();
				$num = $query->num_rows();
				if($num> 0)
				{ 
				return $data;
				} else{
					 return false;
					}
					
				
		}
		
		function get_join_match_single_table($select,$table1,$table2,$equeal,$where){
			     
				$this->db->select($select);
				$this->db->from($table1);
				$this->db->join($table2,$equeal);
				$this->db->where($where);
				$query=$this->db->get();
				$data= $query->row();
				$num = $query->num_rows();
				if($num> 0)
				{ 
				return $data;
				} else{
					 return false;
					}
					
				
		}
		
		function getCategoryWithImage($table)
	    {
			
			$data = $this->db->get($table);
			//$get = $data->result_array();
		
			//$get = $data->result();
			$nums=$data->result_array();
			if($nums){
				
				   $record=array();
				   $category_imagesss=array();
				foreach($nums AS $num){
					  $category_id=$num['category_id'];
					  $query = $this->db->query("SELECT * from category_image_list WHERE category_id='".$category_id."'");
			          $num['calegory_image_files']=$query->result(); 			
					  $record[]=$num;
				}
				
				return $record;
			}
			else
			{
				return false;
			}
	   }
		
		
		 function get_join_match_like_table($select,$table1,$table2,$equeal,$where,$like,$order_by){
			     
				$this->db->select($select);
				$this->db->from($table1);
				$this->db->join($table2,$equeal);
				$this->db->order_by('title', 'DESC');
				$this->db->where($where);
				$this->db->where('award_image.image_id',$like);				
				
				$query=$this->db->get();
				$data= $query->result();
				$num = $query->num_rows();
				if($num> 0)
				{ 
				return $data;
				} else{
					 return false;
					}
	   }		
	   
	   	function get_join_table_all($select,$table1,$table2,$equeal){
			     
				$this->db->select($select);
				$this->db->from($table1);
				$this->db->join($table2,$equeal);				
				$query=$this->db->get();
				$data= $query->result();
				$num = $query->num_rows();
				if($num> 0)
				{ 
				return $data;
				} else{
					 return false;
					}
		}
		
	   
		function get_join_custom($select,$table1,$table2,$equeal,$where,$like,$order_by){
			
			$query = $this->db->query("SELECT $select FROM $table1 JOIN $table2 ON $equeal WHERE $where $like $order_by");
			
			$data= $query->result();
				$num = $query->num_rows();
				if($num> 0)
				{ 
				return $data;
				} else{
					 return false;
					}
		}	

		
		function getjoinTwoinnerloop($table)
	    {
			
			$data = $this->db->get($table);
			//$get = $data->result_array();
		
			//$get = $data->result();
			$nums=$data->result_array();
			if($nums){
				
				   $record=array();
				   $category_imagesss=array();
				foreach($nums AS $num){
					  $category_id=$num['category_id'];
					  $query = $this->db->query("SELECT * from category_image_list WHERE category_id='".$category_id."'");
			          $num['calegory_image_files']=$query->result(); 			
					  $record[]=$num;
				}
				
				return $record;
			}
			else
			{
				return false;
			}
	   }
	   
	   
	   
	     function jointwotableloop($table, $field_first, $table1, $field_second,$where='',$field) {

        $this->db->select($field);
        $this->db->from("$table");
			
        $this->db->join("$table1", "$table1.$field_second = $table.$field_first"); 
        if($where !=''){
        $this->db->where($where); 
        $this->db->where(array("comment_type"=>'parent')); 
        }
		
		 $this->db->order_by("forum_comment.forum_comment_id", "DESC");
        $q = $this->db->get();
        if($q->num_rows() > 0) {
            foreach($q->result() as $rows) {
				$forum_comment_id=$rows->forum_comment_id;
			$q_child=$this->db->query("
SELECT `tbl_user_master`.*, `forum_comment`.`date` AS `cmdate`, `forum_comment`.`forum_comment_description`, `forum_comment`.`forum_comment_id`, `forum_comment`.`forum_ques_id`, `forum_comment`.`forum_comment_file`, `forum_comment`.`comment_type` FROM `forum_comment` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_comment`.`user_id` WHERE `forum_comment`.`forum_comment_parent_id` = '".$forum_comment_id."' AND `comment_type` = 'child' ORDER BY `forum_comment`.`forum_comment_id` ASC");
		
		         $rows->childact = $q_child->num_rows();
				if($rows->childact > 0) {
				 foreach($q_child->result() as $rows_child) {
					
                  $forum_ques_id=$rows_child->forum_ques_id;
				 $forum_comment_id=$rows_child->forum_comment_id;
				       // coments liks
					  $query = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."'");
			          $rows_child->comment_likes=$query->num_rows();
					  //user likes
					  if($this->session->userdata('userId')){
					   $query1 = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."' AND user_id='".$this->session->userdata('userId')."'");
			          $rows_child->comment_like_me=$query1->num_rows();
					  } else{
						  $rows_child->comment_like_me=0;
					  }
					  
                $data_child[] = $rows_child;

					
				  }
				  
				
				$rows->child_comment=$data_child;
			}  else{
				$rows->child_comment='';
			}
			
				 $forum_ques_id=$rows->forum_ques_id;
				 $forum_comment_id=$rows->forum_comment_id;
				       // coments liks
					  $query = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."'");
			          $rows->comment_likes=$query->num_rows();
					  //user likes
					  if($this->session->userdata('userId')){
					   $query1 = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."' AND user_id='".$this->session->userdata('userId')."'");
			          $rows->comment_like_me=$query1->num_rows();
					  } else{
						  $rows->comment_like_me=0;
					  }
					  
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
		
    }
	   
	   
	   function get_all_where_category($table,$where) {

            $this->db->select('*');		
            $this->db->where($where); 
            $this->db->order_by("date", "desc");
         $q = $this->db->get($table);

        if($q->num_rows() > 0) {
        	//   $forum_cat_id ='';
            foreach($q->result() as $rows) {
            	//print_r($rows);
				 $forum_cat_id=$rows->forum_cat_id;	
				 	
             $topics=$this->db->query("SELECT hf.*,hu.profile_picture,hu.fname  from forum_question AS hf INNER JOIN tbl_user_master AS hu ON hf.user_id=hu.user_id WHERE hf.forum_cat_id='".$forum_cat_id."' ORDER BY date DESC limit 3")->result();				 
				     foreach($topics as $topic) {
                  	 // coments liks
					
				   $forum_ques_id=$topic->forum_ques_id;
				  $topic->total_like = $this->db->query("SELECT * from forum_like WHERE forum_ques_id='".    $forum_ques_id."'")->num_rows();
					
				    $topic->total_comment = $this->db->query("SELECT * from forum_comment WHERE forum_ques_id='".$forum_ques_id."'")->num_rows();
					  
					 $view = $this->db->query("SELECT forum_view_count from forum_view WHERE forum_ques_id='".$forum_ques_id."'")->row();
					 
					 $count_view_preset=count($view);
					 if($count_view_preset>0){
						$topic->total_view=$view->forum_view_count; 
					 }else{
						 $topic->total_view=0;
					 }
					  
					  $comment = $this->db->query("SELECT date AS comment_date from forum_comment WHERE forum_ques_id='".$forum_ques_id."' ORDER BY forum_comment_id DESC limit 1")->row(); 
					
					     $count_time=$topic->last_comment_time=count($comment);
					     if($count_time>0){
							$topic->last_comment_time=$comment->comment_date; 
						 }else{
							$topic->last_comment_time=''; 
						 }
					 $rows->topic[]=$topic;
					 }
               
			   $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
    }
   function get_all_where_search_category($table,$where,$searchKey) {

        $this->db->select('*');		
        $this->db->where($where); 
       // $this->db->like('forum_cat_name',$searchKey);
        $this->db->order_by("forum_sort_order, forum_cat_name", "asc");

        $q = $this->db->get($table);

        if($q->num_rows() > 0) {
        	//   $forum_cat_id ='';
            foreach($q->result() as $rows) {
            	//print_r($rows);

			 $forum_cat_id=$rows->forum_cat_id;	
				 	
             $topics=$this->db->query("SELECT hf.*,hu.profile_picture,hu.fname  from forum_question AS hf INNER JOIN tbl_user_master AS hu ON hf.user_id=hu.user_id WHERE hf.forum_cat_id='".$forum_cat_id."' and forum_ques_title LIKE '%".$searchKey."%' OR forum_ques_description LIKE '%".$searchKey."%'")->result();		
                  if(!empty($topics) && isset($topics)){
				    foreach($topics as $topic) {
                  	 // coments liks
					
				    $forum_ques_id=$topic->forum_ques_id;
				    $topic->total_like = $this->db->query("SELECT * from forum_like WHERE forum_ques_id='".    $forum_ques_id."'")->num_rows();
					
				    $topic->total_comment = $this->db->query("SELECT * from forum_comment WHERE forum_ques_id='".$forum_ques_id."'")->num_rows();
					  
					 $view = $this->db->query("SELECT forum_view_count from forum_view WHERE forum_ques_id='".$forum_ques_id."'")->row();
					 
					 $count_view_preset=count($view);
					 if($count_view_preset>0){
						$topic->total_view=$view->forum_view_count; 
					 }else{
						 $topic->total_view=0;
					 }
					  
					  $comment = $this->db->query("SELECT date AS comment_date from forum_comment WHERE forum_ques_id='".$forum_ques_id."' ORDER BY forum_comment_id DESC limit 1")->row(); 
					
					     $count_time=$topic->last_comment_time=count($comment);
					     if($count_time>0){
							$topic->last_comment_time=$comment->comment_date; 
						 }else{
							$topic->last_comment_time=''; 
						 }
					 $rows->topic[]=$topic;
					 }

					 //            
			   $data[] = $rows;
			}
            }

            $q->free_result();
            return $data;

        }
    }
	   
	   public function forumLatestcomments(){
		   
		  $sql= "SELECT hct.forum_cat_url,hq.*, hq.`forum_ques_id`,hu.user_first_name,hu.user_last_name,hu.profile_picture, COUNT(hc.forum_comment_id) AS comments
FROM  forum_question as hq LEFT JOIN forum_comment AS hc ON hc.forum_ques_id=hq.forum_ques_id  INNER JOIN  tbl_user_master AS hu ON hu.user_id=hq.user_id INNER JOIN forum_category AS hct ON hct.forum_cat_id=hq.forum_cat_id
GROUP BY hc.`forum_ques_id` ORDER BY comments DESC limit 3";
		   $query = $this->db->query($sql);
        $topics=$query->result();  
	               	$data=array();
				     foreach($topics as $topic) {
                  	 // coments liks
					
				   $forum_ques_id=$topic->forum_ques_id;
				  $topic->total_like = $this->db->query("SELECT * from forum_like WHERE forum_ques_id='".    $forum_ques_id."'")->num_rows();
					
				    $topic->total_comment = $this->db->query("SELECT * from forum_comment WHERE forum_ques_id='".$forum_ques_id."'")->num_rows();
					  
					 $view = $this->db->query("SELECT forum_view_count from forum_view WHERE forum_ques_id='".$forum_ques_id."'")->row();
					 
					 $count_view_preset=count($view);
					 if($count_view_preset>0){
						$topic->total_view=$view->forum_view_count; 
					 }else{
						 $topic->total_view=0;
					 }
					  
					  $comment = $this->db->query("SELECT date AS comment_date from forum_comment WHERE forum_ques_id='".$forum_ques_id."' ORDER BY forum_comment_id DESC limit 1")->row(); 
					
					     $count_time=$topic->last_comment_time=count($comment);
					     if($count_time>0){
							$topic->last_comment_time=$comment->comment_date; 
						 }else{
							$topic->last_comment_time=''; 
						 }
					 $data[]=$topic;
					
					 }
            return $data;
		
		
	   }
	   
	   
		
		function jointwoTable($select,$table1,$table2,$where,$equal) {

			$this->db->select($select);
			$this->db->from($table1);
			$this->db->join($table2, $equal);			
			$this->db->where($where); 
			return $this->db->get()->row();
			
		}	
		
		function jointhreetable($table, $field_first, $table1, $field_second,$table2,$field_third,$value,$where='',$order_id, $order_arg,$field,$start=0,$limit='') {

			$this->db->select($field);
			 $this->db->order_by($order_id, $order_arg);
			$this->db->from("$table");
			$this->db->join("$table1", "$table1.$field_second = $table.$field_first");
			$this->db->join("$table2", "$table2.$field_third = $table.$value");		
			if($where !=''){
			$this->db->where($where); 
			}
			if($limit != ''){
			$this->db->limit($limit,$start);
			}
			 $q = $this->db->get();
			if($q->num_rows() > 0) {
				foreach($q->result() as $rows) {
					$data[] = $rows;
				}
				$q->free_result();
				return $data;
			}
		}		
	
	function jointwotablepag($table, $field_first, $table1, $field_second,$where='',$order_id, $order_arg,$field,$start=0,$limit='') {

			$this->db->select($field);
			 $this->db->order_by($order_id, $order_arg);
			$this->db->from("$table");
			$this->db->join("$table1", "$table1.$field_second = $table.$field_first");		
			if($where !=''){
			$this->db->where($where); 
			}
			if($limit != ''){
			$this->db->limit($limit,$start);
			}
			 $q = $this->db->get();
        if($q->num_rows() > 0) {
            foreach($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
            return $data;
        }
		}	
	 public function get_all_data_count($table,$where)
    {
       
	   $this->db->select('*');
       $this->db->where($where);
       $result = $this->db->get($table)->result();
        return $result;
    }

	function get_ff(){
		
		$q_main = $this->db->query("SELECT forum_comment_id,forum_comment_parent_id, date AS fdate FROM forum_comment WHERE comment_type = 'parent' ORDER BY forum_comment_id DESC");
	
		    $maindata=array();
		foreach($q_main->result() AS $main){
						
			$q_main1 = $this->db->query("SELECT forum_comment_id,forum_comment_parent_id,date AS fdate FROM forum_comment WHERE comment_type = 'child' AND forum_comment_parent_id='".$main->forum_comment_id."' ORDER BY forum_comment_id DESC LIMIT 1 ");
			$r_main=$q_main1->row();
			if($r_main){
			$maindata[$main->forum_comment_id]=$r_main->fdate;
			} else{
			$maindata[$main->forum_comment_id]=$main->fdate;
			}
		 		
		}
		
			return $maindata;
	}
	
	  function get_forum_comment($limit, $start, $forum_ques_id)
    {  
	
	  /*
		 if($where !=''){
        $this->db->where($where); 
        $this->db->where(array("comment_type"=>'parent')); 
        }
		*/
	 /*$sql="SELECT `tbl_user_master`.*, `forum_comment`.`date` AS `cmdate`, `forum_comment`.`forum_comment_description`, `forum_comment`.`forum_comment_id`, `forum_comment`.`forum_ques_id`, `forum_comment`.`forum_comment_file`, `forum_comment`.`comment_type`, `forum_comment`.`forum_comment_parent_id` FROM `forum_comment` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_comment`.`user_id` WHERE `forum_ques_id` = '".$forum_ques_id."' AND `comment_type` = 'parent' ORDER BY `forum_comment`.`forum_comment_id` DESC limit " . $start . ", " . $limit;
	*/
	
	$q_main = $this->db->query("SELECT forum_comment_id,forum_comment_parent_id, date AS fdate FROM forum_comment WHERE `forum_ques_id` = '".$forum_ques_id."' AND comment_type = 'parent' ORDER BY forum_comment_id ASC limit " . $start . ", " . $limit);
	
		    $maindata=array();
		foreach($q_main->result() AS $main){
						
			$q_main1 = $this->db->query("SELECT forum_comment_id,forum_comment_parent_id,date AS fdate FROM forum_comment WHERE comment_type = 'child' AND forum_comment_parent_id='".$main->forum_comment_id."' ORDER BY forum_comment_id ASC LIMIT 1 ");
			$r_main=$q_main1->row();
			if($r_main){
			$maindata[$main->forum_comment_id]=$r_main->fdate;
			} else{
			$maindata[$main->forum_comment_id]=$main->fdate;
			}
		 		
		}
	
	
	  asort($maindata);
	$data=[];
       foreach($maindata AS $key => $value){
		  

   $sql="SELECT `tbl_user_master`.*, `forum_comment`.`abuse_forum`,`forum_comment`.`date` AS `cmdate`, `forum_comment`.`forum_comment_description`, `forum_comment`.`forum_comment_id`, `forum_comment`.`forum_ques_id`, `forum_comment`.`forum_comment_file`, `forum_comment`.`comment_type`, `forum_comment`.`forum_comment_parent_id` FROM `forum_comment` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_comment`.`user_id` WHERE `forum_comment_id` = '".$key."' AND `comment_type` = 'parent'";
	
	
	 $q = $this->db->query($sql);
	   $rows=$q->row();
       /* if($q->num_rows() > 0) {
           foreach($q->result() as $rows) {
			   }       
           // return $data;
        }
		*/
				$forum_comment_id=$rows->forum_comment_id;
			$q_child=$this->db->query("
				SELECT `tbl_user_master`.*, `forum_comment`.`date` AS `cmdate`, `forum_comment`.`forum_comment_parent_id`,`forum_comment`.`forum_comment_description`, `forum_comment`.`forum_comment_id`, `forum_comment`.`forum_ques_id`, `forum_comment`.`forum_comment_file`, `forum_comment`.`comment_type` FROM `forum_comment` INNER JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_comment`.`user_id` WHERE `forum_comment`.`forum_comment_parent_id` = '".$key."' AND `comment_type` = 'child' GROUP BY forum_comment.`forum_comment_id` ");
						
		         $rows->childact = $q_child->num_rows();
				if($rows->childact > 0) {
					$data_child='';
				 foreach($q_child->result() as $rows_child) {
					
                  $forum_ques_id=$rows_child->forum_ques_id;
				 $forum_comment_id=$rows_child->forum_comment_id;
				       // coments liks
					  $query = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."'");
			          $rows_child->comment_likes=$query->num_rows();
					  //user likes
					  if($this->session->userdata('userId')){
					   $query1 = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."' AND user_id='".$this->session->userdata('userId')."'");
			          $rows_child->comment_like_me=$query1->num_rows();
					  }else{
						  $rows_child->comment_like_me=0;
					  }
					  
               $data_child[] = $rows_child;
              
					
				  }
				  
				$rows->child_comment=$data_child;	
			
			}  else{
				$rows->child_comment='';
			}
			
				 $forum_ques_id=$rows->forum_ques_id;
				 $forum_comment_id=$rows->forum_comment_id;
				       // coments liks
					  $query = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."'");
			          $rows->comment_likes=$query->num_rows();
					  //user likes
					  if($this->session->userdata('userId')){
					   $query1 = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."' AND user_id='".$this->session->userdata('userId')."'");
			          $rows->comment_like_me=$query1->num_rows();
					  } else{
						  $rows->comment_like_me=0;
					  }
					  
                $data[] = $rows;
            
		
		
		}
	
		
		return $data;
    }
	
   
   function get_forum_comment_count($forum_ques_id)
    {    
	     
	$sql="SELECT `tbl_user_master`.*, `forum_comment`.`date` AS `cmdate`, `forum_comment`.`forum_comment_description`, `forum_comment`.`forum_comment_id`, `forum_comment`.`forum_ques_id`, `forum_comment`.`forum_comment_file`, `forum_comment`.`comment_type`, `forum_comment`.`forum_comment_parent_id` FROM `forum_comment` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_comment`.`user_id` WHERE `forum_ques_id` = '".$forum_ques_id."' AND `comment_type` = 'parent' ORDER BY `forum_comment`.`forum_comment_id` DESC";  
	   $query = $this->db->query($sql);
        return $query->num_rows();
    }
	  function get_forum_comment_admin($limit, $start, $forum_ques_id)
    {  
	$data = '';
	  /*
		 if($where !=''){
        $this->db->where($where); 
        $this->db->where(array("comment_type"=>'parent')); 
        }
		*/
	 /*$sql="SELECT `tbl_user_master`.*, `forum_comment`.`date` AS `cmdate`, `forum_comment`.`forum_comment_description`, `forum_comment`.`forum_comment_id`, `forum_comment`.`forum_ques_id`, `forum_comment`.`forum_comment_file`, `forum_comment`.`comment_type`, `forum_comment`.`forum_comment_parent_id` FROM `forum_comment` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_comment`.`user_id` WHERE `forum_ques_id` = '".$forum_ques_id."' AND `comment_type` = 'parent' ORDER BY `forum_comment`.`forum_comment_id` DESC limit " . $start . ", " . $limit;
	*/
	
	$q_main = $this->db->query("SELECT forum_comment_id,forum_comment_parent_id, date AS fdate FROM forum_comment WHERE `forum_ques_id` = '".$forum_ques_id."' AND comment_type = 'parent' ORDER BY forum_comment_id DESC limit " . $start . ", " . $limit);
	
		    $maindata=array();
		foreach($q_main->result() AS $main){
						
			$q_main1 = $this->db->query("SELECT forum_comment_id,forum_comment_parent_id,date AS fdate FROM forum_comment WHERE comment_type = 'child' AND forum_comment_parent_id='".$main->forum_comment_id."' ORDER BY forum_comment_id DESC LIMIT 1 ");
			$r_main=$q_main1->row();
			if($r_main){
			$maindata[$main->forum_comment_id]=$r_main->fdate;
			} else{
			$maindata[$main->forum_comment_id]=$main->fdate;
			}
		 		
		}
	
	
	  asort($maindata);
	
       foreach($maindata AS $key => $value){
		  

   $sql="SELECT `tbl_user_master`.*, `forum_comment`.`date` AS `cmdate`, `forum_comment`.`forum_comment_description`, `forum_comment`.`forum_comment_id`, `forum_comment`.`forum_ques_id`, `forum_comment`.`forum_comment_file`, `forum_comment`.`comment_type`, `forum_comment`.`forum_comment_parent_id` FROM `forum_comment` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_comment`.`user_id` WHERE `forum_comment_id` = '".$key."' AND `comment_type` = 'parent'";
	
	
	 $q = $this->db->query($sql);
	   $rows=$q->row();
       /* if($q->num_rows() > 0) {
           foreach($q->result() as $rows) {
			   }       
           // return $data;
        }
		*/
				$forum_comment_id=$rows->forum_comment_id;
			$q_child=$this->db->query("
				SELECT `tbl_user_master`.*, `forum_comment`.`date` AS `cmdate`, `forum_comment`.`forum_comment_parent_id`,`forum_comment`.`forum_comment_description`, `forum_comment`.`forum_comment_id`, `forum_comment`.`forum_ques_id`, `forum_comment`.`forum_comment_file`, `forum_comment`.`comment_type` FROM `forum_comment` INNER JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_comment`.`user_id` WHERE `forum_comment`.`forum_comment_parent_id` = '".$key."' AND `comment_type` = 'child' GROUP BY forum_comment.`forum_comment_id` ORDER BY `forum_comment`.`forum_comment_id` ASC");
						
		         $rows->childact = $q_child->num_rows();
				if($rows->childact > 0) {
					$data_child='';
				 foreach($q_child->result() as $rows_child) {
					
                  $forum_ques_id=$rows_child->forum_ques_id;
				 $forum_comment_id=$rows_child->forum_comment_id;
				       // coments liks
					  $query = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."'");
			          $rows_child->comment_likes=$query->num_rows();
					 
					if($_SESSION['logged_in']){
						  // for admin
						     $query1 = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."' AND user_id='1'");
			          $rows_child->comment_like_me=$query1->num_rows();
					  }else{
						  $rows_child->comment_like_me=0;
					  }
					  
               $data_child[] = $rows_child;
              
					
				  }
				  
				$rows->child_comment=$data_child;	
			
			}  else{
				$rows->child_comment='';
			}
			
				 $forum_ques_id=$rows->forum_ques_id;
				 $forum_comment_id=$rows->forum_comment_id;
				       // coments liks
					  $query = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."'");
			          $rows->comment_likes=$query->num_rows();
					  //user likes
					  if($_SESSION['logged_in']){
					   $query1 = $this->db->query("SELECT * from forum_like WHERE forum_comment_id='".$forum_comment_id."' AND forum_ques_id='".$forum_ques_id."' AND user_id='1'");
			          $rows->comment_like_me=$query1->num_rows();
					  } else{
						  $rows->comment_like_me=0;
					  }
					  
                $data[] = $rows;
            
		
		
		}
	
		
		return $data;
    }
	
	function get_post_comment($limit, $start, $post_id)
    {    
	     
	$sql="SELECT `tbl_user_master`.*, `healthcare_post_comment`.`comment`,`healthcare_post_comment`.`comment_id` FROM `healthcare_post_comment` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `healthcare_post_comment`.`user_id` WHERE `post_id` = '".$post_id."' ORDER BY healthcare_post_comment.comment_id DESC limit " . $start . ", " . $limit;;   
	   $query = $this->db->query($sql); 
       return $query->result();
    }
	function get_post_comment_count($post_id)
    {    
	     
	$sql="SELECT `tbl_user_master`.*, `healthcare_post_comment`.`comment` FROM `healthcare_post_comment` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `healthcare_post_comment`.`user_id` WHERE `post_id` = '".$post_id."' ORDER BY healthcare_post_comment.comment_id";  
	   $query = $this->db->query($sql);
        return $query->num_rows();
    }
	
	  	function get_forum_topic_12($limit, $start, $forum_cat_url) {

       $sql="SELECT `forum_question`.*, `forum_category`.`forum_cat_name`, `forum_category`.`forum_cat_url`, `tbl_user_master`.* FROM `forum_question` JOIN `forum_category` ON `forum_category`.`forum_cat_id` = `forum_question`.`forum_cat_id` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_question`.`user_id` WHERE  `forum_category`.`forum_cat_url` = '".$forum_cat_url."' ORDER BY `forum_question`.`forum_ques_id` DESC limit " . $start . ", " . $limit;
	  
	  $q = $this->db->query($sql);
        if($q->num_rows() > 0) {
            foreach($q->result() as $rows) {
				
				  $forum_ques_id=$rows->forum_ques_id;
				  $rows->total_like = $this->db->query("SELECT * from forum_like WHERE forum_ques_id='".$forum_ques_id."'")->num_rows();
					
				    $rows->total_comment = $this->db->query("SELECT * from forum_comment WHERE forum_ques_id='".$forum_ques_id."'")->num_rows();
					  
					  
					   $view = $this->db->query("SELECT forum_view_count from forum_view WHERE forum_ques_id='".$forum_ques_id."'")->row();
					 
					 $count_view_preset=count($view);
					 if($count_view_preset>0){
						$rows->total_view=$view->forum_view_count; 
					 }else{
						 $rows->total_view=0;
					 }
					  
					  
					  $comment = $this->db->query("SELECT date AS comment_date from forum_comment WHERE forum_ques_id='".$forum_ques_id."' ORDER BY forum_comment_id DESC limit 1")->row(); 
					
					     $count_time=count($comment);
					     if($count_time>0){
							$rows->last_comment_time=$comment->comment_date; 
						 }else{
							$rows->last_comment_time=''; 
						 }
				
				       
				
				
				
				
                $data[] = $rows;
				
				
            }
            $q->free_result();
            return $data;
        }
    }
	
	   	function get_forum_topic($limit, $start, $forum_cat_url) {

       $sql="SELECT `forum_question`.*, `forum_category`.`forum_cat_name`, `forum_category`.`forum_cat_url`, `tbl_user_master`.* FROM `forum_question` JOIN `forum_category` ON `forum_category`.`forum_cat_id` = `forum_question`.`forum_cat_id` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_question`.`user_id` WHERE `forum_question`.`forum_ques_status` = 'Aproved' AND `forum_category`.`forum_cat_url` = '".$forum_cat_url."' ORDER BY `forum_question`.`forum_ques_id` DESC limit " . $start . ", " . $limit;
	  
	  $q = $this->db->query($sql);
        if($q->num_rows() > 0) {
            foreach($q->result() as $rows) {
				
				  $forum_ques_id=$rows->forum_ques_id;
				  $rows->total_like = $this->db->query("SELECT * from forum_like WHERE forum_ques_id='".$forum_ques_id."'")->num_rows();
					
				    $rows->total_comment = $this->db->query("SELECT * from forum_comment WHERE forum_ques_id='".$forum_ques_id."'")->num_rows();
					  
					  
					   $view = $this->db->query("SELECT forum_view_count from forum_view WHERE forum_ques_id='".$forum_ques_id."'")->row();
					 
					 $count_view_preset=count($view);
					 if($count_view_preset>0){
						$rows->total_view=$view->forum_view_count; 
					 }else{
						 $rows->total_view=0;
					 }
					  
					  
					  $comment = $this->db->query("SELECT date AS comment_date from forum_comment WHERE forum_ques_id='".$forum_ques_id."' ORDER BY forum_comment_id DESC limit 1")->row(); 
					
					     $count_time=count($comment);
					     if($count_time>0){
							$rows->last_comment_time=$comment->comment_date; 
						 }else{
							$rows->last_comment_time=''; 
						 }
				
				       
				
				
				
				
                $data[] = $rows;
				
				
            }
            $q->free_result();
            return $data;
        }
    }

	 function get_forum_topic_count($forum_cat_url)
    {    
	     
	$sql="SELECT `forum_question`.*, `forum_category`.`forum_cat_name`, `forum_category`.`forum_cat_url`, `tbl_user_master`.* FROM `forum_question` JOIN `forum_category` ON `forum_category`.`forum_cat_id` = `forum_question`.`forum_cat_id` JOIN `tbl_user_master` ON `tbl_user_master`.`user_id` = `forum_question`.`user_id` WHERE `forum_question`.`forum_ques_status` = 'Aproved' AND `forum_category`.`forum_cat_url` = '".$forum_cat_url."' ORDER BY `forum_question`.`forum_ques_id` DESC LIMIT 8";  
	   $query = $this->db->query($sql);
        return $query->num_rows();
    }
	
	
	
	
	  function get_article_expert($limit, $start, $src = NULL, $st = NULL)
    {  
          $userId=$this->session->userdata('userId');
		if ($src == "NIL") {$src = "";}
		 if ($st == "NIL") {$st = "";}
	
	  $sql="SELECT ph.*, hc.* FROM healthcare_post AS ph INNER JOIN healthcare_category AS hc ON ph.category_id=hc.category_id WHERE ph.post_status like '%".$st."%' AND (ph.post_title like '%".$src."%' OR hc.category_name like '%".$src."%')  AND ph.user_id='".$userId."' ORDER BY ph.post_id DESC limit " . $start . ", " . $limit;
	  $query = $this->db->query($sql);
        return $query->result();
	
    }
	
   
    function get_article_count_expert($src = NULL , $st = NULL)
    {    
	      $userId=$this->session->userdata('userId');
         if ($src == "NIL") $src = "";
		if ($st == "NIL") {$st = "";}

	$sql="SELECT ph.*, hc.* FROM healthcare_post AS ph INNER JOIN healthcare_category AS hc ON ph.category_id=hc.category_id WHERE ph.post_status like '%".$st."%' AND (ph.post_title like '%".$src."%' OR hc.category_name like '%".$src."%') AND ph.user_id='".$userId."' ORDER BY ph.post_id DESC";  
	   $query = $this->db->query($sql);
        return $query->num_rows();
    }
	
	
	
    function get_article_admin($limit, $start, $src = NULL, $st = NULL)
    {  
        if ($src == "NIL") {$src = "";}
		 if ($st == "NIL") {$st = "";}
	
	  $sql="SELECT ph.*, hc.* FROM healthcare_post AS ph INNER JOIN healthcare_category AS hc ON ph.category_id=hc.category_id WHERE ph.post_status like '%".$st."%' AND (ph.post_title like '%".$src."%' OR hc.category_name like '%".$src."%') ORDER BY ph.post_id DESC limit " . $start . ", " . $limit;
	  $query = $this->db->query($sql);
        return $query->result();
    }
	
   
    function get_article_count_admin($src = NULL , $st = NULL)
    {  
        if ($src == "NIL") $src = "";
		if ($st == "NIL") {$st = "";}

	$sql="SELECT ph.*, hc.* FROM healthcare_post AS ph INNER JOIN healthcare_category AS hc ON ph.category_id=hc.category_id WHERE ph.post_status like '%".$st."%' AND (ph.post_title like '%".$src."%' OR hc.category_name like '%".$src."%') ORDER BY ph.post_id DESC";  
	   $query = $this->db->query($sql);
        return $query->num_rows();
    }
	
	
	  function get_product_admin($limit, $start, $src = NULL, $st = NULL)
    {  
        if ($src == "NIL") {$src = "";}
		 if ($st == "NIL") {$st = "";}
	
	  $sql="SELECT ph.*, hc.* FROM healthcare_product AS ph INNER JOIN  healthcare_product_category AS hc ON ph.product_cat_id=hc.product_cat_id WHERE ph.product_status like '%".$st."%' AND (ph.product_title like '%".$src."%' OR hc.product_cat_name like '%".$src."%') ORDER BY ph.product_id DESC limit " . $start . ", " . $limit;
	  $query = $this->db->query($sql);
        return $query->result();
    }
	
   
    function get_product_count_admin($src = NULL , $st = NULL)
    {  
        if ($src == "NIL") $src = "";
		if ($st == "NIL") {$st = "";}

	$sql="SELECT ph.*, hc.* FROM healthcare_product AS ph INNER JOIN  healthcare_product_category AS hc ON ph.product_cat_id=hc.product_cat_id WHERE ph.product_status like '%".$st."%' AND (ph.product_title like '%".$src."%' OR hc.product_cat_name like '%".$src."%') ORDER BY ph.product_id DESC";  
	   $query = $this->db->query($sql);
        return $query->num_rows();
    }
	
	
	  function get_doctor_admin($limit, $start, $src= NULL , $st= NULL , $stur= NULL , $stct= NULL )
    {  
	
        if ($src == "NIL") {$src = "";}
		 if ($st == "NIL") {$st = "";}
		 if ($stur == "NIL") {$stur = "";}
		 if ($stct == "NIL") {
			$and ='';
			if($stur == 'user'){
				$not='!';
			} else{
				$not='';
			}			
			 } else {
				 if($stur == 'user'){ 
					$not='!';
					$and='';
				} else{
					$not='';	
					$and ="AND hc.doctor_cat_id like '%".$stct."%'";
				}
			 }
	
	
	  $sql="SELECT ph.*, hc.* FROM tbl_user_master AS ph Right JOIN  healthcare_doctor_category AS hc ON ph.doctor_cat_id ".$not."=hc.doctor_cat_id WHERE ph.user_status like '%".$st."%' AND ph.user_first_name like '%".$src."%'   AND ph.user_type like '%".$stur."%' ".$and." GROUP BY ph.user_id ORDER BY ph.user_id DESC limit " . $start . ", " . $limit;
	  $query = $this->db->query($sql);
        return $query->result();
    }
	
   
    function get_doctor_count_admin($src = NULL, $st = NULL, $stur = NULL ,$stct = NULL)
    {  
         if ($src == "NIL") {$src = "";}
		 if ($st == "NIL") {$st = "";}
		 if ($stur == "NIL") {$stur = "";}
		 if ($stct == "NIL") {
			$and ='';
				if($stur == 'user'){ 
					$not='!';
					$and ='';
				} else{
					$not='';
				}	
				
			 } else {
				 
				 if($stur == 'user'){ 
					$not='!';
					$and='';
				} else {
					$not='';	
					$and ="AND hc.doctor_cat_id like '%".$stct."%'";
				}
				 
			
				
			 }

	$sql="SELECT ph.*, hc.* FROM tbl_user_master AS ph INNER JOIN  healthcare_doctor_category AS hc ON ph.doctor_cat_id ".$not."=hc.doctor_cat_id WHERE ph.user_status like '%".$st."%' AND ph.user_first_name like '%".$src."%'  AND ph.user_type like '%".$stur."%' ".$and." GROUP BY ph.user_id ORDER BY ph.user_id DESC ";  
	   $query = $this->db->query($sql);
        return $query->num_rows();
    }
	
	  function get_search($limit, $start, $type = NULL, $search = NULL)
    {  
        if ($type == "NIL") {$type = "";}
		if ($search == "NIL") {$search = "";}
		
		if ($type == "article") {
		 $sql="SELECT 'article' AS search_type ,hp.post_id AS search_id, hp.post_title AS search_title, hp.post_description AS search_desc, hp.`post_url` AS url2, hc.cate_url AS url1, hp.post_image AS search_image FROM `healthcare_post` AS hp INNER JOIN healthcare_category AS hc ON hp.category_id =hc.category_id WHERE hp.post_title LIKE '%".$search."%' ORDER BY hp.post_id DESC limit ".$start.", ".$limit;	
		}
		
		if($type == "product"){
			
			$sql="SELECT 'product' AS search_type ,hp.product_id AS search_id, hp.product_title AS search_title, hp.product_description AS search_desc, hp.`product_url` AS url2, hc.product_cat_url AS url1, hp.product_image AS search_image FROM `healthcare_product` AS hp INNER JOIN healthcare_product_category AS hc ON hp.product_cat_id=hc.product_cat_id WHERE hp.product_title LIKE '%".$search."%' ORDER BY hp.product_id DESC limit  ".$start.", ".$limit;	
		}

		if($type == "forum"){
			$sql="SELECT 'forum' AS search_type ,hp.forum_ques_id AS search_id, hp.forum_ques_title AS search_title, hp.forum_ques_description AS search_desc, hp.`forum_ques_url` AS url2, hc.forum_cat_url AS url1 FROM `forum_question` AS hp INNER JOIN forum_category AS hc ON hp.forum_cat_id=hc.forum_cat_id WHERE hp.forum_ques_title LIKE '%".$search."%' ORDER BY hp.forum_ques_id DESC limit ".$start.", ".$limit;
		}
		
	  $query = $this->db->query($sql);
      return $query->result();
	 // print_r($query->result());
	 // die;
    }
	
   
    function get_search_count($type = NULL, $search = NULL)
    {  
         if ($type == "NIL") {$type = "";}
		if ($search == "NIL") {$search = "";}
		
		if ($type == "article") {
		 $sql="SELECT 'article' AS search_type ,hp.post_id AS search_id, hp.post_title AS search_title, hp.post_description AS search_desc, hp.`post_url` AS url2, hc.cate_url AS url1 FROM `healthcare_post` AS hp INNER JOIN healthcare_category AS hc ON hp.category_id =hc.category_id WHERE hp.post_title LIKE '%".$search."%' ORDER BY hp.post_id DESC";	
		}

			if($type == "product"){
			
			$sql="SELECT 'product' AS search_type ,hp.product_id AS search_id, hp.product_title AS search_title, hp.product_description AS search_desc, hp.`product_url` AS url2, hc.product_cat_url AS url1 FROM `healthcare_product` AS hp INNER JOIN healthcare_product_category AS hc ON hp.product_cat_id=hc.product_cat_id WHERE hp.product_title LIKE '%".$search."%' ORDER BY hp.product_id DESC";
		}
		
		
			if($type == "forum"){
			$sql="SELECT 'forum' AS search_type ,hp.forum_ques_id AS search_id, hp.forum_ques_title AS search_title, hp.forum_ques_description AS search_desc, hp.`forum_ques_url` AS url2, hc.forum_cat_url AS url1 FROM `forum_question` AS hp INNER JOIN forum_category AS hc ON hp.forum_cat_id=hc.forum_cat_id WHERE hp.forum_ques_title LIKE '%".$search."%' ORDER BY hp.forum_ques_id DESC";
		}
		
		
	   $query = $this->db->query($sql);
        return $query->num_rows();
    }
	
	
	   
}
?>