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
$recupere_id_seuil = $bdd->prepare(
  "SELECT id_seuil FROM seuil WHERE id_atelier = ? AND id_projet = ?"
);

$insere = $bdd->prepare(
  "INSERT INTO partie_prenante (
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
    id_seuil,
    id_atelier,
    id_projet
    ) 
    VALUES ( '', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");



if ($results["error"] === false && isset($_POST['validerpartie'])) {
  
  $recupere_id_seuil->bindParam(1, $id_atelier);
  $recupere_id_seuil->bindParam(2, $id_projet);
  $recupere_id_seuil->execute();
  $id_seuil = $recupere_id_seuil->fetch();

  $insere->bindParam(1, $categorie_partie_prenante);
  $insere->bindParam(2, $nom_partie_prenante);
  $insere->bindParam(3, $type);
  $insere->bindParam(4, $dependance_partie_prenante);
  $insere->bindParam(5, $penetration_partie_prenante);
  $insere->bindParam(6, $maturite_partie_prenante);
  $insere->bindParam(7, $confiance_partie_prenante);
  $insere->bindParam(8, $niveau_de_menace_partie_prenante);
  $insere->bindParam(9, $ponderation);
  $insere->bindParam(10, $ponderation);
  $insere->bindParam(11, $ponderation);
  $insere->bindParam(12, $ponderation);
  $insere->bindParam(13, $id_seuil[0]);
  $insere->bindParam(14, $id_atelier);
  $insere->bindParam(15, $id_projet);
  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

header('Location: ../../../atelier-3a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#partie_prenante');
?>