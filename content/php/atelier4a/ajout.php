<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v18;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$results["error"] = false;
$results["message"] = [];

$idscenar = $_POST['nomscenar'];
$modeope = $_POST['modeope'];
$id_mode_operatoire = "id_mode_operatoire";

$insere = $bdd->prepare('INSERT INTO `mode_operatoire`(`id_mode_operatoire`, `mode_operatoire`, `id_scenario_operationnel`) VALUES (?,?,?)');

// Verification du mode operatoire
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $modeope)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Mode operatoire invalide";
}

if ($results["error"] === false && isset($_POST['validerope'])) {
  $insere->bindParam(1, $id_mode_operatoire);
  $insere->bindParam(2, $modeope);
  $insere->bindParam(3, $idscenar);
  $insere->execute();
  $_SESSION['message_success'] = "Le mode operatoire a bien été ajoutée !";
}

header('Location: ../../../atelier-4a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);
?>