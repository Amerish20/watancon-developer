<link rel="stylesheet" href="<?=base_url()?>lib/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?=base_url()?>lib/css/button.css" />
<link rel="stylesheet" href="<?=base_url()?>lib/css/jquery.btnswitch.css">
<style>#example_filter {
    display: none;
    right: 100px;
    position: absolute;
}
.table-text-center label{margin:0 auto}
</style>

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
       <label> Asset Code</label> <input type="text" name="asset_code" id="asset_code" class="form-control" placeholder="Asset code"  disabled>
       <label>Asset Description</label><input type="text" name="asset_desc" id="asset_desc" class="form-control"  placeholder="Description"  disabled>
       <label>Vehicle Model</label><input type="text" name="model" id="model" class="form-control" placeholder="Model" disabled>
       <label>Current Oil changed Odometer</label><input type="text" name="current_odo" id="current_odo" class="form-control" placeholder="Current oil changed odometer">
       <label>Oil Changed date</label><input type="text" name="oil_date" id="oil_date" class="form-control" placeholder="DD/MM/YY"  >
     
                 </div>    
            <div class="col-md-6" >
      <label>Reference No</label><input type="text" name="name" id="name" class="form-control" placeholder="Reference No" disabled>
 
         <label>Group</label>
             <select name="Group" class="selectpicker themes form-control" id="Group" data-live-search="true"  disabled>
             <option>select</option>
             <?php foreach($groups as $group_key=>$group_data){?>
             <option  data-icon="<?=base_url()?>lib/<?=$group_data['icon']?>" value="<?=$group_data['id']?>"><?=$group_data['name']?></option>
              <?php } ?>
           </select>
           <label>Previous Oil changed Odometer</label><input type="text" name="prevoil_odo" id="prevoil_odo" class="form-control" placeholder="Previous oil changed odometer" disabled>
           
            <label>Working Hours</label><input type="text" name="working_hrs" id="working_hrs" class="form-control" placeholder="Current Working Hours">
           
            <label>Registration Date</label>
          <input type="text" name="selected_date" id="reg_expiry" class="form-control"  placeholder=" DD/MM/YY" >
           
         
 
        </div>
      </div>
       </div>
      <div class="modal-footer" >
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
    
       <div class="menu"><a><i title="Search" class="glyphicon glyphicon-filter"></i></a></div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap"  style=" box-sizing: border-box; clear:both"  >
           <thead style="display: table-header-group;">
             <tr class="header" >
               <td> Asset Code </td>
               <td> Plate Number</td>
               <td> Fleet</td>
               <!-- <td> Last Oil <br /> Change hours</td>
               <td> working <br /> Time</td>
               <td> Pending<br /> Hours</td>
               <td> Last Oil Change <br /> Odometer</td>
               <td> Current <br /> Odometer</td>
               <td> Pending <br />Odometer</td>
               <td> Last Oil <br /> Change Date</td>
               <td> Maintanance <br /> Months</td> -->
               <td> workshop <br /> Status</td>
               <td> Long Stop <br /> Status</td>
               <!-- <td> Hours <br /> Status</td>
               <td> KM Status</td>
               <td> Date Status</td> -->
               <td> Modified</td>
               <!-- <td> Actions</td> -->
             </tr>
          </thead>
          <tbody>
          <?php 
 		   foreach($vehiclefulldata as $vehiclekey=>$vehicle_data){
 			    
				if($vehicle_data['workshop_status']=="1" || $vehicle_data['longstop_status']=="1"){
					$style='style="background-color:#85d9fa"';
				}else{
					$style='';
				}



			  ?>
             <tr <?=$style?>>
              <td><?=strtoupper($vehicle_data['asset_code']);?></td>
              <td><?=$vehicle_data['description']?></td>
              <td><?=$vehicle_data['group_name']?></td>
             <!--  <td><?=$vehicle_data['prev_work_hrs']?></td>
              <td><?=$vehicle_data['cur_work_hrs']?></td>
              <td><?=$vehicle_data['peding_hours']?></td>
              <td><?=$vehicle_data['prev_oil_change']?></td>
              <td><?=$vehicle_data['cur_odo']?></td>
              <td><?=$vehicle_data['peding_odometer']?></td>
              <td><?=$vehicle_data['oil_change']?></td>
              <td><?=$vehicle_data['maintanance_month']!=NULL && $vehicle_data['maintanance_month']!=0 ?$vehicle_data['maintanance_month']==1?$vehicle_data['maintanance_month'] ." month":$vehicle_data['maintanance_month']." months":"";?></td>-->
               <td> 
               <div class="wrapper">
                <div class="workshop_status" id="workshop_<?=$vehicle_data['id']?>" data-id="<?=$vehicle_data['id']?>" data-value="<?=$vehicle_data['workshop_status']?>" ></div>
 			  </div>
               </td>

               <td> 
               <div class="wrapper">
                <div class="longstop_status" id="longstop_<?=$vehicle_data['id']?>" data-id="<?=$vehicle_data['id']?>" data-value="<?=$vehicle_data['longstop_status']?>" ></div>
        </div>
               </td>
              <!-- <td><?=$vehicle_data['hours_status']?></td>
              <td><?=$vehicle_data['km_status']?></td>
              <td><?=$vehicle_data['date_status']?></td> -->
              <td><?=$vehicle_data['modified']?></td>
              <!-- <td>
                <a class="btn edit"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$vehicle_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
                 
              </td> -->
              
             </tr>
              <?php }?>
          </tbody>
         </table>
         
         <input type="hidden" id="vehicle_data_id" value="">
		 </div>
