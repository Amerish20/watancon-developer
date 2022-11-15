<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sim extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
  		 $this->load->model('sim_model');
		 $this->load->helper('url');
		
      }

	  public function index()
	  {
           login_check();
		   $whereheader_clause['u.id']=$this->session->userdata('id');
	       $whereheader_clause['ua.type']="1";
	       $whereheader_clause['ua.status']="1";
 	       $data1['masters_data']=$this->sim_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
		   $data1['heading']="Sim Master";
		   $data1['page_head_icon']="fa fa-ticket";	
		   $reportwhere_clause=array();
		   $reportwhere_clause['u.id']=$this->session->userdata('id');
		   $reportwhere_clause['ua.type']="3";
		   $reportwhere_clause['ua.status']="1";
		   $report_status=$this->sim_model->master_join("ua.controll_id",$reportwhere_clause);
		   $data1['report_status']="0"; 
		   if(count($report_status)>0){
			   $data1['report_status']="1";
		   }
 		   	   
		   $simfulldata= $this->sim_model->full_data();
		   $data['simfulldata']=$simfulldata;
		   $this->load->view('header',$data1);
   		   $this->load->view('simlist',$data);
		   $this->load->view('footer'); 
	  }
	  public function sim_insert(){
 		   
		  $datasim['sim_serial']=$this->input->post('sim_serial_number');
		  $datasim['sim_num']=$this->input->post('sim_number');
		  $datasim['status']="1";
		  $datasim['provider']=$this->input->post('provider');
 		  $datasim['user']= $this->session->userdata('id');
	      $datasim['created']= date("Y-m-d H:i:s");
		  
 		  $result=$this->sim_model->db_insert("sim_details",$datasim);
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
  		 $sim_data=$this->sim_model->db_datacheck("sim_serial,sim_num,provider,status","sim_details",$where_clause,"1");
 		 if(count($sim_data)>0){ 
		    $return['error_flag']="0";
  		    $sim_resultdata['sim_serial_no']= $sim_data['sim_serial'];
		    $sim_resultdata['sim_num']= $sim_data['sim_num'];
			$sim_resultdata['provider']= $sim_data['provider'];
  			$return['information']=$sim_resultdata;
		 }else{
			$return['error_flag']="1";
		    $return['error_message']="Some Error Occur.Please Contact Admin";
		 }
 		  print json_encode($return);
		  
 	   }
	   
	   public function sim_unlinkanddeactivate(){
		    $return=array();
		    if($this->input->post('id')!=""){
				$return['error_flag']="0";
 				$where_device_data['sim_id']=$this->input->post('id');
  				$datasim['user']= $this->session->userdata('id');
 			    $datasim['modified']= date("Y-m-d H:i:s");
				$datasim['sim_id']="";
 			    $this->sim_model->db_update("device_data",$datasim,$where_device_data);
				 $where_clause['id']=$this->input->post('id');
 				 $values['status']="0";
				 $values['user']=$this->session->userdata('id');
				 $values['modified']=date("Y-m-d H:i:s");
				 $result=$this->sim_model->db_update("sim_details",$values,$where_clause);
 
 			}else{
			  $return['error_flag']="1";
		      $return['error_message']="Some Error Occur.Please Contact Admin";
 		    }
		  
		  print json_encode($return);
		   
		   
	   }
	   
	   
	   public function sim_updation(){
 		     
		  if($this->input->post('id')!=""){
			  $return['error_flag']="0";
			  $where_clause['id']=$this->input->post('id');
		      $datasim['sim_serial']=$this->input->post('sim_serial_number');
		      $datasim['sim_num']=$this->input->post('sim_number');
			  $datasim['provider']=$this->input->post('provider');
  			  $datasim['user']= $this->session->userdata('id');
			  $datasim['modified']= date("Y-m-d H:i:s");
 			  $this->sim_model->db_update("sim_details",$datasim,$where_clause);
		  }else{
			  $return['error_flag']="1";
		      $return['error_message']="Some Error Occur.Please Contact Admin";
 		  }
		  
		  print json_encode($return);
	   }
	   
	   
	  public function sim_deactive(){	     
 
		  if($this->input->post('id')!=""){
 			  $where_device_data['sim_id']=$this->input->post('id');
			   
 			  $sim_data=$this->sim_model->db_datacheck("imei","device_data",$where_device_data,"1");
			  
   			  if(is_array($sim_data)){
				 $return['error_flag']="2";
				 $return['message']="This sim is already using in the device ".$sim_data['imei']." shall we unlik the sim from this device?";
 			  }else{
				  
				 $where_clause['id']=$this->input->post('id');
				 $return['error_flag']="0";
				 $values['status']="0";
				 $values['user']=$this->session->userdata('id');
				 $values['modified']=date("Y-m-d H:i:s");
				 $result=$this->sim_model->db_update("sim_details",$values,$where_clause);	
			  }	
			  	   
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  
	  
	  public function sim_active(){ 		     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="1";	
			   $values['user']=$this->session->userdata('id');
			   $values['modified']=date("Y-m-d H:i:s");		   
  			   $where_clause['id']=$this->input->post('id');
			   $result=$this->sim_model->db_update("sim_details",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function sim_check(){
		   $where_clause['sim_serial']=$this->input->post("sim_serial_number");
 		   $datasim=$this->sim_model->db_datacheck("id","sim_details",$where_clause);
		   print json_encode(count($datasim));
 	  }
	  
	  public function sim_num_check(){
		   $where_clause['sim_num']=$this->input->post("sim_number");
 		   $datasim=$this->sim_model->db_datacheck("id","sim_details",$where_clause);
		   print json_encode(count($datasim));
 	  }
	  
}
?>