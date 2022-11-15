<?php if (!defined('BASEPATH')) exit ('No direct script access allowed'); 

class Reports_model extends CI_Model{
	
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
	  
	  public function geoffence_group_join($pull_items,$where=""){
		$this->db->select($pull_items);
 		$this->db->from("user_acess ua");
		$this->db->join("user u","u.user_group=ua.user_group_id");
		$this->db->join("Geoffence_group gg",'gg.id=ua.controll_id');
		$this->db->join('geoffence g','g.geo_group=gg.id');
		if(!empty($where))
	      $this->db->where($where);
		$query = $this->db->get();
		//  print  $this->db->last_query();
 	    return $result=$query->result_array();
 	}
	
 
	  public function reports_join($pull_items,$where){
		  
 		  $this->db->select($pull_items);
		  $this->db->from("user_acess ua");
		  $this->db->join("user u","u.user_group=ua.user_group_id");
		  $this->db->join("Reports r","r.id=ua.controll_id");
		  if(!empty($where))
	         $this->db->where($where);
		  $query = $this->db->get();
		    //print  $this->db->last_query();
 	      return $result=$query->result_array();
		  
		  
 	  }
	  
	  public function vehicle_group_join($pull_items,$where){
  	    $this->db->select($pull_items);
		$this->db->from("user_acess ua");
		$this->db->join("user u","u.user_group=ua.user_group_id");
		$this->db->join("department d",'d.id=ua.controll_id');
		$this->db->join('vehicle_data vd','vd.department_id=d.id');
		if(!empty($where))
	      $this->db->where($where);
		$query = $this->db->get();
		 // print  $this->db->last_query();
 	    return $result=$query->result_array();
      }	  
	  
