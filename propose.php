
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Solicitation</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.6/js/froala_editor.min.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
	<link href="CSS/bootstrap.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.6/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
	<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.6/css/froala_style.min.css' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <!-- Custom styles for this template -->
    <link href="CSS/home.css" rel="stylesheet">
    

    
  </head>

  <body style="background: #8a8a5c">
  <?php   session_start();    ?>
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
    <form class="needs-validation" action="action/submitOpportunity.php" method="POST">
       
        <div class="form-row">
		    <div class="form-group col-sm-5">
				<label for="id-number">Number</label>
				<input type="text" class="form-control" placeholder="2018-5555" maxlength="9" name="id-number" id="id-number" required>
			</div>
            <div class="form-group col-sm-7">
				<label for="title">Title</label>
				<input type="text" class="form-control" placeholder="Bid Opportunity Solicitation" name="title" id="title" required>
			</div>
	    </div>
        <div class="form-row">

		    <div class="col-sm-5">
                
			   <div class="form-group">
			   <label for="datetimepicker">Final Filing Date</label>
			   <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" name="date" class="form-control datetimepicker-input" data-target="#datetimepicker"/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>

			   </div>
				
                
				<div class="form-group">
				<label for="type">Opportunity Type</label>
				<select class="form-control" name="type" id="type" required>
					<option>Solicitation</option>
				</select>
			 </div>
				
               
				<div class="form-group">
				<label for="category">Category</label>
				<select class="form-control" name="category" id="category">
					<option>Actuarial Services</option>
					<option>Architecture & Engineering</option>
					<option>Construction</option>
					<option>Consulting</option>
					<option>Health</option>
					<option>Information Technology</option>
					<option>Investments (Non-Manager)</option>
					<option>Legal Services - Outside Counsel</option>
					<option>Mailing</option>
					<option>Miscellaneous</option>
					<option>Photography/Video Services</option>
					<option>Printing/Reproduction/Graphic Design</option>
				</select>
			  </div>
				
            </div>
		    <div class="col-sm-7">
			<div class="form-group">
				<label for="description">Description</label>
				<textarea class="input-block-level" id="summernote" name="description"></textarea>
			</div>
			</div>


		</div>
		<div class="form-row" >
		<button type="submit" class="btn btn-primary pl-6">Save</button>
		<a class="btn btn-danger pl-6" href="home.php" role="button">Cancel</a>   
		</div>
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
                    height: 250
      });
    
   });
     
    </script>
  </body>
  
  
</html>
