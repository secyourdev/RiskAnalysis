<?php
// header('Location: ../../../atelier-3c');
//Connexion à la base de donnee
// try {
//     $bdd = new PDO(
//         'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v9;charset=utf8',
//         'ebios-rm',
//         'hLLFL\bsF|&[8=m8q-$j',
//         array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
//     );
// } catch (PDOException $e) {
//     die('Erreur :' . $e->getMessage());
// }



$sJson = $_POST['json'];

// $insere_socle = $bdd->prepare('INSERT INTO socle_de_securite (type_referentiel, nom_referentiel,) VALUES ( ?, ? )');
// $recupere = $bdd->prepare("SELECT id_socle_securite FROM socle_de_securite WHERE nom_referentiel = ?");
// $insere_referentiel = $bdd->prepare('INSERT INTO referentiel (regle, id_socle_securite,) VALUES ( ?, ? )');


if (isset($_POST['validersocle'])) {
//try to decode it
    $json = json_decode($sJson);
    print_r($json);


/* if (!json_last_error() === JSON_ERROR_NONE) {
    //yep, it's not JSON. Log error or alert someone or do nothing
    $results["error"] = true;
    $results["message"]["json"] = "le fichier n'est pas au format json, format invalide";
    ?>
    <strong style="color:#FF6565;">json invalide </br></strong>
    <?php
    echo $json;
} else {
    //do something with $json. It's ready to use

        // $insere_socle->bindParam(1, $niveau_de_menace_partie_prenante);
        // $insere_socle->bindParam(2, $id_atelier);
        // $insere_socle->execute();
    } */
}
