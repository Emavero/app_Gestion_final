<?php
         //Admin

                 // Supposons que vous avez déjà établi une connexion à la base de données
//$userId=$_SESSION['Auth']['id_user'];
//$userId = $_SESSION['user_id']; // Supposons que vous avez une session d'utilisateur
//$sql = "SELECT * FROM user WHERE id_user='$iduser'";
//$sql = "SELECT isAdmin FROM user WHERE id_user='$iduser'";
//$result = $conn->query($sql);
//$result = mysqli_query($connexion, $query);
//if ($result->num_rows > 0) {
    //$row = $result->fetch_assoc();
    //$login = $row["login"];
//}

//if ($result && mysqli_num_rows($result) == 1) {
    //$row = mysqli_fetch_assoc($result);
    //$isAdmin = $row['isAdmin']; // La valeur isAdmin de l'utilisateur connecté
//} else {
    // Gestion de l'erreur de requête ou de l'utilisateur non trouvé
    //$isAdmin = false;
//}
$userId = $_SESSION['Auth']['id_user']; // Récupérez l'ID de l'utilisateur à partir de la session

// Exécutez une requête SQL pour sélectionner le champ isAdmin de la table user
$sql = "SELECT isAdmin FROM user WHERE id_user='$userId'";

$result = $conn->query($sql);

if ($result && $result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $isAdmin = $row['isAdmin']; // La valeur isAdmin de l'utilisateur connecté
} else {
    // Gestion de l'erreur de requête ou de l'utilisateur non trouvé
    $isAdmin = false;
}





                 //enAdmin


    ?>