<?php
/*
// this is the model section for
// the whole site which is  
// used to intract with the database
// all the section will use this model to intract with the database
*/

class Model extends CI_model

{
	function __construct()
    {
        parent::__construct();
		$this->load->library( array('session'));
    }
    public function loginCheck($login,$pass) {
            try {
                $conn=$this->connect();
                $stmt = $conn->prepare("SELECT `Id` FROM `users` WHERE `Login`=? and `Password`=? and isuser=1");

            /* bind parameters for markers */
                    $stmt->bind_param("ss",$login,$pass);

                    /* execute query */
                    $stmt->execute();

                    /* bind result variables */
                    $stmt->bind_result($UserId);

                    /* fetch value */
                    $stmt->fetch();
                    /* close statement */
                    $stmt->close();
                    $conn->close();
                    return $UserId;
            } catch (Exception $e) {
                    file_put_contents('error.txt', "\xEF\xBB\xBF".$e);
                    return -3;
            }
        }


    function update_enquiry($set_value,$inbox_ids)
    {
       
       $sql = 'UPDATE `tbl_enquiry` SET '.$set_value.' WHERE id IN ('.$inbox_ids.')';
       $query = $this->db->query($sql);
       return true;
    }
    function insert_data($table,$data) {
		
		$sql=$this->db->insert_string($table,$data);
		$this->db->query($sql);
		$last_id = $this->db->insert_id();	
		return $last_id;
		
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

     public function get_all_where($table,$where)
    {
        $this->db->select('*');
        $this->db->where($where);   
        $result = $this->db->get($table)->result();
        return $result;
    }
    

      public function insertImage($table,$data){
        $insert = $this->db->insert_batch($table,$data);
        return $insert?true:false;
    }
	 function get_data($select, $tablename, $where){
        $this->db->select($select);
        $this->db->from($tablename);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
     function get_all_order_grop_by($select, $tablename,$where,$id,$column,$desc)
    {
        $this->db->select($select);
        $this->db->from($tablename);
        $this->db->where($where);
        $this->db->group_by($id); 
        $this->db->order_by($column, $desc);
        $query = $this->db->get();
        return $query->result();
    }
    
     function get_data_order_by($select, $tablename, $where,$column,$desc){
        $this->db->select($select);
        $this->db->from($tablename);
        $this->db->where($where);
        $this->db->order_by($column, $desc);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all($select, $tablename){
        $this->db->select($select);
        $this->db->from($tablename);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_order_by($select, $tablename,$column,$desc)
    {
        $this->db->select($select);
        $this->db->from($tablename);
        $this->db->order_by($column, $desc);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_limit($select, $tablename,$where,$column,$desc,$limit)
    {
        $this->db->select($select);
        $this->db->from($tablename);
         $this->db->where($where);
        $this->db->order_by($column, $desc);
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }
    function get_data_join($select, $table1,$table2,$table1ID,$table2ID, $column, $desc)
    {
	    $this->db->select($select);
	    $this->db->from($table1);
	    $this->db->join($table2, $table1.'.'.$table1ID. '=' .$table2.'.'.$table2ID, 'left');
	    $this->db->order_by($column, $desc);
	   	$query = $this->db->get();
	   	//echo $this->db->last_query();die;
	    return $query->result();

    }
    function join_where($select, $table1,$table2,$table1ID,$table2ID,$where,$column,$desc)
    {
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$table1ID. '=' .$table2.'.'.$table2ID, 'left');
        $this->db->where($where);
        $this->db->order_by($column, $desc);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();

    }
function get_data_rl_join($select, $table1,$table2,$table1ID,$table2ID,$where, $column, $desc,$jointype)
    {
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$table1ID. '=' .$table2.'.'.$table2ID, $jointype);
        $this->db->where($where);
        $this->db->order_by($column, $desc);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();

    }
    function get_data_rl_join_groupby($select, $table1,$table2,$table1ID,$table2ID,$where, $gcolumn,$column, $desc,$jointype)
    {
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$table1ID. '=' .$table2.'.'.$table2ID, $jointype);
        $this->db->where($where);
        $this->db->group_by($gcolumn); 
        $this->db->order_by($column, $desc);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();

    }

    function getRowsJoinMulti($data_get, $params = array()){

        $this->db->select($data_get['select']);
        $this->db->from($data_get['table']);
        if(!empty($data_get['RIGHT_LEFT'])){
            if(!empty($data_get['table2'])){
            $this->db->join($data_get['table2'],$data_get['equal'], $data_get['RIGHT_LEFT']);
            }
        }else{
             $this->db->join($data_get['table2'],$data_get['equal']);
        }
        
        if(!empty($data_get['table3'])){
        $this->db->join($data_get['table3'],$data_get['equal3']);
        }
        
        if(!empty($data_get['table4'])){
        $this->db->join($data_get['table4'],$data_get['equal4']);
        }
        
        if(!empty($params['search']['sortPage'])){
            $where=array($data_get['where']=>$params['search']['sortPage']);
        $this->db->where($where);
        } else{
            if(!empty($data_get['whereValueRN'])){
            $where=array($data_get['where']=>$data_get['whereValueRN']);
            $this->db->where($where);
            }
        }
        if(!empty($params['search']['where_state_value'])){
           $this->db->where($data_get['where_state'],$params['search']['where_state_value']); 
        }
        if(!empty($data_get['where_trail_status'])){
           $this->db->where($data_get['where_trail_status'],0); 
        }
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like($data_get['search_record'],$params['search']['keywords']);
        }
        if(!empty($params['search']['keywords1'])){
            $this->db->or_like($data_get['search_record1'],$params['search']['keywords1']);
        }
        if(!empty($data_get['group_by_desc'])){
             $this->db->group_by($data_get['group_by_desc']); 
        }
        if(!empty($data_get['order_by_desc'])){
           $this->db->order_by($data_get['order_by_desc'],'DESC');
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['fieldName'])){
            $this->db->order_by($params['search']['fieldName'],$params['search']['orderBytype']);
        }else{
            $this->db->order_by($data_get['search_default_order'],'DESC');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result():FALSE;
    }






    function paginationtaillist($params = array()){

     //   'SELECT tbl_kml_data_trail_view.*, `tbl_trail_report`.* FROM `tbl_trail_report` JOIN `tbl_kml_data_trail_view` ON `tbl_trail_report`.`trail_name`=`tbl_kml_data_trail_view`.`klm_trail_name` WHERE `tbl_trail_report`.`status`=0 ORDER BY `tbl_trail_report`.`trail_report_id` DESC'


        $this->db->select('*');
        $this->db->from('tbl_trail_report');
        $this->db->join('tbl_kml_data_trail', 'tbl_trail_report.trail_name = tbl_kml_data_trail.klm_trail_name', 'RIGHT');
        $this->db->where( '1 = 1' );
        $this->db->group_by('tbl_kml_data_trail.klm_trail_name'); 
        $this->db->order_by('tbl_kml_data_trail.id', 'DESC');

         if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result():FALSE;
       // return $query->result();



        /*$this->db->select('*');
        $this->db->from('tbl_news');
        $this->db->where('news_status', 1);
        $this->db->order_by('news_id','desc');
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        
        return ($query->num_rows() > 0)?$query->result():FALSE;*/
    }
    




    function update($table,$data,$where) {
		
		$this->db->where($where);
		$result = $this->db->update($table,$data);
		return $result;	
		
    }
     function get_row($table,$field) {
		
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field);
		$query=$this->db->get();
		//echo $this->db->last_query();
		return $query->row();
	}
    public function getMultiple($tableName,$arr)
    {
        $this->db->select('*');
        $this->db->from($tableName);
        foreach ($arr as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit($tableName,$columnName,$data,$id)
    {
        $this -> db -> where($columnName, $id);
        $this->db->update($tableName, $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
	function login_check($useremail,$password)
    {
     	$ci =& get_instance();  
       //load databse library
        $ci->load->database();
        $data=array('email'=>$useremail,'password'=>$password);
       //get data from database
         $query = $ci->db->get_where('tbl_user_master',$data);
        //print_r($data);exit;
        if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result;
        }else{
           return false;
        }
     } 

     function admin_login_check($useremail,$password)
    {
        $ci =& get_instance();  
       //load databse library
        $ci->load->database();
        $data=array('email'=>$useremail,'password'=>$password,'status'=>1);
       //get data from database
         $query = $ci->db->get_where('tbl_user_master',$data);
        //print_r($data);exit;
        if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result;
        }else{
           return false;
        }
     } 
      function paginationNews($params = array()){
        $this->db->select('*');
        $this->db->from('tbl_news');
        $this->db->where('news_status', 1);
        $this->db->order_by('news_id','desc');
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        
        return ($query->num_rows() > 0)?$query->result():FALSE;
    }
    
    function paginationEvent($params = array()){
        $this->db->select('*');
        $this->db->from('tbl_event');
        $this->db->where('event_status', 1);
        $this->db->order_by('event_id','desc');
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        
        return ($query->num_rows() > 0)?$query->result():FALSE;
    }

   public function get_categories()
   {
    //$this->db->order_by("classified_sort_order, classified_cat_name", "asc");
   // $query = $this->db->get('tbl_classified_cat_master');
    $query = $this->db->query("SELECT * FROM tbl_classified_cat_master LEFT JOIN tbl_classified_list on tbl_classified_cat_master.classified_cat_name = tbl_classified_list.classified_type WHERE tbl_classified_cat_master.classified_cat_status = 1 and tbl_classified_list.classified_status = 1 and tbl_classified_list.classified_expired >= CURDATE() order by tbl_classified_cat_master.classified_sort_order, tbl_classified_cat_master.classified_cat_name ASC");
    $return = array();

    foreach ($query->result() as $category)
    {
        $return[$category->classified_cat_name] = $category;
        $return[$category->classified_cat_name]->subs = $this->get_sub_categories($category->classified_cat_name); // Get the categories sub categories
    }

    return $return;
  }


public function get_sub_categories($category_id)
{
    $this->db->where('classified_type', $category_id);
     $this->db->where('classified_status',1);
    $this->db->order_by("classified_create_date", "desc");
    $this->db->limit(6);
    $query = $this->db->get('tbl_classified_list');
    return $query->result();

}
 public function get_lodging()
   {
    $query = $this->db->get('advance_filter_fields');
    $return = array();

    foreach ($query->result() as $category)
    {
        $return[$category->f_cat_name] = $category;
        $return[$category->f_cat_name]->subs = $this->get_sub_lodging($category->f_cat_name); // Get the categories sub categories
    }

    return $return;
  }


public function get_sub_lodging($category_id)
{
    $this->db->where('f_cat_name', $category_id);
    $query = $this->db->get('advance_filter_fields');
    return $query->result();
}

public function GetRow($keyword) {  
  $this->db->select("county_name");      
    $this->db->order_by('id', 'ASC');
    $this->db->group_by('county_name');
    $this->db->like("county_name", $keyword);
    return $this->db->get('county_trail_report')->result_array();
}
function isclassifiedExist($id = '',$classified_created_by) {
    $this->db->select('classified_id');
    $this->db->where('classified_created_by', $classified_created_by);
    if($id) {
        $this->db->where_not_in('classified_id', $id);
    }
    $query = $this->db->get('tbl_classified_list');

    if ($query->num_rows()>0) {
        return true;
    } else {
        return false;
    }
    
}
public function getReview($page,$busID){
         $offset = 3*$page; $limit = 3; 

         $sql =  "SELECT tbl_user_master.fname,tbl_user_master.lname,tbl_user_master.profile_picture, tbl_review.* FROM tbl_review INNER JOIN tbl_user_master ON tbl_review.user_ID = tbl_user_master.user_id where tbl_review.bus_ID = ".$busID." and tbl_review.status=1 order by review_ID DESC limit  $offset ,$limit";
         //$sql = "select * from countries limit $offset ,$limit"; 
         $result = $this->db->query($sql)->result();
         return $result;
    
}
}//class    
 ?>