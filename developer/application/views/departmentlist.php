 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Vehicle Group</h4>
      </div>
      
      <form class="cmxform" enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="commentForm"  method="post" action="">
 
       <div class="modal-body" >
       <div class="col-md-12">
          <div class="col-md-12" >
            <label>Vehicle Group</label> <input type="text" name="name" id="name" class="form-control" placeholder="Vehicle Group Name" required>
         <span id="name_error1" class="collapse" style="color:#F00;">Vehicle Group Already existed</span>
               </div>    
       </div>
       </div>
      <div class="modal-footer" >
      
         <input type="hidden" name="id" id="group_data_id" value="">
        <button type="submit" class="btn btn-info" id="group_insert" >Insert</button>
        <button type="submit" class="btn btn-info collapse" id="group_update"  >Update</button>
      </div>
       </form>
    </div>
     </div>
   </div> 
   <div class="custom-width">  
   <div class="card dark-shadow">
   <div class="card-body">
     <div id="table_container">    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a><a id="add"><i class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></i></a></div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap" >
       
             <thead style="display: table-header-group;">
             <tr class="header">
                <th>Vehicle Group</th>
                 <th>Created</th>
                <th>Modified</th>
               <td> Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($departmentfulldata as $department_key=>$department_data){
			  ?>
             <tr>
               <td><?=$department_data['name']?></td>
                <td><?=$department_data['created']?></td>
               <td><?=$department_data['modified']?></td>
               <td>
               
               <a class="btn department_edit"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$department_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
                
                <?php if($department_data['status']!=0){ 
				$collapse1="collapse";
				$collapse="";				
				}else{
					$collapse1="";
				   $collapse="collapse";
				}?>
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$department_data['id']?>" style="color: #333" data-toggle="tooltip" title="Deactive Department" data-id="<?=$department_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                 
                <a id="dlt-clear_<?=$department_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Activate Department" data-id="<?=$department_data['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
              </td>
             </tr>
              <?php }?>
          </tbody>
         </table>
         </div>
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
				"searching": true
			});			
 			
 
  	/*data table end*/ 
     $('#commentForm').validate();
	 
      $("#group_insert").click(function(e){
		   e.preventDefault();
   	     if($("#commentForm").valid()){
			 $("#group_insert").attr("disabled", "disabled");
  	        if(typeof FormData !== 'undefined') {
				
 			  var formData = new FormData( $("#commentForm")[0] );
			  $.ajax({
			       url: "<?=base_url()?>/Department/department_insert", 
			       data:formData,
			       method: "POST",
				   async : false,
                   cache : false,
                   contentType : false,
                   processData : false,
			       success: function(result){
					$("#group_insert").removeAttr("disabled");
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
                             text:"Department created successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
						   url=  "<?php echo  base_url(); ?>department";
						   window.location.href = url;
					    });
					  }
 					 
				   }
			  });
          		 
		    }
		  else {
              alert("Your Browser Don't support FormData API! Use IE 10 or Above!");
          }  
 		}
  	 });
	 
	 $(document).on("click", '.glyphicon-filter', function (event) {		 
        $('#example_filter').toggle(); 
		
	 });
	 $(document).on("click", '#add', function (event) {
		   $("#name-error").remove();
		   $("#name").removeClass("error");
		   $("#group_data_id").val("");
 	        $("#group_insert").removeClass("collapse");
			$("#group_insert").removeAttr("disabled");
			$("#icon").show();
	        $("#group_update").addClass("collapse");
			$("#name_error1").addClass("collapse");
			$("#name_error1").removeClass("error");
			$("#commentForm")[0].reset();
	 });
	 //checking the Group Name exist or not
 $(document).on("input", '#name', function (event) {
	 var id= $("#group_data_id").val()!=""?$("#group_data_id").val():"";
	 
 	 var dprt_name=$(this).val();
	 $.ajax({
		 url: "<?=base_url()?>Department/departmentname_check", 
		 data:{id:id,dprt_name:dprt_name},
		 method: "POST",
		 success: function(result){
 			 var data = $.parseJSON(result); 
			 
			 if(data>0){
  				  $("#name_error1").removeClass("collapse");
				  $("#name_error1").addClass("error");
				  $("#group_insert").prop("disabled",true);
				  $("#group_update").prop("disabled",true);
  			 }else{
				  $("#name_error1").addClass("collapse");
				   $("#name_error1").removeClass("error");
				  $("#group_insert").prop("disabled",false);
				  $("#group_update").prop("disabled",false);
			 }
 		 }
			 
	 });
 });
	 $(document).on("click", '#group_update', function (e) {
 		 e.preventDefault();
		 
   	     if($("#commentForm").valid()){
			 $("#group_update").attr("disabled", "disabled");
  	        if(typeof FormData !== 'undefined') {
				
 			  var formData = new FormData( $("#commentForm")[0] );
			  
 		        swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the Department data?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                }).then((willUpdate) => {
					
 			       if(willUpdate){
					   
  		              if($("#commentForm").valid()){
 			              $.ajax({
			                  url: "<?=base_url()?>Department/department_updation",  
			                  data:formData,
			                  method: "POST",
				              async : false,
                              cache : false,
                              contentType : false,
                              processData : false,
			                  success: function(result){
								$("#group_update").removeAttr("disabled");
   					           var data = $.parseJSON(result); 
 					             if(data.error_flag=="1"){
						           swal({
                                     text: data.message,
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
                                     text:"Department data Updated successfully" ,
                                     icon: "success",
                                     button: "ok",
                                  }).then(function(){
						             url=  "<?php echo  base_url(); ?>department";
						             window.location.href = url;
					              });
					            }
 			                  }
	                      });
 		              }
		           }else{
					   $("#group_update").removeAttr("disabled");
					   }
		        });
			}
		 }
 	 });	 
	 
	 $(document).on("click", '#img_close', function (event) {
 		  $("#icon").show();
		  $(".img-wrap").addClass("collapse");
 		 
	 });
 	 
	 $(document).on("click", '.delete-clear', function(event){
		 id=$(this).attr("data-id");
		 swal({
			 	title: "Are you sure?",
				text: "Do you want activate vehicle Department",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){
					  //console.log("id "+$("#vehicle_data_id").val());	
						 $.ajax({
							 url: "<?=base_url()?>/Department/vehicle_department_active",
							 data: {id:id},
							 method: "POST",
							 success: function(result){
							 //console.log(result);											
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
										 text:"Vehicle Department Activated successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										url=  "<?php echo  base_url(); ?>department";
						   				window.location.href = url;
										//$("#dlt-add_"+id).show();										
										//$("#dlt-clear_"+id).hide();														   					
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
                      text: "Do you want to Deactivate vehicle Department?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
         }).then((willUpdate) => {
			 
			 if(willUpdate){		 
 				
			//console.log("id "+$("#vehicle_data_id").val());
			$.ajax({
			     url: "<?=base_url()?>/Department/vehicle_department_deletion", 
			     data:{id:id},
			     method: "POST",
			     success: function(result){					 
					 //console.log(result);					 			
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
                             text:"Vehicle Department Deactivated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
							url=  "<?php echo  base_url(); ?>department";
						    window.location.href = url;
							//$("#dlt-clear_"+id).show();
							//$("#dlt-add_"+id).hide();												
						});
						
					 }
 			     }
	         });	    
		  }
		});		
			
	 });
	 
	 $(document).on("click", '.department_edit', function (event) {
   		  id=$(this).attr("data-id");
		  $("#group_data_id").val(id);
		  $("#name-error").remove();
		  $("#name").removeClass("error");
		 $("#name_error1").addClass("collapse");
		  
   		  $.ajax({
			     url: "<?=base_url()?>department/selecting", 
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
   							     $("#"+index).val(pvalue);
  						 });
						 $("#group_update").removeAttr("disabled");
  						 $("#group_update").removeClass("collapse");
						 $("#group_insert").addClass("collapse");
						 $("#name_error1").addClass("collapse");
						 $("#name_error1").removeClass("error");
 						 $("#myModal").modal('show');
 					 }
			     }
	    });
 	 })
	 
	 
	 
	 
	 
  });
 </script>

</body>
</html>

