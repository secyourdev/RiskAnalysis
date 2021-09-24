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

  $reqdroit = $bdd->prepare('SELECT * FROM H_RACI WHERE id_utilisateur = ? AND id_projet = ? AND id_atelier="3.a"');
  $reqdroit->bindParam(1, $getid);
  $reqdroit->bindParam(2, $getidproject);
  $reqdroit->execute();
  $userdroit = $reqdroit->fetch();

  $reqdroit_chef_de_projet = $bdd->prepare('SELECT id_utilisateur FROM F_projet WHERE id_projet = ?');
  $reqdroit_chef_de_projet->bindParam(1, $getidproject);
  $reqdroit_chef_de_projet->execute();
  $userdroit_chef_de_projet = $reqdroit_chef_de_projet->fetch();
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
    <script src="content/vendor/sheet-js/xlsx.full.min.js"></script>
    <script src="content/vendor/sheet-js/FileSaver.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="content/img/logo_cyber_risk_manager.ico" type="image/x-icon">
    <link rel="icon" href="content/img/logo_cyber_risk_manager.png" type="image/png">

    <!-- CHART.JS -->
    <script src="content\vendor\chart.js\chart.min.js"></script>
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
                <a class="nav-link collapse-right-item menu_float" href="#seuils">
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
                    <span class="nom_sous_menu">Seuils</span>
                </a>
            </li>
            <li>
                <a class="nav-link collapse-right-item menu_float" href="#partie_prenante">
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
                    <span class="nom_sous_menu">Partie prenante</span>
                </a>
            </li>
            <li>
                <a class="nav-link collapse-right-item menu_float" href="#cartographie_pp">
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
                    <span class="nom_sous_menu">Cartographie des parties prenantes</span>
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
                  <div id="seuils" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0">Création des seuils</h6>
                      </div>

                      <!-- Card Body -->
                      <div class="card-body">
                        <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){ 
                        ?>
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

                            <!-- bouton Ajouter -->
                            <div class="text-center">
                              <button type="submit" name="validerseuil" class="btn perso_btn_primary perso_btn_spacing shadow-none">Valider le seuil</button>
                            </div>
                          </fieldset>
                        </form>
                        <?php
                              }
                              else if (isset($userdroit['ecriture'])){
                                if($userdroit['ecriture']=='Réalisation'){
                        ?>
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

                                  <!-- bouton Ajouter -->
                                  <div class="text-center">
                                    <button type="submit" name="validerseuil" class="btn perso_btn_primary perso_btn_spacing shadow-none">Valider le seuil</button>
                                  </div>
                                </fieldset>
                              </form>
                        <?php
                                }
                                else {                       
                        ?>
                                  <div class="form-group">
                                    <label class="titre_input" for="seuil_danger">Seuil de danger :</label>
                                    <label class="no_modification" id="seuil_danger"></label>
                                  </div>
                                  <div class="form-group">
                                    <label class="titre_input" for="seuil_controle">Seuil de contrôle : </label>
                                    <label class="no_modification" id="seuil_controle"></label>
                                  </div>
                                  <div class="form-group">
                                    <label class="titre_input" for="seuil_veille">Seuil de veille :</label>
                                    <label class="no_modification" id="seuil_veille"></label>
                                  </div>

                        <?php
                                }
                              }                          
                        ?>
                      </div>
                    </div>
                  </div>

                  <!-- Area Card -->
                  <div id="partie_prenante" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="row perso_no_margin">
                          <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                              <h6 class="m-0">Parties prenantes</h6>
                          </div>
                          <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <a class="download_table_button" id="button_download_parties_prenantes">
                              <i class="fas fa-download fa-lg text-gray-400"></i>
                            </a>
                          </div>    
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
                                <th>Criticite</th>
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
                        <td>' . $row["criticite"] . '</td>
                        </tr>
                        ';
                              }
                              ?>
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
                                  <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_partie_prenante">Ajouter une partie prenante</button>
                                </div>
                        <?php
                              }
                              else if (isset($userdroit['ecriture'])){
                                if($userdroit['ecriture']=='Réalisation'){
                        ?>
                                  <!-- bouton Ajouter une nouvelle ligne -->
                                  <div class="text-center">
                                    <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_partie_prenante">Ajouter une partie prenante</button>
                                  </div>
                        <?php
                                }
                              }                          
                        ?>
                      </div>
                    </div>
                  </div>

                  <!-- Area Card -->
                  <div id="cartographie_pp" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
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

                          <img class="img_legende" src="content/img/legende_carto.png">

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
          <!---------------------------------------------------------------------------------------------------------------- 
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
                          <label class="titre_input" for="categorie_partie_prenante">Catégorie</label>
                            <input type="texte" class="perso_arrow perso_form shadow-none form-control" list="categorie_pop" name="categorie_partie_prenante" id="categorie_partie_prenante" placeholder="Catégorie" required>
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
                            <label class="titre_input" for="nom_partie_prenante">Nom de la partie prenante</label>
                            <input type="text" class="perso_form shadow-none form-control form-control-user" name="nom_partie_prenante" id="nom_partie_prenante" placeholder="Nom de la partie prenante" required>
                          </div>

                          <div class="form-group">
                            <label for="criticite">Criticité</label>
                            <select class="form-control" name="criticite" id="criticite">
                              <option value="" selected>...</option>
                              <option value="Pas critique">Pas critique</option>
                              <option value="Critique">Critique</option>
                            </select>
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
                                if ($i == 1) {
                                  echo '
                                  <label class="btn perso_checkbox shadow-none active">
                                    <input type="radio" id="dependance' . $i . '" autocomplete="off" name="dependance_partie_prenante" value="' . $i . '" selected> ' . $i . '
                                  </label>';
                                } else {
                                  echo '
                                  <label class="btn perso_checkbox shadow-none">
                                    <input type="radio" id="dependance' . $i . '" autocomplete="off" name="dependance_partie_prenante" value="' . $i . '"> ' . $i . '
                                  </label>';
                                }
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
                                if ($i == 1) {
                                  echo '
                                  <label class="btn perso_checkbox shadow-none active">
                                    <input type="radio" id="penetration' . $i . '" autocomplete="off" name="penetration_partie_prenante" value="' . $i . '" selected> ' . $i . '
                                  </label>';
                                } else {
                                  echo '
                                  <label class="btn perso_checkbox shadow-none">
                                    <input type="radio" id="penetration' . $i . '" autocomplete="off" name="penetration_partie_prenante" value="' . $i . '" > ' . $i . '
                                  </label>';
                                }
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
                                if ($i == 1) {
                                  echo '
                                  <label class="btn perso_checkbox shadow-none active">
                                    <input type="radio" id="maturite' . $i . '" autocomplete="off" name="maturite_partie_prenante" value="' . $i . '" selected> ' . $i . '
                                  </label>';
                                } else {
                                  echo '
                                  <label class="btn perso_checkbox shadow-none">
                                    <input type="radio" id="maturite' . $i . '" autocomplete="off" name="maturite_partie_prenante" value="' . $i . '"> ' . $i . '
                                  </label>';
                                }
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
                                if ($i == 1) {
                                  echo '
                                  <label class="btn perso_checkbox shadow-none active">
                                    <input type="radio" id="confiance' . $i . '" autocomplete="off" name="confiance_partie_prenante" value="' . $i . '" selected> ' . $i . '
                                  </label>';
                                } else {
                                  echo '
                                  <label class="btn perso_checkbox shadow-none">
                                    <input type="radio" id="confiance' . $i . '" autocomplete="off" name="confiance_partie_prenante" value="' . $i . '"> ' . $i . '
                                  </label>';
                                }
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
          <?php
          }
          ?>


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
          <script src="content/js/modules/dateString.js"></script>
          <script src="content/js/modules/export_table_to_excel.js"></script>
          <?php if($userinfo['type_compte']=='Administrateur Logiciel'||$userdroit_chef_de_projet['id_utilisateur']==$getid){    
          ?>
              <script src="content/js/atelier/atelier3a.js"></script>
          <?php
              }
              else if(isset($userdroit['ecriture'])){
                  if($userdroit['ecriture']=='Réalisation'){
          ?>
                      <script src="content/js/atelier/atelier3a.js"></script>
          <?php 
                  }
                  else{
          ?>
                      <script src="content/js/atelier/atelier3a_no_modification.js"></script>
          <?php
                  }
              }        
          ?>
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