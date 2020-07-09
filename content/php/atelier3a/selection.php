<?php
$getid_projet = intval($_GET['id_projet']);
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v14");
$query = "SELECT * FROM partie_prenante WHERE id_projet = $getid_projet";
$query_categorie_partie_prenante = "SELECT categorie_partie_prenante FROM partie_prenante WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);
$result_categorie_partie_prenante = mysqli_query($connect, $query_categorie_partie_prenante);
?>