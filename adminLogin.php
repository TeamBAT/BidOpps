<?php 

session_start();

include_once('action/connection.php');

if(!$bd) {
    
    die('Could not connect: ' . mysql_error());
    
}


$db_selected = mysqli_select_db($bd,"bidopps_db");

if(isset($_POST["adminLoginBtn"])) {
    
    
    $email = mysqli_real_escape_string($bd,$_POST["email"]);
    $password = mysqli_real_escape_string($bd,$_POST["password"]);
        
     if($email == NULL || $password==NULL) {
        
        echo '
        <script langauge="javascript">
        alert("One of the required fields is missing.");
        window.location.href="/BidOpps/adminLogin.html";
        </script>
        ';
    
    } else {
   
    
    // Checking for duplicate entries
    
    $checkAdmin = "SELECT email FROM users WHERE email='$email'";
    
    $result = mysqli_query($bd,$checkAdmin);
    
    $row = mysqli_fetch_row($result);
    
    $value = $row[0];
    
    if($row and $value) {
        
    $checkPassword = "SELECT password FROM users WHERE password='$password'";
    
    $passwdResult = mysqli_query($bd,$checkPassword);
    
    $pwsd = mysqli_fetch_row($passwdResult);
    
    $pValue = $pwsd[0];
        
        if($pwsd and $pValue) {
            
            $uidEmail = "SELECT id FROM users WHERE email='$email'"; 
            $uidPwd = "SELECT id, firstname, lastname FROM users WHERE password='$password' and email='$email'";
            
            // For added security check if user id matches.
            
            $idResultOne = mysqli_query($bd,$uidEmail);
    
            $idOne = mysqli_fetch_row($idResultOne);
    
            $idOneValue = $idOne[0];
            
            $idResultTwo = mysqli_query($bd,$uidPwd);
    
            $idTwo = mysqli_fetch_row($idResultTwo);
    
            $idTwoValue = $idTwo[0];
            
            if($idOneValue == $idTwoValue) {
                $_SESSION['SESS_MEMBER_ID'] = $idTwo[0];
                $_SESSION['SESS_FIRST_NAME'] = $idTwo[1];
                $_SESSION['SESS_LAST_NAME'] = $idTwo[2];
                
                header("location: home.php");
                
            } else {
                
                 echo "
                <script> 
                alert('Error Logging In!!');
                window.location.href='/BidOpps/adminLogin.html';
                </script>
                ";
                
            }
        } else {
            
             echo "
                <script> 
                alert('Error Logging In!!');
                window.location.href='/BidOpps/adminLogin.html';
                </script>
                ";
            
        }

    } else {
        
        echo "
                <script> 
                alert('Error Logging In!!');
                window.location.href='/BidOpps/adminLogin.html';
                </script>
                ";
        
    } // till here
    
    
    }
    
} else {
    
    
    
}

?>