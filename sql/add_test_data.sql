INSERT INTO Kayttaja (name, password) VALUES ('Pekka', 'Pekka123');
INSERT INTO Kayttaja (name, password) VALUES ('Maija', 'Maija123');

INSERT INTO Luokka (luokka_name, description) VALUES ('Kotityöt', 'Asunnosta huolehtimiseen tarvittavat askareet, joista kaikki ovat yhteisesti vastuussa.');

INSERT INTO Askare (name, luokka, description, deadline, importance, added, kayttaja_id) VALUES ('Tee tiskit', 'Kotityöt','Yhdessä aiheutettujen tiskien tiskaaminen käsin. Luo harmoniaa.', '2017-04-14', '10', NOW(), '1');
INSERT INTO Askare (name, luokka, description, deadline, importance, added, kayttaja_id) VALUES ('Imurointi', 'Kotityöt','Talouden imurointi läpikotaisin', '2017-04-10', '8', NOW(), '1');

INSERT INTO Askare (name, luokka, description, deadline, importance, added, kayttaja_id) VALUES ('Kissan pesu', 'Lemmikkieläimet', 'Kissa täytyy pestä sen vastalauseista huolimatta', '2017-04-16', '15', NOW(), '2');
INSERT INTO Askare (name, luokka, description, deadline, importance, added, kayttaja_id) VALUES ('Koiran ulkoiluttaminen', 'Lemmikkieläimet','Koiran vieminen ulos ja sen kävelyttäminen', '2017-04-12', '9', NOW(), '2');
