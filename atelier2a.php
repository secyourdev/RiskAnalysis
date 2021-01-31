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

    $reqdroit = $bdd->prepare('SELECT * FROM H_RACI WHERE id_utilisateur = ? AND id_projet = ? AND id_atelier="2.a"');
    $reqdroit->bindParam(1, $getid);
    $reqdroit->bindParam(2, $getidproject);
    $reqdroit->execute();
    $userdroit = $reqdroit->fetch();

    $reqdroit_chef_de_projet = $bdd->prepare('SELECT id_utilisateur FROM F_projet WHERE id_projet = ?');
    $reqdroit_chef_de_projet->bindParam(1, $getidproject);
    $reqdroit_chef_de_projet->execute();
    $userdroit_chef_de_projet = $reqdroit_chef_de_projet->fetch();
?>

<?php include("content/php/atelier2a/selection.php");?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CyberRiskManager">
  <meta name="author" content="SecYourDev">

  <title>CyberRiskManager | Atelier 2.a</title>

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
    <?php include("content\php\commun\menu_gauche.php");?>
    <!-- End of Left Sidebar -->

    <!-- Right Sidebar -->
    <ul id=menu>
      <li>
          <a class="nav-link collapse-right-item menu_float" href="#srov">
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
              <span class="nom_sous_menu">Sources de risque et objectifs visés</span>
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
          <div id="top_bar_3" class="top_bar_name_3">Activité 2.a - Identifier les sources de risques et les objectifs</div>
          
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
          <!-- Page Heading -->
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
            <div id="srov" class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="row perso_no_margin">
                    <div class="card-header col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <h6 class="m-0">Sources de risque et objectifs visés</h6>
                    </div>
                    <div class="card-header perso_header_right col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      <a class="download_table_button" id="button_download_SROV">
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
                          <th id="id_srov">ID SROV</th>
                          <th id="type_attaquant">Type d'attaquant</th>
                          <th id="profil_d_attaquant">Profil d'attaquant</th>
                          <th id="description_source_risque">Description source de risque</th>
                          <th id="objectif vise">Objectif visé</th>
                          <th id="description_objectif">Description de l'objectif</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      while($row = mysqli_fetch_array($result))
                      {
                        echo '
                        <tr>
                        <td>'.$row["id_source_de_risque"].'</td>
                        <td>'.$row["type_d_attaquant_source_de_risque"].'</td>
                        <td>'.$row["profil_de_l_attaquant_source_de_risque"].'</td>
                        <td>'.$row["description_source_de_risque"].'</td>
                        <td>'.$row["objectif_vise"].'</td>
                        <td>'.$row["description_objectif_vise"].'</td>
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
                            <button type="button" class="btn perso_btn_primary shadow-none btn-bougé" data-toggle="modal" data-target="#ajout_ligne_sr">Ajouter un couple Source de Menace / Objecif visé</button>
                          </div> 
                          <?php
                        }
                        else if (isset($userdroit['ecriture'])){
                            if($userdroit['ecriture']=='Réalisation'){
                  ?>    
                            <!-- bouton Ajouter une nouvelle ligne -->
                            <div class="text-center">
                              <button type="button" class="btn perso_btn_primary shadow-none btn-bougé" data-toggle="modal" data-target="#ajout_ligne_sr">Ajouter un couple Source de Menace / Objecif visé</button>
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
<!-- -------------------------------------------------------------------------------------------------------------- 
----------------------------------------- modal ajout de ligne ----------------------------------------------------
--------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" id="ajout_ligne_sr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajout d'une source de risque</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body perso_modal_body">
        <form method="post" action="content/php/atelier2a/ajout.php" class="user" id="formsrov">
          <fieldset>
            <div class="row">
              <div class="col-6">
              <label for="type_attaquant">Type d'attaquant</label>
              <select class="form-control" name="type_attaquant" id="type_attaquant">
                  <option value="" selected>...</option>
                  <option value="Organisation structurée">Organisation structurée</option>
                  <option value="Organisation idéologique">Organisation idéologique</option>
                  <option value="Individu isolé">Individu isolé</option>
                </select>
              
                <div class="form-group form-colonne">
                <label class="titre_input" for="profil_attaquant">Profil d'attaquant</label>
                  <input type="text" class="perso_arrow perso_form shadow-none form-control" list="Profil d'attaquant" name="profil_attaquant" id="profil_attaquant" placeholder="Profil d'attaquant" autocomplete="off" required>
                  <datalist id="Profil d'attaquant">
                    <option value="Etatique">
                    <option value="Crime organisé">
                    <option value="Terroriste">
                    <option value="Activiste idéologique">
                    <option value="Officine spécialisée">
                    <option value="Amateur">
                    <option value="Vengeur">
                    <option value="Malveillant pathologique">
                  </datalist>
                </div>
              </div>

              <div class="form-group col-6">
                <label for="description_sr">Description de la source de risque</label>
                <textarea class="form-control perso_text_area" id="description_sr" name="description_sr"rows="5"></textarea>
              </div>
            </div>
            <div class="row">
              <!-- <div class="form-group col-12">
                <input type="text" class="perso_form shadow-none form-control form-control-user" id="objectif_vise" name="objectif_vise"
                  placeholder="Objectif visé" required>
              </div> -->
              <div class="form-group form-colonne col-12">
              <label class="titre_input" for="objectif_vise">Objectif vise</label>
                  <input type="text" class="perso_arrow perso_form shadow-none form-control" list="Objectif visé" name="objectif_vise" id="objectif_vise" placeholder="Objectif visé" autocomplete="off" required>
                  <datalist id="Objectif visé">
                    <option value="Espionnage">
                    <option value="Prépositionnement stratégique">
                    <option value="Influence">
                    <option value="Entrave au fonctionnement">
                    <option value="Lucratif">
                    <option value="Défi, amusement">
                  </datalist>
                </div>

              <div class="form-group col-12">
                <label for="description_objectif_viseDescription de l'objectif visé">Description de l'objectif visé</label>
                <textarea class="form-control perso_text_area" id="description_objectif_vise" name="description_objectif_vise" rows="3"></textarea>
              </div>
            </div>
            <!-- bouton Ajouter -->
            <div class="modal-footer perso_middle_modal_footer">
              <input type="submit" name="validersrov" value="Ajouter" class="btn perso_btn shadow-none"></input>
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
        <script src="content/js/atelier/atelier2a.js"></script>
    <?php
        }
        else if(isset($userdroit['ecriture'])){
            if($userdroit['ecriture']=='Réalisation'){
    ?>
                <script src="content/js/atelier/atelier2a.js"></script>
    <?php 
            }
            else{
    ?>
                <script src="content/js/atelier/atelier2a_no_modification.js"></script>
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