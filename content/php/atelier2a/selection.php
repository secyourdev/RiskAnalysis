<?php
<<<<<<< HEAD
$getid_projet = $_SESSION['id_projet'];
=======
$getid_projet = intval($_GET['id_projet']);
>>>>>>> origin/Carlos
include("content/php/bdd/connexion_sqli.php");
$query = "SELECT * FROM P_SROV WHERE id_projet = $getid_projet";

$result = mysqli_query($connect, $query);

<<<<<<< HEAD
//Requêtes relatives à la génération du Rapport

$rq_srov = "SELECT type_d_attaquant_source_de_risque AS 'Type d''ttaquant', profil_de_l_attaquant_source_de_risque AS 'Profil d''attaquant', description_source_de_risque AS 'Description source de risque', objectif_vise AS 'Objectif visé',description_objectif_vise AS 'Description de l''objectif' FROM P_SROV WHERE id_projet=$getid_projet";
$rq_srov_tab = mysqli_query($connect, $rq_srov);

?>
=======
?>
>>>>>>> origin/Carlos
