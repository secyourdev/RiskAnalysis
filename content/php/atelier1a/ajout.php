<?php
header('Location: ../../../atelier-1a#acteurs');

  //Connexion à la base de donnee
  try{
    $bdd=new PDO('mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v6;charset=utf8','ebios-rm','hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch(PDOException $e){
    die('Erreur :'.$e->getMessage());
  }

  $results["error"] = false;
  $results["message"] = [];

  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $poste=$_POST['poste'];

  $insertutilisateur = $bdd->prepare('INSERT INTO `utilisateur`(`id_utilisateur`, `nom`, `prenom`, `poste`) VALUES (?,?,?,?)');
  $recupereutilisateur = $bdd->prepare('SELECT id_utilisateur FROM utilisateur WHERE nom = ? AND prenom = ? AND poste = ?');

  // Verification du nom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom)){
      $results["error"] = true;
      $results["message"]["nom"] = "Nom invalide";
      ?>
      <strong style="color:#FF6565;">Nom invalide </br></strong>
      <?php
    }

  // Verification du prenom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenom)){
      $results["error"] = true;
      $results["message"]["prenom"] = "Prenom invalide";
      ?>
      <strong style="color:#FF6565;">Prénom invalide </br></strong>
      <?php
    }

  // Verification du poste
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
      $results["error"] = true;
      $results["message"]["poste"] = "Poste invalide";
      ?>
      <strong style="color:#FF6565;">Poste invalide </br></strong>
      <?php
    }

    if ($results["error"] === false && isset($_POST['valider'])){
        $insertutilisateur->bindParam(1, $id_utilisateur);
        $insertutilisateur->bindParam(2, $nom);
        $insertutilisateur->bindParam(3, $prenom);
        $insertutilisateur->bindParam(4, $poste);
        $insertutilisateur->execute();

        $recupereutilisateur->bindParam(1, $nom);
        $recupereutilisateur->bindParam(2, $prenom);
        $recupereutilisateur->bindParam(3, $poste);
        $recupereutilisateur->execute();
        $id_personne = $recupereutilisateur->fetch();

        $insert_raci_1a = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "1.a", "Information")');
        $insert_raci_1b = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "1.b", "Information")');
        $insert_raci_1c = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "1.c", "Information")');
        $insert_raci_1d = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "1.d", "Information")');
        $insert_raci_2a = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "2.a", "Information")');
        $insert_raci_2b = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "2.b", "Information")');
        $insert_raci_3a = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "3.a", "Information")');
        $insert_raci_3b = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "3.b", "Information")');
        $insert_raci_3c = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "3.c", "Information")');
        $insert_raci_4a = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "4.a", "Information")');
        $insert_raci_4b = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "4.b", "Information")');
        $insert_raci_5a = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "5.a", "Information")');
        $insert_raci_5b = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "5.b", "Information")');
        $insert_raci_5c = $bdd->prepare('INSERT INTO disposer (`id_utilisateur`, `id_atelier`, `ecriture`) VALUES ("'.$id_personne[0].'", "5.c", "Information")');
        $insert_raci_1a->execute();
        $insert_raci_1b->execute();
        $insert_raci_1c->execute();
        $insert_raci_1d->execute();
        $insert_raci_2a->execute();
        $insert_raci_2b->execute();
        $insert_raci_3a->execute();
        $insert_raci_3b->execute();
        $insert_raci_3c->execute();
        $insert_raci_4a->execute();
        $insert_raci_4b->execute();
        $insert_raci_5a->execute();
        $insert_raci_5b->execute();
        $insert_raci_5c->execute();

        ?>
        <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
        <?php
    }
?>