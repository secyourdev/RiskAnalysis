<?php
header('Location: ../../../atelier-1d');


//Connexion à la base de donnee
try {
  $bdd = new PDO(
    'mysql:host=mysql-ebios-rm.alwaysdata.net;dbname=ebios-rm_v5;charset=utf8',
    'ebios-rm',
    'hLLFL\bsF|&[8=m8q-$j',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  die('Erreur :' . $e->getMessage());
}

$results["error"] = false;
$results["message"] = [];

$nom_valeur_metier = $_POST['nom_valeur_metier'];
$nom_evenement_redoutes = $_POST['nom_evenement_redoutes'];
$description_evenement_redoutes = $_POST['description_evenement_redoutes'];
$impact = $_POST['impact'];
$confidentialite = 0;
$integrite = 0;
$disponibilite = 0;
$tracabilite = 0;
$niveau_de_gravite = $_POST['niveau_de_gravite'];
$id_atelier = '1.d';

$formcheck = $_POST['formcheck'];
print_r($_POST['formcheck']);

/* $check_results= array();

if (empty($formcheck)) {
  echo ("You didn't select any buildings.");
} else {
  $N = count($formcheck);

  echo ("You selected $N door(s): ");
  for ($i = 0; $i < 4; $i++) {
    if ($formcheck[$i]){
      array_push($check_results, $formcheck[$i]);
    }
    else{
      array_push($check_results, 0);
    }
    list($integrite, $disponibilite, $tracabilite, $niveau_de_gravite) = $check_results;
    echo ($formcheck[$i] . " ");
  }
}
print 'resultat ';
print_r($check_results);
 */

function IsChecked($chkname, $value)
{
  if (!empty($_POST[$chkname])) {
    foreach ($_POST[$chkname] as $chkval) {
      if ($chkval == $value) {
        return true;
      }
    }
  }
  return false;
};
if (IsChecked('formcheck', '1')) {
  //do somthing ...
  $confidentialite = 1;
};
if (IsChecked('formcheck', '2')) {
  //do somthing ...
  $integrite = 1;
};
if (IsChecked('formcheck', '3')) {
  //do somthing ...
  $disponibilite = 1;
};
if (IsChecked('formcheck', '4')) {
  //do somthing ...
  $tracabilite = 1;
};


$recupere = $bdd->prepare("SELECT id_valeur_metier FROM valeur_metier WHERE nom_valeur_metier = ?");
$insere = $bdd->prepare('INSERT INTO `evenement_redoutes`(`id_evenement_redoutes`, `nom_evenement_redoutes`, `description_evenement_redoutes`, `confidentialite`, `integrite`, `disponibilite`, `tracabilite`, `impact`, `niveau_de_gravite`, `id_valeur_metier`, `id_atelier`) VALUES (?,?,?,?,?,?,?,?,?,?,?)');


/* // Verification du nom_valeur_metier
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_valeur_metier)) {
  $results["error"] = true;
  $results["message"]["nom_valeur_metier"] = "nom_valeur_metier invalide";
?>
  <strong style="color:#FF6565;">nom_valeur_metier invalide </br></strong>
<?php
} */

// Verification du nom_evenement_redoutes
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $nom_evenement_redoutes)) {
  $results["error"] = true;
  $results["message"]["nom_evenement_redoutes"] = "nom_evenement_redoutes invalide";
?>
  <strong style="color:#FF6565;">nom_evenement_redoutes invalide </br></strong>
<?php
}

// Verification du description_evenement_redoutes
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $description_evenement_redoutes)) {
  $results["error"] = true;
  $results["message"]["description_evenement_redoutes"] = "description_evenement_redoutes invalide";
?>
  <strong style="color:#FF6565;">description_evenement_redoutes invalide </br></strong>
<?php
}

// Verification du impact
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $impact)) {
  $results["error"] = true;
  $results["message"]["impact"] = "impact invalide";
?>
  <strong style="color:#FF6565;">impact invalide </br></strong>
<?php
}

/* // Verification du confidentialite
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $confidentialite)) {
  $results["error"] = true;
  $results["message"]["confidentialite"] = "confidentialite invalide";
?>
  <strong style="color:#FF6565;">confidentialite invalide </br></strong>
<?php
}
// Verification du integrite
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $integrite)) {
  $results["error"] = true;
  $results["message"]["integrite"] = "integrite invalide";
?>
  <strong style="color:#FF6565;">integrite invalide </br></strong>
<?php
}

// Verification du disponibilite
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $disponibilite)) {
  $results["error"] = true;
  $results["message"]["disponibilite"] = "disponibilite invalide";
?>
  <strong style="color:#FF6565;">disponibilite invalide </br></strong>
<?php
}

// Verification du tracabilite
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $tracabilite)) {
  $results["error"] = true;
  $results["message"]["tracabilite"] = "tracabilite invalide";
?>
  <strong style="color:#FF6565;">tracabilite invalide </br></strong>
<?php
}
// Verification du niveau_de_gravite
if (!preg_match("/^[a-zA-Zéèàêâùïüëç\s-]{1,100}$/", $niveau_de_gravite)) {
  $results["error"] = true;
  $results["message"]["niveau_de_gravite"] = "niveau_de_gravite invalide";
?>
  <strong style="color:#FF6565;">niveau_de_gravite invalide </br></strong>
<?php
} */

if ($results["error"] === false && isset($_POST['validerevenementredoute'])) {
  $recupere->bindParam(1, $nom_valeur_metier);
  $recupere->execute();
  $id_valeur_metier = $recupere->fetch();
  $insere->bindParam(1, $id_evenement_redoutes);
  $insere->bindParam(2, $nom_evenement_redoutes);
  $insere->bindParam(3, $description_evenement_redoutes);
  $insere->bindParam(4, $confidentialite);
  $insere->bindParam(5, $integrite);
  $insere->bindParam(6, $disponibilite);
  $insere->bindParam(7, $tracabilite);
  $insere->bindParam(8, $impact);
  $insere->bindParam(9, $niveau_de_gravite);
  $insere->bindParam(10, $id_valeur_metier[0]);
  $insere->bindParam(11, $id_atelier);
  $insere->execute();
?>
  <strong style="color:#4AD991;">La personne a bien été ajoutée !</br></strong>
<?php
}

?>