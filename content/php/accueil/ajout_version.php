<?php
session_start();
include("../bdd/connexion.php");

    $results["error"] = false;

    $id_projet=$_POST['id_projet'];
    $num_version=$_POST['num_version'];
    $version_description=$_POST['version_description'];
  
    // Verification du nom du groupe utilisateur
    if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $num_version)){
      $results["error"] = true;
      $_SESSION['message_error_5'] = "Numéro de version invalide";
    }

    if ($results["error"] === false) {
        // Verification du nom du groupe utilisateur
        if(!preg_match("/^[a-zA-Z0-9éèàêâùïüëçÀÂÉÈÊËÏÙÜ\s\-.:,'\"–]{0,100}$/", $version_description)){
            $results["error"] = true;
            $_SESSION['message_error_5'] = "Description de version invalide";
        }
    } 

    if ($results["error"] === false && isset($_POST['id_projet']) && isset($_POST['num_version']) && isset($_POST['version_description'])){
        // Récupérer l'id_projet_gen dont on veut faire une nouvelle version
        $query_projet_get = $bdd->prepare('SELECT id_projet_gen FROM F_projet WHERE id_projet=?');
        $query_projet_get->bindParam(1, $id_projet);
        $query_projet_get->execute();
        $projet_get_res = $query_projet_get->fetch(PDO::FETCH_ASSOC);

        // Récupérer la derniere version d'un projet - Trier le résultat pour avoir la version la pus récente d'abord
        $query_id_projet = $bdd->prepare('SELECT `id_projet` FROM `F_projet` WHERE `id_projet_gen`=? ORDER BY `id_projet` DESC');
        $query_id_projet->bindParam(1, $projet_get_res["id_projet_gen"]);
        $query_id_projet->execute();     
        $query_id_projet_res = $query_id_projet->fetch(PDO::FETCH_ASSOC);
        $id_projet=$query_id_projet_res["id_projet"];

        // Récupérer tous les champs du projet dont on veut faire une nouvelle version
        $query_projet_get = $bdd->prepare('SELECT * FROM F_projet WHERE id_projet=?');
        $query_projet_get->bindParam(1, $id_projet);
        $query_projet_get->execute();
        $projet_get_res = $query_projet_get->fetch(PDO::FETCH_ASSOC);

        // Créer une nouvelle version
        $query_new_version = $bdd->prepare('INSERT INTO `ZC_version` (`num_version`, `description_version`, `id_projet_gen`, `id_projet`) VALUES (?,?,?,?)');
        $query_new_version->bindParam(1, $num_version);
        $query_new_version->bindParam(2, $version_description);
        $query_new_version->bindParam(3, $projet_get_res["id_projet_gen"]);
        $query_new_version->bindParam(4, $id_projet);
        $query_new_version->execute();

        // Récupérer l'id de la nouvelle version - Trier le résultat pour avoir la version la plus récente d'abord
        $query_id_version = $bdd->prepare('SELECT `id_version` FROM `ZC_version` WHERE `id_projet_gen`=? ORDER BY `id_version` DESC');
        $query_id_version->bindParam(1, $projet_get_res["id_projet_gen"]);
        $query_id_version->execute();     
        $projet_get_id_version = $query_id_version->fetch(PDO::FETCH_ASSOC);

        // Créer un nouveau projet
        $query_projet_insert = $bdd->prepare('INSERT INTO `F_projet` (`nom_projet`, `description_projet`, `objectif_projet`, `responsable_risque_residuel`, `cadre_temporel`, `cadre_temporel_etape_2`, `cadre_temporel_etape_3`, `cadre_temporel_etape_4`, `cadre_temporel_etape_5`, `id_grp_utilisateur`, `id_utilisateur`, `id_echelle`, `confidentialite`, `duree_strategique`, `duree_operationnel`, `id_projet_gen`, `id_version`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $query_projet_insert->bindParam(1, $projet_get_res["nom_projet"]);
        $query_projet_insert->bindParam(2, $projet_get_res["description_projet"]);
        $query_projet_insert->bindParam(3, $projet_get_res["objectif_projet"]);
        $query_projet_insert->bindParam(4, $projet_get_res["responsable_risque_residuel"]);
        $query_projet_insert->bindParam(5, $projet_get_res["cadre_temporel"]);
        $query_projet_insert->bindParam(6, $projet_get_res["cadre_temporel_etape_2"]);
        $query_projet_insert->bindParam(7, $projet_get_res["cadre_temporel_etape_3"]);
        $query_projet_insert->bindParam(8, $projet_get_res["cadre_temporel_etape_4"]);
        $query_projet_insert->bindParam(9, $projet_get_res["cadre_temporel_etape_5"]);
        $query_projet_insert->bindParam(10, $projet_get_res["id_grp_utilisateur"]);
        $query_projet_insert->bindParam(11, $projet_get_res["id_utilisateur"]);
        $query_projet_insert->bindParam(12, $projet_get_res["id_echelle"]);
        $query_projet_insert->bindParam(13, $projet_get_res["confidentialite"]);
        $query_projet_insert->bindParam(14, $projet_get_res["duree_strategique"]);
        $query_projet_insert->bindParam(15, $projet_get_res["duree_operationnel"]);
        $query_projet_insert->bindParam(16, $projet_get_res["id_projet_gen"]);
        $query_projet_insert->bindParam(17, $projet_get_id_version["id_version"]);
        $query_projet_insert->execute();

        // Récupérer l'id du nouveau projet - Trier le résultat pour avoir la version la pus récente d'abord
        $query_new_id_projet = $bdd->prepare('SELECT `id_projet` FROM `F_projet` WHERE `id_projet_gen`=? ORDER BY `id_projet` DESC');
        $query_new_id_projet->bindParam(1, $projet_get_res["id_projet_gen"]);
        $query_new_id_projet->execute();     
        $projet_get_new_id = $query_new_id_projet->fetch(PDO::FETCH_ASSOC);

        // Mettre dans version l'id du nouveau projet
        $query_version_update = $bdd->prepare('UPDATE ZC_version SET id_projet = ?  WHERE id_version = ?');
        $query_version_update->bindParam(1, $projet_get_new_id["id_projet"]);
        $query_version_update->bindParam(2, $projet_get_id_version['id_version']); 
        $query_version_update->execute();

        // Mettre dans version l'id projet courant avec le nouvel id_projet
        $query_projet_update = $bdd->prepare('UPDATE ZD_projet_gen SET id_projet_desc_current = ?  WHERE id_projet_gen= ?');
        $query_projet_update->bindParam(1, $projet_get_new_id["id_projet"]);
        $query_projet_update->bindParam(2, $projet_get_res["id_projet_gen"]); 
        $query_projet_update->execute();

        // Copier H_RACI
        // 1 - Récupérer la table du RACI de
        $query_raci_get = $bdd->prepare('SELECT * FROM `H_RACI` WHERE `id_projet`=?');
        $query_raci_get->bindParam(1, $id_projet);
        $query_raci_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($raci_get_res = $query_raci_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_raci_insert = $bdd->prepare('INSERT INTO `H_RACI` (`id_projet`, `id_utilisateur`, `id_atelier`, `ecriture`) VALUES (?, ?, ?, ?)');
            $query_raci_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_raci_insert->bindParam(2, $raci_get_res["id_utilisateur"]);
            $query_raci_insert->bindParam(3, $raci_get_res["id_atelier"]);
            $query_raci_insert->bindParam(4, $raci_get_res["ecriture"]);
            $query_raci_insert->execute();
        }

     /*   // DA_Echelle
        // 1 - Récupérer la table des échelles
        $query_da_evaluer_get = $bdd->prepare('SELECT * FROM `DA_evaluer` WHERE `id_projet`=?');
        $query_da_evaluer_get->bindParam(1, $id_projet);
        $query_da_evaluer_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($da_evaluer_get_res = $query_da_evaluer_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_da_evaluer_insert = $bdd->prepare('INSERT INTO `DA_evaluer` (`id_projet`, `id_echelle`) VALUES (?, ?)');
            $query_da_evaluer_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_da_evaluer_insert->bindParam(2, $da_evaluer_get_res["id_echelle"]);
            $query_da_evaluer_insert->execute();
        }*/
        
        // DA_evaluer
        // 1 - Récupérer la table des échelles
        $query_da_evaluer_get = $bdd->prepare('SELECT * FROM `DA_evaluer` WHERE `id_projet`=?');
        $query_da_evaluer_get->bindParam(1, $id_projet);
        $query_da_evaluer_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($da_evaluer_get_res = $query_da_evaluer_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_da_evaluer_insert = $bdd->prepare('INSERT INTO `DA_evaluer` (`id_projet`, `id_echelle`) VALUES (?, ?)');
            $query_da_evaluer_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_da_evaluer_insert->bindParam(2, $da_evaluer_get_res["id_echelle"]);
            $query_da_evaluer_insert->execute();
        }
 
        // DB_bareme de risque
        // 1 - Récupérer la table 
        $query_db_bareme_risque_get = $bdd->prepare('SELECT * FROM `DB_bareme_risque` WHERE `id_projet`=?');
        $query_db_bareme_risque_get->bindParam(1, $id_projet);
        $query_db_bareme_risque_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($db_barem_risque_get_res = $query_db_bareme_risque_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_db_barem_risque_insert = $bdd->prepare('INSERT INTO `DB_bareme_risque` (`id_projet`, `vraisemblance `, `gravite`, `bareme`) VALUES (?, ?, ?)');
            $query_db_barem_risque_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_db_barem_risque_insert->bindParam(2, $db_barem_risque_get_res["vraisemblance"]);
            $query_db_barem_risque_insert->bindParam(3, $db_barem_risque_get_res["gravite"]);
            $query_db_barem_risque_insert->execute();
        }

        // I_mission
        // 1 - Récupérer la table
        $query_mission_get = $bdd->prepare('SELECT * FROM `I_mission` WHERE `id_projet`=?');
        $query_mission_get->bindParam(1, $id_projet);
        $query_mission_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        $mission_array = array();
        while($mission_get_res = $query_mission_get->fetch(PDO::FETCH_ASSOC))
        { 
            $query_mission_insert = $bdd->prepare('INSERT INTO `I_mission` (`nom_mission`, `description_mission`, `responsable`, `id_atelier`, `id_projet`) VALUES (?, ?, ?, ?, ?)');
            $query_mission_insert->bindParam(1, $mission_get_res["nom_mission"]);
            $query_mission_insert->bindParam(2, $mission_get_res["description_mission"]);
            $query_mission_insert->bindParam(3, $mission_get_res["responsable"]);
            $query_mission_insert->bindParam(4, $mission_get_res["id_atelier"]);
            $query_mission_insert->bindParam(5, $projet_get_new_id["id_projet"]);
            $query_mission_insert->execute();
            $id_mission_var = $mission_get_res["id_mission"];
            $mission_array[$id_mission_var] = $bdd->lastInsertId();
        }
        

        // J_valeur_metier
        // 1 - Récupérer la table
        $query_valeur_metier_get = $bdd->prepare('SELECT * FROM `J_valeur_metier` WHERE `id_projet`=?');
        $query_valeur_metier_get->bindParam(1, $id_projet);
        $query_valeur_metier_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        $vm_array = array();
        while($vm_get_res = $query_valeur_metier_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_valeur_metier_insert = $bdd->prepare('INSERT INTO `J_valeur_metier` (`id_projet`, `nom_valeur_metier`, `nature_valeur_metier`, `description_valeur_metier`, `id_atelier`) VALUES (?, ?, ?, ?, ?)');
            $query_valeur_metier_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_valeur_metier_insert->bindParam(2, $vm_get_res["nom_valeur_metier"]);
            $query_valeur_metier_insert->bindParam(3, $vm_get_res["nature_valeur_metier"]);
            $query_valeur_metier_insert->bindParam(4, $vm_get_res["description_valeur_metier"]);
            $query_valeur_metier_insert->bindParam(5, $vm_get_res["id_atelier"]);
            $query_valeur_metier_insert->execute();
            $id_vm = $vm_get_res['id_valeur_metier'];
            $vm_array[$id_vm] = $bdd->lastInsertId();
        }
        // K_bien_support
        // 1 - Récupérer la table
        $query_bien_support_get = $bdd->prepare('SELECT * FROM `K_bien_support` WHERE `id_projet`=?');
        $query_bien_support_get->bindParam(1, $id_projet);
        $query_bien_support_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        $bs_array = array();
        while($bs_get_res = $query_bien_support_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_bien_support_insert = $bdd->prepare('INSERT INTO `K_bien_support` (`id_projet`, `nom_bien_support`, `description_bien_support`, `id_atelier`) VALUES (?, ?, ?, ?)');
            $query_bien_support_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_bien_support_insert->bindParam(2, $bs_get_res["nom_bien_support"]);
            $query_bien_support_insert->bindParam(3, $bs_get_res["description_bien_support"]);
            $query_bien_support_insert->bindParam(4, $bs_get_res["id_atelier"]);
            $query_bien_support_insert->execute();
            $id_bs = $bs_get_res['id_bien_support'];
            $bs_array[$id_bs] = $bdd->lastInsertId();
        }

        // L_couple_VMBS
        // 1 - Récupérer la table des échelles
        $query_vmbs_get = $bdd->prepare('SELECT * FROM `L_couple_VMBS` WHERE `id_projet`=?');
        $query_vmbs_get->bindParam(1, $id_projet);
        $query_vmbs_get->execute();

        // 2 - Créer la copie en changeant le numéro de projet
        // Gestion des clés étrangères
        while($vmbs_get_res = $query_vmbs_get->fetch(PDO::FETCH_ASSOC))
        {
            // Récuéprer les anciens index
            $old_id_vm = $vmbs_get_res["id_valeur_metier"];
            $old_id_bs = $vmbs_get_res["id_bien_support"];
            $old_id_mission = $vmbs_get_res["id_mission"];
            // utilsier les tables de translation pour créer les nouveaux index.
            $new_id_vm = $vm_array[$old_id_vm];
            $new_id_bs =$bs_array[$old_id_bs];
            $new_id_mission = $mission_array[$old_id_mission];
            $query_vmbs_insert = $bdd->prepare('INSERT INTO `L_couple_VMBS` (`id_projet`, `id_valeur_metier`, `id_bien_support`, `id_mission`, `nom_responsable_vm`, `nom_responsable_bs`) VALUES (?, ?, ?, ?, ?, ?)');
            $query_vmbs_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_vmbs_insert->bindParam(2, $new_id_vm);
            $query_vmbs_insert->bindParam(3, $new_id_bs);
            $query_vmbs_insert->bindParam(4, $new_id_mission);
            $query_vmbs_insert->bindParam(5, $vmbs_get_res["nom_responsable_vm"]);
            $query_vmbs_insert->bindParam(6, $vmbs_get_res["nom_responsable_bs"]);
            $query_vmbs_insert->execute();
            //$_SESSION['message_success_5'] = " ID projet : ".$projet_get_new_id["id_projet"]."- Id vm : ".$old_id_vm."- Id bs : ".$old_id_bs."- Id mission : ".$old_id_mission."- Id vm : ".$new_id_vm."- Id bs : ".$new_id_bs."- Id mission : ".$new_id_mission." -";

        }

        // M_evenement_redoute
        // 1 - Récupérer la table
        $query_er_get = $bdd->prepare('SELECT * FROM `M_evenement_redoute` WHERE `id_projet`=?');
        $query_er_get->bindParam(1, $id_projet);
        $query_er_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        // TODO - Corriger le problème sur valeur métier
        while($evt_red_get_res = $query_er_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_er_insert = $bdd->prepare('INSERT INTO `M_evenement_redoute` (`id_projet`, `nom_evenement_redoute`, `description_evenement_redoute`, `confidentialite`, `integrite`, `disponibilite `, `tracabilite`, `impact `, `niveau_de_gravite`, `id_valeur_metier`,`id_atelier`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $query_er_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_er_insert->bindParam(2, $evt_red_get_res["nom_evenement_redoute"]);
            $query_er_insert->bindParam(3, $evt_red_get_res["description_evenement_redoute"]);
            $query_er_insert->bindParam(4, $evt_red_get_res["confidentialite"]);
            $query_er_insert->bindParam(5, $evt_red_get_res["integrite"]);
            $query_er_insert->bindParam(6, $evt_red_get_res["disponibilite"]);
            $query_er_insert->bindParam(7, $evt_red_get_res["tracabilite"]);
            $query_er_insert->bindParam(8, $evt_red_get_res["impact"]);
            $query_er_insert->bindParam(9, $evt_red_get_res["niveau_de_gravite"]);
            $query_er_insert->bindParam(10, $evt_red_get_res["id_valeur_metier"]); // TODO - A corriger - clé étrangère
            $query_er_insert->bindParam(11, $evt_red_get_res["id_atelier"]);
            $query_er_insert->execute();
        }

        // N_socle_de_securite
        // 1 - Récupérer la table
        $query_socle_get = $bdd->prepare('SELECT * FROM `N_socle_de_securite` WHERE `id_projet`=?');
        $query_socle_get->bindParam(1, $id_projet);
        $query_socle_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        // TODO - Corriger le problème sur valeur métier
        while($socle_get_res = $query_socle_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_socle_insert = $bdd->prepare('INSERT INTO `N_socle_de_securite` (`id_projet`, `type_referentiel`, `nom_referentiel`, `etat_d_application`, `etat_de_la_conformite`, `id_atelier`) VALUES (?, ?, ?, ?, ?, ?)');
            $query_socle_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_socle_insert->bindParam(2, $socle_get_res["type_referentiel"]);
            $query_socle_insert->bindParam(3, $socle_get_res["nom_referentiel"]);
            $query_socle_insert->bindParam(4, $socle_get_res["etat_d_application"]);
            $query_socle_insert->bindParam(5, $socle_get_res["etat_de_la_conformite"]);
            $query_socle_insert->bindParam(6, $socle_get_res["id_atelier"]);
            $query_socle_insert->execute();
        }

        // O_regle
        // 1 - Récupérer la table
        $query_regle_get = $bdd->prepare('SELECT * FROM `O_regle` WHERE `id_projet`=?');
        $query_regle_get->bindParam(1, $id_projet);
        $query_regle_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        // TODO - Corriger le problème sur id_socle - clé étrangère
        while($regle_get_res = $query_regle_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_regle_insert = $bdd->prepare('INSERT INTO `O_regle` (`id_projet`, `id_regle_affichage`, `titre`, `description`, `etat_de_la_regle`, `justification_ecart`, `dates`, `responsable`, `id_socle_securite`, `id_atelier`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $query_regle_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_regle_insert->bindParam(2, $regle_get_res["id_regle_affichage"]);
            $query_regle_insert->bindParam(3, $regle_get_res["titre"]);
            $query_regle_insert->bindParam(4, $regle_get_res["description"]);
            $query_regle_insert->bindParam(5, $regle_get_res["etat_de_la_regle"]);
            $query_regle_insert->bindParam(6, $regle_get_res["justification_ecart"]);
            $query_regle_insert->bindParam(7, $regle_get_res["dates"]);
            $query_regle_insert->bindParam(8, $regle_get_res["responsable"]);
            $query_regle_insert->bindParam(9, $regle_get_res["id_socle_securite"]); // TODO - Gérer clé étrangere
            $query_regle_insert->bindParam(10, $regle_get_res["id_atelier"]);
            $query_regle_insert->execute();
        }
        // P_SROV
        // 1 - Récupérer la table
        $query_srov_get = $bdd->prepare('SELECT * FROM `P_SROV` WHERE `id_projet`=?');
        $query_srov_get->bindParam(1, $id_projet);
        $query_srov_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($srov_get_res = $query_srov_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_srov_insert = $bdd->prepare('INSERT INTO `P_SROV` (`id_projet`, `type_d_attaquant_source_de_risque`, `profil_de_l_attaquant_source_de_risque`, `description_source_de_risque`, `objectif_vise`, `description_objectif_vise`, `motivation`, `ressources`, `activite`,`mode_operatoire`, `secteur_d_activite`, `arsenal_d_attaque`,`faits_d_armes`, `pertinence`, `choix_source_de_risque`, `id_atelier`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $query_srov_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_srov_insert->bindParam(2, $srov_get_res["type_d_attaquant_source_de_risque"]);
            $query_srov_insert->bindParam(3, $srov_get_res["profil_de_l_attaquant_source_de_risque"]);
            $query_srov_insert->bindParam(4, $srov_get_res["description_source_de_risque"]);
            $query_srov_insert->bindParam(5, $srov_get_res["objectif_vise"]);
            $query_srov_insert->bindParam(6, $srov_get_res["description_objectif_vise"]);
            $query_srov_insert->bindParam(7, $srov_get_res["motivation"]);
            $query_srov_insert->bindParam(8, $srov_get_res["ressources"]);
            $query_srov_insert->bindParam(9, $srov_get_res["activite"]);
            $query_srov_insert->bindParam(10, $srov_get_res["mode_operatoire"]);
            $query_srov_insert->bindParam(11, $srov_get_res["secteur_d_activite"]);
            $query_srov_insert->bindParam(12, $srov_get_res["arsenal_d_attaque"]);
            $query_srov_insert->bindParam(13, $srov_get_res["faits_d_armes"]);
            $query_srov_insert->bindParam(14, $srov_get_res["pertinence"]);
            $query_srov_insert->bindParam(15, $srov_get_res["choix_source_de_risque"]);
            $query_srov_insert->bindParam(16, $srov_get_res["id_atelier"]);
            $query_srov_insert->execute();
        }

        // Q_seuil
        // 1 - Récupérer la table
        $query_seuil_get = $bdd->prepare('SELECT * FROM `Q_seuil` WHERE `id_projet`=?');
        $query_seuil_get->bindParam(1, $id_projet);
        $query_seuil_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($seuil_get_res = $query_seuil_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_seuil_insert = $bdd->prepare('INSERT INTO `Q_seuil` (`id_projet`, `seuil_danger`, `seuil_controle`, `seuil_veille`, `id_atelier`) VALUES (?, ?, ?, ?, ?)');
            $query_seuil_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_seuil_insert->bindParam(2, $seuil_get_res["seuil_danger"]);
            $query_seuil_insert->bindParam(3, $seuil_get_res["seuil_controle"]);
            $query_seuil_insert->bindParam(4, $seuil_get_res["seuil_veille"]);
            $query_seuil_insert->bindParam(5, $seuil_get_res["id_atelier"]);
            $query_seuil_insert->execute();
        }

        // R_partie_prenante
        // 1 - Récupérer la table
        $query_pp_get = $bdd->prepare('SELECT * FROM `R_partie_prenante` WHERE `id_projet`=?');
        $query_pp_get->bindParam(1, $id_projet);
        $query_pp_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($pp_get_res = $query_pp_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_pp_insert = $bdd->prepare('INSERT INTO `R_partie_prenante` (`id_projet`, `categorie_partie_prenante`, `nom_partie_prenante`, `type`, `dependance_partie_prenante`, `penetration_partie_prenante`, `maturite_partie_prenante`, `confiance_partie_prenante`, `niveau_de_menace_partie_prenante`,`ponderation_dependance`, `ponderation_penetration`, `ponderation_maturite`,`ponderation_confiance`, `dependance_residuelle`, `penetration_residuelle`, `maturite_residuelle, `confiance_residuelle, `niveau_de_menace_residuelle, `id_seuil`, `criticite, `id_atelier`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $query_pp_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_pp_insert->bindParam(2, $pp_get_res["categorie_partie_prenante"]);
            $query_pp_insert->bindParam(3, $pp_get_res["nom_partie_prenante"]);
            $query_pp_insert->bindParam(4, $pp_get_res["type"]);
            $query_pp_insert->bindParam(5, $pp_get_res["dependance_partie_prenante"]);
            $query_pp_insert->bindParam(6, $pp_get_res["penetration_partie_prenante"]);
            $query_pp_insert->bindParam(7, $pp_get_res["maturite_partie_prenante"]);
            $query_pp_insert->bindParam(8, $pp_get_res["confiance_partie_prenante"]);
            $query_pp_insert->bindParam(9, $pp_get_res["niveau_de_menace_partie_prenante"]);
            $query_pp_insert->bindParam(10, $pp_get_res["ponderation_dependance"]);
            $query_pp_insert->bindParam(11, $pp_get_res["ponderation_penetration"]);
            $query_pp_insert->bindParam(12, $pp_get_res["ponderation_maturite"]);
            $query_pp_insert->bindParam(13, $pp_get_res["ponderation_confiance"]);
            $query_pp_insert->bindParam(14, $pp_get_res["dependance_residuelle"]);
            $query_pp_insert->bindParam(15, $pp_get_res["penetration_residuelle"]);
            $query_pp_insert->bindParam(16, $pp_get_res["maturite_residuelle"]);
            $query_pp_insert->bindParam(17, $pp_get_res["confiance_residuelle"]);
            $query_pp_insert->bindParam(18, $pp_get_res["niveau_de_menace_residuelle"]);
            $query_pp_insert->bindParam(19, $pp_get_res["id_seuil"]);
            $query_pp_insert->bindParam(20, $pp_get_res["criticite"]);
            $query_pp_insert->bindParam(21, $pp_get_res["id_atelier"]);
            $query_pp_insert->execute();
        }
        // S_scenario_strategique
        // TODO - Gérer les clés étrangères id_source_de_risque et id_evenement_redoute
        // 1 - Récupérer la table
        $query_sce_strat_get = $bdd->prepare('SELECT * FROM `S_scenario_strategique` WHERE `id_projet`=?');
        $query_sce_strat_get->bindParam(1, $id_projet);
        $query_sce_strat_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($sce_strat_get_res = $query_sce_strat_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_sce_strat_insert = $bdd->prepare('INSERT INTO `S_scenario_strategique` (`id_projet`, `nom_scenario_strategique`, `id_atelier`, `id_source_de_risque`, `id_evenement_redoute`) VALUES (?, ?, ?, ?, ?)');
            $query_sce_strat_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_sce_strat_insert->bindParam(2, $sce_strat_get_res["nom_scenario_strategique"]);
            $query_sce_strat_insert->bindParam(3, $sce_strat_get_res["id_atelier"]);
            $query_sce_strat_insert->bindParam(4, $sce_strat_get_res["id_source_de_risque"]); // TODO
            $query_sce_strat_insert->bindParam(5, $sce_strat_get_res["id_evenement_redoute"]); // TODO
            $query_sce_strat_insert->execute();
        }
        // T_chemin_d_attaque_strategique
        // TODO - Gérer les clés étrangères id_scenario_strategique et id_partie_prenante
        // TODO - Traiter le probléme de id_risque
        // 1 - Récupérer la table
        $query_che_attaque_get = $bdd->prepare('SELECT * FROM `T_chemin_d_attaque_strategique` WHERE `id_projet`=?');
        $query_che_attaque_get->bindParam(1, $id_projet);
        $query_che_attaque_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($che_attaque_res = $query_che_attaque_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_che_attaque_insert = $bdd->prepare('INSERT INTO `T_chemin_d_attaque_strategique` (`id_projet`, `nom_chemin_d_attaque_strategique`, `description_chemin_d_attaque_strategique`, `id_scenario_strategique`, `id_scenario_strategique`, `id_partie_prenante`) VALUES (?, ?, ?, ?, ?, ?)');
            $query_che_attaque_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_che_attaque_insert->bindParam(2, $che_attaque_res["nom_chemin_d_attaque_strategique"]);
            $query_che_attaque_insert->bindParam(3, $che_attaque_res["description_chemin_d_attaque_strategique"]);
            $query_che_attaque_insert->bindParam(4, $che_attaque_res["id_scenario_strategique"]); // TODO
            $query_che_attaque_insert->bindParam(5, $che_attaque_res["id_partie_prenante"]); // TODO
            $query_che_attaque_insert->bindParam(6, $che_attaque_res["id_atelier"]);
            $query_che_attaque_insert->execute();
        }
        // U_scenario_operationnel
        // TODO - Gérer les clés étrangères id_chemin_d_attaque_strategique et id_risque et id_evenement_redoute
        // 1 - Récupérer la table
        $query_sce_ope_get = $bdd->prepare('SELECT * FROM `U_scenario_operationnel` WHERE `id_projet`=?');
        $query_sce_ope_get->bindParam(1, $id_projet);
        $query_sce_ope_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($sce_op_res = $query_sce_ope_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_sce_op_insert = $bdd->prepare('INSERT INTO `U_scenario_operationnel` (`id_projet`, `nom_scenario_operationnel`, `description_scenario_operationnel`, `vraisemblance`, `image`, `id_chemin_d_attaque_strategique`, `id_risque`, `id_evenement_redoute`, `id_partie_prenante`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $query_sce_op_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_sce_op_insert->bindParam(2, $sce_op_res["nom_scenario_operationnel"]);
            $query_sce_op_insert->bindParam(3, $sce_op_res["description_scenario_operationnel"]);
            $query_sce_op_insert->bindParam(4, $sce_op_res["vraisemblance"]); 
            $query_sce_op_insert->bindParam(5, $sce_op_res["image"]); 
            $query_sce_op_insert->bindParam(6, $sce_op_res["id_chemin_d_attaque_strategique"]); // TODO
            $query_sce_op_insert->bindParam(7, $sce_op_res["id_risque"]); // TODO
            $query_sce_op_insert->bindParam(8, $sce_op_res["id_evenement_redoute"]);// TODO
            $query_sce_op_insert->bindParam(9, $sce_op_res["id_atelier"]);
            $query_sce_op_insert->execute();
        }
        // W_mode_operatoire
        // TODO - Gérer les clés étrangères id_scenario_operationnel
        // 1 - Récupérer la table
        $query_mode_ope_get = $bdd->prepare('SELECT * FROM `W_mode_operatoire` WHERE `id_projet`=?');
        $query_mode_ope_get->bindParam(1, $id_projet);
        $query_mode_ope_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($mode_op_res = $query_mode_ope_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_mode_op_insert = $bdd->prepare('INSERT INTO `W_mode_operatoire` (`id_projet`, `mode_operatoire`, `id_scenario_operationnel`) VALUES (?, ?, ?)');
            $query_mode_op_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_mode_op_insert->bindParam(2, $mode_op_res["mode_operatoire"]);
            $query_mode_op_insert->bindParam(3, $mode_op_res["id_scenario_operationnel"]); // TODO
            $query_mode_op_insert->execute();
        }
        // X_revaluation_du_risque
        // TODO - Gérer les clés étrangères id_risque et id_chemin_d_attaque_strategique et id_evenement_redoute
        // 1 - Récupérer la table
        $query_re_risk_get = $bdd->prepare('SELECT * FROM `X_revaluation_du_risque` WHERE `id_projet`=?');
        $query_re_risk_get->bindParam(1, $id_projet);
        $query_re_risk_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($re_risk_res = $query_re_risk_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_re_risk_insert = $bdd->prepare('INSERT INTO `X_revaluation_du_risque` (`id_projet`, `nom_risque_residuelle`, `description_risque_residuelle`, `vraisemblance_residuelle`, `risque_residuel`, `gestion_risque_residuelle`, `id_chemin_d_attaque_strategique`, `id_risque`, `id_atelier`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $query_re_risk_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_re_risk_insert->bindParam(2, $re_risk_res["nom_risque_residuelle"]);
            $query_re_risk_insert->bindParam(3, $re_risk_res["description_risque_residuelle"]);
            $query_re_risk_insert->bindParam(4, $re_risk_res["vraisemblance_residuelle"]); 
            $query_re_risk_insert->bindParam(5, $re_risk_res["risque_residuel"]); 
            $query_re_risk_insert->bindParam(6, $re_risk_res["gestion_risque_residuelle"]); 
            $query_re_risk_insert->bindParam(7, $re_risk_res["id_chemin_d_attaque_strategique"]); // TODO
            $query_re_risk_insert->bindParam(8, $re_risk_res["id_risque"]);// TODO
            $query_re_risk_insert->bindParam(9, $re_risk_res["id_atelier"]);
            $query_re_risk_insert->execute();
        }
        // Y_mesure
        // 1 - Récupérer la table
        $query_mesure_get = $bdd->prepare('SELECT * FROM `Y_mesure` WHERE `id_projet`=?');
        $query_mesure_get->bindParam(1, $id_projet);
        $query_mesure_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($mesure_res = $query_mesure_get->fetch(PDO::FETCH_ASSOC))
        {
            $mesure_insert = $bdd->prepare('INSERT INTO `Y_mesure` (`id_projet`, `nom_mesure`, `description_mesure`, `id_atelier`) VALUES (?, ?, ?, ?)');
            $mesure_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $mesure_insert->bindParam(2, $mesure_res["nom_mesure"]);
            $mesure_insert->bindParam(3, $mesure_res["description_mesure"]);
            $mesure_insert->bindParam(4, $mesure_res["id_atelier"]); 
            $mesure_insert->execute();
        }
        // ZA_traitement de securite
        // TODO - Gérer les clés étrangères id_mesure
        // 1 - Récupérer la table
        $query_trait_risk_get = $bdd->prepare('SELECT * FROM `ZA_traitement_de_securite` WHERE `id_projet`=?');
        $query_trait_risk_get->bindParam(1, $id_projet);
        $query_trait_risk_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($trait_risk_res = $query_trait_risk_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_trait_risk_insert = $bdd->prepare('INSERT INTO `ZA_traitement_de_securite` (`id_projet`, `principe_de_securite`, `difficulte_traitement_de_securite`, `cout_traitement_de_securite`, `date_traitement_de_securite`, `responsable`, `statut`, `id_mesure`, `id_atelier`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $query_trait_risk_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_trait_risk_insert->bindParam(2, $trait_risk_res["principe_de_securite"]);
            $query_trait_risk_insert->bindParam(3, $trait_risk_res["difficulte_traitement_de_securite"]);
            $query_trait_risk_insert->bindParam(4, $trait_risk_res["cout_traitement_de_securite"]); 
            $query_trait_risk_insert->bindParam(5, $trait_risk_res["date_traitement_de_securite"]); 
            $query_trait_risk_insert->bindParam(6, $trait_risk_res["responsable"]); 
            $query_trait_risk_insert->bindParam(7, $trait_risk_res["statut"]); 
            $query_trait_risk_insert->bindParam(8, $trait_risk_res["id_mesure"]);// TODO
            $query_trait_risk_insert->bindParam(9, $trait_risk_res["id_atelier"]);
            $query_trait_risk_insert->execute();
        }
        // ZB_comporter_2
        // TODO - Gérer les clés étrangères id_scenario_operationnel
        // 1 - Récupérer la table
        $query_comporter2_get = $bdd->prepare('SELECT * FROM `W_mode_operatoire` WHERE `id_projet`=?');
        $query_comporter2_get->bindParam(1, $id_projet);
        $query_comporter2_get->execute();
        
        // 2 - Créer la copie en changeant le numéro de projet
        while($comporter2_res = $query_comporter2_get->fetch(PDO::FETCH_ASSOC))
        {
            $query_comporter2_insert = $bdd->prepare('INSERT INTO `W_mode_operatoire` (`id_projet`, `id_risque`, `id_scenario_operationnel`) VALUES (?, ?, ?)');
            $query_comporter2_insert->bindParam(1, $projet_get_new_id["id_projet"]);
            $query_comporter2_insert->bindParam(2, $comporter2_res["id_risque"]);
            $query_comporter2_insert->bindParam(3, $comporter2_res["id_scenario_operationnel"]); // TODO
            $query_comporter2_insert->execute();
        }

        if(isset($_POST['id_projet'])){
            /* $id_projet = $_POST['id_projet'];
             $id_projet_gen_query = $bdd->prepare("SELECT id_projet_gen FROM F_projet WHERE id_projet = ?");
             $id_projet_gen_query->bindParam(1, $id_projet);
             $id_projet_gen_query->execute();
             $id_projet_gen = $id_projet_gen_query->fetch();
             $query->bindParam(1, $id_projet_gen[0]);
             $query->execute();
             
             while($row = $query->fetch(PDO::FETCH_ASSOC))
             {
             echo '
             <tr>
             <td>'.$row["id_version"].'</td>
             <td>'.$row["num_version"].'</td>
             <td>'.$row["description_version"].'</td>
             </tr>
             ';
             }*/
         }
 
        /*
        $inseregrpuser = $bdd->prepare('INSERT INTO `B_grp_utilisateur`(`nom_grp_utilisateur`) VALUES (?)');
        $inseregrpuser->bindParam(1, $nom_grp_user);
        $inseregrpuser->execute();*/
        $_SESSION['message_success_5'] = $_SESSION['message_success_5']."La version a bien été ajoutée !"."-".$id_projet."-".$num_version."-".$version_description;
    }
    //$_SESSION['message_success_5'] = "La version a bien été ajoutée !"."-".$_POST['id_projet']."-".$_POST['num_version']."-".$version_description;
 
    //header('Location: ../../../index&'.$_SESSION['id_utilisateur']);
?>