<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CyberRiskManager">
  <meta name="author" content="SecYourDev">

  <title>CyberRiskManager | Connexion</title>

  <!-- Fonts-->
  <link href="content/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="content/css/bootstrap.css" rel="stylesheet">
  <link href="content/css/main.css" rel="stylesheet">
</head>


<body>
  <div class="container">
    <div class="row h-100 centreHorizontalement">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 align-self-center">

        <div class="perso_card mx-auto">
          <div class="theme-switch-wrapper">
            <label class="theme-switch" for="checkbox">
              <input class="perso_switch" type="checkbox" id="checkbox" />
              <div class="slider round"></div>
            </label>
          </div>

          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-5 perso_risk_manager">CYBER RISK MANAGER</h1>
          </div>
          <form method="post" action="content/php/connexion/logs.php" class="user" id="formConnexion">
           <fieldset>
            <div class="form-group">
              <input type="email" class="perso_form shadow-none form-control form-control-user" id="exampleInputEmail" name="email" aria-describedby="emailHelp"
                placeholder="Entrer une adresse email" required>
            </div>
            <div class="form-group">
              <input type="password" class="perso_form shadow-none form-control form-control-user" id="exampleInputPassword" name="mot_de_passe" placeholder="Mot de passe" required>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck">
                <label class="custom-control-label" for="customCheck">Se rappeler de moi</label>
              </div>
            </div> 
            <div class="perso_motdepass_center">
              <a class="perso_color_dark_blue" href="forgot-password.html">Mot de passe oublié?</a>
            </div>

            <div class="text-center">
              <input type="submit" name="connexion" value="Connexion" class="btn btn-primary perso_btn_primary"></input>
            </div>
           <fieldset>
          </form>

          <div class="perso_condition_center">
            <a class="perso_color_dark_blue" href="">Condition d'utilisation | Politique de confidentialité</a>
          </div>
        </div>
      </div>
    </div>

    <script src="content/js/modules/dark_mode.js"></script>
</body>