<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css"> 
        <link href="https://fonts.googleapis.com/css?family=Baloo|Caudex|Happy+Monkey|Karma|Lilita+One|ABeeZee|Antic|Average|Khula|Montserrat+Alternates|Nanum+Gothic|Nobile|Nunito|Varela+Round|Zilla+Slab" rel="stylesheet">

        <link rel="stylesheet" href="index.css">
      
    <!-- JavaScript File -->
      

    <title>Login Page</title>
  </head>
  
    <body class="bdy">
    
    <div class="container-fluid contain">
        
    <div class="row heading">
        
        <div class="col-6 imgLogo"> <img src="CalpersLogo.png" class="img">  </div>
        
        <div class="col-6 bidOps"> <label class="bidOpsTitle"> Bid Management System  </label>    </div>
        
    </div>
        
    <div class="row base">
        
        <div class="col-7 login"> 
            
        <form action="adminLoginRedirect.php" method="post">
        <div class="btn"><p><button type="submit" class="sbmit"> Admin Login </button> </p> </div></form>

        <form action="bidderLoginRedirect.php" method="post">   
        <div class="btn"> <p> <button type="submit" class="sbmit"> Bidder Login </button> </p> </div></form>
            
        
        </div>
        
        <form action="registerRedirect.php" method="post">   
        <div class="col-5 register"><button type="submit" class="regist">  Register to Bid  </button>  </div></form>
        
        
    </div>
            
    </div>  
         
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
  </body>
</html>