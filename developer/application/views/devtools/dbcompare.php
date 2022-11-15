<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<div class="container"> -->


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <form class="form-inline" action="dbcompare" method="post">
         <div class='col-sm-3'>
            <div class="form-group">
            <label for="email">From:</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' name="from" class="form-control" required/>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            </div>
        </div>
        <div class='col-sm-3'>
            <div class="form-group">
            <label for="email">To:</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' name="to" class="form-control" required />
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            </div>
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
    </form>

<?php 
if(isset($newdb) && isset($olddb)) { ?>
    <div class="container">
      <h2 class="fwb text-center">Database compare</h2>
    <hr>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="blue white">
        <th>Date range</th>
        <th>Live(watancongps_trackingsystem) Count</th>
        <th>Old(old_data_watancongps_trackingsystem) Count</th>
        </tr>
      </thead>
      <tbody>
      <tr>
        <td><?=$fromdate.' to '.$todate?></td>
        <td><?=$newdb?></td>
        <td><?=$olddb?></td>
      </tr>
      </tbody>
    </table>
  </div>
<?php } ?>


<script type="text/javascript">
    $(function () {
   var bindDatePicker = function() {
        $(".date").datetimepicker({
        format:'YYYY-MM-DD',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
    }
  
   bindDatePicker();
 });
</script>