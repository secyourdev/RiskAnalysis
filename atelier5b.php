<?php
session_start();

//Connexion à la base de donnee
try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v14;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
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

    $getidproject = intval($_GET['id_projet']);
    $reqproject = $bdd->prepare('SELECT nom_projet FROM projet WHERE id_projet = ?');
    $reqproject->execute(array($getidproject));
    $projectinfo = $reqproject->fetch();

    $reqdroit = $bdd->prepare('SELECT * FROM RACI WHERE id_utilisateur = ? AND id_projet = ? AND id_atelier="1.a"');
    $reqdroit->bindParam(1, $getid);
    $reqdroit->bindParam(2, $getidproject);
    $reqdroit->execute();
    $userdroit = $reqdroit->fetch();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CyberRiskManager">
  <meta name="author" content="SecYourDev">

  <title>CyberRiskManager | Atelier 5.b</title>

  <!-- Fonts-->
  <link href="content/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="content/css/bootstrap.css" rel="stylesheet">
  <link href="content/css/main.css" rel="stylesheet">
</head>

<?php 
if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur'])
{
  if(isset($userdroit['ecriture'])){
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier1" aria-expanded="true"
          aria-controls="Atelier1">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc"/>
                <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-3.432" y="0">1</tspan></text>
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
                  <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                  <text class="number_sub_activity_text" data-name="1.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">1.a</tspan></text>
                </g>
              </svg>
              </i>
              <span id="nom_sous_atelier_1" title="Cadrer l’étude">Cadrer l’étude</span>
            </a>
            <a class="collapse-item" href="atelier-1b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
            <a class="collapse-item" href="atelier-1c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
            <a class="collapse-item" href="atelier-1d&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
            <a class="collapse-item" href="atelier-2a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
            <a class="collapse-item" href="atelier-2b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
              <a class="collapse-item" href="atelier-3a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
              <a class="collapse-item" href="atelier-3b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
              <a class="collapse-item" href="atelier-3c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
              <a class="collapse-item" href="atelier-4a&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
              <a class="collapse-item" href="atelier-4b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Atelier5" aria-expanded="true"
          aria-controls="Atelier5">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
              <g transform="translate(-1230 -689)">
                <path class="number_activity active" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc"/>
                <text class="number_activity_text" data-name="5" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-3.432" y="0">5</tspan></text>
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
                    <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a"/>
                    <text class="number_sub_activity_text" data-name="5.a" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700"><tspan x="-7.5" y="-1.5">5.a</tspan></text>
                  </g>
                </svg>
                </i>
                <span id="nom_sous_atelier_12" title="Réaliser une synthèse des scénarios de risque">Réaliser une synthèse des scénarios de risque</span>
              </a>
              <a class="collapse-item" href="atelier-5b&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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
              <a class="collapse-item" href="atelier-5c&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
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

          <div id="top_bar_1" class="top_bar_name_1"><?php echo $projectinfo['nom_projet'];?></div>
          <div id="top_bar_2" class="top_bar_name_2">Atelier 5</div>
          <div id="top_bar_3" class="top_bar_name_3">Activité 5.b - Décider de la stratégie de traitement du risque et définir les mesures de sécurité</div>
          
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
                  <p>Le but de cet atelier est de réaliser une synthèse des scénarios de risque identifiés et de défnir
                      une stratégie de traitement de risque. Cette stratégie aboutit à la définition de mesures de 
                      sécurité, recensées dans un plan d'amélioration continuee de la sécurité (PACS). Les risques résiduels sont ensuite
                      identifiés ainsi que le cadre de suivi de ces risques.
                  </p>
                  <!--text-->
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- Area Card -->
            <div class="col-xl col-lg">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Cartographie du risque initial</h6>
                  

              



                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <!--text-->
                  <div class="table-responsive">
                    <table class="table table-bordered perso_border" id="dataTable" width="100%" cellspacing="0">
                 
                      <tbody>
                        <tr>
                          <td class="perso_border texte-droite">Gravité</td>
                          <td class="perso_border"></td>
                          <td class="perso_border"></td>
                          <td class="perso_border"></td>
                          <td class="perso_border"></td>
                          <td class="perso_border"></td>
                            
                        </tr>
                        <tr>
                            <td class="perso_border texte-droite">4</td>
                            <td class="fond-orange">R5</td>
                            <td class="fond-orange">R4</td>
                            <td class="fond-rouge"></td>
                            <td class="fond-rouge"></td>
                            <td class="perso_border"></td>
                        </tr>
                        <tr>
                            <td class="perso_border texte-droite">3</td>
                            <td class="fond-vert"></td>
                            <td class="fond-orange">R2</td>
                            <td class="fond-rouge">R1</td>
                            <td class="fond-rouge">R3</td>
                            <td class="perso_border"></td>
                        </tr>
                        <tr>
                            <td class="perso_border texte-droite">2</td>
                            <td class="fond-vert"></td>
                            <td class="fond-vert"></td>
                            <td class="fond-orange"></td>
                            <td class="fond-rouge"></td>
                            <td class="perso_border"></td>
                        </tr>
                        <tr>
                            <td class="perso_border texte-droite">1</td>
                            <td class="fond-vert"></td>
                            <td class="fond-vert"></td>
                            <td class="fond-orange"></td>
                            <td class="fond-orange"></td>
                            <td class="perso_border"></td>
                        </tr>
                        <tr>
                            <td class="perso_border"></td>
                            <td class="perso_border">1</td>
                            <td class="perso_border">2</td>
                            <td class="perso_border">3</td>
                            <td class="perso_border">4</td>
                            <td class="perso_border texte-gauche">Vraisemblance</td>
                        </tr>
                        

                      </tbody>
                    </table>  
                  </div>    
                  
                  <h6 class="m-0">Scénarios de risque</h6>
                  <div class="card-body">
                      R1 : Un concurrent vole des informations de R&D grâce à une canal d'exfiltration <br>
                      R2 : Un concurrent vole des informations de R&D en exfiltrant celles détenues par le laboratoire <br>
                      R3 : Un concurrent vole des informations de R&D grâce à un canal d'exfiltration via le prestataire informatique <br>
                      R4 : Un hacktiviste provoque un arret de la production des vaccins en compromettant l'équipement de maintenance du fournisseur de matériel <br>
                      R5 : Un hacktiviste perturbe la distribution de vaccins en modifiant leur étiquetage <br>
                  </div>
                  <!-- bouton Ajouter une nouvelle ligne -->
                  <div class="text-center">
                    <button type="button" class="btn perso_btn_primary shadow-none btn-bougé" data-toggle="modal" data-target="#barème">Ajouter une nouvelle ligne</button>
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
<div class="modal fade" id="barème" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Gestion du barème de la stratégie de traitement de risque</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body popup-tableau">
      <form class="user" id="formbarème">
        <div class="texte-vraisemblance centre-vraisemblance">Veuillez cliquer sur une case pour modifier le barème</div>
        
        <div class="table-responsive">
          <table class="table table-bordered perso_border" id="dataTable" width="100%" cellspacing="0">
       
            <tbody>
              <tr>
                <td class="perso_border texte-droite">Gravité</td>
                <td class="perso_border"></td>
                <td class="perso_border"></td>
                <td class="perso_border"></td>
                <td class="perso_border"></td>
                <td class="perso_border"></td>
                  
              </tr>
              <tr>
                  <td class="perso_border texte-droite">4</td>
                  <td class="fond-orange">R5</td>
                  <td class="fond-orange">R4</td>
                  <td class="fond-rouge"></td>
                  <td class="fond-rouge"></td>
                  <td class="perso_border"></td>
              </tr>
              <tr>
                  <td class="perso_border texte-droite">3</td>
                  <td class="fond-vert"></td>
                  <td class="fond-orange">R2</td>
                  <td class="fond-rouge">R1</td>
                  <td class="fond-rouge">R3</td>
                  <td class="perso_border"></td>
              </tr>
              <tr>
                  <td class="perso_border texte-droite">2</td>
                  <td class="fond-vert"></td>
                  <td class="fond-vert"></td>
                  <td class="fond-orange"></td>
                  <td class="fond-rouge"></td>
                  <td class="perso_border"></td>
              </tr>
              <tr>
                  <td class="perso_border texte-droite">1</td>
                  <td class="fond-vert"></td>
                  <td class="fond-vert"></td>
                  <td class="fond-orange"></td>
                  <td class="fond-orange"></td>
                  <td class="perso_border"></td>
              </tr>
              <tr>
                  <td class="perso_border"></td>
                  <td class="perso_border">1</td>
                  <td class="perso_border">2</td>
                  <td class="perso_border">3</td>
                  <td class="perso_border">4</td>
                  <td class="perso_border texte-gauche">Vraisemblance</td>
              </tr>
              

            </tbody>
          </table>  
        </div>
      </div>
      <!-- bouton Valider -->
      <div class="modal-footer perso_middle_modal_footer">
        <button type="button" class="btn perso_btn_primary shadow-none">Valider</button>
      </div>
    </form>
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
  <script src="content/vendor/jquery/jquery.min.js"></script>
  <script src="content/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="content/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="content/js/bootstrap.js"></script>

  <!-- Page level plugins -->
  <script src="content/vendor/datatables/jquery.dataTables.js"></script>
  <script src="content/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Page level custom scripts -->
  <script src="content/js/modules/tableau/tableau-atelier5b.js"></script>

  <!-- Our JS -->
  <script src="content/js/modules/dark_mode.js"></script>
  <script src="content/js/modules/top_bar.js"></script>
  <script src="content/js/modules/side_bar.js"></script>
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
