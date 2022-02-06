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

if(isset($_POST["btn_update"]))
{
    extract($_POST);

  $photo = $_FILES['photo']['name'];
  $target = "uploads/contacts/".basename($photo);

 if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
  /*@unlink("uploads/contacts/".$_POST['old_photo']);*/
      $msg = "Photo modifiée avec succés";
    }else{
      $msg = "Echec lors de la modification du photo";
    }
    $q1="UPDATE contacts SET nom='$nom', prenom='$prenom',telephone1='$telephone1',telephone2='$telephone2',email_Pers = '$email_Pers',email_Pro = '$email_Pro', genre = '$genre', adresse='$adresse', Etablissement = '$Etablissement' ,photo = '$photo'   WHERE id='".$_GET['idContact']."'";

    if ($con->query($q1) === TRUE) {
      $_SESSION['success']=' Contact modifié avec succés';
     ?>
<script type="text/javascript">
window.location="view_contact.php";
</script>
<?php
} else {
  $_SESSION['error']=' Un problème est survenu lors de la modification du contact';
?>
<script type="text/javascript">
window.location="view_contact.php";
</script>
<?php
}
}
?>

<?php
$que="SELECT * from contacts WHERE id='".$_GET["idContact"]."'";
$query=$con->query($que);
while($row=mysqli_fetch_array($query))
{
    extract($row);

$nom = $row['nom'];
$prenom = $row['prenom'];
$telephone1 = $row['telephone1'];
$telephone2 = $row['telephone2'];
$email_Pers = $row['email_Pers'];
$email_Pro = $row['email_Pro'];
$genre = $row['genre'];
$adresse = $row['adresse'];
$Etablissement = $row['Etablissement'];
$photo = $row['photo'];
}
$photo_defualt = "avatar_contactino.jpg";

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
										<i class="fas fa-edit"></i>
								</div>
								<div class="spur-card-title"> Modifier Contact</div>
						</div>
						<div class="card-body  pb-0 pt-2">
								<form method="post" name="contactform" enctype="multipart/form-data">
                  <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <image class="responsive thumbnail mb-2 border rounded-circle" src='uploads/contacts/<?php if($photo != ""){echo $photo;} else {echo $photo_defualt;}?>' style="height:100px;width:100px;">
                        <input type="hidden" name="old_photo" value="<?=$photo?>">
                        <input type="file" class="form-control form-control-sm" name="photo" id="photo" accept="image/*" value="<?=$photo?>">
                    </div>
                  </div>
                  <div class="form-row col-md-12">
                      <div class="form-group col-md-6">
                          <label for="inputNom" class="small font-weight-bold">Nom</label>
                          <input type="text" class="form-control form-control-sm" id="nom" name="nom" value="<?php echo $nom; ?>" required>
                      </div>
                      <div class="form-group col-md-6" style="float:right">
                          <label for="inputPreom" class="small font-weight-bold">Prénom</label>
                          <input type="text" class="form-control form-control-sm" id="prenom" name="prenom" value="<?php echo $prenom; ?>" required>
                      </div>
                  </div>
                  <div class="form-row col-md-12">
                      <div class="form-group col-md-6">
                          <label for="inputTelephone1" class="small font-weight-bold">N° Téléphone 1</label>
                          <input type="text" class="form-control form-control-sm" id="telephone1" name="telephone1" value="<?php echo $telephone1; ?>" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputTelephone1" class="small font-weight-bold">N° Téléphone 2</label>
                          <input type="text" class="form-control form-control-sm" id="telephone2" name="telephone2" value="<?php echo $telephone2; ?>">
                      </div>
                  </div>
                  <div class="form-row col-md-12">
                     <div class="form-group col-md-6">
                         <label for="inputEmailPersonnel" class="small font-weight-bold">Email Personnel</label>
                         <input type="text" class="form-control form-control-sm" id="email_pers" name="email_Pers" value="<?php echo $email_Pers; ?>" required>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="inputEmailPerofessionnel" class="small font-weight-bold">Email Professionnel</label>
                         <input type="text" class="form-control form-control-sm" id="email_pro" name="email_Pro" value="<?php echo $email_Pro; ?>">
                     </div>
                 </div>
                  <div class="form-row col-md-12">
                      <div class="form-group col-md-6">
                          <label for="inputGenre" class="small font-weight-bold">Genre</label>
                          <select id="genre" class="form-control form-control-sm" name="genre">
                              <option selected value="Masculin" <?php if($genre=='Masculin'){ echo "Selected";}?>>Masculin</option>
                              <option value="Feminin" <?php if($genre=='Feminin'){ echo "Selected";}?>>Féminin</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEtatblissement" class="small font-weight-bold">Etatblissement</label>
                          <input type="text" class="form-control form-control-sm" id="etablissement" name="Etablissement" value="<?php echo $Etablissement; ?>">
                      </div>
                  </div>
                  <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="inputAdresse" class="small font-weight-bold">Adresse</label>
                        <input type="text" class="form-control form-control-sm" id="adresse" name="adresse" value="<?php echo $adresse; ?>">
                    </div>
                  </div>

           </div>
           <div class="card-footer">
             <a href="view_contact.php" class="btn btn-dark btn-sm float-right"><span class="fa fa-times mr-1"></span>Annuler</a>
             <button type="submit" class="btn btn-primary btn-sm float-right mr-2" name="btn_update"><span class="fa fa-save mr-1"></span>Modifier</button>
           </div>
								</form>
						</div>
				</div>
		</div>
</div>
