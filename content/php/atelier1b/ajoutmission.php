<?php
  session_start();

  header('Location: ../../../atelier-1b&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet']);
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

$results["error"] = false;
$results["message"] = [];

$nom_mission = $_POST['nom_mission'];
$nomresponsable = $_POST['nomresponsable'];
$prenomresponsable = $_POST['prenomresponsable'];
$poste = $_POST['poste'];

$nom_valeur_metier = $_POST['nom_valeur_metier'];
$posteresponsablevm = $_POST['posteresponsablevm'];

$nom_bien_support = $_POST['nom_bien_support'];
$posteresponsablebien = $_POST['posteresponsablebien'];

$id_personne = "id_personne";

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

$inserepersonne = $bdd->prepare('INSERT INTO personne(id_personne, nom, prenom, poste) VALUES (?,?,?,?)');
$inserepersonnevm = $bdd->prepare('INSERT INTO personne(id_personne, nom, prenom, poste) VALUES (?,?,?,?)');
$inserepersonnebs = $bdd->prepare('INSERT INTO personne(id_personne, nom, prenom, poste) VALUES (?,?,?,?)');
$recupere = $bdd->prepare('SELECT id_personne FROM personne WHERE nom = ? AND prenom = ? AND poste = ?');
$insere = $bdd->prepare('INSERT INTO mission(id_mission, nom_mission, id_atelier, id_personne, id_projet) VALUES (?,?,?,?,?)');

$recupereid_mission = $bdd->prepare('SELECT id_mission FROM mission WHERE nom_mission = ? AND id_atelier = ? AND id_projet = ?');
$recupereid_valeur_metier = $bdd->prepare('SELECT id_valeur_metier FROM valeur_metier WHERE nom_valeur_metier = ? AND id_atelier = ? AND id_projet = ?');


$updatevaleur = $bdd->prepare(
"UPDATE valeur_metier 
SET 
id_personne= ?,
id_mission= ?
WHERE nom_valeur_metier = ?");


$updatebien = $bdd->prepare(
  "UPDATE bien_support 
SET 
id_valeur_metier= ?,
id_personne= ?
WHERE nom_bien_support = ?");


/*   // Verification du nom de la mission
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $mission)){
      $results["error"] = true;
      $results["message"]["nom"] = "Nom invalide";
      ?>
      <strong style="color:#FF6565;">Nom invalide </br></strong>
      <?php
    }

  // Verification du nom du responsable de la mission
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nomresponsable)){
      $results["error"] = true;
      $results["message"]["prenom"] = "Nom du responsable invalide";
      ?>
      <strong style="color:#FF6565;">Nom du responsable invalide </br></strong>
      <?php
    }

    // Verification du prénom du responsable de la mission
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenomresponsable)){
      $results["error"] = true;
      $results["message"]["prenom"] = "Prénom du responsable invalide";
      ?>
      <strong style="color:#FF6565;">Prénom du responsable invalide </br></strong>
      <?php
    }

  // Verification du poste du responsable de la mission
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
      $results["error"] = true;
      $results["message"]["poste"] = "Poste invalide";
      ?>
      <strong style="color:#FF6565;">Poste invalide </br></strong>
      <?php
    }

    

    if ($results["error"] === false && isset($_POST['validermission'])){
        $inserepersonne->bindParam(1, $id_personne);
        $inserepersonne->bindParam(2, $nomresponsable);
        $inserepersonne->bindParam(3, $prenomresponsable);
        $inserepersonne->bindParam(4, $poste);
        $inserepersonne->execute();
        $recupere->bindParam(1, $nomresponsable);
        $recupere->bindParam(2, $prenomresponsable);
        $recupere->bindParam(3, $poste);
        $recupere->execute();
        $id_personne = $recupere->fetch();
        $insere->bindParam(1, $id_mission);
        $insere->bindParam(2, $mission);
        $insere->bindParam(3, $id_atelier);
        $insere->bindParam(4, $id_personne[0]);
        $insere->bindParam(5, $getid_projet);
        $insere->execute();
        ?>
        <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
        <?php
    }
    } */



if ($results["error"] === false && isset($_POST['validermission'])) {
  // insere le respo de la mission
  $inserepersonne->bindParam(1, $id_personne);
  $inserepersonne->bindParam(2, $nomresponsable);
  $inserepersonne->bindParam(3, $prenomresponsable);
  $inserepersonne->bindParam(4, $poste);
  $inserepersonne->execute();
  // recupere l'id du respo de la mission
  $recupere->bindParam(1, $nomresponsable);
  $recupere->bindParam(2, $prenomresponsable);
  $recupere->bindParam(3, $poste);
  $recupere->execute();
  $id_personne = $recupere->fetch();
  // insere la mission
  $insere->bindParam(1, $id_mission);
  $insere->bindParam(2, $nom_mission);
  $insere->bindParam(3, $id_atelier);
  $insere->bindParam(4, $id_personne[0]);
  $insere->bindParam(5, $id_projet);
  // var_dump($insere);
  $insere->execute();

  // recupere l'id de la mission
  $recupereid_mission->bindParam(1, $nom_mission);
  $recupereid_mission->bindParam(2, $id_atelier);
  $recupereid_mission->bindParam(3, $id_projet);
  $recupereid_mission->execute();
  $id_mission = $recupereid_mission->fetch();
  // insere le respo de la vm
  $inserepersonnevm->bindParam(1, $posteresponsablevm);
  $inserepersonnevm->bindParam(2, $posteresponsablevm);
  $inserepersonnevm->bindParam(3, $posteresponsablevm);
  $inserepersonnevm->bindParam(4, $posteresponsablevm);
  $inserepersonnevm->execute();
  // recupere l'id du respo de la vm -> a priori marche pas
  $recupere->bindParam(1, $posteresponsablevm);
  $recupere->bindParam(2, $posteresponsablevm);
  $recupere->bindParam(3, $posteresponsablevm);
  $recupere->execute();
  $id_personne = $recupere->fetch();
  // mets a jour la vm
  $updatevaleur->bindParam(1, $id_personne[0]);
  $updatevaleur->bindParam(2, $id_mission[0]);
  $updatevaleur->bindParam(3, $nom_valeur_metier);
  $updatevaleur->execute();
  
  // recupere l'id du bs
  $recupereid_valeur_metier->bindParam(1, $nom_valeur_metier);
  $recupereid_valeur_metier->bindParam(2, $id_atelier);
  $recupereid_valeur_metier->bindParam(3, $id_projet);
  $recupereid_valeur_metier->execute();
  $id_valeur_metier = $recupereid_valeur_metier->fetch();
  // insere le respo du bs
  $inserepersonnebs->bindParam(1, $posteresponsablebien);
  $inserepersonnebs->bindParam(2, $posteresponsablebien);
  $inserepersonnebs->bindParam(3, $posteresponsablebien);
  $inserepersonnebs->bindParam(4, $posteresponsablebien);
  $inserepersonnebs->execute();
  // recupere l'id du respo du bs
  $recupere->bindParam(1, $posteresponsablebien);
  $recupere->bindParam(2, $posteresponsablebien);
  $recupere->bindParam(3, $posteresponsablebien);
  $recupere->execute();
  $id_personne = $recupere->fetch();
  // mets a jour le bs
  $updatebien->bindParam(1, $id_valeur_metier[0]);
  $updatebien->bindParam(2, $id_personne[0]);
  $updatebien->bindParam(3, $nom_bien_support);
  $updatebien->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}


?>