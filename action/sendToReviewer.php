<?php
require_once("connection.php");

//If post variables are set, submit else return
if(isset($_POST["id-number"]) && isset($_POST["date"]) && isset($_POST["type"]) && isset($_POST["category"]) && isset($_POST["title"]) && isset($_POST["description"])){
	
	$id = str_replace('-', '', $_POST["id-number"]);
	$_SESSION['id']=$id;
	$datetime = date_create_from_format('m#d#Y h a', $_POST["date"]);
	$date = date_format($datetime, 'Y-m-d H:i:s');
	$type = $_POST["type"];
	$category = $_POST["category"];
	$title = $_POST["title"];
	$description = $_POST["description"];
	
	$query = "UPDATE `opportunities` SET `final_filing_date`='$date', `type`='$type', `category`='$category', `title`='$title', `description`='$description', `status` = 'In Review'
			   WHERE `id` = '$id'";
	
	$result = mysqli_query($bd, $query);
	if(!$result){
		echo mysqli_error($bd); 
	}
	else{
        header("Location: ../home.php");
        unset($_SESSION['id']);
	}
	 
}
else{
	header("Location: ../submitBidToReview.php");
}
?>