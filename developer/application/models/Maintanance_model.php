 <?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Maintanance_model extends CI_Model{
	
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
	  
	
	 
	
 	public function db_datacheck($pull_items,$table,$where="",$dom="",$orderby="",$limit=""){
 	 $this->db->select($pull_items);
	 $this->db->from($table);
	 if(!empty($where))
	   $this->db->where($where);
	 if($orderby!="")
		$this->db->order_by($orderby);
	 if($limit!="")
		 $this->db->limit($limit);  
	   
 	   
   	 $query = $this->db->get();
	 // print $this->db->last_query();
	if($dom!="")
	 return $result=$query->row_array();
	 else
 	 return $result=$query->result_array();
   }
   
   public function vehicle_group_join($pull_items,$where){
	   
 	    $this->db->select($pull_items);
		$this->db->from("vehicle_data vd");
		$this->db->join('vehicle_group vg','vg.id=vd.group_id');
  		if(!empty($where))
	      $this->db->where($where);
		$query = $this->db->get();
		//print $this->db->last_query();
 	    return $result=$query->result_array();
    }
	
  
   public function gps_data($pull_items,$where){
	   
 	    $this->db->select($pull_items);
		$this->db->from("vehicle_gps_information");
        $this->db->where($where);
		$this->db->order_by("id desc");
		$this->db->limit("1");
		$query = $this->db->get();
 	    return $result=$query->row_array();
	   
   }
     public function db_update($table,$values,$where){
       $this->db->set($values);
	   $this->db->where($where);
       $this->db->update($table);	   
       //print $this->db->last_query();
     }
	  public function final_odometer_read($where){
		  
		   $this->db->select("odometer as final_odometer");
		   $this->db->from("vehicle_gps_information_temp");
		   $this->db->where($where);
		   $this->db->order_by("device_timestamp desc");
	       $this->db->limit("1");
	       $query1 = $this->db->get();
		   //print  $this->db->last_query();
 		  return $result=$query1->row_array();
			  
	  }
 
 }
	