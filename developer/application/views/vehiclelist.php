<link rel="stylesheet" href="<?=base_url()?>lib/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?=base_url()?>lib/css/button.css" />
<style>#example_filter {
    display: none;
    right: 100px;
    position: absolute;
}
</style>

<?php
  $disabled_option="";
  if($user_group!="1"){
    $disabled_option="disabled";
  }


 ?>

 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Vehicle Data</h4>
      </div>
      <form class="cmxform" id="commentForm" method="get" action="">
       <div class="modal-body" >
       <div class="col-md-12">
      <div class="col-md-6" >
       <label> Asset Code</label> <input type="text" name="asset_code" id="asset_code" class="form-control" placeholder="Asset code" required <?=$disabled_option?> >
       <span id="name_error1" class="collapse" style="color:#F00;">Asset Code Already existed</span>
      <label>Asset Description</label><input type="text" name="asset_desc" id="asset_desc" class="form-control"  placeholder="Description" required <?=$disabled_option?> >
      <span id="name_error2" class="collapse" style="color:#F00;">Asset Description Already existed</span>
      <label>Vehicle Type</label>
             <select name="Group" class="selectpicker themes form-control" id="Group" data-live-search="true" required 
             <?=$disabled_option?>>
             <option>select</option>
             <?php foreach($groups as $group_key=>$group_data){?>
             <option  data-icon="<?=base_url()?>lib/<?=$group_data['icon']?>" value="<?=$group_data['id']?>"><?=$group_data['name']?></option>
              <?php } ?>
           </select>
             <label>Device</label>
            <div id="device-dropbox" class="device-dropbox" >

        <select name="device"  id="device" class="selectpicker form-control" data-live-search="true" <?=$disabled_option?> >
             <option value=""> select</option>
             <?php foreach($device as $device_key=>$device_data){?>
             <option value="<?=$device_data['id']?>"><?=$device_data['imei']?></option>
              <?php } ?>
           </select>
           </div>
       

           <?php if($disabled_option==""){ ?> 
                    <i id="device-remove" title="Remove Device" class="glyphicon glyphicon-remove collapse"></i>

           <?php } ?>
           
           
          
           <div style="clear:both"></div>
           <label>Sim Provider</label><input type="text" name="sim_provider" id="sim_provider" disabled class="form-control " placeholder="Sim Provider">
           <label>Initial Odometer </label><input type="text" name="ini_odo" id="ini_odo" class="form-control" placeholder="Initial Odometer"  <?=$disabled_option?>>
           <label>previous Oil changed Odometer</label><input type="text" name="prevoil_odo" id="prevoil_odo" class="form-control" placeholder="Previous oil changed odometer" <?=$disabled_option?>>
            <label>Registration Date</label>
           <input type="text" name="selected_date" id="reg_expiry" class="form-control"  placeholder=" DD/MM/YY" readonly  <?=$disabled_option?>>
          <label>Monthly Km Change Date</label>
            <div class="testing" id="testing">
            <input type="text" name="Monthly_kmdate" id="Monthly_kmdate" class="form-control" placeholder="DD/MM/YY" <?=$disabled_option?> >
          </div>
                  
            <label>Vehicle Model</label><input type="text" name="model" id="model" class="form-control" placeholder="Model"  <?=$disabled_option?>>
 
          </div>    



            <div class="col-md-6" >
      <label>Reference No</label><input type="text" name="name" id="name" class="form-control" placeholder="Reference No" required  <?=$disabled_option?>>
 
  <!--      <label>Plate Type</label>
            <select name="plate_type"   class="selectpicker form-control" id="plate_type" required >
             <option>select</option>
             <option value="0">Normal</option>
             <option value="1">Private</option>
           </select> -->


           <label>Vehicle Station</label>

            <select name="station"   class="selectpicker form-control" id="station">
             <option value="">select</option>
             <?php foreach($stations as $stations_key=>$stations_data){?>
             <option  value="<?=$stations_data['id']?>"><?=$stations_data['station_name']?></option>
              <?php } ?>
             
           </select>


        <label>Vehicle Group</label>
             <select name="Department" class="selectpicker themes form-control" id="department" data-live-search="true" required  <?=$disabled_option?>>
             <option>select</option>
             <?php foreach($department as $department_key=>$department_data){?>
             <option  value="<?=$department_data['id']?>"><?=$department_data['name']?></option>
              <?php } ?>
           </select>
                  
       <label>Sim Serial Number</label><input type="text" name="sim_serail" id="sim_serail" disabled class="form-control" placeholder="Sim Serial Number"  <?=$disabled_option?>>
       <label>Sim Number</label><input type="text" name="sim_num" id="sim_num" disabled class="form-control" placeholder="Sim Number"  <?=$disabled_option?>>
        
         <label>Initial Odometer date</label><input type="text" name="odo_date" id="odo_date" class="form-control " placeholder="DD/MM/YY" readonly  <?=$disabled_option?>>
         <label>Oil Changed date</label><input type="text" name="oil_date" id="oil_date" class="form-control" placeholder="DD/MM/YY" readonly  <?=$disabled_option?> >
         
          <label>Year Of Making</label>
          <select name="yom" class="selectpicker form-control" id="yom" data-live-search="true"  <?=$disabled_option?>>
             <option>select</option>
             <?php  for ($x = 1989; $x <= date("Y"); $x++) {?>
             <option value="<?=$x?>"><?=$x?></option>
              <?php } ?>
           </select>

            <label>Monthly Km Change</label>

            <input type="text" name="Monthly_km" id="Monthly_km" class="form-control" placeholder="Monthly KM"    <?=$disabled_option?> >




        </div>
      </div>
       </div>
      <div class="modal-footer" >
        <button type="button" class="btn btn-info" id="insert"  <?=$disabled_option?> >Insert</button>
        <button type="button" class="btn btn-info collapse" id="update"  >Update</button>
      </div>
       </form>
    </div>
     </div>
   </div> 
   <div class="custom-width">  
   <div class="card dark-shadow">
	<div class="card-body">
	

     <div id="table_container">
    
       <div class="menu"><a><i title="Search" class="glyphicon glyphicon-filter"></i></a>
