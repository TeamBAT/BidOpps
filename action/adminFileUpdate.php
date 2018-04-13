<?php
require_once("connection.php");
    $id= $_POST['id'];
    $subheading = $_POST['subheading'];
    $docTitle=$_POST['docTitle'];
    $datetime2 = date_create_from_format('m#d#Y h a', $_POST['Pdate']);
	$postedDate = date_format($datetime2, 'Y-m-d H:i:s');
    $datetime1 = date_create_from_format('m#d#Y h a', $_POST['dueDate']);
	$dueDate = date_format($datetime1, 'Y-m-d H:i:s');
    if (isset($_POST['id'])) {
        $query = "UPDATE `opportunity_docs` SET `subheading` = '$subheading', `title`= '$docTitle', `posted_date`='$postedDate', `due_date`='$dueDate'  WHERE `document_id` = '$id'"; //Insert Query
        mysqli_query($bd, $query);
        echo $_POST['id'];
    }

?>