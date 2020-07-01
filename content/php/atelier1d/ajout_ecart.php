<?php
header('Location: ../../../atelier-1d');


//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v12;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$results["error"] = false;
$results["message"] = [];

$id_socle_securite = $_POST['id_socle_securite'];

$regles = $_POST['regles'];
$etat_de_la_regle = $_POST['etat_de_la_regle'];
$justification_ecart = $_POST['justification_ecart'];
$nom = $_POST['nom'];
$date = $_POST['date'];

$id_atelier = '1.d';

$recupere_date = $bdd->prepare("SELECT id_date FROM dates WHERE date = ?");
$recupere_personne = $bdd->prepare("SELECT id_personne FROM personne WHERE nom = ?");
// $recupere_socle = $bdd->prepare("SELECT id_socle_securite FROM socle_de_securite WHERE nom = ?");

$insere_ref = $bdd->prepare('INSERT INTO referentiel(id_referenciel, regles,	etat_de_la_regle,	id_socle_securite) VALUES (?,?,?,?)');
$insere_ecart = $bdd->prepare('INSERT INTO ecarts(id_ecarts, justification_ecart, id_referentiel, id_date, id_personne) VALUES (?,?,?,?,?)');


/* // Verification du nom_valeur_metier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)) {
  $results["error"] = true;
  $results["message"]["nom_valeur_metier"] = "nom_valeur_metier invalide";
?>
  <strong style="color:#FF6565;">nom_valeur_metier invalide </br></strong>
<?php
} */

if ($results["error"] === false && isset($_POST['validerecart'])) {

  $recupere_date->bindParam(1, $date);
  $recupere_date->execute();
  $id_date = $recupere_date->fetch();

  $recupere_personne->bindParam(1, $nom);
  $recupere_personne->execute();
  $id_personne = $recupere_personne->fetch();


  $insere_ref->bindParam(1, $id_referenciel);
  $insere_ref->bindParam(2, $regles);
  $insere_ref->bindParam(3, $etat_de_la_regle);
  $insere_ref->bindParam(4, $id_socle_securite);

  $insere_ecart->bindParam(1, $id_ecarts);
  $insere_ecart->bindParam(2, $justification_ecart);
  $insere_ecart->bindParam(3, $id_referentiel);
  $insere_ecart->bindParam(4, $id_date);
  $insere_ecart->bindParam(5, $id_personne);

  $insere_ecart->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>