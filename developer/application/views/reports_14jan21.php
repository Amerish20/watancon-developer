<style>
	body{background:white}
   .play_stop, #MapType ,.geoffence_show, .geoffence_show2{
   position:absolute;
   bottom:6%;
   right:10%;
   }
   .geoffence_show, .geoffence_show2{right:3%;}
   /*search box update*/
   .playback-icon-focus, .playback-icon-focus-clear {position:absolute;
    right: 5.3rem;
    top: 1.5rem;}
   /*search box update*/
   .play_stop{
	   z-index: 1;
   }
   .play_stop .btn-custom{color:#333;}
   .play_stop .btn-custom:hover{color:#777;}
   #MapType{left:42.5%;}
   #FleetDialog{max-width:none!important}
   .fleets_search_data{display:none}
   .loader {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1020;
    background-color: rgba(255,255,255,.7);
    width: 100%;
    height: 100%;
}
.panel-default{border-color: #88a3ba;}
#alert_type fieldset label{font-weight:normal; display:inline-block; padding-left:3px}
table{ box-sizing:content-box; -moz-box-sizing:content-box;}
table.dataTable{height:auto; max-height:400px!important; overflow:auto}
div.dataTables_wrapper div.dataTables_processing{padding-top: 7px;}

.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {border: 1px solid #b6b6b6;}
thead tr.header{background: #3b5998; font-weight: bold; color: white;}

.tab-header{margin-top:0; text-align:center; height:50px; width:98%; border-bottom-color:#f1f1f1; font-size: 1.2em; color:#337ab7}
.sub-head{color:#444; font-size:.8em; margin-top:3px}
.fleets_search_data .title{font-weight:normal}
.DTFC_LeftHeadWrapper table {
    margin-bottom: 0!important;
}
.DTFC_LeftBodyLiner table {
    margin: 0!important;
}

.split_time{}
.bs-caret{float:right; padding-right:10px; color:#3c3cb2}
.node .bs-caret{padding-top:3px}
.active .bs-caret{color:#fff}
.xeno-tree span.title{vertical-align: text-top; line-height: 7px;}
.dataTable tbody td{font-size:.82em!important; font-family:Arial, Helvetica, sans-serif; font-weight:bolder}
.card-body{background-image: url('../lib/images/watermark.png');
  background-repeat: no-repeat;
  background-size: 450px 209px;
  background-position: center; animation-name: fadeIn;
    animation-iteration-count: 1;
    animation-timing-function: ease-in-out;
    animation-duration: 3s;
    animation-fill-mode:forwards;}
	
	::-webkit-scrollbar-track
	{
		box-shadow: inset 0 0 10px olivedrab;
border-radius: 10px;
	}
	
	::-webkit-scrollbar
	{
		width: 11px; height: 11px;
	background-color: #F5F5F5;
	}
	
	::-webkit-scrollbar-thumb
	{
		border-radius: 10px;
background: rgba(51,122,183,.5);
box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
	}
	.responsive-width{width:100%!important}
	.pdng-right{padding-right:10px!important}
	.min-height{height:99vh}
	.disp_block{display:block!important}
	.multiselect-container li a label{text-transform: lowercase; margin-top:2%!important}
	.multiselect-container li a label::first-letter{text-transform: uppercase;}
	li.multiselect-item.multiselect-group.multiselect-group-clickable{border-bottom: 1px solid #8bb0c8; }
	.multiselect-group-clickable a{padding-right:10px!important}
  .multiselect-group a b{color:#506e72; font-size:.9em; }
	.geoffence_multi_select .active a b{color:white}
	.geoffence_multi_select{display:none; margin-bottom:10px}
  .geoffence_multi_select_exclude .active a b{color:white}
  .geoffence_multi_select_exclude{display:none; margin-bottom:10px}
	.multiselect-mainhead{width:100%; display:inline-block; vertical-align:text-bottom; padding-left:5px}
	.multiselect-group-clickable b.caret{margin-top:3%; float:right; }

/* geoffence_show update */

#draggable.menu, #draggable2.menu{position:static; width: 100%;
    background: #3b5998;
    padding: 10px;
    color: #fff;
    font-size: 1em;
    border-radius: 5px;
    min-height: 32px;
    font-weight: bold;
    margin-bottom: 14px;}
  #div_table, #div_table2{width:280px; bottom:unset!important; min-height:10px; right: 2.5%;}
  .xeno-tree .min-max-geo ul li span.title{line-height:1.1}
  .xeno-tree #draggable a{padding:0}
  .xeno-tree .min-max-geo .geoffencegroups_data div.node, .xeno-tree .min-max-geo div.node{
    border-radius: 0px; border:none;
    cursor: pointer;
    white-space: nowrap;
    background-color: #b8dafc;
    color: #333;
    border-bottom: 1px solid #f5f5f5;
    padding: 2px 6px;
}
.xeno-tree .min-max-geo div.node{background-color: #fff;}

/* geoffence_show update */


  @keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
   @media(min-height:768px){
.dialog {
    width: auto;
     min-height: 0; 
}
   }
 @media print {
  .sidebar-toggle { display: none !important; } 
}

.zindexzero
{
  z-index: 0 !important;
}


 
</style>
<script></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
<link rel="stylesheet" href="<?=base_url()?>lib/css/button.css" />
<link rel="stylesheet" href="<?=base_url()?>lib/css/full-screen-helper.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css" />
<div id="table_container" >
 
 <!-- geoffence_show modal starts -->
 
  <div id="myModal" class="modal fade" role="dialog" style="z-index: 100000;">

  <div class="modal-dialog" style="width:90%">
    <div class="modal-content ">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">×</button>
            <h4 class="modal-title">Geofence to Geofence Tracking</h4>
      </div>
        
      <div class="modal-body drag-area" style="height:83vh">
         <div id="map1" class="col-md-12" style="height:81vh"></div>
            <div class="geoffence_show2" title="Show Geofence">
               <span class="btn btn-custom mybutton "><i class="fa fa-map-o"></i> </span>
            </div>
            <div id="MapType" class="btn-group pull-left" data-toggle="buttons" style="bottom:3%" >
                <label class="btn btn-custom active" >
                    <input type="radio" class="Road" id="Road" value="Road" name="satelite_type" autocomplete="off" checked> Road
                </label>
                <label class="btn btn-custom">
                 <input type="radio" class="Satellite" id="Satellite" name="satelite_type" value="Satellite" autocomplete="off"> Satellite
                </label>
           </div>

          <div id="div_table2" class="divtable dark-shadow xeno-tree" style="display:none;">
       <div id="draggable2" class="menu blue-shadow ui-widget-content" > Geofences
            <a><i class="glyphicon glyphicon-remove" id="close_geoffence"></i></a>
            <a title="Minimize/Maximize" class='switch-icons-geo min-max-icon'>-</a>
            <a><i class="glyphicon glyphicon-refresh" id="geoffence_refresh"></i></a>            
            <a><i class="glyphicon glyphicon-filter geoffence_search"></i></a></div>
            <div class="filter input-group" id="geoffence_search" style="display:none;  max-width:255px;">
              <input type="text" id="geoffenceInput" class="form-control geoffenceInput " autocomplete="off">
              <a title="Filter" class="btn input-group-addon glyphicon glyphicon-search"></a>
              <a title="Close" class="btn input-group-addon glyphicon glyphicon-remove geoffencesearch_remove"></a>
            </div>
        <div class="min-max-geo">
        <div style="max-height:220px; font-size:.74em" class="scrollbar" id="style-2">
         <?php foreach($geoffence_data as $geoffencegroupid=>$geoffencegroupdata){?>
        <li class="geoffencegroups_data" data-id="geoffence_<?=$geoffencegroupid?>" >
         <div class="node inactive">
          <input type="checkbox" class="geoffencegrouplist" id="geoffencegroup_<?=$geoffencegroupid?>" style="z-index:100000;border:1px solid red;">
          <span class="title"><i></i><b><?=strtoupper($geoffencegroupdata['group_name'])?></b></span>
           <span class="template"></span>
         </div>
        </li>
         <ul class="geoffence_search_data" style="padding-left: 0px; display:none" id="geoffencecontainer<?=$geoffencegroupid?>" >
          <li style="overflow-y:hidden; " class="scrollbar" id="ountergroupcont_<?=$geoffencegroupid?>">
          <?php 
           foreach($geoffencegroupdata as $geoffencekey=>$geoffencedata){
         
       if($geoffencekey!="group_name" && $geoffencedata['description']!=""){
         ?>
            <div class="node inactive disabled" style="float:left; clear:both; width:100%">
             <div class="checkbox">
                                <label >
              <input type="checkbox" class="geoffence  childgeoffencegroup_<?=$geoffencegroupid?>" id="geoffenceid_<?=$geoffencekey?>" >
              <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
              <span class="title scrollbar" id="style-1" style="max-width:198px"><i></i><?=$geoffencedata['description']?></span>
              </label>
              </div>
              <span class="template pull-right">
               
                  <a id="locate_<?=$geoffencekey?>" class="btn btn-default template geoffence_focus" title="" data-placement="left" data-toggle="tooltip" data-original-title="Locate">
                      <i class="fa fa-search"></i>
                 </a>
                 
              </span>
             </div>
             <?php }
       }?>
        </li>
        </ul>
       <?php 
        
    }?>
              
          
              </div>
            </div>
        </div>
      
      </div>
      <div class="loader" style="top: 0px; left: 0px; display: none; z-index:99999999;"><img src="<?=base_url()?>lib/images/loader.gif"></div>
    </div>  
  </div>
</div>

<!--  geoffence_show modal ends -->
   
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-3 custom-padding">
            <div class="report-sidebar dark-shadow">
               <form class="cmxform" enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="commentForm"  method="post" action="">
                  <div  class="form-group">
                     <label>Report Type</label>
                     <select name="Report"  id="Report" class="selectpicker form-control" data-live-search="true" required>
                        <option value="select"> Select Report Type</option>
                        <?php foreach($reports_list as $reports_key=>$reports_data){ ?>
                        <option value="<?=$reports_data['id']?>"><?=$reports_data['report_name']?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group" id="alert_type" style="display:none;">
                  
                     <label>Alert Type</label> 
                     <fieldset>
                     <label for="hash_breaking">
                     <input type="checkbox" name="alert_field"  id="hash_breaking"> Hash breaking
                     </label>
                     <label for="high_acceleration">
                     <input type="checkbox" name="alert_field" id="high_acceleration"> High Acceleration
                     </label>
                     <label for="geoffence" style="font-weight:normal">
                     <input type="checkbox" name="alert_field" id="geoffence"> Geofence
                     </label><br />
                     </fieldset>
                     <label id="alert_field-error" class="error1" style="display:none">Choose at least one option From Alert Type</label>
                  </div>
                  <div class="geoffence_multi_select">
                  <label> Geofence</label>
                  <?php /*print "<pre>"; print_r($geoffence_data);
					die();*/ ?>
                  <select name="Geoffence_name" class="form-control-sm" multiple id="Geoffence_name" data-live-search="true" required>
                  <!--<option value="">select Geoffence</option> -->
                  	<?php 
					
					
					foreach($geoffence_data as $geoffencegroupid=>$geoffencegroupdata){?>
						<optgroup value="<?=$geoffencegroupid?>" label="<?=strtoupper($geoffencegroupdata['group_name'])?>">
                        	<?php 
							 foreach($geoffencegroupdata as $geoffencekey=>$geoffencedata){
								 if($geoffencekey!="group_name"){
								   ?>
                                   <option value="<?=$geoffencekey?>"><?=strtoupper($geoffencedata['description'])?></option>
                                   <?php }
			 						}?>
                                    </optgroup>
						<?php }?>
                          
                        </select>
                  </div>

                  <!-- exclude geofence -->

                  <div class="geoffence_multi_select_exclude" id="geoffence_multi_select_exclude">
                    <label> Exclude Geofence</label>
                    <select name="Geoffence_name_exclude" class="form-control-sm" multiple id="Geoffence_name_exclude" data-live-search="true" required>
                      <?php 
                    foreach($geoffence_data as $geoffencegroupid=>$geoffencegroupdata){?>
                      <optgroup value="<?=$geoffencegroupid?>" label="<?=strtoupper($geoffencegroupdata['group_name'])?>">
                          <?php 
                         foreach($geoffencegroupdata as $geoffencekey=>$geoffencedata){
                           if($geoffencekey!="group_name"){
                             ?>
                                   <option value="<?=$geoffencekey?>"><?=strtoupper($geoffencedata['description'])?></option>
                                   <?php }
                              }?>
                                    </optgroup>
                      <?php }?>
                          
                        </select>
                    </div>

                  <!-- exclude geofence -->


                  <div class="form-group" id="bulk_vehicle">
                     <label style="float:left; margin-top:1%">Vehicle list</label>
                          <label class="checkbox inline" style="float:right; margin-top:1%; color:#3b5998; font-weight:normal">
                              <input type="checkbox" id="select_all">Select All
                          </label>
                              
                              <div style="clear:both"></div>
                     <div id="FleetDialog" class="panel panel-default dialog " style="position:static; margin-bottom:0">
                        <div>
                           <div id="FleetTree" class="xeno-tree">
                              <div class="vehicle_menu" style="cursor:pointer; ">
                                 <div class="btn-group bootstrap-select form-control">
                                 <input type="text" id="myInput" class="form-control" placeholder="Search vehicle here..." autocomplete="off">
                                    <!--<div  class="btn dropdown-toggle btn-default" title="select Report Type" style="width: 100%;">
                                       <span class="filter-option pull-left"> select Vehicle</span>&nbsp;
                                       <span class="bs-caret">
                                       <span class="caret"></span>
                                       </span>
                                       
                                    </div>-->
                                 </div>
                              </div>
                              
                              <div id="group_list" style="display:none; z-index:1000">
                                 <?php
                                    if(!empty($vehicle_data)){
                                    
                                     foreach($vehicle_data as $vehiclegroupid=>$vehiclegroupdata){?>
                                 <li class="groups_data" data-id="<?=$vehiclegroupid?>" >
                                    <div class="node inactive">
                                       <input type="checkbox" class="grouplist" id="<?=$vehiclegroupid?>"><span class="title"><i></i><b><?=strtoupper($vehiclegroupdata['group_name'])?></b></span>
                                       <span class="bs-caret">
                                       <span class="caret"></span>
                                       </span>
                                    </div>
                                 </li>
                                 <ul class="fleets_search_data" id="vehiclecontainer<?=$vehiclegroupid?>">
                                    <li>
                                       <?php 
                                          foreach($vehiclegroupdata as $vehiclekey=>$vehicledata){
                                          if($vehiclekey!="group_name" && $vehicledata['description']!=""){
                                          ?>
                                       <div class="node inactive disabled">
                                          <span class="fa fa-automobile" style="font-size: 1.6em"></span>
                                          <input type="checkbox" class="vehiclelist child<?=$vehiclegroupid?>"  name="vehicle[<?=$vehiclekey?>]"id="vehicleid_<?=$vehiclekey?>" value="<?=$vehiclekey?>" > 
                                          <label class="title" for="vehicleid_<?=$vehiclekey?>"><i></i><?=$vehicledata['description']?></label>
                                       </div>
                                       <?php }
                                          }?>
                                    </li>
                                 </ul>
                                 <?php 
                                    }
                                     }?>
                              </div>
                           </div>
                        </div>
                       
                     </div>
                      <label id="bulk_vehicle_error" class="error1" style="display:none" >This field is required</label>
                  </div>
                  <!-- report update starts -->
                  <div class="geoffence_single_select_from" id="geoffence_single_select_from" style="display:none;">
                  <label> Geofence From</label>
                        
                  <select name="Geoffence_From" class="selectpicker form-control Geoffence_select_option" id="Geoffence_From" data-live-search="true" required>
                  <option value="">select Geoffence From</option> 
                    <?php 
          foreach($geoffence_data as $geoffencegroupid=>$geoffencegroupdata){?>
                          <?php 
               foreach($geoffencegroupdata as $geoffencekey=>$geoffencedata){
                 if($geoffencekey!="group_name"){
                   ?>
                                   <option value="<?=$geoffencekey?>"><?=strtoupper($geoffencedata['description'])?></option>
                                   <?php }
                  }}?>
                        </select>
                  </div>
                  <div class="geoffence_single_select_to" id="geoffence_single_select_to" style="display:none;">
                  <label> Geofence To</label>
                        
                  <select name="Geoffence_To" class="selectpicker form-control Geoffence_select_option" id="Geoffence_To" data-live-search="true" required>
                  <option value="">select Geoffence To</option> 
                    <?php 
          foreach($geoffence_data as $geoffencegroupid=>$geoffencegroupdata){?>
                          <?php 
               foreach($geoffencegroupdata as $geoffencekey=>$geoffencedata){
                 if($geoffencekey!="group_name"){
                   ?>
                                   <option value="<?=$geoffencekey?>"><?=strtoupper($geoffencedata['description'])?></option>
                                   <?php }
                  }}?>
                        </select>
                  </div>
                  <!-- report update ends -->
                  <div class="form-group" id="speed_alert_select" style="display:none;">
                     <label>Speed</label>
                     <select name="vehicle"  id="speed_alert_data" class="selectpicker form-control 60-200" data-live-search="true" required>
                        <option value="select"> select</option>
                        
                     </select>
                  </div>
                  <div class="form-group" id="single_vehicle" style="display:none;">
                     <label>Vehicle</label>
                     <select name="vehicle" id="vehiclesingle_data" class="selectpicker form-control" data-live-search="true" required>
                        <option value="select"> select</option>
                        <?php foreach($vehicle_fulldata as $vehicle_key=>$vehicle_data){?>
                        <option value="<?=$vehicle_data['id']?>"><?=$vehicle_data['description']?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group" id="stop_duration_div" style="display:none;">
                     <label for="StartDate">Exceed idle duration (In Minutes)</label>
                     <!--<input type='text' id="stop_duration" name="stop_duration" class="form-control" />-->
                     <select name="stop_duration"  id="stop_duration" class="selectpicker form-control 30-210" data-live-search="true" >
                        <option value=""> select</option>
                        
                     </select>
                     
                  </div>
                  
                  <div class="form-group" id="delay_duration_div" style="display:none;">
                     <label for="delay_duration">Delay duration (In Minutes)</label>
                     <!--<input type='text' id="stop_duration" name="stop_duration" class="form-control" />-->
                     <input name="delay_duration"  id="delay_duration" class="form-control" >
                  </div>
                  
                  <div class="form-group" id="starting-date">
                     <label for="StartDate">Start Date</label>
                     <div class='input-group date' id="datetimepicker1" >
                        <input type='text' id='start_date' name='start_date' class="form-control" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                     </div>
                  </div>
                  <div class="form-group" id="ending-date">
                     <label for="EndDate">End Date</label>
                     <div class='input-group date' id="datetimepicker2" >
                        <input type='text' id='end_date' name='end_date' class="form-control" required >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                     </div>
                  </div>
                  <input type="submit" class="btn btn-primary" id="submit" value="Generate">
                  <input type="button" class="btn btn-primary" id="refresh" value="Refresh">
               </form>
            </div>
         </div>
         <div class="col-md-9 custom-padding2">
            <div class="report-view-area" id="report-view-area">
               <div class="card dark-shadow" style="min-height:87vh">
                  <div class="card-body" id="expand_area">
                   <div style="cursor:pointer; position: absolute; z-index: 1; right: 1.8rem; top: 1.5rem;"><i class="fa fa-expand r"></i></div>
                  <div class="loader" style=" display: none;"><img src="<?=base_url()?>lib/images/loader.gif" ></div>
                     <div  id="exeed_idle_div" style="display:none;">
                      <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Exceed Idle Report <div class="sub-head">For The Period : <span id="exeed_idle_time_period"></span></div></div>
                      
                        <div class="scrollbar" id="style-2">
                           <table id="exeed_idle" class="table table-striped table-bordered display nowrap" width="100%" >
                              <thead style="display: table-header-group;">
                                 <tr class="header">                                 
                                    <th>Asset Code</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Idle Duration</th>
                                    <th>Actual start date</th>
                                    <th>Actual End date</th>
                                    <th>Lattitude</th>
                                    <th>Lognitude</th>
                                    <th>Geofence</th>
                                    <th>Track</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     
                     <div  id="Main_summary_div" style="display:none;" >
                     <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Main Report <div class="sub-head">For The Period : <span id="Main_summary_time_period"></span></div></div>
                     
                        <div class="scrollbar" id="style-2">
                           <table id="Main_summary" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                   <th>Asset Code</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Current Odometer</th>
                                    <th>Total Odometer</th>
                                    <th>Working Duration</th>
                                    <th>Stopped Duration</th>
                                    <th>Idle Time</th>
                                    <th>Running Time</th>
                                    <th>Ignition On(No)</th>
                                    <th>Ignition off(No)</th>
                                    <th>Pluged(No)</th>
                                    <th>Unpluged(No)</th>
                                    <th>Device Status</th>
                                    <th>Last Data</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div  id="map_history"  >
                        <div id="map" class="col-md-12" style="height:82vh">
                        
                        </div>
                        
                         <div id="MapType" class="btn-group pull-left" data-toggle="buttons" >
    <label class="btn btn-custom active" >
        <input type="radio" class="Road" id="Road" value="Road" name="satelite_type" autocomplete="off" checked> Road
    </label>
    <label class="btn btn-custom">
        <input type="radio" class="Satellite" id="Satellite" name="satelite_type" value="Satellite" autocomplete="off"> Satellite
    </label>
</div>
                        
                     </div>
                     
                     <div  id="alert_type_report_div" style="display:none;">
                     <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Alert Report <div class="sub-head">For The Period : <span id="alert_type_time_period"></span></div></div>
                     
                        <div class="scrollbar" id="style-2">
                           <table id="alert_type_report" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Asset Code</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Alert Type</th>
                                    <th>Time</th>
                                    <th>Geoffence</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     
                     
                     <div id="Maintatnce_div" style="display:none;">
                     <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Maintanance Report <div class="sub-head">For The Period : <span id="maintanance_time_period"></span></div></div>
                      
                        <div class="scrollbar" id="style-2">
                           <table id="maintanance_table" class="table table-striped table-bordered display nowrap" width="100%" >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Asset Code</th>
                                    <th>Description</th>
                                    <th>Last oil changed KM</th>
                                    <th>Last oil Changed Date</th>
                                    <th>Reason</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div id="full_summary_div" style="display:none;">
                     <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Full Summary Report <div class="sub-head">For The Period : <span id="full_summary_time_period"></span></div></div>
                      
                        <div class="scrollbar" id="style-2">
                           <table id="full_summary" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Asset Code</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Actual start date</th>
                                    <th>Actual End date</th>
                                    <th>Total Duration</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div  id="unplug_report_div" style="display:none;" >
                     <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Unplug Report <div class="sub-head">For The Period : <span id="unplug_time_period"></span></div></div>
                        
                        <div class="scrollbar" id="style-2">
                           <table id="unplug_report" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Asset Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Total Duration</th>                                    
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     
                    <div id="map_playback">
                      <div id="newmap" class="col-md-12" style="height:82vh">        	
                      </div>
                      <!-- search button starts -->
                      <div class="playback-icon-focus" title="Follow Vehicle" style="display:none">
                        <span class="btn btn-custom mybutton "> <i class="fa fa-search"></i></span>
                      </div>
                      <div class="playback-icon-focus-clear" title="UnFollow Vehicle" style="display:none">
                        <span class="btn btn-custom mybutton "> <i class="fa fa-stop-circle"></i></span>
                      </div>
                      <!-- search button ends -->
                      <div id="play_stop" class="play_stop">
                        <span id="history_backward" class="btn btn-custom mybutton">
                          <i class="fa fa-backward"></i>
                        </span>
                        <span id="history_play" class="btn btn-custom mybutton">
                          <i class="fa fa-play"></i>
                        </span>
                        <span id="history_pause" class="btn btn-custom mybutton" style="display:none;">
                          <i class="fa fa-pause"></i>
                        </span>
                        <span id="history_forward" class="btn btn-custom mybutton">
                          <i class="fa fa-forward"></i>
                        </span>
                        <span id="history_stop" class="btn btn-custom mybutton"> 
                          <i class="fa fa-stop"></i>
                        </span>
                      </div>
                      
                      <!-- geoffence_show update starts  -->
                      <div class="geoffence_show" title="Show Geofence">
                        <span class="btn btn-custom mybutton "><i class="fa fa-map-o"></i></span>
                      </div>
                      <!-- geoffence_show update ends  -->

                      <div id="MapType" class="btn-group pull-left" data-toggle="buttons" >
                        <label class="btn btn-custom active" >
                        <input type="radio" class="Road" id="Road" value="Road" name="satelite_type" autocomplete="off" checked> Road
                        </label>
                        <label class="btn btn-custom">
                        <input type="radio" class="Satellite" id="Satellite" name="satelite_type" value="Satellite" autocomplete="off"> Satellite
                        </label>
                      </div>

  <div id="div_table" class="divtable dark-shadow xeno-tree" style="display:none;">
          <div id="draggable" class="menu blue-shadow ui-widget-content" > Geofences
            <a><i class="glyphicon glyphicon-remove" id="close_geoffence"></i></a>
            <a title="Minimize/Maximize" class='switch-icons-geo min-max-icon'>-</a>
            <a><i class="glyphicon glyphicon-refresh" id="geoffence_refresh"></i></a>            
            <a><i class="glyphicon glyphicon-filter geoffence_search"></i></a></div>
            <div class="filter input-group" id="geoffence_search" style="display:none;  max-width:255px;">
              <input type="text" id="geoffenceInput" class="form-control" autocomplete="off">
              <a title="Filter" class="btn input-group-addon glyphicon glyphicon-search"></a>
              <a title="Close" class="btn input-group-addon glyphicon glyphicon-remove geoffencesearch_remove"></a>
            </div>
        <div class="min-max-geo">
        <div style="max-height:220px; font-size:.74em" class="scrollbar" id="style-2">
         <?php foreach($geoffence_data as $geoffencegroupid=>$geoffencegroupdata){?>
        <li class="geoffencegroups_data" data-id="geoffence_<?=$geoffencegroupid?>" >
         <div class="node inactive">
          <input type="checkbox" class="geoffencegrouplist" id="geoffencegroup_<?=$geoffencegroupid?>" style="z-index:100000;border:1px solid red;">
          <span class="title"><i></i><b><?=strtoupper($geoffencegroupdata['group_name'])?></b></span>
           <span class="template"></span>
         </div>
        </li>
         <ul class="geoffence_search_data" style="padding-left: 0px; display:none" id="geoffencecontainer<?=$geoffencegroupid?>" >
          <li style="overflow-y:hidden; " class="scrollbar" id="ountergroupcont_<?=$geoffencegroupid?>">
          <?php 
           foreach($geoffencegroupdata as $geoffencekey=>$geoffencedata){
         
       if($geoffencekey!="group_name" && $geoffencedata['description']!=""){
         ?>
            <div class="node inactive disabled" style="float:left; clear:both; width:100%">
             <div class="checkbox">
                                <label >
              <input type="checkbox" class="geoffence  childgeoffencegroup_<?=$geoffencegroupid?>" id="geoffenceid_<?=$geoffencekey?>" >
              <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
              <span class="title scrollbar" id="style-1" style="max-width:198px"><i></i><?=$geoffencedata['description']?></span>
              </label>
              </div>
              <span class="template pull-right">
               
                  <a id="locate_<?=$geoffencekey?>" class="btn btn-default template geoffence_focus" title="" data-placement="left" data-toggle="tooltip" data-original-title="Locate">
                      <i class="fa fa-search"></i>
                 </a>
                 
              </span>
             </div>
             <?php }
       }?>
        </li>
        </ul>
       <?php 
        
    }?>
          <div class="loaders" style="top: 0px; left: 0px; display: none;"><img src="<?=base_url()?>lib/images/loader.gif"></div>
         </div>
     </div>
     
    </div>
                       </div>


                    

                     <div  id="delay_report_div" style="display:none;" >
                     <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Delay Report <div class="sub-head">For The Period : <span id="delay_time_period"></span></div></div>
                        
                        <div class="scrollbar" id="style-2">
                           <table id="delay_report" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                 	<th>ID</th>
                                    <th>Asset Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Lattitude</th>
                                    <th>Lognitude</th>
                                    <th>Device Time</th> 
                                    <th>Server Time</th>              
                                    <th>Time Difference</th>                                    
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                      <div  id="database_full_report_div" style="display:none;" >
                      <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Database Full  Report <div class="sub-head">For The Period : <span id="database_full_time_period"></span></div></div>
                        
                        <div class="scrollbar" id="style-2">
                           <table id="database_full_report" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <td>Id</td>
                                   <td>Vehicle</td>
                                   <td>Device Timestamp</td>
                                   <td>GPS Time</td>
                                   <td>Lattitude</td>
                                   <td>Lognitude</td>
                                   <td>Speed</td>
                                   <td>Ign_status</td>
                                   <td>Idling</td>
                                   <td>External_power</td>
                                   <td>Battery_power</td>
                                   <td>Generated_event</td>
                                   <td>Generated_event_value</td>
                                   <td>Satellite</td>
                                   <td>Movement</td>
                                   <td>Manual_odometer</td>
                                   <td>Odometer</td> 
                                    <td>Acceleration</td>
                                   <td>Hash_breaking</td>
                                   <td>Un Pluged</td>
                                   <td>Heading</td>
                                   <td>Altitude</td>
                                   <td>Created</td>
                                    <td>Server and device time difference</td>                                 
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div  id="duplicate_entry_report_div" style="display:none;" >
                     	<div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Duplicate Entry  Report <div class="sub-head">For The Period : <span id="duplicate_entry_time_period"></span></div></div>
                                             
                        <div class="scrollbar" id="style-2">
                           <table id="duplicate_entry_report" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                 	<th>ID</th>
                                    <th>Asset Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Event ID</th> 
                                    <th>Event Value</th> 
                                    <th>Device Time</th>
                                    <th>Device Time Stamp</th>  
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div  id="wrong_data_report_div" style="display:none;" >
                     <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Wrong Data Report <div class="sub-head">For The Period : <span id="wrong_data_time_period"></span></div></div>
                     
                        <div class="scrollbar" id="style-2">
                           <table id="wrong_data" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                 	<th>ID</th>
                                    <th>Asset Code</th>
                                    <th>Vehicle</th>
                                    <th>Description</th>
                                    <th>Device Timestamp</th>
                                    <th>GPS Time</th>
                                    <th>Lattitude</th>
                                    <th>Lognitude</th>
                                    <th>Speed</th>
                                    <th>Odometer</th>
                                    <th>Ign_status</th>
                                    <th>Acceleration</th>
                                    <th>Hash_breaking</th>
                                    <th>Un Pluged</th> 
                                    <th>Heading</th>
                                    <th>Altitude</th>
                                    <th>Created</th>      
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- report update starts -->
                     <div id="geofence_report_div" style="display:none;" >
                      <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Geofence To Geoffence Report <div class="sub-head">For The Period : <span id="geoffencetogeoffence_time_period"></span></div></div>
                        
                        <div class="scrollbar" id="style-2">
                           <table id="geofencetogeoffence_report" class="table table-striped table-bordered display nowrap" width="100%">
                              <thead style="display: table-header-group;">
                              <tr class="header">
                                <th rowspan="2">Asset Code</th>
                                <th rowspan="2">Description</th>
                                <th colspan="3" id="from_geoffence"></th>
                                <th rowspan="2">Travel Duration</th>
                                <th rowspan="2">Distance(KM)</th>
                                <th colspan="3" id="to_geoffence"></th>
                                <th rowspan="2">Track</th>
                               </tr>
                               <tr class="header">
                                 <th>In Time</th>
                                 <th>Time Spent</th>
                                 <th>Out Time</th>
                                 <th>In Time</th>
                                 <th>Time Spent</th>
                                 <th>Out Time</th>
                               </tr>
                               </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- report update ends -->
                     <div  id="speed_alert_div" style="display:none;" >
                     	<div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Speed Alert Report <div class="sub-head">For The Period : <span id="speed_alert_time_period"></span></div></div>
                        
                        <div class="scrollbar" id="style-2">
                           <table id="speed_alert" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Group Name</th>
                                    <th>Date and Time</th>
                                    <th>Speed</th>
                                    <th>Lattitude</th>
                                    <th>Lognitude</th>
                                    <th>Geoffence</th>      
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div  id="nodata_alert_div" style="display:none;" >
                     	<div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>No Data Alert Report <div class="sub-head">For The Period : <span id="nodata_alert_time_period"></span></div></div>
                        
                        <div class="scrollbar" id="style-2">
                           <table id="nodata_alert" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Description</th>
                                    <th>Group Name</th>
                                    <th>Last Received <br> GPS Data </th>
                                    <th>Data Received <br> Server Time</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Geofence</th>      
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div  id="wrong_speed_alert_div" style="display:none;" >
                     	<div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Wrong Speed Alert Report <div class="sub-head">For The Period : <span id="wrong_speed_alert_time_period"></span></div></div>
                        
                        <div class="scrollbar" id="style-2">
                           <table id="wrong_speed_alert" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Description</th>
                                    <th>Group Name</th>
                                    <th>Speed</th>
                                    <th>Lattitude</th>
                                    <th>Lognitude</th>
                                    <th>GPS Time</th>
                                    <th>Geoffence</th>      
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div id="device_idle_div" style="display:none;">
                     	<div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Device Idle Report <div class="sub-head">For The Period : <span id="device_idle_time_period"></span></div></div>
                        
                        <div class="scrollbar" id="style-2">
                           <table id="device_idle" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Asset Code</th>
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Actual start date</th>
                                    <th>Actual End date</th>
                                    <th>Total Duration</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- report update starts -->
                    <div id="geofence_time_div" style="display:none;">
                      <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Geoffence Time Report <div class="sub-head">For The Period : <span id="geoffencetime_time_period"></span></div></div>
                         <div class="scrollbar" id="style-2">
                           <table id="geofence_time" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Asset Code</th>
                                    <th>Description</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Spent Time</th>
                                    <th>Geofence</th>
                                  </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                    <!-- report update ends -->
                    <!-- geofencetogeoffencesummary_report starts -->
                    <div id="geofence_time_summary_div" style="display:none;">
                      <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Geoffence Time Report <div class="sub-head">For The Period : <span id="geoffencetimesummary_time_period"></span></div></div>
                         <div class="scrollbar" id="style-2">
                           <table id="geofencetogeoffencesummary_report" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Asset Code</th>
                                    <th>Description</th>
                                    <th>Travelling TIme</th>
                                    <th>Travelling KM</th>
                                    <th>Return Time</th>
                                    <th>Return KM</th>
                                  </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!--geofencetogeoffencesummary_report ends -->
                     <!-- woqode_div -->
                     <div id="woqode_div" style="display:none;">
                      <div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Woqode Report <div class="sub-head">For The Period : <span id="woqode_time_period"></span></div></div>
                         <div class="scrollbar" id="style-2">
                           <table id="woqode_report" class="table table-striped table-bordered display nowrap" width="100%"  >
                              <thead style="display: table-header-group;">
                                 <tr class="header">
                                    <th>Asset Code</th>
                                    <th>Description</th>
                                    <th>quantity</th>
                                    <th>saletime</th>
                                    <th>Station</th>
                                    <th>Geofence In</th>
                                    <th>geofence Out</th>
                                    <th>Spent Time</th>
                                    <th>Geofence</th>
                                   </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- woqode_div -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>

<script>
   function initialize()
      {
		  
     myLatlng = new google.maps.LatLng("25.286106","51.534817");
     var mapOptions = {
         zoom: 10,
         center: myLatlng,
   mapTypeIds: ['coordinate', 'roadmap'],
    disableDefaultUI: true,
	zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_BOTTOM
                },
   mapTypeId: google.maps.MapTypeId.ROADMAP 
      };
     	map = new google.maps.Map(document.getElementById("map"), mapOptions);
   	newmap = new google.maps.Map(document.getElementById("newmap"), mapOptions);
    // update starts
    map1 = new google.maps.Map(document.getElementById("map1"), mapOptions);
    // update ends
		
   } 
   
    
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfLQ-HGp-RlEF7nfGq2lAI8AZmfBZm7oo&libraries=geometry,drawing&callback=initialize"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>lib/js/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="<?php echo base_url(); ?>lib/js/0.9.13/bootstrap-multiselect.js"></script>
<script src="<?php echo base_url(); ?>lib/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>lib/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>lib/js/full-screen-helper.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" /></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"  ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"  ></script>        	
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"  ></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"  ></script>
<script src="<?php echo base_url(); ?>lib/js/jquery.selectBoxIt.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"  ></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>

<script>
  $(document).ready(function() {
    
	var arrowicon = [];
  var vehicleicon = [];	
	var starticon = [];
	var endicon = [];
  var markers = []; // update
	var stopplayback_markericon = [];
	var historyLatlngstart="";
	var myLatlngstart="";
	var historyvehicleicon = [];
  var marker =new Array();
	var marker1 = "";
  var move_data=new Array();
	var stop_flag = 0;
	var pause_flag= 0;
  var position =new Array();
  var deltaLat=new Array();
	var deltaLng=new Array();
  var movelatlng=new Array();
  var speed="";
  var ignition="";
  var track_pos=new Array();
  var icon2="";
	var vehicle =new Array();
	var vehicle_animate =new Array();
	var vehicle_animate_full=new Array();
	var previous_cordinates=new Array();
	var vehicle_rotate_deg =new Array();
	var contentString="";
	var infowindow="";
	var color="";
	var numDeltas = new Array();
	var delay = new Array();
	var i = new Array();
	var b = new Array();
	var playspeed=3;
	var polylinenarray=new Array();
	var triangleCoords=new Array();
	var run_loop_animation="0"; //milliseconds
	var previousangle=new Array();
  var previous_rotated=0;
	var current_angle=new Array();
	var vehicledata="";
	var play_status="";
	var infowindows=new Array();
	var previousinfowindow="";
	var previous_data=new Array();
	var previous_rotate_angle=new Array();
	var rotate_status=new Array();
	var marker_img=new Array();
	var difference=new Array();
	var unsigned_difference=new Array();
	var reduced_degree=new Array();
	var truck=new Array();
	var newpoint=new Array();
	var colors=new Array();
	var new_angledeg=new Array();
	var latest_lat=new Array();
	var latest_logn=new Array();
	var timeout;
	var history_img=new Array();
	var history_total_length=[];
	var current_request;
  //  new update starts
  var geoffence=new Array();
  var selected_goeffence=new Array();
  var polygonarray=new Array();
  var icon_focus_flag=0;
  var geo_infoWindow=new Array();
  //  new update ends

 	//var vehicle_new = vehicle.filter(function(v){return v!==''});
	
	$('#play_stop').hide();
	
	$("#group_list").slideDown( "slow");
	
	$('#Geoffence_name').multiselect({
         nonSelectedText: 'Select Geofence',
         enableClickableOptGroups: true,
		enableCollapsibleOptGroups: true,
		enableFiltering: true,
		includeSelectAllOption: true,
		enableCaseInsensitiveFiltering: true,
		includeResetOption: true,
          resetText: "Reset all",
         buttonWidth:'100%',
		 maxHeight: 300
    });

  ////////////////////////////exclude check////////////////////////////

  $('#Geoffence_name_exclude').multiselect({
         nonSelectedText: 'Select Geofence to be Excluded',
         enableClickableOptGroups: true,
    enableCollapsibleOptGroups: true,
    enableFiltering: true,
    includeSelectAllOption: true,
    enableCaseInsensitiveFiltering: true,
    includeResetOption: true,
          resetText: "Reset all",
         buttonWidth:'100%',
     maxHeight: 300
    });

  ////////////////////////////exclude check////////////////////////////

  // geoffence_show update starts

  $( function() {
       $( "#div_table" ).draggable({
       handle: "#draggable",    
       containment: '.card',
           drag: function( event, ui ) {
             $( this ).css('bottom','unset');
         }
      });
  });
  
  $( function() {
       $( "#div_table2" ).draggable({
       handle: "#draggable2",   
       containment: '.drag-area',
           drag: function( event, ui ) {
             $( this ).css('bottom','unset');
         }
      });
  });
  
    $('.switch-icons-geo').on('click',function(){
        if($(this).html()==='-'){
          $(this).html('+'); 
          $(this).parent().next().hide();
        }
        else 
          $(this).html('-')
        
        $('.min-max-geo').slideToggle();
    });
    
    $(document).on("click", '.geoffence_search',function (event) {
        $(this).parent().parent().next().show();
    });
    $(document).on("click", '.geoffencesearch_remove',function (event) {
       $(this).parent().hide();
       $(this).parent().find('#geoffenceInput').val('');
       var value = $(this).parent().find('#geoffenceInput').val().toLowerCase();
       $(".geoffence_search_data li div").filter(function() {
            $(this).toggle($('#myInput').text().toLowerCase().indexOf(value) > -1)
       });
         
     });
       
     $(document).on("click", '#geoffence_refresh', function (event) {
       var spinner = $(".loaders").insertAfter(this);
       spinner.fadeIn();  
       clear_geoffence();
       spinner.fadeOut();
     });
     
     $("#geoffenceInput").on("keyup", function() {
       var value = $(this).val().toLowerCase();
       if(value!=""){
         $(".geoffence_search_data").show();
       }else{
         $(".geoffence_search_data").hide();
       }
       $(".geoffence_search_data li div").filter(function() {
         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
       });
    });
     
     $(document).on("click", '.geoffence_show', function (event) {
        

        if ($("#div_table").is( ":hidden" ) ) {
          
           $("#div_table").show("fast");
           $("#GeofenceToolbox").show()
        }else{
           
          $("#div_table").hide("fast");
            $("#GeofenceToolbox").hide();
        }
        
     });
     
    $(document).on("click", '.geoffence_show2', function (event) {
       
        if ($("#div_table2").is( ":hidden" ) ) {
           $("#div_table2").show("fast");
           $("#GeofenceToolbox").show()
        }else{
          $("#div_table2").hide("fast");
            $("#GeofenceToolbox").hide();
        }
     });
     
     function clear_geoffence() {
       $(".geoffencegrouplist").each(function() {
            
           if($(this).prop('checked')==true){
           $(this).prop('checked',false);
         }    
         id=this.id;
         
           $(".child"+id).each(function() {
           $(this).prop('checked',false);
                 geoffence_id=this.id;
               geoffence_data(geoffence_id); 
                  });
        });
        }
      
    $(document).on("click", '.geoffencegroups_data', function (event) {
     
       geoffence_groupid=$(this).attr("data-id").split("_");
       id=geoffence_groupid['1'];
       if ($(event.target).is('input')) { //if clicked on input element don't do anything
         return
       }
       if ( $(this).next().is( ":hidden" ) ) {
         $(this).children(".node").removeClass("inactive");
         $(this).children(".node").addClass("active");
         $(this).next().slideDown( "fast");
         if( $(this).find("input").prop('checked')){
          $(".child"+id).prop('checked',true);
         }
       }else{
           if($('.loader').css('display') != 'none') {
           $('.loader').hide();
          }
           $(this).children(".node").addClass("inactive");
           $(this).children(".node").removeClass(" active");
           $(this).next().slideUp( "fast");
       }
        })
   
   
         $('#myModal').on('hidden.bs.modal', function () {
        clear_geoffence();
        $('.loader').fadeOut('slow');
         })
      
         $(document).on("click", '.geoffence_focus',function (event) {
          id = this.id.split("_");
          var cur_id=id[1];
          if((cur_id in selected_goeffence)){
          var all_borders=selected_goeffence[cur_id].split("|");
          var cordinates=all_borders[0].split(",");
          myLatlng = new google.maps.LatLng(cordinates[0],cordinates[1]);
          var reportintaetype=$("#Report").val();
          geo_infoWindow[cur_id].setPosition(myLatlng);
          
          
          if(reportintaetype=="7"){
          newmap.setCenter(myLatlng); 
          newmap.setZoom(14);
          geo_infoWindow[cur_id].open(newmap);
          }else if(reportintaetype=="17" || reportintaetype=="1"){
          map1.setCenter(myLatlng); 
          map1.setZoom(14);
          geo_infoWindow[cur_id].open(map1);
          }
          
        }else{
            swal({
               title: "Warning!",
               text:"Please select the Geoffence" ,
               icon: "error",
               button: "ok",
            })
        }
      });
    
    $(document).on("click", '.geoffencegrouplist', function (event) {
       id=this.id;
       if($(this).prop('checked')==true){
       $(".loaders").show();
         $(".child"+id).prop('checked',true);
     }else{
         $(".loaders").hide();
       $(".child"+id).prop('checked',false);
     }
     
       $(".child"+id).each(function() {
          geoffence_id=this.id;
        geoffence_data(geoffence_id);   
        });
     
      if($(this).prop('checked')==true){
      showgeoffence();
    }
     
   });
   
    $(document).on("click", '#close_geoffence', function (event) {
      $("#div_table").hide("fast");
    $("#div_table2").hide("fast");
     });
   
  $(document).on("click", '.geoffence', function (event) {
      id=this.id;
    geoffence_id=this.id;
    geoffence_data(geoffence_id);       
    var geoffencefull = geoffence.filter(function(v){return v!==''});
    if(!$(this).prop('checked')){
       $(".loaders").hide();
      }else{
       showgeoffence();  
       $(".loaders").show();  
    }
      
  });
  
  function geoffence_data(geoffenceid){
       geoffence_array=geoffenceid.split("_");
     id=geoffence_array[1];  
     if(!$('#'+geoffenceid).prop('checked')){
        if(id in geo_infoWindow){
              geo_infoWindow[id].close();
        }
        deletegoeffence(id);
        delete geoffence[id];
        delete geo_infoWindow[id];
        
     }else{
       if(!(id in geoffence)){
        geoffence[id]=id;
       }
     }
   }
  
   function deletegoeffence(id){
    if(id in selected_goeffence){
        delete selected_goeffence[id];
        $.each(polygonarray, function(index, val) {
         if(val.id==id){
          polygonarray[index].setMap(null);
       } 
           });
    }
  }
  
  function showgeoffence(){
  var geoffencefull=geoffence.filter(function(v){return v!==''}).toString();
      if( geoffencefull!=""){
       $.ajax({
        url: "<?=base_url()?>index/showall_geofence",  
        data:{geoffence:geoffencefull},
        type: 'post',
        success: function(result){
          var response = $.parseJSON(result);
        var count=1;
              var total_length=Object.keys(response).length;
        $.each( response, function( key, geoffencedatas ) {
          deletegoeffence(key)
          selected_goeffence[key]=geoffencedatas.information;
             draw_polygon(geoffencedatas.information,geoffencedatas.color,key,geoffencedatas.name)
           if(total_length==count){
             $(".loaders").fadeOut();
           }
             count++;
        });
        }
     });
  }
  else
  {
    console.log("showgeoffence else");
  }
}


function draw_polygon(boundaries,color,id,name){
    
       boundries=boundaries;
     var boundary_array=boundries.split("|");
     geoffencetriangleCoords=[];
       $.each(boundary_array, function(index, bvalue) {
        var cordinates=bvalue.split(",");
         geoffencetriangleCoords.push(new google.maps.LatLng(cordinates[0],cordinates[1])) ;
     });
         
     // Construct the polygon
        wataniyaTriangle = new google.maps.Polygon({
                 id:id,
                             paths: geoffencetriangleCoords,
                             draggable: false,
                             editable: false,
                             strokeColor: '#'+color,
                             strokeOpacity: 0.8,
                             strokeWeight: 2,
                             fillColor:  '#'+color,
                             fillOpacity: 0.50
                     });
    var reportintaetype=$("#Report").val();      
    if(reportintaetype=="7"){
       wataniyaTriangle.setMap(newmap);
    }else if(reportintaetype=="17" || reportintaetype=="1"){
       wataniyaTriangle.setMap(map1);
    }
      attachPolygonInfoWindow(wataniyaTriangle,name,id);
      polygonarray.push(wataniyaTriangle);
    }
   
   
   //showing the name of the polygon
   function attachPolygonInfoWindow(polygon,name,id) {

     
         geo_infoWindow[id] = new google.maps.InfoWindow();

      geo_infoWindow[id].setContent(name);
           google.maps.event.addListener(polygon, 'mouseover', function (e) {
         
         var latLng = e.latLng;
           geo_infoWindow[id].setPosition(latLng);
         var reportintaetype=$("#Report").val();       
        if(reportintaetype=="7"){
           geo_infoWindow[id].open(newmap);
        }else if(reportintaetype=="17"){
          geo_infoWindow[id].open(map1);
        }
         
         
          });
          google.maps.event.addListener( polygon, 'mouseout', function() {
         geo_infoWindow[id].close();
         });
  
   }
     


  // geoffence_show update ends


	
	/* enlarging the div*/
	
	var w = $(window).width();
	var h = $(window).height();
	var w1 = $("#report-view-area").width();
	var h1 = $("#report-view-area").height();
	
    /*if(typeof FullScreenHelper === "undefined") {
        document.write("<p>FullScreenHelper is not loaded</p>");
    }else if(FullScreenHelper.supported()) {
        document.write("<p>Fullscreen is supported</p>");
    }else{
        document.write("<p>Your browser don't support fullscreen</p>");
    }*/

   $(document).on("fullscreenchange", function () {
 
		if ($.fullScreenHelper("state")) {
		 console.log("In fullscreen", $(":fullscreen"));
		} else {
		 console.log("Not in fullscreen");
	   }
  });

	$('#report-view-area').fullScreenHelper('#report-view-area');

	
	//FullScreenHelper.request($(document));
	
	var pl = $('#report-view-area');
	var c = 1;
	
	$('.fa-expand').click(function() {
		
		
		console.log(FullScreenHelper.current());
 		c++;
 		$(this).toggleClass('fa-compress');
  		//odd -> Full Screen 
		if(c%2==0){
			$(".custom-padding").addClass("collapse");
			pl.css({'z-index': 101,"top":"-65px","position":"absolute"});
			$(".container-fluid").css({"padding-right":"0","padding-left":"0"});
			$(".dataTables_scrollHeadInner").addClass("responsive-width");
			$(".dataTables_scrollHeadInner table").addClass("responsive-width");
			$(".card").addClass("min-height");
			$(".row").css({'margin-right':'0'});
			//$(".dataTables_scrollHead").addClass("pdng-right");
			pl.animate({width:(w)}, 300, function(){
				$(this).animate({height:(h-20)}, 300);
				$("#map").animate({height:(h-50)}, 300);
				$("#newmap").animate({height:(h-50)}, 300);
				pl.addClass('active');				
			});		
		}
		
		//even -> Exit Full Screen 
		if (c%2!=0){
			pl.css({'z-index': 0,"top":"","position":""});
			$(".custom-padding").removeClass("collapse");
			$(".container-fluid").css({"padding-right":"15px","padding-left":"15px"});
			$(".dataTables_scrollHeadInner").removeClass("responsive-width");
			$(".dataTables_scrollHeadInner table").removeClass("responsive-width");
			$(".card").removeClass("min-height");
			$(".row").css({'margin-right':'-15px'});
			pl.animate({height:'82vh'}, 300, function(){
				$("#map").animate({height:'82vh'}, 300);
				$("#newmap").animate({height:'82vh'}, 300);
				$(this).removeAttr('height');
				$(this).animate({width:w1}, 300, function(){
 				 
					$(this).removeAttr('width');
				});
				pl.removeClass('active');								
			});
		}
		
	});
	
	//$(window).on('resize', function () { $('.fixedHeader').remove(); new $.fn.dataTable.FixedHeader(table); });
	
	
	$(".multiselect-container").children(".multiselect-group-clickable").children("a").children("b").addClass('multiselect-mainhead');
	
	$(function(){
    var $select = $(".60-200");
	  for (i=60;i<=200;i+=10){
		  $select.append($('<option></option>').val(i).html(i))
	  }
	});
	
	$(function(){
    var $select = $(".30-210");
	  for (b=30;b<=330;b+=30){
		  $select.append($('<option> </option>').val(b).html(b+' Minutes'))
	  }
	});
	
	
	$('body').on('click', '#select_all', function () {
		if ($(this).hasClass('allChecked')) {
			$('input[type="checkbox"]', '#FleetTree').prop('checked', false);
			$.each(vehicle, function(id, val) {
 			   delete vehicle[id];
            });
		} else {
			$('input[type="checkbox"]', '#FleetTree').prop('checked', true);
			 $(".vehiclelist").each(function() {
   		   vehicle_id=this.id;
   		   vehicle_data(vehicle_id);
        });
		}
		$(this).toggleClass('allChecked');
	  });
	
	arrow="M282.082,195.285L149.028,62.24c-1.901-1.903-4.088-2.856-6.562-2.856s-4.665,0.953-6.567,2.856L2.856,195.285 C0.95,197.191,0,199.378,0,201.853c0,2.474,0.953,4.664,2.856,6.566l14.272,14.271c1.903,1.903,4.093,2.854,6.567,2.854 c2.474,0,4.664-0.951,6.567-2.854l112.204-112.202l112.208,112.209c1.902,1.903,4.093,2.848,6.563,2.848 c2.478,0,4.668-0.951,6.57-2.848l14.274-14.277c1.902-1.902,2.847-4.093,2.847-6.566 C284.929,199.378,283.984,197.188,282.082,195.285z";
	
	
   $("#ControlPanelList a").hover(function () {
              var title = $(this).data("title");
              $("#ControlPanelList .control-panel-header").html(title);
          });
          $("#ControlPanelList").hover(function () {
              $("#ControlPanelList .control-panel-header").html('Control Panel');
          });
   	
    function updateClock()
	{
    //var today = new Date();
	
	var oldDate = new Date();
	var hour = oldDate.getHours();
	var newDate = oldDate.setHours(hour + 1);
	console.log(newDate);
	
	

	
    $('#datetimepicker1').datetimepicker({
		showClose:true,
		 //format: 'DD.MM.YYYY hh:mm',
      //format: 'DD.MM.YYYY',
       maxDate: newDate,
	   
    });
   
    $('#datetimepicker2').datetimepicker({
		showClose:true,
		useCurrent: false,
		 //format: 'DD.MM.YYYY hh:mm',
      //format: 'DD.MM.YYYY',
        maxDate: newDate,
    });
	$("#datetimepicker1").on("dp.change", function (e) {
		$('#datetimepicker2').data("DateTimePicker").minDate(e.date);
	});
	$("#datetimepicker2").on("dp.change", function (e) {
		$('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
	});
	
	}
   	
   updateClock();
   
      $("#map_playback").hide();
     var delayFactor = 0;
	 
     		  
   	 
     
     $("input[name='satelite_type']").change(function(){
			  if($(this).val()=="Satellite"){
			      newmap.setMapTypeId(google.maps.MapTypeId.HYBRID);
				  map.setMapTypeId(google.maps.MapTypeId.HYBRID);
			  }else{
			      newmap.setMapTypeId(google.maps.MapTypeId.ROADMAP);
				  map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
			  }
           });
		 
		  $(document).on("click", '.Satellite', function (event) {
 			  var myMapType = new MyMapType();
			  newmap.mapTypes.set('terrain', myMapType);
		      newmap.setMapTypeId('terrain');
			  map.mapTypes.set('terrain', myMapType);
		      map.setMapTypeId('terrain');
		  });
		  
 		  $(document).on("click", '.Road', function (event) {
 			    var myMapType = new MyMapType();
			    newmap.mapTypes.set('roadmap', myMapType);
		        newmap.setMapTypeId('roadmap');
				map.mapTypes.set('roadmap', myMapType);
		        map.setMapTypeId('roadmap');
		  });
	 
	 
     /*function m_get_directions_route (request) {
      
          var directionsService = new google.maps.DirectionsService();
          var directionsDisplay = new google.maps.DirectionsRenderer();
           directionsService.route(request, function(response, status) {
   			 //console.log(status);
			   if (status == 'OK') {
					 directionsDisplay.setDirections(response);
				  directionsDisplay.setMap(map);
				 }else if (status === google.maps.DirectionsStatus.OVER_QUERY_LIMIT) {
				   //console.log(status);
					 setTimeout(function () {
					   m_get_directions_route(request);
					}, 10);
				}  
   			 // console.log("function-->"+dom);
         });
    } */
	
	
  $("#myInput").on("keyup", function() {
 			 
			    
				
             var value = $(this).val().toLowerCase();
			  if(value!=""){
				  $(".fleets_search_data").show();
				  $("#group_list").show();
			  }else{
				  $(".fleets_search_data").hide();
				  $("#group_list").hide();
			  }
              $(".fleets_search_data li div").filter(function() {
                 $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
             });
			 
         });
		 
   $(".multiselect-search").on("keyup", function() {
	   var value = $(this).val().toLowerCase();
   		if(value!=""){
			
				  $(".hidden").addClass("disp_block");
				  //console.log("Entered here");
				  //$("#group_list").show();
				  
			  }else{
				  $(".hidden").removeClass("disp_block");  
			  }
             $(".multiselect-container li a").filter(function() {
                 $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
             		});
         });
		 
		 $(function(){
    $('.multiselect-clear-filter').click(function() {
        //alert("Hello");
		$('.filter input[type="text"]').val('');
		  $('.filter input[type="text"]').trigger("keyup");
    });
});
		 
   		 /*$(document).on("click", '.multiselect-clear-filter', function (event) { 
		 alert("hello");
		 console.log("entered in clearing");
		  $('.filter input[type="text"]').val('');
		  $('.filter input[type="text"]').trigger("keyup");
	  });*/
   
   $('#commentForm').validate({ // initialize the plugin
          rules: {
              Report: {
                  selectcheck: true
              },
		 vehicle: {
                selectcheck: true
            },
			/*'alert_field': {
                required: true
            }			  
          },
		  messages: {
            'alert_field': {
                required: "Choose at least one option"
            }*/
        }
		  
      });
   //if(element.attr("name") == "check") error.appendTo("#alert_type");
   	jQuery.validator.addMethod('selectcheck', function (value) {
                 return (value != 'select');
           }, "This field is required");
		   
		   
		   function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
	
	
	//console.log(lat1+","+lon1+","+lat2+","+lon2);
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}
   
   
  function radians(n) {
  return n * (Math.PI / 180);
}
function degrees(n) {
  return n * (180 / Math.PI);
}

function getBearing(startLat,startLong,endLat,endLong){
  startLat = radians(startLat);
  startLong = radians(startLong);
  endLat = radians(endLat);
  endLong = radians(endLong);

  var dLong = endLong - startLong;

  var dPhi = Math.log(Math.tan(endLat/2.0+Math.PI/4.0)/Math.tan(startLat/2.0+Math.PI/4.0));
  if (Math.abs(dLong) > Math.PI){
    if (dLong > 0.0)
       dLong = -(2.0 * Math.PI - dLong);
    else
       dLong = (2.0 * Math.PI + dLong);
  }

  return (degrees(Math.atan2(dLong, dPhi)) + 360.0) % 360.0;
} 
	
	// function marker_movement(callback){
	//   if(play_status=="1"){
	// 	  latest_lat=new Array();
	// 	 latest_logn=new Array();
	//   if(newpoint.lat!=latest_lat && newpoint.logn!=latest_logn){
	//    position[0] += deltaLat;
	//    position[1] += deltaLng;
	//   }
	//    newpoint.lat=parseFloat(newpoint.lat);
	//    newpoint.logn=parseFloat(newpoint.logn);
	   
	//    if(deltaLat<0){
	// 	   if(position[0]<newpoint.lat){
	// 		   latest_lat=(newpoint.lat);
	// 	   }else{
	// 		   latest_lat=(position[0]);
	// 	   }
		   
	//    }else{
	// 	   if(position[0]>newpoint.lat){
	// 		   latest_lat=(newpoint.lat);
	// 	   }else{
	// 		   latest_lat=(position[0]);
	// 	   }

		   
	//    }
	//    if(deltaLng<0){
	// 	   if(position[1]<newpoint.logn){
	// 		   latest_logn=(newpoint.logn);
	// 	   }else{
	// 		   latest_logn=(position[1]);
	// 	   }
		   
	//    }else{
	// 	   if(position[1]>newpoint.logn){
	// 		   latest_logn=(newpoint.logn);
	// 	   }else{
	// 		   latest_logn=(position[1]);
	// 	   }
	//    }
	   
	//    movelatlng = new google.maps.LatLng(latest_lat,latest_logn);
	   
	// 	if( newpoint.ign_status=="ON"){
	// 	   truck="<?=base_url()?>lib/images/group_icons/"+newpoint.idle+"#historyplay";
	// 	  if(newpoint.speed < 1){
	// 		  if(newpoint.lat==latest_lat && newpoint.logn==latest_logn){
	// 			  truck="<?=base_url()?>lib/images/group_icons/"+newpoint.idle+"#historyplay";
	// 			  colors="orange";
	// 		 }else{
	// 			truck="<?=base_url()?>lib/images/group_icons/"+newpoint.run+"#historyplay";
	// 			colors="green";
	// 		 }
	// 	  }else{
	// 		  truck="<?=base_url()?>lib/images/group_icons/"+newpoint.run+"#historyplay";
	// 		  colors="green";
	// 	  }
	//    }else{
	// 	   truck="<?=base_url()?>lib/images/group_icons/"+newpoint.stop+"#historyplay";
	// 	   colors="#FF0800";
	//    }
	   
	//    // movelatlng = new google.maps.LatLng(latest_lat,latest_logn);
		  
	// 	  if(typeof(marker_img)!="undefined"){
	// 			 marker_img.attr("src",truck);		
	// 		}
	// 		marker_img =$('img[src="'+truck+'"]');
			
			
		   
	// 	   arrow="M282.082,195.285L149.028,62.24c-1.901-1.903-4.088-2.856-6.562-2.856s-4.665,0.953-6.567,2.856L2.856,195.285 C0.95,197.191,0,199.378,0,201.853c0,2.474,0.953,4.664,2.856,6.566l14.272,14.271c1.903,1.903,4.093,2.854,6.567,2.854 c2.474,0,4.664-0.951,6.567-2.854l112.204-112.202l112.208,112.209c1.902,1.903,4.093,2.848,6.563,2.848 c2.478,0,4.668-0.951,6.57-2.848l14.274-14.277c1.902-1.902,2.847-4.093,2.847-6.566 C284.929,199.378,283.984,197.188,282.082,195.285z";
	   
	//    icon2["strokeColor"]=colors;
	//    icon2["fillColor"]=colors;
	//   // marker1.setIcon(icon2);
	//   // marker.setPosition(movelatlng);
	//   // marker1.setPosition(movelatlng);
	   
	   
	//    /*var markerImage = new google.maps.MarkerImage(truck,
	// 							new google.maps.Size( 52,52),
	// 							new google.maps.Point(0, 0),
	// 							 new google.maps.Point(26,26));
								
			
	// 	   marker.setIcon(markerImage);*/
	// 	  // marker.setPosition(movelatlng);
		   
		 
		   
	   
	//    if(i!=numDeltas){
	// 			if(newpoint.lat!=latest_lat && newpoint.logn!=latest_logn){
	// 				new_angledeg=Math.round(getBearing(previous_data["lat"],previous_data["logn"],latest_lat,latest_logn).toFixed(2));
	// 		   }
			  
	// 			 previous_data["lat"]=latest_lat;
	// 		   previous_data["logn"]=latest_logn;
	// 			 marker.setPosition(movelatlng);
	// 			   //newmap.setCenter(movelatlng);
	// 		  i++;
	// 		  run_loop_animation=0;
	// 		  //console.log("running rotation "+angleDeg);
	// 	  rotateMarker(new_angledeg,"",function(){
	// 						 marker.setPosition(movelatlng);
	// 					     infowindows.setPosition(movelatlng);
	// 						 setTimeout(function(){
	// 								 marker_movement(callback);
	// 						 }, delay);
	// 					});
	//    }else{
	// 		i=0;
	// 		rotateMarker(new_angledeg,"",function(){
 // 				   marker.setPosition(movelatlng);
	// 			   run_loop_animation=1;
	// 			   callback();
							 
	// 		 });
	// 		//run_loop_animation=1;
	// 		//callback();
	//    }
	// }
 //   }
  
    // Follow vehicle update 

    function marker_movement(callback){
    if(play_status=="1"){
      latest_lat=new Array();
     latest_logn=new Array();
    if(newpoint.lat!=latest_lat && newpoint.logn!=latest_logn){
     position[0] += deltaLat;
     position[1] += deltaLng;
    }
     newpoint.lat=parseFloat(newpoint.lat);
     newpoint.logn=parseFloat(newpoint.logn);
     
     if(deltaLat<0){
       if(position[0]<newpoint.lat){
         latest_lat=(newpoint.lat);
       }else{
         latest_lat=(position[0]);
       }
       
     }else{
       if(position[0]>newpoint.lat){
         latest_lat=(newpoint.lat);
       }else{
         latest_lat=(position[0]);
       }

       
     }
     if(deltaLng<0){
       if(position[1]<newpoint.logn){
         latest_logn=(newpoint.logn);
       }else{
         latest_logn=(position[1]);
       }
       
     }else{
       if(position[1]>newpoint.logn){
         latest_logn=(newpoint.logn);
       }else{
         latest_logn=(position[1]);
       }
     }
     
     movelatlng = new google.maps.LatLng(latest_lat,latest_logn);
     
    if( newpoint.ign_status=="ON"){
       truck="<?=base_url()?>lib/images/group_icons/"+newpoint.idle+"#historyplay";
      if(newpoint.speed < 1){
        if(newpoint.lat==latest_lat && newpoint.logn==latest_logn){
          truck="<?=base_url()?>lib/images/group_icons/"+newpoint.idle+"#historyplay";
          colors="orange";
       }else{
        truck="<?=base_url()?>lib/images/group_icons/"+newpoint.run+"#historyplay";
        colors="green";
       }
      }else{
        truck="<?=base_url()?>lib/images/group_icons/"+newpoint.run+"#historyplay";
        colors="green";
      }
     }else{
       truck="<?=base_url()?>lib/images/group_icons/"+newpoint.stop+"#historyplay";
       colors="#FF0800";
     }
     
     // movelatlng = new google.maps.LatLng(latest_lat,latest_logn);
      
      if(typeof(marker_img)!="undefined"){
         marker_img.attr("src",truck);    
      }
      marker_img =$('img[src="'+truck+'"]');
      
      
       
       arrow="M282.082,195.285L149.028,62.24c-1.901-1.903-4.088-2.856-6.562-2.856s-4.665,0.953-6.567,2.856L2.856,195.285 C0.95,197.191,0,199.378,0,201.853c0,2.474,0.953,4.664,2.856,6.566l14.272,14.271c1.903,1.903,4.093,2.854,6.567,2.854 c2.474,0,4.664-0.951,6.567-2.854l112.204-112.202l112.208,112.209c1.902,1.903,4.093,2.848,6.563,2.848 c2.478,0,4.668-0.951,6.57-2.848l14.274-14.277c1.902-1.902,2.847-4.093,2.847-6.566 C284.929,199.378,283.984,197.188,282.082,195.285z";
     
     icon2["strokeColor"]=colors;
     icon2["fillColor"]=colors;
     if(i!=numDeltas){
        if(newpoint.lat!=latest_lat && newpoint.logn!=latest_logn){
          new_angledeg=Math.round(getBearing(previous_data["lat"],previous_data["logn"],latest_lat,latest_logn).toFixed(2));
         }
        
         previous_data["lat"]=latest_lat;
         previous_data["logn"]=latest_logn;
         marker.setPosition(movelatlng);
         if(icon_focus_flag==1){
           newmap.setCenter(movelatlng);
           var bounds = new google.maps.LatLngBounds();
           bounds.extend(movelatlng);
           //infowindows[trackvehicle].open(map, marker[trackvehicle]);
           }
        i++;
        run_loop_animation=0;
        //console.log("running rotation "+angleDeg);
      rotateMarker(new_angledeg,"",function(){
               marker.setPosition(movelatlng);
                 infowindows.setPosition(movelatlng);
               setTimeout(function(){
                   marker_movement(callback);
               }, delay);
            });
     }else{
      i=0;
      rotateMarker(new_angledeg,"",function(){
           marker.setPosition(movelatlng);
           run_loop_animation=1;
           callback();
               
       });
      //run_loop_animation=1;
      //callback();
     }
  }
   }
   
   function transition(newpoint,movemarkercallback){
	 rotate_status=0;
  	  if(!$.isArray(previous_cordinates)){
		      previous_cordinates=new Array();
			  previous_cordinates["lat"]=marker.getPosition().lat();
			  previous_cordinates["log"]=marker.getPosition().lng();
	  }
	  
	  
   	  if((previous_cordinates['lat']!=newpoint.lat) && (previous_cordinates['log']!==newpoint.logn)){
			colors=new Array();		  
 		  // icon2.rotation = parseInt(newpoint.Heading);
		  // rotateMarker(parseInt(newpoint.Heading));
 		   
 		     if(!$.isArray(position)){
				 position=new Array();
			 }
			 position[0] = marker.getPosition().lat();
			 position[1] = marker.getPosition().lng();
			  var distance=(getDistanceFromLatLonInKm(previous_cordinates['lat'],previous_cordinates['log'],newpoint.lat,newpoint.logn)*1000).toFixed(4);
			 
			 
			 
			 if(playspeed==1){
				numDeltas = 100;
	            delay = 100;				 
			 }else if(playspeed==2){
				numDeltas = 120;
	            delay = 80;				 
			 }else if(playspeed==3){
				numDeltas = 190;
	            delay = 5;
 			 }else if(playspeed==4){
				numDeltas = 90;
	            delay = 8;				 
			 }else if(playspeed==5){
				numDeltas = 60;
	            delay = 5;				 
			 }else if(playspeed==6){
				numDeltas = 50;
	            delay = 1;				 
			 }
			 
			 
			 
			 previous_cordinates['lat']=newpoint.lat;
			  previous_cordinates['log']=newpoint.logn;
  				 
 			 deltaLat = (newpoint.lat- position[0])/numDeltas;
			 deltaLng = (newpoint.logn-  position[1])/numDeltas;
 			 //console.log("delay is "+delay);
 			 i=0;
			 
 			 marker_movement(function(){
 				if(vehicle_animate.length>0){
					 movemarkercallback();
				}
   			 })
 	  } else{
		  
		  //run_loop_animation=1; // new
		  truck="<?=base_url()?>lib/images/group_icons/"+newpoint.idle+"#historyplay";
		  if(newpoint.ign_status=="ON" && newpoint.speed == '0'){
			    truck="<?=base_url()?>lib/images/group_icons/"+newpoint.idle+"#historyplay";
			    colors="orange";
		   }else if(newpoint.ign_status=="ON" && newpoint.speed > 1){
		   		truck="<?=base_url()?>lib/images/group_icons/"+newpoint.run+"#historyplay";
			    colors="green";
		   }else{
			    truck="<?=base_url()?>lib/images/group_icons/"+newpoint.stop+"#historyplay";
			   colors="#FF0800";
		   }
		   
		  
													   
 		   if(typeof(marker_img)!="undefined"){
			     marker_img.attr("src",truck);
			 }
			 marker_img =$('img[src="'+truck+'"]');
 
		    
 		   icon2["strokeColor"]=colors;
	       icon2["fillColor"]=colors;
	      // marker1.setIcon(icon2);
		   //marker.setIcon(markerImage);
 		   movemarkercallback();
 	  }
 }
 
 
	 
 function move_marker(){
	 
      newpoint = vehicle_animate.shift();
	  
 	var newinfostr='<div id="infowindow_0" class="info-window" style="display: block; top: 118.774px; left: 664.08px;" ><div class="header"><span class="title">'+newpoint.name+'</span><img class="close-btn"></div><div class="content"><div style="margin-bottom:0px;width:300px;"><table class="table-striped" style="margin-bottom:0px;"><tbody><tr><th>Plate Number</th><td>'+newpoint.description+'</td></tr><tr><th>Speed</th><td>'+newpoint.speed+'</td></tr><tr><th>Ignition</th><td>'+newpoint.ign_status+'</td></tr><tr><th>Latitude</th><td>'+newpoint.lat+'</td></tr><tr><th>Longitude</th><td>'+newpoint.logn+'</td></tr><tr><th>Fleet</th><td>'+newpoint.group_name+'</td></tr><tr><th>Driver Name</th><td>'+newpoint.drivername+'</td></tr><tr><th>Driver Phone</th><td>'+newpoint.driverphone+'</td></tr><tr><th>Odometer</th><td>'+newpoint.odometer+'</td></tr></td></tr><tr><th>Server Date</th><td>'+newpoint.created+'</td></tr><tr><th>GPS Date</th><td>'+newpoint.device_timestamp+'</td></tr><tr><th>GPS Status</th><td>'+newpoint.gps_status+'</td></tr></tbody></table></div></div></div>';
	
	
										   
  infowindow.setContent(newinfostr);
 
 	if(typeof newpoint !== "undefined") {
 		transition(newpoint,function(){
 			if(vehicle_animate.length>0){
 				if(run_loop_animation==1){
				    move_marker();
				}
			}
 		});
	}
 } 
		
 //  exceed ideal track button update

 function clear_map_history(clearcallback=""){
      
    for(var a=0; a<markers.length; a++){
    markers[a].setMap(null);    
      }
    markers=[];
    // var end_flag="0";
    marker_img=[];
    clearTimeout(timeout);
    time=0;
    
    history_img=[];
    for(var g=0; g<history_total_length.length; g++){
    history_total_length[g].length=0;   
      }
    history_total_length=[];
    
     $.each(polylinenarray, function (index, val) {
       polylinenarray[index].setMap(null);
     });
     
     
     polylinenarray=[];
     for(var i=0; i<historyvehicleicon.length; i++){
        historyvehicleicon[i].setMap(null);
      }
    historyvehicleicon=[];
    for(var j=0; j<starticon.length; j++){
        starticon[j].setMap(null);
      }
    starticon=[];
    for(var k=0; k<endicon.length; k++){
        endicon[k].setMap(null);
      }
    endicon=[];
    
 
    for(var l=0; l<triangleCoords.length; l++){
          triangleCoords[l].setMap(null);
      } 
    
    
    triangleCoords=[];
    
     if(clearcallback !="")
        clearcallback();
  }

 //  exceed ideal track button update

    
  //  function clear_map_history(clearcallback=""){
	  
	 //  // var end_flag="0";
		// marker_img=[];
		// clearTimeout(timeout);
		// time=0;
		
		// history_img=[];
		// for(var g=0; g<history_total_length.length; g++){
		// history_total_length[g].length=0;		
  //   	}
		// history_total_length=[];
		
	 //   $.each(polylinenarray, function (index, val) {
		//    polylinenarray[index].setMap(null);
	 //   });
	   
	   
	 //   polylinenarray=[];
	 //   for(var i=0; i<historyvehicleicon.length; i++){
  //       historyvehicleicon[i].setMap(null);
  //   	}
		// historyvehicleicon=[];
		// for(var j=0; j<starticon.length; j++){
  //       starticon[j].setMap(null);
  //   	}
		// starticon=[];
		// for(var k=0; k<endicon.length; k++){
  //       endicon[k].setMap(null);
  //   	}
		// endicon=[];
		// for(var l=0; l<triangleCoords.length; l++){
  //       triangleCoords[l].setMap(null);
  //   	}	
		// triangleCoords=[];
		
	 //   if(clearcallback !="")
	 //      clearcallback();
  // }
   
   
  //   function map_history(){	

	 //  $('.loader').fadeIn('slow');
  //     var dom_i="1";
  //     var triangleCoords_off=[];
  //  	  var triangleCoords_ideal=[];
  //  	  var triangleCoords_move=[];
  //  	  var from_date=$('#start_date').val();
  //     var to_date=$('#end_date').val();
  //  	   var vehicle=$('#vehiclesingle_data').val();
	 // currentRequest && currentRequest.readyState != 4 && currentRequest.abort(); // clear previous request
	 
	 // /*if(typeof timeout != 'undefined'){ 
  //      clearTimeout(timeout);
  //  	}*/
  //  	  var currentRequest = null;
   	  
  //      currentRequest = $.ajax({
  //  		   url: "<?=base_url()?>Reports/get_history_map", 
  //  		   data:{vehicleid:vehicle,from:from_date,to:to_date}, 
  //  		   type: 'post',
		//    beforeSend : function()    {          
  //               if(currentRequest != null) {
  //                   currentRequest.abort();
		// 			console.log("aborting previous request");
  //               }
  //           },
  //  		   success: function(result){
  //   		  var responses_data = $.parseJSON(result);
  //  			   var lattitude1="";
  //  			   var lognitude1="";
  //  			   var myLatlng="";
		// 	   var ignition_status="";
		// 	   var speed="";
		// 	   var current_icon="";
		// 	   var marker=new Array();
		// 	   var infowindow=new Array();
		// 	   var contentStrings=new Array();
		// 	   var truck=new Array();
 	// 		   var triangleCoords=new Array();
			   
		// 	   var time=10;
			   
		// 	   var total_length=Object.keys(responses_data.gps_cordinate).length;//getting the count  of the vehicle
		// 	   //console.log(responses_data);
			   
		// 	   //console.log(total_length);
  //  			   if(responses_data.error=="0"){
		// 		   		var bounds = new google.maps.LatLngBounds();
  //   				  var response=responses_data.gps_cordinate;
  //   			      var assets=responses_data.vehicle_external;
					  
  //    				  $.each( response, function( key, data ) {
		// 				  id=key;  
		// 				 var heading = parseInt(data.Heading);
 						   	
		// 				   var ignition="OFF";	
		// 				   if(data.ign_status==1)
		// 			         ignition="ON";
		// 					 if(lognitude1=="" && lattitude1==""){
								 
		// 						 historyLatlngstart = new google.maps.LatLng(data.lattitude,data.lognitude);
		// 						 //console.log("hai");
		// 						 var historystartpoint= new google.maps.Marker({
  //                                                     position: historyLatlngstart,
  //                                                     map: map,	
 	// 												  title: 'Vehicle Starting Point'
  //                                       });
		// 								starticon.push(historystartpoint);
		// 						 }else if(id==(total_length-1)){
									  
		// 						       historyLatlngend = new google.maps.LatLng(data.lattitude,data.lognitude);
		// 							   var endpointimage ={
		// 								url: '<?=base_url()?>lib/images/finishflag.png',
		// 								// This marker is 30 pixels wide by 43 pixels high.
		// 								size: new google.maps.Size(30, 43),
		// 								// The origin for this image is (0, 0).
		// 								origin: new google.maps.Point(0, 0),
		// 								// The anchor for this image is the base of the flagpole at (0, 43).
		// 								anchor: new google.maps.Point(28, 43)
		// 							  };
		// 		                       var historyendpoint= new google.maps.Marker({
  //                                                      position: historyLatlngend,
  //                                                      map: map,													   
		// 											   icon: endpointimage,													   	
		// 											   title: 'Vehicle End Point'                                             
  //                                                 });
		// 										  endicon.push(historyendpoint);
		// 					      }
								  
		// 					 /*if(lattitude1!=data.lattitude && lognitude1!=data.lognitude && lognitude1!="" && lattitude1!=""){*/
		// 					 if(data.ign_status=="1"){
		// 						 if(data.speed < "1" ){
		// 							    if(triangleCoords_ideal.length<1){
 	// 								   		truck ="<?=base_url()?>lib/images/group_icons/"+assets.idle+"#"+id;
		// 								}
 	// 							   }
		// 						  else{
		// 							  	if(triangleCoords_move.length<1){
 	// 								   		truck="<?=base_url()?>lib/images/group_icons/"+assets.run+"#"+id;
		// 								}
 	// 							  }
		// 					  }else{
								  	
		// 								/*			if (triangleCoords_off.length > 0) {
		// 							for (var i = 0; i < triangleCoords_off.length; i++) {
		// 								historyvehicleicon[i].setMap(map);
		// 							}
		// 							}*/
									
		// 						  	if(triangleCoords_off.length<1){
 	// 							   		truck="<?=base_url()?>lib/images/group_icons/"+assets.stop+"#"+id;
		// 							}
 	// 						  }
							 
		// 					  /*}*/
							 
		// 					  lattitude1=data.lattitude;	
		// 					  lognitude1=data.lognitude;
		// 					  speed=data.speed;
		// 					  ignition_status=data.ign_status;
							  
		// 					 // truck="<?=base_url()?>lib/images/group_icons/"+current_icon+"#"+key;
		// 					  //console.log("id: " +truck[key]);
							  
							  
		// 					  myLatlng= new google.maps.LatLng(data.lattitude,data.lognitude);
		// 					  triangleCoords.push(myLatlng);
							  
							  
		// 					  // delete all existing markers first
  //               /*for (var i = 0; i < historyvehicleicon.length; i++) {
  //                   historyvehicleicon[i].setMap(null);

  //               }*/
							  
		// 			  /*for (var i = 0, length = data.length; i < length; i++) {*/
      						  
							  
							  
		// 					  /*if(lattitude1!=data.lattitude && lognitude1!=data.lognitude && lognitude1!="" && lattitude1!=""){*/
		// 						  var markerImage = new google.maps.MarkerImage(truck,							  
		// 							            new google.maps.Size( 52, 52),
  //                                               new google.maps.Point(0, 0),												
  //                                               new google.maps.Point(26,26));
 	// 						   marker[key] = new google.maps.Marker({
		// 									    position: myLatlng,
		// 									    icon:markerImage,
		// 										rotation: heading,
		// 										map: map,
		// 										optimized:false,
		// 										opacity:0,
  //  							   });
							   
		// 					   if(total_length<=500){
		// 					   		time=1800;
		// 							//console.log("below 500");
		// 					   }else if(total_length>500 && total_length<=1000){
		// 					   		time=3800;
		// 							//console.log("between 500 and 1000");
		// 					   }else if(total_length>1000 && total_length<=2000){
		// 					   		time=7800;
		// 							//console.log("between 1000 and 2000");
		// 					   }else if(total_length>2000 && total_length<=3000){
		// 					   		time=16000;
		// 							//console.log("between 2000 and 3000");
		// 					   }else{time+=10;}
							   
							   
		// 					  timeout = setTimeout(function(){ 								        
		// 							 //var img = $('img[src*="#'+key+'"]');
		// 							     history_img = $('img[src="'+marker[key].getIcon().url+'"]').css({
 	// 									 '-webkit-transform' : 'rotate('+ heading +'deg)',
		// 								 '-moz-transform' : 'rotate('+ heading +'deg)',
		// 								 '-ms-transform' : 'rotate('+ heading +'deg)',
		// 								 'transform' : 'rotate('+ heading +'deg)',
		// 							 });  
		// 							 if(id==(total_length-1)){
		// 							 $(".loader").fadeOut('slow'); 
		// 							 }
		// 							  marker[key].setOpacity(1);
		// 							 return false; 
										
  // 							   },time);
 	// 						   // Push your newly created marker into the array:
		// 					  historyvehicleicon.push(marker[key]);
							  
		// 					  history_total_length.push(total_length);
							  
		// 					  bounds.extend(myLatlng);
		// 					   //console.log(historyvehicleicon);
		// 					  var status=data.gps_status=="1"?"Unpluged":"Fixed";
 	// 						  contentStrings[key] ='<div id="infowindow_'+key+'" class="info-window" style="display: block; top: 118.774px; left: 664.08px;" ><div class="header"><span class="title">'+assets.name+'</span><img class="close-btn"></div><div class="content"><div style="margin-bottom:0px;width:300px;"><table class="table-striped" style="margin-bottom:0px;"><tbody><tr><th>Plate Number</th><td>'+assets.description+'</td></tr><tr><th>Speed</th><td>'+data.speed+'</td></tr><tr><th>Ignition</th><td>'+ignition+'</td></tr><tr><th>Latitude</th><td>'+data.lattitude+'</td></tr><tr><th>Longitude</th><td>'+data.lognitude+'</td></tr><tr><th>Fleet</th><td>'+assets.group_name+'</td></tr><tr><th>Driver Name</th><td>'+assets.drivername+'</td></tr><tr><th>Driver Phone</th><td>'+assets.driverphone+' </td></tr><tr><th>Odometer</th><td>'+data.odometer+'</td></tr><tr><th>Server Date</th><td>'+data.created+'</td></tr><tr><th>GPS Date</th><td>'+data.time+'</td></tr><tr><th>GPS Status</th><td>'+status+'</td></tr></tbody></table></div></div></div>';
		// 						//console.log(time);
								
		// 						infowindow[key]= new google.maps.InfoWindow();
		// 				      google.maps.event.addListener( marker[key], 'click', function() {
		// 						  if(previousinfowindow!=""){
		// 													   previousinfowindow.close();
		// 												   }
 	// 								   infowindow[key].close();
		// 							   infowindow[key].setContent(contentStrings[key]);
		// 							   infowindow[key].open(map, marker[key]);
		// 							  previousinfowindow=infowindow[key];
														   
		// 				       });
							
					  
		// 			  /*}*/
		// 		/*	  	if (historyvehicleicon.length > 0) {
  //                   for (var i = 0; i < historyvehicleicon.length; i++) {
  //                       historyvehicleicon[i].setMap(map);
  //                   }
  //               }*/
		// 			  });
  //     						map.fitBounds(bounds); 
		// 					 //console.log("loaded marker length"+marker.length);
						  
		// 			  draw_history_Polyline(triangleCoords,function(){
							  
		// 			  });	 
  //   			   }else{
  //  				              alert("No data is available");
		// 				      $(".loader").fadeOut('fast');
  //  			      }
					   
		//     }
  //     });			 
      
  //  }


  function map_history(primary_id="",vehicle_id=""){  
 
    $('.loader').fadeIn('slow');
      var dom_i="1";
      var triangleCoords_off=[];
      var triangleCoords_ideal=[];
      var triangleCoords_move=[];
      var from_date=$('#start_date').val();
      var to_date=$('#end_date').val();
      var vehicle=$('#vehiclesingle_data').val();
    currentRequest && currentRequest.readyState != 4 && currentRequest.abort(); // clear previous request
      var currentRequest = null;
    
    console.log("current primary id "+primary_id);
    
    if(primary_id!=""){
       var url="<?=base_url()?>Reports/track_in_map";
       data={primary_id:primary_id,vehicle_id:vehicle_id}; 
       $('#myModal').modal('show');
       map=map1;
        
    }else{
      
     
      var url="<?=base_url()?>Reports/get_history_map";
      data={vehicleid:vehicle,from:from_date,to:to_date};
    }

      
       currentRequest = $.ajax({
         url:url, 
         data:data, 
         type: 'post',
       beforeSend : function()    {          
                if(currentRequest != null) {
                    currentRequest.abort();
                 }
            },
         success: function(result){
         
           var responses_data = $.parseJSON(result);
           var lattitude1="";
           var lognitude1="";
           var myLatlng="";
         var ignition_status="";
         var speed="";
         var current_icon="";
         var marker=new Array();
         var infowindow=new Array();
         var contentStrings=new Array();
         var truck=new Array();
         var triangleCoords=new Array();
         var time=10;
         var total_length=Object.keys(responses_data.gps_cordinate).length;//getting the count  of the vehicle
         
         
 
           if(responses_data.error=="0"){
              var bounds = new google.maps.LatLngBounds();
              var response=responses_data.gps_cordinate;
                var assets=responses_data.vehicle_external;
                $.each( response, function( key, data ) {
              id=key;  
              var heading = parseInt(data.Heading);
              var ignition="OFF"; 
               if(data.ign_status==1)
                   ignition="ON";
               if(lognitude1=="" && lattitude1==""){
                 
                 historyLatlngstart = new google.maps.LatLng(data.lattitude,data.lognitude);
                 var historystartpoint= new google.maps.Marker({
                                                      position: historyLatlngstart,
                                                      map: map, 
                            title: 'Vehicle Starting Point'
                                        });
                    starticon.push(historystartpoint);
                 }else if(id==(total_length-1)){
                       historyLatlngend = new google.maps.LatLng(data.lattitude,data.lognitude);
                     var endpointimage ={
                    url: '<?=base_url()?>lib/images/finishflag.png',
                    // This marker is 30 pixels wide by 43 pixels high.
                    size: new google.maps.Size(30, 43),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 43).
                    anchor: new google.maps.Point(28, 43)
                    };
                               var historyendpoint= new google.maps.Marker({
                                                       position: historyLatlngend,
                                                       map: map,                             
                             icon: endpointimage,                             
                             title: 'Vehicle End Point'                                             
                                                  });
                          endicon.push(historyendpoint);
                    }
                  
                  
               if(data.ign_status=="1"){
                 if(data.speed < "1" ){
                      if(triangleCoords_ideal.length<1){
                        truck ="<?=base_url()?>lib/images/group_icons/"+assets.idle+"#"+id;
                    }
                   }
                  else{
                      if(triangleCoords_move.length<1){
                        truck="<?=base_url()?>lib/images/group_icons/"+assets.run+"#"+id;
                    }
                  }
                }else{
                    if(triangleCoords_off.length<1){
                      truck="<?=base_url()?>lib/images/group_icons/"+assets.stop+"#"+id;
                  }
                }
               
                lattitude1=data.lattitude;  
                lognitude1=data.lognitude;
                speed=data.speed;
                ignition_status=data.ign_status;
                
                myLatlng= new google.maps.LatLng(data.lattitude,data.lognitude);
                triangleCoords.push(myLatlng);
 
                var markerImage = new google.maps.MarkerImage(truck,                
                              new google.maps.Size( 52, 52),
                                                new google.maps.Point(0, 0),                        
                                                new google.maps.Point(26,26));
                 marker[key] = new google.maps.Marker({
                          position: myLatlng,
                          icon:markerImage,
                        rotation: heading,
                        map: map,
                        optimized:false,
                        opacity:0,
                   });
                 
                 if(total_length<=500){
                    time=1800;
                  //console.log("below 500");
                 }else if(total_length>500 && total_length<=1000){
                    time=3800;
                  //console.log("between 500 and 1000");
                 }else if(total_length>1000 && total_length<=2000){
                    time=7800;
                  //console.log("between 1000 and 2000");
                 }else if(total_length>2000 && total_length<=3000){
                    time=16000;
                  //console.log("between 2000 and 3000");
                 }else{time+=10;}
                 
                 
                timeout = setTimeout(function(){                        
                   //var img = $('img[src*="#'+key+'"]');
                       history_img = $('img[src="'+marker[key].getIcon().url+'"]').css({
                     '-webkit-transform' : 'rotate('+ heading +'deg)',
                     '-moz-transform' : 'rotate('+ heading +'deg)',
                     '-ms-transform' : 'rotate('+ heading +'deg)',
                     'transform' : 'rotate('+ heading +'deg)',
                   });  
                   if(id==(total_length-1)){
                      $(".loader").fadeOut('slow'); 
                   }
                    marker[key].setOpacity(1);
                   return false; 
                    
                   },time);
                 // Push your newly created marker into the array:
                historyvehicleicon.push(marker[key]);
                history_total_length.push(total_length);
                bounds.extend(myLatlng);
                 //console.log(historyvehicleicon);
                var status=data.gps_status=="1"?"Unpluged":"Fixed";
                contentStrings[key] ='<div id="infowindow_'+key+'" class="info-window" style="display: block; top: 118.774px; left: 664.08px;" ><div class="header"><span class="title">'+assets.name+'</span><img class="close-btn"></div><div class="content"><div style="margin-bottom:0px;width:300px;"><table class="table-striped" style="margin-bottom:0px;"><tbody><tr><th>Plate Number</th><td>'+assets.description+'</td></tr><tr><th>Speed</th><td>'+data.speed+'</td></tr><tr><th>Ignition</th><td>'+ignition+'</td></tr><tr><th>Latitude</th><td>'+data.lattitude+'</td></tr><tr><th>Longitude</th><td>'+data.lognitude+'</td></tr><tr><th>Fleet</th><td>'+assets.group_name+'</td></tr><tr><th>Driver Name</th><td>'+assets.drivername+'</td></tr><tr><th>Driver Phone</th><td>'+assets.driverphone+' </td></tr><tr><th>Odometer</th><td>'+data.odometer+'</td></tr><tr><th>Server Date</th><td>'+data.created+'</td></tr><tr><th>GPS Date</th><td>'+data.time+'</td></tr><tr><th>GPS Status</th><td>'+status+'</td></tr></tbody></table></div></div></div>';
                //console.log(time);
                
                infowindow[key]= new google.maps.InfoWindow();
                    google.maps.event.addListener( marker[key], 'click', function() {
                  if(previousinfowindow!=""){
                   previousinfowindow.close();
                  }
                     infowindow[key].close();
                     infowindow[key].setContent(contentStrings[key]);
                     infowindow[key].open(map, marker[key]);
                     previousinfowindow=infowindow[key];
                               
                   });
            });
                   console.log(bounds);
                  map.fitBounds(bounds); 
               //console.log("loaded marker length"+marker.length);
              
            draw_history_Polyline(triangleCoords,map,function(){
                
            });  
             }else{
                        alert("No data is available");
                  $(".loader").fadeOut('fast');
              }
             
        }
      });      
      
   }
	
	function draw_Polyline_playback(triangleCoords_move,triangleCoords_ideal,triangleCoords_off){
    
     var lineSymbol = {
          path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
      };
	  		wataniyaTriangle_move= new google.maps.Polyline({
                        path: triangleCoords_move,
   				  		/*icons: [{
                              icon: lineSymbol,
   						repeat:'100px',
                              offset: '100%'
                        }],*/
                        geodesic: true,
                        strokeColor: 'green',
                        strokeOpacity: 1,
                        strokeWeight: 3
           });
   	 
   	 wataniyaTriangle_move.setMap(newmap);
   	        wataniyaTriangle_ideal= new google.maps.Polyline({
                        path: triangleCoords_ideal,
   				  		icons: [{
                              icon: lineSymbol,
   							  repeat:'100px',
                              offset: '100%'
                        }],
                        geodesic: true,
                        strokeColor: 'orange',
                        strokeOpacity: 1.0,
                        strokeWeight: 2
                     });	
   	  wataniyaTriangle_ideal.setMap(newmap);
   	  
   	 wataniyaTriangle_off= new google.maps.Polyline({
                        path: triangleCoords_off,
   				  		icons: [{
                        icon: lineSymbol,
   						repeat:'100px',
                              offset: '100%'
                        }],
                        geodesic: true,
                        strokeColor: '#FF0800',
                        strokeOpacity: 1.0,
                        strokeWeight: 2
           });
           wataniyaTriangle_off.setMap(newmap);
   }
 

 
 
  $(document).on("click", '#history_pause',function (event) {
	  pause_flag=1;
	   play_status=""; 
	   $("#history_pause").hide();
		  $("#history_play").show();
  });
  
  
  function DeleteMarker() {
 		    
		     run_loop_animation='0';
		       
			    deltaLat=[];
			   numDeltas=[]
			   position=[];
			   delay=[];
			   deltaLat=[];
			   newpoint=[];
			   truck=[];
			   contentString=[];
			   
			   markerImage=[];
			   current_angle=[];
			   previousangle=[];
			   vehicle_rotate_deg=[];
			   reduced_degree=[];
			     
       };	
  
  function clear_playback_history(clearcallback=""){	
  		DeleteMarker();
  		stop_flag=0;	
		play_status="";
		$("#history_forward").attr("disabled",false);
		$("#history_backward").attr("disabled",false);		
		$.each(polylinenarray, function (index, val) {
                     polylinenarray[index].setMap(null);
                });
	      $("#history_pause").hide();
		  $("#history_play").show();
		  vehicle_animate=[];
		  playbackhistory_line=[];
		  vehicle_animate_full = [];
		  marker1="";
		  marker="";
		  marker_img=[];
		for(var h=0; h<arrowicon.length; h++){
        arrowicon[h].setMap(null);
    	}
		arrowicon=[];
		for(var i=0; i<vehicleicon.length; i++){
        vehicleicon[i].setMap(null);
    	}	
		vehicleicon=[];
		for(var j=0; j<starticon.length; j++){
        starticon[j].setMap(null);
    	}
		starticon=[];
		for(var k=0; k<endicon.length; k++){
        endicon[k].setMap(null);
    	}
		endicon=[];	
		for(var l=0; l<stopplayback_markericon.length; l++){
        stopplayback_markericon[l].setMap(null);
    	}
		stopplayback_markericon=[];
		 newpoint="";
		 myLatlngstart="";
 		  vehicledata="";
		  if(clearcallback !="")
	      clearcallback();
   }
  
 
 $(document).on("click", '#history_stop',function (event) {
	 	  //DeleteMarker();
 	      play_status=""; 
		  stop_flag=1;
		  rotate_status=[];
		  vehicle_rotate_deg=[];
		  previousangle=[];
		  current_angle=[];
		  new_angledeg=[];
	      $("#history_pause").hide();
		  $("#history_play").show();
		  vehicle_animate=[];
		  console.log(vehicle_animate.length);
		  newpoint="";
		  if (marker1 && marker1.setMap) {
      	  // if the marker already exists, remove it from the map
      	  marker1.setMap(null);
    	  }
		  marker.setMap(null);
		  
 		  vehicledata=vehicle_animate_full[0];
 		  myLatlngstart = new google.maps.LatLng(vehicledata.lat,vehicledata.logn);
		  newmap.setCenter(myLatlngstart);
		  newmap.setZoom(13);
 		  var heading = parseInt(vehicledata.Heading);
		 new_angledeg=heading;
		  infowindow = new google.maps.InfoWindow();
		  
		   
		   
 		  if(vehicledata.ign_status=="ON"){
			  
			  if(vehicledata.speed < "1" ){
				   truck="<?=base_url()?>lib/images/group_icons/"+vehicledata.idle+"#historyplay";
			  }
			  else{
				   truck="<?=base_url()?>lib/images/group_icons/"+vehicledata.run+"#historyplay";
			  }
		  }else{
			  truck="<?=base_url()?>lib/images/group_icons/"+vehicledata.stop+"#historyplay";
		  }
										
										
		  var markerImage = new google.maps.MarkerImage(truck,
							 new google.maps.Size( 52, 52),
							 new google.maps.Point(0, 0),
							 new google.maps.Point(26,26));
		  
		  marker = new google.maps.Marker({
						position: myLatlngstart,
						map: newmap,
						icon: markerImage,
						//opacity:0
		  });
		  marker.setOpacity(0);
		  stopplayback_markericon.push(marker);
		  rotateMarker(heading,"1");
						 setTimeout(function(){
							 marker_img =$('img[src="'+truck+'"]');
												 rotateMarker(heading,"1",function(){
													   marker.setOpacity(1);
												 });		   
											  },400);				
										newpoint=vehicledata;
										
		 contentString='<div id="infowindow_0" class="info-window" style="display: block; top: 118.774px; left: 664.08px;" ><div class="header"><span class="title">'+vehicledata.name+'</span><img class="close-btn"></div><div class="content"><div style="margin-bottom:0px;width:300px;"><table class="table-striped" style="margin-bottom:0px;"><tbody><tr><th>Plate Number</th><td>'+vehicledata.description+'</td></tr><tr><th>Speed</th><td>'+vehicledata.speed+'</td></tr><tr><th>Ignition</th><td>'+vehicledata.ign_status+'</td></tr><tr><th>Latitude</th><td>'+vehicledata.lat+'</td></tr><tr><th>Longitude</th><td>'+vehicledata.logn+'</td></tr><tr><th>Fleet</th><td>'+vehicledata.group_name+'</td></tr><tr><th>Driver Name</th><td>'+vehicledata.drivername+'</td></tr><tr><th>Driver Phone</th><td>'+vehicledata.driverphone+'</td></tr> <tr><th>Odometer</th><td>'+vehicledata.odometer+'</td></tr><tr><th>Server Date</th><td>'+vehicledata.created+'</td></tr><tr><th>GPS Date</th><td>'+vehicledata.device_timestamp+'</td></tr><tr><th>GPS Status</th><td>'+vehicledata.gps_status+'</td></tr></tbody></table></div></div></div>';
										  
										  
		    infowindow= new google.maps.InfoWindow();
 		    google.maps.event.addListener( marker, 'click', function() {
				
				//console.log("123");
			   infowindow.setContent(contentString);
			   infowindow.open(map, marker);
		   });
 										
 		  
   });
 
 $(document).on("click", '#history_backward',function (event) {
 	 if(playspeed<1){
		 playspeed=1;
	 }else{
	  playspeed=playspeed-1;
	 }
 	  
	  $("#history_forward").attr("disabled",false);
	 if(playspeed==1){
		 $(this).attr("disabled",true);
	 }
 });
 
  $(document).on("click", '#history_forward',function (event) {
 	  
	  if(playspeed>6){
		  playspeed=6;
	  }
	  
	  $("#history_backward").attr("disabled",false);
	  
	   console.log("history forward clicked "+playspeed);
 	  playspeed=parseInt(playspeed)+1;
	  if(playspeed==6){
		 $(this).attr("disabled",true);
	 }
 });
 
 	 
	  $(document).on("click", '#history_play',function (event) {
		  playspeed=3;
   		  if(vehicle_animate.length==0){
			    $.each( vehicle_animate_full, function( key, vehicledatafromstart ) {
 					 vehicle_animate.push(vehicledatafromstart);
				});
  		  }
		  
 		  play_status="1";
		  $("#history_pause").show();
		  $("#history_play").hide();
		  $('#history_backward').attr('disabled',false);
		  $('#history_forward').attr('disabled',false);
    	  run_loop_animation="1";
		 
 		 if(marker1=="" || stop_flag==1 ){
			 if( pause_flag==1){
				if (marker1 && marker1.setMap) {
				// if the marker already exists, remove it from the map
				marker1.setMap(null);
				}
			 }
  			vehicledata=vehicle_animate[0];
			myLatlng = new google.maps.LatLng(vehicledata.lat,vehicledata.logn);
			//stop_flag=1;
			if(vehicledata.ign_status=="ON"){
				if(vehicledata.speed < "1" ){
				   color="orange";
				}
				else{
				   color="green";
				}
			}else{
			   color="#FF0800";
		    } 
 			 
			icon2= {
				 path: arrow,
				 scale:.06,
				 strokeColor: color,
				 strokeWeight: 1,
				 fillOpacity: 2,
				 fillColor: color,
				 offset: '10%',
				 anchor: new google.maps.Point(130,800) // orig 10,50 back of car, 10,0 front of car, 10,25 center of car
			};
			
			icon2.rotation = vehicledata.heading;
			/*marker1 = new google.maps.Marker({
						position : myLatlng,
						map : newmap,
						icon: icon2,
			});*/
			//arrowicon.push(marker1);
			
   		     newmap.setCenter(myLatlng); 
		     newmap.setZoom(18);
			 
  		 }
 		 move_marker();
		 
		 $(this).addClass("collapse");
		 $("#history_pause").removeClass("collapse");
 	 });
	 


   // function update starts

   function vehicle_map_listing(){
      
      $('.loader').fadeIn('slow');
      
     var playbackhistory_line=new Array(); 
     var from_date=$('#start_date').val();
         var to_date=$('#end_date').val();
         var vehicle=$('#vehiclesingle_data').val();
     var vehicle_exist=$('#vehiclesingle_data').val();
       var start_time = $('#start_date').val();
     var end_time=$('#end_date').val();
     var time = 0;
     var myLatlng = "";
     
     
     var track_pos=new Array();
         //console.log("123");
    currentRequest && currentRequest.readyState != 4 && currentRequest.abort(); // clear previous request    
      var currentRequest = null;   
         
        currentRequest = $.ajax({
              url: "<?=base_url()?>reports/get_map_playback",  
              data:{vehicle:vehicle,from:from_date,to:to_date},
              type: 'post',
          beforeSend : function()    {          
            if(currentRequest != null) {
              currentRequest.abort();
              console.log("aborting previous request");
            }
          },
              success: function(result){
                var response = $.parseJSON(result);
            if(response.error!="1"){
              var total_length=Object.keys(response).length;//getting the count  of the vehicle
            var bounds = new google.maps.LatLngBounds();
              $.each( response, function( key, vehicledata ) {
              
               if(vehicledata.lat!="" & vehicledata.logn!="" & vehicledata.lat!="0" & vehicledata.logn!="0"){
               
                  myLatlng = new google.maps.LatLng(vehicledata.lat,vehicledata.logn);
                  playbackhistory_line.push(myLatlng)
                    vehicle_animate_full.push(vehicledata);
                  vehicle_animate.push(vehicledata);
                    
                  if(key==0){
                    
                    myLatlngstart = new google.maps.LatLng(vehicledata.lat,vehicledata.logn);
                    
                    
                    var heading = parseInt(vehicledata.Heading);
                     infowindow = new google.maps.InfoWindow();
                     infowindows = new google.maps.InfoWindow();
                     
                      var startpoint= new google.maps.Marker({
                                                      position: myLatlngstart,
                                                      map: newmap,  
                            title: 'Vehicle Starting Point'
                                        });
                    starticon.push(startpoint);
                    
                    if(vehicledata.ign_status=="ON"){
                      
                        if(vehicledata.speed < "1" ){
                         truck="<?=base_url()?>lib/images/group_icons/"+vehicledata.idle+"#historyplay";
                      }
                      else{
                         truck="<?=base_url()?>lib/images/group_icons/"+vehicledata.run+"#historyplay";
                      }
                    }else{
                      truck="<?=base_url()?>lib/images/group_icons/"+vehicledata.stop+"#historyplay";
                    }
                    if (marker && marker.setMap) {
                      marker.setMap(null);
                      }
                    
                      var markerImage = new google.maps.MarkerImage(truck,
                               new google.maps.Size( 52, 52),
                                                           new google.maps.Point(0, 0),
                                                           new google.maps.Point(26,26));
                    
                      marker = new google.maps.Marker({
                            position: myLatlngstart,
                            map: newmap,
                            icon: markerImage,
                            optimized: false,
                           // opacity:0
                      });
                    newmap.setCenter(myLatlngstart);
                    new_angledeg=heading;
                    previous_data=new Array();
                     previous_data["lat"]=vehicledata.lat;
                     previous_data["logn"]=vehicledata.logn;
                     latest_lat=vehicledata.lat;
                     latest_logn=vehicledata.logn;
                    //newmap.setZoom(10);
                    // Push your newly created marker into the array:
                    vehicleicon.push(marker);
                    marker.setOpacity(0);
                      contentString='<div id="infowindow_'+key+'" class="info-window" style="display: block; top: 118.774px; left: 664.08px;" ><div class="header"><span class="title">'+vehicledata.name+'</span><img class="close-btn"></div><div class="content"><div style="margin-bottom:0px;width:300px;"><table class="table-striped" style="margin-bottom:0px;"><tbody><tr><th>Plate Number</th><td>'+vehicledata.description+'</td></tr><tr><th>Speed</th><td>'+vehicledata.speed+'</td></tr><tr><th>Ignition</th><td>'+vehicledata.ign_status+'</td></tr><tr><th>Latitude</th><td>'+vehicledata.lat+'</td></tr><tr><th>Longitude</th><td>'+vehicledata.logn+'</td></tr><tr><th>Fleet</th><td>'+vehicledata.group_name+'</td></tr><tr><th>Driver Name</th><td>'+vehicledata.drivername+'</td></tr><tr><th>Driver Phone</th><td>'+vehicledata.driverphone+'</td></tr> <tr><th>Odometer</th><td>'+vehicledata.odometer+'</td></tr><tr><th>Server Date</th><td>'+vehicledata.created+'</td></tr><tr><th>GPS Date</th><td>'+vehicledata.device_timestamp+'</td></tr><tr><th>GPS Status</th><td>'+vehicledata.gps_status+'</td></tr></tbody></table></div></div></div>';
                      
                      
                       
                        //rotateMarker(heading,"1");
                      
                      infowindows.setContent(vehicledata.name);

                      google.maps.event.addListener( marker, 'mouseover', function() {
                                
                                   infowindows.open(map, marker);
                                  previousinfowindow1=infowindows;
                                
                               });
                               
                               google.maps.event.addListener( marker, 'mouseout', function() {
                                infowindows.close();
                                 previousinfowindow1="";
                               });
                      
                      infowindow= new google.maps.InfoWindow();
                       
                       google.maps.event.addListener( marker, 'click', function() {
                         infowindows.close();
                         infowindow.setContent(contentString);
                         infowindow.open(map, marker);
                       });
                      
                      setTimeout(function(){
                        marker_img =$('img[src="'+truck+'"]');
                         rotateMarker(heading,"1",function(){
                             marker.setOpacity(1);
                         });       
                        },300);
                        
                    //current_angle=heading;
                          
                    newpoint=vehicledata;
                  }else if(key==(total_length-1)){
                    
                       myLatlngend = new google.maps.LatLng(vehicledata.lat,vehicledata.logn);
                     var endpointimage ={
                    url: '<?=base_url()?>lib/images/finishflag.png',
                    // This marker is 30 pixels wide by 43 pixels high.
                    size: new google.maps.Size(30, 43),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 43).
                    anchor: new google.maps.Point(28, 43)
                    };
                               var endpoint= new google.maps.Marker({
                                                       position: myLatlngend,
                                                       map: newmap,                            
                             icon: endpointimage, 
                             title: 'Vehicle End Point'                                             
                                                  });
                          endicon.push(endpoint);
                    draw_Polyline(playbackhistory_line,"#0000CD");      
                          
                    }
                  
                  }
                bounds.extend(myLatlng);
                });
            
            newmap.fitBounds(bounds);
            $('.loader').fadeOut('slow');
          }else{            
            $('.loader').fadeOut('fast');
            $('#play_stop').hide();
            alert("No data found!!");
            
          }
            
           },error: function (xhr, ajaxOptions, thrownError) {
            alert('FAILED! ERROR: ' + errorThrown);
                }
          });
       
     }

   // function update ends

	 
 	 
 	//   function vehicle_map_listing(){
		  
		//   $('.loader').fadeIn('slow');
		  
		//  var playbackhistory_line=new Array(); 
 	// 	 var from_date=$('#start_date').val();
  //        var to_date=$('#end_date').val();
  //  	     var vehicle=$('#vehiclesingle_data').val();
		//  var vehicle_exist=$('#vehiclesingle_data').val();
  //   	 var start_time = $('#start_date').val();
		//  var end_time=$('#end_date').val();
		//  var time = 0;
		//  var myLatlng = "";
		 
		 
 	// 	 var track_pos=new Array();
		// 		 //console.log("123");
		// currentRequest && currentRequest.readyState != 4 && currentRequest.abort(); // clear previous request		 
		// 	var currentRequest = null;	 
				 
  //       currentRequest = $.ajax({
 	// 		        url: "<?=base_url()?>reports/get_map_playback",  
		// 	        data:{vehicle:vehicle,from:from_date,to:to_date},
		// 	        type: 'post',
		// 			beforeSend : function()    {          
		// 			  if(currentRequest != null) {
		// 				  currentRequest.abort();
		// 				  console.log("aborting previous request");
		// 			  }
		// 		  },
		// 	        success: function(result){
						
						 
						
  //     				  var response = $.parseJSON(result);
		// 			  if(response.error!="1"){
  // 					  var total_length=Object.keys(response).length;//getting the count  of the vehicle
		// 			  var bounds = new google.maps.LatLngBounds();
  //    				  $.each( response, function( key, vehicledata ) {
						  
  //    					 if(vehicledata.lat!="" & vehicledata.logn!="" & vehicledata.lat!="0" & vehicledata.logn!="0"){
							 
		// 					 	  myLatlng = new google.maps.LatLng(vehicledata.lat,vehicledata.logn);
		// 						  playbackhistory_line.push(myLatlng)
  //  								  vehicle_animate_full.push(vehicledata);
		// 						  vehicle_animate.push(vehicledata);
   								  
		// 						  if(key==0){
									  
		// 							  myLatlngstart = new google.maps.LatLng(vehicledata.lat,vehicledata.logn);
									  
									  
		// 							  var heading = parseInt(vehicledata.Heading);
		// 							   infowindow = new google.maps.InfoWindow();
		// 							   infowindows = new google.maps.InfoWindow();
									   
 	// 								    var startpoint= new google.maps.Marker({
  //                                                     position: myLatlngstart,
  //                                                     map: newmap,	
 	// 												  title: 'Vehicle Starting Point'
  //                                       });
		// 								starticon.push(startpoint);
										
		// 								if(vehicledata.ign_status=="ON"){
											
		// 								    if(vehicledata.speed < "1" ){
 	// 											 truck="<?=base_url()?>lib/images/group_icons/"+vehicledata.idle+"#historyplay";
 	// 										}
		// 									else{
 	// 											 truck="<?=base_url()?>lib/images/group_icons/"+vehicledata.run+"#historyplay";
 	// 										}
 	// 									}else{
 	// 										truck="<?=base_url()?>lib/images/group_icons/"+vehicledata.stop+"#historyplay";
 	// 									}
		// 								if (marker && marker.setMap) {
		// 									marker.setMap(null);
		// 								  }
										
  // 										var markerImage = new google.maps.MarkerImage(truck,
		// 												   new google.maps.Size( 52, 52),
  //                                                          new google.maps.Point(0, 0),
  //                                                          new google.maps.Point(26,26));
 										
		// 							    marker = new google.maps.Marker({
		// 											  position: myLatlngstart,
		// 											  map: newmap,
		// 											  icon: markerImage,
		// 											  optimized: false,
		// 											 // opacity:0
		// 							    });
		// 								newmap.setCenter(myLatlngstart);
		// 								new_angledeg=heading;
		// 								previous_data=new Array();
		// 								 previous_data["lat"]=vehicledata.lat;
		// 								 previous_data["logn"]=vehicledata.logn;
		// 								 latest_lat=vehicledata.lat;
		// 								 latest_logn=vehicledata.logn;
		// 								//newmap.setZoom(10);
		// 								// Push your newly created marker into the array:
		// 								vehicleicon.push(marker);
		// 								marker.setOpacity(0);
		// 								  contentString='<div id="infowindow_'+key+'" class="info-window" style="display: block; top: 118.774px; left: 664.08px;" ><div class="header"><span class="title">'+vehicledata.name+'</span><img class="close-btn"></div><div class="content"><div style="margin-bottom:0px;width:300px;"><table class="table-striped" style="margin-bottom:0px;"><tbody><tr><th>Plate Number</th><td>'+vehicledata.description+'</td></tr><tr><th>Speed</th><td>'+vehicledata.speed+'</td></tr><tr><th>Ignition</th><td>'+vehicledata.ign_status+'</td></tr><tr><th>Latitude</th><td>'+vehicledata.lat+'</td></tr><tr><th>Longitude</th><td>'+vehicledata.logn+'</td></tr><tr><th>Fleet</th><td>'+vehicledata.group_name+'</td></tr><tr><th>Driver Name</th><td>'+vehicledata.drivername+'</td></tr><tr><th>Driver Phone</th><td>'+vehicledata.driverphone+'</td></tr> <tr><th>Odometer</th><td>'+vehicledata.odometer+'</td></tr><tr><th>Server Date</th><td>'+vehicledata.created+'</td></tr><tr><th>GPS Date</th><td>'+vehicledata.device_timestamp+'</td></tr><tr><th>GPS Status</th><td>'+vehicledata.gps_status+'</td></tr></tbody></table></div></div></div>';
										  
										  
 	// 									   infowindow= new google.maps.InfoWindow();
										   
 	// 									   google.maps.event.addListener( marker, 'click', function() {
		// 									   infowindow.setContent(contentString);
		// 									   infowindow.open(map, marker);
		// 								   });
		// 								    //rotateMarker(heading,"1");
											
		// 									setTimeout(function(){
		// 										marker_img =$('img[src="'+truck+'"]');
		// 										 rotateMarker(heading,"1",function(){
		// 											   marker.setOpacity(1);
		// 										 });		   
		// 									  },300);
											  
 	// 									//current_angle=heading;
													
		// 								newpoint=vehicledata;
 	// 							  }else if(key==(total_length-1)){
									  
		// 						       myLatlngend = new google.maps.LatLng(vehicledata.lat,vehicledata.logn);
		// 							   var endpointimage ={
		// 								url: '<?=base_url()?>lib/images/finishflag.png',
		// 								// This marker is 30 pixels wide by 43 pixels high.
		// 								size: new google.maps.Size(30, 43),
		// 								// The origin for this image is (0, 0).
		// 								origin: new google.maps.Point(0, 0),
		// 								// The anchor for this image is the base of the flagpole at (0, 43).
		// 								anchor: new google.maps.Point(28, 43)
		// 							  };
		// 		                       var endpoint= new google.maps.Marker({
  //                                                      position: myLatlngend,
  //                                                      map: newmap,													   
		// 											   icon: endpointimage,	
		// 											   title: 'Vehicle End Point'                                             
  //                                                 });
		// 										  endicon.push(endpoint);
 	// 									draw_Polyline(playbackhistory_line,"#0000CD");		  
												  
		// 					      }
 								  
  //  							  }
		// 					  bounds.extend(myLatlng);
  //      					});
						
		// 				newmap.fitBounds(bounds);
		// 				$('.loader').fadeOut('slow');
		// 			}else{						
		// 				$('.loader').fadeOut('fast');
		// 				$('#play_stop').hide();
		// 				alert("No data found!!");
						
		// 			}
						
  //  			   },error: function (xhr, ajaxOptions, thrownError) {
		// 		    alert('FAILED! ERROR: ' + errorThrown);
  //               }
	 //        });
			 
 	// 	 } 
	 
	  function draw_Polyline(cordinate,color){
         var lineSymbol = {};
   	     wataniyaTriangle= new google.maps.Polyline({
                      path: cordinate,
					  icons: [{
                             icon: lineSymbol,
                             offset: '100%'
                      }],
                      geodesic: true,
                      strokeColor: color,
                      strokeOpacity: 1.0,
                      strokeWeight: 2
                   });			
         wataniyaTriangle.setMap(newmap);
		 polylinenarray.push(wataniyaTriangle);
      }


      // changed for geoffence to geofence
 	  
	   function draw_history_Polyline(cordinate,current_map,mapcallback){
      
      color='green';
        var lineSymbol = {};
          wataniyaTriangle= new google.maps.Polyline({
                      path: cordinate,
            icons: [{
                             icon: lineSymbol,
                             offset: '100%'
                      }],
                      geodesic: true,
                      strokeColor: color,
                      strokeOpacity: 1.0,
                      strokeWeight: 2
                   });      
           wataniyaTriangle.setMap(current_map);
      polylinenarray.push(wataniyaTriangle);
      mapcallback();
     
       }
	   
	   // changed for geoffence to geofence
	   
	 
	  function rotateMarker(degree,status="",rotatecallback=""){
		  
		   if(vehicle_rotate_deg==""){
				 vehicle_rotate_deg="";
 				 reduced_degree=new Array();
			 }
 		 		if((degree!=vehicle_rotate_deg && parseFloat(degree)!=0) || status!="" ){
				  
    			 vehicle_rotate_deg=parseFloat(degree);
		      
			  if(current_angle==""){
				  //console.log(current_angle + "current angle");
				  current_angle=parseFloat(vehicle_rotate_deg);
				  reduced_degree="";
				  unsigned_difference=0;
			  }else{
				   difference=parseFloat(vehicle_rotate_deg-previousangle);
 				   unsigned_difference=parseFloat(Math.abs(difference));
				  if(unsigned_difference>230){
					 if(difference>0){
					   reduced_degree=parseFloat(360-vehicle_rotate_deg);
							  if(current_angle<0 || current_angle >230 ){
								  //console.log("entered difference 0 greater than 230 and below 0 or greater than 230");
 								  current_angle=Math.round(parseFloat(current_angle-(reduced_degree+previousangle)));
								  
							  }else{
								  current_angle=Math.round(parseFloat(0-reduced_degree));
								  //console.log("Else entered greater than 230 and below 0 or greater than 230");
							  }
 						 }else{
							 reduced_degree=parseFloat(360-previousangle);
								  current_angle=Math.round(parseFloat(current_angle+(reduced_degree+vehicle_rotate_deg)));
								  //console.log("entered difference 0 Else greater than 230 and below 0 or greater than 230");
 						 }
						 
					 }else{
						 
						  if(difference>0){
							  //console.log("entered between 0-230");
							  current_angle=Math.round(parseFloat(current_angle)+unsigned_difference);
							  
						  }else{
							  //console.log("entered Else between 0-230");
							  current_angle=Math.round(parseFloat(current_angle)-unsigned_difference);
						  }
						 
					 }
				 }
				 if(unsigned_difference<"90"){
					var time="130ms";
				 }else{
					var time="150ms"; 
				 }
    		 //marker_img =$('img[src*="#historyplay"]');
			 
			 /*if(Math.abs(current_angle-previous_rotate_angle)<5){
					
					current_angle=previous_rotate_angle;
				}*/
			 
			 if(typeof(marker_img)!="undefined"){
				 
				 if(status==""){
   			        marker_img.css({
					 
					  'transform' : 'rotate('+ current_angle +'deg)',
					   'transition': 'transform '+time+' linear' 
					  //'transform': 'rotate('+degree+'deg)'
                    });
				 }else{
					 marker_img.css({
								  '-webkit-transform' : 'rotate('+ current_angle +'deg)'});
				 }
 			 }
			 
				}
				rotate_status="1";
			 previousangle=vehicle_rotate_deg;
				previous_rotate_angle=current_angle;
 			 
			 if(rotatecallback!=""){
			       rotatecallback();
				}
       }

       // update starts

       $(document).on("click", '.track', function (event) {
    var id=(this.id).split("_");
    var vehicle_id=id[1];
    var primary_id=$(this).attr("data-id");
    var geofenceids=($(this).attr("data-option")).split(",");
      clear_map_history(function(){
           geoffence[geofenceids[0]]=geofenceids[0];
         geoffence[geofenceids[1]]=geofenceids[1];
         $("#geoffenceid_"+geofenceids[0]).prop("checked",true);
         $("#geoffenceid_"+geofenceids[1]).prop("checked",true);    
         showgeoffence();
         map_history(primary_id,vehicle_id);
       });
    });
  
  $(document).on("click", '.exceed-idle-track', function (event) {
    var id=(this.id).split("_");
    var vehicle_id=id[1];
    var heading=$(this).attr("data-id");
    
    var position=($(this).attr("data-option")).split(",");
      clear_map_history(function(){     
      $.ajax({
              url: "<?=base_url()?>reports/track_exceed_idle_map",  
              data:{vehicle_id:vehicle_id},
              type: 'post',
              success: function(result){  
          var data = $.parseJSON(result); 
          truck="<?=base_url()?>lib/images/group_icons/"+data.gps_coordinates.idle_icon+"#"+vehicle_id;         
          console.log(data);
          
          myLatlng= new google.maps.LatLng(position[0],position[1]);
          
                //triangleCoords.push(myLatlng); 
                var map = map1;
                var markerImage = new google.maps.MarkerImage(truck,                
                              new google.maps.Size( 52, 52),
                                                new google.maps.Point(0, 0),                        
                                                new google.maps.Point(26,26));
                 var marker = new google.maps.Marker({
                          position: myLatlng,
                          icon:markerImage,
                        rotation: heading,
                        opacity:0,                        
                        map: map,                       
                        optimized: false,                       
                   });
                 setTimeout(function(){
                 marker_img =$('img[src="'+truck+'"]');
                         rotateMarker(heading,"1",function(){
                             marker.setOpacity(1);
                         });  
                         var infowindow = new google.maps.InfoWindow();
                infowindow.setContent(data.gps_coordinates.name);
                          infowindow.open(map, marker);
                },100);
                map.setCenter(myLatlng);
          $('#myModal').modal('show');
          markers.push(marker);
            showgeoffence();
          
          }
        });
      });
  });

       // update ends
    
    $(document).on("change", '#Report', function (event) {
		   $('#exeed_idle_div').hide();
   		 $('#Main_summary_div').hide();
   		 $('#map_history').hide();
   		 $('#alert_type_report_div').hide();
   		 $('#Maintatnce_div').hide();
   		 $('#full_summary_div').hide();
   		 $('#map_playback').hide();
		   $('#unplug_report_div').hide();
		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		   $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide(); 
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       $('#geofence_report_div').hide();  // geofence_report_div hide
       $('#geofence_time_div').hide();    // geofence_time_div hide
       $('#woqode_div').hide();    // woqode_div hide

     var type=$(this).val();
	   clear_map_history();
     // geoffence_show update
     $("#div_table").hide("fast");
     $("#div_table2").hide("fast");
     // geoffence_show update
     clear_playback_history();
     if(type=="1"){
   	  $("#stop_duration_div").show();
   	   $("#alert_type").hide();
   	  }else if(type=="4"){
   	  $("#stop_duration_div").hide();
   	  $("#alert_type").show();
     }else{
   	   $("#alert_type").hide();
   	   $("#stop_duration_div").hide();
     }
	 
	 if(type=="1" || type=="4" || type=="14" || type=="15" || type=="16" || type=="18"){ //Geofence time update
		 $(".geoffence_multi_select").show();
	 }else{
		$(".geoffence_multi_select").hide(); 
		 }

    if(type == "1")
    {
      $(".geoffence_multi_select_exclude").show();
    }
    else
    {
      $(".geoffence_multi_select_exclude").hide(); 
    }
	 
	 
	 if(type=="9"){
	  $("#delay_duration_div").show();
	 }else{$("#delay_duration_div").hide();}
	 
     if(type=="3"){
   	  $("#bulk_vehicle").hide();
   	  $("#single_vehicle").show();
   	  $("#map_history").show(); 
   	  $("#map_playback").hide();
     }else if(type=="7"){		 
   	  $("#bulk_vehicle").hide();
   	  $("#single_vehicle").show();
	  $("#map_history").hide(); 	  
   	  $("#map_playback").show(); 
     }else{
   	  $("#bulk_vehicle").show();
   	  $("#single_vehicle").hide();
   	  $("#map_history").hide(); 
   	  $("#map_playback").hide(); 
     }
     
     if(type=="12" || type=="5" ){
   	  $("#starting-date").hide();
	  $("#ending-date").hide();
	 }else{
   	  $("#starting-date").show();
	  $("#ending-date").show();
	 }
	 
	 if(type=="14"){
   	  $("#speed_alert_select").show();
	 }else{
   	  $("#speed_alert_select").hide();
	 }

   // Geofence To Geofence & Geofence To Geofence Summary update starts
   if(type=="17" || type=="19"){
      $('.geoffence_single_select_from').show();
      $('.geoffence_single_select_to').show();
    }else{
      $('.geoffence_single_select_from').hide();
      $('.geoffence_single_select_to').hide();
    }
    // Geofence To Geofence & Geofence To Geofence Summary update ends
	  
   });
   
   
     $(document).on("click", '.vehicle_menu', function (event) {
      
      if ( $("#group_list").is( ":hidden" ) ) {
   	   
   	   $("#group_list").slideDown( "slow");
      }/*else{
   	   $("#group_list" ).slideUp( "slow");
      }*/
     });
       
     $(document).on("click", '.groups_data', function (event) {      
   	  var id=$(this).attr("data-id");
	  if ($(event.target).is('input')) { //if clicked on input element don't do anything
                   return
       }
       if($("#vehiclecontainer"+id ).is( ":hidden" ) ) {
   		   $(this).children(".node").removeClass("inactive");
   	       $(this).children(".node").addClass("active");
   		   $("#vehiclecontainer"+id ).slideDown( "slow");
   	   if( $(this).find("input").prop('checked')){
   	        $(".child"+id).prop('checked',true);
   	   }
   	   
      }else{
   
    		  // if(!$(this).find("input").prop('checked')){
   		       $(this).children(".node").addClass("inactive");
   	       $(this).children(".node").removeClass(" active");
   	       $("#vehiclecontainer"+id ).slideUp( "slow");
   		  // $(".child"+id).prop('checked',false);
   	  // }
      }
     });
	 
	 
	   
  

  function nth(d) {
  if (d > 3 && d < 21) return '<sup>th</sup>'; 
  switch (d % 10) {
    case 1:  return "<sup>st</sup>";
    case 2:  return "<sup>nd</sup>";
    case 3:  return "<sup>rd</sup>";
    default: return "<sup>th</sup>";
  }
 }
 
 function get_time_format(datetime){
	 
	  if(datetime!="")
	       var fortnightAway = new Date(datetime);
		 else
		   var fortnightAway = new Date();
 	   
 	  if(fortnightAway.getHours()>=12){
          var hour = parseInt(fortnightAway.getHours()) - 12;
		  if(hour==0)
		    hour=12;
          var amPm = "PM";
      }else {
          var hour = fortnightAway.getHours(); 
		  if(hour==0)
		    hour=12;
          var amPm = "AM";
      }
	  var minute=fortnightAway.getMinutes()
	  
 	  hour=hour>9?hour:"0"+hour;
	  minute=minute>9?minute:"0"+minute;
	  
	  var time_format=hour+":"+minute+" "+amPm;
	  
	  return time_format
 	
 }
 
 function get_date_format(datetime){
	 
	     if(datetime!="")
	       var fortnightAway = new Date(datetime);
		 else
		   var fortnightAway = new Date();
		 
         var date = fortnightAway.getDate();
          month = ["January","February","March","April","May","June","July",
           "August","September","October","November","December"][fortnightAway.getMonth()];
		
		var format_dateis=   date + nth(date) + " " +month + " " + fortnightAway.getFullYear();
 		    return  format_dateis;
 }
 function getBase64Image(img) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);
    return canvas.toDataURL("image/png");
}
	
	  $(document).on("click", '#refresh', function (event) {
		   $('#exeed_idle_div').hide();
 		   $('#Main_summary_div').hide();
 		   $('#map_history').hide();
 		   $('#alert_type_report_div').hide();
 		   $('#Maintatnce_div').hide();
 		   $('#full_summary_div').hide();
 		   $('#map_playback').hide();
		   $('#unplug_report_div').hide();
		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		   $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide(); 
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       $('#geofence_report_div').hide(); //geofence_report_div hide starts
		   $('#commentForm')[0].reset();
		   $('label.error1').hide();
		   $('label.error').hide();
		  
		   $("#Geoffence_name").multiselect('refresh');
		   $('.selectpicker').selectpicker('refresh');
		  
		   $.each(vehicle, function(id, val) {
 			   delete vehicle[id];
            });
  		   $('select').val('select').trigger('change');
		   $("select").prop("selectedIndex", 0);
		   
		   $('#datetimepicker1').data("DateTimePicker").clear();
		   $('#datetimepicker2').data("DateTimePicker").clear();
		   
		   $('ul.multiselect-container>li').each(function(element) {
                $(this).removeClass("active");
           });
		   $("#Geoffence_name option:selected").removeAttr("selected");
		   
		   	current_request.abort();
  
	  });
     
	 
    $(document).on("click", '#submit', function (event) {
		
 		event.preventDefault();
 		
     	if($('#bulk_vehicle').find('input[type=checkbox]:checked').length == 0)
        {
 		    $('#bulk_vehicle_error').css("display", "block");
        }else{
		    $('#bulk_vehicle_error').css("display", "none");
		}
		
		if($('#alert_type').find('input[type=checkbox]:checked').length == 0)
        {
 		    $('#alert_field-error').css("display", "block");
        }else{
		    $('#alert_field-error').css("display", "none");
		}
		geoffence_select=new Array();
		var Report=$("#Report").val();
		console.log(geoffence_select);
		
		console.log($("#Geoffence_name").val());
		geoffence_select   = $("#Geoffence_name").val();
    geoffence_unselect = $("#Geoffence_name_exclude").val();
		console.log(geoffence_select);
		//$.each($("#Geoffence_name option:selected"), function(){     
		  // console.log("current geoffence value is "+$(this).val()) ;      
               //geoffence_select.push($(this).val());
         //});
		
 if($("#commentForm").valid() && (( !($('#bulk_vehicle').find('input[type=checkbox]:checked').length == 0) ) || Report=="7" || Report=="3") && 
 ((!($('#alert_type').find('input[type=checkbox]:checked').length == 0) && Report=="4")||(Report!="4"))){
		  
		  
         if($("#Report").val()!="7" && $("#Report").val()!="3"){
			   var vehicle_new = vehicle.filter(function(v){return v!==''});
 		 }
	
 	
         var from_date=$('#start_date').val();
         var to_date=$('#end_date').val();
		 var speed=$('#speed_alert_data').val();
		 
		 
		 var from_date_display_format=get_date_format(from_date)+ " " +get_time_format(from_date);
		 var to_date_display_format=get_date_format(to_date)+ " " +get_time_format(to_date);
		 
		 var from_date_download_format=from_date_display_format.replace("<sup>","");
		 from_date_download_format=from_date_download_format.replace("</sup>","");
		 var to_date_download_format=to_date_display_format.replace("<sup>","");
		   to_date_download_format=to_date_download_format.replace("</sup>","");
		 
		 
		 var generated_on=get_date_format("")+ " " +get_time_format("");
		 
		 var generated_on_download=generated_on.replace("<sup>","");
		 generated_on_download=generated_on_download.replace("</sup>","");
		 
		 var company_name="Al Wataniya Concrete";
		 var Website="watancon.com";
		 var telephone="Tel - 974 44838751/2,Fax 974 44832334";
		 var period='For The Period :'+from_date_download_format+' to '+to_date_download_format;
		 var generated_time='Report generated on  : '+ generated_on_download;
		 
		 
 		 
       if($("#Report").val()=="1"){
			 
  	   $('#exeed_idle_div').show();
 		   $('#Main_summary_div').hide();
 		   $('#map_history').hide();
 		   $('#alert_type_report_div').hide();
 		   $('#Maintatnce_div').hide();
 		   $('#full_summary_div').hide();
 		   $('#map_playback').hide();
		   $('#unplug_report_div').hide();
		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		   $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide(); 
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		   var report_name="Exceed Idle Report";
		   var file_name='Exceed Idle Report '+from_date_download_format+' to '+to_date_download_format;
		  
		   
		    $("#exeed_idle_time_period").html(from_date_display_format+ " to "+to_date_display_format);
        // table && table.readyState != 4 && table.abort(); // clear previous request
        //   var table= null;
		   
      		  var table=$('#exeed_idle').DataTable({
					//"fixedHeader": true,
					"scrollY":'64vh',
	  				"deferRender":true,
	  				"scrollX": true,
   		            "destroy": true,
                    "processing": true,
					//"responsive": true,
                   // "serverSide": true,
   		            "Paginate": true,
					"lengthMenu": [25, 50, 100, 500, 1000],
                    "pageLength": 25,
   	                "ajax": {
   			           "url": "<?=base_url()?>Reports/idle_exeed",  
   				       "type": "POST",
					   "beforeSend": function() {
               if(table != null) {
                    table.abort();
                  }
             /* if (table.hasOwnProperty('settings')) {
                console.log("have own property");
                 var current_request=table.settings()[0].jqXHR;
                                  table.settings()[0].jqXHR.abort();
                            }*/
                              
                       },
   	                   "data":function(data) {
                              data.from =from_date;
                              data.to =to_date;
   					          data.stop_duration = $('#stop_duration').val();
   						      data.vehicle_data = vehicle_new.toString();
							  data.geoffence_select = geoffence_select;
                data.geoffence_unselect   = geoffence_unselect;
                        }
   				  ,
                   dataFilter: function(data){
					   
					    
                      var json = jQuery.parseJSON( data );
                       json.recordsTotal = json.recordsTotal;
                      json.recordsFiltered = json.recordsFiltered;
                      json.data = json.data;
            
                      return JSON.stringify( json ); // return JSON string
                  }
      			 },
   		 
                   "columns": [
                      { "data": "asset_code" },
                      { "data": "description" },
                      { "data": "group_name" },
                      { "data": "stopped" },
                      { "data": "start_date" },
                      { "data": "end_date" },
					  { "data": "lattitude" },
                      { "data": "lognitude" },
   		        	  { "data": "geofence" },
                  { "data": "track" },

                   ],
				   "columnDefs": [
					  { className: "split_time", "targets": [ 3 ] }
					],
   			 	dom: 'lBfrtip',
          		 buttons: [ 
          		 			{
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                        // postfixButtons: ['colvisRestore']
                    },
          		 			{
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
                      exportOptions: {
                    columns: ':visible'
                },
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							 exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename: file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
                 exportOptions: {
                    columns: ':visible'
                },
						       title:'',
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
					]
					});
				 
         }else  if($("#Report").val()=="2"){
   		  
   		   $('#exeed_idle_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Main_summary_div').show();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		     $('#unplug_report_div').hide();
		     $('#delay_report_div').hide();  
		     $('#database_full_report_div').hide();
		     $('#duplicate_entry_report_div').hide();
		     $('#wrong_data_report_div').hide(); 
		     $('#device_idle_div').hide();
		     $('#speed_alert_div').hide();
 			   $('#nodata_alert_div').hide();
		     $('#wrong_speed_alert_div').hide();
         //geofence_report_div geofence_time_div starts
         $('#geofence_report_div').hide();
         $('#geofence_time_div').hide();
         //geofence_report_div geofence_time_div ends
         $('#woqode_div').hide();
    	   $("#Main_summary_time_period").html(from_date_display_format+ " to "+to_date_display_format);
		     var report_name="Main Report";
		     var file_name='Main Report '+from_date_download_format+' to '+to_date_download_format;
    		   
   	      $('#Main_summary').DataTable({
			  //"responsive": true,
			 // "fixedHeader":true,
 			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
			  "fixedColumns": {
                            "leftColumns": 2,
                       },
			  //"scrollCollapse": true,
			  
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/main_report",  
   				  "type": "POST",
   	              "data":function(data) {
                              data.from = from_date;
                              data.to = to_date;
   							data.vehicle_data = vehicle_new.toString();
                        }
      			 },  
                    "columns": [
                      { "data": "asset_code" },
                      { "data": "description" },
                      { "data": "group_name" },
   				      { "data": "last_odometer" },
   				      { "data": "total_odometer" },
                      { "data": "total_workinghrs" },
                      { "data": "total_stophrs" },
   		              { "data": "total_idletime" },
   				      { "data": "total_running" },
   				      { "data": "totalignitionon" },
   				      { "data": "totalignitionoff" },
   					  { "data": "totalpluged" },
   				      { "data": "totalunpluged" },
					  { "data": "device_status"},
					  { "data": "device_time"}
   				
                   ],
   			 dom: 'lBfrtip',
          		 buttons: [
                    {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                    }, 
                    {
					           extend: 'excelHtml5',
				             text: 'Save in EXCEL',
    							   title: report_name,
    							   messageTop: period,
     							   filename: file_name ,
                      exportOptions: {
                      columns: ':visible'
                     },
 							       customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							   exportOptions: {
                      columns: ':visible'
                     },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
                 exportOptions: {
                    columns: ':visible'
                },
						       title:'',
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					]
                });
   	    }else  if($("#Report").val()=="3"){
			
   		   $('#exeed_idle_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#Main_summary_div').hide();
   		   $('#map_history').show();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		   $('#unplug_report_div').hide();
		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		   $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide();
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide(); 
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		   clear_map_history(function(){
			 map_history();
			    
		   });
   	}else  if($("#Report").val()=="4"){
   			 $('#exeed_idle_div').hide();
   		 $('#Main_summary_div').hide();
   		 $('#map_history').hide();
   		 $('#full_summary_div').hide();
   		 $('#Maintatnce_div').hide();
   		 $('#alert_type_report_div').show();
   		 $('#map_playback').hide();
		   $('#unplug_report_div').hide();
		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		   $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide(); 
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
   		 var hash_break="0";
   	     var high_acceleration="0";
   		 var Geoffence="0";
   		 
   		  if($("#hash_breaking").prop('checked')==true){
   			  hash_break="1";
   		  }
   		  if($("#high_acceleration").prop('checked')==true){
   			  high_acceleration="1";
   		  }
   		  if($("#geoffence").prop('checked')==true){
   			  Geoffence="1";
   		  }
   		 
		 
		 
   		 $("#alert_type_time_period").html(from_date_display_format+ " to "+to_date_display_format);
   		 var report_name="Alert Report";
	     var file_name='Alert Report '+from_date_download_format+' to '+to_date_download_format;
		   
   		 $('#alert_type_report').DataTable({
			 
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/alert_report",  
   				  "type": "POST",
   	              "data":function(data) {
                        data.from = from_date;
                        data.to = to_date;
   						data.vehicle_data = vehicle_new.toString();
   						data.hash_break = hash_break;
   						data.high_acceleration = high_acceleration;
   						data.Geoffence = Geoffence;
   						data.geoffence_select = geoffence_select;
                        }
      			 },
				    
                    "columns": [
                      { "data": "asset_code" },
                      { "data": "description" },
                      { "data": "group_name" },
                      { "data": "Alert_type" },
                      { "data": "time" },
                      { "data": "geoffence" },
                    ],
   			 dom: 'lBfrtip',
          		 buttons: [  
                      {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                    },
                    {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
                      exportOptions: {
                    columns: ':visible'
                },
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							   exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
                 exportOptions: {
                    columns: ':visible'
                },
						       title:'',
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   		 
   		 
   	}else if($("#Report").val()=="5"){
   		
   		 $('#exeed_idle_div').hide();
   		 $('#Main_summary_div').hide();
   		 $('#map_history').hide();
   		 $('#alert_type_report_div').hide();
   		 $('#full_summary_div').hide();
   		 $('#Maintatnce_div').show();
   		 $('#unplug_report_div').hide();
		 $('#map_playback').hide();
		 $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		    $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide();
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide(); 
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		    $("#maintanance_time_period").html(from_date_display_format+ " to "+to_date_display_format);
			var report_name="Maintanance Report";
	        var file_name='Maintanance Report '+from_date_download_format+' to '+to_date_download_format;
		 
   		 $('#maintanance_table').DataTable({
			 		
					"scrollY":'64vh',
	  				"deferRender":true,
	  				"scrollX": true,
   		            "destroy": true,
                    "processing": true,
   		      		"Paginate": true,
					"lengthMenu": [25, 50, 100, 500, 1000],
                    "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/maintanance_report",  
   				  "type": "POST",
   	              "data":function(data) {
					  
                              //data.from =from_date;
                              //data.to =to_date;
    						  data.vehicle_data = vehicle_new.toString();
                        }
      			 }, 
                   "columns": [
                      { "data": "asset_code" },
                      { "data": "description" },
                      { "data": "prev_oil_change" },
                      { "data": "oil_change" },
                      { "data": "reason" },
                    ],
   			 dom: 'lBfrtip',
          		 buttons: [ 
               {
                extend: 'colvis',
                text: 'Show/Hide Coloumns',
                },
               {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
                      exportOptions: {
                    columns: ':visible'
                },
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
                exportOptions: {
                    columns: ':visible'
                },
							  title:report_name,
							   
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
                 exportOptions: {
                    columns: ':visible'
                },
						       title:'',
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	}else if($("#Report").val()=="6"){			
   		   $('#exeed_idle_div').hide();
   		   $('#Main_summary_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').show();
   		   $('#map_playback').hide();
		   $('#unplug_report_div').hide();
		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		    $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide(); 
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		   var report_name="Full Summary Report";
	        var file_name='Full Summary Report '+from_date_download_format+' to '+to_date_download_format;
		   
		    $("#full_summary_time_period").html(from_date_display_format+ " to "+to_date_display_format);
   		 
   	      $('#full_summary').DataTable({
   		      
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/fullsummary_report",  
   				  "type": "POST",
   	              "data":function(data) {
                              data.from = from_date;
                              data.to = to_date;
   							data.vehicle_data = vehicle_new.toString();
                        }
      			 }, 
                    "columns": [
                      { "data": "asset_code" },
                      { "data": "description" },
                      { "data": "group_name" },
                      { "data": "start_date" },
                      { "data": "end_date" },
                      { "data": "time_duration" },
   		        	  { "data": "status"},
                    ],
   			 dom: 'lBfrtip',
          		 buttons: [
                {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                },
                {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
                      exportOptions: {
                    columns: ':visible'
                },
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							   exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
                 exportOptions: {
                    columns: ':visible'
                },
						       title:'',
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	}else  if($("#Report").val()=="8"){
   		  
   		   $('#exeed_idle_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Main_summary_div').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		   $('#unplug_report_div').show();
   		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		    $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide(); 
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		    $("#unplug_time_period").html(from_date_display_format+ " to "+to_date_display_format);
			
			var report_name="Unplug Report";
	        var file_name='Unplug Report '+from_date_download_format+' to '+to_date_download_format;
			
			
			
   	      $('#unplug_report').DataTable({
   		      
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/unplug_report",  
   				  "type": "POST",
   	              "data":function(data) {
                              data.from = from_date;
                              data.to = to_date;
   							data.vehicle_data = vehicle_new.toString();
                        }
      			 }, 
                    "columns": [
                      { "data": "asset_code" },
					  { "data": "name" },
                      { "data": "description" },
                      { "data": "group_name" },   				
   					  { "data": "start_date" },
                      { "data": "end_date" },
                      { "data": "time_duration" }, 
                   ],
   			 dom: 'lBfrtip',
          		 buttons: [
                {
                  extend: 'colvis',
                  text: 'Show/Hide Coloumns',
                },
                {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
                      exportOptions: {
                    columns: ':visible'
                },
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
                exportOptions: {
                    columns: ':visible'
                },
							   
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
						       title:'',
                   exportOptions: {
                    columns: ':visible'
                },
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	    }else if($("#Report").val()=="7"){	
   		   $('#exeed_idle_div').hide();
   		   $('#Main_summary_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').show();
		     $('#play_stop').show();
         $('.playback-icon-focus').show(); // searchbox update
		   //clear_playback_history();
		   $('#unplug_report_div').hide();
		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide(); 
		    $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide();
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		    clear_playback_history(function(){		   
		       vehicle_map_listing();  
		       
		  });
   		   //map_playback();
   	}else if($("#Report").val()=="9"){			
   		   $('#exeed_idle_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Main_summary_div').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		   $('#unplug_report_div').hide();
		   $('#delay_report_div').show();  
		   $('#database_full_report_div').hide();
		    $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide(); 
		   $('#device_idle_div').hide(); 
		   $('#speed_alert_div').hide();  		
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		    var report_name="Delay Report";
	        var file_name='Delay Report '+from_date_download_format+' to '+to_date_download_format;
		   
		    $("#delay_time_period").html(from_date_display_format+ " to "+to_date_display_format);
			   
   	      $('#delay_report').DataTable({
   		      
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/delay_report",  
   				  "type": "POST",
   	              "data":function(data) {
                              data.from = from_date;
                              data.to = to_date;
							  data.stop_duration = $('#delay_duration').val();
   							  data.vehicle_data = vehicle_new.toString();
                        },					  
                 	dataFilter: function(data){
                    var json = jQuery.parseJSON( data );
                    json.recordsTotal = json.recordsTotal;
                    json.recordsFiltered = json.recordsFiltered;
                    json.data = json.data;
          
                    return JSON.stringify( json ); // return JSON string
                }
    			 },
                    "columns": [
					  { "data": "id" },
                      { "data": "asset_code" },
					  { "data": "name" },
                      { "data": "description" },
                      { "data": "group_name" },   				
   					  { "data": "lattitude" },
                      { "data": "lognitude" },
					  { "data": "device_time" },
                      { "data": "server_time" }, 					  
					  { "data": "time_difference" },
                   ],
   			 	 dom: 'lBfrtip',
          		 buttons: [ 
                {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                },
               {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
                      exportOptions: {
                    columns: ':visible'
                },
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							   exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
						       title:'',
                   exportOptions: {
                    columns: ':visible'
                },
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	}else if($("#Report").val()=="10"){			
   		   $('#exeed_idle_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Main_summary_div').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		   $('#unplug_report_div').hide();
		   $('#delay_report_div').hide();
		   $('#database_full_report_div').show();
		   $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide(); 
		   $('#device_idle_div').hide(); 
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		   $("#database_full_time_period").html(from_date_display_format+ " to "+to_date_display_format);
			
			var report_name="Database Full Report";
	        var file_name='Database Full Report '+from_date_download_format+' to '+to_date_download_format;
			 		   
   	      $('#database_full_report').DataTable({
   		      
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/full_data",  
   				  "type": "POST",
   	              "data":function(data) {
                              data.from = from_date;
                              data.to = to_date;
   							data.vehicle_full_data = vehicle_new.toString();
                        }
      			 }, 
                    "columns": [
                      { "data": "id" },

                      { "data": "vehicle_id" },
                      { "data": "device_timestamp1" },   				
   					  { "data": "device_timestamp" },
                      { "data": "lattitude" },
                      { "data": "lognitude" },
					  { "data": "speed" },
					  { "data": "ign_status" },   
                      { "data": "idling"},
                      { "data": "external_power" },   				
   					  { "data": "battery_power" },
                      { "data": "generated_event"},
                      { "data": "generated_event_value"}, 
					  { "data": "satelite"},
                      { "data": "movement"},   				
   					  { "data": "manual_odometer"},
                      { "data": "odometer" },
    				  { "data": "acceleration" },
                      { "data": "hash_breaking" },
                      { "data": "unplug" }, 
					  { "data": "Heading" },
                      { "data": "altitude"},   				
   					  { "data": "created"}, 
					  { "data": "difference"},                       
                   ],
   			 dom: 'lBfrtip',
          		 buttons: [ 
               {
                  extend: 'colvis',
                  text: 'Show/Hide Coloumns',
                },
               {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
                      exportOptions: {
                    columns: ':visible'
                },
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							   exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
						       title:'',
                   exportOptions: {
                    columns: ':visible'
                },
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	}else  if($("#Report").val()=="11"){
   		   $('#exeed_idle_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Main_summary_div').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		     $('#unplug_report_div').hide();
   		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		   $('#duplicate_entry_report_div').show();
		   $('#wrong_data_report_div').hide();
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		    $("#duplicate_entry_time_period").html(from_date_display_format+ " to "+to_date_display_format);
			
			var report_name="Duplicate Entry Report";
	        var file_name='Duplicate Entry Report '+from_date_download_format+' to '+to_date_download_format;
			
			
   	       $('#duplicate_entry_report').DataTable({
   		      
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/duplicate_entry_report",  
   				  "type": "POST",
   	              "data":function(data) {
                              data.from = from_date;
                              data.to = to_date;
   							data.vehicle_data = vehicle_new.toString();
                        }
      			 }, 
                    "columns": [
					  { "data": "id" },
                      { "data": "asset_code" },
					  { "data": "name" },
                      { "data": "description" },
                      { "data": "group_name" }, 
					  { "data": "generated_event" },
                      { "data": "generated_event_value" },  				
   					  { "data": "device_time" }, 
					  { "data": "device_timestamp" },                      
                   ],
   			 dom: 'lBfrtip',
          		 buttons: [  
               {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                    },
               {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
                 exportOptions: {
                    columns: ':visible'
                },
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							    exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
						       title:'',
							  // autoPrint: false,
                 exportOptions: {
                    columns: ':visible'
                },
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	    }else  if($("#Report").val()=="12"){
			
   		   $('#exeed_idle_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Main_summary_div').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		   $('#unplug_report_div').hide();
   		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		   $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').show();
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').hide();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		    $("#wrong_data_time_period").html(from_date_display_format+ " to "+to_date_display_format);
			
			var report_name="Wrong Data Report";
	        var file_name='Wrong Data Report '+from_date_download_format+' to '+to_date_download_format;
			
			
   	       $('#wrong_data').DataTable({
   		     
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/wrong_data",  
   				  "type": "POST",
   	              "data":function(data) {
                              //data.from = from_date;
                             // data.to = to_date;
   							data.vehicle_full_data = vehicle_new.toString();
                        }
      			 }, 
                    "columns": [
					  { "data": "id" },
					  { "data": "asset_code" },
                      { "data": "vehicle_id" },
                      { "data": "description" },
                      { "data": "device_timestamp1" },   				
   					  { "data": "device_timestamp" },
                      { "data": "lattitude" },
                      { "data": "lognitude" },
					  { "data": "speed" },
                      { "data": "odometer" },
                      { "data": "ign_status" },   				
   					  { "data": "acceleration" },
                      { "data": "hash_breaking" },
                      { "data": "unplug" }, 
					  { "data": "Heading" },
                      { "data": "altitude" },   				
   					  { "data": "created" },                       
                   ],
   			 dom: 'lBfrtip',
          		 buttons: [ 
               {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                    },
               {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
                exportOptions: {
                    columns: ':visible'
                },
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							   exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
						       title:'',
							  // autoPrint: false,
                exportOptions: {
                    columns: ':visible'
                },
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	    }else if($("#Report").val()=="13"){			
   		   $('#exeed_idle_div').hide();
   		   $('#Main_summary_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		     $('#unplug_report_div').hide();
		     $('#delay_report_div').hide();  
		     $('#database_full_report_div').hide();
		     $('#duplicate_entry_report_div').hide();
		     $('#wrong_data_report_div').hide(); 
		     $('#device_idle_div').show();
		     $('#speed_alert_div').hide();
   			 $('#nodata_alert_div').hide();
			   $('#wrong_speed_alert_div').hide();
		     //geofence_report_div geofence_time_div starts
         $('#geofence_report_div').hide();
         $('#geofence_time_div').hide();
         //geofence_report_div geofence_time_div ends
         $('#woqode_div').hide();  
         var report_name="Device Idle Report";
	       var file_name='Device Idle Report '+from_date_download_format+' to '+to_date_download_format;
   		   
   		 $("#device_idle_time_period").html(from_date_display_format+ " to "+to_date_display_format);
   		   
   	      $('#device_idle').DataTable({
   		      //"fixedHeader": true,
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/device_idle_report",  
   				  "type": "POST",
   	              "data":function(data) {
                              data.from = from_date;
                              data.to = to_date;
   							data.vehicle_data = vehicle_new.toString();
                        }
      			 }, 
                    "columns": [
                      { "data": "asset_code" },
                      { "data": "description" },
                      { "data": "group_name" },
                      { "data": "start_date" },
                      { "data": "end_date" },
                      { "data": "time_duration" },
                    ],
   			 dom: 'lBfrtip',
          		 buttons: [ 
               {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                    },
               {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
                exportOptions: {
                    columns: ':visible'
                },
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							   exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
						       title:'',
                   exportOptions: {
                    columns: ':visible'
                },
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	}else if($("#Report").val()=="14"){			
   		   $('#exeed_idle_div').hide();
   		   $('#Main_summary_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		     $('#unplug_report_div').hide();
		     $('#delay_report_div').hide();  
		     $('#database_full_report_div').hide();
		     $('#duplicate_entry_report_div').hide();
		     $('#wrong_data_report_div').hide(); 
		     $('#device_idle_div').hide();
		     $('#speed_alert_div').show();
		     $('#nodata_alert_div').hide();
		     $('#wrong_speed_alert_div').hide();
         //geofence_report_div geofence_time_div starts
         $('#geofence_report_div').hide();
         $('#geofence_time_div').hide();
         //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		   var report_name="Speed Alert Report";
	        var file_name='Speed Alert Report '+from_date_download_format+' to '+to_date_download_format;
   		 
   		   $("#speed_alert_time_period").html(from_date_display_format+ " to "+to_date_display_format);
   	      $('#speed_alert').DataTable({
   		      //"fixedHeader": true,
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/speed_alert_report",  
   				  "type": "POST",
   	              "data":function(data) {
                              data.from = from_date;
                              data.to = to_date;
   							data.vehicle_data = vehicle_new.toString();
							data.speed = speed;
							data.geoffence_select = geoffence_select;
                        }
      			 },     
                    "columns": [
                      { "data": "name" },
                      { "data": "description" },
                      { "data": "group_name" },
                      { "data": "time" },
                      { "data": "speed" },
					  { "data": "lattitude" },
                      { "data": "lognitude" },
                      { "data": "geofence" },
                    ],
   			 dom: 'lBfrtip',
          		 buttons: [ 
               {
                  extend: 'colvis',
                  text: 'Show/Hide Coloumns',
              },
               {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
                exportOptions: {
                    columns: ':visible'
                },
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							   exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
						       title:'',
                   exportOptions: {
                    columns: ':visible'
                },
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	}else if($("#Report").val()=="15"){			
   		   $('#exeed_idle_div').hide();
   		   $('#Main_summary_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		     $('#unplug_report_div').hide();
		     $('#delay_report_div').hide();  
		     $('#database_full_report_div').hide();
		     $('#duplicate_entry_report_div').hide();
		     $('#wrong_data_report_div').hide(); 
		     $('#device_idle_div').hide();
		     $('#speed_alert_div').hide();
		     $('#nodata_alert_div').show();
		     $('#wrong_speed_alert_div').hide();
         //geofence_report_div geofence_time_div starts
         $('#geofence_report_div').hide();
         $('#geofence_time_div').hide();
         //geofence_report_div geofence_time_div ends
         $('#woqode_div').hide();
		     var report_name="No Data Alert Report";
	       var file_name='No Data Alert Report '+from_date_download_format+' to '+to_date_download_format;
   		 
   		   $("#nodata_alert_time_period").html(from_date_display_format+ " to "+to_date_display_format);
   	      $('#nodata_alert').DataTable({
   		      //"fixedHeader": true,
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/nodata_alert_report",  
   				  "type": "POST",
   	              "data":function(data) {
                              data.from = from_date;
                              data.to = to_date;
   							data.vehicle_data = vehicle_new.toString();
							data.geoffence_select = geoffence_select;
                        }
      			 }, 
                    "columns": [
                      { "data": "description" },
                      { "data": "group_name" },
                      { "data": "time" },
                      { "data": "server_time" },
					            { "data": "lattitude" },
                      { "data": "lognitude" },
                      { "data": "geofence" },
                    ],
   			 dom: 'lBfrtip',
          		 buttons: [ 
                  {
                      extend: 'colvis',
                      text: 'Show/Hide Coloumns',
                      // postfixButtons: ['colvisRestore']
                  },
               {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
                exportOptions: {
                    columns: ':visible'
                },
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							    sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
                  // $("#datetimepicker1").addClass("zindexzero");
                  // $("#datetimepicker").addClass("zindexzero");
 							  },
                //  action: function (e, dt, node, config) {
                //     $("$datetimepicker1").find("input").css('z-index',"0");
                // }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							   exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
						       title:'',
							  // autoPrint: false,
                exportOptions: {
                    columns: ':visible'
                },
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	}else if($("#Report").val()=="16"){			
   		   $('#exeed_idle_div').hide();
   		   $('#Main_summary_div').hide();
   		   $('#alert_type_report_div').hide();
   		   $('#map_history').hide();
   		   $('#Maintatnce_div').hide();
   		   $('#full_summary_div').hide();
   		   $('#map_playback').hide();
		   $('#unplug_report_div').hide();
		   $('#delay_report_div').hide();  
		   $('#database_full_report_div').hide();
		    $('#duplicate_entry_report_div').hide();
		   $('#wrong_data_report_div').hide(); 
		   $('#device_idle_div').hide();
		   $('#speed_alert_div').hide();
		   $('#nodata_alert_div').hide();
		   $('#wrong_speed_alert_div').show();
       //geofence_report_div geofence_time_div starts
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       //geofence_report_div geofence_time_div ends
       $('#woqode_div').hide();
		   var report_name="Wrong Speed Alert Report";
	        var file_name='Wrong Speed Alert Report '+from_date_download_format+' to '+to_date_download_format;
   		 
   		   $("#wrong_speed_alert_time_period").html(from_date_display_format+ " to "+to_date_display_format);
   	      $('#wrong_speed_alert').DataTable({
   		      //"fixedHeader": true,
			  "scrollY":'64vh',
			  "deferRender":true,
			  "scrollX": true,
			  "destroy": true,
			  "processing": true,
			  "Paginate": true,
			  "lengthMenu": [25, 50, 100, 500, 1000],
			  "pageLength": 25,
   	          "ajax": {
   			      "url": "<?=base_url()?>Reports/wrong_speed",  
   				  "type": "POST",
   	              "data":function(data) {
					  console.log(data);
                              data.from = from_date;
                              data.to = to_date;
   							data.vehicle_data = vehicle_new.toString();
							data.geoffence_select = geoffence_select;
                        }
      			 }, 
                    "columns": [
                      { "data": "description" },
                      { "data": "group_name" },
                      { "data": "speed" },
					  { "data": "lattitude" },
                      { "data": "lognitude" },
					  { "data": "time" },
                      { "data": "geofence" },
                    ],
   			 dom: 'lBfrtip',
          		 buttons: [ 
               {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                    },
               {
					          extend: 'excelHtml5',
				              text: 'Save in EXCEL',
							  title: report_name,
							  messageTop: period,
 							  filename: file_name ,
                exportOptions: {
                    columns: ':visible'
                },
 							  customize: function(xlsx) {
									var sheet = xlsx.xl.worksheets['sheet1.xml'];
									var downrows = 0;
									function Addrow(index,data) {
										msg='<row r="'+index+'">'
										for(i=0;i<data.length;i++){
											var key=data[i].k;
											var value=data[i].v;
											msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
											msg += '<is>';
											msg +=  '<t>'+value+'</t>';
											msg+=  '</is>';
											msg+='</c>';
										}
										msg += '</row>';
										return msg;
									}
								  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
								  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
 							      sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
 							  }
						    }, 
							{ 
							  extend: 'pdfHtml5', 
							  orientation: 'landscape',
							  text: 'Save in PDF',
							  title:report_name,
							   exportOptions: {
                    columns: ':visible'
                },
 							 // messageBottom: 'Generated on  : '+ generated_on,
 							  filename:file_name,
							  customize: function(doc) {
 								  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
								  doc.images = doc.images || {};
								  doc.images['myGlyph'] = getBase64Image(myGlyph);
								  
 								  doc.content.splice(0, 1, {
 									text: [{
									  text: company_name+'\n',
									  bold: true,
									  fontSize: 18
									},
 									{
									  text: Website+'\n',
									  bold: false,
									  fontSize: 8
									},
									{
									  text: telephone+'\n\n',
									  bold: false,
									  fontSize: 8
									},
 									 {
									  text: report_name+'\n',
									  bold: true,
									  fontSize: 11
									}, {
									  text: period,
									  bold: true,
									  fontSize: 11
									}],
									margin: [0, 0, 0, 12],
									alignment: 'center'
								  });
								  
								  doc.pageMargins = [20,20,20,20];
								 doc['header']=(function(page, pages) {
									 if(page=="1"){
									  return {
										columns: [
										{
											alignment: 'left',
											image: doc.images['myGlyph'],
											width: 60,
											top:50
										}
 										,
										 ''
										],
										margin: [25,25,50,50]
									  }
								    }
								});
								   
 								  doc['footer']=(function(page, pages) {
									return {
										columns: [
										    generated_time
											,
											{
 												alignment: 'right',
												text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
											}
										],
										margin: [10, 0]
									}
								});
 								var objLayout = {};
								// Horizontal line thickness
								objLayout['hLineWidth'] = function(i) { return .5; };
								// Vertikal line thickness
								objLayout['vLineWidth'] = function(i) { return .5; };
								// Horizontal line color
								objLayout['hLineColor'] = function(i) { return '#aaa'; };
								// Vertical line color
								objLayout['vLineColor'] = function(i) { return '#aaa'; };
 								// Left padding of the cell
								objLayout['paddingLeft'] = function(i) { return 4; };
								// Right padding of the cell
								objLayout['paddingRight'] = function(i) { return 4; };
 								// Inject the object in the document
								doc.content[1].layout = objLayout;
                             }
							  
							} , { 
 							   extend: 'print', 
							   orientation: 'landscape',
							   footer: "its my page",
							   pageSize: 'A4',
						       title:'',
                   exportOptions: {
                    columns: ':visible'
                },
							  // autoPrint: false,
 							   customize: function ( win ) {
 								   
								   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
								   
 									$(win.document.body).find("table th").css('padding-right',"0");
									$(win.document.body).find("table th").css('text-align',"center");
									$(win.document.body).find("table tr").css('text-align',"center");
  									$(win.document.body).css('overflow-x', 'hidden' );
 									$(win.document.body).css('font-size', '10pt' )
 									$(win.document.body).find("table").before(header_content);
 									 var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
									 $(win.document.body).append(footer_content); 
									 $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
 								} 
   							 }
					
          		]
                });
   	}

    //report update starts
    else if($("#Report").val()=="17"){
       $('#exeed_idle_div').hide();
       $('#Main_summary_div').hide();
       $('#alert_type_report_div').hide();
       $('#map_history').hide();
       $('#Maintatnce_div').hide();
       $('#full_summary_div').hide();
       $('#map_playback').hide();
       $('#unplug_report_div').hide();
       $('#delay_report_div').hide();  
       $('#database_full_report_div').hide();
       $('#duplicate_entry_report_div').hide();
       $('#wrong_data_report_div').hide(); 
       $('#device_idle_div').hide();
       $('#speed_alert_div').hide();
       $('#nodata_alert_div').hide();
       $('#wrong_speed_alert_div').hide();
       $('#geofence_report_div').show();
       $('#geofence_time_div').hide();
       // $('#geofence_report_div').hide();
       $('#woqode_div').hide();

       var report_name = "Geofence To Geofence Report";
       var file_name   = 'Geofence To Geofence Report '+from_date_download_format+' to '+to_date_download_format;
       $("#geoffencetogeoffence_time_period").html(from_date_display_format+ " to "+to_date_display_format);
       
       
       var geoffence_from = $("#Geoffence_From").val();
       var geoffence_to   = $("#Geoffence_To").val();
       
       var geoffence_from_text=$("#Geoffence_From option:selected" ).text();
       var geoffence_to_text=$("#Geoffence_To option:selected" ).text();
       
       // console.log(geoffence_from_text+"/"+geoffence_to_text);
       
       
       $("#from_geoffence").html(geoffence_from_text);
       $("#to_geoffence").html(geoffence_to_text);
       
       
       
          $('#geofencetogeoffence_report').DataTable({

            //"fixedHeader": true,
            "scrollY":'64vh',
            "deferRender":true,
            "scrollX": true,
            "destroy": true,
            "processing": true,
            "Paginate": true,
            "lengthMenu": [25, 50, 100, 500, 1000],
            "pageLength": 25,
            "fixedColumns": {
                                "leftColumns": 2,
                           },
            "ajax": {
            "url": "<?=base_url()?>Reports/geoffence_to_geoffence",  
            "type": "POST",
            "data":function(data) {
              // console.log(JSON.stringify(data));
              // console.dir(data);
              data.from = from_date;
              data.to = to_date;
              data.vehicle_data = vehicle_new.toString();
              data.geoffence_from = geoffence_from;
              data.geoffence_to = geoffence_to;
                        }
             },
                    "columns": [
                      { "data": "asset_code" },
                      { "data": "description" },
                      { "data": "from_in_time" },
            { "data": "from_spent_time" },
                      { "data": "from_out_time" },
            { "data": "travelling_time" },
            { "data": "distance" },
                      { "data": "to_in_time" },
            { "data": "to_spent_time" },
            { "data": "to_out_time" },
            { "data": "track" },
            
                     ],
         dom: 'lBfrtip',
               buttons: [ 
               {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                    },
               {
                    extend: 'excelHtml5',
                      text: 'Save in EXCEL',
                      exportOptions: {
                    columns: ':visible'
                },
                title: report_name,
                messageTop: period,
                filename: file_name ,
                customize: function(xlsx) {
                  var sheet = xlsx.xl.worksheets['sheet1.xml'];
                  var downrows = 0;
                  function Addrow(index,data) {
                    msg='<row r="'+index+'">'
                    for(i=0;i<data.length;i++){
                      var key=data[i].k;
                      var value=data[i].v;
                      msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
                      msg += '<is>';
                      msg +=  '<t>'+value+'</t>';
                      msg+=  '</is>';
                      msg+='</c>';
                    }
                    msg += '</row>';
                    return msg;
                  }
                  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
                  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
                    sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
                }
                }, 
              { 
                extend: 'pdfHtml5', 
                orientation: 'landscape',
                text: 'Save in PDF',
                title:report_name,
                 exportOptions: {
                    columns: ':visible'
                },
               // messageBottom: 'Generated on  : '+ generated_on,
                filename:file_name,
                customize: function(doc) {
                  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
                  doc.images = doc.images || {};
                  doc.images['myGlyph'] = getBase64Image(myGlyph);
                  
                  doc.content.splice(0, 1, {
                  text: [{
                    text: company_name+'\n',
                    bold: true,
                    fontSize: 18
                  },
                  {
                    text: Website+'\n',
                    bold: false,
                    fontSize: 8
                  },
                  {
                    text: telephone+'\n\n',
                    bold: false,
                    fontSize: 8
                  },
                   {
                    text: report_name+'\n',
                    bold: true,
                    fontSize: 11
                  }, {
                    text: period,
                    bold: true,
                    fontSize: 11
                  }],
                  margin: [0, 0, 0, 12],
                  alignment: 'center'
                  });
                  
                  doc.pageMargins = [20,20,20,20];
                 doc['header']=(function(page, pages) {
                   if(page=="1"){
                    return {
                    columns: [
                    {
                      alignment: 'left',
                      image: doc.images['myGlyph'],
                      width: 60,
                      top:50
                    }
                    ,
                     ''
                    ],
                    margin: [25,25,50,50]
                    }
                    }
                });
                   
                  doc['footer']=(function(page, pages) {
                  return {
                    columns: [
                        generated_time
                      ,
                      {
                        alignment: 'right',
                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                      }
                    ],
                    margin: [10, 0]
                  }
                });
                var objLayout = {};
                // Horizontal line thickness
                objLayout['hLineWidth'] = function(i) { return .5; };
                // Vertikal line thickness
                objLayout['vLineWidth'] = function(i) { return .5; };
                // Horizontal line color
                objLayout['hLineColor'] = function(i) { return '#aaa'; };
                // Vertical line color
                objLayout['vLineColor'] = function(i) { return '#aaa'; };
                // Left padding of the cell
                objLayout['paddingLeft'] = function(i) { return 4; };
                // Right padding of the cell
                objLayout['paddingRight'] = function(i) { return 4; };
                // Inject the object in the document
                doc.content[1].layout = objLayout;
                             }
                
              } , { 
                 extend: 'print', 
                 orientation: 'landscape',
                 footer: "its my page",
                 pageSize: 'A4',
                   title:'',
                   exportOptions: {
                    columns: ':visible'
                },
                // autoPrint: false,
                 customize: function ( win ) {
                   
                   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
                   
                  $(win.document.body).find("table th").css('padding-right',"0");
                  $(win.document.body).find("table th").css('text-align',"center");
                  $(win.document.body).find("table tr").css('text-align',"center");
                    $(win.document.body).css('overflow-x', 'hidden' );
                  $(win.document.body).css('font-size', '10pt' )
                  $(win.document.body).find("table").before(header_content);
                   var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
                   $(win.document.body).append(footer_content); 
                   $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
                } 
                 }
          
              ]
                });
    }
  
  else if($("#Report").val()=="18"){
    
        $('#exeed_idle_div').hide();
        $('#Main_summary_div').hide();
        $('#alert_type_report_div').hide();
        $('#map_history').hide();
        $('#Maintatnce_div').hide();
        $('#full_summary_div').hide();
        $('#map_playback').hide();
        $('#unplug_report_div').hide();
        $('#delay_report_div').hide();  
        $('#database_full_report_div').hide();
        $('#duplicate_entry_report_div').hide();
        $('#wrong_data_report_div').hide(); 
        $('#device_idle_div').hide();
        $('#speed_alert_div').hide();
        $('#nodata_alert_div').hide();
        $('#wrong_speed_alert_div').hide();
        $('#geofence_report_div').hide();
        $('#geofence_time_div').show();
        $('#woqode_div').hide();
       
       
        var report_name="Geofence Time Report";
        var file_name='Geofence Time Report '+from_date_download_format+' to '+to_date_download_format;
        
        $("#geoffencetime_time_period").html(from_date_display_format+ " to "+to_date_display_format);
       
       
          $('#geofence_time').DataTable({
            //"fixedHeader": true,
        "scrollY":'64vh',
        "deferRender":true,
        "scrollX": true,
        "destroy": true,
        "processing": true,
        "Paginate": true,
        "lengthMenu": [25, 50, 100, 500, 1000],
        "pageLength": 25,
              "ajax": {
              "url": "<?=base_url()?>Reports/geoffence_time",  
            "type": "POST",
                  "data":function(data) {
              data.from =from_date;
              data.to =to_date;
              data.vehicle_data = vehicle_new.toString();
              data.geoffence_select = geoffence_select;
                         }
             },
                    "columns": [
                      { "data": "asset_code" },
                      { "data": "description" },
                      { "data": "in_time" },
            { "data": "out_time" },
                      { "data": "spent_time" },
            { "data": "geoffence" },
                      ],
         dom: 'lBfrtip',
               buttons: [ 
               {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                    },
               {
                    extend: 'excelHtml5',
                      text: 'Save in EXCEL',
                title: report_name,
                messageTop: period,
                filename: file_name ,
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(xlsx) {
                  var sheet = xlsx.xl.worksheets['sheet1.xml'];
                  var downrows = 0;
                  function Addrow(index,data) {
                    msg='<row r="'+index+'">'
                    for(i=0;i<data.length;i++){
                      var key=data[i].k;
                      var value=data[i].v;
                      msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
                      msg += '<is>';
                      msg +=  '<t>'+value+'</t>';
                      msg+=  '</is>';
                      msg+='</c>';
                    }
                    msg += '</row>';
                    return msg;
                  }
                  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
                  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
                    sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
                }
                }, 
              { 
                extend: 'pdfHtml5', 
                orientation: 'landscape',
                text: 'Save in PDF',
                title:report_name,
                 exportOptions: {
                    columns: ':visible'
                },
               // messageBottom: 'Generated on  : '+ generated_on,
                filename:file_name,
                customize: function(doc) {
                  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
                  doc.images = doc.images || {};
                  doc.images['myGlyph'] = getBase64Image(myGlyph);
                  
                  doc.content.splice(0, 1, {
                  text: [{
                    text: company_name+'\n',
                    bold: true,
                    fontSize: 18
                  },
                  {
                    text: Website+'\n',
                    bold: false,
                    fontSize: 8
                  },
                  {
                    text: telephone+'\n\n',
                    bold: false,
                    fontSize: 8
                  },
                   {
                    text: report_name+'\n',
                    bold: true,
                    fontSize: 11
                  }, {
                    text: period,
                    bold: true,
                    fontSize: 11
                  }],
                  margin: [0, 0, 0, 12],
                  alignment: 'center'
                  });
                  
                  doc.pageMargins = [20,20,20,20];
                 doc['header']=(function(page, pages) {
                   if(page=="1"){
                    return {
                    columns: [
                    {
                      alignment: 'left',
                      image: doc.images['myGlyph'],
                      width: 60,
                      top:50
                    }
                    ,
                     ''
                    ],
                    margin: [25,25,50,50]
                    }
                    }
                });
                   
                  doc['footer']=(function(page, pages) {
                  return {
                    columns: [
                        generated_time
                      ,
                      {
                        alignment: 'right',
                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                      }
                    ],
                    margin: [10, 0]
                  }
                });
                var objLayout = {};
                // Horizontal line thickness
                objLayout['hLineWidth'] = function(i) { return .5; };
                // Vertikal line thickness
                objLayout['vLineWidth'] = function(i) { return .5; };
                // Horizontal line color
                objLayout['hLineColor'] = function(i) { return '#aaa'; };
                // Vertical line color
                objLayout['vLineColor'] = function(i) { return '#aaa'; };
                // Left padding of the cell
                objLayout['paddingLeft'] = function(i) { return 4; };
                // Right padding of the cell
                objLayout['paddingRight'] = function(i) { return 4; };
                // Inject the object in the document
                doc.content[1].layout = objLayout;
                             }
                
              } , { 
                 extend: 'print', 
                 orientation: 'landscape',
                 footer: "its my page",
                 pageSize: 'A4',
                   title:'',
                   exportOptions: {
                    columns: ':visible'
                },
                // autoPrint: false,
                 customize: function ( win ) {
                   
                   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
                   
                  $(win.document.body).find("table th").css('padding-right',"0");
                  $(win.document.body).find("table th").css('text-align',"center");
                  $(win.document.body).find("table tr").css('text-align',"center");
                    $(win.document.body).css('overflow-x', 'hidden' );
                  $(win.document.body).css('font-size', '10pt' )
                  $(win.document.body).find("table").before(header_content);
                   var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
                   $(win.document.body).append(footer_content); 
                   $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
                } 
                 }
          
              ]
                });
    }else if($("#Report").val()=="19"){
    
       $('#exeed_idle_div').hide();
       $('#Main_summary_div').hide();
       $('#alert_type_report_div').hide();
       $('#map_history').hide();
       $('#Maintatnce_div').hide();
       $('#full_summary_div').hide();
       $('#map_playback').hide();
       $('#unplug_report_div').hide();
       $('#delay_report_div').hide();  
       $('#database_full_report_div').hide();
       $('#duplicate_entry_report_div').hide();
       $('#wrong_data_report_div').hide(); 
       $('#device_idle_div').hide();
       $('#speed_alert_div').hide();
       $('#nodata_alert_div').hide();
       $('#wrong_speed_alert_div').hide();
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       $('#geofence_time_summary_div').show();
       $('#woqode_div').hide();
       
       var report_name="Geofence To Geofence Summary Report";
         var file_name='Geofence To Geofence Summary Report '+from_date_download_format+' to '+to_date_download_format;
         $("#geoffencetimesummary_time_period").html(from_date_display_format+ " to "+to_date_display_format);
         var geoffence_from=$("#Geoffence_From").val();
       var geoffence_to=$("#Geoffence_To").val();
       var geoffence_from_text=$("#Geoffence_From option:selected" ).text();
       var geoffence_to_text=$("#Geoffence_To option:selected" ).text();
       $("#from_geoffence_summary").html(geoffence_from_text);
       $("#to_geoffence_summary").html(geoffence_to_text);
       
          $('#geofencetogeoffencesummary_report').DataTable({
        "scrollY":'64vh',
        "deferRender":true,
        "scrollX": true,
        "destroy": true,
        "processing": true,
        "Paginate": true,
        "lengthMenu": [25, 50, 100, 500, 1000],
        "pageLength": 25,
        "fixedColumns": {
                            "leftColumns": 2,
                       },
              "ajax": {
              "url": "<?=base_url()?>Reports/geofence_togeofence_summary",  
            "type": "POST",
                  "data":function(data) {
                            data.from = from_date;
                            data.to = to_date;
                data.vehicle_data = vehicle_new.toString();
              data.geoffence_from = geoffence_from;
              data.geoffence_to = geoffence_to;
                        }
             },
                    "columns": [
                      { "data": "asset_code" },
                      { "data": "description" },
                      { "data": "travellingtime"},
            { "data": "travellingkm"},
            { "data": "returntime"},
            { "data": "returningkm"},
                      ],
         dom: 'lBfrtip',
               buttons: [ 
               {
                        extend: 'colvis',
                        text: 'Show/Hide Coloumns',
                    },
               {
                    extend: 'excelHtml5',
                      text: 'Save in EXCEL',
                title: report_name,
                messageTop: period,
                filename: file_name ,
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(xlsx) {
                  var sheet = xlsx.xl.worksheets['sheet1.xml'];
                  var downrows = 0;
                  function Addrow(index,data) {
                    msg='<row r="'+index+'">'
                    for(i=0;i<data.length;i++){
                      var key=data[i].k;
                      var value=data[i].v;
                      msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
                      msg += '<is>';
                      msg +=  '<t>'+value+'</t>';
                      msg+=  '</is>';
                      msg+='</c>';
                    }
                    msg += '</row>';
                    return msg;
                  }
                  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
                  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
                    sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
                }
                }, 
              { 
                extend: 'pdfHtml5', 
                orientation: 'landscape',
                text: 'Save in PDF',
                title:report_name,
                 exportOptions: {
                    columns: ':visible'
                },
               // messageBottom: 'Generated on  : '+ generated_on,
                filename:file_name,
                customize: function(doc) {
                  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
                  doc.images = doc.images || {};
                  doc.images['myGlyph'] = getBase64Image(myGlyph);
                  
                  doc.content.splice(0, 1, {
                  text: [{
                    text: company_name+'\n',
                    bold: true,
                    fontSize: 18
                  },
                  {
                    text: Website+'\n',
                    bold: false,
                    fontSize: 8
                  },
                  {
                    text: telephone+'\n\n',
                    bold: false,
                    fontSize: 8
                  },
                   {
                    text: report_name+'\n',
                    bold: true,
                    fontSize: 11
                  }, {
                    text: period,
                    bold: true,
                    fontSize: 11
                  }],
                  margin: [0, 0, 0, 12],
                  alignment: 'center'
                  });
                  
                  doc.pageMargins = [20,20,20,20];
                 doc['header']=(function(page, pages) {
                   if(page=="1"){
                    return {
                    columns: [
                    {
                      alignment: 'left',
                      image: doc.images['myGlyph'],
                      width: 60,
                      top:50
                    }
                    ,
                     ''
                    ],
                    margin: [25,25,50,50]
                    }
                    }
                });
                   
                  doc['footer']=(function(page, pages) {
                  return {
                    columns: [
                        generated_time
                      ,
                      {
                        alignment: 'right',
                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                      }
                    ],
                    margin: [10, 0]
                  }
                });
                var objLayout = {};
                // Horizontal line thickness
                objLayout['hLineWidth'] = function(i) { return .5; };
                // Vertikal line thickness
                objLayout['vLineWidth'] = function(i) { return .5; };
                // Horizontal line color
                objLayout['hLineColor'] = function(i) { return '#aaa'; };
                // Vertical line color
                objLayout['vLineColor'] = function(i) { return '#aaa'; };
                // Left padding of the cell
                objLayout['paddingLeft'] = function(i) { return 4; };
                // Right padding of the cell
                objLayout['paddingRight'] = function(i) { return 4; };
                // Inject the object in the document
                doc.content[1].layout = objLayout;
                             }
                
              } , { 
                 extend: 'print', 
                 orientation: 'landscape',
                 footer: "its my page",
                 pageSize: 'A4',
                   title:'',
                   exportOptions: {
                    columns: ':visible'
                },
                // autoPrint: false,
                 customize: function ( win ) {
                   
                   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
                   
                  $(win.document.body).find("table th").css('padding-right',"0");
                  $(win.document.body).find("table th").css('text-align',"center");
                  $(win.document.body).find("table tr").css('text-align',"center");
                  $(win.document.body).css('overflow-x', 'hidden' );
                  $(win.document.body).css('font-size', '10pt' )
                  $(win.document.body).find("table").before(header_content);
                  var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
                  $(win.document.body).append(footer_content); 
                  $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
                } 
                 }
          
              ]
                });
    
  }else if($("#Report").val()=="20"){
    
         $('#exeed_idle_div').hide();
         $('#Main_summary_div').hide();
         $('#alert_type_report_div').hide();
         $('#map_history').hide();
         $('#Maintatnce_div').hide();
         $('#full_summary_div').hide();
         $('#map_playback').hide();
       $('#unplug_report_div').hide();
       $('#delay_report_div').hide();  
       $('#database_full_report_div').hide();
       $('#duplicate_entry_report_div').hide();
       $('#wrong_data_report_div').hide(); 
       $('#device_idle_div').hide();
       $('#speed_alert_div').hide();
       $('#nodata_alert_div').hide();
       $('#wrong_speed_alert_div').hide();
       $('#geofence_report_div').hide();
       $('#geofence_time_div').hide();
       $('#geofence_time_summary_div').hide();
       $('#woqode_div').show();
       
       var report_name="Woqode Report";
         var file_name='Woqode Report '+from_date_download_format+' to '+to_date_download_format;
         $("#woqodetime_period").html(from_date_display_format+ " to "+to_date_display_format);
         
           $('#woqode_report').DataTable({
        "scrollY":'64vh',
        "deferRender":true,
        "scrollX": true,
        "destroy": true,
        "processing": true,
        "Paginate": true,
        "lengthMenu": [25, 50, 100, 500, 1000],
        "pageLength": 25,
        "fixedColumns": {
                            "leftColumns": 2,
                       },
              "ajax": {
              "url": "<?=base_url()?>Reports/woqode_report",  
            "type": "POST",
                  "data":function(data) {
                            data.from = from_date;
                            data.to = to_date;
                data.vehicle_data = vehicle_new.toString();
                         }
             },
          "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            if( aData['geofence_in']==""){
               $(nRow).css('background-color', '#FF0000');
               $(nRow).css('color', '#FFFFFF');
            }
          } ,
          
                    "columns": [
                      { "data": "asset_code" },
                      { "data": "description" },
                      { "data": "quantity"},
            { "data": "saletime"},
            { "data": "station"},
            { "data": "geofence_in"},
            { "data": "geofence_out"},
            { "data": "spent_time"},
            { "data": "geofence"},
                      ],
         dom: 'lBfrtip',
               buttons: [ {
                    extend: 'excelHtml5',
                      text: 'Save in EXCEL',
                title: report_name,
                messageTop: period,
                filename: file_name ,
                customize: function(xlsx) {
                  var sheet = xlsx.xl.worksheets['sheet1.xml'];
                  var downrows = 0;
                  function Addrow(index,data) {
                    msg='<row r="'+index+'">'
                    for(i=0;i<data.length;i++){
                      var key=data[i].k;
                      var value=data[i].v;
                      msg += '<c t="inlineStr" r="' + key + index + '" s="0">';
                      msg += '<is>';
                      msg +=  '<t>'+value+'</t>';
                      msg+=  '</is>';
                      msg+='</c>';
                    }
                    msg += '</row>';
                    return msg;
                  }
                  var lastCol = sheet.getElementsByTagName('row').length+downrows+1;
                  var r1 = Addrow(lastCol, [{ k: 'A', v: generated_time}]);
                    sheet.childNodes[0].childNodes[1].innerHTML = sheet.childNodes[0].childNodes[1].innerHTML+r1;
                }
                }, 
              { 
                extend: 'pdfHtml5', 
                orientation: 'landscape',
                text: 'Save in PDF',
                title:report_name,
                 
               // messageBottom: 'Generated on  : '+ generated_on,
                filename:file_name,
                customize: function(doc) {
                  var myGlyph = new Image();
                                  myGlyph.src = '<?=base_url()?>lib/images/main_logo.png';
                  doc.images = doc.images || {};
                  doc.images['myGlyph'] = getBase64Image(myGlyph);
                  
                  doc.content.splice(0, 1, {
                  text: [{
                    text: company_name+'\n',
                    bold: true,
                    fontSize: 18
                  },
                  {
                    text: Website+'\n',
                    bold: false,
                    fontSize: 8
                  },
                  {
                    text: telephone+'\n\n',
                    bold: false,
                    fontSize: 8
                  },
                   {
                    text: report_name+'\n',
                    bold: true,
                    fontSize: 11
                  }, {
                    text: period,
                    bold: true,
                    fontSize: 11
                  }],
                  margin: [0, 0, 0, 12],
                  alignment: 'center'
                  });
                  
                  doc.pageMargins = [20,20,20,20];
                 doc['header']=(function(page, pages) {
                   if(page=="1"){
                    return {
                    columns: [
                    {
                      alignment: 'left',
                      image: doc.images['myGlyph'],
                      width: 60,
                      top:50
                    }
                    ,
                     ''
                    ],
                    margin: [25,25,50,50]
                    }
                    }
                });
                   
                  doc['footer']=(function(page, pages) {
                  return {
                    columns: [
                        generated_time
                      ,
                      {
                        alignment: 'right',
                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                      }
                    ],
                    margin: [10, 0]
                  }
                });
                var objLayout = {};
                // Horizontal line thickness
                objLayout['hLineWidth'] = function(i) { return .5; };
                // Vertikal line thickness
                objLayout['vLineWidth'] = function(i) { return .5; };
                // Horizontal line color
                objLayout['hLineColor'] = function(i) { return '#aaa'; };
                // Vertical line color
                objLayout['vLineColor'] = function(i) { return '#aaa'; };
                // Left padding of the cell
                objLayout['paddingLeft'] = function(i) { return 4; };
                // Right padding of the cell
                objLayout['paddingRight'] = function(i) { return 4; };
                // Inject the object in the document
                doc.content[1].layout = objLayout;
                             }
                
              } , { 
                 extend: 'print', 
                 orientation: 'landscape',
                 footer: "its my page",
                 pageSize: 'A4',
                   title:'',
                // autoPrint: false,
                 customize: function ( win ) {
                   
                   var header_content='<div style="width:100%;margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; text-align:center; "><div style="float:left;width:10%; margin-top:5px"><img src="<?=base_url()?>lib/images/main_logo.png" /></div><div style="float:left; width:90%; margin-top:10px"><h2 style="margin:0"><b>'+company_name+'</b> </h2><p style="font-size:1em; padding:5px 0 15px 0; margin:0;"><a style="text-decoration:none; color:#777">'+Website+'</a><br />'+telephone+'</p><h5 style="margin:0; "> <b><u>'+report_name+'</u></b><br /><p style=" padding:2px 0 0 0;">'+period+'</p></h5></div></div><div style="clear:both"></div> <br/>';
                   
                  $(win.document.body).find("table th").css('padding-right',"0");
                  $(win.document.body).find("table th").css('text-align',"center");
                  $(win.document.body).find("table tr").css('text-align',"center");
                    $(win.document.body).css('overflow-x', 'hidden' );
                  $(win.document.body).css('font-size', '10pt' )
                  $(win.document.body).find("table").before(header_content);
                   var footer_content='<tr><td><div style="position:fixed;bottom:0;">'+generated_time+'</div></td></tr>';
                   $(win.document.body).append(footer_content); 
                   $(win.document.body).find( 'table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
                } 
                 }
          
              ]
                });
    
  }
    //report update ends

   }
      });
     function vehicle_data(id){
 		  var current_id = id.split("_");
    		  if(!$('#'+id).prop('checked')){
    		  delete vehicle[current_id[1]];
   	      }else{
			  
			  
     		 vehicle[current_id[1]]=current_id[1];
     	 }
   	  }

     $(".vehiclelist").click(function(){
   		   id=this.id;
    		   vehicle_data(id);
   	 });
    
     
        $(document).on("click", '.grouplist', function (event) {
     	   id=this.id;
      
   	   if($(this).prop('checked')==true){
     		   $(".child"+id).prop('checked',true);
   		   
      }else{
   		   $(".child"+id).prop('checked',false);
      }	   
   	   $(".child"+id).each(function() {
   		   vehicle_id=this.id;
   		   vehicle_data(vehicle_id);
        });
   	       
    });
    
    // search box update

    $('.playback-icon-focus').on('click',function(){
      icon_focus_flag=1;
    $('.playback-icon-focus').hide();
    $('.playback-icon-focus-clear').show(); 
      //$('.min-max-geo').slideToggle();
  });
  
  $('.playback-icon-focus-clear').on('click',function(){
      icon_focus_flag=0;
      $('.playback-icon-focus').show();
    $('.playback-icon-focus-clear').hide();
      //$('.min-max-geo').slideToggle();
  });
  
  newmap.addListener('zoom_changed', function() {
      icon_focus_flag=0;
    $('.playback-icon-focus').show();
    $('.playback-icon-focus-clear').hide();
});  
	   
  // search box update
	  
	   
	   
   });
     
     
</script>
</body>
</html>