<header class="dash-toolbar pt-2 pb-2 border-bottom">
    <a href="#" class="menu-toggle">
        <i class="fas fa-bars"></i>
    </a>
    <div class="tools">
        <div class="dropdown">
            <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <b> <?php echo $_SESSION['prenom']; echo " "; echo $_SESSION['nom'];   ?></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                <a class="dropdown-item" href="logout_submit.php"><i class="fas fa-sign-out-alt mr-1"></i>Se déconnecter</a>
            </div>
        </div>
    </div>
</header>
