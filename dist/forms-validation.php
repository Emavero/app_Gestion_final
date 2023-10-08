<?php
session_start();
require("auth.php");

if (Auth::isLogged()) {
    // Votre code ici s'il y a des actions à effectuer quand l'utilisateur est connecté.
} else {
    header('Location: page-login.php');
}

$host = "localhost";
$user = "root";
$password = "";
$db_name = "gestion_de_caisse";
$conn = mysqli_connect($host, $user, $password, $db_name);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}
include 'isAdmin.php'; 
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
        .annual_report .c3-axis.c3-axis-y {
            display: none;
        }

        .annual_report .c3-axis.c3-axis-x {
            display: none;
        }
        /* Permet le redimensionnement vertical et horizontal */


    </style>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body data-theme="light" class="font-nunito">
<div id="wrapper" class="theme-cyan">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="assets/images/LOGO_TEXTE.png" width="48" height="48" alt="Iconic"></div>
            <p>veuillez patienter s'il vous plaît</p>
        </div>
    </div>
    <!-- Top navbar div start -->
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-brand">
                <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-bars"></i></button>
                <button type="button" class="btn-toggle-fullwidth"><i class="fa fa-bars"></i></button>
                <a href="index.php">Ekinoxx</a>
            </div>
            <!--<div class="navbar-right">
                <form id="navbar-search" class="navbar-form search-form" action="recherche.php" method="GET">
                    <input value="" class="form-control" placeholder="Rechercher une opération" type="text"
                           name="s">
                    <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                </form>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li>
                        <a href="index.php" class="icon-menu"><i class="fa fa-power-off"></i></a>
                        </li>
                    </ul>
                </div>
            </div>-->
        </div>
    </nav>
    <?php
    $iduser = $_SESSION['Auth']['id_user'];
    $sql = "SELECT * FROM user WHERE id_user='$iduser'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $login = $row["login"];
    }
    ?>
    <!-- main left menu -->
    <div id="left-sidebar" class="sidebar">
        <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="assets/images/user.png" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span>Bienvenue</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo $login ?></strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
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
                                <a href="Bilan.php" class="has-arrow"><i class="fa fa-file"></i><span>Bilan</span></a>
                            </li>
                            <li>
                                <a href="source.php" class="has-arrow"><i class="fa fa-file"></i><span>Source des revenues</span></a>
                            </li>
                            <li>
                                <a href="#forms" class="has-arrow"><i class="fa fa-pencil"></i><span>Gestion des flux</span></a>
                                <ul>
                                    <li><a href="forms-validation.php">Ajouter une opération</a></li>
                                    <?php
                                                

                                                if ($isAdmin) {
                                                ?>
                                    <li><a href="type_encaissement.php">Ajouter un type encaissement</a></li>
                                    <li><a href="provenance.php">Ajouter une provenance</a></li>
                                    <?php
                                                }
                                    ?>
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
                                    <li><a href="utilisateur.php">Ajouter un utilisateur</a></li>
                                     <?php
                                       }

                                     ?>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- rightbar icon div -->
    <div class="right_icon_bar">
        <ul>
            <li><a href="#"><i class="fa fa-id-card"></i></a></li>
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
    <!-- main page content body part -->
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
                                            <h2>Ajouter une opération</h2>
                                        </div>
                                        <form id="monFormulaire" method="POST" action="ajout.php" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nature de l'operation</label>
                                                        <select class="custom-select" name="typeencaisse"
                                                                id="typeencaisse" required>
                                                            <?php
                                                            $rq1 = mysqli_query($conn, "select id_type_encaissement,nom_type from type_encaissement where actif=1");
                                                            while ($typeencaiss = mysqli_fetch_assoc($rq1)) {
                                                                print "<option value='" . $typeencaiss['id_type_encaissement'] . "'>" . $typeencaiss['nom_type'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Libellé</label>
                                                        <input type="text" name="libelle" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Encaissement de ou A</label>
                                                        <select class="custom-select" name="typemontant"
                                                                id="typemontant" required>
                                                            <?php
                                                            $rq1 = mysqli_query($conn, "select id_type_montant,nom_type_montant from type_montant");
                                                            while ($typeencaiss = mysqli_fetch_assoc($rq1)) {
                                                                print "<option value='" . $typeencaiss['id_type_montant'] . "'>" . $typeencaiss['nom_type_montant'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Montant</label>
                                                        <input type="number" name="montant" class="form-control"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Encaissements de fonds de</label>
                                                        <select class="custom-select" name="provemontant"
                                                                id="provemontant" required>
                                                            <?php
                                                            $rq1 = mysqli_query($conn, "select id_provenance_montant,nom_provenance_montant from provenance_montant where actif=1");
                                                            while ($typeencaiss = mysqli_fetch_assoc($rq1)) {
                                                                print "<option value='" . $typeencaiss['id_provenance_montant'] . "'>" . $typeencaiss['nom_provenance_montant'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group mt-5">
                                                        <label for="fileUpload">Télécharger un fichier :</label>
                                                        <input type="file" name="fileUpload" id="fileUpload">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="valider" class="btn btn-primary">Valider
                                                </button>
                                            </div>
                                        </form>
                                        
                                        
                                        <!--<div id="messageSucces" style="display: none;" class="alert alert-success">
                                          Enregistrement effectué avec succès !
                                        </div>-->
                                        <?php
                                         if (isset($_GET['success']) && $_GET['success'] == 1) {
                                         echo '<div id="test" class="alert alert-success">Enregistrement effectué avec succès !</div>';
                                         //echo '<script>alert("Enregistrement effectué avec succès !");</script>';
                                        }
                                            ?>


                                        


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
    window.onload = function () {
        setTimeout(function () {
            document.getElementById("test").style.display = 'none';
        }, 3000);
    };
    /*$(document).ready(function () {
        $("#monFormulaire").submit(function (e) {
            e.preventDefault(); // Empêche la soumission normale du formulaire

            // Récupérez les données du formulaire
            var formData = new FormData(this);

            // Effectuez la soumission du formulaire via AJAX
            $.ajax({
                type: "POST",
                url: "ajout.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response === "success") {
                        // Affichez le message de succès
                        $("#messageSucces").show();

                        // Vous pouvez également réinitialiser le formulaire ici si nécessaire
                        $("#monFormulaire")[0].reset();
                    } else {
                        // Affichez un message d'erreur en cas d'échec
                        alert("Une erreur s'est produite lors de l'enregistrement.");
                    }
                },
                error: function (xhr, status, error) {
                    // Gérez les erreurs d'AJAX ici si nécessaire
                    alert("Une erreur s'est produite lors de la soumission du formulaire.");
                }
            });
        });
    });*/

    
</script>
<!-- Javascript -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/bundles/jvectormap.bundle.js"></script>
<!-- JVectorMap Plugin Js -->
<script src="assets/bundles/c3.bundle.js"></script>
<!-- page js file -->
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="../js/index8.js"></script>
</body>
</html>



