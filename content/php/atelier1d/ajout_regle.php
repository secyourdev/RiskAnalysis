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
print 'nom referentiel: ';
print $nom_referentiel;
print '<br>';
$id_regle_affichage = $_POST['id_regle'];
$titre = $_POST['titre_regle'];
print 'titre regle ';
print $titre;
print '<br>';
$description = $_POST['description'];
$etat_de_la_regle = $_POST['etat_de_la_regle'];
$justification_ecart = $_POST['justification_ecart'];
$responsable = $_POST['nom_responsable_regle'];
$dates = $_POST['dates'];
print $dates;

$recupere_id_socle = $bdd->prepare("SELECT id_socle_securite FROM socle_de_securite WHERE socle_de_securite.nom_referentiel = ? AND id_atelier = '1.d' AND id_projet = $getid_projet");

// $insere_regle = $bdd->prepare("INSERT INTO regle(id_regle, titre, regle.description, etat_de_la_regle, id_socle_securite) VALUES (?,?,'',?,?)");
// $recupere_id_regle = $bdd->prepare("SELECT id_regle FROM regle WHERE titre = ?, id_socle_securite = ?");

$insere_regle = $bdd->prepare(
  "INSERT INTO regle(id_regle, id_regle_affichage, titre, description, etat_de_la_regle, justification_ecart, dates, responsable, id_socle_securite) 
VALUES ('',?,?,'',?,?,?,?,?)"
);

// $insere_date = $bdd->prepare("INSERT INTO dates(id_date, dates.date) VALUES ('',?)");
// $recupere_id_date = $bdd->prepare("SELECT id_date FROM dates WHERE date = ?");

// $insere_respo = $bdd->prepare("INSERT INTO personne(id_personne, nom, prenom, poste) VALUES ('',?,NULL,NULL)");
// $recupere_id_respo = $bdd->prepare("SELECT id_personne FROM personne WHERE nom = ?");

// $insere_ecart = $bdd->prepare("INSERT INTO ecarts(id_ecarts, justification_ecart, id_regle, id_date, id_personne) VALUES ('',?,?,?,?)");


/* // Verification du nom_valeur_metier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)) {
  $results["error"] = true;
  $results["message"]["nom_valeur_metier"] = "nom_valeur_metier invalide";
?>
  <strong style="color:#FF6565;">nom_valeur_metier invalide </br></strong>
<?php
} */

if ($results["error"] === false && isset($_POST['validerecart'])) {

  $recupere_id_socle->bindParam(1, $nom_referentiel);
  $recupere_id_socle->execute();
  $id_socle_securite = $recupere_id_socle->fetch();
  print('id_socle:  ');
  print_r($id_socle_securite);
  print '<br>';

  // $insere_regle->bindParam(1, $id_regle);
  $insere_regle->bindParam(1, $id_regle_affichage);
  $insere_regle->bindParam(2, $titre);
  $insere_regle->bindParam(4, $description);
  $insere_regle->bindParam(3, $etat_de_la_regle);
  $insere_regle->bindParam(4, $justification_ecart);
  $insere_regle->bindParam(5, $dates);
  $insere_regle->bindParam(6, $responsable);
  $insere_regle->bindParam(7, $id_socle_securite[0]);
  $insere_regle->execute();

  // $recupere_id_regle->bindParam(1, $titre);
  // $recupere_id_regle->bindParam(2, $id_socle_securite[0]);
  // $recupere_id_regle->execute();
  // $id_regle = $recupere_id_regle->fetch();

  // $insere_date->bindParam(1, $date);
  // $insere_date->execute();
  
  // $recupere_id_date->bindParam(1, $date);
  // $recupere_id_date->execute();
  // $id_date = $recupere_id_date->fetch();

  // $insere_respo->bindParam(1, $nom);
  // $insere_respo->execute();

  // $recupere_id_respo->bindParam(1, $nom);
  // $recupere_id_respo->execute();
  // $id_personne = $recupere_id_respo->fetch();

  // $insere_ecart->bindParam(1, $justification_ecart);
  // $insere_ecart->bindParam(2, $id_regle);
  // $insere_ecart->bindParam(3, $id_date[0]);
  // $insere_ecart->bindParam(4, $id_personne[0]);
  // $insere_ecart->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>