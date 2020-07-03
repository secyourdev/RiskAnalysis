<?php
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v13;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$query = $bdd->prepare("SELECT id_utilisateur,nom,prenom,poste FROM impliquer NATURAL JOIN utilisateur WHERE id_grp_utilisateur = ?");

if(isset($_POST['nom_grp_utilisateur'])){
    $nom_grp_utilisateur = $_POST['nom_grp_utilisateur'];
    $affiche_grp_user = $bdd->prepare("SELECT id_grp_utilisateur FROM grp_utilisateur WHERE nom_grp_utilisateur = ?");
    $affiche_grp_user->bindParam(1, $nom_grp_utilisateur);
    $affiche_grp_user->execute();
    $resultat = $affiche_grp_user->fetch();
    $query->bindParam(1, $resultat[0]);
    $query->execute();
    
    while($row = $query->fetch(PDO::FETCH_ASSOC))
    {
      echo '
      <tr>
      <td>'.$row["id_utilisateur"].'</td>
      <td>'.$row["nom"].'</td>
      <td>'.$row["prenom"].'</td>
      <td>'.$row["poste"].'</td>
      </tr>
      ';
    }
}


?>