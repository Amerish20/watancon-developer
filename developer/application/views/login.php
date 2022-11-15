<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en"><head>
  <title>Login Al Wataniya Concrete</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?=base_url()?>lib/images/fav-icon.png" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
  <link href="<?=base_url()?>lib/css/bootstrap.min.css" rel="stylesheet"/>  
  <style>
 	.form-control {
	    margin-bottom: 3%;}
	body, html {
		height: 100%;
		background-repeat: no-repeat;    /*background-image: linear-gradient(rgb(12, 97, 33),rgb(104, 145, 162));*/
		background:black;
		position: relative;
	}
	.input-group {
	    margin-bottom:15px;
	}

	.bg-dark {
	    background-color: #999;
	    border: 1px solid #aaa;
	    color: #333;
	}
	#login {
	    margin-top: 12px;
	    width: 30%;
	    float: right;
	}
	#login-box {
	    position: absolute;
	    top: 19%;
	    left: 50%;
	    transform: translateX(-50%);
	    margin: 0 auto;
	    border: 1px solid #f7f7f7;
	    background: rgba(255, 255, 255, 0.6);
	    min-height: 250px;
	    padding: 25px;
	    z-index: 9999;
	    /*border-radius: 10px;*/
	}
	#login-box .logo .logo-caption {
		font-family: 'Poiret One', cursive;
		color: #333;
		text-align: center;
		margin-bottom: 0px;
	    margin-top:15px;
	}
	    #login-box .logo .tweak {
	        color: #2e6da4;
	        font-weight: bold;
	    }
	#login-box .controls {
		padding-top: 20px;
	}
	#login-box .controls input {
		/*border-radius: 0px;*/
		background: rgba(240, 240, 240,.8);
		border: 1px solid #b5b3b3;
		color: #333;
		font-family: 'Nunito', sans-serif;
	}
	#login-box .controls input:focus {
		box-shadow: none;
	}
	#login-box .controls input:first-child {
		border-top-left-radius: 2px;
		border-top-right-radius: 2px;
	}
	#login-box .controls input:last-child {
		border-bottom-left-radius: 2px;
		border-bottom-right-radius: 2px;
	}
	#login-box button.btn-custom {
		border-radius: 2px;
		margin-top: 8px;
		background:#ff5252;
		border-color: rgba(48, 46, 45, 1);
		color: white;
		font-family: 'Nunito', sans-serif;
	}
	#login-box button.btn-custom:hover{
		-webkit-transition: all 500ms ease;
		-moz-transition: all 500ms ease;
		-ms-transition: all 500ms ease;
		-o-transition: all 500ms ease;
		transition: all 500ms ease;
		background: rgba(48, 46, 45, 1);
		border-color: #ff5252;
	}
	#particles-js{
	  	width: 100%;
	  	height: 100%;
	  	background-size: cover;
	  	background-position: 50% 50%;
	  	position: fixed;
	  	top: 0px;
	  	z-index:1;
	}
	#particles-js {
	    background:#fff url(../developer/lib/images/background.jpg);
	    width: 100%;
	    height: 100%;
	    background-size: cover;
	    background-position: 50% 50%;
	    position: fixed;
	    top: 0px;
	    z-index: 1;
	}
  </style>
  <style>
 
</style>
 </head>
<body>


<div class="container">
	<div id="login-box" class="col-xs-10 col-sm-6 col-md-4 col-lg-3">
		<div class="logo">
			<img src="<?=base_url()?>lib/images/main_logo.png" class="img img-responsive center-block" />
			<h1 class="logo-caption"><span class="tweak">L</span>ogin</h1>
		</div><!-- /.logo -->
		<div class="controls"><form class="cmxform" id="commentForm" method="get" action="">
			<div class="input-group">				
				<span class="input-group-addon bg-dark"><i class="glyphicon glyphicon-user"></i></span>				
				<input type="text" name="username" placeholder="Username" class="form-control" />
			</div>
			<div class="input-group-text">
				<div class="input-group">
					<span class="input-group-addon bg-dark"><i class="glyphicon glyphicon-lock"></i></span>	
					<input type="password" name="password" placeholder="Password" class="form-control mb-3" />
				</div>
			</div>
			<button type="submit" id="login" class="btn btn-primary btn-block">Login</button>
            </form>
		</div><!-- /.controls -->
	</div><!-- /#login-box -->
</div><!-- /.container -->
<div id="particles-js"></div>



<script src="<?php echo base_url();?>lib/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>lib/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>lib/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>lib/js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>lib/js/particles.js"></script>
<script>

$(document).ready(function() {
	
	 $('#commentForm').validate({});
	 
	$("#login").click(function(event){
 		   event.preventDefault();
   	     if($("#commentForm").valid()){
  	        if(typeof FormData !== 'undefined') {
 			  var formData = new FormData( $("#commentForm")[0] );
			   
			  $.ajax({
			       url: "<?=base_url()?>index/loginvalidate", 
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
 						    url=  "<?=base_url()?>index/live_map";
						   window.location.href = url;
 					  }
 					 
				   }
			  });
          		 
		    }
		  else {
              alert("Your Browser Don't support FormData API! Use IE 10 or Above!");
          }  
 		}
  	 });
	
});

</script>
</body>
</html>