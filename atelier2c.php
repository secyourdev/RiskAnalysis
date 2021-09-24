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

    $reqdroit = $bdd->prepare('SELECT * FROM H_RACI WHERE id_utilisateur = ? AND id_projet = ? AND id_atelier="2.c"');
    $reqdroit->bindParam(1, $getid);
    $reqdroit->bindParam(2, $getidproject);
    $reqdroit->execute();
    $userdroit = $reqdroit->fetch();

    $reqdroit_chef_de_projet = $bdd->prepare('SELECT id_utilisateur FROM F_projet WHERE id_projet = ?');
    $reqdroit_chef_de_projet->bindParam(1, $getidproject);
    $reqdroit_chef_de_projet->execute();
    $userdroit_chef_de_projet = $reqdroit_chef_de_projet->fetch();
?>

<?php include("content/php/atelier2c/selection.php");?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CyberRiskManager">
  <meta name="author" content="SecYourDev">

  <title>CyberRiskManager | Atelier 2.c</title>

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

  <!-- CHART.JS -->
  <script src="content\vendor\chart.js\chart.min.js"></script>
</head>

<?php 
if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur'])
{
  if(isset($userdroit['ecriture'])||$userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){
?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Left Sidebar -->
    <?php include("content/php/commun/menu_gauche.php");?>
    <!-- End of Left Sidebar -->

    <!-- Right Sidebar -->
    <ul id=menu>
      <li>
          <a class="nav-link collapse-right-item menu_float" href="#choix_sr">
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
              <span class="nom_sous_menu">Choix des sources de risque</span>
          </a>
      </li>
      <li>
          <a class="nav-link collapse-right-item menu_float" href="#cartographie_srov">
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
              <span class="nom_sous_menu">Cartographie des "Source de risque / Objectif visé"</span>
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
          <div id="top_bar_2" class="top_bar_name_2">Atelier 2</div>
          <div id="top_bar_3" class="top_bar_name_3">Activité 2.c - Sélectionner les couples SR/OV retenus pour la suite de l'analyse</div>
          
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
            <div class="col-xl col-lg">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0">Objectif</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <p> Le but de l'atelier 2 est d'identifier les sources de risques (SR) et leurs objectifs visés (OV), en lien avec le contexte particulier de l'étude. 
                    L'atelier vise à répondre à la question suivante : qui ou quoi pourrait porter atteint aux missions et valeurs métier identifiées dans l'atelier 1, et dans quels buts ?</p>
                  <!--text-->
                </div>
              </div>
            </div>

            <!-- Area Card -->
            <div id="choix_sr" class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="row perso_no_margin">
                    <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <h6 class="m-0">Choix des sources de risque</h6>
                    </div>
                    <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      <a class="download_table_button" id="button_download_choix_SR">
                        <i class="fas fa-download fa-lg text-gray-400"></i>
                      </a>
                    </div>    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <!--text-->
                  <div class="table-responsive">
                    <input type="text" class="rechercher_input" id="rechercher_srov" placeholder="Rechercher">
                    <table id="editable_table" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th id=id_srov>ID SROV</th>
                          <th id="profil_attaquant">Profil d'attaquant</th>
                          <th id="description_source_risque">Description source de risque</th>
                          <th id="objectif vise">Objectif visé</th>
                          <th id="description_objectif">Description de l'objectif</th>
                          <th id="motivation">Motivation</th>
                          <th id="ressources">Ressources</th>
                          <th id="activite">Activité</th>
                          <th id="mode_operatoire">Mode opératoire</th>
                          <th id="secteur_activite">Secteur d'activité</th>
                          <th id="arsenal_attque">Arsenal d'attaque</th>
                          <th id="faits_armes">Faits d'armes</th>
                          <th id="pertinence">Pertinence</th>
                          <th id="choix">Choix P1/P2</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      while($row = mysqli_fetch_array($result))
                      {
                        echo '
                        <tr>
                        <td>'.$row["id_source_de_risque"].'</td>
                        <td>'.$row["profil_de_l_attaquant_source_de_risque"].'</td>
                        <td>'.$row["description_source_de_risque"].'</td>
                        <td>'.$row["objectif_vise"].'</td>
                        <td>'.$row["description_objectif_vise"].'</td>
                        <td>'.$row["motivation"].'</td>
                        <td>'.$row["ressources"].'</td>
                        <td>'.$row["activite"].'</td>
                        <td>'.$row["mode_operatoire"].'</td>
                        <td>'.$row["secteur_d_activite"].'</td>
                        <td>'.$row["arsenal_d_attaque"].'</td>
                        <td>'.$row["faits_d_armes"].'</td>
                        <td>'.$row["pertinence"].'</td>
                        <td>'.$row["choix_source_de_risque"].'</td>
                        </tr>
                        ';
                      }
                      ?>
                      </tbody>
                    </table>

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

                  </div>                    
                </div>    
              </div>
            </div>
            <!-- Area Card -->
            <div id="cartographie_srov" class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="row perso_no_margin">
                  <div class="card-header col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <h6>Cartographie des "Source de risque / Objectif visé" </h6>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <canvas id="myChart_srov"></canvas>
                  </br>
                  <div class="d-flex legende">
                    <div class="cercle-noir"></div>
                    <label>&nbsp;Choix non effectué</label>
                  </div>
                  <div class="d-flex legende">
                    <div class="cercle-vert"></div>
                    <label>&nbsp;Couple SROV non retenu</label>
                  </div>
                  <div class="d-flex legende">
                    <div class="cercle-rouge"></div>
                    <label>&nbsp;Couple SROV retenu</label>
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
            <span>Copyright &copy; CYBER RISK MANAGER 2021 by SecYourDev</span>
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
        <script src="content/js/atelier/atelier2c.js"></script>
    <?php
        }
        else if(isset($userdroit['ecriture'])){
            if($userdroit['ecriture']=='Réalisation'){
    ?>
                <script src="content/js/atelier/atelier2c.js"></script>
    <?php 
            }
            else{
    ?>
                <script src="content/js/atelier/atelier2c_no_modification.js"></script>
    <?php
            }
        }        
    ?>
  <script src="content/js/modules/sort_table.js"></script>
  <script src="content/js/modules/2c_carto.js"></script>
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