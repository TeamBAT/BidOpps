<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

        <title>Show Available Bids</title>

        <!-- Bootstrap core CSS -->
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Baloo|Caudex|Happy+Monkey|Karma|Lilita+One|ABeeZee|Antic|Average|Khula|Montserrat+Alternates|Nanum+Gothic|Nobile|Nunito|Varela+Round|Zilla+Slab" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="CSS/home.css" rel="stylesheet">
        <style>tbody tr:hover{cursor: pointer; }</style>
</head>

    <body>

        <?php
        require_once('action/connection.php');
        ?>
        <nav class="navbar fixed-top" style="background-color:#20a8f7;">
            <h2 class="navbar-brand" style="font-size:30px;font-family:'Nunito';color:white;">Bid Opportunities Admin</h2>
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

    <div class="row mt-4" style="background:#ffff">
        <ul class="col nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                   aria-selected="true">Current Opportunities</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#submissions-tab" role="tab"
                   aria-controls="contact" aria-selected="false">My Submissions</a>
            </li>
        </ul>
    </div>

    <div class="row pt-4" style="background:#ffff">
        <div class="tab-content" id="home-content" style="width: 100%">

            <!-- Bidder Home Tab -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table id="example" class="table text-center table-striped table-bordered" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Opportunity Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Final Filing Date</th>
                        <th>Last Updated</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>Opportunity Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Final Filing Date</th>
                        <th>Last Updated</th>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Bidder Submissions Tab -->
            <div class="tab-pane fade" id="submissions-tab" role="tabpanel"
                 aria-labelledby="submissions-tab">
                <table id="bidderSubmissionTable" class="table text-center table-striped table-bordered"
                       style="width: 100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Solicitation Title</th>
                        <th>Status</th>
                        <th>Last Updated</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Solicitation Title</th>
                        <th>Status</th>
                        <th>Last Updated</th>
                    </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</main>
<!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="JS/moment.js"></script>
<script src="http://cdn.datatables.net/plug-ins/1.10.16/dataRender/datetime.js"></script>
<script>
    $(document).ready(function () {

        //Table defs
        var table = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "action/bidderShowDetail.php",
            "columnDefs": [
                {
                    "targets": [5],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [4, 3],
                    "render": $.fn.dataTable.render.moment( 'YYYY-MM-DD HH:mm:ss','MMM Do YYYY h:mm:ss A' )
                }
            ]
        });

        var submissionTable = $('#bidderSubmissionTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "action/showBidderSubmissions.php",
            "columnDefs": [
                {
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [3],
                    "render":  $.fn.dataTable.render.moment( 'YYYY-MM-DD HH:mm:ss','MMM Do YYYY h:mm:ss A' )
                }
            ]
        });

        //Clickable tables
        $('#example tbody').on('click', 'tr', function () {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var rowData = table.row(this).data();
            var SelectedRw = rowData[5];
            window.location = 'opportunity.php?id=' + SelectedRw;
        });

        $('#bidderSubmissionTable tbody').on('click', 'tr', function () {
            submissionTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            let rowData = submissionTable.row(this).data();
            let selectedRow = rowData[0];
            window.location = 'submission.php?id=' + selectedRow;
        });
    })
</script>
</body>
</html>
