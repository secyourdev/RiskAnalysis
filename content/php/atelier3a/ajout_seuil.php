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
  "UPDATE Q_seuil SET seuil_danger=?,seuil_controle=?,seuil_veille=? WHERE id_projet=?");

// Verification du seuil_danger
if (!preg_match("/^([0-9]|1[0-6])$/", $seuil_danger)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "seuil_danger invalide";
}
// Verification du seuil_controle
if (!preg_match("/^([0-9]|1[0-6])$/", $seuil_controle)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "seuil_controle invalide";
}
// Verification du seuil_veille
if (!preg_match("/^([0-9]|1[0-6])$/", $seuil_veille)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "seuil_veille invalide";
}

if ($results["error"] === false && isset($_POST['validerseuil'])) {

  $insere->bindParam(1, $seuil_danger);
  $insere->bindParam(2, $seuil_controle);
  $insere->bindParam(3, $seuil_veille);
  $insere->bindParam(4, $id_projet);
  $insere->execute();
  $_SESSION['message_success_2'] = "La règle a bien été ajoutée !";

?>
  <strong style="color:#4AD991;">Le seuil a bien été ajoutée !</br></strong>
<?php
}
header('Location: ../../../atelier-3a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#chemin_dattaque');
?>