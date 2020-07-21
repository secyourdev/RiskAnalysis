--
-- sauvegarde20200721-144100.sql.gz


DROP TABLE IF EXISTS `A_utilisateur`;
CREATE TABLE `A_utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `poste` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(100) DEFAULT NULL,
  `type_compte` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `B_grp_utilisateur`;
CREATE TABLE `B_grp_utilisateur` (
  `id_grp_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_grp_utilisateur` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_grp_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `C_impliquer`;
CREATE TABLE `C_impliquer` (
  `id_grp_utilisateur` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_grp_utilisateur`,`id_utilisateur`),
  KEY `C_impliquer_A_utilisateur0_FK` (`id_utilisateur`),
  CONSTRAINT `C_impliquer_A_utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `A_utilisateur` (`id_utilisateur`),
  CONSTRAINT `C_impliquer_B_grp_utilisateur_FK` FOREIGN KEY (`id_grp_utilisateur`) REFERENCES `B_grp_utilisateur` (`id_grp_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `D_echelle`;
CREATE TABLE `D_echelle` (
  `id_echelle` int(11) NOT NULL AUTO_INCREMENT,
  `nom_echelle` varchar(50) DEFAULT NULL,
  `echelle_vraisemblance` int(11) DEFAULT NULL,
  `echelle_gravite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_echelle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `E_niveau`;
CREATE TABLE `E_niveau` (
  `id_niveau` int(11) NOT NULL AUTO_INCREMENT,
  `description_niveau` varchar(1000) DEFAULT NULL,
  `valeur_niveau` int(11) DEFAULT NULL,
  `id_echelle` int(11) NOT NULL,
  PRIMARY KEY (`id_niveau`),
  KEY `E_niveau_D_echelle_FK` (`id_echelle`),
  CONSTRAINT `E_niveau_D_echelle_FK` FOREIGN KEY (`id_echelle`) REFERENCES `D_echelle` (`id_echelle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `F_projet`;
CREATE TABLE `F_projet` (
  `id_projet` int(11) NOT NULL AUTO_INCREMENT,
  `nom_projet` varchar(100) DEFAULT NULL,
  `description_projet` varchar(1000) DEFAULT NULL,
  `objectif_projet` varchar(1000) DEFAULT NULL,
  `responsable_risque_residuel` varchar(100) DEFAULT NULL,
  `cadre_temporel` varchar(25) DEFAULT NULL,
  `id_echelle` int(11) NOT NULL,
  `id_grp_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_projet`),
  KEY `F_projet_D_echelle_FK` (`id_echelle`),
  KEY `F_projet_B_grp_utilisateur0_FK` (`id_grp_utilisateur`),
  CONSTRAINT `F_projet_B_grp_utilisateur0_FK` FOREIGN KEY (`id_grp_utilisateur`) REFERENCES `B_grp_utilisateur` (`id_grp_utilisateur`),
  CONSTRAINT `F_projet_D_echelle_FK` FOREIGN KEY (`id_echelle`) REFERENCES `D_echelle` (`id_echelle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `G_atelier`;
CREATE TABLE `G_atelier` (
  `id_atelier` varchar(50) NOT NULL,
  `nom_atelier` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `H_RACI`;
CREATE TABLE `H_RACI` (
  `id_projet` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `ecriture` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_projet`,`id_utilisateur`,`id_atelier`),
  KEY `H_RACI_A_utilisateur0_FK` (`id_utilisateur`),
  KEY `H_RACI_G_atelier1_FK` (`id_atelier`),
  CONSTRAINT `H_RACI_A_utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `A_utilisateur` (`id_utilisateur`),
  CONSTRAINT `H_RACI_F_projet_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `H_RACI_G_atelier1_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `I_mission`;
CREATE TABLE `I_mission` (
  `id_mission` int(11) NOT NULL AUTO_INCREMENT,
  `nom_mission` varchar(50) DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_mission`),
  KEY `I_mission_G_atelier_FK` (`id_atelier`),
  KEY `I_mission_F_projet0_FK` (`id_projet`),
  CONSTRAINT `I_mission_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `I_mission_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `J_valeur_metier`;
