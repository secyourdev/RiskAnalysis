<?php  
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;

if($input["action"] === 'edit'){
    $nom = mysqli_real_escape_string($connect, $input["nom"]);
    $prenom = mysqli_real_escape_string($connect, $input["prenom"]);
    $poste = mysqli_real_escape_string($connect, $input["poste"]);
    $email = mysqli_real_escape_string($connect, $input["email"]);
    $type_compte = mysqli_real_escape_string($connect, $input["type_compte"]);
    
    // Verification du nom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom)){
        $results["error"] = true;
    }

    // Verification du prenom
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $prenom)){
        $results["error"] = true;
    }

    // Verification du poste
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $poste)){
        $results["error"] = true;
    }

    // Verification du email
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s.,-@]{1,100}$/", $email)){
        $results["error"] = true;
    }

    // Verification du type de compte
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç@\s-]{1,100}$/", $type_compte)){
        $results["error"] = true;
    }

    if($results["error"] === false){
        $query = "
        UPDATE utilisateur 
        SET nom = '".$nom."', 
        prenom = '".$prenom."',
        poste = '".$poste."',
        email = '".$email."',
        type_compte = '".$type_compte."'
        WHERE id_utilisateur = '".$input["id_utilisateur"]."'
        ";

        mysqli_query($connect, $query);

    }
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM utilisateur 
    WHERE id_utilisateur = '".$input["id_utilisateur"]."'
    ";
    mysqli_query($connect, $query);

}

echo json_encode($input);

?>