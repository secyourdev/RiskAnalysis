<?php
session_start();

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];


$nom_scenario_strategique = $_POST['nom_scenario_strategique'];
$id_source_de_risque = $_POST['id_source_de_risque'];
$id_evenement_redoute = $_POST['id_evenement_redoute'];

// Verification du nom_scenario_strategique
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{0,100}$/", $nom_scenario_strategique)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Nom scénario strategique invalide";
}
// Verification du id_source_de_risque
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{0,100}$/", $id_source_de_risque)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Identifiant source de risque invalide";
}
// Verification du id_evenement_redoute
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\'\s-]{0,100}$/", $id_evenement_redoute)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Identifiant événement redouté invalide";
}

$id_atelier = '3.b';
$id_projet = $_SESSION['id_projet'];
$id_scenario = 'id_scenario';
$image = 'data:application/xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%0A%3Cdefinitions%20xmlns%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F20100524%2FMODEL%22%20xmlns%3Abpmndi%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F20100524%2FDI%22%20xmlns%3Aomgdc%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FDD%2F20100524%2FDC%22%20xmlns%3Axsi%3D%22http%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema-instance%22%20targetNamespace%3D%22%22%20xsi%3AschemaLocation%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F20100524%2FMODEL%20http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F2.0%2F20100501%2FBPMN20.xsd%22%3E%0A%20%20%3Ccollaboration%20id%3D%22sid-c0e745ff-361e-4afb-8c8d-2a1fc32b1424%22%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22sid-87F4C1D6-25E1-4A45-9DA7-AD945993D06F%22%20processRef%3D%22sid-C3803939-0872-457F-8336-EAE484DC4A04%22%20%2F%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22Participant_13w9snm%22%20processRef%3D%22Process_0v8s7mp%22%20%2F%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22Participant_1354sk9%22%20processRef%3D%22Process_1g9ieks%22%20%2F%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22Participant_00qo8c3%22%20processRef%3D%22Process_1iznnlq%22%20%2F%3E%0A%20%20%3C%2Fcollaboration%3E%0A%20%20%3Cprocess%20id%3D%22sid-C3803939-0872-457F-8336-EAE484DC4A04%22%20name%3D%22Customer%22%20processType%3D%22None%22%20isClosed%3D%22false%22%20isExecutable%3D%22false%22%3E%0A%20%20%20%20%3CextensionElements%20%2F%3E%0A%20%20%20%20%3ClaneSet%20id%3D%22sid-b167d0d7-e761-4636-9200-76b7f0e8e83a%22%3E%0A%20%20%20%20%20%20%3Clane%20id%3D%22sid-57E4FE0D-18E4-478D-BC5D-B15164E93254%22%20%2F%3E%0A%20%20%20%20%3C%2FlaneSet%3E%0A%20%20%3C%2Fprocess%3E%0A%20%20%3Cprocess%20id%3D%22Process_0v8s7mp%22%20%2F%3E%0A%20%20%3Cprocess%20id%3D%22Process_1g9ieks%22%20%2F%3E%0A%20%20%3Cprocess%20id%3D%22Process_1iznnlq%22%20%2F%3E%0A%20%20%3Cbpmndi%3ABPMNDiagram%20id%3D%22sid-74620812-92c4-44e5-949c-aa47393d3830%22%3E%0A%20%20%20%20%3Cbpmndi%3ABPMNPlane%20id%3D%22sid-cdcae759-2af7-4a6d-bd02-53f3352a731d%22%20bpmnElement%3D%22sid-c0e745ff-361e-4afb-8c8d-2a1fc32b1424%22%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22sid-87F4C1D6-25E1-4A45-9DA7-AD945993D06F_gui%22%20bpmnElement%3D%22sid-87F4C1D6-25E1-4A45-9DA7-AD945993D06F%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%2283%22%20y%3D%22105%22%20width%3D%22933%22%20height%3D%22250%22%20%2F%3E%0A%20%20%20%20%20%20%20%20%3Cbpmndi%3ABPMNLabel%20labelStyle%3D%22sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b%22%3E%0A%20%20%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%2247.49999999999999%22%20y%3D%22170.42857360839844%22%20width%3D%2212.000000000000014%22%20height%3D%2259.142852783203125%22%20%2F%3E%0A%20%20%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNLabel%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22sid-57E4FE0D-18E4-478D-BC5D-B15164E93254_gui%22%20bpmnElement%3D%22sid-57E4FE0D-18E4-478D-BC5D-B15164E93254%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%22113%22%20y%3D%22105%22%20width%3D%22903%22%20height%3D%22250%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Participant_13w9snm_di%22%20bpmnElement%3D%22Participant_13w9snm%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%2283%22%20y%3D%22380%22%20width%3D%22933%22%20height%3D%22250%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Participant_1354sk9_di%22%20bpmnElement%3D%22Participant_1354sk9%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%2283%22%20y%3D%22660%22%20width%3D%22933%22%20height%3D%22250%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Participant_00qo8c3_di%22%20bpmnElement%3D%22Participant_00qo8c3%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%2283%22%20y%3D%22-170%22%20width%3D%22933%22%20height%3D%22250%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%3C%2Fbpmndi%3ABPMNPlane%3E%0A%20%20%20%20%3Cbpmndi%3ABPMNLabelStyle%20id%3D%22sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581%22%3E%0A%20%20%20%20%20%20%3Comgdc%3AFont%20name%3D%22Arial%22%20size%3D%2211%22%20isBold%3D%22false%22%20isItalic%3D%22false%22%20isUnderline%3D%22false%22%20isStrikeThrough%3D%22false%22%20%2F%3E%0A%20%20%20%20%3C%2Fbpmndi%3ABPMNLabelStyle%3E%0A%20%20%20%20%3Cbpmndi%3ABPMNLabelStyle%20id%3D%22sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b%22%3E%0A%20%20%20%20%20%20%3Comgdc%3AFont%20name%3D%22Arial%22%20size%3D%2212%22%20isBold%3D%22false%22%20isItalic%3D%22false%22%20isUnderline%3D%22false%22%20isStrikeThrough%3D%22false%22%20%2F%3E%0A%20%20%20%20%3C%2Fbpmndi%3ABPMNLabelStyle%3E%0A%20%20%3C%2Fbpmndi%3ABPMNDiagram%3E%0A%3C%2Fdefinitions%3E%0A';

