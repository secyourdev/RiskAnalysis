<?php
session_start();
header('Location: ../../../atelier-2a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);


//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v17;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$results["error"] = false;
$results["message"] = [];

$type_attaquant = $_POST['type_attaquant'];
$profil_attaquant = $_POST['profil_attaquant'];
$description_source_risque = $_POST['description_sr'];
$objectif_vise = $_POST['objectif_vise'];
$description_objectif_vise = $_POST['description_objectif_vise'];

$id_source_risque = "id_source_risque";
$motivation = NULL;
$ressources = NULL;
$active = NULL;
$mode_operatoire = NULL;
$secteur_activite = NULL;
$arsenal_attaque = NULL;
$faits_armes = NULL;
$pertinence = NULL;
$choix_sr = NULL;
$id_atelier = "2.a";
$id_projet = $_SESSION['id_projet'];


$recupere = $bdd->prepare("SELECT id_valeur_metier FROM valeur_metier WHERE nom_valeur_metier = ?");
$insere = $bdd->prepare('INSERT INTO `SROV`(`id_source_de_risque`, `type_d_attaquant_source_de_risque`, `profil_de_l_attaquant_source_de_risque`, `description_source_de_risque`, `objectif_vise`, `description_objectif_vise`, `motivation`, `ressources`, `activite`, `mode_operatoire`, `secteur_d_activite`,`arsenal_d_attaque`, `faits_d_armes`, `pertinence`, `choix_source_de_risque`, `id_atelier`, `id_projet`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');


// Verification du type de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $type_attaquant)) {
  $results["error"] = true;
  $results["message"]["type_attaquant"] = "Type de l'attaquant invalide";
  ?>
  <strong style="color:#FF6565;">Type de l'attaquant invalide </br></strong>
  <?php
}

// Verification du profil de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $profil_attaquant)) {
  $results["error"] = true;
  $results["message"]["Profil de l'attaquant"] = "Profil de l'attaquant invalide";
  ?>
  <strong style="color:#FF6565;">Profil de l'attaquant invalide </br></strong>
  <?php
}

// Verification de la description de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_source_risque)) {
  $results["error"] = true;
  $results["message"]["impact"] = "Description de l'attaquant invalide";
  ?>
  <strong style="color:#FF6565;">Description de l'attaquant invalide </br></strong>
  <?php
}
// Verification de l'objectif visé
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $objectif_vise)) {
  $results["error"] = true;
  $results["message"]["objectif vise"] = "Objectif vise invalide";
  ?>
  <strong style="color:#FF6565;">Objectif visé invalide </br></strong>
  <?php
}

// Verification de la description de l'objectif visé
if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $description_objectif_vise)) {
  $results["error"] = true;
  $results["message"]["description objectif vise"] = "Description objectif vise invalide";
  ?>
  <strong style="color:#FF6565;">Descrition objectif visé invalide </br></strong>
  <?php
}

if ($results["error"] === false && isset($_POST['validersrov'])) {
  $recupere->bindParam(1, $nom_valeur_metier);
  $recupere->execute();
  $id_valeur_metier = $recupere->fetch();
  $insere->bindParam(1, $id_source_risque);
  $insere->bindParam(2, $type_attaquant);
  $insere->bindParam(3, $profil_attaquant);
  $insere->bindParam(4, $description_source_risque);
  $insere->bindParam(5, $objectif_vise);
  $insere->bindParam(6, $description_objectif_vise);
  $insere->bindParam(7, $motivation);
  $insere->bindParam(8, $ressources);
  $insere->bindParam(9, $activite);
  $insere->bindParam(10, $mode_operatoire);
  $insere->bindParam(11, $secteur_activite);
  $insere->bindParam(12, $arsenal_attaque);
  $insere->bindParam(13, $faits_armes);
  $insere->bindParam(14, $pertinence);
  $insere->bindParam(15, $choix_sr);
  $insere->bindParam(16, $id_atelier);
  $insere->bindParam(17, $id_projet);
  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>