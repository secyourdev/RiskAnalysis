<?php
session_start();
header('Location: ../../../atelier-3a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);


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


$categorie_partie_prenante = $_POST['categorie_partie_prenante'];
$nom_partie_prenante = $_POST['nom_partie_prenante'];
$type = $_POST['type'];
$dependance_partie_prenante = $_POST['dependance_partie_prenante'];
$penetration_partie_prenante = $_POST['penetration_partie_prenante'];
$maturite_partie_prenante = $_POST['maturite_partie_prenante'];
$confiance_partie_prenante = $_POST['confiance_partie_prenante'];
$niveau_de_menace_partie_prenante = ($dependance_partie_prenante* $penetration_partie_prenante)/ ($maturite_partie_prenante* $confiance_partie_prenante);
$id_atelier = '3.a';
$id_projet =$_SESSION['id_projet'];
$ponderation_dependance = 0;
$ponderation_penetration = 0;
$ponderation_maturite = 0;
$ponderation_confiance = 0;
$seuil = 1;
$recupere = $bdd->prepare("SELECT id_valeur_metier FROM valeur_metier WHERE nom_valeur_metier = ?");

$insere = $bdd->prepare(
  'INSERT INTO partie_prenante (
    id_partie_prenante, 
    categorie_partie_prenante, 
    nom_partie_prenante, 
    type, 
    dependance_partie_prenante, 
    penetration_partie_prenante,
    maturite_partie_prenante, 
    confiance_partie_prenante, 
    niveau_de_menace_partie_prenante,
    ponderation_dependance,
    ponderation_penetration,
    ponderation_maturite,
    ponderation_confiance,
    id_atelier,
    id_projet,
    id_seuil
    ) 
    VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );


/* // Verification du nom_valeur_metier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)) {
  $results["error"] = true;
  $results["message"]["nom_valeur_metier"] = "nom_valeur_metier invalide";
?>
  <strong style="color:#FF6565;">nom_valeur_metier invalide </br></strong>
<?php
} */


if ($results["error"] === false && isset($_POST['validerpartie'])) {
  
  $insere->bindParam(1, $id_partie_prenante);
  $insere->bindParam(2, $categorie_partie_prenante);
  $insere->bindParam(3, $nom_partie_prenante);
  $insere->bindParam(4, $type);
  $insere->bindParam(5, $dependance_partie_prenante);
  $insere->bindParam(6, $penetration_partie_prenante);
  $insere->bindParam(7, $maturite_partie_prenante);
  $insere->bindParam(8, $confiance_partie_prenante);
  $insere->bindParam(9, $niveau_de_menace_partie_prenante);
  $insere->bindParam(10, $ponderation_dependance);
  $insere->bindParam(11, $ponderation_penetration);
  $insere->bindParam(12, $ponderation_maturite);
  $insere->bindParam(13, $ponderation_confiance);
  $insere->bindParam(14, $id_atelier);
  $insere->bindParam(15, $id_projet);
  $insere->bindParam(16, $seuil);
  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>