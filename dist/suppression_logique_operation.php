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

    

    $id = $_GET['id_encaissement'];

// Requête SQL pour mettre à jour le statut
$sql = "UPDATE `encaissement` SET `actif` = '0' WHERE `encaissement`.`id_encaissement` =$id";

if ($conn->query($sql) === TRUE) {
    
    //header("location:index8.php?mess=$mess2");
    header("Location: index.php?success=1");
        exit; 
    //echo "Enregistrement supprimé avec succès.";
} else {
    
    echo "Erreur lors de la suppression de l'enregistrement : " . $conn->error;
}

$conn->close();
?>
