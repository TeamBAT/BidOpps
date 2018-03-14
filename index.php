<?php
include_once 'connect.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">  
        <link rel="stylesheet" href="style.css">
      
    <!-- JavaScript File -->
      
      <script type="text/javascript" src="displayContent.js"></script>

    <title>Login Page</title>
  </head>
  
    <body>
    
      
    <div class="container-fluid bgm">
    
        <!-- Row 1 -->
        
        <div class="row">
        
            <div class="col-5 img rounded"> <img src="CalpersLogo.png" class="calpersLogo" alt="Responsive image">  </div>
            
            <div class="col-7 systemName text-center rounded"> <h1> <font color="darkgreen"> BID OPS MANAGEMENT </font> </h1> </div>
        
        </div>
        
        <!-- Row 2 -->
        
        <div class="row carousel">
        
            <div class="col-5 slider"> 
                
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            
                <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="img1.png" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="img2.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="img3.png" alt="Third slide">
                </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div> 
            </div>
            
            <div class="col-7 loginTab"> 
            
            <div class="row">
                
            <div class="col-12">
                
            <nav class="nav nav-pills nav-fill buttons">
                
            <button class="nav-item nav-link active" href="#" onclick="display_login()">Login</button>
                
                
            <button class="nav-item nav-link active" href="#" onclick="display_register()">Register</button>
            
            </nav>
                                    
                </div>
                
            </div>
                
            <div class="row loginContent">
                
               <div class="col-12 loginButton" style="display: none" id="showLogin">
                
               <form action="action.php" method="post">
                 
				   <div class="form-group">
						<label for="usernameLogin">USERNAME</label>
						<input type="text" name="username" class="form-control" id="usernameLogin" placeholder="Username">
					</div>
					<div class="form-group">
						<label for="passwordLogin">PASSWORD</label>
						<input type="password" name="password" class="form-control" id="passwordLogin" placeholder="Password">
					</div>
						
					<button type="submit" class="btn btn-primary" href="#"> SUBMIT </button>
				
                </form>
                
               </div> 
                
               <script>
                
                function display_login() {
                
                var y = document.getElementById("showRegister");
                var x = document.getElementById("showLogin");
                
                if(x.style.display === "none") {
                    
                    y.style.display="none";
                    x.style.display = "block";
                    
                } else {
                    
                    x.style.display = "none";
                    
                }
                
            }    
                
            </script>
                
            </div>
                
                <div class="row registerContent">
                
               <div class="col-12 registerButton" style="display: none" id="showRegister">
                
                <form>
                 
               <div class="form-group">
						<label for="usernameSignup">USERNAME</label>
						<input type="text" class="form-control" id="usernameSignup" placeholder="Username">
				</div>
                   
               <div class="form-group">
						<label for="passwordSignup">PASSWORD</label>
						<input type="password" class="form-control" id="passwordSignup" placeholder="Password">
				</div>
                    
               <div class="form-group">
						<label for="emailSignup">EMAIL</label>
						<input type="email" class="form-control" id="emailSignup" placeholder="Email">
				</div>
                    
                <button class="btn" href="#"> SUBMIT </button>
                    
                </form>
                
               </div> 
                
               <script>
                
                function display_register() {
                    
                var y = document.getElementById("showLogin");
                
                var x = document.getElementById("showRegister");
                
                if(x.style.display === "none") {
                    y.style.display = "none";
                    
                    x.style.display = "block";
                    
                } else {
                    
                    x.style.display = "none";
                    
                }
                
            }    
                
            </script>
                
            </div>
                
            
            
            </div>
        
        </div>
      
    </div>    
      
      
      
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <script src="displayContent.js"></script>
  </body>
</html>