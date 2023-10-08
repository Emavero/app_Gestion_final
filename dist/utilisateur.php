<?php


include 'admin.php';
require("auth.php");

$host="localhost";
$user="root";
$password="";
$db_name="gestion_de_caisse";
$conn=mysqli_connect($host,$user,$password,$db_name);
if(mysqli_connect_errno()){
    die("Failed to connect with MySQL:".mysqli_connect_error());
}

    
    //include_once("connexion.php");

    if(Auth::isLogged()){
   
    }else{
        header('Location:page-login.php');
    }

include_once("process.php");
include 'isAdmin.php'; 


    
    //include_once("connexion.php");

   

?>




<!doctype html>
<html lang="en">

<head>
<title>:: Iconic :: eCommerce</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Iconic Bootstrap 4.5.0 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<link rel="stylesheet" href="assets/vendor/charts-c3/plugin.css"/>
<style>
    .annual_report .c3-axis.c3-axis-y{ display: none;}
    .annual_report .c3-axis.c3-axis-x{ display: none;}
    .resizable-input {
    resize: both;
}

/* Largeur initiale de l'input */
.resizable-input {
    width: 400px; /* Vous pouvez ajuster la largeur initiale selon vos besoins */
}
    
</style>
<script src="https://kit.fontawesome.com/14b44e0e2e.js" crossorigin="anonymous"></script>
<!-- MAIN CSS -->
<link rel="stylesheet" href="assets/css/main.css">
</head>

<body data-theme="light" class="font-nunito">

<div id="wrapper" class="theme-cyan">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="assets/images/logo-icon.svg" width="48" height="48" alt="Iconic"></div>
            <p>veillez patienter s'il vous plait</p>
        </div>
    </div>

    <!-- Top navbar div start -->
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-brand">
                <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-bars"></i></button>
                <button type="button" class="btn-toggle-fullwidth"><i class="fa fa-bars"></i></button>
                <a href="in">Ekinoxx</a> 
            </div>
            
            <div class="navbar-right">
                <!--<form id="navbar-search" class="navbar-form search-form">
                    <input value="" class="form-control" placeholder="Rechercher un operation" type="text">
                    <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                </form>                

                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="page-login.html" class="icon-menu"><i class="fa fa-power-off"></i></a>
                        </li>
                    </ul>
                </div>-->
            </div>
        </div>
    </nav>
    <?php
$iduser=$_SESSION['Auth']['id_user'];
$sql = "SELECT * FROM user WHERE id_user='$iduser'";
$result = $conn->query($sql);

