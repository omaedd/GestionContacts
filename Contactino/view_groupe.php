<?php
  session_start();
  if(!isset($_SESSION['username_Id'])){
    header("Location:login.php");
  }
?>
<?php include 'head.php' ;?>
<?php include("scripts.php");

if(isset($_GET['idGroupe']))
{ ?>
<div class="modal show fade" tabindex="-1" role="dialog" style="padding-right: 17px; display:block; background-color:rgba(102, 102, 102, .3)">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content" style="border:2px solid #61c5e1">
    <div class="modal-body text-center">
      <img class="responsive mb-3" src="img/ask.png" style="width:80px; height:80px">
      <h3 class="font-weight-bold mb-3">Confirmation</h3>
      <p>Voulez-vous supprimer ce groupe?</p>
      <a class="btn btn-primary text-white" href="delete_groupe.php?idGroupe=<?php echo $_GET['idGroupe']; ?>">Confimrer</a>
      <a class="btn btn-secondary text-white" href="view_groupe.php">Annuler</a>
    </div>
  </div>
</div>
</div>
<?php unset($_SESSION['success']); ?>

<?php } ?>

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
										<i class="fas fa-search"></i>
								</div>
								<div class="spur-card-title"> Recherche</div>
								<div class="spur-card-menu">
									<a href="add_groupe.php" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i>Nouveau</a>
								</div>

						</div>
						<div class="card-body  pb-0">
								<form>
										<div class="row">
												<div class="form-group col-md-4">
                          <label class="small font-weight-bold">Par nom</label>
														<input type="text" class="form-control form-control-sm" id="nomSearch">
												</div>
                        <div class="form-group col-md-4">
                        </div>
												<div class="form-group col-md-4">
                          <label class="small font-weight-bold">Tous les groupes</label>
														<a href="view_groupe.php" class="btn btn-secondary btn-sm d-block"><i class="fa fa-search mr-2"></i>Recherche</a>
												</div>
										</div>
								</form>
						</div>
				</div>
		</div>
</div>

<?php
   require_once 'db_connection.php';
   mysqli_set_charset($con,'utf8');
?>
<table class="table small table-responsive-sm" id="groupesTable">
<thead class="bg-dark text-white">
  <tr>
    <th class="text-center">Icone</th>
    <th class="text-center">Nom du groupe</th>
    <th class="text-center">Contacts</th>
    <th class="text-center">Détails des contacts</th>
    <th class="text-center">Action</th>
  </tr>
  </thead>
  <tbody class="bg-white">
    <?php
      $query = $con->query("SELECT * FROM  icones i join  groupes g on g.idIcone = i.id  ORDER BY g.libelle") or die(mysqli_error());
      while($row = $query->fetch_array()){
    ?>
    <tr class="p-5" id="'.$row['id'].'" >
      <td class="align-middle text-center"><h4 class="text-primary"><?php echo $row["codeHTML"]?></h4></td>
      <td class="align-middle text-center"><?php echo $row["libelle"]?></td>
      <td class="align-middle text-center">
        <a class="btn btn-light border rounded mb-1 mr-1 pr-2 pl-2" id="<?php echo $row["id"]?>" tabindex="0" role="button" data-toggle="popover" data-trigger="focus"><i class="fa fa-user-friends"></i></a>
      </td>
      <td class="align-middle text-center">
        <a class="btn btn-light border rounded mb-1 mr-1 pr-2 pl-2" href="view_groupe_contacts.php?idGroupe=<?=$row['id'];;?>" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Infos des contacts du groupe"><i class="fa fa-eye"></i></a>
      </td>
      <td class="align-middle text-center">
         <a href="edit_groupe.php?idGroupe=<?=$row['id'];?>" class="btn btn-light border mb-1 mr-1 pr-2 pl-2" title="Modifier le groupe"><i class="fa fa-edit"></i></a>
         <a href="view_groupe.php?idGroupe=<?=$row['id'];?>" class="btn btn-light  border mb-1 pr-2 pl-2 mr-2" title="Supprimer  le groupe"><i class="fa fa-trash"></i></a>
      </td>

    </tr>

    <?php
      }
    ?>
  </tbody>
</table>

<?php if(!empty($_SESSION['success'])) {  ?>
  <div class="modal show fade" tabindex="-1" role="dialog" style="padding-right: 17px;display:block;background-color:rgba(102, 102, 102, .3)">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border:2px solid #3bb54a">
      <div class="modal-body text-center">
        <img class="responsive mb-3" src="img/success.png" style="width:70px; height:70px">
        <h3 class="font-weight-bold mb-3">Succés</h3>
        <p><?php echo $_SESSION['success']; ?></p>
        <?php unset($_SESSION['success']); ?>
        <a class="btn btn-success text-white" href="view_groupe.php">Fermer</a>
      </div>
    </div>
  </div>
  </div>


<?php } if(!empty($_SESSION['error'])) {  ?>
<div class="modal show fade" tabindex="-1" role="dialog" style="padding-right: 17px; display:block; background-color:rgba(102, 102, 102, .3)">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content" style="border:2px solid #FCAE3F">
    <div class="modal-body text-center">
      <img class="responsive mb-3" src="img/warning.png" style="width:70px; height:70px">
      <h3 class="font-weight-bold mb-3">Erreur</h3>
      <p><?php echo $_SESSION['error']; ?></p>
      <?php unset($_SESSION['error']); ?>
      <a class="btn btn-warning text-white" href="view_groupe.php">Fermer</a>
    </div>
  </div>
</div>
</div>
<?php } ?>



<script>



<?php
$query = $con->query("SELECT * FROM  groupes") or die(mysqli_error());
while($row = $query->fetch_array()){
?>
$(function () {
  $("#<?php echo $row["id"]?>").hover(function () {
      $(this).popover({
          title: "<span class='small text-dark mr-2'><b>Contacts du groupe:<span class='text-danger'> <?php echo $row["libelle"] ?></span> </b></span>",
          content: "<?php
            $idgroupe = $row['id'];
            $contacts = $con->query("SELECT * FROM groups_contacts gc JOIN contacts c on gc.idContact = c.id where gc.idGroupe = $idgroupe ");
            if(mysqli_num_rows($contacts)==0){?>
              <?php echo "<span class='alert alert-danger small p-1 d-block text-center'><b>Aucun contact</b><span>";?>
           <?php }
              else {
                   while($contact = $contacts->fetch_array()){?>
                 <?php
                     echo "<img class='img_popover img-fluid' src='uploads/contacts/";if($contact["photo"] != ""){echo $contact["photo"];} else {echo "avatar_contactino.jpg";};echo "'>";
                     echo "<span class='text-dark font-weight-bold ml-3'>";
                     echo $contact["nom"]; echo " ";echo $contact["prenom"];  echo "</span'>";?><br/><hr class='mt-1 mb-1' /><?php }?>
              <?php }?>",
          html: true
      }).popover('show');
  }, function () {
      $(this).popover('hide');
  });
})
<?php } ?>

$("#nomSearch").on("keyup", function() {
    var val = $(this).val().toUpperCase();
    $("#groupesTable tbody tr").each(function(index) {
            var row = $(this);
            var nom = row.find("td:nth-child(2)").text().toUpperCase();
            if (nom.includes(val) == false) {
                row.hide();
            }
            else {
                row.show();
            }
    });
})
</script>





<style>
.img_popover{
  width:40px;
   height:40px;
   border-radius: 5px;
   border:1px solid lightgray;
}
</style>
