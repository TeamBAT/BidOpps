<?php
       require_once("connection.php");
       $id=$_SESSION['id'];
       $query = "UPDATE `opportunities` SET `status` = 'drafted'  WHERE `id` = '$id'"; //Insert Query
        mysqli_query($bd, $query);
        unset($_SESSION['id']);

?>