// Vérifiez si la requête a réussi

    // Récupérez le résultat de la requête
   // $row = $result->fetch_assoc();
    //
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $login = $row["login"];
    }
    //var_dump($_SESSION['Auth']['id_user']);
    
    // Affichez le nombre total d'utilisateurs dans une balise <p>
    //echo "<p>Le nombre total d'utilisateurs est : " . $row["total_utilisateurs"] . "</p>";


                ?>
    <!-- main left menu -->
    <div id="left-sidebar" class="sidebar">
        <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="assets/images/user.png" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span>Bienvenue</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo $login;  ?></strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="page-profile2.html"><i class="icon-user"></i>Mon Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="icon-power"></i>Déconnexion</a></li>
                    </ul>
                </div>
                <hr>
            </div>
            <!-- Tab panes -->
            <div class="tab-content padding-0">
                <div class="tab-pane active" id="menu">
                    <nav id="left-sidebar-nav" class="sidebar-nav">
                        <ul id="main-menu" class="metismenu li_animation_delay">
                            <li class="active">
                                <a href="index.php" class="has-arrow"><i class="fa fa-dashboard"></i><span>Accueil</span></a>
                            </li>
                            <li>
                                <a href="bilan.php" class="has-arrow"><i class="fa fa-file"></i><span>Bilan</span></a>
                            </li>
                            <li>
                                <a href="source.php" class="has-arrow"><i class="fa fa-file"></i><span>Source des revenues</span></a>
                            </li>
                            <li>
                                <a href="#forms" class="has-arrow"><i class="fa fa-pencil"></i><span>Gestion des flux</span></a>
                                <ul>
                                <li><a href="forms-validation.php">Ajouter une operation </a></li>
                                <?php
                                if($isAdmin){

                                ?>
                                    <li><a href="type_encaissement.php">Ajouter un type encaissement</a></li>
                                    <li><a href="provenance.php">Ajouter un provenance</a></li>
                                    <?php
                                }

                                    ?>
                                    <li><a href="recherche.php">Rechercher une operation</a></li>
                                    <li><a href="datatable_pdf.php">Imprimer les opérations</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="#Authentication" class="has-arrow"><i class="fa fa-lock"></i><span>Gestion des profiles</span></a>
                                <ul>
                                <li><a href="logout.php">Se déconnecter</a></li>
                                <?php
                                if($isAdmin){

                                ?>
                                    
                                    <li><a href="utilisateur.php">Ajouter utilisateur</a></li>
                                    <?php
                                }

                                    ?>
                                    
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="tab-pane" id="Chat">
                    <form>
                        <div class="input-group m-b-20">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-magnifier"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                    <ul class="right_chat list-unstyled li_animation_delay">
                        <li>
                            <a href="javascript:void(0);" class="media">
                                <img class="media-object" src="assets/images/xs/avatar1.jpg" alt="">
                                <div class="media-body">
                                    <span class="name d-flex justify-content-between">Chris Fox <i class="fa fa-heart-o font-12"></i></span>
                                    <span class="message">chrisfox@gmail.com</span>
                                </div>
                            </a>                            
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="media">
                                <img class="media-object" src="assets/images/xs/avatar2.jpg" alt="">
                                <div class="media-body">
                                    <span class="name d-flex justify-content-between">Joge Lucky <i class="fa fa-heart-o font-12"></i></span>
                                    <span class="message">Jogelucky@gmail.com</span>
                                </div>
                            </a>                            
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="media">
                                <img class="media-object" src="assets/images/xs/avatar3.jpg" alt="">
                                <div class="media-body">
                                    <span class="name d-flex justify-content-between">Isabella <i class="fa fa-heart-o font-12"></i></span>
                                    <span class="message">Isabella@gmail.com</span>
                                </div>
                            </a>                            
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="media">
                                <img class="media-object" src="assets/images/xs/avatar4.jpg" alt="">
                                <div class="media-body">
                                    <span class="name d-flex justify-content-between">Folisise Chosielie <i class="fa fa-heart font-12"></i></span>
                                    <span class="message">FolisiseChosielie@gmail.com</span>
                                </div>
                            </a>                            
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="media">
                                <img class="media-object" src="assets/images/xs/avatar5.jpg" alt="">
                                <div class="media-body">
                                    <span class="name d-flex justify-content-between">Alexander <i class="fa fa-heart-o font-12"></i></span>
                                    <span class="message">Alexander@gmail.com</span>
                                </div>
                            </a>                            
                        </li>                        
                    </ul>
                </div>
                <div class="tab-pane" id="setting">
                    <h6>Choose Skin</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple"><div class="purple"></div></li>
                        <li data-theme="blue"><div class="blue"></div></li>
                        <li data-theme="cyan" class="active"><div class="cyan"></div></li>
                        <li data-theme="green"><div class="green"></div></li>
                        <li data-theme="orange"><div class="orange"></div></li>
                        <li data-theme="blush"><div class="blush"></div></li>
                        <li data-theme="red"><div class="red"></div></li>
                    </ul>

                    <ul class="list-unstyled font_setting mt-3">
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-nunito" checked="">
                                <span class="custom-control-label">Nunito Google Font</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-ubuntu">
                                <span class="custom-control-label">Ubuntu Font</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-raleway">
                                <span class="custom-control-label">Raleway Google Font</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-IBMplex">
                                <span class="custom-control-label">IBM Plex Google Font</span>
                            </label>
                        </li>
                    </ul>

                    <ul class="list-unstyled mt-3">
                        <li class="d-flex align-items-center mb-2">
                            <label class="toggle-switch theme-switch">
                                <input type="checkbox">
                                <span class="toggle-switch-slider"></span>
                            </label>
                            <span class="ml-3">Enable Dark Mode!</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <label class="toggle-switch theme-rtl">
                                <input type="checkbox">
                                <span class="toggle-switch-slider"></span>
                            </label>
                            <span class="ml-3">Enable RTL Mode!</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <label class="toggle-switch theme-high-contrast">
                                <input type="checkbox">
                                <span class="toggle-switch-slider"></span>
                            </label>
                            <span class="ml-3">Enable High Contrast Mode!</span>
                        </li>
                    </ul>                    

                    <hr>
                    <h6>General Settings</h6>
                    <ul class="setting-list list-unstyled">
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" checked>
                                <span>Allowed Notifications</span>
                            </label>                      
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Offline</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Location Permission</span>
                            </label>
                        </li>
                    </ul>

                    <a href="#" target="_blank" class="btn btn-block btn-primary">Buy this item</a>
                    <a href="https://themeforest.net/user/wrraptheme/portfolio" target="_blank" class="btn btn-block btn-secondary">View portfolio</a>
                </div>
                <div class="tab-pane" id="question">
                    <form>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-magnifier"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                    <ul class="list-unstyled question">
                        <li class="menu-heading">HOW-TO</li>
                        <li><a href="javascript:void(0);">How to Create Campaign</a></li>
                        <li><a href="javascript:void(0);">Boost Your Sales</a></li>
                        <li><a href="javascript:void(0);">Website Analytics</a></li>
                        <li class="menu-heading">ACCOUNT</li>
                        <li><a href="javascript:void(0);">Cearet New Account</a></li>
                        <li><a href="javascript:void(0);">Change Password?</a></li>
                        <li><a href="javascript:void(0);">Privacy &amp; Policy</a></li>
                        <li class="menu-heading">BILLING</li>
                        <li><a href="javascript:void(0);">Payment info</a></li>
                        <li><a href="javascript:void(0);">Auto-Renewal</a></li>                        
                        <li class="menu-button mt-3">
                            <a href="../docs/index.html" class="btn btn-primary btn-block">Documentation</a>
                        </li>
                    </ul>
                </div>    
            </div>          
        </div>
    </div>

    <!-- rightbar icon div -->
    <div class="right_icon_bar">
        <ul>
            <li><a href="app-contact.html"><i class="fa fa-id-card"></i></a></li>
            
           
        </ul>
    </div>

    <!-- mani page content body part -->
    <div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix row-deck mt-4">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>Ajouter un utilisateur</h2>
                                        </div>
                                        <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="card">
                                        
                                        <div class="body">
                                            <form  method="post" action="un_utilisateur.php">
                                            
                                              
                                                <div class="form-group">
                                                    <label for="login" class="form-label">Login</label>
                                                    <!--<input type="text" name="login" class="form-control" required>-->
                                                    <input type="text" id="login" name="login" class="form-control resizable-input" required>
                                                    

                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email</label>
                                                    
                                                    <input type="email" id="email" name="email" class="form-control resizable-input" required>
                                                 
                                                </div>
                                                <div class="form-group">
                                                        
                                                        <label for="isadmin" class="form-label">Isadmin</label><br>
                                                        <select class="custom-select resizable-input" name="isadmin"
                                                                id="isadmin">
                                                            <?php
                                                            $rq1 = mysqli_query($conn, "select id_isadmin,nom_isadmin from admin_utilisateur");
                                                            while ($val_isadmin = mysqli_fetch_assoc($rq1)) {
                                                                print "<option value='" . $val_isadmin['id_isadmin'] . "'>" . $val_isadmin['nom_isadmin'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                <!--<div class="form-group">
                                                    <label for="isadmin" class="form-label">Tapez 0 :pour Admin /  1:pour Utilisateur</label>-->
                                                    <!--<input type="password" name="pass" class="form-control" required>-->
                                                    <!--<input type="number" id="isadmin" placeholder="0 ou 1" name="isadmin" class="form-control resizable-input">
                                                    

                                                </div>-->
                                                <?php
                                         if (isset($_GET['error']) && $_GET['error'] == 3) {
                                         echo '<div id="test" class="alert alert-danger">Le champ isAdmin ne peut comporter que 1 ou 2 !</div>';
                                         //echo '<script>alert("Enregistrement effectué avec succès !");</script>';
                                        }
                                            ?>
                                                
                                                
                                                
                                                
                                                
                                                <br>
                                            
                                                <button type="submit" name="valide" class="btn btn-primary">Valider</button>
                                               
                                                <?php
                                         if (isset($_GET['success']) && $_GET['success'] == 1) {
                                         echo '<div id="test" class="alert alert-success">Enregistrement effectué avec succès !</div>';
                                         //echo '<script>alert("Enregistrement effectué avec succès !");</script>';
                                        }
                                            ?>
                                               <?php
                                         if (isset($_GET['success']) && $_GET['success'] == 2) {
                                         echo '<div id="test" class="alert alert-danger">Suppression effectué avec succès !</div>';
                                         //echo '<script>alert("Enregistrement effectué avec succès !");</script>';
                                        }
                                            ?>
                                            
                                            </form>
                                            <?php
                         
                         $host="localhost";
                         $user="root";
                         $password="";
                         $db_name="gestion_de_caisse";
                         $conn=mysqli_connect($host,$user,$password,$db_name);
                         if(mysqli_connect_errno()){
                             die("Failed to connect with MySQL:".mysqli_connect_error());
                         }

                         $rq1=mysqli_query($conn,"select * from admin_utilisateur a, user u where a.id_isadmin=u.isAdmin  and u.actif=1");

                         
                         //$rq1=mysqli_query($conn,"SELECT * FROM `user` WHERE `user`.`actif` =1");
                                          //$rq1=mysqli_query($conn,"select * from encaissement e, user n, provenance_montant t, type_encaissement u, type_montant v where e.id_type_encaissement=u.id_type_encaissement and e.id_user=n.id_user and e.id_type_montant=v.id_type_montant and e.id_provenance_montant=t.id_provenance_montant and e.actif=1");
                         
                         
                         
                                                     ?>
                                                     <div class="row mt-5">
                                                     <div class="table-responsive">
                                                         <table class="table table-bordered table-hover table-striped">
                                                             <thead>
                                                                 <tr>
                                                                     <th style="width:60px;">Numero</th>
                                                                     <th>Utilisateur</th>
                                                                     <th>Email</th>
                                                                     <th>IsAdmin</th>
                                                                     <th>Action</th>
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
                                                                     <td><?php echo $rst['login']  ?></td>
                                                                     <td><?php echo $rst['email']  ?></td>
                                                                     <td><?php echo $rst['nom_isadmin']  ?></td>
                                                                     <td>
                         
                         
                         
                         
                         
                                                                    
                         
                                                                     <a href="javascript:void(0);" class="btn btn-danger" onclick="confirmerSuppression(<?php echo $rst['id_user'];?>)"><i class="fa-solid fa-trash"></i></a>
                         
                                                                      
                                                                           
                                                                     </td>
                                                                     
                                                                 </tr>
                                                                  
                                                                 
                                                                 <?php 
                                                                  endwhile;
                                                                 ?>
                                                                
                                                             </tbody>
                                                         </table>
                                                     </div>
                                                     </div>


                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div>
<script>
    window.onload = function(){
setTimeout( function(){
  document.getElementById("test").style.display = 'none';
  //document.getElementById("monid0").style.display = 'none';
}, 3000);
};

function confirmerSuppression(id_user) {
    var confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet enregistrement ?");

    if (confirmation) {
        // L'utilisateur a cliqué sur "Yes", rediriger vers la suppression logique
        window.location.href = "suppression_logique_utilisateur.php?id_user=" + id_user;
    } else {
        // L'utilisateur a cliqué sur "No", rien n'est fait
    }
}


</script>

<!-- Javascript -->
<script src="assets/bundles/libscripts.bundle.js"></script>    
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="assets/bundles/c3.bundle.js"></script>


<!-- page js file -->
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="../js/index8.js"></script>
</body>
</html>
