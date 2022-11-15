 <script  src="<?=base_url()?>lib/js/menu.js"></script>
 <script>
 $(window).on("load", function(e) {
	   
 	  var resettimeout="";
	  var storage_time_flag="1";
 	  var session_time_flag="1";
	  if (resettimeout !== null) {
	   clearTimeout(resettimeout);
	  }
 	  resetstorage();
	  resetstoragetimer();
 
	  
	  document.onkeypress = resetstorage;
	  document.onmouseover = resetstorage;
	  
	  
	  function resetstorage(){
		  
		  
		  if(storage_time_flag=="1"){
  		    var dt = new Date();
  		    localStorage.setItem('logouttime',dt.getTime());
		    localStorage.setItem('logout-event', 'logedin');
		  }
		  
		 
 	  }
	  
	  function resetstoragetimer(){
		 
		  var logouttime=localStorage.getItem('logouttime');
		   var dt = new Date();
		   
		   
 		  if((dt.getTime()-logouttime)/1000>1200){
			  logout();
			  clearTimeout(resettimeout);
 		  }else if((dt.getTime()-logouttime)/1000>1140){
 			  if(session_time_flag=="1"){
				  session_time_flag="0";
				  storage_time_flag="0"
			      warning();
			  }
		  }
		 resettimeout = setTimeout(resetstoragetimer,2000);
	  }
	  
	  document.addEventListener("visibilitychange", function() {
 		   
		  if(document.visibilityState=="hidden"){
 			  if (resettimeout !== null) {
					 clearTimeout(resettimeout);
			  }
		  }else{
			  
			   $.ajax({
					 url: "<?php echo  base_url(); ?>footer/login_check",  
					 type: 'post',
					 success:function(result){
						var data = $.parseJSON(result); 
						 if(data.status=="1"){ 
						    clearTimeout(resettimeout);
							console.log("retet time out is "+resettimeout);
						    resetstoragetimer();
							//resetstorage();
							//clearTimeout(resettimeout);
				           
						 }else{
							  localStorage.setItem('logout-event', 'logout');
							 swal({
									 text: "SORRY !!! Your Login Session was already Timeout",
									 icon: "error",
									 button: "ok",
							 }).then(function(){
 								     url=  "<?php echo  base_url(); ?>";
								     window.location.href = url;
							 });
						 }
					 }
				   
			 });
 		  }
 	  }, false);
	  
	  
   	  function logout() {
 		  
  		  $.ajax({
 			  url: "<?php echo  base_url(); ?>footer/auto_logout",  
 			  type: 'post',
			  success:function(result){
 				 swal({
						 text: "Your Login Session Timeout",
						 icon: "error",
						 button: "ok",
				 }).then(function(){
					  localStorage.setItem('logout-event', 'logout');
					  url=  "<?php echo  base_url(); ?>";
					  window.location.href = url;
				 });
		     }
		  });
       }
	   
	   
 	function warning(){
		
		 
	  swal({
			title: "Are you sure?",
			text: "Your Session will be expire soon.Do you want to continue?",
			icon: "warning",
			timer: 58000,
			buttons: true,
			dangerMode: true,
	  }).then((willUpdate) => {
		  
			  if(willUpdate){
				   $.ajax({
					 url: "<?php echo  base_url(); ?>footer/login_check",  
					 type: 'post',
					 success:function(result){
						var data = $.parseJSON(result); 
						 if(data.status=="1"){ 
						    storage_time_flag="1";
							resetstorage();
						 }else{
							  localStorage.setItem('logout-event', 'logout');
							 swal({
									 text: "SORRY !!! Your Login Session was already Timeout",
									 icon: "error",
									 button: "ok",
							 }).then(function(){
								  
								   url=  "<?php echo  base_url(); ?>";
								    window.location.href = url;
							 });
						 }
					 }
				   
				   });
			  }else{
				  logout();
				 
			  }
	 });
  }
 

  $(document).on("click", '.logout', function (event) {
		swal({
				title: "Are you sure?",
				text: "Do you really want to Logout?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
		  }).then(function(logout){
			  if(logout){
				localStorage.setItem('logout-event', 'logout');
				url=  "<?php echo  base_url(); ?>";
				window.location.href = url;
			  }
		  });
   });

});
	  </script>
 
 </div>

</body>
</html>
