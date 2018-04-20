<?php
require_once("connection.php");

//If post variables are set, submit else return
if(isset($_POST["id-number"]) && isset($_POST["date"]) && isset($_POST["type"]) && isset($_POST["category"]) && isset($_POST["title"]) && isset($_POST["description"])){
	
	$number = str_replace('-', '', $_POST["id-number"]);
	$datetime = date_create_from_format('m#d#Y h a', $_POST["date"]);
	$date = date_format($datetime, 'Y-m-d H:i:s');
	$type = mysqli_escape_string($bd, $_POST["type"]);
	$category = mysqli_escape_string($bd, $_POST["category"]);
	$title = mysqli_escape_string($bd, $_POST["title"]);
	$description = htmlentities($_POST["description"]);
        $editMode = $_POST["edit"];
	
        if($editMode && isset($_POST['id'])){
            $id = mysqli_escape_string($bd, $_POST['id']);
            $query = "UPDATE `opportunities` SET `number`='".$number."',`final_filing_date`='".$date."', `type`='".$type."', `category`='".$category."', `title`='".$title."', `description`='".$description."' WHERE `id`=".$id;
            
            $result = mysqli_query($bd, $query);
            if(!$result){
                $message = "Invalid update. Please try again.\nReason: ".mysqli_error($bd);
                $error = true;
                $return[] = array('message' => $message, 'error' => $error, 'id' => $id);
                echo json_encode($return);
            }
            else{
                $message = "Opportunity updated! Please review files and preview full details before sending to an approver.";
                $error = false;
                $return[] = array('message' => $message, 'error' => $error, 'id' => $id);
                echo json_encode($return);
            }
        }else {
            $query = "INSERT INTO `opportunities` (`number`, `final_filing_date`, `type`, `category`, `title`, `description`, `created_by`)
                            VALUES('".$number."', '".$date."', '".$type."', '".$category."', '".$title."', '".$description."', ".$_SESSION['SESS_MEMBER_ID'].")";
            
            $result = mysqli_query($bd, $query);
            if(!$result){
                $message = "Invalid submission. Please try again.\nReason: ".mysqli_error($bd);
                $error = true;
                $return[] = array('message' => $message, 'error' => $error, 'id' => null);
                echo json_encode($return);
            }
            else{
                $message = "Opportunity saved! Please review files and preview full details before sending to an approver.";
                $error = false;
                $return[] = array('message' => $message, 'error' => $error, 'id' => mysqli_insert_id($bd));
                echo json_encode($return);
            }
        }
	 
}
else{
	header("Location: ../propose.php");
}
?>