	  /*public function vehicle_group_join($pull_items,$where){
	   
 	    $this->db->select($pull_items);
		$this->db->from("user_acess ua");
		$this->db->join("department d",'d.id=ua.controll_id');
		$this->db->join('vehicle_data vd','vd.department_id=d.id');
		if(!empty($where))
	      $this->db->where($where);
		$query = $this->db->get();
		//print  $this->db->last_query();
 	    return $result=$query->result_array();
    }*/
	
	
	public function db_datacheck($pull_items,$table,$where="",$dom="",$orderby="0",$limit="",$where_array=""){
		
		
		 
		 $this->db->select($pull_items);
		 $this->db->from($table);
		 if(!empty($where))
		   $this->db->where($where);
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
   
   public function odometer($where){
	   
	    $this->db->select("odometer as initial_odometer");
		$this->db->from("vehicle_gps_information");
		$this->db->where($where);
		$this->db->order_by("device_timestamp asc");
	    $this->db->limit("1");
	    $query = $this->db->get();
		 if($query->num_rows()>0)
 		    $result1=$query->row_array();
		 else
		    $result1['initial_odometer']=0;
  		
	    $this->db->select("odometer as final_odometer");
		$this->db->from("vehicle_gps_information");
		$this->db->where($where);
		$this->db->order_by("device_timestamp desc");
	    $this->db->limit("1");
	    $query1 = $this->db->get();
		 if($query1->num_rows()>0)
		   $result2=$query1->row_array();
		 else
		    $result2['final_odometer']=0;
		   
 		  $data = array_merge($result1, $result2);
   		 return $data;
   }

   	  // track button in exceed idle
      
	  public function multiple_vehicle_data($where){
		  $this->db->select("vd.id,vd.asset_code,vd.name,vd.description,d.name as department_name");
		  $this->db->from("vehicle_data vd");
		   $this->db->join('department d','d.id=vd.department_id');
		   
  		  $this->db->where_in('vd.id', $where);
		  $query = $this->db->get();
 
		  // print $this->db->last_query();
		  return $result=$query->result_array();
	  }


	  public function idle_track_data($where){
		  $this->db->select("vd.id,vd.name,vd.description,vg.idle_icon");
		  $this->db->from("vehicle_data vd");
		   $this->db->join('vehicle_group vg','vg.id=vd.group_id');		   
  		  $this->db->where('vd.id', $where);
		  $query = $this->db->get(); 
		  //print $this->db->last_query();
		  return $result=$query->row_array();
	  }
	  
	  public function geoffence_separating($where,$orderby="",$flag=""){
	  	  $this->db->select("g.name");
	      if($flag == "")
	      {
	      	$this->db->select("g.boundaries");	
	      }
		  
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
		   // print $this->db->last_query(); die;
		  return $result=$query->result_array();
	  }
	  
	  public function multiple_alert_data($where_in,$where,$where_typein,$where_geoffence_in=""){
		  $this->db->select("va.type,va.device_timestamp,va.speed,vd.asset_code,vd.description,vd.name,vg.name as group_name,g.name as geoffence");
		  $this->db->from("vehicle_alerts va");
		  $this->db->join('geoffence g','g.id=va.geoffence_id',"left");
		  $this->db->join('vehicle_data vd','vd.id=va.vehicle_id');
		  $this->db->join('vehicle_group vg','vg.id=vd.group_id');
		  $this->db->where_in('va.vehicle_id', $where_in);
		  $this->db->where_in('va.type', $where_typein);
		  if($where_geoffence_in!="")
		    $this->db->where_in('g.id', $where_geoffence_in);
		 // print "<pre>"; print_r($where_geoffence_in);
		 // die();
		  $this->db->where($where);
		  $query = $this->db->get();
		  $fp=fopen("sample.txt","w");
		  fwrite($fp,$this->db->last_query());
		  fclose($fp);
		 // print $this->db->last_query();
		  return $result=$query->result_array();
		  
	  }
	  
	  public function gps_lastrows($where){
		
		$this->db->select("vgi.`vehicle_id`,vgi.device_timestamp,vgi.lattitude,vgi.lognitude,vgi.speed,vgi.ign_status,vgi.Heading,vgi.manual_odometer,vgi.odometer,vgi.unpluged,vgi.created,vs.status as vehicle_status,vs.start_time,vs.end_time");
		$this->db->from("vehicle_gps_information vgi");
		$this->db->join("vehicle_status vs","vs.vehicle_id=vgi.`vehicle_id`","left");
		$this->db->where($where);
		$this->db->where("vgi.device_timestamp!=","NaN");
		$this->db->where('vgi.lattitude>','23');
		$this->db->where('vgi.lattitude<','27');
		$this->db->where('vgi.lognitude>','49');
		$this->db->where('vgi.lognitude<','55');
       // $this->db->order_by("vgi.device_timestamp asc");
 		$query = $this->db->get();
		 // print $this->db->last_query(); 		          
    	return $query->result_array();
  	  }
 	  
	  public function vehicle_external_details($where){
		
		 $this->db->select("vd.name,vd.description,vg.move_icon as run,vg.idle_icon as idle,vg.stop_icon as stop,vg.name as group_name,d.name as drivername,d.phone as driverphone");
		 $this->db->from("vehicle_data vd");
		 $this->db->join('vehicle_group vg','vg.id=vd.group_id');
		 $this->db->join('driver_data d','d.id=vd.driver_id', 'left');
		  $this->db->where($where);
		  $query = $this->db->get();
		  // print $this->db->last_query();
 	    return $result=$query->row_array();
	}
	 
 
	  public function vehicle_maintanace_data($where){
		  
		    $this->db->select("vd.id,vd.asset_code,vd.name,vd.description,vd.oil_change,vd.prev_oil_change,vg.maintanance_km,vg.maintanance_month");
		    $this->db->from("vehicle_data vd");
		    $this->db->join('vehicle_group vg','vg.id=vd.group_id');
			$this->db->where_in('vd.id', $where);
  		    $query = $this->db->get();
			  //print  $this->db->last_query();
		    return $result=$query->result_array();
			
	  }

	  //report update starts
	
 	  public function geoffenceduration($geowhere_clause,$vehicle_data,$geofence_from,$geofence_to){
		  
  		   $this->db->select("va.vehicle_id,va.geoffence_id,va.vehicle_gps_id,va.device_timestamp,va.type,vd.description,vd.asset_code,vgi.odometer");
		   $this->db->from("vehicle_alerts va");
		   $this->db->join("vehicle_data vd","vd.id=va.vehicle_id");
		   $this->db->join("vehicle_gps_information vgi","vgi.id=va.vehicle_gps_id");
 		   $this->db->where($geowhere_clause);
		   $this->db->group_start();
		   $this->db->where("va.type","3");
		   $this->db->or_where("va.type","4");
		   $this->db->group_end(); 
		   $this->db->group_start();
		   $this->db->where("va.geoffence_id",$geofence_from);
		   $this->db->or_where("va.geoffence_id",$geofence_to);
		   $this->db->group_end(); 
 		   $this->db->where_in("va.vehicle_id",$vehicle_data);
		   $this->db->order_by("va.vehicle_id asc");
		   $this->db->order_by("va.id asc");
  		   $query = $this->db->get();
		   // print $this->db->last_query(); die;
		   return $result=$query->result_array();
 	  }
	  
	  
	  public function geofencetimedatacheck($where,$vehicle_data,$selected_geoffence){
		   $this->db->select("va.geoffence_id,,va.vehicle_id,va.device_timestamp,va.type,g.name,vd.description,vd.asset_code");
		   $this->db->from("vehicle_alerts va");
		   $this->db->join("vehicle_data vd","vd.id=va.vehicle_id");
		   $this->db->join("geoffence g","g.id=va.geoffence_id");
		   $this->db->where($where);
		   $this->db->where_in("geoffence_id",$selected_geoffence);
		   $this->db->group_start();
		   $this->db->where("va.type","3");
		   $this->db->or_where("va.type","4");
		   $this->db->group_end(); 
		   $this->db->where_in("va.vehicle_id",$vehicle_data);
		   $this->db->order_by("va.vehicle_id asc");
		   $this->db->order_by("va.id asc");
		   $query = $this->db->get();
		   return $result=$query->result_array();
		  
	  }
	  
	//report update ends
	  
	  public function final_odometer_read($where){
		  
		   $this->db->select("odometer as final_odometer");
		   $this->db->from("vehicle_gps_information");
		   $this->db->where($where);
		   $this->db->order_by("device_timestamp desc");
	       $this->db->limit("1");
	       $query1 = $this->db->get();
		   //print  $this->db->last_query();
 		  return $result=$query1->row_array();
			  
	  }
	  
	  public function full_data($where_in,$where,$order_by){
		  $this->db->select("vd.name,vgi.id,vgi.device_timestamp,vgi.lattitude,vgi.lognitude,vgi.speed,vgi.idling,vgi.external_power,vgi.battery_power,vgi.generated_event,vgi.generated_event_value,vgi.satelite,vgi.movement,vgi.manual_odometer,vgi.odometer,vgi.ign_status,vgi.acceleration,vgi.hash_breaking,vgi.unpluged,vgi.altitude,vgi.Heading,vgi.created");
		  $this->db->from("vehicle_gps_information vgi");
	      $this->db->join('vehicle_data vd','vd.id=vgi.vehicle_id');
		  $this->db->where_in('vgi.vehicle_id',$where_in);
		  $this->db->where($where);
		  $this->db->order_by($order_by);
 		  $query = $this->db->get();
		  //print  $this->db->last_query();
		  return $result=$query->result_array();
		  
			 
 	  }
	  
	  public function wrong_data($where_in,$order_by){
		  $this->db->select("vd.name,vd.asset_code,vd.description,vgi.id,vgi.device_timestamp,vgi.lattitude,vgi.lognitude,vgi.speed,vgi.odometer,vgi.ign_status,vgi.acceleration,vgi.hash_breaking,vgi.unpluged,vgi.altitude,vgi.Heading,vgi.created");
		  $this->db->from("vehicle_gps_information vgi");
	      $this->db->join('vehicle_data vd','vd.id=vgi.vehicle_id');	
		  $this->db->where_in('vgi.vehicle_id',$where_in);
		  $this->db->group_start();
		  $this->db->or_where('device_timestamp<',1514754000);
		   $this->db->or_where('device_timestamp=','NaN');
		   $this->db->or_where('lattitude<',23);
		   $this->db->or_where('lattitude>',27);
		   $this->db->or_where('lognitude<',49);
		   $this->db->or_where('lognitude>',55);
		   $this->db->group_end();
		  $this->db->order_by($order_by);
		  $query = $this->db->get();
		  //print  $this->db->last_query();
		  return $result=$query->result_array();
	  }
	  
	  // woqode report update starts

	  public function woqode_datas($vehicle_data,$where){
		  $this->db->select("wd.vehicle_id,wd.qunatity,wd.time,wd.station,vd.asset_code,vd.description");
		  $this->db->from("woqode_data wd");
		  $this->db->join("vehicle_data vd","vd.id=wd.vehicle_id");
		  $this->db->where_in('wd.vehicle_id',$vehicle_data);
		  $this->db->where($where);
		  $query = $this->db->get();
		  // print  $this->db->last_query(); die;
		  return $result=$query->result_array();
 	  }
	  
	  public function woqode_geofence($vehicle_id,$time){
		  
		   $this->db->select("geoffence_id as geofence_in,type as geofence_intype,device_timestamp  as geofence_intime");
		   $this->db->from("vehicle_alerts");
		   $this->db->where('vehicle_id',$vehicle_id);
		   $this->db->where('device_timestamp<=',$time);
 		   $this->db->where('type',"3");
  		   $this->db->order_by("device_timestamp desc");
		   $this->db->limit("1");
		   $query = $this->db->get();
		  // print  $this->db->last_query();
		   $result1=$query->row_array();
		   
 		   $this->db->select("geoffence_id as geofence_out,type as geofence_outtype,device_timestamp   as geofence_outtime");
		   $this->db->from("vehicle_alerts");
		   $this->db->where('vehicle_id',$vehicle_id);
		   $this->db->where('device_timestamp>=',$time);
		   $this->db->where('type',"4");
		   $this->db->order_by("device_timestamp asc");
		   $this->db->limit("1");
		   $query = $this->db->get();
		  // print  $this->db->last_query();
		   $result2=$query->row_array();
 		   $data = array_merge($result1, $result2);
   		   return $data;
 	  }

	  // woqode report update ends
	  
	
}