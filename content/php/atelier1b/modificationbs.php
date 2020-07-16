<?php  
//action.php
session_start();

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v20");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

if($input["action"] === 'edit'){
    $nom_bien_support = mysqli_real_escape_string($connect, $input["nom_bien_support"]);
    $description_bien_support = mysqli_real_escape_string($connect, $input["description_bien_support"]);

    // Verification du nom du bien support
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_bien_support)){
        $results["error"] = true;
        $results["message"]["nom"] = "Nom invalide";
        ?>
        <strong style="color:#FF6565;">Nom invalide </br></strong>
        <?php
    }

    // Verification de la description
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_bien_support)){
        $results["error"] = true;
        $results["message"]["prenom"] = "Description invalide";
        ?>
        <strong style="color:#FF6565;">Description invalide </br></strong>
        <?php
    }

    if($results["error"] === false){
        $querybs = 
        "UPDATE bien_support 
        SET nom_bien_support = '".$nom_bien_support."', 
        description_bien_support = '".$description_bien_support."'
        WHERE id_bien_support = '".$input["id_bien_support"]. "'
        AND id_atelier = '" . $id_atelier . "'
        AND id_projet = " . $id_projet . "
        ";
        mysqli_query($connect, $querybs);
    }
}

if($input["action"] === 'delete'){
    $query = 
    "DELETE FROM bien_support 
    WHERE id_bien_support = '".$input["id_bien_support"]. "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>