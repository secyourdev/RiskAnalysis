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

<?php include("content/php/atelier3b/selection.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CyberRiskManager">
  <meta name="author" content="SecYourDev">

  <title>CyberRiskManager | Atelier 3.b</title>

  <!-- Fonts-->
  <link href="content/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- CSS -->
  <link href="content/css/bootstrap.css" rel="stylesheet">
  <link href="content/css/main.css" rel="stylesheet">

  <!-- JS -->
  <script src="content/vendor/jquery/jquery.js"></script>
  <script src="content/vendor/jquery-tabledit/jquery.tabledit1.c.js"></script>
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
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier1" aria-expanded="true" aria-controls="Atelier1">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc" />
                <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                  <tspan x="-3.432" y="0">1</tspan>
                </text>
              </g>
            </svg>
          </i>
          <span class="nom_atelier">Cadrage et socle de sécurité</span>
        </a>
        <div id="Atelier1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="atelier-1a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="1.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">1.a</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_1" title="Cadrer l’étude">Cadrer l’étude</span>
            </a>
            <a class="collapse-item" href="atelier-1b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="1.b" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">1.b</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_2" title="Biens primordiaux/support">Biens primordiaux/support</span>
            </a>
            <a class="collapse-item" href="atelier-1c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="1.c" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">1.c</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_3" title="Événements redoutés">Événements redoutés</span>
            </a>
            <a class="collapse-item" href="atelier-1d&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="1.d" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier2" aria-expanded="true" aria-controls="Atelier2">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc" />
                <text class="number_activity_text" data-name="2" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                  <tspan x="-3.432" y="0">2</tspan>
                </text>
              </g>
            </svg>
          </i>
          <span>Source de risque</span>
        </a>
        <div id="Atelier2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="atelier-2a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="2.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">2.a</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_5" title="Identifier les sources de risques et les objectifs">Identifier les sources de risques et les objectifs</span>
            </a>
            <a class="collapse-item" href="atelier-2b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="2.b" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">2.b</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_6" title="Évaluer les couples sources de risque/objectifs visés">Évaluer les couples sources de risque/objectifs visés</span>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier3" aria-expanded="true" aria-controls="Atelier3">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity active" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc" />
                <text class="number_activity_text" data-name="3" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                  <tspan x="-3.432" y="0">3</tspan>
                </text>
              </g>
            </svg>
          </i>
          <span>Scénarios stratégiques</span>
        </a>
        <div id="Atelier3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="atelier-3a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="3.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">3.a</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_7" title="Construire la cartographie des menaces numériques de l'écosystème et sélectionner les parties prenantes critiques">Construire la cartographie des menaces numériques de l'écosystème et sélectionner les parties prenantes critiques</span>
            </a>
            <a class="collapse-item" href="atelier-3b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="3.b" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">3.b</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_8" title="Élaborer des scénarios stratégiques">Élaborer des scénarios stratégiques</span>
            </a>
            <a class="collapse-item" href="atelier-3c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="3.c" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">3.c</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_9" title="Définir des mesures de sécurité sur l’écosystème">Définir des mesures de sécurité sur l’écosystème</span>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier4" aria-expanded="true" aria-controls="Atelier4">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc" />
                <text class="number_activity_text" data-name="4" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                  <tspan x="-3.432" y="0">4</tspan>
                </text>
              </g>
            </svg>
          </i>
          <span>Scénarios opérationnels</span>
        </a>
        <div id="Atelier4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="atelier-4a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="4.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">4.a</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_10" title="Élaborer les scénarios opérationnels">Élaborer les scénarios opérationnels</span>
            </a>
            <a class="collapse-item" href="atelier-4b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="4.b" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">4.b</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_11" title="Évaluer la vraisemblance des scénarios opérationnels">Évaluer la vraisemblance des scénarios opérationnels</span>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier5" aria-expanded="true" aria-controls="Atelier5">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc" />
                <text class="number_activity_text" data-name="5" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                  <tspan x="-3.432" y="0">5</tspan>
                </text>
              </g>
            </svg>
          </i>
          <span>Traitement du risque</span>
        </a>
        <div id="Atelier5" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="atelier-5a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="5.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">5.a</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_12" title="Réaliser une synthèse des scénarios de risque">Réaliser une synthèse des scénarios de risque</span>
            </a>
            <a class="collapse-item" href="atelier-5b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="5.b" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                      <tspan x="-7.5" y="-1.5">5.b</tspan>
                    </text>
                  </g>
                </svg>
              </i>
              <span id="nom_sous_atelier_13" title="Décider de la stratégie de traitement du risque et définir les mesures de sécurité">Décider de la stratégie de traitement du risque et définir les mesures de sécurité</span>
            </a>
            <a class="collapse-item" href="atelier-5c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                  <g transform="translate(-124 -292)">
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                    <text class="number_sub_activity_text" data-name="5.c" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <div id="top_bar_1" class="top_bar_name_1">Fabrication de vacccin</div>
          <div id="top_bar_2" class="top_bar_name_2">Atelier 3</div>
          <div id="top_bar_3" class="top_bar_name_3">Activité 3.b - Élaborer des scénarios stratégiques</div>

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
          <div class="row">
            <!-- Area Card -->
            <div class="col-xl col-lg">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Objectif</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <p>L'objectif de l'atelier 3 est de disposer d'une vision claire de l'écosystème, afin d'en identifier
                    les parties prenantes les plus vulnérables. Il s'agit ensuite de bâtir des scénarios de haut niveau,
                    appelés scénarios stratégiques. Ces derniers sont autant de chemins d'attaque que pourrait emprunter une
                    source de risque pour empruter une source de risque pour atteindre son objectif.
                  </p>
                  <!--text-->
                </div>
              </div>
            </div>
          </div>

          <div class="row">

            <!-- Area Card -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Liste des évènements redoutés établis lors de l'atelier 1</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <!--text-->
                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_evenement_redoute" placeholder="Rechercher">
                    <table id="editable_table" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Valeur métier</th>
                          <th>Nom de l'événement redouté</th>
                          <th>événement redouté</th>
                          <th>Impacts</th>
                          <th>C</th>
                          <th>I</th>
                          <th>D</th>
                          <th>T</th>
                          <th>Gravité</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result_evenement_redoutes)) {
                          echo '
                        <tr>
                        <td>' . $row["id_evenement_redoute"] . '</td>
                        <td>' . $row["nom_valeur_metier"] . '</td>
                        <td>' . $row["nom_evenement_redoute"] . '</td>
                        <td>' . $row["description_evenement_redoute"] . '</td>
                        <td>' . $row["impact"] . '</td>
                        <td>' . $row["confidentialite"] . '</td>
                        <td>' . $row["integrite"] . '</td>
                        <td>' . $row["disponibilite"] . '</td>
                        <td>' . $row["tracabilite"] . '</td>
                        <td>' . $row["niveau_de_gravite"] . '</td>
                        </tr>
                        ';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>

                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0">Liste des couples sources de risques / objectifs visés établis lors de l'atelier 2</h6>

                  </div>

                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_srov" placeholder="Rechercher">
                    <table id="editable_table_SROV" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Type d'attaquant</th>
                          <th>Profile d'attaquant</th>
                          <th>Description source de risque</th>
                          <th>Objectifs visés</th>
                          <th>Description de l'objectif</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result_SROV)) {
                          echo '
                        <tr>
                        <td>' . $row["id_source_de_risque"] . '</td>
                        <td>' . $row["type_d_attaquant_source_de_risque"] . '</td>
                        <td>' . $row["profil_de_l_attaquant_source_de_risque"] . '</td>
                        <td>' . $row["description_source_de_risque"] . '</td>
                        <td>' . $row["objectif_vise"] . '</td>
                        <td>' . $row["description_objectif_vise"] . '</td>

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
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Liste des scénarios stratégiques</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <!--text-->
                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_scenario_strategique" placeholder="Rechercher">
                    <table id="editable_table_scenario_strategique" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nom du scénario strategique</th>
                          <th>Source de risque  objectif visé</th>
                          <th>Nom de l'événement redouté</th>
                          <th>niveau de gravite</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result_scenario_strategique)) {
                          echo '
                        <tr>
                        <td>' . $row["id_scenario_strategique"] . '</td>
                        <td>' . $row["nom_scenario_strategique"] . '</td>
                        <td>' . $row["description_source_de_risque"] . '  ' . $row["objectif_vise"] . '</td>
                        <td>' . $row["nom_evenement_redoute"] . '</td>
                        <td>' . $row["niveau_de_gravite"] . '</td>
                        </tr>
                        ';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- bouton Ajouter une nouvelle ligne -->
                  <div class="text-center">
                    <button type="button" class="btn perso_btn_primary shadow-none btn-bougé" data-toggle="modal" data-target="#ajout_ligne_scenario_strategique">Ajouter une nouvelle ligne</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Area Card -->
            <div class="col-xl col-lg">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Liste des chemin d'attaque</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <!--text-->
                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_chemin_d_attaque" placeholder="Rechercher">
                    <table id="editable_table_chemin_d_attaque" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>ID du risque</th>
                          <th>Chemin d'attaque stratégique</th>
                          <th>nom du scénario stratégique</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result_chemin_d_attaque)) {
                          echo '
                        <tr>
                        <td>' . $row["id_chemin_d_attaque_strategique"] . '</td>
                        <td>' . $row["id_risque"] . '</td>
                        <td>' . $row["nom_chemin_d_attaque_strategique"] . '</td>
                        <td>' . $row["nom_scenario_strategique"] . '</td>
                        </tr>
                        ';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- bouton Ajouter une nouvelle ligne -->
                  <div class="text-center">
                    <button type="button" class="btn perso_btn_primary shadow-none btn-bougé" data-toggle="modal" data-target="#ajout_ligne_chemin_attaque">Ajouter une nouvelle ligne</button>
                  </div>
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

  <!-- -------------------------------------------------------------------------------------------------------------- 
----------------------------------------- modal ajout de ligne ----------------------------------------------------
--------------------------------------------------------------------------------------------------------------- -->
  <div class="modal fade" id="ajout_ligne_scenario_strategique" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajout d'un scénario stratégique</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body perso_modal_body">
          <form method="post" action="content/php/atelier3b/ajout_scenario.php" class="user" id="form_scenario_strategique">
            <fieldset>

              <div class=" form-group col-12">
                <input type="search" class="perso_form shadow-none form-control form-control-user" name="nom_scenario_strategique" id="nom_scenario_strategique" placeholder="Nom du scénario stratégique" required>
              </div>

              <div class="form-group col-12">
                <label for="Select_source_de_risque">ID de la source de risque</label>
                <select class="form-control" name="id_source_de_risque" id="Select_source_de_risque">
                  <option value="" selected>...</option>
                  <?php
                  while ($row = mysqli_fetch_array($result_id_source_de_risque)) //selection.php
                  {
                    echo '
                        <option id="id_source_de_risque" value="' . $row["id_source_de_risque"] . '">' . $row["description_source_de_risque"] . ' | ' . $row["objectif_vise"] . '</option>
                        ';
                  }
                  ?>
                </select>
              </div>

              <div class="form-group col-12">
                <label for="Select_evenement_redoute">ID événement redouté</label>
                <select class="form-control" name="id_evenement_redoute" id="Select_evenement_redoute">
                  <option value="" selected>...</option>
                  <?php
                  while ($row = mysqli_fetch_array($result_id_evenement_redoute)) //selection.php
                  {
                    echo '
                        <option id="id_evenement_redoute" value="' . $row["id_evenement_redoute"] . '">' . $row["nom_evenement_redoute"] . '</option>
                        ';
                  }
                  ?>
                </select>
              </div>


              <!-- bouton Ajouter -->
              <div class="modal-footer perso_middle_modal_footer">
                <input type="submit" name="validerscenario" value="Ajouter" class="btn perso_btn_primary shadow-none"></input>
              </div>
            </fieldset>
          </form>
        </div>


      </div>
    </div>
  </div>


  <!-- -------------------------------------------------------------------------------------------------------------- 
----------------------------------------- modal ajout de ligne ----------------------------------------------------
--------------------------------------------------------------------------------------------------------------- -->
  <div class="modal fade" id="ajout_ligne_chemin_attaque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajout d'un chemin d'attaque stratégique</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body perso_modal_body">
          <form method="post" action="content/php/atelier3b/ajout_chemin.php" class="user" id="form_chemin_attaque">
            <fieldset>

              <div class=" form-group col-12">
                <input type="search" class="perso_form shadow-none form-control form-control-user" name="id_risque" id="id_risque" placeholder="ID du risque" required>
              </div>

              <div class="form-group col-12">
                <label for="Chemin d'attaque stratégique">Chemin d'attaque stratégique</label>
                <textarea class="form-control perso_text_area" name="chemin_d_attaque_strategique" id="chemin_d_attaque_strategique" rows="5"></textarea>
              </div>

              <div class="form-group col-12">
                <label for="Select_nom_scenario_strategique">ID scénario stratégique</label>
                <select class="form-control" name="nom_scenario_strategique" id="Select_nom_scenario_strategique">
                  <option value="" selected>...</option>
                  <?php
                  while ($row = mysqli_fetch_array($result_id_scenario_strategique)) //selection.php
                  {
                    echo '
                        <option id="nom_scenario_strategique" value="' . $row["nom_scenario_strategique"] . '">' . $row["nom_scenario_strategique"] . '</option>
                        ';
                  }
                  ?>
                </select>
              </div>

              <!-- bouton Ajouter -->
              <div class="modal-footer perso_middle_modal_footer">
                <input type="submit" name="validerchemin" value="Ajouter" class="btn perso_btn_primary shadow-none"></input>
              </div>
            </fieldset>
          </form>
        </div>


      </div>
    </div>
  </div>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
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
  <script src="content/js/atelier/atelier3b.js"></script>
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