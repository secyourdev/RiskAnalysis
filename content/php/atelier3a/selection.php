<?php
$getid_projet = intval($_GET['id_projet']);
$id_atelier = '3.a';
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v18");
$query = "SELECT * FROM partie_prenante WHERE id_projet = $getid_projet AND id_atelier = '$id_atelier'";

$query_categorie_partie_prenante = "SELECT categorie_partie_prenante FROM partie_prenante WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);
$result_categorie_partie_prenante = mysqli_query($connect, $query_categorie_partie_prenante);


$querytest = "SELECT niveau_de_menace_partie_prenante FROM partie_prenante ORDER BY id_partie_prenante ASC";
$resulttest = mysqli_query($connect, $querytest);
?>