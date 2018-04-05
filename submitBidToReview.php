
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Solicitation</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
    <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
	<link href="CSS/bootstrap.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <!-- Custom styles for this template -->
    <link href="CSS/home.css" rel="stylesheet">
    <?php require_once('action/connection.php'); ?>

    
  </head>

  <body style="background: #8a8a5c">
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

    <main role="main" class="container">
    <form class="needs-validation" action="action/sendToReviewer.php" method="POST">
        <?php
          $id=$_SESSION['id'];
          $qry="SELECT * FROM opportunities WHERE id='$id'";
          $result=mysqli_query($bd, $qry);
          $solicitation = mysqli_fetch_assoc($result);
			$finalFillingDate = $solicitation['final_filing_date'];
			$OpportunityType = $solicitation['type'];
			$Category = $solicitation['category'];
            $Title = $solicitation['title'];
            $Description = $solicitation['description'];
			session_write_close();
        ?>
        <div class="form-row">
		    <div class="form-group col-sm-5">
				<label for="id-number">Number</label>
				<input type="text" class="form-control" value="<?php echo $id; ?>" maxlength="9" name="id-number" id="id-number" disabled>
			</div>
            <div class="form-group col-sm-7">
				<label for="title">Title</label>
				<input type="text" class="form-control" value="<?php echo $Title; ?>" name="title" id="title" required>
			</div>
	    </div>
        <div class="form-row">

		    <div class="col-sm-5">
                
			   <div class="form-group">
			   <label for="datetimepicker">Final Filing Date</label>
			   <div class="input-group date" id="datetimepicker1" data-target-input="nearest" >
                    <input type="text" value="<?php echo $finalFillingDate; ?>" name="date" class="form-control datetimepicker-input" data-target="#datetimepicker"/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>

			   </div>
				
                
				<div class="form-group">
				<label for="type">Opportunity Type</label>
				<select class="form-control" name="type" id="type" value="<?php echo $OpportunityType; ?>" required>
					<option>Solicitation</option>
				</select>
			 </div>
				
               
				<div class="form-group">
				<label for="category">Category</label>
				<select class="form-control" name="category" id="category">
					<option <?php if ($Category == "Actuarial Services") echo "selected='selected'";?>>Actuarial Services</option>
					<option <?php if ($Category == "Architecture & Engineering") echo "selected='selected'";?>>Architecture & Engineering</option>
					<option <?php if ($Category == "Construction") echo "selected='selected'";?>>Construction</option>
					<option <?php if ($Category == "Consulting") echo "selected='selected'";?>>Consulting</option>
					<option <?php if ($Category == "Health") echo "selected='selected'";?>>Health</option>
					<option <?php if ($Category == "Information Technology") echo "selected='selected'";?>>Information Technology</option>
					<option <?php if ($Category == "Investments (Non-Manager)") echo "selected='selected'";?>>Investments (Non-Manager)</option>
					<option <?php if ($Category == "Legal Services - Outside Counsel") echo "selected='selected'";?>>Legal Services - Outside Counsel</option>
					<option <?php if ($Category == "Mailing") echo "selected='selected'";?>>Mailing</option>
					<option <?php if ($Category == "Miscellaneous") echo "selected='selected'";?>>Miscellaneous</option>
					<option <?php if ($Category == "Photography/Video Services") echo "selected='selected'";?>>Photography/Video Services</option>
					<option <?php if ($Category == "Printing/Reproduction/Graphic Design") echo "selected='selected'";?>>Printing/Reproduction/Graphic Design</option>
				</select>
			  </div>
				
            </div>
		    <div class="col-sm-7">
			<div class="form-group">
				<label for="description">Description</label>
				<textarea class="input-block-level" id="summernote" name="description"><?php echo $Description; ?></textarea>
			</div>
			</div>


		</div>
		
        <button type="button" class="btn btn-primary float-left mr-1" id="saveDraft">Save Draft</button>
        <button type="submit" class="btn btn-success" id="sendToReviewer">Send to Reviewer</button>
       
        <button type="button" class="btn btn-danger float-right" id="cancelSolicitation">Cancel Solicitation</button>   
	
    </form>
    
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script>
    $( document ).ready(function() {
		
                $('#datetimepicker').datetimepicker();
				 $('#summernote').summernote({
                    placeholder: 'Description',
					tabsize: 2,
					disableResizeEditor: true,
                    height: 200
                 });
         $("#saveDraft").click(function(e) {
           e.preventDefault();
           $.ajax({
              type: "POST",
              url: "action/saveSdraft.php",
              success: function(result) {
                window.location.replace("home.php");
              },
              error: function(result) {
              alert(result);
              }
            });
          });
          $("#cancelSolicitation").click(function(e) {
           e.preventDefault();
           $.ajax({
              type: "POST",
              url: "action/cancelSolicitation.php",
              success: function(result) {
                window.location.replace("home.php");
              },
              error: function(result) {
              alert(result);
              }
            });
          });
   });
     
    </script>
  </body>
  
  
</html>
