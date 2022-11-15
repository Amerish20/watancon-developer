<?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Devtools_model extends CI_Model
{
	
	function _construct(){
 	    parent::_construct();
    }


    public function gps_datacheck($pull_items,$table,$where="",$dom="",$orderby="",$limit="",$where_status="",$limit1="",$groupby=""){
		 
		$this->db->select($pull_items);
		$this->db->from($table);
		if($where!="")
          $this->db->where($where);
		if($orderby!="")
		 $this->db->order_by($orderby);
		if($limit!="" && $limit1!="")
		  $this->db->limit($limit1,$limit);
		else
		 $this->db->limit($limit);
		 
		if($groupby!="")
		  $this->db->group_by($groupby); 
		  
 		$query = $this->db->get();
		  //print  $this->db->last_query();
		if($dom=="1")
	      return $result=$query->result_array();
	   else
		  return $result=$query->row_array();
 	}


 	public function user_group_join()
 	{
  	    $this->db->select("u.name,u.user_name,u.Password,ug.name as usergroup,u.status");
  	    $this->db->from("user u");
		$this->db->join("user_groups ug","u.user_group=ug.id");
	    $this->db->order_by("usergroup asc");
		$query = $this->db->get();
		  // print  $this->db->last_query(); 
 	    return $result=$query->result_array();
    }

    public function userChk($username)
 	{

           $this->db->select("*");
  	       $this->db->from("user");
  	       //$this->db->where('status',1);
	       $this->db->like('user_name', $username);
	       $query = $this->db->get();
	       return $result=$query->result_array();
    }

    public function oldDbLastInsertDate()
 	{
           $db2 = $this->load->database('databaseold', TRUE);
 	    $db2->select("*");
  	    $db2->from("vehicle_gps_information");
  	    $db2->order_by("device_timestamp desc");
  	    $db2->limit("1");
  	    $query = $db2->get();

  	    //print  $db2->last_query();exit;
	    return $result=$query->result_array();
 	}

 	public function dbcompare($dbname,$from,$to)
 	{
 	   ini_set('memory_limit','2048M');
 	   //ini_set('max_execution_time', '0'); // for infinite time of execution 
 	   set_time_limit(0);
	   ignore_user_abort(1);
 	   if($dbname=='new'){
 	   	$this->db->where('device_timestamp >=', $from);
		$this->db->where('device_timestamp <=', $to);
		$query = $this->db->get('vehicle_gps_information');
	       return $query->num_rows();
 	   } else{
	 	$db2 = $this->load->database('databaseold', TRUE);
	 	$db2->where('device_timestamp >=', $from);
		$db2->where('device_timestamp <=', $to);
		$query = $db2->get('vehicle_gps_information');
		//print  $this->db->last_query();exit;
	       return $query->num_rows();	
 	   }
          
 	}

 	public function vehCount(){
 	      $query = $this->db->query("SELECT COUNT(id) AS total_veh,
					     SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) AS inactive_veh,
					     SUM(CASE WHEN status = '1' THEN 1 ELSE 0 END) AS active_veh
					     FROM vehicle_data 
					     WHERE name NOT LIKE '%test%' and name NOT LIKE '1%'");
 		
 		return $result=$query->result_array();
 	}

 	public function awcJecCount(){
 	      $query = $this->db->query("SELECT count(id) as total_awc_jec,
 	      	SUM(CASE WHEN description LIKE '%JEC%' or description LIKE '%VS-5005%' THEN 1 ELSE 0 END) AS jec,
 	      	SUM(CASE WHEN description NOT LIKE '%JEC%' and description NOT LIKE '%VS-5005%' and name NOT LIKE '%test%' and name NOT LIKE '1%' THEN 1 ELSE 0 END) AS awc 
 	      	FROM vehicle_data 
 	      	WHERE status = '1' and name NOT LIKE '%test%' and name NOT LIKE '1%'");
 		
 		return $result=$query->result_array();
 	}

 	public function inactiveAwcJecCount(){
 	      $query = $this->db->query("SELECT count(id) as total_inactive_awc_jec,
 	      	SUM(CASE WHEN description LIKE '%JEC%' or description LIKE '%VS-5005%' THEN 1 ELSE 0 END) AS inactive_jec,
 	      	SUM(CASE WHEN description NOT LIKE '%JEC%' and description NOT LIKE '%VS-5005%' and name NOT LIKE '%test%' and name NOT LIKE '1%' THEN 1 ELSE 0 END) AS inactive_awc 
 	      	FROM vehicle_data 
 	      	WHERE status = '0' and name NOT LIKE '%test%' and name NOT LIKE '1%'");
 		
 		return $result=$query->result_array();
 	}

 	public function simCount(){
 		$query = $this->db->query("SELECT COUNT(id) AS total_sim,
					     SUM(CASE WHEN provider = '0' THEN 1 ELSE 0 END) AS vodafone,
					     SUM(CASE WHEN provider = '1' THEN 1 ELSE 0 END) AS ooredoo
					     FROM sim_details");
 		
 		return $result=$query->result_array();
 	}

 	public function statusCount(){
 		$query = $this->db->query("SELECT COUNT(id) AS total_status_sim,
					     SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) AS inactive,
					     SUM(CASE WHEN status = '1' THEN 1 ELSE 0 END) AS active,
					     SUM(CASE WHEN status = '2' THEN 1 ELSE 0 END) AS inuse
					     FROM sim_details");
 		
 		return $result=$query->result_array();
 	}

 	public function simVodafoneCount(){
 		$query = $this->db->query("SELECT COUNT(id) AS total_vodafone_sim,
					     SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) AS inactive,
					     SUM(CASE WHEN status = '1' THEN 1 ELSE 0 END) AS active,
					     SUM(CASE WHEN status = '2' THEN 1 ELSE 0 END) AS inuse
					     FROM sim_details WHERE provider = '0'");
 		
 		return $result=$query->result_array();
 	}

 	public function simOoredoCount(){
 		$query = $this->db->query("SELECT COUNT(id) AS total_oorderoo_sim,
					     SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) AS inactive,
					     SUM(CASE WHEN status = '1' THEN 1 ELSE 0 END) AS active,
					     SUM(CASE WHEN status = '2' THEN 1 ELSE 0 END) AS inuse
					     FROM sim_details WHERE provider = '1'");
 		
 		return $result=$query->result_array();
 	}

 	public function simSerialNumberActive(){
 	// 	$this->db->select("vd.asset_code,vd.description,vd.status,s.sim_serial");
		// $this->db->from("vehicle_data vd");
		// $this->db->join('device_data dv','dv.id=vd.device_id','left');
		// $this->db->join('sim_details s','s.id=dv.sim_id','left');
		// $this->db->where('vd.status=','1');
		// $this->db->where('vd.name=','1');
		// $query = $this->db->get();
	 //       return $result=$query->result_array();

	       $query = $this->db->query("SELECT vd.asset_code,vd.description,vd.status,s.sim_serial FROM vehicle_data vd LEFT JOIN device_data dv ON dv.id=vd.device_id LEFT JOIN sim_details s ON s.id=dv.sim_id WHERE vd.status = '1' and vd.name NOT LIKE '%test%' and vd.name NOT LIKE '1%'");
	       return $result=$query->result_array();
 	}
}

?>