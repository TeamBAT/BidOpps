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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="CSS/home.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  </head>

  <body style="background: #8a8a5c">
  
<?php
    include_once('action/connection.php');
    include_once('action/checkLogin.php');
	
    $permissions = check_login($bd);
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
            if(!$documents) echo "Documents could not be fetched.";
        }
        else{
            ($permissions)? header("Location: home.php") : header("Location: index.php");
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
                    <form action="action/AddendaDocsUpload.php" method='post' enctype="multipart/form-data" id="DocsUpload">
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
                                    <td><input id="file1" type="file" name="file[]" required/>
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
                                    <td><input id="file2" type="file" name="file[]" required/><input type="hidden" name="subheading[]" value="Addenda"></td>
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
                                    <td><input id="file3" type="file" name="file[]" required/><input type="hidden" name="subheading[]" value="Required"></td>
                                    
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
                                    <td><input id="file4" type="file" name="file[]" required/><input type="hidden" name="subheading[]" value="Exhibits"></td>
									</tr>
                                    <?php endwhile; else: echo '<td colspan="3">No files found.</td>'; endif; 
                                    //End fetch rows
                                    ?>
                                </table>	
			</div>
			<div class="card-footer">
                            <a class="btn btn-info" href="home.php"><i class="fas fa-home"></i> Home</a>
                            <?php if($opportunity['status'] == 'Posted' && ($permissions['bid'])): ?>
                            <button type="button" class="btn btn-primary" id="submitDocs"><i class="fas fa-upload"></i> Upload Bidder</button>
                            <?php endif;?>
				<!-- Options to display based on user and status -->
                                <?php if($permissions['administrate'] || $permissions['author'] || $permissions['review'] || $permissions['approve']): ?>
                                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#commentModal"><i class="fas fa-comment"></i> View Comment</button>
                                <?php endif; if($opportunity['status'] != 'Posted' && $opportunity['status'] != 'Archived' && ($permissions['administrate'] || $permissions['author'])): ?>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal"><i class="fas fa-ban"></i> Archive</button>
                                <?php endif; if($opportunity['status'] == 'Submitted' && ($permissions['administrate'] || $permissions['review'])): ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#reviewModal"><i class="far fa-paper-plane"></i> Review</button>
                                <?php elseif($opportunity['status'] == 'Reviewed' && ($permissions['administrate'] || $permissions['approve'])): ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal"><i class="far fa-paper-plane"></i> Approve</button>
				<?php elseif($opportunity['status'] == 'Validated' && ($permissions['administrate']|| $permissions['author'])): ?>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#postModal"><i class="far fa-paper-plane"></i> Post</button>
                                <?php elseif($opportunity['status'] == 'Drafted' && ($permissions['administrate']|| $permissions['author'])): ?>
                                <a class="btn btn-info" href="addDocs.php?id=<?=$opportunity_id?>"><i class="fas fa-file-alt"></i> Add Documents</a>
                                <a class="btn btn-info" href="propose.php?id=<?=$opportunity_id?>"><i class="fas fa-edit"></i> Edit Information</a>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendModal"><i class="far fa-paper-plane"></i> Send to Approver</button>
                                <?php endif; ?>
			</div>
                    <?php endif; ?>
                    <input id="bidderCost" type="hidden" class="bidder" value="" name="bidder_cost">
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
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
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
                                    <textarea class="input-block-level" name="remove-comment" id="remove-comment"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
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
                                    <textarea class="input-block-level" name="review-comment" id="review-comment"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
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
                                    <textarea class="input-block-level" name="approve-comment" id="approve-comment"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
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
					<h4 class="modal-title">Are you sure you are ready to post this bid?</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
					<button type="submit" class="btn btn-success" name="post" value="post"><i class="far fa-paper-plane"></i> Post</button>
				</div>
			</div>
		</div>
		</div>
                
                <!-- Comment Modal -->
		<div id="commentModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Comment</h4>
				</div>
                            <div class="modal-body"><?=htmlspecialchars_decode($opportunity['message'])?></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
				</div>
			</div>
		</div>
		</div>
                
		<!-- Bidder Cost Input Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-hand-holding-usd"></i> Bid Price</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
             <form>
            <div class="form-group">
                <label for="bidderCost">Bid Price</label>
                <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text">$</div>
                </div>
                    <input name="bidderPrice" type="text" class="form-control" id="bidder_price" placeholder="120000" required>
                </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button id="submitBidderdocs" type="button" class="btn btn-primary">Send</button>
               </form>
             </div>
           </div>
          </div>
      </div>
	</div>
      
      <script>
        $(document).ready(function(){
            
            //Script to fix Summernote scroll bug
            $('.btn').click(function(){
                $('.note-toolbar-wrapper').css('height', 'auto');
            });
            
            //Summernote rich text initialization
            $('#review-comment').summernote({
              toolbar: [
                  ['style', ['bold', 'italic', 'underline', 'clear']],
                  ['font', ['strikethrough', 'superscript', 'subscript']],
                  ['fontsize', ['fontsize']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['height', ['height']]
              ],
              placeholder: 'Enter a comment (optional)',
              dialogsInBody: true,
              tabsize: 2,
              disableResizeEditor: true,
              disableDragAndDrop: true,
              height: 250
          });
          $('#approve-comment').summernote({
              toolbar: [
                  ['style', ['bold', 'italic', 'underline', 'clear']],
                  ['font', ['strikethrough', 'superscript', 'subscript']],
                  ['fontsize', ['fontsize']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['height', ['height']]
              ],
              placeholder: 'Enter a comment (optional)',
              dialogsInBody: true,
              tabsize: 2,
              disableResizeEditor: true,
              disableDragAndDrop: true,
              height: 250
          });
          
          $('#remove-comment').summernote({
              toolbar: [
                  ['style', ['bold', 'italic', 'underline', 'clear']],
                  ['font', ['strikethrough', 'superscript', 'subscript']],
                  ['fontsize', ['fontsize']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['height', ['height']]
              ],
              placeholder: 'Enter a comment (required)',
              dialogsInBody: true,
              tabsize: 2,
              disableResizeEditor: true,
              disableDragAndDrop: true,
              height: 250
          });
          
          //Form submission script
             $(':submit').click(function(){
                 var clickBtnValue = $(this).val();
                 var $summernote = $('#'+clickBtnValue+'-comment');
                 var summernoteValue = $($summernote).val();
                 var ajaxurl = 'action/opportunity_process.php',
                 data =  {'action': clickBtnValue,
                          'id': "<?=$opportunity_id?>",
                          'comment': summernoteValue
                };
                 $.post(ajaxurl, data, function (response) {
                     if(response.includes('Success!')) location.reload();
                     alert(response);
                 });
             });
                $("#submitDocs").click(function(){
                $('#myModal').modal('show');
                });
                $("#submitBidderdocs").click(function(){
                var singleValues = $("#bidder_price").val();
                $('#bidderCost').val(singleValues);
                $('#myModal').modal('toggle');
                
                var error=0;
                $fileIns = $('input[type="file"][name="subheading[]"]');
                for (let fileInput of $fileIns){
                    if(fileInput.files.length === 0) error++;
                }
                    
                if(error>0){
                    alert("You should Upload all required files");
                }else{
                    alert("Bid submitted! Please wait for your submission to be reviewed. We will update you when a bid is awarded for this opportunity.");
                    document.getElementById("DocsUpload").submit();
                }
               
                });
         });
      </script>
            
  </body>
</html>