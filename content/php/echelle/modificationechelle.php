<?php  
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);


if($input["action"] === 'edit'){
    $nom_echelle = mysqli_real_escape_string($connect, $input["nom_echelle"]);
    $echelle_gravite = mysqli_real_escape_string($connect, $input["echelle_gravite"]);

    $results["error"] = false;

    // Verification du nom de l'échelle
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $nom_echelle)){
        $results["error"] = true;
        $_SESSION['message_error'] = "Nom de l'échelle invalide";
    }

    if($results["error"] === false){
        $query = "
        UPDATE DA_echelle
        SET nom_echelle = '".$nom_echelle."',
        echelle_gravite = '".$echelle_gravite."'
        WHERE id_echelle = '".$input["id_echelle"]."'
        ";
        mysqli_query($connect, $query);
        
        if ($echelle_gravite === "4"){
            $query4 = "
            DELETE FROM DA_niveau
            WHERE id_echelle = '".$input["id_echelle"]."'
            AND valeur_niveau = '5'
            ";
            mysqli_query($connect, $query4);
        }
        else {
            $querycount = "SELECT * FROM DA_niveau
            WHERE id_echelle = '".$input["id_echelle"]."'
            ";
            $result = mysqli_query($connect, $querycount);
            if(mysqli_num_rows($result) === 4){
                $query5 = "
                INSERT INTO DA_niveau (id_niveau, description_niveau, valeur_niveau, id_echelle) 
                VALUES (NULL, NULL, 5, '".$input["id_echelle"]."')
                ";
                mysqli_query($connect, $query5);
                }      
        }
        $_SESSION['message_success'] = "L'échelle a bien été modifiée !";
    }
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM DA_echelle 
    WHERE id_echelle = '".$input["id_echelle"]."'
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_success'] = "L'échelle a bien été supprimée !";
}

echo json_encode($input);

?>