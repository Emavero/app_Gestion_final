<?php
//echo sha1("modou123");
//echo sha1("1234");
//echo "modou 1234";
session_start();
$mess2="";
$host="localhost";
$user="root";
$password="";
$db_name="gestion_de_caisse";
$conn=mysqli_connect($host,$user,$password,$db_name);
if(mysqli_connect_errno()){
    die("Failed to connect with MySQL:".mysqli_connect_error());
}

if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['pass'])){
    extract($_POST);
    $pass=sha1($pass);
    $sql = "SELECT id_user FROM user WHERE login='$login' AND password='$pass' AND actif = 1";

    //$sql="SELECT id_user FROM user WHERE login='$login' AND password='$pass'";
    $req=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($req);
    if(mysqli_num_rows($req)>0){
       $_SESSION['Auth']=array(
            'login'=>$login,
            'password'=>$pass,
            'id_user'=>$row['id_user']
        );
        header('Location:index.php');
    }else{
        header("Location: page-login.php?error=1");
        //$mess2="<b> Identifients invalide </b>!";
        
    } 
    
    //print_r($_SESSION);

}

?>

<!doctype html>
<html lang="en">

<head>
<title>:: Ekinoxx ::</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Iconic Bootstrap 4.5.0 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<link rel="stylesheet" href="assets/vendor/charts-c3/plugin.css"/>


<link rel="stylesheet" href="assets/css/main.css">

</head>

<body data-theme="light" class="font-nunito">
	<!-- WRAPPER -->
	<div id="wrapper" class="theme-cyan">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main">
				<div class="auth-box">
                    <div class="top">
                        <img src="assets/images/LOGO_TEXTE.png" alt="Iconic">
                    </div>
					<div class="card">
                        <div class="header">
                            <p class="lead">Connectez-vous à votre compte</p>
                        </div>
                        <div class="body">
                        <form class="form-auth-small" name="f1" action="page-login.php" method="POST">
                            <!--<form class="form-auth-small" action="index8.html">-->
                                <div class="form-group">
                                    <label for="login" class="control-label sr-only">Email</label>
                                    <input type="text" class="form-control" name="login" id="signin-email"  placeholder="votre login" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label sr-only">Mot de passe</label>
                                    <input type="password" class="form-control" name="pass" id="signin-password"  placeholder="Mot de passe" required>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox">
                                        <span>Se Souvenir de moi</span>
                                    </label>								
                                </div>
                                <input class="btn btn-primary btn-lg btn-block" type="submit" id="btn" value="Se connecter" style="font-weight: bold;"/>

                                <!--<button type="submit" class="btn btn-primary btn-lg btn-block">Se connecter</button>-->
                                <div class="bottom">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Mot de passe oublié?</a></span>
                                    <span>Vous n'avez pas de compte ? <a href="page-register.html">Enregistrer</a></span>
                                </div>
                                <div>
                                <?php
                                  //echo $mess2;
                                  
                                  if (isset($_GET['error']) && $_GET['error'] == 1) {
                                  echo '<div id="test" class="alert alert-danger">Identifiant ou mot de passe invalide !</div>';
                                  //echo '<script>alert("Enregistrement effectué avec succès !");</script>';
                                 }
                                     
                                ?>

                                </div>
                               
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
    <script>
    window.onload = function(){
setTimeout( function(){
  document.getElementById("test").style.display = 'none';
  //document.getElementById("monid0").style.display = 'none';
}, 3000);
};




</script>
	<!-- END WRAPPER -->
</body>
</html>
