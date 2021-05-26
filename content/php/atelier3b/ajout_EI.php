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


//ajout des EI dans la base de données
if($type_source=="SROV"&&$type_destination=="Partie Prenante"){
    $insere = $bdd->prepare("INSERT INTO UA_EI (id_fleche,valeur_chemin,id_scenario_strategique,id_source,id_schema_source,id_destination,id_schema_destination,id_chemin_d_attaque_strategique,id_projet,id_atelier) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $type=true;
}
else if($type_source=="Partie Prenante"&&$type_destination=="SROV"){
    $insere = $bdd->prepare("INSERT INTO UA_EI (id_fleche,valeur_chemin,id_scenario_strategique,id_destination,id_schema_destination,id_source,id_schema_source,id_chemin_d_attaque_strategique,id_projet,id_atelier) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $type=true;
}
else if($type_source=="Partie Prenante"&&$type_destination=="Partie Prenante"){
    $insere = $bdd->prepare("INSERT INTO UA_EI (id_fleche,valeur_chemin,id_scenario_strategique,id_source_2,id_schema_source,id_destination,id_schema_destination,id_chemin_d_attaque_strategique,id_projet,id_atelier) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $type=true;
}

if ($type==true&&isset($id_fleche)&&isset($valeur_chemin)&&isset($id_scenario_strategique)&&isset($id_source)&&isset($id_schema_source)&&isset($id_destination)&&isset($id_schema_destination)&&isset($id_chemin)&&isset($get_id_projet)&&isset($id_atelier)&&$results["error"]!=true) {
    
    $recupere_chemin = $bdd->prepare("SELECT id_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique WHERE id_chemin=? AND id_scenario_strategique=? AND id_projet=? AND id_atelier=?");
    $recupere_chemin->bindParam(1, $id_chemin);
    $recupere_chemin->bindParam(2, $id_scenario_strategique);
    $recupere_chemin->bindParam(3, $get_id_projet);
    $recupere_chemin->bindParam(4, $id_atelier);
    $recupere_chemin->execute();
    $id_chemin_d_attaque_stategique=$recupere_chemin->fetch();


    $insere->bindParam(1, $id_fleche);
    $insere->bindParam(2, $valeur_chemin);
    $insere->bindParam(3, $id_scenario_strategique);
    $insere->bindParam(4, $id_source);
    $insere->bindParam(5, $id_schema_source);
    $insere->bindParam(6, $id_destination);
    $insere->bindParam(7, $id_schema_destination);
    $insere->bindParam(8, $id_chemin_d_attaque_stategique[0]);
    $insere->bindParam(9, $get_id_projet);
    $insere->bindParam(10, $id_atelier);
    $insere->execute();

    $results["error"] = false;
    $_SESSION['message_success'] = "Votre schéma a été correctement mise à jour !";
}

else{
    echo 'Erreur !';
}
?>