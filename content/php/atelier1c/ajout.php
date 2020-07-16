<?php
session_start();
header('Location: ../../../atelier-1c&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);


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

$nom_valeur_metier = $_POST['nom_valeur_metier'];
$nom_evenement_redoutes = $_POST['nom_evenement_redoute'];
$description_evenement_redoutes = $_POST['description_evenement_redoute'];
$impact = $_POST['impact'];
$confidentialite = $_POST['confidentialite'];
$integrite = $_POST['integrite'];
$disponibilite = $_POST['disponibilite'];
$tracabilite = $_POST['tracabilite'];
$niveau_de_gravite = $_POST['niveau_de_gravite'];
$id_atelier = '1.c';
$id_projet = $_SESSION['id_projet'];


$recupere = $bdd->prepare("SELECT id_valeur_metier FROM valeur_metier WHERE nom_valeur_metier = ?");
$insere = $bdd->prepare('INSERT INTO `evenement_redoute`(`id_evenement_redoute`, `nom_evenement_redoute`, `description_evenement_redoute`, `confidentialite`, `integrite`, `disponibilite`, `tracabilite`, `impact`, `niveau_de_gravite`, `id_valeur_metier`, `id_atelier`, `id_projet`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');



// Verification du nom_evenement_redoutes
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_evenement_redoutes)) {
  $results["error"] = true;
  $results["message"]["nom_evenement_redoute"] = "nom_evenement_redoute invalide";
?>
  <strong style="color:#FF6565;">nom_evenement_redoutes invalide </br></strong>
<?php
}

// Verification du description_evenement_redoutes
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_evenement_redoutes)) {
  $results["error"] = true;
  $results["message"]["description_evenement_redoute"] = "description_evenement_redoute invalide";
?>
  <strong style="color:#FF6565;">description_evenement_redoutes invalide </br></strong>
<?php
}

// Verification du impact
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $impact)) {
  $results["error"] = true;
  $results["message"]["impact"] = "impact invalide";
?>
  <strong style="color:#FF6565;">impact invalide </br></strong>
<?php
}

if ($results["error"] === false && isset($_POST['validerevenementredoute'])) {
  $recupere->bindParam(1, $nom_valeur_metier);
  $recupere->execute();
  $id_valeur_metier = $recupere->fetch();
  $insere->bindParam(1, $id_evenement_redoutes);
  $insere->bindParam(2, $nom_evenement_redoutes);
  $insere->bindParam(3, $description_evenement_redoutes);
  $insere->bindParam(4, $confidentialite);
  $insere->bindParam(5, $integrite);
  $insere->bindParam(6, $disponibilite);
  $insere->bindParam(7, $tracabilite);
  $insere->bindParam(8, $impact);
  $insere->bindParam(9, $niveau_de_gravite);
  $insere->bindParam(10, $id_valeur_metier[0]);
  $insere->bindParam(11, $id_atelier);
  $insere->bindParam(12, $id_projet);
  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>