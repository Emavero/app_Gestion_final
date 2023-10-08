<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/Gestion_caisse_ekinoxx/Ges_stock/dist/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/Gestion_caisse_ekinoxx/Ges_stock/dist/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/Gestion_caisse_ekinoxx/Ges_stock/dist/PHPMailer/src/SMTP.php';

include 'admin.php';
require("auth.php");

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


if(isset($_POST['valide']))
  {
    $login=@$_POST["login"];
    $email=@$_POST["email"];
    $isadmin=@$_POST["isadmin"];
    var_dump($_POST);
    if (empty($login) || empty($email)) {
        $error = 'Veuillez remplir tous les champs.';
    }
    else{

    // Générer un mot de passe temporaire
    $motdepasse_temporaire = generateRandomPassword();

    // Crypter le mot de passe temporaire
    $hashed_motdepasse = sha1($motdepasse_temporaire);


    $sql1=mysqli_query($conn,"INSERT INTO `user` (`id_user`, `login`,`email`,`password`,`isAdmin`) VALUES (NULL, '$login','$email','$hashed_motdepasse','$isadmin')");

    if ($sql1) {
        // Paramètres de l'e-mail
        $sujet = "Vos identifiants de connexion";
        $message = "Voici vos identifiants de connexion:\n\n
         Login : $login\n
         Mot de passe : $motdepasse_temporaire\n\n";
        // Envoi de l'e-mail
        $headers = "From: m48568191@gmail.com";

        // Envoyer l'e-mail
        sendEmail($email, $sujet, $message, $headers);
        header("Location: utilisateur.php?success=1");
        exit; 
    } else {
        $errorMessage = "Le rôle n'est pas valide. Utilisez 0 pour un utilisateur normal ou 1 pour un administrateur.";
    }
}
}

function sendEmail($to, $subject, $message, $headers) {
    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'm48568191@gmail.com'; // Votre adresse e-mail Gmail complète
        $mail->Password = 'klbuulwwywjdctsn'; // Utilisez un mot de passe d'application ou le mot de passe Gmail normal si la validation en deux étapes est désactivée
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port = 465; // Port SMTP pour Gmail (SSL)

        // Recipients
        $mail->setFrom('from@example.com', 'Informations de connexions');
        $mail->addAddress($to); // Ajoutez le destinataire

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = 'Ceci est le corps du message en texte brut pour les clients de messagerie non-HTML';

        $mail->send();
        echo 'Le message a été envoyé';
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
    }
}

function generateRandomPassword() {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}
?>

