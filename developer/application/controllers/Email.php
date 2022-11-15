<?php
class Email extends CI_Controller {
	 public function __construct()
     {
        parent::__construct();
		 $this->load->library('email');
	 }
	 
	 public function index(){
		 
		 
		 
		 
	/*	  $config = Array(    

      'protocol' => 'sendmail',

      'smtp_host' => 'mail.watancon.com',

      'smtp_port' => 25,

      'smtp_user' => 'gps@watancon.com',

      'smtp_pass' => 'Gps@123',

      'smtp_timeout' => '4',

      'mailtype' => 'html',

      'charset' => 'iso-8859-1'

    );

    $this->load->library('email', $config);
	*/	 
		                   //$config = array();
                           $config['protocol'] = 'smtp';
                           $config['smtp_host'] = 'mail.watancon.com';
                           $config['smtp_user'] = 'gps@watancon.com';
                           $config['smtp_pass'] = 'Gps@123';
                           $config['smtp_port'] = '25';
						   $config['mailtype']  = 'html';
						   $config['charset']  = 'iso-8859-1';
						   
                           $this->email->initialize($config);
						   $this->email->set_newline("\r\n");
		                   $this->email->from('gps@watancon.com', 'Gps');
                           $this->email->to('dintos07@gmail.com');
                           //$this->email->cc('it@watancon.com');
						    $this->email->cc('rikas@watancon.com');
						  // print "contact email".$geoffence_cont_data['contact_email']."<br/>";
						   
						 //  $name=$geoffence_cont_data['name']!=""?"Dear Mr.".$geoffence_cont_data['name']:"Hi,";
						   
                           $this->email->subject('Al Wataniya Truck Enter into rikas system');
                           $this->email->message('<!DOCTYPE html>

<html>
 <head>
   <meta charset="utf-8" />
 </head>

<body>
 <span style="font-weight: bold; font-size: x-large;">dinto <span style="color: rgb(204, 0, 0);">sinto&nbsp;</span></span><div style="text-align: center;"><span style="font-weight: bold; font-size: x-large;"><span style="color: rgb(204, 0, 0);">hello</span></span></div>

</body>

</html>');
                           if($this->email->send()){
							   echo $this->email->print_debugger();
			                  print "success";
		                   }else{
							    echo $this->email->print_debugger();
							   
			                  print "error in smtp <br>";
							  $headers = "From: webmaster@example.com";
							  if(mail("dinto@watancon.com","My subject","sample test",$headers)){
								  print "normal work succesfully";
							  }else{
								   print "Error In normal<br/>";
							  }
		                   }
		 
	 }
}

?>