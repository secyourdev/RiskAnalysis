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

    $reqdroit = $bdd->prepare('SELECT * FROM H_RACI WHERE id_utilisateur = ? AND id_projet = ? AND id_atelier="4.b"');
    $reqdroit->bindParam(1, $getid);
    $reqdroit->bindParam(2, $getidproject);
    $reqdroit->execute();
    $userdroit = $reqdroit->fetch();

    $reqdroit_chef_de_projet = $bdd->prepare('SELECT id_utilisateur FROM F_projet WHERE id_projet = ?');
    $reqdroit_chef_de_projet->bindParam(1, $getidproject);
    $reqdroit_chef_de_projet->execute();
    $userdroit_chef_de_projet = $reqdroit_chef_de_projet->fetch();

    $getidechelle = $bdd->prepare('SELECT id_echelle FROM DA_echelle NATURAL JOIN F_projet WHERE F_projet.id_projet = ?');
    $getidechelle->bindParam(1, $getidproject);
    $getidechelle->execute();
    $echelleinfo = $getidechelle->fetch();
?>

<?php include("content/php/atelier4b/selection.php");?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CyberRiskManager">
  <meta name="author" content="SecYourDev">

  <title>CyberRiskManager | Atelier 4.b</title>

  <!-- Fonts-->
  <link href="content/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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

    <!-- Left Sidebar -->
    <?php include("content/php/commun/menu_gauche.php");?>
    <!-- End of Left Sidebar -->

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
          <a class="nav-link collapse-right-item menu_float" href="#evaluation_vraissemblance">
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
              <span class="nom_sous_menu">Évaluation de la vraisemblance</span>
          </a>
      </li>
    </ul>
    <!-- End of Right Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed-top" id='barre_info'>
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <div id="top_bar_1" class="top_bar_name_1"><?php echo $projectinfo['nom_projet'];?></div>
          <div id="top_bar_2" class="top_bar_name_2">Atelier 4</div>
          <div id="top_bar_3" class="top_bar_name_3">Activité 4.b - Évaluer la vraisemblance des scénarios opérationnels</div>
          
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
                  <p>Le but de l'atelier 4 est de construire des scénarios techniques reprenant les modes opératoires susceptibles d'être utilisés par les sources de risque pour réaliser les scénarios stratégiues.
                    Cet atelier adopte ue démarche similaire à celle de l'atelier précédent mais se concentre sur les biens supports critiques. Vous évaluez ensuite le niveau de vraisemblance des scénarios opérationnels obtenus.
                  </p>
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
                    <table id="editable_table_echelle" class="table table-bordered table-striped">
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
                        <td>'.$row["nb_niveau_echelle"].'</td>
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
                        <h6 class="m-0">Niveaux des échelles de vraisemblance</h6>
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
                    <label for="SelectNaturePop">Echelles de vraisemblance</label>
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
                          <th id="id_echelle">ID niveau</th>
                          <th id="id_niveau">Valeur du niveau</th>
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
            <div id="evaluation_vraissemblance" class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="row perso_no_margin">
                    <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <h6 class="m-0">Évaluation de la vraisemblance</h6>
                    </div>
                    <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      <a class="download_table_button" id="button_download_vraisemblance">
                        <i class="fas fa-download fa-lg text-gray-400"></i>
                      </a>
                    </div>    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="nomechelleprojet">Choix de l'échelle de vraisemblance à utiliser pour le projet :</label>
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
                  <script src="content/js/modules/echelle_projet_vraisemblance.js"></script>                  <!--text-->
                  <div class="table-responsive">
                  <input type="text" class="rechercher_input" id="rechercher_chemin" placeholder="Rechercher">
                    <table id="editable_table" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th id="id_scenario_ope">ID scénario operationnel</th>
                          <th id="numero_risque">Numéro du risque</th>
                          <th id="chemin_attaque_strategique">Chemin d'attaque stratégique</th>
                          <th id="scenario_operationnel">Scénario opérationnel</th>
                          <th id="vraisemblance">Vraisemblance</th>
                          
                        </tr>
                      </thead>
                        
                      <tbody>
                      <?php
                      while($row = mysqli_fetch_array($result3))
                      {
                        echo '
                        <tr>
                        <td>'.$row["id_scenario_operationnel"].'</td>
                        <td>'.$row["id_risque"].'</td>
                        <td>'.$row["nom_chemin_d_attaque_strategique"].'</td>
                        <td>'.$row["description_scenario_operationnel"].'</td>
                        <td>'.$row["vraisemblance"].'</td>
                        </tr>
                        ';
                      }
                      ?>
                      </tbody>
                    </table>

                    <div class='message_success'>
                      <?php
                      if (isset($_SESSION['message_success_3'])) {
                        echo $_SESSION['message_success_3'];
                        unset($_SESSION['message_success_3']);
                      }
                      ?>
                    </div>
                    <div class='message_error'>
                      <?php
                      if (isset($_SESSION['message_error_3'])) {
                        echo $_SESSION['message_error_3'];
                        unset($_SESSION['message_error_3']);
                      }
                      ?>
                    </div>  
                  </div> 
                </div>
              </div>
            </div>
          </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer id='footer' class="sticky-footer bg-white">
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
          <form method="post" action="content/php/echelle/ajout_echelle_vraisemblance.php" class="user" id="formMission">
            <fieldset>
              <div class="form-group">
                <label class="titre_input" for="nom_echelle">Nom de l'échelle</label>
                <input type="text" class="perso_form shadow-none form-control form-control-user" name ="nom_echelle" id="nom_echelle"
                  placeholder="Nom de l'échelle" required>
              </div>

              <div class="form-group">
                <label for="SelectNaturePop">Valeur vraisemblance</label>
                <select class="form-control" name="nb_niveau_echelle" id="nb_niveau_echelle">
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
  <script src="content/js/modules/dateString.js"></script>
  <script src="content/js/modules/export_table_to_excel.js"></script>
  <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){    
  ?>
      <script src="content/js/modules/niveau_echelle_vraisemblance.js"></script>
      <script src="content/js/atelier/atelier4b.js"></script>
  <?php
      }
      else if(isset($userdroit['ecriture'])){
          if($userdroit['ecriture']=='Réalisation'){
  ?>
              <script src="content/js/modules/niveau_echelle_vraisemblance.js"></script>
              <script src="content/js/atelier/atelier4b.js"></script>
  <?php 
          }
          else{
  ?>
              <script src="content/js/modules/niveau_echelle_vraisemblance_no_modification.js"></script>
              <script src="content/js/atelier/atelier4b_no_modification.js"></script>
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