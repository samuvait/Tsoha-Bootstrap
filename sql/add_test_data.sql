INSERT INTO Kayttaja (name, password) VALUES ('Pekka', 'Pekka123');
INSERT INTO Kayttaja (name, password) VALUES ('Maija', 'Maija123');

INSERT INTO Luokka (luokka_name, description) VALUES ('Kotityöt', 'Asunnosta huolehtimiseen tarvittavat askareet, joista kaikki ovat yhteisesti vastuussa.');

INSERT INTO Askare (name, luokka, description, deadline, importance, added) VALUES ('Tee tiskit', 'Kotityöt','Yhdessä aiheutettujen tiskien tiskaaminen käsin. Luo harmoniaa.', '2017-04-14', '10', NOW());
INSERT INTO Askare (name, luokka, description, deadline, importance, added) VALUES ('Imurointi', 'Kotityöt','Talouden imurointi läpikotaisin', '2017-04-10', '8', NOW());
