<?php
include("../bdd/connexion.php");

$query = $bdd->prepare("SELECT id_niveau, valeur_niveau, description_niveau FROM niveau NATURAL JOIN echelle WHERE id_echelle = ?");

if(isset($_POST['nom_echelle'])){
    $nom_echelle = $_POST['nom_echelle'];
    $affiche_niveau = $bdd->prepare("SELECT id_echelle FROM echelle WHERE nom_echelle = ?");
    $affiche_niveau->bindParam(1, $nom_echelle);
    $affiche_niveau->execute();
    $resultat = $affiche_niveau->fetch();
    $query->bindParam(1, $resultat[0]);
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