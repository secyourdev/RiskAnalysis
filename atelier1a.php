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

    $reqdroit = $bdd->prepare('SELECT * FROM disposer NATURAL JOIN avoir WHERE id_utilisateur = ? AND id_atelier="1.a"');
    $reqdroit->execute(array($getid));
    $userdroit = $reqdroit->fetch();
?>

<?php include("content/php/atelier1a/selection.php");?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="RiskManager">
  <meta name="author" content="SecYourDev">

  <title>RiskManager | Atelier 1.a</title>

  <!-- Fonts-->
  <link href="content/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">      
        <!-- Logo -->
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-shield-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-2">RISK MANAGER</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Tableau de Bord</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">Ateliers</div>
      
      <!-- Nav Item - Charts -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier1" aria-expanded="true"
          aria-controls="Atelier1">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity active" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc"/>
                <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-3.432" y="0">1</tspan></text>
              </g>
            </svg>
          </i>
          <span class="nom_atelier">Cadrage et socle de sécurité</span>
        </a>
        <div id="Atelier1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="atelier-1a">
              <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                <g transform="translate(-124 -292)">
                  <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                  <text class="number_sub_activity_text" data-name="1.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">1.a</tspan></text>
                </g>
              </svg>
              </i>
              <span id="nom_sous_atelier_1" title="Cadrer l’étude">Cadrer l’étude</span>
            </a>
            <a class="collapse-item" href="atelier-1b">
              <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                <g transform="translate(-124 -292)">
                  <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                  <text class="number_sub_activity_text" data-name="1.b" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">1.b</tspan></text>
                </g>
              </svg>
              </i>
              <span id="nom_sous_atelier_2" title="Biens primordiaux/support">Biens primordiaux/support</span>
            </a>
            <a class="collapse-item" href="atelier-1c">
              <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                <g transform="translate(-124 -292)">
                  <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                  <text class="number_sub_activity_text" data-name="1.c" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">1.c</tspan></text>
                </g>
              </svg>
              </i>
              <span id="nom_sous_atelier_3" title="Événements redoutés">Événements redoutés</span>
            </a>
            <a class="collapse-item" href="atelier-1d">
              <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                <g transform="translate(-124 -292)">
                  <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                  <text class="number_sub_activity_text" data-name="1.d" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">1.d</tspan></text>
                </g>
              </svg>
              </i>
              <span id="nom_sous_atelier_4" title="Le socle de sécurité">Le socle de sécurité</span>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier2" aria-expanded="true"
          aria-controls="Atelier2">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc"/>
                <text class="number_activity_text" data-name="2" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-3.432" y="0">2</tspan></text>
              </g>
            </svg>
          </i>
          <span>Source de risque</span>
        </a>
        <div id="Atelier2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="atelier-2a">
              <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                <g transform="translate(-124 -292)">
                  <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                  <text class="number_sub_activity_text" data-name="2.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">2.a</tspan></text>
                </g>
              </svg>
              </i>
              <span id="nom_sous_atelier_5" title="Identifier les sources de risques et les objectifs">Identifier les sources de risques et les objectifs</span>
            </a>
            <a class="collapse-item" href="atelier-2b">
              <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                <g transform="translate(-124 -292)">
                  <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                  <text class="number_sub_activity_text" data-name="2.b" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">2.b</tspan></text>
                </g>
              </svg>
              </i>
              <span id="nom_sous_atelier_6" title="Évaluer les couples sources de risque/objectifs visés">Évaluer les couples sources de risque/objectifs visés</span>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier3" aria-expanded="true"
          aria-controls="Atelier3">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc"/>
                <text class="number_activity_text" data-name="3" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-3.432" y="0">3</tspan></text>
              </g>
            </svg>
          </i>
          <span>Scénarios stratégiques</span>
        </a>
        <div id="Atelier3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="atelier-3a">
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                    <text class="number_sub_activity_text" data-name="3.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">3.a</tspan></text>
                  </g>
                </svg>
                </i>
                <span id="nom_sous_atelier_7" title="Construire la cartographie des menaces numériques de l'écosystème et sélectionner les parties prenantes critiques">Construire la cartographie des menaces numériques de l'écosystème et sélectionner les parties prenantes critiques</span>
              </a>
              <a class="collapse-item" href="atelier-3b">
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                    <text class="number_sub_activity_text" data-name="3.b" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">3.b</tspan></text>
                  </g>
                </svg>
                </i>
                <span id="nom_sous_atelier_8" title="Élaborer des scénarios stratégiques">Élaborer des scénarios stratégiques</span>
              </a>
              <a class="collapse-item" href="atelier-3c">
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                    <text class="number_sub_activity_text" data-name="3.c" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">3.c</tspan></text>
                  </g>
                </svg>
                </i>
                <span id="nom_sous_atelier_9" title="Définir des mesures de sécurité sur l’écosystème">Définir des mesures de sécurité sur l’écosystème</span>
              </a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier4" aria-expanded="true"
          aria-controls="Atelier4">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc"/>
                <text class="number_activity_text" data-name="4" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-3.432" y="0">4</tspan></text>
              </g>
            </svg>
          </i>
          <span>Scénarios opérationnels</span>
        </a>
        <div id="Atelier4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="atelier-4a">
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                    <text class="number_sub_activity_text" data-name="4.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">4.a</tspan></text>
                  </g>
                </svg>
                </i>
                <span id="nom_sous_atelier_10" title="Élaborer les scénarios opérationnels">Élaborer les scénarios opérationnels</span>
              </a>
              <a class="collapse-item" href="atelier-4b">
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                    <text class="number_sub_activity_text" data-name="4.b" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">4.b</tspan></text>
                  </g>
                </svg>
                </i>
                <span id="nom_sous_atelier_11" title="Évaluer la vraisemblance des scénarios opérationnels">Évaluer la vraisemblance des scénarios opérationnels</span>
              </a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier5" aria-expanded="true"
          aria-controls="Atelier5">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc"/>
                <text class="number_activity_text" data-name="5" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-3.432" y="0">5</tspan></text>
              </g>
            </svg>
          </i>
          <span>Traitement du risque</span>
        </a>
        <div id="Atelier5" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="atelier-5a">
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                    <text class="number_sub_activity_text" data-name="5.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">5.a</tspan></text>
                  </g>
                </svg>
                </i>
                <span id="nom_sous_atelier_12" title="Réaliser une synthèse des scénarios de risque">Réaliser une synthèse des scénarios de risque</span>
              </a>
              <a class="collapse-item" href="atelier-5b">
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                    <text class="number_sub_activity_text" data-name="5.b" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">5.b</tspan></text>
                  </g>
                </svg>
                </i>
                <span id="nom_sous_atelier_13" title="Décider de la stratégie de traitement du risque et définir les mesures de sécurité">Décider de la stratégie de traitement du risque et définir les mesures de sécurité</span>
              </a>
              <a class="collapse-item" href="atelier-5c">
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                    <text class="number_sub_activity_text" data-name="5.c" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">5.c</tspan></text>
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <div id="top_bar_1" class="top_bar_name_1">Fabrication de vacccin</div>
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
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $userinfo['prenom'];?></span>
                <img class="img-profile rounded-circle" src="content/img/undraw_profile_pic.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
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
          <div class="row">
            <!-- Area Card -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Objectif</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <p> Le but de ce premier atelier est de définir le cadre de l’étude, son périmètre métier et technique, les
                    événements
                    redoutés associés et le socle de sécurité. Cet atelier est un prérequis à la réalisation d’une appréciation des
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
                    <?php if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'||$userinfo['type_compte']=='Administrateur Logiciel'){
                    ?>
                      <input type="text" class="perso_form shadow-none form-control form-control-user" id="nom_etude" placeholder="Nom" required></input>
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
                    ?>
                    <!--OBJECTIF ETUDE-->
                    <div class="form-group">
                      <label class="titre_textarea" for="objectif_atteindre">Objectif à atteindre</label>
                    <?php if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'||$userinfo['type_compte']=='Administrateur Logiciel'){
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
                    ?>
                    <!--CADRE TEMPOREL ETUDE-->
                    <div class="form-group">
                      <label class="titre_input" for="cadre_temporel">Cadre Temporel</label>
                    <?php if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'||$userinfo['type_compte']=='Administrateur Logiciel'){
                    ?>
                      <input type="date" class="perso_form shadow-none form-control form-control-user" id="cadre_temporel" placeholder="Cadre temporel" required>
                    </div>
                    <?php
                    }
                    else { 
                    ?>
                      <br/>
                      <label id="cadre_temporel" class="no_modification"></input>
                    </div>
                    <?php
                    }
                    ?>
                    <!--RISQUE ETUDE-->
                    <div class="form-group">
                      <label class="titre_input" for="respo_acceptation_risque">Personne responsable d'accepter les risques résiduels au terme de l'étude</label>
                    <?php if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'||$userinfo['type_compte']=='Administrateur Logiciel'){
                    ?>
                    <select class="form-control" id="respo_acceptation_risque">
                        <option selected>...</option>
                        <option>Directeur</option>
                        <option>RSSI</option>
                        <option>Responsable Informatique</option>
                    </select>
                    </div>
                    <?php
                    }
                    else { 
                    ?>
                      <br/>
                      <label id="respo_acceptation_risque" class="no_modification"></input>
                    </div>
                    <?php
                    }
                    ?>

                    <div class="card-header gravite col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <?php if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'||$userinfo['type_compte']=='Administrateur Logiciel'){
                    ?>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="radio_gravite4" name="radio_gravite" class="custom-control-input" value="4">
                          <label class="custom-control-label" for="radio_gravite4">Gravité sur 4</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="radio_gravite5" name="radio_gravite" class="custom-control-input" value="5">
                          <label class="custom-control-label" for="radio_gravite5">Gravité sur 5</label>
                        </div>
                        <div class="perso_icon_btn custom-control-inline" data-container="body" data-trigger="hover focus" data-toggle="popover" data-placement="bottom" data-content="Ce choix engendre automatiquement le même barème sur vraisemblance ! ">
                          <i class="fas fa-info-circle"></i>
                        </div>
                    </div>
                    <?php
                    }
                    else { 
                    ?>
                      <label class="titre_input">Barème</label>
                      <br/>
                      <label id="radio_gravite4" class="no_modification"></label>
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
                <?php if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'||$userinfo['type_compte']=='Administrateur Logiciel'){
                ?>
                  <form method="post" action="content/php/atelier1a/ajout.php" class="user" id="formActeur">
                  <fieldset>
                    <div class="form-group">
                      <label class="titre_input" for="nom_acteur">Nom</label>
                      <input type="text" class="perso_form shadow-none form-control form-control-user" id="nom_acteur" name="nom" placeholder="Nom" required>
                    </div>
                    <div class="form-group">
                      <label class="titre_input" for="prenom_acteur">Prénom</label>
                      <input type="text" class="perso_form shadow-none form-control form-control-user" id="prenom_acteur" name="prenom" placeholder="Prénom" required>
                    </div>

                    <div class="form-group">
                      <label class="titre_input" for="poste_acteur">Poste</label>
                      <input type="text" class="perso_arrow perso_form shadow-none form-control" list="Postes" id="poste_acteur" name="poste" placeholder="Poste" required>
                      <datalist id="Postes">
                        <option value="Internet Explorer">
                        <option value="Firefox">
                        <option value="Chrome">
                        <option value="Opera">
                        <option value="Safari">
                      </datalist>
                    </div>
                    <div>
                      <input type="submit" name="valider" value="Ajouter" class="btn perso_btn shadow-none"></input>
                    </div>
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
                      while($row = mysqli_fetch_array($result))
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
                  <!-- bouton ajouter -->
                  <div class="card-header perso_header_right col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <button type="button" class="btn perso_btn perso_btn_RACI shadow-none">Gérer les droits</button>
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
                        while($row = mysqli_fetch_array($result2))
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
                        while($row = mysqli_fetch_array($result3))
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
                          <th name="2.a" scope="row">Activité 2.a - Identifier les sources de risques et les objectifs</th>
                        </tr>
                        <tr>
                          <th name="2.b" scope="row">Activité 2.b - Évaluer les couples sources de risque/objectifs visés</th>
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
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; RISK MANAGER 2020</span>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Êtes-vous prêt à quitter l'application ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à terminer votre session en cours.</div>
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
  <script src="content/js/modules/help_button.js"></script>
  <script src="content/js/modules/gravite.js"></script>
  <script src="content/js/modules/realtime.js"></script>
  <script src="content/js/modules/set_filter_sort_table.js"></script>
  <?php if($userdroit['ecriture']=='Réalisation'||$userinfo['type_compte']=='Chef de Projet'||$userinfo['type_compte']=='Administrateur Logiciel'){?>
    <script> var sessionIdProjet = <?php echo $_SESSION['id_projet']; ?>;
    </script>
    <script src="content/js/atelier/atelier1a.js"></script>  
  <?php 
  }
  else{
  ?>
    <script src="content/js/atelier/atelier1a_no_modification.js"></script>
  <?php
  }
  ?>
  <script src="content/js/modules/sort_table.js"></script>  
</body>
<?php
}
else{
  header('Location: connexion.php');
}
?>
</html>
<?php
}
else{
  header('Location: connexion.php');
}
?>