<?php
session_start();
$getid_utilisateur = $_SESSION['id_utilisateur'];

  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v17;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

$results["error"] = false;
$results["message"] = [];

$ancien_mdp=$_POST['ancien_mdp'];
$nouveau_mdp=$_POST['nouveau_mdp'];
$confirmation_nouveau_mdp=$_POST['confirmation_nouveau_mdp'];

if (isset($_POST['modifier_mdp_user'])){
    $verification_mdp = $bdd->prepare("SELECT * FROM utilisateur where id_utilisateur=?");
    $verification_mdp->bindParam(1, $getid_utilisateur);
    $verification_mdp->execute();
    $resultat = $verification_mdp->fetch();

    if(password_verify($ancien_mdp, $resultat["mot_de_passe"])){
        if($nouveau_mdp==$confirmation_nouveau_mdp){
            $mot_de_passe = password_hash($confirmation_nouveau_mdp, PASSWORD_BCRYPT);
            $update_mdp = $bdd->prepare("UPDATE utilisateur SET mot_de_passe = ? WHERE id_utilisateur=?");
            $update_mdp->bindParam(1, $mot_de_passe);
            $update_mdp->bindParam(2, $getid_utilisateur);
            $update_mdp->execute();
            echo 'Mot de passe modifié !';
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

            header('Location: ../../../parametres&'.$_SESSION['id_utilisateur']);
        }
        else 
            echo 'La confirmation de votre mot de passe est erroné !';
    }
    else
        echo 'Votre ancien mot de passe est erroné !';
}
?>