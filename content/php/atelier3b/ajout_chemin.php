<?php
session_start();
$get_id_projet = $_SESSION['id_projet'];
header('Location: ../../../atelier-3b&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet']);

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];


$id_risque = $_POST['id_risque'];
$chemin_d_attaque_strategique = $_POST['chemin_d_attaque_strategique'];
$nom_scenario_strategique = $_POST['nom_scenario_strategique'];
$nom_partie_prenante = $_POST['nom_partie_prenante'];
$id_chemin_d_attaque = "id_chemin";
$id_scenar = "id_scenar";
$id_atelier = "4.a";

$recupere = $bdd->prepare("SELECT S_scenario_strategique.id_scenario_strategique FROM S_scenario_strategique  WHERE S_scenario_strategique.nom_scenario_strategique = ?");
$recuperepp = $bdd->prepare("SELECT id_partie_prenante FROM R_partie_prenante WHERE nom_partie_prenante = ? AND id_projet = ?");

$insere = $bdd->prepare(
  'INSERT INTO 
  T_chemin_d_attaque_strategique 
  (id_chemin_d_attaque_strategique,id_risque,nom_chemin_d_attaque_strategique,dependance_residuelle, penetration_residuelle, maturite_residuelle,confiance_residuelle, niveau_de_menace_residuelle, id_scenario_strategique, id_partie_prenante) 
  VALUES 
  (?, ?, ?, NULL, NULL, NULL, NULL, NULL, ? ,?)'
);
$insere_reeval = $bdd->prepare(
  'INSERT INTO 
  X_revaluation_du_risque
  (
    id_revaluation, 
  nom_risque_residuelle, 
  description_risque_residuelle, 
  vraisemblance_residuelle, 
  risque_residuel, 
  gestion_risque_residuelle, 
  id_atelier, 
  id_chemin_d_attaque_strategique, 
  id_risque, 
  id_projet
  ) VALUES ("", NULL, NULL, NULL, NULL, NULL,"5.c",?,?,?)'
);

$recuperechemin = $bdd->prepare('SELECT id_chemin_d_attaque_strategique, id_risque FROM T_chemin_d_attaque_strategique
WHERE nom_chemin_d_attaque_strategique = ?
AND  id_risque = ?');

$insereope = $bdd->prepare(
  'INSERT INTO U_scenario_operationnel
  (id_scenario_operationnel, description_scenario_operationnel, vraisemblance, id_atelier, id_chemin_d_attaque_strategique, id_risque, id_projet)
  VALUES
  (?, ?, NULL, ?, ?, ?, ?)'
);


if ($results["error"] === false && isset($_POST['validerchemin'])) {
  $recupere->bindParam(1, $nom_scenario_strategique);
  $recupere->execute();
  $id_scenario_strategique = $recupere->fetch();

  $recuperepp->bindParam(1, $nom_partie_prenante);
  $recuperepp->bindParam(2, $get_id_projet);
  $recuperepp->execute();
  $id_partie_prenante = $recuperepp->fetch();

  $insere->bindParam(1, $id_chemin_d_attaque);
  $insere->bindParam(2, $id_risque);
  $insere->bindParam(3, $chemin_d_attaque_strategique);
  $insere->bindParam(4, $id_scenario_strategique[0]);
  $insere->bindParam(5, $id_partie_prenante[0]);
  $insere->execute();

  $recuperechemin->bindParam(1, $chemin_d_attaque_strategique);
  $recuperechemin->bindParam(2, $id_risque);
  $recuperechemin->execute();
  $resultchemin = $recuperechemin->fetch();

  $insere_reeval->bindParam(2, $resultchemin[0]);
  $insere_reeval->bindParam(3, $resultchemin[1]);
  $insere_reeval->bindParam(4, $get_id_projet);
  $insere_reeval->execute();

  $description_ope = "Scenario opérationnel pour : " . $chemin_d_attaque_strategique;
  echo $description_ope;
  $insereope->bindParam(1, $id_scenar);
  $insereope->bindParam(2, $description_ope);
  $insereope->bindParam(3, $id_atelier);
  $insereope->bindParam(4, $resultchemin[0]);
  $insereope->bindParam(5, $resultchemin[1]);
  $insereope->bindParam(6, $get_id_projet);
  $insereope->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>