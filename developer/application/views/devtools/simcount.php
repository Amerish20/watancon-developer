<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container">
      <h2 class="fwb text-center">SIM Count</h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total</th>
        <th>Vodafone</th>
        <th>Ooredoo</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $simcount[0]['total_sim']; ?></td>
        <td><?php echo $simcount[0]['vodafone']; ?></td>
        <td><?php echo $simcount[0]['ooredoo']; ?></td>
      </tr>
      
      </tbody>
    </table>
    
  </div>

 <br><br>
  <div class="container">
      <h2 class="fwb text-center">SIM Status Count</h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total</th>
        <th>Active</th>
        <th>Inactive</th>
        <th>Inuse</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $statuscount[0]['total_status_sim']; ?></td>
        <td><?php echo $statuscount[0]['active']; ?></td>
        <td><?php echo $statuscount[0]['inactive']; ?></td>
        <td><?php echo $statuscount[0]['inuse']; ?></td>
      </tr>
      
      </tbody>
    </table>
    
  </div>

  <br><br>
  <div class="container">
      <h2 class="fwb text-center">Vodafone Count</h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total</th>
        <th>Active</th>
        <th>Inactive</th>
        <th>Inuse</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $simvodafonecount[0]['total_vodafone_sim']; ?></td>
        <td><?php echo $simvodafonecount[0]['active']; ?></td>
        <td><?php echo $simvodafonecount[0]['inactive']; ?></td>
        <td><?php echo $simvodafonecount[0]['inuse']; ?></td>
      </tr>
      
      </tbody>
    </table>
    
  </div>

  <br><br>
  <div class="container">
      <h2 class="fwb text-center">Ooredoo Count</h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total</th>
        <th>Active</th>
        <th>Inactive</th>
        <th>Inuse</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $simooredocount[0]['total_oorderoo_sim']; ?></td>
        <td><?php echo $simooredocount[0]['active']; ?></td>
        <td><?php echo $simooredocount[0]['inactive']; ?></td>
        <td><?php echo $simooredocount[0]['inuse']; ?></td>
      </tr>
      
      </tbody>
    </table>
    
  </div>

  