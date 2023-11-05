<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Devtools extends CI_Controller 
{
	public function __construct()
    {
    	parent::__construct();
  		$this->load->model('Devtools_model');
		$this->load->helper('url');
		$this->load->library("session");		
    }

	public function index()
	{
		if($this->session->userdata('username')){
			$file = [];
			$counter = 0;
			$path    = '/mnt/GPSDBLIVE/gps_backup';
			if ($handle = opendir($path))
			{
				while (false !== ($entry = readdir($handle))) 
			    {
			        if ($entry != "." && $entry != "..") 
			        {

			        	$file[$counter]['name'] = $entry; 
			        	$realfile = $path . "/" . $entry;
			        	$filesize  =  filesize($realfile);
			        	$file[$counter]['size'] = number_format($filesize / 1073741824, 2) . ' GB';
			        	$file[$counter]['date'] = date("F d Y H:i:s.", filectime($realfile));
			        }
			        $counter ++;
			    }

			    closedir($handle);
			}
			$data['file'] = $file;
			// $data['olddbdate'] = $this->Devtools_model->oldDbLastInsertDate();
			$this->load->view('devtools/header');
			$this->load->view('devtools/index',$data);
		} else{
			header('location:'.base_url().'devtools/login');
		}
	}

	public function login(){

		$this->load->view('devtools/login');
	}

	public function loginChk(){

		$this->load->library('session');
		$this->load->library('encrypt');

		$username = trim($_POST['name']);
		$password = trim($_POST['password']);
		$data = array();
		if($username == 'superadmin') {
          $data = $this->Devtools_model->userChk($username);
        }
 		// echo "<pre>";
 		// print_r($data);exit;

 		if(!empty($data)){
 			$password_decode = @$this->encrypt->decode($data[0]['Password']);
 			if($password_decode == $password){
   				$this->session->set_userdata('username', $data[0]['user_name']);
   				redirect('devtools/index');
 			} else{
 		       header('location:'.base_url().'devtools/login');
		       $this->session->set_flashdata('error','Invalid login. User not found');
 			}
 		} else {
 			header('location:'.base_url().'devtools/login');
		    $this->session->set_flashdata('error','Invalid login. User not found');
 		}
	}

	public function datadecoder()
	{
		if($this->session->userdata('username')){
			$this->load->view('devtools/header');
			$this->load->view('devtools/datadecoder');
		} else {
			header('location:'.base_url().'devtools/login');
		}
	}

	public function process_row_data()
	{
		// $rowdata = "00000000000000580801000001827f63a8f0011ebb4bee0f734815001e013d100000f61209ef00f00050001505c800450101000200f60106b50005b600034231ec180000430f7f44000002c7000000001014c09bf0014e000000000000000001000055ef";

		$rowdata 				  = trim($this->input->post('rowdata')); 		
 		$ioproperty				  = [
									   "16"  => "Odometer", 
									   "2"   => "Digital Input 2", 
									   "66"  => "External Voltage",
									   "67"  => "Battery Voltage", 
									   "78"  => "iButton",
									   "80"  => "Data Mode",
									   "239" => "Ignition",
									   "240" => "Movement",
									   "247" => "Crash detection",
									   "251" => "Idling",
									   "252" => "Unplug",
									   "253" => "Green driving type"
									 ];  
									 
		$result        			  = [];
		$result['FourZeors']      = substr($rowdata, 0,8);
		$result['DataLength']     = hexdec(substr($rowdata,8,8));
		$result['CodecId']        = substr($rowdata,16,2);
		$result['NumberofData']   = substr($rowdata,18,2);
		$timeStamp                = ((hexdec(substr($rowdata,20,16)))/1000) + (180*60);
		$result['DateTimeStamp']  = date('d-M-Y H:i:s', $timeStamp);
		$result['Priority']       = substr($rowdata,36,2);
		$longitude                = hexdec(substr($rowdata,38,8));
		$result['Longitude']      = substr_replace($longitude, ".", 2, 0);
		$latitude      			  = hexdec(substr($rowdata,46,8));
		$result['Latitude']       = substr_replace($latitude, ".", 2, 0);
		$result['Altitude']       = hexdec(substr($rowdata,54,4));
		$result['Angle']          = hexdec(substr($rowdata,58,4));
		$result['Sattelites']     = hexdec(substr($rowdata,62,2));
		$result['Speed']          = hexdec(substr($rowdata,64,4));
		$result['Eventid']        = hexdec(substr($rowdata,68,2));
		$result['IO Total Count'] = hexdec(substr($rowdata,70,2));
		$result['One Byte Count'] = hexdec(substr($rowdata,72,2));

		$onebytecountlength       = ($result['One Byte Count'] * 4);
		 
		 
		for($i=1;$i <= $onebytecountlength; $i++)
		{
		   $key                       = hexdec(substr($rowdata,73+$i,2));
		   if (array_key_exists($key,$ioproperty))
		   {
		      $result[$ioproperty[$key]] = hexdec(substr($rowdata,73+$i+2,2));
		   }
		   $i = $i+3;
		}

		 
		$twobytecountstart        = $onebytecountlength + 74;
		$result['Two Byte Count'] = hexdec(substr($rowdata,$twobytecountstart,2));
		$twobytecountlength       = ($result['Two Byte Count'] * 6);

		for($i=1;$i <= $twobytecountlength; $i++)
		{
		   $key                       = hexdec(substr($rowdata,$twobytecountstart+$i+1,2));
		   if (array_key_exists($key,$ioproperty))
		   {
		      $result[$ioproperty[$key]] = hexdec(substr($rowdata,$twobytecountstart+$i+3,4));
		   }
		   $i = $i+5;
		}

		 
		$fourbytecountstart        = $twobytecountstart + $twobytecountlength + 2;
		$result['Four Byte Count'] = hexdec(substr($rowdata,$fourbytecountstart,2));
		$fourbytecountlength        = ($result['Four Byte Count'] * 10);

		for($i=1;$i <= $fourbytecountlength; $i++)
		{
		   $key                       = hexdec(substr($rowdata,$fourbytecountstart+$i+1,2));
		   if (array_key_exists($key,$ioproperty))
		   {
		      $result[$ioproperty[$key]] = hexdec(substr($rowdata,$fourbytecountstart+$i+3,8));
		   }
		   $i = $i+9;
		}


		 
		$eightbytecountstart        = $fourbytecountstart + $fourbytecountlength + 2;
		$result['Eight Byte Count'] = hexdec(substr($rowdata,$eightbytecountstart,2));
		$eightbytecountlength       = ($result['Eight Byte Count'] * 18);


		for($i=1;$i <= $eightbytecountlength; $i++)
		{
		   $key                       = hexdec(substr($rowdata,$eightbytecountstart+$i+1,2));
		   if (array_key_exists($key,$ioproperty))
		   {
		      $result[$ioproperty[$key]] = hexdec(substr($rowdata,$eightbytecountstart+$i+3,16));
		   }
		   $i = $i+17;
		}

		$result['Odometer'] = $result['Odometer']/1000;


		print json_encode($result);
	}
	  
	public function fleetdata()
	{   
		if($this->session->userdata('username')){
			$where['status'] 		 = "1"; 
			$data['departmentdata']  = $this->Devtools_model->gps_datacheck("id,name","department",$where,"1");
			$this->load->view('devtools/header');
			$this->load->view('devtools/fleetdata',$data);
		} else {
			header('location:'.base_url().'devtools/login');
		}
	}

	public function getfleetdata()
	{
		$where['status']  		 = "1";
		$where['department_id']  = trim($this->input->post('fleettype'));
		$fleetdata               = $this->Devtools_model->gps_datacheck("id,description","vehicle_data",$where,"1");
		print json_encode($fleetdata);
		die;
	}

	public function getfleetlastdata()
	{

		$where['vehicle_id']     = trim($this->input->post('fleetid'));
		$fleetlastdata           = $this->Devtools_model->gps_datacheck("device_timestamp as Device Timestamp,lattitude as Lattitude,lognitude as Lognitude,speed  as Speed,external_power as External Power,battery_power as Battery Power,odometer as Odometer,satelite as Satelite,movement as Movement,ign_status as Ignition Status,acceleration as Acceleration,hash_breaking as Hash Breaking,unpluged as Unpluged,created as Created Date,Modified as Modified Date","vehicle_gps_information_temp",$where,"");
		
		if($fleetlastdata)
		{

			foreach ($fleetlastdata as $key => $value) 
			{
				$fleetlastdata[$key]	= ($fleetlastdata[$key] != "" || $fleetlastdata[$key] != "") 
										  ? $fleetlastdata[$key] : "Not Available";	
			}

			$timeStamp                          = ($fleetlastdata['Device Timestamp']/1000);
			$fleetlastdata['Device Timestamp']  = date('d-M-Y H:i:s', $timeStamp);			
			print json_encode($fleetlastdata);
			die;
		}
		else
		{
			$error = ["errorflag" => "1"];
			print json_encode($error);
			die;
		}

		
	}

	public function vehiclestatus()
	{
		$this->load->view('devtools/header');
		$this->load->view('devtools/vehiclechart');
	}

	public function vehiclestatuschart()
 	{
 	  	$stopcount    = 0;
 	  	$idlecount    = 0;
 	  	$runningcount = 0;

 	  	$whereworkshop['status'] 		  = "1"; 
 	  	$whereworkshop['workshop_status'] = "1";
 	  	$workshopcountarray               = $this->Devtools_model->gps_datacheck("id","vehicle_data",$whereworkshop,"1");	
 	  	$workshopcount                    = count($workshopcountarray);
 		
 		$wherelongstop['status'] 		  = "1"; 
 	  	$wherelongstop['longstop_status'] = "1";
 	  	$longstopcountarray               = $this->Devtools_model->gps_datacheck("id","vehicle_data",$wherelongstop,"1");	
 	  	$longstopcount                    = count($longstopcountarray);

 		$where['status'] 		  		  = "1";  	  	
 	  	$where['workshop_status!=']       = "1";
 	  	$where['longstop_status!=']       = "1";
 	  	$activevehiclearray               = $this->Devtools_model->gps_datacheck("id","vehicle_data",$where,"1");	


 	  	foreach ($activevehiclearray as $activevehiclearray) 
 	  	{
 	  		$wherevehicle['vehicle_id']   = $activevehiclearray['id'];
 	  		$vehicleinfoarray             = $this->Devtools_model->gps_datacheck("speed,ign_status","vehicle_gps_information_temp",$wherevehicle);

 	  		if($vehicleinfoarray['ign_status'] == "0")
 	  		{
 	  			$stopcount += 1;
 	  		}
 	  		else if(($vehicleinfoarray['ign_status'] == "1") &&($vehicleinfoarray['speed'] == "0"))
 	  		{
 	  			$idlecount += 1;  			
 	  		}
 	  		else
 	  		{
 	  			$runningcount += 1;
 	  		}
 	  	}

 	  	$resultarray = [
						"stopcount"     => $stopcount, 	  		
						"idlecount"     => $idlecount, 	  		
						"runningcount"  => $runningcount, 	  		
						"workshopcount" => $workshopcount, 	  		
						"longstopcount" => $longstopcount 	  		
 	  				   ];

 	 	print json_encode($resultarray);
 	 	die(); 	  	

 	}

 	public function passwords()
 	{
        if($this->session->userdata('username')){
			
	 		$this->load->library('encrypt');
	 		$fulldata = $this->Devtools_model->user_group_join();
	 		$full = [];

	 		foreach($fulldata as $fulldata)
	 		{
	 			$fulldata['Password'] = @$this->encrypt->decode($fulldata['Password']); 			
	 			array_push($full,$fulldata);
	 		}

	 		$data['passwords']  = $full;

	 		// echo "<pre>"; print_r($full); die;

	         $this->load->view('devtools/header');
			 $this->load->view('devtools/passwordencoder',$data);
		} else {
			header('location:'.base_url().'devtools/login');
		}	  	 	  	
	}
 	

 	public function checkencodeing($password)
 	{

        // $password=str_replace("*****","/",$password);
	  	 
	  	$this->load->library('encrypt');
	  	print $hashed_passwrod = @$this->encrypt->decode($password);
	  	die();
	  }

	public function logout(){
		$this->session->unset_userdata('username');
		header('location:'.base_url().'devtools/login');
	}


	// public function dbcompare() {
	// 	if($this->session->userdata('username')){
	// 		if(!empty($_POST['from']) && !empty($_POST['to'])){
	// 				$from =  strtotime($_POST['from'])*1000;
	// 				$to =  strtotime($_POST['to'])*1000;
	// 				$data['fromdate'] = $_POST['from'];
	// 				$data['todate'] = $_POST['to'];
	// 				$data['newdb'] = $this->Devtools_model->dbcompare('new',$from,$to);
	// 				$data['olddb'] = $this->Devtools_model->dbcompare('old',$from,$to);
	// 				//print_r($data);exit;
	// 				$this->load->view('devtools/header');
	// 				$this->load->view('devtools/dbcompare',$data);
	// 		} else {
	// 				$this->load->view('devtools/header');
	// 				$this->load->view('devtools/dbcompare');
	// 		}
	// 	} else {
	// 		header('location:'.base_url().'devtools/login');
	// 	}	
		
	// }

	public function vehcount(){
		$data['vehcount'] = $this->Devtools_model->vehCount();
		$data['awc_jec_count'] = $this->Devtools_model->awcJecCount();
		$data['awc_jec_inactive_count'] = $this->Devtools_model->inactiveAwcJecCount();
		$data['vehcount_exclude'] = $this->Devtools_model->vehCountExcludedGN();
		$data['awc_jec_count_exclude'] = $this->Devtools_model->awcJecCountExcludedGN();
		$data['awc_jec_inactive_count_exclude'] = $this->Devtools_model->inactiveAwcJecCountExcludedGN();
		$this->load->view('devtools/header');
		$this->load->view('devtools/vehcount',$data);
	}

    public function simcount(){
    	$data['simcount'] = $this->Devtools_model->simCount();
    	$data['statuscount'] = $this->Devtools_model->statusCount();
    	$data['simvodafonecount'] = $this->Devtools_model->simVodafoneCount();
    	$data['simooredocount'] = $this->Devtools_model->simOoredoCount();
    	//print_r($data['simooredocount']);exit;
		$this->load->view('devtools/header');
		$this->load->view('devtools/simcount',$data);
	}

	public function fleetwisecount(){
    	$data['fleetwisecount'] = $this->Devtools_model->fleetwisecount();
    	$data['inactivefleetwisecount'] = $this->Devtools_model->inactivefleetwisecount();
		$this->load->view('devtools/header');
		$this->load->view('devtools/fleetwisecount',$data);
	}

	public function simserialnumber(){
    	$data['simserialnumber'] = $this->Devtools_model->simSerialNumberActive();
    	//print_r($data['simserialnumber']);exit;
		$this->load->view('devtools/header');
		$this->load->view('devtools/simserialnumber',$data);
	}

	public function simserialnumberinactive(){
    	$data['simserialnumber'] = $this->Devtools_model->simSerialNumberInActive();
    	//print_r($data['simserialnumber']);exit;
		$this->load->view('devtools/header');
		$this->load->view('devtools/simserialnumberinactive',$data);
	}

	public function gncount(){
    	$data['gncount'] = $this->Devtools_model->gnCount();
    	$where_station['status'] = "1";
    	$datastation['stations'] = $this->Devtools_model->db_datacheck("id,station_name", "Stations",$where_station);
    	$station_ids=array_map(function ($st) {return $st['id'];}, $datastation['stations']);
    	$datastationwise['stationwise'] = $this->Devtools_model->gnStationWise();
    	$i=0;
    	$finaldata = array();
    	foreach ($datastationwise['stationwise'] as $key => $value) {
    		$data['finaledata'][$i]['station_count'] = $value['station_count'];
    		$station_id = $value['station_id'];
    		$from_station_id_key=array_search($station_id,$station_ids);
    		if(isset($from_station_id_key)) {
    			$data['finaledata'][$i]['station_name'] = $datastation['stations'][$from_station_id_key]['station_name'];
    		}
    		$i++;
    	}
		$this->load->view('devtools/header');
		$this->load->view('devtools/gncount',$data);
	}

	public function gnsimserialnumber(){
    	$data['gnsimserialnumber'] = $this->Devtools_model->GNsimSerialNumberActive();
    	//print_r($data['simserialnumber']);exit;
		$this->load->view('devtools/header');
		$this->load->view('devtools/gnsimserialnumber',$data);
	}

	public function dis(){
    	$data['dis'] = $this->Devtools_model->db_datacheck("*", "device_ibutton_sim_count");
    	//print_r($data['dis']);exit;
    	$this->load->view('devtools/header');
		$this->load->view('devtools/dis',$data);
	}

	public function editdis(){
    	$data['dis'] = $this->Devtools_model->db_datacheck("*", "device_ibutton_sim_count");
    	//print_r($data['dis']);exit;
    	$this->load->view('devtools/header');
		$this->load->view('devtools/editdis',$data);
	}

	public function editpost(){
       // echo "abcd";
       // echo "<pre>";print_r($_POST);exit;

		$erp_device  =   $_POST['erp_device']; 
        $erp_ibutton  = $_POST['erp_ibutton'];
        $erp_sim  =  $_POST['erp_sim'];
        $issued_devices  =  $_POST['issued_devices'];
        $damaged_devices  = $_POST['damaged_devices']; 
        $spare_devices  =  $_POST['spare_devices'];
        $no_info_device  =  $_POST['no_info_device'];
        $device_notes  =  $_POST['device_notes']; 
        $issued_ibutton  = $_POST['issued_ibutton'];
        $damaged_ibutton  =  $_POST['damaged_ibutton'];
        $not_used_ibutton  =  $_POST['not_used_ibutton'];
        $ibutton_notes  =  $_POST['ibutton_notes'];
        $issued_sim  = $_POST['issued_sim']; 
        $damaged_sim  =  $_POST['damaged_sim'];
        $new_sim  =  $_POST['new_sim'];
        $active_sim_not_used  = $_POST['active_sim_not_used'];
        $sim_notes  = $_POST['sim_notes'];
        $generator_box  =  $_POST['generator_box'];
        $generator_relay  =  $_POST['generator_relay'];
        $generateo_relay_outer  = $_POST['generateo_relay_outer'];
        $gn_notes  = $_POST['gn_notes'];

       $data = array( 
        'ERP_devices'  =>  $erp_device, 
        'ERP_ibutton'=> $erp_ibutton, 
        'ERP_sim'   =>  $erp_sim,
        'issued_devices'  =>  $issued_devices, 
        'damaged_devices'=> $damaged_devices, 
        'not_used_devices'   =>  $spare_devices,
        'police_scrap_devices'  =>  $no_info_device,
        'device_notes'  =>  $device_notes,  
        'issued_ibutton'=> $issued_ibutton, 
        'damaged_ibutton'   =>  $damaged_ibutton,
        'not_used_ibutton'  =>  $not_used_ibutton,
        'ibutton_notes'  =>  $ibutton_notes, 
        'issued_sim'=> $issued_sim, 
        'damaged_sim'   =>  $damaged_sim,
        'new_sim'  =>  $new_sim, 
        'active_sim_not_used' => $active_sim_not_used,
        'sim_notes' => $sim_notes,
        'generator_box'   =>  $generator_box,
        'generator_relay'  =>  $generator_relay, 
        'generateo_relay_outer' => $generateo_relay_outer,
        'gn_notes' => $gn_notes
    );
	$this->db->where('id', 1);
	$this->db->update('device_ibutton_sim_count', $data);
    $this->session->set_flashdata('success', 'Updated successfully');
    redirect('devtools/dis');
	
	}

	public function gnupdate(){
		$where_station['status'] = "1";
		$data['stations'] = $this->Devtools_model->db_datacheck("id,station_name", "Stations",$where_station);
    	$station_ids=array_map(function ($st) {return $st['id'];}, $data['stations']);
    	$data['gndata'] = $this->Devtools_model->db_gndatafetch();
    	$i=0;
    	$finaldata = array();
    	foreach ($data['gndata'] as $key => $value) {
    		$data['finaledata'][$i]['id'] = $value['id'];
    		$data['finaledata'][$i]['name'] = $value['name'];
    		$data['finaledata'][$i]['description'] = $value['description'];
    		$data['finaledata'][$i]['generator_station_id'] = $value['generator_station_id'];
    		$station_id = $value['station_id'];
    		$from_station_id_key=array_search($station_id,$station_ids);
    		if(isset($from_station_id_key)) {
    			$data['finaledata'][$i]['station_name'] = $data['stations'][$from_station_id_key]['station_name'];
    		}
    		$data['finaledata'][$i]['station_id'] = $station_id;
    		$i++;
    	}
    	//print_r($data);exit;
    	$this->load->view('devtools/header');
		$this->load->view('devtools/gndata',$data);
		
	}
	public function changegnid(){
		$idforupdate = $this->input->post("idforupdate");
		$gnepaid = $this->input->post("gnepaid");
		$station_name = $this->input->post("station_name");
		$where['id']=$idforupdate;
		$updatedata['generator_station_id']=$gnepaid;
		$updatedata['station_id']=$station_name;
		$updatequery = $this->Devtools_model->db_update('vehicle_data',$updatedata,$where);
		echo true;	

	}

	public function exceedidle() {

		if($this->session->userdata('username')) {
			$where['status'] 		 = "1"; 
			$data['departmentdata']  = $this->Devtools_model->gps_datacheck("id,name","department",$where,"1");
			$this->load->view('devtools/header');
			$this->load->view('devtools/exceedidle',$data);
		} else {
			header('location:'.base_url().'devtools/login');
		}
    	
	}

	public function getExceedData() {
		//print_r($_POST);exit;
		$from_date=strtotime($this->input->post("from_date"))*1000;
		$to_date=strtotime($this->input->post("to_date"))*1000;
		$fleetid  = trim($this->input->post('fleetid'));

		$where['vehicle_id']     = $fleetid;
		$where['device_timestamp>']=$from_date;
		$where['device_timestamp<']=$to_date;
		$rowlimit="300";
		$fleetexceeddata = $this->Devtools_model->gps_datacheck("id,vehicle_id,device_timestamp,lattitude,lognitude,speed,ign_status,satelite","vehicle_gps_information",$where,"1","",$rowlimit);
		//print_r($fleetexceeddata);exit;

		if(!empty($fleetexceeddata)) {	
			print json_encode($fleetexceeddata);
			die;
		} else {
			$error = ["errorflag" => "1"];
			print json_encode($error);
			die;
		}
    	
	}

}
?>