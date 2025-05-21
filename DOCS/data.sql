use sql7780135;

INSERT INTO Marque (libelle) VALUES
('Toyota'), ('Volkswagen'), ('Ford'), ('Honda'), ('Chevrolet'), ('Nissan'),
('Hyundai'), ('Kia'), ('Mercedes-Benz'), ('BMW'), ('Audi'), ('Lexus'),
('Renault'), ('Peugeot'), ('Citroën'), ('Fiat'), ('Mazda'), ('Subaru'),
('Skoda'), ('SEAT'), ('Volvo'), ('Jeep'), ('Dodge'), ('Ram'), ('Buick'),
('GMC'), ('Chrysler'), ('Cadillac'), ('Lincoln'), ('Infiniti'), ('Acura'),
('Genesis'), ('Mini'), ('Porsche'), ('Land Rover'), ('Jaguar'), ('Tesla'),
('Mitsubishi'), ('Suzuki'), ('Opel'), ('Alfa Romeo'), ('DS Automobiles'),
('Bentley'), ('Rolls-Royce'), ('Ferrari'), ('Lamborghini'), ('Maserati'),
('Aston Martin'), ('McLaren'), ('Bugatti'), ('Pagani'), ('Koenigsegg'),
('Smart'), ('Lucid Motors'), ('Rivian'), ('Polestar'), ('BYD'), ('NIO'),
('Xpeng'), ('Li Auto'), ('Fisker'), ('Faraday Future'), ('Lordstown Motors'),
('Canoo'), ('Arrival'), ('Aptera Motors'), ('Dacia'), ('Chery'), ('Great Wall'),
('Tata Motors'), ('Mahindra'), ('SAIC'), ('Geely'), ('Proton'), ('Autre');

INSERT INTO Roles (libelle) VALUES ('administrateur'), ('employe'), ('utilisateur');

INSERT INTO Utilisateurs (pseudo, email, role_id, password) VALUES ('admin', 'ecoride.et@gmail.com', 1, '$2y$12$e5YH29fF0SxpZV8drluJrOOyK23znln4sYg2Wy0nMfyq/YSmD0Xqq');

INSERT INTO Utilisateurs (pseudo, email, role_id, password) VALUES ('employe', 'employe@mail.fr', 2, '$2y$12$e5YH29fF0SxpZV8drluJrOOyK23znln4sYg2Wy0nMfyq/YSmD0Xqq');

INSERT INTO Utilisateurs (pseudo, email, role_id, password, credits, note) VALUES ('pseudo1', 'mail1@mail.fr', 3, '$2y$12$e5YH29fF0SxpZV8drluJrOOyK23znln4sYg2Wy0nMfyq/YSmD0Xqq', 20, 5);

INSERT INTO Avis (note, statut, conducteur_id) VALUES (5, 'temporaire', 3);

INSERT INTO Utilisateurs (pseudo, email, role_id, password, credits, note) VALUES ('pseudo2', 'mail2@mail.fr', 3, '$2y$12$e5YH29fF0SxpZV8drluJrOOyK23znln4sYg2Wy0nMfyq/YSmD0Xqq', 20, 5);

INSERT INTO Avis (note, statut, conducteur_id) VALUES (5, 'temporaire', 4);