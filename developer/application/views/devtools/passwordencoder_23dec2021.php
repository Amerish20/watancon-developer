<!doctype html> 
<html> 
<head> 
    <title>GPS Users</title> 
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
             <h2 class="fwb text-center">GPS USERS</h2> 
        </div>
    </div> 
    <table class="table table-bordered table-striped" id="mytable"> 
        <thead> 
            <tr> 
                <th width="80px">No</th> 
                <th>Name</th> 
                <th>Username</th> 
                <th>Password</th> 
                <th>Usergroup</th> 
                <th>Status</th>
            </tr> 
        </thead> 
        <tbody> 
            <?php 
            $start = 0; 
            foreach ($passwords as $password) 
            { 
                ?> 
                <tr> 
                    <td> 
                        <?php echo ++$start ?> 
                    </td> 
                    <td> 
                        <?php echo $password['name'] ?> 
                    </td> 
                    <td> 
                        <?php echo $password['user_name'] ?> 
                    </td> 
                    <td> 
                        <?php echo $password['Password'] ?> 
                    </td> 
                    <td> 
                        <?php echo $password['usergroup'] ?> 
                    </td>
                    <td> 
                        <?php echo ($password['status']==1) ? 'Active':'Inactive'; ?> 
                    </td> 
                </tr> 
                <?php 
            } 
            ?> 
        </tbody> 
    </table> 
    <script type="text/javascript"> 
        $(document).ready(function() { 
            $("#mytable").dataTable(); 
        }); 
    </script> 
</body> 
</html>