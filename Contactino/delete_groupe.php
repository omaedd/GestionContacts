<?php
include 'db_connection.php';
session_start();

$sql = "DELETE FROM groupes WHERE id='".$_GET["idGroupe"]."'";
$sql1 = "DELETE FROM groups_contacts WHERE idGroupe='".$_GET["idGroupe"]."'";

$res = $con->query($sql);
$res1 = $con->query($sql1);
 $_SESSION['success']=' Groupe supprimé avec succés';
?>
<script>
window.location = "view_groupe.php";
</script>
