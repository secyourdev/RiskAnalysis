<?php

header('Content-Type: application/json');

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v9");

$query = "SELECT id_chemin_d_attaque_strategique,dependance_residuelle,penetration_residuelle,maturite_residuelle,confiance_residuelle FROM chemin_d_attaque_strategique ORDER BY id_chemin_d_attaque_strategique";

$result = mysqli_query($connect, $query);

$data = array();
foreach ($result as $row) {
  $menace = ($row['dependance_residuelle']*$row['penetration_residuelle'])/($row['maturite_residuelle']*$row['confiance_residuelle']);
  $exposition = ($row['dependance_residuelle'] * $row['penetration_residuelle']);
  $fiabilite = ($row['maturite_residuelle'] * $row['confiance_residuelle']);

  $data[] = array(
    "menace" => $menace,
    "exposition" => $exposition,
    "fiabilite" => $fiabilite
  );
}

mysqli_close($connect);

echo json_encode($data);