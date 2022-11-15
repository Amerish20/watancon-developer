<?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Geoffence_model extends CI_Model{
	
	function _construct(){
 	    parent::_construct();
    }
	public function db_datacheck($pull_items,$table,$where="",$dom=""){
		
  	 $this->db->select($pull_items);
	 $this->db->from($table);
	 if(!empty($where))
	   $this->db->where($where);
   	 $query = $this->db->get();
	// print $this->db->last_query();
	 if($dom!="")
	   return $result=$query->row_array();
	 else
 	   return $result=$query->result_array();
   } 	
	public function master_join($pull_items,$where,$type=""){
		  $this->db->select($pull_items);
		  $this->db->from("user_acess ua");
		  $this->db->join("user u","u.user_group=ua.user_group_id");
		  if($type=="1")
		    $this->db->join("master m","m.id=ua.controll_id");
		   
 		  if(!empty($where))
	         $this->db->where($where);
		  $query = $this->db->get();
		      // print  $this->db->last_query();
 	      return $result=$query->result_array();
 	  }
	  
	 public function db_update($table,$values,$where){
       $this->db->set($values);
	   $this->db->where($where);
       $this->db->update($table);
	   return $this->db->affected_rows();
	   
       print $this->db->last_query();
     }	
	 public function customer_join($where){
		  $this->db->select("g.id,cn.id,cn.cust_name");
		  $this->db->from("geoffence g");
		  $this->db->join("customer_name cn","cn.id=g.cust_id");
		  $this->db->where($where);
		  $query = $this->db->get();
		  //print  $this->db->last_query();
		  return $result=$query->row_array();
 	  }
}