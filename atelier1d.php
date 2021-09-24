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

  $reqdroit = $bdd->prepare('SELECT * FROM H_RACI WHERE id_utilisateur = ? AND id_projet = ? AND id_atelier="1.d"');
  $reqdroit->bindParam(1, $getid);
  $reqdroit->bindParam(2, $getidproject);
  $reqdroit->execute();
  $userdroit = $reqdroit->fetch();

  $reqdroit_chef_de_projet = $bdd->prepare('SELECT id_utilisateur FROM F_projet WHERE id_projet = ?');
  $reqdroit_chef_de_projet->bindParam(1, $getidproject);
  $reqdroit_chef_de_projet->execute();
  $userdroit_chef_de_projet = $reqdroit_chef_de_projet->fetch();
?>

  <?php include("content/php/atelier1d/selection.php"); ?>
  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CyberRiskManager">
    <meta name="author" content="SecYourDev">

    <title>CyberRiskManager | Atelier 1.d</title>

    <!-- Fonts-->
    <link href="content/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- CSS -->
    <link href="content/css/bootstrap.css" rel="stylesheet">
    <link href="content/css/main.css" rel="stylesheet">

    <!-- JS -->
    <script src="content/vendor/jquery/jquery.js"></script>
    <script src="content/vendor/jquery-tabledit/jquery.tabledit1d.js"></script>
    <script src="content/vendor/sheet-js/xlsx.full.min.js"></script>
    <script src="content/vendor/sheet-js/FileSaver.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="content/img/logo_cyber_risk_manager.ico" type="image/x-icon">
    <link rel="icon" href="content/img/logo_cyber_risk_manager.png" type="image/png">
  </head>

  <?php
  if (isset($_SESSION['id_utilisateur']) and $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur'])
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
                <a class="nav-link collapse-right-item menu_float" href="#socle">
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
                    <span class="nom_sous_menu">Socle de sécurité</span>
                </a>
            </li>
            <li>
                <a class="nav-link collapse-right-item menu_float" href="#regles">
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
                    <span class="nom_sous_menu">Règles</span>
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
                <div id="top_bar_2" class="top_bar_name_2">Atelier 1</div>
                <div id="top_bar_3" class="top_bar_name_3">Activité 1.d - Le socle de sécurité</div>

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


                  <!-- Area Card -->
                  <!-- Socle de sécurité -->
                  <div id="socle" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="row perso_no_margin">
                          <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                              <h6 class="m-0">Socle de sécurité</h6>
                          </div>
                          <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <a class="download_table_button" id="button_download_socle_de_securite">
                              <i class="fas fa-download fa-lg text-gray-400"></i>
                            </a>
                          </div>    
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        <!--tableau-->
                        <div class="table-responsive">
                          <input type="text" class="rechercher_input" id="rechercher_socle" placeholder="Rechercher">
                          <table id="editable_table_socle" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Type de référentiel</th>
                                <th>Nom du référentiel</th>
                                <th>État d'application</th>
                                <th>Commentaire</th>
                              </tr>
                            </thead>
                            <tbody id="ecrire_socle">
                              <?php
                              while ($row = mysqli_fetch_array($result_socle)) {
                                echo '
                                <tr>
                                <td>' . $row["id_socle_securite"] . '</td>
                                <td>' . $row["type_referentiel"] . '</td>
                                <td>' . $row["nom_referentiel"] . '</td>
                                <td>' . $row["etat_d_application"] . '</td>
                                <td>' . $row["etat_de_la_conformite"] . '</td>
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
                                <div class="row">
                                  <!-- bouton Ajouter une nouvelle ligne -->
                                  <div class="text-center col-lg-6">
                                    <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_socle_de_securite">Importer un nouveau référentiel de sécurité</button>
                                  </div>
                                  <!-- bouton Ajouter une nouvelle ligne -->
                                  <div class="text-center col-lg-6">
                                    <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_socle_de_securite_main">Créer un nouveau référentiel de sécurité</button>
                                  </div>
                                </div>
                        <?php
                              }
                              else if (isset($userdroit['ecriture'])){
                                if($userdroit['ecriture']=='Réalisation'){
                        ?>   
                                  <div class="row">
                                    <!-- bouton Ajouter une nouvelle ligne -->
                                    <div class="text-center col-lg-6">
                                      <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_socle_de_securite">Importer un nouveau référentiel de sécurité</button>
                                    </div>
                                    <!-- bouton Ajouter une nouvelle ligne -->
                                    <div class="text-center col-lg-6">
                                      <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_socle_de_securite_main">Créer un nouveau référentiel de sécurité</button>
                                    </div>
                                  </div>
                          <?php
                                }
                              }                          
                          ?>
                      </div>
                    </div>
                  </div>

                  <!-- Area Card -->
                  <!-- Écarts -->
                  <div id="regles" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="row perso_no_margin">
                          <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                              <h6 class="m-0">Règles</h6>
                          </div>
                          <!-- <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <a class="download_table_button" id="button_download_regles">
                              <i class="fas fa-download fa-lg text-gray-400"></i>
                            </a>
                          </div>-->
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        <div class="form-group">

                          <label for="nomreferentiel">Nom du référentiel de sécurité</label>
                          <select class="form-control" name="nomreferentiel" id="nomreferentiel">
                            <option value="" selected>...</option>
                            <?php
                            while ($row = mysqli_fetch_array($result_nom_referentiel)) //selection.php
                            {
                              echo '
                        <option id="socle_securite" value="' . $row['nom_referentiel'] . '">' . $row['nom_referentiel'] . '</option>
                        ';
                            }
                            ?>
                          </select>

                        </div>
                        <!--tableau-->
                        <div class="table-responsive">
                          <input type="text" class="rechercher_input" id="rechercher_ecart" placeholder="Rechercher">
                          <table id="editable_table_ecart" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>ID de la règle</th>
                                <th>Titre de la règle</th>
                                <th>Description de la règle</th>
                                <th>État de la règle</th>
                                <th>Justification des écarts</th>
                                <th>Responsable</th>
                                <th>Date limite de la mise en application</th>
                              </tr>
                            </thead>
                            <tbody id="ecrire_ecart">
                            </tbody>
                          </table>
                        </div>

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

                        <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){ 
                        ?> 
                                <!-- bouton Ajouter une nouvelle ligne -->
                                <div class="text-center">
                                  <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_ecart">Ajouter une nouvelle règle</button>
                                </div>
                        <?php
                              }
                              else if (isset($userdroit['ecriture'])){
                                if($userdroit['ecriture']=='Réalisation'){
                        ?>   
                                <!-- bouton Ajouter une nouvelle ligne -->
                                <div class="text-center">
                                  <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_ecart">Ajouter une nouvelle règle</button>
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
<!------------------------------------------------------------------------------------------------------------------ 
--------------------------------------- modal ajout socle de sécurité ----------------------------------------------
-------------------------------------------------------------------------------------------------------------------->
          <div class="modal fade" id="ajout_socle_de_securite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ajout d'un socle de sécurité</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body perso_modal_body">

                  <div class="panel panel-default">

                    <div class="panel-body">
                      <span id="success_message"></span>
                      <form method="post" id="sample_form">

                        <div class="custom-file">
                          <input name="userfile" id="fileToUpload" class="custom-file-input" type="file">
                          <label class="custom-file-label" for="fileToUpload">Choisir un fichier au format JSON</label>
                        </div>

                        <div class="form-group" align="center">
                          <input type="submit" name="file_submit" id="file_submit" class="btn perso_btn_primary shadow-none" value="Ajouter un fichier" />
                        </div>

                        <div class="form-group" align="center">
                          <img id="ajax-loader" src="content/img/ajax-loader.gif" style="display: none">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<!----------------------------------------------------------------------------------------------------------------------- 
--------------------------------------- modal créer socle de sécurité main ----------------------------------------------
------------------------------------------------------------------------------------------------------------------------->
          <div class="modal fade" id="ajout_socle_de_securite_main" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ajout d'un socle de sécurité</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body perso_modal_body">
                  <form method="post" action="content/php/atelier1d/ajout_socle.php" class="user" id="formSoclePop">
                    <fieldset>

                      <div class="form-group">
                        <label class="titre_input" for="type_referenciel">Type de référentiel</label>
                        <input type="text" class="perso_form shadow-none form-control form-control-user" name="type_referenciel" id="type_referenciel" placeholder="Type de référentiel" required>
                      </div>
                      <div class="form-group">
                        <label class="titre_input" for="nom_referentiel">Nom du référentiel</label>
                        <input type="text" class="perso_form shadow-none form-control form-control-user" name="nom_referentiel" id="nom_referentiel" placeholder="Nom du référentiel" required>
                      </div>
                      <div class="form-group">
                        <label for="Select_etat_d_application">État d'application</label>
                        <select class="form-control" name="etat_d_application" id="Select_etat_d_application">
                          <option value="" selected>...</option>
                          <option value="Non appliqué">Non appliqué</option>
                          <option value="Appliqué sans restriction">Appliqué sans restriction</option>
                          <option value="Appliqué avec restriction">Appliqué avec restriction</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="titre_input" for="commentaire">Commentaire</label>
                        <input type="text" class="perso_form shadow-none form-control form-control-user" name="commentaire" id="commentaire" placeholder="Commentaire" required>
                      </div>

                      <div class="modal-footer perso_middle_modal_footer">
                        <input type="submit" name="validersocle" value="Ajouter" class="btn perso_btn_primary shadow-none"></input>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>

  <!---------------------------------------------------------------------------------------------------------------- 
  --------------------------------------- modal Ajout d'une règle --------------------------------------------------
  ----------------------------------------------------------------------------------------------------------------->
          <div class="modal fade" id="ajout_ecart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ajout d'une règle</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body perso_modal_body">
                  <form method="post" action="content/php/atelier1d/ajout_regle.php" class="user" id="formecartPop">
                    <fieldset>
                      <input type="hidden" name="nom_socle" id="nom_socle" value="">
                      <div class="form-group">
                        <label class="titre_input" for="id_regle">ID de la régle</label>
                        <input type="text" class="perso_form shadow-none form-control form-control-user" name="id_regle" id="id_regle" placeholder="ID de la règle" required>
                      </div>

                      <div class="form-group">
                        <label for="titre_regle">Titre de la règle</label>
                        <textarea class="form-control perso_text_area" name="titre_regle" id="titre_regle" rows="3"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control perso_text_area" name="description" id="description" rows="3"></textarea>
                      </div>

                      <div class="modal-footer perso_middle_modal_footer">
                        <input type="submit" name="validerecart" value="Ajouter" class="btn perso_btn_primary shadow-none"></input>
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
          <script src="content/js/modules/side_bar.js"></script>.
          <script src="content/js/modules/float_menu.js"></script>
          <script src="content/js/modules/fixed_page.js"></script>
          <script src="content/js/modules/realtime.js"></script>
          <script src="content/js/modules/set_filter_sort_table.js"></script>
          <script src="content/js/modules/dateString.js"></script>
          <script src="content/js/modules/export_table_to_excel.js"></script>
          <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){    
          ?>
                  <script src="content/js/atelier/atelier1d.js"></script>
                  <script src="content/js/modules/browse.js"></script>
                  <script src="content/js/modules/parser.js"></script>
                  <script src="content/js/modules/socle_pour_regle.js"></script>
          <?php
                }
                else if(isset($userdroit['ecriture'])){
                  if($userdroit['ecriture']=='Réalisation'){
          ?>   
                    <script src="content/js/atelier/atelier1d.js"></script>
                    <script src="content/js/modules/browse.js"></script>
                    <script src="content/js/modules/parser.js"></script>
                    <script src="content/js/modules/socle_pour_regle.js"></script>
          <?php 
                  }
                  else{
          ?>     
                    <script src="content/js/atelier/atelier1d_no_modification.js"></script>
                    <script src="content/js/modules/socle_pour_regle_no_modification.js"></script>
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