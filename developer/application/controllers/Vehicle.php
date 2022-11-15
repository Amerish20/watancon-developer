<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {
	
	   public function __construct()
      {
        parent::__construct();
 		$this->load->model('vehicle_model');
		$this->load->helper('url');
		
      }

	  public function index()
	  {
		  login_check();
   	      $whereheader_clause['u.id']=$this->session->userdata('id');
	      $whereheader_clause['ua.type']="1";
	      $whereheader_clause['ua.status']="1";
	      $data1['masters_data']=$this->vehicle_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
		  $data1['heading']="Vehicle Master";
		  $data1['page_head_icon']="fa fa-truck";
		   $reportwhere_clause=array();
		   $reportwhere_clause['u.id']=$this->session->userdata('id');
		   $reportwhere_clause['ua.type']="3";
		   $reportwhere_clause['ua.status']="1";
 		   $report_status=$this->vehicle_model->master_join("ua.controll_id",$reportwhere_clause);
		   $data1['report_status']="0"; 
		   if(count($report_status)>0){
			   $data1['report_status']="1";
		   }
  		  $vehiclefulldata= $this->vehicle_model->vehicle_group_join("vd.id,vd.asset_code,vd.name,vd.description,vd.created,vd.modified,vd.status,vg.name as group_name,d.name as department_name,st.station_name,dv.imei,s.sim_serial","");
		 
		   $where_department['status']="1";
		   $department_data= $this->vehicle_model->db_datacheck("id,name","department",$where_department);
		   $data['department']=$department_data;
		   $where_clause['status']="1";
 		   $groups_data= $this->vehicle_model->db_datacheck("id,name,move_icon as icon","vehicle_group",$where_clause);
		   $data['groups']=$groups_data;
		   $driver_data= $this->vehicle_model->db_datacheck("id,name","driver_data");
		   $data['driver']=$driver_data;
		   $device= $this->vehicle_model->db_devicecheck();
		   $data['device']=$device;		   
		   $data['vehiclefulldata']=$vehiclefulldata;
		   $where_station['status']="1";
		   $stations_data= $this->vehicle_model->db_datacheck("id,station_name","Stations",$where_station);
		   $data['stations']=$stations_data;
		   $data['user_group']=$this->session->userdata('user_group');

 
 		   
		   $this->load->view('header',$data1);
    	   $this->load->view('vehiclelist',$data);
    	   $this->load->view('footer');
	  }
	  
	  public function vehicle_insert(){

	  	if($this->session->userdata('user_group')=="1"){
	  		  $datavehicle['asset_code']=$this->input->post('assetcode');
			  $datavehicle['name']=$this->input->post('name');
			  $datavehicle['description']=$this->input->post('assetdesc');
			  $datavehicle['model']=$this->input->post('model');
			  $datavehicle['station_id']=$this->input->post('station');
			  $datavehicle['year_of_make']=$this->input->post('yom');
			  $datavehicle['ini_odometer']=$this->input->post('ini_odo');
			  $datavehicle['odometer_date']=strtotime($this->input->post('odo_date'));
			  $datavehicle['reg_expiry']=strtotime($this->input->post('reg_exp'));
			  $datavehicle['device_id']=$this->input->post('device_id');
			  $datavehicle['group_id']=$this->input->post('group');
			  $datavehicle['department_id']=$this->input->post('department');
	 		  $datavehicle['driver_id']=$this->input->post('driver');
			  $datavehicle['prev_oil_change']=$this->input->post('prevoil_odo');
			  $datavehicle['oil_change']=strtotime($this->input->post('oil_change'));
			  $datavehicle['created']= date("Y-m-d H:i:s");
			  $datavehicle['status']="1";	
			  $datavehicle['user']=$this->session->userdata('id');
			  //$datavehicle['modified']=date("Y-m-d H:i:s");		  
	     	  $vehicle_id=$this->vehicle_model->db_insert("vehicle_data",$datavehicle);
			   if($vehicle_id==""){
 
	 			   $return['error_flag']="1";
				   $return['error_message']="Some Error Occur.Please Contact Admin";
	 		  }else{

	 		       $vehiclemonthlykm['vehicle_id']=$vehicle_id;
                   $vehiclemonthlykm['change_datetime']=strtotime($this->input->post('Monthly_kmdate'));
                   $vehiclemonthlykm['monthly_odometer']= $this->input->post('Monthly_km');
                   $vehiclemonthlykm['created']= date("Y-m-d H:i:s");
                   $vehiclemonthlykm['user']=$this->session->userdata('id');
                   $this->vehicle_model->db_insert("vehicle_monthlykm",$vehiclemonthlykm);

				   $this->update_devicetable($this->input->post('device_id'),"2"); 
				   $return['error_flag']="0";
			  }

	  	}else{
	  		$return['error_flag']="1";
		    $return['error_message']="Sorry you dont have the permission to do this action.Please Contact Admin";
	  	}
 
  		  
		   print json_encode($return);
		  
      }
 
	  
	  public function selecting(){
		  $return=array();
		   //$where_clause['id']="127";		  
  		  $where_clause['id']=$this->input->post('id');
  		  $vehicle_data=$this->vehicle_model->db_datacheck("asset_code,name,description,model,plate_type,year_of_make,ini_odometer,odometer_date,device_id,reg_expiry,device_id,group_id,station_id,department_id,driver_id,oil_change,prev_oil_change","vehicle_data",$where_clause,"1");
 		   
		  $where_device['id']=$vehicle_data['device_id'];
		  $devices=$this->vehicle_model->db_datacheck("imei,id","device_data",$where_device,"1");
		  $fulldevices= $this->vehicle_model->db_devicecheck($this->input->post('id'));
 
    	  if(count($vehicle_data)>0){
  			$return['error_flag']="0";
   		    $vehicle_resultdata['asset_code']= $vehicle_data['asset_code'];
 		    $vehicle_resultdata['name']= $vehicle_data['name'];
		    $vehicle_resultdata['asset_desc']= $vehicle_data['description'];
		    $vehicle_resultdata['plate_type']= $vehicle_data['plate_type'];
		    $vehicle_resultdata['Group']= $vehicle_data['group_id'];
			$vehicle_resultdata['Department']= $vehicle_data['department_id'];
		    $vehicle_resultdata['driver']= $vehicle_data['driver_id'];
		    $vehicle_resultdata['model']= $vehicle_data['model'];
		    $vehicle_resultdata['yom']= $vehicle_data['year_of_make'];
		    $vehicle_resultdata['ini_odo']= $vehicle_data['ini_odometer'];
		    $vehicle_resultdata['station_id']=$vehicle_data['station_id'];
 
		    $vehicle_resultdata['odo_date']=(trim($vehicle_data['odometer_date'])!="" && trim($vehicle_data['odometer_date'])!="0")?date("m/d/Y",$vehicle_data['odometer_date']):"";
			$vehicle_resultdata['prevoil_odo']= $vehicle_data['prev_oil_change'];
			$vehicle_resultdata['oil_date']= (trim($vehicle_data['oil_change'])!="" &&  trim($vehicle_data['oil_change'])!="0")?date("m/d/Y",$vehicle_data['oil_change']):"";
			$vehicle_resultdata['full_devices']=$fulldevices;
		    $vehicle_resultdata['device']['id']= $vehicle_data['device_id'];
			$vehicle_resultdata['device']['imei']= $devices['imei'];
 			$sim_details= json_decode($this->pull_simdetails($vehicle_data['device_id']),true);
			$vehicle_resultdata['sim_provider']=$sim_details['provider']!=""?$sim_details['provider']=='0'?'Vodafone':'Ooreedo':"Not Available";
			$vehicle_resultdata['sim_serail']=$sim_details['sim_serial']!=""?$sim_details['sim_serial']:"Not Available";
			$vehicle_resultdata['sim_num']=$sim_details['sim_num']!=""?$sim_details['sim_num']:"Not Available";
  		    $vehicle_resultdata['reg_expiry']= (trim($vehicle_data['reg_expiry'])!="" && trim($vehicle_data['reg_expiry'])!="0")?date("m/d/Y",$vehicle_data['reg_expiry']):"";

  		     $km_datawhere['vehicle_id']=$this->input->post('id');
             $Km_data=array();
             $Km_data=$this->vehicle_model->db_datacheck("monthly_odometer,change_datetime","vehicle_monthlykm",$km_datawhere,"1","change_datetime desc","1");

             if($Km_data!=""){

             	 $vehicle_resultdata['Monthly_kmdate']= date("m/d/Y H:i a" ,$Km_data['change_datetime']);
             	 $vehicle_resultdata['Monthly_km']= $Km_data['monthly_odometer'];
             }




  			$return['information']=$vehicle_resultdata;




 		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
  		   print json_encode($return);
 	  }
	  
	   public function update_devicetable($id,$status){
		  if($id!=""){
			  $return['error_flag']="0";
			  $where_clause['id']=$id;
			  $datadevice['status']=$status;
			  $datadevice['user']=$this->session->userdata('id');
		      $datadevice['modified']=date("Y-m-d H:i:s");	
			  $this->vehicle_model->db_update("device_data",$datadevice,$where_clause);  
 		  }
 	  }
	  public function vehicle_updation(){
 		     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $vehicle_id=$this->input->post('id');

 			   $where_clause['id']=$vehicle_id;
 			   if($this->session->userdata('user_group')=="1"){
			       $datavehicle['asset_code']=$this->input->post('assetcode');
		           $datavehicle['name']=$this->input->post('name');
			       $datavehicle['description']=$this->input->post('assetdesc');
			       $datavehicle['model']=$this->input->post('model');       
			       $datavehicle['year_of_make']=$this->input->post('yom');
			       $datavehicle['ini_odometer']=$this->input->post('ini_odo');
			       $datavehicle['odometer_date']=strtotime($this->input->post('odo_date'));
			       $datavehicle['reg_expiry']=strtotime($this->input->post('reg_exp'));
			       $datavehicle['device_id']=$this->input->post('device_id');
			       $datavehicle['group_id']=$this->input->post('group');
				   $datavehicle['department_id']=$this->input->post('department');
				   $datavehicle['prev_oil_change']=$this->input->post('prevoil_odo');
				   $datavehicle['oil_change']=strtotime($this->input->post('oil_change'));

				   $Monthly_kmdate=strtotime($this->input->post('Monthly_kmdate')); 
				   $Monthly_km=$this->input->post('Monthly_km');

				   $kmcheckwhere['vehicle_id']=$vehicle_id;
				   $kmcheckwhere['change_datetime']=$Monthly_kmdate;
				   $kmcheckwhere['monthly_odometer']=$Monthly_km;
				   $Km_data=$this->vehicle_model->db_datacheck("id","vehicle_monthlykm",$kmcheckwhere);

 
                   if(count($Km_data)==0){

                   	  $currentkmcheckwhere['vehicle_id']=$vehicle_id;
                      $currentkmcheckwhere['change_datetime>=']=strtotime(date("Y-m-01",$Monthly_kmdate));
                      $currentkmcheckwhere['change_datetime<=']=strtotime(date("Y-m-01", ($Monthly_kmdate+strtotime('+1 month'))));
                      $currentKm_data=$this->vehicle_model->db_datacheck("id","vehicle_monthlykm",$currentkmcheckwhere,"1");


                      $vehiclemonthlykm['change_datetime']=$Monthly_kmdate;
		              $vehiclemonthlykm['monthly_odometer']=$Monthly_km;
		              $vehiclemonthlykm['user']=$this->session->userdata('id');
 
                      if( $currentKm_data!=""){
                            $updatekmcheckwhere['id']=$currentKm_data['id'];
                            $vehiclemonthlykm['modified']= date("Y-m-d H:i:s");
                            $this->vehicle_model->db_update("vehicle_monthlykm",$vehiclemonthlykm,$updatekmcheckwhere);

                      }else{

                      	   $vehiclemonthlykm['vehicle_id']=$vehicle_id;		                   
		                   $vehiclemonthlykm['created']= date("Y-m-d H:i:s");		                    
		                   $inserted_data=$this->vehicle_model->db_insert("vehicle_monthlykm",$vehiclemonthlykm);
                      }

                    }


               }
			   $datavehicle['station_id']=$this->input->post('station');
		       $datavehicle['modified']= date("Y-m-d H:i:s");
			   $datavehicle['user']=$this->session->userdata('id');
		  	
  			   $this->vehicle_model->db_update("vehicle_data",$datavehicle,$where_clause);
			   $this->update_devicetable($this->input->post('device_id'),"2");
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }		  
		 print json_encode($return);
 	  }
	  
	  public function pull_simdetails($id=""){
  		  $device_id=$id!=""?$id:$this->input->post('device_id');
  		  if($device_id!=""){
			  $where_clause['d.id']=$device_id;
			  $sim_data=$this->vehicle_model->sim_data($where_clause);
			  if($id==""){
				   print json_encode($sim_data);
			  }else{
				   return json_encode($sim_data);
			  }
 			 
 		  }else{
			  print "error";
		  }
	  }
	  public function vehicle_deletion(){	     
 

         if($this->session->userdata('user_group')=="1"){
		    if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="0";
			   $values['device_id']="0";
			   $values['user']=$this->session->userdata('id');
		       $values['modified']=date("Y-m-d H:i:s");
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->vehicle_model->db_update("vehicle_data",$values,$where_clause);
			   if($this->input->post('device_id')!="")
			     $this->update_devicetable($this->input->post('device_id'),"1");			   
		    }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		    }
		}else{
			$return['error_flag']="1";
		    $return['error_message']="Sorry you dont have the permission to do this action.Please Contact Admin";
		}
		   print json_encode($return);
		 
 	  }
	  public function vehicle_active(){ 	

	    if($this->session->userdata('user_group')=="1"){	     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="1";	
			   $values['user']=$this->session->userdata('id');
		       $values['modified']=date("Y-m-d H:i:s");		   
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->vehicle_model->db_update("vehicle_data",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		}else{
			$return['error_flag']="1";
		    $return['error_message']="Sorry you dont have the permission to do this action.Please Contact Admin";

		   
		}
		print json_encode($return);
 	  }
	  public function device_remove(){ 		     
 

        if($this->session->userdata('user_group')=="1"){	     
		  if($this->input->post('id')!=""){
			  //alert('helo');
			   $return['error_flag']="0";			   
			   $values['device_id']="0";
			   $values['user']=$this->session->userdata('id');
		       $values['modified']=date("Y-m-d H:i:s");
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->vehicle_model->db_update("vehicle_data",$values,$where_clause);
			    $this->update_devicetable($this->input->post('device_id'),"1");			   
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		}else{
            $return['error_flag']="1";
		    $return['error_message']="Sorry you dont have the permission to do this action.Please Contact Admin";
		   
		}
		print json_encode($return);
 	  }
	  public function asset_code_check(){
		  
		   if($this->input->post("id")!=NULL){
		     $where_clause['id!=']=$this->input->post("id");
		   }		  
		   $where_clause['asset_code']=$this->input->post("assetcode");
 		   $vehicle_data=$this->vehicle_model->db_datacheck("id","vehicle_data",$where_clause);
		   print json_encode(count($vehicle_data));
 	  }
	  public function assset_name_check(){
		   if($this->input->post("id")!=NULL){
		     $where_clause['id!=']=$this->input->post("id");
		   }	
		   $where_clause['description']=$this->input->post("assetdescr");
 		   $vehicle_data=$this->vehicle_model->db_datacheck("id","vehicle_data",$where_clause);
		   print json_encode(count($vehicle_data));
 	  }
 }


?>