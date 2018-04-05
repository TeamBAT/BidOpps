<?php
        $id = $_POST["id-number"];
		$datetime = date_create_from_format('m#d#Y h a', $_POST["date"]);
		$date = date_format($datetime, 'Y-m-d H:i:s');
		$type = $_POST["type"];
		$category = $_POST["category"];
		$title = $_POST["title"];
		$description = $_POST["description"];
        require_once("connection.php");
        $id=$_SESSION['id'];
        $query = "UPDATE `opportunities` SET `final_filing_date`='$date', `type`='$type', `category`='$category', `description`='$description', `title`='$title',  `status` = 'In Review'  WHERE `id` = '$id'";
        mysqli_query($bd, $query);
        unset($_SESSION['id']);
        header("Location: ../home.php");
?>