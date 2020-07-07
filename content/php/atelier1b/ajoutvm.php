<?php
  session_start();
  $getid_projet = $_SESSION['id_projet'];

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


$nomvm = $_POST['nomvm'];
$nature = $_POST['nature'];
$descriptionvm = $_POST['descriptionvm'];

$id_valeur_metier = "valeur_metier";
$id_atelier = "1.b";
$id_projet = "1";
// $nommission=$_POST['nommission'];

// $recuperepersonne = $bdd->prepare('SELECT id_personne FROM personne WHERE nom = ? AND prenom = ? AND poste = ?');
// $recuperemission = $bdd->prepare('SELECT id_mission FROM mission WHERE nom_mission = ?');
// $inserepersonne = $bdd->prepare('INSERT INTO personne(id_personne, nom, prenom, poste) VALUES (?,?,?,?)');
$inserevm = $bdd->prepare('INSERT INTO valeur_metier(id_valeur_metier, nom_valeur_metier, nature_valeur_metier, description_valeur_metier, id_atelier, id_personne, id_mission, id_projet) VALUES (?,?,?,?,?,NULL,NULL,?)');





// Verification du nom de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nomvm)) {
  $results["error"] = true;
  $results["message"]["nom"] = "Nom invalide";
?>
  <strong style="color:#FF6565;">Nom invalide </br></strong>
<?php
}

// Verification de la description de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $descriptionvm)) {
  $results["error"] = true;
  $results["message"]["nom"] = "Description invalide";
?>
  <strong style="color:#FF6565;">Description invalide </br></strong>
<?php
}
/* 
// Verification du nom du responsable de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nomresponsablevm)) {
  $results["error"] = true;
  $results["message"]["nom"] = "Responsable invalide";
?>
  <strong style="color:#FF6565;">Nom du responsable invalide </br></strong>
<?php
}

// Verification du prenom responsable de la valeur métier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenomresponsablevm)) {
  $results["error"] = true;
  $results["message"]["nom"] = "Responsable invalide";
?>
  <strong style="color:#FF6565;">Prénom du responsable invalide </br></strong>
<?php
} */


if ($results["error"] === false && isset($_POST['validervm'])) {
  // $inserepersonne->bindParam(1, $id_personne);
  // $inserepersonne->bindParam(2, $nomresponsablevm);
  // $inserepersonne->bindParam(3, $prenomresponsablevm);
  // $inserepersonne->bindParam(4, $posteresponsablevm);
  // $inserepersonne->execute();
  // $recuperepersonne->bindParam(1, $nomresponsablevm);
  // $recuperepersonne->bindParam(2, $prenomresponsablevm);
  // $recuperepersonne->bindParam(3, $posteresponsablevm);
  // $recuperepersonne->execute();
  // $id_personne = $recuperepersonne->fetch();
  // $recuperemission->bindParam(1, $nommission);
  // $recuperemission->execute();
  // $id_mission = $recuperemission->fetch();

  $inserevm->bindParam(1, $id_valeur_metier);
  $inserevm->bindParam(2, $nomvm);
  $inserevm->bindParam(3, $nature);
  $inserevm->bindParam(4, $descriptionvm);
  $inserevm->bindParam(5, $id_atelier);
  // $inserevm->bindParam(6, $id_personne[0]);
  // $inserevm->bindParam(7, $id_mission[0]);
  $inserevm->bindParam(6, $id_projet);

  $inserevm->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}


?>