<?php 
if($user_group=="1"){ ?>
   <a id="add"><i class="glyphicon glyphicon-plus" title="Add vehicle Details" data-toggle="modal" data-target="#myModal"   ></i></a>
<?php } ?>
       


      </div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap"  style=" box-sizing: border-box; clear:both"  >
       
             <thead style="display: table-header-group;">
             <tr class="header">
               <td> Asset Code </td>
               <td> Name</td>
               <td> Plate Number</td>
               <td> Vehicle Type</td>
               <td> Vehicle Group</td>
               <td> Vehicle Station</td>
               <td> Device IMEI</td>
               <td> Sim Serial Number</td>
               <td> Created</td>
               <td>Modified</td>
               <td>Status</td>
               <td> Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($vehiclefulldata as $vehiclekey=>$vehicle_data){
			  ?>
            <tr >
              <td><?=strtoupper($vehicle_data['asset_code']);?></td>
              <td><?=$vehicle_data['name']?></td>
              <td><?=$vehicle_data['description']?></td>
              <td><?=$vehicle_data['group_name']?></td>
              <td><?=$vehicle_data['department_name']?></td>
               <td><?=$vehicle_data['station_name']!=""?$vehicle_data['station_name']:"General"?></td>
              <td><?=$vehicle_data['imei']?></td>
              <td><?=$vehicle_data['sim_serial']?></td>
            
               <td><?=$vehicle_data['created']?></td>
              <td><?=$vehicle_data['modified']?></td>
              <td id="change-status_<?=$vehicle_data['id']?>"><?=$vehicle_data['status']=="1"?"Active":"In Active";?></td>
              <td>
<!--                <a class="btn" style="color: #333" data-toggle="tooltip" title="Details"><i class="glyphicon glyphicon-list" style="font-size: 20px"></i></a>
                <a class="btn" style="color: #333" data-toggle="tooltip" title="Edit Odometer"><i class="glyphicon glyphicon-scale" style="font-size: 20px"></i></a>-->
               <a class="btn edit"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$vehicle_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px" ></i></a>
             <!--   <a class="btn" style="color: #333" data-toggle="tooltip" title="Registration"><i class="glyphicon glyphicon-credit-card" style="font-size: 20px"></i></a>
                <a class="btn" style="color: #333" data-toggle="tooltip" title="Insurance"><i class="icon icon-shield" style="font-size: 20px"></i></a>
                <a class="btn" style="color: #333" data-toggle="tooltip" title="Unassign Fleet"><i class="icon icon-unassignfleet" style="font-size: 21px"></i></a>
                <a class="btn" style="color: #333" data-toggle="tooltip" title="Drivers"><i class="icon icon-driver" style="font-size: 25px"></i></a>
                <a class="btn" style="color: #333" data-toggle="tooltip" title="Nearest Vehicles"><i class="icon icon-car-wash" style="font-size: 25px"></i></a>-->
               
                <?php if($vehicle_data['status']!=0){ 
        				$collapse1="collapse";
        				$collapse="";				
        				}else{
        					$collapse1="";
        				   $collapse="collapse";
        				}?>
                
                
                
                
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$vehicle_data['id']?>" style="color: #333" data-toggle="tooltip" title="Deactive Vehicle" data-id="<?=$vehicle_data['id']?>" <?=$disabled_option?> ><span style="opacity:0">1</span><i class="glyphicon glyphicon-trash" style="font-size: 20px" <?=$disabled_option?> ></i>
                </a>
                 
                <a id="dlt-clear_<?=$vehicle_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Activate Vehicle" data-id="<?=$vehicle_data['id']?>" <?=$disabled_option?> ><span style="opacity:0">2</span><i class="glyphicon glyphicon-import" style="font-size: 20px" <?=$disabled_option?> ></i></a>
                
              </td>
              
             </tr>
              <?php }?>
          </tbody>
         </table>
         <input type="hidden" id="usergroup" value="<?=$user_group?>">
         <input type="hidden" id="vehicle_data_id" value="">
		 </div>
