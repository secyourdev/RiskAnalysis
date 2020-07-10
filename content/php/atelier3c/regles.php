<?php
// $getid_projet = intval($_GET['id_projet']);
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v17;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}


$queryregles = $bdd->prepare("SELECT id_regle, description FROM regle WHERE id_socle_securite = ?");



if(isset($_POST['ref'])){
    $ref = $_POST['ref'];

    $queryregles->bindParam(1, $ref);
    $queryregles->execute();
    // $row = $querychemin->fetch(PDO::FETCH_ASSOC);
    // print_r($row);
    echo '
    <option value="" selected>...</option>
    ';
    while($row = $queryregles->fetch(PDO::FETCH_ASSOC))
    {
      echo '
      <option value="'.$row["id_regle"].'">'.$row["description"].'</option>
      ';
    }
}


?>