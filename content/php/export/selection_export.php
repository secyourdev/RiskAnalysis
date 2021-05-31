<?php
include("content/php/bdd/connexion_sqli.php");
$getid_projet = $_SESSION['id_projet'];

//Requêtes relatives à la génération de rapport

$rq_acteurs = "SELECT DISTINCT nom AS 'Nom',prenom AS 'Prénom',poste AS 'Poste' FROM `H_RACI` NATURAL JOIN A_utilisateur WHERE id_projet =$getid_projet ORDER BY id_utilisateur ASC";
$rq_tab_acteurs = mysqli_query($connect, $rq_acteurs);

//******************************RACI***************************************/

$rq_first = "SELECT DISTINCT CONCAT(A_utilisateur.nom,' ', A_utilisateur.prenom) FROM A_utilisateur, H_RACI WHERE H_RACI.id_utilisateur = A_utilisateur.id_utilisateur AND H_RACI.id_projet= $getid_projet";
//"SELECT DISTINCT CONCAT(A_utilisateur.nom,' ', A_utilisateur.prenom) FROM A_utilisateur, H_raci WHERE H_raci.id_utilisateur = A_utilisateur.id_utilisateur AND H_raci.id_projet= $getid_projet";

$rq_first_tab  = mysqli_query($connect, $rq_first);


$rq_raci = "SELECT id_atelier,nom, ecriture FROM H_RACI, A_utilisateur WHERE H_RACI.id_utilisateur = A_utilisateur.id_utilisateur AND id_projet = $getid_projet ORDER BY A_utilisateur.id_utilisateur";

/*"SELECT id_atelier,nom, ecriture FROM H_RACI, A_utilisateur WHERE H_RACI.id_utilisateur = A_utilisateur.id_utilisateur AND id_projet =$getid_projet";/* ORDER BY  H_RACI.id_atelier,A_utilisateur.id_utilisateur";*/
$rq_raci_tab = mysqli_query($connect,$rq_raci);

$rq_atelier_raci = "SELECT  DISTINCT/* H_RACI.id_atelier*/CONCAT(H_RACI.id_atelier,' ',nom_atelier) FROM H_RACI, G_atelier WHERE H_RACI.id_atelier = G_atelier.id_atelier AND id_projet = $getid_projet";
$rq_atelier_raci_tab = mysqli_query($connect, $rq_atelier_raci);

//*************************1.a Données Principales////////////////////////////
$rq_donnees_principales = "SELECT *,num_version FROM F_projet NATURAL JOIN ZC_version WHERE id_projet = $getid_projet";
$rq_donnees_principales_res = mysqli_query($connect, $rq_donnees_principales);

$rq_respo ="SELECT CONCAT(A_utilisateur.nom,' ',A_utilisateur.prenom) FROM F_projet INNER JOIN A_utilisateur ON F_projet.responsable_risque_residuel = A_utilisateur.id_utilisateur WHERE id_projet=$getid_projet";
$rq_respo_res = mysqli_query($connect, $rq_respo);


////////////////////////////////////////////////////////////////////////////////
//requetes atelier 1.b
$rq_vm = "SELECT nom_valeur_metier AS 'Valeur Métier', nature_valeur_metier AS 'Nature', description_valeur_metier AS 'Description' FROM J_valeur_metier WHERE id_projet=$getid_projet";
$rq_vm_tab = mysqli_query($connect, $rq_vm);

$rq_biens = "SELECT nom_bien_support AS 'Bien support', description_bien_support AS 'Description' FROM K_bien_support WHERE id_projet=$getid_projet";
$rq_biens_tab =  mysqli_query($connect, $rq_biens);

$rq_mission = "SELECT nom_mission AS 'Nom de la mission', description_mission AS 'Description de la mission', responsable AS 'Responsable', nom_valeur_metier AS 'Valeur Métier', nom_responsable_vm AS 'Responsable de la valeur métier', nom_bien_support AS 'Bien Support', nom_responsable_bs AS 'Responsable du bien support' FROM I_mission NATURAL JOIN J_valeur_metier NATURAL JOIN K_bien_support NATURAL JOIN L_couple_VMBS WHERE id_projet=$getid_projet";
$rq_mission_tab = mysqli_query($connect, $rq_mission);

