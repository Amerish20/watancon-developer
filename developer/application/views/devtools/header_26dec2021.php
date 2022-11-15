<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
  
  .blue
  {
    background-color: #3f51b5 !important;
  }
  .white
  {
    color: white !important;
  }
  .fwb
  {
    font-weight: bold !important;
  }

</style>

<head>
  <title>DevTools</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<nav class="navbar navbar-default blue">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      </button>
      <a class="navbar-brand white fwb" href="<?=base_url()?>devtools/">DEV TOOLS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav fwb">
        <li><a href="<?=base_url()?>devtools/datadecoder" class="white">Row Data Decoder </a></li>
        <li><a href="<?=base_url()?>devtools/fleetdata" class="white">Fleet Last Data</a></li>
        <li><a href="<?=base_url()?>devtools/vehiclestatus" class="white">Fleet Status</a></li>
      </ul> 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

