<?php
include("content/php/bdd/connexion.php");
$id_projet = $_SESSION['id_projet'];
$id_atelier= '3.c';

//$querypp = $bdd->prepare("SELECT id_partie_prenante FROM R_partie_prenante WHERE nom_partie_prenante = ? AND id_projet = $id_projet");
$query_chemin_d_attaque = $bdd->prepare("SELECT id_chemin_d_attaque_strategique, nom_chemin_d_attaque_strategique FROM T_chemin_d_attaque_strategique WHERE id_projet=? AND id_atelier=?");
//$queryppvalues = $bdd->prepare("SELECT dependance_partie_prenante, penetration_partie_prenante, maturite_partie_prenante, confiance_partie_prenante FROM R_partie_prenante WHERE id_partie_prenante = ?");



    //$pp = $_POST['pp'];

    $query_chemin_d_attaque->bindParam(1, $getid_projet);
    $query_chemin_d_attaque->bindParam(2, $id_atelier);
    $query_chemin_d_attaque->execute();

   // $queryppvalues->bindParam(1, $pp);
    //$queryppvalues->execute();
   // $valeurs = $queryppvalues->fetch(PDO::FETCH_ASSOC);
    echo '
    <option value="" selected>...</option>
    ';
    while($row = $query_chemin_d_attaque->fetch(PDO::FETCH_ASSOC))
    {
      echo '
      <option value="'.$row["id_chemin_d_attaque_strategique"].'">'.$row["nom_chemin_d_attaque_strategique"].'</option>
      ';
    }
    //echo 'Dependance : ' . $valeurs["dependance_partie_prenante"] . 'Penetration : ' . $valeurs["penetration_partie_prenante"] . 'Menace : ' . $valeurs["maturite_partie_prenante"] . 'Confiance : ' . $valeurs["confiance_partie_prenante"];



?>