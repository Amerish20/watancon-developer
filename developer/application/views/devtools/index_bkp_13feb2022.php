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