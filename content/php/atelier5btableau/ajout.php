<?php
session_start();
header('Location: ../../../atelier5btableau.php?id_utilisateur='.$_SESSION['id_utilisateur'].'&id_projet='.$_SESSION['id_projet']);

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_chemin = $_POST['chemin'];
echo $id_chemin;
$id_mesure = "id_mesure";
$id_traitement = "id_traitement";
$nom_mesure = $_POST['nommesure'];
$description_mesure = $_POST['descriptionmesure'];
$dependance = $_POST['dependance'];
$penetration = $_POST['penetration'];
$maturite = $_POST['maturite'];
$confiance = $_POST['confiance'];
$id_projet = $_SESSION['id_projet'];
// echo $dependance;
// echo $penetration;
// echo $maturite;
// echo $confiance;
$id_atelier = "5.b";
$insere_mesure = $bdd->prepare('INSERT INTO Y_mesure (id_mesure, nom_mesure, description_mesure) VALUES (?, ?, ?)');
$recupere_mesure = $bdd->prepare('SELECT id_mesure FROM Y_mesure WHERE nom_mesure = ? AND description_mesure = ?');
$recupere_risque = $bdd->prepare('SELECT id_risque FROM T_chemin_d_attaque_strategique WHERE id_chemin_d_attaque_strategique = ?');
$insere2 = $bdd->prepare('INSERT INTO ZB_comporter_2 (id_mesure, id_chemin_d_attaque_strategique, id_risque) VALUES (?,?,?)');
$recupere_id_pp = $bdd->prepare('SELECT id_partie_prenante FROM T_chemin_d_attaque_strategique WHERE id_chemin_d_attaque_strategique = ?');
$recupere_pp = $bdd->prepare('SELECT ponderation_dependance, ponderation_penetration, ponderation_maturite, ponderation_confiance FROM R_partie_prenante WHERE id_partie_prenante = ?');
$insere_traitement = $bdd->prepare('INSERT INTO ZA_traitement_de_securite (id_traitement_de_securite, id_atelier, id_projet, id_mesure) VALUES (?, ?, ?, ?)');

$updatechemin = $bdd->prepare(
  'UPDATE T_chemin_d_attaque_strategique
  SET dependance_residuelle = ?,
  penetration_residuelle = ?,
  maturite_residuelle = ?,
  confiance_residuelle = ?,
  niveau_de_menace_residuelle = ?
  WHERE id_chemin_d_attaque_strategique = ?
  '
);


if ($results["error"] === false && isset($_POST['ajouterregle'])) {
  // $recupere->bindParam(1, $nom_valeur_metier);
  // $recupere->execute();
  // $id_valeur_metier = $recupere->fetch();
  $insere_mesure->bindParam(1, $id_mesure);
  $insere_mesure->bindParam(2, $nom_mesure);
  $insere_mesure->bindParam(3, $description_mesure);
  $insere_mesure->execute();

  $recupere_mesure->bindParam(1, $nom_mesure);
  $recupere_mesure->bindParam(2, $description_mesure);
  $recupere_mesure->execute();
  $id_mesure = $recupere_mesure->fetch();
  // echo $id_mesure[0];

  $recupere_risque->bindParam(1, $id_chemin);
  // echo $id_chemin;
  $recupere_risque->execute();
  $id_risque = $recupere_risque->fetch();
  // echo $id_risque[0];

  $insere2->bindParam(1, $id_mesure[0]);
  $insere2->bindParam(2, $id_chemin);
  $insere2->bindParam(3, $id_risque[0]);
  $insere2->execute();

  //calcul menace residuelle
  $recupere_id_pp->bindParam(1, $id_chemin);
  $recupere_id_pp->execute();
  $id_pp = $recupere_id_pp->fetch();
  print_r($id_pp);
  $recupere_pp->bindParam(1, $id_pp[0]);
  $recupere_pp->execute();
  $result_pp = $recupere_pp->fetch();
  
  // print_r($result_pp);
  $ponderation_dependance = $result_pp[0];
  $ponderation_penetration = $result_pp[1];
  $ponderation_maturite = $result_pp[2];
  $ponderation_confiance = $result_pp[3];
  print $ponderation_dependance;
  print $ponderation_penetration;
  print $ponderation_maturite;
  print $ponderation_confiance;
  
  $menace_residuelle = ($dependance*$ponderation_dependance * $penetration*$ponderation_penetration) / ($maturite*$ponderation_maturite * $confiance*$ponderation_confiance);
  $updatechemin->bindParam(1, $dependance);
  $updatechemin->bindParam(2, $penetration);
  $updatechemin->bindParam(3, $maturite);
  $updatechemin->bindParam(4, $confiance);
  $updatechemin->bindParam(5, $menace_residuelle);
  $updatechemin->bindParam(6, $id_chemin);
  $updatechemin->execute();

  $insere_traitement->bindParam(1, $id_traitement);
  $insere_traitement->bindParam(2, $id_atelier);
  $insere_traitement->bindparam(3, $id_projet);
  $insere_traitement->bindParam(4, $id_mesure[0]);
  $insere_traitement->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>