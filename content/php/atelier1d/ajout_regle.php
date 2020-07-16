<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
header('Location: ../../../atelier-1d&' . $_SESSION['id_utilisateur'] . '&' . $_SESSION['id_projet']);


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

$nom_referentiel = $_POST['nomreferentiel'];
// print $nom_referentiel;
$id_regle_affichage = $_POST['id_regle'];
$titre = $_POST['titre_regle'];
$description = $_POST['description'];
$etat_de_la_regle = '';
$justification_ecart = '';
$responsable = '';
$dates = '';

$recupere_id_socle = $bdd->prepare("SELECT id_socle_securite FROM socle_de_securite WHERE socle_de_securite.nom_referentiel = ? AND id_atelier = '1.d' AND id_projet = $getid_projet");

$insere_regle = $bdd->prepare(
  "INSERT INTO regle(id_regle, id_regle_affichage, titre, description, etat_de_la_regle, justification_ecart, dates, responsable, id_socle_securite) 
VALUES ('',?,?,?,?,?,?,?,?)"
);

if ($results["error"] === false && isset($_POST['validerecart'])) {

  $recupere_id_socle->bindParam(1, $nom_referentiel);
  $recupere_id_socle->execute();
  $id_socle_securite = $recupere_id_socle->fetch();
  // print('id_socle:  ');
  // print_r($id_socle_securite);
  // print '<br>';

  $insere_regle->bindParam(1, $id_regle_affichage);
  $insere_regle->bindParam(2, $titre);
  $insere_regle->bindParam(3, $description);
  $insere_regle->bindParam(4, $etat_de_la_regle);
  $insere_regle->bindParam(5, $justification_ecart);
  $insere_regle->bindParam(6, $dates);
  $insere_regle->bindParam(7, $responsable);
  $insere_regle->bindParam(8, $id_socle_securite[0]);
  $insere_regle->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>