<?php
session_start();
 unset($_SESSION['SESS_MEMBER_ID']);
 unset($_SESSION['SESS_FIRST_NAME']);
 unset($_SESSION['SESS_LAST_NAME']); 
session_destroy();

header("Location: ../index.php");
exit;
?>