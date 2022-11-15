<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--   <div class="navbar">
  <a href="<?=base_url()?>devtools/simserialnumber">Fleets Sim Serial Numbers</a>
  </div> -->
  <input type="button" class="btn btn-success" style="margin-left: 20px;" onclick="location.href='<?=base_url()?>devtools/simserialnumber';" value="Fleets Sim Serial Numbers" />
  <input type="button" class="btn btn-success" style="margin-left: 20px;" onclick="location.href='<?=base_url()?>devtools/fleetwisecount';" value="Fleet wise count" />

  <div class="container">
      <h2 class="fwb text-center"><u>Fleets(Included GN,Excluded Test) Count</u></h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total Fleets</th>
        <th>Active Fleets</th>
        <th>Inactive Fleets</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $vehcount[0]['total_veh']; ?></td>
        <td><?php echo $vehcount[0]['active_veh']; ?></td>
        <td><?php echo $vehcount[0]['inactive_veh']; ?></td>
      </tr>
      
      </tbody>
    </table>
    
  </div>

  <br><br>
  <div class="container">
      <h2 class="fwb text-center"><u>AWC(Included GN,Excluded Test) & JEC Active Fleets Count</u></h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total Active Fleets</th>
        <th>AWC Active Fleets</th>
        <th>JEC  Active Fleets</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $awc_jec_count[0]['total_awc_jec']; ?></td>
        <td><?php echo $awc_jec_count[0]['awc']; ?></td>
        <td><?php echo $awc_jec_count[0]['jec']; ?></td>
      </tr>
      
      </tbody>
    </table>
    
  </div>

  <br><br>
  <div class="container">
      <h2 class="fwb text-center"><u>AWC(Included GN,Excluded Test) & JEC Inactive Fleets Count</u></h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total Inactive Fleets</th>
        <th>AWC Inactive Fleets</th>
        <th>JEC  Inactive Fleets</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $awc_jec_inactive_count[0]['total_inactive_awc_jec']; ?></td>
        <td><?php echo $awc_jec_inactive_count[0]['inactive_awc']; ?></td>
        <td><?php echo $awc_jec_inactive_count[0]['inactive_jec']; ?></td>
      </tr>
      
      </tbody>
    </table>

    <br><br>
     <div class="container">
      <h2 class="fwb text-center"><u>Fleets(Excluded GN,Excluded Test) Count</u></h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total Fleets</th>
        <th>Active Fleets</th>
        <th>Inactive Fleets</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $vehcount_exclude[0]['total_veh']; ?></td>
        <td><?php echo $vehcount_exclude[0]['active_veh']; ?></td>
        <td><?php echo $vehcount_exclude[0]['inactive_veh']; ?></td>
      </tr>
      
      </tbody>
    </table>
    
  </div>

  <br><br>
  <div class="container">
      <h2 class="fwb text-center"><u>AWC(Excluded GN,Excluded Test) & JEC Active Fleets Count</u></h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total Active Fleets</th>
        <th>AWC Active Fleets</th>
        <th>JEC  Active Fleets</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $awc_jec_count_exclude[0]['total_awc_jec']; ?></td>
        <td><?php echo $awc_jec_count_exclude[0]['awc']; ?></td>
        <td><?php echo $awc_jec_count_exclude[0]['jec']; ?></td>
      </tr>
      
      </tbody>
    </table>
    
  </div>

  <br><br>
  <div class="container">
      <h2 class="fwb text-center"><u>AWC(Excluded GN,Excluded Test) & JEC Inactive Fleets Count</u></h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Total Inactive Fleets</th>
        <th>AWC Inactive Fleets</th>
        <th>JEC  Inactive Fleets</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $awc_jec_inactive_count_exclude[0]['total_inactive_awc_jec']; ?></td>
        <td><?php echo $awc_jec_inactive_count_exclude[0]['inactive_awc']; ?></td>
        <td><?php echo $awc_jec_inactive_count_exclude[0]['inactive_jec']; ?></td>
      </tr>
      
      </tbody>
    </table>
    
  </div>
 