<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Geoffence extends CI_Controller {
	
	public function __construct()
    {    
	    parent::__construct();
		$this->load->model('geoffence_model');
		$this->load->helper('url');
	}
	public function index(){
		
		 login_check();
   	      $whereheader_clause['u.id']=$this->session->userdata('id');
	      $whereheader_clause['ua.type']="1";
	      $whereheader_clause['ua.status']="1";
	      $data1['masters_data']=$this->geoffence_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
	      $data1['heading']="Geoffence Master";
		  $data1['page_head_icon']="fa fa-map-marker";
		  $reportwhere_clause=array();
		   $reportwhere_clause['u.id']=$this->session->userdata('id');
		   $reportwhere_clause['ua.type']="3";
		   $reportwhere_clause['ua.status']="1";
		   $report_status=$this->geoffence_model->master_join("ua.controll_id",$reportwhere_clause);
		   $data1['report_status']="0"; 
		   if(count($report_status)>0){
			   $data1['report_status']="1";
		   }
		 
		 
 		$geoffence_data= $this->geoffence_model->db_datacheck("id,geofence_code,name,status,created,modified","geoffence");
  		$data['geoffencefulldata']=$geoffence_data;
		$wheregeoffence_group['status']="1";
		$data['geo_group']= $this->geoffence_model->db_datacheck("id,Name","Geoffence_group",$wheregeoffence_group);
		$data['cust_details']= $this->geoffence_model->db_datacheck("id,cust_name","customer_name",$wheregeoffence_group);
	    $this->load->view('header',$data1);
    	$this->load->view('geoffencelist',$data);
		$this->load->view('footer');
	}
	
	public function selecting(){
 		  $return=array();
		   $where_clause['id']="1";
		   $where_clause['id']=$this->input->post('id');
		   $where['g.id']=$this->input->post('id');
  		  $geoffence_data=$this->geoffence_model->db_datacheck("geofence_code,name,geo_group,color,cust_id,user","geoffence",$where_clause,"1");
		 	$customer_data=$this->geoffence_model->customer_join($where);
			
          if(count($geoffence_data)>0){
  			$return['error_flag']="0";
			$geoffence_resultdata['geofence_code']= $geoffence_data['geofence_code'];
  		    $geoffence_resultdata['name']= $geoffence_data['name'];
 			$geoffence_resultdata['geo_group']= $geoffence_data['geo_group'];
			$geoffence_resultdata['cust_id']= $geoffence_data['cust_id'];
		    $geoffence_resultdata['color']= $geoffence_data['color'];
			$geoffence_resultdata['cust_name']= $customer_data['cust_name'];
			
   			$return['information']=$geoffence_resultdata;
			
		  }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		  }
		  
		  print json_encode($return);
 		  
	  }
	   public function geoffence_updation(){
 		      
 		  if($this->input->post('id')!=""){
			 
			$return['error_flag']="0";
 			$where_clause['id']=$this->input->post('id'); 
			$datageoffence['geofence_code']= $this->input->post('geofence_code');
		    $datageoffence['name']= $this->input->post('name');
		    $datageoffence['color']= $this->input->post('color');
			$datageoffence['cust_id']=$this->input->post('cust_id');
			$datageoffence['geo_group']= $this->input->post('geo_group');
 			$datageoffence['user']=$this->session->userdata('id');			
		    $datageoffence['modified']= date("Y-m-d H:i:s");
   		    $this->geoffence_model->db_update("geoffence",$datageoffence,$where_clause);
			  
		  }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		  }
		  print json_encode($return);
		  
	   }
	    public function show_geoffence(){
			
 		  if($this->input->post('id')!=""){
			  
			  
			  $where_clause=array();
			  $where_clause['id']=$this->input->post('id');
			  $gps_cordinate= $this->geoffence_model->db_datacheck("boundaries,color,name","geoffence",$where_clause,1);
 			  $boundary_data=explode("),",$gps_cordinate['boundaries']);
			  $boundaries="";
			   foreach($boundary_data as $key=>$datasb){
 				   $cordiantes=explode("," ,str_replace("(","",$datasb) );
 				   $boundaries.=$cordiantes["0"].",".trim($cordiantes["1"])."|";
			   }
			  $return['error_flag']="0";
 			  $return['information']=substr($boundaries,0,strlen($boundaries)-2);
			  $return['color']=strtolower($gps_cordinate['color']);
			  $return['name']=strtoupper($gps_cordinate['name']);
			  
			  $where_all['id!=']=$this->input->post('id');
			  $gpsfull_cordinate= $this->geoffence_model->db_datacheck("id,boundaries,color,name","geoffence",$where_all);
			  
			  foreach($gpsfull_cordinate as $gpsfull_cordinate_key=>$gpsfull_cordinate_data){
				  
				  $boundary_data=explode("),",$gpsfull_cordinate_data['boundaries']);
			      $boundaries="";
			      foreach($boundary_data as $key=>$datasb){
 				      $cordiantes=explode("," ,str_replace("(","",$datasb) );
 				      $boundaries.=$cordiantes["0"].",".trim($cordiantes["1"])."|";
			      }
				  
				  $geoffence_id=$gpsfull_cordinate_data["id"];
				  $full_geoffence[$geoffence_id]['information']=substr($boundaries,0,strlen($boundaries)-2);
			      $full_geoffence[$geoffence_id]['color']=strtolower($gpsfull_cordinate_data['color']);
			      $full_geoffence[$geoffence_id]['name']=strtoupper($gpsfull_cordinate_data['name']);
				  
			  }
			  
			  $return['full_geoffence']=$full_geoffence;
 			  
		  }
		  else{
			    $return['error_flag']="1";
		        $return['message']="Some error occur.Please contact admin";
	      }
		   print json_encode($return);
		  
 	  }
	   public function geoffencepos_updation(){
		   
 
 
 
 
 		    if($this->input->post('id')!="" && $this->input->post('boundaries')!=""){
				$where_clause=array();
				$updategeoffence=array();
			    $where_clause['id']=$this->input->post('id');
				$updategeoffence['boundaries']=$this->input->post('boundaries');
				$updategeoffence['modified']= date("Y-m-d H:i:s");
				$updategeoffence['user']=$this->session->userdata('id');
				$this->geoffence_model->db_update("geoffence",$updategeoffence,$where_clause);
				$return['error_flag']="0";
  			}else{
				$return['error_flag']="1";
		        $return['message']="Some error occur.Please contact admin";
			}
			print json_encode($return);
	   }
	   public function geoffence_deactive(){
 			if($this->input->post('id')!=""){
			   $where_clause['id']=$this->input->post('id');
 			   $geoffence_data['status']="0";
			   $geoffence_data['user']=$this->session->userdata('id'); 
			   $geoffence_data['modified']= date("Y-m-d H:i:s");
			   $result=$this->geoffence_model->db_update("geoffence",$geoffence_data,$where_clause);
			   if($result>0){
				   $return['error_flag']="0";
				   $return['message']="Geoffence Updated successfully";
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
	  public function geoffence_activate(){
		  
			if($this->input->post('id')!=""){
			   $where_clause['id']=$this->input->post('id');
			    $geoffence_data['status']="1";
			    $geoffence_data['user']=$this->session->userdata('id'); 
			    $geoffence_data['modified']= date("Y-m-d H:i:s");
			    $return['error_flag']="0";
			   $result=$this->geoffence_model->db_update("geoffence",$geoffence_data,$where_clause);
			   if($result>0){
				   $return['error_flag']="0";
				   $return['message']="Geoffence Updated successfully";
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
	   
}
	