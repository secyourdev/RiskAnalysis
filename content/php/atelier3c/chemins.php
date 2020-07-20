<?php

include("../bdd/connexion.php");

$querypp = $bdd->prepare("SELECT id_partie_prenante FROM partie_prenante WHERE nom_partie_prenante = ?");
$querychemin = $bdd->prepare("SELECT id_chemin_d_attaque_strategique, nom_chemin_d_attaque_strategique FROM chemin_d_attaque_strategique WHERE id_partie_prenante = ?");



if(isset($_POST['pp'])){
    $pp = $_POST['pp'];
    // $querypp->bindParam(1, $nom_pp);
    // $querypp->execute();
    // $id_pp = $querypp->fetch();

    $querychemin->bindParam(1, $pp);
    $querychemin->execute();
    // $row = $querychemin->fetch(PDO::FETCH_ASSOC);
    // print_r($row);
    echo '
    <option value="" selected>...</option>
    ';
    while($row = $querychemin->fetch(PDO::FETCH_ASSOC))
    {
      echo '
      <option value="'.$row["id_chemin_d_attaque_strategique"].'">'.$row["nom_chemin_d_attaque_strategique"].'</option>
      ';
    }
}


?>