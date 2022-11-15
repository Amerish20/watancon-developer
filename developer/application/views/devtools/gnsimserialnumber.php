<!doctype html> 
<html> 
<head> 
    <title>Active GN sim serial numbers list</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <!--data table--> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/r-2.1.0/datatables.min.css" /> 
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/r-2.1.0/datatables.min.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
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
             <h2 class="fwb text-center">Active GN sim serial numbers list</h2> 
        </div>
    </div> 
    <table class="table table-bordered table-striped" id="mytable"> 
        <thead> 
            <tr> 
                <th>No</th> 
                <th>Asset code</th>
                <th>Description</th>
                <th>Status</th>
                <th>Sim Serial Number</th>
            </tr> 
        </thead> 
        <tbody> 
            <?php 
            $start = 0; 
            foreach ($gnsimserialnumber as $datasimserialnumber) 
            { 
                ?> 
                <tr> 
                    <td> 
                        <?php echo ++$start ?> 
                    </td> 
                    <td> 
                        <?php echo $datasimserialnumber['asset_code']; ?> 
                    </td> 
                    <td> 
                        <?php echo $datasimserialnumber['description']; ?> 
                    </td> 
                    <td> 
                        <?php echo ($datasimserialnumber['status'] == '1') ? 'Active':'Inactive'; ?> 
                    </td> 
                    <td> 
                        <?php echo $datasimserialnumber['sim_serial']; ?> 
                    </td>
                </tr> 
                <?php 
            } 
            ?> 
        </tbody> 
    </table> 
    <script type="text/javascript"> 
        $(document).ready(function() { 
          $("#mytable").dataTable({
            dom: 'Blfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
            buttons: [
              'print',
            ]
          } );
        }); 
    </script> 
</body> 
</html>