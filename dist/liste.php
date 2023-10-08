<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste</title>
</head>
<body>
<?php



$host="localhost";
$user="root";
$password="";
$db_name="gestion_de_caisse";
$conn=mysqli_connect($host,$user,$password,$db_name);
if(mysqli_connect_errno()){
    die("Failed to connect with MySQL:".mysqli_connect_error());
}




                                $rq1=mysqli_query($conn,"select * from encaissement e, provenance_montant t, type_encaissement u, type_montant v where e.id_type_encaissement=u.id_type_encaissement and e.id_type_montant=v.id_type_montant and e.id_provenance_montant=t.id_provenance_montant");

                            ?>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:60px;">Numero</th>
                                            <th>Type_encaissement</th>
                                            <th>Libellé</th>
                                            <th>Type_montant</th>
                                            <th>Montant</th>                                    
                                            <th>Provenance</th>
                                            <th>D ate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                          $i=0;
                                          while($rst=mysqli_fetch_assoc($rq1)):
    //var_dump($rst);
                                          $i++;

                                      ?>
                                        <tr>
                                            <td><?php echo $i;  ?></td>
                                            <td><?php echo $rst['nom_type']  ?></td>
                                            <td><?php echo $rst['libelle']  ?></td>
                                            <td><?php echo $rst['nom_type_montant']  ?></td>
                                            <td><?php echo $rst['montant']  ?></td>
                                            <td><?php echo $rst['nom_provenance_montant']  ?></td>
                                            <td><?php echo $rst['date']  ?></td>
                                        </tr>
                                        
                                        
                                        <?php 
                                         endwhile;
                                        ?>
</body>
</html>