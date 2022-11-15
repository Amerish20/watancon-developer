<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dom_test extends CI_Controller {
 	public function __construct()
    {
		parent::__construct();
  		$this->load->model('cron_model');
 		$this->load->helper('url');
		 
	}
	public function index(){
		 
		 $mail_settings=$this->cron_model->db_datacheck('Host,User_name,Password,from_addr,Mail_name','Mail_settings',$whereemail_settings,1);
 		 $this->load->library('email');
		 $config = array();
		 $config['protocol'] = 'smtp';
		 $config['smtp_host'] = 'mail.watancon.com';
		 $config['smtp_user'] = 'gps@watancon.com';
		 $config['smtp_pass'] = 'Gps@123';
		 $config['smtp_port'] = '25';
		 $config['mailtype']  = 'html';
		 $config['charset']  = 'iso-8859-1';
		 $this->email->initialize($config);
		 $mail_subject="test";
		 $mail_content="Testing the template";
 		 $this->email->from($mail_settings['from_addr'], $mail_settings['Mail_name']);
		 $this->email->to("dinto@watancon.com");
		 $this->email->subject($mail_subject);
		 $this->email->message($mail_content);
		 if($this->email->send()){
			 print "success";
	     }else{
			 print "error";
		 }
		 
	}
	
}
?>