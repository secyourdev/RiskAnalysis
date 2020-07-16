<?php
header('Location: ../../../atelier-3a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);


//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v20;charset=utf8',
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
echo $dependance;
echo $penetration;
echo $maturite;
echo $confiance;
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


$insere_mesure = $bdd->prepare("INSERT INTO mesure")


/* // Verification du nom_valeur_metier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)) {
  $results["error"] = true;
  $results["message"]["nom_valeur_metier"] = "nom_valeur_metier invalide";
?>
  <strong style="color:#FF6565;">nom_valeur_metier invalide </br></strong>
<?php
} */


if ($results["error"] === false && isset($_POST['validermesure'])) {
  
  $recupere_regle->bindParam(1, $id_mesure);
  $recupere_regle->execute();
  $id_regle_affichage = $recupere_regle->fetch();

  $recupere_risque->bindParam(1, $chemin);
  $recupere_risque->execute();
  $id_risque = $recupere_risque->fetch();
  $inserecomporte->bindParam(1, $id_mesure);
  $inserecomporte->bindParam(2, $id_regle_affichage[0]);
  $inserecomporte->bindParam(3, $chemin);
  $inserecomporte->bindParam(4, $id_risque[0]);
  $inserecomporte->execute();
  $updatechemin->bindParam(1, $dependance);
  $updatechemin->bindParam(2, $penetration);
  $updatechemin->bindParam(3, $maturite);
  $updatechemin->bindParam(4, $confiance);
  $updatechemin->bindParam(5, $chemin);
  $updatechemin->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>