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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container">
    <h2 class="fwb text-center">FLEET LAST DATA</h2>
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
              <th>PARAMETER</th>
              <th>VALUE</th>
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
    $("#fleetdiv").hide();
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
        if(fleetid != "" && fleetid != undefined && fleetid != "Select Fleet")
        {
          $("#nofleetdata").hide();
          $.ajax({
            url: "<?=base_url()?>Devtools/getfleetlastdata", 
            data:{fleetid:fleetid},
            method: "POST",
            success: function(result)
            {     
              $("#loading").hide();       
              $("#tablebody").empty();
              var data = $.parseJSON(result); 
              if(data.errorflag == "1")
              {
                $("#nofleetdata").html("<strong>No Data Available</strong>");
                $("#nofleetdata").show();
              }
              else
              {
                  $("#nofleetdata").hide();
                  $.each(data, function(key, value) {
                  var content = "<tr> <td>"+ key + "</td><td>"+ value + "</td></tr>";
                  $("#tablebody").append(content);
                  $("#resulttable").show();
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