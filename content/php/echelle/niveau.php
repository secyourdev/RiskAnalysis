<?php
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

$query = $bdd->prepare("SELECT id_niveau, valeur_niveau, description_niveau FROM niveau NATURAL JOIN echelle WHERE id_echelle = ?");



if(isset($_POST['nom_echelle'])){
    $nom_echelle = $_POST['nom_echelle'];
    $affiche_niveau = $bdd->prepare("SELECT id_echelle FROM echelle WHERE nom_echelle = ?");
    $affiche_niveau->bindParam(1, $nom_echelle);
    $affiche_niveau->execute();
    $resultat = $affiche_niveau->fetch();
    // echo $affiche_niveau;
    // print_r($resultat[0]);
    $query->bindParam(1, $resultat[0]);
    $query->execute();
    // $row = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($row);
    
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