 <?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Vehicle_model extends CI_Model{
	
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
	  
	
	 public function db_insert($table,$data){
   	   $this->db->insert($table,$data); 
	   // print $this->db->last_query();
 	   return $this->db->insert_id();
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
   
   public function vehicle_group_join($pull_items,$where){
	   
 	    $this->db->select($pull_items);
		$this->db->from("vehicle_data vd");
		$this->db->join('vehicle_group vg','vg.id=vd.group_id');
		$this->db->join('department d','d.id=vd.department_id');
		$this->db->join('Stations st','st.id=vd.station_id','left');
		$this->db->join('device_data dv','dv.id=vd.device_id','left');
		$this->db->join('sim_details s','s.id=dv.sim_id','left');

		if(!empty($where))
	      $this->db->where($where);
		$query = $this->db->get();
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
   
   public function db_devicecheck($id=""){
	   $cond="";
	   if($id!=""){
		   $cond="and id!='".$id."'";
	   }
	    
	     $this->db->select("id,imei");
		 $this->db->from("device_data");
		 $this->db->where("id NOT IN(select device_id from vehicle_data where device_id!='0' ".$cond.") and status!='0'");
		 $query = $this->db->get();
 		  //print $this->db->last_query();
	     return $result=$query->result_array();
   }
   public function sim_data($where){
	   $this->db->select("s.id,s.sim_serial,s.sim_num,s.provider");
	   $this->db->from("device_data d");
	   $this->db->join("sim_details s","s.id=d.sim_id",'left');
	   $this->db->where($where);
	   $query = $this->db->get();
	   //print $this->db->last_query();
	   return $result=$query->row_array();
	   
   }
   
    public function db_update($table,$values,$where){
       $this->db->set($values);
	   $this->db->where($where);
       $this->db->update($table);	   
      // print $this->db->last_query();
     }
 
	
	
	
}
	