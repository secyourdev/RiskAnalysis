<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$acteur_id = $_POST['acteur_id'];
$raci_value = $_POST['raci_value'];

$update_raci = $bdd->prepare("UPDATE H_RACI SET ecriture = ? WHERE id_utilisateur = ? AND id_projet= ?");
$update_raci->bindParam(1, $raci_value);
$update_raci->bindParam(2, $acteur_id);
$update_raci->bindParam(3, $getid_projet);
$update_raci->execute();

?>