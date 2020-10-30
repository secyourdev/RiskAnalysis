<?php
$getid_utilisateur = $_SESSION['id_utilisateur'];

// Récupérer les droits de l'utilisateur
$requser = $bdd->prepare('SELECT * FROM A_utilisateur WHERE id_utilisateur = ?');
$requser->execute(array($getid_utilisateur));
$userinfo = $requser->fetch();


// Liste des projets dont l'utilisateur est chef de projet
if($userinfo['type_compte']=='Administrateur Logiciel') {
    $search_projet = $bdd->prepare("SELECT F_projet.id_projet, F_projet.nom_projet, F_projet.id_projet_gen FROM F_projet INNER JOIN ZD_projet_gen ON F_projet.id_projet = ZD_projet_gen.id_projet_desc_current ORDER BY ZD_projet_gen.id_projet_gen ASC");
    $search_projet->execute();
}
// Si pas utilisateur admin alors chercher la liste des projet où l'utilisateur est chef de projet
else {
    $search_projet = $bdd->prepare("SELECT F_projet.id_projet, F_projet.nom_projet, F_projet.id_projet_gen FROM F_projet INNER JOIN ZD_projet_gen ON F_projet.id_projet = ZD_projet_gen.id_projet_desc_current WHERE F_projet.id_utilisateur=? ORDER BY ZD_projet_gen.id_projet_gen ASC");
    $search_projet->bindParam(1, $getid_utilisateur);
    $search_projet->execute();
}
?>


