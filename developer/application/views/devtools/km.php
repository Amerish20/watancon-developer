<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
  .loading {
  display: inline-block;
  width: 50px;
  height: 50px;
  border: 3px solid rgba(255,255,255,.3);
  border-radius: 50%;
  border-top-color: #3f51b5;
  animation: spin 1s ease-in-out infinite;
  -webkit-animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}
</style>
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
  </script>
<!-- Include Moment.js CDN -->
  <script type="text/javascript" src=
"https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js">
  </script>
  <!-- Include Bootstrap DateTimePicker CDN -->
  <link
    href=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
    rel="stylesheet">
  <script src=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container">
    <h2 class="fwb text-center">KM Update</h2>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="first">Fleet Type</label>
          <select class="form-control" id="fleettype">
            <option>Select Fleet Type</option>
            <?php foreach($departmentdata as $departmentdata) { ?>
            <option value="<?php echo $departmentdata['id']?>"><?php echo $departmentdata['name'] ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-6" id="fleetdiv">
        <div class="form-group">
          <label for="first">Fleet</label>
          <select class="form-control" id="fleet">
          </select>
        </div>
      </div>
      
    </div>   
    <br>
     <div class="row" id="odo">
      <div class="col-md-2"></div>
      <div class="col-md-8 text-center">
         <input type="text" id="odometer" class="form-control" name="odometer" placeholder="Odometer" required>
        </div>
      </div>
    </div>  
   <br>
    <div class="text-center">
      <button class="btn btn-primary" id="fleetsubmit">Submit</button>
    </div>
</div>
<br>
<script type="text/javascript">
  $(document).ready(function()
  {

    $("#fleetdiv").hide();
    $("#odo").hide();
    $("#loading").hide();
    $("#fleetsubmit").prop('disabled', true);
    $('#fleettype').select2();
    $('#fleet').select2();
    
    $("#fleettype").change(function()
    {
      $("#loading").show();
      var fleettype = $("#fleettype").val();
      if(fleettype != "" && fleettype != undefined && fleettype != "Select Fleet Type")
      {
        $.ajax({
          url: "<?=base_url()?>Devtools/getfleetdata", 
          data:{fleettype:fleettype},
          method: "POST",
          success: function(result)
          {
            $("#loading").hide();     
            $("#fleet").empty();       
            var data = $.parseJSON(result); 
            $("#fleet").append(new Option("Select Fleet", ""));            
            $.each(data, function(key, value) {
              $("#fleet").append(new Option(value.description, value.id));
            });  
            $("#fleet").select2("destroy");
            $('#fleet').select2();                 
          }
        });
        $("#fleetdiv").show();
        $("#odo").show();        
        $("#fleetsubmit").prop('disabled', false);
        
      }
      else
      {
        $("#loading").hide();
        $("#fleetdiv").hide();
        $("#odo").hide();
        $("#fleetsubmit").prop('disabled', true);
        
      }      
    });


    $("#fleetsubmit").click(function()
    {   
       
        $("#loading").show();
        var odometer = $("#odometer").val();
        var fleetid = $("#fleet").val();
        if(fleetid != "" && fleetid != undefined && fleetid != "Select Fleet" && odometer != "" )
        {
          $.ajax({
            url: "<?=base_url()?>Devtools/updateKM", 
            data:{fleetid:fleetid,odometer:odometer},
            method: "POST",
            success: function(result)
            {     
              $("#loading").hide();       
              var data = $.parseJSON(result); 
              //console.log(data);
              if(data.errorflag == "1")
              {
                alert(data.error_message);
              }
              else
              {
                if(data.sendsms_flag == "1"){
                  alert(data.sendsms_message);
                } else {
                  alert(data.sendsms_message);
                }

              }                           
            }
          });
        }
        else
        {
          $("#loading").hide();
        }
    });

  });

</script>