<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v8");
$query = "SELECT * FROM partie_prenante";
$query_categorie_partie_prenante = "SELECT categorie_partie_prenante FROM partie_prenante";

$result = mysqli_query($connect, $query);
$result_categorie_partie_prenante = mysqli_query($connect, $query_categorie_partie_prenante);
?>