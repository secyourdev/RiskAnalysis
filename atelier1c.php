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

    $reqdroit = $bdd->prepare('SELECT * FROM H_RACI WHERE id_utilisateur = ? AND id_projet = ? AND id_atelier="1.c"');
    $reqdroit->bindParam(1, $getid);
    $reqdroit->bindParam(2, $getidproject);
    $reqdroit->execute();
    $userdroit = $reqdroit->fetch();

    $reqdroit_chef_de_projet = $bdd->prepare('SELECT id_utilisateur FROM F_projet WHERE id_projet = ?');
    $reqdroit_chef_de_projet->bindParam(1, $getidproject);
    $reqdroit_chef_de_projet->execute();
    $userdroit_chef_de_projet = $reqdroit_chef_de_projet->fetch();
?>

<?php include("content/php/atelier1c/selection.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CyberRiskManager">
  <meta name="author" content="SecYourDev">

  <title>CyberRiskManager | Atelier 1.c</title>

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

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark fixed-top accordion side_bar_scroll" id="accordionSidebar">
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
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
          <a class="nav-link" href="mode_expert&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
              <i class="fas fa-fw fa-tasks"></i>
              <span>Mode expert</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">Ateliers</div>

      <!-- Nav Item - Charts -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier1" aria-expanded="true" aria-controls="Atelier1">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity active" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc" />
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier3" aria-expanded="true" aria-controls="Atelier3">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc" />
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

    <!-- Right Sidebar -->
    <ul id=menu>
      <li>
          <a class="nav-link collapse-right-item menu_float" href="#echelle">
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
              <span class="nom_sous_menu">Echelle</span>
          </a>
      </li>
      <li>
          <a class="nav-link collapse-right-item menu_float" href="#niveau">
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
              <span class="nom_sous_menu">Niveau</span>
          </a>
      </li>
      <li>
          <a class="nav-link collapse-right-item menu_float" href="#evenements_redoutes">
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
              <span class="nom_sous_menu">Événements redoutés</span>
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
          <div id="top_bar_3" class="top_bar_name_3">Activité 1.c - Événements redoutés</div>

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
            <!-- Objectif -->
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
            <div id="echelle" class="col-xl-12 col-lg-12">
              <!-- Area Card -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="row perso_no_margin">
                    <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <h6 class="m-0">Echelle</h6>
                    </div>
                    <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      <a class="download_table_button" id="button_download_echelle">
                        <i class="fas fa-download fa-lg text-gray-400"></i>
                      </a>
                    </div>    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <!--tableau-->
                  <div class="table-responsive">
                    <label>L'échelle Standard est : 5 pour la Gravité et 5 pour la Vraisemblance. </label></br>
                    <input type="text" class="rechercher_input" id="rechercher_echelle" placeholder="Rechercher">
                    <table id="editable_table" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>ID echelle</th>
                          <th>Nom de l'échelle</th>
                          <th>Echelle de la gravité</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      while($row = mysqli_fetch_array($result1))
                      {
                        echo '
                        <tr>
                        <td>'.$row["id_echelle"].'</td>
                        <td>'.$row["nom_echelle"].'</td>
                        <td>'.$row["echelle_gravite"].'</td>
                        </tr>
                        ';
                      }
                      ?>
                      </tbody>
                    </table>
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
                  
                  <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){ 
                  ?> 
                          <!-- bouton Ajouter une nouvelle ligne -->
                          <div class="text-center">
                            <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_echelle">Ajouter une nouvelle échelle de gravité</button>
                          </div>
                  <?php
                        }
                        else if (isset($userdroit['ecriture'])){
                            if($userdroit['ecriture']=='Réalisation'){
                  ?>        
                          <!-- bouton Ajouter une nouvelle ligne -->
                          <div class="text-center">
                            <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_echelle">Ajouter une nouvelle échelle de gravité</button>
                          </div>
                  <?php
                            }
                        }                          
                  ?>
                </div>
              </div>
            </div>

            <!-- Area Card -->
            <div id="niveau" class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="row perso_no_margin">
                    <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <h6 class="m-0">Niveau</h6>
                    </div>
                    <!-- <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      <a class="download_table_button" id="button_download_niveau">
                        <i class="fas fa-download fa-lg text-gray-400"></i>
                      </a>
                    </div>     -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="SelectNaturePop">Echelles</label>
                    <select class="form-control" name="nomechelle" id="nomechelle">
                      <option value="" selected>...</option>
                      <?php
                          while($row = mysqli_fetch_array($resultechelle))
                          {
                            echo '
                            <option value="'.$row["id_echelle"].'">'.$row["nom_echelle"].'</option>
                            ';
                          }
                      ?>
                    </select>
                  </div>
                  <!--tableau-->
                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_niveau" placeholder="Rechercher">
                    <table id="tableau_niveau" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th id="id_niveau">ID niveau</th>
                          <th id="valeur_niveau">Valeur du niveau</th>
                          <th id="description_niveau">Description du niveau</th>
                        </tr>
                      </thead>
                      
                      <tbody id="ecrire_niveau">
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
            <div id="evenements_redoutes" class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="row perso_no_margin">
                    <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <h6 class="m-0">Événements redoutés</h6>
                    </div>
                    <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      <a class="download_table_button" id="button_download_evenements_redoutes">
                        <i class="fas fa-download fa-lg text-gray-400"></i>
                      </a>
                    </div>    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="nomechelleprojet">Choix de l'échelle à utiliser pour le projet :</label>
                    <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){ 
                    ?> 
                      <select class="form-control" name="nomechelleprojet" id="nomechelleprojet">
                        <option value="" selected>...</option>
                        <?php
                            while($row = mysqli_fetch_array($resultechelle2))
                            {
                              echo '
                              <option value="'.$row["id_echelle"].'">'.$row["nom_echelle"].'</option>
                              ';
                            }  
                        ?>
                      </select>
                    <?php
                        }
                        else if (isset($userdroit['ecriture'])){
                            if($userdroit['ecriture']=='Réalisation'){
                    ?>        
                      <select class="form-control" name="nomechelleprojet" id="nomechelleprojet">
                        <option value="" selected>...</option>
                        <?php
                            while($row = mysqli_fetch_array($resultechelle2))
                            {
                              echo '
                              <option value="'.$row["id_echelle"].'">'.$row["nom_echelle"].'</option>
                              ';
                            }  
                        ?>
                      </select>
                    <?php
                            }
                            else{                         
                    ?>
                      <label name="nomechelleprojet" id="nomechelleprojet"></label>
                    <?php
                            }
                          }                    
                    ?>
                  </div>
                  <script src="content/js/modules/echelle_projet.js"></script>
                  <!--tableau-->
                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_er" placeholder="Rechercher">
                    <table id="tableau_er" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th id="id_evenement_redoutes">ID</th>
                          <th id="nom_valeur_metier">Valeur métier</th>
                          <th id="nom_evenement_redoutes">Nom de l'événement redouté</th>
                          <th id="description_evenement_redoutes">Description événement redouté</th>
                          <th id="impacts">Impacts</th>
                          <th id="confidentialite">Confidentialité</th>
                          <th id="integrite">Integrité</th>
                          <th id="disponibilite">Disponibilité</th>
                          <th id="tracabilite">Traçabilité</th>
                          <th id="niveau_de_gravite">Gravité</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
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

                  <div class='message_success'>
                  <?php 
                      if(isset($_SESSION['message_success_3'])){
                        echo $_SESSION['message_success_3'];
                        unset($_SESSION['message_success_3']);
                      }
                  ?>
                  </div> 
                  <div class='message_error'>
                  <?php                
                      if(isset($_SESSION['message_error_3'])){
                          echo $_SESSION['message_error_3'];
                          unset($_SESSION['message_error_3']);
                      }
                  ?>
                  </div>
                  
                  <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){ 
                  ?>
                          <!-- bouton Ajouter une nouvelle ligne -->
                          <div class="text-center">
                            <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_evenement_redoute">Ajouter un nouvel énénement redouté</button>
                          </div>
                  <?php
                        }
                        else if (isset($userdroit['ecriture'])){
                            if($userdroit['ecriture']=='Réalisation'){
                  ?>    
                              <!-- bouton Ajouter une nouvelle ligne -->
                              <div class="text-center">
                                <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_evenement_redoute">Ajouter un nouvel énénement redouté</button>
                              </div>
                  <?php
                            }
                        }                          
                  ?>
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

