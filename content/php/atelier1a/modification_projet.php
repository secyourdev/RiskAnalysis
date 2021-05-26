<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

if(isset($_POST['nom_etude'])){
    $nom_etude = $_POST['nom_etude'];
    $update_projet = $bdd->prepare("UPDATE F_projet SET nom_projet = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $nom_etude);
    $update_projet->bindParam(2, $getid_projet);
    if(preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_etude)){
      $update_projet->execute();
    }
}

if(isset($_POST['description_etude'])){
  $description_etude = $_POST['description_etude'];
  $update_projet = $bdd->prepare("UPDATE F_projet SET description_projet = ? WHERE id_projet=?");
  $update_projet->bindParam(1, $description_etude);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $description_etude)){
    $update_projet->execute();
  }
}


if(isset($_POST['objectif_atteindre'])){
    $objectif_atteindre = $_POST['objectif_atteindre'];
    $update_projet = $bdd->prepare("UPDATE F_projet SET objectif_projet = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $objectif_atteindre);
    $update_projet->bindParam(2, $getid_projet);
    if(preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $objectif_atteindre)){
      $update_projet->execute();
    }
}

if(isset($_POST['respo_acceptation_risque'])){
    $respo_acceptation_risque = $_POST['respo_acceptation_risque'];
    $update_projet = $bdd->prepare("UPDATE F_projet SET responsable_risque_residuel = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $respo_acceptation_risque);
    $update_projet->bindParam(2, $getid_projet);
    if(preg_match("/^[0-9\s-]{0,100}$/", $respo_acceptation_risque)){
      $update_projet->execute();
    }
}

if(isset($_POST['cadre_temporel'])){
    $cadre_temporel = $_POST['cadre_temporel'];
    $update_projet = $bdd->prepare("UPDATE F_projet SET cadre_temporel = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $cadre_temporel);
    $update_projet->bindParam(2, $getid_projet);
    if(preg_match("/^[0-9\s-]{0,100}$/", $cadre_temporel)){
      $update_projet->execute();
    }
}

if(isset($_POST['cadre_temporel_etape_2'])){
  $cadre_temporel_etape_2 = $_POST['cadre_temporel_etape_2'];
  $update_projet = $bdd->prepare("UPDATE F_projet SET cadre_temporel_etape_2 = ? WHERE id_projet=?");
  $update_projet->bindParam(1, $cadre_temporel_etape_2);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[0-9\s-]{0,100}$/", $cadre_temporel_etape_2)){
    $update_projet->execute();
  }
}

if(isset($_POST['cadre_temporel_etape_3'])){
  $cadre_temporel_etape_3 = $_POST['cadre_temporel_etape_3'];
  $update_projet = $bdd->prepare("UPDATE F_projet SET cadre_temporel_etape_3 = ? WHERE id_projet=?");
  $update_projet->bindParam(1, $cadre_temporel_etape_3);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[0-9\s-]{0,100}$/", $cadre_temporel_etape_3)){
    $update_projet->execute();
  }
}

if(isset($_POST['cadre_temporel_etape_4'])){
  $cadre_temporel_etape_4 = $_POST['cadre_temporel_etape_4'];
  $update_projet = $bdd->prepare("UPDATE F_projet SET cadre_temporel_etape_4 = ? WHERE id_projet=?");
  $update_projet->bindParam(1, $cadre_temporel_etape_4);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[0-9\s-]{0,100}$/", $cadre_temporel_etape_4)){
    $update_projet->execute();
  }
}

if(isset($_POST['cadre_temporel_etape_5'])){
  $cadre_temporel_etape_5 = $_POST['cadre_temporel_etape_5'];
  $update_projet = $bdd->prepare("UPDATE F_projet SET cadre_temporel_etape_5 = ? WHERE id_projet=?");
  $update_projet->bindParam(1, $cadre_temporel_etape_5);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[0-9\s-]{0,100}$/", $cadre_temporel_etape_5)){
    $update_projet->execute();
  }
}

if(isset($_POST['confidentialite'])){
  $confidentialite = $_POST['confidentialite'];
  $update_projet = $bdd->prepare("UPDATE F_projet SET confidentialite = ? WHERE id_projet=?");
  $update_projet->bindParam(1, $confidentialite);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $confidentialite)){
    $update_projet->execute();
  }
}

if(isset($_POST['cycle_strategique'])){
  $cycle_strategique = $_POST['cycle_strategique'];
  $update_projet = $bdd->prepare("UPDATE F_projet SET duree_strategique  = ? WHERE id_projet=?");
  $update_projet->bindParam(1, $cycle_strategique);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $cycle_strategique)){
    $update_projet->execute();
  }
}

if(isset($_POST['cycle_operationnel'])){
  $cycle_operationnel = $_POST['cycle_operationnel'];
  $update_projet = $bdd->prepare("UPDATE F_projet SET duree_operationnel  = ? WHERE id_projet=?");
  $update_projet->bindParam(1, $cycle_operationnel);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $cycle_operationnel)){
    $update_projet->execute();
  }
}

if(isset($_POST['nom_grp_utilisateur'])){
  $nom_grp_utilisateur = $_POST['nom_grp_utilisateur'];
  $search_id_grp_utilisateur = $bdd->prepare("SELECT `id_grp_utilisateur` FROM `B_grp_utilisateur` WHERE `nom_grp_utilisateur`=?");
  $search_id_grp_utilisateur->bindParam(1, $nom_grp_utilisateur);
  $search_id_grp_utilisateur->execute();
  $resultat = $search_id_grp_utilisateur->fetch();
  $update_projet = $bdd->prepare("UPDATE `F_projet` SET `id_grp_utilisateur` = ? WHERE `F_projet`.`id_projet`=?");
  $update_projet->bindParam(1, $resultat[0]);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[0-9\s-]{0,100}$/", $resultat[0])){
    $update_projet->execute();
  }
}

?>