</div></div>
 </div>
 </div>
   </div>
     
</div>



 <script src="<?=base_url()?>lib/js/jquery.min.js"></script>
<script src="<?=base_url()?>lib/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>lib/js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>lib/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>lib/js/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"  ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" /></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"  ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"  ></script>        	
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"  ></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"  ></script>
<script src="<?php echo base_url(); ?>lib/js/jquery.selectBoxIt.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  <script>
 
 
$(document).ready(function() {
		//$('[data-toggle="tooltip"]').tooltip();
		$('#device-dropbox').removeClass('device-dropbox');
	  $('#device-remove').addClass('collapse');		 
	  $("#ControlPanelList a").hover(function () {
            var title = $(this).data("title");
            $("#ControlPanelList .control-panel-header").html(title);
    });
    $("#ControlPanelList").hover(function () {
            $("#ControlPanelList .control-panel-header").html('Control Panel');
    });
	
	  var today = new Date();
	  $( "#reg_expiry" ).datepicker({
			  maxDate: today
		});
	    $( "#odo_date" ).datepicker({
			 maxDate: today
		}); 
	    $( "#oil_date" ).datepicker({
			 maxDate: today
		}); 
   

     $('#Monthly_kmdate').datetimepicker({
       showClose:true,
     //format: 'DD.MM.YYYY hh:mm',
      //format: 'DD.MM.YYYY',
      widgetParent: '#myModal',
       maxDate: today,
     
    });	

     $('#Monthly_kmdate').click(function(){
         var datepicker = $('body').find('.bootstrap-datetimepicker-widget:last');
        if (datepicker.hasClass('bottom')) {
          var top = $(this).offset().top + $(this).outerHeight();
          var left = $(this).offset().left;
          datepicker.css({
            'top': top + 'px',
            'bottom': 'auto',
            'left': left + 'px'
          });
        }
        else if (datepicker.hasClass('top')) {
          var top = $(this).offset().top ;
          var left = $(this).offset().left;
          top = top - 50;
          datepicker.css({
            'top': top + 'px',
            'bottom': 'auto',
            'left': left + 'px'
          });
        }
    });
			
			
 			// DataTable
			var table = $('#example').DataTable({
				"responsive": true,
				"autoWidth": true,
 				"orderCellsTop": true,
				"searching": true,
				"columnDefs": [
					{ "targets": [10], "orderable": false }
				],
				dom: 'lBfrtip',
          		 buttons: [ 'excel', 'print'
          		]
				//"bSearchable": true,
			});
			
 			 
 			
 	/*data table end*/ 
     $('#commentForm').validate({ // initialize the plugin
        rules: {
            plate_type: {
                selectcheck: true
            },
			      device: {
                selectcheck: true
            },
			      Group: {
                selectcheck: true
            },
			      Department: {
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
   
  
		 
		 
  
   	$("#insert").click(function(){


      var usergroup=$("#usergroup").val();
      if(usergroup=="1"){
       	  if($("#commentForm").valid()){
      		 var assetcode=$("#asset_code").val();
      		 var name=$("#name").val();
      		 var assetdesc=$("#asset_desc").val();
      		 var plate_type=$("#plate_type").val();
      		 var department=$("#department").val();
      		 var group=$("#Group").val();
      		 var driver=$("#device_id").val();
      		 var model=$("#model").val();
      		 var yom=$("#yom").val();
      		 var ini_odo=$("#ini_odo").val();
      		 var odo_date=$("#odo_date").val();
      		 var reg_exp=$("#reg_expiry").val();
      		 var device_id=$("#device").val();
      		 var prevoil_odo=$("#prevoil_odo").val();
      		 var oil_change=$("#oil_date").val();
           var  station=$("#station").val();
           var  Monthly_km=$("#Monthly_km").val();
           var  Monthly_kmdate=$("#Monthly_kmdate").val();
      	 	$("#insert").attr("disabled", "disabled");
             		 $.ajax({
      			     url: "<?=base_url()?>/Vehicle/vehicle_insert", 
      			     data:{assetcode:assetcode,name:name,assetdesc:assetdesc,plate_type:plate_type,group:group,station:station,department:department,driver:driver,model:model,device_id:device_id,yom:yom,ini_odo:ini_odo,odo_date:odo_date,prevoil_odo:prevoil_odo,oil_change:oil_change,reg_exp:reg_exp,Monthly_km:Monthly_km,Monthly_kmdate:Monthly_kmdate},
      			      method: "POST",
      			     success: function(result){
      					 $("#insert").removeAttr("disabled");
      					  var data = $.parseJSON(result); 
      					 if(data.error_flag=="1"){
      						 swal({
                                       text: data.error_message,
                                       icon: "error",
                                       button: "ok",
                                });
      					 }else{
      					 
      						 swal({
      								 title: "Success!",
      								 text:"Vehicle data inserted successfully" ,
      								 icon: "success",
      								 button: "ok",
      						  }).then(function(){
      							   url=  "<?php echo  base_url(); ?>Vehicle";
      							   window.location.href = url;
      						  });
      					 }
       			     }
      	         });
       		}
      }else{

        swal({
              text: "Sorry!!! you dont have the permission to insert",
              icon: "warning",
             button: "ok",
         });

      }
 	 });
	 
	 function resetform(){
		    $(".form-control").removeClass("error");
			$(".error").remove();
			$("#name_error1").addClass("collapse");
			$("#name_error1").removeClass("error");
			$("#name_error2").addClass("collapse");
			$("#name_error2").removeClass("error");
			$("#commentForm")[0].reset();
			$('#commentForm').find('option:selected').removeAttr('selected').trigger('change');
	 }
	 
	 $(document).on("click", '#add', function (event) {
 	        $("#insert").removeClass("collapse");
	        $("#update").addClass("collapse");
			    $('#device-dropbox').removeClass('device-dropbox');
		    	$('#device-remove').addClass('collapse');
			resetform();

      var usergroup=$("#usergroup").val();
      $('select[name=device]').attr('disabled',false);

 

 			$("#device-remove").addClass("collapse");
  			$('.selectpicker').selectpicker('refresh');
			$("#myModal").modal('show');
			$("#insert").removeAttr("disabled");			
	 });
	 
	 $(document).on("click", '#update', function (event) {


    if($("#commentForm").valid()){
		 
		      swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the vehicle data?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
         }).then((willUpdate) => {
			 
          			 if(willUpdate){
             			  $("#update").attr("disabled", "disabled");
            			//console.log("id "+$("#vehicle_data_id").val())
            			  var id=$("#vehicle_data_id").val();
            			  var assetcode=$("#asset_code").val();
            		    var name=$("#name").val();
            		    var assetdesc=$("#asset_desc").val();
            		    var plate_type=$("#plate_type").val();
            			  var department=$("#department").val();
            		    var group=$("#Group").val();
            		    var driver=$("#device_id").val();
            		    var model=$("#model").val();
            		    var yom=$("#yom").val();
            		    var ini_odo=$("#ini_odo").val();
            		    var odo_date=$("#odo_date").val();
            		    var reg_exp=$("#reg_expiry").val();
            		    var device_id=$("#device").val();
            		  	var prevoil_odo=$("#prevoil_odo").val();
            		    var oil_change=$("#oil_date").val();
                    var  station=$("#station").val();
            			 //alert(oil_change);
                    var usergroup=$("#usergroup").val();

                    var  Monthly_km=$("#Monthly_km").val();
                    var  Monthly_kmdate=$("#Monthly_kmdate").val();
 
                    if(usergroup=="1"){
                      var dataoptions={id:id,assetcode:assetcode,name:name,assetdesc:assetdesc,plate_type:plate_type,group:group,station:station,department:department,driver:driver,model:model,device_id:device_id,yom:yom,ini_odo:ini_odo,odo_date:odo_date,prevoil_odo:prevoil_odo,oil_change:oil_change,reg_exp:reg_exp,usergroup:usergroup,Monthly_km:Monthly_km,Monthly_kmdate:Monthly_kmdate}
                    }else{
                       var dataoptions={id:id,station:station,usergroup:usergroup}

                    }
             
              			$.ajax({
              			     url: "<?=base_url()?>/Vehicle/vehicle_updation", 
              			     data:dataoptions,
              			     method: "POST",
              			     success: function(result){
              					$("#update").removeAttr("disabled");	 
              					// console.log(result);
              					 			
               					 var data = $.parseJSON(result); 
              					 if(data.error_flag=="1"){
              						 swal({
                                               text: data.error_message,
                                               icon: "error",
                                               button: "ok",
                                        });
              					 }else{
              					    swal({
              							 title: "Success!",
                                           text:"Vehicle data Updated successfully" ,
                                           icon: "success",
                                           button: "ok",
                                      }).then(function(){
              						   url=  "<?php echo  base_url(); ?>Vehicle";
              						   window.location.href = url;
              					  });
              					 }
               			     }
              	     });           			
            		   }
		 
		     });
    }
		 
});
	 $(document).on("click", '.delete-clear', function(event){
		 id=$(this).attr("data-id");
     var usergroup=$("#usergroup").val();
     if(usergroup=="1"){
      swal({
        title: "Are you sure?",
        text: "Do you want activate vehicle",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        }).then((willUpdate) => {
          if(willUpdate){
            //console.log("id "+$("#vehicle_data_id").val()); 
             $.ajax({
               url: "<?=base_url()?>/Vehicle/vehicle_active",
               data: {id:id},
               method: "POST",
               success: function(result){
               //console.log(result);                     
                 var data = $.parseJSON(result); 
                 if(data.error_flag=="1"){
                   swal({
                       text: data.error_message,
                       icon: "error",
                       button: "ok",
                    });
                 }else{
                  swal({
                     title: "Success!",
                     text:"Vehicle data Activated successfully" ,
                     icon: "success",
                     button: "ok",
                  }).then(function(){
                    $("#change-status_"+id).html('Active');
                    $("#dlt-add_"+id).show();
                    //console.log($("#dlt-add_"+id).val());
                    $("#dlt-clear_"+id).hide();
                    //alert('hello');                       
                      });               
                 }
                 }
              });           
          }
        });

     }else{

       swal({
             title: "Warning!",
             text:"Sorry!!! You dont have the permission to do this Action" ,
             icon: "warning",
             button: "ok",
        });

     }
		 
	 });
	 $(document).on("click", '.delete', function(event){
    var usergroup=$("#usergroup").val();
     if(usergroup=="1"){

      		id=$(this).attr("data-id");		
      		swal({
                            title: "Are you sure?",
                            text: "Do you want to Deactivate?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
               }).then((willUpdate) => {
      			 
      			 if(willUpdate){		 
       				
      			//console.log("id "+$("#vehicle_data_id").val());
      			$.ajax({
      			     url: "<?=base_url()?>/Vehicle/vehicle_deletion", 
      			     data:{id:id},
      			     method: "POST",
      			     success: function(result){
      					 
      					 //console.log(result);
      					 			
       					 var data = $.parseJSON(result); 
      					 if(data.error_flag=="1"){
      						 swal({
                                       text: data.error_message,
                                       icon: "error",
                                       button: "ok",
                                });
      					 }else{
      					    swal({
      							 title: "Success!",
                                   text:"Vehicle  Deactivated successfully" ,
                                   icon: "success",
                                   button: "ok",
                              }).then(function(){
      							$("#change-status_"+id).html('In Active');
      							$("#dlt-clear_"+id).show();
      							$("#dlt-add_"+id).hide();												
      						});
      						
      					 }
       			     }
      	         });	    
      		  }
      		});		
       }else{
         swal({
             title: "Warning!",
             text:"Sorry!!! You dont have the permission to do this Action" ,
             icon: "warning",
             button: "ok",
        });

       }
			
	 });
	 $(document).on("click", '#device-remove', function(event){
		 //alert('helo');
		 id=$("#vehicle_data_id").val();
		 device_id=$("#device").val();
		 //console.log(id);
		 swal({
			 	title: "Are you sure?",
				text: "Do you want remove device",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){					  					  
						 $.ajax({
							 url: "<?=base_url()?>/Vehicle/device_remove",
							 data: {id:id,device_id:device_id},
							 method: "POST",
							 success: function(result){
							 //console.log(result);																		
								 var data = $.parseJSON(result); 
								 if(data.error_flag=="1"){
									 swal({
											 text: data.error_message,
											 icon: "error",
											 button: "ok",
									  });
								 }else{
									swal({
										 title: "Success!",
										 text:"Device removed successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										$('#device-dropbox').removeClass('device-dropbox');
		 								$('#device-remove').addClass('collapse');
										$('#device').find('option:selected').removeAttr('selected').trigger('change');
 									    $("#sim_serail").val("Not Available"); 
									    $("#sim_num").val("Not Available");
									    $("#sim_provider").val("Not Available");
 										$('select[name=device]').attr('disabled',false);
 			                            $("#device-remove").addClass("collapse");
  			                            $('.selectpicker').selectpicker('refresh');
										//alert('hello');						   					
					  					});								
								 }
							   }
							});
						
					}
				});
	 });
	 $(document).on("click", '.glyphicon-filter', function (event) {		 
        $('#example_filter').toggle();
		
	 });
	  //checking the Asset code exist or not
 $(document).on("input", '#asset_code', function (event) {
 	 var assetcode=$(this).val();
	 //console.log(asset_code);
 	  var id= $("#vehicle_data_id").val()!=""?$("#vehicle_data_id").val():"";
	 $.ajax({
		 url: "<?=base_url()?>Vehicle/asset_code_check", 
		 data:{assetcode:assetcode,id:id},		 
		 method: "POST",
		 success: function(result){
 			 var data = $.parseJSON(result); 
			 //console.log(data);
			 if(data>0){
  				  $("#name_error1").removeClass("collapse");
				  $("#name_error1").addClass("error");
				  $("#insert").prop("disabled",true);
				  $("#update").prop("disabled",true);
  			 }else{
				  $("#name_error1").addClass("collapse");
				   $("#name_error1").removeClass("error");
				  $("#insert").prop("disabled",false);
				  $("#update").prop("disabled",false);
			 }
 		 }
			 
	 });
 });
 
 //pulling up the sim details
 $(document).on("change", '#device', function (event) {
	 
	 var device_id=$("#device").val();
	 
	 
	 if(device_id!=""){
		 $.ajax({
			 url: "<?=base_url()?>Vehicle/pull_simdetails", 
			 data:{device_id:device_id},		 
			 method: "POST",
			 success: function(result){
				 var data = $.parseJSON(result); 
 				 if(data.sim_serial!= null){
					 $("#sim_serail").val(data.sim_serial);
				 }else{
 					$("#sim_serail").val("Not Available"); 
				 }
				 if(data.sim_num!=null){
					  $("#sim_num").val(data.sim_num);
				 }else{
					 $("#sim_num").val("Not Available");
				 }
				 if(data.provider!=null){
					 var provider=data.provider=="0"?"Vodafone":"Ooreedo";
				     $("#sim_provider").val(provider);
				 }
				 else{
					 $("#sim_provider").val("Not Available");
				 }
				 
			 }
		 });
		 
	 }
 });
 
  //checking the Asset Description exist or not
 $(document).on("input", '#asset_desc', function (event) {
 	 var assetdescr=$(this).val();
	 var id= $("#vehicle_data_id").val()!=""?$("#vehicle_data_id").val():"";
	 $.ajax({
		 url: "<?=base_url()?>Vehicle/assset_name_check", 
		 data:{assetdescr:assetdescr,id:id},		 
		 method: "POST",
		 success: function(result){
 			 var data = $.parseJSON(result); 
			 //console.log(data);
			 if(data>0){
  				  $("#name_error2").removeClass("collapse");
				  $("#name_error2").addClass("error");
				  $("#insert").prop("disabled",true);
  			 }else{
				  $("#name_error2").addClass("collapse");
				   $("#name_error2").removeClass("error");
				  $("#insert").prop("disabled",false);
			 }
 		 }
			 
	 });
 });

 
	 $(document).on("click", '.edit', function (event) {
		  resetform();
      var usergroup=$("#usergroup").val();
   		  id=$(this).attr("data-id");
		    $("#vehicle_data_id").val(id);
   		  $.ajax({
			     url: "<?=base_url()?>/Vehicle/selecting", 
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
							 
 							 if(index=="plate_type"){ 
 							    $('select[name=plate_type]').val(pvalue);
   						 }else if(index=="full_devices"){
 								 var optionsvalues='<option value="">Select</option>';
 								 $.each(pvalue,function(keyindex, keyvalue){
									 optionsvalues+='<option value="'+keyvalue.id+'">'+keyvalue.imei+'</option>'
 								 });
                 $("#device").html(optionsvalues).selectpicker('refresh');
 							 }else if(index=="device"){
    								 $('select[name=device]').val(pvalue.id);
								 	   $('#device').val(pvalue.id);									 
								 	   if(pvalue.id!='0'){										 
									     $('#device-dropbox').addClass('device-dropbox');
		 								   $('#device-remove').removeClass('collapse');
										 
									     //$(".bs-caret").hide();
									     $('select[name=device]').attr('disabled',true)
									     $("#device-remove").removeClass("collapse");
 								 		 }else{

                      if(usergroup=="1"){
                        $('select[name=device]').attr('disabled',false);
                      }
                      else{

                        console.log("here -"+usergroup);
                         // $('select[name=device]').attr('disabled',true);
                      }
 
									     $("#device-remove").addClass("collapse");
											//console.log(pvalue.id);
											 $('#device-dropbox').removeClass('device-dropbox');
		 									 $('#device-remove').addClass('collapse');
										 }
 							 }else if(index=="station_id"){
                $('select[name=station]').val(pvalue);
               }else if(index=="Group"){
								$('select[name=Group]').val(pvalue);
 							 }else  if(index=="Department"){
								$('select[name=Department]').val(pvalue);
 							 }else if(index=="yom"){
								$('select[name=yom]').val(pvalue);
 							 }else if(index=="odo_date"){
								 console.log("odo date value is "+pvalue);
								 if(pvalue==""){
									  $("#"+index).val("DD/MM/YY");	
								 }else{
									  $("#"+index).val(pvalue);	
								 }
							 }else if(index=="reg_expiry"){
								 if(pvalue==""){
									  $("#"+index).val("DD/MM/YY");	
								 }else{
									  $("#"+index).val(pvalue);	
								 }
								 
							 }else if(index=="oil_date"){
								 if(pvalue==""){
									  $("#"+index).val("DD/MM/YY");	
								 }else{
									  $("#"+index).val(pvalue);	
								 }
								 
							 }
							 else{
							 
 							    $("#"+index).val(pvalue);								
							 }
 						 });
						 
						  $('.selectpicker').selectpicker('refresh');
						 $("#update").removeAttr("disabled");
						 $("#update").removeClass("collapse");
						 $("#insert").addClass("collapse");
 						 $("#myModal").modal('show');
 					 }
			     }
	    });
 	 }) 
	 
	 
	 
	 
  });
 </script>



