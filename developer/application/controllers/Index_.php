<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
 	  public function __construct()
      {
        parent::__construct();
   		$this->load->model('Gps_model');
		$this->load->helper('url');
	    $this->load->library('form_validation');
      }
      public function index(){

          $this->auto_logout();
 		  $this->load->view('login');	
	  }
	  
	  public function auto_logout(){
 	     $this->session->sess_destroy();
	  }
	  
	  public function loginvalidate(){
 		  $return=array();
   	      $this->form_validation->set_rules('username', 'User Name', 'required');
		  $this->form_validation->set_rules('password', 'Name', 'required');
		  $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	      if ($this->form_validation->run() == TRUE) {
			    $this->load->library('encrypt');
			   $where_clause['user_name']=$this->security->xss_clean($this->input->post('username'));

			  // $where_clause['Password']=$this->encrypt->encode($this->input->post('password'));
			   $login_data=$this->Gps_model->gps_datacheck("id,name,password,status,user_group","user",$where_clause);

			   if(is_array($login_data)){
 				   if($login_data['status']=="1"){
					   if(@$this->encrypt->decode($login_data['password'])==$this->security->xss_clean($this->input->post('password'))){
						   $data["id"]= $login_data['id'];
						   $data["name"]= $login_data['name'];
						   $data["user_group"]= $login_data['user_group'];
						   $this->session->set_userdata($data);
					   }else{
						  $return['error_flag']="1";
						  $return['message']="Invalid Password";
					   }
				   }else{
					   $return['error_flag']="1";
		               $return['message']="Sorry!!! Your login is inactive.please contact Admin";
				   }
				   
			   }else{
				   $return['error_flag']="1";
		           $return['message']="Invalid User Name";
			   }
			   
		  }else{
		     $return['error_flag']="1";
		     $return['message']="Please check the required fields";
          }
	      print json_encode($return);
		  
	  }
	  public function live_map($dom_id=""){
		  
		  
 		  login_check();

 		  $valuable_id=array();

		  // list masters starts
		  $whereheader_clause['u.id']=$this->session->userdata('id');
	      $whereheader_clause['ua.type']="1";
	      $whereheader_clause['ua.status']="1";
 	      $data['masters_data']=$this->Gps_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
 	      // list masters ends

		  // geoffence masters starts
  		  $geoffencewhere_clause = array();
 		  $geoffencewhere_clause['u.id']=$this->session->userdata('id');
		  $geoffencewhere_clause['ua.type']="5";
		  $geoffencewhere_clause['ua.status']="1";
		  $geoffencewhere_clause['g.status']="1";
		  $geoffencewhere_clause['gg.status']="1";
		  $geoffencefulldata = $this->Gps_model->geoffence_group_join("g.id,g.name,gg.id as group_id,gg.Name as group_name, cn.id as cust_id, cn.cust_name as cust_name",$geoffencewhere_clause);
		  // geoffence masters ends  
  		
  		  // arranging geoffence widget starts 
		  if(count($geoffencefulldata)>0){
			  foreach($geoffencefulldata as $geoffencedatakey=>$geoffencedata){
				  
				   $groupwise_geoffence[$geoffencedata['group_id']]['group_name']=$geoffencedata['group_name'];				   
				   $groupwise_geoffence[$geoffencedata['group_id']][$geoffencedata['cust_id']]['cust_name']=$geoffencedata['cust_name'];
				   $groupwise_geoffence[$geoffencedata['group_id']][$geoffencedata['cust_id']][$geoffencedata['id']]['description']=$geoffencedata['name'];
			  }
		  }else{
			  $groupwise_geoffence=array();
		  }		  
		  // arranging geoffence widget ends 
		  
 		  $data['geoffence_data']=$groupwise_geoffence;

 		  // fetching vehicle data starts

 		  $where_clause              = array();
 		  $where_clause['u.id']      = $this->session->userdata('id');
		  $where_clause['ua.type']   = "2";
		  $where_clause['ua.status'] = "1";
		  $where_clause['vd.status'] = "1";
          
          $vehiclefulldata = $this->Gps_model->vehicle_group_join("vd.id as id,vd.description,vd.station_id,d.id as group_id,d.name as group_name,st.station_name",$where_clause);
 		  
 		  // fetching vehicle data ends

 		  // fetching vehicle status starts

		  $pullitems="vgi1.`vehicle_id`,vgi1.speed,vgi1.ign_status";
 		  $gps_cordinate= $this->Gps_model->gps_lastrow($pullitems);  // doubt
 		  
 		  // fetching vehicle status ends 

 		  $data['fleets_status']="0";  // doubt

 		 // arranging vehicle widget starts 

   		  if(count($vehiclefulldata)>0){
  		    $data['fleets_status']="1";
    		    foreach($vehiclefulldata as $vehicle_key=>$vehicledata){
				$color="#000000";
			    $color="#FF0800"; // red
  			    $key = array_search($vehicledata['id'], array_column($gps_cordinate, 'vehicle_id'));
     			 if($key !== false) {
					 array_push($valuable_id,$vehicledata['id']);
     			    if($gps_cordinate[$key]['ign_status']=='1'){
 				         if($gps_cordinate[$key]['speed']=="0"){
					        $color="orange";
				         }else{
					        $color="green";
				          }
			        }else
					 $color="#FF0800";
			      }
     		   $groupwise_data[$vehicledata['group_id']]['group_name']=$vehicledata['group_name']; 

			   $groupwise_data[$vehicledata['group_id']][$vehicledata['station_id']]['station_name']=$vehicledata['station_name'];
     		   $groupwise_data[$vehicledata['group_id']][$vehicledata['station_id']][$vehicledata['id']]['color']=$color;
     		   $groupwise_data[$vehicledata['group_id']][$vehicledata['station_id']][$vehicledata['id']]['description']=$vehicledata['description'];
    	    }

 

		   $data['vehicle_data']=$groupwise_data;
		    		  
		  } 
		  
		  // arranging vehicle widget ends
		   
		  //  geoffence master status check starts

 		  $geoffencewhere_clause =array();
  		  $geoffencewhere_clause['u.id']=$this->session->userdata('id');
		  $geoffencewhere_clause['ua.type']="4";
		  $geoffencewhere_clause['ua.status']="1";
   		  $geoffence_status =$this->Gps_model->master_join("ua.status",$geoffencewhere_clause);
   		  
		  //  geoffence master status check ends
		  
		  //  geoffence create status check starts

		  $geoffencecreatewhere_clause =array();
  		  $geoffencecreatewhere_clause['u.id']=$this->session->userdata('id');
		  $geoffencecreatewhere_clause['ua.type']="6";
    	  $geoffencecreate_status=$this->Gps_model->master_join("ua.status",$geoffencecreatewhere_clause);

    	  //  geoffence create status check ends

    	  //  shipping status check starts
 		  
		  $shippingwhere_clause =array();
  		  $shippingwhere_clause['u.id']=$this->session->userdata('id');
		  $shippingwhere_clause['ua.type']="7";
		   
   		  $shipping_status = $this->Gps_model->master_join("ua.status",$shippingwhere_clause);

    	  //  shipping status check ends
   		  
    	  //  report status check starts   		  
 
		  $reportwhere_clause=array();
		  $reportwhere_clause['u.id']=$this->session->userdata('id');
		  $reportwhere_clause['ua.type']="3";
		  $reportwhere_clause['ua.status']="1";
 		  $report_status = $this->Gps_model->master_join("ua.controll_id",$reportwhere_clause);

    	  //  report status check ends   		  

 
		  $data['report_status']   = "0";
		  $data['geoffencestatus'] = "0";
		 
 		  if(count($report_status)>0){
			   $data['report_status']="1";
		  }
  		  if($geoffence_status[0]['status']=="1"){
			  $data['geoffencestatus']="1";
		  }
		  
		  $data['geoffencecreate_status']=$geoffencecreate_status[0]['status'];
 		  $data['shipping_status']=$shipping_status[0]['status'];
		  

		  
		  
 		  $valuable_id=$this->Gps_model->gps_datacheck("vehicle_id","vehicle_gps_information","","1","","","","","vehicle_id");
  		  $data['existing_id']=implode(",",array_column($valuable_id,"vehicle_id"));
		  
		  $data['geoffence']= $this->Gps_model->gps_datacheck("id,name,boundaries","geoffence","","1");
   		  $data['customer']= $this->Gps_model->gps_datacheck("id,cust_name","customer_name","","1");
		  $wheregeoffence_group['status']="1";
		  $data['geo_group']= $this->Gps_model->gps_datacheck("id,Name","Geoffence_group",$wheregeoffence_group,"1");
		  // echo "<pre>"; print_r($data);die;
 		  if($dom_id=="1")
		    $this->load->view('svggpsview',$data);
		  else
 		    $this->load->view('gpsview',$data);

 		  
 	  }

 	  public function vehiclestatusgraph()
 	  {
 	  	$stopcount    = 0;
 	  	$idlecount    = 0;
 	  	$runningcount = 0;

 	  	$whereworkshop['workshop_status'] = "1";
 	  	$workshopcountarray               = $this->Gps_model->gps_datacheck("id","vehicle_data",$whereworkshop,"1");	
 	  	$workshopcount                    = count($workshopcountarray);
 		
 	  	$wherelongstop['longstop_status'] = "1";
 	  	$longstopcountarray               = $this->Gps_model->gps_datacheck("id","vehicle_data",$wherelongstop,"1");	
 	  	$longstopcount                    = count($longstopcountarray);

 	  	$where['workshop_status!=']       = "1";
 	  	$where['longstop_status!=']       = "1";
 	  	$activevehiclearray               = $this->Gps_model->gps_datacheck("id","vehicle_data",$where,"1");	


 	  	foreach ($activevehiclearray as $activevehiclearray) 
 	  	{
 	  		$wherevehicle['vehicle_id']   = $activevehiclearray['id'];
 	  		$vehicleinfoarray             = $this->Gps_model->gps_datacheck("speed,ign_status","vehicle_gps_information_temp",$wherevehicle);

 	  		if($vehicleinfoarray['ign_status'] == "0")
 	  		{
 	  			$stopcount += 1;
 	  		}
 	  		else if(($vehicleinfoarray['ign_status'] == "1") &&($vehicleinfoarray['speed'] == "0"))
 	  		{
 	  			$idlecount += 1;  			
 	  		}
 	  		else
 	  		{
 	  			$runningcount += 1;
 	  		}
 	  	}

 	  	$resultarray = [
						"stopcount"     => $stopcount, 	  		
						"idlecount"     => $idlecount, 	  		
						"runningcount"  => $runningcount, 	  		
						"workshopcount" => $workshopcount, 	  		
						"longstopcount" => $longstopcount 	  		
 	  				   ];

 	 	print json_encode($resultarray);
 	 	die(); 	  	

 	  }
	  
	  
	  
	  public function manual_check($id,$limit1,$limit2){
		  $where['vehicle_id']=$id;
		  $where['device_timestamp!=']="NaN";
		  $where['device_timestamp>=']="1537390800000";
		  $where['lattitude>']="23";
		  $where['lattitude<']="27";
		  $orderby="device_timestamp desc";
		  //$limit="600";
		  $this->prev_time="";
		  $full_data=$this->Gps_model->gps_datacheck("*","vehicle_gps_information",$where,"1",$orderby,$limit1,"",$limit2);
	
		  foreach($full_data as $full_key=>$datainfo){
			  $where_vehicle['id']=$id;
			   $vehicles_data=$this->Gps_model->gps_datacheck("name","vehicle_data",$where_vehicle);
			  
 			  $vehicles_gps[$full_key]["id"]=$datainfo['id'];
			  $vehicles_gps[$full_key]["vehicle_id"]=$datainfo['vehicle_id'];
			  $vehicles_gps[$full_key]["name"]=$vehicles_data['name'];
			  $vehicles_gps[$full_key]["device_timestamp"]=$datainfo['device_timestamp']=="NaN"?"NaN":date("d-m-Y h:i:s a", (round($datainfo['device_timestamp']/1000)));
			  $vehicles_gps[$full_key]["lattitude"]=$datainfo['lattitude'];
			  $vehicles_gps[$full_key]["lognitude"]=$datainfo['lognitude'];
			  $vehicles_gps[$full_key]["speed"]=$datainfo['speed'];
			  $vehicles_gps[$full_key]["odometer"]=$datainfo['odometer'];
			  $vehicles_gps[$full_key]["manual_odometer"]=$datainfo['manual_odometer'];
			  $vehicles_gps[$full_key]["external_power"]=$datainfo['external_power'];
			  $vehicles_gps[$full_key]["battery_power"]=$datainfo['battery_power'];
 			  $vehicles_gps[$full_key]["ign_status"]=$datainfo['ign_status']=="1"?"ON":"OFF";
			  $vehicles_gps[$full_key]["movement"]=$datainfo['movement']=="1"?"ON":"OFF";
			  $vehicles_gps[$full_key]["acceleration"]=$datainfo['acceleration']=="1"?"ON":"OFF";
			  $vehicles_gps[$full_key]["hash_breaking"]=$datainfo['hash_breaking']=="1"?"ON":"OFF";
			  $vehicles_gps[$full_key]["idling"]=$datainfo['idling']=="1"?"ON":"OFF";
			  $vehicles_gps[$full_key]["Heading"]=$datainfo['Heading'];
			  $vehicles_gps[$full_key]["altitude"]=$datainfo['altitude'];
			  $vehicles_gps[$full_key]["generated_event"]=$datainfo['generated_event'];
			  $vehicles_gps[$full_key]["generated_event_value"]=$datainfo['generated_event_value'];
			  $vehicles_gps[$full_key]["satelite"]=$datainfo['satelite'];
			  $vehicles_gps[$full_key]["rev_status"]=$datainfo['rev_status']=='0'?"Forward":"Reverse";
			  $vehicles_gps[$full_key]["unplug"]=$datainfo['unpluged']=="1"?"ON":"OFF";
			  
 			  
			 // $vehicles_gps[$full_key]["duration"]=(((strtotime($datainfo['created'])*1000)-$datainfo['device_timestamp'])/1000);
			  $time_interval=($this->prev_time-$datainfo['device_timestamp'])/1000;
 			       $second = 1;
                   $minute = 60*$second;
                   $hour   = 60*$minute;
			  
			  $stop_hrs   = floor(($time_interval)/$hour)<10?"0".floor(($time_interval)/$hour):floor(($time_interval)/$hour);
              $stop_min = floor(($time_interval%$hour)/$minute)<10?"0".floor(($time_interval%$hour)/$minute):floor(($time_interval%$hour)/$minute);
              $stop_sec = floor((($time_interval%$hour)%$minute)/$second)<10?"0".floor((($time_interval%$hour)%$minute)/$second):floor((($time_interval%$hour)%$minute)/$second);
 			  $differences=(((strtotime($datainfo['created'])*1000)-$datainfo['device_timestamp'])/1000);
 			  $stop_hrs1   = floor(($differences)/$hour)<10?"0".floor(($differences)/$hour):floor(($differences)/$hour);
              $stop_min1 = floor(($differences%$hour)/$minute)<10?"0".floor(($differences%$hour)/$minute):floor(($differences%$hour)/$minute);
              $stop_sec1 = floor((($differences%$hour)%$minute)/$second)<10?"0".floor((($differences%$hour)%$minute)/$second):floor((($differences%$hour)%$minute)/$second);
  			  $vehicles_gps[$full_key]["duration"]= $stop_hrs.":".$stop_min.":".$stop_sec;
 			  $vehicles_gps[$full_key]["difference"]=$stop_hrs1.":".$stop_min1.":".$stop_sec1;
			  $vehicles_gps[$full_key]["created"]=$datainfo['created'];
			  $vehicles_gps[$full_key]["datastring"]=$datainfo['datasrting'];
			  $this->prev_time=$datainfo['device_timestamp'];
		  }
 		  
		  $data['full_info']=$vehicles_gps;
		  $this->load->view('fulldata',$data);
 		  die();
 		  
	  }
	  
 	   
	   
	   public function get_lastpositions(){
		   
 		  /* print "<pre>"; print_r($this->input->post());
		   
		   die();*/
		   $full_vehicle_array=explode(",",$this->input->post('vehicle'));
		   $allowed_array=explode(",",$this->input->post('vehicle_exist'));
           $full_array= array_intersect($full_vehicle_array,$allowed_array);
		   
 		   $lasttime_stamp=$this->session->userdata("lasttime_stamp");
		   $vehicle_fulldata=array();
		   $wherefull="";
		   $totaldata=count($full_array);
		   if($totaldata>0){
 		     foreach($full_array as $key=>$vehicle_id){
			    $timestamp="0";  
 				 $lasttime_stamp=$this->session->userdata("lasttime_stamp");
 				 if(isset($lasttime_stamp[$vehicle_id])){
					 $timestamp=$lasttime_stamp[$vehicle_id];
				 }
				 $wherefull.='(vgi.`vehicle_id`="'.$vehicle_id.'" and vgi.`device_timestamp`>"'.$timestamp.'")  or ';
 		     }
			 
			 $where=substr($wherefull,0,(strlen($wherefull)-4));
 			 $whereclause=implode(" or `vd`.`id`= ",$full_array);
			 
			 $vehicle_data=$this->Gps_model->vehicle_external_details($whereclause);
			 
 			 $last_datas= $this->Gps_model->gps_lastrows($where);
			 
			
   		     if(count($last_datas)>0){
     			 foreach($last_datas as $finalkey => $finaldatas){
					 $push_data_flag="1";
					 $current_data=array();
					 
					  $vehicle_id=$finaldatas['vehicle_id'];
					  if(empty($vehicle_fulldata[$vehicle_id])){
 						 $vehicle_fulldata[$vehicle_id]=array();
					 }
					  $key = array_search($finaldatas['vehicle_id'], array_column($vehicle_data, 'id'));
					  
					  
					 if(!empty($this->session->userdata("lasttime_stamp")))
 					    $lasttime_stamp=$this->session->userdata("lasttime_stamp");
					 else
					    $lasttime_stamp=array();
   					 $lasttime_stamp[$vehicle_id]=$finaldatas['device_timestamp'];
					 
  				      $this->session->set_userdata("lasttime_stamp",$lasttime_stamp);
					  
					  
					  $current_data['name']=$vehicle_data[$key]['name'];
					  $current_data['description']=$vehicle_data[$key]['description'];
					  $current_data['group_id']=$vehicle_data[$key]['group_id'];
 					  $current_data['group_name']=$vehicle_data[$key]['group_name'];
					  $current_data['department_id']=$vehicle_data[$key]['department_id'];

                     if(isset($finaldatas['drivername']) && $finaldatas['drivername']!=""){
						$current_data['drivername1']=$finaldatas['drivername'];
						$current_data['driverphone1']=$finaldatas['driverphone'];
					  }



					  $current_data['drivername']=$vehicle_data[$key]['daydrivername']." / ".$vehicle_data[$key]['nghtdrivername'];
					  $current_data['driverphone']=$vehicle_data[$key]['daydriverphone']." / ".$vehicle_data[$key]['nghtdriverphone']; 




   					  $current_data['ign_status']=$finaldatas['ign_status']=="1"?"ON":"OFF";
					  $current_data['workshop_status']=$vehicle_data[$key]['workshop_status'];
					  $current_data['longstop_status']=$vehicle_data[$key]['longstop_status'];	  
					  $current_data['speed']=$finaldatas['speed'];
					  $current_data['created']=date("d-m-Y h:i:s a", strtotime($finaldatas['created']));
					  $current_data['odometer']=$finaldatas['odometer'];
  					  $current_data['Heading']=$finaldatas['Heading'];
					  $current_data['gps_status']=$finaldatas['unpluged']=="0"?"FIXED":"NOT FIXED"; 
 					  $current_data['run']=$vehicle_data[$key]['run'];
					  $current_data['idle']=$vehicle_data[$key]['idle'];
					  $current_data['stop']=$vehicle_data[$key]['stop'];
					  $current_data['device_timestamp1']=$finaldatas['device_timestamp'];
 					  $current_data['device_timestamp']=date("d-m-Y h:i:s a", (round($finaldatas['device_timestamp']/1000)));
 					   $current_data['delay_time']=(time()-round($finaldatas['device_timestamp']/1000));
					  
					  if($finaldatas['vehicle_status']=="2"){
						$current_data['label']="Running Duration";
						
						$total_stophrs=round(($finaldatas['end_time']-$finaldatas['start_time'])/1000);
 						$second = 1;
                        $minute = 60*$second;
                        $hour   = 60*$minute;
				        $stop_hrs   = floor(($total_stophrs)/$hour)<10?"0".floor(($total_stophrs)/$hour):floor(($total_stophrs)/$hour);
                        $stop_min = floor(($total_stophrs%$hour)/$minute)<10?"0".floor(($total_stophrs%$hour)/$minute):floor(($total_stophrs%$hour)/$minute);
                        $stop_sec = floor((($total_stophrs%$hour)%$minute)/$second)<10?"0".floor((($total_stophrs%$hour)%$minute)/$second):floor((($total_stophrs%$hour)%$minute)/$second); 
						
						
  			 	        $current_data['duration']=$stop_hrs.":".$stop_min.":".$stop_sec;
						
 						
					}else if($finaldatas['vehicle_status']=="1"){
						 
						$current_data['label']="Idle Duration";
						$total_stophrs=round(($finaldatas['end_time']-$finaldatas['start_time'])/1000);
 						$second = 1;
                        $minute = 60*$second;
                        $hour   = 60*$minute;
				        $stop_hrs   = floor(($total_stophrs)/$hour)<10?"0".floor(($total_stophrs)/$hour):floor(($total_stophrs)/$hour);
                        $stop_min = floor(($total_stophrs%$hour)/$minute)<10?"0".floor(($total_stophrs%$hour)/$minute):floor(($total_stophrs%$hour)/$minute);
                        $stop_sec = floor((($total_stophrs%$hour)%$minute)/$second)<10?"0".floor((($total_stophrs%$hour)%$minute)/$second):floor((($total_stophrs%$hour)%$minute)/$second); 
						
						
  			 	        $current_data['duration']=$stop_hrs.":".$stop_min.":".$stop_sec;
						
					}
					else if($finaldatas['vehicle_status']=="3"){
						$current_data['label']="Stop Duration";
						$total_stophrs=round(($finaldatas['end_time']-$finaldatas['start_time'])/1000);
 						$second = 1;
                        $minute = 60*$second;
                        $hour   = 60*$minute;
				        $stop_hrs   = floor(($total_stophrs)/$hour)<10?"0".floor(($total_stophrs)/$hour):floor(($total_stophrs)/$hour);
                        $stop_min = floor(($total_stophrs%$hour)/$minute)<10?"0".floor(($total_stophrs%$hour)/$minute):floor(($total_stophrs%$hour)/$minute);
                        $stop_sec = floor((($total_stophrs%$hour)%$minute)/$second)<10?"0".floor((($total_stophrs%$hour)%$minute)/$second):floor((($total_stophrs%$hour)%$minute)/$second); 
						
						
  			 	        $current_data['duration']=$stop_hrs.":".$stop_min.":".$stop_sec;
					}
					
 					if($finaldatas['satelite']>7){
					     $current_data['lat']=$finaldatas['lattitude'];
					     $current_data['logn']=$finaldatas['lognitude'];
					}else{
						  $where_satelite['vehicle_id']=$finaldatas['vehicle_id'];
						  $where_satelite['satelite>']='7';
						  $orderby="device_timestamp desc";
						  $limit="1";
						  $latest_data_lat=$this->Gps_model->gps_datacheck("lattitude,lognitude","vehicle_gps_information",$where_satelite,"",$orderby,$limit);
  						  if(count($latest_data_lat)>0){
							  
 						     $current_data['lat']=$latest_data_lat['lattitude'];
					         $current_data['logn']=$latest_data_lat['lognitude'];
							 
						  }else if((int)$finaldatas['lattitude']>23 && (int) $finaldatas['lattitude'] <27 &&  (int)$finaldatas['lognitude']>49 && (int)$finaldatas['lognitude'] <55 ){
							 $current_data['lat']=$finaldatas['lattitude'];
					         $current_data['logn']=$finaldatas['lognitude'];
						  }else{
							 
							  $push_data_flag="0";
						  }
					}
					
					if($push_data_flag=="1"){
  					  array_push($vehicle_fulldata[$vehicle_id],$current_data);
					}
					 
 					  
  				 }
			  }
		   }
 		    print json_encode( $vehicle_fulldata);
 			  die();
 	   }
	   
	    
	   public function get_position(){
		   
		  
  		     $full_vehicle_array=explode(",",$this->input->post('vehicle'));
		     $allowed_array=explode(",",$this->input->post('vehicle_exist'));
             $full_array= array_intersect($full_vehicle_array,$allowed_array);
			 
			 
 			 $vehicle_fulldata=array();
 			 $where=count($full_array)>0?implode(" or `vgi1`.`vehicle_id`= ",$full_array):"0";
			 $whereclause=count($full_array)>0?implode(" or `vd`.`id`= ",$full_array):"";
			 $now=round(microtime(true) * 1000);
			 // print "start execution on".$now."\r\n";
			 $vehicle_data=$this->Gps_model->vehicle_external_details($whereclause);
			 $pullitems="vgi1.`vehicle_id`,vgi1.device_timestamp,vgi1.lattitude,vgi1.lognitude,vgi1.speed,vgi1.ign_status,vgi1.Heading,vgi1.satelite,vgi1.odometer,vgi1.unpluged,vgi1.created,vs.status as vehicle_status,vs.start_time,vs.end_time,d.Name as drivername,d.phone as driverphone";

			 $last_datas= $this->Gps_model->gps_lastrow($pullitems,$where);
			 
			  
 			 // print "<pre>"; print_r($vehicle_data);
 			 $total=count($last_datas);
 			  //print "<pre>"; print_r($last_datas);
 			 // print "got the data from database ".round(microtime(true) * 1000)."\r\n";
			 
			 
 			 if($total>0){
				 
				 $vehicle_status=array();
    			 foreach($last_datas as $finalkey => $finaldatas){
					 $push_data_flag="1";
 					 $current_data=array(); 
					 
 					$vehicle_id=$finaldatas['vehicle_id'];
					  
				   if(empty($vehicle_fulldata[$vehicle_id])){
					   $vehicle_fulldata[$vehicle_id]=array();
				   }
				   $key = array_search($finaldatas['vehicle_id'], array_column($vehicle_data, 'id'));
				   
				   if(!empty($this->session->userdata("lasttime_stamp")))
					  $lasttime_stamp=$this->session->userdata("lasttime_stamp");
				   else
					  $lasttime_stamp=array();
					  
				   $lasttime_stamp[$vehicle_id]=$finaldatas['device_timestamp'];
				    
					
					 
					$this->session->set_userdata("lasttime_stamp",$lasttime_stamp);
   					$current_data['name']=$vehicle_data[$key]['name'];
					$current_data['description']=$vehicle_data[$key]['description'];
					$current_data['group_id']=$vehicle_data[$key]['group_id'];
 					$current_data['group_name']=$vehicle_data[$key]['group_name'];
					$current_data['department_id']=$vehicle_data[$key]['department_id'];

					if(isset($finaldatas['drivername']) && $finaldatas['drivername']!=""){
						$current_data['drivername1']=$finaldatas['drivername'];
						$current_data['driverphone1']=$finaldatas['driverphone'];
					}


					$current_data['drivername']=$vehicle_data[$key]['daydrivername']." / ".$vehicle_data[$key]['nghtdrivername'];
					$current_data['driverphone']=$vehicle_data[$key]['daydriverphone']." / ".$vehicle_data[$key]['nghtdriverphone'];




 					$current_data['ign_status']=$finaldatas['ign_status']=="1"?"ON":"OFF";
 					$current_data['workshop_status']=$vehicle_data[$key]['workshop_status'];
 					$current_data['longstop_status']=$vehicle_data[$key]['longstop_status'];	
 					$current_data['speed']=$finaldatas['speed'];
					$current_data['created']=date("d-m-Y h:i:s a", strtotime($finaldatas['created']));
					$current_data['odometer']=$finaldatas['odometer'];
 					$current_data['Heading']=$finaldatas['Heading'];
				    $current_data['gps_status']=$finaldatas['unpluged']=="0"?"FIXED":"NOT FIXED"; 
 					$current_data['run']=$vehicle_data[$key]['run'];
					$current_data['idle']=$vehicle_data[$key]['idle'];
					$current_data['stop']=$vehicle_data[$key]['stop'];
				    $current_data['device_timestamp1']=$finaldatas['device_timestamp'];
 					$current_data['device_timestamp']=date("d-m-Y h:i:s a", (round($finaldatas['device_timestamp']/1000)));
					
					$current_data['delay_time']=(time()-round($finaldatas['device_timestamp']/1000));
					
					
					
					  
					if($finaldatas['vehicle_status']=="2"){
						$current_data['label']="Running Duration";
						
						$total_stophrs=round(($finaldatas['end_time']-$finaldatas['start_time'])/1000);
						 
 						$second = 1;
                        $minute = 60*$second;
                        $hour   = 60*$minute;
				        $stop_hrs   = floor(($total_stophrs)/$hour)<10?"0".floor(($total_stophrs)/$hour):floor(($total_stophrs)/$hour);
                        $stop_min = floor(($total_stophrs%$hour)/$minute)<10?"0".floor(($total_stophrs%$hour)/$minute):floor(($total_stophrs%$hour)/$minute);
                        $stop_sec = floor((($total_stophrs%$hour)%$minute)/$second)<10?"0".floor((($total_stophrs%$hour)%$minute)/$second):floor((($total_stophrs%$hour)%$minute)/$second); 
						
						
  			 	        $current_data['duration']=$stop_hrs.":".$stop_min.":".$stop_sec;
						
 						
					}else if($finaldatas['vehicle_status']=="1"){
						 
						$current_data['label']="Idle Duration";
						$total_stophrs=round(($finaldatas['end_time']-$finaldatas['start_time'])/1000);
 						$second = 1;
                        $minute = 60*$second;
                        $hour   = 60*$minute;
				        $stop_hrs   = floor(($total_stophrs)/$hour)<10?"0".floor(($total_stophrs)/$hour):floor(($total_stophrs)/$hour);
                        $stop_min = floor(($total_stophrs%$hour)/$minute)<10?"0".floor(($total_stophrs%$hour)/$minute):floor(($total_stophrs%$hour)/$minute);
                        $stop_sec = floor((($total_stophrs%$hour)%$minute)/$second)<10?"0".floor((($total_stophrs%$hour)%$minute)/$second):floor((($total_stophrs%$hour)%$minute)/$second); 
						
						
  			 	        $current_data['duration']=$stop_hrs.":".$stop_min.":".$stop_sec;
						
					}
					else if($finaldatas['vehicle_status']=="3"){
					 
						$current_data['label']="Stop Duration";
						$total_stophrs=round(($finaldatas['end_time']-$finaldatas['start_time'])/1000);
 						$second = 1;
                        $minute = 60*$second;
                        $hour   = 60*$minute;
				        $stop_hrs   = floor(($total_stophrs)/$hour)<10?"0".floor(($total_stophrs)/$hour):floor(($total_stophrs)/$hour);
                        $stop_min = floor(($total_stophrs%$hour)/$minute)<10?"0".floor(($total_stophrs%$hour)/$minute):floor(($total_stophrs%$hour)/$minute);
                        $stop_sec = floor((($total_stophrs%$hour)%$minute)/$second)<10?"0".floor((($total_stophrs%$hour)%$minute)/$second):floor((($total_stophrs%$hour)%$minute)/$second); 
						
						
  			 	        $current_data['duration']=$stop_hrs.":".$stop_min.":".$stop_sec;
					}
					
					
					
 					if($finaldatas['satelite']>7){
					     $current_data['lat']=$finaldatas['lattitude'];
					     $current_data['logn']=$finaldatas['lognitude'];
					}else{
						 
						  $where_satelite['vehicle_id']=$finaldatas['vehicle_id'];
						  $where_satelite['satelite>']='7';
						  $orderby="device_timestamp desc";
						  $limit="1";
						  $latest_data_lat=$this->Gps_model->gps_datacheck("lattitude,lognitude","vehicle_gps_information",$where_satelite,"",$orderby,$limit);
  						  if(count($latest_data_lat)>0){
							  
 						     $current_data['lat']=$latest_data_lat['lattitude'];
					         $current_data['logn']=$latest_data_lat['lognitude'];
							 
						  }else if((int)$finaldatas['lattitude'] >23 && (int)$finaldatas['lattitude']<27 &&  (int)$finaldatas['lognitude']>49 && (int)$finaldatas['lognitude']<55 ){
							 $current_data['lat']=$finaldatas['lattitude'];
					         $current_data['logn']=$finaldatas['lognitude'];
						  }else{
							 
							  $push_data_flag="0";
						  }
					}
 					
					if($push_data_flag=="1"){
 					  array_push($vehicle_fulldata[$vehicle_id],$current_data);
					}
 					$now=round(microtime(true) * 1000);
 				}	
				
				
				//array_push($vehicle_fulldata["groupwise_status"],$vehicle_status);
					
			}		 
    			  print json_encode( $vehicle_fulldata);
 			  die();
 	   
	 
	}
	
	
	public function pointInPolygon($points, $polygons_data, $pointOnVertex = true) {
		
		$geoffence_ids=array();
		
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
			  array_push($geoffence_ids,$polygons_key);
          }  
 	  }
	  
	  return $geoffence_ids;
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
		$geoffence_data=$this->Gps_model->geoffence_separating($where,$orderby);
		
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
	
	   
	   
	public function shipping_status(){
		   
		   
		    $from_date=$this->input->post("from_time")!=""?strtotime($this->input->post("from_time"))*1000:"";
			
		    $to_date=strtotime("now")*1000;
			$seleceted_geoffence=$this->input->post("geoffence");
 			 //$from_date=1557176400000;
 			 //$seleceted_geoffence=array('3','83','85','95','176','177','178');
		    $geoffence_sum=array();
   
			if($from_date!="" && $to_date!="" && $seleceted_geoffence!=""){
				
			  $this->geoffence_data=$this->get_geoffence($seleceted_geoffence);
			  
 
			  $full_data="";
			  $response_result['data']=array();
			  $gpswhere_clause['va.device_timestamp>=']=$from_date;
			  $gpswhere_clause['va.device_timestamp<=']=$to_date;
			  $where_typein=array('3','4');
			  $where_geoffence_in=$seleceted_geoffence;
			  $vehiclealertfulldata= $this->Gps_model->multiple_alert_data($gpswhere_clause,$where_typein,$where_geoffence_in);
			  
			  if(count($vehiclealertfulldata)>0){
			   foreach($vehiclealertfulldata as $geoffence_key=>$geoffence_data){
				   
 				   if(!(isset($geoffence_sum[$geoffence_data['geoffence']],$geoffence_sum[$geoffence_data['geoffence']][$geoffence_data['group_name']],$geoffence_sum[$geoffence_data['geoffence']][$geoffence_data['group_name']][$geoffence_data['type']]) && is_array($geoffence_sum[$geoffence_data['geoffence']][$geoffence_data['group_name']][$geoffence_data['type']]))){
					    $geoffence_sum[$geoffence_data['geoffence']][$geoffence_data['group_name']][$geoffence_data['type']]=array();
				   }
   				array_push($geoffence_sum[$geoffence_data['geoffence']][$geoffence_data['group_name']][$geoffence_data['type']],$geoffence_data['vehicle_id']);
			   }
			  }
			  
			 
			 
            $vehiclealertfulldata= $this->Gps_model->multiple_alert_data($gpswhere_clause,$where_typein,$where_geoffence_in);
            $current_vehicle_status=$this->Gps_model->onsite_vehicle();
 			foreach($current_vehicle_status as $current_key=>$current_data){
				
				if($current_data['satelite']<7){
					 $where_satelite['vehicle_id']=$current_data['vehicle_id'];
					 $where_satelite['satelite>']='7';
					 $orderby="device_timestamp desc";
					 $limit="1";
					 $latest_data_lat=$this->Gps_model->gps_datacheck("lattitude,lognitude","vehicle_gps_information",$where_satelite,"",$orderby,$limit);
  					 if(count($latest_data_lat)>0){
							  
 						 $current_data['lattitude']=$latest_data_lat['lattitude'];
					     $current_data['lognitude']=$latest_data_lat['lognitude'];
							 
					 }else if((int)$finaldatas['lattitude'] >23 && (int)$finaldatas['lattitude']<27 &&  (int)$finaldatas['lognitude']>49 && (int)$finaldatas['lognitude']<55 ){
						 $current_data['lattitude']=$finaldatas['lattitude'];
					     $current_data['lognitude']=$finaldatas['lognitude'];
					 }else{
						 $current_data['lattitude']="";
						 $current_data['lognitude']="";
					 }
 				}
				
				if($current_data['lattitude']!="" && $current_data['lognitude']!=""){
					
					$point=$current_data['lattitude']." ".$current_data['lognitude'];
			        $geoffence_names=$this->pointInPolygon($point,$this->geoffence_data);
 					if(!empty($geoffence_names)){
					
					     if(!(isset($geoffence_sum[$geoffence_names[0]],$geoffence_sum[$geoffence_names[0]][$current_data['group_name']],$geoffence_sum[$geoffence_names[0]][$current_data['group_name']]['5']) && is_array($geoffence_sum[$geoffence_names[0]][$current_data['group_name']]['5']))){
							  $geoffence_sum[$geoffence_names[0]][$current_data['group_name']]['5']=array();
						 }
						 if(!in_array($current_data['vehicle_id'],$geoffence_sum[$geoffence_names[0]][$current_data['group_name']]['5'])){
							  array_push($geoffence_sum[$geoffence_names[0]][$current_data['group_name']]['5'],$current_data['vehicle_id']);
						 }
					}
					 
				}
				
 			}
			
 
 			   if(count($geoffence_sum)>0){
				   $geoffence_namecount=1;
			     foreach($geoffence_sum as $geoofencekey =>$geoofencedata){
					$full_data.='<tr><th colspan="5">'.$geoffence_namecount.' ) '.strtoupper($geoofencekey).'</th></tr>';
					$geoffence_count=1;
					if(is_array($geoofencedata)){
 					 foreach($geoofencedata as $groupkey=>$groupdata){
						 
  						     $total_in=count($groupdata['3']);
 						     $total_out=count($groupdata['4']);
							 $site_count=count($groupdata['5']);
   						 
 						 $full_data.='<tr><td>'.$geoffence_count.'</td> <td>'.strtoupper($groupkey).'</td> <td>'.$total_in.'</td> <td>'.$total_out.'</td> <td>'.$site_count.'</td></tr>';
						 $geoffence_count++;
 					 }
					}
					$geoffence_namecount++;
 				 }
			   }else{
				   $full_data.='<tr><th colspan="5">No Data Available</th></tr>';
			   }
 				$return['information']=$full_data;
				
			}else{
 				 $return['error_flag']="1";
				 $return['error_message']="Please fill the required field";
			}
			 
 		   print json_encode($return);
 		    die();
		   
     }
  	  
	  public function geoffencename_check(){
		   $where_clause['name']=$this->input->post("geoffence_name");
 		   $geoffence_data=$this->Gps_model->gps_datacheck("id","geoffence",$where_clause);
		   print json_encode(count($geoffence_data));
 	  }
	  
 	  
	  public function geoffence(){
		  $this->form_validation->set_rules('name', 'name', 'required');
 		  $this->form_validation->set_rules('boundaries', 'boundaries', 'required');
          $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
 		  
	       if ($this->form_validation->run() == TRUE) {
			   $where_clause['name']=$this->input->post("name");
 			   $geoffence_data=$this->Gps_model->gps_datacheck("id","geoffence",$where_clause);
			   
			   if(count($geoffence_data)<1){
					 $geoffence['name']=$this->input->post("name");
					 $geoffence['geo_group']=$this->input->post("group_id");
					 $geoffence['geofence_code']= $this->input->post('geofence_code');
					 $geoffence['color']=$this->input->post("color");  
					 $geoffence['boundaries']=$this->input->post("boundaries"); 
					 $geoffence['user']=$this->session->userdata('id'); 
					 $geoffence['created']=date("Y-m-d H:i:s"); 
					 $geoffence_insert=$this->Gps_model->db_insert("geoffence",$geoffence);
					 $model_result=explode("||",$geoffence_insert);
			   
			   
					 if($model_result[0]!= 1){
					  $return['error_flag']="1";
					  $return['message']="Some error occur.Please contact admin";
					 }else{
						 
						 $boundary_data=explode("),",$this->input->post("boundaries"));
						 $boundaries="";
						 foreach($boundary_data as $key=>$datasb){
							$cordiantes=explode("," ,str_replace("(","",$datasb) );
							$boundaries.=$cordiantes["0"].",".trim($cordiantes["1"])."|";
						 }
						 
						 $return['boundaries']=substr($boundaries,0,strlen($boundaries)-2);
						 $return['information']=$model_result[1];
						 $return['error_flag']="0";
					 }
			   }else{
				   
				   $return['error_flag']="1";
				   $return['message']="Geoffence Name Already Exist";
				   
			   }
					 
		     }else{
				 $return['error_flag']="1";
				 $return['message']="Please check the required fields";
		    }
		   
		   print json_encode( $return);
		  
	  }
	  
	  
	  public function showall_geofence(){
  		     $full_geoffence_array=explode(",",$this->input->post('geoffence'));
  			 $full_geoffence=array();
 			 $where=count($full_geoffence_array)>0?implode(" or  `id`= ",$full_geoffence_array):"0";
		     $geoffence_cordinate= $this->Gps_model->all_geoffence($where);
 			 foreach($geoffence_cordinate as $key=>$data){
				 $boundary_data=explode("),",$data['boundaries']);
			     $boundaries="";
			     foreach($boundary_data as $key=>$datasb){
 				    $cordiantes=explode("," ,str_replace("(","",$datasb) );
 				    $boundaries.=$cordiantes["0"].",".trim($cordiantes["1"])."|";
			     }
			     $full_geoffence[$data['id']]['information']=substr($boundaries,0,strlen($boundaries)-2);
			     $full_geoffence[$data['id']]['color']=strtolower($data['color']);
			     $full_geoffence[$data['id']]['name']=strtoupper($data['name']);
 			 }
	         print json_encode($full_geoffence);
 	  }
	  
	  
	  public function show_geoffence(){
		  
		  if($this->input->post('id')!=""){
			  $where_clause=array();
			  $where_clause['id']=$this->input->post('id');
			  $gps_cordinate= $this->Gps_model->gps_datacheck("boundaries,color,name","geoffence",$where_clause);
 			  $boundary_data=explode("),",$gps_cordinate['boundaries']);
			  $boundaries="";
			   foreach($boundary_data as $key=>$datasb){
 				   $cordiantes=explode("," ,str_replace("(","",$datasb) );
 				   $boundaries.=$cordiantes["0"].",".trim($cordiantes["1"])."|";
			   }
			  $return['error_flag']="0";
 			  $return['information']=substr($boundaries,0,strlen($boundaries)-2);
			  $return['color']=strtolower($gps_cordinate['color']);
			  $return['name']=strtoupper($gps_cordinate['name']);
		  }
		  else{
			    $return['error_flag']="1";
		        $return['message']="Some error occur.Please contact admin";
	      }
		   print json_encode( $return);
		  
 	  }
	  
	  function login_check(){
		  
		  $return['status']="1"; 
	      if(!$this->session->userdata('id')) {
			 $return['status']="0"; 
 		  }
		   print json_encode( $return);
	  }
	  
	  public function query_updation(){
		  
		  
		  $where_query['status']=="1";
		  $gps_cordinate= $this->Gps_model->gps_datacheck("vehicle_id,driver_id,Shift","driver_allocation",$where_query,"1");
		  $new_array=array();
		  foreach($gps_cordinate as $key=>$gps_driver){
 			$new_array[$gps_driver['vehicle_id']][$gps_driver['Shift']]=$gps_driver['driver_id'];
 		  }
		  foreach($new_array as $vehivle_id=>$vehicle_data){
			  if(!array_key_exists("0",$vehicle_data)){
				  $vehicle_data[0]="";
			  }
			 if(!array_key_exists("1",$vehicle_data)){
				  $vehicle_data[1]="";
			  }
			 krsort($vehicle_data);
			 
			 $update_data['driver_id']=implode(",",$vehicle_data);
			 $where_update['id']=$vehivle_id;
			 
			$this->Gps_model->db_update("vehicle_data",$update_data,$where_update);
 			  
			  
		  }
		  
		   //print "<pre>"; print_r($new_array);
		  
		  die();
	  }
 
	  
 }