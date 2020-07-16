<?php
//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v20;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$query = $bdd->prepare(
  "SELECT * FROM regle WHERE regle.id_socle_securite = ? ORDER BY regle.id_regle"
);

// $query_vide = $bdd->prepare(
//   "SELECT 
//   regle.id_regle, 
//   regle.titre
//   FROM regle
//   WHERE regle.id_socle_securite = ?"
// );



if (isset($_POST['nom_referentiel'])) {
  $nom_referentiel = $_POST['nom_referentiel'];
  // echo 'nom_referentiel ' . $nom_referentiel ;
  $recupere_id_socle = $bdd->prepare("SELECT id_socle_securite FROM socle_de_securite WHERE nom_referentiel = ?");
  $recupere_id_socle->bindParam(1, $nom_referentiel);
  $recupere_id_socle->execute();

  $resultat_id_socle = $recupere_id_socle->fetch();
  // print 'resultat_id_socle: ';
  // print_r($resultat_id_socle[0]);
  // print '</br>';

  $query->bindParam(1, $resultat_id_socle[0]);
  // print 'query: ';
  // print_r($query);
  // print '</br>';
  $query->execute();


  // $resultat_final = $query->fetch(PDO::FETCH_ASSOC);
  // print 'resultat_final: ';
  // var_dump($resultat_final);
  // print '</br>';
  // print '$resultat_final == false: ';
  // var_dump($resultat_final == false);
  // print '</br>';
  // if ($resultat_final == false) {
    // print 'je suis dans false';
    // $query_vide->bindParam(1, $resultat_id_socle[0]);
    // $query_vide->execute();

    // $resultat_vide = $query_vide->fetchAll(PDO::FETCH_ASSOC);
    // print 'query_vide: ';
    // print_r($query_vide);
    // print '</br>';
    // print 'resultat_vide: ';
    // var_dump($resultat_vide);
    // print '</br>';

  //   while ($row = $query_vide->fetch(PDO::FETCH_ASSOC)) {
  //     // print_r($row);
  //     // print '</br>';
  //     // print_r($row["id_regle"]);
  //     echo '
  //     <tr>
  //     <td>' . $row['id_regle'] . '</td>
  //     <td>' . $row['id_regle'] . '</td>
  //     <td>' . $row['titre'] . '</td>
  //     <td></td>
  //     <td></td>
  //     <td></td>
  //     <td></td>
  //     </tr>
  //     ';
  //   }
  // } else {
  //   $query = $bdd->prepare(
  //     "SELECT 
  // ecarts.id_ecarts, 
  // regle.id_regle, 
  // regle.titre, 
  // regle.etat_de_la_regle, 
  // ecarts.justification_ecart, 
  // personne.nom, 
  // dates.date 
  // FROM regle, ecarts, personne, dates 
  // WHERE ecarts.id_regle = regle.id_regle 
  // AND ecarts.id_date = dates.id_date 
  // AND ecarts.id_personne = personne.id_personne 
  // AND regle.id_socle_securite = ?
  // ORDER BY regle.id_regle"
  //   );
  //   $query->bindParam(1, $resultat_id_socle[0]);
  //   // print 'query: ';
  //   // print_r($query);
  //   // print '</br>';
  //   $query->execute();
    // print 'je suis dans else';
    while ($row = $query->fetch()) {
      echo '
      <tr>
      <td>' . $row["id_regle"] . '</td>
      <td>' . $row["id_regle_affichage"] . '</td>
      <td>' . $row["titre"] . '</td>
      <td style="text-align: left;">' . $row["description"] . '</td>
      <td>' . $row["etat_de_la_regle"] . '</td>
      <td>' . $row["justification_ecart"] . '</td>
      <td>' . $row["responsable"] . '</td>
      <td>' . $row["dates"] . '</td>
      </tr>
      ';
    // }
  }
}