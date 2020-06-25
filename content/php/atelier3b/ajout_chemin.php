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


$id_risque = $_POST['id_risque'];
$chemin_d_attaque_strategique = $_POST['chemin_d_attaque_strategique'];
$id_scenario_strategique = $_POST['id_scenario_strategique'];

$insere = $bdd->prepare(
  'INSERT INTO 
  chemin_d_attaque_strategique 
  (id_risque,chemin_d_attaque_strategique,dependance_residuelle, penetration_residuelle, maturite_residuelle,confiance_residuelle, niveau_de_menance_residuelle, id_scenario_strategique) 
  VALUES 
  ( ?, ?, NULL, NULL, NULL, NULL, NULL, ? )'
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

  $insere->bindParam(1, $id_risque);
  $insere->bindParam(2, $chemin_d_attaque_strategique);
  $insere->bindParam(3, $id_scenario_strategique);

  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>