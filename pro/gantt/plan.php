<?php
session_start();

include("../../content/php/bdd/connexion.php");

if (isset($_GET['id_utilisateur']) and $_GET['id_utilisateur'] > 0) {
  $getid = intval($_GET['id_utilisateur']);
  $requser = $bdd->prepare('SELECT * FROM A_utilisateur WHERE id_utilisateur = ?');
  $requser->execute(array($getid));
  $userinfo = $requser->fetch();

  $getidproject = intval($_GET['id_projet']);
  $reqproject = $bdd->prepare('SELECT nom_projet FROM F_projet WHERE id_projet = ?');
  $reqproject->execute(array($getidproject));
  $projectinfo = $reqproject->fetch();

  $reqdroit = $bdd->prepare('SELECT * FROM H_RACI WHERE id_utilisateur = ? AND id_projet = ?');
  $reqdroit->bindParam(1, $getid);
  $reqdroit->bindParam(2, $getidproject);
  $reqdroit->execute();
  $userdroit = $reqdroit->fetch();

  $reqdroit_chef_de_projet = $bdd->prepare('SELECT id_utilisateur FROM F_projet WHERE id_projet = ?');
  $reqdroit_chef_de_projet->bindParam(1, $getidproject);
  $reqdroit_chef_de_projet->execute();
  $userdroit_chef_de_projet = $reqdroit_chef_de_projet->fetch();
?>

  <!--?php include("../../content/php/mode_expert/selection.php"); ?-->
  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CyberRiskManager">
    <meta name="author" content="SecYourDev">

    <title>CyberRiskManager | Mode expert</title>

    <!-- Gannt -->
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <link rel=stylesheet href="pro/gantt/platform.css" type="text/css">
    <link rel=stylesheet href="pro/gantt/libs/jquery/dateField/jquery.dateField.css" type="text/css">

    <link rel=stylesheet href="pro/gantt/gantt.css" type="text/css">
    <link rel=stylesheet href="pro/gantt/ganttPrint.css" type="text/css" media="print">
    <link rel=stylesheet href="pro/gantt/libs/jquery/valueSlider/mb.slider.css" type="text/css" media="print">


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
  

    <!-- Gannt -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="pro/gantt/libs/jquery/jquery.livequery.1.1.1.min.js"></script>
    <script src="pro/gantt/libs/jquery/jquery.timers.js"></script>

    <script src="pro/gantt/libs/utilities.js"></script>
    <script src="pro/gantt/libs/forms.js"></script>
    <script src="pro/gantt/libs/date.js"></script>
    <script src="pro/gantt/libs/dialogs.js"></script>
    <script src="pro/gantt/libs/layout.js"></script>
    <script src="pro/gantt/libs/i18nJs.js"></script>
    <script src="pro/gantt/libs/jquery/dateField/jquery.dateField.js"></script>
    <script src="pro/gantt/libs/jquery/JST/jquery.JST.js"></script>
    <script src="pro/gantt/libs/jquery/valueSlider/jquery.mb.slider.js"></script>

    <script type="text/javascript" src="pro/gantt/libs/jquery/svg/jquery.svg.min.js"></script>
    <script type="text/javascript" src="pro/gantt/libs/jquery/svg/jquery.svgdom.1.8.js"></script>


    <script src="pro/gantt/ganttUtilities.js"></script>
    <script src="pro/gantt/ganttTask.js"></script>
    <script src="pro/gantt/ganttDrawerSVG.js"></script>
    <script src="pro/gantt/ganttZoom.js"></script>
    <script src="pro/gantt/ganttGridEditor.js"></script>
    <script src="pro/gantt/ganttMaster.js"></script>  

  
  </head>

  <?php
  if (isset($_SESSION['id_utilisateur']) and $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur']) {
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
            <li class="nav-item active">
                <a class="nav-link" href="mode_expert&<?php echo $_SESSION['id_utilisateur'];?>&<?php echo $_SESSION['id_projet'];?>">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Mode expert</span></a>
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

                <div id="top_bar_1" class="top_bar_name_1"><?php echo $projectinfo['nom_projet'];?></div>
                <div id="top_bar_2" class="top_bar_name_2">Planification</div>
                <div id="top_bar_3" class="top_bar_name_3">Gantt</div>

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
                   <div id="workSpace" style="padding:0px; overflow-y:auto; overflow-x:hidden;border:1px solid #e5e5e5;position:relative;margin:0 5px"></div>

                    <style>
      .resEdit {
        padding: 15px;
      }

      .resLine {
        width: 95%;
        padding: 3px;
        margin: 5px;
        border: 1px solid #d0d0d0;
      }

      body {
        overflow: hidden;
      }

      .ganttButtonBar h1{
        color: #030030;
        font-weight: bold;
        font-size: 28px;
        margin-left: 10px;
      }

    </style>

  <form id="gimmeBack" style="display:none;" action="../gimmeBack.jsp" method="post" target="_blank"><input type="hidden" name="prj" id="gimBaPrj"></form>

  <script type="text/javascript">

  var ge;
  $(function() {
    var canWrite=true; //this is the default for test purposes

    // here starts gantt initialization
    ge = new GanttMaster();
    ge.set100OnClose=true;

    ge.shrinkParent=true;

    ge.init($("#workSpace"));
    loadI18n(); //overwrite with localized ones

    //in order to force compute the best-fitting zoom level
    delete ge.gantt.zoom;

    var project=loadFromLocalStorage();

    if (!project.canWrite)
      $(".ganttButtonBar button.requireWrite").attr("disabled","true");

    ge.loadProject(project);
    ge.checkpoint(); //empty the undo stack

    initializeHistoryManagement(ge.tasks[0].id);
  });



  function getDemoProject(){
    //console.debug("getDemoProject")
  ret= {"tasks":    [
        {"id": -1, "name": "Gantt editor", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 0, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": 1396994400000, "duration": 20, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
        {"id": -2, "name": "coding", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 1, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": 1396994400000, "duration": 10, "end": 1398203999999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
        {"id": -3, "name": "gantt part", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": 1396994400000, "duration": 2, "end": 1397167199999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
        {"id": -4, "name": "editor part", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "3", "canWrite": true, "start": 1397167200000, "duration": 4, "end": 1397685599999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
        {"id": -5, "name": "testing", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 1, "status": "STATUS_SUSPENDED", "depends": "2:5", "canWrite": true, "start": 1398981600000, "duration": 5, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
        {"id": -6, "name": "test on safari", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "", "canWrite": true, "start": 1398981600000, "duration": 2, "end": 1399327199999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
        {"id": -7, "name": "test on ie", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "6", "canWrite": true, "start": 1399327200000, "duration": 3, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
        {"id": -8, "name": "test on chrome", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "6", "canWrite": true, "start": 1399327200000, "duration": 2, "end": 1399499999999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false}
      ], "selectedRow": 2, "deletedTaskIds": [],
        "resources": [
        {"id": "tmp_1", "name": "Resource 1"},
        {"id": "tmp_2", "name": "Resource 2"},
        {"id": "tmp_3", "name": "Resource 3"},
        {"id": "tmp_4", "name": "Resource 4"}
      ],
        "roles":       [
        {"id": "tmp_1", "name": "Project Manager"},
        {"id": "tmp_2", "name": "Worker"},
        {"id": "tmp_3", "name": "Stakeholder"},
        {"id": "tmp_4", "name": "Customer"}
      ], "canWrite":    true, "canDelete":true, "canWriteOnParent": true, canAdd:true}


      //actualize data
      var offset=new Date().getTime()-ret.tasks[0].start;
      for (var i=0;i<ret.tasks.length;i++) {
        ret.tasks[i].start = ret.tasks[i].start + offset;
      }
    return ret;
  }



  function loadGanttFromServer(taskId, callback) {

    //this is a simulation: load data from the local storage if you have already played with the demo or a textarea with starting demo data
    var ret=loadFromLocalStorage();

    //this is the real implementation
    /*
    //var taskId = $("#taskSelector").val();
    var prof = new Profiler("loadServerSide");
    prof.reset();

    $.getJSON("ganttAjaxController.jsp", {CM:"LOADPROJECT",taskId:taskId}, function(response) {
      //console.debug(response);
      if (response.ok) {
        prof.stop();

        ge.loadProject(response.project);
        ge.checkpoint(); //empty the undo stack

        if (typeof(callback)=="function") {
          callback(response);
        }
      } else {
        jsonErrorHandling(response);
      }
    });
    */

    return ret;
  }

  function upload(uploadedFile) {
    var fileread = new FileReader();
    
    fileread.onload = function(e) {
      var content = e.target.result;
      var intern = JSON.parse(content); // Array of Objects.
      //console.log(intern); // You can index every object
      
      ge.loadProject(intern);
      ge.checkpoint(); //empty the undo stack

    };

    fileread.readAsText(uploadedFile);
  }

  function saveGanttOnServer() {

    //this is a simulation: save data to the local storage or to the textarea
    //saveInLocalStorage();

    var prj = ge.saveProject();

    download(JSON.stringify(prj, null, '\t'), "MyProject.json", "application/json");

    /*

    delete prj.resources;
    delete prj.roles;

    var prof = new Profiler("saveServerSide");
    prof.reset();

    if (ge.deletedTaskIds.length>0) {
      if (!confirm("TASK_THAT_WILL_BE_REMOVED\n"+ge.deletedTaskIds.length)) {
        return;
      }
    }

    $.ajax("ganttAjaxController.jsp", {
      dataType:"json",
      data: {CM:"SVPROJECT",prj:JSON.stringify(prj)},
      type:"POST",

      success: function(response) {
        if (response.ok) {
          prof.stop();
          if (response.project) {
            ge.loadProject(response.project); //must reload as "tmp_" ids are now the good ones
          } else {
            ge.reset();
          }
        } else {
          var errMsg="Errors saving project\n";
          if (response.message) {
            errMsg=errMsg+response.message+"\n";
          }

          if (response.errorMessages.length) {
            errMsg += response.errorMessages.join("\n");
          }

          alert(errMsg);
        }
      }

    });
    */
  }

  // Function to download data to a file
  function download(data, filename, type) {
    var file = new Blob([data], {type: type});
    if (window.navigator.msSaveOrOpenBlob) // IE10+
      window.navigator.msSaveOrOpenBlob(file, filename);
    else { // Others
      var a = document.createElement("a"),
        url = URL.createObjectURL(file);
      a.href = url;
      a.download = filename;
      document.body.appendChild(a);
      a.click();
      setTimeout(function() {
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);  
      }, 0); 
    }
  }

  function newProject(){
    clearGantt();
  }


  function clearGantt() {
    ge.reset();
  }

  //-------------------------------------------  Get project file as JSON (used for migrate project from gantt to Teamwork) ------------------------------------------------------
  function getFile() {
    $("#gimBaPrj").val(JSON.stringify(ge.saveProject()));
    $("#gimmeBack").submit();
    $("#gimBaPrj").val("");

    /*  var uriContent = "data:text/html;charset=utf-8," + encodeURIComponent(JSON.stringify(prj));
    neww=window.open(uriContent,"dl");*/
  }


  function loadFromLocalStorage() {
    var ret;
    if (localStorage) {
      if (localStorage.getObject("teamworkGantDemo")) {
        ret = localStorage.getObject("teamworkGantDemo");
      }
    }

    //if not found create a new example task
    if (!ret || !ret.tasks || ret.tasks.length == 0){
      ret=getDemoProject();
    }
    return ret;
  }


  function saveInLocalStorage() {
    var prj = ge.saveProject();

    if (localStorage) {
      localStorage.setObject("teamworkGantDemo", prj);
    }
  }


  //-------------------------------------------  Open a black popup for managing resources. This is only an axample of implementation (usually resources come from server) ------------------------------------------------------
  function editResources(){

    //make resource editor
    var resourceEditor = $.JST.createFromTemplate({}, "RESOURCE_EDITOR");
    var resTbl=resourceEditor.find("#resourcesTable");

    for (var i=0;i<ge.resources.length;i++){
      var res=ge.resources[i];
      resTbl.append($.JST.createFromTemplate(res, "RESOURCE_ROW"))
    }


    //bind add resource
    resourceEditor.find("#addResource").click(function(){
      resTbl.append($.JST.createFromTemplate({id:"new",name:"resource"}, "RESOURCE_ROW"))
    });

    //bind save event
    resourceEditor.find("#resSaveButton").click(function(){
      var newRes=[];
      //find for deleted res
      for (var i=0;i<ge.resources.length;i++){
        var res=ge.resources[i];
        var row = resourceEditor.find("[resId="+res.id+"]");
        if (row.length>0){
          //if still there save it
          var name = row.find("input[name]").val();
          if (name && name!="")
            res.name=name;
          newRes.push(res);
        } else {
          //remove assignments
          for (var j=0;j<ge.tasks.length;j++){
            var task=ge.tasks[j];
            var newAss=[];
            for (var k=0;k<task.assigs.length;k++){
              var ass=task.assigs[k];
              if (ass.resourceId!=res.id)
                newAss.push(ass);
            }
            task.assigs=newAss;
          }
        }
      }

      //loop on new rows
      var cnt=0
      resourceEditor.find("[resId=new]").each(function(){
        cnt++;
        var row = $(this);
        var name = row.find("input[name]").val();
        if (name && name!="")
          newRes.push (new Resource("tmp_"+new Date().getTime()+"_"+cnt,name));
      });

      ge.resources=newRes;

      closeBlackPopup();
      ge.redraw();
    });


    var ndo = createModalPopup(400, 500).append(resourceEditor);
  }

  function initializeHistoryManagement(taskId){

    //retrieve from server the list of history points in millisecond that represent the instant when the data has been recorded
    //response: {ok:true, historyPoints: [1498168800000, 1498600800000, 1498687200000, 1501538400000, …]}
    $.getJSON(contextPath+"/applications/teamwork/task/taskAjaxController.jsp", {CM: "GETGANTTHISTPOINTS", OBJID:taskId}, function (response) {

      //if there are history points
      if (response.ok == true && response.historyPoints && response.historyPoints.length>0) {

        //add show slider button on button bar
        var histBtn = $("<button>").addClass("button textual icon lreq30 lreqLabel").attr("title", "SHOW_HISTORY").append("<span class=\"teamworkIcon\">&#x60;</span>");

        //clicking it
        histBtn .click(function () {
          var el = $(this);
          var ganttButtons = $(".ganttButtonBar .buttons");

          //is it already on?
          if (!ge.element.is(".historyOn")) {
            ge.element.addClass("historyOn");
            ganttButtons.find(".requireCanWrite").hide();

            //load the history points from server again
            showSavingMessage();
            $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {CM: "GETGANTTHISTPOINTS", OBJID: ge.tasks[0].id}, function (response) {
              jsonResponseHandling(response);
              hideSavingMessage();
              if (response.ok == true) {
                var dh = response.historyPoints;
                if (dh && dh.length > 0) {
                  //si crea il div per lo slider
                  var sliderDiv = $("<div>").prop("id", "slider").addClass("lreq30 lreqHide").css({"display":"inline-block","width":"500px"});
                  ganttButtons.append(sliderDiv);

                  var minVal = 0;
                  var maxVal = dh.length-1 ;

                  $("#slider").show().mbSlider({
                    rangeColor : '#2f97c6',
                    minVal     : minVal,
                    maxVal     : maxVal,
                    startAt    : maxVal,
                    showVal    : false,
                    grid       :1,
                    formatValue: function (val) {
                      return new Date(dh[val]).format();
                    },
                    onSlideLoad: function (obj) {
                      this.onStop(obj);

                    },
                    onStart    : function (obj) {},
                    onStop     : function (obj) {
                      var val = $(obj).mbgetVal();
                      showSavingMessage();
                      /**
                       * load the data history for that milliseconf from server
                       * response in this format {ok: true, baselines: {...}}
                       *
                       * baselines: {61707: {duration:1,endDate:1550271599998,id:61707,progress:40,startDate:1550185200000,status:"STATUS_WAITING",taskId:"3055"},
                       *            {taskId:{duration:in days,endDate:in millis,id:history record id,progress:in percent,startDate:in millis,status:task status,taskId:"3055"}....}}                     */

                      $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {CM: "GETGANTTHISTORYAT", OBJID: ge.tasks[0].id, millis:dh[val]}, function (response) {
                        jsonResponseHandling(response);
                        hideSavingMessage();
                        if (response.ok ) {
                          ge.baselines=response.baselines;
                          ge.showBaselines=true;
                          ge.baselineMillis=dh[val];
                          ge.redraw();
                        }
                      })

                    },
                    onSlide    : function (obj) {
                      clearTimeout(obj.renderHistory);
                      var self = this;
                      obj.renderHistory = setTimeout(function(){
                        self.onStop(obj);
                      }, 200)

                    }
                  });
                }
              }
            });


            // closing the history
          } else {
            //remove the slider
            $("#slider").remove();
            ge.element.removeClass("historyOn");
            if (ge.permissions.canWrite)
              ganttButtons.find(".requireCanWrite").show();

            ge.showBaselines=false;
            ge.baselineMillis=undefined;
            ge.redraw();
          }

        });
        $("#saveGanttButton").before(histBtn);
      }
    })
  }

  function showBaselineInfo (event,element){
    //alert(element.attr("data-label"));
    $(element).showBalloon(event, $(element).attr("data-label"));
    ge.splitter.secondBox.one("scroll",function(){
      $(element).hideBalloon();
    })
  }

  </script>





  <div id="gantEditorTemplates" style="display:none;">
  <div class="__template__" type="GANTBUTTONS">
    <!--
    <div class="ganttButtonBar noprint">
      <div class="buttons">
        <a href="https://gantt.twproject.com/"><img src="res/twGanttLogo.png" alt="Twproject" align="absmiddle" style="max-width: 136px; padding-right: 15px"></a>

        <button onclick="$('#workSpace').trigger('undo.gantt');return false;" class="button textual icon requireCanWrite" title="undo"><span class="teamworkIcon">&#39;</span></button>
        <button onclick="$('#workSpace').trigger('redo.gantt');return false;" class="button textual icon requireCanWrite" title="redo"><span class="teamworkIcon">&middot;</span></button>
        <span class="ganttButtonSeparator requireCanWrite requireCanAdd"></span>
        <button onclick="$('#workSpace').trigger('addAboveCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanAdd" title="insert above"><span class="teamworkIcon">l</span></button>
        <button onclick="$('#workSpace').trigger('addBelowCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanAdd" title="insert below"><span class="teamworkIcon">X</span></button>
        <span class="ganttButtonSeparator requireCanWrite requireCanInOutdent"></span>
        <button onclick="$('#workSpace').trigger('outdentCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanInOutdent" title="un-indent task"><span class="teamworkIcon">.</span></button>
        <button onclick="$('#workSpace').trigger('indentCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanInOutdent" title="indent task"><span class="teamworkIcon">:</span></button>
        <span class="ganttButtonSeparator requireCanWrite requireCanMoveUpDown"></span>
        <button onclick="$('#workSpace').trigger('moveUpCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanMoveUpDown" title="move up"><span class="teamworkIcon">k</span></button>
        <button onclick="$('#workSpace').trigger('moveDownCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanMoveUpDown" title="move down"><span class="teamworkIcon">j</span></button>
        <span class="ganttButtonSeparator requireCanWrite requireCanDelete"></span>
        <button onclick="$('#workSpace').trigger('deleteFocused.gantt');return false;" class="button textual icon delete requireCanWrite" title="Elimina"><span class="teamworkIcon">&cent;</span></button>
        <span class="ganttButtonSeparator"></span>
        <button onclick="$('#workSpace').trigger('expandAll.gantt');return false;" class="button textual icon " title="EXPAND_ALL"><span class="teamworkIcon">6</span></button>
        <button onclick="$('#workSpace').trigger('collapseAll.gantt'); return false;" class="button textual icon " title="COLLAPSE_ALL"><span class="teamworkIcon">5</span></button>

      <span class="ganttButtonSeparator"></span>
        <button onclick="$('#workSpace').trigger('zoomMinus.gantt'); return false;" class="button textual icon " title="zoom out"><span class="teamworkIcon">)</span></button>
        <button onclick="$('#workSpace').trigger('zoomPlus.gantt');return false;" class="button textual icon " title="zoom in"><span class="teamworkIcon">(</span></button>
      <span class="ganttButtonSeparator"></span>
        <button onclick="$('#workSpace').trigger('print.gantt');return false;" class="button textual icon " title="Print"><span class="teamworkIcon">p</span></button>
      <span class="ganttButtonSeparator"></span>
        <button onclick="ge.gantt.showCriticalPath=!ge.gantt.showCriticalPath; ge.redraw();return false;" class="button textual icon requireCanSeeCriticalPath" title="CRITICAL_PATH"><span class="teamworkIcon">&pound;</span></button>
      <span class="ganttButtonSeparator requireCanSeeCriticalPath"></span>
        <button onclick="ge.splitter.resize(.1);return false;" class="button textual icon" ><span class="teamworkIcon">F</span></button>
        <button onclick="ge.splitter.resize(50);return false;" class="button textual icon" ><span class="teamworkIcon">O</span></button>
        <button onclick="ge.splitter.resize(100);return false;" class="button textual icon"><span class="teamworkIcon">R</span></button>
        <span class="ganttButtonSeparator"></span>
        <button onclick="$('#workSpace').trigger('fullScreen.gantt');return false;" class="button textual icon" title="FULLSCREEN" id="fullscrbtn"><span class="teamworkIcon">@</span></button>
        <button onclick="ge.element.toggleClass('colorByStatus' );return false;" class="button textual icon"><span class="teamworkIcon">&sect;</span></button>

      <button onclick="editResources();" class="button textual requireWrite" title="edit resources"><span class="teamworkIcon">M</span></button>
        &nbsp; &nbsp; &nbsp; &nbsp;
      </div>

      <div>
        <button onclick="saveGanttOnServer();" class="button first big requireWrite" title="Save">Save</button>
        <input type="file" name="load-file" id="load-file">
        <label for="load-file">Load</label>
        <button onclick='newProject();' class='button requireWrite newproject'><em>clear project</em></button>
        <button class="button login" title="login/enroll" onclick="loginEnroll($(this));" style="display:none;">login/enroll</button>
        <button class="button opt collab" title="Start with Twproject" onclick="collaborate($(this));" style="display:none;"><em>collaborate</em></button>
      </div>
    </div>
    -->
  </div>

  <div class="__template__" type="TASKSEDITHEAD"><!--
    <table class="gdfTable" cellspacing="0" cellpadding="0">
      <thead>
      <tr style="height:40px">
        <th class="gdfColHeader" style="width:35px; border-right: none"></th>
        <th class="gdfColHeader" style="width:25px;"></th>
        <th class="gdfColHeader gdfResizable" style="width:100px;">code/short name</th>
        <th class="gdfColHeader gdfResizable" style="width:300px;">name</th>
        <th class="gdfColHeader"  align="center" style="width:17px;" title="Start date is a milestone."><span class="teamworkIcon" style="font-size: 8px;">^</span></th>
        <th class="gdfColHeader gdfResizable" style="width:80px;">start</th>
        <th class="gdfColHeader"  align="center" style="width:17px;" title="End date is a milestone."><span class="teamworkIcon" style="font-size: 8px;">^</span></th>
        <th class="gdfColHeader gdfResizable" style="width:80px;">End</th>
        <th class="gdfColHeader gdfResizable" style="width:50px;">dur.</th>
        <th class="gdfColHeader gdfResizable" style="width:20px;">%</th>
        <th class="gdfColHeader gdfResizable requireCanSeeDep" style="width:50px;">depe.</th>
        <th class="gdfColHeader gdfResizable" style="width:1000px; text-align: left; padding-left: 10px;">assignees</th>
      </tr>
      </thead>
    </table>
    --></div>

  <div class="__template__" type="TASKROW"><!--
    <tr id="tid_(#=obj.id#)" taskId="(#=obj.id#)" class="taskEditRow (#=obj.isParent()?'isParent':''#) (#=obj.collapsed?'collapsed':''#)" level="(#=level#)">
      <th class="gdfCell edit" align="right" style="cursor:pointer;"><span class="taskRowIndex">(#=obj.getRow()+1#)</span> <span class="teamworkIcon" style="font-size:12px;" >e</span></th>
      <td class="gdfCell noClip" align="center"><div class="taskStatus cvcColorSquare" status="(#=obj.status#)"></div></td>
      <td class="gdfCell"><input type="text" name="code" value="(#=obj.code?obj.code:''#)" placeholder="code/short name"></td>
      <td class="gdfCell indentCell" style="padding-left:(#=obj.level*10+18#)px;">
        <div class="exp-controller" align="center"></div>
        <input type="text" name="name" value="(#=obj.name#)" placeholder="name">
      </td>
      <td class="gdfCell" align="center"><input type="checkbox" name="startIsMilestone"></td>
      <td class="gdfCell"><input type="text" name="start"  value="" class="date"></td>
      <td class="gdfCell" align="center"><input type="checkbox" name="endIsMilestone"></td>
      <td class="gdfCell"><input type="text" name="end" value="" class="date"></td>
      <td class="gdfCell"><input type="text" name="duration" autocomplete="off" value="(#=obj.duration#)"></td>
      <td class="gdfCell"><input type="text" name="progress" class="validated" entrytype="PERCENTILE" autocomplete="off" value="(#=obj.progress?obj.progress:''#)" (#=obj.progressByWorklog?"readOnly":""#)></td>
      <td class="gdfCell requireCanSeeDep"><input type="text" name="depends" autocomplete="off" value="(#=obj.depends#)" (#=obj.hasExternalDep?"readonly":""#)></td>
      <td class="gdfCell taskAssigs">(#=obj.getAssigsString()#)</td>
    </tr>
    --></div>

  <div class="__template__" type="TASKEMPTYROW"><!--
    <tr class="taskEditRow emptyRow" >
      <th class="gdfCell" align="right"></th>
      <td class="gdfCell noClip" align="center"></td>
      <td class="gdfCell"></td>
      <td class="gdfCell"></td>
      <td class="gdfCell"></td>
      <td class="gdfCell"></td>
      <td class="gdfCell"></td>
      <td class="gdfCell"></td>
      <td class="gdfCell"></td>
      <td class="gdfCell"></td>
      <td class="gdfCell requireCanSeeDep"></td>
      <td class="gdfCell"></td>
    </tr>
    --></div>

  <div class="__template__" type="TASKBAR"><!--
    <div class="taskBox taskBoxDiv" taskId="(#=obj.id#)" >
      <div class="layout (#=obj.hasExternalDep?'extDep':''#)">
        <div class="taskStatus" status="(#=obj.status#)"></div>
        <div class="taskProgress" style="width:(#=obj.progress>100?100:obj.progress#)%; background-color:(#=obj.progress>100?'red':'rgb(153,255,51);'#);"></div>
        <div class="milestone (#=obj.startIsMilestone?'active':''#)" ></div>

        <div class="taskLabel"></div>
        <div class="milestone end (#=obj.endIsMilestone?'active':''#)" ></div>
      </div>
    </div>
    --></div>


  <div class="__template__" type="CHANGE_STATUS"><!--
      <div class="taskStatusBox">
      <div class="taskStatus cvcColorSquare" status="STATUS_ACTIVE" title="Active"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_DONE" title="Completed"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_FAILED" title="Failed"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_SUSPENDED" title="Suspended"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_WAITING" title="Waiting" style="display: none;"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_UNDEFINED" title="Undefined"></div>
      </div>
    --></div>




  <div class="__template__" type="TASK_EDITOR"><!--
    <div class="ganttTaskEditor">
      <h2 class="taskData">Task editor</h2>
      <table  cellspacing="1" cellpadding="5" width="100%" class="taskData table" border="0">
            <tr>
          <td width="200" style="height: 80px"  valign="top">
            <label for="code">code/short name</label><br>
            <input type="text" name="code" id="code" value="" size=15 class="formElements" autocomplete='off' maxlength=255 style='width:100%' oldvalue="1">
          </td>
          <td colspan="3" valign="top"><label for="name" class="required">name</label><br><input type="text" name="name" id="name"class="formElements" autocomplete='off' maxlength=255 style='width:100%' value="" required="true" oldvalue="1"></td>
            </tr>


        <tr class="dateRow">
          <td nowrap="">
            <div style="position:relative">
              <label for="start">start</label>&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="checkbox" id="startIsMilestone" name="startIsMilestone" value="yes"> &nbsp;<label for="startIsMilestone">is milestone</label>&nbsp;
              <br><input type="text" name="start" id="start" size="8" class="formElements dateField validated date" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DATE">
              <span title="calendar" id="starts_inputDate" class="teamworkIcon openCalendar" onclick="$(this).dateField({inputField:$(this).prevAll(':input:first'),isSearchField:false});">m</span>          </div>
          </td>
          <td nowrap="">
            <label for="end">End</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" id="endIsMilestone" name="endIsMilestone" value="yes"> &nbsp;<label for="endIsMilestone">is milestone</label>&nbsp;
            <br><input type="text" name="end" id="end" size="8" class="formElements dateField validated date" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DATE">
            <span title="calendar" id="ends_inputDate" class="teamworkIcon openCalendar" onclick="$(this).dateField({inputField:$(this).prevAll(':input:first'),isSearchField:false});">m</span>
          </td>
          <td nowrap="" >
            <label for="duration" class=" ">Days</label><br>
            <input type="text" name="duration" id="duration" size="4" class="formElements validated durationdays" title="Duration is in working days." autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DURATIONDAYS">&nbsp;
          </td>
        </tr>

        <tr>
          <td  colspan="2">
            <label for="status" class=" ">status</label><br>
            <select id="status" name="status" class="taskStatus" status="(#=obj.status#)"  onchange="$(this).attr('STATUS',$(this).val());">
              <option value="STATUS_ACTIVE" class="taskStatus" status="STATUS_ACTIVE" >active</option>
              <option value="STATUS_WAITING" class="taskStatus" status="STATUS_WAITING" >suspended</option>
              <option value="STATUS_SUSPENDED" class="taskStatus" status="STATUS_SUSPENDED" >suspended</option>
              <option value="STATUS_DONE" class="taskStatus" status="STATUS_DONE" >completed</option>
              <option value="STATUS_FAILED" class="taskStatus" status="STATUS_FAILED" >failed</option>
              <option value="STATUS_UNDEFINED" class="taskStatus" status="STATUS_UNDEFINED" >undefined</option>
            </select>
          </td>

          <td valign="top" nowrap>
            <label>progress</label><br>
            <input type="text" name="progress" id="progress" size="7" class="formElements validated percentile" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="PERCENTILE">
          </td>
        </tr>

            </tr>
            <tr>
              <td colspan="4">
                <label for="description">Description</label><br>
                <textarea rows="3" cols="30" id="description" name="description" class="formElements" style="width:100%"></textarea>
              </td>
            </tr>
          </table>

      <h2>Assignments</h2>
    <table  cellspacing="1" cellpadding="0" width="100%" id="assigsTable">
      <tr>
        <th style="width:100px;">name</th>
        <th style="width:70px;">Role</th>
        <th style="width:30px;">est.wklg.</th>
        <th style="width:30px;" id="addAssig"><span class="teamworkIcon" style="cursor: pointer">+</span></th>
      </tr>
    </table>

    <div style="text-align: right; padding-top: 20px">
      <span id="saveButton" class="button first" onClick="$(this).trigger('saveFullEditor.gantt');">Save</span>
    </div>

    </div>
    --></div>



  <div class="__template__" type="ASSIGNMENT_ROW"><!--
    <tr taskId="(#=obj.task.id#)" assId="(#=obj.assig.id#)" class="assigEditRow" >
      <td ><select name="resourceId"  class="formElements" (#=obj.assig.id.indexOf("tmp_")==0?"":"disabled"#) ></select></td>
      <td ><select type="select" name="roleId"  class="formElements"></select></td>
      <td ><input type="text" name="effort" value="(#=getMillisInHoursMinutes(obj.assig.effort)#)" size="5" class="formElements"></td>
      <td align="center"><span class="teamworkIcon delAssig del" style="cursor: pointer">d</span></td>
    </tr>
    --></div>



  <div class="__template__" type="RESOURCE_EDITOR"><!--
    <div class="resourceEditor" style="padding: 5px;">

      <h2>Project team</h2>
      <table  cellspacing="1" cellpadding="0" width="100%" id="resourcesTable">
        <tr>
          <th style="width:100px;">name</th>
          <th style="width:30px;" id="addResource"><span class="teamworkIcon" style="cursor: pointer">+</span></th>
        </tr>
      </table>

      <div style="text-align: right; padding-top: 20px"><button id="resSaveButton" class="button big">Save</button></div>
    </div>
    --></div>



  <div class="__template__" type="RESOURCE_ROW"><!--
    <tr resId="(#=obj.id#)" class="resRow" >
      <td ><input type="text" name="name" value="(#=obj.name#)" style="width:100%;" class="formElements"></td>
      <td align="center"><span class="teamworkIcon delRes del" style="cursor: pointer">d</span></td>
    </tr>
    --></div>


  </div>
  <script type="text/javascript">
    $.JST.loadDecorator("RESOURCE_ROW", function(resTr, res){
      resTr.find(".delRes").click(function(){$(this).closest("tr").remove()});
    });

    $.JST.loadDecorator("ASSIGNMENT_ROW", function(assigTr, taskAssig){
      var resEl = assigTr.find("[name=resourceId]");
      var opt = $("<option>");
      resEl.append(opt);
      for(var i=0; i< taskAssig.task.master.resources.length;i++){
        var res = taskAssig.task.master.resources[i];
        opt = $("<option>");
        opt.val(res.id).html(res.name);
        if(taskAssig.assig.resourceId == res.id)
          opt.attr("selected", "true");
        resEl.append(opt);
      }
      var roleEl = assigTr.find("[name=roleId]");
      for(var i=0; i< taskAssig.task.master.roles.length;i++){
        var role = taskAssig.task.master.roles[i];
        var optr = $("<option>");
        optr.val(role.id).html(role.name);
        if(taskAssig.assig.roleId == role.id)
          optr.attr("selected", "true");
        roleEl.append(optr);
      }

      if(taskAssig.task.master.permissions.canWrite && taskAssig.task.canWrite){
        assigTr.find(".delAssig").click(function(){
          var tr = $(this).closest("[assId]").fadeOut(200, function(){$(this).remove()});
        });
      }

    });


    function loadI18n(){
      GanttMaster.messages = {
        "CANNOT_WRITE":"No permission to change the following task:",
        "CHANGE_OUT_OF_SCOPE":"Project update not possible as you lack rights for updating a parent project.",
        "START_IS_MILESTONE":"Start date is a milestone.",
        "END_IS_MILESTONE":"End date is a milestone.",
        "TASK_HAS_CONSTRAINTS":"Task has constraints.",
        "GANTT_ERROR_DEPENDS_ON_OPEN_TASK":"Error: there is a dependency on an open task.",
        "GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK":"Error: due to a descendant of a closed task.",
        "TASK_HAS_EXTERNAL_DEPS":"This task has external dependencies.",
        "GANNT_ERROR_LOADING_DATA_TASK_REMOVED":"GANNT_ERROR_LOADING_DATA_TASK_REMOVED",
        "CIRCULAR_REFERENCE":"Circular reference.",
        "CANNOT_DEPENDS_ON_ANCESTORS":"Cannot depend on ancestors.",
        "INVALID_DATE_FORMAT":"The data inserted are invalid for the field format.",
        "GANTT_ERROR_LOADING_DATA_TASK_REMOVED":"An error has occurred while loading the data. A task has been trashed.",
        "CANNOT_CLOSE_TASK_IF_OPEN_ISSUE":"Cannot close a task with open issues",
        "TASK_MOVE_INCONSISTENT_LEVEL":"You cannot exchange tasks of different depth.",
        "CANNOT_MOVE_TASK":"CANNOT_MOVE_TASK",
        "PLEASE_SAVE_PROJECT":"PLEASE_SAVE_PROJECT",
        "GANTT_SEMESTER":"Semester",
        "GANTT_SEMESTER_SHORT":"s.",
        "GANTT_QUARTER":"Quarter",
        "GANTT_QUARTER_SHORT":"q.",
        "GANTT_WEEK":"Week",
        "GANTT_WEEK_SHORT":"w."
      };
    }



    function createNewResource(el) {
      var row = el.closest("tr[taskid]");
      var name = row.find("[name=resourceId_txt]").val();
      var url = contextPath + "/applications/teamwork/resource/resourceNew.jsp?CM=ADD&name=" + encodeURI(name);

      openBlackPopup(url, 700, 320, function (response) {
        //fillare lo smart combo
        if (response && response.resId && response.resName) {
          //fillare lo smart combo e chiudere l'editor
          row.find("[name=resourceId]").val(response.resId);
          row.find("[name=resourceId_txt]").val(response.resName).focus().blur();
        }

      });
    }

  $(document).on("change", "#load-file", function() {
    var uploadedFile = $("#load-file").prop("files")[0];
    upload(uploadedFile);
  });

  </script>

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
          <script src="content/js/modules/side_bar.js"></script>
          <script src="content/js/modules/fixed_page2.js"></script>
          <script src="content/js/modules/set_filter_sort_table.js"></script>
          <script src="content/js/modules/mode_expert.js"></script>
          <script src="content/js/modules/sort_table.js"></script>
          <script src="content/js/modules/export_table_to_excel.js"></script>
          <script src="content/js/mode_expert/mode_expert.js"></script>
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