<?php
include("content/php/bdd/connexion_sqli.php");

$query = "SELECT * FROM traitement_de_securite
NATURAL JOIN comporter_2
INNER JOIN mesure ON mesure.id_mesure = traitement_de_securite.id_mesure
INNER JOIN chemin_d_attaque_strategique ON comporter_2.id_chemin_d_attaque_strategique = chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
";

$result = mysqli_query($connect, $query);

?>