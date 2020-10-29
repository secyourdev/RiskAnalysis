<?php
session_start();

include("content/php/bdd/connexion.php");

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur'] > 0){
    $getid = intval($_GET['id_utilisateur']);
    $requser = $bdd->prepare('SELECT * FROM A_utilisateur WHERE id_utilisateur = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
?>
<?php 
    include("content/php/accueil/selection_grp_user.php");
    include("content/php/accueil/selection_user.php");
    include("content/php/accueil/selection_projet2.php");
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
    <link href="content/fonts/nunito.css" rel="stylesheet">

    <!-- CSS -->
    <link href="content/css/bootstrap.css" rel="stylesheet">
    <link href="content/css/main.css" rel="stylesheet">

    <!-- JS -->
    <script src="content/vendor/jquery/jquery.js"></script>
    <script src="content/vendor/jquery-tabledit/jquery.tabledit.js"></script>
    <script src="content/vendor/sheet-js/xlsx.full.min.js"></script>
    <script src="content/vendor/sheet-js/FileSaver.js"></script>
    
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
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark fixed-top accordion side_bar_scroll" id="accordionSidebar">
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

        <?php if($userinfo['type_compte']=='Administrateur Logiciel'){ 
        ?>  

         <!-- Right Sidebar -->
            <ul id=menu>
                <div id=menu_grp_user>
                <li>
                    <a class="nav-link collapse-right-item menu_float" href="#groupes_utilisateur">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                                <g transform="translate(-1230 -689)">
                                    <path class="number_activity active"
                                        d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                        transform="translate(1230 689)" fill="#ffffffcc" />
                                    <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)"
                                        fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                        font-weight="700">
                                        <tspan x="-3.432" y="0">1</tspan>
                                    </text>
                                </g>
                            </svg>
                        </i>
                        <span class="nom_sous_menu">Groupes d'utilisateur</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link collapse-right-item menu_float" href="#utilisateurs">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                                <g transform="translate(-1230 -689)">
                                    <path class="number_activity active"
                                        d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                        transform="translate(1230 689)" fill="#ffffffcc" />
                                    <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)"
                                        fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                        font-weight="700">
                                        <tspan x="-3.432" y="0">2</tspan>
                                    </text>
                                </g>
                            </svg>
                        </i>
                        <span class="nom_sous_menu">Utilisateurs</span>
                    </a>
                </li>
                </div>
                <div id=menu_projet>
                <li>
                    <a class="nav-link collapse-right-item menu_float" href="#projets">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                                <g transform="translate(-1230 -689)">
                                    <path class="number_activity active"
                                        d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                        transform="translate(1230 689)" fill="#ffffffcc" />
                                    <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)"
                                        fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                        font-weight="700">
                                        <tspan x="-3.432" y="0">1</tspan>
                                    </text>
                                </g>
                            </svg>
                        </i>
                        <span class="nom_sous_menu">Projets</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link collapse-right-item menu_float" href="#versions">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                                <g transform="translate(-1230 -689)">
                                    <path class="number_activity active"
                                        d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                        transform="translate(1230 689)" fill="#ffffffcc" />
                                    <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)"
                                        fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                        font-weight="700">
                                        <tspan x="-3.432" y="0">2</tspan>
                                    </text>
                                </g>
                            </svg>
                        </i>
                        <span class="nom_sous_menu">Versions des projets</span>
                    </a>
                </li>
                </div>
            </ul>
            
            <!-- End of Right Sidebar -->
        <?php
            }
        ?>

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
                <div id="fixed_page" class="container-fluid">
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
                        <?php if($userinfo['type_compte']=='Administrateur Logiciel'){ 
                        ?>        
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
                                                <td class="compteur" id="bdd"><b>-</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    
                    <div id="project_card" class="fondu">                       
                        <?php if($userinfo['type_compte']=='Chef de Projet'||$userinfo['type_compte']=='Administrateur Logiciel'){
                        ?>
                            <div class='message_success'>
                            <?php 
                                if(isset($_SESSION['message_success'])){
                                echo $_SESSION['message_success'];
                                unset($_SESSION['message_success']);
                                }
                            ?>
                            </div> 
                            <div class='message_error'>
                            <?php                
                                if(isset($_SESSION['message_error'])){
                                    echo $_SESSION['message_error'];
                                    unset($_SESSION['message_error']);
                                }
                            ?>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none"
                                    data-toggle="modal" data-target="#ajout_projet">Créer un nouveau projet</button>
                            </div>
                        <?php
                            }
                        ?>
                    </br>
                        <div class="row" id="projets"> </div>

                        <!-- Area Card -->
                        <div id="versions"> </div>
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0">Versions</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="SelectProjetPop">Projets</label>
                                    <select class="form-control" name="nomprojet" id="nomprojet">
                                        <option value="" selected>...</option>
                                        <?php
                                            while($var_projet = $search_projet->fetch()){
                                                echo '<option value="'.$var_projet['id_projet'].'">'.$var_projet['id_projet']."-".$var_projet['nom_projet'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <!--tableau-->
                                <div class="table-responsive">
                                    <input type="text" class="rechercher_input" id="rechercher_version"
                                        placeholder="Rechercher">
                                    <table id="tableau_version" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Numéro de version</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ecrire_version">
                                        </tbody>
                                    </table>
                                    <div class='message_success'>
                                    <?php 
                                        if(isset($_SESSION['message_success_5'])){
                                        echo $_SESSION['message_success_5'];
                                        unset($_SESSION['message_success_5']);
                                        }
                                    ?>
                                    </div> 
                                    <div class='message_error'>
                                    <?php                
                                        if(isset($_SESSION['message_error_5'])){
                                            echo $_SESSION['message_error_5'];
                                            unset($_SESSION['message_error_5']);
                                        }
                                    ?>
                                    </div>
                                </div>
                        
                                <!-- bouton Ajouter une nouvelle ligne -->
                                <div class="text-center">
                                    <button id='button_add_version' type="button"
                                        class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal"
                                        data-target="#ajout_version">Ajouter une version</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if($userinfo['type_compte']=='Administrateur Logiciel'){ 
                    ?>                  
                    <div id="grp_user_card" class="col-xl-12 col-lg-12 fondu">
                        <div id="groupes_utilisateur"></div>
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="row perso_no_margin">
                                <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <h6 class="m-0">Groupes d'utilisateur</h6>
                                </div>
                                <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                  <a class="download_table_button" id="button_download_groupes_utilisateur">
                                    <i class="fas fa-download fa-lg text-gray-400"></i>
                                  </a>
                                </div>    
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
                                <div class='message_success'>
                                <?php 
                                    if(isset($_SESSION['message_success_2'])){
                                    echo $_SESSION['message_success_2'];
                                    unset($_SESSION['message_success_2']);
                                    }
                                ?>
                                </div> 
                                <div class='message_error'>
                                <?php                
                                    if(isset($_SESSION['message_error_2'])){
                                        echo $_SESSION['message_error_2'];
                                        unset($_SESSION['message_error_2']);
                                    }
                                ?>
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
                        <div id="utilisateurs"></div>
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
                                    <div class='message_success'>
                                    <?php 
                                        if(isset($_SESSION['message_success_2b'])){
                                        echo $_SESSION['message_success_2b'];
                                        unset($_SESSION['message_success_2b']);
                                        }
                                    ?>
                                    </div> 
                                    <div class='message_error'>
                                    <?php                
                                        if(isset($_SESSION['message_error_2b'])){
                                            echo $_SESSION['message_error_2b'];
                                            unset($_SESSION['message_error_2b']);
                                        }
                                    ?>
                                    </div>
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
                            <div class="row perso_no_margin">
                                <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <h6 class="m-0">Comptes Utilisateurs</h6>
                                </div>
                                <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                  <a class="download_table_button" id="button_download_comptes_utilisateurs">
                                    <i class="fas fa-download fa-lg text-gray-400"></i>
                                  </a>
                                </div>    
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
                                                <th>Mot de passe</th>
                                                <th>Mot de passe</th>
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
                                                    <td> <button type="button" data-toggle="modal" data-target="#modifier_mdp_user" class="reinitialiser_mdp btn perso_btn_primary width_select shadow-none">Réinitialiser</button> </td>
                                                    <td> <button type="button" class="generer_mdp btn perso_btn_primary width_select shadow-none">Générer</button> </td>
                                                </tr>
                                                ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class='message_success'>
                                <?php 
                                    if(isset($_SESSION['message_success_4'])){
                                    echo $_SESSION['message_success_4'];
                                    unset($_SESSION['message_success_4']);
                                    }
                                ?>
                                </div> 
                                <div class='message_error'>
                                <?php                
                                    if(isset($_SESSION['message_error_4'])){
                                        echo $_SESSION['message_error_4'];
                                        unset($_SESSION['message_error_4']);
                                    }
                                ?>
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


                    <div id="bdd_card" class="text-center"> 
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0">Base de données</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#config_bdd" >Configurer la base de données</button></br>
                                <a href="content/php/sauvegarde_bdd/sauvegarde.php" class="btn perso_btn_primary perso_btn_spacing shadow-none">Sauvegarder la base de données</a></br>
                                <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#import_bdd">Importer la base de données</button></br>  
                                <a href="content/php/sauvegarde_image/sauvegarde.php" class="btn perso_btn_primary perso_btn_spacing shadow-none">Sauvegarder les schémas</a></br>
                                <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#import_image">Importer des schémas</button></br>  
                            </div>
                        </div>     
                    </div>

                    <?php
                        }
                    ?>

                </div>
                <!-- End of Main Content -->
                </br>
                <!-- Footer -->
                <footer id="footer" class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; CYBER RISK MANAGER 2020 by SecYourDev</span>
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

        <?php if($userinfo['type_compte']=='Administrateur Logiciel'){ 
        ?>
            <!-- Open the right menu-->
            <a id="float_menu" class="open_menu rounded">
                <i class="fas fa-bars"></i>
            </a>
        <?php
            }
        ?>
        
        <?php if($userinfo['type_compte']=='Administrateur Logiciel'){ 
        ?>   
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

                                <!--DESCRIPTION ETUDE-->
                                <div class="form-group">
                                    <label class="titre_textarea" for="description_etude">Description</label>
                                    <textarea class="form-control perso_text_area" name="description_etude"
                                        id="description_etude" rows="3" required></textarea>
                                </div>

                                <!--CHEF DE PROJET-->
                                <div class="form-group">
                                    <label for="select_chef_projet">Chef de projet</label>
                                    <select class="form-control" name="id_utilisateur" id="select_chef_projet" required>
                                        <option value="" selected>...</option>
                                        <?php
                                        while($row = mysqli_fetch_array($result_chef_de_projet_creation))
                                            {
                                                echo '
                                                <option value="'.$row["id_utilisateur"].'">'.$row["nom"].' '.$row["prenom"].'</option>
                                                ';
                                            }
                                        ?>
                                    </select>
                                </div>                                
                                
                                <!--GROUPE UTILISATEUR-->
                                <div class="form-group">
                                    <label for="SelectGrpUser">Groupe d'utilisateur</label>
                                    <select class="form-control" name="id_grp_utilisateur" id="SelectGrpUser"> 
                                        <option value="" selected>...</option>
                                        <?php
                                        while($row = mysqli_fetch_array($result_grp_user_creation))
                                            {
                                                echo '
                                                <option value="'.$row["id_grp_utilisateur"].'">'.$row["nom_grp_utilisateur"].'</option>
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
        --------------------------------------------- modal ajout d'une version ----------------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="ajout_version" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajout d'une version</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                        <form>
                            <fieldset>
                                <!--Numéro de version-->
                                <div class="form-group">
                                    <label class="titre_input" for="version">Numéro de la version</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="num_version" id="num_version" placeholder="1" required></input>
                               
                                <!--Description de la version-->
                                
                                    <label class="titre_input" for="version">Description de la version</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="version_description" id="version_description" placeholder="Description de la version" required></input>
                                </div>

                                <div class="modal-footer perso_middle_modal_footer">
                                    <button type="button" id='ajouter_version' name="ajouter_version"
                                        class="btn perso_btn_primary perso_btn_spacing shadow-none">Ajouter Version</button>
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
                                                <option value="'.$row["id_utilisateur"].'">'.$row["nom"].' '.$row["prenom"].'</option>
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
                                    <label class="titre_input" for="nom_utilisateur">Nom</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        id="nom_utilisateur" name="nom" placeholder="Nom" required>
                                </div>
                                <div class="form-group">
                                    <label class="titre_input" for="prenom_utilisateur">Prénom</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        id="prenom_utilisateur" name="prenom" placeholder="Prénom" required>
                                </div>
                                <div class="form-group">
                                    <label class="titre_input" for="poste_utilisateur">Poste</label>
                                    <input type="text" class="perso_arrow perso_form shadow-none form-control"
                                        id="poste_utilisateur" name="poste" placeholder="Poste" required>
                                </div>
                                <div class="form-group">
                                    <label class="titre_input" for="email_utilisateur">E-mail</label>
                                    <input type="email" class="perso_form shadow-none form-control form-control-user"
                                        id="email_utilisateur" name="email" placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <label class="titre_input" for="type_compte_utilisateur">Type de compte</label>
                                    <select class="form-control" id="type_compte_utilisateur" name="type_compte" placeholder="Type de compte" required>
                                        <option value="" selected>...</option>
                                        <option>Administrateur Logiciel</option>
                                        <option>Utilisateur</option>
                                    </select>
                                </div>
                                <div class="modal-footer perso_middle_modal_footer">
                                    <input type="submit" name="valider" value="Ajouter"
                                        class="btn perso_btn_primary shadow-none"></input>
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
                        <form method="post" action="content/php/accueil/reinitialiser_mdp.php">
                            <fieldset>
                                <!--EMAIL-->
                                <div class="form-group">
                                    <label class="titre_input" for="email_modif_mdp">E-mail</label>
                                    <input type="email" class="perso_form shadow-none form-control form-control-user"
                                        name="email_modif_mdp" id="email_modif_mdp" placeholder="E-mail" readonly></input>
                                </div>

                                <!--Nouveau mot de passe-->
                                <div class="form-group">
                                    <label class="titre_input" for="nouveau_mdp">Nouveau mot de passe</label>
                                    <input type="password" class="perso_form shadow-none form-control form-control-user"
                                        name="nouveau_mdp" id="nouveau_mdp" placeholder="Nouveau mot de passe" autocomplete="off" required></input>
                                </div>
                                
                                <!--Confirmation nouveau Mot de passe-->
                                <div class="form-group">
                                    <label class="titre_input" for="confirmation_nouveau_mdp">Confirmez votre nouveau mot de passe</label>
                                    <input type="password" class="perso_form shadow-none form-control form-control-user"
                                        name="confirmation_nouveau_mdp" id="confirmation_nouveau_mdp" placeholder="Confirmez votre nouveau mot de passe" autocomplete="off" required></input>
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

        <!-------------------------------------------------------------------------------------------------------------- 
        ------------------------------------------- modal modification du projet ---------------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="modif_projet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modification du projet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                        <form method="post" action="content/php/accueil/modification_projet.php">
                            <fieldset>
                                <!-- ID PROJET -->
                                <div class="form-group">
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="id_etude_modif" id="id_etude_modif" placeholder="ID" hidden></input>
                                </div>

                                <!--NOM PROJET-->
                                <div class="form-group">
                                    <label class="titre_input" for="nom_etude_modif">Nom</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="nom_etude_modif" id="nom_etude_modif" placeholder="Nom" required></input>
                                </div>

                                <!--DESCRIPTION PROJET-->
                                <div class="form-group">
                                    <label class="titre_input" for="description_etude_modif">Description</label>
                                    <textarea class="form-control perso_text_area" name="description_etude_modif"
                                        id="description_etude_modif" rows="3" required></textarea>
                                </div>

                                <!--CHEF DE PROJET-->
                                <div class="form-group">
                                    <label for="chef_de_projet_modif">Chef de projet</label>
                                    <select class="form-control" name="id_utilisateur" id="chef_de_projet_modif">
                                        <option value="" selected>...</option>
                                        <?php
                                        while($row = mysqli_fetch_array($result_chef_de_projet_modification))
                                            {
                                                echo '
                                                <option value="'.$row["id_utilisateur"].'">'.$row["nom"].' '.$row["prenom"].'</option>
                                                ';
                                            }
                                        ?>
                                    </select>
                                </div>        

                                <!--GROUPE UTILISATEUR-->
                                <div class="form-group">
                                    <label for="id_grp_utilisateur_modif">Groupe d'utilisateur</label>
                                    <select class="form-control" name="id_grp_utilisateur_modif" id="id_grp_utilisateur_modif">
                                        <option value="" selected>...</option>
                                        <?php
                                        while($row = mysqli_fetch_array($result_grp_user_modification))
                                            {
                                                echo '
                                                <option value="'.$row["id_grp_utilisateur"].'">'.$row["nom_grp_utilisateur"].'</option>
                                                ';
                                            }
                                        ?>
                                    </select>
                                </div>

                                <!--NUMERO DE VERSION-->
                                <div class="form-group">
                                    <label for="num_version_modif">Numéro de version</label>
                                    <select class="form-control" name="id_num_version_modif" id="id_num_version_modif">
                                        <option value="" selected>...</option>
                                        <?php
                                        while($row = mysqli_fetch_array($result_chef_de_projet_modification))
                                            {
                                                echo '
                                                <option value="'.$row["id_utilisateur"].'">'.$row["nom"].' '.$row["prenom"].'</option>
                                                ';
                                            }
                                        ?>
                                    </select>
                                </div> 

                                <div class="modal-footer perso_middle_modal_footer">
                                    <input type="submit" name="modifier_projet" value="Modifier"
                                        class="btn perso_btn shadow-none"></input>
                                </div>  
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-------------------------------------------------------------------------------------------------------------- 
        -------------------------------------------- modal suppression du projet ---------------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="suppr_projet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Suppression du projet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                        <div class="modal-body" id="msg_suppression_projet">Sélectionnez "Supprimer" ci-dessous si vous êtes prêt à supprimer
                        le projet choisit.</div>
                        <form method="post" action="content/php/accueil/suppression_projet.php">
                            <fieldset>
                                <!-- ID PROJET -->
                                <div class="form-group">
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="id_etude_suppr" id="id_etude_suppr" placeholder="ID" hidden></input>
                                </div>

                                <!--NOM PROJET-->
                                <div class="form-group">
                                    <label class="titre_input" for="nom_etude_suppr">Nom</label>
                                    <input type="text" class="perso_form shadow-none form-control form-control-user"
                                        name="nom_etude_suppr" id="nom_etude_suppr" placeholder="Nom" readonly></input>
                                </div>

                                <div class="modal-footer perso_middle_modal_footer">
                                    <input type="submit" name="supprimer_projet" value="Supprimer"
                                        class="btn perso_btn shadow-none"></input>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-------------------------------------------------------------------------------------------------------------- 
        ---------------------------------------------- modal config bdd ------------------------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="config_bdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Configuration de la base de données</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                        <div class="modal-body" id="msg_config_bdd">
                            Veuillez modifier les fichiers <b>"content\php\bdd\connexion.php"</b> et <b>"content\php\bdd\connexion_sqli.php"</b> avec votre adresse hôte MySQL, l'identifiant utilisateur, le mot de passe et le nom de la table !
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-------------------------------------------------------------------------------------------------------------- 
        ---------------------------------------------- modal import bdd ------------------------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="import_bdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Importation de la base de données</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                    <span id="success_message"></span>
                    <form method="post" id="importer_bdd_form">
                            <fieldset>
                                <!-- FILE -->
                                <div class="custom-file">
                                    <input name="userfile" id="import_bdd_file" class="custom-file-input" type="file">
                                    <label class="custom-file-label" for="import_bdd_file">Choisir un fichier au format SQL</label>
                                </div>            

                                <div class="form-group" align="center">
                                    <input type="submit" name="importer_bdd" id="importer_bdd" class="btn perso_btn_primary shadow-none" value="Importer la base de donnée" />
                                </div>

                                <div class="form-group" align="center">
                                    <img id="ajax-loader" src="content/img/ajax-loader.gif" style="display: none">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-------------------------------------------------------------------------------------------------------------- 
        ---------------------------------------------- modal import image ----------------------------------------------
        ---------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="import_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Importation des schémas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body perso_modal_body">
                    <span id="success_message"></span>
                    <form method="post" id="importer_image_form">
                            <fieldset>
                                <!-- FILE -->
                                <div class="custom-file">
                                    <input name="userfile" id="import_image_file" class="custom-file-input" type="file">
                                    <label class="custom-file-label" for="import_image_file">Choisir un fichier au format ZIP</label>
                                </div>            

                                <div class="form-group" align="center">
                                    <input type="submit" name="importer_zip" id="importer_zip" class="btn perso_btn_primary shadow-none" value="Importer les schémas" />
                                </div>

                                <div class="form-group" align="center">
                                    <img id="ajax-loader" src="content/img/ajax-loader.gif" style="display: none">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php }
        ?>                                    

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
        <script src="content/js/modules/float_menu.js"></script>
        <script src="content/js/modules/realtime.js"></script>                            
        <script src="content/js/modules/export_table_to_excel.js"></script> 
        <?php if($userinfo['type_compte']=='Utilisateur'){
        ?>
                <script src="content/js/accueil/index_utilisateur.js"></script>
        <?php 
            }
              else if($userinfo['type_compte']=='Administrateur Logiciel'){    
        ?>
                <script src="content/js/modules/set_filter_sort_table.js"></script>
                <script src="content/js/modules/importer_bdd.js"></script>
                <script src="content/js/modules/importer_image.js"></script>
                <script src="content/js/modules/browse.js"></script>
                <script src="content/js/accueil/recherche_utilisateur.js"></script>
                <script src="content/js/accueil/recherche_version.js"></script>
                <script src="content/js/accueil/index_admin.js"></script>
                
        <?php
            }
        ?>
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