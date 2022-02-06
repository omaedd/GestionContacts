<?php
include 'db_connection.php';
session_start();

$sql = "DELETE FROM `contacts` WHERE id='".$_GET["idContact"]."'";
$res = $con->query($sql);
 $_SESSION['success']=' Contact supprimé avec succés';
?>
<script>
window.location = "view_contact.php";
</script>
