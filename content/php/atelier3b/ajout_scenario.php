<?php
session_start();
header('Location: ../../../atelier-3b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);


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

$results["error"] = false;
$results["message"] = [];


$nom_scenario_strategique = $_POST['nom_scenario_strategique'];
$id_source_de_risque = $_POST['id_source_de_risque'];
$id_evenement_redoute = $_POST['id_evenement_redoute'];


$id_atelier = '3.b';
$id_projet = $_SESSION['id_projet'];
$id_scenario = 'id_scenario';

$insere = $bdd->prepare(
  'INSERT INTO scenario_strategique 
  (id_scenario_strategique, nom_scenario_strategique, id_atelier, id_source_de_risque, id_evenement_redoute, id_projet)
   VALUES 
   ( ?, ?, ?, ?, ?, ?)'
);

// Verification du nom_scenario_strategique
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_scenario_strategique)) {
  $results["error"] = true;
  $results["message"]["nom_scenario_strategique"] = "nom_scenario_strategique invalide";
?>
  <strong style="color:#FF6565;">nom_scenario_strategique invalide </br></strong>
<?php
}


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