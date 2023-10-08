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
    $iduser=$_SESSION['Auth']['id_user'];
    $id=@$_POST['id_encaissement'];
    $typeencaisse=@$_POST["typeencaisse"];
    $libelle=@$_POST["libelle"];
    $typemontant=@$_POST["typemontant"];
    $montant=@$_POST["montant"];
    $provemontant=@$_POST["provemontant"];
    $date=@$_POST["date"];
    //var_dump("update encaissement set iduser='$iduser',type_encaisse='$typeencaisse',libelle='$libelle',montant='$montant',sortie='$sortie',date='$date' where encaissement.id=$id");
    $conn->query("update encaissement set id_user='$iduser',id_type_encaissement='$typeencaisse',libelle='$libelle',id_type_montant='$typemontant',montant='$montant',id_provenance_montant='$provemontant',date='$date' where id_encaissement=$id") or die($conn->error);
    
    $mess2="<b>Mise a jour effectuer avec succés</b>";
    header("location:edit.php?mess=$mess2&edit=$id");
    //header('location: liste.php');
}
?>