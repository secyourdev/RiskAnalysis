<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$nom_mission = $_POST['nom_mission'];
$description_mission = $_POST['description_mission'];
$responsable = $_POST['responsable'];

$id_valeur_metier = $_POST['valeur_metier'];
$responsable_vm = $_POST['responsable_vm'];
$id_bien_support = $_POST['bien_support'];
$responsable_bs = $_POST['responsable_bs'];

$id_mission = "id_mission";
$id_atelier = "1.b";

$inseremission = $bdd->prepare('INSERT INTO I_mission(id_mission, nom_mission, description_mission, responsable, id_atelier, id_projet) VALUES (?,?,?,?,?,?)');

// Verification du nom de la mission
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_mission)) {
    $results["error"] = true;
    $_SESSION['message_error'] = "Nom invalide";
  }
  
// Verification de la description de la mission
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $description_mission)) {
  $results["error"] = true;
  $_SESSION['message_error_2'] = "Description invalide";
}

// Verification du responsable de la mission
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $responsable)) {
  $results["error"] = true;
  $_SESSION['message_error'] = "Responsable invalide";
}

if ($results["error"] === false && isset($_POST['validermission'])) {
    $inseremission->bindParam(1, $id_mission);
    $inseremission->bindParam(2, $nom_mission);
    $inseremission->bindParam(3, $description_mission);
    $inseremission->bindParam(4, $responsable);
    $inseremission->bindParam(5, $id_atelier);
    $inseremission->bindParam(6, $getid_projet);
    $inseremission->execute();

    $recuperemission = $bdd->prepare('SELECT id_mission FROM I_mission WHERE nom_mission=? AND responsable=? AND id_projet=?');
    $recuperemission->bindParam(1, $nom_mission);
    $recuperemission->bindParam(2, $responsable);
    $recuperemission->bindParam(3, $getid_projet);
    $recuperemission->execute();
    $resultat = $recuperemission->fetch();

    if($id_valeur_metier!="" && $id_bien_support!=""){
      $inserecoupleVMBS = $bdd->prepare('INSERT INTO L_couple_VMBS(id_valeur_metier, id_bien_support, id_mission, nom_responsable_vm, nom_responsable_bs, id_projet) VALUES (?,?,?,?,?,?)');
      $inserecoupleVMBS->bindParam(1, $id_valeur_metier);
      $inserecoupleVMBS->bindParam(2, $id_bien_support);
      $inserecoupleVMBS->bindParam(3, $resultat['id_mission']);
      $inserecoupleVMBS->bindParam(4, $responsable_vm);
      $inserecoupleVMBS->bindParam(5, $responsable_bs);
      $inserecoupleVMBS->bindParam(6, $getid_projet);
      $inserecoupleVMBS->execute();
    }

    $_SESSION['message_success'] = "La mission a bien été ajoutée !";
}

header('Location: ../../../atelier-1b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#mission');
?>