<?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Gps_model extends CI_Model{
	
	function _construct(){
 	    parent::_construct();
    }
	 	 
	public function vehicle_group_join($pull_items,$where){
  	    $this->db->select($pull_items);
		$this->db->from("user_acess ua");
		$this->db->join("user u","u.user_group=ua.user_group_id");
		$this->db->join("department d",'d.id=ua.controll_id');
		$this->db->join('vehicle_data vd','vd.department_id=d.id');
		$this->db->join('Stations st','st.id=vd.station_id', "left");
		if(!empty($where))
	      $this->db->where($where);
	    $this->db->order_by(" group_id asc,`vd`.`station_id` asc,id asc");
		 
		$query = $this->db->get();
		  //print  $this->db->last_query();
 	    return $result=$query->result_array();
    }
	
	public function geoffence_group_join($pull_items,$where){
		$this->db->select($pull_items);
 		$this->db->from("user_acess ua");
		$this->db->join("user u","u.user_group=ua.user_group_id");
		$this->db->join("Geoffence_group gg",'gg.id=ua.controll_id');
		$this->db->join('geoffence g','g.geo_group=gg.id');
		$this->db->join('customer_name cn','cn.id=g.cust_id',"left");
		if(!empty($where))
	      $this->db->where($where);
		$query = $this->db->get();
		//  print  $this->db->last_query();
 	    return $result=$query->result_array();
 	}
	
	 public function multiple_alert_data($where,$where_typein,$where_geoffence_in=""){
		 
		  $this->db->select("va.device_timestamp,va.type,va.vehicle_id,vg.name as group_name,g.name as geoffence");
		  $this->db->from("vehicle_alerts va");
		  $this->db->join('geoffence g','g.id=va.geoffence_id',"left");
		  $this->db->join('vehicle_data vd','vd.id=va.vehicle_id');
		  $this->db->join('vehicle_group vg','vg.id=vd.group_id');
 		  $this->db->where_in('va.type', $where_typein);
		  if($where_geoffence_in!="")
		    $this->db->where_in('g.id', $where_geoffence_in);
		  
		  $this->db->where($where);
		  $this->db->order_by("va.vehicle_id asc");
		  $this->db->order_by("va.id asc");
		  $query = $this->db->get();
		 // print $this->db->last_query();
 		  return $result=$query->result_array();
 	  }
	  
	   public function onsite_vehicle(){
		   
		 $this->db->select("vgit.lattitude,vgit.lognitude,vgit.satelite,vgit.device_timestamp,vgit.vehicle_id,vg.name as group_name");
		 $this->db->from("vehicle_gps_information_temp vgit");
		 $this->db->join('vehicle_data vd','vd.id=vgit.vehicle_id');
		 $this->db->join('vehicle_group vg','vg.id=vd.group_id');
		 $query = $this->db->get();
		 //print $this->db->last_query();
		 return $result=$query->result_array();
		 
  	  }
	  
	   public function geoffence_separating($where,$orderby=""){


		  $this->db->select("g.name,g.boundaries");
		  $this->db->from("geoffence g");
		  //print "<pre>"; print_r($where);
		  //die();
		  $this->db->join('Geoffence_group gg','gg.id=g.geo_group');
		  if($where!= ""){
			  $this->db->where_in('g.id',$where);
			  }
		  if($orderby)
			$this->db->order_by($orderby);	  
		  $query = $this->db->get();
 
		   //print $this->db->last_query();
		  return $result=$query->result_array();
	  }
	  
	  
	  
	
	 public function db_insert($table,$data){
   	   $this->db->insert($table,$data); 
	   //return $this->db->insert_id();
	   // print $this->db->last_query();
 	    return $this->db->affected_rows()."||".$this->db->insert_id();
    }
	
	public function vehicle_external_details($where){
		
		 $this->db->select("vd.id,vd.name,vd.department_id,vd.description,vd.workshop_status,vd.longstop_status,vd.group_id, vg.name as group_name,vg.move_icon as run,vg.idle_icon as idle,vg.stop_icon as stop,d.name as daydrivername,d.phone as daydriverphone,d2.name as nghtdrivername,d2.phone as nghtdriverphone");
		 $this->db->from("vehicle_data vd");
		 $this->db->join('vehicle_group vg','vg.id=vd.group_id');
		 $this->db->join('driver_data d','d.id=SUBSTRING_INDEX(vd.driver_id, ",", 1) ', 'left');
		 $this->db->join('driver_data d2','d2.id=SUBSTRING_INDEX(vd.driver_id, ",",-1) ', 'left');
 		  $this->db->where("vd.id =".$where);
		  $query = $this->db->get();
		 // print  $this->db->last_query();
 	    return $result=$query->result_array();
	}
	
	public function bulkvehicle_external_details($array){
 		 // $id=implode(",",$array);
 		 $this->db->select("vd.id,vd.name,vd.description,vg.icon,vg.name as group_name,d.name as drivername,d.phone as driverphone");
		 $this->db->from("vehicle_data vd");
		 $this->db->join('vehicle_group vg','vg.id=vd.group_id');
		 $this->db->join('driver_data d','d.id=vd.driver_id', 'left');
		 $this->db->where_in('vd.id',$array);
		  $query = $this->db->get();
		 // print  $this->db->last_query();
  	    return $result=$query->result_array();
	}
	
 	public function gps_lastrow($pullitems,$where="",$status=""){
		
		$this->db->select($pullitems);
		$this->db->from("vehicle_gps_information_temp vgi1");
 
		$this->db->join("vehicle_gps_information_temp vgi2","(vgi1.`vehicle_id` = vgi2.`vehicle_id` AND vgi1.`device_timestamp` < vgi2.`device_timestamp`)","left");
		$this->db->join("vehicle_status vs","vs.vehicle_id=vgi1.`vehicle_id`");
		 $this->db->join("driver_data d","d.id=vgi1.`driver_id`","left" );
		
		if($where!="")
		  $this->db->where("(`vgi1`.`vehicle_id`= ".$where.")");
		  
 		$this->db->where("vgi1.device_timestamp!=","NaN");
		//$this->db->where('vgi1.satelite>','7');
		$this->db->where('vgi2.device_timestamp IS NULL');
		$query = $this->db->get();
		 //print  $this->db->last_query();
		if($status!=""){
			 
			return $query->row_array();
			
		}else{
			
			return $query->result_array();
		}
		  
		 
		
	}
	
	public function gps_lastrows($where){//getting full last rows
		
		$this->db->select("vgi.`vehicle_id`,vgi.device_timestamp,vgi.lattitude,vgi.lognitude,vgi.speed,vgi.ign_status,vgi.Heading,vgi.odometer,vgi.unpluged,vgi.created,vgi.satelite,vs.status as vehicle_status,vs.start_time,vs.end_time,d.Name as drivername,d.phone as driverphone
			");

	    $this->db->from("vehicle_gps_information_temp vgi");
	   
		$this->db->join("vehicle_status vs","vs.vehicle_id=vgi.`vehicle_id`","left");
		 $this->db->join("driver_data d","d.id=vgi.`driver_id`","left" );
 
 		$this->db->where($where);
		$this->db->where("vgi.device_timestamp!=","NaN");
 		//$this->db->where('vgi.satelite>','7');
        //$this->db->order_by("device_timestamp asc");
  		$query = $this->db->get();
		 // print  $this->db->last_query();
		return $query->result_array();
		
	}
	
	public function gps_lastrow_main($where){//getting full last rows
		
		$this->db->select("vehicle_id,device_timestamp,speed,ign_status,unpluged,created");
	    $this->db->from("vehicle_gps_information");
 		$this->db->where($where);
		$this->db->where("device_timestamp!=","NaN");
 		$this->db->where('satelite>','7');
        //$this->db->order_by("device_timestamp desc");
		//$this->db->limit("1");
  		$query = $this->db->get();
		 // print  $this->db->last_query();
		return $query->result_array();
		
	}
 
	
 
	public function all_geoffence($where){
		$this->db->select("id,boundaries,color,name");
		$this->db->from("geoffence");
		if($where!="")
		  $this->db->where("id= ".$where."");
	    $query = $this->db->get();
	    //print  $this->db->last_query();
	    return $query->result_array();
		
	}
	 
		 
 	
	
	public function ideal_stop_duration($vehicle_id){
		
				$query = $this->db->query("SELECT * FROM `vehicle_gps_information` WHERE id > (select id from vehicle_gps_information where id>(select id from `vehicle_gps_information` WHERE ign_status='0' and `vehicle_id` ='".$vehicle_id."' order by `device_timestamp` desc limit 1) and speed>0 and `vehicle_id` ='".$vehicle_id."' order by device_timestamp desc limit 1 ) and `vehicle_id` ='".$vehicle_id."' and speed='0' and device_timestamp!='NaN' order by `device_timestamp` asc limit 1");
 		
 
       //print  $this->db->last_query();

         return $result=$query->row_array();

	}
	
	public function  stop_duration($vehicle_id){
		
		$query = $this->db->query("SELECT *  FROM `vehicle_gps_information` WHERE  id > (select id from `vehicle_gps_information`  WHERE `vehicle_id` = '".$vehicle_id."'   and ign_status !='0' and device_timestamp!='NaN' and  lattitude> 23 and lattitude< 27 and lognitude >49 and lognitude < 55
ORDER BY `vehicle_gps_information`.`device_timestamp` DESC limit 1) and `vehicle_id` ='".$vehicle_id."' and device_timestamp!='NaN'  limit 1");
print  $this->db->last_query();

 //print  $this->db->last_query();
           return $result=$query->row_array();

	}
	
	
	public function gps_accurate_data($ign_status,$vehicle_id){
		
		if($ign_status=='0'){
			
			$query = $this->db->query("select `lattitude`,`lognitude`,`Heading`,device_timestamp,odometer,speed from vehicle_gps_information where `id` > (select `id` FROM vehicle_gps_information where  `ign_status`='1' and `vehicle_id`='".$vehicle_id."' and device_timestamp!='NaN' order by `device_timestamp` desc limit 1 ) and `vehicle_id`='".$vehicle_id."' and device_timestamp!='NaN' and `ign_status`='0' LIMIT 1");
			
		}else{
			
			$query = $this->db->query("select `lattitude`,`lognitude`,`Heading`,device_timestamp,odometer,speed from vehicle_gps_information where `id` > (select `id` FROM vehicle_gps_information where `speed`>5 and `vehicle_id`='".$vehicle_id."' and device_timestamp!='NaN' order by `device_timestamp` desc limit 1 ) and `vehicle_id`='".$vehicle_id."' and `ign_status`='1' LIMIT 1");
		}
		
 		 // print  $this->db->last_query();
 
		return $result=$query->row_array();
		
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
	  
	  public function full_data($where,$order_by,$limit=""){
		  
		  $this->db->select("vd.name,vgi.id,vgi.device_timestamp,vgi.lattitude,vgi.lognitude,vgi.speed,vgi.odometer,vgi.ign_status,vgi.acceleration,vgi.hash_breaking,vgi.unpluged,vgi.altitude,vgi.Heading,vgi.created");
		  $this->db->from("vehicle_gps_information vgi");
	      $this->db->join('vehicle_data vd','vd.id=vgi.vehicle_id');
		   $this->db->where($where);
		  $this->db->order_by($order_by);
		  if($limit!="")
		     $this->db->limit($limit);
			 
		  $query = $this->db->get();
		  //print  $this->db->last_query();
		  return $result=$query->result_array();
			 
 	  }
	  
	  public function unpluged($where){
		  $this->db->select("unpluged");
		  $this->db->from("vehicle_gps_information");
		  $this->db->where($where);
		  $this->db->order_by("device_timestamp desc");
		  $this->db->limit("1");
		  $query = $this->db->get();
		   //print  $this->db->last_query();
		  return $result=$query->row_array();
		  
	  }
	   public function db_update($table,$values,$where){
       $this->db->set($values);
	   $this->db->where($where);
       $this->db->update($table);	   
       //print $this->db->last_query();
     }
	
}


?>