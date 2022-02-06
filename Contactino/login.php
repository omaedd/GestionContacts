<html>
<?php include("head.php");
$error="";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
	require_once 'db_connection.php';
	$username = trim($_POST['username']);
	$password = md5($_POST['password']);
	if(strlen($username) > 0 && strlen(trim($_POST['password'])) > 0){
		$check = mysqli_query($con, "SELECT * FROM utilisateurs WHERE username='$username' AND password='$password' ");
		if(mysqli_num_rows($check)==1){
			//fetch details
			$row = mysqli_fetch_assoc($check);
			$_SESSION['username_Id'] = $row['id'];
			$_SESSION['nom'] = $row['nom'];
			$_SESSION['prenom'] = $row['prenom'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['last_login'] = $row['last_login'];
			if($_SESSION['last_login']==""){
				$_SESSION['last_login'] = "Nouveau";
			}
			//last login update
			$dateTime = date('d F Y h:i A');
			mysqli_query($con, "UPDATE utilisateurs SET last_login='$dateTime' WHERE username='$username' ");
			//success
			header("location: index.php");
		}else {
			 $error = "Login ou mot de passe incorrectes !";
		}
 }
}
?>

	<body>
<div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <h3 class="login-heading mb-4 text-center">Authentification!</h3>
							<?php if($error != ""){?>
							<div class="alert alert-danger text-danger d-block font-weight-bold text-center mb-3"><i class="fa fa-exclamation-triangle mr-2"></i><?php echo $error;?></div>
              <?php }?>

              <form role="form" method="post">
                <div class="form-label-group">
                  <input type="text" id="username" name="username" class="form-control" placeholder="omita" required autofocus required autocomplete="off">
                  <label for="username">Nom d'utilisateur</label>
                </div>

                <div class="form-label-group">
                  <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required autocomplete="off">
                  <label for="password">Mot de passe</label>
                </div>

                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Se rappeler de moi</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase mb-5" type="submit">Se Connecter</button>
								<p class="text-center small">Nom d'utilisateur : <span class="text-success">admin</span></p>
								<p class="text-center small">Mot de passe : <span class="text-danger">ensah2021</span></p>
						  </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
