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

  $reqdroit = $bdd->prepare('SELECT * FROM H_RACI WHERE id_utilisateur = ? AND id_projet = ? AND id_atelier="4.a"');
  $reqdroit->bindParam(1, $getid);
  $reqdroit->bindParam(2, $getidproject);
  $reqdroit->execute();
  $userdroit = $reqdroit->fetch();

  $reqdroit_chef_de_projet = $bdd->prepare('SELECT id_utilisateur FROM F_projet WHERE id_projet = ?');
  $reqdroit_chef_de_projet->bindParam(1, $getidproject);
  $reqdroit_chef_de_projet->execute();
  $userdroit_chef_de_projet = $reqdroit_chef_de_projet->fetch();
?>

  <?php include("content/php/atelier4a/selection.php"); ?>
  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CyberRiskManager">
    <meta name="author" content="SecYourDev">

    <title>CyberRiskManager | Atelier 4.a</title>

    <!-- Fonts-->
    <link href="content/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- CSS -->
    <link href="content/css/bootstrap.css" rel="stylesheet">
    <link href="content/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="content/vendor/bpmn-schema/assets/diagram-js.css">
    <link rel="stylesheet" href="content/vendor/bpmn-schema/assets/bpmn-font/css/bpmn.css">

    <!-- JS -->
    <script src="content/vendor/jquery/jquery.js"></script>
    <script src="content/vendor/jquery-tabledit/jquery.tabledit.js"></script>
    <script src="content/vendor/sheet-js/xlsx.full.min.js"></script>
    <script src="content/vendor/sheet-js/FileSaver.js"></script>
    <script src="content/vendor/bpmn-schema/bpmn-modeler.development.js"></script>
    <script type="text/javascript"> 
      var id_projet='<?php echo $_SESSION['id_projet'];?>' 
    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="content/img/logo_cyber_risk_manager.ico" type="image/x-icon">
    <link rel="icon" href="content/img/logo_cyber_risk_manager.png" type="image/png">
  </head>

  <?php
  if (isset($_SESSION['id_utilisateur']) and $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur']) {
    if(isset($userdroit['ecriture'])||$userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){
  ?>

      <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

          <!-- Left Sidebar -->
          <?php include("content\php\commun\menu_gauche.php");?>
          <!-- End of Left Sidebar -->

          <!-- Right Sidebar -->
          <ul id=menu>
            <li>
                <a class="nav-link collapse-right-item menu_float" href="#scenarios_strategiques">
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
                    <span class="nom_sous_menu">Scénarios stratégiques</span>
                </a>
            </li>
            <li>
                <a class="nav-link collapse-right-item menu_float" href="#scenario_operationnel">
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
                    <span class="nom_sous_menu">Scénario opérationnel</span>
                </a>
            </li>
            <li>
                <a class="nav-link collapse-right-item menu_float" href="#mode_operatoire">
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
                    <span class="nom_sous_menu">Mode opératoire</span>
                </a>
            </li>
            <li>
                <a class="nav-link collapse-right-item menu_float" href="#schema_scenarios_operationnels">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                            <g transform="translate(-1230 -689)">
                                <path class="number_activity active"
                                    d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z"
                                    transform="translate(1230 689)" fill="#ffffffcc" />
                                <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)"
                                    fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro"
                                    font-weight="700">
                                    <tspan x="-3.432" y="0">4</tspan>
                                </text>
                            </g>
                        </svg>
                    </i>
                    <span class="nom_sous_menu">Schéma des scénarios opérationnels</span>
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

                <div id="top_bar_1" class="top_bar_name_1"><?php echo $projectinfo['nom_projet']; ?></div>
                <div id="top_bar_2" class="top_bar_name_2">Atelier 4</div>
                <div id="top_bar_3" class="top_bar_name_3">Activité 4.a - Élaborer les scénarios opérationnels</div>

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

                  <!-- Area Card -->
                  <div id='scenarios_strategiques' class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="row perso_no_margin">
                          <div class="card-header col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                              <h6 class="m-0">Liste des scénarios stratégiques établis lors de l'atelier 3.b</h6>
                          </div>
                          <div class="card-header perso_header_right col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <a class="download_table_button" id="button_download_scenarios_strategiques">
                              <i class="fas fa-download fa-lg text-gray-400"></i>
                            </a>
                          </div>    
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        <!--text-->
                        <div class="table-responsive">
                          <input type="text" class="rechercher_input" id="rechercher_chemin" placeholder="Rechercher">
                          <table id="editable_table" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th id="id_scenario_strategique">ID scénario stratégique</th>
                                <th id="nom_scenario_strategique">Nom du scénario stratégique</th>
                                <th id="description_source_risque">Description source de risque</th>
                                <th id="objectif_vise">Objectifs visés</th>
                                <th id="evenement_redoute">Événements redoutés</th>
                                <th id="numero_risque">N° Risque</th>
                                <th id="chemin_attaque_strategiqu">Chemin d'attaques stratégiques</th>
                                <th id="gravite">Gravité</th>

                              </tr>
                            </thead>

                            <tbody>
                              <?php
                              while ($row = mysqli_fetch_array($result1)) {
                                echo '
                        <tr>
                        <td>' . $row["id_scenario_strategique"] . '</td>
                        <td>' . $row["nom_scenario_strategique"] . '</td>
                        <td>' . $row["description_source_de_risque"] . '</td>
                        <td>' . $row["objectif_vise"] . '</td>
                        <td>' . $row["nom_evenement_redoute"] . '</td>
                        <td>' . $row["id_risque"] . '</td>
                        <td>' . $row["nom_scenario_strategique"] . '</td>
                        <td>' . $row["niveau_de_gravite"] . '</td>
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
                  <div id="scenario_operationnel" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="row perso_no_margin">
                          <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                              <h6 class="m-0">Scénario opérationnel</h6>
                          </div>
                          <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <a class="download_table_button" id="button_download_scenario_operationnel">
                              <i class="fas fa-download fa-lg text-gray-400"></i>
                            </a>
                          </div>    
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        <!--text-->
                        <div class="table-responsive">
                          <table id="tableau_ope" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th id="id_chemin_attaque_strategique">ID chemin d'attaque strategique</th>
                                <th id="numero_risque">N° Risque</th>
                                <th id="chemin_attaque_strategique">Chemin d'attaque stratégique</th>
                                <th id="scenario_operationnel">Scénario opérationnel</th>
                                <th>Schéma</th>
                              </tr>
                            </thead>

                            <tbody>
                              <?php
                              while ($row = mysqli_fetch_array($result2)) {
                                echo '
                              <tr>
                              <td>' . $row["id_scenario_operationnel"] . '</td>
                              <td>' . $row["id_risque"] . '</td>
                              <td>' . $row["nom_chemin_d_attaque_strategique"] . '</td>
                              <td>' . $row["description_scenario_operationnel"] . '</td>
                              <td>  <a class="schema_button" data-toggle="modal" data-target="#button_schema_scenarios_operationnels">
                                      <i class="fas fa-project-diagram fa-md "></i>
                                    </a>
                              </td>
                              </tr>
                              ';
                              }
                              ?>
                            </tbody>
                          </table>
                          <div class='message_success'>
                            <?php
                            if (isset($_SESSION['message_success'])) {
                              echo $_SESSION['message_success'];
                              unset($_SESSION['message_success']);
                            }
                            ?>
                          </div>
                          <div class='message_error'>
                            <?php
                            if (isset($_SESSION['message_error'])) {
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
                  <div id="mode_operatoire" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="row perso_no_margin">
                          <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                              <h6 class="m-0">Mode opératoire</h6>
                          </div>
                          <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <a class="download_table_button" id="button_download_mode_operatoire">
                              <i class="fas fa-download fa-lg text-gray-400"></i>
                            </a>
                          </div>    
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                      <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){ 
                      ?> 
                              <!--text-->
                              <form method="post" action="content/php/atelier4a/ajout.php" class="user" id="formValeurMetierPop">
                                <fieldset>
                                  <div class="form-group">
                                    <label for="nomscenar">Choix du scénario opérationnel</label>
                                    <select class="form-control" name="nomscenar" id="nomscenar">
                                      <option value="" selected>...</option>
                                      <?php
                                      while ($row = mysqli_fetch_array($result3)) {
                                        echo '
                                        <option value="' . $row["id_scenario_operationnel"] . '">' . $row["description_scenario_operationnel"] . '</option>
                                        ';
                                      }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="modeope">Mode opératoire</label>
                                    <textarea class="form-control perso_text_area" name="modeope" id="modeope" rows="3"></textarea>
                                  </div>

                                  <div class='message_success'>
                                    <?php
                                    if (isset($_SESSION['message_success_2'])) {
                                      echo $_SESSION['message_success_2'];
                                      unset($_SESSION['message_success_2']);
                                    }
                                    ?>
                                  </div>
                                  <div class='message_error'>
                                    <?php
                                    if (isset($_SESSION['message_error_2'])) {
                                      echo $_SESSION['message_error_2'];
                                      unset($_SESSION['message_error_2']);
                                    }
                                    ?>
                                  </div>

                                  <!-- bouton Ajouter une nouvelle ligne -->
                                  <div class="modal-footer perso_middle_modal_footer">
                                    <input type="submit" name="validerope" value="Ajouter" class="btn perso_btn shadow-none"></input>
                                  </div>
                                </fieldset>
                              </form>
                        <?php
                              }
                              else if (isset($userdroit['ecriture'])){
                                if($userdroit['ecriture']=='Réalisation'){
                        ?>
                                  <!--text-->
                                  <form method="post" action="content/php/atelier4a/ajout.php" class="user" id="formValeurMetierPop">
                                    <fieldset>
                                      <div class="form-group">
                                        <label for="nomscenar">Choix du scénario opérationnel</label>
                                        <select class="form-control" name="nomscenar" id="nomscenar">
                                          <option value="" selected>...</option>
                                          <?php
                                          while ($row = mysqli_fetch_array($result3)) {
                                            echo '
                                            <option value="' . $row["id_scenario_operationnel"] . '">' . $row["description_scenario_operationnel"] . '</option>
                                            ';
                                          }
                                          ?>
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="modeope">Mode opératoire</label>
                                        <textarea class="form-control perso_text_area" name="modeope" id="modeope" rows="3"></textarea>
                                      </div>

                                      <div class='message_success'>
                                        <?php
                                        if (isset($_SESSION['message_success_2'])) {
                                          echo $_SESSION['message_success_2'];
                                          unset($_SESSION['message_success_2']);
                                        }
                                        ?>
                                      </div>
                                      <div class='message_error'>
                                        <?php
                                        if (isset($_SESSION['message_error_2'])) {
                                          echo $_SESSION['message_error_2'];
                                          unset($_SESSION['message_error_2']);
                                        }
                                        ?>
                                      </div>

                                      <!-- bouton Ajouter une nouvelle ligne -->
                                      <div class="modal-footer perso_middle_modal_footer">
                                        <input type="submit" name="validerope" value="Ajouter" class="btn perso_btn shadow-none"></input>
                                      </div>
                                    </fieldset>
                                  </form>
                          <?php
                                }
                              }                          
                          ?>

                        <div class="table-responsive">
                          <input type="text" class="rechercher_input" id="rechercher_mode_ope" placeholder="Rechercher">
                          <table id="tableau_mode_ope" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th id="id_mode_operatoire">ID scénario opérationnel</th>
                                <th id="scenario_operationnel">Scénario opérationnel</th>
                                <th id="mode_operatoire">Mode opératoire</th>

                              </tr>
                            </thead>

                            <tbody>
                              <?php
                              while ($row = mysqli_fetch_array($result4)) {
                                echo '
                              <tr>
                              <td>' . $row["id_mode_operatoire"] . '</td>
                              <td>' . $row["description_scenario_operationnel"] . '</td>
                              <td>' . $row["mode_operatoire"] . '</td>
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

<?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid||(isset($userdroit['ecriture'])&&$userdroit['ecriture']=='Réalisation')){ 
?> 
<!----------------------------------------------------------------------------------------------------------------- 
-------------------------------------- modal Ajout d'un schéma du scénario stratégique --------------------------------------
--------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade right" id="button_schema_scenarios_operationnels" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
        <div class="modal-content-full-width modal-content ">
            <div class=" modal-header-full-width   modal-header text-center">
                <h5 class="modal-title w-100" id="titre_schema">Schéma du scénario opérationnel</h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="canvas"></div>
              </div>
              <div class="modal-footer-full-width  modal-footer">
                  <!-- <button id="save-button" type="button" class="btn btn-primary btn-md btn-rounded">print to console</button> -->
                  <button id="browseFile" type="button" class="btn btn-primary btn-md btn-rounded" onclick="document.getElementById('inpFile').click();">Parcourir</button>
                  <button id="savefile" type="button" class="btn btn-primary btn-md btn-rounded">Enregistrer en .xml</button>
                  <button id="saveimage" type="button" class="btn btn-primary btn-md btn-rounded">Enregistrer en .svg</button>
                  <button id="savefilebdd" type="button" class="btn btn-primary btn-md btn-rounded">Enregistrer sur le serveur</button>
                  <input id="inpFile" class="custom-file-input" type="file" style="display:none;">
              </div>
        </div>
    </div>
</div> 
<!----------------------------------------------------------------------------------------------------------------- 
---------------------------------------------- modal choix valeur schéma ------------------------------------------
--------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" id="parametre_schema_scenarios_operationnels" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:3000">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titre_parametre_schema">Paramètres du scénario opérationnel</h5>
        <button id="choix_valeur_schema_close" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body perso_modal_body">
        <div class="form-group col-12">
          <label for="id_choix_value_schema">Valeur</label>
          <input type="text" class="perso_form shadow-none form-control form-control-user" name="id_conteneur" id="id_conteneur" required>
          <select class="form-control" name="id_choix_value_schema" id="id_choix_value_schema">
            <option value="" selected>...</option>
          </select>
        </div>

        <div class="modal-footer perso_middle_modal_footer">
          <button id="valider_choix_value" class="btn perso_btn_primary shadow-none">Modifier</button>
        </div>
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
        <script src="content/js/modules/schema.js"></script>
        <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){    
        ?>
            <script src="content/js/atelier/atelier4a.js"></script>
        <?php
            }
            else if(isset($userdroit['ecriture'])){
                if($userdroit['ecriture']=='Réalisation'){
        ?>
                    <script src="content/js/atelier/atelier4a.js"></script>
        <?php 
                }
                else{
        ?>
                    <script src="content/js/atelier/atelier4a_no_modification.js"></script>
        <?php
                }
            }        
        ?>
        <script src="content/js/modules/sort_table.js"></script>
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