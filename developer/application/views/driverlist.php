
 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Driver Details</h4>
      </div>
      <form class="cmxform" id="commentForm" method="get" action="">
       <div class="modal-body" >
       <div class="col-md-12">
      <div class="col-md-6" >
          <label>Batch Number</label> <input type="number" name="batch_num" id="batch_num" class="form-control" maxlength="10" placeholder="Batch Number" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" required>
          <span id="name_error1" class="collapse" style="color:#F00;">Batch Number Already existed</span>
          <label>Mobile Number</label><input type="number" minlength="8" maxlength="10" name="mob_num" min="0" id="mob_num" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" placeholder="Mobile Number" required>
      </div>    
      <div class="col-md-6" >
       
           <label>Driver Name</label> <input type="text" onkeypress="return (event.charCode > 64 && 
	event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" name="driver_name" id="driver_name" class="form-control"  placeholder="Driver Name" required>
         </div>
      </div>
       </div>
      <div class="modal-footer" >
        <button type="button" class="btn btn-info" id="driver_insert" >Insert</button>
        <button type="button" class="btn btn-info collapse" id="driver_update" >Update</button>
      </div>
       </form>
    </div>
     </div>
   </div> 
   <div class="custom-width">  
   <div class="card dark-shadow">
   <div class="card-body">
     <div id="table_container">    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a><a id="driver_add"><i class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></i></a></div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap" width="100%">       
             <thead style="display: table-header-group;">
             <tr class="header">
              <th>S.No</th>
              <th>Batch Number</th>
              <th>Driver Name</th>
              <th>Mobile Number</th>
              <th>Status</th>
             <td> Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($driverfulldata as $driverkey=>$driver_data){
			  ?>
            <tr >
              <td></td>
              <td><?=$driver_data['batch_num']?></td>
              <td><?=$driver_data['Name']?></td>
              <td><?=$driver_data['phone']?></td>
               <td id="change-status_<?=$driver_data['id']?>"><?php 
			   if($driver_data['status']=="0"){	
				   print "Driver Not Available";
			   }else if($driver_data['status']=="1"){
				    print "Not Yet Assigned";
				   
			   }else{
				    print "Assigned to ".$driver_data['name'];
			   }
 			   
			   ?></td>
               
              <td>
              <a class="btn edit_driver"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$driver_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
              
                 <?php if($driver_data['status']!=0){ 
				$collapse1="collapse";
				$collapse="";				
				}else{
					$collapse1="";
				   $collapse="collapse";
				}?>
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$driver_data['id']?>" style="color: #333" data-toggle="tooltip" title="Disable the Driver" data-id="<?=$driver_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                 
                <a id="dlt-clear_<?=$driver_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Enable the Driver" data-id="<?=$driver_data['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
               
               </td>
             </tr>
              <?php }?>
          </tbody>
         </table>
         
         <input type="hidden" id="driver_id" value="">
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
			var t = $('#example').DataTable( {
        "columnDefs": [ {
            "searchable": true,
			"autoWidth": true,
			"responsive": true,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
 	/*data table end*/ 
	
	
 	
   	$("#driver_insert").click(function(){
		
  	  if($("#commentForm").valid()){
  		 
		 var batch_num=$("#batch_num").val();
		 var driver_name=$("#driver_name").val();
		 var mob_num=$("#mob_num").val();
		 //var status=$("#status").val();
        		 $.ajax({
			     url: "<?=base_url()?>Driver/driver_insert", 
			     data:{batch_num:batch_num,driver_name:driver_name,mob_num:mob_num},
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
								 text:"Driver details inserted successfully" ,
								 icon: "success",
								 button: "ok",
						  }).then(function(){
							   url=  "<?php echo  base_url(); ?>Driver";
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
	 //checking the batch num exist or not
 $(document).on("input", '#batch_num', function (event) {	 
 	 var batch_num=$(this).val();
	 $.ajax({
		 url: "<?=base_url()?>Driver/batch_num_check", 
		 data:{batch_num:batch_num},
		 method: "POST",
		 success: function(result){
 			 var data = $.parseJSON(result); 
			 
			 if(data>0){
  				  $("#name_error1").removeClass("collapse");
				  $("#name_error1").addClass("error");
				  $("#driver_insert").prop("disabled",true);
  			 }else{
				  $("#name_error1").addClass("collapse");
				   $("#name_error1").removeClass("error");
				  $("#driver_insert").prop("disabled",false);
			 }
 		 }
			 
	 });
 });
 
 	  //restricting to copy all charecters except the numbers
 	  var myInput = document.querySelectorAll("input[type=number]")[0];
	  myInput.addEventListener('paste', function(e) {
	  var pasteData = e.clipboardData.getData('text/plain');
	  if (pasteData.match(/[^0-9]/))
		e.preventDefault();
	  }, false);
 
	 
	 $(document).on("click", '#driver_add', function (event) {
 	        $("#driver_insert").removeClass("collapse");
	        $("#driver_update").addClass("collapse");
			$("#name_error1").addClass("collapse");
			$("#name_error1").removeClass("error");
			$("#commentForm")[0].reset();			
	 });
	 
	 $(document).on("click", '#driver_update', function (event) {
 		 
  		  if($("#commentForm").valid()){
			 swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the Driver details?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
             }).then((willUpdate) => {
		         if (willUpdate) {
				  
				  
				  
 			    var id=$("#driver_id").val(); 		        
		        var batch_num=$("#batch_num").val();
		 		var driver_name=$("#driver_name").val();
				var mob_num=$("#mob_num").val(); 
			
			    $.ajax({
			      url: "<?=base_url()?>/Driver/driver_updation", 
			      data:{id:id,batch_num:batch_num,driver_name:driver_name,mob_num:mob_num},
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
                             text:"Driver details Updated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
						   url=  "<?php echo  base_url(); ?>Driver";
						   window.location.href = url;
					  });
					 }
 			     }
	          });
			  
			  }
			 }); 
			  
 		     }
 		 
	 });	 
	 
	 
	 $(document).on("click", '.edit_driver', function (event) {
   		  id=$(this).attr("data-id");
		  $("#driver_id").val(id);
   		  $.ajax({
			     url: "<?=base_url()?>/Driver/selecting", 
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
						        $("#"+index).val(pvalue);
								console.log(pvalue);
 						 });
 						  
  						  $("#driver_update").removeClass("collapse");
						  $("#driver_insert").addClass("collapse");
 						  $("#myModal").modal('show');
 					 }
			     }
	    });
 	 })
   });
   
   $(document).on("click", '.delete-clear', function(event){
		 id=$(this).attr("data-id");
		 $("#driver_id").val(id);
		 swal({
			 	title: "Are you sure?",
				text: "Do you want to enable the driver",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){
					  //console.log("id "+$("#vehicle_data_id").val());	
						 $.ajax({
							 url: "<?=base_url()?>/Driver/driver_enable",
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
										 text:"Driver enabled successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										$("#change-status_"+id).html('Not Yet Assigned');									
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
                      text: "Do you want to Disable the Driver?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
         }).then((willUpdate) => {
			 
			 if(willUpdate){		 
 				
			//console.log("id "+$("#vehicle_data_id").val());
			$.ajax({
			     url: "<?=base_url()?>/Driver/driver_disable", 
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
                                 confirmButtonText: "Yes, Remove it!",
                                 cancelButtonText: "No, cancel Please!",
                          }).then((willunlink) => {
							  if(willunlink){
								  $.ajax({
									 url: "<?=base_url()?>/Driver/driver_unlinkanddeactivate", 
									 data:{id:id,vehicle_id:data.vehicle_id},
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
												 text:"Driver unlinked and Deactivated successfully" ,
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
                             text:"Driver Deactivated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
 							$("#change-status_"+id).html('Driver Not Available');
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

