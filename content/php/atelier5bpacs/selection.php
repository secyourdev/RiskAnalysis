<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");

$query = "SELECT * FROM ZA_traitement_de_securite
NATURAL JOIN ZB_comporter_2
INNER JOIN Y_mesure ON Y_mesure.id_mesure = ZA_traitement_de_securite.id_mesure
INNER JOIN T_chemin_d_attaque_strategique ON ZB_comporter_2.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
WHERE id_projet = $getid_projet
";

$result = mysqli_query($connect, $query);

?>