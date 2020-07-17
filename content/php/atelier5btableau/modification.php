<?php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

$input = filter_input_array(INPUT_POST);

// $type_attaquant = mysqli_real_escape_string($connect, $input['type_d_attaquant_source_de_risque']);
// $profil_attaquant = mysqli_real_escape_string($connect, $input['profil_de_l_attaquant_source_de_risque']);
// $description_source_risque = mysqli_real_escape_string($connect, $input['description_source_de_risque']);
// $objectif_vise = mysqli_real_escape_string($connect, $input['objectif_vise']);
// $description_objectif_vise = mysqli_real_escape_string($connect, $input['description_objectif_vise']);
// $motivation = mysqli_real_escape_string($connect, $input['motivation']);
// $ressources = mysqli_real_escape_string($connect, $input['ressources']);
// $activite = mysqli_real_escape_string($connect, $input['activite']);
// $mode_operatoire = mysqli_real_escape_string($connect, $input['mode_operatoire']);
// $secteur_activite = mysqli_real_escape_string($connect, $input['secteur_d_activite']);
// $arsenal_attaque = mysqli_real_escape_string($connect, $input['arsenal_d_attaque']);
// $faits_armes = mysqli_real_escape_string($connect, $input['faits_d_armes']);
// $pertinence = mysqli_real_escape_string($connect, $input['pertinence']);
// $choix_sr = mysqli_real_escape_string($connect, $input['choix_source_de_risque']);


// $results["error"] = false;
// $results["message"] = [];





// // Verification du type de l'attaquant
// if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $type_attaquant)) {
//     $results["error"] = true;
//     $results["message"]["type_attaquant"] = "Type de l'attaquant invalide";
//     ?>
//     <strong style="color:#FF6565;">Type de l'attaquant invalide </br></strong>
//     <?php
// }

// // Verification du profil de l'attaquant
// if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,1000}$/", $profil_attaquant)) {
//     $results["error"] = true;
//     $results["message"]["Profil de l'attaquant"] = "Profil de l'attaquant invalide";
//     ?>
//     <strong style="color:#FF6565;">Profil de l'attaquant invalide </br></strong>
//     <?php
// }

// // Verification de la description de l'attaquant
// if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_source_risque)) {
//     $results["error"] = true;
//     $results["message"]["impact"] = "Description de la source de risque invalide";
//     ?>
//     <strong style="color:#FF6565;">Description de la source de risque invalide </br></strong>
//     <?php
// }
// // Verification de l'objectif visé
// if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $objectif_vise)) {
//     $results["error"] = true;
//     $results["message"]["objectif vise"] = "Objectif vise invalide";
//     ?>
//     <strong style="color:#FF6565;">Objectif visé invalide </br></strong>
//     <?php
// }

// // Verification de la description de l'objectif visé
// if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $description_objectif_vise)) {
//     $results["error"] = true;
//     $results["message"]["description objectif vise"] = "Description objectif vise invalide";
//     ?>
//     <strong style="color:#FF6565;">Descrition objectif visé invalide </br></strong>
//     <?php
// }

// // Verification du mode opératoire
// if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $mode_operatoire)) {
//     $results["error"] = true;
//     $results["message"]["description objectif vise"] = "Mode opératoire invalide";
//     ?>
//     <strong style="color:#FF6565;">Mode opératoire invalide </br></strong>
//     <?php
// }

// // Verification du secteur d'activité
// if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $secteur_activite)) {
//     $results["error"] = true;
//     $results["message"]["description objectif vise"] = "Secteur d'activité invalide";
//     ?>
//     <strong style="color:#FF6565;">Secteur d'activité invalide </br></strong>
//     <?php
// }

// // Verification de l'arsenal d'attaque'
// if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $arsenal_attaque)) {
//     $results["error"] = true;
//     $results["message"]["description objectif vise"] = "Arsenal d'attaque invalide";
//     ?>
//     <strong style="color:#FF6565;">Arsenal d'attaque invalide </br></strong>
//     <?php
// }

// // Verification des afaits d'armes
// if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s-]{1,100}$/", $faits_armes)) {
//     $results["error"] = true;
//     $results["message"]["description objectif vise"] = "Faits d'armes invalide";
//     ?>
//     <strong style="color:#FF6565;">Faits d'armes invalide </br></strong>
//     <?php
// }

// if ($input["action"] === 'edit' && $results["error"] === false) {
    
//     $query = "
//     UPDATE SROV 
//     SET type_d_attaquant_source_de_risque = '".$type_attaquant."',
//     profil_de_l_attaquant_source_de_risque = '".$profil_attaquant."',
//     description_source_de_risque = '".$description_source_risque."',
//     objectif_vise = '".$objectif_vise."',
//     description_objectif_vise = '".$description_objectif_vise."',
//     motivation = '".$motivation."',
//     ressources = '".$ressources."',
//     activite = '".$activite."',
//     mode_operatoire = '".$mode_operatoire."',
//     secteur_d_activite = '".$secteur_activite."',
//     arsenal_d_attaque = '".$arsenal_attaque."',
//     faits_d_armes = '".$faits_armes."',
//     pertinence = '".$pertinence."',
//     choix_source_de_risque = '".$choix_sr."'
//     WHERE id_source_de_risque = '".$input["id_source_de_risque"]."'
//     ";
//     mysqli_query($connect, $query);
// }
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM comporter_2 
    WHERE id_mesure = '".$input["id_mesure"]."'
    ";
    $query2 = "
    DELETE FROM mesure 
    WHERE id_mesure = '".$input["id_mesure"]."'
    ";
    mysqli_query($connect, $query2);
}


echo json_encode($input);
