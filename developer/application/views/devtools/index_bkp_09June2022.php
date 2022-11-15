<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container">
      <?php
      if(count($file) > 0)
      {
      ?>
      <h2 class="fwb text-center">GPS BACKUP FILES</h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Filename</th>
        <th>Created Date</th>
        <th>Size</th>
        </tr>
      </thead>
      <tbody>
      <?php
      foreach ($file as $file) 
      {
        if($file['name'] != "restoration.sh")
        {
      ?>
      <tr>
        <td><?php echo $file['name']; ?></td>
        <td><?php echo $file['date']; ?></td>
        <td><?php echo $file['size']; ?></td>
      </tr>
      <?php
        } 
      }
      ?>
      </tbody>
    </table>
    <?php 
      } 
      ?>
  </div>

  <br><br>
  <div class="container">
      <h2 class="fwb text-center">OLD DATABASE LAST INSERT DATE </h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>DB Name</th>
        <th>Last insert Date</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?= $dbname='old_data_watancongps_trackingsystem'; ?></td>
        <td><?= date("Y-m-d H:i:s",($olddbdate[0]['device_timestamp']/1000)) ?></td>
      </tr>
      </tbody>
    </table>
  </div>