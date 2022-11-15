<?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Driver_model extends CI_Model{
	
	function _construct(){
 	    parent::_construct();
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
	  
	
	public function db_datacheck($pull_items,$table,$where="",$dom=""){
 	 $this->db->select($pull_items);
	 $this->db->from($table);
	 if(!empty($where))
	   $this->db->where($where);
   	 $query = $this->db->get();
	   //print $this->db->last_query();
	if($dom!="")
	 return $result=$query->row_array();
	 else
 	 return $result=$query->result_array();
   }
   
   public function full_data(){
	   $this->db->select("d.id,d.batch_num,d.Name,d.phone,d.status,v.name");
	   $this->db->from("driver_data d");
	   $this->db->join("vehicle_data v","v.driver_id=d.id",'left');
	    $query = $this->db->get();
		 return $result=$query->result_array();
	   
   }
   
   public function driver_check($vehicle_id){
	   
	    $this->db->select("id,name");
		$this->db->from("vehicle_data");
		$this->db->where('SUBSTRING_INDEX(`driver_id`, ",", 1)=',$vehicle_id);
		$this->db->or_where('SUBSTRING_INDEX(`driver_id`, ",", -1)=',$vehicle_id);
 		$query = $this->db->get();
		 //print $this->db->last_query();
		return $result=$query->row_array();
		
		
   }
   
   
   public function db_insert($table,$data){
   	   $this->db->insert($table,$data); 
	 // print $this->db->last_query();
 	   return $this->db->insert_id();
    }
	
	
   public function db_update($table,$values,$where){
        $this->db->where($where);
        $this->db->update($table, $values);
        // print $this->db->last_query();
   }
 
}

?>