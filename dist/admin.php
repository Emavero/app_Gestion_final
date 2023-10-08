<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db_name="gestion_de_caisse";
$conn=mysqli_connect($host,$user,$password,$db_name);
if(mysqli_connect_errno()){
    die("Failed to connect with MySQL:".mysqli_connect_error());
}

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['Auth']['id_user'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('Location: page-login.php');
    exit();
}

// Exécutez une requête SQL pour sélectionner le champ isAdmin de la table user
$sql = "SELECT isAdmin FROM user WHERE id_user='" . $_SESSION['Auth']['id_user'] . "'";
$result = $conn->query($sql);

if ($result && $result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $isAdmin = $row['isAdmin'];

    // Vérifiez si l'utilisateur est un administrateur
    if ($isAdmin != 1) {
        // L'utilisateur n'est pas un administrateur, redirigez-le vers une page d'accès refusé
        header('Location: access_denied.php');
        exit();
    }
} else {
    // Gestion de l'erreur de requête ou de l'utilisateur non trouvé
    header('Location: error.php');
    exit();
}

// Le code de la page admin va ici
?>
