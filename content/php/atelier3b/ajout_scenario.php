<?php
session_start();
header('Location: ../../../atelier-3b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];


$nom_scenario_strategique = $_POST['nom_scenario_strategique'];
$id_source_de_risque = $_POST['id_source_de_risque'];
$id_evenement_redoute = $_POST['id_evenement_redoute'];


$id_atelier = '3.b';
$id_projet = $_SESSION['id_projet'];
$id_scenario = 'id_scenario';

$insere = $bdd->prepare(
  'INSERT INTO S_scenario_strategique 
  (id_scenario_strategique, nom_scenario_strategique, id_atelier, id_source_de_risque, id_evenement_redoute, id_projet)
   VALUES 
   ( ?, ?, ?, ?, ?, ?)'
);

if ($results["error"] === false && isset($_POST['validerscenario'])) {

  $insere->bindParam(1, $id_scenario);
  $insere->bindParam(2, $nom_scenario_strategique);
  $insere->bindParam(3, $id_atelier);
  $insere->bindParam(4, $id_source_de_risque);
  $insere->bindParam(5, $id_evenement_redoute);
  $insere->bindParam(6, $id_projet);

  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>