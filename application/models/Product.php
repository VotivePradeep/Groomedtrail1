<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Model{
	//get and return product rows
	public function getRows($id = ''){
		$this->db->select('*');
		$this->db->from('tbl_vacation_list');		
		$this->db->where('vac_id',$id);
		$query = $this->db->get();
		$result = $query->row_array();
		
		return !empty($result)?$result:false;
	}


	//insert transaction data
	public function insertTransaction($data = array()){
		$insert = $this->db->insert('payments',$data);
		return $insert?true:false;
	}
}
