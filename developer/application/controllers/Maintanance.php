 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintanance extends CI_Controller {
	
	public function __construct()
      {
        parent::__construct();
 		$this->load->model('Maintanance_model');
		$this->load->helper('url');
		
      } 

	  public function index()
	  {
		  login_check();
   	      $whereheader_clause['u.id']=$this->session->userdata('id');
	      $whereheader_clause['ua.type']="1";
	      $whereheader_clause['ua.status']="1";
	      $data1['masters_data']=$this->Maintanance_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
		  $data1['heading']="Maintanance Master";
		  $data1['page_head_icon']="fa fa-gears";
		  
		   $reportwhere_clause=array();
		   $reportwhere_clause['u.id']=$this->session->userdata('id');
		   $reportwhere_clause['ua.type']="3";
		   $reportwhere_clause['ua.status']="1";
		   $report_status=$this->Maintanance_model->master_join("ua.controll_id",$reportwhere_clause);
		   $data1['report_status']="0"; 
		   if(count($report_status)>0){
			   $data1['report_status']="1";
		   }
		   
		   $where_vehicle_data['vd.status']="1";
  		  $vehiclefulldata= $this->Maintanance_model->vehicle_group_join("vd.id,vd.asset_code,vd.name,vd.description,vd.prev_oil_change,vd. 	oil_change,vd.running_hours,vd.reg_expiry,vd.workshop_status,vd.longstop_status,vd.oil_run_hours,vd.running_hours,vd.oil_run_hours as previous_hours,vd.modified,vg.name as group_name,vg.maintanance_km,vg.maintanance_month,vg.maintanance_hours",$where_vehicle_data);
		  
		    $vehicle_full_details=array();
		   foreach($vehiclefulldata as $vehicle_key=>$vehicle_data){
			   
 			   $where_odo['vehicle_id']=$vehicle_data['id'];
			   $current_odometer=$this->Maintanance_model->final_odometer_read($where_odo);
			   
			   
			   
  			   $vehicle_full_details[$vehicle_key]['id']=$vehicle_data['id'];
			   $vehicle_full_details[$vehicle_key]['asset_code']=$vehicle_data['asset_code'];
			   $vehicle_full_details[$vehicle_key]['description']=$vehicle_data['description']; 
			   $vehicle_full_details[$vehicle_key]['group_name']=$vehicle_data['group_name']; 
 			   $vehicle_full_details[$vehicle_key]['prev_work_hrs']=$vehicle_data['oil_run_hours'];
 			   $vehicle_full_details[$vehicle_key]['cur_work_hrs']=$this->time_calculation($vehicle_data['running_hours']);
			   $pending_hours=($vehicle_data['oil_run_hours']+($vehicle_data['maintanance_hours']*3600))-$vehicle_data['running_hours'];
   			   $vehicle_full_details[$vehicle_key]['peding_hours']=$pending_hours>0?$this->time_calculation($pending_hours):"00:00:00";
   			   $vehicle_full_details[$vehicle_key]['prev_oil_change']=$vehicle_data['prev_oil_change'];
			   $vehicle_full_details[$vehicle_key]['cur_odo']= $current_odometer['final_odometer'];
			   $pending_km=($vehicle_data['prev_oil_change']+$vehicle_data['maintanance_km'])-$current_odometer['final_odometer'];
 			   $vehicle_full_details[$vehicle_key]['peding_odometer']=$pending_km>0?$pending_km:"0";
   			   $vehicle_full_details[$vehicle_key]['oil_change']=$vehicle_data['oil_change']!="0"?date("d/m/Y",$vehicle_data['oil_change']):"";
			   $vehicle_full_details[$vehicle_key]['maintanance_month']=$vehicle_data['maintanance_month'];
			    $vehicle_full_details[$vehicle_key]['workshop_status']=$vehicle_data['workshop_status'];
  			   $vehicle_full_details[$vehicle_key]['longstop_status']=$vehicle_data['longstop_status'];
 			   $vehicle_full_details[$vehicle_key]['modified']=$vehicle_data['modified'];
			   
   			   $exceed_hours_action="Not Exceeded";
			   if($vehicle_data['maintanance_hours']!=""){
				    if(  (($vehicle_data['running_hours']/3600) - $vehicle_data['oil_run_hours'])> $vehicle_data['maintanance_hours']){
				       $exceed_hours_action="Exceeded";
			        }
			   } 
  			   $vehicle_full_details[$vehicle_key]['hours_status']=$exceed_hours_action;
  			   $exeed_action="Date is ok";
			   
 			   if($vehicle_data['maintanance_month']!=""){
					$date = date('m/d/y');
					$diffrence_month=(int)abs((strtotime(date("m/d/y",strtotime($date." +1 month"))) - $vehicle_data['oil_change'])/(60*60*24*30));
 					if($vehicle_data['maintanance_month']<$diffrence_month){
					   $exeed_action="Date Exceeded";
 					}
 			   }
			    
			   $vehicle_full_details[$vehicle_key]['date_status']=$exeed_action;
 			  
			   $exeed_action="KM is ok";
			   if($vehicle_data['maintanance_km']!=""){
 				   $oilchange_odo= $vehicle_data['prev_oil_change'] + $vehicle_data['maintanance_km'];
 				   if($oilchange_odo<$current_odometer['final_odometer']){
					   $exeed_action="KM Exceeded";
 				   }
 			   } 
			   $vehicle_full_details[$vehicle_key]['km_status']=$exeed_action; 
				  
 		   }
		 
 		   $where_clause['status']="1";
 		   $groups_data= $this->Maintanance_model->db_datacheck("id,name,move_icon as icon","vehicle_group",$where_clause);
		   $data['groups']=$groups_data;
 		        
		   $data['vehiclefulldata']=$vehicle_full_details;
 		   
		   $this->load->view('header',$data1);
    	   $this->load->view('maintanancelist',$data);
    	   $this->load->view('footer');
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
 	  
	  public function selecting(){
		  $return=array();
		   	  
  		  $where_clause['id']=$this->input->post('id');
  		  $vehicle_data=$this->Maintanance_model->db_datacheck("asset_code,oil_run_hours,name,description,reg_expiry,group_id,model,oil_change,prev_oil_change","vehicle_data",$where_clause,"1");
 		   
     	  if(count($vehicle_data)>0){
			  
  			$return['error_flag']="0";
   		    $vehicle_resultdata['asset_code']= $vehicle_data['asset_code'];
 		    $vehicle_resultdata['name']= $vehicle_data['name'];
		    $vehicle_resultdata['asset_desc']= $vehicle_data['description'];
 		    $vehicle_resultdata['Group']= $vehicle_data['group_id'];
 		    $vehicle_resultdata['model']= $vehicle_data['model'];
 			$vehicle_resultdata['prevoil_odo']= $vehicle_data['prev_oil_change'];
			//$vehicle_resultdata['working_hrs']= $vehicle_data['oil_run_hours'];
 			$vehicle_resultdata['oil_date']= (trim($vehicle_data['oil_change'])!="" &&  trim($vehicle_data['oil_change'])!="0")?date("m/d/Y",$vehicle_data['oil_change']):"";
   		    $vehicle_resultdata['reg_expiry']= (trim($vehicle_data['reg_expiry'])!="" && trim($vehicle_data['reg_expiry'])!="0")?date("m/d/Y",$vehicle_data['reg_expiry']):"";
  			$return['information']=$vehicle_resultdata;
 		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
  		   print json_encode($return);
 	  }
	  
	   
	  public function vehicle_updation(){
 		     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
 			   $where_clause['id']=$this->input->post('id');
 		       $datavehicle['reg_expiry']=strtotime($this->input->post('reg_exp'));
 			   $datavehicle['prev_oil_change']=$this->input->post('prevoil_odo');
			   $datavehicle['oil_change']=strtotime($this->input->post('oil_change'));
			   $datavehicle['oil_run_hours']=$this->input->post('working_hrs');
		       $datavehicle['modified']= date("Y-m-d H:i:s");
			   $datavehicle['user']=$this->session->userdata('id');
  			   $previous_oilchange_hour=$this->Maintanance_model->db_datacheck("prev_oil_change","vehicle_data",$where_clause,"1");
  			   if($previous_oilchange_hour['prev_oil_change']!=$datavehicle['oil_run_hours']){
				   $datavehicle['running_hours']=$datavehicle['oil_run_hours']*3600;
 			   }
		        
  			   $this->Maintanance_model->db_update("vehicle_data",$datavehicle,$where_clause);
			   
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }		  
		 print json_encode($return);
 	  }
	  
	  public function workshop_update(){
	  	$update_type=$this->input->post('update_type');
		   if($this->input->post('id')!="" && $this->input->post('update_type')!=""){
			   	$where_clause['id']=$this->input->post('id');
			   if($update_type=="1"){
			    $datavehicle['longstop_status']=$this->input->post('workshop_status');
			   }else{
			    $datavehicle['workshop_status']=$this->input->post('workshop_status');
			   }
			   
			   $this->Maintanance_model->db_update("vehicle_data",$datavehicle,$where_clause);
			   $return['error_flag']="0";
		   }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }		  
		  print json_encode($return); 
		   
	  }
 	  
 }


?>