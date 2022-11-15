<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>

  <meta name="viewport" content="width=device-width, user-scalable=no">
  <meta charset="utf-8">
  <title>Interface</title>
  <link rel="icon" href="<?=base_url()?>lib/images/fav-icon.png" type="image/png">
  <link rel="stylesheet" href="<?=base_url()?>lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>lib/css/bootstrap-select.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>lib/fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>lib/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>lib/css/select.dataTables.min.css">
  <link rel="stylesheet" href="<?=base_url()?>lib/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
  <link rel="stylesheet" href="<?=base_url()?>lib/css/interface.css">
  <link rel="stylesheet" href="<?=base_url()?>lib/css/scrollbar.css">
  <link rel="stylesheet" href="<?=base_url()?>lib/css/menu.css">
  <link rel="stylesheet" href="<?=base_url()?>lib/css/home.css">
  <link rel="stylesheet" href="<?=base_url()?>lib/css/responsive.css">
  <link rel="stylesheet" href="<?=base_url()?>lib/css/gps-view.css">
  <style type="text/css">
    .statusbutton{
          padding: 2px 0px 2px 3px;
         }
  </style>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script>
    $(document).ready(function()
    {
         $("#vehiclestatusgraph").click(function()
         {
            $.ajax({
              url: "<?=base_url()?>Index/vehiclestatusgraph",
              method: "POST",
              success: function (response) 
              {
                var dataresult = $.parseJSON(response);

                var oilCanvas = document.getElementById("oilChart");
                Chart.defaults.global.defaultFontFamily = "Lato";
                Chart.defaults.global.defaultFontSize = 18;

                var oilData = {
                    labels: [
                        "Running",
                        "Ignition ON",
                        "Stop",
                        "Workshop",
                        "Longstop",
                    ],
                    datasets: [
                        {
                            data: [dataresult.runningcount, dataresult.idlecount, dataresult.stopcount, dataresult.workshopcount,
                                 dataresult.longstopcount],
                            backgroundColor: [
                                "green",
                                "orange",
                                "red",              
                                "blue",
                                "black"
                            ]
                        }]
                };

                var pieChart = new Chart(oilCanvas, {
                  type: 'pie',
                  data: oilData
                });
                $('#vehiclestatusgraphModal').modal('show');
              }
            });
         });
    });
   
  </script>


  <script type="text/javascript">

    window.addEventListener("storage",function()
    {
      var logoutevent=localStorage.getItem('logout-event');
      console.log(logoutevent);
      if(logoutevent == "logout")
      {
        manuallogout();
      }
    });
        
    var i=0;
    
    function manuallogout() 
    {
      url=  "<?php echo  base_url(); ?>";
      window.location.href = url; 
    }


  </script>
</head>

<!-- modal starts -->
<style type="text/css">

.modal-dialog {
  max-width: 400px; 
  max-height: 400px;  
}

</style>
</style>

<div class="modal fade" id="vehiclestatusgraphModal" tabindex="-1" role="dialog" aria-labelledby="vehiclestatusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #007bff;">
        <h3 class="modal-title text-center" id="vehiclestatusLabel"><b>FLEET STATUS</b></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body prem">
       <canvas id="oilChart" width="" height=""></canvas>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- modal ends -->

