<?php
header('Location: ../../../atelier-1d');


//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v13;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$results["error"] = false;
$results["message"] = [];


$nom_referentiel = $_POST['nom_referentiel'];
$etat_d_application = $_POST['etat_d_application'];
$etat_de_la_conformite = $_POST['etat_de_la_conformite'];
$id_atelier = '1.d';
$type_referenciel = $_POST['type_referenciel'];

$insere = $bdd->prepare('INSERT INTO socle_de_securite (id_socle_securite, nom_referentiel, etat_d_application, etat_de_la_conformite, id_atelier, type_referenciel) VALUES (?, ?, ?, ?, ?, ?)');


/* // Verification du nom_evenement_redoutes
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_evenement_redoutes)) {
  $results["error"] = true;
  $results["message"]["nom_evenement_redoutes"] = "nom_evenement_redoutes invalide";
?>
  <strong style="color:#FF6565;">nom_evenement_redoutes invalide </br></strong>
<?php
} */




if ($results["error"] === false && isset($_POST['validersocle'])) {
  $insere->bindParam(1, $id_socle_securite);
  $insere->bindParam(2, $nom_referentiel);
  $insere->bindParam(3, $etat_d_application);
  $insere->bindParam(4, $etat_de_la_conformite);
  $insere->bindParam(5, $id_atelier);
  $insere->bindParam(6, $type_referenciel);
  $insere->execute();
?>
  <strong style="color:#4AD991;">Le socle a bien été ajoutée !</br></strong>
<?php
}

?>