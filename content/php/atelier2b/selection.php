<?php
// $getid_projet = intval($_GET['id_projet']);
$getid_projet = $_SESSION['id_projet'];
include("content/php/bdd/connexion_sqli.php");
$query = "SELECT * FROM P_SROV WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);


//Requêtes relatives à la génération de Rapport


$rq_srov2 = "SELECT profil_de_l_attaquant_source_de_risque AS 'Profil d''attaquant', description_source_de_risque AS 'Description source du risque', objectif_vise AS 'Objectif visé', description_objectif_vise AS 'Description de l''objectif', motivation AS 'Motivation', ressources AS 'Ressources', activite AS 'Activité', mode_operatoire AS 'Mode opératoire', secteur_d_activite AS 'Secteur d''activité', arsenal_d_attaque AS 'Arsenal d''attaque', faits_d_armes AS 'Fait d''armes', pertinence AS 'Pertinence' FROM P_SROV WHERE id_projet = $getid_projet";
$rq_srov2_tab = mysqli_query($connect,$rq_srov2);

?>
