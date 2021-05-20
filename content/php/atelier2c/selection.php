<?php
<<<<<<< HEAD
// $getid_projet = intval($_GET['id_projet']);

$getid_projet = $_SESSION['id_projet'];


=======
$getid_projet = intval($_GET['id_projet']);
>>>>>>> origin/Carlos
include("content/php/bdd/connexion_sqli.php");
$query = "SELECT * FROM P_SROV WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);

<<<<<<< HEAD
$rq_srov3 = "SELECT profil_de_l_attaquant_source_de_risque AS 'Profil d''attaquant', description_source_de_risque AS 'Description source du risque', objectif_vise AS 'Objectif visé', description_objectif_vise AS 'Description de l''objectif', motivation AS 'Motivation', ressources AS 'Ressources', activite AS 'Activité', mode_operatoire AS 'Mode opératoire', secteur_d_activite AS 'Secteur d''activité', arsenal_d_attaque AS 'Arsenal d''attaque', faits_d_armes AS 'Fait d''armes', pertinence AS 'Pertinence', choix_source_de_risque AS 'Choix P1/P2' FROM P_SROV WHERE id_projet = $getid_projet";
$rq_srov3_tab = mysqli_query($connect, $rq_srov3);

?>
=======
?>
>>>>>>> origin/Carlos
