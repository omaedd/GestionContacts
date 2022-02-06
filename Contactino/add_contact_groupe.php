<?php
  session_start();
  if(!isset($_SESSION['username_Id'])){
    header("Location:login.php");
  }
include 'head.php' ;
include("scripts.php");
require_once 'db_connection.php';
mysqli_set_charset($con,'utf8');

if(isset($_POST["btn_save"]))
{
   extract($_POST);
   $sql = "INSERT INTO groups_contacts (idContact, idGroupe) VALUES ('$idContact', '$idGroupe')";
   if ($con->query($sql) === TRUE) {
     $_SESSION['success']=' Contact ajouté au groupe avec succés';
    ?>
<script type="text/javascript">
window.location="view_contact.php";
</script>
<?php
} else {
 $_SESSION['error']=' Un problème est survenu lors de l\'ajout du contact au groupe';
?>
<script type="text/javascript">
window.location="view_contact.php";
</script>
<?php
}
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
								<div class="spur-card-title"> Ajout au Groupe</div>
						</div>
						<div class="card-body  pb-0 pt-2">
								<form method="post" name="groupeform" enctype="multipart/form-data">
                  <div class="form-row col-md-12 mt-2">
                      <div class="form-group col-md-6">
                          <label for="inputNom" class="small font-weight-bold">Nom de contact</label>
                          <?php
                          $que="SELECT * from contacts WHERE id='".$_GET["idContact"]."'";
                          $query=$con->query($que);
                          while($row=mysqli_fetch_array($query))
                          {
                          extract($row);
                          $idcontact = $row['id'];
                          $nom = $row['nom'];
                          $prenom = $row['prenom'];

                          }
                          ?>
                          <input type="text" class="form-control form-control-sm" name="nom" value="<?php echo $nom.' '.$prenom?>" disabled>
                          <input type="hidden" class="form-control form-control-sm" name="idContact" value="<?php echo $idcontact?>">
                      </div>
                  </div>
                  <div class="form-row col-md-12 mt-2">
                      <div class="form-group col-md-6">
                          <label for="inputNom" class="small font-weight-bold">Nom de groupe</label>

                          <?php
                          $listgrp="SELECT * from groupes WHERE id NOT IN (SELECT idGroupe FROM groups_contacts gc where gc.idContact = '".$_GET["idContact"]."')";
                          $lquery=$con->query($listgrp);

                          ?>
                          <select id="idGroupe" class="form-control form-control-sm" name="idGroupe" required>
         									 <?php
         										 while($option = mysqli_fetch_array($lquery)){
         											 echo '<option value="'.$option['id'].'">'.$option['libelle'].'</option>';
         										 }
         									 ?>
         									</select>
                        </div>
                      </div>
                  </div>
                  <div class="form-row col-md-12">

           </div>
           <div class="card-footer">
             <a href="view_contact.php" class="btn btn-dark btn-sm float-right"><span class="fa fa-times mr-1"></span>Annuler</a>
             <button type="submit" name="btn_save" class="btn btn-primary btn-sm float-right mr-2"><span class="fa fa-save mr-1"></span>Sauvegarder</button>
           </div>
								</form>
						</div>
				</div>
		</div>
</div>
