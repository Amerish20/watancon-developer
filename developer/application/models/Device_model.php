<?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Device_model extends CI_Model{
	
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
	  
   
   public function db_simcheck($id=""){
	   
	   if($id!=""){
		   $cond="and id!='".$id."'";
	   }else{
		   $cond="";
 	   }
	    
	     $this->db->select("id,sim_serial");
		 $this->db->from("sim_details");
		 $this->db->where("id NOT IN(select sim_id from device_data where sim_id!='0' ".$cond.") and status!='0'");
		 $query = $this->db->get();
 		  //print $this->db->last_query();
	     return $result=$query->result_array();
   }
   
   
   public function full_data(){
	   $this->db->select("d.id,d.imei,d.status,s.sim_serial,vd.name as vehicle");
	   $this->db->from("device_data d");
	   $this->db->join("sim_details s","s.id=d.sim_id",'left');
	   $this->db->join("vehicle_data vd","vd.device_id=d.id",'left');
	   $query = $this->db->get();
	  // print $this->db->last_query();
	    return $result=$query->result_array();
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