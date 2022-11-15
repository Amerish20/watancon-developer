<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- <link rel="stylesheet" href="<?=base_url("assests/css/blackbar.css")?>"> -->
<!-- <div class="navbar">
  <a href="<?=base_url()?>devtools/gnsimserialnumber">GN Sim Serial Numbers</a>
</div> -->
<input type="button" class="btn btn-success" style="margin-left: 20px;" onclick="location.href='<?=base_url()?>devtools/gnsimserialnumber';" value="GN Sim Serial Numbers" />
  <div class="container">
      <h2 class="fwb text-center">GN Count</h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total</th>
        <th>Active</th>
        <th>Inactive</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $gncount[0]['total_gn']; ?></td>
        <td><?php echo $gncount[0]['active']; ?></td>
        <td><?php echo $gncount[0]['inactive']; ?></td>
      </tr>
      
      </tbody>
    </table>
    
  </div>

  <br>
   <div class="container">
      <h2 class="fwb text-center">GN Active Stationwise Count</h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Id</th>
        <th>Station</th>
        <th>Count</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if(!empty($finaledata)) {
        $i=1;
        foreach ($finaledata as $key => $value) { 
          $total +=$value['station_count'];
        ?>  
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $value['station_name']; ?></td>
        <td><?php echo $value['station_count']; ?></td>
      </tr>
      <?php 
       $i++; 
        }
      } if(!empty($finaledata)) { ?>

        <tr>
        <td></td>
        <td style="text-align: right"><b>Total</b></td>
        <td><b><?php echo $total; ?></b></td>
        </tr>
      <?php }?>
      </tbody>
    </table>
    
  </div>
  

 




  