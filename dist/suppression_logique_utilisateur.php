<?php
// Connexion à la base de données (assurez-vous d'avoir configuré vos paramètres de connexion)
$host="localhost";
$user="root";
$password="";
$db_name="gestion_de_caisse";
$conn=mysqli_connect($host,$user,$password,$db_name);
if(mysqli_connect_errno()){
    die("Failed to connect with MySQL:".mysqli_connect_error());
}

// Récupérer l'ID de l'enregistrement à marquer comme inactif
//$mess2="";
    

    $id = $_GET['id_user'];

// Requête SQL pour mettre à jour le statut
$sql = "UPDATE `user` SET `actif` = '0' WHERE `user`.`id_user` =$id";

if ($conn->query($sql) === TRUE) {
    //$mess2="<b>Enregistrement supprimé avec succés!</b>";
    header("Location: utilisateur.php?success=2");
        exit;
    //header("location:provenance.php?mess=$mess2");
    //echo "Enregistrement supprimé avec succès.";
} else {
    
    echo "Erreur lors de la suppression de l'enregistrement : " . $conn->error;
}

$conn->close();
?>
