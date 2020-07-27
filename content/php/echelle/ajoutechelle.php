<?php
session_start();

include("../bdd/connexion.php");

$results["error"] = false;

$nom_echelle=$_POST['nom_echelle'];
$echelle_gravite=$_POST['echelle_gravite'];
$id_echelle="id_echelle";

$insere = $bdd->prepare('INSERT INTO `DA_echelle`(`id_echelle`, `nom_echelle`, `echelle_gravite`, `echelle_vraisemblance`) VALUES (?,?,?,0)');
$recupere = $bdd->prepare('SELECT id_echelle FROM DA_echelle WHERE nom_echelle = ?');

$insere_niveau_1 = $bdd->prepare('INSERT INTO `DA_niveau`(`id_niveau`, `description_niveau`, `valeur_niveau`, `id_echelle`) VALUES (NULL, NULL, 1,?)');
$insere_niveau_2 = $bdd->prepare('INSERT INTO `DA_niveau`(`id_niveau`, `description_niveau`, `valeur_niveau`, `id_echelle`) VALUES (NULL, NULL, 2,?)');
$insere_niveau_3 = $bdd->prepare('INSERT INTO `DA_niveau`(`id_niveau`, `description_niveau`, `valeur_niveau`, `id_echelle`) VALUES (NULL, NULL, 3,?)');
$insere_niveau_4 = $bdd->prepare('INSERT INTO `DA_niveau`(`id_niveau`, `description_niveau`, `valeur_niveau`, `id_echelle`) VALUES (NULL, NULL, 4,?)');
$insere_niveau_5 = $bdd->prepare('INSERT INTO `DA_niveau`(`id_niveau`, `description_niveau`, `valeur_niveau`, `id_echelle`) VALUES (NULL, NULL, 5,?)');

  // Verification du nom de l'echelle
  if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_echelle)){
    $results["error"] = true;
    $_SESSION['message_error'] = "Nom de l'échelle invalide";
  }

  if ($results["error"] === false && isset($_POST['validerechelle'])){
    $insere->bindParam(1, $id_echelle);
    $insere->bindParam(2, $nom_echelle);
    $insere->bindParam(3, $echelle_gravite);
    $insere->execute();
    $recupere->bindParam(1, $nom_echelle);
    $recupere->execute();
    $id_echelle = $recupere->fetch();
    $insere_niveau_1->bindParam(1, $id_echelle[0]);
    $insere_niveau_2->bindParam(1, $id_echelle[0]);
    $insere_niveau_3->bindParam(1, $id_echelle[0]);
    $insere_niveau_4->bindParam(1, $id_echelle[0]);

    $insere_niveau_1->execute();
    $insere_niveau_2->execute();
    $insere_niveau_3->execute();
    $insere_niveau_4->execute();
    if ($echelle_gravite === "5"){
      $insere_niveau_5->bindParam(1, $id_echelle[0]);
      $insere_niveau_5->execute();
    }
    $_SESSION['message_success'] = "L'échelle a bien été ajoutée !";
  }

  header('Location: ../../../atelier-1c&'.$_SESSION['id_utilisateur'].'&'.$_SESSION['id_projet'].'#echelle');

?>