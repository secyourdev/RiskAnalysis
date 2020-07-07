<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v14");

$input = filter_input_array(INPUT_POST);

$nom_echelle = mysqli_real_escape_string($connect, $input["nom_echelle"]);
$echelle_gravite = mysqli_real_escape_string($connect, $input["echelle_gravite"]);


$results["error"] = false;
$results["message"] = [];

// Verification du nom de l'échelle
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_echelle)){
    $results["error"] = true;
    $results["message"]["nom"] = "Nom de l'échelle invalide";
    ?>
    <strong style="color:#FF6565;">Nom de l'échelle invalide </br></strong>
    <?php
}




if($input["action"] === 'edit' && $results["error"] === false){
    $query = "
    UPDATE echelle
    SET nom_echelle = '".$nom_echelle."',
    echelle_gravite = '".$echelle_gravite."'
    WHERE id_echelle = '".$input["id_echelle"]."'
    ";
    mysqli_query($connect, $query);

    if ($echelle_gravite === "4"){
        $query4 = "
        DELETE FROM niveau
        WHERE id_echelle = '".$input["id_echelle"]."'
        AND valeur_niveau = '5'
        ";
        mysqli_query($connect, $query4);
    }
    else {
        $querycount = "SELECT * FROM niveau
        WHERE id_echelle = '".$input["id_echelle"]."'
        ";
        $result = mysqli_query($connect, $querycount);
        if(mysqli_num_rows($result) === 4){
        $query5 = "
            INSERT INTO niveau (id_niveau, description_niveau, valeur_niveau, id_echelle) 
            VALUES (NULL, NULL, 5, '".$input["id_echelle"]."')
            ";
            echo $query5;
            mysqli_query($connect, $query5);
            }      
    }
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM echelle 
    WHERE id_echelle = '".$input["id_echelle"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>