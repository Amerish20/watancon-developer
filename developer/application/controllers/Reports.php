<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        login_check();
  		$this->load->model('reports_model');
 		$this->load->helper('url');
		//ini_set('memory_limit','1024');
    }
	public function index(){
		  login_check();
		  $whereheader_clause['u.id']=$this->session->userdata('id');
	      $whereheader_clause['ua.type']="1";
	      $whereheader_clause['ua.status']="1";
	      $data1['masters_data']=$this->reports_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
		  $data1['heading']="Reports";
		  $data1['page_head_icon']="fa fa-newspaper-o";
		  $reportwhere_clause=array();
		  $reportwhere_clause['u.id']=$this->session->userdata('id');
		  $reportwhere_clause['ua.type']="3";
		  $reportwhere_clause['ua.status']="1";
		  $report_status=$this->reports_model->master_join("ua.controll_id",$reportwhere_clause);
		  $data1['report_status']="0"; 
		  if(count($report_status)>0){
			   $data1['report_status']="1";
		  }
		  
  		  $where_clause['u.id']=$this->session->userdata('id');
		  $where_clause['ua.type']="3";
		  $where_clause['ua.status']="1";
 		  $data['reports_list']=$this->reports_model->reports_join("r.id,r.report_name",$where_clause);
 		  $where_clause['vd.status']="1";
		  $where_clause['ua.type']="2";
		  
          $vehiclefulldata= $this->reports_model->vehicle_group_join("vd.id as id,vd.description,d.id as group_id,d.name as group_name",$where_clause);
 
 
		  $data['vehicle_fulldata']="";
  		  //$vehiclefulldata= $this->reports_model->vehicle_group_join("vd.id,vd.description,vg.id as group_id,vg.name as group_name","");
		  if(count($vehiclefulldata)>0){
 		    foreach($vehiclefulldata as $vehicle_key=>$vehicledata){
 			  $groupwise_data[$vehicledata['group_id']]['group_name']=$vehicledata['group_name'];
   			  $groupwise_data[$vehicledata['group_id']][$vehicledata['id']]['description']=$vehicledata['description'];
   		    }
			$data['vehicle_fulldata']=$vehiclefulldata;
			$data['vehicle_data']=$groupwise_data;
		  }
		  
		  $geoffencewhere_clause =array();
		 // $geoffencewhere_clause['g.status']="1";
		 // $geoffencewhere_clause['gg.status']="1";
 		  $geoffencefulldata= $this->reports_model->geoffence_group_join("g.id,g.name,gg.id as group_id,gg.Name as group_name");
		  
		 // print "<pre>"; print_r($geoffencefulldata);
		  //die();
		  if(count($geoffencefulldata)>0){
			  foreach($geoffencefulldata as $geoffencedatakey=>$geoffencedata){
				   $groupwise_geoffence[$geoffencedata['group_id']]['group_name']=$geoffencedata['group_name'];
				   $groupwise_geoffence[$geoffencedata['group_id']][$geoffencedata['id']]['description']=$geoffencedata['name'];
			  }
		  }else{
			  $groupwise_geoffence=array();
		  }
		  
 		  $data['geoffence_data']=$groupwise_geoffence;
		  
		  $this->load->view('header',$data1);
  	      $this->load->view('reports',$data);
		  $this->load->view('footer');
		
	}
	
	public function pointInPolygon($points, $polygons_data, $pointOnVertex = true) {
 		foreach($polygons_data as $polygons_key =>$polygon){
			$point=$points;
         $this->pointOnVertex = $pointOnVertex;
        $point = $this->pointStringToCoordinates($point);
         $vertices = array(); 
        foreach ($polygon as $vertex) {
              $vertices[] = $this->pointStringToCoordinates($vertex); 
        }
          if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return "vertex";
        }
		
        $intersections = 0; 
        $vertices_count = count($vertices);
        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1]; 
            $vertex2 = $vertices[$i];
            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
                return "boundary";
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) { 
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x']; 
                if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                    return "boundary";
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++; 
                }
            } 
        } 
        if ($intersections % 2 != 0) {
            return $polygons_key ;
			break;
        }  
		
	  }
     }
 
    public function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
 
    }
 
    public function pointStringToCoordinates($pointString) {
        $coordinates = explode(" ", $pointString);
        return array("x" => $coordinates[0], "y" => $coordinates[1]);
    }
	  
	public function get_geoffence($geoffence_id=""){
		
		$where=$geoffence_id;
		$orderby="priority asc";
		//print "<pre>"; print_r($where);
		//die();
		$geoffence_data = $this->reports_model->geoffence_separating($where,$orderby);
				
		foreach($geoffence_data as $geoffence_key => $geoffence_datas){
			
			$geoffence[$geoffence_datas['name']]=array();
 			$boundaries=explode("),(",$geoffence_datas['boundaries']);
			
 			foreach($boundaries as $boundaries_data){
 				$boundaries_data=str_replace("(","",$boundaries_data);
				$boundaries_data=str_replace(")","",$boundaries_data);
				$boundaries_data=str_replace(",","",$boundaries_data);
				array_push($geoffence[$geoffence_datas['name']],trim($boundaries_data));
				
			}
			
			    $boundaries_data=str_replace("(","",$boundaries[0]);
				$boundaries_data=str_replace(")","",$boundaries_data);
				$boundaries_data=str_replace(",","",$boundaries_data);
			    array_push($geoffence[$geoffence_datas['name']],trim($boundaries_data));
 		}
		
		return $geoffence;
 	}
	
	  /*exceed idle report started */
    public function idle_exeed(){
		   ini_set('memory_limit','2048M');
		   $seleceted_geoffence  = $this->input->post('geoffence_select');
		   $unselected_geoffence = $this->input->post('geoffence_unselect');
 		   $this->geoffence_data = $this->get_geoffence($seleceted_geoffence);
 		   $orderby              = "priority asc";
 		   if(!empty($unselected_geoffence))
 		     $this->geoffence_exclude_data =array_column($this->reports_model->geoffence_separating($unselected_geoffence,$orderby,1), "name") ; 
 		     else
 		     		$this->geoffence_exclude_data =array(); 
 		  // echo "here <pre>"; print_r($this->geoffence_exclude_data); die;
  		   $time_limit=$this->input->post("stop_duration")!=""?($this->input->post("stop_duration"))*60:'0';
		   
   		   $where=array_filter(explode(",",$this->input->post('vehicle_data')));
   		   $now=round(microtime(true) * 1000)."\r\n";
		     //$where=array('190');
		  //  print "start execution on".$now."\r\n";
   		   $vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
		   
		  // print "got the data from vehiclefulldata ".((round(microtime(true) * 1000)-$now)/1000)."\r\n";
		   $now=round(microtime(true) * 1000);
		  
		   $from_date=strtotime($this->input->post("from"))*1000;
		   $to_date=strtotime($this->input->post("to"))*1000;
		   /*$time_limit="120";
 		   $from_date=1555423080000;
		   $to_date=1555753260000;*/ 
		   $seleceted_geoffence=$this->input->post('geoffence_select');
 		   
 		   $this->response_result['data']=array();
		   $dom_i="1";
		      
  		   foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
			   
 			   $gpsrowwhere_clause['device_timestamp<']=$from_date;
 			   $gpsrowwhere_clause['vehicle_id']=$vehicle_data['id'];
  			   $roworderby="device_timestamp desc";
			   $rowlimit="1";
 			   $gpsrow_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpsrowwhere_clause,"1",$roworderby,$rowlimit);
			   
			    $first_ignition=$gpsrow_info['ign_status'];	
 			   if($gpsrow_info['satelite']<7){
				   $gpsrowwhere_clause['satelite>']="6";
 				   $gpsrow_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpsrowwhere_clause,"1",$roworderby,$rowlimit); 
			   }
			   
 
               $gpslastwhere_clause['device_timestamp>']=$to_date;
 			   $gpslastwhere_clause['vehicle_id']=$vehicle_data['id'];
  			   $roworderby="device_timestamp asc";
			   $rowlimit="1";
 			   $gpslast_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpslastwhere_clause,"1",$roworderby,$rowlimit);
			   
               $last_ignition=$gpslast_info['ign_status'];	
 			   if($gpslast_info['satelite']<7){
				   $gpslastwhere_clause['satelite>']="6";
				   $gpslast_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpslastwhere_clause,"1",$roworderby,$rowlimit);
 			   }
 
  			  $now=round(microtime(true) * 1000);
    		  $gpswhere_clause['vehicle_id']=$vehicle_data['id'];
   			  $gpswhere_clause['device_timestamp>=']=$from_date;
			  $gpswhere_clause['device_timestamp<=']=$to_date;
   			  $orderby="device_timestamp asc";
   			  $gps_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpswhere_clause,"",$orderby); 
 			  $rd="1";
 			  
			  $now=round(microtime(true) * 1000);
 			  /* define the default variables*/
 			  $this->lattitude="";
			  $this->lognitude="";
 			  $this->ignition="";
			  $this->speed="";
			  $this->timestamp=0;
			  $this->previoustimestamp=0;
			  $this->idle_start_timestamp=0;
			  $this->idle_previous_timestamp=0;
			  
  			  $total_count=count($gps_info);
			  
			  foreach($gps_info as $gps_data_key=>$gps_data){
 				 
				 
				  
			  if($gps_data['satelite']<7){
				  
				   if($this->lattitude=="" && $this->lognitude==""){
					   $gps_data['lattitude']=$gpsrow_info['lattitude'];
					   $gps_data['lognitude']=$gpsrow_info['lognitude'];
					   $gps_data['speed']=$gpsrow_info['speed'];
				   }else{
					   $gps_data['lattitude']=$this->lattitude;
					   $gps_data['lognitude']=$this->lognitude;
					   $gps_data['speed']=$this->speed;
					   
				   }
			   } 
 				   
			  // if($gps_data['satelite'] > 6 || ($gps_data['ignition']!=$this->ignition) ){ 
			  
			    if($this->lattitude!="" && $this->lognitude!=""){
					
			        if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
  					    if($this->idle_start_timestamp!=0){ 
 						   if($this->previous_timestamp!=$this->idle_start_timestamp){
							    $difference=(((int)$this->previous_timestamp) - ((int)$this->idle_start_timestamp)) / 1000;
								if($time_limit<$difference){
 							        $this->idle_dataprepare($vehicle_data,$this->idle_start_timestamp,$this->idle_previous_timestamp,$this->lattitude,$this->lognitude, $seleceted_geoffence);
							      $dom_i++; 
								}
						   }
 						}
						$this->idle_start_timestamp="0";
				    }
				    
				}
 			    if(($this->lattitude!=$gps_data['lattitude'] || $this->lognitude!=$gps_data['lognitude']) && $this->lattitude!="" && $this->lognitude!="" ){
				   
				   
 				   if($this->ignition=="1"){ 
  					   if($this->idle_start_timestamp!=0){ 
					   
					        if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
								$this->idle_previous_timestamp=$this->previous_timestamp;
							} 
 					   
 					       $difference=(((int)$this->idle_previous_timestamp) - ((int)$this->idle_start_timestamp)) / 1000;
						   if($time_limit<$difference){
					          $this->idle_dataprepare($vehicle_data,$this->idle_start_timestamp,$this->idle_previous_timestamp,$this->lattitude,$this->lognitude, $seleceted_geoffence);
 							  $dom_i++;
						   }
						   
						   
						   $this->idle_start_timestamp=0;
					   }
				   }
				    $this->idle_previous_timestamp=0;
 				   
			   }else if($this->lattitude==$gps_data['lattitude'] && $this->lognitude==$gps_data['lognitude'] && $gps_data['speed']==0){
				   
				    
				    if($this->speed>0){
 						if($this->idle_start_timestamp==0 && $gps_data['ign_status']=="1"){
 						  $this->idle_start_timestamp=$gps_data['device_timestamp'];
						  
  						}
 					}
					
					 if($this->ignition=="1" && $this->speed=="0"){
 						 if($this->idle_start_timestamp==0){
 							 $this->idle_start_timestamp=$this->previous_timestamp;
							 
 						 }
					 }
  					 
					 if($this->ignition!=$gps_data['ign_status']){
						  if($gps_data['ign_status']=="0"){
							  
							  if($this->idle_start_timestamp!=0){ 
							    if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
								   $gps_data['device_timestamp']=$this->previous_timestamp;
							    } 
					            $difference=(((int)$gps_data['device_timestamp']) - ((int)$this->idle_start_timestamp)) / 1000;
								   if($time_limit<$difference){
 									  $this->idle_dataprepare($vehicle_data,$this->idle_start_timestamp,$gps_data['device_timestamp'],$this->lattitude,$this->lognitude, $seleceted_geoffence);                            
 									  $dom_i++;
								   }
								    $this->idle_start_timestamp=0;
							   }
							   
							   
							   
 						  }
					 }
					 
					 if($gps_data_key==($total_count-1) ){
						 
						  if($gps_data['ign_status']=="1"){
							  
							  if($this->idle_start_timestamp!=0){ 
							  
							   if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
								     $final_date=$this->previous_timestamp;
									 $difference=(((int)$final_date) - ((int)$this->idle_start_timestamp)) / 1000;
							   }else{
							  
									if($gpslast_info['device_timestamp']!=""){
										if((($to_date-$gps_data['device_timestamp'])/1000)>1800){
											$difference=(((int)$gps_data['device_timestamp']) - ((int)$this->idle_start_timestamp)) / 1000;
										    $final_date=$gps_data['device_timestamp'];
										}else{
											$difference=(((int)$to_date) - ((int)$this->idle_start_timestamp)) / 1000;
										 $final_date=$to_date;
										}
										
										 
									}else{
										 $difference=(((int)$gps_data['device_timestamp']) - ((int)$this->idle_start_timestamp)) / 1000;
										 $final_date=$gps_data['device_timestamp'];
									}
							   }
					           
							   
							   
								   if($time_limit<$difference){
 									  $this->idle_dataprepare($vehicle_data,$this->idle_start_timestamp,$final_date,$this->lattitude,$this->lognitude, $seleceted_geoffence);
 									  $dom_i++;
								   }
								    $this->idle_start_timestamp=0;
							   }
 						  }
					 }
					 
					 if($gps_data['ign_status']!="0"){
 							   $this->idle_previous_timestamp=$gps_data['device_timestamp'];
 							  // print $this->idle_previous_timestamp."<br/>";
					 }
				   
				   
			   }else if($this->lattitude=="" && $this->lognitude ==""){
				   
				   if($from_date < $gps_data['device_timestamp'] ){
					   
 					   if(count($gpsrow_info)>0){
						    if($gpsrow_info['lattitude']==$gps_data['lattitude'] && $gpsrow_info['lognitude']==$gps_data['lognitude']){
							  if($first_ignition!=$gps_data['ign_status']){
								   if($gps_data['ign_status']=="1"){
									   $this->idle_start_timestamp=$gps_data['device_timestamp'];
									   $this->idle_previous_timestamp=$gps_data['device_timestamp'];
								   }
							   }else{
								   if($gps_data['ign_status']=="1"){
										if($gps_data['speed'] ==0 || $gpsrow_info['speed']==0){
											$this->idle_start_timestamp=$from_date;
											$this->idle_previous_timestamp=$gps_data['device_timestamp'];
										}
								   }
								   
							   }
						   }
					   }
					   
				   }
				   
				   
			   }else{
				   
				   if($this->ignition!=$gps_data['ign_status']){
					   if($gps_data['ign_status']=="0"){
						   if($this->idle_start_timestamp!=0){ 
						   
						       if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
								    $final_date=$this->previous_timestamp;
									 
							   }else{
								   $final_date=$gps_data['device_timestamp'];
							   }
						   
					            $difference=(((int)$final_date) - ((int)$this->idle_start_timestamp)) / 1000;
								   if($time_limit<$difference){
									  $this->idle_dataprepare($vehicle_data,$this->idle_start_timestamp,$gps_data['device_timestamp'],$this->lattitude,$this->lognitude, $seleceted_geoffence);
 									  $dom_i++;
								   }
								   $this->idle_start_timestamp=0;
						  }
					   }
				   }else{
					    if($gps_data['ign_status']=="1"){
							if($this->lattitude==$gps_data['lattitude'] && $this->lognitude==$gps_data['lognitude'] && $gps_data['speed']>0){
								 if($this->idle_start_timestamp!=0){ 
								    if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
								      $this->idle_previous_timestamp=$this->previous_timestamp;
 							        } 
										$difference=(((int)$$this->idle_previous_timestamp) - ((int)$this->idle_start_timestamp)) / 1000;
										   if($time_limit<$difference){
											  $this->idle_dataprepare($vehicle_data,$this->idle_start_timestamp,$this->idle_previous_timestamp,$this->lattitude,$this->lognitude, $seleceted_geoffence);
											 
											  $dom_i++;
										   }
										    $this->idle_start_timestamp=0;
								  }
								
							}else{
								if($this->idle_start_timestamp==0 ){
						                 $this->idle_start_timestamp=$this->previous_timestamp;
  						          }
							}
						}
				   }
				   
			   }
			   
			     $this->previous_timestamp=$gps_data['device_timestamp'];
				 $this->lattitude=$gps_data['lattitude'];
				 $this->lognitude=$gps_data['lognitude']; 
     			 $this->ignition=$gps_data['ign_status'];
				 $this->speed=$gps_data['speed'];
			   
			  //}
			 }
 			  
		   }
		   
 		   $this->response_result['draw']="1";
		  $this->response_result['recordsTotal']=$dom_i;
		  $this->response_result['recordsFiltered']="30";
		  $now=round(microtime(true) * 1000);
    	  print json_encode($this->response_result);
 	}
 	  
	  
	  // public function idle_dataprepare($vehicle_data,$start_time,$end_time,$lattitude,$lognitude,$geoffence_id=""){
		    
			
			//  if($start_time!=$end_time){
		 //       //$geoffence_data=$this->get_geoffence($geoffence_id);
			//    $difference=(((int)$end_time) - ((int)$start_time)) / 1000;
			//    $second = 1;
			//    $minute = 60*$second;
			//    $hour   = 60*$minute;
			//    $day    = 24*$hour;
		  
			//    $ans["hour"]   = floor(($difference)/$hour)<10?"0".floor(($difference)/$hour):floor(($difference)/$hour);
			//    $ans["minute"] = floor(($difference%$hour)/$minute)<10?"0".floor(($difference%$hour)/$minute):floor(($difference%$hour)/$minute);
			//    $ans["second"] = floor((($difference%$hour)%$minute)/$second)<10?"0".floor((($difference%$hour)%$minute)/$second):floor((($difference%$hour)%$minute)/$second);
			//    $response['asset_code']=$vehicle_data['asset_code'];
			//    $response['name']=$vehicle_data['name'];
			//    $response['description']=$vehicle_data['description'];
			//    $response['group_name']=$vehicle_data['department_name'];
			//    $response['stopped']= $ans["hour"].":".$ans["minute"] . ":" . $ans["second"]; 
			//    $response['start_date']=date("d/m/Y H:i:s a",round($start_time/1000)) ;
			//    $response['end_date']=date("d/m/Y H:i:s a",round($end_time/1000));
			//    $point=$lattitude." ".$lognitude;
   //             $current_geoffence = $this->pointInPolygon($point,$this->geoffence_data);
   //              if(!empty($this->geoffence_exclude_data)){
   //             	   if(!in_array($current_geoffence, $this->geoffence_exclude_data))
			//        {
			//    		  $response['geofence'] = $current_geoffence;
			//        }   

   //             }else{
   //             	   $response['geofence'] = $current_geoffence;
   //             }
			   
			//    $response['lattitude']=$lattitude;
			//    $response['lognitude']=$lognitude;
			   
			//    if(!empty($geoffence_id)){
			// 	   if($response['geofence']!="")
			// 	   array_push($this->response_result['data'],$response);
			//    }else{
			// 	   array_push($this->response_result['data'],$response);
			//    }
			   
			   
			//  }
			 
 	 //  }
	  
	  // track button in exceed ideal

	   public function idle_dataprepare($vehicle_data,$start_time,$end_time,$lattitude,$lognitude,$geoffence_id=""){
		    
			
			 if($start_time!=$end_time){
		       //$geoffence_data=$this->get_geoffence($geoffence_id);
			   $difference=(((int)$end_time) - ((int)$start_time)) / 1000;
			   $second = 1;
			   $minute = 60*$second;
			   $hour   = 60*$minute;
			   $day    = 24*$hour;
		  
			   $ans["hour"]   = floor(($difference)/$hour)<10?"0".floor(($difference)/$hour):floor(($difference)/$hour);
			   $ans["minute"] = floor(($difference%$hour)/$minute)<10?"0".floor(($difference%$hour)/$minute):floor(($difference%$hour)/$minute);
			   $ans["second"] = floor((($difference%$hour)%$minute)/$second)<10?"0".floor((($difference%$hour)%$minute)/$second):floor((($difference%$hour)%$minute)/$second);
			   $response['asset_code']=$vehicle_data['asset_code'];
			   $response['name']=$vehicle_data['name'];
			   $response['description']=$vehicle_data['description'];
			   $response['group_name']=$vehicle_data['department_name'];
			   $response['stopped']= $ans["hour"].":".$ans["minute"] . ":" . $ans["second"]; 
			   $response['start_date']=date("d/m/Y H:i:s a",round($start_time/1000)) ;
			   $response['end_date']=date("d/m/Y H:i:s a",round($end_time/1000));
			   $point=$lattitude." ".$lognitude;
			   // exclude geofense update starts

			   $current_geoffence = $this->pointInPolygon($point,$this->geoffence_data);
                if(!empty($this->geoffence_exclude_data)){
               	   if(!in_array($current_geoffence, $this->geoffence_exclude_data))
			       {
			   		  $response['geofence'] = $current_geoffence;
			       }   

               }else{
               	   $response['geofence'] = $current_geoffence;
               }

			   // exclude geofense update ends
			   
			   $response['lattitude']=$lattitude;
			   $response['lognitude']=$lognitude;
			   $position=$lattitude.",".$lognitude;
			    $response['track']='<input type="button" class="btn btn-primary exceed-idle-track" id="track_'.$vehicle_data['id'].'" data-id="'.$start_time.'" data-option="'.$position.'"  value="Track" >';
			   if(!empty($geoffence_id)){
				   if($response['geofence']!="")
				   array_push($this->response_result['data'],$response);
			   }else{
				   array_push($this->response_result['data'],$response);
			   }
 			 }
  	  } 
 	  
	  // track button in exceed ideal

	  
	  public function data_prepare($vehicle_data,$start_time,$end_time,$status){
		  
		   $difference=($end_time-$start_time)/1000;
		   
 		   $second = 1;
           $minute = 60*$second;
           $hour   = 60*$minute;
           $day    = 24*$hour;
          //$ans["day"]    = floor($difference/$day);
           $ans["hour"]   = floor(($difference)/$hour)<10?"0".floor(($difference)/$hour):floor(($difference)/$hour);
           $ans["minute"] = floor(($difference%$hour)/$minute)<10?"0".floor(($difference%$hour)/$minute):floor(($difference%$hour)/$minute);
           $ans["second"] = floor((($difference%$hour)%$minute)/$second)<10?"0".floor((($difference%$hour)%$minute)/$second):floor((($difference%$hour)%$minute)/$second);
		   $response['asset_code']=$vehicle_data['asset_code'];
		   $response['name']=$vehicle_data['name'];
		   $response['description']=$vehicle_data['description'];
		   $response['group_name']=$vehicle_data['department_name'];
  		   $response['start_date']=date("d/m/Y H:i:s a",round($start_time/1000));
 		   $response['end_date']=date("d/m/Y H:i:s a",round($end_time/1000));
 		   
		   $response['time_duration']= $ans["hour"].":".$ans["minute"] . ":" . $ans["second"]; 
 		   if($status!="")
		     $response['status']=$status;
			 
			 if($start_time!=$end_time){
   		         array_push($this->response_result['data'],$response);
			 }
 	  }
	  
	  
	   public function fullsummary_report(){
		  ini_set('memory_limit','2048M');
		   $where=array_filter(explode(",",$this->input->post('vehicle_data')));
		   // $where=array(35);
 		   $vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
 		   $this->response_result['data']=array();
		   $dom_i="1";
 		   $from_date=strtotime($this->input->post("from"))*1000;
		   $to_date=strtotime($this->input->post("to"))*1000;
		   
		    /*$from_date=1550389800000;
		   $to_date=1550390700000 ;
		   $from_date=1547884800000;
		   $to_date=1547885700000; */
		   
		   
		  /* $from_date=1556810400000;
		   $to_date=1556812020000;*/
		   
		   
   		   foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
			   
			   
			   $gpsrowwhere_clause['device_timestamp<']=$from_date;
 			   $gpsrowwhere_clause['vehicle_id']=$vehicle_data['id'];
  			   $roworderby="device_timestamp desc";
			   $rowlimit="1";
 			   $gpsrow_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpsrowwhere_clause,"1",$roworderby,$rowlimit);
			   
			    $first_ignition=$gpsrow_info['ign_status'];	
 			   if($gpsrow_info['satelite']<7){
				   $gpsrowwhere_clause['satelite>']="6";
 				   $gpsrow_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpsrowwhere_clause,"1",$roworderby,$rowlimit); 
			   }
			   
               $gpslastwhere_clause['device_timestamp>']=$to_date;
 			   $gpslastwhere_clause['vehicle_id']=$vehicle_data['id'];
  			   $roworderby="device_timestamp asc";
			   $rowlimit="1";
 			   $gpslast_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpslastwhere_clause,"1",$roworderby,$rowlimit);
			   
               $last_ignition=$gpslast_info['ign_status'];	
 			   if($gpslast_info['satelite']<7){
				   $gpslastwhere_clause['satelite>']="6";
				   $gpslast_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpslastwhere_clause,"1",$roworderby,$rowlimit);
 			   }
 			   
    		  $gpswhere_clause['vehicle_id']=$vehicle_data['id'];
  			  $gpswhere_clause['device_timestamp>=']=$from_date;
			  $gpswhere_clause['device_timestamp<=']=$to_date;
			  //$gpswhere_clause['satelite>']="6";
 			  $orderby="device_timestamp asc";
			  
   			  $gps_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpswhere_clause,"",$orderby); 
 			 
			  /* define the default variables*/
 			  $this->lattitude="";
			  $this->lognitude="";
			  $this->ignition="";
			  $this->speed=0;
  			  $this->previoustimestamp=0;
 			  $this->start_stoptimestamp=0;
 			  $this->idle_start_timestamp=0;
			  $this->idle_previous_timestamp=0;
			  $this->movement_start_timestamp=0;
			  $this->movement_previous_timestamp=0;
			  
   			  $total_count=count($gps_info);
			  
  			  foreach($gps_info as $gps_data_key=>$gps_data){
				  
 				  if($gps_data['satelite']<7){
					  
   					   if($this->lattitude=="" && $this->lognitude==""){
 						   $gps_data['lattitude']=$gpsrow_info['lattitude'];
						   $gps_data['lognitude']=$gpsrow_info['lognitude'];
						   $gps_data['speed']=$gpsrow_info['speed'];
 					   }else{
						   $gps_data['lattitude']=$this->lattitude;
						   $gps_data['lognitude']=$this->lognitude;
						   $gps_data['speed']=$this->speed;
 					   }
					   
 				   }
				   
				   if($this->lattitude!="" && $this->lognitude!=""){
				   
					   if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
						 
						  if($this->idle_start_timestamp!=0){ 
							 if($this->previous_timestamp!=$this->idle_start_timestamp){
								$this->data_prepare($vehicle_data,$this->idle_start_timestamp,$this->previous_timestamp,"Idle");
								$dom_i++; 
							 }
						  }
						  if($this->movement_start_timestamp!="0"){
							  if($this->previous_timestamp!=$this->movement_start_timestamp){
								$this->data_prepare($vehicle_data,$this->movement_start_timestamp,$this->previous_timestamp,"Movement");
								$dom_i++; 
							 }
						  }
						   
						  if($this->start_stoptimestamp!="0"){
							 if($this->previous_timestamp!=$this->start_stoptimestamp){
								  $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$this->previous_timestamp,"stop");
								  $dom_i++;
							 }
						  }
						  
						  $this->idle_start_timestamp=0;
						  $this->movement_start_timestamp=0;
						  $this->start_stoptimestamp=0;
						   
						  
					 }
				   }
  				  
				   /* calculating the running and movement time*/
			 
			     if(($this->lattitude!=$gps_data['lattitude'] || $this->lognitude!=$gps_data['lognitude']) && $this->lattitude!="" && $this->lognitude!="" ){
					 
 					 				//print $gps_data['speed']."<br/>";	   
  					 if($this->ignition=="1"){ 
  					   if($this->idle_start_timestamp!=0){ 
					   
					   
					         if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
								 if($this->previous_timestamp!=$this->idle_start_timestamp){
									$this->data_prepare($vehicle_data,$this->idle_start_timestamp,$this->previous_timestamp,"Idle");
 							        $dom_i++; 
								 }
								 
							 }else{
 					              $this->data_prepare($vehicle_data,$this->idle_start_timestamp,$this->idle_previous_timestamp,"Idle");
 							      $dom_i++;
							 }
							  $this->idle_start_timestamp=0;
					   }
					   if($this->movement_start_timestamp==0){
							 $this->movement_start_timestamp=$this->previous_timestamp;
					   }
 					 }else{
						 if($this->start_stoptimestamp==0){
								 $this->start_stoptimestamp=$this->previous_timestamp;
 						 }
					 }
					 
					 
					 
					 if($gps_data['ign_status']=="0"){
							 if($this->start_stoptimestamp==0){
								 if($this->ignition==0){
									 $this->start_stoptimestamp=$this->previous_timestamp;
								 }else{
									 $this->start_stoptimestamp=$gps_data['device_timestamp'];
								 }
								 
							 }
					 } 
					 
					 
  					 if($this->ignition!=$gps_data['ign_status']){
						 
						if($gps_data['ign_status']=="0"){
							
							//print $gps_data['id']."---".$this->totalmovement_time."+".$gps_data['device_timestamp']."-".$this->movement_start_timestamp."=";
							 if($this->movement_start_timestamp!="0"){
								 
								 if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
									 
 									 if($this->previous_timestamp!=$this->movement_start_timestamp){
									    $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$this->previous_timestamp,"Movement");
										$dom_i++; 
									 }
								 
							    }else{
								 
 							        $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$gps_data['device_timestamp'],"Movement");
									$dom_i++;
							      }
 							        $this->movement_start_timestamp=0;
							     
 							 }
 							 
							 if($this->start_stoptimestamp=="0"){
							   $this->start_stoptimestamp=$gps_data['device_timestamp'];
							 }
 						   
						}else{
 							//$this->movement_start_timestamp=$gps_data['device_timestamp'];
 							if($this->start_stoptimestamp!="0"){
								 if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
									 if($this->previous_timestamp!=$this->start_stoptimestamp){
										 $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$this->previous_timestamp,"stop");
 								         $dom_i++;
									 }
									 
								 }else{
 								   $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$gps_data['device_timestamp'],"stop");
 								    $dom_i++;
								 }
								  $this->start_stoptimestamp=0;
							 }
							 
							 if($this->movement_start_timestamp==0){
							     $this->movement_start_timestamp=$gps_data['device_timestamp'];
					         } 
							 
 						}
 						
 					 }
					 
					 if($gps_data_key==($total_count-1)){ ///if the movement not break,consider the last raws device time as endtime
					 
					 
 					      if($gps_data['ign_status']=="1"){
							  
							  if($this->movement_start_timestamp!=0){
  										if($gpslast_info['device_timestamp']!=""){
											
											if((($to_date-$gps_data['device_timestamp'])/1000)>1800){
												$this->data_prepare($vehicle_data,$this->movement_start_timestamp,$gps_data['device_timestamp'],"Movement");
												$dom_i++; 
											}else{
											
										       $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$to_date,"Movement");
											    $dom_i++;
											}
 										}else{
											
											$this->data_prepare($vehicle_data,$this->movement_start_timestamp,$gps_data['device_timestamp'],"Movement");
											$dom_i++;
										}
   								   $this->movement_start_timestamp=0;
								   
							   }
							    
						   }else{
 							 if($this->start_stoptimestamp!="0"){
								 
 									   if($gpslast_info['device_timestamp']!=""){
										   if((($to_date-$gps_data['device_timestamp'])/1000)>1800){
											   $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$gps_data['device_timestamp'],"stop");
											   
										   }else{
											   
										     $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$to_date,"stop");
										   }
											 
									   }else{
										   $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$gps_data['device_timestamp'],"stop");
									   }
									  $dom_i++;
								  
 								 $this->start_stoptimestamp=0;
								 
							 }
						   }
						   
  				     }
					 
					 
					 if($gps_data['ign_status']!="0"){
					     $this->movement_previous_timestamp=$gps_data['device_timestamp'];
 				     }
 					 
					 $this->idle_previous_timestamp=0;
					 //$this->idle_start_timestamp=$gps_data['device_timestamp'];
					 
    		     }else if($this->lattitude==$gps_data['lattitude'] && $this->lognitude==$gps_data['lognitude'] && $gps_data['speed']==0){
					 
					 
					    if($gps_data['ign_status']=="0"){
							 if($this->start_stoptimestamp==0){
								 $this->start_stoptimestamp=$gps_data['device_timestamp'];
							 }
					     } 
					 
 					 
					 if($this->speed>0){
						 
						 if($this->movement_start_timestamp!="0"){
							 
							 if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
									 
 									 if($this->previous_timestamp!=$this->movement_start_timestamp){
 									   $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$this->previous_timestamp,"Movement");
										$dom_i++; 
									 }
								 
							 }else{
							 
								   if($gps_data['ign_status']=="0"){
									   $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$this->movement_previous_timestamp,"Movement");
										$dom_i++;
								   }else{
									   $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$gps_data['device_timestamp'],"Movement");
										$dom_i++;
								   }
							 }
  							 $this->movement_start_timestamp=0;
						 }
						 
						 if($this->idle_start_timestamp==0 && $gps_data['ign_status']=="1"){
						   $this->idle_start_timestamp=$gps_data['device_timestamp'];
						  
 						 }
						 
						 
						 /* un comment it if you need one entry with same lat and log with speed 0
						 if($this->idle_start_timestamp==0){
							   $this->idle_start_timestamp=$gps_data['device_timestamp'];
						 }
						 */
						 
					 }
					 
					 
					 
					 //else{
					 
						 if($this->ignition=="1" && $this->speed=="0"){
							 if($this->movement_start_timestamp!="0"){
								 
								 
								 if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
									 
 									 if($this->previous_timestamp!=$this->movement_start_timestamp){
 									   $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$this->previous_timestamp,"Movement");
										$dom_i++; 
									 }
								 
							     }else{ 
 									 if(!isset($this->movement_previous_timestamp)){
										   $this->movement_previous_timestamp=$this->previous_timestamp;
									 }
 								     $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$this->movement_previous_timestamp,"Movement"); 
								     $dom_i++;
								 }
								 
								 $this->movement_start_timestamp=0;
								
							 }
							 if($this->idle_start_timestamp==0){
							   $this->idle_start_timestamp=$this->previous_timestamp;
							 }
						 }
						 
 
 						 
						 if($this->ignition!=$gps_data['ign_status']){ //taking idle end time as ignition off time
						 
							  if($gps_data['ign_status']=="0"){
									if($this->idle_start_timestamp!=0){ 
									   if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
										   if($this->previous_timestamp!=$this->idle_start_timestamp){
											  $this->data_prepare($vehicle_data,$this->idle_start_timestamp,$this->previous_timestamp,"Idle");
											  $dom_i++; 
										   }
										   
									   }else{
									  
										 $this->data_prepare($vehicle_data,$this->idle_start_timestamp,$gps_data['device_timestamp'],"Idle"); 
										 $dom_i++;
									   }
										 
 									   $this->idle_start_timestamp=0;
									   
									}   
									if($this->start_stoptimestamp=="0"){
									   $this->start_stoptimestamp=$gps_data['device_timestamp'];	
									}
							  }else{
								    
								   if($this->start_stoptimestamp!="0"){
									   
									   if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
									 
										   if($this->previous_timestamp!=$this->start_stoptimestamp){
											   
											   $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$this->previous_timestamp,"stop");
											   $dom_i++;
										   }
										   
									   }else{
									        $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$gps_data['device_timestamp'],"stop"); 
										    $dom_i++;
									   }
										  $this->start_stoptimestamp=0;
										
								   }
							  }
						 }
						 
						 
						  if($gps_data_key==($total_count-1) ){ ///if the idle not break,consider the last raws device time as endtime
						   
							   if( $gps_data['ign_status']=="1"){
								  if($this->idle_start_timestamp!=0){
									  
 
									  
										 if($gpslast_info['device_timestamp']!=""){
											  if((($to_date-$gps_data['device_timestamp'])/1000)>1800){
												  $this->data_prepare($vehicle_data,$this->idle_start_timestamp,$gps_data['device_timestamp'],"Idle");
											  }else{
 											      $this->data_prepare($vehicle_data,$this->idle_start_timestamp,$to_date,"Idle"); 
											   } 
										 }else{
											 
											 $this->data_prepare($vehicle_data,$this->idle_start_timestamp,$gps_data['device_timestamp'],"Idle");  
										 }
									    $dom_i++;
									   
									  
 									 $this->idle_start_timestamp=0;
									 
								   } 
							   }
							   else{
									   
								 if($this->start_stoptimestamp!="0"){
									 
									 
									 
										   if($gpslast_info['device_timestamp']!=""){
											    if((($to_date-$gps_data['device_timestamp'])/1000)>1800){
													$this->data_prepare($vehicle_data,$this->start_stoptimestamp,$gps_data['device_timestamp'],"stop");
												}else{
												   $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$to_date,"stop");
												}
										   }else{
												$this->data_prepare($vehicle_data,$this->start_stoptimestamp,$gps_data['device_timestamp'],"stop");
										   }
										    $dom_i++;
									    
 									   $this->start_stoptimestamp=0;
									  
								 }
							   }
						   
						   /*End of calculating the ignition on and off time */
						   }
						    if($gps_data['ign_status']!="0"){
 							   $this->idle_previous_timestamp=$gps_data['device_timestamp'];
						   }
					 //}
			         $this->movement_previous_timestamp=0;
					// $this->movement_start_timestamp=$gps_data['device_timestamp'];
 				 }else if($this->lattitude=="" && $this->lognitude ==""){
					 
					 
					 if($from_date < $gps_data['device_timestamp'] ){
						 
					 
						 if(($gpsrow_info['lattitude']!=$gps_data['lattitude'] || $gpsrow_info['lognitude']!=$gps_data['lognitude']) && $gpsrow_info['lognitude']!="" &&  $gpsrow_info['lognitude']!=""){
							 
							 if($gpsrow_info['ign_status']!=$gps_data['ign_status']){
								 
								 if($gps_data['ignition']=="1"){
									   if((($gps_data['device_timestamp']-$from_date)/1000)>1800){
 									   }else{
									        $this->data_prepare($vehicle_data,$from_date,$gps_data['device_timestamp'],"stop"); 
									        $dom_i++;
									   }
									   
 									 $this->movement_start_timestamp=$gps_data['device_timestamp'];
									 $this->movement_previous_timestamp=$gps_data['device_timestamp'];
									 
								 }else{
									 if((($gps_data['device_timestamp']-$from_date)/1000)>1800){
 									 }else{
									    $this->data_prepare($vehicle_data,$from_date,$gps_data['device_timestamp'],"movment"); 
										 $dom_i++;
									 }
									   $this->start_stoptimestamp=$gps_data['device_timestamp'];
									 
								 }
							 }else{
								 
								 
								 // print $gps_data['device_timestamp'];
								 if($gps_data['ign_status']=="1"){
									 
									$this->movement_start_timestamp=$from_date;
									$this->movement_previous_timestamp=$gps_data['device_timestamp'];
								 }else{
									 $this->start_stoptimestamp=$from_date;
								 }
							 }
						 }else if($gpsrow_info['lattitude']==$gps_data['lattitude'] && $gpsrow_info['lognitude']==$gps_data['lognitude']){
							 
 							 if($gpsrow_info['ign_status']!=$gps_data['ign_status']){
  								 if($gps_data['ign_status']=="1"){
									  if((($gps_data['device_timestamp']-$from_date)/1000)>1800){
									 }else{
										 $this->data_prepare($vehicle_data,$from_date,$gps_data['device_timestamp'],"stop");
										 $dom_i++;
									 }
 									  
									 $this->idle_start_timestamp=$gps_data['device_timestamp'];
									 $this->idle_previous_timestamp=$gps_data['device_timestamp'];
									 
								 }else{
									  if((($gps_data['device_timestamp']-$from_date)/1000)>1800){
									  }else{
 									    $this->data_prepare($vehicle_data,$from_date,$gps_data['device_timestamp'],"movment"); 
										$dom_i++;
									  }
									 $this->start_stoptimestamp=$gps_data['device_timestamp'];
									  $dom_i++;
								 }
 							 }else{
								 
								// print $gpsrow_info['ign_status']."!=".$gps_data['ign_status']
							 
 								   if($gps_data['ign_status']=="1"){
									  if($gps_data['speed'] >0 || $gpsrow_info['speed'] >0){
									   $this->movement_start_timestamp=$from_date;
									   $this->movement_previous_timestamp=$gps_data['device_timestamp'];
									 }else{
									   $this->idle_start_timestamp=$from_date;
									   $this->idle_previous_timestamp=$gps_data['device_timestamp'];
									 }
								   }else{
										$this->start_stoptimestamp=$from_date;
								   }
							 }
						 } 
					 }else{
						 
 						   if($gps_data['ign_status']=="1"){
							    if($gps_data['speed']>0){
									 $this->movement_start_timestamp=$gps_data['device_timestamp'];
								}
 						   }else{
 									 $this->start_stoptimestamp=$gps_data['device_timestamp'];
						   }
 					 }
 				 }else{
					 
					 if($first_ignition!=$gps_data['ign_status']){
						 
						 if($gps_data['ign_status']=="0"){
							 if($this->movement_start_timestamp!=0){ 
							 
							 
							     if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
									 
 									 if($this->previous_timestamp!=$this->movement_start_timestamp){
 									   $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$this->previous_timestamp,"Movement");
										$dom_i++; 
									 }
								 
							     }else{
							      $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$gps_data['device_timestamp'],"Movement");
								   $dom_i++;
								 }
 								   $this->movement_start_timestamp=0;
								   
							 }
							 if($this->idle_start_timestamp!=0){ 
							 
							     if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
									   if($this->previous_timestamp!=$this->idle_start_timestamp){
										  $this->data_prepare($vehicle_data,$this->idle_start_timestamp,$this->previous_timestamp,"Idle");
										  $dom_i++; 
									   }
 								 }else{
								    $this->data_prepare($vehicle_data,$this->idle_start_timestamp,$gps_data['device_timestamp'],"Idle"); 
								    $dom_i++;
								 }
 								 $this->idle_start_timestamp=0;
								 
						     } 
						     $this->start_stoptimestamp=$gps_data['device_timestamp'];
							   
						 }else{
							 if($this->start_stoptimestamp!="0"){
								 if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
									 
 									 if($this->previous_timestamp!=$this->start_stoptimestamp){
										 
										 $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$this->previous_timestamp,"stop");
										 $dom_i++;
									 }
										   
								 }else{
 								    $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$gps_data['device_timestamp'],"stop");
									 $dom_i++;
								 }
 								 $this->start_stoptimestamp=0;
								 
							 }
							 if($this->movement_start_timestamp==0){
								 $this->movement_start_timestamp=$this->previous_timestamp;
							 }
						 }
 						 
 					 }else{
						 
						 
						 if($gps_data['ign_status']=="0"){
 							 if($this->start_stoptimestamp==0 ){
								    $this->start_stoptimestamp=$gps_data['device_timestamp'];
							 }
							 if($gps_data_key==($total_count-1) ){ ///if the idle not break,consider the last raws device time as endtime
 							    
								 if($this->start_stoptimestamp!=0){
 
									 
										 if($gpslast_info['device_timestamp']!=""){
											 if((($to_date-$gps_data['device_timestamp'])/1000)>1800){
												 $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$gps_data['device_timestamp'],"Stop");  
											 }else{
												 $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$to_date,"Stop");  
											 }
											 
										 }else{
											 $this->data_prepare($vehicle_data,$this->start_stoptimestamp,$gps_data['device_timestamp'],"Stop");  
										 }
										 $dom_i++;
									 
 									 $this->start_stoptimestamp=0;
 								 } 
							    
							 }
						 }else{
							 
							  if($this->lattitude==$gps_data['lattitude'] && $this->lognitude==$gps_data['lognitude'] && $gps_data['speed']>0){
								  
								   if($this->idle_start_timestamp!=0){ 
										 if((($gps_data['device_timestamp']-$this->previous_timestamp)/1000)>1800){
											 if($this->previous_timestamp!=$this->idle_start_timestamp){
												  $this->data_prepare($vehicle_data,$this->idle_start_timestamp,$this->previous_timestamp,"Idle");
												  $dom_i++; 
											 }
										 }else{
										    $this->data_prepare($vehicle_data,$this->idle_start_timestamp,$this->idle_previous_timestamp,"Idle");
										    $dom_i++;
										 }
										 $this->idle_start_timestamp=0;
										  
								   }
								   if($this->movement_start_timestamp==0 ){
						                 $this->movement_start_timestamp=$this->previous_timestamp;
  						           }
								   if($gps_data_key==($total_count-1) ){
									   if($this->movement_start_timestamp!=0){ 
 
									   
									     if($gpslast_info['device_timestamp']!=""){
											 if((($to_date-$gps_data['device_timestamp'])/1000)>1800){
												 $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$gps_data['device_timestamp'],"Movement");
												 
											 }else{
							                    $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$to_date,"Movement");
											 }
										 }else{
											 $this->data_prepare($vehicle_data,$this->movement_start_timestamp,$gps_data['device_timestamp'],"Movement");
										 }
										  $dom_i++;
									  
 								         $this->movement_start_timestamp=0;
										 
							           }
								   }
								  
							  }else{
								  if($this->idle_start_timestamp==0 ){
						                 $this->idle_start_timestamp=$this->previous_timestamp;
  						          }
							  }
						 }
 					 }
 					 
				 }
			 /* END of calculating the running and movement time*/	 
				 
 				  
				 $this->previous_timestamp=$gps_data['device_timestamp'];
				 $this->lattitude=$gps_data['lattitude'];
				 $this->lognitude=$gps_data['lognitude']; 
     			 $this->ignition=$gps_data['ign_status'];
				 $this->speed=$gps_data['speed'];
			  }
			}
			
		 $this->response_result['draw']="1";
		 $this->response_result['recordsTotal']=$dom_i;
		 $this->response_result['recordsFiltered']="30";
 		 //print "<pre>"; print_r($this->response_result);
 		  print json_encode($this->response_result);
		
		die();	
			
			
	  }
	  
	 
	 public function device_idle_report(){
		 ini_set('memory_limit','2048M');
 		   $where=array_filter(explode(",",$this->input->post('vehicle_data')));		   
		   //$where=array(87,102,97,95);
 		   $vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
 		   $this->response_result['data']=array();
		   $dom_i="1";
		   
		   
		 
   		   foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
  			  $gpswhere_clause['vehicle_id']=$vehicle_data['id'];
  			  $gpswhere_clause['device_timestamp>=']=strtotime($this->input->post("from"))*1000;
			  $gpswhere_clause['device_timestamp<=']=strtotime($this->input->post("to"))*1000;
			  //$gpswhere_clause['device_timestamp>=']=1538143200*1000;
			  //$gpswhere_clause['device_timestamp<=']=1538229600*1000;
			  $orderby="device_timestamp asc";
  			  $gps_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,idling","vehicle_gps_information",$gpswhere_clause,"",$orderby); 
			  
  			  /* define the default variables*/
 			  $this->ignition="";
              $this->idle="";			 
              $this->timestamp=0;
  			  $this->starttimestamp=0;
 			  $this->start_idealtimestamp=0;
    		  $total_count=count($gps_info);
   			  foreach($gps_info as $gps_data_key=>$gps_data){
				 
   				if($gps_data['ign_status']=="1"){
 					if($this->idle!=$gps_data['idling']){
  		             if($gps_data['idling']==0){
						 
						 if($this->starttimestamp>0){
						   $this->data_prepare($vehicle_data,$this->starttimestamp,$gps_data['device_timestamp'],"");
 						   $this->starttimestamp=0;
						   $dom_i++;
						 }
			          }else{
						  $this->starttimestamp=$gps_data['device_timestamp'];
					  }
 					}
    			 } 
 				$this->idle=$gps_data['idling'];
			  }
			  
			  if($this->starttimestamp>0){
						   $this->data_prepare($vehicle_data,$this->starttimestamp,$gps_data['device_timestamp'],"");
 						   $this->starttimestamp=0;
						   $dom_i++;
			 }
		   }
				   
  		 $this->response_result['draw']="1";
		 $this->response_result['recordsTotal']=$dom_i;
		 $this->response_result['recordsFiltered']="30";
 		 //print "<pre>"; print_r($this->response_result);
 		 print json_encode($this->response_result);
 	  }
	 
	  //Speed alert report
	  public function speed_alert_report(){
		 ini_set('memory_limit','2048M');
 		   $where=array_filter(explode(",",$this->input->post('vehicle_data')));		   
		   //$where=array(87,102,97,95);
 		   $vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
 		   $this->response_result['data']=array();
		   $dom_i="1";
		   $geoffence_id=$this->input->post('geoffence_select');
		   $geoffence_data=$this->get_geoffence($geoffence_id);
		   
		// print "<pre>"; print_r($geoffence_id);
		 //die();
   		   foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
  			  $gpswhere_clause['vehicle_id']=$vehicle_data['id'];
  			  $gpswhere_clause['device_timestamp>=']=strtotime($this->input->post("from"))*1000;
			  $gpswhere_clause['device_timestamp<=']=strtotime($this->input->post("to"))*1000;
			  $gpswhere_clause['satelite>']='7';
			  $gpswhere_clause['speed>=']=$this->input->post("speed");
			 // $gpswhere_clause['speed>=']=60;
			 // $gpswhere_clause['device_timestamp>=']=1551083280*1000;
			 // $gpswhere_clause['device_timestamp<=']=1551601680*1000;
			  $orderby="device_timestamp asc";
  			  $gps_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status","vehicle_gps_information",$gpswhere_clause,"",$orderby); 
			  
  			  
    		  $total_count=count($gps_info);
			  
			  foreach($gps_info as $gps_data_key=>$gps_data){
				  
				$latt= $gps_data['lattitude']; 
				$logn= $gps_data['lognitude'];
		  		
			  //$response['asset_code']=$vehicle_data['asset_code'];
			  $response['name']=$vehicle_data['name'];
			  $response['description']=$vehicle_data['description'];
			  $response['group_name']=$vehicle_data['department_name'];
			  $response['time']=date("d/m/Y H:i:s a",round($gps_data['device_timestamp']/1000) );
			  $response['speed']=$gps_data['speed'];
			  $point=$latt." ".$logn;
			  $response['geofence']=$this->pointInPolygon($point,$geoffence_data);
 			  $response['lattitude']=$latt;
			  $response['lognitude']=$logn;
			  
			  if(!empty($geoffence_id)){
				   if($response['geofence']!="")
				   array_push($this->response_result['data'],$response);
			   }else{
				   array_push($this->response_result['data'],$response);
				   //print "Entered here";
			   }
			   
			  //array_push($this->response_result['data'],$response);
			 $dom_i++ ; 
			  }
		   }
				   
  		 $this->response_result['draw']="1";
		 $this->response_result['recordsTotal']=$dom_i;
		 $this->response_result['recordsFiltered']="30";
 		 //print "<pre>"; print_r($this->response_result);
 		 print json_encode($this->response_result);
 	  }
	 
 
  	 /*main summary report started */
   	  public function main_report(){
		  ini_set('memory_limit','2048M');
 		  $where=array_filter(explode(",",$this->input->post('vehicle_data')));
         // $where=array('5');
 		  $vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
		  $response_result['data']=array();
		  $dom_i="1";
		  $normal_from=strtotime($this->input->post("from"));
		  $normal_to=strtotime($this->input->post("to"));
		  $from_date=strtotime($this->input->post("from"))*1000;
		  $to_date=strtotime($this->input->post("to"))*1000;
 		  
		   /*$from_date=1550389800000;
		   $to_date=1550390700000 ;
		   $from_date=1551841200000;
		   $to_date=1551844800000; */
 		  
 		  foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
			  
			  
			  
			   $gpsrowwhere_clause['device_timestamp<']=$from_date;
 			   $gpsrowwhere_clause['vehicle_id']=$vehicle_data['id'];
  			   $roworderby="device_timestamp desc";
			   $rowlimit="1";
 			   $gpsrow_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpsrowwhere_clause,"1",$roworderby,$rowlimit);
			   
			    $first_ignition=$gpsrow_info['ign_status'];	
 			   if($gpsrow_info['satelite']<7){
				   $gpsrowwhere_clause['satelite>']="6";
 				   $gpsrow_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpsrowwhere_clause,"1",$roworderby,$rowlimit); 
			   }
			   
               $gpslastwhere_clause['device_timestamp>']=$to_date;
 			   $gpslastwhere_clause['vehicle_id']=$vehicle_data['id'];
  			   $roworderby="device_timestamp asc";
			   $rowlimit="1";
 			   $gpslast_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpslastwhere_clause,"1",$roworderby,$rowlimit);
			   
               $last_ignition=$gpslast_info['ign_status'];	
 			   if($gpslast_info['satelite']<7){
				   $gpslastwhere_clause['satelite>']="6";
				   $gpslast_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpslastwhere_clause,"1",$roworderby,$rowlimit);
 			   }
 			  
 
 			   $gpsfinalwhere_clause['vehicle_id']=$vehicle_data['id'];
			   $gpsfinalwhere_clause['lattitude>=']="24";
			   $gpsfinalwhere_clause['lattitude<=']="26";
			   $gpsfinalwhere_clause['lognitude>=']="50";
			   $gpsfinalwhere_clause['lognitude<=']="52";
			   //$gpsfinalwhere_clause['satelite>']="6";
			   $rowlimit="1";
			   $roworderby="device_timestamp desc";
			   $gpsfinal_info=$this->reports_model->db_datacheck("device_timestamp","vehicle_gps_information",$gpsfinalwhere_clause,"1",$roworderby,$rowlimit);
 
  			   
     		  $gpswhere_clause['vehicle_id']=$vehicle_data['id'];
  			  $gpswhere_clause['device_timestamp>=']=$from_date;
			  $gpswhere_clause['device_timestamp<=']=$to_date;
   			  $odometer=$this->reports_model->odometer($gpswhere_clause);//taking the inistial and final odometer

              $currentmonthwhere['vehicle_id']=$vehicle_data['id'];
  			  $currentmonthwhere['change_datetime>=']=$normal_from;
			  $currentmonthwhere['change_datetime<=']=$normal_to;
              $currentmonthodometer=$this->reports_model->db_datacheck("change_datetime,monthly_odometer,created,modified","vehicle_monthlykm",$currentmonthwhere,"1");
 
              if($currentmonthodometer!=""){
 
                     if($currentmonthodometer['modified']!=""){
                         $checktime=strtotime($currentmonthodometer['modified'])*1000;
                     }else{
                         $checktime=strtotime($currentmonthodometer['created'])*1000;
                     }                       
                     if($checktime < $to_date){

                     	  $updatedtimeododwhere['vehicle_id']=$vehicle_data['id'];
  			               $updatedtimeododwhere['device_timestamp<=']=$currentmonthodometer['change_datetime']*1000;
  			             $updatedtimeododwhere['device_timestamp>=']='1546290000000';
  			      
                          $updatedtimegpsodo=$this->reports_model->db_datacheck("odometer","vehicle_gps_information",$updatedtimeododwhere,"1","device_timestamp desc","1");   

                          //cheking the actual odometer of vehicle less than the changedatetime for fingd how many km its run from initial odomter
                          if(!empty($updatedtimegpsodo)){
                          	 
                          	 $currentmonthododiff=round((floatval($updatedtimegpsodo['odometer'])- floatval($odometer['initial_odometer'])),2);


                          	  
                          	}else{
                          		$currentmonthododiff=0;
                          	}
                         


                          $odometer['initial_odometer']=round((floatval($currentmonthodometer['monthly_odometer'])- floatval($currentmonthododiff)),2);
                     }
 
              }
     


          

              $orderby="device_timestamp asc";
			  $gps_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,odometer,unpluged,satelite","vehicle_gps_information",$gpswhere_clause,"",$orderby); 
  			  $this->lattitude="";
			  $this->lognitude="";
 			  $this->ignition="";
			  $this->unpluged="";
			  $this->timestamp=0;
			  $this->speed=0;
 			  $this->idle_start_timestamp=0;
			  $this->previous_timestamp=0;
			  $this->movement_start_timestamp=0;
 			  $this->totalworking_hrs=0;
			  $this->totalstop_hrs=0;
 			  $this->totalideal_time=0;
			  $this->totalmovement_time=0;
 			  $this->totalignitionon=0;
			  $this->totalignitionoff=0;
			  $this->totalunpluged=0;
			  $this->totalpluged=0;
			  $this->start_stoptimestamp=0;
			  $this->start_workingtimestamp=0;
			  $device_status="";
			  
 			  $ini_odometer="0";
			  $final_odometer="0";
			  $rd="1";
			  /* executing the each rows from gps tables*/
 			  $total_count=count($gps_info);
    		  foreach($gps_info as $gps_data_key=>$gps_data){
				  
				  
				  if($gps_data['satelite']<7){
   					   if($this->lattitude=="" && $this->lognitude==""){
 						   $gps_data['lattitude']=$gpsrow_info['lattitude'];
						   $gps_data['lognitude']=$gpsrow_info['lognitude'];
					   }else{
						   $gps_data['lattitude']=$this->lattitude;
						   $gps_data['lognitude']=$this->lognitude;
					   }
 				   }
				  
     		  /*calculating the total number pluged and unpluged */
			  
  				   if($this->unpluged==""){
 					   
 					  if($gps_data['unpluged']=="1"){
					     $this->totalunpluged=$this->totalunpluged+1;
				       }else{
					     $this->totalpluged=$this->totalpluged+1;
				       }
 				  }else if($this->unpluged!=$gps_data['unpluged']){
 					  if($gps_data['unpluged']=="1"){
					     $this->totalunpluged=$this->totalunpluged+1;
				       }else{
					     $this->totalpluged=$this->totalpluged+1;
				       }
 				  }
				  
				   $this->unpluged=$gps_data['unpluged']; 
				  
				  if($gps_data_key==($total_count-1)){
					   if($gps_data['unpluged']=="1"){
						   $device_status="Un pluged";
					   }else{
						   $device_status="Pluged";
					   }
 				  }
 				  
				  
		     /*END of calculating the total number pluged and unpluged */
 				 
			 /* calculating the running and movement time*/
			 
 			 
			     if(($this->lattitude!=$gps_data['lattitude'] || $this->lognitude!=$gps_data['lognitude']) && $this->lattitude!="" && $this->lognitude!="" ){
					 
   					 if($this->ignition=="1"){ 
   					   if($this->idle_start_timestamp!=0){ 
 					   
        					 $this->totalideal_time=(int)$this->totalideal_time+(int)((int)$this->idle_previous_timestamp -(int)$this->idle_start_timestamp);
							 $this->idle_start_timestamp=0;
					   }
 					   if($this->start_workingtimestamp==0){
							 $this->start_workingtimestamp=$this->previous_timestamp;
					   }
 					   if($this->movement_start_timestamp==0){
							 $this->movement_start_timestamp=$this->previous_timestamp;
					   }
  					 }else{
						 if($this->start_stoptimestamp==0){
								 $this->start_stoptimestamp=$this->previous_timestamp;
 						 }
						 
					 }
					 
					 
 					  if($gps_data['ign_status']=="0"){
							 if($this->start_stoptimestamp==0){
								 $this->start_stoptimestamp=$gps_data['device_timestamp'];
 							 }
					  } 
					 
   					 if($this->ignition!=$gps_data['ign_status']){
						 
 						if($gps_data['ign_status']=="0"){
							
  							 if($this->movement_start_timestamp!=0){
 							   $this->totalmovement_time=(int)$this->totalmovement_time+((int)$gps_data['device_timestamp'] -(int)$this->movement_start_timestamp);
							   $this->movement_start_timestamp=0;
 							 }
 							if($this->start_workingtimestamp!="0"){
   								 $this->totalworking_hrs=(int)$this->totalworking_hrs+(int)($gps_data['device_timestamp']-(int)$this->start_workingtimestamp);
								 $this->start_workingtimestamp=0;
							 }
							 $this->totalignitionoff=$this->totalignitionoff+1;
							 $this->start_stoptimestamp=$gps_data['device_timestamp'];
 						   
						}else{
  							if($this->start_stoptimestamp!="0"){
								   $this->totalstop_hrs=$this->totalstop_hrs+((int)$gps_data['device_timestamp']-(int)$this->start_stoptimestamp);
								   $this->start_stoptimestamp=0;
							 }
							 $this->totalignitionon=$this->totalignitionon+1;
							 $this->start_workingtimestamp=$gps_data['device_timestamp'];
							 if($this->movement_start_timestamp==0){
							     $this->movement_start_timestamp=$gps_data['device_timestamp'];
					         }
						}
 						
 					 }
					 
 					 if($gps_data_key==($total_count-1)){
						 
  					      if($gps_data['ign_status']=="1"){
 							  if($this->movement_start_timestamp!=0){ 
 							  
							      if($gpslast_info['device_timestamp']!=""){
 								      $this->totalmovement_time=(int)$this->totalmovement_time+((int)$to_date -(int)$this->movement_start_timestamp);
								  }else{
									  $this->totalmovement_time=(int)$this->totalmovement_time+((int)$gps_data['device_timestamp'] -(int)$this->movement_start_timestamp);
								  }
								   $this->movement_start_timestamp=0;
							   }
							   if($this->start_workingtimestamp!="0"){
								   if($gpslast_info['device_timestamp']!=""){
 								      $this->totalworking_hrs=(int)$this->totalworking_hrs+(int)($to_date-(int)$this->start_workingtimestamp);
								   }else{
									  $this->totalworking_hrs=(int)$this->totalworking_hrs+(int)($gps_data['device_timestamp']-(int)$this->start_workingtimestamp);
								   }
								   $this->start_workingtimestamp=0;
							   }
						   }else{
 								   
							 if($this->start_stoptimestamp!="0"){
 								 
								 $this->totalstop_hrs=$this->totalstop_hrs+((int)$to_date-(int)$this->start_stoptimestamp);
								 $this->start_stoptimestamp=0;
							 }
						   }
						   
  				     } 
					 
					 if($gps_data['ign_status']!="0"){
 					    $this->movement_previous_timestamp=$gps_data['device_timestamp'];
					 }
					  $this->idle_previous_timestamp=0;
 					 
    		     }else if($this->lattitude==$gps_data['lattitude'] && $this->lognitude==$gps_data['lognitude'] && $gps_data['speed']==0){
					 
					 
 					     if($gps_data['ign_status']=="0"){
							 if($this->start_stoptimestamp==0){
								 $this->start_stoptimestamp=$gps_data['device_timestamp'];
								
							 
							 }
					     } 
						 
  					 
					 if($this->speed>0){
  						 
						if($this->movement_start_timestamp!=0){
							
 							if($gps_data['ign_status']=="0"){
								$this->totalmovement_time=(int)$this->totalmovement_time+((int)$this->movement_previous_timestamp  -(int)$this->movement_start_timestamp);
 							}else{
								$this->totalmovement_time=(int)$this->totalmovement_time+((int)$gps_data['device_timestamp'] -(int)$this->movement_start_timestamp);
 							}
  							 $this->movement_start_timestamp=0;
						 }
						 
  						 /* un comment it if you need one entry with same lat and log with speed 0*/
						 
						 
						 if($this->idle_start_timestamp==0 && $gps_data['ign_status']=="1"){
						   $this->idle_start_timestamp=$gps_data['device_timestamp'];
						  
 						 }
 					 }
 						 if($this->ignition=="1"){
							 
							 
						 
						       if($this->start_workingtimestamp==0){
							     $this->start_workingtimestamp=$this->previous_timestamp;
					          }
						   
							 
							 
							 if($this->movement_start_timestamp!="0"){
								 
								 if(!isset($this->movement_previous_timestamp)){
  									 $this->movement_previous_timestamp=$this->previous_timestamp;
  								 }
 								   //print $this->movement_previous_timestamp." -".$this->movement_start_timestamp."=".($this->movement_previous_timestamp -$this->movement_start_timestamp)."movement status 4 <br/>";
 								 $this->totalmovement_time=(int)$this->totalmovement_time+((int)$this->movement_previous_timestamp -(int)$this->movement_start_timestamp);
								 $this->movement_start_timestamp=0;
  						       
 							 }
 							// print $this->idle_start_timestamp."<br/>";
  							 if($this->idle_start_timestamp==0){
							   $this->idle_start_timestamp=$this->previous_timestamp;
							 }
 						 }
 						
						 
						 if($this->ignition!=$gps_data['ign_status']){ //taking idle end time as ignition off time
						 
 							  if($gps_data['ign_status']=="0"){
								  
 								 if($this->idle_start_timestamp!=0){ 
								 
								 
 							         $this->totalideal_time=(int)$this->totalideal_time+(int)((int)$gps_data['device_timestamp'] -(int)$this->idle_start_timestamp);
									   $this->idle_start_timestamp=0;
									} 
									
 									if($this->start_workingtimestamp!="0"){
 										 
										  
										 $this->totalworking_hrs=(int)$this->totalworking_hrs+(int)($gps_data['device_timestamp']-(int)$this->start_workingtimestamp);
										   $this->start_workingtimestamp=0;
									}
									$this->totalignitionoff=$this->totalignitionoff+1;
									$this->start_stoptimestamp=$gps_data['device_timestamp'];							
							  }else{
 								   if($this->start_stoptimestamp!="0"){
										 $this->totalstop_hrs=$this->totalstop_hrs+((int)$gps_data['device_timestamp']-(int)$this->start_stoptimestamp);
										 $this->start_stoptimestamp=0;
								   }
								   $this->totalignitionon=$this->totalignitionon+1;
								   $this->start_workingtimestamp=$gps_data['device_timestamp'];
							  }
						 }  
						 
						  if($gps_data_key==($total_count-1) ){ ///if the idle not break,consider the last raws device time as endtime
 						   
							   if($gps_data['ign_status']=="1"){
								   
 								   if($this->idle_start_timestamp!=0){ 
								      if($gpslast_info['device_timestamp']!=""){
  									      $this->totalideal_time=(int)$this->totalideal_time+(int)((int)$to_date -(int)$this->idle_start_timestamp);
									  }else{
										  $this->totalideal_time=(int)$this->totalideal_time+(int)((int)$gps_data['device_timestamp'] -(int)$this->idle_start_timestamp);
									  }
									 $this->idle_start_timestamp=0;
								   } 
	 
								   if($this->start_workingtimestamp!="0"){
									  if($gpslast_info['device_timestamp']!=""){  
 									      $this->totalworking_hrs=(int)$this->totalworking_hrs+(int)((int)$to_date-(int)$this->start_workingtimestamp);
									  }else{
										   $this->totalworking_hrs=(int)$this->totalworking_hrs+(int)((int)$gps_data['device_timestamp']-(int)$this->start_workingtimestamp);
									  }
									   $this->start_workingtimestamp=0;
								   }
								   
							   }
							   else{
 									   
								 if($this->start_stoptimestamp!="0"){
									 $this->totalstop_hrs=$this->totalstop_hrs+((int)$to_date-(int)$this->start_stoptimestamp);
									 $this->start_stoptimestamp=0;
								 }
							   }
						   
						   /*End of calculating the ignition on and off time */
						   }
						   if($gps_data['ign_status']!="0"){
							   $this->idle_previous_timestamp=$gps_data['device_timestamp'];
						   }
  			         $this->movement_previous_timestamp=0;
  				 }else if($this->lattitude=="" && $this->lognitude =="" ){
 					 if($from_date < $gps_data['device_timestamp']){
    					     if(($gpsrow_info['lattitude']!=$gps_data['lattitude'] || $gpsrow_info['lognitude']!=$gps_data['lognitude']) && $gpsrow_info['lognitude']!="" &&  $gpsrow_info['lognitude']!=""){
							 
							 
							 
								 if($first_ignition!=$gps_data['ign_status']){
									 
									 $this->totalignitionoff=$this->totalignitionoff+1; 
									 $this->totalignitionon=$this->totalignitionon+1;   
									 
									 if($gps_data['ign_status']=="1"){
										 $this->totalstop_hrs=$this->totalstop_hrs+((int)$gps_data['device_timestamp']-(int)$from_date);
										 $this->start_workingtimestamp=$gps_data['device_timestamp'];
										 $this->movement_start_timestamp=$gps_data['device_timestamp'];
										 $this->movement_previous_timestamp=$gps_data['device_timestamp'];
 										 
									 }else{
 										  $this->totalworking_hrs=$this->totalworking_hrs+((int)$gps_data['device_timestamp']-(int)$from_date);
										  $this->start_stoptimestamp=$gps_data['device_timestamp'];
										  $this->totalmovement_time=(int)$this->totalmovement_time+((int)$gps_data['device_timestamp']-(int)$from_date);
									 }
									 
									 
								 }else{
									 
 									 if($gps_data['ign_status']=="1"){
										 
										  $this->start_workingtimestamp=$from_date;
										  $this->movement_start_timestamp=$from_date;
										  $this->totalignitionon=$this->totalignitionon+1;
										  $this->movement_previous_timestamp=$gps_data['device_timestamp'];
									 }else{
										  $this->start_stoptimestamp=$from_date;
										  $this->totalignitionoff=$this->totalignitionoff+1; 
									 }
 								}
 						 }else if($gpsrow_info['lattitude']==$gps_data['lattitude'] && $gpsrow_info['lognitude']==$gps_data['lognitude']){
							 
							  
							 
 							 if($gpsrow_info['ign_status']!=$gps_data['ign_status']){
								 
								 $this->totalignitionoff=$this->totalignitionoff+1; 
								 $this->totalignitionon=$this->totalignitionon+1;   
 								 if($gps_data['ign_status']=="1"){
   								     $this->totalstop_hrs=$this->totalstop_hrs+((int)$gps_data['device_timestamp']-(int)$from_date);
 							         $this->start_workingtimestamp=$gps_data['device_timestamp'];
									 $this->idle_start_timestamp=$gps_data['device_timestamp'];
									 $this->idle_previous_timestamp=$gps_data['device_timestamp'];
									 
								 }else{
  									  $this->totalworking_hrs=$this->totalworking_hrs+((int)$gps_data['device_timestamp']-(int)$from_date);
									  $this->start_stoptimestamp=$gps_data['device_timestamp'];
									  $this->totalideal_time=(int)$this->totalideal_time+((int)$gps_data['device_timestamp']-(int)$from_date);
								 }
							 }else{
								 
								 if($gps_data['ign_status']=="1"){
									 
									  if($gps_data['speed'] >0 || $gpsrow_info['speed'] >0){
									    $this->movement_start_timestamp=$from_date;
									    $this->movement_previous_timestamp=$gps_data['device_timestamp'];
									  }else{
									    $this->idle_start_timestamp=$from_date;
									    $this->idle_previous_timestamp=$gps_data['device_timestamp'];
									  }
 									    $this->start_workingtimestamp=$from_date;
									  
									   
 									  $this->totalignitionon=$this->totalignitionon+1;
 									  
								 }else{
  									  $this->start_stoptimestamp=$from_date;
									  $this->totalignitionoff=$this->totalignitionoff+1; 
 								 }
 							 }
						 }else if( $gpsrow_info['lognitude']=="" &&  $gpsrow_info['lognitude']==""){
							 if($gps_data['ign_status']=="1"){
								  $this->totalignitionon=$this->totalignitionon+1;   
							 }else{
								  $this->totalignitionoff=$this->totalignitionoff+1; 
							 }
						 }
					 }else{
						 
 						   if($gps_data['ign_status']=="1"){
							    if($gps_data['speed']>0){
									 $this->movement_start_timestamp=$gps_data['device_timestamp'];
								}
									 $this->start_workingtimestamp=$gps_data['device_timestamp'];
									 $this->totalignitionon=$this->totalignitionon+1;
						   }else{
									 $this->totalignitionoff=$this->totalignitionoff+1;
									 $this->start_stoptimestamp=$gps_data['device_timestamp'];
						   }
 					 }
					 
 				 }else{
					 
					 if($this->ignition!=$gps_data['ign_status']){ //taking idle end time as ignition off time
						 
  							  if($gps_data['ign_status']=="0"){
  								 if($this->movement_start_timestamp!="0"){
 								   $this->totalmovement_time=(int)$this->totalmovement_time+((int)$gps_data['device_timestamp'] -(int)$this->movement_start_timestamp);
								   $this->movement_start_timestamp=0;
  							   }
  								    if($this->idle_start_timestamp!=0){ 
 							         $this->totalideal_time=(int)$this->totalideal_time+(int)((int)$gps_data['device_timestamp'] -(int)$this->idle_start_timestamp);
									   $this->idle_start_timestamp=0;
									} 
 									
 									if($this->start_workingtimestamp!="0"){
 											$this->totalworking_hrs=(int)$this->totalworking_hrs+(int)($gps_data['device_timestamp']-(int)$this->start_workingtimestamp);
										   $this->start_workingtimestamp=0;
									}
									$this->totalignitionoff=$this->totalignitionoff+1;
									$this->start_stoptimestamp=$gps_data['device_timestamp'];							
							  }else{
								   //$this->idle_start_timestamp=$gps_data['device_timestamp'];
								   if($this->start_stoptimestamp!="0"){
										 $this->totalstop_hrs=$this->totalstop_hrs+((int)$gps_data['device_timestamp']-(int)$this->start_stoptimestamp);
										 $this->start_stoptimestamp=0;
								   }
								   $this->totalignitionon=$this->totalignitionon+1;
								   $this->start_workingtimestamp=$gps_data['device_timestamp'];
							  }
						 }else{
							 
							 
							// print $gps_data['device_timestamp']."<br/>";
							 if($gps_data['ign_status']=="0"){
								 if($this->start_stoptimestamp==0 ){
								    $this->start_stoptimestamp=$gps_data['device_timestamp'];
								 }
								 if($gps_data_key==($total_count-1) ){ 
								     if($this->start_stoptimestamp!="0"){
										 if($gpslast_info['device_timestamp']!=""){
									        $this->totalstop_hrs=$this->totalstop_hrs+((int)$to_date-(int)$this->start_stoptimestamp);
										 }else{
											$this->totalstop_hrs=$this->totalstop_hrs+((int)$gps_data['device_timestamp']-(int)$this->start_stoptimestamp);
										 }
									    $this->start_stoptimestamp=0;
								     }
								 }
 							 }else{
								 
								 
								 if($this->lattitude==$gps_data['lattitude'] && $this->lognitude==$gps_data['lognitude'] && $gps_data['speed']>0){
									 
									 
										 if($this->idle_start_timestamp!=0){ 
 									      $this->totalideal_time=(int)$this->totalideal_time+(int)((int)$this->idle_previous_timestamp -(int)$this->idle_start_timestamp);
									      $this->idle_start_timestamp=0;
								        }  
									 
 									 if($this->movement_start_timestamp==0 ){
						                 $this->movement_start_timestamp=$this->previous_timestamp;
						  
 						             } 
								     if($gps_data_key==($total_count-1) ){ 
									 
									     if($this->movement_start_timestamp!=0){ 
										   if($gpslast_info['device_timestamp']!=""){
										        $this->totalmovement_time=(int)$this->totalmovement_time+((int)$to_date -(int)$this->movement_start_timestamp);
										   }else{
											    $this->totalmovement_time=(int)$this->totalmovement_time+((int)$gps_data['device_timestamp'] -(int)$this->movement_start_timestamp);
										   }
 									        $this->movement_start_timestamp=0;
								         } 
	 
								         if($this->start_workingtimestamp!="0"){
									        if($gpslast_info['device_timestamp']!=""){
									           $this->totalworking_hrs=(int)$this->totalworking_hrs+(int)((int)$to_date-(int)$this->start_workingtimestamp);
											}else{
											   $this->totalworking_hrs=(int)$this->totalworking_hrs+(int)((int)$gps_data['device_timestamp']-(int)$this->start_workingtimestamp);
											}
									        $this->start_workingtimestamp=0;
								         }
									   
									 }
 								 }else{
									 if($this->idle_start_timestamp==0 ){
						                 $this->idle_start_timestamp=$this->previous_timestamp;
  						              }
								 }
								 
							 }
							 
						 }
 				 }
			 /* END of calculating the running and movement time*/	 
				 
 				 $this->previous_timestamp=$gps_data['device_timestamp'];
				 $this->lattitude=$gps_data['lattitude'];
				 $this->lognitude=$gps_data['lognitude']; 
     			 $this->ignition=$gps_data['ign_status'];
				  $this->speed=$gps_data['speed'];
 				 $rd++;
   			  }
 			  
			  
			 //print $this->totalmovement_time; 
			   $second = 1;
               $minute = 60*$second;
               $hour   = 60*$minute;
			   $this->totalworking_hrs = round(($this->totalworking_hrs)/1000);
			   $this->totalstop_hrs = round(($this->totalstop_hrs)/1000);
			   $this->totalideal_time = round(($this->totalideal_time)/1000);
			   $this->totalmovement_time = round(($this->totalmovement_time)/1000);
 			   $working_hrs   = floor(($this->totalworking_hrs)/$hour)<10?"0".floor(($this->totalworking_hrs)/$hour):floor(($this->totalworking_hrs)/$hour);
               $working_min = floor(($this->totalworking_hrs%$hour)/$minute)<10?"0".floor(($this->totalworking_hrs%$hour)/$minute):floor(($this->totalworking_hrs%$hour)/$minute);
               $working_sec = floor((($this->totalworking_hrs%$hour)%$minute)/$second)<10?"0".floor((($this->totalworking_hrs%$hour)%$minute)/$second):floor((($this->totalworking_hrs%$hour)%$minute)/$second);
			   
			   $stop_hrs   = floor(($this->totalstop_hrs)/$hour)<10?"0".floor(($this->totalstop_hrs)/$hour):floor(($this->totalstop_hrs)/$hour);
               $stop_min = floor(($this->totalstop_hrs%$hour)/$minute)<10?"0".floor(($this->totalstop_hrs%$hour)/$minute):floor(($this->totalstop_hrs%$hour)/$minute);
               $stop_sec = floor((($this->totalstop_hrs%$hour)%$minute)/$second)<10?"0".floor((($this->totalstop_hrs%$hour)%$minute)/$second):floor((($this->totalstop_hrs%$hour)%$minute)/$second);
			   
			   
			   $idle_hrs   = floor(($this->totalideal_time)/$hour)<10?"0".floor(($this->totalideal_time)/$hour):floor(($this->totalideal_time)/$hour);
               $idle_min = floor(($this->totalideal_time%$hour)/$minute)<10?"0".floor(($this->totalideal_time%$hour)/$minute):floor(($this->totalideal_time%$hour)/$minute);
               $idle_sec = floor((($this->totalideal_time%$hour)%$minute)/$second)<10?"0".floor((($this->totalideal_time%$hour)%$minute)/$second):floor((($this->totalideal_time%$hour)%$minute)/$second);
			   
			   
			   
			   $move_hrs   = floor(($this->totalmovement_time)/$hour)<10?"0".floor(($this->totalmovement_time)/$hour):floor(($this->totalmovement_time)/$hour);
               $move_min = floor(($this->totalmovement_time%$hour)/$minute)<10?"0".floor(($this->totalmovement_time%$hour)/$minute):floor(($this->totalmovement_time%$hour)/$minute);
               $move_sec = floor((($this->totalmovement_time%$hour)%$minute)/$second)<10?"0".floor((($this->totalmovement_time%$hour)%$minute)/$second):floor((($this->totalmovement_time%$hour)%$minute)/$second);
			   
			   
 			  $response=array();
 			  $response['asset_code']=$vehicle_data['asset_code'];
			  $response['name']=$vehicle_data['name'];
			  $response['description']=$vehicle_data['description'];
			  $response['group_name']=$vehicle_data['department_name'];
 			  $response['total_odometer']=round((floatval($odometer['final_odometer'])-floatval($odometer['initial_odometer'])),2);
 			  $response['last_odometer']=round((floatval($odometer['final_odometer'])),2);
			  $response['total_workinghrs']=$working_hrs.":".$working_min.":".$working_sec;
 			  $response['total_stophrs']=$stop_hrs.":".$stop_min.":".$stop_sec;
			  $response['total_idletime']=$idle_hrs.":".$idle_min.":".$idle_sec;
			  $response['total_running']=$move_hrs.":".$move_min.":".$move_sec;
			  $response['totalignitionoff']=$this->totalignitionoff;
		      $response['totalignitionon']=$this->totalignitionon;
			  $response['totalunpluged']=$this->totalunpluged;
			  $response['totalpluged']=$this->totalpluged;
			  $response['device_status']=$device_status;
			  if($gpsfinal_info['device_timestamp']>0){
			     $response['device_time']=date("d-m-Y H:i A",round(($gpsfinal_info['device_timestamp']/1000),0));
			  }else{
				   $response['device_time']="No Data";
			  }
 			  
			   
			  array_push($response_result['data'],$response);
			  $dom_i++; 
			  
  		  }
		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
  		 print json_encode($response_result);
		 
		   
		  //print "<pre>"; print_r($response_result);
 		  die();
	 }
	 
	 /*main summary report end */
	 
	 
	public function get_history_map(){
			ini_set('memory_limit','2048M');
		  //$start_timestamp="1526783856";
		  //$end_timestamp="1526784297";
		  $start_timestamp=strtotime($this->input->post("from"))*1000;
		  $end_timestamp=strtotime($this->input->post("to"))*1000;
 		  $vehicle_id=$this->input->post("vehicleid");
 		  $where_gps['device_timestamp>=']=$start_timestamp;
		  $where_gps['device_timestamp<=']=$end_timestamp;
 		  $where_gps['vehicle_id']=$vehicle_id;
		  $whereexternal_gps['vd.id']=$vehicle_id;
		  $orderby="device_timestamp asc";
		  $response['error']="0";
 		  
		  $response['gps_cordinate']= $this->reports_model->db_datacheck("id,odometer,lattitude,lognitude,from_unixtime(round((device_timestamp/1000)), '%Y-%m-%d %H:%i:%s') as time,speed,ign_status,device_timestamp,Heading,unpluged,created","vehicle_gps_information",$where_gps,"",$orderby);
		  
 		  $response['vehicle_external']=$this->reports_model->vehicle_external_details($whereexternal_gps);
		  
		  
 		  if(count($response['gps_cordinate'])<1){
			  
			  $response['error']="1";
			  $response['error_msg']="NO Data";
		  }
		  
  		  print json_encode($response);
      }

      // track button in exceed idle 
      public function track_exceed_idle_map(){
		  $vehicle_id=$this->input->post("vehicle_id");		  
		  $response['error']="0";
		  $gps_coordinates= $this->reports_model->idle_track_data($vehicle_id);
  		  if(count($gps_coordinates)<1){			  
			  $response['error']="1";
			  $response['error_msg']="No Data";
		  }else{
			  $response['gps_coordinates']=$gps_coordinates;
			  }
   		  print json_encode($response);
 	  }

      // Geofence To Geoffence update

      public function track_in_map(){
		  $vehicle_id=$this->input->post("vehicle_id");
		  $primary_ids=explode(",",$this->input->post("primary_id"));
		  
		 // print "<pre>"; print_r($primary_ids);
		  $where_gps['id>=']=$primary_ids[0];
		  $where_gps['id<=']=$primary_ids[1];
		  $where_gps['vehicle_id']=$vehicle_id;
		  $whereexternal_gps['vd.id']=$vehicle_id;
		  $orderby="device_timestamp asc";
		  $response['error']="0";
		  $response['gps_cordinate']= $this->reports_model->db_datacheck("id,odometer,lattitude,lognitude,from_unixtime(round((device_timestamp/1000)), '%Y-%m-%d %H:%i:%s') as time,speed,ign_status,device_timestamp,Heading,unpluged,created","vehicle_gps_information",$where_gps,"",$orderby);
  		  $response['vehicle_external']=$this->reports_model->vehicle_external_details($whereexternal_gps);
  		  if(count($response['gps_cordinate'])<1){
			  
			  $response['error']="1";
			  $response['error_msg']="NO Data";
		  }
   		  print json_encode($response);
 	  }
	
	  // Geofence To Geoffence update
  
	  
	  public function get_map_playback(){
 			ini_set('memory_limit','2048M');
		  $start_timestamp=strtotime($this->input->post("from"))*1000;
		  $end_timestamp=strtotime($this->input->post("to"))*1000;
 		  $vehicle_id=$this->input->post("vehicle");
		  $where_clause['vd.id']=$vehicle_id ;
		  //$where_clause['vd.id']="87";
		  $vehicle_data=$this->reports_model->vehicle_external_details($where_clause);
		  
		  
		  
		  
		  
 		 /*$where_fulldata['id']=$vehicle_id;
  		  $where_fulldata['device_timestamp>=']=strtotime($this->input->post("from"))*1000;
		  $where_fulldata['device_timestamp<=']=strtotime($this->input->post("to"))*1000;
		  */
		  
 		  $where_fulldata['vgi.vehicle_id']=$vehicle_id ;
  		  $where_fulldata['vgi.device_timestamp>=']=$start_timestamp;
		  $where_fulldata['vgi.device_timestamp<=']=$end_timestamp;		  
    	  $full_datas= $this->reports_model->gps_lastrows($where_fulldata);
		  $total=count($full_datas);
 		  if($total>0){
  			 foreach($full_datas as $finalkey => $finaldatas){
   					$vehicle_fulldata[$finalkey]['name']=$vehicle_data['name'];
					$vehicle_fulldata[$finalkey]['description']=$vehicle_data['description'];
					$vehicle_fulldata[$finalkey]['run']=$vehicle_data['run'];
					$vehicle_fulldata[$finalkey]['idle']=$vehicle_data['idle'];
					$vehicle_fulldata[$finalkey]['stop']=$vehicle_data['stop'];
					$vehicle_fulldata[$finalkey]['group_name']=$vehicle_data['department_name'];
					$vehicle_fulldata[$finalkey]['drivername']=$vehicle_data['drivername'];
					$vehicle_fulldata[$finalkey]['driverphone']=$vehicle_data['driverphone'];					
					$vehicle_fulldata[$finalkey]['ign_status']=$finaldatas['ign_status']=="1"?"ON":"OFF";
					$vehicle_fulldata[$finalkey]['speed']=$finaldatas['speed'];
					$vehicle_fulldata[$finalkey]['created']=date("d-m-Y h:i:s a", strtotime($finaldatas['created']));
					$vehicle_fulldata[$finalkey]['odometer']=$finaldatas['odometer'];
					$vehicle_fulldata[$finalkey]['manual_odometer']=$finaldatas['manual_odometer'];
					$vehicle_fulldata[$finalkey]['lat']=$finaldatas['lattitude'];
					$vehicle_fulldata[$finalkey]['logn']=$finaldatas['lognitude'];
					$vehicle_fulldata[$finalkey]['Heading']=$finaldatas['Heading'];
					$vehicle_fulldata[$finalkey]['device_timestamp']=date("d-m-Y h:i:s a", (round($finaldatas['device_timestamp']/1000)));
					$vehicle_fulldata[$finalkey]['gps_status']=$finaldatas['unpluged']=="0"?"FIXED":"NOT FIXED"; 
					
					if($finaldatas['vehicle_status']=="0"){
						$vehicle_fulldata[$finalkey]['label']="Running Time";
						
						$total_stophrs=round(($finaldatas['end_time']-$finaldatas['start_time'])/1000);
						//console.log($total_stophrs);
 						$second = 1;
                        $minute = 60*$second;
                        $hour   = 60*$minute;
				        $stop_hrs   = floor(($total_stophrs)/$hour)<10?"0".floor(($total_stophrs)/$hour):floor(($total_stophrs)/$hour);
                        $stop_min = floor(($total_stophrs%$hour)/$minute)<10?"0".floor(($total_stophrs%$hour)/$minute):floor(($total_stophrs%$hour)/$minute);
                        $stop_sec = floor((($total_stophrs%$hour)%$minute)/$second)<10?"0".floor((($total_stophrs%$hour)%$minute)/$second):floor((($total_stophrs%$hour)%$minute)/$second); 
						
						
  			 	        $vehicle_fulldata[$finalkey]['duration']=$stop_hrs.":".$stop_min.":".$stop_sec;
						
 						
					}else if($finaldatas['vehicle_status']=="1"){
						 
						$vehicle_fulldata[$finalkey]['label']="Idle Time";
						$total_stophrs=round(($finaldatas['end_time']-$finaldatas['start_time'])/1000);
 						$second = 1;
                        $minute = 60*$second;
                        $hour   = 60*$minute;
				        $stop_hrs   = floor(($total_stophrs)/$hour)<10?"0".floor(($total_stophrs)/$hour):floor(($total_stophrs)/$hour);
                        $stop_min = floor(($total_stophrs%$hour)/$minute)<10?"0".floor(($total_stophrs%$hour)/$minute):floor(($total_stophrs%$hour)/$minute);
                        $stop_sec = floor((($total_stophrs%$hour)%$minute)/$second)<10?"0".floor((($total_stophrs%$hour)%$minute)/$second):floor((($total_stophrs%$hour)%$minute)/$second); 
						
						
  			 	        $vehicle_fulldata[$finalkey]['duration']=$stop_hrs.":".$stop_min.":".$stop_sec;
						
					}
					else if($finaldatas['vehicle_status']=="2"){
					 
						$vehicle_fulldata[$finalkey]['label']="Stop Time";
						$total_stophrs=round(($finaldatas['end_time']-$finaldatas['start_time'])/1000);
 						$second = 1;
                        $minute = 60*$second;
                        $hour   = 60*$minute;
				        $stop_hrs   = floor(($total_stophrs)/$hour)<10?"0".floor(($total_stophrs)/$hour):floor(($total_stophrs)/$hour);
                        $stop_min = floor(($total_stophrs%$hour)/$minute)<10?"0".floor(($total_stophrs%$hour)/$minute):floor(($total_stophrs%$hour)/$minute);
                        $stop_sec = floor((($total_stophrs%$hour)%$minute)/$second)<10?"0".floor((($total_stophrs%$hour)%$minute)/$second):floor((($total_stophrs%$hour)%$minute)/$second); 
						
						
  			 	        $vehicle_fulldata[$finalkey]['duration']=$stop_hrs.":".$stop_min.":".$stop_sec;
					}
					 	
   			 }
		  }else{
			  $vehicle_fulldata['error']="1";
			  $vehicle_fulldata['error_msg']="NO Data";
			  }
		  
   		  print json_encode( $vehicle_fulldata);
 		  die();
 		  
		  }  
	 
	 public function alert_report(){
		 ini_set('memory_limit','2048M');
		 $response_result['data']=array();
		 $where_typein=array();
  		 $hash_break=$this->input->post("hash_break");
		 $high_acceleration=$this->input->post("high_acceleration");
		 $Geoffence=$this->input->post("Geoffence");
		 $seleceted_geoffence=$this->input->post('geoffence_select');
		// $hash_break=1;
		 //$high_acceleration=1;
		// $Geoffence=1;
  		 //$where['device_timestamp>=']=1535788800000;
		 //$where['device_timestamp<=']=1538294400000;
		 
		 $where_in=array_filter(explode(",",$this->input->post('vehicle_data')));
		 //$where_typein=array('1','2','3','4');
		//$where_in=array('87','97');
		  $where['va.device_timestamp>=']=strtotime($this->input->post("from"))*1000;
		  $where['va.device_timestamp<=']=strtotime($this->input->post("to"))*1000;
		 if($hash_break=="1"){
			 array_push($where_typein,"1");
			 
		 }
		 if($high_acceleration=="1"){
			 array_push($where_typein,"2");
		 }
		 if($Geoffence=="1"){
			 array_push($where_typein,"3");
			 array_push($where_typein,"4");
			 array_push($where_typein,"5");
		 }
		 $where_geoffence_in="";
		 
		 $where_geoffence_in=$seleceted_geoffence;
		 
		/* if(!empty($geoffence_id)){
				   if($response['geofence']!="")
				   array_push($this->response_result['data'],$response);
			   }else{
				   array_push($this->response_result['data'],$response);
			   }*/
		 
		 
		 
		 $vehiclealertfulldata= $this->reports_model->multiple_alert_data($where_in,$where,$where_typein,$where_geoffence_in);
		 //print "<pre>"; print_r($vehiclealertfulldata);
		 //die();
		 $dom_i=1;
		  foreach($vehiclealertfulldata as $vehicle_key=>$vehiclealertdata){
			  
  			  if($vehiclealertdata['type']=="1"){
				  $alert_type="Hash Breaking";
 			  }else if($vehiclealertdata['type']=="2"){
				  $alert_type="High Acceleration";
 			  }else if($vehiclealertdata['type']=="3"){
				  $alert_type="Geoffence In";
 			  }
			  else if($vehiclealertdata['type']=="4"){
				   $alert_type="Geoffence Out";
 			  }
			  else if($vehiclealertdata['type']=="5"){
				  $alert_type="Geoffence Speed";
			  }
			  
			  $response['asset_code']=$vehiclealertdata['asset_code'];
			  $response['name']=$vehiclealertdata['name'];
			  $response['description']=$vehiclealertdata['description'];
			  $response['group_name']=$vehiclealertdata['group_name'];
			  $response['Alert_type']=$alert_type;
			  $response['time']=date("d/m/Y H:i:s a",round($vehiclealertdata['device_timestamp']/1000) );
 			  $response['geoffence']=$vehiclealertdata['geoffence'];
			  array_push($response_result['data'],$response);
			 $dom_i++ ;  
		  }
		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
 		  //print "<pre>"; print_r($response_result);
 		   print json_encode($response_result);
		 
	 }
	  
	 public function maintanance_report(){
		 ini_set('memory_limit','2048M');
		 $where=array_filter(explode(",",$this->input->post('vehicle_data')));
		 //$where=array('10');
 		 $vehicle_maintanance_report= $this->reports_model->vehicle_maintanace_data($where);
		 $dom_i=count($vehicle_maintanance_report);
 		 
		 $response_result['data']=array();
 		 foreach($vehicle_maintanance_report as $vehicle_key => $vehicle_data){
			  $exeed_action="";
			  $mainatanance=array();
			  
			  if($vehicle_data['oil_change']!=""){
				  $date = date('m/d/y');
  			      $diffrence_month=(int)abs((strtotime(date("m/d/y",strtotime($date." +1 month"))) - $vehicle_data['oil_change'])/(60*60*24*30));
 				  if($vehicle_data['maintanance_month']<$diffrence_month){
					 $exeed_action="Date Exceeded";
				  }
			  }
			  
 			  if($exeed_action==""){
				 $where_odo['vehicle_id']=$vehicle_data['id'];
 			     $current_dodmeter=$this->reports_model->final_odometer_read($where_odo);
  				 if($current_dodmeter['final_odometer']!=""){
 					 $oilchange_odo= $vehicle_data['prev_oil_change']+ $vehicle_data['maintanance_km'];
  					 if($oilchange_odo<$current_dodmeter['final_odometer']){
 						 $exeed_action="KM Exceeded";
 					 }
 				 }
 			  }
			  
			  
  			 if($exeed_action!=""){
 				 $mainatanance['asset_code']=$vehicle_data["asset_code"];
				 $mainatanance['name']=$vehicle_data['name'];
 				 $mainatanance['description']=$vehicle_data["description"];
				 $mainatanance['prev_oil_change']=$vehicle_data["prev_oil_change"];
				 // $mainatanance['oil_change']=$vehicle_data["oil_change"]!=""?date("d/m/y",$vehicle_data["oil_change"]):"";
				 $mainatanance['oil_change']=($vehicle_data["oil_change"]!="" && $vehicle_data["oil_change"]!=0)?
				 date("d/m/y",$vehicle_data["oil_change"]):"";

				 $mainatanance['reason']=$exeed_action;
				 array_push($response_result['data'],$mainatanance);			 
				 }
  		     }
			 if(count($response_result['data'])<1){
			  
			  $response['error']="1";
			  $response['error_msg']="NO Data";
			 }
		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
 		  //print "<pre>"; print_r($response_result);
 		  print json_encode($response_result);
		 
	 }
	 
	public function unplug_report(){
		   
		   ini_set('memory_limit','2048M');
		 $where=array_filter(explode(",",$this->input->post('vehicle_data')));
  		 // $where=array('23');
  		  $vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
 		  $this->response_result['data']=array();
		  $dom_i="1";
		  $start_time="";
		  $end_time="";
		  $from_date=strtotime($this->input->post("from"))*1000;
		  $to_date=strtotime($this->input->post("to"))*1000;
		  //$from_date=1550558880000;
		 // $to_date=1550561580000;
 		  
 		  foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
			  
  			  $gpswhere_clause['vehicle_id']=$vehicle_data['id'];
   			  $gpswhere_clause['device_timestamp>=']=$from_date;
			  $gpswhere_clause['device_timestamp<=']=$to_date;
 			  $orderby="device_timestamp asc";
 		      $gps_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,unpluged","vehicle_gps_information",$gpswhere_clause,"",$orderby); 
		   
			  
   			  $this->unpluged="";
			  $this->starttimestamp="0";
              $orderby="device_timestamp asc";
			  
              $total_count=count($gps_info);
  
 			  foreach($gps_info as $gps_data_key=>$gps_data){
				  
 				  if($this->unpluged==""){
  					   if($gps_data['unpluged']=="1"){
 						  $this->starttimestamp=$from_date;
 				       } 
  				  }else if($this->unpluged!=$gps_data['unpluged']){
					  
  					   if($gps_data['unpluged']=="1"){
						  if($this->starttimestamp=="0"){
 						     $this->starttimestamp=$gps_data['device_timestamp'];
						  }
 				       }else{
					      if($this->starttimestamp>0){
						     $this->data_prepare($vehicle_data,$this->starttimestamp,$gps_data['device_timestamp'],"");
							 $this->starttimestamp="0";
							 $dom_i++;
						  }
				       }
 				  }else if($gps_data_key==($total_count-1) && $gps_data['unpluged']=="1" ){
					  
					  if($this->starttimestamp>0){
						     $this->data_prepare($vehicle_data,$this->starttimestamp,$to_date,"");
							 $this->starttimestamp="0";
							 $dom_i++;
						  }
				  }
				  
				  
				  
 				  $this->unpluged=$gps_data['unpluged']; 
 			  }
 		   }
		   
		   
		   if(empty($this->response_result['data'])){
			   $this->response_result['data']=array();
		   }
		   
		  $this->response_result['draw']="1";
		  $this->response_result['recordsTotal']=$dom_i;
		  $this->response_result['recordsFiltered']="30";
 		  // print "<pre>"; print_r($this->response_result);
 		  print json_encode($this->response_result);
		  
	 }
	 
	 public function delay_report(){
		 ini_set('memory_limit','2048M');
		     $time_data=$this->input->post("stop_duration")!=""?$this->input->post("stop_duration"):0;
		
		   $time_limit=$time_data*60;
		   

		   //$where=array('87');
		  $where=array_filter(explode(",",$this->input->post('vehicle_data')));
 		  $vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
		  $response_result['data']=array();
		  $dom_i="1";
		  $device_timestamp="";
		  $server_time="";
		  foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
			  
  			  $gpswhere_clause['vehicle_id']=$vehicle_data['id'];
  			  $gpswhere_clause['device_timestamp>=']=strtotime($this->input->post("from"))*1000;
			  $gpswhere_clause['device_timestamp<=']=strtotime($this->input->post("to"))*1000;
			  //$gpswhere_clause['device_timestamp>=']=1537390800000;
			 //$gpswhere_clause['device_timestamp<=']=1537394400000;
              $orderby="device_timestamp asc";
			  $gps_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,created","vehicle_gps_information",$gpswhere_clause,"",$orderby); 
			  $response=array();
			  foreach($gps_info as $gps_data_key=>$gps_data){	  
				  $difference=(strtotime($gps_data['created'])-round($gps_data['device_timestamp'])/1000);
					  if($time_limit<$difference){
					  $second = 1;
           $minute = 60*$second;
           $hour   = 60*$minute;
           $day    = 24*$hour;          
           $ans["hour"]   = floor(($difference)/$hour)<10?"0".floor(($difference)/$hour):floor(($difference)/$hour);
           $ans["minute"] = floor(($difference%$hour)/$minute)<10?"0".floor(($difference%$hour)/$minute):floor(($difference%$hour)/$minute);
           $ans["second"] = floor((($difference%$hour)%$minute)/$second)<10?"0".floor((($difference%$hour)%$minute)/$second):floor((($difference%$hour)%$minute)/$second);
		   	  $response['id']=$vehicle_data['id'];
 			  $response['asset_code']=$vehicle_data['asset_code'];
			  $response['name']=$vehicle_data['name'];
			  $response['description']=$vehicle_data['description'];
			  $response['group_name']=$vehicle_data['department_name'];
			  $response['server_time']=date("d/m/Y H:i:s a",strtotime($gps_data['created']));
			  $response['device_time']=date("d/m/Y H:i:s a",round($gps_data['device_timestamp'])/1000);			  
			  $response['lattitude']=$gps_data['lattitude'];
 		   	  $response['lognitude']=$gps_data['lognitude'];
		      $response['time_difference']= $ans["hour"].":".$ans["minute"] .":".$ans["second"];
			   array_push($response_result['data'],$response);
			   $dom_i++; 
					  }
				}
  		  }
		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
		  //print "<pre>"; print_r($response_result);
  		  print json_encode($response_result);
		  
	 }
	 public function wrong_speed(){
		   ini_set('memory_limit','2048M');
		   $seleceted_geoffence=$this->input->post('geoffence_select');
 		   $this->geoffence_data=$this->get_geoffence($seleceted_geoffence);
		   
    	   $where=array_filter(explode(",",$this->input->post('vehicle_data')));
		   $from_date=strtotime($this->input->post("from"))*1000;
		   $to_date=strtotime($this->input->post("to"))*1000;
		   /*$from_date=1548968884000;
		   $to_date=1548969931000;
		   $where=array("11");*/
   		   $vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
		   $now=round(microtime(true) * 1000);
 			
 		   $dom_i="1";
		   $response_result['data']=array();
		  
		  
  		   foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
			   
  			  $now=round(microtime(true) * 1000);
			  $gpswhere_clause['vehicle_id']=$vehicle_data['id'];
    		  $gpswhere_clause['ign_status']="1";
   			  $gpswhere_clause['device_timestamp>=']=$from_date;
			  $gpswhere_clause['device_timestamp<=']=$to_date;
   			  $orderby="device_timestamp asc";
   			  $gps_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$gpswhere_clause,"",$orderby); 
 			  $rd="1";
			  
			  $now=round(microtime(true) * 1000);
 			  /* define the default variables*/
 			  $this->lattitude="";
			  $this->lognitude="";
 			  $this->speed="";
			  $this->id=="";
			  $this->timestamp=0;
			  $this->previoustimestamp=0;
 
 
   			  $total_count=count($gps_info);
			  
 			  foreach($gps_info as $gps_data_key=>$gps_data){
				  
 				  if(($this->lattitude==$gps_data['lattitude'] && $this->lognitude==$gps_data['lognitude'])){
					  
					 if($this->previous_timestamp!=$gps_data['device_timestamp'] && $this->speed!=$gps_data['speed']){
					  
					  if($this->speed>0){
						  
 						  if($this->id!=$this->previous_id){
						  
						    $response['description']=$vehicle_data['description'];
							$response['group_name']=$vehicle_data['department_name'];
							$response['speed']=$this->speed;
 							$response['lattitude']=$this->lattitude;
							$response['lognitude']=$this->lognitude;
							$response['time']=date("d/m/Y H:i:s a",round($this->previous_timestamp)/1000);
							$point=$this->lattitude." ".$this->lognitude;
							$response['geofence']=$this->pointInPolygon($point,$this->geoffence_data);
						 
							if(!empty($seleceted_geoffence)){
							 if($response['geofence']!=""){
								array_push($response_result['data'],$response);
								 $this->id=$gps_data['id'];
								 $dom_i++;
 							 }
							}else{
								 array_push($response_result['data'],$response);
								 $this->id=$gps_data['id'];
								  $dom_i++;
							}
						  }
 					  }
					 
					  if($gps_data['speed']>0){
						  
						   if($this->id!=$gps_data['id']){
						    $response['description']=$vehicle_data['description'];
							$response['group_name']=$vehicle_data['department_name'];
							$response['speed']=$gps_data['speed'];
 							$response['lattitude']=$gps_data['lattitude'];
							$response['lognitude']=$gps_data['lognitude'];
							$response['time']=date("d/m/Y H:i:s a",round($gps_data['device_timestamp'])/1000);
							$point=$gps_data['lattitude']." ".$gps_data['lognitude'];
							$response['geofence']=$this->pointInPolygon($point,$this->geoffence_data);
							 
							if(!empty($seleceted_geoffence)){
							 if($response['geofence']!=""){
								array_push($response_result['data'],$response);
								 $this->id=$gps_data['id'];
								 $dom_i++;
								
							 }
							}else{
								 array_push($response_result['data'],$response);
								 $this->id=$gps_data['id'];
								  $dom_i++;
							}
						   }
						  
					  }
					 }
				  }
				  
				  $this->previous_id=$gps_data['id'];
 				  $this->lattitude=$gps_data['lattitude'];
				  $this->lognitude=$gps_data['lognitude']; 
				  $this->speed=$gps_data['speed'];
				  $this->previous_timestamp=$gps_data['device_timestamp'];
				  
			  }
		   }
		   
		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
    	  print json_encode($response_result); 
		  //print "<pre>"; print_r($response_result); 
		  //die();
 		  
	  }
	 
	 
	 public function nodata_alert_report(){
 
		  ini_set('memory_limit','2048M');
		  $seleceted_geoffence=$this->input->post('geoffence_select');
 		  $this->geoffence_data=$this->get_geoffence($seleceted_geoffence);
 		  $where=array_filter(explode(",",$this->input->post('vehicle_data')));
 		  $from=strtotime($this->input->post("from"))*1000;
		  $to=strtotime($this->input->post("to"))*1000;
		 /* $where=array('85');
		  $from='1554544800000';
		  $to='1554548400000';*/
		  
 		  $vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
		  $response_result['data']=array();
		  $dom_i="1"; 
		  $server_time="";
		  foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
			  
  			  $gpswhere_clause['vehicle_id']=$vehicle_data['id'];
   			  $gpswhere_clause['device_timestamp>=']=$from;
			  $gpswhere_clause['device_timestamp<=']=$to;
			  $gpswhere_clause['lattitude>=']="24";
			  $gpswhere_clause['lattitude<=']="26";
			  $gpswhere_clause['lognitude>=']="50";
			  $gpswhere_clause['lognitude<=']="52";
 			  $limit=1;
			  $non_reportgps_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,created","vehicle_gps_information",$gpswhere_clause,"1","",$limit); 
			  
			  
			  
 			  if(!is_array($non_reportgps_info)){
 				  $gps_where_last_data['device_timestamp<']=$from;
				  $gps_where_last_data['vehicle_id']=$vehicle_data['id'];
				  $gps_where_last_data['lattitude>=']="24";
			      $gps_where_last_data['lattitude<=']="26";
			      $gps_where_last_data['lognitude>=']="50";
			      $gps_where_last_data['lognitude<=']="52";
				  //$gps_where_last_data['satelite>=']="7";
				  $orderby="device_timestamp desc";
				  
				  
   				  $last_data_received=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,created","vehicle_gps_information",$gps_where_last_data,"1",$orderby,$limit);
 				  
 				 // $response['asset_code']=$vehicle_data['asset_code'];
 				  $response['description']=$vehicle_data['description'];
			      $response['group_name']=$vehicle_data['department_name'];
				  $response['lattitude']=$last_data_received['lattitude'];
				  $response['lognitude']=$last_data_received['lognitude'];
				  $response['time']=$last_data_received['device_timestamp']!=""?date("d/m/Y H:i:s a",round($last_data_received['device_timestamp'])/1000):"No data";
				 $response['server_time']=date("d/m/Y H:i:s a",strtotime($last_data_received['created']));


				  $point=$last_data_received['lattitude']." ".$last_data_received['lognitude'];
 			      $response['geofence']=$this->pointInPolygon($point,$this->geoffence_data);
				  if(!empty($seleceted_geoffence)){
				   if($response['geofence']!=""){
				      array_push($response_result['data'],$response);
					   $dom_i++;
				   }
				  }else{
					   array_push($response_result['data'],$response);
					    $dom_i++;
				  }
 			  }  
			   
  		  }
 		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
		  //print "<pre>"; print_r($response_result);
  		  print json_encode($response_result);
		  
	 }
	 
	 public function full_report(){
		  ini_set('memory_limit','2048M');
		
		  $whereheader_clause['ua.user_group_id']=$this->session->userdata('id');
	      $whereheader_clause['ua.type']="1";
	      $whereheader_clause['ua.status']="1";
 	      $data1['masters_data']=$this->reports_model->master_join("m.id,m.master,m.controller",$whereheader_clause);
		  $data1['heading']="Reports";
		
  		  $where_clause['ua.user_group_id']=$this->session->userdata('id');
		  $where_clause['ua.type']="3";
		  $where_clause['ua.status']="1";
 		  $data['reports_list']=$this->reports_model->reports_join("r.id,r.report_name",$where_clause);
 
		  $where_clause['ua.type']="2";
 		  $vehiclefulldata= $this->reports_model->vehicle_group_join("vd.id,vd.description,d.id as group_id,d.name as group_name",$where_clause);
		  $data['vehicle_fulldata']="";
  		  //$vehiclefulldata= $this->reports_model->vehicle_group_join("vd.id,vd.description,vg.id as group_id,vg.name as group_name","");
		  if(count($vehiclefulldata)>0){
 		    foreach($vehiclefulldata as $vehicle_key=>$vehicledata){
 			  $groupwise_data[$vehicledata['group_id']]['group_name']=$vehicledata['group_name'];
   			  $groupwise_data[$vehicledata['group_id']][$vehicledata['id']]['description']=$vehicledata['description'];
   		    }
			$data['vehicle_fulldata']=$vehiclefulldata;
			$data['vehicle_data']=$groupwise_data;
		  }
		  
		  $this->load->view('header',$data1);
  	      $this->load->view('full_report',$data);
		   $this->load->view('footer');
 
      }
	  
	  
	  public function full_data(){
	
	       ini_set('memory_limit','2048M');
		   $where=array_filter(explode(",",$this->input->post('vehicle_full_data')));
   		   $gpswhere_clause['vgi.device_timestamp>=']=strtotime($this->input->post("from"))*1000;
		   $gpswhere_clause['vgi.device_timestamp<=']=strtotime($this->input->post("to"))*1000;
		   /*$gpswhere_clause['vgi.device_timestamp>=']="1538225238000";
		   $gpswhere_clause['vgi.device_timestamp<=']="1538311638000";
		   $where=array("87","97");*/
  		   $orderby="device_timestamp asc";
  		   $full_data=$this->reports_model->full_data($where,$gpswhere_clause,$orderby);
		   $vehicles_gps=array();
		   $response_result['data']=array();
		   $dom_i=0;
		   if(count($full_data)>0){
    		  foreach($full_data as $full_key=>$datainfo){
  			    $vehicles_gps["id"]=$datainfo['id'];
			    $vehicles_gps["vehicle_id"]=$datainfo['name'];
				$vehicles_gps["device_timestamp1"]=$datainfo['device_timestamp'];
		        $vehicles_gps["device_timestamp"]=$datainfo['device_timestamp']=="NaN"?"NaN":date("d-m-Y H:i:s",round($datainfo['device_timestamp']/1000));
			    $vehicles_gps["lattitude"]=$datainfo['lattitude'];
			    $vehicles_gps["lognitude"]=$datainfo['lognitude'];
			    $vehicles_gps["speed"]=$datainfo['speed'];
				$vehicles_gps["idling"]=$datainfo['idling']=="1"?"ON":"OFF";
 				$vehicles_gps["external_power"]=$datainfo['external_power'];
				$vehicles_gps["battery_power"]=$datainfo['battery_power'];
				$vehicles_gps["generated_event"]=$datainfo['generated_event'];
				$vehicles_gps["generated_event_value"]=$datainfo['generated_event_value'];
				$vehicles_gps["satelite"]=$datainfo['satelite'];
				$vehicles_gps["movement"]=$datainfo['movement']=="1"?"ON":"OFF";
 				$vehicles_gps["manual_odometer"]=$datainfo['manual_odometer'];
 			    $vehicles_gps["odometer"]=$datainfo['odometer'];
 			    $vehicles_gps["ign_status"]=$datainfo['ign_status']=="1"?"ON":"OFF";
			    $vehicles_gps["acceleration"]=$datainfo['acceleration']=="1"?"ON":"OFF";
			    $vehicles_gps["hash_breaking"]=$datainfo['hash_breaking']=="1"?"ON":"OFF";
 				$vehicles_gps["unplug"]=$datainfo['unpluged']=="1"?"ON":"OFF"; 
			    $vehicles_gps["Heading"]=$datainfo['Heading'];
			    $vehicles_gps["altitude"]=$datainfo['altitude'];
			    $vehicles_gps["created"]=$datainfo['created'];
				$difference=strtotime($datainfo['created'])-round($datainfo['device_timestamp']/1000);
				
				$second = 1;
				$minute = 60*$second;
			    $hour   = 60*$minute;
				$day    = 24*$hour;          
			    $ans["hour"]   = floor(($difference)/$hour)<10?"0".floor(($difference)/$hour):floor(($difference)/$hour);
				$ans["minute"] = floor(($difference%$hour)/$minute)<10?"0".floor(($difference%$hour)/$minute):floor(($difference%$hour)/$minute);
				$ans["second"] = floor((($difference%$hour)%$minute)/$second)<10?"0".floor((($difference%$hour)%$minute)/$second):floor((($difference%$hour)%$minute)/$second);
				$vehicles_gps["difference"]= $ans["hour"].":".$ans["minute"] .":".$ans["second"];
					  
				 array_push($response_result['data'],$vehicles_gps);
				$dom_i++; 
   		     }
		   } 
		   
 		 /*  $data['full_info']=$vehicles_gps;
		   $this->load->view('alafulldata',$data);
 		   die();*/
		   
		   
		   $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
  		  print json_encode($response_result);
	  }
	  
	  public function alafull_data(){
		  ini_set('memory_limit','2048M');
	
		   $where=array_filter(explode(",",$this->input->post('vehicle_full_data')));
   		   $gpswhere_clause['vgi.device_timestamp>=']=strtotime($this->input->post("start_date"))*1000;
		   $gpswhere_clause['vgi.device_timestamp<=']=strtotime($this->input->post("end_date"))*1000;
		   /*$gpswhere_clause['vgi.device_timestamp>=']="1538225238000";
		   $gpswhere_clause['vgi.device_timestamp<=']="1538311638000";
		   $where=array("87","97");*/
  		   $orderby="device_timestamp asc";
  		   $full_data=$this->reports_model->full_data($where,$gpswhere_clause,$orderby);
		   
 
		   $vehicles_gps=array();
		   $response_result=array();
		   $dom_i=0;
		   if(count($full_data)>0){
    		  foreach($full_data as $full_key=>$datainfo){
  			    $vehicles_gps["id"]=$datainfo['id'];
			    $vehicles_gps["vehicle_id"]=$datainfo['name'];
				$vehicles_gps["device_timestamp1"]=$datainfo['device_timestamp'];
		        $vehicles_gps["device_timestamp"]=$datainfo['device_timestamp']=="NaN"?"NaN":date("d-m-Y H:i:s",round($datainfo['device_timestamp']/1000));
			    $vehicles_gps["lattitude"]=$datainfo['lattitude'];
			    $vehicles_gps["lognitude"]=$datainfo['lognitude'];
			    $vehicles_gps["speed"]=$datainfo['speed'];
				$vehicles_gps["idling"]=$datainfo['idling']=="1"?"ON":"OFF";
 				$vehicles_gps["external_power"]=$datainfo['external_power'];
				$vehicles_gps["battery_power"]=$datainfo['battery_power'];
				$vehicles_gps["generated_event"]=$datainfo['generated_event'];
				$vehicles_gps["generated_event_value"]=$datainfo['generated_event_value'];
				$vehicles_gps["satelite"]=$datainfo['satelite'];
				$vehicles_gps["movement"]=$datainfo['movement']=="1"?"ON":"OFF";
 				$vehicles_gps["manual_odometer"]=$datainfo['manual_odometer'];
 			    $vehicles_gps["odometer"]=$datainfo['odometer'];
 			    $vehicles_gps["ign_status"]=$datainfo['ign_status']=="1"?"ON":"OFF";
			    $vehicles_gps["acceleration"]=$datainfo['acceleration']=="1"?"ON":"OFF";
			    $vehicles_gps["hash_breaking"]=$datainfo['hash_breaking']=="1"?"ON":"OFF";
 				$vehicles_gps["unplug"]=$datainfo['unpluged']=="1"?"ON":"OFF"; 
			    $vehicles_gps["Heading"]=$datainfo['Heading'];
			    $vehicles_gps["altitude"]=$datainfo['altitude'];
			    $vehicles_gps["created"]=$datainfo['created'];
				$difference=strtotime($datainfo['created'])-round($datainfo['device_timestamp']/1000);
				
				$second = 1;
				$minute = 60*$second;
			    $hour   = 60*$minute;
				$day    = 24*$hour;          
			    $ans["hour"]   = floor(($difference)/$hour)<10?"0".floor(($difference)/$hour):floor(($difference)/$hour);
				$ans["minute"] = floor(($difference%$hour)/$minute)<10?"0".floor(($difference%$hour)/$minute):floor(($difference%$hour)/$minute);
				$ans["second"] = floor((($difference%$hour)%$minute)/$second)<10?"0".floor((($difference%$hour)%$minute)/$second):floor((($difference%$hour)%$minute)/$second);
				$vehicles_gps["difference"]= $ans["hour"].":".$ans["minute"] .":".$ans["second"];
					  
				 array_push($response_result,$vehicles_gps);
				$dom_i++; 
   		     }
		   } 
  		   $data['full_info']=$response_result;
 		   $this->load->view('alafulldata',$data);
 		   die();
		   
		   
		    
	  }
	  
	  
 	   
	  
	  public function duplicate_entry_report(){
		  ini_set('memory_limit','2048M');
		  $where=array_filter(explode(",",$this->input->post('vehicle_data')));
		  // $where=array('87');		  
 		  $vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
		  $response_result['data']=array();
		  $dom_i="1";
		  
		  foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
			  
  			  $gpswhere_clause['vehicle_id']=$vehicle_data['id'];			  
  			  $gpswhere_clause['device_timestamp>=']=strtotime($this->input->post("from"))*1000;
			  $gpswhere_clause['device_timestamp<=']=strtotime($this->input->post("to"))*1000;
			  //$gpswhere_clause['device_timestamp>=']=1535749200;
			 //$gpswhere_clause['device_timestamp<=']=1537390800 ;
 			 
 			  
              $orderby="device_timestamp asc";
			  $gps_info=$this->reports_model->db_datacheck("id,device_timestamp,lattitude,lognitude,generated_event,generated_event_value","vehicle_gps_information",$gpswhere_clause,"",$orderby); 
			  $response=array();
			  foreach($gps_info as $gps_data_key=>$gps_data){
				  
					  if($previous_gps_data['device_timestamp']==$gps_data['device_timestamp'])
					  {
						  
						$response["id"]=$previous_gps_data['id'];
					    $response['asset_code']=$vehicle_data['asset_code'];
					    $response['name']=$vehicle_data['name'];
					    $response['description']=$vehicle_data['description'];
					    $response['group_name']=$vehicle_data['department_name'];			  
					    $response['device_time']=date("d/m/Y H:i:s a",round($previous_gps_data['device_timestamp'])/1000);
						$response['device_timestamp']=$previous_gps_data['device_timestamp'];						
						$response["generated_event"]=$previous_gps_data['generated_event'];
						$response["generated_event_value"]=$previous_gps_data['generated_event_value'];
					    array_push($response_result['data'],$response);  
						  
 					    $response["id"]=$gps_data['id'];
					    $response['asset_code']=$vehicle_data['asset_code'];
					    $response['name']=$vehicle_data['name'];
					    $response['description']=$vehicle_data['description'];
					    $response['group_name']=$vehicle_data['department_name'];	
						$response["generated_event"]=$gps_data['generated_event'];
						$response["generated_event_value"]=$gps_data['generated_event_value'];		  
					    $response['device_time']=date("d/m/Y H:i:s a",round($gps_data['device_timestamp'])/1000);
						$response['device_timestamp']=$gps_data['device_timestamp'];
					    array_push($response_result['data'],$response);
					  }
					     		   	 
			   $previous_gps_data =$gps_data;
			    
			   $dom_i++; 
				}
  		  }
		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
		  //print "<pre>"; print_r($response_result);
  		  print json_encode($response_result);
		  
	 }

	 //report update starts

	 public function geofence_area(){
		$where_clause['id !=']=$this->input->post('geofence_id');
		$geofence_info=$this->reports_model->db_datacheck("id,name","geoffence",$where_clause); 
		if(count($geofence_info)>0){
			$geofence_reuslt_data['geofence_data']= $geofence_info;
		}
		print json_encode($geofence_reuslt_data);
	 }
	 
	 
	 function time_calculation($difference){
 			   $second = 1;
			   $minute = 60*$second;
			   $hour   = 60*$minute;
			   $day    = 24*$hour;
 			   $ans["hour"]   = floor(($difference)/$hour)<10?"0".floor(($difference)/$hour):floor(($difference)/$hour);
			   $ans["minute"] = floor(($difference%$hour)/$minute)<10?"0".floor(($difference%$hour)/$minute):floor(($difference%$hour)/$minute);
			   $ans["second"] = floor((($difference%$hour)%$minute)/$second)<10?"0".floor((($difference%$hour)%$minute)/$second):floor((($difference%$hour)%$minute)/$second);
 			   
			   return $ans["hour"].":".$ans["minute"].":".$ans["second"];
	 }
	 
	 
 	 public function geoffence_to_geoffence(){
		 	
		  $from=strtotime($this->input->post("from"))*1000;
		  $to=strtotime($this->input->post("to"))*1000;
		  $geoffence_from=$this->input->post("geoffence_from");
		  $geoffence_to=$this->input->post("geoffence_to");
		  $geowhere_clause['va.device_timestamp>=']=$from;
		  $geowhere_clause['va.device_timestamp<=']=$to;
      	  $vehicle_data=array_filter(explode(",",$this->input->post('vehicle_data')));
   		  $geoffence_full_data=$this->reports_model->geoffenceduration($geowhere_clause,$vehicle_data,$geoffence_from,$geoffence_to);
 		  // print "<pre>"; print_r($geoffence_full_data); die;
		  
		  $from_geoffence_inflag="0";
		  $from_geoffence_outflag="0";
		  $to_geoffence_inflag="0";
		  $to_geoffence_outflag="0";
		  $geo_togeo=array();
		  $full_geoarray=array();
		  $response_result['data']=array();
		  $dom_i=0;
		  $previous_vehicle_id="";
 		  foreach($geoffence_full_data as $gps_key =>$gps_data){
			  
			  
			  if($gps_data['vehicle_id']!=$previous_vehicle_id){
				  $geo_togeo=array();
				  $from_geoffence_inflag="0";
				  $from_geoffence_outflag="0";
				  $to_geoffence_inflag="0";
				  $to_geoffence_outflag="0";
 			  }
			  
 			  if($gps_data['geoffence_id']==$geoffence_from){
 				  if($gps_data['type']==3){
				     $geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["in"]=$gps_data['device_timestamp'];
					 $geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["from_id"]=$gps_data['vehicle_gps_id'];
					 $from_geoffence_inflag[$gps_data['vehicle_id']]="1";
					 
 				  }else{
					  if($from_geoffence_inflag[$gps_data['vehicle_id']]=="1"){
					   $geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["out"]=$gps_data['device_timestamp']; 
					   $geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["outkm"]=$gps_data['odometer']; 
					   $from_geoffence_inflag[$gps_data['vehicle_id']]="0"; 
					   $from_geoffence_outflag[$gps_data['vehicle_id']]="1";
					  }
 				  }
   			  }else{
				  if($gps_data['type']==3){
				    if($from_geoffence_outflag[$gps_data['vehicle_id']]=="1"){
					  $geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["in"]=$gps_data['device_timestamp'];
					  $geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["inkm"]=$gps_data['odometer']; 
					  $from_geoffence_outflag[$gps_data['vehicle_id']]="0";
					  $to_geoffence_inflag[$gps_data['vehicle_id']]="1";
 					}
 				  }else{
					if($to_geoffence_inflag[$gps_data['vehicle_id']]=="1"){
					   $geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["out"]=$gps_data['device_timestamp']; 
					   $geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["to_id"]=$gps_data['vehicle_gps_id'];
					   $to_geoffence_inflag[$gps_data['vehicle_id']]="0"; 
					   $to_geoffence_outflag[$gps_data['vehicle_id']]="1"; 
					  }  
 				  }
  			  }
			  
			  
			  if($to_geoffence_outflag[$gps_data['vehicle_id']]=="1"){
				  
 				 $entry_geoarray=array();
				 $entry_geoarray['asset_code']=$gps_data['asset_code'];
				 $entry_geoarray['description']=$gps_data['description'];
				 $entry_geoarray['from_in_time']=date("d/m/Y H:i:s",($geo_togeo[$gps_data['vehicle_id']][$geoffence_from]["in"])/1000);
				 $entry_geoarray['from_out_time']=date("d/m/Y H:i:s",($geo_togeo[$gps_data['vehicle_id']][$geoffence_from]["out"])/1000);
				 $entry_geoarray['to_in_time']=date("d/m/Y H:i:s",($geo_togeo[$gps_data['vehicle_id']][$geoffence_to]["in"])/1000);
				 $entry_geoarray['to_out_time']=date("d/m/Y H:i:s",($geo_togeo[$gps_data['vehicle_id']][$geoffence_to]["out"])/1000);
 				 $entry_geoarray['distance']=round($geo_togeo[$gps_data['vehicle_id']][$geoffence_to]["inkm"]-$geo_togeo[$gps_data['vehicle_id']][$geoffence_from]["outkm"],2);
 				 $from_spent_time=($geo_togeo[$gps_data['vehicle_id']][$geoffence_from]["out"]-$geo_togeo[$gps_data['vehicle_id']][$geoffence_from]["in"])/1000;
				 $travelling_time=($geo_togeo[$gps_data['vehicle_id']][$geoffence_to]["in"]-$geo_togeo[$gps_data['vehicle_id']][$geoffence_from]["out"])/1000;
				 $to_spent_time=($geo_togeo[$gps_data['vehicle_id']][$geoffence_to]["out"]-$geo_togeo[$gps_data['vehicle_id']][$geoffence_to]["in"])/1000;
   				 $entry_geoarray['from_spent_time']=$this->time_calculation($from_spent_time);
				 $entry_geoarray['travelling_time']=$this->time_calculation($travelling_time);
				 $entry_geoarray['to_spent_time']=$this->time_calculation($to_spent_time);
				 $track_id=$geo_togeo[$gps_data['vehicle_id']][$geoffence_from]["from_id"].",".$geo_togeo[$gps_data['vehicle_id']][$geoffence_to]["to_id"];
				 $selectedgeoffence=$geoffence_from.",".$geoffence_to; 
				 $entry_geoarray['track']='<input type="button" class="btn btn-primary track" id="track_'.$gps_data['vehicle_id'].'" data-option="'.$selectedgeoffence.'" data-id="'.$track_id.'" value="Track">';
				  
 				 array_push($response_result['data'],$entry_geoarray);
 				 $dom_i++;
				 $geo_togeo=array();
				 $to_geoffence_outflag[$gps_data['vehicle_id']]="0";  
			  }
			  
			  $previous_vehicle_id=$gps_data['vehicle_id'];
  		  }
		  
		  //=$full_geoarray;
		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
		  ini_set('memory_limit','128M');
  		  print json_encode($response_result);  
 		  
 	 }
	 
	 
	 
	 
	 
	 public function geofence_togeofence_summary(){
		 
		  $from=strtotime($this->input->post("from"))*1000;
		  $to=strtotime($this->input->post("to"))*1000;
		  $geoffence_from=$this->input->post("geoffence_from");
		  $geoffence_to=$this->input->post("geoffence_to");
		  $geowhere_clause['va.device_timestamp>=']=$from;
		  $geowhere_clause['va.device_timestamp<=']=$to;
      	  $vehicle_data=array_filter(explode(",",$this->input->post('vehicle_data')));
   		  $geoffence_full_data=$this->reports_model->geoffenceduration($geowhere_clause,$vehicle_data,$geoffence_from,$geoffence_to);
		  $travelling_flagout="0";
		  $travelling_flagin="0";
		  $return_flagout="0";
		  $return_flagin="0";
		  $dom_i=0;
		  $response_result['data']=array();
		  $geo_togeo=array();
		   $previous_vehicle_id="";
		  foreach($geoffence_full_data as $gps_key =>$gps_data){
			  
			  
			  if($gps_data['vehicle_id']!=$previous_vehicle_id){
				  $geo_togeo=array();
				  $travelling_flagout="0";
				  $travelling_flagin="0";
				  $return_flagout="0";
				  $return_flagin="0";
 			  }
		  
			  
 			  if($gps_data['geoffence_id']==$geoffence_from){
 				  if($gps_data['type']==4){
					 $geo_togeo[$gps_data['vehicle_id']]["travelingout"]=$gps_data['device_timestamp'];
					 $geo_togeo[$gps_data['vehicle_id']]["travelingoutkm"]=$gps_data['odometer']; 
					 $travelling_flagout="1";
					 
				  }else{
					  if($return_flagout=="1"){
						 $geo_togeo[$gps_data['vehicle_id']]["returnin"]=$gps_data['device_timestamp']; 
						 $geo_togeo[$gps_data['vehicle_id']]["returninkm"]=$gps_data['odometer'];  
						 $return_flagout="0";
						 $return_flagin="1";
					  }
				  }
 			  }else{
				  
				  if($gps_data['type']==3){
					   if($travelling_flagout=="1"){
						  $geo_togeo[$gps_data['vehicle_id']]["travelingin"]=$gps_data['device_timestamp'];
						  $geo_togeo[$gps_data['vehicle_id']]["travelinginkm"]=$gps_data['odometer']; 
						  $travelling_flagin="1";
						  $travelling_flagout="0";
					   }
				  }else{
					  if($travelling_flagin=="1" || $return_flagout=="1"){
						 $geo_togeo[$gps_data['vehicle_id']]["returnout"]=$gps_data['device_timestamp'];
						 $geo_togeo[$gps_data['vehicle_id']]["returnoutkm"]=$gps_data['odometer'];
						 $return_flagout="1";
						 $travelling_flagin="0";
					  }
				  }
			  }

  			  if($return_flagin=="1"){
				  
				  
				  //print "<pre>";print_r($geo_togeo);
				  
				  $entry_geoarray=array();
				  $travelling_km=($geo_togeo[$gps_data['vehicle_id']]["travelinginkm"]-$geo_togeo[$gps_data['vehicle_id']]["travelingoutkm"]);
				  $returning_km=($geo_togeo[$gps_data['vehicle_id']]["returninkm"]-$geo_togeo[$gps_data['vehicle_id']]["returnoutkm"]);
 				  $travelling_time=($geo_togeo[$gps_data['vehicle_id']]["travelingin"]-$geo_togeo[$gps_data['vehicle_id']]["travelingout"])/1000;
				  $return_time=($geo_togeo[$gps_data['vehicle_id']]["returnin"]-$geo_togeo[$gps_data['vehicle_id']]["returnout"])/1000;
 				  $entry_geoarray['asset_code']=$gps_data['asset_code'];
				  $entry_geoarray['description']=$gps_data['description'];
 				  $entry_geoarray['travellingtime']= $this->time_calculation($travelling_time);
				  $entry_geoarray['travellingkm']= round($travelling_km,2);
  				  $entry_geoarray['returntime']=$this->time_calculation($return_time);
				  $entry_geoarray['returningkm']= round($returning_km,2);
				  
				  
  				 // print "<pre>"; print_r($entry_geoarray);
				  
				  
				 // print "------------------------------------------------------";
 				  array_push($response_result['data'],$entry_geoarray);
				  $dom_i++;
				  $geo_togeo=array();
				  $return_flagin="0"; 
				  
				  
				  
			  }
			  $previous_vehicle_id=$gps_data['vehicle_id'];
		  }
		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
		  ini_set('memory_limit','128M');
		   //print "<pre>"; print_r($response_result);
  		  print json_encode($response_result);   
		 
	 }
	 
	 
	 
	 public function geoffence_time(){
		   ini_set('memory_limit','1000M');
 		   $seleceted_geoffence=$this->input->post('geoffence_select');
    	   $vehicle_data=array_filter(explode(",",$this->input->post('vehicle_data')));
    	   //$vehiclefulldata= $this->reports_model->multiple_vehicle_data($where);
 		   $from_date=strtotime($this->input->post("from"))*1000;
		   $to_date=strtotime($this->input->post("to"))*1000;
           $response_result['data']=array();
		   $geo_togeo=array();
 		   $dom_i="1";
		   $where_clause['device_timestamp>']=$from_date;
		   $where_clause['device_timestamp<']=$to_date;
		   $from_geoffence_inflag="0";
		   $from_geoffence_outflag="0";

  		   $geoffence_full_data=$this->reports_model->geofencetimedatacheck($where_clause,$vehicle_data,$seleceted_geoffence);
		   
 		   foreach($geoffence_full_data as $gps_key =>$gps_data){
			   if($gps_data['type']==3){
				 $geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["in"]=$gps_data['device_timestamp'];
				 $from_geoffence_inflag="1";
			  }else{
				  if($from_geoffence_inflag=="1"){
				   $geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["out"]=$gps_data['device_timestamp']; 
				   $from_geoffence_inflag="0"; 
				   $from_geoffence_outflag="1";
				  }
			  }
			   if($from_geoffence_outflag=="1"){
				 $entry_geoarray=array();
				 $entry_geoarray['asset_code']=$gps_data['asset_code'];
				 $entry_geoarray['description']=$gps_data['description'];
				 $entry_geoarray['in_time']=date("d/m/Y H:i:s",($geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["in"]/1000));
				 $entry_geoarray['out_time']=date("d/m/Y H:i:s",($geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["out"]/1000));
				 $difference=$geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["out"]-$geo_togeo[$gps_data['vehicle_id']][$gps_data['geoffence_id']]["in"];
				 $entry_geoarray['spent_time']=$this->time_calculation($difference/1000);
				 $entry_geoarray['geoffence']=$gps_data['name'];
				 array_push($response_result['data'],$entry_geoarray);
				 $dom_i++;
				 $geo_togeo=array();
				 $from_geoffence_outflag="0"; 
			   }
		  }
 		    
 		   
		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
		  ini_set('memory_limit','128M');
		  //print "<pre>"; print_r($response_result);
		  print json_encode($response_result);   
		   
 	 }
	 
	 
	 public function goefence_data($group=""){
 		 if($group!=""){
			 $where['geo_group']=$group;
		 }
		 $geofence_reuslt_data=array();
		 $geofence_info=$this->reports_model->db_datacheck("id,name","geoffence",$where); 
 		 foreach($geofence_info as $geof_key =>$geof_data){
			 $geofence_reuslt_data[$geof_data['id']]= $geof_data['name'];
			 
		 }
 		 return $geofence_reuslt_data;
 	 }
	 
		 
 	 public function woqode_report(){
		  // echo "<pre>"; print_r($_POST); die; 
		  ini_set('memory_limit','1000M');
     	  $vehicle_data=array_filter(explode(",",$this->input->post('vehicle_data')));
  		  $from_date=strtotime($this->input->post("from"))*1000;
		  $to_date=strtotime($this->input->post("to"))*1000;
		  $geofence_fulldata=$this->goefence_data("5");
		  $geofens_ids=array_keys($geofence_fulldata);
          $response_result['data']=array();
		  $dom_i=0;
		  $where['time>=']=$from_date;
		  $where['time<=']=$to_date;
		  $woqode_full_data=$this->reports_model->woqode_datas($vehicle_data,$where);
 		  foreach($woqode_full_data as $key=>$woqode_data){
 			  $woqode_datas['asset_code']=$woqode_data['asset_code'];
			  $woqode_datas['description']=$woqode_data['description'];
			  $woqode_datas['quantity']=$woqode_data['qunatity'];
			  $woqode_datas['saletime']=date("d/m/Y H:i:s",$woqode_data['time']/1000);
			  $woqode_datas['station']=$woqode_data['station'];
 			  $geofence_data=$this->reports_model->woqode_geofence($woqode_data['vehicle_id'],$woqode_data['time']);
 			  if($geofence_data['geofence_in']==$geofence_data['geofence_out']){
  				  if(in_array($geofence_data['geofence_in'],$geofens_ids)){
 					  $spent_time=($geofence_data['geofence_outtime']-$geofence_data['geofence_intime'])/1000;
 					  $woqode_datas['geofence_in']=date("d/m/Y H:i:s",($geofence_data['geofence_intime']/1000));
					  $woqode_datas['geofence_out']=date("d/m/Y H:i:s",($geofence_data['geofence_outtime']/1000));
					  $woqode_datas['spent_time']=$this->time_calculation($spent_time);
					  $woqode_datas['geofence']=$geofence_fulldata[$geofence_data['geofence_in']];
 				  }else{
					  $woqode_datas['geofence_in']="";
					  $woqode_datas['geofence_out']="";
					  $woqode_datas['spent_time']="00:00";
					  $woqode_datas['geofence']="";
				  }
				  
 			  } else{
			  }
  			  array_push($response_result['data'],$woqode_datas);
			  $dom_i++;
		  }
		  $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
  		  print json_encode($response_result);
		  
	 }

	 //report update ends
	 
	 public function wrong_data(){
		  ini_set('memory_limit','2048M');
		   //$where_in=array('87');
		   $where_in=array_filter(explode(",",$this->input->post('vehicle_full_data')));
		   $response_result['data']=array();
		   $dom_i="1";
   		   //$gpswhere_clause['vgi.device_timestamp>=']=strtotime($this->input->post("from"));
		   //$gpswhere_clause['vgi.device_timestamp<=']=strtotime($this->input->post("to"));
		  
  		   $orderby="device_timestamp asc";
  		   $full_data=$this->reports_model->wrong_data($where_in,$orderby);
 		   $vehicles_gps=array();
		   if(count($full_data)>0){
			   
   		     foreach($full_data as $full_key=>$datainfo){
				 
 			    $vehicles_gps["id"]=$datainfo['id'];
				$vehicles_gps["asset_code"]=$datainfo['asset_code'];
			    $vehicles_gps["vehicle_id"]=$datainfo['name'];
				$vehicles_gps["description"]=$datainfo['description'];
				 $vehicles_gps["device_timestamp1"]=$datainfo['device_timestamp'];
			    $vehicles_gps["device_timestamp"]=$datainfo['device_timestamp']=="NaN"?"NaN":date("d-m-Y H:i:s",($datainfo['device_timestamp']));
			    $vehicles_gps["lattitude"]=$datainfo['lattitude'];
			    $vehicles_gps["lognitude"]=$datainfo['lognitude'];
			    $vehicles_gps["speed"]=$datainfo['speed'];
			    $vehicles_gps["odometer"]=$datainfo['odometer'];
			    $vehicles_gps["ign_status"]=$datainfo['ign_status']=="1"?"ON":"OFF";
			    $vehicles_gps["acceleration"]=$datainfo['acceleration']=="1"?"ON":"OFF";
			    $vehicles_gps["hash_breaking"]=$datainfo['hash_breaking']=="1"?"ON":"OFF";
				$vehicles_gps["unplug"]=$datainfo['unpluged']=="1"?"ON":"OFF"; 
			    $vehicles_gps["Heading"]=$datainfo['Heading'];
			    $vehicles_gps["altitude"]=$datainfo['altitude'];
			    $vehicles_gps["created"]=$datainfo['created'];
				array_push($response_result['data'],$vehicles_gps);
				$dom_i++; 
  		     }
		   } 
		   
 		   //$data['full_info']=$vehicles_gps;
		   //$this->load->view('alafulldata',$data);
 		   //die();
		   
		    $response_result['draw']="1";
		  $response_result['recordsTotal']=$dom_i;
		  $response_result['recordsFiltered']='30';
  		  print json_encode($response_result);
		 //print "<pre>"; print_r($response_result);
		  
	 }


	  
	  
}

?>