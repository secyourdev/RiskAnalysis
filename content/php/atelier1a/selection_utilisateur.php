<?php
$getid_projet = $_SESSION['id_projet'];

//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v14;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$recupere_id_grp_utilisateur = $bdd->prepare("SELECT id_grp_utilisateur FROM projet WHERE id_projet = ?");
$query_RACI_user = $bdd->prepare("SELECT id_utilisateur,nom,prenom FROM impliquer NATURAL JOIN utilisateur WHERE id_grp_utilisateur = ?");

$recupere_id_grp_utilisateur->bindParam(1, $getid_projet);
$recupere_id_grp_utilisateur->execute();
$resultat = $recupere_id_grp_utilisateur->fetch();

$query_RACI_user->bindParam(1, $resultat[0]);
$query_RACI_user->execute();

$array = array();

while($ecriture = $query_RACI_user->fetch()){
    array_push($array,$ecriture);
}

echo json_encode($array)
   
?>