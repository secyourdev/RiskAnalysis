<?php include("content/php/atelier1b/selection.php");?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="RiskManager">
  <meta name="author" content="SecYourDev">

  <title>RiskManager | Atelier 1.b</title>

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
        <div id="top_bar_3" class="top_bar_name_3">Activité 1.b - Biens primordiaux/support</div>

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
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">Guillaume</span>
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
                  <h6 class="m-0">Mission</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body row perso_card_body_row">
                  <!--tableau-->
                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_mission" placeholder="Rechercher">
                    <table id="editable_table" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th id="id_mission">ID_mission</th>
                          <th id="nom_mission">Nom de la mission</th>
                          <th id="nom">Nom responsable</th>
                          <th id="prenom">Prénom responsable</th>
                          <th id="poste">Poste responsable</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      while($row = mysqli_fetch_array($result1))
                      {
                        echo '
                        <tr>
                        <td>'.$row["id_mission"].'</td>
                        <td>'.$row["nom_mission"].'</td>
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
                  <!-- bouton Ajouter une nouvelle ligne -->
                  <div class="text-center">
                    <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_mission">Ajouter une nouvelle ligne</button>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                    <img src="content/img/files.svg" class="img-fluid perso_img_full_screen_div2" alt="Responsive image">
                  </div>
                </div>
              </div>
            </div>

            <!-- Area Card -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Valeur métiers</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <!--tableau-->
                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_valeur_metier" placeholder="Rechercher">
                    <table id="tableau_vm" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th id="id_valeur_metier">ID valeur métier</th>
                          <th id="valeurmetier">Valeur métier</th>
                          <th id="mission">Mission</th>
                          <th id="nature">Nature</th>
                          <th id="description">Description</th>
                          <th id="nomresponsablevm">Nom responsable</th>
                          <th id="prenomresponsablevm">Prénom responsable</th>
                          <th id="posteresponsablevm">Poste responsable</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      while($row = mysqli_fetch_array($result2))
                      {
                        echo '
                        <tr>
                        <td>'.$row["id_valeur_metier"].'</td>
                        <td>'.$row["nom_valeur_metier"].'</td>
                        <td>'.$row["nom_mission"].'</td>
                        <td>'.$row["nature_valeur_metier"].'</td>
                        <td>'.$row["description_valeur_metier"].'</td>
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
                  

                  <!-- bouton Ajouter une nouvelle ligne -->
                  <div class="text-center">
                    <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_valeur_metier">Ajouter une nouvelle ligne</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Area Card -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Bien support</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <!--tableau-->
                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_bien_support" placeholder="Rechercher">
                    <table id="tableau_bs" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th id="id_biensupport">ID Bien support</th>
                          <th id="biensupport">Bien support</th>
                          <th id="valeurmetier">Valeur métier</th>
                          <th id="description">Description</th>
                          <th id="nomresponsablevm">Nom responsable</th>
                          <th id="prenomresponsablevm">Prénom responsable</th>
                          <th id="posteresponsablevm">Poste responsable</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      while($row = mysqli_fetch_array($result3))
                      {
                        echo '
                        <tr>
                        <td>'.$row["id_bien_support"].'</td>
                        <td>'.$row["nom_bien_support"].'</td>
                        <td>'.$row["nom_valeur_metier"].'</td>
                        <td>'.$row["description_bien_support"].'</td>
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
            
                  <!-- bouton Ajouter une nouvelle ligne -->
                  <div class="text-center">
                    <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_bien_support">Ajouter une nouvelle ligne</button>
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
          <form method="post" action="content/php/atelier1b/ajoutmission.php" class="user" id="formMission">
            <fieldset>
              <div class="form-group">
                <input type="text" class="perso_form shadow-none form-control form-control-user" name ="mission" id="InputNomMission"
                  placeholder="Mission" required>
              </div>

              <div class="form-group">
                <label for="SelectNaturePop">Nom du responsable</label>
                <select class="form-control" name="nomresponsable" id="SelectNom">
                  <option value="" selected>...</option>
                  <?php
                      while($row = mysqli_fetch_array($resultnomresponsablemission))
                      {
                        echo '
                        <option value="'.$row["nom"].'">'.$row["nom"].'</option>
                        ';
                      }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="SelectNaturePop">Poste</label>
                <select class="form-control" name="prenomresponsable" id="SelectPrenom">
                  <option value="" selected>...</option>
                  <?php
                      while($row = mysqli_fetch_array($resultprenomresponsablemission))
                      {
                        echo '
                        <option value="'.$row["prenom"].'">'.$row["prenom"].'</option>
                        ';
                      }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="SelectNaturePop">Poste</label>
                <select class="form-control" name="poste" id="SelectPoste">
                  <option value="" selected>...</option>
                  <?php
                      while($row = mysqli_fetch_array($resultposteresponsablemission))
                      {
                        echo '
                        <option value="'.$row["poste"].'">'.$row["poste"].'</option>
                        ';
                      }
                  ?>
                </select>
              </div>
              <!-- bouton Ajouter -->
              <div class="modal-footer perso_middle_modal_footer">
                <input type="submit" name="validermission" value="Ajouter" class="btn perso_btn shadow-none"></input>
              </div>
            </fieldset>
            
          
          </form>
        </div>
        
        
      </div>
    </div>
  </div>

<!-- -------------------------------------------------------------------------------------------------------------- 
--------------------------------------- modal ajout de valeur métier ----------------------------------------------
--------------------------------------------------------------------------------------------------------------  -->
  <div class="modal fade" id="ajout_valeur_metier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajout d'une valeur métier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body perso_modal_body">
          <form method="post" action="content/php/atelier1b/ajoutvm.php" class="user" id="formValeurMetierPop">
            <fieldset>

            <div class="form-group">
                <label for="SelectNaturePop">Nature</label>
                <select class="form-control" name="nommission" id="SelectMission">
                  <option value="" selected>...</option>
                  <?php
                      while($row = mysqli_fetch_array($resultmission))
                      {
                        echo '
                        <option value="'.$row["nom_mission"].'">'.$row["nom_mission"].'</option>
                        ';
                      }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <input type="text" class="perso_form shadow-none form-control form-control-user" name="nomvm" id="InputValeurMetierPop"
                  placeholder="Dénomination de la valeur métier" required>
              </div>

              <div class="form-group">
                <label for="SelectNaturePop">Nature</label>
                <select class="form-control" name="nature" id="SelectNaturePop">
                  <option value="" selected>...</option>
                  <option value="Processus">Processus</option>
                  <option value="Information">Information</option>
                </select>
              </div>

              <div class="form-group">
                <label for="DescriptionValeurPop">Description</label>
                <textarea class="form-control perso_text_area" name="descriptionvm" id="DescriptionValeurPop" rows="3"></textarea>
              </div>

              <div class="form-group">
                <input type="text" class="perso_form shadow-none form-control form-control-user" name="nomresponsablevm" id="InputNomResponsablevm"
                  placeholder="Nom du responsable" required>
              </div>

              <div class="form-group">
                <input type="text" class="perso_form shadow-none form-control form-control-user" name="prenomresponsablevm" id="InputPrenomResponsablevm"
                  placeholder="Prénomom du responsable" required>
              </div>
              
              <div class="form-group">
                <input type="texte" class="perso_arrow perso_form shadow-none form-control" list="posteresponsablevm" name="posteresponsablevm"
                  placeholder="Poste" required>
                <datalist id="PostesValeurPop">
                  <option value="Internet Explorer">
                  <option value="Firefox">
                  <option value="Chrome">
                  <option value="Opera">
                  <option value="Safari">
                </datalist>
              </div>
              <!-- bouton Ajouter -->
              <div class="modal-footer perso_middle_modal_footer">
                <input type="submit" name="validervm" value="Ajouter" class="btn perso_btn shadow-none"></input>
              </div>
            </fieldset>
          </form>
        </div>
        
      </div>
    </div>
  </div>


<!-- -------------------------------------------------------------------------------------------------------------- 
--------------------------------------- modal ajout de bien support ----------------------------------------------
--------------------------------------------------------------------------------------------------------------  -->
  <div class="modal fade" id="ajout_bien_support" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajout d'un bien support</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body perso_modal_body">
          <form method="post" action="content/php/atelier1b/ajoutbs.php" class="user" id="formBienSupportPop">
            <fieldset>
              <div class="form-group">
                <input type="text" class="perso_form shadow-none form-control form-control-user" name="biensupport" id="InputBienSupportPop"
                  placeholder="Dénomination du bien support" required>
              </div>
              
              <div class="form-group">
                <label for="SelectValeurMetierPop">Valeur métier</label>
                <select class="form-control" name="vm" id="SelectValeurMetierPop">
                  <option value="" selected>...</option>
                  <?php
                      while($row = mysqli_fetch_array($resultvm))
                      {
                        echo '
                        <option value="'.$row["nom_valeur_metier"].'">'.$row["nom_valeur_metier"].'</option>
                        ';
                      }
                  ?>
                </select>
              </div>
              
              <div class="form-group">
                <label for="DescriptionBienPop">Description</label>
                <textarea class="form-control perso_text_area" name="descriptionbs" id="DescriptionBienPop" rows="3"></textarea>
              </div>

              <div class="form-group">
                <input type="text" class="perso_form shadow-none form-control form-control-user" name="nomresponsablebs" id="InputNomResponsablebs"
                  placeholder="Nom du responsable" required>
              </div>

              <div class="form-group">
                <input type="text" class="perso_form shadow-none form-control form-control-user" name="prenomresponsablebs" id="InputPrenomResponsablebs"
                  placeholder="Prénom du responsable" required>
              </div>
              
              <div class="form-group">
                <input type="texte" class="perso_arrow perso_form shadow-none form-control" list="PostesBienPop" name="posteresponsablebs"
                  placeholder="Poste" required>
                <datalist id="PostesBienPop">
                  <option value="Internet Explorer">
                  <option value="Firefox">
                  <option value="Chrome">
                  <option value="Opera">
                  <option value="Safari">
                </datalist>
              </div>
              <!-- bouton Ajouter -->
              <div class="modal-footer perso_middle_modal_footer">
                <input type="submit" name="validerbs" value="Ajouter" class="btn perso_btn shadow-none"></input>
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
  <script src="content/js/modules/realtime.js"></script>
  <script src="content/js/modules/set_filter_sort_table.js"></script>
  <script src="content/js/atelier/atelier1b.js"></script>
  <script src="content/js/modules/sort_table.js"></script>
  
</body>

</html>
