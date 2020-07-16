<?php
  session_start();
  $getid_projet = $_SESSION['id_projet'];

  header('Location: ../../../atelier-1b&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet']);
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

$nomvm = $_POST['nomvm'];
$nature = $_POST['nature'];
$descriptionvm = $_POST['descriptionvm'];

$id_valeur_metier = "valeur_metier";
$id_atelier = "1.b";

$inserevm = $bdd->prepare('INSERT INTO valeur_metier(id_valeur_metier, nom_valeur_metier, nature_valeur_metier, description_valeur_metier, id_atelier, id_projet) VALUES (?,?,?,?,?,?)');


// Verification du nom de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nomvm)) {
  $results["error"] = true;
  $results["message"]["nom"] = "Nom invalide";
?>
  <strong style="color:#FF6565;">Nom invalide </br></strong>
<?php
}

// Verification de la description de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $descriptionvm)) {
  $results["error"] = true;
  $results["message"]["description"] = "Description invalide";
?>
  <strong style="color:#FF6565;">Description invalide </br></strong>
<?php
}

// Verification de la nature de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nature)) {
  $results["error"] = true;
  $results["message"]["nature"] = "Nature invalide";
?>
  <strong style="color:#FF6565;">Nature invalide </br></strong>
<?php
}

if ($results["error"] === false && isset($_POST['validervm'])) {
  $inserevm->bindParam(1, $id_valeur_metier);
  $inserevm->bindParam(2, $nomvm);
  $inserevm->bindParam(3, $nature);
  $inserevm->bindParam(4, $descriptionvm);
  $inserevm->bindParam(5, $id_atelier);
  $inserevm->bindParam(6, $getid_projet);
  $inserevm->execute();
?>
  <strong style="color:#4AD991;">La valeur métier a bien été ajoutée !</br></strong>
<?php
}
?>