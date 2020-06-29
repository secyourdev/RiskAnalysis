<?php
//header('Location: ../../../atelier-1a');
session_start();
$getid_projet = $_SESSION['id_projet'];
echo $getid_projet;
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

$acteur_id = $_POST['acteur_id'];
$atelier_num = $_POST['atelier_num'];
$raci_value = $_POST['raci_value'];

$update_raci = $bdd->prepare("UPDATE disposer SET ecriture = ? WHERE id_utilisateur = ? AND id_atelier = ?");
$update_raci->bindParam(1, $raci_value);
$update_raci->bindParam(2, $acteur_id);
$update_raci->bindParam(3, $atelier_num);
$update_raci->execute();

?>