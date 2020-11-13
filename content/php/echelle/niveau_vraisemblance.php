<?php
include("../bdd/connexion.php");

$query = $bdd->prepare("SELECT * FROM DC_echelle_vraisemblance WHERE id_echelle = ?");

if(isset($_POST['nom_echelle'])){
    $nom_echelle = $_POST['nom_echelle'];
    $query->bindParam(1, $nom_echelle);
    $query->execute();

    // récuépérer les infos de l'échelle
    $row = $query->fetch(PDO::FETCH_ASSOC);
    // Si échelle à 4 niveau
    //$i=
   // while($i!=0))
   // {
      echo '
      <tr>
      <td>'.$nom_echelle.";1".'</td>
      <td>'."1".'</td>
      <td>'.$row["description_niveau_1"].'</td>
      </tr>
      ';
      echo '
      <tr>
      <td>'.$nom_echelle.";2".'</td>
      <td>'."2".'</td>
      <td>'.$row["description_niveau_2"].'</td>
      </tr>
      ';
      echo '
      <tr>
      <td>'.$nom_echelle.";3".'</td>
      <td>'."3".'</td>
      <td>'.$row["description_niveau_3"].'</td>
      </tr>
      ';
      echo '
      <tr>
      <td>'.$nom_echelle.";4".'</td>
      <td>'."4".'</td>
      <td>'.$row["description_niveau_4"].'</td>
      </tr>
      ';
      if ($row["nb_niveau_echelle"] === "5") {
        echo '
        <tr>
        <td>'.$nom_echelle.";5".'</td>
        <td>'."5".'</td>
        <td>'.$row["description_niveau_5"].'</td>
        </tr>
        ';
      }
   // }
}


?>