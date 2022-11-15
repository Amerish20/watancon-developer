<link rel="stylesheet" href="<?=base_url()?>lib/css/Toggle_button.css">
<style>.inline-blo{display:inline-block}</style>



 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Groups</h4>
      </div>
 
       
       <div class="col-md-12">
         <form class="cmxform" enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="commentForm"  method="post" action="">
         <div class="modal-body" >
          <div class="col-md-5" >          
            <label>Group Name</label> <input type="text" name="name" id="name" class="form-control" placeholder="Group Name" required>
            <span id="name_error1" class="collapse" style="color:#F00;">Group Name Already existed</span>
            <label>Maintanance</label> 
             
             
              <input type="number" name="maintanance_km" id="maintanance_km" class="form-control form-control-sm" placeholder="Maintanance KM">
              
               <select name="Group" class="selectpicker themes form-control-sm " id="Group" data-live-search="true" required>
                <option>select Month</option>
                 <?php 
				  
				 for($month="1";$month<25;$month++){?>
                   <option  value="<?=$month?>"><?php echo $month==1?$month ." motnh":$month." months";?></option>
              <?php } ?>
           </select>
           
           
           
            <label>Email Status</label>
             <div class="wrapper">
			 
  <input id="Mail_status" name="Mail_status" type="checkbox" value="1" /><label class="toggle" for="Mail_status"><span class="toggle--handler"></span></label>
			</div>
            
            </div>
            
      <div class="col-md-4" >
             
            
             <label>Moving Icon</label> 
             <input type="File" name="run" id="run" class="icon_upload" value="" required="required" >
             
              <div id="imagerun" class="img-wrap collapse">
                  <input type="hidden"  value="" id="moveimg_url">                  
                  <img  id="moveicon_image" src="" style="float:left">
                  <span id="img_close" class="close align img_close" data-id="run" title="Delete Icon">&times;</span>
               </div>
             <label>Idle Icon</label> 
             <input type="File" class="icon_upload" name="idle" id="idle" value="" required="required"  >
             
              <div id="imageidle"  class="img-wrap collapse" >
                  <input type="hidden" value="" class="icon" id="idleimg_url">                  
                  <img  id="idleicon_image" src="" style="float:left">
                  <span id="img_close" class="close align img_close" data-id="idle" title="Delete Icon">&times;</span>
               </div>
             <label>Stop Icon</label> 
              
             <input type="File" name="stop" class="icon_upload" id="stop" value="" required="required"  >
              <div id="imagestop"  class="img-wrap collapse" >
                  <input type="hidden" value="" id="stopimg_url">                  
                  <img  id="stopicon_image" src="" style="float:left">
                  <span id="img_close" class="close align img_close" data-id="stop" title="Delete Icon">&times;</span>
               </div>
            
        </div>
        <div class="col-md-3" >
        	<a class="btn btn-primary top-margin" data-toggle="modal" id="running-images" data-target="#myModal-sample">Running Icon Samples</a>
            <a class="btn btn-primary top-margin" data-toggle="modal" id="idle-images" data-target="#myModal-sample">Idle Icon Samples</a>
            <a class="btn btn-primary top-margin" data-toggle="modal" id="stop-images" data-target="#myModal-sample">Stop Icon Samples</a>
        </div>
        <div class="clearfix"></div>
               </div>    
       
       
      <div class="modal-footer" >
      
         <input type="hidden" name="id" id="group_data_id" value="">
        <button type="submit" class="btn btn-info" id="group_insert" >Insert</button>
        <button type="submit" class="btn btn-info collapse" id="group_update"  >Update</button>
      </div>
      
       </form>       
    </div>
    <div class="clearfix"></div>    
     </div>
   </div> 
   </div> 
   
   <!--sample model-->
