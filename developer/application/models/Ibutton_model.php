<?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Ibutton_model extends CI_Model{
	
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
	  
   
   
   
   public function full_data(){

	   $this->db->select("i.id,i.ibutton_number,i.status,i.created,i.modified,d.Name as drivername,d.batch_num");
 
	   $this->db->from("ibutton i");
	   $this->db->join("driver_data d","d.ibuttonid=i.id",'left');
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