

CREATE TABLE `colleges` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `shortname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO colleges VALUES("1","University College of Computer Applications","0","UCCA");
INSERT INTO colleges VALUES("2","University College Of Basic Sciences & Humanities","0","UCBSH");
INSERT INTO colleges VALUES("3","University School Of Law","0","USL");
INSERT INTO colleges VALUES("5","University College Of Pharmacy and Paramedical Sciences","0","UCPPS");
INSERT INTO colleges VALUES("6","Guru Gobind Singh College Of Education","0","GGSCE");
INSERT INTO colleges VALUES("7","University College Of Education","0","UCE");
INSERT INTO colleges VALUES("8","University College Of Commerce & Management","0","UCCM");
INSERT INTO colleges VALUES("10","University College Of Agriculture","0","UCA");
INSERT INTO colleges VALUES("11","University College Of Physical Education","0","UCPE");
INSERT INTO colleges VALUES("12","Guru Gobind Singh College of Engg & Tech","0","GGSCET");
INSERT INTO colleges VALUES("13","Guru Kashi University","0","GKU");

