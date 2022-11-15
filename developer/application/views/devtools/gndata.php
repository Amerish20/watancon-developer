<!doctype html> 
<html> 
<head> 
    <title>GN Data</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <!--data table--> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/r-2.1.0/datatables.min.css" /> 
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/r-2.1.0/datatables.min.js"></script> 
    <!--/.data table--> 
    <style> 
        body { 
            padding: 15px; 
        } 
    </style> 
</head> 
<body> 
    <div class="row" style="margin-bottom: 10px"> 
        <div class="col-md-12"> 
             <h2 class="fwb text-center">GN Data</h2> 
        </div>
    </div> 
    <table class="table table-bordered table-striped" id="mytable"> 
        <thead> 
            <tr> 
                <th width="80px">No</th> 
                <th>Id</th> 
                <th>Name</th> 
                <th>Description</th> 
                <th>Station name</th> 
                <th>Station id(EPA)</th> 
                <th>Edit</th> 
            </tr> 
        </thead> 
        <tbody> 
            
            <?php 
            $start = 0; 
            foreach ($finaledata as $fetchdata) 
            { 
                $id = $fetchdata['id'];
                $name = $fetchdata['name'];
                $gnepaid = $fetchdata['generator_station_id'];
                $station_id = $fetchdata['station_id'];
                ?> 
                <tr> 
                    <td> 
                        <?php echo ++$start ?> 
                    </td> 
                    <td> 
                        <?php echo $fetchdata['id'] ?> 
                    </td> 
                    <td> 
                        <?php echo $fetchdata['name'] ?> 
                    </td> 
                    <td> 
                        <?php echo $fetchdata['description'] ?> 
                    </td> 
                    <td> 
                        <?php echo $fetchdata['station_name'] ?> 
                    </td> 
                    <td> 
                        <?php echo $fetchdata['generator_station_id'] ?> 
                    </td>
                    
                    <td>
                            <button class="btn btn-success btn-sm rounded-0" type="button" 
                            data-placement="top" data-toggle="modal" onclick='getValue("<?php echo $id ?>","<?php echo $name ?>","<?php echo $gnepaid ?>","<?php echo $station_id ?>");' title="Edit"><i class="fa fa-edit"></i>
                            </button>
                    </td>
                    <input type="hidden" name="idforupdate" id="idforupdate" value="">
                </tr> 
                <?php 
            } 
            ?>  
        </tbody> 
    </table> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="modal-title">Station Id(EPA)</h5>
        <input class="modalTextInput form-control" id="epastationid" />
      </div>
      <div class="modal-body">
            <label>Station (GPS)</label>
            <select class="form-control" id="station_name">
              <option value="">Select station</option>
               <?php
                foreach($stations as $datastations) { ?>
                  <option value="<?= $datastations['id'] ?>"><?= $datastations['station_name']; ?></option>
              <?php
                } ?>
            </select>
        </div>
      <div class="modal-footer">
        <button type="button" class="saveEdit btn btn-primary" id="gnupdateid">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <script type="text/javascript"> 
        $(document).ready(function() { 
          // $("#mytable").dataTable({
          //   // dom: 'Blfrtip',
          //   // buttons: [
          //   //     'copy', 'csv', 'excel', 'pdf', 'print'
          //   // ]
          // } );
        }); 

        function getValue(id,name,gnepaid,station_id){
            //console.log(id);
            $('#exampleModal').modal('show');
            $('#exampleModalLabel').text(name);
            $('#epastationid').val(gnepaid);
            $('#idforupdate').val(id);
            $('#station_name').val(station_id);
        }

        $("#gnupdateid").click(function(e) {
            var gnepaid = $('#epastationid').val();
            var station_name = $('#station_name').val();
            var idforupdate = $('#idforupdate').val();
            $.ajax({
                url: "<?=base_url()?>Devtools/changegnid",
                data: { 
                    idforupdate: idforupdate, 
                    gnepaid: gnepaid,
                    station_name: station_name
                },
                method: 'POST',
                success: function(response) {
                  if(response){
                    $("#exampleModal").modal('hide');
                      swal({
                         title: "Success!",
                         text:'Station Id(EPA) has been updated successfully',
                         icon: "success",
                         button: "ok",
                      }).then(function(){ 
                        location.reload();
                      });
                  } else{
                    console.log(response);
                  }
                
                }
            });
        });
    </script> 
</body> 

</html>