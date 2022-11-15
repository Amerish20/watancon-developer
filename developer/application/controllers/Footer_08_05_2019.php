<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer extends CI_Controller {

	public function __construct()
      {
        parent::__construct();
   		
		$this->load->helper('url');
	    
      }
      public function index(){
          $this->auto_logout();
 		  $this->load->view('login');
		 // $this->session->sess_expiration = '1800'; //30 Minutes
    	  //$this->session->sess_expire_on_close = 'true';	
	  }
	  
	  public function auto_logout(){
 	     $this->session->sess_destroy();
	  }
	
	function login_check(){
		  
		  $return['status']="1"; 
	      if(!$this->session->userdata('id')) {
			 $return['status']="0"; 
 		  }
		   print json_encode( $return);
	  }
	  
	  function idle_logout(){
		  $time = $_SERVER['REQUEST_TIME'];
		  if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY'] > 7200)) {
			// last request was more than 2 hours ago
			session_unset();
    		session_destroy();
    		session_start();
			header('Location:http://watancongps.dyndns.org/');
		  }
		  $_SESSION['LAST_ACTIVITY'] = $time; // update last activity time stamp
		}
}
