<?php
  session_start();
  $getid_projet = $_SESSION['id_projet'];

  //header('Location: ../../../atelier-1b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v19;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$results["error"] = false;
$results["message"] = [];

$nom_mission = $_POST['nom_mission'];
$responsable = $_POST['responsable'];

$nom_valeur_metier = $_POST['valeur_metier'];
$nom_bien_support = $_POST['bien_support'];

echo $nom_valeur_metier;
echo $nom_bien_support;

$id_mission = "id_mission";
$id_atelier = "1.b";

$inseremission = $bdd->prepare('INSERT INTO mission(id_mission, nom_mission, responsable, id_atelier, id_projet) VALUES (?,?,?,?,?)');

// Verification du nom de la mission
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_mission)) {
    $results["error"] = true;
    $results["message"]["nom"] = "Nom invalide";
  ?>
    <strong style="color:#FF6565;">Nom invalide </br></strong>
  <?php
  }
  
  // Verification du responsable de la mission
  if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $responsable)) {
    $results["error"] = true;
    $results["message"]["responsable"] = "Responsable invalide";
  ?>
    <strong style="color:#FF6565;">Responsable invalide </br></strong>
  <?php
  }


if ($results["error"] === false && isset($_POST['validermission'])) {
    $inseremission->bindParam(1, $id_mission);
    $inseremission->bindParam(2, $nom_mission);
    $inseremission->bindParam(3, $responsable);
    $inseremission->bindParam(4, $id_atelier);
    $inseremission->bindParam(5, $getid_projet);
    $inseremission->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}


?>