////////////////////////////////////////////////////////////////////////////////
//requetes atelier 1.c
$rq_echelle ="SELECT nom_echelle AS 'Nom de l''échelle' , echelle_gravite AS 'Échelle de gravité' FROM DA_echelle WHERE id_projet = $getid_projet";
$rq_echelle_tab = mysqli_query($connect, $rq_echelle);

$rq_niveau = "SELECT valeur_niveau AS 'Valeur du niveau', description_niveau AS 'Description du niveau' FROM DA_niveau WHERE id_projet = $getid_projet";
$rq_niveau_tab = mysqli_query($connect, $rq_niveau);

$rq_evred = "SELECT nom_valeur_metier AS 'Valeur métier', nom_evenement_redoute AS 'Nom de l''événement redouté', description_evenement_redoute AS 'Description de l''événement redouté', impact AS 'Impacts', confidentialite AS 'Confidentialité', integrite AS 'Intégrité',disponibilite AS 'Disponibilité', tracabilite AS 'Traçabilité', niveau_de_gravite AS 'Gravité' FROM M_evenement_redoute INNER JOIN J_valeur_metier on M_evenement_redoute.id_valeur_metier = J_valeur_metier.id_valeur_metier WHERE M_evenement_redoute.id_projet = $getid_projet";
$rq_evred_tab = mysqli_query($connect, $rq_evred);

////////////////////////////////////////////////////////////////////////////////
//requetes atelier 1.d
$rq_socle_sec = "SELECT type_referentiel AS 'Type de référentiel', nom_referentiel AS 'Nom du référentiel', etat_d_application AS 'État d''application', etat_de_la_conformite AS 'Commentaire'  FROM N_socle_de_securite WHERE id_projet = $getid_projet AND id_atelier ='1.d'";
$rq_socle_sec_tab = mysqli_query($connect, $rq_socle_sec);

$rq_regle0 = "SELECT id_regle_affichage AS 'ID de la règle', titre AS 'Titre de la règle', description AS 'Description de la règle', etat_de_la_regle AS 'État de la règle', justification_ecart AS 'Justification des écarts', responsable AS 'Responsable', dates AS 'Date limite de la mise en application' FROM O_regle WHERE id_projet = $getid_projet";

$rq_regle_tab = mysqli_query($connect, $rq_regle0);

////////////////////////////////////////////////////////////////////////////////
//requetes atelier 2.a
$rq_srov = "SELECT type_d_attaquant_source_de_risque AS 'Type d''ttaquant', profil_de_l_attaquant_source_de_risque AS 'Profil d''attaquant', description_source_de_risque AS 'Description source de risque', objectif_vise AS 'Objectif visé',description_objectif_vise AS 'Description de l''objectif' FROM P_SROV WHERE id_projet=$getid_projet";
$rq_srov_tab = mysqli_query($connect, $rq_srov);

////////////////////////////////////////////////////////////////////////////////
//requetes atelier 2.b
$rq_srov2 = "SELECT profil_de_l_attaquant_source_de_risque AS 'Profil d''attaquant', description_source_de_risque AS 'Description source du risque', objectif_vise AS 'Objectif visé', description_objectif_vise AS 'Description de l''objectif', motivation AS 'Motivation', ressources AS 'Ressources', activite AS 'Activité', mode_operatoire AS 'Mode opératoire', secteur_d_activite AS 'Secteur d''activité', arsenal_d_attaque AS 'Arsenal d''attaque', faits_d_armes AS 'Fait d''armes', pertinence AS 'Pertinence' FROM P_SROV WHERE id_projet = $getid_projet";
$rq_srov2_tab = mysqli_query($connect,$rq_srov2);
/*
////////////////////////////////////////////////////////////////////////////////
//requetes atelier 2.c*/
$rq_srov3 = "SELECT profil_de_l_attaquant_source_de_risque AS 'Profil d''attaquant', description_source_de_risque AS 'Description source du risque', objectif_vise AS 'Objectif visé', description_objectif_vise AS 'Description de l''objectif', motivation AS 'Motivation', ressources AS 'Ressources', activite AS 'Activité', mode_operatoire AS 'Mode opératoire', secteur_d_activite AS 'Secteur d''activité', arsenal_d_attaque AS 'Arsenal d''attaque', faits_d_armes AS 'Fait d''armes', pertinence AS 'Pertinence', choix_source_de_risque AS 'Choix P1/P2' FROM P_SROV WHERE id_projet = $getid_projet";
$rq_srov3_tab = mysqli_query($connect, $rq_srov3);

