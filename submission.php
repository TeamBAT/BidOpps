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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </head>

  <body style="background: #8a8a5c">
  
<?php
	include_once('action/connection.php');
	include_once('action/checkLogin.php');
	
	if(isset($_GET['id'])){
            
            //Fetch submission
            $submission_id = mysqli_real_escape_string($bd, $_GET['id']);
            $query = "SELECT * FROM submissions WHERE id = '".$submission_id."'";
            
            $result = mysqli_query($bd, $query);
            if(!$result) echo "Submission could not be fetched.";
            else if (mysqli_num_rows($result) == 0 ) $noResult = true;
            else{
                    $submission = mysqli_fetch_assoc($result);
            }
            mysqli_free_result($result);
            
            //Fetch Opportunity
            $opportunity_id = $submission['opportunity_id'];
            $query = "SELECT * FROM opportunities WHERE id = '".$opportunity_id."'";
            
            $result = mysqli_query($bd, $query);
            if(!$result) echo "Opportunity could not be fetched.";
            else if (mysqli_num_rows($result) == 0 ) $noResult = true;
            else{
                    $opportunity = mysqli_fetch_assoc($result);
            }
            mysqli_free_result($result);
            
            //Fetch Documents
            $query = "SELECT * FROM opportunity_docs WHERE opportunity_id = ".$opportunity_id."";
            
            $result = mysqli_query($bd, $query);
            if(!$result) echo "Documents could not be fetched.";
            else{
                $documents = mysqli_fetch_assoc($result);
            }
            mysqli_free_result($result);
            
            //Fetch Bidder
            $query = "SELECT * FROM users JOIN bidders WHERE id = ".$submission['bidder_id'];
            
            $result = mysqli_query($bd, $query);
            if(!$result) echo "Bidder could not be found.";
            else{
                $bidder = mysqli_fetch_assoc($result);
            }
            mysqli_free_result($result);
            
            //Check Permissions
            $query = "SELECT * FROM permissions WHERE user_id = ".$_SESSION['SESS_MEMBER_ID']."";
  
            $result = mysqli_query($bd, $query);
            if(!$result) echo "Permissions could not be checked.";
            else{
                $permissions = mysqli_fetch_assoc($result);
            }
            mysqli_free_result($result);
            
        }
        else{
            header("Location: home.php");
        }
	
?>
	<nav class="navbar navbar-dark bg-primary fixed-top">
	 <h3 class="navbar-brand">Bid Opportunities</h3>
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
                    <div class="card-header">Bid Submission Review</div>
			<div class="card-body">
                            <?php if(isset($noResult)): echo "Submission 'id = ".$submission_id."' does not exist."; else: ?>
                            <h5>Opportunity Number</h5> <?=$opportunity['number']; ?><br><hr>
                            <h5>Title</h5> <?=$opportunity['title']; ?><br><hr>
                            <h5>Type</h5> <?=$opportunity['type']; ?><br><hr>
                            <h5>Bidder Information</h5> 
                            <h6>Name:</h6><?=$bidder['firstname']." ".$bidder['lastname']; ?><br>
                            <br><h6>Business:</h6><?=$bidder['business'];?><hr>
                            <h5>Status</h5> <?=$submission['status']; ?><br>
                            <hr>
                            <h5>Documents</h5>
				<!--Document Display Module goes here-->
				
			</div>
			<div class="card-footer">
                            <a class="btn btn-info" href="home.php"><i class="fas fa-home"></i> Home</a>
				<!-- Options to display based on user and status -->
                                <?php if($submission['status'] != 'Finalized' && ($permissions['administrate'] || $permissions['screen']) || $permissions['evaluate'] || $permissions['finalize']): ?>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal"><i class="fas fa-ban"></i> Archive</button>
                                <?php endif; if($opportunity['status'] == 'Submitted' && ($permissions['administrate'] || $permissions['review'])): ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#reviewModal"><i class="far fa-paper-plane"></i> Review</button>
                                <?php elseif($opportunity['status'] == 'Reviewed' && ($permissions['administrate'] || $permissions['approve'])): ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal"><i class="far fa-paper-plane"></i> Approve</button>
				<?php elseif($opportunity['status'] == 'Validated' && ($permissions['administrate']|| $permisssions['author'])): ?>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#awardModal"><i class="far fa-paper-plane"></i> Post</button>
                                <?php endif; ?>
			</div>
                    <?php endif; ?>
		</div>
		
		<!-- Cancel Submission Modal -->
		<div id="cancelModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center">Are you sure you want to deny this submission?</h4>
				</div>
				<div class="modal-body">
					This submission will be removed from the submission process and archived.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Cancel</button>
                                        <button type="submit" class="btn btn-danger" name="remove" value="remove"><i class="fas fa-ban"></i> Remove</button>
				</div>
			</div>
		</div>
		</div>
		
		<!--Screener Modal-->
		<div id="reviewModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Review Submission</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					Modal Body To Be Made
					<div class="textbox"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Cancel</button>
					<button type="submit" class="btn btn-success" name="review" value="review"><i class="far fa-paper-plane"></i> Submit for Approval</button>
				</div>
			</div>
		</div>
		</div>
		
		<!-- Evaluator Modal -->
		<div id="approveModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Approve Submission</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					Modal Body To Be Made
					<div class="textbox"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Cancel</button>
                                        <button type="submit" class="btn btn-success" name="approve" value="approve"><i class="far fa-paper-plane"></i> Approve for Publish</button>
				</div>
			</div>
		</div>
		</div>
		
		<!-- Finalizer Modal -->
		<div id="awardModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Are you sure you want to post this bid?</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Cancel</button>
					<button type="submit" class="btn btn-success" name="post" value="post"><i class="far fa-paper-plane"></i> Post</button>
				</div>
			</div>
		</div>
		</div>
		
	</div>
      
      <script>
        $(document).ready(function(){
             $(':submit').click(function(){
                 var clickBtnValue = $(this).val();
                 var ajaxurl = 'action/submission_process.php',
                 data =  {'action': clickBtnValue,
                          'id': "<?=$submission_id?>"
                };
                 $.post(ajaxurl, data, function (response) {
                     location.reload();
                     alert(response);
                 });
             });
         });
      </script>

  </body>
</html>