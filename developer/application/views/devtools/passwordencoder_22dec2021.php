<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css"></style>

<div class="container">
    <h2 class="fwb text-center">GPS USERS</h2>
    <hr>
</div>
<br>
<div class="container">
  <div class="col-md-12">
    <table class="table table-bordered table-striped fwb" id="resulttable">
      <thead>
          <tr class="blue white">          
          <th>Name</th>
          <th>Username</th>
          <th>Password</th>
          <th>Usergroup</th>
          </tr>
      </thead>
      <tbody id="tablebody">
        <?php  foreach ($passwords as $password) 
          {
        ?>
          <tr>
            <td><?php echo $password['name'] ?> </td>
            <td><?php echo $password['user_name'] ?> </td>
            <td><?php echo $password['Password'] ?> </td>
            <td><?php echo $password['usergroup'] ?> </td>
          </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>