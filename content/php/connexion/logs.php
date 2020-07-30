<?php
session_start();

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

if (isset($_POST['connexion'])){
  $email = htmlspecialchars($_POST["email"]);
  $mot_de_passe = $_POST["mot_de_passe"];

  $req = $bdd->prepare("SELECT * FROM A_utilisateur where email = :email");
  $req->execute([":email" => $email]);
  $row = $req->fetch();
    if($row){
      if(password_verify($mot_de_passe, $row["mot_de_passe"])){
        $results["error"] = false;
        $results["message"] = "Connexion accepté";
        //$_SESSION['message_success'] = "Connexion acceptée";
        $_SESSION['id_utilisateur'] = $row['id_utilisateur'];
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION['email'] = $row['email'];
        header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
      }
      else{
        $results["error"] = true;
        $results["message"] = "Email ou mot de passe incorect";
        $_SESSION['message_error'] = "Email ou mot de passe incorect";
        header('Location: ../../../connexion.php?erreur=1');
      }
    }
    else{
      $results["error"] = true;
      $results["message"] = "Email ou mot de passe incorect";
      $_SESSION['message_error'] = "Email ou mot de passe incorect";
      header('Location: ../../../connexion.php?erreur=1');
    }
  echo json_encode($results);
}
?>