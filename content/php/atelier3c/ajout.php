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
$results["message"] = [];


$id_partie_prenante = $_POST['partieprenante'];
$chemin = $_POST['chemins'];

// Pour les régles du référentiel
// $referentiel = $_POST['referentiel'];
// $id_mesure = $_POST['mesure'];
$nom_mesure = $_POST['nommesure'];
$description_mesure = $_POST['descriptionmesure'];
$dependance = $_POST['dependance'];
$penetration = $_POST['penetration'];
$maturite = $_POST['maturite'];
$confiance = $_POST['confiance'];
$id_atelier = '3.c';

// Pour les règles du référentiel

// $recupere_regle = $bdd->prepare("SELECT id_regle_affichage FROM regle WHERE id_regle = ?");

// $recupere_risque = $bdd->prepare("SELECT id_risque FROM chemin_d_attaque_strategique WHERE id_chemin_d_attaque_strategique = ?");

// $inserecomporte = $bdd->prepare(
//   'INSERT INTO comporter_3 (
//     id_regle, 
//     id_regle_affichage, 
//     id_chemin_d_attaque_strategique, 
//     id_risque
//     ) 
//     VALUES (?, ?, ?, ?)'
//     );

// $updatechemin = $bdd->prepare(
//   'UPDATE chemin_d_attaque_strategique
//   SET dependance_residuelle = ?,
//   penetration_residuelle = ?,
//   maturite_residuelle = ?,
//   confiance_residuelle = ?
//   WHERE id_chemin_d_attaque_strategique = ?
//   '
// );


$insere_mesure = $bdd->prepare("INSERT INTO mesure (id_mesure, nom_mesure, description_mesure) VALUES (?,?,?)");

$recupere_mesure = $bdd->prepare("SELECT id_mesure FROM mesure WHERE nom_mesure = ? AND description_mesure = ?");

$recupere_risque = $bdd->prepare("SELECT id_risque FROM chemin_d_attaque_strategique WHERE id_chemin_d_attaque_strategique = ?");

$insere_comporte = $bdd->prepare("INSERT INTO comporter_2 (id_mesure, id_chemin_d_attaque_strategique, id_risque) VALUES (?,?,?)");

$recupere_pp = $bdd->prepare("SELECT ponderation_dependance, ponderation_penetration, ponderation_maturite, ponderation_confiance FROM partie_prenante WHERE id_partie_prenante = ?");

$updatechemin = $bdd->prepare(
  'UPDATE chemin_d_attaque_strategique
  SET dependance_residuelle = ?,
  penetration_residuelle = ?,
  maturite_residuelle = ?,
  confiance_residuelle = ?,
  niveau_de_menace_residuelle = ?
  WHERE id_chemin_d_attaque_strategique = ?
  '
);

// if ($results["error"] === false && isset($_POST['validermesure'])) {
  
//   $recupere_regle->bindParam(1, $id_mesure);
//   $recupere_regle->execute();
//   $id_regle_affichage = $recupere_regle->fetch();

//   $recupere_risque->bindParam(1, $chemin);
//   $recupere_risque->execute();
//   $id_risque = $recupere_risque->fetch();
//   $inserecomporte->bindParam(1, $id_mesure);
//   $inserecomporte->bindParam(2, $id_regle_affichage[0]);
//   $inserecomporte->bindParam(3, $chemin);
//   $inserecomporte->bindParam(4, $id_risque[0]);
//   $inserecomporte->execute();
//   $updatechemin->bindParam(1, $dependance);
//   $updatechemin->bindParam(2, $penetration);
//   $updatechemin->bindParam(3, $maturite);
//   $updatechemin->bindParam(4, $confiance);
//   $updatechemin->bindParam(5, $chemin);
//   $updatechemin->execute();
// ?>
<!-- //   <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
// <?php 
// }

if ($results["error"] === false && isset($_POST['validermesure'])) {
  // insere mesure
  $insere_mesure->bindParam(1, $nom_mesure);
  $insere_mesure->bindParam(2, $nom_mesure);
  $insere_mesure->bindParam(3, $description_mesure);
  $insere_mesure->execute();
  // recupere l'id de la mesure
  $recupere_mesure->bindParam(1, $nom_mesure);
  $recupere_mesure->bindParam(2, $description_mesure);
  $recupere_mesure->execute();
  $id_mesure = $recupere_mesure->fetch();
  // recupere l'ID du risque
  $recupere_risque->bindParam(1, $chemin);
  $recupere_risque->execute();
  $id_risque = $recupere_risque->fetch();
  // insere dans comporte4
  $insere_comporte->bindParam(1, $id_mesure[0]);
  $insere_comporte->bindParam(2, $chemin);
  $insere_comporte->bindParam(3, $id_risque[0]);
  $insere_comporte->execute();
  // update le chemin
  //calcule menace residuelle
  $recupere_pp->bindParam(1, $id_partie_prenante);
  $recupere_pp->execute();
  $result_pp = $recupere_pp->fetch();

  $ponderation_dependance = $result_pp[0];
  $ponderation_penetration = $result_pp[1];
  $ponderation_maturite = $result_pp[2];
  $ponderation_confiance = $result_pp[3];
  echo $ponderation_dependance;
  echo $ponderation_penetration;
  echo $ponderation_maturite;
  echo $ponderation_confiance;
  $menace_residuelle = ($dependance*$ponderation_dependance * $penetration*$ponderation_penetration) / ($maturite*$ponderation_maturite * $confiance*$ponderation_confiance);
  $updatechemin->bindParam(1, $dependance);
  $updatechemin->bindParam(2, $penetration);
  $updatechemin->bindParam(3, $maturite);
  $updatechemin->bindParam(4, $confiance);
  $updatechemin->bindParam(5, $menace_residuelle);
  $updatechemin->bindParam(6, $chemin);
  $updatechemin->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

header('Location: ../../../atelier-3c&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);
?>