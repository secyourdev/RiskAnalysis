<?php
session_start();

//Connexion à la base de donnee
try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v6;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
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
<?php 
    include("content/php/accueil/selection_grp_user.php");
    include("content/php/accueil/selection_user.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="RiskManager">
    <meta name="author" content="SecYourDev">

    <title>RiskManager | Tableau de bord</title>

    <!-- Fonts-->
    <link href="content/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- CSS -->
    <link href="content/css/bootstrap.css" rel="stylesheet">
    <link href="content/css/main.css" rel="stylesheet">

    <!-- JS -->
    <script src="content/vendor/jquery/jquery.js"></script>
    <script src="content/vendor/jquery-tabledit/jquery.tabledit.js"></script>

</head>

<?php 
if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur'])
{
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
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
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
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
                <div class="container-fluid">
                    <!-- Content Row -->
                    <h5>TABLEAU DE BORD</h5></br>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">
                            <div class="card shadow mb-4">
                                <div id="tableau_de_bord_projet"
                                    class="card-header d-flex flex-row align-items-center justify-content-between tableau_de_bord_card"
                                    onclick="location.href='#'">
                                    <table class="tableau_de_bord_table">
                                        <tbody>
                                            <tr>
                                                <th>Projets</th>
                                            </tr>
                                            <tr>
                                                <td class="compteur" id="prj"><b nbobs="7">0</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3">
                            <div class="card shadow mb-4">
                                <div id="tableau_de_bord_grp_user"
                                    class="card-header d-flex flex-row align-items-center justify-content-between tableau_de_bord_card">
                                    <table class="tableau_de_bord_table">
                                        <tbody>
                                            <tr>
                                                <th>Groupe d'utilisateurs</th>
                                            </tr>
                                            <tr>
                                                <td class="compteur" id="grp_user"><b nbobs="7">0</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3">
                            <div class="card shadow mb-4">
                                <div id="tableau_de_bord_app"
                                    class="card-header d-flex flex-row align-items-center justify-content-between tableau_de_bord_card">
                                    <table class="tableau_de_bord_table">
                                        <tbody>
                                            <tr>
                                                <th>Utilisateurs</th>
                                            </tr>
                                            <tr>
                                                <td class="compteur" id="app"><b nbobs="7">0</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3">
                            <div class="card shadow mb-4">
                                <div id="tableau_de_bord_bdd"
                                    class="card-header d-flex flex-row align-items-center justify-content-between tableau_de_bord_card">
                                    <table class="tableau_de_bord_table">
                                        <tbody>
                                            <tr>
                                                <th>Base de données</th>
                                            </tr>
                                            <tr>
                                                <td class="compteur" id="bdd"><b nbobs="7">0</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br></br>

                    <div id="project_card" class="fondu">
                        <div class="row" id="projets"> </div>

                        <div class="text-center">
                            <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none"
                                data-toggle="modal" data-target="#ajout_projet">Créer un nouveau projet</button>
                        </div>
                    </div>


                    <div id="grp_user_card" class="col-xl-12 col-lg-12 fondu">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0">Groupes d'utilisateur</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <!--tableau-->
                                <div class="table-responsive">
                                    <input type="text" class="rechercher_input" id="rechercher_grp_user"
                                        placeholder="Rechercher">
                                    <table id="editable_table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Groupe d'utilisateur</th>
                                                <th>Nom du groupe d'utilisateur</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                echo '
                                                <tr>
                                                <td>'.$row["id_grp_utilisateur"].'</td>
                                                <td>'.$row["nom_grp_utilisateur"].'</td>
                                                </tr>
                                                ';
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- bouton Ajouter une nouvelle ligne -->
                                <div class="text-center">
                                    <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none"
                                        data-toggle="modal" data-target="#ajout_grp_user">Ajouter un nouveau groupe
                                        d'utilisateur</button>
                                </div>
                            </div>
                        </div>
                        <!-- Area Card -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0">Utilisateurs</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="SelectGrpUserPop">Groupe d'utilisateur</label>
                                    <select class="form-control" name="nomgrpuser" id="nomgrpuser">
                                        <option value="" selected>...</option>
                                        <?php
                                    while($row = mysqli_fetch_array($result_grp_user))
                                    {
                                        echo '
                                        <option value="'.$row["nom_grp_utilisateur"].'">'.$row["nom_grp_utilisateur"].'</option>
                                        ';
                                    }
                                ?>
                                    </select>
                                </div>
                                <!--tableau-->
                                <script src="content/js/accueil/recherche_utilisateur.js"></script>
                                <div class="table-responsive">
                                    <input type="text" class="rechercher_input" id="rechercher_user"
                                        placeholder="Rechercher">
                                    <table id="tableau_user" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Poste</th>
                                            </tr>
                                        </thead>

                                        <tbody id="ecrire_user">
                                        </tbody>
                                    </table>
                                </div>
                                <!-- bouton Ajouter une nouvelle ligne -->
                                <div class="text-center">
                                    <button id='button_add_user_in_grp' type="button"
                                        class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal"
                                        data-target="#ajout_user">Ajouter un utilisateur dans un groupe</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="apps_card" class="col-xl-12 col-lg-12 fondu">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0">Compte Utilisateur</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <!--tableau-->
                                <div class="table-responsive">
                                    <input type="text" class="rechercher_input" id="rechercher_app_utilisateur"
                                        placeholder="Rechercher">
                                    <table id="table_app_user" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Poste</th>
                                                <th>E-mail</th>
                                                <th>Type de compte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while($row = mysqli_fetch_array($result_full_user))
                                            {
                                                echo '
                                                <tr>
                                                    <td>'.$row["id_utilisateur"].'</td>
                                                    <td>'.$row["nom"].'</td>
                                                    <td>'.$row["prenom"].'</td>
                                                    <td>'.$row["poste"].'</td>
                                                    <td>'.$row["email"].'</td>
                                                    <td>'.$row["type_compte"].'</td>
                                                </tr>
                                                ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- bouton Ajouter une nouvelle ligne -->
                                <div class="text-center">
                                    <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none"
                                        data-toggle="modal" data-target="#ajout_compte">Ajouter un nouvel
                                        utilisateur</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="bdd_card"> TEST3</div>

                </div>
                <!-- End of Main Content -->
                </br>
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
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
        --------------------------------------- modal creation d'un projet ---------------------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="ajout_projet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Création d'un projet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                        <form method="post" action="content/php/accueil/ajout_projet.php">
                            <fieldset>
                                <!--NOM ETUDE-->
                                <div class="form-group">
                                    <label class="titre_input" for="nom_etude">Nom</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="nom_etude" id="nom_etude" placeholder="Nom" required></input>
                                </div>

                                <!--OBJECTIF ETUDE-->
                                <div class="form-group">
                                    <label class="titre_textarea" for="objectif_atteindre">Objectif à atteindre</label>
                                    <textarea class="form-control perso_text_area" name="objectif_atteindre"
                                        id="objectif_atteindre" rows="3"></textarea>
                                </div>

                                <!--CADRE TEMPOREL ETUDE-->
                                <div class="form-group">
                                    <label class="titre_input" for="cadre_temporel">Cadre Temporel</label>
                                    <input type="date" class="perso_form shadow-none form-control form-control-user"
                                        name="cadre_temporel" id="cadre_temporel" placeholder="Cadre temporel" required>
                                </div>

                                <!--RISQUE ETUDE-->
                                <div class="form-group">
                                    <label class="titre_input" for="respo_acceptation_risque">Personne responsable
                                        d'accepter les risques résiduels au terme de l'étude</label>
                                    <input type="text" class="perso_arrow perso_form shadow-none form-control"
                                        list="liste_respo_acceptation_risque" name="respo_acceptation_risque"
                                        placeholder="..." required>
                                    <datalist id="liste_respo_acceptation_risque">
                                        <option>Directeur</option>
                                        <option>RSSI</option>
                                        <option>Responsable Informatique</option>
                                    </datalist>
                                </div>

                                <!--GROUPE UTILISATEUR-->
                                <div class="form-group">
                                    <label for="SelectGrpUserPop">Groupe d'utilisateur</label>
                                    <select class="form-control" name="nom_grp_utilisateur" id="SelectGrpUser">
                                        <option value="" selected>...</option>
                                        <?php
                                        while($row = mysqli_fetch_array($result_grp_user_creation))
                                            {
                                                echo '
                                                <option value="'.$row["nom_grp_utilisateur"].'">'.$row["nom_grp_utilisateur"].'</option>
                                                ';
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="modal-footer perso_middle_modal_footer">
                                    <input type="submit" name="ajouter_projet" value="Ajouter"
                                        class="btn perso_btn shadow-none"></input>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-------------------------------------------------------------------------------------------------------------- 
        --------------------------------------- modal creation d'un groupe utilisateur ---------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="ajout_grp_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Création d'un groupe d'utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                        <form method="post" action="content/php/accueil/ajout_grp_user.php">
                            <fieldset>
                                <!--NOM ETUDE-->
                                <div class="form-group">
                                    <label class="titre_input" for="nom_grp_user">Nom</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="nom_grp_user" id="nom_grp_user" placeholder="Nom" required></input>
                                </div>

                                <div class="modal-footer perso_middle_modal_footer">
                                    <input type="submit" name="ajouter_grp_user" value="Ajouter"
                                        class="btn perso_btn shadow-none"></input>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------------------------------------------------------- 
        --------------------------------------------- modal ajout d'un utilisateur -------------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="ajout_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajout d'un utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                        <form>
                            <fieldset>
                                <!--UTILISATEUR-->
                                <div class="form-group">
                                    <label for="SelectUserPop">Utilisateur</label>
                                    <select class="form-control" name="nom_utilisateur" id="SelectUser">
                                        <option value="" selected>...</option>
                                        <?php
                                        while($row = mysqli_fetch_array($result_user))
                                            {
                                                echo '
                                                <option value="'.$row["id_utilisateur"].'- '.$row["nom"].' '.$row["prenom"].'">'.$row["id_utilisateur"].'- '.$row["nom"].' '.$row["prenom"].'</option>
                                                ';
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="modal-footer perso_middle_modal_footer">
                                    <button type="button" id='ajouter_user' name="ajouter_user"
                                        class="btn perso_btn shadow-none">Ajouter</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!----------------------------------------------------------------------------------------------------------------- 
        ----------------------------------------- modal ajout de compte ---------------------------------------------------
        ------------------------------------------------------------------------------------------------------------------>
        <div class="modal fade" id="ajout_compte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajout de compte utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                        <form method="post" action="content/php/accueil/ajout_app_utilisateur.php" class="user" id="formUtilisateur">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        id="nom_utilisateur" name="nom" placeholder="Nom" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        id="prenom_utilisateur" name="prenom" placeholder="Prénom" required>
                                </div>
                                <div class="form-group">
                                    <label class="titre_input" for="poste_acteur">Poste</label>
                                    <input type="text" class="perso_arrow perso_form shadow-none form-control"
                                        list="Postes" id="poste_utilisateur" name="poste" placeholder="Poste" required>
                                    <datalist id="Postes">
                                        <option value="Internet Explorer">
                                        <option value="Firefox">
                                        <option value="Chrome">
                                        <option value="Opera">
                                        <option value="Safari">
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="perso_form shadow-none form-control form-control-user"
                                        id="email_utilisateur" name="email" placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <label for="select_type_compte_pop">Type de compte</label>
                                    <input type="text" class="perso_arrow perso_form shadow-none form-control"
                                        list="Type_Compte" id="type_compte_utilisateur" name="type_compte"
                                        placeholder="Type de compte" required>
                                    <datalist id="Type_Compte">
                                        <option value="" selected>...</option>
                                        <option>Administrateur Logiciel</option>
                                        <option>Chef de Projet</option>
                                        <option>Utilisateur</option>
                                    </datalist>
                                </div>
                                <div>
                                    <input type="submit" name="valider" value="Ajouter"
                                        class="btn perso_btn_primary shadow-none"></input>
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
        <script src="content/js/modules/realtime.js"></script>
        <script src="content/js/modules/set_filter_sort_table.js"></script>
        <script src='content/js/accueil/index.js'> </script>
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