<?php
  session_start();
  $getid_projet = $_SESSION['id_projet'];

  header('Location: ../../../atelier-1b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#bien_support');

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

$biensupport = $_POST['biensupport'];
$descriptionbs = $_POST['descriptionbs'];

$id_bien_support = "id_bien_support";
$id_atelier = "1.b";

$inserebs = $bdd->prepare('INSERT INTO bien_support(id_bien_support, nom_bien_support, description_bien_support, id_atelier, id_projet) VALUES (?,?,?,?,?)');

// Verification du nom du bien support
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $biensupport)) {
  $results["error"] = true;
  $_SESSION['message_error_3'] = "Nom invalide";
}

// Verification de la description du bien support
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $descriptionbs)) {
  $results["error"] = true;
  $_SESSION['message_error_3'] = "Description invalide";
}

if ($results["error"] === false && isset($_POST['validerbs'])) {
  $inserebs->bindParam(1, $id_bien_support);
  $inserebs->bindParam(2, $biensupport);
  $inserebs->bindParam(3, $descriptionbs);
  $inserebs->bindParam(4, $id_atelier);
  $inserebs->bindParam(5, $getid_projet);
  $inserebs->execute();

  $_SESSION['message_success_3'] = "Le bien support a bien été ajouté !";
}
?>