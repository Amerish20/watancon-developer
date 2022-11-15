<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends CI_Controller {
 	  public function __construct()
      {
        parent::__construct();
  		$this->load->model('Gps_model');
		$this->load->helper('url');
	    $this->load->library('form_validation');
      }
	   public function loginvalidate(){
 		   
 		  $_POST = json_decode(file_get_contents("php://input"), true);
     	  $return=array();
  	      $this->form_validation->set_rules('username', 'User Name', 'required');
		  $this->form_validation->set_rules('Password', 'Password', 'required');
		  $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	      if ($this->form_validation->run() == TRUE) {
			    $this->load->library('encrypt');
			    $where_clause['user_name']=$this->security->xss_clean($this->input->post('username'));
 			    $login_data=$this->Gps_model->gps_datacheck("id,name,password","user",$where_clause);
			    if(count($login_data)>0){
 				   if($this->encrypt->decode($login_data['password'])==$this->input->post('Password')){
					   $return['error_flag']="0";
					   $return["id"]= $login_data['id'];
				       $return["name"]= $login_data['name'];
 				   }else{
					  $return['error_flag']="1";
		              $return['message']="Invalid Password";
				   }
				   
			    }else{
				   $return['error_flag']="1";
		           $return['message']="Invalid User Name";
			    }
			   
		  }else{
		     $return['error_flag']="1";
		     $return['message']=  validation_errors();;
          }
	      print json_encode($return);
 	  }
}
