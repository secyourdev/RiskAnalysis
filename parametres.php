<?php
session_start();

//Connexion à la base de donnee
try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v18;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
}

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur'] > 0){
    $getid = intval($_GET['id_utilisateur']);
    $requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id_utilisateur = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="RiskManager">
    <meta name="author" content="SecYourDev">

    <title>RiskManager | Paramètres</title>

    <!-- Fonts-->
    <link href="content/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="content/fonts/nunito.css" rel="stylesheet">

    <!-- CSS -->
    <link href="content/css/bootstrap.css" rel="stylesheet">
    <link href="content/css/main.css" rel="stylesheet">

    <!-- JS -->
    <script src="content/vendor/jquery/jquery.js"></script>
    <script src="content/vendor/jquery-tabledit/jquery.tabledit.js"></script>

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
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark fixed-top accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <!-- Logo -->
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-2"> CYBER RISK MANAGER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de Bord</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

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
                <div id="fixed_page" class="container-fluid">
                    <!-- Content Row -->
                    <div class="row fondu">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="row perso_no_margin">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <h6 class="m-0">Paramètres</h6>
                                    </div>
                                    <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <button type="button" data-toggle="modal" data-target="#modifier_mdp_user" class="btn perso_btn perso_btn_parametre_mdp shadow-none">Modifier le mot de passe</button>
                                        <button type="button" data-toggle="modal" data-target="#modifier_user" class="btn perso_btn perso_btn_parametre shadow-none">Modifier le profil</button>
                                    </div>
                                    <div class="card-header div_photo_user col-12 col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <img class="img-profile rounded-circle user_photo" src="content/img/undraw_profile_pic.svg">
                                    </div>
                                    <div class="card-header div_info_user col-12 col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label id="nom_user_parametre"></label>
                                        <label id="poste_user_parametre"></label>
                                        <label id="type_compte_user_parametre"></label>
                                        <label id="email_user_parametre"></label>  
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End of Main Content -->
                </br>
                <!-- Footer -->
                <footer id="footer" class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; CYBER RISK MANAGER 2020</span>
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
        
        <!-------------------------------------------------------------------------------------------------------------- 
        ------------------------------------------- modal modification du profil ---------------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="modifier_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modification du profil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                        <form method="post" action="content/php/parametres/modification_user.php">
                            <fieldset>
                                <!--NOM-->
                                <div class="form-group">
                                    <label class="titre_input" for="nom">Nom</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="nom" id="nom" placeholder="Nom" readonly></input>
                                </div>
                                <!--PRENOM-->
                                <div class="form-group">
                                    <label class="titre_input" for="prenom">Prénom</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="prenom" id="prenom" placeholder="Prénom" readonly></input>
                                </div>
                                <!--POSTE-->
                                <div class="form-group">
                                    <label class="titre_input" for="poste">Poste</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="poste" list="Postes" id="poste" placeholder="Poste" required></input>
                                    <datalist id="Postes">
                                        <option value="Internet Explorer">
                                        <option value="Firefox">
                                        <option value="Chrome">
                                        <option value="Opera">
                                        <option value="Safari">
                                    </datalist>
                                </div>
                                <!--EMAIL-->
                                <div class="form-group">
                                    <label class="titre_input" for="email">E-mail</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="email" id="email" placeholder="E-mail" required></input>
                                </div>

                                <div class="modal-footer perso_middle_modal_footer">
                                    <input type="submit" name="modifier_user" value="Modifier"
                                        class="btn perso_btn shadow-none"></input>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-------------------------------------------------------------------------------------------------------------- 
        ------------------------------------- modal modification du mot de passe ---------------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="modifier_mdp_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modification du mot de passe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                        <form method="post" action="content/php/parametres/modification_mdp_user.php">
                            <fieldset>
                                <!--EMAIL-->
                                <div class="form-group">
                                    <label class="titre_input" for="email_modif_mdp">E-mail</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="email_modif_mdp" id="email_modif_mdp" placeholder="E-mail" readonly></input>
                                </div>

                                <!--Ancien Mot de passe-->
                                <div class="form-group">
                                    <label class="titre_input" for="ancien_mdp">Ancien mot de passe</label>
                                    <input type="password" class="perso_form shadow-none form-control form-control-user"
                                        name="ancien_mdp" id="ancien_mdp" placeholder="Ancien mot de passe" required></input>
                                </div>

                                <!--Nouveau mot de passe-->
                                <div class="form-group">
                                    <label class="titre_input" for="nouveau_mdp">Nouveau mot de passe</label>
                                    <input type="password" class="perso_form shadow-none form-control form-control-user"
                                        name="nouveau_mdp" id="nouveau_mdp" placeholder="Nouveau mot de passe" required></input>
                                </div>
                                
                                <!--Confirmation nouveau Mot de passe-->
                                <div class="form-group">
                                    <label class="titre_input" for="confirmation_nouveau_mdp">Confirmez votre nouveau mot de passe</label>
                                    <input type="password" class="perso_form shadow-none form-control form-control-user"
                                        name="confirmation_nouveau_mdp" id="confirmation_nouveau_mdp" placeholder="Confirmez votre nouveau mot de passe" required></input>
                                </div>

                                <div class="modal-footer perso_middle_modal_footer">
                                    <input type="submit" name="modifier_mdp_user" value="Modifier"
                                        class="btn perso_btn shadow-none"></input>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
        <script src='content/js/parametres/parametres.js'> </script>
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