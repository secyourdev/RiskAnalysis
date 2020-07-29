<?php
session_start();

include("../bdd/connexion.php");

$results["error"] = false;

$id_etude_modif = $_POST['id_etude_modif'];
$nom_etude_modif = $_POST['nom_etude_modif'];
$description_etude_modif = $_POST['description_etude_modif'];
$chef_de_projet = $_POST['id_utilisateur'];
$id_grp_utilisateur_modif = $_POST['id_grp_utilisateur_modif'];

// Verification du nom
if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $nom_etude_modif)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Nom invalide";
}

// Verification du description
if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{1,100}$/", $description_etude_modif)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Description invalide";
}

// Verification du groupe d'utilisateur
if(!preg_match("/^[0-9\s-]{1,100}$/", $id_grp_utilisateur_modif)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Groupe d'utilisateur invalide";
}
  
if(isset($_POST['modifier_projet']) && $results["error"] === false ){
    $update_projet = $bdd->prepare("UPDATE F_projet SET nom_projet = ?, description_projet=?, id_grp_utilisateur=?, id_utilisateur=? WHERE id_projet=?");
    $update_projet->bindParam(1, $nom_etude_modif);
    $update_projet->bindParam(2, $description_etude_modif);
    $update_projet->bindParam(3, $id_grp_utilisateur_modif);
    $update_projet->bindParam(4, $chef_de_projet);
    $update_projet->bindParam(5, $id_etude_modif);
    $update_projet->execute();

    $_SESSION['message_success'] = "Le projet $id_etude_modif a été modifié !";
}

header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
?>