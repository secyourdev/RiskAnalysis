<?php
session_start();
$getid_utilisateur = $_SESSION['id_utilisateur'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$email_modif_mdp = $_POST['email_modif_mdp'];
$nouveau_mdp=$_POST['nouveau_mdp'];
$confirmation_nouveau_mdp=$_POST['confirmation_nouveau_mdp'];

if (isset($_POST['modifier_mdp_user'])){
    $verification_mdp = $bdd->prepare("SELECT * FROM utilisateur where email=?");
    $verification_mdp->bindParam(1, $email_modif_mdp);
    $verification_mdp->execute();
    $resultat = $verification_mdp->fetch();

  if($nouveau_mdp==$confirmation_nouveau_mdp){
      $mot_de_passe = password_hash($confirmation_nouveau_mdp, PASSWORD_BCRYPT);
      $update_mdp = $bdd->prepare("UPDATE utilisateur SET mot_de_passe = ? WHERE email=?");
      $update_mdp->bindParam(1, $mot_de_passe);
      $update_mdp->bindParam(2, $email_modif_mdp);
      $update_mdp->execute();
      
      $prenom = $resultat["prenom"];
      $email = $resultat["email"];
      $expediteur = 'ebios-rm@alwaysdata.net';
      $objet = "Votre mot de passe Cyber Risk Manager vient d'être modifié !"; // Objet du message
      $headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
      $headers .= 'Content-type: text/html; charset=UTF-8'."\n"; // l'en-tete Content-type pour le format HTML
      $headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
      $headers .= 'From: "RiskManager"<'.$expediteur.'>'."\n"; // Expediteur
      $headers .= 'Delivered-to: '.$email."\n"; // Destinataire
      
      $message = '<div style="width: 100%; text-align: center; font-weight: bold">Bonjour '.$prenom.", </br> Votre mot de passe vient d'être modifié. </br> Si vous n'êtes pas responsable de cette modification, veuillez contacter votre Administrateur Logiciel !</div>";
      
      if (mail($email, $objet, $message, $headers)) {
          echo "Email envoyé avec succès à $email ...";
      } else {
          echo "Échec de l'envoi de l'email...";
      }

      $_SESSION['message_success_4'] = 'Mot de passe modifié !';
      
  }
  else 
      $_SESSION['message_error_4'] =  'La confirmation de votre mot de passe est erroné !';

header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
}
?>