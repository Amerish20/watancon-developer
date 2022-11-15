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

<div class="container">
  <h2 class="fwb text-center">FLEET STATUS</h2>
  <hr>
  <div class="col-md-12 text-center">
    <div id="loading" class="loading"></div>
  </div>
  <div class="col-md-2"></div>
  <div class="col-md-7" id="chartdiv" class="chartdiv">
    <canvas id="oilChart"></canvas>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">
  $(document).ready(function()
  {
    $("#loading").show();
    $("#chartdiv").hide();
    $.ajax({
      url: "<?=base_url()?>Index/vehiclestatusgraph",
      method: "POST",
      success: function (response) 
      {
        $("#loading").hide();
        var dataresult = $.parseJSON(response);
        var oilCanvas = document.getElementById("oilChart");
        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 18;

        var oilData = {
            labels: [
                "Running",
                "Ignition ON",
                "Stop",
                "Workshop",
                "Longstop",
            ],
            datasets: [
                {
                    data: [dataresult.runningcount, dataresult.idlecount, dataresult.stopcount, dataresult.workshopcount,
                         dataresult.longstopcount],
                    backgroundColor: [
                        "#32CD32",
                        "orange",
                        "red",              
                        "blue",
                        "black"
                    ]
                }]
        };

        var pieChart = new Chart(oilCanvas, {
          type: 'pie',
          data: oilData
        });
        $("#chartdiv").show();
      }
    });
  });
</script>