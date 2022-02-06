<?php
  session_start();
  if(!isset($_SESSION['username_Id'])){
    header("Location:login.php");
  }
?>
<?php include 'head.php' ;?>
<?php include("scripts.php") ?>

 <?php
 include('db_connection.php');
 mysqli_set_charset($con,'utf8');

if(isset($_POST["btn_update"]))
{
    extract($_POST);
$q1="UPDATE groupes SET libelle='$libelle', idIcone='$idIcone' WHERE id='".$_GET['idGroupe']."'";

    if ($con->query($q1) === TRUE) {
      $_SESSION['success']=' Groupe modifié avec succés';
     ?>
<script type="text/javascript">
window.location="view_groupe.php";
</script>
<?php
} else {
  $_SESSION['error']=' Un problème est survenu lors de la modification du groupe';
?>
<script type="text/javascript">
window.location="view_groupe.php";
</script>
<?php
}
}
?>

<?php
$que="SELECT * from groupes WHERE id='".$_GET["idGroupe"]."'";
$query=$con->query($que);
while($row=mysqli_fetch_array($query))
{
    extract($row);

$libelle = $row['libelle'];
$idIcone = $row['idIcone'];
}
?>

<body>
    <div class="dash">
       <?php include 'sidebar.php' ;?>
        <div class="dash-app">
          <?php include("header.php") ?>

            <main class="dash-content">
                <div class="container-fluid">

		<div class="row">
		<div class="col-xl-12">
				<div class="card spur-card">
						<div class="card-header">
								<div class="spur-card-icon">
										<i class="fas fa-plus-square"></i>
								</div>
								<div class="spur-card-title"> Modifier Groupe</div>
						</div>
						<div class="card-body  pb-0 pt-2">
								<form method="post" name="groupeform" enctype="multipart/form-data">
                  <div class="form-row col-md-12 mt-2">
                      <div class="form-group col-md-6">
                          <label for="inputNom" class="small font-weight-bold">Nom du groupe</label>
                          <input type="text" class="form-control form-control-sm" name="libelle" value="<?=$libelle?>" required>
                      </div>
                  </div>
                  <div class="form-row col-md-12 mt-2">
                      <div class="form-group col-md-6">
                          <label for="inputNom" class="small font-weight-bold">Icone du groupe</label>
                      </div>
                  </div>
                  <div class="form-row col-md-12">
                    <?php
                    $query = $con->query("SELECT * FROM  icones ORDER BY libelle") or die(mysqli_error());
                    while($row = $query->fetch_array()){
                    ?>
                      <div class="form-group col-md-3">
                        <label for="inputNom" class="small">Icone Pour :<span class="font-weight-bold text-primary"> <?php echo $row["libelle"]?></span></label>
                        <div>
                          <input type="radio" name="idIcone" value="<?php echo $row["id"]?>"  class="mr-2" <?php echo ($row["id"]==$idIcone)?'checked':'' ?>>
                          <label for="icone" class="mr-2"><?php echo $row["codeHTML"]?></label>
                        </div>
                      </div>
                    <?php }?>
                  </div>

           </div>
           <div class="card-footer">
             <a href="view_groupe.php" class="btn btn-dark btn-sm float-right"><span class="fa fa-times mr-1"></span>Annuler</a>
             <button type="submit" name="btn_update" class="btn btn-primary btn-sm float-right mr-2"><span class="fa fa-save mr-1"></span>Sauvegarder</button>
           </div>
								</form>
						</div>
				</div>
		</div>
</div>
