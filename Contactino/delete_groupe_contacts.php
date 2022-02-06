<?php
include 'db_connection.php';
session_start();

$sql = "DELETE FROM `groups_contacts` WHERE id='".$_GET["idGroupeContact"]."'";
$res = $con->query($sql);
 $_SESSION['success']=' Contact supprimé à partir du groupe avec succés';
?>
<script>
window.location = "view_groupe_contacts.php?idGroupe=<?=$_GET["idGroupe"];?>";
</script>
