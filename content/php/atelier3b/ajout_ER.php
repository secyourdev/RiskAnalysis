<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';
$id_atelier_4a = '4.a';

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
    $recupere_chemin = $bdd->prepare("SELECT id_chemin_d_attaque_strategique
    FROM T_chemin_d_attaque_strategique
    WHERE id_chemin=? 
    AND id_scenario_strategique=? 
    AND id_projet=? 
    AND id_atelier=?");

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

    $select_scenario_operationnel = $bdd->prepare("SELECT id_scenario_operationnel FROM U_scenario_operationnel WHERE id_chemin_d_attaque_strategique=? AND id_projet=? AND id_atelier=?");
    $select_scenario_operationnel->bindParam(1, $id_chemin_d_attaque_strategique[0]);
    $select_scenario_operationnel->bindParam(2, $get_id_projet);
    $select_scenario_operationnel->bindParam(3, $id_atelier_4a);
    $select_scenario_operationnel->execute();
    $id_scenario_operationnel=$select_scenario_operationnel->fetch();
     
    $images = 'data:application/xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%0A%3Cdefinitions%20xmlns%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F20100524%2FMODEL%22%20xmlns%3Abpmndi%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F20100524%2FDI%22%20xmlns%3Aomgdc%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FDD%2F20100524%2FDC%22%20xmlns%3Axsi%3D%22http%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema-instance%22%20targetNamespace%3D%22%22%20xsi%3AschemaLocation%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F20100524%2FMODEL%20http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F2.0%2F20100501%2FBPMN20.xsd%22%3E%0A%20%20%3Ccollaboration%20id%3D%22Collaboration_1k3yu97%22%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22Participant_1rohhf4%22%20name%3D%22Conna%C3%AEtre%22%20processRef%3D%22Process_15x29ag%22%20%2F%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22Participant_1t9xvhs%22%20name%3D%22Rentrer%22%20processRef%3D%22Process_1t81gon%22%20%2F%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22Participant_1asmakh%22%20name%3D%22Trouver%22%20processRef%3D%22Process_0r1jzs8%22%20%2F%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22Participant_0sudgxn%22%20name%3D%22Exploiter%22%20processRef%3D%22Process_01j45oj%22%20%2F%3E%0A%20%20%3C%2Fcollaboration%3E%0A%20%20%3Cprocess%20id%3D%22Process_15x29ag%22%20%2F%3E%0A%20%20%3Cprocess%20id%3D%22Process_1t81gon%22%20%2F%3E%0A%20%20%3Cprocess%20id%3D%22Process_0r1jzs8%22%20%2F%3E%0A%20%20%3Cprocess%20id%3D%22Process_01j45oj%22%20%2F%3E%0A%20%20%3Cbpmndi%3ABPMNDiagram%20id%3D%22sid-74620812-92c4-44e5-949c-aa47393d3830%22%3E%0A%20%20%20%20%3Cbpmndi%3ABPMNPlane%20id%3D%22sid-cdcae759-2af7-4a6d-bd02-53f3352a731d%22%20bpmnElement%3D%22Collaboration_1k3yu97%22%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Participant_1rohhf4_di%22%20bpmnElement%3D%22Participant_1rohhf4%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%22230%22%20y%3D%22180%22%20width%3D%22300%22%20height%3D%22640%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Participant_1t9xvhs_di%22%20bpmnElement%3D%22Participant_1t9xvhs%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%22540%22%20y%3D%22180%22%20width%3D%22300%22%20height%3D%22640%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Participant_1asmakh_di%22%20bpmnElement%3D%22Participant_1asmakh%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%22850%22%20y%3D%22180%22%20width%3D%22300%22%20height%3D%22640%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Participant_0sudgxn_di%22%20bpmnElement%3D%22Participant_0sudgxn%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%221160%22%20y%3D%22180%22%20width%3D%22300%22%20height%3D%22640%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%3C%2Fbpmndi%3ABPMNPlane%3E%0A%20%20%20%20%3Cbpmndi%3ABPMNLabelStyle%20id%3D%22sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581%22%3E%0A%20%20%20%20%20%20%3Comgdc%3AFont%20name%3D%22Arial%22%20size%3D%2211%22%20isBold%3D%22false%22%20isItalic%3D%22false%22%20isUnderline%3D%22false%22%20isStrikeThrough%3D%22false%22%20%2F%3E%0A%20%20%20%20%3C%2Fbpmndi%3ABPMNLabelStyle%3E%0A%20%20%20%20%3Cbpmndi%3ABPMNLabelStyle%20id%3D%22sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b%22%3E%0A%20%20%20%20%20%20%3Comgdc%3AFont%20name%3D%22Arial%22%20size%3D%2212%22%20isBold%3D%22false%22%20isItalic%3D%22false%22%20isUnderline%3D%22false%22%20isStrikeThrough%3D%22false%22%20%2F%3E%0A%20%20%20%20%3C%2Fbpmndi%3ABPMNLabelStyle%3E%0A%20%20%3C%2Fbpmndi%3ABPMNDiagram%3E%0A%3C%2Fdefinitions%3E%0A';

    if($id_scenario_operationnel[0]!=null){
        //Insert Scénario Opérationnel 
        $insere_scenario_operationnel = $bdd->prepare("UPDATE U_scenario_operationnel SET id_chemin_d_attaque_strategique=?, images=?, id_evenement_redoute=? WHERE id_scenario_operationnel=? AND id_projet=? AND id_atelier=?");
        
        $insere_scenario_operationnel->bindParam(1, $id_chemin_d_attaque_strategique[0]);
        $insere_scenario_operationnel->bindParam(2, $images);
        $insere_scenario_operationnel->bindParam(3, $id_evenement_redoute);
        $insere_scenario_operationnel->bindParam(4, $id_scenario_operationnel[0]);
        $insere_scenario_operationnel->bindParam(5, $get_id_projet);
        $insere_scenario_operationnel->bindParam(6, $id_atelier_4a);
        $insere_scenario_operationnel->execute();
    }
    else {
        //Insert Scénario Opérationnel 
        $insere_scenario_operationnel = $bdd->prepare("INSERT INTO U_scenario_operationnel (id_chemin_d_attaque_strategique, images, id_evenement_redoute, id_projet, id_atelier) VALUES (?,?,?,?,?)");
        
        $insere_scenario_operationnel->bindParam(1, $id_chemin_d_attaque_strategique[0]);
        $insere_scenario_operationnel->bindParam(2, $images);
        $insere_scenario_operationnel->bindParam(3, $id_evenement_redoute);
        $insere_scenario_operationnel->bindParam(4, $get_id_projet);
        $insere_scenario_operationnel->bindParam(5, $id_atelier_4a);
        $insere_scenario_operationnel->execute();
    }

    $results["error"] = false;
    $_SESSION['message_success'] = "Votre schéma a été correctement mise à jour !";
}

else{
    echo 'Erreur !';
}
?>