<?php
session_start();

include("content/php/bdd/connexion.php");

if (isset($_GET['id_utilisateur']) and $_GET['id_utilisateur'] > 0) {
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


  <?php include("content/php/atelier3a/selection.php"); ?>
  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CyberRiskManager">
    <meta name="author" content="SecYourDev">

    <title>CyberRiskManager | Atelier 3.a</title>

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

    <!-- CHART.JS -->
    <script src="content\vendor\chart.js\chart.min.js"></script>
  </head>

  <?php
  if (isset($_SESSION['id_utilisateur']) and $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur']) {
    if (isset($userdroit['ecriture'])) {
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
                  <a class="collapse-item" href="atelier-1a&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-1b&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-1c&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-1d&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-2a&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-2b&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-2c&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
                    <i>
                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                        <g transform="translate(-124 -292)">
                          <path class="number_sub_activity" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(124 292)" fill="#394c7a" />
                          <text class="number_sub_activity_text" data-name="2.c" transform="translate(136.5 309.19)" fill="#eaf1eb" font-size="11" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                            <tspan x="-7.5" y="-1.5">2.c</tspan>
                          </text>
                        </g>
                      </svg>
                    </i>
                    <span id="nom_sous_atelier_15" title="Sélectionner les couples SR/OV retenus pour la suite de l'analyse">Sélectionner les couples SR/OV retenus pour la suite de l'analyse</span>
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
                  <a class="collapse-item" href="atelier-3a&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-3b&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-3c&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-4a&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-4b&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-5a&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-5b&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
                  <a class="collapse-item" href="atelier-5c&<?php echo $_SESSION['id_utilisateur']; ?>&<?php echo $_SESSION['id_projet']; ?>">
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
              <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top fixed-top shadow" id="barre_info">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                </button>

                <div id="top_bar_1" class="top_bar_name_1"><?php echo $projectinfo['nom_projet']; ?></div>
                <div id="top_bar_2" class="top_bar_name_2">Atelier 3</div>
                <div id="top_bar_3" class="top_bar_name_3">Activité 3.a - Construire la cartographie des menaces numériques de l'écosystème et sélectionner les parties prenantes critiques</div>

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
                      <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $userinfo['prenom']; ?></span>
                      <img class="img-profile rounded-circle" src="content/img/undraw_profile_pic.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                      <a class="dropdown-item" href="parametres&<?php echo $_SESSION['id_utilisateur']; ?>">
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

                  <!-- Area Card -->
                  <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0">Création des seuils</h6>
                      </div>

                      <!-- Card Body -->
                      <div class="card-body">

                        <form method="post" action="content/php/atelier3a/ajout_seuil.php" class="user" id="formeseuil">
                          <fieldset>
                            <div class="form-group">
                              <label class="titre_input" for="seuil_danger">Seuil de danger</label>
                              <input type="text" class="perso_form shadow-none form-control form-control-user" name="seuil_danger" id="seuil_danger" placeholder="Seuil de danger" required>
                            </div>
                            <div class="form-group">
                              <label class="titre_input" for="seuil_controle">Seuil de contrôle</label>
                              <input type="text" class="perso_form shadow-none form-control form-control-user" name="seuil_controle" id="seuil_controle" placeholder="Seuil de contrôle" required>
                            </div>
                            <div class="form-group">
                              <label class="titre_input" for="seuil_veille">Seuil de veille</label>
                              <input type="text" class="perso_form shadow-none form-control form-control-user" name="seuil_veille" id="seuil_veille" placeholder="Seuil de veille" required>
                            </div>
                            <!-- bouton Ajouter -->
                            <!-- bouton Ajouter une nouvelle ligne -->
                            <div class="text-center">
                              <button type="submit" name="validerseuil" class="btn perso_btn_primary perso_btn_spacing shadow-none">Valider le seuil</button>
                            </div>
                          </fieldset>
                        </form>

                      </div>
                    </div>
                  </div>

                  <!-- Area Card -->
                  <div id="partie_prenante" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0">Ajouter une partie prenante</h6>
                      </div>

                      <!-- Card Body -->
                      <div class="card-body">
                        <!--tableau-->
                        <div class="table-responsive">
                          <input type="text" class="rechercher_input" id="rechercher_evenement_redoute" placeholder="Rechercher">
                          <table id="editable_table" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Catégorie</th>
                                <th>Partie prenante</th>
                                <th>Type</th>
                                <th>Dépendance</th>
                                <th>Facteur de pondération dépendance</th>
                                <th>Pénétration</th>
                                <th>Facteur de pondération pénétration</th>
                                <th>Maturité</th>
                                <th>Facteur de pondération maturité</th>
                                <th>Confiance</th>
                                <th>Facteur de pondération confiance</th>
                                <th>Niveau de menace</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              while ($row = mysqli_fetch_array($result)) {
                                echo '
                        <tr>
                        <td>' . $row["id_partie_prenante"] . '</td>
                        <td>' . $row["categorie_partie_prenante"] . '</td>
                        <td>' . $row["nom_partie_prenante"] . '</td>
                        <td>' . $row["type"] . '</td>
                        <td>' . $row["dependance_partie_prenante"] . '</td>
                        <td>' . $row["ponderation_dependance"] . '</td>
                        <td>' . $row["penetration_partie_prenante"] . '</td>
                        <td>' . $row["ponderation_penetration"] . '</td>
                        <td>' . $row["maturite_partie_prenante"] . '</td>
                        <td>' . $row["ponderation_maturite"] . '</td>
                        <td>' . $row["confiance_partie_prenante"] . '</td>
                        <td>' . $row["ponderation_confiance"] . '</td>
                        <td>' . $row["niveau_de_menace_partie_prenante"] . '</td>
                        </tr>
                        ';
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>

                        <!-- bouton Ajouter une nouvelle ligne -->
                        <div class="text-center">
                          <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_partie_prenante">Ajouter une partie prenante</button>
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
                          <h6>Parties prenantes</h6>
                        </div>
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        <div class="row perso_no_margin">

                          <div class="card-header col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <h6>Parties prenantes internes</h6>
                            <canvas height="450" width="480" id="myChart_interne"></canvas>
                          </div>

                          <div class="card-header col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <h6>Parties prenantes externes</h6>
                            <canvas height="450" width="480" id="myChart_externe"></canvas>
                          </div>


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
          <!-- -------------------------------------------------------------------------------------------------------------- 
----------------------------------------- modal ajout de ligne ----------------------------------------------------
--------------------------------------------------------------------------------------------------------------- -->
          <div class="modal fade" id="ajout_partie_prenante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ajout d'une partie prenante</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body perso_modal_body">
                  <form method="post" action="content/php/atelier3a/ajout.php" class="user" id="formecartPop">
                    <fieldset>
                      <div class="row">
                        <div class="col-12">

                          <div class="form-group">
                            <input type="texte" class="perso_arrow perso_form shadow-none form-control" list="categorie_pop" name="categorie_partie_prenante" placeholder="Catégorie" required>
                            <datalist id="categorie_pop">
                              <?php
                              while ($row = mysqli_fetch_array($result_categorie_partie_prenante)) {
                                echo '
                        <option value="' . $row["categorie_partie_prenante"] . '">' . $row["categorie_partie_prenante"] . '</option>
                        ';
                              }
                              ?>
                            </datalist>
                          </div>

                          <div class="form-group">
                            <label for="SelectType">Type</label>
                            <select class="form-control" name="type" id="SelectType">
                              <option value="" selected>...</option>
                              <option value="Interne">Interne</option>
                              <option value="Externe">Externe</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <input type="text" class="perso_form shadow-none form-control form-control-user" name="nom_partie_prenante" id="Nom de la partie prenante" placeholder="Nom de la partie prenante" required>
                          </div>

                        </div>
                      </div>
                      <div class="row">
                        <div class=" col-6">
                          <div class="choix-valeur">
                            <div>Dépendance</div>
                            <div class="btn-group btn-group-toggle form-group" data-toggle="buttons">
                              <?php
                              for ($i = 1; $i <= 4; $i++) //selection.php
                              {
                                echo '
                        <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="dependance' . $i . '" autocomplete="off" name="dependance_partie_prenante" value="' . $i . '"> ' . $i . '
                        </label>';
                              }
                              ?>
                            </div>
                          </div>


                          <div class="choix-valeur">
                            <div>Pénétration</div>
                            <div class="btn-group btn-group-toggle form-group" data-toggle="buttons">
                              <?php
                              for ($i = 1; $i <= 4; $i++) //selection.php
                              {
                                echo '
                        <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="penetration' . $i . '" autocomplete="off" name="penetration_partie_prenante" value="' . $i . '"> ' . $i . '
                        </label>';
                              }
                              ?>
                            </div>
                          </div>

                        </div>
                        <div class=" col-6">

                          <div class="choix-valeur">
                            <div>Maturité</div>
                            <div class="btn-group btn-group-toggle form-group" data-toggle="buttons">
                              <?php
                              for ($i = 1; $i <= 4; $i++) //selection.php
                              {
                                echo '
                        <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="maturite' . $i . '" autocomplete="off" name="maturite_partie_prenante" value="' . $i . '"> ' . $i . '
                        </label>';
                              }
                              ?>
                            </div>
                          </div>

                          <div class="choix-valeur">
                            <div>Confiance</div>
                            <div class="btn-group btn-group-toggle form-group" data-toggle="buttons">
                              <?php
                              for ($i = 1; $i <= 4; $i++) //selection.php
                              {
                                echo '
                        <label class="btn perso_checkbox shadow-none">
                          <input type="radio" id="confiance' . $i . '" autocomplete="off" name="confiance_partie_prenante" value="' . $i . '"> ' . $i . '
                        </label>';
                              }
                              ?>
                            </div>
                          </div>

                        </div>
                      </div>
                      <!-- bouton Ajouter -->
                      <div class="modal-footer perso_middle_modal_footer">
                        <input type="submit" name="validerpartie" value="Ajouter" class="btn perso_btn_primary shadow-none"></input>
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
          <script src="content/js/atelier/atelier3a.js"></script>
          <script src="content/js/modules/sort_table.js"></script>
          <script src="content/js/modules/3a_carto.js"></script>
      </body>
  <?php
    }
  } else {
    header('Location: connexion');
  }
  ?>

  </html>
<?php
} else {
  header('Location: connexion');
}
?>