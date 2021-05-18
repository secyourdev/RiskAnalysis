<?php
session_start();

include("../bdd/connexion.php");

$id_projet=htmlspecialchars($_POST['id_projet']);

$req = $bdd->prepare("SELECT * FROM F_projet where id_projet = :id_projet");
$req->execute([":id_projet" => $id_projet]);
$row = $req->fetch();

if($row){
    $_SESSION['id_projet'] = $row['id_projet'];
    header('Location: ../../../atelier-1a&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);
}
else {
    header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
}


?>