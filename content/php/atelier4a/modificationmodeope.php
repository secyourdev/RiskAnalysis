<?php
//action.php
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v9");

$input = filter_input_array(INPUT_POST);

$nomscenar = mysqli_real_escape_string($connect, $input['scenario_operationnel']);
$modeope = mysqli_real_escape_string($connect, $input['mode_operatoire']);
echo "modeope : ";
echo $modeope;

$results["error"] = false;
$results["message"] = [];

echo $results["error"];
echo "\n";


// Verification du type de l'attaquant
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $modeope)) {
    $results["error"] = true;
    print $results["error"];
    $results["message"]["type_attaquant"] = "Mode opératoire invalide";
    ?>
    <strong style="color:#FF6565;">Mode opératoire invalide </br></strong>
    <?php
}



if ($input["action"] === 'edit' && $results["error"] === false) {
    echo "lol";
    $query = "
    UPDATE mode_operatoire 
    SET mode_operatoire = '".$modeope."'
    WHERE id_mode_operatoire = '".$input["id_mode_operatoire"]."'
    ";
    echo $query;
    mysqli_query($connect, $query);
}
if ($input["action"] === 'delete') {
    $query = "
    DELETE FROM mode_operatoire 
    WHERE id_mode_operatoire = '".$input["id_mode_operatoire"]."'
    ";
    mysqli_query($connect, $query);
}


echo json_encode($input);
