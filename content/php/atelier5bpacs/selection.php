<?php
include("content/php/bdd/connexion_sqli.php");
$query = "SELECT * FROM traitement_de_securite";

$result = mysqli_query($connect, $query);

?>