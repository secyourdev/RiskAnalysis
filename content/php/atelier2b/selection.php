<?php
$getid_projet = intval($_GET['id_projet']);
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v17");
$query = "SELECT * FROM SROV WHERE id_projet = $getid_projet";


$result = mysqli_query($connect, $query);

?>