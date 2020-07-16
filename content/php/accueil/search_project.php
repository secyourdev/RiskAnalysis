<?php
session_start();
//Connexion à la base de donnee
try {
    $bdd = new PDO(
      'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v20;charset=utf8',
      'ebios-rm',
      'hLLFL\bsF|&[8=m8q-$j',
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
  } catch (PDOException $e) {
    die('Erreur :' . $e->getMessage());
  }

$id_projet=htmlspecialchars($_POST['id_projet']);

$req = $bdd->prepare("SELECT * FROM projet where id_projet = :id_projet");
$req->execute([":id_projet" => $id_projet]);
$row = $req->fetch();

if($row){
    $_SESSION['id_projet'] = $row['id_projet'];
    header('Location: ../../../atelier-1a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);
}
else {
    header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
}


?>