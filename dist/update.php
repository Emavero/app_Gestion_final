<?php
session_start();
include 'admin.php';
require("auth.php");

if (!Auth::isLogged()) {
    header('Location: login.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_de_caisse";

// Créer la connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['update'])) {
    $id_encaissement = @$_POST["id_encaissement"]; // Récupérez l'ID de l'encaissement à mettre à jour
    $typeencaisse = @$_POST["typeencaisse"];
    $libelle = @$_POST["libelle"];
    $typemontant = @$_POST["typemontant"];
    $montant = @$_POST["montant"];
    $provemontant = @$_POST["provemontant"];
    //$date = @$_POST["date"];

    // Vérifier si un nouveau fichier a été téléchargé
    if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] == 0) {
        // Récupérer des informations sur le fichier
        $file_name = $_FILES["fileUpload"]["name"];
        $file_tmp = $_FILES["fileUpload"]["tmp_name"];
        $file_type = $_FILES["fileUpload"]["type"];

        // Lire le contenu du nouveau fichier
        $file_content = file_get_contents($file_tmp);

        // Échapper les caractères spéciaux
        $file_content = mysqli_real_escape_string($conn, $file_content);

        // Mettre à jour le fichier dans la base de données
        $update_sql = "UPDATE `encaissement` SET `id_type_encaissement`='$typeencaisse', `libelle`='$libelle', `id_type_montant`='$typemontant', `montant`='$montant', `id_provenance_montant`='$provemontant', `nom_fichier`='$file_name', `type_mime`='$file_type', `contenu_fichier`='$file_content' WHERE `id_encaissement`='$id_encaissement'";
    } else {
        // Si aucun nouveau fichier n'a été téléchargé, ne mettez à jour que les autres informations
        $update_sql = "UPDATE `encaissement` SET `id_type_encaissement`='$typeencaisse', `libelle`='$libelle', `id_type_montant`='$typemontant', `montant`='$montant', `id_provenance_montant`='$provemontant' WHERE `id_encaissement`='$id_encaissement'";
    }

    $result = mysqli_query($conn, $update_sql);

    if ($result) {
        /*$mess2 = "<b>Mise à jour effectuée avec succès !</b>";
        header("location: edit.php?mess=$mess2");*/
        header("Location: edit.php?success=1");
        exit; 
    } else {
        echo "Une erreur s'est produite lors de la mise a jour.";
    }
}


?>
