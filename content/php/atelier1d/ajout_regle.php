<?php
// header('Location: ../../../atelier-1d');


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

$titre = $_POST['titre'];
$recupere_id_regle = $bdd->prepare("SELECT id_referentiel, id_regle FROM referentiel WHERE titre = ?");

// $etat_de_la_regle = $_POST['etat_de_la_regle'];

$justification_ecart = $_POST['justification_ecart'];

$nom = $_POST['nom'];
$recupere_personne = $bdd->prepare("SELECT id_personne FROM personne WHERE nom = ?");

$date = $_POST['date'];
$insere_date = $bdd->prepare("INSERT INTO dates(id_date, date, id_atelier) VALUES (NULL,?,'1')");
$recupere_id_date = $bdd->prepare("SELECT id_date FROM dates WHERE date = ? AND id_atelier = '1'");

$id_atelier = '1';

// $recupere_socle = $bdd->prepare("SELECT id_socle_securite FROM socle_de_securite WHERE nom = ?");

// $insere_ref = $bdd->prepare('UPDATE referentiel SET etat_de_la_regle = ? WHERE id_regle = ?');

$insere_ecart = $bdd->prepare('INSERT INTO ecarts(id_ecarts, justification_ecart, id_referentiel, id_regle, id_date, id_personne) VALUES (NULL,?,?,?,?,?)');


/* // Verification du nom_valeur_metier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)) {
  $results["error"] = true;
  $results["message"]["nom_valeur_metier"] = "nom_valeur_metier invalide";
?>
  <strong style="color:#FF6565;">nom_valeur_metier invalide </br></strong>
<?php
} */

if ($results["error"] === false && isset($_POST['validerecart'])) {
 
  $recupere_id_regle->bindParam(1, $titre);
  $recupere_id_regle->execute();
  $info_regle = $recupere_id_regle->fetch();
  
  $recupere_personne->bindParam(1, $nom);
  $recupere_personne->execute();
  $id_personne = $recupere_personne->fetch();

  $insere_date->bindParam(1, $date);
  $insere_date->execute();

  $recupere_id_date->bindParam(1, $date);
  $recupere_id_date->execute();
  $id_date = $recupere_id_date->fetch();

  // $insere_ref->bindParam(1, $etat_de_la_regle);
  // $insere_ref->bindParam(2, $info_regle[1]);

  $insere_ecart->bindParam(1, $justification_ecart);
  $insere_ecart->bindParam(2, $info_regle[0]);
  $insere_ecart->bindParam(3, $info_regle[1]);
  $insere_ecart->bindParam(4, $id_date[0]);
  $insere_ecart->bindParam(5, $id_personne[0]);

  $insere_ecart->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>