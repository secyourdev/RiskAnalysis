<?php
session_start();

include("../bdd/connexion.php");

$results["error"] = false;

$id_etude_modif = $_POST['id_etude_modif'];
$nom_etude_modif = $_POST['nom_etude_modif'];
$description_etude_modif = $_POST['description_etude_modif'];
$chef_de_projet = $_POST['id_utilisateur'];
$id_grp_utilisateur_modif = $_POST['id_grp_utilisateur_modif'];
$id_num_version_modif = $_POST['id_num_version_modif'];

// Verification du nom
if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_etude_modif)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Nom invalide";
}

// Verification du description
if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $description_etude_modif)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Description invalide";
}

// Verification du groupe d'utilisateur
if(!preg_match("/^[0-9\s-]{0,100}$/", $id_grp_utilisateur_modif)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Groupe d'utilisateur invalide";
}

// Verification du groupe d'utilisateur
if(!preg_match("/^[0-9\s-]{0,100}$/", $id_num_version_modif)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Num version invalide";
}
  
if(isset($_POST['modifier_projet']) && $results["error"] === false ){
    // Mettre à jour le projet 
    $update_projet = $bdd->prepare("UPDATE F_projet SET nom_projet = ?, description_projet=?, id_grp_utilisateur=?, id_utilisateur=? WHERE id_projet=?");
    $update_projet->bindParam(1, $nom_etude_modif);
    $update_projet->bindParam(2, $description_etude_modif);
    $update_projet->bindParam(3, $id_grp_utilisateur_modif);
    $update_projet->bindParam(4, $chef_de_projet);
    $update_projet->bindParam(5, $id_etude_modif);
    $update_projet->execute();

    // Mettre à jour le projet général
    // Récupérer l'id_projet et l'id_projet_gen à partir de l'id_version
    $search_projet = $bdd->prepare("SELECT id_projet_gen, id_projet FROM ZC_version WHERE id_version=?");
    $search_projet->bindParam(1,$id_num_version_modif);
    $search_projet->execute();
        
    $ecriture = $search_projet->fetch(PDO::FETCH_ASSOC);
    $id_projet = $ecriture["id_projet"];
    $id_projet_gen = $ecriture["id_projet_gen"];

    $update_projet = $bdd->prepare("UPDATE ZD_projet_gen SET id_projet_desc_current = ? WHERE id_projet_gen=?");
    $update_projet->bindParam(1, $id_projet);
    $update_projet->bindParam(2, $id_projet_gen);
    $update_projet->execute();

    $_SESSION['message_success'] = "Le projet $id_etude_modif a été modifié !";
}

header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
?>