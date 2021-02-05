<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_scenario_strategique = $_POST['id_scenario_strategique'];

// Verification de l'id scénario
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant scénario invalide";
}

$search_path_for_schema = $bdd->prepare("SELECT TA_EI.id_EI, TA_ER.id_ER, TA_ER.id_chemin FROM TA_EI INNER JOIN TA_ER ON TA_EI.id_chemin = TA_ER.id_chemin WHERE TA_EI.id_projet=? AND TA_EI.id_scenario_strategique=?");
$search_path_for_schema->bindParam(1, $get_id_projet);
$search_path_for_schema->bindParam(2, $id_scenario_strategique);
$search_path_for_schema->execute();

$ER_EI=$search_path_EI_ER_for_schema->fetch();

echo $ER_EI[0];
echo $ER_EI[1];

$search_gravite = $bdd->prepare("SELECT niveau_de_gravite FROM TA_ER INNER JOIN M_evenement_redoute ON TA_ER.id_evenement_redoute=M_evenement_redoute.id_evenement_redoute WHERE TA_ER.id_ER=?");
$search_gravite->bindParam(1, $ER_EI[1]);
$search_gravite->execute();

$gravite = $search_gravite->fetch();

$insere = $bdd->prepare("INSERT INTO T_chemin_d_attaque_strategique (id_risque,id_scenario_strategique,id_EI_1,id_ER_1,gravite,id_projet,id_atelier) VALUES (?,?,?,?,?,?,?)");

if (isset($id_scenario_strategique)&&isset($ER_EI[0])&&isset($ER_EI[1])&&isset($gravite[0])&&isset($get_id_projet)&&isset($id_atelier)&&$results["error"]!=true) {
    $insere->bindParam(1, $ER_EI[2]);
    $insere->bindParam(2, $id_scenario_strategique);
    $insere->bindParam(3, $ER_EI[0]);
    $insere->bindParam(4, $ER_EI[1]);
    $insere->bindParam(5, $gravite[0]);
    $insere->bindParam(6, $get_id_projet);
    $insere->bindParam(7, $id_atelier);
    $insere->execute();

    $results["error"] = false;
    $_SESSION['message_success'] = "Votre schéma a été correctement mise à jour !";
}
else{
    echo 'Erreur !';
}
// $array_ER_EI = array();

// while($ecriture_ER_EI = $search_path_EI_ER_for_schema->fetch()){
//     array_push($array_ER_EI,$ecriture_ER_EI);
// }

// echo json_encode($array_ER_EI);

?>

