<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- <link rel="stylesheet" href="<?=base_url("assests/css/blackbar.css")?>"> -->
<!-- <div class="navbar">
  <a href="<?=base_url()?>devtools/gnsimserialnumber">GN Sim Serial Numbers</a>
</div> -->
<input type="button" class="btn btn-success" style="margin-left: 20px;" onclick="location.href='<?=base_url()?>devtools/editdis';" value="Edit" />
  <div class="container">
    <div class="col-md-6">
        <div class="form-group">
          <label for="first">Select Type</label>
          <select class="form-control" id="list">
            <option value="1">FMB-120 DEVICES</option>
            <option value="2">Ibutton</option>
            <option value="3">SIM</option>
           <option value="4">Generator</option>
          </select>
        </div>
      </div>
    <br>
    <table class="table table-bordered table-striped" id="fm120device">
      <thead>
        <tr class="blue white">
        <th>Id</th>
        <th>ERP Device</th>
        <th>Issued Devices</th>
        <th>Damaged Devices</th>
        <th>Spare Devices</th>
        <th>No Info Devices</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $dis[0]['id']; ?></td>
        <td><?php echo $dis[0]['ERP_devices']; ?></td>
        <td><?php echo $dis[0]['issued_devices']; ?></td>
        <td><?php echo $dis[0]['damaged_devices']; ?></td>
        <td><?php echo $dis[0]['not_used_devices']; ?></td>
        <td><?php echo $dis[0]['police_scrap_devices']; ?></td>
      </tr>
      
      </tbody>
    </table>
    <div id="device_notes" style="word-wrap: break-word;">
    <?php if($dis[0]['device_notes'] != '') { ?>
     <h4><u>Note</u></h4>
     <p style="color: red"><?php echo $dis[0]['device_notes']; ?></p>
    <?php } ?>
    </div>
     <table class="table table-bordered table-striped" style="display:none;" id="ibutton">
      <thead>
        <tr class="blue white">
        <th>Id</th>
        <th>ERP Ibutton</th>
        <th>Issued Ibutton</th>
        <th>Damaged Ibutton</th>
        <th>Not Used Ibutton</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $dis[0]['id']; ?></td>
        <td><?php echo $dis[0]['ERP_ibutton']; ?></td>
        <td><?php echo $dis[0]['issued_ibutton']; ?></td>
        <td><?php echo $dis[0]['damaged_ibutton']; ?></td>
        <td><?php echo $dis[0]['not_used_ibutton']; ?></td>
      </tr>
      
      </tbody>
    </table>
    <div id="ibutton_notes" style="display:none;word-wrap: break-word;">
    <?php if($dis[0]['ibutton_notes'] != '') { ?>
     <h4><u>Note</u></h4>
     <p style="color: red"><?php echo $dis[0]['ibutton_notes']; ?></p>
    <?php } ?>
    </div>
     <table class="table table-bordered table-striped" style="display:none;" id="sim">
      <thead>
        <tr class="blue white">
        <th>Id</th>
        <th>ERP Sim</th>
        <th>Issued Sim</th>
        <th>Damaged sim</th>
        <th>New Sim</th>
        <th>Active Sim Not Used</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $dis[0]['id']; ?></td>
        <td><?php echo $dis[0]['ERP_sim']; ?></td>
        <td><?php echo $dis[0]['issued_sim']; ?></td>
        <td><?php echo $dis[0]['damaged_sim']; ?></td>
        <td><?php echo $dis[0]['new_sim']; ?></td>
        <td><?php echo $dis[0]['active_sim_not_used']; ?></td>
      </tr>
      
      </tbody>
    </table>
    <div id="sim_notes" style="display:none;word-wrap: break-word;">
    <?php if($dis[0]['sim_notes'] != '') { ?>
     <h4><u>Note</u></h4>
     <p style="color: red"><?php echo $dis[0]['sim_notes']; ?></p>
    <?php } ?>
    </div>
     <table class="table table-bordered table-striped" style="display:none;" id="generator">
      <thead>
        <tr class="blue white">
        <th>Id</th>
        <th>Generator Box</th>
        <th>Generator Relay</th>
        <th>Generator Relay outer</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?php echo $dis[0]['id']; ?></td>
        <td><?php echo $dis[0]['generator_box']; ?></td>
        <td><?php echo $dis[0]['generator_relay']; ?></td>
        <td><?php echo $dis[0]['generateo_relay_outer']; ?></td>
      </tr>
      
      </tbody>
    </table>
    <div id="gn_notes" style="display:none;word-wrap: break-word;" >
    <?php if($dis[0]['gn_notes'] != '') { ?>
     <h4><u>Note</u></h4>
     <p style="color: red"><?php echo $dis[0]['gn_notes']; ?></p>
    <?php } ?>
    </div>
  </div>

  <script type="text/javascript">
    $( document ).ready(function() {
      $("#fm120device").show();
      $("#device_notes").show();
      $("#ibutton").hide();
      $("#sim").hide();
      $("#generator").hide();
      $("#ibutton_notes").hide();
      $("#sim_notes").hide();
      $("#gn_notes").hide();

      $("#list").on('change', function() {
        if(this.value == 1) {
          $("#fm120device").show();
          $("#device_notes").show();
          $("#ibutton").hide();
          $("#sim").hide();
          $("#generator").hide();
          $("#ibutton_notes").hide();
          $("#sim_notes").hide();
          $("#gn_notes").hide();
        } else if(this.value == 2) {
          $("#ibutton").show();
          $("#ibutton_notes").show();
          $("#fm120device").hide();
          $("#sim").hide();
          $("#generator").hide();
          $("#device_notes").hide();
          $("#sim_notes").hide();
          $("#gn_notes").hide();
        } else if(this.value == 3) {
          $("#ibutton").hide();
          $("#fm120device").hide();
          $("#sim").show();
          $("#sim_notes").show();
          $("#generator").hide();
          $("#device_notes").hide();
          $("#ibutton_notes").hide();
          $("#gn_notes").hide();
        } else if(this.value == 4) {
          $("#ibutton").hide();
          $("#fm120device").hide();
          $("#sim").hide();
          $("#generator").show();
          $("#sim_notes").hide();
          $("#device_notes").hide();
          $("#ibutton_notes").hide();
          $("#gn_notes").show();
        }
      });
    });
  </script>

  
  

 




  