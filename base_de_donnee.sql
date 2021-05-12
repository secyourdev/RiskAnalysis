--
-- sauvegarde20200731-180131.sql.gz
SET FOREIGN_KEY_CHECKS =  0 ;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO `A_utilisateur` VALUES ('1','ANTON RAVEENDRAN','Joyston','Ingénieur Cybersécurité','joyston.antonraveendran@edu.esiee.fr','$2y$10$sqqoKZH/ldSJpDEE.B71r.iK2R8Dg.13CxekMorR.ngxghY2VU6Kq','Administrateur Logiciel');
INSERT INTO `A_utilisateur` VALUES ('2','MICHEL','Guillaume','Ingénieur Logiciel','guillaume.michel@edu.esiee.fr','$2y$10$0kxHtETUPqWhCP2wnIEp8.CgGJn2ovkPKxQQInBwcV91N1Iyo7Oce','Administrateur Logiciel');
INSERT INTO `A_utilisateur` VALUES ('3','LAFOURCADE','Anthony','Ingénieur Logiciel','anthony.lafourcade@edu.esiee.fr','$2y$10$R/AiwRPtTNN1YXalpn063uwrfudevj2zSn65uCCdgF2v1RipRXEn6','Administrateur Logiciel');
INSERT INTO `A_utilisateur` VALUES ('4','PINTO','Carlos','Ingénieur sécurité','carlos.pinto5@wanadoo.fr','$2y$10$MV8n.ZZn32.qUcR0FZxXXOZs21oZSvXPjAfJntM0UQ9iE7xUoDbWS','Administrateur Logiciel');


