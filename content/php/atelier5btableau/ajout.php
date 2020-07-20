<?php

include("../bdd/connexion.php");

$results["error"] = false;
$results["message"] = [];

$id_chemin = $_POST['principe_de_securite'];
$id_regle = $_POST['difficulte_traitement_de_securite'];

$id_traitement_securite = "id_traitement_de_scurite";
$id_atelier = "5.b";




$recupereregle = $bdd->prepare("SELECT id_regle_affichage FROM regle WHERE id_regle = ?");
$recuperechemin = $bdd->prepare("SELECT id_risque FROM chemin_d_attaque_strategique WHERE id_chemin_d_attaque_stategique = ?");

$insere2 = $bdd->prepare('INSERT INTO `comporter_2`(`id_regle`, `id_regle_affichage`, `id_traitement_de_securite`) VALUES (?,?,?)');
$insere3 = $bdd->prepare('INSERT INTO `comporter_3`(`id_regle`, `id_regle_affichage`, `id_chemin_d_attaque_stategique`, `id_risque`) VALUES (?,?,?,?)');




if ($results["error"] === false && isset($_POST['ajouterregle'])) {
  // $recupere->bindParam(1, $nom_valeur_metier);
  // $recupere->execute();
  // $id_valeur_metier = $recupere->fetch();
  $insere->bindParam(1, $id_traitement_securite);
  $insere->bindParam(2, $principe_securite);
  $insere->bindParam(3, $difficulte);
  $insere->bindParam(4, $cout);
  $insere->bindParam(5, $date);
  $insere->bindParam(6, $statut);
  $insere->bindParam(7, $id_atelier);
  $insere->execute();

  $recuperechemin->bindParam(1, $id_chemin);
  $recuperechemin->execute();
  $id_risque = $recuperechemin->fetch();

  $recupereregle->bindParam(1, $id_regle);
  $recupereregle->execute();
  $regle_affichage = $recupereregle->fetch();

  $insere2->bindParam(1, $id_regle);
  $insere2->bindParam(2, $regle_affichage);
  $insere2->bindParam(3, NULL);
  $insere2->execute();

  $insere3->bindParam(1, $id_regle);
  $insere3->bindParam(2, $regle_affichage[0]);
  $insere3->bindParam(3, $id_chemin);
  $insere3->bindParam(4, $id_risque[0]);
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>