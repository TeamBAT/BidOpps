<?php
require_once 'connection.php';

if (isset($_POST['action'])) {
    $id = $_POST['id'];
    
    if(!isset($_POST['comment']) || $_POST['comment'] == ''){
        $comment = 'NULL';
    } else{
        $raw_comment = $_POST['comment'];
        $comment = "'".mysqli_escape_string($bd, htmlspecialchars($raw_comment))."'";
    }
    
    $needsMore = false;
    switch ($_POST['action']) {
        case 'remove':
            $status = 'Archived';
            if($comment == 'NULL'){
                $needsMore = true;
            }
            $timestamp = '';
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
        case 'send':
            $status = 'Submitted';
            $timestamp = '';
            break;
    }
    
    if($needsMore){
        echo "You must fill out all fields before continuing.";
    }else{
        //Update databse to reflect new status
        $query = "UPDATE `opportunities` SET ".$timestamp."`last_updated` = CURRENT_TIMESTAMP, `status` = '".$status."', `message` = ".$comment." WHERE `opportunities`.`id` = ".$id."";

        $result = mysqli_query($bd, $query);
        if($result){
            echo "Success! Opportunity is now ".$status.".";
        }
        else{
            echo "Query failed.";
        }
    }
} 
else{
    echo "Post not set.";
}
?>