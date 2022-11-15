
<div class="container">
  <form class="form-horizontal" action="<?=base_url()?>devtools/editpost" method="POST">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">ERP Device:</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="erp_device" placeholder="ERP Device" name="erp_device" value="<?php echo $dis[0]['ERP_devices'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">ERP Ibutton:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="erp_ibutton" placeholder="ERP Ibutton" name="erp_ibutton" value="<?php echo $dis[0]['ERP_ibutton'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">ERP Sim:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="erp_sim" placeholder="ERP Sim" name="erp_sim" value="<?php echo $dis[0]['ERP_sim'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Issued Devices:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="issued_devices" placeholder="Issued Devices" name="issued_devices" value="<?php echo $dis[0]['issued_devices'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Damaged Devices:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="damaged_devices" placeholder="Damaged Devices" name="damaged_devices" value="<?php echo $dis[0]['damaged_devices'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Spare Devices:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="spare_devices" placeholder="Spare Devices" name="spare_devices" value="<?php echo $dis[0]['not_used_devices'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">No Info Devices:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="no_info_device" placeholder="No Info Devices" name="no_info_device" value="<?php echo $dis[0]['police_scrap_devices'] ?>">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Devices Notes:</label>
      <div class="col-sm-2">
      <textarea id="device_notes" name="device_notes" rows="4" cols="50"><?php echo $dis[0]['device_notes'] ?></textarea>          
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Issued Ibutton:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="issued_ibutton" placeholder="Issued Ibutton" name="issued_ibutton" value="<?php echo $dis[0]['issued_ibutton'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Damaged Ibutton:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="damaged_ibutton" placeholder="Damaged Ibutton" name="damaged_ibutton" value="<?php echo $dis[0]['damaged_ibutton'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Not Used Ibutton:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="not_used_ibutton" placeholder="Not Used Ibutton" name="not_used_ibutton" value="<?php echo $dis[0]['not_used_ibutton'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Ibutton Notes:</label>
      <div class="col-sm-2">
      <textarea id="ibutton_notes" name="ibutton_notes" rows="4" cols="50"><?php echo $dis[0]['ibutton_notes'] ?></textarea>          
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Issued Sim:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="issued_sim" placeholder="Issued Sim" name="issued_sim" value="<?php echo $dis[0]['issued_sim'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Damaged sim:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="damaged_sim" placeholder="Damaged sim" name="damaged_sim" value="<?php echo $dis[0]['damaged_sim'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">New Sim:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="new_sim" placeholder="New Sim" name="new_sim" value="<?php echo $dis[0]['new_sim'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Active Sim Not Used:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="active_sim_not_used" placeholder="Active Sim Not Used" name="active_sim_not_used" value="<?php echo $dis[0]['active_sim_not_used'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Sim Notes:</label>
      <div class="col-sm-2">
      <textarea id="sim_notes" name="sim_notes" rows="4" cols="50"><?php echo $dis[0]['sim_notes'] ?></textarea>          
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Generator Box:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="generator_box" placeholder="Generator Box" name="generator_box" value="<?php echo $dis[0]['generator_box'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Generator Relay:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="generator_relay" placeholder="Generator Relay" name="generator_relay" value="<?php echo $dis[0]['generator_relay'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Generator Relay Outer:</label>
      <div class="col-sm-2">          
        <input type="text" class="form-control" id="generateo_relay_outer" placeholder="Generator Relay Outer" name="generateo_relay_outer" value="<?php echo $dis[0]['generateo_relay_outer'] ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Generator Notes:</label>
      <div class="col-sm-2">
      <textarea id="gn_notes" name="gn_notes" rows="4" cols="50"><?php echo $dis[0]['gn_notes'] ?></textarea>          
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>


