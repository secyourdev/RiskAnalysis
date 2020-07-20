<?php
session_start();

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$seuil_danger = $_POST['seuil_danger'];
$seuil_controle = $_POST['seuil_controle'];
$seuil_veille = $_POST['seuil_veille'];

$id_atelier = '3.a';
$id_projet = $_SESSION['id_projet'];

$insere = $bdd->prepare(
  "UPDATE seuil SET seuil_danger=?,seuil_controle=?,seuil_veille=? WHERE id_projet=?");

// Verification du seuil_danger
if (!preg_match("/^[1-9][0-9]?$|^100$/", $seuil_danger)) {
  $results["error"] = true;
  $results["message"]["seuil_danger"] = "seuil_danger invalide";
?>
  <strong style="color:#FF6565;">seuil_danger invalide </br></strong>
<?php
}
// Verification du seuil_controle
if (!preg_match("/^[1-9][0-9]?$|^100$/", $seuil_controle)) {
  $results["error"] = true;
  $results["message"]["seuil_controle"] = "seuil_controle invalide";
?>
  <strong style="color:#FF6565;">seuil_controle invalide </br></strong>
<?php
}
// Verification du seuil_veille
if (!preg_match("/^[1-9][0-9]?$|^100$/", $seuil_veille)) {
  $results["error"] = true;
  $results["message"]["seuil_veille"] = "seuil_veille invalide";
?>
  <strong style="color:#FF6565;">seuil_veille invalide </br></strong>
<?php
}

if ($results["error"] === false && isset($_POST['validerseuil'])) {

  $insere->bindParam(1, $seuil_danger);
  $insere->bindParam(2, $seuil_controle);
  $insere->bindParam(3, $seuil_veille);
  $insere->bindParam(4, $id_projet);
  $insere->execute();

?>
  <strong style="color:#4AD991;">Le seuil a bien été ajoutée !</br></strong>
<?php
}
header('Location: ../../../atelier-3a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#chemin_dattaque');
?>