<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$type= false;

$id_fleche = $_POST['id_fleche'];
$valeur_chemin = $_POST['valeur_chemin'];
$id_evenement_redoute = $_POST['id_evenement_redoute'];
$id_scenario_strategique = $_POST['id_scenario_strategique'];
$id_source = $_POST['id_source'];
$id_schema_source = $_POST['id_schema_source'];
$type_source = $_POST['type_source'];
$id_destination = $_POST['id_destination'];
$id_schema_destination = $_POST['id_schema_destination'];
$type_destination = $_POST['type_destination'];
$id_chemin = $_POST['id_chemin'];

// Verification de l'ID flèche
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $id_fleche)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Identifiant flèche invalide";
}

// Verification du valeur chemin
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $valeur_chemin)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Valeur chemin invalide";
}

// Verification de l'ID evenement redoute
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_evenement_redoute)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "ID Évenement redouté invalide";
}

// Verification de l'id scénario
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant scénario invalide";
}

// Verification de l'id source
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_source)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant source invalide";
}

// Verification de l'id schema source
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $id_schema_source)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant Schéma Source invalide";
}

// Verification de l'id destination
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_destination)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant destination invalide";
}

// Verification de l'id schema destination
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $id_schema_destination)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant Schéma Destination invalide";
}

// Verification de l'id chemin
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-\_.:,'\"–]{0,100}$/", $id_chemin)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Identifiant Chemin invalide";
}


//ajout des ER dans la base de données
if($type_source=="Partie Prenante"&&$type_destination=="Valeur Métier"){
    $insere = $bdd->prepare("INSERT INTO UA_ER (id_fleche,valeur_chemin,id_evenement_redoute,id_scenario_strategique,id_source,id_schema_source,id_destination,id_schema_destination,id_chemin_d_attaque_strategique,id_projet,id_atelier) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $type=true;
}
else if($type_source=="Valeur Métier"&&$type_destination=="Partie Prenante"){
    $insere = $bdd->prepare("INSERT INTO UA_ER (id_fleche,valeur_chemin,id_evenement_redoute,id_scenario_strategique,id_destination,id_schema_destination,id_source,id_schema_source,id_chemin_d_attaque_strategique,id_projet,id_atelier) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $type=true;
}

if ($type==true&&isset($id_fleche)&&isset($valeur_chemin)&&isset($id_evenement_redoute)&&isset($id_scenario_strategique)&&isset($id_source)&&isset($id_schema_source)&&isset($id_destination)&&isset($id_schema_destination)&&isset($id_chemin)&&isset($get_id_projet)&&isset($id_atelier)&&$results["error"]!=true) {
    //Insert ER
    $recupere_chemin = $bdd->prepare("SELECT id_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique WHERE id_chemin=? AND id_scenario_strategique=? AND id_projet=? AND id_atelier=?");
    $recupere_chemin->bindParam(1, $id_chemin);
    $recupere_chemin->bindParam(2, $id_scenario_strategique);
    $recupere_chemin->bindParam(3, $get_id_projet);
    $recupere_chemin->bindParam(4, $id_atelier);
    $recupere_chemin->execute();
    $id_chemin_d_attaque_strategique=$recupere_chemin->fetch();

    $insere->bindParam(1, $id_fleche);
    $insere->bindParam(2, $valeur_chemin);
    $insere->bindParam(3, $id_evenement_redoute);
    $insere->bindParam(4, $id_scenario_strategique);
    $insere->bindParam(5, $id_source);
    $insere->bindParam(6, $id_schema_source);
    $insere->bindParam(7, $id_destination);
    $insere->bindParam(8, $id_schema_destination);
    $insere->bindParam(9, $id_chemin_d_attaque_strategique[0]);
    $insere->bindParam(10, $get_id_projet);
    $insere->bindParam(11, $id_atelier);
    $insere->execute();


    //Update Chemin avec gravite
    // $select_gravite = $bdd->prepare("SELECT M_evenement_redoute.niveau_de_gravite FROM M_evenement_redoute, UA_ER WHERE M_evenement_redoute.id_evenement_redoute = UA_ER.id_evenement_redoute AND UA_ER.id_chemin_d_attaque_strategique=? AND UA_ER.id_scenario_strategique=? AND UA_ER.id_projet=? AND UA_ER.id_atelier=?");
    // $select_gravite->bindParam(1, $id_chemin_d_attaque_strategique[0]);
    // $select_gravite->bindParam(2, $id_scenario_strategique);
    // $select_gravite->bindParam(3, $get_id_projet);
    // $select_gravite->bindParam(4, $id_atelier);
    // $select_gravite->execute();
    // $niveau_de_gravite=$select_gravite->fetch();

    // $array = array();

    // while($ecriture = $select_gravite->fetch()){
    //     array_push($array,$ecriture);
    // }

    // echo json_encode($array);


    // $ajout_gravite = $bdd->prepare("UPDATE T_chemin_d_attaque_strategique SET gravite=? WHERE T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique=? AND T_chemin_d_attaque_strategique.id_scenario_strategique=? AND T_chemin_d_attaque_strategique.id_projet=? AND T_chemin_d_attaque_strategique.id_atelier=?");
    // $ajout_gravite->bindParam(1, $niveau_de_gravite[0]);
    // $ajout_gravite->bindParam(2, $id_chemin_d_attaque_strategique[0]);
    // $ajout_gravite->bindParam(3, $id_scenario_strategique);
    // $ajout_gravite->bindParam(4, $get_id_projet);
    // $ajout_gravite->bindParam(5, $id_atelier);
    // $ajout_gravite->execute();
    
    
    $results["error"] = false;
    $_SESSION['message_success'] = "Votre schéma a été correctement mise à jour !";
}

else{
    echo 'Erreur !';
}
?>