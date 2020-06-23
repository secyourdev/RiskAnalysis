<?php

header('Content-Type: application/json');

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v9");

$query = "SELECT id_partie_prenante,dependance_partie_prenante,penetration_partie_prenante,maturite_partie_prenante,confiance_partie_prenante FROM partie_prenante WHERE type = 'Externe' ORDER BY id_partie_prenante";

$result = mysqli_query($connect, $query);

$data = array();
foreach ($result as $row) {
  $menace = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']) / ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);
  $exposition = ($row['dependance_partie_prenante'] * $row['penetration_partie_prenante']);
  $fiabilite = ($row['maturite_partie_prenante'] * $row['confiance_partie_prenante']);

  $data[] = array(
    "menace" => $menace,
    "exposition" => $exposition,
    "fiabilite" => $fiabilite
  );
}

mysqli_close($connect);

echo json_encode($data);