CREATE TABLE `J_valeur_metier` (
  `id_valeur_metier` int(11) NOT NULL AUTO_INCREMENT,
  `nom_valeur_metier` varchar(100) DEFAULT NULL,
  `nature_valeur_metier` varchar(100) DEFAULT NULL,
  `description_valeur_metier` varchar(1000) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_valeur_metier`),
  KEY `J_valeur_metier_G_atelier_FK` (`id_atelier`),
  KEY `J_valeur_metier_F_projet0_FK` (`id_projet`),
  CONSTRAINT `J_valeur_metier_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `J_valeur_metier_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `K_bien_support`;
CREATE TABLE `K_bien_support` (
  `id_bien_support` int(11) NOT NULL AUTO_INCREMENT,
  `nom_bien_support` varchar(100) DEFAULT NULL,
  `description_bien_support` varchar(1000) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_bien_support`),
  KEY `K_bien_support_G_atelier_FK` (`id_atelier`),
  KEY `K_bien_support_F_projet0_FK` (`id_projet`),
  CONSTRAINT `K_bien_support_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `K_bien_support_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `L_couple_VMBS`;
CREATE TABLE `L_couple_VMBS` (
  `id_valeur_metier` int(11) NOT NULL,
  `id_bien_support` int(11) NOT NULL,
  `id_mission` int(11) NOT NULL,
  `nom_responsable_vm` varchar(100) DEFAULT NULL,
  `nom_responsable_bs` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_valeur_metier`,`id_bien_support`,`id_mission`),
  KEY `L_couple_VMBS_K_bien_support0_FK` (`id_bien_support`),
  KEY `L_couple_VMBS_I_mission1_FK` (`id_mission`),
  CONSTRAINT `L_couple_VMBS_I_mission1_FK` FOREIGN KEY (`id_mission`) REFERENCES `I_mission` (`id_mission`),
  CONSTRAINT `L_couple_VMBS_J_valeur_metier_FK` FOREIGN KEY (`id_valeur_metier`) REFERENCES `J_valeur_metier` (`id_valeur_metier`),
  CONSTRAINT `L_couple_VMBS_K_bien_support0_FK` FOREIGN KEY (`id_bien_support`) REFERENCES `K_bien_support` (`id_bien_support`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `M_evenement_redoute`;
CREATE TABLE `M_evenement_redoute` (
  `id_evenement_redoute` int(11) NOT NULL AUTO_INCREMENT,
  `nom_evenement_redoute` varchar(100) DEFAULT NULL,
  `description_evenement_redoute` varchar(1000) DEFAULT NULL,
  `confidentialite` tinyint(1) DEFAULT NULL,
  `integrite` tinyint(1) DEFAULT NULL,
  `disponibilite` tinyint(1) DEFAULT NULL,
  `tracabilite` tinyint(1) DEFAULT NULL,
  `impact` varchar(1000) DEFAULT NULL,
  `niveau_de_gravite` int(11) DEFAULT NULL,
  `id_valeur_metier` int(11) NOT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_evenement_redoute`),
  KEY `M_evenement_redoute_J_valeur_metier_FK` (`id_valeur_metier`),
  KEY `M_evenement_redoute_G_atelier0_FK` (`id_atelier`),
  KEY `M_evenement_redoute_F_projet1_FK` (`id_projet`),
  CONSTRAINT `M_evenement_redoute_F_projet1_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `M_evenement_redoute_G_atelier0_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`),
  CONSTRAINT `M_evenement_redoute_J_valeur_metier_FK` FOREIGN KEY (`id_valeur_metier`) REFERENCES `J_valeur_metier` (`id_valeur_metier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `N_socle_de_securite`;
