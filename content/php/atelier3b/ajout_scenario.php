<?php
session_start();

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];


$nom_scenario_strategique = $_POST['nom_scenario_strategique'];
$id_source_de_risque = $_POST['id_source_de_risque'];

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

$id_atelier = '3.b';
$id_projet = $_SESSION['id_projet'];
$id_scenario = 'id_scenario';
$image = 'data:application/xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%0A%3Cdefinitions%20xmlns%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F20100524%2FMODEL%22%20xmlns%3Abpmndi%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F20100524%2FDI%22%20xmlns%3Aomgdc%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FDD%2F20100524%2FDC%22%20xmlns%3Axsi%3D%22http%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema-instance%22%20targetNamespace%3D%22%22%20xsi%3AschemaLocation%3D%22http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F20100524%2FMODEL%20http%3A%2F%2Fwww.omg.org%2Fspec%2FBPMN%2F2.0%2F20100501%2FBPMN20.xsd%22%3E%0A%20%20%3Ccollaboration%20id%3D%22Collaboration_0n85r8a%22%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22Participant_0s2lx66%22%20name%3D%22Source%20de%20risque%22%20processRef%3D%22Process_0qqwoep%22%20%2F%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22Participant_1p5a95g%22%20name%3D%22%C3%89cosyst%C3%A8me%22%20processRef%3D%22Process_0r4d8dh%22%20%2F%3E%0A%20%20%20%20%3Cparticipant%20id%3D%22Participant_1lsp20e%22%20name%3D%22Objectif%20vis%C3%A9%22%20processRef%3D%22Process_0a2q3ig%22%20%2F%3E%0A%20%20%3C%2Fcollaboration%3E%0A%20%20%3Cprocess%20id%3D%22Process_0qqwoep%22%3E%0A%20%20%20%20%3CuserTask%20id%3D%22Activity_0ynt8a1%22%20%2F%3E%0A%20%20%3C%2Fprocess%3E%0A%20%20%3Cprocess%20id%3D%22Process_0r4d8dh%22%20%2F%3E%0A%20%20%3Cprocess%20id%3D%22Process_0a2q3ig%22%20%2F%3E%0A%20%20%3Cbpmndi%3ABPMNDiagram%20id%3D%22sid-74620812-92c4-44e5-949c-aa47393d3830%22%3E%0A%20%20%20%20%3Cbpmndi%3ABPMNPlane%20id%3D%22sid-cdcae759-2af7-4a6d-bd02-53f3352a731d%22%20bpmnElement%3D%22Collaboration_0n85r8a%22%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Participant_0s2lx66_di%22%20bpmnElement%3D%22Participant_0s2lx66%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%22230%22%20y%3D%22100%22%20width%3D%22300%22%20height%3D%22640%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Activity_0ynt8a1_di%22%20bpmnElement%3D%22Activity_0ynt8a1%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%22330%22%20y%3D%22170%22%20width%3D%22100%22%20height%3D%2280%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Participant_1p5a95g_di%22%20bpmnElement%3D%22Participant_1p5a95g%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%22550%22%20y%3D%22100%22%20width%3D%22300%22%20height%3D%22640%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%20%20%3Cbpmndi%3ABPMNShape%20id%3D%22Participant_1lsp20e_di%22%20bpmnElement%3D%22Participant_1lsp20e%22%20isHorizontal%3D%22true%22%3E%0A%20%20%20%20%20%20%20%20%3Comgdc%3ABounds%20x%3D%22870%22%20y%3D%22100%22%20width%3D%22300%22%20height%3D%22640%22%20%2F%3E%0A%20%20%20%20%20%20%3C%2Fbpmndi%3ABPMNShape%3E%0A%20%20%20%20%3C%2Fbpmndi%3ABPMNPlane%3E%0A%20%20%20%20%3Cbpmndi%3ABPMNLabelStyle%20id%3D%22sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581%22%3E%0A%20%20%20%20%20%20%3Comgdc%3AFont%20name%3D%22Arial%22%20size%3D%2211%22%20isBold%3D%22false%22%20isItalic%3D%22false%22%20isUnderline%3D%22false%22%20isStrikeThrough%3D%22false%22%20%2F%3E%0A%20%20%20%20%3C%2Fbpmndi%3ABPMNLabelStyle%3E%0A%20%20%20%20%3Cbpmndi%3ABPMNLabelStyle%20id%3D%22sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b%22%3E%0A%20%20%20%20%20%20%3Comgdc%3AFont%20name%3D%22Arial%22%20size%3D%2212%22%20isBold%3D%22false%22%20isItalic%3D%22false%22%20isUnderline%3D%22false%22%20isStrikeThrough%3D%22false%22%20%2F%3E%0A%20%20%20%20%3C%2Fbpmndi%3ABPMNLabelStyle%3E%0A%20%20%3C%2Fbpmndi%3ABPMNDiagram%3E%0A%3C%2Fdefinitions%3E%0A';

$insere = $bdd->prepare(
  'INSERT INTO S_scenario_strategique 
  (id_scenario_strategique, nom_scenario_strategique, images, id_atelier, id_source_de_risque, id_projet)
   VALUES 
   ( ?, ?, ?, ?, ?, ?)'
);
$recupere_scenarios_existants = $bdd->prepare("SELECT id_source_de_risque FROM S_scenario_strategique WHERE S_scenario_strategique.id_projet = ?");

$ajout_chemin = $bdd->prepare("INSERT INTO `T_chemin_d_attaque_strategique`(`id_chemin`, `id_scenario_strategique`, `id_projet`, `id_atelier`) VALUES (?,?,?,?)");

if ($results["error"] === false && isset($_POST['validerscenario'])) {

  $recupere_scenarios_existants->bindParam(1, $id_projet);
  $recupere_scenarios_existants->execute();
  $result_scenarios_existants = $recupere_scenarios_existants->fetchAll(PDO::FETCH_COLUMN);


  if (!in_array($id_source_de_risque, $result_scenarios_existants)) {
  $insere->bindParam(1, $id_scenario);
  $insere->bindParam(2, $nom_scenario_strategique);
  $insere->bindParam(3, $image);
  $insere->bindParam(4, $id_atelier);
  $insere->bindParam(5, $id_source_de_risque);
  $insere->bindParam(6, $id_projet);

  $insere->execute();
  $_SESSION['message_success'] = "Le scénario stratégique a bien été ajouté !";

  $recupere_id_scenario = $bdd->prepare("SELECT id_scenario_strategique FROM S_scenario_strategique WHERE nom_scenario_strategique=? AND id_projet=? AND id_atelier=?");
  $recupere_id_scenario->bindParam(1, $nom_scenario_strategique);
  $recupere_id_scenario->bindParam(2, $id_projet);
  $recupere_id_scenario->bindParam(3, $id_atelier);
  $recupere_id_scenario->execute();

  $id_scenario_recupere=$recupere_id_scenario->fetch();

  $id_chemin = ['C1','C2','C3','C4','C5','C6','C7','C8','C9'];

  for($i=0;$i<count($id_chemin);++$i){
    $ajout_chemin->bindParam(1, $id_chemin[$i]);
    $ajout_chemin->bindParam(2, $id_scenario_recupere[0]);
    $ajout_chemin->bindParam(3, $id_projet);
    $ajout_chemin->bindParam(4, $id_atelier);
    $ajout_chemin->execute();
  }
  } else {
    $_SESSION['message_error'] = "Le scénario stratégique entré existe déjà !";
  }
}
header('Location: ../../../atelier-3b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#scenario_strategique');
?>