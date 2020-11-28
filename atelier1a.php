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

    $reqdroit = $bdd->prepare('SELECT * FROM H_RACI WHERE id_utilisateur = ? AND id_projet = ? AND id_atelier="1.a"');
    $reqdroit->bindParam(1, $getid);
    $reqdroit->bindParam(2, $getidproject);
    $reqdroit->execute();
    $userdroit = $reqdroit->fetch();

    $reqdroit_chef_de_projet = $bdd->prepare('SELECT id_utilisateur FROM F_projet WHERE id_projet = ?');
    $reqdroit_chef_de_projet->bindParam(1, $getidproject);
    $reqdroit_chef_de_projet->execute();
    $userdroit_chef_de_projet = $reqdroit_chef_de_projet->fetch();
?>

<?php include("content/php/atelier1a/selection.php");?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CyberRiskManager">
    <meta name="author" content="SecYourDev">

    <title>CyberRiskManager | Atelier 1.a</title>

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
  if(isset($userdroit['ecriture'])||$userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include("content\php\commun\menu_gauche.php");?>

        <!-- Right Sidebar -->
        <ul id=menu>
            <li>
                <a class="nav-link collapse-right-item menu_float" href="#donnees_principales">
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
                    <span class="nom_sous_menu">Données principales</span>
                </a>
            </li>
            <li>
                <a class="nav-link collapse-right-item menu_float" href="#acteurs">
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
                    <span class="nom_sous_menu">Acteurs</span>
                </a>
            </li>
            <li>
                <a class="nav-link collapse-right-item menu_float" href="#RACI">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity active"
                                    d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">3</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span class="nom_sous_menu">RACI</span>
                </a>
            </li>
        </ul>
        <!-- End of Right Sidebar -->

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

                    <div id="top_bar_1" class="top_bar_name_1"><?php echo $projectinfo['nom_projet'];?></div>
                    <div id="top_bar_2" class="top_bar_name_2">Atelier 1</div>
                    <div id="top_bar_3" class="top_bar_name_3">Activité 1.a - Cadrer l’étude</div>

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
                    <div class="row fondu">
                        <!-- Area Card -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0">Objectif</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <p> Le but de ce premier atelier est de définir le cadre de l’étude, son périmètre
                                        métier et technique, les
                                        événements
                                        redoutés associés et le socle de sécurité. Cet atelier est un prérequis à la
                                        réalisation d’une appréciation des
                                        risques.
                                        La période à considérer pour cet atelier est celle du cycle stratégique.</p>
                                    <!--text-->
                                </div>
                            </div>
                        </div>

                        <div class="card-columns">
                            <!-- Area Card -->
                            <!-- Données principales -->
                            <div class="card shadow mb-4 perso_card_half_screen">
                                <div id="donnees_principales"></div>
                                <!-- Card Header - Dropdown -->
                                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0">Données principales</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form class="user">
                                        <!--NOM ETUDE-->
                                        <div class="form-group">
                                            <label class="titre_input" for="nom_etude">Nom</label>
                                            <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){ 
                                            ?>        
                                                    <input type="text"
                                                        class="perso_form shadow-none form-control form-control-user"
                                                        id="nom_etude" placeholder="Nom" required>
                                                    </input>
                                        </div>
                                            <?php
                                                }
                                                else if (isset($userdroit['ecriture'])){
                                                    if($userdroit['ecriture']=='Réalisation'){
                                            ?>
                                                        <input type="text"
                                                            class="perso_form shadow-none form-control form-control-user"
                                                            id="nom_etude" placeholder="Nom" required>
                                                        </input>
                                        </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                        </br>
                                                        <label id="nom_etude" class="no_modification"></label>
                                        </div>
                                            <?php
                                                    }
                                                }
                                            ?>                   

                                        <!--OBJECTIF ETUDE-->
                                        <div class="form-group">
                                            <label class="titre_textarea" for="objectif_atteindre">Objectif à atteindre</label>
                                            <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){         
                                            ?>
                                                <textarea class="form-control perso_text_area" id="objectif_atteindre" rows="3"></textarea>
                                        </div>
                                            <?php
                                                } 
                                                else if(isset($userdroit['ecriture'])){
                                                    if($userdroit['ecriture']=='Réalisation'){
                                            ?>
                                                        <textarea class="form-control perso_text_area" id="objectif_atteindre" rows="3"></textarea>
                                        </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                        </br>
                                                        <label id="objectif_atteindre" class="no_modification"></label>
                                        </div>
                                            <?php
                                                    }
                                                }
                                            ?>                    
                                        <!--CADRE TEMPOREL ETUDE-->                            
                                        <div class="form-group">
                                            <label class="titre_input" for="cadre_temporel">Cadre Temporel</label>
                                            </br>
                                            <!-- Etape 1 -->
                                            <div class="container ">
                                                <form>
                                                    <div class="row ">  
                                                        <label class="titre_input" for="cadre_temporel">Atelier 1 : </label>
                                                        <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){       
                                                        ?>
                                                        <input type="date" class="perso_form shadow-none form-control form-control-user" style="width:150px" 
                                                                    id="cadre_temporel" placeholder="Cadre temporel" required>                                                           
                                                    </div>
                                                        <?php
                                                            }
                                                            else if(isset($userdroit['ecriture'])){
                                                                if($userdroit['ecriture']=='Réalisation'){
                                                        ?>
                                                                    <input type="date" class="perso_form shadow-none form-control form-control-user" style="width:150px"
                                                                    id="cadre_temporel" placeholder="Cadre temporel" required>                                                                
                                                    </div>
                                                        <?php
                                                                }
                                                                else { 
                                                        ?>
                                                        </br>
                                                        <label id="cadre_temporel" class="no_modification"></label>
                                                    </div>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    <div class="row ">  
                                                        <label class="titre_input" for="cadre_temporel">Atelier 2 : </label>
                                                        <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){       
                                                        ?>
                                                            <input type="date" class="perso_form shadow-none form-control form-control-user" style="width:150px" 
                                                                    id="cadre_temporel_etape_2" placeholder="Cadre temporel" required>                                                           
                                                    </div>
                                                        <?php
                                                            }
                                                            else if(isset($userdroit['ecriture'])){
                                                                if($userdroit['ecriture']=='Réalisation'){
                                                        ?>
                                                                    <input type="date" class="perso_form shadow-none form-control form-control-user" style="width:150px" 
                                                                    id="cadre_temporel_etape_2" placeholder="Cadre temporel" required>                                                                
                                                    </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                        </br>
                                                        <label id="cadre_temporel_etape_2" class="no_modification"></label>
                                                    </div>                                       
                                            <?php
                                                    }
                                                }
                                            ?>
                                                    <div class="row ">  
                                                        <label class="titre_input" for="cadre_temporel">Atelier 3 : </label>
                                                        <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){       
                                                        ?>
                                                            <input type="date" class="perso_form shadow-none form-control form-control-user" style="width:150px" 
                                                                    id="cadre_temporel_etape_3" placeholder="Cadre temporel" required>                                                           
                                                    </div>
                                                        <?php
                                                            }
                                                            else if(isset($userdroit['ecriture'])){
                                                                if($userdroit['ecriture']=='Réalisation'){
                                                        ?>
                                                                    <input type="date" class="perso_form shadow-none form-control form-control-user" style="width:150px"
                                                                    id="cadre_temporel_etape_3" placeholder="Cadre temporel" required>                                                                
                                                    </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                        </br>
                                                        <label id="cadre_temporel_etape_3" class="no_modification"></label>
                                                    </div>                                       
                                            <?php
                                                    }
                                                }
                                            ?>
                                                    <div class="row ">  
                                                        <label class="titre_input" for="cadre_temporel">Atelier 4 : </label>
                                                        <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){       
                                                        ?>
                                                            <input type="date" class="perso_form shadow-none form-control form-control-user" style="width:150px" 
                                                                    id="cadre_temporel_etape_4" placeholder="Cadre temporel" required>                                                           
                                                    </div>
                                                        <?php
                                                            }
                                                            else if(isset($userdroit['ecriture'])){
                                                                if($userdroit['ecriture']=='Réalisation'){
                                                        ?>
                                                                    <input type="date" class="perso_form shadow-none form-control form-control-user" style="width:150px"
                                                                    id="cadre_temporel_etape_4" placeholder="Cadre temporel" required>                                                                
                                                    </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                        </br>
                                                        <label id="cadre_temporel_etape_4" class="no_modification"></label>
                                                    </div>                                       
                                            <?php
                                                    }
                                                }
                                            ?>
                                                    <div class="row ">  
                                                        <label class="titre_input" for="cadre_temporel">Atelier 5 : </label>
                                                        <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){       
                                                        ?>
                                                            <input type="date" class="perso_form shadow-none form-control form-control-user" style="width:150px" 
                                                                    id="cadre_temporel_etape_5" placeholder="Cadre temporel" required>                                                           
                                                    </div>
                                                        <?php
                                                            }
                                                            else if(isset($userdroit['ecriture'])){
                                                                if($userdroit['ecriture']=='Réalisation'){
                                                        ?>
                                                                    <input type="date" class="perso_form shadow-none form-control form-control-user" style="width:150px"
                                                                    id="cadre_temporel_etape_5" placeholder="Cadre temporel" required>                                                                
                                                    </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                        </br>
                                                        <label id="cadre_temporel_etape_5" class="no_modification"></label>
                                                    </div>                                       
                                            <?php
                                                    }
                                                }
                                            ?>
                                                </form>
                                            </div>
                                        </div>  

                                       <!-- Duree des cycles stratégiques et oprétionnels-->                            
                                       <div class="form-group">
                                            <label class="titre_input" for="duree_cycles">Durée des cycles stratégiques et opérationnels</label>
                                            </br>
                                            <!-- Cycle strategique -->
                                            <div class="container ">
                                                <form>
                                                    <div class="row ">  
                                                        <label class="titre_input" for="duree_cycles">Durée des cycles stratégiques : </label>
                                                        <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){       
                                                        ?>
                                                        <input type="text" class="perso_form shadow-none form-control form-control-user" style="width:200px" 
                                                                    id="cycle_strategique" placeholder="Durée des cycles stratégiques" required>                                                           
                                                    </div>
                                                        <?php
                                                            }
                                                            else if(isset($userdroit['ecriture'])){
                                                                if($userdroit['ecriture']=='Réalisation'){
                                                        ?>
                                                                    <input type="text" class="perso_form shadow-none form-control form-control-user" style="width:200px"
                                                                    id="cycle_strategique" placeholder="Durée des cycles stratégiques" required>                                                                
                                                    </div>
                                                        <?php
                                                                }
                                                                else { 
                                                        ?>
                                                        </br>
                                                        <label id="cycle_strategique" class="no_modification"></label>
                                                    </div>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    <div class="row ">  
                                                        <label class="titre_input" for="duree_cycles">Durée des cycles opérationnels : </label>
                                                        <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){       
                                                        ?>
                                                            <input type="text" class="perso_form shadow-none form-control form-control-user" style="width:200px" 
                                                                    id="cycle_operationnel" placeholder="Durée des cycles opérationnels" required>                                                           
                                                    </div>
                                                        <?php
                                                            }
                                                            else if(isset($userdroit['ecriture'])){
                                                                if($userdroit['ecriture']=='Réalisation'){
                                                        ?>
                                                                    <input type="text" class="perso_form shadow-none form-control form-control-user" style="width:200px" 
                                                                    id="cycle_operationnel" placeholder="Durée des cycles opérationnels" required>                                                                
                                                    </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                        </br>
                                                        <label id="cycle_operationnel" class="no_modification"></label>
                                                    </div>                                       
                                            <?php
                                                    }
                                                }
                                            ?> 
                                                </form>
                                            </div>
                                        </div>  

                                        <!--Confidentialite-->
                                        <div class="form-group">
                                            <label class="titre_input" for="confidentialite"> Niveau de confidentialité</label>
                                            <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){       
                                            ?>
                                            <select class="form-control" id="confidentialite">
                                                <option value="" selected>...</option>
                                                <option value="Non protégée">Non protégée</option>
                                                <option value="Sensible">Sensible</option>
                                                <option value="Confidentiel">Confidentiel</option>
                                                <option value="Secret">Secret</option>
                                            </select>
                                        </div>
                                            <?php
                                                }
                                                else if(isset($userdroit['ecriture'])){
                                                    if($userdroit['ecriture']=='Réalisation'){
                                            ?>
                                            <select class="form-control" id="confidentialite">
                                                <option value="" selected>...</option>
                                                <option value="Non protégée">Non protégée</option>
                                                <option value="Sensible">Sensible</option>
                                                <option value="Confidentiel">Confidentiel</option>
                                                <option value="Secret">Secret</option>
                                            </select>
                                        </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                    </br>
                                                    <label id="confidentialite" class="no_modification"></label>
                                        </div>
                                            <?php
                                                    }
                                                }
                                            ?>  

                                        <!--RISQUE ETUDE-->
                                        <div class="form-group">
                                            <label class="titre_input" for="respo_acceptation_risque">Personne responsable d'accepter
                                                les risques résiduels au terme de l'étude</label>
                                            <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){       
                                            ?>
                                            <select class="form-control" id="respo_acceptation_risque">
                                                <option value="" selected>...</option>
                                                    <?php
                                                    while($row = mysqli_fetch_array($result_risques_residuels))
                                                    {
                                                        echo '
                                                        <option value="'.$row["id_utilisateur"].'">'.$row["nom"].' '.$row["prenom"].'</option>
                                                        ';
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                            <?php
                                                }
                                                else if(isset($userdroit['ecriture'])){
                                                    if($userdroit['ecriture']=='Réalisation'){
                                            ?>
                                                        <select class="form-control" id="respo_acceptation_risque">
                                                        <option value="" selected>...</option>
                                                            <?php
                                                            while($row = mysqli_fetch_array($result_risques_residuels))
                                                            {
                                                                echo '
                                                                <option value="'.$row["id_utilisateur"].'">'.$row["nom"].' '.$row["prenom"].'</option>
                                                                ';
                                                            }
                                                            ?>
                                                        </select>
                                        </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                    </br>
                                                    <label id="respo_acceptation_risque" class="no_modification"></label>
                                        </div>
                                            <?php
                                                    }
                                                }
                                            ?>  
                                    </form>
                                </div>
                            </div>

                            <!-- Area Card -->
                            <!-- Acteurs -->
                            <div class="card shadow mb-4 perso_card_half_screen" >
                                <div id="acteurs"></div>
                                <!-- Card Header - Dropdown -->
                                <div class="row perso_no_margin">
                                    <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <h6 class="m-0">Acteurs</h6>
                                    </div>
                                    <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <a class="download_table_button" id="button_download_acteurs">
                                        <i class="fas fa-download fa-lg text-gray-400"></i>
                                    </a>
                                    </div>    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){                                     
                                    ?>
                                            <form>
                                                <fieldset>
                                                    <div class="form-group">
                                                        <label class="titre_input" for="user_1a">Utilisateur</label>
                                                            <select class="form-control" name="nom_utilisateur" id="user_1a">
                                                                <option value="" selected>...</option>
                                                                <?php
                                                                while($row = mysqli_fetch_array($result_RACI_user))
                                                                {
                                                                    echo '
                                                                    <option value="'.$row["id_utilisateur"].'">'.$row["nom"].' '.$row["prenom"].'</option>
                                                                    ';
                                                                }
                                                                ?>
                                                            </select>
                                                    </div>
                                                    
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

                                                    <div>
                                                        <button type="button" id='ajouter_user' name="ajouter_user" class="btn perso_btn shadow-none">Ajouter</button>
                                                    </div>
                                                </fieldset>
                                            </form>
                                            </br>
                                    <?php
                                        }
                                        else if(isset($userdroit['ecriture'])){
                                            if($userdroit['ecriture']=='Réalisation'){
                                    ?>
                                                <form>
                                                    <fieldset>
                                                        <div class="form-group">
                                                            <label class="titre_input" for="user_1a">Utilisateur</label>
                                                                <select class="form-control" name="nom_utilisateur" id="user_1a">
                                                                    <option value="" selected>...</option>
                                                                    <?php
                                                                    while($row = mysqli_fetch_array($result_RACI_user))
                                                                    {
                                                                        echo '
                                                                        <option value="'.$row["id_utilisateur"].'">'.$row["nom"].' '.$row["prenom"].'</option>
                                                                        ';
                                                                    }
                                                                    ?>
                                                                </select>
                                                        </div>
                                                        
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

                                                        <div>
                                                            <button type="button" id='ajouter_user' name="ajouter_user" class="btn perso_btn shadow-none">Ajouter</button>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                                </br>
                                    <?php
                                            }
                                        }   
                                    ?>   

                                    <!--tableau-->
                                    <div class="table-responsive">
                                        <input type="text" class="rechercher_input" id="rechercher_acteur" placeholder="Rechercher">
                                        <table id="editable_table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Poste</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while($row = mysqli_fetch_array($acteur_choisi))
                                                {
                                                    echo '
                                                    <tr>
                                                    <td>'.$row["id_utilisateur"].'</td>
                                                    <td>'.$row["nom"].'</td>
                                                    <td>'.$row["prenom"].'</td>
                                                    <td>'.$row["poste"].'</td>
                                                    </tr>
                                                    ';
                                                }
                                                ?>
                                            </tbody>
                                        </table>

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
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Area Card -->
                        <!-- RACI -->
                        <div id="RACI" class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="row perso_no_margin">
                                    <div class="card-header col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <h6>RACI</h6>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table id="raci" class="table table-bordered">
                                            <thead>
                                                <tr id='acteur_id_raci'>
                                                    <th scope="col">#</th>
                                                    <?php
                                                    while($row = mysqli_fetch_array($RACI_id_user))
                                                    {
                                                        echo '
                                                        <th scope="col">
                                                            <div class="perso_vertical">'.$row["id_utilisateur"].'</div>
                                                        </th>
                                                        ';
                                                    }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <?php
                                                    while($row = mysqli_fetch_array($RACI_user))
                                                    {
                                                        echo '
                                                        <th scope="col">
                                                            <div class="perso_vertical">'.$row["nom"].' <br> '.$row["prenom"].'</div>
                                                        </th>
                                                        ';
                                                    }
                                                    ?>
                                                </tr>
                                                <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){                                     
                                                ?>
                                                        <tr>
                                                            <th scope="col">Modification générale</th>
                                                        </tr>
                                                <?php
                                                        }
                                                        else if(isset($userdroit['ecriture'])){
                                                            if($userdroit['ecriture']=='Réalisation'){
                                                ?>
                                                                <tr>
                                                                    <th scope="col">Modification générale</th>
                                                                </tr>
                                                <?php
                                                            }
                                                        }   
                                                ?> 
                                            </thead>

                                            <tbody class="raci_th">
                                                <tr>
                                                    <th name="1.a" scope="row">Activité 1.a - Cadrer l’étude</th>
                                                </tr>
                                                <tr>
                                                    <th name="1.b" scope="row">Activité 1.b - Biens primordiaux/support</th>
                                                </tr>
                                                <tr>
                                                    <th name="1.c" scope="row">Activité 1.c - Événement redoutés</th>
                                                </tr>
                                                <tr>
                                                    <th name="1.d" scope="row">Activité 1.d - Les socles de sécurité</th>
                                                </tr>
                                                <tr>
                                                    <th name="2.a" scope="row">Activité 2.a - Identifier les sources de risques et les
                                                        objectifs</th>
                                                </tr>
                                                <tr>
                                                    <th name="2.b" scope="row">Activité 2.b - Évaluer les couples sources de
                                                        risque/objectifs visés</th>
                                                </tr>
                                                <tr>
                                                    <th name="2.c" scope="row">Activité 2.c - Sélectionner les couples SR/OV retenus pour la suite de l'analyse</th>
                                                </tr>
                                                <tr>
                                                    <th name="3.a" scope="row">Activité 3.a - Construire la cartographie des menaces
                                                        numériques de l'écosystème et sélectionner les parties prenantes critiques</th>
                                                </tr>
                                                <tr>
                                                    <th name="3.b" scope="row">Activité 3.b - Élaborer des scénarios stratégiques</th>
                                                </tr>
                                                <tr>
                                                    <th name="3.c" scope="row">Activité 3.c - Définir des mesures de sécurité sur
                                                        l'écosystème</th>
                                                </tr>
                                                <tr>
                                                    <th name="4.a" scope="row">Activité 4.a - Élaborer les scénarios
                                                        opérationnels</th>
                                                </tr>
                                                <tr>
                                                    <th name="4.b" scope="row">Activité 4.b - Évaluer la vraisemblance des scénarios
                                                        opérationnels</th>
                                                </tr>
                                                <tr>
                                                    <th name="5.a" scope="row">Activité 5.a - Réaliser une synthèse des scénarios de
                                                        risque</th>
                                                </tr>
                                                <tr>
                                                    <th name="5.b" scope="row">Activité 5.b - Décider de la stratégie de traitement du
                                                        risque et définir les mesures de sécurité</th>
                                                </tr>
                                                <tr>
                                                    <th name="5.c" scope="row">Activité 5.c - Évaluer et documenter les risques
                                                        résiduels</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->

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
            <!-- End of Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>                                                

    <!-- Open the right menu-->
    <a class="open_menu rounded">
        <i class="fas fa-bars"></i>
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
                <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à terminer votre session
                    en cours.</div>
                <div class="modal-footer">
                    <form method="post" action="content/php/deconnexion/logs.php">
                        <fieldset>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <input type="submit" name="deconnexion" value="Déconnexion" class="btn btn-primary"></input>
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
    <script src="content/js/modules/top_bar.js"></script>
    <script src="content/js/modules/side_bar.js"></script>
    <script src="content/js/modules/float_menu.js"></script>
    <script src="content/js/modules/fixed_page.js"></script>
    <script src="content/js/modules/realtime.js"></script>
    <script src="content/js/modules/set_filter_sort_table.js"></script>
    <script src="content/js/modules/dateString.js"></script>
    <script src="content/js/modules/export_table_to_excel.js"></script>
    <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){    
    ?>
        <script src="content/js/atelier/atelier1a.js"></script>
    <?php
        }
        else if(isset($userdroit['ecriture'])){
            if($userdroit['ecriture']=='Réalisation'){
    ?>
                <script src="content/js/atelier/atelier1a.js"></script>
    <?php 
            }
            else{
    ?>
                <script src="content/js/atelier/atelier1a_no_modification.js"></script>
    <?php
            }
        }        
    ?>
    <script src="content/js/modules/sort_table.js"></script>
</body>
<?php
  }
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