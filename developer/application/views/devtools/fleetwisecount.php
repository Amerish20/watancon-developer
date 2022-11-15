 <div class="container">
      <h2 class="fwb text-center"><u>Active Fleet(Excluded Test) Wise Count</u></h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
          <th>Fleets</th>
          <th>Count</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td>Truck Mixer</td>
        <td><?php echo $fleetwisecount[0]['tm']; ?></td>
      </tr>
        <tr>
        <td>Head Tailer</td>
        <td><?php echo $fleetwisecount[0]['ht']; ?></td>
      </tr>
        <tr>
        <td>Concrete Pump</td>
        <td><?php echo $fleetwisecount[0]['cp']; ?></td>
      </tr>
        <tr>
        <td>Bus</td>
        <td><?php echo $fleetwisecount[0]['bus']; ?></td>
      </tr>
        <tr>
        <td>Wheel Loader</td>
        <td><?php echo $fleetwisecount[0]['wl']; ?></td>
      </tr>
        <tr>
        <td>Fork Lift</td>
        <td><?php echo $fleetwisecount[0]['fork']; ?></td>
      </tr>
        <tr>
        <td>Skid Loader</td>
        <td><?php echo $fleetwisecount[0]['sl']; ?></td>
      </tr>
        <tr>
        <td>Telescopic Handler</td>
        <td><?php echo $fleetwisecount[0]['th']; ?></td>
      </tr>
        <tr>
        <td>Pick-Up</td>
        <td><?php echo $fleetwisecount[0]['pick']; ?></td>
      </tr>
        <tr>
        <td>Car</td>
        <td><?php echo $fleetwisecount[0]['car']; ?></td>
      </tr>
        <tr>
        <td>Truck</td>
        <td><?php echo $fleetwisecount[0]['truck']; ?></td>
      </tr>
        <tr>
        <td>Stationary Pump</td>
        <td><?php echo $fleetwisecount[0]['sp']; ?></td>
      </tr>
        <tr>
        <td>JEC</td>
        <td><?php echo $fleetwisecount[0]['jec']; ?></td>
      </tr>
        <tr>
        <td>MOB-Workshop</td>
        <td><?php echo $fleetwisecount[0]['wshop']; ?></td>
      </tr>
        <tr>
        <td>Generator</td>
        <td><?php echo $fleetwisecount[0]['gn']; ?></td>
      </tr>
      <tr>
        <td>Backoe-Loader</td>
        <td><?php echo $fleetwisecount[0]['backoe']; ?></td>
      </tr> 
       <tr style="background: red;">
        <td><b>Total</b></td>
        <td><b><?php echo $fleetwisecount[0]['total_cnt']; ?></b></td>
      </tr> 
      </tbody>
    </table>
    
  </div>


  <br><br>
  <div class="container">
      <h2 class="fwb text-center"><u>Inactive Fleet(Excluded Test) Wise Count</u></h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
          <th>Fleets</th>
          <th>Count</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td>Truck Mixer</td>
        <td><?php echo $inactivefleetwisecount[0]['tm']; ?></td>
      </tr>
      <tr>
        <td>Head Tailer</td>
        <td><?php echo $inactivefleetwisecount[0]['ht']; ?></td>
      </tr>
      <tr>
        <td>Concrete Pump</td>
        <td><?php echo $inactivefleetwisecount[0]['cp']; ?></td>
      </tr>
      <tr>
        <td>Bus</td>
        <td><?php echo $inactivefleetwisecount[0]['bus']; ?></td>
      </tr>
      <tr>
        <td>Wheel Loader</td>
        <td><?php echo $inactivefleetwisecount[0]['wl']; ?></td>
      </tr>
      <tr>
        <td>Fork Lift</td>
        <td><?php echo $inactivefleetwisecount[0]['fork']; ?></td>
      </tr>
      <tr>
        <td>Skid Loader</td>
        <td><?php echo $inactivefleetwisecount[0]['sl']; ?></td>
      </tr>
      <tr>
        <td>Telescopic Handler</td>
        <td><?php echo $inactivefleetwisecount[0]['th']; ?></td>
      </tr>
      <tr>
        <td>Pick-Up</td>
        <td><?php echo $inactivefleetwisecount[0]['pick']; ?></td>
      </tr>
      <tr>
        <td>Car</td>
        <td><?php echo $inactivefleetwisecount[0]['car']; ?></td>
      </tr>
      <tr>
        <td>Truck</td>
        <td><?php echo $inactivefleetwisecount[0]['truck']; ?></td>
      </tr>
      <tr>
        <td>Stationary Pump</td>
        <td><?php echo $inactivefleetwisecount[0]['sp']; ?></td>
      </tr>
      <tr>
        <td>JEC</td>
        <td><?php echo $inactivefleetwisecount[0]['jec']; ?></td>
      </tr>
      <tr>
        <td>MOB-Workshop</td>
        <td><?php echo $inactivefleetwisecount[0]['wshop']; ?></td>
      </tr>
      <tr>
        <td>Generator</td>
        <td><?php echo $inactivefleetwisecount[0]['gn']; ?></td>
      </tr>
      <tr>
        <td>Backoe-Loader</td>
        <td><?php echo $inactivefleetwisecount[0]['backoe']; ?></td>
      </tr> 
      <tr style="background: red;">
        <td><b>Total</b></td>
        <td><b><?php echo $inactivefleetwisecount[0]['total_cnt']; ?></b></td>
      </tr> 
      </tbody>
    </table>
    
  </div>