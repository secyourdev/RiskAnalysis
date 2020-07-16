<?php
session_start();
$getid_projet = $_SESSION['id_projet'];
header('Content-Type: application/json');

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v18");

$query_SROV = "SELECT description_source_de_risque, objectif_vise, pertinence, choix_source_de_risque FROM SROV WHERE id_projet = $getid_projet ORDER BY id_source_de_risque";

$result_SROV = mysqli_query($connect, $query_SROV);

$data_SROV = array();
foreach ($result_SROV as $row) {
  $SROV = ($row['description_source_de_risque'] . " / " . $row['objectif_vise']);
  if ($row['pertinence'] === "Faible"){
    $pertinence = "1";
  }
  elseif ($row['pertinence'] === "Moyen"){
    $pertinence = "2";
  }
  else{
    $pertinence = "3";
  }
  $choix = $row['choix_source_de_risque'];

  $data_SROV[] = array(
    "SROV" => $SROV,
    "pertinence" => $pertinence,
    "choix" => $choix
  );
}

$data = array(
  'data_SROV' => $data_SROV,
);

mysqli_close($connect);
echo json_encode($data);
