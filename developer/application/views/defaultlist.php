<script src="<?=base_url()?>lib/js/jquery.min.js"></script>
<script src="<?=base_url()?>lib/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>lib/js/editor.js"></script>       
        <link href="<?=base_url()?>lib/css/editor.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url()?>lib/css/tab.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?=base_url()?>lib/css/Toggle_button.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
       <style>
       		#email_address div img, #to_info div img, #cc_info div img, #email_address_1 div img{margin: 2.5px 0 11px 3px; }
			#email_address div label, #to_info div label, #cc_info div label, #email_address_1 div label{float:left;clear:left; margin-top:0}
			.multiselect-container input[type="checkbox"]{left:40px}
			.dataTable thead { background: #3b5998; font-weight: bold; color: white;}
			.dataTables_info{text-align:left}
			table.dataTable{margin-top:0!important; }
		  #alert_settings_table .glyphicon-trash, #email_address_table .glyphicon-trash, #station_table .glyphicon-trash{ color: #a94442;}
		  #alert_settings_table .glyphicon-edit, #email_address_table .glyphicon-edit, #station_table .glyphicon-edit{color: #337ab7;}
		  .mail_select .bootstrap-select{width:80%}
		  .geoffence_multi_select .btn-group{width:100%!important;}
		  #alertsetting_form .bootstrap-select{width:100%}
		    #alertsetting_form label { margin-top: 2.5%!important; margin-bottom: 1%;}
			.geoffence_multi_select label{margin-top: 1%!important;}
			 #alertsetting_form .multiselect{width:100%!important; text-align:left}
			 .label_sub_head{color:#3b5998}
			 <!--.mail_type{width:25%!important}-->
			 #alertsetting_form input[type="text"]{margin-bottom:0}
			 .sub_area{border: 1px solid #ced7dc; padding: 0 2% 2% 2%; margin-top: 3%; background:#f2f4f8}
			 label#Geoffence-error, label#alert_settings_name-error{margin-top:0!important}
			 #alertsetting_form .sub_area .mail_type {width:100%!important}
			 .sub_area .btn-group{width:100%!important; margin-top:5px}
			 .bootstrap-select > select{left:0}
			 .clr-left{clear:left}
			 .select-full-width{width:80%!important; margin-bottom:8px}
       </style>
                      
   
<div class="container">


  <div id="myModal" class="modal fade" role="dialog" style="z-index: 100000;">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Alert Settings</h4>
      </div>
       <form class="cmxform" id="alertsetting_form" method="get" action="" style="text-align:left">
        
         <div class="modal-body">
         		<div class="col-md-6">
                    	<label>Alert Name</label>    
                        <input type="text" name="alert_settings_name" id="alert_settings_name" class="form-control"  placeholder="Alert Name" required>
                  </div>
                  <div class="col-md-6">
                  <label> Geofence Group</label>
                       <select name="Geoffence_group" class="selectpicker themes form-control-sm" id="Geoffence_group" data-live-search="true" required>
                      <option value="">select Geofence Group</option> 
                      
                       <?php 
  				        foreach($geoffencegroupfulldata as $geoffencegroupfulldata_key =>$geoffence_group){?>
                            <option  value="<?=$geoffence_group['id']?>"><?=$geoffence_group['Name']?></option>
                       <?php } ?>
                       </select>
                  </div>
                  <div class="col-md-6 clr-left">
                  		 <label>Vehicle Group</label>
                       <select name="vehicle_group"   class="selectpicker themes form-control-sm " id="vehicle_group" data-live-search="true" required>
                       <option value="">select Vehicle Group</option>
                        <?php 
 				         foreach($groups as $groups_key =>$groups_data){?>
                            <option  value="<?=$groups_data['id']?>"><?=$groups_data['name']?></option>
                        <?php } ?>
                       </select>
                  </div>
                 
                  <div class="clear:both"></div>
                    <div class="col-md-6 geoffence_multi_select">
                       <label> Geofence</label>
                        <select name="Geoffence_name" class="form-control-sm" multiple id="Geoffence_name" data-live-search="true" required>
                          <option value="">select Geofence</option> 
                        </select>
                  </div>
                   <div class="col-md-6 clr-left">
                   		<label class="label_sub_head">Trigger</label>
                            <select name="trigger"  id="trigger" class="selectpicker form-control" >
                               <option value=""> select</option>
                               <option value="1">In</option>
                               <option value="2">Out</option>
                               <option value="3">Both</option>
                            </select>
                    <div class="sub_area collapse"  id="triger_alert_area">        
                            <label>Trigger Email Template</label>
                       <select name="Template"   class="selectpicker themes" id="Template" data-live-search="true" required>
                       <option value="">select Template Name</option>
                       <?php 
 				        foreach($emailfulldata as $emailfulldata_key =>$emaildata){?>
                            <option  value="<?=$emaildata['id']?>"><?=$emaildata['Name']?></option>
                       <?php } ?>
                       </select>
 
                        <label> To Email Address</label>
                        <select name="to_mail_type" class="mail_type selectpicker themes form-control-sm " id="to_mail_type" data-live-search="true" required>
                        <option value="">select Mail Type</option>
                        <option value="1">Internal</option>
                        <option value="2">External</option>
                        </select>
                        
                        <select name="To_address" class="form-control-sm " multiple id="To_address" data-live-search="true" required>
                         </select>
                         
                        <label> CC Email Address</label>
                       <select name="cc_mail_type" class="mail_type selectpicker themes form-control-sm" id="cc_mail_type" data-live-search="true" required>
                       <option value="">select Mail Type</option>
                        <option value="1">Internal</option>
                        <option value="2">External</option>
                       </select>
                       
                        <select name="CC_address" class="form-control-sm " multiple id="CC_address" data-live-search="true" required>
                         </select>
                         </div>
                   </div>
                  <div class="col-md-6">
                  		 <label class="label_sub_head">Speed Alert</label>
                            <select name="speed_alert_choice"  id="speed_alert_choice" class="selectpicker form-control" required >
                            	<option value="0">No</option>
                            	<option value="1">Yes</option>
                            </select>
                            <div class="sub_area" id="speed_alert_area"> 
                            <label>Speed</label><input type="text" name="speed" id="speed" class="form-control"  placeholder="speed" required>
                            <label>Speed Email Template</label>
                       <select name="Speed_Template"   class="selectpicker themes form-control-sm " id="Speed_Template" data-live-search="true" required>
                       <option value="">select Template Name</option>
                       <?php 
 				        foreach($emailfulldata as $emailfulldata_key =>$emaildata){?>
                            <option  value="<?=$emaildata['id']?>"><?=$emaildata['Name']?></option>
                       <?php } ?>
                       </select>
  
                        <label> To Email Address</label>
                        <select name="to_mail_type_speed" class="mail_type selectpicker themes form-control-sm " id="to_mail_type_speed" data-live-search="true" required>
                        <option value="">select Mail Type</option>
                        <option value="1">Internal</option>
                        <option value="2">External</option>
                        </select>
                        
                        <select name="To_address_speed" class="form-control-sm " multiple id="To_address_speed" data-live-search="true" required>
                         </select>
                         
                        <label> CC Email Address</label>
                       <select name="cc_mail_type_speed" class="mail_type selectpicker themes form-control-sm" id="cc_mail_type_speed" data-live-search="true" required>
                       <option value="">select Mail Type</option>
                        <option value="1">Internal</option>
                        <option value="2">External</option>
                       </select>
                       
                        <select name="CC_address_speed" class="form-control-sm " multiple id="CC_address_speed" data-live-search="true" required>
                         </select>
                            </div>
                  </div>
                   <div style="clear:both"></div>
          </div>
      <div class="modal-footer" style="clear: both;">
         <button type="submit" class="btn btn-info" id="alert_insert" >Insert</button>
         <button type="submit" class="collapse btn btn-info" id="alert_update" >Update</button>
       </div>
       </form>
    </div>
     </div>
   </div>
 	<div class="row">
        <div class="col-md-12 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" id="tab_1" class="list-group-item active text-center">
                  <h4 class="fa fa-map-marker"></h4><br/>Geofence Group
                </a>
                <a href="#" id="tab_2" class="list-group-item text-center">
                  <h4 class="fa fa-envelope"></h4><br/>Mail Settings
                </a>
                <a href="#" id="tab_3" class="list-group-item text-center">
                  <h4 class="fa fa-envelope-o"></h4><br/>E-mail Template
                </a>
                <a href="#"  id="tab_4" class="list-group-item text-center">
                  <h4 class="fa fa-clock-o"></h4><br/>Alert Settings
                </a>
                 <a href="#"  id="tab_5" class="list-group-item text-center">
                  <h4 class="fa fa-at"></h4><br/>Email Address
                </a>
                <a href="#" id="tab_6" class="list-group-item text-center">
                  <h4 class="fa fa-clock-o"></h4><br/>Delay Alert Settings
                </a>
                <a href="#" id="tab_7" class="list-group-item text-center">
                  <h4 class="fa fa-building"></h4><br/>Stations
                </a>
              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content active" id="tabcontent_1">
                <div class="tab-header"><i class="fa fa-map-marker"></i>Geofence Group</div>
                    <center>
                      <form class="cmxform" id="geoffenceForm" method="get" action="" style="text-align:left">                     
                      
                       <label >Group Name:</label>
                      <input type="text" name="group_name" id="group_name" placeholder="Group Name" class="form-control" style="float:left; width:80%; display:inline-block" required />
                      <span id="name_error1" class="collapse" style="color:#F00;">Name Already existed</span>
                      <div class="clearfix"></div>
                      <label>Geofence Priority</label>
                       <?php 
					   
					   $geofence_priority = array_column($geoffencegroupfulldata, 'priority');
						$total_count=count($geofence_priority);	   
					   
							
						  
					   //print "<pre>"; print_r($geofence_priority);
							  // die();
					   ?>
                       <select name="geofence_priority" class="selectpicker themes select-full-width" id="geofence_priority" data-live-search="true" required>
                       <option value="">Select Geofence Priority</option>
                      <?php
					   	for($i=1; $i<=($total_count +1);$i++){
						   if (!in_array($i, $geofence_priority)){
							   ?>
							   <option value="<?=$i?>">Priority <?=$i?></option>
							 <?php   }
					   }
 				        ?>
                       </select>
                    
                      <div class="modal-footer">
                      <button type="button" class="btn btn-info" id="group_insert">Insert</button>	
                      <button type="button" class="btn btn-info collapse" id="group_update">Update</button>
                      </div>
                       <input type="hidden" id="group_data_id" value="">
                      </form>
                      <div class="bhoechie-tab-container" style="margin-top:0; padding-top:12px!important;">
                      <div id="table_container">    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a></div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap" width="100%">       
             <thead style="display: table-header-group;">
             <tr class="header">
                <th>Group Name</th>
                 <th>Priority</th>
                <th>Device Status</th>
               <th>Actions</th>
             </tr>
          </thead>
          <tbody>
          <?php
		  
		   /*print "<pre>"; print_r($geoffencegroupfulldata);
		   die();*/
		  
		   foreach($geoffencegroupfulldata as $geoffencegroupfulldata_key =>$geoffence_group){?>
          <tr>
             <td><?=$geoffence_group['Name']?></td>
             <td><?=$geoffence_group['priority']?></td>
             <td id="geoffence_group_status_<?=$geoffence_group['id']?>"><?=$geoffence_group['status']==1?"Active":"Deactivated";?></td>
             <td>  
             <a class="btn edit_geoffencegroup" style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$geoffence_group['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
              
                 <?php if($geoffence_group['status']!=0){ 
				          $collapse1="collapse";
				          $collapse="";				
				       }else{
					     $collapse1="";
				         $collapse="collapse";
				       }
				  ?>
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$geoffence_group['id']?>" style="color: #333" data-toggle="tooltip" title="Deactive Geoffence Group" data-id="<?=$geoffence_group['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                 
                <a id="dlt-clear_<?=$geoffence_group['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Activate Geoffence Group" data-id="<?=$geoffence_group['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
             
             
             <?php } ?>
             </td> 
             </tr>
              
           </tbody>       
         </table>
         </div>
         </div>         </div>
                    </center>
                </div>
                <!-- train section -->
                <div class="bhoechie-tab-content" id="tabcontent_2">
                <div class="tab-header"><i class="fa fa-envelope"></i>E-mail Settings</div>
                   
                   
                    <form class="cmxform" enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="mailsettingForm"  method="post" action="" style="text-align:left; width:90%">
                       
                      <label >Host*:</label>
                      <input type="text" name="Host" id="Host" value="<?=$mail_settings['Host']?>" placeholder="Group Name" class="form-control required" />
                      <div class="clearfix"></div>
                      <label >User*:</label>
                      <input type="text" name="User_name" value="<?=$mail_settings['User_name']?>"  placeholder="User Name" id="User_name" class="form-control required" />
                      <div class="clearfix"></div>
                     <label >Password*:</label>
                      <input type="password" name="Password" value="<?=$mail_settings['Password']?>"  id="Password" placeholder="Password" class="form-control required" />
                      <div class="clearfix"></div>
                      <label >From Address*:</label>
                      <input type="text" name="from_addr" value="<?=$mail_settings['from_addr']?>"  placeholder="From E-mail" id="from_addr" class="form-control required" />
                      <div class="clearfix"></div>
                      <label >Mail Name*:</label>
                      <input type="text" name="Mail_name" value="<?=$mail_settings['Mail_name']?>"  placeholder="E-mail Name" id="Mail_name" class="form-control required" />
                      
                       <div class="modal-footer">
                       <button type="submit" class="btn btn-info" id="mailsetting_update"  >Update</button>
                       </div>
                       <div class="loader" id="loader" style="  top: 0px; left: 0px; "><img src="<?=base_url()?>lib/images/loader.gif"></div>
                      </form>
                   
                </div>
    
                <!-- hotel search -->
                <div class="bhoechie-tab-content" id="tabcontent_3">
                    <div class="tab-header"><i class="fa fa-envelope-o"></i>E-mail Template</div>
                      <form class="cmxform" id="emailForm" method="get" action="">
                      <label style="float:left; padding-right:20px; line-height:15px; margin-top:10px">Templates:</label>
                      <select class="form-control" style="float:left; width:88%" name="template" id="template">
                      <option value="">Select</option>
                      <?php
					  foreach($emailfulldata as $subject){
						  print '<option value="'.$subject['id'].'">'.$subject['Name'].'</option>';
					  }
					  ?>
                      </select>
                      
                      <div class="clearfix"></div>
                       <label style="float:left; padding-right:50px; line-height:15px; margin-top:10px">Name:</label>
                      <input type="text" placeholder="Enter your Template Name here.." class="form-control" name="name" id="name" style="float:left; width:88%; " required />            
                       <span id="mailname_error1" class="collapse" style="color:#F00;">Email Template Name Already existed</span>
                                
                      <div class="clearfix"></div>
                      <label style="float:left; padding-right:38px; line-height:15px; margin-top:10px">Subject:</label>
                      <input type="text" placeholder="Enter your Subject here.." class="form-control" name="subject" id="subject" style="float:left; width:88%; " required />            
                                
                      <div class="clearfix"></div>
                      <div id="txtEditor" ></div>
                     <label id="content-error" class="collapse" for="subject">This field is required.</label>
                      
                      <div class="modal-footer">
                      <button type="button" class="btn btn-info" id="msg_insert">Insert</button>	
                      <button type="button" class="btn btn-info collapse" id="msg_update">Update</button>
                      <button type="button" class="btn btn-info collapse" id="msg_delete">Delete</button>
                      </div>
                      </form>
                    
                </div>
                
                <div class="bhoechie-tab-content" id="tabcontent_4">
                <div class="tab-header"><i class="fa fa-clock-o"></i> Alert Settings</div>
                    <center>
                    <div class="bhoechie-tab-container" style="margin-top:0; padding-top:12px!important;">
                    <div id="table_container">
    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a><a id="add"><i class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></i></a> </div></div>
	    <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="alert_settings_table" class="table table-striped table-bordered display nowrap" >       
             <thead style="display: table-header-group;">
             <tr class="header">
              <th>Alert Name</th>
                <th>Geofence Group</th>
                 
                <th>Vehicle group</th>
                 <th>Created</th>
                <th>Modified</th>
               <th> Actions</th>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($alert_settings as $alert_settings=>$alert_settings_data){
			  ?>
             <tr>
               <td><?=strtoupper($alert_settings_data['alert_name'])?></td> 
               <td><?=strtoupper($alert_settings_data['geoffence_group_name'])?></td>
               
               <td><?=strtoupper($alert_settings_data['vehicle_group'])?></td>
               <td><?=$alert_settings_data['created']?></td>
               <td><?=$alert_settings_data['modified']?></td>
               <td>        
               <a class="btn alert_settings_edit"  style="color: #333; " data-toggle="tooltip" title="Edit" data-id="<?=$alert_settings_data['id']?>">
               
               <input type="hidden" id="alert_settings_id" value="" />
               
               
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>  
                
                
                             
                <a class="btn alert_settings_delete" id="dlt-add_<?=$alert_settings_data['id']?>"  style="color: #333" data-toggle="tooltip" title="Delete Alert Settings" data-id="<?=$alert_settings_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                
 
              </td>
             </tr>
              <?php }?>
          </tbody>
         </table>
    </div>
     </div>
</div>
                     </center>
                </div>
                
                
             <div class="bhoechie-tab-content active" id="tabcontent_5">
                <div class="tab-header"><i class="fa fa-map-marker"></i>Email Address</div>
                    <center>
                      <form class="cmxform" id="Emailform" method="get" action="" style="text-align:left">                     
                      
                       <label >Company  Name:</label>
                      <input type="text" name="com_name" id="com_name" placeholder="Company Name" class="form-control" style="float:left; width:80%; display:inline-block" required />
                      <div class="mail_select">
                      <label style="clear:left; margin-bottom:5px"> Mail Type</label>
                       <select name="Mail_type" class="selectpicker themes form-control-sm" id="Mail_type" data-live-search="true" required>
                         <option value="">select Mail Type</option> 
                         <option value="1">Internal</option> 
                         <option value="2">External</option> 
                       </select>
                       </div>
                        <div class="clearfix"></div>
                       
                      <div id="email_address_1">
                      <label>E-mail:</label>
                      
                      <div id="emailaddrdiv_1">
                      <input type="text" name="email_address" id="emailaddr_1" data-id="1" class="form-control email_address" placeholder="E-mail" style="float:left; width:80%; " required>
                         <img width="30px" class="add_email_addr" data-id="1" src="<?= base_url()?>lib/images/add.png">
              <img width="30px" class="collapse remove_email_addr" data-id="1"  id="remove_email" src="<?= base_url()?>lib/images/remove.png">
                      </div>
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-info" id="Email_insert">Insert</button>	
                      <button type="button" class="btn btn-info collapse" id="Emailupdate">Update</button>
                      </div>
                       <input type="hidden" id="email_data_id" value="">
                      </form>
                      <div class="bhoechie-tab-container" style="margin-top:0; padding-top:12px!important;">
                      <div id="table_container">    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a></div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="email_address_table" class="table table-striped table-bordered display nowrap" width="100%">       
             <thead style="display: table-header-group;">
             <tr class="header">
                <th>Company  Name</th>
                 <th>Type</th>
                <th>E-mail</th>
                <th>Created</th>
                <th>Modified</th>
               <th> Actions</th>
             </tr>
          </thead>
          <tbody>
          <?php
		  
		   /*print "<pre>"; print_r($geoffencegroupfulldata);
		   die();*/
		  
		   foreach($emailfulladdr as $emailfulldata_key =>$Email_data){?>
          <tr>
             <td><?=$Email_data['Company_name']?></td>
             <td><?=$Email_data['type']=="1"?"Internal":"External";?></td>
             <td><?=$Email_data['email']?></td>
             <td><?=$Email_data['created']?></td>
             <td><?=$Email_data['modified']?></td>
             <td>  
             <a class="btn edit_email" style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$Email_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
              
                  
                <a class="btn email_delete " id="dlt-add_<?=$Email_data['id']?>" style="color: #333" data-toggle="tooltip" title="Delete email address" data-id="<?=$Email_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                 
                </td> 
             </tr>
              <?php } ?>
            </tbody>       
         </table>
         </div>
         </div>         </div>
                    </center>
                </div>   
                
                
                
                
                
                
                
                
                 
                <div class="bhoechie-tab-content" id="tabcontent_6">
                <div class="tab-header"><i class="fa fa-clock-o"></i> Delay Alert Settings</div>
                    <center>
                       <form class="cmxform" enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="delaysettingForm"  method="post" action="" style="text-align:left">
                       
                     
                     
                       <label >Reminder Status:</label>
                      <div class="wrapper">
			  
  <input name="r_status" id="r_status" type="checkbox" value="1"  <?=$cronfulldata['reminder_status']=="1"?"checked":"";?>/><label class="toggle" for="r_status"><span class="toggle--handler"></span></label>
			</div>
                      <?php
					  $class=$cronfulldata['reminder_status']=="1"?"collapse":"";
 					  ?>
                      <div class="clearfix"></div>
                       <label >Reminder Time:</label>
<input type="text" name="r_time" value="<?=$cronfulldata['reminder_time']?>" placeholder="reminder time" id="r_time" class="form-control required <?=$class?>" style="float:left; width:84%;" />
                      <div class="clearfix"></div>
                      
                       <div id="to_info">
                       <label >TO:</label>
                      
                      <?php
					   $tomail=1;
					   $toaddr=explode(",",rtrim($cronfulldata['to_addr'],", "));
					   if(count($toaddr)>0){
						   foreach($toaddr as $addrt){?>
                           <div id="todiv_<?=$tomail?>">
                           <input type="text" name="delay_mail_to" id="delaymailto_<?=$tomail?>" value="<?=$addrt?>" placeholder="To Mail" class="form-control required" style="float:left; width:84%; " />
                        
                       <img width="30px" class="delaymailto_remove" data-id="<?=$tomail?>"  id="delaymailto_remove" src="<?= base_url()?>lib/images/remove.png">
              </div>
                            <?php
						   $tomail++;
						   }
					   }
					  ?>
                       <div id="todiv_<?=$tomail?>">
                      <input type="text" name="delay_mail_to" id="delaymailto_<?=$tomail?>" value="" placeholder="To Mail" class="form-control required" style="float:left; width:84%; " />
                      
              <img width="30px" class="delaymailto_add" data-id="<?=$tomail?>" id="delaymailto_add" src="<?= base_url()?>lib/images/add.png">
              <img width="30px" class="collapse delaymailto_remove" data-id="<?=$tomail?>"  id="delaymailto_remove" src="<?= base_url()?>lib/images/remove.png">
              
                      </div>
              
                      
                       </div>
                      <div class="clearfix"></div>
                      <div id="cc_info">
                      
                      <label >CC:</label>
                       <?php 
					    $ccmail=1;
					    $ccaddr=explode(",",rtrim($cronfulldata['cc_addr'],", "));
					   if(count($ccaddr)>0){
						   foreach($ccaddr as $addrcc){?>
                             <div id="ccdiv_<?=$ccmail?>">
                            <input type="text" name="delay_mail_cc" value="<?=$addrcc?>"  placeholder="CC Mail" id="delaymailcc_<?=$ccmail?>" class="form-control " style="float:left; width:84%;" />
               <img width="30px" class="delaymailcc_remove" data-id="<?=$ccmail?>"  id="delaymailcc_remove" src="<?= base_url()?>lib/images/remove.png">
                          </div> 
                        <?php 
					       $ccmail++;
						   }
					   }
					  ?>
                        <div id="ccdiv_<?=$ccmail?>">
                       <input type="text" name="delay_mail_cc" value=""  placeholder="CC Mail" id="delaymailcc_<?=$ccmail?>" class="form-control " style="float:left; width:84%;" />
                       <img width="30px" class="delaymailcc_add" data-id="<?=$ccmail?>" id="delaymailcc_add" src="<?= base_url()?>lib/images/add.png">
              <img width="30px" class="collapse delaymailcc_remove" data-id="<?=$ccmail?>"  id="delaymailcc_remove" src="<?= base_url()?>lib/images/remove.png">
                       </div>
                       </div>
                        <div class="modal-footer">
                       <button type="submit" class="btn btn-info" id="delaysetting_update"  >Update</button>
                       </div>
                      </form>
                    </center>
                </div>
                 
                
                <!-- Station Starts -->

                <div class="bhoechie-tab-content active" id="tabcontent_7">
                  <div class="tab-header"><i class="fa fa-building"></i>Stations</div>
                  <center>
                    <form class="cmxform" id="Stationform" style="text-align:left">
                      <label>Station Code:</label>
                      <input type="number" name="station_code" id="station_code" placeholder="Station Code" class="form-control" style="float:left; width:80%; display:inline-block" required />
                      <div class="clearfix"></div>
                      <div id="email_address_1">
                        <label>Station Name:</label>
                        <input type="text" name="station_name" id="station_name" placeholder="Station Name" class="form-control" style="float:left; width:80%; display:inline-block" required />
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="station_insert">Insert</button>
                        <button type="button" class="btn btn-info collapse" id="Stationupdate">Update</button>
                      </div>
                      <input type="hidden" id="station_data_id" value="">
                    </form>
                    <div class="bhoechie-tab-container" style="margin-top:0; padding-top:12px!important;">
                      <div id="table_container">
                        <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a>
                        </div>
                      </div>
                      <div class="scrollbar" id="style-1">
                        <div class="table-responsive">
                          <table id="station_table" class="table table-striped table-bordered display nowrap" width="100%">
                            <thead style="display: table-header-group;">
                              <tr class="header">
                                <th>Station Code</th>
                                <th>Station Name</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($stations as $stations){?>
                              <tr>
                                <td>
                                  <?=$stations['station_code']?>
                                </td>
                                <td>
                                  <?=$stations['station_name']?>
                                </td>
                                <td>
                                  <?=$stations['status']?>
                                </td>
                                <td>
                                  <?=$stations['created']?>
                                </td>
                                <td>
                                  <a class="btn edit_station" style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$stations['id']?>"> <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i>
                                  </a> 
                                  <?php
                                  if($stations['status'] == "1")
                                  { 
                                  ?>
                                  <a class="btn station_delete " id="dlt-add_<?=$stations['id']?>" style="color: #333" data-toggle="tooltip" title="Disable Station" data-id="<?=$stations['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i>
                                  </a>
                                  <?php
                                  }
                                  else
                                  {
                                  ?>
                                  <a class="btn station_enable" id="dlt-add_<?=$stations['id']?>" style="color: #333" data-toggle="tooltip" title="Enable Station" data-id="<?=$stations['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i>
                                  <?php
                                  }
                                  ?>
                                </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </center>
                </div>

                <!-- Station Ends -->

            </div>
        </div>
  </div>
</div>   

<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>lib/js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>lib/js/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="<?php echo base_url(); ?>lib/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>lib/js/jquery.selectBoxIt.js"></script>
<script>



$(document).ready(function() {
	
	if(<?=$_GET['id']?>!=""){
	
	$(".list-group-item").each(function(index, element) {
 		$(this).removeClass('active');
		
	});
	$(".bhoechie-tab-content").each(function(index, element) {
 		$(this).removeClass('active');
 	});
	
	$("#tab_<?=$_GET['id']?>").addClass('active');
	$("#tabcontent_<?=$_GET['id']?>").addClass('active');
 	
	}
	
	
	$('#Geoffence_name').multiselect({
         nonSelectedText: 'Select Geoffence',
         enableFiltering: true,
         enableCaseInsensitiveFiltering: true,
         buttonWidth:'400px',
		 maxHeight: 300
    });
	
	$('#To_address').multiselect({
         nonSelectedText: 'Select Mail Address',
         enableFiltering: true,
         enableCaseInsensitiveFiltering: true,
         buttonWidth:'400px',
		 maxHeight: 300
    });
	
	$('#CC_address').multiselect({
         nonSelectedText: 'Select Mail Address',
         enableFiltering: true,
         enableCaseInsensitiveFiltering: true,
         buttonWidth:'400px',
		 maxHeight: 300
    });
	
	$('#To_address_speed').multiselect({
         nonSelectedText: 'Select Mail Address',
         enableFiltering: true,
         enableCaseInsensitiveFiltering: true,
         buttonWidth:'400px',
		 maxHeight: 300
    });
	
	$('#CC_address_speed').multiselect({
         nonSelectedText: 'Select Mail Address',
         enableFiltering: true,
         enableCaseInsensitiveFiltering: true,
         buttonWidth:'400px',
		 maxHeight: 300
    });
	
 	
    $("#loader").css("display", "none");
 	var table = $('#example').DataTable({
		"responsive": true,
		"autoWidth": true,
		"orderCellsTop": true,
		"searching": true,
	});
	
	$('#alert_settings_table').DataTable({
		"responsive": true,
		"autoWidth": true,
		"orderCellsTop": true,
		"searching": true,
	});
	
	$('#email_address_table').DataTable({
		"responsive": true,
		"autoWidth": true,
		"orderCellsTop": true,
		"searching": true,
	});

  $('#station_table').DataTable({
    "responsive": true,
    "autoWidth": true,
    "orderCellsTop": true,
    "searching": true,
  });
			
	 $('#mailsettingForm').validate();
	 $('#delaysettingForm').validate();
	 $('#Emailform').validate();
	 var alert_settingsvalidator = $('#alertsetting_form').validate({});	
	 
	 
	
	 
	$(document).on("click", '.logout', function (event) {
			  
			  swal({
                      title: "Are you sure?",
                      text: "Do you really want to Logout?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                }).then(function(logout){
 			      if(logout){
					  url=  "<?php echo  base_url(); ?>";
					  window.location.href = url;
				  }
				});
    });	
		  
	 $(document).on("click", '.glyphicon-filter', function (event) {		 
        $('#example_filter').toggle(); 
		$('#alert_settings_table_filter').toggle(); 
 	 });
		  
	 $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });  
	
	function isEmail(email,dataid) {
			  
 			  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			  var message="";
			  if(regex.test(email)){
				   $(".email").each(function() {
 					   if($(this).attr("data-id")!=dataid){
						   var exist_email=$(this).val();
						   if(email==exist_email){
 							   message="Already entered the email address";
						   }
					   }
 				   });
 			  }else{
 				 message="Please enter a valid email address";
			  } 
			   
			   return message;
     }
	 
	 
	  $(document).on("click", '.delaymailto_add', function (event) {
 			 
			  var current_val=$(this).prevAll("input[type=text]");
			  var dataid=parseInt($(this).attr("data-id"))+1;
 			  var validation=isEmail(current_val.val(),$(this).attr("data-id"));
			  if(validation==""){
				   $(this).addClass("collapse");
			       $(this).next().removeClass("collapse");
 				   $("#email_address-error").remove();
  				  $("#to_info").append('<div id="todiv_'+dataid+'"><input type="text" name="delay_mail_to" id="delaymailto_'+dataid+'" value="" placeholder="Group Name" class="form-control required" style="float:left; width:84%; " /><img width="30px" class="delaymailto_add" data-id="'+dataid+'" id="delaymailto_add" src="<?= base_url()?>lib/images/add.png"><img width="30px" class="collapse delaymailto_remove" data-id="'+dataid+'"  id="delaymailto_remove" src="<?= base_url()?>lib/images/remove.png"></div>');
			  }else{
				    var current_val=$(this).prev("#email-error");
  				    current_val.remove();
 				    $(this).prev("input[type=text]").after('<label id="email_address-error" class="error" for="email_address" style="display: block;">'+validation+'.</label>')
			  }
			  
	  });
	 
	 $(document).on("click", '.delaymailcc_add', function (event) {
 			 
			  var current_val=$(this).prevAll("input[type=text]");
			  var dataid=parseInt($(this).attr("data-id"))+1;
 			  var validation=isEmail(current_val.val(),$(this).attr("data-id"));
			  if(validation==""){
				   $(this).addClass("collapse");
			       $(this).next().removeClass("collapse");
 				   $("#email_address-error").remove();
  				  $("#cc_info").append('<div id="ccdiv_'+dataid+'"><input type="text" name="delay_mail_cc" value=""  placeholder="CC" id="delaymailcc_'+dataid+'" class="form-control " style="float:left; width:84%;" /><img width="30px" class="delaymailcc_add" data-id="'+dataid+'" id="delaymailcc_add" src="<?= base_url()?>lib/images/add.png"><img width="30px" class="collapse delaymailcc_remove" data-id="'+dataid+'"  id="delaymailcc_remove" src="<?= base_url()?>lib/images/remove.png"></div>');
			  }else{
				    var current_val=$(this).prev("#email-error");
  				    current_val.remove();
 				    $(this).prev("input[type=text]").after('<label id="email_address-error" class="error" for="email_address" style="display: block;">'+validation+'.</label>')
			  }
			  
	  });
	 
	 
	 
 	 $(document).on("click", '.add_email', function (event) {
 			 
			  var current_val=$(this).prevAll("input[type=text]");
			  var dataid=parseInt($(this).attr("data-id"))+1;
 			  var validation=isEmail(current_val.val(),$(this).attr("data-id"));
			  
			  
 			  if(validation==""){
				  
				   $(this).addClass("collapse");
			       $(this).next().removeClass("collapse");
 				   $("#email_address-error").remove();
  				   
 				  $("#email_address").append('<div id="emaildiv_'+dataid+'"><input type="text" name="email_address"  data-id="'+dataid+'"  id="email_'+dataid+'" class="form-control email" placeholder="Address" style="float:left; width:80%; "><img width="30px"  data-id="'+dataid+'"  class="add_email" src="<?= base_url()?>lib/images/add.png"><img width="30px" class="collapse remove_email" data-id="'+dataid+'" id="remove_email" src="<?= base_url()?>lib/images/remove.png"></div>');
				  
			  }else{
				  
				   var current_val=$(this).prev("#email-error");
  				    current_val.remove();
 				    $(this).prev("input[type=text]").after('<label id="email_address-error" class="error" for="email_address" style="display: block;">'+validation+'.</label>')
 			  }
 	 });
	 
	 
	  $(document).on("click", '.add_email_addr', function (event) {
 			 
			  var current_val=$(this).prevAll("input[type=text]");
			  var dataid=parseInt($(this).attr("data-id"))+1;
 			  var validation=isEmail(current_val.val(),$(this).attr("data-id"));
			  
			  
 			  if(validation==""){
				  
				   $(this).addClass("collapse");
			       $(this).next().removeClass("collapse");
 				   $("#email_address-error").remove();
  				   
 				  $("#email_address_1").append('<div id="emailaddrdiv_'+dataid+'"><input type="text" name="email_address"  data-id="'+dataid+'"  id="email_'+dataid+'" class="form-control email_address" placeholder="Address" style="float:left; width:80%; "><img width="30px"  data-id="'+dataid+'"  class="add_email_addr" src="<?= base_url()?>lib/images/add.png"><img width="30px" class="collapse remove_email_addr" data-id="'+dataid+'" id="remove_email" src="<?= base_url()?>lib/images/remove.png"></div>');
				  
			  }else{
				  
				   var current_val=$(this).prev("#email-error");
  				    current_val.remove();
 				    $(this).prev("input[type=text]").after('<label id="email_address-error" class="error" for="email_address" style="display: block;">'+validation+'.</label>')
 			  }
 	 });
	 
	 
	 
	 
	 
	 
	 
	  $(document).on("click", '.delaymailto_remove', function (event) {
 			  $("#todiv_"+$(this).attr("data-id")).remove();
  	 });
	 
	  $(document).on("click", '.delaymailcc_remove', function (event) {
 			  $("#ccdiv_"+$(this).attr("data-id")).remove();
  	 });
 		  
	 $(document).on("click", '.remove_email', function (event) {
 			  $("#emaildiv_"+$(this).attr("data-id")).remove();
  	 });
	 $(document).on("click", '.remove_email_addr', function (event) {
 			  $("#emailaddrdiv_"+$(this).attr("data-id")).remove();
  	 });
	 
	 
	 $(document).on("change", '#group_name', function (event) {
 	 var group_name=$(this).val();
	 $.ajax({
		 url: "<?=base_url()?>Defaultmaster/groupname_check", 
		 data:{group_name:group_name},
		 method: "POST",
		 success: function(result){
 			 var data = $.parseJSON(result); 
			 
			 if(data>0){
  				  $("#name_error1").removeClass("collapse");
				  $("#name_error1").addClass("error");
				  $("#group_insert").prop("disabled",true);
  			 }else{
				  $("#name_error1").addClass("collapse");
				   $("#name_error1").removeClass("error");
				  $("#group_insert").prop("disabled",false);
			 }
 		 }
			 
	 });
 });
 
 
 
 
 	 
 $('.mail_type').on('change', function() {
	 
	 var type=$(this).val();
	 var id=this.id;
	 $.ajax({
		 url: "<?=base_url()?>Defaultmaster/select_mail_address", 
		 data:{type:type},
		 method: "POST",
		 success: function(result){
   			 var email_data = $.parseJSON(result);
 			 
			 if(id=="to_mail_type"){
				$selectbox= $('#To_address');
			 }else if (id=="to_mail_type_speed"){
				 $selectbox= $('#To_address_speed');
			 }else if (id=="cc_mail_type"){
				 $selectbox=$('#CC_address');
 			 }else{
				  $selectbox=$('#CC_address_speed');
			 }
 			 var optionsvalues="";
 			 $.each(email_data, function( key, data ) {
  				 optionsvalues+='<option value="'+data.id+'">'+data.email+'</option>';
 			 });
 			  $selectbox.multiselect();
			  $selectbox.html(optionsvalues)
 			  $selectbox.multiselect('destroy');
			  $selectbox.multiselect( {enableFiltering: true,enableCaseInsensitiveFiltering: true,buttonWidth:'400px'});
 			  $selectbox.multiselect('refresh');
  		 }
	  });
	 
 });
	
 $(document).on("change","#speed_alert_choice",function(event){
	
        var Speed_status=$(this).val();
        if (Speed_status== '1'){
           $("#speed_alert_area").removeClass("collapse");
        }
        else {
           $("#speed_alert_area").addClass("collapse");
        }
 });
 
 $(document).on("change","#trigger",function(event){
	 var triger_status=$(this).val();
	 
	 if(triger_status==""){
		 $("#triger_alert_area").addClass("collapse");
	 }else{
		 $("#triger_alert_area").removeClass("collapse");
		
	 }
	 
 });
 
 function show_geoffence_group(){
	  var geo_group_id=$("#Geoffence_group").val();
	  var vehicle_group=$("#vehicle_group").val();
	 
	  $.ajax({
		 url: "<?=base_url()?>Defaultmaster/select_geoffence", 
		 data:{geo_group_id:geo_group_id,vehicle_group:vehicle_group},
		 method: "POST",
		 success: function(result){
			 
			 var geoffence_data = $.parseJSON(result);
 			 var optionsvalues="";
 			 $.each( geoffence_data, function( key, data ) {
 				 optionsvalues+='<option value="'+data.id+'">'+data.name+'</option>'
 			 });
 			  
			   
			  $('#Geoffence_name').multiselect();
			   $("#Geoffence_name").html(optionsvalues)
 			  $("#Geoffence_name").multiselect('destroy');
			  $('#Geoffence_name').multiselect( {enableFiltering: true,enableCaseInsensitiveFiltering: true,buttonWidth:'400px',maxHeight: 300,includeSelectAllOption: true,});
 			  $('#Geoffence_name').multiselect('refresh');
 			 
 		 }
	  });
 }
 
 $(document).on("change","#To_address",function(event) {
	 var to_address=$(this).val();
        $.each($("#CC_address option:selected"), function(){
   		   if(!(jQuery.inArray($(this).val(), to_address)=="-1")){
 			    swal({
					 text:"This Email ID was already selected in CC address",
					 icon: "error",
					 button: "ok",
				 });
				 $("#To_address").multiselect('deselect', [$(this).val()]); 
				 
 		   }
       });
 });
 
 $(document).on("change","#CC_address",function(event) {
	 cc_address=$(this).val();
       $.each($("#To_address option:selected"), function(){
		  
		   if(!(jQuery.inArray($(this).val(), cc_address)=="-1")){
			    swal({
					 text:"This Email ID was already selected in TO address",
					 icon: "error",
					 button: "ok",
				 });
				$("#CC_address").multiselect('deselect', [$(this).val()]); 
		   }
       });
 });
 $(document).on("change","#To_address_speed",function(event) {
	 to_address=$(this).val();
       $.each($("#CC_address_speed option:selected"), function(){
		  if(!(jQuery.inArray($(this).val(), to_address)=="-1")){
			    swal({
					 text:"This Email ID was already selected in CC address",
					 icon: "error",
					 button: "ok",
				 });
				$("#To_address_speed").multiselect('deselect', [$(this).val()]); 
		   }
       });
 });
 
 $(document).on("change","#CC_address_speed",function(event) {
	 cc_address=$(this).val();
       $.each($("#To_address_speed option:selected"), function(){
		 if(!(jQuery.inArray($(this).val(), cc_address)=="-1")){
			    swal({
					 text:"This Email ID was already selected in TO address",
					 icon: "error",
					 button: "ok",
				 });
				$("#CC_address_speed").multiselect('deselect', [$(this).val()]); 
		   }
       });
 });
 
 
  
 $(document).on("change","#Geoffence_group",function(event){
	 show_geoffence_group()
 });
  
 $(document).on("change","#vehicle_group",function(event){
	 show_geoffence_group()
 });
 
 
$(document).on("click", '.alert_settings_edit', function (event) {
	
    	  id=$(this).attr("data-id");
		  $("#alert_settings_id").val(id);
		  $("#alertsetting_form")[0].reset();
		  
		  
		  $.ajax({
			     url: "<?=base_url()?>/Defaultmaster/alert_settings_selecting", 
			     data:{id:id},
			      method: "POST",
			      success: function(response){
 					 var data = $.parseJSON(response); 
 					 if(data.error_flag=="1"){
						 swal({
                                 text: data.error_message,
                                 icon: "error",
                                 button: "ok",
                          });
					 }else{
						 
						  
					  $.each(data.information, function(index, pvalue) {
						  
						   if(index=="Geoffence_group"){ 
 							    $('select[name='+index+']').val(pvalue);
   						   }else if(index=="all_geoffence"){
							    var optionsvalues="";
 							    $.each( pvalue, function( key, data ) {
								   optionsvalues+='<option value="'+data.id+'">'+data.name+'</option>'
							    });
								
 								$('#Geoffence_name').multiselect();
								$("#Geoffence_name").html(optionsvalues)
								$("#Geoffence_name").multiselect('destroy');
								$('#Geoffence_name').multiselect( {enableFiltering: true,enableCaseInsensitiveFiltering: true,buttonWidth:'400px',maxHeight: 300,includeSelectAllOption: true,});
								$('#Geoffence_name').multiselect('refresh');
								
								 
						   }else if(index=="Geoffence_name"){
  							   $.each(pvalue,function(keyindex, optionVal){
 								   $("#Geoffence_name").multiselect('select', [optionVal]);
 							   });
 						   }else if(index=="trigger"){
							   
							   if(pvalue>0){
								   $("#triger_alert_area").removeClass("collapse");
								  
							   }else{
								   $("#triger_alert_area").addClass("collapse"); 
 							   }
							   
							   $('select[name='+index+']').val(pvalue);
						   }else if(index=="Template"){
							   $('select[name='+index+']').val(pvalue);
						   }else if(index=="vehicle_group"){
							   $('select[name='+index+']').val(pvalue);
						   }else if(index=="to_mail_type"){
							   $('select[name='+index+']').val(pvalue);
						   }else if(index=="allTo_address"){
							   
 							   var optionsvalues="";
							   if(pvalue!=""){
							   if(pvalue.length>0){
 							      $.each( pvalue, function( key, data ) {
 								     optionsvalues+='<option value="'+data.id+'">'+data.email+'</option>'
							      });
								 }
							    }
 								
 								  $('#To_address').multiselect();
								  $("#To_address").html(optionsvalues)
								  $("#To_address").multiselect('destroy');
								  $('#To_address').multiselect( {enableFiltering: true,enableCaseInsensitiveFiltering: true,buttonWidth:'400px',includeSelectAllOption: true,});
								  $('#To_address').multiselect('refresh');
								 
								
								
 						   }else if(index=="allspeedTo_address"){
							   
 							   var optionsvalues="";
							    if(pvalue!=""){
							    if(pvalue.length>0){
								   $.each( pvalue, function( key, data ) {
									 optionsvalues+='<option value="'+data.id+'">'+data.email+'</option>'
								  });
								 }
								}
								  $('#To_address_speed').multiselect();
								  $("#To_address_speed").html(optionsvalues)
								  $("#To_address_speed").multiselect('destroy');
								  $('#To_address_speed').multiselect( {enableFiltering: true,enableCaseInsensitiveFiltering: true,buttonWidth:'400px',includeSelectAllOption: true,});
								  $('#To_address_speed').multiselect('refresh');
								
								 
						   }
						   else if(index=="To_address"){
							    if(pvalue!=""){
								   if(pvalue.length>0){
									   //console.log("to address"+pvalue);
									$.each(pvalue,function(keyindex, optionVal){
										$("#"+index).multiselect('select', [optionVal]);
									 });
								   }
								}
							   
						   }else if(index=="cc_mail_type"){
							   $('select[name='+index+']').val(pvalue);
						   }else if(index=="allCC_address"){
							   var optionsvalues="";
							    if(pvalue!=""){
								  if(pvalue.length>0){	
										$.each( pvalue, function( key, data ) {
										   optionsvalues+='<option value="'+data.id+'">'+data.email+'</option>'
										});
								   }
								 }		
										$('#CC_address').multiselect();
										$("#CC_address").html(optionsvalues)
										$("#CC_address").multiselect('destroy');
										$('#CC_address').multiselect( {enableFiltering: true,enableCaseInsensitiveFiltering: true,buttonWidth:'400px',includeSelectAllOption: true,});
										$('#CC_address').multiselect('refresh');
								  
								
 						   }else if(index=="allspeedCC_address"){
							    var optionsvalues="";
								 if(pvalue!=""){
									   if(pvalue.length>0){
										  $.each( pvalue, function( key, data ) {
											 optionsvalues+='<option value="'+data.id+'">'+data.email+'</option>'
										  });
								       }
								  }		 
										 $('#CC_address_speed').multiselect();
										  $("#CC_address_speed").html(optionsvalues)
										  $("#CC_address_speed").multiselect('destroy');
										  $('#CC_address_speed').multiselect( {enableFiltering: true,enableCaseInsensitiveFiltering: true,buttonWidth:'400px',includeSelectAllOption: true,});
										  $('#CC_address_speed').multiselect('refresh');
										  
									 
						   }
						   else if(index=="CC_address"){
							    if(pvalue!=""){
									 if(pvalue.length>0){
									   $.each(pvalue,function(keyindex, optionVal){
										 $("#"+index).multiselect('select', [optionVal]);
									   });
									 }
								}
						   } else if(index=="speed_alert_choice"){
							  
							  console.log(pvalue);
 							   if(pvalue>0){
								   $("#speed_alert_area").removeClass("collapse");
 							   }else{
								    $("#speed_alert_area").addClass("collapse");
  							   }
 							   $('select[name='+index+']').val(pvalue);
						   }
						  else if(index=="Speed_Template"){
							     $('select[name='+index+']').val(pvalue);
						   }else if(index=="to_mail_type_speed"){
							   $('select[name='+index+']').val(pvalue);
						   }else if(index=="To_address_speed"){
							    if(pvalue!=""){
							     if(pvalue.length>0){
 							        $.each(pvalue,function(keyindex, optionVal){
 								        $("#"+index).multiselect('select', [optionVal]);
 							         });
								 }
								}
						   } else if(index=="cc_mail_type_speed"){
							   $('select[name='+index+']').val(pvalue);
						   }else if(index=="CC_address_speed"){
							    if(pvalue!=""){
							      if(pvalue.length>0){
							        $.each(pvalue,function(keyindex, optionVal){
 								     $("#"+index).multiselect('select', [optionVal]);
 							       });
							      }
								}
						   } 
 						   else{
							   $("#"+index).val(pvalue);
						   }
							 
					  });
						 $('.selectpicker').selectpicker('refresh');
						  $("#alert_update").removeClass("collapse");
						  $("#alert_insert").addClass("collapse");
						  alert_settingsvalidator.resetForm();
  						 $("#myModal").modal('show'); 
					 }
				 }
		  });
		  
});
 
 $(document).on("click", '#add', function (event) {
 	        $("#alert_insert").removeClass("collapse");
	        $("#alert_update").addClass("collapse");
			 alert_settingsvalidator.resetForm();
 			$("#Geoffence_group-error").remove();
 			$("#alertsetting_form")[0].reset();
			$('#alertsetting_form').find('option:selected').removeAttr('selected').trigger('change');
   			$('.selectpicker').selectpicker('refresh');
			$('#Geoffence_name').multiselect();
			$("#Geoffence_name").html("")
			$("#Geoffence_name").multiselect('destroy');
		    $('#Geoffence_name').multiselect( {enableFiltering: true,enableCaseInsensitiveFiltering: true,buttonWidth:'400px',maxHeight: 300,includeSelectAllOption: true,});
			$('#Geoffence_name').multiselect('refresh');
			$('#Geoffence_name').multiselect();
			$("#To_address").html("")
			$("#To_address").multiselect('destroy');
		    $('#To_address').multiselect( {enableFiltering: true,enableCaseInsensitiveFiltering: true,buttonWidth:'400px',maxHeight: 300,includeSelectAllOption: true,});
			$('#To_address').multiselect('refresh');
			$('#To_address').multiselect();
			$("#CC_address").html("")
			$("#CC_address").multiselect('destroy');
		    $('#CC_address').multiselect( {enableFiltering: true,enableCaseInsensitiveFiltering: true,buttonWidth:'400px',maxHeight: 300,includeSelectAllOption: true,});
			$('#CC_address').multiselect('refresh');
 			$("#myModal").modal('show');
  						
 });
	 
 $(document).on("click", '#alert_update', function(event){
	      event.preventDefault();
 		  
		 if($("#speed_alert_choice").val()=="0"){
			 $('#trigger').attr('required',true);
		 }else{
			 $('#trigger').attr('required',false);
		 }
		 
		  
 		 var geoffence = [];
		 var to_addr=[];
		 var cc_addr=[];
		 var to_addr_speed=[];
		 var cc_addr_speed=[];
		 var error_flag="0";
		 
         $.each($("#Geoffence_name option:selected"), function(){            
               geoffence.push($(this).val());
         });
		 
		  $.each($("#To_address option:selected"), function(){            
               to_addr.push($(this).val());
         });
		 
		  $.each($("#CC_address option:selected"), function(){            
               cc_addr.push($(this).val());
         });
		 
		 $.each($("#To_address_speed option:selected"), function(){            
               to_addr_speed.push($(this).val());
         });
		 
		  $.each($("#CC_address_speed option:selected"), function(){            
               cc_addr_speed.push($(this).val());
         });
		 
 		 $("#Geoffence-error").remove();
		 $("#To_address-error").remove();
		 $("#CC_address-error").remove();
		 $("#To_address_speed-error").remove();
		 $("#CC_address_speed-error").remove();
		 
 		 if($("#alertsetting_form").valid()){
			  error_flag="0";
		 } else{ 
		      error_flag="1";
		 }
		 
		 
			 
 		 if(geoffence.length==0){
			 
  			 $("#Geoffence_name").next(".btn-group").after('<label id="Geoffence-error" class="error" for="Geoffence_name">This field is required.</label>');
 			 error_flag="1";
 		 }
		 if($("#trigger").val()!="0"){
		   if(to_addr.length==0){
			  $("#To_address").next(".btn-group").after('<label id="To_address-error" class="error" for="To_address">This field is required.</label>');
			 error_flag="1";
 		   }
		   if(cc_addr.length==0){
			  $("#CC_address").next(".btn-group").after('<label id="CC_address-error" class="error" for="CC_address">This field is required.</label>');
		 	 error_flag="1";
 		   }
		 }
		 
		 if($("#speed_alert_choice").val()!="0"){
		   if(to_addr_speed.length==0){
			  $("#To_address_speed").next(".btn-group").after('<label id="To_address_speed-error" class="error" for="To_address_speed">This field is required.</label>');
			 error_flag="1";
 		  }
		  if(cc_addr_speed.length==0){
			  $("#CC_address_speed").next(".btn-group").after('<label id="CC_address_speed-error" class="error" for="CC_address_speed">This field is required.</label>');
			 error_flag="1";
 		  }
		 }
		 
 		 
		 if(error_flag=="0"){
			  swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the Geoffence alert settings?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
			   }).then(function(willcreate){
				   if(willcreate){
					   
					   var id= $("#alert_settings_id").val();
					   var alert_name=$("#alert_settings_name").val();
					   var geoofence_group=$("#Geoffence_group").val();
					   var vehicle_group=$("#vehicle_group").val();
					   var trigger=$("#trigger").val()!=""?$("#trigger").val():0;
					   if(trigger=="0"){
						    var template_name="";
  					        var to_mail_type="";
					        var cc_mail_type="";
							to_addr=new Array();
							cc_addr=new Array();
					   }else{
						  var template_name=$("#Template").val();
  					      var to_mail_type=$("#to_mail_type").val();
					      var cc_mail_type=$("#cc_mail_type").val();
					   }
					   
 					   var speed_alert=$("#speed_alert_choice").val();
					   if(speed_alert=="0"){
						   var Speed_Template="";
					      var speed_to_type="";
					      var speed_cc_type="";
 					      var speed=0;
						  to_addr_speed=new Array();
						  cc_addr_speed=new Array();
						   
					   }else{
					      var Speed_Template=$("#Speed_Template").val();
					      var speed_to_type=$("#to_mail_type_speed").val();
					      var speed_cc_type=$("#cc_mail_type_speed").val();
 					      var speed=$("#speed").val();
					   }
					   
 					   $.ajax({
						   url: "<?=base_url()?>Defaultmaster/Alert_setting_update", 
						   data:{id:id,alert_name:alert_name,geoofence_group:geoofence_group,speed:speed,trigger:trigger,template_name:template_name,vehicle_group:vehicle_group,to_mail_type:to_mail_type,cc_mail_type:cc_mail_type,geoffence:geoffence,to_addr:to_addr,cc_addr:cc_addr,speed_alert:speed_alert,Speed_Template:Speed_Template,speed_to_type:speed_to_type,speed_cc_type:speed_cc_type,to_addr_speed:to_addr_speed,cc_addr_speed:cc_addr_speed},
						   method: "POST",
						   success: function(result){
							   var data = $.parseJSON(result); 
							   if(data.error_flag=="1"){
								   swal({
										   text: data.message,
										   icon: "error",
										   button: "ok",
									});
							   }else{
								   swal({
										 title: "Success!",
										 text:data.message,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										url=  "<?php echo  base_url(); ?>Defaultmaster?id=4";
						                window.location.href = url;
									 
									}); 
							   }
							    
								
								
						   }
					   });
 				   }
			   });
 		 } else{
			 
			 console.log("occuring some problem");
		 }
	 
 });
 
 
 
 
   $(document).on("click", '#alert_insert', function(event){
	     
		 event.preventDefault();
		  
		 
		 if($("#speed_alert_choice").val()=="0"){
			 $('#trigger').attr('required',true);
		 }else{
			 $('#trigger').attr('required',false);
		 }
		 
		  
 		 var geoffence = [];
		 var to_addr=[];
		 var cc_addr=[];
		 var to_addr_speed=[];
		 var cc_addr_speed=[];
		 var error_flag="0";
		 
         $.each($("#Geoffence_name option:selected"), function(){            
               geoffence.push($(this).val());
         });
		 
		  $.each($("#To_address option:selected"), function(){            
               to_addr.push($(this).val());
         });
		 
		  $.each($("#CC_address option:selected"), function(){            
               cc_addr.push($(this).val());
         });
		 
		 $.each($("#To_address_speed option:selected"), function(){            
               to_addr_speed.push($(this).val());
         });
		 
		  $.each($("#CC_address_speed option:selected"), function(){            
               cc_addr_speed.push($(this).val());
         });
		 
 		 $("#Geoffence-error").remove();
		 $("#To_address-error").remove();
		 $("#CC_address-error").remove();
		 $("#To_address_speed-error").remove();
		 $("#CC_address_speed-error").remove();
		 
 		 if($("#alertsetting_form").valid()){
			  error_flag="0";
		 } else{ 
		      error_flag="1";
		 }
		 
		 
			 
 		 if(geoffence.length==0){
			 
  			 $("#Geoffence_name").next(".btn-group").after('<label id="Geoffence-error" class="error" for="Geoffence_name">This field is required.</label>');
 			 error_flag="1";
 		 }
		 if($("#trigger").val()!="0"){
		   if(to_addr.length==0){
			  $("#To_address").next(".btn-group").after('<label id="To_address-error" class="error" for="To_address">This field is required.</label>');
			 error_flag="1";
 		   }
		   if(cc_addr.length==0){
			  $("#CC_address").next(".btn-group").after('<label id="CC_address-error" class="error" for="CC_address">This field is required.</label>');
		 	 error_flag="1";
 		   }
		 }
		 
		 if($("#speed_alert_choice").val()!="0"){
		   if(to_addr_speed.length==0){
			  $("#To_address_speed").next(".btn-group").after('<label id="To_address_speed-error" class="error" for="To_address_speed">This field is required.</label>');
			 error_flag="1";
 		  }
		  if(cc_addr_speed.length==0){
			  $("#CC_address_speed").next(".btn-group").after('<label id="CC_address_speed-error" class="error" for="CC_address_speed">This field is required.</label>');
			 error_flag="1";
 		  }
		 }
		 
 		 
		 if(error_flag=="0"){
			  swal({
                      title: "Are you sure?",
                      text: "Do you really want to Create the Geoffence alert settings?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
			   }).then(function(willcreate){
				   if(willcreate){
					   var alert_name=$("#alert_settings_name").val();
					   var geoofence_group=$("#Geoffence_group").val();
					   var vehicle_group=$("#vehicle_group").val();
					   var trigger=$("#trigger").val();
					   var template_name=$("#Template").val();
  					   var to_mail_type=$("#to_mail_type").val();
					   var cc_mail_type=$("#cc_mail_type").val();
 					   var speed_alert=$("#speed_alert_choice").val();
					   var Speed_Template=$("#Speed_Template").val();
					   var speed_to_type=$("#to_mail_type_speed").val();
					   var speed_cc_type=$("#cc_mail_type_speed").val();
 					    var speed=$("#speed").val();
					     
 					   $.ajax({
						   url: "<?=base_url()?>Defaultmaster/Alert_setting_insert", 
						   data:{alert_name:alert_name,geoofence_group:geoofence_group,speed:speed,trigger:trigger,template_name:template_name,vehicle_group:vehicle_group,to_mail_type:to_mail_type,cc_mail_type:cc_mail_type,geoffence:geoffence,to_addr:to_addr,cc_addr:cc_addr,speed_alert:speed_alert,Speed_Template:Speed_Template,speed_to_type:speed_to_type,speed_cc_type:speed_cc_type,to_addr_speed:to_addr_speed,cc_addr_speed:cc_addr_speed},
						   method: "POST",
						   success: function(result){
							   var data = $.parseJSON(result); 
							   if(data.error_flag=="1"){
								   swal({
										   text: data.message,
										   icon: "error",
										   button: "ok",
									});
							   }else{
								   swal({
										 title: "Success!",
										 text:data.message,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										url=  "<?php echo  base_url(); ?>Defaultmaster?id=4";
						                window.location.href = url;
									 
									}); 
							   }
							    
								
								
						   }
					   });
 				   }
			   });
 		 } else{
			 
			 console.log("occuring some problem");
		 }
  });
 
  $(document).on("click", '.alert_settings_delete', function(event){
	    id=$(this).attr("data-id");
		 swal({
                      title: "Are you sure?",
                      text: "Do you really want to Delete the Geoffence alert settings?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
		 }).then(function(willcreate){
				   if(willcreate){
					    $.ajax({
						   url: "<?=base_url()?>Defaultmaster/Alert_setting_delete", 
						   data:{id:id},
						   method: "POST",
						   success: function(result){
							    var data = $.parseJSON(result); 
							   if(data.error_flag=="1"){
								   swal({
										   text: data.message,
										   icon: "error",
										   button: "ok",
									});
							   }else{
								   swal({
										 title: "Success!",
										 text:data.message,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										url=  "<?php echo  base_url(); ?>Defaultmaster?id=4";
						                window.location.href = url;
									 
									});
							   }
						   }
						});
 				   }
		 });
		
  }); 
  
  
   $(document).on("click",".email_delete",function(event){
	id=$(this).attr("data-id");
		 swal({
                      title: "Are you sure?",
                      text: "Do you really want to Delete the Email address settings?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
		 }).then(function(willcreate){
				   if(willcreate){
					    $.ajax({
						   url: "<?=base_url()?>Defaultmaster/Email_delete", 
						   data:{id:id},
						   method: "POST",
						   success: function(result){
							    var data = $.parseJSON(result); 
							   if(data.error_flag=="1"){
								   swal({
										   text: data.message,
										   icon: "error",
										   button: "ok",
									});
							   }else{
								   swal({
										 title: "Success!",
										 text:data.message,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										url=  "<?php echo  base_url(); ?>Defaultmaster?id=5";
						                window.location.href = url;
									 
									});
							   }
						   }
						});
 				   }
		 });
		
  }); 
  

  
  
  $(document).on("input", '.email_address', function (event) {
	  
 	 var email=$(this).val();
	 var id=$("#email_data_id").val();
	 var document_id=this.id;
	 
	 console.log("id is "+id);
	  
	 $.ajax({
		 url: "<?=base_url()?>Defaultmaster/mail_check", 
		 data:{id:id,email:email},
		 method: "POST",
		 success: function(result){
 			 var data = $.parseJSON(result); 
			 
			 
			 if(data>0){
  				   $("#"+document_id).after('<label id="emailaddr_1-error" class="error" for="emailaddr_1">Email Name Already exist.</label>');
				  $("#Email_insert").prop("disabled",true);
				  $("#Emailupdate").prop("disabled",true);
				 $(".add_email_addr").prop("disabled",true);
				  
  			 }else{
				   $("#"+document_id+"-error").remove();
 				   $("#Email_insert").prop("disabled",false);
				   $("#Emailupdate").prop("disabled",false);
				    $(".add_email_addr").prop("disabled",false);
			 }
 		 }
			 
	 });
 });
 
 
  
  
  $(document).on("click","#Email_insert",function(event){
	  
	  
	  if($("#Emailform").valid()){
		  
		 var  email_errorflag="0";
		   last_emailaddress=$('#email_address_1').children().last().children().first();
		   
		   
		   if(last_emailaddress.val()!="")
 			   var validation=isEmail(last_emailaddress.val(),last_emailaddress.attr('data-id'));
		   else
			   var validation="";
			
			if(validation!=""){
				 
				   email_errorflag="1";
 				  $(".error").remove();
  				   last_emailaddress.after('<label id="email_address-error" class="error" for="email_address" style="display: block;">'+validation+'.</label>')
			  }
			  
			 
			  if(email_errorflag=="0"){
		  
 		       swal({
                      title: "Are you sure?",
                      text: "Do you really want to Insert the email Address with this details?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
			   }).then(function(willcreate){
				   if(willcreate){
					   
					   var contact_email=[];
					   $(".email_address").each(function() {
						   contact_email.push($(this).val());
  					   });
					   var company_name=$("#com_name").val();
					   var type=$("#Mail_type").val();
					   $.ajax({
						   url: "<?=base_url()?>Defaultmaster/email_insert", 
						   data:{company_name:company_name,type:type,contact_email:contact_email},
						   method: "POST",
						   success: function(result){
						  
							   var data = $.parseJSON(result); 
							   if(data.error_flag=="1"){
								   swal({
										   text: data.message,
										   icon: "error",
										   button: "ok",
									});
							   }else{
								   
								   swal({
										 title: "Success!",
										 text:data.message,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										url=  "<?php echo  base_url(); ?>Defaultmaster?id=5";
						                window.location.href = url;
									});
							   }
						   }
					   });
				   }
			   });   
			   
	  }
	  }
	  
  });
	 

	
	$(document).on("click","#group_insert",function(event){
				
		if($("#geoffenceForm").valid()){
 		       swal({
                      title: "Are you sure?",
                      text: "Do you really want to Create the Geoffence Group Name with this details?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
			   }).then(function(willcreate){
				   if(willcreate){					   
					   var name=$("#group_name").val();
					   var priority=$("#geofence_priority").val();
					   $.ajax({
						   url: "<?=base_url()?>Defaultmaster/groupname_insert", 
						   data:{name:name,priority:priority,status:1},
						   method: "POST",
						   success: function(result){
						  
							   var data = $.parseJSON(result); 
							   if(data.error_flag=="1"){
								   swal({
										   text: data.message,
										   icon: "error",
										   button: "ok",
									});
							   }else{
								   
								   swal({
										 title: "Success!",
										 text:data.message,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										url=  "<?php echo  base_url(); ?>Defaultmaster?id=1";
						                window.location.href = url;
									});
							   }
						   }
					   });
				   }
			   });
		}
	});
	

  // station insert starts

  $(document).on("click", "#station_insert", function (event) {
  if ($("#Stationform").valid()) {
    swal({
      title: "Are you sure?",
      text: "Do you really want to Insert the Station with this details?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then(function (willcreate) {
      if (willcreate) {
        var station_code = $("#station_code").val();
        var station_name = $("#station_name").val();
        $.ajax({
          url: "<?=base_url()?>Defaultmaster/station_insert",
          data: {
            station_code: station_code,
            station_name: station_name,
          },
          method: "POST",
          success: function (result) {
            var data = $.parseJSON(result);
            if (data.error_flag == "1") {
              swal({
                text: data.message,
                icon: "error",
                button: "ok",
              });
            } else {
              swal({
                title: "Success!",
                text: data.message,
                icon: "success",
                button: "ok",
              }).then(function () {
                url = "<?php echo  base_url(); ?>Defaultmaster?id=7";
                window.location.href = url;
              });
            }
          }
        });
      }
    });
  }
});

  // station insert ends


// station edit starts

$(document).on("click", '.edit_station', function (event) {
  setTimeout(function () {
    $('#station_code').focus();
  }, 300);
  id = $(this).attr("data-id");
  $("#station_data_id").val(id);
  $.ajax({
    url: "<?=base_url()?>Defaultmaster/station_selecting",
    data: {
      id: id
    },
    method: "POST",
    success: function (response) {
      var data = $.parseJSON(response);
      if (data.error_flag == "1") {
        swal({
          text: data.message,
          icon: "error",
          button: "ok",
        });
      } else {
        $.each(data.information, function(index, pvalue) {
          $("#"+index).val(pvalue);
        });
        $("#Stationupdate").removeClass("collapse");
        $("#station_insert").addClass("collapse");
      }
    }
  })
})

// station edit ends

// Station Update Starts

$(document).on("click", '#Stationupdate', function (event) {
  if ($("#Stationform").valid()) {
      swal({
        title: "Are you sure?",
        text: "Do you really want to Update the Station data?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willUpdate) => {
        if (willUpdate) {
          var id           = $("#station_data_id").val();
          var station_code = $("#station_code").val();
          var station_name = $("#station_name").val();
          $.ajax({
            url: "<?=base_url()?>/Defaultmaster/station_update",
            data: {
              id: id,
              station_code: station_code,
              station_name: station_name
            },
            method: "POST",
            success: function (result) {
              var data = $.parseJSON(result);
              if (data.error_flag == "1") {
                swal({
                  text: data.message,
                  icon: "error",
                  button: "ok",
                });
              } else {
                swal({
                  title: "Success!",
                  text: data.message,
                  icon: "success",
                  button: "ok",
                }).then(function () {
                  url = "<?php echo  base_url(); ?>Defaultmaster?id=7";
                  window.location.href = url;
                });
              }
            }
          });
        }
      });
  }
});

// Station Update Ends

// Station Delete Starts

$(document).on("click", ".station_delete", function (event) {
  id = $(this).attr("data-id");
  swal({
    title: "Are you sure?",
    text: "Do you really want to Delete the Station Details?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then(function (willcreate) {
    if (willcreate) {
      $.ajax({
        url: "<?=base_url()?>Defaultmaster/Station_delete",
        data: {
          id: id
        },
        method: "POST",
        success: function (result) {
          var data = $.parseJSON(result);
          if (data.error_flag == "1") {
            swal({
              text: data.message,
              icon: "error",
              button: "ok",
            });
          } else {
            swal({
              title: "Success!",
              text: data.message,
              icon: "success",
              button: "ok",
            }).then(function () {
              url = "<?php echo  base_url(); ?>Defaultmaster?id=7";
              window.location.href = url;
            });
          }
        }
      });
    }
  });
});

// Station Delete Ends


// Station Enable Starts

$(document).on("click", ".station_enable", function (event) {
  id = $(this).attr("data-id");
  swal({
    title: "Are you sure?",
    text: "Do you really want to Enable the Station Details?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then(function (willcreate) {
    if (willcreate) {
      $.ajax({
        url: "<?=base_url()?>Defaultmaster/Station_enable",
        data: {
          id: id
        },
        method: "POST",
        success: function (result) {
          var data = $.parseJSON(result);
          if (data.error_flag == "1") {
            swal({
              text: data.message,
              icon: "error",
              button: "ok",
            });
          } else {
            swal({
              title: "Success!",
              text: data.message,
              icon: "success",
              button: "ok",
            }).then(function () {
              url = "<?php echo  base_url(); ?>Defaultmaster?id=7";
              window.location.href = url;
            });
          }
        }
      });
    }
  });
});

// Station Enable Ends

	$(document).on("click", '.edit_email', function (event) {
		 
		 setTimeout(function (){
            $('#com_name').focus();
    	  },300);

		 //document.getElementById('group_name').focus();
   		  id=$(this).attr("data-id");
		  $("#email_data_id").val(id);
		  
   		  $.ajax({
			     url: "<?=base_url()?>Defaultmaster/email_selecting", 
			     data:{id:id},
			      method: "POST",
			     success: function(response){
					  var data = $.parseJSON(response); 
					  if(data.error_flag=="1"){
						   swal({
								   text: data.message,
								   icon: "error",
								   button: "ok",
							});
					  }else{
						  
						   $.each(data.information, function(index, pvalue) {
							   if(index=="emailaddr_1"){
 								     var dataid=1;
								     $("#email_address_1").html("<label>E-mail:</label>");
  									 $("#email_address_1").append('<div id="emailaddrdiv_'+dataid+'"><input type="text" name="email_address" value="'+pvalue+'" data-id="'+dataid+'"  id="emailaddr_'+dataid+'" class="form-control email_address " placeholder="E-mail" style="float:left; width:80%; "></div>');
									 dataid=dataid+1;
 							   }else{
							    $("#"+index).val(pvalue);
							   }
						   });
						   
						    $('.selectpicker').selectpicker('refresh');
 						    $("#Emailupdate").removeClass("collapse");
						    $("#Email_insert").addClass("collapse");
							
						  
					  }
 				 }
		  })
	 })
	
	
	
	 $(document).on("click", '.edit_geoffencegroup', function (event) {
		 
		 setTimeout(function (){
            $('#group_name').focus();
    	  },300);
 
		 //document.getElementById('group_name').focus();
   		  id=$(this).attr("data-id");
		  $("#group_data_id").val(id);
   		  $.ajax({
			     url: "<?=base_url()?>Defaultmaster/selecting", 
			     data:{id:id},
			      method: "POST",
			     success: function(response){
					 
					
					  var data = $.parseJSON(response); 
					  if(data.error_flag=="1"){
						   swal({
								   text: data.message,
								   icon: "error",
								   button: "ok",
							});
					  }else{
						  
						   $.each(data.information, function(index, pvalue) {
							   if(index=="full_priority"){
								  var optionsvalues='<option value="">Select</option>';
 								  $.each(pvalue,function(keyindex, keyvalue){
									 optionsvalues+='<option value="'+keyvalue+'">Priority '+keyvalue+'</option>'
 								  });
                                  $("#geofence_priority").html(optionsvalues).selectpicker('refresh');
							   }
							   else if(index=="priority"){ 
  							    $('#geofence_priority').val(pvalue);
								 $("#geofence_priority").selectpicker("refresh");	
 							   }else{
								   
							    $("#"+index).val(pvalue);
							   }
						   });
						   
 						    $("#group_update").removeClass("collapse");
						    $("#group_insert").addClass("collapse");
						  
					  }
 				 }
		  })
	 })
	 
	 
	 $(document).on("click", '#Emailupdate', function (event) {
		  if($("#Emailform").valid()){
		  
		 var  email_errorflag="0";
		   last_emailaddress=$('#email_address_1').children().last().children().first();
		   
		   
		   if(last_emailaddress.val()!="")
 			   var validation=isEmail(last_emailaddress.val(),last_emailaddress.attr('data-id'));
		   else
			   var validation="";
			
			if(validation!=""){
				 
				   email_errorflag="1";
 				  $(".error").remove();
  				   last_emailaddress.after('<label id="email_address-error" class="error" for="email_address" style="display: block;">'+validation+'.</label>')
			  }
			  
 			  if(email_errorflag=="0"){
		 
 		 
				  swal({
							  title: "Are you sure?",
							  text: "Do you really want to Update the Email data?",
							  icon: "warning",
							  buttons: true,
							  dangerMode: true,
				 }).then((willUpdate) => {
				   if (willUpdate) {
					   
 						  
						var id=$("#email_data_id").val();
 						var contact_email=$(".email_address").val();
 					    var company_name=$("#com_name").val();
					    var type=$("#Mail_type").val();
						 
 						$.ajax({
						  url: "<?=base_url()?>/Defaultmaster/email_update", 
						  data:{id:id,contact_email:contact_email,company_name:company_name,type:type},
						  method: "POST",
						  success: function(result){
							 
							 var data = $.parseJSON(result); 
							 if(data.error_flag=="1"){
								 swal({
										 text: data.message,
										 icon: "error",
										 button: "ok",
								  });
							 }else{
							 
								swal({
									 title: "Success!",
									 text:data.message ,
									 icon: "success",
									 button: "ok",
								}).then(function(){
								   url=  "<?php echo  base_url(); ?>Defaultmaster?id=5";
								   window.location.href = url;
							  });
							 }
						 }
					  });
					  
				   }
				});
			  }
		 }
	 });
	 
	 
	
	 $(document).on("click", '#group_update', function (event) {
		 
		 if($("#geoffenceForm").valid()){
			  
				  swal({
							  title: "Are you sure?",
							  text: "Do you really want to Update the Geoffence Group data?",
							  icon: "warning",
							  buttons: true,
							  dangerMode: true,
				 }).then((willUpdate) => {
				   if (willUpdate) {
					   
 						  
						var id=$("#group_data_id").val();
						
						 var name=$("#group_name").val();
						var priority= $("#geofence_priority").val();
						 					
						$.ajax({
						  url: "<?=base_url()?>/Defaultmaster/groupname_update", 
						  data:{id:id,priority:priority,name:name},
						  method: "POST",
						  success: function(result){
							 
							 var data = $.parseJSON(result); 
							 if(data.error_flag=="1"){
								 swal({
										 text: data.message,
										 icon: "error",
										 button: "ok",
								  });
							 }else{
							 
								swal({
									 title: "Success!",
									 text:data.message ,
									 icon: "success",
									 button: "ok",
								}).then(function(){
								   url=  "<?php echo  base_url(); ?>Defaultmaster?id=1";
								   window.location.href = url;
							  });
							 }
						 }
					  });
					  
				   }
				});
			  
		 }
		 
	 });
	 
	 
	 $(document).on("click", '#delaysetting_update', function(event){
		 
		 event.preventDefault();
		 var group_errorflag="0";
		 var lastto_emailaddress=$('#to_info').children().last().children().first();
		 var lastcc_emailaddress=$('#cc_info').children().last().children().first();
		 
		 
		console.log(lastto_emailaddress.val());
		console.log(lastcc_emailaddress.val());
		
		
		 if(lastto_emailaddress.val()!=""){
 			    var validationto=isEmail(lastto_emailaddress.val(),lastto_emailaddress.attr('data-id'));
		 }else{
			    var validationto="";
		 }
		 
		  if(lastcc_emailaddress.val()!=""){
 			    var validationcc=isEmail(lastcc_emailaddress.val(),lastcc_emailaddress.attr('data-id'));
		 }else{
			    var validationcc="";
		 }
		 
   		 if(validationto!=""){
				   group_errorflag="1";
 				  $(".error").remove();
  				   lastto_emailaddress.after('<label id="email_address-error" class="error" for="email_address" style="display: block;">'+validationto+'.</label>')
		 }
		 if(validationcc!=""){
				   group_errorflag="1";
 				  $(".error").remove();
  				   lastcc_emailaddress.after('<label id="email_address-error" class="error" for="email_address" style="display: block;">'+validationcc+'.</label>')
		 }
			  
		 if(group_errorflag=="0"){
    
			   swal({
						title: "Are you sure?",
						text: "Do you really want to Update the Delay Alert Settings?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
		       }).then((willUpdate) => {
				   
				   
				    var mail_to="";
					var mail_cc="";
					$('input[name=delay_mail_to]').each(function(){
						if($(this).val()!=""){
						  mail_to+=$(this).val()+",";
						}
					});
					$('input[name=delay_mail_cc]').each(function(){
						if($(this).val()!=""){
						  mail_cc+=$(this).val()+",";
						}
					});
					
					if($("#r_status").prop('checked') == true){
						var reminder_status="1";
					}else{
						var reminder_status="0";
					}
					
 					var reminder_min=$("#r_time").val();
					
 					$.ajax({
			        url: "<?=base_url()?>/Defaultmaster/delaysettings_update", 
			        data:{mail_to:mail_to,mail_cc:mail_cc,reminder_status:reminder_status,reminder_min:reminder_min},
			        method: "POST",				   
			        success: function(result){
						 var data = $.parseJSON(result); 
						
						 if(data.error_flag=="1"){
						   swal({
								   text: data.message,
								   icon: "error",
								   button: "ok",
							});
					    }else{
							swal({
								   title: "Success!",
								   text:data.message,
								   icon: "success",
								   button: "ok",
							 });
					    }
					}
						
				 });
					
 			  });
		  }
	});
 
	 function defaultfun(){
		$("#group_name").val("");
		 $("#group_insert").removeClass("collapse");
		 $("#group_update").addClass("collapse");
	}
	 
	 $(document).on("click", '.delete', function(event){
		 
		 defaultfun();
		 id=$(this).attr("data-id");
		 $("#group_data_id").val(id);	
		 swal({
                      title: "Are you sure ?",
                      text: "Do you want to Deactivate Geoffence Group?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
         }).then((willUpdate) => {
			 
			 if(willUpdate){		 
 				$.ajax({
					 url: "<?=base_url()?>/Defaultmaster/group_deactive", 
					 data:{id:id},
					 method: "POST",
					 success: function(result){
						 var data = $.parseJSON(result); 
						 if(data.error_flag=="1"){
							 swal({
									 
									 text: data.message,
									 icon: "error",
									 button: "ok",
							  });
						 } else{
							 swal({
								 title: "Success!",
								 text:"Geoffence Group  Deactivated successfully" ,
								 icon: "success",
								 button: "ok",
							}).then(function(){
 								$("#dlt-clear_"+id).show();
								$("#dlt-add_"+id).hide();
								$("#geoffence_group_status_"+id).html("Deactivated");
 							});
							 
						 }
	                  }
				})
			 
			 }
		 });
	 });
	
	
	
    $(document).on("click", '.delete-clear', function(event){
		
 	     defaultfun();
		 id=$(this).attr("data-id");
		 $("#group_data_id").val(id);
		 swal({
			 	title: "Are you sure?",
				text: "Do you want activate Geoffence Group",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){
					   
						 $.ajax({
							 url: "<?=base_url()?>/Defaultmaster/group_activate",
							 data: {id:id},
							 method: "POST",
							 success: function(result){
							  										
								 var data = $.parseJSON(result); 
								 if(data.error_flag=="1"){
									 swal({
											 text: data.message,
											 icon: "error",
											 button: "ok",
									  });
								 }else{
									 
									 
									swal({
										 title: "Success!",
										 text:"Geoffence Group Activated successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										
										$("#geoffence_group_status_"+id).html("Active");
 										$("#dlt-add_"+id).show();
 										$("#dlt-clear_"+id).hide();
 					  				});								
								 }
							   }
							});						
					}
				});
	 });
	
	
	
	
	
	$(document).on("click", '#mailsetting_update', function(event){
		
		
		 event.preventDefault();
		  //$(".loader").show();
		  $("#loader").css("display", "block");
   	    if($("#mailsettingForm").valid()){
			
			
  	        if(typeof FormData !== 'undefined') {
  			  var formData = new FormData( $("#mailsettingForm")[0] );
 
			  $.ajax({
			       url: "<?=base_url()?>/Defaultmaster/mailsetting_update", 
			       data:formData,
			       method: "POST",
				   async : false,
                   cache : false,
                   contentType : false,
                   processData : false,
			       success: function(result){
					    var data = $.parseJSON(result); 
						$("#loader").css("display", "none");
					    if(data.error_flag=="1"){
						   swal({
								   text: data.message,
								   icon: "error",
								   button: "ok",
							});
					    }else{
							swal({
								   title: "Success!",
								   text:data.message,
								   icon: "success",
								   button: "ok",
							 });
					    }
				   }
			  });
			}
		 }
	});
	
	$(document).on("input", '#name', function (event) {
		mail_template_check(function(name_exist){
			if(!(name_exist>0)){
 			  $("#msg_insert").prop("disabled",false);
			  $("#mailname_error1").addClass("collapse");
			  $("#mailname_error1").removeClass("error");
			  
			}else{
			  $("#mailname_error1").removeClass("collapse");
			  $("#mailname_error1").addClass("error");
 			  $("#msg_insert").prop("disabled",true);
			}
		});
 		
	});
	
	
	
	
	
	
	function mail_template_check(callback){
		
		var name=$("#name").val();
 		 $.ajax({
			
			 url: "<?=base_url()?>/Defaultmaster/mailtemplate_name_check", 
			 data:{name:name},
			 method: "POST",
			 success: function(result){
 				
				var data = $.parseJSON(result); 
				
 			    if(data>0){
   				   $("#mailname_error1").removeClass("collapse");
				   $("#mailname_error1").addClass("error");
				   $("#msg_insert").prop("disabled",true);
   			    }else{
					
				   $("#mailname_error1").addClass("collapse");
				   $("#mailname_error1").removeClass("error");
				   
 			    }
 				 callback(data);
   			 }  
		 });
 	}
 	
	$("#txtEditor").Editor();
	
	$("#msg_insert").click(function(){
		
		 var subject=$("#subject").val();
		 var txtEditor=$(".Editor-editor").html();	
 		
		if(txtEditor==""){
			$("#content-error").removeClass('collapse');
			$("#content-error").addClass('error');
		}else{
		    $("#content-error").removeClass('error');
			$("#content-error").addClass('collapse');
			
   	       if($("#emailForm").valid()){
			   
			    
			   var name=$("#name").val();
			   
 			   mail_template_check(function(name_exist) {
 				   
				   if(!(name_exist>0)){
 					   $.ajax({
						   url: "<?=base_url()?>/Defaultmaster/mail_insert", 
						   data:{subject:subject,txtEditor:txtEditor,name:name},
						   method: "POST",
						   success: function(result){
							   var response = $.parseJSON(result);	
							   
								if(response.error_flag=="1"){
									   swal({
											   text: response.message,
											   icon: "error",
											   button: "ok",
										});
							   }else{ 
 							     $("#template").append($('<option></option>').val(response.id).html(name).attr('selected','selected'))
							   
							   		 
								   swal({
										   title: "Success!",
										   text:response.message,
										   icon: "success",
										   button: "ok",
									}).then(function(){
										 $("#msg_insert").prop("disabled",false);
 
									});
							   }
						   }
						   
						});
 				   }
 			   });
  			    
 		   }
		}
 	 });
	 
	  $("#msg_update").click(function(){
		  
		  var subject=$("#subject").val();
		  var txtEditor=$(".Editor-editor").html();
 		  if(txtEditor==""){
			$("#content-error").removeClass('collapse');
			$("#content-error").addClass('error');
		  }else{
		    $("#content-error").removeClass('error');
			$("#content-error").addClass('collapse');
			
		  
			  if($("#emailForm").valid()){
			   	
			   var id=$("#template").val();
			   var name=$("#name").val();
	   
					 $.ajax({
						 url: "<?=base_url()?>Defaultmaster/mail_update", 
						 data:{id:id,subject:subject,txtEditor:txtEditor,name:name},
						 method: "POST",
						 success: function(result){	
						 var response = $.parseJSON(result);
							  if(response.error_flag=="1"){
									 swal({
											 text: response.message,
											 icon: "error",
											 button: "ok",
									  });
							 }else{ 		 
								 swal({
										 title: "Success!",
										 text:response.message,
										 icon: "success",
										 button: "ok",
								  }).then(function(){
									   url=  "<?php echo  base_url(); ?>Defaultmaster?id=3";
										window.location.href = url;
								  });
							 }
						 }
					  });
 		       }
		   }
	  });
	 
 
	 
	 
	 $(document).on("click","#msg_delete",function(event){
	      
		 swal({
                      title: "Are you sure?",
                      text: "Do you really want to Delete the Email address settings?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
		 }).then(function(willcreate){
				   if(willcreate){
					   var id=$("#template").val();
					   
					    $.ajax({
						   url: "<?=base_url()?>Defaultmaster/Template_delete", 
						   data:{id:id},
						   method: "POST",
						   success: function(result){
							    var data = $.parseJSON(result); 
							   if(data.error_flag=="1"){
								   swal({
										   text: data.message,
										   icon: "error",
										   button: "ok",
									});
							   }else{
								   swal({
										 title: "Success!",
										 text:data.message,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										url=  "<?php echo  base_url(); ?>Defaultmaster?id=3";
						                window.location.href = url;
									 
									});
							   }
						   }
						});
 				   }
		 });
		
  }); 
	 
	 $("#template").change(function(){
		 var id=$(this).val();
		 
		 if(id==""){
			 $("#subject").val("");
			 $(".Editor-editor").html("");
			 $("#msg_insert").removeClass('collapse');
			 $("#msg_update").addClass('collapse');
			 $("#msg_delete").addClass('collapse');
		 }else{
			 
			 //$("#msg_insert").addClass('collapse');
			 $("#msg_update").removeClass('collapse');
			 $("#msg_delete").removeClass('collapse');
			 
			 $.ajax({
				 url: "<?=base_url()?>/Defaultmaster/show_template", 
				 data:{id:id},
				 method: "POST",
				 success: function(result){	
 					 var response = $.parseJSON(result);
 					 if(response.error_flag=="1"){
							 swal({
									 text: response.message,
									 icon: "error",
									 button: "ok",
							  });
					 }else{ 
					  
					    $("#name").val(response.name);
					    $("#subject").val(response.subject);
						$(".Editor-editor").html(response.message);
					 }
  				 }
	         });
		 }
 		 
	 });
	
	
	
});
 </script>
</body>
</html>
