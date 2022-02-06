<?php
//For localhost database
	$con =  new mysqli('localhost','root','','gestion_contacts')or die("Erreur de connexion à la base de données".mysqli_error($con));
//For webhost database
//$con =  new mysqli('sql211.byethost4.com','b4_28978617','springof@0','b4_28978617_gestion_contacts')or die("Erreur de connexion à la base de données".mysqli_error($con));

?>
