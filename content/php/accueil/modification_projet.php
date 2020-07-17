<?php
session_start();

//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v21;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$results["error"] = false;

$id_etude_modif = $_POST['id_etude_modif'];
$nom_etude_modif = $_POST['nom_etude_modif'];
$description_etude_modif = $_POST['description_etude_modif'];
$id_grp_utilisateur_modif = $_POST['id_grp_utilisateur_modif'];

// Verification du nom
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_etude_modif)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Nom invalide";
}

// Verification du description
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_etude_modif)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Description invalide";
}

// Verification du groupe d'utilisateur
if(!preg_match("/^[0-9\s-]{1,100}$/", $id_grp_utilisateur_modif)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Groupe d'utilisateur invalide";
}
  
if(isset($_POST['modifier_projet']) && $results["error"] === false ){
    $update_projet = $bdd->prepare("UPDATE projet SET nom_projet = ?, description_projet=?, id_grp_utilisateur=? WHERE id_projet=?");
    $update_projet->bindParam(1, $nom_etude_modif);
    $update_projet->bindParam(2, $description_etude_modif);
    $update_projet->bindParam(3, $id_grp_utilisateur_modif);
    $update_projet->bindParam(4, $id_etude_modif);
    $update_projet->execute();

    $_SESSION['message_success'] = "Le projet $id_etude_modif a été modifié !";
}

header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
?>