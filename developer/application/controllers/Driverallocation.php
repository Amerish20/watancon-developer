<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Driverallocation extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
  		 $this->load->model('driver_allocation_model');
		 $this->load->helper('url');
		
      }

	  public function index()
	  {
           login_check();
		   $whereheader_clause['u.id']=$this->session->userdata('id');
	       $whereheader_clause['ua.type']="1";
	       $whereheader_clause['ua.status']="1";
 	       $data1['masters_data']=$this->driver_allocation_model->master_join("m.id,m.master,m.controller",$whereheader_clause,"1");
		   $data1['heading']="Driver Allocation";
		   $data1['page_head_icon']="fa fa-user";		   
		   $reportwhere_clause=array();
		   $reportwhere_clause['u.id']=$this->session->userdata('id');
		   $reportwhere_clause['ua.type']="3";
		   $reportwhere_clause['ua.status']="1";
		   $report_status=$this->driver_allocation_model->master_join("ua.controll_id",$reportwhere_clause);
		   $data1['report_status']="0"; 
		   if(count($report_status)>0){
			   $data1['report_status']="1";
		   }
		   $driverfulldata= $this->driver_allocation_model->full_data();
 		   $data['driverfulldata']=$driverfulldata;
		   
		   $vehicle= $this->driver_allocation_model->db_vehiclecheck();
		   $data['vehicle']=$vehicle;	
		   
		   $driver= $this->driver_allocation_model->db_drivercheck();
		   $data['driver']=$driver;	  		  
		   
		   $this->load->view('header',$data1);
   		   $this->load->view('driverallocationlist',$data);
		   $this->load->view('footer');
		   
		   
		  
	  }
	  
	  public function shift_check($vehicle_id,$shift){
		  $where_clasue['vehicle_id']=$vehicle_id;
		  $where_clasue['shift']=$shift;
		  $where_clasue['status']="1";
 		  $shift=$this->driver_allocation_model->db_datacheck("id","driver_allocation",$where_clasue);
 		  return count($shift);
 		  
	  }
	  public function driver_allocate(){
		  
		  $vehicle_id=$this->input->post('vehicle_id');
		  $shift=$this->input->post('shift_type');
 		  $status=$this->shift_check($vehicle_id,$shift);
		  
		  if($status<1){
 			  
			  //updating the driver table status
			  $driver_status['status']="2";
			  $driver_where['id']=$this->input->post('driver_id');
			  $this->driver_allocation_model->db_update("driver_data",$driver_status,$driver_where);
			  
			  //inserting the driver and vehicle details into  driver allocation table
			  $driverdata['vehicle_id']=$vehicle_id;		  
			  $driverdata['driver_id']= $this->input->post('driver_id');
			  $driverdata['shift']= $shift;		  
			  $driverdata['status']="1";		  
			  $driverdata['user']= $this->session->userdata('id');
			  $driverdata['created']= date("Y-m-d H:i:s");
			  $result=$this->driver_allocation_model->db_insert("driver_allocation",$driverdata);
 			  if($result==""){
				    $return['error_flag']="1";
				    $return['message']="Some Error Occur.Please Contact Admin";
			  }else{
				  
				  //updating the driver data to the corresponding vehicle in vehicle data tables
					$vehicleallocate_where['vehicle_id']=$vehicle_id;
					$vehicleallocate_where['status']="1";
					$alloted_drivers=$this->driver_allocation_model->db_datacheck("driver_id,shift","driver_allocation",$vehicleallocate_where);
					if(!(in_array("1", array_column($alloted_drivers, 'shift')))) { 
 					    $manual_data["driver_id"]="";
						$manual_data["shift"]="1";
						array_push($alloted_drivers,$manual_data);
					}
					
					if(!(in_array("0", array_column($alloted_drivers, 'shift')))) { 
 					    $manual_data["driver_id"]="";
						$manual_data["shift"]="0";
						array_push($alloted_drivers,$manual_data);
					}
					 usort($alloted_drivers, function($a, $b) {
                               return $b['shift']-$a['shift'];
                    });
					
 					$alloted_drivers=array_column($alloted_drivers,'driver_id');
					$vehicle_where['id']=$vehicle_id;
					$vehicledata['driver_id']=implode(",",$alloted_drivers);
					$vehicledata['user']=$this->session->userdata('id');
					$vehicledata['modified']= date("Y-m-d H:i:s");
					$this->driver_allocation_model->db_update("vehicle_data",$vehicledata,$vehicle_where); 
 				    $return['error_flag']="0";
			  }
	      }else{
			  $return['error_flag']="1";
			  $shift_type=$shift=="1"?"Day Shift":"Night Shift";
			  $return['message']="Driver is alredy allocated for ".$shift_type." Please un allocate and proceed";
		  }
		   print json_encode($return);
		  
	  }
	  
	   
	   public function driver_unallocate(){
		    $return=array();
		    if($this->input->post('id')!=""){
				$return['error_flag']="0";
				//un allocate the driver
 				$where_device_data['id']=$this->input->post('id');
  				$driverdata_unalloc['user']= $this->session->userdata('id');
 			    $driverdata_unalloc['modified']= date("Y-m-d H:i:s");
				$driverdata_unalloc['status']="0";
				$this->driver_allocation_model->db_update("driver_allocation",$driverdata_unalloc,$where_device_data);
				//updating the driver data in vehicle data table
				$vehicle_details=$this->driver_allocation_model->db_datacheck("vehicle_id,driver_id","driver_allocation",$where_device_data,"1");
 				$vehicle_id=$vehicle_details['vehicle_id'];
 				$vehicleallocate_where['vehicle_id']=$vehicle_id;
				$vehicleallocate_where['status']="1";
				$alloted_drivers=$this->driver_allocation_model->db_datacheck("driver_id,shift","driver_allocation",$vehicleallocate_where);
				if(!(in_array("1", array_column($alloted_drivers, 'shift')))) { 
					$manual_data["driver_id"]="";
					$manual_data["shift"]="1";
					array_push($alloted_drivers,$manual_data);
				}
				
				if(!(in_array("0", array_column($alloted_drivers, 'shift')))) { 
					$manual_data["driver_id"]="";
					$manual_data["shift"]="0";
					array_push($alloted_drivers,$manual_data);
				}
				 usort($alloted_drivers, function($a, $b) {
						   return $b['shift']-$a['shift'];
				});
				
				$alloted_drivers=array_column($alloted_drivers,'driver_id');
				$vehicle_where['id']=$vehicle_id;
				$vehicledata['driver_id']=implode(",",$alloted_drivers);
				$vehicledata['user']=$this->session->userdata('id');
				$vehicledata['modified']= date("Y-m-d H:i:s");
				$this->driver_allocation_model->db_update("vehicle_data",$vehicledata,$vehicle_where); 
				
 				//updating the un allocated driver status
 				$driver_status['status']="1";
		        $driver_where['id']=$vehicle_details['driver_id'];
		        $this->driver_allocation_model->db_update("driver_data",$driver_status,$driver_where);
		 		
   			}else{
			  $return['error_flag']="1";
		      $return['error_message']="Some Error Occur.Please Contact Admin";
 		    }
		  
		  print json_encode($return);
 	   }
	   
	   
	   
 
	  
}
?>