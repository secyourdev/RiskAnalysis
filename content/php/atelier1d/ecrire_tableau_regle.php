<?php

include("../bdd/connexion.php");
session_start();
$getid_projet = $_SESSION['id_projet'];

$query = $bdd->prepare(
  "SELECT * FROM O_regle WHERE O_regle.id_socle_securite = ? AND id_atelier = '1.d' AND id_projet = $getid_projet ORDER BY O_regle.id_regle"
);



if (isset($_POST['nom_referentiel'])) {
  $nom_referentiel = $_POST['nom_referentiel'];
  $recupere_id_socle = $bdd->prepare("SELECT id_socle_securite FROM N_socle_de_securite WHERE nom_referentiel = ? AND id_atelier = '1.d' AND id_projet = $getid_projet");
  $recupere_id_socle->bindParam(1, $nom_referentiel);
  $recupere_id_socle->execute();
  
  $resultat_id_socle = $recupere_id_socle->fetch();
  
  $query->bindParam(1, $resultat_id_socle[0]);
  $query->execute();

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