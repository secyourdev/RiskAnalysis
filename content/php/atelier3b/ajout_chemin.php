<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_risque = $_POST['id_risque'];
$chemin_d_attaque_strategique = $_POST['chemin_d_attaque_strategique'];
$description = $_POST['description'];
$id_scenario_strategique = $_POST['nom_scenario_strategique'];
$id_partie_prenante = $_POST['nom_partie_prenante'];
$id_chemin_d_attaque = "id_chemin";
$id_scenar = "id_scenar";
$id_atelier = "4.a";


// Verification du id_risque
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_risque)) {
  $results["error"] = true;
  $_SESSION['message_error_3'] = "Identifiant risque invalide";
}
// Verification du chemin_d_attaque_strategique
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $chemin_d_attaque_strategique)) {
  $results["error"] = true;
  $_SESSION['message_error_3'] = "Chemin d'attaque stratégique invalide";
}
// Verification de la description
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description)) {
  $results["error"] = true;
  $_SESSION['message_error_3'] = "Description invalide";
}
// Verification du id_scenario_strategique
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $id_scenario_strategique)) {
  $results["error"] = true;
  $_SESSION['message_error_3'] = "Identifiant scénario stratégique invalide";
}


$recupere_chemins_existants = $bdd->prepare("SELECT T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique 
FROM T_chemin_d_attaque_strategique, U_scenario_operationnel
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND U_scenario_operationnel.id_projet = ?");
$recupere_pp_existant = $bdd->prepare("SELECT T_chemin_d_attaque_strategique.id_partie_prenante
FROM T_chemin_d_attaque_strategique
WHERE T_chemin_d_attaque_strategique.id_projet = ?");

$insere = $bdd->prepare(
  "INSERT INTO 
  T_chemin_d_attaque_strategique
  (id_chemin_d_attaque_strategique, 
  id_risque, 
  nom_chemin_d_attaque_strategique, 
  description_chemin_d_attaque_strategique, 
  id_scenario_strategique, 
  id_partie_prenante, 
  id_projet, 
  id_atelier) VALUES 
  (?,?,?,?,?,?,$get_id_projet,'3.b')"
);
$insere_reeval = $bdd->prepare(
  'INSERT INTO 
  X_revaluation_du_risque
  (
    id_revaluation, 
  nom_risque_residuelle, 
  description_risque_residuelle, 
  vraisemblance_residuelle, 
  risque_residuel, 
  gestion_risque_residuelle, 
  id_atelier, 
  id_chemin_d_attaque_strategique, 
  id_risque, 
  id_projet
  ) VALUES ("", NULL, NULL, NULL, NULL, NULL,"5.c",?,?,?)'
);



$recuperechemin = $bdd->prepare("SELECT T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique, 
T_chemin_d_attaque_strategique.id_risque,
S_scenario_strategique.id_evenement_redoute
FROM T_chemin_d_attaque_strategique, S_scenario_strategique
WHERE nom_chemin_d_attaque_strategique = ?
AND  id_risque = ?
AND T_chemin_d_attaque_strategique.id_projet = $get_id_projet
AND S_scenario_strategique.id_projet = $get_id_projet
AND T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique");

$insereope = $bdd->prepare("INSERT INTO U_scenario_operationnel
(id_scenario_operationnel, nom_scenario_operationnel, description_scenario_operationnel, vraisemblance, images, id_atelier, id_chemin_d_attaque_strategique, id_risque, id_evenement_redoute, id_projet) 
VALUES (?,NULL,?,NULL,NULL,?,?,?,?,?)");


if ($results["error"] === false && isset($_POST['validerchemin'])) {
  
  $recupere_chemins_existants->bindParam(1, $get_id_projet);
  $recupere_chemins_existants->execute();
  $result_nom_chemin_existant = $recupere_chemins_existants->fetchAll(PDO::FETCH_COLUMN);
  $recupere_pp_existant->bindParam(1, $get_id_projet);
  $recupere_pp_existant->execute();
  $result_pp_existant = $recupere_pp_existant->fetchAll(PDO::FETCH_COLUMN);
  

  if (!in_array($chemin_d_attaque_strategique, $result_nom_chemin_existant)) {
    //if (!in_array($id_partie_prenante, $result_pp_existant)) {

      $insere->bindParam(1, $id_chemin_d_attaque);
      $insere->bindParam(2, $id_risque);
      $insere->bindParam(3, $chemin_d_attaque_strategique);
      $insere->bindParam(4, $description);
      $insere->bindParam(5, $id_scenario_strategique);
      $insere->bindParam(6, $id_partie_prenante);
      $insere->execute();
 


      $recuperechemin->bindParam(1, $chemin_d_attaque_strategique);
      $recuperechemin->bindParam(2, $id_risque);
      $recuperechemin->execute();
      $resultchemin = $recuperechemin->fetch();


  

      $insere_reeval->bindParam(1, $resultchemin[0]);
      $insere_reeval->bindParam(2, $resultchemin[1]);
      $insere_reeval->bindParam(3, $get_id_projet);
      $insere_reeval->execute();


      $description_ope = "Scenario opérationnel pour : " . $chemin_d_attaque_strategique;



      $insereope->bindParam(1, $id_scenar);
      $insereope->bindParam(2, $description_ope);
      $insereope->bindParam(3, $id_atelier);
      $insereope->bindParam(4, $resultchemin[0]);
      $insereope->bindParam(5, $resultchemin[1]);
      $insereope->bindParam(6, $resultchemin[2]);
      $insereope->bindParam(7, $get_id_projet);
      $insereope->execute();
      $_SESSION['message_success_3'] = "Le chemin d'attaque a bien été ajouté !";
    //} else {
      //$_SESSION['message_error_3'] = "La partie prenante à déjà un chemin d'attaque !";
   // }
  } else {
    $_SESSION['message_error_3'] = "Le chemin d'attaque entré existe déjà !";
  }
}

header('Location: ../../../atelier-3b&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet'] . '#chemin_dattaque');
