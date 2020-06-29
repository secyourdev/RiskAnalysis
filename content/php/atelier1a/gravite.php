<?php
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v11;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}


$radio_gravite = $_POST['radio_gravite'];
$update_gravite = $bdd->prepare("UPDATE projet SET valeur_max_gravite = ?");
$update_gravite->bindParam(1, $radio_gravite);
$update_gravite->execute();

?>