CREATE TABLE Stock_cave (
	NoStock INTEGER PRIMARY KEY SERIAL,
	Quantite INTEGER NOT NULL, 
	NoVin INTEGER NOT NULL,
CONSTRAINT fk_NoVin FOREIGN KEY (NoVin) REFERENCES Vin (NoVin) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Vin ( 
	NoVin INTEGER PRIMARY KEY SERIAL,
	Producteur VARCHAR(40) NOT NULL , 
	Annee VARCHAR(4) NOT NULL,
	Couleur VARCHAR(10) NOT NULL DEFAULT 'Rouge' CHECK (Couleur in ('Blanc','Rouge','Rosé')),
	Region VARCHAR(30) NOT NULL DEFAULT 'Bordeaux' CHECK (Region in ('Bordeaux','Bourgogne','Loire','Sud Ouest','Côtes du Rhone'))
);
