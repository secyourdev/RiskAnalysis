<?php  
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v18");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM impliquer  
    WHERE id_utilisateur = '".$input["id_utilisateur"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>