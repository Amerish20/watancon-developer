<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title><?=$heading?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="<?=base_url()?>lib/images/fav-icon.png" type="image/png">
      <link rel="stylesheet" href="<?=base_url()?>lib/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?=base_url()?>lib/css/bootstrap-datetimepicker.min.css">
      <link rel="stylesheet" href="<?=base_url()?>lib/css/date.css">
      <link rel="stylesheet" href="<?=base_url()?>lib/css/bootstrap-select.css">
      <link rel="stylesheet" href="<?=base_url()?>lib/css/jquery.selectBoxIt.css">
      <link rel="stylesheet" href="<?=base_url()?>lib/fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" href="<?=base_url()?>lib/css/interface.css">
      <link rel="stylesheet" href="<?=base_url()?>lib/css/scrollbar.css">
      <link rel="stylesheet" href="<?=base_url()?>lib/css/menu.css">
      <link rel="stylesheet" href="<?=base_url()?>lib/css/style.css">
      <link rel="stylesheet" href="<?=base_url()?>lib/css/responsive.css">
      <script type="text/javascript">
      window.addEventListener("storage",function(){
		   var logoutevent=localStorage.getItem('logout-event');
		   console.log(logoutevent);
		   if(logoutevent=="logout"){
			   manuallogout();
		   }
 	  });
	  
	  var i=0;
	  function manuallogout() {
		  url=  "<?php echo  base_url(); ?>";
		  window.location.href = url; 
	   
	  }
     </script>
   </head>
   <body class="scrollbar" id="style-2">
      <div id="container" >
         <div id="nav" class="dark-shadow">
            <nav class="navbar navbar-inverse">
               <div class="container-fluid">
                  <div class="navbar-header">
                     <div class="navTrigger">
                        <i></i><i></i><i></i>
                     </div>
                     <div class="mainmenu minterface blue-shadow">
                        <a href="<?=base_url()?>index/live_map" data-toggle="tooltip" data-placement="bottom" title="Interface" style="text-decoration:none; color:#CCC; font-size:10px; font-family: Raleway,sans-serif;">
                        <img src="<?=base_url()?>lib/images/master/map.png" class="img-responsive" >
                        <span></span>
                        </a>
                     </div>
                     <?php
                        if(!empty($masters_data)){
                         foreach($masters_data as $master_key=>$master_data){?>
                     <div class="mainmenu mmaster blue-shadow">
                     
                        <?php
 						 $controller=$master_data['controller']!="Defaultmaster"?$master_data['controller']:$master_data['controller']."?id=1";
 						?>
                        <a href="<?=base_url().$controller?>" data-toggle="tooltip" data-placement="bottom" title="<?=$master_data['master']?>" style="text-decoration:none; color:#CCC; font-size:10px; font-family: Raleway,sans-serif;">
                        <img src="<?=base_url()?>lib/images/master/<?=$master_data['id']?>.png" class="img-responsive"  >
                        <span></span>
                        </a>
                     </div>
                     <?php }
                        }
						if($report_status=="1"){
 						?>
                     <div class="mainmenu mreport blue-shadow">
                        <a href="<?=base_url()?>reports" data-toggle="tooltip" target="_blank" data-placement="bottom" title="reports" style="text-decoration:none; color:#CCC; font-size:10px; font-family:Verdana, Geneva, sans-serif">
                        <img src="<?=base_url()?>lib/images/master/report.png" class="img-responsive"  >
                        <span></span>
                        </a>
                     </div>
                     <?php } ?>
                     <div class="header-logo">
                        <img src="<?=base_url()?>lib/images/main_logo.png" class="img-responsive logo-icon" >
                        <span class="txt-head">Al Wataniya Concrete</span>
                     </div>
                     <div class="page-head">
                     <a  href="#" ><i class="<?=$page_head_icon?>"></i><?=$heading?></a>
                  </div> 
                  <div class="username-align"> Welcome <span><?=ucfirst(strtolower($this->session->userdata("name")))?></span></div>
                  <div class="logout">
                  <a href="#" class="text-danger"><i class="fa fa-sign-out"></i></a>
               </div>    
                  </div>
                            
               
               </div>
               </nav>
         </div>
         
      </div>