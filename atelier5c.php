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

  $reqdroit = $bdd->prepare('SELECT * FROM H_RACI WHERE id_utilisateur = ? AND id_projet = ? AND id_atelier="5.c"');
  $reqdroit->bindParam(1, $getid);
  $reqdroit->bindParam(2, $getidproject);
  $reqdroit->execute();
  $userdroit = $reqdroit->fetch();

  $reqdroit_chef_de_projet = $bdd->prepare('SELECT id_utilisateur FROM F_projet WHERE id_projet = ?');
  $reqdroit_chef_de_projet->bindParam(1, $getidproject);
  $reqdroit_chef_de_projet->execute();
  $userdroit_chef_de_projet = $reqdroit_chef_de_projet->fetch();
?>

  <?php include("content/php/atelier5c/selection.php"); ?>
  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CyberRiskManager">
    <meta name="author" content="SecYourDev">

    <title>CyberRiskManager | Atelier 5.c</title>

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
    <script src="content/js/modules/html2canvas.js"></script>
    <script src="content/js/modules/canvas2image.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="content/img/logo_cyber_risk_manager.ico" type="image/x-icon">
    <link rel="icon" href="content/img/logo_cyber_risk_manager.png" type="image/png">
  </head>

  <?php
  if (isset($_SESSION['id_utilisateur']) and $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur']) {
    if (isset($userdroit['ecriture']) || $userinfo['type_compte'] == 'Administrateur Logiciel' || $userdroit_chef_de_projet['id_utilisateur'] == $getid) {
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
              <a class="nav-link collapse-right-item menu_float" href="#evaluation_risques_residuels">
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
                <span class="nom_sous_menu">Évaluation et documentation des risques résiduels</span>
              </a>
            </li>
            <li>
              <a class="nav-link collapse-right-item menu_float" href="#cartographie_risque_initial">
                <i>
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                    <g transform="translate(-1230 -689)">
                      <path class="number_activity active" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc" />
                      <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                        <tspan x="-3.432" y="0">2</tspan>
                      </text>
                    </g>
                  </svg>
                </i>
                <span class="nom_sous_menu">Cartographie du risque initial</span>
              </a>
            </li>
            <li>
              <a class="nav-link collapse-right-item menu_float" href="#cartographie_risque_residuel">
                <i>
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 25 25">
                    <g transform="translate(-1230 -689)">
                      <path class="number_activity active" d="M12.5,0A12.5,12.5,0,1,1,0,12.5,12.5,12.5,0,0,1,12.5,0Z" transform="translate(1230 689)" fill="#ffffffcc" />
                      <text class="number_activity_text" data-name="1" transform="translate(1242.5 706.19)" fill="#394c7a" font-size="13" font-family="SourceSansPro-Bold, Source Sans Pro" font-weight="700">
                        <tspan x="-3.432" y="0">3</tspan>
                      </text>
                    </g>
                  </svg>
                </i>
                <span class="nom_sous_menu">Cartographie du risque résiduel</span>
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

                <div id="top_bar_1" class="top_bar_name_1"><?php echo $projectinfo['nom_projet']; ?></div>
                <div id="top_bar_2" class="top_bar_name_2">Atelier 5</div>
                <div id="top_bar_3" class="top_bar_name_3">Activité 5.c - Évaluer et documenter les risques résiduels</div>

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
                        <p>Le but de cet atelier est de réaliser une synthèse des scénarios de risque identifiés et de définir une stratégie de traitement du risque. Cette stratégie aboutit à la définition de mesures de
                          sécurité, recensées dans un plan d'amélioration continue de la sécurité (PACS). Les risques résiduels sont ensuite identifiés ainsi que le cadre de suivi de ces risques.
                        </p>
                        <!--text-->
                      </div>
                    </div>
                  </div>

                  <!-- Area Card -->
                  <div id="evaluation_risques_residuels" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="row perso_no_margin">
                          <div class="card-header col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                              <h6 class="m-0">Évaluation et documentation des risques résiduels</h6>
                          </div>
                          <div class="card-header perso_header_right col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <a class="download_table_button" id="button_download_evaluation_documentation_risques_risiduels">
                              <i class="fas fa-download fa-lg text-gray-400"></i>
                            </a>
                          </div>    
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        <div class="table-responsive">
                          <input type="text" class="rechercher_input" id="rechercher_srov" placeholder="Rechercher">
                          <table id="editable_table" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Nom du risque</th>
                                <th>Évenement redouté</th>
                                <th>Mesure de sécurité</th>
                                <th>Gravité initiale</th>
                                <th>Vraisemblance initiale</th>
                                <th>Risque initial</th>
                                <th>Nom du risque résiduel</th>
                                <th>Description du risque résiduel</th>
                                <th>Vraisemblance résiduelle</th>
                                <th>Risque résiduel</th>
                                <th>Gestion du risque résiduel</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              
                              while ($row = mysqli_fetch_array($result)) {
                                $risque = $row["vraisemblance"] * $row["niveau_de_gravite"];
                                echo '
                                <tr>
                                <td>' . $row["id_revaluation"] . '</td>
                                <td>' . $row["nom_chemin_d_attaque_strategique"] . '</td>
                                <td>' . $row["nom_evenement_redoute"] . '</td>
                                <td>' . $row["nom_mesure"] . '</td>
                                <td>' . $row["niveau_de_gravite"] . '</td>
                                <td>' . $row["vraisemblance"] . '</td>
                                <td>' . $risque . '</td>
                                <td>' . $row["nom_risque_residuelle"] . '</td>
                                <td>' . $row["description_risque_residuelle"] . '</td>
                                <td>' . $row["vraisemblance_residuelle"] . '</td>
                                <td>' . $row["risque_residuel"] . '</td>
                                <td>' . $row["gestion_risque_residuelle"] . '</td>
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
                  <div id="cartographie_risque_initial" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="row perso_no_margin">
                        <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <h6 class="m-0">Cartographie du risque initial</h6>
                        </div>
                        <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          <a class="download_table_button" id="btn-Convert-Html2Image_avant">
                              <i class="fas fa-download fa-lg text-gray-400"></i>
                          </a>
                        </div>    
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        <!--text-->
                        <div class="table-responsive">
                          <table class="table table-bordered perso_border" id="dataTable_avant" width="100%" cellspacing="0">
                            <tbody class="perso_heatmap">
                              <tr>
                                <td class="perso_border texte-droite">Gravité</td>
                                <td class="perso_border"></td>
                                <td class="perso_border"></td>
                                <td class="perso_border"></td>
                                <td class="perso_border"></td>
                                <td class="perso_border"></td>
                                <td class="perso_border"></td>
                              </tr>
                              <tr>
                                <td class="perso_border texte-droite">5</td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="perso_border">
                                  <div></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="perso_border texte-droite">4</td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="perso_border">
                                  <div></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="perso_border texte-droite">3</td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="perso_border">
                                  <div></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="perso_border texte-droite">2</td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="perso_border">
                                  <div></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="perso_border texte-droite">1</td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="perso_border">
                                  <div></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="perso_border"></td>
                                <td class="perso_border">1</td>
                                <td class="perso_border">2</td>
                                <td class="perso_border">3</td>
                                <td class="perso_border">4</td>
                                <td class="perso_border">5</td>
                                <td class="perso_border texte-gauche">Vraisemblance</td>
                              </tr>


                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="cartographie_risque_residuel" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="row perso_no_margin">
                        <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <h6 class="m-0">Cartographie du risque résiduel</h6>
                        </div>
                        <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          <a class="download_table_button" id="btn-Convert-Html2Image_apres">
                              <i class="fas fa-download fa-lg text-gray-400"></i>
                          </a>
                        </div>    
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        <!--text-->
                        <div class="table-responsive">
                          <table class="table table-bordered perso_border" id="dataTable_apres" width="100%" cellspacing="0">
                            <tbody class="perso_heatmap">
                              <tr>
                                <td class="perso_border texte-droite">Gravité</td>
                                <td class="perso_border"></td>
                                <td class="perso_border"></td>
                                <td class="perso_border"></td>
                                <td class="perso_border"></td>
                                <td class="perso_border"></td>
                                <td class="perso_border"></td>
                              </tr>
                              <tr>
                                <td class="perso_border texte-droite">5</td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="perso_border">
                                  <div></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="perso_border texte-droite">4</td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="perso_border">
                                  <div></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="perso_border texte-droite">3</td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="perso_border">
                                  <div></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="perso_border texte-droite">2</td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="perso_border">
                                  <div></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="perso_border texte-droite">1</td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="">
                                  <div></div>
                                </td>
                                <td class="perso_border">
                                  <div></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="perso_border"></td>
                                <td class="perso_border">1</td>
                                <td class="perso_border">2</td>
                                <td class="perso_border">3</td>
                                <td class="perso_border">4</td>
                                <td class="perso_border">5</td>
                                <td class="perso_border texte-gauche">Vraisemblance</td>
                              </tr>
                            </tbody>
                          </table>
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

          <!-- -------------------------------------------------------------------------------------------------------------- 
          ----------------------------------------- modal ajout de ligne ----------------------------------------------------
          --------------------------------------------------------------------------------------------------------------- -->
          <div class="modal fade" id="ajout_vraisemblance_résiduelle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ajout de la vraisemblance résiduelle</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body perso_modal_body">
                  <form class="user" id="formvraisemblance">
                    <div class="row">
                      <div class="form-group centre-vraisemblance col-12">
                        <div>
                          <input type="radio" id="Invraisemblable" name="Vraisemblance" value="Invraisemblable">
                          <label for="Invraisemblable">Invraisemblable</label>
                        </div>
                        <div class="texte-vraisemblance">La source de risque a très peu de chances d'atteindre son objectif visé en
                          empruntant l'un des modes opératoires envisagés.<br>
                          La vraisemblance du scénario de risque est très faible
                        </div>
                        <div>
                          <input type="radio" id="Peu vraisemblable" name="Vraisemblance" value="Peu Vraisemblable">
                          <label for="Peu vraisemblable">Peu vraisemblable</label>
                        </div>
                        <div class="texte-vraisemblance">La source de risque a relativement peu de chances d'atteidre son objectif en
                          empruntant l'un des modes opératoires envisagé.<br>
                          La vraisemblance du scénario de risque est faible.
                        </div>
                        <div>
                          <input type="radio" id="Vraisemblable" name="Vraisemblance" value="Vrasemblable">
                          <label for="Vraisemblable">Vraisemblable</label>
                        </div>
                        <div class="texte-vraisemblance">
                          La source de rsique est susceptible d'atteidre son objectif en empruntant
                          l'un des modes opératoires envisagés. <br>
                          La vraisemblance du scénario de risque est significative.
                        </div>
                        <div>
                          <input type="radio" id="Très vraisemblable" name="Vraisemblance" value="Très vraisemblable">
                          <label for="Très vraisemblable">Très vraisemblable</label>
                        </div>
                        <div class="texte-vraisemblance">
                          La source de risque va probablement atteindre son objectif en empruntant
                          l'un des modes opératoires envisagés.<br>
                          La vraisemblance du scénario de risque est élevée.
                        </div>
                        <div>
                          <input type="radio" id="Quasi certain" name="Vraisemblance" value="Quasi certain">
                          <label for="Quasi certain">Quasi certain</label>
                        </div>
                        <div class="texte-vraisemblance">
                          La source de risque va très certainement atteindre son objectif en empruntant
                          l'un des modes opératoires envisagés.<br>
                          La vraisemblance du scénario de risque est très élevée
                        </div>

                      </div>
                    </div>
                </div>
                <!-- bouton Ajouter -->
                <div class="modal-footer perso_middle_modal_footer">
                  <button type="button" class="btn perso_btn_primary shadow-none">Ajouter</button>
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
          <script src="content/js/modules/merge_line_on_table.js"></script>
          <script src="content/js/modules/dateString.js"></script>
          <script src="content/js/modules/export_table_to_excel.js"></script>
          <?php if ($userinfo['type_compte'] == 'Administrateur Logiciel' || $userdroit_chef_de_projet['id_utilisateur'] == $getid) {
          ?>
            <script src="content/js/atelier/atelier5c.js"></script>
            <?php
          } else if (isset($userdroit['ecriture'])) {
            if ($userdroit['ecriture'] == 'Réalisation') {
            ?>
              <script src="content/js/atelier/atelier5c.js"></script>
            <?php
            } else {
            ?>
              <script src="content/js/atelier/atelier5c_no_modification.js"></script>
          <?php
            }
          }
          ?>
          <script src="content/js/modules/sort_table.js"></script>
          <script src="content/js/atelier/5cheatmapavant.js"></script>
          <script src="content/js/atelier/5cheatmapapres.js"></script>
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