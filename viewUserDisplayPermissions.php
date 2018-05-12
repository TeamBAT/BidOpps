<?php

include_once('action/connection.php');

if(!$bd) {
    
    die('Could not connect: ' . mysql_error());
    
}


$input = filter_input_array(INPUT_POST);

$admin = mysqli_real_escape_string($bd,$input["administrate"]);

$auth = mysqli_real_escape_string($bd,$input["author"]);

$reviewer = mysqli_real_escape_string($bd,$input["review"]);

$approver = mysqli_real_escape_string($bd,$input["approve"]);

$screener = mysqli_real_escape_string($bd,$input["screen"]);

$evaluator = mysqli_real_escape_string($bd,$input["evaluate"]);

$final = mysqli_real_escape_string($bd,$input["finalize"]);

$bidd = mysqli_real_escape_string($bd,$input["bid"]);


if($input["action"] === 'edit') {
    
    $query = "
    update permissions set administrate=$admin,
    author = $auth,
    review = $reviewer,
    approve = $approver,
    screen = $screener,
    evaluate = $evaluator,
    finalize = $final,
    bid = $bidd
    where user_id= '".$input["user_id"]."'
    ";
    
    mysqli_query($bd,$query);
    
}

if($input["action"] === 'delete') {
    
    $queryAdminDeleteFrom_Users = "
    DELETE FROM users
    where id = '".$input["user_id"]."'
    ";
    
    $queryAdminDeleteFrom_Permissions = "
    DELETE FROM permissions
    where user_id = '".$input["user_id"]."'
    ";
    
    $queryAdminDeleteFrom_administrators = "
    DELETE FROM administrators
    where user_id = '".$input["user_id"]."'
    ";
    
    mysqli_query($bd,$queryAdminDeleteFrom_Users);
    
    mysqli_query($bd,$queryAdminDeleteFrom_Permissions);
    
    mysqli_query($bd,$queryAdminDeleteFrom_administrators);
       
}
    
echo json_encode($input);

?>