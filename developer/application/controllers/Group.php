<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Group extends CI_Controller {
	
   public function __construct()
   {
      parent::__construct();
        login_check();
 	 $this->load->model('group_model');
	 $this->load->helper('file');
	 $this->load->library('upload');
	 $this->load->library('form_validation');
	 
   }
   public function index(){
      $whereheader_clause['u.id']=$this->session->userdata('id');
	  $whereheader_clause['ua.type']="1";
	  $whereheader_clause['ua.status']="1";
	  $data1['masters_data']=$this->group_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
	  $reportwhere_clause=array();
	   $reportwhere_clause['u.id']=$this->session->userdata('id');
	   $reportwhere_clause['ua.type']="3";
	   $reportwhere_clause['ua.status']="1";
	   $report_status=$this->group_model->master_join("ua.controll_id",$reportwhere_clause);
	   $data1['report_status']="0"; 
	   if(count($report_status)>0){
		   $data1['report_status']="1";
	   }
 	   
	  $data1['heading']="Vehicle Type Master";
	  $data1['page_head_icon']="icon icon-fleet";
	  $groupfulldata= $this->group_model->db_datacheck("id,name,move_icon,idle_icon,stop_icon,maintanance_km,maintanance_month,maintanance_hours,status,created,modified","vehicle_group");
      $data['groupfulldata']=$groupfulldata;
	  $data['running_images']=$this->display_images("running");
	  $data['idle_images']=$this->display_images("idle");
	  $data['stop_images']=$this->display_images("stop");
	  

	   //print '<pre>'; print_r($data);
	  $this->load->view('header',$data1);
      $this->load->view('grouplist',$data);
	  $this->load->view('footer');
   }
   
   public function display_images($folder_name){
	   $return=array();
	   $this->load->helper('directory'); //load directory helper
		$dir = "lib/images/vehicle_icons/".$folder_name."/"; // Your Path to folder
		//print $dir;
		$vehicle_images = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */
		//var_dump($running_images);
		return $vehicle_images;
   }
   
   public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
   }
   
   
   public function group_insert(){
	  $return=array();
	  $error="0";
 	 
 	 $this->form_validation->set_rules('name', 'name', 'required');
     $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	 if ($this->form_validation->run() == TRUE) {
		 
  		  $where_clause['name']=$this->input->post('name');
		  $groupfulldata= $this->group_model->db_datacheck("id","vehicle_group",$where_clause);
 		  if(count($groupfulldata)==0){
			  
  			  
  	         if((isset($_FILES["run"]["name"]) || isset($_FILES["stop"]["name"]) || isset($_FILES["idle"]["name"]) ) && ($_FILES["run"]["name"]!="" || $_FILES["stop"]["name"]!="" || $_FILES["idle"]["name"]!="") ){
				
				 
                $config['upload_path']          =FCPATH."lib/images/group_icons/";  
                $config['allowed_types']        = 'jpg|jpeg|png|gif'; 
				$config['overwrite']            = 'TRUE';
                $config['max_size']             = '100';
                $config['max_width']            = '100';
                $config['max_height']           = '100'; 
				$config['encrypt_name']         = TRUE;
  				$this->upload->initialize($config);
				
 				
				if($_FILES["run"]["name"]!="" && isset($_FILES["run"]["name"])){
					
					if(!$this->upload->do_upload('run'))  
                    {  
					  $errors = $this->upload->display_errors();
 				         $return['error_flag']="1";
						 $error="1";
					     $return['message']="Some Error Occur on Moving image uploading.Please Contact Admin";
                         $this->upload->display_errors(); 
                    }else{
 				          $data = $this->upload->data(); 
  					     $datagroup['move_icon']=$data['file_name'];
 				    }
				}
				
				
 				if($_FILES["idle"]["name"]!=""  && isset($_FILES["idle"]["name"])){
					
					if(!$this->upload->do_upload('idle')){
						$return['error_flag']="1";
						$error="1";
						$return['message']="Some Error Occur on idle image uploading.Please Contact Admin";
						$this->upload->display_errors(); 
						
                   }else{
 				         $data = $this->upload->data(); 
  					     $datagroup['idle_icon']=$data['file_name'];
  					     
				   }
				}
				
				if($_FILES["stop"]["name"]!=""  && isset($_FILES["stop"]["name"])){
					
					if(!$this->upload->do_upload('stop')){  
						$return['error_flag']="1";
						$error="1";
						$return['message']="Some Error Occur on stop image uploading.Please Contact Admin";
					    $this->upload->display_errors();  
                   }else{
 					   $data = $this->upload->data(); 
					   $datagroup['stop_icon']=$data['file_name'];
 				   }
 				}
				
			} 
			
			if($this->input->post("moveimg_url")!=""){
 				
			     $url=FCPATH."lib/images/vehicle_icons/running/".basename($this->input->post("moveimg_url"));
				 $new_file_name=$this->generateRandomString().".png";
 			     $new_file = FCPATH."lib/images/group_icons/".$new_file_name;
				 
				 if( copy($url,$new_file)){
					 $datagroup['move_icon']=$new_file_name;
					 $error="0";
				 }else{
					 $error="1";
				 }
			}
			if($this->input->post("idleimg_url")!=""){
				 $url=FCPATH."lib/images/vehicle_icons/idle/".basename($this->input->post("idleimg_url"));
				 $new_file_name=$this->generateRandomString().".png";
 			     $new_file = FCPATH."lib/images/group_icons/".$new_file_name;
				 
				 if( copy($url,$new_file)){
					 $datagroup['idle_icon']=$new_file_name;
					 $error="0";
				 }else{
					 $error="1";
				 }
			}
 		    if($this->input->post("stopimg_url")!=""){ 
			     $url=FCPATH."lib/images/vehicle_icons/stop/".basename($this->input->post("stopimg_url"));
				 $new_file_name=$this->generateRandomString().".png";
 			     $new_file = FCPATH."lib/images/group_icons/".$new_file_name;
				 
				 if( copy($url,$new_file)){
					 $datagroup['stop_icon']=$new_file_name;
					 $error="0";
				 }else{
					 $error="1";
				 } 
			}
				
 			if($error=="0"){ 
			
			
		       $datagroup['name']=$this->input->post('name');
 		       $datagroup['maintanance_km']=$this->input->post('maintanance_km');
			   $datagroup['maintanance_month']=$this->input->post('maintanance_month');
			   $datagroup['maintanance_hours']=$this->input->post('maintanance_hours');
		       
			   $datagroup['status']="1";
			   $datagroup['user']=$this->session->userdata('id');
			   $datagroup['created']= date("Y-m-d H:i:s");
			   $result=$this->group_model->db_insert("vehicle_group",$datagroup);
			   if($result==""){
				   $return['error_flag']="1";
				   $return['message']="Some Error Occur.Please Contact Admin";
			   }else{
				   $return['error_flag']="0";
			   }
			}
              
	   }else{
		     $return['error_flag']="1";
		     $return['message']="Group Name Already exist";
	   }
	 }else{
		 $return['error_flag']="1";
		 $return['message']="Please check the required fields";
     }
 	 print json_encode($return);
    }
	
	
  /*  public function groupimage_removal(){
		$where_clause['id']=$this->input->post('id');
        $group_data=$this->group_model->db_datacheck("icon","vehicle_group",$where_clause,"1");
		//unlink(FCPATH."lib/images/group_icons/".$group_data['icon']) or die("cannt unlink");
 		$image_data['icon']="";
		//$this->group_model->db_update("vehicle_group",$image_data,$where_clause);
		
	}*/
   
    
   public function selecting(){
	 $return=array();
		  //$where_clause['id']="1";
	 $where_clause['id']=$this->input->post('id');
     $group_data=$this->group_model->db_datacheck("id,name,move_icon,idle_icon,stop_icon,maintanance_km,maintanance_month,maintanance_hours","vehicle_group",$where_clause,"1");
     if(count($group_data)>0){
		 $return['error_flag']="0";
		 $group_resultdata['name']= $group_data['name'];
		 if($group_data['move_icon']!="")
 		   $group_resultdata['move_icon']= $group_data['move_icon'];
		 if($group_data['idle_icon']!="")
 		   $group_resultdata['idle_icon']= $group_data['idle_icon'];  
		 if($group_data['stop_icon']!="")
 		   $group_resultdata['stop_icon']= $group_data['stop_icon'];
 		 $group_resultdata['maintanance_km']=$group_data['maintanance_km'];
		 $group_resultdata['maintanance_month']= $group_data['maintanance_month'];
		 $group_resultdata['maintanance_hours']=$group_data['maintanance_hours'];
 		 $return['information']=$group_resultdata;
	 }
	 else{
		 $return['error_flag']="1";
		 $return['message']="Some Error Occur.Please Contact Admin";
     }
 	 print json_encode($return);
   }
   
   
   public function group_updation(){
 
 	 $return=array();
	 $error="0";
  	 $this->form_validation->set_rules('name', 'name', 'required');
     $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	 if ($this->form_validation->run() == TRUE) {
 		 if($this->input->post('id')!=""){
			 
		  $where_clause['id']=$this->input->post('id');
 		 if((isset($_FILES["run"]["name"]) || isset($_FILES["stop"]["name"]) || isset($_FILES["idle"]["name"]) ) && ($_FILES["run"]["name"]!="" || $_FILES["stop"]["name"]!="" || $_FILES["idle"]["name"]!="") ){
			 
   				$config['upload_path']          =FCPATH."lib/images/group_icons";  
                $config['allowed_types']        = 'JPG|JPEG|jpg|jpeg|png|gif|ico'; 
				$config['overwrite']            = 'TRUE';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768; 
				$config['encrypt_name']         = TRUE;
  				$this->upload->initialize($config);
				
				
				if($_FILES["run"]["name"]!="" && isset($_FILES["run"]["name"])){
					
 					if(!$this->upload->do_upload('run'))  
                    {  
					     $error="1";
				         $return['error_flag']="1";
					     $return['message']="Some Error Occur on Moving image uploading.Please check the Image Upload conditions";
                  
                   }else{
					   
 					     $group_data=$this->group_model->db_datacheck("move_icon","vehicle_group",$where_clause,"1");
						 if($group_data['move_icon']!=""){
		                    unlink(FCPATH."lib/images/group_icons/".$group_data['move_icon']) ; 
						 }
 				         $data = $this->upload->data(); 
  					     $image_data['move_icon']=$data['file_name'];
 				   }
				}
				
				if($_FILES["idle"]["name"]!=""  && isset($_FILES["idle"]["name"])){
					
					if(!$this->upload->do_upload('idle')){
						 
						 $error="1";
						$return['error_flag']="1";
						$return['message']="Some Error Occur on idle image uploading.Please check the Image Upload conditions";
						$this->upload->display_errors(); 
						
                   }else{
					     $group_data=$this->group_model->db_datacheck("idle_icon","vehicle_group",$where_clause,"1");
						 
						  if($group_data['idle_icon']!=""){
		                    unlink(FCPATH."lib/images/group_icons/".$group_data['idle_icon']) ; 
						  }
						 $return['error_flag']="0"; 
				         $data = $this->upload->data(); 
  					     $image_data['idle_icon']=$data['file_name'];
  					     
				   }
				}
				
				if($_FILES["stop"]["name"]!=""  && isset($_FILES["stop"]["name"])){
					
					if(!$this->upload->do_upload('stop')){  
					     $error="1";
						$return['error_flag']="1";
						$return['message']="Some Error Occur on stop image uploading.Please check the Image Upload conditions";
					    $this->upload->display_errors();  
                   }else{
				   
					   $group_data=$this->group_model->db_datacheck("stop_icon","vehicle_group",$where_clause,"1");
					    if($group_data['stop_icon']!=""){
					     unlink(FCPATH."lib/images/group_icons/".$group_data['stop_icon']); 
						}
					   $return['error_flag']="0"; 
					   $data = $this->upload->data(); 
					   $image_data['stop_icon']=$data['file_name'];
 				   }
 				}
				
			     if($error=="0"){
 				   $this->group_model->db_update("vehicle_group",$image_data,$where_clause);
				}
  			}
			
			if($this->input->post("moveimg_url")!=""){
 				
			     $url=FCPATH."lib/images/vehicle_icons/running/".basename($this->input->post("moveimg_url"));
				 $new_file_name=$this->generateRandomString().".png";
 			     $new_file = FCPATH."lib/images/group_icons/".$new_file_name;
				 
				 if( copy($url,$new_file)){
					 $datagroup['move_icon']=$new_file_name;
					 $error="0";
				 }else{
					 $error="1";
				 }
			}
			if($this->input->post("idleimg_url")!=""){
				 $url=FCPATH."lib/images/vehicle_icons/idle/".basename($this->input->post("idleimg_url"));
				 $new_file_name=$this->generateRandomString().".png";
 			     $new_file = FCPATH."lib/images/group_icons/".$new_file_name;
				 
				 if( copy($url,$new_file)){
					 $datagroup['idle_icon']=$new_file_name;
					 $error="0";
				 }else{
					 $error="1";
				 }
			}
 		    if($this->input->post("stopimg_url")!=""){ 
			     $url=FCPATH."lib/images/vehicle_icons/stop/".basename($this->input->post("stopimg_url"));
				 $new_file_name=$this->generateRandomString().".png";
 			     $new_file = FCPATH."lib/images/group_icons/".$new_file_name;
				 
				 if( copy($url,$new_file)){
					 $datagroup['stop_icon']=$new_file_name;
					 $error="0";
				 }else{
					 $error="1";
				 } 
			}
 		  if($error=="0"){
				
			  $datagroup['maintanance_km']=$this->input->post('maintanance_km');
		      $datagroup['maintanance_month']=$this->input->post('maintanance_month');
			  $datagroup['maintanance_hours']=$this->input->post('maintanance_hours');
			  $datagroup['name']=$this->input->post('name');
			  $datagroup['user']=$this->session->userdata('id');
			  $datagroup['modified']= date("Y-m-d H:i:s");
 
			  $this->group_model->db_update("vehicle_group",$datagroup,$where_clause);
		  }
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
  public function vehicle_group_deletion(){	 
      
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $wherevehciel_data['group_id']=$this->input->post('id');
			   $vehicleresult=$this->group_model->db_datacheck("id","vehicle_data",$wherevehciel_data);
			   if(count($vehicleresult)==0){
				   $values['status']="0";	
			       $values['user']=$this->session->userdata('id');
		           $values['modified']= date("Y-m-d H:i:s");			   
 			       $where_clause['id']=$this->input->post('id');
			       $result=$this->group_model->db_update("vehicle_group",$values,$where_clause);	
			   }else{
				   $return['error_flag']="1";
			       $return['message']="Cannt able to deactivate.Group Is already assignied to vehicle.";
			   }
			   
			   		   
		  }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  
 public function vehicle_group_active(){ 		     
 
		  if($this->input->post('id')!=""){
			   $return['error_flag']="0";
			   $values['status']="1";
			   $values['user']=$this->session->userdata('id');
		       $values['modified']= date("Y-m-d H:i:s");			   
 			   $where_clause['id']=$this->input->post('id');
			   $result=$this->group_model->db_update("vehicle_group",$values,$where_clause);			   
		  }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		  }
		   print json_encode($return);
 	  }
	  public function groupname_check(){
		  
		    $this->input->post("group_id");
 		   if($this->input->post("group_id")!=""){
		      $where_clause['id!=']=$this->input->post("group_id");
		   }
		   $where_clause['name']=$this->input->post("group_name");
 		   $group_data=$this->group_model->db_datacheck("id","vehicle_group",$where_clause);
		   print json_encode(count($group_data));
 	  }
	
}

?>