$insere = $bdd->prepare(
  'INSERT INTO S_scenario_strategique 
  (id_scenario_strategique, nom_scenario_strategique, images, id_atelier, id_source_de_risque, id_evenement_redoute, id_projet)
   VALUES 
   ( ?, ?, ?, ?, ?, ?, ?)'
);
$recupere_scenarios_existants = $bdd->prepare("SELECT nom_scenario_strategique FROM S_scenario_strategique WHERE S_scenario_strategique.id_projet = ?");

if ($results["error"] === false && isset($_POST['validerscenario'])) {

  $recupere_scenarios_existants->bindParam(1, $id_projet);
  $recupere_scenarios_existants->execute();
  $result_scenarios_existants = $recupere_scenarios_existants->fetchAll(PDO::FETCH_COLUMN);


  if (!in_array($nom_scenario_strategique, $result_scenarios_existants)) {
  $insere->bindParam(1, $id_scenario);
  $insere->bindParam(2, $nom_scenario_strategique);
  $insere->bindParam(3, $image);
  $insere->bindParam(4, $id_atelier);
  $insere->bindParam(5, $id_source_de_risque);
  $insere->bindParam(6, $id_evenement_redoute);
  $insere->bindParam(7, $id_projet);

  $insere->execute();
  $_SESSION['message_success'] = "Le scénario stratégique a bien été ajouté !";
  } else {
    $_SESSION['message_error'] = "Le scénario stratégique entré existe déjà !";
  }
}
header('Location: ../../../atelier-3b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#scenario_strategique');
?>