<?php 
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



$type_provenance=@$_POST["type_provenance"];



if(isset($_POST['valide']) && !empty($_POST['type_provenance'])){
    var_dump($_POST);
  

    $sql1=mysqli_query($conn,"INSERT INTO `provenance_montant` (`id_provenance_montant`, `nom_provenance_montant`) VALUES (NULL, '$type_provenance')");
      if($sql1){
      //$mess2="<b>Enregistrement éffectué avec succès !</b>";
      header("Location: provenance.php?success=1");
        exit;
      //header("location:provenance.php?mess=$mess2");
     
    }
    else{
     echo"<b>Erreur !</b>";
    }
    }
?>