<?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid||(isset($userdroit['ecriture'])&&$userdroit['ecriture']=='Réalisation')){ 
?> 
<!---------------------------------------------------------------------------------------------------------------- 
--------------------------------------------- modal ajout d'échelle ----------------------------------------------
--------------------------------------------------------------------------------------------------------------+--->
<div class="modal fade" id="ajout_echelle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajout d'une échelle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body perso_modal_body">
          <form method="post" action="content/php/echelle/ajoutechelle.php" class="user" id="formMission">
            <fieldset>
              <div class="form-group">
                <label class="titre_input" for="nom_echelle">Nom de l'échelle</label>
                <input type="text" class="perso_form shadow-none form-control form-control-user" name ="nom_echelle" id="nom_echelle"
                  placeholder="Nom de l'échelle" required>
              </div>

              <div class="form-group">
                <label for="SelectNaturePop">Valeur gravité</label>
                <select class="form-control" name="echelle_gravite" id="echelle_gravite">
                  <option value="" selected>...</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>

              <!-- bouton Ajouter -->
              <div class="modal-footer perso_middle_modal_footer">
                <input type="submit" name="validerechelle" value="Ajouter" class="btn perso_btn shadow-none"></input>
              </div>
            </fieldset>
            
          
          </form>
        </div>
        
        
      </div>
    </div>
  </div>

<!---------------------------------------------------------------------------------------------------------------- 
--------------------------------------- modal ajout Événement redouté ----------------------------------------------
--------------------------------------------------------------------------------------------------------------  -->
    <div class="modal fade" id="ajout_evenement_redoute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajout d'un événement redouté</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body perso_modal_body">
            <form method="post" action="content/php/atelier1c/ajout.php" class="user" id="formValeurMetierPop">
              <fieldset>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                    <label class="titre_input" for="nom_evenement_redoute">Dénomination de l'événement redouté</label>
                      <input type="text" class="perso_form shadow-none form-control form-control-user" name="nom_evenement_redoute" id="nom_evenement_redoute" placeholder="Dénomination de l'événement redouté" required>
                    </div>

                    <div class="form-group">
                      <label for="Select_valeur_metier">Valeur métier</label>
                      <select class="form-control" name="nom_valeur_metier" id="Select_valeur_metier">
                        <option value="" selected>...</option>
                        <?php
                        while ($row = mysqli_fetch_array($resultvm)) //selection.php
                        {
                          echo '
                        <option value="' . $row['id_valeur_metier'] . '">' . $row['nom_valeur_metier'] . '</option>
                        ';
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="description_evenement_redoute">Événement redouté</label>
                      <textarea class="form-control perso_text_area" name="description_evenement_redoute" id="description_evenement_redoute" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="Select_valeur_metier">Confidentialité</label>
                      <select class="form-control" name="confidentialite" id="confidentialite">
                        <option value="" selected>...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="Select_valeur_metier">Intégrité</label>
                      <select class="form-control" name="integrite" id="integrite">
                        <option value="" selected>...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                      <label for="Select_valeur_metier">Disponibilité</label>
                      <select class="form-control" name="disponibilite" id="disponibilite">
                        <option value="" selected>...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="Select_valeur_metier">Traçabilité</label>
                      <select class="form-control" name="tracabilite" id="tracabilite">
                        <option value="" selected>...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="impact">Impacts</label>
                      <textarea class="form-control perso_text_area" name="impact" id="impact" rows="3"></textarea>
                    </div>

                    <div class="form-group" id="niveaudegravité">
                      <label for="niveaudegravité">Niveau de gravité</label>
                      <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <?php
                        include("content/php/atelier1c/selectionmaxgravite.php");
                        for ($i = 1; $i <= $nbniveaugravite[0]; $i++)
                        {
                          echo '
                        <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="gravite' . $i . '" autocomplete="off" name="niveau_de_gravite" value="' . $i . '"> ' . $i . '
                        </label>';
                        }
                        ?>
                      </div>
                    </div>

                  </div>
                </div>
                <!-- bouton Ajouter -->
                <div class="modal-footer perso_middle_modal_footer">
                  <input type="submit" name="validerevenementredoute" value="Ajouter" class="btn perso_btn_primary shadow-none"></input>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php
}
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
    <script src="content/js/modules/export_table_to_excel.js"></script>
    <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){    
    ?>
        <script src="content/js/modules/niveau_echelle.js"></script>
        <script src="content/js/atelier/atelier1c.js"></script>
    <?php
        }
        else if(isset($userdroit['ecriture'])){
            if($userdroit['ecriture']=='Réalisation'){
    ?>
                <script src="content/js/modules/niveau_echelle.js"></script>
                <script src="content/js/atelier/atelier1c.js"></script>
    <?php 
            }
            else{
    ?>
                <script src="content/js/modules/niveau_echelle_no_modification.js"></script>
                <script src="content/js/atelier/atelier1c_no_modification.js"></script>
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