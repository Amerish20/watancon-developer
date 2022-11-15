 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Customer Details</h4>
      </div>
      
      <form class="cmxform" enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="commentForm"  method="post" action="">
 
       <div class="modal-body" >
       <div class="col-md-12">
       		 <div class="col-md-6" >
            <label>Customer Code</label> <input type="text" name="cust_code" id="cust_code" class="form-control" placeholder="Customer Code" required>        
               </div> 
          <div class="col-md-6" >
            <label>Customer Name</label> <input type="text" name="cust_name" id="cust_name" class="form-control" placeholder="Customer Name" required>
         <span id="name_error1" class="collapse" style="color:#F00;">Customer Name Already existed</span>
               </div>    
       </div>
       </div>
      <div class="modal-footer" >
      
         <input type="hidden" name="id" id="customer_data_id" value="">
        <button type="submit" class="btn btn-info" id="customer_insert" >Insert</button>
        <button type="submit" class="btn btn-info collapse" id="customer_update"  >Update</button>
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
             	<th>S.No</th>
             	<th>Customer Code</th>
                <th>Customer Name</th>
                 <th>Created</th>
                <th>Modified</th>
               <td> Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($customerfulldata as $customer_key=>$customer_data){
			  ?>
             <tr>
             	<td></td>
             	<td><?=$customer_data['cust_code']?></td>
               <td><?=$customer_data['cust_name']?></td>
                <td><?=$customer_data['created']?></td>
               <td><?=$customer_data['modified']?></td>
               <td>
               
               <a class="btn customer_edit"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$customer_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
                
                <?php if($customer_data['status']!=0){ 
				$collapse1="collapse";
				$collapse="";				
				}else{
					$collapse1="";
				   $collapse="collapse";
				}?>
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$customer_data['id']?>" style="color: #333" data-toggle="tooltip" title="Deactive Customer" data-id="<?=$customer_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                 
                <a id="dlt-clear_<?=$customer_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Activate Customer" data-id="<?=$customer_data['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
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
	 var t = $('#example').DataTable( {
	           "columnDefs": [ {
	              "searchable": true,
				  "autoWidth": true,
				  "responsive": true,
	              "orderable": false,
	              "targets": 0
	            } ],
	          "order": [[ 1, 'asc' ]]
             });
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
 	/*data table end*/ 
     $('#commentForm').validate();
	 
      $("#customer_insert").click(function(e){

		 e.preventDefault();
   	     if($("#commentForm").valid()){

			$("#customer_insert").attr("disabled", "disabled");

  	        if(typeof FormData !== 'undefined') {

  	        	swal({
                      title: "Are you sure?",
                      text: "Do you really want to insert this customer?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
               }).then((willUpdate) => {			 
		          if(willUpdate){	
		          	  var formData = new FormData( $("#commentForm")[0] );
					  $.ajax({
					       url: "<?=base_url()?>/Customermaster/customer_insert", 
					       data:formData,
					       method: "POST",
						   async : false,
		                   cache : false,
		                   contentType : false,
		                   processData : false,
					       success: function(result){
							$("#customer_insert").removeAttr("disabled");
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
		                             text:"Customer created successfully" ,
		                             icon: "success",
		                             button: "ok",
		                        }).then(function(){
								   url=  "<?php echo  base_url(); ?>customermaster";
								   window.location.href = url;
							    });
							  }
		 					 
						   }
					  });
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
		    $("#cust_name").removeClass("error");
		    $("#cust_code-error").remove();
		    $("#cust_code").removeClass("error");
		    $("#customer_data_id").val("");
 	        $("#customer_insert").removeClass("collapse");
			$("#customer_insert").removeAttr("disabled");
			$("#icon").show();
	        $("#customer_update").addClass("collapse");
			$("#name_error1").addClass("collapse");
			$("#name_error1").removeClass("error");
			$("#commentForm")[0].reset();
	 });
	 //checking the Group Name exist or not
 $(document).on("input", '#cust_name', function (event) {
	 var id= $("#customer_data_id").val()!=""?$("#customer_data_id").val():"";
	 
 	 var cust_name=$(this).val();
	 $.ajax({
		 url: "<?=base_url()?>/Customermaster/customername_check", 
		 data:{id:id,cust_name:cust_name},
		 method: "POST",
		 success: function(result){
 			 var data = $.parseJSON(result); 
			 
			 if(data>0){
  				  $("#name_error1").removeClass("collapse");
				  $("#name_error1").addClass("error");
				  $("#customer_insert").prop("disabled",true);
				  $("#customer_update").prop("disabled",true);
  			 }else{
				  $("#name_error1").addClass("collapse");
				   $("#name_error1").removeClass("error");
				  $("#customer_insert").prop("disabled",false);
				  $("#customer_update").prop("disabled",false);
			 }
 		 }
			 
	 });
 });
	 $(document).on("click", '#customer_update', function (e) {
 		 e.preventDefault();
		 
   	     if($("#commentForm").valid()){
			 $("#customer_update").attr("disabled", "disabled");
  	        if(typeof FormData !== 'undefined') {
				
 			  var formData = new FormData( $("#commentForm")[0] );
			  
 		        swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update this Customer details?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                }).then((willUpdate) => {
					
 			       if(willUpdate){
					   
  		              if($("#commentForm").valid()){
 			              $.ajax({
			                  url: "<?=base_url()?>/Customermaster/customer_updation",  
			                  data:formData,
			                  method: "POST",
				              async : false,
                              cache : false,
                              contentType : false,
                              processData : false,
			                  success: function(result){
								$("#customer_update").removeAttr("disabled");
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
                                     text:"Customer data Updated successfully" ,
                                     icon: "success",
                                     button: "ok",
                                  }).then(function(){
						             url=  "<?php echo  base_url(); ?>Customermaster";
						             window.location.href = url;
					              });
					            }
 			                  }
	                      });
 		              }
		           }else{
					   $("#customer_update").removeAttr("disabled");
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
				text: "Do you want activate this customer?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){
					   
						 $.ajax({
							 url: "<?=base_url()?>/Customermaster/vehicle_department_active",
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
										 text:"Customer Activated successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										url=  "<?php echo  base_url(); ?>Customermaster";
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
                      text: "Do you want to Deactivate This customer?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
         }).then((willUpdate) => {
			 
			 if(willUpdate){		 
 				
			 
			$.ajax({
			     url: "<?=base_url()?>/Customermaster/vehicle_department_deletion", 
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
                             text:"Customer Deactivated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
							url=  "<?php echo  base_url(); ?>Customermaster";
						    window.location.href = url;
							 										
						});
						
					 }
 			     }
	         });	    
		  }
		});		
			
	 });
	 
	 $(document).on("click", '.customer_edit', function (event) {
   		  id=$(this).attr("data-id");
		  console.log(id);
		  $("#customer_data_id").val(id);
		  $("#name-error").remove();
		  $("#cust_name").removeClass("error");
		 $("#name_error1").addClass("collapse");
		  
   		  $.ajax({
			     url: "<?=base_url()?>/customermaster/selecting", 
			     data:{id:id},
			      method: "POST",
			     success: function(response){
 					 var data = $.parseJSON(response); 
					 console.log(data);
 					 if(data.error_flag=="1"){
						 swal({
                                 text: data.message,
                                 icon: "error",
                                 button: "ok",
                          });
					 }else{
  						 $.each(data.information, function(index, pvalue) {
   							     $("#"+index).val(pvalue);
								 console.log(pvalue);
  						 });
						 $("#customer_update").removeAttr("disabled");
  						 $("#customer_update").removeClass("collapse");
						 $("#customer_insert").addClass("collapse");
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

