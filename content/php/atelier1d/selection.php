<?php
<<<<<<< HEAD
//session_start();
$getid_projet = $_SESSION['id_projet'];
echo $getid_projet;
=======
// session_start();
$getid_projet = $_SESSION['id_projet'];
>>>>>>> origin/Carlos

include("content/php/bdd/connexion_sqli.php");

$query_socle = "SELECT * FROM N_socle_de_securite WHERE id_atelier = '1.d' AND id_projet = $getid_projet ORDER BY id_socle_securite";


$query_nom_referentiel = "SELECT nom_referentiel FROM N_socle_de_securite WHERE id_atelier = '1.d' AND id_projet = $getid_projet ORDER BY id_socle_securite";

$result_socle = mysqli_query($connect, $query_socle);
$result_nom_referentiel = mysqli_query($connect, $query_nom_referentiel);
$result_nom_referentiel2 = mysqli_query($connect, $query_nom_referentiel);
<<<<<<< HEAD

//Requêtes relatives à la génération du rapport

$rq_socle_sec = "SELECT type_referentiel AS 'Type de référentiel', nom_referentiel AS 'Nom du référentiel', etat_d_application AS 'État d''application' FROM N_socle_de_securite WHERE id_projet = $getid_projet";
$rq_socle_sec_tab = mysqli_query($connect, $rq_socle_sec);

$rq_regle0 = "SELECT id_regle_affichage AS 'ID de la règle', titre AS 'Titre de la règle', description AS 'Description de la règle', etat_de_la_regle AS 'État de la règle', justification_ecart AS 'Justification des écarts', responsable AS 'Responsable', dates AS 'Date limite de la mise en application' FROM O_regle WHERE id_projet = $getid_projet";

$rq_regle_tab = mysqli_query($connect, $rq_regle0);
=======
>>>>>>> origin/Carlos
