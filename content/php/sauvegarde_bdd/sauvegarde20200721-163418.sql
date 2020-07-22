--
-- sauvegarde20200721-163418.sql.gz


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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO `A_utilisateur` VALUES ('1','ANTON RAVEENDRAN','Joyston','Ingénieur Cybersécurité','joyston.antonraveendran@edu.esiee.fr','$2y$10$KRWiVrr91hYvHdPSwJibLuv0CArOGUFAZbcI611luOv/VMPOlEDOy','Administrateur Logiciel');
INSERT INTO `A_utilisateur` VALUES ('2','LAFOURCADE','Anthony','Ingénieur','anthony.lafourcade@edu.esiee.fr','$2y$10$Pd7nIvQFin4raKDiQaT14.WHR7HSL7MshaKylPwoSpPqSVRelBqeS','Administrateur Logiciel');
INSERT INTO `A_utilisateur` VALUES ('3','MICHEL','Guillaume','Ingénieur','guillaume.michel@edu.esiee.fr','$2y$10$yduLDQV6L7Pu6QkMhIVfNuK7nXuQ6oloFwOEGGLTRFopXPNrw9ttq','Administrateur Logiciel');
INSERT INTO `A_utilisateur` VALUES ('5','PINTO','Carlos','Ingénieur sécurité','carlospinto4949@hotmail.com','$2y$10$3meatQGQUU9vgENoJT7HduTl/qeLFdi.3r/VaokUmNseqGaihS2ai','Utilisateur');
INSERT INTO `A_utilisateur` VALUES ('6','PINTO','Carlos','Ingénieur sécurité','carlos.pinto5@wanadoo.fr','$2y$10$MV8n.ZZn32.qUcR0FZxXXOZs21oZSvXPjAfJntM0UQ9iE7xUoDbWS','Administrateur Logiciel');


