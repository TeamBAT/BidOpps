<?php

include_once('action/connection.php');

if(!$bd) {
    
    die('Could not connect: ' . mysql_error());
    
}

$input = $_POST;

$id = mysqli_real_escape_string($bd,$input["id"]);

$firstname = mysqli_real_escape_string($bd,$input["firstname"]);

$lastname = mysqli_real_escape_string($bd,$input["lastname"]);

$email = mysqli_real_escape_string($bd,$input["email"]);

$password = mysqli_real_escape_string($bd,$input["password"]);


if($input["action"] === 'edit') {
    
    $queryAdminInfo = "
    update users
    SET email = '".$email."',
    password = '".$password."',
    firstname = '".$firstname."',
    lastname = '".$lastname."'
    where id = '".$input[id]."'";
    
    mysqli_query($bd,$queryAdminInfo);
        
    
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
    
    mysqli_query($bd,$queryAdminDeleteFrom_Users);
    
    mysqli_query($bd,$queryAdminDeleteFrom_Permissions);
    
    mysqli_query($bd,$queryAdminDeleteFrom_administrators);
       
}
    
echo json_encode($input);

?>