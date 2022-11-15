<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticketing_system extends CI_Controller
{
    public function __construct()
    {
    	header("Access-Control-Allow-Origin: *");
    	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    }

    public function index(){
    	  $this->load->view("Ticketing");
 
    	  
    }

    public function test(){
    	print "get the result";
    }
}