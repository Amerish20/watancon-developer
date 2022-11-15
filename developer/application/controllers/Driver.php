<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
  		 $this->load->model('driver_model');
		 $this->load->helper('url');
		
      }

	  public function index()
	  {
           login_check();
		   $whereheader_clause['u.id']=$this->session->userdata('id');
	       $whereheader_clause['ua.type']="1";
	       $whereheader_clause['ua.status']="1";
 	       $data1['masters_data']=$this->driver_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
		   $data1['heading']="Driver Details";
		   $data1['page_head_icon']="fa fa-user";
		   $reportwhere_clause=array();
		   $reportwhere_clause['u.id']=$this->session->userdata('id');
		   $reportwhere_clause['ua.type']="3";
		   $reportwhere_clause['ua.status']="1";
		   $report_status=$this->driver_model->master_join("ua.controll_id",$reportwhere_clause);
		   $data1['report_status']="0"; 
		   if(count($report_status)>0){
			   $data1['report_status']="1";
		   }
 		   $driverfulldata= $this->driver_model->full_data();
		   $data['driverfulldata']=$driverfulldata;
		   $this->load->view('header',$data1);
   		   $this->load->view('driverlist',$data);
		   $this->load->view('footer'); 
	  }
	  public function driver_insert(){
		   		   
		  $driverdata['batch_num']=$this->input->post('batch_num');
		  $driverdata['Name']=$this->input->post('driver_name');
		  $driverdata['phone']=$this->input->post('mob_num');
		  $driverdata['status']="1";		  
 		  $driverdata['user']= $this->session->userdata('id');
	      $driverdata['created']= date("Y-m-d H:i:s");
		  
 		  $result=$this->driver_model->db_insert("driver_data",$driverdata);
 		  if($result==""){
 			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
 		  }else{
			  $return['error_flag']="0";
		  }
		   print json_encode($return);
		  
	  }
	  
	   public function selecting(){
		   
		 $return=array();
 		 $where_clause['id']=$this->input->post('id');
  		 $driver_data=$this->driver_model->db_datacheck("batch_num,Name,phone,status","driver_data",$where_clause,"1");
 		 if(count($driver_data)>0){ 
		    $return['error_flag']="0";
  		    $driver_resultdata['batch_num']= $driver_data['batch_num'];
		    $driver_resultdata['driver_name']= $driver_data['Name'];
			$driver_resultdata['mob_num']= $driver_data['phone'];
  			$return['information']=$driver_resultdata;
		 }else{
			$return['error_flag']="1";
		    $return['error_message']="Some Error Occur.Please Contact Admin";
		 }
 		  print json_encode($return);		  
 	   }
	   
	   
	   public function driver_unlinkanddeactivate(){
		    $return=array();
		    if($this->input->post('id')!=""){
				$return['error_flag']="0";
				
				$where_vehicle_data['id']=$this->input->post('vehicle_id');
				$driver_datas=$this->driver_model->db_datacheck("driver_id","vehicle_data",$where_vehicle_data,"1");
				$driver_shift_ids=str_replace($this->input->post('id'),"",$driver_datas['driver_id']);
				
  				// Removing driver from vehicle data tables
 				 //$where_vehicle_data['id']=$this->input->post('vehicle_id');
 				 //$where_vehicle_data['driver_id']=$this->input->post('id');
  				 $driverdata['user']= $this->session->userdata('id');
 			     $driverdata['modified']= date("Y-m-d H:i:s");
				 $driverdata['driver_id']=$driver_shift_ids;
  			     $this->driver_model->db_update("vehicle_data",$driverdata,$where_vehicle_data);
				 //un allocate the driver from vehicle
				 
				 
				 $where_driver_data['driver_id']=$this->input->post('id');
				 $where_driver_data['vehicle_id']=$this->input->post('vehicle_id');
				 $where_driver_data['status']="1";
				 $driveralloc_data['user']= $this->session->userdata('id');
 			     $driveralloc_data['modified']= date("Y-m-d H:i:s");
 				 $driveralloc_data['status']="0";
				 $this->driver_model->db_update("driver_allocation",$driveralloc_data,$where_driver_data);
 				 //diabling the driver from driver table
 				  $where_clause['id']=$this->input->post('id');
 				  $values['status']="0";
				  $values['user']=$this->session->userdata('id');
				  $values['modified']=date("Y-m-d H:i:s");
				  $result=$this->driver_model->db_update("driver_data",$values,$where_clause);
				  
				  
				  
 
 			}else{
			  $return['error_flag']="1";
		      $return['error_message']="Some Error Occur.Please Contact Admin";
 		    }
		  
		  print json_encode($return);
		   
		   
	   }
	   
	   
	   public function driver_updation(){
 		     
		  if($this->input->post('id')!=""){
			  $return['error_flag']="0";
			  $where_clause['id']=$this->input->post('id');
			  
			  $driverdata['batch_num']=$this->input->post('batch_num');
			  $driverdata['Name']=$this->input->post('driver_name');
			  $driverdata['phone']=$this->input->post('mob_num');  
		      
  			  $driverdata['user']= $this->session->userdata('id');
			  $driverdata['modified']= date("Y-m-d H:i:s");
 			  $this->driver_model->db_update("driver_data",$driverdata,$where_clause);
		  }else{
			  $return['error_flag']="1";
		      $return['error_message']="Some Error Occur.Please Contact Admin";
 		  }
		  
		  print json_encode($return);
	   }
	   
	   
	  public function driver_disable(){	     
 
		  if($this->input->post('id')!=""){
 			  $driver_id=$this->input->post('id');
			   
 			  $vehicle_data=$this->driver_model->driver_check($driver_id);
			   
			  
   			  if(is_array($vehicle_data)){
				 $return['error_flag']="2";
				 $return['vehicle_id']=$vehicle_data['id'];
				 $return['message']="This Driver is assigned to ".$vehicle_data['name'].". shall we remove the driver from this vehicle?";
 			  }else{
				  
				 $where_clause['id']=$this->input->post('id');
				 $return['error_flag']="0";
				 $values['status']="0";
				 $values['user']=$this->session->userdata('id');
				 $values['modified']=date("Y-m-d H:i:s");
				 $result=$this->driver_model->db_update("driver_data",$values,$where_clause);	
			  }	
			  	   
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  
	  
	  public function driver_enable(){ 		     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="1";	
			   $values['user']=$this->session->userdata('id');
			   $values['modified']=date("Y-m-d H:i:s");		   
  			   $where_clause['id']=$this->input->post('id');
			   $result=$this->driver_model->db_update("driver_data",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function batch_num_check(){
		   $where_clause['batch_num']=$this->input->post("batch_num");
 		   $driverdata=$this->driver_model->db_datacheck("id","driver_data",$where_clause);
		   print json_encode(count($driverdata));
 	  }
	  
}
?>