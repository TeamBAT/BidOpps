<?php 

session_start();

//Connect to a Database
include_once('action/connection.php');

if(!$bd) {
    
    die('Could not connect: ' . mysql_error());
    
}

$db_selected = mysqli_select_db($bd,"bidopps_db");

if(isset($_POST["createBtn"])) {
    
    
    $firstname = mysqli_real_escape_string($bd,$_POST["firstname"]);
    $lastname = mysqli_real_escape_string($bd,$_POST["lastname"]);
    $email = mysqli_real_escape_string($bd,$_POST["email"]);
    $password = mysqli_real_escape_string($bd,$_POST["password"]);
    $repassword = mysqli_real_escape_string($bd,$_POST["repassword"]);
    $currentdate = date('Y/m/d');
    $completeSelectedList = "";
    $administrator = NULL;
    $author=NULL;
    $reviewer=NULL;
    $approver=NULL;
    $screen=NULL;
    $evaluate=NULL;
    $finalize=NULL;
    $bid=NULL;
        
        
    
    // Getting selected checkboxes
    if(!empty($_POST["rolesAssigned"])){
        // Loop to store and display values of individual checked checkbox.
        $selectedList = $_POST["rolesAssigned"];
        
        foreach($selectedList as $selected) {
            
            switch($selected){
                    
                case "administrative": $administrator= 1;  break;
                    
                case "author": $author= 1; break;
                    
                case "review": $reviewer= 1; break;
                    
                case "approve": $approver= 1; break;
                    
                case "screen": $screen= 1; break;
                    
                case "evaluate": $evaluate= 1;break;
                    
                case "finalize": $finalize=1; break;
                    
                case "bid": $bid=1; break;
                    
                default: echo '
                        <script langauge="javascript">
                        alert("Assigning roles!!");
                        window.location.href="/bidOpps/adminCreateUser.html";
                        </script>
                        ';
                        break;
                    
            }
            
        }
        
        
    }
    
    if($administrator==0 and $author==0 and $reviewer==0 and $approver==0 and $screen==0 and $evaluate==0 and $finalize==0 and $bid==0 ) {
         
         echo '
        <script langauge="javascript">
        alert("Please assign roles.");
        window.location.href="/bidOpps/adminCreateUser.html";
        exit(0);
        </script>
        ';
         
         
     }
    
    
    
     if($firstname == NULL || $lastname==NULL || $email==NULL || $password==NULL || $repassword==NULL || $currentdate==NULL) {
        
        echo '
        <script langauge="javascript">
        alert("One of the required fields is missing.");
        window.location.href="/bidOpps/adminCreateUser.html";
        </script>
        ';

        
    }else {
   
    
    // Checking for duplicate entries
    
    $selectEmail = "SELECT email FROM users WHERE email='$email'";
    
    $result = mysqli_query($bd,$selectEmail);
    
    $row = mysqli_fetch_row($result);
    
    $value = $row[0];
    
    if($row and $value) {
        
        echo '
        <script langauge="javascript">
        alert("User already exists");
        window.location.href="/bidOpps/adminCreateUser.html";
        </script>
        ';

    } else {
        
         if($password == $repassword) {
        
             
        // Inserting into the Database table
        $sql = "INSERT INTO users (email,password,join_date,firstname,lastname)
        VALUES ('$email','$password','$currentdate','$firstname','$lastname')";

        if ($bd->query($sql) === TRUE) {
        
        $selectUserId = "SELECT id FROM users WHERE email='$email'";
        $resultId = mysqli_query($bd,$selectUserId);
        $uid = mysqli_fetch_row($resultId);
        $value = $uid[0];
        
        $insertIntoBidders = "INSERT INTO administrators (user_id)
        VALUES ('$value')";
        
        if ($bd->query($insertIntoBidders) === TRUE)    {
            
            $insertIntoPermissions = "INSERT INTO permissions (user_id,administrate,author,review,approve,screen,evaluate,finalize,bid)
            VALUES ('$value','$administrator','$author','$reviewer','$approver','$screen','$evaluate','$finalize','$bid')";
            
            if ($bd->query($insertIntoPermissions) === TRUE) {
                
                 echo "
                <script> 
                alert('User Creation Successful!!');
                window.location.href='/bidOpps/adminCreateUser.html';
                </script>
                ";
                
                
            } else {
                
                 echo "       
                <script> 
                alert('Failed to insert data');
                window.location.href='/bidOpps/adminCreateUser.html';
                </script>
                ";
                
            }
            
        } else {
            
            echo "Error: " . $sql . "<br>" . $bd->error;
            
        }
        
        } else {
        echo "Error: " . $sql . "<br>" . $bd->error;
        }

        
             
        $bd->close();
        
        
        
    } else {
        
       echo "
       
       <script> 
       alert('Passwords do not match');
       window.location.href='/bidOpps/adminCreateUser.html';
       </script>
       
       ";
        
    }

        
    }
    
    
    }
    
} else {
    
      echo "
       
       <script> 
       alert('Application Issue. Unable to process further!!');
       window.location.href='/bidOpps/adminCreateUser.html';
       </script>   
       ";
    
}

?>