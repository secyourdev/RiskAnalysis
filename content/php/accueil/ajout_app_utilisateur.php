<?php
session_start();

include("../bdd/connexion.php");

  $results["error"] = false;

  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $poste=$_POST['poste'];
  $email=$_POST['email'];
  $type_compte=$_POST['type_compte'];

  $insertutilisateur = $bdd->prepare('INSERT INTO `A_utilisateur`(`id_utilisateur`, `nom`, `prenom`, `poste`, `email`, `mot_de_passe`, `type_compte`) VALUES (?,?,?,?,?,?,?)');

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
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{1,100}$/", $nom)){
      $results["error"] = true;
      $_SESSION['message_error_4'] = "Nom invalide";
    }

    // Verification du prenom
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{1,100}$/", $prenom)){
      $results["error"] = true;
      $_SESSION['message_error_4'] = "Prenom invalide";
    }

    // Verification du poste
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{1,100}$/", $poste)){
      $results["error"] = true;
      $_SESSION['message_error_4'] = "Poste invalide";
    }

    // Verification du email
    if(!preg_match("/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", $email)){
        $results["error"] = true;
        $_SESSION['message_error_4'] = "E-mail invalide";
    }

    // Verification du type de compte
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{1,100}$/", $type_compte)){
        $results["error"] = true;
        $_SESSION['message_error_4'] = "Type de compte invalide";
    }
    
    $reqmail = $bdd->prepare("SELECT * FROM A_utilisateur where email = ?");
    $reqmail->execute(array($email));
    $mailexist = $reqmail->rowCount();
    if($mailexist!=0){
        $results["error"] = true;
        $_SESSION['message_error_4'] = "L'adresse mail existe déjà !";
    }

    if ($results["error"] === false && isset($_POST['valider'])){
        $mot_de_passe = passgen1(20);

        $expediteur = 'ebios-rm@alwaysdata.net';
        $objet = '[CYB-5101C | ESIEE Paris] Bienvenue sur RiskManager !'; // Objet du message
        $headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
        $headers .= 'Content-type: text/html; charset=UTF-8'."\n"; // l'en-tete Content-type pour le format HTML
        $headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
        $headers .= 'From: "RiskManager"<'.$expediteur.'>'."\n"; // Expediteur
        $headers .= 'Delivered-to: '.$email."\n"; // Destinataire
        $headers .= 'Bcc: joyston.antonraveendran@edu.esiee.fr' . "\r\n";
        $headers .= 'Bcc: carlos.pinto@secyourdev.com' . "\r\n";
        $message = '<div style="width: 100%; text-align: center; font-weight: bold">Toute l\'equipe de RiskManager vous souhaite la bienvenue, '.$prenom.' ! </br> Votre identifiant est : '.$email.'. </br> Votre mot de passe est : '.$mot_de_passe.'. Rendez-vous sur https://yeswesec.com/RiskAnalysis </div>';
        
        if (mail($email, $objet, $message, $headers)) {
          $_SESSION['message_success_4'] = "Email envoyé avec succès à $email ...";
        } else {
          $_SESSION['message_error_4'] = "Échec de l'envoi de l'email...";
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

        $_SESSION['message_success_4'] = "L'utilisateur a bien été ajouté !";
    }

    header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
   
?>