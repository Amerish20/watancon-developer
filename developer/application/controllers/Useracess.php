<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Useracess extends CI_Controller {
	
   public function __construct()
   {
      parent::__construct();
      login_check();
 	  $this->load->model('useracess_model');
 	  $this->load->library('form_validation');
  	 
   }
   public function index(){
	   
	   
	  $whereheader_clause['u.id']=$this->session->userdata('id');
	  $whereheader_clause['ua.type']="1";
	  $whereheader_clause['ua.status']="1";
	  $data1['masters_data']=$this->useracess_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1"); 
	   $data1['heading']="User Control Acess";
	   $data1['page_head_icon']="fa fa-user";
 	   $reportwhere_clause=array();
	   $reportwhere_clause['u.id']=$this->session->userdata('id');
	   $reportwhere_clause['ua.type']="3";
	   $reportwhere_clause['ua.status']="1";
	   $report_status=$this->useracess_model->master_join("ua.controll_id",$reportwhere_clause);
	   $data1['report_status']="0"; 
	   if(count($report_status)>0){
		   $data1['report_status']="1";
	   }
 	   $groupby="ug`.`id`";
 	   $user_acess= $this->useracess_model->useracess_join("`ug`.`id`,max(`ua`.`created`) as `created`, max(`ua`.`modified`) as `modified`, `ug`.`name` as `groupname`",$groupby);
   	   $data['user_acess']=$user_acess;
 	   $data['masters']=$this->useracess_model->db_datacheck("id,master","master");
	   $data['department']=$this->useracess_model->db_datacheck("id,name","department");
	   $data['reports']=$this->useracess_model->db_datacheck("id,report_name","Reports");
	   $data['geoffence_groups']=$this->useracess_model->db_datacheck("id,Name","Geoffence_group");
	   
	   $this->load->view('header',$data1);
       $this->load->view('useracesslist',$data);
	   $this->load->view('footer');
   }
   
   public function selecting(){
	 $return=array();
 	 $where_clause['user_group_id']=$this->input->post('id');
       $user_acess=$this->useracess_model->db_datacheck("id,controll_id,type,status,actions","user_acess",$where_clause);
     if(count($user_acess)>0){
 		  $return['error_flag']="0";
		   $masters =array();
		   $task =array();
		   $reports=array();
		   $geoffence=array();
		   $geoffence_group=array();
		   
		  foreach($user_acess as $user_acess_key=>$user_acess_data){
			  
			  if($user_acess_data['type']=="1"){
				   $masters[$user_acess_data['controll_id']]=$user_acess_data['status'];
 			  }else if($user_acess_data['type']=="2"){
				   $task[$user_acess_data['controll_id']]=$user_acess_data['status'];
			  }else if($user_acess_data['type']=="3"){
				   $reports[$user_acess_data['controll_id']]=$user_acess_data['status'];
			  }else if($user_acess_data['type']=="4"){
				   $geoffence[$user_acess_data['controll_id']]=$user_acess_data['status'];
			  }else if($user_acess_data['type']=="5"){
				   $geoffence_group[$user_acess_data['controll_id']]=$user_acess_data['status'];
			  }else if($user_acess_data['type']=="6"){
				   $geoffence_creation=$user_acess_data['status'];
			  }else if($user_acess_data['type']=="7"){
				   $shipping=$user_acess_data['status'];
			  }
			  
		  }
           $return['masters']=$masters;
		   $return['task']=$task;
		   $return['reports']=$reports;
   		   $return['geoffence']=$geoffence;
		   $return['geoffence_group']=$geoffence_group;
		   $return['geoffence_creation']=$geoffence_creation;
		   $return['shipping']=$shipping;
	 }
	 else{
		 $return['error_flag']="1";
		 $return['error_flag']="Some Error Occur.Please Contact Admin";
     }
	 
  	 print json_encode($return);
   }
   
   
   public function useracess_updation(){
 
 

	  $id=$this->input->post('id');
	  $return=array();
   		 if($id!=""){
			 
			  $where_masterclause['user_group_id']=$this->input->post('id');
			  $useracessdefault['status']='0';
			  $this->useracess_model->db_update("user_acess",$useracessdefault,$where_masterclause,"");
   
			 if(!empty($this->input->post('masters'))){
				 $where_masterclause['user_group_id']=$this->input->post('id');
				 $where_masterclause['type']="1";
 				 $mastercontroll_id=array_keys($this->input->post('masters'));
				 $useracessmaster['status']='1';
				 $useracessmaster['user']= $this->session->userdata('id');
 			     $useracessmaster['modified']= date("Y-m-d H:i:s");
				 $this->useracess_model->db_update("user_acess",$useracessmaster,$where_masterclause,$mastercontroll_id);
			 }
			 if(!empty($this->input->post('task'))){
				 
				 $where_taskclause['user_group_id']=$this->input->post('id');
				 $where_taskclause['type']="2";
 				 $taskcontroll_id=array_keys($this->input->post('task'));
				 $useracesstask['status']='1';
				 $useracesstask['user']= $this->session->userdata('id');
 			     $useracesstask['modified']= date("Y-m-d H:i:s");
				 $this->useracess_model->db_update("user_acess",$useracesstask,$where_taskclause,$taskcontroll_id);
			 }
			 if(!empty($this->input->post('Reports'))){
				 $where_reportsclause['user_group_id']=$this->input->post('id');
				 $where_reportsclause['type']="3";
 				 $reportscontroll_id=array_keys($this->input->post('Reports'));
				 $useracessreports['status']='1';
				 $useracessreports['user']= $this->session->userdata('id');
 			     $useracessreports['modified']= date("Y-m-d H:i:s");
				 $this->useracess_model->db_update("user_acess",$useracessreports,$where_reportsclause,$reportscontroll_id);
			 }
			 if(!empty($this->input->post('geoffence'))){
				 
				 $where_geoffenceclause['user_group_id']=$this->input->post('id');
				 $where_geoffenceclause['type']="4";
 				 $geoffencecontroll_id=array_keys($this->input->post('geoffence'));
				 $useracessgeoffence['status']='1';
				 $useracessgeoffence['user']= $this->session->userdata('id');
 			     $useracessgeoffence['modified']= date("Y-m-d H:i:s");
				 $this->useracess_model->db_update("user_acess",$useracessgeoffence,$where_geoffenceclause,$geoffencecontroll_id);
			 }
			 if(!empty($this->input->post('g_group'))){
				 
				 $where_geoffencegroupclause['user_group_id']=$this->input->post('id');
				 $where_geoffencegroupclause['type']="5";
 				 $geoffencegroupcontroll_id=array_keys($this->input->post('g_group'));
				 $useracessgeoffencegroup['status']='1';
				 $useracessgeoffencegroup['user']= $this->session->userdata('id');
 			     $useracessgeoffencegroup['modified']= date("Y-m-d H:i:s");
				 $this->useracess_model->db_update("user_acess",$useracessgeoffencegroup,$where_geoffencegroupclause,$geoffencegroupcontroll_id);
			 }
			 if($this->input->post('Geoffence_creation')!==NULL){
				 
				 $where_geoffencecreationclause['user_group_id']=$this->input->post('id');
				 $where_geoffencecreationclause['type']="6";
 				 $geoffencecreationcontroll_id="1";
				 $useracessgeoffencecreation['status']='1';
				 $useracessgeoffencecreation['user']= $this->session->userdata('id');
 			     $useracessgeoffencecreation['modified']= date("Y-m-d H:i:s");
				 $this->useracess_model->db_update("user_acess",$useracessgeoffencecreation,$where_geoffencecreationclause,$geoffencecreationcontroll_id);
			 }
			 if($this->input->post('Shipping')!==NULL){
				 
				 $where_shippingclause['user_group_id']=$this->input->post('id');
				 $where_shippingclause['type']="7";
 				 $shippingcontroll_id="1";
				 $useracessshipping['status']='1';
				 $useracessshipping['user']= $this->session->userdata('id');
 			     $useracessshipping['modified']= date("Y-m-d H:i:s");
				 $this->useracess_model->db_update("user_acess",$useracessshipping,$where_shippingclause,$shippingcontroll_id);
			 }
			 
 		}
		else{
			   $return['error_flag']="1";
			   $return['error_flag']="Some Error Occur.Please Contact Admin";
	   }
 
     print json_encode($return);
		 
   }
	
   
 }
 
?>