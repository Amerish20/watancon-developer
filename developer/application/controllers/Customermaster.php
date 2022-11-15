<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Customermaster extends CI_Controller {
	
   public function __construct()
   {
      parent::__construct();
      +login_check();
 	 $this->load->model('customer_model');
 	 $this->load->library('form_validation');
	 
   }
   public function index(){
      $whereheader_clause['u.id']=$this->session->userdata('id');
	   $whereheader_clause['ua.type']="1";
	   $whereheader_clause['ua.status']="1";
	   $data1['masters_data']=$this->customer_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
	   $data1['heading']="Customer Master";
	   $data1['page_head_icon']="fa fa-sitemap";
	   $reportwhere_clause=array();
	   $reportwhere_clause['u.id']=$this->session->userdata('id');
	   $reportwhere_clause['ua.type']="3";
	   $reportwhere_clause['ua.status']="1";
	   $report_status=$this->customer_model->master_join("ua.controll_id",$reportwhere_clause);
	   $data1['report_status']="0"; 
	   if(count($report_status)>0){
		   $data1['report_status']="1";
	   }
	   
	   
	   
	   $customer_fulldata= $this->customer_model->db_datacheck("id,cust_code,cust_name,status,created,modified","customer_name");
       $data['customerfulldata']=$customer_fulldata;
	   $this->load->view('header',$data1);
       $this->load->view('customerlist',$data);
	   $this->load->view('footer');
   }
   public function customer_insert(){
	  $return=array();
	  $this->form_validation->set_rules('cust_code', 'cust_code', 'required');
 	 $this->form_validation->set_rules('cust_name', 'cust_name', 'required');
     $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	 if ($this->form_validation->run() == TRUE) {
 		 
		  $where_clause['cust_name']=$this->input->post('cust_name');
		  $customerfulldata= $this->customer_model->db_datacheck("id","customer_name",$where_clause);
 		  if(count($customerfulldata)==0){
			  $datacustomer['cust_code']=$this->input->post('cust_code');
			  $datacustomer['cust_name']=$this->input->post('cust_name');
			  $datacustomer['user']= $this->session->userdata('id');
 			  $datacustomer['created']= date("Y-m-d H:i:s");
              $result=$this->customer_model->db_insert("customer_name",$datacustomer);
			  if($result==""){
				  $return['error_flag']="1";
		          $return['message']="Some Error Occur.Please Contact Admin";
 			  }else{
				  $return['error_flag']="0";
 			  }
		  }
		  else{
		     $return['error_flag']="1";
		     $return['message']="Customer Name Already exist";
		  }
	 }else{
		 $return['error_flag']="1";
		 $return['message']="Please check the required fields";
     }
	 print json_encode($return);
   }
   public function selecting(){
	 $return=array();
 	 $where_clause['id']=$this->input->post('id');
     $group_data=$this->customer_model->db_datacheck("id,cust_code,cust_name","customer_name",$where_clause,"1");
     if(count($group_data)>0){
		 $return['error_flag']="0";
		 $group_resultdata['cust_code']= $group_data['cust_code'];
		 $group_resultdata['cust_name']= $group_data['cust_name'];
  		 $return['information']=$group_resultdata;
		 //print "<pre>"; print_r($group_resultdata);
		// die();
	 }
	 else{
		 $return['error_flag']="1";
		 $return['message']="Some Error Occur.Please Contact Admin";
     }
 	 print json_encode($return);
   }
   
   
   public function customer_updation(){
	   
	 $return=array();
  	 $this->form_validation->set_rules('cust_code', 'cust_code', 'required');
 	 $this->form_validation->set_rules('cust_name', 'cust_name', 'required');
     $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	 if ($this->form_validation->run() == TRUE) {
 		 if($this->input->post('id')!=""){
 		  $where_clause['id']=$this->input->post('id');
		  $group_data=$this->customer_model->db_datacheck("cust_code,cust_name","customer_name",$where_clause,"1");
		  if($group_data['cust_code']==$this->input->post('cust_code') && $group_data['cust_name']==$this->input->post('cust_name')){
			   $return['error_flag']="2";
			   $return['message']="There is no changes!";
			  
		  }else{
			  $datacustomer['cust_code']=$this->input->post('cust_code');
   		    $datacustomer['cust_name']=$this->input->post('cust_name');
		    $datacustomer['user']= $this->session->userdata('id');
		    $datacustomer['modified']= date("Y-m-d H:i:s");
   		    $this->customer_model->db_update("customer_name",$datacustomer,$where_clause);
		  }
		}
		else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
	   }
 	 }else{
		 $return['error_flag']="1";
		 $return['message']="Please check the required fields";
	 }
     print json_encode($return);
		 
   }
	public function vehicle_department_deletion(){	     
 
		  if($this->input->post('id')!=""){
			   $wherecustomer_data['department_id']=$this->input->post('id');
			   $departmentresult=$this->customer_model->db_datacheck("id","vehicle_data",$wherecustomer_data);
			   if(count($departmentresult)==0){
				   $return['error_flag']="0";
				   $values['status']="0";	
				   $values['user']= $this->session->userdata('id');	
				   $values['modified']= date("Y-m-d H:i:s");	   
				   $where_clause['id']=$this->input->post('id');
				   $result=$this->customer_model->db_update("customer_name",$values,$where_clause);	
			   }else{
				   $return['error_flag']="1";
			       $return['message']="Cannt able to deactivate.Department Is already assignied to vehicle.";
			   }
		  }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function vehicle_department_active(){ 		     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="1";	
			   $values['user']= $this->session->userdata('id');	
			   $values['modified']= date("Y-m-d H:i:s");		   
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->customer_model->db_update("customer_name",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
		   
 	  }
	  public function customername_check(){
		   if($this->input->post("id")!=NULL){
		     $where_clause['id!=']=$this->input->post("id");
		   }
		   $where_clause['cust_name']=$this->input->post("cust_name");
 		   $customer_data=$this->customer_model->db_datacheck("id","customer_name",$where_clause);
		   print json_encode(count($customer_data));
 	  }
   
 }
 
?>