<?php
header('Location: ../../../atelier-3b');


//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v9;charset=utf8',
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
$description_source_de_risque = $_POST['description_source_de_risque'];
$objectif_vise = $_POST['objectif_vise'];
$nom_evenement_redoute = $_POST['nom_evenement_redoute'];
$id_risque = $_POST['id_risque'];
$chemin_d_attaque_strategique = $_POST['chemin_d_attaque_strategique'];
$niveau_de_gravite = $_POST['niveau_de_gravite'];

$recupere = $bdd->prepare("SELECT id_chemin_d_attaque_strategique, nom_scenario_strategique,description_source_de_risque,objectif_vise,nom_evenement_redoute, id_risque, chemin_d_attaque_strategique, niveau_de_gravite FROM chemin_d_attaque_strategique, scenario_strategique, SROV , evenement_redoute WHERE chemin_d_attaque_strategique.id_scenario_strategique = scenario_strategique.id_scenario_strategique AND scenario_strategique.id_evenement_redoute = evenement_redoute.id_evenement_redoute AND scenario_strategique.id_source_de_risque = SROV.id_source_de_risque");

$insere = $bdd->prepare(
  'INSERT INTO chemin_d_attaque_strategique (
    id_risque,
    chemin_d_attaque_strategique, 
    ) 
    VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ? )'
);
$insere = $bdd->prepare(
  'INSERT INTO scenario_strategique (
    id_partie_prenante, 
    nom_scenario_strategique, 
    description_source_de_risque, 
    objectif_vise, 
    nom_evenement_redoute, 
    id_risque,
    chemin_d_attaque_strategique, 
    niveau_de_gravite, 
    niveau_de_menace_partie_prenante,
    ) 
    VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ? )'
);
$insere = $bdd->prepare(
  'INSERT INTO SROV  (
    id_partie_prenante, 
    nom_scenario_strategique, 
    description_source_de_risque, 
    objectif_vise, 
    nom_evenement_redoute, 
    id_risque,
    chemin_d_attaque_strategique, 
    niveau_de_gravite, 
    niveau_de_menace_partie_prenante,
    ) 
    VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ? )'
);


/* // Verification du nom_valeur_metier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)) {
  $results["error"] = true;
  $results["message"]["nom_valeur_metier"] = "nom_valeur_metier invalide";
?>
  <strong style="color:#FF6565;">nom_valeur_metier invalide </br></strong>
<?php
} */


if ($results["error"] === false && isset($_POST['validerpartie'])) {

  $insere->bindParam(1, $id_partie_prenante);
  $insere->bindParam(2, $nom_scenario_strategique);
  $insere->bindParam(3, $description_source_de_risque);
  $insere->bindParam(4, $objectif_vise);
  $insere->bindParam(5, $nom_evenement_redoute);
  $insere->bindParam(6, $id_risque);
  $insere->bindParam(7, $chemin_d_attaque_strategique);
  $insere->bindParam(8, $niveau_de_gravite);
  $insere->bindParam(9, $niveau_de_menace_partie_prenante);
  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>