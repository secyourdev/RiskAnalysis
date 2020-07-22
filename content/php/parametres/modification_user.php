<?php
  session_start();
  $getid_utilisateur = $_SESSION['id_utilisateur'];

  include("../bdd/connexion.php");

  $results["error"] = false;

  $poste=$_POST['poste'];
  $email=$_POST['email'];

  $updateutilisateur = $bdd->prepare('UPDATE A_utilisateur SET poste = ?, email = ? WHERE id_utilisateur = ?');

    // Verification du poste
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
      $results["error"] = true;
      $_SESSION['message_error'] = "Poste invalide";
    }

    // Verification du email
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s.,-@]{1,100}$/", $email)){
        $results["error"] = true;
        $_SESSION['message_error'] = "E-mail invalide";
    }

    if ($results["error"] === false && isset($_POST['modifier_user'])){
        $updateutilisateur->bindParam(1, $poste);
        $updateutilisateur->bindParam(2, $email);
        $updateutilisateur->bindParam(3, $getid_utilisateur);
        $updateutilisateur->execute();
        $_SESSION['message_success'] = "Le profil a été bien modifié";
    }  

    header('Location: ../../../parametres&'.$_SESSION['id_utilisateur']);
?>