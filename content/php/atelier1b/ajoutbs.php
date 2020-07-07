<?php
header('Location: ../../../atelier-1b');


//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v14;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$results["error"] = false;
$results["message"] = [];


$biensupport = $_POST['biensupport'];
// $vm = $_POST['vm'];
$descriptionbs = $_POST['descriptionbs'];
// $nomresponsablebs = $_POST['nomresponsablebs'];
// $prenomresponsablebs = $_POST['prenomresponsablebs'];
// $posteresponsablebs = $_POST['posteresponsablebs'];
$id_bien_support = "id_bien_support";
$id_atelier = "1.b";
$id_projet = "1";

// $recuperepersonne = $bdd->prepare('SELECT id_personne FROM personne WHERE nom = ? AND prenom = ? AND poste = ?');
// $recuperevm = $bdd->prepare('SELECT id_valeur_metier FROM valeur_metier WHERE nom_valeur_metier = ?');
// $inserepersonne = $bdd->prepare('INSERT INTO personne(id_personne, nom, prenom, poste) VALUES (?,?,?,?)');
$inserebs = $bdd->prepare('INSERT INTO bien_support(id_bien_support, nom_bien_support, description_bien_support, id_atelier, id_valeur_metier, id_personne, id_projet) VALUES (?,?,?,?,NULL,NULL,?)');




// Verification du nom du bien support
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $biensupport)) {
  $results["error"] = true;
  $results["message"]["nom"] = "Nom invalide";
?>
  <strong style="color:#FF6565;">Nom invalide </br></strong>
<?php
}

// Verification de la description du bien support
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $descriptionbs)) {
  $results["error"] = true;
  $results["message"]["nom"] = "Description invalide";
?>
  <strong style="color:#FF6565;">Description invalide </br></strong>
<?php
}
/* 
// Verification du nom du responsable de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nomresponsablebs)) {
  $results["error"] = true;
  $results["message"]["nom"] = "Nom du responsable invalide";
?>
  <strong style="color:#FF6565;">Nom du responsable invalide </br></strong>
<?php
}

// Verification du prénom du responsable de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenomresponsablebs)) {
  $results["error"] = true;
  $results["message"]["nom"] = "Prénom du responsable invalide";
?>
  <strong style="color:#FF6565;">Prénom du responsable invalide </br></strong>
<?php
}

// Verification du poste du responsable de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $posteresponsablebs)) {
  $results["error"] = true;
  $results["message"]["nom"] = "Poste du responsable invalide";
?>
  <strong style="color:#FF6565;">Poste du responsable invalide </br></strong>
<?php
} */

if ($results["error"] === false && isset($_POST['validerbs'])) {
  // $inserepersonne->bindParam(1, $id_personne);
  // $inserepersonne->bindParam(2, $nomresponsablebs);
  // $inserepersonne->bindParam(3, $prenomresponsablebs);
  // $inserepersonne->bindParam(4, $posteresponsablebs);
  // $inserepersonne->execute();
  // $recuperepersonne->bindParam(1, $nomresponsablebs);
  // $recuperepersonne->bindParam(2, $prenomresponsablebs);
  // $recuperepersonne->bindParam(3, $posteresponsablebs);
  // $recuperepersonne->execute();
  // $id_personne = $recuperepersonne->fetch();
  // $recuperevm->bindParam(1, $vm);
  // $recuperevm->execute();
  // $id_valeur_metier = $recuperevm->fetch();

  $inserebs->bindParam(1, $id_bien_support);
  $inserebs->bindParam(2, $biensupport);
  $inserebs->bindParam(3, $descriptionbs);
  $inserebs->bindParam(4, $id_atelier);
  // $inserebs->bindParam(5, $id_valeur_metier[0]);
  // $inserebs->bindParam(6, $id_personne[0]);
  $inserebs->bindParam(5, $id_projet);
  $inserebs->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>