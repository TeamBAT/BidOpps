<?php

$connect = mysqli_connect('localhost','root','','bidopps_db');

$input = $_POST;

$id = mysqli_real_escape_string($connect,$input["id"]);

$firstname = mysqli_real_escape_string($connect,$input["firstname"]);

$lastname = mysqli_real_escape_string($connect,$input["lastname"]);

$email = mysqli_real_escape_string($connect,$input["email"]);

$password = mysqli_real_escape_string($connect,$input["password"]);


if($input["action"] === 'edit') {
    
    $queryAdminInfo = "
    update users
    SET email = '".$email."',
    password = '".$password."',
    firstname = '".$firstname."',
    lastname = '".$lastname."'
    where id = '".$input[id]."'";
    
    mysqli_query($connect,$queryAdminInfo);
        
    
}

if($input["action"] === 'delete') {
    
    $queryAdminDeleteFrom_Users = "
    DELETE FROM users
    where id = '".$input[id]."'
    ";
    
    $queryAdminDeleteFrom_Permissions = "
    DELETE FROM permissions
    where user_id = '".$input[id]."'
    ";
    
    $queryAdminDeleteFrom_administrators = "
    DELETE FROM administrators
    where user_id = '".$input[id]."'
    ";
    
    mysqli_query($connect,$queryAdminDeleteFrom_Users);
    
    mysqli_query($connect,$queryAdminDeleteFrom_Permissions);
    
    mysqli_query($connect,$queryAdminDeleteFrom_administrators);
       
}
    
echo json_encode($input);

?>