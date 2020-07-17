<?php  
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v20");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];

if($input["action"] === 'edit'){
    $nom_grp_utilisateur = mysqli_real_escape_string($connect, $input["nom_grp_utilisateur"]);
    // Verification du nom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_grp_utilisateur)){
        $results["error"] = true;
        $results["message"]["nom"] = "Nom du groupe d'utilisateur invalide";
        ?>
        <strong style="color:#FF6565;">Nom du groupe d'utilisateur invalide </br></strong>
        <?php
    }
    if($results["error"] === false){
    $query = "
    UPDATE grp_utilisateur 
    SET nom_grp_utilisateur = '".$nom_grp_utilisateur."'
    WHERE id_grp_utilisateur = '".$input["id_grp_utilisateur"]."'
    ";

    mysqli_query($connect, $query);
    }
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM grp_utilisateur  
    WHERE id_grp_utilisateur = '".$input["id_grp_utilisateur"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>