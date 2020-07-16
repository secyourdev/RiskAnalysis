<?php
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v21;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$query = $bdd->prepare("SELECT * FROM mode_operatoire INNER JOIN scenario_operationnel
ON mode_operatoire.id_scenario_operationnel = scenario_operationnel.id_scenario_operationnel
WHERE scenario_operationnel.id_scenario_operationnel = ?");



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