////////////////////////////////////////////////////////////////////////////////
//requetes atelier 3.a
$rq_partie = "SELECT categorie_partie_prenante AS 'Catégorie', nom_partie_prenante AS 'Partie prenante', type AS 'Type', dependance_partie_prenante AS 'Dépendance', ponderation_dependance AS 'Facteur de pondération dépendance', penetration_partie_prenante AS 'Pénétration', ponderation_penetration AS 'Facteur de pondération pénétration', maturite_partie_prenante AS 'Maturité', ponderation_maturite AS 'Facteur de pondération maturité', confiance_partie_prenante AS 'Confiance', ponderation_confiance AS 'Facteur de pondération confiance', niveau_de_menace_partie_prenante AS 'Niveau de Menace', criticite AS 'Criticité' FROM R_partie_prenante WHERE id_projet = $getid_projet ";
$rq_partie_tab = mysqli_query($connect, $rq_partie);

/*////////////////////////////////////////////////////////////////////////////////
//requetes atelier 3.b////*/
$rq_cidt = "SELECT nom_valeur_metier AS 'Valeur métier', nom_evenement_redoute AS 'Nom de l''événement redouté', description_evenement_redoute AS 'Description de l''événement redouté', impact AS 'Impacts', confidentialite AS 'C', integrite AS 'I',disponibilite AS 'D', tracabilite AS 'T', niveau_de_gravite AS 'Gravité' FROM M_evenement_redoute INNER JOIN J_valeur_metier on M_evenement_redoute.id_valeur_metier = J_valeur_metier.id_valeur_metier WHERE M_evenement_redoute.id_projet = $getid_projet";
$rq_cidt_tab = mysqli_query($connect, $rq_cidt);

$rq_srov4 = "SELECT type_d_attaquant_source_de_risque AS 'Type d''attaquant', profil_de_l_attaquant_source_de_risque AS 'Profile de l''attaquant', description_source_de_risque AS 'Description source de risque', objectif_vise AS 'Objectifs visés', description_objectif_vise AS 'Description de l''objectif' FROM P_SROV WHERE id_projet = $getid_projet AND choix_source_de_risque = 'P1'";
$rq_srov4_tab = mysqli_query($connect, $rq_srov4);

$rq_scenar_strat3b = "SELECT nom_scenario_strategique AS ' Nom du Scénario stratégique', CONCAT(P_SROV.description_source_de_risque,' / ', objectif_vise) AS ' Source de risque / Objectif visé' FROM S_scenario_strategique, P_SROV WHERE S_scenario_strategique.id_source_de_risque = P_SROV.id_source_de_risque AND P_SROV.id_projet = $getid_projet ORDER BY id_scenario_strategique ASC";
$rq_scenar_strat3b_tab = mysqli_query($connect, $rq_scenar_strat3b);

$rq_chemin_attaque = "SELECT id_risque AS 'ID du risque',nom_scenario_strategique AS 'Nom du scénario startégique',nom_chemin_d_attaque_strategique AS 'Chemin d''attaque startégique', description_chemin_d_attaque_strategique AS 'Description', nom_partie_prenante AS 'Partie prenante' FROM T_chemin_d_attaque_strategique NATURAL JOIN R_partie_prenante NATURAL JOIN S_scenario_strategique WHERE id_projet= $getid_projet";
$rq_chemin_attaque_tab = mysqli_query($connect, $rq_chemin_attaque);

////////////////////////////////////////////////////////////////////////////////
//requetes atelier 3.c
$rq_partie2 = "SELECT categorie_partie_prenante AS 'Catégorie', nom_partie_prenante AS 'Partie prenante', type AS 'Type', dependance_partie_prenante AS 'Dépendance', penetration_partie_prenante AS 'Pénétration', maturite_partie_prenante AS 'Maturité', confiance_partie_prenante AS 'Confiance', niveau_de_menace_partie_prenante AS 'Niveau de menace', criticite AS 'Criticité' FROM R_partie_prenante WHERE id_projet = $getid_projet";
$rq_partie2_tab = mysqli_query($connect, $rq_partie2);

