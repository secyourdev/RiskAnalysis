<?php
include("../bdd/connexion.php");

$query = $bdd->prepare("SELECT id_niveau, valeur_niveau, description_niveau FROM DA_niveau NATURAL JOIN DA_echelle WHERE id_echelle = ?");

if(isset($_POST['nom_echelle'])){
    $nom_echelle = $_POST['nom_echelle'];
    $query->bindParam(1, $nom_echelle);
    $query->execute();

    
    while($row = $query->fetch(PDO::FETCH_ASSOC))
    {
      echo '
      <tr>
      <td>'.$row["id_niveau"].'</td>
      <td>'.$row["valeur_niveau"].'</td>
      <td>'.$row["description_niveau"].'</td>
      </tr>
      ';
    }
}


?>