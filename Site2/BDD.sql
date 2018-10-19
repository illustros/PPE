#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
DROP database IF EXISTS `BDD`;
Create database BDD;
use BDD;




#------------------------------------------------------------
# Table: CLIENT
#------------------------------------------------------------

CREATE TABLE CLIENT(
        NumCli      Int NOT NULL AUTO_INCREMENT,
        NomCli      Varchar (25) ,
        MailCli     Varchar (60) ,
        MotsDePasse Varchar (48) ,
        TelCli      Int ZEROFILL,
        FaxCli      Int ZEROFILL,
        AdresseCli  Varchar (50) ,
        CodePostCli Int ,
        DateNaiCli  Date ,
        VilleCli    Varchar (25) ,
        DateAddCli  Date ,
        PRIMARY KEY (NumCli )
);




#------------------------------------------------------------
# Table: PRESTATION SERVICE
#------------------------------------------------------------

CREATE TABLE PRESTATION_SERVICE(
        NumPreServ    Int NOT NULL ,
        LibPreService Varchar (100) ,
        Prix          Int ,
        descriptif    Varchar (255) ,
        PRIMARY KEY (NumPreServ )
);


#------------------------------------------------------------
# Table: EQUIPE
#------------------------------------------------------------

CREATE TABLE EQUIPE(
        NumEquip Int NOT NULL ,
        NomEqu   Varchar (100) ,
        PRIMARY KEY (NumEquip )
);


#------------------------------------------------------------
# Table: TECHNICIEN
#------------------------------------------------------------

CREATE TABLE TECHNICIEN(
        Numtech      Int NOT NULL ,
        NomEmp       Varchar (20) NOT NULL ,
        Prenomemp    Varchar (25) NOT NULL ,
        AdresseEmp   Varchar (40) NOT NULL ,
        CodePostEmp  Int NOT NULL ,
        VilleEmp     Varchar (25) ,
        DateNaissEmp Date NOT NULL ,
        DateEmbEmp   Date NOT NULL ,
        DateDepEmp   Date ,
        TelEmp       Int NOT NULL ,
        NumEquip     Int ,
        PRIMARY KEY (Numtech ),
        FOREIGN KEY (NumEquip) REFERENCES EQUIPE(NumEquip)
);


#------------------------------------------------------------
# Table: CHANTIER
#------------------------------------------------------------

CREATE TABLE CHANTIER(
        NumChant     Int NOT NULL ,
        AdresseChan  Varchar (40) NOT NULL ,
        CodePostChan Int NOT NULL ,
        VilleChan    Varchar (25) ,
        PRIMARY KEY (NumChant )

);




#------------------------------------------------------------
# Table: FACTUREPRO
#------------------------------------------------------------

CREATE TABLE FACTUREPRO(
        NumFact Int NOT NULL ,
        NomFact Char (100) ,
        NumCom  Int ,
        PRIMARY KEY (NumFact )
        
);

#------------------------------------------------------------
# Table: COMMANDE
#------------------------------------------------------------

CREATE TABLE COMMANDE(
        NumCom  Int NOT NULL ,
        DateCom Date ,
        EtatCom Varchar (25) ,
        NumCli  Int ,
        NumFact Int ,
        PRIMARY KEY (NumCom ),
        FOREIGN KEY (NumCli) REFERENCES CLIENT(NumCli),
        FOREIGN KEY (NumFact) REFERENCES FACTUREPRO(NumFact)
);



#------------------------------------------------------------
# Table: TYPE PRODUIT
#------------------------------------------------------------

CREATE TABLE TYPE_PRODUIT(
        NumTypePro Int NOT NULL ,
        NomType    Varchar (25) NOT NULL ,
        PRIMARY KEY (NumTypePro )
);


#------------------------------------------------------------
# Table: PRODUIT
#------------------------------------------------------------

CREATE TABLE PRODUIT(
        NumProduit Int NOT NULL ,
        NomPro     Varchar (25) NOT NULL ,
        PrixPro    Int NOT NULL ,
        ComPro     longtext, 
        NumTypePro Int ,
        PRIMARY KEY (NumProduit ),
        FOREIGN KEY (NumTypePro) REFERENCES TYPE_PRODUIT(NumTypePro)
);






#------------------------------------------------------------
# Table: FACTURECHANTIER
#------------------------------------------------------------

CREATE TABLE FACTURECHANTIER(
        NumfactChant Int NOT NULL ,
        PrixChant    Int NOT NULL ,
        NumDevis     Int ,
        NumCli       Int ,
        PRIMARY KEY (NumfactChant ),
        FOREIGN KEY (NumCli) REFERENCES CLIENT(NumCli)
);



#------------------------------------------------------------   
# Table: DEVIS
#------------------------------------------------------------

CREATE TABLE DEVIS(
        NumDevis     Int NOT NULL ,
        NomDevis     Varchar (100) ,
        ETAT      Char (25) ,
        NumCli       Int ,
        NumPreServ   Int ,
        NumChant     Int ,
        NumfactChant Int ,
        PRIMARY KEY (NumDevis ),
        FOREIGN KEY (NumPreServ) REFERENCES PRESTATION_SERVICE(NumPreServ),
        FOREIGN KEY (NumChant) REFERENCES CHANTIER(NumChant),
        FOREIGN KEY (NumfactChant) REFERENCES FACTURECHANTIER(NumfactChant)
);





#------------------------------------------------------------
# Table: travailler
#------------------------------------------------------------

CREATE TABLE travailler(
        Numtech      Int NOT NULL ,
        NumChant     Int NOT NULL ,
        DateHeureFin Datetime ,
        Datedeb      Date NOT NULL ,
        PRIMARY KEY (Numtech ,NumChant),
        FOREIGN KEY (Numtech) REFERENCES TECHNICIEN(Numtech),
        FOREIGN KEY (NumChant) REFERENCES CHANTIER(NumChant)
);


#------------------------------------------------------------
# Table: ligneProduit
#------------------------------------------------------------

CREATE TABLE ligneProduit(
        NumProduit Int NOT NULL ,
        NumFact    Int NOT NULL ,
        qqteFact   Int ,
        PRIMARY KEY (NumProduit ,NumFact ),
        FOREIGN KEY (NumProduit) REFERENCES PRODUIT(NumProduit),
        FOREIGN KEY (NumFact) REFERENCES FACTUREPRO(NumFact)
);


#------------------------------------------------------------
# Table: ligneCom
#------------------------------------------------------------

CREATE TABLE ligneCom(
        NumProduit Int NOT NULL ,
        NumCom     Int NOT NULL ,
        qtteProd   Int ,
        PRIMARY KEY (NumProduit ,NumCom ),
        FOREIGN KEY (NumProduit) REFERENCES PRODUIT(NumProduit),
        FOREIGN KEY (NumCom) REFERENCES COMMANDE(NumCom)

);



INSERT INTO PRODUIT VALUES (1,'Lumrose',500,'Lumiere rose',1);
INSERT INTO PRODUIT VALUES (2,'fil blue',40,'fil electrique',4);

