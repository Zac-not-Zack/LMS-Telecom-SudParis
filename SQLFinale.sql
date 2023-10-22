#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        login      Varchar (50) NOT NULL ,
        nom        Varchar (50) NOT NULL ,
        prenom     Varchar (50) NOT NULL ,
        courrier   Varchar (50) NOT NULL ,
        population Varchar (50) NOT NULL ,
        type       Varchar (50) NOT NULL ,
        mdp        Varchar (50) NOT NULL
	,CONSTRAINT utilisateur_PK PRIMARY KEY (login)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cours
#------------------------------------------------------------

CREATE TABLE cours(
        idcours     Int  Auto_increment  NOT NULL ,
        titre       Varchar (50) NOT NULL ,
        description Text NOT NULL
	,CONSTRAINT cours_PK PRIMARY KEY (idcours)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: section
#------------------------------------------------------------

CREATE TABLE section(
        idsection Int  Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL ,
        idcours   Int NOT NULL
	,CONSTRAINT section_PK PRIMARY KEY (idsection)

	,CONSTRAINT section_cours_FK FOREIGN KEY (idcours) REFERENCES cours(idcours)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: activity
#------------------------------------------------------------

CREATE TABLE activity(
        idactivity Int  Auto_increment  NOT NULL ,
        idsection  Int NOT NULL
	,CONSTRAINT activity_PK PRIMARY KEY (idactivity)

	,CONSTRAINT activity_section_FK FOREIGN KEY (idsection) REFERENCES section(idsection)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: fic
#------------------------------------------------------------

CREATE TABLE fic(
        idactivity  Int NOT NULL ,
        titre       Varchar (50) NOT NULL ,
        description Text NOT NULL ,
        lien        Varchar (50) NOT NULL ,
        idsection   Int NOT NULL
	,CONSTRAINT fic_PK PRIMARY KEY (idactivity)

	,CONSTRAINT fic_activity_FK FOREIGN KEY (idactivity) REFERENCES activity(idactivity)
	,CONSTRAINT fic_section0_FK FOREIGN KEY (idsection) REFERENCES section(idsection)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: url
#------------------------------------------------------------

CREATE TABLE url(
        idactivity  Int NOT NULL ,
        titre       Varchar (50) NOT NULL ,
        description Text NOT NULL ,
        url         Text NOT NULL ,
        idsection   Int NOT NULL
	,CONSTRAINT url_PK PRIMARY KEY (idactivity)

	,CONSTRAINT url_activity_FK FOREIGN KEY (idactivity) REFERENCES activity(idactivity)
	,CONSTRAINT url_section0_FK FOREIGN KEY (idsection) REFERENCES section(idsection)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: devoir
#------------------------------------------------------------

CREATE TABLE devoir(
        idactivity  Int NOT NULL ,
        titre       Varchar (50) NOT NULL ,
        description Text NOT NULL ,
        date        Datetime NOT NULL ,
        idsection   Int NOT NULL
	,CONSTRAINT devoir_PK PRIMARY KEY (idactivity)

	,CONSTRAINT devoir_activity_FK FOREIGN KEY (idactivity) REFERENCES activity(idactivity)
	,CONSTRAINT devoir_section0_FK FOREIGN KEY (idsection) REFERENCES section(idsection)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: depot
#------------------------------------------------------------

CREATE TABLE depot(
        iddepot       Int  Auto_increment  NOT NULL ,
        idutilisateur Varchar (50) NOT NULL ,
        datedepot     Datetime NOT NULL ,
        idactivity    Int NOT NULL
	,CONSTRAINT depot_PK PRIMARY KEY (iddepot)

	,CONSTRAINT depot_devoir_FK FOREIGN KEY (idactivity) REFERENCES devoir(idactivity)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cohorte
#------------------------------------------------------------

CREATE TABLE cohorte(
        idcohorte Int  Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL
	,CONSTRAINT cohorte_PK PRIMARY KEY (idcohorte)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: estInscrit
#------------------------------------------------------------

CREATE TABLE estInscrit(
        login   Varchar (50) NOT NULL ,
        idcours Int NOT NULL
	,CONSTRAINT estInscrit_PK PRIMARY KEY (login,idcours)

	,CONSTRAINT estInscrit_utilisateur_FK FOREIGN KEY (login) REFERENCES utilisateur(login)
	,CONSTRAINT estInscrit_cours0_FK FOREIGN KEY (idcours) REFERENCES cours(idcours)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appartient
#------------------------------------------------------------

CREATE TABLE appartient(
        idcohorte    Int NOT NULL ,
        login        Varchar (50) NOT NULL ,
        proprietaire Boolean NOT NULL
	,CONSTRAINT appartient_PK PRIMARY KEY (idcohorte,login)

	,CONSTRAINT appartient_cohorte_FK FOREIGN KEY (idcohorte) REFERENCES cohorte(idcohorte)
	,CONSTRAINT appartient_utilisateur0_FK FOREIGN KEY (login) REFERENCES utilisateur(login)
)ENGINE=InnoDB;

