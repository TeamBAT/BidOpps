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
            
            //Fetch Opportunity
            $opportunity_id = mysqli_real_escape_string($bd, $_GET['id']);
            $_SESSION['bidDocs']=$opportunity_id;
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
            
            $documents = mysqli_query($bd, $query);
            if(!$documents) echo "Documents couldn not be fetched.";
            
            //Check Permissions
            $query = "SELECT * FROM permissions WHERE user_id = ".$_SESSION['SESS_MEMBER_ID']."";
  
            $result = mysqli_query($bd, $query);
            if(!$result) echo "Permissions could not be checked.";
            else{
                $permissions = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
            }
            
        }
        else{
            header("Location: home.php");
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
                            <?php if(isset($noResult)): echo "Opportunity 'id = ".$opportunity_id."' does not exist."; else: ?>
                            <h5>Solicitation Number</h5> <?=$opportunity['number']; ?><br><hr>
                            <h5>Title</h5> <?=$opportunity['title']; ?><br><hr>
                            <h5>Type</h5> <?=$opportunity['type']; ?><br><hr>
                            <h5>Description</h5> <?= html_entity_decode($opportunity['description']); ?><hr>
                            <h5>Status</h5> <?=$opportunity['status']; ?><br>
                            <hr>
                            <h5 style="color:#5f6266">Download The Documents</h5>
							<p>You can download and view documents individually by selecting each link, or you can download all of the files in a .zip format below</p>
                            <a href="action/bidderDownloadFile.php" >Download all files</a><span>(Zip)</span>
				                <!--Document Display Module goes here-->  
                                <form action="action/AddendaDocsUpload.php" method='post' enctype="multipart/form-data" id="DocsUpload">
								<h5 style="color:#5f6266" class="mt-3">Solicitation Documents</h5>
                                <table id="documents" class="table table-striped table-bordered mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width:50%">File Name</th>
                                            <th style="width:25%">Posted Date</th>
                                            <th style="width:25%">Upload</th>
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
                                    <td><input type="file" name="file[]" />
                                    <!--sending data like subheading, title --> 
                                    <input type="hidden" name="subheading[]" value="Solicitation Documents"></td>

                                    <?php endwhile; else: echo '<td colspan="3">No files found.</td>'; endif; 
                                    //End fetch rows
                                    ?>
									</tr>
                                </table>
								<h5 style="color:#5f6266" class="mt-3">Addenda</h5>
                                <table id="documents" class="table table-striped table-bordered mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width:50%">File Name</th>
                                            <th style="width:25%">Posted Date</th>
                                            <th style="width:25%">Upload</th>
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
                                    <td><input type="file" name="file[]"/><input type="hidden" name="subheading[]" value="Addenda"></td>
                                    </tr>
                                    <?php endwhile; else: echo '<td colspan="3">No files found.</td>'; endif; 
                                    //End fetch rows
                                    ?>
									</tr>
									</tbody>
                                </table>
								<h5 style="color:#5f6266" class="mt-3">Required Attachments</h5>
                                <table id="documents" class="table table-striped table-bordered mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width:50%">File Name</th>
                                            <th style="width:25%">Posted Date</th>
                                            <th style="width:25%">Upload</th>
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
                                    <td><input type="file" name="file[]"/><input type="hidden" name="subheading[]" value="Required"></td>
                                    
									</tr>
                                    <?php endwhile; else: echo '<td colspan="3">No files found.</td>'; endif; 
                                    //End fetch rows
                                    ?>
									
                                </table>
								<h5 style="color:#5f6266" class="mt-3">Exhibits</h5>
                                <table id="documents" class="table table-striped table-bordered mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width:50%">File Name</th>
                                            <th style="width:25%">Posted Date</th>
                                            <th style="width:25%">Upload</th>
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
                                    <td><input type="file" name="file[]"/><input type="hidden" name="subheading[]" value="Exhibits"></td>
									</tr>
                                    <?php endwhile; else: echo '<td colspan="3">No files found.</td>'; endif; 
                                    //End fetch rows
                                    ?>
                                </table>
				
			</div>
			<div class="card-footer">
                            <a class="btn btn-info" href="home.php"><i class="fas fa-home"></i> Home</a>
                            <button type="button" class="btn btn-primary" id="submitDocs"><i class="fas fa-upload"></i> Upload Bidder</button>
				<!-- Options to display based on user and status -->
                                <?php if($opportunity['status'] != 'Posted' && $opportunity['status'] != 'Archived' && ($permissions['administrate'] || $permissions['author'])): ?>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal"><i class="fas fa-ban"></i> Archive</button>
                                <?php endif; if($opportunity['status'] == 'Submitted' && ($permissions['administrate'] || $permissions['review'])): ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#reviewModal"><i class="far fa-paper-plane"></i> Review</button>
                                <?php elseif($opportunity['status'] == 'Reviewed' && ($permissions['administrate'] || $permissions['approve'])): ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal"><i class="far fa-paper-plane"></i> Approve</button>
				<?php elseif($opportunity['status'] == 'Validated' && ($permissions['administrate']|| $permisssions['author'])): ?>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#postModal"><i class="far fa-paper-plane"></i> Post</button>
                                <?php elseif($opportunity['status'] == 'Drafted' && ($permissions['administrate']|| $permisssions['author'])): ?>
                                <a class="btn btn-info" href="addDocs.php?id=<?=$opportunity_id?>"><i class="fas fa-file-alt"></i> Add Documents</a>
                                <a class="btn btn-info" href="propose.php?id=<?=$opportunity_id?>"><i class="fas fa-edit"></i> Edit Information</a>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendModal"><i class="far fa-paper-plane"></i> Send to Approver</button>
                                <?php endif; ?>
			</div>
                    <?php endif; ?>
                                </form>
		</div>
            
                <!-- Send to Approver Modal -->
		<div id="sendModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center">Are you sure you are ready to submit this opportunity for review?</h4>
				</div>
				<div class="modal-body">
					You cannot make any changes after you submit this opportunity for approval
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Cancel</button>
                                        <button type="submit" class="btn btn-success" name="send" value="send"><i class="far fa-paper-plane"></i> Submit</button>
				</div>
			</div>
		</div>
		</div>
		
		<!-- Cancel Opportunity Modal -->
		<div id="cancelModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center">Are you sure you want to cancel this opportunity?</h4>
				</div>
				<div class="modal-body">
					This opportunity will be removed from the submission process and archived.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Cancel</button>
                                        <button type="submit" class="btn btn-danger" name="remove" value="remove"><i class="fas fa-ban"></i> Remove</button>
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
		
		<!-- Approver Modal -->
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
		
		<!-- Author Post Modal -->
		<div id="postModal" class="modal fade" role="dialog">
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
                 var ajaxurl = 'action/opportunity_process.php',
                 data =  {'action': clickBtnValue,
                          'id': "<?=$opportunity_id?>"
                };
                 $.post(ajaxurl, data, function (response) {
                     alert(response);
                     location.reload();
                 });
             });
             $("#submitDocs").click(function(){
                document.getElementById("DocsUpload").submit();
                });
         });
      </script>
            
  </body>
</html>