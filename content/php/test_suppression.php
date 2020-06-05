<?php
header('Location: ../../atelier-1a#acteurs');

if (isset($_POST['supprimer'])){
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

  $id_suppr=$_POST['id_suppr'];

    if ($results["error"] === false){       
        $bdd->exec('DELETE FROM PERSONNE WHERE id_personne="'.$id_suppr.'"');
        ?>
        <strong style="color:#4AD991;">La personne a bien été supprimé !</br></strong>
        <?php
    }
}
?>