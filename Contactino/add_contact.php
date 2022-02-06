<?php
  session_start();
  if(!isset($_SESSION['username_Id'])){
    header("Location:login.php");
  }
?>
<?php include 'head.php' ;?>
<?php include("scripts.php");
require_once 'db_connection.php';
mysqli_set_charset($con,'utf8');

if(isset($_POST["btn_save"]))
{
  extract($_POST);
  $photo = $_FILES['photo']['name'];
  $target = "uploads/contacts/".basename($photo);

  if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
        $msg = "Photo chargé avec succés";
      }else{
        $msg = "Echec de chargement du photo";
      }
     $sql = "INSERT INTO contacts (nom, prenom, telephone1, telephone2, email_Pers,email_Pro,genre,adresse, Etablissement,photo) VALUES ('$nom', '$prenom', '$telephone1', '$telephone2', '$email_Pers', '$email_Pro', '$genre' , '$adresse','$Etablissement', '$photo')";

  if ($con->query($sql) === TRUE) {

      $_SESSION['success']=' Contact ajouté avec succés';
    ?>
  <script type="text/javascript">
  window.location="view_contact.php";
  </script>
  <?php
  } else {
        $_SESSION['error']='Un problème est survenu lors de l\'ajout du contact';
  ?>
  <script type="text/javascript">
  window.location="view_contact.php";

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
								<div class="spur-card-title"> Nouveau Contact</div>
						</div>
						<div class="card-body  pb-0 pt-2">
								<form method="post" name="contactform" enctype="multipart/form-data">
                  <div class="form-row col-md-12">
                      <div class="form-group col-md-6">
                          <label for="inputNom" class="small font-weight-bold">Nom</label>
                          <input type="text" class="form-control form-control-sm" id="nom" name="nom" required>
                      </div>
                      <div class="form-group col-md-6" style="float:right">
                          <label for="inputPreom" class="small font-weight-bold">Prénom</label>
                          <input type="text" class="form-control form-control-sm" id="prenom" name="prenom" required>
                      </div>
                  </div>
                  <div class="form-row col-md-12">
                      <div class="form-group col-md-6">
                          <label for="inputTelephone1" class="small font-weight-bold">N° Téléphone 1</label>
                          <input type="text" class="form-control form-control-sm" id="telephone1" name="telephone1" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputTelephone1" class="small font-weight-bold">N° Téléphone 2</label>
                          <input type="text" class="form-control form-control-sm" id="telephone2" name="telephone2">
                      </div>
                  </div>
                  <div class="form-row col-md-12">
                     <div class="form-group col-md-6">
                         <label for="inputEmailPersonnel" class="small font-weight-bold">Email Personnel</label>
                         <input type="text" class="form-control form-control-sm" id="email_pers" name="email_Pers" required>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="inputEmailPerofessionnel" class="small font-weight-bold">Email Professionnel</label>
                         <input type="text" class="form-control form-control-sm" id="email_pro" name="email_Pro">
                     </div>
                 </div>
                  <div class="form-row col-md-12">
                      <div class="form-group col-md-6">
                          <label for="inputGenre" class="small font-weight-bold">Genre</label>
                          <select id="genre" class="form-control form-control-sm" name="genre">
                              <option selected value="Masculin">Masculin</option>
                              <option value="Feminin">Féminin</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEtatblissement" class="small font-weight-bold">Etatblissement</label>
                          <input type="text" class="form-control form-control-sm" id="etablissement" name="Etablissement">
                      </div>
                  </div>
                  <div class="form-row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="inputAdresse" class="small font-weight-bold">Adresse</label>
                        <input type="text" class="form-control form-control-sm" id="adresse" name="adresse">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPhoto" class="small font-weight-bold">Photo</label>
                        <input type="file" class="form-control form-control-sm" name="photo" id="ProfilePhoto" accept="image/*" required>
                    </div>
                  </div>

           </div>
           <div class="card-footer">
             <a href="view_contact.php" class="btn btn-dark btn-sm float-right"><span class="fa fa-times mr-1"></span>Annuler</a>
             <button type="submit" name="btn_save" class="btn btn-primary btn-sm float-right mr-2" id="saveContactBtn"><span class="fa fa-save mr-1"></span>Sauvegarder</button>
           </div>
								</form>
						</div>
				</div>
		</div>
</div>
