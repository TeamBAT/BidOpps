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
		
		
		
	</body>