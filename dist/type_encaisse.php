<?php 

session_start();
require("auth.php");



    
    //include_once("connexion.php");

    if(Auth::isLogged()){
   
    }else{
        header('Location:page-login.php');
    }




$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_de_caisse";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
} 



$type_encaisse=@$_POST["type_encaisse"];



if(isset($_POST['valide'])){
    var_dump($_POST);
  

    $sql1=mysqli_query($conn,"INSERT INTO `type_encaissement` (`id_type_encaissement`, `nom_type`) VALUES (NULL, '$type_encaisse')");
      if($sql1){
      //$mess2="<b>Enregistrement éffectué avec succès !</b>";
      header("Location: type_encaissement.php?success=1");
        exit; 
      //header("location:type_encaissement.php?mess=$mess2");
     
    }
    else{
     $mess2="<b>Erreur !</b>";
    }
    }
?>

