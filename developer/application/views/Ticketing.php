<html>
<head>
<body>
<input type="button" value="test me" id="test">
</body>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
   $(document).ready(function() {

   	$("test").click(function(){

   		 $.ajax({
   		   url: "<?=base_url()?>Ticketing_system/test", 
   		   type: 'post',
		   beforeSend : function()    {          
                if(currentRequest != null) {
                    currentRequest.abort();
					console.log("aborting previous request");
                }
            },
   		   success: function(result,textStatus, xhr) {
   		   	      console.log(xhr.status);
                  console.log(xhr.status);
           },
           complete: function(xhr, textStatus) {
                console.log(xhr.status);
           },
          error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
              console.log(thrownError);
           }
   		});

   	});
   });
</script>
</html