
 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Device Data</h4>
      </div>
      <form class="cmxform" id="commentForm" method="get" action="">
       <div class="modal-body" >
       <div class="col-md-12">
      <div class="col-md-5" >
          <label>Imei</label> <input type="number" minlength="15" maxlength="15" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" name="Imei" id="Imei" class="form-control" placeholder="Imei" required title="15 Numbers required">
          <span id="name_error1" class="collapse" style="color:#F00;">Imei Already existed</span>
          
         
          
      </div>   
       <div class="col-md-5" >
           <label>Sim Serial Number</label>
           
        <select name="sim"  id="sim" class="selectpicker form-control" data-live-search="true" >
             <option value=""> select</option>
             <?php foreach($sim as $sim_key=>$sim_data){?>
             <option value="<?=$sim_data['id']?>"><?=$sim_data['sim_serial']?></option>
              <?php } ?>
           </select>
         <i id="device-remove" title="Remove Device" class="glyphicon glyphicon-remove collapse"></i>
           </div> 
 
      </div>
       </div>
      <div class="modal-footer" >
        <button type="button" class="btn btn-info" id="device_insert" >Insert</button>
        <button type="button" class="btn btn-info collapse" id="device_update"  >Update</button>
      </div>
       </form>
    </div>
     </div>
   </div> 
   <div class="custom-width">  
   <div class="card dark-shadow">
   <div class="card-body">
     <div id="table_container">    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a><a id="device_add"><i class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></i></a></div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap" width="100%">       
             <thead style="display: table-header-group;">
             <tr class="header">
                <th>Device IMEI</th>
                 <th>Sim Serail No</th>
                <th>Device Status</th>
               <td> Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($devicefulldata as $devicekey=>$device_data){
			  ?>
            <tr >
              <td><?=$device_data['imei']?></td>
              <td id="sim_status_<?=$device_data['id']?>" ><?=$device_data['sim_serial']?></td>
               <td id="change-status_<?=$device_data['id']?>">
 			   <?php 
			   if($device_data['status']=="0"){
				   print "deactivated";
			   }else if($device_data['status']=="1"){
				    print "Ready To Use";
				   
			   }else{
				    print "Using in ".$device_data['vehicle'];
			   }
 			   
			   ?>
               </td>
               
              <td>
              <a class="btn edit_device"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$device_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
              
                 <?php if($device_data['status']!=0){ 
				$collapse1="collapse";
				$collapse="";				
				}else{
					$collapse1="";
				   $collapse="collapse";
				}?>
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$device_data['id']?>" style="color: #333" data-toggle="tooltip" title="Deactive Device" data-id="<?=$device_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                 
                <a id="dlt-clear_<?=$device_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Activate Device" data-id="<?=$device_data['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
               
               </td>
             </tr>
              <?php }?>
          </tbody>
         </table>
         
         <input type="hidden" id="device_data_id" value="">
	</div>
	</div>
   </div>
     </div>
</div>
 <script src="<?=base_url()?>lib/js/jquery.min.js"></script>
<script src="<?=base_url()?>lib/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>lib/js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>lib/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>lib/js/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>lib/js/jquery.selectBoxIt.js"></script>
<script>

