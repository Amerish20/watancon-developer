<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ibutton extends CI_Controller {
	
	public function __construct()
      {
          parent::__construct();
  		$this->load->model('ibutton_model');
		$this->load->helper('url');
		
      }

	  public function index()
	  {
 
           login_check();
		   $whereheader_clause['u.id']=$this->session->userdata('id');
	       $whereheader_clause['ua.type']="1";
	       $whereheader_clause['ua.status']="1";
	       $data1['masters_data']=$this->ibutton_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
		   $data1['heading']="Ibutton Master";
		   $data1['page_head_icon']="fa fa-mobile";
		   $reportwhere_clause=array();
		   $reportwhere_clause['u.id']=$this->session->userdata('id');
		   $reportwhere_clause['ua.type']="3";
		   $reportwhere_clause['ua.status']="1";
		   $report_status=$this->ibutton_model->master_join("ua.controll_id",$reportwhere_clause);
		   $data1['report_status']="0"; 
		   if(count($report_status)>0){
			   $data1['report_status']="1";
		   }
		   
 		   $devicefulldata= $this->ibutton_model->full_data();
 		   $data['ibuttonfulldata']=$devicefulldata;
 		   
		   
		   $this->load->view('header',$data1);
   		   $this->load->view('ibuttonlist',$data);
		   $this->load->view('footer'); 
	  }
	  
	  
	  
	  public function ibutton_insert(){
 		   
		  $dataibutton['ibutton_number']=strtoupper($this->input->post('ibutton'));
 		  $dataibutton['user']= $this->session->userdata('id');
	      $dataibutton['created']= date("Y-m-d H:i:s");
  		  $result=$this->ibutton_model->db_insert("ibutton",$dataibutton);
  		  if($result==""){
 			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
 		  }else{
			   
			  $return['error_flag']="0";
		  }
		   print json_encode($return);
	  }
 
	   public function selecting(){
		   
		 $return=array();
 		 $where_clause['id']=$this->input->post('id');
  		 $ibutton_data=$this->ibutton_model->db_datacheck("ibutton_number as ibutton ","ibutton",$where_clause,"1");
 		 if(count($ibutton_data)>0){ 
		     
		    $return['error_flag']="0"; 
		    $ibutton_resultdata['ibutton']= $ibutton_data['ibutton'];
			$return['information']=$ibutton_resultdata;
		 }else{
			$return['error_flag']="1";
		    $return['error_message']="Some Error Occur.Please Contact Admin";
		 }
 		  print json_encode($return);
		  
 	   }
	   
	   public function ibutton_updation(){
 		     
		  if($this->input->post('id')!=""){
			  
			  $where_clause['id']=$this->input->post('id');
			  $device_data=$this->ibutton_model->db_datacheck("ibutton_number","ibutton",$where_clause,"1");

		     if($device_data['ibutton_number']==strtoupper($this->input->post('ibutton'))){

			   $return['error_flag']="2";
			   $return['message']="There is no changes!";
			  
		     }else{ 
			  
			   $return['error_flag']="0";
			   $where_clause['id']=$this->input->post('id');
			   $ibuttondevice['ibutton_number']=strtoupper($this->input->post('ibutton'));		     
 			   $ibuttondevice['user']= $this->session->userdata('id');
	           $ibuttondevice['modified']= date("Y-m-d H:i:s");
			   $this->ibutton_model->db_update("ibutton",$ibuttondevice,$where_clause);
			}
			   
		  }else{
			  $return['error_flag']="1";
		      $return['error_message']="Some Error Occur.Please Contact Admin";
 		  }
		  
		  print json_encode($return);
	   }


 
	   public function ibutton_unlinkanddeactivate(){
		   $return=array();
		    if($this->input->post('id')!=""){
				$return['error_flag']="0";
 				$where_ibutton_data['ibuttonid']=$this->input->post('id');
  				$dataibutton['user']= $this->session->userdata('id');
 			    $dataibutton['modified']= date("Y-m-d H:i:s");
				$dataibutton['ibuttonid']="0";
 			    $this->ibutton_model->db_update("driver_data",$dataibutton,$where_ibutton_data);
			    $return['error_flag']="0";
				$values['user']= $this->session->userdata('id');
 			    $values['modified']= date("Y-m-d H:i:s");
			    $values['status']="0";	      
 			    $values['modified']=date("Y-m-d H:i:s");	
  			    $where_clause['id']=$this->input->post('id');
			    $result=$this->ibutton_model->db_update("ibutton",$values,$where_clause);
                 
 			}else{
			  $return['error_flag']="1";
		      $return['error_message']="Some Error Occur.Please Contact Admin";
 		    }
		  
		  print json_encode($return);
		   
	   }
 	   
	  public function ibutton_deactive(){	     
 
		  if($this->input->post('id')!=""){
			  $where_device_data['ibuttonid']=$this->input->post('id');
  			  $ibutton_data=$this->ibutton_model->db_datacheck("Name","driver_data",$where_device_data,"1");
			  if(is_array($ibutton_data)){
				 $return['error_flag']="2";
				 $return['message']="This Ibutton is using by Mr. ".$ibutton_data['Name'].". Shall we unlik this ibutton from him?";
 			  }else{
			  
 			   $return['error_flag']="0";
			   $values['status']="0";
			   $values['user']=$this->session->userdata('id');
			   $values['modified']=date("Y-m-d H:i:s");	
			   		   
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->ibutton_model->db_update("ibutton",$values,$where_clause);
 
			  }
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function ibutton_active(){ 		     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="1";
			   $values['user']=$this->session->userdata('id');
			   $values['modified']=date("Y-m-d H:i:s");			   
  			   $where_clause['id']=$this->input->post('id');
			   $result=$this->ibutton_model->db_update("ibutton",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['error_message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function ibutton_check(){
		   if($this->input->post("id")!=NULL){
		     $where_clause['id!=']=$this->input->post("id");
		   }
 		   $where_clause['ibutton_number']=$this->input->post("ibutton");
 		   $datadevice=$this->ibutton_model->db_datacheck("id","ibutton",$where_clause);
		   print json_encode(count($datadevice));
 	  }
	  
}
?>