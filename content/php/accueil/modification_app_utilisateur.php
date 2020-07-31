<?php  
session_start();
include("../bdd/connexion_sqli.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;

if($input["action"] === 'edit'){
    $nom = mysqli_real_escape_string($connect, $input["nom"]);
    $prenom = mysqli_real_escape_string($connect, $input["prenom"]);
    $poste = mysqli_real_escape_string($connect, $input["poste"]);
    $email = mysqli_real_escape_string($connect, $input["email"]);
    $type_compte = mysqli_real_escape_string($connect, $input["type_compte"]);
    
    // Verification du nom
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $nom)){
        $results["error"] = true;
        $_SESSION['message_error_4'] = "Nom invalide";
    }

    // Verification du prenom
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $prenom)){
        $results["error"] = true;
        $_SESSION['message_error_4'] = "Prenom invalide";
    }

    // Verification du poste
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëç\s\-.:,'\"]{0,100}$/", $poste)){
        $results["error"] = true;
        $_SESSION['message_error_4'] = "Poste invalide";
    }

    // Verification du email
    if(!preg_match("/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", $email)){
        $results["error"] = true;
        $_SESSION['message_error_4'] = "E-mail invalide";
    }

    // Verification du type de compte
    if(!preg_match("/^[a-zA-Zéèàêâùïüëç@\s-]{0,100}$/", $type_compte)){
        $results["error"] = true;
        $_SESSION['message_error_4'] = "Type de compte invalide";
    }

    if($results["error"] === false){
        $query = "
        UPDATE A_utilisateur 
        SET nom = '".$nom."', 
        prenom = '".$prenom."',
        poste = '".$poste."',
        email = '".$email."',
        type_compte = '".$type_compte."'
        WHERE id_utilisateur = '".$input["id_utilisateur"]."'
        ";

        mysqli_query($connect, $query);
        $_SESSION['message_success_4'] = "L'utilisateur a bien été modifié !";
    }
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM A_utilisateur 
    WHERE id_utilisateur = '".$input["id_utilisateur"]."'
    ";
    mysqli_query($connect, $query);
    $_SESSION['message_success_4'] = "L'utilisateur a bien été supprimé !";
}

echo json_encode($input);

?>