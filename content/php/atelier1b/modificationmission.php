<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v5");

$input = filter_input_array(INPUT_POST);


// $poste = mysqli_real_escape_string($connect, $input["poste"]);
// $nom = mysqli_real_escape_string($connect, $input["nom"]);
$nom_mission = mysqli_real_escape_string($connect, $input["nom_mission"]);
// $id_mission = 1;



$results["error"] = false;
$results["message"] = [];


// Verification de la mission
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_mission)){
    $results["error"] = true;
    $results["message"]["prenom"] = "Mission invalide";
    ?>
    <strong style="color:#FF6565;">Mission invalide </br></strong>
    <?php
}



if($input["action"] === 'edit' && $results["error"] === false){
    $query = "
    UPDATE mission 
    SET nom_mission = '".$nom_mission."'
    WHERE id_mission = '".$input["id_mission"]."'
    ";

    mysqli_query($connect, $query);
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM personne 
    WHERE id_personne = '".$input["id_mission"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>