
 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Sim Data</h4>
      </div>
      <form class="cmxform" id="commentForm" method="get" action="">
       <div class="modal-body" >
       <div class="col-md-12">
      <div class="col-md-6" >
          <label>Sim Serial Number</label> <input type="number" minlength="19" maxlength="19" name="sim_serial_no" id="sim_serial_no" class="form-control"  placeholder="Serial Number" required title="19 Numbers required">
          <span id="name_error1" class="collapse" style="color:#F00;">Serial Number Already existed</span>
           <label>Provider</label>
         <select name="provider" class="selectpicker form-control" id="provider" required >
             <option>select</option>
             <option value="0">Vodafone</option>
              <option value="1">Ooredoo</option>
         </select>
      </div>    
      <div class="col-md-6" >
       <label>Sim Number</label><input type="number" minlength="8" maxlength="10" name="sim_num" id="sim_num" class="form-control" placeholder="Sim Number" required title="Please Enter a Valid Mobile Number">
          
         </div>
      </div>
       </div>
      <div class="modal-footer" >
        <button type="button" class="btn btn-info" id="sim_insert" >Insert</button>
        <button type="button" class="btn btn-info collapse" id="sim_update"  >Update</button>
      </div>
       </form>
    </div>
     </div>
   </div> 
   <div class="custom-width">  
   <div class="card dark-shadow">
   <div class="card-body">
     <div id="table_container">    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a><a id="sim_add"><i class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></i></a></div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap" width="100%">       
             <thead style="display: table-header-group;">
             <tr class="header">
              <th>Sim Serail No</th>
              <th>Sim No</th>
              <th>Provider</th>
              <th>Status</th>
             <td> Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($simfulldata as $simkey=>$sim_data){
			  ?>
            <tr >
              <td><?=$sim_data['sim_serial']?></td>
              <td><?=$sim_data['sim_num']?></td>
              <td><?=$sim_data['provider']=="0"?"Vodafone":"Ooreedo";?></td>
               <td id="change-status_<?=$sim_data['id']?>"><?php 
			   if($sim_data['status']=="0"){	
				   print "Deactiveated";
			   }else if($sim_data['status']=="1"){
				    print "Ready To Use";
				   
			   }else{
				    print "Using in device ".$sim_data['imei'];
			   }
 			   
			   ?></td>
               
              <td>
              <a class="btn edit_sim"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$sim_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
              
                 <?php if($sim_data['status']!=0){ 
				$collapse1="collapse";
				$collapse="";				
				}else{
					$collapse1="";
				   $collapse="collapse";
				}?>
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$sim_data['id']?>" style="color: #333" data-toggle="tooltip" title="Deactive sim" data-id="<?=$sim_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                 
                <a id="dlt-clear_<?=$sim_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Activate sim" data-id="<?=$sim_data['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
               
               </td>
             </tr>
              <?php }?>
          </tbody>
         </table>
         
         <input type="hidden" id="sim_id" value="">
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
			
 			
 
 			
 	/*data table end*/ 
     $('#commentForm').validate({ // initialize the plugin
        rules: {
            provider: {
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
  
   	$("#sim_insert").click(function(){
		
  	  if($("#commentForm").valid()){
  		 
		 var sim_serial_number=$("#sim_serial_no").val();
		 var sim_number=$("#sim_num").val();
		 var provider=$("#provider").val();
		 //var status=$("#status").val();
        		 $.ajax({
			     url: "<?=base_url()?>Sim/sim_insert", 
			     data:{sim_serial_number:sim_serial_number,sim_number:sim_number,provider:provider},
			      method: "POST",
			     success: function(result){
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
								 text:"SIM data inserted successfully" ,
								 icon: "success",
								 button: "ok",
						  }).then(function(){
							   url=  "<?php echo  base_url(); ?>Sim";
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
 $(document).on("change", '#sim_serial_no', function (event) {
 	 var serial_no=$(this).val();
	 $.ajax({
		 url: "<?=base_url()?>Sim/sim_check", 
		 data:{sim_serial_number:serial_no},
		 method: "POST",
		 success: function(result){
 			 var data = $.parseJSON(result); 
			 
			 if(data>0){
  				  $("#name_error1").removeClass("collapse");
				  $("#name_error1").addClass("error");
				  $("#sim_insert").prop("disabled",true);
  			 }else{
				  $("#name_error1").addClass("collapse");
				   $("#name_error1").removeClass("error");
				  $("#sim_insert").prop("disabled",false);
			 }
 		 }
			 
	 });
 });
	 
	 $(document).on("click", '#sim_add', function (event) {
 	        $("#sim_insert").removeClass("collapse");
	        $("#sim_update").addClass("collapse");
			$("#name_error1").addClass("collapse");
			$("#name_error1").removeClass("error");
			$("#commentForm")[0].reset();
			$('#commentForm').find('option:selected').removeAttr('selected').trigger('change');
	 });
	 
	 $(document).on("click", '#sim_update', function (event) {
 		 
  		  if($("#commentForm").valid()){
			 swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the SIM Data?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
             }).then((willUpdate) => {
		         if (willUpdate) {
				  
				  
				  
 			    var id=$("#sim_id").val();
 		        var sim_serial_number=$("#sim_serial_no").val();
		        var sim_number=$("#sim_num").val();
				var provider=$("#provider").val();
		         
			
			    $.ajax({
			      url: "<?=base_url()?>/Sim/sim_updation", 
			      data:{id:id,sim_serial_number:sim_serial_number,sim_number:sim_number,provider:provider},
			      method: "POST",
			      success: function(result){
					 
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
                             text:"SIM data Updated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
						   url=  "<?php echo  base_url(); ?>Sim";
						   window.location.href = url;
					  });
					 }
 			     }
	          });
			  
			  }
			 }); 
			  
 		     }
 		 
	 });	 
	 
	 
	 $(document).on("click", '.edit_sim', function (event) {
   		  id=$(this).attr("data-id");
		  $("#sim_id").val(id);
   		  $.ajax({
			     url: "<?=base_url()?>/sim/selecting", 
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
							 
 							 if(index=="provider"){
								 
							    $('select[name=provider]').val(pvalue);
							 }else{
						        $("#"+index).val(pvalue);
							 }
 						 });
						 
 						  $('.selectpicker').selectpicker('refresh');
  						  $("#sim_update").removeClass("collapse");
						  $("#sim_insert").addClass("collapse");
 						  $("#myModal").modal('show');
 					 }
			     }
	    });
 	 })
   });
   
   $(document).on("click", '.delete-clear', function(event){
		 id=$(this).attr("data-id");
		 $("#sim_id").val(id);
		 swal({
			 	title: "Are you sure?",
				text: "Do you want activate the SIM",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){
					  //console.log("id "+$("#vehicle_data_id").val());	
						 $.ajax({
							 url: "<?=base_url()?>/Sim/sim_active",
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
										 text:"SIM Activated successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										$("#change-status_"+id).html('Ready To Use');									
 										$("#dlt-add_"+id).show();
 										$("#dlt-clear_"+id).hide();
										 						   					
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
			     url: "<?=base_url()?>/Sim/sim_deactive", 
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
									 url: "<?=base_url()?>/Sim/sim_unlinkanddeactivate", 
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
												 text:"SIM unlinked and Deactivated successfully" ,
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
                             text:"SIM Deactivated Successfully" ,
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
			
	 });
 </script>

</body>
</html>

