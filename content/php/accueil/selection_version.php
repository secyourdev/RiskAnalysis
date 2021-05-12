<?php
include("../bdd/connexion.php");

$query = $bdd->prepare("SELECT id_version, num_version, description_version FROM ZC_version WHERE id_projet_gen=?");

if(isset($_POST['id_projet'])){
    $id_projet = $_POST['id_projet'];
    $id_projet_gen_query = $bdd->prepare("SELECT id_projet_gen FROM F_projet WHERE id_projet = ?");
    $id_projet_gen_query->bindParam(1, $id_projet);
    $id_projet_gen_query->execute();
    $id_projet_gen = $id_projet_gen_query->fetch();
    $query->bindParam(1, $id_projet_gen[0]);
    $query->execute();
    
    while($row = $query->fetch(PDO::FETCH_ASSOC))
    {
      echo '
      <tr>
      <td>'.$row["id_version"].'</td>
      <td>'.$row["num_version"].'</td>
      <td>'.$row["description_version"].'</td>
      </tr>
      ';
    }
}


?>