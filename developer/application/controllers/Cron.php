<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
 	public function __construct()
    {
		parent::__construct();
  		$this->load->model('cron_model');
 		$this->load->helper('url');
		//ini_set('memory_limit', '-1');
	}
	
	public function test(){
		$file_name="cronid.txt";
		$fp=fopen($file_name,"r") or die("file open failed");
 		$content = fread($fp, filesize($file_name));
 		fclose($fp);
  		if($content!=""){
			$where['vgi.id>']=$content;
		}else{
			$where['vgi.id>=']=0;
		}
 		$gps_full_data=$this->cron_model->full_data($where);
		
	 
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


    public function get_geoffence_manual(){
      

        $where['id']="377";
    	$geoffence_data=$this->cron_model->db_datacheck("id,boundaries","geoffence",$where);
  		foreach($geoffence_data as $geoffence_key => $geoffence_datas){
 			$geoffence[$geoffence_datas['id']]=array();
 			$boundaries=explode("),(",$geoffence_datas['boundaries']);
			
 			foreach($boundaries as $boundaries_data){
 				$boundaries_data=str_replace("(","",$boundaries_data);
				$boundaries_data=str_replace(")","",$boundaries_data);
				$boundaries_data=str_replace(",","",$boundaries_data);
				array_push($geoffence[$geoffence_datas['id']],trim($boundaries_data));
				
			}
 			    $boundaries_data=str_replace("(","",$boundaries[0]);
				$boundaries_data=str_replace(")","",$boundaries_data);
				$boundaries_data=str_replace(",","",$boundaries_data);
			    array_push($geoffence[$geoffence_datas['id']],trim($boundaries_data));
 		}
		
		return $geoffence;

    }
	
	
	
	public function get_geoffence($flag=""){
 		if($flag!="1"){
 		  $exist_geoffence=$this->cron_model->db_datacheck("geoffence","alert_settings");
		  $geoffence_exist=array();
		  if(count($exist_geoffence)>0){
		    foreach($exist_geoffence as $key=>$data){
 			  $fulldata=explode(",",$data['geoffence']);
			  $geoffence_exist=array_merge($geoffence_exist, $fulldata);
		   }
 		  }
 		  $geoffence_data=$this->cron_model->db_geoffence_data("id,boundaries","geoffence",$geoffence_exist);
		}else{
			$geoffence_data=$this->cron_model->db_geoffence_data("id,boundaries","geoffence","");
		}
  		foreach($geoffence_data as $geoffence_key => $geoffence_datas){
 			$geoffence[$geoffence_datas['id']]=array();
 			$boundaries=explode("),(",$geoffence_datas['boundaries']);
			
 			foreach($boundaries as $boundaries_data){
 				$boundaries_data=str_replace("(","",$boundaries_data);
				$boundaries_data=str_replace(")","",$boundaries_data);
				$boundaries_data=str_replace(",","",$boundaries_data);
				array_push($geoffence[$geoffence_datas['id']],trim($boundaries_data));
				
			}
 			    $boundaries_data=str_replace("(","",$boundaries[0]);
				$boundaries_data=str_replace(")","",$boundaries_data);
				$boundaries_data=str_replace(",","",$boundaries_data);
			    array_push($geoffence[$geoffence_datas['id']],trim($boundaries_data));
 		}
		
		return $geoffence;
 	} 
	
	

    public function mail_checking(){
     	$whereemail_settings['id']="1";
		$mail_settings=$this->cron_model->db_datacheck('Host,User_name,Password,from_addr,Mail_name','Mail_settings',$whereemail_settings,1);		 
 		$this->load->library('email');
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = $mail_settings['Host'];
		$config['smtp_user'] = $mail_settings['User_name'];
		$config['smtp_pass'] = $mail_settings['Password'];
		$config['smtp_port'] = '25';
		$config['mailtype']  = 'html';
		$config['charset']  = 'iso-8859-1';
		$this->email->initialize($config);//initializing the mail configuration
		$nodata_sub="test mail";
		$nodata_cont="testing";
         $this->email->from("gps@watancon.com","GPS check");
		 $email_to['0']="dinto@watancon.com";
		 $this->email->to($email_to);
		 $this->email->subject($nodata_sub);
		 $this->email->message($nodata_cont);
 				
	    if($this->email->send()){		 
	         print "success";
		    die();
	    }else{
	     print "error";
	     print $this->email->print_debugger();
		  
		     
	    }

    }





/* this function is used rerun the previous data for adding the latest geoffence */
     public function cron_alerts_manual(){
       
      	ini_set('memory_limit', '-1');
 		$geoffence_data=$this->get_geoffence_manual();//getting the geoffence data
         
        $where['vgi.device_timestamp>=']=1614722400000;
 	    $where['vgi.device_timestamp<=']=1614736800000;
 	    $this->lattitude="";
		$this->lognitude="";
		$this->vehicle_id="";




		$gps_full_data=$this->cron_model->full_data($where);
				// print "<pre>"; print_r($geoffence_data);
		// die();
		
		if(count($gps_full_data)>0){

			 $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
			 
			  foreach($gps_full_data as $gps_data_key =>$gps_data){
 				 // print $gps_data['id']."<br/>";
				  $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
 

				  if(isset($lattitude[$gps_data['vehicle_id']]) &&  $lattitude[$gps_data['vehicle_id']]!=""  && isset($lognitude[$gps_data['vehicle_id']]) && $lognitude[$gps_data['vehicle_id']]!=""){   
				 
					   $type="";
					   $geoffence_id="";
					   $first_point="";
					   $second_point="";
					   
					   $point1=$lattitude[$gps_data['vehicle_id']]." ".$lognitude[$gps_data['vehicle_id']];
					   $first_point=$this->pointInPolygon($point1,$geoffence_data);
					   $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
					   $second_point=$this->pointInPolygon($point2,$geoffence_data);
					   $entry_array = array_diff($second_point, $first_point);
					   $exit_array=array_diff($first_point, $second_point);
					   
					   if(count($entry_array)>0){
						   $type="3";
					   }
					   
					   if(count($exit_array)>0){
						   $type="4";
					   }
 					   
					   	/*geoffence Exit  mailling*/
 					   if(count($exit_array)>0){
						 foreach($exit_array as $exitkey=>$exitdata){
						   $geoffence_id=$exitdata;
 
						   if($geoffence_id!=""){
							  $geoffencealert_existwhere['vehicle_gps_id']=$gps_data['id'];
							  $geoffencealert_existwhere['type']=4;
							  $geoffencealert_existwhere['geoffence_id']=$geoffence_id;
							  $geoffencealert_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$geoffencealert_existwhere);
							  if(count($geoffencealert_exist)<1){

							  	print "entered new one on exist <br/>";;
								 $geoffence['vehicle_gps_id']=$gps_data['id'];
								 $geoffence['vehicle_id']=$gps_data['vehicle_id'];
								 $geoffence['type']="4";
								 $geoffence['device_timestamp']=$gps_data['device_timestamp'];
								 $geoffence['speed']=$gps_data['speed'];
								 $geoffence['driver_id']=$gps_data['driver_id'];
								 $geoffence['geoffence_id']=$geoffence_id;
								 $geoffence['created']=date("Y-m-d H:i:s");
								 $this->cron_model->db_insert("vehicle_alerts",$geoffence);
							  }else{
							  	print "already entered on exist <br/>";
							  }
						   }
						 }
					   }
 					   /*End of geoffence Exit  mailling*/
 					   
					   /* geoffence entry  mailling*/
					   if(count($entry_array)>0){
						 foreach($entry_array as $entrykey=>$entrydata){
						   $geoffence_id=$entrydata;
						   $geoofence_mail_status['vehicle_group']=$gps_data['group_id'];
						   $geoffence_cont_data=$this->cron_model->geoffence_data_check_new("id,speed,triger,Template,TO_mail,CC_mail,speed_alert",$geoofence_mail_status,$geoffence_id);        
			
						   if($geoffence_id!=""){
							  $geoffencealert_existwhere['vehicle_gps_id']=$gps_data['id'];
							  $geoffencealert_existwhere['type']=3;
							  $geoffencealert_existwhere['geoffence_id']=$geoffence_id;
							  $geoffencealert_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$geoffencealert_existwhere);
							  if(count($geoffencealert_exist)<1){
							  	print "entered new one on Entry <br/>";
								 $geoffence['vehicle_gps_id']=$gps_data['id'];
								 $geoffence['vehicle_id']=$gps_data['vehicle_id'];
								 $geoffence['type']="3";
								 $geoffence['device_timestamp']=$gps_data['device_timestamp'];
								 $geoffence['speed']=$gps_data['speed'];
								 $geoffence['driver_id']=$gps_data['driver_id'];
								 $geoffence['geoffence_id']=$geoffence_id;
								 $geoffence['created']=date("Y-m-d H:i:s");
								 $this->cron_model->db_insert("vehicle_alerts",$geoffence);
							  }
							  else{
							  	print "already entered on Entry <br/>";
							  }
						   }
						 }
					   }
					   
					   /* End of geoffence entry  mailling*/
 		 
			          $lattitude[$gps_data['vehicle_id']]= $gps_data['lattitude'];
			          $lognitude[$gps_data['vehicle_id']]= $gps_data['lognitude'];
			          $speed[$gps_data['vehicle_id']]=$gps_data['speed'];
					 
			      }else{
 					 $firstpos_where['id<']=$gps_data['id'];
					 $firstpos_where['vehicle_id']=$gps_data['vehicle_id'];
					 $order_by="device_timestamp desc";
					 $limit="1";
					 $get_position=$this->cron_model->db_datacheck("lattitude,lognitude","vehicle_gps_information",$firstpos_where,"1",$order_by,$limit);
					 $lattitude[$gps_data['vehicle_id']]= $get_position['lattitude'];
					 $lognitude[$gps_data['vehicle_id']]= $get_position['lognitude'];
			      }
 
			 }

		}

   }

   /* END manual script */






 	
	public function cron_alerts($fromid="", $toid=""){
		
		
 		//ini_set('memory_limit','3072M');
 		//$initial_memorylimit= ini_get("memory_limit");
		ini_set('memory_limit', '-1');
 		$geoffence_data=$this->get_geoffence();//getting the geoffence data
        $geoffence_data_alert=$this->get_geoffence("1");
  
		/* setting the Mail Configuration */
		$whereemail_settings['id']="1";
		$mail_settings=$this->cron_model->db_datacheck('Host,User_name,Password,from_addr,Mail_name','Mail_settings',$whereemail_settings,1);
		$this->load->library('email');
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = $mail_settings['Host'];
		$config['smtp_user'] = $mail_settings['User_name'];
		$config['smtp_pass'] = $mail_settings['Password'];
		$config['smtp_port'] = '25';
		$config['mailtype']  = 'html';
		$config['charset']  = 'iso-8859-1';
		$this->email->initialize($config);//initializing the mail configuration
		/* setting the end of Mail Configuration */
		
		
		$file_name="cronid.txt";
		$fp=fopen($file_name,"r") or die("file open failed");
 		$content = fread($fp, filesize($file_name));
 		fclose($fp);


 		if($fromid!=""){
 			 $where['vgi.id>=']=$fromid;
 			 $where['vgi.id<=']=$toid;

 		}else{
 			if($content!=""){
			   $where['vgi.id>']=$content;
		    }else{
			   $where['vgi.id>=']=0;
		    }
 		}
    	
	 
		//$where['vgi.id>']="40934886";
		$this->lattitude="";
		$this->lognitude="";
		$this->vehicle_id="";
		
		
 		$gps_full_data=$this->cron_model->full_data($where);
		
		if(count($gps_full_data)>0){
			
 			  foreach($gps_full_data as $gps_data_key =>$gps_data){
 				  print $gps_data['id']."<br/>";
 				   
				  
				  $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
				  $geoffece_datat_id=$this->pointInPolygon($point2,$geoffence_data_alert);
				  //print "<pre>"; print_r($geoffece_datat_id);
				  $geoffence_alert_id=$geoffece_datat_id['0'];
			   
				  if($gps_data['acceleration']==1){
					  $datacheck_accelerationwhere['vehicle_gps_id']=$gps_data['id'];
					  $datacheck_accelerationwhere['type']="2";
					  $data_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$datacheck_accelerationwhere);
					  if(count($data_exist)<1){
						$acceleration_insert['vehicle_gps_id']=$gps_data['id'];
						$acceleration_insert['vehicle_id']=$gps_data['vehicle_id'];
						$acceleration_insert['type']="2";
						$acceleration_insert['device_timestamp']=$gps_data['device_timestamp'];
						$acceleration_insert['speed']=$gps_data['speed'];
						$acceleration_insert['driver_id']=$gps_data['driver_id'];
						$acceleration_insert['geoffence_id']=$geoffence_alert_id;
						$acceleration_insert['created']=date("Y-m-d H:i:s");
						 $this->cron_model->db_insert("vehicle_alerts",$acceleration_insert);
					 }
				  }
				 //checking hash break alert
				  if($gps_data['hash_breaking']==1){
					  $datacheck_hashbreakwhere['vehicle_gps_id']=$gps_data['id'];
					  $datacheck_hashbreakwhere['type']="1";
					  $datahashbreak_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$datacheck_hashbreakwhere);
					  if(count($datahashbreak_exist)<1){
						$hashbreak_insert['vehicle_gps_id']=$gps_data['id'];
						$hashbreak_insert['vehicle_id']=$gps_data['vehicle_id'];
						$hashbreak_insert['type']="1";
						$hashbreak_insert['device_timestamp']=$gps_data['device_timestamp'];
						$hashbreak_insert['geoffence_id']=$geoffence_alert_id;
						$hashbreak_insert['speed']=$gps_data['speed'];
						$hashbreak_insert['driver_id']=$gps_data['driver_id'];
						$hashbreak_insert['created']=date("Y-m-d H:i:s");
						$this->cron_model->db_insert("vehicle_alerts",$hashbreak_insert);
					 }
				  }
				 
				  if(isset($lattitude[$gps_data['vehicle_id']]) &&  $lattitude[$gps_data['vehicle_id']]!=""  && isset($lognitude[$gps_data['vehicle_id']]) && $lognitude[$gps_data['vehicle_id']]!=""){   
				 
					   $type="";
					   $geoffence_id="";
					   $first_point="";
					   $second_point="";
					   
					   $point1=$lattitude[$gps_data['vehicle_id']]." ".$lognitude[$gps_data['vehicle_id']];
					   $first_point=$this->pointInPolygon($point1,$geoffence_data);
					   $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
					   $second_point=$this->pointInPolygon($point2,$geoffence_data);
					   $entry_array = array_diff($second_point, $first_point);
					   $exit_array=array_diff($first_point, $second_point);
					   
					   if(count($entry_array)>0){
						   $type="3";
					   }
					   
					   if(count($exit_array)>0){
						   $type="4";
					   }
 					   
					   	/*geoffence Exit  mailling*/
 					   if(count($exit_array)>0){
						 foreach($exit_array as $exitkey=>$exitdata){
						   $geoffence_id=$exitdata;
						   $geoofence_mail_status['vehicle_group']=$gps_data['group_id'];
						   $geoffence_cont_data=$this->cron_model->geoffence_data_check_new("id,speed,triger,Template,TO_mail,CC_mail,speed_alert",$geoofence_mail_status,$geoffence_id);        
						   
						   if(count($geoffence_cont_data)>0){
							   
								if($geoffence_cont_data['triger']=="2" || $geoffence_cont_data['triger']=="3"){
									
									
									/*print "-----------------------------------Exit Geoffence-----------------------------------------";
									print "<pre>"; print_r($gps_data);*/
									 
									 $vehicle_group_where['id']=$gps_data['group_id'];
									 $vehicle_mail_status=$this->cron_model->db_datacheck("id,name","vehicle_group",$vehicle_group_where,1);
									 $geoffence_name_where['id']=$geoffence_id;
									 $geoffence_name_data=$this->cron_model->db_datacheck("name","geoffence",$geoffence_name_where,1); 
									 $action="Exit from "; 
									 $email_template_where['id']=$geoffence_cont_data['Template'];
									 $email_template=$this->cron_model->db_datacheck('email_subject,email_content','Email_template',$email_template_where,1); 
									 $to_addr_array=explode(",",$geoffence_cont_data['TO_mail']);
									 $to_addr_data=$this->cron_model->db_datacheck('email,Company_name','Mail_Address',"","","","",$to_addr_array);
									 $cc_addr_array=explode(",",$geoffence_cont_data['CC_mail']);
									 $CC_addr_data=$this->cron_model->db_datacheck('email','Mail_Address',"","","","",$cc_addr_array);
									 $to_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $to_addr_data));
									 $cc_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $CC_addr_data));
									 $this->email->set_newline("\r\n");
									 $mail_subject=$email_template['email_subject'];
									 $mail_content=$email_template['email_content'];
									 $mail_subject=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_subject);
									 $mail_subject=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_subject);
									 $mail_subject=str_replace("[ACTION]",$action,$mail_subject);
									 $mail_content=str_replace("[NAME]",ucfirst(strtolower($to_addr_data[0]['Company_name'])),$mail_content);
									 $mail_content=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_content);
									 $mail_content=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_content);
									 $mail_content=str_replace("[ACTION]",$action,$mail_content);
									 $mail_content=str_replace("[PROJECTNAME]",$geoffence_name_data['name'],$mail_content);
									 $mail_content=str_replace("[TIME]",date("d F Y h:i:s A",($gps_data['device_timestamp']/1000)),$mail_content);
									 
									 $this->email->from($mail_settings['from_addr'], $mail_settings['Mail_name']);
									 $contact_emailaddress=explode(",",$to_addr);
									 $contactcc_emailaddress=explode(",",$cc_addr);
									 $this->email->to($contact_emailaddress);
									 if(count($contactcc_emailaddress)>0){
										 //$this->email->cc($contactcc_emailaddress);
									 }
									 $this->email->subject($mail_subject);
									 $this->email->message($mail_content);
									 //for headtrailer 085 and 096 alerts for HIA Plant
									 if($geoffence_cont_data['id']=="11"){
									 	if($gps_data['vehicle_id']=='193' || $gps_data['vehicle_id']=='204'){
									 		// if($this->email->send()){
										  //      print "success";
									   //      }else{									     	 
										  //      print $this->email->print_debugger();
									   //         print "error";
									   //      } 
								 	    }
									 	 
									 }
									
								}
						   }
						   
						   
						   if($geoffence_id!=""){
							  $geoffencealert_existwhere['vehicle_gps_id']=$gps_data['id'];
							  $geoffencealert_existwhere['type']=4;
							  $geoffencealert_existwhere['geoffence_id']=$geoffence_id;
							  $geoffencealert_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$geoffencealert_existwhere);
							  if(count($geoffencealert_exist)<1){
								 $geoffence['vehicle_gps_id']=$gps_data['id'];
								 $geoffence['vehicle_id']=$gps_data['vehicle_id'];
								 $geoffence['type']="4";
								 $geoffence['device_timestamp']=$gps_data['device_timestamp'];
								 $geoffence['speed']=$gps_data['speed'];
								 $geoffence['driver_id']=$gps_data['driver_id'];
								 $geoffence['geoffence_id']=$geoffence_id;
								 $geoffence['created']=date("Y-m-d H:i:s");
								 $this->cron_model->db_insert("vehicle_alerts",$geoffence);
							  }
						   }
						 }
					   }
 					   /*End of geoffence Exit  mailling*/
 					   
					   /* geoffence entry  mailling*/
					   if(count($entry_array)>0){
						 foreach($entry_array as $entrykey=>$entrydata){
						   $geoffence_id=$entrydata;
						   $geoofence_mail_status['vehicle_group']=$gps_data['group_id'];
						   $geoffence_cont_data=$this->cron_model->geoffence_data_check_new("id,speed,triger,Template,TO_mail,CC_mail,speed_alert",$geoofence_mail_status,$geoffence_id);        
						   if(count($geoffence_cont_data)>0){
								if($geoffence_cont_data['triger']=="1" || $geoffence_cont_data['triger']=="3"){
									
									
									/*print "-----------------------------------Entry Geoffence-----------------------------------------";
									print "<pre>"; print_r($gps_data);*/
									
									 $vehicle_group_where['id']=$gps_data['group_id'];
									 $vehicle_mail_status=$this->cron_model->db_datacheck("id,name","vehicle_group",$vehicle_group_where,1);
									 $geoffence_name_where['id']=$geoffence_id;
									 $geoffence_name_data=$this->cron_model->db_datacheck("name","geoffence",$geoffence_name_where,1); 
									 $action="entered into"; 
									 $email_template_where['id']=$geoffence_cont_data['Template'];
									 $email_template=$this->cron_model->db_datacheck('email_subject,email_content','Email_template',$email_template_where,1); 
									 $to_addr_array=explode(",",$geoffence_cont_data['TO_mail']);
									 $to_addr_data=$this->cron_model->db_datacheck('email,Company_name','Mail_Address',"","","","",$to_addr_array);
									 $cc_addr_array=explode(",",$geoffence_cont_data['CC_mail']);
									 $CC_addr_data=$this->cron_model->db_datacheck('email','Mail_Address',"","","","",$cc_addr_array);
									 $to_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $to_addr_data));
									 $cc_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $CC_addr_data));
									 $this->email->set_newline("\r\n");
									 $mail_subject=$email_template['email_subject'];
									 $mail_content=$email_template['email_content'];
									 $mail_subject=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_subject);
									 $mail_subject=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_subject);
									 $mail_subject=str_replace("[ACTION]",$action,$mail_subject);
									 $mail_content=str_replace("[NAME]",ucfirst(strtolower($to_addr_data[0]['Company_name'])),$mail_content);
									 $mail_content=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_content);
									 $mail_content=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_content);
									 $mail_content=str_replace("[ACTION]",$action,$mail_content);
									 $mail_content=str_replace("[PROJECTNAME]",$geoffence_name_data['name'],$mail_content);
									 $mail_content=str_replace("[TIME]",date("d F Y h:i:s A",($gps_data['device_timestamp']/1000)),$mail_content);
									 $this->email->from($mail_settings['from_addr'], $mail_settings['Mail_name']);
									 $contact_emailaddress=explode(",",$to_addr);
									 $contactcc_emailaddress=explode(",",$cc_addr);
									 $this->email->to($contact_emailaddress);
									 if(count($contactcc_emailaddress)>0){
										 //$this->email->cc($contactcc_emailaddress);
									 }
									 $this->email->subject($mail_subject);
									 $this->email->message($mail_content);
									/* if($this->email->send()){
										print "success";
									 }else{
									   print $this->email->print_debugger();
									   print "error";
									 } */
								}
						   }
						   
						   if($geoffence_id!=""){
							  $geoffencealert_existwhere['vehicle_gps_id']=$gps_data['id'];
							  $geoffencealert_existwhere['type']=3;
							  $geoffencealert_existwhere['geoffence_id']=$geoffence_id;
							  $geoffencealert_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$geoffencealert_existwhere);
							  if(count($geoffencealert_exist)<1){
								 $geoffence['vehicle_gps_id']=$gps_data['id'];
								 $geoffence['vehicle_id']=$gps_data['vehicle_id'];
								 $geoffence['type']="3";
								 $geoffence['device_timestamp']=$gps_data['device_timestamp'];
								 $geoffence['speed']=$gps_data['speed'];
								 $geoffence['driver_id']=$gps_data['driver_id'];
								 $geoffence['geoffence_id']=$geoffence_id;
								 $geoffence['created']=date("Y-m-d H:i:s");
								 $this->cron_model->db_insert("vehicle_alerts",$geoffence);
							  }
						   }
						 }
					   }
					   
					   /* End of geoffence entry  mailling*/
 						/*geoffence speed  mailling*/
						
					  if(count($second_point)>0){
						  
						  foreach($second_point as $second_point_key=>$second_point_data){
							  
							 
							  
							$geoffence_id=$second_point_data;
							$geoofence_mail_status['vehicle_group']=$gps_data['group_id'];
							$geoffence_cont_data=$this->cron_model->geoffence_data_check_new("id,speed,speed_alert",$geoofence_mail_status,$geoffence_id);  
							@$geoffence_cont_data_checker = count($geoffence_cont_data); //update to fix notice issue    
							if(@$geoffence_cont_data_checker>0){
								if($geoffence_cont_data['speed_alert']=="1" && $geoffence_cont_data['speed']!="" && $geoffence_cont_data['speed']!="0" && $geoffence_cont_data['speed']<$gps_data['speed']  && $speed[$gps_data['vehicle_id']]<$geoffence_cont_data['speed']){
									
									
									/*print "-----------------------------------Speed alert-----------------------------------------";
									print "<pre>"; print_r($gps_data);*/
									
									
									
									 $geoffencespeed_cont_data=$this->cron_model->geoffence_data_check_new("speed_template,speed_to_type,speed_to,speed_cc_type,speed_cc",$geoofence_mail_status,$geoffence_id);
									 $vehicle_group_where['id']=$gps_data['group_id'];
									 $vehicle_mail_status=$this->cron_model->db_datacheck("id,name","vehicle_group",$vehicle_group_where,1);
									 $geoffence_name_where['id']=$geoffence_id;
									 $geoffence_name_data=$this->cron_model->db_datacheck("name","geoffence",$geoffence_name_where,1); 
									 $emailspeed_template_where['id']=$geoffencespeed_cont_data['speed_template'];
									 $emailspeed_template=$this->cron_model->db_datacheck('email_subject,email_content','Email_template',$emailspeed_template_where,1); 
									 $speedto_addr_array=explode(",",$geoffencespeed_cont_data['speed_to']);
									 $speedto_addr_data=$this->cron_model->db_datacheck('email,Company_name','Mail_Address',"","","","",$speedto_addr_array);
									 $speedcc_addr_array=explode(",",$geoffencespeed_cont_data['speed_cc']);
									 $speedCC_addr_data=$this->cron_model->db_datacheck('email','Mail_Address',"","","","",$speedcc_addr_array);
									 $speedto_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $speedto_addr_data));
									 $speedcc_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $speedCC_addr_data));
									 $this->email->set_newline("\r\n");
									 $mail_subject=$emailspeed_template['email_subject'];
									 $mail_content=$emailspeed_template['email_content'];
									 $mail_subject=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_subject);
									 $mail_subject=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_subject);
									 $mail_subject=str_replace("[PROJECTNAME]",$geoffence_name_data['name'],$mail_subject);
									 $mail_content=str_replace("[NAME]",ucfirst(strtolower($speedto_addr_data[0]['Company_name'])),$mail_content);
									 $mail_content=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_content);
									 $mail_content=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_content);
									 $mail_content=str_replace("[PROJECTNAME]",$geoffence_name_data['name'],$mail_content);
									 $mail_content=str_replace("[GEOFFENCESPEED]",$geoffence_cont_data['speed'],$mail_content);
									 $mail_content=str_replace("[VEHICLESPEED]",$gps_data['speed'],$mail_content);
									 $mail_content=str_replace("[TIME]",date("d F Y h:i:s A",($gps_data['device_timestamp']/1000)),$mail_content);
									 $this->email->from($mail_settings['from_addr'], $mail_settings['Mail_name']);
									 $contact_emailaddress=explode(",",$speedto_addr);
									 $contactcc_emailaddress=explode(",",$speedcc_addr);
									
									$this->email->to($contact_emailaddress);
									if(count($contactcc_emailaddress)>0){
									  // $this->email->cc($contactcc_emailaddress);
									}
									$this->email->subject($mail_subject);
									$this->email->message($mail_content);
									/*if($this->email->send()){
									  print $this->email->print_debugger();
									  print "success";
									}else{
									  print "error";
									}*/
								 
									$geoffencespeed_existwhere['vehicle_gps_id']=$gps_data['id'];
									$geoffencespeed_existwhere['type']="5";
									$geoffencespeed_existwhere['geoffence_id']=$geoffence_id;
									$geoffencespped_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$geoffencespeed_existwhere);
									if(count($geoffencespped_exist)<1){
 									   $geoffence_speed_data['vehicle_gps_id']=$gps_data['id'];
									   $geoffence_speed_data['vehicle_id']=$gps_data['vehicle_id'];
									   $geoffence_speed_data['type']="5";
									   $geoffence_speed_data['device_timestamp']=$gps_data['device_timestamp'];
									   $geoffence_speed_data['speed']=$gps_data['speed'];
									   $geoffence_speed_data['geoffence_id']=$geoffence_id;
									   $geoffence_speed_data['created']=date("Y-m-d H:i:s");
 									   $this->cron_model->db_insert("vehicle_alerts",$geoffence_speed_data); 
									}
								}
							}
						  }
					  }
					  /*End of geoffence speed  mailling*/
			          $lattitude[$gps_data['vehicle_id']]= $gps_data['lattitude'];
			          $lognitude[$gps_data['vehicle_id']]= $gps_data['lognitude'];
			          $speed[$gps_data['vehicle_id']]=$gps_data['speed'];
					 
			      }else{
 					 $firstpos_where['id<']=$gps_data['id'];
					 $firstpos_where['vehicle_id']=$gps_data['vehicle_id'];
					 $order_by="device_timestamp desc";
					 $limit="1";
					 $get_position=$this->cron_model->db_datacheck("lattitude,lognitude","vehicle_gps_information",$firstpos_where,"1",$order_by,$limit);
					 $lattitude[$gps_data['vehicle_id']]= $get_position['lattitude'];
					 $lognitude[$gps_data['vehicle_id']]= $get_position['lognitude'];
			      }
		   //print "fucking cron";
		      }
 		print "hi <br>";
		print "test";
		if($fromid==""){
			$file_name="cronid.txt";
		    $fp=fopen($file_name,"w") or die("file open failed");
 		    $content = fwrite($fp, $gps_data['id']);
 		    fclose($fp);
		}
 		
 		print $gps_data['id'];

 		print ini_get("memory_limit");
		ini_set('memory_limit','128M');
		die();
 			 
 		}
 		
	}
	
	
 	  public function get_geoffencetime($flag=""){
		 $geoffence_data=$this->cron_model->db_geoffence_datatime("id,boundaries","geoffence");
		 foreach($geoffence_data as $geoffence_key => $geoffence_datas){
 			$geoffence[$geoffence_datas['id']]=array();
 			$boundaries=explode("),(",$geoffence_datas['boundaries']);
			
 			foreach($boundaries as $boundaries_data){
 				$boundaries_data=str_replace("(","",$boundaries_data);
				$boundaries_data=str_replace(")","",$boundaries_data);
				$boundaries_data=str_replace(",","",$boundaries_data);
				array_push($geoffence[$geoffence_datas['id']],trim($boundaries_data));
				
			}
 			    $boundaries_data=str_replace("(","",$boundaries[0]);
				$boundaries_data=str_replace(")","",$boundaries_data);
				$boundaries_data=str_replace(",","",$boundaries_data);
			    array_push($geoffence[$geoffence_datas['id']],trim($boundaries_data));
 		}
		
		
		//print "<pre>"; print_r($geoffence);
		return $geoffence;
	}
	  
	  
	  
   public function geoffence_time(){
	   	
 	    $geoffence_data=$this->get_geoffencetime();//getting the geoffence data
        $geoffence_data_alert=$this->get_geoffence("1");
 	    $this->lattitude="";
		$this->lognitude="";
		$this->vehicle_id="";
		
		print "start execution";
		//ini_set('memory_limit','3072M');
		ini_set('memory_limit', '-1');
		//1554182535000
		//$where['vgi.id>=']=20883529;
		$where['vgi.device_timestamp>=']=1560181081000;
		$where['vgi.device_timestamp<=']=1560325617000;
    	$gps_full_data=$this->cron_model->full_data($where);
		
		print "mysql query execution";
		
		if(count($gps_full_data)>0){
			
 			  foreach($gps_full_data as $gps_data_key =>$gps_data){
 				  print $gps_data['id']."<br/>";
 				  $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
				  $geoffece_datat_id=$this->pointInPolygon($point2,$geoffence_data_alert);
 				  $geoffence_alert_id=$geoffece_datat_id['0'];
 
				 if(isset($lattitude[$gps_data['vehicle_id']]) &&  $lattitude[$gps_data['vehicle_id']]!=""  && isset($lognitude[$gps_data['vehicle_id']]) && $lognitude[$gps_data['vehicle_id']]!=""){   
				 
					   $type="";
					   $geoffence_id="";
					   $first_point="";
					   $second_point="";
					   
					   $point1=$lattitude[$gps_data['vehicle_id']]." ".$lognitude[$gps_data['vehicle_id']];
					   $first_point=$this->pointInPolygon($point1,$geoffence_data);
					   $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
					   $second_point=$this->pointInPolygon($point2,$geoffence_data);
					   $entry_array = array_diff($second_point, $first_point);
					   $exit_array=array_diff($first_point, $second_point);
					   
					   if(count($entry_array)>0){
						   $type="3";
					   }
 					   if(count($exit_array)>0){
						   $type="4";
					   }
 					   
					   	/*geoffence Exit  mailling*/
 					   if(count($exit_array)>0){
						 foreach($exit_array as $exitkey=>$exitdata){
						   $geoffence_id=$exitdata;
  						   if($geoffence_id!=""){
							  $geoffencealert_existwhere['vehicle_gps_id']=$gps_data['id'];
							  $geoffencealert_existwhere['type']=4;
							  $geoffencealert_existwhere['geoffence_id']=$geoffence_id;
							  $geoffencealert_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$geoffencealert_existwhere);
							  if(count($geoffencealert_exist)<1){
								 $geoffence['vehicle_gps_id']=$gps_data['id'];
								 $geoffence['vehicle_id']=$gps_data['vehicle_id'];
								 $geoffence['type']="4";
								 $geoffence['device_timestamp']=$gps_data['device_timestamp'];
								 $geoffence['speed']=$gps_data['speed'];
								 $geoffence['geoffence_id']=$geoffence_id;
								 $geoffence['created']=date("Y-m-d H:i:s");
								 $this->cron_model->db_insert("vehicle_alerts",$geoffence);
							  }
						   }
						 }
					   }
 					   /*End of geoffence Exit  mailling*/
 					   
					   /* geoffence entry  mailling*/
					   if(count($entry_array)>0){
						 foreach($entry_array as $entrykey=>$entrydata){
						   $geoffence_id=$entrydata;
 						   if($geoffence_id!=""){
							  $geoffencealert_existwhere['vehicle_gps_id']=$gps_data['id'];
							  $geoffencealert_existwhere['type']=3;
							  $geoffencealert_existwhere['geoffence_id']=$geoffence_id;
							  $geoffencealert_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$geoffencealert_existwhere);
							  if(count($geoffencealert_exist)<1){
								 $geoffence['vehicle_gps_id']=$gps_data['id'];
								 $geoffence['vehicle_id']=$gps_data['vehicle_id'];
								 $geoffence['type']="3";
								 $geoffence['device_timestamp']=$gps_data['device_timestamp'];
								 $geoffence['speed']=$gps_data['speed'];
								 $geoffence['geoffence_id']=$geoffence_id;
								 $geoffence['created']=date("Y-m-d H:i:s");
								 $this->cron_model->db_insert("vehicle_alerts",$geoffence);
							  }
						  }
						 }
					   }
					   
					   /* End of geoffence entry  mailling*/
 						 
			   $lattitude[$gps_data['vehicle_id']]= $gps_data['lattitude'];
			   $lognitude[$gps_data['vehicle_id']]= $gps_data['lognitude'];
			   $speed[$gps_data['vehicle_id']]=$gps_data['speed'];
					 
			 }else{
 					 $firstpos_where['id<']=$gps_data['id'];
					 $firstpos_where['vehicle_id']=$gps_data['vehicle_id'];
					 $order_by="device_timestamp desc";
					 $limit="1";
					 $get_position=$this->cron_model->db_datacheck("lattitude,lognitude","vehicle_gps_information",$firstpos_where,"1",$order_by,$limit);
					 $lattitude[$gps_data['vehicle_id']]= $get_position['lattitude'];
					 $lognitude[$gps_data['vehicle_id']]= $get_position['lognitude'];
			 }
		   //print "fucking cron";
		 }
 		ini_set('memory_limit','128M');
		die();
 			 
 		}
	   
   }
 	  
	 
   public function delay_alert(){
	   
	   
	  $this->load->library('email');
	  $config = array();
	  $whereemail_settings['id']="1";
	  $mail_settings=$this->cron_model->db_datacheck('Host,User_name,Password,from_addr,Mail_name','Mail_settings',$whereemail_settings,1);
	  $config['protocol'] = 'smtp';
	  $config['smtp_host'] = $mail_settings['Host'];
	  $config['smtp_user'] = $mail_settings['User_name'];
	  $config['smtp_pass'] = $mail_settings['Password'];
	  $config['smtp_port'] = '25';
	  $config['mailtype']  = 'html';
	  $config['charset']  = 'iso-8859-1';
	  $this->email->initialize($config);
	  $email_template_where['id']="2";
	  $nodata_template=$this->cron_model->db_datacheck('email_subject,email_content','Email_template',$email_template_where,1);
	  
 	  $gps_full_data=$this->cron_model->gps_lastrow("vgi1.id,vgi1.vehicle_id,vgi1.device_timestamp,vgi1.unpluged,vgi1.mail_status,vgi1.created,vd.name as vehicle_name,vg.name");
	  
	   
	 
	  foreach($gps_full_data as $key=>$data){
		  $time = round(microtime(true) * 1000);
  			  $difference=$time-$data['device_timestamp'];
 		  if($data['mail_status']=='0'){
 			  
  			  if(($difference)>3600000){
				  
   				$milliseconds = 1;  
				$second = 1000;
			    $minute = 60*$second;
			    $hour   = 60*$minute;
			    $day    = 24*$hour;
		  
			   $ans["hour"]   = floor(($difference)/$hour)<10?"0".floor(($difference)/$hour):floor(($difference)/$hour);
			   $ans["minute"] = floor(($difference%$hour)/$minute)<10?"0".floor(($difference%$hour)/$minute):floor(($difference%$hour)/$minute);
			   $ans["second"] = floor((($difference%$hour)%$minute)/$second)<10?"0".floor((($difference%$hour)%$minute)/$second):floor((($difference%$hour)%$minute)/$second);
 			   $ans["millis"] = floor(((($difference%$hour)%$minute)%$second)/$milliseconds);
			    $timeinfo="";
			   if($ans["hour"]!="00"){
			    $timeinfo.=$ans["hour"]." hours ";
			   }
				
				
			   if($ans["minute"]!="00"){
				   if($ans["hour"]!="00"){
					    $timeinfo.="and ";
				   }
 			     $timeinfo.=$ans["minute"]." minutes ";
			   }
			   
				  
				  if($data['unpluged']=='1'){
					  $action="Unpluged from";
				  }else{
					  $action="Pluged in";
				  }
				  
  			    $this->email->set_newline("\r\n");
 			    $nodata_sub=$nodata_template['email_subject'];
			    $nodata_cont=$nodata_template['email_content'];
			    $nodata_sub=str_replace("[VEHICLE_GROUP]",$data['name'],$nodata_sub);
			    $nodata_sub=str_replace("[TRUCK]",$data['vehicle_name'],$nodata_sub);
				 
 			    $nodata_cont=str_replace("[VEHICLE_GROUP]",$data['name'],$nodata_cont);
			    $nodata_cont=str_replace("[TRUCK]",$data['vehicle_name'],$nodata_cont);
				$nodata_cont=str_replace("[TIME]",$timeinfo,$nodata_cont);
			    $nodata_cont=str_replace("[ACTION]",$action,$nodata_cont);
			    $nodata_cont=str_replace("[SERVER_TIME]",$data['created'],$nodata_cont);
			    $nodata_cont=str_replace("[GPS_TIME]",date("d-m-Y H:i:s",($data['device_timestamp']/1000)),$nodata_cont);



			    
 			    $this->email->from($mail_settings['from_addr'], $mail_settings['Mail_name']);
				$email_to['0']="gps@watancon.com";
				$email_to['1']="rikas@watancon.com";
				$email_to['2']="shanoob@watancon.com";
				$this->email->to($email_to);
				$email_cc['0']="shamnas@watancon.com";
				//$email_cc['1']="dinto@watancon.com";
 				$this->email->cc($email_cc);
							 
 				$this->email->subject($nodata_sub);
				$this->email->message($nodata_cont);
 				
 			    if($this->email->send()){
 					$where_up['id']=$data['id'];
					$values['mail_status']="1";
 					 $this->cron_model->db_update("vehicle_gps_information_temp",$values,$where_up);
 			         print "success";
					 // die();
 		        }else{
			         print "error";
				     print $this->email->print_debugger();
					  
 				     
		        }
			  }
			  
			  
		  }
	  }
 	 
   }



  //  public function testpurpose(){

  //    	ini_set('memory_limit', '-1');
 	// 	$geoffence_data=$this->get_geoffence();//getting the geoffence data
  //       $geoffence_data_alert=$this->get_geoffence("1");
  
		// /* setting the Mail Configuration */
		// $whereemail_settings['id']="1";
		// $mail_settings=$this->cron_model->db_datacheck('Host,User_name,Password,from_addr,Mail_name','Mail_settings',$whereemail_settings,1);
		// $this->load->library('email');
		// $config = array();
		// $config['protocol'] = 'smtp';
		// $config['smtp_host'] = $mail_settings['Host'];
		// $config['smtp_user'] = $mail_settings['User_name'];
		// $config['smtp_pass'] = $mail_settings['Password'];
		// $config['smtp_port'] = '25';
		// $config['mailtype']  = 'html';
		// $config['charset']  = 'iso-8859-1';
		// $this->email->initialize($config);//initializing the mail configuration
		// /* setting the end of Mail Configuration */
		
		
		// $file_name="cronid.txt";
		// $fp=fopen($file_name,"r") or die("file open failed");
 	// 	$content = fread($fp, filesize($file_name));
 	// 	fclose($fp);


 	// 	 $where['vgi.id>=']='262056000';
 	// 	 $where['vgi.id<=']='262056500';

 		 
    	
	 
		// //$where['vgi.id>']="40934886";
		// $this->lattitude="";
		// $this->lognitude="";
		// $this->vehicle_id="";
		
		
 	// 	$gps_full_data=$this->cron_model->full_data($where);
		
		// if(count($gps_full_data)>0){
			
 	// 		  foreach($gps_full_data as $gps_data_key =>$gps_data){
 				 
 	// 			    print $gps_data['id']."<br/>";
				  
		// 		  $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
		// 		  $geoffece_datat_id=$this->pointInPolygon($point2,$geoffence_data_alert);
		// 		  //print "<pre>"; print_r($geoffece_datat_id);
		// 		  if(isset($geoffece_datat_id['0']))
		// 		  $geoffence_alert_id=$geoffece_datat_id['0'];
			    
				 
				 
		// 		  if(isset($lattitude[$gps_data['vehicle_id']]) &&  $lattitude[$gps_data['vehicle_id']]!=""  && isset($lognitude[$gps_data['vehicle_id']]) && $lognitude[$gps_data['vehicle_id']]!=""){  
				 
		// 			   $type="";
		// 			   $geoffence_id="";
		// 			   $first_point="";
		// 			   $second_point="";
					   
		// 			   $point1=$lattitude[$gps_data['vehicle_id']]." ".$lognitude[$gps_data['vehicle_id']];
		// 			   $first_point=$this->pointInPolygon($point1,$geoffence_data);
		// 			   $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
		// 			   $second_point=$this->pointInPolygon($point2,$geoffence_data);
		// 			   $entry_array = array_diff($second_point, $first_point);
		// 			   $exit_array=array_diff($first_point, $second_point);
					   
		// 			   if(count($entry_array)>0){
		// 				   $type="3";
		// 			   }
					   
		// 			   if(count($exit_array)>0){
		// 				   $type="4";
		// 			   }
 					   
		// 			   	/*geoffence Exit  mailling*/
 	// 				   if(count($exit_array)>0){
		// 				 foreach($exit_array as $exitkey=>$exitdata){
		// 				   $geoffence_id=$exitdata;
		// 				   $geoofence_mail_status['vehicle_group']=$gps_data['group_id'];
		// 				   $geoffence_cont_data=$this->cron_model->geoffence_data_check_new("id,speed,triger,Template,TO_mail,CC_mail,speed_alert",$geoofence_mail_status,$geoffence_id);   
		// 				   print "<pre>"; print_r($geoffence_cont_data);     
						   
		// 				   if(count($geoffence_cont_data)>0){
							   
		// 						if($geoffence_cont_data['triger']=="2" || $geoffence_cont_data['triger']=="3"){
									
									
									
		// 							/*print "-----------------------------------Exit Geoffence-----------------------------------------";
		// 							print "<pre>"; print_r($gps_data);*/
									 
		// 							 $vehicle_group_where['id']=$gps_data['group_id'];
		// 							 $vehicle_mail_status=$this->cron_model->db_datacheck("id,name","vehicle_group",$vehicle_group_where,1);
		// 							 $geoffence_name_where['id']=$geoffence_id;
		// 							 $geoffence_name_data=$this->cron_model->db_datacheck("name","geoffence",$geoffence_name_where,1); 
		// 							 $action="Exit from "; 
		// 							 $email_template_where['id']=$geoffence_cont_data['Template'];
		// 							 $email_template=$this->cron_model->db_datacheck('email_subject,email_content','Email_template',$email_template_where,1); 
		// 							 $to_addr_array=explode(",",$geoffence_cont_data['TO_mail']);
		// 							 $to_addr_data=$this->cron_model->db_datacheck('email,Company_name','Mail_Address',"","","","",$to_addr_array);
		// 							 $cc_addr_array=explode(",",$geoffence_cont_data['CC_mail']);
		// 							 $CC_addr_data=$this->cron_model->db_datacheck('email','Mail_Address',"","","","",$cc_addr_array);
		// 							 $to_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $to_addr_data));
		// 							 $cc_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $CC_addr_data));
		// 							 $this->email->set_newline("\r\n");
		// 							 $mail_subject=$email_template['email_subject'];
		// 							 $mail_content=$email_template['email_content'];
		// 							 $mail_subject=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_subject);
		// 							 $mail_subject=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_subject);
		// 							 $mail_subject=str_replace("[ACTION]",$action,$mail_subject);
		// 							 $mail_content=str_replace("[NAME]",ucfirst(strtolower($to_addr_data[0]['Company_name'])),$mail_content);
		// 							 $mail_content=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_content);
		// 							 $mail_content=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_content);
		// 							 $mail_content=str_replace("[ACTION]",$action,$mail_content);
		// 							 $mail_content=str_replace("[PROJECTNAME]",$geoffence_name_data['name'],$mail_content);
		// 							 $mail_content=str_replace("[TIME]",date("d F Y h:i:s A",($gps_data['device_timestamp']/1000)),$mail_content);
									 
		// 							 $this->email->from($mail_settings['from_addr'], $mail_settings['Mail_name']);
		// 							 $contact_emailaddress=explode(",",$to_addr);
		// 							 $contactcc_emailaddress=explode(",",$cc_addr);
		// 							 $this->email->to($contact_emailaddress);
		// 							 if(count($contactcc_emailaddress)>0){
		// 								 //$this->email->cc($contactcc_emailaddress);
		// 							 }
		// 							 $this->email->subject($mail_subject);
		// 							 $this->email->message($mail_content);
		// 							 //for headtrailer 085 and 096 alerts for HIA Plant

		// 							 print "-----------------------------------".$geoffence_cont_data['id']."-----------------------------------\n";
		// 							 if($geoffence_cont_data['id']=="11"){

  //                                        print "-----------------------------------".$geoffence_cont_data['id']."-----------------------------------";

		// 							 	 if($this->email->send()){

		// 								   print "success";
		// 							     }else{
									     	 
		// 								     print $this->email->print_debugger();
		// 							        print "error";
		// 							     } 
		// 							 }
									
		// 						}
		// 				   }
						   
						   
						 
		// 				 }
		// 			   }
		// 			   $lattitude[$gps_data['vehicle_id']]= $gps_data['lattitude'];
		// 	          $lognitude[$gps_data['vehicle_id']]= $gps_data['lognitude'];
		// 	          $speed[$gps_data['vehicle_id']]=$gps_data['speed'];
					   
					 
		// 	      }else{
 	// 				 $firstpos_where['id<']=$gps_data['id'];
		// 			 $firstpos_where['vehicle_id']=$gps_data['vehicle_id'];
		// 			 $order_by="device_timestamp desc";
		// 			 $limit="1";
		// 			 $get_position=$this->cron_model->db_datacheck("lattitude,lognitude","vehicle_gps_information",$firstpos_where,"1",$order_by,$limit);
		// 			 $lattitude[$gps_data['vehicle_id']]= $get_position['lattitude'];
		// 			 $lognitude[$gps_data['vehicle_id']]= $get_position['lognitude'];
		// 	      }
						   
						   
						 
		// 				 }
		// 			   }
 
  //  }


   public function data_not_receiving(){

     // $date=strtotime("-15 minutes",time());
     $date=strtotime("-30 minutes",time());
     $checktime=date("Y-m-d H:i:s",$date);
      
     $where['created>']=$checktime;
     $current_data=$this->cron_model->db_datacheck("created","vehicle_gps_information_temp",$where); 
     if(count($current_data)==0){
       $timeinfo="";
       $where_latest['created<=']=$checktime;
       $orderby="created desc";
       $limit="1";
       $last_data=$this->cron_model->db_datacheck("created","vehicle_gps_information_temp",$where_latest,"1",$orderby,$limit); 

        // print time()."-".strtotime($last_data['created'])."\n";
        $time_difference=strtotime(date("Y-m-d H:i:s"))-strtotime($last_data['created']);
 
       $milliseconds = 1;  
	   $second = 1;
	   $minute = 60*$second;
	   $hour   = 60*$minute;
	   $day    = 24*$hour;
		  
	   $ans["hour"]   = floor(($time_difference)/$hour)<10?"0".floor(($time_difference)/$hour):floor(($time_difference)/$hour);
	   $ans["minute"] = floor(($time_difference%$hour)/$minute)<10?"0".floor(($time_difference%$hour)/$minute):floor(($time_difference%$hour)/$minute);
	   $ans["second"] = floor((($time_difference%$hour)%$minute)/$second)<10?"0".floor((($time_difference%$hour)%$minute)/$second):floor((($time_difference%$hour)%$minute)/$second);
	  // $ans["millis"] = floor(((($time_difference%$hour)%$minute)%$second)/$milliseconds);


 
 	   if($ans["hour"]!="00"){
          $timeinfo.=$ans["hour"]." hours ";
       }

 	   if($ans["minute"]!="00"){
		   if($ans["hour"]!="00"){
			    $timeinfo.="and ";
		   }
		   $timeinfo.=$ans["minute"]." minutes ";
	   }

      $this->load->library('email');
	  $config = array();
	  $whereemail_settings['id']="1";
	  $mail_settings=$this->cron_model->db_datacheck('Host,User_name,Password,from_addr,Mail_name','Mail_settings',$whereemail_settings,1);
	  $config['protocol'] = 'smtp';
	  $config['smtp_host'] = $mail_settings['Host'];
	  $config['smtp_user'] = $mail_settings['User_name'];
	  $config['smtp_pass'] = $mail_settings['Password'];
	  $config['smtp_port'] = '25';
	  $config['mailtype']  = 'html';
	  $config['charset']  = 'iso-8859-1';
	  $this->email->initialize($config);
	  $email_template_where['id']="10";
	  $nodata_template=$this->cron_model->db_datacheck('email_subject,email_content','Email_template',$email_template_where,1);


        $this->email->set_newline("\r\n");
	    $nodata_sub=$nodata_template['email_subject'];
	    $nodata_cont=$nodata_template['email_content'];
 
		 //print $timeinfo;
		$nodata_cont=str_replace("[MINUTE]",$timeinfo,$nodata_cont);
	     
	    $this->email->from($mail_settings['from_addr'], "GPS SERVER ALERT");
		$email_to['0']="dinto@watancon.com";
	    $email_to['1']="sinto@watancon.com";
		$email_to['2']="ayman.sbeah@watancon.com";
		$email_to['3']="hilu@watancon.com";
		$this->email->to($email_to);
		$email_cc['0']="gps@watancon.com";
		$email_cc['1']="shanoob@watancon.com";
		$email_cc['2']="shamnas@watancon.com";
		$email_cc['3']="abdulsalam@watancon.com";
		$email_cc['4']="rikas@watancon.com";
		$email_cc['5']="m.abdulla@watancon.com";


		 
		 $this->email->cc($email_cc);
					 
		 $this->email->subject($nodata_sub);
		 $this->email->message($nodata_cont);
			
	    if($this->email->send()){
			 
	         print "success";
		 // die();
        }else{
         print "error";
	     print $this->email->print_debugger();			     
        }
         

     }
   }

   public function cron_alerts_testing($fromid="", $toid=""){
		
 		//ini_set('memory_limit','3072M');
 		//$initial_memorylimit= ini_get("memory_limit");
		ini_set('memory_limit', '-1');
 		$geoffence_data = $this->get_geoffence();//getting the geoffence data

 		echo count($geoffence_data); die;


        $geoffence_data_alert=$this->get_geoffence("1");
  
		/* setting the Mail Configuration */
		$whereemail_settings['id']="1";
		$mail_settings=$this->cron_model->db_datacheck('Host,User_name,Password,from_addr,Mail_name','Mail_settings',$whereemail_settings,1);
		$this->load->library('email');
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = $mail_settings['Host'];
		$config['smtp_user'] = $mail_settings['User_name'];
		$config['smtp_pass'] = $mail_settings['Password'];
		$config['smtp_port'] = '25';
		$config['mailtype']  = 'html';
		$config['charset']  = 'iso-8859-1';
		$this->email->initialize($config);//initializing the mail configuration
		/* setting the end of Mail Configuration */
		
		
		$file_name="cronid.txt";
		$fp=fopen($file_name,"r") or die("file open failed");
 		$content = fread($fp, filesize($file_name));
 		fclose($fp);


 		if($fromid!=""){
 			 $where['vgi.id>=']=$fromid;
 			 $where['vgi.id<=']=$toid;

 		}else{
 			if($content!=""){
			   $where['vgi.id>']=$content;
		    }else{
			   $where['vgi.id>=']=0;
		    }
 		}
    	
	 
		//$where['vgi.id>']="40934886";
		$this->lattitude="";
		$this->lognitude="";
		$this->vehicle_id="";
		
		
 		$gps_full_data=$this->cron_model->full_data($where);
		
		if(count($gps_full_data)>0){
			
 			  foreach($gps_full_data as $gps_data_key =>$gps_data){
 				  print $gps_data['id']."<br/>";
 				   
				  
				  $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
				  $geoffece_datat_id=$this->pointInPolygon($point2,$geoffence_data_alert);
				  //print "<pre>"; print_r($geoffece_datat_id);
				  $geoffence_alert_id=$geoffece_datat_id['0'];
			   
				  if($gps_data['acceleration']==1){
					  $datacheck_accelerationwhere['vehicle_gps_id']=$gps_data['id'];
					  $datacheck_accelerationwhere['type']="2";
					  $data_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$datacheck_accelerationwhere);
					  if(count($data_exist)<1){
						$acceleration_insert['vehicle_gps_id']=$gps_data['id'];
						$acceleration_insert['vehicle_id']=$gps_data['vehicle_id'];
						$acceleration_insert['type']="2";
						$acceleration_insert['device_timestamp']=$gps_data['device_timestamp'];
						$acceleration_insert['speed']=$gps_data['speed'];
						$acceleration_insert['driver_id']=$gps_data['driver_id'];
						$acceleration_insert['geoffence_id']=$geoffence_alert_id;
						$acceleration_insert['created']=date("Y-m-d H:i:s");
						 $this->cron_model->db_insert("vehicle_alerts",$acceleration_insert);
					 }
				  }
				 //checking hash break alert
				  if($gps_data['hash_breaking']==1){
					  $datacheck_hashbreakwhere['vehicle_gps_id']=$gps_data['id'];
					  $datacheck_hashbreakwhere['type']="1";
					  $datahashbreak_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$datacheck_hashbreakwhere);
					  if(count($datahashbreak_exist)<1){
						$hashbreak_insert['vehicle_gps_id']=$gps_data['id'];
						$hashbreak_insert['vehicle_id']=$gps_data['vehicle_id'];
						$hashbreak_insert['type']="1";
						$hashbreak_insert['device_timestamp']=$gps_data['device_timestamp'];
						$hashbreak_insert['geoffence_id']=$geoffence_alert_id;
						$hashbreak_insert['speed']=$gps_data['speed'];
						$hashbreak_insert['driver_id']=$gps_data['driver_id'];
						$hashbreak_insert['created']=date("Y-m-d H:i:s");
						$this->cron_model->db_insert("vehicle_alerts",$hashbreak_insert);
					 }
				  }
				 
				  if(isset($lattitude[$gps_data['vehicle_id']]) &&  $lattitude[$gps_data['vehicle_id']]!=""  && isset($lognitude[$gps_data['vehicle_id']]) && $lognitude[$gps_data['vehicle_id']]!=""){   
				 
					   $type="";
					   $geoffence_id="";
					   $first_point="";
					   $second_point="";
					   
					   $point1=$lattitude[$gps_data['vehicle_id']]." ".$lognitude[$gps_data['vehicle_id']];
					   $first_point=$this->pointInPolygon($point1,$geoffence_data);
					   $point2=$gps_data['lattitude']." ".$gps_data['lognitude'];
					   $second_point=$this->pointInPolygon($point2,$geoffence_data);
					   $entry_array = array_diff($second_point, $first_point);
					   $exit_array=array_diff($first_point, $second_point);
					   
					   if(count($entry_array)>0){
						   $type="3";
					   }
					   
					   if(count($exit_array)>0){
						   $type="4";
					   }
 					   
					   	/*geoffence Exit  mailling*/
 					   if(count($exit_array)>0){
						 foreach($exit_array as $exitkey=>$exitdata){
						   $geoffence_id=$exitdata;
						   $geoofence_mail_status['vehicle_group']=$gps_data['group_id'];
						   $geoffence_cont_data=$this->cron_model->geoffence_data_check_new("id,speed,triger,Template,TO_mail,CC_mail,speed_alert",$geoofence_mail_status,$geoffence_id);        
						   
						   if(count($geoffence_cont_data)>0){
							   
								if($geoffence_cont_data['triger']=="2" || $geoffence_cont_data['triger']=="3"){
									
									
									/*print "-----------------------------------Exit Geoffence-----------------------------------------";
									print "<pre>"; print_r($gps_data);*/
									 
									 $vehicle_group_where['id']=$gps_data['group_id'];
									 $vehicle_mail_status=$this->cron_model->db_datacheck("id,name","vehicle_group",$vehicle_group_where,1);
									 $geoffence_name_where['id']=$geoffence_id;
									 $geoffence_name_data=$this->cron_model->db_datacheck("name","geoffence",$geoffence_name_where,1); 
									 $action="Exit from "; 
									 $email_template_where['id']=$geoffence_cont_data['Template'];
									 $email_template=$this->cron_model->db_datacheck('email_subject,email_content','Email_template',$email_template_where,1); 
									 $to_addr_array=explode(",",$geoffence_cont_data['TO_mail']);
									 $to_addr_data=$this->cron_model->db_datacheck('email,Company_name','Mail_Address',"","","","",$to_addr_array);
									 $cc_addr_array=explode(",",$geoffence_cont_data['CC_mail']);
									 $CC_addr_data=$this->cron_model->db_datacheck('email','Mail_Address',"","","","",$cc_addr_array);
									 $to_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $to_addr_data));
									 $cc_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $CC_addr_data));
									 $this->email->set_newline("\r\n");
									 $mail_subject=$email_template['email_subject'];
									 $mail_content=$email_template['email_content'];
									 $mail_subject=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_subject);
									 $mail_subject=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_subject);
									 $mail_subject=str_replace("[ACTION]",$action,$mail_subject);
									 $mail_content=str_replace("[NAME]",ucfirst(strtolower($to_addr_data[0]['Company_name'])),$mail_content);
									 $mail_content=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_content);
									 $mail_content=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_content);
									 $mail_content=str_replace("[ACTION]",$action,$mail_content);
									 $mail_content=str_replace("[PROJECTNAME]",$geoffence_name_data['name'],$mail_content);
									 $mail_content=str_replace("[TIME]",date("d F Y h:i:s A",($gps_data['device_timestamp']/1000)),$mail_content);
									 
									 $this->email->from($mail_settings['from_addr'], $mail_settings['Mail_name']);
									 $contact_emailaddress=explode(",",$to_addr);
									 $contactcc_emailaddress=explode(",",$cc_addr);
									 $this->email->to($contact_emailaddress);
									 if(count($contactcc_emailaddress)>0){
										 //$this->email->cc($contactcc_emailaddress);
									 }
									 $this->email->subject($mail_subject);
									 $this->email->message($mail_content);
									 //for headtrailer 085 and 096 alerts for HIA Plant
									 if($geoffence_cont_data['id']=="11"){
									 	if($gps_data['vehicle_id']=='193' || $gps_data['vehicle_id']=='204'){
									 		// if($this->email->send()){
										  //      print "success";
									   //      }else{									     	 
										  //      print $this->email->print_debugger();
									   //         print "error";
									   //      } 
								 	    }
									 	 
									 }
									
								}
						   }
						   
						   
						   if($geoffence_id!=""){
							  $geoffencealert_existwhere['vehicle_gps_id']=$gps_data['id'];
							  $geoffencealert_existwhere['type']=4;
							  $geoffencealert_existwhere['geoffence_id']=$geoffence_id;
							  $geoffencealert_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$geoffencealert_existwhere);
							  if(count($geoffencealert_exist)<1){
								 $geoffence['vehicle_gps_id']=$gps_data['id'];
								 $geoffence['vehicle_id']=$gps_data['vehicle_id'];
								 $geoffence['type']="4";
								 $geoffence['device_timestamp']=$gps_data['device_timestamp'];
								 $geoffence['speed']=$gps_data['speed'];
								 $geoffence['driver_id']=$gps_data['driver_id'];
								 $geoffence['geoffence_id']=$geoffence_id;
								 $geoffence['created']=date("Y-m-d H:i:s");
								 $this->cron_model->db_insert("vehicle_alerts",$geoffence);
							  }
						   }
						 }
					   }
 					   /*End of geoffence Exit  mailling*/
 					   
					   /* geoffence entry  mailling*/
					   if(count($entry_array)>0){
						 foreach($entry_array as $entrykey=>$entrydata){
						   $geoffence_id=$entrydata;
						   $geoofence_mail_status['vehicle_group']=$gps_data['group_id'];
						   $geoffence_cont_data=$this->cron_model->geoffence_data_check_new("id,speed,triger,Template,TO_mail,CC_mail,speed_alert",$geoofence_mail_status,$geoffence_id);        
						   if(count($geoffence_cont_data)>0){
								if($geoffence_cont_data['triger']=="1" || $geoffence_cont_data['triger']=="3"){
									
									
									/*print "-----------------------------------Entry Geoffence-----------------------------------------";
									print "<pre>"; print_r($gps_data);*/
									
									 $vehicle_group_where['id']=$gps_data['group_id'];
									 $vehicle_mail_status=$this->cron_model->db_datacheck("id,name","vehicle_group",$vehicle_group_where,1);
									 $geoffence_name_where['id']=$geoffence_id;
									 $geoffence_name_data=$this->cron_model->db_datacheck("name","geoffence",$geoffence_name_where,1); 
									 $action="entered into"; 
									 $email_template_where['id']=$geoffence_cont_data['Template'];
									 $email_template=$this->cron_model->db_datacheck('email_subject,email_content','Email_template',$email_template_where,1); 
									 $to_addr_array=explode(",",$geoffence_cont_data['TO_mail']);
									 $to_addr_data=$this->cron_model->db_datacheck('email,Company_name','Mail_Address',"","","","",$to_addr_array);
									 $cc_addr_array=explode(",",$geoffence_cont_data['CC_mail']);
									 $CC_addr_data=$this->cron_model->db_datacheck('email','Mail_Address',"","","","",$cc_addr_array);
									 $to_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $to_addr_data));
									 $cc_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $CC_addr_data));
									 $this->email->set_newline("\r\n");
									 $mail_subject=$email_template['email_subject'];
									 $mail_content=$email_template['email_content'];
									 $mail_subject=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_subject);
									 $mail_subject=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_subject);
									 $mail_subject=str_replace("[ACTION]",$action,$mail_subject);
									 $mail_content=str_replace("[NAME]",ucfirst(strtolower($to_addr_data[0]['Company_name'])),$mail_content);
									 $mail_content=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_content);
									 $mail_content=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_content);
									 $mail_content=str_replace("[ACTION]",$action,$mail_content);
									 $mail_content=str_replace("[PROJECTNAME]",$geoffence_name_data['name'],$mail_content);
									 $mail_content=str_replace("[TIME]",date("d F Y h:i:s A",($gps_data['device_timestamp']/1000)),$mail_content);
									 $this->email->from($mail_settings['from_addr'], $mail_settings['Mail_name']);
									 $contact_emailaddress=explode(",",$to_addr);
									 $contactcc_emailaddress=explode(",",$cc_addr);
									 $this->email->to($contact_emailaddress);
									 if(count($contactcc_emailaddress)>0){
										 //$this->email->cc($contactcc_emailaddress);
									 }
									 $this->email->subject($mail_subject);
									 $this->email->message($mail_content);
									/* if($this->email->send()){
										print "success";
									 }else{
									   print $this->email->print_debugger();
									   print "error";
									 } */
								}
						   }
						   
						   if($geoffence_id!=""){
							  $geoffencealert_existwhere['vehicle_gps_id']=$gps_data['id'];
							  $geoffencealert_existwhere['type']=3;
							  $geoffencealert_existwhere['geoffence_id']=$geoffence_id;
							  $geoffencealert_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$geoffencealert_existwhere);
							  if(count($geoffencealert_exist)<1){
								 $geoffence['vehicle_gps_id']=$gps_data['id'];
								 $geoffence['vehicle_id']=$gps_data['vehicle_id'];
								 $geoffence['type']="3";
								 $geoffence['device_timestamp']=$gps_data['device_timestamp'];
								 $geoffence['speed']=$gps_data['speed'];
								 $geoffence['driver_id']=$gps_data['driver_id'];
								 $geoffence['geoffence_id']=$geoffence_id;
								 $geoffence['created']=date("Y-m-d H:i:s");
								 $this->cron_model->db_insert("vehicle_alerts",$geoffence);
							  }
						   }
						 }
					   }
					   
					   /* End of geoffence entry  mailling*/
 						/*geoffence speed  mailling*/
						
					  if(count($second_point)>0){
						  
						  foreach($second_point as $second_point_key=>$second_point_data){
							  
							 
							  
							$geoffence_id=$second_point_data;
							$geoofence_mail_status['vehicle_group']=$gps_data['group_id'];
							$geoffence_cont_data=$this->cron_model->geoffence_data_check_new("id,speed,speed_alert",$geoofence_mail_status,$geoffence_id);  
							@$geoffence_cont_data_checker = count($geoffence_cont_data); //update to fix notice issue    
							if(@$geoffence_cont_data_checker>0){
								if($geoffence_cont_data['speed_alert']=="1" && $geoffence_cont_data['speed']!="" && $geoffence_cont_data['speed']!="0" && $geoffence_cont_data['speed']<$gps_data['speed']  && $speed[$gps_data['vehicle_id']]<$geoffence_cont_data['speed']){
									
									
									/*print "-----------------------------------Speed alert-----------------------------------------";
									print "<pre>"; print_r($gps_data);*/
									
									
									
									 $geoffencespeed_cont_data=$this->cron_model->geoffence_data_check_new("speed_template,speed_to_type,speed_to,speed_cc_type,speed_cc",$geoofence_mail_status,$geoffence_id);
									 $vehicle_group_where['id']=$gps_data['group_id'];
									 $vehicle_mail_status=$this->cron_model->db_datacheck("id,name","vehicle_group",$vehicle_group_where,1);
									 $geoffence_name_where['id']=$geoffence_id;
									 $geoffence_name_data=$this->cron_model->db_datacheck("name","geoffence",$geoffence_name_where,1); 
									 $emailspeed_template_where['id']=$geoffencespeed_cont_data['speed_template'];
									 $emailspeed_template=$this->cron_model->db_datacheck('email_subject,email_content','Email_template',$emailspeed_template_where,1); 
									 $speedto_addr_array=explode(",",$geoffencespeed_cont_data['speed_to']);
									 $speedto_addr_data=$this->cron_model->db_datacheck('email,Company_name','Mail_Address',"","","","",$speedto_addr_array);
									 $speedcc_addr_array=explode(",",$geoffencespeed_cont_data['speed_cc']);
									 $speedCC_addr_data=$this->cron_model->db_datacheck('email','Mail_Address',"","","","",$speedcc_addr_array);
									 $speedto_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $speedto_addr_data));
									 $speedcc_addr=implode(',', array_map(function ($mail) { return $mail['email']; }, $speedCC_addr_data));
									 $this->email->set_newline("\r\n");
									 $mail_subject=$emailspeed_template['email_subject'];
									 $mail_content=$emailspeed_template['email_content'];
									 $mail_subject=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_subject);
									 $mail_subject=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_subject);
									 $mail_subject=str_replace("[PROJECTNAME]",$geoffence_name_data['name'],$mail_subject);
									 $mail_content=str_replace("[NAME]",ucfirst(strtolower($speedto_addr_data[0]['Company_name'])),$mail_content);
									 $mail_content=str_replace("[VEHICLE_GROUP]",$vehicle_mail_status['name'],$mail_content);
									 $mail_content=str_replace("[TRUCK]",$gps_data['vehicle_name'],$mail_content);
									 $mail_content=str_replace("[PROJECTNAME]",$geoffence_name_data['name'],$mail_content);
									 $mail_content=str_replace("[GEOFFENCESPEED]",$geoffence_cont_data['speed'],$mail_content);
									 $mail_content=str_replace("[VEHICLESPEED]",$gps_data['speed'],$mail_content);
									 $mail_content=str_replace("[TIME]",date("d F Y h:i:s A",($gps_data['device_timestamp']/1000)),$mail_content);
									 $this->email->from($mail_settings['from_addr'], $mail_settings['Mail_name']);
									 $contact_emailaddress=explode(",",$speedto_addr);
									 $contactcc_emailaddress=explode(",",$speedcc_addr);
									
									$this->email->to($contact_emailaddress);
									if(count($contactcc_emailaddress)>0){
									  // $this->email->cc($contactcc_emailaddress);
									}
									$this->email->subject($mail_subject);
									$this->email->message($mail_content);
									/*if($this->email->send()){
									  print $this->email->print_debugger();
									  print "success";
									}else{
									  print "error";
									}*/
								 
									$geoffencespeed_existwhere['vehicle_gps_id']=$gps_data['id'];
									$geoffencespeed_existwhere['type']="5";
									$geoffencespeed_existwhere['geoffence_id']=$geoffence_id;
									$geoffencespped_exist=$this->cron_model->db_datacheck("id","vehicle_alerts",$geoffencespeed_existwhere);
									if(count($geoffencespped_exist)<1){
 									   $geoffence_speed_data['vehicle_gps_id']=$gps_data['id'];
									   $geoffence_speed_data['vehicle_id']=$gps_data['vehicle_id'];
									   $geoffence_speed_data['type']="5";
									   $geoffence_speed_data['device_timestamp']=$gps_data['device_timestamp'];
									   $geoffence_speed_data['speed']=$gps_data['speed'];
									   $geoffence_speed_data['geoffence_id']=$geoffence_id;
									   $geoffence_speed_data['created']=date("Y-m-d H:i:s");
 									   $this->cron_model->db_insert("vehicle_alerts",$geoffence_speed_data); 
									}
								}
							}
						  }
					  }
					  /*End of geoffence speed  mailling*/
			          $lattitude[$gps_data['vehicle_id']]= $gps_data['lattitude'];
			          $lognitude[$gps_data['vehicle_id']]= $gps_data['lognitude'];
			          $speed[$gps_data['vehicle_id']]=$gps_data['speed'];
					 
			      }else{
 					 $firstpos_where['id<']=$gps_data['id'];
					 $firstpos_where['vehicle_id']=$gps_data['vehicle_id'];
					 $order_by="device_timestamp desc";
					 $limit="1";
					 $get_position=$this->cron_model->db_datacheck("lattitude,lognitude","vehicle_gps_information",$firstpos_where,"1",$order_by,$limit);
					 $lattitude[$gps_data['vehicle_id']]= $get_position['lattitude'];
					 $lognitude[$gps_data['vehicle_id']]= $get_position['lognitude'];
			      }
		   //print "fucking cron";
		      }
 		print "hi <br>";
		print "test";
		if($fromid==""){
			$file_name="cronid.txt";
		    $fp=fopen($file_name,"w") or die("file open failed");
 		    $content = fwrite($fp, $gps_data['id']);
 		    fclose($fp);
		}
 		
 		print $gps_data['id'];

 		print ini_get("memory_limit");
		ini_set('memory_limit','128M');
		die();
 			 
 		}
 		
	}
	
}