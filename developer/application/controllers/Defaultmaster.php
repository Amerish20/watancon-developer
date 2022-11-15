<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Defaultmaster extends CI_Controller {
	
	public function __construct()
      {
        parent::__construct();
          //$this->load->model('device_model');

 		 $this->load->model('Default_master_model');
		 $this->load->helper('url');
		 login_check();
      }

	  public function index()
	  {	
	  		 
    	  $whereheader_clause['u.id']=$this->session->userdata('id');
	      $whereheader_clause['ua.type']="1";
	      $whereheader_clause['ua.status']="1";
	      $data1['masters_data']=$this->Default_master_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
 		  $data1['heading']="Default Master";
		  $data1['page_head_icon']="fa fa-unlock-alt";
		   $reportwhere_clause=array();
		   $reportwhere_clause['u.id']=$this->session->userdata('id');
		   $reportwhere_clause['ua.type']="3";
		   $reportwhere_clause['ua.status']="1";
		   $report_status=$this->Default_master_model->master_join("ua.controll_id",$reportwhere_clause);
		   $data1['report_status']="0"; 
		   if(count($report_status)>0){
			   $data1['report_status']="1";
		   }
		   
		  $geoffencegroupfulldata= $this->Default_master_model->db_datacheck("id,Name,priority,status","Geoffence_group");
 		  $data['geoffencegroupfulldata']=$geoffencegroupfulldata;
 		  $data['mail_settings']=$this->Default_master_model->db_datacheck("Host,User_name,Password,from_addr,Mail_name","Mail_settings","","1");
		  $emailfulldata= $this->Default_master_model->db_datacheck("id,Name,email_subject","Email_template");
 		  $data['emailfulldata']=$emailfulldata;
		  
		  $data['geoffencegrouppriority']=$geoffencegrouppriority;
		  
		  $cronfulldata= $this->Default_master_model->db_datacheck("id,reminder_status,reminder_time,to_addr,cc_addr","cron_settings","","1");
 		  $data['cronfulldata']=$cronfulldata;
 		  $groups_data= $this->Default_master_model->db_datacheck("id,name","vehicle_group",$where_clause);
		  $data['groups']=$groups_data;
 		  
		  $alert_settings=$this->Default_master_model->select_alert_settings('as.id,as.Name as alert_name,gg.Name as geoffence_group_name,vg.name as vehicle_group ,as.created,as.modified');
		   $data['alert_settings']=$alert_settings;
 		   $emailddr=$this->Default_master_model->db_datacheck('*','Mail_Address',"");
		   $data['emailfulladdr']=$emailddr;

		   // Station Starts
 		   $stations 		 = $this->Default_master_model->db_datacheck('*','Stations',"");
		   $data['stations'] = $stations;
		   // Station Ends
 		  
 		   $this->load->view('header',$data1);
    	   $this->load->view('defaultlist',$data);
    	   $this->load->view('footer');
		  
	  }
	  public function groupname_check($name="",$id=""){
  		   $group_name=$name==""?$this->input->post("group_name"):$name;
  		   $where_clause['Name']=ucfirst(strtolower($group_name));
		   if($id!=""){
		     $where_clause['id!=']=$id;
		   }
 		   $group_data=$this->Default_master_model->db_datacheck("id","Geoffence_group",$where_clause);
		   
		   if($name==""){
 			   print json_encode(count($group_data));
		   }else{
 			   return  count($group_data);
		   }
  	  }
	  
 	  public function groupname_insert(){
		  
		  $name_check=$this->groupname_check($this->input->post('name'));
 		  if($name_check>0){
			  $return['error_flag']="1";
			  $return['message']="Group  name Already existed";
		  }else{
			  
			  $group_data['Name']=ucfirst(strtolower($this->input->post('name')));
			  $group_data['priority']=$this->input->post('priority');
			  $group_data['status']="1";
			  $group_data['user']=$this->session->userdata('id'); 
			  $group_data['created']= date("Y-m-d H:i:s");		
 			  $result=$this->Default_master_model->db_insert("Geoffence_group",$group_data);
			 
 			  if($result==0){
				   $return['error_flag']="1";
				   $return['message']="Some Error Occur.Please Contact Admin";
			  }else{
				  $return['error_flag']="0";
				  $return['message']="Geoffence Group inserted successfully";
			  }
		  }
		  
		  print json_encode($return);
	  }
	  
	   public function groupname_update(){
 		     
 
		  if($this->input->post('id')!=""){
			   $name_check=$this->groupname_check($this->input->post('name'),$this->input->post('id'));
			   if($name_check>0){
			     $return['error_flag']="1";
			     $return['message']="Group  name Already existed";
		      }else{
				 $where_clause['id']=$this->input->post('id');
			     $group_data['Name']=ucfirst(strtolower($this->input->post('name')));
			     $group_data['priority']=$this->input->post('priority');
				 $group_data['user']=$this->session->userdata('id'); 
			     $group_data['modified']= date("Y-m-d H:i:s");
 			     $total_updation=$this->Default_master_model->db_update("Geoffence_group",$group_data,$where_clause);
				if($total_updation>0){
				   $return['error_flag']="0";
				   $return['message']="Geoffence Group Updated successfully";
				}else{
					$return['error_flag']="1";
					$return['message']="Some Error Occur.Please Contact Admin";
				}
			  }
  		  }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		  }		  
		 print json_encode($return);
		  
	   }
	    public function selecting(){
		   
		 $return=array();
		 $priority=array();
		 
		 $geofence_priority_full=$this->Default_master_model->db_datacheck("priority","Geoffence_group");
		 $geofence_priority = array_column($geofence_priority_full, 'priority');
 		 $total_count=count($geofence_priority);
		 
		  for($i=1; $i<=($total_count +1);$i++){
			 if (!in_array($i, $geofence_priority)){
				 $priority[$i]=$i;
  		    } 
		 }
		 
		 
	 
  		 $where_clause['id']=$this->input->post('id');
  		 $group_data=$this->Default_master_model->db_datacheck("id,Name,priority","Geoffence_group",$where_clause,"1");
		 
		 
 		 if(count($group_data)>0){ 
		     
		    $return['error_flag']="0";
			 $priority[$group_data['priority']]=$group_data['priority'];
			//array_push($priority,$group_data['priority']);
 			sort($priority);
 		    $group_resultdata['id']= $group_data['id'];
 		    $group_resultdata['group_name']= $group_data['Name'];
			$group_resultdata['full_priority']=$priority;
 		    $group_resultdata['priority']= $group_data['priority'];
			
			$return['information']=$group_resultdata;
		 }else{
			$return['error_flag']="1";
		    $return['message']="Some Error Occur.Please Contact Admin";
		 }
 		  print json_encode($return);
		  
 	   }
	   
	    public function group_deactive(){
 			if($this->input->post('id')!=""){
			   $where_clause['id']=$this->input->post('id');
			   $wheregeogroup_data['geo_group']=$this->input->post('id');
			   $departmentresult=$this->Default_master_model->db_datacheck("id","geoffence",$wheregeogroup_data);
			   if(count($departmentresult)==0){
				    $group_data['status']="0";
			        $group_data['user']=$this->session->userdata('id'); 
			        $group_data['modified']= date("Y-m-d H:i:s");
  				    $result=$this->Default_master_model->db_update("Geoffence_group",$group_data,$where_clause);
				    if($result>0){
					   $return['error_flag']="0";
					   $return['message']="Geoffence Group Updated successfully";
					}else{
						$return['error_flag']="1";
						$return['message']="Some Error Occur.Please Contact Admin";
					}
 			   }else{
				   $return['error_flag']="1";
			       $return['message']="Cannt able to deactivate.Group Is already assignied to Geoffence.";
			   }
  			}else{
				$return['error_flag']="1";
		        $return['message']="Some Error Occur.Please Contact Admin";
			}
			 print json_encode($return);
			 
		}
		public function group_activate(){
			if($this->input->post('id')!=""){
			   $where_clause['id']=$this->input->post('id');
			    $group_data['status']="1";
			    $group_data['user']=$this->session->userdata('id'); 
			    $group_data['modified']= date("Y-m-d H:i:s");
			   $return['error_flag']="0";
			   $result=$this->Default_master_model->db_update("Geoffence_group",$group_data,$where_clause);
			   if($result>0){
				   $return['error_flag']="0";
				   $return['message']="Geoffence Group Updated successfully";
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
		
		public function mailsetting_update(){
			
			
			 $this->load->library('form_validation');
			 $this->form_validation->set_rules('Host', 'Host', 'required');
			 $this->form_validation->set_rules('User_name', 'User Name', 'required');
			 $this->form_validation->set_rules('Password', 'Password', 'required');
			 $this->form_validation->set_rules('from_addr', 'from address', 'required');
			 $this->form_validation->set_rules('Mail_name', 'Mail name', 'required');
			 $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	         if ($this->form_validation->run() == TRUE) {
				 
				 $host=$this->input->post('Host');
				 $username=$this->input->post('User_name');
				 $password=$this->input->post('Password');
				 $fromaddr=$this->input->post('from_addr');
				 $name=$this->input->post('Mail_name');
				 $this->load->library('email');
				 $config = array();
				 $config['protocol'] = 'smtp';
				 $config['smtp_host'] =$host;
				 $config['smtp_user'] = $username;
				 $config['smtp_pass'] = $password;
				 $config['smtp_port'] = '25';
 				 $this->email->initialize($config);
				 $this->email->set_newline("\r\n");
				 $this->email->from($fromaddr, $name);
				 
				 $this->email->to("gps@watancon.com");
 				 $this->email->subject("Test");
				 $this->email->message("test");
				 if($this->email->send()){
 					$mail_status['Host']=$this->input->post('Host');
					$mail_status['User_name']=$this->input->post('User_name');
					$mail_status['Password']=$this->input->post('Password');
					$mail_status['from_addr']=$this->input->post('from_addr');
					$mail_status['Mail_name']=$this->input->post('Mail_name');
					$mail_status['user']=$this->session->userdata('id'); 
					$mail_status['modified']=date("Y-m-d H:i:s");
					$where_mail_status['id']="1";
 				    $result=$this->Default_master_model->db_update("Mail_settings",$mail_status,$where_mail_status);
					 if($result>0){
						 $return['error_flag']="0";
						 $return['message']="Mail settings Updated successfully";
					  }else{
						  $return['error_flag']="1";
						  $return['message']="Some Error Occur.Please Contact Admin";
					  }
 		         }else{
			         $return['error_flag']="1";
		             $return['message']="Wrong details! Please check the details";
		         }
 			 }else{
		          $return['error_flag']="1";
		          $return['message']="Please check the required fields";
             }
 	          print json_encode($return);
			 die();
			 
		}
		
		 public function mail_insert(){
 		   
		  $emaildata['Name']=strtoupper($this->input->post('name')); 
		  $emaildata['email_subject']=$this->input->post('subject');
		  $emaildata['email_content']=$this->input->post('txtEditor');
		  $emaildata['user']= $this->session->userdata('id');
		  $emaildata['created']= date("Y-m-d H:i:s");		  
 		  $result=$this->Default_master_model->db_insert("Email_template",$emaildata);
 		  if($result==""){
 			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
			   
 		  }else{
			  $return['error_flag']="0";
			   $return['id']=$result;
			  $return['message']="E-mail Template inserted successfully";
		  }
		  print json_encode($return);
	  }
	  
	   public function mail_update(){
 		     
 
		  if($this->input->post('id')!=""){
			  
 			  $where_clause['id']=$this->input->post('id');
			  $emaildata['Name']=strtoupper($this->input->post('name'));
			  $emaildata['email_subject']=$this->input->post('subject');
		      $emaildata['email_content']=$this->input->post('txtEditor');
			  $emaildata['user']= $this->session->userdata('id');
			  $emaildata['modified']= date("Y-m-d H:i:s");
 			  $total_updation=$this->Default_master_model->db_update("Email_template",$emaildata,$where_clause);
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
 		   $emailfulldata= $this->Default_master_model->db_datacheck("Name,email_content,email_subject","Email_template",$where,1);
		   if(count($emailfulldata)>0){
			    $return['name']=$emailfulldata['Name'];
			    $return['subject']=$emailfulldata['email_subject'];
			   $return['message']=$emailfulldata['email_content'];
 		   }else{
			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
		   }
		    print json_encode($return);
		   
	   }
	   
	   public function delaysettings_update(){
		         $delay_data['reminder_time']= $this->input->post('reminder_min');
			     $delay_data['reminder_status']=$this->input->post('reminder_status');
				 $delay_data['to_addr']=$this->input->post('mail_to');
				 $delay_data['cc_addr']=$this->input->post('mail_cc');
				 $delay_data['user']=$this->session->userdata('id'); 
			     $delay_data['modified']= date("Y-m-d H:i:s");
 			     $total_updation=$this->Default_master_model->db_update("cron_settings",$delay_data,"");
				 if($total_updation>0){
				   $return['error_flag']="0";
				   $return['message']="Delay Settings Updated successfully";
				 }else{
					$return['error_flag']="1";
					$return['message']="Some Error Occur.Please Contact Admin";
				 }
		     print json_encode($return);
		   
	   }
	   public function mailtemplate_name_check(){
  		    
		   $where_clause['Name']=strtoupper($this->input->post("name"));
 		   $group_data=$this->Default_master_model->db_datacheck("id","Email_template",$where_clause);
		   print json_encode(count($group_data));
 	  }
	  
	  public function Template_delete(){
		  $where_clause['id']=$this->input->post('id');
  		  $email_delete=$this->Default_master_model->db_delete("Email_template",$where_clause);
 		  if($email_delete>0){
  			   $return['error_flag']="0";
			   $return['message']="Email Template  Deleted Successfully";
  		  }else{
 			  $return['error_flag']="1";
			  $return['message']="Some Error Occur.This Email Template is already linked to Alert Settings";
 		  }
		  
		   print json_encode($return);
	   }
	   
	   
	  
	  public function select_geoffence(){
		  
		  $where_existclause['geoffence_group_id']=$this->input->post("geo_group_id");
		 
		   $where_existclause['vehicle_group']=$this->input->post("vehicle_group")==""?"0":$this->input->post("vehicle_group");
		  
		  $exist_geoffence=$this->Default_master_model->db_datacheck("geoffence","alert_settings",$where_existclause);
 		  $geoffence_exist=array();
		  if(count($exist_geoffence)>0){
		    foreach($exist_geoffence as $key=>$data){
 			  $fulldata=explode(",",$data['geoffence']);
			  $geoffence_exist=array_merge($geoffence_exist, $fulldata);
		   }
 		  }
 		  $where_clause['geo_group']=$this->input->post("geo_group_id");
		  $group_data=$this->Default_master_model->db_geoffence_data("id,name","geoffence",$where_clause,$geoffence_exist);
 		  print json_encode( $group_data);
 		  
	  }
	  public function select_mail_address(){
		  $where_clause['type']=$this->input->post("type");
		  $mail_data=$this->Default_master_model->db_datacheck("id,email","Mail_Address",$where_clause);
		  print json_encode( $mail_data);
 		  
	  }
	  
	  public function Alert_setting_insert(){
		  
 		  $alert_settings['Name']=$this->input->post('alert_name'); 
  		  $alert_settings['geoffence_group_id']=$this->input->post('geoofence_group'); 
		  $alert_settings['geoffence ']=implode(",",$this->input->post('geoffence'));
		  $alert_settings['speed']=$this->input->post('speed')==""?0:$this->input->post('speed');
		  $alert_settings['triger']= $this->input->post('trigger');
		  $alert_settings['Template']= $this->input->post('template_name');
		  $alert_settings['vehicle_group']= $this->input->post('vehicle_group'); 
		  $alert_settings['TO_mail_type']= $this->input->post('to_mail_type');
		  $alert_settings['TO_mail']= implode(",",$this->input->post('to_addr'));
		  $alert_settings['CC_mail_type']= $this->input->post('cc_mail_type');
 		  $alert_settings['CC_mail']= implode(",",$this->input->post('cc_addr'));
		  $alert_settings['speed_alert']= $this->input->post('speed_alert'); 
		  $alert_settings['speed_template']= $this->input->post('Speed_Template')==""?0:$this->input->post('Speed_Template');
 		  $alert_settings['speed_to_type']= $this->input->post('speed_to_type');
		  $alert_settings['speed_to']= implode(",",$this->input->post('to_addr_speed'));
		  $alert_settings['speed_cc_type']= $this->input->post('speed_cc_type');
 		  $alert_settings['speed_cc']= implode(",",$this->input->post('cc_addr_speed'));
   		  $alert_settings['created']= date("Y-m-d H:i:s");
  		  $result=$this->Default_master_model->db_insert("alert_settings",$alert_settings);
 		  if($result==""){
 			   $return['error_flag']="1";
			   $return['message']="Some Error Occur.Please Contact Admin";
			   
 		  }else{
			  $return['error_flag']="0";
			   $return['id']=$result;
			  $return['message']="Geoffence Alert Settings Inserted Successfully";
		  }
		  print json_encode($return); 
 		  
	  }
	  
	  
	  public function Alert_setting_update(){
		  
		  $where_clause['id']=$this->input->post('id');
		  
		   $alertupdate_settings['Name']=$this->input->post('alert_name'); 
  		  $alertupdate_settings['geoffence_group_id']=$this->input->post('geoofence_group'); 
		  $alertupdate_settings['geoffence ']=implode(",",$this->input->post('geoffence'));
		  $alertupdate_settings['speed']=$this->input->post('speed')==""?0:$this->input->post('speed');
		  $alertupdate_settings['triger']= $this->input->post('trigger');
		  $alertupdate_settings['Template']= $this->input->post('template_name')!=""?$this->input->post('template_name'):NULL;
		  $alertupdate_settings['vehicle_group']= $this->input->post('vehicle_group'); 
		  $alertupdate_settings['TO_mail_type']= $this->input->post('to_mail_type')!=""?$this->input->post('to_mail_type'):NULL;
		  $alertupdate_settings['TO_mail']= implode(",",$this->input->post('to_addr'));
		  $alertupdate_settings['CC_mail_type']= $this->input->post('cc_mail_type')!=""?$this->input->post('cc_mail_type'):NULL;
 		  $alertupdate_settings['CC_mail']= implode(",",$this->input->post('cc_addr'));
		  $alertupdate_settings['speed_alert']= $this->input->post('speed_alert'); 
		  $alertupdate_settings['speed_template']= $this->input->post('Speed_Template')==""?0:$this->input->post('Speed_Template');
  		  $alertupdate_settings['speed_to_type']= $this->input->post('speed_to_type')!=""?$this->input->post('speed_to_type'):NULL;
		  $alertupdate_settings['speed_to']= implode(",",$this->input->post('to_addr_speed'));
		  $alertupdate_settings['speed_cc_type']= $this->input->post('speed_cc_type')!=""?$this->input->post('speed_cc_type'):NULL;
 		  $alertupdate_settings['speed_cc']= implode(",",$this->input->post('cc_addr_speed'));
  		  $alertupdate_settings['modified']= date("Y-m-d H:i:s");
 		  $total_updation=$this->Default_master_model->db_update("alert_settings",$alertupdate_settings,$where_clause);
		  if($total_updation>0){
				   $return['error_flag']="0";
				   $return['message']="Delay Settings Updated successfully";
				 }else{
					$return['error_flag']="1";
					$return['message']="Some Error Occur.Please Contact Admin";
				 }
		  print json_encode($return);
 	  }
	  
	  public function alert_settings_selecting(){
		  
		  
		   $where_clause['id']=$this->input->post('id');
		   $alert_settings=$this->Default_master_model->db_datacheck("Name,geoffence_group_id,geoffence,speed,triger,Template,vehicle_group,TO_mail_type,TO_mail,CC_mail_type,CC_mail,speed_alert,speed_template,speed_to_type,speed_to,speed_cc_type,speed_cc","alert_settings",$where_clause,"1");
		   
 		    if(count($alert_settings)>0){
				
			   $wheregeoffence_clause['geo_group']=$alert_settings['geoffence_group_id'];
		       $group_data=$this->Default_master_model->db_datacheck("id,name","geoffence",$wheregeoffence_clause);
			   $alert_settings_data['alert_settings_name']=$alert_settings['Name'];
			   $alert_settings_data['all_geoffence']=$group_data;	
  			   $alert_settings_data['Geoffence_group']=$alert_settings['geoffence_group_id'];
 			   $alert_settings_data['Geoffence_name']=explode(",",$alert_settings['geoffence']);
			   $alert_settings_data['speed']=$alert_settings['speed'];
			   $alert_settings_data['trigger']=$alert_settings['triger'];
			   $alert_settings_data['Template']=$alert_settings['Template'];
			   $alert_settings_data['vehicle_group']=$alert_settings['vehicle_group'];
			   $alert_settings_data['to_mail_type']=$alert_settings['TO_mail_type'];
			   $where_toclause['type']=$alert_settings['TO_mail_type'];
			   $mailto_data=$this->Default_master_model->db_datacheck("id,email","Mail_Address",$where_toclause);
 			   $alert_settings_data['allTo_address']=$mailto_data;
			   $alert_settings_data['To_address']=explode(",",$alert_settings['TO_mail']);
			   $alert_settings_data['cc_mail_type']=$alert_settings['CC_mail_type'];
			   $where_ccclause['type']=$alert_settings['CC_mail_type'];
			   $mailcc_data=$this->Default_master_model->db_datacheck("id,email","Mail_Address",$where_ccclause);
			   $alert_settings_data['allCC_address']=$mailcc_data;
 			   $alert_settings_data['CC_address']=explode(",",$alert_settings['CC_mail']);
			   $alert_settings_data['speed_alert_choice']=$alert_settings['speed_alert'];
			   $alert_settings_data['Speed_Template']=$alert_settings['speed_template'];
			   $alert_settings_data['to_mail_type_speed']=$alert_settings['speed_to_type'];
			   $where_tospeedclause['type']=$alert_settings['speed_to_type'];
			   $mailspeedto_data=$this->Default_master_model->db_datacheck("id,email","Mail_Address",$where_tospeedclause);
			   $alert_settings_data['allspeedTo_address']=$mailspeedto_data;
 			   $alert_settings_data['To_address_speed']=explode(",",$alert_settings['speed_to']);
			   $alert_settings_data['cc_mail_type_speed']=$alert_settings['speed_cc_type'];
			   $where_ccspeedclause['type']=$alert_settings['speed_cc_type'];
			   $mailspeedcc_data=$this->Default_master_model->db_datacheck("id,email","Mail_Address",$where_ccspeedclause);
			   $alert_settings_data['allspeedCC_address']=$mailspeedcc_data;
 			   $alert_settings_data['CC_address_speed']=explode(",",$alert_settings['speed_cc']);
 			   
			   $return['error_flag']="0";
			   $return['information']=$alert_settings_data;
			}else{
				$return['error_flag']="1";
			    $return['error_message']="Some Error Occur.Please Contact Admin";
			}
  		   
		   print json_encode($return);
 	  }
	  
	  public function Alert_setting_delete(){
		  $where_clause['id']=$this->input->post('id');
		  $alert_settings_delete=$this->Default_master_model->db_delete("alert_settings",$where_clause);
		  if($alert_settings_delete>0){
  			   $return['error_flag']="0";
			   $return['message']="Geoffence Alert Settings Deleted Successfully";
  		  }else{
 			  $return['error_flag']="1";
			  $return['message']="Some Error Occur.Please Contact Admin";
 		  }
		   print json_encode($return);
		  
	  }
	  
	  public function email_insert(){
		  
		  $company=$this->input->post("company_name");
		  $type=$this->input->post("type");
		  $emailaddr=$this->input->post("contact_email");
		  
		  if(count($emailaddr)>0){
			$errorflag="0";
 		    foreach($emailaddr as $key=>$data){
			    $email_data['Company_name']= $company;
		        $email_data['type']= $type;
 		        $email_data['email']=  $data;
 		        $email_data['created']= date("Y-m-d H:i:s");
  		        $result=$this->Default_master_model->db_insert("Mail_Address",$email_data);
				if($result==""){
					$errorflag="1";
				} 
  		    }
			
			if($errorflag=="0"){
				$return['error_flag']="0";
 			     $return['message']="Email Inserted Successfully";
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
	  
	  public function email_Update(){
		  
		  $where_clause['id']=$this->input->post("id");
		  $email_update['Company_name']=$this->input->post("company_name");
		  $email_update['type']=$this->input->post("type");
		  $email_update['email']=$this->input->post("contact_email");
		  $email_update['modified']=date("Y-m-d H:i:s");
		  
 		  $total_updation=$this->Default_master_model->db_update("Mail_Address",$email_update,$where_clause);
		  
		  if($total_updation>0){
				   $return['error_flag']="0";
				   $return['message']="Email Address Updated successfully";
		  }else{
					$return['error_flag']="1";
					$return['message']="Some Error Occur.Please Contact Admin";
		  }
  		  print json_encode($return);  
		  
	  }
	  
	  
	  
 
	  public function email_selecting(){
		   
		 $return=array();
 		 $where_clause['id']=$this->input->post('id');
  		 $email_data=$this->Default_master_model->db_datacheck("id,Company_name,type,email","Mail_Address",$where_clause,"1");
		 
		 
 		 if(count($email_data)>0){ 
 		    $email_resultdata['id']= $email_data['id'];
 		    $email_resultdata['com_name']= $email_data['Company_name'];
			$email_resultdata['Mail_type']= $email_data['type'];
  		    $email_resultdata['emailaddr_1']= $email_data['email'];
			$return['information']=$email_resultdata;
			$return['error_flag']="0";
 			
		 }else{
			$return['error_flag']="1";
		    $return['message']="Some Error Occur.Please Contact Admin";
		 }
 
 		  print json_encode($return);
		  
 	   }
	   
	   public function Email_delete(){
		  $where_clause['id']=$this->input->post('id');
  		  $email_delete=$this->Default_master_model->db_delete("Mail_Address",$where_clause);
 		  if($email_delete>0){
  			   $return['error_flag']="0";
			   $return['message']="Email  Deleted Successfully";
  		  }else{
 			  $return['error_flag']="1";
			  $return['message']="Some Error Occur.This Email Already linked to Geoffence alert settings";
 		  }
		  
		   print json_encode($return);
	   }
 
	   
	   public function mail_check(){
		   if($this->input->post("id")!=NULL){
		     $where_clause['id!=']=$this->input->post("id");
		   }
 		   $where_clause['email']=$this->input->post("email");
 		   $datadevice=$this->Default_master_model->db_datacheck("id","Mail_Address",$where_clause);
		   print json_encode(count($datadevice));
 	  }

 	// Station Code Check Starts

 	public function stationcode_check($code="",$id="")
 	{
  		$stationcode = $code =="" ? $this->input->post("station_code") : $code;
  		$where_clause['station_code'] = $stationcode;
		if($id!="")
		{
		    $where_clause['id!='] = $id;
		}
 		
 		$station_data = $this->Default_master_model->db_datacheck("id","Stations",$where_clause);
		   
	   	if($station_data)
	   	{
			return true;
	   	}
	   	else
	   	{
			return false;
	    }
  	  }

 	  // Station Code Check Ends


 	  // Station Name Check Starts

 	public function stationname_check($name="",$id="")
 	{
  		$stationname = $name =="" ? $this->input->post("station_name") : $name;
  		$where_clause['station_name'] = $stationname;
		if($id!="")
		{
		    $where_clause['id!='] = $id;
		}
 		
 		$station_data = $this->Default_master_model->db_datacheck("id","Stations",$where_clause);
		   
	   	if($station_data)
	   	{
			return true;
	   	}
	   	else
	   	{
			return false;
	    }
  	}

 	  // Station Name Check Ends

 	  // Station Insert Starts

 	  	public function station_insert()
 	  	{
 	  		$return = [];
 	  		$error  = 0; 
 	  		if($this->input->post("station_code") != "" && $this->input->post("station_name") != "")
 	  		{
 	  			if($this->input->post("station_code") != "")
			  	{
					$station_code_check = $this->stationcode_check(trim($this->input->post('station_code')));

				    if($station_code_check == "1")
				    {
 	  					$error  = 1; 
				   		$return['error_flag'] = "1";
				     	$return['message']    = "Station Code Already Exist";
						print json_encode($return);
			      	}
			    }
		    
			    if($this->input->post("station_name") != "")
		      	{
					$station_name_check = $this->stationname_check(trim($this->input->post('station_name')));

					if($station_name_check == "1")
				    {
				    	$error  = 1;
				   		$return['error_flag'] = "1";
				     	$return['message']    = "Station Name Already Exist";
						print json_encode($return);
			      	}
		      	}

		      	if($error == "0")
		      	{
		      		$stationcode = $this->input->post("station_code");
					$stationname = $this->input->post("station_name");
					$errorflag   = "0";

					$station_data['station_code'] = $stationcode;
					$station_data['station_name'] = $stationname;
					$station_data['status'] 	  = "1";
					$station_data['created']      = date("Y-m-d H:i:s");

					$result = $this->Default_master_model->db_insert("Stations",$station_data);

					if($result == "")
					{
						$errorflag = "1";
					} 

					if($errorflag=="0")
					{
						$return['error_flag'] = "0";
						$return['message']    = "Station Inserted Successfully";
					}
					else
					{
						$return['error_flag'] = "1";
						$return['message']    = "Some Error Occur.Please Contact Admin";
					}

					print json_encode($return);
		      	}
 	  		}
		}

 	  // Station Insert Ends
	  
 	  // Station Selecting Starts

 	  public function station_selecting(){
		 
		 $return             = array();
 		 $where_clause['id'] = $this->input->post('id');
  		 $station_data       = $this->Default_master_model->db_datacheck("*","Stations",$where_clause,"1");

 		 if(count($station_data)>0)
 		 { 
 		    $station_resultdata['station_data_id'] = $station_data['id'];
 		    $station_resultdata['station_code']    = $station_data['station_code'];
			$station_resultdata['station_name']    = $station_data['station_name'];
			$return['information']                 = $station_resultdata;
			$return['error_flag']                  = "0";
		 }
		 else
		 {
			$return['error_flag']="1";
		    $return['message']="Some Error Occur.Please Contact Admin";
		 }
 
 		  print json_encode($return);
		  
 	   }

 	  // Station Selecting Ends

 	  // Station Update Starts

 	   public function station_update()
 	   {
 	   		$return = [];
 	  		$error  = 0; 

			if($this->input->post('id')!="")
 	   	 	{
 	   	 		if($this->input->post("station_code") != "")
			  	{
					$station_code_check = $this->stationcode_check($this->input->post('station_code'),$this->input->post('id'));

					if($station_code_check == "1")
				    {
				    	$error  = 1; 
				   		$return['error_flag'] = "1";
				     	$return['message']    = "Station Code Already Exist";
						print json_encode($return);
			      	}
			    }
		      	
		      	if($this->input->post("station_name") != "")
		      	{
					$station_name_check = $this->stationname_check(trim($this->input->post('station_name')),$this->input->post('id'));

					if($station_name_check == "1")
				    {
				    	$error  = 1; 
				   		$return['error_flag'] = "1";
				     	$return['message']    = "Station Name Already Exist";
						print json_encode($return);
			      	}
		      	}

			    if($error == "0")
		      	{
					$where_clause['id']             = $this->input->post("id");
					$station_update['station_code'] = $this->input->post("station_code");
					$station_update['station_name'] = $this->input->post("station_name");
					$station_update['modified']     = date("Y-m-d H:i:s");

					$total_updation = $this->Default_master_model->db_update("Stations",$station_update,$where_clause);

					if($total_updation>0)
					{
					   $return['error_flag'] = "0";
					   $return['message']    = "Station Updated successfully";
					}
					else
					{
						$return['error_flag'] = "1";
						$return['message']    = "Some Error Occur.Please Contact Admin";
					}
					print json_encode($return); 
			  	} 
	    	}
	    	else
	    	{
	    		$return['error_flag'] = "1";
				$return['message']    = "Some Error Occur.Please Contact Admin";
	    	}	
		}
 	  // Station Update Ends

	  // Station Delete Starts

	  public function Station_delete(){

		  $where_clause['id'] = $this->input->post('id');
		  $station_update['status'] = "0";
  		  $stations_delete    = $this->Default_master_model->db_update("Stations",$station_update,$where_clause);
 		  if($stations_delete>0){
  			   $return['error_flag']="0";
			   $return['message']="Station  Deleted Successfully";
  		  }else{
 			  $return['error_flag']="1";
			  $return['message']="Some Error Occur.This Email Already linked to Geoffence alert settings";
 		  }
		  
		   print json_encode($return);
	   }

	  // Station Delete Ends

	  // Station Enable Starts

	   public function Station_enable(){

		  $where_clause['id'] = $this->input->post('id');
		  $station_update['status'] = "1";
  		  $stations_delete    = $this->Default_master_model->db_update("Stations",$station_update,$where_clause);
 		  if($stations_delete>0){
  			   $return['error_flag']="0";
			   $return['message']="Station  Enabled Successfully";
  		  }else{
 			  $return['error_flag']="1";
			  $return['message']="Some Error Occur.This Email Already linked to Geoffence alert settings";
 		  }
		  
		   print json_encode($return);
	   }

	  // Station Enable Ends

	   
  }
?>