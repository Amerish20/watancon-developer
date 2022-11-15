  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Users</h4>
      </div>
      
      <form class="cmxform" enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="commentForm" autocomplete="false" method="post" action="">
 
       <div class="modal-body" >
       <div class="col-md-12">
          <div class="col-md-12" >
            <label>Name</label> <input type="text" name="name" id="name" class="form-control" placeholder=" Name" required>
            <label>User Name</label> <input type="text" name="username" value="" autocomplete="user names" id="username" class="form-control" placeholder="user Name" class="username" required>
            <span id="name_error1" class="collapse" style="color:#F00;">User Name Already existed</span>
            <label>Password</label> <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <label>User Groups</label>
            
            
            <select name="group" class="selectpicker form-control" id="group" data-live-search="true" required >
             <option>select</option>
             <?php foreach($user_groups as $user_key=>$user_group){?>
             <option value="<?=$user_group['id']?>"><?=$user_group['name']?></option>
             <?php }?>
           </select>
 
          
             <label>Status</label>
            <select name="status"  id="status" class="selectpicker form-control" data-live-search="true" required>
             <option> select</option>
              <option value="1">Active</option>
              <option value="0">In active</option>
             </select>
         
               </div>    
       </div>
       </div>
      <div class="modal-footer" >
      
         <input type="hidden" name="id" id="user_data_id" value="">
        <button type="submit" class="btn btn-info" id="user_insert" >Insert</button>
        <button type="submit" class="btn btn-info collapse" id="user_update"  >Update</button>
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
      <table id="example" class="table table-striped table-bordered display nowrap" width="100%">
      
             <thead style="display: table-header-group;">
             <tr class="header">
                <th>Name</th>
               <th>User Name</th>
               <th>Password</th>
                <th>User group</th>
               <th>Status</th>
                 <th>Created</th>
                <th>Modified</th>
               <td> Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($user_fulldata as $user_key=>$user_data){
			  ?>
             <tr>
               <td><?=$user_data['name']?></td>
               <td><?=$user_data['user_name']?></td>
               <td>******</td>
               <td><?=$user_data['group_name']?></td>
               <td id="change-status_<?=$user_data['id']?>"><?=$user_data['status']=="1"?"Active":"In Active";?></td>
                <td><?=$user_data['created']?></td>
               <td><?=$user_data['modified']?></td>
               <td>
                
               <a class="btn user_edit"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$user_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
                
                <?php if($user_data['status']!=0){ 
				$collapse1="collapse";
				$collapse="";				
				}else{
					$collapse1="";
				   $collapse="collapse";
				}?>
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$user_data['id']?>" style="color: #333" data-toggle="tooltip" title="Deactive User" data-id="<?=$user_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                 
                <a id="dlt-clear_<?=$user_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Activate User" data-id="<?=$user_data['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
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
		
		$("#username").prop("readonly", true);
	  
		 
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
     $('#commentForm').validate({ // initialize the plugin
        rules: {
            group: {
                selectcheck: true
            },
			status: {
                selectcheck: true
            },
			 
        }
    });
	jQuery.validator.addMethod('selectcheck', function (value) {
               return (value != 'select');
         }, "This field is required");
		 
		 
    $(".selectpicker").change(function(){
	   $("#commentForm").valid();
   });
   
	 
      $("#user_insert").click(function(e){
		  
		   e.preventDefault();
		   
   	     if($("#commentForm").valid()){
			 $("#user_insert").attr("disabled", "disabled");
  	        if(typeof FormData !== 'undefined') {
 			  var formData = new FormData( $("#commentForm")[0] );
			  $.ajax({
			       url: "<?=base_url()?>User/user_insert", 
			       data:formData,
			       method: "POST",
				   async : false,
                   cache : false,
                   contentType : false,
                   processData : false,
			       success: function(result){
					   $("#user_insert").removeAttr("disabled");
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
                             text:"User created successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
						   url=  "<?php echo  base_url(); ?>User";
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
		 
		    $("#user_insert").removeAttr("disabled");
		 	//$("#commentForm").val('');
			$('#commentForm').selectpicker("deselectAll", false).selectpicker("refresh");
		 	$("input").removeClass("error");
		 	$(".error").remove();
			$('.selectpicker').selectpicker('');
  	        $("#user_insert").removeClass("collapse");
			$("#icon").show();
	        $("#user_update").addClass("collapse");
			$("#name_error1").addClass("collapse");
			$("#name_error1").removeClass("error");
			$("#user_data_id").val("");
			$('#username').val("");
			$("#commentForm")[0].reset();
			$("#username").prop("readonly", false);
	 });
	 
	  //checking the Group Name exist or not
	  
 	  
	  
	  
 $(document).on("input", '#username', function (event) {
	 
	 
 	 var username=$(this).val();
	 var user_id=$("#user_data_id").val();
	 if(username!=""){
		 console.log(username);
		 console.log("inputing the data");
		 $.ajax({
			 url: "<?=base_url()?>User/username_check", 
			 data:{username:username,user_id:user_id},
			 method: "POST",
			 success: function(result){
				 var data = $.parseJSON(result); 
				 //console.log(result);
				 if(data>0){
					 
					  $("#name_error1").removeClass("collapse");
					  $("#name_error1").addClass("error");
					  $("#user_insert").prop("disabled",true);
				 }else{
					  $("#name_error1").addClass("collapse");
					   $("#name_error1").removeClass("error");
					  $("#user_insert").prop("disabled",false);
				 }
			 }
				 
		 });
	 }else{
		 $("#name_error1").addClass("collapse");
		 $("#name_error1").removeClass("error");
		 $("#user_insert").prop("disabled",false);
		 
	 }
	 
 });
 
	 $(document).on("click", '#user_update', function (e) {
 		 e.preventDefault();
   	     if($("#commentForm").valid()){
			 $("#user_update").attr("disabled", "disabled");
  	        if(typeof FormData !== 'undefined') {
				
 			  var formData = new FormData( $("#commentForm")[0] );
			  
 		        swal({
                      title: "Are you sure?",
                      text: "Do you really want to update the user data?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                }).then((willUpdate) => {
					
 			       if(willUpdate){
					   
  		              if($("#commentForm").valid()){
 			              $.ajax({
			                  url: "<?=base_url()?>User/user_updation",  
			                  data:formData,
			                  method: "POST",
				              async : false,
                              cache : false,
                              contentType : false,
                              processData : false,
			                  success: function(result){
								  $("#user_update").removeAttr("disabled");
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
                                     text:"User data Updated successfully" ,
                                     icon: "success",
                                     button: "ok",
                                  }).then(function(){
						             url=  "<?=base_url(); ?>User";
						             window.location.href = url;
					              });
					            }
 			                  }
	                      });
 		              }
		           }else{
					   $("#user_update").removeAttr("disabled");
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
				text: "Do you want to activate User",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){
					  //console.log("id "+$("#vehicle_data_id").val());	
						 $.ajax({
							 url: "<?=base_url()?>/User/user_active",
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
										 text:"User Activated successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										//$("#change-status_"+id).html('Active');
										//$("#dlt-add_"+id).show();
										//$("#dlt-clear_"+id).hide();
										url=  "<?php echo  base_url(); ?>User";
						   				window.location.href = url;						   					
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
                      text: "Do you want to Deactivate User?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
         }).then((willUpdate) => {
			 
			 if(willUpdate){		 
 				
			//console.log("id "+$("#vehicle_data_id").val());
			$.ajax({
			     url: "<?=base_url()?>/User/user_deletion", 
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
                             text:"User Deactivated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
							url=  "<?php echo  base_url(); ?>User";
						    window.location.href = url;
							//$("#change-status_"+id).html('In Active');
							//$("#dlt-clear_"+id).show();
							//$("#dlt-add_"+id).hide();												
						});
						
					 }
 			     }
	         });	    
		  }
		});		
			
	 });
	 
	 
 	 $(document).on("click", '.user_edit', function (event) {
 		 $("#username").prop("readonly", false);
		 $("#name_error1").addClass("collapse");
		 $("#name_error1").removeClass("error");;
   		  id=$(this).attr("data-id");
		  $("#user_data_id").val(id);
		   //resetform();
		  
     		  $.ajax({
			     url: "<?=base_url()?>User/selecting", 
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
							 if(index=="group"){ 
 							    $('select[name=group]').val(pvalue);	
								 							
   							 }
							 if(index=="status"){
								$('select[name=status]').val(pvalue);
 							 }
   							    $("#"+index).val(pvalue);
  						 });
						  $('.selectpicker').selectpicker('refresh');
  						 $("#user_update").removeClass("collapse");
						 $("#user_update").removeAttr("disabled");
						 $("#user_insert").addClass("collapse");
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