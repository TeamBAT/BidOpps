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
    $score = '';
    switch ($_POST['action']) {
        case 'remove':
            $status = 'Denied';
            $timestamp = '';
            if($comment == 'NULL'){
                $needsMore = true;
            }
            break;
        case 'screen':
            $status = 'Screened';
            $timestamp = "`time_screened` = CURRENT_TIMESTAMP, ";
            break;
        case 'evaluate':
            $status = 'Evaluated';
            $timestamp = "`time_reviewed` = CURRENT_TIMESTAMP, ";
            if(!isset($_POST['score']) || $_POST['score'] == ''){
                $needsMore = true;
            }else{
                $score = ", `score` = '".mysqli_real_escape_string($bd, $_POST['score'])."'";
            }
            break;
        case 'award':
            $status = 'Awarded';
            $timestamp = "`time_finalized` = CURRENT_TIMESTAMP, ";
            $awarded = true;
            break;
    }
    if($needsMore){
        echo "You must fill out all fields before continuing.";
    }else{
        //Update databse to reflect new status
        $query = "UPDATE `submissions` SET ".$timestamp."`last_updated` = CURRENT_TIMESTAMP, `status` = '".$status."', `message` = ".$comment."".$score." WHERE `submissions`.`id` = ".$id."";

        $result = mysqli_query($bd, $query);
        if($result){
            echo "Success! Submission is now ".$status.".";
        }
        else{
            echo mysqli_error($bd);
        }
    }
} else{
    echo "Post not sent";
}
?>
