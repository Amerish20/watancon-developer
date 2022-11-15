<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_template extends CI_Controller {
	
	public function __construct()
      {
        parent::__construct();
          //$this->load->model('device_model');

 		 $this->load->model('Email_model');
		 $this->load->helper('url');
		 login_check();
      }

	  public function index()
	  {	
	  		//print "hai";
	  	  $whereheader_clause['ua.user_group_id']=$this->session->userdata('id');
	      $whereheader_clause['ua.type']="1";
	      $whereheader_clause['ua.status']="1";
 	      $data1['masters_data']=$this->Email_model->master_join("m.id,m.master,m.controller",$whereheader_clause);
		  $data1['heading']="E-mail";
		  $data1['page_head_icon']="fa fa-envelope";
		  $emailfulldata= $this->Email_model->db_datacheck("id,email_subject","Email_template");
		  $data['emailfulldata']=$emailfulldata;
		   $this->load->view('header',$data1);
    	   $this->load->view('email-editor',$data);
    	   $this->load->view('footer');
		  
	  }
	  
	  public function mail_insert(){
 		   
		  $emaildata['email_subject']=$this->input->post('subject');
		  $emaildata['email_content']=$this->input->post('txtEditor');
		  $emaildata['created']= date("Y-m-d H:i:s");		  
 		  $result=$this->Email_model->db_insert("email",$emaildata);
 		  if($result==""){
 			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
 		  }else{
			  $return['error_flag']="0";
			  $return['message']="E-mail Template inserted successfully";
		  }
		  print json_encode($return);
	  }
	  
	   public function mail_update(){
 		     
 
		  if($this->input->post('id')!=""){
			  
 			  $where_clause['id']=$this->input->post('id');
			  $emaildata['email_subject']=$this->input->post('subject');
		      $emaildata['email_content']=$this->input->post('txtEditor');
 			  $total_updation=$this->Email_model->db_update("Email_template",$emaildata,$where_clause);
			  if($total_updation>0){
 				 $return['error_flag']="0";
				 $return['message']="E-mail Template Updated successfully";
			  }else{
				  $return['error_flag']="1";
			      $return['message']="Some Error Occur.Please Contact Admin";
			  }
			  
		  }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		  }		  
		 print json_encode($return);
		  
	   }
	  
	   public function show_template(){
		    $return['error_flag']="0";
		   $where['id']=$this->input->post('id');
 		   $emailfulldata= $this->Email_model->db_datacheck("email_content,email_subject","Email_template",$where,1);
		   if(count($emailfulldata)>0){
			    $return['subject']=$emailfulldata['email_subject'];
			   $return['message']=$emailfulldata['email_content'];
 		   }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		   }
		    print json_encode($return);
		   
	   }
 }
?>