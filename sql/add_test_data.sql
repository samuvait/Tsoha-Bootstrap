-- Lisää INSERT INTO lauseet tähän tiedostoon
-- INSERT INTO Kayttaja (name, password) VALUES ('Pekka', 'Pekka123');
-- INSERT INTO Kayttaja (name, password) VALUES ('Maija', 'Maija123');
-- 
-- INSERT INTO Askare(name, description, lisatty, deadline, tarkeysaste) VALUES ('Tee tiskit', 'Yhdessä aiheutettujen tiskien tiskaaminen käsin. Luo harmoniaa.', NOW(), '2017-30-03', 1);
-- Player-taulun testidata
INSERT INTO Player (name, password) VALUES ('Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Player (name, password) VALUES ('Henri', 'Henri123');
-- Game taulun testidata
INSERT INTO Game (name, description, published, publisher, added) VALUES ('The Elder Scrolls V: Skyrim', 'Arrow to the knee', '2011-11-11', 'Bethesda Softworks', NOW());