<?php
$connect = mysqli_connect("localhost", "root", "", "ebios_rm_v5");
$query = "SELECT * FROM personne ORDER BY id_personne DESC";
$result = mysqli_query($connect, $query);
?>