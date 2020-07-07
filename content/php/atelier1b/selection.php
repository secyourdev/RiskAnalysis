<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v14");
$query1 =
    "SELECT 
mission.id_mission,
mission.nom_mission,
mis.nom as respo_mis_nom,
mis.prenom as respo_mis_prenom,
mis.poste as respo_mis_poste,
valeur_metier.nom_valeur_metier,
val.nom as respo_val_nom,
bien_support.nom_bien_support,
bien.nom as respo_bien_nom

FROM personne mis, personne val, personne bien, mission, valeur_metier, bien_support

WHERE mis.nom = (SELECT personne.nom FROM personne WHERE mission.id_personne = personne.id_personne)
AND mis.nom = (SELECT personne.nom FROM personne WHERE mission.id_personne = personne.id_personne)
AND mis.prenom = (SELECT personne.prenom FROM personne WHERE mission.id_personne = personne.id_personne)
AND valeur_metier.id_mission = mission.id_mission
AND val.nom  = (SELECT personne.nom FROM personne where personne.id_personne = valeur_metier.id_personne)
AND bien_support.id_valeur_metier = valeur_metier.id_valeur_metier
AND bien.nom = (SELECT personne.nom FROM personne WHERE bien_support.id_personne = personne.id_personne)
ORDER BY mission.id_mission ASC
";
$query2 = "SELECT 
valeur_metier.id_valeur_metier,
valeur_metier.nom_valeur_metier, 
valeur_metier.nature_valeur_metier, 
valeur_metier.description_valeur_metier 
FROM valeur_metier
ORDER BY valeur_metier.id_valeur_metier ASC";

$query3 = "SELECT 
bien_support.id_bien_support,
bien_support.nom_bien_support,
bien_support.description_bien_support
FROM bien_support
ORDER BY bien_support.id_bien_support ASC";

$queryvm = "SELECT nom_valeur_metier FROM valeur_metier";
$queryposteresponsablevm = "SELECT poste FROM personne";
// $queryprenomresponsablevm = "SELECT prenom FROM personne";

$querybien = "SELECT nom_bien_support FROM bien_support";
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