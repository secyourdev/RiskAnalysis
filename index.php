<?php
session_start();

//Connexion à la base de donnee
try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v6;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
}

if(isset($_GET['id_utilisateur']) AND $_GET['id_utilisateur'] > 0){
    $getid = intval($_GET['id_utilisateur']);
    $requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id_utilisateur = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
?>

<?php include("content/php/atelier1a/selection.php");?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="RiskManager">
  <meta name="author" content="SecYourDev">

  <title>RiskManager | Tableau de bord</title>

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

<?php 
if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur'])
{
?>
  
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
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Tableau de Bord</span></a>
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
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
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
          <div class="row" id="projets" >
          </div>
          <div class="text-center">
            <button type="button" class="btn perso_btn_primary perso_btn_spacing shadow-none" data-toggle="modal" data-target="#ajout_projet">Créer un nouveau projet</button>
          </div>
      </div>
      <!-- End of Main Content -->
      </br>
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

<!-------------------------------------------------------------------------------------------------------------- 
--------------------------------------- modal creation d'un projet ---------------------------------------------
---------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="ajout_projet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Création d'un projet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body perso_modal_body">
          <form method="post" action="content/php/accueil/ajout_projet.php">
            <fieldset>
              <!--NOM ETUDE-->
              <div class="form-group">
                <label class="titre_input" for="nom_etude">Nom</label>
                <input type="text" class="perso_form shadow-none form-control form-control-user" name="nom_etude" id="nom_etude" placeholder="Nom" required></input>
              </div>
              
              <!--OBJECTIF ETUDE-->
              <div class="form-group">
                <label class="titre_textarea" for="objectif_atteindre">Objectif à atteindre</label>
                <textarea class="form-control perso_text_area" name="objectif_atteindre" id="objectif_atteindre" rows="3"></textarea>
              </div>
                    
              <!--CADRE TEMPOREL ETUDE-->
              <div class="form-group">
                <label class="titre_input" for="cadre_temporel">Cadre Temporel</label>
                <input type="date" class="perso_form shadow-none form-control form-control-user" name="cadre_temporel" id="cadre_temporel" placeholder="Cadre temporel" required>
              </div>

              <!--RISQUE ETUDE-->
              <div class="form-group">
                <label class="titre_input" for="respo_acceptation_risque">Personne responsable d'accepter les risques résiduels au terme de l'étude</label>
                <input type="text" class="perso_arrow perso_form shadow-none form-control" list="liste_respo_acceptation_risque" name="respo_acceptation_risque"
                  placeholder="..." required>
                <datalist id="liste_respo_acceptation_risque">
                  <option>Directeur</option>
                  <option>RSSI</option>
                  <option>Responsable Informatique</option>
                </datalist>
              </div>
                  
              <!--BAREME VRAISEMBLANCE-->
              <div class="card-header gravite col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="radio_gravite4" name="radio_gravite" class="custom-control-input" value="4">
                  <label class="custom-control-label" for="radio_gravite4">Gravité sur 4</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="radio_gravite5" name="radio_gravite" class="custom-control-input" value="5">
                  <label class="custom-control-label" for="radio_gravite5">Gravité sur 5</label>
                </div>
                <div class="perso_icon_btn custom-control-inline" data-container="body" data-trigger="hover focus" data-toggle="popover" data-placement="bottom" data-content="Ce choix engendre automatiquement le même barème sur vraisemblance ! ">
                  <i class="fas fa-info-circle"></i>
                </div>
              </div>
          
              <div class="modal-footer perso_middle_modal_footer">
                <input type="submit" name="ajouter_projet" value="Ajouter" class="btn perso_btn shadow-none"></input>
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
        <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à terminer votre session en cours.</div>
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
  <script>
    $.ajax({
        url: 'content/php/accueil/selection_projet.php',
        type: 'POST',
        dataType : 'html',
        success: function (resultat) {
            var projet_JSON = JSON.parse(resultat);
            var lenght_projet = projet_JSON.length; 
            for(let i=0;i<lenght_projet;i++){
                var projets = document.getElementById('projets');

                var div1 = document.createElement('div');
                div1.setAttribute('class','col-xl-6 col-lg-6')

                var div2 = document.createElement('div');
                div2.setAttribute('class','card shadow mb-4')
                
                var form = document.createElement('form')
                form.setAttribute('method','post')
                form.setAttribute('action','content/php/accueil/search_project.php')

                var fieldset = document.createElement('fieldset')

                var input_text = document.createElement('input')
                input_text.setAttribute('type','hidden')
                input_text.setAttribute('id','id_projet'+i)
                input_text.setAttribute('name','id_projet')
                input_text.value = projet_JSON[i][0]
            
                var div_input = document.createElement('div')
                div_input.setAttribute('class','text-center')

                var input = document.createElement('input')
                input.setAttribute('type','submit')
                input.setAttribute('name','search_project')
                input.setAttribute('value','Ouvrir')
                input.setAttribute('class','btn perso_btn_primary perso_btn_spacing shadow-none')
                
                var a = document.createElement('a');
                a.setAttribute('href','content/php/accueil/search_project.php')

                var div3 = document.createElement('div')
                div3.setAttribute('class','card-header d-flex flex-row align-items-center justify-content-between')

                var h6 = document.createElement('h6')
                h6.setAttribute('class','m-0')
                h6.innerHTML='Projet #'+projet_JSON[i][0]+" : "+projet_JSON[i][1] 

                var div4 = document.createElement('div')
                div4.setAttribute('class','card-body')

                var label = document.createElement('label')
                label.innerHTML=projet_JSON[i][2]

                var label2 = document.createElement('label')
                label2.innerHTML='Date de fin du projet : ' + projet_JSON[i][5]

                var br = document.createElement('br')

                div4.appendChild(label)
                div4.appendChild(br)
                div4.appendChild(label2)
                div3.appendChild(h6)
                form.appendChild(fieldset)
                fieldset.appendChild(div3)
                fieldset.appendChild(div4)
                div4.appendChild(input_text)
                div_input.appendChild(input)
                div4.appendChild(div_input)
                div2.appendChild(form)
                div1.appendChild(div2)
                projets.appendChild(div1)
            }
        },
        error : function(erreur){
            alert('ERROR :'+erreur);
        }
    }); 
  </script>

<script src='content/js/accueil/index.js'> </script>
<script src="content/js/modules/help_button.js"></script>

</body>
<?php
}
else{
  header('Location: connexion.php');
}
?>
</html>
<?php
}
else{
  header('Location: connexion.php');
}
?>