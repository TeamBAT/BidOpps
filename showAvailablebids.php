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
        <style>tbody tr:hover{cursor: pointer; }</style>
    </head>

    <body style="background: #8a8a5c">
        
        <?php 
        require_once('action/connection.php');
        ?>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Download Documents</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                            <?php $opportunity_id = $_GET['OppId'];
                             echo $opportunity_id?>
							<p>You can download and view documents individually by selecting each link, or you can download all of the files in a .zip format below</p>
                            <a href="action/bidderDownloadFile.php?id=<?=$opportunity_id?>" >Download all files</a><span>(Zip)</span>
				                <!--Document Display Module goes here-->  
								<h5 style="color:#5f6266" class="mt-3">Solicitation Documents</h5>
                                <table id="documents" class="table table-striped table-bordered mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Posted Date</th>
                                        </tr>
                                    </thead>
                                    
                                    <?php
									// Fetches rows from the $documents mysqli result to populate table
									$query1 = "SELECT * FROM opportunity_docs WHERE opportunity_id = ".$opportunity_id." AND subheading='Solicitation Documents'";
                                    $SolicitationDocuments = mysqli_query($bd, $query1);
                                    if(mysqli_num_rows($SolicitationDocuments) > 0):
                                    while($SolicitationDocument = mysqli_fetch_assoc($SolicitationDocuments)): ?>
									<tr>
                                    <td><a href="<?php echo $SolicitationDocument['directory']; ?>"><?php echo $SolicitationDocument['filename']; ?></a></td>
                                    <td><?php echo $SolicitationDocument['posted_date']; ?></td>
                                    <?php endwhile; else: echo "<td>No files found.</td><td></td>"; endif; 
                                    //End fetch rows
                                    ?>
									</tr>
                                </table>
								<h5 style="color:#5f6266" class="mt-3">Addenda</h5>
                                <table id="documents" class="table table-striped table-bordered mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Posted Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									// Fetches rows from the $documents mysqli result to populate table
									$query2 = "SELECT * FROM opportunity_docs WHERE opportunity_id = ".$opportunity_id." AND subheading='Addenda'";
                                    $Addenda = mysqli_query($bd, $query2);
                                    if(mysqli_num_rows($Addenda) > 0 ):
                                    while($Addendas = mysqli_fetch_assoc($Addenda)): ?>
									<tr>
                                    <td><a href="<?php echo $Addendas['directory']; ?>"><?php echo $Addendas['filename']; ?></a></td>
                                    <td><?php echo $Addendas['posted_date']; ?></td>
                                    </tr>
                                    <?php endwhile; else: echo "<td>No files found.</td><td></td>"; endif; 
                                    //End fetch rows
                                    ?>
									</tr>
									</tbody>
                                </table>
								<h5 style="color:#5f6266" class="mt-3">Required Attachments</h5>
                                <table id="documents" class="table table-striped table-bordered mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Posted Date</th>
                                        </tr>
                                    </thead>
                                    
                                    <?php
									// Fetches rows from the $documents mysqli result to populate table
									$query3 = "SELECT * FROM opportunity_docs WHERE opportunity_id = ".$opportunity_id." AND subheading='Required'";
                                    $requiredAttachments = mysqli_query($bd, $query3);
                                    if( mysqli_num_rows($requiredAttachments) > 0 ):
                                    while($requiredAttachment = mysqli_fetch_assoc($requiredAttachments)): ?>
									<tr>
                                    <td><a href="<?php echo urldecode($requiredAttachment['directory']); ?>"><?php echo $requiredAttachment['filename']; ?></a></td>
                                    <td><?php echo $requiredAttachment['posted_date']; ?></td>
									</tr>
                                    <?php endwhile; else: echo "<td>No files found.</td><td></td>"; endif; 
                                    //End fetch rows
                                    ?>
									
                                </table>
								<h5 style="color:#5f6266" class="mt-3">Exhibits</h5>
                                <table id="documents" class="table table-striped table-bordered mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Posted Date</th>
                                        </tr>
                                    </thead>
                                    
                                    <?php
									// Fetches rows from the $documents mysqli result to populate table
									$query4 = "SELECT * FROM opportunity_docs WHERE opportunity_id = ".$opportunity_id." AND subheading='Exhibits'";
                                    $exhibits = mysqli_query($bd, $query4);
                                    if(mysqli_num_rows($exhibits) > 0 ):
                                    while($exhibit = mysqli_fetch_assoc($exhibits)): ?>
									<tr>
                                    <td><a href="<?php echo $exhibit['directory']; ?>"><?php echo $exhibit['filename']; ?></a></td>
                                    <td><?php echo $exhibit['posted_date']; ?></td>
									</tr>
                                    <?php endwhile; else: echo "<td>No files found.</td><td></td>"; endif; 
                                    //End fetch rows
                                    ?>
                                </table>
        </div>
      </div>
    </div>
  </div>


</main><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function () {
    var table = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "action/bidderShowDetail.php",
        "columnDefs": [
            {
                "targets": [5],
                "visible": false,
                "searchable": false
            }
        ]
    });
    $('#example tbody').on( 'click', 'tr', function () {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var rowData = table.row( this ).data();
            $('#exampleModal').modal('toggle');
            var SelectedRw=rowData[5];
            var dataString = 'OppId='+ SelectedRw;
            alert(SelectedRw);
            $.ajax({ 
                
                type: "GET",
                data: dataString,
                cache: false,
                success: function(result){
                    
                }
            });
    });
})
</script>
</body>
</html>
