<?php
session_start();

include("../bdd/connexion.php");

if(isset($_POST['envoyer'])){
    $email_utilisateur=$_POST['email_utilisateur'];

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

    $user_info = $bdd->prepare("SELECT prenom FROM A_utilisateur where email=?");
    $user_info->bindParam(1, $email_utilisateur);
    $user_info->execute();
    $resultat = $user_info->fetch();
    $prenom = $resultat["prenom"];
    $email = $email_utilisateur;

    if($resultat){
        $expediteur = 'ebios-rm@alwaysdata.net';
        $objet = 'Voici votre nouveau mot de passe !'; // Objet du message
        $headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
        $headers .= 'Content-type: text/html; charset=UTF-8'."\n"; // l'en-tete Content-type pour le format HTML
        $headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
        $headers .= 'From: "RiskManager"<'.$expediteur.'>'."\n"; // Expediteur
        $headers .= 'Delivered-to: '.$email."\n"; // Destinataire
        $message = '<div style="width: 100%; text-align: center; font-weight: bold">Bonjour, '.$prenom.' ! </br> Votre identifiant est : '.$email.' </br> Votre nouveau mot de passe est : '.$mot_de_passe." </br> Si vous n'êtes pas responsable de cette modification, veuillez contacter votre Administrateur Logiciel !</div>";

        if (mail($email, $objet, $message, $headers)) {
            $_SESSION['message_success'] = "Email de réinitialisation de mot de passe envoyé avec succès à $email !";
        } 

        $mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT);


        $update_mdp = $bdd->prepare("UPDATE A_utilisateur SET mot_de_passe = ? WHERE email=?");
        $update_mdp->bindParam(1, $mot_de_passe);
        $update_mdp->bindParam(2, $email_utilisateur);
        $update_mdp->execute();
    }
    else {
        $_SESSION['message_error'] = "Échec de l'envoi de l'email...";
    }

    header('Location: ../../../connexion');
}
?>