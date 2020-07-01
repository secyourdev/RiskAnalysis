<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v9");

$input = filter_input_array(INPUT_POST);


$nom_mission = mysqli_real_escape_string($connect, $input["nom_mission"]);
$nom = mysqli_real_escape_string($connect, $input["nom"]);
$prenom = mysqli_real_escape_string($connect, $input["prenom"]);
$poste = mysqli_real_escape_string($connect, $input["poste"]);



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

// Verification du nom du responsable
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom)){
    $results["error"] = true;
    $results["message"]["prenom"] = "Nom invalide";
    ?>
    <strong style="color:#FF6565;">Nom invalide </br></strong>
    <?php
}

// Verification du prenom du responsable
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenom)){
    $results["error"] = true;
    $results["message"]["prenom"] = "Prenom invalide";
    ?>
    <strong style="color:#FF6565;">Prénom invalide </br></strong>
    <?php
}

// Verification du poste du responsable
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
    $results["error"] = true;
    $results["message"]["prenom"] = "Poste invalide";
    ?>
    <strong style="color:#FF6565;">Poste invalide </br></strong>
    <?php
}



if($input["action"] === 'edit' && $results["error"] === false){
    $queryp = "
    UPDATE personne
    SET nom = '".$nom."',
    prenom = '".$prenom."',
    poste = '".$poste."'
    WHERE id_personne = (SELECT id_personne FROM mission WHERE id_mission = '".$input["id_mission"]."')
    ";
    
    $querym = "
    UPDATE mission 
    SET nom_mission = '".$nom_mission."'
    WHERE id_mission = '".$input["id_mission"]."'
    ";

    mysqli_query($connect, $queryp);
    mysqli_query($connect, $querym);
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM mission 
    WHERE id_mission = '".$input["id_mission"]."'
    ";
    echo $query;
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>