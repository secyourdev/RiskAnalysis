<?php  
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v18");

$input = filter_input_array(INPUT_POST);

$description_niveau = mysqli_real_escape_string($connect, $input["description_niveau"]);

$results["error"] = false;

// Verification de la description
if(!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_niveau)){
    $results["error"] = true;
}

if($input["action"] === 'edit' && $results["error"] === false){
    $query = "
    UPDATE niveau 
    SET description_niveau = '".$description_niveau."'
    WHERE id_niveau = '".$input["id_niveau"]."'
    ";
    echo $query;
    mysqli_query($connect, $query);
}

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM niveau 
    WHERE id_niveau = '".$input["id_niveau"]."'
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>