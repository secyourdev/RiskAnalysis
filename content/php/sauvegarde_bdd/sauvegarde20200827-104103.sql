--
-- sauvegarde20200827-104103.sql.gz
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO `A_utilisateur` VALUES ('1','ANTON RAVEENDRAN','Joyston','Ingénieur Cybersécurité','joyston.antonraveendran@edu.esiee.fr','$2y$10$sqqoKZH/ldSJpDEE.B71r.iK2R8Dg.13CxekMorR.ngxghY2VU6Kq','Administrateur Logiciel');
INSERT INTO `A_utilisateur` VALUES ('2','MICHEL','Guillaume','Ingénieur Logiciel','guillaume.michel@edu.esiee.fr','$2y$10$0kxHtETUPqWhCP2wnIEp8.CgGJn2ovkPKxQQInBwcV91N1Iyo7Oce','Administrateur Logiciel');
INSERT INTO `A_utilisateur` VALUES ('3','LAFOURCADE','Anthony','Ingénieur Logiciel','anthony.lafourcade@edu.esiee.fr','$2y$10$R/AiwRPtTNN1YXalpn063uwrfudevj2zSn65uCCdgF2v1RipRXEn6','Administrateur Logiciel');
INSERT INTO `A_utilisateur` VALUES ('4','PINTO','Carlos','Ingénieur sécurité','carlos.pinto5@wanadoo.fr','$2y$10$MV8n.ZZn32.qUcR0FZxXXOZs21oZSvXPjAfJntM0UQ9iE7xUoDbWS','Administrateur Logiciel');
INSERT INTO `A_utilisateur` VALUES ('10','Sec','YourDev','Ingé','carlospinto4949@hotmail.com','$2y$10$fdE9.ATqLmvmBywIffwES.NbBCPfihzz1jOkUIbh50JjYqH.2Zo6W','Utilisateur');
INSERT INTO `A_utilisateur` VALUES ('11','ANTON','Joyston','Ingénieur','a.tjoyston@outlook.com','$2y$10$/5jYVxpAx.g4MiwPU./L2uVXdi1HuBGA7Oa3LWIsUCpJy84Pj/Ha.','Utilisateur');


