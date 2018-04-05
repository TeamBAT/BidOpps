<?php
require_once("connection.php");
	
	$id = $_POST["id-number"];
	$datetime = date_create_from_format('m#d#Y h a', $_POST["date"]);
	$date = date_format($datetime, 'Y-m-d H:i:s');
	$type = $_POST["type"];
	$category = $_POST["category"];
	$title = $_POST["title"];
	$description = $_POST["description"];
	
	$query = "UPDATE `opportunities` SET `final_filing_date`='$date', `type`='$type', `category`='$category', `title`='$title', `description`='$description', `status` = 'In Review'  WHERE `id` = '$id'";
	$result = mysqli_query($bd, $query);
	if(!$result){
		echo mysqli_error($bd); 
	}
	else{
        header("Location: ../home.php");
        unset($_SESSION['id']);
	}
?>