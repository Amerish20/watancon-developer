<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Devtools extends CI_Controller 
{
	public function __construct()
    {
    	parent::__construct();
  		$this->load->model('Devtools_model');
		$this->load->helper('url');		
    }

	public function index()
	{
		$file = [];
		$counter = 0;
		$path    = '/run/media/root/external/gps_backup';
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
		$this->load->view('devtools/header');
		$this->load->view('devtools/index',$data);
	}

	public function datadecoder()
	{
		$this->load->view('devtools/header');
		$this->load->view('devtools/datadecoder');
	}

	public function process_row_data()
	{
		// $rowdata = "0000000000000054080100000176b7edfce0011eb7383e0f2800fd00090085100000f01007ef01f00150001504c8004501010106b50005b60003426e88180000430f9744000002c70004a0e8101435f060014e0000000000000000010000eb33";

		$rowdata 				  = trim($this->input->post('rowdata')); 		
 		$ioproperty				  = [
									   "16"  => "Odometer", 
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

		// echo "<pre>"; print_r($result); die;
		print json_encode($result);
	}
	  
	public function fleetdata()
	{
		$where['status'] 		 = "1"; 
		$data['departmentdata']  = $this->Devtools_model->gps_datacheck("id,name","department",$where,"1");
		$this->load->view('devtools/header');
		$this->load->view('devtools/fleetdata',$data);
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
 	

}
?>