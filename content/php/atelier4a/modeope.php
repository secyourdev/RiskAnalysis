<?php
include("../bdd/connexion.php");

$query = $bdd->prepare("SELECT * FROM W_mode_operatoire INNER JOIN V_scenario_operationnel
ON W_mode_operatoire.id_scenario_operationnel = V_scenario_operationnel.id_scenario_operationnel
WHERE V_scenario_operationnel.id_scenario_operationnel = ?");

if(isset($_POST['id_scenar'])){
    $id_scenar = $_POST['id_scenar'];
    // echo $affiche_niveau;
    // print_r($resultat[0]);
    $query->bindParam(1, $id_scenar);
    $query->execute();
    // $row = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($row);
    
    while($row = $query->fetch(PDO::FETCH_ASSOC))
    {
      echo '
      <tr>
      <td>'.$row["id_mode_operatoire"].'</td>
      <td>'.$row["description_scenario_operationnel"].'</td>
      <td>'.$row["mode_operatoire"].'</td>
      </tr>
      ';
    }
}


?>