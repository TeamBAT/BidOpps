<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Solicitation</title>

        <!-- Bootstrap core CSS -->
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="CSS/home.css" rel="stylesheet">
        <style>table.table.table-striped tbody tr:hover{background-color: gainsboro; cursor: pointer; }</style>
    </head>

    <body style="background: #8a8a5c">
        <?php session_start(); ?>
        <nav class="navbar navbar-dark bg-primary fixed-top">
            <h3 class="navbar-brand">Bid Opportunities Admin</h3>
            <div class="dropdown pr-5">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <?php echo $_SESSION['SESS_FIRST_NAME'] ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="action/adminLogout.php">Logout</a></li>
                </ul>
            </div>  
        </nav>
    <main role="main" class="container">

        <div class="row pt-4" style="background:#ffff">
            <div class="tab-content" id="myTabContent" style="width: 100%">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table id="example" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>    
        </div>



</main><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function () {
    var table = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "action/GetAllBidder.php",
        "columnDefs": [
            {
                "targets": [5],
                "visible": false,
                "searchable": false
            }
        ]
    });

    $('#example tbody').on('click', 'tr', function () {

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var rowData = table.row(this).data();
            window.location = "submission.php?id=" + rowData[5];
        }

    });
});
</script>
</body>
</html>