DROP TABLE IF EXISTS `B_grp_utilisateur`;
CREATE TABLE `B_grp_utilisateur` (
  `id_grp_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_grp_utilisateur` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_grp_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `B_grp_utilisateur` VALUES ('1','GroupeUserUn');
INSERT INTO `B_grp_utilisateur` VALUES ('2','GroupeCarlos');


DROP TABLE IF EXISTS `C_impliquer`;
CREATE TABLE `C_impliquer` (
  `id_grp_utilisateur` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_grp_utilisateur`,`id_utilisateur`),
  KEY `C_impliquer_A_utilisateur0_FK` (`id_utilisateur`),
  CONSTRAINT `C_impliquer_A_utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `A_utilisateur` (`id_utilisateur`),
  CONSTRAINT `C_impliquer_B_grp_utilisateur_FK` FOREIGN KEY (`id_grp_utilisateur`) REFERENCES `B_grp_utilisateur` (`id_grp_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `C_impliquer` VALUES ('1','1');
INSERT INTO `C_impliquer` VALUES ('1','2');
INSERT INTO `C_impliquer` VALUES ('1','3');
INSERT INTO `C_impliquer` VALUES ('2','1');
INSERT INTO `C_impliquer` VALUES ('2','3');
INSERT INTO `C_impliquer` VALUES ('2','6');


DROP TABLE IF EXISTS `D_echelle`;
CREATE TABLE `D_echelle` (
  `id_echelle` int(11) NOT NULL AUTO_INCREMENT,
  `nom_echelle` varchar(50) DEFAULT NULL,
  `echelle_vraisemblance` int(11) DEFAULT NULL,
  `echelle_gravite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_echelle`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `D_echelle` VALUES ('1','Standard','5','5');
INSERT INTO `D_echelle` VALUES ('2','CarlosEchelle','5','4');


DROP TABLE IF EXISTS `E_niveau`;
CREATE TABLE `E_niveau` (
  `id_niveau` int(11) NOT NULL AUTO_INCREMENT,
  `description_niveau` varchar(1000) DEFAULT NULL,
  `valeur_niveau` int(11) DEFAULT NULL,
  `id_echelle` int(11) NOT NULL,
  PRIMARY KEY (`id_niveau`),
  KEY `E_niveau_D_echelle_FK` (`id_echelle`),
  CONSTRAINT `E_niveau_D_echelle_FK` FOREIGN KEY (`id_echelle`) REFERENCES `D_echelle` (`id_echelle`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO `E_niveau` VALUES ('1','Conséquences négligeables pour l’organisation. Aucun impact opérationnel ni sur les performances de l’activité ni sur la sécurité des personnes et des biens. L’organisation surmontera la situation sans trop de difficultés (consommation des marges).','1','1');
INSERT INTO `E_niveau` VALUES ('2','Conséquences significatives mais limitées pour l’organisation. Dégradation des performances de l’activité sans impact sur la sécurité des personnes et des biens. L’organisation surmontera la situation malgré quelques difficultés (fonctionnement en mode dégradé).','2','1');
INSERT INTO `E_niveau` VALUES ('3','Conséquences importantes pour l’organisation. Forte dégradation des performances de l’activité, avec d’éventuels impacts significatifs sur la sécurité des personnes et des biens. L’organisation surmontera la situation avec de sérieuses difficultés (fonctionnement en mode très dégradé), sans impact sectoriel ou étatique.','3','1');
INSERT INTO `E_niveau` VALUES ('4','Conséquences désastreuses pour l’organisation avec d’éventuels impacts sur l’écosystème. Incapacité pour l’organisation d’assurer la totalité ou une partie de son activité, avec d’éventuels impacts graves sur la sécurité des personnes et des biens. L’organisation ne surmontera vraisemblablement pas la situation (sa survie est menacée), les secteurs d’activité ou étatiques dans lesquels elle opère seront susceptibles d’être légèrement impactés, sans conséquences durables.','4','1');
INSERT INTO `E_niveau` VALUES ('5','Conséquences sectorielles ou régaliennes au-delà de l’organisation. Écosystème(s) sectoriel(s) impacté(s) de façon importante, avec des conséquences éventuellement durables. Et/ou : difficulté pour l’État, voire incapacité, d’assurer une fonction régalienne ou une de ses missions d’importance vitale. Et/ou : impacts critiques sur la sécurité des personnes et des biens (crise sanitaire, pollution environnementale majeure, destruction d’infrastructures essentielles, etc.).	\r\n','5','1');
INSERT INTO `E_niveau` VALUES ('6','Pas grave du tout','1','2');
INSERT INTO `E_niveau` VALUES ('7','Un peu grave','2','2');
INSERT INTO `E_niveau` VALUES ('8','Grave','3','2');
INSERT INTO `E_niveau` VALUES ('9','Très grave','4','2');


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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO `F_projet` VALUES ('1','ProjetUn','ProjetUn','ProjetUn','1','2020-07-31','2','1');
INSERT INTO `F_projet` VALUES ('2','Hellohello','Desc Projet','Obj à atteindre','4','2020-07-23','2','2');
INSERT INTO `F_projet` VALUES ('13','MonProjet','dsdsds','Desc','6','2020-07-15','2','2');
INSERT INTO `F_projet` VALUES ('15','a','a',NULL,NULL,NULL,'1','1');
INSERT INTO `F_projet` VALUES ('16','joystonaaa','joyston','m','2','2020-07-11','1','1');


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
  CONSTRAINT `H_RACI_A_utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `A_utilisateur` (`id_utilisateur`),
  CONSTRAINT `H_RACI_F_projet_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `H_RACI_G_atelier1_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `H_RACI` VALUES ('1','1','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','1','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','2','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('1','3','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','1','1.a','Information');
INSERT INTO `H_RACI` VALUES ('2','1','1.b','Information');
INSERT INTO `H_RACI` VALUES ('2','1','1.c','Approbation');
INSERT INTO `H_RACI` VALUES ('2','1','1.d','Information');
INSERT INTO `H_RACI` VALUES ('2','1','2.a','Information');
INSERT INTO `H_RACI` VALUES ('2','1','2.b','Information');
INSERT INTO `H_RACI` VALUES ('2','1','3.a','Information');
INSERT INTO `H_RACI` VALUES ('2','1','3.b','Information');
INSERT INTO `H_RACI` VALUES ('2','1','3.c','Information');
INSERT INTO `H_RACI` VALUES ('2','1','4.a','Information');
INSERT INTO `H_RACI` VALUES ('2','1','4.b','Information');
INSERT INTO `H_RACI` VALUES ('2','1','5.a','Information');
INSERT INTO `H_RACI` VALUES ('2','1','5.b','Information');
INSERT INTO `H_RACI` VALUES ('2','1','5.c','Information');
INSERT INTO `H_RACI` VALUES ('2','3','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('2','3','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','1','1.a','Information');
INSERT INTO `H_RACI` VALUES ('13','1','1.b','Information');
INSERT INTO `H_RACI` VALUES ('13','1','1.c','Information');
INSERT INTO `H_RACI` VALUES ('13','1','1.d','Information');
INSERT INTO `H_RACI` VALUES ('13','1','2.a','Information');
INSERT INTO `H_RACI` VALUES ('13','1','2.b','Information');
INSERT INTO `H_RACI` VALUES ('13','1','3.a','Information');
INSERT INTO `H_RACI` VALUES ('13','1','3.b','Information');
INSERT INTO `H_RACI` VALUES ('13','1','3.c','Information');
INSERT INTO `H_RACI` VALUES ('13','1','4.a','Information');
INSERT INTO `H_RACI` VALUES ('13','1','4.b','Information');
INSERT INTO `H_RACI` VALUES ('13','1','5.a','Information');
INSERT INTO `H_RACI` VALUES ('13','1','5.b','Information');
INSERT INTO `H_RACI` VALUES ('13','1','5.c','Information');
INSERT INTO `H_RACI` VALUES ('13','3','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','3','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('13','6','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','3','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','1','5.c','Réalisation');


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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

INSERT INTO `I_mission` VALUES ('16','test','test','1.b','1');
INSERT INTO `I_mission` VALUES ('22','MI','Toto','1.b','13');
INSERT INTO `I_mission` VALUES ('23','MI MI','Toto','1.b','13');
INSERT INTO `I_mission` VALUES ('24','hfghf','fghfg','1.b','13');
INSERT INTO `I_mission` VALUES ('25','mmm','mmm','1.b','13');
INSERT INTO `I_mission` VALUES ('27','ll','llll','1.b','13');
INSERT INTO `I_mission` VALUES ('28','mmm','kp','1.b','13');


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO `J_valeur_metier` VALUES ('1','VMun','Information','VMun','1.b','1');
INSERT INTO `J_valeur_metier` VALUES ('2','VMdeux','Processus','VMdeux','1.b','1');
INSERT INTO `J_valeur_metier` VALUES ('3','Mot de passe','Information','Desc MDP','1.b','2');
INSERT INTO `J_valeur_metier` VALUES ('7','Mot de passe','Information','Des MDP','1.b','13');


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO `K_bien_support` VALUES ('1','BSun','BSun','1.b','1');
INSERT INTO `K_bien_support` VALUES ('2','Clé usb','Desc Clé USB','1.b','2');
INSERT INTO `K_bien_support` VALUES ('3','BSdeux','BSdeux','1.b','1');
INSERT INTO `K_bien_support` VALUES ('7','Disque','Desc disque','1.b','13');


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

INSERT INTO `L_couple_VMBS` VALUES ('1','1','16','test','test');
INSERT INTO `L_couple_VMBS` VALUES ('7','7','23','rere','erer');


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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

INSERT INTO `M_evenement_redoute` VALUES ('1','EVun','EVun','2','2','1','2','EVun','3','1','1.c','1');
INSERT INTO `M_evenement_redoute` VALUES ('2','MonER','Mon ER','2','2','2','2','Loosse','4','3','1.c','2');
INSERT INTO `M_evenement_redoute` VALUES ('6','MonER','Desc ER','1','1','1','1','Impact',NULL,'3','1.c','13');
INSERT INTO `M_evenement_redoute` VALUES ('7','EER','erere','1','1','1','1','impact','4','3','1.c','13');
INSERT INTO `M_evenement_redoute` VALUES ('8','CarlosER','EEEER','1','1','1','1','IIIIII','4','3','1.c','13');
INSERT INTO `M_evenement_redoute` VALUES ('9','ERR','Desc ER','1','1','1','1','Immmmpa','4','3','1.c','13');
INSERT INTO `M_evenement_redoute` VALUES ('10','ERR','etrter','1','1','1','1','erterte','4','3','1.c','13');
INSERT INTO `M_evenement_redoute` VALUES ('11','eee','eee','1','1','1','1','eeee','4','3','1.c','13');
INSERT INTO `M_evenement_redoute` VALUES ('12','EssaiER','erer','2','2','2','2','erer','4','3','1.c','13');
INSERT INTO `M_evenement_redoute` VALUES ('14','ERun','VMun','3','1','2','2','Impactun','4','1','1.c','1');
INSERT INTO `M_evenement_redoute` VALUES ('17','Test','Test','1','2','3','1','Test','3','1','1.c','1');


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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO `N_socle_de_securite` VALUES ('2','Echelle de gravité','Gravité EBIOS RM - Automobile','Non appliqué','e','1.d','1');
INSERT INTO `N_socle_de_securite` VALUES ('3','Référentiel de sécurité','Règles de codage',NULL,NULL,'1.d','2');
INSERT INTO `N_socle_de_securite` VALUES ('4','d','d','Appliqué sans restriction','d','1.d','1');
INSERT INTO `N_socle_de_securite` VALUES ('8','Référentiel de sécurité','Règles de codage',NULL,NULL,'1.d','13');


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

INSERT INTO `O_regle` VALUES ('1','1','G1 – MINEURE','Poursuite de l''exploitation avec une alarme signalant le défaut.','Non traité','a','2020-07-15','a','2');
INSERT INTO `O_regle` VALUES ('2','2','G2 – SIGNIFICATIVE','Poursuite de l''exploitation avec une action opérateur.',NULL,NULL,NULL,NULL,'2');
INSERT INTO `O_regle` VALUES ('3','3','G3 – GRAVE','Arrêt temporaire de l''exploitation puis reprise sous une procédure particulière (exemple : opérateur supplémentaire).',NULL,NULL,NULL,NULL,'2');
INSERT INTO `O_regle` VALUES ('4','4','G4 – CRITIQUE','Arrêt durable de l''exploitation nécessitant une intervention de maintenance.',NULL,NULL,NULL,NULL,'2');
INSERT INTO `O_regle` VALUES ('5','1','RÈGLE — Application de conventions de codage claires et explicites','Des conventions de codage doivent être définies et documentées pour le logiciel à produire. Ces conventions doivent définir au minimum les points suivants : l’encodage des fichiers sources, la mise en page du code et l’indentation, les types standards à utiliser, le nommage (bibliothèques, fichiers, fonctions, types, variables, . . .), le format de la documentation. Ces conventions doivent être appliquées par chaque développeur.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('6','2','RÈGLE — Seul le codage C conforme au standard est autorisé','Aucune violation des contraintes et de la syntaxe C telles que définies dans les standards C90 ou C99 n’est autorisée.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('7','3','RECOMMANDATION — Maîtrise des actions opérées à la compilation.',' Le développeur doit connaître et documenter les actions associées aux options activées du compilateur y compris en terme d’optimisation de code',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('8','4','RÈGLE — Définir précisément les options de compilation','Les options utilisées pour la compilation doivent être précisément définies pour l’ensemble des sources d’un logiciel. Ces options doivent notamment fixer précisément :\n- la version du standard C utilisée (par exemple C99 ou encore C90) ;\n- le nom et la version du compilateur utilisé ;',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('9','RÈGLE — Utiliser des options de durcissement','5','L’utilisation d’options de durcissement est obligatoire que ce soit pour imposer la génération d’exécutables relocalisables, une randomization d’adresses efficace ou la protection contre le dépassement de pile entre autres.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('10','10','RECOMMANDATION — Prêter une attention particulière aux modes debug et release lors de la compilation','L’utilisation des modes debug et release à la compilation doit se faire en toute connaissance des modifications induites en terme de gestion de mémoire et d’optimisation de code. Les différences entre ces deux modes doivent être documentées de manière exhaustive.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('11','11','RECOMMANDATION — Limiter et justifier les inclusions de fichier d''en-tête dans un autre fichier d''en','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('12','12','RECOMMANDATION — Limiter et justifier les inclusions de fichier d''en-tête dans un autre fichier d''en','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('13','13','RÈGLE — Utiliser des macros de garde d''inclusion multiple d''un fichier','Une macro de garde contre l’inclusion multiple d’un fichier doit être utilisée afin d’empêcher que le contenu d’un fichier d’en-tête soit inclus plus d’une fois :\n// début du fichier d''en -tête\n#ifndef HEADER_H\n#define HEADER_H\n/* contenu du fichier */\n#endif\n//fin du fichier d''en -tête',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('14','14','RÈGLE — Les inclusions de fichiers d''en-tête sont groupées en début de fichier','Toutes les inclusions de fichiers d’en-tête doivent être regroupées au début du fichier ou juste après des commentaires ou les directives de preprocessing, mais systématiquement avant la définition de variables globales ou de fonctions.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('15','15','RECOMMANDATION — Les inclusions de fichiers d''en-tête systèmes sont effectuées avant les inclusions ','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('16','16','BONNE PRATIQUE — Utiliser l''ordre alphabétique dans l''inclusion de chaque type de fichiers d''en-tête','Pour éviter les redondances dans les inclusions de fichiers d’en-tête systèmes ou utilisateur, le développeur peut les ordonner par ordre alphabétique ce qui permet d’avoir un ordre d’inclusion déterministe et de faciliter la revue de code.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('17','17','RÈGLE — Ne pas inclure un fichier source dans un autre fichier source','Seule l’inclusion de fichiers d’en-tête est autorisée dans un fichier source.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('18','18','RÈGLE — Les chemins des fichiers doivent être portables et la casse doit être respectée','Les chemins de fichiers, que ce soit pour une directive d’inclusion #include ou non, doivent être portables tout en respectant la casse des répertoires.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('19','19','RÈGLE — Le nom d''un fichier d''en-tête ne doit pas contenir certains caractères ou séquences de carac','Le nom d’un fichier d’en-tête doit être exempt des caractères et des séquences de caractères suivants : « '', ", \\, /* et // ».',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('20','20','RECOMMANDATION — Les blocs préprocesseurs doivent être commentés','Les directives des blocs préprocesseurs doivent être commentées afin d’expliciter le cas traité et pour les directives « intermédiaires » et « fermantes », celles-ci doivent aussi être associées à la directive « ouvrante » correspondante par le biais d’un commentaire.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('21','21','BONNE PRATIQUE — La double négation dans l''expression des conditions des blocs préprocesseurs doit ê','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('22','22','RÈGLE — Définition d''un bloc préprocesseur dans un seul et même fichier','Pour un bloc préprocesseur, toutes les directives associées doivent se trouver dans le même fichier.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('23','23','RECOMMANDATION — Les expressions de contrôle des directives de preprocessing doivent être bien formé','Les expressions de contrôle doivent être évaluées uniquement à 0 ou 1 et doivent utiliser uniquement des identifiants définis (via #define).',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('24','24','RÈGLE — Ne pas utiliser dans une même expression plus d''un des opérateurs de preprocessing # et ##','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('25','25','RÈGLE — Utiliser les opérateurs de preprocessing # et ## en maîtrisant leur expansion','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('26','26','RÈGLE — Les macros doivent être nommées de façon spécifique','Pour différencier aisément les macros des fonctions et ne pas utiliser un nom réservé d’une autre macro C, les macros préprocesseurs doivent être en capitales et les mots composant le nom séparés par le caractère souligné « _ » mais sans les faire débuter par le caractère souligné car il s’agit d’une convention pour les noms réservés du langage C.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('27','27','RÈGLE — Ne pas terminer une macro par un point-virgule','Le point-virgule final doit être omis à la fin de la définition d’une macro.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('28','28','Le point-virgule final doit être omis à la fin de la définition d’une macro.','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('29','29','RÈGLE — L''expansion d''une macro définie par le développeur ne doit pas créer de fonction','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('30','30','RÈGLE — Les macros contenant plusieurs instructions doivent utiliser une boucle do { ... } while(0) ','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('31','31','RÈGLE — Parenthèses obligatoires autour des paramètres utilisés dans le corps d''une macro','Les paramètres d’une macro doivent systématiquement être entourés de parenthèses lors de leur utilisation, afin de préserver l’ordre souhaité d’évaluation des expressions.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('32','32','RECOMMANDATION — Il faut éviter les arguments d''une macro réalisant une opération','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('33','33','RÈGLE — Les arguments d''une macro ne doivent pas contenir d''effets de bord.','Des arguments de macro avec des effets de bord peuvent entraîner des évaluations multiples non désirées.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('34','34','RÈGLE — Ne pas utiliser de directives de preprocessing en arguments d''une macro','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('35','35','RÈGLE — La directive #undef ne doit pas être utilisée','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('36','36','RÈGLE — Ne pas utiliser de trigraphes','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('37','37','RECOMMANDATION — Les points d''interrogation ne doivent pas être utilisés de façon successive','Cette règle s’applique pour toute partie du code mais aussi pour les commentaires.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('38','38','RECOMMANDATION — Seules les déclarations multiples de variables simples de même type sont autorisées','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('39','39','RÈGLE — Ne pas faire de déclaration multiple de variables associée à une initialisation.','Les initialisations associées (i.e. consécutives et dans une même instruction) à une déclaration multiple sont interdites.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('40','40','RECOMMANDATION — Regrouper les déclarations de variables en début du bloc dans lequel elles sont uti','Pour des questions de lisibilité et pour éviter les redéfinitions, les déclarations de variables sont regroupées en début de fichier, fonction ou bloc d’instructions selon leur portée.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('41','41','RÈGLE — Ne pas utiliser des valeurs en dur','Les valeurs utilisées dans le code doivent être déclarées comme des constantes.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('42','42','BONNE PRATIQUE — Centraliser la déclaration des constantes en début de fichier','Pour faciliter la lecture, les constantes sont déclarées ensemble en début du fichier.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('43','43','RÈGLE — Déclarer les constantes en capitales','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('44','44','RÈGLE — Les constantes sans contrôle de type sont déclarées avec la macro préprocesseur de définitio','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('45','45','RÈGLE — Les constantes avec un contrôle de type explicite doivent être déclarées avec le mot clé con','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('46','46','RÈGLE — Les valeurs constantes doivent être associées à un suffixe dépendant du type','Pour éviter toute mauvaise interprétation, les valeurs constantes doivent utiliser un suffixe selon leurs types :\n il faut utiliser le suffixe U pour toutes les constantes de type entier non signé ; \n pour indiquer une constante de type long (ou long long pour C99), il faut utiliser le suffixe L (resp. LL) et non l (resp. ll) afin d’éviter toute ambiguïté avec le chiffre 1 ;\n les valeurs flottantes sont par défaut considérées comme double, il faut utiliser le suffixe f pour le type float (resp. d pour le type double).',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('47','47','RÈGLE — La taille du type associé à une expression constante doit être suffisante pour la contenir','Il faut s’assurer que les valeurs ou expressions constantes utilisées ne dépassent pas du type qui leur est associé.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('48','48','RECOMMANDATION — Proscrire les constantes en octal','Ne pas utiliser de constante ni de séquence d’échappement en octal.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('49','49','RÈGLE — Limiter les variables globales au strict nécessaire','Limiter l’usage des variables globales et préférer les paramètres de fonctions pour propager une structure de données au travers d’une application.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('50','50','RÈGLE — Utilisation systématique du modificateur de déclaration static','Utiliser le mot clef static pour toutes les fonctions et variables globales qui ne sont pas utilisées à l’extérieur du fichier source dans lequel elles sont définies.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('51','51','RÈGLE — Seules les variables modifiables en dehors de l''implémentation doivent être déclarées volati','Seules les variables associées à des ports entrée/sortie ou des fonctions d’interruption asynchrone doivent être déclarées comme volatile pour empêcher toute optimisation ou réorganisation à la compilation.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('52','52','RÈGLE — Seuls des pointeurs spécifiés volatile peuvent accéder à des variables volatile','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('53','53','RÈGLE — Aucune omission de type n''est acceptée lors de la déclaration d''une variable','Toutes les variables utilisées doivent avoir été préalablement déclarées de façon explicite.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('54','54','RECOMMANDATION — Limiter l''utilisation des compound literals','Du fait du risque de mauvaise manipulation des compound literals, leur utilisation doit être limitée, documentée et une attention particulière doit être donnée à leur portée.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('55','55','RÈGLE — Ne pas mélanger des constantes explicites et implicites dans une énumération','Il faut soit expliciter toutes les constantes d’une énumération avec une valeur unique soit n’en expliciter aucune.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('56','56','RÈGLE — Ne pas utiliser des énumérations anonymes','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('57','57','RECOMMANDATION — Les variables doivent être initialisées à la déclaration ou immédiatement après','Toutes les variables doivent être systématiquement initialisées à leur déclaration ou immédiatement après dans le cas de déclarations multiples.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('58','58','RÈGLE — Ne pas mélanger les différents types d''initialisation pour les variables structurées','Pour l’initialisation d’une variable structurée, un seul et unique type d’initialisation doit être choisi et utilisé.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('59','59','RÈGLE — Les variables structurées ne doivent pas être initialisées sans expliciter la valeur d''initi','Les variables non scalaires doivent être initialisées explicitement : chaque élément doit être initialisé en étant clairement identifié sans valeur d’initialisation superflue ou la notation ={0} ; peut être utilisée à la déclaration. Enfin les tailles des tableaux doivent être explicitées à l’initialisation.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('60','60','RECOMMANDATION — Chaque déclaration publique (non static) doit être utilisée','Toutes les déclarations publiques (i.e. non static) doivent être utilisées, qu’il s’agissede variables, fonctions, labels ou autres.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('61','61','RÈGLE — Utiliser des variables pour les données sensibles distinctes des variables pour les données ','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('62','62','RÈGLE — Utiliser des variables pour les données sensibles et protégées en confidentialité et/ou inté','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('63','63','RÈGLE — Ne jamais coder en dur une donnée sensible.','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('64','64','RECOMMANDATION — Seuls des types d''entiers dont la taille et le signe sont explicites doivent être u','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('65','65','RÈGLE — Seuls les types signed char et unsigned char doivent être utilisés.','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('66','66','RECOMMANDATION — Ne pas redéfinir des alias de types','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('67','67','RÈGLE — Compréhension fine et précise des règles de conversions','Le développeur se doit de connaître et comprendre toutes les règles de conversionimplicites des types entiers.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('68','68','RÈGLE — Conversions explicites entre des types signés et non signés','Proscrire les conversions implicites de types. Utiliser des conversions explicites notamment entre type signé et type non signé.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('69','69','RECOMMANDATION — Ne pas utiliser de transtypage de pointeurs sur des types structurés différents','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('70','70','RÈGLE — L''accès aux éléments d''un tableau se fera toujours en désignant en premier attribut le table','L’accès au ième élément d’un tableau s’écrira toujours avec le nom du tableau en premier suivi de l’indice de la case à atteindre.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('71','71','RECOMMANDATION — L''accès aux éléments d''un tableau doit se faire en utilisant les crochets','Dans le cas d’une variable de type tableau, la notation dédiée (via les crochets) doit être utilisée pour éviter toute ambiguïté.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('72','72','RÈGLE — Ne pas utiliser de VLA','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('73','73','RECOMMANDATION — Ne pas utiliser de taille implicite pour les tableaux','Afin de s’assurer que les accès tableaux sont bien valides, la taille de ceux-ci doit être explicitée.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('74','74','RÈGLE — Utiliser des entiers non signés pour les tailles de tableaux','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('75','75','RÈGLE — Ne pas accèder à un élément de tableau sans vérifier la validité de l''indice utilisé','La validité des indices de tableau utilisés doit être vérifié de façon systématique : un indice de tableau est valide s’il est supérieur ou égal à zéro et strictement inférieur à la taille déclarée du tableau. Dans le cas d’un tableau de caractères, le caractère de fin de chaine ’\\0’ doit être pris en compte.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('76','76','RÈGLE — Un pointeur NULL ne doit pas être déréférencé','Avant de déréférencer un pointeur, le développeur doit s’assurer que celui-ci n’est pas NULL.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('77','77','RÈGLE — Un pointeur doit être affecté à NULL après désallocation','Un pointeur doit être systématiquement affecté à NULL suite à la désallocation de la mémoire qu’il pointe.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('78','78','RÈGLE — Ne pas utiliser le qualificateur de pointeur restrict','Le qualificateur restrict ne doit pas être utilisé directement par le développeur. Seule l’utilisation indirecte i.e. via l’appel de fonctions de la bibliothèque standard est tolérée mais le développeur devra s’assurer qu’aucun comportement indéfini résultera de l’utilisation de telles fonctions.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('79','79','RECOMMANDATION — Le nombre de niveau d''indirections de pointeur doit être limité à deux','Le nombre d’indirections pour un pointeur ne doit pas dépasser deux niveaux.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('80','80','RECOMMANDATION — Préférer l''utilisation de l''opérateur d''indirection ->','L’opérateur d’indirection -> doit être utilisé pour atteindre les champs d’une structure par l’intermédiaire d’un pointeur.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('81','81','RÈGLE — Seul l''incrément ou le décrément de pointeurs de tableaux est autorisé','L’incrément ou le décrément de pointeurs ne doit être utilisé que sur des pointeurs représentant un tableau ou un élément d’un tableau.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('82','82','RÈGLE — Aucune arithmétique sur les pointeurs void* n''est autorisée','Il faut proscrire l’utilisation de toute arithmétique sur des pointeurs de type void*.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('83','83','RECOMMANDATION — Arithmétique des pointeurs sur tableaux contrôlée','L’arithmétique sur des pointeurs représentant un tableau ou un élément d’un tableau doit être faite en s’assurant que le pointeur résultant pointera toujours sur un élément du même tableau.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('84','84','RÈGLE — Soustraction et comparaison entre pointeurs d''un même tableau uniquement','Seules les soustractions et comparaisons de pointeurs sur un même tableau sont autorisés.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('85','85','RECOMMANDATION — Il ne faut pas affecter directement une adresse fixe à un pointeur.','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('86','86','RÈGLE — Une structure doit être utilisée pour regrouper les données représentant une même entité','Les données liées doivent être regroupées au sein d’une structure.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('87','87','RÈGLE — Ne pas calculer la taille d''une structure comme la somme de la taille de ses champs','Du fait du padding, la taille d’une structure ne doit pas être supposée comme la somme de la taille de ses champs.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('88','88','RÈGLE — Tout bitfield doit obligatoirement être déclaré explicitement comme non signé','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('89','89','RÈGLE — Ne pas faire d''hypothèse sur la représentation interne de structures avec des bitfields','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('90','90','RÈGLE — Ne pas utiliser les FAM','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('91','91','RECOMMANDATION — Ne pas utiliser les unions','L’utilisation du même espace mémoire pour plusieurs données de natures différentes n’est pas autorisée.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('92','92','RÈGLE — Supprimer tous les débordements de valeurs possibles pour des entiers signés.','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('93','93','RECOMMANDATION — Détecter tous les wraps possibles de valeurs pour les entiers non signés.','vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('94','94','RÈGLE — Détecter et supprimer toute potentielle division par zéro','Cette vérification doit être systématique pour tout calcul de division ou de reste de division.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('95','95','RECOMMANDATION — Les opérations arithmétiques doivent être écrites en favorisant leur lisibilité','Il faut utiliser des opérations arithmétiques le plus explicites possibles (naturelles) et dans la logique du programme.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('96','96','RECOMMANDATION — Les opérateurs logiques ne doivent pas être appliqués avec des opérandes signés','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('97','97','RÈGLE — Explicitation de l''ordre d''évaluation des calculs par utilisation de parenthèses','Malgré la priorité des opérateurs, pour éviter toute ambiguïté, les expressions seront entourées de parenthèses pour rendre plus explicite l’ordre d’évaluation d’un calcul.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('98','98','RECOMMANDATION — Eviter les expressions de comparaison ou d''égalité multiple','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('99','99','RÈGLE — Toujours utiliser les parenthèses dans les expressions de comparaison ou d''égalité multiple','Les expressions booléennes de comparaison ou d’égalité contenant au moins 2 opérateurs relationnels sont interdites sans parenthèse.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('100','100','RÈGLE — Parenthèses autour des éléments d''une expression booléenne','Il est nécessaire de toujours mettre entre parenthèses les différents éléments d’une expression booléenne, afin qu’il n’y ait aucune ambiguïté dans l’ordre d’évaluation.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('101','101','RÈGLE — Comparaison implicite avec 0 interdite','Toutes les expressions booléennes doivent utiliser des opérateurs de comparaison. Aucun test implicite avec une valeur égale à 0 ou différente de 0 ne doit être effectué.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('102','102','RECOMMANDATION — Utilisation du type bool en C99','En C99, le type bool (ou _Bool) doit être utilisé pour les variables à valeurs booléennes.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('103','103','RÈGLE — Pas d''opérateur bit-à-bit sur un opérande de type booléen ou assimilé','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('104','104','BONNE PRATIQUE — Ne pas utiliser la valeur retournée lors d''une affectation','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('105','105','RÈGLE — Affectation interdite dans une expression booléenne','Une affectation ne doit pas être effectuée dans une expression booléenne quelle qu’elle soit. Une affectation doit être effectuée dans une instruction indépendante.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('106','106','BONNE PRATIQUE — Comparaison avec opérande constant à gauche','Quand une comparaison fait intervenir un opérande constant celui-ci sera de préférence mis comme opérande gauche pour éviter une affectation non intentionnelle.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('107','107','RÈGLE — Affectation multiple de variables interdite','L’affectation multiple de variables n’est pas autorisée.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('108','108','RÈGLE — Une seule instruction par ligne de code','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('109','110','RECOMMANDATION — Limiter l''utilisation des nombres flottants au strict nécessaire','Il faut limiter l’utilisation des nombres flottants.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('110','111','RÈGLE — Pas de compteur de boucle de type flottant','Les compteurs de boucle doivent être uniquement de type entier, avec la vérification de non débordement de type des valeurs des compteurs.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('111','112','RÈGLE — Ne pas utiliser de nombres flottants pour des comparaisons d''égalité ou d''inégalité','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('112','113','RECOMMANDATION — Non utilisation des nombres complexes','Les nombres complexes introduits depuis C99 ne doivent pas être utilisés.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('113','114','RÈGLE — Utilisation systématique des accolades pour les conditionnelles et les boucles','Ne jamais omettre les accolades pour délimiter un bloc d’instructions. Les accolades doivent être écrites pour délimiter un bloc d’instructions après les boucles (for, while, do) et les conditionnelles (if, else).',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('114','115','RÈGLE — Définition systématique d''un cas par défaut dans les switch','Un switch-case doit toujours contenir un cas default placé en dernier.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('115','116','RECOMMANDATION — Utilisation de break dans chaque cas des instructions switch','Un switch-case doit par défaut toujours contenir un break pour chaque cas. L’absence de break pour éviter de dupliquer du code est tolérée mais doit être explicitée dans un commentaire.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('116','117','RECOMMANDATION — Pas d''imbrication de structure de contrôle dans un switch-case',' Même si le C l’autorise, l’imbrication de structures de contrôle à l’intérieur d’un switch est à éviter.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('117','118','RÈGLE — Ne pas introduire d''instructions avant le premier label d''un switch-case','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('118','119','RÈGLE — Bonne construction des boucles for','Chaque élément d’une boucle for doit être complété et contenir exactement une seule instruction. Ainsi une boucle for doit contenir une initialisation de son compteur, une condition d’arrêt portant sur son compteur, et une incrémentation ou décrémentation du compteur de boucle.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('119','120','RÈGLE — Modification d''un compteur d''une boucle for interdite dans le corps de la boucle','Le compteur d’une boucle for ne doit pas être modifié à l’intérieur du corps de la boucle for.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('120','121','RÈGLE — Non utilisation de goto arrière (backward goto)','Proscrire, au sein d’une fonction, l’utilisation d’instructions goto renvoyant vers un label qui est placé avant cette instruction goto.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('121','122','RECOMMANDATION — Utilisation limitée du saut avant (forward goto)','L’utilisation d’un forward goto est tolérée uniquement dans les cas où elle permet :\n de limiter significativement le nombre de points de sortie de la fonction ;\n de rendre le code beaucoup plus lisible.\nLe ou les labels référencés par les instructions goto doivent tous être situés en fin de fonction.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('122','123','RÈGLE — Toute fonction (non static) définie doit possèder une déclaration/ prototype de fonction','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('123','124','RÈGLE — Le prototype de déclaration d''une fonction doit concorder avec sa définition','Les types des paramètres utilisés pour la définition et la déclaration d’une fonction doivent être les mêmes.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('124','125','RÈGLE — Toute fonction doit être associée à un type de retour et à une liste de paramètres explicite','Chaque fonction est définie explicitement avec un type de retour. Les fonctions sans valeur de retour doivent être déclarées avec un paramètre du type void. De la même façon, une fonction sans paramètre devra être définie et déclarée avec void en argument.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('125','126','RECOMMANDATION — Documentation des fonctions','Tous les fonctions doivent être documentées. Cela comprend :\nn une description de la fonction et du traitement effectué ;\n la documentation de chaque paramètre, le sens du paramètre (en entrée, en sortie, en entrée et en sortie) et les éventuelles conditions existant sur celui-ci ;\n les valeurs de retour possibles doivent être décrites.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('126','127','RECOMMANDATION — Préciser les conditions d''appel pour chaque fonction','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('127','128','RÈGLE — La validité de tous les paramètres d''une fonction doit systématiquement être remise en cause','Cela inclut :\n la validité des adresses pour les paramètres de type pointeur doit être vérifiée (non , alignement des adresses conforme...) ;\n l’appartenance des paramètres à leur domaine doit être vérifiée.\nCela s’applique aux fonctions définies par le développeur (cf. section 12.2) mais aussi aux fonctions de la bibliothèque standard.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('128','129','RÈGLE — Les paramètres de fonction de type pointeur pour lesquels la zone mémoire pointée n''est pas ','Marquer const tous les paramètres de type pointeur d’une fonction qui pointent vers une zone mémoire qui ne doit pas être modifiée dans le corps de celle-ci. Le qualificateur const doit s’appliquer à l’objet pointé.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('129','130','RÈGLE — Les fonctions inline doivent être déclarées comme static','Pour éviter un comportement non défini une fonction inline est systématiquement static.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('130','131','RÈGLE — Interdiction de redéfinir les fonctions ou macros de la bibliothèque standard ou d''une autre','Les identifiants, macros ou noms de fonctions faisant partie de la bibliothèque standard ou d’une autre bibliothèque utilisée ne doivent pas être redéfinis.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('131','132','RÈGLE — La valeur de retour d''une fonction doit toujours être testée','Lorsqu’une fonction retourne une valeur, la valeur retournée doit être systématiquement testée.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('132','133','RÈGLE — Retour implicite interdit pour les fonctions de type non void','Tous les chemins d’une fonction non void doivent retourner une valeur explicitement.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('133','134','RÈGLE — Les structures doivent être passées par référence à une fonction','Il ne faut pas passer de paramètres de type structure par copie lors de l’appel d’une fonction.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('134','135','RECOMMANDATION — Passage d''un tableau en paramètre d''une fonction','Il existe plusieurs façons de passer un tableau en paramètre d’une fonction. Lors du passage par pointeur, il faut préciser dans la documentation de la fonction que le paramètre correspond à un tableau et également utiliser la notation dédiée aux tableaux.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('135','136','RECOMMANDATION — Utilisation obligatoire dans une fonction de tous ses paramètres','Tous les paramètres présents dans le prototype de la fonction doivent être utilisés dans son implémentation.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('136','137','BONNE PRATIQUE — Utiliser les options de compilation -Wformat=2 et -Wformat-security dès qu''une fonc','Plus de détails sur ces options sont données en annexe B.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('137','138','RÈGLE — Ne pas appeler de fonctions variadiques avec NULL en argument','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('138','139','RÈGLE — Usage de la virgule interdit pour le séquencement d''instructions','La virgule n’est pas autorisée dans le cadre du séquencement des instructions decode.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('139','140','RECOMMANDATION — Les opérateurs pré-fixes ++ et -- ne doivent pas être utilisés','Les opérateurs de pré-incrémentation et pré-decrémentation ne seront pas utilisés.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('140','141','RECOMMANDATION — Pas d''utilisation combinée des opérateurs postfixes avec d''autres opérateurs','Les opérateurs de post-incrémentation et de post-décrémentation ne doivent pas être mixés avec d’autres opérateurs.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('141','142','RECOMMANDATION — Éviter l''utilisation d''opérateurs d''affectation combinés','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('142','143','RÈGLE — Non utilisation imbriquée de l''opérateur ternaire ?:','L’imbrication d’opérateurs ternaires ?: est interdite.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('143','144','RÈGLE — Bonne construction des expressions avec l''opérateur ternaire ?:','Les expressions résultantes de l’opérateur ternaire ?: doivent être exactement de même type pour éviter tout transtypage.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('144','145','RÈGLE — Allouer dynamiquement un espace mémoire dont la taille est suffisante pour l''objet alloué','Pour un pointeur ptr, on préférera utiliser ptr=malloc(sizeof(*ptr)); quand cela est possible.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('145','146','RÈGLE — Libérer la mémoire allouée dynamiquement au plus tôt','Tout espace mémoire alloué dynamiquement doit être libéré quand celui-ci n’est plus utile.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('146','147','RÈGLE — Les zones mémoires sensibles doivent être mises à zéro avant d''être libérées.','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('147','148','RÈGLE — Ne pas libérer de mémoire non allouée dynamiquement','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('148','149','RÈGLE — Ne pas modifier l''allocation dynamique via realloc','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('149','150','RÈGLE — Bonne utilisation de l''opérateur sizeof','Une expression contenue dans un sizeof ne doit pas :\n contenir l’opérateur « = » car l’expression ne sera pas évaluée ; \n contenir de déréférencement de pointeur ;\n être appliqué sur un pointeur représentant un tableau.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('150','151','RÈGLE — Vérification obligatoire du succès d''une allocation mémoire','Le succès d’une allocation mémoire doit toujours être vérifié.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('151','152','RÈGLE — L''isolement des données sensibles doit être effectué','Contrôler le bon usage d’une zone mémoire stockant des données sensibles i.e. minimiser l’exposition en mémoire, minimiser la copie et effacer la/les zones ayant contenu les données sensibles au plus tôt.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('152','153','RÈGLE — Initialiser et consulter la valeur de errno avant et après toute exécution d''une fonction de','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('153','154','RÈGLE — La gestion des erreurs retournées par une fonction de la bibliothèque standard doit être sys','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('154','155','RÈGLE — Documentation des codes d''erreur','Tous les codes d’erreur retournés par une fonction doivent être documentés. Dans le cas où plusieurs codes d’erreur peuvent être retournés en même temps par la fonction, la documentation doit définir la priorité de gestion de ces codes.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('155','156','RECOMMANDATION — Structuration des codes de retour','Les codes de retour doivent être structurés de façon à pouvoir obtenir rapidement une information concernant le déroulement de la fonction appelée : \n erreur ; \n type d’erreur ; \n alarme ; \n type d’alarme ; \n ok ;',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('156','157','RÈGLE — Code de retour d''un programme C en fonction du résultat de son exécution','Le code de retour d’un programme C doit avoir une signification afin d’indiquer le bon déroulement du programme ou la survenue d’une erreur : \n la valeur du code de retour doit être comprise entre 0 et 127 ; \n la valeur 0 indique que le programme s’est exécuté sans erreur ;\n la valeur 2 est généralement utilisée sous Unix pour indiquer une erreur dans les arguments passés en paramètres au programme. \nLa signification des codes de retour du programme doit être indiquée dans sa documentation.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('157','158','RECOMMANDATION — Privilégier les retours d''erreurs via des codes de retour dans la fonction principa','Un programme C doit disposer d’une fonction main() minimale. Les retours d’erreurs se font par un retour de code dédié (et donc documenté) de cette fonction.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('158','159','RÈGLE — Ne pas utiliser les fonctions abort() ou _Exit()','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('159','160','RECOMMANDATION — Limiter les appels à exit()','Les appels à la fonction exit() doivent être commentés et non systématiques. Le développeur doit le plus souvent possible les remplacer par un retour de code d’erreur  dans la fonction principale.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('160','161','RÈGLE — Ne pas utiliser les fonctions setjmp() et longjump()','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('161','162','RÈGLE — Ne pas utiliser les bibliothèques standards setjmp.h et stdarg.h','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('162','163','RECOMMANDATION — Limiter l''utilisation des bibliothèques standards manipulant des nombres flottants','Les bibliothèques standards float.h, fenv.h, complex.h et math.h ne doivent être utilisées que si cela est vraiment nécessaire.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('163','164','RÈGLE — Ne pas utiliser les fonctions atoi() atol() atof() et atoll() de la bibliothèque stdlib.h','Les fonctions équivalentes strto*() sont à utiliser en remplacement.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('164','165','RÈGLE — Ne pas utiliser la fonction rand() de la bibliothèque standard','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('165','166','RÈGLE — Utiliser les versions « plus sécurisées » pour les fonctions de la bibliothèque standard','Quand des fonctions de la bibliothèque standard existent en différentes versions, la version « plus sécurisée » doit être utilisée.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('166','167','RÈGLE — Ne pas utiliser de fonctions de la bibliothèque obsolescentes ou devenues obsolètes dans des','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('167','168','RÈGLE — Ne pas utiliser de fonctions de la bibliothèque manipulant des buffers sans prendre la taill','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('168','169','BONNE PRATIQUE — Tout code doit être soumis à relecture','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('169','170','RECOMMANDATION — Indentation des expressions longues','Lorsqu’une instruction ou une expression s’étale sur plusieurs lignes, il est indispensable de l’indenter afin de faciliter la compréhension du code.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('170','171','RÈGLE — Identifier et supprimer tout code mort','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('171','172','RÈGLE — Le code doit être exempt de code non atteignable en dehors de code défensif et de code d''int','Il ne doit jamais y avoir de code inatteignable, sauf s’il s’agit de code défensif ou s’il s’agit de code d’une interface et dans ces deux cas, il faut le préciser en commentaire.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('172','173','RECOMMANDATION — Evaluation outillée du code source pour limiter les risques d''erreurs d''exécution','Le code source du logiciel doit être analysé via au moins un outil d’analyse de code. Les résultats produits par l’outil d’analyse doivent être étudiés par le développeur et les corrections doivent être effectuées par rapport aux problèmes découverts.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('173','174','RECOMMANDATION — Limitation de la complexité cyclomatique','La complexité cyclomatique d’une fonction doit être limitée au maximum.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('174','175','RECOMMANDATION — Limitation de la longueur et la complexité d''une fonction','Une fonction doit être associée idéalement à un seul et unique traitement et doit donc correspondre à un nombre de lignes de code raisonnable.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('175','176','RÈGLE — Ne pas utiliser de mots clés du C++','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('176','177','RÈGLE — Séquences de caractères interdites dans les commentaires','Les séquences /* et // sont interdites dans tous les commentaires. Et un commentaire sur une ligne introduit par // ne doit pas contenir de caractère de continuation de ligne \\.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('177','178','RÈGLE — Mise en oeuvre manuelle de mécanismes « canari » si les options de durcissement ne sont pas ','Vide',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('178','179','RÈGLE — Pas d''assertions de mise au point sur un code mis en production','Les assertions de mise au point ne doivent pas être présentes en production.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('179','180','RECOMMANDATION — La gestion des assertions d''intégrité doit inclure un effacement des données d''urge','Les assertions d’intégrité doivent apparaître en production. En cas de déclenchement d’une assertion d’intégrité, le code de traitement doit aboutir à un effacement d’urgence des données sensibles.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('180','181','RÈGLE — Tout fichier non vide doit se terminer par un retour à la ligne et les directives de preproc','Un fichier non vide ne doit pas se terminer au milieu d’un commentaire ou d’une directive de preprocessing.',NULL,NULL,NULL,NULL,'3');
INSERT INTO `O_regle` VALUES ('181','182','NewTitre','NewDesc','','','0000-00-00','','3');
INSERT INTO `O_regle` VALUES ('182','183','a','a','','','0000-00-00','','3');
INSERT INTO `O_regle` VALUES ('183','e','e','e','Non traité','e','2020-07-30','e','4');
INSERT INTO `O_regle` VALUES ('184','184','Titre','Desc','','','0000-00-00','','3');
INSERT INTO `O_regle` VALUES ('220','1','RÈGLE — Application de conventions de codage claires et explicites','Des conventions de codage doivent être définies et documentées pour le logiciel à produire. Ces conventions doivent définir au minimum les points suivants : l’encodage des fichiers sources, la mise en page du code et l’indentation, les types standards à utiliser, le nommage (bibliothèques, fichiers, fonctions, types, variables, . . .), le format de la documentation. Ces conventions doivent être appliquées par chaque développeur.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('221','2','RÈGLE — Seul le codage C conforme au standard est autorisé','Aucune violation des contraintes et de la syntaxe C telles que définies dans les standards C90 ou C99 n’est autorisée.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('222','3','RECOMMANDATION — Maîtrise des actions opérées à la compilation.',' Le développeur doit connaître et documenter les actions associées aux options activées du compilateur y compris en terme d’optimisation de code',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('223','4','RÈGLE — Définir précisément les options de compilation','Les options utilisées pour la compilation doivent être précisément définies pour l’ensemble des sources d’un logiciel. Ces options doivent notamment fixer précisément :\n- la version du standard C utilisée (par exemple C99 ou encore C90) ;\n- le nom et la version du compilateur utilisé ;',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('224','RÈGLE — Utiliser des options de durcissement','5','L’utilisation d’options de durcissement est obligatoire que ce soit pour imposer la génération d’exécutables relocalisables, une randomization d’adresses efficace ou la protection contre le dépassement de pile entre autres.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('225','6','BONNE PRATIQUE — Utiliser des générateurs de projets pour la compilation.','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('226','7','RÈGLE — Compiler le code sans erreur ni avertissement en activant des options de compilation exigent','Activer le niveau d’avertissement et d’erreur le plus élevé du compilateur et de l’éditeur de liens afin de s’assurer de l’absence de problèmes potentiels liés à l’utilisation incorrecte du langage de programmation et traiter tous les avertissements et toutes les erreurs signalés par le compilateur et l’éditeur de liens pour les éliminer.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('227','8','RECOMMANDATION — Utiliser les options des compilations les plus exigentes','Si une option élevée d’un compilateur n’apparaît pas pertinente pour un développement donné, une justification sera fournie pour expliquer ce choix.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('228','9','RÈGLE — Tout code mis en production doit être compilé en mode release','La compilation en mode release est obligatoire pour une mise en production.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('229','10','RECOMMANDATION — Prêter une attention particulière aux modes debug et release lors de la compilation','L’utilisation des modes debug et release à la compilation doit se faire en toute connaissance des modifications induites en terme de gestion de mémoire et d’optimisation de code. Les différences entre ces deux modes doivent être documentées de manière exhaustive.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('230','11','RECOMMANDATION — Limiter et justifier les inclusions de fichier d''en-tête dans un autre fichier d''en','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('231','12','RECOMMANDATION — Limiter et justifier les inclusions de fichier d''en-tête dans un autre fichier d''en','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('232','13','RÈGLE — Utiliser des macros de garde d''inclusion multiple d''un fichier','Une macro de garde contre l’inclusion multiple d’un fichier doit être utilisée afin d’empêcher que le contenu d’un fichier d’en-tête soit inclus plus d’une fois :\n// début du fichier d''en -tête\n#ifndef HEADER_H\n#define HEADER_H\n/* contenu du fichier */\n#endif\n//fin du fichier d''en -tête',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('233','14','RÈGLE — Les inclusions de fichiers d''en-tête sont groupées en début de fichier','Toutes les inclusions de fichiers d’en-tête doivent être regroupées au début du fichier ou juste après des commentaires ou les directives de preprocessing, mais systématiquement avant la définition de variables globales ou de fonctions.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('234','15','RECOMMANDATION — Les inclusions de fichiers d''en-tête systèmes sont effectuées avant les inclusions ','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('235','16','BONNE PRATIQUE — Utiliser l''ordre alphabétique dans l''inclusion de chaque type de fichiers d''en-tête','Pour éviter les redondances dans les inclusions de fichiers d’en-tête systèmes ou utilisateur, le développeur peut les ordonner par ordre alphabétique ce qui permet d’avoir un ordre d’inclusion déterministe et de faciliter la revue de code.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('236','17','RÈGLE — Ne pas inclure un fichier source dans un autre fichier source','Seule l’inclusion de fichiers d’en-tête est autorisée dans un fichier source.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('237','18','RÈGLE — Les chemins des fichiers doivent être portables et la casse doit être respectée','Les chemins de fichiers, que ce soit pour une directive d’inclusion #include ou non, doivent être portables tout en respectant la casse des répertoires.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('238','19','RÈGLE — Le nom d''un fichier d''en-tête ne doit pas contenir certains caractères ou séquences de carac','Le nom d’un fichier d’en-tête doit être exempt des caractères et des séquences de caractères suivants : « '', ", \\, /* et // ».',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('239','20','RECOMMANDATION — Les blocs préprocesseurs doivent être commentés','Les directives des blocs préprocesseurs doivent être commentées afin d’expliciter le cas traité et pour les directives « intermédiaires » et « fermantes », celles-ci doivent aussi être associées à la directive « ouvrante » correspondante par le biais d’un commentaire.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('240','21','BONNE PRATIQUE — La double négation dans l''expression des conditions des blocs préprocesseurs doit ê','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('241','22','RÈGLE — Définition d''un bloc préprocesseur dans un seul et même fichier','Pour un bloc préprocesseur, toutes les directives associées doivent se trouver dans le même fichier.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('242','23','RECOMMANDATION — Les expressions de contrôle des directives de preprocessing doivent être bien formé','Les expressions de contrôle doivent être évaluées uniquement à 0 ou 1 et doivent utiliser uniquement des identifiants définis (via #define).',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('243','24','RÈGLE — Ne pas utiliser dans une même expression plus d''un des opérateurs de preprocessing # et ##','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('244','25','RÈGLE — Utiliser les opérateurs de preprocessing # et ## en maîtrisant leur expansion','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('245','26','RÈGLE — Les macros doivent être nommées de façon spécifique','Pour différencier aisément les macros des fonctions et ne pas utiliser un nom réservé d’une autre macro C, les macros préprocesseurs doivent être en capitales et les mots composant le nom séparés par le caractère souligné « _ » mais sans les faire débuter par le caractère souligné car il s’agit d’une convention pour les noms réservés du langage C.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('246','27','RÈGLE — Ne pas terminer une macro par un point-virgule','Le point-virgule final doit être omis à la fin de la définition d’une macro.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('247','28','Le point-virgule final doit être omis à la fin de la définition d’une macro.','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('248','29','RÈGLE — L''expansion d''une macro définie par le développeur ne doit pas créer de fonction','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('249','30','RÈGLE — Les macros contenant plusieurs instructions doivent utiliser une boucle do { ... } while(0) ','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('250','31','RÈGLE — Parenthèses obligatoires autour des paramètres utilisés dans le corps d''une macro','Les paramètres d’une macro doivent systématiquement être entourés de parenthèses lors de leur utilisation, afin de préserver l’ordre souhaité d’évaluation des expressions.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('251','32','RECOMMANDATION — Il faut éviter les arguments d''une macro réalisant une opération','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('252','33','RÈGLE — Les arguments d''une macro ne doivent pas contenir d''effets de bord.','Des arguments de macro avec des effets de bord peuvent entraîner des évaluations multiples non désirées.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('253','34','RÈGLE — Ne pas utiliser de directives de preprocessing en arguments d''une macro','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('254','35','RÈGLE — La directive #undef ne doit pas être utilisée','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('255','36','RÈGLE — Ne pas utiliser de trigraphes','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('256','37','RECOMMANDATION — Les points d''interrogation ne doivent pas être utilisés de façon successive','Cette règle s’applique pour toute partie du code mais aussi pour les commentaires.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('257','38','RECOMMANDATION — Seules les déclarations multiples de variables simples de même type sont autorisées','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('258','39','RÈGLE — Ne pas faire de déclaration multiple de variables associée à une initialisation.','Les initialisations associées (i.e. consécutives et dans une même instruction) à une déclaration multiple sont interdites.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('259','40','RECOMMANDATION — Regrouper les déclarations de variables en début du bloc dans lequel elles sont uti','Pour des questions de lisibilité et pour éviter les redéfinitions, les déclarations de variables sont regroupées en début de fichier, fonction ou bloc d’instructions selon leur portée.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('260','41','RÈGLE — Ne pas utiliser des valeurs en dur','Les valeurs utilisées dans le code doivent être déclarées comme des constantes.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('261','42','BONNE PRATIQUE — Centraliser la déclaration des constantes en début de fichier','Pour faciliter la lecture, les constantes sont déclarées ensemble en début du fichier.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('262','43','RÈGLE — Déclarer les constantes en capitales','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('263','44','RÈGLE — Les constantes sans contrôle de type sont déclarées avec la macro préprocesseur de définitio','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('264','45','RÈGLE — Les constantes avec un contrôle de type explicite doivent être déclarées avec le mot clé con','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('265','46','RÈGLE — Les valeurs constantes doivent être associées à un suffixe dépendant du type','Pour éviter toute mauvaise interprétation, les valeurs constantes doivent utiliser un suffixe selon leurs types :\n il faut utiliser le suffixe U pour toutes les constantes de type entier non signé ; \n pour indiquer une constante de type long (ou long long pour C99), il faut utiliser le suffixe L (resp. LL) et non l (resp. ll) afin d’éviter toute ambiguïté avec le chiffre 1 ;\n les valeurs flottantes sont par défaut considérées comme double, il faut utiliser le suffixe f pour le type float (resp. d pour le type double).',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('266','47','RÈGLE — La taille du type associé à une expression constante doit être suffisante pour la contenir','Il faut s’assurer que les valeurs ou expressions constantes utilisées ne dépassent pas du type qui leur est associé.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('267','48','RECOMMANDATION — Proscrire les constantes en octal','Ne pas utiliser de constante ni de séquence d’échappement en octal.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('268','49','RÈGLE — Limiter les variables globales au strict nécessaire','Limiter l’usage des variables globales et préférer les paramètres de fonctions pour propager une structure de données au travers d’une application.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('269','50','RÈGLE — Utilisation systématique du modificateur de déclaration static','Utiliser le mot clef static pour toutes les fonctions et variables globales qui ne sont pas utilisées à l’extérieur du fichier source dans lequel elles sont définies.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('270','51','RÈGLE — Seules les variables modifiables en dehors de l''implémentation doivent être déclarées volati','Seules les variables associées à des ports entrée/sortie ou des fonctions d’interruption asynchrone doivent être déclarées comme volatile pour empêcher toute optimisation ou réorganisation à la compilation.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('271','52','RÈGLE — Seuls des pointeurs spécifiés volatile peuvent accéder à des variables volatile','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('272','53','RÈGLE — Aucune omission de type n''est acceptée lors de la déclaration d''une variable','Toutes les variables utilisées doivent avoir été préalablement déclarées de façon explicite.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('273','54','RECOMMANDATION — Limiter l''utilisation des compound literals','Du fait du risque de mauvaise manipulation des compound literals, leur utilisation doit être limitée, documentée et une attention particulière doit être donnée à leur portée.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('274','55','RÈGLE — Ne pas mélanger des constantes explicites et implicites dans une énumération','Il faut soit expliciter toutes les constantes d’une énumération avec une valeur unique soit n’en expliciter aucune.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('275','56','RÈGLE — Ne pas utiliser des énumérations anonymes','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('276','57','RECOMMANDATION — Les variables doivent être initialisées à la déclaration ou immédiatement après','Toutes les variables doivent être systématiquement initialisées à leur déclaration ou immédiatement après dans le cas de déclarations multiples.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('277','58','RÈGLE — Ne pas mélanger les différents types d''initialisation pour les variables structurées','Pour l’initialisation d’une variable structurée, un seul et unique type d’initialisation doit être choisi et utilisé.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('278','59','RÈGLE — Les variables structurées ne doivent pas être initialisées sans expliciter la valeur d''initi','Les variables non scalaires doivent être initialisées explicitement : chaque élément doit être initialisé en étant clairement identifié sans valeur d’initialisation superflue ou la notation ={0} ; peut être utilisée à la déclaration. Enfin les tailles des tableaux doivent être explicitées à l’initialisation.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('279','60','RECOMMANDATION — Chaque déclaration publique (non static) doit être utilisée','Toutes les déclarations publiques (i.e. non static) doivent être utilisées, qu’il s’agissede variables, fonctions, labels ou autres.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('280','61','RÈGLE — Utiliser des variables pour les données sensibles distinctes des variables pour les données ','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('281','62','RÈGLE — Utiliser des variables pour les données sensibles et protégées en confidentialité et/ou inté','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('282','63','RÈGLE — Ne jamais coder en dur une donnée sensible.','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('283','64','RECOMMANDATION — Seuls des types d''entiers dont la taille et le signe sont explicites doivent être u','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('284','65','RÈGLE — Seuls les types signed char et unsigned char doivent être utilisés.','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('285','66','RECOMMANDATION — Ne pas redéfinir des alias de types','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('286','67','RÈGLE — Compréhension fine et précise des règles de conversions','Le développeur se doit de connaître et comprendre toutes les règles de conversionimplicites des types entiers.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('287','68','RÈGLE — Conversions explicites entre des types signés et non signés','Proscrire les conversions implicites de types. Utiliser des conversions explicites notamment entre type signé et type non signé.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('288','69','RECOMMANDATION — Ne pas utiliser de transtypage de pointeurs sur des types structurés différents','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('289','70','RÈGLE — L''accès aux éléments d''un tableau se fera toujours en désignant en premier attribut le table','L’accès au ième élément d’un tableau s’écrira toujours avec le nom du tableau en premier suivi de l’indice de la case à atteindre.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('290','71','RECOMMANDATION — L''accès aux éléments d''un tableau doit se faire en utilisant les crochets','Dans le cas d’une variable de type tableau, la notation dédiée (via les crochets) doit être utilisée pour éviter toute ambiguïté.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('291','72','RÈGLE — Ne pas utiliser de VLA','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('292','73','RECOMMANDATION — Ne pas utiliser de taille implicite pour les tableaux','Afin de s’assurer que les accès tableaux sont bien valides, la taille de ceux-ci doit être explicitée.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('293','74','RÈGLE — Utiliser des entiers non signés pour les tailles de tableaux','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('294','75','RÈGLE — Ne pas accèder à un élément de tableau sans vérifier la validité de l''indice utilisé','La validité des indices de tableau utilisés doit être vérifié de façon systématique : un indice de tableau est valide s’il est supérieur ou égal à zéro et strictement inférieur à la taille déclarée du tableau. Dans le cas d’un tableau de caractères, le caractère de fin de chaine ’\\0’ doit être pris en compte.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('295','76','RÈGLE — Un pointeur NULL ne doit pas être déréférencé','Avant de déréférencer un pointeur, le développeur doit s’assurer que celui-ci n’est pas NULL.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('296','77','RÈGLE — Un pointeur doit être affecté à NULL après désallocation','Un pointeur doit être systématiquement affecté à NULL suite à la désallocation de la mémoire qu’il pointe.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('297','78','RÈGLE — Ne pas utiliser le qualificateur de pointeur restrict','Le qualificateur restrict ne doit pas être utilisé directement par le développeur. Seule l’utilisation indirecte i.e. via l’appel de fonctions de la bibliothèque standard est tolérée mais le développeur devra s’assurer qu’aucun comportement indéfini résultera de l’utilisation de telles fonctions.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('298','79','RECOMMANDATION — Le nombre de niveau d''indirections de pointeur doit être limité à deux','Le nombre d’indirections pour un pointeur ne doit pas dépasser deux niveaux.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('299','80','RECOMMANDATION — Préférer l''utilisation de l''opérateur d''indirection ->','L’opérateur d’indirection -> doit être utilisé pour atteindre les champs d’une structure par l’intermédiaire d’un pointeur.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('300','81','RÈGLE — Seul l''incrément ou le décrément de pointeurs de tableaux est autorisé','L’incrément ou le décrément de pointeurs ne doit être utilisé que sur des pointeurs représentant un tableau ou un élément d’un tableau.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('301','82','RÈGLE — Aucune arithmétique sur les pointeurs void* n''est autorisée','Il faut proscrire l’utilisation de toute arithmétique sur des pointeurs de type void*.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('302','83','RECOMMANDATION — Arithmétique des pointeurs sur tableaux contrôlée','L’arithmétique sur des pointeurs représentant un tableau ou un élément d’un tableau doit être faite en s’assurant que le pointeur résultant pointera toujours sur un élément du même tableau.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('303','84','RÈGLE — Soustraction et comparaison entre pointeurs d''un même tableau uniquement','Seules les soustractions et comparaisons de pointeurs sur un même tableau sont autorisés.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('304','85','RECOMMANDATION — Il ne faut pas affecter directement une adresse fixe à un pointeur.','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('305','86','RÈGLE — Une structure doit être utilisée pour regrouper les données représentant une même entité','Les données liées doivent être regroupées au sein d’une structure.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('306','87','RÈGLE — Ne pas calculer la taille d''une structure comme la somme de la taille de ses champs','Du fait du padding, la taille d’une structure ne doit pas être supposée comme la somme de la taille de ses champs.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('307','88','RÈGLE — Tout bitfield doit obligatoirement être déclaré explicitement comme non signé','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('308','89','RÈGLE — Ne pas faire d''hypothèse sur la représentation interne de structures avec des bitfields','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('309','90','RÈGLE — Ne pas utiliser les FAM','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('310','91','RECOMMANDATION — Ne pas utiliser les unions','L’utilisation du même espace mémoire pour plusieurs données de natures différentes n’est pas autorisée.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('311','92','RÈGLE — Supprimer tous les débordements de valeurs possibles pour des entiers signés.','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('312','93','RECOMMANDATION — Détecter tous les wraps possibles de valeurs pour les entiers non signés.','vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('313','94','RÈGLE — Détecter et supprimer toute potentielle division par zéro','Cette vérification doit être systématique pour tout calcul de division ou de reste de division.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('314','95','RECOMMANDATION — Les opérations arithmétiques doivent être écrites en favorisant leur lisibilité','Il faut utiliser des opérations arithmétiques le plus explicites possibles (naturelles) et dans la logique du programme.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('315','96','RECOMMANDATION — Les opérateurs logiques ne doivent pas être appliqués avec des opérandes signés','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('316','97','RÈGLE — Explicitation de l''ordre d''évaluation des calculs par utilisation de parenthèses','Malgré la priorité des opérateurs, pour éviter toute ambiguïté, les expressions seront entourées de parenthèses pour rendre plus explicite l’ordre d’évaluation d’un calcul.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('317','98','RECOMMANDATION — Eviter les expressions de comparaison ou d''égalité multiple','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('318','99','RÈGLE — Toujours utiliser les parenthèses dans les expressions de comparaison ou d''égalité multiple','Les expressions booléennes de comparaison ou d’égalité contenant au moins 2 opérateurs relationnels sont interdites sans parenthèse.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('319','100','RÈGLE — Parenthèses autour des éléments d''une expression booléenne','Il est nécessaire de toujours mettre entre parenthèses les différents éléments d’une expression booléenne, afin qu’il n’y ait aucune ambiguïté dans l’ordre d’évaluation.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('320','101','RÈGLE — Comparaison implicite avec 0 interdite','Toutes les expressions booléennes doivent utiliser des opérateurs de comparaison. Aucun test implicite avec une valeur égale à 0 ou différente de 0 ne doit être effectué.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('321','102','RECOMMANDATION — Utilisation du type bool en C99','En C99, le type bool (ou _Bool) doit être utilisé pour les variables à valeurs booléennes.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('322','103','RÈGLE — Pas d''opérateur bit-à-bit sur un opérande de type booléen ou assimilé','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('323','104','BONNE PRATIQUE — Ne pas utiliser la valeur retournée lors d''une affectation','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('324','105','RÈGLE — Affectation interdite dans une expression booléenne','Une affectation ne doit pas être effectuée dans une expression booléenne quelle qu’elle soit. Une affectation doit être effectuée dans une instruction indépendante.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('325','106','BONNE PRATIQUE — Comparaison avec opérande constant à gauche','Quand une comparaison fait intervenir un opérande constant celui-ci sera de préférence mis comme opérande gauche pour éviter une affectation non intentionnelle.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('326','107','RÈGLE — Affectation multiple de variables interdite','L’affectation multiple de variables n’est pas autorisée.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('327','108','RÈGLE — Une seule instruction par ligne de code','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('328','108','BONNE PRATIQUE — Éviter les constantes flottantes','Ne pas utiliser de constantes numériques flottantes pour éviter les pertes de précision et autres phénomènes liés aux nombres flottants. Si cela ne peut être évité, la représentativité de la valeur flottante en question doit être vérifiée.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('329','110','RECOMMANDATION — Limiter l''utilisation des nombres flottants au strict nécessaire','Il faut limiter l’utilisation des nombres flottants.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('330','111','RÈGLE — Pas de compteur de boucle de type flottant','Les compteurs de boucle doivent être uniquement de type entier, avec la vérification de non débordement de type des valeurs des compteurs.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('331','112','RÈGLE — Ne pas utiliser de nombres flottants pour des comparaisons d''égalité ou d''inégalité','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('332','113','RECOMMANDATION — Non utilisation des nombres complexes','Les nombres complexes introduits depuis C99 ne doivent pas être utilisés.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('333','114','RÈGLE — Utilisation systématique des accolades pour les conditionnelles et les boucles','Ne jamais omettre les accolades pour délimiter un bloc d’instructions. Les accolades doivent être écrites pour délimiter un bloc d’instructions après les boucles (for, while, do) et les conditionnelles (if, else).',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('334','115','RÈGLE — Définition systématique d''un cas par défaut dans les switch','Un switch-case doit toujours contenir un cas default placé en dernier.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('335','116','RECOMMANDATION — Utilisation de break dans chaque cas des instructions switch','Un switch-case doit par défaut toujours contenir un break pour chaque cas. L’absence de break pour éviter de dupliquer du code est tolérée mais doit être explicitée dans un commentaire.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('336','117','RECOMMANDATION — Pas d''imbrication de structure de contrôle dans un switch-case',' Même si le C l’autorise, l’imbrication de structures de contrôle à l’intérieur d’un switch est à éviter.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('337','118','RÈGLE — Ne pas introduire d''instructions avant le premier label d''un switch-case','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('338','119','RÈGLE — Bonne construction des boucles for','Chaque élément d’une boucle for doit être complété et contenir exactement une seule instruction. Ainsi une boucle for doit contenir une initialisation de son compteur, une condition d’arrêt portant sur son compteur, et une incrémentation ou décrémentation du compteur de boucle.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('339','120','RÈGLE — Modification d''un compteur d''une boucle for interdite dans le corps de la boucle','Le compteur d’une boucle for ne doit pas être modifié à l’intérieur du corps de la boucle for.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('340','121','RÈGLE — Non utilisation de goto arrière (backward goto)','Proscrire, au sein d’une fonction, l’utilisation d’instructions goto renvoyant vers un label qui est placé avant cette instruction goto.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('341','122','RECOMMANDATION — Utilisation limitée du saut avant (forward goto)','L’utilisation d’un forward goto est tolérée uniquement dans les cas où elle permet :\n de limiter significativement le nombre de points de sortie de la fonction ;\n de rendre le code beaucoup plus lisible.\nLe ou les labels référencés par les instructions goto doivent tous être situés en fin de fonction.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('342','123','RÈGLE — Toute fonction (non static) définie doit possèder une déclaration/ prototype de fonction','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('343','124','RÈGLE — Le prototype de déclaration d''une fonction doit concorder avec sa définition','Les types des paramètres utilisés pour la définition et la déclaration d’une fonction doivent être les mêmes.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('344','125','RÈGLE — Toute fonction doit être associée à un type de retour et à une liste de paramètres explicite','Chaque fonction est définie explicitement avec un type de retour. Les fonctions sans valeur de retour doivent être déclarées avec un paramètre du type void. De la même façon, une fonction sans paramètre devra être définie et déclarée avec void en argument.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('345','126','RECOMMANDATION — Documentation des fonctions','Tous les fonctions doivent être documentées. Cela comprend :\nn une description de la fonction et du traitement effectué ;\n la documentation de chaque paramètre, le sens du paramètre (en entrée, en sortie, en entrée et en sortie) et les éventuelles conditions existant sur celui-ci ;\n les valeurs de retour possibles doivent être décrites.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('346','127','RECOMMANDATION — Préciser les conditions d''appel pour chaque fonction','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('347','128','RÈGLE — La validité de tous les paramètres d''une fonction doit systématiquement être remise en cause','Cela inclut :\n la validité des adresses pour les paramètres de type pointeur doit être vérifiée (non , alignement des adresses conforme...) ;\n l’appartenance des paramètres à leur domaine doit être vérifiée.\nCela s’applique aux fonctions définies par le développeur (cf. section 12.2) mais aussi aux fonctions de la bibliothèque standard.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('348','129','RÈGLE — Les paramètres de fonction de type pointeur pour lesquels la zone mémoire pointée n''est pas ','Marquer const tous les paramètres de type pointeur d’une fonction qui pointent vers une zone mémoire qui ne doit pas être modifiée dans le corps de celle-ci. Le qualificateur const doit s’appliquer à l’objet pointé.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('349','130','RÈGLE — Les fonctions inline doivent être déclarées comme static','Pour éviter un comportement non défini une fonction inline est systématiquement static.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('350','131','RÈGLE — Interdiction de redéfinir les fonctions ou macros de la bibliothèque standard ou d''une autre','Les identifiants, macros ou noms de fonctions faisant partie de la bibliothèque standard ou d’une autre bibliothèque utilisée ne doivent pas être redéfinis.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('351','132','RÈGLE — La valeur de retour d''une fonction doit toujours être testée','Lorsqu’une fonction retourne une valeur, la valeur retournée doit être systématiquement testée.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('352','133','RÈGLE — Retour implicite interdit pour les fonctions de type non void','Tous les chemins d’une fonction non void doivent retourner une valeur explicitement.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('353','134','RÈGLE — Les structures doivent être passées par référence à une fonction','Il ne faut pas passer de paramètres de type structure par copie lors de l’appel d’une fonction.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('354','135','RECOMMANDATION — Passage d''un tableau en paramètre d''une fonction','Il existe plusieurs façons de passer un tableau en paramètre d’une fonction. Lors du passage par pointeur, il faut préciser dans la documentation de la fonction que le paramètre correspond à un tableau et également utiliser la notation dédiée aux tableaux.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('355','136','RECOMMANDATION — Utilisation obligatoire dans une fonction de tous ses paramètres','Tous les paramètres présents dans le prototype de la fonction doivent être utilisés dans son implémentation.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('356','137','BONNE PRATIQUE — Utiliser les options de compilation -Wformat=2 et -Wformat-security dès qu''une fonc','Plus de détails sur ces options sont données en annexe B.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('357','138','RÈGLE — Ne pas appeler de fonctions variadiques avec NULL en argument','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('358','139','RÈGLE — Usage de la virgule interdit pour le séquencement d''instructions','La virgule n’est pas autorisée dans le cadre du séquencement des instructions decode.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('359','140','RECOMMANDATION — Les opérateurs pré-fixes ++ et -- ne doivent pas être utilisés','Les opérateurs de pré-incrémentation et pré-decrémentation ne seront pas utilisés.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('360','141','RECOMMANDATION — Pas d''utilisation combinée des opérateurs postfixes avec d''autres opérateurs','Les opérateurs de post-incrémentation et de post-décrémentation ne doivent pas être mixés avec d’autres opérateurs.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('361','142','RECOMMANDATION — Éviter l''utilisation d''opérateurs d''affectation combinés','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('362','143','RÈGLE — Non utilisation imbriquée de l''opérateur ternaire ?:','L’imbrication d’opérateurs ternaires ?: est interdite.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('363','144','RÈGLE — Bonne construction des expressions avec l''opérateur ternaire ?:','Les expressions résultantes de l’opérateur ternaire ?: doivent être exactement de même type pour éviter tout transtypage.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('364','145','RÈGLE — Allouer dynamiquement un espace mémoire dont la taille est suffisante pour l''objet alloué','Pour un pointeur ptr, on préférera utiliser ptr=malloc(sizeof(*ptr)); quand cela est possible.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('365','146','RÈGLE — Libérer la mémoire allouée dynamiquement au plus tôt','Tout espace mémoire alloué dynamiquement doit être libéré quand celui-ci n’est plus utile.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('366','147','RÈGLE — Les zones mémoires sensibles doivent être mises à zéro avant d''être libérées.','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('367','148','RÈGLE — Ne pas libérer de mémoire non allouée dynamiquement','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('368','149','RÈGLE — Ne pas modifier l''allocation dynamique via realloc','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('369','150','RÈGLE — Bonne utilisation de l''opérateur sizeof','Une expression contenue dans un sizeof ne doit pas :\n contenir l’opérateur « = » car l’expression ne sera pas évaluée ; \n contenir de déréférencement de pointeur ;\n être appliqué sur un pointeur représentant un tableau.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('370','151','RÈGLE — Vérification obligatoire du succès d''une allocation mémoire','Le succès d’une allocation mémoire doit toujours être vérifié.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('371','152','RÈGLE — L''isolement des données sensibles doit être effectué','Contrôler le bon usage d’une zone mémoire stockant des données sensibles i.e. minimiser l’exposition en mémoire, minimiser la copie et effacer la/les zones ayant contenu les données sensibles au plus tôt.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('372','153','RÈGLE — Initialiser et consulter la valeur de errno avant et après toute exécution d''une fonction de','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('373','154','RÈGLE — La gestion des erreurs retournées par une fonction de la bibliothèque standard doit être sys','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('374','155','RÈGLE — Documentation des codes d''erreur','Tous les codes d’erreur retournés par une fonction doivent être documentés. Dans le cas où plusieurs codes d’erreur peuvent être retournés en même temps par la fonction, la documentation doit définir la priorité de gestion de ces codes.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('375','156','RECOMMANDATION — Structuration des codes de retour','Les codes de retour doivent être structurés de façon à pouvoir obtenir rapidement une information concernant le déroulement de la fonction appelée : \n erreur ; \n type d’erreur ; \n alarme ; \n type d’alarme ; \n ok ;',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('376','157','RÈGLE — Code de retour d''un programme C en fonction du résultat de son exécution','Le code de retour d’un programme C doit avoir une signification afin d’indiquer le bon déroulement du programme ou la survenue d’une erreur : \n la valeur du code de retour doit être comprise entre 0 et 127 ; \n la valeur 0 indique que le programme s’est exécuté sans erreur ;\n la valeur 2 est généralement utilisée sous Unix pour indiquer une erreur dans les arguments passés en paramètres au programme. \nLa signification des codes de retour du programme doit être indiquée dans sa documentation.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('377','158','RECOMMANDATION — Privilégier les retours d''erreurs via des codes de retour dans la fonction principa','Un programme C doit disposer d’une fonction main() minimale. Les retours d’erreurs se font par un retour de code dédié (et donc documenté) de cette fonction.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('378','159','RÈGLE — Ne pas utiliser les fonctions abort() ou _Exit()','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('379','160','RECOMMANDATION — Limiter les appels à exit()','Les appels à la fonction exit() doivent être commentés et non systématiques. Le développeur doit le plus souvent possible les remplacer par un retour de code d’erreur  dans la fonction principale.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('380','161','RÈGLE — Ne pas utiliser les fonctions setjmp() et longjump()','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('381','162','RÈGLE — Ne pas utiliser les bibliothèques standards setjmp.h et stdarg.h','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('382','163','RECOMMANDATION — Limiter l''utilisation des bibliothèques standards manipulant des nombres flottants','Les bibliothèques standards float.h, fenv.h, complex.h et math.h ne doivent être utilisées que si cela est vraiment nécessaire.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('383','164','RÈGLE — Ne pas utiliser les fonctions atoi() atol() atof() et atoll() de la bibliothèque stdlib.h','Les fonctions équivalentes strto*() sont à utiliser en remplacement.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('384','165','RÈGLE — Ne pas utiliser la fonction rand() de la bibliothèque standard','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('385','166','RÈGLE — Utiliser les versions « plus sécurisées » pour les fonctions de la bibliothèque standard','Quand des fonctions de la bibliothèque standard existent en différentes versions, la version « plus sécurisée » doit être utilisée.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('386','167','RÈGLE — Ne pas utiliser de fonctions de la bibliothèque obsolescentes ou devenues obsolètes dans des','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('387','168','RÈGLE — Ne pas utiliser de fonctions de la bibliothèque manipulant des buffers sans prendre la taill','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('388','169','BONNE PRATIQUE — Tout code doit être soumis à relecture','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('389','170','RECOMMANDATION — Indentation des expressions longues','Lorsqu’une instruction ou une expression s’étale sur plusieurs lignes, il est indispensable de l’indenter afin de faciliter la compréhension du code.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('390','171','RÈGLE — Identifier et supprimer tout code mort','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('391','172','RÈGLE — Le code doit être exempt de code non atteignable en dehors de code défensif et de code d''int','Il ne doit jamais y avoir de code inatteignable, sauf s’il s’agit de code défensif ou s’il s’agit de code d’une interface et dans ces deux cas, il faut le préciser en commentaire.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('392','173','RECOMMANDATION — Evaluation outillée du code source pour limiter les risques d''erreurs d''exécution','Le code source du logiciel doit être analysé via au moins un outil d’analyse de code. Les résultats produits par l’outil d’analyse doivent être étudiés par le développeur et les corrections doivent être effectuées par rapport aux problèmes découverts.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('393','174','RECOMMANDATION — Limitation de la complexité cyclomatique','La complexité cyclomatique d’une fonction doit être limitée au maximum.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('394','175','RECOMMANDATION — Limitation de la longueur et la complexité d''une fonction','Une fonction doit être associée idéalement à un seul et unique traitement et doit donc correspondre à un nombre de lignes de code raisonnable.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('395','176','RÈGLE — Ne pas utiliser de mots clés du C++','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('396','177','RÈGLE — Séquences de caractères interdites dans les commentaires','Les séquences /* et // sont interdites dans tous les commentaires. Et un commentaire sur une ligne introduit par // ne doit pas contenir de caractère de continuation de ligne \\.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('397','178','RÈGLE — Mise en oeuvre manuelle de mécanismes « canari » si les options de durcissement ne sont pas ','Vide',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('398','179','RÈGLE — Pas d''assertions de mise au point sur un code mis en production','Les assertions de mise au point ne doivent pas être présentes en production.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('399','180','RECOMMANDATION — La gestion des assertions d''intégrité doit inclure un effacement des données d''urge','Les assertions d’intégrité doivent apparaître en production. En cas de déclenchement d’une assertion d’intégrité, le code de traitement doit aboutir à un effacement d’urgence des données sensibles.',NULL,NULL,NULL,NULL,'8');
INSERT INTO `O_regle` VALUES ('400','181','RÈGLE — Tout fichier non vide doit se terminer par un retour à la ligne et les directives de preproc','Un fichier non vide ne doit pas se terminer au milieu d’un commentaire ou d’une directive de preprocessing.',NULL,NULL,NULL,NULL,'8');


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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO `P_SROV` VALUES ('1','Organisation structurée','SVun','SVun','SVun','SVun','2','2','2','f','f','f','f','Moyen','P1','2.a','1');
INSERT INTO `P_SROV` VALUES ('2','Organisation structurée','Hacker','Un méchant','Voler le mot de passe','Desc OV',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'P1','2.a','2');
INSERT INTO `P_SROV` VALUES ('3','Individu isolé','Pob','Mon pote POB','MonOOV','Desc MonOOV',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'P2','2.a','2');
INSERT INTO `P_SROV` VALUES ('4','Organisation structurée','azer','azer','azer','azer','1','1','1','','','','','Faible','P2','2.a','1');
INSERT INTO `P_SROV` VALUES ('6','Individu isolé','azer','azer','azer','zer','1','1','1','','','','','Faible','P2','2.a','1');
INSERT INTO `P_SROV` VALUES ('7','Organisation structurée','d','d','d','d',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'P1','2.a','1');
INSERT INTO `P_SROV` VALUES ('11','Organisation structurée','Etatique','eee','Espionnage','eeeee','1','1','1','','','','','Faible','','2.a','13');


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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO `Q_seuil` VALUES ('1','6','4','2','1','3.a');
INSERT INTO `Q_seuil` VALUES ('4','6','4','2','2','3.a');
INSERT INTO `Q_seuil` VALUES ('5','6','4','2','1','3.a');
INSERT INTO `Q_seuil` VALUES ('12','6','4','2','13','3.a');
INSERT INTO `Q_seuil` VALUES ('14','6','4','2','15','3.a');
INSERT INTO `Q_seuil` VALUES ('15','6','4','2','16','3.a');


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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

INSERT INTO `R_partie_prenante` VALUES ('31','Categorie','PPun','Interne','3','3','2','1','4.5','1','1','1','1','3.a','1','1');
INSERT INTO `R_partie_prenante` VALUES ('32','Categorie','PPdeux','Interne','3','3','2','1','4.5','1','1','1','1','3.a','1','1');
INSERT INTO `R_partie_prenante` VALUES ('34','eeee','eee','Interne','4','4','4','4','1',NULL,NULL,NULL,NULL,'3.a','13','12');
INSERT INTO `R_partie_prenante` VALUES ('35','ggg','dddd','Interne','1','1','1','1','1','1','1','1','1','3.a','1','1');
INSERT INTO `R_partie_prenante` VALUES ('36','dddd','ddddd','Interne','3','3','1','1','9','1','1','1','1','3.a','13','12');
INSERT INTO `R_partie_prenante` VALUES ('37','ttt','eee','Externe','4','3','1','1','12','1','1','1','1','3.a','13','12');
INSERT INTO `R_partie_prenante` VALUES ('39','eeee','zzzz','Interne','2','2','3','3','0.44444444444444','1','1','1','1','3.a','13','12');
INSERT INTO `R_partie_prenante` VALUES ('43','a','a','Interne','2','4','2','1','4','1','1','1','1','3.a','15','14');


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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO `S_scenario_strategique` VALUES ('1','SSun','couchédesoleil.png','3.b','1','1','1');
INSERT INTO `S_scenario_strategique` VALUES ('4','MonScénarStratégique','hacker_cyber_crime-512.png','3.b','2','2','2');
INSERT INTO `S_scenario_strategique` VALUES ('7','SSSdeux','Capture.PNG','3.b','1','1','1');
INSERT INTO `S_scenario_strategique` VALUES ('9','eeee',NULL,'3.b','11','6','13');
INSERT INTO `S_scenario_strategique` VALUES ('10','Scen',NULL,'3.b','11','6','13');


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

INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('15','R1','Cheminun',NULL,'2','3','3','4','0.5','1','31');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('16','R2','Chemindeux',NULL,'3','3','2','2','2.25','7','32');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('20','eee','eeee',NULL,'1','1','3','3','0','9','34');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('23','R3','Chemintrois',NULL,'2','1','3','4','0.17','7','35');


DROP TABLE IF EXISTS `U_etre`;
CREATE TABLE `U_etre` (
  `id_scenario_operationnel` int(11) NOT NULL,
  `id_evenement_redoute` int(11) NOT NULL,
  `niveau_de_risque` double DEFAULT NULL,
  PRIMARY KEY (`id_scenario_operationnel`,`id_evenement_redoute`),
  KEY `U_etre_M_evenement_redoute0_FK` (`id_evenement_redoute`),
  CONSTRAINT `U_etre_M_evenement_redoute0_FK` FOREIGN KEY (`id_evenement_redoute`) REFERENCES `M_evenement_redoute` (`id_evenement_redoute`),
  CONSTRAINT `U_etre_U_scenario_operationnel_FK` FOREIGN KEY (`id_scenario_operationnel`) REFERENCES `U_scenario_operationnel` (`id_scenario_operationnel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_scenario_operationnel`),
  KEY `U_scenario_operationnel_G_atelier_FK` (`id_atelier`),
  KEY `U_scenario_operationnel_T_chemin_d_attaque_strategique0_FK` (`id_chemin_d_attaque_strategique`,`id_risque`),
  KEY `U_scenario_operationnel_F_projet1_FK` (`id_projet`),
  CONSTRAINT `U_scenario_operationnel_F_projet1_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`),
  CONSTRAINT `U_scenario_operationnel_G_atelier_FK` FOREIGN KEY (`id_atelier`) REFERENCES `G_atelier` (`id_atelier`),
  CONSTRAINT `U_scenario_operationnel_T_chemin_d_attaque_strategique0_FK` FOREIGN KEY (`id_chemin_d_attaque_strategique`, `id_risque`) REFERENCES `T_chemin_d_attaque_strategique` (`id_chemin_d_attaque_strategique`, `id_risque`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

INSERT INTO `U_scenario_operationnel` VALUES ('16','','Scenarun','1','couchédesoleil.png','4.a','15','R1','1');
INSERT INTO `U_scenario_operationnel` VALUES ('17','','Scenardeux','4','Capture.PNG','4.a','16','R2','1');
INSERT INTO `U_scenario_operationnel` VALUES ('21','','TotoSO',NULL,'hacker_cyber_crime-512.png','4.a','20','eee','13');
INSERT INTO `U_scenario_operationnel` VALUES ('24','','Scenartrois','1','Capture.PNG','4.a','23','R3','1');


DROP TABLE IF EXISTS `W_mode_operatoire`;
CREATE TABLE `W_mode_operatoire` (
  `id_mode_operatoire` int(11) NOT NULL AUTO_INCREMENT,
  `mode_operatoire` varchar(1000) DEFAULT NULL,
  `id_scenario_operationnel` int(11) NOT NULL,
  PRIMARY KEY (`id_mode_operatoire`),
  KEY `W_mode_operatoire_U_scenario_operationnel_FK` (`id_scenario_operationnel`),
  CONSTRAINT `W_mode_operatoire_U_scenario_operationnel_FK` FOREIGN KEY (`id_scenario_operationnel`) REFERENCES `U_scenario_operationnel` (`id_scenario_operationnel`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO `W_mode_operatoire` VALUES ('3','a','16');
INSERT INTO `W_mode_operatoire` VALUES ('4','b','17');
INSERT INTO `W_mode_operatoire` VALUES ('5','Sacréé scénario','21');
INSERT INTO `W_mode_operatoire` VALUES ('6','c','24');


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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4;

INSERT INTO `Y_mesure` VALUES ('12','MaMesure','Cacher le mot de passe');
INSERT INTO `Y_mesure` VALUES ('42','a','a');
INSERT INTO `Y_mesure` VALUES ('58','Mesuretrois','Mesuretrois');
INSERT INTO `Y_mesure` VALUES ('59','Mesureun','Mesureun');
INSERT INTO `Y_mesure` VALUES ('61','Mesureun','MesureUn');
INSERT INTO `Y_mesure` VALUES ('62','d','a');
INSERT INTO `Y_mesure` VALUES ('63','MesureDeux','MesureDeux');
INSERT INTO `Y_mesure` VALUES ('64','MaMesure','Desc M');
INSERT INTO `Y_mesure` VALUES ('65','MaMesurezz','zzzz');
INSERT INTO `Y_mesure` VALUES ('66','hghgjgjgj','gfgfgfhgfh');
INSERT INTO `Y_mesure` VALUES ('67','a','a');
INSERT INTO `Y_mesure` VALUES ('68','eee','eeee');
INSERT INTO `Y_mesure` VALUES ('69','Mesureun','Descriptionun');
INSERT INTO `Y_mesure` VALUES ('70','eee','fdfgdfgdf');
INSERT INTO `Y_mesure` VALUES ('71','eee','Ma mesure');
INSERT INTO `Y_mesure` VALUES ('72','Ma MEsure','MEsure esecret');
INSERT INTO `Y_mesure` VALUES ('75','Mesuredeux','Mesuredeux');
INSERT INTO `Y_mesure` VALUES ('76','Mesuredeux','Mesuredeux');
INSERT INTO `Y_mesure` VALUES ('77','Mesuretrois','Mesuretrois');


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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO `ZA_traitement_de_securite` VALUES ('2',NULL,NULL,NULL,NULL,NULL,NULL,'5.b','1','58');
INSERT INTO `ZA_traitement_de_securite` VALUES ('3','Protection','frein  sgsds','+','2020-07-08','resposdgsfg','A lancer','5.b','1','59');
INSERT INTO `ZA_traitement_de_securite` VALUES ('6',NULL,NULL,NULL,NULL,NULL,NULL,'5.b','13','71');
INSERT INTO `ZA_traitement_de_securite` VALUES ('7',NULL,NULL,NULL,NULL,NULL,NULL,'5.b','13','72');
INSERT INTO `ZA_traitement_de_securite` VALUES ('9',NULL,NULL,NULL,NULL,NULL,NULL,'5.b','1','63');
INSERT INTO `ZA_traitement_de_securite` VALUES ('10',NULL,NULL,NULL,NULL,NULL,NULL,'5.b','1','58');


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

INSERT INTO `ZB_comporter_2` VALUES ('58','23','R3');
INSERT INTO `ZB_comporter_2` VALUES ('63','16','R2');
INSERT INTO `ZB_comporter_2` VALUES ('68','20','eee');
INSERT INTO `ZB_comporter_2` VALUES ('69','15','R1');
INSERT INTO `ZB_comporter_2` VALUES ('70','20','eee');
