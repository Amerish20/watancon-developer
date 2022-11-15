<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class User extends CI_Controller {
	
   public function __construct()
   {
      parent::__construct();
         login_check();
 	 $this->load->model('user_model');
 	 $this->load->library('form_validation');
	 $this->load->library('encrypt');
	 
	 //$this->encryption->initialize(array('driver' => 'mcrypt'));
	 //$this->encryption->initialize(array('driver' => 'openssl'));
	 
   }
   public function index(){
	   
       $whereheader_clause['u.id']=$this->session->userdata('id');
	   $whereheader_clause['ua.type']="1";
	   $whereheader_clause['ua.status']="1";
	   $data1['masters_data']=$this->user_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
	   $data1['heading']="User Master";
	   $data1['page_head_icon']="fa fa-user";	
	   $reportwhere_clause=array();
	   $reportwhere_clause['u.id']=$this->session->userdata('id');
	   $reportwhere_clause['ua.type']="3";
	   $reportwhere_clause['ua.status']="1";
	   $report_status=$this->user_model->master_join("ua.controll_id",$reportwhere_clause);
	   $data1['report_status']="0"; 
	   if(count($report_status)>0){
		   $data1['report_status']="1";
	   }
	   	  
	   $user_fulldata= $this->user_model->user_join("u.id,u.name,u.user_name,u.Password,u.status,u.created,u.modified,ug.name as group_name");
	   $where_user_group['status']="1";
	   $user_groups= $this->user_model->db_datacheck("id,name","user_groups",$where_user_group);
       $data['user_fulldata']=$user_fulldata;
 	   $data['user_groups']=$user_groups;
	   $this->load->view('header',$data1);
       $this->load->view('userlist',$data);
	   $this->load->view('footer');
   }
   public function user_insert(){
 
	  $return=array();
 	 $this->form_validation->set_rules('name', 'Name', 'required');
	 $this->form_validation->set_rules('username', 'User Name', 'required');
	 $this->form_validation->set_rules('password', 'password', 'required');
	 $this->form_validation->set_rules('group', 'group', 'required');
 	 $this->form_validation->set_rules('status', 'status', 'required');
	 
     $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	 if ($this->form_validation->run() == TRUE) {
 		  $where_clause['user_name']=$this->input->post('username');
		  $departmentfulldata= $this->user_model->db_datacheck("id","user",$where_clause);
 		  if(count($departmentfulldata)==0){
			  $user['name']=$this->input->post('name');
			  $user['user_name']=$this->input->post('username');
			  
			  $user['Password']=$this->encrypt->encode($this->input->post('password'));
			  $user['user_group']=$this->input->post('group');
			  $user['status']=$this->input->post('status');
			  $user['user']=$this->session->userdata('id');
			  $user['created']= date("Y-m-d H:i:s");
 			   
              $result=$this->user_model->db_insert("user",$user);
			  if($result==""){
				  $return['error_flag']="1";
		          $return['message']="Some Error Occur.Please Contact Admin";
 			  }else{
				  $return['error_flag']="0";
 			  }
		  }
		  else{
		     $return['error_flag']="1";
		     $return['message']="User Name Already exist";
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
      $user_data=$this->user_model->db_datacheck("id,name,user_name,Password,user_group,status","user",$where_clause,"1");
     if(count($user_data)>0){
 		 $return['error_flag']="0";
		 $user_resultdata['name']= $user_data['name'];
		 $user_resultdata['username']= $user_data['user_name'];
		 $user_resultdata['password']= $this->encrypt->decode($user_data['Password']);
		 $user_resultdata['group']= $user_data['user_group'];
		 $user_resultdata['status']= $user_data['status'];
   		 $return['information']=$user_resultdata;
	 }
	 else{
		 $return['error_flag']="1";
		 $return['error_flag']="Some Error Occur.Please Contact Admin";
     }
 	 print json_encode($return);
   }
   
   
   public function user_updation(){
	   
	 $return=array();
  	 $this->form_validation->set_rules('name', 'Name', 'required');
	 $this->form_validation->set_rules('username', 'User Name', 'required');
	 $this->form_validation->set_rules('password', 'password', 'required');
	 $this->form_validation->set_rules('group', 'group', 'required');
 	 $this->form_validation->set_rules('status', 'status', 'required');
	 
     $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	 if ($this->form_validation->run() == TRUE) {
 		 if($this->input->post('id')!=""){
		  $where_clause['id']=$this->input->post('id');
  		  $user['name']=$this->input->post('name');
		  $user['user_name']=$this->input->post('username');
		  $user['Password']=$this->encrypt->encode($this->input->post('password'));
		  $user['user_group']=$this->input->post('group');
		  $user['status']=$this->input->post('status');
 		  $user['user']=$this->session->userdata('id');
		  $user['modified']= date("Y-m-d H:i:s");
 
   		  $this->user_model->db_update("user",$user,$where_clause);	
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
	public function user_deletion(){	     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="0";		
			   $values['user']=$this->session->userdata('id');
		       $values['modified']= date("Y-m-d H:i:s");	   
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->user_model->db_update("user",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['error_flag']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function user_active(){ 		     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="1";	
			   $values['user']=$this->session->userdata('id');
		       $values['modified']= date("Y-m-d H:i:s");		   
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->user_model->db_update("user",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['error_flag']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function username_check(){
		   if($this->input->post("user_id")!=""){
		     $where_clause['id!=']=$this->input->post("user_id");
		   }
		   $where_clause['user_name']=$this->input->post("username");
 		   $department_data=$this->user_model->db_datacheck("id","user",$where_clause);
		   print json_encode(count($department_data));
 	  }
   
 }
 
?>