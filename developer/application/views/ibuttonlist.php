 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Ibutton Data</h4>
      </div>
      <form class="cmxform" id="commentForm" method="get" action="">
       <div class="modal-body" >
       <div class="col-md-12">
      
          <label>Ibutton Number</label> <input type="text" minlength="16" maxlength="16" name="ibutton" id="ibutton" class="form-control" placeholder="ibutton" required title="16 Numbers required">
          <span id="ibutton_error1" class="collapse" style="color:#F00;">Ibutton Already existed</span>
       
 
      </div>
       </div>
      <div class="modal-footer" >
        <button type="button" class="btn btn-info" id="ibutton_insert" >Insert</button>
        <button type="button" class="btn btn-info collapse" id="ibutton_update"  >Update</button>
      </div>
       </form>
    </div>
     </div>
   </div> 
   <div class="custom-width">  
   <div class="card dark-shadow">
   <div class="card-body">
     <div id="table_container">    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a><a id="ibutton_add"><i class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></i></a></div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap" width="100%">       
             <thead style="display: table-header-group;">
             <tr class="header">
                <th>Ibutton Number</th> 
                <th>Ibutton Status</th>
                <th>Created</th>
                <th>Modified</th>
               <td> Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($ibuttonfulldata as $ibuttonkey=>$ibutton_data){
			  ?>
            <tr >
              <td><?=$ibutton_data['ibutton_number']?></td>
               
               <td id="change-status_<?=$ibutton_data['id']?>">
 			   <?php 
			   if($ibutton_data['status']=="0"){
				   print "deactivated";
			   }else if($ibutton_data['status']=="1"){
				    print "Ready To Use";
				   
			   }else{
				    print "Assigned To Mr. ".$ibutton_data['drivername']." #".$ibutton_data['batch_num'];
			   }
 			   
			   ?>
               </td>
               <td><?=$ibutton_data['created']?></td>
               <td><?=$ibutton_data['modified']?></td>
               
              <td>
              <a class="btn edit_ibutton"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$ibutton_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
              
                 <?php if($ibutton_data['status']!=0){ 
				$collapse1="collapse";
				$collapse="";				
				}else{
					$collapse1="";
				   $collapse="collapse";
				}?>
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$ibutton_data['id']?>" style="color: #333" data-toggle="tooltip" title="Deactive Ibutton" data-id="<?=$ibutton_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                 
                <a id="dlt-clear_<?=$ibutton_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Activate Ibutton" data-id="<?=$ibutton_data['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
               
               </td>
             </tr>
              <?php }?>
          </tbody>
         </table>
         
         <input type="hidden" id="ibutton_data_id" value="">
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
 	  var myInput = document.querySelectorAll("input[type=text]")[0];
	  myInput.addEventListener('paste', function(e) {
	  var pasteData = e.clipboardData.getData('text/plain');
	  if (pasteData.match(/[^a-zA-Z0-9 _]/g))
		e.preventDefault();
	  }, false);	
 
 	 

 	 $(document).on("keypress","#ibutton",function (e){
 	 	 var regex = new RegExp("^[a-zA-Z0-9 ]+$");
		    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		    if (regex.test(str)) {
		        return true;
		    }

		    e.preventDefault();
		    return false;
 	 })
 	 
  
		 
		 
   
  
   	$("#ibutton_insert").click(function(){
		
  	  if($("#commentForm").valid()){

         swal({
			 	title: "Are you sure?",
				text: "Do you want Insert this Ibutton?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
		 }).then((willUpdate) => {
              
              if(willUpdate){

              	$("#ibutton_insert").attr("disabled", "disabled");
	  		    var ibutton=$("#ibutton").val();
	  		    $.ajax({
				     url: "<?=base_url()?>/ibutton/ibutton_insert", 
				     data:{ibutton:ibutton},
				     method: "POST",
				     success: function(result){
						 $("#ibutton_insert").removeAttr("disabled");
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
									 text:"Ibutton data inserted successfully" ,
									 icon: "success",
									 button: "ok",
							  }).then(function(){
								   url=  "<?php echo  base_url(); ?>ibutton";
									window.location.href = url;
							  });
						 }
	 			     }
		        });

              }
               
		 });
 
        
 	  }
 });
 $(document).on("click", '.glyphicon-filter', function (event) {		 
        $('#example_filter').toggle(); 
		
	 });	 
	 //checking the Imei exist or not
 $(document).on("input", '#ibutton', function (event) {
	  
 	 var ibutton=$(this).val();
	  var id= $("#ibutton_data_id").val()!=""?$("#ibutton_data_id").val():"";
	 $.ajax({
		 url: "<?=base_url()?>Ibutton/ibutton_check", 
		 data:{id:id,ibutton:ibutton},
		 method: "POST",
		 success: function(result){
 			 var data = $.parseJSON(result); 
			 
			 if(data>0){
  				  $("#ibutton_error1").removeClass("collapse");
				  $("#ibutton_error1").addClass("error");
				  $("#ibutton_insert").prop("disabled",true);
				  $("#ibutton_update").prop("disabled",true);
  			 }else{
				  $("#ibutton_error1").addClass("collapse");
				   $("#ibutton_error1").removeClass("error");
				  $("#ibutton_insert").prop("disabled",false);
				  $("#ibutton_update").prop("disabled",false);
			 }
 		 }
			 
	 });
 });
	 
	 $(document).on("click", '#ibutton_add', function (event) {
		 
		 	$("#ibutton_insert").removeAttr("disabled");
 	        $("#ibutton_insert").removeClass("collapse");
			$("#ibutton").removeClass("error");
	        $("#ibutton_update").addClass("collapse");
			$("#ibutton_error1").addClass("collapse");
			$("#ibutton_error1").removeClass("error");
			$("#commentForm")[0].reset();
			$("#myModal").modal('show');
			$("#device_data_id").val("");
			$(".error").remove();
 
	 });
	
	 $(document).on("click", '#ibutton-remove', function(event){
		  ;
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
	 
	 
 	 
	 
	 $(document).on("click", '#ibutton_update', function (event) {
		 
   		 if($("#commentForm").valid()){
			
			 swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the Ibutton Data?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
            }).then((willUpdate) => {

		    if (willUpdate) {	  
			    $("#ibutton_update").attr("disabled", "disabled");
 			    var id=$("#ibutton_data_id").val();
 			    var ibutton=$("#ibutton").val();
		        
			    $.ajax({
			      url: "<?=base_url()?>/Ibutton/ibutton_updation", 
			      data:{id:id,ibutton:ibutton},
			      method: "POST",
			      success: function(result){
					$("#ibutton_update").removeAttr("disabled"); 
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
                             text:"Ibutton data Updated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
						   url=  "<?php echo  base_url(); ?>Ibutton";
						   window.location.href = url;
					  });
					 }
 			     }
	          });
 		     } 
		   
		});
		}
		 
	 });	 
	 
	 
	 $(document).on("click", '.edit_ibutton', function (event) {
 
		 $("#ibutton").removeClass("error");
		 $("#ibutton-error").remove();		 
 		 $("#ibutton_error1").addClass("collapse");
		 $("#ibutton_error1").removeClass("error");
		 $("#ibutton_update").removeAttr("disabled");

 
   		  id=$(this).attr("data-id");
		  $("#ibutton_data_id").val(id);
   		  $.ajax({
			     url: "<?=base_url()?>/Ibutton/selecting", 
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
                         var ibuttondata=data.information;                         
                          $("#ibutton").val(ibuttondata['ibutton']);
 						  $("#ibutton_update").removeClass("collapse");
						  $("#ibutton_insert").addClass("collapse");
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
							 url: "<?=base_url()?>/Ibutton/ibutton_active",
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
			     url: "<?=base_url()?>/Ibutton/ibutton_deactive", 
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
								   url: "<?=base_url()?>/Ibutton/ibutton_unlinkanddeactivate", 
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
											   text:"Ibutton  unlinked and Deactivated successfully" ,
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

