<?php
include("../bdd/connexion.php");

$query = $bdd->prepare("SELECT id_utilisateur,nom,prenom,poste FROM C_impliquer NATURAL JOIN A_utilisateur WHERE id_grp_utilisateur = ?");

if(isset($_POST['nom_grp_utilisateur'])){
    $nom_grp_utilisateur = $_POST['nom_grp_utilisateur'];
    $affiche_grp_user = $bdd->prepare("SELECT id_grp_utilisateur FROM B_grp_utilisateur WHERE nom_grp_utilisateur = ?");
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