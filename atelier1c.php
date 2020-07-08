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

<?php include("content/php/atelier1c/selection.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<?php 
if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur'])
{
  if(isset($userdroit['ecriture'])){
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CyberRiskManager">
  <meta name="author" content="SecYourDev">

  <title>CyberRiskManager | Atelier 1.c</title>

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
            <div class="col-xl-12 col-lg-12">
              <!-- Area Card -->
              <!-- Mission -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Echelle</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <!--tableau-->
                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_echelle" placeholder="Rechercher">
                    <table id="editable_table" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th id="id_echelle">ID echelle</th>
                          <th id="nom_echelle">Nom de l'échelle</th>
                          <th id="echelle_gravite">Echelle de la gravité</th>
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
                  <!-- bouton Ajouter une nouvelle ligne -->
                  <div class="text-center">
                    <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_mission">Ajouter une nouvelle ligne</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Area Card -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Niveaux</h6>
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
                            <option value="'.$row["nom_echelle"].'">'.$row["nom_echelle"].'</option>
                            ';
                          }
                      ?>
                    </select>
                  </div>
                  <!--tableau-->
                  <script src="content/js/modules/niveau_echelle.js"></script>
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
                      <?php
                      // while($row = $query->fetch(PDO::FETCH_ASSOC))
                      // {
                      //   echo '
                      //   <tr>
                      //   <td>'.$row["id_niveau"].'</td>
                      //   <td>'.$row["valeur_niveau"].'</td>
                      //   <td>'.$row["description_niveau"].'</td>
                      //   </tr>
                      //   ';
                      // }
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
                <div class="row perso_no_margin">
                  <div class="card-header col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <h6>Événements redoutés</h6>
                  </div>
                  <!-- bouton icon helper -->
                  <!-- <div class="card-header perso_header_right float-right col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <button class="perso_icon_btn custom-control-inline" data-container="body" data-trigger="hover focus" data-toggle="popover" data-placement="bottom" data-content="Ce choix engendre automatiquement le même barème sur vraisemblance ! ">
                      <i class="fas fa-info-circle"></i>
                    </button>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="radio_gravite5" name="radio_gravite" class="custom-control-input" value="5">
                      <label class="custom-control-label" for="radio_gravite5">Gravité sur 5</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="radio_gravite4" name="radio_gravite" class="custom-control-input" value="4">
                      <label class="custom-control-label" for="radio_gravite4">Gravité sur 4</label>
                    </div>
                  </div> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="SelectNaturePop">Choix de l'échelle à utiliser pour le projet</label>
                    <select class="form-control" name="nomechelleprojet" id="nomechelleprojet">
                      <option value="" selected>...</option>
                      <?php
                          while($row = mysqli_fetch_array($resultechelle2))
                          {
                            echo '
                            <option value="'.$row["nom_echelle"].'">'.$row["nom_echelle"].'</option>
                            ';
                          }  
                      ?>
                    </select>
                    <div id="echelle_choisie">
                      Echelle choisie : 
                      <?php 
                        $echelle_projet = mysqli_fetch_array($resultprojet);
                        echo $echelle_projet[0];
                      ?>
                    </div>
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
                          <th id="impact">Impacts</th>
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

                  <!-- bouton Ajouter une nouvelle ligne -->
                  <div class="text-center">
                    <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_evenement_redoute">Ajouter une nouvelle ligne</button>
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
--------------------------------------- modal ajout de mission ----------------------------------------------
--------------------------------------------------------------------------------------------------------------  -->
<div class="modal fade" id="ajout_mission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajout d'une mission</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body perso_modal_body">
          <form method="post" action="content/php/echelle/ajoutechelle.php" class="user" id="formMission">
            <fieldset>
              <div class="form-group">
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

    <!-- -------------------------------------------------------------------------------------------------------------- 
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
                      <input type="text" class="perso_form shadow-none form-control form-control-user" name="nom_evenement_redoute" id="InputEvenementRedoute" placeholder="Dénomination de l'événement redouté" required>
                    </div>

                    <div class="form-group">
                      <label for="Select_valeur_metier">Valeur métier</label>
                      <select class="form-control" name="nom_valeur_metier" id="Select_valeur_metier">
                        <option value="" selected>...</option>
                        <?php
                        while ($row = mysqli_fetch_array($resultvm)) //selection.php
                        {
                          echo '
                        <option value="' . $row['nom_valeur_metier'] . '">' . $row['nom_valeur_metier'] . '</option>
                        ';
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="Description_event_pop">Événement redouté</label>
                      <textarea class="form-control perso_text_area" name="description_evenement_redoute" id="Description_event_pop" rows="3"></textarea>
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
                    <!-- <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck1" name="formcheck[]" value="1">
                      <label class="custom-control-label" for="customCheck1">Confidentialité</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck2" name="formcheck[]" value="2">
                      <label class="custom-control-label" for="customCheck2">Intégrité</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck3" name="formcheck[]" value="3">
                      <label class="custom-control-label" for="customCheck3">Disponibilité</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck4" name="formcheck[]" value="4">
                      <label class="custom-control-label" for="customCheck4">Traçabilité</label>
                    </div> -->

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
                      <label for="Description_impact_pop">Impacts</label>
                      <textarea class="form-control perso_text_area" name="impact" id="Description_impact_pop" rows="3"></textarea>
                    </div>

                    <div class="form-group" id="niveaudegravité">
                      <label for="niveaudegravité">Niveau de gravité</label>
                      <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <?php
                        include("content/php/atelier1c/selectionmaxgravite.php");
                        for ($i = 1; $i <= $nbniveaugravite[0]; $i++) //selection.php
                        {
                          echo '
                        <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="gravite' . $i . '" autocomplete="off" name="niveau_de_gravite" value="' . $i . '"> ' . $i . '
                        </label>';
                        }
                        ?>
                        <!-- <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="gravite1" autocomplete="off" name="niveau_de_gravite" value="1"> 1
                        </label>
                        <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="gravite2" autocomplete="off" name="niveau_de_gravite" value="2"> 2
                        </label>
                        <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="gravite3" autocomplete="off" name="niveau_de_gravite" value="3"> 3
                        </label>
                        <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="gravite4" autocomplete="off" name="niveau_de_gravite" value="4"> 4
                        </label>
                        <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="gravite5" autocomplete="off" name="niveau_de_gravite" value="5"> 5
                        </label> -->
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
    <!-- <script src="content/js/modules/help_button.js"></script> -->
    <!-- <script src="content/js/modules/gravite.js"></script> -->
    <script src="content/js/modules/realtime.js"></script>
    <script src="content/js/modules/set_filter_sort_table.js"></script>
    <script src="content/js/atelier/atelier1c.js"></script>
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