<div id="myModal-sample" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
     <div class="modal-content" style="min-height:370px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Sample Vehicle Icons</h4>
      </div> 
       <div class="row collapse" id="runningicons">
        	<?php
                        foreach($running_images as $image){?>
                        <div class="col-md-2 col-sm-3 col-xs-4 top-margin" style="height:65px"> 
                        <center> 
                                <img class="vehicle_image" src="<?php echo base_url().'lib/images/vehicle_icons/running/'.$image;?>" class="img-responsive" />
                                <span></span>
                            </center>
                        </div>
            <?php }?>
       </div>
       
       <div class="row collapse" id="idleicons">
        	<?php
                        foreach($idle_images as $image){?>
                        <div class="col-md-2 col-sm-3 col-xs-4 top-margin" style="height:65px"> 
                        <center> 
                                <img class="vehicle_image top-margin" src="<?php echo base_url().'lib/images/vehicle_icons/idle/'.$image;?>" class="img-responsive">
                                <span></span>
                            </center>
                        </div>
            <?php }?>
       </div>
       <!--sample model end-->
       <div id="stopicons" class="row collapse" >
        	<?php
                        foreach($stop_images as $image){?>
                        <div class="col-md-2 col-sm-3 col-xs-4 top-margin" style="height:65px"> 
                        <center> 
                                <img class="vehicle_image top-margin" src="<?php echo base_url().'lib/images/vehicle_icons/stop/'.$image;?>" class="img-responsive">
                                <span></span>
                           </center>
                        </div>
            <?php }?>
       </div>
       
      </div>
     </div>
 </div>
