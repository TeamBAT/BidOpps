<?php
require_once 'connection.php';

if (isset($_POST['action'])) {
    $id = $_POST['id'];
    switch ($_POST['action']) {
        case 'remove':
            $status = 'Denied';
            $timestamp = '';
            break;
        case 'screen':
            $status = 'Screened';
            $timestamp = "`time_screened` = CURRENT_TIMESTAMP, ";
            break;
        case 'evaluate':
            $status = 'Evaluated';
            $timestamp = "`time_reviewed` = CURRENT_TIMESTAMP, ";
            break;
        case 'award':
            $status = 'Awarded';
            $timestamp = "`time_finalized` = CURRENT_TIMESTAMP, ";
            $awarded = true;
            break;
    }
    //Update databse to reflect new status
    $query = "UPDATE `opportunities` SET ".$timestamp."`last_updated` = CURRENT_TIMESTAMP, `status` = '".$status."' WHERE `opportunities`.`id` = ".$id."";
  
    $result = mysqli_query($bd, $query);
    if($result){
        echo "Success! Submission is now ".$status.".";
        
    }
    else{
        echo "Query failed.";
    }
} else{
    echo "Post variable not set";
}
?>
