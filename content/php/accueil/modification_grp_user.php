<?php  
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;

if($input["action"] === 'edit'){
    $nom_grp_utilisateur = mysqli_real_escape_string($connect, $input["nom_grp_utilisateur"]);
    
    // Verification du nom
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $nom_grp_utilisateur)){
        $results["error"] = true;
    }

    if($results["error"] === false){
    $query = "
    UPDATE B_grp_utilisateur 
    SET nom_grp_utilisateur = '".$nom_grp_utilisateur."'
    WHERE id_grp_utilisateur = '".$input["id_grp_utilisateur"]."'
    ";

    mysqli_query($connect, $query);
    }
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM B_grp_utilisateur  
    WHERE id_grp_utilisateur = '".$input["id_grp_utilisateur"]."'
    ";
    mysqli_query($connect, $query);

}

echo json_encode($input);

?>