<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Department extends CI_Controller {
	
   public function __construct()
   {
      parent::__construct();
      +login_check();
 	 $this->load->model('department_model');
 	 $this->load->library('form_validation');
	 
   }
   public function index(){
      $whereheader_clause['u.id']=$this->session->userdata('id');
	   $whereheader_clause['ua.type']="1";
	   $whereheader_clause['ua.status']="1";
	   $data1['masters_data']=$this->department_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
	   $data1['heading']="Vehicle Group Master";
	   $data1['page_head_icon']="fa fa-sitemap";
	   $reportwhere_clause=array();
	   $reportwhere_clause['u.id']=$this->session->userdata('id');
	   $reportwhere_clause['ua.type']="3";
	   $reportwhere_clause['ua.status']="1";
	   $report_status=$this->department_model->master_join("ua.controll_id",$reportwhere_clause);
	   $data1['report_status']="0"; 
	   if(count($report_status)>0){
		   $data1['report_status']="1";
	   }
	   
	   
	   
	   $deparment_fulldata= $this->department_model->db_datacheck("id,name,status,created,modified","department");
       $data['departmentfulldata']=$deparment_fulldata;
	   $this->load->view('header',$data1);
       $this->load->view('departmentlist',$data);
	   $this->load->view('footer');
   }
   public function department_insert(){
	  $return=array();
 	 $this->form_validation->set_rules('name', 'name', 'required');
     $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	 if ($this->form_validation->run() == TRUE) {
 		 
		  $where_clause['name']=$this->input->post('name');
		  $departmentfulldata= $this->department_model->db_datacheck("id","department",$where_clause);
 		  if(count($departmentfulldata)==0){
			  $datadepartment['name']=$this->input->post('name');
			  $datadepartment['user']= $this->session->userdata('id');
 			  $datadepartment['created']= date("Y-m-d H:i:s");
              $result=$this->department_model->db_insert("department",$datadepartment);
			  if($result==""){
				  $return['error_flag']="1";
		          $return['message']="Some Error Occur.Please Contact Admin";
 			  }else{
				  $return['error_flag']="0";
 			  }
		  }
		  else{
		     $return['error_flag']="1";
		     $return['message']="Department Name Already exist";
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
     $group_data=$this->department_model->db_datacheck("id,name","department",$where_clause,"1");
     if(count($group_data)>0){
		 $return['error_flag']="0";
		 $group_resultdata['name']= $group_data['name'];
  		 $return['information']=$group_resultdata;
	 }
	 else{
		 $return['error_flag']="1";
		 $return['message']="Some Error Occur.Please Contact Admin";
     }
 	 print json_encode($return);
   }
   
   
   public function department_updation(){
	   
	 $return=array();
  	 $this->form_validation->set_rules('name', 'name', 'required');
     $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	 if ($this->form_validation->run() == TRUE) {
 		 if($this->input->post('id')!=""){
 		  $where_clause['id']=$this->input->post('id');
		  $group_data=$this->department_model->db_datacheck("name","department",$where_clause,"1");
		  if($group_data['name']==$this->input->post('name')){
			   $return['error_flag']="2";
			   $return['message']="There is no changes!";
			  
		  }else{
   		    $datadepartment['name']=$this->input->post('name');
		    $datadepartment['user']= $this->session->userdata('id');
		    $datadepartment['modified']= date("Y-m-d H:i:s");
   		    $this->department_model->db_update("department",$datadepartment,$where_clause);
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
			   $wheredepartment_data['department_id']=$this->input->post('id');
			   $departmentresult=$this->department_model->db_datacheck("id","vehicle_data",$wheredepartment_data);
			   if(count($departmentresult)==0){
				   $return['error_flag']="0";
				   $values['status']="0";	
				   $values['user']= $this->session->userdata('id');	
				   $values['modified']= date("Y-m-d H:i:s");	   
				   $where_clause['id']=$this->input->post('id');
				   $result=$this->department_model->db_update("department",$values,$where_clause);	
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
			   $result=$this->department_model->db_update("department",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
		   
 	  }
	  public function departmentname_check(){
		   if($this->input->post("id")!=NULL){
		     $where_clause['id!=']=$this->input->post("id");
		   }
		   $where_clause['name']=$this->input->post("dprt_name");
 		   $department_data=$this->department_model->db_datacheck("id","department",$where_clause);
		   print json_encode(count($department_data));
 	  }
   
 }
 
?>