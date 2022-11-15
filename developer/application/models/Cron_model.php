 <?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Cron_model extends CI_Model{
	function _construct(){
 	    parent::_construct();
    }
	
   public function db_datacheck($pull_items,$table,$where="",$dom="",$orderby="0",$limit="",$where_in=""){
		
  	  $this->db->select($pull_items);
	  $this->db->from($table);
	  if(!empty($where))
	   $this->db->where($where);
	  if(!empty($orwhere))
	   $this->db->or_where($orwhere);
	  if(!empty($where_in)){
		   $this->db->where_in('id', $where_in); 
	  }
	   
	  if($orderby)
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
   
   public function db_geoffence_data($pull_items,$table,$where_notin){
		  $this->db->select($pull_items);
	      $this->db->from($table);
		   
		  if(!empty($where_notin)){
		   $this->db->where_in('id', $where_notin);
		  }
		  $query = $this->db->get();
		   //print $this->db->last_query();
		  return $result=$query->result_array();
	}
	 public function db_geoffence_datatime($pull_items,$table){
		 $this->db->select($pull_items);
	     $this->db->from($table);
		 $this->db->where("geo_group","5");
		 $query = $this->db->get();
		  //print $this->db->last_query();
		 return $result=$query->result_array();
 	 }
	
	
	
   public function geoffence_data_check_new($pullitem,$where,$geoofence_where_id){
	   $this->db->select($pullitem);
	   $this->db->from("alert_settings");
 	   $this->db->where($where);
	   $this->db->where('FIND_IN_SET("'.$geoofence_where_id.'",geoffence)!=', 0);
	   //$this->db->where($or_where, NULL, FALSE);
	   
 	   $query = $this->db->get();
	   //print $this->db->last_query();
	   return $result=$query->row_array();
	   
   }
    
   public function geoffence_data_check($where,$or_where){
	    $this->db->select("name,contact_email,contact_name");
		$this->db->from("geoffence");
		$this->db->where($where);
		$this->db->where($or_where, NULL, FALSE);
		$query = $this->db->get();
		// print $this->db->last_query();
	  return $result=$query->row_array();
    }
	
	public function full_data($where){
		$this->db->select("vgi.id,vgi.vehicle_id,vgi.lattitude,vgi.lognitude,vgi.device_timestamp,vgi.speed,vgi.driver_id,vgi.acceleration,vgi.hash_breaking,vd.group_id,vd.name as vehicle_name");
		$this->db->from("vehicle_gps_information vgi");
		$this->db->join("vehicle_data vd",'vd.id=vgi.vehicle_id','left');
		
 		$this->db->where($where);
		$this->db->order_by("device_timestamp asc");
		$query = $this->db->get();
		print $this->db->last_query();
		return $result=$query->result_array();
		
	}
	
	public function cc_mail($where){
		$this->db->select("gg.mail");
		$this->db->from("geoffence g");
		$this->db->join("Geoffence_group gg","gg.id=g.geo_group");
		$this->db->where($where);
		$query = $this->db->get();
		 return $result=$query->row_array();
		
	}
	
    public function db_insert($table,$data){
   	   $this->db->insert($table,$data); 
	  // print $this->db->last_query();
	  return $this->db->insert_id();
	   //$this->db->affected_rows()
     }
	
	public function gps_lastrow($pullitems){
		
		$this->db->select($pullitems);
		$this->db->from("vehicle_gps_information_temp vgi1");
		$this->db->join("vehicle_gps_information_temp vgi2","(vgi1.`vehicle_id` = vgi2.`vehicle_id` AND vgi1.`device_timestamp` < vgi2.`device_timestamp`)","left");
		$this->db->join("vehicle_data vd",'vd.id=vgi1.vehicle_id','left');
		$this->db->join("vehicle_group vg",'vg.id=vd.group_id','left');
   		$this->db->where("vgi1.device_timestamp!=","NaN");
		$this->db->where('vgi1.satelite>','7');
		$this->db->where('vgi2.device_timestamp IS NULL');
		$query = $this->db->get();
	   // print  $this->db->last_query();
		return $query->result_array();
		
	}
	
	 public function db_update($table,$values,$where){
        $this->db->where($where);
       $this->db->update($table, $values);
	  
       // print $this->db->last_query();
     }
	
}