<!--sample model end-->
   
      <div class="custom-width">  
   <div class="card dark-shadow">
	<div class="card-body">
     <div id="table_container">
    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a><a id="add"><i class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></i></a> </div></div>
	    <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap" >       
             <thead style="display: table-header-group;">
             <tr class="header">
                <th>Name</th>
                <th>Moving Icon</th>
                <th>Idle Icon</th>
                <th>Stop Icon</th>
                <th>Maintanance KM</th>
                <th>Maintanance Month</th>
                <th>Mail Status</th>
                <th>Created</th>
                <th>Modified</th>
               <td > Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($groupfulldata as $groupkey=>$group_data){
			  ?>
             <tr>
               <td><?=$group_data['name']?></td>
               <td style="text-align:center"><?=$group_data['move_icon']!=""?"<img src=".base_url()."lib/images/group_icons/".$group_data['move_icon'].">":"";?></td>
               <td style="text-align:center"><?=$group_data['idle_icon']!=""?"<img src=".base_url()."lib/images/group_icons/".$group_data['idle_icon'].">":"";?></td>
               <td style="text-align:center"><?=$group_data['stop_icon']!=""?"<img src=".base_url()."lib/images/group_icons/".$group_data['stop_icon'].">":"";?></td>
                <td><?=$group_data['maintanance_km']?></td>
                <td><?=$group_data['mail_status']=="0"?"disabled":"enabled";?></td>
               <td><?=$group_data['created']?></td>
               <td><?=$group_data['modified']?></td>
               <td><?=$group_data['maintanance_month']!=""?$group_data['maintanance_month']>1?$maintanance_month." months":$maintanance_month." month":"";?></td>
                <td>        
               <a class="btn group_edit"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$group_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>  
                
                <?php if($group_data['status']!=0){ 
				$collapse1="collapse";
				$collapse="";				
				}else{
					$collapse1="";
				   $collapse="collapse";
				}?>
                             
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$group_data['id']?>"  style="color: #333" data-toggle="tooltip" title="Deactive Vehicle Group" data-id="<?=$group_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                <a id="dlt-clear_<?=$group_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Activate Vehicle Group" data-id="<?=$group_data['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
              </td>
             </tr>
              <?php }?>
          </tbody>
         </table>
         
         
 
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
		
		
 			$('#example tfoot th').each( function () {
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
			});
			
 			// DataTable
			var table = $('#example').DataTable({
				"responsive": true,
				"autoWidth": true,
 				"orderCellsTop": true,
				"searching": true,
				"columnDefs": [
					{ "targets": [1,2,3,8], "orderable": false }
				],
			});			
 			
 
  	/*data table end*/ 
     $('#commentForm').validate();
	 
      $("#group_insert").click(function(e){
		   e.preventDefault();
		   $("#group_insert").attr("disabled", "disabled");
		   
   	     if($("#commentForm").valid()){
  	        if(typeof FormData !== 'undefined') {
 			  var formData = new FormData( $("#commentForm")[0] );
			  $.ajax({
			       url: "<?=base_url()?>/group/group_insert", 
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
                             text:"Group created successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
						   url=  "<?php echo  base_url(); ?>group";
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
	 
     function resetform(){
		    $(".icon").removeClass("error");
		    $(".form-control").removeClass("error");
			$(".error").remove();
	 }
	 
	 $(document).on("click", '.glyphicon-filter', function (event) {		 
        $('#example_filter').toggle(); 
		
	 });
	 
	 $(document).on("click", '#running-images', function () {
         $("#runningicons").removeClass("collapse");
 		$("#idleicons").addClass("collapse");
 		$("#stopicons").addClass("collapse");	
 	 });
	 
	 $(document).on("click", '#idle-images', function () {
		 		 
        $("#runningicons").addClass("collapse");
		$("#idleicons").removeClass("collapse");
		$("#stopicons").addClass("collapse");		
	 });
	 
	 $(document).on("click", '#stop-images', function () {			 
        $("#runningicons").addClass("collapse");
		$("#idleicons").addClass("collapse");
		$("#stopicons").removeClass("collapse");		
	 });
	 
	 $(document).on("click", '.vehicle_image', function () {
		 //var selectedImgsArr = [];
		 //selectedImgsArr.push($(this).attr("id"));
		 //alert($(this).attr('src'));
		 var img=$( this ).attr("src");
		 
		 
		// console.log(img);
		 $("#run").val(img);
		 //$("#run").addClass("valid");
		// $("#run").removeClass("error");
		 			 
        //$( this ).click( function() { console.log( "You have clicked this before!" ); } );		
	 });
	 
	 
	 $(document).on("click", '#add', function (event) {
		    
 	        $("#group_insert").removeClass("collapse");
			$(".icon").show();
 			$("#Mail_status").attr('checked', false);
	        $("#group_update").addClass("collapse");
			$("#group_update").removeClass("inline-blo");
			$("#name_error1").addClass("collapse");
			$("#name_error1").removeClass("error");
			$("#commentForm")[0].reset();
			$(".img-wrap").addClass("collapse");
			$(".img-wrap").removeClass("inline-blo");
			resetform();
	 });
	 
	
	
	
	
$('.icon_upload').change(function(){
 
 	if(($(this).next()).is( "span" )){
		$(this).next().remove();
	}
	
	
 	      var current=$(this);
         var ext = ($(this).val().split('.').pop().toLowerCase());
		 var sizee = $(this)[0].files[0].size; //file size in bytes
         sizee =  Math.ceil(sizee / 1024); 
		 var _URL = window.URL || window.webkitURL;  
		 var file = $(this)[0].files[0];
		 img = new Image();
 		 img.src = _URL.createObjectURL(file);
		 var error_message="";
		 
		 if($.inArray(ext, ['jpg','jpeg','png','gif']) == -1) {
				 error_message="wrong format";
          }else  if (sizee> 100) { 
			     error_message="Size should less than 100KB";
		 }
		 
		 
 		 if(error_message!=""){
			   console.log("-----"+error_message+"----");
 				$("<span style='color:red;'>"+error_message +"</span>").insertAfter($(this));
				$("#group_insert").attr("disabled", "disabled");
				
	     }else{
				$("#group_insert").removeAttr("disabled");
				$(current).next().remove();
		 }
		 
		 
		 
		 img.onload = function() {
			 
            imgwidth = this.width;
            imgheight = this.height;
			
 			if((imgwidth>100 || imgheight>100) && error_message=="") {
				 error_message="Resolution should less than 100X100";
			} else{
				  error_message="";
			}
			
			if(error_message!=""){
 				$("<span style='color:red;'>"+error_message +"</span>").insertAfter(current);
				$("#group_insert").attr("disabled", "disabled");
			}
 			
		 };
     
}); 
	 
	 
	 
	 
	  //checking the Group Name exist or not
 $(document).on("change", '#name', function (event) {
 	 var group_name=$(this).val();
	 $.ajax({
		 url: "<?=base_url()?>Group/groupname_check", 
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
	 $(document).on("click", '#group_update', function (e) {
 		 e.preventDefault();
		 
   	     if($("#commentForm").valid()){
  	        if(typeof FormData !== 'undefined') {
  			  var formData = new FormData( $("#commentForm")[0] );
			  
			   
  		        swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the vehicle group data?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                }).then((willUpdate) => {
					
 			       if(willUpdate){
					   
  		              if($("#commentForm").valid()){
 			              $.ajax({
			                  url: "<?=base_url()?>group/group_updation",  
			                  data:formData,
			                  method: "POST",
				              async : false,
                              cache : false,
                              contentType : false,
                              processData : false,
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
                                     text:"Vehicle group data Updated successfully" ,
                                     icon: "success",
                                     button: "ok",
                                  }).then(function(){
						             url=  "<?php echo  base_url(); ?>group";
						             window.location.href = url;
					              });
					            }
 			                  }
	                      });
 		              }
		           }
		        });
			}
		 }
 	 });	 
	 
	 $(document).on("click", '.img_close', function (event) {
		 
		 var current_id=$(this).attr("data-id");
 		  $("#"+current_id).show();
		  $("#image"+current_id).addClass("collapse");
 		 $("#image"+current_id).removeClass("inline-blo");
	 });
	 
/*	 $(document).on("click", '.image-show', function(event){
		 $.ajax({
							 url: "<?=base_url()?>/Group/display_images",							 
							 success: function(result){
								 
								 }
		 	});
		 });*/
	 
 	 $(document).on("click", '.delete-clear', function(event){
		 id=$(this).attr("data-id");
		 swal({
			 	title: "Are you sure?",
				text: "Do you want activate vehicle Group",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){
					  //console.log("id "+$("#vehicle_data_id").val());	
						 $.ajax({
							 url: "<?=base_url()?>/Group/vehicle_group_active",
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
										 text:"Vehicle Group Activated successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
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
			     url: "<?=base_url()?>/Group/vehicle_group_deletion", 
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
                             text:"Vehicle Group Deactivated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
							//alert('hi');
							$("#dlt-clear_"+id).show();
							$("#dlt-add_"+id).hide();												
						});
						
					 }
 			     }
	         });	    
		  }
		});		
			
	 });
	 
	 
	 $(document).on("click", '.group_edit', function (event) {
   		  id=$(this).attr("data-id");
		  $("#group_data_id").val(id);
		  resetform();
		  
   		  $.ajax({
			     url: "<?=base_url()?>group/selecting", 
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
							 if(index=="move_icon"){
 								 $("#run").hide();
								 $(".img-wrap").removeClass("collapse");
								 $(".img-wrap").addClass("inline-blo");								 
								 $("#moveicon_image").attr("src","<?=base_url()?>lib/images/group_icons/"+pvalue);
  							 }else if(index=="idle_icon"){
 								 $("#idle").hide();
								 $(".img-wrap").removeClass("collapse");
								  $(".img-wrap").addClass("inline-blo");								 
								 $("#idleicon_image").attr("src","<?=base_url()?>lib/images/group_icons/"+pvalue);
  							 }else if(index=="stop_icon"){
 								 $("#stop").hide();
								 $(".img-wrap").removeClass("collapse");	
								  $(".img-wrap").addClass("inline-blo");							 
								 $("#stopicon_image").attr("src","<?=base_url()?>lib/images/group_icons/"+pvalue);
  							 }else if(index=="mail_status"){
 								 if(pvalue=="1"){
									 $("#Mail_status").attr("checked",true);
								 }else{
 									 console.log("no mail status");
									 $("#Mail_status").attr('checked', false);
								 }
 							 }
							 else{
  							     $("#"+index).val(pvalue);
							 }
							 
 						 });
						 
  						 $("#group_update").removeClass("collapse");
						  $("#group_update").addClass("inline-blo");
						 $("#group_insert").addClass("collapse");
						 $("#group_insert").removeClass("inline-blo");
 						 $("#myModal").modal('show');
 					 }
			     }
	    });
 	 })
	 
	 
	 
	 
	 
  });
 </script>

</body>
</html>

