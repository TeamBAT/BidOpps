<?php 

session_start();

//Connect to a Database
$db = mysqli_connect("localhost","root","","bidopps_db");

if(!$db) {
    
    die('Could not connect: ' . mysql_error());
    
}

$db_selected = mysqli_select_db($db,"bidopps_db");

if(isset($_POST["register_btn"])) {
    
    
    $firstname = mysqli_real_escape_string($db,$_POST["firstName"]);
    $lastname = mysqli_real_escape_string($db,$_POST["lastName"]);
    $username = mysqli_real_escape_string($db,$_POST["username"]);
    $password = mysqli_real_escape_string($db,$_POST["password"]);
    $repassword = mysqli_real_escape_string($db,$_POST["repassword"]);
    $companyname = mysqli_real_escape_string($db,$_POST["companyname"]);
    $contact = mysqli_real_escape_string($db,$_POST["contact"]);
    $email = mysqli_real_escape_string($db,$_POST["email"]);
    $currentdate = date('Y/m/d');
    $completeSelectedList = "";
    
        
        
    
    // Getting selected checkboxes
    if(!empty($_POST["optionsSelected"])){
        // Loop to store and display values of individual checked checkbox.
        $selectedList = $_POST["optionsSelected"];
        
        foreach($selectedList as $selected) {
            
            $completeSelectedList = $completeSelectedList . $selected . ",";
            
        }
        
    }
    
     if($firstname == NULL || $lastname==NULL || $username==NULL || $password==NULL || $repassword==NULL || $companyname==NULL || $contact==NULL || $email==NULL || $currentdate==NULL || $completeSelectedList==NULL) {
        
        echo '
        <script langauge="javascript">
        alert("One of the required fields is missing.");
        window.location.href="/bidOpps/registration.html";
        </script>
        ';

        
    } else {
   
    
    // Checking for duplicate entries
    
    $selectEmail = "SELECT email FROM users WHERE email='$email'";
    
    $result = mysqli_query($db,$selectEmail);
    
    $row = mysqli_fetch_row($result);
    
    $value = $row[0];
    
    if($row and $value) {
        
        echo '
        <script langauge="javascript">
        alert("User already exists");
        window.location.href="/bidOpps/registration.html";
        </script>
        ';

    } else {
        
        if($email == $username) {
        
         if($password == $repassword) {
        
             
        // Inserting into the Database table
        $sql = "INSERT INTO users (email,password,join_date,firstname,lastname)
        VALUES ('$email','$password','$currentdate','$firstname','$lastname')";

        if ($db->query($sql) === TRUE) {
        echo "New record created successfully";
        $selectUserId = "SELECT id FROM users WHERE email='$email'";
        $resultId = mysqli_query($db,$selectUserId);
        $uid = mysqli_fetch_row($resultId);
        $value = $uid[0];
        
        $insertIntoBidders = "INSERT INTO bidders (user_id,business,interests)
        VALUES ('$value','$companyname','$completeSelectedList')";
        
        if ($db->query($insertIntoBidders) === TRUE)    {
            
            echo "
            <script> 
            alert('User Creation Successful. Please Login now.');
            window.location.href='/bidOps/bidderLogin.html';
            </script>
            ";
            
        } else {
            
            echo "Error: " . $sql . "<br>" . $db->error;
            
        }
        
        } else {
        echo "Error: " . $sql . "<br>" . $db->error;
        }

        
             
        $db->close();
        
        
        
    } else {
        
       echo "
       
       <script> 
       alert('Passwords do not match');
       window.location.href='/bidOpps/registration.html';
       </script>
       
       ";
        
    }
            
        } else {
            
        echo "
       
       <script> 
       alert('Username and Email Id must be the same');
       window.location.href='/bidOpps/registration.html';
       </script>
       
       ";
            
        }

        
    }
    
    
    }
    
} else {
    
      echo "
       
       <script> 
       alert('Application Issue. Unable to process further!!');
       window.location.href='/bidOpps/registration.html';
       </script>
       
       ";
    
}

?>