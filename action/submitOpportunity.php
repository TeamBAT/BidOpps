<?php
require_once("connection.php");

//If post variables are set, submit else return
if(isset($_POST["id-number"]) && isset($_POST["date"]) && isset($_POST["type"]) && isset($_POST["category"]) && isset($_POST["title"]) && isset($_POST["description"])){
	
	$id = str_replace('-', '', $_POST["id-number"]);
	$_SESSION['id']=$id;
	$datetime = date_create_from_format('m#d#Y h a', $_POST["date"]);
	$date = date_format($datetime, 'Y-m-d H:i:s');
	$type = mysqli_escape_string($bd, $_POST["type"]);
	$category = mysqli_escape_string($bd, $_POST["category"]);
	$title = mysqli_escape_string($bd, $_POST["title"]);
	$description = htmlentities($_POST["description"]);
	
	$query = "INSERT INTO `opportunities` (`number`, `final_filing_date`, `type`, `category`, `title`, `description`, `created_by`)
			VALUES('".$id."', '".$date."', '".$type."', '".$category."', '".$title."', '".$description."', ".$_SESSION['SESS_MEMBER_ID'].")";
	
	$result = mysqli_query($bd, $query);
	if(!$result){
		echo mysqli_error($bd);
	}
	else{
            $_SESSION['opportunity_id'] = mysqli_insert_id($bd);
            header("Location: ../addDocs.php");
	}
	 
}
else{
	header("Location: ../propose.php");
}
?>