<body class="scrollbar" id="style-2">
  <div id="container">
    <div id="nav" class="dark-shadow">
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <div class="navTrigger"> <i></i>
              <i></i>
              <i></i>
            </div>
            <div class="mainmenu minterface blue-shadow"> <a href="<?=base_url()?>index/live_map" data-toggle="tooltip" data-placement="bottom" title="Interface" style="text-decoration:none; color:#CCC; font-size:10px; font-family: Raleway,sans-serif;">
                                <img src="<?=base_url()?>lib/images/master/map.png" class="img-responsive">
                                <span></span>
                            </a>
            </div>
            <?php if(!empty($masters_data)){ foreach($masters_data as $master_key=>$master_data){?>
            <div class="mainmenu mmaster blue-shadow">
              <?php $controller=$master_data[ 'controller']!="Defaultmaster" ?$master_data[ 'controller']:$master_data[ 'controller']. "?id=1"; ?> <a href="<?=base_url().$controller?>" data-toggle="tooltip" data-placement="bottom" title="<?=$master_data['master']?>" style="text-decoration:none; color:#CCC; font-size:10px; font-family: Raleway,sans-serif;">
                                <img src="<?=base_url()?>lib/images/master/<?=$master_data['id']?>.png" class="img-responsive">
                                <span></span>
                            </a>
            </div>
            <?php } } if($report_status=="1" ){ ?>
            <div class="mainmenu mreport blue-shadow"> <a href="<?=base_url()?>reports" target="_blank" data-toggle="tooltip" data-placement="bottom" title="reports" style="text-decoration:none; color:#CCC; font-size:10px; font-family:Verdana, Geneva, sans-serif;">
                                <img src="<?=base_url()?>lib/images/master/report.png" class="img-responsive">
                                <span></span>
                            </a>
            </div>
            <?php } ?>
            <div class="header-logo">
              <img src="<?=base_url()?>lib/images/main_logo.png" class="img-responsive" style="float: left;
    display: inline-block;width:12%;  margin-left: 5%;"> <span class="" style=" padding-top: 1.6%;display: inline-block;margin-left:5%; color:#666; font-size:1.3em">Al Wataniya Concrete</span>
            </div>
          </div>
          <button type="button" class="btn btn-primary fr" data-toggle="modal" id="vehiclestatusgraph">
          Fleet Status
        </button>
          <div class="username-align">Welcome <span> <?=ucfirst(strtolower($this->session->userdata("name")))?> </span>
          </div>
          <div style="cursor:pointer; position: absolute; right: 40px; top: 16%; color:#3b5998" title="Maximise"><span class="btn mybutton_Maximise  "> <i class="fa fa-expand r"></i></span>
          </div>
          <div style="cursor:pointer; position: absolute; right: 40px; top: 16%; color:#3b5998; " title="Minimise"><span class="btn mybutton_minimise "> <i class="fa fa-compress r"></i></span>
          </div>
          <img src="<?=base_url()?>lib/images/zoom.png" class="zoom-reset img-responsive" alt="Zoom Reset" title="Reset to Default Location">
          <div class="logout "> <a href="#" class="text-danger"><i class="fa fa-sign-out"></i></a>
          </div>
        </div>
      </nav>
    </div>
    <div id="map" class="full-screen"></div>
  </div>
  <div class="container">
    <div id="myModal" class="modal fade" role="dialog" style="z-index: 100000;">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
            <h4 class="modal-title">New Geoffence</h4>
          </div>
          <form class="cmxform" id="commentForm" method="get" action="">
            <div class="modal-body">
              <div class="col-md-12">
                <div class="col-md-offset-1 col-md-10" style="margin-bottom: 2%;">
                  <label>Geofence Code</label>
                  <input type="text" name="geofence_code" id="geofence_code" class="form-control" placeholder="Geofence Code" required> <span id="name_error2" class="collapse" style="color:#F00;">Geofence Code Already existed</span>
                  <label>Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name" required> <span id="name_error1" class="collapse" style="color:#F00;">Name Already existed</span>
                  <label>Group</label>
                  <select name="type" class="themes form-control" id="geo_group" required>
                    <option value="">select</option>
                    <?php foreach($geo_group as $geo_group_key=>$geo_group_data){ ?>
                    <option value="<?=$geo_group_data['id']?>">
                      <?=$geo_group_data[ 'Name']?>
                    </option>
                    <?php } ?>
                  </select>
                  <label>color</label>
                  <input id="color" class="jscolor form-control" value="ab2567">
                </div>
              </div>
            </div>
            <div class="modal-footer" style="clear: both;">
              <input type="hidden" name="boundaries" id="boundaries" value="">
              <button type="button" class="btn btn-info" id="insert">Insert</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="shipModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
            <h4 class="modal-title">Shipping</h4>
          </div>
          <form class="cmxform" id="commentForm1" method="get" action="">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group" id="starting-date">
                    <label for="StartDate">Order Start Date</label>
                    <div class='input-group date' id="datetimepicker1">
                      <input type='text' id='start_date' name='start_date' placeholder="Start Date" class="form-control" required> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group geoffence_multi_select">
                    <label>Geofence</label>
                    <select name="Geoffence_name" class="form-control-sm" multiple id="Geoffence_name" data-live-search="true" required>
                      <?php foreach($geoffence_data as $geoffencegroupid=>$geoffencegroupdata){?>
                      <optgroup value="<?=$geoffencegroupid?>" label="<?=strtoupper($geoffencegroupdata['group_name'])?>">
                        <?php foreach($geoffencegroupdata as $customerid=>$customerdata){ $customerid=$customerid!=""?$customerid:"0"; if($customerid!="group_name"){ if($geoffencegroupdata['group_name']=='Project site'){ ?>
                        <?php foreach($customerdata as $geoffencekey=>$geoffencedatas){ if($geoffencekey!="cust_name"){?>
                        <option value="<?=$geoffencekey?>">
                          <?=strtoupper($geoffencedatas[ 'description'])?>
                        </option>
                        <?php } } ?>
                        <?php }else{ foreach($customerdata as $geoffencekey=>$geoffencedatas){ if($geoffencekey!="cust_name"){ ?>
                        <option value="<?=$geoffencekey?>">
                          <?=strtoupper($geoffencedatas[ 'description'])?>
                        </option>
                        <?php } } } } } ?>
                      </optgroup>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="loader2" style="top: 0px; left: 0px; display: none;">
                  <img src="<?=base_url()?>lib/images/loader.gif">
                </div>
              </div>
              <div class="popup-button">
                <input type="submit" class="btn btn-primary" id="shipping_generate" value="Generate">
              </div>
              <div id="shiping_table_div" class="collapse">
                <!--<div class="tab-header"><i class="fa fa-clock-o" aria-hidden="true"></i>Exceed Idle Report </div>-->
                <div class="scrollbar" id="style-2">
                  <table id="shiping_table" class="table table-striped table-bordered display nowrap" width="100%">
                    <thead style="display: table-header-group;">
                      <tr class="header">
                        <th>Si.No</th>
                        <th>Vehicle Type</th>
                        <th>Vehicle In</th>
                        <th>Vehicle Out</th>
                        <th>Site Vehicles</th>
                      </tr>
                    </thead>
                    <tbody id="shipping_result"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div style="position:absolute; z-index:10000; background-color:#FFF; float:left;">
      <?php // $geoffence_dataquery=mysql_query( "select id,name from geoffence") or die(mysql_error()); // while($geoffence_data=mysql_fetch_assoc($geoffence_dataquery)){ ?>
      <?php //} ?>
      <div id="MapType" class="btn-group pull-left" data-toggle="buttons" style="bottom: 1%; left: 45%; position: fixed; z-index:100px;">
        <label class="btn btn-custom active">
          <input type="radio" class="Road" id="Road" value="Road" name="satelite_type" autocomplete="off" checked>Road</label>
        <label class="btn btn-custom">
          <input type="radio" class="Satellite" id="Satellite" name="satelite_type" value="Satellite" autocomplete="off">Satellite</label>
      </div>
      <!-- <label class="btn btn-custom" style="bottom: 2%; right: .5%; position: fixed; z-index:100px;" title="For viewing SVG type icons">
        <a href="<?=base_url()?>index/live_map/1" style="color:black">SVG</a>
    </label> -->
    </div>
  </div>
  <nav class="social">
    <ul>
      <?php if($fleets_status=="1" ){?>
      <li class="fleet_show side_icons blue-shadow">Fleets <i class="fa fa-bus"></i>
      </li>
      <?php } if($geoffencestatus=="1" ){?>
      <li class="geoffence_show side_icons blue-shadow">Geoffence <i class="fa fa-map"></i>
      </li>
      <?php } if($shipping_status=="1" ){?>
      <li class="shipment_show side_icons blue-shadow no-padding"><a id="shipment" style="text-decoration:none; display:block">Shipping<i class="fa fa-truck"></i></a>
      </li>
      <?php } if($report_status=="1" ){ ?>
      <li class="side_icons blue-shadow no-padding"><a href="<?=base_url()?>reports" target="_blank" style="text-decoration:none; display:block">Reports <i class="fa fa-file-text"></i> </a>
      </li>
      <?php } ?>
      <!--<li class=" side_icons">Behance <span class="icon icon-poi"></span></li>-->
    </ul>
  </nav>
  <div id="FleetDialog" class="panel panel-default dialog dark-shadow" style="display:none;min-width: 300px; ">
    <!-- Default panel contents -->
    <div id="FleetTree" class="xeno-tree">
      <div class="menu blue-shadow" id="draggablefleets">
        <input type="checkbox" class="fulllist" id="fulllist" style="z-index:100000; vertical-align:text-bottom">FLEETS <a title="Close"><i class="fa fa-remove" id="close_fleet"></i></a>
        <a title="Minimize/Maximize" class='switch-icons min-max-icon'>-</a>
        <a title="Reset"><i class="fa fa-undo" id="fleet_reset"></i></a>  <a title="Refresh"><i class="fa fa-refresh" id="fleet_refresh"></i></a>  <a title="Search"><i class="glyphicon glyphicon-filter fleetsearch"></i></a>
      </div>
      <div class="filter input-group" id="vehicle_search" style="display:none;  max-width:315px;">
        <input type="text" id="myInput" class="form-control" autocomplete="off">
        <a title="Filter" class="btn input-group-addon glyphicon glyphicon-search"></a>
        <a title="Close" class="btn input-group-addon glyphicon glyphicon-remove fleet_search_remove"></a>
      </div>
      <div class="min-max">
        <div style="max-height:360px; " class="scrollbar" id="style-2">
          <?php foreach($vehicle_data as $vehiclegroupid=>$vehiclegroupdata){?>
          <li class="groups_data" data-id="<?=$vehiclegroupid?>">
            <div class="node inactive">
              <input type="checkbox" class="grouplist" id="group_<?=$vehiclegroupid?>" data-id="<?=$vehiclegroupid?>" style="z-index:100000;"><span class="title"><i></i><b><?=strtoupper($vehiclegroupdata['group_name'])?></b></span>
              <span class="template" id="vehiclegroup_status_<?=$vehiclegroupid?>"></span>
            </div>
          </li>
          <ul class="station_datas" style="padding-left: 0px; display:none" id="stationcontainer<?=$vehiclegroupid?>">
            <?php foreach($vehiclegroupdata as $station_id=>$stationdata){ if(trim($station_id)!="group_name" ){ ?>
            <li class="stations_data" data-id="<?=$station_id?>" data-stationgroupid="<?=$vehiclegroupid?>">
              <div class="node inactive vehiclestation_data_div">
                <input type="checkbox" class="stationlist childgroup_<?=$vehiclegroupid?>" id="stationchildgroup_<?=$vehiclegroupid?>_<?=$station_id?>" data-id="<?=$station_id?>" data-stationgroupid="<?=$vehiclegroupid?>" style="z-index:100000;"><span class="title"><i></i><b><?=$stationdata['station_name']!=""?strtoupper($stationdata['station_name']):"GENERAL"?></b></span>
              </div>
            </li>
            <ul class="fleets_search_data" style="padding-left: 0px; display:none" id="vehiclecontainer_<?=$station_id?>_<?=$vehiclegroupid?>">
              <li style="display:inline-block; width:100% ">
                <?php foreach($stationdata as $vehiclekey=>$vehicledata){ if($vehiclekey!="station_name" && $vehicledata['description']!=""){ ?>
                <div class="innernode inactive disabled vehicle_container" style="float:left; clear:both; width:100%" id="vehicle_container_<?=$vehiclekey?>" data-groupid="<?=$vehiclegroupid?>">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" class="vehiclelist  vehiclechildgroup_<?=$vehiclegroupid?> child_<?=$vehiclegroupid?>_<?=$station_id?>" id="vehicleid_<?=$vehiclekey?>" data-stationid="<?=$station_id?>" data-groupid="<?=$vehiclegroupid?>" data-vehiclestatus=""> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>  <span class="title" style=""><i></i><?=$vehicledata['description']?></span>
                    </label>
                  </div> <span class="template pull-right">
                       <?php
                       if($vehicledata['color']=="green"){
                          $img=base_url()."lib/images/run.png";
                       }else if($vehicledata['color']=="orange"){
                           $img=base_url()."lib/images/ideal.png";
                       }else{
                          $img=base_url()."lib/images/stop.png";
                       }
                       if(isset($vehicle_fulldata['duration']))
                       {
                         echo $vehicle_fulldata['duration'];
                       }
                     ?>
                      
                      <i class="glyphicon vehicle_ls" id="ls_<?=$vehiclekey?>" style="border: 1px solid #000;height: 20px;width: 20px;text-align: center;border-radius: 1rem;padding-top: 2px; border: 1px solid red:width:5px:;display: inline-block;font-family: 'Glyphicons Halflings';font-style: normal;line-height: 1; top: -4px; font-weight: bold;background-color: #000;color:#fff ; display: none;">
                        LS
                         </i>

                      <i class="glyphicon vehicle_ws" id="ws_<?=$vehiclekey?>" style="border: 1px solid #357094;height: 20px;width: 20px;text-align: center;border-radius: 1rem;padding-top: 2px; border: 1px solid red:width:5px:;display: inline-block;font-family: 'Glyphicons Halflings';font-style: normal;line-height: 1; top: -4px; font-weight: bold;background-color: #357094;color:#fff;display: none;">
                        WS
                      </i>

                      <i class="glyphicon" style="margin-left:2%;"><img class="img-responsive" id="status_<?=$vehiclekey?>" src="<?=$img?>" style="width:73%;"></i>

                      <a id="locate_<?=$vehiclekey?>" class="btn btn-default template fleetfocus" title="" data-placement="left" data-toggle="tooltip" data-original-title="Locate"> <i class="fa fa-search"></i></a>

                      <a class="btn btn-default template track_vehicle" id="trace_<?=$vehiclekey?>" title="" data-placement="left" data-toggle="tooltip" data-original-title="Trace"><i class="fa fa-pencil"></i> </a>
 
                      </span>
                </div>
                <?php } } ?>
              </li>
            </ul>
            <?php } } ?>
          </ul>
          <?php }?>
          </ul>
          </li>
          </ul>
          <div class="loader" style="top: 0px; left: 0px; display: none;">
            <img src="<?=base_url()?>lib/images/loader.gif">
          </div>
          <ul class="filter-list"></ul>
        </div>
      </div>
    </div>
  </div>
  <!--geofences-->
  <?php if($geoffencestatus=="1" ){?>
  <div id="div_table" class="divtable dark-shadow xeno-tree" style="display:none;">
    <div id="draggable" class="menu blue-shadow ui-widget-content">Geofences <a><i class="glyphicon glyphicon-remove" id="close_geoffence"></i></a>
      <a title="Minimize/Maximize" class='switch-icons-geo min-max-icon'>-</a>
      <a><i class="glyphicon glyphicon-refresh" id="geoffence_refresh"></i></a>  <a><i class="glyphicon glyphicon-filter geoffence_search"></i></a>
    </div>
    <div class="filter input-group" id="geoffence_search" style="display:none;  max-width:255px;">
      <input type="text" id="geoffenceInput" class="form-control" autocomplete="off">
      <a title="Filter" class="btn input-group-addon glyphicon glyphicon-search"></a>
      <a title="Close" class="btn input-group-addon glyphicon glyphicon-remove geoffencesearch_remove"></a>
    </div>
    <div class="min-max-geo">
      <div style="max-height:220px; font-size:.74em" class="scrollbar" id="style-2">
        <?php foreach($geoffence_data as $geoffencegroupid=>$geoffencegroupdata){?>
        <li class="geoffencegroups_data" data-id="geoffence_<?=$geoffencegroupid?>">
          <div class="node inactive">
            <input type="checkbox" class="geoffencegrouplist" id="geoffencegroup_<?=$geoffencegroupid?>" style="z-index:100000;border:1px solid red;"> <span class="title"><i></i><b><?=strtoupper($geoffencegroupdata['group_name'])?></b></span>
            <span class="template"></span>
          </div>
        </li>
        <ul class="geoffence_search_data" style="padding-left: 0px; display:none" id="geoffencecontainer<?=$geoffencegroupid?>">
          <li style="overflow-y:hidden; " class="scrollbar" id="outergroupcont_<?=$geoffencegroupid?>">
            <?php foreach($geoffencegroupdata as $customerid=>$customerdata){ $customerid=$customerid!=""?$customerid:"0"; if($customerid!="group_name"){ if($geoffencegroupdata['group_name']=='Project site'){ ?>
            <li class="geoffencecustomer_data" data-id="geoffencecustomer_<?=$customerid?>">
              <div class="node inactive geoffencecustomer_data_div">
                <input type="checkbox" class="geoffencecustomerlist childgeoffencegroup_<?=$geoffencegroupid?>" id="geoffencecustomer_<?=$customerid?>" style="z-index:100000;border:1px solid red;"> <span class="title"><i></i><b><?=$customerdata['cust_name']!=""?strtoupper($customerdata['cust_name']):"NO CUSTOMER"?></b></span>
                <span class="template"></span>
              </div>
            </li>
            <ul class="geoffence_search_data" style="padding-left: 0px; display:none" id="geoffencecustomercontainer<?=$customerid?>">
              <li style="overflow-y:hidden; " class="scrollbar" id="ountercustomercont_<?=$customerid?>">
                <?php foreach($customerdata as $geoffencekey=>$geoffencedatas){ if($geoffencekey!="cust_name"){ ?>
                <div class="node inactive disabled" style="float:left; clear:both; width:100%">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" class="geoffence  childgeoffencecustomer_<?=$customerid?>" id="geoffenceid_<?=$geoffencekey?>"> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>  <span class="title scrollbar" id="style-1" style="max-width:198px"><i></i>
                                            <?=$geoffencedatas['description']?></span>
                    </label>
                  </div> <span class="template pull-right">
                                          <a id="locate_<?=$geoffencekey?>" class="btn btn-default template geoffence_focus" title="" data-placement="left" data-toggle="tooltip" data-original-title="Locate">
                                              <i class="fa fa-search"></i>
                                          </a>                 
                                     </span>
                </div>
                <?php } } ?>
              </li>
            </ul>
            <?php }else{ foreach($customerdata as $geoffencekey=>$geoffencedatas){ if($geoffencekey!="cust_name"){ ?>
            <div class="node inactive disabled" style="float:left; clear:both; width:100%">
              <div class="checkbox">
                <label>
                  <input type="checkbox" class="geoffence  childgeoffencegroup_<?=$geoffencegroupid?>" id="geoffenceid_<?=$geoffencekey?>"> <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>  <span class="title scrollbar" id="style-1" style="max-width:198px"><i></i><?=$geoffencedatas['description']?></span>
                </label>
              </div> <span class="template pull-right">
                                    <a id="locate_<?=$geoffencekey?>" class="btn btn-default template geoffence_focus" title="" data-placement="left" data-toggle="tooltip" data-original-title="Locate">
                                        <i class="fa fa-search"></i>
                                    </a>                 
                               </span>
            </div>
            <?php } } } } } ?>
          </li>
        </ul>
        <?php } ?>
        <div class="loaders" style="top: 0px; left: 0px; display: none;">
          <img src="<?=base_url()?>lib/images/loader.gif">
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <!--geofences-->
  <!--geofences toolbox-->
  <div id="GeofenceToolbox" class="toolbox toolbox-child dark-shadow" style="display: none;">
    <div class="header blue-shadow"> <span>Geofences</span>l</div>
    <div class="btn-group"> <a class="btn btn-default polygon_draw" data-type="Polygon" title="" data-original-title="Draw Polygon"><span class="icon icon-polygon"></span></a>
      <a class="btn btn-default polyline_draw" data-type="Polyline" title="" data-original-title="Draw Polyline"><span class="icon icon-polyline"></span></a>
      <a class="btn btn-default geoffence_delete" data-type="Clear" title="" data-original-title="Clear All"><span class="icon icon-close"></span></a>
    </div>
  </div>
  </div>
  <!--geofences toolbox-->
  <input type="hidden" id="postionfunction" value="1">
  <input type="hidden" id="existing_values" value="<?=$existing_id?>">
  <input type="hidden" id="selected_values" value="">
  <input type="hidden" id="unbound_markers" value="">
  <input type="hidden" id="current_selected_values" value="">
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
  <script src="<?=base_url()?>lib/js/jquery.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDfLQ-HGp-RlEF7nfGq2lAI8AZmfBZm7oo&libraries=geometry,drawing"></script>
  <script src="<?=base_url()?>lib/js/jquery-ui.js"></script>
  <script src="<?=base_url()?>lib/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>lib/js/bootstrap-select.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>lib/js/0.9.13/bootstrap-multiselect.js"></script>
  <script src="<?=base_url()?>lib/js/jquery.validate.js"></script>
  <script src="<?=base_url()?>lib/js/sweetalert.min.js"></script>
  <script src="<?=base_url()?>lib/js/jscolor.js"></script>
  <script src="<?=base_url()?>lib/js/menu.js"></script>
  <script>
    var myLatlng;
        var mapOptions;
        var map;
      var drawingManager
      var deltaLat=new Array();
      var deltaLng=new Array();
      var marker = new Array();
      var vehicle = new Array();
      var geoffence=new Array();
      var contentString=new Array();
      var infowindow=new Array();
      var infowindows=new Array();
      var all_overlays=new Array();
      var triangleCoords=new Array();
      var track_pos=new Array();
      var movelatlng=new Array();
      var trackvehicle="";
      var numDeltas =  new Array();
      var delay = new Array(); //milliseconds
      var i = new Array();
      var speed_array=new Array();
      var ignition_array=new Array();
      var heading_array=new Array();
      var icon2=new Array();
      var move_data=new Array();
      var selected_goeffence=new Array();
      var position=new Array();
      var queue = [];
      var truck=new Array();
      var main_queue_status="";
      var animatepoint=new Array();
        var newpoint=new Array(); 
      var colors=new Array();
        var run_loop_animation=new Array;
      var previousangle=new Array();
      var current_angle=new Array();
      var reduced_degree=new Array;
      var rotated_difference=new Array;
      var previousinfowindow="";
      var previousinfowindow1="";
      var previous_imagesize=new Array();
      var firstangleDeg=new Array();
      var markerImage=new Array();
      var traceflag="0";
      var previous_cordinates=new Array();
      var focusflag=new Array();
      var marker_img=new Array();
      var vehicle_rotate_deg =new Array();
      var difference=new Array();
      var unsigned_difference=new Array();
      var ajax_count=0;
      var settimeout="";
      var resettimeout="";
      var logouttimeout="";
      var session_time_flag="1";
      var zommflg_animation=new Array();
      var new_angledeg=new Array();
      var latest_lat=new Array();
      var latest_logn=new Array();
      var previous_data=new Array();
      var previous_rotate_angle=new Array();
      var rotate_status=new Array();
      var previous_bound_marker=new Array();
      var marker1=new Array();
      var previous_bound_inside_marker=new Array();
      var traceallmarkers="0";
      var previous_zoom="16";
      var recallflag="1";
      var ajax_request;
      var previous_status="";
      var scrolltimeout;
      var shippingenerate_timout;
      var shipping_spinner;
      var vehicle_groupwise_status = new Array();
      var vehicle_groupwise_wrkstatus=new Array();
      var current_selected_status=new Array();
    
    
      $('.mybutton_minimise').css("display", "none");
    
      function DeleteMarker_blur(id,flag="0") {
            if(id in marker){
            marker[id].setMap(null);
          delete marker[id];
          }
    
    
          if(id in run_loop_animation)
              delete run_loop_animation[id]
            if(id in infowindow)
              delete infowindow[id];
            if(id in deltaLat)
            delete  deltaLat[id];
          if(id in numDeltas)
            delete numDeltas[id];
          if(id in position)
            delete position[id];
          if(id in animatepoint)
            delete animatepoint[id];
          if(id in delay)
            delete delay[id];
          if(id in deltaLat)
            delete deltaLat[id];
          if(id in newpoint)
            delete newpoint[id];
          if(id in truck)
            delete truck[id];
          if(id in colors)
            delete colors[id];
          if(id in contentString)
            delete contentString[id];
          if(id in current_angle)
            delete current_angle[id];
          if(id in previousangle)
            delete previousangle[id];
          if(id in vehicle_rotate_deg)
            delete vehicle_rotate_deg[id];
          if(id in reduced_degree)
            delete reduced_degree[id];
          if(id in rotated_difference)
            delete rotated_difference[id];
          if(id in rotate_status)
            delete rotate_status[id];
          if(id in marker_img)
            delete marker_img[id];  
              
      }
      
      
       function DeleteMarker(id) {
         
           
            if(id in marker){
              marker[id].setMap(null);
            delete marker[id];
            }
             if(id in movelatlng){
             delete movelatlng[id];
          }
         
              if(id in run_loop_animation)
              delete run_loop_animation[id]
            if(id in infowindow)
              delete infowindow[id];
            if(id in deltaLat)
            delete  deltaLat[id];
          if(id in numDeltas)
            delete numDeltas[id];
          if(id in position)
            delete position[id];
          if(id in animatepoint)
            delete animatepoint[id];
          if(id in delay)
            delete delay[id];
          if(id in deltaLat)
            delete deltaLat[id];
          if(id in newpoint)
            delete newpoint[id];
          if(id in truck)
            delete truck[id];
          if(id in colors)
            delete colors[id];
          if(id in contentString)
            delete contentString[id];
          if(id in truck)
            delete truck[id]; 
            if(id in markerImage)
            delete markerImage[id];
          if(id==trackvehicle){
            trackvehicle="";
             traceflag="0";
          }
          if(id in current_angle)
            delete current_angle[id];
          if(id in previousangle)
            delete previousangle[id];
          if(id in vehicle_rotate_deg)
            delete vehicle_rotate_deg[id];
          if(id in reduced_degree)
            delete reduced_degree[id];
          if(id in rotated_difference)
            delete rotated_difference[id];
          if(id in rotate_status)
            delete rotate_status[id];  
          if(id in marker_img)
             delete marker_img[id];
          if(jQuery.inArray(id, previous_bound_marker) !== -1){
            previous_bound_marker.remove(id);
          }
            };  
      
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
             wmaxHeight: 300
        });
      
       var elem = document.documentElement;
      
      $('.mybutton_Maximise').click(function() { 
    
        $('.mybutton_minimise').show();
        $(".mybutton_Maximise").css("display", "none");
     
          if (elem.requestFullscreen) {
             elem.requestFullscreen();
          } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
          } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            elem.webkitRequestFullscreen();
          } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
          }
      
      });
      
      $('.mybutton_minimise').click(function() {
    
        $('.mybutton_Maximise').show();
        $(".mybutton_minimise").css("display", "none");
    
         
    
    
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
    
    
      });
    
    
      $(".multiselect-container").children(".multiselect-group-clickable").children("a").children("b").addClass('multiselect-mainhead');
      
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
      
       function updateClock()
      {
        //var today = new Date();
      
        var oldDate = new Date();
        var hour = oldDate.getHours();
        var newDate = oldDate.setHours(hour + 1);
        //console.log(newDate);
        
        
      
        
        $('#datetimepicker1').datetimepicker({
          showClose:true,
           //format: 'DD.MM.YYYY hh:mm',
          //format: 'DD.MM.YYYY',
           maxDate: newDate,
           
        });
         
         
      
      }
          
       updateClock();
      
      
      $(document).on("click", '#shipment', function (event) {
        $("#shipModal").modal({backdrop: 'static'});
        $('#shipModal').modal('show');
        
      });
      
      $('#shipModal').on('hidden.bs.modal', function (e) {
        if (shippingenerate_timout !== null) {
          console.log(123);
            clearTimeout(shippingenerate_timout);
            console.log(shippingenerate_timout);
         }
       
        })
      
     
    function initialize() {
       myLatlng = new google.maps.LatLng("25.286106","51.534817");
         var mapOptions = {
            zoom: 10,
            center: myLatlng,
        maxZoom: 20, 
        //minZoom: 9, 
        //scrollwheel: false,
        mapTypeIds: ['coordinate', 'roadmap'],
         disableDefaultUI: true,
         zoomControl: true,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.LEFT_BOTTOM
                    },
        mapTypeId: google.maps.MapTypeId.ROADMAP 
          };
         map = new google.maps.Map(document.getElementById("map"), mapOptions);
       
    }   
       
       
     initialize()
     $('.switch-icons').on('click',function(){
            if($(this).html()==='-'){
          $(this).html('+');
          $("#vehicle_search").hide();
          }
            else $(this).html('-')
            $('.min-max').slideToggle();
    });
    
    $('.switch-icons-geo').on('click',function(){
            if($(this).html()==='-'){$(this).html('+'); $("#geoffence_search").hide();}
            else $(this).html('-')
            $('.min-max-geo').slideToggle();
    });
    
     
     
    $(window).on("load", function(e) {
      
      var $th = $('#shiping_table_div').find('thead th')
    $('#shiping_table_div').on('scroll', function() {
      $th.css('transform', 'translateY('+ this.scrollTop +'px)');
    });
      
      var resettimeout="";
        var session_time_flag="1";
      var storage_time_flag="1";
      
    document.addEventListener("visibilitychange", function() {
      
      if(document.visibilityState=="hidden"){
        
           $.each( vehicle, function( key, id ) {
             delete vehicle[key];
             DeleteMarker_blur(id);
         }); 
         if (resettimeout !== null) {
            clearTimeout(resettimeout);
         }  
          
      }else{
        
          $.ajax({
               url: "<?php echo  base_url(); ?>footer/login_check",  
               type: 'post',
               success:function(result){
                var data = $.parseJSON(result); 
                 if(data.status=="1"){ 
                    clearTimeout(resettimeout);
                    resetstoragetimer();
                   var existed_data=$("#selected_values").val().split(",");
                   //console.log(existed_data);
                   $.each( existed_data, function( key, id ) {
                       vehicle[id]=id;
                   });
                   vehicle_map_listing("2"); 
                   console.log();
                 }else{
                    localStorage.setItem('logout-event', 'logout');
                   swal({
                       text: "SORRY !!! Your Login Session was already Timeout",
                       icon: "error",
                       button: "ok",
                   }).then(function(){
                         url=  "<?php echo  base_url(); ?>";
                         window.location.href = url;
                   });
                 }
               }
               
           });
      }
      }, false);
       
        if (resettimeout !== null) {
         clearTimeout(resettimeout);
        }
        resetstorage();
        resetstoragetimer();
        document.onkeypress = resetstorage;
        document.onmouseover = resetstorage;
      
      
          function resetstorage(){
         
          if(storage_time_flag=="1"){
              var dt = new Date();
              localStorage.setItem('logouttime',dt.getTime());
            localStorage.setItem('logout-event', 'logedin');
          }
         }
        
        function resetstoragetimer(){
         
          var logouttime=localStorage.getItem('logouttime');
          var dt = new Date();
            if((dt.getTime()-logouttime)/1000>1200){
            logout();
            clearTimeout(resettimeout);
          }else if((dt.getTime()-logouttime)/1000>1140){
            if(session_time_flag=="1"){
              session_time_flag="0";
              storage_time_flag="0"
                warning();
            }
          }
         resettimeout = setTimeout(resetstoragetimer,2000);
        }
        
          function logout() {
          
            $.ajax({
            url: "<?php echo  base_url(); ?>footer/auto_logout",  
            type: 'post',
            success:function(result){
             swal({
                 text: "Your Login Session Timeout",
                 icon: "error",
                 button: "ok",
             }).then(function(){
                localStorage.setItem('logout-event', 'logout');
                url=  "<?php echo  base_url(); ?>";
                window.location.href = url;
             });
             }
          });
           }
         
         
      function warning(){
        
         
        swal({
          title: "Are you sure?",
          text: "Your Session will be expire soon.Do you want to continue?",
          icon: "warning",
          timer: 58000,
          buttons: true,
          dangerMode: true,
        }).then((willUpdate) => {
          
            if(willUpdate){
               $.ajax({
               url: "<?php echo  base_url(); ?>footer/login_check",  
               type: 'post',
               success:function(result){
                var data = $.parseJSON(result); 
                 if(data.status=="1"){ 
                    storage_time_flag="1";
                  resetstorage();
                 }else{
                    localStorage.setItem('logout-event', 'logout');
                   swal({
                       text: "SORRY !!! Your Login Session was already Timeout",
                       icon: "error",
                       button: "ok",
                   }).then(function(){
                      
                       url=  "<?php echo  base_url(); ?>";
                        window.location.href = url;
                   });
                 }
               }
               
               });
            }else{
              logout();
             
            }
       });
      }
      
       $(document).on("click", '.logout', function (event) {
        swal({
            title: "Are you sure?",
            text: "Do you really want to Logout?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then(function(logout){
            if(logout){
            localStorage.setItem('logout-event', 'logout');
            url=  "<?php echo  base_url(); ?>";
            window.location.href = url;
            }
          });
       });
     
     
     
     function generate_shipping(from_time,geoffence){
        
         $.ajax({
           url: "<?php echo  base_url(); ?>index/shipping_status",  
           type: 'post',
           data:{from_time:from_time,geoffence:geoffence},
             success:function(result){
             $("#shipping_generate").removeAttr("disabled");
            var data = $.parseJSON(result); 
             if(data.error_flag=="1"){
               swal({
                                     text: data.error_message,
                                     icon: "error",
                                     button: "ok",
                         });
             }else{
               $("#shipping_result").html(data.information);
                $("#shiping_table_div").removeClass("collapse");
                shippingenerate_timout= setTimeout(function(){
                  generate_shipping(from_time,geoffence);
               },600000);
             }
             shipping_spinner.fadeOut();
           }
          });
     }
    
         
       $(document).on("click", '#shipping_generate', function (e) {
         
         e.preventDefault();
         if($("#commentForm1").valid()){
           
            var geoffence = [];
                 $.each($("#Geoffence_name option:selected"), function(){            
                   geoffence.push($(this).val());
                 });
          if(geoffence.length==0){
                  $("#Geoffence_name").next(".btn-group").after('<label id="Geoffence-error" class="error" for="Geoffence_name">This field is required.</label>');
            }else{
                shipping_spinner = $(".loader2").insertAfter(this);
               shipping_spinner.fadeIn();
             var from_time=$("#start_date").val();
             var geoffence=$("#Geoffence_name").val();
             $("#shipping_generate").attr("disabled", "disabled");
             generate_shipping(from_time,geoffence);
          }
         }
       });
       
         $('[data-toggle="tooltip"]').tooltip(); 
       $('input:checkbox').removeAttr('checked');
       $( function() {
           $( "#div_table" ).draggable({
           handle: "#draggable",    
           containment: 'body',
               drag: function( event, ui ) {
                 $( this ).css('bottom','unset');
             }
          });
      
          $( "#FleetDialog" ).draggable({
           handle: "#draggablefleets",    
           containment: 'body',
               drag: function( event, ui ) {           
             $( this ).css('top','unset');
            }
          });
      
         });
       
      
    
         $("#ControlPanelList a").hover(function () {
                var title = $(this).data("title");
                $("#ControlPanelList .control-panel-header").html(title);
         });
       
         $("#ControlPanelList").hover(function () {
                $("#ControlPanelList .control-panel-header").html('Control Panel');
         });
       
         drawingManager = new google.maps.drawing.DrawingManager({
                                 drawingControl: false,
                           });
         
      var polygonarray=[];
      var polylinenarray=[];
      var infowindow=[];
      /*validation plugin started*/
       $('#commentForm').validate({ // initialize the plugin
            rules: {
                importance: {
                    selectcheck: true
                },
          trigger: {
                    selectcheck: true
                }
             }
        });
       
      
      jQuery.validator.addMethod('selectcheck', function (value) {
                   return (value != 'select');
             }, "This field is required");
         $(".selectpicker").change(function(){
         $("#commentForm").valid();
       });
       
     
    
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
       
       
       
       
       
    function marker_movement(id,callback){
      
      
      if((id in marker)){
        
        if(!(id in latest_lat)){
         latest_lat[id]=new Array();
         latest_logn[id]=new Array();
        }
        
        if(typeof(position[id])=='undefined'){
          
           i[id]=0;
           run_loop_animation[id]=1;
           callback(id);
        }else{
          
         if(newpoint[id].lat!=latest_lat[id] && newpoint[id].logn!=latest_logn[id]){
            position[id][0] += deltaLat[id];
            position[id][1] += deltaLng[id];
         }
         
         newpoint[id].lat=parseFloat(newpoint[id].lat);
         newpoint[id].logn=parseFloat(newpoint[id].logn);
         
            if(deltaLat[id]<0){
           
           if(position[id][0]<newpoint[id].lat){
             latest_lat[id]=(newpoint[id].lat);
           }else{
             latest_lat[id]=(position[id][0]);
           }
           
         }else{
           if(position[id][0]>newpoint[id].lat){
             latest_lat[id]=(newpoint[id].lat);
           }else{
             latest_lat[id]=(position[id][0]);
           }
           
         }
         if(deltaLng[id]<0){
           if(position[id][1]<newpoint[id].logn){
             latest_logn[id]=(newpoint[id].logn);
           }else{
             latest_logn[id]=(position[id][1]);
              //console.log(newpoint[id].name +" was enter into last position in positive")
           }
           
         }else{
           if(position[id][1]>newpoint[id].logn){
             latest_logn[id]=(newpoint[id].logn);
           }else{
             latest_logn[id]=(position[id][1]);
             
           }
         }
         
          movelatlng[id] = new google.maps.LatLng(latest_lat[id],latest_logn[id]);
           
         if(trackvehicle!=""){
            if(marker[trackvehicle]!=null && marker[trackvehicle]!=""){
              if(trackvehicle==id){
                //console.log(zommflg_animation[id]);
                track_pos[0]=marker[trackvehicle].getPosition();
                track_pos[1]=movelatlng[id];
                if(track_pos[0]!=track_pos[1]){
                  
                  draw_Polyline(track_pos,color[id]);
                  
                  if(traceflag=="1"){
                    traceallmarkers="0";
                     var bounds = new google.maps.LatLngBounds();
                     map.setCenter(movelatlng[id]);
                     bounds.extend(movelatlng[id]);
                     marker[trackvehicle].setClickable(false);
                     infowindows[trackvehicle].open(map, marker[trackvehicle]);
                     if(recallflag=="1"){
                       recallflag="0";
                       recallmarker(function(){ 
                      recallflag="1";
                     });
                     }
                  }
                }
              }
             }
             
         }else{
           marker[id].setClickable(true); 
         }
         
         
        if(newpoint[id].ign_status=="ON"){
          
           truck[id]="<?=base_url()?>lib/images/group_icons/"+newpoint[id].idle+"#"+id;
           
          if(newpoint[id].speed< 1){
            
             if(newpoint[id].lat==latest_lat[id] && newpoint[id].logn==latest_logn[id]){
               
              truck[id]="<?=base_url()?>lib/images/group_icons/"+newpoint[id].idle+"#"+id;
              colors[id]="orange";
              $("#status_"+id).attr("src","<?=base_url()?>lib/images/ideal.png");
              $("#label_"+id).html("Idle Duration");
              $("#duration_"+id).html("00:00:00");
              
             }else{
              
              truck[id]="<?=base_url()?>lib/images/group_icons/"+newpoint[id].run+"#"+id;
              colors[id]="green";
              $("#status_"+id).attr("src","<?=base_url()?>lib/images/run.png");
             }
          }else{
            truck[id]="<?=base_url()?>lib/images/group_icons/"+newpoint[id].run+"#"+id;
            colors[id]="green";
            $("#status_"+id).attr("src","<?=base_url()?>lib/images/run.png");
          }
         }else{
           truck[id]="<?=base_url()?>lib/images/group_icons/"+newpoint[id].stop+"#"+id;
           colors[id]="#FF0800";
           $("#status_"+id).attr("src","<?=base_url()?>lib/images/stop.png");
         } 
          
             if(typeof(marker_img[id])!="undefined"){
              marker_img[id].attr("src",truck[id]);
              
            }else{
              
              //console.log("image gone for the vehicle"+newpoint[id].name);
             markerImage[id] = new google.maps.MarkerImage(truck[id],
                   new google.maps.Size( 52, 52),
                   new google.maps.Point(0, 0),
                   new google.maps.Point(26,26));
               marker[id].setIcon(markerImage[id]);
               
            }
            marker_img[id] =$('img[src="'+truck[id]+'"]');
             if(typeof(marker_img[id])=="undefined"){
               
              // console.log(" image is going for the vehicle "+newpoint[id].name );
             }
            
            if(i[id]!=numDeltas[id]){
              
             if(newpoint[id].lat!=latest_lat[id] && newpoint[id].logn!=latest_logn[id]){
                new_angledeg[id]=Math.round(getBearing(previous_data[id]["lat"],previous_data[id]["logn"],latest_lat[id],latest_logn[id]).toFixed(2));
             }
             
              previous_data[id]["lat"]=latest_lat[id];
              previous_data[id]["logn"]=latest_logn[id];
               
               i[id]++;
               run_loop_animation[id]=0;
             
              if( newpoint[id].ign_status=="ON"){
                
                if(zommflg_animation[id]=="1"){
                  rotateMarker(id,new_angledeg[id],"",function(){
                     marker[id].setPosition(movelatlng[id]);
                     infowindows[id].setPosition(movelatlng[id])
                     setTimeout(function(){
                         marker_movement(id,callback);
                     }, delay[id]);
                  });
                   
                }else{
                  
                  if(newpoint[id].ign_status=="ON" && newpoint[id].speed == '0'){ 
                    var current_label= $("label_"+id).html();
                    if(current_label=="Running Duration" || current_label=="Stop Duration"){
                      $("#label_"+id).html("Idle Duration");
                      $("#duration_"+id).html("00:00:00");
                    }
                  }else if(newpoint[id].ign_status=="off"){
                    if(current_label=="Running Duration" || current_label=="Idle Duration"){
                      $("#label_"+id).html("Stop Duration");
                      $("#duration_"+id).html("00:00:00");
                    }
                    
                  }
                  
                  
                  i[id]=0;
                  run_loop_animation[id]=1;
                  
                   setTimeout(function(){
                     marker_movement(id,callback);
                   }, delay[id]);
                }
              }
           }else{
             
             
             if(newpoint[id].ign_status=="ON" && newpoint[id].speed == '0'){ 
              var current_label= $("label_"+id).html();
              if(current_label=="Running Duration" || current_label=="Stop Duration"){
                $("#label_"+id).html("Idle Duration");
                $("#duration_"+id).html("00:00:00");
              }
            }else if(newpoint[id].ign_status=="off"){
              if(current_label=="Running Duration" || current_label=="Idle Duration"){
                $("#label_"+id).html("Stop Duration");
                $("#duration_"+id).html("00:00:00");
              }
              
            }
             i[id]=0;
              
             rotateMarker(id,new_angledeg[id],"",function(){
                 marker[id].setPosition(movelatlng[id]);
                 run_loop_animation[id]=1;
                 callback(id);
                     
             });
           }
        } 
       }else{
           //console.log(id+" Not in marker");
       }
       
      
    }
     
     
     function transition(newpoint,id,movemarkercallback){
       
       rotate_status[id]=0;
       
        if(!$.isArray(previous_cordinates[id])){
              previous_cordinates[id]=new Array();
            previous_cordinates[id]["lat"]=marker[id].getPosition().lat();
            previous_cordinates[id]["log"]=marker[id].getPosition().lng();
        }
        
        
          if((previous_cordinates[id]['lat']!=newpoint[id].lat) && (previous_cordinates[id]['log']!==newpoint[id].logn)){
      
             colors[id]=new Array();
           
             if(!$.isArray(position[id])){
             position[id] =new Array();
           }
           
           position[id][0] = marker[id].getPosition().lat();
           position[id][1] = marker[id].getPosition().lng();
          
           var distance=(getDistanceFromLatLonInKm(previous_cordinates[id]['lat'],previous_cordinates[id]['log'],newpoint[id].lat,newpoint[id].logn)*1000).toFixed(4);
     
     
             if(animatepoint[id].length>=2){
           
                 if(animatepoint[id].length<=10){
                  delay[id]=30;
                  numDeltas[id]=50;
               }else if(animatepoint[id].length<=20){
                delay[id]=15;
                  numDeltas[id]=40;
               }else if(animatepoint[id].length<=30){
                delay[id]=5;
                  numDeltas[id]=35;
               }else{
                 delay[id]=1;
                  numDeltas[id]=30;
               }
           
           }else{
               if(distance<10){
               delay[id]=80;
               numDeltas[id]=80;
             }
             else if(distance<20){
               delay[id]=70;
               numDeltas[id]=50;
             }else if(distance<35){
               delay[id]=40;
               numDeltas[id]=70;
             }else if(distance<60){
               delay[id]=60;
               numDeltas[id]=90;
             }else if(distance<90){
               delay[id]=100;
               numDeltas[id]=120;
             }else if(distance<120){
               delay[id]=120;
               numDeltas[id]=150;
             }else if(distance<150){
               delay[id]=120;
               numDeltas[id]=200;
               
             }else if(distance<300){
               delay[id]=150;
               numDeltas[id]=250;
             }else{
                delay[id]=170;
                numDeltas[id]=300;
             }
             }
           
            previous_cordinates[id]['lat']=newpoint[id].lat;
            previous_cordinates[id]['log']=newpoint[id].logn;
           
           
           deltaLat[id] = (newpoint[id].lat- position[id][0])/numDeltas[id];
           deltaLng[id] = (newpoint[id].logn-  position[id][1])/numDeltas[id];
           //console.log("queue started for the id "+id);
           
           i[id]=0;
           
           marker_movement(id,function(id){
             
             if(typeof(animatepoint[id])!=="undefined"){
               if(animatepoint[id].length>0){
                    movemarkercallback(id);
                 } 
             }
             });
          } else{
          
           run_loop_animation[id]=1;
           
           truck[id]="<?=base_url()?>lib/images/group_icons/"+newpoint[id].idle+"#"+id;
           
           if(newpoint[id].ign_status=="ON" && newpoint[id].speed == '0'){
              truck[id]="<?=base_url()?>lib/images/group_icons/"+newpoint[id].idle+"#"+id;
              colors[id]="orange";
            $("#status_"+id).attr("src","<?=base_url()?>lib/images/ideal.png");
             var current_label= $("label_"+id).html();
             
             
              if(current_label=="Running Duration" || current_label=="Stop Duration"){
                    $("#label_"+id).html("Idle Duration");
                    $("#duration_"+id).html("00:00:00");
              }
             
           }else if(newpoint[id].ign_status=="ON" && newpoint[id].speed > 1){
              truck[id]="<?=base_url()?>lib/images/group_icons/"+newpoint[id].run+"#"+id;
              colors[id]="green";
            $("#status_"+id).attr("src","<?=base_url()?>lib/images/run.png");
           }else{
              truck[id]="<?=base_url()?>lib/images/group_icons/"+newpoint[id].stop+"#"+id;
              colors[id]="#FF0800";
              $("#status_"+id).attr("src","<?=base_url()?>lib/images/stop.png");
           }
              
           if(typeof(marker_img[id])!="undefined"){
               marker_img[id].attr("src",truck[id]);
           }
           marker_img[id] =$('img[src="'+truck[id]+'"]');
             movemarkercallback(id);
        }
     }
     
      
     
     function move_marker(id){
       
         newpoint[id] = animatepoint[id].shift();
       
       if(typeof(newpoint[id].duration)=="undefined"){
         if(newpoint[id].ign_status=="OFF"){
           newpoint[id].label="Stop Duration";
         }else{
           if(newpoint[id].speed>0){
             newpoint[id].label="Running Duration";
           }else{
              newpoint[id].label="Idle Duration";
           }
         }
          newpoint[id].duration="00:00:00";
       }
    
    
         var style="";
         if(newpoint[id].delay_time>1800){
            style='style="background-color:#ff7070;"';
         }
      
      // <tr><th>Odometer</th><td>'+newpoint[id].odometer+'</td></tr>
        contentString[id]='<div id="infowindow_'+id+'" class="info-window" style="display: block; " ><div class="header"><span class="title">'+newpoint[id].name+'</span></div><div class="content"><div style="margin-bottom:0px; width:308px"><table class="table-striped" style="margin-bottom:0px;"><tbody><tr><th>Plate Number</th><td>'+newpoint[id].description+'</td></tr><tr><th>Speed</th><td>'+newpoint[id].speed+'</td></tr><tr><th>Ignition</th><td>'+newpoint[id].ign_status+'</td></tr><tr><th>Latitude</th><td>'+newpoint[id].lat+'</td></tr><tr><th>Longitude</th><td>'+newpoint[id].logn+'</td></tr><tr><th>Fleet</th><td>'+newpoint[id].group_name+'</td></tr>';
    
         if(typeof(newpoint[id].drivername1)!=='undefined'){
            contentString[id]+='<tr><th>ibutton Driver Name</th><td>'+newpoint[id].drivername1+'</td></tr><tr><th>ibutton Driver Phone</th><td>'+newpoint[id].driverphone1+'</td></tr>';
         }
     
        contentString[id]+='<tr><th>Driver Name</th><td>'+newpoint[id].drivername+'</td></tr><tr><th>Driver Phone</th><td>'+newpoint[id].driverphone+'</td></tr> <tr '+style+'><th>Server Date</th><td>'+newpoint[id].created+'</td></tr><tr><th>GPS Date</th><td>'+newpoint[id].device_timestamp+'</td></tr><tr><th>GPS Status</th><td>'+newpoint[id].gps_status+'</td></tr>';
      
                         if(newpoint[id].workshop_status=="1"){
                  contentString[id]+='<tr><th>Workshop Status</th><td>Under Workshop</td></tr>';
                         }
                         if(newpoint[id].longstop_status=="1"){
                  contentString[id]+='<tr><th>Longtime Status</th><td>Stopped</td></tr>';
                         }
                   contentString[id]+='<tr><th id="label_'+id+'">'+newpoint[id].label+'</th><td id="duration_'+id+'">'+newpoint[id].duration+'</td></tr></tbody></table></div></div></div>';
      
      
      
      
     
     infowindow[id].setContent(contentString[id]);
     
        if(typeof newpoint[id] !== "undefined") {
        
        transition(newpoint,id,function(id){      
          //console.log("current rotation movemarker id is "+id);
          if(typeof(animatepoint[id])!=="undefined"){
             if(animatepoint[id].length>0){
               move_marker(id);
             }
            }else{
             move_marker(id);
          }
        });
        
      }
     }
        
       function vehicle_map_listing(status="",vehicle_map_callback=""){
          
    
          vehiclelistingstatus=true;
          
     
            if(status=="1"){
               var url="<?=base_url()?>index/get_lastpositions";
                var vehicle_new = vehicle.filter(function(v){return v!==''}).toString();
            }else if(status=="2"){
              
               var url="<?=base_url()?>index/get_position"; 
               var vehicle_new=$("#selected_values").val();
               
            }else if(status=="3"){
                 var vehicle_new=$("#unbound_markers").val();
                 var url="<?=base_url()?>index/get_position"; 
            
            }else{
               var vehicle_new=$("#current_selected_values").val();
               var url="<?=base_url()?>index/get_position"; 
            }
            
            
           // console.log("got request");
               if(vehicle_new!=""){
             
               vehicle_exist=$("#existing_values").val();
                 var start_time = new Date().getTime();
               //"<?=base_url()?>index/get_position_chack"
             
             if(status=="3"){
               if(ajax_request && ajax_request.readyState != 4 && previous_status!="3" && previous_status!="4"){
                          ajax_request.abort();
                clearTimeout(settimeout);
                if(ajax_count>0){
                  ajax_count-=1;
                }
               // console.log("ajax request aborted");
                       }
             }else{
               if(previous_status!="3" && (previous_status!="4")){
                 if(ajax_request && ajax_request.readyState != 4){
                  // console.log("ajax request is pending");
                               ajax_request.abort();
                   clearTimeout(settimeout);
                   if(ajax_count>0){
                     ajax_count-=1;
                   }
                             }
               }
             }
     
            ajax_request= $.ajax({
                  url:url ,  
                  data:{vehicle:vehicle_new,vehicle_exist:vehicle_exist},
                  type: 'post',
                  beforeSend: function(){
                    ajax_count+=1;
                    clearTimeout(settimeout);
                
                  },
                  success: function(result){
                   if(ajax_count>0){
                      ajax_count-=1;
                   }
                
                //console.log("ajax count is "+ ajax_count);
                  var count = 0;
                 var vehicle_count=1;
                 
                     
                   var response = $.parseJSON(result);
                 vehiclemap_status="1";
                 var marker1=new Array();
                 
                 if(status==""){
                      var recall_id="";
                     var data_vehicle= Object.keys(response);//contain all the selected vehicle id which have data
                      var selected_vehicle=vehicle_new.split(",");
    
                     var notinlist=($(selected_vehicle).not(data_vehicle));
                     console.dir(notinlist);
                      $.each( notinlist, function( key, id ) {
                         // $("#vehicleid_"+id).prop('checked',false);
                         //   delete vehicle[id];
                          recall_id+=id+",";
                     });
                      if(recall_id!=""){
                        recall_id=recall_id.slice(0,-1);
                       $("#current_selected_values").val(recall_id);
                        vehicle_map_listing();
    
                      }
                       
          
                 }
                   if((Object.keys(response).length) > 0){
                   
                      $.each( response, function( key, vehicledatas ) {
                      
                     if(vehicledatas.length>0){
                       
                       var id =key;
                       var j="1";
                       
                       if(vehicledatas.length>1){//sorting multiple data.FIFO
                           vehicledatas.sort(function(a, b) {
                              return a["device_timestamp1"] - b["device_timestamp1"];
                           });
                         }
                       
                       // console.log(vehicledatas);
     
                       
                         $.each(vehicledatas,function( key, vehicledata ){
    
                          var current_selected_values="";
                          if(vehicledata.department_id in current_selected_status){
                              current_selected_values= current_selected_status[vehicledata.department_id];
                          }
                         
                         
    
    
                          var statusfieldname ="";
                          var statusfieldvalue="";
    
                          if(current_selected_values=="1"){
                            statusfieldname=vehicledata.ign_status;
                            statusfieldvalue="ON";
                          }else if(current_selected_values=="2"){
                            statusfieldname=vehicledata.ign_status;
                            statusfieldvalue="OFF";
                          }else if(current_selected_values=="3"){
                            statusfieldname=vehicledata.workshop_status; 
                            statusfieldvalue="1";
                          }else if(current_selected_values=="4"){
                            statusfieldname=vehicledata.longstop_status; 
                            statusfieldvalue="1";
                          }
    
    
                           
     
                         if(vehicle[id]!=null && vehicle[id]!="" ){
    
    
                            if(vehicledata.lat!="" & vehicledata.logn!="" & vehicledata.lat!="0" & vehicledata.logn!="0"){
    
    
                              if(statusfieldname=="" || statusfieldname==statusfieldvalue){
    
                                $("#vehicle_container_"+vehicledata.id).removeClass("collapse");
     
    
                                if(!(id in marker)){
                                  
                                if(vehicledata.ign_status=="ON"){
                                   if(vehicledata.speed < "1" ){
                                     color[id]="orange";
                                     truck[id]="<?=base_url()?>lib/images/group_icons/"+vehicledata.idle+"#"+id;
                                     $("#status_"+id).attr("src","<?=base_url()?>lib/images/ideal.png");
                                   }
                                  else{
                                     color[id]="green";
                                     truck[id]="<?=base_url()?>lib/images/group_icons/"+vehicledata.run+"#"+id;
                                     $("#status_"+id).attr("src","<?=base_url()?>lib/images/run.png");
                                  }
                                  }else{
                                   color[id]="#FF0800";
                                  truck[id]="<?=base_url()?>lib/images/group_icons/"+vehicledata.stop+"#"+id;
                                  $("#status_"+id).attr("src","<?=base_url()?>lib/images/stop.png");
                                  }
                                
    
    
                                
                                if(typeof(vehicledata.duration)=="undefined"){
                                   if(vehicledata.ign_status=="OFF"){
                                     vehicledata.label="Stop Duration";
                                   }else{
                                     if(vehicledata.speed>0){
                                       vehicledata.label="Running Duration";
                                     }else{
                                        vehicledata.label="Idle Duration";
                                     }
                                   }
                                   vehicledata.duration="00:00:00";
                                 }
                                
                                 if(vehicledata.speed=="0" && vehicledata.ign_status=="ON"){
                                    //console.log(vehicledata.speed+"----"+vehicledata.ign_status+"------"+vehicledata.label);
                                   if(vehicledata.label=="Running Duration" || vehicledata.label=="Stop Duration"){
                                    // console.log(id);
                                     vehicledata.label="Idle Duration";
                                      vehicledata.duration="00:00:00";
                                   }
                                 }
                                 
                                  
                                 
                                 
                                 var style="";
                                 if(vehicledata.delay_time>1800){
                                    style='style="background-color:#ff7070;"';
                                 }
                                 
                                 // <tr><th>Odometer</th><td>'+vehicledata.odometer+'</td></tr>
                                 
                                  contentString[id]='<div id="infowindow_'+id+'" class="info-window" style="display: block;"><div class="header"><span class="title">'+vehicledata.name+'</span></div><div class="content"><div style="margin-bottom:0px; width:308px"><table class="table-striped" style="margin-bottom:0px;"><tbody><tr><th>Plate Number</th><td>'+vehicledata.description+'</td></tr><tr><th>Speed</th><td>'+vehicledata.speed+'</td></tr><tr><th>Ignition</th><td>'+vehicledata.ign_status+'</td></tr><tr><th>Latitude</th><td>'+vehicledata.lat+'</td></tr><tr><th>Longitude</th><td>'+vehicledata.logn+'</td></tr><tr><th>Fleet</th><td>'+vehicledata.group_name+'</td></tr>';
    
                                  if(typeof(vehicledata.drivername1)!=='undefined'){
                                    contentString[id]+='<tr><th>ibutton Driver Name</th><td>'+vehicledata.drivername1+'</td></tr><tr><th>ibutton Driver Phone</th><td>'+vehicledata.driverphone1+'</td></tr>';
                                  }
                                    
                                    contentString[id]+='<tr><th>Driver Name</th><td>'+vehicledata.drivername+'</td></tr><tr><th>Driver Phone</th><td>'+vehicledata.driverphone+'</td></tr> <tr '+style+'><th>Server Date</th><td>'+vehicledata.created+'</td></tr><tr><th>GPS Date</th><td>'+vehicledata.device_timestamp+'</td></tr><tr><th>GPS Status</th><td>'+vehicledata.gps_status+'</td></tr>';
                                   if(vehicledata.longstop_status=="1"){
                                       contentString[id]+='<tr><th>Longtime Status</th><td>Stopped</td></tr>';
                                    }
    
                                if(vehicledata.workshop_status=="1"){
                                   contentString[id]+='<tr><th>Workshop Status</th><td>Under Workshop</td></tr>';
                                }
                                 contentString[id]+='<tr><th id="label_'+id+'">'+vehicledata.label+'</th><td id="duration_'+id+'">'+vehicledata.duration+'</td></tr></tbody></table></div></div></div>';
                                
                                
                                var heading = parseInt(vehicledata.Heading);
                                 
                                 //var myLatlng = new google.maps.LatLng(vehicledata.lat,vehicledata.logn);
                                 
                                movelatlng[id] = new google.maps.LatLng(vehicledata.lat,vehicledata.logn);
                                
     
                                 markerImage[id] = new google.maps.MarkerImage(truck[id],
                                            new google.maps.Size( 52, 52),
                                            new google.maps.Point(0, 0),
                                            new google.maps.Point(26,26));
                                            
                                  // orig 10,50 back of car, 10,0 front of car, 10,25 center of car
                                  //Shapes define the clickable region of the icon.
                                  
                                  var shape = {
                                    coords: [13, 3, 40, 50],
                                    type: 'rect'
                                  };
                                  
                                  
                                  marker[id] = new google.maps.Marker({
                                            position: movelatlng[id],
                                            map: map,
                                            icon:markerImage[id],
                                            //opacity:0,
                                            shape: shape,
                                            //zIndex:99,
                                            optimized: false,
                                  });
                                  
                                  if(status=="" && (map.getBounds().contains(movelatlng[id]))){
                                    previous_bound_inside_marker.push(parseInt(id));
                                  }
                                  
     
                                if((map.getBounds().contains(movelatlng[id])) || (trackvehicle==id) || focusflag[id]=="1"){    
                                  
                                    if(status=="3"){
                                       
                                       if(focusflag[id]=="1"){
                                        map.setCenter(movelatlng[id]); 
                                       }else if(trackvehicle==id){
                                        map.setCenter(movelatlng[id]); 
                                        
                                       }
                                     }
                                      
                                     marker[id].setOpacity(0);
                                     marker1.push(id);
                                    
                                   } 
                                   
                                   
                                   new_angledeg[id]=heading;
                                   previous_data[id]=new Array();
                                   previous_data[id]=new Array();
                                   previous_data[id]["lat"]=vehicledata.lat;
                                   previous_data[id]["logn"]=vehicledata.logn;
                                   latest_lat[id]=vehicledata.lat;
                                   latest_logn[id]=vehicledata.logn;
                                  
                                  infowindow[id]= new google.maps.InfoWindow({
                                         // pixelOffset: new google.maps.Size(0, 10),
                                          disableAutoPan: true,
                                          maxWidth: 310
                                  });
                                       
                                       
                                  infowindows[id]= new google.maps.InfoWindow({
                                        // pixelOffset: new google.maps.Size(0, 10),
                                          disableAutoPan: true,
                                          maxWidth: 310
                                   });
                                    
                                    
                                        
                                        
                                   google.maps.event.addListener( marker[id], 'click', function() {
                                     
                                     if(previousinfowindow!=""){
                                       previousinfowindow.close();
                                     }
                                     if(previousinfowindow1=""){
                                       previousinfowindow1.close();
                                     }
                                     
                                   
                                     infowindows[id].close();
                                     infowindow[id].setContent(contentString[id]);
                                     infowindow[id].open(map, marker[id]);
                                     previousinfowindow=infowindow[id];
                                     
                                    
                                     setTimeout(function(){
                                       
                                       
                                      $(".info-window").closest(".gm-style-iw").addClass("has-pos-absolute");
                                      $(".info-window").parentsUntil(".gm-style-iw").addClass("full-width");
                                      //$(".gm-style-iw").parent("div").addClass('maximum-width');
                                      $(".gm-style-iw").parent().children().children("div").addClass('maximum-width');
                                    
                                                                  
                                     },20);
                                     
                                   });
                                   
                                   
                                   infowindows[id].setContent(vehicledata.name);
                                   
                                   google.maps.event.addListener( marker[id], 'mouseover', function() {
                                    if(previousinfowindow1!="")
                                      previousinfowindow1.close();
                                    if (!isInfoWindowOpen(id)){  
                                       infowindows[id].open(map, marker[id]);
                                      previousinfowindow1=infowindows[id];
                                    }
                                   });
                                   
                                   google.maps.event.addListener( marker[id], 'mouseout', function() {
                                    infowindows[id].close();
                                     previousinfowindow1="";
                                   });
                                
                                 zommflg_animation[id]="1";
                                 newpoint[id]=vehicledata;
                                 focusflag[id]="0";
                                 count++;
                                   
                              }else{
                                
                                 if(!Array.isArray(animatepoint[id])){
                                  animatepoint[id]=new Array();
                               }
                               if(!(id in run_loop_animation)){
                                 run_loop_animation[id]=1;
                               }
                                animatepoint[id].push(vehicledata);
                                  
                                 if(j==vehicledatas.length){
                                   if(animatepoint[id].length>=2){
                                       if(animatepoint[id].length<=10){
                                        delay[id]=50;
                                       }else if(animatepoint[id].length<=20){
                                         delay[id]=20;
                                         
                                       }else if(animatepoint[id].length<=30){
                                          delay[id]=8;
                                       }else{
                                         delay[id]=1;
                                       }
                                                          }
                                   if(run_loop_animation[id]==1){
                                     run_loop_animation[id]=0;
                                    move_marker(id);
                                   }
                                 }
                                }
    
                                if(vehicledata.longstop_status=="1"){
                                  $("#ls_"+id).show();
                                }else{
                                  $("#ls_"+id).hide();
                                }
    
                                if(vehicledata.workshop_status=="1"){
                                  $("#ws_"+id).show();
                                }else{
                                  $("#ws_"+id).hide();
                                }
                               
                               j++;
    
    
    
    
                            if(!(vehicledata.department_id in vehicle_groupwise_status)){
                                vehicle_groupwise_status[vehicledata.department_id]=new Array();
                            }
                            if(!(id in vehicle_groupwise_status[vehicledata.department_id])){
                                 vehicle_groupwise_status[vehicledata.department_id][id]=new Array(); 
                            } 
    
    
                     
                            if(vehicle_new.indexOf(id)>-1){
     
                               vehicle_groupwise_status[vehicledata.department_id][id]['ignition']=vehicledata.ign_status;
                               vehicle_groupwise_status[vehicledata.department_id][id]['workshop']=vehicledata.workshop_status;
                               vehicle_groupwise_status[vehicledata.department_id][id]['longstop_status']=vehicledata.longstop_status;     
                  
                               if(vehicledata.ign_status=="ON"){
                                   $("#vehicle_container_"+id).attr("data-ignition","1");
                               }else{
                                   $("#vehicle_container_"+id).attr("data-ignition","0");
                               }
    
                               $("#vehicle_container_"+id).attr("data-workshop",vehicledata.workshop_status);
                               $("#vehicle_container_"+id).attr("data-longstop",vehicledata.longstop_status);
                                
                               
                            }else{
    
                              console.log("current vehicle id is "+id);
    
                               // delete  vehicle_groupwise_status[vehicledata.department_id];
                            }
     
                            }else{
                              if(statusfieldname!="")
                                 $("#vehicle_container_"+vehicledata.id).addClass("collapse");
                            }
                           }
                          }
     
                       });
                       
                       
                      
                     }
                     
                     //console.log(vehicle_count+"-----"+key);
                     vehicle_count++;
                   });
                       
                 }else{
                   
                   if(status=="" && vehicle.length >0 ){
                     swal({
                             title: "Warning!",
                                          text:"Sorry! No data available" ,
                                          icon: "error",
                                          button: "ok",
                                    })
                     if(recall_id==""){
                       $('.loader').hide();
                     }
                    
                     
                     
                   }
                    
                 }
     
    
    
                             
                 
                 $.each(vehicle_groupwise_status,function(groupid,groupvalue){
                  
                   if(typeof(groupvalue)!="undefined"){
                      var vehicle_on=0;
                      var vehicle_off=0;
                      var vehicle_workshop=0;
                      var vehicle_long_stop=0;
    
    
                      $.each(groupvalue,function(vehiclesstatusid,vehiclesstatusvalue){
                          
                         
                          
                         if(typeof(vehiclesstatusvalue)!="undefined"){
    
    
                           
                          if(vehiclesstatusvalue['ignition']=="ON"){
                            vehicle_on=vehicle_on+1;
                          }else{
                            vehicle_off=vehicle_off+1;
                          }
                          
                          if(vehiclesstatusvalue['workshop']=='1'){
                            vehicle_workshop=vehicle_workshop+1;
                          }
    
    
                          if(vehiclesstatusvalue['longstop_status']=='1'){
                            vehicle_long_stop=vehicle_long_stop+1;
                          }
                          
                           
    
                           
                         }
                      });
                      var vehicle_on_output = ("0" + vehicle_on).slice(-2);
                      var vehicle_off_output = ("0" + vehicle_off).slice(-2);
                      var vehicle_workshop_output = ("0" + vehicle_workshop).slice(-2);
                      var vehicle_long_output = ("0" + vehicle_long_stop).slice(-2);
    
                      background_color1="";
                      background_color2="";
                      background_color3="";
                      background_color4="";
    
                      if (current_selected_status[groupid]=="1"){ 
                         background_color1="background:#005DB0;";
                      }
                      if (current_selected_status[groupid]=="2"){ 
                         background_color2="background:#005DB0;";
                      }
                      if (current_selected_status[groupid]=="3"){ 
                         background_color3="background:#005DB0;";
                      }
                      if (current_selected_status[groupid]=="4"){ 
                         background_color4="background:#005DB0;";
                      }
    
                        
                      
                       $("#vehiclegroup_status_"+groupid).html("<span class='status-font-big'><div class='ignitiononstatus statusbutton' style='float:left;"+ background_color1 +"' data-id='"+groupid+"'><i class='fa fa-circle round-shadow green-color'  data-toggle='tooltip' data-placement='bottom' title='Ignition On'></i> <b>"+vehicle_on_output+"</b>&nbsp;&nbsp;&nbsp;</div><div class='ignitionoffstatus statusbutton'  data-id='"+groupid+"'  style='float:left;"+ background_color2 +"''><i class='fa fa-circle round-shadow' style='color:#ff0000' title='Ignition Off'></i> <b>"+vehicle_off_output+"</b>&nbsp;&nbsp;&nbsp;</div><div  data-id='"+groupid+"' style='float:left;"+ background_color3 +"'' class='workshopstatus statusbutton'><i class='fa fa-circle round-shadow' style='color:#357094' title='Under Workshop'></i> <b>"+vehicle_workshop_output+"</b>&nbsp;&nbsp;&nbsp;</div><div style='float:left;"+ background_color4 +"''  data-id='"+groupid+"' class='lsstatus statusbutton'><i class='fa fa-circle round-shadow' style='color:#000' title='Long Stop'></i> <b>"+vehicle_long_output+"</b></div></span>");
                     }
                   });
                 
                 
                  
                  
                  
                 /*if(status=="2"){
                   var time_ext=500;
                 }else{
                   var time_ext=1000;
                 }*/
                 
                 if(status!="1"){
                   
                  var total_length=marker1.length;
                  
                  if(total_length<10){
                    time_ext=400;
                  }else if(total_length<30){
                    time_ext=600;
                  }else if(total_length<50){
                    time_ext=800;
                  }else if(total_length<100){
                    time_ext=1000;
                  }else if(total_length<150){
                    time_ext=1200;
                  }
                  
                  else{
                    var time_ext=2000;
                  }
                  
                  
                  var count_marker=1;
                  
                  /* if(status=="3"){
                     console.log("-------------------------------------------");
                     console.log(marker1);
                     console.log(marker1.length);
                     console.log("time1 out is "+time_ext);
                      console.log("-------------------------------------------");
                   }*/
                  
                  if(total_length>0){
                    setTimeout(function(){ 
                       $.each(marker1,function(key,id){
                         if(id in marker){
                            marker_img[id] =$('img[src="'+truck[id]+'"]');
                          
                           
                          rotateMarker(id,new_angledeg[id],"1",function(){
                             marker[id].setOpacity(1);
                             focusflag[id]="0";
                             zommflg_animation[id]="1";
                             if(count_marker==total_length){
                              $('.loader').hide();
                             }
                            count_marker++;
                          });
                         }else{
                           console.log("no marker created----" +id );
                         }
                        
                       });
                       if(vehicle_map_callback!=""){
                          vehicle_map_callback();
                       }
                      
                    },time_ext);
                  }else{
                    $('.loader').hide();
                    if(vehicle_map_callback!=""){
                      vehicle_map_callback();
                    }
                  }
                  
                  
                 }
                 
                // console.log("current status is "+status);
                // console.log("ajax count pending "+ajax_count);
    
                //console.log("entered into gps data");
                 
                 if(status!=""){
                     if((ajax_count==0) || (status=="3")){
                     settimeout= setTimeout(function(){
                         //console.log("current status is "+status)
                         //if(status!="3"){
                         vehicle_map_listing(1);
                        // }
                      },2000);
                      }
                    
                 }else{ 
                 
                      previous_bound_marker=out_of_boud_marker();
                       //console.log("request count is "+ajax_count);
                     if(ajax_count==0  || (status=="3")){
                         //console.log("request gone");
                      settimeout= setTimeout(function(){
                          vehicle_map_listing(1);
                          //console.log("start execution");
                       },5000);
                     }
                  }
                
               },error: function (xhr, ajaxOptions, thrownError) {
                console.log("current status is"+status);
                  vehicle_map_listing(status);
                 console.log(xhr.status);
                 console.log(xhr.readyState);
                 console.log(thrownError);
                 
               }
                   });
           }
           previous_status=status;
           
           }
           
         function rotateMarker(id, degree,status="",rotatecallback=""){
         
             if(!(id in vehicle_rotate_deg)){
             vehicle_rotate_deg[id]="";
             reduced_degree[id]=new Array();
           }
           
            if((degree!=vehicle_rotate_deg[id] && parseFloat(degree)!=0) || status!="" || (trackvehicle==id)){
              
               vehicle_rotate_deg[id]=parseFloat(degree);
             
             if(!(id in current_angle)){
              current_angle[id]=parseFloat(vehicle_rotate_deg[id]); 
              reduced_degree[id]="";
              unsigned_difference[id]=0;
             }else{
              
               difference[id]=parseFloat(vehicle_rotate_deg[id]-previousangle[id]);
               unsigned_difference[id]=parseFloat(Math.abs(difference[id]));
                 
               if(unsigned_difference[id]>230){
                 
                 if(difference[id]>0){
                  // console.log("enter1");
                    reduced_degree[id]=parseFloat(360-vehicle_rotate_deg[id]);
                    if(current_angle[id]<0 || current_angle[id] >230 ){
                      
                      current_angle[id]=Math.round(parseFloat(current_angle[id]-(reduced_degree[id]+previousangle[id])));
                      
                    }else{
                      current_angle[id]=Math.round(parseFloat(0-reduced_degree[id]));
                    }
                 }else{
           
                   
                        reduced_degree[id]=parseFloat(360-previousangle[id]);
                      current_angle[id]=Math.round(parseFloat(current_angle[id]+(reduced_degree[id]+vehicle_rotate_deg[id])))
                   }
                 
               }else{
                  if(difference[id]>0){
                    current_angle[id]=Math.round(parseFloat(current_angle[id])+unsigned_difference[id]);
                  }else{
                    current_angle[id]=Math.round(parseFloat(current_angle[id])-unsigned_difference[id]);
                  }
                 
               }
             }
             if(unsigned_difference[id]<"90"){
              var time="1s";
             } else{
              var time="2s"; 
             }
            if(Math.abs(current_angle[id]-previous_rotate_angle[id])<10 &&  rotate_status[id]=="1"){
              current_angle[id]=previous_rotate_angle[id];
            }
            
              if(typeof(marker_img[id])!="undefined"){
              
                 if(status=="" && focusflag[id]=="0"){
                    marker_img[id].css({
                    'transform' : 'rotate('+ current_angle[id] +'deg)',
                     'transition': 'transform '+time+' linear'
                   
                   });
                  }else{
                    
                       marker_img[id].css({
                      '-webkit-transform' : 'rotate('+ current_angle[id] +'deg)'});
                   }
            }else{
             
               console.log("wrong data is coming in ----"+id);
            }
             
             rotate_status[id]="1";
              previousangle[id]=vehicle_rotate_deg[id];
            previous_rotate_angle[id]=current_angle[id];
             }else{
                
             }
            if(rotatecallback!=""){
                 rotatecallback();
            }  
            }
         
         
         
         
         
         
         //check infowindow is opened or not
         function isInfoWindowOpen(id){
                var infomap = infowindow[id].getMap();
                return (infomap !== null && typeof infomap !== "undefined");
           }
    
         
         function draw_Polyline(cordinate,color){
               var lineSymbol = {
                    //path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
                 };
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
                  wataniyaTriangle.setMap(map);
            polylinenarray.push(wataniyaTriangle);
              }
          
         
          
          $(document).on("click", '.geoffence_focus',function (event) {
            
            id=this.id.split("_");
            var cur_id=id[1];
            console.log(selected_goeffence[cur_id]);
            if((cur_id in selected_goeffence)){
              
                  var all_borders=selected_goeffence[cur_id].split("|");
                var cordinates=all_borders[0].split(",");
                myLatlng = new google.maps.LatLng(cordinates[0],cordinates[1]);
                  map.setCenter(myLatlng); 
                map.setZoom(14);
              
               recallflag="0";
                 hide_markers();
               clearTimeout(scrolltimeout)
               scrolltimeout=setTimeout(function() {
                  recallmarker(function(){
                 recallflag="1";
                 });  
               },200);
              
            }else{
                  swal({
                   title: "Warning!",
                                 text:"Please select the Geoffence" ,
                                 icon: "error",
                                 button: "ok",
                            })
            }
            
          });
          
          
         
           
           
           function bound_markers(){
             var bound_marker=new Array();
                  $.each(vehicle,function(id, value) {
                 if(typeof(value)!="undefined"){
                 if(id in movelatlng){
                          if((map.getBounds().contains(movelatlng[id]))){
                      bound_marker.push(id);
                        } 
                 }else{
                    console.log("id not in position");
                 }
                 }
             });
               return bound_marker;
           }
         
           
          
           function reseting_position(){
             
             unbound_marker=out_of_boud_marker();
             bound_marker=bound_markers();
             
             var exist_marker_values= $(bound_marker).not(previous_bound_inside_marker).get();
             
               if(exist_marker_values.length>0){
               
                var unbound_vehicle = exist_marker_values.filter(function(v){return v!==''}).toString();
              $("#unbound_markers").val(unbound_vehicle);
               $.each(exist_marker_values,function(id,value){
                 if(trackvehicle!=value){
                      DeleteMarker_blur(value);
                      zommflg_animation[id]=0;
                 } 
               }) 
               
                vehicle_map_listing(3,function(){
                   $(".fleetfocus").prop("disabled",false);
                     $.each(movelatlng,function(id,value){
                           zommflg_animation[id]=1;
                         });
                   
                   $.each(marker,function(id, value) {
                    if(typeof(value)!="undefined"){
                    marker[id].setOpacity(1);
                    }
                    });
                });
                
             }else{
               $.each(movelatlng,function(id,value){
                      zommflg_animation[id]=1;
                   });
              $(".fleetfocus").prop("disabled",false);
             }
             
             $.each(marker,function(id, value) {
              if(typeof(value)!="undefined"){
               if((jQuery.inArray(id, previous_bound_inside_marker)=== -1)){ 
                 marker[id].setOpacity(1);
               } 
              }
            });
             
              previous_bound_inside_marker=bound_marker;
             previous_bound_marker =unbound_marker;
          }
       
         
         
         
         function out_of_boud_marker(){
           
           var unbound_marker=new Array();
            $.each(vehicle,function(id, value) {
               if(typeof(value)!="undefined"){
                 if(id in movelatlng){
                 if((map.getBounds().contains(movelatlng[id]))){
                   
                 } else{
                   unbound_marker.push(id);
                 }
                 } 
               }
           });
           return unbound_marker;
         }
         
         
         
        
         
          
       $('.zoom-reset').on('click',function(){
            map.setCenter(new google.maps.LatLng("25.2728","51.5518466"));
            map.setZoom(16);
          hide_markers()
          $('.zoom-reset').attr("disabled",true);
          recallmarker(function(){
             $('.zoom-reset').attr("disabled",false);
            
          });
          
       });
        
        
         function recallmarker(callback){
            
              bound_marker=bound_markers();
            
            var exist_marker_values= $(bound_marker).not(previous_bound_inside_marker).get();
            
            console.log("exist marker values are---"+exist_marker_values.length);
            if(exist_marker_values.length>0){
              
              console.log("call back gone:");
              
              var  bound_vehicle = exist_marker_values.filter(function(v){return v!==''}).toString();
              $("#unbound_markers").val(bound_vehicle);
              $.each(exist_marker_values,function(id,value){
               if(trackvehicle!=value){
                  DeleteMarker_blur(value);
                  zommflg_animation[id]=0;
               } 
             })
             vehicle_map_listing(3,function(){
               callback();
                $(".fleetfocus").prop("disabled",false);
              $.each(movelatlng,function(id,value){
                    zommflg_animation[id]=1;
                  });
             });
               // console.log("call back gone");
            }else{
              
              console.log("no call back is going on");
             $.each(movelatlng,function(id,value){
                  zommflg_animation[id]=1;
               });
             $(".fleetfocus").prop("disabled",false);
               callback();
            }
            
            previous_bound_inside_marker=bound_marker;
            previous_bound_marker =out_of_boud_marker();
            
          }
          
          
        google.maps.event.addDomListener(map, 'mouseup', function() {
          
        //console.log("---------------------------------");
           
            if((!($(".fleetfocus").prop("disabled"))) && traceallmarkers!="1" && previous_zoom==map.getZoom()){         
                  recallflag="0";
                map.set('draggable', false);
              //hide_markers();
               clearTimeout(scrolltimeout);
               console.log("recalling is going on");
               scrolltimeout=setTimeout(function() {
                 console.log("recalling is going on second");
                 recallmarker(function(){
                  recallflag="1";
                  map.set('draggable', true);
                   $.each(vehicle,function(id, value) {
                    if(typeof(value)!="undefined"){
                       if(id in marker){
                        marker[id].setOpacity(1);
                       }
                    }
                  });
                  dragging_hide();
                  
                 });  
                   //map.set('draggable', true);
               },200);
            }
             previous_zoom=map.getZoom();
           });
        
         
         google.maps.event.addDomListener(map, 'mousedown', function() {
             dragging_hide();
           //console.log("execution not found");
           });
        
       
       function dragging_hide(){
             var makernotin_bound=out_of_boud_marker();
          // console.log(makernotin_bound);
             $.each(makernotin_bound,function(id, value) {
            if(typeof(value)!="undefined"){
              if(value in marker){
               marker[value].setOpacity(0);
              }
            }
           });
       }
        
        
        function hide_markers1(){
            $.each(vehicle,function(id, value) {
             if(typeof(value)!="undefined"){
               if((jQuery.inArray(id, previous_bound_inside_marker)=== -1)){ 
                if(id in marker){
                 marker[id].setOpacity(0);
                }
              }  
             }
           });
          }
        function hide_markers(){
            $.each(vehicle,function(id, value) {
             if(typeof(value)!="undefined"){
               if((jQuery.inArray(id, previous_bound_inside_marker)=== -1)){ 
                if(id in marker){
                 marker[id].setOpacity(0);
                }
              }  
             }
           });
          }
         
     
          
        /* google.maps.event.addListener(map, 'bounds_changed', function() {
           
             if((!($(".fleetfocus").prop("disabled"))) && traceallmarkers!="1" && previous_zoom==map.getZoom()){
            
               $(document).on("mouseup", '',function (event) {   
               
                console.log("bound changed");
                map.set('draggable', false);
                hide_markers();
                clearTimeout(scrolltimeout)
                scrolltimeout=setTimeout(function() {
                   recallmarker(function(){
                   map.set('draggable', true);
                   });  
                },50);
               
                  
               });
             }
                previous_zoom=map.getZoom();
           
             });  */
         
         
         
         
           
         
        $(document).on("click", '.gm-control-active',function (event) { 
                  var title = this.title;
             if(title=="Zoom out"){
              recallflag="0";
             $(".gm-control-active").attr("disabled",true);
              hide_markers();
            clearTimeout(scrolltimeout);
            scrolltimeout=setTimeout(function() {
                 recallmarker(function(){
                  recallflag="1";
                  $(".gm-control-active").attr("disabled",false);
                 });  
            },100); 
            
             }else{
             previous_bound_inside_marker=new Array();
             previous_bound_inside_marker=bound_markers(); 
           }
            }); 
        
           $('#map').bind('mousewheel', function(e){
                
               if(e.originalEvent.wheelDelta /120 > 0) {
                recallflag="0";
                map.set('scrollwheel', false);
               scrolltimeout=setTimeout(function() {
                  recallflag="1";
                  previous_bound_inside_marker=new Array();
                          previous_bound_inside_marker=bound_markers();
                 map.set('scrollwheel', true);
               },100);
               
                     }
                   else{
                 recallflag="0";
               map.set('scrollwheel', false);
               hide_markers();
               clearTimeout(scrolltimeout)
               scrolltimeout=setTimeout(function() {
                  recallmarker(function(){
                 recallflag="1";
                map.set('scrollwheel', true);
                 });  
               },200);
               
                     }
          });
          
         $(document).on("click", '.fleetfocus',function (event) {
           
               $(".fleetfocus").prop("disabled",true);
               id=this.id.split("_");
             var cur_id=parseInt(id[1]);
             focusflag[cur_id]="1";
             
              
             if(!(cur_id in movelatlng)){
              
               swal({
                   text: "Please select a Vehicle!!",
                   icon: "error",
                   button: "ok",
               });
               
               $(".fleetfocus").prop("disabled",false);  
               
                  
             }else{
              
                  unbound_marker=out_of_boud_marker();
                if(trackvehicle==cur_id){
                traceflag="1";
              }else{
                traceflag="0";
              }
                recallflag="0";
              
              if(cur_id!=trackvehicle){
                
                if(typeof(animatepoint[cur_id])!="undefined"){
                if(animatepoint[cur_id].length>0){
                     newpoint[cur_id]=animatepoint[cur_id].pop();
                   var cur_posi = new google.maps.LatLng(newpoint[cur_id].lat,newpoint[cur_id].logn);
                   
                }else{
                  if(typeof(newpoint[cur_id])!="undefined"){
                        var cur_posi = new google.maps.LatLng(newpoint[cur_id].lat,newpoint[cur_id].logn);
                  }else{
                    var cur_posi =movelatlng[cur_id];
                  }
                }
                
                }else{
                 
                  if(typeof(newpoint[cur_id])!="undefined"){
                        var cur_posi = new google.maps.LatLng(newpoint[cur_id].lat,newpoint[cur_id].logn);
                  }else{
                    var cur_posi =movelatlng[cur_id];
                  }
                }
              }else{
                cur_posi=movelatlng[cur_id];
              }
                    
              if((map.getBounds().contains(movelatlng[cur_id]))){
                cur_posi=movelatlng[cur_id];
              } 
              
              
              if(previousinfowindow1!="")
                 previousinfowindow1.close();
              if(previousinfowindow!="")  
                 previousinfowindow.close();
                 
                $.each(marker,function(id, value) {
                   if(typeof(value)!="undefined"){
                   if(!(map.getBounds().contains(movelatlng[id]))){
                     if(trackvehicle!=id){
                         marker[id].setOpacity(0);
                     }
                   }
                   
                 }
              });
                
                map.setCenter(cur_posi); 
              map.setZoom(20); 
              
              
             setTimeout(function(){ 
             
                $.each(marker,function(id, value) {
                  if(typeof(value)!="undefined"){
                   marker[id].setOpacity(1);
                }
              });
             
              
                unbound_marker1=out_of_boud_marker();
                var exist_marker_values=$(unbound_marker).not(unbound_marker1).get();
              
              if(trackvehicle!=""){
                if((trackvehicle!=cur_id) ||  traceallmarkers=="1"){
                        if((jQuery.inArray(cur_id, exist_marker_values) == -1)){
                        exist_marker_values.push(cur_id);
                      } 
                }
              }else{
                 if((jQuery.inArray(cur_id, exist_marker_values) == -1)){
                   if(!(map.getBounds().contains(movelatlng[cur_id]))){
                     exist_marker_values.push(cur_id); 
                   }
                 }
              }
              
              if((trackvehicle==cur_id) && traceallmarkers=="0"){
                exist_marker_values = jQuery.grep(exist_marker_values, function(value) {
                                     return value != trackvehicle;
                            });
              }
              
              var bound_marker=new Array();
              $.each(movelatlng,function(id, value) {
                  if(typeof(value)!="undefined"){
                      if((map.getBounds().contains(movelatlng[id]))){
                  bound_marker.push(id);
                    } 
                  }
                  });
              
                  if(exist_marker_values.length>0){
                  
                  if(bound_marker.length>0){
                    var unbound_vehicle = bound_marker.filter(function(v){return v!==''}).toString();
                  }else{
                    var unbound_vehicle = exist_marker_values.filter(function(v){return v!==''}).toString();
                  }
                     $("#unbound_markers").val(unbound_vehicle);
                   $.each(exist_marker_values,function(id,value){
                   
                   if((trackvehicle!=value) || traceallmarkers=="1"){
                        DeleteMarker_blur(value);
                    if(trackvehicle!=value){
                        zommflg_animation[value]=0;
                    }else{
                      zommflg_animation[value]=1;
                    }
                      
                   } else{
                      zommflg_animation[value]=1;
                   }
                   
                 }) 
                
                   vehicle_map_listing(3,function(){
                   recallflag="1";
                   $.each(movelatlng,function(id,value){
                               zommflg_animation[id]=1;
                           });
                   
                       infowindows[cur_id].open(map, marker[cur_id]); 
                       previousinfowindow1=infowindows[cur_id];
                         $(".fleetfocus").prop("disabled",false);
                   focusflag[cur_id]="0";
                   previous_bound_inside_marker=new Array();
                   $.each(movelatlng,function(id, value) {
                    if(typeof(value)!="undefined"){
                      if(id in marker){
                          if((map.getBounds().contains(movelatlng[id]))){
                          previous_bound_inside_marker.push(id); 
                          }
                      }
                    }
                   });
                   // console.log("get into First case");
                   console.log(previous_bound_inside_marker);
                 });
                 
                }else{
                   recallflag="1";
                   infowindows[cur_id].open(map, marker[cur_id]); 
                     previousinfowindow1=infowindows[cur_id];
                   previous_bound_inside_marker=new Array();
                   $.each(movelatlng,function(id, value) {
                    if(typeof(value)!="undefined"){
                      if(id in marker){
                          if((map.getBounds().contains(movelatlng[id]))){
                          previous_bound_inside_marker.push(id); 
                          }
                      }
                    }
                  });
                   console.log("get into second case");
                    console.log(previous_bound_inside_marker);
                  setTimeout(function(){
                     $.each(movelatlng,function(id,value){
                                zommflg_animation[id]=1;
                           });
                         $(".fleetfocus").prop("disabled",false);
                   focusflag[cur_id]="0";
                   
                  },300);
                }
                 previous_bound_marker =unbound_marker1;
                 
                 
             },100);
                  
              }
          });
          
          
          $(document).on("click", '.track_vehicle',function (event) {
            
             
              var track_pos=new Array();
            
              id=this.id.split("_");
            var cur_id=parseInt(id[1]);
             
            if(!(cur_id in movelatlng)){
              swal({
                                     text: "Please select a Vehicle!!",
                                     icon: "error",
                                     button: "ok",
                              });
            }else{
              
                if(trackvehicle==cur_id){
                  trackvehicle="";
                  traceflag="0";
                  traceallmarkers="0";
                  $("#trace_"+cur_id).removeClass("btn-active");
                  clear_fleet_polyline();
                }else{ 
                
                  recallflag="0";
                  $(".track_vehicle").prop("disabled",true);
                  traceflag="1";
                  traceallmarkers="1";
                  trackvehicle=cur_id;
                  zommflg_animation[cur_id]="1";
                  clear_fleet_polyline();
                  
                  if($("#trace_"+cur_id).hasClass('btn-active')){
                    $("#trace_"+cur_id).removeClass('btn-active');
                  }else{
                    trackvehicle=cur_id;
                    $("#trace_"+cur_id).addClass('btn-active');           
                  }
                  
                  if(previousinfowindow1!="")
                   previousinfowindow1.close();
                  if(previousinfowindow!="")  
                   previousinfowindow.close();
                   
                  unbound_marker=out_of_boud_marker();
                  
                   if(typeof(animatepoint[cur_id])!="undefined"){
                    if(animatepoint[cur_id].length>0){
                     newpoint[cur_id]=animatepoint[cur_id].pop();
                     var cur_pos = new google.maps.LatLng(newpoint[cur_id].lat,newpoint[cur_id].logn);
                     
                    }else{
                      if(typeof(newpoint[cur_id])!="undefined"){
                      var cur_pos = new google.maps.LatLng(newpoint[cur_id].lat,newpoint[cur_id].logn);
                      }else{
                      var cur_pos =movelatlng[cur_id];
                      }
                    }
                  }else{
                    //console.log(newpoint[cur_id]);
                    if(typeof(newpoint[cur_id])!="undefined"){
                      var cur_pos = new google.maps.LatLng(newpoint[cur_id].lat,newpoint[cur_id].logn);
                    }else{
                      var cur_pos =movelatlng[cur_id];
                    }
                  }
                  
                  $.each(marker,function(id, value) {
                     if(typeof(value)!="undefined"){
                       if(!(map.getBounds().contains(movelatlng[id]))){
                        marker[id].setOpacity(0);
                       }
                       
                     }
                  });
                  
                   // console.log(newpoint[cur_id].lat+","+newpoint[cur_id].logn);
                  map.setCenter(cur_pos);
                  map.setZoom(20); 
                  
                    
                  
                 setTimeout(function(){ 
                 
                      $.each(marker,function(id, value) {
                     if(typeof(value)!="undefined"){
                       marker[id].setOpacity(1);
                     }
                    }); 
                  
                  
                  unbound_marker1=out_of_boud_marker();
                  var exist_marker_values=$(unbound_marker).not(unbound_marker1).get();
                   
                  if((jQuery.inArray(cur_id, exist_marker_values) == -1)){
                    
                    if(!(map.getBounds().contains(movelatlng[cur_id]))){
                        exist_marker_values.push(cur_id); 
                    } 
                  }
                  var bound_marker=new Array();
                  $.each(movelatlng,function(id, value) {
                    if(typeof(value)!="undefined"){
                    if((map.getBounds().contains(movelatlng[id]))){
                      bound_marker.push(id);
                    } 
                    }
                  });
                  
                  if(exist_marker_values.length>0){
                    
                      if(bound_marker.length>0){
                        var unbound_vehicle = bound_marker.filter(function(v){return v!==''}).toString();
                    }else{
                      var unbound_vehicle = exist_marker_values.filter(function(v){return v!==''}).toString();
                    }
                     
                     $("#unbound_markers").val(unbound_vehicle);
                     
                     $.each(exist_marker_values,function(id,value){
                        DeleteMarker_blur(value,"1");
                          zommflg_animation[value]=0;
                         
                        
                     }); 
                     
                     vehicle_map_listing(3,function(){
                       recallflag="1";
                      $.each(movelatlng,function(id,value){
                         zommflg_animation[id]=1;
                        });
                        $(".track_vehicle").prop("disabled",false);
                        infowindows[cur_id].open(map, marker[cur_id]); 
                        previousinfowindow1=infowindows[cur_id];
                        $(".fleetfocus").prop("disabled",false);
                    });
                      
                     
                  }else{
                         recallflag="1";
                       $.each(movelatlng,function(id,value){
                         zommflg_animation[id]=1;
                       });
                      $(".track_vehicle").prop("disabled",false);
                       infowindows[cur_id].open(map, marker[cur_id]); 
                       previousinfowindow1=infowindows[cur_id];
                       $(".fleetfocus").prop("disabled",false);
                     
                  }
                   
                  
                  $(".track_vehicle").each(function(index, element) {
                    var eachid=this.id.split("_");
                    if(eachid[1]!=trackvehicle){
                      $("#trace_"+eachid[1]).removeClass('btn-active');
                    }
                  
                  });
                   previous_bound_inside_marker=new Array();
             
                   $.each(marker,function(id, value) {
                    if(typeof(value)!="undefined"){
                      if((map.getBounds().contains(movelatlng[id]))){
                        previous_bound_inside_marker.push(id); 
                      }
                    }
                   });
                 },100);
                }
           }
           
          });
         
         
         
         
         $(document).on("click", '.geoffence_search',function (event) {
           $("#geoffence_search").show();
           });
         
          $(document).on("click", '.geoffencesearch_remove',function (event) {
           $("#geoffence_search").hide();
           $('#geoffenceInput').val('');
           
           var value = $('#geoffenceInput').val().toLowerCase();
           $(".geoffence_search_data li div").filter(function() {
                   
                     $(this).toggle($('#myInput').text().toLowerCase().indexOf(value) > -1)
                 });
           });
         
         
         $(document).on("click", '.fleetsearch',function (event) {
           $("#vehicle_search").show();
           });
         
           $(document).on("click", '.fleet_search_remove',function (event) {
    
              $("#vehicle_search").hide();
              $('#myInput').val('');
           
              var value = $('#myInput').val().toLowerCase();
              $(".fleets_search_data li div").filter(function() {
                 $(this).toggle($('#myInput').text().toLowerCase().indexOf(value) > -1)
             });
    
           });
         
         
         $(document).on("click", '#close_fleet', function (event) {
           $("#FleetDialog").hide("fast");
         });
         
         
         
          $(document).on("click", '#fleet_reset', function (event) {
              
              $(".loader").show();
              clear_fleet_polyline();
              $('.track_vehicle').removeClass('btn-active');
              trackvehicle="";  
              traceflag="0";
              removestatushidden();
              var current_vehicle=""
              $(".vehiclelist").each(function() {  
                   //vehicle_id=this.id;             
                   //vehicle_data(vehicle_id,$vehicledatatype);       
                  if($(this).prop("checked")){
                    currentvehice_id=this.id.split("_");
                    current_vehicle+=currentvehice_id[1]+",";
                  }   
             });
              current_vehicle=current_vehicle.slice(0,-1);
              
              if(current_vehicle!=""){
                  $("#current_selected_values").val(current_vehicle);
                  vehicle_map_listing();
              }
             
         });
         
         
         
         
          $(document).on("click", '#fleet_refresh', function (event) {
    
           $("#fulllist").prop('checked', false);
           var spinner = $(".loader").insertAfter(this);
           spinner.fadeIn();  
           
          $(".grouplist").each(function() {
                
               if($(this).prop('checked')==true){
                  $(this).prop('checked',false);
               }
    
               id=this.id;
    
               vehiclestatusgroup_array=id.split("_");
               cur_groupid=vehiclestatusgroup_array[1]; 
               $("#vehiclegroup_status_"+cur_groupid).html('');
               delete vehicle_groupwise_status[cur_groupid];
     
               dataid=$(this).attr("data-id");
               removestatushidden(dataid);
               $(".vehiclechildgroup_"+cur_groupid).each(function() {
                     $(this).prop('checked',false);
                     vehicle_id=this.id;
                     vehicle_data(vehicle_id);
                     if(!(vehicle_id in marker)){
                        $('.track_vehicle').removeClass('btn-active');
                     }
               });
                      
               $("#current_selected_values").val("");
            });
    
    
            $(".stationlist").each(function() {
                if($(this).prop('checked')==true){
                  $(this).prop('checked',false);
               }
            });
    
    
    
          clear_fleet_polyline();
             spinner.fadeOut();
         });
         
         $(document).on("click", '#geoffence_refresh', function (event) {
           var spinner = $(".loaders").insertAfter(this);
           spinner.fadeIn();  
           
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
               spinner.fadeOut();
         });
         
         function clear_fleet_polyline() {
           drawingManager.setMap(null); 
                      $.each(polylinenarray, function (index, val) {
                         polylinenarray[index].setMap(null);
                    });
         }
         
         $("#myInput").on("keyup", function() {
            
                 var value = $(this).val().toLowerCase();
                  if(value!=""){
                    $(".station_datas").show();
                    $(".fleets_search_data").show();
                  }else{
                    $(".station_datas").hide();
                    $(".fleets_search_data").hide();
                  }
                  $(".fleets_search_data li div").filter(function() {
                     if($(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)){
                       $(this).find(".station_datas").show()
                     }
                    
                 });
           
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
         
         $(document).on("click", '.fleet_show', function (event) {
           if ($("#FleetDialog").is( ":hidden" ) ) {
             $("#FleetDialog").show("fast");
           }else{
             $("#FleetDialog").hide("fast");
           }
         });
         $(document).on("click", '#close_geoffence', function (event) {
           
               $("#div_table").hide("fast");
               $("#GeofenceToolbox").hide();
           
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
         
          
         
         $(document).on("click", '.polygon_draw', function (event) {
              drawingManager.setMap(map);
              drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
              google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                all_overlays.push(event);
                var coordinatesArray = event.overlay.getPath().getArray();
                if(coordinatesArray.length>1){
                       $("#boundaries").val(coordinatesArray);
                       $('#myModal').modal('show');
                       drawingManager.setDrawingMode(null);
                       $("#insert").removeAttr("disabled");
                }
              });
    
          });
          
          function isEmail(email,dataid) {
            
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var message="";
            if(regex.test(email)){
               $(".email").each(function() {
                 if($(this).attr("data-id")!=dataid){
                   var exist_email=$(this).val();
                   if(email==exist_email){
                    // $("#insert").prop("disabled",true);
                     message="Already entered the email address";
                   }
                 }
               });
            }else{
             // $("#insert").prop("disabled",true);
             message="Please enter a valid email address";
            } 
             
             return message;
              }
          
          
          $(document).on("click", '.polyline_draw', function (event) {
           drawingManager.setMap(map);
             drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYLINE);
           google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
             all_overlays.push(event);
              var coordinatesArray = event.overlay.getPath().getArray();
              $("#boundaries").val(coordinatesArray);
               $('#myModal').modal('show');
             $("#insert").removeAttr("disabled");
             drawingManager.setDrawingMode(null);
                 });
           
             });
         
         
         
            function clear_geoffence() {
            
                    drawingManager.setMap(null);  
                    $.each(polygonarray, function (index, val) {
                         polygonarray[index].setMap(null);
                    });
            
            $('input:checkbox').removeAttr('checked');
                    for (var i = 0; i < all_overlays.length; i++) {
                        all_overlays[i].overlay.setMap(null);
                    }
            drawingManager= [];
            drawingManager = new google.maps.drawing.DrawingManager({
                                      drawingControl: false,
                    });  
                }
    
                $(document).on("click", '.geoffence_delete', function (event) {
                    clear_geoffence();  
                });
          
          //google.maps.event.addDomListener(map, 'rightclick', clear_geoffence);
    
          google.maps.event.addDomListener(document, 'keyup', function (event) {
            var code = (event.keyCode ? event.keyCode : event.which);
            if (code === 27) {
               clear_geoffence(); 
               drawingManager.setMap(null);            
            }
          });
         
          
          
         
         
           $("input[name='satelite_type']").change(function(){
            if($(this).val()=="Satellite")
                map.setMapTypeId(google.maps.MapTypeId.HYBRID)
             else
                map.setMapTypeId(google.maps.MapTypeId.ROADMAP)
               });
         
          $(document).on("click", '.Satellite', function (event) {
            var myMapType = new MyMapType();
            map.mapTypes.set('terrain', myMapType);
              map.setMapTypeId('terrain');
          });
          
          $(document).on("click", '.Road', function (event) {
              var myMapType = new MyMapType();
              map.mapTypes.set('roadmap', myMapType);
                map.setMapTypeId('roadmap');
          });
     
     //checking the geoffence name exist or not
       $(document).on("change", '#name', function (event) {
         var geoffence_name=$(this).val();
         $.ajax({
           url: "<?=base_url()?>index/geoffencename_check", 
           data:{geoffence_name:geoffence_name},
           method: "POST",
           success: function(result){
             var data = $.parseJSON(result); 
             
             if(data>0){
                $("#name_error1").removeClass("collapse");
                $("#name_error1").addClass("error");
                $("#insert").prop("disabled",true);
             }else{
                $("#name_error1").addClass("collapse");
                 $("#name_error1").removeClass("error");
                $("#insert").prop("disabled",false);
             }
           }
             
         });
       });
     
     
     
      $(document).on("click", '#insert', function (event) {
        
        if($("#commentForm").valid()){
          $("#insert").attr("disabled", "disabled");
          
         swal({
                          title: "Are you sure?",
                          text: "Do you really want to Create the Geoffence with this details?",
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
             }).then(function(willcreate){
           if(willcreate){
         
                   var boundaries=$("#boundaries").val();
                   var name=$("#name").val();
               var group_id=$("#geo_group").val();
               var color=$("#color").val();
               var geofence_code=$("#geofence_code").val();
                     
          
          $.ajax({
               url: "<?=base_url()?>index/geoffence", 
               data:{boundaries:boundaries,geofence_code:geofence_code,name:name,group_id:group_id,color:color,status:1},
               method: "POST",
               success: function(result){
            $("#insert").removeAttr("disabled");
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
                                 text:"Geoffence created successfully" ,
                                 icon: "success",
                                 button: "ok",
                            }).then(function(){
                     $(".close").click();
                   /*$('body').on('hidden', function () {
                                  $(this).removeData('modal');
                               });*/
                   
                   id=data.information;
                    $("#ountergroupcont_"+group_id).append('<div class="node inactive disabled" style="float:left; clear:both; width:100%"><div class="checkbox"><label ><input type="checkbox" class="geoffence  childgeoffencegroup_'+group_id+'" id="geoffenceid_'+id+'" ><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> <span class="title" ><i></i>'+name+'</span> </label></div><span class="template pull-right"><a id="locate_'+id+'" class="btn btn-default template geoffence_focus" title="" data-placement="left" data-toggle="tooltip" data-original-title="Locate"><i class="fa fa-search"></i></a></span></div>');
                });
               }
               } 
              
               });
          
            }else{
            $("#insert").removeAttr("disabled");
            }
          });
          
          
          
          
         }
       });
      
      //clear the polygon while closing model
       $(document).on("click", '.close', function (event) {
                     clear_geoffence();
              $("#name_error1").addClass("collapse");
               $("#name_error1").removeClass("error");
              $("input[type=text]").val("");          
              $("#type").prop("selectedIndex", 0);
              $("#insert").prop("disabled",true);
       });
    
    
    function removestatushidden(id=""){
      if(id!=""){
         $('div[data-groupid="'+id+'"]').removeClass("collapse");
           delete current_selected_status[id];
           $('.statusbutton[data-groupid="'+id+'"]').css("background", "");
      } 
      else{
          $(".vehicle_container").removeClass("collapse");
          current_selected_status=new Array();
          $(".statusbutton").css("background", "");
          
      }
    
    }
    
    function addstatushidden(id){
      $('div[data-groupid="'+id+'"]').addClass("collapse");
           delete current_selected_status[id];
           $('.statusbutton[data-groupid="'+id+'"]').css("background", "");
    }
    
    
    function resetselectedvehicle(groupid){
             var current_vehicle="";
             $(".vehiclechildgroup_"+groupid).each(function() {  
                   vehicle_id=this.id;             
                  if($(this).prop("checked")){
                    currentvehice_id=this.id.split("_");
                    current_vehicle+=currentvehice_id[1]+",";
                  } 
             });
    
    
              if(current_vehicle!=""){
    
               current_vehicle=current_vehicle.slice(0,-1);
               $("#current_selected_values").val(current_vehicle);
                if(settimeout!="")
                 clearTimeout(settimeout);
               vehicle_map_listing();
              }
         
    }
    
     
    $(document).on("click", '.ignitiononstatus', function (event) {
    
       event.stopPropagation();
       id=$(this).attr("data-id");
       $('.statusbutton [data-groupid="'+id+'"]').css("background", "");
       
        $(this).css("background", "#005DB0");
       addstatushidden(id);
       current_selected_status[id]="1";
    
        resetselectedvehicle(id);
       $('div[data-groupid="'+id+'"][data-ignition="1"]').removeClass("collapse");
       
       $('div[data-groupid="'+id+'"][data-ignition="0"]').each(function(){
            statusvehicleid=$(this).find('.vehiclechildgroup_'+id).attr("id").split("_");
            if(statusvehicleid[1] in marker)
              DeleteMarker(statusvehicleid[1]);
     
        })
    
       
       if ( $("#vehiclecontainer"+id ).is( ":hidden" ) ) {
             $(this).children(".node").removeClass("inactive");
             $(this).children(".node").addClass("active");
             $("#vehiclecontainer"+id ).slideDown( "fast");
       }
    });
    
    
    $(document).on("click", '.ignitionoffstatus', function (event) {
        event.stopPropagation()
     
        id=$(this).attr("data-id");
         $('.statusbutton [data-groupid="'+id+'"]').css("background", "");
        $(this).css("background", "#005DB0");
        addstatushidden(id);
        resetselectedvehicle(id);
         current_selected_status[id]="2";
        $('div[data-groupid="'+id+'"][data-ignition="0"]').removeClass("collapse");
    
        $('div[data-groupid="'+id+'"][data-ignition="1"]').each(function(){
            statusvehicleid=$(this).find('.vehiclechildgroup_'+id).attr("id").split("_");
            if(statusvehicleid[1] in marker)
              DeleteMarker(statusvehicleid[1]);
     
        })
        if ( $("#vehiclecontainer"+id ).is( ":hidden" ) ) {
             $(this).children(".node").removeClass("inactive");
             $(this).children(".node").addClass("active");
             $("#vehiclecontainer"+id ).slideDown( "fast");
        }
    });
    
    
    $(document).on("click", '.workshopstatus', function (event) {
    
        event.stopPropagation();
     
        id=$(this).attr("data-id");
         $('.statusbutton [data-groupid="'+id+'"]').css("background", "");
        $(this).css("background", "#005DB0");
        addstatushidden(id);
         current_selected_status[id]="3";
         resetselectedvehicle(id);
        $('div[data-groupid="'+id+'"][data-workshop="1"]').removeClass("collapse");
    
        $('div[data-groupid="'+id+'"][data-workshop="0"]').each(function(){
            statusvehicleid=$(this).find('.vehiclechildgroup_'+id).attr("id").split("_");
            if(statusvehicleid[1] in marker)
              DeleteMarker(statusvehicleid[1]);
     
        })
        if ( $("#vehiclecontainer"+id ).is( ":hidden" ) ) {
             $(this).children(".node").removeClass("inactive");
             $(this).children(".node").addClass("active");
             $("#vehiclecontainer"+id ).slideDown( "fast");
        }
    });
    
    
    $(document).on("click", '.lsstatus', function (event) {
        event.stopPropagation();
          
        
        $(this).css("background", "#005DB0");
         $('.statusbutton [data-groupid="'+id+'"]').css("background", "");
        id=$(this).attr("data-id");
         addstatushidden(id);
         
    
         current_selected_status[id]="4";
         resetselectedvehicle(id);
        $('div[data-groupid="'+id+'"][data-longstop="1"]').removeClass("collapse");
        $('div[data-groupid="'+id+'"][data-longstop="0"]').each(function(){
            statusvehicleid=$(this).find('.vehiclechildgroup_'+id).attr("id").split("_");
            if(statusvehicleid[1] in marker)
              DeleteMarker(statusvehicleid[1]);
     
        })
        if ( $("#vehiclecontainer"+id ).is( ":hidden" ) ) {
             $(this).children(".node").removeClass("inactive");
             $(this).children(".node").addClass("active");
             $("#vehiclecontainer"+id ).slideDown( "fast");
        }
    });
    
    
     
          
       $(document).on("click", '.groups_data', function (event) {
         
           id=$(this).attr("data-id");
           if ($(event.target).is('input')) { //if clicked on input element don't do anything
                       return
           }
         
           if ( $("#stationcontainer"+id ).is( ":hidden" ) ) {
    
             $(this).children(".node").removeClass("inactive");
             $(this).children(".node").addClass("active");
             $("#stationcontainer"+id ).slideDown( "fast");
             if( $(this).find("input").prop('checked')){
                  $(".child"+id).prop('checked',true);
             }
           
           }else{
           
             if ($('.loader').css('display') != 'none') {
                    $('.loader').hide();
            //$(this).children(".track_vehicle").removeClass("btn-active");
             }
             $(this).children(".node").addClass("inactive");
             $(this).children(".node").removeClass(" active");
             $("#stationcontainer"+id ).slideUp( "fast");
            
         }
       })
    
    
     $(document).on("click", '.stations_data', function (event) {
    
    
            id=$(this).attr("data-id");
            stationgroupid=$(this).attr("data-stationgroupid");
             
            
     
            if ($(event.target).is('input')) { //if clicked on input element don't do anything
                       return
            }
     
           if ( $("#vehiclecontainer_"+id+"_"+stationgroupid ).is( ":hidden" ) ) {
    
             $(this).children(".node").removeClass("inactive");
             $(this).children(".node").addClass("stationactive");
             $("#vehiclecontainer_"+id+"_"+stationgroupid ).slideDown( "fast");
             if( $(this).find("input").prop('checked')){
                  $(".child"+id).prop('checked',true);
             }
           
           }else{
    
           
             if ($('.loader').css('display') != 'none') {
                    $('.loader').hide();
            //$(this).children(".track_vehicle").removeClass("btn-active");
             }
             $(this).children(".node").addClass("inactive");
             $(this).children(".node").removeClass("stationactive");
             $("#vehiclecontainer_"+id+"_"+stationgroupid ).slideUp( "fast");
            
         }
    
    
    
     });
    
    
    
    
    
    
    
    
    
     $(document).on("click", '.geoffencecustomer_data', function (event) {
          geoffence_customerid=$(this).attr("data-id").split("_");
          id=geoffence_customerid['1'];
          if ($(event.target).is('input')) { //if clicked on input element don't do anything
                       return
          }
    
    
          if ( $("#geoffencecustomercontainer"+id ).is( ":hidden" ) ) {
           
              $(this).find(".node").removeClass("inactive");
              $(this).find(".node").addClass("cu_active");
              $("#geoffencecustomercontainer"+id ).slideDown( "fast");
    
    
              if( $(this).find("input").prop('checked')){
                 
                  $(".child"+id).prop('checked',true);
              }
           
           }else{
           
               if($('.loader').css('display') != 'none') {
                     $('.loader').hide();
               //$(this).children(".track_vehicle").removeClass("btn-active");
                   }
                 $(this).find(".node").addClass("inactive");
               $(this).find(".node").removeClass("cu_active");
               $("#geoffencecustomercontainer"+id ).slideUp( "fast");
           }
    
     });
    
    
    
    
      
      $(document).on("click", '.geoffencegroups_data', function (event) {
         
           geoffence_groupid=$(this).attr("data-id").split("_");
           id=geoffence_groupid['1'];
         
           if ($(event.target).is('input')) { //if clicked on input element don't do anything
                       return
           }
         
           if ( $("#geoffencecontainer"+id ).is( ":hidden" ) ) {
           
              $(this).children(".node").removeClass("inactive");
              $(this).children(".node").addClass("active");
              $("#geoffencecontainer"+id ).slideDown( "fast");
              if( $(this).find("input").prop('checked')){
                  $(".child"+id).prop('checked',true);
              }
           
           }else{
           
               if($('.loader').css('display') != 'none') {
                     $('.loader').hide();
               //$(this).children(".track_vehicle").removeClass("btn-active");
                   }
                 $(this).children(".node").addClass("inactive");
               $(this).children(".node").removeClass(" active");
               $("#geoffencecontainer"+id ).slideUp( "fast");
           }
         
       })
      
      
      $(document).on("click", '#filter', function (event) {
        
        if($("#filtertd").hasClass("collapse")){
            $("#filtertd").removeClass("collapse");
        }else{
          $("#filtertd").addClass("collapse");
        }
        
      });
      
      
      $(document).on("click", '#fulllist', function (event) {
        
        if($(this).prop('checked')==true){
     
          $(".grouplist").prop('checked',true);
          $(".loader").show();
     
          $(".grouplist").each(function(index, element) {
             id=this.id;
             vehiclestatusgroup_array=id.split("_");
             cur_groupid=vehiclestatusgroup_array[1]; 
             $(".childgroup_"+cur_groupid).prop('checked',true);
    
             $(".childgroup_"+cur_groupid).each(function() {
    
              groupid=$(this).attr("data-stationgroupid");
              station_id=$(this).attr("data-id");
              $(".child_"+groupid+"_"+station_id).prop('checked',true);
    
            });
     
          });
    
            
        }else{
    
          $(".loader").hide();
           $(".grouplist").prop('checked',false);
          $(".grouplist").each(function(index, element) {
               id=this.id;
              dataid=$(this).attr("data-id");
            
               removestatushidden(dataid);
             vehiclestatusgroup_array=id.split("_");
             cur_groupid=vehiclestatusgroup_array[1]; 
             $("#vehiclegroup_status_"+cur_groupid).html('');
             delete vehicle_groupwise_status[cur_groupid];
             
               $(".loader").hide();
               $(".childgroup_"+cur_groupid).prop('checked',false);
               $(".childgroup_"+cur_groupid).each(function() {
    
                  groupid=$(this).attr("data-stationgroupid");
                  station_id=$(this).attr("data-id");
                  $(".child_"+groupid+"_"+station_id).prop('checked',false);
    
                  $(".child_"+groupid+"_"+station_id).each(function() {
         
                    trackvehicle="";
                    traceflag="0";
                    if(!(id in marker)){
                         $('.track_vehicle').removeClass('btn-active');
                      }
                   });
    
               });
     
           });
        }
        
         var current_vehicle="";
           $(".grouplist").each(function(index, element) {
             id=this.id;
             vehiclestatusgroup_array=id.split("_");
             cur_groupid=vehiclestatusgroup_array[1]; 
             $(".childgroup_"+cur_groupid).each(function() {
              groupid=$(this).attr("data-stationgroupid");
              station_id=$(this).attr("data-id");
                $(".child_"+groupid+"_"+station_id).each(function() {
                  vehicle_id=this.id;
                  currentvehice_id=this.id.split("_");
                  current_vehicle+=currentvehice_id[1]+",";
                  vehicle_data(vehicle_id);       
        
               });
            });
     
          });
    
        
          current_vehicle=current_vehicle.slice(0,-1)
         $("#current_selected_values").val(current_vehicle);
         
         var vehicle_new = vehicle.filter(function(v){return v!==''});
         vehicle_new=vehicle_new.toString()
         $("#selected_values").val(vehicle_new);
         
         
         
         if($("#fulllist").prop('checked')==true){
           vehicle_map_listing();
         }else{
            $("#current_selected_values").val("");
         }
     
      });
      
      
    
    
    
     
    
      
      $(document).on("click", '.grouplist', function (event) {
    
           id=this.id;
           vehiclestatusgroup_array=id.split("_");
           cur_groupid=vehiclestatusgroup_array[1]; 
    
           removestatushidden(cur_groupid);
         
           if($(".grouplist:checkbox:checked").length =="0"){
             if(settimeout!="")
              clearTimeout(settimeout);
           } 
           if($('.grouplist').length== $('.grouplist:checkbox:checked').length){
            $("#fulllist").prop("checked",true);
           }else{
            $("#fulllist").prop("checked",false);
           }
    
    
    
    
         if($(this).prop('checked')==true){
    
            $(".loader").show();
            $(".childgroup_"+cur_groupid).prop('checked',true);
            $(".childgroup_"+cur_groupid).each(function() {
    
              groupid=$(this).attr("data-stationgroupid");
              station_id=$(this).attr("data-id");
              $(".child_"+groupid+"_"+station_id).prop('checked',true);
    
           });
     
         }else{
    
     
           delete vehicle_groupwise_status[cur_groupid];
           $("#vehiclegroup_status_"+cur_groupid).html('');
           
            $(".loader").hide();
            $(".childgroup_"+cur_groupid).prop('checked',false);
            $(".childgroup_"+cur_groupid).each(function() {
    
              groupid=$(this).attr("data-stationgroupid");
              station_id=$(this).attr("data-id");
              $(".child_"+groupid+"_"+station_id).prop('checked',false);
    
              $(".child_"+groupid+"_"+station_id).each(function() {
     
                trackvehicle="";
                traceflag="0";
                if(!(id in marker)){
                     $('.track_vehicle').removeClass('btn-active');
                  }
               });
    
            });
    
     
         }
    
         var current_vehicle="";
         $(".childgroup_"+cur_groupid).each(function() {
              groupid=$(this).attr("data-stationgroupid");
              station_id=$(this).attr("data-id");
               $(".child_"+groupid+"_"+station_id).each(function() {
                    vehicle_id=this.id;
                    currentvehice_id=this.id.split("_");
                    current_vehicle+=currentvehice_id[1]+",";
                    vehicle_data(vehicle_id);    
               })
         });
     
      
         current_vehicle=current_vehicle.slice(0,-1)
         $("#current_selected_values").val(current_vehicle);
         
         var vehicle_new = vehicle.filter(function(v){return v!==''});
         vehicle_new=vehicle_new.toString()
         $("#selected_values").val(vehicle_new);
         
         
         
         if($(this).prop('checked')==true){
           vehicle_map_listing();
         }else{
            $("#current_selected_values").val("");
         }
             
      });
    
    
       $(document).on("click", '.stationlist', function (event) {
    
     
           cur_groupid=$(this).attr("data-stationgroupid"); 
           station_id=$(this).attr("data-id");
           delete vehicle_groupwise_status[cur_groupid];
           $vehicledatatype="1";
     
           if($('.childgroup_'+cur_groupid).length== $('.childgroup_'+cur_groupid+':checkbox:checked').length){
              $("#group_"+cur_groupid).prop("checked",true);
           }else{
              $("#group_"+cur_groupid).prop("checked",false);
           }
     
           if($('.childgroup_'+cur_groupid+':checkbox:checked').length =="0"){
               $("#group_"+cur_groupid).prop("checked",false);
               removestatushidden(cur_groupid);        
               $("#vehiclegroup_status_"+cur_groupid).html('');
               $vehicledatatype="";
           }
    
    
           if($('.grouplist').length== $('.grouplist:checkbox:checked').length){
               $("#fulllist").prop("checked",true);
           }else{
               $("#fulllist").prop("checked",false);
           }
    
    
           if($(".stationlist:checkbox:checked").length =="0"){
             if(settimeout!="")
               clearTimeout(settimeout);
           }
    
    
     
           if($(this).prop('checked')==true){
             $(".loader").show();
             $(".child_"+cur_groupid+"_"+station_id).prop('checked',true);
             var current_vehicle="";
             var current_vehicle="";
             $(".vehiclechildgroup_"+cur_groupid).each(function() {  
                   vehicle_id=this.id;             
                  vehicle_data(vehicle_id,$vehicledatatype);       
                  if($(this).prop("checked")){
                    currentvehice_id=this.id.split("_");
                    current_vehicle+=currentvehice_id[1]+",";
                  } 
             }); 
              current_vehicle=current_vehicle.slice(0,-1);
           }else{
    
              
             $("#vehiclegroup_status_"+cur_groupid).html('');
             
             $(".loader").hide();
             $(".child_"+cur_groupid+"_"+station_id).prop('checked',false);
     
             $(".child_"+cur_groupid+"_"+station_id).each(function() {
                trackvehicle="";
                traceflag="0";
                if(!(id in marker)){
                     $('.track_vehicle').removeClass('btn-active');
                }
             });
    
             var current_vehicle="";
             $(".vehiclechildgroup_"+cur_groupid).each(function() {  
                   vehicle_id=this.id;             
                   vehicle_data(vehicle_id,$vehicledatatype);       
                  if($(this).prop("checked")){
                    currentvehice_id=this.id.split("_");
                    current_vehicle+=currentvehice_id[1]+",";
                  } 
             });
               current_vehicle=current_vehicle.slice(0,-1)
           }
     
          
    
          $("#current_selected_values").val(current_vehicle);
          var vehicle_new = vehicle.filter(function(v){return v!==''});
          vehicle_new=vehicle_new.toString()
          $("#selected_values").val(vehicle_new);
    
          if(current_vehicle!=""){
           vehicle_map_listing();
          }
     
       });
    
    
    
       $(document).on("click", '.geoffencegrouplist', function (event) {
    
           var current_checkbox_id=this.id;
    
           if($(this).prop('checked')==true){
              $(".loaders").show();
              $(".child"+current_checkbox_id).prop('checked',true);
              if(current_checkbox_id=="geoffencegroup_1"){
                   $(".child"+current_checkbox_id).each(function() {
                       child_id=this.id;
                       $(".child"+child_id).prop('checked',true);
                       $(".child"+child_id).each(function() {
                           geoffence_id=this.id;                  
                           geoffence_data(geoffence_id);
                       });
                   });
              }        
           }else{
             $(".loaders").hide();
             $(".child"+current_checkbox_id).prop('checked',false);
             if(current_checkbox_id=="geoffencegroup_1"){
                   $(".child"+current_checkbox_id).each(function() {
                       child_id=this.id;
                       $(".child"+child_id).prop('checked',false);
                       $(".child"+child_id).each(function() {
                           geoffence_id=this.id;                  
                           geoffence_data(geoffence_id);
                       });
    
    
                   });
             }
           }
     
            if(current_checkbox_id!="geoffencegroup_1"){
              $(".child"+current_checkbox_id).each(function() {
                  geoffence_id=this.id;               
                  geoffence_data(geoffence_id);
              });
            }
     
         
            if($(this).prop('checked')==true){
              showgeoffence();
            }
         
       });
    
    
     
    
     $(document).on("click", '.geoffencecustomerlist', function (event) {
        
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
            deletegoeffence(id);
            delete geoffence[id];
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
    }
    
    
    
      
       //for drawing polygon
      function draw_polygon(boundaries,color,id,name){
        
           boundries=boundaries;
         var boundary_array=boundries.split("|");
         triangleCoords=[];
           $.each(boundary_array, function(index, bvalue) {
            var cordinates=bvalue.split(",");
             triangleCoords.push(new google.maps.LatLng(cordinates[0],cordinates[1])) ;
         });
             
         // Construct the polygon
            wataniyaTriangle = new google.maps.Polygon({
                     id:id,
                                 paths: triangleCoords,
                                 draggable: false,
                                 editable: false,
                                 strokeColor: '#'+color,
                                 strokeOpacity: 0.8,
                                 strokeWeight: 2,
                                 fillColor:  '#'+color,
                                 fillOpacity: 0.50
                         });
            wataniyaTriangle.setMap(map);
         attachPolygonInfoWindow(wataniyaTriangle,name);
         polygonarray.push(wataniyaTriangle);
          
       }
       
       
       //showing the name of the polygon
       function attachPolygonInfoWindow(polygon,name) {
            var geo_infoWindow = new google.maps.InfoWindow();
            google.maps.event.addListener(polygon, 'mouseover', function (e) {
               geo_infoWindow.setContent(name);
              var latLng = e.latLng;
              geo_infoWindow.setPosition(latLng);
              geo_infoWindow.open(map);
       });
       
       google.maps.event.addListener( polygon, 'mouseout', function() {
             geo_infoWindow.close();
       });
      
    }
    
    
    
    
        function vehicle_data(vehicleid,$type=""){
           
          vehicleid_array=vehicleid.split("_");
          id=vehicleid_array[1];
    
            if(!$('#'+vehicleid).prop('checked')){
    
                DeleteMarker(id);
                clear_fleet_polyline();
                delete vehicle[id];
                $(".vehicle_ls").hide();
                $(".vehicle_ws").hide();
                $('#'+vehicleid).parent().parent().parent().removeAttr("data-ignition");
                $('#'+vehicleid).parent().parent().parent().removeAttr("data-workshop");
                $('#'+vehicleid).parent().parent().parent().removeAttr("data-longstop");
    
              if($type=="")
                 $("#FleetDialog").css({'min-width' : '300px'});
                
            }else{
                if($type=="")
                  $("#FleetDialog").css({'min-width' : '350px'});
    
                  $(".loader").show();        
                  vehicle[id]=id;
            }
        }
         
       
       
       $(".vehiclelist").click(function(){
    
         cur_groupid=$(this).attr('data-groupid');
         cur_stationid=$(this).attr('data-stationid');
         delete vehicle_groupwise_status[cur_groupid];
         
    
         
         $(this).attr('data-vehiclestatus','20');
        
         if($(".vehiclelist:checkbox:checked").length =="0"){
            if(settimeout!="")
              clearTimeout(settimeout);
         } 
         
         if(!$(this).prop('checked')){
             $(".loader").hide();
                       
         }else{
             $(".loader").show();
         }
    
         $vehicledatatype="";
     
         if($('.child_'+cur_groupid+'_'+cur_stationid).length== $('.child_'+cur_groupid+'_'+cur_stationid+':checkbox:checked').length){
    
             $("#stationchildgroup_"+cur_groupid+'_'+cur_stationid).prop("checked",true);
         }else{
                
             $("#stationchildgroup_"+cur_groupid+'_'+cur_stationid).prop("checked",false);
         }
    
         if($('.childgroup_'+cur_groupid).length== $('.childgroup_'+cur_groupid+':checkbox:checked').length){
             $("#group_"+cur_groupid).prop("checked",true);
         }else{
             $("#group_"+cur_groupid).prop("checked",false);
    
         }
     
         if($('.childgroup_'+cur_groupid+':checkbox:checked').length =="0"){
             $("#group_"+cur_groupid).prop("checked",false);
             delete vehicle_groupwise_status[cur_groupid];
             $("#vehiclegroup_status_"+cur_groupid).html('');
             $vehicledatatype="1";
    
         }
       
         if($('.grouplist').length== $('.grouplist:checkbox:checked').length){
            $("#fulllist").prop("checked",true);
         }else{
            $("#fulllist").prop("checked",false);
         }
    
    
         id=this.id;
         vehicle_data(id, $vehicledatatype);
         currentvehice_id=this.id.split("_");
          
         var vehicle_new = vehicle.filter(function(v){return v!==''});
         vehicle_new=vehicle_new.toString()
         $("#selected_values").val(vehicle_new);
    
         var current_vehicle="";
         $(".vehiclechildgroup_"+cur_groupid).each(function() {                    
                if($(this).prop("checked")){
                  currentvehice_id=this.id.split("_");
                  current_vehicle+=currentvehice_id[1]+",";
                } 
         });
         $("#current_selected_values").val(current_vehicle);
     
           if(current_vehicle!=""){
             $("#vehiclegroup_status_"+cur_groupid).html("");
             vehicle_map_listing();
           }
            if($(this).prop('checked')==false){
             
              $("#current_selected_values").val("");
                 clear_fleet_polyline();
            }
            $("#trace_"+id).removeClass("btn-active");
       });
       
       
       
       
     });
  </script>