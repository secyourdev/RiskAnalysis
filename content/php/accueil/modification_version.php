<?php  
session_start();
include("../bdd/connexion.php");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];
$id_version = $_POST["id_version"];

if ($input["action"] === 'edit') {

    
    $num_version = $_POST["num_version"];
    $description_version = $_POST["description_version"];

    // Verification de la mission
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $num_version)) {
        $results["error"] = true;
        $_SESSION['message_error_5'] = "Num Version Invalide";
    }

    // Verification de la description de la mission
    if (!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,1000}$/", $description_version)) {
        $results["error"] = true;
        $_SESSION['message_error_5'] = "Description versionn invalide";
    }


    if($results["error"] === false){
    $update = $bdd->prepare("UPDATE `ZC_version` SET `num_version`=?, `description_version`=? WHERE `id_version`=?");
    $update->bindParam(1, $num_version);
    $update->bindParam(2, $description_version);
    $update->bindParam(3, $id_version);
    $update->execute();

    $_SESSION['message_success_5'] = "La version a bien été modifiée !";
    }
}

if($input["action"] === 'delete'){
    // Récupéré l'id_projet et l'id_projet_gen associés à la version
    $projet_query = $bdd->prepare("SELECT id_projet, id_projet_gen FROM F_projet WHERE id_version = ?");
    $projet_query->bindParam(1, $id_version);
    $projet_query->execute();
    $projet_res = $projet_query->fetch(PDO::FETCH_ASSOC);
    $id_projet = $projet_res["id_projet"]; // récupérer l'id_projet de la version
    $id_projet_gen = $projet_res["id_projet_gen"]; // récupérer l'id_projet_gen 
   
    // Récupérer l'id de la version la plus récente du projet
    $query_last_id_projet = $bdd->prepare("SELECT * FROM F_projet WHERE id_projet_gen = ? ORDER BY id_projet DESC");
    $query_last_id_projet->bindParam(1, $id_projet_gen);
    $query_last_id_projet->execute();   

    $last_id_projet_res = $query_last_id_projet->fetch(PDO::FETCH_ASSOC);
    $last_id_projet = $last_id_projet_res['id_projet'];
    // récupérer le nombre de version disponible dans le projet.
    $count_version = $query_last_id_projet->rowCount(); 
   
    if ($count_version == 1) {
        $_SESSION['message_error_5'] = "Il ne reste qu'une version du projet. Suppression impossible!"."- Count : ".$count_version;
    }
    else {
        // Supprimer le projet associé à la version
        $update_projet = $bdd->prepare("DELETE FROM `F_projet` WHERE `id_projet`=?");
        $update_projet->bindParam(1, $id_projet);
        $update_projet->execute();

        $update_projet = $bdd->prepare("DELETE FROM `ZC_version` WHERE `id_version`=?");
        $update_projet->bindParam(1, $id_version);
        $update_projet->execute();
    }    

    // Si la version supprimée est la version courante alors changer de version courante pour la version précédente
    if ($last_id_projet == $id_projet){
        // récupérer l'avant dernière version de projet
        $new_current_id_projet_res = $query_last_id_projet->fetch(PDO::FETCH_ASSOC); 
        $new_current_id_projet = $new_current_id_projet_res['id_projet'];
        // Mette à jour l'id projet courant
        $update = $bdd->prepare("UPDATE `ZD_projet_gen` SET `id_projet_desc_current`=? WHERE `id_projet_gen`=?");
        $update->bindParam(1, $new_current_id_projet);
        $update->bindParam(2, $id_projet_gen);
        $update->execute();
    }
    
    $_SESSION['message_success_5'] = "La version a bien été supprimé de ce groupe !"."- Count : ".$count_version." - id_projet : ".$id_projet." - id_projet_gen :".$id_projet_gen;
            
}

echo json_encode($input);

?>
