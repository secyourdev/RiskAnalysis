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

    <!-- Favicon -->
    <link rel="shortcut icon" href="content/img/logo_cyber_risk_manager.ico" type="image/x-icon">
	<link rel="icon" href="content/img/logo_cyber_risk_manager.png" type="image/png">
</head>

<?php 
if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur'])
{
  if(isset($userdroit['ecriture'])||$userinfo['type_compte']=='Administrateur Logiciel'){
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
                <div class="sidebar-brand-text mx-2">CYBER RISK MANAGER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de Bord</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Ateliers</div>

            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier1"
                    aria-expanded="true" aria-controls="Atelier1">
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
                    <span class="nom_atelier">Cadrage et socle de sécurité</span>
                </a>
                <div id="Atelier1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="atelier-1a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="1.a"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">1.a</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_1" title="Cadrer l’étude">Cadrer l’étude</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-1b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="1.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">1.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_2" title="Biens primordiaux/support">Biens primordiaux/support</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-1c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="1.c"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">1.c</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_3" title="Événements redoutés">Événements redoutés</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-1d&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="1.d"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">1.d</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_4" title="Le socle de sécurité">Le socle de sécurité</span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier2"
                    aria-expanded="true" aria-controls="Atelier2">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="2" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">2</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span>Source de risque</span>
                </a>
                <div id="Atelier2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="atelier-2a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="2.a"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">2.a</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_5"
                                title="Identifier les sources de risques et les objectifs">Identifier les sources de risques et les objectifs</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-2b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="2.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">2.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_6"
                                title="Évaluer les couples sources de risque/objectifs visés">Évaluer les couples sources de risque/objectifs visés</span>
                        </a>
                        <a class="collapse-item" href="atelier-2c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                        <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                            <g transform="translate(-124 -292)">
                            <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                            <text class="number_sub_activity_text" data-name="2.c" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">2.c</tspan></text>
                            </g>
                        </svg>
                        </i>
                        <span id="nom_sous_atelier_15" title="Sélectionner les couples SR/OV retenus pour la suite de l'analyse">Sélectionner les couples SR/OV retenus pour la suite de l'analyse</span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier3"
                    aria-expanded="true" aria-controls="Atelier3">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="3" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">3</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span>Scénarios stratégiques</span>
                </a>
                <div id="Atelier3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="atelier-3a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="3.a"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">3.a</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_7"
                                title="Construire la cartographie des menaces numériques de l'écosystème et sélectionner les parties prenantes critiques">Construire
                                la cartographie des menaces numériques de l'écosystème et sélectionner les parties prenantes critiques</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-3b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="3.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">3.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_8" title="Élaborer des scénarios stratégiques">Élaborer des scénarios stratégiques</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-3c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="3.c"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">3.c</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_9"
                                title="Définir des mesures de sécurité sur l’écosystème">Définir des mesures de sécurité sur l’écosystème</span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier4"
                    aria-expanded="true" aria-controls="Atelier4">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="4" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">4</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span>Scénarios opérationnels</span>
                </a>
                <div id="Atelier4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="atelier-4a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="4.a"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">4.a</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_10" title="Élaborer les scénarios opérationnels">Élaborer les scénarios opérationnels</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-4b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="4.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">4.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_11"
                                title="Évaluer la vraisemblance des scénarios opérationnels">Évaluer la vraisemblance des scénarios opérationnels</span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier5"
                    aria-expanded="true" aria-controls="Atelier5">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="5" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">5</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span>Traitement du risque</span>
                </a>
                <div id="Atelier5" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="atelier-5a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="5.a"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">5.a</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_12"
                                title="Réaliser une synthèse des scénarios de risque">Réaliser une synthèse des scénarios de risque</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-5b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="5.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">5.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_13"
                                title="Décider de la stratégie de traitement du risque et définir les mesures de sécurité">Décider de la stratégie de traitement du risque et définir les mesures de sécurité</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-5btableau&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="5.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">5.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_16"
                                title="Tableau récapitulatif">Tableau récapitulatif</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-5bpacs&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="5.b"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">5.b</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_17"
                                title="PACS">PACS</span>
                        </a>
                        <a class="collapse-item"
                            href="atelier-5c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                    <g transform="translate(-124 -292)">
                                        <path class="number_sub_activity"
                                            d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                            transform="translate(124 292)" fill="#394c7a" />
                                        <text class="number_sub_activity_text" data-name="5.c"
                                            transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11"
                                            font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                                            <tspan x="-7.5" y="-1.5">5.c</tspan>
                                        </text>
                                    </g>
                                </svg>
                            </i>
                            <span id="nom_sous_atelier_14" title="Évaluer et documenter les risques résiduels">Évaluer et documenter les risques résiduels</span>
                        </a>
                    </div>
                </div>
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
                                            <?php if(isset($userdroit['ecriture'])){
                                                    if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'){
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
                                                        <label id="nom_etude" class="no_modification"></input>
                                        </div>
                                            <?php
                                                    }
                                                }
                                                else if($userinfo['type_compte']=='Administrateur Logiciel'){ 
                                            ?>        
                                                    <input type="text"
                                                        class="perso_form shadow-none form-control form-control-user"
                                                        id="nom_etude" placeholder="Nom" required>
                                                    </input>
                                        </div>
                                            <?php
                                                }
                                            ?>                   

                                        <!--OBJECTIF ETUDE-->
                                        <div class="form-group">
                                            <label class="titre_textarea" for="objectif_atteindre">Objectif à atteindre</label>
                                            <?php if(isset($userdroit['ecriture'])){
                                                    if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'){
                                            ?>
                                                        <textarea class="form-control perso_text_area" id="objectif_atteindre" rows="3"></textarea>
                                        </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                        </br>
                                                        <label id="objectif_atteindre" class="no_modification"></input>
                                        </div>
                                            <?php
                                                    }
                                                }
                                                else if($userinfo['type_compte']=='Administrateur Logiciel'){         
                                            ?>
                                                <textarea class="form-control perso_text_area" id="objectif_atteindre" rows="3"></textarea>
                                        </div>
                                            <?php
                                                }
                                            ?>                    
                                        <!--CADRE TEMPOREL ETUDE-->
                                        <div class="form-group">
                                            <label class="titre_input" for="cadre_temporel">Cadre Temporel</label>
                                            <?php if(isset($userdroit['ecriture'])){
                                                    if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'){
                                            ?>
                                                        <input type="date" class="perso_form shadow-none form-control form-control-user"
                                                        id="cadre_temporel" placeholder="Cadre temporel" required>
                                        </div>
                                            <?php
                                                    }
                                                    else { 
                                            ?>
                                                        </br>
                                                        <label id="cadre_temporel" class="no_modification"></input>
                                        </div>
                                            <?php
                                                    }
                                                }
                                                else if($userinfo['type_compte']=='Administrateur Logiciel'){       
                                            ?>
                                                <input type="date" class="perso_form shadow-none form-control form-control-user"
                                                id="cadre_temporel" placeholder="Cadre temporel" required>
                                        </div>
                                            <?php
                                                }
                                            ?>  
                                        <!--RISQUE ETUDE-->
                                        <div class="form-group">
                                            <label class="titre_input" for="respo_acceptation_risque">Personne responsable d'accepter
                                                les risques résiduels au terme de l'étude</label>
                                            <?php if(isset($userdroit['ecriture'])){
                                                    if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'){
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
                                                    <label id="respo_acceptation_risque" class="no_modification"></input>
                                        </div>
                                            <?php
                                                    }
                                                }
                                                else if($userinfo['type_compte']=='Administrateur Logiciel'){       
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
                                            ?>  
                                    </form>
                                    <img src="content/img/task.svg" class="img-fluid perso_img">

                                </div>
                            </div>

                            <!-- Area Card -->
                            <!-- Acteurs -->
                            <div class="card shadow mb-4 perso_card_half_screen" id=acteurs>
                                <!-- Card Header - Dropdown -->
                                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0">Acteurs</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php if(isset($userdroit['ecriture'])){
                                            if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'){
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
                                                                        <option value="'.$row["id_utilisateur"].'- '.$row["nom"].' '.$row["prenom"].'">'.$row["id_utilisateur"].'- '.$row["nom"].' '.$row["prenom"].'</option>
                                                                        ';
                                                                    }
                                                                    ?>
                                                                </select>
                                                        </div>
                                                        
                                                        <div>
                                                        <button type="button" id='ajouter_user' name="ajouter_user" class="btn perso_btn shadow-none">Ajouter</button>
                                                    </fieldset>
                                                </form>
                                                </br>
                                    <?php
                                            }
                                            else { 
                                    ?>
                                    <?php
                                        }
                                    }
                                        else if($userinfo['type_compte']=='Administrateur Logiciel'){                                     
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
                                                                    <option value="'.$row["id_utilisateur"].'- '.$row["nom"].' '.$row["prenom"].'">'.$row["id_utilisateur"].'- '.$row["nom"].' '.$row["prenom"].'</option>
                                                                    ';
                                                                }
                                                                ?>
                                                            </select>
                                                    </div>
                                                    
                                                    <div>
                                                    <button type="button" id='ajouter_user' name="ajouter_user" class="btn perso_btn shadow-none">Ajouter</button>
                                                </fieldset>
                                            </form>
                                            </br>
                                    <?php
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
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Area Card -->
                        <!-- RACI -->
                        <div class="col-xl-12 col-lg-12">
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
    <script src="content/js/modules/fixed_page.js"></script>
    <script src="content/js/modules/help_button.js"></script>
    <script src="content/js/modules/gravite.js"></script>
    <script src="content/js/modules/realtime.js"></script>
    <script src="content/js/modules/set_filter_sort_table.js"></script>
    <?php if(isset($userdroit['ecriture'])){
            if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'){
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
        else if($userinfo['type_compte']=='Administrateur Logiciel'){    
    ?>
        <script src="content/js/atelier/atelier1a.js"></script>
    <?php
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