</div></div>
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
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"  ></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" /></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"  ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"  ></script>      -->   	
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"  ></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"  ></script> -->
<script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/custom-data-source/dom-checkbox.js"></script>
<script src="<?php echo base_url();?>lib/js/jquery.selectBoxIt.js"></script>
<script src="<?php echo base_url();?>lib/js/jquery.btnswitch.js"></script>
  <script>
 
 
$(document).ready(function() {
	   
	  $(".selectpicker").attr('disabled',true);
	
	
	
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
			
		$('.workshop_status').btnSwitch({
           Theme: 'Light'
        });	
    $('.longstop_status').btnSwitch({
           Theme: 'Light'
        }); 
			
      
			
 			// DataTable
			var table = $('#example').DataTable({
				"responsive": true,
				//"autoWidth": true,
 				"orderCellsTop": true,
				"searching": true,
				//"columnDefs": [
					// { "targets": [11], "orderable": false },
					// { "targets": [16], "orderable": false },
					// { className: "table-text-center", "targets": [ 7 ] },
					// { "targets": [9], "orderDataType": "dom-checkbox" },
 				//],
				 //"order": [[ 12, "asc" ], [ 13, "asc" ], [ 14, "asc" ] ],
			//	dom: 'lBfrtip',
          		//  buttons: [ 'excel', 'print'
          		// ],
				'rowCallback': function(row, data, index){
					   
					
					if(data[12]!="Not Exceeded"){
                          $(row).find('td:eq(12)').css('color', 'red');
						  $(row).find('td:eq(12)').css("font-weight", "bold");
                     }else{
						 $(row).find('td:eq(12)').css('color', 'green');
						  $(row).find('td:eq(12)').css("font-weight", "bold");
					 }
 					
					 if(data[13]!="KM is ok"){
                          $(row).find('td:eq(13)').css('color', 'red');
						  $(row).find('td:eq(13)').css("font-weight", "bold");
                     }else{
						 $(row).find('td:eq(13)').css('color', 'green');
						  $(row).find('td:eq(13)').css("font-weight", "bold");
					 }
					 
				 
					if(data[14]!="Date is ok"){
                          $(row).find('td:eq(14)').css('color', 'red');
						  $(row).find('td:eq(14)').css("font-weight", "bold");
                     }else{
						 $(row).find('td:eq(14)').css('color', 'green');
						  $(row).find('td:eq(14)').css("font-weight", "bold");
						 }	 
				},
				 
				//"bSearchable": true,
			});
  			
 	/*data table end*/ 
      
    
   
		 
 	 $(document).on("click", '#add', function (event) {
 	        $("#insert").removeClass("collapse");
	        $("#update").addClass("collapse");
  			$("#commentForm")[0].reset();
   			$('.selectpicker').selectpicker('refresh');
			$("#myModal").modal('show');
 	 });
	 
	 $(document).on("click", '#update', function (event) {
		 
		 swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the vehicle data?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
         }).then((willUpdate) => {
			 
			 if(willUpdate){
		 
 		if($("#commentForm").valid()){
			
			 
			var id=$("#vehicle_data_id").val();
 		    var reg_exp=$("#reg_expiry").val();
 			var prevoil_odo=$("#current_odo").val();
		    var oil_change=$("#oil_date").val();
			 var working_hrs=$("#working_hrs").val();
		 
			$.ajax({
			     url: "<?=base_url()?>/Maintanance/vehicle_updation", 
			     data:{id:id,prevoil_odo:prevoil_odo,oil_change:oil_change,reg_exp:reg_exp,working_hrs:working_hrs},
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
                             text:"Vehicle data Updated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
						   url=  "<?php echo  base_url(); ?>Maintanance";
						   window.location.href = url;
					  });
					 }
 			     }
	         });
			
		    }
		  }
		});
		 
	 });
	 
 	 $(document).on("click", '.glyphicon-filter', function (event) {		 
        $('#example_filter').toggle();
 	 });
 
 	 $(document).on("click", '.edit', function (event) {
		 
   		  id=$(this).attr("data-id");
		  $("#vehicle_data_id").val(id);
		  
   		  $.ajax({
			     url: "<?=base_url()?>/Maintanance/selecting", 
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
   							 }else if(index=="Group"){
								$('select[name=Group]').val(pvalue);
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
 							 }else if(index=="working_hrs"){
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
 						 $("#update").removeClass("collapse");
  						 $("#myModal").modal('show');
 					 }
			     }
	    });
 	 }) 
	 
	 
	 
	 
  });
 </script>



