<?php
$getid_projet = intval($_GET['id_projet']);

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v14");
// $query1 = "SELECT * FROM mission NATURAL JOIN personne WHERE id_projet = $getid_projet ORDER BY id_mission ASC";
// $query2 = "SELECT * FROM valeur_metier NATURAL JOIN personne INNER JOIN mission ON valeur_metier.id_mission = mission.id_mission WHERE valeur_metier.id_projet = $getid_projet ORDER BY id_valeur_metier DESC";
// $query3 = "SELECT * FROM bien_support NATURAL JOIN personne INNER JOIN valeur_metier ON bien_support.id_valeur_metier = valeur_metier.id_valeur_metier WHERE bien_support.id_projet = $getid_projet ORDER BY id_bien_support DESC";
// $querymission = "SELECT nom_mission FROM mission WHERE id_projet = $getid_projet";
// $connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v13");

// $query1 =
//     "SELECT 
// mission.id_mission,
// mission.nom_mission,
// mis.nom as respo_mis_nom,
// mis.prenom as respo_mis_prenom,
// mis.poste as respo_mis_poste,
// valeur_metier.nom_valeur_metier,
// val.nom as respo_val_nom,
// bien_support.nom_bien_support,
// bien.nom as respo_bien_nom

// FROM personne mis, personne val, personne bien, mission, valeur_metier, bien_support

// WHERE mis.nom = (SELECT personne.nom FROM personne WHERE mission.id_personne = personne.id_personne)
// AND mis.nom = (SELECT personne.nom FROM personne WHERE mission.id_personne = personne.id_personne)
// AND mis.prenom = (SELECT personne.prenom FROM personne WHERE mission.id_personne = personne.id_personne)
// AND valeur_metier.id_mission = mission.id_mission
// AND val.nom  = (SELECT personne.nom FROM personne where personne.id_personne = valeur_metier.id_personne)
// AND bien_support.id_valeur_metier = valeur_metier.id_valeur_metier
// AND bien.nom = (SELECT personne.nom FROM personne WHERE bien_support.id_personne = personne.id_personne)
// ORDER BY mission.id_mission ASC
// ";

$query1 = "SELECT mission.id_mission, nom_mission, personne.nom as nom_respo_mission, personne.prenom as prenom_mission, personne.poste as poste_mission, 
nom_valeur_metier, vm.nom as respo_vm, 
nom_bien_support, bs.nom as respo_bs 
FROM mission INNER JOIN personne ON mission.id_personne = personne.id_personne
INNER JOIN (SELECT * FROM valeur_metier NATURAL JOIN personne) vm
ON mission.id_mission = vm.id_mission
INNER JOIN (SELECT * FROM bien_support NATURAL JOIN personne) bs
ON vm.id_valeur_metier = bs.id_valeur_metier
WHERE mission.id_projet = $getid_projet
";

$query2 = "SELECT 
valeur_metier.id_valeur_metier,
valeur_metier.nom_valeur_metier, 
valeur_metier.nature_valeur_metier, 
valeur_metier.description_valeur_metier 
FROM valeur_metier
WHERE id_projet = $getid_projet
ORDER BY valeur_metier.id_valeur_metier ASC";

$query3 = "SELECT 
bien_support.id_bien_support,
bien_support.nom_bien_support,
bien_support.description_bien_support
FROM bien_support
WHERE id_projet = $getid_projet
ORDER BY bien_support.id_bien_support ASC";

$queryvm = "SELECT nom_valeur_metier FROM valeur_metier WHERE id_projet = $getid_projet";
$queryposteresponsablevm = "SELECT poste FROM personne";
// $queryprenomresponsablevm = "SELECT prenom FROM personne";

$querybien = "SELECT nom_bien_support FROM bien_support WHERE id_projet = $getid_projet";
$queryposteresponsablebien = "SELECT poste FROM personne";
// $queryprenomresponsablebien = "SELECT prenom FROM personne";


$result1 = mysqli_query($connect, $query1);
$result2 = mysqli_query($connect, $query2);
$result3 = mysqli_query($connect, $query3);

$resultvm = mysqli_query($connect, $queryvm);
$resultposteresponsablevm = mysqli_query($connect, $queryposteresponsablevm);
// $resultprenomresponsablevm = mysqli_query($connect, $queryprenomresponsablevm);

$resultbien = mysqli_query($connect, $querybien);
$resultposteresponsablebien = mysqli_query($connect, $queryposteresponsablebien);
// $resultprenomresponsablebien = mysqli_query($connect, $queryprenomresponsablebien);