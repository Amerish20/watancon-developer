  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">User Access</h4>
      </div>
      <form class="cmxform" enctype="multipart/form-data" accept-charset="utf-8" name="formname" id="commentForm"  method="post" action="">
       <div class="modal-body" >
       <div class="col-md-12">
          <div class="col-md-12" >
          <!-- <div class="checkboxFive">
        <input type="checkbox" value="1" id="checkboxFiveInput" name="" />
        <label for="checkboxFiveInput"></label>
    </div>-->
    
            <label>MASTERS</label>              
               <?php foreach($masters as $masters_key=>$masters_data){?>
               <div class="checkbox">
                                <label >
                <input type="checkbox" name="masters[<?=$masters_data['id']?>]" id="masters_<?=$masters_data['id']?>">
                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
                <span class="title"><?=$masters_data['master']?></span>
                </label>
                </div>
 			   <?php }?>
                <label>Vehicle Group</label>  
               <?php foreach($department as $department_key=>$department_data){?>
               <div class="checkbox">
                                <label >
                <input type="checkbox" name="task[<?=$department_data['id']?>]" id="department_<?=$department_data['id']?>">
				<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
                <span class="title"><?=$department_data['name']?></span>
                </label>
                </div>
 			   <?php }?>
               
               <label>GEOFFENCE </label>  
               <div class="checkbox">
               <label >
               <input type="checkbox" name="geoffence[1]" id="geoffence_1">
               <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
               <span class="title">Geoffence</span>
               </label>
               </div>
               
               <div id="geoffence_group">
                
                <?php foreach($geoffence_groups as $geoffence_groups_key=>$geoffence_groups_data){?>
               <div class="checkbox">
                <label >
                <input type="checkbox" class="g_group" name="g_group[<?=$geoffence_groups_data['id']?>]" id="g_group_<?=$geoffence_groups_data['id']?>">
				<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
                <span class="title"><?=$geoffence_groups_data['Name']?></span>
                </label>
                </div>
 			   <?php }?>
               </div>
               
               <label>GEOFFENCE ACTION </label>  
               <div class="checkbox">
               <label >
               <input type="checkbox" name="Geoffence_creation" id="Geoffence_creation">
               <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
               <span class="title">Geoffence Creation</span>
               </label>
               </div>
               
                 <label>SHIPPING </label>  
               <div class="checkbox">
               <label >
               <input type="checkbox" name="Shipping" id="Shipping">
               <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
               <span class="title">Shipping Status</span>
               </label>
               </div>
               
                 <label>REPORTS</label>  
               <?php foreach($reports as $reports_key=>$reports_data){?>
               <div class="checkbox">
                                <label >
                <input type="checkbox" name="Reports[<?=$reports_data['id']?>]" id="reports_<?=$reports_data['id']?>">
				<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span> 
                <span class="title"><?=$reports_data['report_name']?></span>
                </label>
                </div>
 			   <?php }?>
         
               </div>    
       </div>
       </div>
      <div class="modal-footer" >
      
         <input type="hidden" name="id" id="group_data_id" value="">
        <button type="submit" class="btn btn-info" id="useracess_insert" >Insert</button>
        <button type="submit" class="btn btn-info collapse" id="useracess_update"  >Update</button>
      </div>
       </form>
    </div>
     </div>
   </div> 
   <div class="custom-width">  
   <div class="card dark-shadow">
   <div class="card-body">
     <div id="table_container">    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a></div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap" width="100%">
       
             <thead style="display: table-header-group;">
             <tr class="header">
                <th>Name</th>
                 <th>Created</th>
                <th>Modified</th>
               <td > Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($user_acess as $user_acess_key=>$user_acess_data){
			  ?>
             <tr>
               <td><?=$user_acess_data['groupname']?></td>
                <td><?=$user_acess_data['created']?></td>
               <td><?=$user_acess_data['modified']?></td>
               <td>
                
               <a class="btn useracess_edit"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$user_acess_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
                
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
	 
 	 /*$(document).on("click", '#add', function (event) {
 	        $("#useracess_insert").removeClass("collapse");
			$("#icon").show();
	        $("#useracess_update").addClass("collapse");			
	 });*/
	 $(document).on("click", '.glyphicon-filter', function (event) {		 
        $('#example_filter').toggle(); 		
	 });
	
	 $(document).on("click", '#useracess_update', function (e) {
 		 e.preventDefault();
   	     if($("#commentForm").valid()){
			 $("#useracess_update").attr("disabled", "disabled");
  	        if(typeof FormData !== 'undefined') {
				
 			  var formData = new FormData( $("#commentForm")[0] );
			  
 		        swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the User Access data?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                }).then((willUpdate) => {
					
 			       if(willUpdate){
					   
  		              if($("#commentForm").valid()){
 			              $.ajax({
			                  url: "<?=base_url()?>Useracess/useracess_updation",  
			                  data:formData,
			                  method: "POST",
				              async : false,
                              cache : false,
                              contentType : false,
                              processData : false,
			                  success: function(result){
								$("#useracess_update").removeAttr("disabled");  
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
                                     text:"User Access data Updated successfully" ,
                                     icon: "success",
                                     button: "ok",
                                  }).then(function(){
						             url=  "<?php echo  base_url(); ?>Useracess";
						             window.location.href = url;
					              });
					            }
 			                  }
	                      });
 		              }
		           }else{
					   $("#useracess_update").removeAttr("disabled");
					   }
		        });
			}
		 }
 	 });	 
	 
	 $(document).on("click", '#img_close', function (event) {
 		  $("#icon").show();
		  $(".img-wrap").addClass("collapse");
 		 
	 });
	 
	 $(document).on("click", '#geoffence_1', function (event) {
		 if($(this).prop('checked')){
			 $("#geoffence_group").show("1000");
		 }else{
			 $("#geoffence_group").hide("1000");
			 $(".g_group").each(function(index, element) {
				 $(this).prop('checked',false);
                
            });
		 }
	 });
	 
 	 
	 $(document).on("click", '.useracess_edit', function (event) {
   		  id=$(this).attr("data-id");
 		  $("#group_data_id").val(id);
		  
    	  $.ajax({
			      url: "<?=base_url()?>Useracess/selecting", 
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
   						 $.each(data.masters, function(index, pvalue) {
							 $("#masters_"+index).prop('checked', false);
 							  if(pvalue=="1")
   							      $("#masters_"+index).prop('checked', true);
   						 });
						 $.each(data.task, function(index, pvalue) {
							 $("#department_"+index).prop('checked', false);
   							 if(pvalue=="1")
   							     $("#department_"+index).prop('checked', true);
  						 });
						 $.each(data.geoffence, function(index, pvalue) {
							  $("#geoffence_1").prop('checked', false);
   							 if(pvalue=="1"){
    							     $("#geoffence_1").prop('checked', true);
									  $("#geoffence_group").show();
							 }else{
								 $("#geoffence_group").hide();
							 }
  						 });
						 
						 $.each(data.reports, function(index, pvalue) {
							   $("#reports_"+index).prop('checked', false);
   							 if(pvalue=="1"){
   							     $("#reports_"+index).prop('checked', true);
							 } 
  						 });
 						  $.each(data.geoffence_group, function(index, pvalue) {
							   $("#geoffence_group_"+index).prop('checked', false);
							   
							   console.log("geoffence group"+index+" and value is "+pvalue);
   							 if(pvalue=="1"){
   							     $("#g_group_"+index).prop('checked', true);
							 }
  						 });
						 
						 if(data.geoffence_creation=="1"){
							  $("#Geoffence_creation").prop('checked', true);
						 }
						 if(data.shipping=="1"){
							  $("#Shipping").prop('checked', true);
						 }
						 
						 
						 $("#useracess_update").removeAttr("disabled");
   						 $("#useracess_update").removeClass("collapse");
						 $("#useracess_insert").addClass("collapse");
 						 $("#myModal").modal('show');
 					 }
			     }
	    });
 	 })
 	 
  });
 </script>

</body>
</html>

