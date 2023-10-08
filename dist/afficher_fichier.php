<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_de_caisse";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['fichier'])) {
    $nom_fichier = $_GET['fichier'];

    // Requête pour récupérer les informations du fichier
    $sql = "SELECT contenu_fichier, type_mime FROM encaissement WHERE nom_fichier = '$nom_fichier'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Afficher le contenu du fichier
        header('Content-Type: ' . $row['type_mime']);
        echo $row['contenu_fichier'];
    } else {
        echo "Fichier non trouvé.";
    }
} else {
    echo "Nom de fichier manquant.";
}
 
mysqli_close($conn);

?>
