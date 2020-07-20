<?php
session_start();

//Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v21;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

$id_utilisateur=$_POST['id_utilisateur'];

function passgen1($nbChar) {
    $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
    srand((double)microtime()*1000000);
    $pass = '';
    for($i=0; $i<$nbChar; $i++){
        $pass .= $chaine[rand()%strlen($chaine)];
        }
    return $pass;
}

$mot_de_passe = passgen1(20);

$user_info = $bdd->prepare("SELECT prenom,email FROM utilisateur where id_utilisateur=?");
$user_info->bindParam(1, $id_utilisateur);
$user_info->execute();
$resultat = $user_info->fetch();
$prenom = $resultat["prenom"];
$email = $resultat["email"];

$expediteur = 'ebios-rm@alwaysdata.net';
$objet = 'Voici votre nouveau mot de passe !'; // Objet du message
$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
$headers .= 'Content-type: text/html; charset=UTF-8'."\n"; // l'en-tete Content-type pour le format HTML
$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
$headers .= 'From: "RiskManager"<'.$expediteur.'>'."\n"; // Expediteur
$headers .= 'Delivered-to: '.$email."\n"; // Destinataire
$message = '<div style="width: 100%; text-align: center; font-weight: bold">Bonjour, '.$prenom.' ! </br> Votre identifiant est : '.$email.' </br> Votre nouveau mot de passe est : '.$mot_de_passe.' </div>';

if (mail($email, $objet, $message, $headers)) {
    echo "Email envoyé avec succès à $email ...";
} else {
    echo "Échec de l'envoi de l'email...";
}

$mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT);


$update_mdp = $bdd->prepare("UPDATE utilisateur SET mot_de_passe = ? WHERE id_utilisateur=?");
$update_mdp->bindParam(1, $mot_de_passe);
$update_mdp->bindParam(2, $id_utilisateur);
$update_mdp->execute();
$_SESSION['message_success_4'] = 'Mot de passe modifié !';°

//header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
        
?>