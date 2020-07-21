<?php
// header('Location: ../../../atelier-3b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];


$nom_scenario_strategique = $_POST['nom_scenario_strategique'];
$description_source_de_risque = $_POST['description_source_de_risque'];
$objectif_vise = $_POST['objectif_vise'];
$nom_evenement_redoute = $_POST['nom_evenement_redoute'];
$id_risque = $_POST['id_risque'];
$chemin_d_attaque_strategique = $_POST['chemin_d_attaque_strategique'];
$niveau_de_gravite = $_POST['niveau_de_gravite'];

$recupere = $bdd->prepare("SELECT id_chemin_d_attaque_strategique, nom_scenario_strategique,description_source_de_risque,objectif_vise,nom_evenement_redoute, id_risque, chemin_d_attaque_strategique, niveau_de_gravite FROM T_chemin_d_attaque_strategique, S_scenario_strategique, P_SROV , M_evenement_redoute WHERE T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique AND S_scenario_strategique.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute AND S_scenario_strategique.id_source_de_risque = P_SROV.id_source_de_risque");

$insere = $bdd->prepare(
  'INSERT INTO T_chemin_d_attaque_strategique (
    id_risque,
    chemin_d_attaque_strategique, 
    ) 
    VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ? )'
);
$insere = $bdd->prepare(
  'INSERT INTO S_scenario_strategique (
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
  'INSERT INTO P_SROV  (
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
header('Location: ../../../atelier-3b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#scenario_strategique');
?>