$rq_scenar_strat = "SELECT nom_scenario_strategique AS 'Scénario stratégique', CONCAT(description_source_de_risque,': ',objectif_vise) AS 'Source de risque: Objectif visé', nom_evenement_redoute AS 'Événement redouté' FROM S_scenario_strategique NATURAL JOIN P_SROV NATURAL JOIN M_evenement_redoute WHERE id_projet =$getid_projet AND id_atelier = '3.c'";
$rq_scenar_strat_tab = mysqli_query($connect, $rq_scenar_strat);

////////////////////////////////////////////////////////////////////////////////
//requetes atelier 4.a
$rq_scen_strat= "SELECT nom_scenario_strategique AS 'Nom du scnénario stratégique',description_source_de_risque AS 'Description source de risque',objectif_vise AS 'Objectifs visés',nom_evenement_redoute AS 'Événements redoutés',id_risque AS 'N° Risque',nom_chemin_d_attaque_strategique AS 'Chemin d''attaques stratégiques',niveau_de_gravite AS 'Gravité' FROM S_scenario_strategique NATURAL JOIN P_SROV NATURAL JOIN M_evenement_redoute NATURAL JOIN T_chemin_d_attaque_strategique WHERE id_projet = $getid_projet AND id_atelier = '4.a'";

$rq_mode_op= "SELECT nom_scenario_operationnel AS'Scénario opérationnel', description_scenario_operationnel AS 'Mode opératoire' FROM U_scenario_operationnel WHERE id_projet = $getid_projet AND id_atelier = '4.a'";

$rq_scen_strat_tab = mysqli_query($connect, $rq_scen_strat);
$rq_mode_op_tab= mysqli_query($connect, $rq_mode_op);

////////////////////////////////////////////////////////////////////////////////
//requetes atelier 4.b
$rq_eval_vrai = "SELECT
T_chemin_d_attaque_strategique.id_risque AS 'Numéro du risque',
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique AS 'Chemin d''attaque stratégique',
U_scenario_operationnel.description_scenario_operationnel AS 'Scénario opérationnel',
U_scenario_operationnel.vraisemblance AS 'Vraisemblance'
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND U_scenario_operationnel.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet";

$rq_eval_vrai_tab = mysqli_query($connect, $rq_eval_vrai);


$rq_echelle_b= "SELECT nom_echelle AS'Nom de l''échelle',echelle_gravite  AS 'Echelle de la gravité' FROM DA_echelle WHERE id_projet = $getid_projet";
$rq_vraisemblance= "SELECT valeur_niveau AS'Valeur du niveau',description_niveau  AS 'Description du niveau' FROM DA_niveau  WHERE id_projet = $getid_projet";

$rq_echelle_b_tab = mysqli_query($connect, $rq_echelle_b);
$rq_vraisemblance_tab= mysqli_query($connect, $rq_vraisemblance);

////////////////////////////////////////////////////////////////////////////////
//requetes atelier 5.b
$rq_plan_amelio = "SELECT  Y_mesure.nom_mesure AS 'Mesure de sécurité', Y_mesure.description_mesure AS 'Description mesure de sécurité', ZA_traitement_de_securite.id_atelier AS 'Atelier', T_chemin_d_attaque_strategique.id_risque AS 'Scénario des risques associés', ZA_traitement_de_securite.principe_de_securite AS 'Principe de sécurité', ZA_traitement_de_securite.responsable AS 'Responsable', ZA_traitement_de_securite.difficulte_traitement_de_securite AS 'Frein et difficultés de mise en oeuvre', ZA_traitement_de_securite.cout_traitement_de_securite AS 'Cout', ZA_traitement_de_securite.date_traitement_de_securite AS 'Échéance', ZA_traitement_de_securite.statut FROM ZA_traitement_de_securite, ZB_comporter_2, Y_mesure, T_chemin_d_attaque_strategique
WHERE ZA_traitement_de_securite.id_mesure = Y_mesure.id_mesure
AND Y_mesure.id_mesure = ZB_comporter_2.id_mesure
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
AND ZA_traitement_de_securite.id_projet = $getid_projet
AND Y_mesure.id_projet = $getid_projet
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet
";
$rq_plan_amelio_tab = mysqli_query($connect, $rq_plan_amelio);

