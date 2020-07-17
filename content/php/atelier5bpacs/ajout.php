<?php
// header('Location: ../../../atelier-5bpacs');


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

$principe_securite = $_POST['principe_de_securite'];
$difficulte = $_POST['difficulte_traitement_de_securite'];
$scenario = $_POST['scenario_risques_associes'];
$responsable = $_POST['responsable'];
$cout = $_POST['cout_traitement_de_securite'];
$date = $_POST['date_traitement_de_securite'];
$statut = $_POST['statut'];

$id_traitement_securite = "id_traitement_de_scurite";
$id_atelier = "5.b";




$recupere = $bdd->prepare("SELECT id_valeur_metier FROM valeur_metier WHERE nom_valeur_metier = ?");
$insere = $bdd->prepare('INSERT INTO `traitement_de_securite`(`id_traitement_de_securite`, `principe_de_securite`, `difficulte_traitement_de_securite`, `cout_traitement_de_securite`, `date_traitement_de_securite`, `statut`, `id_atelier`) VALUES (?,?,?,?,?,?,?)');


// Verification de la difficulté
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $difficulte)) {
  $results["error"] = true;
  $results["message"]["difficuté"] = "Difficulté invalide";
  ?>
  <strong style="color:#FF6565;">Difficulté invalide </br></strong>
  <?php
}


if ($results["error"] === false && isset($_POST['validerpacs'])) {
  // $recupere->bindParam(1, $nom_valeur_metier);
  // $recupere->execute();
  // $id_valeur_metier = $recupere->fetch();
  $insere->bindParam(1, $id_traitement_securite);
  $insere->bindParam(2, $principe_securite);
  $insere->bindParam(3, $difficulte);
  $insere->bindParam(4, $cout);
  $insere->bindParam(5, $date);
  $insere->bindParam(6, $statut);
  $insere->bindParam(7, $id_atelier);
  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>