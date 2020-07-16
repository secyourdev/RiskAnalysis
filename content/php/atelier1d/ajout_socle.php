<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
header('Location: ../../../atelier-1d&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet']);


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

$type_referenciel = $_POST['type_referenciel'];
$nom_referentiel = $_POST['nom_referentiel'];
$etat_d_application = $_POST['etat_d_application'];
$etat_de_la_conformite = $_POST['commentaire'];

$id_socle_securite = "id_socle_securite";
$id_atelier = "1.d";

$insere = $bdd->prepare("INSERT INTO socle_de_securite(id_socle_securite, type_referentiel, nom_referentiel, etat_d_application, etat_de_la_conformite, id_atelier, id_projet) VALUES (?,?,?,?,?,?,?)");

/* // Verification du nom_evenement_redoutes
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_evenement_redoutes)) {
  $results["error"] = true;
  $results["message"]["nom_evenement_redoutes"] = "nom_evenement_redoutes invalide";
?>
  <strong style="color:#FF6565;">nom_evenement_redoutes invalide </br></strong>
<?php
} */

var_dump($insere);


if ($results["error"] === false && isset($_POST['validersocle'])) {
  $insere->bindParam(1, $id_socle_securite);
  $insere->bindParam(2, $type_referenciel);
  $insere->bindParam(3, $nom_referentiel);
  $insere->bindParam(4, $etat_d_application);
  $insere->bindParam(5, $etat_de_la_conformite);
  $insere->bindParam(6, $id_atelier);
  $insere->bindParam(7, $getid_projet);
  // print '<br />';
  // $insere->debugDumpParams();
  // print '<br />';
  $insere->execute();

?>
  <strong style="color:#4AD991;">Le socle a bien été ajoutée !</br></strong>
<?php
}

?>