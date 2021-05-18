<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;

$nomvm = $_POST['nomvm'];
$nature = $_POST['nature'];
$descriptionvm = $_POST['descriptionvm'];

$id_atelier = "1.b";

$inserevm = $bdd->prepare('INSERT INTO J_valeur_metier(nom_valeur_metier, nature_valeur_metier, description_valeur_metier, id_atelier, id_projet) VALUES (?,?,?,?,?)');


// Verification du nom de la valeur métier
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nomvm)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "Nom invalide";
}

// Verification de la description de la valeur métier
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $descriptionvm)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "Description invalide";
}

// Verification de la nature de la valeur métier
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nature)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "Nature invalide";
}

if ($results["error"] === false && isset($_POST['validervm'])) {
   $inserevm->bindParam(1, $nomvm);
  $inserevm->bindParam(2, $nature);
  $inserevm->bindParam(3, $descriptionvm);
  $inserevm->bindParam(4, $id_atelier);
  $inserevm->bindParam(5, $getid_projet);
  $inserevm->execute();

  $_SESSION['message_success_2'] = "La valeur métier a bien été ajoutée !";
}
header('Location: ../../../atelier-1b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#valeur_metier');
?>