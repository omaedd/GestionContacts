<?php
  session_start();
  if(!isset($_SESSION['username_Id'])){
    header("Location:login.php");
  }
?>
<html lang="en">
<?php include("head.php") ?>
<?php include("scripts.php") ?>

<body>
    <div class="dash ">
      <?php include("sidebar.php") ?>

        <div class="dash-app">
          <?php include("header.php") ?>

            <main class="dash-content">
                <div class="container-fluid">
                  <div class="alert bg-light border fade show" role="alert">
                      <i class="fas fa-info-circle"></i>
                      <span class="content">Bienvenue<b> <?php echo $_SESSION['prenom']; echo " "; echo $_SESSION['nom'];   ?></b> à votre application Contactino</span>
                      <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" class="small">
                              <i class="fa fa-times"></i>
                          </span>
                      </button>
                  </div>

                  <div class="row dash-row">
  <div class="col-xl-4">
    <?php
    include 'db_connection.php';

     $users_count = mysqli_query($con, "SELECT COUNT(1) FROM utilisateurs");
     $contacts_count = mysqli_query($con, "SELECT COUNT(1) FROM contacts");
     $groupes_count = mysqli_query($con, "SELECT COUNT(1) FROM groupes");

     $users_count_result =  mysqli_fetch_array($users_count);
     $contacts_count_result =  mysqli_fetch_array($contacts_count);
     $groupes_count_result =  mysqli_fetch_array($groupes_count);
    ?>
      <div class="stats stats-primary">
          <h3 class="stats-title">Utilisateurs</h3>
          <div class="stats-content">
              <div class="stats-icon">
                  <i class="fas fa-lock"></i>
              </div>
              <div class="stats-data">
                  <div class="stats-number"><?php echo $users_count_result[0];?></div>
                  <div class="stats-change">
                      <span class="stats-timeframe">Utilisateurs actifs</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-4">
      <div class="stats stats-warning ">
          <h3 class="stats-title text-white"> Contacts </h3>
          <div class="stats-content">
              <div class="stats-icon">
                  <i class="fas fa-id-badge text-white"></i>
              </div>
              <div class="stats-data">
                <div class="stats-number text-white"><?php echo $contacts_count_result[0];?></div>
                  <div class="stats-change">
                      <span class="stats-timeframe">Contacts ajoutés</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-4">
      <div class="stats stats-secondary ">
          <h3 class="stats-title"> Groupes </h3>
          <div class="stats-content">
              <div class="stats-icon">
                  <i class="fas fa-user-friends"></i>
              </div>
              <div class="stats-data">
                <div class="stats-number"><?php echo $groupes_count_result[0];?></div>
                  <div class="stats-change">
                      <span class="stats-timeframe">Groupes crées</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<center><img src="img/home_contactino.png" id="illustration" style="width:80% ; margin-top:-60px"></center>

                </div>
            </main>
        </div>
    </div>
</body>

</html>
