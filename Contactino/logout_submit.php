<?php
	session_start();
	if(isset($_SESSION['username_Id'])){
		session_destroy();
	}
	header("Location:logout.php");
?>
