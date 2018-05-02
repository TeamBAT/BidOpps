<?php

$connect = mysqli_connect('localhost','root','','bidopps_db');

if(!$connect) {
    
    die('Could not connect: ' . mysql_error());
    
}

echo "test";


$input = filter_input_array(INPUT_POST);

$admin = mysqli_real_escape_string($connect,$input["administrate"]);

$auth = mysqli_real_escape_string($connect,$input["author"]);

$reviewer = mysqli_real_escape_string($connect,$input["review"]);

$approver = mysqli_real_escape_string($connect,$input["approve"]);

$screener = mysqli_real_escape_string($connect,$input["screen"]);

$evaluator = mysqli_real_escape_string($connect,$input["evaluate"]);

$final = mysqli_real_escape_string($connect,$input["finalize"]);

$bidd = mysqli_real_escape_string($connect,$input["bid"]);


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
    
    mysqli_query($connect,$query);
    
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
    
    mysqli_query($connect,$queryAdminDeleteFrom_Users);
    
    mysqli_query($connect,$queryAdminDeleteFrom_Permissions);
    
    mysqli_query($connect,$queryAdminDeleteFrom_administrators);
       
}
    
echo json_encode($input);

?>