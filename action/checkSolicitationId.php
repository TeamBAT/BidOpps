<?php
require_once('connection.php');
$number = str_replace('-', '', $_POST["id"]);

$qry="SELECT * FROM opportunities WHERE number ='$number'";
    $result=mysqli_query($bd, $qry);
	if(mysqli_num_rows($result) > 0) {
        //Login Successful
        echo "OK";
    }
    
?>