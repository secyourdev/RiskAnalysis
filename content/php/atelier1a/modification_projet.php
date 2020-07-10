<?php
session_start();
$getid_projet = $_SESSION['id_projet'];

//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v17;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

if(isset($_POST['nom_etude'])){
    $nom_etude = $_POST['nom_etude'];
    $update_projet = $bdd->prepare("UPDATE projet SET nom_projet = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $nom_etude);
    $update_projet->bindParam(2, $getid_projet);
    if(preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_etude)){
      $update_projet->execute();
    }
}

if(isset($_POST['description_etude'])){
  $description_etude = $_POST['description_etude'];
  $update_projet = $bdd->prepare("UPDATE projet SET description_projet = ? WHERE id_projet=?");
  $update_projet->bindParam(1, $description_etude);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $description_etude)){
    $update_projet->execute();
  }
}


if(isset($_POST['objectif_atteindre'])){
    $objectif_atteindre = $_POST['objectif_atteindre'];
    $update_projet = $bdd->prepare("UPDATE projet SET objectif_projet = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $objectif_atteindre);
    $update_projet->bindParam(2, $getid_projet);
    if(preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $objectif_atteindre)){
      $update_projet->execute();
    }
}

if(isset($_POST['respo_acceptation_risque'])){
    $respo_acceptation_risque = $_POST['respo_acceptation_risque'];
    $update_projet = $bdd->prepare("UPDATE projet SET responsable_risque_residuel = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $respo_acceptation_risque);
    $update_projet->bindParam(2, $getid_projet);
    if(preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $respo_acceptation_risque)){
      $update_projet->execute();
    }
}

if(isset($_POST['cadre_temporel'])){
    $cadre_temporel = $_POST['cadre_temporel'];
    $update_projet = $bdd->prepare("UPDATE projet SET cadre_temporel = ? WHERE id_projet=?");
    $update_projet->bindParam(1, $cadre_temporel);
    $update_projet->bindParam(2, $getid_projet);
    if(preg_match("/^[0-9\s-]{1,100}$/", $cadre_temporel)){
      $update_projet->execute();
    }
}

if(isset($_POST['nom_grp_utilisateur'])){
  $nom_grp_utilisateur = $_POST['nom_grp_utilisateur'];
  echo $nom_grp_utilisateur;
  $search_id_grp_utilisateur = $bdd->prepare("SELECT `id_grp_utilisateur` FROM `grp_utilisateur` WHERE `nom_grp_utilisateur`=?");
  $search_id_grp_utilisateur->bindParam(1, $nom_grp_utilisateur);
  $search_id_grp_utilisateur->execute();
  $resultat = $search_id_grp_utilisateur->fetch();
  $update_projet = $bdd->prepare("UPDATE `projet` SET `id_grp_utilisateur` = ? WHERE `projet`.`id_projet`=?");
  $update_projet->bindParam(1, $resultat[0]);
  $update_projet->bindParam(2, $getid_projet);
  if(preg_match("/^[0-9\s-]{1,100}$/", $resultat[0])){
    $update_projet->execute();
  }
}

?>