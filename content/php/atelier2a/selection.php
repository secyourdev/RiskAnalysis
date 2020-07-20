<?php
$getid_projet = intval($_GET['id_projet']);
include("content/php/bdd/connexion_sqli.php");
$query = "SELECT * FROM SROV WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);

?>