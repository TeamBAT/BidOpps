<?php
require_once 'connection.php';

if (isset($_POST['action'])) {
    $id = $_POST['id'];
    switch ($_POST['action']) {
        case 'remove':
            $status = 'Archived';
            break;
        case 'review':
            $status = 'Reviewed';
            $timestamp = "`reviewed_date` = CURRENT_TIMESTAMP, ";
            break;
        case 'approve':
            $status = 'Validated';
            $timestamp = "`validated_date` = CURRENT_TIMESTAMP, ";
            break;
        case 'post':
            $status = 'Posted';
            $timestamp = "`posted_date` = CURRENT_TIMESTAMP, ";
            break;
    }
    //Update databse to reflect new status
    $query = "UPDATE `opportunities` SET ".$timestamp."`last_updated` = CURRENT_TIMESTAMP, `status` = '".$status."' WHERE `opportunities`.`id` = ".$id."";
  
    $result = mysqli_query($bd, $query);
    if($result){
        echo "Success! Opportunity is now ready for the next step.";
    }
    else{
        echo "Query failed.";
    }
} else{
    echo "Post variable not set";
}
?>