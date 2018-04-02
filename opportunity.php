<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Opportunity</title>

    <!-- Bootstrap core CSS -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="CSS/home.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </head>

  <body style="background: #8a8a5c">
  
<?php
	include_once('action/connection.php');
	include_once('action/checkLogin.php');
	
	if(isset($_GET['id'])){
	
	$opportunity_id = mysqli_real_escape_string($bd, $_GET['id']);
	$query = "SELECT * FROM opportunities WHERE id = '".$opportunity_id."'";
	
	$result = mysqli_query($bd, $query);
	if(!$result) echo "Database could not be reached.";
	else{
		$opportunity = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
	}
}
	
?>
	<nav class="navbar navbar-dark bg-primary fixed-top">
	 <h3 class="navbar-brand">Bid Opportunities Admin</h3>
	 <div class="dropdown pr-5">
		  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		   <?php echo  $_SESSION['SESS_FIRST_NAME']   ?>
		 <span class="caret"></span>
		 </button>
		 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		 <li><a href="action/adminLogout.php">Logout</a></li>
		 </ul>
	  </div>
	</nav>
	
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">Bid Opportunity Review</div>
			<div class="card-body">
				Solicitation Number: <?=$opportunity['number']; ?><br>
				Title: <?=$opportunity['title']; ?><br>
				Type: <?=$opportunity['type']; ?><br>
				Description: <?=$opportunity['description']; ?><br>
				Status: <?=$opportunity['status']; ?><br>
				<br>
				Documents:
				<!--Document Display Module goes here-->
				
			</div>
			<div class="card-footer">
				<a class="btn btn-danger" href="home.php" role="button">Back</a>
				
				<!-- Requires PHP logic to determine who is logged in for which buttons to display -->
				<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cancelModal">Remove</button>
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#reviewModal">Review</button>
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#approveModal">Approve</button>
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#postModal">Post</button>
			</div>
		</div>
		
		<!-- Cancel Opportunity -->
		<div id="cancelModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center">Are you sure you want to cancel this opportunity?</h4>
				</div>
				<div class="modal-body">
					This opportunity will be removed from the submission process.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-warning">Remove</button>
				</div>
			</div>
		</div>
		</div>
		
		<!--Reviewer Modal-->
		<div id="reviewModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Review Submission</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					Modal Body Here
					<div class="textbox"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-success">Submit for Approval</button>
				</div>
			</div>
		</div>
		</div>
		
		<!-- Approver Modal -->
		<div id="approveModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Approve Submission</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					Modal Body Here
					<div class="textbox"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-success">Approve for Publish</button>
				</div>
			</div>
		</div>
		</div>
		
		<!-- Author Post Modal -->
		<div id="postModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Are you sure you want to post this bid?</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-success">Post</button>
				</div>
			</div>
		</div>
		</div>
		
	</div>
		
  </body>