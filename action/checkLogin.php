<?php
include_once('connection.php');
function check_login($bd){
    
    if(!isset($_SESSION['SESS_MEMBER_ID'])){ 
        header("Location: index.php");
        return false;
    }
    else{
        //Check Permissions
        $query = "SELECT * FROM permissions WHERE user_id = ".$_SESSION['SESS_MEMBER_ID']."";
        $result = mysqli_query($bd, $query);
        if(!$result){
            header("Location: index.php");
            return false;
        }
        else{
            $permissions = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return $permissions;
        }
    }
}
?>