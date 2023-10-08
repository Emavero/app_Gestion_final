<?php
session_start();
require("auth.php");
if(Auth::isLogged()){
  
}else{
    header('Location:login.php');
}

$host="localhost";
$user="root";
$password="";
$db_name="gestion_de_caisse";
$conn=mysqli_connect($host,$user,$password,$db_name);
if(mysqli_connect_errno()){
    die("Failed to connect with MySQL:".mysqli_connect_error());
}
var_dump($_SESSION['Auth']['id_user']);
    

if(isset($_POST['update'])){
    
    //$id=@$_POST['id'];
    //$iduser=@$_POST["iduser"];
    //$iduser=$_SESSION['Auth']['id'];
    /*$iduser=$_SESSION['Auth']['id_user'];
    $id=@$_POST['id_encaissement'];
    $typeencaisse=@$_POST["typeencaisse"];
    $libelle=@$_POST["libelle"];
    $typemontant=@$_POST["typemontant"];*/
    $id=@$_POST['id_provenance_montant'];
    $nom_provenance_montant=@$_POST["nom_provenance_montant"];
    
    //var_dump("update encaissement set iduser='$iduser',type_encaisse='$typeencaisse',libelle='$libelle',montant='$montant',sortie='$sortie',date='$date' where encaissement.id=$id");
    
    //$conn->query("update encaissement set id_user='$iduser',id_type_encaissement='$typeencaisse',libelle='$libelle',id_type_montant='$typemontant',montant='$montant',id_provenance_montant='$provemontant',date='$date' where id_encaissement=$id") or die($conn->error);

    $conn->query("UPDATE `provenance_montant` SET `nom_provenance_montant` = '$nom_provenance_montant' WHERE `provenance_montant`.`id_provenance_montant` = $id") or die($conn->error);
    //UPDATE `type_encaissement` SET `nom_type` = 'frais de transport' WHERE `type_encaissement`.`id_type_encaissement` = 1;
    //$mess2="<b>Mise a jour effectuer avec succés</b>";
    header("Location: edit_provenance.php?success=1 & edit=$id");
        exit; 
    //header("location:edit_provenance.php?mess=$mess2&edit=$id");
    //header('location: liste.php');
}
?>