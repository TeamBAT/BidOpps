
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Solicitation</title>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
<link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
    
  </head>

  <body style="background: #8a8a5c">
  <?php   session_start(); ?>
    <nav class="navbar navbar-dark bg-primary fixed-top">
	
	     <h3 class="navbar-brand">Bid Opportunities Admin</h3>
     
    </nav>

    <main role="main" class="container">

    
    <form class="needs-validation" action="action/submitOpportunity.php" method="POST">
        <div class='col-sm-6'>
			<div class="form-group">
				<label for="id-number">Number</label>
				<input type="text" class="form-control" placeholder="2018-5555" maxlength="9" name="id-number" id="id-number" required>
			</div>
            <div class="form-group">
				<label for="datetimepicker">Final Filing Date</label>
                <div class='input-group date' id='datetimepicker'>
                    <input type='text' class="form-control" name="date" id="datetimepicker" required/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
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
		<button type="submit" class="btn btn-primary">Save</button>
		<a class="btn btn-danger" href="home.php" role="button">Cancel</a>
        </div>
		
		<div class="col-sm-6">
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" class="form-control" placeholder="Bid Opportunity Solicitation" name="title" id="title" required>
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea class="form-control" name="description" id="description" rows="10" required></textarea>
			</div>
		</div>
        
    </form>
	
    
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
  <script>
    $('#datetimepicker').datetimepicker();
    </script>
</html>
