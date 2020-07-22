<?php
// $getid_projet = intval($_GET['id_projet']);

include("../bdd/connexion.php");

$queryregles = $bdd->prepare("SELECT id_regle, titre FROM O_regle WHERE id_socle_securite = ?");

if(isset($_POST['ref'])){
    $ref = $_POST['ref'];

    $queryregles->bindParam(1, $ref);
    $queryregles->execute();
    // $row = $querychemin->fetch(PDO::FETCH_ASSOC);
    // print_r($row);
    echo '
    <option value="" selected>...</option>
    ';
    while($row = $queryregles->fetch(PDO::FETCH_ASSOC))
    {
      echo '
      <option value="'.$row["id_regle"].'">'.$row["titre"].'</option>
      ';
    }
}


?>