<?php
include("../bdd/connexion.php");

$query = $bdd->prepare("SELECT * FROM W_mode_operatoire INNER JOIN U_scenario_operationnel
ON W_mode_operatoire.id_scenario_operationnel = U_scenario_operationnel.id_scenario_operationnel
WHERE U_scenario_operationnel.id_scenario_operationnel = ?");

if(isset($_POST['id_scenar'])){
    $id_scenar = $_POST['id_scenar'];
    $query->bindParam(1, $id_scenar);
    $query->execute();
    
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