<?php
//header('Location: ../../../atelier-1a');
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$acteur_id = $_POST['acteur_id'];
$atelier_num = $_POST['atelier_num'];
$raci_value = $_POST['raci_value'];

$update_raci = $bdd->prepare("UPDATE H_RACI SET ecriture = ? WHERE id_utilisateur = ? AND id_atelier = ? AND id_projet= ?");
$update_raci->bindParam(1, $raci_value);
$update_raci->bindParam(2, $acteur_id);
$update_raci->bindParam(3, $atelier_num);
$update_raci->bindParam(4, $getid_projet);
$update_raci->execute();

?>