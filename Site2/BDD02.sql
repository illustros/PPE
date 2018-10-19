#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
DROP database IF EXISTS `BDD`;
Create database BDD;
use BDD;



CREATE TABLE EQUIPE(
        NumEquip Int NOT NULL,
	CONSTRAINT EQUIPE_PK PRIMARY KEY (NumEquip)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TECHNICIEN
#------------------------------------------------------------

CREATE TABLE TECHNICIEN(
        Numtech      Int NOT NULL COMMENT "numeros secu social"  ,
        NomEmp       Varchar (20) NOT NULL ,
        Prenomemp    Varchar (25) NOT NULL ,
        AdresseEmp   Varchar (40) NOT NULL ,
        CodePostEmp  Int NOT NULL ,
        VilleEmp     Varchar (25) ,
        DateNaissEmp Date NOT NULL ,
        DateEmbEmp   Date NOT NULL ,
        DateDepEmp   Date ,
        TelEmp       Int NOT NULL ,
        NumEquip     Int NOT NULL
	,CONSTRAINT TECHNICIEN_PK PRIMARY KEY (Numtech)

	,CONSTRAINT TECHNICIEN_EQUIPE_FK FOREIGN KEY (NumEquip) REFERENCES EQUIPE(NumEquip)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TYPE PRODUIT
#------------------------------------------------------------

CREATE TABLE TYPE_PRODUIT(
        NumTypePro Int NOT NULL ,
        NomType    Varchar (25) NOT NULL
	,CONSTRAINT TYPE_PRODUIT_PK PRIMARY KEY (NumTypePro)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PRODUIT
#------------------------------------------------------------

CREATE TABLE PRODUIT(
        NumProduit Int NOT NULL ,
        NomPro     Varchar (25) NOT NULL ,
        PrixPro    Int NOT NULL ,
        NumTypePro Int NOT NULL
	,CONSTRAINT PRODUIT_PK PRIMARY KEY (NumProduit)

	,CONSTRAINT PRODUIT_TYPE_PRODUIT_FK FOREIGN KEY (NumTypePro) REFERENCES TYPE_PRODUIT(NumTypePro)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CLIENT
#------------------------------------------------------------

CREATE TABLE CLIENT(
        NumCli      Int NOT NULL ,
        NomCli      Varchar (25) NOT NULL ,
        PrenomCli   Varchar (25) NOT NULL ,
        Mailcli     Varchar (5) NOT NULL ,
        AdresseCli  Varchar (50) NOT NULL ,
        CodePostCli Int NOT NULL ,
        DateNaiCli  Date NOT NULL ,
        TelCli      Int NOT NULL ,
        DateAddCli  Date NOT NULL ,
        VilleCli    Varchar (25)
	,CONSTRAINT CLIENT_PK PRIMARY KEY (NumCli)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: COMMANDE
#------------------------------------------------------------

CREATE TABLE COMMANDE(
        NumCom  Int NOT NULL ,
        DateCom Date ,
        Etat    Bool NOT NULL ,
        NumCli  Int NOT NULL
	,CONSTRAINT COMMANDE_PK PRIMARY KEY (NumCom)

	,CONSTRAINT COMMANDE_CLIENT_FK FOREIGN KEY (NumCli) REFERENCES CLIENT(NumCli)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: FACTUREPRO
#------------------------------------------------------------

CREATE TABLE FACTUREPRO(
        NumFact Int NOT NULL ,
        NumCom  Int NOT NULL
	,CONSTRAINT FACTUREPRO_PK PRIMARY KEY (NumFact)

	,CONSTRAINT FACTUREPRO_COMMANDE_FK FOREIGN KEY (NumCom) REFERENCES COMMANDE(NumCom)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PRESTATION SERVICE
#------------------------------------------------------------

CREATE TABLE PRESTATION_SERVICE(
        NumPreServ Int NOT NULL ,
        NumCli     Int NOT NULL
	,CONSTRAINT PRESTATION_SERVICE_PK PRIMARY KEY (NumPreServ)

	,CONSTRAINT PRESTATION_SERVICE_CLIENT_FK FOREIGN KEY (NumCli) REFERENCES CLIENT(NumCli)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: DEVIS
#------------------------------------------------------------

CREATE TABLE DEVIS(
        NumDevis   Int NOT NULL ,
        ETATDEV    Char ,
        NumPreServ Int NOT NULL
	,CONSTRAINT DEVIS_PK PRIMARY KEY (NumDevis)

	,CONSTRAINT DEVIS_PRESTATION_SERVICE_FK FOREIGN KEY (NumPreServ) REFERENCES PRESTATION_SERVICE(NumPreServ)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CHANTIER
#------------------------------------------------------------

CREATE TABLE CHANTIER(
        NumChant     Int NOT NULL ,
        AdresseChan  Varchar (40) NOT NULL ,
        CodePostChan Int NOT NULL ,
        VilleChan    Varchar (25) ,




	=======================================================================
	   Désolé, il faut activer cette version pour voir la suite du script ! 
	=======================================================================
