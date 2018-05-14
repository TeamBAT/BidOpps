<?php 

session_start();

//Connect to a Database
include_once('action/connection.php');

if(!$bd) {
    
    die('Could not connect: ' . mysqli_error($bd));
    
}


$db_selected = mysqli_select_db($bd,"bidopps_db");

if(isset($_POST["register_btn"])) {
    
    
    $firstname = mysqli_real_escape_string($bd,$_POST["firstName"]);
    $lastname = mysqli_real_escape_string($bd,$_POST["lastName"]);
    $username = mysqli_real_escape_string($bd,$_POST["username"]);
    $password = mysqli_real_escape_string($bd,$_POST["password"]);
    $repassword = mysqli_real_escape_string($bd,$_POST["repassword"]);
    $companyname = mysqli_real_escape_string($bd,$_POST["companyname"]);
    $contact = mysqli_real_escape_string($bd,$_POST["contact"]);
    $email = mysqli_real_escape_string($bd,$_POST["email"]);
    $currentdate = date('Y/m/d');
    $completeSelectedList = "";
    $bid=1;
    $uid=NULL;
        
        
    
    // Getting selected checkboxes
    if(!empty($_POST["optionsSelected"])){
        // Loop to store and display values of individual checked checkbox.
        $selectedList = $_POST["optionsSelected"];
        
        foreach($selectedList as $selected) {
            
            $completeSelectedList = $completeSelectedList . $selected . ",";
            
        }
        
    }
    
     if($firstname == NULL || $lastname==NULL || $password==NULL || $repassword==NULL || $companyname==NULL || $contact==NULL || $email==NULL || $currentdate==NULL || $completeSelectedList==NULL) {
        
        echo '
        <script langauge="javascript">
        alert("One of the required fields is missing.");
        window.location.href="registration.html";
        </script>
        ';

        
    } else {
   
    
    // Checking for duplicate entries
    
    $selectEmail = "SELECT email FROM users WHERE email='$email'";
    
    $result = mysqli_query($bd,$selectEmail);
    
    $row = mysqli_fetch_row($result);
    
    $value = $row[0];
    
    if($row and $value) {
        
        echo '
        <script langauge="javascript">
        alert("User already exists");
        window.location.href="registration.html";
        </script>
        ';

    } else {
           
         if($password == $repassword) {
        
             
        // Inserting into the Database table
        $sql = "INSERT INTO users (email,password,join_date,firstname,lastname)
        VALUES ('$email','$password','$currentdate','$firstname','$lastname')";
             
        $permissionSQL = "INSERT INTO permissions (user_id,administrate,author,review,approve,screen,evaluate,finalize,bid)
        VALUES ('$value',0,0,0,0,0,0,0,1)";

        // Insert into Users
        if ($bd->query($sql) === TRUE) {
        
        $selectUserId = "SELECT id FROM users WHERE email='$email'";
        $resultId = mysqli_query($bd,$selectUserId);
        $uid = mysqli_fetch_row($resultId);
        $value = $uid[0];
        
        $permissionSQL = "INSERT INTO permissions (user_id,administrate,author,review,approve,screen,evaluate,finalize,bid)
        VALUES ('$value',0,0,0,0,0,0,0,1)";
            
        $insertIntoPermissions = "INSERT INTO permissions (bid)
        VALUES ('$bid')";
        
        $insertIntoBidders = "INSERT INTO bidders (user_id,business,interests) VALUES ('$value','$companyname','$completeSelectedList')";
        
        // Insert into Bidders
        if ( ($bd->query($insertIntoBidders) === TRUE)  )    {
            
           
            
            
        } else {
            
            echo "Issue: " . $insertIntoBidders . "<br>" . $bd->error;
            
        }
         
        // Insert into Permissions
        if ( ($bd->query($permissionSQL) === TRUE)  )    {
            
             echo "
            <script> 
            alert('User creation Successful');
            window.location.href='bidderLogin.html';
            </script>
            ";
            
            
        } else {
            
            echo "Check: " . $permissionSQL . "<br>" . $bd->error;
            
        }
        
        } else {
        echo "Error: " . $sql . "<br>" . $bd->error;
        }     
             
        $bd->close();
        
        
        
    } else {
        
       echo "
       
       <script> 
       alert('Passwords do not match');
       window.location.href='registration.html';
       </script>
       
       ";
        
    }
            
       

        
    }
    
    
    }
    
} else {
    
      echo "
       
       <script> 
       alert('Application Issue. Unable to process further!!');
       window.location.href='registration.html';
       </script>
       
       ";
    
}

?>