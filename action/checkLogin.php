<?php
if(isset($_SESSION['SESS_MEMBER_ID'])){
	if(isset($_SESSION['SESS_PERMISSIONS']))
		$permissions = $_SESSION['SESS_PERMISSIONS'];
	else $permissions = 'Bidder';
}
else{
	header('../index.php');
}
?>