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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="CSS/home.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Baloo|Caudex|Happy+Monkey|Karma|Lilita+One|ABeeZee|Antic|Average|Khula|Montserrat+Alternates|Nanum+Gothic|Nobile|Nunito|Varela+Round|Zilla+Slab" rel="stylesheet">
      <style type="text/css">
          .list-selectable {
              cursor: pointer;
          }
          ul{list-style: none;}
          li:before{
              color: #9b0000;
              content: "×";
              font-size: 1.2em;
              font-weight: bold;
              margin: 1%;
          }
      </style>
  </head>

  <body>
  
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
            $query = "SELECT * FROM opportunity_docs WHERE opportunity_id = ".$opportunity_id;
            
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
            $query = "SELECT * FROM permissions WHERE user_id = ".$_SESSION['SESS_MEMBER_ID'];
  
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
	<nav class="navbar fixed-top" style="background-color:#20a8f7;">
        <a href="home.php" style="text-decoration:none;"><h2 class="navbar-brand" style="font-size:30px;font-family:'Nunito';color:white;"><i class="fa fa-home"></i> Bid Opportunities</h2></a>
	 <div class="dropdown pr-5">
		  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		   <?php echo  $_SESSION['SESS_FIRST_NAME']   ?>
		 <span class="caret"></span>
		 </button>
		 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		 <li><a href="action/adminLogout.php">Logout</a></li>
		 </ul>
	  </div>
	</nav> <br/>
	
	<div class="container-fluid">
		<div class="card">
                    <div class="card-header">Bid Submission Review</div>
			<div class="card-body">
                            <?php if(isset($noResult)): echo "Submission 'id = ".$submission_id."' does not exist."; else: ?>
                            <h5>Opportunity Number</h5> <?=$opportunity['number']; ?><br><hr>
                            <h5>Title</h5> <?=$opportunity['title']; ?><br><hr>
                            <h5>Category</h5> <?=$opportunity['category']; ?><br><hr>
                            <h5>Bidder Information</h5>
                <?php if(($permissions['administrate'] || $permissions['finalize']) && $submission['status'] == 'Evaluated'):?>
                            <br><h6 class="text-info">Score: </h6><p class="text-info"><?=$submission['score']?></p>
                            <h6 class="text-info">Cost: </h6><button class="btn btn-outline-info" id="show-cost">Show Cost</button><p class="text-info" id="cost" style="display: none"><i class="fas fa-dollar-sign"></i><?=$submission['cost']?></p><?php endif;?>
                            <h6>Name:</h6><?=$bidder['firstname']." ".$bidder['lastname']; ?><br>
                            <br><h6>Business:</h6><?=$bidder['business'];?><hr>
                            <h5>Status</h5> <?=$submission['status']; ?><br>
                            <hr>
                            <h5>Bidder Uploads</h5>
                            <table id="documents" class="table table-striped table-bordered mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width:50%">File Name</th>
                                            <th style="width:50%">Posted Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // Fetches rows from the $documents mysqli result to populate table
                                    $query2 = "SELECT * FROM submission_docs WHERE submission_id = ".$submission_id;
                                    $submision = mysqli_query($bd, $query2);
                                    if(mysqli_num_rows($submision) > 0 ):
                                    while($submisions = mysqli_fetch_assoc($submision)): ?>
									<tr>
                                    <td><a href="<?php echo $submisions['directory']; ?>"><?php echo $submisions['filename']; ?></a></td>
                                    <td><?php echo $submisions['posted_date']; ?></td>
                                    <?php endwhile; else: echo '<td colspan="2">No files found.</td>'; endif; 
                                    //End fetch rows
                                    ?>
                                    </tr>
                                    </tbody>
                                </table>
                <hr>
				<!--Document Display Module goes here-->
				
			</div>
			<div class="card-footer">
                            <a class="btn btn-info" href="bidderIdInput.php"><i class="fas fa-angle-double-left"></i> Back</a>
                            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#commentModal"><i class="fas fa-comment"></i> View Comment</button>
				<!-- Options to display based on user and status -->
                                <?php if($submission['status'] != 'Awarded' && $submission['status'] != 'Denied' && ($permissions['administrate'] || $permissions['screen'] || $permissions['evaluate'] || $permissions['finalize'])): ?>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal"><i class="fas fa-ban"></i> Reject</button>
                                <?php if(!$submission['needs_clarification'] && !$permissions['bid']): ?>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#clarificationModal"><i class="fas fa-question"></i> Ask for Clarifications</button>
                                <?php elseif($submission['needs_clarification'] && !$permissions['bid']):?>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#clarifyModal"><i class="fas fa-clipboard-check"></i> Review Clarification</button>
                                <?php endif; endif; if($submission['status'] == 'Submitted' && !$submission['needs_clarification'] && ($permissions['administrate'] || $permissions['screen'])): ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#screenModal"><i class="far fa-paper-plane"></i> Screen</button>
                                <?php elseif($submission['status'] == 'Screened' && !$submission['needs_clarification'] && ($permissions['administrate'] || $permissions['evaluate'])): ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#evaluateModal"><i class="fas fa-clipboard-check"></i> Evaluate</button>
				                <?php elseif($submission['status'] == 'Evaluated' && !$submission['needs_clarification'] && ($permissions['administrate']|| $permissions['finalize'])): ?>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#awardModal"><i class="fas fa-trophy"></i> Award this Bid</button>
                                <?php endif; ?>
                                <?php if($submission['needs_clarification'] && $permissions['bid']):?>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#submitClarificationModal"><i class="far fa-file-alt"></i> Submit Clarification</button>
                                <?php endif;?>
			</div>
                    <?php endif; ?>
		</div>
		
		<!-- Cancel Submission Modal -->
		<div id="cancelModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center">Are you sure you want to reject this submission?</h4>
				</div>
				<div class="modal-body">
                                    <h6 class="text-center">This submission will be removed from the submission process and archived.</h6>
                    <label for="remove-comment">Comment <span class="text-danger">(required)</span></label><textarea class="input-block-level" name="remove-comment" id="remove-comment"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
                                        <button type="submit" class="btn btn-danger" name="remove" value="remove"><i class="fas fa-ban"></i> Reject</button>
				</div>
			</div>
		</div>
		</div>
		
		<!--Screener Modal-->
		<div id="screenModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center">Review Submission</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
                    <label for="screen-comment">Comment</label><textarea class="input-block-level" name="screen-comment" id="screen-comment" required></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
					<button type="submit" class="btn btn-success" name="screen" value="screen"><i class="far fa-paper-plane"></i> Submit for Approval</button>
				</div>
			</div>
		</div>
		</div>
		
		<!-- Evaluator Modal -->
		<div id="evaluateModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center">Evaluate Submission</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
                                    <label for="score">Score</label>
                                    <input class="form-control" type="number" name="score" id="score">
                                    <label for="evaluate-comment">Comment</label>
                                    <textarea class="input-block-level" name="evaluate-comment" id="evaluate-comment"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
                                        <button type="submit" class="btn btn-success" name="evaluate" value="evaluate"><i class="far fa-paper-plane"></i> Submit Score</button>
				</div>
			</div>
		</div>
		</div>
		
		<!-- Comment Modal -->
		<div id="commentModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center">Comment</h4>
				</div>
                <div class="modal-body"><?php if($submission['message'] == ''):?> <strong>This submission has not been commented on.</strong> <?php else:?><?=htmlspecialchars_decode($submission['message'])?><?php endif;?></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
				</div>
			</div>
		</div>
		</div>

        <!-- Clarifications Modal -->
        <div id="clarificationModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Clarification Request</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label for="clarification-comment">Note to Bidder <span class="text-danger">(required)</span></label><textarea class="input-block-level" name="clarification-comment" id="clarification-comment" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
                        <button type="submit" class="btn btn-success" name="clarification" value="clarification"><i class="far fa-paper-plane"></i> Ask for Clarification</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Review Clarification Modal -->
        <div id="clarifyModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Clarification Resolution</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body text-center">
                        Verify that the clarification request has been fulfilled.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
                        <button type="submit" class="btn btn-success" name="clarify" value="clarify"><i class="fas fa-clipboard-check"></i> Accept Clarification</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bidder Clarification Modal -->
        <div id="submitClarificationModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Clarification Submission</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label for="submitClarification-comment">Clarification Note <span class="text-danger">(required)</span></label><textarea class="input-block-level" name="submitClarification-comment" id="submitClarification-comment" required></textarea>
                        <form method="post" action="action/bidderClarificationUpload.php" enctype="multipart/form-data" >
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" accept="text/plain, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="files" id="files" onchange="makeFileList(); updateListFunctionality();" multiple />
                            <label class="custom-file-label" for="files">Select Files to Upload</label>
                            </div>
                        </form>
                        <p><strong>Upload Queue</strong><small id="passwordHelpBlock" class="form-text text-muted">(Click on a file to remove it from the queue)</small> </p>
                        <ul id="fileList" class="list-selectable">
                            <li>No Files Selected</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
                        <button type="button" class="btn btn-success" id="submitClarification" name="submitClarification" value="submitClarification"><i class="fas fa-upload"></i> Submit Clarification</button>
                    </div>
                </div>
            </div>
        </div>

                <!-- Finalizer Modal -->
		<div id="awardModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center">Are you sure you want to award this bid?</h4>
				</div>
                            <div class="modal-body text-center">After this bid is awarded, all other bids will be denied for this opportunity.</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal"><i class="far fa-window-close"></i> Cancel</button>
					<button type="submit" class="btn btn-success" name="award" value="award"><i class="far fa-money-bill-alt"></i> Award Bid</button>
				</div>
			</div>
		</div>
		</div>
		
	</div>
      
      <script>
          //List file uploads
          let ajaxFiles = new Map();
          function makeFileList() {
              const input = document.getElementById("files");
              const ul = document.getElementById("fileList");
              while ($('li:contains("No Files Selected")').length !== 0) {
                  ul.removeChild(ul.firstChild);
              }
              for (let i = 0; i < input.files.length; i++) {
                  let thisFile = input.files[i];
                  if (!ajaxFiles.has(thisFile.name)) {
                      //Update List
                      let li = document.createElement("li");
                      li.innerHTML = thisFile.name;
                      ul.appendChild(li);

                      //Update FormData
                      ajaxFiles.set(thisFile.name, thisFile);
                  }
              }
              if(!ul.hasChildNodes()) {
                  let li = document.createElement("li");
                  li.innerHTML = 'No Files Selected';
                  ul.appendChild(li);
              }
              //for(let file of ajaxFiles.entries()) alert(file[0]);
          }

          function removeFile(fileList, fileToRemove){
              if(fileList.has(fileToRemove))
                  fileList.delete(fileToRemove);
          }

        $(document).ready(function(){

            //Script to fix Summernote toolbar scroll bug
            $('.btn').click(function(){
                $('.note-toolbar-wrapper').css('height', 'auto');
            });
            
            //Summernote rich text initialization
            $('#evaluate-comment').summernote({
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
          $('#screen-comment').summernote({
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

            $('#clarification-comment').summernote({
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

            $('#submitClarification-comment').summernote({
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

          //Submission script, selects button and posts button value
             $(':submit').click(function(){
                 var clickBtnValue = $(this).val();
                 var $summernote = $('#'+clickBtnValue+'-comment');
                 var summernoteValue = $($summernote).val();
                 var score = $('#score').val();
                 var ajaxurl = 'action/submission_process.php',
                 data =  {'action': clickBtnValue,
                          'id': "<?=$submission_id?>",
                          'opportunity_id': "<?=$submission['opportunity_id']?>",
                          'comment': summernoteValue,
                          'score': score
                };
                 $.post(ajaxurl, data, function (response){
                     if(response.includes('Success!')) location.reload();
                     alert(response);
                 });
             });

            var costButton = $('#show-cost').unbind('click');

            //Cost Button
            costButton.click(function () {
                $(this).css('display', 'none');
                $('#cost').css('display', 'inline');
            });

             //Clarification Upload with deferrals
            var clarificationButton = $('#submitClarification').unbind('click');
            clarificationButton.click(function() {
                let formData = new FormData();
                let properExtensions = [ "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf" ];
                let fileExtension = '';
                try {
                    for (let file of ajaxFiles.values()) {
                        fileExtension = (file.name).split('.').pop();
                        if ($.inArray(fileExtension, properExtensions) === -1) throw "Incorrect File Extension: " + fileExtension;
                        formData.append('file[]', file);
                    }

                    const clickBtnValue = $(this).val();
                    const $summernote = $('#submitClarification-comment');
                    const summernoteValue = $($summernote).val();
                    formData.append('action', clickBtnValue);
                    formData.append('id', '<?=$submission_id?>');
                    formData.append('comment', summernoteValue);
                    $.ajax({
                        url: 'action/bidderClarificationUpload.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function(response){
                            alert(response);
                        }
                    });
                }catch (e) {
                    alert(e);
                }
            });

         });

          function redrawFileList(){
              const ul = document.getElementById("fileList");

              while (ul.hasChildNodes()) {
                  ul.removeChild(ul.firstChild);
              }
              //If there are no files to get:
              if(ajaxFiles.length === 0){
                  let li = document.createElement("li");
                  li.innerHTML = 'No Files Selected';
                  ul.appendChild(li);
                  return;
              }
              //Else
              for(let file of ajaxFiles.values()){
                  let li = document.createElement("li");
                  li.innerHTML = file.name;
                  ul.appendChild(li);
              }
              if(!ul.hasChildNodes()) {
                  let li = document.createElement("li");
                  li.innerHTML = 'No Files Selected';
                  ul.appendChild(li);
              }

          }

          function updateListFunctionality(){
              $('#fileList > li').click(function () {
                  const clickValue = this.innerText;
                  removeFile(ajaxFiles, clickValue);
                  redrawFileList();
                  updateListFunctionality();
              });
          }
      </script>

  </body>
</html>