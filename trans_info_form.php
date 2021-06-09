<?php
    session_start();
    $id_projet = $_SESSION['id_projet'];
    include("content/php/bdd/connexion_sqli.php");
    include("content/php/bdd/connexion.php");
    
    $serveur = "localhost";
    $dbname = "bdd";
    $user = "root";
    $pass = "";

    $titre_rapport = $_POST["titre_rapport"];
    $nom_societe = $_POST["nom_societe"];
    $adresse_societe = $_POST["adresse_societe"];
    $tel_societe = $_POST["tel_societe"];
    $reph_doc = $_POST["reph_doc"];
    $upload_pic = $_POST["upload_pic"];
    $site_societe = $_POST["site_societe"];

    try{
        //On se connecte à la BDD
        
    
        //On insère les données reçues
        if(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM info_form WHERE id_projet=$id_projet")) == 0){    
            $sth = $bdd->prepare("
                INSERT INTO info_form(nom_soci, nom_doc, num_soci, adresse_soci, site_soci, reph_doc, logo_soci, id_projet)
                VALUES(:nom_soci, :nom_doc, :num_soci, :adresse_soci, :site_soci, :reph_doc, :logo_soci, :id_projet)");
            $sth->bindParam(':nom_soci',$nom_societe);
            $sth->bindParam(':nom_doc',$titre_rapport);
            $sth->bindParam(':num_soci',$tel_societe);
            $sth->bindParam(':adresse_soci',$adresse_societe);
            $sth->bindParam(':site_soci',$site_societe);
            $sth->bindParam(':reph_doc',$reph_doc);
            $sth->bindParam(':logo_soci',$upload_pic);
            $sth->bindParam(':id_projet',$id_projet);
            $sth->execute();
            echo "je te creé";
        }
        else{
            $sth = $bdd->prepare("UPDATE info_form SET nom_soci =  ?,
                                                        nom_doc = ?,
                                                        num_soci = ?,
                                                        adresse_soci = ?,
                                                        site_soci = ?,
                                                        reph_doc = ?,
                                                        logo_soci = ?
                                                    WHERE id_projet = ?");
            $sth->bindParam(1,$nom_societe);
            $sth->bindParam(2,$titre_rapport);
            $sth->bindParam(3,$tel_societe);
            $sth->bindParam(4,$adresse_societe);
            $sth->bindParam(5,$site_societe);
            $sth->bindParam(6,$reph_doc);
            $sth->bindParam(7,$upload_pic);
            $sth->bindParam(8,$id_projet);
            $sth->execute();
            echo "je te remplace";
        }
        echo "je passe tout le temps";
        
        //On renvoie l'utilisateur vers la page de remerciement
        // echo "JAAAAAAAAAAAAAAAAAAAAAAJ !";

    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
    

?>