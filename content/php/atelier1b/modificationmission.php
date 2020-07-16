<?php
//action.php
session_start();
$connect = mysqli_connect("mysql-ebios-rm.alwaysdata.net", "ebios-rm", 'hLLFL\bsF|&[8=m8q-$j', "ebios-rm_v21");

$input = filter_input_array(INPUT_POST);

$results["error"] = false;
$results["message"] = [];

$id_atelier = "1.b";
$id_projet = $_SESSION['id_projet'];;

if ($input["action"] === 'edit') {

    $nom_mission = mysqli_real_escape_string($connect, $input["nom_mission"]);
    $responsable = mysqli_real_escape_string($connect, $input["responsable"]);
    $nom_responsable_vm = mysqli_real_escape_string($connect, $input["nom_responsable_vm"]);
    $nom_responsable_bs = mysqli_real_escape_string($connect, $input["nom_responsable_bs"]);

    // Verification de la mission
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_mission)) {
        $results["error"] = true;
        $results["message"]["mission"] = "Mission invalide";
    ?>
        <strong style="color:#FF6565;">Mission invalide </br></strong>
    <?php
    }

    // Verification du responsable de la mission
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $responsable)) {
        $results["error"] = true;
        $results["message"]["responsable"] = "Responsable invalide";
    ?>
        <strong style="color:#FF6565;">Responsable invalide </br></strong>
    <?php
    }

    // Verification du responsable de la valeur métier
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_responsable_vm)) {
        $results["error"] = true;
        $results["message"]["responsable_vm"] = "Responsable Valeur Métier invalide";
    ?>
        <strong style="color:#FF6565;">Responsable Valeur Métier invalide </br></strong>
    <?php
    }

    // Verification du responsable du bien support
    if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_responsable_bs)) {
        $results["error"] = true;
        $results["message"]["responsable_bs"] = "Responsable Bien Support invalide";
    ?>
        <strong style="color:#FF6565;">Responsable Bien Support invalide </br></strong>
    <?php
    }

    if($results["error"] === false){
    $query = 
    "UPDATE mission 
    SET nom_mission = '" . $nom_mission . "',
    responsable = '".$responsable."'
    WHERE id_mission = '" . $input["id_mission"] . "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";

    mysqli_query($connect, $query);

    $query_couple = 
    "UPDATE couple_VMBS 
    SET nom_responsable_vm = '" . $nom_responsable_vm . "',
    nom_responsable_bs = '".$nom_responsable_bs."'
    WHERE id_mission = '" . $input["id_mission"] . "'
    ";

    mysqli_query($connect, $query_couple);
    }
}

if ($input["action"] === 'delete') {
    $query = 
    "DELETE FROM mission 
    WHERE id_mission = '" . $input["id_mission"] . "'
    AND id_atelier = '" . $id_atelier . "'
    AND id_projet = " . $id_projet . "
    ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>