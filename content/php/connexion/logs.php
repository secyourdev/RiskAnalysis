<?php

  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v5;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

$results["error"] = false;
$results["message"] = [];

if (isset($_POST['connexion'])){
  $email = $_POST["email"];
  $mot_de_passe = $_POST["mot_de_passe"];

  $req = $bdd->prepare("SELECT email, mot_de_passe FROM utilisateur where email = :email");
  $req->execute([":email" => $email]);
  $row = $req->fetch();
    if($row){
      if(password_verify($mot_de_passe, $row["mot_de_passe"])){
        $results["error"] = false;
        $results["message"] = "Connexion accepte";
        ini_set('session.cookie_lifetime', 1*60);
        ini_get("session.gc_maxlifetime",60);
        ini_set("session.use_only_cookies", true);
        session_start();
        header('Location: ../../../atelier-1a');
      }
      else{
        $results["error"] = true;
        $results["message"] = "Email ou mot de passe incorect";
        header('Location: ../../../connexion.php?erreur=1');
      }
    }
    else{
      $results["error"] = true;
      $results["message"] = "Email ou mot de passe incorect";
      header('Location: ../../../connexion.php?erreur=1');
    }
  echo json_encode($results);
}
?>