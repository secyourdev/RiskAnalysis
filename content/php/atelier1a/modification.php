<?php  
session_start();
$getid_projet = $_SESSION['id_projet'];

$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v17");

$input = filter_input_array(INPUT_POST);

if($input["action"] === 'delete'){
    $query = "
    DELETE FROM RACI 
    WHERE id_utilisateur = '".$input["id_utilisateur"]."' 
    AND id_projet = $getid_projet
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>