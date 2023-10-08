<?php
session_start();
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

$iduser = $_SESSION['Auth']['id_user'];
$typeencaisse = @$_POST["typeencaisse"];
$libelle = @$_POST["libelle"];
$typemontant = @$_POST["typemontant"];
$montant = @$_POST["montant"];
$provemontant = @$_POST["provemontant"];
//$date = @$_POST["date"];

if (isset($_POST['valider'])) {
    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] == 0) {
        // Récupérer des informations sur le fichier
        $file_name = $_FILES["fileUpload"]["name"];
        $file_tmp = $_FILES["fileUpload"]["tmp_name"];
        $file_type = $_FILES["fileUpload"]["type"];

        // Lire le contenu du fichier
        $file_content = file_get_contents($file_tmp);

        // Échapper les caractères spéciaux
        $file_content = mysqli_real_escape_string($conn, $file_content);
    } else {
        // Aucun fichier téléchargé ou une erreur est survenue
        $file_name = null; // Définir le nom du fichier à null
        $file_type = null; // Définir le type MIME à null
        $file_content = null; // Définir le contenu du fichier à null
    }

    // Insérer les données dans la base de données (y compris le fichier, même s'il peut être null)
    $sql1 = mysqli_query($conn, "INSERT INTO `encaissement` (`id_user`, `id_type_encaissement`, `libelle`, `id_type_montant`, `montant`, `id_provenance_montant`, `date`, `nom_fichier`, `type_mime`, `contenu_fichier`) VALUES ('$iduser', '$typeencaisse', '$libelle', '$typemontant', '$montant', '$provemontant', now(), '$file_name', '$file_type', '$file_content')");

    if ($sql1) {
        //$mess2 = "<b>Enregistrement effectué avec succès !</b>";
       // header("location: forms-validation.php?mess=$mess2");
       header("Location: forms-validation.php?success=1");
        exit; 
        
    } else {
        echo "Une erreur s'est produite lors de l'enregistrement.";
    }
}

?>