$(document).ready(function() {
	
	
			 	 
	
	    $("#ControlPanelList a").hover(function () {
            var title = $(this).data("title");
            $("#ControlPanelList .control-panel-header").html(title);
        });
        $("#ControlPanelList").hover(function () {
            $("#ControlPanelList .control-panel-header").html('Control Panel');
        });
 	
			
  			// DataTable
			var table = $('#example').DataTable({
				"responsive": true,
				"autoWidth": true,
 				"orderCellsTop": true,
				"searching": true,
			});
			
 		//restricting to copy all charecters except the numbers
 	  var myInput = document.querySelectorAll("input[type=number]")[0];
	  myInput.addEventListener('paste', function(e) {
	  var pasteData = e.clipboardData.getData('text/plain');
	  if (pasteData.match(/[^0-9]/))
		e.preventDefault();
	  }, false);	
 
 			
 	/*data table end*/ 
     $('#commentForm').validate({ // initialize the plugin
        rules: {
            sim: {
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
  
   	$("#device_insert").click(function(){
		
  	  if($("#commentForm").valid()){
		 $("#device_insert").attr("disabled", "disabled");
  		 var imei=$("#Imei").val();
		 var sim=$("#sim").val();
 		 var status=$("#status").val();
        		 $.ajax({
			     url: "<?=base_url()?>/device/device_insert", 
			     data:{imei:imei,sim:sim,status:status},
			      method: "POST",
			     success: function(result){
					 $("#device_insert").removeAttr("disabled");
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
								 text:"Device data inserted successfully" ,
								 icon: "success",
								 button: "ok",
						  }).then(function(){
							   url=  "<?php echo  base_url(); ?>device";
								window.location.href = url;
						  });
					 }
 			     }
	         });
 		}
 	 });
 $(document).on("click", '.glyphicon-filter', function (event) {		 
        $('#example_filter').toggle(); 
		
	 });	 
	 //checking the Imei exist or not
 $(document).on("input", '#Imei', function (event) {
	  
 	 var imei=$(this).val();
	  var id= $("#device_data_id").val()!=""?$("#device_data_id").val():"";
	 $.ajax({
		 url: "<?=base_url()?>Device/imei_check", 
		 data:{id:id,imei:imei},
		 method: "POST",
		 success: function(result){
 			 var data = $.parseJSON(result); 
			 
			 if(data>0){
  				  $("#name_error1").removeClass("collapse");
				  $("#name_error1").addClass("error");
				  $("#device_insert").prop("disabled",true);
				  $("#device_update").prop("disabled",true);
  			 }else{
				  $("#name_error1").addClass("collapse");
				   $("#name_error1").removeClass("error");
				  $("#device_insert").prop("disabled",false);
				  $("#device_update").prop("disabled",false);
			 }
 		 }
			 
	 });
 });
	 
	 $(document).on("click", '#device_add', function (event) {
		 
		 	$("#device_insert").removeAttr("disabled");
 	        $("#device_insert").removeClass("collapse");
			$("#Imei").removeClass("error");
	        $("#device_update").addClass("collapse");
			$("#name_error1").addClass("collapse");
			$("#name_error1").removeClass("error");
			$("#commentForm")[0].reset();
			$('#commentForm').find('option:selected').removeAttr('selected').trigger('change');
 			$('select[name=sim]').attr('disabled',false);
 			$("#device-remove").addClass("collapse");
			$(".bs-caret").show()
 			$('.selectpicker').selectpicker('refresh');
			$("#myModal").modal('show');
			$("#device_data_id").val("");
			$.ajax({
			   url: "<?=base_url()?>/Device/simlist",
 			   success: function(result){
				    var data = $.parseJSON(result);
					$.each(data.information, function(index, pvalue) {
						var optionsvalues='<option value="">Select</option>';
 						 $.each(pvalue,function(keyindex, keyvalue){
									 optionsvalues+='<option value="'+keyvalue.id+'">'+keyvalue.sim_serial+'</option>'
									// console.log(optionsvalues);
 						 });
                        $("#sim").html(optionsvalues).selectpicker('refresh');
						
					});
					 
			   }
				  
		    });
		    
	 });
	
	 $(document).on("click", '#device-remove', function(event){
		 //alert('helo');
		var id=$("#device_data_id").val();
 		var sim_id=$("#sim").val();
		//console.log("device id is "+id);
		 //console.log(sim_id);
		 swal({
			 	title: "Are you sure?",
				text: "Do you want remove sim",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){					  					  
						 $.ajax({
							 url: "<?=base_url()?>/Device/sim_remove",
							 data: {id:id,sim_id:sim_id},
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
										 text:"Sim removed successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										
										$('#sim_status_'+id).html("");
										$('#device-dropbox').removeClass('device-dropbox');
		 								$('#device-remove').addClass('collapse');
										$('#device').find('option:selected').removeAttr('selected').trigger('change');
										$('select[name=sim]').val("");
 										$('select[name=sim]').attr('disabled',false);
										$("#device-remove").addClass("collapse");
										$(".bs-caret").show()
										$('.selectpicker').selectpicker('refresh');
					  					});								
								 }
							   }
							});
						
					}
				});
	 }); 
	 
	 
 	 
	 
	 $(document).on("click", '#device_update', function (event) {
		 
   		 if($("#commentForm").valid()){
			 $("#device_update").attr("disabled", "disabled");
			 swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the Device Data?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
            }).then((willUpdate) => {
		    if (willUpdate) {	  
				  
 			    var id=$("#device_data_id").val();
 			    var imei=$("#Imei").val();
		        var sim=$("#sim").val();
 		        var status=$("#status").val();
			
			    $.ajax({
			      url: "<?=base_url()?>/device/device_updation", 
			      data:{id:id,imei:imei,sim:sim,status:status},
			      method: "POST",
			      success: function(result){
					$("#device_update").removeAttr("disabled"); 
  					 var data = $.parseJSON(result); 
					 if(data.error_flag=="1"){
						 swal({
                                 text: data.error_message,
                                 icon: "error",
                                 button: "ok",
                          });
					 }else if(data.error_flag=="2"){
						 swal({
                                 text: data.message,
                                 icon: "warning",
                                 button: "ok",
                          });
					 }else{
					 
					    swal({
							 title: "Success!",
                             text:"Device data Updated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
						   url=  "<?php echo  base_url(); ?>device";
						   window.location.href = url;
					  });
					 }
 			     }
	          });
 		     }else{
				 $("#device_update").removeAttr("disabled");
				 }
		   
		});
		}
		 
	 });	 
	 
	 
	 $(document).on("click", '.edit_device', function (event) {
		 
		 $("#Imei").removeClass("error");
		 $("#Imei-error").remove();
		 $("#sim-error").remove();
 		 $("#name_error1").addClass("collapse");
		 $("#name_error1").removeClass("error");
		 $("#device_update").removeAttr("disabled");
   		  id=$(this).attr("data-id");
		  $("#device_data_id").val(id);
   		  $.ajax({
			     url: "<?=base_url()?>/device/selecting", 
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
 						      if(index=="full_sim"){ 
 							       var optionsvalues='<option value="">Select</option>';
 								   $.each(pvalue,function(keyindex, keyvalue){
									 optionsvalues+='<option value="'+keyvalue.id+'">'+keyvalue.sim_serial+'</option>'
 								   });
                                   $("#sim").html(optionsvalues).selectpicker('refresh');
								 
   							 }else if(index=="sim"){ 
							 
							  
							     if(pvalue!="0"){
 									 $('select[name=sim]').val(pvalue);
									 $(".bs-caret").hide();
									  $('select[name=sim]').attr('disabled',true)
									  $("#device-remove").removeClass("collapse");
  							     }else{
									  $(".bs-caret").show();
									  $('select[name=sim]').attr('disabled',false);
									  $("#device-remove").addClass("collapse");
 								 }
								 
 							    
   							 }else{
						        $("#"+index).val(pvalue);
							 }
 						 });
 						  $('.selectpicker').selectpicker('refresh');
 						  $("#device_update").removeClass("collapse");
						  $("#device_insert").addClass("collapse");
 						  $("#myModal").modal('show');
 					 }
			     }
	    });
 	 })
   });
   
   $(document).on("click", '.delete-clear', function(event){
		 id=$(this).attr("data-id");
		 $("#device_data_id").val(id);
		 swal({
			 	title: "Are you sure?",
				text: "Do you want activate Device",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){
					  //console.log("id "+$("#vehicle_data_id").val());	
						 $.ajax({
							 url: "<?=base_url()?>/Device/device_active",
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
										 text:"Device Activated successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										$("#change-status_"+id).html('Ready To Use');									
										
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
	 });
	 $(document).on("click", '.delete', function(event){
		id=$(this).attr("data-id");	
 		 var sim=$("#sim").val();	
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
			     url: "<?=base_url()?>/Device/device_deactive", 
			     data:{id:id,sim:sim},
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
					 }else if(data.error_flag=="2"){
									 
					   swal({
							   title: "Are you sure?",
							   text: data.message,
							   icon: "warning",
							   buttons: true,
							   dangerMode: true,
							   confirmButtonText: "Yes, Unlink it!",
							   cancelButtonText: "No, cancel Please!",
						}).then((willunlink) => {
							if(willunlink){
								$.ajax({
								   url: "<?=base_url()?>/Device/device_unlinkanddeactivate", 
								   data:{id:id},
								   method: "POST",
								   success: function(result){
									   var data = $.parseJSON(result); 
									   if(data.error_flag=="1"){
										   swal({
												   
												   text: data.error_message,
												   icon: "error",
												   button: "ok",
											});
									   } else{
										   swal({
											   title: "Success!",
											   text:"Device  unlinked and Deactivated successfully" ,
											   icon: "success",
											   button: "ok",
										  }).then(function(){
											  $("#change-status_"+id).html('Deactivated');
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
							 title: "Success!",
                             text:"Device Deactivated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
							//alert('hi');
							$("#change-status_"+id).html('Deactivated');
							$("#dlt-clear_"+id).show();
							$("#dlt-add_"+id).hide();
																			
						});
						
					 }
 			     }
	         });	    
		  }
		});		
			
	 });
 </script>

</body>
</html>

