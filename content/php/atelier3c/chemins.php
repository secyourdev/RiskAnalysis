<?php
session_start();
include("../bdd/connexion.php");
$id_projet = $_SESSION['id_projet'];

$querypp = $bdd->prepare("SELECT id_partie_prenante FROM R_partie_prenante WHERE nom_partie_prenante = ? AND id_projet = $id_projet");
$querychemin = $bdd->prepare("SELECT id_chemin_d_attaque_strategique, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique WHERE id_partie_prenante = ?");
$queryppvalues = $bdd->prepare("SELECT dependance_partie_prenante, penetration_partie_prenante, maturite_partie_prenante, confiance_partie_prenante FROM R_partie_prenante WHERE id_partie_prenante = ?");


if(isset($_POST['pp'])){
    $pp = $_POST['pp'];
    // $querypp->bindParam(1, $nom_pp);
    // $querypp->execute();
    // $id_pp = $querypp->fetch();

    $querychemin->bindParam(1, $pp);
    $querychemin->execute();
    // $row = $querychemin->fetch(PDO::FETCH_ASSOC);
    // print_r($row);
    $queryppvalues->bindParam(1, $pp);
    $queryppvalues->execute();
    $valeurs = $queryppvalues->fetch(PDO::FETCH_ASSOC);
    echo '
    <option value="" selected>...</option>
    ';
    while($row = $querychemin->fetch(PDO::FETCH_ASSOC))
    {
      echo '
      <option value="'.$row["id_chemin_d_attaque_strategique"].'">'.$row["nom_chemin_d_attaque_strategique"].'</option>
      ';
    }
    // echo 'Dependance : "' . $valeurs["dependance"] . '"Penetration : "' . $valeurs["penetration"] . '"Menace : "' . $valeurs["menace"] . '"Confiance : "' . $valeurs["confiance"]';
}


?>