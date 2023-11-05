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
    <h2 class="fwb text-center">EXCEED IDLE DATA</h2>
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
      <br>
          <div class="col-md-6" id="datetimepicker_div_1">
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker1'>
                      <label for="first">From Date</label>
                       <input type='text' class="form-control" name="from_date" id="from_date" />
                        <span class="input-group-addon">  
            <span class ="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
          </div>
     <br>
     <div class="col-md-6" id="datetimepicker_div_2">
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker2'>
                      <label for="first">To Date</label>
                        <input type='text' class="form-control" name="to_date" id="to_date" />
                        <span class="input-group-addon">  
            <span class ="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
    </div> 
    <br>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 text-center">
        <div class="alert alert-danger" id="nofleetdata">
        </div>
      </div>
    </div>   
    <br>
    <div class="text-center">
      <button class="btn btn-primary" id="fleetsubmit">Submit</button>
    </div>
    <br>
    <div class="container text-center">
      <div id="loading" class="loading"></div>
      <div class="col-md-12">
        <table class="table table-bordered table-striped fwb" id="resulttable">
          <thead>
              <tr class="blue white">
              <th>Id</th>
              <th>Table Id</th>
              <th>Vehicle Id</th>
              <th>Device Timestamp</th>
              <th>Lattitude</th>
              <th>Lognitude</th>
               <th>Speed</th>
               <th>Ign Status</th>
               <th>Satelite</th>
              </tr>
          </thead>
          <tbody id="tablebody">
          </tbody>
        </table>
      </div>
    </div>
</div>
<br>
 

<script type="text/javascript">
  $(document).ready(function()
  {

    $(function() {
        $('#datetimepicker1').datetimepicker();
        $('#datetimepicker2').datetimepicker();
    });

    $("#fleetdiv").hide();
    $("#datetimepicker_div_1").hide();
    $("#datetimepicker_div_2").hide();
    $("#nofleetdata").hide();
    $("#resulttable").hide();
    $("#loading").hide();
    $("#fleetsubmit").prop('disabled', true);
    $('#fleettype').select2();
    $('#fleet').select2();
    
    $("#fleettype").change(function()
    {
      $("#loading").show();
      $("#resulttable").hide();
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
        $("#datetimepicker_div_1").show();
        $("#datetimepicker_div_2").show();           
        $("#fleetsubmit").prop('disabled', false);
      }
      else
      {
        $("#loading").hide();
        $("#fleetdiv").hide();
        $("#fleetsubmit").prop('disabled', true);
      }      
    });

    $("#fleet").change(function()
    {
      $("#resulttable").hide();
      $("#nofleetdata").hide();
    });


    $("#fleetsubmit").click(function()
    {   
        $("#loading").show();
        var fleetid = $("#fleet").val();
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        if(fleetid != "" && fleetid != undefined && fleetid != "Select Fleet" && from_date != "" && to_date != "")
        {
          $("#nofleetdata").hide();
          $.ajax({
            url: "<?=base_url()?>Devtools/getExceedData", 
            data:{fleetid:fleetid,from_date:from_date,to_date:to_date},
            method: "POST",
            success: function(result)
            {     
              $("#loading").hide();       
              $("#tablebody").empty();
              var data = $.parseJSON(result); 
              //console.log(data);
              if(data.errorflag == "1")
              {
                $("#nofleetdata").html("<strong>No Data Available</strong>");
                $("#nofleetdata").show();
              }
              else
              {
                  $("#nofleetdata").hide();
                  var increment = 1;
                  $.each(data, function(key, value) {
                    var content = "<tr><td>"+ increment + "</td><td>"+ value.id + "</td><td>"+ value.vehicle_id + "</td><td>"+ value.device_timestamp + "</td><td>"+ value.lattitude + "</td><td>"+ value.lognitude + "</td><td>"+ value.speed + "</td><td>"+ value.ign_status + "</td><td>"+ value.satelite + "</td></tr>";
                  $("#tablebody").append(content);
                  $("#resulttable").show();
                  increment++;
                });
              }                           
            }
          });
        }
        else
        {
          $("#loading").hide();
          $("#nofleetdata").html("<strong>Please Select Fleet</strong>");
          $("#nofleetdata").show();
        }
    });

  });

</script>