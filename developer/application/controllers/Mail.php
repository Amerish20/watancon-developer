<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {
	
	public function __construct()
      {
        parent::__construct();
 		$this->load->library('email');
 		login_check();
      }
	  public function sentmail(){
		  $config = array();
          $config['protocol'] = 'smtp';
          $config['smtp_host'] = 'mail.watancongps.com';
          $config['smtp_user'] = 'gps@watancongps.com';
          $config['smtp_pass'] = 'gps@123';
          $config['smtp_port'] = '587';
          $this->email->initialize($config);
          $this->email->set_newline("\r\n");
		  $this->email->from('sarath@watancon.com', 'Your Name');
          $this->email->to('dinto@watancon.com');
          $this->email->cc('dintos07@gmail.com');
          $this->email->bcc('it@watancon.com');
          $this->email->subject('Email gps Test');
          $this->email->message('Testing the email gps class.');
          if($this->email->send()){
			  print "success";
		  }else{
			  print "error";
		  }
		  echo $this->email->print_debugger();
	  }
	  
}
?>