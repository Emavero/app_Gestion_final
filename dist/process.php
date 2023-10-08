<?php



$host="localhost";
$user="root";
$password="";
$db_name="gestion_de_caisse";
$conn=mysqli_connect($host,$user,$password,$db_name);
if(mysqli_connect_errno()){
    die("Failed to connect with MySQL:".mysqli_connect_error());
}






$id_type_encaissement='';
$libelle='';
$id_type_montant='';
$montant='';
$id_provenance_montant='';
$date = "mm/dd/yyyy";







if(isset($_GET['edit'])){
    
    
    $id=$_GET['edit'];
  
    $result=$conn->query("select * from encaissement where id_encaissement=$id") or die($conn->error);
    
    
        $encaissement=$result->fetch_array();
        
        
        $id_type_encaissement=$encaissement['id_type_encaissement'];
        //echo"rfffffffffffffffffffffffffff";
        $libelle=$encaissement['libelle'];
        $id_type_montant=$encaissement['id_type_montant'];
        $montant=$encaissement['montant'];
        $id_provenance_montant=$encaissement['id_provenance_montant'];
        $date=$encaissement['date'];
        //echo "aaaaaaaaaaaaa";
        
    
}

if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    //$conn->query("update encaissement set actif=0 where id_encaissement=$id");
    $conn->query("UPDATE `encaissement` SET `actif` = '0' WHERE `encaissement`.`id_encaissement` =$id");
    
    //UPDATE `encaissement` SET `actif` = '0' WHERE `encaissement`.`id_encaissement` =$id;
    //UPDATE `encaissement` SET `actif` = '0' WHERE `encaissement`.`id_encaissement` = 1;
}

?>