DROP TABLE IF EXISTS `B_grp_utilisateur`;
CREATE TABLE `B_grp_utilisateur` (
  `id_grp_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_grp_utilisateur` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_grp_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `C_impliquer`;
CREATE TABLE `C_impliquer` (
  `id_grp_utilisateur` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_grp_utilisateur`,`id_utilisateur`),
  KEY `C_impliquer_A_utilisateur0_FK` (`id_utilisateur`),
  CONSTRAINT `C_impliquer_A_utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `A_utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `C_impliquer_B_grp_utilisateur_FK` FOREIGN KEY (`id_grp_utilisateur`) REFERENCES `B_grp_utilisateur` (`id_grp_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `DA_echelle`;
CREATE TABLE `DA_echelle` (
  `id_echelle` int(11) NOT NULL AUTO_INCREMENT,
  `nom_echelle` varchar(50) DEFAULT NULL,
  `echelle_vraisemblance` int(11) DEFAULT NULL,
  `echelle_gravite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_echelle`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `DA_echelle` VALUES ('1','Standard','5','5');

DROP TABLE IF EXISTS `DA_evaluer`;
CREATE TABLE `DA_evaluer` (
  `id_echelle` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_echelle`,`id_projet`),
  KEY `DA_evaluer_F_projet0_FK` (`id_projet`),
  CONSTRAINT `DA_evaluer_DA_echelle_FK` FOREIGN KEY (`id_echelle`) REFERENCES `DA_echelle` (`id_echelle`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `DA_evaluer_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `DA_niveau`;
CREATE TABLE `DA_niveau` (
  `id_niveau` int(11) NOT NULL AUTO_INCREMENT,
  `description_niveau` varchar(1000) DEFAULT NULL,
  `valeur_niveau` int(11) DEFAULT NULL,
  `id_echelle` int(11) NOT NULL,
  PRIMARY KEY (`id_niveau`),
  KEY `DA_niveau_DA_echelle_FK` (`id_echelle`),
  CONSTRAINT `DA_niveau_DA_echelle_FK` FOREIGN KEY (`id_echelle`) REFERENCES `DA_echelle` (`id_echelle`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO `DA_niveau` VALUES ('1','Conséquences négligeables pour l''organisation. Aucun impact opérationnel ni sur les performances de l''activité ni sur la sécurité des personnes et des biens. L''organisation surmontera la situation sans trop de difficultés (consommation des marges).','1','1');
INSERT INTO `DA_niveau` VALUES ('2','Conséquences significatives mais limitées pour l''organisation. Dégradation des performances de l’activité sans impact sur la sécurité des personnes et des biens. L''organisation surmontera la situation malgré quelques difficultés (fonctionnement en mode dégradé).','2','1');
INSERT INTO `DA_niveau` VALUES ('3','Conséquences importantes pour l''organisation. Forte dégradation des performances de l''activité, avec d’éventuels impacts significatifs sur la sécurité des personnes et des biens. L''organisation surmontera la situation avec de sérieuses difficultés (fonctionnement en mode très dégradé), sans impact sectoriel ou étatique.','3','1');
INSERT INTO `DA_niveau` VALUES ('4','Conséquences désastreuses pour l''organisation avec d''éventuels impacts sur l''écosystème. Incapacité pour l''organisation d''assurer la totalité ou une partie de son activité, avec d''éventuels impacts graves sur la sécurité des personnes et des biens. L''organisation ne surmontera vraisemblablement pas la situation (sa survie est menacée), les secteurs d''activité ou étatiques dans lesquels elle opère seront susceptibles d’être légèrement impactés, sans conséquences durables.','4','1');
INSERT INTO `DA_niveau` VALUES ('5','Conséquences sectorielles ou régaliennes au-delà de l’organisation. Écosystème(s) sectoriel(s) impacté(s) de façon importante, avec des conséquences éventuellement durables. Et/ou : difficulté pour l’État, voire incapacité, d’assurer une fonction régalienne ou une de ses missions d’importance vitale. Et/ou : impacts critiques sur la sécurité des personnes et des biens (crise sanitaire, pollution environnementale majeure, destruction d’infrastructures essentielles, etc.).	\r\n','5','1');

DROP TABLE IF EXISTS `DB_bareme_risque`;
CREATE TABLE `DB_bareme_risque` (
  `id_bareme_risque` int(11) NOT NULL AUTO_INCREMENT,
  `vraisemblance` int(11) DEFAULT NULL,
  `gravite` int(11) DEFAULT NULL,
  `bareme` varchar(100) DEFAULT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_bareme_risque`),
  KEY `DB_bareme_risque_F_projet_FK` (`id_projet`),
  CONSTRAINT `DB_bareme_risque_F_projet_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `F_projet`;
CREATE TABLE `F_projet` (
  `id_projet` int(11) NOT NULL AUTO_INCREMENT,
  `nom_projet` varchar(100) DEFAULT NULL,
  `description_projet` varchar(1000) DEFAULT NULL,
  `objectif_projet` varchar(1000) DEFAULT NULL,
  `responsable_risque_residuel` varchar(100) DEFAULT NULL,
  `cadre_temporel` varchar(25) DEFAULT NULL,
  `id_grp_utilisateur` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_echelle` int(11) NOT NULL,
  PRIMARY KEY (`id_projet`),
  KEY `F_projet_A_utilisateur0_FK` (`id_utilisateur`),
  KEY `F_projet_B_grp_utilisateur_FK` (`id_grp_utilisateur`),
  KEY `F_projet_DA_echelle1_FK` (`id_echelle`),
  CONSTRAINT `F_projet_A_utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `A_utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `F_projet_B_grp_utilisateur_FK` FOREIGN KEY (`id_grp_utilisateur`) REFERENCES `B_grp_utilisateur` (`id_grp_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `F_projet_DA_echelle1_FK` FOREIGN KEY (`id_echelle`) REFERENCES `DA_echelle` (`id_echelle`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `G_atelier`;
CREATE TABLE `G_atelier` (
  `id_atelier` varchar(50) NOT NULL,
  `nom_atelier` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `G_atelier` VALUES ('1.a','Cadrer l’étude');
INSERT INTO `G_atelier` VALUES ('1.b','Biens primordiaux/support');
INSERT INTO `G_atelier` VALUES ('1.c','Événements redoutés');
INSERT INTO `G_atelier` VALUES ('1.d','Le socle de sécurité');
INSERT INTO `G_atelier` VALUES ('2.a','Identifier les sources de risques et les objectifs');
INSERT INTO `G_atelier` VALUES ('2.b','Évaluer les couples sources de risque/objectifs visés');
INSERT INTO `G_atelier` VALUES ('2.c','Sélectionner les couples SR/OV retenus pour la suite de l''analyse');
INSERT INTO `G_atelier` VALUES ('3.a','Construire la cartographie des menaces numériques de l''écosystème et sélectionner les parties prenantes critiques');
INSERT INTO `G_atelier` VALUES ('3.b','Élaborer des scénarios stratégiques');
INSERT INTO `G_atelier` VALUES ('3.c','Définir des mesures de sécurité sur l’écosystème');
INSERT INTO `G_atelier` VALUES ('4.a','Élaborer les scénarios opérationnels');
INSERT INTO `G_atelier` VALUES ('4.b','Évaluer la vraisemblance des scénarios opérationnels');
INSERT INTO `G_atelier` VALUES ('5.a','Réaliser une synthèse des scénarios de risque');
INSERT INTO `G_atelier` VALUES ('5.b','Décider de la stratégie de traitement du risque et définir les mesures de sécurité');
INSERT INTO `G_atelier` VALUES ('5.c','Évaluer et documenter les risques résiduels');


DROP TABLE IF EXISTS `H_RACI`;
CREATE TABLE `H_RACI` (
  `id_projet` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `ecriture` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_projet`,`id_utilisateur`,`id_atelier`),
  KEY `H_RACI_A_utilisateur0_FK` (`id_utilisateur`),
  KEY `H_RACI_G_atelier1_FK` (`id_atelier`),
  CONSTRAINT `H_RACI_A_utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `A_utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `H_RACI_F_projet_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `H_RACI_G_atelier1_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `I_mission`;
CREATE TABLE `I_mission` (
  `id_mission` int(11) NOT NULL AUTO_INCREMENT,
  `nom_mission` varchar(50) DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_mission`),
  KEY `I_mission_F_projet0_FK` (`id_projet`),
  KEY `I_mission_G_atelier_FK` (`id_atelier`),
  CONSTRAINT `I_mission_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `I_mission_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `J_valeur_metier`;
CREATE TABLE `J_valeur_metier` (
  `id_valeur_metier` int(11) NOT NULL AUTO_INCREMENT,
  `nom_valeur_metier` varchar(100) DEFAULT NULL,
  `nature_valeur_metier` varchar(100) DEFAULT NULL,
  `description_valeur_metier` varchar(1000) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_valeur_metier`),
  KEY `J_valeur_metier_F_projet0_FK` (`id_projet`),
  KEY `J_valeur_metier_G_atelier_FK` (`id_atelier`),
  CONSTRAINT `J_valeur_metier_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `J_valeur_metier_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `K_bien_support`;
CREATE TABLE `K_bien_support` (
  `id_bien_support` int(11) NOT NULL AUTO_INCREMENT,
  `nom_bien_support` varchar(100) DEFAULT NULL,
  `description_bien_support` varchar(1000) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_bien_support`),
  KEY `K_bien_support_F_projet0_FK` (`id_projet`),
  KEY `K_bien_support_G_atelier_FK` (`id_atelier`),
  CONSTRAINT `K_bien_support_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `K_bien_support_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `L_couple_VMBS`;
CREATE TABLE `L_couple_VMBS` (
  `id_valeur_metier` int(11) NOT NULL,
  `id_bien_support` int(11) NOT NULL,
  `id_mission` int(11) NOT NULL,
  `nom_responsable_vm` varchar(100) DEFAULT NULL,
  `nom_responsable_bs` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_valeur_metier`,`id_bien_support`,`id_mission`),
  KEY `L_couple_VMBS_I_mission1_FK` (`id_mission`),
  KEY `L_couple_VMBS_K_bien_support0_FK` (`id_bien_support`),
  CONSTRAINT `L_couple_VMBS_I_mission1_FK` FOREIGN KEY (`id_mission`) REFERENCES `I_mission` (`id_mission`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `L_couple_VMBS_J_valeur_metier_FK` FOREIGN KEY (`id_valeur_metier`) REFERENCES `J_valeur_metier` (`id_valeur_metier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `L_couple_VMBS_K_bien_support0_FK` FOREIGN KEY (`id_bien_support`) REFERENCES `K_bien_support` (`id_bien_support`) ON DELETE CASCADE ON UPDATE CASCADE
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
  KEY `M_evenement_redoute_F_projet1_FK` (`id_projet`),
  KEY `M_evenement_redoute_G_atelier0_FK` (`id_atelier`),
  KEY `M_evenement_redoute_J_valeur_metier_FK` (`id_valeur_metier`),
  CONSTRAINT `M_evenement_redoute_F_projet1_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `M_evenement_redoute_G_atelier0_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `M_evenement_redoute_J_valeur_metier_FK` FOREIGN KEY (`id_valeur_metier`) REFERENCES `J_valeur_metier` (`id_valeur_metier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;


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
  KEY `N_socle_de_securite_F_projet0_FK` (`id_projet`),
  KEY `N_socle_de_securite_G_atelier_FK` (`id_atelier`),
  CONSTRAINT `N_socle_de_securite_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `N_socle_de_securite_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `O_regle`;
CREATE TABLE `O_regle` (
  `id_regle` int(11) NOT NULL AUTO_INCREMENT,
  `id_regle_affichage` varchar(50) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `etat_de_la_regle` varchar(100) DEFAULT NULL,
  `justification_ecart` varchar(1000) DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `id_socle_securite` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `id_atelier` varchar(50) NOT NULL,
  PRIMARY KEY (`id_regle`,`id_regle_affichage`),
  KEY `O_regle_F_projet0_FK` (`id_projet`),
  KEY `O_regle_G_atelier1_FK` (`id_atelier`),
  KEY `O_regle_N_socle_de_securite_FK` (`id_socle_securite`),
  CONSTRAINT `O_regle_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `O_regle_G_atelier1_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `O_regle_N_socle_de_securite_FK` FOREIGN KEY (`id_socle_securite`) REFERENCES `N_socle_de_securite` (`id_socle_securite`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1271 DEFAULT CHARSET=utf8mb4;


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
  KEY `P_SROV_F_projet0_FK` (`id_projet`),
  KEY `P_SROV_G_atelier_FK` (`id_atelier`),
  CONSTRAINT `P_SROV_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `P_SROV_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;


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
  CONSTRAINT `Q_seuil_F_projet_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Q_seuil_G_atelier0_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;


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
  `dependance_residuelle` int(11) DEFAULT NULL,
  `penetration_residuelle` int(11) DEFAULT NULL,
  `maturite_residuelle` int(11) DEFAULT NULL,
  `confiance_residuelle` int(11) DEFAULT NULL,
  `niveau_de_menace_residuelle` double DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `id_seuil` int(11) NOT NULL,
  `criticite` varchar(50) NOT NULL,
  PRIMARY KEY (`id_partie_prenante`),
  KEY `R_partie_prenante_F_projet0_FK` (`id_projet`),
  KEY `R_partie_prenante_G_atelier_FK` (`id_atelier`),
  KEY `R_partie_prenante_Q_seuil1_FK` (`id_seuil`),
  CONSTRAINT `R_partie_prenante_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_partie_prenante_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_partie_prenante_Q_seuil1_FK` FOREIGN KEY (`id_seuil`) REFERENCES `Q_seuil` (`id_seuil`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;


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
  KEY `S_scenario_strategique_F_projet2_FK` (`id_projet`),
  KEY `S_scenario_strategique_G_atelier_FK` (`id_atelier`),
  KEY `S_scenario_strategique_M_evenement_redoute1_FK` (`id_evenement_redoute`),
  KEY `S_scenario_strategique_P_SROV0_FK` (`id_source_de_risque`),
  CONSTRAINT `S_scenario_strategique_F_projet2_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `S_scenario_strategique_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `S_scenario_strategique_M_evenement_redoute1_FK` FOREIGN KEY (`id_evenement_redoute`) REFERENCES `M_evenement_redoute` (`id_evenement_redoute`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `S_scenario_strategique_P_SROV0_FK` FOREIGN KEY (`id_source_de_risque`) REFERENCES `P_SROV` (`id_source_de_risque`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `T_chemin_d_attaque_strategique`;
CREATE TABLE `T_chemin_d_attaque_strategique` (
  `id_chemin_d_attaque_strategique` int(11) NOT NULL AUTO_INCREMENT,
  `id_risque` varchar(50) NOT NULL,
  `nom_chemin_d_attaque_strategique` varchar(100) DEFAULT NULL,
  `description_chemin_d_attaque_strategique` varchar(1000) DEFAULT NULL,
  `id_scenario_strategique` int(11) NOT NULL,
  `id_partie_prenante` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `id_atelier` varchar(50) NOT NULL,
  PRIMARY KEY (`id_chemin_d_attaque_strategique`,`id_risque`),
  KEY `T_chemin_d_attaque_strategique_F_projet1_FK` (`id_projet`),
  KEY `T_chemin_d_attaque_strategique_G_atelier2_FK` (`id_atelier`),
  KEY `T_chemin_d_attaque_strategique_R_partie_prenante0_FK` (`id_partie_prenante`),
  KEY `T_chemin_d_attaque_strategique_S_scenario_strategique_FK` (`id_scenario_strategique`),
  CONSTRAINT `T_chemin_d_attaque_strategique_F_projet1_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `T_chemin_d_attaque_strategique_G_atelier2_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `T_chemin_d_attaque_strategique_R_partie_prenante0_FK` FOREIGN KEY (`id_partie_prenante`) REFERENCES `R_partie_prenante` (`id_partie_prenante`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `T_chemin_d_attaque_strategique_S_scenario_strategique_FK` FOREIGN KEY (`id_scenario_strategique`) REFERENCES `S_scenario_strategique` (`id_scenario_strategique`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `U_scenario_operationnel`;
CREATE TABLE `U_scenario_operationnel` (
  `id_scenario_operationnel` int(11) NOT NULL AUTO_INCREMENT,
  `nom_scenario_operationnel` varchar(100) DEFAULT NULL,
  `description_scenario_operationnel` varchar(1000) DEFAULT NULL,
  `vraisemblance` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_chemin_d_attaque_strategique` int(11) NOT NULL,
  `id_risque` varchar(50) NOT NULL,
  `id_evenement_redoute` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_scenario_operationnel`),
  KEY `U_scenario_operationnel_F_projet2_FK` (`id_projet`),
  KEY `U_scenario_operationnel_G_atelier_FK` (`id_atelier`),
  KEY `U_scenario_operationnel_M_evenement_redoute1_FK` (`id_evenement_redoute`),
  KEY `U_scenario_operationnel_T_chemin_d_attaque_strategique0_FK` (`id_chemin_d_attaque_strategique`,`id_risque`),
  CONSTRAINT `U_scenario_operationnel_F_projet2_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `U_scenario_operationnel_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `U_scenario_operationnel_M_evenement_redoute1_FK` FOREIGN KEY (`id_evenement_redoute`) REFERENCES `M_evenement_redoute` (`id_evenement_redoute`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `U_scenario_operationnel_T_chemin_d_attaque_strategique0_FK` FOREIGN KEY (`id_chemin_d_attaque_strategique`, `id_risque`) REFERENCES `T_chemin_d_attaque_strategique` (`id_chemin_d_attaque_strategique`, `id_risque`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `W_mode_operatoire`;
CREATE TABLE `W_mode_operatoire` (
  `id_mode_operatoire` int(11) NOT NULL AUTO_INCREMENT,
  `mode_operatoire` varchar(1000) DEFAULT NULL,
  `id_scenario_operationnel` int(11) NOT NULL,
  PRIMARY KEY (`id_mode_operatoire`),
  KEY `W_mode_operatoire_U_scenario_operationnel_FK` (`id_scenario_operationnel`),
  CONSTRAINT `W_mode_operatoire_U_scenario_operationnel_FK` FOREIGN KEY (`id_scenario_operationnel`) REFERENCES `U_scenario_operationnel` (`id_scenario_operationnel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `X_revaluation_du_risque`;
CREATE TABLE `X_revaluation_du_risque` (
  `id_revaluation` int(11) NOT NULL AUTO_INCREMENT,
  `nom_risque_residuelle` varchar(100) DEFAULT NULL,
  `description_risque_residuelle` varchar(1000) DEFAULT NULL,
  `vraisemblance_residuelle` int(11) DEFAULT NULL,
  `risque_residuel` int(11) DEFAULT NULL,
  `gestion_risque_residuelle` varchar(1000) DEFAULT NULL,
  `id_atelier` varchar(50) NOT NULL,
  `id_chemin_d_attaque_strategique` int(11) NOT NULL,
  `id_risque` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_revaluation`),
  KEY `X_revaluation_du_risque_F_projet1_FK` (`id_projet`),
  KEY `X_revaluation_du_risque_G_atelier_FK` (`id_atelier`),
  KEY `X_revaluation_du_risque_T_chemin_d_attaque_strategique0_FK` (`id_chemin_d_attaque_strategique`,`id_risque`),
  CONSTRAINT `X_revaluation_du_risque_F_projet1_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `X_revaluation_du_risque_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `X_revaluation_du_risque_T_chemin_d_attaque_strategique0_FK` FOREIGN KEY (`id_chemin_d_attaque_strategique`, `id_risque`) REFERENCES `T_chemin_d_attaque_strategique` (`id_chemin_d_attaque_strategique`, `id_risque`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `Y_mesure`;
CREATE TABLE `Y_mesure` (
  `id_mesure` int(11) NOT NULL AUTO_INCREMENT,
  `nom_mesure` varchar(100) DEFAULT NULL,
  `description_mesure` varchar(1000) DEFAULT NULL,
  `id_projet` int(11) NOT NULL,
  `id_atelier` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mesure`),
  KEY `Y_mesure_F_projet_FK` (`id_projet`),
  KEY `Y_mesure_G_atelier0_FK` (`id_atelier`),
  CONSTRAINT `Y_mesure_F_projet_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Y_mesure_G_atelier0_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;


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
  KEY `ZA_traitement_de_securite_F_projet0_FK` (`id_projet`),
  KEY `ZA_traitement_de_securite_G_atelier_FK` (`id_atelier`),
  KEY `ZA_traitement_de_securite_Y_mesure1_FK` (`id_mesure`),
  CONSTRAINT `ZA_traitement_de_securite_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ZA_traitement_de_securite_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ZA_traitement_de_securite_Y_mesure1_FK` FOREIGN KEY (`id_mesure`) REFERENCES `Y_mesure` (`id_mesure`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `ZB_comporter_2`;
CREATE TABLE `ZB_comporter_2` (
  `id_mesure` int(11) NOT NULL,
  `id_chemin_d_attaque_strategique` int(11) NOT NULL,
  `id_risque` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mesure`,`id_chemin_d_attaque_strategique`,`id_risque`),
  KEY `ZB_comporter_2_T_chemin_d_attaque_strategique0_FK` (`id_chemin_d_attaque_strategique`,`id_risque`),
  CONSTRAINT `ZB_comporter_2_T_chemin_d_attaque_strategique0_FK` FOREIGN KEY (`id_chemin_d_attaque_strategique`, `id_risque`) REFERENCES `T_chemin_d_attaque_strategique` (`id_chemin_d_attaque_strategique`, `id_risque`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ZB_comporter_2_Y_mesure_FK` FOREIGN KEY (`id_mesure`) REFERENCES `Y_mesure` (`id_mesure`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
