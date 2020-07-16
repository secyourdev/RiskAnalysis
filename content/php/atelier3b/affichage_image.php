<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
$id_atelier = '3.b';

//Connexion à la base de donnee
try {
    $bdd = new PDO(
        'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v20;charset=utf8',
        'ebios-rm',
        'hLLFL\bsF|&[8=m8q-$j',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die('Erreur :' . $e->getMessage());
}

// print 'je suis affichage.php';

$id_scenario = $_POST['id_scenario'];

$query = $bdd->prepare("SELECT image FROM scenario_strategique WHERE id_projet = ? AND id_scenario_strategique = ?");
$query->bindParam(1, $getid_projet);
$query->bindParam(2, $id_scenario);
$query->execute();
$nomimage = $query->fetch();
// print_r($nomimage);



echo "$nomimage[0]";
