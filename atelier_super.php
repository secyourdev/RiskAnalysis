<?php
session_start();

include("content/php/bdd/connexion.php");

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur'] > 0){
    $getid = intval($_GET['id_utilisateur']);
    $requser = $bdd->prepare('SELECT * FROM A_utilisateur WHERE id_utilisateur = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();

    $getidproject = intval($_GET['id_projet']);
    $reqproject = $bdd->prepare('SELECT nom_projet FROM F_projet WHERE id_projet = ?');
    $reqproject->execute(array($getidproject));
    $projectinfo = $reqproject->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="RiskManager">
    <meta name="author" content="SecYourDev">

    <title>Accueil : <?php echo $projectinfo['nom_projet']?></title>

    <!-- Fonts-->
    <link href="content/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="content/fonts/nunito.css" rel="stylesheet">

    <!-- CSS -->
    <link href="content/css/bootstrap.css" rel="stylesheet">
    <link href="content/css/main.css" rel="stylesheet">
    <link href="style_atelier_super.css" rel="stylesheet">

    <!-- JS -->
    <script src="content/vendor/jquery/jquery.js"></script>
    <script src="content/vendor/jquery-tabledit/jquery.tabledit.js"></script>
    <script src="content/js/rapport/ajax_tables.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="content/img/logo_cyber_risk_manager.ico" type="image/x-icon">
	<link rel="icon" href="content/img/logo_cyber_risk_manager.png" type="image/png">
</head>

<?php 
if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur'])
{
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include("content\php\commun\menu_gauche.php");?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top fixed-top shadow" id="barre_info">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Dark Mode toggle switch -->

                        <label class="theme-switch" for="checkbox_dark_theme">
                            <input class="perso_switch" type="checkbox" id="checkbox_dark_theme" />
                            <div class="slider round"></div>
                        </label>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $userinfo['prenom'];?></span>
                                <img class="img-profile rounded-circle" src="content/img/undraw_profile_pic.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="parametres&<?php echo $_SESSION['id_utilisateur'];?>">
                                    <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Paramètres
                                </a>
                                <a class="dropdown-item" href="aide&<?php echo $_SESSION['id_utilisateur'];?>">
                                    <i class="fas fa-question-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Aide
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div id="fixed_page" class="container-fluid bg-white">
                        <div class="row">
                            <div class="col-xs-8 offset-1">
                            <!-- Formulaire -->
                            <div class="tritre_col">
                                <header class="titre_col1">
                                    <h2 class="titre_col1">Formulaire Rapport</h2>
                                </header>
                            </div>
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titre rapport</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez le titre du rapport">
                                    <br>

                                    <label for="exampleInputPassword1">Nom de la société</label>                        
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Entrez le nom de votre société">
                                    <br>
                                    
                                    <label for="exampleInputPassword1">Adresse société</label>                        
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Entrez l'adresse de votre société (n°, rue, ville, cp)">
                                    <br>

                                    <label for="exampleInputPassword1">Téléphone société</label>                        
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder=" Entrez n° téléphone société">
                                    <br>

                                    <label for="exampleInputPassword1">Télécopie société</label>                        
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Entrez télécopie société">
                                    <br>

                                    <label for="exampleInputPassword1">Réphérences document</label>                        
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Entrez les référances du document">
                                    <br>
                                </div>
                                
                                <form>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Logo Société</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                </div>
                                </form>
                                <br>
                            </form>
                                <!-- Fin formulaire -->
                        
                    </div>
                    <div class ="col-xs-10 dif_col">
                        <div class="tritre_col">
                            <header class="titre_col2">
                                <h2 class="titre1_col2">Bonton génération rapport</h2>
                                <h4 class="sous_titre_col2"> Rapport Word  /  Rapport Excel</h4>
                            </header>
                        </div>
                        <div class="form-group">
                            <label for="text_bouton" class= "text_bouton">Bouton rapport complet :</label>  
                            <button type="button" class="button_rapport complet w" id="bouton_rap_comp_w" onclick="rapport_full()">Générer Rapport Complet</button>
                            /
                            <button type="button" class="button_rapport complet e" id="bouton_rap_comp_e"onclick="myAjax()">Générer tous les tableaux</button>
                            <br>
                            <br></br>
                            <label for="text_bouton" class= "text_bouton">Bouton rapport Atelier 1 :</label>
                            <button type="button" class="button_rapport at1 w" id="bouton_rap_at1_w" onclick="myAjax()">Générer Rapport Atelier 1</button>
                            /
                            <button type="button" class="button_rapport at1 e" id="bouton_rap_at1_e"onclick="myAjax()">Générer tableaux At1</button>
                            <br>
                            <br></br>
                            <label for="text_bouton" class= "text_bouton">Bouton rapport Atelier 2 :</label>    
                            <button type="button" class="button_rapport at2 w" id="bouton_rap_at2_w" onclick="myAjax()">Générer Rapport Atelier 2</button>
                            /
                            <button type="button" class="button_rapport at2 e" id="bouton_rap_at2_e" onclick="myAjax()">Générer tableaux At2</button>
                            <br>
                            <br></br>
                            <label for="text_bouton" class= "text_bouton">Bouton rapport Atelier 3 :</label>                                                        
                            <button type="button" class="button_rapport at3 w" id="bouton_rap_at3_w" onclick="myAjax()">Générer Rapport Atelier 3</button>
                            /
                            <button type="button" class="button_rapport at3 e" id="bouton_rap_at3_e" onclick="myAjax()">Générer tableaux At3</button>
                            <br>
                            <br></br>
                            <label for="text_bouton" class= "text_bouton">Bouton rapport Atelier 4 :</label>
                            <button type="button" class="button_rapport at4 w" id="bouton_rap_at4_w" onclick="myAjax()">Générer Rapport Atelier 4</button>
                            /
                            <button type="button" class="button_rapport at4 e" id="bouton_rap_at4_e" onclick="myAjax()">Générer tableaux At4</button>
                            <br>
                            <br></br>
                            <label for="text_bouton" class= "text_bouton">Bouton rapport Atelier 5 :</label>
                            <button type="button" class="button_rapport at5 w" id="bouton_rap_at5_w" onclick="myAjax()">Générer Rapport Atelier 5</button>
                            /
                            <button type="button" class="button_rapport at5 e" id="bouton_rap_at5_e" onclick="myAjax()">Générer tableaux At5</button>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
                </br><br></br>
                <!-- Footer -->
                <footer id="footer" class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; CYBER RISK MANAGER 2021 by SecYourDev</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>      

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Êtes-vous prêt à quitter l'application ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à terminer votre
                        session en cours.</div>
                    <div class="modal-footer">
                        <form method="post" action="content/php/deconnexion/logs.php">
                            <fieldset>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                <input type="submit" name="deconnexion" value="Déconnexion"
                                    class="btn btn-primary"></input>
                                <fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="content/vendor/bootstrap/js/bootstrap.bundle.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="content/vendor/jquery-easing/jquery.easing.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="content/js/bootstrap.js"></script>

        <!-- Our JS -->
        <script src="content/js/modules/dark_mode.js"></script>
        <script src="content/js/modules/fixed_page.js"></script>
        <script src="content/js/modules/realtime.js"></script>
        <script src="content/js/modules/set_filter_sort_table.js"></script>
        <script src="content/js/modules/sort_table.js"></script>
</body>
<?php
}
else{
  header('Location: connexion');
}
?>

</html>
<?php
}
else{
  header('Location: connexion');
}
?>