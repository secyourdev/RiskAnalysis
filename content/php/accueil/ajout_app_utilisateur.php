<?php
session_start();

  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v20;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

  $results["error"] = false;
  $results["message"] = [];

  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $poste=$_POST['poste'];
  $email=$_POST['email'];
  $type_compte=$_POST['type_compte'];

  $insertutilisateur = $bdd->prepare('INSERT INTO `utilisateur`(`id_utilisateur`, `nom`, `prenom`, `poste`, `email`, `mot_de_passe`, `type_compte`) VALUES (?,?,?,?,?,?,?)');

    function passgen1($nbChar) {
        $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
        srand((double)microtime()*1000000);
        $pass = '';
        for($i=0; $i<$nbChar; $i++){
            $pass .= $chaine[rand()%strlen($chaine)];
            }
        return $pass;
    }


    // Verification du nom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom)){
      $results["error"] = true;
      $results["message"]["nom"] = "Nom invalide";
      ?>
      <strong style="color:#FF6565;">Nom invalide </br></strong>
      <?php
    }

    // Verification du prenom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenom)){
      $results["error"] = true;
      $results["message"]["prenom"] = "Prenom invalide";
      ?>
      <strong style="color:#FF6565;">Prénom invalide </br></strong>
      <?php
    }

    // Verification du poste
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
      $results["error"] = true;
      $results["message"]["poste"] = "Poste invalide";
      ?>
      <strong style="color:#FF6565;">Poste invalide </br></strong>
      <?php
    }

    // Verification du email
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s.,-@]{1,100}$/", $email)){
        $results["error"] = true;
        $results["message"]["email"] = "E-mail invalide";
        ?>
        <strong style="color:#FF6565;">E-mail invalide </br></strong>
        <?php
    }

    // Verification du type de compte
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç@\s-]{1,100}$/", $type_compte)){
        $results["error"] = true;
        $results["message"]["type_compte"] = "Type de compte invalide";
        ?>
        <strong style="color:#FF6565;">Type de compte invalide </br></strong>
        <?php
    }
    
    $reqmail = $bdd->prepare("SELECT * FROM utilisateur where email = ?");
    $reqmail->execute(array($email));
    $mailexist = $reqmail->rowCount();
    if($mailexist!=0){
        $results["error"] = true;
        $results["message"]["verification_mail"] = "L'adresse mail existe déjà !";
        ?>
        <strong style="color:#FF6565;">L'adresse mail existe déjà !</br></strong>
        <?php
    }

    if ($results["error"] === false && isset($_POST['valider'])){
        $mot_de_passe = passgen1(20);

        $expediteur = 'ebios-rm@alwaysdata.net';
        $objet = 'Bienvenue sur RiskManager !'; // Objet du message
        $headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
        $headers .= 'Content-type: text/html; charset=UTF-8'."\n"; // l'en-tete Content-type pour le format HTML
        $headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
        $headers .= 'From: "RiskManager"<'.$expediteur.'>'."\n"; // Expediteur
        $headers .= 'Delivered-to: '.$email."\n"; // Destinataire
        $message = '<div style="width: 100%; text-align: center; font-weight: bold">Toute l\'equipe de RiskManager vous souhaite la bienvenue, '.$prenom.' ! </br> Votre identifiant est : '.$email.' </br> Votre mot de passe est : '.$mot_de_passe.' </div>';
        
        if (mail($email, $objet, $message, $headers)) {
            echo "Email envoyé avec succès à $email ...";
        } else {
            echo "Échec de l'envoi de l'email...";
        }

        $mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT);

        $insertutilisateur->bindParam(1, $id_utilisateur);
        $insertutilisateur->bindParam(2, $nom);
        $insertutilisateur->bindParam(3, $prenom);
        $insertutilisateur->bindParam(4, $poste);
        $insertutilisateur->bindParam(5, $email);
        $insertutilisateur->bindParam(6, $mot_de_passe);
        $insertutilisateur->bindParam(7, $type_compte);

        $insertutilisateur->execute();

        header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
        ?>
        <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
        <?php
    }



    
?>