DROP TABLE IF EXISTS `B_grp_utilisateur`;
CREATE TABLE `B_grp_utilisateur` (
  `id_grp_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_grp_utilisateur` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_grp_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO `B_grp_utilisateur` VALUES ('6','Groupe de Joyston');
INSERT INTO `B_grp_utilisateur` VALUES ('7','CarlosGroupe');


DROP TABLE IF EXISTS `C_impliquer`;
CREATE TABLE `C_impliquer` (
  `id_grp_utilisateur` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_grp_utilisateur`,`id_utilisateur`),
  KEY `C_impliquer_A_utilisateur0_FK` (`id_utilisateur`),
  CONSTRAINT `C_impliquer_A_utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `A_utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `C_impliquer_B_grp_utilisateur_FK` FOREIGN KEY (`id_grp_utilisateur`) REFERENCES `B_grp_utilisateur` (`id_grp_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `C_impliquer` VALUES ('6','1');
INSERT INTO `C_impliquer` VALUES ('6','4');
INSERT INTO `C_impliquer` VALUES ('6','10');
INSERT INTO `C_impliquer` VALUES ('6','11');
INSERT INTO `C_impliquer` VALUES ('7','1');
INSERT INTO `C_impliquer` VALUES ('7','4');
INSERT INTO `C_impliquer` VALUES ('7','10');
INSERT INTO `C_impliquer` VALUES ('7','11');


DROP TABLE IF EXISTS `DA_echelle`;
CREATE TABLE `DA_echelle` (
  `id_echelle` int(11) NOT NULL AUTO_INCREMENT,
  `nom_echelle` varchar(50) DEFAULT NULL,
  `echelle_vraisemblance` int(11) DEFAULT NULL,
  `echelle_gravite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_echelle`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO `DA_echelle` VALUES ('1','Standard','5','5');
INSERT INTO `DA_echelle` VALUES ('3','CarlosEchelle','4','4');
INSERT INTO `DA_echelle` VALUES ('4','MonEchelle','4','4');
INSERT INTO `DA_echelle` VALUES ('5','Echelle5','5','5');
INSERT INTO `DA_echelle` VALUES ('6','EssaiEchelle','0','5');
INSERT INTO `DA_echelle` VALUES ('7','fgdfgdf','5','4');
INSERT INTO `DA_echelle` VALUES ('8','aaaaa','5','4');


DROP TABLE IF EXISTS `DA_evaluer`;
CREATE TABLE `DA_evaluer` (
  `id_echelle` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  PRIMARY KEY (`id_echelle`,`id_projet`),
  KEY `DA_evaluer_F_projet0_FK` (`id_projet`),
  CONSTRAINT `DA_evaluer_DA_echelle_FK` FOREIGN KEY (`id_echelle`) REFERENCES `DA_echelle` (`id_echelle`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `DA_evaluer_F_projet0_FK` FOREIGN KEY (`id_projet`) REFERENCES `F_projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `DA_evaluer` VALUES ('1','14');
INSERT INTO `DA_evaluer` VALUES ('1','15');
INSERT INTO `DA_evaluer` VALUES ('1','16');
INSERT INTO `DA_evaluer` VALUES ('1','17');
INSERT INTO `DA_evaluer` VALUES ('3','15');
INSERT INTO `DA_evaluer` VALUES ('4','16');
INSERT INTO `DA_evaluer` VALUES ('5','16');
INSERT INTO `DA_evaluer` VALUES ('6','16');
INSERT INTO `DA_evaluer` VALUES ('7','16');
INSERT INTO `DA_evaluer` VALUES ('8','16');


DROP TABLE IF EXISTS `DA_niveau`;
CREATE TABLE `DA_niveau` (
  `id_niveau` int(11) NOT NULL AUTO_INCREMENT,
  `description_niveau` varchar(1000) DEFAULT NULL,
  `valeur_niveau` int(11) DEFAULT NULL,
  `id_echelle` int(11) NOT NULL,
  PRIMARY KEY (`id_niveau`),
  KEY `DA_niveau_DA_echelle_FK` (`id_echelle`),
  CONSTRAINT `DA_niveau_DA_echelle_FK` FOREIGN KEY (`id_echelle`) REFERENCES `DA_echelle` (`id_echelle`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

INSERT INTO `DA_niveau` VALUES ('1','Conséquences négligeables pour l''organisation. Aucun impact opérationnel ni sur les performances de l''activité ni sur la sécurité des personnes et des biens. L''organisation surmontera la situation sans trop de difficultés (consommation des marges).','1','1');
INSERT INTO `DA_niveau` VALUES ('2','Conséquences significatives mais limitées pour l''organisation. Dégradation des performances de l’activité sans impact sur la sécurité des personnes et des biens. L''organisation surmontera la situation malgré quelques difficultés (fonctionnement en mode dégradé).','2','1');
INSERT INTO `DA_niveau` VALUES ('3','Conséquences importantes pour l''organisation. Forte dégradation des performances de l''activité, avec d’éventuels impacts significatifs sur la sécurité des personnes et des biens. L''organisation surmontera la situation avec de sérieuses difficultés (fonctionnement en mode très dégradé), sans impact sectoriel ou étatique.','3','1');
INSERT INTO `DA_niveau` VALUES ('4','Conséquences désastreuses pour l''organisation avec d''éventuels impacts sur l''écosystème. Incapacité pour l''organisation d''assurer la totalité ou une partie de son activité, avec d''éventuels impacts graves sur la sécurité des personnes et des biens. L''organisation ne surmontera vraisemblablement pas la situation (sa survie est menacée), les secteurs d''activité ou étatiques dans lesquels elle opère seront susceptibles d’être légèrement impactés, sans conséquences durables.','4','1');
INSERT INTO `DA_niveau` VALUES ('5','Conséquences sectorielles ou régaliennes au-delà de l’organisation. Écosystème(s) sectoriel(s) impacté(s) de façon importante, avec des conséquences éventuellement durables. Et/ou : difficulté pour l’État, voire incapacité, d’assurer une fonction régalienne ou une de ses missions d’importance vitale. Et/ou : impacts critiques sur la sécurité des personnes et des biens (crise sanitaire, pollution environnementale majeure, destruction d’infrastructures essentielles, etc.).	\r\n','5','1');
INSERT INTO `DA_niveau` VALUES ('12','Pas grave','1','3');
INSERT INTO `DA_niveau` VALUES ('13','dfdgfdf','2','3');
INSERT INTO `DA_niveau` VALUES ('14','moyen grave','3','3');
INSERT INTO `DA_niveau` VALUES ('15','Très grave','4','3');
INSERT INTO `DA_niveau` VALUES ('16','sdfsdf','1','4');
INSERT INTO `DA_niveau` VALUES ('17','sdfsdfsdf','2','4');
INSERT INTO `DA_niveau` VALUES ('18','sdfsdfsd','3','4');
INSERT INTO `DA_niveau` VALUES ('19','sdfdfsd','4','4');
INSERT INTO `DA_niveau` VALUES ('20',NULL,'1','5');
INSERT INTO `DA_niveau` VALUES ('21',NULL,'2','5');
INSERT INTO `DA_niveau` VALUES ('22',NULL,'3','5');
INSERT INTO `DA_niveau` VALUES ('23',NULL,'4','5');
INSERT INTO `DA_niveau` VALUES ('24',NULL,'5','5');
INSERT INTO `DA_niveau` VALUES ('25',NULL,'1','6');
INSERT INTO `DA_niveau` VALUES ('26',NULL,'2','6');
INSERT INTO `DA_niveau` VALUES ('27',NULL,'3','6');
INSERT INTO `DA_niveau` VALUES ('28',NULL,'4','6');
INSERT INTO `DA_niveau` VALUES ('29',NULL,'5','6');
INSERT INTO `DA_niveau` VALUES ('30',NULL,'1','7');
INSERT INTO `DA_niveau` VALUES ('31',NULL,'2','7');
INSERT INTO `DA_niveau` VALUES ('32',NULL,'3','7');
INSERT INTO `DA_niveau` VALUES ('33',NULL,'4','7');
INSERT INTO `DA_niveau` VALUES ('34',NULL,'1','8');
INSERT INTO `DA_niveau` VALUES ('35',NULL,'2','8');
INSERT INTO `DA_niveau` VALUES ('36',NULL,'3','8');
INSERT INTO `DA_niveau` VALUES ('37',NULL,'4','8');


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
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4;

INSERT INTO `DB_bareme_risque` VALUES ('160','3','5','fond-rouge','14');
INSERT INTO `DB_bareme_risque` VALUES ('161','1','4','fond-orange','14');
INSERT INTO `DB_bareme_risque` VALUES ('162','2','5','fond-rouge','16');
INSERT INTO `DB_bareme_risque` VALUES ('163','2','3','fond-vert','16');
INSERT INTO `DB_bareme_risque` VALUES ('164','3','5','fond-rouge','16');
INSERT INTO `DB_bareme_risque` VALUES ('165','4','5','fond-rouge','16');
INSERT INTO `DB_bareme_risque` VALUES ('166','2','4','fond-vert','16');
INSERT INTO `DB_bareme_risque` VALUES ('167','1','4','fond-vert','16');


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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

INSERT INTO `F_projet` VALUES ('14','Projet de Joyston','Projet de Joyston','Projet de Joyston','1','2020-08-30','6','1','1');
INSERT INTO `F_projet` VALUES ('15','CarlosProjet','Description de mon projet','Ceci est mon objectif','4','2020-08-25','7','4','1');
INSERT INTO `F_projet` VALUES ('16','Toto1','gfhfghfghfgh',NULL,NULL,NULL,'7','4','4');
INSERT INTO `F_projet` VALUES ('17','Projet de Joyston 2','Projet de Joyston 2','Projet de Joyston 2','1','2020-08-31','6','1','1');


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

INSERT INTO `H_RACI` VALUES ('14','1','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','2.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('14','1','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','2.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','1','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','2.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','4','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('15','10','1.a','Information');
INSERT INTO `H_RACI` VALUES ('15','10','1.b','Information');
INSERT INTO `H_RACI` VALUES ('15','10','1.c','Information');
INSERT INTO `H_RACI` VALUES ('15','10','1.d','Information');
INSERT INTO `H_RACI` VALUES ('15','10','2.a','Information');
INSERT INTO `H_RACI` VALUES ('15','10','2.b','Information');
INSERT INTO `H_RACI` VALUES ('15','10','2.c','Information');
INSERT INTO `H_RACI` VALUES ('15','10','3.a','Information');
INSERT INTO `H_RACI` VALUES ('15','10','3.b','Information');
INSERT INTO `H_RACI` VALUES ('15','10','3.c','Information');
INSERT INTO `H_RACI` VALUES ('15','10','4.a','Information');
INSERT INTO `H_RACI` VALUES ('15','10','4.b','Information');
INSERT INTO `H_RACI` VALUES ('15','10','5.a','Information');
INSERT INTO `H_RACI` VALUES ('15','10','5.b','Information');
INSERT INTO `H_RACI` VALUES ('15','10','5.c','Information');
INSERT INTO `H_RACI` VALUES ('15','11','1.a','Information');
INSERT INTO `H_RACI` VALUES ('15','11','1.b','Information');
INSERT INTO `H_RACI` VALUES ('15','11','1.c','Information');
INSERT INTO `H_RACI` VALUES ('15','11','1.d','Information');
INSERT INTO `H_RACI` VALUES ('15','11','2.a','Information');
INSERT INTO `H_RACI` VALUES ('15','11','2.b','Information');
INSERT INTO `H_RACI` VALUES ('15','11','2.c','Information');
INSERT INTO `H_RACI` VALUES ('15','11','3.a','Information');
INSERT INTO `H_RACI` VALUES ('15','11','3.b','Information');
INSERT INTO `H_RACI` VALUES ('15','11','3.c','Information');
INSERT INTO `H_RACI` VALUES ('15','11','4.a','Information');
INSERT INTO `H_RACI` VALUES ('15','11','4.b','Information');
INSERT INTO `H_RACI` VALUES ('15','11','5.a','Information');
INSERT INTO `H_RACI` VALUES ('15','11','5.b','Information');
INSERT INTO `H_RACI` VALUES ('15','11','5.c','Information');
INSERT INTO `H_RACI` VALUES ('16','1','1.a','Information');
INSERT INTO `H_RACI` VALUES ('16','1','1.b','Information');
INSERT INTO `H_RACI` VALUES ('16','1','1.c','Information');
INSERT INTO `H_RACI` VALUES ('16','1','1.d','Information');
INSERT INTO `H_RACI` VALUES ('16','1','2.a','Information');
INSERT INTO `H_RACI` VALUES ('16','1','2.b','Information');
INSERT INTO `H_RACI` VALUES ('16','1','2.c','Information');
INSERT INTO `H_RACI` VALUES ('16','1','3.a','Information');
INSERT INTO `H_RACI` VALUES ('16','1','3.b','Information');
INSERT INTO `H_RACI` VALUES ('16','1','3.c','Information');
INSERT INTO `H_RACI` VALUES ('16','1','4.a','Information');
INSERT INTO `H_RACI` VALUES ('16','1','4.b','Information');
INSERT INTO `H_RACI` VALUES ('16','1','5.a','Information');
INSERT INTO `H_RACI` VALUES ('16','1','5.b','Information');
INSERT INTO `H_RACI` VALUES ('16','1','5.c','Information');
INSERT INTO `H_RACI` VALUES ('16','4','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','2.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','4','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('16','10','1.a','Information');
INSERT INTO `H_RACI` VALUES ('16','10','1.b','Information');
INSERT INTO `H_RACI` VALUES ('16','10','1.c','Information');
INSERT INTO `H_RACI` VALUES ('16','10','1.d','Information');
INSERT INTO `H_RACI` VALUES ('16','10','2.a','Information');
INSERT INTO `H_RACI` VALUES ('16','10','2.b','Information');
INSERT INTO `H_RACI` VALUES ('16','10','2.c','Information');
INSERT INTO `H_RACI` VALUES ('16','10','3.a','Information');
INSERT INTO `H_RACI` VALUES ('16','10','3.b','Information');
INSERT INTO `H_RACI` VALUES ('16','10','3.c','Information');
INSERT INTO `H_RACI` VALUES ('16','10','4.a','Information');
INSERT INTO `H_RACI` VALUES ('16','10','4.b','Information');
INSERT INTO `H_RACI` VALUES ('16','10','5.a','Information');
INSERT INTO `H_RACI` VALUES ('16','10','5.b','Information');
INSERT INTO `H_RACI` VALUES ('16','10','5.c','Information');
INSERT INTO `H_RACI` VALUES ('17','1','1.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','1.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','1.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','1.d','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','2.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','2.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','2.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','3.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','3.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','3.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','4.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','4.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','5.a','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','5.b','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','1','5.c','Réalisation');
INSERT INTO `H_RACI` VALUES ('17','4','1.a','Information');
INSERT INTO `H_RACI` VALUES ('17','4','1.b','Information');
INSERT INTO `H_RACI` VALUES ('17','4','1.c','Information');
INSERT INTO `H_RACI` VALUES ('17','4','1.d','Information');
INSERT INTO `H_RACI` VALUES ('17','4','2.a','Information');
INSERT INTO `H_RACI` VALUES ('17','4','2.b','Information');
INSERT INTO `H_RACI` VALUES ('17','4','2.c','Information');
INSERT INTO `H_RACI` VALUES ('17','4','3.a','Information');
INSERT INTO `H_RACI` VALUES ('17','4','3.b','Information');
INSERT INTO `H_RACI` VALUES ('17','4','3.c','Information');
INSERT INTO `H_RACI` VALUES ('17','4','4.a','Information');
INSERT INTO `H_RACI` VALUES ('17','4','4.b','Information');
INSERT INTO `H_RACI` VALUES ('17','4','5.a','Information');
INSERT INTO `H_RACI` VALUES ('17','4','5.b','Information');
INSERT INTO `H_RACI` VALUES ('17','4','5.c','Information');
INSERT INTO `H_RACI` VALUES ('17','10','1.a','Information');
INSERT INTO `H_RACI` VALUES ('17','10','1.b','Information');
INSERT INTO `H_RACI` VALUES ('17','10','1.c','Information');
INSERT INTO `H_RACI` VALUES ('17','10','1.d','Information');
INSERT INTO `H_RACI` VALUES ('17','10','2.a','Information');
INSERT INTO `H_RACI` VALUES ('17','10','2.b','Information');
INSERT INTO `H_RACI` VALUES ('17','10','2.c','Information');
INSERT INTO `H_RACI` VALUES ('17','10','3.a','Information');
INSERT INTO `H_RACI` VALUES ('17','10','3.b','Information');
INSERT INTO `H_RACI` VALUES ('17','10','3.c','Information');
INSERT INTO `H_RACI` VALUES ('17','10','4.a','Information');
INSERT INTO `H_RACI` VALUES ('17','10','4.b','Information');
INSERT INTO `H_RACI` VALUES ('17','10','5.a','Information');
INSERT INTO `H_RACI` VALUES ('17','10','5.b','Information');
INSERT INTO `H_RACI` VALUES ('17','10','5.c','Information');


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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

INSERT INTO `I_mission` VALUES ('12','Ma mission','Carlos','1.b','15');
INSERT INTO `I_mission` VALUES ('13','Ma mission','fgfgdf','1.b','15');
INSERT INTO `I_mission` VALUES ('14','MISSION1','Joyston','1.b','17');
INSERT INTO `I_mission` VALUES ('15','MISSION2','Joyston','1.b','17');
INSERT INTO `I_mission` VALUES ('16','MISSION3','Joyston','1.b','17');
INSERT INTO `I_mission` VALUES ('17','MISSION4','Joyston','1.b','17');


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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

INSERT INTO `J_valeur_metier` VALUES ('13','Mot de passe','Information','Desc MDP','1.b','15');
INSERT INTO `J_valeur_metier` VALUES ('14','Serveur de vente','Processus','dddd ','1.b','15');
INSERT INTO `J_valeur_metier` VALUES ('15','dfgdfg','Processus','sddfsdf','1.b','14');
INSERT INTO `J_valeur_metier` VALUES ('17','fggfg','Information','Mot,dz ','1.b','16');
INSERT INTO `J_valeur_metier` VALUES ('18','VM1','Processus','VM1','1.b','17');
INSERT INTO `J_valeur_metier` VALUES ('19','VM2','Information','VM2','1.b','17');


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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

INSERT INTO `K_bien_support` VALUES ('13','Clé usb','Desc BS','1.b','15');
INSERT INTO `K_bien_support` VALUES ('14','Disque','desc disqie','1.b','15');
INSERT INTO `K_bien_support` VALUES ('15','disque','ffff','1.b','16');
INSERT INTO `K_bien_support` VALUES ('16','BS1','BS1','1.b','17');
INSERT INTO `K_bien_support` VALUES ('17','BS2','BS2','1.b','17');


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

INSERT INTO `L_couple_VMBS` VALUES ('13','13','12','Toi','Toto');
INSERT INTO `L_couple_VMBS` VALUES ('14','13','13','fdgdfg','dfgdfgf');
INSERT INTO `L_couple_VMBS` VALUES ('18','16','14','Joyston','Joyston');
INSERT INTO `L_couple_VMBS` VALUES ('18','17','16','Joyston','Joyston');
INSERT INTO `L_couple_VMBS` VALUES ('19','16','15','Joyston','Joyston');
INSERT INTO `L_couple_VMBS` VALUES ('19','17','17','Joyston','Joyston');


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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

INSERT INTO `M_evenement_redoute` VALUES ('13','MonER','Desc ER','1','1','1','3','Des cimpact','4','13','1.c','15');
INSERT INTO `M_evenement_redoute` VALUES ('14','ER ER ER','Des ER rrr','3','1','2','2','Des i rrrr','2','14','1.c','15');
INSERT INTO `M_evenement_redoute` VALUES ('15','fgdfgdfg','dsfsdf','1','1','2','2','sdfsdf','5','15','1.c','14');
INSERT INTO `M_evenement_redoute` VALUES ('16','sfsdf','','1','1','1','1','','1','15','1.c','14');
INSERT INTO `M_evenement_redoute` VALUES ('17','Vold mot de passe','ffff','3','1','1','2','perte financiere','4','17','1.c','16');
INSERT INTO `M_evenement_redoute` VALUES ('18','ER1','ER1','2','1','3','2','Impacts','3','18','1.c','17');


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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

INSERT INTO `N_socle_de_securite` VALUES ('11','Référentiel de sécurité','Cloisonnement système','Appliqué sans restriction','','1.d','15');
INSERT INTO `N_socle_de_securite` VALUES ('12','Référentiel de sécurité','Cloisonnement système','Appliqué sans restriction','','1.d','14');
INSERT INTO `N_socle_de_securite` VALUES ('13','rtrtrr','rtrtrt','Non appliqué','rtrtt','1.d','14');
INSERT INTO `N_socle_de_securite` VALUES ('14','Référentiel de sécurité','Règles de codage',NULL,NULL,'1.d','16');
INSERT INTO `N_socle_de_securite` VALUES ('15','Référentiel de sécurité','Guide d''hygiène informatique',NULL,NULL,'1.d','16');
INSERT INTO `N_socle_de_securite` VALUES ('16','Référentiel de sécurité','Règles de codage',NULL,NULL,'1.d','17');
INSERT INTO `N_socle_de_securite` VALUES ('17','Référentiel de sécurité','Guide d''hygiène informatique',NULL,NULL,'1.d','17');


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
) ENGINE=InnoDB AUTO_INCREMENT=1769 DEFAULT CHARSET=utf8mb4;

INSERT INTO `O_regle` VALUES ('1271','1','Appliquer le principe de moindre privilège dès la conception','Interdire par défaut toute action et procéder à l’autorisation exclusive de ce qui estnécessaire aux tâches constitue la stratégie la plus efficace de mise en œuvre duprincipe de moindre privilège. Il convient de s’y conformer autant que possible dèsla phase de conception du composant.','Non applicable','','0000-00-00','','11','15','1.d');
INSERT INTO `O_regle` VALUES ('1272','2','Tenir compte de ses besoins en cloisonnement dès l''initiation d''un projet','Les besoins en cloisonnement d’un composant doivent faire l’objet d’un diagnosticet être considérés comme des besoins au même titre que les besoins fonctionnels, etce dès le début du projet.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1273','3','Préférer des composants implémentant un cloisonnement pertinent','Lors d’un choix entre différentes solutions, celles qui démontrent la meilleure priseen compte du principe du moindre privilège devront être préférées.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1274','4','Garantir l''intégrité des composants de confiance','Il est impératif de garantir concrètement l’intégrité des composants de confiancepour que la sécurité de l’ensemble du composant soit assurée. Des recommandationsplus précises sont fournies en4.1.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1275','5','Rédiger l''analyse de la sécurité attendue du composant','Une analyse de la sécurité attendue du composant doit faire partie des documentsde conception ou intégration mis à disposition.Elle doit comporter les définitions des quatre éléments cités ci-dessus :\nla liste des biens sensibles à protéger;\nle modèle d’attaquant pris en compte (duquel découle en particulier l’identifica-tion des composants de confiance);\nnle périmètre du composant, c’est-à-dire sa surface d’attaque et sa surface de fric-tion avec le système global;\nnles fonctions de sécurité attendues.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1276','6','Caractériser des usages du composant','Réaliser une liste des usages du composant à partir de ses fonctionnalités et de laliste des ressources auxquelles il accède.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1277','7','Minimiser de la surface d''attaque','Réduire systématiquement la surface d’attaque pour chaque usage, de manière à n’-exposer que les interfaces externes utiles pour l’usage considéré.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1278','8','Cloisonner les usages entre eux','Mettre en place un moniteur de référence en s’appuyant sur les composants de con-fiance pour faire en sorte que chaque usage soit confiné dans un domaine.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1279','9','Minimiser la surface de friction','Réduire systématiquement les actions possibles pour chaque domaine aux seuls be-soins liés à l’usage, c’est-à-dire réduire la surface de friction avec le système global.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1280','10','Considérer le moniteur comme un composant de confiance','Vis-à-vis d’un attaquant de la fonction de sécurité de cloisonnement, le moniteur deréférence fait partie des composants de confiance. Ainsi, il doit respecter les recom-mandations de cette section.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1281','11','Identifier les composants de confiance','Tout composant du système qui dispose d’un privilège lui permettant de porter at-teinte à l’intégrité du moniteur, ou des politiques de sécurité qu’il met en place, est àconsidérer comme faisant partie des composants de confiance vis-à-vis du composantanalysé.Tous ces composants doivent donc vérifier les exigences propres aux composants deconfiance.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1282','12','Concevoir des composants simples et concis','Les composants de confiance doivent être conçus en suivant des spécifications claireset complètes, permettant de définir et combiner des éléments simples (suivant leprincipe « Keep It Short and Simple ») qui facilitent développement et validation.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1283','13','Choisir un langage approprié','Utiliser un langage de programmation fortement typé, qui entre autres prévient lesdébordements de tableau, d’entier, ou l’utilisation de pointeurs invalides, est forte-ment souhaitable pour le développement des composants de confiance.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1284','14','Développer selon un référentiel de sécurité','Un référentiel de développement sécurisé doit être utilisé systématiquement lors dudéveloppement de composants de confiance.La vérification du respect du référentiel de codage doit être assurée.Le respect de cette recommandation est critique dans le cas du choix d’un langagene respectant pas les critères conseillés ci-dessus.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1285','15','Auditer le code de l''implémentation des composants de confiance','L’intégralité du code des composants de confiance devra faire l’objet d’un audit decode par des personnels qui n’en sont pas développeurs, de préférence indépendantsdu projet concerné.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1286','16','Valider l''implémentation des composants de confiance','Des tests fonctionnels complets devront permettre de valider le bon fonctionnementdes fonctions de sécurité implémentées. Une attention particulière sera portée àtester aussi bien les opérations qui doivent être refusées que celles qui doivent êtremenées à bien avec succès.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1287','17','Prouver l''implémentation des composants de confiance','Il est fortement recommandé de compléter les tests par une preuve formelle del’absence d’erreur à l’exécution d’un composant de confiance, par exemple à l’aided’outils d’analyse (statique ou dynamique) pour prévenir certains types de vulnérabilités.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1288','18','Supprimer toute partie inutilisée d''un composant de confiance','Un composant de confiance doit être minimal. Dès que possible, la suppression ducode inutilisé sera privilégiée. A défaut, sa désactivation par configuration sera effectuée.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1289','19','Appliquer des techniques de durcissement aux composants de confiance','Les composants de confiance doivent se voir appliquer des techniques de durcisse-ment à l’état de l’art afin de compliquer l’exploitation d’une vulnérabilité et le dé-tournement du flot de contrôle, comme par exemple :\nprésence de motifs d’intégrité de la pile et du tas (canaris);\nprincipe W+X : au cours de toute son utilisation par le système, une zone mé-moire donnée ne doit pas être inscriptible et exécutable, que ce soit simultané-ment ou non;\nrépartition aléatoire de l’espace d’adressage (ou Address Space Layout Random-ization (ASLR)).',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1290','20','Justifier le respect des propriétés fondamentales du moniteur de référence','Le développement, l’intégration et la validation du moniteur de référence doiventpermettre de garantir qu’il vérifie les propriétés suivantes.\n1.Complétude du contrôle exercé: le moniteur est impliqué pour chaque tenta-tive d’accès à une ressource, et ce au moment opportun (i.e. absence d’attaquesTOCTTOU (Time Of Check To Time Of Use), liées à une évolution des propriétésde l’objet entre le moment de la requête au moniteur et l’action effective).\n2.Maintien de l’intégrité du moniteur.\n3.Validation et audit de la politique de sécurité. La possibilité de consulter la poli-tique de sécurité implémentée par le moniteur à un instant donné permettral’audit de celle-ci.Des justifications construites confirmant le respect de ces propriétés doivent figurerdans les documents de conception du composant utilisant le moniteur de référence.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1291','21','Assurer au moniteur de référence un niveau de privilège supérieur à celuides tâches cloisonnées','De manière à préserver l’intégrité du moniteur et des politiques de sécurité qu’il meten application, les tâches cloisonnées ne doivent pas disposer des privilèges néces-saires à la relaxe de la politique de sécurité appliquée.Une façon de garantir ceci est d’assurer que les politiques sont non-modifiables parles tâches cloisonnées et que le moniteur s’exécute à un niveau de privilège supérieurà celui des tâches qu’il cloisonne.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1292','22','Appliquer le principe d''interdiction par défaut','Un moniteur de référence doit être configurable pour que toute action soit interditeà une tâche, sauf à lui être explicitement autorisée.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1293','23','Minimiser le nombre et l''impact des configurations possibles','Dans une démarche de durcissement du moniteur, les options de configuration lais-sées au choix de l’utilisateur (même privilégié) en production doivent être restreintesau strict minimum, de manière à réduire l’impact possible d’une erreur sur la sécuritéglobale du système. Pour les choix laissés à l’utilisateur, les messages d’avertissementsur les conséquences en terme de sécurité doivent être suffisamment explicites.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1294','24','Spécifier le cloisonnement proposé','Pour présenter le cloisonnement mis en place, il est recommandé de procéder de lamanière suivante.\n1.Expliciter les usages identifiés.\n2.Décrire le mécanisme de cloisonnement mis en oeuvre en explicitant ce àquoi correspondent les définitions de tâches, ressources propres et partagéeset moniteur de référence.\n3. Expliciter la politique de sécurité mise en place pour chaque usage.Pour chaque domaine, il faut reprendre la liste des interfaces externes dressées précédem-ment et caractériser les actions autorisées.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1295','25','Assurer l''innocuité du composant pour le système qui l''accueille','Un composant ne doit pas dégrader la sécurité globale du système, notamment enlimitant la mise en place du cloisonnement par d’autres composants utilisés sur lemême système.En particulier, un composant ne doit pas exiger pour fonctionner d’abaisser le niveaude sécurité du système qui l’héberge : le composant doit être compatible avec unniveau de durcissement à l’état de l’art au moment de sa mise en production.',NULL,NULL,NULL,NULL,'11','15','1.d');
INSERT INTO `O_regle` VALUES ('1296','26','Ma règle','Ma description','Non traité','','2020-09-03','','11','15','1.d');
INSERT INTO `O_regle` VALUES ('1297','1','Appliquer le principe de moindre privilège dès la conception','Interdire par défaut toute action et procéder à l’autorisation exclusive de ce qui estnécessaire aux tâches constitue la stratégie la plus efficace de mise en œuvre duprincipe de moindre privilège. Il convient de s’y conformer autant que possible dèsla phase de conception du composant.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1298','2','Tenir compte de ses besoins en cloisonnement dès l''initiation d''un projet','Les besoins en cloisonnement d’un composant doivent faire l’objet d’un diagnosticet être considérés comme des besoins au même titre que les besoins fonctionnels, etce dès le début du projet.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1299','3','Préférer des composants implémentant un cloisonnement pertinent','Lors d’un choix entre différentes solutions, celles qui démontrent la meilleure priseen compte du principe du moindre privilège devront être préférées.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1300','4','Garantir l''intégrité des composants de confiance','Il est impératif de garantir concrètement l’intégrité des composants de confiancepour que la sécurité de l’ensemble du composant soit assurée. Des recommandationsplus précises sont fournies en4.1.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1301','5','Rédiger l''analyse de la sécurité attendue du composant','Une analyse de la sécurité attendue du composant doit faire partie des documentsde conception ou intégration mis à disposition.Elle doit comporter les définitions des quatre éléments cités ci-dessus :\nla liste des biens sensibles à protéger;\nle modèle d’attaquant pris en compte (duquel découle en particulier l’identifica-tion des composants de confiance);\nnle périmètre du composant, c’est-à-dire sa surface d’attaque et sa surface de fric-tion avec le système global;\nnles fonctions de sécurité attendues.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1302','6','Caractériser des usages du composant','Réaliser une liste des usages du composant à partir de ses fonctionnalités et de laliste des ressources auxquelles il accède.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1303','7','Minimiser de la surface d''attaque','Réduire systématiquement la surface d’attaque pour chaque usage, de manière à n’-exposer que les interfaces externes utiles pour l’usage considéré.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1304','8','Cloisonner les usages entre eux','Mettre en place un moniteur de référence en s’appuyant sur les composants de con-fiance pour faire en sorte que chaque usage soit confiné dans un domaine.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1305','9','Minimiser la surface de friction','Réduire systématiquement les actions possibles pour chaque domaine aux seuls be-soins liés à l’usage, c’est-à-dire réduire la surface de friction avec le système global.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1306','10','Considérer le moniteur comme un composant de confiance','Vis-à-vis d’un attaquant de la fonction de sécurité de cloisonnement, le moniteur deréférence fait partie des composants de confiance. Ainsi, il doit respecter les recom-mandations de cette section.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1307','11','Identifier les composants de confiance','Tout composant du système qui dispose d’un privilège lui permettant de porter at-teinte à l’intégrité du moniteur, ou des politiques de sécurité qu’il met en place, est àconsidérer comme faisant partie des composants de confiance vis-à-vis du composantanalysé.Tous ces composants doivent donc vérifier les exigences propres aux composants deconfiance.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1308','12','Concevoir des composants simples et concis','Les composants de confiance doivent être conçus en suivant des spécifications claireset complètes, permettant de définir et combiner des éléments simples (suivant leprincipe « Keep It Short and Simple ») qui facilitent développement et validation.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1309','13','Choisir un langage approprié','Utiliser un langage de programmation fortement typé, qui entre autres prévient lesdébordements de tableau, d’entier, ou l’utilisation de pointeurs invalides, est forte-ment souhaitable pour le développement des composants de confiance.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1310','14','Développer selon un référentiel de sécurité','Un référentiel de développement sécurisé doit être utilisé systématiquement lors dudéveloppement de composants de confiance.La vérification du respect du référentiel de codage doit être assurée.Le respect de cette recommandation est critique dans le cas du choix d’un langagene respectant pas les critères conseillés ci-dessus.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1311','15','Auditer le code de l''implémentation des composants de confiance','L’intégralité du code des composants de confiance devra faire l’objet d’un audit decode par des personnels qui n’en sont pas développeurs, de préférence indépendantsdu projet concerné.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1312','16','Valider l''implémentation des composants de confiance','Des tests fonctionnels complets devront permettre de valider le bon fonctionnementdes fonctions de sécurité implémentées. Une attention particulière sera portée àtester aussi bien les opérations qui doivent être refusées que celles qui doivent êtremenées à bien avec succès.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1313','17','Prouver l''implémentation des composants de confiance','Il est fortement recommandé de compléter les tests par une preuve formelle del’absence d’erreur à l’exécution d’un composant de confiance, par exemple à l’aided’outils d’analyse (statique ou dynamique) pour prévenir certains types de vulnérabilités.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1314','18','Supprimer toute partie inutilisée d''un composant de confiance','Un composant de confiance doit être minimal. Dès que possible, la suppression ducode inutilisé sera privilégiée. A défaut, sa désactivation par configuration sera effectuée.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1315','19','Appliquer des techniques de durcissement aux composants de confiance','Les composants de confiance doivent se voir appliquer des techniques de durcisse-ment à l’état de l’art afin de compliquer l’exploitation d’une vulnérabilité et le dé-tournement du flot de contrôle, comme par exemple :\nprésence de motifs d’intégrité de la pile et du tas (canaris);\nprincipe W+X : au cours de toute son utilisation par le système, une zone mé-moire donnée ne doit pas être inscriptible et exécutable, que ce soit simultané-ment ou non;\nrépartition aléatoire de l’espace d’adressage (ou Address Space Layout Random-ization (ASLR)).',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1316','20','Justifier le respect des propriétés fondamentales du moniteur de référence','Le développement, l’intégration et la validation du moniteur de référence doiventpermettre de garantir qu’il vérifie les propriétés suivantes.\n1.Complétude du contrôle exercé: le moniteur est impliqué pour chaque tenta-tive d’accès à une ressource, et ce au moment opportun (i.e. absence d’attaquesTOCTTOU (Time Of Check To Time Of Use), liées à une évolution des propriétésde l’objet entre le moment de la requête au moniteur et l’action effective).\n2.Maintien de l’intégrité du moniteur.\n3.Validation et audit de la politique de sécurité. La possibilité de consulter la poli-tique de sécurité implémentée par le moniteur à un instant donné permettral’audit de celle-ci.Des justifications construites confirmant le respect de ces propriétés doivent figurerdans les documents de conception du composant utilisant le moniteur de référence.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1317','21','Assurer au moniteur de référence un niveau de privilège supérieur à celuides tâches cloisonnées','De manière à préserver l’intégrité du moniteur et des politiques de sécurité qu’il meten application, les tâches cloisonnées ne doivent pas disposer des privilèges néces-saires à la relaxe de la politique de sécurité appliquée.Une façon de garantir ceci est d’assurer que les politiques sont non-modifiables parles tâches cloisonnées et que le moniteur s’exécute à un niveau de privilège supérieurà celui des tâches qu’il cloisonne.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1318','22','Appliquer le principe d''interdiction par défaut','Un moniteur de référence doit être configurable pour que toute action soit interditeà une tâche, sauf à lui être explicitement autorisée.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1319','23','Minimiser le nombre et l''impact des configurations possibles','Dans une démarche de durcissement du moniteur, les options de configuration lais-sées au choix de l’utilisateur (même privilégié) en production doivent être restreintesau strict minimum, de manière à réduire l’impact possible d’une erreur sur la sécuritéglobale du système. Pour les choix laissés à l’utilisateur, les messages d’avertissementsur les conséquences en terme de sécurité doivent être suffisamment explicites.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1320','24','Spécifier le cloisonnement proposé','Pour présenter le cloisonnement mis en place, il est recommandé de procéder de lamanière suivante.\n1.Expliciter les usages identifiés.\n2.Décrire le mécanisme de cloisonnement mis en oeuvre en explicitant ce àquoi correspondent les définitions de tâches, ressources propres et partagéeset moniteur de référence.\n3. Expliciter la politique de sécurité mise en place pour chaque usage.Pour chaque domaine, il faut reprendre la liste des interfaces externes dressées précédem-ment et caractériser les actions autorisées.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1321','25','Assurer l''innocuité du composant pour le système qui l''accueille','Un composant ne doit pas dégrader la sécurité globale du système, notamment enlimitant la mise en place du cloisonnement par d’autres composants utilisés sur lemême système.En particulier, un composant ne doit pas exiger pour fonctionner d’abaisser le niveaude sécurité du système qui l’héberge : le composant doit être compatible avec unniveau de durcissement à l’état de l’art au moment de sa mise en production.',NULL,NULL,NULL,NULL,'12','14','1.d');
INSERT INTO `O_regle` VALUES ('1322','27','sfsdfsdf','sdfsdfsds','','','0000-00-00','','12','14','1.d');
INSERT INTO `O_regle` VALUES ('1323','1','RÈGLE — Application de conventions de codage claires et explicites','Des conventions de codage doivent être définies et documentées pour le logiciel à produire. Ces conventions doivent définir au minimum les points suivants : l’encodage des fichiers sources, la mise en page du code et l’indentation, les types standards à utiliser, le nommage (bibliothèques, fichiers, fonctions, types, variables, . . .), le format de la documentation. Ces conventions doivent être appliquées par chaque développeur.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1324','2','RÈGLE — Seul le codage C conforme au standard est autorisé','Aucune violation des contraintes et de la syntaxe C telles que définies dans les standards C90 ou C99 n’est autorisée.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1325','3','RECOMMANDATION — Maîtrise des actions opérées à la compilation.',' Le développeur doit connaître et documenter les actions associées aux options activées du compilateur y compris en terme d’optimisation de code',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1326','4','RÈGLE — Définir précisément les options de compilation','Les options utilisées pour la compilation doivent être précisément définies pour l’ensemble des sources d’un logiciel. Ces options doivent notamment fixer précisément :\n- la version du standard C utilisée (par exemple C99 ou encore C90) ;\n- le nom et la version du compilateur utilisé ;',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1327','RÈGLE — Utiliser des options de durcissement','5','L’utilisation d’options de durcissement est obligatoire que ce soit pour imposer la génération d’exécutables relocalisables, une randomization d’adresses efficace ou la protection contre le dépassement de pile entre autres.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1328','6','BONNE PRATIQUE — Utiliser des générateurs de projets pour la compilation.','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1329','7','RÈGLE — Compiler le code sans erreur ni avertissement en activant des options de compilation exigent','Activer le niveau d’avertissement et d’erreur le plus élevé du compilateur et de l’éditeur de liens afin de s’assurer de l’absence de problèmes potentiels liés à l’utilisation incorrecte du langage de programmation et traiter tous les avertissements et toutes les erreurs signalés par le compilateur et l’éditeur de liens pour les éliminer.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1330','8','RECOMMANDATION — Utiliser les options des compilations les plus exigentes','Si une option élevée d’un compilateur n’apparaît pas pertinente pour un développement donné, une justification sera fournie pour expliquer ce choix.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1331','9','RÈGLE — Tout code mis en production doit être compilé en mode release','La compilation en mode release est obligatoire pour une mise en production.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1332','10','RECOMMANDATION — Prêter une attention particulière aux modes debug et release lors de la compilation','L’utilisation des modes debug et release à la compilation doit se faire en toute connaissance des modifications induites en terme de gestion de mémoire et d’optimisation de code. Les différences entre ces deux modes doivent être documentées de manière exhaustive.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1333','11','RECOMMANDATION — Limiter et justifier les inclusions de fichier d''en-tête dans un autre fichier d''en','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1334','12','RECOMMANDATION — Limiter et justifier les inclusions de fichier d''en-tête dans un autre fichier d''en','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1335','13','RÈGLE — Utiliser des macros de garde d''inclusion multiple d''un fichier','Une macro de garde contre l’inclusion multiple d’un fichier doit être utilisée afin d’empêcher que le contenu d’un fichier d’en-tête soit inclus plus d’une fois :\n// début du fichier d''en -tête\n#ifndef HEADER_H\n#define HEADER_H\n/* contenu du fichier */\n#endif\n//fin du fichier d''en -tête',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1336','14','RÈGLE — Les inclusions de fichiers d''en-tête sont groupées en début de fichier','Toutes les inclusions de fichiers d’en-tête doivent être regroupées au début du fichier ou juste après des commentaires ou les directives de preprocessing, mais systématiquement avant la définition de variables globales ou de fonctions.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1337','15','RECOMMANDATION — Les inclusions de fichiers d''en-tête systèmes sont effectuées avant les inclusions ','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1338','16','BONNE PRATIQUE — Utiliser l''ordre alphabétique dans l''inclusion de chaque type de fichiers d''en-tête','Pour éviter les redondances dans les inclusions de fichiers d’en-tête systèmes ou utilisateur, le développeur peut les ordonner par ordre alphabétique ce qui permet d’avoir un ordre d’inclusion déterministe et de faciliter la revue de code.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1339','17','RÈGLE — Ne pas inclure un fichier source dans un autre fichier source','Seule l’inclusion de fichiers d’en-tête est autorisée dans un fichier source.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1340','18','RÈGLE — Les chemins des fichiers doivent être portables et la casse doit être respectée','Les chemins de fichiers, que ce soit pour une directive d’inclusion #include ou non, doivent être portables tout en respectant la casse des répertoires.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1341','19','RÈGLE — Le nom d''un fichier d''en-tête ne doit pas contenir certains caractères ou séquences de carac','Le nom d’un fichier d’en-tête doit être exempt des caractères et des séquences de caractères suivants : « '', ", \\, /* et // ».',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1342','20','RECOMMANDATION — Les blocs préprocesseurs doivent être commentés','Les directives des blocs préprocesseurs doivent être commentées afin d’expliciter le cas traité et pour les directives « intermédiaires » et « fermantes », celles-ci doivent aussi être associées à la directive « ouvrante » correspondante par le biais d’un commentaire.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1343','21','BONNE PRATIQUE — La double négation dans l''expression des conditions des blocs préprocesseurs doit ê','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1344','22','RÈGLE — Définition d''un bloc préprocesseur dans un seul et même fichier','Pour un bloc préprocesseur, toutes les directives associées doivent se trouver dans le même fichier.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1345','23','RECOMMANDATION — Les expressions de contrôle des directives de preprocessing doivent être bien formé','Les expressions de contrôle doivent être évaluées uniquement à 0 ou 1 et doivent utiliser uniquement des identifiants définis (via #define).',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1346','24','RÈGLE — Ne pas utiliser dans une même expression plus d''un des opérateurs de preprocessing # et ##','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1347','25','RÈGLE — Utiliser les opérateurs de preprocessing # et ## en maîtrisant leur expansion','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1348','26','RÈGLE — Les macros doivent être nommées de façon spécifique','Pour différencier aisément les macros des fonctions et ne pas utiliser un nom réservé d’une autre macro C, les macros préprocesseurs doivent être en capitales et les mots composant le nom séparés par le caractère souligné « _ » mais sans les faire débuter par le caractère souligné car il s’agit d’une convention pour les noms réservés du langage C.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1349','27','RÈGLE — Ne pas terminer une macro par un point-virgule','Le point-virgule final doit être omis à la fin de la définition d’une macro.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1350','28','Le point-virgule final doit être omis à la fin de la définition d’une macro.','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1351','29','RÈGLE — L''expansion d''une macro définie par le développeur ne doit pas créer de fonction','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1352','30','RÈGLE — Les macros contenant plusieurs instructions doivent utiliser une boucle do { ... } while(0) ','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1353','31','RÈGLE — Parenthèses obligatoires autour des paramètres utilisés dans le corps d''une macro','Les paramètres d’une macro doivent systématiquement être entourés de parenthèses lors de leur utilisation, afin de préserver l’ordre souhaité d’évaluation des expressions.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1354','32','RECOMMANDATION — Il faut éviter les arguments d''une macro réalisant une opération','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1355','33','RÈGLE — Les arguments d''une macro ne doivent pas contenir d''effets de bord.','Des arguments de macro avec des effets de bord peuvent entraîner des évaluations multiples non désirées.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1356','34','RÈGLE — Ne pas utiliser de directives de preprocessing en arguments d''une macro','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1357','35','RÈGLE — La directive #undef ne doit pas être utilisée','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1358','36','RÈGLE — Ne pas utiliser de trigraphes','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1359','37','RECOMMANDATION — Les points d''interrogation ne doivent pas être utilisés de façon successive','Cette règle s’applique pour toute partie du code mais aussi pour les commentaires.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1360','38','RECOMMANDATION — Seules les déclarations multiples de variables simples de même type sont autorisées','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1361','39','RÈGLE — Ne pas faire de déclaration multiple de variables associée à une initialisation.','Les initialisations associées (i.e. consécutives et dans une même instruction) à une déclaration multiple sont interdites.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1362','40','RECOMMANDATION — Regrouper les déclarations de variables en début du bloc dans lequel elles sont uti','Pour des questions de lisibilité et pour éviter les redéfinitions, les déclarations de variables sont regroupées en début de fichier, fonction ou bloc d’instructions selon leur portée.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1363','41','RÈGLE — Ne pas utiliser des valeurs en dur','Les valeurs utilisées dans le code doivent être déclarées comme des constantes.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1364','42','BONNE PRATIQUE — Centraliser la déclaration des constantes en début de fichier','Pour faciliter la lecture, les constantes sont déclarées ensemble en début du fichier.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1365','43','RÈGLE — Déclarer les constantes en capitales','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1366','44','RÈGLE — Les constantes sans contrôle de type sont déclarées avec la macro préprocesseur de définitio','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1367','45','RÈGLE — Les constantes avec un contrôle de type explicite doivent être déclarées avec le mot clé con','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1368','46','RÈGLE — Les valeurs constantes doivent être associées à un suffixe dépendant du type','Pour éviter toute mauvaise interprétation, les valeurs constantes doivent utiliser un suffixe selon leurs types :\n il faut utiliser le suffixe U pour toutes les constantes de type entier non signé ; \n pour indiquer une constante de type long (ou long long pour C99), il faut utiliser le suffixe L (resp. LL) et non l (resp. ll) afin d’éviter toute ambiguïté avec le chiffre 1 ;\n les valeurs flottantes sont par défaut considérées comme double, il faut utiliser le suffixe f pour le type float (resp. d pour le type double).',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1369','47','RÈGLE — La taille du type associé à une expression constante doit être suffisante pour la contenir','Il faut s’assurer que les valeurs ou expressions constantes utilisées ne dépassent pas du type qui leur est associé.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1370','48','RECOMMANDATION — Proscrire les constantes en octal','Ne pas utiliser de constante ni de séquence d’échappement en octal.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1371','49','RÈGLE — Limiter les variables globales au strict nécessaire','Limiter l’usage des variables globales et préférer les paramètres de fonctions pour propager une structure de données au travers d’une application.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1372','50','RÈGLE — Utilisation systématique du modificateur de déclaration static','Utiliser le mot clef static pour toutes les fonctions et variables globales qui ne sont pas utilisées à l’extérieur du fichier source dans lequel elles sont définies.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1373','51','RÈGLE — Seules les variables modifiables en dehors de l''implémentation doivent être déclarées volati','Seules les variables associées à des ports entrée/sortie ou des fonctions d’interruption asynchrone doivent être déclarées comme volatile pour empêcher toute optimisation ou réorganisation à la compilation.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1374','52','RÈGLE — Seuls des pointeurs spécifiés volatile peuvent accéder à des variables volatile','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1375','53','RÈGLE — Aucune omission de type n''est acceptée lors de la déclaration d''une variable','Toutes les variables utilisées doivent avoir été préalablement déclarées de façon explicite.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1376','54','RECOMMANDATION — Limiter l''utilisation des compound literals','Du fait du risque de mauvaise manipulation des compound literals, leur utilisation doit être limitée, documentée et une attention particulière doit être donnée à leur portée.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1377','55','RÈGLE — Ne pas mélanger des constantes explicites et implicites dans une énumération','Il faut soit expliciter toutes les constantes d’une énumération avec une valeur unique soit n’en expliciter aucune.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1378','56','RÈGLE — Ne pas utiliser des énumérations anonymes','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1379','57','RECOMMANDATION — Les variables doivent être initialisées à la déclaration ou immédiatement après','Toutes les variables doivent être systématiquement initialisées à leur déclaration ou immédiatement après dans le cas de déclarations multiples.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1380','58','RÈGLE — Ne pas mélanger les différents types d''initialisation pour les variables structurées','Pour l’initialisation d’une variable structurée, un seul et unique type d’initialisation doit être choisi et utilisé.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1381','59','RÈGLE — Les variables structurées ne doivent pas être initialisées sans expliciter la valeur d''initi','Les variables non scalaires doivent être initialisées explicitement : chaque élément doit être initialisé en étant clairement identifié sans valeur d’initialisation superflue ou la notation ={0} ; peut être utilisée à la déclaration. Enfin les tailles des tableaux doivent être explicitées à l’initialisation.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1382','60','RECOMMANDATION — Chaque déclaration publique (non static) doit être utilisée','Toutes les déclarations publiques (i.e. non static) doivent être utilisées, qu’il s’agissede variables, fonctions, labels ou autres.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1383','61','RÈGLE — Utiliser des variables pour les données sensibles distinctes des variables pour les données ','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1384','62','RÈGLE — Utiliser des variables pour les données sensibles et protégées en confidentialité et/ou inté','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1385','63','RÈGLE — Ne jamais coder en dur une donnée sensible.','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1386','64','RECOMMANDATION — Seuls des types d''entiers dont la taille et le signe sont explicites doivent être u','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1387','65','RÈGLE — Seuls les types signed char et unsigned char doivent être utilisés.','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1388','66','RECOMMANDATION — Ne pas redéfinir des alias de types','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1389','67','RÈGLE — Compréhension fine et précise des règles de conversions','Le développeur se doit de connaître et comprendre toutes les règles de conversionimplicites des types entiers.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1390','68','RÈGLE — Conversions explicites entre des types signés et non signés','Proscrire les conversions implicites de types. Utiliser des conversions explicites notamment entre type signé et type non signé.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1391','69','RECOMMANDATION — Ne pas utiliser de transtypage de pointeurs sur des types structurés différents','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1392','70','RÈGLE — L''accès aux éléments d''un tableau se fera toujours en désignant en premier attribut le table','L’accès au ième élément d’un tableau s’écrira toujours avec le nom du tableau en premier suivi de l’indice de la case à atteindre.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1393','71','RECOMMANDATION — L''accès aux éléments d''un tableau doit se faire en utilisant les crochets','Dans le cas d’une variable de type tableau, la notation dédiée (via les crochets) doit être utilisée pour éviter toute ambiguïté.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1394','72','RÈGLE — Ne pas utiliser de VLA','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1395','73','RECOMMANDATION — Ne pas utiliser de taille implicite pour les tableaux','Afin de s’assurer que les accès tableaux sont bien valides, la taille de ceux-ci doit être explicitée.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1396','74','RÈGLE — Utiliser des entiers non signés pour les tailles de tableaux','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1397','75','RÈGLE — Ne pas accèder à un élément de tableau sans vérifier la validité de l''indice utilisé','La validité des indices de tableau utilisés doit être vérifié de façon systématique : un indice de tableau est valide s’il est supérieur ou égal à zéro et strictement inférieur à la taille déclarée du tableau. Dans le cas d’un tableau de caractères, le caractère de fin de chaine ’\\0’ doit être pris en compte.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1398','76','RÈGLE — Un pointeur NULL ne doit pas être déréférencé','Avant de déréférencer un pointeur, le développeur doit s’assurer que celui-ci n’est pas NULL.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1399','77','RÈGLE — Un pointeur doit être affecté à NULL après désallocation','Un pointeur doit être systématiquement affecté à NULL suite à la désallocation de la mémoire qu’il pointe.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1400','78','RÈGLE — Ne pas utiliser le qualificateur de pointeur restrict','Le qualificateur restrict ne doit pas être utilisé directement par le développeur. Seule l’utilisation indirecte i.e. via l’appel de fonctions de la bibliothèque standard est tolérée mais le développeur devra s’assurer qu’aucun comportement indéfini résultera de l’utilisation de telles fonctions.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1401','79','RECOMMANDATION — Le nombre de niveau d''indirections de pointeur doit être limité à deux','Le nombre d’indirections pour un pointeur ne doit pas dépasser deux niveaux.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1402','80','RECOMMANDATION — Préférer l''utilisation de l''opérateur d''indirection ->','L’opérateur d’indirection -> doit être utilisé pour atteindre les champs d’une structure par l’intermédiaire d’un pointeur.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1403','81','RÈGLE — Seul l''incrément ou le décrément de pointeurs de tableaux est autorisé','L’incrément ou le décrément de pointeurs ne doit être utilisé que sur des pointeurs représentant un tableau ou un élément d’un tableau.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1404','82','RÈGLE — Aucune arithmétique sur les pointeurs void* n''est autorisée','Il faut proscrire l’utilisation de toute arithmétique sur des pointeurs de type void*.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1405','83','RECOMMANDATION — Arithmétique des pointeurs sur tableaux contrôlée','L’arithmétique sur des pointeurs représentant un tableau ou un élément d’un tableau doit être faite en s’assurant que le pointeur résultant pointera toujours sur un élément du même tableau.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1406','84','RÈGLE — Soustraction et comparaison entre pointeurs d''un même tableau uniquement','Seules les soustractions et comparaisons de pointeurs sur un même tableau sont autorisés.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1407','85','RECOMMANDATION — Il ne faut pas affecter directement une adresse fixe à un pointeur.','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1408','86','RÈGLE — Une structure doit être utilisée pour regrouper les données représentant une même entité','Les données liées doivent être regroupées au sein d’une structure.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1409','87','RÈGLE — Ne pas calculer la taille d''une structure comme la somme de la taille de ses champs','Du fait du padding, la taille d’une structure ne doit pas être supposée comme la somme de la taille de ses champs.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1410','88','RÈGLE — Tout bitfield doit obligatoirement être déclaré explicitement comme non signé','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1411','89','RÈGLE — Ne pas faire d''hypothèse sur la représentation interne de structures avec des bitfields','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1412','90','RÈGLE — Ne pas utiliser les FAM','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1413','91','RECOMMANDATION — Ne pas utiliser les unions','L’utilisation du même espace mémoire pour plusieurs données de natures différentes n’est pas autorisée.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1414','92','RÈGLE — Supprimer tous les débordements de valeurs possibles pour des entiers signés.','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1415','93','RECOMMANDATION — Détecter tous les wraps possibles de valeurs pour les entiers non signés.','vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1416','94','RÈGLE — Détecter et supprimer toute potentielle division par zéro','Cette vérification doit être systématique pour tout calcul de division ou de reste de division.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1417','95','RECOMMANDATION — Les opérations arithmétiques doivent être écrites en favorisant leur lisibilité','Il faut utiliser des opérations arithmétiques le plus explicites possibles (naturelles) et dans la logique du programme.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1418','96','RECOMMANDATION — Les opérateurs logiques ne doivent pas être appliqués avec des opérandes signés','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1419','97','RÈGLE — Explicitation de l''ordre d''évaluation des calculs par utilisation de parenthèses','Malgré la priorité des opérateurs, pour éviter toute ambiguïté, les expressions seront entourées de parenthèses pour rendre plus explicite l’ordre d’évaluation d’un calcul.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1420','98','RECOMMANDATION — Eviter les expressions de comparaison ou d''égalité multiple','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1421','99','RÈGLE — Toujours utiliser les parenthèses dans les expressions de comparaison ou d''égalité multiple','Les expressions booléennes de comparaison ou d’égalité contenant au moins 2 opérateurs relationnels sont interdites sans parenthèse.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1422','100','RÈGLE — Parenthèses autour des éléments d''une expression booléenne','Il est nécessaire de toujours mettre entre parenthèses les différents éléments d’une expression booléenne, afin qu’il n’y ait aucune ambiguïté dans l’ordre d’évaluation.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1423','101','RÈGLE — Comparaison implicite avec 0 interdite','Toutes les expressions booléennes doivent utiliser des opérateurs de comparaison. Aucun test implicite avec une valeur égale à 0 ou différente de 0 ne doit être effectué.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1424','102','RECOMMANDATION — Utilisation du type bool en C99','En C99, le type bool (ou _Bool) doit être utilisé pour les variables à valeurs booléennes.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1425','103','RÈGLE — Pas d''opérateur bit-à-bit sur un opérande de type booléen ou assimilé','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1426','104','BONNE PRATIQUE — Ne pas utiliser la valeur retournée lors d''une affectation','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1427','105','RÈGLE — Affectation interdite dans une expression booléenne','Une affectation ne doit pas être effectuée dans une expression booléenne quelle qu’elle soit. Une affectation doit être effectuée dans une instruction indépendante.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1428','106','BONNE PRATIQUE — Comparaison avec opérande constant à gauche','Quand une comparaison fait intervenir un opérande constant celui-ci sera de préférence mis comme opérande gauche pour éviter une affectation non intentionnelle.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1429','107','RÈGLE — Affectation multiple de variables interdite','L’affectation multiple de variables n’est pas autorisée.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1430','108','RÈGLE — Une seule instruction par ligne de code','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1431','108','BONNE PRATIQUE — Éviter les constantes flottantes','Ne pas utiliser de constantes numériques flottantes pour éviter les pertes de précision et autres phénomènes liés aux nombres flottants. Si cela ne peut être évité, la représentativité de la valeur flottante en question doit être vérifiée.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1432','110','RECOMMANDATION — Limiter l''utilisation des nombres flottants au strict nécessaire','Il faut limiter l’utilisation des nombres flottants.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1433','111','RÈGLE — Pas de compteur de boucle de type flottant','Les compteurs de boucle doivent être uniquement de type entier, avec la vérification de non débordement de type des valeurs des compteurs.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1434','112','RÈGLE — Ne pas utiliser de nombres flottants pour des comparaisons d''égalité ou d''inégalité','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1435','113','RECOMMANDATION — Non utilisation des nombres complexes','Les nombres complexes introduits depuis C99 ne doivent pas être utilisés.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1436','114','RÈGLE — Utilisation systématique des accolades pour les conditionnelles et les boucles','Ne jamais omettre les accolades pour délimiter un bloc d’instructions. Les accolades doivent être écrites pour délimiter un bloc d’instructions après les boucles (for, while, do) et les conditionnelles (if, else).',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1437','115','RÈGLE — Définition systématique d''un cas par défaut dans les switch','Un switch-case doit toujours contenir un cas default placé en dernier.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1438','116','RECOMMANDATION — Utilisation de break dans chaque cas des instructions switch','Un switch-case doit par défaut toujours contenir un break pour chaque cas. L’absence de break pour éviter de dupliquer du code est tolérée mais doit être explicitée dans un commentaire.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1439','117','RECOMMANDATION — Pas d''imbrication de structure de contrôle dans un switch-case',' Même si le C l’autorise, l’imbrication de structures de contrôle à l’intérieur d’un switch est à éviter.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1440','118','RÈGLE — Ne pas introduire d''instructions avant le premier label d''un switch-case','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1441','119','RÈGLE — Bonne construction des boucles for','Chaque élément d’une boucle for doit être complété et contenir exactement une seule instruction. Ainsi une boucle for doit contenir une initialisation de son compteur, une condition d’arrêt portant sur son compteur, et une incrémentation ou décrémentation du compteur de boucle.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1442','120','RÈGLE — Modification d''un compteur d''une boucle for interdite dans le corps de la boucle','Le compteur d’une boucle for ne doit pas être modifié à l’intérieur du corps de la boucle for.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1443','121','RÈGLE — Non utilisation de goto arrière (backward goto)','Proscrire, au sein d’une fonction, l’utilisation d’instructions goto renvoyant vers un label qui est placé avant cette instruction goto.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1444','122','RECOMMANDATION — Utilisation limitée du saut avant (forward goto)','L’utilisation d’un forward goto est tolérée uniquement dans les cas où elle permet :\n de limiter significativement le nombre de points de sortie de la fonction ;\n de rendre le code beaucoup plus lisible.\nLe ou les labels référencés par les instructions goto doivent tous être situés en fin de fonction.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1445','123','RÈGLE — Toute fonction (non static) définie doit possèder une déclaration/ prototype de fonction','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1446','124','RÈGLE — Le prototype de déclaration d''une fonction doit concorder avec sa définition','Les types des paramètres utilisés pour la définition et la déclaration d’une fonction doivent être les mêmes.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1447','125','RÈGLE — Toute fonction doit être associée à un type de retour et à une liste de paramètres explicite','Chaque fonction est définie explicitement avec un type de retour. Les fonctions sans valeur de retour doivent être déclarées avec un paramètre du type void. De la même façon, une fonction sans paramètre devra être définie et déclarée avec void en argument.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1448','126','RECOMMANDATION — Documentation des fonctions','Tous les fonctions doivent être documentées. Cela comprend :\nn une description de la fonction et du traitement effectué ;\n la documentation de chaque paramètre, le sens du paramètre (en entrée, en sortie, en entrée et en sortie) et les éventuelles conditions existant sur celui-ci ;\n les valeurs de retour possibles doivent être décrites.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1449','127','RECOMMANDATION — Préciser les conditions d''appel pour chaque fonction','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1450','128','RÈGLE — La validité de tous les paramètres d''une fonction doit systématiquement être remise en cause','Cela inclut :\n la validité des adresses pour les paramètres de type pointeur doit être vérifiée (non , alignement des adresses conforme...) ;\n l’appartenance des paramètres à leur domaine doit être vérifiée.\nCela s’applique aux fonctions définies par le développeur (cf. section 12.2) mais aussi aux fonctions de la bibliothèque standard.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1451','129','RÈGLE — Les paramètres de fonction de type pointeur pour lesquels la zone mémoire pointée n''est pas ','Marquer const tous les paramètres de type pointeur d’une fonction qui pointent vers une zone mémoire qui ne doit pas être modifiée dans le corps de celle-ci. Le qualificateur const doit s’appliquer à l’objet pointé.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1452','130','RÈGLE — Les fonctions inline doivent être déclarées comme static','Pour éviter un comportement non défini une fonction inline est systématiquement static.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1453','131','RÈGLE — Interdiction de redéfinir les fonctions ou macros de la bibliothèque standard ou d''une autre','Les identifiants, macros ou noms de fonctions faisant partie de la bibliothèque standard ou d’une autre bibliothèque utilisée ne doivent pas être redéfinis.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1454','132','RÈGLE — La valeur de retour d''une fonction doit toujours être testée','Lorsqu’une fonction retourne une valeur, la valeur retournée doit être systématiquement testée.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1455','133','RÈGLE — Retour implicite interdit pour les fonctions de type non void','Tous les chemins d’une fonction non void doivent retourner une valeur explicitement.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1456','134','RÈGLE — Les structures doivent être passées par référence à une fonction','Il ne faut pas passer de paramètres de type structure par copie lors de l’appel d’une fonction.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1457','135','RECOMMANDATION — Passage d''un tableau en paramètre d''une fonction','Il existe plusieurs façons de passer un tableau en paramètre d’une fonction. Lors du passage par pointeur, il faut préciser dans la documentation de la fonction que le paramètre correspond à un tableau et également utiliser la notation dédiée aux tableaux.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1458','136','RECOMMANDATION — Utilisation obligatoire dans une fonction de tous ses paramètres','Tous les paramètres présents dans le prototype de la fonction doivent être utilisés dans son implémentation.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1459','137','BONNE PRATIQUE — Utiliser les options de compilation -Wformat=2 et -Wformat-security dès qu''une fonc','Plus de détails sur ces options sont données en annexe B.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1460','138','RÈGLE — Ne pas appeler de fonctions variadiques avec NULL en argument','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1461','139','RÈGLE — Usage de la virgule interdit pour le séquencement d''instructions','La virgule n’est pas autorisée dans le cadre du séquencement des instructions decode.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1462','140','RECOMMANDATION — Les opérateurs pré-fixes ++ et -- ne doivent pas être utilisés','Les opérateurs de pré-incrémentation et pré-decrémentation ne seront pas utilisés.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1463','141','RECOMMANDATION — Pas d''utilisation combinée des opérateurs postfixes avec d''autres opérateurs','Les opérateurs de post-incrémentation et de post-décrémentation ne doivent pas être mixés avec d’autres opérateurs.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1464','142','RECOMMANDATION — Éviter l''utilisation d''opérateurs d''affectation combinés','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1465','143','RÈGLE — Non utilisation imbriquée de l''opérateur ternaire ?:','L’imbrication d’opérateurs ternaires ?: est interdite.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1466','144','RÈGLE — Bonne construction des expressions avec l''opérateur ternaire ?:','Les expressions résultantes de l’opérateur ternaire ?: doivent être exactement de même type pour éviter tout transtypage.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1467','145','RÈGLE — Allouer dynamiquement un espace mémoire dont la taille est suffisante pour l''objet alloué','Pour un pointeur ptr, on préférera utiliser ptr=malloc(sizeof(*ptr)); quand cela est possible.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1468','146','RÈGLE — Libérer la mémoire allouée dynamiquement au plus tôt','Tout espace mémoire alloué dynamiquement doit être libéré quand celui-ci n’est plus utile.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1469','147','RÈGLE — Les zones mémoires sensibles doivent être mises à zéro avant d''être libérées.','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1470','148','RÈGLE — Ne pas libérer de mémoire non allouée dynamiquement','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1471','149','RÈGLE — Ne pas modifier l''allocation dynamique via realloc','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1472','150','RÈGLE — Bonne utilisation de l''opérateur sizeof','Une expression contenue dans un sizeof ne doit pas :\n contenir l’opérateur « = » car l’expression ne sera pas évaluée ; \n contenir de déréférencement de pointeur ;\n être appliqué sur un pointeur représentant un tableau.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1473','151','RÈGLE — Vérification obligatoire du succès d''une allocation mémoire','Le succès d’une allocation mémoire doit toujours être vérifié.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1474','152','RÈGLE — L''isolement des données sensibles doit être effectué','Contrôler le bon usage d’une zone mémoire stockant des données sensibles i.e. minimiser l’exposition en mémoire, minimiser la copie et effacer la/les zones ayant contenu les données sensibles au plus tôt.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1475','153','RÈGLE — Initialiser et consulter la valeur de errno avant et après toute exécution d''une fonction de','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1476','154','RÈGLE — La gestion des erreurs retournées par une fonction de la bibliothèque standard doit être sys','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1477','155','RÈGLE — Documentation des codes d''erreur','Tous les codes d’erreur retournés par une fonction doivent être documentés. Dans le cas où plusieurs codes d’erreur peuvent être retournés en même temps par la fonction, la documentation doit définir la priorité de gestion de ces codes.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1478','156','RECOMMANDATION — Structuration des codes de retour','Les codes de retour doivent être structurés de façon à pouvoir obtenir rapidement une information concernant le déroulement de la fonction appelée : \n erreur ; \n type d’erreur ; \n alarme ; \n type d’alarme ; \n ok ;',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1479','157','RÈGLE — Code de retour d''un programme C en fonction du résultat de son exécution','Le code de retour d’un programme C doit avoir une signification afin d’indiquer le bon déroulement du programme ou la survenue d’une erreur : \n la valeur du code de retour doit être comprise entre 0 et 127 ; \n la valeur 0 indique que le programme s’est exécuté sans erreur ;\n la valeur 2 est généralement utilisée sous Unix pour indiquer une erreur dans les arguments passés en paramètres au programme. \nLa signification des codes de retour du programme doit être indiquée dans sa documentation.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1480','158','RECOMMANDATION — Privilégier les retours d''erreurs via des codes de retour dans la fonction principa','Un programme C doit disposer d’une fonction main() minimale. Les retours d’erreurs se font par un retour de code dédié (et donc documenté) de cette fonction.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1481','159','RÈGLE — Ne pas utiliser les fonctions abort() ou _Exit()','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1482','160','RECOMMANDATION — Limiter les appels à exit()','Les appels à la fonction exit() doivent être commentés et non systématiques. Le développeur doit le plus souvent possible les remplacer par un retour de code d’erreur  dans la fonction principale.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1483','161','RÈGLE — Ne pas utiliser les fonctions setjmp() et longjump()','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1484','162','RÈGLE — Ne pas utiliser les bibliothèques standards setjmp.h et stdarg.h','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1485','163','RECOMMANDATION — Limiter l''utilisation des bibliothèques standards manipulant des nombres flottants','Les bibliothèques standards float.h, fenv.h, complex.h et math.h ne doivent être utilisées que si cela est vraiment nécessaire.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1486','164','RÈGLE — Ne pas utiliser les fonctions atoi() atol() atof() et atoll() de la bibliothèque stdlib.h','Les fonctions équivalentes strto*() sont à utiliser en remplacement.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1487','165','RÈGLE — Ne pas utiliser la fonction rand() de la bibliothèque standard','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1488','166','RÈGLE — Utiliser les versions « plus sécurisées » pour les fonctions de la bibliothèque standard','Quand des fonctions de la bibliothèque standard existent en différentes versions, la version « plus sécurisée » doit être utilisée.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1489','167','RÈGLE — Ne pas utiliser de fonctions de la bibliothèque obsolescentes ou devenues obsolètes dans des','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1490','168','RÈGLE — Ne pas utiliser de fonctions de la bibliothèque manipulant des buffers sans prendre la taill','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1491','169','BONNE PRATIQUE — Tout code doit être soumis à relecture','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1492','170','RECOMMANDATION — Indentation des expressions longues','Lorsqu’une instruction ou une expression s’étale sur plusieurs lignes, il est indispensable de l’indenter afin de faciliter la compréhension du code.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1493','171','RÈGLE — Identifier et supprimer tout code mort','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1494','172','RÈGLE — Le code doit être exempt de code non atteignable en dehors de code défensif et de code d''int','Il ne doit jamais y avoir de code inatteignable, sauf s’il s’agit de code défensif ou s’il s’agit de code d’une interface et dans ces deux cas, il faut le préciser en commentaire.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1495','173','RECOMMANDATION — Evaluation outillée du code source pour limiter les risques d''erreurs d''exécution','Le code source du logiciel doit être analysé via au moins un outil d’analyse de code. Les résultats produits par l’outil d’analyse doivent être étudiés par le développeur et les corrections doivent être effectuées par rapport aux problèmes découverts.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1496','174','RECOMMANDATION — Limitation de la complexité cyclomatique','La complexité cyclomatique d’une fonction doit être limitée au maximum.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1497','175','RECOMMANDATION — Limitation de la longueur et la complexité d''une fonction','Une fonction doit être associée idéalement à un seul et unique traitement et doit donc correspondre à un nombre de lignes de code raisonnable.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1498','176','RÈGLE — Ne pas utiliser de mots clés du C++','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1499','177','RÈGLE — Séquences de caractères interdites dans les commentaires','Les séquences /* et // sont interdites dans tous les commentaires. Et un commentaire sur une ligne introduit par // ne doit pas contenir de caractère de continuation de ligne \\.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1500','178','RÈGLE — Mise en oeuvre manuelle de mécanismes « canari » si les options de durcissement ne sont pas ','Vide',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1501','179','RÈGLE — Pas d''assertions de mise au point sur un code mis en production','Les assertions de mise au point ne doivent pas être présentes en production.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1502','180','RECOMMANDATION — La gestion des assertions d''intégrité doit inclure un effacement des données d''urge','Les assertions d’intégrité doivent apparaître en production. En cas de déclenchement d’une assertion d’intégrité, le code de traitement doit aboutir à un effacement d’urgence des données sensibles.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1503','181','RÈGLE — Tout fichier non vide doit se terminer par un retour à la ligne et les directives de preproc','Un fichier non vide ne doit pas se terminer au milieu d’un commentaire ou d’une directive de preprocessing.',NULL,NULL,NULL,NULL,'14','16','1.d');
INSERT INTO `O_regle` VALUES ('1504','1','Former les équipes opérationnelles à la sécurité des systèmes d’information','/ standard\nLes équipes opérationnelles (administrateurs réseau, sécurité et système, chefs de projet, développeurs, RSSI) ont des accès privilégiés au système d’information. Elles peuvent, par inadvertance ou par méconnaissance des conséquences de certaines pratiques, réaliser des opérations génératrices de vulnérabilités. \nCitons par exemple l’affectation de comptes disposant de trop nombreux privilèges par rapport à la tâche à réaliser, l’utilisation de comptes personnels pour exécuter des services ou tâches périodiques, ou encore le choix de mots de passe peu robustes donnant accès à des comptes privilégiés.\nLes équipes opérationnelles, pour être à l’état de l’art de la sécurité des systèmes d’information, doivent donc suivre - à leur prise de poste puis à intervalles réguliers - des formations sur : \n> la législation en vigueur ;\n> les principaux risques et menaces ;\n> le maintien en condition de sécurité ;\n> l’authentification et le contrôle d’accès ;\n> le paramétrage fin et le du',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1505','2','Sensibiliser les utilisateurs aux bonnes pratiques élémentaires de sécurité informatique','/ standard\nChaque utilisateur est un maillon à part entière de la chaîne des systèmes d’information. À ce titre et dès son arrivée dans l’entité, il doit être informé des enjeux de sécurité, des règles à respecter et des bons comportements à adopter en matière de sécurité des systèmes d’information à travers des actions de sensibilisation et de formation.\nCes dernières doivent être régulières, adaptées aux utilisateurs ciblés, peuvent prendre différentes formes (mails, affichage, réunions, espace intranet dédié,etc.) et aborder au minimum les sujets suivants :\n>> les objectifs et enjeux que rencontre l’entité en matière de sécurité dessystèmes d’information ;\n>> les informations considérées comme sensibles ;>> les réglementations et obligations légales ;\n>> les règles et consignes de sécurité régissant l’activité quotidienne : respect de la politique de sécurité, non-connexion d’équipements personnels au réseau de l’entité, non-divulgation de mots de passe à un tiers, non-réutilisation',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1506','3','Maîtriser les risques de l’infogérance','/ standard\nLorsqu’une entité souhaite externaliser son système d’information ou ses données, elle doit en amont évaluer les risques spécifiques à l’infogérance (maîtrise du système d’information, actions à distance, hébergement mutualisé, etc.) afin de prendre en compte, dès la rédaction des exigences applicables au futur prestataire, les besoins et mesures de sécurité adaptés.\nLes risques SSI inhérents à ce type de démarche peuvent être liés au contexte de l’opération d’externalisation mais aussi à des spécifications contractuelles déficientes ou incomplètes.\nEn faveur du bon déroulement des opérations, il s’agit donc :\n>> d’étudier attentivement les conditions des offres, la possibilité de les adapter à des besoins spécifiques et les limites de responsabilité du prestataire ;\n>> d’imposer une liste d’exigences précises au prestataire : réversibilité du contrat, réalisation d’audits, sauvegarde et restitution des données dans un format ouvert normalisé, maintien à niveau de la sécurit',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1507','4','Identifier les informations et serveurs les plus sensibles et maintenir un schéma du réseau','/Standard\nChaque entité possède des données sensibles. Ces dernières peuvent porter sur son activité propre (propriété intellectuelle, savoir-faire, etc.) ou sur ses clients, administrés ou usagers (données personnelles, contrats, etc.). Afin de pouvoir les protéger efficacement, il est indispensable de les identifier.\nÀ partir de cette liste de données sensibles, il sera possible de déterminer sur quels composants du système d’information elles se localisent (bases de données, partages de fichiers, postes de travail, etc.). Ces composants correspondent aux serveurs et postes critiques pour l’entité. À ce titre, ils devront faire l’objet de mesures de sécurité spécifiques pouvant porter sur la sauvegarde, la journalisation, les accès, etc.\nIl s’agit donc de créer et de maintenir à jour un schéma simplifié du réseau (ou cartographie) représentant les différentes zones IP et le plan d’adressage associé, les équipements de routage et de sécurité (pare-feu, relais applicatifs,etc.) et les ',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1508','5','Disposer d’un inventaire exhaustif des comptes privilégiés et le maintenir à jour','/Standard\nLes comptes bénéficiant de droits spécifiques sont des cibles privilégiées par les attaquants qui souhaitent obtenir un accès le plus large possible au système d’information. Ils doivent donc faire l’objet d’une attention toute particulière.\n Il s’agit pour cela d’effectuer un inventaire de ces comptes, de le mettre à jour régulièrement et d’y renseigner les informations suivantes :\n>> les utilisateurs ayant un compte administrateur ou des droits supérieurs à ceux d’un utilisateur standard sur le système d’information ;\n>> les utilisateurs disposant de suffisamment de droits pour accéder aux répertoires de travail des responsables ou de l’ensemble des utilisateurs ;\n>> les utilisateurs utilisant un poste non administré par le service informatique et qui ne fait pas l’objet de mesures de sécurité édictées par la politique de sécurité générale de l’entité.\nIl est fortement recommandé de procéder à une revue périodique de ces comptes afin de s’assurer que les accès aux éléments ',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1509','6','Organiser les procédures d’arrivée, de départ et de changement de fonction des utilisateurs','/ Standard\nLes effectifs d’une entité, qu’elle soit publique ou privée, évoluent sans cesse : arrivées, départs, mobilité interne. Il est par conséquent nécessaire que les droits et les accès au système d’information soient mis à jour en fonction de ces évolutions. Il est notamment essentiel que l’ensemble des droits affectés à une personne soient révoqués lors de son départ ou en cas de changement de fonction. Les procédures d’arrivée et de départ doivent donc être définies, en lien avec la fonction ressources humaines. Elles doivent au minimum prendre en compte :\n>> la création et la suppression des comptes informatiques et boîtes aux lettres associées ;\n>> les droits et accès à attribuer et retirer à une personne dont la fonction change ;\n>> la gestion des accès physiques aux locaux (attribution, restitution des badges et des clés, etc.) ;\n>> l’affectation des équipements mobiles (ordinateur portable, clé USB, disque dur, ordiphone, etc.) ;\n>> la gestion des documents et information',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1510','7','Autoriser la connexion au réseau de l’entité aux seuls équipements maîtrisés','/Standard\nPour garantir la sécurité de son système d’information, l’entité doit maîtriser les équipements qui s’y connectent, chacun constituant un point d’entrée potentiellement vulnérable. Les équipements personnels (ordinateurs portables, tablettes, ordiphones, etc.) sont, par définition, difficilement maîtrisables dans la mesure où ce sont les utilisateurs qui décident de leur niveau de sécurité. De la même manière, la sécurité des équipements dont sont dotés les visiteurs échappe à tout contrôle de l’entité.\n Seule la connexion de terminaux maîtrisés par l’entité doit être autorisée sur ses différents réseaux d’accès, qu’ils soient filaire ou sans fil. Cette recommandation, avant tout d’ordre organisationnel, est souvent perçue comme inacceptable ou rétrograde. Cependant, y déroger fragilise le réseau de l’entité et sert ainsi les intérêts d’un potentiel attaquant.\nLa sensibilisation des utilisateurs doit donc s’accompagner de solutions pragmatiques répondant à leurs besoins. Cito',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1511','8','Identifier nommément chaque personne accédant au système et distinguer les rôles utilisateur /admini','/Standard\nAfin de faciliter l’attribution d’une action sur le système d’information en cas d’incident ou d’identifier d’éventuels comptes compromis, les comptes d’accès doivent être nominatifs.\nL’utilisation de comptes génériques (ex : admin, user) doit être marginale et ceux-ci doivent pouvoir être rattachés à un nombre limité de personnes physiques.\nBien entendu, cette règle n’interdit pas le maintien de comptes de service, rattachés à un processus informatique (ex : apache, mysqld).\nDans tous les cas, les comptes génériques et de service doivent être gérés selon une politique au moins aussi stricte que celle des comptes nominatifs. Par ailleurs, un compte d’administration nominatif, distinct du compte utilisateur, doit être attribué à chaque administrateur. Les identifiants et secrets d’authentification doivent être différents (ex : pmartin comme identifiant utilisateur, adm-pmartin comme identifiant administrateur). Ce compte d’administration, disposant de plus de privilèges, doit ',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1512','9','Attribuer les bons droits sur les ressources sensibles du système d’information','/Standard\nCertaines des ressources du système peuvent constituer une source d’information précieuse aux yeux d’un attaquant (répertoires contenant des données sensibles, bases de données, boîtes aux lettres électroniques, etc.). Il est donc primordial d’établir une liste précise de ces ressources et pour chacune d’entre elles :\n>> de définir quelle population peut y avoir accès ;\n>> de contrôler strictement son accès, en s’assurant que les utilisateurs sont authentifiés et font partie de la population ciblée ;\n>> d’éviter sa dispersion et sa duplication à des endroits non maîtrisés ou soumis à un contrôle d’accès moins strict. \nPar exemple, les répertoires des administrateurs regroupant de nombreuses informations sensibles doivent faire l’objet d’un contrôle d’accès précis. Il en va de même pour les informations sensibles présentes sur des partages réseau : exports de fichiers de configuration, documentation technique du système d’information, bases de données métier, etc. Une revue ré',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1513','10','Définir et vérifier des règles de choix et de dimensionnement des mots de passe','/Standard\nL’ANSSI énonce un ensemble de règles et de bonnes pratiques en matière de choix et de dimensionnement des mots de passe. Parmi les plus critiques de ces règles figure la sensibilisation des utilisateurs aux risques liés au choix d’un mot de passe qui serait trop facile à deviner, ou encore la réutilisation de mots de passe d’une application à l’autre et plus particulièrement entre messageries personnelles et professionnelles.\nPour encadrer et vérifier l’application de ces règles de choix et de dimensionnement, l’entité pourra recourir à différentes mesures parmi lesquelles :\n>> le blocage des comptes à l’issue de plusieurs échecs de connexion ;\n>> la désactivation des options de connexion anonyme ;\n>> l’utilisation d’un outil d’audit de la robustesse des mots de passe.\nEn amont de telles procédures, un effort de communication visant à expliquer le sens de ces règles et éveiller les consciences sur leur importance est fondamental.',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1514','11','Protéger les mots de passe stockés sur les systèmes','/Standard\nLa complexité, la diversité ou encore l’utilisation peu fréquente de certains mots de passe, peuvent encourager leur stockage sur un support physique (mémo, post-it) ou numérique (fichiers de mots de passe, envoi par mail à soimême, recours aux boutons « Se souvenir du mot de passe ») afin de pallier tout oubli ou perte.\nOr, les mots de passe sont une cible privilégiée par les attaquants désireux d’accéder au système, que cela fasse suite à un vol ou à un éventuel partage du support de stockage. C’est pourquoi ils doivent impérativement être protégés au moyen de solutions sécurisées au premier rang desquelles figurent l’utilisation d’un coffre-fort numérique et le recours à des mécanismes de chiffrement.\nBien entendu, le choix d’un mot de passe pour ce coffre-fort numérique doit respecter les règles énoncées précédemment et être mémorisé par l’utilisateur, qui n’a plus que celui-ci à retenir.',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1515','12','Changer les éléments d’authentification par défaut sur les équipements et services','/Standard\nIl est impératif de partir du principe que les configurations par défaut des systèmes d’information sont systématiquement connues des attaquants, quand bien même celles-ci ne le sont pas du grand public. Ces configurations se révèlent (trop) souvent triviales (mot de passe identique à l’identifiant, mal dimensionné ou commun à l’ensemble des équipements et services par exemple) et sont, la plupart du temps, faciles à obtenir pour des attaquants capables de se faire passer pour un utilisateur légitime.\nLes éléments d’authentification par défaut des composants du système doivent donc être modifiés dès leur installation et, s’agissant de mots de passe, être conformes aux recommandations précédentes en matière de choix, de dimensionnement et de stockage.\nSi le changement d’un identifiant par défaut se révèle impossible pour cause, par exemple, de mot de passe ou certificat « en dur » dans un équipement, ce problème critique doit être signalé au distributeur du produit afin que ce',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1516','13','Privilégier lorsque c’est possible une authentification forte','/Standard\nIl est vivement recommandé de mettre en oeuvre une authentification forte nécessitant l’utilisation de deux facteurs d’authentification différents parmi les suivants :\n>> quelque chose que je sais (mot de passe, tracé de déverrouillage, signature) ;\n>> quelque chose que je possède (carte à puce, jeton USB, carte magnétique, RFID, un téléphone pour recevoir un code SMS) ;\n >> quelque chose que je suis (une empreinte biométrique).\n\n/Renforcé\nLes cartes à puces doivent être privilégiées ou, à défaut, les mécanismes de mots de passe à usage unique (ou One Time Password) avec jeton physique. Les opérations cryptographiques mises en place dans ces deux facteurs offrent généralement de bonnes garanties de sécurité.\nLes cartes à puce peuvent être plus complexes à mettre en place car nécessitant une infrastructure de gestion des clés adaptée. Elles présentent cependant l’avantage d’être réutilisables à plusieurs fins : chiffrement, authentification de messagerie, authentification sur ',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1517','14','Mettre en place un niveau de sécurité minimal sur l’ensemble du parc informatique','/Standard\nL’utilisateur plus ou moins au fait des bonnes pratiques de sécurité informatique est, dans de très nombreux cas, la première porte d’entrée des attaquants vers le système. Il est donc fondamental de mettre en place un niveau de sécurité minimal sur l’ensemble du parc informatique de l’entité (postes utilisateurs, serveurs, imprimantes, téléphones, périphériques USB, etc.) en implémentant les mesures suivantes :\n>> limiter les applications installées et modules optionnels des navigateurs web aux seuls nécessaires ;\n>> doter les postes utilisateurs d’un pare-feu local et d’un anti-virus (ceux-ci sont parfois inclus dans le système d’exploitation) ;\n>> chiffrer les partitions où sont stockées les données des utilisateurs ;\n>> désactiver les exécutions automatiques (autorun).\nEn cas de dérogation nécessaire aux règles de sécurité globales applicables aux postes, ceux-ci doivent être isolés du système (s’il est impossible de mettre à jour certaines applications pour des raisons d',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1518','15','Se protéger des menaces relatives à l’utilisation de supports amovibles','/Standard\nLes supports amovibles peuvent être utilisés afin de propager des virus, voler des informations sensibles et stratégiques ou encore compromettre le réseau de l’entité. De tels agissements peuvent avoir des conséquences désastreuses pour l’activité de la structure ciblée.\nS’il n’est pas question d’interdire totalement l’usage de supports amovibles au sein de l’entité, il est néanmoins nécessaire de traiter ces risques en identifiant des mesures adéquates et en sensibilisant les utilisateurs aux risques que ces supports peuvent véhiculer.\nIl convient notamment de proscrire le branchement de clés USB inconnues (ramassées dans un lieu public par exemple) et de limiter au maximum celui de clés non maîtrisées (dont on connait la provenance mais pas l’intégrité) sur le système d’information à moins, dans ce dernier cas, de faire inspecter leur contenu par l’antivirus du poste de travail.\n\n/Renforcé\nSur les postes utilisateur, il est recommandé d’utiliser des solutions permettant d’i',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1519','16','Utiliser un outil de gestion centralisée afin d’homogénéiser les politiques de sécurité','/Standard\nLa sécurité du système d’information repose sur la sécurité du maillon le plus faible. Il est donc nécessaire d’homogénéiser la gestion des politiques de sécurité s’appliquant à l’ensemble du parc informatique de l’entité.\nL’application de ces politiques (gestion des mots de passe, restrictions de connexions sur certains postes sensibles, configuration des navigateurs Web, etc.) doit être simple et rapide pour les administrateurs, en vue notamment de faciliter la mise en oeuvre de contre-mesures en cas de crise informatique.\nPour cela, l’entité pourra se doter d’un outil de gestion centralisée (par exemple Active Directory en environnement Microsoft) auquel il s’agit d’inclure le plus grand nombre d’équipements informatiques possible. Les postes de travail et les serveurs sont concernés par cette mesure qui nécessite éventuellement en amont un travail d’harmonisation des choix de matériels et de systèmes d’exploitation.\nAinsi, des politiques de durcissement du système d’explo',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1520','17','Activer et configurer le parefeu local des postes de travail','/Standard\nAprès avoir réussi à prendre le contrôle d’un poste de travail (à cause, par exemple, d’une vulnérabilité présente dans le navigateur Internet), un attaquant cherchera souvent à étendre son intrusion aux autres postes de travail pour, in fine, accéder aux documents des utilisateurs.\nAfin de rendre plus difficile ce déplacement latéral de l’attaquant, il est nécessaire d’activer le pare-feu local des postes de travail au moyen de logiciels intégrés (pare-feu local Windows) ou spécialisés.\nLes flux de poste à poste sont en effet très rares dans un réseau bureautique classique : les fichiers sont stockés dans des serveurs de fichiers, les applications accessibles sur des serveurs métier, etc.\n\n/Renforcé\nLe filtrage le plus simple consiste à bloquer l’accès aux ports d’administration par défaut des postes de travail (ports TCP 135, 445 et 3389 sous Windows, port TCP 22 sous Unix), excepté depuis les ressources explicitement identifiées (postes d’administration et d’assistance uti',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1521','18','Chiffrer les données sensibles transmises par voie Internet','/Standard\nInternet est un réseau sur lequel il est quasi impossible d’obtenir des garanties sur le trajet que vont emprunter les données que l’on y envoie. Il est donc tout à fait possible qu’un attaquant se trouve sur le trajet de données transitant entre deux correspondants.\nToutes les données envoyées par courriel ou transmises au moyen d’outils d’hébergement en ligne (Cloud) sont par conséquent vulnérables. Il s’agit donc de procéder à leur chiffrement systématique avant de les adresser à un correspondant ou de les héberger.\nLa transmission du secret (mot de passe, clé, etc.) permettant alors de déchiffrer les données, si elle est nécessaire, doit être effectuée via un canal de confiance ou, à défaut, un canal distinct du canal de transmission des données. Ainsi, si les données chiffrées sont transmises par courriel, une remise en main propre du mot de passe ou, à défaut, par téléphone doit être privilégiée.',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1522','19','Segmenter le réseau et mettre en place un cloisonnement entre ces zones','/Standard\nLorsque le réseau est " à plat ", sans aucun mécanisme de cloisonnement, chaque machine du réseau peut accéder à n’importe quelle autre machine.La compromission de l’une d’elles met alors en péril l’ensemble des machines connectées. Un attaquant peut ainsi compromettre un poste utilisateur et ensuite " rebondir " jusqu’à des serveurs critiques. Il est donc important, dès la conception de l’architecture réseau, de raisonner par segmentation en zones composées de systèmes ayant des besoins de sécurité homogènes. On pourra par exemple regrouper distinctement des serveurs d’infrastructure, des serveurs métiers, des postes de travail utilisateurs, des postes de travail administrateurs, des postes de téléphonie sur IP, etc.\nUne zone se caractérise alors par des VLAN et des sous-réseaux IP dédiés voire par des infrastructures dédiées selon sa criticité. Ainsi, des mesures de cloisonnement telles qu’un filtrage IP à l’aide d’un pare-feu peuvent être mises en place entre les différent',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1523','20','S’assurer de la sécurité des réseaux d’accès Wi-Fi et de la séparation des usages','/Standard/nL’usage du Wi-Fi en milieu professionnel est aujourd’hui démocratisé mais présente toujours des risques de sécurité bien spécifiques : faibles garanties en matière de disponibilité, pas de maîtrise de la zone de couverture pouvant mener à une attaque hors du périmètre géographique de l’entité, configuration par défaut des points d’accès peu sécurisée, etc.\nLa segmentation de l’architecture réseau doit permettre de limiter les conséquences d’une intrusion par voie radio à un périmètre déterminé du système d’information. Les flux en provenance des postes connectés au réseau d’accès Wi-Fi doivent donc être filtrés et restreints aux seuls flux nécessaires.\nDe plus, il est important d’avoir recours prioritairement à un chiffrement robuste (mode WPA2, algorithme AES CCMP) et à une authentification centralisée, si possible par certificats clients des machines.\nLa protection du réseau Wi-Fi par un mot de passe unique et partagé est déconseillée. À défaut, il doit être complexe et so',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1524','21','Utiliser des protocoles réseaux sécurisés dès qu’ils existent','/Standard\nSi aujourd’hui la sécurité n’est plus optionnelle, cela n’a pas toujours été le cas. C’est pourquoi de nombreux protocoles réseaux ont dû évoluer pour intégrer cette composante et répondre aux besoins de confidentialité et d’intégrité qu’impose l’échange de données. Les protocoles réseaux sécurisés doivent être utilisés dès que possible, que ce soit sur des réseaux publics (Internet par exemple) ou sur le réseau interne de l’entité.\nBien qu’il soit difficile d’en dresser une liste exhaustive, les protocoles les plus courants reposent sur l’utilisation de TLS et sont souvent identifiables par l’ajout de la lettre « s » (pour secure en anglais) à l’acronyme du protocole.Citons par exemple https pour la navigation Web ou IMAPS, SMTPS ou POP3S pour la messagerie.\nD’autres protocoles ont été conçus de manière sécurisée dès la conception pour se substituer à d’anciens protocoles non sécurisés. Citons par exemple SSH (Secure SHell) venu remplacer les protocoles de communication hist',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1525','22','Mettre en place une passerelle d’accès sécurisé à Internet','/Standard\nL’accès à Internet, devenu indispensable, présente des risques importants : sites Web hébergeant du code malveillant, téléchargement de fichiers « toxiques » et, par conséquent, possible prise de contrôle du terminal, fuite de données sensibles, etc. Pour sécuriser cet usage, il est donc indispensable que les terminaux utilisateurs n’aient pas d’accès réseau direct à Internet.\nC’est pourquoi il est recommandé de mettre en oeuvre une passerelle sécurisée d’accès à Internet comprenant au minimum un pare-feu au plus près de l’accès Internet pour filtrer les connexions et un serveur mandataire (proxy) embarquant différents mécanismes de sécurité. Celui-ci assure notamment l’authentification des utilisateurs et la journalisation des requêtes.\n\n/Renforcé\nDes mécanismes complémentaires sur le serveur mandataire pourront être activés selon les besoins de l’entité : analyse antivirus du contenu, filtrage par catégories d’URLs, etc. Le maintien en condition de sécurité des équipements ',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1526','23','Cloisonner les services visibles depuis Internet du reste du système d’information','/Standard\nUne entité peut choisir d’héberger en interne des services visibles sur Internet (site web, serveur de messagerie, etc.). Au regard de l’évolution et du perfectionnement des cyberattaques sur Internet, il est essentiel de garantir un haut niveau de protection de ce service avec des administrateurs compétents, formés de manière continue (à l’état de l’art des technologies en la matière) et disponibles. Dans le cas contraire, le recours à un hébergement externalisé auprès de professionnels est à privilégier.\nDe plus, les infrastructures d’hébergement Internet doivent être physiquement cloisonnées de toutes les infrastructures du système d’information qui n’ont pas vocation à être visibles depuis Internet.\nEnfin, il convient de mettre en place une infrastructure d’interconnexion de ces services avec Internet permettant de filtrer les flux liés à ces services de manière distincte des autres flux de l’entité. Il s’agit également d’imposer le passage des flux entrants par un serveu',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1527','24','Protéger sa messagerie professionnelle','/Standard\nLa messagerie est le principal vecteur d’infection du poste de travail, qu’il s’agisse de l’ouverture de pièces jointes contenant un code malveillant ou du clic malencontreux sur un lien redirigeant vers un site lui-même malveillant.\nLes utilisateurs doivent être particulièrement sensibilisés à ce sujet : l’expéditeur est-il connu ? Une information de sa part est-elle attendue ? Le lien proposé est-il cohérent avec le sujet évoqué ? En cas de doute, une vérification de l’authenticité du message par un autre canal (téléphone, SMS, etc.) est nécessaire.\nPour se prémunir d’escroqueries (ex : demande de virement frauduleux émanant vraisemblablement d’un dirigeant), des mesures organisationnelles doivent être appliquées strictement.\nPar ailleurs, la redirection de messages professionnels vers une messagerie personnelle est à proscrire car cela constitue une fuite irrémédiable d’informations de l’entité. Si nécessaire des moyens maîtrisés et sécurisés pour l’accès distant à la mess',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1528','25','Sécuriser les interconnexions réseau dédiées avec les partenaires','/Standard\nPour des besoins opérationnels, une entité peut être amenée à établir une interconnexion réseau dédiée avec un fournisseur ou un client (ex : infogérance, échange de données informatisées, flux monétiques, etc.).\nCette interconnexion peut se faire au travers d’un lien sur le réseau privé de l’entité ou directement sur Internet. Dans le second cas, il convient d’établir un tunnel site à site, de préférence IPsec, en respectant les préconisations de l’ANSSI.\nLe partenaire étant considéré par défaut comme non sûr, il est indispensable d’effectuer un filtrage IP à l’aide d’un pare-feu au plus près de l’entrée des flux sur le réseau de l’entité. La matrice des flux (entrants et sortants) devra être réduite au juste besoin opérationnel, maintenue dans le temps et la configuration des équipements devra y être conforme.\n\n/Renforcé\nPour des entités ayant des besoins de sécurité plus exigeants, il conviendra de s’assurer que l’équipement de filtrage IP pour les connexions partenaires e',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1529','26','Contrôler et protéger l’accès aux salles serveurs et aux locaux techniques','/Standard\nLes mécanismes de sécurité physique doivent faire partie intégrante de la sécurité des systèmes d’information et être à l’état de l’art afin de s’assurer qu’ils ne puissent pas être contournés aisément par un attaquant. Il convient donc d’identifier les mesures de sécurité physique adéquates et de sensibiliser continuellement les utilisateurs aux risques engendrés par le contournement des règles.\nLes accès aux salles serveurs et aux locaux techniques doivent être contrôlés à l’aide de serrures ou de mécanismes de contrôle d’accès par badge. Les accès non accompagnés des prestataires extérieurs aux salles serveurs et aux locaux techniques sont à proscrire, sauf s’il est possible de tracer strictement les accès et de limiter ces derniers en fonction des plages horaires. Une revue des droits d’accès doit être réalisée régulièrement afin d’identifier les accès non autorisés.\nLors du départ d’un collaborateur ou d’un changement de prestataire, il est nécessaire de procéder au retr',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1530','27','Interdire l’accès à Internet depuis les postes ou serveurs utilisés pour l’administration du système','/Standard\nUn poste de travail ou un serveur utilisé pour les actions d’administration ne doit en aucun cas avoir accès à Internet, en raison des risques que la navigation Web (à travers des sites contenant du code malveillant) et la messagerie (au travers de pièces jointes potentiellement vérolées) font peser sur son intégrité.\nPour les autres usages des administrateurs nécessitant Internet (consultation de documentation en ligne, de leur messagerie, etc.), il est recommandé de mettre à leur disposition un poste de travail distinct. À défaut, l’accès à une infrastructure virtualisée distante pour la bureautique depuis un poste d’administration est envisageable. La réciproque consistant à fournir un accès distant à une infrastructure d’administration depuis un poste bureautique est déconseillée car elle peut mener à une élévation de privilèges en cas de récupération des authentifiants d’administration.\n\n/Renforcé\nConcernant les mises à jour logicielles des équipements administrés, elles',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1531','28','Utiliser un réseau dédié et cloisonné pour l’administration du système d’information','/Standard\nUn réseau d’administration interconnecte, entre autres, les postes ou serveurs d’administration et les interfaces d’administration des équipements. Dans la logique de segmentation du réseau global de l’entité, il est indispensable de cloisonner spécifiquement le réseau d’administration, notamment vis-à-vis du réseau bureautique des utilisateurs, pour se prémunir de toute compromission par rebond depuis un poste utilisateur vers une ressource d’administration. \nSelon les besoins de sécurité de l’entité, il est recommandé :\n>> de privilégier en premier lieu un cloisonnement physique des réseaux dès que cela est possible, cette solution pouvant représenter des coûts et un temps de déploiement importants ;/Renforcé\n>> à défaut, de mettre en oeuvre un cloisonnement logique cryptographique reposant sur la mise en place de tunnels IPsec. Ceci permet d’assurer l’intégrité et la confidentialité des informations véhiculées sur le réseau d’administration vis-à-vis du réseau bureautique ',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1532','29','Limiter au strict besoin opérationnel les droits d’administration sur les postes de travail','/Standard\nDe nombreux utilisateurs, y compris au sommet des hiérarchies, sont tentés de demander à leur service informatique de pouvoir disposer, par analogie avec leur usage personnel, de privilèges plus importants sur leurs postes de travail : installation de logiciels, configuration du système, etc. Par défaut,il est recommandé qu’un utilisateur du SI, quelle que soit sa position hiérarchique et ses attributions, ne dispose pas de privilèges d’administration sur son poste de travail. Cette mesure, apparemment contraignante, vise à limiter les conséquences de l’exécution malencontreuse d’un code malveillant. La mise à disposition d’un magasin étoffé d’applications validées par l’entité du point de vue de la sécurité permettra de répondre à la majorité des besoins.\nPar conséquent, seuls les administrateurs chargés de l’administration des postes doivent disposer de ces droits lors de leurs interventions.\nSi une délégation de privilèges sur un poste de travail est réellement nécessaire ',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1533','30','Prendre des mesures de sécurisation physique des terminaux nomades','/Standard\nLes terminaux nomades (ordinateurs portables, tablettes, ordiphones) sont, par nature, exposés à la perte et au vol. Ils peuvent contenir localement des informations sensibles pour l’entité et constituer un point d’entrée vers de plus amples ressources du système d’information. Au-delà de l’application au minimum des politiques de sécurité de l’entité, des mesures spécifiques de sécurisation de ces équipements sont donc à prévoir.\nEn tout premier lieu, les utilisateurs doivent être sensibilisés pour augmenter leur niveau de vigilance lors de leurs déplacements et conserver leurs équipements à portée de vue. N’importe quelle entité, même de petite taille, peut être victime d’une attaque informatique. Dès lors, en mobilité, tout équipement devient une cible potentielle voire privilégiée.\nIl est recommandé que les terminaux nomades soient aussi banalisés que possible en évitant toute mention explicite de l’entité d’appartenance (par l’apposition d’un autocollant aux couleurs de ',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1534','31','Chiffrer les données sensibles, en particulier sur le matériel potentiellement perdable','/Standard\nLes déplacements fréquents en contexte professionnel et la miniaturisation du matériel informatique conduisent souvent à la perte ou au vol de celui-ci dans l’espace public. Cela peut porter atteinte aux données sensibles de l’entité qui y sont stockées.\nIl faut donc ne stocker que des données préalablement chiffrées sur l’ensemble des matériels nomades (ordinateurs portables, ordiphones, clés USB, disques durs externes, etc.) afin de préserver leur confidentialité. Seul un secret (mot de passe, carte à puce, code PIN, etc.) pourra permettre à celui qui le possède d’accéder à ces données.\nUne solution de chiffrement de partition, d’archives ou de fichier peut être envisagée selon les besoins. Là encore, il est essentiel de s’assurer de l’unicité et de la robustesse du secret de déchiffrement utilisé. Dans la mesure du possible, il est conseillé de commencer par un chiffrement complet du disque avant d’envisager le chiffrement d’archives ou de fichiers.\nEn effet, ces derniers ',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1535','32','Sécuriser la connexion réseau des postes utilisés en situation de nomadisme','/Standard\nEn situation de nomadisme, il n’est pas rare qu’un utilisateur ait besoin de se connecter au système d’information de l’entité. Il convient par conséquent de s’assurer du caractère sécurisé de cette connexion réseau à travers Internet.\nMême si la possibilité d’établir des tunnels VPN SSL/TLS est aujourd’hui courante, il est fortement recommandé d’établir un tunnel VPN IPsec entre le poste nomade et une passerelle VPN IPsec mise à disposition par l’entité.\nPour garantir un niveau de sécurité optimal, ce tunnel VPN IPsec doit être automatiquement établi et ne pas être débrayable par l’utilisateur, c’est-à-dire qu’aucun flux ne doit pouvoir être transmis en dehors de ce tunnel.\nPour les besoins spécifiques d’authentification aux portails captifs, l’entité peut choisir de déroger à la connexion automatique en autorisant une connexion à la demande ou maintenir cette recommandation en encourageant l’utilisateur à utiliser un partage de connexion sur un téléphone mobile de confiance',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1536','33','Adopter des politiques de sécurité dédiées aux terminaux mobiles','/Standard\nLes ordiphones et tablettes font partie de notre quotidien personnel et/ou professionnel. La première des recommandations consiste justement à ne pas mutualiser les usages personnel et professionnel sur un seul et même terminal, par exemple en ne synchronisant pas simultanément comptes professionnel et personnel de messagerie, de réseaux sociaux, d’agendas, etc.\nLes terminaux, fournis par l’entité et utilisés en contexte professionnel doivent faire l’objet d’une sécurisation à part entière, dès lors qu’ils se connectent au système d’information de l’entité ou qu’ils contiennent des informations professionnelles potentiellement sensibles (mails, fichiers partagés, contacts, etc.). Dès lors, l’utilisation d’une solution de gestion centralisée des équipements mobiles est à privilégier. Il sera notamment souhaitable de configurer de manière homogène les politiques de sécurité inhérentes : moyen de déverrouillage du terminal, limitation de l’usage du magasin d’applications à des a',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1537','34','Définir une politique de mise à jour des composants du système d’information','/Standard\nDe nouvelles failles sont régulièrement découvertes au coeur des systèmes et logiciels. Ces dernières sont autant de portes d’accès qu’un attaquant peut exploiter pour réussir son intrusion dans le système d’information. Il est donc primordial de s’informer de l’apparition de nouvelles vulnérabilités (CERTFR) et d’appliquer les correctifs de sécurité sur l’ensemble des composants du système dans le mois qui suit leur publication par l’éditeur. Une politique de mise à jour doit ainsi être définie et déclinée en procédures opérationnelles.\nCelles-ci doivent notamment préciser :\n>> la manière dont l’inventaire des composants du système d’information est réalisé ;\n>> les sources d’information relatives à la publication des mises à jour ;\n>> les outils pour déployer les correctifs sur le parc (par exemple WSUS pour les mises à jour des composants Microsoft, des outils gratuits ou payants pour les composants tiers et autres systèmes d’exploitation) ;\n>> l’éventuelle qualification d',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1538','35','Anticiper la fin de la maintenance des logiciels et systèmes et limiter les adhérences logicielles','/Standard\nL’utilisation d’un système ou d’un logiciel obsolète augmente significativement les possibilités d’attaque informatique. Les systèmes deviennent vulnérables dès lors que les correctifs ne sont plus proposés. En effet, des outils malveillants exploitant ces vulnérabilités peuvent se diffuser rapidement sur Internet alors même que l’éditeur ne propose pas de correctif de sécurité.\nPour anticiper ces obsolescences, un certain nombre de précautions existent :\n>> établir et tenir à jour un inventaire des systèmes et applications du système d’information ;\n>> choisir des solutions dont le support est assuré pour une durée correspondant à leur utilisation ;\n>> assurer un suivi des mises à jour et des dates de fin de support des logiciels ;\n>> maintenir un parc logiciel homogène (la coexistence de versions différentes d’un même produit multiplie les risques et complique le suivi) ;\n>> limiter les adhérences logicielles, c’est-à-dire les dépendances de fonctionnement d’un logiciel par',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1539','36','Activer et configurer les journaux des composants les plus importants','/Standard\nDisposer de journaux pertinents est nécessaire afin de pouvoir détecter d’éventuels dysfonctionnements et tentatives d’accès illicites aux composants du système d’information.\nLa première étape consiste à déterminer quels sont les composants critiques du système d’information. Il peut notamment s’agir des équipements réseau et de sécurité, des serveurs critiques, des postes de travail d’utilisateurs sensibles, etc.\nPour chacun, il convient d’analyser la configuration des éléments journalisés (format, fréquence de rotation des fichiers, taille maximale des fichiers journaux, catégories d’évènements enregistrés, etc.) et de l’adapter en conséquence.\nLes évènements critiques pour la sécurité doivent être journalisés et gardés pendant au moins un an (ou plus en fonction des obligations légales du secteur d’activités).\nUne étude contextuelle du système d’information doit être effectuée et les éléments suivants doivent être journalisés :\n>> pare-feu : paquets bloqués ;\n>> systèmes ',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1540','37','Définir et appliquer une politique de sauvegarde des composants critiques','/Standard\nSuite à un incident d’exploitation ou en contexte de gestion d’une intrusion, la disponibilité de sauvegardes conservées en lieu sûr est indispensable à la poursuite de l’activité. Il est donc fortement recommandé de formaliser une politique de sauvegarde régulièrement mise à jour. Cette dernière a pour objectif de définir des exigences en matière de sauvegarde de l’information, des logiciels et des systèmes.\nCette politique doit au moins intégrer les éléments suivants :\n>> la liste des données jugées vitales pour l’organisme et les serveurs concernés ;\n>> les différents types de sauvegarde (par exemple le mode hors ligne) ;\n>> la fréquence des sauvegardes ;\n>> la procédure d’administration et d’exécution des sauvegardes ;\n>> les informations de stockage et les restrictions d’accès aux sauvegardes ;\n>> les procédures de test de restauration ;\n>> la destruction des supports ayant contenu les sauvegardes.\nLes tests de restauration peuvent être réalisés de plusieurs manières :\n>',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1541','38','Procéder à des contrôles et audits de sécurité réguliers puis appliquer les actions correctives asso','/Renforcé\nLa réalisation d’audits réguliers (au moins une fois par an) du système d’information est essentielle car elle permet d’évaluer concrètement l’efficacité des mesures mises en oeuvre et leur maintien dans le temps. Ces contrôles et audits permettent également de mesurer les écarts pouvant persister entre la règle et la pratique.\nIls peuvent être réalisés par d’éventuelles équipes d’audit internes ou par des sociétés externes spécialisées. Selon le périmètre à contrôler, des audits techniques et/ou organisationnels seront effectués par les professionnels mobilisés. Ces audits sont d’autant plus nécessaires que l’entité doit être conforme à des réglementations et obligations légales directement liées à ses activités.\nÀ l’issue de ces audits, des actions correctives doivent être identifiées, leur application planifiée et des points de suivi organisés à intervalles réguliers. Pour une plus grande efficacité, des indicateurs sur l’état d’avancement du plan d’action pourront être in',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1542','39','Désigner un référent en sécurité des systèmes d’information et le faire connaître auprès du personne','/Standard\nToute entité doit disposer d’un référent en sécurité des systèmes d’information qui sera soutenu par la direction ou par une instance décisionnelle spécialisée selon le niveau de maturité de la structure.\nCe référent devra être connu de tous les utilisateurs et sera le premier contact pour toutes les questions relatives à la sécurité des systèmes d’information :\n>> définition des règles à appliquer selon le contexte ;\n>> vérification de l’application des règles ;\n>> sensibilisation des utilisateurs et définition d’un plan de formation des acteurs informatiques ;\n>> centralisation et traitement des incidents de sécurité constatés ou remontés par les utilisateurs.\nCe référent devra être formé à la sécurité des systèmes d’information et à la gestion de crise.\nDans les entités les plus importantes, ce correspondant peut être désigné pour devenir le relais du RSSI. Il pourra par exemple signaler les doléances des utilisateurs et identifier les thématiques à aborder dans le cadre d',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1543','40','Définir une procédure de gestion des incidents de sécurité','/Standard\nLe constat d’un comportement inhabituel de la part d’un poste de travail ou d’un serveur (connexion impossible, activité importante, activités inhabituelles, services ouverts non autorisés, fichiers créés, modifiés ou supprimés sans autorisation, multiples alertes de l’antivirus, etc.) peut alerter sur une éventuelle intrusion.\nUne mauvaise réaction en cas d’incident de sécurité peut faire empirer la situation et empêcher de traiter correctement le problème. Le bon réflexe est de déconnecter la machine du réseau, pour stopper l’attaque. En revanche, il faut la maintenir sous tension et ne pas la redémarrer, pour ne pas perdre d’informations utiles pour l’analyse de l’attaque. Il faut ensuite prévenir la hiérarchie, ainsi que le référent en sécurité des systèmes d’information.\nCelui-ci peut prendre contact avec un prestataire de réponse aux incidents de sécurité (PRIS) afin de faire réaliser les opérations techniques nécessaires (copie physique du disque, analyse de la mémoire',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1544','41','Mener une analyse de risques formelle','/Renforcé\nChaque entité évolue dans un environnement informationnel complexe qui lui est propre. Aussi, toute prise de position ou plan d’action impliquant la sécurité du système d’information doit être considéré à la lumière des risques pressentis par la direction. En effet, qu’il s’agisse de mesures organisationnelles ou techniques, leur mise en oeuvre représente un coût pour l’entité qui nécessite de s’assurer qu’elles permettent de réduire au bon niveau un risque identifié.\nDans les cas les plus sensibles, l’analyse de risque peut remettre en cause certains choix passés. Ce peut notamment être le cas si la probabilité d’apparition d’un événement et ses conséquences potentielles s’avèrent critiques pour l’entité et qu’il n’existe aucune action préventive pour le maîtriser.\nLa démarche recommandée consiste, dans les grandes lignes, à définir le contexte, apprécier les risques et les traiter. L’évaluation de ces risques s’opère généralement selon deux axes : leur probabilité d’apparit',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1545','42','Privilégier l’usage de produits et de services qualifiés par l’ANSSI','/Renforcé\nLa qualification prononcée par l’ANSSI offre des garanties de sécurité et de confiance aux acheteurs de solutions listées dans les catalogues de produits et de prestataires de service qualifiés que publie l’agence.\nAu-delà des entités soumises à réglementation, l’ANSSI encourage plus généralement l’ensemble des entreprises et administrations françaises à utiliser des produits qu’elle qualifie, seul gage d’une étude sérieuse et approfondie du fonctionnement technique de la solution et de son écosystème.\nS’agissant des prestataires de service qualifiés, ce label permet de répondre aux enjeux et projets de cybersécurité pour l’ensemble du tissu économique français que l’ANSSI ne saurait adresser seule. Évalués sur des critères techniques et organisationnels, les prestataires qualifiés couvrent l’essentiel des métiers de la sécurité des systèmes d’information. Ainsi, en fonction de ses besoins et du maillage national, une entité pourra faire appel à un Prestataire d’audit de la s',NULL,NULL,NULL,NULL,'15','16','1.d');
INSERT INTO `O_regle` VALUES ('1546','1','RÈGLE — Application de conventions de codage claires et explicites','Des conventions de codage doivent être définies et documentées pour le logiciel à produire. Ces conventions doivent définir au minimum les points suivants : l’encodage des fichiers sources, la mise en page du code et l’indentation, les types standards à utiliser, le nommage (bibliothèques, fichiers, fonctions, types, variables, . . .), le format de la documentation. Ces conventions doivent être appliquées par chaque développeur.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1547','2','RÈGLE — Seul le codage C conforme au standard est autorisé','Aucune violation des contraintes et de la syntaxe C telles que définies dans les standards C90 ou C99 n’est autorisée.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1548','3','RECOMMANDATION — Maîtrise des actions opérées à la compilation.',' Le développeur doit connaître et documenter les actions associées aux options activées du compilateur y compris en terme d’optimisation de code',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1549','4','RÈGLE — Définir précisément les options de compilation','Les options utilisées pour la compilation doivent être précisément définies pour l’ensemble des sources d’un logiciel. Ces options doivent notamment fixer précisément :\n- la version du standard C utilisée (par exemple C99 ou encore C90) ;\n- le nom et la version du compilateur utilisé ;',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1550','5','RÈGLE — Utiliser des options de durcissement','L’utilisation d’options de durcissement est obligatoire que ce soit pour imposer la génération d’exécutables relocalisables, une randomization d’adresses efficace ou la protection contre le dépassement de pile entre autres.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1551','6','BONNE PRATIQUE — Utiliser des générateurs de projets pour la compilation.','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1552','7','RÈGLE — Compiler le code sans erreur ni avertissement en activant des options de compilation exigent','Activer le niveau d’avertissement et d’erreur le plus élevé du compilateur et de l’éditeur de liens afin de s’assurer de l’absence de problèmes potentiels liés à l’utilisation incorrecte du langage de programmation et traiter tous les avertissements et toutes les erreurs signalés par le compilateur et l’éditeur de liens pour les éliminer.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1553','8','RECOMMANDATION — Utiliser les options des compilations les plus exigentes','Si une option élevée d’un compilateur n’apparaît pas pertinente pour un développement donné, une justification sera fournie pour expliquer ce choix.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1554','9','RÈGLE — Tout code mis en production doit être compilé en mode release','La compilation en mode release est obligatoire pour une mise en production.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1555','10','RECOMMANDATION — Prêter une attention particulière aux modes debug et release lors de la compilation','L’utilisation des modes debug et release à la compilation doit se faire en toute connaissance des modifications induites en terme de gestion de mémoire et d’optimisation de code. Les différences entre ces deux modes doivent être documentées de manière exhaustive.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1556','11','RECOMMANDATION — Limiter et justifier les inclusions de fichier d''en-tête dans un autre fichier d''en','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1557','12','RECOMMANDATION — Limiter et justifier les inclusions de fichier d''en-tête dans un autre fichier d''en','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1558','13','RÈGLE — Utiliser des macros de garde d''inclusion multiple d''un fichier','Une macro de garde contre l’inclusion multiple d’un fichier doit être utilisée afin d’empêcher que le contenu d’un fichier d’en-tête soit inclus plus d’une fois :\n// début du fichier d''en -tête\n#ifndef HEADER_H\n#define HEADER_H\n/* contenu du fichier */\n#endif\n//fin du fichier d''en -tête',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1559','14','RÈGLE — Les inclusions de fichiers d''en-tête sont groupées en début de fichier','Toutes les inclusions de fichiers d’en-tête doivent être regroupées au début du fichier ou juste après des commentaires ou les directives de preprocessing, mais systématiquement avant la définition de variables globales ou de fonctions.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1560','15','RECOMMANDATION — Les inclusions de fichiers d''en-tête systèmes sont effectuées avant les inclusions ','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1561','16','BONNE PRATIQUE — Utiliser l''ordre alphabétique dans l''inclusion de chaque type de fichiers d''en-tête','Pour éviter les redondances dans les inclusions de fichiers d’en-tête systèmes ou utilisateur, le développeur peut les ordonner par ordre alphabétique ce qui permet d’avoir un ordre d’inclusion déterministe et de faciliter la revue de code.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1562','17','RÈGLE — Ne pas inclure un fichier source dans un autre fichier source','Seule l’inclusion de fichiers d’en-tête est autorisée dans un fichier source.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1563','18','RÈGLE — Les chemins des fichiers doivent être portables et la casse doit être respectée','Les chemins de fichiers, que ce soit pour une directive d’inclusion #include ou non, doivent être portables tout en respectant la casse des répertoires.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1564','19','RÈGLE — Le nom d''un fichier d''en-tête ne doit pas contenir certains caractères ou séquences de carac','Le nom d’un fichier d’en-tête doit être exempt des caractères et des séquences de caractères suivants : « '', ", \\, /* et // ».',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1565','20','RECOMMANDATION — Les blocs préprocesseurs doivent être commentés','Les directives des blocs préprocesseurs doivent être commentées afin d’expliciter le cas traité et pour les directives « intermédiaires » et « fermantes », celles-ci doivent aussi être associées à la directive « ouvrante » correspondante par le biais d’un commentaire.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1566','21','BONNE PRATIQUE — La double négation dans l''expression des conditions des blocs préprocesseurs doit ê','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1567','22','RÈGLE — Définition d''un bloc préprocesseur dans un seul et même fichier','Pour un bloc préprocesseur, toutes les directives associées doivent se trouver dans le même fichier.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1568','23','RECOMMANDATION — Les expressions de contrôle des directives de preprocessing doivent être bien formé','Les expressions de contrôle doivent être évaluées uniquement à 0 ou 1 et doivent utiliser uniquement des identifiants définis (via #define).',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1569','24','RÈGLE — Ne pas utiliser dans une même expression plus d''un des opérateurs de preprocessing # et ##','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1570','25','RÈGLE — Utiliser les opérateurs de preprocessing # et ## en maîtrisant leur expansion','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1571','26','RÈGLE — Les macros doivent être nommées de façon spécifique','Pour différencier aisément les macros des fonctions et ne pas utiliser un nom réservé d’une autre macro C, les macros préprocesseurs doivent être en capitales et les mots composant le nom séparés par le caractère souligné « _ » mais sans les faire débuter par le caractère souligné car il s’agit d’une convention pour les noms réservés du langage C.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1572','27','RÈGLE — Ne pas terminer une macro par un point-virgule','Le point-virgule final doit être omis à la fin de la définition d’une macro.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1573','28','Le point-virgule final doit être omis à la fin de la définition d’une macro.','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1574','29','RÈGLE — L''expansion d''une macro définie par le développeur ne doit pas créer de fonction','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1575','30','RÈGLE — Les macros contenant plusieurs instructions doivent utiliser une boucle do { ... } while(0) ','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1576','31','RÈGLE — Parenthèses obligatoires autour des paramètres utilisés dans le corps d''une macro','Les paramètres d’une macro doivent systématiquement être entourés de parenthèses lors de leur utilisation, afin de préserver l’ordre souhaité d’évaluation des expressions.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1577','32','RECOMMANDATION — Il faut éviter les arguments d''une macro réalisant une opération','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1578','33','RÈGLE — Les arguments d''une macro ne doivent pas contenir d''effets de bord.','Des arguments de macro avec des effets de bord peuvent entraîner des évaluations multiples non désirées.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1579','34','RÈGLE — Ne pas utiliser de directives de preprocessing en arguments d''une macro','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1580','35','RÈGLE — La directive #undef ne doit pas être utilisée','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1581','36','RÈGLE — Ne pas utiliser de trigraphes','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1582','37','RECOMMANDATION — Les points d''interrogation ne doivent pas être utilisés de façon successive','Cette règle s’applique pour toute partie du code mais aussi pour les commentaires.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1583','38','RECOMMANDATION — Seules les déclarations multiples de variables simples de même type sont autorisées','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1584','39','RÈGLE — Ne pas faire de déclaration multiple de variables associée à une initialisation.','Les initialisations associées (i.e. consécutives et dans une même instruction) à une déclaration multiple sont interdites.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1585','40','RECOMMANDATION — Regrouper les déclarations de variables en début du bloc dans lequel elles sont uti','Pour des questions de lisibilité et pour éviter les redéfinitions, les déclarations de variables sont regroupées en début de fichier, fonction ou bloc d’instructions selon leur portée.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1586','41','RÈGLE — Ne pas utiliser des valeurs en dur','Les valeurs utilisées dans le code doivent être déclarées comme des constantes.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1587','42','BONNE PRATIQUE — Centraliser la déclaration des constantes en début de fichier','Pour faciliter la lecture, les constantes sont déclarées ensemble en début du fichier.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1588','43','RÈGLE — Déclarer les constantes en capitales','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1589','44','RÈGLE — Les constantes sans contrôle de type sont déclarées avec la macro préprocesseur de définitio','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1590','45','RÈGLE — Les constantes avec un contrôle de type explicite doivent être déclarées avec le mot clé con','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1591','46','RÈGLE — Les valeurs constantes doivent être associées à un suffixe dépendant du type','Pour éviter toute mauvaise interprétation, les valeurs constantes doivent utiliser un suffixe selon leurs types :\n il faut utiliser le suffixe U pour toutes les constantes de type entier non signé ; \n pour indiquer une constante de type long (ou long long pour C99), il faut utiliser le suffixe L (resp. LL) et non l (resp. ll) afin d’éviter toute ambiguïté avec le chiffre 1 ;\n les valeurs flottantes sont par défaut considérées comme double, il faut utiliser le suffixe f pour le type float (resp. d pour le type double).',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1592','47','RÈGLE — La taille du type associé à une expression constante doit être suffisante pour la contenir','Il faut s’assurer que les valeurs ou expressions constantes utilisées ne dépassent pas du type qui leur est associé.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1593','48','RECOMMANDATION — Proscrire les constantes en octal','Ne pas utiliser de constante ni de séquence d’échappement en octal.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1594','49','RÈGLE — Limiter les variables globales au strict nécessaire','Limiter l’usage des variables globales et préférer les paramètres de fonctions pour propager une structure de données au travers d’une application.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1595','50','RÈGLE — Utilisation systématique du modificateur de déclaration static','Utiliser le mot clef static pour toutes les fonctions et variables globales qui ne sont pas utilisées à l’extérieur du fichier source dans lequel elles sont définies.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1596','51','RÈGLE — Seules les variables modifiables en dehors de l''implémentation doivent être déclarées volati','Seules les variables associées à des ports entrée/sortie ou des fonctions d’interruption asynchrone doivent être déclarées comme volatile pour empêcher toute optimisation ou réorganisation à la compilation.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1597','52','RÈGLE — Seuls des pointeurs spécifiés volatile peuvent accéder à des variables volatile','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1598','53','RÈGLE — Aucune omission de type n''est acceptée lors de la déclaration d''une variable','Toutes les variables utilisées doivent avoir été préalablement déclarées de façon explicite.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1599','54','RECOMMANDATION — Limiter l''utilisation des compound literals','Du fait du risque de mauvaise manipulation des compound literals, leur utilisation doit être limitée, documentée et une attention particulière doit être donnée à leur portée.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1600','55','RÈGLE — Ne pas mélanger des constantes explicites et implicites dans une énumération','Il faut soit expliciter toutes les constantes d’une énumération avec une valeur unique soit n’en expliciter aucune.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1601','56','RÈGLE — Ne pas utiliser des énumérations anonymes','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1602','57','RECOMMANDATION — Les variables doivent être initialisées à la déclaration ou immédiatement après','Toutes les variables doivent être systématiquement initialisées à leur déclaration ou immédiatement après dans le cas de déclarations multiples.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1603','58','RÈGLE — Ne pas mélanger les différents types d''initialisation pour les variables structurées','Pour l’initialisation d’une variable structurée, un seul et unique type d’initialisation doit être choisi et utilisé.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1604','59','RÈGLE — Les variables structurées ne doivent pas être initialisées sans expliciter la valeur d''initi','Les variables non scalaires doivent être initialisées explicitement : chaque élément doit être initialisé en étant clairement identifié sans valeur d’initialisation superflue ou la notation ={0} ; peut être utilisée à la déclaration. Enfin les tailles des tableaux doivent être explicitées à l’initialisation.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1605','60','RECOMMANDATION — Chaque déclaration publique (non static) doit être utilisée','Toutes les déclarations publiques (i.e. non static) doivent être utilisées, qu’il s’agissede variables, fonctions, labels ou autres.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1606','61','RÈGLE — Utiliser des variables pour les données sensibles distinctes des variables pour les données ','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1607','62','RÈGLE — Utiliser des variables pour les données sensibles et protégées en confidentialité et/ou inté','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1608','63','RÈGLE — Ne jamais coder en dur une donnée sensible.','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1609','64','RECOMMANDATION — Seuls des types d''entiers dont la taille et le signe sont explicites doivent être u','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1610','65','RÈGLE — Seuls les types signed char et unsigned char doivent être utilisés.','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1611','66','RECOMMANDATION — Ne pas redéfinir des alias de types','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1612','67','RÈGLE — Compréhension fine et précise des règles de conversions','Le développeur se doit de connaître et comprendre toutes les règles de conversionimplicites des types entiers.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1613','68','RÈGLE — Conversions explicites entre des types signés et non signés','Proscrire les conversions implicites de types. Utiliser des conversions explicites notamment entre type signé et type non signé.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1614','69','RECOMMANDATION — Ne pas utiliser de transtypage de pointeurs sur des types structurés différents','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1615','70','RÈGLE — L''accès aux éléments d''un tableau se fera toujours en désignant en premier attribut le table','L’accès au ième élément d’un tableau s’écrira toujours avec le nom du tableau en premier suivi de l’indice de la case à atteindre.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1616','71','RECOMMANDATION — L''accès aux éléments d''un tableau doit se faire en utilisant les crochets','Dans le cas d’une variable de type tableau, la notation dédiée (via les crochets) doit être utilisée pour éviter toute ambiguïté.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1617','72','RÈGLE — Ne pas utiliser de VLA','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1618','73','RECOMMANDATION — Ne pas utiliser de taille implicite pour les tableaux','Afin de s’assurer que les accès tableaux sont bien valides, la taille de ceux-ci doit être explicitée.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1619','74','RÈGLE — Utiliser des entiers non signés pour les tailles de tableaux','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1620','75','RÈGLE — Ne pas accèder à un élément de tableau sans vérifier la validité de l''indice utilisé','La validité des indices de tableau utilisés doit être vérifié de façon systématique : un indice de tableau est valide s’il est supérieur ou égal à zéro et strictement inférieur à la taille déclarée du tableau. Dans le cas d’un tableau de caractères, le caractère de fin de chaine ’\\0’ doit être pris en compte.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1621','76','RÈGLE — Un pointeur NULL ne doit pas être déréférencé','Avant de déréférencer un pointeur, le développeur doit s’assurer que celui-ci n’est pas NULL.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1622','77','RÈGLE — Un pointeur doit être affecté à NULL après désallocation','Un pointeur doit être systématiquement affecté à NULL suite à la désallocation de la mémoire qu’il pointe.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1623','78','RÈGLE — Ne pas utiliser le qualificateur de pointeur restrict','Le qualificateur restrict ne doit pas être utilisé directement par le développeur. Seule l’utilisation indirecte i.e. via l’appel de fonctions de la bibliothèque standard est tolérée mais le développeur devra s’assurer qu’aucun comportement indéfini résultera de l’utilisation de telles fonctions.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1624','79','RECOMMANDATION — Le nombre de niveau d''indirections de pointeur doit être limité à deux','Le nombre d’indirections pour un pointeur ne doit pas dépasser deux niveaux.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1625','80','RECOMMANDATION — Préférer l''utilisation de l''opérateur d''indirection ->','L’opérateur d’indirection -> doit être utilisé pour atteindre les champs d’une structure par l’intermédiaire d’un pointeur.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1626','81','RÈGLE — Seul l''incrément ou le décrément de pointeurs de tableaux est autorisé','L’incrément ou le décrément de pointeurs ne doit être utilisé que sur des pointeurs représentant un tableau ou un élément d’un tableau.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1627','82','RÈGLE — Aucune arithmétique sur les pointeurs void* n''est autorisée','Il faut proscrire l’utilisation de toute arithmétique sur des pointeurs de type void*.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1628','83','RECOMMANDATION — Arithmétique des pointeurs sur tableaux contrôlée','L’arithmétique sur des pointeurs représentant un tableau ou un élément d’un tableau doit être faite en s’assurant que le pointeur résultant pointera toujours sur un élément du même tableau.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1629','84','RÈGLE — Soustraction et comparaison entre pointeurs d''un même tableau uniquement','Seules les soustractions et comparaisons de pointeurs sur un même tableau sont autorisés.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1630','85','RECOMMANDATION — Il ne faut pas affecter directement une adresse fixe à un pointeur.','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1631','86','RÈGLE — Une structure doit être utilisée pour regrouper les données représentant une même entité','Les données liées doivent être regroupées au sein d’une structure.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1632','87','RÈGLE — Ne pas calculer la taille d''une structure comme la somme de la taille de ses champs','Du fait du padding, la taille d’une structure ne doit pas être supposée comme la somme de la taille de ses champs.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1633','88','RÈGLE — Tout bitfield doit obligatoirement être déclaré explicitement comme non signé','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1634','89','RÈGLE — Ne pas faire d''hypothèse sur la représentation interne de structures avec des bitfields','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1635','90','RÈGLE — Ne pas utiliser les FAM','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1636','91','RECOMMANDATION — Ne pas utiliser les unions','L’utilisation du même espace mémoire pour plusieurs données de natures différentes n’est pas autorisée.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1637','92','RÈGLE — Supprimer tous les débordements de valeurs possibles pour des entiers signés.','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1638','93','RECOMMANDATION — Détecter tous les wraps possibles de valeurs pour les entiers non signés.','vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1639','94','RÈGLE — Détecter et supprimer toute potentielle division par zéro','Cette vérification doit être systématique pour tout calcul de division ou de reste de division.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1640','95','RECOMMANDATION — Les opérations arithmétiques doivent être écrites en favorisant leur lisibilité','Il faut utiliser des opérations arithmétiques le plus explicites possibles (naturelles) et dans la logique du programme.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1641','96','RECOMMANDATION — Les opérateurs logiques ne doivent pas être appliqués avec des opérandes signés','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1642','97','RÈGLE — Explicitation de l''ordre d''évaluation des calculs par utilisation de parenthèses','Malgré la priorité des opérateurs, pour éviter toute ambiguïté, les expressions seront entourées de parenthèses pour rendre plus explicite l’ordre d’évaluation d’un calcul.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1643','98','RECOMMANDATION — Eviter les expressions de comparaison ou d''égalité multiple','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1644','99','RÈGLE — Toujours utiliser les parenthèses dans les expressions de comparaison ou d''égalité multiple','Les expressions booléennes de comparaison ou d’égalité contenant au moins 2 opérateurs relationnels sont interdites sans parenthèse.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1645','100','RÈGLE — Parenthèses autour des éléments d''une expression booléenne','Il est nécessaire de toujours mettre entre parenthèses les différents éléments d’une expression booléenne, afin qu’il n’y ait aucune ambiguïté dans l’ordre d’évaluation.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1646','101','RÈGLE — Comparaison implicite avec 0 interdite','Toutes les expressions booléennes doivent utiliser des opérateurs de comparaison. Aucun test implicite avec une valeur égale à 0 ou différente de 0 ne doit être effectué.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1647','102','RECOMMANDATION — Utilisation du type bool en C99','En C99, le type bool (ou _Bool) doit être utilisé pour les variables à valeurs booléennes.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1648','103','RÈGLE — Pas d''opérateur bit-à-bit sur un opérande de type booléen ou assimilé','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1649','104','BONNE PRATIQUE — Ne pas utiliser la valeur retournée lors d''une affectation','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1650','105','RÈGLE — Affectation interdite dans une expression booléenne','Une affectation ne doit pas être effectuée dans une expression booléenne quelle qu’elle soit. Une affectation doit être effectuée dans une instruction indépendante.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1651','106','BONNE PRATIQUE — Comparaison avec opérande constant à gauche','Quand une comparaison fait intervenir un opérande constant celui-ci sera de préférence mis comme opérande gauche pour éviter une affectation non intentionnelle.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1652','107','RÈGLE — Affectation multiple de variables interdite','L’affectation multiple de variables n’est pas autorisée.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1653','108','RÈGLE — Une seule instruction par ligne de code','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1654','108','BONNE PRATIQUE — Éviter les constantes flottantes','Ne pas utiliser de constantes numériques flottantes pour éviter les pertes de précision et autres phénomènes liés aux nombres flottants. Si cela ne peut être évité, la représentativité de la valeur flottante en question doit être vérifiée.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1655','110','RECOMMANDATION — Limiter l''utilisation des nombres flottants au strict nécessaire','Il faut limiter l’utilisation des nombres flottants.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1656','111','RÈGLE — Pas de compteur de boucle de type flottant','Les compteurs de boucle doivent être uniquement de type entier, avec la vérification de non débordement de type des valeurs des compteurs.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1657','112','RÈGLE — Ne pas utiliser de nombres flottants pour des comparaisons d''égalité ou d''inégalité','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1658','113','RECOMMANDATION — Non utilisation des nombres complexes','Les nombres complexes introduits depuis C99 ne doivent pas être utilisés.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1659','114','RÈGLE — Utilisation systématique des accolades pour les conditionnelles et les boucles','Ne jamais omettre les accolades pour délimiter un bloc d’instructions. Les accolades doivent être écrites pour délimiter un bloc d’instructions après les boucles (for, while, do) et les conditionnelles (if, else).',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1660','115','RÈGLE — Définition systématique d''un cas par défaut dans les switch','Un switch-case doit toujours contenir un cas default placé en dernier.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1661','116','RECOMMANDATION — Utilisation de break dans chaque cas des instructions switch','Un switch-case doit par défaut toujours contenir un break pour chaque cas. L’absence de break pour éviter de dupliquer du code est tolérée mais doit être explicitée dans un commentaire.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1662','117','RECOMMANDATION — Pas d''imbrication de structure de contrôle dans un switch-case',' Même si le C l’autorise, l’imbrication de structures de contrôle à l’intérieur d’un switch est à éviter.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1663','118','RÈGLE — Ne pas introduire d''instructions avant le premier label d''un switch-case','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1664','119','RÈGLE — Bonne construction des boucles for','Chaque élément d’une boucle for doit être complété et contenir exactement une seule instruction. Ainsi une boucle for doit contenir une initialisation de son compteur, une condition d’arrêt portant sur son compteur, et une incrémentation ou décrémentation du compteur de boucle.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1665','120','RÈGLE — Modification d''un compteur d''une boucle for interdite dans le corps de la boucle','Le compteur d’une boucle for ne doit pas être modifié à l’intérieur du corps de la boucle for.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1666','121','RÈGLE — Non utilisation de goto arrière (backward goto)','Proscrire, au sein d’une fonction, l’utilisation d’instructions goto renvoyant vers un label qui est placé avant cette instruction goto.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1667','122','RECOMMANDATION — Utilisation limitée du saut avant (forward goto)','L’utilisation d’un forward goto est tolérée uniquement dans les cas où elle permet :\n de limiter significativement le nombre de points de sortie de la fonction ;\n de rendre le code beaucoup plus lisible.\nLe ou les labels référencés par les instructions goto doivent tous être situés en fin de fonction.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1668','123','RÈGLE — Toute fonction (non static) définie doit possèder une déclaration/ prototype de fonction','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1669','124','RÈGLE — Le prototype de déclaration d''une fonction doit concorder avec sa définition','Les types des paramètres utilisés pour la définition et la déclaration d’une fonction doivent être les mêmes.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1670','125','RÈGLE — Toute fonction doit être associée à un type de retour et à une liste de paramètres explicite','Chaque fonction est définie explicitement avec un type de retour. Les fonctions sans valeur de retour doivent être déclarées avec un paramètre du type void. De la même façon, une fonction sans paramètre devra être définie et déclarée avec void en argument.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1671','126','RECOMMANDATION — Documentation des fonctions','Tous les fonctions doivent être documentées. Cela comprend :\nn une description de la fonction et du traitement effectué ;\n la documentation de chaque paramètre, le sens du paramètre (en entrée, en sortie, en entrée et en sortie) et les éventuelles conditions existant sur celui-ci ;\n les valeurs de retour possibles doivent être décrites.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1672','127','RECOMMANDATION — Préciser les conditions d''appel pour chaque fonction','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1673','128','RÈGLE — La validité de tous les paramètres d''une fonction doit systématiquement être remise en cause','Cela inclut :\n la validité des adresses pour les paramètres de type pointeur doit être vérifiée (non , alignement des adresses conforme...) ;\n l’appartenance des paramètres à leur domaine doit être vérifiée.\nCela s’applique aux fonctions définies par le développeur (cf. section 12.2) mais aussi aux fonctions de la bibliothèque standard.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1674','129','RÈGLE — Les paramètres de fonction de type pointeur pour lesquels la zone mémoire pointée n''est pas ','Marquer const tous les paramètres de type pointeur d’une fonction qui pointent vers une zone mémoire qui ne doit pas être modifiée dans le corps de celle-ci. Le qualificateur const doit s’appliquer à l’objet pointé.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1675','130','RÈGLE — Les fonctions inline doivent être déclarées comme static','Pour éviter un comportement non défini une fonction inline est systématiquement static.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1676','131','RÈGLE — Interdiction de redéfinir les fonctions ou macros de la bibliothèque standard ou d''une autre','Les identifiants, macros ou noms de fonctions faisant partie de la bibliothèque standard ou d’une autre bibliothèque utilisée ne doivent pas être redéfinis.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1677','132','RÈGLE — La valeur de retour d''une fonction doit toujours être testée','Lorsqu’une fonction retourne une valeur, la valeur retournée doit être systématiquement testée.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1678','133','RÈGLE — Retour implicite interdit pour les fonctions de type non void','Tous les chemins d’une fonction non void doivent retourner une valeur explicitement.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1679','134','RÈGLE — Les structures doivent être passées par référence à une fonction','Il ne faut pas passer de paramètres de type structure par copie lors de l’appel d’une fonction.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1680','135','RECOMMANDATION — Passage d''un tableau en paramètre d''une fonction','Il existe plusieurs façons de passer un tableau en paramètre d’une fonction. Lors du passage par pointeur, il faut préciser dans la documentation de la fonction que le paramètre correspond à un tableau et également utiliser la notation dédiée aux tableaux.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1681','136','RECOMMANDATION — Utilisation obligatoire dans une fonction de tous ses paramètres','Tous les paramètres présents dans le prototype de la fonction doivent être utilisés dans son implémentation.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1682','137','BONNE PRATIQUE — Utiliser les options de compilation -Wformat=2 et -Wformat-security dès qu''une fonc','Plus de détails sur ces options sont données en annexe B.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1683','138','RÈGLE — Ne pas appeler de fonctions variadiques avec NULL en argument','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1684','139','RÈGLE — Usage de la virgule interdit pour le séquencement d''instructions','La virgule n’est pas autorisée dans le cadre du séquencement des instructions decode.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1685','140','RECOMMANDATION — Les opérateurs pré-fixes ++ et -- ne doivent pas être utilisés','Les opérateurs de pré-incrémentation et pré-decrémentation ne seront pas utilisés.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1686','141','RECOMMANDATION — Pas d''utilisation combinée des opérateurs postfixes avec d''autres opérateurs','Les opérateurs de post-incrémentation et de post-décrémentation ne doivent pas être mixés avec d’autres opérateurs.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1687','142','RECOMMANDATION — Éviter l''utilisation d''opérateurs d''affectation combinés','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1688','143','RÈGLE — Non utilisation imbriquée de l''opérateur ternaire ?:','L’imbrication d’opérateurs ternaires ?: est interdite.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1689','144','RÈGLE — Bonne construction des expressions avec l''opérateur ternaire ?:','Les expressions résultantes de l’opérateur ternaire ?: doivent être exactement de même type pour éviter tout transtypage.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1690','145','RÈGLE — Allouer dynamiquement un espace mémoire dont la taille est suffisante pour l''objet alloué','Pour un pointeur ptr, on préférera utiliser ptr=malloc(sizeof(*ptr)); quand cela est possible.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1691','146','RÈGLE — Libérer la mémoire allouée dynamiquement au plus tôt','Tout espace mémoire alloué dynamiquement doit être libéré quand celui-ci n’est plus utile.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1692','147','RÈGLE — Les zones mémoires sensibles doivent être mises à zéro avant d''être libérées.','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1693','148','RÈGLE — Ne pas libérer de mémoire non allouée dynamiquement','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1694','149','RÈGLE — Ne pas modifier l''allocation dynamique via realloc','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1695','150','RÈGLE — Bonne utilisation de l''opérateur sizeof','Une expression contenue dans un sizeof ne doit pas :\n contenir l’opérateur « = » car l’expression ne sera pas évaluée ; \n contenir de déréférencement de pointeur ;\n être appliqué sur un pointeur représentant un tableau.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1696','151','RÈGLE — Vérification obligatoire du succès d''une allocation mémoire','Le succès d’une allocation mémoire doit toujours être vérifié.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1697','152','RÈGLE — L''isolement des données sensibles doit être effectué','Contrôler le bon usage d’une zone mémoire stockant des données sensibles i.e. minimiser l’exposition en mémoire, minimiser la copie et effacer la/les zones ayant contenu les données sensibles au plus tôt.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1698','153','RÈGLE — Initialiser et consulter la valeur de errno avant et après toute exécution d''une fonction de','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1699','154','RÈGLE — La gestion des erreurs retournées par une fonction de la bibliothèque standard doit être sys','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1700','155','RÈGLE — Documentation des codes d''erreur','Tous les codes d’erreur retournés par une fonction doivent être documentés. Dans le cas où plusieurs codes d’erreur peuvent être retournés en même temps par la fonction, la documentation doit définir la priorité de gestion de ces codes.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1701','156','RECOMMANDATION — Structuration des codes de retour','Les codes de retour doivent être structurés de façon à pouvoir obtenir rapidement une information concernant le déroulement de la fonction appelée : \n erreur ; \n type d’erreur ; \n alarme ; \n type d’alarme ; \n ok ;',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1702','157','RÈGLE — Code de retour d''un programme C en fonction du résultat de son exécution','Le code de retour d’un programme C doit avoir une signification afin d’indiquer le bon déroulement du programme ou la survenue d’une erreur : \n la valeur du code de retour doit être comprise entre 0 et 127 ; \n la valeur 0 indique que le programme s’est exécuté sans erreur ;\n la valeur 2 est généralement utilisée sous Unix pour indiquer une erreur dans les arguments passés en paramètres au programme. \nLa signification des codes de retour du programme doit être indiquée dans sa documentation.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1703','158','RECOMMANDATION — Privilégier les retours d''erreurs via des codes de retour dans la fonction principa','Un programme C doit disposer d’une fonction main() minimale. Les retours d’erreurs se font par un retour de code dédié (et donc documenté) de cette fonction.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1704','159','RÈGLE — Ne pas utiliser les fonctions abort() ou _Exit()','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1705','160','RECOMMANDATION — Limiter les appels à exit()','Les appels à la fonction exit() doivent être commentés et non systématiques. Le développeur doit le plus souvent possible les remplacer par un retour de code d’erreur  dans la fonction principale.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1706','161','RÈGLE — Ne pas utiliser les fonctions setjmp() et longjump()','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1707','162','RÈGLE — Ne pas utiliser les bibliothèques standards setjmp.h et stdarg.h','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1708','163','RECOMMANDATION — Limiter l''utilisation des bibliothèques standards manipulant des nombres flottants','Les bibliothèques standards float.h, fenv.h, complex.h et math.h ne doivent être utilisées que si cela est vraiment nécessaire.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1709','164','RÈGLE — Ne pas utiliser les fonctions atoi() atol() atof() et atoll() de la bibliothèque stdlib.h','Les fonctions équivalentes strto*() sont à utiliser en remplacement.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1710','165','RÈGLE — Ne pas utiliser la fonction rand() de la bibliothèque standard','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1711','166','RÈGLE — Utiliser les versions « plus sécurisées » pour les fonctions de la bibliothèque standard','Quand des fonctions de la bibliothèque standard existent en différentes versions, la version « plus sécurisée » doit être utilisée.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1712','167','RÈGLE — Ne pas utiliser de fonctions de la bibliothèque obsolescentes ou devenues obsolètes dans des','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1713','168','RÈGLE — Ne pas utiliser de fonctions de la bibliothèque manipulant des buffers sans prendre la taill','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1714','169','BONNE PRATIQUE — Tout code doit être soumis à relecture','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1715','170','RECOMMANDATION — Indentation des expressions longues','Lorsqu’une instruction ou une expression s’étale sur plusieurs lignes, il est indispensable de l’indenter afin de faciliter la compréhension du code.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1716','171','RÈGLE — Identifier et supprimer tout code mort','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1717','172','RÈGLE — Le code doit être exempt de code non atteignable en dehors de code défensif et de code d''int','Il ne doit jamais y avoir de code inatteignable, sauf s’il s’agit de code défensif ou s’il s’agit de code d’une interface et dans ces deux cas, il faut le préciser en commentaire.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1718','173','RECOMMANDATION — Evaluation outillée du code source pour limiter les risques d''erreurs d''exécution','Le code source du logiciel doit être analysé via au moins un outil d’analyse de code. Les résultats produits par l’outil d’analyse doivent être étudiés par le développeur et les corrections doivent être effectuées par rapport aux problèmes découverts.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1719','174','RECOMMANDATION — Limitation de la complexité cyclomatique','La complexité cyclomatique d’une fonction doit être limitée au maximum.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1720','175','RECOMMANDATION — Limitation de la longueur et la complexité d''une fonction','Une fonction doit être associée idéalement à un seul et unique traitement et doit donc correspondre à un nombre de lignes de code raisonnable.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1721','176','RÈGLE — Ne pas utiliser de mots clés du C++','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1722','177','RÈGLE — Séquences de caractères interdites dans les commentaires','Les séquences /* et // sont interdites dans tous les commentaires. Et un commentaire sur une ligne introduit par // ne doit pas contenir de caractère de continuation de ligne \\.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1723','178','RÈGLE — Mise en oeuvre manuelle de mécanismes « canari » si les options de durcissement ne sont pas ','Vide',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1724','179','RÈGLE — Pas d''assertions de mise au point sur un code mis en production','Les assertions de mise au point ne doivent pas être présentes en production.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1725','180','RECOMMANDATION — La gestion des assertions d''intégrité doit inclure un effacement des données d''urge','Les assertions d’intégrité doivent apparaître en production. En cas de déclenchement d’une assertion d’intégrité, le code de traitement doit aboutir à un effacement d’urgence des données sensibles.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1726','181','RÈGLE — Tout fichier non vide doit se terminer par un retour à la ligne et les directives de preproc','Un fichier non vide ne doit pas se terminer au milieu d’un commentaire ou d’une directive de preprocessing.',NULL,NULL,NULL,NULL,'16','17','1.d');
INSERT INTO `O_regle` VALUES ('1727','1','Former les équipes opérationnelles à la sécurité des systèmes d’information','/ standard\nLes équipes opérationnelles (administrateurs réseau, sécurité et système, chefs de projet, développeurs, RSSI) ont des accès privilégiés au système d’information. Elles peuvent, par inadvertance ou par méconnaissance des conséquences de certaines pratiques, réaliser des opérations génératrices de vulnérabilités. \nCitons par exemple l’affectation de comptes disposant de trop nombreux privilèges par rapport à la tâche à réaliser, l’utilisation de comptes personnels pour exécuter des services ou tâches périodiques, ou encore le choix de mots de passe peu robustes donnant accès à des comptes privilégiés.\nLes équipes opérationnelles, pour être à l’état de l’art de la sécurité des systèmes d’information, doivent donc suivre - à leur prise de poste puis à intervalles réguliers - des formations sur : \n> la législation en vigueur ;\n> les principaux risques et menaces ;\n> le maintien en condition de sécurité ;\n> l’authentification et le contrôle d’accès ;\n> le paramétrage fin et le du',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1728','2','Sensibiliser les utilisateurs aux bonnes pratiques élémentaires de sécurité informatique','/ standard\nChaque utilisateur est un maillon à part entière de la chaîne des systèmes d’information. À ce titre et dès son arrivée dans l’entité, il doit être informé des enjeux de sécurité, des règles à respecter et des bons comportements à adopter en matière de sécurité des systèmes d’information à travers des actions de sensibilisation et de formation.\nCes dernières doivent être régulières, adaptées aux utilisateurs ciblés, peuvent prendre différentes formes (mails, affichage, réunions, espace intranet dédié,etc.) et aborder au minimum les sujets suivants :\n>> les objectifs et enjeux que rencontre l’entité en matière de sécurité dessystèmes d’information ;\n>> les informations considérées comme sensibles ;>> les réglementations et obligations légales ;\n>> les règles et consignes de sécurité régissant l’activité quotidienne : respect de la politique de sécurité, non-connexion d’équipements personnels au réseau de l’entité, non-divulgation de mots de passe à un tiers, non-réutilisation',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1729','3','Maîtriser les risques de l’infogérance','/ standard\nLorsqu’une entité souhaite externaliser son système d’information ou ses données, elle doit en amont évaluer les risques spécifiques à l’infogérance (maîtrise du système d’information, actions à distance, hébergement mutualisé, etc.) afin de prendre en compte, dès la rédaction des exigences applicables au futur prestataire, les besoins et mesures de sécurité adaptés.\nLes risques SSI inhérents à ce type de démarche peuvent être liés au contexte de l’opération d’externalisation mais aussi à des spécifications contractuelles déficientes ou incomplètes.\nEn faveur du bon déroulement des opérations, il s’agit donc :\n>> d’étudier attentivement les conditions des offres, la possibilité de les adapter à des besoins spécifiques et les limites de responsabilité du prestataire ;\n>> d’imposer une liste d’exigences précises au prestataire : réversibilité du contrat, réalisation d’audits, sauvegarde et restitution des données dans un format ouvert normalisé, maintien à niveau de la sécurit',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1730','4','Identifier les informations et serveurs les plus sensibles et maintenir un schéma du réseau','/Standard\nChaque entité possède des données sensibles. Ces dernières peuvent porter sur son activité propre (propriété intellectuelle, savoir-faire, etc.) ou sur ses clients, administrés ou usagers (données personnelles, contrats, etc.). Afin de pouvoir les protéger efficacement, il est indispensable de les identifier.\nÀ partir de cette liste de données sensibles, il sera possible de déterminer sur quels composants du système d’information elles se localisent (bases de données, partages de fichiers, postes de travail, etc.). Ces composants correspondent aux serveurs et postes critiques pour l’entité. À ce titre, ils devront faire l’objet de mesures de sécurité spécifiques pouvant porter sur la sauvegarde, la journalisation, les accès, etc.\nIl s’agit donc de créer et de maintenir à jour un schéma simplifié du réseau (ou cartographie) représentant les différentes zones IP et le plan d’adressage associé, les équipements de routage et de sécurité (pare-feu, relais applicatifs,etc.) et les ',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1731','5','Disposer d’un inventaire exhaustif des comptes privilégiés et le maintenir à jour','/Standard\nLes comptes bénéficiant de droits spécifiques sont des cibles privilégiées par les attaquants qui souhaitent obtenir un accès le plus large possible au système d’information. Ils doivent donc faire l’objet d’une attention toute particulière.\n Il s’agit pour cela d’effectuer un inventaire de ces comptes, de le mettre à jour régulièrement et d’y renseigner les informations suivantes :\n>> les utilisateurs ayant un compte administrateur ou des droits supérieurs à ceux d’un utilisateur standard sur le système d’information ;\n>> les utilisateurs disposant de suffisamment de droits pour accéder aux répertoires de travail des responsables ou de l’ensemble des utilisateurs ;\n>> les utilisateurs utilisant un poste non administré par le service informatique et qui ne fait pas l’objet de mesures de sécurité édictées par la politique de sécurité générale de l’entité.\nIl est fortement recommandé de procéder à une revue périodique de ces comptes afin de s’assurer que les accès aux éléments ',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1732','6','Organiser les procédures d’arrivée, de départ et de changement de fonction des utilisateurs','/ Standard\nLes effectifs d’une entité, qu’elle soit publique ou privée, évoluent sans cesse : arrivées, départs, mobilité interne. Il est par conséquent nécessaire que les droits et les accès au système d’information soient mis à jour en fonction de ces évolutions. Il est notamment essentiel que l’ensemble des droits affectés à une personne soient révoqués lors de son départ ou en cas de changement de fonction. Les procédures d’arrivée et de départ doivent donc être définies, en lien avec la fonction ressources humaines. Elles doivent au minimum prendre en compte :\n>> la création et la suppression des comptes informatiques et boîtes aux lettres associées ;\n>> les droits et accès à attribuer et retirer à une personne dont la fonction change ;\n>> la gestion des accès physiques aux locaux (attribution, restitution des badges et des clés, etc.) ;\n>> l’affectation des équipements mobiles (ordinateur portable, clé USB, disque dur, ordiphone, etc.) ;\n>> la gestion des documents et information',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1733','7','Autoriser la connexion au réseau de l’entité aux seuls équipements maîtrisés','/Standard\nPour garantir la sécurité de son système d’information, l’entité doit maîtriser les équipements qui s’y connectent, chacun constituant un point d’entrée potentiellement vulnérable. Les équipements personnels (ordinateurs portables, tablettes, ordiphones, etc.) sont, par définition, difficilement maîtrisables dans la mesure où ce sont les utilisateurs qui décident de leur niveau de sécurité. De la même manière, la sécurité des équipements dont sont dotés les visiteurs échappe à tout contrôle de l’entité.\n Seule la connexion de terminaux maîtrisés par l’entité doit être autorisée sur ses différents réseaux d’accès, qu’ils soient filaire ou sans fil. Cette recommandation, avant tout d’ordre organisationnel, est souvent perçue comme inacceptable ou rétrograde. Cependant, y déroger fragilise le réseau de l’entité et sert ainsi les intérêts d’un potentiel attaquant.\nLa sensibilisation des utilisateurs doit donc s’accompagner de solutions pragmatiques répondant à leurs besoins. Cito',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1734','8','Identifier nommément chaque personne accédant au système et distinguer les rôles utilisateur /admini','/Standard\nAfin de faciliter l’attribution d’une action sur le système d’information en cas d’incident ou d’identifier d’éventuels comptes compromis, les comptes d’accès doivent être nominatifs.\nL’utilisation de comptes génériques (ex : admin, user) doit être marginale et ceux-ci doivent pouvoir être rattachés à un nombre limité de personnes physiques.\nBien entendu, cette règle n’interdit pas le maintien de comptes de service, rattachés à un processus informatique (ex : apache, mysqld).\nDans tous les cas, les comptes génériques et de service doivent être gérés selon une politique au moins aussi stricte que celle des comptes nominatifs. Par ailleurs, un compte d’administration nominatif, distinct du compte utilisateur, doit être attribué à chaque administrateur. Les identifiants et secrets d’authentification doivent être différents (ex : pmartin comme identifiant utilisateur, adm-pmartin comme identifiant administrateur). Ce compte d’administration, disposant de plus de privilèges, doit ',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1735','9','Attribuer les bons droits sur les ressources sensibles du système d’information','/Standard\nCertaines des ressources du système peuvent constituer une source d’information précieuse aux yeux d’un attaquant (répertoires contenant des données sensibles, bases de données, boîtes aux lettres électroniques, etc.). Il est donc primordial d’établir une liste précise de ces ressources et pour chacune d’entre elles :\n>> de définir quelle population peut y avoir accès ;\n>> de contrôler strictement son accès, en s’assurant que les utilisateurs sont authentifiés et font partie de la population ciblée ;\n>> d’éviter sa dispersion et sa duplication à des endroits non maîtrisés ou soumis à un contrôle d’accès moins strict. \nPar exemple, les répertoires des administrateurs regroupant de nombreuses informations sensibles doivent faire l’objet d’un contrôle d’accès précis. Il en va de même pour les informations sensibles présentes sur des partages réseau : exports de fichiers de configuration, documentation technique du système d’information, bases de données métier, etc. Une revue ré',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1736','10','Définir et vérifier des règles de choix et de dimensionnement des mots de passe','/Standard\nL’ANSSI énonce un ensemble de règles et de bonnes pratiques en matière de choix et de dimensionnement des mots de passe. Parmi les plus critiques de ces règles figure la sensibilisation des utilisateurs aux risques liés au choix d’un mot de passe qui serait trop facile à deviner, ou encore la réutilisation de mots de passe d’une application à l’autre et plus particulièrement entre messageries personnelles et professionnelles.\nPour encadrer et vérifier l’application de ces règles de choix et de dimensionnement, l’entité pourra recourir à différentes mesures parmi lesquelles :\n>> le blocage des comptes à l’issue de plusieurs échecs de connexion ;\n>> la désactivation des options de connexion anonyme ;\n>> l’utilisation d’un outil d’audit de la robustesse des mots de passe.\nEn amont de telles procédures, un effort de communication visant à expliquer le sens de ces règles et éveiller les consciences sur leur importance est fondamental.',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1737','11','Protéger les mots de passe stockés sur les systèmes','/Standard\nLa complexité, la diversité ou encore l’utilisation peu fréquente de certains mots de passe, peuvent encourager leur stockage sur un support physique (mémo, post-it) ou numérique (fichiers de mots de passe, envoi par mail à soimême, recours aux boutons « Se souvenir du mot de passe ») afin de pallier tout oubli ou perte.\nOr, les mots de passe sont une cible privilégiée par les attaquants désireux d’accéder au système, que cela fasse suite à un vol ou à un éventuel partage du support de stockage. C’est pourquoi ils doivent impérativement être protégés au moyen de solutions sécurisées au premier rang desquelles figurent l’utilisation d’un coffre-fort numérique et le recours à des mécanismes de chiffrement.\nBien entendu, le choix d’un mot de passe pour ce coffre-fort numérique doit respecter les règles énoncées précédemment et être mémorisé par l’utilisateur, qui n’a plus que celui-ci à retenir.',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1738','12','Changer les éléments d’authentification par défaut sur les équipements et services','/Standard\nIl est impératif de partir du principe que les configurations par défaut des systèmes d’information sont systématiquement connues des attaquants, quand bien même celles-ci ne le sont pas du grand public. Ces configurations se révèlent (trop) souvent triviales (mot de passe identique à l’identifiant, mal dimensionné ou commun à l’ensemble des équipements et services par exemple) et sont, la plupart du temps, faciles à obtenir pour des attaquants capables de se faire passer pour un utilisateur légitime.\nLes éléments d’authentification par défaut des composants du système doivent donc être modifiés dès leur installation et, s’agissant de mots de passe, être conformes aux recommandations précédentes en matière de choix, de dimensionnement et de stockage.\nSi le changement d’un identifiant par défaut se révèle impossible pour cause, par exemple, de mot de passe ou certificat « en dur » dans un équipement, ce problème critique doit être signalé au distributeur du produit afin que ce',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1739','13','Privilégier lorsque c’est possible une authentification forte','/Standard\nIl est vivement recommandé de mettre en oeuvre une authentification forte nécessitant l’utilisation de deux facteurs d’authentification différents parmi les suivants :\n>> quelque chose que je sais (mot de passe, tracé de déverrouillage, signature) ;\n>> quelque chose que je possède (carte à puce, jeton USB, carte magnétique, RFID, un téléphone pour recevoir un code SMS) ;\n >> quelque chose que je suis (une empreinte biométrique).\n\n/Renforcé\nLes cartes à puces doivent être privilégiées ou, à défaut, les mécanismes de mots de passe à usage unique (ou One Time Password) avec jeton physique. Les opérations cryptographiques mises en place dans ces deux facteurs offrent généralement de bonnes garanties de sécurité.\nLes cartes à puce peuvent être plus complexes à mettre en place car nécessitant une infrastructure de gestion des clés adaptée. Elles présentent cependant l’avantage d’être réutilisables à plusieurs fins : chiffrement, authentification de messagerie, authentification sur ',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1740','14','Mettre en place un niveau de sécurité minimal sur l’ensemble du parc informatique','/Standard\nL’utilisateur plus ou moins au fait des bonnes pratiques de sécurité informatique est, dans de très nombreux cas, la première porte d’entrée des attaquants vers le système. Il est donc fondamental de mettre en place un niveau de sécurité minimal sur l’ensemble du parc informatique de l’entité (postes utilisateurs, serveurs, imprimantes, téléphones, périphériques USB, etc.) en implémentant les mesures suivantes :\n>> limiter les applications installées et modules optionnels des navigateurs web aux seuls nécessaires ;\n>> doter les postes utilisateurs d’un pare-feu local et d’un anti-virus (ceux-ci sont parfois inclus dans le système d’exploitation) ;\n>> chiffrer les partitions où sont stockées les données des utilisateurs ;\n>> désactiver les exécutions automatiques (autorun).\nEn cas de dérogation nécessaire aux règles de sécurité globales applicables aux postes, ceux-ci doivent être isolés du système (s’il est impossible de mettre à jour certaines applications pour des raisons d',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1741','15','Se protéger des menaces relatives à l’utilisation de supports amovibles','/Standard\nLes supports amovibles peuvent être utilisés afin de propager des virus, voler des informations sensibles et stratégiques ou encore compromettre le réseau de l’entité. De tels agissements peuvent avoir des conséquences désastreuses pour l’activité de la structure ciblée.\nS’il n’est pas question d’interdire totalement l’usage de supports amovibles au sein de l’entité, il est néanmoins nécessaire de traiter ces risques en identifiant des mesures adéquates et en sensibilisant les utilisateurs aux risques que ces supports peuvent véhiculer.\nIl convient notamment de proscrire le branchement de clés USB inconnues (ramassées dans un lieu public par exemple) et de limiter au maximum celui de clés non maîtrisées (dont on connait la provenance mais pas l’intégrité) sur le système d’information à moins, dans ce dernier cas, de faire inspecter leur contenu par l’antivirus du poste de travail.\n\n/Renforcé\nSur les postes utilisateur, il est recommandé d’utiliser des solutions permettant d’i',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1742','16','Utiliser un outil de gestion centralisée afin d’homogénéiser les politiques de sécurité','/Standard\nLa sécurité du système d’information repose sur la sécurité du maillon le plus faible. Il est donc nécessaire d’homogénéiser la gestion des politiques de sécurité s’appliquant à l’ensemble du parc informatique de l’entité.\nL’application de ces politiques (gestion des mots de passe, restrictions de connexions sur certains postes sensibles, configuration des navigateurs Web, etc.) doit être simple et rapide pour les administrateurs, en vue notamment de faciliter la mise en oeuvre de contre-mesures en cas de crise informatique.\nPour cela, l’entité pourra se doter d’un outil de gestion centralisée (par exemple Active Directory en environnement Microsoft) auquel il s’agit d’inclure le plus grand nombre d’équipements informatiques possible. Les postes de travail et les serveurs sont concernés par cette mesure qui nécessite éventuellement en amont un travail d’harmonisation des choix de matériels et de systèmes d’exploitation.\nAinsi, des politiques de durcissement du système d’explo',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1743','17','Activer et configurer le parefeu local des postes de travail','/Standard\nAprès avoir réussi à prendre le contrôle d’un poste de travail (à cause, par exemple, d’une vulnérabilité présente dans le navigateur Internet), un attaquant cherchera souvent à étendre son intrusion aux autres postes de travail pour, in fine, accéder aux documents des utilisateurs.\nAfin de rendre plus difficile ce déplacement latéral de l’attaquant, il est nécessaire d’activer le pare-feu local des postes de travail au moyen de logiciels intégrés (pare-feu local Windows) ou spécialisés.\nLes flux de poste à poste sont en effet très rares dans un réseau bureautique classique : les fichiers sont stockés dans des serveurs de fichiers, les applications accessibles sur des serveurs métier, etc.\n\n/Renforcé\nLe filtrage le plus simple consiste à bloquer l’accès aux ports d’administration par défaut des postes de travail (ports TCP 135, 445 et 3389 sous Windows, port TCP 22 sous Unix), excepté depuis les ressources explicitement identifiées (postes d’administration et d’assistance uti',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1744','18','Chiffrer les données sensibles transmises par voie Internet','/Standard\nInternet est un réseau sur lequel il est quasi impossible d’obtenir des garanties sur le trajet que vont emprunter les données que l’on y envoie. Il est donc tout à fait possible qu’un attaquant se trouve sur le trajet de données transitant entre deux correspondants.\nToutes les données envoyées par courriel ou transmises au moyen d’outils d’hébergement en ligne (Cloud) sont par conséquent vulnérables. Il s’agit donc de procéder à leur chiffrement systématique avant de les adresser à un correspondant ou de les héberger.\nLa transmission du secret (mot de passe, clé, etc.) permettant alors de déchiffrer les données, si elle est nécessaire, doit être effectuée via un canal de confiance ou, à défaut, un canal distinct du canal de transmission des données. Ainsi, si les données chiffrées sont transmises par courriel, une remise en main propre du mot de passe ou, à défaut, par téléphone doit être privilégiée.',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1745','19','Segmenter le réseau et mettre en place un cloisonnement entre ces zones','/Standard\nLorsque le réseau est " à plat ", sans aucun mécanisme de cloisonnement, chaque machine du réseau peut accéder à n’importe quelle autre machine.La compromission de l’une d’elles met alors en péril l’ensemble des machines connectées. Un attaquant peut ainsi compromettre un poste utilisateur et ensuite " rebondir " jusqu’à des serveurs critiques. Il est donc important, dès la conception de l’architecture réseau, de raisonner par segmentation en zones composées de systèmes ayant des besoins de sécurité homogènes. On pourra par exemple regrouper distinctement des serveurs d’infrastructure, des serveurs métiers, des postes de travail utilisateurs, des postes de travail administrateurs, des postes de téléphonie sur IP, etc.\nUne zone se caractérise alors par des VLAN et des sous-réseaux IP dédiés voire par des infrastructures dédiées selon sa criticité. Ainsi, des mesures de cloisonnement telles qu’un filtrage IP à l’aide d’un pare-feu peuvent être mises en place entre les différent',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1746','20','S’assurer de la sécurité des réseaux d’accès Wi-Fi et de la séparation des usages','/Standard/nL’usage du Wi-Fi en milieu professionnel est aujourd’hui démocratisé mais présente toujours des risques de sécurité bien spécifiques : faibles garanties en matière de disponibilité, pas de maîtrise de la zone de couverture pouvant mener à une attaque hors du périmètre géographique de l’entité, configuration par défaut des points d’accès peu sécurisée, etc.\nLa segmentation de l’architecture réseau doit permettre de limiter les conséquences d’une intrusion par voie radio à un périmètre déterminé du système d’information. Les flux en provenance des postes connectés au réseau d’accès Wi-Fi doivent donc être filtrés et restreints aux seuls flux nécessaires.\nDe plus, il est important d’avoir recours prioritairement à un chiffrement robuste (mode WPA2, algorithme AES CCMP) et à une authentification centralisée, si possible par certificats clients des machines.\nLa protection du réseau Wi-Fi par un mot de passe unique et partagé est déconseillée. À défaut, il doit être complexe et so',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1747','21','Utiliser des protocoles réseaux sécurisés dès qu’ils existent','/Standard\nSi aujourd’hui la sécurité n’est plus optionnelle, cela n’a pas toujours été le cas. C’est pourquoi de nombreux protocoles réseaux ont dû évoluer pour intégrer cette composante et répondre aux besoins de confidentialité et d’intégrité qu’impose l’échange de données. Les protocoles réseaux sécurisés doivent être utilisés dès que possible, que ce soit sur des réseaux publics (Internet par exemple) ou sur le réseau interne de l’entité.\nBien qu’il soit difficile d’en dresser une liste exhaustive, les protocoles les plus courants reposent sur l’utilisation de TLS et sont souvent identifiables par l’ajout de la lettre « s » (pour secure en anglais) à l’acronyme du protocole.Citons par exemple https pour la navigation Web ou IMAPS, SMTPS ou POP3S pour la messagerie.\nD’autres protocoles ont été conçus de manière sécurisée dès la conception pour se substituer à d’anciens protocoles non sécurisés. Citons par exemple SSH (Secure SHell) venu remplacer les protocoles de communication hist',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1748','22','Mettre en place une passerelle d’accès sécurisé à Internet','/Standard\nL’accès à Internet, devenu indispensable, présente des risques importants : sites Web hébergeant du code malveillant, téléchargement de fichiers « toxiques » et, par conséquent, possible prise de contrôle du terminal, fuite de données sensibles, etc. Pour sécuriser cet usage, il est donc indispensable que les terminaux utilisateurs n’aient pas d’accès réseau direct à Internet.\nC’est pourquoi il est recommandé de mettre en oeuvre une passerelle sécurisée d’accès à Internet comprenant au minimum un pare-feu au plus près de l’accès Internet pour filtrer les connexions et un serveur mandataire (proxy) embarquant différents mécanismes de sécurité. Celui-ci assure notamment l’authentification des utilisateurs et la journalisation des requêtes.\n\n/Renforcé\nDes mécanismes complémentaires sur le serveur mandataire pourront être activés selon les besoins de l’entité : analyse antivirus du contenu, filtrage par catégories d’URLs, etc. Le maintien en condition de sécurité des équipements ',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1749','23','Cloisonner les services visibles depuis Internet du reste du système d’information','/Standard\nUne entité peut choisir d’héberger en interne des services visibles sur Internet (site web, serveur de messagerie, etc.). Au regard de l’évolution et du perfectionnement des cyberattaques sur Internet, il est essentiel de garantir un haut niveau de protection de ce service avec des administrateurs compétents, formés de manière continue (à l’état de l’art des technologies en la matière) et disponibles. Dans le cas contraire, le recours à un hébergement externalisé auprès de professionnels est à privilégier.\nDe plus, les infrastructures d’hébergement Internet doivent être physiquement cloisonnées de toutes les infrastructures du système d’information qui n’ont pas vocation à être visibles depuis Internet.\nEnfin, il convient de mettre en place une infrastructure d’interconnexion de ces services avec Internet permettant de filtrer les flux liés à ces services de manière distincte des autres flux de l’entité. Il s’agit également d’imposer le passage des flux entrants par un serveu',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1750','24','Protéger sa messagerie professionnelle','/Standard\nLa messagerie est le principal vecteur d’infection du poste de travail, qu’il s’agisse de l’ouverture de pièces jointes contenant un code malveillant ou du clic malencontreux sur un lien redirigeant vers un site lui-même malveillant.\nLes utilisateurs doivent être particulièrement sensibilisés à ce sujet : l’expéditeur est-il connu ? Une information de sa part est-elle attendue ? Le lien proposé est-il cohérent avec le sujet évoqué ? En cas de doute, une vérification de l’authenticité du message par un autre canal (téléphone, SMS, etc.) est nécessaire.\nPour se prémunir d’escroqueries (ex : demande de virement frauduleux émanant vraisemblablement d’un dirigeant), des mesures organisationnelles doivent être appliquées strictement.\nPar ailleurs, la redirection de messages professionnels vers une messagerie personnelle est à proscrire car cela constitue une fuite irrémédiable d’informations de l’entité. Si nécessaire des moyens maîtrisés et sécurisés pour l’accès distant à la mess',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1751','25','Sécuriser les interconnexions réseau dédiées avec les partenaires','/Standard\nPour des besoins opérationnels, une entité peut être amenée à établir une interconnexion réseau dédiée avec un fournisseur ou un client (ex : infogérance, échange de données informatisées, flux monétiques, etc.).\nCette interconnexion peut se faire au travers d’un lien sur le réseau privé de l’entité ou directement sur Internet. Dans le second cas, il convient d’établir un tunnel site à site, de préférence IPsec, en respectant les préconisations de l’ANSSI.\nLe partenaire étant considéré par défaut comme non sûr, il est indispensable d’effectuer un filtrage IP à l’aide d’un pare-feu au plus près de l’entrée des flux sur le réseau de l’entité. La matrice des flux (entrants et sortants) devra être réduite au juste besoin opérationnel, maintenue dans le temps et la configuration des équipements devra y être conforme.\n\n/Renforcé\nPour des entités ayant des besoins de sécurité plus exigeants, il conviendra de s’assurer que l’équipement de filtrage IP pour les connexions partenaires e',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1752','26','Contrôler et protéger l’accès aux salles serveurs et aux locaux techniques','/Standard\nLes mécanismes de sécurité physique doivent faire partie intégrante de la sécurité des systèmes d’information et être à l’état de l’art afin de s’assurer qu’ils ne puissent pas être contournés aisément par un attaquant. Il convient donc d’identifier les mesures de sécurité physique adéquates et de sensibiliser continuellement les utilisateurs aux risques engendrés par le contournement des règles.\nLes accès aux salles serveurs et aux locaux techniques doivent être contrôlés à l’aide de serrures ou de mécanismes de contrôle d’accès par badge. Les accès non accompagnés des prestataires extérieurs aux salles serveurs et aux locaux techniques sont à proscrire, sauf s’il est possible de tracer strictement les accès et de limiter ces derniers en fonction des plages horaires. Une revue des droits d’accès doit être réalisée régulièrement afin d’identifier les accès non autorisés.\nLors du départ d’un collaborateur ou d’un changement de prestataire, il est nécessaire de procéder au retr',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1753','27','Interdire l’accès à Internet depuis les postes ou serveurs utilisés pour l’administration du système','/Standard\nUn poste de travail ou un serveur utilisé pour les actions d’administration ne doit en aucun cas avoir accès à Internet, en raison des risques que la navigation Web (à travers des sites contenant du code malveillant) et la messagerie (au travers de pièces jointes potentiellement vérolées) font peser sur son intégrité.\nPour les autres usages des administrateurs nécessitant Internet (consultation de documentation en ligne, de leur messagerie, etc.), il est recommandé de mettre à leur disposition un poste de travail distinct. À défaut, l’accès à une infrastructure virtualisée distante pour la bureautique depuis un poste d’administration est envisageable. La réciproque consistant à fournir un accès distant à une infrastructure d’administration depuis un poste bureautique est déconseillée car elle peut mener à une élévation de privilèges en cas de récupération des authentifiants d’administration.\n\n/Renforcé\nConcernant les mises à jour logicielles des équipements administrés, elles',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1754','28','Utiliser un réseau dédié et cloisonné pour l’administration du système d’information','/Standard\nUn réseau d’administration interconnecte, entre autres, les postes ou serveurs d’administration et les interfaces d’administration des équipements. Dans la logique de segmentation du réseau global de l’entité, il est indispensable de cloisonner spécifiquement le réseau d’administration, notamment vis-à-vis du réseau bureautique des utilisateurs, pour se prémunir de toute compromission par rebond depuis un poste utilisateur vers une ressource d’administration. \nSelon les besoins de sécurité de l’entité, il est recommandé :\n>> de privilégier en premier lieu un cloisonnement physique des réseaux dès que cela est possible, cette solution pouvant représenter des coûts et un temps de déploiement importants ;/Renforcé\n>> à défaut, de mettre en oeuvre un cloisonnement logique cryptographique reposant sur la mise en place de tunnels IPsec. Ceci permet d’assurer l’intégrité et la confidentialité des informations véhiculées sur le réseau d’administration vis-à-vis du réseau bureautique ',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1755','29','Limiter au strict besoin opérationnel les droits d’administration sur les postes de travail','/Standard\nDe nombreux utilisateurs, y compris au sommet des hiérarchies, sont tentés de demander à leur service informatique de pouvoir disposer, par analogie avec leur usage personnel, de privilèges plus importants sur leurs postes de travail : installation de logiciels, configuration du système, etc. Par défaut,il est recommandé qu’un utilisateur du SI, quelle que soit sa position hiérarchique et ses attributions, ne dispose pas de privilèges d’administration sur son poste de travail. Cette mesure, apparemment contraignante, vise à limiter les conséquences de l’exécution malencontreuse d’un code malveillant. La mise à disposition d’un magasin étoffé d’applications validées par l’entité du point de vue de la sécurité permettra de répondre à la majorité des besoins.\nPar conséquent, seuls les administrateurs chargés de l’administration des postes doivent disposer de ces droits lors de leurs interventions.\nSi une délégation de privilèges sur un poste de travail est réellement nécessaire ',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1756','30','Prendre des mesures de sécurisation physique des terminaux nomades','/Standard\nLes terminaux nomades (ordinateurs portables, tablettes, ordiphones) sont, par nature, exposés à la perte et au vol. Ils peuvent contenir localement des informations sensibles pour l’entité et constituer un point d’entrée vers de plus amples ressources du système d’information. Au-delà de l’application au minimum des politiques de sécurité de l’entité, des mesures spécifiques de sécurisation de ces équipements sont donc à prévoir.\nEn tout premier lieu, les utilisateurs doivent être sensibilisés pour augmenter leur niveau de vigilance lors de leurs déplacements et conserver leurs équipements à portée de vue. N’importe quelle entité, même de petite taille, peut être victime d’une attaque informatique. Dès lors, en mobilité, tout équipement devient une cible potentielle voire privilégiée.\nIl est recommandé que les terminaux nomades soient aussi banalisés que possible en évitant toute mention explicite de l’entité d’appartenance (par l’apposition d’un autocollant aux couleurs de ',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1757','31','Chiffrer les données sensibles, en particulier sur le matériel potentiellement perdable','/Standard\nLes déplacements fréquents en contexte professionnel et la miniaturisation du matériel informatique conduisent souvent à la perte ou au vol de celui-ci dans l’espace public. Cela peut porter atteinte aux données sensibles de l’entité qui y sont stockées.\nIl faut donc ne stocker que des données préalablement chiffrées sur l’ensemble des matériels nomades (ordinateurs portables, ordiphones, clés USB, disques durs externes, etc.) afin de préserver leur confidentialité. Seul un secret (mot de passe, carte à puce, code PIN, etc.) pourra permettre à celui qui le possède d’accéder à ces données.\nUne solution de chiffrement de partition, d’archives ou de fichier peut être envisagée selon les besoins. Là encore, il est essentiel de s’assurer de l’unicité et de la robustesse du secret de déchiffrement utilisé. Dans la mesure du possible, il est conseillé de commencer par un chiffrement complet du disque avant d’envisager le chiffrement d’archives ou de fichiers.\nEn effet, ces derniers ',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1758','32','Sécuriser la connexion réseau des postes utilisés en situation de nomadisme','/Standard\nEn situation de nomadisme, il n’est pas rare qu’un utilisateur ait besoin de se connecter au système d’information de l’entité. Il convient par conséquent de s’assurer du caractère sécurisé de cette connexion réseau à travers Internet.\nMême si la possibilité d’établir des tunnels VPN SSL/TLS est aujourd’hui courante, il est fortement recommandé d’établir un tunnel VPN IPsec entre le poste nomade et une passerelle VPN IPsec mise à disposition par l’entité.\nPour garantir un niveau de sécurité optimal, ce tunnel VPN IPsec doit être automatiquement établi et ne pas être débrayable par l’utilisateur, c’est-à-dire qu’aucun flux ne doit pouvoir être transmis en dehors de ce tunnel.\nPour les besoins spécifiques d’authentification aux portails captifs, l’entité peut choisir de déroger à la connexion automatique en autorisant une connexion à la demande ou maintenir cette recommandation en encourageant l’utilisateur à utiliser un partage de connexion sur un téléphone mobile de confiance',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1759','33','Adopter des politiques de sécurité dédiées aux terminaux mobiles','/Standard\nLes ordiphones et tablettes font partie de notre quotidien personnel et/ou professionnel. La première des recommandations consiste justement à ne pas mutualiser les usages personnel et professionnel sur un seul et même terminal, par exemple en ne synchronisant pas simultanément comptes professionnel et personnel de messagerie, de réseaux sociaux, d’agendas, etc.\nLes terminaux, fournis par l’entité et utilisés en contexte professionnel doivent faire l’objet d’une sécurisation à part entière, dès lors qu’ils se connectent au système d’information de l’entité ou qu’ils contiennent des informations professionnelles potentiellement sensibles (mails, fichiers partagés, contacts, etc.). Dès lors, l’utilisation d’une solution de gestion centralisée des équipements mobiles est à privilégier. Il sera notamment souhaitable de configurer de manière homogène les politiques de sécurité inhérentes : moyen de déverrouillage du terminal, limitation de l’usage du magasin d’applications à des a',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1760','34','Définir une politique de mise à jour des composants du système d’information','/Standard\nDe nouvelles failles sont régulièrement découvertes au coeur des systèmes et logiciels. Ces dernières sont autant de portes d’accès qu’un attaquant peut exploiter pour réussir son intrusion dans le système d’information. Il est donc primordial de s’informer de l’apparition de nouvelles vulnérabilités (CERTFR) et d’appliquer les correctifs de sécurité sur l’ensemble des composants du système dans le mois qui suit leur publication par l’éditeur. Une politique de mise à jour doit ainsi être définie et déclinée en procédures opérationnelles.\nCelles-ci doivent notamment préciser :\n>> la manière dont l’inventaire des composants du système d’information est réalisé ;\n>> les sources d’information relatives à la publication des mises à jour ;\n>> les outils pour déployer les correctifs sur le parc (par exemple WSUS pour les mises à jour des composants Microsoft, des outils gratuits ou payants pour les composants tiers et autres systèmes d’exploitation) ;\n>> l’éventuelle qualification d',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1761','35','Anticiper la fin de la maintenance des logiciels et systèmes et limiter les adhérences logicielles','/Standard\nL’utilisation d’un système ou d’un logiciel obsolète augmente significativement les possibilités d’attaque informatique. Les systèmes deviennent vulnérables dès lors que les correctifs ne sont plus proposés. En effet, des outils malveillants exploitant ces vulnérabilités peuvent se diffuser rapidement sur Internet alors même que l’éditeur ne propose pas de correctif de sécurité.\nPour anticiper ces obsolescences, un certain nombre de précautions existent :\n>> établir et tenir à jour un inventaire des systèmes et applications du système d’information ;\n>> choisir des solutions dont le support est assuré pour une durée correspondant à leur utilisation ;\n>> assurer un suivi des mises à jour et des dates de fin de support des logiciels ;\n>> maintenir un parc logiciel homogène (la coexistence de versions différentes d’un même produit multiplie les risques et complique le suivi) ;\n>> limiter les adhérences logicielles, c’est-à-dire les dépendances de fonctionnement d’un logiciel par',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1762','36','Activer et configurer les journaux des composants les plus importants','/Standard\nDisposer de journaux pertinents est nécessaire afin de pouvoir détecter d’éventuels dysfonctionnements et tentatives d’accès illicites aux composants du système d’information.\nLa première étape consiste à déterminer quels sont les composants critiques du système d’information. Il peut notamment s’agir des équipements réseau et de sécurité, des serveurs critiques, des postes de travail d’utilisateurs sensibles, etc.\nPour chacun, il convient d’analyser la configuration des éléments journalisés (format, fréquence de rotation des fichiers, taille maximale des fichiers journaux, catégories d’évènements enregistrés, etc.) et de l’adapter en conséquence.\nLes évènements critiques pour la sécurité doivent être journalisés et gardés pendant au moins un an (ou plus en fonction des obligations légales du secteur d’activités).\nUne étude contextuelle du système d’information doit être effectuée et les éléments suivants doivent être journalisés :\n>> pare-feu : paquets bloqués ;\n>> systèmes ',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1763','37','Définir et appliquer une politique de sauvegarde des composants critiques','/Standard\nSuite à un incident d’exploitation ou en contexte de gestion d’une intrusion, la disponibilité de sauvegardes conservées en lieu sûr est indispensable à la poursuite de l’activité. Il est donc fortement recommandé de formaliser une politique de sauvegarde régulièrement mise à jour. Cette dernière a pour objectif de définir des exigences en matière de sauvegarde de l’information, des logiciels et des systèmes.\nCette politique doit au moins intégrer les éléments suivants :\n>> la liste des données jugées vitales pour l’organisme et les serveurs concernés ;\n>> les différents types de sauvegarde (par exemple le mode hors ligne) ;\n>> la fréquence des sauvegardes ;\n>> la procédure d’administration et d’exécution des sauvegardes ;\n>> les informations de stockage et les restrictions d’accès aux sauvegardes ;\n>> les procédures de test de restauration ;\n>> la destruction des supports ayant contenu les sauvegardes.\nLes tests de restauration peuvent être réalisés de plusieurs manières :\n>',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1764','38','Procéder à des contrôles et audits de sécurité réguliers puis appliquer les actions correctives asso','/Renforcé\nLa réalisation d’audits réguliers (au moins une fois par an) du système d’information est essentielle car elle permet d’évaluer concrètement l’efficacité des mesures mises en oeuvre et leur maintien dans le temps. Ces contrôles et audits permettent également de mesurer les écarts pouvant persister entre la règle et la pratique.\nIls peuvent être réalisés par d’éventuelles équipes d’audit internes ou par des sociétés externes spécialisées. Selon le périmètre à contrôler, des audits techniques et/ou organisationnels seront effectués par les professionnels mobilisés. Ces audits sont d’autant plus nécessaires que l’entité doit être conforme à des réglementations et obligations légales directement liées à ses activités.\nÀ l’issue de ces audits, des actions correctives doivent être identifiées, leur application planifiée et des points de suivi organisés à intervalles réguliers. Pour une plus grande efficacité, des indicateurs sur l’état d’avancement du plan d’action pourront être in',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1765','39','Désigner un référent en sécurité des systèmes d’information et le faire connaître auprès du personne','/Standard\nToute entité doit disposer d’un référent en sécurité des systèmes d’information qui sera soutenu par la direction ou par une instance décisionnelle spécialisée selon le niveau de maturité de la structure.\nCe référent devra être connu de tous les utilisateurs et sera le premier contact pour toutes les questions relatives à la sécurité des systèmes d’information :\n>> définition des règles à appliquer selon le contexte ;\n>> vérification de l’application des règles ;\n>> sensibilisation des utilisateurs et définition d’un plan de formation des acteurs informatiques ;\n>> centralisation et traitement des incidents de sécurité constatés ou remontés par les utilisateurs.\nCe référent devra être formé à la sécurité des systèmes d’information et à la gestion de crise.\nDans les entités les plus importantes, ce correspondant peut être désigné pour devenir le relais du RSSI. Il pourra par exemple signaler les doléances des utilisateurs et identifier les thématiques à aborder dans le cadre d',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1766','40','Définir une procédure de gestion des incidents de sécurité','/Standard\nLe constat d’un comportement inhabituel de la part d’un poste de travail ou d’un serveur (connexion impossible, activité importante, activités inhabituelles, services ouverts non autorisés, fichiers créés, modifiés ou supprimés sans autorisation, multiples alertes de l’antivirus, etc.) peut alerter sur une éventuelle intrusion.\nUne mauvaise réaction en cas d’incident de sécurité peut faire empirer la situation et empêcher de traiter correctement le problème. Le bon réflexe est de déconnecter la machine du réseau, pour stopper l’attaque. En revanche, il faut la maintenir sous tension et ne pas la redémarrer, pour ne pas perdre d’informations utiles pour l’analyse de l’attaque. Il faut ensuite prévenir la hiérarchie, ainsi que le référent en sécurité des systèmes d’information.\nCelui-ci peut prendre contact avec un prestataire de réponse aux incidents de sécurité (PRIS) afin de faire réaliser les opérations techniques nécessaires (copie physique du disque, analyse de la mémoire',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1767','41','Mener une analyse de risques formelle','/Renforcé\nChaque entité évolue dans un environnement informationnel complexe qui lui est propre. Aussi, toute prise de position ou plan d’action impliquant la sécurité du système d’information doit être considéré à la lumière des risques pressentis par la direction. En effet, qu’il s’agisse de mesures organisationnelles ou techniques, leur mise en oeuvre représente un coût pour l’entité qui nécessite de s’assurer qu’elles permettent de réduire au bon niveau un risque identifié.\nDans les cas les plus sensibles, l’analyse de risque peut remettre en cause certains choix passés. Ce peut notamment être le cas si la probabilité d’apparition d’un événement et ses conséquences potentielles s’avèrent critiques pour l’entité et qu’il n’existe aucune action préventive pour le maîtriser.\nLa démarche recommandée consiste, dans les grandes lignes, à définir le contexte, apprécier les risques et les traiter. L’évaluation de ces risques s’opère généralement selon deux axes : leur probabilité d’apparit',NULL,NULL,NULL,NULL,'17','17','1.d');
INSERT INTO `O_regle` VALUES ('1768','42','Privilégier l’usage de produits et de services qualifiés par l’ANSSI','/Renforcé\nLa qualification prononcée par l’ANSSI offre des garanties de sécurité et de confiance aux acheteurs de solutions listées dans les catalogues de produits et de prestataires de service qualifiés que publie l’agence.\nAu-delà des entités soumises à réglementation, l’ANSSI encourage plus généralement l’ensemble des entreprises et administrations françaises à utiliser des produits qu’elle qualifie, seul gage d’une étude sérieuse et approfondie du fonctionnement technique de la solution et de son écosystème.\nS’agissant des prestataires de service qualifiés, ce label permet de répondre aux enjeux et projets de cybersécurité pour l’ensemble du tissu économique français que l’ANSSI ne saurait adresser seule. Évalués sur des critères techniques et organisationnels, les prestataires qualifiés couvrent l’essentiel des métiers de la sécurité des systèmes d’information. Ainsi, en fonction de ses besoins et du maillage national, une entité pourra faire appel à un Prestataire d’audit de la s',NULL,NULL,NULL,NULL,'17','17','1.d');


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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

INSERT INTO `P_SROV` VALUES ('14','Organisation idéologique','Amateur','Desc SR','MonOOV','Desc OV','3','1','1','','','','','Moyenne','','2.a','15');
INSERT INTO `P_SROV` VALUES ('15','Individu isolé','Le voisin','Des SR','Voler le mot de passe','Desc OV','3','3','3','','','','','Élevée','','2.a','15');
INSERT INTO `P_SROV` VALUES ('16','Organisation structurée','Amateur','gfdg','OV par Carlos','dfgdfgdf','1','1','1','','','','','Faible','P1','2.a','14');
INSERT INTO `P_SROV` VALUES ('17','Organisation structurée','vbcvbcv','cvbcvbv','vbcvb','cvbvb','3','2','1','','','','','Élevée','','2.a','16');
INSERT INTO `P_SROV` VALUES ('18','Organisation structurée','Etatique','SR1','Espionnage','OV1','1','1','1','','','','','Faible','','2.a','17');


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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

INSERT INTO `Q_seuil` VALUES ('14','8','4','2','14','3.a');
INSERT INTO `Q_seuil` VALUES ('15','7','4','2','15','3.a');
INSERT INTO `Q_seuil` VALUES ('16','6','4','2','16','3.a');
INSERT INTO `Q_seuil` VALUES ('17','6','4','2','17','3.a');


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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

INSERT INTO `R_partie_prenante` VALUES ('24','Gestion interne','CarlosPP','Interne','4','4','1','1','16','1','1','1','1','1','1','1','1','1','3.a','15','15','Critique');
INSERT INTO `R_partie_prenante` VALUES ('25','fdfs','Service informatique','Externe','4','4','1','1','16','1','1','1','1','3','1','1','1','3','3.a','14','14','Très critique');
INSERT INTO `R_partie_prenante` VALUES ('26','Cat Me','CarlosAAA','Interne','4','2','1','1','8','1','1','1','1','4','4','1','1','16','3.a','15','15','Pas critique');
INSERT INTO `R_partie_prenante` VALUES ('27','Gestion interne','CarlosPP','Interne','1','1','1','1','1','1','1','1','1','4','4','1','1','16','3.a','14','14','Peu critique');
INSERT INTO `R_partie_prenante` VALUES ('28','dff','Service info','Interne','4','4','1','1','16','1','1','1','1','3','2','3','3','0.67','3.a','16','16','Pas critique');
INSERT INTO `R_partie_prenante` VALUES ('29','Gestion interne','PP3','Interne','2','1','1','1','2','1','1','1','1','4','4','4','4','1','3.a','15','15','Pas critique');
INSERT INTO `R_partie_prenante` VALUES ('30','Gestion interne','PP4','Externe','1','1','1','1','1','1','1','1','1','4','1','1','1','4','3.a','15','15','Pas critique');
INSERT INTO `R_partie_prenante` VALUES ('31','Gestion interne','PP5','Externe','4','4','1','1','16','1','1','1','1','4','2','1','1','8','3.a','15','15','Critique');
INSERT INTO `R_partie_prenante` VALUES ('32','CAT1','PP1','Interne','4','4','2','2','4','1','1','1','1','1','1','4','4','0.06','3.a','17','17','Critique');
INSERT INTO `R_partie_prenante` VALUES ('33','CAT1','PP2','Interne','1','1','1','1','1','1','1','1','1','2','1','1','1','2','3.a','17','17','Pas critique');
INSERT INTO `R_partie_prenante` VALUES ('34','CAT1','PP3','Externe','4','4','1','1','16','1','1','1','1','3','3','1','1','9','3.a','17','17','Critique');
INSERT INTO `R_partie_prenante` VALUES ('35','CAT1','PP4','Externe','1','1','1','1','1','1','1','1','1','1','1','1','1','1','3.a','17','17','Pas critique');


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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO `S_scenario_strategique` VALUES ('13','MonScénarStratégique','logo_Google_FullColor_3x_830x271px.max-2800x2800-1.png','3.b','14','13','15');
INSERT INTO `S_scenario_strategique` VALUES ('14','dffgdfg','hacker_cyber_crime-512.png','3.b','16','15','14');
INSERT INTO `S_scenario_strategique` VALUES ('15',' vol pour revente au ',NULL,'3.b','17','17','16');
INSERT INTO `S_scenario_strategique` VALUES ('16','SS1',NULL,'3.b','18','18','17');


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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('31','R3s','Titre chemin attaque','test','13','24','15','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('32','R3s','cvbvcbc',NULL,'14','25','14','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('34','R3s','fghfgh',NULL,'14','27','14','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('35','R3s','vbnvbn',NULL,'15','28','16','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('36','R3s','Test','description','13','26','15','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('37','R3s','R3','R3','13','29','15','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('38','R3s','R4','R4','13','30','15','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('39','R3s','R5','R5','13','31','15','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('40','R1','CAS1','Desc','16','32','17','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('41','R2','CAS2','CAS2','16','33','17','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('42','R3','CAS3','CAS3','16','34','17','3.b');
INSERT INTO `T_chemin_d_attaque_strategique` VALUES ('43','R4','CAS4','CAS4','16','35','17','3.b');


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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

INSERT INTO `U_scenario_operationnel` VALUES ('22',NULL,'Scenario opérationnel pour : Titre chemin attaque','1',NULL,'4.a','31','R3s','13','15');
INSERT INTO `U_scenario_operationnel` VALUES ('23',NULL,'Scenario opérationnel pour : cvbvcbc','4','ParapheCP.png','4.a','32','R3s','15','14');
INSERT INTO `U_scenario_operationnel` VALUES ('25',NULL,'Scenario opérationnel pour : cvbvcbc','4',NULL,'4.a','34','R3s','15','14');
INSERT INTO `U_scenario_operationnel` VALUES ('26',NULL,'Scenario opérationnel pour : vbnvbn','2',NULL,'4.a','35','R3s','17','16');
INSERT INTO `U_scenario_operationnel` VALUES ('27',NULL,'Scenario opérationnel pour : Test',NULL,NULL,'4.a','36','R3s','13','15');
INSERT INTO `U_scenario_operationnel` VALUES ('28',NULL,'Scenario opérationnel pour : R3',NULL,NULL,'4.a','37','R3s','13','15');
INSERT INTO `U_scenario_operationnel` VALUES ('29',NULL,'Scenario opérationnel pour : R4',NULL,NULL,'4.a','38','R3s','13','15');
INSERT INTO `U_scenario_operationnel` VALUES ('30',NULL,'Scenario opérationnel pour : R5',NULL,NULL,'4.a','39','R3s','13','15');
INSERT INTO `U_scenario_operationnel` VALUES ('31',NULL,'Scenario opérationnel pour : CAS1','2',NULL,'4.a','40','R1','18','17');
INSERT INTO `U_scenario_operationnel` VALUES ('32',NULL,'Scenario opérationnel pour : CAS2','4',NULL,'4.a','41','R2','18','17');
INSERT INTO `U_scenario_operationnel` VALUES ('33',NULL,'Scenario opérationnel pour : CAS3','1',NULL,'4.a','42','R3','18','17');
INSERT INTO `U_scenario_operationnel` VALUES ('34',NULL,'Scenario opérationnel pour : CAS4','1',NULL,'4.a','43','R4','18','17');


DROP TABLE IF EXISTS `W_mode_operatoire`;
CREATE TABLE `W_mode_operatoire` (
  `id_mode_operatoire` int(11) NOT NULL AUTO_INCREMENT,
  `mode_operatoire` varchar(1000) DEFAULT NULL,
  `id_scenario_operationnel` int(11) NOT NULL,
  PRIMARY KEY (`id_mode_operatoire`),
  KEY `W_mode_operatoire_U_scenario_operationnel_FK` (`id_scenario_operationnel`),
  CONSTRAINT `W_mode_operatoire_U_scenario_operationnel_FK` FOREIGN KEY (`id_scenario_operationnel`) REFERENCES `U_scenario_operationnel` (`id_scenario_operationnel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

INSERT INTO `W_mode_operatoire` VALUES ('16','Mon mode opératoire','22');
INSERT INTO `W_mode_operatoire` VALUES ('17','bbgfdbf','23');
INSERT INTO `W_mode_operatoire` VALUES ('18','ghfhfghfghfghfg','23');
INSERT INTO `W_mode_operatoire` VALUES ('19','MO1','31');
INSERT INTO `W_mode_operatoire` VALUES ('20','MO2','32');
INSERT INTO `W_mode_operatoire` VALUES ('21','MO3','33');
INSERT INTO `W_mode_operatoire` VALUES ('22','MO4','34');


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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

INSERT INTO `X_revaluation_du_risque` VALUES ('22','','AAAA','4','16','','5.c','31','R3s','15');
INSERT INTO `X_revaluation_du_risque` VALUES ('23','','','2','8','','5.c','32','R3s','14');
INSERT INTO `X_revaluation_du_risque` VALUES ('25','','','3','12','','5.c','34','R3s','14');
INSERT INTO `X_revaluation_du_risque` VALUES ('26',NULL,NULL,NULL,NULL,NULL,'5.c','35','R3s','16');
INSERT INTO `X_revaluation_du_risque` VALUES ('27',NULL,NULL,NULL,NULL,NULL,'5.c','36','R3s','15');
INSERT INTO `X_revaluation_du_risque` VALUES ('28',NULL,NULL,NULL,NULL,NULL,'5.c','37','R3s','15');
INSERT INTO `X_revaluation_du_risque` VALUES ('29',NULL,NULL,NULL,NULL,NULL,'5.c','38','R3s','15');
INSERT INTO `X_revaluation_du_risque` VALUES ('30',NULL,NULL,NULL,NULL,NULL,'5.c','39','R3s','15');
INSERT INTO `X_revaluation_du_risque` VALUES ('31','RR1','RR1','3','12','OK','5.c','40','R1','17');
INSERT INTO `X_revaluation_du_risque` VALUES ('32','RR2','RR2','1','4','OK','5.c','41','R2','17');
INSERT INTO `X_revaluation_du_risque` VALUES ('33','RR3','RR3','1','4','OK','5.c','42','R3','17');
INSERT INTO `X_revaluation_du_risque` VALUES ('34','RR4','RR4','3','12','OK','5.c','43','R4','17');


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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;

INSERT INTO `Y_mesure` VALUES ('61','MS3','Mesure super','15','5.b');
INSERT INTO `Y_mesure` VALUES ('62','MS3','Mesure','15','5.b');
INSERT INTO `Y_mesure` VALUES ('63','MS3','fdgfdgdfg','14','3.c');
INSERT INTO `Y_mesure` VALUES ('64','MS3','fdgdfg','14','3.c');
INSERT INTO `Y_mesure` VALUES ('65','MS3','fghfghfgh','14','3.c');
INSERT INTO `Y_mesure` VALUES ('66','MS3','ghjghjghjghj','14','5.b');
INSERT INTO `Y_mesure` VALUES ('67','MS3','g','14','5.b');
INSERT INTO `Y_mesure` VALUES ('68','MS3','g','14','5.b');
INSERT INTO `Y_mesure` VALUES ('69','MS3','rrrr','14','5.b');
INSERT INTO `Y_mesure` VALUES ('70','MS3','vff','14','5.b');
INSERT INTO `Y_mesure` VALUES ('71','MS3','dfgdfg','15','5.b');
INSERT INTO `Y_mesure` VALUES ('72','MS3','dfdfd','14','5.b');
INSERT INTO `Y_mesure` VALUES ('73','MS3','dfgdfgdf','15','5.b');
INSERT INTO `Y_mesure` VALUES ('74','MS3','xcvxcv','16','3.c');
INSERT INTO `Y_mesure` VALUES ('75','MS3','xcvxcvvcx','16','3.c');
INSERT INTO `Y_mesure` VALUES ('76','MS3','dbvbcvb','16','3.c');
INSERT INTO `Y_mesure` VALUES ('77','MS3','vcbvcbcvb','16','3.c');
INSERT INTO `Y_mesure` VALUES ('78','MS3','DESC','15','5.b');
INSERT INTO `Y_mesure` VALUES ('79','MS3','MS3','15','3.c');
INSERT INTO `Y_mesure` VALUES ('80','MS3','MS4','15','3.c');
INSERT INTO `Y_mesure` VALUES ('81','MS3','MS5','15','3.c');
INSERT INTO `Y_mesure` VALUES ('82','MS1','MS1','17','3.c');
INSERT INTO `Y_mesure` VALUES ('83','MS2','MS2','17','3.c');
INSERT INTO `Y_mesure` VALUES ('84','MS3','MS3','17','3.c');
INSERT INTO `Y_mesure` VALUES ('85','MS4','MS4','17','3.c');
INSERT INTO `Y_mesure` VALUES ('86','sdfsdf','sdfsdf','17','3.c');


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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;

INSERT INTO `ZA_traitement_de_securite` VALUES ('46','Gouvernance','','+','0000-00-00','','A lancer','5.b','15','61');
INSERT INTO `ZA_traitement_de_securite` VALUES ('47','Gouvernance','','+','0000-00-00','','A lancer','5.b','15','62');
INSERT INTO `ZA_traitement_de_securite` VALUES ('48','Gouvernance','fdgdfgdf','+','0000-00-00','fdgdfgdf','A lancer','3.c','14','64');
INSERT INTO `ZA_traitement_de_securite` VALUES ('49',NULL,NULL,NULL,NULL,NULL,NULL,'3.c','14','65');
INSERT INTO `ZA_traitement_de_securite` VALUES ('50',NULL,NULL,NULL,NULL,NULL,NULL,'5.b','14','66');
INSERT INTO `ZA_traitement_de_securite` VALUES ('51',NULL,NULL,NULL,NULL,NULL,NULL,'5.b','14','67');
INSERT INTO `ZA_traitement_de_securite` VALUES ('52','Gouvernance','','+','0000-00-00','yyyy','A lancer','5.b','14','69');
INSERT INTO `ZA_traitement_de_securite` VALUES ('53',NULL,NULL,NULL,NULL,NULL,NULL,'5.b','14','70');
INSERT INTO `ZA_traitement_de_securite` VALUES ('54',NULL,NULL,NULL,NULL,NULL,NULL,'5.b','15','71');
INSERT INTO `ZA_traitement_de_securite` VALUES ('55',NULL,NULL,NULL,NULL,NULL,NULL,'5.b','14','72');
INSERT INTO `ZA_traitement_de_securite` VALUES ('56','Gouvernance','','+','0000-00-00','','A lancer','5.b','15','73');
INSERT INTO `ZA_traitement_de_securite` VALUES ('57',NULL,NULL,NULL,NULL,NULL,NULL,'3.c','16','74');
INSERT INTO `ZA_traitement_de_securite` VALUES ('58',NULL,NULL,NULL,NULL,NULL,NULL,'3.c','16','75');
INSERT INTO `ZA_traitement_de_securite` VALUES ('59',NULL,NULL,NULL,NULL,NULL,NULL,'3.c','16','76');
INSERT INTO `ZA_traitement_de_securite` VALUES ('60',NULL,NULL,NULL,NULL,NULL,NULL,'3.c','16','77');
INSERT INTO `ZA_traitement_de_securite` VALUES ('61','Gouvernance','','+','0000-00-00','','A lancer','5.b','15','78');
INSERT INTO `ZA_traitement_de_securite` VALUES ('62','Gouvernance','','+','0000-00-00','','A lancer','3.c','15','79');
INSERT INTO `ZA_traitement_de_securite` VALUES ('63',NULL,NULL,NULL,NULL,NULL,NULL,'3.c','15','80');
INSERT INTO `ZA_traitement_de_securite` VALUES ('64',NULL,NULL,NULL,NULL,NULL,NULL,'3.c','15','81');
INSERT INTO `ZA_traitement_de_securite` VALUES ('65','Protection','Ok','++','2020-08-28','Joyston','Terminé','3.c','17','82');
INSERT INTO `ZA_traitement_de_securite` VALUES ('66','Gouvernance','OK','+','2020-08-27','Eric','A lancer','3.c','17','83');
INSERT INTO `ZA_traitement_de_securite` VALUES ('67','Gouvernance','OK','+','2020-09-01','Jean','A lancer','3.c','17','84');
INSERT INTO `ZA_traitement_de_securite` VALUES ('68','Protection','OK','+++','2021-01-01','Pierre','En cours','3.c','17','85');
INSERT INTO `ZA_traitement_de_securite` VALUES ('69',NULL,NULL,NULL,NULL,NULL,NULL,'3.c','17','86');


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

INSERT INTO `ZB_comporter_2` VALUES ('61','31','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('62','31','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('64','32','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('65','32','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('66','32','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('67','32','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('69','32','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('70','32','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('72','34','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('73','31','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('74','35','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('75','35','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('76','35','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('77','35','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('78','36','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('79','37','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('80','38','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('81','39','R3s');
INSERT INTO `ZB_comporter_2` VALUES ('82','40','R1');
INSERT INTO `ZB_comporter_2` VALUES ('83','41','R2');
INSERT INTO `ZB_comporter_2` VALUES ('84','42','R3');
INSERT INTO `ZB_comporter_2` VALUES ('85','43','R4');
INSERT INTO `ZB_comporter_2` VALUES ('86','40','R1');
