<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css"></style>

<div class="container">
    <h2 class="fwb text-center">ROW DATA DECODER</h2>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="first">Row Data</label>
          <input type="text" class="form-control" placeholder="Enter Row Data" id="rowdata" >
        </div>
      </div>
    </div>
    <div class="alert alert-danger text-center" id="norowdata">
    </div>
    <div class="text-center">
      <button class="btn btn-primary" id="datadecoder">Submit</button>
    </div>
</div>
<br>
<div class="container">
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

<script type="text/javascript">
  $(document).ready(function()
  {
    $("#norowdata").hide();
    $("#resulttable").hide();

    $("#datadecoder").click(function()
    {
      $("#norowdata").hide();
      $("#resulttable").hide();

      var rowdata       = ($("#rowdata").val()).trim();
      var rowdatalength = rowdata.length;

      if(rowdata == "" || rowdata == undefined)
      {
        $("#norowdata").html("<strong>Please Enter Row Data</strong>");
        $("#norowdata").show();
      }
      else if( rowdatalength <= "72")
      {
        $("#norowdata").html("<strong> Row Data Format is Invalid </strong>");
        $("#norowdata").show();
      }
      else
      {
        $("#norowdata").hide();
        $.ajax({
          url: "<?=base_url()?>Devtools/process_row_data", 
          data:{rowdata:rowdata},
          method: "POST",
          success: function(result)
          {            
            $("#tablebody").empty();
            var data = $.parseJSON(result); 
            $.each(data, function(key, value) {
              var content = "<tr> <td>"+ key + "</td><td>"+ value + "</td></tr>";
              $("#tablebody").append(content);
            });
            $("#resulttable").show();
          }
        });
      }
    });
  });
</script>