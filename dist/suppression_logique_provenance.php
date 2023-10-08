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
    

    $id = $_GET['id_provenance_montant'];

// Requête SQL pour mettre à jour le statut
$sql = "UPDATE `provenance_montant` SET `actif` = '0' WHERE `provenance_montant`.`id_provenance_montant` =$id";

if ($conn->query($sql) === TRUE) {
    //$mess2="<b>Enregistrement supprimé avec succés!</b>";
    header("Location: provenance.php?success=2");
        exit;
    //header("location:provenance.php?mess=$mess2");
    //echo "Enregistrement supprimé avec succès.";
} else {
    
    echo "Erreur lors de la suppression de l'enregistrement : " . $conn->error;
}

$conn->close();
?>
