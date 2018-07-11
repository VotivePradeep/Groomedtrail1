<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

	public function insertData($table,$datainsert)
	{
		$this->db->insert($table,$datainsert);
		return $this->db->insert_id();
	}
	
	public function updateData($table,$data,$where)
	{
	   $this->db->update($table,$data,$where);
	   return;
	}
	
	function getcountsum($table, $where, $value)
    {
        $this->db->select('count(prize_poll_id) as cnt,sum(price) as sum');
		if($value) {
			$this->db->where($where);	
			$this->db->where($value);
			$q = $this->db->get($table);
		} else {
			$q = $this->db->get_where($table, $where);
		}
        return $q->row();
    } 
	
	public function updateData1($table,$data,$where)
	{
	   $this->db->update($table,$data,$where);
	   return $this->db->affected_rows();
	}
	
	public function getMessageuser($fields,$where)
	{
	 	$this->db->select($fields);
		$this->db->join('users', 'message.sendfrom = users.user_id');  
        if($where !=''){
           $this->db->where($where); 
        }
        $this->db->order_by( 'message.id', 'desc' );		
        $this->db->group_by('sendfrom');
		$this->db->group_by('sendto');
		$this->db->from('message');
		
		$query = $this->db->get();
		return $query->result(); 
	} 
	
	public function delete($table,$where)
	{
	   $this->db->delete($table,$where);
	   return;
	}
	
	public function countuser($table)
	{
	   $this->db->select('*');
	   $q = $this->db->get($table);
	  return $q->num_rows();
	   
	}
	
	public function countwhereuser($table,$where)
	{
	   $this->db->select('*');
	   $q = $this->db->get_where($table,$where);
	  return $q->num_rows();
	   
	}
	
	public function getsingle($table,$where)
	{
		$q = $this->db->get_where($table,$where);
		return $q->row();
	}
	
	public function getAllwhere($table,$where)
	{
		$this->db->select('*');
		$q = $this->db->get_where($table,$where);
		$num_rows = $q->num_rows();
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	
	public function getAllwheresecond($table)
	{
		$this->db->select('*');
		$q = $this->db->get_where($table,array('user_id !='=> $this->session->userdata('userid')));
		$num_rows = $q->num_rows();
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	
	public function get_all_results_withFields_Like_con($table,$fields,$where,$likeField,$likeVal)
	 {
	 	$this->db->select($fields);
		$this->db->like($likeField,$likeVal);
		if(!empty($where))
		{
			$this->db->where($where);
		}
		
		$this->db->from($table);
		$query = $this->db->get();
		
		return $query->result(); 
	 } 
	
	public function getAllwhereseconds($table)
	{
		$this->db->select('*');
		$q = $this->db->get_where($table,array('user_id !='=> $this->session->userdata('userid'),'active_status' => 1));
		$num_rows = $q->num_rows();
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	
	public function getAllorderby($table)
	{
		$this->db->select('*');
		$this->db->order_by("user_id", "desc");
		$q = $this->db->get($table);		
		$num_rows = $q->num_rows();		
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	
	public function getAll($table)
	{
		$this->db->select('*');		
		$q = $this->db->get($table);		
		$num_rows = $q->num_rows();		
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	
	public function getAlltournament($table,$where)
	{
		$this->db->select('*');	
         $this->db->order_by('id', 'desc');
         //$this->db->limit(3);		
		$q = $this->db->get_where($table,$where);   	
		$num_rows = $q->num_rows();		
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			
			return $data;
		}
	}
	public function getAllfeature($table,$where)
	{
		$this->db->select('*');	
         $this->db->order_by('id', 'desc');
         $this->db->limit(3);		
		//$q = $this->db->get($table);  
        $q = $this->db->get_where($table,$where);		
		$num_rows = $q->num_rows();		
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			
			return $data;
		}
	}
public function getAll1($table,$cid)
	{
		$this->db->select('*');	
        $this->db->order_by($cid, "desc");			
		$q = $this->db->get($table);		
		$num_rows = $q->num_rows();		
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	
	public function getAll1where($table,$cid,$where)
	{
		$this->db->select('*');	
        $this->db->order_by($cid, "desc");			
		$q = $this->db->get_where($table,$where);		
		$num_rows = $q->num_rows();		
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	
	
	public function getAllorder($table)
	{
		$this->db->select('*');
        $this->db->order_by("ads_id", "desc");		
		$q = $this->db->get($table);		
		$num_rows = $q->num_rows();		
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	public function getAllweborder($table)
	{
		$this->db->select('*');
        $this->db->order_by("id", "desc");		
		$q = $this->db->get($table);		
		$num_rows = $q->num_rows();		
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	
    function jointwotable($table, $field_first, $table1, $field_second,$where='',$field) {

        $this->db->select($field);
        $this->db->from("$table");
			
        $this->db->join("$table1", "$table1.$field_second = $table.$field_first"); 
        if($where !=''){
        $this->db->where($where); 
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
	
	
	
	function jointwotablenum($table, $field_first, $table1, $field_second,$where='',$field,$limit) {

        $this->db->select($field);
        $this->db->from("$table");
        $this->db->join("$table1", "$table1.$field_second = $table.$field_first"); 
        if($where !=''){
        $this->db->where($where); 
        }
		 if ($limit != '')
        {
            $this->db->limit($limit);
        }
        $q = $this->db->get();
        if($q->num_rows() > 0) {
            foreach($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
			//$data['nm'] = $q->num_rows();
            return $data;
        }
    }
	
	
	function jointhreetable($table, $field_first, $table1, $field_second,$table2,$field_third,$value,$where='',$order_id, $order_arg,$field) {

        $this->db->select($field);
		$this->db->order_by($order_id, $order_arg);
        $this->db->from("$table");
        $this->db->join("$table1", "$table1.$field_second = $table.$field_first");
        $this->db->join("$table2", "$table2.$field_third = $table.$value");		
        if($where !=''){
        $this->db->where($where); 
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
	
	function searchimagelike($like,$where,$num,$offset,$sort_by, $sort_order)
    {   
		
		$this->db->select('*');
		$this->db->where($where);
		$this->db->like('media_type',$like,'both');
		$this->db->order_by($sort_by, $sort_order);
		$q = $this->db->get('media', $num, $offset);
   
        $num_rows = $q->num_rows();
        if ($num_rows > 0)
        {
            foreach ($q->result() as $rows)
            {
                $data[] = $rows;
            }
            $q->free_result();
            $ret['rows'] = $data;
        }

        $this->db->select('*');
		
		$this->db->where($where);
		$this->db->like('media_type',$like,'both');
		$this->db->order_by($sort_by, $sort_order);	
		$q = $this->db->get('media');
        $ret['num_rows'] = $q->num_rows();
        return $ret;
    }
	/*
	public function searchimagelike($like,$where)
	{ 
		$this->db->select('*');
		$this->db->from('media');
		$this->db->where($where);
		$this->db->like('media_type',$like,'both');
		return $this->db->get()->result();
	}
	*/
	
	function jointwotablelimit($table, $field_first, $table1, $field_second,$where,$num,$offset,$field)
    {   
		
		$this->db->select($field);
		//$this->db->from("$table1");   
        $this->db->join("$table1", "$table1.$field_second = $table.$field_first");

        $this->db->where($where); 
              	
		$this->db->order_by('comments.comment_id', 'desc');
		$q = $this->db->get($table, $num, $offset);
   
        $num_rows = $q->num_rows();
        if ($num_rows > 0)
        {
            foreach ($q->result() as $rows)
            {
                $data[] = $rows;
            }
            $q->free_result();
            $ret['rows'] = $data;
        }
       $this->db->select($field);
		
		$this->db->where($where);		
		$this->db->order_by('comments.comment_id', 'desc');
		$q = $this->db->get($table);
        $ret['num_rows'] = $q->num_rows();
        return $ret;
    }
	
	
	 public function fetch_data($limit, $start) {
        $this->db->limit($limit, $start);
		
        $query = $this->db->get("login");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	public function record_count() {
        return $this->db->count_all("login");
    }
	function emailChk($email)
    { 
        $this->db->select('SC.*');
        $this->db->from('users SC');
        $this->db->where('SC.email', $email);       
        $q = $this->db->get();
		//print_r($this->db->last_query());
        return $q->row();
    }
	
	
	public function get_all_results_with_join($fields,$table,$join_tbl3,$join_con3,$where='',$order_by_field,$order_by,$limit = '')
	{
		
	 	$this->db->select($fields);
		
        $this->db->join($join_tbl3, $join_con3);     		
		$this->db->from($table);
		if(!empty($where)){
			$this->db->where($where);
		}
		if(!empty($order_by_field )){
				$this->db->order_by( $order_by_field, $order_by );
		}
		$this->db->limit($limit);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result(); 
	} 
	
	public function getAllwhererandom($table,$where)
	{
		$this->db->select('*');
		 $this->db->order_by('ads_id', 'RANDOM');
         $this->db->limit(4);
		$q = $this->db->get_where($table,$where);
		$num_rows = $q->num_rows();
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
		
function getjoinall($table, $field_first, $table1, $field_second,
                        $table2 = '', $field_third = '', $table3 = '',
                        $field_forth = '', $value, $value1, $where='',$order_fld = '', $order_type = '',$limit, $field) {
						
		 if ($order_fld != '' && $order_type != '')
        {
            $this->db->order_by($order_fld, $order_type);
        }
        $this->db->select($field);
        $this->db->from("$table");
        $this->db->join("$table1", "$table1.$field_second = $table.$field_first","left");
        if($table2 != '' && $field_third != '') {
            $this->db->join("$table2", "$table2.$field_third = $table.$value","left");
        }
        if($table3 != '' && $field_forth != '') {
            $this->db->join("$table3", "$table3.$field_forth = $table.$value1","left");
        }
       
		 if ($where != '')
        {
            $this->db->where($where);
        }
		
		 if ($limit != '')
        {
            $this->db->limit($limit);
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
	
	function getAllJoin($num, $offset, $where, $type = 1, $table, $field1, $table1, $field2,$sort_by, $sort_order, $sort_columns, $field,$search = '')
    {
      
        if ($where && ($type == 1))
        {           
            $this->db->select($field);
            $this->db->join("$table1", "$table1.$field2 = $table.$field1");
           
            $q = $this->db->order_by($sort_by, $sort_order);
            $q = $this->db->get_where($table, $where, $num, $offset);
        } else
        {  
            $i = 1;
            // check condition
            if ($type == 'ser' && $where != '')
            {
              
                $this->db->select($field);
                $this->db->join("$table1", "$table1.$field2 = $table.$field1");
                
                foreach ($where as $key => $value)
                {
                    if ($key == '' && $value != '')
                    {
                        $this->db->like("$key", "$value", 'after');
                    } 
                    $i++;
                }
               
                $q = $this->db->order_by($sort_by, $sort_order);
                $q = $this->db->get($table, $num, $offset);
            } else
            {  
                $this->db->select($field);
                $this->db->join("$table1", "$table1.$field2 = $table.$field1");
                $q = $this->db->order_by($sort_by, $sort_order);
				if($search != ''){
				//$this->db->like('post.hashtag',$search,'after');
				$this->db->where(array('post.post_author !='=>12));
				$this->db->where("FIND_IN_SET('$search',post.hashtag) !=", 0);
				}
                $q = $this->db->get($table, $num, $offset);
            }
        }
        $num_rows = $q->num_rows();
        if ($num_rows > 0)
        {
            foreach ($q->result() as $rows)
            {
                $data[] = $rows;
            }
            $q->free_result();
            $ret['rows'] = $data;
        }

        // count Values
        if ($where && ($type == 1))
        {
            $this->db->select($field);
            $this->db->join("$table1", "$table1.$field2 = $table.$field1");
            $q = $this->db->get_where($table, $where);
        } else
        {
            $i = 1;
            // check condition
            if ($type == 'ser' && $where != '')
            {
                $this->db->select($field);
                $this->db->join("$table1", "$table1.$field2 = $table.$field1");
                               
                foreach ($where as $key => $value)
                {
                   if ($key == '' && $value != '')
                    {
                        $this->db->like("$key", "$value", 'after');
                    } 
                    
                    $i++;
                }
                $q = $this->db->get($table);
            } else
            {
                $this->db->select($field);
                $this->db->join("$table1", "$table1.$field2 = $table.$field1");
                if($search != ''){
				//$this->db->like('post.hashtag',$search, 'after');
				$this->db->where(array('post.post_author !='=>12));
				$this->db->where("FIND_IN_SET('$search',post.hashtag) !=", 0); 
				}				
                $q = $this->db->get($table);
            }
        }
        $ret['num_rows'] = $q->num_rows();
        return $ret;
    }
	
	function getAllJoinnew($num, $offset, $table, $field1, $table1, $field2,$sort_by, $sort_order, $sort_columns, $field,$search = '',$newwhere)
    {   
		$this->db->select($field);
		$this->db->join("$table1", "$table1.$field2 = $table.$field1");
		$q = $this->db->order_by($sort_by, $sort_order);
		if($search != ''){
		//$this->db->like('post.hashtag',$search,'after');
		if($newwhere != ''){
		   $this->db->where($newwhere);
		}
		$this->db->where("FIND_IN_SET('$search',post.hashtag) !=", 0);
		}
		$q = $this->db->get($table, $num, $offset);
   
        $num_rows = $q->num_rows();
        if ($num_rows > 0)
        {
            foreach ($q->result() as $rows)
            {
                $data[] = $rows;
            }
            $q->free_result();
            $ret['rows'] = $data;
        }

        // count Values
        $this->db->select($field);
		$this->db->join("$table1", "$table1.$field2 = $table.$field1");
		if($search != ''){
		//$this->db->like('post.hashtag',$search, 'after');
		if($newwhere != ''){
		   $this->db->where($newwhere);
		}
		$this->db->where("FIND_IN_SET('$search',post.hashtag) !=", 0); 
		}				
		$q = $this->db->get($table);
        $ret['num_rows'] = $q->num_rows();
        return $ret;
    }
	
	function getJointhreetable($num, $offset, $where, $type = 1, $table, $field1, $table1, $field2,$table2='',$field3='',$value,$sort_by, $sort_order, $sort_columns, $field,$search = '')
    {
        if ($where && ($type == 1))
        {           
            $this->db->select($field);
            $this->db->join("$table1", "$table1.$field2 = $table.$field1","left");
			if($table2 != '' && $field3 != '') {
			$this->db->join("$table2", "$table2.$field3 = $table.$value","left");
			}
            $q = $this->db->order_by($sort_by, $sort_order);
            $q = $this->db->get_where($table, $where, $num, $offset);
        } else
        {  
            $i = 1;
            // check condition
            if ($type == 'ser' && $where != '')
            {
              
                $this->db->select($field);
                $this->db->join("$table1", "$table1.$field2 = $table.$field1","left");
				if($table2 != '' && $field3 != '') {
			    $this->db->join("$table2", "$table2.$field3 = $table.$value","left");
                }
                foreach ($where as $key => $value)
                {
                    if ($key == '' && $value != '')
                    {
                        $this->db->like("$key", "$value", 'after');
                    } 
                    $i++;
                }
               
                $q = $this->db->order_by($sort_by, $sort_order);
                $q = $this->db->get($table, $num, $offset);
            } else
            {  
                $this->db->select($field);
                $this->db->join("$table1", "$table1.$field2 = $table.$field1","left");
				if($table2 != '' && $field3 != '') {
			    $this->db->join("$table2", "$table2.$field3 = $table.$value","left");
				}
                $q = $this->db->order_by($sort_by, $sort_order);
				if($search != ''){
				//$this->db->like('post.hashtag',$search,'after');
				$this->db->where("FIND_IN_SET('$search',post.hashtag) !=", 0);
				}
                $q = $this->db->get($table, $num, $offset);
            }
        }
        $num_rows = $q->num_rows();
        if ($num_rows > 0)
        {
            foreach ($q->result() as $rows)
            {
                $data[] = $rows;
            }
            $q->free_result();
            $ret['rows'] = $data;
        }

        // count Values
        if ($where && ($type == 1))
        {
            $this->db->select($field);
            $this->db->join("$table1", "$table1.$field2 = $table.$field1","left");
			if($table2 != '' && $field3 != '') {
			$this->db->join("$table2", "$table2.$field3 = $table.$value","left");
			}
            $q = $this->db->get_where($table, $where);
        } else
        {
            $i = 1;
            // check condition
            if ($type == 'ser' && $where != '')
            {
                $this->db->select($field);
                $this->db->join("$table1", "$table1.$field2 = $table.$field1","left");
				if($table2 != '' && $field3 != '') {
		    	$this->db->join("$table2", "$table2.$field3 = $table.$value","left");
				}
                               
                foreach ($where as $key => $value)
                {
                   if ($key == '' && $value != '')
                    {
                        $this->db->like("$key", "$value", 'after');
                    } 
                    
                    $i++;
                }
                $q = $this->db->get($table);
            } else
            {
                $this->db->select($field);
                $this->db->join("$table1", "$table1.$field2 = $table.$field1","left");
				if($table2 != '' && $field3 != '') {
			    $this->db->join("$table2", "$table2.$field3 = $table.$value","left");
				}
                if($search != ''){
				//$this->db->like('post.hashtag',$search, 'after');
				$this->db->where("FIND_IN_SET('$search',post.hashtag) !=", 0); 
				}				
                $q = $this->db->get($table);
            }
        }
        $ret['num_rows'] = $q->num_rows();
        return $ret;
    }

	
	public function gethashtags($msg)
{
  // Match the hashtags
  preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_]+)/i', $msg, $matchedHashtags);
  $hashtag = '';
  // For each hashtag, strip all characters but alnum
  if(!empty($matchedHashtags[0])) {
	  foreach($matchedHashtags[0] as $match) {
		  $hashtag .= preg_replace("/[^a-z0-9]+/i", "", $match).',';
	  }
  }
    //to remove last comma in a string
	return rtrim($hashtag, ',');
}
function check_email($email)
    {
        $id=$this->session->userdata('userid');
        $this->db->select('email_id');
        $query = $this->db->get_where('users',array('userid !=' => $id,'email_id' => $email));
        return $query->row_array();;
    }
	
	public function getsearch($tag)
	{
		$this->db->select('*');
		$this->db->from('tournament');
		$this->db->like('tournament_name',$tag,'both');		
		//print_r($this->db->get()->result_array());die;
		return $this->db->get()->result_array();
		
	}
	public function getsearchusers($tag)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->like('username',$tag,'both');		
		//print_r($this->db->get()->result_array());die;
		return $this->db->get()->result_array();
		
	}
	
	public function serachcountrylike($like)
	{ 
		$this->db->select('*');
		$this->db->from('country');
		$this->db->like('name',$like,'both');
		return $this->db->get()->result();
	}
	
	public function searchuserslike($like)
	{ 
		$this->db->select('*');
		$this->db->from('users');		
		$this->db->like('firstname',$like,'both');
		$this->db->or_like('lastname',$like,'both');		
		return $this->db->get()->result();
	}
	public function searchuserslikenew($like,$where)
	{ 
		$this->db->select('*');
		$this->db->from('users');
		$this->db->like("CONCAT(firstname, ' ', lastname)",$like);
		$this->db->where($where);
		return $this->db->get()->result();
	}
	
	
public function getyoutube($url)
	{
		/*if(preg_match('/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i', $url, $match))
			{
			 $match = array();
		 preg_match('/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i', $url, $match);
         $video_id = $match[1];
		 return str_replace($match[0],'&nbsp;',$url);
			}*/
			
			$id = array();

		if (preg_match('/\s*[a-zA-Z\/\/:\.]*youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) { 
		  $values = $id;
		} else if (preg_match('/\s*[a-zA-Z\/\/:\.]*youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
		  $values = $id;
		} else if (preg_match('/\s*[a-zA-Z\/\/:\.]*youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
		  $values = $id;
		} else if (preg_match('/\s*[a-zA-Z\/\/:\.]*youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
		  $values = $id;
		  
		}
		else if (preg_match('/\s*[a-zA-Z\/\/:\.]*youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
			$values = $id;
		} else {   
		   $values = $url;
		}
		
		
		$test1 = explode(' ',ltrim($values[0]));
		
		return str_replace($test1[0],'&nbsp;',$url); 

	}
	
	 //Get all values from single table
    function getAllusers($num, $offset, $where, $type = 1, $table, $sort_by, $sort_order,  $sort_columns)
    {
        $sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'user_id';
        if ($where && ($type == 1)) { 
 		$this->db->select('*');	
            $q = $this->db->order_by($sort_by, $sort_order);
            $q = $this->db->get_where($table, $where, $num, $offset);
        } else {
            $i = 1;

            // check condition
            if ($type == 'ser' && $where != '') {           
		$this->db->select('*');	
                foreach ($where as $key => $value)
                {
                   if ($key == 'users.name' && $value != '')
                    {
                        $this->db->like("$key", "$value",'after');
                    }
                                    $i++;
                                  }
                $q = $this->db->order_by($sort_by, $sort_order);
                $q = $this->db->get($table, $num, $offset);
            } 
		else {
 		$this->db->select('*');	
                $q = $this->db->order_by($sort_by, $sort_order);
                $q = $this->db->get($table, $num, $offset);
            }
        }
        $num_rows = $q->num_rows();
        if ($num_rows > 0) {
            foreach ($q->result() as $rows) {
                $data[] = $rows;
            }
            $q->free_result();
        $ret['rows'] = $data;
        }
                
         // count Values
        if ($where && ($type == 1)) {
					$this->db->select('*');	
            $q = $this->db->get_where($table, $where);
        } else {
            $i = 1;
            // check condition
            if ($type == 'ser' && $where != '') {
  					$this->db->select('*');	
                foreach ($where as $key => $value) {
                   if ($key == 'users.name' && $value != '')
                    {
                        $this->db->like("$key", "$value",'after');
                    } 
                                        $i++;
                                   }
                $q = $this->db->get($table);
            } else {
	        $this->db->select('*');	
                $q = $this->db->get($table);

            }
        }
        $ret['num_rows'] = $q->num_rows();
        return $ret;
    }
public function getAllsel($table,$field)
	{
		$this->db->select($field);
		$q = $this->db->get($table);
		$num_rows = $q->num_rows();
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	
	 function getAllwherepost1($table,$where)
	{
		$this->db->select('*');
		$q = $this->db->get_where($table,$where);
	   // $this->db->order_by("post_id", "desc");	
		$num_rows = $q->num_rows();
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}
	
	function delete_data(  $tblname, $where ) {
		$this->db->where( $where );
		$this->db->delete($tblname); 
		return $this->db->affected_rows();
	}
	
    public function getAllwhereorder($table,$where,$id,$order)
	{
		$this->db->select('*');
		$this->db->order_by($id, $order);
		$q = $this->db->get_where($table,$where);
		$num_rows = $q->num_rows();
		if($num_rows >0)
		{
			foreach($q->result() as $row)
			{
				$data[] = $row;
			}
			$q->free_result();
			return $data;
		}
	}

}
