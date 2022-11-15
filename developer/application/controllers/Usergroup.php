<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Usergroup extends CI_Controller {
	
   public function __construct()
   {
      parent::__construct();
  	 $this->load->model('user_group_model');
 	 $this->load->library('form_validation');
	 $this->load->helper('url');
	 
   }
   public function index(){
	   login_check();
	   $whereheader_clause['u.id']=$this->session->userdata('id');
	   $whereheader_clause['ua.type']="1";
	   $whereheader_clause['ua.status']="1";
	   $data1['masters_data']=$this->user_group_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
	   $data1['heading']="User Group Master";
	   $data1['page_head_icon']="fa fa-group";
	   $reportwhere_clause=array();
	   $reportwhere_clause['u.id']=$this->session->userdata('id');
	   $reportwhere_clause['ua.type']="3";
	   $reportwhere_clause['ua.status']="1";
	   $report_status=$this->user_group_model->master_join("ua.controll_id",$reportwhere_clause);
	   $data1['report_status']="0"; 
	   if(count($report_status)>0){
		   $data1['report_status']="1";
	   }
	   
	   $usergroup_fulldata= $this->user_group_model->db_datacheck("id,name,status,created,modified","user_groups");
       $data['usergropfulldata']=$usergroup_fulldata;
	   
	   $this->load->view('header',$data1);
       $this->load->view('usergrouplist',$data);
	   $this->load->view('footer');
   }
   public function usergroup_insert(){
	  $return=array();
 	 $this->form_validation->set_rules('name', 'name', 'required');
     $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	 if ($this->form_validation->run() == TRUE) {
 		 
		  $where_clause['name']=$this->input->post('name');
		  $usergroupfulldata= $this->user_group_model->db_datacheck("id","user_groups",$where_clause);
 		  if(count($usergroupfulldata)==0){
			  $user_group['name']=$this->input->post('name');
			  $user_group['user']= $this->session->userdata('id');
 			  $user_group['created']= date("Y-m-d H:i:s");
              $result=$this->user_group_model->db_insert("user_groups",$user_group);
			  if($result==""){
				  $return['error_flag']="1";
		          $return['message']="Some Error Occur.Please Contact Admin";
 			  }else{ 
				 $return['error_flag']="0";
   			  }
		  }
		  else{
		     $return['error_flag']="1";
		     $return['message']="User group Name Already exist";
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
     $group_data=$this->user_group_model->db_datacheck("id,name","user_groups",$where_clause,"1");
     if(count($group_data)>0){
		 $return['error_flag']="0";
		 $group_resultdata['name']= $group_data['name'];
  		 $return['information']=$group_resultdata;
	 }
	 else{
		 $return['error_flag']="1";
		 $return['error_flag']="Some Error Occur.Please Contact Admin";
     }
 	 print json_encode($return);
   }
   
   
   public function usergroup_updation(){
	   
	 $return=array();
  	 $this->form_validation->set_rules('name', 'name', 'required');
     $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	 if ($this->form_validation->run() == TRUE) {
 		 if($this->input->post('id')!=""){
		  $where_clause['id']=$this->input->post('id');
  		  $datadepartment['name']=$this->input->post('name');
		  $datadepartment['user']= $this->session->userdata('id');
		  $datadepartment['modified']= date("Y-m-d H:i:s");
   		  $this->user_group_model->db_update("user_groups",$datadepartment,$where_clause);	
		}
		else{
			   $return['error_flag']="1";
			   $return['error_flag']="Some Error Occur.Please Contact Admin";
	   }
 	 }else{
		 $return['error_flag']="1";
		 $return['message']="Please check the required fields";
	 }
     print json_encode($return);
		 
   }
	public function usergroup_deletion(){	     
 
		  if($this->input->post('id')!=""){
			  
			   $whereusergroup_data['user_group']=$this->input->post('id');
			   $usergroupresult=$this->user_group_model->db_datacheck("id","user",$whereusergroup_data);
			   if(count($usergroupresult)==0){
 			      $return['error_flag']="0";
			      $values['status']="0";		
			      $values['user']= $this->session->userdata('id');
		          $values['modified']= date("Y-m-d H:i:s");  
 			      $where_clause['id']=$this->input->post('id');
			      $result=$this->user_group_model->db_update("user_groups",$values,$where_clause);	
			   }else{
				  $return['error_flag']="1";
			      $return['message']="You can't able to deactivate the User Group. It is already assigned to the User.";
			   }
		  }else{
			   $return['error_flag']="1";
			   $return['error_flag']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function usergroup_active(){ 		     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="1";	
			   $values['user']= $this->session->userdata('id');
		       $values['modified']= date("Y-m-d H:i:s");  		   
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->user_group_model->db_update("user_groups",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['error_flag']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function user_groupname_check(){
		   $where_clause['name']=$this->input->post("groupname");
 		   $user_data=$this->user_group_model->db_datacheck("id","user_groups",$where_clause);
		   print json_encode(count($user_data));
 	  }
   
 }
 
?>