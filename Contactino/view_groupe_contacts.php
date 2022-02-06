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
?>
<?php
$que="SELECT * from groupes g join icones i on g.idIcone = i.id WHERE g.id='".$_GET["idGroupe"]."'";
$query=$con->query($que);
while($row=mysqli_fetch_array($query))
{
    extract($row);
    $idGroupe = $row["id"];
    $Groupe = $row["libelle"];
    $Icone = $row["codeHTML"];
  }
?>
<?php
if(isset($_GET['idGroupe']))
{
   if(isset($_GET['idGroupeContact'])){

  ?>
<div class="modal show fade" tabindex="-1" role="dialog" style="padding-right: 17px; display:block; background-color:rgba(102, 102, 102, .3)">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content" style="border:2px solid #61c5e1">
    <div class="modal-body text-center">
      <img class="responsive mb-3" src="img/ask.png" style="width:80px; height:80px">
      <h3 class="font-weight-bold mb-3">Confirmation</h3>
      <p>Voulez-vous supprimer ce contact à partir du groupe?</p>
      <a class="btn btn-primary text-white" href="delete_groupe_contacts.php?idGroupe=<?php echo $_GET['idGroupe']; ?>&idGroupeContact=<?php echo $_GET['idGroupeContact']; ?>">Confimrer</a>
      <a class="btn btn-secondary text-white" href="view_groupe_contacts.php?idGroupe=<?php echo $_GET['idGroupe']; ?>">Annuler</a>
    </div>
  </div>
</div>
</div>
<?php unset($_SESSION['success']); ?>

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
										<i class="fas fa-search"></i>
								</div>
                <div class="spur-card-title"> Recherche</div>
						</div>
						<div class="card-body  pb-0">
              <form>
                  <div class="form-row">
                      <div class="form-group col-md-4">
                        <label class="small font-weight-bold">Par nom</label>
                          <input type="text" class="form-control form-control-sm" id="nomSearch">
                      </div>
                      <div class="form-group col-md-4">
                          <label class="small font-weight-bold">Par N° téléphone</label>
                          <input type="text" class="form-control form-control-sm" id="phoneSearch">

                      </div>
                      <div class="form-group col-md-4">
                          <label class="small font-weight-bold">Tous les contacts</label>
                          <a href="view_groupe_contacts.php?idGroupe=<?php echo $_GET['idGroupe']; ?>" class="btn btn-secondary btn-sm d-block"><i class="fa fa-search mr-2"></i>Recherche</a>
                      </div>
                  </div>
              </form>
						</div>
				</div>
		</div>
</div>
<div class="alert alert-primary border border-primary text-center mb-3">
  Groupe:<span class="font-weight-bold ml-2 text-primary"> <?php echo $Icone?></span><span class="font-weight-bold ml-2 text-dark"> <?php echo $Groupe?></span>

</div>
<table class="table small table-responsive-sm" id="contactsTable">
<thead class="bg-dark text-white">
  <tr>
    <th class="text-center">Photo</th>
    <th class="text-center">Nom</th>
    <th class="text-center">Téléphone 1</th>
    <th class="text-center">Email Personnel</th>
    <th class="text-center">Etablissement</th>
    <th class="text-center">Détail</th>
    <th class="text-center">Action</th>
  </tr>
  </thead>
  <tbody class="bg-white">
    <?php
      $query = $con->query("SELECT *, c.id as idC, gc.id as idGC FROM  contacts c  join groups_contacts gc    on c.id = gc.idContact where gc.idGroupe = '".$_GET['idGroupe']."' ORDER BY c.nom") or die(mysqli_error());
      while($row = $query->fetch_array()){
    ?>
    <tr class="p-5">
      <tr class="p-5">
        <td class="align-middle"><img style="width:40px; height:40px" src="uploads/contacts/<?php if($row["photo"] != ""){echo $row["photo"];} else {echo "avatar_contactino.jpg";}?>"/></td>
        <td class="align-middle"><?php echo $row["nom"].' '.$row["prenom"]?></td>
        <td class="align-middle text-center"><?php echo $row["telephone1"]?></td>
        <td class="align-middle"><?php echo $row["email_Pers"]?></td>
        <td class="align-middle text-center"><?php echo $row["Etablissement"]?></td>
        <td class="align-middle text-center">
          <button class="btn btn-light border rounded mb-1 mr-1 pr-2 pl-2" id="detail<?php echo $row["idC"]?>" tabindex="0" role="button" data-toggle="popover" data-trigger="focus"><i class="fa fa-eye"></i></button>
        </td>
      <td class="align-middle text-center">
         <a href="view_groupe_contacts.php?idGroupe=<?=$row["idGroupe"];?>&idGroupeContact=<?=$row["idGC"];?>" class="btn btn-light  border mb-1 pr-2 pl-2 mr-2" title="Supprimer du groupe"><i class="fa fa-trash"></i></a>
      </td>
    </tr>

    <?php
      }
    ?>
  </tbody>
</table>

<?php
$qu = $con->query("SELECT * FROM  groups_contacts gc  join contacts c   on c.id = gc.idContact where gc.idGroupe = '".$_GET['idGroupe']."' ORDER BY c.nom") or die(mysqli_error());
while($r = $qu->fetch_array()){
?>
<div class="d-none" id="detailContent<?php echo $r["id"]?>">
          <span><span class='font-weight-bold text-primary mr-2'>Phone 2:</span><span class="font-weight-bold"><?php echo $r["telephone2"]?></span></span><br>
          <span><span class='font-weight-bold text-primary mr-2'>Email Pro:</span><span class="font-weight-bold"><?php echo $r["email_Pro"]?></span></span><br>
          <span><span class='font-weight-bold text-primary mr-2'>Genre:</span><span class="font-weight-bold"><?php echo $r["genre"]?></span></span><br>
          <span><span class='font-weight-bold text-primary mr-2'>Adresse:</span><span class="font-weight-bold"><?php echo $r["adresse"]?></span></span><br>
</div>
<?php } ?>


<?php if(!empty($_SESSION['success'])) {  ?>
  <div class="modal show fade" tabindex="-1" role="dialog" style="padding-right: 17px;display:block;background-color:rgba(102, 102, 102, .3)">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border:2px solid #3bb54a">
      <div class="modal-body text-center">
        <img class="responsive mb-3" src="img/success.png" style="width:70px; height:70px">
        <h3 class="font-weight-bold mb-3">Succés</h3>
        <p><?php echo $_SESSION['success']; ?></p>
        <?php unset($_SESSION['success']); ?>
        <a class="btn btn-success text-white" href="view_groupe_contacts.php?idGroupe=<?=$_GET["idGroupe"];?>">Fermer</a>
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
      <a class="btn btn-warning text-white" href="view_groupe_contacts.php?idGroupe=<?=$_GET["idGroupe"];?>">Fermer</a>
    </div>
  </div>
</div>
</div>
<?php } ?>

<script>
<?php
$query = $con->query("SELECT * FROM  groups_contacts gc  join contacts c   on c.id = gc.idContact where gc.idGroupe = '".$_GET['idGroupe']."' ORDER BY c.nom") or die(mysqli_error());
while($row = $query->fetch_array()){
?>

$(function () {
$("#detail<?php echo $row["id"]?>").hover(function () {
    $(this).popover({
        title: "<span class='small text-dark mr-2'><b>Autre détails</b></span>",
        content: $('#detailContent<?php echo $row["id"]?>').html(),
        html: true
    }).popover('show');
}, function () {
    $(this).popover('hide');
});
});



<?php } ?>

$("#nomSearch").on("keyup", function() {
    var val = $(this).val().toUpperCase();
    $("#contactsTable tbody tr").each(function() {
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


$("#phoneSearch").on("keyup", function() {
  var val = $(this).val().toUpperCase();
    $("#contactsTable tbody tr").each(function(index) {
      var row = $(this);
            var phone = row.find("td:nth-child(3)").text().toUpperCase();
            if (phone.includes(val) == false) {
                row.hide();
            }
            else {
                row.show();
            }
    });
})
</script>
