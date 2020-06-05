<?php
header('Location: ../../atelier-1a#acteurs');

if (isset($_POST['modifier'])){
  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=localhost;dbname=ebios_rm_v5;charset=utf8','root','',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

  $results["error"] = false;
  $results["message"] = [];

  $id_modifie=$_POST['id_modifie'];
  $nom_modifie=$_POST['nom_modifie'];
  $prenom_modifie=$_POST['prenom_modifie'];
  $poste_modifie=$_POST['poste_modifie'];

  // Verification du nom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_modifie)){
      $results["error"] = true;
      $results["message"]["nom_modifie"] = "Nom invalide";
      ?>
      <strong style="color:#FF6565;">Nom invalide </br></strong>
      <?php
    }

  // Verification du prenom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenom_modifie)){
      $results["error"] = true;
      $results["message"]["prenom_modifie"] = "Prenom invalide";
      ?>
      <strong style="color:#FF6565;">Prénom invalide </br></strong>
      <?php
    }

  // Verification du poste
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste_modifie)){
      $results["error"] = true;
      $results["message"]["poste_modifie"] = "Poste invalide";
      ?>
      <strong style="color:#FF6565;">Poste invalide </br></strong>
      <?php
    }

    if ($results["error"] === false){       
        $bdd->exec('UPDATE PERSONNE SET nom="'.$nom_modifie.'",prenom="'.$prenom_modifie.'",poste="'.$poste_modifie.'" WHERE id_personne="'.$id_modifie.'"');
        ?>
        <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
        <?php
    }
}
?>