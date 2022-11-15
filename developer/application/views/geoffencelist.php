	<link rel="stylesheet" href="<?=base_url()?>lib/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?=base_url()?>lib/css/button.css" />
<style>#example_filter {
    display: none;
    right: 100px;
    position: absolute;
}

</style>
 <div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:98%; margin:1% auto 0 auto">

    <!-- Modal content-->
    <div class="modal-content">
     <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title"> Geoffence Location</h4>
      </div>
       <div class="modal-body" style="height:80vh; padding:0;" >
       <div id="map" class="full-screen" > </div>
       
       <div id="MapType" class="btn-group pull-left" data-toggle="buttons" style="bottom: 13%; left: 45%; position: fixed; z-index:100px;">
         <label class="btn btn-custom active" >
           <input type="radio" class="Road" id="Road" value="Road" name="satelite_type" autocomplete="off" checked> Road
         </label>
         <label class="btn btn-custom">
           <input type="radio" class="Satellite" id="Satellite" name="satelite_type" value="Satellite" autocomplete="off"> Satellite
         </label>
      </div>
</div>
       <div class="modal-footer" style="clear: both; ">
         <button type="button" class="btn btn-info" id="update_loc" >Update</button>
       </div>
      
    </div>
      
      
  </div>
 </div>
  
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="font-size:32px; color:#FFF;">&times;</button>
        <h4 class="modal-title">Geoffence</h4>
      </div>
      <form class="cmxform" id="commentForm" method="get" action="">
       <div class="modal-body" >
       <div class="col-md-12">
      <div class="col-md-offset-1 col-md-10" style="margin-bottom: 2%;">
      <label>Geofence Code</label> <input type="text" name="geofence_code" id="geofence_code" class="form-control" placeholder="Geofence Code" required>
       <span id="name_error2" class="collapse" style="color:#F00;">Geofence Code Already existed</span>
        <label>Group</label>
             <select name="geo_group" class="themes form-control" id="geo_group" required>
             <option value="">select</option>
             <?php 
  			 foreach($geo_group as $geo_group_key=>$geo_group_data){
 				 ?>
              <option  value="<?=$geo_group_data['id']?>"><?=$geo_group_data['Name']?></option>
               <?php } ?>
             </select>
             <div id="div_customer_detils">
       	<label>Customer Name</label>
             <select name="cust_details" class="themes form-control" id="cust_details">
             <option value="">select</option>
             <?php 
  			 foreach($cust_details as $cust_details_key=>$cust_details_data){
 				 ?>
              <option  value="<?=$cust_details_data['id']?>"><?=$cust_details_data['cust_name']?></option>
               <?php } ?>
             </select>
       		</div>
             
       		<label>Name</label> <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
       <span id="name_error1" class="collapse" style="color:#F00;">Name Already existed</span>
       
            <label>color</label>
            <input id="color" class="jscolor form-control" name="color" value="ab2567">
                </div>   
      </div>
       </div>
      <div class="modal-footer" style="clear: both;">
         <input type="hidden" name="boundaries" id="boundaries" value="">
         <input type="hidden" name="geoffence_id" id="geoffence_id" value="">
        <button type="button" class="btn btn-info" id="insert" >Insert</button>
        <button type="button" class="btn btn-info" id="update" >Update</button>
       </div>
       </form>
    </div>
     </div>
   </div> 
   <div class="custom-width">  
   <div class="card dark-shadow">
	<div class="card-body">
     <div id="table_container">
    <div class="container-fluid">
       <div class="menu"> <a><i class="glyphicon glyphicon-filter"></i></a></div></div>
       <div class="scrollbar" id="style-1">
	   <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered display nowrap" width="100%">
      
             <thead style="display: table-header-group;">
             <tr class="header">
            	<th>Geofence Code</th>
                <th>Name</th>
                <th>Type</th>
                <th>Importance</th>
                <th>Trigger</th>
                <th>Status</th>
                <th>Created</th>
                <th>Modified</th>
                <!--<th>User</th>-->
               <td> Actions</td>
             </tr>
          </thead>
          <tbody>
          <?php 
		   
		   foreach($geoffencefulldata as $geoffencekey=>$geoffence_data){
			   if($geoffence_data['importance']=="1"){
				    $impoertance="Low";
			   }else if($geoffence_data['importance']=="2"){
				    $impoertance="Medium";
			   }else{
				    $impoertance="High";
			   }
			    if($geoffence_data['triger']=="1"){
				    $triger="IN";
			   }else if($geoffence_data['triger']=="2"){
				    $triger="OUT";
			   }else{
				    $triger="BOTH";
			   }
			  ?>
            <tr >
            	<td><?=$geoffence_data['geofence_code']?></td>
               <td><?=$geoffence_data['name']?></td>
              <td><?=$geoffence_data['type']=="1"?"Normal":"Alert";?></td>
              <td><?=$impoertance?></td>
              <td><?=$triger?></td>
              <td id="geoffence_status_<?=$geoffence_data['id']?>"><?=$geoffence_data['status']==1?"Active":"Deactivated";?></td>
               <td><?=$geoffence_data['created']?></td>
              <td><?=$geoffence_data['modified']?>
              </td>
              <td>
                <a class="btn edit"  style="color: #333;" data-toggle="tooltip" title="Edit" data-id="<?=$geoffence_data['id']?>">
                <i class="glyphicon glyphicon-edit" style="font-size: 20px"></i></a>
                  <a class="btn editlocation"  style="color: #333;" data-toggle="tooltip" title="Edit Location" data-id="<?=$geoffence_data['id']?>">  <i class="glyphicon glyphicon-map-marker" style="font-size: 20px"></i>
               </a>
                <?php if($geoffence_data['status']!=0){ 
				          $collapse1="collapse";
				          $collapse="";				
				       }else{
					     $collapse1="";
				         $collapse="collapse";
				       }
				  ?>
                <a class="btn delete <?=$collapse?>" id="dlt-add_<?=$geoffence_data['id']?>" style="color: #333" data-toggle="tooltip" title="Deactive Geoffence" data-id="<?=$geoffence_data['id']?>"><i class="glyphicon glyphicon-trash" style="font-size: 20px"></i></a>
                 
                <a id="dlt-clear_<?=$geoffence_data['id']?>" class="btn delete-clear <?=$collapse1?>" style="color: #333" data-toggle="tooltip" title="Activate Geoffence" data-id="<?=$geoffence_data['id']?>"><i class="glyphicon glyphicon-import" style="font-size: 20px"></i></a>
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

<script>
   var myLatlng;
  var mapOptions;
  var map;
 function initialize() {
  myLatlng = new google.maps.LatLng("25.286106","51.534817");
     var mapOptions = {
        zoom: 10,
        center: myLatlng,
		mapTypeIds: ['coordinate', 'roadmap'],
		 disableDefaultUI: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP 
      };
     map = new google.maps.Map(document.getElementById("map"), mapOptions);
}
</script>

 <script src="<?=base_url()?>lib/js/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDfLQ-HGp-RlEF7nfGq2lAI8AZmfBZm7oo&callback=initialize&libraries=geometry,drawing"></script>
<script src="<?=base_url()?>lib/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>lib/js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>lib/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>lib/js/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>


<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"  ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" /></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"  ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"  ></script>        	
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"  ></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"  ></script>

<script src="<?php echo base_url(); ?>lib/js/jquery.selectBoxIt.js"></script>
<script src="<?=base_url()?>lib/js/jscolor.js"></script> 
<script>

$(document).ready(function() {
	
	
	var polygonarray=[];
	
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
				"columnDefs": [
					{ "targets": [7], "orderable": false }
				],
				dom: 'lBfrtip',
          		 buttons: [ 'excel', 'print'
          		]
			});
			
 			
 
 			$(document).on("click", '.glyphicon-filter', function (event) {		 
        $('#example_filter').toggle(); 
		
	 });
 	/*data table end*/ 
     $('#commentForm').validate({ // initialize the plugin
        rules: {
 			geo_group: {
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
   
   
	 
	 $(document).on("click", '#add', function (event) {
 	        $("#insert").removeClass("collapse");
	        $("#update").addClass("collapse");
	 });
	 
	$(document).on("click", '#update_loc', function (event) {
		 
		 swal({
                      title: "Are you sure?",
                      text: "Do you really want to Update the Geoffence data?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
         }).then((willUpdate) => {
			 
 			 if(willUpdate){
				 
 				  var id=$("#geoffence_id").val();
				  var boundaries=$("#boundaries").val();
 				   
				  if(boundaries!=""){
					  
					   $.ajax({
 			            url: "<?=base_url()?>geoffence/geoffencepos_updation", 
			            data:{id:id,boundaries:boundaries},
			            method: "POST",
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
                                 text:"Geoffence location Updated successfully" ,
                                 icon: "success",
                                 button: "ok",
                            }).then(function(){
						        url=  "<?php echo  base_url(); ?>geoffence";
						        window.location.href = url;
					        });
					    }
 			       }
	         });
					  
				  }else{
					   swal({
                                 text: "There is no Updation ",
                                 icon: "warning",
                                 button: "ok",
                       });
					  
				  }
				 
			 }
		 });
		 
	});
	 
	 
	 $(document).on("click", '#update', function (event) {
		 
 	    if($("#commentForm").valid()){
		   	  
					
 			   swal({
							title: "Are you sure?",
							text: "Do you really want to Update the Geoffence data?",
							icon: "warning",
							buttons: true,
							dangerMode: true,
			   }).then((willUpdate) => {
			 
			       if(willUpdate){
   			        var id=$("#geoffence_id").val();
					var geofence_code=$("#geofence_code").val();
 		            var name=$("#name").val();
			        var color=$("#color").val();
					var geo_group=$("#geo_group").val();
					var cust_id=$("#cust_details").val();				 
 			        $.ajax({
						
			            url: "<?=base_url()?>geoffence/geoffence_updation", 
			            data:{id:id,geofence_code:geofence_code,name:name,geo_group:geo_group,color:color,cust_id:cust_id},
			            method: "POST",
			            success: function(result){
					 console.log(result);
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
                                 text:"Geoffence data Updated successfully" ,
                                 icon: "success",
                                 button: "ok",
                            }).then(function(){
						        url=  "<?php echo  base_url(); ?>geoffence";
						        window.location.href = url;
					        });
					    }
 			       }
	            });
			   }
			  })
 		  }
 	 });	 
	 
	 $("#div_customer_detils").hide();
	 
	 
	 
	 $(document).on("click", '.edit', function (event) {
		 
   		  id=$(this).attr("data-id");
 		  $("#geoffence_id").val(id);
		  
   		  $.ajax({
			     url: "<?=base_url()?>/geoffence/selecting", 
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
							 
 							 if(index=="color"){
								  $("#color").css({"background-color": "#"+pvalue});
                                  $("#color").val(pvalue);
							 }else if(index=="geo_group"){
 								 $('select[name=geo_group]').val(pvalue);								 
								   if (pvalue === "1") {
									   console.log("hello");
									  $("#div_customer_detils").show(); 
									               
									}else{
										$("#div_customer_detils").hide();
										}
 							 }else if(index=="cust_id"){								 
									$('select[name=cust_details]').val(pvalue);						
								//console.log(test);
								console.log("hi");
							 }else{
  							     $("#"+index).val(pvalue);
							 }
 						 });
						 
						  $('.selectpicker').selectpicker('refresh');
						 //$("#cust_details").selectpicker("refresh");
						 $("#update").removeClass("collapse");
						 $("#insert").addClass("collapse");
 						 $("#myModal").modal('show');
 					 }
			     }
	    });
 	 })
	 
	 $("#geo_group").on('change', function() {
            if ($(this).val() === "1") {
              $("#div_customer_detils").show();              
            }else{
				$("#div_customer_detils").hide();
				}
	 });
	 
	  $(document).on("click", '.editlocation', function (event) {
		  
		  
    	  id=$(this).attr("data-id");
 		  $("#geoffence_id").val(id);
 		  
   		  $.ajax({
			     url: "<?=base_url()?>geoffence/show_geoffence", 
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
						 $.each(polygonarray, function(index, val) {
 				               polygonarray[index].setMap(null);
                         });
   						  
 						 $.each(data.full_geoffence,function(geo_id,geo_data){
							  draw_polygon_show(geo_data.information,geo_data.color,geo_id,geo_data.name); 
						 });
 						   draw_polygon(data.information,data.color,id,data.name);
						   
 						 $("#myModal1").modal('show');
 					 }
			     }
	    });
 	 })
	 
	  function draw_polygon_show(boundaries,color,id,name){
	  
    	 boundries=boundaries;
		 var boundary_array=boundries.split("|");
 		 triangleCoords=[];
  		 $.each(boundary_array, function(index, bvalue) {
 			  var cordinates=bvalue.split(",");
    		 triangleCoords.push(new google.maps.LatLng(cordinates[0],cordinates[1])) ;
 		 });
 		 		 
     // Construct the polygon
        wataniyaTriangle = new google.maps.Polygon({
						     id:id,
                             paths: triangleCoords,
                             draggable: false,
                             editable: false,
                             strokeColor: '#'+color,
                             strokeOpacity: 0.8,
                             strokeWeight: 2,
                             fillColor:  '#'+color,
                             fillOpacity: 0.50
                     });
        wataniyaTriangle.setMap(map);
	   attachPolygonInfoWindow(wataniyaTriangle,name);
	   polygonarray.push(wataniyaTriangle);
   }
   
	 
	 function draw_polygon(boundaries,color,id,name){
	  
  	     boundries=boundaries;
		 var boundary_array=boundries.split("|");
 		 triangleCoords=[];
		 
  		 $.each(boundary_array, function(index, bvalue) {
 			 var cordinates=bvalue.split(",");
  			 triangleCoords.push(new google.maps.LatLng(cordinates[0],cordinates[1] )) ;
			 console.log(cordinates)
 		 });
		 
		 
		          var all_borders=boundries.split("|");
			      var cordinates=all_borders[0].split(",");
 			      myLatlng = new google.maps.LatLng(cordinates[0],cordinates[1]);
  			      map.setCenter(myLatlng); 
			      map.setZoom(14);
		 
		     //var cordinates=all_borders[0].split(",");
 			      myLatlng = new google.maps.LatLng(cordinates[0],cordinates[1]);
  			      map.setCenter(myLatlng); 
			      map.setZoom(16);
		   
     // Construct the polygon
        wataniyaTriangle = new google.maps.Polygon({
						     id:id,
                             paths: triangleCoords,
                             draggable: false,
                             editable: true,
                             strokeColor: '#'+color,
                             strokeOpacity: 0.8,
                             strokeWeight: 2,
                             fillColor:  '#'+color,
                             fillOpacity: 0.35
                          });
 								
		   
							 
        wataniyaTriangle.setMap(map);
  	     
		attachPolygonInfoWindow(wataniyaTriangle,name);
		
		google.maps.event.addListener(wataniyaTriangle.getPath(), 'remove_at ', function(evt) {
              //  console.log(wataniyaTriangle.getPath().getAt(evt).toUrlValue(6));
  			     var coordinatesArray=wataniyaTriangle.getPath().getArray();
			     $("#boundaries").val(coordinatesArray);
			      console.log(coordinatesArray);
        });
		google.maps.event.addListener(wataniyaTriangle.getPath(), 'set_at', function(evt) {
  			     var coordinatesArray=wataniyaTriangle.getPath().getArray();
			     $("#boundaries").val(coordinatesArray);
			    console.log(coordinatesArray);
        });
		
	    google.maps.event.addListener(wataniyaTriangle.getPath(), 'insert_at', function(evt) {
  			    var coordinatesArray=wataniyaTriangle.getPath().getArray();
			    $("#boundaries").val(coordinatesArray);
			     console.log(coordinatesArray);
        });
 		
	   polygonarray.push(wataniyaTriangle);
	  
  }
	 
	 
  function attachPolygonInfoWindow(polygon,name) {
        var geo_infoWindow = new google.maps.InfoWindow();
        google.maps.event.addListener(polygon, 'mouseover', function (e) {
           geo_infoWindow.setContent(name);
          var latLng = e.latLng;
          geo_infoWindow.setPosition(latLng);
          geo_infoWindow.open(map);
        });
 	   google.maps.event.addListener( polygon, 'mouseout', function() {
				 geo_infoWindow.close();
	   });
   }

	 
	 
	 $(document).on("click", '.delete', function(event){
		 
		 id=$(this).attr("data-id");
		 $("#geoffence_id").val(id);	
		 
		 console.log("delete id is "+id);
		swal({
                      title: "Are you sure ?",
                      text: "Do you want to Deactivate Geoffence?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
         }).then((willUpdate) => {
			 
			 if(willUpdate){		 
 				$.ajax({
					 url: "<?=base_url()?>geoffence/geoffence_deactive", 
					 data:{id:id},
					 method: "POST",
					 success: function(result){
						 var data = $.parseJSON(result); 
						 if(data.error_flag=="1"){
							 swal({
									 
									 text: data.message,
									 icon: "error",
									 button: "ok",
							  });
						 } else{
							 swal({
								 title: "Success!",
								 text:"Geoffence Deactivated successfully" ,
								 icon: "success",
								 button: "ok",
							}).then(function(){
 								$("#dlt-clear_"+id).show();
								$("#dlt-add_"+id).hide();
								$("#geoffence_status_"+id).html("Deactivated");
 							});
							 
						 }
	                  }
				})
			 
			 }
		 });
	 });
	
    $(document).on("click", '.delete-clear', function(event){
	    
		 id=$(this).attr("data-id");
		 $("#geoffence_id").val(id);
		 swal({
			 	title: "Are you sure?",
				text: "Do you want activate Geoffence?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			  }).then((willUpdate) => {
				  if(willUpdate){
					   
						 $.ajax({
							 url: "<?=base_url()?>geoffence/geoffence_activate",
							 data: {id:id},
							 method: "POST",
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
										 text:"Geoffence Activated successfully" ,
										 icon: "success",
										 button: "ok",
									}).then(function(){
										$("#geoffence_status_"+id).html("Active");
 										$("#dlt-add_"+id).show();
 										$("#dlt-clear_"+id).hide();
 					  					});								
								 }
							   }
							});						
					}
				});
	 });
		  
		    $("input[name='satelite_type']").change(function(){
			  if($(this).val()=="Satellite")
			      map.setMapTypeId(google.maps.MapTypeId.HYBRID)
			   else
			      map.setMapTypeId(google.maps.MapTypeId.ROADMAP)
           });
		 
		  $(document).on("click", '.Satellite', function (event) {
 			  var myMapType = new MyMapType();
			  map.mapTypes.set('terrain', myMapType);
		      map.setMapTypeId('terrain');
		  });
		  
 		  $(document).on("click", '.Road', function (event) {
 			    var myMapType = new MyMapType();
			    map.mapTypes.set('roadmap', myMapType);
		        map.setMapTypeId('roadmap');
		  });
	 
 	 
  });
 </script>

</body>
</html>

