INSERT INTO Sauveteur (nom, prenom, departement, specialite, NumTel, DateHeureEngagement) VALUES
('Dalton',   'Joe',              '75', 'Désobstruction',         '0601020304', '2026-06-10 08:00:00'),
('Dalton',   'Jack',             '75', 'Évacuation',             '0601020305', '2026-06-10 08:00:00'),
('Dalton',   'William',          '75', 'Transmission',           '0601020306', '2026-06-10 08:00:00'),
('Dalton',   'Averell',          '75', 'Gestion',                '0601020307', '2026-06-10 08:00:00'),
('Croft',    'Lara',             '11', 'Conseiller technique',   '0601111111', '2026-06-10 09:00:00'),
('Jones',    'Indiana',          '34', 'Conseiller technique',   '0602222222', '2026-06-10 09:00:00'),
('Drake',    'Nathan',           '13', 'Évacuation',             '0603333333', '2026-06-10 09:00:00'),
('Tazieff',  'Haroun',           '63', 'Médical',                '0604444444', '2026-06-10 10:00:00'),
('Siffre',   'Michel',           '06', 'Ventilation',            '0605555555', '2026-06-10 10:00:00'),
('Martel',   'Édouard-Alfred',   '46', 'Conseiller technique',   '0611223344', '2026-06-10 07:30:00'),
('Petzl',    'Fernand',          '38', 'ASV (assistance victime)','0699887766', '2026-06-10 09:15:00'),
('Casteret', 'Norbert',          '31', 'Évacuation',             '0677441122', '2026-06-10 10:00:00');


INSERT INTO Mission (DateHeureDebut, DateHeureFin, EnPrepa, Lieu, ID_Sauveteur, ID_statut, ID_Utilisateur) VALUES
-- Joe Dalton : sous terre 8h→12h
('2026-06-10 08:00:00', '2026-06-10 12:00:00', 0, 'Gouffre de Padirac',               1,  3, 1),
-- Jack Dalton : sous terre 8h30→11h
('2026-06-10 08:30:00', '2026-06-10 11:00:00', 0, 'Gouffre de Padirac',               2,  3, 1),
-- William Dalton : équipe de gestion 8h→18h
('2026-06-10 08:00:00', '2026-06-10 18:00:00', 0, 'PC Surface - Padirac',             3,  4, 1),
-- Averell Dalton : repos 12h→14h
('2026-06-10 12:00:00', '2026-06-10 14:00:00', 0, 'Camp de base',                     4,  6, 1),
-- Lara Croft : sous terre, durée indéterminée
('2026-06-10 09:00:00', '2099-12-31 23:59:00', 0, 'Aven Armand',                       5,  3, 1),
-- Indiana Jones : approche cavité 9h15→10h
('2026-06-10 09:15:00', '2026-06-10 10:00:00', 0, 'Grotte de Lascaux',                 6,  2, 1),
-- Nathan Drake : sous terre 9h30→14h
('2026-06-10 09:30:00', '2026-06-10 14:00:00', 0, 'Gouffre Berger',                    7,  3, 1),
-- Haroun Tazieff : mission extérieure 10h→16h
('2026-06-10 10:00:00', '2026-06-10 16:00:00', 0, 'Massif de la Chartreuse',           8,  5, 1),
-- Michel Siffre : sous terre indéterminé + préparation
('2026-06-10 10:00:00', '2099-12-31 23:59:00', 1, 'Grotte de Clamouse',                9,  3, 1),
-- Martel : brancardage civière 7h30→9h30
('2026-06-10 07:30:00', '2026-06-10 09:30:00', 0, 'Réseau de la Dent de Crolles',     10,  7, 1),
-- Petzl : disponible 9h→12h
('2026-06-10 09:00:00', '2026-06-10 12:00:00', 0, 'PC Surface - Aven Armand',          11,  1, 1),
-- Casteret : sous terre 10h→16h
('2026-06-10 10:00:00', '2026-06-10 16:00:00', 0, 'Gouffre de Padirac',               12,  3, 1);


INSERT INTO Mission (DateHeureDebut, DateHeureFin, EnPrepa, Lieu, ID_Sauveteur, ID_statut, ID_Utilisateur) VALUES
('2026-06-11 08:30:00', '2026-06-11 14:00:00', 0, 'Gouffre de Padirac',               1,  3, 1),
('2026-06-11 09:00:00', '2026-06-11 11:30:00', 0, 'Gouffre de Padirac',               2,  3, 1),
('2026-06-11 08:00:00', '2026-06-11 18:00:00', 0, 'PC Surface - Padirac',             3,  4, 1),
('2026-06-11 14:00:00', '2026-06-11 16:00:00', 0, 'Camp de base',                     4,  6, 1),
('2026-06-11 10:00:00', '2099-12-31 23:59:00', 0, 'Aven Armand',                       5,  3, 1),
('2026-06-11 09:30:00', '2026-06-11 10:30:00', 0, 'Grotte de Lascaux',                 6,  2, 1),
('2026-06-11 09:00:00', '2026-06-11 15:00:00', 0, 'Gouffre Berger',                    7,  3, 1),
('2026-06-11 10:30:00', '2026-06-11 17:00:00', 0, 'Massif de la Chartreuse',           8,  5, 1),
('2026-06-11 08:00:00', '2099-12-31 23:59:00', 1, 'Grotte de Clamouse',                9,  3, 1),
('2026-06-11 07:30:00', '2026-06-11 09:00:00', 0, 'Réseau de la Dent de Crolles',     10,  7, 1),
('2026-06-11 09:30:00', '2026-06-11 12:30:00', 0, 'PC Surface - Aven Armand',          11,  1, 1),
('2026-06-11 11:00:00', '2026-06-11 18:00:00', 0, 'Gouffre de Padirac',               12,  3, 1);
