<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile_api extends CI_Controller {
    public function __construct()
      {
        parent::__construct();
   		$this->load->model('Mobile_model');
      }
	   
	 public function loginvalidate(){
 		  $return=array();
   	       $this->load->library('encrypt');
 		   $json = file_get_contents('php://input');
           $mobiledata = json_decode($json,true);
 		  // print "<pre>"; print_r($_POST);
		 // $_POST['data']="dinto";
		    $where_clause['user_name']=$this->security->xss_clean($mobiledata['username']);
 		   $login_data=$this->Mobile_model->gps_datacheck("id,name,password,status","user",$where_clause);
 		   if(is_array($login_data)){
			   if($login_data['status']=="1"){
 				   if(@$this->encrypt->decode($login_data['password'])==$this->security->xss_clean($mobiledata['password'])){
 					   $data["id"]= $login_data['id'];
					   $data["name"]= ucwords(strtolower($login_data['name']));
					   $return["information"]=$data;
					   $return['error_flag']="0";
					   $return['message']=$data;
					   
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
			   
		   
	      print json_encode( $return);
		  
	  }
	  public function vehicledata(){
		  $return=array();
		  $json = file_get_contents('php://input');
          $mobiledata = json_decode($json,true);
		  $where_clause =array();
		  if(isset($mobiledata['userid']) && $mobiledata['userid']!=""){
			 $where_clause['u.id']=$mobiledata['userid'];
 			  $where_clause['ua.type']="2";
			  $where_clause['ua.status']="1";
			  $where_clause['vd.status']="1";
			  $vehiclefulldata= $this->Mobile_model->vehicle_group_join("vd.id as id,vd.description,d.id as group_id,d.name as group_name",$where_clause);
 			  $pullitems="vgi1.`vehicle_id`,vgi1.speed,vgi1.ign_status";
 			  $gps_cordinate= $this->Mobile_model->gps_lastrow($pullitems);
 			  $data['fleets_status']="0";
			  if(count($vehiclefulldata)>0){
				$data['fleets_status']="1";
					foreach($vehiclefulldata as $vehicle_key=>$vehicledata){
					 
					$status="0";
					$key = array_search($vehicledata['id'], array_column($gps_cordinate, 'vehicle_id'));
					 if($key !== false) {
						 array_push($valuable_id,$vehicledata['id']);
						if($gps_cordinate[$key]['ign_status']=='1'){
							 if($gps_cordinate[$key]['speed']=="0"){
								$status="1";
							 }else{
								$status="2";
							  }
						}else
						 $status="0";
					  }
				   $groupwise_data[$vehicledata['group_id']]['group_name']=strtoupper($vehicledata['group_name']);
				   $groupwise_data[$vehicledata['group_id']][$vehicledata['id']]['status']=$status;
 				   $groupwise_data[$vehicledata['group_id']][$vehicledata['id']]['description']=$vehicledata['description'];
				} 
				$return['error_flag']="0";
			    $return['vehicle_data']=$groupwise_data;
 			}
 		  }else{
			   $return['error_flag']="1";
			   $return['message']="Login session out";
		  }
		 
		 print json_encode( $return);
	  }
}
