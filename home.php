<!doctype html>
<html lang="en">
    <?php
    include_once 'action/checkLogin.php';
    
    $permissions = check_login($bd);
    if($permissions['bid']){
        header("Location: showAvailablebids.php");
    }
    ?>
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link href="https://fonts.googleapis.com/css?family=Baloo|Caudex|Happy+Monkey|Karma|Lilita+One|ABeeZee|Antic|Average|Khula|Montserrat+Alternates|Nanum+Gothic|Nobile|Nunito|Varela+Round|Zilla+Slab" rel="stylesheet">
        <link href="CSS/home.css" rel="stylesheet">
        <style>table.table.table-striped tbody tr:hover{background-color: gainsboro; cursor: pointer; }</style>
    </head>

    <body class="bg-light">
        <nav class="navbar fixed-top" style="background-color:#20a8f7;">
            <h2 class="navbar-brand" style="font-family:'Nunito';font-size:30px;color:white;">Bid Opportunities Admin</h2>
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

        <div>

            <div class="row" style="background:#ffff">
                <div class="col pt-6">
                    <span class="form-inline"><img src="public/billete.png"><h2>Solicitation</h2></span>
                </div>
                <div class="col pt-3" >
                    <div class="btn-group float-right" role="group">
					<a href="viewUser.php" class="btn btn-info px-auto float-auto mr-1"><i class="fas fa-users"></i> Manage Users</a>
                    <a href="bidderIdInput.php" class="btn btn-info px-auto float-auto mr-1"><i class="fas fa-eye"></i> Review Submissions</a>
                    <a href="propose.php" class="btn btn-success px-auto float-auto" ><i class="fas fa-plus"></i> Add Solicitation</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4" style="background:#ffff">
            <ul class="col nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Current</a>
                </li>
                <?php if($permissions['administrate'] || $permissions['author']): ?>
				<li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#drafts" role="tab" aria-controls="drafts" aria-selected="false">Drafts</a>
                </li>
                <?php endif;?>
                <?php if($permissions['administrate'] || $permissions['review']): ?>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#submits" role="tab" aria-controls="submits" aria-selected="false">Ready to Review</a>
                </li>
                <?php endif;?>
                <?php if($permissions['administrate'] || $permissions['approve']): ?>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Ready to Approve</a>
                </li>
                <?php endif;?>
                <?php if($permissions['administrate'] || $permissions['author']): ?>
				<li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#valids" role="tab" aria-controls="valids" aria-selected="false">Ready to Post</a>
                </li>
                <?php endif;?>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#awards" role="tab" aria-controls="awards" aria-selected="false">Awarded</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#archives" role="tab" aria-controls="archives" aria-selected="false">Archived</a>
                </li>
            </ul>
        </div>

        <div class="row pt-4" style="background:#ffff">
            <div class="tab-content" id="myTabContent" style="width: 100%">

                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table id="example" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Solicitation Title</th>
                                <th>Status</th>
                                <th>Final Filing Date</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Solicitation Title</th>
                                <th>Status</th>
                                <th>Final Filing Date</th>
                                <th>Last Updated</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="submits" role="tabpanel" aria-labelledby="submit-tab">
                    <table id="submit" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Solicitation Title</th>
                            <th>Status</th>
                            <th>Final Filing Date</th>
                            <th>Last Updated</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Solicitation Title</th>
                            <th>Status</th>
                            <th>Final Filing Date</th>
                            <th>Last Updated</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="drafts" role="tabpanel" aria-labelledby="draft-tab">
                    <table id="draft" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Solicitation Title</th>
                            <th>Status</th>
                            <th>Final Filing Date</th>
                            <th>Last Updated</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Solicitation Title</th>
                            <th>Status</th>
                            <th>Final Filing Date</th>
                            <th>Last Updated</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="awards" role="tabpanel" aria-labelledby="awards-tab">
                    <table id="award" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Solicitation Title</th>
                            <th>Status</th>
                            <th>Final Filing Date</th>
                            <th>Last Updated</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Solicitation Title</th>
                            <th>Status</th>
                            <th>Final Filing Date</th>
                            <th>Last Updated</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <table id="review" class="table justify-content-center table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Solicitation Title</th>
                                <th>Status</th>
                                <th>Final Filing Date</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Solicitation Title</th>
                                <th>Status</th>
                                <th>Final Filing Date</th>
                                <th>Last Updated</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="valids" role="tabpanel" aria-labelledby="valids-tab">
                    <table id="valid" class="table text-center table-striped table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Solicitation Title</th>
                            <th>Status</th>
                            <th>Final Filing Date</th>
                            <th>Last Updated</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Solicitation Title</th>
                            <th>Status</th>
                            <th>Final Filing Date</th>
                            <th>Last Updated</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="tab-pane fade" id="archives" role="tabpanel" aria-labelledby="archives-tab">
                    <table id="archive" class="table justify-content-center table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Solicitation Title</th>
                                <th>Status</th>
                                <th>Final Filing Date</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Solicitation Title</th>
                                <th>Status</th>
                                <th>Final Filing Date</th>
                                <th>Last Updated</th>
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
<script src="/JS/moment.js"></script>
<script src="http://cdn.datatables.net/plug-ins/1.10.16/dataRender/datetime.js"></script>

<script>
    $(document).ready(function () {

        $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "action/server_processing.php",
        "columnDefs": [
            {
                "targets": [5],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [3, 4],
                "render": $.fn.dataTable.render.moment( 'YYYY-MM-DD HH:mm:ss','MMM Do YYYY h:mm:ss A' )
            }
        ]
        });

        $('#draft').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "action/showDraft.php",
            "columnDefs": [
                {
                    "targets": [5],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [3, 4],
                    "render": $.fn.dataTable.render.moment( 'YYYY-MM-DD HH:mm:ss','MMM Do YYYY h:mm:ss A' )
                }
            ]
        });

        $('#submit').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "action/showSubmitted.php",
            "columnDefs": [
                {
                    "targets": [5],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [3, 4],
                    "render": $.fn.dataTable.render.moment( 'YYYY-MM-DD HH:mm:ss','MMM Do YYYY h:mm:ss A' )
                }
            ]
        });

        $('#award').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "action/showAward.php",
            "columnDefs": [
                {
                    "targets": [5],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [3, 4],
                    "render": $.fn.dataTable.render.moment( 'YYYY-MM-DD HH:mm:ss','MMM Do YYYY h:mm:ss A' )
                }
            ]
        });

            $('#review').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "action/showReviewed.php",
                "columnDefs": [
                    {
                        "targets": [5],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [3, 4],
                        "render": $.fn.dataTable.render.moment( 'YYYY-MM-DD HH:mm:ss','MMM Do YYYY h:mm:ss A' )
                    }
                ]
            });

        $('#valid').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "action/showValidated.php",
            "columnDefs": [
                {
                    "targets": [5],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [3, 4],
                    "render": $.fn.dataTable.render.moment( 'YYYY-MM-DD HH:mm:ss','MMM Do YYYY h:mm:ss A' )
                }
            ]
        });

        $('#archive').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "action/showArchived.php",
            "columnDefs": [
                {
                    "targets": [5],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [3, 4],
                    "render": $.fn.dataTable.render.moment( 'YYYY-MM-DD HH:mm:ss','MMM Do YYYY h:mm:ss A' )
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
            window.location = "opportunity.php?id=" + rowData[5];
        }

    });
});
</script>
</body>
</html>
