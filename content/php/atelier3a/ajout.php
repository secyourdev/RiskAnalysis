<?php
session_start();
header('Location: ../../../atelier-3a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);


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

// $seuil_danger = $_POST['seuil_danger'];
// $seuil_controle = $_POST['seuil_controle'];
// $seuil_veille = $_POST['seuil_veille'];

$categorie_partie_prenante = $_POST['categorie_partie_prenante'];
$nom_partie_prenante = $_POST['nom_partie_prenante'];
$type = $_POST['type'];
$dependance_partie_prenante = $_POST['dependance_partie_prenante'];
$penetration_partie_prenante = $_POST['penetration_partie_prenante'];
$maturite_partie_prenante = $_POST['maturite_partie_prenante'];
$confiance_partie_prenante = $_POST['confiance_partie_prenante'];
$niveau_de_menace_partie_prenante = ($dependance_partie_prenante* $penetration_partie_prenante)/ ($maturite_partie_prenante* $confiance_partie_prenante);
// $id_seuil = 1;
$id_atelier = '3.a';
$id_projet =$_SESSION['id_projet'];

// $recupere = $bdd->prepare("SELECT id_valeur_metier FROM valeur_metier WHERE nom_valeur_metier = ?");
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
    id_seuil,
    id_atelier,
    id_projet
    ) 
    VALUES ( '', ?, ?, ?,?,?, ?, ?, ?, ?, ?, ?)");




/* // Verification du nom_valeur_metier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)) {
  $results["error"] = true;
  $results["message"]["nom_valeur_metier"] = "nom_valeur_metier invalide";
?>
  <strong style="color:#FF6565;">nom_valeur_metier invalide </br></strong>
<?php
} */


if ($results["error"] === false && isset($_POST['validerpartie'])) {
  
  $recupere_id_seuil->bindParam(1, $id_atelier);
  $recupere_id_seuil->bindParam(2, $id_projet);
  $recupere_id_seuil->execute();
  $id_seuil = $recupere_id_seuil->fetch();
  print_r($id_seuil);
  // $insere->bindParam(1, $id_partie_prenante);
  $insere->bindParam(1, $categorie_partie_prenante);
  $insere->bindParam(2, $nom_partie_prenante);
  $insere->bindParam(3, $type);
  $insere->bindParam(4, $dependance_partie_prenante);
  $insere->bindParam(5, $penetration_partie_prenante);
  $insere->bindParam(6, $maturite_partie_prenante);
  $insere->bindParam(7, $confiance_partie_prenante);
  $insere->bindParam(8, $niveau_de_menace_partie_prenante);
  $insere->bindParam(9, $id_seuil[0]);
  $insere->bindParam(10, $id_atelier);
  $insere->bindParam(11, $id_projet);
  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>