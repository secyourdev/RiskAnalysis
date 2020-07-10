<?php
session_start();
header('Location: ../../../atelier-3b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);


//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v18;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$results["error"] = false;
$results["message"] = [];


$id_risque = $_POST['id_risque'];
$chemin_d_attaque_strategique = $_POST['chemin_d_attaque_strategique'];
$nom_scenario_strategique = $_POST['nom_scenario_strategique'];
$nom_partie_prenante = $_POST['nom_partie_prenante'];
$id_chemin_d_attaque = "id_chemin";


$recupere = $bdd->prepare("SELECT scenario_strategique.id_scenario_strategique FROM scenario_strategique  WHERE scenario_strategique.nom_scenario_strategique = ?");
$recuperepp = $bdd->prepare("SELECT id_partie_prenante FROM partie_prenante WHERE nom_partie_prenante = ?");

$insere = $bdd->prepare(
  'INSERT INTO 
  chemin_d_attaque_strategique 
  (id_chemin_d_attaque_strategique,id_risque,nom_chemin_d_attaque_strategique,dependance_residuelle, penetration_residuelle, maturite_residuelle,confiance_residuelle, niveau_de_menance_residuelle, id_scenario_strategique, id_partie_prenante) 
  VALUES 
  (?, ?, ?, NULL, NULL, NULL, NULL, NULL, ? ,?)'
);



// Verification du chemin_d_attaque_strategique
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $chemin_d_attaque_strategique)) {
  $results["error"] = true;
  $results["message"]["chemin_d_attaque_strategique"] = "chemin_d_attaque_strategique invalide";
?>
  <strong style="color:#FF6565;">chemin_d_attaque_strategique invalide </br></strong>
<?php
}


if ($results["error"] === false && isset($_POST['validerchemin'])) {
  $recupere->bindParam(1, $nom_scenario_strategique);
  $recupere->execute();
  $id_scenario_strategique = $recupere->fetch();

  $recuperepp->bindParam(1, $nom_partie_prenante);
  $recuperepp->execute();
  $id_partie_prenante = $recuperepp->fetch();

  $insere->bindParam(1, $id_chemin_d_attaque);
  $insere->bindParam(2, $id_risque);
  $insere->bindParam(3, $chemin_d_attaque_strategique);
  $insere->bindParam(4, $id_scenario_strategique[0]);
  $insere->bindParam(5, $id_partie_prenante[0]);
  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>