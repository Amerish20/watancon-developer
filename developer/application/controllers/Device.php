<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Device extends CI_Controller {
	
	public function __construct()
      {
          parent::__construct();
  		$this->load->model('device_model');
		$this->load->helper('url');
		
      }

	  public function index()
	  {
           login_check();
		   $whereheader_clause['u.id']=$this->session->userdata('id');
	       $whereheader_clause['ua.type']="1";
	       $whereheader_clause['ua.status']="1";
	       $data1['masters_data']=$this->device_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
		   $data1['heading']="Device Master";
		   $data1['page_head_icon']="fa fa-mobile";
		   $reportwhere_clause=array();
		   $reportwhere_clause['u.id']=$this->session->userdata('id');
		   $reportwhere_clause['ua.type']="3";
		   $reportwhere_clause['ua.status']="1";
		   $report_status=$this->device_model->master_join("ua.controll_id",$reportwhere_clause);
		   $data1['report_status']="0"; 
		   if(count($report_status)>0){
			   $data1['report_status']="1";
		   }
		   
 		   $devicefulldata= $this->device_model->full_data();
 		   $data['devicefulldata']=$devicefulldata;
 		   $sim_data= $this->device_model->db_simcheck();
		   $data['sim']=$sim_data;
		   
		   
		   $this->load->view('header',$data1);
   		   $this->load->view('devicelist',$data);
		   $this->load->view('footer'); 
	  }
	  
	  public function update_simtable($id,$status){
		  if($id!=""){
			  $return['error_flag']="0";
			  $where_clause['id']=$id;
			  $datasim['status']=$status;
			  $datasim['user']= $this->session->userdata('id');
			  $datasim['modified']= date("Y-m-d H:i:s");
			  $this->device_model->db_update("sim_details",$datasim,$where_clause);  
 		  }
 	  }
	  
	  public function device_insert(){
 		   
		  $datadevice['imei']=$this->input->post('imei');
          $datadevice['sim_id']= $this->input->post('sim');
 		  $datadevice['user']= $this->session->userdata('id');
	      $datadevice['created']= date("Y-m-d H:i:s");
  		  $result=$this->device_model->db_insert("device_data",$datadevice);
  		  if($result==""){
 			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
 		  }else{
			  $this->update_simtable($this->input->post('sim'),"2");
			  $return['error_flag']="0";
		  }
		   print json_encode($return);
	  }
	  
	  public function simlist(){
		  $device_resultdata['full_sim']=$this->device_model->db_simcheck();
		  $return['information']=$device_resultdata;
		  print json_encode($return);
		  
	  }
	   public function selecting(){
		   
		 $return=array();
 		 $where_clause['id']=$this->input->post('id');
  		 $device_data=$this->device_model->db_datacheck("imei,sim_id,status","device_data",$where_clause,"1");
 		 if(count($device_data)>0){ 
		     
		    $return['error_flag']="0";
			$device_resultdata['full_sim']=$this->device_model->db_simcheck($this->input->post('id'));
		    $device_resultdata['Imei']= $device_data['imei'];
 		    $device_resultdata['sim']= $device_data['sim_id'];
 		    $device_resultdata['status']= $device_data['status'];
			$return['information']=$device_resultdata;
		 }else{
			$return['error_flag']="1";
		    $return['error_message']="Some Error Occur.Please Contact Admin";
		 }
 		  print json_encode($return);
		  
 	   }
	   
	   public function device_updation(){
 		     
		  if($this->input->post('id')!=""){
			  
			  $where_clause['id']=$this->input->post('id');
			  $device_data=$this->device_model->db_datacheck("imei,sim_id","device_data",$where_clause,"1");

		     if($device_data['imei']==$this->input->post('imei') && $device_data['sim_id']==$this->input->post('sim')){
			   $return['error_flag']="2";
			   $return['message']="There is no changes!";
			  
		     }else{ 
			  
			   $return['error_flag']="0";
			   $where_clause['id']=$this->input->post('id');
			   $datadevice['imei']=$this->input->post('imei');
		       $datadevice['sim_id']= $this->input->post('sim');
 			   $datadevice['user']= $this->session->userdata('id');
	           $datadevice['modified']= date("Y-m-d H:i:s");
			   $this->device_model->db_update("device_data",$datadevice,$where_clause);
			   $this->update_simtable($this->input->post('sim'),"2");
		    }
		  }else{
			  $return['error_flag']="1";
		      $return['error_message']="Some Error Occur.Please Contact Admin";
 		  }
		  
		  print json_encode($return);
	   }
 	   public function sim_remove(){ 		     
 
		  if($this->input->post('id')!=""){
			 
			   $return['error_flag']="0";			   
			   $values['sim_id']="0";
			   $values['user']= $this->session->userdata('id');
			   $values['modified']= date("Y-m-d H:i:s");
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->device_model->db_update("device_data",$values,$where_clause);	
			   $this->update_simtable($this->input->post('sim_id'),"1");		   
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	   public function device_unlinkanddeactivate(){
		   $return=array();
		    if($this->input->post('id')!=""){
				$return['error_flag']="0";
 				$where_device_data['device_id']=$this->input->post('id');
  				$datadevice['user']= $this->session->userdata('id');
 			    $datadevice['modified']= date("Y-m-d H:i:s");
				$datadevice['device_id']="";
 			    $this->device_model->db_update("vehicle_data",$datadevice,$where_device_data);
			    $return['error_flag']="0";
				$values['user']= $this->session->userdata('id');
 			    $values['modified']= date("Y-m-d H:i:s");
			    $values['status']="0";
 			    $values['modified']=date("Y-m-d H:i:s");	
  			    $where_clause['id']=$this->input->post('id');
			    $result=$this->device_model->db_update("device_data",$values,$where_clause);
                if($this->input->post('sim')!=""){
				    $this->update_devicetable($this->input->post('sim'),"1");	
			    }
 			}else{
			  $return['error_flag']="1";
		      $return['error_message']="Some Error Occur.Please Contact Admin";
 		    }
		  
		  print json_encode($return);
		   
	   }
 	   
	  public function device_deactive(){	     
 
		  if($this->input->post('id')!=""){
			  $where_device_data['device_id']=$this->input->post('id');
  			  $device_data=$this->device_model->db_datacheck("Name","vehicle_data",$where_device_data,"1");
			  if(is_array($device_data)){
				 $return['error_flag']="2";
				 $return['message']="This Device is already using in ".$device_data['Name']." vehicle. Shall we unlink the device from the vehicle?";
 			  }else{
			  
 			   $return['error_flag']="0";
			   $values['status']="0";
			   $values['user']=$this->session->userdata('id');
			   $values['modified']=date("Y-m-d H:i:s");	
			   		   
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->device_model->db_update("device_data",$values,$where_clause);
			   if($this->input->post('sim')!=""){
				    $this->update_devicetable($this->input->post('sim'),"1");	
			   }
			   
			  }
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function device_active(){ 		     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="1";
			   $values['user']=$this->session->userdata('id');
			   $values['modified']=date("Y-m-d H:i:s");			   
  			   $where_clause['id']=$this->input->post('id');
			   $result=$this->device_model->db_update("device_data",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function imei_check(){
		   if($this->input->post("id")!=NULL){
		     $where_clause['id!=']=$this->input->post("id");
		   }
 		   $where_clause['imei']=$this->input->post("imei");
 		   $datadevice=$this->device_model->db_datacheck("id","device_data",$where_clause);
		   print json_encode(count($datadevice));
 	  }
	  
}
?>