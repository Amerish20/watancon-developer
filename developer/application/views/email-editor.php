	 <script src="<?=base_url()?>lib/js/jquery.min.js"></script>
<script src="<?=base_url()?>lib/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>lib/js/editor.js"></script>       
        <link href="<?=base_url()?>lib/css/editor.css" rel="stylesheet" type="text/css">
          <div class="custom-width">  
   			<div class="card dark-shadow">
   				<div class="card-body">        			
                      <div class="col-lg-12 nopadding">
                      <form class="cmxform" id="commentForm" method="get" action="">
                      <label style="float:left; padding-right:20px; line-height:15px; margin-top:10px">Templates:</label>
                      <select class="form-control" style="float:left; width:88%" name="template" id="template">
                      <option value="">Select</option>
                      <?php
					  foreach($emailfulldata as $subject){
						  print '<option value="'.$subject['id'].'">'.$subject['email_subject'].'</option>';
					  }
					  ?>
                      	 
                      </select>
                      <div class="clearfix"></div>
                      <label style="float:left; padding-right:38px; line-height:15px; margin-top:10px">Subject:</label>
                      <input type="text" placeholder="Enter your Subject here.." class="form-control" name="subject" id="subject" style="float:left; width:88%; " required />            
                                
                      <div class="clearfix"></div>
                      <div id="txtEditor" ></div>
                     <label id="content-error" class="collapse" for="subject">This field is required.</label>
                      
                      <div class="modal-footer">
                      <button type="button" class="btn btn-info" id="msg_insert">Insert</button>	
                      <button type="button" class="btn btn-info collapse" id="msg_update">Update</button>
                      </div>
                      </form>
					
   				</div>
             </div>
           </div>
<script src="<?php echo base_url(); ?>lib/js/sweetalert.min.js"></script> 
 <script src="<?php echo base_url(); ?>lib/js/jquery.validate.js"></script>
              
                <script>

$(document).ready(function() {
	$("#txtEditor").Editor();
	
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
		  
	$("#msg_insert").click(function(){
		 var subject=$("#subject").val();
		 var txtEditor=$(".Editor-editor").html();	
 		
		if(txtEditor==""){
			$("#content-error").removeClass('collapse');
			$("#content-error").addClass('error');
		}else{
		   $("#content-error").removeClass('error');
			$("#content-error").addClass('collapse');
  	       if($("#commentForm").valid()){
  		
   
        		 $.ajax({
					 url: "<?=base_url()?>/Email_template/mail_insert", 
					 data:{subject:subject,txtEditor:txtEditor},
					 method: "POST",
					 success: function(result){
						 var response = $.parseJSON(result);	
						  if(response.error_flag=="1"){
								 swal({
										 text: response.message,
										 icon: "error",
										 button: "ok",
								  });
						 }else{ 		 
							 swal({
									 title: "Success!",
									 text:response.message,
									 icon: "success",
									 button: "ok",
							  }).then(function(){
								   url=  "<?php echo  base_url(); ?>Email_template";
									window.location.href = url;
							  });
						 }
					 }
	              });
 		   }
		}
 	 });
	  $("#msg_update").click(function(){
		  
		  var subject=$("#subject").val();
		  var txtEditor=$(".Editor-editor").html();
 		  if(txtEditor==""){
			$("#content-error").removeClass('collapse');
			$("#content-error").addClass('error');
		  }else{
		   $("#content-error").removeClass('error');
			$("#content-error").addClass('collapse');
			
		  
			  if($("#commentForm").valid()){
			   	
			   var id=$("#template").val();
	   
					 $.ajax({
						 url: "<?=base_url()?>Email_template/mail_update", 
						 data:{id:id,subject:subject,txtEditor:txtEditor},
						 method: "POST",
						 success: function(result){	
						 var response = $.parseJSON(result);
							  if(response.error_flag=="1"){
									 swal({
											 text: response.message,
											 icon: "error",
											 button: "ok",
									  });
							 }else{ 		 
								 swal({
										 title: "Success!",
										 text:response.message,
										 icon: "success",
										 button: "ok",
								  }).then(function(){
									   url=  "<?php echo  base_url(); ?>Email_template";
										window.location.href = url;
								  });
							 }
						 }
					  });
 		       }
		   }
	  });
	 
	 
	 $("#template").change(function(){
		 var id=$(this).val();
		 
		 if(id==""){
			 $("#subject").val("");
			 $(".Editor-editor").html("");
			 $("#msg_insert").removeClass('collapse');
			 $("#msg_update").addClass('collapse');
		 }else{
			 
			 $("#msg_insert").addClass('collapse');
			 $("#msg_update").removeClass('collapse');
			 
			 $.ajax({
				 url: "<?=base_url()?>/Email_template/show_template", 
				 data:{id:id},
				 method: "POST",
				 success: function(result){	
 					 var response = $.parseJSON(result);
 					 if(response.error_flag=="1"){
							 swal({
									 text: response.message,
									 icon: "error",
									 button: "ok",
							  });
					 }else{ 
					  
					   
					    $("#subject").val(response.subject);
						$(".Editor-editor").html(response.message);
					 }
  				 }
	         });
		 }
 		 
	 })
	 
	 
			  
});
 </script>
</body>
</html>