CREATE TABLE `N_socle_de_securite` (
  `id_socle_securite` int(11) NOT NULL AUTO_INCREMENT,
  `type_referentiel` varchar(100) DEFAULT NULL,
  `nom_referentiel` varchar(100) DEFAULT NULL,
  `etat_d_application` varchar(100) DEFAULT NULL,
  `etat_de_la_conformite` varchar(100) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_socle_securite`),
  KEY `N_socle_de_securite_G_atelier_FK` (`id_atelier`),
  KEY `N_socle_de_securite_F_projet0_FK` (`id_projet`),
  CONSTRAINT `N_socle_de_securite_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `N_socle_de_securite_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `O_regle`;
CREATE TABLE `O_regle` (
  `id_regle` int(11) NOT NULL,
  `id_regle_affichage` varchar(50) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `etat_de_la_regle` varchar(100) DEFAULT NULL,
  `justification_ecart` varchar(1000) DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `id_socle_securite` int(11) NOT NULL,
  PRIMARY KEY (`id_regle`,`id_regle_affichage`),
  KEY `O_regle_N_socle_de_securite_FK` (`id_socle_securite`),
  CONSTRAINT `O_regle_N_socle_de_securite_FK` FOREIGN KEY (`id_socle_securite`) REFERENCES `N_socle_de_securite` (`id_socle_securite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `P_SROV`;
CREATE TABLE `P_SROV` (
  `id_source_de_risque` int(11) NOT NULL AUTO_INCREMENT,
  `type_d_attaquant_source_de_risque` varchar(100) DEFAULT NULL,
  `profil_de_l_attaquant_source_de_risque` varchar(100) DEFAULT NULL,
  `description_source_de_risque` varchar(1000) DEFAULT NULL,
  `objectif_vise` varchar(100) DEFAULT NULL,
  `description_objectif_vise` varchar(1000) DEFAULT NULL,
  `motivation` int(11) DEFAULT NULL,
  `ressources` int(11) DEFAULT NULL,
  `activite` int(11) DEFAULT NULL,
  `mode_operatoire` varchar(1000) DEFAULT NULL,
  `secteur_d_activite` varchar(1000) DEFAULT NULL,
  `arsenal_d_attaque` varchar(1000) DEFAULT NULL,
  `faits_d_armes` varchar(1000) DEFAULT NULL,
  `pertinence` varchar(100) DEFAULT NULL,
  `choix_source_de_risque` varchar(2) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_source_de_risque`),
  KEY `P_SROV_G_atelier_FK` (`id_atelier`),
  KEY `P_SROV_F_projet0_FK` (`id_projet`),
  CONSTRAINT `P_SROV_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `P_SROV_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `Q_seuil`;
CREATE TABLE `Q_seuil` (
  `id_seuil` int(11) NOT NULL AUTO_INCREMENT,
  `seuil_danger` int(11) DEFAULT NULL,
  `seuil_controle` int(11) DEFAULT NULL,
  `seuil_veille` int(11) DEFAULT NULL,
  `id_projet` int(11) NOT NULL,
  `id_atelier` varchar(50) NOT NULL,
  PRIMARY KEY (`id_seuil`),
  KEY `Q_seuil_F_projet_FK` (`id_projet`),
  KEY `Q_seuil_G_atelier0_FK` (`id_atelier`),
  CONSTRAINT `Q_seuil_F_projet_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `Q_seuil_G_atelier0_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `R_partie_prenante`;
CREATE TABLE `R_partie_prenante` (
  `id_partie_prenante` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_partie_prenante` varchar(100) DEFAULT NULL,
  `nom_partie_prenante` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `dependance_partie_prenante` int(11) DEFAULT NULL,
  `penetration_partie_prenante` int(11) DEFAULT NULL,
  `maturite_partie_prenante` int(11) DEFAULT NULL,
  `confiance_partie_prenante` int(11) DEFAULT NULL,
  `niveau_de_menace_partie_prenante` double DEFAULT NULL,
  `ponderation_dependance` int(11) DEFAULT NULL,
  `ponderation_penetration` int(11) DEFAULT NULL,
  `ponderation_maturite` int(11) DEFAULT NULL,
  `ponderation_confiance` int(11) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `id_seuil` int(11) NOT NULL,
  PRIMARY KEY (`id_partie_prenante`),
  KEY `R_partie_prenante_G_atelier_FK` (`id_atelier`),
  KEY `R_partie_prenante_F_projet0_FK` (`id_projet`),
  KEY `R_partie_prenante_Q_seuil1_FK` (`id_seuil`),
  CONSTRAINT `R_partie_prenante_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `R_partie_prenante_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`),
  CONSTRAINT `R_partie_prenante_Q_seuil1_FK` FOREIGN KEY (`id_seuil`) REFERENCES `Q_seuil` (`id_seuil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `S_scenario_strategique`;
CREATE TABLE `S_scenario_strategique` (
  `id_scenario_strategique` int(11) NOT NULL AUTO_INCREMENT,
  `nom_scenario_strategique` varchar(50) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_source_de_risque` int(11) NOT NULL,
  `id_evenement_redoute` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_scenario_strategique`),
  KEY `S_scenario_strategique_G_atelier_FK` (`id_atelier`),
  KEY `S_scenario_strategique_P_SROV0_FK` (`id_source_de_risque`),
  KEY `S_scenario_strategique_M_evenement_redoute1_FK` (`id_evenement_redoute`),
  KEY `S_scenario_strategique_F_projet2_FK` (`id_projet`),
  CONSTRAINT `S_scenario_strategique_F_projet2_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `S_scenario_strategique_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`),
  CONSTRAINT `S_scenario_strategique_M_evenement_redoute1_FK` FOREIGN KEY (`id_evenement_redoute`) REFERENCES `M_evenement_redoute` (`id_evenement_redoute`),
  CONSTRAINT `S_scenario_strategique_P_SROV0_FK` FOREIGN KEY (`id_source_de_risque`) REFERENCES `P_SROV` (`id_source_de_risque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `T_chemin_d_attaque_strategique`;
CREATE TABLE `T_chemin_d_attaque_strategique` (
  `id_chemin_d_attaque_strategique` int(11) NOT NULL,
  `id_risque` varchar(50) NOT NULL,
  `nom_chemin_d_attaque_strategique` varchar(100) DEFAULT NULL,
  `description_chemin_d_attaque_strategique` varchar(1000) DEFAULT NULL,
  `dependance_residuelle` int(11) DEFAULT NULL,
  `penetration_residuelle` int(11) DEFAULT NULL,
  `maturite_residuelle` int(11) DEFAULT NULL,
  `confiance_residuelle` int(11) DEFAULT NULL,
  `niveau_de_menace_residuelle` double DEFAULT NULL,
  `id_scenario_strategique` int(11) NOT NULL,
  `id_partie_prenante` int(11) NOT NULL,
  PRIMARY KEY (`id_chemin_d_attaque_strategique`,`id_risque`),
  KEY `T_chemin_d_attaque_strategique_S_scenario_strategique_FK` (`id_scenario_strategique`),
  KEY `T_chemin_d_attaque_strategique_R_partie_prenante0_FK` (`id_partie_prenante`),
  CONSTRAINT `T_chemin_d_attaque_strategique_R_partie_prenante0_FK` FOREIGN KEY (`id_partie_prenante`) REFERENCES `R_partie_prenante` (`id_partie_prenante`),
  CONSTRAINT `T_chemin_d_attaque_strategique_S_scenario_strategique_FK` FOREIGN KEY (`id_scenario_strategique`) REFERENCES `S_scenario_strategique` (`id_scenario_strategique`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `U_etre`;
CREATE TABLE `U_etre` (
  `id_scenario_operationnel` int(11) NOT NULL,
  `id_evenement_redoute` int(11) NOT NULL,
  `niveau_de_risque` double DEFAULT NULL,
  PRIMARY KEY (`id_scenario_operationnel`,`id_evenement_redoute`),
  KEY `U_etre_M_evenement_redoute0_FK` (`id_evenement_redoute`),
  CONSTRAINT `U_etre_M_evenement_redoute0_FK` FOREIGN KEY (`id_evenement_redoute`) REFERENCES `M_evenement_redoute` (`id_evenement_redoute`),
  CONSTRAINT `U_etre_V_scenario_operationnel_FK` FOREIGN KEY (`id_scenario_operationnel`) REFERENCES `V_scenario_operationnel` (`id_scenario_operationnel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `V_scenario_operationnel`;
CREATE TABLE `V_scenario_operationnel` (
  `id_scenario_operationnel` int(11) NOT NULL AUTO_INCREMENT,
  `nom_scenario_operationnel` varchar(100) DEFAULT NULL,
  `description_scenario_operationnel` varchar(1000) DEFAULT NULL,
  `vraisemblance` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_chemin_d_attaque_strategique` int(11) NOT NULL,
  `id_risque` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_scenario_operationnel`),
  KEY `V_scenario_operationnel_G_atelier_FK` (`id_atelier`),
  KEY `V_scenario_operationnel_T_chemin_d_attaque_strategique0_FK` (`id_chemin_d_attaque_strategique`,`id_risque`),
  KEY `V_scenario_operationnel_F_projet1_FK` (`id_projet`),
  CONSTRAINT `V_scenario_operationnel_F_projet1_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `V_scenario_operationnel_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`),
  CONSTRAINT `V_scenario_operationnel_T_chemin_d_attaque_strategique0_FK` FOREIGN KEY (`id_chemin_d_attaque_strategique`, `id_risque`) REFERENCES `T_chemin_d_attaque_strategique` (`id_chemin_d_attaque_strategique`, `id_risque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `W_mode_operatoire`;
CREATE TABLE `W_mode_operatoire` (
  `id_mode_operatoire` int(11) NOT NULL AUTO_INCREMENT,
  `mode_operatoire` varchar(1000) DEFAULT NULL,
  `id_scenario_operationnel` int(11) NOT NULL,
  PRIMARY KEY (`id_mode_operatoire`),
  KEY `W_mode_operatoire_V_scenario_operationnel_FK` (`id_scenario_operationnel`),
  CONSTRAINT `W_mode_operatoire_V_scenario_operationnel_FK` FOREIGN KEY (`id_scenario_operationnel`) REFERENCES `V_scenario_operationnel` (`id_scenario_operationnel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `X_revaluation_du_risque`;
CREATE TABLE `X_revaluation_du_risque` (
  `id_revaluation` int(11) NOT NULL AUTO_INCREMENT,
  `vraisemblance_residuelle` int(11) DEFAULT NULL,
  `risque_residuel` int(11) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_chemin_d_attaque_strategique` int(11) NOT NULL,
  `id_risque` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_revaluation`),
  KEY `X_revaluation_du_risque_G_atelier_FK` (`id_atelier`),
  KEY `X_revaluation_du_risque_T_chemin_d_attaque_strategique0_FK` (`id_chemin_d_attaque_strategique`,`id_risque`),
  KEY `X_revaluation_du_risque_F_projet1_FK` (`id_projet`),
  CONSTRAINT `X_revaluation_du_risque_F_projet1_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `X_revaluation_du_risque_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`),
  CONSTRAINT `X_revaluation_du_risque_T_chemin_d_attaque_strategique0_FK` FOREIGN KEY (`id_chemin_d_attaque_strategique`, `id_risque`) REFERENCES `T_chemin_d_attaque_strategique` (`id_chemin_d_attaque_strategique`, `id_risque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `Y_mesure`;
CREATE TABLE `Y_mesure` (
  `id_mesure` int(11) NOT NULL AUTO_INCREMENT,
  `nom_mesure` varchar(100) DEFAULT NULL,
  `description_mesure` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id_mesure`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `ZA_traitement_de_securite`;
CREATE TABLE `ZA_traitement_de_securite` (
  `id_traitement_de_securite` int(11) NOT NULL AUTO_INCREMENT,
  `principe_de_securite` varchar(1000) DEFAULT NULL,
  `difficulte_traitement_de_securite` varchar(1000) DEFAULT NULL,
  `cout_traitement_de_securite` varchar(25) DEFAULT NULL,
  `date_traitement_de_securite` date DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `statut` varchar(100) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `id_mesure` int(11) NOT NULL,
  PRIMARY KEY (`id_traitement_de_securite`),
  KEY `Z_traitement_de_securite_G_atelier_FK` (`id_atelier`),
  KEY `Z_traitement_de_securite_F_projet0_FK` (`id_projet`),
  KEY `Z_traitement_de_securite_Y_mesure1_FK` (`id_mesure`),
  CONSTRAINT `Z_traitement_de_securite_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `Z_traitement_de_securite_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`),
  CONSTRAINT `Z_traitement_de_securite_Y_mesure1_FK` FOREIGN KEY (`id_mesure`) REFERENCES `Y_mesure` (`id_mesure`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `ZB_comporter_2`;
CREATE TABLE `ZB_comporter_2` (
  `id_mesure` int(11) NOT NULL,
  `id_chemin_d_attaque_strategique` int(11) NOT NULL,
  `id_risque` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mesure`,`id_chemin_d_attaque_strategique`,`id_risque`),
  KEY `ZZ_comporter_2_T_chemin_d_attaque_strategique0_FK` (`id_chemin_d_attaque_strategique`,`id_risque`),
  CONSTRAINT `ZZ_comporter_2_T_chemin_d_attaque_strategique0_FK` FOREIGN KEY (`id_chemin_d_attaque_strategique`, `id_risque`) REFERENCES `T_chemin_d_attaque_strategique` (`id_chemin_d_attaque_strategique`, `id_risque`),
  CONSTRAINT `ZZ_comporter_2_Y_mesure_FK` FOREIGN KEY (`id_mesure`) REFERENCES `Y_mesure` (`id_mesure`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
