  
  <style>
  .radio{margin-top:3px}
  .radio input[type=radio]{
  position: absolute;
  visibility: hidden;
}
  	.radio label{
  display: block;
  position: relative;
  font-weight: 300;
  font-size: 1.25em;
  padding: 5px 20px 20px 42px;
  margin: 10px auto;
  height: 30px;
  z-index: 9;
  cursor: pointer;
  -webkit-transition: all 0.25s linear;
}

.radio:hover label{
	color: #1b6d85;
}

.radio .check{
  display: block;
  position: absolute;
  border: 5px solid #AAAAAA;
  border-radius: 100%;
  height: 25px;
  width: 25px;
  top: 5px;
  left: 3px;
	z-index: 5;
	transition: border .25s linear;
	-webkit-transition: border .25s linear;
}

.radio:hover .check {
  border: 5px solid #1b6d85;
}

.radio .check::before {
  display: block;
  position: absolute;
	content: '';
  border-radius: 100%;
  height: 9px;
  width: 9px;
  top: 3px;
	left: 3px;
  margin: auto;
	transition: background 0.25s linear;
	-webkit-transition: background 0.25s linear;
}

input[type=radio]:checked ~ .check {
  border: 5px solid #3b5998;
}

input[type=radio]:checked ~ .check::before{
  background: #3b5998;
}

input[type=radio]:checked ~ label{
  color: #3b5998;
}
  </style>
  
   <div class="custom-width">  
   <div class="card dark-shadow">
   <div class="card-body">
   <div class="tab-header" style="color:#3b5998"><i class="fa fa-user"></i>Driver Allocation</div>
      
      <form class="cmxform" id="commentForm" method="get" action="">
       <div class="modal-body" >
       <div class="content-justify">
       <div class="col-md-10 col-sm-12 col-xs-12">
      <div class="col-md-4" >
               
          <label>Vehicle Details</label>
             <select name="vehicle" class="selectpicker themes form-control" id="vehicle" data-live-search="true" required>
             <option>select</option>
             <?php foreach($vehicle as $vehicle_key=>$vehicle_data){?>
             <option value="<?=$vehicle_data['id']?>"><?=$vehicle_data['description']?></option>
              <?php } ?>
           </select>
      </div>    
      <div class="col-md-4" >       
             <label>Batch Number / Driver Name</label>
            <div id="driver-dropbox" class="driver-dropbox" >
        <select name="driver" id="driver" class="selectpicker form-control" data-live-search="true" required>
             <option value=""> select</option>
             <?php foreach($driver as $driver_key=>$driver_data){?>
             <option value="<?=$driver_data['id']?>"><?=$driver_data['batch_num']?> - <?=$driver_data['Name']?></option>
              <?php } ?>
           </select>
         </div>
      </div>   
      <div class="col-md-4" >       
             <label>Shift</label>
             
                 <div class="radio" style="float:left; width:110px;">
                    <input type="radio" name="shift" value="1" id="day" required checked="checked"><label for="day">Day</label>
                    <div class="check"></div>
                  </div>
                  <div class="radio" style="float:left; width:110px; margin-top:3px">
                    <input type="radio" name="shift" value="0" id="night" required ><label for="night">Night</label>
                    <div class="check"></div>
                  </div>
              
      </div>
      
        
       </div>
       </div>
       </div>
      <div class="content-justify" style="border:none" >
        <button type="button" class="btn btn-info" id="driver_allocate" >Allocate</button>        
      </div>
      <div class="clearfix"></div>
      
       </form>
       
   <hr />
   
     <div id="table_container">    
       <div class="menu"><a><i class="glyphicon glyphicon-filter"></i></a></div></div>
	   <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap" width="100%">       
             <thead style="display: table-header-group;">
             <tr class="header">
              <th>S.No</th>
              <th>Vechile Details</th>
              <th>Batch Number</th>
              <th>Driver Name</th>
              <th>Shift</th>
              <th>Allocation Started From</th> 
              <th>Allocation Canceled Time</th>              
              <th>Status</th> 
              <th>Allocated By</th>               
              <th>Actions</th>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($driverfulldata as $driverkey=>$driver_data){
			  ?>
            <tr >
              <td></td>
              <td><?=$driver_data['vehicle_name']?></td>
              <td><?=$driver_data['batch_num']?></td>
              <td><?=$driver_data['driver_name']?></td>
              <td><?=$driver_data['shift']=="1"?"Day Shift":"Night Shift";?></td> 
              <td><?=$driver_data['created']?></td> 
              <td><?=$driver_data['modified']?></td>                   
               <td id="change-status_<?=$driver_data['id']?>"><?php 
			   if($driver_data['status']=="0"){	
				   print "De-Allocated";
			   }else{
				    print "Assigned to ".$driver_data['vehicle_name'];
			   }
 			   
			   ?></td>
               <td><?=$driver_data['user_name']?></td>
              <td>
              
              
                 <?php if($driver_data['status']!=0){ 
				$collapse1="collapse";
				$collapse="";				
				}else{
					$collapse1="";
				   $collapse="collapse";
				}?>
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$driver_data['id']?>" style="color: #333" data-toggle="tooltip" title="clear the allocation" data-id="<?=$driver_data['id']?>"><i class="glyphicon glyphicon-remove" style="font-size: 20px"></i></a>
                 
                <a id="dlt-clear_<?=$driver_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Driver was Unallocated. You cant able to edit" data-id="<?=$driver_data['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
               
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
	
	$('#commentForm').validate({ // initialize the plugin
        rules: {
            vehicle: {
                selectcheck: true
            },
			driver: {
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
	
 	
   	$("#driver_allocate").click(function(){
		
  	  if($("#commentForm").valid()){
  		 $("#driver_allocate").attr("disabled", "disabled");
		 var vehicle_id=$("#vehicle").val();
		 var driver_id=$("#driver").val();
		 var shift_type=$('input[name=shift]:checked').val();
		 
		 
		 console.log(shift_type);
		// console.log(shift_type);
         		 $.ajax({
			     url: "<?=base_url()?>Driverallocation/driver_allocate", 
			     data:{vehicle_id:vehicle_id,driver_id:driver_id,shift_type:shift_type},
			      method: "POST",
			     success: function(result){
					 $("#driver_allocate").removeAttr("disabled");
					 var data = $.parseJSON(result); 
					 console.log(data);
					 if(data.error_flag=="1"){
						 swal({
                                 text: data.message,
                                 icon: "error",
                                 button: "ok",
                          });
					 }else{
 						 swal({
								 title: "Success!",
								 text:"Driver Allocated Successfully" ,
								 icon: "success",
								 button: "ok",
						  }).then(function(){
							   url=  "<?php echo  base_url(); ?>Driverallocation";
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
	

	 
	 $(document).on("click", '.delete', function(event){
		id=$(this).attr("data-id");	
 		swal({
                      title: "Are you sure?",
                      text: "Do you want to Unallocate?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
         }).then((willUpdate) => {
			 
			 if(willUpdate){		 
 				
			//console.log("id "+$("#vehicle_data_id").val());
			$.ajax({
			     url: "<?=base_url()?>/Driverallocation/driver_unallocate", 
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
					 }else{
					    swal({
							 title: "Success!",
                             text:"Driver Unallocated successfully" ,
                             icon: "success",
                             button: "ok",
                        }).then(function(){
 							 
						  url=  "<?php echo  base_url(); ?>Driverallocation";
								window.location.href = url;
																			
						});
						
					 }
 			     }
	         });	    
		  }
		});		
			
	 });
	 
	 });
 </script>

</body>
</html>

