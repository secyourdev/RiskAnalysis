<?php
session_start();
$id_projet = $_SESSION['id_projet'];

include("../bdd/connexion.php");

$results["error"] = false;

$nom_echelle=$_POST['nom_echelle'];
$nb_niveau_echelle=$_POST['nb_niveau_echelle'];


// Par défaut le niveau de vraisemblance d'une échelle est de 5
$insere = $bdd->prepare('INSERT INTO `DC_echelle_vraisemblance`(`nom_echelle`, `nb_niveau_echelle`,`id_projet`) VALUES (?,?,?)');

  // Verification du nom de l'echelle
  if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_echelle)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Nom de l'échelle invalide";
  }

  if ($results["error"] === false && isset($_POST['validerechelle'])){
    $insere->bindParam(1, $nom_echelle);
    $insere->bindParam(2, $nb_niveau_echelle);
    $insere->bindParam(3, $id_projet);
    $insere->execute();
   
    $_SESSION['message_success'] = "L'échelle a bien été ajoutée !";
  }

  header('Location: ../../../atelier-4b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#echelle');

?>