////////////////////////////////////////////////////////////////////////////////
//requetes atelier 5.c
$qr_eval_risk_resi = "SELECT
T_chemin_d_attaque_strategique.nom_chemin_d_attaque_strategique AS 'Nom du risque',
M_evenement_redoute.nom_evenement_redoute AS 'Événement redouté',
Y_mesure.nom_mesure AS 'Mesure de sécurité',
M_evenement_redoute.niveau_de_gravite AS 'Gravité initiale',
U_scenario_operationnel.vraisemblance AS 'Vraisemblance initiale',
U_scenario_operationnel.vraisemblance * M_evenement_redoute.niveau_de_gravite AS 'Risque initial',
X_revaluation_du_risque.nom_risque_residuelle AS 'Nom du risque résiduel',
X_revaluation_du_risque.description_risque_residuelle AS 'Description du risque résiduel',
X_revaluation_du_risque.vraisemblance_residuelle AS 'Vraisemblance résiduelle',
X_revaluation_du_risque.risque_residuel AS 'Risque résiduelle',
X_revaluation_du_risque.gestion_risque_residuelle AS 'Gestion du risque résiduel'
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique, X_revaluation_du_risque, ZB_comporter_2, Y_mesure, UA_ER, M_evenement_redoute
WHERE U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = X_revaluation_du_risque.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = ZB_comporter_2.id_chemin_d_attaque_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = UA_ER.id_chemin_d_attaque_strategique
AND ZB_comporter_2.id_mesure = Y_mesure.id_mesure
AND UA_ER.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND U_scenario_operationnel.id_projet = $getid_projet";
/*"SELECT
X_revaluation_du_risque.nom_risque_residuelle,
X_revaluation_du_risque.gestion_risque_residuelle,
X_revaluation_du_risque.risque_residuel,
X_revaluation_du_risque.gestion_risque_residuelle,
X_revaluation_du_risque.vraisemblance_residuelle,
X_revaluation_du_risque.description_risque_residuelle,
M_evenement_redoute.nom_evenement_redoute,
U_scenario_operationnel.id_risque,M_evenement_redoute.niveau_de_gravite,
Y_mesure.nom_mesure,
U_scenario_operationnel.vraisemblance
FROM  X_revaluation_du_risque, M_evenement_redoute, U_scenario_operationnel, Y_mesure
WHERE U_scenario_operationnel.id_projet = $getid_projet";*/

$qr_eval_risk_resi_tab = mysqli_query($connect, $qr_eval_risk_resi);
////////////////////////////////////////////////////////////////////////////////
//requetes atelier 5 a,b,c pour transformation cartographie => tableau
$qr_carto_into ="SELECT T_chemin_d_attaque_strategique.id_risque,gravite,vraisemblance,bareme
FROM DB_bareme_risque, T_chemin_d_attaque_strategique
WHERE DB_bareme_risque.id_projet=$getid_projet";
$qr_carto_into_tab = mysqli_query($connect, $qr_carto_into);

$rq_carto = "SELECT
T_chemin_d_attaque_strategique.id_risque,
U_scenario_operationnel.vraisemblance,
M_evenement_redoute.niveau_de_gravite
FROM U_scenario_operationnel,T_chemin_d_attaque_strategique, S_scenario_strategique,UA_ER, M_evenement_redoute
WHERE T_chemin_d_attaque_strategique.id_scenario_strategique = S_scenario_strategique.id_scenario_strategique
AND T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique = UA_ER.id_chemin_d_attaque_strategique
AND UA_ER.id_evenement_redoute = M_evenement_redoute.id_evenement_redoute
AND T_chemin_d_attaque_strategique.id_projet = $getid_projet
AND U_scenario_operationnel.id_chemin_d_attaque_strategique = T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique
AND U_scenario_operationnel.id_projet = $getid_projet
ORDER BY T_chemin_d_attaque_strategique.id_chemin_d_attaque_strategique ASC";
$rq_carto_tab = mysqli_query($connect, $rq_carto);






?>
