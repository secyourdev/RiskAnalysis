<?php
session_start();
include("../bdd/connexion.php");
$get_id_projet = $_SESSION['id_projet'];

$input = filter_input_array(INPUT_POST);
// seul le champ identifier est envoyé en POST pour edit et delete
$id_traitement = $_POST['id_traitement_de_securite'];
$results["error"] = false;
$results["message"] = [];

$id_atelier = "5.b";

// Récupérer id de la mesure
$recupere_mesure = $bdd->prepare("SELECT `id_mesure` FROM `ZA_traitement_de_securite` WHERE `id_traitement_de_securite`=? AND `id_projet`=? AND `id_atelier`=?");
$recupere_mesure->bindParam(1, $id_traitement);
$recupere_mesure->bindParam(2, $get_id_projet);
$recupere_mesure->bindParam(3, $id_atelier);
$recupere_mesure->execute();
$id_mesure = $recupere_mesure->fetch();

if ($input["action"] === 'edit') {
    // Récupérer les éléments en POST accessible uniquement pour edit.
    $principe = $_POST['principe_de_securite'];
    $responsable = $_POST['responsable'];
    $difficulte = $_POST['difficulte_traitement_de_securite'];
    $cout = $_POST['cout_traitement_de_securite'];
    $date = $_POST['date_traitement_de_securite'];
    $statut = $_POST['statut'];
    $nom_mesure = $_POST['nom_mesure'];
    $description_mesure = $_POST['description_mesure'];

    // Verification du principe
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $principe)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Principe invalide";
    }

    // Verification du responsable
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $responsable)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Responsable invalide";
    }

    // Verification des difficultés
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $difficulte)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Difficulté invalide";
    }

    // Verification des coûts
    if (!preg_match("/^[+]{0,100}$/", $cout)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Coût invalide";
    }

    // Verification de la date
    if (!preg_match("/^[0-9\s-]{0,100}$/", $date)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Date invalide";
    }

    // Verification du statut
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $statut)) {
        $results["error"] = true;
        $_SESSION['message_error'] = "Statut invalide";
    }

    if ($results["error"] === false) {
        // Mettre à jour le traitement de securite
        $update = $bdd->prepare("UPDATE `ZA_traitement_de_securite` SET `principe_de_securite`=?, `responsable`=?, `difficulte_traitement_de_securite`=?, `cout_traitement_de_securite`=?, `date_traitement_de_securite`=?, `statut`=? WHERE `id_traitement_de_securite`=?");
        $update->bindParam(1, $principe);
        $update->bindParam(2, $responsable);
        $update->bindParam(3, $difficulte);
        $update->bindParam(4, $cout);
        $update->bindParam(5, $date);
        $update->bindParam(6, $statut);
        $update->bindParam(7, $input["id_traitement_de_securite"]);
        $update->execute();

        // Mettre à jour la mesure de sécurité
        $update_mesure = $bdd->prepare("UPDATE `Y_mesure` SET `nom_mesure`=?, `description_mesure`=? WHERE `id_mesure`=?");
        $update_mesure->bindParam(1, $nom_mesure);
        $update_mesure->bindParam(2, $description_mesure);
        $update_mesure->bindParam(3, $id_mesure[0]);
        $update_mesure->execute();
      
        // $_SESSION['message_success'] = "La mesure de sécurité a été correctement modifiée !";
    }
}

if ($input["action"] === 'delete') {

    // Effacer le traitement
    $delete3 = $bdd->prepare("DELETE FROM `ZA_traitement_de_securite` WHERE `id_traitement_de_securite`=? AND `id_projet`=? AND `id_mesure`=?");
    $delete3->bindParam(1, $id_traitement);
    $delete3->bindParam(2, $get_id_projet);
    $delete3->bindParam(3, $id_mesure[0]);
    $delete3->execute();

    // Effacer la mesure du chemin
    $delete1 = $bdd->prepare("DELETE FROM `ZB_comporter_2` WHERE `id_mesure`=?");
    $delete1->bindParam(1, $id_mesure[0]);
    $delete1->execute();
    
    // Effacer la mesure
    $delete2 = $bdd->prepare("DELETE FROM `Y_mesure` WHERE `id_mesure`=?");
    $delete2->bindParam(1, $id_mesure[0]);
    $delete2->execute();

    $_SESSION['message_success'] = "La mesure de sécurité a été correctement supprimée !";
}


echo json_encode($input);

?>