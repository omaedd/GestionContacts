<?php
  session_start();
  if(!isset($_SESSION['username_Id'])){
    header("Location:login.php");
  }

  require_once 'db_connection.php';
  mysqli_set_charset($con,'utf8');
?>
<?php include 'head.php' ;?>
<?php include("scripts.php");

if(isset($_POST["btn_save"]))
{
extract($_POST);
   $sql = "INSERT INTO groupes (libelle, idIcone) VALUES ('$libelle', '$idIcone')";

if ($con->query($sql) === TRUE) {
    $_SESSION['success']=' Groupe ajouté avec succés';
  ?>
<script type="text/javascript">
window.location="view_groupe.php";
</script>
<?php
} else {
      $_SESSION['error']='Un problème est survenu lors de l\'ajout du groupe';
?>
<script type="text/javascript">
window.location="view_groupe.php";

</script>
<?php }} ?>

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
								<div class="spur-card-title"> Nouveau Groupe</div>

						</div>
						<div class="card-body  pb-0 pt-2">
								<form method="post" name="groupeform" enctype="multipart/form-data">
                  <div class="form-row col-md-12 mt-2">
                      <div class="form-group col-md-6">
                          <label for="inputNom" class="small font-weight-bold">Nom du groupe</label>
                          <input type="text" class="form-control form-control-sm" name="libelle" required>
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
                          <input type="radio" name="idIcone" value="<?php echo $row["id"]?>" class="mr-2">
                          <label for="icone" class="mr-2"><?php echo $row["codeHTML"]?></label>
                        </div>
                      </div>
                    <?php }?>
                  </div>

           </div>
           <div class="card-footer">
             <a href="view_groupe.php" class="btn btn-dark btn-sm float-right"><span class="fa fa-times mr-1"></span>Annuler</a>
             <button type="submit" name="btn_save" class="btn btn-primary btn-sm float-right mr-2"><span class="fa fa-save mr-1"></span>Sauvegarder</button>
           </div>
								</form>
						</div>
				</div>
		</div>
</div>
