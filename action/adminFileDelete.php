<?php
require_once('connection.php');
$fileName=$_POST['id'];
unlink('../Uploads/'.$fileName);
echo $_POST['id'];
$sql="DELETE FROM opportunity_docs WHERE filename='$fileName'";
mysqli_query($bd,$sql);
?>