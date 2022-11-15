 <?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Default_master_model extends CI_Model{
	
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
	  // print $this->db->last_query();
	if($dom!="")
	 return $result=$query->row_array();
	 else
 	 return $result=$query->result_array();
   }
   
    public function db_insert($table,$data){
   	   $this->db->insert($table,$data); 
	 //	print $this->db->last_query();
 	   return $this->db->insert_id();
    }
	
	public function db_geoffence_data($pull_items,$table,$where,$where_notin){
		  $this->db->select($pull_items);
	      $this->db->from($table);
		  $this->db->where($where);
		  if(!empty($where_notin)){
		   $this->db->where_not_in('id', $where_notin);
		  }
		  $query = $this->db->get();
		  //print $this->db->last_query();
		  return $result=$query->result_array();
	}
	
   public function db_update($table,$values,$where){
        $this->db->where($where);
        $this->db->update($table, $values);
		 //print $this->db->last_query();
		return $this->db->affected_rows();
        
   }
   public function select_alert_settings($pull_items,$where=""){
	   $this->db->select($pull_items);
	   $this->db->from("alert_settings as");
	   $this->db->join("Geoffence_group gg","gg.id=as.geoffence_group_id");
 	   $this->db->join("vehicle_group vg","vg.id=as.vehicle_group");
	   if(!empty($where))
	         $this->db->where($where);
		  $query = $this->db->get();
		  //print  $this->db->last_query();
 	      return $result=$query->result_array();
    }
	public function db_delete($table,$where){
		 $this->db->where($where);
        $this->db->delete($table);
		//print  $this->db->last_query();
		return $this->db->affected_rows();
	}
}

?>