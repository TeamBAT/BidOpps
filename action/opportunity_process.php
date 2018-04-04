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
            break;
        case 'approve':
            $status = 'Validated';
            break;
        case 'post':
            $status = 'Posted';
            break;
    }
    //Update databse to reflect new status
    $query = "UPDATE `opportunities` SET `status` = '".$status."' WHERE `opportunities`.`id` = ".$id."";
  
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