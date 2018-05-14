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
        <link href="https://fonts.googleapis.com/css?family=Baloo|Caudex|Happy+Monkey|Karma|Lilita+One|ABeeZee|Antic|Average|Khula|Montserrat+Alternates|Nanum+Gothic|Nobile|Nunito|Varela+Round|Zilla+Slab" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>table.table.table-striped tbody tr:hover{background-color: gainsboro; cursor: pointer; }</style>
    </head>

    <body>
        <?php
            require_once 'action/connection.php';
            require_once 'action/checkLogin.php';

            $permissions = check_login($bd);
            if($permissions['bid']) header("Location: home.php");
        ?>
        <nav class="navbar fixed-top" style="background-color:#20a8f7;"> 
            <a href="home.php" style="text-decoration:none;"><p></p><h2 style="font-size:30px;font-family:'Nunito';color:white;"><i class="fa fa-home"></i> Bid Opportunities Admin</h2><p></p></a>
            <div class="dropdown pr-5">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <?php echo $_SESSION['SESS_FIRST_NAME'] ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="action/adminLogout.php">Logout</a></li>
                </ul>
            </div>
        </nav> <br/>
    <main role="main" class="container">

        <div class="row mt-4" style="background:#ffff">
            <ul class="col nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Current</a>
                </li>
                <?php if($permissions['administrate'] || $permissions['screen']): ?>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#submitTab" role="tab" aria-controls="drafts" aria-selected="false">Waiting for Screening</a>
                    </li>
                <?php endif;?>
                <?php if($permissions['administrate'] || $permissions['evaluate']): ?>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#screenTab" role="tab" aria-controls="submits" aria-selected="false">Waiting for Evaluation</a>
                    </li>
                <?php endif;?>
                <?php if($permissions['administrate'] || $permissions['finalize']): ?>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#evaluatedTab" role="tab" aria-controls="reviews" aria-selected="false">Waiting for Finalization</a>
                    </li>
                <?php endif;?>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#awardedTab" role="tab" aria-controls="awards" aria-selected="false">Awarded</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#deniedTab" role="tab" aria-controls="archives" aria-selected="false">Denied</a>
                </li>
            </ul>
        </div>

        <div class="row pt-4" style="background:#ffff">
            <div class="tab-content" id="myTabContent" style="width: 100%">


                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table id="all" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Category</th>
                                <th>Opportunity Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Category</th>
                                <th>Opportunity Title</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="submitTab" role="tabpanel" aria-labelledby="submitted-tab">
                    <table id="submitted" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Category</th>
                            <th>Opportunity Title</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Category</th>
                            <th>Opportunity Title</th>
                            <th>Status</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="screenTab" role="tabpanel" aria-labelledby="screened-tab">
                    <table id="screened" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Category</th>
                            <th>Opportunity Title</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Category</th>
                            <th>Opportunity Title</th>
                            <th>Status</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="evaluatedTab" role="tabpanel" aria-labelledby="evaluated-tab">
                    <table id="evaluated" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Category</th>
                            <th>Opportunity Title</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Category</th>
                            <th>Opportunity Title</th>
                            <th>Status</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="awardedTab" role="tabpanel" aria-labelledby="awarded-tab">
                    <table id="awarded" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Category</th>
                            <th>Opportunity Title</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Category</th>
                            <th>Opportunity Title</th>
                            <th>Status</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="deniedTab" role="tabpanel" aria-labelledby="home-tab">
                    <table id="denied" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Category</th>
                            <th>Opportunity Title</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Category</th>
                            <th>Opportunity Title</th>
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
    $('#all').DataTable({
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

    $('#submitted').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "action/showUploaded.php",
        "columnDefs": [
            {
                "targets": [5],
                "visible": false,
                "searchable": false
            }
        ]
    });

    $('#screened').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "action/showScreened.php",
        "columnDefs": [
            {
                "targets": [5],
                "visible": false,
                "searchable": false
            }
        ]
    });

    $('#evaluated').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "action/showEvaluated.php",
        "columnDefs": [
            {
                "targets": [5],
                "visible": false,
                "searchable": false
            }
        ]
    });

    $('#awarded').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "action/showAwardedBids.php",
        "columnDefs": [
            {
                "targets": [5],
                "visible": false,
                "searchable": false
            }
        ]
    });

    $('#denied').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "action/showDenied.php",
        "columnDefs": [
            {
                "targets": [5],
                "visible": false,
                "searchable": false
            }
        ]
    });

    $('table tbody').on('click', 'tr', function () {

        let tbl = $(this).closest('table').DataTable();

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tbl.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var rowData = tbl.row(this).data();
            window.location = "submission.php?id=" + rowData[5];
        }

    });
});
</script>
</body>
</html>
