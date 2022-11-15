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
  .barname{
    margin-top: 12px;
    position: absolute;
    right: 150px;
    color: white !important;
    font-size: 17;
  }
  .barlogout{
    margin-top: 12px;
    position: absolute;
    right: 70px;
    font-size: 17;
    text-decoration: none;
  }
</style>

<head>
  <title>DevTools</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>lib/js/sweetalert.min.js"></script>
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
        <li><a href="<?=base_url()?>devtools/passwords" class="white">User List</a></li>
        <!-- <li><a href="<?=base_url()?>devtools/dbcompare" class="white">DB Compare</a></li> -->
        <li><a href="<?=base_url()?>devtools/vehcount" class="white">Fleet Count</a></li>
        <li><a href="<?=base_url()?>devtools/simcount" class="white">SIM Count</a></li>
        <li><a href="<?=base_url()?>devtools/gncount" class="white">GN Count</a></li>
        <li><a href="<?=base_url()?>devtools/dis" class="white">D,I,S,G Count</a></li>
        <li><a href="<?=base_url()?>devtools/gnupdate" class="white">GN Update</a></li>
      </ul> 
      <span class="barname"><?php if($this->session->userdata('username')){ echo ucfirst($this->session->userdata('username'));}?></span>
      &nbsp;&nbsp;
      <span class="barlogout"><a href="<?=base_url()?>devtools/logout" class="white" style="text-decoration: none;">Logout</a></span>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

